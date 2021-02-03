<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Login extends JLAMP_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function loginApi()
    {
        $loginID = $this->inputM('loginId', 'post'); // 로그인 ID
        $loginPwd = $this->inputM('loginPwd', 'post'); // 로그인 비밀번호
        $deviceID = $this->inputM('deviceId', 'post'); // 디바이스 ID
        $langID = $this->inputM('langId', 'post'); // 언어 ID
        $dbID = $this->input('dbId', 'post'); //数据库选择
        $spName = 'jlLogIn';
        $params = array('p_work_type' => 'pc');
        switch ($dbID){
            case 'Normal':
                $dbID = 'JLAMPBiz';
                break;
            case 'Test':
                $dbID = 'JLAMPtestBiz';
                break;
        }
        DB::connect($dbID);
        if (gettype($loginID) === 'array') {
            foreach ($loginID as $key => $val) {
                $params[$key] = $val;
            }
        } else {
            $params['p_user_id'] = $loginID;
            $params['p_password'] = md5($loginPwd);
        }

        $params['p_device_id'] = $deviceID;
        $params['p_MACAddress'] = '';
        $params['p_IPAddress'] = $this->jlamp_comm->clientIP();
        $params['p_client_pc'] = '';

        try {
            $res = $this->jlamp_common_mdl->spRow($spName, $params);
            if ($res) {
                $errorCode = $res[count($res) - 1];
                $eCode = substr($errorCode->p_error_code, 0, 1);
                if ($eCode == 'E' || $eCode == 'P') {
                    Helper::setResponse('', $errorCode->p_error_code, $this->getErrorMsg($errorCode->p_error_code));
                    $this->response();
                }
                $empId = DB::queryRow("select emp_code from sysUserMaster where user_id = '%s'",[$loginID]);
                $result = $this->buildSession($loginID,$empId['emp_code'],$deviceID,$langID,$dbID,$sessionKey);
                if($result){
                    $res = $res[0];
                    $res = json_decode(json_encode($res),true);
                    $res['empId'] = $empId['emp_code'];
                    Helper::setResponse($res,0,$sessionKey);
                }else{
                    Helper::setResponse('',455,'session build error');
                }
            } else {
                Helper::setResponse('', 451, '账号信息不匹配');
                $this->response();
            }
        } catch (Exception $e) {
            Helper::setResponse('', 200, 'error');
            $this->response();
        }

        $this->response();
    }

    private function buildSession($userId,$empId,$deviceId,$langId,$dbId,&$back=''){
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        $save = array(
            'userId' => $userId,
            'empId' => $empId,
            'deviceId' => $deviceId,
            'langId' => $langId,
            'dbId' => $dbId,
            'auth' => '',
            'confirmYn' => '',
            'saveYn' => '',
            'deleteYn' => ''
        );
        while (true){
            $key = $this->randomkeys(50);
            $sessionKey = 'session_'.$key;
            $server = $this->cache->get($sessionKey);
            if(!$server){
                break;
            }
        }
        $res = $this->cache->save($sessionKey,$save,5184000);
        if(!$res){
            return false;
        }
        $back = $key;
        return true;
    }

    public function getSession(){
        $sessionKey = $this->inputM('session','get');
        $sessionInfo = $this->session($sessionKey);
        if(!$sessionInfo || empty($sessionInfo)){
            Helper::setResponse('',410,'no session');
            $this->response();
        }
        Helper::setResponse($sessionInfo,0,'session info');
        $this->response();
    }
}
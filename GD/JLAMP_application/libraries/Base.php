<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("content-Type: text/html; charset=utf-8");

spl_autoload_register(function ($class_name) {
    require_once  APPPATH.'models/'.$class_name . '.php';
});

class Base extends JLAMP_Controller{
    protected $recall_array = array(
        'returnCode'  => 0,
        'returnMsg'   => '',
        'returnClass' => '',
        'data'        => ''
    );
    protected $DB = '';
    protected $auth = '';
    protected $langCode = 'SM00010003';
    protected $langId   = 'CHN';
    protected $toolDb = 'JLAMPTool';
    protected $loginUser = '';
    protected $loginUserName = '';
    protected $sessionKey = '';
    public function __construct(){
        parent::__construct();
        $this->jlamp_tp->define(HTML_BIND);
        $this->register();
        $headers = $this->input->request_headers();
//        if (empty(parent::getCookie('UserID',true))) {   //cookies验证
//            if($this->getCookie('DevicePlatform',false) == 'ios'){
//                $device = DEVICE_PLATFORM_IOS;
//            }
//            else
//            {
//                $device = DEVICE_PLATFORM_ANDROID;
//            }
//            $url = 'http://'.SERVICE_DOMAIN.':'.SERVICE_PORT.'/?deviceType='.DEVICE_MOBILE.'&devicePlatform='.$device;
//            $this->jlamp_js->replace($url);
//            exit();
//        }
        $dbChoose = $this->jlamp_comm->xssInput('dbChoose', 'get');
//        if(empty($headers['Authorization'])){
        $this->DB = parent::getCookie('DB');
        $this->loginUserName = empty(parent::getCookie('UserID')) ? parent::getCookie('SaveUserID') : parent::getCookie('UserID');//当前登录用户账号
        $this->loginUser = parent::getCookie('EmpId');  //当前登录工号
        $this->langId = parent::getCookie('LangID',false);
        $this->auth = parent::getCookie('auth',false);
        $langCode = parent::getLangID();
//        }else{
//            $sessionInfo = $this->session($headers['Authorization']);
//            if(!$sessionInfo || empty($sessionInfo)){
//                Helper::setResponse('',410,'no session');
//                $this->response();
//            }
//            $this->sessionKey = $headers['Authorization'];
//            $this->DB = $sessionInfo['dbId'];
//            $this->loginUserName = str_replace(' ','',$sessionInfo['userId']);
//            $this->loginUser = $sessionInfo['empId'];
//            $this->langId = $sessionInfo['langId'];
//            $this->auth = $sessionInfo['auth'];
//            $langCode = $this->langId;
//        }
        if(empty($dbChoose)){
            $this->jlamp_common_mdl->DBConnect($this->DB);
        }else{
            switch ($dbChoose){
                case 'SZ':
                    $this->jlamp_common_mdl->DBConnect('JLAMPSZBiz');
                    break;
                case 'GD':
                    $this->jlamp_common_mdl->DBConnect('JLAMPGDBiz');
                    break;
                case 'QD':
                    $this->jlamp_common_mdl->DBConnect('JLAMPQDBiz');
                    break;
                case 'HS':
                    $this->jlamp_common_mdl->DBConnect('JLAMPHSBiz');
                    break;
                case 'XR':
                    $this->jlamp_common_mdl->DBConnect('JLAMPXRBiz');
                    break;
                case 'YBD':
                    $this->jlamp_common_mdl->DBConnect('JLAMPYBDBiz');
                    break;
            }
        }
        switch ($langCode) {       //查看语言选项
            case "KOR":
                $this->langCode = "SM00010001";
                break;
            case "CHN":
                $this->langCode = "SM00010003";
                break;
            case "ENG":
                $this->langCode = "SM00010002";
                break;
            case "JPN":
                $this->langCode = "SM00010004";
                break;
        }
    }
    public function getSpInfo($code){
        $this->jlamp_common_mdl->DBConnect($this->toolDb);
        $sql = "select error_str from ServiceMessage where error_code = '$code' and LangCode = '$this->langId'";
        $result = $this->jlamp_common_mdl->sqlRow($sql);
        $result = json_decode(json_encode($result),true);
        $this->jlamp_common_mdl->DBConnect($this->DB);
        return $result;
    }
    //.更新账户权限级别
    public function getAuth($formId){
        $loginId = str_replace(' ','',parent::getCookie('UserID'));
        $auth = DB::queryRow("select 
                                    A.form_auth as user_form_auth,
                                    '' group_form_auth ,
                                    A.form_confirm_yn,
                                    A.form_save_yn,
                                    A.form_delete_yn
                                    from sysUserMenu A 
                                    left join sysMenuPool B on A.menu_id = B.menu_id 
                                    where B.form_id = '%s' 
                                    AND A.user_id = '%s'
                                    UNION ALL
                                    select '' user_form_auth,
                                    M2.form_auth as group_form_auth,
                                    M2.form_confirm_yn,
                                    M2.form_save_yn,
                                    M2.form_delete_yn
                                    from sysUserGroupMapping M1
                                    left join sysUserGroupMenu M2 on M1.user_group_id = M2.user_group_id
                                    left join sysMenuPool M3 on M2.menu_id = M3.menu_id where M3.form_id = '%s' AND M1.user_id = '%s'",
            [$formId,$loginId,$formId,$loginId]);
        //如果个人/组权限都为空则检查是否是管理员
        if(empty($auth['user_form_auth'])){
            if(empty($auth['group_form_auth'])){
                $isAdmin = DB::queryRow("select user_category from sysUserMaster where user_id = '%s'",[$loginId]);
                if($isAdmin['user_category'] == 'ADMIN') {
                    $this->setCookie('auth', AUTH_A, ALWAYS, false);
                    $auth['form_confirm_yn'] = 'Y';
                    $auth['form_save_yn'] = 'Y';
                    $auth['form_delete_yn'] = 'Y';
                }else {
                    $this->setCookie('auth','NO',ALWAYS,false);
                }
            }else{
                $this->setCookie('auth',$auth['group_form_auth'],ALWAYS,false);
            }
        }else{
            $this->setCookie('auth',$auth['user_form_auth'],ALWAYS,false);
        }
        $this->setCookie('confirmYn',empty($auth['form_confirm_yn']) ? 'N' : $auth['form_confirm_yn'],ALWAYS,false);
        $this->setCookie('saveYn',empty($auth['form_save_yn']) ? 'N' : $auth['form_save_yn'],ALWAYS,false);
        $this->setCookie('deleteYn',empty($auth['form_delete_yn']) ? 'N' : $auth['form_delete_yn'],ALWAYS,false);
    }
    //.模块访问记录
    public function loginLog($formId,$formNm='',$loginIp='0.0.0.0',$loginDevice='Mobile'){
        $device = $this->getCookie('DevicePlatform',false);
        $spName = 'jlFormAccessLog';
        $params = array(
            'p_work_type'           => 'OPEN',
            'p_user_id'             => $this->loginUserName,
            'p_form_id'             => $formId,
            'p_form_name'           => $formNm,
            'p_form_login_key'      => '',
            'p_browser_login_key'   => '',
            'p_log_type'            => 'MPAGE',
            'p_mac_address'         => '',
            'p_ip'                  => '',
            'p_client_pc'           => $device
        );
        try {
            $res = $this->jlamp_common_mdl->spRows($spName, $params);
            if (count($res)) {
            } else {
                $result['returnCode'] = 'I001';
                $result['returnMsg'] = '登录记录保存出错';
            }
        } catch (Exception $e) {
            $result['returnCode'] = 'E001';
            $result['returnMsg'] = $e->getMessage();
        }
    }
    public function randomkeys($length)
    {
        $key = '';
        $pattern = '1234567890ABCDEFGHIJKlmnopqrstuvwxyz   
               abcdefghijkLOMNOPQRSTUVWXYZ';
        for ($i = 0; $i < $length; $i++) {
            $key .= $pattern{mt_rand(0, 35)};    //生成php随机数
        }
        return $key;
    }
    public function input($key,$default='',$method = ''){
        if(empty($method)){
            $request = $this->jlamp_comm->xssInput($key, 'get') == '' ? $this->jlamp_comm->xssInput($key, 'post') : $this->jlamp_comm->xssInput($key, 'get');
        }else{
            $request = $this->jlamp_comm->xssInput($key, $method);
        }
        if($request == '') $request = $default;
        return $request;
    }
    public function inputM($key,$method = ''){
        if(empty($method)){
            $request = $this->jlamp_comm->xssInput($key, 'get') == '' ? $this->jlamp_comm->xssInput($key, 'post') : $this->jlamp_comm->xssInput($key, 'get');
        }else{
            $request = $this->jlamp_comm->xssInput($key, $method);
        }
        if($request == ''){
            Helper::setResponse([],300,$key.' empty');
            $this->response();
        }
        return $request;
    }
    public function only($array,$method = ''){
        $request = [];
        if(!empty($method)){
            foreach ($array as $v){
                $request[$v] = $this->input($v,$method);
            }
        }else{
            foreach ($array as $v){
                $request[$v] = $this->input($v);
            }
        }
        return $request;
    }
    //.注册组件
    private function register(){
        $container = Facade::getFacadeApplication();
        if(isset($container)){
            return;
        }
        $libraries = require_once APPPATH.'config/libraries.php';
        $this->load->library('Container');
        $container = new Container();
        $app = array();

        foreach ($libraries as $dir => $Facades){
            foreach ((array)$libraries[$dir] as $k => $v){
                //.注册所有Multi依赖包
                if($dir == 'MultiRely'){
                    $this->load->library($dir.'/'.$v.'/'.$v);
                    $container->bind($k, function($container) use ($v) {
                        return new $v;
                    });
                    $app[$k] = $container->make($k);
                }else{
                    $this->load->library($dir.'/'.$v);
                }
            }

        }
        Facade::setFacadeApplication($app);
    }
    public function response(){
        $this->jlamp_comm->jsonEncEnd(Helper::response(),true);
    }

}
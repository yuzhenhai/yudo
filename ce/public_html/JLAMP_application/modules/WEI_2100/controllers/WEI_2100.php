<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * 클래스명: WEI_1000
 * 작성자: 김목영
 * 클래스설명: 영업집계표(일) 클래스
 *
 * 최초작성일: 2017.11.10
 * 최종수정일: 2017.11.10
 * ---
 * Date         Auth        Desc
 */
class WEI_2100 extends Base {
    private static $systemClass = array(
        'ascause'        => 'AS1011',
        'ascause_c'      => 'AS1015',
        'area'           => 'AS1013',
        'markets'        => 'SA1025',
        'asclass'        => 'AS1002',
        'asclass1'       => 'AS1006',
        'asclass1_c'     => 'AS1007',
        'startpoint'     => 'AS1003',
        'asbadtype'      => 'AS1004',
        'supplyscope'    => 'SA1034',
        'supplyscope_c1' => 'SA1035',
        'supplyscope_c2' => 'SA1036',
        'supplyscope_c3' => 'SA1037',
        'supplyscope_c4' => 'SA1038',
        'supplyscope_c5' => 'SA1039',
    );

	function __construct() {
		parent::__construct();
        $this->load->model('As10_model');
	}

	public function index() {
        $this->getAuth('WEI_2100');
        $this->loginLog('WEI_2100');
        $this->lists();
	}
	/**
	 * 메소드명: lists
	 * 작성자: 김목영
	 * 설 명: 영업집계표(일) 페이지
	 *
	 * 최초작성일: 2017.11.10
	 * 최종수정일: 2017.11.10
	 * ---
	 * Date              Auth        Desc
	 */
	public function lists() {
		$formKey = $this->jlamp_comm->xssInput('formKey','get');
		$menuSelection = $this->jlamp_comm->xssInput('menuSelection', 'get');
		$this->jlamp_comm->isHtmlDisplay(true);
		$this->jlamp_tp->assign(array(
            'formKey' => $formKey,
			'menuSelection' => $menuSelection
		));
        $this->jlamp_tp->define(['tpl' => 'SalesBusinessView/WEI_2100_Lists.html']);
        $this->jlamp_tp->template_dir = VIEWS;
	}
	public function login_user(){
	    $publicQury = new Multi_publicquery();
	    $publicQury->login_user();
        $this->recall_array['data'] = array(
            'userid' => $publicQury->loginId,
            'username' => $publicQury->loginNm,
            'groupid' => $publicQury->groupId,
            'groupname' => $publicQury->groupNm
        );
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
    }
	private function memcached(){
        $memcache = new Memcache;       //创建一个memcache对象
        $memcache->connect('localhost', 11211) or die ("Could not connect"); //连接Memcached服务器
        return $memcache;
    }
	public function mem_set_users($key,$value){
	    $mem = $this->memcached();
        $mem->set($key, $value);
    }
    public function mem_get($key){
        $mem = $this->memcached();
        $get_value = $mem->get($key);
        return $get_value;
    }
    public function mem_get_login($key){
        $mem = $this->memcached();
        $get_value = $mem->get($key);
        $echo = '';
        foreach ($get_value as $value){
            $echo .= '用户id：'.$value['loginNm'].'</br>';
            $echo .= '登录时间：'.$value['loginTime'].'</br>';
            $echo .= '登录Ip：'.$value['loginIp'].'</br>';
        }
        echo $echo;
    }

    //存储用户表到内存
    public function query_users(){
        $sql = "select a.EmpID,a.EmpNm,b.DeptCd,b.DeptNm from TMAEmpy00 a,TMADept00 b 
                where a.DeptCd = b.DeptCd";
        $result = $this->jlamp_common_mdl->sqlRows($sql);
        $result = json_decode(json_encode($result),true);
        $this->mem_set_users('userlist',$result);
    }

    /**
     * AS接收确定
     */
    public function confirm(){
        $loginid =  str_replace(' ','',$this->getCookie('EmpId'));
        $get_asid = $this->jlamp_comm->xssInput('as_id','post');
        $get_cfm  = $this->jlamp_comm->xssInput('cfm','post');
        if(empty($get_asid) || empty($get_cfm)){
            $this->recall_array['data'] = 'I001';
            $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
        }
        $join_param = array(
            array('pWorkingTag',$get_cfm),
            array('pASRecvNo',$get_asid),
            array('pCfmEmpId',$loginid)
        );
        $return_param = array(
            array('wStatus','ok'),
            array('wResults','')
        );
        $res = DB::call($this->DB,'yudo.SASRecvCfm',$join_param,$return_param);
        $msgcd = $res[0]->computed1;
        $sql = "select MsgTxt from TSMMsge10  where MsgCd='$msgcd' and LangCd = '$this->langCode'";
        $result = $this->jlamp_common_mdl->sqlRow($sql);
        $result = json_decode(json_encode($result), true);
        $this->recall_array['data'] = $result['MsgTxt'];
        $this->recall_array['returnCode'] = $res[0]->computed;
        $this->recall_array['returnClass'] = $msgcd;
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
    }

    /**
     * 发送短信
     * @param array $send_id
     * @param array $msg
     */
    public function send_sms($send_id,$msg){
	    // $send_time = '';
     //    Api::set_msg_model('as',$msg);
	    // print_r(Api::send_unicom_message($send_id,$send_time));
    }

    /**
     * 发送OA信息
     * @param $send_to
     * @param $msg
     */
    public function send_oa($send_to,$msg){
//	    $send_to = array(
//	        'L2018002'
//        );
        echo Api::send_oa_msg($msg,$send_to);
    }
    //系统大分类查询
    public function systemclass_big_prc(){
        $big_systemId = $this->jlamp_comm->xssInput('bigsysid', 'get'); // 小分类ID
        $big_systemId = self::$systemClass[$big_systemId];
        $result = $this->As10_model->where(array($big_systemId))->select()->system_class_big($this->langCode);
        $this->recall_array['data'] = $result;
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
    }
    //系统小分类查询
    public function systemclass_mini_prc(){
        $big_systemId = $this->jlamp_comm->xssInput('bigsysid', 'get'); // 大分类ID
        if(empty($big_systemId)){
            $this->recall_array['data'] = array(array());
            $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
        }
        $mini_systemId = $this->jlamp_comm->xssInput('minisysid', 'get'); // 小分类ID
        $mini_systemId = self::$systemClass[$mini_systemId];
        $result = $this->As10_model->where(array($big_systemId,$mini_systemId))->select()->system_class($this->langCode);
        $this->recall_array['data'] = $result;
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
    }

    /**
     * 查询部门列表
     */
    public function group_prc(){
	    $groupNm = $this->jlamp_comm->xssInput('groupnm', 'get');
        $groupId = $this->jlamp_comm->xssInput('groupid', 'get');
        $result = $this->As10_model->where(array($groupId,"%$groupNm%"))->select()->grouplist();
        $this->recall_array['data'] = $result;
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
    }
    //员工查询方法
    public function user_prc()
    {
        $get_username = $this->jlamp_comm->xssInput('username', 'get'); // 订单区分内销外销
        $get_userid = $this->jlamp_comm->xssInput('userid', 'get'); // 订单编号
        $get_groupname = $this->jlamp_comm->xssInput('groupname', 'get'); // 订单区分内销外销
        if(empty($get_username) && empty($get_userid) && empty($get_groupname)){
            $result = $this->As10_model->select()->userlist();
        }
        else
        {
            $result = $this->As10_model->where(array("%$get_username%",$get_userid,"%$get_groupname%"))->select()->userlist();
        }
        $this->recall_array['data'] = $result;
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
    }

    /**
     * 查询客户列表
     */
    public function cust_list(){
	    $get_custnm = $this->jlamp_comm->xssInput('custnm', 'get');
	    $get_custid = $this->jlamp_comm->xssInput('custid', 'get');
        $get_custcount = $this->jlamp_comm->xssInput('custcount','get');
        $this->As10_model->auth($this->getCookie('EmpId'),$this->getCookie('auth',false));
        if($get_custcount > 0){
            $result = $this->As10_model->where(array("$get_custid%%","%$get_custnm%"))->select()->cust_list_more($get_custcount,$this->langCode);
        }
        else
        {
            $result = $this->As10_model->where(array("$get_custid%%","%$get_custnm%"))->select()->cust_list($this->langCode);
        }
        if(count($result[0]) <= 0)
        {
            $this->recall_array['returnCode'] = 'NULL';
        }else{
            $this->recall_array['data'] = $result;
        }
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
    }
    /**
     * 查询AS接收列表
     */
    public function as_prc(){
	    $orderNo = $this->jlamp_comm->xssInput('orderNo', 'get');
	    $asRecvNo = $this->jlamp_comm->xssInput('asRecvNo', 'get');
        $get_custnm = $this->jlamp_comm->xssInput('custnm', 'get');
        $get_userNm = $this->jlamp_comm->xssInput('userNm', 'get');
        $get_ascount = $this->jlamp_comm->xssInput('ascount', 'get');
        $get_asStartDate = $this->jlamp_comm->xssInput('startDate', 'get');
        $get_asEndDate = $this->jlamp_comm->xssInput('endDate', 'get');
        if(!empty($orderNo) || !empty($asRecvNo)){
            $get_asStartDate = '1900-00-00';
            $get_asEndDate = date('Y-m-d',intval(time()));
        }
        $this->As10_model->auth($this->loginUser,$this->auth);
        if($get_ascount == 0){
            $result = $this->As10_model->where(array("$orderNo%","$asRecvNo%","%$get_custnm%","%$get_userNm%"))->select()->aslist($get_asStartDate,$get_asEndDate);
        }
        else {
            $result = $this->As10_model->where(array("$orderNo%","$asRecvNo%","%$get_custnm%","%$get_userNm%"))->select()->aslist_more($get_ascount,$get_asStartDate,$get_asEndDate);
        }
        if(count($result[0]) <= 0)
        {
            $this->recall_array['returnCode'] = 'NULL';
        }else{
            $this->recall_array['data'] = $result;
        }
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
	}

    /**
     * 查询AS详细信息
     */
	public function as_minute(){
        $get_asid = $this->jlamp_comm->xssInput('asid', 'get');
        if(empty($get_asid)){
            $this->recall_array['returnCode'] = 'I001';
            $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
        }
        $result = $this->As10_model->where(array($get_asid))->find()->as_minute($this->langCode);
        $this->recall_array['data'] = $result;
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
    }

    /**
     * AS发生次数大于2次 发送短信给固定用户
     */
    public function as_sendSmsToUser(){
	    $post_asid = $this->jlamp_comm->xssInput('asid', 'post');
        $post_cnt = $this->jlamp_comm->xssInput('cnt', 'post');
        empty($post_cnt) ? $post_cnt = 1 : $post_cnt;
        if(empty($post_asid)){
            $this->recall_array['returnCode'] = 'I001';
            $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
        }
        $result = $this->As10_model->where(array($post_asid,$post_cnt))->find()->as_sendSmsToUser($this->langCode);
        if (empty($result['adminPhone']) || empty($result)){
            $this->recall_array['returnCode'] = 'I850';
            $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
        }
        //电话
        $sendlist = [$result['adminPhone']];
        //职工id
        $sendlist_oa = [$result['adminId']];
        $orderNo  = $result['orderNo'];
        $orderCnt = $result['orderCnt'];
        $trunNm   = $result['trunNm'];
        $empNm    = $result['empNm'];
        $system1  = $result['system1'];
        $system2  = $result['system2'];
        $system3  = $result['system3'];
        $system4  = $result['system4'];
        $msg = ['',"ID No.$orderNo (第 $orderCnt 次) /$trunNm /$empNm /$system1 /$system2 /$system3 /$system4 [ERP系统]"];
        //短信
//        $this->send_sms($sendlist,$msg);
//        $this->as_sendSmsToLeader($post_asid,$post_cnt,$msg);
        //oa
        $this->send_oa($sendlist_oa,$msg);
    }

    /**
     * AS发生次数超过5次 发送短信给领导
     * @param $asid
     * @param $cnt
     * @param $msg
     */
    public function as_sendSmsToLeader($asid,$cnt,$msg){
        if(empty($asid)){
            $this->recall_array['returnCode'] = 'I001';
            $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
        }
        $result = $this->As10_model->select()->as_sendSmsToLeader();
        if (empty($result[0])){
            $this->recall_array['returnCode'] = 'I850';
            $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
        }

        $sendlist = [];
        foreach ($result[0] as $k => $v){
            if(!empty($v['computed2'])){
                if($v['computed3'] <= $cnt){
                    $sendlist[] = $v['computed2'];
                }
            }
        }
        $this->send_sms($sendlist,$msg);
    }

    /**
     * 订单的AS数量
     */
    public function as_count(){
	    $get_orderid = $this->jlamp_comm->xssInput('orderid', 'get');
        if(empty($get_orderid)){
            $this->recall_array['returnCode'] = 'I001';
            $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
        }
        $result = $this->As10_model->find()->as_count($get_orderid);
        $this->recall_array['data'] = $result;
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
    }

    /**
     * AS品目信息列表
     */
    public function as_minute_table(){
        $get_asid = $this->jlamp_comm->xssInput('asid', 'get');
        if(empty($get_asid)){
            $this->recall_array['returnCode'] = 'I001';
            $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
        }
        $result = $this->As10_model->where(array($get_asid))->select()->as_minute_table();
        $this->recall_array['data'] = $result;
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
    }

    /**
     * 品目列表查询
     */
    public function as_item(){
	    $get_itemId = $this->jlamp_comm->xssInput('asitemid', 'get');
        $get_itemNm = $this->jlamp_comm->xssInput('asitemnm', 'get');
        $get_itemPage = $this->jlamp_comm->xssInput('asitempage', 'get');
        if($get_itemPage == 0){
            $result = $this->As10_model->where(array("$get_itemId%%","%$get_itemNm%"))->select()->as_item();
        } else {
            $result = $this->As10_model->where(array("$get_itemId%%","%$get_itemNm%"))->select()->as_item_more($get_itemPage);
        }
        $this->recall_array['data'] = $result;
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
    }

    /**
     * 品目单位列表查询
     */
    public function as_unit(){
        $result = $this->As10_model->select()->as_unit();
        $this->recall_array['data'] = $result;
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
	}

    /**
     * AS接收图片
     */
	public function as_photo(){
	    $get_asid = $this->jlamp_comm->xssInput('asid', 'get');

        $result = $this->As10_model->where(array($get_asid))->select()->object()->as_photo();
        $downimage = new Multi_downimage();
        $image_result = $downimage->id($get_asid)->ftpdir('AS')->localdir('AS')->downloadFile('ASReceipt',$result[0]);
        if($image_result == false)
        {
            $this->recall_array['returnCode'] = 'empty';
        }else if($image_result == 'null'){
            $this->recall_array['returnCode'] = 'empty';
        }
        foreach($result[0] as $k => $v){
            $v->Photo = '';
        }
        $result = json_decode(json_encode($result),true);
        $this->recall_array['data'] = $result;
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
	}

    /**
     * AS接收销售负责人
     */
	public function as_sales(){
        $get_asid = $this->jlamp_comm->xssInput('asid', 'get');
        $result = $this->As10_model->where(array($get_asid))->select()->as_sales();
        $this->recall_array['data'] = $result;
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
    }
    public function test(){
        $seq_result =  $this->As10_model->where(array('2013070158'))->find()->as_photo_seq();
        print_r($seq_result);
    }

    /**
     * 上传AS接收照片
     */
    public function upload_photo(){
        $asNo = $this->jlamp_comm->xssInput('asId', 'post');
        $image = $_POST['imageList'];
        if(is_string($image)){
            $image = json_decode($image);
        }
        $this->load->model('As20_model');
        if (empty($asNo) || empty($image)) {
            $this->recall_array['returnCode'] = 'I994';
            $this->recall_array['returnMsg'] = 'as号/图片不存在';
            $this->jlamp_comm->jsonEncEnd($this->recall_array);
        }
        $date = date('Ymdhis',time());
        $dirYear = substr($asNo,0,4);
        $dirMonth = substr($asNo,4,2);
        $dir = "./image/uploads/AS/ASReceipt/$dirYear"."$dirMonth/$asNo";
        $seq_result = $this->As10_model->where(array($asNo))->find()->as_photo_seq();
        foreach ($image as $k => $v){
            $fileNm = 'M'.$date.rand(100,999);
            $imageDir = Img::resolveImageByBase($v,$dir,$fileNm,1200,1200);
            $uploadRes = Ftp::upload($asNo,$imageDir['fileNm'],$imageDir['dir'],'/AS/ASReceipt');
            if ($uploadRes['modelMsg'] == 'FTP-ERROR') {
                $this->recall_array['returnCode'] = 'FTP';
                $this->recall_array['returnMsg'] = '上传到ftp失败了';
                $this->jlamp_comm->jsonEncEnd($this->recall_array);
            } else if ($uploadRes['modelMsg'] == 'UPLOAD-ERROR') {
                $this->recall_array['returnCode'] = 'UPLOADERR';
                $this->recall_array['returnMsg'] = '上传到服务器失败了';
                $this->jlamp_comm->jsonEncEnd($this->recall_array);
            }
            //上传成功，存储图片名到数据库
            else {
                if (empty($seq_result['Seq'])) {
                    $seq_result['Seq'] = '01';
                }
                else {
                    if ($seq_result['Seq'] >= 9) {
                        $seq_result['Seq'] = $seq_result['Seq'] + 1;
                    }
                    else {
                        $seq_result['Seq'] = '0' . ($seq_result['Seq'] + 1);
                    }
                }
                $add = array(
                    'ASRecvNo' => $asNo,
                    'Seq'    => $seq_result['Seq'],
                    'FileNm' => $imageDir['fileNm'],
                    'RegEmpID' => $this->getCookie('EmpId'),
                    'RegDate'  => 'date(now)',
                    'UptEmpId' => $this->getCookie('EmpId'),
                    'UptDate'  => 'date(now)',
                    'FTP_UseYn' => 'Y'
                );
                try{
                    $res = $this->As20_model->table('TASRecv20')->add($add);
                    $this->recall_array['data'][] = $imageDir['fileNm'];
                }catch (Exception $e){
                    $this->recall_array['returnCode'] = 'netWorkError';
                    $this->jlamp_comm->jsonEncEnd($this->recall_array);
                }
            }
        }
        $this->jlamp_comm->jsonEncEnd($this->recall_array);
    }
    //技术规范列表查询
    public function spec_prc(){
	    $get_speccount = $this->jlamp_comm->xssInput('speccount','get');
        $get_custnm = $this->jlamp_comm->xssInput('custnm', 'get'); //客户名称
        $get_specid = $this->jlamp_comm->xssInput('specid', 'get'); //编号
        if($get_speccount == 0){
            $result = $this->As10_model->where(array("$get_specid%%","%$get_custnm%"))->select()->speclist();
        }
        else
        {
            $result = $this->As10_model->where(array("$get_specid%%","%$get_custnm%"))->select()->speclist_more($get_speccount);
        }
        if(count($result[0]) <= 0)
        {
            $this->recall_array['returnCode'] = 'NULL';
        }else{
            $this->recall_array['data'] = $result;
        }
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
	}

    /**
     * 技术规范详细信息
     */
	public function spec_minute(){
	    $get_specid = $this->jlamp_comm->xssInput('specid', 'get');
        $result = $this->As10_model->where(array($get_specid))->find()->spec_minute($this->langCode);
        $this->recall_array['data'] = $result;
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
    }

    /**
     * 订单详细信息
     */
    public function order_minute(){
        $get_orderid = $this->jlamp_comm->xssInput('orderid', 'get');
        if(empty($get_orderid)){
            $this->recall_array['returnCode'] = 'I001';
            $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
        }
        $result = $this->As10_model->find()->order_minute($get_orderid,$this->langCode);
        $this->recall_array['data'] = $result;
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
    }
    //订单查询方法
    public function order_prc(){
        $get_ordercount = $this->jlamp_comm->xssInput('ordercount','get'); //加载更多
        $get_orderby = $this->jlamp_comm->xssInput('orderby', 'get'); //客户名称
        $get_orderid = $this->jlamp_comm->xssInput('orderid', 'get'); //订单编号
        $this->As10_model->auth($this->getCookie('EmpId'),$this->getCookie('auth',false));
        if($get_ordercount == 0){
            $result = $this->As10_model->where(array("%$get_orderby%","$get_orderid%%"))->select()->orderlist($this->langCode);
        }
        else
        {
            $result = $this->As10_model->where(array("%$get_orderby%","$get_orderid%%"))->select()->orderlist_more($this->langCode,$get_ordercount);
        }
        if(count($result[0]) <= 0)
        {
            $this->recall_array['returnCode'] = 'NULL';
        }else{
            $this->recall_array['data'] = $result;
        }
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
    }
    //提交OA审批
    public function subAdjudication(){
        $post_asid = $this->jlamp_comm->xssInput('asid', 'post');
        $asUserId = $this->jlamp_comm->xssInput('asUserId', 'post');
        $login_id = $this->getCookie('EmpId');
        if(empty($post_asid) || empty($asUserId)){
            $this->recall_array['returnCode'] = 'I994';
            $this->recall_array['returnMsg'] = 'as号/职员信息不存在';
            $this->jlamp_comm->jsonEncEnd($this->recall_array);
        }
        $add = array(
            'SourceType'  => '001',
            'SourceNo'    => $post_asid,
            'SP_Contents' => "execute yudo.SASRecvCfm '+''''+'CA'+''''+','+''''+'$post_asid'+''''+','+''''+'$asUserId'+'''",
            'OA_Status'   => '0',
            'RegEmpID'    => $login_id,
            'RegDate'     => 'date(now)',
            'UptEmpID'    => $login_id,
            'UptDate'     => 'date(now)'
        );
        $query = $this->As10_model->table('TS_OA_Interface')->field('SourceNo')->where(array('SourceNo' => $post_asid,'SourceType'  => '001'))->find();
        if(!empty($query['SourceNo'])){
            $this->recall_array['returnCode'] = 'I451';
            $this->recall_array['returnMsg'] = '裁决已经存在';
            $this->jlamp_comm->jsonEncEnd($this->recall_array);
        }
        $this->load->model('As20_model');
        $this->As20_model->table('TS_OA_Interface')->add($add);
        $save = array(
          'Status' => 'A',
          'ApprUseYn' => '1'
        );
        $this->As20_model->table('TASRecv00')->where(array('ASRecvNo' => $post_asid))->save($save);
        $this->recall_array['data'] = $post_asid;
        $this->jlamp_comm->jsonEncEnd($this->recall_array);
	}
	//取消OA审批
    public function unSubAdjudication(){
        $post_asid = $this->jlamp_comm->xssInput('asid', 'post'); //客户名称
        if(empty($post_asid)){
            $this->recall_array['returnCode'] = 'I994';
            $this->recall_array['returnMsg'] = 'as号不存在';
            $this->jlamp_comm->jsonEncEnd($this->recall_array);
        }
        $where = array(
            'SourceType'  => '001',
            'SourceNo'    => $post_asid,
        );
        $query = $this->As10_model->table('TS_OA_Interface')->field('SourceNo,OA_Status')->where(array('SourceNo' => $post_asid,'SourceType'  => '001'))->find();
        if(empty($query['SourceNo'])){
            $this->recall_array['returnCode'] = 'I450';
            $this->recall_array['returnMsg'] = '当前AS还没有申请裁决';
            $this->jlamp_comm->jsonEncEnd($this->recall_array);
        }
        elseif($query['OA_Status'] != '5'){
            $this->recall_array['returnCode'] = 'I452';
            $this->recall_array['returnMsg'] = '不可取消正在进行中的裁决';
            $this->jlamp_comm->jsonEncEnd($this->recall_array);
        }
        $this->load->model('As20_model');
        $res = $this->As20_model->table('TS_OA_Interface')->where($where)->delete();
        $save = array(
            'Status' => '0',
            'ApprUseYn' => '0'
        );
        $this->As20_model->table('TASRecv00')->where(array('ASRecvNo' => $post_asid))->save($save);
        $this->jlamp_comm->jsonEncEnd($this->recall_array);
    }

    /**
     * 保存AS接收品目信息
     */
    public function save_astable(){
        $post_asid       = $this->jlamp_comm->xssInput('asid', 'post');
        $post_Sort       = $this->jlamp_comm->xssInput('Sort', 'post');
        $post_ASRecvSerl = $this->jlamp_comm->xssInput('ASRecvSerl', 'post');
        $post_SpareYn    = $this->jlamp_comm->xssInput('SpareYn', 'post');
        $post_ItemCd     = $this->jlamp_comm->xssInput('ItemCd', 'post');
        $post_UnitCd     = $this->jlamp_comm->xssInput('UnitCd', 'post');
        $post_Qty        = $this->jlamp_comm->xssInput('Qty', 'post');
        $post_NextQty    = $this->jlamp_comm->xssInput('NextQty', 'post');
        $post_StopQty    = $this->jlamp_comm->xssInput('StopQty', 'post');
        $post_ChargeYn   = $this->jlamp_comm->xssInput('ChargeYn', 'post');
        $post_Remark     = $this->jlamp_comm->xssInput('Remark', 'post');
        //add
        if(empty($post_ASRecvSerl)){
            $checkSort = $this->As10_model->table('TASRecv10')->field('Sort')->where(array('ASRecvNo' => $post_asid,'Sort' => $post_Sort))->find();
            if(!empty($checkSort['Sort'])){
                $this->jlamp_comm->jsonEncEnd($checkSort);
            }
            $ASRecvSerl = $this->As10_model->table('')->where(array($post_asid))->find()->as_minute_Seq();
            if(empty($ASRecvSerl))
            {
                $ASRecvSerl = '0001';
            }
            else
            {
                if($ASRecvSerl['ASRecvSerl'] >= 9)
                {
                    $ASRecvSerl = '00'.($ASRecvSerl['ASRecvSerl'] + 1);
                }
                else
                {
                    $ASRecvSerl = '000'.($ASRecvSerl['ASRecvSerl'] + 1);
                }
            }
            $add = array(
                'ASRecvNo'    => $post_asid,
                'ASRecvSerl'  => $ASRecvSerl,
                'Sort'        => $post_Sort,
                'SpareYn'     => $post_SpareYn,
                'ItemCd'      => $post_ItemCd,
                'UnitCd'      => $post_UnitCd,
                'Qty'         => $post_Qty,
                'NextQty'     => $post_NextQty,
                'StopQty'     => $post_StopQty,
                'ChargeYn'    => $post_ChargeYn,
                'Remark'      => array($post_Remark,'utf-8')
            );
            $this->load->model('As20_model');
            $res = $this->As20_model->table('TASRecv10')->add($add);
        }
        //save
        else
        {
            $save = array(
                'ASRecvNo'    => $post_asid,
                'Sort'        => $post_Sort,
                'SpareYn'     => $post_SpareYn,
                'ItemCd'      => $post_ItemCd,
                'UnitCd'      => $post_UnitCd,
                'Qty'         => $post_Qty,
                'NextQty'     => $post_NextQty,
                'StopQty'     => $post_StopQty,
                'ChargeYn'    => $post_ChargeYn,
                'Remark'      => array($post_Remark,'utf-8')
            );
            $where = array(
                'ASRecvNo' => $post_asid,
                'ASRecvSerl' => $post_ASRecvSerl,
            );
            $this->load->model('As20_model');
            $res = $this->As20_model->table('TASRecv10')->where($where)->save($save);
        }
        $this->jlamp_comm->jsonEncEnd(array($res));
    }

    /**
     * 保存AS接收销售负责人信息
     */
    public function save_sales(){
        $post_sales = $this->jlamp_comm->xssInput('sales', 'post');
        $post_sales = str_replace(' ','',$post_sales);
        $post_asid  = $this->jlamp_comm->xssInput('asid', 'post');

        if(empty($post_asid)){
            $this->recall_array['returnCode'] = 'I001';
            $this->recall_array['returnMsg'] = 'as号不存在';
            $this->jlamp_comm->jsonEncEnd($this->recall_array);
        }
        if(empty($post_sales)){
            $this->recall_array['returnCode'] = 'I001';
            $this->recall_array['returnMsg'] = '销售负责人不存在';
            $this->jlamp_comm->jsonEncEnd($this->recall_array);
        }
        $login_id = $this->getCookie('EmpId');
        $this->load->model('As20_model');
//        $post_sales = explode('#%#',$post_sales);
        $post_sales = [$post_sales];
        $Seq = $this->As10_model->table('TASRecv30')->field('Seq')->where(array('ASRecvNo' => $post_asid))->order('Seq,desc')->find();
        if(empty($Seq)){
            $SeqAppend = 0;
        }
        else
        {
            $SeqAppend = $Seq['Seq'];
        }
        foreach($post_sales as $k => $v){
            $queryres = $this->As10_model->table('TASRecv30')->field('SaleEmpID')->where(array('SaleEmpID' => $v,'ASRecvNo' => $post_asid))->find();
            if(empty($queryres)){
                if($SeqAppend >= 9){
                    $SeqAppend = $SeqAppend + 1;
                }
                else
                {
                    $SeqAppend = '0'.($SeqAppend+1);
                }
                $add = array(
                    'ASRecvNo'  => $post_asid,
                    'Seq'       => $SeqAppend,
                    'SaleEmpID' => $v,
                    'Remark'    => '',
                    'RegEmpID'  => $login_id,
                    'RegDate'   => 'date(now)',
                    'UptEmpID'  => $login_id,
                    'UptDate'   => 'date(now)',
                );
                $addres = $this->As20_model->table('TASRecv30')->add($add);
            }
            else
            {
                $this->recall_array['returnCode'] = 'I828';
                $this->recall_array['returnMsg'] = '销售负责人已经存在';
                $this->jlamp_comm->jsonEncEnd($this->recall_array);
            }
        }
        $this->jlamp_comm->jsonEncEnd($this->recall_array);
    }

    /**
     * 保存AS接收信息
     */
    public function save_as(){
        $login_id = $this->getCookie('EmpId');
        //order
        $post_specid           = $this->jlamp_comm->xssInput('specid', 'post');
        $post_spectype         = $this->jlamp_comm->xssInput('spectype', 'post');
        $post_custprsn         = $this->jlamp_comm->xssInput('custprsn',  'post');
        $post_custtell         = $this->jlamp_comm->xssInput('custtell',  'post');
        $post_custemail        = $this->jlamp_comm->xssInput('custemail', 'post');
        $post_olddrawno        = $this->jlamp_comm->xssInput('olddrawno', 'post');
        $post_olddrawamd       = $this->jlamp_comm->xssInput('olddrawamd','post');
        $post_exclass          = $this->jlamp_comm->xssInput('exclass','post');
        $post_modelid          = $this->jlamp_comm->xssInput('modelid','post');
        $post_gateno           = $this->jlamp_comm->xssInput('gateno', 'post');
        $post_ordertype        = $this->jlamp_comm->xssInput('ordertype','post');
        $post_goodnm           = $this->jlamp_comm->xssInput('goodnm', 'post');
        $post_ordergubun       = $this->jlamp_comm->xssInput('ordergubun', 'post');
        //as
        $post_orderno          = $this->jlamp_comm->xssInput('orderno',  'post');
        $post_asid             = $this->jlamp_comm->xssInput('asid',     'post');
        $post_custid           = $this->jlamp_comm->xssInput('custid',   'post');
        $post_markets          = $this->jlamp_comm->xssInput('markets',  'post');
        $post_asclass          = $this->jlamp_comm->xssInput('asclass',  'post');
        $post_asgetdate        = $this->jlamp_comm->xssInput('asgetdate','post');
        $post_assetdate        = $this->jlamp_comm->xssInput('assetdate','post');
        $post_asuserid         = $this->jlamp_comm->xssInput('asuserid', 'post');
        $post_asgroupid        = $this->jlamp_comm->xssInput('asgroupid','post');
        $post_asplastic        = $this->jlamp_comm->xssInput('asplastic','post');
        $post_ascause          = $this->jlamp_comm->xssInput('ascause',  'post');
        $post_asbadtype        = $this->jlamp_comm->xssInput('asbadtype','post');
        $post_asallclass       = $this->jlamp_comm->xssInput('asallclass',    'post');
        $post_asdutyclass      = $this->jlamp_comm->xssInput('asdutyclass',   'post');
        $post_asappearance     = $this->jlamp_comm->xssInput('asappearance',  'post');
        $post_asreasonclass    = $this->jlamp_comm->xssInput('asreasonclass', 'post');
        $post_asserviceclass   = $this->jlamp_comm->xssInput('asserviceclass','post');
        $post_asservicearea    = $this->jlamp_comm->xssInput('asservicearea', 'post');
        $post_ascount          = $this->jlamp_comm->xssInput('ordercnt', 'post');

        //system
        $post_supplyscope      = $this->jlamp_comm->xssInput('supplyscope', 'post');
        $post_hrs              = $this->jlamp_comm->xssInput('hrs', 'post');
        $post_manifoldtype     = $this->jlamp_comm->xssInput('manifoldtype', 'post');
        $post_systemsize       = $this->jlamp_comm->xssInput('systemsize', 'post');
        $post_systemtype       = $this->jlamp_comm->xssInput('systemtype', 'post');
        $post_gatetype         = $this->jlamp_comm->xssInput('gatetype', 'post');

        //switch1
        $post_trans            = $this->jlamp_comm->xssInput('trans', 'post');
        $post_transDeptCd      = $this->jlamp_comm->xssInput('transDeptCd', 'post');
        $post_confirm          = $this->jlamp_comm->xssInput('confirm', 'post');
//        $post_apt              = $this->jlamp_comm->xssInput('apt', 'post');
        $post_charge           = $this->jlamp_comm->xssInput('charge', 'post');
        $post_itemreturn       = $this->jlamp_comm->xssInput('itemreturn', 'post');
//        $post_product          = $this->jlamp_comm->xssInput('product', 'post');

        //text
        $post_text1            = $this->jlamp_comm->xssInput('text1', 'post');
        $post_text2            = $this->jlamp_comm->xssInput('text2', 'post');
        $post_text3            = $this->jlamp_comm->xssInput('text3', 'post');
        $post_text4            = $this->jlamp_comm->xssInput('text4', 'post');

        $jobno = $this->As10_model->find()->as_jobno($post_asuserid);
        $isUpdate = 0;
        //判断新旧ERP
        $post_orderno == 'noorder' ? $post_orderno = '': $post_orderno;

        //判断生成asid还是更新asid
        if($post_asid == 'noid'){
            $asid = date('Ym',intval(time()));
            $sql = "select top 1 ASRecvNo from TASRecv00 where ASRecvNo LIKE '$asid%%' order by ASRecvNo desc";
            $result_asid = $this->jlamp_common_mdl->sqlRow($sql);
            //如果当月还没有组装号
            if(empty($result_asid))
            {
                $post_asid = $asid.'0001';
            }
            else
            {
                $result_asid = substr($result_asid->ASRecvNo,6);
                $asid .= $result_asid;
                $post_asid = $asid +1;
            }
        }
        else
        {
            $isUpdate = 1;
        }
        $add = array(
            'OrderNo'           => $post_orderno,
            'SpecNo'            => $post_specid,
            'SpecType'          => $post_spectype,
            'ASRecvNo'          => $post_asid,
            'OrderGubun'        => $post_ordergubun, //新旧区分
            'MarketCd'          => $post_markets,
            'AStype'            => $post_asclass,
            'ASRecvDate'        => $post_asgetdate,
            'ASDelvDate'        => $post_assetdate,
            'EmpId'             => $post_asuserid,
            'DeptCd'            => $post_asgroupid,
            'CustCd'            => $post_custid,
            'Resin'             => array($post_asplastic,'utf-8'),
            'OCCpoint'          => $post_ascause,
            'ASBadType'         => $post_asbadtype,
            'ASCauseDonor'      => $post_asallclass,
            'DutyGubun'         => $post_asdutyclass,
            'ASClass1'          => $post_asappearance,
            'ASClass2'          => $post_asreasonclass,
            'ASAreaGubun'       => $post_asserviceclass,
            'ASArea'            => array($post_asservicearea,'utf-8'),

            'CustPrsn'          => array($post_custprsn,'utf-8'),
            'CustTell'          => array($post_custtell,'utf-8'),
            'CustEmail'         => array($post_custemail,'utf-8'),
            'OldDrawNo'         => $post_olddrawno,
            'OldDrawAmd'        => $post_olddrawamd,
            'ExpClss'           => $post_exclass,
            'RefNo'             => array($post_modelid,'utf-8'),
            'GateQty'           => $post_gateno,
            'GoodNm'            => array($post_goodnm,'utf-8'),     // 客户产品名称
            'JobNo'             => $jobno['JobNo'],

            'SupplyScope'       => $post_supplyscope,
            'HRSystem'          => $post_hrs,
            'ManifoldType'      => $post_manifoldtype,
            'SystemSize'        => $post_systemsize,
            'SystemType'        => $post_systemtype,
            'GateType'          => $post_gatetype,

            'TransYn'           => $post_trans,
            'TransDeptCd'       => $post_transDeptCd,
//            'CfmYn'             => $post_confirm,
//            'AptYn'             => $post_apt,
            'AptEmpId'          => $login_id,
            'AptDate'           => 'date(now)',
            'ChargeYn'          => $post_charge,
            'ItemReturnYn'      => $post_itemreturn,
//            'ProductYn'         => $post_product,

            'ASStateRemark'     => array($post_text1,'utf-8'),
            'ASCauseRemark'     => array($post_text2,'utf-8'),
            'ASSolve'           => array($post_text3,'utf-8'),
            'Remark'            => array($post_text4,'utf-8'),

            'RegEmpID'          => $login_id,
            'RegDate'           => 'date(now)',
            'UptEmpID'          => $login_id,
            'UptDate'           => 'date(now)'
        );
        $this->load->model('As20_model');
        if($isUpdate == 0){
            $add['OrderCnt'] = $post_ascount+1;
            $add['SysRemark'] = 'mobile-info';
            $res = $this->As20_model->table('TASRecv00')->add($add);
            $this->recall_array['returnCode'] = 'Y001';
            $this->recall_array['data'] = $post_asid;
        }
        else
        {
            $where = array(
                'ASRecvNo' => $post_asid
            );
            unset($add['ASRecvNo']);
            $res = $this->As20_model->table('TASRecv00')->where($where)->save($add);
            $this->recall_array['returnCode'] = 'Y003';
            $this->recall_array['data'] = $post_asid;
        }
        $this->jlamp_comm->jsonEncEnd($this->recall_array);


    }

    /**
     * 删除AS接收品目列表
     */
    public function del_astable(){
        $post_asid       = $this->jlamp_comm->xssInput('asid', 'post');
        $post_ASRecvSerl = $this->jlamp_comm->xssInput('ASRecvSerl', 'post');
        $where = array(
            'ASRecvNo' => $post_asid,
            'ASRecvSerl' => $post_ASRecvSerl,
        );
        $this->load->model('As20_model');
        $res = $this->As20_model->table('TASRecv10')->where($where)->delete();
        $this->jlamp_comm->jsonEncEnd(array($res));
    }

    /**
     * 删除AS接收销售负责人列表
     */
    public function del_sales(){
        $post_asid = $this->jlamp_comm->xssInput('asid', 'post');
        $post_Seq = $this->jlamp_comm->xssInput('Seq', 'post');
        $where = array(
            'ASRecvNo' => $post_asid,
            'Seq'      => $post_Seq
        );
        $this->load->model('As20_model');
        $res = $this->As20_model->table('TASRecv30')->where($where)->delete();
        $this->jlamp_comm->jsonEncEnd(array($res));
    }

    /**
     * 删除AS接收照片
     */
    public function del_photo(){
        $post_asid = $this->jlamp_comm->xssInput('asid', 'post');
        $post_Seq = $this->jlamp_comm->xssInput('Seq', 'post');
	    $post_fileNm = $this->jlamp_comm->xssInput('fileNm', 'post');
	    $where = array(
            'ASRecvNo' => $post_asid,
            'Seq'      => $post_Seq,
            'fileNm'   => $post_fileNm
        );
        $this->load->model('As20_model');
        $res = $this->As20_model->table('TASRecv20')->where($where)->delete();
        $this->jlamp_comm->jsonEncEnd(array($res));
    }

    /**
     * 获取AS接收的订单信息
     */
    public function getAsOrderInfo(){
        $asRecvNo = $this->inputM('asRecvNo');
        $model = new Order10_model();
        $result = $model->getAsOrderInfo($asRecvNo,'',$this->langCode);
        if(empty($result)){
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }

    /**
     * 获取AS生产信息
     */
    public function getAsProductInfo(){
        $sourceNo   = $this->inputM('asRecvNo');
        $model = new ProductDate10_model();
        $result = $model->getAsProductInfo($sourceNo);
        if(empty($result)){
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }

    /**
     * 获取AS出库信息
     */
    public function getInvoiceInfo(){
        $sourceNo   = $this->inputM('sourceNo');
        $sourceType = $this->inputM('sourceType');
        $model = new Invoice10_model();
        $result = $model->getInvoiceInfo($sourceNo,$sourceType,$this->langCode);
        if(empty($result)){
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }
    //.查询AS处理列表
    public function getAsHandle(){
        $asHandleNo = $this->input('asHandleNo');
        $asHandleStartDate = $this->input('asHandleStartDate');
        $asHandleEndDate = $this->input('asHandleEndDate');
        $custNm = $this->input('custNm');
        $count = $this->inputM('count');
        $asProcModel = new AsProc10_model();
        $authModel = new Auth_model();
        $auth = $authModel->getAuth(parent::getCookie('auth',false),parent::getCookie('UserID'));
        $result = $asProcModel->getAsHandle($asHandleNo,$asHandleStartDate,$asHandleEndDate,$custNm,$count,$this->langCode,$auth);
        if(empty($result[0])){
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }

    //.查询AS处理详细信息
    public function getAsHandleInfo(){
        $asHandelNo = $this->inputM('asHandleNo');
        $model = new AsProc10_model();
        $result = $model->getAsHandleInfo($asHandelNo,$this->langCode);
        if(empty($result)){
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }

    //.查询AS处理品目信息
    public function getAsHandleItem(){
        $asHandelNo = $this->inputM('asHandleNo');
        $model = new AsProc10_model();
        $result = $model->getAsHandleItem($asHandelNo);
        if(empty($result)){
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }

    //.保存AS处理信息
    public function setAsHandleInfo(){
        $asHandleNo = $this->input('ASNo');
        $ASDate = $this->inputM('ASDate');
        $ASRecvNo = $this->inputM('ASRecvNo');
        $EmpId = $this->inputM('EmpId');
        $DeptCd = $this->inputM('DeptCd');
        $CustCd = $this->inputM('CustCd');
        $ASKind = $this->inputM('ASKind');//AS类型
        $ASProcKind = $this->inputM('ASProcKind');//AS处理区分
        $ProcResult = $this->inputM('ProcResult');//AS处理结果
        $ASAmt = $this->inputM('ASAmt');//所需配件费用
        $ASRepairAmt = $this->inputM('ASRepairAmt');//修理费
        $ASAreaGubun = $this->inputM('ASAreaGubun');//服务地区区分
        $ASArea = $this->input('ASArea');//服务地点
        $ItemReturnYn = $this->inputM('ItemReturnYn');//部品反回与否
        $ItemReturnGubun = $this->inputM('ItemReturnGubun');//部品返还区分
        $ChargeYn = $this->inputM('ChargeYn');//收费与否
        $ASNote = $this->input('ASNote');//AS处理详细
        $ProcResultReason = $this->input('ProcResultReason');//AS处理结果原因
        $CustOpinion = $this->input('CustOpinion');//客户意见
        $Remark = $this->input('Remark');//备注
        $ProcPerson = $this->input('ProcPerson');//经办人
        $TransLine = $this->input('TransLine');//行驶里程
        $ArrivalTime = $this->input('ArrivalTime');//抵达时间
        $StartTime = $this->input('StartTime');//离开时间
        $itemList = $this->input('itemList');
        $model = new Multi_dbExecute();
        $query = new AsProc10_model();
        //        $hasProc = DB::queryRow("select ASNo from TASProc00 where ASNo = '%s'",[$asHandleNo]);
        $add = [
            'ASNo' => $asHandleNo,
            'ASDate' => $ASDate,
            'ASRecvNo' => $ASRecvNo,
            'EmpId' => $EmpId,
            'JobNo' => '',
            'DeptCd' => $DeptCd,
            'CustCd' => $CustCd,
            'ASKind' => $ASKind,//AS类型
            'ASProcKind' => $ASProcKind,//AS处理区分
            'ProcResult' => $ProcResult,//AS处理结果
            'ASAmt' => $ASAmt,//所需配件费用
            'ASRepairAmt' => $ASRepairAmt,//修理费
            'ASAreaGubun' => $ASAreaGubun,//服务地区区分
            'ASArea' => [$ASArea,'utf-8'],//服务地点
            'ItemReturnYn' => $ItemReturnYn,//部品反回与否
            'ItemReturnGubun' => $ItemReturnGubun,//部品返还区分
            'ChargeYn' => $ChargeYn,//收费与否
            'ASNote' => [$ASNote,'utf-8'],//AS处理详细
            'ProcResultReason' => [$ProcResultReason,'utf-8'],//AS处理结果原因
            'CustOpinion' => [$CustOpinion,'utf-8'],//客户意见
            'Remark' => [$Remark,'utf-8'],//备注
            'ProcPerson' => [$ProcPerson,'utf-8'],//经办人
            'TransLine' => [$TransLine,'utf-8'],//行驶里程
            'ArrivalTime' => $ArrivalTime,//抵达时间
            'StartTime' => $StartTime,//离开时间
            'RegEmpID' => $this->loginUser,
            'RegDate' => 'date(now)',
            'UptEmpID' => $this->loginUser,
            'UptDate'  => 'date(now)'
        ];
        $date = date('Ym',time());
        if($asHandleNo == ''){
            try{
                $lastAsHandle = $query->getLastAsHandle();
                if(empty($lastAsHandle)){
                    $add['ASNo'] = $date.'0001';
                }else{
                    $add['ASNo'] = $lastAsHandle['ASNo']+1;
                }
                $asHandleNo = $add['ASNo'];
                $result = $model->table('TASProc00')->add($add);
                Helper::responseData($add['ASNo']);
            }catch (Exception $exception){
                Helper::responseAddErr();
            }
        }else{
            unset($add['ASNo']);
            unset($add['RegEmpID']);
            unset($add['RegDate']);
            try{
                $result = $model->table('TASProc00')->where(['ASNo' => $asHandleNo])->save($add);
            }catch (Exception $exception){
                Helper::responseSaveErr();
            }
        }
        if(!empty($itemList)){
            foreach ($itemList as $k => $v){
                $itemAdd = [
                    'ASNo'   => $asHandleNo,
                    'ASSerl' => $v['ASSerl'],
                    'ItemCd' => $v['ItemCd'],
                    'UnitCd' => $v['UnitCd'],
                    'Qty'    => $v['Qty'],
                    'ASRepairAmt' => $v['ASRepairAmt'],
                    'Amt'         => $v['Amt'],
                    'ChargeYn'    => $v['ChargeYn'],
                    'ReUseYn'     => $v['ReUseYn'],
                    'ASRecvNo'    => $ASRecvNo,
                    'ASRecvSerl'  => $v['ASSerl'],
                    'Remark'      => [$v['Remark'],'utf-8'],
                ];
                if($v['isAsHandle'] == 1){
                    unset($itemAdd['ASRecvNo']);
                    unset($itemAdd['ASRecvSerl']);
                }

                $model = new AsProc10_model();
                $execute = new AsProc20_model();
                $item = $model->getAsHandleItem($asHandleNo,$v['ASSerl']);
                if(empty($item[0])){
                    $execute->addAsHandleItem($itemAdd);
                }else{
                    $execute->setAsHandleItem($asHandleNo,$itemAdd);
                }

            }
        }

        $this->response();
    }

    //.检查当前AS接受是否已经存在AS处理单
    public function getAsHandleByAsRecvNo(){
        $asRecvNo = $this->inputM('asRecvNo');
        $model = new AsProc10_model();
        $result = $model->getAsHandleByAsRecvNo($asRecvNo);
        if(empty($result)){
            Helper::responseEmpty();
            $this->response();
        }
        $asHandleInfo = $model->getAsHandleInfo($result['ASNo'],$this->langCode);
        if(empty($asHandleInfo)){
            Helper::responseEmpty();
        }
        Helper::responseData($asHandleInfo);
        $this->response();
    }

    //.AS处理确定
    public function asHandleCfm(){
        $workingTag = $this->inputM('workingTag');
        $asHandleNo = $this->inputM('asHandleNo');
        $input = [
            ['pWorkingTag',$workingTag],
            ['pASNo',$asHandleNo],
            ['pCfmEmpId',$this->loginUser]
        ];
        $outuut = [];
        $result = DB::call($this->DB,'yudo.SASProcCfm',$input,$outuut);
        $msgCd = $result[0]->computed1;
        $returnMsg = DB::queryRow("select MsgTxt from TSMMsge10  where MsgCd = '%s' and LangCd = '%s'", [$msgCd, $this->langCode]);
        Helper::setResponse($returnMsg['MsgTxt'], $result[0]->computed, '', $msgCd);
        $this->response();
    }
}
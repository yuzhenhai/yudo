<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * ????: WEI_1000
 * ???: ???
 * ?????: ?????(?) ???
 *
 * ?????: 2017.11.10
 * ?????: 2017.11.10
 * ---
 * Date         Auth        Desc
 */
class WEI_2200 extends Base {
    private static $systemClass = array(
        'actGubun'        => 'OA1001',
        'actGubunClass'   => 'OA1002',
        'reptActGubunClass' => 'OA1002',
        'CustPattern'     => 'OA2001',
    );

	function __construct() {
		parent::__construct();
        $this->load->model('Worker10_model');
	}

	public function index() {
        $this->getAuth('WEI_2200');
        $this->loginLog('WEI_2200');
		$this->lists();
	}

	public function lists() {
		$formKey = $this->jlamp_comm->xssInput('formKey','get');
		$menuSelection = $this->jlamp_comm->xssInput('menuSelection', 'get');

		$this->jlamp_comm->isHtmlDisplay(true);

		$this->jlamp_tp->assign(array(
            'formKey' => $formKey,
			'menuSelection' => $menuSelection
		));
        $this->jlamp_tp->define(['tpl' => 'SalesBusinessView/WEI_2200_Lists.html']);
        $this->jlamp_tp->template_dir = VIEWS;
	}
	public function getGps(){
        $lng  = $this->jlamp_comm->xssInput('lng','get');
        $lat = $this->jlamp_comm->xssInput('lat','get');
        $planNo = $this->jlamp_comm->xssInput('planNo','get');
        if(empty($planNo)){
            $this->recall_array['returnCode'] = 'I001';
            $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
        }
        $res = Api::geocoder($lng,$lat);
        if($res->status== 0){
            $this->recall_array['data'] = $res->result->formatted_address;
        }else{
            $this->recall_array['returnCode'] = 'Err';
            $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
        }
        $save = array(
            'LocationAddr' => array($res->result->formatted_address,'utf-8'),
            'LocationInYn' => 'Y',
            'LocationUseYn' => 'Y',
            'UptEmpId'      => $this->getCookie('EmpId'),
            'UptDate'       => 'date(now)',
        );
        try {
            $this->load->model('Worker20_model');
            $res = $this->Worker20_model->table('TOAActPlan00')->where(array('ActPlanNo' => $planNo))->save($save);
            $this->jlamp_comm->jsonEncEnd($this->recall_array, true);
        }catch (Exception $e){
            $this->recall_array['returnCode'] = 'Err';
            $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
        }
    }
    public function getPlanOrReptCount(){
        $startDate = $this->jlamp_comm->xssInput('startDate','get');
        $endDate  = $this->jlamp_comm->xssInput('endDate','get');
        $result = $this->Worker10_model->select()->getPlanOrReptCount($startDate,$endDate);
        if(empty($result[0])){
            $this->recall_array['returnCode'] = 'NULL';
        }else{
            $this->recall_array['data'] = $result;
        }
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
    }
	public function login_user(){
	    $publicQuery = new Multi_publicquery();
	    $publicQuery->login_user();
        $this->recall_array['data'] = array(
            'userid' => $publicQuery->loginId,
            'username' => $publicQuery->loginNm,
            'groupid' => $publicQuery->groupId,
            'groupname' => $publicQuery->groupNm
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
    public function mem_get_users($key){
        $mem = $this->memcached();
        $get_value = $mem->get($key);
        return $get_value;
    }
    //存储用户表到内存
    public function query_users(){
        $sql = "select a.EmpID,a.EmpNm,b.DeptCd,b.DeptNm from TMAEmpy00 a,TMADept00 b 
                where a.DeptCd = b.DeptCd";
        $result = $this->jlamp_common_mdl->sqlRows($sql);
        $result = json_decode(json_encode($result),true);
        $this->mem_set_users('userlist',$result);
    }
    public function reptConfirm(){
        $loginid =  str_replace(' ','',$this->getCookie('EmpId'));
        $reptNo= $this->jlamp_comm->xssInput('reptNo','post');
        $reptPlanNo = $this->jlamp_comm->xssInput('reptPlanNo','post');
        $cfm  = $this->jlamp_comm->xssInput('cfm','post');
        if(empty($reptNo) || empty($cfm || empty($reptPlanNo))){
            $this->recall_array['data'] = 'I001';
            $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
        }
        $join_param = array(
            array('pWorkingTag',$cfm),
            array('pActPlanNo',$reptPlanNo),
            array('pActReptNo',$reptNo),
            array('pCfmEmpId',$loginid)
        );
        $return_param = array(
            array('wStatus','ok'),
            array('wResults','')
        );
        $res = DB::call($this->DB,'SOAActReptCfm',$join_param,$return_param);
        $msgcd = $res[0]->computed1;
        $sql = "select MsgTxt from TSMMsge10  where MsgCd='$msgcd' and LangCd = '$this->langCode'";
        $result = $this->jlamp_common_mdl->sqlRow($sql);
        $result = json_decode(json_encode($result), true);
        $this->recall_array['data'] = $result['MsgTxt'];
        $this->recall_array['returnCode'] = $res[0]->computed;
        $this->recall_array['returnClass'] = $msgcd;
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
    }
    public function planConfirm(){
        $loginid =  str_replace(' ','',$this->getCookie('EmpId'));
        $planNo = $this->jlamp_comm->xssInput('planNo','post');
        $cfm  = $this->jlamp_comm->xssInput('cfm','post');
        if(empty($planNo) || empty($cfm)){
            $this->recall_array['data'] = 'I001';
            $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
        }
        $join_param = array(
            array('pWorkingTag',$cfm),
            array('pActPlanNo',$planNo),
            array('pCfmEmpId',$loginid)
        );
        $return_param = array(
            array('wStatus','ok'),
            array('wResults','')
        );
        $res = DB::call($this->DB,'SOAActPlanCfm',$join_param,$return_param);
        $msgcd = $res[0]->computed1;
        $sql = "select MsgTxt from TSMMsge10 where MsgCd='$msgcd' and LangCd = '$this->langCode'";
        $result = $this->jlamp_common_mdl->sqlRow($sql);
        $result = json_decode(json_encode($result), true);
        $this->recall_array['data'] = $result['MsgTxt'];
        $this->recall_array['returnCode'] = $res[0]->computed;
        $this->recall_array['returnClass'] = $msgcd;
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
    }
    public function changePlanFinishYn(){
        $planNo = $this->inputM('planNo');
        $planFinishYn = $this->inputM('planFinishYn');
        $this->load->model('Worker20_model');
        $planRes = $this->Worker10_model->table('TOAActPlan00')->where(array('ActPlanNo' => $planNo))->find();
        //.当计划是联络无报告
        if(str_replace(' ','',$planRes['ActGubun']) == 'OA10010100'){
            $this->Worker20_model->table('TOAActPlan00')->where(array('ActPlanNo' => $planNo))->save(array('FinishYn' => $planFinishYn));
            Helper::setResponse('',0,$planFinishYn);
        }else{
            Helper::setResponse('','B002');
        }
        $this->response();
    }
    //系统大分类查询
    public function systemclass_big_prc(){
        $big_systemId = $this->jlamp_comm->xssInput('bigsysid', 'get'); // 小分类ID
        $big_systemId = self::$systemClass[$big_systemId];
        $result = $this->Worker10_model->where(array($big_systemId))->select()->system_class_big($this->langCode);
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
        $result = $this->Worker10_model->where(array($big_systemId,$mini_systemId))->select()->system_class($this->langCode);
        $this->recall_array['data'] = $result;
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
    }
    public function msgList(){
        $time = $this->jlamp_comm->xssInput('time', 'get');
        $this->Worker10_model->auth($this->getCookie('EmpId'),$this->getCookie('auth',false));
        $result = $this->Worker10_model->select()->msgList($time);
        $this->recall_array['data'] = $result;
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
    }

    public function queryAllMsg(){
	    $number = $this->jlamp_comm->xssInput('number', 'get');
        $class = $this->jlamp_comm->xssInput('class', 'get');
        $startDate = $this->jlamp_comm->xssInput('startDate', 'get');
        $endDate = $this->jlamp_comm->xssInput('endDate', 'get');
        $count = $this->jlamp_comm->xssInput('count', 'get');
        if(empty($class) || empty($startDate) || empty($endDate)){
            $this->recall_array['returnCode'] = 'I001';
            $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
        }
        $this->Worker10_model->auth($this->getCookie('EmpId'),$this->getCookie('auth',false));
        if($count == 0){
            $result = $this->Worker10_model->where(array("$number%%"))->select()->AllList($class,$startDate,$endDate);
        }else{
            $result = $this->Worker10_model->where(array("$number%%"))->select()->AllListMore($class,$startDate,$endDate,$count);
        }
        if(empty($result[0])){
            $this->recall_array['returnCode'] = 'NULL';
        }
        $this->recall_array['data'] = $result;
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
    }
    public function planList(){
	    $date = $this->jlamp_comm->xssInput('date', 'get');
        $this->Worker10_model->auth($this->getCookie('EmpId'),$this->getCookie('auth',false));
        $result = $this->Worker10_model->select()->planList($date);
        if(empty($result[0])){
            $this->recall_array['returnCode'] = 'NULL';
        }
        $this->recall_array['data'] = $result;
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
	}
	public function reptList(){
        $date = $this->jlamp_comm->xssInput('date', 'get');
        $this->Worker10_model->auth($this->getCookie('EmpId'),$this->getCookie('auth',false));
        $result = $this->Worker10_model->select()->reptList($date);
        if(empty($result[0])){
            $this->recall_array['returnCode'] = 'NULL';
        }
        $this->recall_array['data'] = $result;
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
    }
    public function planMinute(){
	    $actPlanNo = $this->jlamp_comm->xssInput('actPlanNo', 'get');
        if(empty($actPlanNo)){
            $this->recall_array['returnCode'] = 'I001';
            $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
        }
        $result = $this->Worker10_model->find()->planMinute($actPlanNo,$this->langCode);
        if(empty($result['ActPlanNo'])){
            $this->recall_array['returnCode'] = 'NULL';
        }
        $this->recall_array['data'] = $result;
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
	}
    public function reptMinute(){
	    $actReptNo = $this->jlamp_comm->xssInput('actReptNo', 'get');
	    $actPlanNo = $this->jlamp_comm->xssInput('actPlanNo','get');
        if(empty($actReptNo)){
            $this->recall_array['returnCode'] = 'I001';
            $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
        }
        if(empty($actPlanNo)){
            $result = $this->Worker10_model->find()->reptMinute($actReptNo,$this->langCode,'rept');
        }else{
            $result = $this->Worker10_model->find()->reptMinute($actPlanNo,$this->langCode,'plan');
        }

        if(empty($result['ActPlanNo'])){
            $this->recall_array['returnCode'] = 'NULL';
        }
        $this->recall_array['data'] = $result;
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);

    }

    public function groupList(){
	    $groupNm = $this->jlamp_comm->xssInput('groupnm', 'get');
        $groupId = $this->jlamp_comm->xssInput('groupid', 'get');
        $result = $this->Worker10_model->where(array($groupId,"%$groupNm%"))->select()->grouplist();
        $this->recall_array['data'] = $result;
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
    }

    //员工查询方法
    public function getUser()
    {
        $userNm = $this->jlamp_comm->xssInput('username', 'get');
        $userId = $this->jlamp_comm->xssInput('userid', 'get');
        $groupNm = $this->jlamp_comm->xssInput('groupname', 'get');
        $count = $this->jlamp_comm->xssInput('count', 'get');
        if($count == 0){
            $result = $this->Worker10_model->where(array("%$userNm%",$userId,"%$groupNm%"))->select()->userlist();
        }else{
            $result = $this->Worker10_model->where(array("%$userNm%",$userId,"%$groupNm%"))->select()->userlistMore($count);
        }

        if(count($result[0]) <= 0){
            $this->recall_array['returnCode'] = 'NULL';
            $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
        }
        $this->recall_array['data'] = $result;
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
    }
    public function getCust(){
	    $custNm = $this->jlamp_comm->xssInput('custNm', 'get');
	    $custId = $this->jlamp_comm->xssInput('custId', 'get');
        $custCount = $this->jlamp_comm->xssInput('custCount','get');
        $this->Worker10_model->auth($this->getCookie('EmpId'),$this->getCookie('auth',false));
        if($custCount > 0){
            $result = $this->Worker10_model->where(array("$custId%%","%$custNm%"))->select()->getCustMore($custCount,$this->langCode);
        }
        else
        {
            $result = $this->Worker10_model->where(array("$custId%%","%$custNm%"))->select()->getCust($this->langCode);
        }
        if(count($result[0]) <= 0)
        {
            $this->recall_array['returnCode'] = 'NULL';
        }else{
            $this->recall_array['data'] = $result;
        }
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
    }
    public function getPlanPhoto(){
	    $planNo = $this->jlamp_comm->xssInput('planNo', 'post');
        if(empty($planNo)){
            $this->recall_array['returnCode'] = 'I001';
            $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
        }
        //必须为一个对象涉及到图片类获取sql内的图片
        $result = $this->Worker10_model->table('TOAActPlan00')->field('LocationPhoto as FileNm')->where(array('ActPlanNo' => $planNo))->object()->select();
        $result[0][0]->FTP_UseYn = 'Y';
        $result[0][0]->Photo = '';
        if(empty($result[0][0]->FileNm)){
            $this->recall_array['returnCode'] = 'empty';
            $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
        }
        $downImage = new Multi_downimage();
        $resultImage = $downImage->id($planNo)->ftpdir('ACT')->localdir('ACT')->image_down('Plan',$result[0]);
        if($resultImage == false)
        {
            $this->recall_array['returnCode'] = 'FTP';
        }else if($resultImage == 'null'){
            $this->recall_array['returnCode'] = 'empty';
        }
        $result = json_decode(json_encode($result[0]),true);
        $this->recall_array['data'] = $result;
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
	}
	public function getReptPhoto(){
        $reptNo = $this->jlamp_comm->xssInput('reptNo', 'post');
        if(empty($reptNo)){
            $this->recall_array['returnCode'] = 'I001';
            $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
        }
        //必须为一个对象涉及到图片类获取sql内的图片
        $result = $this->Worker10_model->table('TOAActRept10')->field('FileNm,Seq')->where(array('ActReptNo' => $reptNo))->object()->select();
//        $result[0][0]->FTP_UseYn = 'Y';
//        $result[0][0]->Photo = '';
        $downImage = new Multi_downimage();
        $resultImage = $downImage->id($reptNo)->ftpdir('ACT')->localdir('ACT')->image_down('Rept',$result[0]);
        if($resultImage == false || $resultImage == 'null')
        {
            $this->recall_array['returnCode'] = 'FTP';
        }

        $result = json_decode(json_encode($result[0]),true);
        $this->recall_array['data'] = $result;
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
    }

    public function savePlan(){
        $loginId = $this->getCookie('EmpId');
	    $planNo = $this->jlamp_comm->xssInput('planNo', 'post');
        $actGubunId      = $this->jlamp_comm->xssInput('actGubunId', 'post');
        $actGubunClassId = $this->jlamp_comm->xssInput('actGubunClassId', 'post');
        $planDate        = $this->jlamp_comm->xssInput('planDate', 'post');
        $planUserId      = $this->jlamp_comm->xssInput('planUserId', 'post');
        $planGroupId     = $this->jlamp_comm->xssInput('planGroupId', 'post');
        $planStatusId    = $this->jlamp_comm->xssInput('planStatusId', 'post');
        $planDestinationNm = $this->jlamp_comm->xssInput('planDestinationNm', 'post');
        $planActTitle      = $this->jlamp_comm->xssInput('planActTitle', 'post');
        $planActContents   = $this->jlamp_comm->xssInput('planActContents', 'post');
        $planCustId        = $this->jlamp_comm->xssInput('planCustId', 'post');
        $planStartDate     = $this->jlamp_comm->xssInput('planStartDate', 'post');
        $planEndDate       = $this->jlamp_comm->xssInput('planEndDate', 'post');

        //判断生成还是更新
        $isUpdate = 0;
        if(empty($planNo)){
            $dateMonth = date('Ymd',intval(time()));
            $sql = "select top 1 ActPlanNo from TOAActPlan00 where ActPlanNo LIKE '$dateMonth%%' order by ActPlanNo desc";
            $resultPlanNo= $this->jlamp_common_mdl->sqlRow($sql);
            $resultPlanNo = json_decode(json_encode($resultPlanNo),true);
            //如果当月还没有编号
            if(empty($resultPlanNo['ActPlanNo']))
            {
                $planNo = $dateMonth.'0001';
            }
            else
            {
                $lastNo = substr($resultPlanNo['ActPlanNo'],8);
                $planNo = $dateMonth.$lastNo;
                $planNo = $planNo +1;
            }
        }
        else
        {
            $isUpdate = 1;
        }
        if($actGubunId == str_replace(' ','','OA10010200')){
            $JobReportYn = 'Y';
            $finishYn = 'N';
        }else{
            $JobReportYn = 'N';
            $finishYn = 'N';
        }
        try{
            $this->load->model('Worker20_model');
            if($isUpdate == 0){
                $add = array(
                    'ActPlanNo'     => $planNo,
                    'ActPlanDate'   => $planDate,
                    'DeptCd'        => $planGroupId,
                    'EmpID'         => $planUserId,
                    'ActGubun'      => $actGubunId,
                    'RelationClass' => $actGubunClassId,
                    'ActTitle'      => array($planActTitle,'utf-8'),
                    'ActContents'   => array($planActContents,'utf-8'),
                    'CustCd'        => $planCustId,
                    'DestinationNm' => array($planDestinationNm,'utf-8'),
                    'ActSTDate'     => $planStartDate,
                    'ActEDDate'     => $planEndDate,
                    'JobReportYn'   => $JobReportYn,
                    'FinishYn'      => $finishYn,
                    'FinishDate'    => $planEndDate,
                    'RegEmpID'      => $loginId,
                    'RegDate'       => 'date(now)',
                    'UptEmpID'      => $loginId,
                    'UptDate'       => 'date(now)'
                );
                $res = $this->Worker20_model->table('TOAActPlan00')->add($add);

                $confirm = $this->Worker10_model->table('TOAActPlan00')->field('ActPlanNo')->where(array('ActPlanNo' => $planNo))->find();
                if($confirm['ActPlanNo'] != $planNo){
                    $this->recall_array['returnCode'] = 'addError';
                }else{
                    if($JobReportYn == 'Y'){
                        $this->recall_array['returnCode'] = 'H003';
                    }else{
                        $this->recall_array['returnCode'] = 'Y003';
                    }
                    $this->recall_array['data'] = $planNo;
                }
                $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
            }else{
                $save = array(
                    'ActPlanDate' => $planDate,
                    'DeptCd'   => $planGroupId,
                    'EmpID'    => $planUserId,
                    'ActGubun' => $actGubunId,
                    'RelationClass' => $actGubunClassId,
                    'ActTitle'      => array($planActTitle,'utf-8'),
                    'ActContents'   => array($planActContents,'utf-8'),
                    'CustCd'        => $planCustId,
                    'JobReportYn'   => $JobReportYn,
                    'FinishYn'     => $finishYn,
                    'DestinationNm' => array($planDestinationNm,'utf-8'),
                    'ActSTDate'     => $planStartDate,
                    'ActEDDate'     => $planEndDate,
                    'UptEmpID'      => $loginId,
                    'UptDate'       => 'date(now)'
                );
                $res = $this->Worker20_model->table('TOAActPlan00')->where(array('ActPlanNo' => $planNo))->save($save);
                if($JobReportYn == 'Y'){
                    $this->recall_array['returnCode'] = 'H003';
                }else{
                    $this->recall_array['returnCode'] = 'S003';
                }
                $this->recall_array['data'] = $planNo;
                $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
            }
        }catch (Exception $e){
            $this->recall_array['returnCode'] = 'netWorkError';
            $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
        }
    }
    public function saveRept(){
        $loginId = $this->getCookie('EmpId');
        $ActGubunId = $this->jlamp_comm->xssInput('ActGubunId', 'post');
        $RelationClassId = $this->jlamp_comm->xssInput('RelationClassId', 'post');
        $CustPatternId = $this->jlamp_comm->xssInput('CustPatternId', 'post');
        $ActReptNo = $this->jlamp_comm->xssInput('ActReptNo', 'post');
        $ActReptDate = $this->jlamp_comm->xssInput('ActReptDate', 'post');
        $ActPlanNo = $this->jlamp_comm->xssInput('ActPlanNo', 'post');
        $EmpID          = $this->jlamp_comm->xssInput('EmpID', 'post');
        $DeptCd         = $this->jlamp_comm->xssInput('DeptCd', 'post');
        $ReptTitle      = $this->jlamp_comm->xssInput('ReptTitle', 'post');
        $MeetingPlace   = $this->jlamp_comm->xssInput('MeetingPlace', 'post');
        $MeetingSubject = $this->jlamp_comm->xssInput('MeetingSubject', 'post');
        $AttendPerson   = $this->jlamp_comm->xssInput('AttendPerson', 'post');
        $CustRequstTxt  = $this->jlamp_comm->xssInput('CustRequstTxt', 'post');
        $SubjectDisTxt  = $this->jlamp_comm->xssInput('SubjectDisTxt', 'post');
        $ReqConductDate = $this->jlamp_comm->xssInput('ReqConductDate', 'post');
        $Remark         = $this->jlamp_comm->xssInput('Remark', 'post');
        $CustCd         = $this->jlamp_comm->xssInput('CustCd', 'post');
        $MeetingSTDate  = $this->jlamp_comm->xssInput('MeetingSTDate', 'post');
        $MeetingEDDate  = $this->jlamp_comm->xssInput('MeetingEDDate', 'post');
        //判断是否存在GPS定位信息
        $planLocation = $this->Worker10_model->table('TOAActPlan00')->field('ActPlanNo,ActGubun')->where(array('ActPlanNo' => $ActPlanNo))->find();
        if(empty($planLocation['ActPlanNo']) && $planLocation['ActGubun'] == str_replace(' ','','OA10010200')){
            $this->recall_array['returnCode'] = 'noLocation';
            $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
        }
        //判断生成还是更新
        $isUpdate = 0;
        if(empty($ActReptNo)){
            $dateMonth = date('Ymd',intval(time()));
            $sql = "select top 1 ActReptNo from TOAActRept00 where ActReptNo LIKE '$dateMonth%%' order by ActReptNo desc";
            $resultReptNo= $this->jlamp_common_mdl->sqlRow($sql);
            $resultReptNo = json_decode(json_encode($resultReptNo),true);
            //如果当月还没有编号
            if(empty($resultReptNo['ActReptNo']))
            {
                $ActReptNo = $dateMonth.'0001';
            }
            else
            {
                $lastNo = substr($resultReptNo['ActReptNo'],8);
                $ActReptNo = $dateMonth.$lastNo;
                $ActReptNo = $ActReptNo +1;
            }
        }
        else
        {
            $isUpdate = 1;
        }
        try{
            $this->load->model('Worker20_model');
            if($isUpdate == 0){
                $reptCheck = $this->Worker10_model->table('TOAActRept00')->field('ActPlanNo')->where(array('ActPlanNo' => $ActPlanNo))->find();
                if(!empty($reptCheck['ActPlanNo'])){
                    $this->recall_array['returnCode'] = 'hasRept';
                    $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
                }
                $add = array(
                    'ActGubun'      => $ActGubunId,
                    'RelationClass' => $RelationClassId,
                    'CustPattern'   => $CustPatternId,
                    'ActReptNo'     => $ActReptNo,
                    'ActReptDate'   => $ActReptDate,
                    'ActPlanNo'     => $ActPlanNo,
                    'EmpID'         => $EmpID,
                    'DeptCd'        => $DeptCd,
                    'ReptTitle'     => array($ReptTitle,'utf-8'),
                    'MeetingPlace'  => array($MeetingPlace,'utf-8'),
                    'MeetingSubject'=> array($MeetingSubject,'utf-8'),
                    'AttendPerson'  => array($AttendPerson,'utf-8'),
                    'CustRequstTxt' => array($CustRequstTxt,'utf-8'),
                    'SubjectDisTxt' => array($SubjectDisTxt,'utf-8'),
                    'ReqConductDate'=> $ReqConductDate,
                    'Remark'        => array($Remark,'utf-8'),
                    'CustCd'        => $CustCd,
                    'MeetingSTDate' => $MeetingSTDate,
                    'MeetingEDDate' => $MeetingEDDate,
                    'RegEmpID'      => $loginId,
                    'RegDate'       => 'date(now)',
                    'UptEmpID'      => $loginId,
                    'UptDate'       => 'date(now)',
                );
                $res = $this->Worker20_model->table('TOAActRept00')->add($add);

                $confirm = $this->Worker10_model->table('TOAActRept00')->field('ActReptNo')->where(array('ActReptNo' => $ActReptNo))->find();
                if($confirm['ActReptNo'] != $ActReptNo){
                    $this->recall_array['returnCode'] = 'addError';
                }else{
                    $this->recall_array['returnCode'] = 'Y003';
                    $this->recall_array['data'] = $ActReptNo;
                }
                $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
            }else{
                $save = array(
                    'RelationClass' => $RelationClassId,
                    'CustPattern'   => $CustPatternId,
                    'ActReptDate'   => $ActReptDate,
                    'EmpID'         => $EmpID,
                    'DeptCd'        => $DeptCd,
                    'ReptTitle'     => array($ReptTitle,'utf-8'),
                    'MeetingPlace'  => array($MeetingPlace,'utf-8'),
                    'MeetingSubject'=> array($MeetingSubject,'utf-8'),
                    'AttendPerson'  => array($AttendPerson,'utf-8'),
                    'CustRequstTxt' => array($CustRequstTxt,'utf-8'),
                    'SubjectDisTxt' => array($SubjectDisTxt,'utf-8'),
                    'ReqConductDate'=> $ReqConductDate,
                    'Remark'        => array($Remark,'utf-8'),
                    'CustCd'        => $CustCd,
                    'MeetingSTDate' => $MeetingSTDate,
                    'MeetingEDDate' => $MeetingEDDate,
                    'UptEmpID'      => $loginId,
                    'UptDate'       => 'date(now)'
                );
                $res = $this->Worker20_model->table('TOAActRept00')->where(array('ActReptNo' => $ActReptNo))->save($save);
                $this->recall_array['returnCode'] = 'S003';
                $this->recall_array['data'] = $ActReptNo;
                $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
            }
        }catch (Exception $e){
            $this->recall_array['returnCode'] = 'netWorkError';
            $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
        }
    }
    public function uploadPlanPhoto(){
        $planNo = $this->jlamp_comm->xssInput('planNo', 'post');
        $image = $_POST['imageList'];
        if (empty($planNo) || empty($image)) {
            $this->recall_array['returnCode'] = 'I001';
            $this->recall_array['returnMsg'] = '工作计划编号/图片不存在';
            $this->jlamp_comm->jsonEncEnd($this->recall_array);
        }
        $date = date('Ymdhis',time());
        $dirYear = substr($planNo,0,4);
        $dirMonth = substr($planNo,4,2);
        $dir = "./image/uploads/ACT/Plan/$dirYear"."$dirMonth/$planNo";
        foreach ($image as $k => $v){
            $fileNm = 'M'.$date.rand(100,999);
            $imageDir = Img::resolveImageByBase($v,$dir,$fileNm,1200,1000);
            $uploadRes = Ftp::upload($planNo,$imageDir['fileNm'],$imageDir['dir'],'/ACT/Plan');
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
                $save = array(
                    'LocationPhoto' => $imageDir['fileNm'],
                    'UptEmpId'      => $this->getCookie('EmpId'),
                    'UptDate'       => 'date(now)',
                );
                try{
                    $this->load->model('Worker20_model');
                    $res = $this->Worker20_model->table('TOAActPlan00')->where(array('ActPlanNo' => $planNo))->save($save);
                    $this->recall_array['data'][] = $imageDir['fileNm'];
                }catch (Exception $e){
                    $this->recall_array['returnCode'] = 'netWorkError';
                    $this->jlamp_comm->jsonEncEnd($this->recall_array);
                }
            }
        }
        $this->jlamp_comm->jsonEncEnd($this->recall_array);
    }
    public function uploadReptPhoto(){
        $reptNo = $this->jlamp_comm->xssInput('reptNo', 'post');
        $image = $_POST['imageList'];
        if (empty($reptNo) || empty($image)) {
            $this->recall_array['returnCode'] = 'I001';
            $this->recall_array['returnMsg'] = '工作报告编号/图片不存在';
            $this->jlamp_comm->jsonEncEnd($this->recall_array);
        }
        $date = date('Ymdhis',time());
        $dirYear = substr($reptNo,0,4);
        $dirMonth = substr($reptNo,4,2);
        $dir = "./image/uploads/ACT/Rept/$dirYear"."$dirMonth/$reptNo";
        $seq_result = $this->Worker10_model->table('TOAActRept10')->where(array('ActReptNo'=> $reptNo))->order('Seq,desc')->find();
        foreach ($image as $k => $v){
            $fileNm = 'M'.$date.rand(100,999);
            $imageDir = Img::resolveImageByBase($v,$dir,$fileNm,1200,1000);
            $uploadRes = Ftp::upload($reptNo,$imageDir['fileNm'],$imageDir['dir'],'/ACT/Rept');
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
                    'ActReptNo'     => $reptNo,
                    'Seq'           => $seq_result['Seq'],
                    'FileNm'        => $imageDir['fileNm'],
                    'RegEmpID'      => $this->getCookie('EmpId'),
                    'RegDate'       => 'date(now)',
                    'UptEmpId'      => $this->getCookie('EmpId'),
                    'UptDate'       => 'date(now)'
                );
                try{
                    $this->load->model('Worker20_model');
                    $res = $this->Worker20_model->table('TOAActRept10')->add($add);
                    $this->recall_array['data'][] = $imageDir['fileNm'];
                }catch (Exception $e){
                    $this->recall_array['returnCode'] = 'netWorkError';
                    $this->jlamp_comm->jsonEncEnd($this->recall_array);
                }
            }
        }
        $this->jlamp_comm->jsonEncEnd($this->recall_array);
    }
    public function delPlanPhoto(){
        $planNo = $this->jlamp_comm->xssInput('planNo', 'post');
	    if(empty($planNo)){
            $this->recall_array['returnCode'] = 'I001';
            $this->recall_array['returnMsg'] = '工作计划编号不存在';
            $this->jlamp_comm->jsonEncEnd($this->recall_array);
        }
        $where = array(
            'ActPlanNo' => $planNo,
        );
        $this->load->model('Worker20_model');
        $res = $this->Worker20_model->table('TOAActPlan00')->where($where)->save(array('LocationPhoto' => '','LocationAddr' => ''));
        $this->jlamp_comm->jsonEncEnd(array($res));
    }
    public function delReptPhoto(){
        $reptNo = $this->jlamp_comm->xssInput('reptNo', 'post');
        $reptFileNm = $this->jlamp_comm->xssInput('reptFileNm','post');
        $reptFileSeq = $this->jlamp_comm->xssInput('reptFileSeq','post');
        if(empty($reptNo) || empty($reptFileNm) || empty($reptFileSeq)){
            $this->recall_array['returnCode'] = 'I001';
            $this->recall_array['returnMsg'] = '工作报告编号不存在';
            $this->jlamp_comm->jsonEncEnd($this->recall_array);
        }
        $where = array(
            'ActReptNo' => $reptNo,
            'Seq'       => $reptFileSeq,
            'FileNm'    => $reptFileNm
        );
        $this->load->model('Worker20_model');
        $res = $this->Worker20_model->table('TOAActRept10')->where($where)->delete();
        $this->jlamp_comm->jsonEncEnd(array($res));
    }
}

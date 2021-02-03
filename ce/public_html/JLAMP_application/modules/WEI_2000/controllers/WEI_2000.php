<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
include "./JLAMP_application/libraries/ftpConn.php";
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
class WEI_2000 extends Base {
	function __construct() {
		parent::__construct();

	}

	public function index() {
        $this->getAuth('WEI_2000');
        $this->loginLog('WEI_2000');
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
        header("content-type:text/html;charset=utf-8");
		$cssPart = array(
		    '<link href="/third_party/bootstrap-3.3.5/css/bootstrap.css" rel="stylesheet">',
            '<link href="/third_party/bootstrap-3.3.5/css/bootstrap-theme.css" rel="stylesheet">',
            '<link rel="stylesheet" href="/css/WEI_2000/WEI_2000_Lists.css?v=201807080921">',
            '<link rel="stylesheet" href="/css/WEI_2000/mui.min.css?v=1001">',
		);
		$jsPart = array(
            '<script src="/js/WEI_2000/WEI_2000_Lists.js?v=201807370936"></script>',
            '<script src="/js/WEI_2000/mui.min.js"></script>',
            '<script src="/js/WEI_2000/mui.previewimage.js?v=201804261256"></script>',
            '<script src="/js/WEI_2000/mui.zoom.js?v=201804231454"></script>'
		);

		$formKey = $this->jlamp_comm->xssInput('formKey','get');
		//$langID = $this->jlamp_comm->xssInput('langID', 'get');
		$menuSelection = $this->jlamp_comm->xssInput('menuSelection', 'get');
		
		$this->jlamp_comm->isHtmlDisplay(true);
		$this->jlamp_comm->setCSS($cssPart);
		$this->jlamp_comm->setJS($jsPart);

		//$this->load->library('lib_comm');
		//$subTitle = $this->lib_comm->getMenuName();

		$this->jlamp_tp->assign(array(
            //'subTitle' => $subTitle,
			//'langID' => $langID,
            'formKey' => $formKey,
			'menuSelection' => $menuSelection
		));
        $this->jlamp_tp->define(['tpl' => 'SalesBusinessView/WEI_2000_Lists.html']);
        $this->jlamp_tp->template_dir = VIEWS;
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
	public function login_user(){
        $login_id = str_replace(' ','',$this->getCookie('EmpId'));
        $sql = "select UA.EmpNm,UB.DeptCd,UB.DeptNm from TMAEmpy00 UA
                left join TMADept00 UB on UA.DeptCd = UB.DeptCd
                WHERE UA.EmpID = '$login_id'";
        $result = $this->jlamp_common_mdl->sqlRow($sql);
        $this->recall_array['data'] = array(
            'userid' => $login_id,
            'username' => $result->EmpNm,
            'groupid' =>$result->DeptCd,
            'groupname' => $result->DeptNm
        );
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
    }
    //存储用户表到内存
    public function query_users(){
        $sql = "select a.EmpID,a.EmpNm,b.DeptCd,b.DeptNm from TMAEmpy00 a,TMADept00 b 
                where a.DeptCd = b.DeptCd";
        $result = $this->jlamp_common_mdl->sqlRows($sql);
        $result = json_decode(json_encode($result),true);
        $this->mem_set_users('userlist',$result);
    }

    //员工查询方法
    public function user_prc()
    {
        $stime=microtime(true);
        $get_username = $this->jlamp_comm->xssInput('username', 'get'); //
        $get_userid = $this->jlamp_comm->xssInput('userid', 'get'); //
        $get_groupname = $this->jlamp_comm->xssInput('groupname', 'get'); //

        empty($get_username) ? $where1 = '' : $where1 = 'AND a.EmpNm LIKE ' . "N'%" . $get_username . "%'";
        empty($get_userid) ? $where2 = '' : $where2 = 'AND a.EmpID =' . "'" . $get_userid . "'";
        empty($get_groupname) ? $where3 = '' : $where3 = 'AND b.DeptNm LIKE ' . "N'%" . $get_groupname . "%'";
        if(empty($get_username) && empty($get_userid) && empty($get_groupname)){
            $sql = "select a.EmpID,a.EmpNm,b.DeptCd,b.DeptNm from TMAEmpy00 a,TMADept00 b 
                    where a.DeptCd = b.DeptCd AND a.RetireYn = 'N'";
            $result = $this->jlamp_common_mdl->sqlRows($sql);
            $result = json_decode(json_encode($result), true);
        }
        else
        {
            $sql = "select a.EmpID,a.EmpNm,b.DeptCd,b.DeptNm from TMAEmpy00 a,TMADept00 b 
                    where a.DeptCd = b.DeptCd AND a.RetireYn = 'N' $where1 $where2 $where3";
            $result = $this->jlamp_common_mdl->sqlRows($sql);
            $result = json_decode(json_encode($result), true);
        }
        $etime=microtime(true);
        $total=$etime-$stime;
        $this->recall_array['data'] = $result;
        $this->recall_array['returnMsg'] = $total;
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
    }
    public function confirm(){
        $loginid =  str_replace(' ','',$this->getCookie('EmpId'));
	    $get_mtid = $this->jlamp_comm->xssInput('mt_id','get');
	    $get_cfm  = $this->jlamp_comm->xssInput('cfm','get');
	    if(empty($get_mtid) || empty($get_cfm)){
            $this->recall_array['data'] = 'I001';
            $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
        }
	    $join_param = array(
            array('pWorkingTag',$get_cfm),
            array('pAssmReptNo',$get_mtid),
            array('pCfmEmpId',$loginid)
        );
        $return_param = array(
            array('wStatus','ok'),
            array('wResults','')
        );
        $res = DB::call($this->DB,'SSAAssmReptCfm',$join_param,$return_param);
        $msgcd = $res[0]->computed1;
        $sql = "select MsgTxt from TSMMsge10  where MsgCd='$msgcd' and LangCd = '$this->langCode'";
        $result = $this->jlamp_common_mdl->sqlRow($sql);
        $result = json_decode(json_encode($result), true);
        $this->recall_array['data'] = $result['MsgTxt'];
        $this->recall_array['returnCode'] = $res[0]->computed;
        $this->recall_array['returnClass'] = $msgcd;
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
	}

    //订单查询方法
    public function order_prc(){
        $get_ordercount = $this->jlamp_comm->xssInput('ordercount','get'); //加载更多
        $get_orderby = $this->jlamp_comm->xssInput('orderby', 'get'); //客户名称
        $get_orderid = $this->jlamp_comm->xssInput('orderid', 'get'); //订单编号
        $langCode = parent::getLangID();
        switch ($langCode) {       //查看语言选项
            case "KOR":
                $langCode = "SM00010001";
                break;
            case "CHN":
                $langCode = "SM00010003";
                break;
            case "ENG":
                $langCode = "SM00010002";
                break;
            case "JPN":
                $langCode = "SM00010004";
                break;
            default:
                $langCode = "SM00010003";
                break;
        }

        $loginid = $this->getCookie('EmpId');
        $loginid = 'M2015011';
        $auth = $this->getCookie('auth',false);
        $auth = AUTH_A;
        $sql = "select UB.DeptCd,UB.MDeptCd,UC.emp_code,UD.JobNo from TMAEmpy00 UA 
                left join TMADept00 UB on UB.DeptCd = UA.DeptCd              
                left join sysUserMaster UC on UA.EmpId = UC.emp_code and isnull(UC.emp_code,'')!=''
                left join TMAJobc10 UD on UD.EmpId = UC.emp_code 
                INNER join TMAJobc00 UE on UE.JobNo = UD.JobNo and UE.SaleYn = 'Y' 
                WHERE UC.user_id = '$loginid' and UD.LastYN = 'Y'
                and getdate() between UD.STDate and UD.EDDate
                ";
        $result = $this->jlamp_common_mdl->sqlRow($sql);
        $result = json_decode(json_encode($result),true);
        $DeptCd = $result['DeptCd'];
        $MDeptCd = $result['MDeptCd'];
        $empId = $result['emp_code'];
        $jobNo = $result['JobNo'];
        switch ($auth){
            case AUTH_A:   //全部
                $authwhere = '';
                break;
            case AUTH_E:   //个人
                $authwhere = " AND MA.EmpId = '$empId'";
                break;
            case AUTH_J:
                $authwhere = " AND MA.JobNo = '$jobNo'";
                break;
            case AUTH_D:   //部门
                $authwhere = " AND UB.DeptCd = '$DeptCd'";
                break;
            case AUTH_M:   //管理
                $authwhere = "AND UB.DeptCd in (select DeptCd from dbo.fnMDeptCd('y','$empId') )";
//                $authwhere = " AND UB.MDeptCd = '$MDeptCd'";
                break;
            default:  //默认为部门
                $authwhere = " AND UB.DeptCd = '$DeptCd'";
                break;
        }
        $nowtime = date('Y-m-d',intval(time()));
        empty($get_orderby) ? $get_orderby = '' : $get_orderby = "AND MC.CustNm LIKE N'%$get_orderby%'";
        empty($get_orderid) ? $where = '' : $where = 'AND MA.OrderNo='."'".$get_orderid."'";
        if($get_ordercount == 0){
            $sql = "select top 50 Row_Number()over(order by MA.OrderNo desc)AS id,
                    MA.EmpId AS list,
                    MA.ExpClss,
                    MA.OrderNo,
                    MA.OrderDate,
                    MA.DelvDate,
                    MA.GateQty,
                    isnull(MC.CustNm,'') AS custname,
                    isnull(FB.TransNm,FA.MinorNm) as SystemType,
                    UA.EmpID,UA.EmpNm,UB.DeptCd,UB.DeptNm,UB.MDeptCd
                    from TSAOrder00 MA   -- 订单信息
                    left join TMACust00 MC on MA.CustCd = MC.CustCd  -- 客户名称
                    left join TSMSyco10 FA on FA.MinorCd = MA.SystemType
                    left join TSMDict10 FB on FB.DictCd = MA.SystemType and FB.LangCd = '$langCode'
                    left join TMAEmpy00 UA on MA.EmpId = UA.EmpID   -- 员工信息
                    left join TMADept00 UB on UA.DeptCd = UB.DeptCd -- 部门信息
                    WHERE ISNULL(MA.EmpId,'')!='' and MA.CfmYn='1' $authwhere  $where $get_orderby
                    order by MA.OrderNo desc;";
        }
        else
        {
            $sql = "select top 50 * from (
                    select Row_Number()over(order by MA.OrderNo desc)AS id,
                    MA.EmpId AS list,
                    MA.ExpClss,
                    MA.OrderNo,
                    MA.OrderDate,
                    MA.DelvDate,
                    MA.GateQty,
                    isnull(MC.CustNm,'') AS custname,
                    isnull(FB.TransNm,FA.MinorNm) as SystemType,
                    UA.EmpID,UA.EmpNm,UB.DeptCd,UB.DeptNm,UB.MDeptCd
                    from TSAOrder00 MA -- 订单信息
                    left join TMACust00 MC on MA.CustCd = MC.CustCd  -- 客户名称
                    left join TSMSyco10 FA on FA.MinorCd = MA.SystemType
                    left join TSMDict10 FB on FB.DictCd = MA.SystemType and FB.LangCd = '$langCode'
                    left join TMAEmpy00 UA on MA.EmpId = UA.EmpID   -- 员工信息
                    left join TMADept00 UB on UA.DeptCd = UB.DeptCd -- 部门信息
                    where ISNULL(MA.EmpId,'')!='' and MA.CfmYn='1' $authwhere $where $get_orderby 
                    )t where id > $get_ordercount order by id asc;";
                   //AND convert(char(10) ,MA.STDate,120) <= '$nowtime' AND convert(char(10) ,MA.EDDate, 120) >= '$nowtime'

        }
        $result = $this->jlamp_common_mdl->sqlRows($sql);
        $result = json_decode(json_encode($result),true);
        if(count($result[0]) <= 0)
        {
            $this->recall_array['returnCode'] = 'NULL';
        }
        else{
            $this->recall_array['data'] = $result;
        }
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
    }
    //组装报告列表
    public function mt_list(){

        $get_orderid = $this->jlamp_comm->xssInput('orderid','get');
        $get_custnm = $this->jlamp_comm->xssInput('custnm', 'get');
	    $get_count = $this->jlamp_comm->xssInput('count', 'get');
        $loginid = $this->getCookie('EmpId');
        $auth = $this->getCookie('auth',false);
        $nowtime = date('Y-m-d',intval(time()));
        $sql = "select UB.DeptCd,UB.MDeptCd,UC.emp_code,UD.JobNo from TMAEmpy00 UA 
                left join TMADept00 UB on UB.DeptCd = UA.DeptCd              
                left join sysUserMaster UC on UA.EmpId = UC.emp_code and isnull(UC.emp_code,'')!=''
                left join TMAJobc10 UD on UD.EmpId = UC.emp_code 
                INNER join TMAJobc00 UE on UE.JobNo = UD.JobNo and UE.SaleYn = 'Y' 
                WHERE UC.user_id = '$loginid' and UD.LastYN = 'Y'
                and getdate() between UD.STDate and UD.EDDate
                ";
        $result = $this->jlamp_common_mdl->sqlRow($sql);
        $result = json_decode(json_encode($result),true);
        $DeptCd = $result['DeptCd'];
        $MDeptCd = $result['MDeptCd'];
        $empId = $result['emp_code'];
        $jobNo = $result['JobNo'];
        switch ($auth){
            case AUTH_A:   //全部
                $authwhere = '';
                break;
            case AUTH_E:   //个人加部门
                $authwhere = " AND UA.EmpId = '$empId'";
                break;
            case AUTH_J:
                $authwhere = " AND OA.JobNo = '$jobNo'";
                break;
            case AUTH_D:
                $authwhere = " AND UB.DeptCd = '$DeptCd'";
                break;
            case AUTH_M:   //管理
                $authwhere = "AND UB.DeptCd in (select DeptCd from dbo.fnMDeptCd('y','$empId') )";
//                $authwhere = " AND UB.MDeptCd = '$MDeptCd'";
                break;
            default:  //默认为个人
                $authwhere = " AND UB.DeptCd = '$DeptCd'";
                break;
        }
        empty($get_orderid) ? $whereorder = '' : $whereorder = "AND OA.OrderNo like '$get_orderid%%'";
	    empty($get_custnm) ? $wherecust = '' : $wherecust = "AND CA.CustNm like N'%$get_custnm%'";
        if($get_count == 0){
            $sql = "select top 50  Row_Number()over(order by MA.AssmReptNo desc)AS id,
                    MA.AssmReptNo,
                    MA.AssmReptDate,
                    MA.AssmDate,
                    MA.CfmYn,
                    UA.EmpNm,
                    UB.DeptNm,
                    MA.OrderNo,
                    ISNULL(CA.CustNm,'')  as custnm
                    from TSAAssmRept00 MA
                    left join TSAOrder00 OA on MA.OrderNo = OA.OrderNo
                    left join TMACust00 CA on OA.CustCd = CA.CustCd
                    left join TMAEmpy00 UA on MA.AssmEmpID = UA.EmpID
                    left join TMADept00 UB on MA.AssmDeptCd = UB.DeptCd
                    where 1=1  $authwhere $whereorder $wherecust;";
        }
        else
        {
            $sql = "select top 50 * from (
                    select Row_Number()over(order by MA.AssmReptNo desc)AS id,
                    MA.AssmReptNo,
                    MA.AssmReptDate,
                    MA.AssmDate,
                    MA.CfmYn,
                    UA.EmpNm,
                    UB.DeptNm,
                    MA.OrderNo,
                    ISNULL(CA.CustNm,'') as custnm
                    from TSAAssmRept00 MA
                    left join TSAOrder00 OA on MA.OrderNo = OA.OrderNo
                    left join TMACust00 CA on OA.CustCd = CA.CustCd
                    left join TMAEmpy00 UA on MA.AssmEmpID = UA.EmpID
                    left join TMADept00 UB on MA.AssmDeptCd = UB.DeptCd
                    where 1=1 $authwhere $whereorder $wherecust)A
                    WHERE id > $get_count order by id asc";
        }
        $result = $this->jlamp_common_mdl->sqlRows($sql);
        $result = json_decode(json_encode($result),true);
        if(count($result[0]) <= 0)
        {
            $this->recall_array['returnCode'] = 'NULL';
        }
        else{
            $this->recall_array['data'] = $result;
        }
        $this->jlamp_comm->jsonEncEnd($this->recall_array);
    }

    //组装报告查询方法
    public function mt_prc(){
        set_time_limit(30);
        $get_orderid = $this->jlamp_comm->xssInput('orderid', 'get');
        if (empty($get_orderid)) {
            $this->recall_array['returnCode'] = 'I995'; //订单不存在1
            $this->recall_array['returnMsg'] = '';
            $this->jlamp_comm->jsonEncEnd($this->recall_array);
        }
	    $result = DB::queryRow(" select ma.AssmReptNo,ma.AssmReptDate,ma.AssmDate,
                 mb.EmpNm as AssmEmpNm,
                 mc.DeptNm as AssmDeptNm,
                 ma.AssmEmpID,
                 ma.AssmDeptCd,
                 ma.CfmYn,
                 ma.Remark,
                 ma.AssmContents,
                 ma.TrialDate,
                 ma.TrialEmpID,
                 md.EmpNm as TrialEmpNm,
                 ma.TrialDeptCd,
                 me.DeptNm as TrialDeptNm,
                 ma.TrialContents
                 from
                 TSAAssmRept00 ma --组装信息
                 left join TMAEmpy00 mb on ma.AssmEmpID = mb.EmpID --组装人员
                 left join TMADept00 mc on mb.DeptCd = mc.DeptCd --组装部门
                  left join TMAEmpy00 md on ma.TrialEmpID = md.EmpID --试模人员
                 left join TMADept00 me on md.DeptCd = me.DeptCd --试模部门
                 where ma.OrderNo = '%s'",[$get_orderid]);
        if(empty($result))
        {
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }
    public function getAssmSales(){
        $assmReptNo = $this->inputM('assmReptNo');
        $model = new AssmRept10_model();
        $result = $model->getAssmSales($assmReptNo);
        if(count($result[0]) <= 0){
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }

    public function getAssmPhoto(){
        $assmReptNo = $this->inputM('assmReptNo');
        $model = new AssmRept10_model();
        $result = $model->getAssmPhotoNm($assmReptNo,'object');
        $downimage = new Multi_downimage();
        $imageRes = $downimage->id($assmReptNo)->ftpdir('Sales')->localdir('mt')->downloadFile('AssembleReport',$result[0]);
        if($imageRes == false)
        {
            Helper::$ajaxReturn['returnCode'] = 'FTP';
        }else if($imageRes == 'null'){
            Helper::responseEmpty();
        }
        foreach($result[0] as $k => $v){
            $v->Photo = '';
        }
        $result = json_decode(json_encode($result),true);
        if(empty($result)){
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }
    public function getTrialPhoto(){
        $assmReptNo = $this->inputM('assmReptNo');
        $model = new AssmRept10_model();
        $result = $model->getTrialPhotoNm($assmReptNo,'object');
        $downimage = new Multi_downimage();
        $imageRes = $downimage->id($assmReptNo)->ftpdir('Sales')->localdir('mt')->downloadFile('TrialInjection',$result[0]);
        if($imageRes == false)
        {
            Helper::$ajaxReturn['returnCode'] = 'FTP';
        }else if($imageRes == 'null'){
            Helper::responseEmpty();
        }
        foreach($result[0] as $k => $v){
            $v->Photo = '';
        }
        $result = json_decode(json_encode($result),true);
        if(empty($result)){
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }
    //组装报告信息存储方法
    public function mt_save(){

	    $post_orderid  = $this->inputM('orderid');   //订单号
        $post_mtid     = $this->input('mtid');      //组装号
        $post_mtuser   = $this->jlamp_comm->xssInput('mtuser', 'post');    //组装人
        $post_mtgroup  = $this->jlamp_comm->xssInput('mtgroup', 'post');   //组装部门
        $post_mttalkdate  = $this->jlamp_comm->xssInput('mttalkdate', 'post');  //组装报告时间
        $post_mtdate      = $this->jlamp_comm->xssInput('mtdate', 'post');      //组装时间
        $post_mtsomething = $this->jlamp_comm->xssInput('mtsomething', 'post'); //组装事项
        $post_orderother  = $this->jlamp_comm->xssInput('orderother', 'post');  //备注
        $post_testuser    = $this->jlamp_comm->xssInput('testuser', 'post'); //试模人
        $post_testgroup   = $this->jlamp_comm->xssInput('testgroup', 'post');//试模部门
        $post_testdate    = $this->jlamp_comm->xssInput('testdate', 'post'); //试模日
        $post_testsomething = $this->jlamp_comm->xssInput('testsomething', 'post'); //试模事项
        $post_expclass    = $this->jlamp_comm->xssInput('expclass', 'post'); //区分

        $login_id = $this->getCookie('EmpId');
        $check_mtid = "select AssmReptNo from TSAAssmRept00 where OrderNo = '$post_orderid'";
        $check_mtid_result = $this->jlamp_common_mdl->sqlRow($check_mtid);
        if(empty($post_mtid) && empty($check_mtid_result->AssmReptNo)){ //当前订单未组装
            $post_mtid = date('Ym',intval(time()));
            $sql = "select top 1 AssmReptNo from TSAAssmRept00 where AssmReptNo LIKE '$post_mtid%%' order by AssmReptNo desc";
            $result_mtid = $this->jlamp_common_mdl->sqlRow($sql);
            //如果当月还没有组装号
            if(empty($result_mtid))
            {
                $post_mtid = $post_mtid.'0001';
            }
            else
            {
                $result_mtid = substr($result_mtid->AssmReptNo,6);
                $post_mtid .= $result_mtid;
                $post_mtid = $post_mtid +1;
            }
            $addsql = "insert into TSAAssmRept00 (AssmReptNo,AssmReptDate,AssmDeptCd,AssmEmpID,AssmDate,ExpClss,OrderNo,TrialDeptCd,TrialEmpID,
                                                  TrialDate,AssmContents,TrialContents,Remark,RegEmpID,RegDate,UptEmpID,UptDate,SysRemark)
                            values ('$post_mtid','$post_mttalkdate','$post_mtgroup','$post_mtuser','$post_mtdate','$post_expclass','$post_orderid','$post_testgroup','$post_testuser','$post_testdate',N'$post_mtsomething',N'$post_testsomething',N'$post_orderother',
                          '$login_id',getdate(),'$login_id',getdate(),'mobile-info')";
            $this->jlamp_common_mdl->sqlRows($addsql);

            //检查是否插入成功
            $checkadd = "select AssmReptNo from TSAAssmRept00 where OrderNo = '$post_orderid' AND AssmReptNo = '$post_mtid'";
            $thischeck = $this->jlamp_common_mdl->sqlRows($checkadd);
            if(empty($thischeck[0][0]->AssmReptNo)){
                Helper::responseAddErr();
            }
            else{
                Helper::responseData($thischeck[0][0]->AssmReptNo);
            }
        }
        else //当前订单已经有组装信息
        {
            //核对当前上传组装号和数据库对应订单组装号相同，则执行更新操作
            if($post_mtid == $check_mtid_result->AssmReptNo)
            {
                $savesql = "update TSAAssmRept00 set AssmReptDate = '$post_mttalkdate',Expclss='$post_expclass',AssmDeptCd='$post_mtgroup',AssmEmpID='$post_mtuser',TrialDeptCd='$post_testgroup',
                    TrialEmpID='$post_testuser',TrialDate='$post_testdate',AssmContents= N'$post_mtsomething',TrialContents= N'$post_testsomething',Remark= N'$post_orderother',UptEmpID='$login_id',UptDate=getdate()
                     where AssmReptNo = '$post_mtid' AND OrderNo = '$post_orderid'";
                $result = $this->jlamp_common_mdl->query(false,$savesql);
                if(!$result){
                    Helper::responseSaveErr();
                }
            }else{
                Helper::setResponse('',530);
            }
        }
        $this->response();
    }
    //照片上传方法
    public function upload_photo(){
        $get_assm_id = $this->jlamp_comm->xssInput('mtid', 'get');
        $get_check = $this->jlamp_comm->xssInput('check', 'get');
        switch ($get_check) {
            case 'mt_photo':
                $fun = 'AssembleReport'; //组装照片表
                break;
            case 'test_photo':
                $fun = 'TrialInjection'; //试模照片表
                break;
        }
        if (empty(str_replace(' ', '', $get_assm_id))) {
            $this->recall_array['returnCode'] = 'I994'; //组装号不存在
            $this->recall_array['returnMsg'] = '组装号不存在';
            $this->jlamp_comm->jsonEncEnd($this->recall_array);
        }
        $year = substr($get_assm_id,0,6);
        $path = "/image/uploads/mt/$fun/$year/";

        foreach ($_FILES as $key => $value){
                $this->jlamp_upload->setDefaultPath($path);
                $this->jlamp_upload->setOverWrite(false);
                $times = 'M'.date('Ymdhis',intval(time()));
                $this->jlamp_upload->setFilename($times.rand(100,999));
                $this->jlamp_upload->setAllowType('gif|jpg|png|jpeg');
                $this->jlamp_upload->setUploadFileSize(300000);
                $this->jlamp_upload->getError();
                $res = $this->jlamp_upload->doUpload($key,$get_assm_id,false,false,80,80);
                $recall = array(str_replace(ftpConn::$localFile,'',$res['upload_data']['full_path']),$res['upload_data']['file_name']);
                if(isset($recall) && !empty($recall))
                {
                    $ftp = $this->ftp_photo($recall,$get_assm_id,$get_check);
                    if($ftp == false)
                    {
                        $this->recall_array['returnCode'] = 'FTP'; //组装号不存在
                        $this->recall_array['returnMsg'] = '上传到ftp失败了';
                        break;
                    }
                    else
                    {
                        $saveres = $this->save_photo($recall,$get_assm_id,$get_check);
                        if(!$saveres){
                            break;
                        }
                    }
                }
                sleep(0.3);
        }
        $this->jlamp_comm->jsonEncEnd($this->recall_array);
    }
    //销售负责人存储方法
    public function addSales(){
        $post_assm_id = $this->jlamp_comm->xssInput('mt_id', 'post');
        $post_sales = $this->jlamp_comm->xssInput('sales', 'post');
        $post_sales = str_replace(' ', '', $post_sales);
        $post_assm_id = str_replace(' ', '', $post_assm_id);
        if (empty($post_assm_id)) {
            $this->recall_array['returnCode'] = 'I994'; //组装号不存在
            $this->recall_array['returnMsg'] = '组装号不存在';
            $this->jlamp_comm->jsonEncEnd($this->recall_array);
        }
        if (empty($post_sales)) {
            $this->recall_array['returnCode'] = 'I744'; //销售负责人不存在
            $this->recall_array['returnMsg'] = '销售负责人不存在';
            $this->jlamp_comm->jsonEncEnd($this->recall_array);
        }
        $login_id = $this->getCookie('EmpId');
        //查找当前最大seq值
        $query_seq = "select top 1 Seq from TSAAssmRept30 where AssmReptNo = '$post_assm_id' order by Seq desc";
        $seq_result = $this->jlamp_common_mdl->sqlRow($query_seq);
        if(empty($seq_result))
        {
            $seq_result_find = 0;
        }
        else
        {
            $seq_result_find = $seq_result->Seq;
        }
//        $array_sales = explode('[#*#]',$post_sales);
//        array_pop($array_sales);
        $array_sales = $post_sales;
        if(count($array_sales) > 5)
        {
            $this->recall_array['returnCode'] = 'I714'; //销售负责人不存在
            $this->recall_array['returnMsg'] = '单次最多插入5条记录';
            $this->jlamp_comm->jsonEncEnd($this->recall_array);
        }
        //取最后一条销售人
        $array_sales_last = $array_sales[count($array_sales)-1];
        $sql = "";
        foreach ($array_sales as $k => $value){
            $seq_result_find = $seq_result_find+1;
            $seq_result = '0'.$seq_result_find;
            $sql .= "insert into TSAAssmRept30 (AssmReptNo,Seq,SaleEmpID,RegEmpID,RegDate,UptEmpID,UptDate) values 
                ('$post_assm_id','$seq_result','$value','$login_id',getdate(),'$login_id',getdate());";
        }
        //插入销售负责人信息
        $this->jlamp_common_mdl->query(false,$sql);

        //确认插入成功
        $query = "select top 1 AssmReptNo from TSAAssmRept30 where AssmReptNo = '$post_assm_id' AND Seq = '$seq_result' AND SaleEmpID = '$array_sales_last'";
        $query_result = $this->jlamp_common_mdl->sqlRow($query);
        if($query_result->AssmReptNo != $post_assm_id)
        {
            Helper::responseAddErr();
        }
        $this->response();
    }
    public function uploadAssmPhoto(){
        $assmReptNo = $this->inputM('assmReptNo');
        $image = $_POST['imageList'];
        if (empty($image)) {
            Helper::responseErr('图片不存在');
            $this->response();
        }
        $date = date('Ymdhis',time());
        $dirYear = substr($assmReptNo,0,4);
        $dirMonth = substr($assmReptNo,4,2);
        $dir = "./image/uploads/mt/AssembleReport/$dirYear"."$dirMonth/$assmReptNo";
        $seqRes = DB::queryRow("select top 1 Seq from TSAAssmRept10 where AssmReptNo = '%s' order by Seq desc",[$assmReptNo]);
        foreach ($image as $k => $v){
            $fileNm = 'M'.$date.rand(100,999);
            $imageDir = Img::resolveImageByBase($v,$dir,$fileNm,1200,1200);
            $uploadRes = Ftp::upload($assmReptNo,$imageDir['fileNm'],$imageDir['dir'],'/Sales/AssembleReport');
            if ($uploadRes['modelMsg'] == 'FTP-ERROR') {
                Helper::responseErr('上传到FTP失败');
                $this->response();
            } else if ($uploadRes['modelMsg'] == 'UPLOAD-ERROR') {
                Helper::responseErr('上传到服务器失败');
                $this->response();
            }
            //上传成功，存储图片名到数据库
            else {
                if (empty($seqRes['Seq'])) {
                    $seqRes['Seq'] = '01';
                }
                else {
                    if ($seqRes['Seq'] >= 9) {
                        $seqRes['Seq'] = $seqRes['Seq'] + 1;
                    }
                    else {
                        $seqRes['Seq'] = '0' . ($seqRes['Seq'] + 1);
                    }
                }
                $add = array(
                    'AssmReptNo' => $assmReptNo,
                    'Seq'    => $seqRes['Seq'],
                    'FileNm' => $imageDir['fileNm'],
                    'RegEmpID' => $this->getCookie('EmpId'),
                    'RegDate'  => 'date(now)',
                    'UptEmpId' => $this->getCookie('EmpId'),
                    'UptDate'  => 'date(now)',
                    'AssmDate' => 'date(now)',
                    'FTP_UseYn' => 'Y'
                );
                try{
                    $model = new Multi_dbExecute();
                    $res = $model->table('TSAAssmRept10')->add($add);
                    Helper::$ajaxReturn['data'][] = $imageDir['fileNm'];
                }catch (Exception $e){
                    Helper::responseAddErr();
                }
            }
        }
        $this->response();
    }

    public function uploadTrialPhoto(){
        $assmReptNo = $this->inputM('assmReptNo');
        $image = $_POST['imageList'];
        if (empty($image)) {
            Helper::responseErr('图片不存在');
            $this->response();
        }
        $date = date('Ymdhis',time());
        $dirYear = substr($assmReptNo,0,4);
        $dirMonth = substr($assmReptNo,4,2);
        $dir = "./image/uploads/mt/TrialInjection/$dirYear"."$dirMonth/$assmReptNo";
        $seqRes = DB::queryRow("select top 1 Seq from TSAAssmRept20 where AssmReptNo = '%s' order by Seq desc",[$assmReptNo]);
        foreach ($image as $k => $v){
            $fileNm = 'M'.$date.rand(100,999);
            $imageDir = Img::resolveImageByBase($v,$dir,$fileNm,1200,1200);
            $uploadRes = Ftp::upload($assmReptNo,$imageDir['fileNm'],$imageDir['dir'],'/Sales/TrialInjection');
            if ($uploadRes['modelMsg'] == 'FTP-ERROR') {
                Helper::responseErr('上传到FTP失败');
                $this->response();
            } else if ($uploadRes['modelMsg'] == 'UPLOAD-ERROR') {
                Helper::responseErr('上传到服务器失败');
                $this->response();
            }
            //上传成功，存储图片名到数据库
            else {
                if (empty($seqRes['Seq'])) {
                    $seqRes['Seq'] = '01';
                }
                else {
                    if ($seqRes['Seq'] >= 9) {
                        $seqRes['Seq'] = $seqRes['Seq'] + 1;
                    }
                    else {
                        $seqRes['Seq'] = '0' . ($seqRes['Seq'] + 1);
                    }
                }
                $add = array(
                    'AssmReptNo' => $assmReptNo,
                    'Seq'    => $seqRes['Seq'],
                    'FileNm' => $imageDir['fileNm'],
                    'RegEmpID' => $this->getCookie('EmpId'),
                    'RegDate'  => 'date(now)',
                    'UptEmpId' => $this->getCookie('EmpId'),
                    'UptDate'  => 'date(now)',
                    'TrialDate' => 'date(now)',
                    'FTP_UseYn' => 'Y'
                );
                try{
                    $model = new Multi_dbExecute();
                    $res = $model->table('TSAAssmRept20')->add($add);
                    Helper::$ajaxReturn['data'][] = $imageDir['fileNm'];
                }catch (Exception $e){
                    Helper::responseAddErr();
                }
            }
        }
        $this->response();
    }


    //照片信息存储方法
    private function save_photo($post_photo,$post_assm_id,$post_check)
    {
        $login_id = $this->getCookie('EmpId');
        switch ($post_check) {
            case 'mt_photo':
                $table = 'TSAAssmRept10'; //组装照片文件夹
                $list = 'AssmDate';
                break;
            case 'test_photo':
                $table = 'TSAAssmRept20'; //试模照片文件夹
                $list = 'TrialDate';
                break;
        }
        //查找当前最大seq值
        $query_seq = "select top 1 Seq from $table where AssmReptNo = '$post_assm_id' order by Seq desc";
        $seq_result = $this->jlamp_common_mdl->sqlRow($query_seq);
        if(empty($seq_result))
        {
            $seq_result = '01';
        }
        else
        {
            $seq_result_find = $seq_result->Seq;
            if($seq_result_find >= 10)
            {
                $seq_result = $seq_result_find + 1;
            }
            else
            {
                $seq_result = '0'.($seq_result_find + 1);
            }
        }
        $sql = "insert into $table(AssmReptNo,Seq,FileNm,RegEmpID,RegDate,UptEmpID,UptDate,$list,FTP_UseYn) values 
                ('$post_assm_id','$seq_result',N'$post_photo[1]','$login_id',getdate(),'$login_id',getdate(),getdate(),'Y');";
        $b_result = $this->jlamp_common_mdl->query(false,$sql);
        //检查插入是否成功
        if($b_result)
        {
            $this->recall_array['returnCode'] = 'Y001';
            $this->recall_array['returnMsg'] = $seq_result;
            $this->recall_array['returnClass'] = $post_photo;
            return true;
        }
        else
        {
            return false;
            $this->recall_array['returnCode'] = 'I008';
        }
    }
    public function delSales(){
        $assmReptNo = $this->inputM('assmReptNo');
        $empId      = $this->inputM('empId');
        $Seq        = $this->inputM('Seq');
        try{
            $delRes = DB::queryRows("delete from TSAAssmRept30 where AssmReptNo='%s' AND SaleEmpID = '%s' AND Seq = '%s'",[$assmReptNo,$empId,$Seq]);
        }catch (Exception $e){
            Helper::responseDelErr();
        }
        $this->response();
    }
    public function delAssmphoto(){
	    $assmReptNo = $this->inputM('assmReptNo');
	    $fileNm = $this->inputM('fileNm');
	    $Seq = $this->inputM('Seq');
	    try{
            $result = DB::queryRow("delete from TSAAssmRept10 
                    where AssmReptNo='%s' AND Seq = '%s' AND FileNm = N'%s'",[$assmReptNo,$Seq,$fileNm]);
        }catch (Exception $e){
	        Helper::responseDelErr();
        }
        $this->response();
    }

    public function delTrialPhoto(){
        $assmReptNo = $this->inputM('assmReptNo');
        $fileNm = $this->inputM('fileNm');
        $Seq = $this->inputM('Seq');
        try{
            $result = DB::queryRow("delete from TSAAssmRept20 
                    where AssmReptNo='%s' AND Seq = '%s' AND FileNm = N'%s'",[$assmReptNo,$Seq,$fileNm]);
        }catch (Exception $e){
            Helper::responseDelErr();
        }
        $this->response();
    }
//
//	    $post_assm_id = $this->jlamp_comm->xssInput('ass', 'post');
//        $post_photo   = $this->jlamp_comm->xssInput('photo', 'post');
//        $Seq          = $this->jlamp_comm->xssInput('seq', 'post');
//        $check          = $this->jlamp_comm->xssInput('dom', 'post');
//        if (empty(str_replace(' ', '', $post_assm_id))) {
//            $this->recall_array['returnCode'] = 'I994'; //组装号不存在
//            $this->recall_array['returnMsg'] = '组装号不存在';
//            $this->jlamp_comm->jsonEncEnd($this->recall_array);
//        }
//        if (empty(str_replace(' ', '', $post_photo))) {
//            $this->recall_array['returnCode'] = 'I745';
//            $this->recall_array['returnMsg'] = '图片不存在';
//            $this->jlamp_comm->jsonEncEnd($this->recall_array);
//        }
//        switch ($check) {
//            case 'mt_photo':
//                $table = 'TSAAssmRept10'; //组装照片表
//                break;
//            case 'test_photo':
//                $table = 'TSAAssmRept20'; //试模照片表
//                break;
//        }
//        $sql = "delete from $table where AssmReptNo='$post_assm_id' AND Seq = '$Seq' AND FileNm = '$post_photo'";
//        $b_result = $this->jlamp_common_mdl->query(false,$sql);
//        if($b_result)
//        {
//            $this->recall_array['returnCode'] = 'Y002';
//            $this->jlamp_comm->jsonEncEnd($this->recall_array);
//        }
//        else
//        {
//            $this->recall_array['returnCode'] = 'I009';
//            $this->jlamp_comm->jsonEncEnd($this->recall_array);
//        }
	//ftp上传图片
    private function ftp_photo($filename,$mt_id,$check){
	    switch ($check) {
            case 'mt_photo':
                $fun = 'AssembleReport'; //组装照片表
                break;
            case 'test_photo':
                $fun = 'TrialInjection'; //试模照片表
                break;
        }
        if(empty($fun))
        {
            return false;
        }
//        $conn = ftp_connect('192.168.158.240');
//        ftp_login($conn,'jpapp','61L4g2sj');
        $conn = ftp_connect(ftpConn::$ftp,ftpConn::$port);
        ftp_login($conn,ftpConn::$usernm,ftpConn::$passwd);
        ftp_pasv($conn,true);
        $dirname_year = substr($mt_id,0,4);
        $dirname_month = substr($mt_id,4,2);
        $exist_dir = ftp_rawlist($conn,ftp_pwd($conn)."/Sales/$fun");
        //检测年
        foreach ($exist_dir as $k => $v){
            $exist_dir[$k] =    substr($v,-4,4);
        }
        if(!in_array($dirname_year,$exist_dir)){
            if(!ftp_mkdir($conn, ftp_pwd($conn)."/Sales/$fun/$dirname_year")){
                return false;
            }
        }
        //检测月
        $exist_dir = ftp_rawlist($conn,ftp_pwd($conn)."/Sales/$fun/$dirname_year");
        foreach ($exist_dir as $k => $v){
            $exist_dir[$k] =    substr($v,-2,2);
        }
        if(!in_array($dirname_month,$exist_dir)){
            if(!ftp_mkdir($conn, ftp_pwd($conn)."/Sales/$fun/$dirname_year/$dirname_month")){
                return false;
            }
        }
        //检测组装号文件夹
        $exist_dir = ftp_rawlist($conn,ftp_pwd($conn)."/Sales/$fun/$dirname_year/$dirname_month");
        foreach ($exist_dir as $k => $v){
            $exist_dir[$k] =    substr($v,-10,10);
        }
        if(!in_array($mt_id,$exist_dir)){
            if(!ftp_mkdir($conn, ftp_pwd($conn)."/Sales/$fun/$dirname_year/$dirname_month/$mt_id")) {
                return false;
            }
        }
        ftp_chdir($conn, ftp_pwd($conn)."/Sales/$fun/$dirname_year/$dirname_month/$mt_id");
        $result = ftp_put($conn, $filename[1],ftpConn::$localFile.$filename[0], FTP_BINARY);
        ftp_close($conn);
        return true;
    }
    //ftp获取图片
    private function download_photo($fun,$mt_array){
	    $image = new Image();
	    if(count($mt_array) <= 0)
        {
//            Log::info($fun.' Database image is null');
            return 'null';
        }


        $conn = ftp_connect(ftpConn::$ftp,ftpConn::$port);
        ftp_login($conn,ftpConn::$usernm,ftpConn::$passwd);
        ftp_pasv($conn,true);
        foreach ($mt_array as $k => $v){
            try{
                $mt_id = $v->AssmReptNo;
                $filename = $v->FileNm;
                $dirname_year = substr($v->AssmReptNo,0,4);
                $dirname_month = substr($v->AssmReptNo,4,2);
                $dirname_defualt = substr($v->AssmReptNo,0,6);
                $yeardir = "./image/uploads/mt/$fun/$dirname_defualt/$mt_id";
                if (!is_dir($yeardir)) {
                    mkdir(iconv("UTF-8", "GBK", $yeardir), 0775, true);
                }
                //如果本地没有当前图片，则通过数据库或者ftp下载
                if(!is_file($yeardir."/$filename")) {
                    $filenameGbk =mb_convert_encoding($filename,'GBK','UTF-8');
                    if ($v->FTP_UseYn == 'Y') {
                        $exist_dir = ftp_nlist($conn, ftp_pwd($conn) . "/Sales/$fun/$dirname_year/$dirname_month/$mt_id");
//                        if(!empty($exist_dir)){
//                            if (in_array($filenameGbk,$exist_dir)) {
                                if (!ftp_get($conn, "$yeardir/$filename", ftp_pwd($conn) . "/Sales/$fun/$dirname_year/$dirname_month/$mt_id/$filenameGbk", FTP_BINARY)) {
                                    return false;
                                }
//                            }
//                        }
                    }
                    else {
                        if(!empty($v->Photo && $v->Photo != null))
                        {
                            $imageResource = imagecreatefromstring($v->Photo); // 创建image
                            imagejpeg($imageResource, $yeardir. '/' . $filename); // 写入文件
                            $image->open($yeardir . '/' . $filename);
                            $image->thumb(576, 1024);
                            $image->save($yeardir . '/' . $filename);
                            $imageResource = null;
                        }
                    }
                }
            }catch (Exception $e){
                return false;
            }
        }
        ftp_close($conn);
        return true;
    }

    //用户id和部门id转换为中文方法
    private function queryname($pid,$check){
        switch ($check){
            case 'user':
                $sql = "select * from TMAEmpy00  where EmpID='$pid'";
                $result = $this->jlamp_common_mdl->sqlRow($sql);
                return $result;
                break;
            case 'group':
                $sql = "select * from TMADept00 where DeptCd='$pid'";
                $result = $this->jlamp_common_mdl->sqlRow($sql);
                return $result;
                break;
        }
	}

}

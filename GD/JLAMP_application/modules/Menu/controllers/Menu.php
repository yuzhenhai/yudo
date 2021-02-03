<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * 클래스명: Menu
 * 작성자: 김영탁
 * 클래스설명: 영업집계표(일) 클래스
 *
 * 최초작성일: 2017.11.10
 * 최종수정일: 2017.11.10
 * ---
 * Date         Auth        Desc
 */
class Menu extends Base {
	function __construct() {
		parent::__construct();
		$DB = parent::getCookie('DB');
        parent::setBizDBAlias($DB);
	}

	public function index() {
        $loginId = str_replace(' ','',parent::getCookie('UserID'));
        $result = DB::queryRow("select emp_code from sysUserMaster where user_id = '%s'",[$loginId]);
        if(count($result['emp_code']) > 0){
            $this->setCookie('EmpId',$result['emp_code'],1000000000);
        }else{
            $this->setCookie('EmpId',$loginId,1000000000);
        }
        $this->menuLists();
	}


	/**
	 * 메소드명: menuLists
	 * 작성자: 김영탁
	 * 설 명: 메뉴 페이지
	 *
	 * 최초작성일: 2018.01.26
	 * 최종수정일: 2018.01.26
	 * ---
	 * Date              Auth        Desc
	 */
	public function menuLists() {
		$cssPart = array(
		    '<link href="/third_party/bootstrap-3.3.5/css/bootstrap.css" rel="stylesheet">',
            '<link href="/third_party/bootstrap-3.3.5/css/bootstrap-theme.css" rel="stylesheet">',
            '<link rel="stylesheet" href="/css/Menu/Menu.css?v=1003">',
            '<link rel="stylesheet" href="/css/mui.min.css?v=1005">'
		);
		$jsPart = array(
            '<script type="text/javascript" src="/js/Menu/Menu.js?v=1005"></script>',
            '<script src="/js/mui.min.js?v=1005"></script>',
            '<script src="/js/multiHttp.js?v=1005"></script>'
		);

		$formKey = $this->jlamp_comm->xssInput('formKey', 'get');
		$menuSelection = $this->jlamp_comm->xssInput('menuSelection', 'get');
		
		$this->jlamp_comm->isHtmlDisplay(true);
		$this->jlamp_comm->setCSS($cssPart);
		$this->jlamp_comm->setJS($jsPart);
        $this->jlamp_tp->assign(array(
			'formKey' => $formKey,
			'menuSelection' => $menuSelection
		));
        $this->jlamp_tp->define(['tpl' => 'MenuView/Menu.html']);
        $this->jlamp_tp->template_dir = VIEWS;
	} // end of function menuLists

    //.更新账户权限级别
    public function getAuthApi(){
	    $formId = $this->inputM('formId','post');
        $loginId = $this->loginUserName;
        $auth = DB::queryRow("select 
                                    A.form_auth as user_form_auth,
                                    '' group_form_auth,
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
                    $this->sessionPut($this->sessionKey,'auth',AUTH_A,ONE_YEAR);
                    $auth['form_confirm_yn'] = 'Y';
                    $auth['form_save_yn'] = 'Y';
                    $auth['form_delete_yn'] = 'Y';
                }else {
                    $this->sessionPut($this->sessionKey,'auth','NO',ONE_YEAR);
                }
            }else{
                $this->sessionPut($this->sessionKey,'auth',$auth['group_form_auth'],ONE_YEAR);
            }
        }else{
            $this->sessionPut($this->sessionKey,'auth',$auth['user_form_auth'],ONE_YEAR);
        }
        $this->sessionPut($this->sessionKey,'confirmYn',empty($auth['form_confirm_yn']) ? 'N' : $auth['form_confirm_yn'],ONE_YEAR);
        $this->sessionPut($this->sessionKey,'saveYn',empty($auth['form_save_yn']) ? 'N' : $auth['form_save_yn'],ONE_YEAR);
        $this->sessionPut($this->sessionKey,'deleteYn',empty($auth['form_delete_yn']) ? 'N' : $auth['form_delete_yn'],ONE_YEAR);
        $this->response();
    }

    public function getVersionInfo(){
	    $bateinfo = ['YUDO Mobile ERP 2.4.3'];
	    if($this->langId == 'CHN'){
            $bateinfo[] = '1.每日统计表新增汉斯、先锐查询功能';
            $bateinfo[] = '2.销售状况表新增汉斯、先锐查询功能';
            $bateinfo[] = '3.AS接收模块AS查询功能新增AS编号查询条件';
        }else if($this->langId == 'KOR'){
            $bateinfo[] = '1.일일집계표 한스, 신호 데이터 조회 기능 추가';
            $bateinfo[] = '2.영업상황표 한스, 신호 데이터 조회 기능 추가';
            $bateinfo[] = '3.AS접수 처리 화면에 AS 전표 조회 시 조회 조건: AS 번호를 추가하였습니다.';
        }
        $this->recall_array['data'] = $bateinfo;
        $this->recall_array['returnClass'] = 243;
        $this->jlamp_comm->jsonEncEnd($this->recall_array, true);
    }

    //查询登录者信息
    public function getLoginInfo(){
        $this->load->model('Worker10_model');
        $res = $this->Worker10_model->where(array('',$this->loginUser,''))->find()->getUsers();
        if(empty($res) || empty($this->loginUser)){
            $res['EmpID'] = 'no data';
            $res['EmpNm'] = 'no data';
            $res['DeptNm'] = 'no data';
        }
        $res['userLoginId'] = str_replace(' ','',$this->loginUserName);
        $this->recall_array['data'] = $res;
        $this->jlamp_comm->jsonEncEnd($this->recall_array, true);
    }
	/**
	 * 메소드명: doMenuRows_prc
	 * 작성자: 김영탁
	 * 설 명: 영업집계표(일) 조회 Process
	 *
	 * 최초작성일: 2017.11.10
	 * 최종수정일: 2017.11.10
	 * ---
	 * Date              Auth        Desc
	 */
	public function doMenuRows_prc() {
		// 표준이므로 아래와 같은 형태로 꼭 선언해주어야 한다. (return 되는 변수도 꼭 $result 변수여야 함)
		// returnCode - 프레임워크 E/I 코드
		// returnMsg - 프레임워크에서 발생한 에러 메시지 내용
		// data - return할 Data 배열, 데이터를 담아 return할 때에는 'data' KEY 밑에 배열로 담아야 함. 
		//            $result['data'][KEY] = Value; 형태로 담아야 함
		// valid - SP 에러코드, SP를 사용하는 경우에만 SP 실행 후 에러정보를 담는 KEY
		$result = array(
			'returnCode' => 0,
			'returnMsg' => '',
			'data' => ''
		);
		$formKey = $this->jlamp_comm->xssInput('formKey', 'get');
		$langID = $this->jlamp_comm->xssInput('langID', 'get');
		$menuSelection = $this->jlamp_comm->xssInput('menuSelection', 'get');
		$menu = parent::getMenu(true);
		if(empty($menu)){
            $result['returnCode'] = 550;
            $result['returnMsg'] = '没有使用权.';
            $this->jlamp_comm->jsonEncEnd($result);
        }
	    if (!empty($menu[0]->Children)) {
			$menuHTML = $this->doMenuBuild($menu[0]->Children);
			$menuList = $menu[0]->Children;
			$menuMobileList = $menuList[0]->Children;
			$menuHtmlInfo = array(
				'SalesManage' => array(),
				'ManageInfo' => array(),
				'ASManage' => array(),
			);
//			$result = DB::queryRows("select menu_id,parent_menu_id,menu_name,form_id,assembly_file,menu_category,sort_seq from sysMenuPool where contents_category = 'MOBILE'");
//			print_r($result);
//			extt();
			for($i = 0 ; $i < count($menuMobileList) ; $i++){
				switch ($menuMobileList[$i]->FormID){
                    case 'SalesManage':
                        if (isset($menuMobileList[$i]->Children)) {
                            $menuDetailList = $menuMobileList[$i]->Children;
                            for($j = 0 ; $j < count($menuDetailList) ; $j++){
                                $linkPath = '/'.$menuDetailList[$j]->FormID.'/'.$menuDetailList[$j]->FormID;
//                                $menuHtmlInfo['SalesManage']['html'] .= "<li onclick=\"location.href='".$linkPath."?formKey=".$formKey."&menuSelection=sm'\"><span class=\"item\">".$menuDetailList[$j]->MenuName."</span><span><img src=\"/image/menu_allow.png\" ></li>";
                                $menuHtmlInfo['SalesManage'][]=  array(
                                    'url' => $linkPath.'?formKey='.$formKey.'&menuSelection=sm',
                                    'title' => $menuDetailList[$j]->MenuName,
                                    'icon'  => 'icon-'.$menuDetailList[$j]->AssemblyFile
                                );
                            }
                        }
                        break;
                    case 'ManageInfo':
                        if (isset($menuMobileList[$i]->Children)) {
                            $menuDetailList = $menuMobileList[$i]->Children;
                            for($j = 0 ; $j < count($menuDetailList) ; $j++){
                                $linkPath = '/'.$menuDetailList[$j]->FormID.'/'.$menuDetailList[$j]->FormID;
//                                $menuHtmlInfo['ManageInfo']['html'] .= "<li onclick=\"location.href='".$linkPath."?formKey=".$formKey."&menuSelection=mi'\"><span class=\"item\">".$menuDetailList[$j]->MenuName."</span><span><img src=\"/image/menu_allow.png\" ></li>";
                                $menuHtmlInfo['ManageInfo'][]=  array(
                                    'url' => $linkPath.'?formKey='.$formKey.'&menuSelection=mi',
                                    'title' => $menuDetailList[$j]->MenuName,
                                    'icon'  => 'icon-'.$menuDetailList[$j]->AssemblyFile
                                );
                            }
                        }
                        break;
                    case 'ASManage':
                        if (isset($menuMobileList[$i]->Children)) {
                            $menuDetailList = $menuMobileList[$i]->Children;
                            for($j = 0 ; $j < count($menuDetailList) ; $j++){
                                $linkPath = '/'.$menuDetailList[$j]->FormID.'/'.$menuDetailList[$j]->FormID;
//                                $menuHtmlInfo['ASManage']['html'] .= "<li onclick=\"location.href='".$linkPath."?formKey=".$formKey."&menuSelection=asm'\"><span class=\"item\">".$menuDetailList[$j]->MenuName."</span><span><img src=\"/image/menu_allow.png\" ></li>";
                                $menuHtmlInfo['ASManage'][]=  array(
                                    'url' => $linkPath.'?formKey='.$formKey.'&menuSelection=asm',
                                    'title' => $menuDetailList[$j]->MenuName,
                                    'icon'  => 'icon-'.$menuDetailList[$j]->AssemblyFile
                                );

                            }
                        }
                        break;
                }
			}
			$result['data']= $menuHtmlInfo;
		}else{
            $result['returnCode'] = 550;
            $result['returnMsg'] = '没有使用权.';
        }
		$this->jlamp_comm->jsonEncEnd($result);
	} // end of function doMenuRows_prc
}

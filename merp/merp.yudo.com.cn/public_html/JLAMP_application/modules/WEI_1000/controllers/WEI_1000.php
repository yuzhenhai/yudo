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
class WEI_1000 extends Base {
	function __construct() {
		parent::__construct();
	}

	public function index() {
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
		$cssPart = array(
            '<link href="/third_party/bootstrap-3.3.5/css/bootstrap.css" rel="stylesheet">',
            '<link href="/third_party/bootstrap-3.3.5/css/bootstrap-theme.css" rel="stylesheet">',
            '<link rel="stylesheet" href="/css/WEI_1000/WEI_1000_Lists.css">',
		);
		$jsPart = array(
            '<script type="text/javascript" src="/third_party/KendoUI/js/kendo.all.min.js"></script>',
		    '<script type="text/javascript" src="/third_party/jquery-ui-1.11.4/jquery-ui.js"></script>',
            '<script src="/js/WEI_1000/WEI_1000_Lists.js?v=20180205001"></script>',
		);

		$formKey = $this->jlamp_comm->xssInput('formKey', 'get');
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
		
//		$this->jlamp_tp->setURLType(array(
//			'tpl' => 'WEI_1000_Lists.html'
//		));
        $this->jlamp_tp->define(['tpl' => 'SalesManageView/WEI_1000_Lists.html']);
        $this->jlamp_tp->template_dir = VIEWS;
	} // end of function lists

	/**
	 * 메소드명: lists_prc
	 * 작성자: 김목영
	 * 설 명: 영업집계표(일) 조회 Process
	 *
	 * 최초작성일: 2017.11.10
	 * 최종수정일: 2017.11.10
	 * ---
	 * Date              Auth        Desc
	 */
	//wei_1000数据查询方法
	public function lists_prc() {
		$result = array(
			'returnCode' => 0,
			'returnMsg' => '',
			'data' => ''
		);
		$dateItem = $this->jlamp_comm->xssInput('dateItem','get');
        $baseDate = $this->jlamp_comm->xssInput('baseDate', 'get'); // 기준일
		// 유효성 검사
		// 기준일
		if (empty($baseDate)) {
			$result['returnCode'] = 'I001';
			$result['returnMsg'] = '기준일은 필수입력입니다.';
		
			$this->jlamp_comm->jsonEncEnd($result);
		}
        //计算某个部长管辖的所有经理部门的业绩
        $join_param = array(
            array('pBaseDt', mb_ereg_replace('-', '', $baseDate)),
        );
        $return_param = array(
            array('wStatus', 'ok'),
            array('wResults', '')
        );
        try{
            //查询业绩
            $resRecord = DB::call($this->DB,'SSADayTotal_M5', $join_param, $return_param);
            $resRecord = json_decode(json_encode($resRecord), true);
            $list = array();
            $aa =array();
           foreach ($resRecord as $key => $value) {
         	if(isset($value['DeptNm'])){
         		$list[] = $value;
         	}else{
         		$aa = $value;
         	}
         }

        }catch (Exception $e){
            $result['returnMsg'] = $e->getMessage();
            $this->jlamp_comm->jsonEncEnd($result, true);
        }
        $result['data'] = $list;
        // $result['aa'] = $aa;
		$this->jlamp_comm->jsonEncEnd($result, true);
	} // end of function lists_prc
}

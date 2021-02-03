<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * 클래스명: WEI_1400
 * 작성자: 김목영
 * 클래스설명: 영업집계표(일) 클래스
 *
 * 최초작성일: 2017.11.10
 * 최종수정일: 2017.11.10
 * ---
 * Date         Auth        Desc
 */
class WEI_0200 extends Base {
	function __construct() {
		parent::__construct();
		$this->load->model('Worker10_model');
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
	 * Date              Auth        Desc1
	 */
	public function lists() {
        $this->loginLog('WEI_0200');
		$cssPart = array(
            '<link href="/third_party/KendoUI/styles/kendo.common.min.css" rel="stylesheet">',
            '<link href="/third_party/KendoUI/styles/kendo.bootstrap.min.css" rel="stylesheet">',
            '<link href="/third_party/KendoUI/styles/kendo.bootstrap.mobile.min.css" rel="stylesheet">',
            '<link rel="stylesheet" href="/css/WEI_1400/WEI_1400_Lists.css">',
            '<link href="/third_party/bootstrap-3.3.5/css/bootstrap.css" rel="stylesheet">',
            '<link href="/third_party/bootstrap-3.3.5/css/bootstrap-theme.css" rel="stylesheet">',
		);
		$jsPart = array(
            '<script src="/js/WEI_1400/WEI_1400_Lists.js?v=20180205001"></script>',
            '<script type="text/javascript" src="/third_party/KendoUI/js/kendo.all.min.js"></script>'
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
            'formKey' => $formKey,
			//'langID' => $langID,
			'menuSelection' => $menuSelection
		));
        $this->jlamp_tp->define(['tpl' => 'ManageInfoView/WEI_0200_Lists.html']);
        $this->jlamp_tp->template_dir = VIEWS;
	} // end of function lists

	public function listsSearch() {
	    set_time_limit(10);
        $date = $this->jlamp_comm->xssInput('date', 'get');
        $amtClass = $this->jlamp_comm->xssInput('amtClass', 'get');
        if(empty($amtClass) || empty($date)){
            $this->recall_array['returnCode'] = 'I001';
            $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
        }
        try{
            $result = $this->Worker10_model->select()->getSalesData($amtClass,$date);
            $this->recall_array['data'] = $result;
        }catch (Exception $e){
            $this->recall_array['returnCode'] = 'sql error';
        }
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
	}
	public function test(){
        $result = $this->Worker10_model->select()->getData();
        foreach ($result[0] as $item){

        }
        print_r($result);
    }
}

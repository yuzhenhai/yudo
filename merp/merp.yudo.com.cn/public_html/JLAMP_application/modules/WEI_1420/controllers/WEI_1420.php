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
class WEI_1420 extends Base {

    function __construct()
    {
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
        $formKey = $this->jlamp_comm->xssInput('formKey', 'get');
        //$langID = $this->jlamp_comm->xssInput('langID', 'get');
        $menuSelection = $this->jlamp_comm->xssInput('menuSelection', 'get');

        $this->jlamp_comm->isHtmlDisplay(true);
        //$this->load->library('lib_comm');
        //$subTitle = $this->lib_comm->getMenuName();

        $this->jlamp_tp->assign(array(
            //'subTitle' => $subTitle,
            'formKey' => $formKey,
            //'langID' => $langID,
            'menuSelection' => $menuSelection
        ));
        $this->jlamp_tp->define(['tpl' => 'SalesManageView/WEI_1420_Lists.html']);
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
    public function queryResults() {
        $date = $this->jlamp_comm->xssInput('date', 'get');
        $deptDiv = $this->jlamp_comm->xssInput('deptDiv', 'get');
//        $deptDiv = 'MA10030200';

        $join_param = array(
            array('pBaseDt', $date),
            array('pDeptDiv1',$deptDiv),
            array('pLangCd',$this->langCode)
        );
        $return_param = array(
            array('wStatus', 'ok'),
            array('wResults', '')
        );
        $result = DB::call($this->DB,'dbo.SSADayMarketTotal_M', $join_param, $return_param);
        $result = json_decode(json_encode($result), true);
        $this->recall_array['data'] = $result;
        $this->jlamp_comm->jsonEncEnd($this->recall_array, true);
    }
    // end of function lists_prc
    public function getFilialeList(){
        $res = $this->Worker10_model->where(array('MA1003'))->select()->getLeaders($this->langCode);
        $this->recall_array['data'] = $res;
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
    }
    public function getDeptId(){
//        if(parent::getCookie('auth',false) == 'E' || parent::getCookie('auth',false) == 'NO'){
//            $this->recall_array['returnCode'] = 'user';
//            $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
//        }
        $res = $this->Worker10_model->select()->getDeptId($this->loginUser,'A');//parent::getCookie('auth',false));
        $this->recall_array['data'] = $res;
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
    }


}

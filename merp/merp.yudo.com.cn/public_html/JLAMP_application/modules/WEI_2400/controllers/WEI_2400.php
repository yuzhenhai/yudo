<?php
class WEI_2400 extends Base {
    function __construct() {
        parent::__construct();
//        $this->load->model('Worker10_model');
    }

    public function index(){
        $this->getAuth('WEI_2400');
        $this->loginLog('WEI_2400');
        $formKey = $this->jlamp_comm->xssInput('formKey', 'get');
        $menuSelection = $this->jlamp_comm->xssInput('menuSelection', 'get');
        $this->jlamp_comm->isHtmlDisplay(true);
        $this->jlamp_tp->assign(array(
            'formKey' => $formKey,
            'menuSelection' => $menuSelection
        ));
        $this->jlamp_tp->define(['tpl' => 'SalesBusinessView/WEI_2400_Lists.html']);
        $this->jlamp_tp->template_dir = VIEWS;
    }
    //.查询生产交期列表
    public function getProductDate(){
        $date = $this->input('date');
        $accordingClass = $this->input('accordingClass');
        $accordingNo = $this->input('accordingNo');
        $RefNo = $this->input('RefNo');
        $custNm = $this->input('custNm');
        $authModel = new Auth_model();
        $auth = $authModel->getAuth(parent::getCookie('auth',false),parent::getCookie('EmpId'));
        $productModel = new ProductDate10_model();
        $result = $productModel->getProductDate($auth,$date,$accordingClass,$accordingNo,$custNm,$RefNo);
        if(empty($result)){
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }
    //.查询车间信息
    public function getFarmInfo(){
        $wPlanNo = $this->inputM('wPlanNo');
        $model = new ProductDate10_model();
        $result = $model->getFarmInfo($wPlanNo);
        if(empty($result)){
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }

}
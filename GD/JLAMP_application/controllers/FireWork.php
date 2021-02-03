<?php
class FireWork extends Base {
    /**
     * 获取员工列表
     */
    public function getEmpyList(){
        $empId = $this->input('empId');
        $empNm = $this->input('empNm');
        $deptNm = $this->input('deptNm');
        $count = $this->input('count');
        $model = new Empy10_model();
        $result = $model->getEmpyList($empId,$empNm,$deptNm,$count);
        if(empty($result[0])){
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }

    /**
     * 获取客户列表
     */
    public function getCustList(){
        $custNm = $this->input('custNm');
        $custNo = $this->input('custNo');
        $count = $this->inputM('count');
        $model = new Cust10_model();
        $result = $model->getCustList($custNo,$custNm,$count,$this->langCode);
        if(empty($result[0])){
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }

    /**
     * 获取品目列表
     */
    public function getItemList(){
        $itemNo = $this->input('itemNo');
        $itemNm = $this->input('itemNm');
        $count = $this->inputM('count');
        $model = new Item10_model();
        $result = $model->getItemList($itemNo,$itemNm,$count);
        if(empty($result[0])){
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }

    /**
     * 获取单位列表
     */
    public function getUnitList(){
        $model = new Item10_model();
        $result = $model->getUnitList();
        if(empty($result[0])){
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }


    /**
     * 获取汇率
     */
    public function getCurrRate(){
        $currCd = $this->inputM('currCd');
        $date   = $this->inputM('date');
        $dateYm = substr(str_replace('-','',$date),0,6);
        $model = new System_model();
        $result = $model->getCurrRate($dateYm,$currCd);
        if(empty($result)){
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }
}
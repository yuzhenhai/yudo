<?php
class Api extends Base {
    /**
     * 获取员工列表
     */
    public function getEmpyList(){
        $empId = $this->input('empId');
        $empNm = $this->input('empNm');
        $deptNm = $this->input('deptNm');
        $count = $this->input('count');
        $this->load()->app()->models('Empy10_model');
        $result = $this->Empy10_model->getEmpyList($empId,$empNm,$deptNm,$count);
        if(empty($result)){
            Helper::responseEmpty();
        }
        $this->response();
    }
}
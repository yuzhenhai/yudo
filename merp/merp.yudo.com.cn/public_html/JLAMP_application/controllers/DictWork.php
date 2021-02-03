<?php
class DictWork extends Base {
    /**
     * 获取小分类列表-通用
     */
    public function getDict(){
        $classNm = $this->inputM('classNm');
        $model = new Dict10_model();
        $result = $model->getDict($classNm,$this->langCode);
        if(count($result) <= 0){
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }

    public function getDictChild(){
        $classNm = $this->inputM('classNm');
        $classChildNm = $this->inputM('classChildNm');
        $model = new Dict10_model();
        $result = $model->getDictChild($classNm,$classChildNm,$this->langCode);
        if(count($result) <= 0){
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }

    /**
     * 获取国家列表
     */
    public function getCountryList(){
        $model = new Dict10_model();
        $result = $model->getCountryList($this->langCode);
        if(count($result) <= 0){
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }

    /**
     * 获取交货日期列表
     */
    public function getDelvDateList(){
        $model = new Dict10_model();
        $result = $model->getDelvDateList($this->langCode);
        if(count($result) <= 0){
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }

    /**
     * 获取交货方法列表
     */
    public function getDelvMethodList(){
        $model = new Dict10_model();
        $result = $model->getDelvMethodList($this->langCode);
        if(count($result) <= 0){
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }

    /**
     * 获取market列表
     */
    public function getMarketList(){
        $model = new Dict10_model();
        $result = $model->getMarketList($this->langCode);
        if(count($result) <= 0){
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }
    /**
     * 获取产品分类列表
     */
    public function getGoodClassList(){
        $model = new Dict10_model();
        $result = $model->getGoodClassList($this->langCode);
        if(count($result) <= 0){
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }


    /**
     * 通过父级编码获取子集列表
     */
    public function getlistByParentCd(){
        $parentCd = $this->inputM('parentCd');
        $model = new Dict10_model();
        $result = $model->getMinDict($parentCd,$this->langCode);
        if(count($result) <= 0){
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }

    /**
     * 获取打印区分列表
     */
    public function getPrintClassList(){
        $model = new Dict10_model();
        $result = $model->getPrintClassList($this->langCode);
        if(count($result) <= 0){
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }

    /**
     * 获取报价单状态列表
     */
    public function getQuotStatusList(){
        $model = new Dict10_model();
        $result = $model->getQuotStatusList($this->langCode);
        if(count($result) <= 0){
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }

    /**
     * 单位编码列表
     */
    public function getUnitList(){
        $model = new Dict10_model();
        $result = $model->getPrintClassList($this->langCode);
        if(count($result) <= 0){
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }
    /**
     * 保养区域列表*服务地区区分
     */
    public function getSrvAreaList(){
        $model = new Dict10_model();
        $result = $model->getSrvAreaList($this->langCode);
        if(count($result) <= 0){
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }
    /**
     * 部品返回区分
     */
    public function getItemReturnList(){
        $model = new Dict10_model();
        $result = $model ->getItemReturnList($this->langCode);
        if(count($result) <= 0){
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }
    /**
     * AS类型列表
     */
    public function getASKindList(){
        $model = new Dict10_model();
        $result = $model ->getASKindList($this->langCode);
        if(count($result) <= 0){
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }
    /**
     * AS处理区分列表
     */
    public function getASProcKindList(){
        $model = new Dict10_model();
        $result = $model ->getASProcKindList($this->langCode);
        if(count($result) <= 0){
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }
    /**
     * AS处理结果列表
     */
    public function getASProcResultList(){
        $model = new Dict10_model();
        $result = $model ->getASProcResultList($this->langCode);
        if(count($result) <= 0){
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }


}

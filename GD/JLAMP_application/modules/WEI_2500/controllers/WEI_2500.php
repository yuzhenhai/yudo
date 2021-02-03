<?php

class WEI_2500 extends Base
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->getAuth('WEI_2500');
        $this->loginLog('WEI_2500');
        $formKey = $this->jlamp_comm->xssInput('formKey', 'get');
        $menuSelection = $this->jlamp_comm->xssInput('menuSelection', 'get');
        $this->jlamp_comm->isHtmlDisplay(true);
        $this->jlamp_tp->assign(array(
            'formKey' => $formKey,
            'menuSelection' => $menuSelection
        ));
        $this->jlamp_tp->define(['tpl' => 'SalesBusinessView/WEI_2500_Lists.html']);
        $this->jlamp_tp->template_dir = VIEWS;
    }

    public function getQuoteList()
    {
        $quoteNo = $this->input('quoteNo');
        $custNm = $this->input('custNm');
        $quoteStartDate = $this->inputM('quoteStartDate');
        $quoteEndDate = $this->inputM('quoteEndDate');
        $count = $this->inputM('count');
        $quotoModel = new Quote10_model();
        $authModel = new Auth_model();
        $auth = $authModel->getAuth(parent::getCookie('auth',false),parent::getCookie('UserID'));
        $result = $quotoModel->getQuoteList($quoteNo,$custNm ,$quoteStartDate, $quoteEndDate, $count,$auth);
        if (count($result[0]) <= 0) {
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }

    public function getQuoteInfo()
    {
        $quoteNo = $this->inputM('quoteNo');
        $model = new Quote10_model();
        $result = $model->getQuoteInfo($quoteNo);
        if (count($result) <= 0) {
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }

    public function importAs(){
        $asNo = $this->input('asid');
        $custNm = $this->input('custnm');
        $startDate = $this->input('startDate');
        $endDate = $this->input('endDate');
        $count = $this->input('ascount');
        $model = new Quote10_model();
        $result = $model->importAs($asNo,$custNm,$startDate,$endDate);
        if(count($result[0]) <= 0){
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }

    public function getQuoteJobPower(){
        $empId = $this->inputM('empId');
        $model = new Quote10_model();
        $result = $model->getQuoteJobPower($empId);
        if (count($result) <= 0 || empty(str_replace(' ','',$result['JobNo']))) {
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }

    public function getQuoteItemList()
    {
        $quoteNo = $this->inputM('quoteNo');
        $model = new Quote10_model();
        $result = $model->getQuoteItemList($quoteNo);
        if (count($result[0]) <= 0) {
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }
    public function getServiceRate(){
        $model = new Quote10_model();
        $result = $model->getServiceRate();
        if (count($result) <= 0) {
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }
    public function addServiceCharge(){
        $model = new Quote10_model();
        $result = $model->addServiceCharge();
        if (count($result) <= 0) {
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }

    public function getItemPirc(){
        $itemCd = $this->inputM('itemCd');
        $custCd = $this->inputM('custCd');
        $date = $this->inputM('date');
        $curr = $this->inputM('curr');
        $model = new Item10_model();
        $result = $model->getItemPirc($itemCd, $custCd, $date, $curr);
        if (count($result) <= 0) {
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }

    public function getItemListByAs(){
        $asNo = $this->inputM('asNo');
        $model = new Item10_model();
        $result = $model->getItemListByAs($asNo);
        if (count($result[0]) <= 0) {
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }

    public function getSaleVatRate(){
        $custCd = $this->inputM('custCd');
        $model = new Quote10_model();
        $result = $model->getSaleVatRate($custCd);
        if (count($result) <= 0) {
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }

    public function saveQuote()
    {
        $itemlist = $this->inputM('itemlist');
        $delItemlist = $this->input('delItemlist');
        $ExpClss = $this->input('ExpClss');
        $QuotNo = $this->input('QuotNo');
        $QuotAmd = $this->input('QuotAmd');
        $QuotDate = $this->inputM('QuotDate');
        $DeptCd = $this->inputM('DeptCd');
        $EmpId = $this->inputM('EmpId');
        $QuotType = $this->inputM('QuotType');
        $CustCd = $this->inputM('CustCd');
        $CustomerCd = $this->input('CustomerCd');
        $AgentCd = $this->input('AgentCd');
        $ShipToCd = $this->input('ShipToCd');
        $MakerCd = $this->input('MakerCd');
        $CustPrsn = $this->input('CustPrsn');
        $CustTel = $this->input('CustTel');
        $CustFax = $this->input('CustFax');
        $CustEmail = $this->input('CustEmail');
        $CustRemark = $this->input('CustRemark');
        $ValidDate = $this->input('ValidDate');
        $DelvDate = $this->input('DelvDate');
        $Status = $this->input('Status');
        $GoodNm = $this->input('GoodNm');
        $Payment = $this->input('Payment');
        $CurrCd = $this->input('CurrCd');
        $CurrRate = $this->input('CurrRate');
        $StdSaleAmt = $this->input('StdSaleAmt');
        $StdSaleVat = $this->input('StdSaleVat');
        $QuotAmt = $this->input('QuotAmt');
        $QuotVat = $this->input('QuotVat');
        $DisCountRate = $this->input('DisCountRate');
        $VatYn = $this->input('VatYn');
        $ProposeAmt = $this->input('ProposeAmt');
        $PrnAmtYn = $this->input('PrnAmtYn');
        $Remark = $this->input('Remark');
        $MiOrderRemark = $this->input('MiOrderRemark');
        $ASYn = $this->inputM('ASYn');
        $ASRecvNo = $this->input('ASRecvNo');
        $GoodClass = $this->input('GoodClass');
        $OverseaYn = $this->input('OverseaYn');
        $PrintGubun = $this->input('PrintGubun');
        $RefNo = $this->input('RefNo');
        $Resin = $this->input('Resin');
        $MarketCd = $this->input('MarketCd');
        $PProductCd = $this->input('PProductCd');
        $PPartCd = $this->input('PPartCd');
        $PartDesc = $this->input('PartDesc');
        $SrvArea = $this->input('SrvArea');
        $DelvLimit = $this->input('DelvLimit');
        $DelvMethod = $this->input('DelvMethod');
        $QuotDrawNo = $this->input('QuotDrawNo');
        $GoodSpec = $this->input('GoodSpec');
        $Nation = $this->input('Nation');
        $CustPrsnHP = $this->input('CustPrsnHP');
        $SaleVatRate = $this->input('SaleVatRate');
        //.jobNo
        $authModel = new Auth_model();
        $result = $authModel->getAuth('',$this->loginUserName);
        $JobNo = $result['jobNo'];
        //.计算标准货币
        $nowDate = date('Ym', time());
        $model = new Multi_dbQuery();
        $res = $model->table('TMACurr10')->where(array('CurrCd' => $CurrCd, 'YYMM' => $nowDate))->find();
        if (empty($res)) {
            Helper::setResponse('',980,'noCurrency');
            $this->response();
        }
        if ($CurrCd == 'RMB') {
            $QuotForAmt = $QuotAmt;
            $QuotForVat = $QuotVat;
        } else {
            $QuotForAmt = round(bcdiv($QuotAmt, $res['BasicStdRate'], 10) * 100, 2);
            $QuotForVat = $QuotVat;
        }
        $add = [
            'ExpClss' => $ExpClss,
            'QuotNo' => $QuotNo,
            'QuotType' => $QuotType,
            'QuotAmd' => $QuotAmd,
            'QuotDate' => $QuotDate,
            'DeptCd' => $DeptCd,
            'JobNo' => $JobNo,
            'EmpId' => $EmpId,
            'CustCd' => $CustCd,
            'CustomerCd' => $CustomerCd,
            'AgentCd' => $AgentCd,
            'ShipToCd' => $ShipToCd,
            'MakerCd' => $MakerCd,
            'CustPrsn' => $CustPrsn,
            'CustTel' => $CustTel,
            'CustFax' => $CustFax,
            'CustEmail' => [$CustEmail,'utf-8'],
            'CustRemark' => [$CustRemark,'utf-8'],
            'ValidDate' => $ValidDate,
            'DelvDate' => $DelvDate,
            'Status' => $Status,
            'GoodNm' => [$GoodNm,'utf-8'],
            'Payment' => [$Payment,'utf-8'],
            'CurrCd' => $CurrCd,
            'CurrRate' => $CurrRate,
            'StdSaleAmt' => $StdSaleAmt,
            'StdSaleVat' => $StdSaleVat,
            'QuotAmt' => $QuotAmt,
            'QuotVat' => $QuotVat,
            'DisCountRate' => round($DisCountRate/100,2),
            'VatYn' => $VatYn,
            'QuotForAmt' => $QuotForAmt,
            'QuotForVat' => $QuotForVat,
            'ProposeAmt' => $ProposeAmt,
            'PrnAmtYn' => $PrnAmtYn,
            'Remark' => [$Remark,'utf-8'],
            'MiOrderRemark' => [$MiOrderRemark,'utf-8'],
            'ASYn' => $ASYn,
            'ASRecvNo' => $ASRecvNo,
            'GoodClass' => $GoodClass,
            'OverseaYn' => $OverseaYn,
            'PrintGubun' => $PrintGubun,
            'CfmYn' => 0,
            'CfmEmpId' => '',
            'CfmDate' => '',
            'RegEmpID' => $this->loginUser,
            'RegDate' => 'date(now)',
            'UptEmpID' => $this->loginUser,
            'UptDate' => 'date(now)',
            'RefNo' => [$RefNo,'utf-8'],
            'Resin' => [$Resin,'utf-8'],
            'MarketCd' => $MarketCd,
            'PProductCd' => $PProductCd,
            'PPartCd' => $PPartCd,
            'PartDesc' => [$PartDesc,'utf-8'],
            'SrvArea' => $SrvArea,
            'DelvLimit' => $DelvLimit,
            'DelvMethod' => $DelvMethod,
            'QuotDrawNo' => [$QuotDrawNo,'utf-8'],
            'GoodSpec' => [$GoodSpec,'utf-8'],
            'Nation' => $Nation,
            'CustPrsnHP' => [$CustPrsnHP,'utf-8'],
            'SaleVatRate' => $SaleVatRate
        ];
        $model = new Quote20_model();
        if(empty($QuotNo)){
            try{
                $model->addQuote($QuotNo,$add);
            }catch (Exception $e){
                Helper::responseAddErr();
            }
        }else{
            unset($add['QuotNo']);
            unset($add['CfmEmpId']);
            unset($add['CfmDate']);
            unset($add['CfmYn']);
            unset($add['RegEmpID']);
            unset($add['RegDate']);
            try{
                $model->setQuote($QuotNo,$add);
            }catch (Exception $e){
                Helper::responseSaveErr();
            }
        }
        if(!empty($delItemlist)){
            foreach ($delItemlist as $k => $v){
                $model->delQuoteItem($v['QuotNo'],$v['Sort']);
            }
        }
        if(!empty($itemlist)){
            foreach ($itemlist as $k => $v){
                $itemAdd = [
                    'QuotNo' => $QuotNo,
                    'ExpClss' => $ExpClss,
                    'Sort' => $v['Sort'],//序号
                    'ItemCd' => $v['ItemCd'],//产品型号
                    'UnitCd' => $v['UnitCd'],//单位编码
                    'Qty' => $v['Qty'],//数量
                    'StdPrice' => $v['StdPrice'],//销售标准单价
                    'DCRate' => round($v['DCRate'] == 0 ? $v['DCRate']/100 : $v['DCRate']/100,2),//折扣率(%)
                    'DCPrice' => $v['DCPrice'],//折扣单价
                    'DCAmt' => $v['DCAmt'],//折扣金额
                    'DCVat' => $v['DCVat'],//折扣Vat
                    'Remark' => [$v['Remark'],'utf-8'],//备注
                    'Nation' => $v['Nation'],//国家
                    'NextQty' => $v['NextQty'],//进行数量
                    'StopQty' => $v['StopQty'],//暂停数量
                ];
                if ($CurrCd == 'RMB') {
                    $v['DCForAmt'] = $v['DCAmt'];
                    $v['DCForPrice'] = $v['DCPrice'];
                } else {
                    $v['DCForAmt'] = round(bcdiv($v['DCAmt'], $res['BasicStdRate'], 10) * 100, 2);
                    $v['DCForPrice'] = $v['DCPrice'];
                }
                $item = $model->getQuoteItem($QuotNo,$v['Sort']);
                if(empty($item)){
                    $model->addQuoteItem($QuotNo,$itemAdd);
                }else{
                    $model->setQuoteItem($QuotNo,$v['Sort'],$itemAdd);
                }
            }
        }
        Helper::responseData($QuotNo);
        $this->response();
    }

    public function addOAInterface(){
        $quoteNo = $this->inputM('quoteNo');
        $systemModel = new System_model();
        if($this->loginUser == ''){
            Helper::setResponse('',1001,'不存在当前登录工号');
            $this->response();
        }
        $res = $systemModel->addOAInterface('011',$quoteNo,$this->loginUser,'yudo.SSAQuotCfm',$this->loginUser);
        if($res['code'] == 451){
            Helper::setResponse('',451,'裁决已经存在');
            $this->response();
        }
        $quoteModel = new Quote20_model();
        $saveRes = $quoteModel->changeStatusToOA($quoteNo,true);
        $this->response();
    }

    public function delOAInterface(){
        $quoteNo = $this->inputM('quoteNo');
        $systemModel = new System_model();
        $res = $systemModel->delOAInterface('011',$quoteNo);
        if($res['code'] == 450){
            Helper::setResponse('',450,'裁决不存在');
            $this->response();
        }
        if($res['code'] == 452){
            Helper::setResponse('',452,'裁决不可取消');
            $this->response();
        }
        $quoteModel = new Quote20_model();
        $saveRes = $quoteModel->changeStatusToOA($quoteNo,true);
        $this->response();
    }

    public function confirm()
    {
        $type = $this->inputM('type');
        $quoteNo = $this->inputM('quoteNo');
        $empId = $this->loginUser;
        $input = [
            ['pWorkingTag', $type],
            ['pQuotNo', $quoteNo],
            ['pCfmEmpId', $empId]
        ];
        $output = [
            ['wStatus', 'ok'],
            ['wResults', '']
        ];
        $result = DB::call($this->DB, 'yudo.SSAQuotCfm', $input, $output);
        $msgCd = $result[0]->computed1;
        $returnMsg = DB::queryRow("select MsgTxt from TSMMsge10  where MsgCd = '%s' and LangCd = '%s'", [$msgCd, $this->langCode]);
        Helper::setResponse($returnMsg['MsgTxt'], $result[0]->computed, '', $msgCd);
        $this->response();
    }
}
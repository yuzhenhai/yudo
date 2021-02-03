<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class WEI_2300 extends Base
{
    public $targetList = array(
        'OrderAmt' => 0,
        'InvoiceAmt' => 0,
        'BillAmt' => 0,
        'ReceiptAmt' => 0,
        'OrderForAmt' => 0,
        'InvoiceForAmt' => 0,
        'BillForAmt' => 0,
        'ReceiptForAmt' => 0,
        'OrderAmt_Pre' => 0,
        'InvoiceAmt_Pre' => 0,
        'BillAmt_Pre' => 0,
        'ReceiptAmt_Pre' => 0,
    );

    function __construct()
    {
        parent::__construct();
        $this->load->model('Worker10_model');
    }

    public function index()
    {
        $this->getAuth('WEI_2300');
        $this->loginLog('WEI_2300');
        $this->lists();
    }

    public function lists()
    {
        $formKey = $this->jlamp_comm->xssInput('formKey', 'get');
        $menuSelection = $this->jlamp_comm->xssInput('menuSelection', 'get');
        $this->jlamp_comm->isHtmlDisplay(true);
        $this->jlamp_tp->assign(array(
            'formKey' => $formKey,
            'menuSelection' => $menuSelection
        ));
        $this->jlamp_tp->define(['tpl' => 'SalesBusinessView/WEI_2300_Lists.html']);
        $this->jlamp_tp->template_dir = VIEWS;
    }

    //查询登录者信息
    public function getLoginInfo(){
        $res = $this->Worker10_model->where(array('',$this->loginUser,''))->find()->getUsers();
        $this->recall_array['data'] = $res;
        $this->jlamp_comm->jsonEncEnd($this->recall_array, true);
    }

    //查询填写的目标
    public function getWriteTarget(){
        $userNm = $this->jlamp_comm->xssInput('userNm', 'get');
        $userId = $this->jlamp_comm->xssInput('userId', 'get');
        $groupNm = $this->jlamp_comm->xssInput('groupNm', 'get');
        $startTime = $this->jlamp_comm->xssInput('startTime', 'get');
        $endTime = $this->jlamp_comm->xssInput('endTime', 'get');
        $count = $this->jlamp_comm->xssInput('count', 'get');

        $userRes = $this->Worker10_model->where(array("%$userNm%",'',''))->find()->getUsers();
        //验证权限
        if(parent::getCookie('auth',false) == AUTH_E){
            if($this->loginUser != str_replace(' ','',$userRes['EmpID']) || $userNm == ''){
                $this->recall_array['returnCode'] = 'userPermission';
                $this->jlamp_comm->jsonEncEnd($this->recall_array, true);
            }
        }
        if ($count == 0) {
            $result = $this->Worker10_model->where(array("%$userNm%", "%$groupNm%"))->select()->getWriteTarget($startTime,$endTime);
        } else {
            $result = $this->Worker10_model->where(array("%$userNm%", "%$groupNm%"))->select()->getWriteTargetMore($count,$startTime,$endTime);
        }
        if (count($result[0]) <= 0) {
            $this->recall_array['returnCode'] = 'NULL';
            $this->jlamp_comm->jsonEncEnd($this->recall_array, true);
        }
        $this->recall_array['data'] = $result;
        $this->jlamp_comm->jsonEncEnd($this->recall_array, true);
    }

    //用户列表查询
    public function getUsers()
    {
        $userNm = $this->jlamp_comm->xssInput('userNm', 'get');
        $userId = $this->jlamp_comm->xssInput('userId', 'get');
        $groupNm = $this->jlamp_comm->xssInput('groupNm', 'get');
        $count = $this->jlamp_comm->xssInput('count', 'get');
        if ($count == 0) {
            $result = $this->Worker10_model->where(array("%$userNm%", $userId, "%$groupNm%"))->select()->getUsers();
        } else {
            $result = $this->Worker10_model->where(array("%$userNm%", $userId, "%$groupNm%"))->select()->getUsersMore($count);
        }
        if (count($result[0]) <= 0) {
            $this->recall_array['returnCode'] = 'NULL';
            $this->jlamp_comm->jsonEncEnd($this->recall_array, true);
        }
        $this->recall_array['data'] = $result;
        $this->jlamp_comm->jsonEncEnd($this->recall_array, true);
    }

    //保存销售目标
    public function setSalesTarget()
    {
        $date = $this->jlamp_comm->xssInput('date', 'post');
        $userId = $this->jlamp_comm->xssInput('userId', 'post');
        $groupId = $this->jlamp_comm->xssInput('groupId', 'post');
        $expClass = $this->jlamp_comm->xssInput('expClass', 'post');
        $currency = $this->jlamp_comm->xssInput('currency', 'post');
        $orderAmt = $this->jlamp_comm->xssInput('orderAmt', 'post');
        $invoiceAmt = $this->jlamp_comm->xssInput('invoiceAmt', 'post');
        $billAmt = $this->jlamp_comm->xssInput('billAmt', 'post');
        $receiptAmt = $this->jlamp_comm->xssInput('receiptAmt', 'post');
        if (empty($date) || empty($userId) || empty($groupId) || empty($expClass) || empty($currency)
            || (empty($orderAmt) && $orderAmt !=0)
            || (empty($invoiceAmt) && $invoiceAmt !=0)
            || (empty($billAmt) && $billAmt != 0)
            || (empty($receiptAmt) && $receiptAmt !=0)) {
            $this->recall_array['returnCode'] = 'I001';
            $this->jlamp_comm->jsonEncEnd($this->recall_array, true);
            exit();
        }
        $nowDate = date('Ym', time());
        $res = $this->Worker10_model->table('TMACurr10')->where(array('CurrCd' => $currency, 'YYMM' => $nowDate))->find();
        if (empty($res)) {
            $this->recall_array['returnCode'] = 'noCurrency';
            $this->jlamp_comm->jsonEncEnd($this->recall_array, true);
        }
        if ($currency == 'RMB') {
            $orderForAmt = $orderAmt;
            $invoiceForAmt = $invoiceAmt;
            $billForAmt = $billAmt;
            $receiptForAmt = $receiptAmt;
        } else {
            $orderForAmt = round(bcdiv($orderAmt, $res['BasicStdRate'], 10) * 100, 2);
            $invoiceForAmt = round(bcdiv($invoiceAmt, $res['BasicStdRate'], 10) * 100, 2);
            $billForAmt = round(bcdiv($billAmt, $res['BasicStdRate'], 10) * 100, 2);
            $receiptForAmt = round(bcdiv($receiptAmt, $res['BasicStdRate'], 10) * 100, 2);
        }
        //判断是否已经确定
        $checkConfirm = $this->Worker10_model->table('TSAPlanYMD10')->where(array('CurrCd' => $currency, 'SAPlanDate' => $date, 'ExpClss' => $expClass, 'EmpID' => $userId,'CfmYn' => '0'))->find();
        $this->load->model('Worker20_model');
        if (!empty($checkConfirm)) {
            $save  = array(
                'OrderAmt' => $orderAmt,
                'OrderForAmt' => $orderForAmt,
                'InvoiceAmt' => $invoiceAmt,
                'InvoiceForAmt' => $invoiceForAmt,
                'billAmt' => $billAmt,
                'billForAmt' => $billForAmt,
                'ReceiptAmt' => $receiptAmt,
                'ReceiptForAmt' => $receiptForAmt,
                'UptEmpID' => parent::getCookie('EmpId'),
                'UptDate' => 'date(now)'
            );
            $where = array(
                'ExpClss' => $expClass,
                'DeptCd' => $groupId,
                'EmpID' => $userId,
                'CurrCd' => $currency,
                'SAPlanDate' => $date,
            );
            try {
                $saveRes = $this->Worker20_model->table('TSAPlanYMD10')->where($where)->save($save);
            } catch (Exception $e) {
                $this->recall_array['returnCode'] = 'addErr';
            }
            $this->recall_array['returnCode'] = 'saveSuccess';
            $this->jlamp_comm->jsonEncEnd($this->recall_array, true);
        }else{
            //判断是否存在相同目标记录
            $check1 = $this->Worker10_model->table('TSAPlanYMD10')->where(array('CurrCd' => $currency, 'SAPlanDate' => $date, 'ExpClss' => $expClass, 'EmpID' => $userId))->find();
            if(!empty($check1)){
                $this->recall_array['returnCode'] = 'hasRecord';
                $this->jlamp_comm->jsonEncEnd($this->recall_array, true);
                exit();
            }
            $add = array(
                'ExpClss' => $expClass,
                'DeptCd'  => $groupId,
                'EmpID'   => $userId,
                'CurrCd'  => $currency,
                'SAPlanDate' => $date,
                'OrderAmt'   => $orderAmt,
                'OrderForAmt' => $orderForAmt,
                'InvoiceAmt'  => $invoiceAmt,
                'InvoiceForAmt' => $invoiceForAmt,
                'billAmt' => $billAmt,
                'billForAmt' => $billForAmt,
                'ReceiptAmt' => $receiptAmt,
                'ReceiptForAmt' => $receiptForAmt,
                'RegEmpID' => parent::getCookie('EmpId'),
                'RegDate' => 'date(now)',
                'UptEmpID' => parent::getCookie('EmpId'),
                'UptDate' => 'date(now)'
            );
            try {
                $addRes = $this->Worker20_model->table('TSAPlanYMD10')->add($add);
            } catch (Exception $e) {
                $this->recall_array['returnCode'] = 'addErr';
            }
        }

        $this->jlamp_comm->jsonEncEnd($this->recall_array, true);
    }

    //个人目标确定
    public function targetConfirm(){
        $confirmYn = $this->jlamp_comm->xssInput('confirmYn', 'post');
        $userId = $this->jlamp_comm->xssInput('userId', 'post');
        $groupId = $this->jlamp_comm->xssInput('groupId', 'post');
        $currCd = $this->jlamp_comm->xssInput('currCd', 'post');
        $date = $this->jlamp_comm->xssInput('date', 'post');
        $expClass = $this->jlamp_comm->xssInput('expClass', 'post');

        $repeat = $this->Worker10_model->find()->repeatTarget($date,$userId,$groupId,$currCd,$expClass);
        if(empty($repeat)) {
            $this->recall_array['returnCode'] = 'H001';
            $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
        }
        $YYMM = str_replace('-','',substr($date,0,7));
        $res = $this->Worker10_model->table('TMACurr10')->where(array('CurrCd' => $currCd, 'YYMM' => $YYMM))->find();
        if (empty($res)) {
            $this->recall_array['returnCode'] = 'noCurrency';
            $this->jlamp_comm->jsonEncEnd($this->recall_array, true);
        }
        if ($currCd == 'RMB') {
            $orderForAmt = $repeat['OrderAmt'];
            $invoiceForAmt = $repeat['InvoiceAmt'];
            $billForAmt = $repeat['BillAmt'];
            $receiptForAmt = $repeat['ReceiptAmt'];
        } else {
            $orderForAmt = round(bcdiv($repeat['OrderAmt'], $res['BasicStdRate'], 10) * 100, 2);
            $invoiceForAmt = round(bcdiv($repeat['InvoiceAmt'], $res['BasicStdRate'], 10) * 100, 2);
            $billForAmt = round(bcdiv($repeat['BillAmt'], $res['BasicStdRate'], 10) * 100, 2);
            $receiptForAmt = round(bcdiv($repeat['ReceiptAmt'], $res['BasicStdRate'], 10) * 100, 2);
        }

        $join_param = array(
            array('pWorkingTag', $confirmYn),
            array('pPlanDate', $date),
            array('pExpClss', $expClass),
            array('pDeptCd', $groupId),
            array('pEmpId', $userId),
            array('pCurrCd', $currCd),
            array('pOrderAmt',$repeat['OrderAmt']),
            array('pOrderForAmt',$orderForAmt),
            array('pInvoiceAmt',$repeat['InvoiceAmt']),
            array('pInvoiceForAmt',$invoiceForAmt),
            array('pBillAmt',$repeat['BillAmt']),
            array('pBillForAmt',$billForAmt),
            array('pReceiptAmt',$repeat['ReceiptAmt']),
            array('pReceiptForAmt',$receiptForAmt),
            array('pCfmEmpId',$this->loginUser),
        );
        $return_param = array(
            array('wStatus', 'ok'),
            array('wResults', '')
        );
        $res = DB::call($this->DB,'SSASaleDayPlanCfm',$join_param,$return_param);
        $msgcd = $res[0]->computed1;
        $result = $this->getSpInfo($msgcd);
//        print_r($result);
        //        $sql = "select MsgTxt from TSMMsge10  where MsgCd='$msgcd' and LangCd = '$this->langCode'";
//        $result = $this->jlamp_common_mdl->sqlRow($sql);
//        $result = json_decode(json_encode($result), true);
        $this->recall_array['data'] = $result['error_str'];
        $this->recall_array['returnCode'] = $res[0]->computed;
        $this->recall_array['returnClass'] = $msgcd;
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
    }

    //部长销售目标/业绩查询
    public function getLeaderTarget()
    {
        set_time_limit(30);
        $date = $this->jlamp_comm->xssInput('date', 'post');
        $dateItem = $this->jlamp_comm->xssInput('dateItem', 'post');
        $leaderId = $this->jlamp_comm->xssInput('leaderId', 'post');
        $leaderNm = $this->jlamp_comm->xssInput('leaderNm', 'post');
        $dateRound = $this->jlamp_comm->xssInput('dateRound', 'post');
        $currItem = $this->jlamp_comm->xssInput('currItem', 'post');
        if(parent::getCookie('auth',false) != AUTH_A){
            $this->recall_array['returnCode'] = 'permission';
            $this->jlamp_comm->jsonEncEnd($this->recall_array, true);
        }
        if ($dateItem == 'd') {
            $dateDiv = '1';
        } else if ($dateItem == 'm') {
            $dateDiv = '2';
        } else {
            $dateDiv = '3';
        }
        $allRecord = array();
        $returnData = array();
        if ($leaderId == 'ALL') {
            $leaders = $this->getLeaders('MA1004');
            $mempIds = $this->Worker10_model->select()->getAdminList();
            $this->screenLeaderTarget($leaders[0],$mempIds[0],$date,$dateDiv, $allRecord, $dateRound, $dateItem, $returnData,$currItem);
        } else {

            $allRecord[$leaderNm] = $this->targetList;
            $mempId = $this->Worker10_model->select()->getAdminList($leaderId);
            $this->linkLeaderTarget($mempId, $date, $dateDiv, $allRecord, $leaderNm, $dateRound, $leaderId, $dateItem, $returnData[0],$currItem);
        }
        $this->recall_array['data'] = $returnData;
        $this->jlamp_comm->jsonEncEnd($this->recall_array, true);
    }

    //经理销售目标/业绩查询
    public function getMempIdTarget()
    {
        set_time_limit(30);
        $date = $this->jlamp_comm->xssInput('date', 'post');
        $dateItem = $this->jlamp_comm->xssInput('dateItem', 'post');
        $mempId = $this->jlamp_comm->xssInput('mempId', 'post');
        $mempNm = $this->jlamp_comm->xssInput('mempNm', 'post');
        $dateRound = $this->jlamp_comm->xssInput('dateRound', 'post');
        $currItem = $this->jlamp_comm->xssInput('currItem', 'post');
        if(parent::getCookie('auth',false) != AUTH_A && parent::getCookie('auth',false) != AUTH_M){
            $this->recall_array['returnCode'] = 'permission';
            $this->jlamp_comm->jsonEncEnd($this->recall_array, true);
        }
        if ($dateItem == 'd') {
            $dateDiv = '1';
        } else if ($dateItem == 'm') {
            $dateDiv = '2';
        } else {
            $dateDiv = '3';
        }
        $allRecord = array();
        $returnData = array();
        if ($mempId  == 'ALL' ) {
            //所有经理名单
            $mempids = $this->Worker10_model->select()->getMempId($this->loginUser,parent::getCookie('auth',false));
            $this->screenMempIdTarget($mempids[0], $date, $dateDiv, $allRecord, $dateRound,$dateItem,$returnData,$currItem);

        } else {
            $allRecord[$mempNm] = $this->targetList;
            $this->linkMempIdTarget($mempId,$date, $dateDiv,$allRecord,$dateRound,$mempNm,$dateItem, $returnData[0],$currItem);
        }
        $this->recall_array['data'] = $returnData;
        $this->jlamp_comm->jsonEncEnd($this->recall_array, true);
    }

    //部门销售目标/业绩查询
    public function getDeptIdTarget()
    {
        $t1 = microtime(true);
        set_time_limit(30);
        $date = $this->jlamp_comm->xssInput('date', 'post');
        $dateItem = $this->jlamp_comm->xssInput('dateItem', 'post');
        $deptId = $this->jlamp_comm->xssInput('deptId', 'post');
        $deptNm = $this->jlamp_comm->xssInput('deptNm', 'post');
        $dateRound = $this->jlamp_comm->xssInput('dateRound', 'post');
        $currItem = $this->jlamp_comm->xssInput('currItem', 'post');
        if(parent::getCookie('auth',false) != AUTH_A && parent::getCookie('auth',false) != AUTH_M && parent::getCookie('auth',false) != AUTH_D){
            $this->recall_array['returnCode'] = 'permission';
            $this->jlamp_comm->jsonEncEnd($this->recall_array, true);
        }
        if ($dateItem == 'd') {
            $dateDiv = '1';
        } else if ($dateItem == 'm') {
            $dateDiv = '2';
        } else {
            $dateDiv = '3';
        }
        $allRecord = array();
        $returnData = array();
        if ($deptId == 'ALL') {
            //所有部门列表
            $deptIds = $this->Worker10_model->select()->getDeptId($this->loginUser,parent::getCookie('auth',false));
            $this->screenDeptIdTarget($deptIds[0], $date, $dateDiv, $allRecord, $dateRound, $dateItem, $returnData,$currItem);
        } else {
            $this->linkDeptIdTarget($deptId, $date, $dateDiv, $allRecord, $dateRound,$deptNm, $dateItem, $returnData[0],$currItem);
        }
        if($returnData[0] == 'NULL')$this->recall_array['returnCode'] = 'NULL';
        $this->recall_array['data'] = $returnData;
        $this->jlamp_comm->jsonEncEnd($this->recall_array, true);
    }

    //部门员工目标/业绩查询
    public function getUserTarget(){
        $t1 = microtime(true);
        set_time_limit(30);
        $date = $this->jlamp_comm->xssInput('date', 'post');
        $dateItem = $this->jlamp_comm->xssInput('dateItem', 'post');
        $deptId = $this->jlamp_comm->xssInput('deptId', 'post');
        $deptNm = $this->jlamp_comm->xssInput('deptNm', 'post');
        $dateRound = $this->jlamp_comm->xssInput('dateRound', 'post');
        $currItem = $this->jlamp_comm->xssInput('currItem', 'post');
        if ($dateItem == 'd') {
            $dateDiv = '1';
        } else if ($dateItem == 'm') {
            $dateDiv = '2';
        } else {
            $dateDiv = '3';
        }
        $allRecord = array();
        $returnData = array();
        if(!empty($deptId)){
            $this-> linkUserIdTarget($deptId, $date, $dateDiv, $allRecord, $dateRound, $dateItem, $returnData,$currItem);
        }
        if($returnData[0] == 'NULL')$this->recall_array['returnCode'] = 'NULL';
        $this->recall_array['data'] = $returnData;
        $this->jlamp_comm->jsonEncEnd($this->recall_array, true);
    }

    //指定查询部长数据 join getLeaderTarget();
    private function linkLeaderTarget($res, $date, $dateDiv, &$allRecord, $leaderNm, $dateRound, $leaderId, $dateItem, &$returnData,$currItem)
    {
        $targetRes = array(array());
        $salesPlanRes = array(array());

        //计算某个部长管辖的所有经理部门的业绩
        $join_param = array(
            array('pBaseDate', $date),
            array('pLangCd', $this->langCode),
            array('pDateDiv', $dateDiv),
            array('pCurrItem',$currItem),
        );
        $return_param = array(
            array('wStatus', 'ok'),
            array('wResults', '')
        );
        //查询业绩
        $resRecord = DB::call($this->DB,'SSADayTotal_M3', $join_param, $return_param);
        $resRecord = json_decode(json_encode($resRecord), true);
        //查询目标
        $targetRes = $this->Worker10_model->select()->getTargetByLeader($date, $dateItem,$leaderId);
        //查询计划
        if($dateItem != 'd')$salesPlanRes = $this->Worker10_model->select()->getSalesPlanByLeader($date, $dateItem,$leaderId);

        for ($i = 0; $i < count($res[0]); $i++) {
            //计算某经理下所有部门的业绩总和
            for($s = 0;$s <count($resRecord);$s++){
                if(str_replace(' ','',$res[0][$i]['MEmpID']) == str_replace(' ','',$resRecord[$s]['MEmpID'])){
                    //当前
                    $allRecord[$leaderNm]['OrderAmt'] = bcadd($allRecord[$leaderNm]['OrderAmt'], $resRecord[$s]['OrderAmt'], 2);
                    $allRecord[$leaderNm]['InvoiceAmt'] = bcadd($allRecord[$leaderNm]['InvoiceAmt'], $resRecord[$s]['InvoiceAmt'], 2);
                    $allRecord[$leaderNm]['BillAmt'] = bcadd($allRecord[$leaderNm]['BillAmt'], $resRecord[$s]['BillAmt'], 2);
                    $allRecord[$leaderNm]['ReceiptAmt'] = bcadd($allRecord[$leaderNm]['ReceiptAmt'], $resRecord[$s]['ReceiptAmt'], 2);
                }
            }
        }
        //业绩当前数据转换空值
        empty($allRecord[$leaderNm]['OrderAmt']) ? $recordOrder = 0 : $recordOrder = $allRecord[$leaderNm]['ReceiptAmt'];
        empty($allRecord[$leaderNm]['InvoiceAmt']) ? $recordInvoice = 0 : $recordInvoice = $allRecord[$leaderNm]['InvoiceAmt'];
        empty($allRecord[$leaderNm]['BillAmt']) ? $recordBill = 0 : $recordBill = $allRecord[$leaderNm]['BillAmt'];
        empty($allRecord[$leaderNm]['ReceiptAmt']) ? $recordReceipt = 0 : $recordReceipt = $allRecord[$leaderNm]['ReceiptAmt'];
        //查询当前单位时间和前一个单位时间的目标
//        for ($i = 0; $i < count($dateRound); $i++) {
        $targetOrder = 0;
        $targetInvoice = 0;
        $targetBill = 0;
        $targetReceipt = 0;
        foreach ($targetRes[0] as $t){
            empty($t['OrderAmt']) ? $targetOrder += 0 : $targetOrder += $t['OrderAmt'];
            empty($t['InvoiceAmt']) ? $targetInvoice += 0 : $targetInvoice += $t['InvoiceAmt'];
            empty($t['BillAmt']) ? $targetBill += 0 : $targetBill += $t['BillAmt'];
            empty($t['ReceiptAmt']) ? $targetReceipt += 0 : $targetReceipt += $t['ReceiptAmt'];
        }
        $planOrder = 0;
        $planInvoice = 0;
        $planBill = 0;
        $planReceipt = 0;
        foreach ($salesPlanRes[0] as $plan){
            empty($plan['OrderAmt']) ? $planOrder += 0 : $planOrder += $plan['OrderAmt'];
            empty($plan['InvoiceAmt']) ? $planInvoice += 0 : $planInvoice += $plan['InvoiceAmt'];
            empty($plan['BillAmt']) ? $planBill += 0 :$planBill += $plan['BillAmt'];
            empty($plan['ReceiptAmt']) ? $planReceipt += 0 : $planReceipt += $plan['ReceiptAmt'];
        }
        //组合数据
        $returnData[0]['name'] = $leaderNm;
        $returnData[0]['orderAmt'] = array(
            'target' => $targetOrder,
            'plan'   => $planOrder,
            'salesRecord' => $recordOrder,
            'percent' => round($targetOrder == 0 ? 0 : $recordOrder / $targetOrder * 100, 2) . '%',
            'percent2' => round($planOrder == 0 ? 0 : $recordOrder / $planOrder * 100, 2) . '%',
            'percent3' => round($planOrder == 0 ? 0 : $targetOrder / $planOrder * 100, 2) . '%',
            'date' => $dateRound[0],
        );
        $returnData[0]['InvoiceAmt'] = array(
            'target' => $targetInvoice,
            'plan'   => $planInvoice,
            'salesRecord' => $recordInvoice,
            'percent' => round($targetInvoice == 0 ? 0 : $recordInvoice / $targetInvoice * 100, 2) . '%',
            'percent2' => round($planInvoice == 0 ? 0 : $recordInvoice / $planInvoice * 100, 2) . '%',
            'percent3' => round($planInvoice == 0 ? 0 : $targetInvoice / $planInvoice * 100, 2) . '%',
            'date' => $dateRound[0],
        );
        $returnData[0]['BillAmt'] = array(
            'target' => $targetBill,
            'plan'   => $planBill,
            'salesRecord' => $recordBill,
            'percent' => round($targetBill == 0 ? 0 : $recordBill / $targetBill * 100, 2) . '%',
            'percent2' => round($planBill == 0 ? 0 :$recordBill / $planBill * 100, 2) . '%',
            'percent3' => round($planBill == 0 ? 0 : $targetBill / $planBill * 100, 2) . '%',
            'date' => $dateRound[0],
        );
        $returnData[0]['ReceiptAmt'] = array(
            'target' => $targetReceipt,
            'plan'   => $planReceipt,
            'salesRecord' => $recordReceipt,
            'percent' => round($targetReceipt == 0 ? 0 : $recordReceipt / $targetReceipt * 100, 2) . '%',
            'percent2' => round($planReceipt == 0 ? 0 : $recordReceipt / $planReceipt * 100, 2) . '%',
            'percent3' => round($planReceipt == 0 ? 0 : $targetReceipt / $planReceipt * 100, 2) . '%',
            'date' => $dateRound[0],
        );
//        }
    }

    //指定查询经理数据 join getMempIdTarget();
    private function linkMempIdTarget($mempId, $date, $dateDiv, &$allRecord, $dateRound,$mempNm, $dateItem, &$returnData,$currItem)
    {
        $targetRes = array(array());
        $salesPlanRes = array(array());
        $join_param = array(
            array('pBaseDate', $date),
            array('pLangCd', $this->langCode),
            array('pDateDiv', $dateDiv),
            array('pMEmpID', $mempId),
            array('pCurrItem',$currItem),
        );
        $return_param = array(
            array('wStatus', 'ok'),
            array('wResults', '')
        );
        //查询业绩
        $resRecord = DB::call($this->DB,'SSADayTotal_M3', $join_param, $return_param);
        $resRecord = json_decode(json_encode($resRecord), true);
        //查询目标
        $targetRes = $this->Worker10_model->select()->getTargetByMempId($date,$dateItem,$mempId);
        //查询计划
        if($dateItem != 'd')$salesPlanRes = $this->Worker10_model->select()->getSalesPlanByMempId($date,$dateItem,$mempId);

        //计算某经理下所有部门的业绩总和
        for ($s = 0; $s < count($resRecord); $s++) {
            //当前
            $allRecord[$mempNm]['OrderAmt'] = bcadd($allRecord[$mempNm]['OrderAmt'], $resRecord[$s]['OrderAmt'], 2);
            $allRecord[$mempNm]['InvoiceAmt'] = bcadd($allRecord[$mempNm]['InvoiceAmt'], $resRecord[$s]['InvoiceAmt'], 2);
            $allRecord[$mempNm]['BillAmt'] = bcadd($allRecord[$mempNm]['BillAmt'], $resRecord[$s]['BillAmt'], 2);
            $allRecord[$mempNm]['ReceiptAmt'] = bcadd($allRecord[$mempNm]['ReceiptAmt'], $resRecord[$s]['ReceiptAmt'], 2);
            //上一个
            $allRecord[$mempNm]['OrderAmt_Pre'] = bcadd($allRecord[$mempNm]['OrderAmt_Pre'], $resRecord[$s]['OrderAmt_Pre'], 2);
            $allRecord[$mempNm]['InvoiceAmt_Pre'] = bcadd($allRecord[$mempNm]['InvoiceAmt_Pre'], $resRecord[$s]['InvoiceAmt_Pre'], 2);
            $allRecord[$mempNm]['BillAmt_Pre'] = bcadd($allRecord[$mempNm]['BillAmt_Pre'], $resRecord[$s]['BillAmt_Pre'], 2);
            $allRecord[$mempNm]['ReceiptAmt_Pre'] = bcadd($allRecord[$mempNm]['ReceiptAmt_Pre'], $resRecord[$s]['ReceiptAmt_Pre'], 2);
        }
        $targetOrder = 0;
        $targetInvoice = 0;
        $targetBill = 0;
        $targetReceipt = 0;
        //查询目标
//            if(parent::getCookie('auth',false) == AUTH_A){
//                $targetRes = $this->Worker10_model->select()->getTargetByMempId($date,$dateItem,$mempId);
//            }else if($check == AUTH_A){
//                $targetRes = $this->Worker10_model->select()->getTargetByMempId($date,$dateItem,$mempId);
//            }
        foreach ($targetRes[0] as $t){
            empty($t['OrderAmt']) ? $targetOrder += 0 : $targetOrder += $t['OrderAmt'];
            empty($t['InvoiceAmt']) ? $targetInvoice += 0 : $targetInvoice += $t['InvoiceAmt'];
            empty($t['BillAmt']) ? $targetBill += 0 : $targetBill += $t['BillAmt'];
            empty($t['ReceiptAmt']) ? $targetReceipt += 0 : $targetReceipt += $t['ReceiptAmt'];
        }
        //业绩当前数据转换空值
        empty($allRecord[$mempNm]['OrderAmt']) ? $recordOrder = 0 : $recordOrder = $allRecord[$mempNm]['OrderAmt'];
        empty($allRecord[$mempNm]['InvoiceAmt']) ? $recordInvoice = 0 : $recordInvoice = $allRecord[$mempNm]['InvoiceAmt'];
        empty($allRecord[$mempNm]['BillAmt']) ? $recordBill = 0 : $recordBill = $allRecord[$mempNm]['BillAmt'];
        empty($allRecord[$mempNm]['ReceiptAmt']) ? $recordReceipt = 0 : $recordReceipt = $allRecord[$mempNm]['ReceiptAmt'];

        $planOrder = 0;
        $planInvoice = 0;
        $planBill = 0;
        $planReceipt = 0;
        foreach ($salesPlanRes[0] as $plan){
            empty($plan['OrderAmt']) ? $planOrder += 0 : $planOrder += $plan['OrderAmt'];
            empty($plan['InvoiceAmt']) ? $planInvoice += 0 : $planInvoice += $plan['InvoiceAmt'];
            empty($plan['BillAmt']) ? $planBill += 0 :$planBill += $plan['BillAmt'];
            empty($plan['ReceiptAmt']) ? $planReceipt += 0 : $planReceipt += $plan['ReceiptAmt'];
        }
        //组合数据
        $returnData[0]['name'] = $mempNm;
        $returnData[0]['orderAmt'] = array(
            'target' => $targetOrder,
            'plan'   => $planOrder,
            'salesRecord' => $recordOrder,
            'percent' => round($targetOrder == 0 ? 0 : $recordOrder / $targetOrder * 100, 2) . '%',
            'percent2' => round($planOrder == 0 ? 0 : $recordOrder / $planOrder * 100, 2) . '%',
            'percent3' => round($planOrder == 0 ? 0 : $targetOrder / $planOrder * 100, 2) . '%',
            'date' => $dateRound[0],
        );
        $returnData[0]['InvoiceAmt'] = array(
            'target' => $targetInvoice,
            'plan'   => $planInvoice,
            'salesRecord' => $recordInvoice,
            'percent' => round($targetInvoice == 0 ? 0 : $recordInvoice / $targetInvoice * 100, 2) . '%',
            'percent2' => round($planInvoice == 0 ? 0 : $recordInvoice / $planInvoice * 100, 2) . '%',
            'percent3' => round($planInvoice == 0 ? 0 : $targetInvoice / $planInvoice * 100, 2) . '%',
            'date' => $dateRound[0],
        );
        $returnData[0]['BillAmt'] = array(
            'target' => $targetBill,
            'plan'   => $planBill,
            'salesRecord' => $recordBill,
            'percent' => round($targetBill == 0 ? 0 : $recordBill / $targetBill * 100, 2) . '%',
            'percent2' => round($planBill == 0 ? 0 :$recordBill / $planBill * 100, 2) . '%',
            'percent3' => round($planBill == 0 ? 0 : $targetBill / $planBill * 100, 2) . '%',
            'date' => $dateRound[0],
        );
        $returnData[0]['ReceiptAmt'] = array(
            'target' => $targetReceipt,
            'plan'   => $planReceipt,
            'salesRecord' => $recordReceipt,
            'percent' => round($targetReceipt == 0 ? 0 : $recordReceipt / $targetReceipt * 100, 2) . '%',
            'percent2' => round($planReceipt == 0 ? 0 : $recordReceipt / $planReceipt * 100, 2) . '%',
            'percent3' => round($planReceipt == 0 ? 0 : $targetReceipt / $planReceipt * 100, 2) . '%',
            'date' => $dateRound[0],
        );
    }

    //指定查询组别数据 join getDeptIdTarget();
    private function linkDeptIdTarget($deptId, $date, $dateDiv, &$allRecord, $dateRound,$deptNm,$dateItem, &$returnData,$currItem)
    {
        $targetRes = array(array());
        $salesPlanRes = array(array());
        $join_param = array(
            array('pBaseDate', $date),
            array('pLangCd', $this->langCode),
            array('pDateDiv', $dateDiv),
            array('pDeptCd', $deptId),
            array('pCurrItem',$currItem),
        );
        $return_param = array(
            array('wStatus', 'ok'),
            array('wResults', '')
        );
        //查询业绩
        $resRecord = DB::call($this->DB,'SSADayTotal_M3', $join_param, $return_param);
        $resRecord = json_decode(json_encode($resRecord), true);

        //查询目标
        $targetRes = $this->Worker10_model->select()->getTargetByDeptId($date,$dateItem,$deptId);
        //查询计划
        if($dateItem != 'd')$salesPlanRes = $this->Worker10_model->select()->getSalesPlanByDeptId($date,$dateItem,$deptId);
        //初始化业绩map
        $allRecord[$deptId] = $this->targetList;

        for ($s = 0; $s < count($resRecord); $s++) {
            //当前
            $allRecord[$deptId]['OrderAmt'] = bcadd($allRecord[$deptId]['OrderAmt'], $resRecord[$s]['OrderAmt'], 2);
            $allRecord[$deptId]['InvoiceAmt'] = bcadd($allRecord[$deptId]['InvoiceAmt'], $resRecord[$s]['InvoiceAmt'], 2);
            $allRecord[$deptId]['BillAmt'] = bcadd($allRecord[$deptId]['BillAmt'], $resRecord[$s]['BillAmt'], 2);
            $allRecord[$deptId]['ReceiptAmt'] = bcadd($allRecord[$deptId]['ReceiptAmt'], $resRecord[$s]['ReceiptAmt'], 2);
        }
        //业绩当前数据转换空值
        empty($allRecord[$deptId]['OrderAmt']) ? $recordOrder = 0 : $recordOrder = $allRecord[$deptId]['OrderAmt'];
        empty($allRecord[$deptId]['InvoiceAmt']) ? $recordInvoice = 0 : $recordInvoice = $allRecord[$deptId]['InvoiceAmt'];
        empty($allRecord[$deptId]['BillAmt']) ? $recordBill = 0 : $recordBill = $allRecord[$deptId]['BillAmt'];
        empty($allRecord[$deptId]['ReceiptAmt']) ? $recordReceipt = 0 : $recordReceipt = $allRecord[$deptId]['ReceiptAmt'];

        $targetOrder = 0;
        $targetInvoice = 0;
        $targetBill = 0;
        $targetReceipt = 0;
        foreach ($targetRes[0] as $t){
            empty($t['OrderAmt']) ? $targetOrder += 0 : $targetOrder += $t['OrderAmt'];
            empty($t['InvoiceAmt']) ? $targetInvoice += 0 : $targetInvoice += $t['InvoiceAmt'];
            empty($t['BillAmt']) ? $targetBill += 0 : $targetBill += $t['BillAmt'];
            empty($t['ReceiptAmt']) ? $targetReceipt += 0 : $targetReceipt += $t['ReceiptAmt'];
        }
        $planOrder = 0;
        $planInvoice = 0;
        $planBill = 0;
        $planReceipt = 0;
        foreach ($salesPlanRes[0] as $plan){
            empty($plan['OrderAmt']) ? $planOrder += 0 : $planOrder += $plan['OrderAmt'];
            empty($plan['InvoiceAmt']) ? $planInvoice += 0 : $planInvoice += $plan['InvoiceAmt'];
            empty($plan['BillAmt']) ? $planBill += 0 :$planBill += $plan['BillAmt'];
            empty($plan['ReceiptAmt']) ? $planReceipt += 0 : $planReceipt += $plan['ReceiptAmt'];
        }
        //组合数据
        $returnData[0]['name'] = $deptNm;
        $returnData[0]['orderAmt'] = array(
            'target' => $targetOrder,
            'plan'   => $planOrder,
            'salesRecord' => $recordOrder,
            'percent' => round($targetOrder == 0 ? 0 : $recordOrder / $targetOrder * 100, 2) . '%',
            'percent2' => round($planOrder == 0 ? 0 : $recordOrder / $planOrder * 100, 2) . '%',
            'percent3' => round($planOrder == 0 ? 0 : $targetOrder / $planOrder * 100, 2) . '%',
            'date' => $dateRound[0],
        );
        $returnData[0]['InvoiceAmt'] = array(
            'target' => $targetInvoice,
            'plan'   => $planInvoice,
            'salesRecord' => $recordInvoice,
            'percent' => round($targetInvoice == 0 ? 0 : $recordInvoice / $targetInvoice * 100, 2) . '%',
            'percent2' => round($planInvoice == 0 ? 0 : $recordInvoice / $planInvoice * 100, 2) . '%',
            'percent3' => round($planInvoice == 0 ? 0 : $targetInvoice / $planInvoice * 100, 2) . '%',
            'date' => $dateRound[0],
        );
        $returnData[0]['BillAmt'] = array(
            'target' => $targetBill,
            'plan'   => $planBill,
            'salesRecord' => $recordBill,
            'percent' => round($targetBill == 0 ? 0 : $recordBill / $targetBill * 100, 2) . '%',
            'percent2' => round($planBill == 0 ? 0 :$recordBill / $planBill * 100, 2) . '%',
            'percent3' => round($planBill == 0 ? 0 : $targetBill / $planBill * 100, 2) . '%',
            'date' => $dateRound[0],
        );
        $returnData[0]['ReceiptAmt'] = array(
            'target' => $targetReceipt,
            'plan'   => $planReceipt,
            'salesRecord' => $recordReceipt,
            'percent' => round($targetReceipt == 0 ? 0 : $recordReceipt / $targetReceipt * 100, 2) . '%',
            'percent2' => round($planReceipt == 0 ? 0 : $recordReceipt / $planReceipt * 100, 2) . '%',
            'percent3' => round($planReceipt == 0 ? 0 : $targetReceipt / $planReceipt * 100, 2) . '%',
            'date' => $dateRound[0],
        );
    }

    //指定查询个人数据 join getUserTarget();
    private function linkUserIdTarget($deptId, $date, $dateDiv, &$allRecord, $dateRound,$dateItem, &$returnData,$currItem)
    {
        if(parent::getCookie('auth',false) == AUTH_E || parent::getCookie('auth',false) == 'NO'){
            $userList = $this->Worker10_model->select()->getUsersByUserId($this->loginUser);
        }else{
            $userList = $this->Worker10_model->select()->getUsersByDeptId($deptId,parent::getCookie('auth',false));
        }
        if(empty($userList[0])){
            $returnData = array('NULL');
            return false;
        }
        $targetRes = array();
        $resRecord = array();
        if ($dateItem == 'm') {
            $join_param = array(
                array('pdateItem', $dateItem),
                array('pdate', substr($dateRound[0], 0, 4) . substr($dateRound[0], 5, 2)),
                array('pDeptCd',$deptId)
            );
        } else {
            $join_param = array(
                array('pdateItem', $dateItem),
                array('pdate', $dateRound[0]),
                array('pDeptCd',$deptId)
            );
        }
        $return_param = array(
            array('wStatus', 'ok'),
            array('wResults', '')
        );
        //查询业绩
        $_res = DB::call($this->DB,'SSADayTotal_M4', $join_param, $return_param);
        $resRecord = json_decode(json_encode($_res), true);
        //查询目标
        $targetRes = $this->Worker10_model->select()->getUserTarget($dateRound[0],$dateItem);

        //业绩筛选合并
        foreach ($userList[0] as $k => $v) {
            //初始化业绩map
            $_userId = str_replace(' ','',$v['value']);
            $allRecord[$v['text']] = $this->targetList;
            $targetOrder = 0;
            $targetInvoice = 0;
            $targetBill = 0;
            $targetReceipt = 0;
            //业绩
            for ($s = 0; $s < count($resRecord); $s++) {
//                $_resultsGroupId = str_replace(' ','',$resRecord[$s]['DeptCd']);
                $_resultsUserId  = str_replace(' ','',$resRecord[$s]['EmpId']);
                if ($_userId == $_resultsUserId) {
                    $allRecord[$v['text']]['OrderForAmt'] = bcadd($allRecord[$v['text']]['OrderForAmt'],  empty($resRecord[$s]['OrderForAmt']) ? 0 :$resRecord[$s]['OrderForAmt'] , 2);
                    $allRecord[$v['text']]['InvoiceForAmt'] = bcadd($allRecord[$v['text']]['InvoiceForAmt'], empty($resRecord[$s]['InvoiceForAmt'])? 0 :$resRecord[$s]['InvoiceForAmt'], 2);
                    $allRecord[$v['text']]['BillForAmt'] = bcadd($allRecord[$v['text']]['BillForAmt'], empty($resRecord[$s]['BillForAmt'])? 0 :$resRecord[$s]['BillForAmt'], 2);
                    $allRecord[$v['text']]['ReceiptForAmt'] = bcadd($allRecord[$v['text']]['ReceiptForAmt'], empty($resRecord[$s]['ReceiptForAmt'])? 0 :$resRecord[$s]['ReceiptForAmt'], 2);
                }
            }
            $recordOrder = empty($allRecord[$v['text']]['OrderForAmt']) ? 0 : $allRecord[$v['text']]['OrderForAmt'];
            $recordInvoice = empty($allRecord[$v['text']]['InvoiceForAmt']) ? 0 :$allRecord[$v['text']]['InvoiceForAmt'];
            $recordBill = empty($allRecord[$v['text']]['BillForAmt']) ? 0 :$allRecord[$v['text']]['BillForAmt'];
            $recordReceipt = empty($allRecord[$v['text']]['ReceiptForAmt']) ? 0 : $allRecord[$v['text']]['ReceiptForAmt'];

            //获取部门的目标
            foreach ($targetRes[0] as $t){
                if ($v['value'] == $t['EmpId']) {
                    empty($t['OrderAmt']) ? $targetOrder += 0 : $targetOrder += $t['OrderAmt'];
                    empty($t['InvoiceAmt']) ? $targetInvoice += 0 : $targetInvoice += $t['InvoiceAmt'];
                    empty($t['BillAmt']) ? $targetBill += 0 : $targetBill += $t['BillAmt'];
                    empty($t['ReceiptAmt']) ? $targetReceipt += 0 : $targetReceipt += $t['ReceiptAmt'];
                }
            }
            //组合数据,每次输出一个部门目标、业绩
            $returnData[$k][0]['name'] = $v['text'];
            $returnData[$k][0]['orderAmt'] = array(
                'target' => $targetOrder,
                'salesRecord' => $recordOrder,
                'percent' => round($targetOrder == 0 ? 0 : $recordOrder / $targetOrder * 100, 2) . '%',
                'date' => $dateRound[0],
            );
            $returnData[$k][0]['InvoiceAmt'] = array(
                'target' => $targetInvoice,
                'salesRecord' => $recordInvoice,
                'percent' => round($targetInvoice == 0 ? 0 : $recordInvoice / $targetInvoice * 100, 2) . '%',
                'date' => $dateRound[0],
            );
            $returnData[$k][0]['BillAmt'] = array(
                'target' => $targetBill,
                'salesRecord' => $recordBill,
                'percent' => round($targetBill == 0 ? 0 : $recordBill / $targetBill * 100, 2) . '%',
                'date' => $dateRound[0],
            );
            $returnData[$k][0]['ReceiptAmt'] = array(
                'target' => $targetReceipt,
                'salesRecord' => $recordReceipt,
                'percent' => round($targetReceipt == 0 ? 0 : $recordReceipt / $targetReceipt * 100, 2) . '%',
                'date' => $dateRound[0],
            );
        }
    }

    //查询所有部长数据
    private function screenLeaderTarget($leaders,$mempIds,$date,$dateDiv, &$allRecord, $dateRound, $dateItem, &$returnData,$currItem){
        $targetRes = array(array());
        $salesPlanRes = array(array());
        $join_param = array(
            array('pBaseDate', $date),
            array('pLangCd', $this->langCode),
            array('pDateDiv', $dateDiv),
            array('pCurrItem',$currItem),
        );
        $return_param = array(
            array('wStatus', 'ok'),
            array('wResults', '')
        );
        //查询经理管辖的部门
        $resDeptCd = $this->Worker10_model->select()->getDeptIdResults($this->loginUser,parent::getCookie('auth',false));
        //查询业绩
        $resRecord = DB::call($this->DB,'SSADayTotal_M3', $join_param, $return_param);
        $resRecord = json_decode(json_encode($resRecord), true);

        //查询目标
//        for ($i = 0; $i < count($dateRound); $i++) {
//            $targetRes[$i] = $this->Worker10_model->select()->getTargetByAll($dateRound[$i], $dateItem);
//        }
        $targetRes = $this->Worker10_model->select()->getTarget($dateRound[0], $dateItem);
        if($dateItem != 'd') $salesPlanRes = $this->Worker10_model->select()->getSalesPlan($dateRound[0], $dateItem);
        //遍历领导
        foreach($leaders as $Lkey => $Lv){
            //初始化目标map
            $targetRecord[$Lv['text']] = $this->targetList;
            //初始化计划map
            $planRecord[$Lv['text']] = $this->targetList;
            //初始化业绩map
            $allRecord[$Lv['text']] = $this->targetList;
            //遍历经理
            foreach ($mempIds as $k => $v) {
                //遍历业绩
                for ($s = 0; $s < count($resRecord); $s++) {
                    if (str_replace(' ','',$v['MEmpID']) == $resRecord[$s]['MEmpID'] && str_replace(' ', '', $v['DeptDiv2']) == $Lv['value']) {
                        //当前
                        $allRecord[$Lv['text']]['OrderAmt'] = bcadd($allRecord[$Lv['text']]['OrderAmt'], $resRecord[$s]['OrderAmt'], 2);
                        $allRecord[$Lv['text']]['InvoiceAmt'] = bcadd($allRecord[$Lv['text']]['InvoiceAmt'], $resRecord[$s]['InvoiceAmt'], 2);
                        $allRecord[$Lv['text']]['BillAmt'] = bcadd($allRecord[$Lv['text']]['BillAmt'], $resRecord[$s]['BillAmt'], 2);
                        $allRecord[$Lv['text']]['ReceiptAmt'] = bcadd($allRecord[$Lv['text']]['ReceiptAmt'], $resRecord[$s]['ReceiptAmt'], 2);
                        //上一个
                        $allRecord[$Lv['text']]['OrderAmt_Pre'] = bcadd($allRecord[$Lv['text']]['OrderAmt_Pre'], $resRecord[$s]['OrderAmt_Pre'], 2);
                        $allRecord[$Lv['text']]['InvoiceAmt_Pre'] = bcadd($allRecord[$Lv['text']]['InvoiceAmt_Pre'], $resRecord[$s]['InvoiceAmt_Pre'], 2);
                        $allRecord[$Lv['text']]['BillAmt_Pre'] = bcadd($allRecord[$Lv['text']]['BillAmt_Pre'], $resRecord[$s]['BillAmt_Pre'], 2);
                        $allRecord[$Lv['text']]['ReceiptAmt_Pre'] = bcadd($allRecord[$Lv['text']]['ReceiptAmt_Pre'], $resRecord[$s]['ReceiptAmt_Pre'], 2);
                    }
                }
                //获取目标
                foreach ($targetRes[0] as $t){
                    foreach($resDeptCd[0] as $itemDeptCd){
                        //如果匹配到目标中的部门，则取出经理ID对比是否加入计算
                        if($itemDeptCd['DeptCd'] == $t['DeptCd']){
                            //如果当前部门的经理匹配，则计算
                            if ($v['MEmpID'] == $itemDeptCd['value'] && $v['DeptDiv2'] == $Lv['value']) {
                                empty($t['OrderAmt']) ? $targetRecord[$Lv['text']]['OrderAmt'] += 0 : $targetRecord[$Lv['text']]['OrderAmt'] += $t['OrderAmt'];
                                empty($t['InvoiceAmt']) ? $targetRecord[$Lv['text']]['InvoiceAmt'] += 0 : $targetRecord[$Lv['text']]['InvoiceAmt'] += $t['InvoiceAmt'];
                                empty($t['BillAmt']) ? $targetRecord[$Lv['text']]['BillAmt'] += 0 : $targetRecord[$Lv['text']]['BillAmt'] += $t['BillAmt'];
                                empty($t['ReceiptAmt']) ? $targetRecord[$Lv['text']]['ReceiptAmt'] += 0 : $targetRecord[$Lv['text']]['ReceiptAmt'] += $t['ReceiptAmt'];
                            }
                        }
                    }
                }
                //获取计划
                foreach ($salesPlanRes[0] as $plan){
                    foreach($resDeptCd[0] as $itemDeptCd){
                        //如果匹配到计划中的部门，则取出经理ID对比是否加入计算
                        if($itemDeptCd['DeptCd'] == $plan['DeptCd']){
                            //如果当前部门的经理匹配，则计算
                            if ($v['MEmpID'] == $itemDeptCd['value'] && $v['DeptDiv2'] == $Lv['value']) {
                                empty($plan['OrderAmt']) ? $planRecord[$Lv['text']]['OrderAmt'] += 0 : $planRecord[$Lv['text']]['OrderAmt'] += $plan['OrderAmt'];
                                empty($plan['InvoiceAmt']) ? $planRecord[$Lv['text']]['InvoiceAmt'] += 0 : $planRecord[$Lv['text']]['InvoiceAmt'] += $plan['InvoiceAmt'];
                                empty($plan['BillAmt']) ? $planRecord[$Lv['text']]['BillAmt'] += 0 : $planRecord[$Lv['text']]['BillAmt'] += $plan['BillAmt'];
                                empty($plan['ReceiptAmt']) ? $planRecord[$Lv['text']]['ReceiptAmt'] += 0 : $planRecord[$Lv['text']]['ReceiptAmt'] += $plan['ReceiptAmt'];
                            }
                        }
                    }
                }
//                //获取昨日目标
//                foreach ($targetRes[1][0] as $t){
//                    foreach($resDeptCd[0] as $itemDeptCd){
//                        //如果匹配到目标中的部门，则取出经理ID对比是否加入计算
//                        if($itemDeptCd['DeptCd'] == $t['DeptCd']){
//                            //如果当前部门的经理匹配，则计算
//                            if ($v['MEmpID'] == $itemDeptCd['value'] && $v['DeptDiv2'] == $Lv['value']) {
//                                empty($t['OrderAmt']) ? $targetRecord[$Lv['text']]['OrderAmt_Pre'] += 0 : $targetRecord[$Lv['text']]['OrderAmt_Pre'] += $t['OrderAmt'];
//                                empty($t['InvoiceAmt']) ? $targetRecord[$Lv['text']]['InvoiceAmt_Pre'] += 0 : $targetRecord[$Lv['text']]['InvoiceAmt_Pre'] += $t['InvoiceAmt'];
//                                empty($t['BillAmt']) ? $targetRecord[$Lv['text']]['BillAmt_Pre'] += 0 : $targetRecord[$Lv['text']]['BillAmt_Pre'] += $t['BillAmt'];
//                                empty($t['ReceiptAmt']) ? $targetRecord[$Lv['text']]['ReceiptAmt_Pre'] += 0 : $targetRecord[$Lv['text']]['ReceiptAmt_Pre'] += $t['ReceiptAmt'];
//                            }
//                        }
//                    }
//                }
            }
            //今日数据组合--------------
            $targetOrder   = $targetRecord[$Lv['text']]['OrderAmt'];
            $targetInvoice = $targetRecord[$Lv['text']]['InvoiceAmt'];
            $targetBill    = $targetRecord[$Lv['text']]['BillAmt'];
            $targetReceipt = $targetRecord[$Lv['text']]['ReceiptAmt'];

            $planOrder   = $planRecord[$Lv['text']]['OrderAmt'];
            $planInvoice = $planRecord[$Lv['text']]['InvoiceAmt'];
            $planBill    = $planRecord[$Lv['text']]['BillAmt'];
            $planReceipt = $planRecord[$Lv['text']]['ReceiptAmt'];

            $recordOrder   = $allRecord[$Lv['text']]['OrderAmt'];
            $recordInvoice = $allRecord[$Lv['text']]['InvoiceAmt'];
            $recordBill    = $allRecord[$Lv['text']]['BillAmt'];
            $recordReceipt = $allRecord[$Lv['text']]['ReceiptAmt'];
            //组合数据,每次输出一个经理的目标、业绩,0今日，1昨日
            $returnData[$Lkey][0]['name'] = $Lv['text'];
            $returnData[$Lkey][0]['orderAmt'] = array(
                'target' => $targetOrder,
                'plan'   => $planOrder,
                'salesRecord' => $recordOrder,
                'percent' => round($targetOrder == 0 ? 0 : $recordOrder / $targetOrder * 100, 2) . '%',
                'percent2' => round($planOrder == 0 ? 0 : $recordOrder / $planOrder * 100, 2) . '%',
                'percent3' => round($planOrder == 0 ? 0 : $targetOrder / $planOrder * 100, 2) . '%',
                'date' => $dateRound[0],
            );
            $returnData[$Lkey][0]['InvoiceAmt'] = array(
                'target' => $targetInvoice,
                'plan'   => $planInvoice,
                'salesRecord' => $recordInvoice,
                'percent' => round($targetInvoice == 0 ? 0 : $recordInvoice / $targetInvoice * 100, 2) . '%',
                'percent2' => round($planInvoice == 0 ? 0 : $recordInvoice / $planInvoice * 100, 2) . '%',
                'percent3' => round($planInvoice == 0 ? 0 : $targetInvoice / $planInvoice * 100, 2) . '%',
                'date' => $dateRound[0],
            );
            $returnData[$Lkey][0]['BillAmt'] = array(
                'target' => $targetBill,
                'plan'   => $planBill,
                'salesRecord' => $recordBill,
                'percent' => round($targetBill == 0 ? 0 : $recordBill / $targetBill * 100, 2) . '%',
                'percent2' => round($planBill == 0 ? 0 :$recordBill / $planBill * 100, 2) . '%',
                'percent3' => round($planBill == 0 ? 0 : $targetBill / $planBill * 100, 2) . '%',
                'date' => $dateRound[0],
            );
            $returnData[$Lkey][0]['ReceiptAmt'] = array(
                'target' => $targetReceipt,
                'plan'   => $planReceipt,
                'salesRecord' => $recordReceipt,
                'percent' => round($targetReceipt == 0 ? 0 : $recordReceipt / $targetReceipt * 100, 2) . '%',
                'percent2' => round($planReceipt == 0 ? 0 : $recordReceipt / $planReceipt * 100, 2) . '%',
                'percent3' => round($planReceipt == 0 ? 0 : $targetReceipt / $planReceipt * 100, 2) . '%',
                'date' => $dateRound[0],
            );
//            //昨日数据组合----------------
//            $targetOrder   = $targetRecord[$Lv['text']]['OrderAmt_Pre'];
//            $targetInvoice = $targetRecord[$Lv['text']]['InvoiceAmt_Pre'];
//            $targetBill    = $targetRecord[$Lv['text']]['BillAmt_Pre'];
//            $targetReceipt = $targetRecord[$Lv['text']]['ReceiptAmt_Pre'];
//
//            $recordOrder   = $allRecord[$Lv['text']]['OrderAmt_Pre'];
//            $recordInvoice = $allRecord[$Lv['text']]['InvoiceAmt_Pre'];
//            $recordBill    = $allRecord[$Lv['text']]['BillAmt_Pre'];
//            $recordReceipt = $allRecord[$Lv['text']]['ReceiptAmt_Pre'];
//            //组合数据,每次输出一个经理的目标、业绩,0今日，1昨日
//            $returnData[$Lkey][1]['name'] = $Lv['text'];
//            $returnData[$Lkey][1]['orderAmt'] = array(
//                'target' => $targetOrder,
//                'salesRecord' => $recordOrder,
//                'percent' => round($targetOrder == 0 ? 0 : $recordOrder / $targetOrder * 100, 2) . '%',
//                'date' => $dateRound[1],
//            );
//            $returnData[$Lkey][1]['InvoiceAmt'] = array(
//                'target' => $targetInvoice,
//                'salesRecord' => $recordInvoice,
//                'percent' => round($targetInvoice == 0 ? 0 : $recordInvoice / $targetInvoice * 100, 2) . '%',
//                'date' => $dateRound[1],
//            );
//            $returnData[$Lkey][1]['BillAmt'] = array(
//                'target' => $targetBill,
//                'salesRecord' => $recordBill,
//                'percent' => round($targetBill == 0 ? 0 : $recordBill / $targetBill * 100, 2) . '%',
//                'date' => $dateRound[1],
//            );
//            $returnData[$Lkey][1]['ReceiptAmt'] = array(
//                'target' => $targetReceipt,
//                'salesRecord' => $recordReceipt,
//                'percent' => round($targetReceipt == 0 ? 0 : $recordReceipt / $targetReceipt * 100, 2) . '%',
//                'date' => $dateRound[1],
//            );

        }
    }

    //查询所有经理数据
    private function screenMempIdTarget($mempIdList, $date, $dateDiv, &$allRecord, $dateRound, $dateItem, &$returnData,$currItem){
        $targetRes = array();
        $salesPlanRes = array(array());
        $join_param = array(
            array('pBaseDate', $date),
            array('pLangCd', $this->langCode),
            array('pDateDiv', $dateDiv),
            array('pCurrItem',$currItem),
        );
        $return_param = array(
            array('wStatus', 'ok'),
            array('wResults', '')
        );
        //查询经理管辖的部门
        $resDeptCd = $this->Worker10_model->select()->getDeptIdResults($this->loginUser,parent::getCookie('auth',false));
        //查询业绩
        $resRecord = DB::call($this->DB,'SSADayTotal_M3', $join_param, $return_param);
        $resRecord = json_decode(json_encode($resRecord), true);

        //查询目标
//        for ($i = 0; $i < count($dateRound); $i++) {
//            $targetRes[$i] = $this->Worker10_model->select()->getTargetByAll($dateRound[$i], $dateItem);
//        }
        $targetRes = $this->Worker10_model->select()->getTarget($date,$dateItem);
        if($dateItem != 'd') $salesPlanRes = $this->Worker10_model->select()->getSalesPlan($dateRound[0], $dateItem);
        //业绩筛选合并
        foreach ($mempIdList as $k => $v) {

            //初始化业绩map
            $allRecord[$v['text']] = $this->targetList;

            for ($s = 0; $s < count($resRecord); $s++) {
                if (str_replace(' ','',$v['value']) == $resRecord[$s]['MEmpID']) {
                    //当前
                    $allRecord[$v['text']]['OrderAmt'] = bcadd($allRecord[$v['text']]['OrderAmt'], $resRecord[$s]['OrderAmt'], 2);
                    $allRecord[$v['text']]['InvoiceAmt'] = bcadd($allRecord[$v['text']]['InvoiceAmt'], $resRecord[$s]['InvoiceAmt'], 2);
                    $allRecord[$v['text']]['BillAmt'] = bcadd($allRecord[$v['text']]['BillAmt'], $resRecord[$s]['BillAmt'], 2);
                    $allRecord[$v['text']]['ReceiptAmt'] = bcadd($allRecord[$v['text']]['ReceiptAmt'], $resRecord[$s]['ReceiptAmt'], 2);
                    //上一个
                    $allRecord[$v['text']]['OrderAmt_Pre'] = bcadd($allRecord[$v['text']]['OrderAmt_Pre'], $resRecord[$s]['OrderAmt_Pre'], 2);
                    $allRecord[$v['text']]['InvoiceAmt_Pre'] = bcadd($allRecord[$v['text']]['InvoiceAmt_Pre'], $resRecord[$s]['InvoiceAmt_Pre'], 2);
                    $allRecord[$v['text']]['BillAmt_Pre'] = bcadd($allRecord[$v['text']]['BillAmt_Pre'], $resRecord[$s]['BillAmt_Pre'], 2);
                    $allRecord[$v['text']]['ReceiptAmt_Pre'] = bcadd($allRecord[$v['text']]['ReceiptAmt_Pre'], $resRecord[$s]['ReceiptAmt_Pre'], 2);
                }
            }
            //统计今天/昨天数据
//            foreach($targetRes as $key => $values){
            //今天业绩排除NULL
            empty($allRecord[$v['text']]['OrderAmt']) ? $recordOrder = 0 : $recordOrder = $allRecord[$v['text']]['OrderAmt'];
            empty($allRecord[$v['text']]['InvoiceAmt']) ? $recordInvoice = 0 : $recordInvoice = $allRecord[$v['text']]['InvoiceAmt'];
            empty($allRecord[$v['text']]['BillAmt']) ? $recordBill = 0 : $recordBill = $allRecord[$v['text']]['BillAmt'];
            empty($allRecord[$v['text']]['ReceiptAmt']) ? $recordReceipt = 0 : $recordReceipt = $allRecord[$v['text']]['ReceiptAmt'];

            $targetOrder = 0;
            $targetInvoice = 0;
            $targetBill = 0;
            $targetReceipt = 0;
            //获取今天/昨天部门的目标
            foreach ($targetRes[0] as $t){
                foreach($resDeptCd[0] as $itemDeptCd){
                    //如果匹配到目标中的部门，则取出经理ID对比是否加入计算
                    if($itemDeptCd['DeptCd'] == $t['DeptCd']){
                        //如果当前部门的经理匹配，则计算
                        if ($v['value'] == $itemDeptCd['value']) {
                            empty($t['OrderAmt']) ? $targetOrder += 0 : $targetOrder += $t['OrderAmt'];
                            empty($t['InvoiceAmt']) ? $targetInvoice += 0 : $targetInvoice += $t['InvoiceAmt'];
                            empty($t['BillAmt']) ? $targetBill += 0 : $targetBill += $t['BillAmt'];
                            empty($t['ReceiptAmt']) ? $targetReceipt += 0 : $targetReceipt += $t['ReceiptAmt'];
                        }
                    }
                }
            }
            $planOrder = 0;
            $planInvoice = 0;
            $planBill = 0;
            $planReceipt = 0;
            //获取部门的计划
            foreach ($salesPlanRes[0] as $plan){
                foreach($resDeptCd[0] as $itemDeptCd){
                    //如果匹配到目标中的部门，则取出经理ID对比是否加入计算
                    if($itemDeptCd['DeptCd'] == $plan['DeptCd']){
                        //如果当前部门的经理匹配，则计算
                        if ($v['value'] == $itemDeptCd['value']) {
                            empty($plan['OrderAmt']) ? $planOrder += 0 : $planOrder += $plan['OrderAmt'];
                            empty($plan['InvoiceAmt']) ? $planInvoice += 0 : $planInvoice += $plan['InvoiceAmt'];
                            empty($plan['BillAmt']) ? $planBill += 0 : $planBill += $plan['BillAmt'];
                            empty($plan['ReceiptAmt']) ? $planReceipt += 0 : $planReceipt += $plan['ReceiptAmt'];
                        }
                    }
                }
            }
            //组合数据,每次输出一个经理的目标、业绩
            $returnData[$k][0]['name'] = $v['text'];
            $returnData[$k][0]['orderAmt'] = array(
                'target' => $targetOrder,
                'plan'   => $planOrder,
                'salesRecord' => $recordOrder,
                'percent' => round($targetOrder == 0 ? 0 : $recordOrder / $targetOrder * 100, 2) . '%',
                'percent2' => round($planOrder == 0 ? 0 : $recordOrder / $planOrder * 100, 2) . '%',
                'percent3' => round($planOrder == 0 ? 0 : $targetOrder / $planOrder * 100, 2) . '%',
                'date' => $dateRound[0],
            );
            $returnData[$k][0]['InvoiceAmt'] = array(
                'target' => $targetInvoice,
                'plan'   => $planInvoice,
                'salesRecord' => $recordInvoice,
                'percent' => round($targetInvoice == 0 ? 0 : $recordInvoice / $targetInvoice * 100, 2) . '%',
                'percent2' => round($planInvoice == 0 ? 0 : $recordInvoice / $planInvoice * 100, 2) . '%',
                'percent3' => round($planInvoice == 0 ? 0 : $targetInvoice / $planInvoice * 100, 2) . '%',
                'date' => $dateRound[0],
            );
            $returnData[$k][0]['BillAmt'] = array(
                'target' => $targetBill,
                'plan'   => $planBill,
                'salesRecord' => $recordBill,
                'percent' => round($targetBill == 0 ? 0 : $recordBill / $targetBill * 100, 2) . '%',
                'percent2' => round($planBill == 0 ? 0 :$recordBill / $planBill * 100, 2) . '%',
                'percent3' => round($planBill == 0 ? 0 : $targetBill / $planBill * 100, 2) . '%',
                'date' => $dateRound[0],
            );
            $returnData[$k][0]['ReceiptAmt'] = array(
                'target' => $targetReceipt,
                'plan'   => $planReceipt,
                'salesRecord' => $recordReceipt,
                'percent' => round($targetReceipt == 0 ? 0 : $recordReceipt / $targetReceipt * 100, 2) . '%',
                'percent2' => round($planReceipt == 0 ? 0 : $recordReceipt / $planReceipt * 100, 2) . '%',
                'percent3' => round($planReceipt == 0 ? 0 : $targetReceipt / $planReceipt * 100, 2) . '%',
                'date' => $dateRound[0],
            );
        }
    }

    //查询所有组别数据
    private function screenDeptIdTarget($deptIdList, $date, $dateDiv, &$allRecord, $dateRound, $dateItem, &$returnData,$currItem)
    {
        
        $targetRes = array(array());
        $salesPlanRes = array(array());
        $join_param = array(
            array('pBaseDate', $date),
            array('pLangCd', $this->langCode),
            array('pDateDiv', $dateDiv),
            array('pCurrItem',$currItem),
        );
        $return_param = array(
            array('wStatus', 'ok'),
            array('wResults', '')
        );
        //查询业绩
        $resRecord = DB::call($this->DB,'SSADayTotal_M3', $join_param, $return_param);
        $resRecord = json_decode(json_encode($resRecord), true);

        //查询目标
//        for ($i = 0; $i < count($dateRound); $i++) {
//            $targetRes[$i] = $this->Worker10_model->select()->getTarget($date, $dateItem);
//        }
        $targetRes = $this->Worker10_model->select()->getTarget($date, $dateItem);
        if($dateItem != 'd') $salesPlanRes = $this->Worker10_model->select()->getSalesPlan($dateRound[0], $dateItem);

        //业绩筛选合并
        foreach ($deptIdList as $k => $v) {
            //初始化业绩map
            $allRecord[$v['text']] = $this->targetList;

            for ($s = 0; $s < count($resRecord); $s++) {
                if ($v['value'] == $resRecord[$s]['DeptCd']) {
                    //当前
                    $allRecord[$v['text']]['OrderAmt'] = bcadd($allRecord[$v['text']]['OrderAmt'], $resRecord[$s]['OrderAmt'], 2);
                    $allRecord[$v['text']]['InvoiceAmt'] = bcadd($allRecord[$v['text']]['InvoiceAmt'], $resRecord[$s]['InvoiceAmt'], 2);
                    $allRecord[$v['text']]['BillAmt'] = bcadd($allRecord[$v['text']]['BillAmt'], $resRecord[$s]['BillAmt'], 2);
                    $allRecord[$v['text']]['ReceiptAmt'] = bcadd($allRecord[$v['text']]['ReceiptAmt'], $resRecord[$s]['ReceiptAmt'], 2);
//                    //上一个
//                    $allRecord[$v['text']]['OrderAmt_Pre'] = bcadd($allRecord[$v['text']]['OrderAmt_Pre'], $resRecord[$s]['OrderAmt_Pre'], 2);
//                    $allRecord[$v['text']]['InvoiceAmt_Pre'] = bcadd($allRecord[$v['text']]['InvoiceAmt_Pre'], $resRecord[$s]['InvoiceAmt_Pre'], 2);
//                    $allRecord[$v['text']]['BillAmt_Pre'] = bcadd($allRecord[$v['text']]['BillAmt_Pre'], $resRecord[$s]['BillAmt_Pre'], 2);
//                    $allRecord[$v['text']]['ReceiptAmt_Pre'] = bcadd($allRecord[$v['text']]['ReceiptAmt_Pre'], $resRecord[$s]['ReceiptAmt_Pre'], 2);
                }
            }
            //今天业绩排除NULL
            empty($allRecord[$v['text']]['OrderAmt']) ? $recordOrder = 0 : $recordOrder = $allRecord[$v['text']]['OrderAmt'];
            empty($allRecord[$v['text']]['InvoiceAmt']) ? $recordInvoice = 0 : $recordInvoice = $allRecord[$v['text']]['InvoiceAmt'];
            empty($allRecord[$v['text']]['BillAmt']) ? $recordBill = 0 : $recordBill = $allRecord[$v['text']]['BillAmt'];
            empty($allRecord[$v['text']]['ReceiptAmt']) ? $recordReceipt = 0 : $recordReceipt = $allRecord[$v['text']]['ReceiptAmt'];

            $targetOrder = 0;
            $targetInvoice = 0;
            $targetBill = 0;
            $targetReceipt = 0;
            //获取部门的目标
            foreach ($targetRes[0] as $t){
                if ($v['value'] == $t['DeptCd']) {
                    empty($t['OrderAmt']) ? $targetOrder += 0 : $targetOrder += $t['OrderAmt'];
                    empty($t['InvoiceAmt']) ? $targetInvoice += 0 : $targetInvoice += $t['InvoiceAmt'];
                    empty($t['BillAmt']) ? $targetBill += 0 : $targetBill += $t['BillAmt'];
                    empty($t['ReceiptAmt']) ? $targetReceipt += 0 : $targetReceipt += $t['ReceiptAmt'];
                }
            }
            $planOrder = 0;
            $planInvoice = 0;
            $planBill = 0;
            $planReceipt = 0;
            //获取部门的计划
            foreach ($salesPlanRes[0] as $plan){
                if ($v['value'] == $plan['DeptCd']) {
                    empty($plan['OrderAmt']) ? $planOrder += 0 : $planOrder += $plan['OrderAmt'];
                    empty($plan['InvoiceAmt']) ? $planInvoice += 0 : $planInvoice += $plan['InvoiceAmt'];
                    empty($plan['BillAmt']) ? $planBill += 0 : $planBill += $plan['BillAmt'];
                    empty($plan['ReceiptAmt']) ? $planReceipt += 0 : $planReceipt += $plan['ReceiptAmt'];
                }
            }
            //组合数据,每次输出一个部门目标、业绩
            $returnData[$k][0]['name'] = $v['text'];
            $returnData[$k][0]['orderAmt'] = array(
                'target' => $targetOrder,
                'plan'   => $planOrder,
                'salesRecord' => $recordOrder,
                'percent' => round($targetOrder == 0 ? 0 : $recordOrder / $targetOrder * 100, 2) . '%',
                'percent2' => round($planOrder == 0 ? 0 : $recordOrder / $planOrder * 100, 2) . '%',
                'percent3' => round($planOrder == 0 ? 0 : $targetOrder / $planOrder * 100, 2) . '%',
                'date' => $dateRound[0],
            );
            $returnData[$k][0]['InvoiceAmt'] = array(
                'target' => $targetInvoice,
                'plan'   => $planInvoice,
                'salesRecord' => $recordInvoice,
                'percent' => round($targetInvoice == 0 ? 0 : $recordInvoice / $targetInvoice * 100, 2) . '%',
                'percent2' => round($planInvoice == 0 ? 0 : $recordInvoice / $planInvoice * 100, 2) . '%',
                'percent3' => round($planInvoice == 0 ? 0 : $targetInvoice / $planInvoice * 100, 2) . '%',
                'date' => $dateRound[0],
            );
            $returnData[$k][0]['BillAmt'] = array(
                'target' => $targetBill,
                'plan'   => $planBill,
                'salesRecord' => $recordBill,
                'percent' => round($targetBill == 0 ? 0 : $recordBill / $targetBill * 100, 2) . '%',
                'percent2' => round($planBill == 0 ? 0 :$recordBill / $planBill * 100, 2) . '%',
                'percent3' => round($planBill == 0 ? 0 : $targetBill / $planBill * 100, 2) . '%',
                'date' => $dateRound[0],
            );
            $returnData[$k][0]['ReceiptAmt'] = array(
                'target' => $targetReceipt,
                'plan'   => $planReceipt,
                'salesRecord' => $recordReceipt,
                'percent' => round($targetReceipt == 0 ? 0 : $recordReceipt / $targetReceipt * 100, 2) . '%',
                'percent2' => round($planReceipt == 0 ? 0 : $recordReceipt / $planReceipt * 100, 2) . '%',
                'percent3' => round($planReceipt == 0 ? 0 : $targetReceipt / $planReceipt * 100, 2) . '%',
                'date' => $dateRound[0],
            );
        }
    }

    //获取权限级别
    public function getPermission(){
        $this->recall_array['returnCode'] = str_replace(' ','',parent::getCookie('auth',false));
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
    }

    //查询销售部主要部长
    public function getLeader(){
        $res = $this->getLeaders('MA1004');
        $this->recall_array['data'] = $res;
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
    }

    //查询销售部经理
    public function getMempId(){
        $res = $this->Worker10_model->select()->getMempId($this->loginUser,parent::getCookie('auth',false));
        $this->recall_array['data'] = $res;
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
    }

    //查询所有部门
    public function getDeptId(){
        if(parent::getCookie('auth',false) == AUTH_E || parent::getCookie('auth',false) == 'NO'){
            $this->recall_array['returnCode'] = 'user';
            $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
        }
        $res = $this->Worker10_model->select()->getDeptId($this->loginUser,parent::getCookie('auth',false));
        $this->recall_array['data'] = $res;
        $this->jlamp_comm->jsonEncEnd($this->recall_array,true);
    }

    //系统小分类
    private function getLeaders($classNm){
        return $this->Worker10_model->where(array($classNm))->select()->getLeaders($this->langCode);
    }
}



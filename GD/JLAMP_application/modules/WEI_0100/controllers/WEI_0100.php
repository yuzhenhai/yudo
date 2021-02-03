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
class WEI_0100 extends Base
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->lists();
    }

    /**1
     * 메소드명: lists
     * 작성자: 김목영
     * 설 명: 영업집계표(일) 페이지
     *
     * 최초작성일: 2017.11.10
     * 최종수정일: 2017.11.10
     * ---
     * Date              Auth        Desc1
     */
    public function lists()
    {
        $this->loginLog('WEI_0100');
        $formKey = $this->jlamp_comm->xssInput('formKey', 'get');
        $menuSelection = $this->jlamp_comm->xssInput('menuSelection', 'get');
        $this->jlamp_comm->isHtmlDisplay(true);
        $this->jlamp_tp->assign(array(
            'formKey' => $formKey,
            'menuSelection' => $menuSelection
        ));
        $this->jlamp_tp->define(['tpl' => 'ManageInfoView/WEI_0100_Lists.html']);
        $this->jlamp_tp->template_dir = VIEWS;
//		$this->jlamp_tp->setURLType(array(
//			'tpl' => 'WEI_0100_Lists.html'
//		));
    } // end of function lists

    public function getK3Date()
    {
        $startDate = $this->inputM('startDate');
        $endDate = $this->inputM('endDate');
        $result = Helper::getMethod('');
    }

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
    public function lists_prc()
    {
        $result = array(
            'returnCode' => 0,
            'returnMsg' => '',
            'data' => ''
        );
        $gubun = $this->jlamp_comm->xssInput('gubun', 'get'); // 구분
        $baseDate = $this->jlamp_comm->xssInput('baseDate', 'get'); // 기준일
        $serverId = $this->input('serverId');
        $SH = $this->input('SH');
        $LL = $this->input('LL');
        $LLSZ = $this->input('LLSZ');
        $CL = $this->input('CL');
        // 유효성 검사
        // 기준일
        if (empty($baseDate)) {
            $result['returnCode'] = 'I001';
            $result['returnMsg'] = '기준일은 필수입력입니다.';
            $this->jlamp_comm->jsonEncEnd($result);
        }
        if ($serverId == 'YBD') {
            $model = new YBDAmount_model();
            $k3Res = Api::get_func('http://119.145.100.148:8701/api/getk3amount?gubun='.$gubun.'&date='.$baseDate);
            $k3Res = json_decode($k3Res,true);
            switch ($gubun){
                case 'Y':
                    $u8Res = $model->getYearAmt($baseDate);
                    break;
                case 'MS':
                    $u8Res = $model->getMonthsAmt($baseDate);
                    break;
                case 'M':
                    $u8Res = $model->getMonthAmt($baseDate);
                    break;
                case 'D':
                    $u8Res = $model->getDayAmt($baseDate);
                    break;
            }
            $k3Res['data']['Bill']['FForamount'] = $u8Res['bill']['FForamount'];
            $k3Res['data']['Bill']['FForamountPre'] = $u8Res['billPre']['FForamountPre'];
            $k3Res['data']['Receive']['FForamount'] = $u8Res['receive']['FForamount'];
            $k3Res['data']['Receive']['FForamountPre'] = $u8Res['receivePre']['FForamountPre'];
            $this->jlamp_comm->jsonEncEnd($k3Res, true);
        } elseif( $SH == 'SH' || $LL == 'LL' || $LLSZ == 'LLSZ' || $CL == 'CL' ) {
            if($gubun == 'Y'){
                $GU = 'YEAR';
            }else if($gubun == 'MS'){
                $GU = 'MONTHTOTAL';
            }else if($gubun == 'M'){
                 $GU = 'MONTH';
            } else{
                 $GU = 'DAY';
            }
            
            // $baseDate
            if($SH == 'SH'){
                $company = 62;
            }else if($LL == 'LL'){
                $company =13;
            }else if($LLSZ == 'LLSZ'){
                 $company = 63;
            } else if($CL == 'CL'){
                 $company = 58;
            }
 
            $LangID = parent::getLangID();
            $key = md5(sha1($GU.$baseDate.$company.$LangID.'YUDO-YUZH'));

            $ces = 'http://61.244.93.68:8592/API/index.php/index/Api?Gubun='. $GU .'&BaseDate='. $baseDate .'&Company='. $company .'&LangID='. $LangID .'&key='.$key;
            $yuRes = Api::get_func('http://61.244.93.68:8592/API/index.php/index/Api?Gubun='. $GU .'&BaseDate='. $baseDate .'&Company='. $company .'&LangID='. $LangID .'&key='.$key);
            $lists = json_decode(substr($yuRes,3),true);

            
            $results['data']['res']= array();//语言 CHN ENG KUY

            if(!empty($lists)){
                foreach ($lists as $key => $value) {
                    $Opercent = (((float)$value['OrderForAmt']-(float)$value['OrderForAmt_Pre'])/((float)$value['OrderForAmt_Pre'] == 0 ?1000000:(float)$value['OrderForAmt_Pre']))*100;
                    if($Opercent<0){
                        $OpercentColor = '#07be00';
                        $OpercentMinuteColor = '#159a00';
                    }else{
                        $OpercentColor = '#ff6259';
                        $OpercentMinuteColor = '#e02a27';
                    }

                    $results['data']['orderList'] = array(
                        'DeptNm'    => $value['cmm_nm'],
                        'ForAmt'    => (float)(float)$value['OrderForAmt'],
                        'ForAmt_Pre'=> (float)$value['OrderForAmt_Pre'],
                        'percent'   =>  $Opercent,
                        'percentColor' => $OpercentColor,
                        'percentMinuteColor'    => $OpercentMinuteColor
                    );
                    $Ipercent = (((float)$value['InvoiceForAmt']-(float)$value['InvoiceForAmt_Pre'])/((float)$value['InvoiceForAmt_Pre'] == 0 ?1000000:(float)$value['InvoiceForAmt_Pre']))*100;
                    if($Ipercent<0){
                        $IpercentColor = '#07be00';
                        $IpercentMinuteColor = '#159a00';
                    }else{
                        $IpercentColor = '#ff6259';
                        $IpercentMinuteColor = '#e02a27';
                    }
                    $results['data']['invoiceList'] = array(
                        'DeptNm'    => $value['cmm_nm'],
                        'ForAmt'    => (float)$value['InvoiceForAmt'],
                        'ForAmt_Pre'=> (float)$value['InvoiceForAmt_Pre'],
                        'percent'   =>  $Ipercent,
                        'percentColor' => $IpercentColor,
                        'percentMinuteColor'    => $IpercentMinuteColor
                    );
                    $Bpercent = (((float)$value['BillForAmt']-(float)$value['BillForAmt_Pre'])/((float)$value['BillForAmt_Pre'] == 0 ?1000000:(float)$value['BillForAmt_Pre']))*100;
                    if($Bpercent<0){
                        $BpercentColor = '#07be00';
                        $BpercentMinuteColor = '#159a00';
                    }else{
                        $BpercentColor = '#ff6259';
                        $BpercentMinuteColor = '#e02a27';
                    }
                    $results['data']['billList'] = array(
                        'DeptNm'    => $value['cmm_nm'],
                        'ForAmt'    => (float)$value['BillForAmt'],
                        'ForAmt_Pre'=> (float)$value['BillForAmt_Pre'],
                        'percent'   =>  $Bpercent ,
                        'percentColor' => $BpercentColor,
                        'percentMinuteColor'    => $BpercentMinuteColor
                    );
                    $Rpercent = (((float)$value['ReceiptForAmt']-(float)$value['ReceiptForAmt_Pre'])/((float)$value['ReceiptForAmt_Pre'] == 0 ?1000000:(float)$value['ReceiptForAmt_Pre']))*100;
                    if($Rpercent<0){
                        $RpercentColor = '#07be00';
                        $RpercentMinuteColor = '#159a00';
                    }else{
                        $RpercentColor = '#ff6259';
                        $RpercentMinuteColor = '#e02a27';
                    }
                    $results['data']['receiptList'] = array(
                        'DeptNm'    => $value['cmm_nm'],
                        'ForAmt'    => (float)$value['ReceiptForAmt'],
                        'ForAmt_Pre'=> (float)$value['ReceiptForAmt_Pre'],
                        'percent'   =>   $Rpercent,
                        'percentColor' => $RpercentColor,
                        'percentMinuteColor'    => $RpercentMinuteColor
                    );
                    $Ppercent = (((float)$value['ProductrForAmt']-(float)$value['ProductrForAmt_Pre'])/((float)$value['ProductrForAmt_Pre'] == 0 ?1000000:(float)$value['ProductrForAmt_Pre']))*100;
                    if($Ppercent<0){
                        $PpercentColor = '#07be00';
                        $PpercentMinuteColor = '#159a00';
                    }else{
                        $PpercentColor = '#ff6259';
                        $PpercentMinuteColor = '#e02a27';
                    }
                    $results['data']['invoiceProList'] = array(
                        'DeptNm'    => $value['cmm_nm'],
                        'ForAmt'    => (float)$value['ProductrForAmt'],
                        'ForAmt_Pre'=> (float)$value['ProductrForAmt_Pre'],
                        'percent'   =>  $Ppercent,
                        'percentColor' => $PpercentColor,
                        'percentMinuteColor'    => $PpercentMinuteColor

                    );

                }
            }else{
                $results['data']['orderList'] = array(
                        'DeptNm'    => '',
                        'ForAmt'    => 0,
                        'ForAmt_Pre'=> 0,
                        'percent'   =>  0,
                        'percentColor' => '#ff6259',
                        'percentMinuteColor'    => '#e02a27'

                ); $results['data']['invoiceList']=$results['data']['billList']=$results['data']['receiptList'] = $results['data']['invoiceProList'] =$results['data']['orderList'];

            }

            $results['returnCode'] = '';
            $results['returnMsg'] = '';
            
            $this->jlamp_comm->jsonEncEnd($results, true);
        } else {
            $spName = 'SSADayTotal_SZ2_M2';
            $params = array(
                'pWorkingTag' => $gubun,
                'pBaseDt' => mb_ereg_replace('-', '', $baseDate),
                'pLangCd' => $this->langCode
            );
            try {
                $res = $this->jlamp_common_mdl->spRows($spName, $params);
                if (count($res)) {
                    // 에러코드가 'E', 'P' 가 아닌 경우
                    if (substr($res[count($res) - 1][0]->p_error_code, 0, 1) != 'E' && substr($res[count($res) - 1][0]->p_error_code, 0, 1) != 'P') {
                        if ($res[0]) $result['data']['res'] = $res[0];
                    }

                    $result['data']['valid'] = $res[count($res) - 1][0];
                } else {
                    $result['returnCode'] = 'I001';
                    $result['returnMsg'] = '검색 작업 시 오류가 발생하였습니다.';
                }
            } catch (Exception $e) {
                $result['returnCode'] = 'E001';
                $result['returnMsg'] = $e->getMessage();
            }
            $result['data']['langCode'] = parent::getLangID();
            $this->jlamp_comm->jsonEncEnd($result, true);
        }
    }

    public function getChukou(){
        $gubun = $this->jlamp_comm->xssInput('gubun', 'get'); // 구분
        $baseDate = $this->jlamp_comm->xssInput('baseDate', 'get'); // 기준일

        $join_param = array(
            array('pBaseDt',mb_ereg_replace('-', '', $baseDate)),
            array('pLangCd',$this->langCode),
        );
        $return_param = array(
            array('p_error_code',''),
            array('p_row_count',''),
            array('p_error_note',''),
            array('p_return_str',''),
            array('p_error_str',''),
            array('ErrorState',''),
            array('ErrorProcedure',''),
        );

        try {
           $lists = DB::call('JLAMPSZBiz','ceshi',$join_param,$return_param);
            $guojia = array();
            foreach ($lists as $key => $value) {
                $guoji[] = $value->Nation;
            }
            $chukou = array_unique($guoji);
            $res_y = array();
            $s = 0;

            $date = strtotime($baseDate);

            $time = date('Y',$date);
            foreach ($chukou as $key => $value) {
                $res_y[$s]['Nation'] = $value;
                $res_y[$s]['orderALL'] = array();
                $res_y[$s]['InvoiceALL'] = array();
                $res_y[$s]['BillALL'] = array();
                $res_y[$s]['ReceiptALL'] = array();
                $res_y[$s]['MiALL'] = array();
                $res_y[$s]['ProductALL'] = array();

                $res_y[$s]['orderALL'][$key]['name'] = $value;
                $res_y[$s]['InvoiceALL'][$key]['name'] = $value;
                $res_y[$s]['BillALL'][$key]['name'] = $value;
                $res_y[$s]['ReceiptALL'][$key]['name'] = $value;
                $res_y[$s]['ProductALL'][$key]['name'] = $value;

                $res_y[$s]['orderALL'][$key]['color'] = '#000';
                $res_y[$s]['InvoiceALL'][$key]['color'] = '#000';
                $res_y[$s]['BillALL'][$key]['color'] = '#000';
                $res_y[$s]['ReceiptALL'][$key]['color'] = '#000';
                $res_y[$s]['ProductALL'][$key]['color'] = '#000';

                $res_y[$s]['orderALL'][$key]['background'] = '#FFFFFF';
                $res_y[$s]['InvoiceALL'][$key]['background'] = '#FFFFFF';
                $res_y[$s]['BillALL'][$key]['background'] = '#FFFFFF';
                $res_y[$s]['ReceiptALL'][$key]['background'] = '#FFFFFF';
                $res_y[$s]['ProductALL'][$key]['background'] = '#FFFFFF';
                
                $res_y[$s]['count'] = 0;
                foreach ($lists as $k => $v) {
                    $ortime = $time-1;

                    if ($gubun == 'Y'){
                        if($v->CustNm == $ortime && $v->Nation == $value){
                            $res_y[$s]['orderALL'][$key]['ForAmt_Pre'] = number_format($v->TotYYOrderAmt/10000,2);
                            $res_y[$s]['InvoiceALL'][$key]['ForAmt_Pre'] = number_format($v->TotYYInvoiceAmt/10000,2);
                            $res_y[$s]['BillALL'][$key]['ForAmt_Pre'] = number_format($v->TotYYBillAmt/10000,2);
                            $res_y[$s]['ReceiptALL'][$key]['ForAmt_Pre'] = number_format($v->TotYYReceiptAmt/10000,2);
                            $res_y[$s]['ProductALL'][$key]['ForAmt_Pre'] = number_format($v->TotYYProductAmt/10000,2);

                        }else if($v->CustNm == $time && $v->Nation == $value){
                            $res_y[$s]['orderALL'][$key]['ForAmt'] = number_format($v->TotYYOrderAmt/10000,2);
                            $res_y[$s]['InvoiceALL'][$key]['ForAmt'] = number_format($v->TotYYInvoiceAmt/10000,2);
                            $res_y[$s]['BillALL'][$key]['ForAmt'] = number_format($v->TotYYBillAmt/10000,2);
                            $res_y[$s]['ReceiptALL'][$key]['ForAmt'] = number_format($v->TotYYReceiptAmt/10000,2);
                            $res_y[$s]['ProductALL'][$key]['ForAmt'] = number_format($v->TotYYProductAmt/10000,2);

                        }else if($v->CustNm == $time.'(R)'  && $v->Nation == $value){
                            $res_y[$s]['orderALL'][$key]['ForAmt'] = number_format($v->TotYYOrderAmt/10000,2);
                            $res_y[$s]['InvoiceALL'][$key]['ForAmt'] = number_format($v->TotYYInvoiceAmt/10000,2);
                            $res_y[$s]['BillALL'][$key]['ForAmt'] = number_format($v->TotYYBillAmt/10000,2);
                            $res_y[$s]['ReceiptALL'][$key]['ForAmt'] = number_format($v->TotYYReceiptAmt/10000,2);
                            $res_y[$s]['ProductALL'][$key]['ForAmt'] = number_format($v->TotYYProductAmt/10000,2);

                        }
                    }else if($gubun == 'MS'){
                    
                        if($v->CustNm == $ortime && $v->Nation == $value){
                            $res_y[$s]['orderALL'][$key]['ForAmt_Pre'] = number_format($v->TotTTMOrderAmt/10000,2);
                            $res_y[$s]['InvoiceALL'][$key]['ForAmt_Pre'] = number_format($v->TotTTMInvoiceAmt/10000,2);
                            $res_y[$s]['BillALL'][$key]['ForAmt_Pre'] = number_format($v->TotTTMBillAmt/10000,2);
                            $res_y[$s]['ReceiptALL'][$key]['ForAmt_Pre'] = number_format($v->TotTTMReceiptAmt/10000,2);
                            $res_y[$s]['ProductALL'][$key]['ForAmt_Pre'] = number_format($v->TotProductAmt/10000,2);
                        }else if($v->CustNm == $time && $v->Nation == $value){
                            $res_y[$s]['orderALL'][$key]['ForAmt'] = number_format($v->TotTTMOrderAmt/10000,2);
                            $res_y[$s]['InvoiceALL'][$key]['ForAmt'] = number_format($v->TotTTMInvoiceAmt/10000,2);
                            $res_y[$s]['BillALL'][$key]['ForAmt'] = number_format($v->TotTTMBillAmt/10000,2);
                            $res_y[$s]['ReceiptALL'][$key]['ForAmt'] = number_format($v->TotTTMReceiptAmt/10000,2);
                            $res_y[$s]['ProductALL'][$key]['ForAmt'] = number_format($v->TotTTMProductAmt/10000,2);
                        }else if($v->CustNm == $time.'(R)'  && $v->Nation == $value){
                            $res_y[$s]['orderALL'][$key]['ForAmt'] = number_format($v->TotOrderAmt/10000,2);
                            $res_y[$s]['InvoiceALL'][$key]['ForAmt'] = number_format($v->TotTTMInvoiceAmt/10000,2);
                            $res_y[$s]['BillALL'][$key]['ForAmt'] = number_format($v->TotTTMBillAmt/10000,2);
                            $res_y[$s]['ReceiptALL'][$key]['ForAmt'] = number_format($v->TotTTMReceiptAmt/10000,2);
                            $res_y[$s]['ProductALL'][$key]['ForAmt'] = number_format($v->TotTTMProductAmt/10000,2);
                        }
                    }else if($gubun == 'M'){
                        if($v->CustNm == $ortime && $v->Nation == $value){
                            $res_y[$s]['orderALL'][$key]['ForAmt_Pre'] = number_format($v->TotOrderAmt/10000,2);
                            $res_y[$s]['InvoiceALL'][$key]['ForAmt_Pre'] = number_format($v->TotInvoiceAmt/10000,2);
                            $res_y[$s]['BillALL'][$key]['ForAmt_Pre'] = number_format($v->TotBillAmt/10000,2);
                            $res_y[$s]['ReceiptALL'][$key]['ForAmt_Pre'] = number_format($v->TotReceiptAmt/10000,2);
                            $res_y[$s]['ProductALL'][$key]['ForAmt_Pre'] = number_format($v->TotProductAmt/10000,2);
                        }else if($v->CustNm == $time && $v->Nation == $value){
                            $res_y[$s]['orderALL'][$key]['ForAmt'] = number_format($v->TotOrderAmt/10000,2);
                            $res_y[$s]['InvoiceALL'][$key]['ForAmt'] = number_format($v->TotInvoiceAmt/10000,2);
                            $res_y[$s]['BillALL'][$key]['ForAmt'] = number_format($v->TotBillAmt/10000,2);
                            $res_y[$s]['ReceiptALL'][$key]['ForAmt'] = number_format($v->TotReceiptAmt/10000,2);
                            $res_y[$s]['ProductALL'][$key]['ForAmt'] = number_format($v->TotProductAmt/10000,2);
                        }else if($v->CustNm == $time.'(R)'  && $v->Nation == $value){
                            $res_y[$s]['orderALL'][$key]['ForAmt'] = number_format($v->TotOrderAmt/10000,2);
                            $res_y[$s]['InvoiceALL'][$key]['ForAmt'] = number_format($v->TotInvoiceAmt/10000,2);
                            $res_y[$s]['BillALL'][$key]['ForAmt'] = number_format($v->TotBillAmt/10000,2);
                            $res_y[$s]['ReceiptALL'][$key]['ForAmt'] = number_format($v->TotReceiptAmt/10000,2);
                            $res_y[$s]['ProductALL'][$key]['ForAmt'] = number_format($v->TotProductAmt/10000,2);
                        }
                    }else if($gubun == 'D'){
                        if($v->CustNm == $ortime && $v->Nation == $value){
                            $res_y[$s]['orderALL'][$key]['ForAmt_Pre'] = number_format($v->ToDayOrderAmt/10000,2);
                            $res_y[$s]['InvoiceALL'][$key]['ForAmt_Pre'] = number_format($v->ToDayInvoiceAmt/10000,2);
                            $res_y[$s]['BillALL'][$key]['ForAmt_Pre'] = number_format($v->ToDayBillAmt/10000,2);
                            $res_y[$s]['ReceiptALL'][$key]['ForAmt_Pre'] = number_format($v->ToDayReceiptAmt/10000,2);
                            $res_y[$s]['ProductALL'][$key]['ForAmt_Pre'] = number_format($v->ToDayProductAmt/10000,2);

                        }else if($v->CustNm == $time && $v->Nation == $value){
                            $res_y[$s]['orderALL'][$key]['ForAmt'] = number_format($v->ToDayOrderAmt/10000,2);
                            $res_y[$s]['InvoiceALL'][$key]['ForAmt'] = number_format($v->ToDayInvoiceAmt/10000,2);
                            $res_y[$s]['BillALL'][$key]['ForAmt'] = number_format($v->ToDayBillAmt/10000,2);
                            $res_y[$s]['ReceiptALL'][$key]['ForAmt'] = number_format($v->ToDayReceiptAmt/10000,2);
                            $res_y[$s]['ProductALL'][$key]['ForAmt'] = number_format($v->ToDayProductAmt/10000,2);

                        }else if($v->CustNm == $time.'(R)'  && $v->Nation == $value){
                            $res_y[$s]['orderALL'][$key]['ForAmt'] = number_format($v->ToDayOrderAmt/10000,2);
                            $res_y[$s]['InvoiceALL'][$key]['ForAmt'] = number_format($v->ToDayInvoiceAmt/10000,2);
                            $res_y[$s]['BillALL'][$key]['ForAmt'] = number_format($v->ToDayBillAmt/10000,2);
                            $res_y[$s]['ReceiptALL'][$key]['ForAmt'] = number_format($v->ToDayReceiptAmt/10000,2);
                            $res_y[$s]['ProductALL'][$key]['ForAmt'] = number_format($v->ToDayProductAmt/10000,2);
                        }
                    }
                    if($value == $v->Nation){
                        $res_y[$s]['count']++;
                    }
                }
                $s++;
            }
            $speakOrder = array();
            $speakInvoice = array();
            $speakBill = array();
            $speakReceipt = array();
            $speakProduct= array();
            foreach ($res_y as $key => $value) {
                foreach ($value['orderALL'] as $k => $v) {
                    $speakOrder[] = $v;
                }
                foreach ($value['InvoiceALL'] as $k => $v) {
                    $speakInvoice[] = $v;
                }
                foreach ($value['BillALL'] as $k => $v) {
                    $speakBill[] = $v;
                }
                foreach ($value['ReceiptALL'] as $k => $v) {
                    $speakReceipt[] = $v;
                }
                foreach ($value['ProductALL'] as $k => $v) {
                    $speakProduct[] = $v;
                }
            }
       
            

            foreach ($speakOrder as $key => $value) {
                $speakOrder[$key]['ForAmt'] = $value['ForAmt'] = str_replace(',', '', $value['ForAmt']);
                $speakOrder[$key]['ForAmt_Pre'] = $value['ForAmt_Pre'] = str_replace(',', '', $value['ForAmt_Pre']);
                $percent = $value['ForAmt'] - $value['ForAmt_Pre'];
                $speakOrder[$key]['percent'] =  number_format($percent/((float)$value['ForAmt_Pre'] == 0 ?100:(float)$value['ForAmt_Pre'])*100,2);

                if($percent>0){
                    $speakOrder[$key]['percentColor'] = '#e02a27';
                }else{
                    $speakOrder[$key]['percentColor'] = '#07be00';
                }
            }

            foreach ($speakInvoice as $key => $value) {
                $value['ForAmt'] = str_replace(',', '', $value['ForAmt']);
                $value['ForAmt_Pre'] = str_replace(',', '', $value['ForAmt_Pre']);
                $percent = $value['ForAmt'] - $value['ForAmt_Pre'];
                    $speakInvoice[$key]['percent'] =  number_format($percent/((float)$value['ForAmt_Pre'] == 0 ?100:(float)$value['ForAmt_Pre'])*100,2);
                if($percent>0){
                    $speakInvoice[$key]['percentColor'] = '#e02a27';
                }else{
                    $speakInvoice[$key]['percentColor'] = '#07be00';
                }
            }

             foreach ($speakBill as $key => $value) {
                $value['ForAmt'] = str_replace(',', '', $value['ForAmt']);
                $value['ForAmt_Pre'] = str_replace(',', '', $value['ForAmt_Pre']);
                $percent = $value['ForAmt'] - $value['ForAmt_Pre'];
                $speakBill[$key]['percent'] =  number_format($percent/((float)$value['ForAmt_Pre'] == 0 ?100:(float)$value['ForAmt_Pre'])*100,2);
                if($percent>0){
                    $speakBill[$key]['percentColor'] = '#e02a27';
                }else{
                    $speakBill[$key]['percentColor'] = '#07be00';
                }
            }
             foreach ($speakReceipt as $key => $value) {
                $value['ForAmt'] = str_replace(',', '', $value['ForAmt']);
                $value['ForAmt_Pre'] = str_replace(',', '', $value['ForAmt_Pre']);
                $percent = $value['ForAmt'] - $value['ForAmt_Pre'];
                $speakReceipt[$key]['percent'] =  number_format($percent/((float)$value['ForAmt_Pre'] == 0 ?100:(float)$value['ForAmt_Pre'])*100,2);
                if($percent>0){
                    $speakReceipt[$key]['percentColor'] = '#e02a27';
                }else{
                    $speakReceipt[$key]['percentColor'] = '#07be00';
                }
            }

            foreach ($speakProduct as $key => $value) {
                $value['ForAmt'] = str_replace(',', '', $value['ForAmt']);
                $value['ForAmt_Pre'] = str_replace(',', '', $value['ForAmt_Pre']);
                $percent = $value['ForAmt'] - $value['ForAmt_Pre'];
                $speakProduct[$key]['percent'] =  number_format($percent/((float)$value['ForAmt_Pre'] == 0 ?100:(float)$value['ForAmt_Pre'])*100,2);
                if($percent>0){
                    $speakProduct[$key]['percentColor'] = '#e02a27';
                }else{
                    $speakProduct[$key]['percentColor'] = '#07be00';
                }
            }

            $result['speakOrder'] = $speakOrder;
            $result['speakInvoice'] = $speakInvoice;
            $result['speakBill'] = $speakBill;
            $result['speakReceipt'] = $speakReceipt;
            $result['speakProduct'] = $speakProduct;
        } catch (Exception $e) {
            $result['returnCode'] = 'E001';
            $result['returnMsg'] = $e->getMessage();
        }
    
            $this->jlamp_comm->jsonEncEnd($result, true);

    }







}

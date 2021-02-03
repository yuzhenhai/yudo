<?php
class Invoice10_model extends Multi_dbQuery
{
    public $auth;

    public function __construct()
    {
        parent::__construct();
    }

    public function getInvoiceInfo($sourceNo,$sourceType,$langCode){
        $result = DB::queryRow("select 
                        A.InvoiceNo,
                        A.InvoiceDate,
                        A.Payment,
                        A.Status AS StatusId,
                        LB.TransNm AS Status,
                        A.InvoiceType,
                        LC.TransNm AS InvoiceTypeNm,
                        A.CustCd,
                        A.CfmYn,
                        A.CfmDate,
                        A.ColYn,
                        A.ColDate
                        from TSAInvoice00 A
                        left join TSMSyco10 LA on LA.RelCd1 = A.Status and LA.MinorCd like 'SA4003%%'
                        left join TSMDict10 LB on LB.DictCd = LA.MinorCd and LB.LangCd = '$langCode'
                        left join TSMDict10 LC on LC.DictCd = A.InvoiceType and LC.LangCd = '$langCode'
                        where SourceType like '%s%%' AND SourceNo like '%s%%'",[$sourceType,$sourceNo]);
        return $result;
    }
}
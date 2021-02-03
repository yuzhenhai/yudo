<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Worker10_model extends Multi_dbQuery {
    public function __construct()
    {
        parent::__construct();
    }
    public function getSalesData($amtClass,$date){
        $nowYear = $date;
        $lastYear = $nowYear-1;
        switch ($amtClass){
            case 'order':
                $field = 'SUM(OrderForAmt)/10000';
                break;
            case 'invoice':
                $field = 'SUM(InvoiceForAmt)/10000';
                break;
            case 'bill':
                $field = 'SUM(BillForAmt)/10000';
                break;
            case 'receipt':
                $field = 'SUM(ReceiptForAmt)/10000';
                break;
        }
        $sql = "select
                $field AS data,'$lastYear' dateY
                from TSATotYM00 where LEFT(SumYM,4) = '$lastYear' and SumType = '1'
                UNION 
                select 
                $field AS data,'$nowYear' dateY
                from TSATotYM00 where LEFT(SumYM,4) ='$nowYear' and SumType = '1'";

        $this->created($sql);
        return $this->jlamp_query();
    }

    public function getData(){
        $sql = "select b.ItemNm from TPMBOMMaster a  
        left join TMAItem00 b on a.ItemCd = b.ItemCd group by b.ItemNm";
        $this->created($sql);
        return $this->jlamp_query();
    }
}

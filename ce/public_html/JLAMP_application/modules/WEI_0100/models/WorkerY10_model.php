<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class WorkerY10_model extends Multi_dbQuery {
    public function __construct()
    {
        parent::__construct();
    }
    public function getSalesData($date){
        $nowYear = $date;
        $lastYear = $nowYear-1;
       
        $sql = "select
                $field AS data,'$lastYear' dateY
                from TSAOrder00 where LEFT(SumYM,4) = '$lastYear' and SumType = '1'
                UNION 
                select 
                $field AS data,'$nowYear' dateY
                from TSATotYM00 where LEFT(SumYM,4) ='$nowYear' and SumType = '1'";

        $this->created($sql);
        return $this->jlamp_query();
    }

    public function getData($date){
        $start = date('Y-m-01 00:00:00',time());
        $end = date('Y-m-d H:i:s',time());

        // $sql = "select *  from TSAOrder00 A Left [OUTER] Join TMADept00 B ON A.DeptCd = B.RDeptcd 
        //     Left [OUTER] Join TMACurr00 C ON A.CurrCd = C.CurrCd 
        //     Left [OUTER] Join TSMSyco10 SC ON A.DeptDiv1 = SC.MinorCd
        //      where ExpClss = '4' AND CfmYn = '1' AND ProductYn = 'Y' AND ProductDate = $date";
         $sql = "select * from TSAOrder00
             where DATE_FORMAT( ProductDate, ‘%Y%m’ ) = DATE_FORMAT( $start , ‘%Y%m’ )";
        $this->created($sql);
        return $this->jlamp_query();
    }
}

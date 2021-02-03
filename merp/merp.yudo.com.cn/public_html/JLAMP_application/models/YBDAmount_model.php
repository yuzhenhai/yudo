<?php
class YBDAmount_model extends Multi_dbQuery
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 获取年度基准毅比道U8系统发票/收款金额信息
     * @param $date
     * @return array
     */
    public function getYearAmt($date){
        $year = substr($date,0,4);
        $lastYear = $year-1;

        $billRes = DB::queryRow("select ISNULL(SUM(B.iMoney*A.iExchRate),0) as FForamount from SaleBillVouch as A
                  left join SaleBillVouchs as B on A.SBVID = B.SBVID
                  where A.dDate between dateadd(year, datediff(year, 0, '%s'), 0) and '%s'",[$date,$date]);
        $billPreRes = DB::queryRow("select ISNULL(SUM(B.iMoney*A.iExchRate),0) as FForamountPre from SaleBillVouch as A
                  left join SaleBillVouchs as B on A.SBVID = B.SBVID
                  where A.dDate between dateadd(year,-1,dateadd(year, datediff(year, 0, '%s'), 0)) and '%s'",[$date,$lastYear.'-12-31']);

        $receiveRes = DB::queryRow("select ISNULL(sum(iAmount*iExchRate),0) as FForamount from Ap_CloseBill 
                  where cFlag = 'AR' AND dVouchDate between dateadd(year, datediff(year, 0, '%s'), 0) and '%s'",[$date,$date]);
        $receivePreRes = DB::queryRow("select ISNULL(sum(iAmount*iExchRate),0) as FForamountPre from Ap_CloseBill 
                  where cFlag = 'AR' AND dVouchDate between dateadd(year,-1,dateadd(year, datediff(year, 0, '%s'), 0)) and '%s'",[$date,$lastYear.'-12-31']);

        return [
            'bill' => $billRes,
            'billPre' => $billPreRes,
            'receive' => $receiveRes,
            'receivePre' => $receivePreRes
        ];
    }

    public function getMonthsAmt($date){
        $billRes = DB::queryRow("select  ISNULL(SUM(B.iMoney*A.iExchRate),0) as FForamount from SaleBillVouch as A
                  left join SaleBillVouchs as B on A.SBVID = B.SBVID
                  where A.dDate between dateadd(year, datediff(year, 0, '%s'), 0) and '%s'",[$date,$date]);
        $billPreRes = DB::queryRow("select  ISNULL(SUM(B.iMoney*A.iExchRate),0) as FForamountPre from SaleBillVouch as A
                  left join SaleBillVouchs as B on A.SBVID = B.SBVID
                  where A.dDate between dateadd(year,-1,dateadd(year, datediff(year, 0, '%s'), 0)) 
                  and dateadd(year,-1,dateadd(month, datediff(month, 0, dateadd(month, 1, '%s')), -1))",[$date,$date]);

        $receiveRes = DB::queryRow("select ISNULL(sum(iAmount*iExchRate),0) as FForamount from Ap_CloseBill 
                  where cFlag = 'AR' AND dVouchDate between dateadd(year, datediff(year, 0, '%s'), 0) and '%s'",[$date,$date]);
        $receivePreRes = DB::queryRow("select ISNULL(sum(iAmount*iExchRate),0) as FForamountPre from Ap_CloseBill 
                  where cFlag = 'AR' AND dVouchDate between dateadd(year,-1,dateadd(year, datediff(year, 0, '%s'), 0)) 
                  and dateadd(year,-1,dateadd(month, datediff(month, 0, dateadd(month, 1, '%s')), -1))",[$date,$date]);

        return [
            'bill' => $billRes,
            'billPre' => $billPreRes,
            'receive' => $receiveRes,
            'receivePre' => $receivePreRes
        ];
    }

    public function getMonthAmt($date){
        $year = substr($date,0,4);
        $month = substr($date,5,2);
        $lastYear = $year-1;
        $billRes = DB::queryRow("select  ISNULL(SUM(B.iMoney*A.iExchRate),0) as FForamount from SaleBillVouch as A
                  left join SaleBillVouchs as B on A.SBVID = B.SBVID WHERE CONVERT(varchar(7),A.dDate,120) = '%s'",[$year."-".$month]);
        $billPreRes = DB::queryRow("select  ISNULL(SUM(B.iMoney*A.iExchRate),0) as FForamountPre from SaleBillVouch as A
                  left join SaleBillVouchs as B on A.SBVID = B.SBVID
                  where CONVERT(varchar(7),A.dDate,120) = '%s'",[$lastYear."-".$month]);

        $receiveRes = DB::queryRow("select ISNULL(sum(iAmount*iExchRate),0) as FForamount from Ap_CloseBill 
                  where cFlag = 'AR' AND CONVERT(varchar(7),dVouchDate,120) = '%s'",[$year."-".$month]);
        $receivePreRes = DB::queryRow("select ISNULL(sum(iAmount*iExchRate),0) as FForamountPre from Ap_CloseBill 
                  where cFlag = 'AR' AND CONVERT(varchar(7),dVouchDate,120) = '%s'",[$lastYear."-".$month]);

        return [
            'bill' => $billRes,
            'billPre' => $billPreRes,
            'receive' => $receiveRes,
            'receivePre' => $receivePreRes
        ];
    }

    public function getDayAmt($date){
        $billRes = DB::queryRow("select  ISNULL(SUM(B.iMoney*A.iExchRate),0) as FForamount from SaleBillVouch as A
                  left join SaleBillVouchs as B on A.SBVID = B.SBVID
                  where A.dDate = '%s'",[$date]);
        $billPreRes = DB::queryRow("select  ISNULL(SUM(B.iMoney*A.iExchRate),0) as FForamountPre from SaleBillVouch as A
                  left join SaleBillVouchs as B on A.SBVID = B.SBVID
                  where A.dDate = dateadd(year,-1,'%s')",[$date]);

        $receiveRes = DB::queryRow("select ISNULL(sum(iAmount*iExchRate),0) as FForamount from Ap_CloseBill 
                  where cFlag = 'AR' AND dVouchDate = '%s'",[$date]);
        $receivePreRes = DB::queryRow("select ISNULL(sum(iAmount*iExchRate),0) as FForamountPre from Ap_CloseBill 
                  where cFlag = 'AR' AND dVouchDate = dateadd(year,-1,'%s')",[$date]);

        return [
            'bill' => $billRes,
            'billPre' => $billPreRes,
            'receive' => $receiveRes,
            'receivePre' => $receivePreRes
        ];
    }
}
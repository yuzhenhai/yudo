<?php
class Cust10_model extends Multi_dbQuery {
    public function __construct()
    {
        parent::__construct();
    }
    public function getCustList($custNo,$custNm,$count,$langCode)
    {
        $result = DB::queryRows("select top 50 * from (
              SELECT Row_Number()over(order by a.CustCd asc)AS id,
              a.CustNo,
              a.CustNm,
              a.CustCd,
              a.KoOrFo,
              isnull(b.TransNm,c.MinorNm) as Status,
              a.Status as StatusId
              FROM TMACust00 a
              LEFT JOIN TSMDict10 b ON a.Status = b.DictCd AND b.LangCd = '%s'
              LEFT JOIN TSMSyco10 c on a.Status = c.MinorCd
              left join TMACust10 AA on AA.CustCd = a.CustCd
              left join TMAEmpy00 MA on AA.EmpId = MA.EmpID
              left join TMADept00 GA on MA.DeptCd = GA.DeptCd
              where AA.ChargeType='N' 
              AND getdate() between  AA.STDate and AA.EDDate
              AND a.CustNo like '%s%%'
              AND a.CustNm like N'%s%%' )T where id > '%s' order by id asc",[$langCode,$custNo,$custNm,$count]);
        return $result;
    }


}
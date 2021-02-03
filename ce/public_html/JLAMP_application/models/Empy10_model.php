<?php
class Empy10_model extends Multi_dbQuery
{
    public $auth;

    public function __construct()
    {
        parent::__construct();
    }

    public function getEmpyList($empId,$empNm,$deptNm,$count=0){
        $result = DB::queryRows("
            select top 50 * from
            (select 
            Row_Number()over(order by A.EmpID desc)AS id,
            A.EmpID,A.EmpNm,B.DeptCd,B.DeptNm 
            from TMAEmpy00 A
            left join TMADept00 B on A.DeptCd = B.DeptCd
            where A.EmpID LIKE '%s%%'
            AND A.EmpNm LIKE N'%s%%'
            AND B.DeptNm LIKE '%s%%'
            AND A.RetireYn = 'N')T where id > %s order by id asc
        ",[$empId,$empNm,$deptNm,$count]);
        return $result;
    }
}
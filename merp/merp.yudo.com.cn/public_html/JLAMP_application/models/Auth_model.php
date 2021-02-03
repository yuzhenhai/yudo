<?php
class Auth_model extends Multi_dbQuery
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAuth($auth,$loginId){
        $userInfo = DB::queryRow("select UB.DeptCd,UB.MDeptCd,UC.emp_code,UD.JobNo from TMAEmpy00 UA 
                left join TMADept00 UB on UB.DeptCd = UA.DeptCd              
                left join sysUserMaster UC on UA.EmpId = UC.emp_code and isnull(UC.emp_code,'') !=''
                left join TMAJobc10 UD on UD.EmpId = UC.emp_code 
                INNER join TMAJobc00 UE on UE.JobNo = UD.JobNo and UE.SaleYn = 'Y' 
                WHERE UC.user_id = '%s' and UD.LastYN = 'Y'
                and getdate() between UD.STDate and UD.EDDate
                ",[$loginId])   ;
        $result = [
            'auth' => $auth,
            'deptCd' => $userInfo['DeptCd'],
            'empId'  => $userInfo['emp_code'],
            'jobNo'  => $userInfo['JobNo'],
        ];
        return $result;
    }
}
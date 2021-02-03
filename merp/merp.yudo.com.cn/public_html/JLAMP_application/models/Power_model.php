<?php
class Power_model {
    private $auth;
    //.获取权限
    public function getAuth($userId,$auth){
        $result = DB::queryRow("select UB.DeptCd,UB.MDeptCd,UA.EmpID,UD.JobNo from TMAEmpy00 UA 
                    left join TMADept00 UB on UB.DeptCd = UA.DeptCd              
                    left join TMAJobc10 UD on UD.EmpId = UA.EmpID 
                    left join TMAJobc00 UE on UE.JobNo = UD.JobNo and UE.SaleYn = 'Y' 
                    WHERE UA.EmpID = '%s' and UD.LastYN = 'Y'
                    and getdate() between UD.STDate and UD.EDDate ",[$userId]);
        $DeptCd = $result['DeptCd'];
        $MDeptCd = $result['MDeptCd'];
        $EmpId = $result['EmpID'];
        $JobNo = $result['JobNo'];
        switch ($auth){
            case AUTH_A:
                $this->auth = '';
                break;
            case AUTH_E:   //个人
                $this->auth = " AND EMPY.EmpID = '$EmpId'";
                break;
            case AUTH_J:   //职位
                $this->auth = " AND EMPY.JobNo = '$JobNo'";
                break;
            case AUTH_D:   //部门
                $this->auth = " AND DEPT.DeptCd = '$DeptCd'";
                break;
            case AUTH_M:   //管理
                $this->auth = " AND DEPT.DeptCd in (select DeptCd from dbo.fnMDeptCd('y','$EmpId') )";
                break;
            default:       //默认为个人
                $this->auth = " AND EMPY.EmpID = '$EmpId'";
                break;
        }
        return $this->auth;

    }


}
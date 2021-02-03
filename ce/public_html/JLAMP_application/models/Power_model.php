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
            case 'ALL':
            case 'A':
            case '0':
                $this->auth = '';
                break;
            case 'J':  //职务
            case '3':
                $this->auth = " AND EMPY.JobCd = '$JobNo'";
                break;
            case 'E':   //个人
            case '2':
                $this->auth = " AND EMPY.EmpId = '$EmpId'";
                break;
            case 'D':   //部门
            case '1':
                $this->auth = " AND DEPT.DeptCd = '$DeptCd'";
                break;
            case 'M':   //管理
            case '4':
                $this->auth = " AND DEPT.MDeptCd = '$MDeptCd'";
                break;
            default:  //默认为个人
                $this->auth = " AND DEPT.DeptCd = '$DeptCd'";
                break;
        }
        return $this->auth;

    }


}
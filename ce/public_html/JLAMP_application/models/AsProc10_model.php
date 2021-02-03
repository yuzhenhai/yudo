<?php
class AsProc10_model extends Multi_dbQuery
{
    public $auth;

    public function __construct()
    {
        parent::__construct();
    }

    public function getAsHandle($asHandleNo,$asHandleStartDate,$asHandleEndDate,$custNm,$count,$langCode,$auth){
        $empId = $auth['empId'];
        $deptCd = $auth['deptCd'];
        $jobNo = $auth['jobNo'];
        switch ($auth['auth']) {
            case AUTH_A:
                $this->auth = '';
                break;
            case AUTH_E:   //个人
                $this->auth = " AND EMPY.EmpID = '$empId'";
                break;
            case AUTH_J:   //职位
                $this->auth = " AND A.JobNo = '$jobNo'";
                break;
            case AUTH_D:   //部门
                $this->auth = " AND DEPT.DeptCd = '$deptCd'";
                break;
            case AUTH_M:   //管理
                $this->auth = " AND DEPT.DeptCd in (select DeptCd from dbo.fnMDeptCd('y','$empId') )";
                break;
            default:       //默认为个人
                $this->auth = " AND EMPY.EmpID = '$empId'";
                break;
        }
        if($count > 0){
            $result = DB::queryRows("select top 50 * from
                                (select Row_Number()over(order by A.ASNo desc)AS id,    
                                A.ASNo,
                                A.ASDate,
                                A.ASRecvNo,
                                A.CustCd,
                                A.CfmYn,
                                B.CustNm,
                                EMPY.EmpId,
                                EMPY.EmpNm,
                                DEPT.DeptCd,
                                DEPT.DeptNm,
                                C.OrderNo,
                                C.RefNo,
                                C.ChargeYn,
                                A.ProcResult,
                                LA.TransNm as ProcResultNm
                                from TASProc00 A 
                                left join TMACust00 B on A.CustCd = B.CustCd
                                left join TASRecv00 C on A.ASRecvNo = C.ASRecvNo
                                left join TMAEmpy00 EMPY on A.EmpId = EMPY.EmpID
                                left join TMADept00 DEPT on A.DeptCd = DEPT.DeptCd 
                                left join TSMDict10 LA on A.ProcResult = LA.DictCd And LangCd = '%s'
                                
                                where A.ASDate between '%s' and '%s'
                                AND B.CustNm like '%%%s%%' 
                                AND ASNo like '%s%%'
                                $this->auth
                                )T where id > %s order by id asc
                                ",[$langCode,$asHandleStartDate,$asHandleEndDate,$custNm,$asHandleNo,$count]);
        }else{
            $result = DB::queryRows("select top 50
                                A.ASNo,
                                A.ASDate,
                                A.ASRecvNo,
                                A.CustCd,
                                A.CfmYn,
                                B.CustNm,
                                EMPY.EmpId,
                                EMPY.EmpNm,
                                DEPT.DeptCd,
                                DEPT.DeptNm,
                                C.OrderNo,
                                C.RefNo,
                                C.ChargeYn,
                                A.ProcResult,
                                LA.TransNm as ProcResultNm
                                from TASProc00 A 
                                left join TMACust00 B on A.CustCd = B.CustCd
                                left join TASRecv00 C on A.ASRecvNo = C.ASRecvNo
                                left join TMAEmpy00 EMPY on A.EmpId = EMPY.EmpID
                                left join TMADept00 DEPT on A.DeptCd = DEPT.DeptCd 
                                left join TSMDict10 LA on A.ProcResult = LA.DictCd And LangCd = '%s'
                                
                                where A.ASDate between '%s' and '%s'
                                AND B.CustNm like '%%%s%%' 
                                AND ASNo like '%s%%' ORDER BY A.ASNo desc
                                ",[$langCode,$asHandleStartDate,$asHandleEndDate,$custNm,$asHandleNo]);
        }
        return $result;
    }

    public function getAsHandleInfo($asHandleNo,$langCode){
        $result = DB::queryRow("
                                select top 1
                                A.ASNo,
                                A.ASDate,
                                A.ASRecvNo,
                                A.CustCd,
                                A.CfmYn,
                                A.ASKind,
                                A.ASProcKind,
                                A.ASNote,
                                A.ProcResult,
                                A.ProcResultReason, --AS处理结果事由
                                A.ASAmt,
                                A.ASRepairAmt,
                                A.ASArea,
                                A.ASAreaGubun,
                                A.ChargeYn,
                                A.CfmYn,
                                A.ItemReturnYn,
                                A.ItemReturnGubun,
                                B.CustNm,
                                A.CustCd,
                                A.JobNo,
                                A.Remark,
                                A.ASNote,   --AS处理详细
                                A.CustOpinion, --客户意见
                                A.TransLine, --里程
                                A.ProcPerson, --经办人
                                A.ArrivalTime,--到达时间
                                A.StartTime, --触发时间
                                EMPY.EmpId,
                                EMPY.EmpNm,
                                DEPT.DeptCd,
                                DEPT.DeptNm,
                                C.OrderNo,
                                C.RefNo,
                                C.ASType,
                                C.ExpClss,
                                C.SpecNo,
                                C.DrawNo,
                                C.DrawAmd,
                                LA.TransNm as ASTypeNm
                                from TASProc00 A 
                                left join TMACust00 B on A.CustCd = B.CustCd
                                left join TASRecv00 C on A.ASRecvNo = C.ASRecvNo
                                left join TMAEmpy00 EMPY on A.EmpId = EMPY.EmpID
                                left join TMADept00 DEPT on A.DeptCd = DEPT.DeptCd
                                left join TSMDict10 LA on C.ASType = LA.DictCd And LA.LangCd = '%s'
                                WHERE ASNo = '%s'",[$langCode,$asHandleNo]);
        return $result;
    }

    public function getAsHandleItem($asHandleNo,$serl=''){
        $result = DB::queryRows("select A.ASSerl,
                                A.SpareYn,
                                A.StopYn,
                                B.Spec,
                                A.UnitCd,
                                C.UnitNm,
                                A.Remark,
                                A.Amt,
                                A.Qty,
                                A.Sort,
                                A.ASRepairAmt,
                                A.ReUseYn,
                                A.ChargeYn,
                                A.ASRecvSerl,
                                A.ItemCd,
                                B.ItemNo,
                                B.ItemNm from TASProc10 as A 
                                left join TMAItem00 as B on A.ItemCd = B.ItemCd
                                left join TMAUnit00 as C on A.UnitCd = C.UnitCd
                                where A.ASNo = '%s' and A.ASSerl LIKE '%s%%'",[$asHandleNo,$serl]);
        return $result;
    }

    public function getAsHandleByAsRecvNo($asRecvNo){
        $result = DB::queryRow("select top 1 ASNo from TASProc00 where ASRecvNo = '%s'",[$asRecvNo]);
        return $result;
    }

    public function getLastAsHandle(){
        $date = date('Ym',time());
        $result = DB::queryRow("select top 1 ASNo from TASProc00 where ASNo like '%s%%' order by ASNo desc",[$date]);
        return $result;
    }
}

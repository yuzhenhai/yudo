<?php
class ProductDate10_model extends Multi_dbQuery
{
    public $auth;

    public function __construct()
    {
        parent::__construct();
    }
    //.获取生产交期列表信息
    public function getProductDate($auth,$date,$accordingClass,$accordingNo,$custNm,$RefNo){
        $empId = $auth['empId'];
        $deptCd = $auth['deptCd'];
        $jobNo = $auth['jobNo'];
        switch ($auth['auth']) {
            case AUTH_A:
                $this->auth = '';
                break;
            case AUTH_E:   //个人
                $this->auth = " AND Empy.EmpId = '$empId'";
                break;
            case AUTH_J:   //职位
                $this->auth = " AND B.JobNo = '$jobNo'";
                break;
            case AUTH_D:   //部门
                $this->auth = " AND Dept.DeptCd = '$deptCd'";
                break;
            case AUTH_M:   //管理
                $this->auth = " AND Dept.DeptCd in (select DeptCd from dbo.fnMDeptCd('y','$empId') )";
                break;
            default:       //默认为个人
                $this->auth = " AND Empy.EmpId = '$empId'";
                break;
        }
        $result = DB::queryRows("
                SELECT '0' As U_Select
                ,A.OrderDiv
                ,A.WPlanNo
                ,A.WPlanDate
                ,A.WDelvDate
                ,Empy.EmpID
                ,Empy.EmpNm
                ,Dept.DeptCd
                ,Dept.DeptNm
                ,A.Status
                ,A.SourceType
                ,A.SourceNo
                ,B.ExpClss
                ,B.OrderNo
                ,B.OrderType
                ,B.OrderDate
                ,B.DelvDate
                ,B.CustCd
                ,C.CustNo
                ,C.CustNm ,C1.CustNo as MakerNo
                ,C1.CustNm as MakerNm
                ,ISNULL(B.DrawNo,'') AS DrawNo
                ,ISNULL(B.DrawAmd,'') AS DrawAmd
                ,D1.AptDate
                ,D.OutDate 
                ,B.SpecNo
                ,B.SpecType
                ,B.CustPONo
                ,B.RefNo
                ,B1.GateQty

                ,A.ProductMUptEmpID
                ,A.ProductMUptDate
                ,A.ProductUptEmpID
                ,A.ProductUptDate


                ,GetDate() As ToDay
                ,A.Sort
                ,CASE WHEN A.Sort Is Null Or LTrim(RTrim(A.Sort)) = '' THEN 'ZZZ' ELSE LTrim(RTrim(A.Sort)) END As U_Sort
                ,IsNull(B.CustPONo,'') As CustPONo
                ,IsNull(A.WDelvChRemark, '') As WDelvChRemark
                ,IsNull(C.Custtype2,'') As CustType2
                ,A.ProductClass
                ,B.Status As OrderStatus
                ,A.SDelvChDate As SDelvChDate
                ,A.SDelvChRemark As SDelvChRemark
                --,IsNull(M.MiOutQty,0) As MatMiOutQty
                
                ,A.WDelvChUptDate As WDelvChUptDate
                ,A.SDelvChUptDate As SDelvChUptDate
                ,IsNull(H.ModifyCnt,0) As ModifyCnt
                ,IsNull(B.SupplyScope,'') As SupplyScope
                ,A.CfmDate As WPlanCfmDate
                ,B.CfmDate As OrderCfmDate
                ,R.AptDate As WkAptDate
                ,IsNull(B.ShortDelvYn,'N') As ShortDelvYn
                ,IsNull(S1.ProductDay,0) As ProductDay
                ,CASE WHEN S1.ProductDay is Not Null THEN DATEADD(Day, S1.ProductDay, B.OrderDate) ELSE Null END As STProductDate
                ,B.OrderForAmt
                FROM TPMWkPlan00 As A With (Nolock) Left Outer Join TSAOrder00 As B With (Nolock)
                On A.OrderNo = B.OrderNo And A.SourceType = '1' Left Outer Join TSASpec30 As B1 With (Nolock)
                On B.SpecNo = B1.SpecNo And B.SpecType = B1.SpecType	And B1.MainSysYn = 'Y'
                Left Join TMAEmpy00 Empy on B.EmpID = Empy.EmpID
                Left Join TMADept00 Dept on Empy.DeptCd = Dept.DeptCd
                Left Outer Join TMACust00 As C With (Nolock)
                On B.CustCd = C.CustCd
                Left Outer Join TMACust00 As C1 With (Nolock)
                On B.MakerCd = C1.CustCd
                Left Outer Join TDEDwReg00 As D With (Nolock)
                On B.DrawNo = D.DrawNo And B.DrawAmd = D.DrawAmd Left Outer Join TDEDwReq00 As D1 With (Nolock)
                On D.ReqNo = D1.ReqNo
                Left Outer Join TPMWKReq00 As R With (Nolock)
                On A.ReqNo = R.ReqNo
                
                LEFT OUTER JOIN (select WPlanNo, COUNT(*) As ModifyCnt from TPMWKDelv_His GROUP BY WPlanNo
                ) As H ON A.WPlanNo = H.WPlanNo
                Left Outer Join TSMSyco10 S With(Nolock)
                On B.SystemType = S.MinorCd
                Left Outer Join TSADelv00_SZ S1 With(Nolock)
                On B.ExpClss = '1' And B.OrderType = S1.OrderType And B.SupplyScope = S1.SupplyScope And B.HRSystem = S1.HRSystem
                And LTRIM(RTRIM(S.RelCd10)) = S1.SystemType
                And (B.GateQty Between S1.GateQty_Min And S1.GateQty_Max)	WHERE A.Status In ('0','1','2')
                AND A.WDelvDate <= '%s'
                AND A.CfmYn = '1' AND (A.SourceType = '1' 
                And A.SourceType Like '%s%%'
                )	AND A.StopYn = 'N'
                AND IsNull(A.SourceNo,'') Like '%s%%'
                AND IsNull(C.CustNm,'') Like '%s%%'
                AND B.RefNo LIKE '%s%%'
                $this->auth
               
                UNION
                SELECT '0' As U_Select
                ,A.OrderDiv
                ,A.WPlanNo
                ,A.WPlanDate
                ,A.WDelvDate
                ,Empy.EmpID
                ,Empy.EmpNm
                ,Dept.DeptCd
                ,Dept.DeptNm
                ,A.Status
                ,A.SourceType
                ,A.SourceNo
                ,B.ExpClss
                ,IsNull(B.OrderNo,'')
                ,''
                ,B.ASRecvDate
                ,B.ASDelvDate
                ,B.CustCd
                ,C.CustNo
                ,C.CustNm ,'' as MakerNo
                ,'' as MakerNm
                ,ISNULL(B.DrawNo,'') AS DrawNo
                ,ISNULL(B.DrawAmd,'') AS DrawAmd
                ,D1.AptDate
                ,D.OutDate
                ,B.SpecNo
                ,B.SpecType
                ,'' As CustPONo
                ,B.RefNo
                ,B1.GateQty
               
               
                ,A.ProductMUptEmpID
                ,A.ProductMUptDate
              
                ,A.ProductUptEmpID
                ,A.ProductUptDate
               
                ,GetDate() As ToDay
                ,A.Sort
                ,CASE WHEN A.Sort Is Null Or LTrim(RTrim(A.Sort)) = '' THEN 'ZZZ' ELSE LTrim(RTrim(A.Sort)) END As U_Sort
                ,'' As CustPONo
                ,IsNull(A.WDelvChRemark, '') As WDelvChRemark
                ,IsNull(C.Custtype2,'') As CustType2
                ,A.ProductClass
                ,'' As OrderStatus
                ,A.SDelvChDate As SDelvChDate
                ,A.SDelvChRemark As SDelvChRemark
                --,IsNull(M.MiOutQty,0) As MatMiOutQty
               
                ,A.WDelvChUptDate As WDelvChUptDate
                ,A.SDelvChUptDate As SDelvChUptDate
                ,IsNull(H.ModifyCnt,0) As ModifyCnt
                ,IsNull(B.SupplyScope,'') As SupplyScope
                ,A.CfmDate As WPlanCfmDate
                ,B.CfmDate As OrderCfmDate
                ,R.AptDate As WkAptDate
                ,'N' As ShortDelvYn
                , 0 ,Null
                ,0
                FROM TPMWkPlan00 As A With (Nolock) Left Outer Join TASRecv00 As B With (Nolock)
                On A.SourceNo = B.ASRecvNo And A.SourceType = '2' Left Outer Join TSASpec30 As B1 With (Nolock)
                On B.SpecNo = B1.SpecNo And B.SpecType = B1.SpecType	And B1.MainSysYn = 'Y'
                Left Join TMAEmpy00 Empy on B.EmpID = Empy.EmpID
                Left Join TMADept00 Dept on Empy.DeptCd = Dept.DeptCd
                Left Outer Join TMACust00 As C With (Nolock)
                On B.CustCd = C.CustCd
                Left Outer Join TDEDwReg00 As D With (Nolock)
                On B.DrawNo = D.DrawNo And B.DrawAmd = D.DrawAmd Left Outer Join TDEDwReq00 As D1 With (Nolock)
                On D.ReqNo = D1.ReqNo
                Left Outer Join TPMWKReq00 As R With (Nolock)
                On A.ReqNo = R.ReqNo
                
                
                LEFT OUTER JOIN (select WPlanNo, COUNT(*) As ModifyCnt from TPMWKDelv_His GROUP BY WPlanNo
                ) As H ON A.WPlanNo = H.WPlanNo
                WHERE A.Status In ('0','1','2')
                AND A.WDelvDate <= '%s'
                AND A.CfmYn = '1' AND (A.SourceType = '2' 
                And A.SourceType Like '%s%%'
                )	AND A.StopYn = 'N'
                AND IsNull(A.SourceNo,'') LIKE '%s%%'
                AND IsNull(C.CustNm,'') LIKE '%s%%'
                AND B.RefNo LIKE '%s%%'
                $this->auth
                ORDER BY A.WDelvDate DESC ",[$date,$accordingClass,$accordingNo,$custNm,$RefNo,$date,$accordingClass,$accordingNo,$custNm,$RefNo]);
        return $result;

    }

    //.获取AS生产信息
    public function getAsProductInfo($asRecvNo){
        $result = DB::queryRow("
            SELECT A.OrderDiv
                ,A.WPlanNo
                ,A.WPlanDate
                ,A.WDelvDate
                ,Empy.EmpID
                ,Empy.EmpNm
                ,Dept.DeptCd
                ,Dept.DeptNm
                ,A.Status
                ,A.SourceType
                ,A.SourceNo
                ,B.ExpClss
                ,IsNull(B.OrderNo,'')
                ,''
                ,B.ASRecvDate
                ,B.ASDelvDate
                ,B.CustCd
                ,C.CustNo
                ,C.CustNm ,'' as MakerNo
                ,'' as MakerNm
                ,ISNULL(ltrim(rtrim(B.DrawNo)),'') AS DrawNo
                ,ISNULL(ltrim(rtrim(B.DrawAmd)),'') AS DrawAmd
                ,ISNULL(D1.AptDate,'') AS AptDate
                ,ISNULL(D.OutDate,'') AS OutDate
                ,B.SpecNo
                ,B.SpecType
                ,'' As CustPONo
                ,B.RefNo
                ,B1.GateQty
                ,A.ProductMUptEmpID
                ,A.ProductMUptDate
                ,A.ProductUptEmpID
                ,A.ProductUptDate
                ,A.Sort
                ,CASE WHEN A.Sort Is Null Or LTrim(RTrim(A.Sort)) = '' THEN 'ZZZ' ELSE LTrim(RTrim(A.Sort)) END As U_Sort
                ,'' As CustPONo
                ,IsNull(A.WDelvChRemark, '') As WDelvChRemark
                ,IsNull(C.Custtype2,'') As CustType2
                ,A.ProductClass
                ,'' As OrderStatus
                ,A.SDelvChDate As SDelvChDate
                ,A.SDelvChRemark As SDelvChRemark         
                ,A.WDelvChUptDate As WDelvChUptDate
                ,A.SDelvChUptDate As SDelvChUptDate
                ,IsNull(H.ModifyCnt,0) As ModifyCnt
                ,IsNull(B.SupplyScope,'') As SupplyScope
                ,A.CfmDate As WPlanCfmDate
                ,B.CfmDate As OrderCfmDate
                ,R.AptDate As WkAptDate
                ,'N' As ShortDelvYn
                FROM TPMWkPlan00 As A With (Nolock) 
                Left Outer Join TASRecv00 As B With (Nolock) On A.SourceNo = B.ASRecvNo And A.SourceType = '2' 
                Left Outer Join TSASpec30 As B1 With (Nolock) On B.SpecNo = B1.SpecNo And B.SpecType = B1.SpecType	And B1.MainSysYn = 'Y'
                Left Join TMAEmpy00 Empy on B.EmpID = Empy.EmpID
                Left Join TMADept00 Dept on Empy.DeptCd = Dept.DeptCd
                Left Outer Join TMACust00 As C With (Nolock)
                On B.CustCd = C.CustCd
                Left Outer Join TDEDwReg00 As D With (Nolock)
                On B.DrawNo = D.DrawNo And B.DrawAmd = D.DrawAmd Left Outer Join TDEDwReq00 As D1 With (Nolock)
                On D.ReqNo = D1.ReqNo
                Left Outer Join TPMWKReq00 As R With (Nolock)
                On A.ReqNo = R.ReqNo
                LEFT OUTER JOIN (select WPlanNo, COUNT(*) As ModifyCnt from TPMWKDelv_His GROUP BY WPlanNo
                ) As H ON A.WPlanNo = H.WPlanNo
                WHERE 
                -- A.Status In ('0','1','2')
                -- AND A.CfmYn = '1' 
                A.SourceType = '2'
                AND A.StopYn = 'N'
                AND A.SourceNo = '%s'",[$asRecvNo]);
        return $result;
    }

    //.获取车间信息
    public function getFarmInfo($wPlanNo){
        $result = DB::queryRows("SELECT A.WPlanNo, A.DeptCd, C.DeptNm As DeptNm,
                A.WCCd, 
                B.WCNm As WCNm,
                A.Sort, 
                A.StartYn, 
                A.EndYn, 
                A.QCYn, 
                A.WCDelvDate, --完成指示日期
                A.WCStartDate, --操作开始时间
                A.WCEndDate, --操作完成时间
                A.QCDate,  --检查时间
                A.LastYn,
                A.StopYn, 
                A.StopDate, --检查日期
                AA.CfmYn As CfmYn 
                FROM TPMWKPlan20 As A Inner Join TPMWKPlan00 As AA With (Nolock) On A.WPlanNo = AA.WPlanNo
                Inner Join TPMWC00 As B With (Nolock) On A.DeptCd = B.DeptCd And A.WCCd = B.WCCd And B.PlanYn = 'N' And B.Status = '0'
                Inner Join TMADept00 As C With (Nolock)
                On A.DeptCd = C.DeptCd 
                WHERE (
                A.WCDelvDate != NULL
                OR A.WCStartDate != NULL
                OR A.WCEndDate != NULL
                OR A.QCDate != NULL )
                AND A.WPlanNo = '%s' ORDER BY A.Sort ASC",[$wPlanNo]);
        return $result;
    }
}

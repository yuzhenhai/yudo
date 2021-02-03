<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class As10_model extends JLAMP_Model {

    private $multi = array(
        'where' => array()
    );
    private $where = '';
    private $auth;
    private $m_print = 0;
    private $m_count = '';
    private $sqlsen = '';
    private $isnull = true;
    private $append = '';
    private $haswhere = false;
    private $dataType = 'Array';
    private $table = '';
    private $filed = '';
    private $order = array();
    private static $error = 0;

    public function aslist($startDate,$endDate){
        $this->haswhere = true;
        $nowtime = date('Y-m-d',intval(time()));
        $sql = "select top 50
                MA.ASRecvNo,
                MA.OrderNo,
                MA.ASRecvDate,
                MA.ASDelvDate,
                MA.Status,
                MA.OrderCnt,
                MA.ChargeYn,
                
                CASE WHEN MC.Reqno IS NULL THEN 0
                WHEN MC.AptYn = '0' THEN 1 
                WHEN MC.AptYn = '1' And MA.ProductYn = 'N' THEN 2  
                WHEN MA.ProductYn = 'Y' THEN 3
                END AS ProductStatus,
                
                CASE WHEN MD.ReqNo IS NULL THEN 0
                ELSE 1
                END AS DrawStatus,
                
                UA.EmpNm,
                UB.DeptNm,
                MA.ProductYn, -- 有没有完成生产 y/n
                MA.CfmYn, -- 确定
                MA.AptYn, -- 有无接受
                MA.RefNo,
                MB.CustNm
                from TASRecv00 MA
                left join TMACust00 MB on MA.CustCd = MB.CustCd
                left join TPMWKReq00 MC on MA.ASRecvNo = MC.SourceNo AND MC.SourceType = '2' 
                left join TDEDwReq00 MD on MA.ASRecvNo = MD.SourceNo AND MD.SourceType = 'A' 
                left join TMAEmpy00 UA on MA.EmpId = UA.EmpID
                left join TMADept00 UB on MA.DeptCd = UB.DeptCd 
                where convert(char(10) ,MA.ASRecvDate, 120) between '$startDate' and '$endDate' $this->auth ";
        $type = array(
            'MA.OrderNo|LIKE',
            'MA.ASRecvNo|LIKE',
            'MB.CustNm|LIKE|utf-8',
            'UA.EmpNm|LIKE|utf-8'
        );
        $this->append("order by MA.ASRecvNo desc");
        $this->created($sql,$type);
        return $this->jlamp_query();
    }

    public function aslist_more($get_ascount,$startDate,$endDate){
        $this->haswhere= true;
        $nowtime = date('Y-m-d',intval(time()));
        $sql = "select top 50 * from
                (
                select Row_Number()over(order by MA.ASRecvNo desc)AS id,
                MA.ASRecvNo,
                MA.OrderNo,
                MA.ASRecvDate,
                MA.ASDelvDate,
                MA.Status,
                MA.OrderCnt,
                MA.ChargeYn,
                CASE WHEN MC.Reqno Is Null THEN 0
                WHEN MC.AptYn = '0' THEN 1 
                WHEN MC.AptYn = '1' And MA.ProductYn = 'N' THEN 2  
                WHEN MA.ProductYn = 'Y' THEN 3
                END AS ProductStatus,  
                
                CASE WHEN MD.ReqNo IS NULL THEN 0
                ELSE 1
                END AS DrawStatus,
                
                UA.EmpNm,
                UB.DeptNm,
                MA.ProductYn, -- 有没有完成生产 y/n
                MA.CfmYn, -- 确定
                MA.AptYn, -- 有无接受
                MB.CustNm,
                MA.RefNo
                from TASRecv00 MA
                left join TMACust00 MB on MA.CustCd = MB.CustCd
                left join TPMWKReq00 MC On MA.ASRecvNo = MC.SourceNo And MC.SourceType = '2' 
                left join TDEDwReq00 MD on MA.ASRecvNo = MD.SourceNo AND MD.SourceType = 'A' 
                left join TMAEmpy00 UA on MA.EmpId = UA.EmpID
                left join TMADept00 UB on MA.DeptCd = UB.DeptCd 
                where convert(char(10) ,MA.ASRecvDate, 120) between '$startDate' and '$endDate' $this->auth ";
        $type = array(
            'MA.OrderNo|LIKE',
            'MA.ASRecvNo|LIKE',
            'MB.CustNm|LIKE|utf-8',
            'UA.EmpNm|LIKE|utf-8'
        );
        $this->append(")T where id > $get_ascount order by id asc");
        $this->created($sql,$type);
        return $this->jlamp_query();
    }

    public function as_minute($langCode='SM00010003'){
        $sql = "select MA.ASRecvNo,
                MA.ASRecvDate,
                MA.ASDelvDate,
                MA.OrderGubun,
                MA.EmpId,
                MA.DeptCd,
                MA.Status,        -- 状态
                MA.CustPrsn,
                MA.CustTell,
                MA.CustEmail,
                MA.OrderCnt,
                UA.EmpNm,
                UGA.DeptNm,
                MA.SpecNo,
                MA.SpecType,
                MA.ProductYn,     -- 有没有完成生产 y/n
                MA.CfmYn,         -- 确定
                MA.AptYn,         -- 有无接受
                MA.ChargeYn,		-- 收费与否
                MA.CustCd,
                MB.CustNm,
                MA.CustPrsn,      -- 客户负责人
                MA.CustTell,
                MA.CustEmail,
                MA.OrderNo,
                MA.ExpClss,
                MA.RefNo,		  -- 模号
                MA.GateQty,
                MA.OldDrawNo,
                MA.OldDrawAmd,
                MA.DrawNo,
                MA.DrawAmd,
                MA.AStype,        ISNULL(AStypeA.TransNm,AStypeB.MinorNm)             AS AStypeNm, -- AS区分
                
                -- SYSTEM
                MA.SupplyScope,   ISNULL(SupplyScopeA.TransNm,SupplyScopeB.MinorNm)   AS SupplyScopeNm,
                MA.HRSystem,      ISNULL(HRSystemA.TransNm,HRSystemB.MinorNm)         AS HRSystemNm,
                MA.ManifoldType,  ISNULL(ManifoldTypeA.TransNm,ManifoldTypeB.MinorNm) AS ManifoldTypeNm,
                MA.SystemSize,    ISNULL(SystemSizeA.TransNm,SystemSizeB.MinorNm)     AS SystemSizeNm,
                MA.SystemType,    ISNULL(SystemTypeA.TransNm,SystemTypeB.MinorNm)     AS SystemTypeNm,
                MA.GateType,      ISNULL(GateTypeA.TransNm,GateTypeB.MinorNm)         AS GateTypeNm,
                
                -- ASCLASS
                MA.GoodNm,        -- 客户产品名称
                MA.MarketCd,      ISNULL(MarketCdA.TransNm,MarketCdB.MinorNm)         AS MarketCdNm,-- Markets
                MA.Resin,         -- 塑胶
                MA.OCCpoint,      ISNULL(OCCpointA.TransNm,OCCpointB.MinorNm)         AS OCCpointNm,  -- 发生起点
                MA.ASBadType,     ISNULL(ASBadTypeA.TransNm,ASBadTypeB.MinorNm)       AS ASBadTypeNm, -- 不良类型
                MA.ASCauseDonor,  ISNULL(ASCauseDonorA.TransNm,ASCauseDonorB.MinorNm) AS ASCauseDonorNm,   -- 原因区分
                MA.DutyGubun,     ISNULL(DutyGubunA.TransNm,DutyGubunB.MinorNm) 		 AS DutyGubunNm,-- AS责任区分
                MA.ASClass1,      ISNULL(ASClass1A.TransNm,ASClass1B.MinorNm) 		 	 AS ASClass1Nm, -- AS现象
                MA.ASClass2,      ISNULL(ASClass2A.TransNm,ASClass2B.MinorNm) 		 	 AS ASClass2Nm, -- AS原因种类
                MA.ASAreaGubun,   ISNULL(ASAreaGubunA.TransNm,ASAreaGubunB.MinorNm)   AS ASAreaGubunNm, -- 服务地点区分
                MA.ASArea,        -- 服务地点 
                MA.ItemReturnYn,  -- 部品返回与否
                
                -- REMARK
                MA.ASStateRemark, -- AS现状说明
                MA.ASCauseRemark, -- 原因分析
                MA.ASSolve,       -- 改善建议及方案
                MA.Remark,        -- 备注
                -- END
                
                MA.TransYn,       -- 是否移模
                MA.TransDeptCd,   -- 移模部门
                UGB.DeptNm AS TransDeptNm,
                IT.ItemNm         -- 品目名称
                from TASRecv00 MA
                left join TMACust00 MB		 	  on MA.CustCd      	   = MB.CustCd
                left join TMAEmpy00 UA			  on MA.EmpId       	   = UA.EmpID
                left join TMADept00 UGA    		  on MA.DeptCd      	   = UGA.DeptCd
                left join TMADept00 UGB			  on MA.TransDeptCd        = UGB.DeptCd
                -- DEFAULT
                left join TSMDict10 AStypeA		  on AStypeA.DictCd 	   = MA.AStype    	  and AStypeA.LangCd      = '$langCode'
                left join TSMSyco10 AStypeB		  on AStypeB.MinorCd       = MA.AStype
                
                -- SYSTEM
                left join TSMDict10 SupplyScopeA  on SupplyScopeA.DictCd   = MA.SupplyScope  and SupplyScopeA.LangCd  = '$langCode'
                left join TSMSyco10 SupplyScopeB  on SupplyScopeB.MinorCd  = MA.SupplyScope
                left join TSMDict10 HRSystemA     on HRSystemA.DictCd      = MA.HRSystem     and HRSystemA.LangCd     = '$langCode'
                left join TSMSyco10 HRSystemB     on HRSystemB.MinorCd     = MA.HRSystem
                left join TSMDict10 ManifoldTypeA on ManifoldTypeA.DictCd  = MA.ManifoldType and ManifoldTypeA.LangCd = '$langCode'
                left join TSMSyco10 ManifoldTypeB on ManifoldTypeB.MinorCd = MA.ManifoldType
                left join TSMDict10 SystemSizeA   on SystemSizeA.DictCd    = MA.SystemSize   and SystemSizeA.LangCd   = '$langCode'
                left join TSMSyco10 SystemSizeB   on SystemSizeB.MinorCd   = MA.SystemSize
                left join TSMDict10 SystemTypeA   on SystemTypeA.DictCd    = MA.SystemType   and SystemTypeA.LangCd   = '$langCode'
                left join TSMSyco10 SystemTypeB   on SystemTypeB.MinorCd   = MA.SystemType
                left join TSMDict10 GateTypeA     on GateTypeA.DictCd      = MA.GateType     and GateTypeA.LangCd     = '$langCode'
                left join TSMSyco10 GateTypeB     on GateTypeB.MinorCd     = MA.GateType
                
                -- ASCLASS
                left join TSMDict10 MarketCdA	  on MarketCdA.DictCd 	   = MA.MarketCd     and MarketCdA.LangCd  = '$langCode'
                left join TSMSyco10 MarketCdB	  on MarketCdB.MinorCd     = MA.MarketCd
                left join TSMDict10 OCCpointA	  on OCCpointA.DictCd      = MA.OCCpoint     and OCCpointA.LangCd  = '$langCode'
                left join TSMSyco10 OCCpointB	  on OCCpointB.MinorCd     = MA.OCCpoint
                left join TSMDict10 ASBadTypeA 	  on ASBadTypeA.DictCd     = MA.ASBadType    and ASBadTypeA.LangCd     = '$langCode'
                left join TSMSyco10 ASBadTypeB	  on ASBadTypeB.MinorCd    = MA.ASBadType
                left join TSMDict10 ASCauseDonorA on ASCauseDonorA.DictCd  = MA.ASCauseDonor and ASCauseDonorA.LangCd = '$langCode'
                left join TSMSyco10 ASCauseDonorB on ASCauseDonorB.MinorCd = MA.ASCauseDonor
                left join TSMDict10 DutyGubunA    on DutyGubunA.DictCd     = MA.DutyGubun    and DutyGubunA.LangCd    = '$langCode'
                left join TSMSyco10 DutyGubunB    on DutyGubunB.MinorCd    = MA.DutyGubun
                left join TSMDict10 ASClass1A     on ASClass1A.DictCd      = MA.ASClass1     and ASClass1A.LangCd     = '$langCode'
                left join TSMSyco10 ASClass1B     on ASClass1B.MinorCd     = MA.ASClass1
                left join TSMDict10 ASClass2A     on ASClass2A.DictCd      = MA.ASClass2     and ASClass2A.LangCd     = '$langCode'
                left join TSMSyco10 ASClass2B     on ASClass2B.MinorCd     = MA.ASClass2
                left join TSMDict10 ASAreaGubunA  on ASAreaGubunA.DictCd   = MA.ASAreaGubun  and ASAreaGubunA.LangCd  = '$langCode'
                left join TSMSyco10 ASAreaGubunB  on ASAreaGubunB.MinorCd  = MA.ASAreaGubun
                -- 品目
                left join TASRecv10 RE 			  on RE.ASRecvNo		   = MA.ASRecvNo
                left join TMAItem00 IT			  on IT.ItemCd		       = RE.ItemCd";

        $type = array(
           'MA.ASRecvNo'
        );
        $this->created($sql,$type);
        return $this->jlamp_query();
    }

    public function as_jobno($uid){
        $this->haswhere = true; //存在默认where条件
        $nowdate = date('Y-m-d',intval(time()));
        $sql = "select JobNo from TMAJobc10
                where
                EmpId = '$uid' 
                and LastYN = 'Y' 
                and '$nowdate' >= convert(char(10) ,STDate,120) 
                and '$nowdate' <= convert(char(10) ,EDDate, 120) ";
        $this->created($sql);
        return $this->jlamp_query();
    }

    public function as_minute_table(){
        $sql = "select 
                a.ASRecvSerl,
                a.Sort,
                a.SpareYn,
                b.ItemCd,
                b.ItemNm,
                b.ItemNo,
                b.Spec,
                c.UnitCd,
                c.UnitNm,
                a.Qty,
                a.ChargeYn,
                d.PreStockQty,
                a.Remark,
                a.NextQty,
                a.StopQty
                from TASRecv10 a
                left join TMAItem00 b on b.ItemCd = a.ItemCd
                left join TMAUnit00 c on a.UnitCd = c.UnitCd
                left join TMEWHItem00 d on a.ItemCd = d.ItemCd and d.WHCd = '01'   
                and d.StkStatus = '0'"; // --WHCd=01材料仓库  --StkStatus=0正常 9报废
        $type = array(
            'a.ASRecvNo'
        );
        $this->append('order by a.ASRecvSerl asc');
        $this->created($sql,$type);
        return $this->jlamp_query();
    }
    public function as_minute_Seq(){
        $sql = "select 
                ASRecvSerl
                from TASRecv10";
        $type = array(
            'ASRecvNo'
        );
        $this->append('order by ASRecvSerl desc');
        $this->created($sql,$type);
        return $this->jlamp_query();
    }
    public function as_item(){
        $sql = "select top 50 
                MA.ItemCd,
                MA.ItemNo,
                MA.ItemNm,
                MA.Spec,
                MB.UnitNm,
                MB.UnitCd,
                MA.Status,
                MC.PreStockQty
                from TMAItem00 MA
                left join TMAUnit00 MB on MA.StkUnitCd = MB.UnitCd
                left join TMEWHItem00 MC on MA.ItemCd = MC.ItemCd";
        $type = array(
            'MA.ItemNo|LIKE',
            'MA.ItemNm|LIKE|utf-8'
        );
        $this->created($sql,$type);
        return $this->jlamp_query();
    }
    public function as_item_more($page){
        $sql = "select TOP 50 * from (
                select
                Row_Number()over(order by MA.ItemCd) as rownumber,
                MA.ItemCd,
                MA.ItemNo,
                MA.ItemNm,
                MA.Spec,
                MB.UnitNm,
                MB.UnitCd,
                MA.Status,
                MC.PreStockQty
                from TMAItem00 MA
                left join TMAUnit00 MB on MA.StkUnitCd = MB.UnitCd
                left join TMEWHItem00 MC on MA.ItemCd = MC.ItemCd
                ";
        $sql_page = ") t where rownumber > $page";
        $type = array(
            'MA.ItemNo|LIKE',
            'MA.ItemNm|LIKE|utf-8'
        );
        $this->append($sql_page);
        $this->created($sql,$type);
        return $this->jlamp_query();
    }
    public function as_unit(){
        $sql = "select UnitNm AS text,UnitCd AS value from TMAUnit00";
        $this->created($sql);
        return $this->jlamp_query();
    }
    public function as_sales(){
        $sql = "select UA.SaleEmpID,UA.Seq,UB.EmpNm,UC.DeptNm from TASRecv30 UA
                left join TMAEmpy00 UB on UA.SaleEmpID = UB.EmpID
                left join TMADept00 UC on UB.DeptCd = UC.DeptCd";
        $type = array(
          'UA.ASRecvNo'
        );
        $this->created($sql,$type);
        return $this->jlamp_query();
    }
    public function as_photo(){
        $sql = "select FileNm,Photo,FTP_UseYn,Seq from TASRecv20";
        $type = array(
            'ASRecvNo'
        );
        $this->append('order by Seq asc');
        $this->created($sql,$type);
        return $this->jlamp_query();
    }
    public function as_photo_seq(){
        $sql = "select top 1 Seq from TASRecv20";
        $type = array(
            'ASRecvNo'
        );
        $this->append('order by Seq desc');
        $this->created($sql,$type);
        return $this->jlamp_query();
    }

    public function system_class($langCode='SM00010003'){
        $sql = "select 
                isnull(MULTIB.TransNm,MULTIA.MinorNm) AS text,
                isnull(MULTIB.DictCd,MULTIA.MinorCd) AS value 
                from TSMSyco10 MULTIA
                full join TSMDict10 MULTIB on MULTIA.MinorCd = MULTIB.DictCd and MULTIB.LangCd = '$langCode'";
        $type = array(
            'MULTIA.RelCd1',
            'left(MULTIA.MinorCd,6)',
        );
        $this->created($sql,$type);
        return $this->jlamp_query();
    }

    public function system_class_big($langCode='SM00010003'){
        $sql = "select 
                isnull(MULTIB.TransNm,MULTIA.MinorNm) AS text,
                isnull(MULTIB.DictCd,MULTIA.MinorCd) AS value 
                from TSMSyco10 MULTIA
                full join  TSMDict10 MULTIB on MULTIA.MinorCd = MULTIB.DictCd and MULTIB.LangCd = '$langCode'";
        $type = array(
            'left(MULTIA.MinorCd,6)'
        );
        $this->created($sql,$type);
        return $this->jlamp_query();
    }


    public function userlist(){
        $this->haswhere = true; //存在默认where条件
        $sql = "select a.EmpID,a.EmpNm,b.DeptCd,b.DeptNm from TMAEmpy00 a,TMADept00 b 
               where a.DeptCd = b.DeptCd AND a.RetireYn = 'N'";
        $type = array(
            'a.EmpNm|LIKE|utf-8',
            'a.EmpID',
            'b.DeptNm|LIKE|utf-8'
        );
        $this->created($sql,$type);
        return $this->jlamp_query();
    }

    public function grouplist(){
        $sql = "select DeptCd,DeptNm from TMADept00";
        $type = [
            'DeptCd',
            'DeptNm|LIKE|utf-8'
        ];
        $this->created($sql,$type);
        return $this->jlamp_query();
    }

    public function auth($loginid,$auth){
        $sql = "select UB.DeptCd,UB.MDeptCd,UC.emp_code,UD.JobNo from TMAEmpy00 UA 
                left join TMADept00 UB on UB.DeptCd = UA.DeptCd              
                left join sysUserMaster UC on UA.EmpId = UC.emp_code and isnull(UC.emp_code,'')!=''
                left join TMAJobc10 UD on UD.EmpId = UC.emp_code 
                INNER join TMAJobc00 UE on UE.JobNo = UD.JobNo and UE.SaleYn = 'Y' 
                WHERE UC.user_id = '$loginid' and UD.LastYN = 'Y'
                and getdate() between UD.STDate and UD.EDDate
                ";
        $result = $this->jlamp_common_mdl->sqlRow($sql);
        $result = json_decode(json_encode($result),true);
        $DeptCd = $result['DeptCd'];
        $MDeptCd = $result['MDeptCd'];
        $empId = $result['emp_code'];
        $jobNo = $result['JobNo'];
        switch ($auth){
            case AUTH_A:
                $this->auth = '';
                break;
            case AUTH_E:   //个人
                $this->auth = " AND MA.EmpId = '$empId'";
                break;
            case AUTH_J:
                $this->auth = " AND MA.JobNo = '$jobNo'";
                break;
            case AUTH_D:   //部门
                $this->auth = " AND UB.DeptCd = '$DeptCd'";
                break;
            case AUTH_M:   //管理
                $this->auth = "AND UB.DeptCd in (select DeptCd from dbo.fnMDeptCd('y','$empId') )";
                break;
            default:  //默认为个人
                $this->auth = " AND UB.DeptCd = '$DeptCd'";
                break;
        }
    }
    public function speclist(){
        $sql = "select top 50 Row_Number()over(order by MA.SpecNo desc)AS id,MA.SpecNo,MA.SpecType,MA.SpecDate,MA.ExpClss,CA.CustNm,UA.EmpNm,UB.DeptNm from TSASpec00 MA
                left join TMAEmpy00 UA on MA.EmpId = UA.EmpID
                left join TMADept00 UB on MA.DeptCd = UB.DeptCd
                left join TMACust00 CA on MA.CustCd = CA.CustCd";
        $type = array(
            'MA.SpecNo|LIKE|utf-8',
            'CA.CustNm|LIKE|utf-8'
        );
        $this->append(' order by MA.SpecNo desc');
        $this->created($sql,$type);
        return $this->jlamp_query();
    }
    public function speclist_more($get_speccount){
        $sql = "select top 50 * from 
                (select Row_Number()over(order by MA.SpecNo desc)AS id,MA.SpecNo,MA.SpecType,MA.SpecDate,MA.ExpClss,CA.CustNm,UA.EmpNm,UB.DeptNm from TSASpec00 MA
                left join TMAEmpy00 UA on MA.EmpId = UA.EmpID
                left join TMADept00 UB on MA.DeptCd = UB.DeptCd
                left join TMACust00 CA on MA.CustCd = CA.CustCd";
        $type = array(
            'MA.SpecNo|LIKE|utf-8',
            'CA.CustNm|LIKE|utf-8'
        );
        $this->append(')T where id > 50 order by id asc');
        $this->created($sql,$type);
        return $this->jlamp_query();
    }
    public function spec_minute($langCode='SM00010003'){
        $sql = "select MA.SpecNo,
                MA.SpecType,
                MA.PartDesc, --客户产品名称
                MA.GateQty,
                MA.CustCd,
                MA.RefNo, --模号
                MA.SpecType,
                MA.DrawNo,
                MA.DrawAmd,
                MB.Resin, --塑胶
                MA.SpecDate,
                MA.ExpClss,
                CA.CustNm,
                -- SYSTEM
                MB.SupplyScope,   ISNULL(SupplyScopeA.TransNm,SupplyScopeB.MinorNm)   AS SupplyScopeNm,
                MB.HRSystem,      ISNULL(HRSystemA.TransNm,HRSystemB.MinorNm)         AS HRSystemNm,
                MB.ManifoldType,  ISNULL(ManifoldTypeA.TransNm,ManifoldTypeB.MinorNm) AS ManifoldTypeNm,
                MB.SystemSize,    ISNULL(SystemSizeA.TransNm,SystemSizeB.MinorNm)   	 AS SystemSizeNm,
                MB.SystemType,    ISNULL(SystemTypeA.TransNm,SystemTypeB.MinorNm)     AS SystemTypeNm,
                MB.GateType,      ISNULL(GateTypeA.TransNm,GateTypeB.MinorNm)         AS GateTypeNm
                from TSASpec00 MA
                left join TSASpec30 MB on MA.SpecNo = MB.SpecNo
                left join TMACust00 CA on MA.CustCd = CA.CustCd
                -- SYSTEM
                left join TSMDict10 SupplyScopeA  on SupplyScopeA.DictCd   = MB.SupplyScope  and SupplyScopeA.LangCd  = '$langCode'
                left join TSMSyco10 SupplyScopeB  on SupplyScopeB.MinorCd  = MB.SupplyScope
                left join TSMDict10 HRSystemA     on HRSystemA.DictCd      = MB.HRSystem     and HRSystemA.LangCd     = '$langCode'
                left join TSMSyco10 HRSystemB     on HRSystemB.MinorCd     = MB.HRSystem
                left join TSMDict10 ManifoldTypeA on ManifoldTypeA.DictCd  = MB.ManifoldType and ManifoldTypeA.LangCd = '$langCode'
                left join TSMSyco10 ManifoldTypeB on ManifoldTypeB.MinorCd = MB.ManifoldType
                
                left join TSMDict10 SystemSizeA   on SystemSizeA.DictCd    = MB.SystemSize   and SystemSizeA.LangCd   = '$langCode'
                left join TSMSyco10 SystemSizeB   on SystemSizeB.MinorCd   = MB.SystemSize
                
                left join TSMDict10 SystemTypeA   on SystemTypeA.DictCd    = MB.SystemType   and SystemTypeA.LangCd   = '$langCode'
                left join TSMSyco10 SystemTypeB   on SystemTypeB.MinorCd   = MB.SystemType
                left join TSMDict10 GateTypeA     on GateTypeA.DictCd      = MB.GateType     and GateTypeA.LangCd     = '$langCode'
                left join TSMSyco10 GateTypeB     on GateTypeB.MinorCd     = MB.GateType";
        $type = array(
          'MA.SpecNo'
        );
        $this->created($sql,$type);
        return $this->jlamp_query();
    }
    public function cust_list($langCode){
        $this->haswhere= true;
        $sql = "SELECT top 50 a.CustCd,a.CustNm,a.KoOrFo,isnull(b.TransNm,c.MinorNm) as status,a.Status as StatusId
                FROM TMACust00 a
                LEFT JOIN TSMDict10 b ON a.Status = b.DictCd AND b.LangCd = '$langCode'
                LEFT JOIN TSMSyco10 c on a.Status = c.MinorCd
               left join TMACust10 MA on MA.CustCd = a.CustCd
               left join TMAEmpy00 UA on MA.EmpId = UA.EmpID
               left join TMADept00 UB on UA.DeptCd = UB.DeptCd
                where MA.ChargeType='N' AND  getdate() between  MA.STDate and MA.EDDate $this->auth";
        $type = array(
            'a.CustCd|LIKE',
            'a.CustNm|LIKE|utf-8'
        );
        $this->append(" order by a.CustCd asc");
        $this->created($sql,$type);
        return $this->jlamp_query();
    }
    public function cust_list_more($count,$langCode){
        $this->haswhere= true;
        $sql="select top 50 * from (
              SELECT Row_Number()over(order by a.CustCd asc)AS id,
              a.CustCd,a.CustNm,a.KoOrFo,isnull(b.TransNm,c.MinorNm) as status,a.Status as StatusId
              FROM TMACust00 a
              LEFT JOIN TSMDict10 b ON a.Status = b.DictCd AND b.LangCd = '$langCode'
              LEFT JOIN TSMSyco10 c on a.Status = c.MinorCd
              left join TMACust10 MA on MA.CustCd = a.CustCd
              left join TMAEmpy00 UA on MA.EmpId = UA.EmpID
              left join TMADept00 UB on UA.DeptCd = UB.DeptCd
              where MA.ChargeType='N' AND  getdate() between MA.STDate and MA.EDDate $this->auth";
        $type = array(
            'a.CustCd|LIKE',
            'a.CustNm|LIKE|utf-8'
        );
        $this->append(")T where id > $count order by id asc");
        $this->created($sql,$type);
        return $this->jlamp_query();
    }
    public function order_minute($orderid,$langCode){
        $this->haswhere = true;//存在默认where条件
        $sql = "select 
                MB.EmpId AS list,
                MB.CustCd,
                MB.ExpClss,
                MB.SystemType AS systype,
                MB.DrawNo,
                MB.SpecNo,
                MB.DrawAmd,
                MB.RefNo AS model_id,
                MB.GoodNm AS cust_produce_name,
                MB.SpecType,
                MB.OrderNo,MB.OrderDate,MB.DelvDate,MB.GateQty,MC.CustNm AS custname,isnull(FB.TransNm,FA.MinorNm) as systemtype,
                isnull(FD.TransNm,FC.MinorNm) as MarketNm,
                MB.MarketCd,
                LA.EmpID,LA.EmpNm,LB.DeptCd,LB.DeptNm,
                -- SYSTEM
                MB.SupplyScope,   ISNULL(SupplyScopeA.TransNm,SupplyScopeB.MinorNm)   AS SupplyScopeNm,
                MB.HRSystem,      ISNULL(HRSystemA.TransNm,HRSystemB.MinorNm)         AS HRSystemNm,
                MB.ManifoldType,  ISNULL(ManifoldTypeA.TransNm,ManifoldTypeB.MinorNm) AS ManifoldTypeNm,
                MB.SystemSize,    ISNULL(SystemSizeA.TransNm,SystemSizeB.MinorNm)   	 AS SystemSizeNm,
                MB.SystemType,    ISNULL(SystemTypeA.TransNm,SystemTypeB.MinorNm)     AS SystemTypeNm,
                MB.GateType,      ISNULL(GateTypeA.TransNm,GateTypeB.MinorNm)         AS GateTypeNm,
                -- Resin
                ISNULL(ResinA.TransNm,ResinB.MinorNm)+' '
                +ISNULL(ResinAddA.TransNm,ResinAddB.MinorNm)+' '
                +convert(Nvarchar(10),Spec.ResinRate)
                +'%' 
                AS Resin
                -- 客户表
                from TSAOrder00 MB
                left join TMACust00 MC on MB.CustCd = MC.CustCd  -- 客户名称
                left join TSMSyco10 FA on FA.MinorCd = MB.SystemType
                left join TSMDict10 FB on FB.DictCd = MB.SystemType and FB.LangCd = '$langCode'
                left join TSMSyco10 FC on FA.MinorCd = MB.MarketCd
                left join TSMDict10 FD on FD.DictCd = MB.MarketCd and FD.LangCd = '$langCode'
                left join TMAEmpy00 LA on MB.EmpId = LA.EmpID   -- 员工信息
                left join TMADept00 LB on MB.DeptCd = LB.DeptCd -- 部门信息
                 -- SYSTEM
                left join TSMDict10 SupplyScopeA  on SupplyScopeA.DictCd   = MB.SupplyScope  and SupplyScopeA.LangCd  = '$langCode'
                left join TSMSyco10 SupplyScopeB  on SupplyScopeB.MinorCd  = MB.SupplyScope
                left join TSMDict10 HRSystemA     on HRSystemA.DictCd      = MB.HRSystem     and HRSystemA.LangCd     = '$langCode'
                left join TSMSyco10 HRSystemB     on HRSystemB.MinorCd     = MB.HRSystem
                left join TSMDict10 ManifoldTypeA on ManifoldTypeA.DictCd  = MB.ManifoldType and ManifoldTypeA.LangCd = '$langCode'
                left join TSMSyco10 ManifoldTypeB on ManifoldTypeB.MinorCd = MB.ManifoldType
                
                left join TSMDict10 SystemSizeA   on SystemSizeA.DictCd    = MB.SystemSize   and SystemSizeA.LangCd   = '$langCode'
                left join TSMSyco10 SystemSizeB   on SystemSizeB.MinorCd   = MB.SystemSize
                
                left join TSMDict10 SystemTypeA   on SystemTypeA.DictCd    = MB.SystemType   and SystemTypeA.LangCd   = '$langCode'
                left join TSMSyco10 SystemTypeB   on SystemTypeB.MinorCd   = MB.SystemType
                left join TSMDict10 GateTypeA     on GateTypeA.DictCd      = MB.GateType     and GateTypeA.LangCd     = '$langCode'
                left join TSMSyco10 GateTypeB     on GateTypeB.MinorCd     = MB.GateType
                
                left join TSASpec30 Spec on Spec.SpecNo = MB.SpecNo and Spec.SpecType = MB.SpecType
                
                left join TSMDict10 ResinA  on ResinA.DictCd   = Spec.Resin  and ResinA.LangCd     = '$langCode'
                left join TSMSyco10 ResinB  on ResinB.MinorCd = Spec.Resin
                left join TSMDict10 ResinAddA  on ResinAddA.DictCd   = Spec.ResinAdd  and ResinAddA.LangCd     = '$langCode'
                left join TSMSyco10 ResinAddB  on ResinAddB.MinorCd = Spec.ResinAdd
         
                where MB.OrderNo = '$orderid' AND MB.CfmYn='1'";
        $this->created($sql);
        return $this->jlamp_query();

    }

    public function orderlist($langCode='SM00010003'){
        $this->haswhere = true;//存在默认where条件
        $nowtime = date('Y-m-d',intval(time()));
        $sql = "select top 50 Row_Number()over(order by MA.OrderNo desc)AS id,
                MA.CustCd,
                MA.ExpClss,
                MA.GoodNm AS cust_produce_name,
                MA.OrderNo,MA.OrderDate,MA.DelvDate,MC.CustNm AS custname,
                MA.MarketCd,
                UA.EmpID,UA.EmpNm,UB.DeptCd,UB.DeptNm 
                from TSAOrder00 MA -- 订单信息
                left join TMACust00 MC on MA.CustCd = MC.CustCd  -- 客户名称
                left join TMAEmpy00 UA on MA.EmpId = UA.EmpID   -- 员工信息
                left join TMADept00 UB on MA.DeptCd = UB.DeptCd -- 部门信息
                where MA.CfmYn='1' $this->auth ";
        $type = array(
            'MC.CustNm|LIKE|utf-8',
            'MA.OrderNo|LIKE'
        );
        $this->append(' order by MA.OrderNo desc');
        $this->created($sql,$type);
        return $this->jlamp_query();
    }

    public function orderlist_more($langCode='SM00010003',$get_ordercount = 0){
        $this->haswhere = true;//存在默认where条件
        $nowtime = date('Y-m-d',intval(time()));
        $sql = "select top 50 * from 
                (select Row_Number()over(order by MA.OrderNo desc)AS id,
                MA.CustCd,
                MA.ExpClss,
                MA.GoodNm AS cust_produce_name,
                MA.OrderNo,MA.OrderDate,MA.DelvDate,MC.CustNm AS custname,
                MA.MarketCd,
                UA.EmpID,UA.EmpNm,UB.DeptCd,UB.DeptNm
                from TSAOrder00 MA -- 客户表
                left join TMACust00 MC on MA.CustCd = MC.CustCd  -- 客户名称
                left join TMAEmpy00 UA on MA.EmpId = UA.EmpID   -- 员工信息
                left join TMADept00 UB on MA.DeptCd = UB.DeptCd -- 部门信息
                where MA.CfmYn='1' $this->auth ";

        $type = array(
            'MC.CustNm|LIKE|utf-8',
            'MA.OrderNo|LIKE'
        );
        //末尾添加
        $this->append(" )t where id > $get_ordercount order by id asc");
        //拼接
        $this->created($sql,$type);

//        $this->created_append($page_query,$type);

        //执行sql
        return $this->jlamp_query();
    }

    public function as_sendSmsToUser(){
        $this->haswhere = true;//存在默认where条件
        $sql = "SELECT  IsNull(e.EmpID,'') as adminId, 
             IsNull(e.HP,'') as adminPhone,           --管理员 àó名HP
             IsNull(e1.EmpID,'') as userId,
             IsNull(e1.HP,'') as sales,          --部门销售负责人
             ISNULL(S.RelCd1,'') as relCd,
             IsNull(A.OrderNo,'') as orderNo,
             IsNull(C.TrunNm,'') as trunNm,
             IsNull(A.OrderCnt,0) as orderCnt,
             IsNull(e2.EmpNm,'') as empNm
             ,IsNull((SELECT IsNull(MM.TransNm, M.MinorNm)    
                           FROM  TSMSyco10 M Left Outer Join TSMDict10 MM On M.MinorCd = MM.DictCd AND MM.LangCd = 'SM00010003'
                           WHERE M.MajorCd = 'AS1009' And  A.ChargeYn = M.RelCd1),'') as system1
             ,IsNull((SELECT IsNull(MM.TransNm, M.MinorNm)    
                           FROM  TSMSyco10 M Left Outer Join TSMDict10 MM On M.MinorCd = MM.DictCd AND MM.LangCd = 'SM00010003'
                           WHERE M.MajorCd = 'AS1011' And  A.ASCauseDonor = M.MinorCd),'') as system2
             ,IsNull((SELECT IsNull(MM.TransNm, M.MinorNm)    
                           FROM  TSMSyco10 M Left Outer Join TSMDict10 MM On M.MinorCd = MM.DictCd AND MM.LangCd = 'SM00010003'
                           WHERE M.MajorCd = 'AS1006' And  A.ASClass1 = M.MinorCd),'') as system3
             ,IsNull((SELECT IsNull(MM.TransNm, M.MinorNm)    
                           FROM  TSMSyco10 M Left Outer Join TSMDict10 MM On M.MinorCd = MM.DictCd AND MM.LangCd = 'SM00010003'
                           WHERE M.MajorCd = 'AS1007' And  A.ASClass2 = M.MinorCd),'') as system4
             FROM TASRecv00 a With(Nolock) Left Outer Join TMADept00 d With(Nolock)  On a.DeptCd = d.DeptCd
             Left Outer Join TMAEmpy00 e With(Nolock)  On d.MEmpID = e.EmpID
             Left Outer Join TSMSyco10 s With(Nolock)  On d.DeptDiv1 = s.MinorCd
             Left Outer Join TSMSyco10 s1 With(Nolock)  On d.DeptDiv2 = s1.MinorCd
             Left Outer Join TMAEmpy00 e1 With(Nolock)  On ISNULL(LTRIM(RTRIM(s1.RelCd1)),'') = e1.EmpID
             Left Outer Join TMAEmpy00 e2 With(Nolock)  On a.EmpID= e2.EmpID
             Left Outer Join TMACust00 c With(Nolock) On A.CustCd = c.CustCd      
             WHERE A.Ordergubun = '1'";
        $type = array(
            'A.ASRecvNo',
            'A.OrderCnt|GRE'
        );
        $this->created($sql,$type);
        return $this->jlamp_query();
    }
    public function as_sendSmsToLeader(){
        $sql = "select E.EmpID, E.EmpNm, IsNull(E.HP,''),
                CAST(LTrim(RTrim(A.RelCd3)) AS Integer)
                from TSMSyco10 A Left Outer Join TMAEmpy00 E
                On LTrim(RTrim(A.RelCd1)) = E.EmpID
                where A.MajorCd = 'AS0001'
                And CAST(LTrim(RTrim(A.RelCd3)) As Integer) <= 5";
        $this->created($sql);
        return $this->jlamp_query();
    }

    public function as_count($orderid){
        $sql = "SELECT Count(OrderNo) as ascount FROM TASRecv00 With ( Nolock ) WHERE OrderNo ='$orderid' AND OrderGubun ='1' AND CfmYn ='1' ";
        $this->created($sql);
        return $this->jlamp_query();
    }


    //--链式拼接---------------------------
    public function table($table){
        $this->table = $table;
        return $this;
    }
    public function field($filed){
        $this->filed = $filed;
        return $this;
    }
    public function append($sql){
        $this->append = ' '.$sql;
        return $this;
    }
    public function order($order){
        $this->order = explode(',',$order);
        return $this;
    }
    public function sudo(){
        $this->m_print = 1;
        return $this;
    }

    public function object(){
        $this->dataType = 'Object';
        return $this;
    }

    public function find(){
        $this->sqlsen = '';
        $this->m_count = 'find';
        if(!empty($this->table)){
            $this->created();
           return $this->jlamp_query();
        }
        else
        {
            return $this;
        }
    }
    public function select(){
        $this->sqlsen = '';
        $this->m_count = 'select';
        if(!empty($this->table)){
            $this->created();
           return $this->jlamp_query();
        }
        else
        {
            return $this;
        }
    }
    public function where($array){
        if(!empty($array))
        {
            $sql = '';
            //如果自定义table
            if(!empty($this->table)){
                $this->where = '';
                foreach ($array as $k => $v) {
                    if (empty($v) || empty($k)) {
                        self::$error = 1;
                    }
                    $sql .= ' ' . $k . '=' . "'$v' AND";
                }
                $sql = substr($sql,0,strlen($sql)-3);
                $this->where = $sql;
            }
            else
            {
                foreach($array as $k => $v){
                    $v = str_replace(' ','',$v);
                    if(!empty(str_replace('%','',$v))){
                        $this->isnull = false;
                        $this->multi['where'][] = $v;
                    }
                    else
                    {
                        $this->multi['where'][] = '';
                    }
                }
            }
        }
        return $this;
    }

    private function jlamp_query(){
        //当需要解析打印链式语法为原生sql时候
        if($this->m_print != 1)
        {
            switch ($this->m_count){
                case 'find':
                    $result = $this->jlamp_common_mdl->sqlRow($this->sqlsen);
                    break;
                case 'select':
                    $result = $this->jlamp_common_mdl->sqlRows($this->sqlsen);
                    break;
                default:
                    $result = $this->jlamp_common_mdl->sqlRows($this->sqlsen);
                    break;
            }
            if($this->dataType == 'Array'){
                $result = json_decode(json_encode($result),true);
            }
            return $result;
        }
        else
        {
            return $this->sqlsen;
        }
    }

    //sql where条件拼接
    private function created($sql = '',$type = array()){
        error_reporting( E_ALL&~E_NOTICE );
        //自定义table
        if(!empty($this->table)){
//            if(empty($this->filed)){
//                self::$error = 1;
//                return 'not found filed data';
//            }
            empty($this->filed) ? $this->filed = '*' : $this->filed;
            $sql = "SELECT $this->filed FROM $this->table WHERE ";
            if(!empty($this->order)){
                if(empty($this->order[0])){
                    self::$error = 1;
                    return 'not found order key1 data';
                }
                if(empty($this->order[1])){
                    self::$error = 1;
                    return 'not found order key2 data';
                }
                $this->sqlsen = $sql.$this->where.' ORDER BY '.$this->order[0].' '.$this->order[1];
            }
            else{
                $this->sqlsen = $sql.$this->where;
            }
        }
        else
        {
            $num = 0;
            //如果当前链式操作有条件值
            if($this->isnull != true){
                //如果原生语句没有where则加个where
                if($this->haswhere == false) {
                    $sql .=' WHERE ';
                    $num = 0; //开头不加AND
                }
                else{
                    $num = 1; //开头加一个AND
                }
            }
            $created_make = $this->created_make($sql,$type,$num);
            $this->sqlsen .= $created_make." ".$this->append;
        }
    }
    private function created_append($sql,$type = array()){
        //如果当前链式操作有条件值
        if($this->isnull != true){
            $sql = ' AND '.$sql;
        }
        else
        {
            //如果原生sql没有where，则加一个
            if($this->haswhere == false){
                $sql = ' WHERE '.$sql;
            }
        }
        $this->created($sql,$type);
    }

    private function created_make($sql,$type,$num){
        $AND = '';
        $valuefont = '';
        foreach ($type as $k => $v){
            //去除%修饰符，如果数据为空，则不添加where条件
            if(empty(str_replace('%','',$this->multi['where'][$k]))){
                continue;
            }
            $keyfont = explode('|',$v);
            if($num > 0){
                $AND = ' AND ';
            }
            //区分LIKE/=/等
            switch ($keyfont[1]){
                case 'LIKE':
                case 'like':
                    $term =  ' LIKE ';
                    break;
                case 'GRE':
                    $term = ' > ';
                    break;
                case 'LES':
                    $term = ' < ';
                    break;
                case 'UEQ':
                    $term =  ' <> ';
                    break;
                default:
                    $term =  ' = ';
                    break;
            }
            //条件修饰,目前支持N方法
            switch($keyfont[2]){
                case 'utf-8':
                    $valuefont = "N'".$this->multi['where'][$k];
                    break;
                default:
                    $valuefont = "'".$this->multi['where'][$k];
                    break;
            }
            $sql = $sql.$AND.$keyfont[0].$term.$valuefont."' ";
            $num++;
        }
        return $sql;
    }
}

<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Worker10_model extends JLAMP_Model {

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

    public function msgList($time){
        $this->haswhere = true;
        $planSql = "select MA.ActPlanDate
                    from TOAActPlan00 MA 
                    --left join TMACust10 MB on MA.CustCd = MB.CustCd  
                    left join TMADept00 GA on MA.DeptCd = GA.DeptCd
                    where convert(char(7) ,MA.ActPlanDate ,120) = '$time'
                    --AND getdate() between MB.STDate and MB.EDDate
                    --AND MB.ChargeType='N'
                    $this->auth 
                   ";
        $reptSql = "select MA.ActReptDate
                    from TOAActRept00 MA 
                    --left join TMACust10 MB on MA.CustCd = MB.CustCd 
                    left join TMADept00 GA on MA.DeptCd = GA.DeptCd 
                    where convert(char(7) ,MA.ActReptDate,120) = '$time'
                    --AND getdate() between MB.STDate and MB.EDDate
                    --AND MB.ChargeType='N'
                    $this->auth";
        $this->created($planSql);
        $res1 = $this->jlamp_query();
        $this->created($reptSql);
        $res2 = $this->jlamp_query();
        $result = array(
            'plan' => array(),
            'rept' => array()
        );
        foreach ($res1[0] as $k => $v){
            $arr = &$result['plan'][(int)substr($v['ActPlanDate'],8,2)];
            if(empty($arr)){
                $arr = 1;
            }else{
                $arr += 1;
            }
        }
        foreach ($res2[0] as $k => $v){
            $arr = &$result['rept'][(int)substr($v['ActReptDate'],8,2)];
            if(empty($arr)){
                $arr = 1;
            }else{
                $arr += 1;
            }
        }
        return $result;
    }
    public function AllList($class,$startDate,$endDate){
        $this->haswhere = true;
        if($class == 'plan'){
            $sql = "select
                top 50 
                MA.ActPlanNo, --活动计划编号
                MA.ActPlanDate, --活动计划日
                MA.LocationAddr,
                ISNULL(MC.CustNm,'') AS CustNm,
                ISNULL(UA.EmpNm,'') AS CustUserNm,
                UB.EmpNm,
                GA.DeptNm,
                MA.Status
                from TOAActPlan00 MA
                --left join TMACust10 MB on MA.CustCd = MB.CustCd  
                left join TMACust00 MC on MC.CustCd = MA.CustCd
                left join TMAEmpy00 UA on MA.EmpId = UA.EmpID --客户负责人
                left join TMAEmpy00 UB on MA.EmpID = UB.EmpID --职员名称
                left join  TMADept00 GA on MA.DeptCd = GA.DeptCd --职员部门
                where convert(char(10) ,MA.ActPlanDate, 120) between '$startDate' and '$endDate'
                --AND getdate() between MB.STDate and MB.EDDate
                --AND MB.ChargeType='N'
                $this->auth ";
            $type = array(
                'MA.ActPlanNo|LIKE'
            );
            $this->append(" order by MA.ActPlanNo desc");
            $this->created($sql,$type);
            return $this->jlamp_query();
        }else{
            $sql = "select 
                TOP 50
                MA.ActReptNo, --工作报告编号
                MA.ActReptDate, --工作报告日
                MA.ActPlanNo,  --工作计划编号
                MA.MeetingSubject, --会议主题
                MA.MeetingPlace,--会议地点
                ISNULL(MC.CustNm,'') AS CustNm,
                ISNULL(UA.EmpNm,'') AS CustUserNm,
                UB.EmpNm,
                GA.DeptNm
                from TOAActRept00 MA
                --left join TMACust10 MB on MA.CustCd = MB.CustCd  
                left join TMACust00 MC on MC.CustCd = MA.CustCd
                left join TMAEmpy00 UA on MA.EmpId = UA.EmpID --客户负责人
                left join TMAEmpy00 UB on MA.EmpID = UB.EmpID --职员名称
                left join  TMADept00 GA on MA.DeptCd = GA.DeptCd --职员部门
                where convert(char(10) ,MA.ActReptDate, 120) between '$startDate' and '$endDate'
                --AND getdate() between MB.STDate and MB.EDDate
                --AND MB.ChargeType='N'
                $this->auth";
            $type = array(
                'MA.ActReptNo|LIKE'
            );
            $this->append(" order by MA.ActReptNo desc");
            $this->created($sql,$type);
            return $this->jlamp_query();
        }
    }
    public function AllListMore($class,$startDate,$endDate,$count){
        $this->haswhere = true;
        if($class == 'plan'){
            $sql = "select top 50 * from
                (select 
                Row_Number()over(order 
                
                by MA.ActPlanNo desc)AS id,
                MA.ActPlanNo, --活动计划编号
                MA.ActPlanDate, --活动计划日
                MA.LocationAddr,
                ISNULL(MC.CustNm,'') AS CustNm,
                ISNULL(UA.EmpNm,'') AS CustUserNm,
                UB.EmpNm,
                GA.DeptNm,
                MA.Status
                from TOAActPlan00 MA
                --left join TMACust10 MB on MA.CustCd = MB.CustCd  
                left join TMACust00 MC on MC.CustCd = MA.CustCd
                left join TMAEmpy00 UA on MA.EmpId = UA.EmpID --客户负责人
                left join TMAEmpy00 UB on MA.EmpID = UB.EmpID --职员名称
                left join  TMADept00 GA on MA.DeptCd = GA.DeptCd --职员部门
                where convert(char(10) ,MA.ActPlanDate, 120) between '$startDate' and '$endDate'
                --AND getdate() between MB.STDate and MB.EDDate
                --AND MB.ChargeType='N' 
                $this->auth";
            $type = array(
                'MA.ActPlanNo|LIKE'
            );
            $this->append(")T where id > $count order by id asc");
            $this->created($sql,$type);
            return $this->jlamp_query();
        }else{
            $sql = "select top 50 * from
                (select 
                Row_Number()over(order by MA.ActReptNo desc)AS id,
                MA.ActReptNo, --工作报告编号
                MA.ActReptDate, --工作报告日
                MA.ActPlanNo,  --工作计划编号
                MA.MeetingSubject, --会议主题
                MA.MeetingPlace,--会议地点
                ISNULL(MC.CustNm,'') AS CustNm,
                ISNULL(UA.EmpNm,'') AS CustUserNm,
                UB.EmpNm,
                GA.DeptNm
                from TOAActRept00 MA
                --left join TMACust10 MB on MA.CustCd = MB.CustCd  
                left join TMACust00 MC on MC.CustCd = MA.CustCd
                left join TMAEmpy00 UA on MA.EmpId = UA.EmpID --客户负责人
                left join TMAEmpy00 UB on MA.EmpID = UB.EmpID --职员名称
                left join  TMADept00 GA on MA.DeptCd = GA.DeptCd --职员部门
                where convert(char(10) ,MA.ActReptDate, 120) between '$startDate' and '$endDate'
                --AND getdate() between MB.STDate and MB.EDDate
                --AND MB.ChargeType='N' 
                $this->auth";
            $type = array(
                'MA.ActReptNo|LIKE'
            );
            $this->append(")T where id > $count order by id asc");
            $this->created($sql,$type);
            return $this->jlamp_query();
        }
    }
    public function getPlanOrReptCount($startDate,$endDate){
        $sql = "select sum(T.PlanCount) as PlanCount,sum(T.ReptCount) as ReptCount,b.DeptNm,b.DeptCd from 
                (select COUNT(ActPlanNo) As PlanCount,0 ReptCount,DeptCd from TOAActPlan00 
                WHERE ActPlanDate between '$startDate' and '$endDate' group by DeptCd 
                union all
                select 0 PlanCount,COUNT(ActReptNo) As ReptCount,DeptCd from TOAActRept00 
                WHERE ActReptDate between '$startDate' and '$endDate' group by DeptCd)T 
                left join TMADept00 b on b.DeptCd = T.DeptCd group by b.DeptNm,b.DeptCd";
        $this->created($sql);
        return $this->jlamp_query();
    }
    public function planList($date){
        $this->haswhere = true;
        $sql = "select 
                TOP 50
                MA.ActPlanNo, --活动计划编号
                Convert(varchar(10),MA.ActPlanDate,23) AS ActPlanDate, --活动计划日
                MA.LocationAddr,
                ISNULL(MC.CustNm,'') AS CustNm,
                ISNULL(UA.EmpNm,'') AS CustUserNm,
                UB.EmpNm,
                GA.DeptNm,
                MA.Status
                from TOAActPlan00 MA
                --left join TMACust10 MB on MA.CustCd = MB.CustCd  
                left join TMACust00 MC on MC.CustCd = MA.CustCd
                left join TMAEmpy00 UA on MA.EmpId = UA.EmpID --客户负责人
                left join TMAEmpy00 UB on MA.EmpID = UB.EmpID --职员名称
                left join  TMADept00 GA on MA.DeptCd = GA.DeptCd --职员部门
                where convert(char(10) ,MA.ActPlanDate, 120) = '$date'  
                --AND getdate() between MB.STDate and MB.EDDate
                --AND MB.ChargeType='N' 
                -- $this->auth";
        $this->created($sql);
        return $this->jlamp_query();
    }
    public function reptList($date){
        $this->haswhere = true;
        $sql = "select 
                TOP 50
                MA.ActReptNo, --工作报告编号
                Convert(varchar(10),MA.ActReptDate,23) AS ActReptDate, --工作报告日
                MA.ActPlanNo,  --工作计划编号
                MA.MeetingSubject, --会议主题
                MA.MeetingPlace,--会议地点
                ISNULL(MC.CustNm,'') AS CustNm,
                ISNULL(UA.EmpNm,'') AS CustUserNm,
                UB.EmpNm,
                GA.DeptNm
                from TOAActRept00 MA
                --left join TMACust10 MB on MA.CustCd = MB.CustCd  
                left join TMACust00 MC on MC.CustCd = MA.CustCd
                left join TMAEmpy00 UA on MA.EmpId = UA.EmpID --客户负责人
                left join TMAEmpy00 UB on MA.EmpID = UB.EmpID --职员名称
                left join  TMADept00 GA on MA.DeptCd = GA.DeptCd --职员部门
                where convert(char(10) ,MA.ActReptDate, 120) = '$date'  
                --AND getdate() between MB.STDate and MB.EDDate
                --AND MB.ChargeType='N'
                --  $this->auth";
        $this->created($sql);
        return $this->jlamp_query();
    }
    public function planMinute($actPlanNo,$langCode){
        $this->haswhere = true;
        $sql = "select 
                MA.ActPlanNo, 		--工作计划编号
                MA.ActPlanDate,	--工作报告日
                MA.LocationAddr,
                MA.CustCd,
                MA.EmpID,
                MA.DeptCd,
                MA.ActGubun, 		--工作活动区分
                MA.RelationClass, --工作活动相关范畴
                ISNULL(LB.TransNm,LA.MinorNm) AS ActGubunNm,
                ISNULL(LD.TransNm,LC.MinorNm) AS RelationClassNm,
                MA.Status,
                MA.DestinationNm,	--目的地名
                MA.ActTitle,		--工作活动标题
                MA.ActSTDate,
                MA.ActEDDate,
                MA.ActContents, --活动内容
                MA.JobReportYn, --作报告与否
                MA.FinishYn,    --完成与否            
                ISNULL(MC.CustNm,'') AS CustNm,
                ISNULL(UA.EmpNm,'') AS CustUserNm,
                UB.EmpNm,
                GA.DeptNm
              
                from TOAActPlan00 MA
                left join TMACust10 MB on MA.CustCd = MB.CustCd  
                left join TMACust00 MC on MC.CustCd = MA.CustCd
                left join TMAEmpy00 UA on MB.EmpId = UA.EmpID --客户负责人
                left join TMAEmpy00 UB on MA.EmpID = UB.EmpID --职员名称
                left join  TMADept00 GA on MA.DeptCd = GA.DeptCd --职员部门
                left join TSMSyco10 LA  on MA.ActGubun = LA.MinorCd
                left join TSMDict10 LB on MA.ActGubun = LB.DictCd and LB.LangCd = '$langCode'
                left join TSMSyco10 LC  on MA.RelationClass = LC.MinorCd
                left join TSMDict10 LD on MA.RelationClass = LD.DictCd and LD.LangCd = '$langCode'
                where MA.ActPlanNo = '$actPlanNo'
                AND getdate() between MB.STDate and MB.EDDate
                AND MB.ChargeType='N' $this->auth";
        $this->created($sql);
        return $this->jlamp_query();
    }
    public function reptMinute($actReptNo,$langCode,$check){
        $check == 'plan' ? $where = "MA.ActPlanNo = '$actReptNo'" : $where = "MA.ActReptNo = '$actReptNo'";
        $this->haswhere = true;
        $sql = "select 
                MA.ActReptNo,
                MA.ActReptDate,	
                MA.ActPlanNo,
                MA.CustCd,
                MA.EmpID,
                MA.DeptCd,
                MA.ActGubun, 		--工作活动区分
                MA.RelationClass, --工作活动相关范畴
                MA.CustPattern,   --客户状态
                ISNULL(LB.TransNm,LA.MinorNm) AS ActGubunNm,
                ISNULL(LD.TransNm,LC.MinorNm) AS RelationClassNm,
                ISNULL(LF.TransNm,LE.MinorNm) AS CustPatternNm,
                MA.ReptTitle,     --工作活动标题
                MA.MeetingPlace,  --会议地点
                MA.AttendPerson,  --参加人员
                MA.MeetingSubject, --会议主题
                MA.CustRequstTxt,  --客户要求事项
                MA.SubjectDisTxt,  --协商事项
                MA.ReqConductDate,    --客户要求日
                MA.Remark,				--备注
                MA.MeetingSTDate,    --会议开始时间
                MA.MeetingEDDate,    --会议结束时间
                MA.CfmYn,				
                ISNULL(MC.CustNm,'') AS CustNm,
                UB.EmpNm,
                GA.DeptNm
                from TOAActRept00 MA
                left join TMACust10 MB on MA.CustCd = MB.CustCd  
                left join TMACust00 MC on MC.CustCd = MA.CustCd
                left join TMAEmpy00 UB on MA.EmpID = UB.EmpID --职员名称
                left join TMADept00 GA on MA.DeptCd = GA.DeptCd --职员部门
                left join TSMSyco10 LA  on MA.ActGubun = LA.MinorCd
                left join TSMDict10 LB on MA.ActGubun = LB.DictCd and LB.LangCd = '$langCode'
                left join TSMSyco10 LC  on MA.RelationClass = LC.MinorCd
                left join TSMDict10 LD on MA.RelationClass = LD.DictCd and LD.LangCd = '$langCode'
                left join TSMSyco10 LE  on MA.CustPattern = LE.MinorCd
                left join TSMDict10 LF on MA.CustPattern = LF.DictCd and LF.LangCd = '$langCode'
                where $where
                AND getdate() between MB.STDate and MB.EDDate
                AND MB.ChargeType='N' $this->auth";
        $this->created($sql);
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
            case AUTH_A:   //全部
                $this->auth = '';
                break;
            case AUTH_E:   //个人
                $this->auth = " AND MA.EmpId = '$empId'";
                break;
            case AUTH_D:   //部门
                $this->auth = " AND GA.DeptCd = '$DeptCd'";
                break;
            case AUTH_M:   //管理
                $this->auth =  "AND GA.DeptCd in (select DeptCd from dbo.fnMDeptCd('y','$empId') )";
                break;
            default:  //默认为个人
                $this->auth = " AND GA.DeptCd = '$DeptCd'";
                break;
        }
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
        $sql = "select top 50 a.EmpID,a.EmpNm,b.DeptCd,b.DeptNm from TMAEmpy00 a,TMADept00 b 
               where a.DeptCd = b.DeptCd AND a.RetireYn = 'N'";
        $type = array(
            'a.EmpNm|LIKE|utf-8',
            'a.EmpID',
            'b.DeptNm|LIKE|utf-8'
        );
        $this->created($sql,$type);
        return $this->jlamp_query();
    }

    public function userlistMore($count){
        $this->haswhere = true; //存在默认where条件
        $sql = "select top 50 * from 
              (select Row_Number()over(order by a.EmpID asc)AS id,a.EmpID,a.EmpNm,b.DeptCd,b.DeptNm from TMAEmpy00 a,TMADept00 b 
               where a.DeptCd = b.DeptCd AND a.RetireYn = 'N'";
        $type = array(
            'a.EmpNm|LIKE|utf-8',
            'a.EmpID',
            'b.DeptNm|LIKE|utf-8'
        );
        $this->append(")T where id > $count order by id asc");
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

    public function getCust($langCode){
        $this->haswhere = true;
        $sql = "SELECT top 50 a.CustCd,a.CustNm,a.KoOrFo,isnull(b.TransNm,c.MinorNm) as status,a.Status as StatusId
                FROM TMACust00 a
                LEFT JOIN TSMDict10 b ON a.Status = b.DictCd AND b.LangCd = '$langCode'
                LEFT JOIN TSMSyco10 c on a.Status = c.MinorCd
                left join TMACust10 AA on AA.CustCd = a.CustCd
                left join TMAEmpy00 MA on AA.EmpId = MA.EmpID
                left join TMADept00 GA on MA.DeptCd = GA.DeptCd
                where AA.ChargeType='N' AND  getdate() between  AA.STDate and AA.EDDate $this->auth";
        $type = array(
            'a.CustCd|LIKE',
            'a.CustNm|LIKE|utf-8'
        );
        $this->append(" order by a.CustCd asc");
        $this->created($sql,$type);
        return $this->jlamp_query();
    }
    public function getCustMore($count,$langCode){
        $this->haswhere = true;
        $sql="select top 50 * from (
              SELECT Row_Number()over(order by a.CustCd asc)AS id,
              a.CustCd,a.CustNm,a.KoOrFo,isnull(b.TransNm,c.MinorNm) as status,
              a.Status as StatusId
              FROM TMACust00 a
              LEFT JOIN TSMDict10 b ON a.Status = b.DictCd AND b.LangCd = '$langCode'
              LEFT JOIN TSMSyco10 c on a.Status = c.MinorCd
              left join TMACust10 AA on AA.CustCd = a.CustCd
              left join TMAEmpy00 MA on AA.EmpId = MA.EmpID
              left join TMADept00 GA on MA.DeptCd = GA.DeptCd
              where AA.ChargeType='N' AND  getdate() between  AA.STDate and AA.EDDate $this->auth
              ";
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
                MA.EmpId AS list,
                MA.CustCd,
                MB.ExpClss,
                MA.STDate,
                MB.SystemType AS systype,
                MB.DrawNo,
                MB.DrawAmd,
                MB.RefNo AS model_id,
                MB.GoodNm AS cust_produce_name,
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
                MB.GateType,      ISNULL(GateTypeA.TransNm,GateTypeB.MinorNm)         AS GateTypeNm
                
                from TMACust10 MA -- 客户表
                right join TSAOrder00 MB on MA.CustCd = MB.CustCd and MB.CfmYn='1' -- 订单信息
                left join TMACust00 MC on MA.CustCd = MC.CustCd  -- 客户名称
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
                where MB.OrderNo = '$orderid'";
        $this->created($sql);
        return $this->jlamp_query();

    }

    public function orderlist($langCode='SM00010003'){
        $this->haswhere = true;//存在默认where条件
        $nowtime = date('Y-m-d',intval(time()));
        $sql = "select top 50 Row_Number()over(order by MB.OrderNo desc)AS id,
                MA.CustCd,
                MB.ExpClss,
                MA.STDate,
                MB.GoodNm AS cust_produce_name,
                MB.OrderNo,MB.OrderDate,MB.DelvDate,MC.CustNm AS custname,
                MB.MarketCd,
                LA.EmpID,LA.EmpNm,LB.DeptCd,LB.DeptNm 
                from TMACust10 MA -- 客户表
                right join TSAOrder00 MB on MA.CustCd = MB.CustCd and MB.CfmYn='1' -- 订单信息
                left join TMACust00 MC on MA.CustCd = MC.CustCd  -- 客户名称
                left join TMAEmpy00 LA on MB.EmpId = LA.EmpID   -- 员工信息
                left join TMADept00 LB on MB.DeptCd = LB.DeptCd -- 部门信息
                where MA.ChargeType='N' $this->auth AND convert(char(10) ,MA.STDate, 120) <= '$nowtime' AND convert(char(10) ,MA.EDDate, 120) >= '$nowtime'";
        $type = array(
            'MC.CustNm|LIKE|utf-8',
            'MB.OrderNo'
        );
        $this->append(' order by MB.OrderNo desc');
        $this->created($sql,$type);
        return $this->jlamp_query();
    }

    public function orderlist_more($langCode='SM00010003',$get_ordercount = 0){
        $this->haswhere = true;//存在默认where条件
        $nowtime = date('Y-m-d',intval(time()));
        $sql = "select top 50 * from 
                (select Row_Number()over(order by MB.OrderNo desc)AS id,
                MA.CustCd,
                MB.ExpClss,
                MA.STDate,
                MB.GoodNm AS cust_produce_name,
                MB.OrderNo,MB.OrderDate,MB.DelvDate,MC.CustNm AS custname,
                MB.MarketCd,
                LA.EmpID,LA.EmpNm,LB.DeptCd,LB.DeptNm 
                from TMACust10 MA -- 客户表
                right join TSAOrder00 MB on MA.CustCd = MB.CustCd and MB.CfmYn='1' -- 订单信息
                left join TMACust00 MC on MA.CustCd = MC.CustCd  -- 客户名称
                left join TMAEmpy00 LA on MB.EmpId = LA.EmpID   -- 员工信息
                left join TMADept00 LB on MB.DeptCd = LB.DeptCd -- 部门信息
                where MA.ChargeType='N' $this->auth AND convert(char(10) ,MA.STDate, 120) <= '$nowtime' AND convert(char(10) ,MA.EDDate, 120) >= '$nowtime' ";

        $type = array(
            'MC.CustNm|LIKE|utf-8',
            'MB.OrderNo'
        );
        //末尾添加
        $this->append(" )t where id > $get_ordercount order by id asc");
        //拼接
        $this->created($sql,$type);

//        $this->created_append($page_query,$type);

        //执行sql
        return $this->jlamp_query();
    }


    //--链式拼接---------------------------
    public function table($table){
        $this->table = $table;
        return $this;
    }
    public function field($filed){
        $this->field = $filed;
        return $this;
    }
    public function append($sql){
        $this->append = ' '.$sql;
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
//            if(empty($this->field)){
//                self::$error = 1;
//                return 'not found field data';
//            }
            empty($this->field) ? $this->field = '*' : $this->field;
            $sql = "SELECT $this->field FROM $this->table WHERE ";
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
            $this->sqlsen = '';
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

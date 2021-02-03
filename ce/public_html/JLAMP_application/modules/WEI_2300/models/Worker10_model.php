<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Worker10_model extends Multi_dbQuery {
    public function __construct()
    {
        parent::__construct();
    }
    //检查目标重复
    public function repeatTarget($date,$userId,$groupId,$currCd,$expClass){
        $sql = "select top 1 * from TSAPlanYMD10 
            WHERE convert(varchar(10),SAPlanDate,23) = '$date'
            AND EmpID = '$userId'
            AND DeptCd = '$groupId'
            AND CurrCd = '$currCd'
            AND ExpClss = '$expClass'";
        $this->created($sql);
        return $this->jlamp_query();
    }

    //查询销售目标填写信息
    public function getWriteTarget($startTime,$endTime){
        $this->haswhere = true;
        $sql = "select top 50 A.ExpClss,A.CurrCd,A.EmpID,A.DeptCd,B.DeptNm,
                C.EmpNm,A.SAPlanDate,A.CfmYn,
                 cast(isnull(A.OrderAmt,0) as numeric(20,2)) as OrderAmt,
                cast(isnull(A.InvoiceAmt,0) as numeric(20,2)) as InvoiceAmt,
                cast(isnull(A.BillAmt,0) as numeric(20,2)) as BillAmt,
                cast(isnull(A.ReceiptAmt,0) as numeric(20,2)) as ReceiptAmt
                from TSAPlanYMD10 A
                left join TMADept00 B on A.DeptCd = B.DeptCd
                left join TMAEmpy00 C on A.EmpID = C.EmpID
                where A.SAPlanDate BETWEEN '$startTime' AND '$endTime'";
        $type = array(
            'C.EmpNm|LIKE|utf-8',
            'B.DeptNm|LIKE|utf-8'
        );
        $this->append('order by A.SAPlanDate desc');
        $this->created($sql,$type);
        return $this->jlamp_query();
    }
    public function getWriteTargetMore($count,$startTime,$endTime){
        $sql = "select top * 50
               (select Row_Number()over(order by A.EmpID asc)AS id,A.ExpClss,A.CurrCd,A.EmpID,A.DeptCd,B.DeptNm,C.EmpNm,A.SAPlanDate,
                cast(isnull(A.OrderAmt,0) as numeric(20,2)) as OrderAmt,
                cast(isnull(A.InvoiceAmt,0) as numeric(20,2)) as InvoiceAmt,
                cast(isnull(A.BillAmt,0) as numeric(20,2)) as BillAmt,
                cast(isnull(A.ReceiptAmt,0) as numeric(20,2)) as ReceiptAmt
                from TSAPlanYMD10 A
                left join TMADept00 B on A.DeptCd = B.DeptCd
                left join TMAEmpy00 C on A.EmpID = C.EmpID 
                A.SAPlanDate BETWEEN '$startTime' AND '$endTime'";
        $type = array(
            'C.EmpNm|LIKE|utf-8',
            'B.DeptNm|LIKE|utf-8'
        );
        $this->append("order by A.SAPlanDate desc)T where id > $count order by id asc");
        $this->created($sql,$type);
        return $this->jlamp_query();
    }
    //获取部门列表
    public function getDeptId($loginUser,$check){
        if($check== AUTH_D){
            $sql = "select A.DeptCd AS value,B.DeptNm AS text, from dbo.fnMDeptCd('y','%s') A
                    left join TMADept00 B on A.DeptCd = B.DeptCd";
//            $sql = "select A.DeptNm as text,A.DeptCd as value from TMADept00 A
//                left join TMAEmpy00 B ON A.MEmpID = B.EmpID
//                where A.MEmpID = '%s'
//                group by A.DeptCd,A.DeptNm";
            $result = DB::queryRows($sql,array($loginUser));
        }else if($check == AUTH_M){
            $sql = "select A.DeptNm as text,A.DeptCd as value from TMADept00 A
                left join TMAEmpy00 B ON A.MEmpID = B.EmpID
                where A.DeptDiv2 = (select MinorCd from TSMSyco10 where RelCd1 = '%s')
                group by A.DeptCd,A.DeptNm";
            $result = DB::queryRows($sql,array($loginUser));
        }else if($check == AUTH_A ){
            $sql = "select DeptNm as text,DeptCd as value from TMADept00
                    where LEFT(DeptDiv2,6) = 'MA1004' GROUP BY DeptNm,DeptCd";
            $result = DB::queryRows($sql);
        }
        return $result;
    }
    //获取各部门列表
    public function getDeptIdResults($loginUser,$check){
        if($check== AUTH_D){
            $sql = "select A.DeptNm as text,A.MEmpID as value,A.DeptCd from TMADept00 A
                left join TMAEmpy00 B ON A.MEmpID = B.EmpID
                where A.MEmpID = '$loginUser'
                group by A.MEmpID,A.DeptCd,A.DeptNm";
        }else if($check == AUTH_M){
            $sql = "select A.DeptNm as text,A.MEmpID as value,A.DeptCd from TMADept00 A
                left join TMAEmpy00 B ON A.MEmpID = B.EmpID
                where A.DeptDiv2 = (select MinorCd from TSMSyco10 where RelCd1 = '$loginUser')
                group by A.MEmpID,A.DeptCd,A.DeptNm";
        }else if($check == AUTH_A ){
            $sql = "select A.DeptNm as text,A.MEmpID as value,A.DeptCd from TMADept00 A
                left join TMAEmpy00 B ON A.MEmpID = B.EmpID
                where left(A.DeptDiv2,6) = 'MA1004'
                group by A.MEmpID,A.DeptCd,A.DeptNm";
        }
        $this->created($sql);
        return $this->jlamp_query();
    }
    //通过部长ID获取经理管辖的部门列表
    public function getDeptIdByLeader($leaderId){
        $sql = "select A.DeptNm as text,A.MEmpID as value,A.DeptCd from TMADept00 A
                left join TMAEmpy00 B ON A.MEmpID = B.EmpID
                where A.DeptDiv2 = (select MinorCd from TSMSyco10 where RelCd1 = '$leaderId')
                group by A.MEmpID,A.DeptCd,A.DeptNm";
        $this->created($sql);
        return $this->jlamp_query();
    }
    //通过经理ID获取管辖的部门列表
    public function getDeptIdByMempId($sysClass,$mempId){
        $sql = "select A.DeptNm as text,A.MEmpID as value,A.DeptCd from TMADept00 A
                left join TMAEmpy00 B ON A.MEmpID = B.EmpID
                where A.MEmpID = '$mempId'
                and left(A.DeptDiv2,6) = '$sysClass'
                group by A.MEmpID,A.DeptCd,A.DeptNm";
        $this->created($sql);
        return $this->jlamp_query();
    }
    //获取经理列表
    public function getMempId($loginUser,$check){
        if($check == AUTH_M){
            $sql = "select B.EmpNm as text,A.MEmpID as value from TMADept00 A
                    left join TMAEmpy00 B ON A.MEmpID = B.EmpID
                    where A.DeptDiv2 = (select MinorCd from TSMSyco10 where RelCd1 = '$loginUser') 
                    group by B.EmpNm,A.MEmpID";
        }else if($check == AUTH_A ){
            $sql = "select B.EmpNm as text,A.MEmpID as value from TMADept00 A
                    left join TMAEmpy00 B ON A.MEmpID = B.EmpID
                    where left(A.DeptDiv2,6) = 'MA1004' group by B.EmpNm,A.MEmpID";
        }
        $this->created($sql);
        return $this->jlamp_query();
    }
    //通过loginID查询部长代号
    public function getLeaderByEmpId($empId,$langCode='SM00010003'){
        $sql = "select 
                isnull(MULTIB.TransNm,MULTIA.MinorNm) AS text,
                isnull(MULTIB.DictCd,MULTIA.MinorCd) AS value ,
                MULTIA.*
                from TSMSyco10 MULTIA
                full join  TSMDict10 MULTIB on MULTIA.MinorCd = MULTIB.DictCd
                where DeleteYn = 'N' and MULTIB.LangCd = '$langCode'
                and MULTIA.RelCd1 = '$empId'";
        $this->created($sql);
        return $this->jlamp_query();
    }
    //系统小分类
    public function getLeaders($langCode='SM00010003'){
        $this->haswhere = true;
        $sql = "select 
            isnull(MULTIB.TransNm,MULTIA.MinorNm) AS text,
            isnull(MULTIB.DictCd,MULTIA.MinorCd) AS value 
            from TSMSyco10 MULTIA
            full join  TSMDict10 MULTIB on MULTIA.MinorCd = MULTIB.DictCd and MULTIB.LangCd = '$langCode'
             where DeleteYn = 'N' 
             and MULTIA.MinorCd !='MA10040300'
             and MULTIA.MinorCd !='MA10040400'
             and MULTIA.MinorCd !='MA10040600'
             ";
        $type = array(
            'left(MULTIA.MinorCd,6)'
        );
        $this->created($sql,$type);
        return $this->jlamp_query();
    }
    //查询用户
    public function getUsers(){
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

    public function getUsersMore($count){
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

    //通过管理ID查询下属员工
    public function getUsersByAdmin($leader,$userId,$check){
        if($check == AUTH_M){
            $sql = "select C.EmpID from TMADept00 A 
                    left join TSMSyco10 B on A.DeptDiv2 = B.MinorCd
                    left join TMAEmpy00 C on C.DeptCd = A.DeptCd
                    where B.MinorCd = (select MinorCd from TSMSyco10 where RelCd1 = '$leader') And C.EmpID = '$userId' ";
        }else if($check == AUTH_D){
            $sql = "select B.EmpID from TMADept00 A 
                    left join TMAEmpy00 B on B.DeptCd = A.DeptCd
                    where A.MEmpID = '$leader' and B.EmpID = '$userId'";
        }
        $this->created($sql);
        return $this->jlamp_query();
    }
    //查询部门下的员工列表
    public function getUsersByDeptId($deptId,$check){
        $sql = "select  a.EmpID as value,a.EmpNm as text,b.DeptCd from TMAEmpy00 a,TMADept00 b 
               where a.DeptCd = b.DeptCd AND a.RetireYn = 'N' AND b.DeptCd = '$deptId'";
        $this->created($sql);
        return $this->jlamp_query();
    }
    //查询部门下当前登录员工名称
    public function getUsersByUserId($userId){
        $sql = "select  EmpID as value,EmpNm as text from TMAEmpy00 where EmpID = '$userId'";
        $this->created($sql);
        return $this->jlamp_query();
    }
    public function getAdminList($mEmpId=''){
        if(empty($mEmpId)){
            $sql = "select MEmpID,DeptDiv2 from TMADept00 where DeptDiv2 Like 'MA1004%%'  group by MEmpID,DeptDiv2";
        }else{
            $sql = "select MEmpID,DeptDiv2 from TMADept00 where DeptDiv2 = '$mEmpId' group by MEmpID,DeptDiv2";
        }
        $this->created($sql);
        return $this->jlamp_query();
    }
    //查询个人销售目标/业绩
    public function getUserTarget($date,$dateItem,$currCd='RMB',$unit=10000){
        if($dateItem == 'y'){
            $whereDate = "CONVERT(CHAR(4),MB.SAPlanDate,23) = '$date'";
        }else if($dateItem == 'm'){
            $whereDate = "CONVERT(CHAR(7),MB.SAPlanDate,23) = '$date'";
        }else{
            $whereDate = "CONVERT(CHAR(10),MB.SAPlanDate,23) = '$date'";
        }
        $sql = "select MB.DeptCd,MB.EmpId,
                cast(sum(isnull(MB.OrderAmt,0))/$unit as numeric(20,2)) as OrderAmt,
                cast(sum(isnull(MB.OrderForAmt,0))/$unit as numeric(20,2)) as OrderForAmt,
                cast(sum(isnull(MB.InvoiceAmt,0))/$unit as numeric(20,2)) as InvoiceAmt,
                cast(sum(isnull(MB.InvoiceForAmt,0))/$unit as numeric(20,2)) as InvoiceForAmt,
                cast(sum(isnull(MB.BillAmt,0))/$unit as numeric(20,2)) as BillAmt,
                cast(sum(isnull(MB.BillForAmt,0))/$unit as numeric(20,2)) as BillForAmt,
                cast(sum(isnull(MB.ReceiptAmt,0))/$unit as numeric(20,2)) as ReceiptAmt,
                cast(sum(isnull(MB.ReceiptForAmt,0))/$unit as numeric(20,2)) as ReceiptForAmt
                from TMADept00 MA 
                left join TSAPlanYMD10 MB on MA.DeptCd = MB.DeptCd
                where MB.CurrCd = '$currCd' and MB.CfmYn = '1' and $whereDate group by MB.DeptCd,MB.EmpId";
        $this->created($sql);
        return $this->jlamp_query();
    }
    public function getUserTargetByUserId($userId,$currId,$date,$dateItem){
        if($dateItem == 'y'){
            $unit = '10000';
            $whereDate = "CONVERT(CHAR(4),SAPlanDate,23) = '$date'";
        }else if($dateItem == 'm'){
            $unit = '10000';
            $whereDate = "CONVERT(CHAR(7),SAPlanDate,23) = '$date'";
        }else{
            $unit = '10000';
            $whereDate = "CONVERT(CHAR(10),SAPlanDate,23) = '$date'";
        }
        $this->haswhere = true;
        $sql = "select 
                cast(sum(isnull(OrderAmt,0))/$unit as numeric(20,2)) as OrderAmt,
                cast(sum(isnull(OrderForAmt,0))/$unit as numeric(20,2)) as OrderForAmt,
                cast(sum(isnull(InvoiceAmt,0))/$unit as numeric(20,2)) as InvoiceAmt,
                cast(sum(isnull(InvoiceForAmt,0))/$unit as numeric(20,2)) as InvoiceForAmt,
                cast(sum(isnull(BillAmt,0))/$unit as numeric(20,2)) as BillAmt,
                cast(sum(isnull(BillForAmt,0))/$unit as numeric(20,2)) as BillForAmt,
                cast(sum(isnull(ReceiptAmt,0))/$unit as numeric(20,2)) as ReceiptAmt,
                cast(sum(isnull(ReceiptForAmt,0))/$unit as numeric(20,2)) as ReceiptForAmt
                from TSAPlanYMD10
                where EmpID = '$userId' and CfmYn = '1' and CurrCd = '$currId' and $whereDate";
        $this->created($sql);
        return $this->jlamp_query();
    }
    public function getUserTargetByDeptId($deptId,$date,$dateItem,$currCd='RMB',$unit=10000){
        if($dateItem == 'y'){
            $whereDate = "CONVERT(CHAR(4),MB.SAPlanDate,23) = '$date'";
        }else if($dateItem == 'm'){
            $whereDate = "CONVERT(CHAR(7),MB.SAPlanDate,23) = '$date'";
        }else{
            $whereDate = "CONVERT(CHAR(10),MB.SAPlanDate,23) = '$date'";
        }
        $sql = "select 
                cast(sum(isnull(MB.OrderAmt,0))/$unit as numeric(20,2)) as OrderAmt,
                cast(sum(isnull(MB.OrderForAmt,0))/$unit as numeric(20,2)) as OrderForAmt,
                cast(sum(isnull(MB.InvoiceAmt,0))/$unit as numeric(20,2)) as InvoiceAmt,
                cast(sum(isnull(MB.InvoiceForAmt,0))/$unit as numeric(20,2)) as InvoiceForAmt,
                cast(sum(isnull(MB.BillAmt,0))/$unit as numeric(20,2)) as BillAmt,
                cast(sum(isnull(MB.BillForAmt,0))/$unit as numeric(20,2)) as BillForAmt,
                cast(sum(isnull(MB.ReceiptAmt,0))/$unit as numeric(20,2)) as ReceiptAmt,
                cast(sum(isnull(MB.ReceiptForAmt,0))/$unit as numeric(20,2)) as ReceiptForAmt
                from TMADept00 MA 
                left join TSAPlanYMD10 MB on MA.DeptCd = MB.DeptCd
                where MB.DeptCd = '$deptId' and MB.CfmYn = '1' and MB.CurrCd = '$currCd' and $whereDate";
        $this->created($sql);
        return $this->jlamp_query();
    }

    //查询所有销售目标
    public function getTarget($date,$dateItem,$currCd='RMB',$unit=10000){
        if($dateItem == 'd'){
            $_tableNm = 'TSAPlanYMD00';
            $_where = "convert(varchar(10),MB.SAPlanDate,23) = '$date'";
        }else if($dateItem == 'm'){
            $date = substr($date,0,7);
            $_tableNm = 'TSAPlanYMD00';
            $_where = "convert(varchar(7),MB.SAPlanDate,23) = '$date'";
        }else{
            $date = substr($date,0,4);
            $_tableNm = 'TSAPlanYMD00';
            $_where = "convert(varchar(4),MB.SAPlanDate,23) = '$date'";
        }
        $sql = "select MB.DeptCd,MB.CurrCd,
                cast(sum(isnull(MB.OrderAmt,0))/$unit as numeric(20,2)) as OrderAmt,
                cast(sum(isnull(MB.OrderForAmt,0))/$unit as numeric(20,2)) as OrderForAmt,
                cast(sum(isnull(MB.InvoiceAmt,0))/$unit as numeric(20,2)) as InvoiceAmt,
                cast(sum(isnull(MB.InvoiceForAmt,0))/$unit as numeric(20,2)) as InvoiceForAmt,
                cast(sum(isnull(MB.BillAmt,0))/$unit as numeric(20,2)) as BillAmt,
                cast(sum(isnull(MB.BillForAmt,0))/$unit as numeric(20,2)) as BillForAmt,
                cast(sum(isnull(MB.ReceiptAmt,0))/$unit as numeric(20,2)) as ReceiptAmt,
                cast(sum(isnull(MB.ReceiptForAmt,0))/$unit as numeric(20,2)) as ReceiptForAmt
                from TMADept00 MA 
                left join $_tableNm MB on MA.DeptCd = MB.DeptCd
                where $_where and MB.CurrCd = '$currCd' group by MB.DeptCd,MB.CurrCd";
        $this->created($sql);
        return $this->jlamp_query();
    }
    //根据部长ID查询销售目标
    public function getTargetByLeader($date,$dateItem,$leader,$currCd='RMB',$unit=10000){
        if($dateItem == 'd'){
            $_tableNm = 'TSAPlanYMD00';
            $_where = "convert(varchar(10),MB.SAPlanDate,23) = '$date'";
        }else if($dateItem == 'm'){
            $date = substr($date,0,7);
            $_tableNm = 'TSAPlanYMD00';
            $_where = "convert(varchar(7),MB.SAPlanDate,23) = '$date'";
        }else{
            $date = substr($date,0,4);
            $_tableNm = 'TSAPlanYMD00';
            $_where = "convert(varchar(4),MB.SAPlanDate,23) = '$date'";
        }
        $sql = "select MB.DeptCd,MB.CurrCd,
                cast(sum(isnull(MB.OrderAmt,0))/$unit as numeric(20,2)) as OrderAmt,
                cast(sum(isnull(MB.OrderForAmt,0))/$unit as numeric(20,2)) as OrderForAmt,
                cast(sum(isnull(MB.InvoiceAmt,0))/$unit as numeric(20,2)) as InvoiceAmt,
                cast(sum(isnull(MB.InvoiceForAmt,0))/$unit as numeric(20,2)) as InvoiceForAmt,
                cast(sum(isnull(MB.BillAmt,0))/$unit as numeric(20,2)) as BillAmt,
                cast(sum(isnull(MB.BillForAmt,0))/$unit as numeric(20,2)) as BillForAmt,
                cast(sum(isnull(MB.ReceiptAmt,0))/$unit as numeric(20,2)) as ReceiptAmt,
                cast(sum(isnull(MB.ReceiptForAmt,0))/$unit as numeric(20,2)) as ReceiptForAmt
                from TMADept00 MA 
                left join $_tableNm MB on MA.DeptCd = MB.DeptCd
                where $_where and MB.CurrCd = '$currCd' and MA.DeptDiv2 = '$leader' group by MB.DeptCd,MB.CurrCd";
        $this->created($sql);
        return $this->jlamp_query();

    }
    //根据经理ID查询销售目标
    public function getTargetByMempId($date,$dateItem,$MempId,$currCd='RMB',$unit=10000){
        if($dateItem == 'd'){
            $_tableNm = 'TSAPlanYMD00';
            $_where = "convert(varchar(10),MB.SAPlanDate,23) = '$date'";
        }else if($dateItem == 'm'){
            $date = substr($date,0,7);
            $_tableNm = 'TSAPlanYMD00';
            $_where = "convert(varchar(7),MB.SAPlanDate,23) = '$date'";
        }else{
            $date = substr($date,0,4);
            $_tableNm = 'TSAPlanYMD00';
            $_where = "convert(varchar(4),MB.SAPlanDate,23) = '$date'";
        }
        $sql = "select MB.DeptCd,MB.CurrCd,
                cast(sum(isnull(MB.OrderAmt,0))/$unit as numeric(20,2)) as OrderAmt,
                cast(sum(isnull(MB.OrderForAmt,0))/$unit as numeric(20,2)) as OrderForAmt,
                cast(sum(isnull(MB.InvoiceAmt,0))/$unit as numeric(20,2)) as InvoiceAmt,
                cast(sum(isnull(MB.InvoiceForAmt,0))/$unit as numeric(20,2)) as InvoiceForAmt,
                cast(sum(isnull(MB.BillAmt,0))/$unit as numeric(20,2)) as BillAmt,
                cast(sum(isnull(MB.BillForAmt,0))/$unit as numeric(20,2)) as BillForAmt,
                cast(sum(isnull(MB.ReceiptAmt,0))/$unit as numeric(20,2)) as ReceiptAmt,
                cast(sum(isnull(MB.ReceiptForAmt,0))/$unit as numeric(20,2)) as ReceiptForAmt
                from TMADept00 MA 
                left join $_tableNm MB on MA.DeptCd = MB.DeptCd
                where $_where and MB.CurrCd = '$currCd' and MA.MEmpID = '$MempId' group by MB.DeptCd,MB.CurrCd";
        $this->created($sql);
        return $this->jlamp_query();
    }
    //根据部门ID查询销售目标
    public function getTargetByDeptId($date,$dateItem,$DeptId,$currCd='RMB',$unit=10000){
        if($dateItem == 'd'){
            $_tableNm = 'TSAPlanYMD00';
            $_where = "convert(varchar(10),MB.SAPlanDate,23) = '$date'";
        }else if($dateItem == 'm'){
            $date = substr($date,0,7);
            $_tableNm = 'TSAPlanYMD00';
            $_where = "convert(varchar(7),MB.SAPlanDate,23) = '$date'";
        }else{
            $date = substr($date,0,4);
            $_tableNm = 'TSAPlanYMD00';
            $_where = "convert(varchar(4),MB.SAPlanDate,23) = '$date'";
        }
        $sql = "select MB.DeptCd,MB.CurrCd,
                cast(sum(isnull(MB.OrderAmt,0))/$unit as numeric(20,2)) as OrderAmt,
                cast(sum(isnull(MB.OrderForAmt,0))/$unit as numeric(20,2)) as OrderForAmt,
                cast(sum(isnull(MB.InvoiceAmt,0))/$unit as numeric(20,2)) as InvoiceAmt,
                cast(sum(isnull(MB.InvoiceForAmt,0))/$unit as numeric(20,2)) as InvoiceForAmt,
                cast(sum(isnull(MB.BillAmt,0))/$unit as numeric(20,2)) as BillAmt,
                cast(sum(isnull(MB.BillForAmt,0))/$unit as numeric(20,2)) as BillForAmt,
                cast(sum(isnull(MB.ReceiptAmt,0))/$unit as numeric(20,2)) as ReceiptAmt,
                cast(sum(isnull(MB.ReceiptForAmt,0))/$unit as numeric(20,2)) as ReceiptForAmt
                from TMADept00 MA 
                left join $_tableNm MB on MA.DeptCd = MB.DeptCd
                where $_where and MB.CurrCd = '$currCd' and MA.DeptCd = '$DeptId' group by MB.DeptCd,MB.CurrCd";
        $this->created($sql);
        return $this->jlamp_query();
    }

    //查询所有销售计划
    public function getSalesPlan($date,$dateItem,$currCd='RMB',$unit=10000){
        if($dateItem == 'm'){
            $date = substr($date,0,4).substr($date,5,2);
            $_where = "MB.SAPlanYM = '$date'";
        }else {
            $date = substr($date,0,4);
            $_where = 'LEFT(MB.SAPlanYM,4) = '."'$date'";
        }
        $sql = "select MB.DeptCd,MB.CurrCd,
                cast(sum(isnull(MB.OrderAmt,0))/$unit as numeric(20,2)) as OrderAmt,
                cast(sum(isnull(MB.OrderForAmt,0))/$unit as numeric(20,2)) as OrderForAmt,
                cast(sum(isnull(MB.InvoiceAmt,0))/$unit as numeric(20,2)) as InvoiceAmt,
                cast(sum(isnull(MB.InvoiceForAmt,0))/$unit as numeric(20,2)) as InvoiceForAmt,
                cast(sum(isnull(MB.BillAmt,0))/$unit as numeric(20,2)) as BillAmt,
                cast(sum(isnull(MB.BillForAmt,0))/$unit as numeric(20,2)) as BillForAmt,
                cast(sum(isnull(MB.ReceiptAmt,0))/$unit as numeric(20,2)) as ReceiptAmt,
                cast(sum(isnull(MB.ReceiptForAmt,0))/$unit as numeric(20,2)) as ReceiptForAmt
                from TMADept00 MA 
                left join TSAPlanYMM00 MB on MA.DeptCd = MB.DeptCd
                where $_where and MB.CurrCd = '$currCd' group by MB.DeptCd,MB.CurrCd";
        $this->created($sql);
        return $this->jlamp_query();
    }
    //根据部长ID查询销售计划
    public function getSalesPlanByLeader($date,$dateItem,$leader,$currCd='RMB',$unit=10000){
        if($dateItem == 'm'){
            $date = substr($date,0,4).substr($date,5,2);
            $_where = "MB.SAPlanYM = '$date'";
        }else {
            $date = substr($date,0,4);
            $_where = 'LEFT(MB.SAPlanYM,4) = '."'$date'";
        }
        $sql = "select MB.DeptCd,MB.CurrCd,
                cast(sum(isnull(MB.OrderAmt,0))/$unit as numeric(20,2)) as OrderAmt,
                cast(sum(isnull(MB.OrderForAmt,0))/$unit as numeric(20,2)) as OrderForAmt,
                cast(sum(isnull(MB.InvoiceAmt,0))/$unit as numeric(20,2)) as InvoiceAmt,
                cast(sum(isnull(MB.InvoiceForAmt,0))/$unit as numeric(20,2)) as InvoiceForAmt,
                cast(sum(isnull(MB.BillAmt,0))/$unit as numeric(20,2)) as BillAmt,
                cast(sum(isnull(MB.BillForAmt,0))/$unit as numeric(20,2)) as BillForAmt,
                cast(sum(isnull(MB.ReceiptAmt,0))/$unit as numeric(20,2)) as ReceiptAmt,
                cast(sum(isnull(MB.ReceiptForAmt,0))/$unit as numeric(20,2)) as ReceiptForAmt
                from TMADept00 MA 
                left join TSAPlanYMM00 MB on MA.DeptCd = MB.DeptCd
                where $_where and MB.CurrCd = '$currCd' and MA.DeptDiv2 = '$leader' group by MB.DeptCd,MB.CurrCd";
        $this->created($sql);
        return $this->jlamp_query();

    }
    //根据经理ID查询销售计划
    public function getSalesPlanByMempId($date,$dateItem,$MempId,$currCd='RMB',$unit=10000){
        if($dateItem == 'm'){
            $date = substr($date,0,4).substr($date,5,2);
            $_where = "MB.SAPlanYM = '$date'";
        }else {
            $date = substr($date,0,4);
            $_where = 'LEFT(MB.SAPlanYM,4) = '."'$date'";
        }
        $sql = "select MB.DeptCd,MB.CurrCd,
                cast(sum(isnull(MB.OrderAmt,0))/$unit as numeric(20,2)) as OrderAmt,
                cast(sum(isnull(MB.OrderForAmt,0))/$unit as numeric(20,2)) as OrderForAmt,
                cast(sum(isnull(MB.InvoiceAmt,0))/$unit as numeric(20,2)) as InvoiceAmt,
                cast(sum(isnull(MB.InvoiceForAmt,0))/$unit as numeric(20,2)) as InvoiceForAmt,
                cast(sum(isnull(MB.BillAmt,0))/$unit as numeric(20,2)) as BillAmt,
                cast(sum(isnull(MB.BillForAmt,0))/$unit as numeric(20,2)) as BillForAmt,
                cast(sum(isnull(MB.ReceiptAmt,0))/$unit as numeric(20,2)) as ReceiptAmt,
                cast(sum(isnull(MB.ReceiptForAmt,0))/$unit as numeric(20,2)) as ReceiptForAmt
                from TMADept00 MA 
                left join TSAPlanYMM00 MB on MA.DeptCd = MB.DeptCd
                where $_where and MB.CurrCd = '$currCd' and MA.MEmpID = '$MempId' group by MB.DeptCd,MB.CurrCd";
        $this->created($sql);
        return $this->jlamp_query();
    }
    //根据部门ID查询销售计划
    public function getSalesPlanByDeptId($date,$dateItem,$DeptId,$currCd='RMB',$unit=10000){
        if($dateItem == 'm'){
            $date = substr($date,0,4).substr($date,5,2);
            $_where = "MB.SAPlanYM = '$date'";
        }else {
            $date = substr($date,0,4);
            $_where = 'LEFT(MB.SAPlanYM,4) = '."'$date'";
        }
        $sql = "select MB.DeptCd,MB.CurrCd,
                cast(sum(isnull(MB.OrderAmt,0))/$unit as numeric(20,2)) as OrderAmt,
                cast(sum(isnull(MB.OrderForAmt,0))/$unit as numeric(20,2)) as OrderForAmt,
                cast(sum(isnull(MB.InvoiceAmt,0))/$unit as numeric(20,2)) as InvoiceAmt,
                cast(sum(isnull(MB.InvoiceForAmt,0))/$unit as numeric(20,2)) as InvoiceForAmt,
                cast(sum(isnull(MB.BillAmt,0))/$unit as numeric(20,2)) as BillAmt,
                cast(sum(isnull(MB.BillForAmt,0))/$unit as numeric(20,2)) as BillForAmt,
                cast(sum(isnull(MB.ReceiptAmt,0))/$unit as numeric(20,2)) as ReceiptAmt,
                cast(sum(isnull(MB.ReceiptForAmt,0))/$unit as numeric(20,2)) as ReceiptForAmt
                from TMADept00 MA 
                left join TSAPlanYMM00 MB on MA.DeptCd = MB.DeptCd
                where $_where and MB.CurrCd = '$currCd' and MA.DeptCd = '$DeptId' group by MB.DeptCd,MB.CurrCd";
        $this->created($sql);
        return $this->jlamp_query();
    }
}

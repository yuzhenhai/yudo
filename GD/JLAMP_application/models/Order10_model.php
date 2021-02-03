<?php
class Order10_model extends Multi_dbQuery{

    public $auth;

    public function __construct()
    {
        parent::__construct();
    }

    //.获取AS订单信息
    public function getAsOrderInfo($asRecvNo,$cfmYn='',$langCode){

        $result = DB::queryRow("select 
                MA.CustCd,
                MA.ExpClss,
                MA.GoodNm AS cust_produce_name,
                MA.OrderNo,
                MA.OrderDate,
                MA.DelvDate,
                MC.CustNm AS custname,
                MA.MarketCd,
                MA.Status,
                MA.OrderType,
                LB.TransNm AS StatusNm,
                ISNULL(MA.DrawNo,'') AS DrawNo,
                ISNULL(MA.DrawAmd,'') AS DrawAmd,
                MA.RefNo,
                UA.EmpID,UA.EmpNm,UB.DeptCd,UB.DeptNm 
                from TSAOrder00 MA -- 订单信息
                left join TMACust00 MC on MA.CustCd = MC.CustCd  -- 客户名称
                left join TMAEmpy00 UA on MA.EmpId = UA.EmpID   -- 员工信息
                left join TMADept00 UB on MA.DeptCd = UB.DeptCd -- 部门信息
                left join TSMSyco10 LA on LA.RelCd1 = MA.Status and LA.MinorCd like 'SA3004%%'
                left join TSMDict10 LB on LB.DictCd = LA.MinorCd and LB.LangCd = '$langCode'
                where MA.ASRecvNo = '%s' AND MA.CfmYn like '%s%%'",[$asRecvNo,$cfmYn]);
        return $result;
    }


}
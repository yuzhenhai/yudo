<?php
class Item10_model extends Multi_dbQuery
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 获取品目列表
     * @param $itemNo
     * @param $itemNm
     * @param $count
     * @return array
     */
    public function getItemList($itemNo,$itemNm,$count){
        $result = DB::queryRows("select TOP 50 * from (
                        select
                        Row_Number()over(order by MA.ItemCd) as id,
                        MA.ItemCd,
                        MA.ItemNo,
                        MA.ItemNm,
                        MA.Spec,
                        MB.UnitNm,
                        MB.UnitCd,
                        MA.Status,
                        MC.PreStockQty,
                        MA.VatYn
                        from TMAItem00 MA
                        left join TMAUnit00 MB on MA.StkUnitCd = MB.UnitCd
                        left join TMEWHItem00 MC on MA.ItemCd = MC.ItemCd
                        where MA.ItemNo like '%s%%'
                        and MA.ItemNm like N'%%%s%%'
                        ) t where id > %s order by id asc",[$itemNo,$itemNm,$count]);
        return $result;
    }

    public function getItemListByAs($asNo){
        $result =DB::queryRows("select
                        A.Remark,
                        A.Sort,
                        A.Qty,
                        A.NextQty,
                        A.StopQty,
                        0 as StdPrice,
                        0 as DCRate,
                        0 as DCPrice,
                        0 as DCAmt,
                        0 as DCVat,
                        '' as Nation,
                        'N' as VatYn,
                        MA.ItemCd,
                        MA.ItemNo,
                        MA.ItemNm,
                        MA.Spec,
                        MB.UnitNm,
                        MB.UnitCd,
                        MA.Status,
                        MC.PreStockQty
                        from TASRecv10 A 
                        left join TMAItem00 MA on MA.ItemCd = A.ItemCd
                        left join TMAUnit00 MB on MA.StkUnitCd = MB.UnitCd
                        left join TMEWHItem00 MC on MA.ItemCd = MC.ItemCd
                        where ASRecvNo = '%s'
                       ",[$asNo]);
        return $result;
    }

    /**
     * 获取单位列表
     * @return array
     */
    public function getUnitList(){
        $result = DB::queryRows("select UnitNm AS text,UnitCd AS value from TMAUnit00");
        return $result;
    }


    /**
     * 获取品目的销售标准单价
     * @param $itemCd
     * @param $custCd
     * @param $date
     * @param $curr
     * @return array
     */
    public function getItemPirc($itemCd,$custCd,$date,$curr){
        $timeStamp = str_replace('-','',$date);
        $result = DB::queryRow("SELECT ISNULL(MAX(StdPrice), 0) as StdPrice
                                FROM TSAPric00 With(Nolock) 
                                WHERE ItemCd = N'%s' 
                                AND StDate <= CONVERT(DATETIME, N'%s') 
                                AND EdDate >= CONVERT(DATETIME, N'%s')
                                AND CurrCd = N'%s'
                               ",[$itemCd,$timeStamp,$timeStamp,$curr]);
                                //IF EXISTS(SELECT * FROM TMACust00 WHERE custCd = N'%s' AND SaleCustPriceYn = 'Y') BEGIN
                                //                                SELECT ISNULL(MAX(StdPrice), 0) as StdPrice
                                //                                FROM TSACustPric00 With(Nolock)
                                //                                WHERE CustCd = N'%s'
                                //                                AND ItemCd = N'%s'
                                //                                AND StDate <= CONVERT(DATETIME, N'%s')
                                //                                AND EdDate >= CONVERT(DATETIME, N'%s')
                                //                                AND CurrCd = N'%s'
                                //                                END
                                //                                ELSE
                                //                                BEGIN
                                //$custCd,$custCd,$itemCd,$timeStamp,$timeStamp,$curr,
        return $result;
    }
}

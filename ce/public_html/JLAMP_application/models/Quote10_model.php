<?php
class Quote10_model extends Multi_dbQuery {
    //.获取报价单单列表
    public function getQuoteList($quoteNo,$custNm,$startDate,$endDate,$count){
        $result = DB::queryRows("
                        select top 50 * from 
                        (SELECT Row_Number()over(order by TSAQuot00.QuotNo desc)AS id,
                        TSAQuot00.ExpClss,   
						TSAQuot00.QuotNo,   
						TSAQuot00.QuotDate,   
						TSAQuot00.DeptCd,  
						TMADept00.DeptNm, 
						TSAQuot00.EmpId, 
						TMAEmpy00.EmpNm,  
						TSAQuot00.QuotType,   
						TSAQuot00.CustCd,  
						TMACust00.CustNo, 
						TMACust00.CustNm,  
						TSAQuot00.CustomerCd,    			  
						TSAQuot00.MakerCd,  
						--TMAMaker.CustNo as MakerNo, 
						--TMAMaker.CustNm as MakerNm, 
						TSAQuot00.CustPrsn,   
						TSAQuot00.DelvDate,   
						TSAQuot00.Status,   
						TSAQuot00.GoodNm,   
						TSAQuot00.Payment,   
						TSAQuot00.CurrCd,   
						TSAQuot00.CurrRate,   
						--TSAQuot00.StdSaleAmt,   
						--TSAQuot00.StdSaleVat,   
						TSAQuot00.QuotForAmt,   
						TSAQuot00.QuotForVat,   
						TSAQuot00.QuotAmt,   
						TSAQuot00.QuotVat,
   						TSAQuot00.ProposeAmt,
						TSAQuot00.RefNo,   
						TSAQuot00.GoodClass,   
						TSAQuot00.CfmYn,    
						TSAQuot00.QuotAmd,
						TSAQuot00.QuotDrawNo,
						TSAQuot00.GoodSpec,
						TSAQuot00.CustPrsnHP,
						TSAQuot00.SaleVatRate
			            FROM 	    TSAQuot00
						Left Outer Join TMADept00 With(Nolock) On TSAQuot00.DeptCd = TMADept00.DeptCd
						Left Outer Join TMAEmpy00 With(Nolock) On TSAQuot00.EmpID = TMAEmpy00.EmpID
						Left Outer Join TMACust00 With(Nolock) On TSAQuot00.CustCd = TMACust00.CustCd
						--Left Outer Join TMACust00 as TMAMaker With(Nolock) On TMAMaker.CustCd = TSAQuot00.MakerCd
						Left Outer Join TSMSyco10 With(Nolock) On TMACust00.Status = TSMSyco10.MinorCd
						
                        WHERE TSAQuot00.ExpClss	= '1'
                          AND TSAQuot00.QuotNo	LIKE '%s%%'
                          AND TMACust00.CustNm  LIKE N'%s%%'
                          AND TSAQuot00.QuotDate >= '%s'
                          AND TSAQuot00.QuotDate <= '%s')T where id > %s order by id asc",[$quoteNo,$custNm,$startDate,$endDate,$count]);
        return $result;
//        -- AND TSAQuot00.DeptCd like @p_DeptCd + '%'
//        -- AND TSAQuot00.EmpId like @p_EmpId + '%'
//        -- AND TSAQuot00.QuotType like @p_QuotType + '%'
//        -- AND TSAQuot00.CustCd like @p_CustCd + '%'
//        -- AND TSAQuot00.Status like @p_status + '%'
//        -- AND TSAQuot00.CfmYn '%s'
//        -- And TSAQuot00.JobNo Like @p_jobno + '%'
//        -- And TSAQuot00.DeptCd in (select DeptCd from dbo.fnMDeptCd(@p_mdeptyn, @p_mEmpId) )
    }

    public function getQuoteInfo($quoteNo){
        $result = DB::queryRow("SELECT TSAQuot00.ExpClss,   
						TSAQuot00.QuotNo,   
						TSAQuot00.QuotDate,   
						TSAQuot00.DeptCd,  
						TMADept00.DeptNm, 
						TSAQuot00.JobNo,   
						TMAJobc00.JobNm,
						TSAQuot00.EmpId, 
						TMAEmpy00.EmpNm,  
						TSAQuot00.QuotType,   
						TSAQuot00.CustCd,  
						TMACust00.CustNo, 
						TMACust00.CustNm,  
						TSAQuot00.CustomerCd,    
						TMACustomer.CustNo as CustomerNo, 
						TMACustomer.CustNm as CustomerNm,
						TSAQuot00.AgentCd,   
						TMAAgent.CustNo as AgentNo,
						TMAAgent.CustNm as AgentNm, 
						TSAQuot00.ShipToCd,  
						TMAShipTo.CustNo as ShipToNo, 
						TMAShipTo.CustNm as ShipToNm, 
						TSAQuot00.MakerCd,  
						TMAMaker.CustNo as MakerNo, 
						TMAMaker.CustNm as MakerNm, 
						TSAQuot00.CustPrsn,   
						TSAQuot00.CustTel,   
						TSAQuot00.CustFax,
						TSAQuot00.CustEmail,
						TSAQuot00.CustRemark,   
						TSAQuot00.ValidDate,   
						TSAQuot00.DelvDate,   
						TSAQuot00.Status,   
						TSAQuot00.GoodNm,   
						TSAQuot00.Payment,   
						TSAQuot00.CurrCd,   
						TSAQuot00.CurrRate,   
						TSAQuot00.StdSaleAmt,   
						TSAQuot00.StdSaleVat,   
						TSAQuot00.QuotForAmt,   
						TSAQuot00.QuotForVat,   
						TSAQuot00.QuotAmt,   
						TSAQuot00.QuotVat,
   						TSAQuot00.ProposeAmt,
						round(TSAQuot00.DisCountRate * 100,2) as DisCountRate,
						TSAQuot00.VatYn,   
						TSAQuot00.PrnAmtYn,  
						TSAQuot00.RefNo,
						TSAQuot00.Resin,
						TSAQuot00.Remark,   
						TSAQuot00.MiOrderRemark,   
						TSAQuot00.ASYn,   
						TSAQuot00.ASRecvNo,   
						TSAQuot00.GoodClass,   
						TSAQuot00.OverseaYn,
						TSAQuot00.CfmYn,   
						TSAQuot00.CfmEmpId,   
						TMACfmEmpy.EmpNm as CfmEmpNm,
						TSAQuot00.CfmDate,   
						TSAQuot00.RegEmpID,   
						TMARegEmpy.EmpNm as RegEmpNm,
						TSAQuot00.RegDate,   
						TSAQuot00.UptEmpID,   
						TSAQuot00.UptDate,
						TMACurr00.BasicAmt As BasicAmt,
						TSAQuot00.QuotAmd,
						IsNull(TSMSyco10.RelCd2,'N') As QuotNotYn,
						TSAQuot00.PrintGubun,
						TSAQuot00.MarketCd,
						TSAQuot00.PProductCd,
						TSAQuot00.PPartCd,
						TSAQuot00.PartDesc,
						TSAQuot00.SrvArea,
						TSAQuot00.DelvLimit,
						TSAQuot00.DelvMethod,
						TSAQuot00.QuotDrawNo,
						TSAQuot00.GoodSpec,
						TSAQuot00.Nation,
						IsNull(E.EmpNm,'') As Manager,
						TSAQuot00.CustPrsnHP,
						TSAQuot00.SaleVatRate
			            FROM 	    TSAQuot00
						Left Outer Join TMADept00 With(Nolock) On TSAQuot00.DeptCd = TMADept00.DeptCd
						Left Outer Join TMAEmpy00 With(Nolock) On TSAQuot00.EmpID = TMAEmpy00.EmpID
						Left Outer Join TMACust00 With(Nolock) On TSAQuot00.CustCd = TMACust00.CustCd
						Left Outer Join TMACust00 as TMACustomer With(Nolock) On TMACustomer.CustCd = TSAQuot00.CustomerCd
						Left Outer Join TMACust00 as TMAAgent With(Nolock) On TMAAgent.CustCd = TSAQuot00.AgentCd
						Left Outer Join TMACust00 as TMAShipTo With(Nolock) On TMAShipTo.CustCd = TSAQuot00.ShipToCd
						Left Outer Join TMACust00 as TMAMaker With(Nolock) On TMAMaker.CustCd = TSAQuot00.MakerCd
						Left Outer Join TMAEmpy00 as TMACfmEmpy With(Nolock) On TMACfmEmpy.EmpID = TSAQuot00.CfmEmpID
						Left Outer Join TMAEmpy00 as TMARegEmpy With(Nolock) On TMARegEmpy.EmpID = TSAQuot00.RegEmpID
						Left Outer Join TMAJobc00 With(Nolock) On TMAJobc00.JobNo = TSAQuot00.JobNo 
						Left Outer Join TMACurr00 With(Nolock) On TSAQuot00.CurrCd = TMACurr00.CurrCd
						Left Outer Join TSMSyco10 With(Nolock) On TMACust00.Status = TSMSyco10.MinorCd
						Left Outer Join TSMSyco10 As S With(Nolock) On TSAQuot00.MarketCd = S.MinorCd
						Left Outer Join TMAEmpy00 As E With(Nolock) On S.RelCd1 = E.EmpID 
                        WHERE TSAQuot00.ExpClss	= '1'
                        AND TSAQuot00.QuotNo = '%s'
                        Order By TSAQuot00.QuotDate,TSAQuot00.QuotNo",[$quoteNo]);
        return $result;
    }

    public function getQuoteItemList($quoteNo){
        $result = DB::queryRows("SELECT TSAQuot10.ExpClss,   
					TSAQuot10.QuotNo,   
					TSAQuot10.QuotSerl,   
					TSAQuot10.Sort,   
					TSAQuot10.ItemCd,  
					TMAItem00.ItemNo,
					TMAItem00.ItemNm,
					TMAItem00.Spec,
					TMAItem00.Status,
					TMAItem00.ASChargeYn,
					TSAQuot10.CustItemNm,
					TSAQuot10.UnitCd,   
					TSAQuot10.Qty,   
					TSAQuot10.StdPrice,   
					TSAQuot10.StdAmt,
   					TSAQuot10.StdVat,
					--TSAQuot10.DCRate, 
					round(dcRate * 100,2) as DCRate,  
					TSAQuot10.DCPrice,   
					TSAQuot10.DCAmt,   
					TSAQuot10.DCVat,   
					TSAQuot10.StdCost,   
					TSAQuot10.TotCost,   
					TSAQuot10.DCForPrice,   
					TSAQuot10.DCForAmt,   
					TSAQuot10.DCForVat,   
					TSAQuot10.StopYn,   
					TSAQuot10.NextQty,   
					TSAQuot10.StopQty,
					TSAQuot10.ProgClss,
					TMAItem00.VatYn, 
					TSAQuot10.Nation,  
					TSAQuot10.Remark ,
					TSAQuot00.CfmYn,
					IsNull(WH.PreStockQty, 0) As PreStockQty,
					'' as AsChargeYn  
			        FROM 	TSAQuot10 
			        Left Outer Join TSAQuot00 On TSAQuot00.QuotNo = TSAQuot10.QuotNo AND TSAQuot00.ExpClss = TSAQuot10.ExpClss
                    Left Outer Join TMAItem00 On TSAQuot10.ItemCd = TMAItem00.ItemCd
                    Left Outer Join (SELECT ItemCd, Sum(PreStockQty) As PreStockQty FROM TMEWHItem00 With (Nolock)
                                      WHERE Status = '0' And StkStatus = '0'
                                      GROUP BY ItemCd) As WH On TSAQuot10.ItemCd = WH.ItemCd
			        WHERE TSAQuot10.ExpClss = '1'
			        And TSAQuot10.QuotNo = '%s' order by TSAQuot10.Sort asc",[$quoteNo]);
        return $result;
    }

    public function importAs($asNo,$custCd,$starDate,$endDate){
        $result = DB::queryRows("Select A.ASRecvNo as ASRecvNo,
				   A.ASRecvDate as ASRecvDate,
				   A.CfmYn,
				   A.OrderNo,
				   A.OrderCnt,
				   A.Status,
				   A.ASDelvDate,
				   CASE WHEN MC.Reqno IS NULL THEN 0
                WHEN MC.AptYn = '0' THEN 1 
                WHEN MC.AptYn = '1' And A.ProductYn = 'N' THEN 2  
                WHEN A.ProductYn = 'Y' THEN 3
                END AS ProductStatus,
				   IsNull ( A.CustCd , '' ) as CustCd, 
				   IsNull ( B.CustNo , '' ) as CustNo, 
				   IsNull ( B.CustNm , '' ) as CustNm, 
               IsNull(B.Status,'') As CustStatus,
				   A.ASDelvDate as DelvDate, 
				   IsNull ( A.EmpId , '' ) as EmpId, 
				   IsNull ( C.EmpNm , '' ) as EmpNm, 
				   IsNull ( A.JobNo , '' ) as JobNo, 
				   IsNull ( A.DeptCd , '' ) as DeptCd, 
				   IsNull ( D.DeptNm , '' ) as DeptNm, 
				   IsNull ( A.CustPrsn , BB.CustEmpNm ) as CustPrsn, 
				   IsNull ( A.CustTell , BB.C_Tel ) as CustTel,
				   IsNull ( B.Fax , '' ) as CustFax, 
				   IsNull ( A.CustEmail , BB.EmailID ) as CustEmail, 
				   IsNull ( A.GoodNm , '' ) as GoodNm, 
		  
				   IsNull ( A.ExpClss , '' ) as ExpClss, 
				   IsNull ( B.CurrCd , Curr.CurrCd ) as CurrCd, 
				   CASE WHEN IsNull ( T.SaleVatYn , '' ) ='N' THEN 'Y' ELSE 'N' END as SaleVatYn , 
				   IsNull ( B.SalePayment , '' ) as Payment, 
				   IsNull ( A.Remark , '' ) as Remark, 
				   IsNull ( A.RefNo , '' ) as RefNo, 
				   IsNull ( A.SpecNo , '' ) as SpecNo, 
				   IsNull ( A.SpecType , '' ) as SpecType, 
				   IsNull ( A.DrawNo , '' ) as DrawNo, 
				   IsNull ( A.SysClass1 , '' ) as SysClass1, 
				   IsNull ( A.SysClass2 , '' ) as SysClass2, 
				   IsNull ( A.SysClass3 , '' ) as SysClass3, 
				   IsNull ( A.SysClass4 , '' ) as SysClass4,
				   0.00000 as SaleVatRate,
				   'Y' as ASYn,
				   'N' as ASChargeYn,
               A.Status as ASStatus
               From TASRecv00 A WITH ( NOLOCK ) Left Outer Join TMACust00 B WITH ( NOLOCK ) 
                On A.CustCd =B.CustCd 
                Left Outer Join TMAEmpy00 C WITH ( NOLOCK ) 
                On A.EmpId =C.EmpId
                 Left Outer Join TMADept00 D WITH ( NOLOCK ) 
                 On A.DeptCd =D.DeptCd 
                 Left Outer Join TMATaxm00 T With ( NoLock ) 
                 On 1 = 1 
                 Left Outer Join TMACurr00 Curr With ( Nolock ) 
                 On Curr.CurrYn ='Y' 
                 Left Outer Join TMACust10 BB With ( Nolock ) 
                 On B.CustCd =BB.CustCd 
                 And BB.Chargetype ='Y' 
                 And BB.PurchaseYn ='Y'
                 left join TPMWKReq00 MC on A.ASRecvNo = MC.SourceNo AND MC.SourceType = '2' 
				WHERE A.ExpClss = '1'
				And ASRecvNo Like '%s%%' 
				AND B.CustNm Like '%s%%'
				AND A.ASRecvDate between '%s' and '%s'
				And A.CfmYn ='1' 
				AND A.OrderProgYn = '0'
				And A.InvoiceProgYn ='0' 
				AND A.ChargeYn = 'Y'
				AND A.AptYn = '1'
				order by ASRecvNo desc
				",[$asNo,$custCd,$starDate,$endDate]);

        return $result;
    }

    public function getSaleVatRate($custCd){
        $result = DB::queryRow("Select Top 1  IsNull(B.CustEmpNm, '') as CustEmpNm,              
                    IsNull(B.EmailID, IsNull(A.EmailAddr, '')) as EmailAddr,            
                    IsNull(B.c_Tel, IsNull(A.Tel, '')) as Tel,                     
                    IsNull(A.Fax, '') as Fax, 		           
                    IsNull(A.SaleDiscountRate, 0) as SaleDiscountRate,                         
                    IsNull(B.HP, '') as HP,                                             
                    IsNull(A.SaleVatRate, C.SaleVatRate) as SaleVatRate                         
                    From TMACust00 As A 
                    Left Outer Join TMACust10 As B On A.CustCd = B.CustCd And B.Chargetype = 'Y' And B.PurchaseYn = 'Y'                       
                    Left Outer Join (SELECT TOP 1 SaleVatRate FROM TMATaxm00) C ON 1=1  Where A.CustCd = N'%s'",[$custCd]);
        return $result;
    }

    public function getQuoteJobPower($empId){
        $result = DB::queryRow( "Select IsNull(MAX(A.JobNo),'')  as JobNo
								From TMAjobc10 A With(Nolock) 
								Inner Join TMAJobc00 B With(Nolock)  On A.JobNo = B.JobNo
								Where A.EmpId = '%s'
                                And B.SaleYn = 'Y'
                                And A.STDate <= GETDATE() --@v_QuotDate
                                And A.EDDate >= GETDATE() --@v_QuotDate",[$empId]);
        return $result;
    }

    /**
     * 国际服务费率
     */
    public function getServiceRate(){
        $result = DB::queryRow("select ASChargeRate from TMATaxm00");
        return $result;
    }

    /**
     * 添加国际服务费
     */
    public function addServiceCharge(){
        $result = DB::queryRow("SELECT TOP 1  IsNull(A.ItemCd, '') as ItemCd , 
                  IsNull(A.ItemNo, '') as ItemNo,
                  IsNull(A.ItemNm, '') as ItemNm,
                  IsNull(A.Spec, '') as Spec,
                  IsNull(A.StkUnitCd, '') as UnitCd,
                  IsNull(A.VatYn, 'N') as VatYn,
                  IsNull(A.Status, '') as Status,
                  IsNull(B.ASChargeRate, 0) as ASChargeRate   
                  FROM TMAItem00 As A With(Nolock) 
                  Inner Join TMATaxm00 As B With (Nolock) On 1 = 1  
                  WHERE A.ASChargeYn = 'Y'  
                  And A.Status = '1'  
                  And A.SaleYesOrNo = 'Y'  Order By ItemNo");
        return $result;
    }
}
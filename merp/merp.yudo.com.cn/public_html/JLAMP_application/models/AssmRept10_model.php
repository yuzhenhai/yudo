<?php
class AssmRept10_model extends Multi_dbQuery
{
    public $auth;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 获取组装照片
     * @param $assReptNo
     * @param $returnType
     * @return array
     */
    public function getAssmPhotoNm($assReptNo,$returnType){
        $result = DB::queryRows("
            select FileNm,
            Seq,
            AssmReptNo,
            FTP_UseYn,
            Photo 
            from TSAAssmRept10 where 
            AssmReptNo = '%s'",[$assReptNo],$returnType);
        return $result;
    }

    /**
     * 获取试模照片
     * @param $assReptNo
     * @param $returnType
     * @return array
     */
    public function getTrialPhotoNm($assReptNo,$returnType){
        $result = DB::queryRows("
           select FileNm,
           Seq,
           AssmReptNo,
           FTP_UseYn,
           Photo from TSAAssmRept20 where 
           AssmReptNo = '%s'",[$assReptNo],$returnType);
        return $result;
    }

    /**
     * 获取组装试模销售负责人
     * @param $assReptNo
     * @return array
     */
    public function getAssmSales($assReptNo){
        $result = DB::queryRows("
            select a.AssmReptNo,
            a.Seq,
            a.SaleEmpID,
            b.EmpNm,
            b.Sex,
            a.Remark,
            NB.DeptNm from TSAAssmRept30 a 
            left join TMAEmpy00 NA on a.SaleEmpID = NA.EmpID
            left join TMADept00 NB on NA.DeptCd = NB.DeptCd,
            TMAEmpy00 b
            where a.SaleEmpID = b.EmpID AND AssmReptNo = '%s'",[$assReptNo]);
        return $result;
    }


}
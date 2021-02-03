<?php
class System_model extends Multi_dbExecute
{
    public $returnArray = [
        'code' => 0,
        'data' => []
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function getCurrRate($dateYm,$currCd){
        $result = DB::queryRow(" SELECT IsNull(A.BasicStdRate, 0) as BasicStdRate,
            IsNull(B.BasicAmt, 0) as BasicAmt
            From TMACurr10 A Inner Join TMACurr00 B On A.CurrCd = B.CurrCd
            Where A.YYMM = N'%s'
            And A.CurrCd = N'%s'",[$dateYm,$currCd]);
        return $result;
    }

    public function addOAInterface($sourceType,$sourceNo,$empId,$spNm,$loginId){
        $add = array(
            'SourceType'  => $sourceType,
            'SourceNo'    => $sourceNo,
            'SP_Contents' => "execute $spNm '+''''+'CA'+''''+','+''''+'$sourceNo'+''''+','+''''+'$empId'+'''",
            'OA_Status'   => '0',
            'RegEmpID'    => $loginId,
            'RegDate'     => 'date(now)',
            'UptEmpID'    => $loginId,
            'UptDate'     => 'date(now)'
        );
        $res = DB::queryRow("select SourceNo from TS_OA_Interface 
                    where SourceNo = '%s'
                    and   SourceType = '%s'",[$sourceNo,$sourceType]);
        if(!empty($res)){
            $this->returnArray['code'] = 451;
        }else{
            $this->table('TS_OA_Interface')->add($add);
        }
        return $this->returnArray;
    }

    public function delOAInterface($sourceType,$sourceNo){
        $res = DB::queryRow("select OA_Status from TS_OA_Interface
                    where SourceNo = '%s'
                    and   SourceType = '%s'",[$sourceNo,$sourceType]);
        if(empty($res)){
            $this->returnArray['code'] = 450; //.裁决不存在
            return $this->returnArray;
        }
        if($res['OA_Status'] != '5'){
            $this->returnArray['code'] = 452;//.不可取消
            return $this->returnArray;
        }

        DB::queryRow("Delete from TS_OA_Interface where SourceType = '%s' and SourceNo = '%s'",[$sourceType,$sourceNo]);


        return $this->returnArray;

    }
}
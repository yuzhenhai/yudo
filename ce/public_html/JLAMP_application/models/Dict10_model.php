<?php
class Dict10_model extends Multi_dbQuery
{
    public function __construct()
    {
        parent::__construct();

    }

    public function getCountryList($langCode){
        $result = DB::queryRows("select DictCd as value,TransNm as text from TSMDict10 where DictCd LIKE 'MA3003%%' AND LangCd = '%s'",[$langCode]);
        return $result;
    }

    public function getDelvDateList($langCode){
        $result = DB::queryRows("select DictCd as value,TransNm as text from TSMDict10 where DictCd LIKE 'SA1032%%' AND LangCd = '%s'",[$langCode]);
        return $result;
    }

    public function getDelvMethodList($langCode){
        $result = DB::queryRows("select DictCd as value,TransNm as text from TSMDict10 where DictCd LIKE 'SA1033%%' AND LangCd = '%s'",[$langCode]);
        return $result;
    }

    public function getMarketList($langCode){
        $result = DB::queryRows("select DictCd as value,TransNm as text from TSMDict10 where DictCd LIKE 'SA1025%%' AND LangCd = '%s'",[$langCode]);
        return $result;
    }

    public function getGoodClassList($langCode){
        $result = DB::queryRows("select DictCd as value,TransNm as text from TSMDict10 where DictCd LIKE 'SA2003%%' AND LangCd = '%s'",[$langCode]);
        return $result;
    }

    public function getSrvAreaList($langCode){
        $result = DB::queryRows("select DictCd as value,TransNm as text from TSMDict10 where DictCd LIKE 'SA1031%%' AND LangCd = '%s'",[$langCode]);
        return $result;
    }

    public function getASKindList($langCode){
        $result = DB::queryRows("select DictCd as value,TransNm as text from TSMDict10 where DictCd LIKE 'AS2001%%' AND LangCd = '%s'",[$langCode]);
        return $result;
    }

    public function getASProcKindList($langCode){
        $result = DB::queryRows("select DictCd as value,TransNm as text from TSMDict10 where DictCd LIKE 'AS2002%%' AND LangCd = '%s'",[$langCode]);
        return $result;
    }

    public function getASProcResultList($langCode){
        $result = DB::queryRows("select DictCd as value,TransNm as text from TSMDict10 where DictCd LIKE 'AS2003%%' AND LangCd = '%s'",[$langCode]);
        return $result;
    }

    public function getPrintClassList($langCode){
        $result = DB::queryRows("select A.RelCd1 as value,B.TransNm as text from TSMSyco10 A
                    left join TSMDict10 B on A.MinorCd = B.DictCd and B.LangCd = '%s'
                    where A.MajorCd like 'SA1029%%'",[$langCode]);
        return $result;
    }

    public function getQuotStatusList($langCode){
        $result = DB::queryRows("select A.RelCd1 as value,B.TransNm as text from TSMSyco10 A
                    left join TSMDict10 B on A.MinorCd = B.DictCd and B.LangCd = '%s'
                    where A.MajorCd like 'SA2001%%'",[$langCode]);
        return $result;
    }
    public function getItemReturnList($langCode){
        $result = DB::queryRows("select A.RelCd1 as value,B.TransNm as text from TSMSyco10 A
                    left join TSMDict10 B on A.MinorCd = B.DictCd and B.LangCd = '%s'
                    where A.MajorCd like 'AS1014%%'",[$langCode]);
        return $result;
    }

    public function getDict($classNm,$langCode){
        $result = DB::queryRows("select 
                isnull(MULTIB.TransNm,MULTIA.MinorNm) AS text,
                isnull(MULTIB.DictCd,MULTIA.MinorCd) AS value  
                from TSMSyco10 MULTIA full join TSMDict10 MULTIB on MULTIA.MinorCd = MULTIB.DictCd and MULTIB.LangCd = '%s'
                where left(MULTIA.MinorCd,6) = '%s'",[$langCode,$classNm]);
        return $result;
    }

    public function getDictChild($classNm,$classChildNm,$langCode){
        $result = DB::queryRows("select 
                isnull(MULTIB.TransNm,MULTIA.MinorNm) AS text,
                isnull(MULTIB.DictCd,MULTIA.MinorCd) AS value 
                from TSMSyco10 MULTIA
                full join TSMDict10 MULTIB on MULTIA.MinorCd = MULTIB.DictCd and MULTIB.LangCd = '%s'
                where MULTIA.RelCd1 = '%s' and left(MULTIA.MinorCd,6) = '%s'",[$langCode,$classNm,$classChildNm]);
        return $result;
    }

    public function getMinDict($classNm,$langCode){
        $result = DB::queryRows("select 
                        B.DictCd as value,
                        B.TransNm as text from TSMSyco10 as A 
                        left join TSMDict10 as B on B.DictCd = A.MinorCd AND B.LangCd = '%s'
                        WHERE A.RelCd1 = '%s'",[$langCode,$classNm]);
        return $result;
    }




}
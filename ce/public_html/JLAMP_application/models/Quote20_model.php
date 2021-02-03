<?php
class Quote20_model extends Multi_dbExecute {

    public function addQuote(&$quoteNo,$add){
        $ym = date('Ym',time());
        $lastQuoteNo = DB::queryRow("select top 1 QuotNo from TSAQuot00 where QuotNo like '%s%%' order by QuotNo desc",[$ym]);
        if(empty($lastQuoteNo)){
            $quoteNo = $ym.'0001';
        }else{
            $quoteNo = $lastQuoteNo['QuotNo']+1;
        }
        $add['QuotNo'] = $quoteNo;
        $res = $this->table('TSAQuot00')->add($add);
        return $res;
    }

    public function setQuote($quoteNo,$save){
        $res = $this->table('TSAQuot00')->where(array('QuotNo' => $quoteNo))->save($save);
        return $res;
    }
    public function getQuoteItem($quoteNo,$sort){
        $result = DB::queryRow("select top 1 Sort from TSAQuot10 where QuotNo = '%s' and Sort = '%s' order by QuotNo desc",[$quoteNo,$sort]);
        return $result;
    }
    public function addQuoteItem($quoteNo,$add){
        $lastQuoteItem = DB::queryRow("select top 1 QuotSerl,Sort from TSAQuot10 where QuotNo = '%s' order by QuotSerl desc",[$quoteNo]);
        if(empty($lastQuoteItem)){
            $quotSerl = '0001';
        }else{
            $quotSerl = $lastQuoteItem['QuotSerl']+1;
            if($quotSerl < 10){
                $quotSerl = '000'.$quotSerl;
            } else if($quotSerl > 9){
                $quotSerl = '00'.$quotSerl;
            } else if($quotSerl > 99){
                $quotSerl = '0'.$quotSerl;
            } else if($quotSerl > 999){

            }
        }
        $add['QuotSerl'] = $quotSerl;
        $res = $this->table('TSAQuot10')->add($add);
        return $res;
    }

    public function setQuoteItem($quoteNo,$quotSort,$save){
        $res = $this->table('TSAQuot10')->where(array('QuotNo' => $quoteNo,'Sort' => $quotSort))->save($save);
        return $res;
    }

    public function delQuoteItem($quoteNo,$quotSort){
        $res = $this->table('TSAQuot10')->where(array('QuotNo' => $quoteNo,'Sort' => $quotSort))->delete();
        return $res;
    }

    public function changeStatusToOA($quoteNo,$check=true){
        if($check == true){
            $save  = [
                'Status' => 'A',
                'ApprUseYn' => '1',
            ];
        }else{
            $save  = [
                'Status' => '0',
                'ApprUseYn' => '0',
            ];
        }
        $res = $this->table('TSAQuot00')->where(array('QuotNo' => $quoteNo))->save($save);
        return $res;
    }

}

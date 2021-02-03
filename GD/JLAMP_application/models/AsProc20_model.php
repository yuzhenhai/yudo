<?php
class AsProc20_model extends Multi_dbExecute{

    public function __construct()
    {
        parent::__construct();
    }


    public function addAsHandleItem($itemInfo)
    {
        if ($itemInfo['ASSerl'] < 10) {
            $itemInfo['ASSerl'] = '000' . $itemInfo['ASSerl'];
        } else if ($itemInfo['ASSerl'] > 9) {
            $itemInfo['ASSerl'] = '00' . $itemInfo['ASSerl'];
        } else if ($itemInfo['ASSerl'] > 99) {
            $itemInfo['ASSerl'] = '0' . $itemInfo['ASSerl'];
        } else if ($itemInfo['ASSerl'] > 999) {

        }
        if(isset($itemInfo['ASRecvSerl'])) $itemInfo['ASRecvSerl'] = $itemInfo['ASSerl'];
        $res = $this->table('TASProc10')->add($itemInfo);
        return $res;
    }

    public function setAsHandleItem($asHandleNo,$itemInfo){
        $res = $this->table('TASProc10')->where(array('ASNo' => $asHandleNo,'ASSerl' => $itemInfo['ASSerl']))->save($itemInfo);
        return $res;
    }
}
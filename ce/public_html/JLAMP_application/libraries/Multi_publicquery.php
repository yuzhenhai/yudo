<?php (defined('BASEPATH')) OR exit('No direct script access allowed');


class Multi_publicquery extends JLAMP_Controller{

    public $loginId;
    public $loginNm;
    public $groupId;
    public $groupNm;

    public function login_user(){
        $login_id = str_replace(' ','',$this->getCookie('UserID'));

        $sql = "select UA.EmpID,UA.EmpNm,UB.DeptCd,UB.DeptNm from TMAEmpy00 UA
                left join TMADept00 UB on UA.DeptCd = UB.DeptCd
                WHERE UA.EmpID = '$login_id'";

        $result = $this->jlamp_common_mdl->sqlRow($sql);

        $this->loginId = $result->EmpID;
        $this->loginNm = $result->EmpNm;
        $this->groupId = $result->DeptCd;
        $this->groupNm = $result->DeptNm;
    }
}
    //设置post序列化
<?php (defined('BASEPATH')) OR exit('No direct script access allowed');


class ConnectRecord extends Base
{
    function __construct()
    {
        parent::__construct();
    }
    public function index(){
        $this->jlamp_tp->define(['tpl' => 'MenuView/ConnectRecord.html']);
        $this->jlamp_tp->template_dir = VIEWS;
    }

    public function getConnectRecord(){
        $date = $this->inputM('date');
        $result = DB::queryRows("select A.*,C.EmpID,C.EmpNm,D.DeptCd,D.DeptNm from sysLogHistory A
                                        left join sysUserMaster B on A.user_id = B.user_id
                                        left join TMAEmpy00 C on B.emp_code = C.EmpID
                                        left join TMADept00 D on C.DeptCd = D.DeptCd
                                        where A.form_id LIKE 'WEI_%%' 
                                        AND CONVERT(CHAR(10),A.login_time,120) = '%s' 
                                        AND A.user_id != 'M2015011'
                                        order by A.login_time desc",[$date]);
        if(empty($result[0])){
            Helper::responseEmpty();
        }
        Helper::responseData($result);
        $this->response();
    }


}

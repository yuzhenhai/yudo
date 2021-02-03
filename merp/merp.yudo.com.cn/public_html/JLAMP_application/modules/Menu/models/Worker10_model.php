<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Worker10_model extends Multi_dbQuery
{
    public function __construct()
    {
        parent::__construct();
    }
    //查询用户
    public function getUsers(){

        $this->haswhere = true; //存在默认where条件
        $sql = "select top 1 a.EmpID,a.EmpNm,b.DeptCd,b.DeptNm from TMAEmpy00 a,TMADept00 b 
               where a.DeptCd = b.DeptCd AND a.RetireYn = 'N'";
        $type = array(
            'a.EmpNm|LIKE|utf-8',
            'a.EmpID',
            'b.DeptNm|LIKE|utf-8'
        );
        $this->created($sql,$type);
        return $this->jlamp_query();
    }
}
<?php
class User10_model extends Multi_dbQuery {
    public function __construct()
    {
        parent::__construct();
    }
    //.获取职工列表
    public function getUserList($userNm,$userId,$groupNm,$page,$pageCnt=50){
        $page = ($page-1)*$pageCnt;
        $this->haswhere = true; //存在默认where条件
        $sql = "select top $pageCnt * from 
              (select Row_Number()over(order by a.EmpID asc)AS id,a.EmpID,a.EmpNm,b.DeptCd,b.DeptNm from TMAEmpy00 a,TMADept00 b 
               where a.DeptCd = b.DeptCd AND a.RetireYn = 'N'";
        $type = array(
            'a.EmpNm|LIKE|utf-8',
            'a.EmpID',
            'b.DeptNm|LIKE|utf-8'
        );
        $this->append(")T where id > $page order by id asc");
        $this->where(["%$userNm%", $userId, "%$groupNm%"])->select()->created($sql,$type);
        return $this->jlamp_query();
    }
}
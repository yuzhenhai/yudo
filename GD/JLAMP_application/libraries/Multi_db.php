<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Multi_db {

    public $DB;

    public function __construct($DB)
    {
        $this->DB = $DB;
    }
    //SP方法
    public function mf_sp($spname,$sp_join_array,$sp_return_array){

        //DB信息

        $db_config = $this->db_config();
        $DB = $db_config['database'][$this->DB];

        //连接句柄
        $conn = mssql_connect($DB['host'],$DB['username'],$DB['password']) or die(mssql_get_last_message());
        mssql_select_db($DB['name'],$conn) or die("mssql error");

        //使用过程体
        $sql=mssql_init($spname);

        //传入参数
        for($i = 0;$i<count($sp_join_array);$i++){
            str_replace(' ','',$sp_join_array[$i][1]);
            mssql_bind($sql,'@'.$sp_join_array[$i][0],$sp_join_array[$i][1],SQLVARCHAR,false,false,100);
        }

        //返回参数
        for($i = 0;$i<count($sp_return_array);$i++)
        {

            str_replace(' ','',$sp_return_array[$i][1]);
            mssql_bind($sql,'@'.$sp_return_array[$i][0],$sp_return_array[$i][1],SQLVARCHAR,true);
        }

        $result   =   mssql_execute($sql,false);
        mssql_close($conn);
        $res = array();
        while ($row = mssql_fetch_object($result)){
            $res[] = $row;
        }
        return $res;
    }

    //sql配置参数
    private function db_config(){
        $json_string = file_get_contents('/home/gdmerp.yudo.com.cn/config.json');
        $json_db_string = json_decode($json_string, true);
        return $json_db_string;
    }

}
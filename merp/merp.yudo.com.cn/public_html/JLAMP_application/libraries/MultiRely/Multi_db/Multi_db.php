<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Multi_db extends JLAMP_Model {
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * @param string $query
     * @param array $bindings
     * @param string $returnType
     * @return mixed
     */
    public function queryRow($query,$bindings=[],$returnType='array'){
        if(!empty($bindings)){
            foreach ($bindings as $k => &$v){
                $v = addslashes($v);
            }
            $query = vsprintf($query,$bindings);
        }
        $result = $this->jlamp_common_mdl->sqlRow($query);
        if($returnType == 'array'){
            $result = json_decode(json_encode($result),true);
        }
        return $result;
    }

    /**
     * @param string $query
     * @param array $bindings
     * @param string $returnType
     * @return mixed
     */
    public function queryRows($query,$bindings=[],$returnType='array'){
        if(!empty($bindings)){
            foreach ($bindings as $k => &$v){
                $v = addslashes($v);
            }
            $query = vsprintf($query,$bindings);
        }

        $result = $this->jlamp_common_mdl->sqlRows($query);
        if($returnType == 'array'){
            $result = json_decode(json_encode($result),true);
        }
        return $result;
    }

    /**
     * @param string $query
     * @param array  $bindings
     * @return string
     */
    public function toSql($query,$bindings=[]){
        if(!empty($bindings)){
            foreach ($bindings as $k => &$v){
                $v = addslashes($v);
            }
            $query = vsprintf($query,$bindings);
        }
        return $query;
    }

    /**
     * @param string $dbName
     */
    public function connect($dbName='JLAMPBiz'){

        $this->jlamp_common_mdl->DBConnect($dbName);

    }

    /**
     * @param string $DB
     * @param string $spName
     * @param array $input
     * @param array $output
     * @return array
     */
    public function call($DB,$spName,$input,$output){
        //DB信息
        $DB =  $GLOBALS["JLAMPConfig"]->database->$DB;
        //连接句柄
        $conn = mssql_connect($DB->host,$DB->username,$DB->password) or die(mssql_get_last_message());
        mssql_select_db($DB->name,$conn) or die("mssql error");

        //使用过程体
        $sql=mssql_init($spName);

        //传入参数
        for($i = 0;$i<count($input);$i++){
            str_replace(' ','',$input[$i][1]);
            mssql_bind($sql,'@'.$input[$i][0],$input[$i][1],SQLVARCHAR,false,false,100);
        }

        //返回参数
        for($i = 0;$i<count($output);$i++)
        {

            str_replace(' ','',$output[$i][1]);
            mssql_bind($sql,'@'.$output[$i][0],$output[$i][1],SQLVARCHAR,true);
        }

        $result   =   mssql_execute($sql,false);
        mssql_close($conn);
        $res = array();
        while (true){
            while ($row = mssql_fetch_object($result)){
                $res[] = $row;
            }
            if(mssql_next_result($result) == 0){
                break;
            }
        }
        return $res;
    }
}
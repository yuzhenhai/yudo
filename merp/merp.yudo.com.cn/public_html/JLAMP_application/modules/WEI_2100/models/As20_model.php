<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class As20_model extends JLAMP_Model {
    private $tablename;
    private $print = 0;
    private $where = '';

    private static $error_where  = 0;
    private static $error_add    = 0;
    private static $error_save   = 0;
    private static $error_delete = 0;
    private static $error_table  = 0;

    private static $log_where;
    private static $log_add;
    private static $log_save;
    private static $log_delete;
    private static $log_table;

    public function __construct()
    {
        parent::__construct();
    }
    public function table($table){
        if(empty($table)){
            self::$error_table = 1;
            self::$log_table = 'table is not found';
        }
        $this->tablename = $table;
        return $this;
    }
    public function where($array){
        $this->where = '';
        if(!empty($array)){
            $sql = ' where ';
            foreach ($array as $k => $v){
                if(empty($v) || empty($k)){
                    self::$error_where = 1;
                    self::$log_where = 'where value not found';
                }
                $sql .= ' '.$k.'='."'$v' AND";
            }
            $sql = substr($sql,0,strlen($sql)-3);
            $this->where = $sql;
        }
        return $this;
    }
    public function save($array){
        if(empty($array)){
            self::$error_save = 1;
            self::$log_save = 'save data not found';
        }
        $sql = 'UPDATE '.$this->tablename.' SET ';
        foreach ($array as $k => $v){
            if(is_array($v)){
                switch ($v[1]) {
                    case 'utf-8':
                        $sql .=  $k.' = '."N'$v[0]',";
                        break;
                }
            }
            else
            {
                if($v == 'date(now)'){
                $v = 'getdate()';
                $sql .= $k.' = '.$v.',';
                }
                else
                {
                    $sql .= $k.' = '."'$v'".',';
                }
            }
        }
        $sql = substr($sql,0,strlen($sql)-1);
        $sql .= $this->where;
        $res = $this->jlamp_add($sql);
        return $res;
    }
    public function sudo(){
        $this->print = 1;
        return $this;
    }
    public function add($array){
        if(empty($array)){
            self::$error_add = 1;
            self::$log_add = 'add data not found';
        }
        $keyname = '';
        $valuename = '';
        $sql = 'insert into '.$this->tablename.' (';
        foreach ($array as $k => $v){
            $keyname .= $k.',';
            if(is_array($v)){
                switch ($v[1]) {
                    case 'utf-8':
                        $valuename .= "N'$v[0]',";
                        break;
                }
            }
            else
            {
                if($v == 'date(now)'){
                    $valuename .= 'getdate()'.',';
                }
                else
                {
                    $valuename .= "'$v'".',';
                }
            }
        }
        $keyname = substr($keyname,0,strlen($keyname)-1);
        $valuename = substr($valuename,0,strlen($valuename)-1);
        $sql .= $keyname.') values ('.$valuename.') '.$this->where;
        $res = $this->jlamp_add($sql);
        return $res;
    }
    public function delete(){
        $sql = "DELETE FROM $this->tablename $this->where";
        $res = $this->jlamp_add($sql);
        return $res;
    }
    public function error_check(){
        if(self::$error_table == 1){
            return self::$log_table;
        }
        elseif (self::$error_where == 1){
            return self::$log_where;
        }
        elseif (self::$error_add == 1){
            return self::$log_add;
        }
        elseif (self::$error_save == 1){
            return self::$log_save;
        }
        elseif (self::$error_delete == 1){
            return self::$log_delete;
        }
        else{
            return 'ok';
        }
    }

    public function jlamp_add($sql){
        if($this->print == 0){
            if($this->error_check() == 'ok'){
                $result = $this->jlamp_common_mdl->sqlExec($sql);
            }
            else
            {
                return $this->error_check();
            }
        }
        else
        {
            $result = $sql;
        }
        return $result;
    }
}
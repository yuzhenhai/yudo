<?php
class Multi_dbQuery extends JLAMP_Model
{

    private $multi = array(
        'where' => array()
    );
    private $where = '';
    private $m_print = 0;
    private $m_count = '';
    private $sqlsen = '';
    private $append = '';
    private $table = '';
    private $filed = '';
    private $limit = '';
    private $order = array();
    private static $error = 0;

    protected $auth;
    protected $isnull = true;
    protected $haswhere = false;
    protected $dataType = 'Array';
    protected $return = [
        'data' => '',
        'code' => 0,
    ];
    public function __construct()
    {
        parent::__construct();
    }

    //--链式拼接---------------------------
    public function table($table){
        $this->table = $table;
        $this->limit = '';
        return $this;
    }

    public function field($filed){
        $this->field = $filed;
        return $this;
    }

    public function append($sql){
        $this->append = ' '.$sql;
    }

    public function order($order){
        $this->order = explode(',',$order);
        return $this;
    }

    public function sudo(){
        $this->m_print = 1;
        return $this;
    }

    public function object(){
        $this->dataType = 'Object';
        return $this;
    }

    public function limit($length){
        $this->limit = ' top '.$length.' ';
        return $this;
    }

    public function find(){
        $this->sqlsen = '';
        $this->m_count = 'find';
        if(!empty($this->table)){
            $this->created();
            return $this->jlamp_query();
        }
        else
        {
            return $this;
        }
    }
    public function select(){
        $this->sqlsen = '';
        $this->m_count = 'select';
        if(!empty($this->table)){
            $this->created();
            return $this->jlamp_query();
        }
        else
        {
            return $this;
        }
    }
    public function where($array){
        $this->multi['where'] = array();
        if(!empty($array))
        {
            $sql = '';
            //如果自定义table
            if(!empty($this->table)){
                $this->where = '';
                foreach ($array as $k => $v) {
                    if (empty($v) || empty($k)) {
                        self::$error = 1;
                    }
                    $v = addslashes($v);
                    $sql .= ' ' . $k . '=' . "'$v' AND";
                }
                $sql = substr($sql,0,strlen($sql)-3);
                $this->where = $sql;
            }
            else
            {
                foreach($array as $k => $v){
                    $v = str_replace(' ','',$v);
                    $v = addslashes($v);
                    if(!empty(str_replace('%','',$v))){
                        $this->isnull = false;
                        $this->multi['where'][] = $v;
                    }
                    else
                    {
                        $this->multi['where'][] = '';
                    }
                }
            }
        }
        return $this;
    }
    protected  function jlamp_query(){
        if($this->m_print != 1)
        {
            switch ($this->m_count){
                case 'find':
                    $result = $this->jlamp_common_mdl->sqlRow($this->sqlsen);
                    break;
                case 'select':
                    $result = $this->jlamp_common_mdl->sqlRows($this->sqlsen);
                    break;
                default:
                    $result = $this->jlamp_common_mdl->sqlRows($this->sqlsen);
            }
            if($this->dataType == 'Array'){
                $result = json_decode(json_encode($result),true);
            }
            return $result;
        }
        else
        {
            return $this->sqlsen;
        }
    }
    protected function created($sql = '',$type = array()){
        error_reporting( E_ALL&~E_NOTICE );
        //自定义table
        if(!empty($this->table)){
            empty($this->field) ? $this->field = '*' : $this->field;
            $sql = "SELECT $this->limit $this->field FROM $this->table WHERE ";
            if(!empty($this->order)){
                if(empty($this->order[0])){
                    self::$error = 1;
                    return 'not found order key1 data';
                }
                if(empty($this->order[1])){
                    self::$error = 1;
                    return 'not found order key2 data';
                }
                $this->sqlsen = $sql.$this->where.' ORDER BY '.$this->order[0].' '.$this->order[1];
            }
            else{
                $this->sqlsen = $sql.$this->where;
            }
        }
        else
        {
            $num = 0;
            //如果当前链式操作有条件值
            if($this->isnull != true){
                //如果原生语句没有where则加个where
                if($this->haswhere == false) {
                    $sql .=' WHERE ';
                    $num = 0; //开头不加AND
                }
                else{
                    $num = 1; //开头加一个AND
                }
            }
            $this->sqlsen = '';
            $created_make = $this->created_make($sql,$type,$num);
            $this->sqlsen .= $created_make." ".$this->append;
        }
    }
    private function created_append($sql,$type = array()){
        //如果当前链式操作有条件值
        if($this->isnull != true){
            $sql = ' AND '.$sql;
        }
        else
        {
            //如果原生sql没有where，则加一个
            if($this->haswhere == false){
                $sql = ' WHERE '.$sql;
            }
        }
        $this->created($sql,$type);
    }
    private function created_make($sql,$type,$num){
        $AND = '';
        $valuefont = '';
        foreach ($type as $k => $v){
            //去除%修饰符，如果数据为空，则不添加where条件
            if(empty(str_replace('%','',$this->multi['where'][$k]))){
                continue;
            }
            $keyfont = explode('|',$v);
            if($num > 0){
                $AND = ' AND ';
            }
            //区分LIKE/=/等
            switch ($keyfont[1]){
                case 'LIKE':
                case 'like':
                    $term =  ' LIKE ';
                    break;
                case 'GRE':
                    $term = ' > ';
                    break;
                case 'LES':
                    $term = ' < ';
                    break;
                case 'UEQ':
                    $term =  ' <> ';
                    break;
                default:
                    $term =  ' = ';
                    break;
            }
            //条件修饰,目前支持N方法
            switch($keyfont[2]){
                case 'utf-8':
                    $valuefont = "N'".$this->multi['where'][$k];
                    break;
                default:
                    $valuefont = "'".$this->multi['where'][$k];
                    break;
            }
            $sql = $sql.$AND.$keyfont[0].$term.$valuefont."' ";
            $num++;
        }
        return $sql;
    }
    protected function query($sql,$array=array()){
        if(!empty($array)){
            foreach ($array as $k => $v){
                $array[$k] = addslashes($v);
            }
            $sql = vsprintf($sql,$array);
        }
        $this->sqlsen = $sql;
        return $this->jlamp_query();
    }
}
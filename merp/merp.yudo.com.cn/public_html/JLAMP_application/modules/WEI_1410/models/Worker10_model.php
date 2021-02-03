<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Worker10_model extends JLAMP_Model
{

    private $multi = array(
        'where' => array()
    );
    private $where = '';
    private $auth;
    private $m_print = 0;
    private $m_count = '';
    private $sqlsen = '';
    private $isnull = true;
    private $append = '';
    private $haswhere = false;
    private $dataType = 'Array';
    private $table = '';
    private $filed = '';
    private $order = array();
    private static $error = 0;
    public function __construct()
    {
        parent::__construct();
    }
    public function getLeaders($langCode='SM00010003'){
        $this->haswhere = true;
        $sql = "select 
            isnull(MULTIB.TransNm,MULTIA.MinorNm) AS text,
            isnull(MULTIB.DictCd,MULTIA.MinorCd) AS value 
            from TSMSyco10 MULTIA
            full join  TSMDict10 MULTIB on MULTIA.MinorCd = MULTIB.DictCd and MULTIB.LangCd = '$langCode'
             where DeleteYn = 'N'";
        $type = array(
            'left(MULTIA.MinorCd,6)'
        );
        $this->created($sql,$type);
        return $this->jlamp_query();
    }
    //获取部门列表
    public function getDeptId($loginUser,$check){
        if($check== 'D'){
            $sql = "select A.DeptNm as text,A.DeptCd as value from TMADept00 A
                left join TMAEmpy00 B ON A.MEmpID = B.EmpID
                where A.MEmpID = '$loginUser'
                group by A.DeptCd,A.DeptNm";
        }else if($check == 'M'){
            $sql = "select A.DeptNm as text,A.DeptCd as value from TMADept00 A
                left join TMAEmpy00 B ON A.MEmpID = B.EmpID
                where A.DeptDiv2 = (select MinorCd from TSMSyco10 where RelCd1 = '$loginUser')
                group by A.DeptCd,A.DeptNm";
        }else if($check == 'A' ){
            $sql = "select DeptNm as text,DeptCd as value from TMADept00
                    where LEFT(DeptDiv2,6) = 'MA1004' GROUP BY DeptNm,DeptCd";
        }
        $this->created($sql);
        return $this->jlamp_query();
    }

    //--链式拼接---------------------------
    public function table($table){
        $this->table = $table;
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
                    $sql .= ' ' . $k . '=' . "'$v' AND";
                }
                $sql = substr($sql,0,strlen($sql)-3);
                $this->where = $sql;
            }
            else
            {
                foreach($array as $k => $v){
                    $v = str_replace(' ','',$v);
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
    private function jlamp_query(){
        //当需要解析打印链式语法为原生sql时候
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
    //sql where条件拼接
    private function created($sql = '',$type = array()){
        error_reporting( E_ALL&~E_NOTICE );
        //自定义table
        if(!empty($this->table)){
//            if(empty($this->field)){
//                self::$error = 1;
//                return 'not found field data';
//            }
            empty($this->field) ? $this->field = '*' : $this->field;
            $sql = "SELECT $this->field FROM $this->table WHERE ";
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
}
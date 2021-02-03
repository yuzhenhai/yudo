<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class ChangePassWd extends Base
{
    function __construct()
    {
        parent::__construct();
        $DB = parent::getCookie('DB');
        parent::setBizDBAlias($DB);
    }

    public function index()
    {
        $formKey = $this->jlamp_comm->xssInput('formKey', 'get');
        //$langID = $this->jlamp_comm->xssInput('langID', 'get');
        $menuSelection = $this->jlamp_comm->xssInput('menuSelection', 'get');
        $this->jlamp_tp->assign(array(
            //'subTitle' => $subTitle,
            //'langID' => $langID,
            'formKey' => $formKey,
            'menuSelection' => $menuSelection
        ));
        $this->jlamp_tp->define(['tpl' => 'MenuView/ChangePassWd.html']);
        $this->jlamp_tp->template_dir = VIEWS;
    }
    //修改密码
    public function savePassWd(){
        $oldPassWd = $this->jlamp_comm->xssInput('oldPassWd', 'post');
        $newPassWd = $this->jlamp_comm->xssInput('newPassWd', 'post');
        $newPassWd2 = $this->jlamp_comm->xssInput('newPassWd2', 'post');
        if(empty($oldPassWd) || empty($newPassWd) || empty($newPassWd2)){
            $this->recall_array['returnCode'] = 'I001';
            $this->jlamp_comm->jsonEncEnd($this->recall_array);
        }
        if($newPassWd !== $newPassWd2){
            $this->recall_array['returnCode'] = 'passWdError';
            $this->jlamp_comm->jsonEncEnd($this->recall_array);
        }
        if(empty($this->loginUser)){
            $this->recall_array['returnCode'] = 'noLogin';
            $this->jlamp_comm->jsonEncEnd($this->recall_array);
        }
        $this->load->model('Worker10_model');
        $this->load->model('Worker20_model');
        $userRes = $this->Worker10_model->table('sysUserMaster')->where(array('user_id' => $this->loginUser))->find();
        if(empty($userRes)){
            $this->recall_array['returnCode'] = 'noUser';
            $this->jlamp_comm->jsonEncEnd($this->recall_array);
        }else if($userRes['password'] !== md5($oldPassWd)){
            $this->recall_array['returnCode'] = 'oldPassWdFalse';
            $this->jlamp_comm->jsonEncEnd($this->recall_array);
        }else{
            try{
                $save = array(
                    'password' => md5($newPassWd),
                    'update_userid' => $this->loginUser,
                    'update_time'   => 'date(now)'
                );
                $this->Worker20_model->table('sysUserMaster')->where(array('user_id' => $this->loginUser))->save($save);
            }catch (Exception $e){
                $this->recall_array['returnCode'] = 'saveError';
            }
            $this->jlamp_comm->jsonEncEnd($this->recall_array);
        }
    }
}
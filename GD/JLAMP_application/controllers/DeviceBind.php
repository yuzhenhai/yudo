<?php
header("Access-Control-Allow-Origin: *");
class DeviceBind extends JLAMP_Controller {

    //.设备号绑定服务器ID
    public function bindServer(){
        $device = $this->inputM('device');
        $server = $this->inputM('server');
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        $device = 'device:'.$device;
        $res = $this->cache->save($device,$server,5184000);
        if(!$res){
            Helper::responseSaveErr();
        }
        $this->response();
    }

    //.获取设备号绑定的服务器ID
    public function getServerId(){
        $device = $this->inputM('device');
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        $device = 'device:'.$device;
        $server = $this->cache->get($device);
        if(!$device){
            Helper::responseEmpty();
        }else{
            Helper::responseData($server);
        }
        $this->response();
    }
    public function input($key,$default='',$method = ''){
        if(empty($method)){
            $request = $this->jlamp_comm->xssInput($key, 'get') == '' ? $this->jlamp_comm->xssInput($key, 'post') : $this->jlamp_comm->xssInput($key, 'get');
        }else{
            $request = $this->jlamp_comm->xssInput($key, $method);
        }
        if($request == '') $request = $default;
        return $request;
    }
    public function inputM($key,$method = ''){
        if(empty($method)){
            $request = $this->jlamp_comm->xssInput($key, 'get') == '' ? $this->jlamp_comm->xssInput($key, 'post') : $this->jlamp_comm->xssInput($key, 'get');
        }else{
            $request = $this->jlamp_comm->xssInput($key, $method);
        }
        if($request == ''){
            Helper::setResponse([],300,$key.' empty');
            $this->response();
        }
        return $request;
    }
    public function response(){
        $this->jlamp_comm->jsonEncEnd(Helper::response(),true);
    }

}
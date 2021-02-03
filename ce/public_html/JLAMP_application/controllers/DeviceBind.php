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

}
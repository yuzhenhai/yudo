<?php

/**
 * Class Helper
 */
class Helper {

    const addErr = 451;
    const delErr = 452;
    const saveErr = 453;
    const nil = 100;

    public static $ajaxReturn = [
        'returnCode' => 0,
        'returnMsg' => 'success',
        'returnClass' => '',
        'data' => ''
    ];

    public static function checkEmpty($value){
        if(count($value) <= 0 || empty($value)){
            self::$ajaxReturn['returnCode'] = 300;
            self::$ajaxReturn['returnMsg'] = 'data empty';
            return false;
        }
        foreach ($value as $k => $v){
            if(empty($v) && $v == '' && $v !== 0){
                self::$ajaxReturn['returnCode'] = 300;
                self::$ajaxReturn['returnMsg'] = $k.' empty';
                return false;
            }
        }
        return true;
    }
    public static function setResponse($data,$code=0, $msg = '',$class = '')
    {
        self::$ajaxReturn['returnCode'] = $code;
        self::$ajaxReturn['returnMsg'] = $msg;
        self::$ajaxReturn['returnClass'] = $class;
        self::responseData($data);
    }

    public static function responseErr($msg='error'){
        self::$ajaxReturn['returnCode'] = 200;
        self::$ajaxReturn['returnMsg'] = $msg;
        self::$ajaxReturn['returnClass'] = '';
    }


    public static function responseData($data = '')
    {
        self::$ajaxReturn['data'] = $data;
    }

    public static function responseAddErr()
    {
        self::$ajaxReturn['returnCode'] = self::addErr; //.数据插入失败
        self::$ajaxReturn['returnMsg'] = 'Data Insert Error';
    }

    public static function responseDelErr()
    {
        self::$ajaxReturn['returnCode'] = self::delErr; //.数据插入失败
        self::$ajaxReturn['returnMsg'] = 'Data Delete Error';
    }

    public static function responseSaveErr()
    {
        self::$ajaxReturn['returnCode'] = self::saveErr; //.数据插入失败
        self::$ajaxReturn['returnMsg'] = 'Data Save Error';
    }

    public static function responseEmpty()
    {
        self::$ajaxReturn['returnCode'] = self::nil; //.数据插入失败
        self::$ajaxReturn['returnMsg'] = 'empty';
    }

    public static function response(){
        return self::$ajaxReturn;
    }

    public static function getMethod($url){
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,3);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 对认证证书来源的检查
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // 从证书中检查SSL加密算法是否存在
        curl_setopt($ch,CURLOPT_POST,0); //启用POST提交
        $contents = curl_exec($ch);
        curl_close($ch);
        return json_decode($contents);
    }
}
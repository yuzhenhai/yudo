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
}
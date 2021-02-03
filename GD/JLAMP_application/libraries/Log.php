<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log {

    public static $dir = './log/';
    const LOG_INFO  = ' INFO';
    const LOG_ERROR = ' ERROR';
    const LOG_DEBUG = ' DEBUG';
    const LOG_MAIN  = ' MAIN';

    private static function console($msg,$status){
        $logdir = self::$dir.date('Ymdh',time()).'.txt';
        $fb = fopen($logdir,"a+");
        $msg = '['.date('h:i:s',time()).$status.']:'.$msg."\r\n";
        if(!(fwrite($fb,$msg))){
            fclose($fb);
        }
        fclose ($fb);
    }
    public static function info($msg){
        self::console($msg,self::LOG_INFO);
    }
    public static function error($msg){
        self::console($msg,self::LOG_ERROR);
    }
    public static function debug($msg){
        self::console($msg,self::LOG_DEBUG);
    }
    public static function main($msg){
        self::console($msg,self::LOG_MAIN);
    }
}

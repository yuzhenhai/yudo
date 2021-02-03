<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Multi_log {
    private $dir = './log/';
    const LOG_INFO  = ' INFO';
    const LOG_ERROR = ' ERROR';
    const LOG_DEBUG = ' DEBUG';
    const LOG_MAIN  = ' MAIN';
    private function console($msg,$status){
        if(!isset($msg)){
            return false;
        }
        $logdir = $this->dir.date('Ymd',time()).'.txt';
        if(!file_exists($logdir)){
            fopen($logdir,"a+");
        }

        $logHead = '['.date('Y-m-d h:i:s',time()).$status.']: ';
        if(is_array($msg) || is_object($msg)){
            file_put_contents($logdir, $logHead,FILE_APPEND);
        }else{
            $msg = $logHead.$msg."\r\n";
        }
        file_put_contents($logdir, print_r($msg, true),FILE_APPEND);
        return true;
    }
    private function write($file,$msg){

    }
    public  function info($msg){
        self::console($msg,self::LOG_INFO);
    }
    public function error($msg){
        self::console($msg,self::LOG_ERROR);
    }
    public function debug($msg){
        self::console($msg,self::LOG_DEBUG);
    }
    public function main($msg){
        self::console($msg,self::LOG_MAIN);
    }
}
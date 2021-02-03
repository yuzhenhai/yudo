<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @method static array upload(string $id , string $fileNm , string $localPath , string $ftpPath)
 */
class Ftp extends Facade {

    protected static function getFacadeAccessor(){
        return 'Ftp';
    }
}
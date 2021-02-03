<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @method static array resolveImageBySql(string $baseImage, string $dir , string $fileNm , string $MaxWidth , string $MaxHeight)
 * @method static array resolveImageByBase(string $baseImage, string $dir , string $fileNm , string $MaxWidth , string $MaxHeight)
 *
 */
class Img extends Facade {

    protected static function getFacadeAccessor(){
        return 'Img';
    }
}
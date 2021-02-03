<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @method static array geocoder(string $lng, string $lat) .经纬度解析
 * @method static array set_msg_model(string $modelNm,array $list) .设置短信模板
 * @method static array send_oa_msg(string $msg,string $empId) .发送OA消息
 * @method static array send_unicom_message(string $mobileNo) .发送短信
 * @method static array get_func(string $url) .get方法请求api
 * @method static array post_func(string $url ,array $param) .post方法请求api
 */
class Api extends Facade {

    protected static function getFacadeAccessor(){
        return 'Api';
    }
}
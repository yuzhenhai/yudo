<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
include 'Multi_apisetting.php';

class Multi_apiconsole extends Multi_apisetting{
    //设置post序列化
    private static $isJson = false;

    //发送联通短信配置信息
    private static $url          = 'http://sms.api.ums86.com:8899/sms/Api/Send.do';
    private static $businessId   = '217872';
    private static $businessUser = 'sz_ldwhsz';
    private static $businessPawd = 'yudo2015';
    private static $phoneHeader  = '';
    private static $fieldStop    = '1';
    private static $msgModel;

    //获取token配置参数
    private static $oaTokenUrl  = 'http://192.168.158.238:8899/seeyon/rest/token';
    private static $oaTokenUser = 'ERP';
    private static $oaTokenPawd = 'yudo2016';

    //发送OA致信消息
    private static $restUrl      = 'http://192.168.158.238:8899/seeyon/rest/message?token=';
    private static $restSendUser = 'M2015011';

    //百度GPS定位
    private static $gpsUrl       = 'http://api.map.baidu.com/geocoder/v2';
    private static $gpsKey       = 'NGQncXcBA5MOrjhXy80fWygXENcMPzvG';

    /**
     * @param string $url 接口地址
     * @param string $id  企业编号
     * @param string $user 企业账户
     * @param string $pawd 账户编号
     * @param string $phoneHeader 号码头部，比如0512
     * @param string $fieldStop 发送失败则全部中断，默认为忽略失败
     */
    public static function set_unicom_config($url='',$id='',$user='',$pawd='',$phoneHeader='',$fieldStop='')
    {
        !empty($url)  ? self::$url = $url : self::$url;
        !empty($id)   ? self::$businessId = $id : self::$businessId;
        !empty($user) ? self::$businessUser = $user : self::$businessUser;
        !empty($pawd) ? self::$businessPawd = $pawd : self::$businessPawd;
        !empty($phoneHeader) ? self::$phoneHeader = $phoneHeader : self::$phoneHeader;
        !empty($fieldStop) ? self::$fieldStop = $fieldStop : self::$fieldStop;
    }

    public static function set_rest_config($url='',$restSender=''){
        !empty($url)  ? self::$restUrl = $url : self::$restUrl;
        !empty($restSender)   ? self::$restSendUser = $restSender : self::$restSendUser;
    }

    public static function set_token_config($url='',$tokenUser='',$tokenPawd=''){
        !empty($url)  ? self::$oaTokenUrl = $url : self::$oaTokenUrl;
        !empty($tokenUserl)  ? self::$oaTokenUser = $tokenUser : self::$oaTokenUser;
        !empty($tokenPawd)   ? self::$oaTokenPawd = $tokenPawd : self::$oaTokenPawd;
    }

    public static function set_gps_config($gpsUrl='',$gpsKey=''){
        !empty($gpsUrl)  ? self::$gpsUrl = $gpsUrl : self::$gpsUrl;
        !empty($gpsKey)  ? self::$gpsKey = $gpsKey : self::$gpsKey;
    }

    /**
     * @param string $str 模板名称
     * @param array $list 插入内容
     */
    public static function set_msg_model($str,$list){
        switch ($str){
            case 'as':
                self::$msgModel = $list[0].'多次发生AS:'.$list[1];
                break;
        }
    }

    /**
     * @param array $phoneId 发送号码
     * @param string $send_time 发送时间格式yyyyMMddHHmmss
     */
    public static function send_unicom_message($phoneId,$send_time=''){
        if(empty(self::$msgModel)){
            return '未设置消息模板';
        }
        $str_serial = '0'.date('Ym',intval(time())).self::get_milli_second();
        $str_phone = '';
        foreach ($phoneId as $k => $v){
            $str_phone .= $v.',';
        }
        $str_phone = substr($str_phone,0,strlen($str_phone)-1);
        $post_data = array(
            'SpCode'          => self::$businessId,
            'LoginName'       => self::$businessUser,
            'Password'        => self::$businessPawd,
            'MessageContent'  => self::$msgModel,
            'UserNumber'      => $str_phone,
            'SerialNumber'    => $str_serial,
            'ScheduleTime'    => $send_time,
            'ExtendAccessNum' => self::$phoneHeader,
            'f'               => self::$fieldStop,
        );
        $i = '';
        foreach ($post_data as $k => $v )
        {
            $i.= "$k=" .$v. "&" ;
        }
        $post_data = substr($i,0,-1);
        print_r($post_data);
        return iconv("GB2312","UTF-8",self::post_func(self::$url,iconv("UTF-8","GB2312",$post_data)));
    }

    //给oa发送信息
    public static function send_oa_msg($str,$sendto){
        self::$isJson = true;
        return self::get_oa_token($str,$sendto,'call_rest_msg');
    }

    public static function get_gps($lat,$lng){
        $url = self::$gpsUrl.'/?location='.$lat.','.$lng.'&output=json&pois=1&ak='.self::$gpsKey;
        return json_decode(self::get_func($url));
    }

    //给OA账户发送信息
    private static function call_rest_msg($token,$str,$sendto){
        $url = self::$restUrl.$token;
        $post_data = array(
            'loginNames'   => $sendto,
            'senderLoginName'=> self::$restSendUser,
            'content'   => $str,
        );
        $post_data = json_encode($post_data);
        return self::post_func($url,$post_data);
    }

    //获取token，并且回调
    private static function get_oa_token($str,$sendto,$func){
        $post_data = array(
            'userName' => self::$oaTokenUser,
            'password' => self::$oaTokenPawd,
        );
        $post_data = json_encode($post_data);
        $token = json_decode(self::post_func(self::$oaTokenUrl,$post_data));
        //callback
        return call_user_func_array(array("Multi_apiConsole",$func),array($token->id,$str,$sendto));
    }

    private static function get_milli_second() {
        list($s1,$s2) = explode(' ', microtime());
        return (float)sprintf('%.0f', (floatval($s1)+floatval($s2)) * 1000);
    }

    private static function post_func($url='',$param ='')
    {
        if (empty($url) || empty($param)) {
            return false;
        }
        $postUrl  = $url;
        $curlPost = $param;
        $ch = curl_init();//初始化curl
        curl_setopt($ch, CURLOPT_URL,$postUrl);//抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        if(self::$isJson){
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
            ));
        }
        $data = curl_exec($ch);//运行curl
        curl_close($ch);
        return $data;
    }

    private static function get_func($url){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($curl);
        curl_close($curl);
        return $data;
    }




}

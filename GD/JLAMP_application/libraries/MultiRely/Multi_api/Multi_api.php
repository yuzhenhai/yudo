<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Multi_api {
    //设置post序列化
    private  $isJson = false;

    //发送联通短信配置信息
    private  $url          = 'http://sms.api.ums86.com:8899/sms/Api/Send.do';
    private  $businessId   = '217872';
    private  $businessUser = 'sz_ldwhsz';
    private  $businessPawd = 'yudo2015';
    private  $phoneHeader  = '';
    private  $fieldStop    = '1';
    private  $msgModel;

    //获取token配置参数
    private  $oaTokenUrl  = 'http://192.168.158.238:8899/seeyon/rest/token';
    private  $oaTokenUser = 'ERP';
    private  $oaTokenPawd = 'yudo2016';

    //发送OA致信消息
    private  $restUrl      = 'http://192.168.158.238:8899/seeyon/rest/message?token=';
    private  $restSendUser = 'M2015011';

    //百度GPS经纬度纠正
    private  $geoconvUrl = 'http://api.map.baidu.com/geoconv/v1';
    //百度GPS经纬度转换
    private  $geocoderUrl       = 'http://api.map.baidu.com/geocoder/v2';
    private  $gpsKey       = 'NGQncXcBA5MOrjhXy80fWygXENcMPzvG';

    /**
     * @param string $url 接口地址
     * @param string $id  企业编号
     * @param string $user 企业账户
     * @param string $pawd 账户编号
     * @param string $phoneHeader 号码头部，比如0512
     * @param string $fieldStop 发送失败则全部中断，默认为忽略失败
     */
    public  function set_unicom_config($url='',$id='',$user='',$pawd='',$phoneHeader='',$fieldStop='')
    {
        !empty($url)  ? $this->url = $url : $this->url;
        !empty($id)   ? $this->businessId = $id : $this->businessId;
        !empty($user) ? $this->businessUser = $user : $this->businessUser;
        !empty($pawd) ? $this->businessPawd = $pawd : $this->businessPawd;
        !empty($phoneHeader) ? $this->phoneHeader = $phoneHeader : $this->phoneHeader;
        !empty($fieldStop) ? $this->fieldStop = $fieldStop : $this->fieldStop;
    }

    public  function set_rest_config($url='',$restSender=''){
        !empty($url)  ? $this->restUrl = $url : $this->restUrl;
        !empty($restSender)   ? $this->restSendUser = $restSender : $this->restSendUser;
    }

    public  function set_token_config($url='',$tokenUser='',$tokenPawd=''){
        !empty($url)  ? $this->oaTokenUrl = $url : $this->oaTokenUrl;
        !empty($tokenUserl)  ? $this->oaTokenUser = $tokenUser : $this->oaTokenUser;
        !empty($tokenPawd)   ? $this->oaTokenPawd = $tokenPawd : $this->oaTokenPawd;
    }

    public  function set_gps_config($gpsUrl='',$gpsKey=''){
        !empty($gpsUrl)  ? $this->gpsUrl = $gpsUrl : $this->gpsUrl;
        !empty($gpsKey)  ? $this->gpsKey = $gpsKey : $this->gpsKey;
    }

    /**
     * @param string $str 模板名称
     * @param array $list 插入内容
     */
    public  function set_msg_model($str,$list){
        switch ($str){
            case 'as':
                $this->msgModel = $list[0].'多次发生AS:'.$list[1];
                break;
        }
    }

    /**
     * @param array $phoneId 发送号码
     * @param string $send_time 发送时间格式yyyyMMddHHmmss
     */
    public  function send_unicom_message($phoneId,$send_time=''){
        if(empty($this->msgModel)){
            return '未设置消息模板';
        }
        $str_serial = '0'.date('Ym',intval(time())).self::get_milli_second();
        $str_phone = '';
        foreach ($phoneId as $k => $v){
            $str_phone .= $v.',';
        }
        $str_phone = substr($str_phone,0,strlen($str_phone)-1);
        $post_data = array(
            'SpCode'          => $this->businessId,
            'LoginName'       => $this->businessUser,
            'Password'        => $this->businessPawd,
            'MessageContent'  => $this->msgModel,
            'UserNumber'      => $str_phone,
            'SerialNumber'    => $str_serial,
            'ScheduleTime'    => $send_time,
            'ExtendAccessNum' => $this->phoneHeader,
            'f'               => $this->fieldStop,
        );
        $i = '';
        foreach ($post_data as $k => $v )
        {
            $i.= "$k=" .$v. "&" ;
        }
        $post_data = substr($i,0,-1);
        print_r($post_data);
        return iconv("GB2312","UTF-8",self::post_func($this->url,iconv("UTF-8","GB2312",$post_data)));
    }

    //给oa发送信息
    public  function send_oa_msg($str,$sendto){
        $this->isJson = true;
        return self::get_oa_token($str,$sendto,'call_rest_msg');
    }
    private  function geoconv(&$lng,&$lat){
        $url = $this->geoconvUrl.'/?coords='.$lng.','.$lat.'&from=1&to=5&ak='.$this->gpsKey;
        $res = json_decode(self::get_func($url));
        $lng = $res->result[0]->x;
        $lat = $res->result[0]->y;
    }

    public  function geocoder($lng,$lat){
        $this->geoconv($lng,$lat);
        $url = $this->geocoderUrl.'/?location='.$lat.','.$lng.'&output=json&pois=1&ak='.$this->gpsKey;
        return json_decode(self::get_func($url));
    }

    //给OA账户发送信息
    private  function call_rest_msg($token,$str,$sendto){
        $url = $this->restUrl.$token;
        $post_data = array(
            'loginNames'   => $sendto,
            'senderLoginName'=> $this->restSendUser,
            'content'   => $str,
        );
        $post_data = json_encode($post_data);
        return self::post_func($url,$post_data);
    }

    //获取token，并且回调
    private  function get_oa_token($str,$sendto,$func){
        $post_data = array(
            'userName' => $this->oaTokenUser,
            'password' => $this->oaTokenPawd,
        );
        $post_data = json_encode($post_data);
        $token = json_decode(self::post_func($this->oaTokenUrl,$post_data));
        //callback
        return call_user_func_array(array("Multi_api",$func),array($token->id,$str,$sendto));
    }

    private  function get_milli_second() {
        list($s1,$s2) = explode(' ', microtime());
        return (float)sprintf('%.0f', (floatval($s1)+floatval($s2)) * 1000);
    }

    public function post_func($url='',$param ='')
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
        if($this->isJson){
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
            ));
        }
        $data = curl_exec($ch);//运行curl
        curl_close($ch);
        return $data;
    }

    public function get_func($url){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($curl);
        curl_close($curl);
        return $data;
    }




}

<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * 클래스명: Menu
 * 작성자: 김영탁
 * 클래스설명: 영업집계표(일) 클래스
 *
 * 최초작성일: 2017.11.10
 * 최종수정일: 2017.11.10
 * ---
 * Date         Auth        Desc
 */
class Wang extends JLAMP_Controller
{
    public $imageServer = 'https://i.pinimg.com/originals/';
    public $nowNetNm = 'bigbigwork.com';
    function __construct()
    {
        parent::__construct();
    }
    public function index(){
        $this->jlamp_tp->setURLType(array(
            'tpl' => 'Wang.html'
        ));
    }
    public function reptile(){
        $url = $this->jlamp_comm->xssInput('url', 'get');
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_ENCODING, 'gzip');
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.131 Safari/537.36');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $data = curl_exec($curl);
        curl_close($curl);
        $data = $this->cleanhtml($data);
        $this->jlamp_comm->jsonEncEnd(array('data' => $data));
    }
    public function cleanhtml($str){
        $preg = '<img.*?src="(.*?)">';
        preg_match_all($preg, $str,$imgArr);
        $oldImage = $imgArr[1][0];
        $netLen = strpos($imgArr[1][0],$this->nowNetNm);
        $pictrolUrl = substr($imgArr[1][0],$netLen+20);
        $len = strpos($pictrolUrl,'jpg');
        if($len == 0){
            $len = strpos($pictrolUrl,'png');
        }
        $newImage = $this->imageServer.substr($pictrolUrl,0,(int)$len+3);
        $res = array($oldImage,$newImage);
        return $res;
    }
}


//$cookie  = 'mediav=%7B%22eid%22%3A%22403890%22%2C%22ep%22%3A%22%22%2C%22vid%22%3A%22_u5oe
//                    j%24%24X%5B%3Agv)IMHaGL%22%2C%22ctn%22%3A%22%22%7D; Qs_lvt_147946=1547691976;
//                    Hm_lvt_d24dcf008a97469875a4da33090711f9=1547691976; _ga=GA1.2.218278146.1547691977;
//                    RedEnvelope=true; JSESSIONID=084A65472CF94E5DC8DD31515E5F8B41; number=3408302;
//                    mediav=%7B%22eid%22%3A%22403890%22%2C%22ep%22%3A%22%22%2C%22vid%22%3A%22_u5oej%24%24X%5B%3Agv)IMHaGL%22%2C%22ctn%22%3A%22%22%7D;
//                    _gat=1; _gid=GA1.2.1910920027.1547695843;
//                    Qs_pv_147946=3875429127023455000%2C2299523268709509000%2C570174622871104100%2C4425533256060547600%2C1742993269452655000;
//                    Hm_lpvt_d24dcf008a97469875a4da33090711f9=1547695843';
//$header = array(
//    'Accept'     => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
//    'Connection' => 'keep-alive',
//    'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36',
//    'Host'       => 'www.bigbigwork.com',
//    'Accept-Encoding' => 'gzip, deflate',
//    'Accept-Language' => 'zh-CN,zh;q=0.9'
//);

//curl_setopt($curl, CURLOPT_COOKIE,$cookie);

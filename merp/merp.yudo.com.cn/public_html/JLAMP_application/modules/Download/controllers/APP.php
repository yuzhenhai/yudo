<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * 클래스명: WEI_1200
 * 작성자: 김목영
 * 클래스설명: 영업집계표(년) 클래스
 *
 * 최초작성일: 2017.11.13
 * 최종수정일: 2017.11.13
 * ---
 * Date         Auth        Desc
 */
class APP extends JLAMP_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    public function sz(){
        $this->jlamp_comm->isHtmlDisplay(true);
        $this->jlamp_tp->setURLType(array(
            'tpl' => 'SZ.html'
        ));
    }
    public function gd(){
        $this->jlamp_comm->isHtmlDisplay(true);
        $this->jlamp_tp->setURLType(array(
            'tpl' => 'GD.html'
        ));
    }
    public function qd(){
        $this->jlamp_comm->isHtmlDisplay(true);
        $this->jlamp_tp->setURLType(array(
            'tpl' => 'QD.html'
        ));
    }
    public function downloadFile()
    {
        $device = $this->jlamp_comm->xssInput('device', 'get');
        $area = $this->jlamp_comm->xssInput('area', 'get');
        if($device == 'ios'){
            $fileType = '.ipa';
        }else if($device == 'android'){
            $fileType = '.apk';
        }else{
            echo 'device error';
            exit();
        }
        switch ($area){
            case 'sz':
                $filename = 'YudoMobile';
                break;
            case 'gd':
                $filename = 'GDYudoMobile';
                break;
            case 'dev':
                $filename = 'DevYudoMobile';
                break;
            case 'qd':
                $filename = 'QDYudoMobile';
                break;
        }
        $filename = $filename.$fileType;
        $dir = './file/'.$area.'YudoApp/'.$device.'/'.$filename;
        $fileOpen = fopen($dir,"r");
        $fileSize = round(filesize($dir) / 1024 * 100) / 100;
        header("Content-Type: application/octet-stream");
        header("Accept-Ranges: bytes");
            header('Content-Disposition: attachment; filename="'. $filename.'"');
        header("Content-Length: ".$fileSize);
//        print_r($fileSize);
        echo fread($fileOpen,$fileSize);
        fclose($fileOpen);
    }

}
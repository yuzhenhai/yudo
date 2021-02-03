<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
include_once "ftpConn.php";
class Multi_downimage {
    /**
     * @var 本地根目录
     */
    private $local_dirclass;

    /**
     * @var FTP根目录
     */
    private $ftp_dirclass;

    /**
     * @var 当前ID,订单号，组装号...
     */
    private $id;

    private $dirname_year;
    private $dirname_month;
    private $dirname_defualt;
    /**
     * Multi_downimage constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param $fun 二级文件夹名
     * @param $as_array 照片流(必须为对象)
     * @return string
     */
    public function image_down($fun,&$as_array)
    {
        $image = new Image();
        if (count($as_array) <= 0) {
            return 'null';
        }
        $config = $GLOBALS["JLAMPConfig"];
        $conn = ftp_connect($config->ftp->addr,$config->ftp->port,10);
        ftp_login($conn,$config->ftp->username,$config->ftp->password);
        foreach ($as_array as $k => &$v) {
            $filename = $v->FileNm;
            $yeardir = "./image/uploads/$this->local_dirclass/$fun/$this->dirname_defualt/$this->id";
            if (!is_dir($yeardir)) {
                mkdir(iconv("UTF-8", "GBK", $yeardir), 0775, true);
            }
            //如果本地没有当前图片，则通过数据库或者ftp下载
            if (!is_file($yeardir . "/$filename")) {
                $filenameGbk = mb_convert_encoding($filename, 'GBK', 'UTF-8');
                if ($v->FTP_UseYn == 'Y' || property_exists($v, 'FTP_UseYn') == false) {
//                    try {
//
                        if (!ftp_get($conn, "$yeardir/$filename","/$this->ftp_dirclass/$fun/$this->dirname_year/$this->dirname_month/$this->id/$filenameGbk", FTP_BINARY)) {
                            continue;
                        }
//                    } catch (Exception $e) {
//                        continue;
//                    }
                } else {
                    if (!empty($v->Photo && $v->Photo != null) && property_exists($v, 'Photo')) {
                        $imageResource = imagecreatefromstring($v->Photo); // 创建image
                        imagejpeg($imageResource, $yeardir . '/' . $filename); // 写入文件
                        $image->open($yeardir . '/' . $filename);
                        $image->thumb(576, 1024);
                        $image->save($yeardir . '/' . $filename);
                        $imageResource = null;
                    }
                }
            }
            $v->imagedir = substr($yeardir . '/' . $filename, 1);
        }
        ftp_close($conn);
        return $as_array;
    }

    public function downloadFile($dirNm,&$fileList){
        $image = new Image();
        if (count($fileList) <= 0) {
            return 'null';
        }
        foreach ($fileList as $k => &$v) {
            $filename = $v->FileNm;
            $yeardir = "./image/uploads/$this->local_dirclass/$dirNm/$this->dirname_defualt/$this->id";
            if (!is_dir($yeardir)) {
                mkdir(iconv("UTF-8", "GBK", $yeardir), 0775, true);
            }
            //.如果图片存放在数据库则解析生成
            if (property_exists($v, 'FTP_UseYn') == true && $v->FTP_UseYn != 'Y' ) {
                if (!empty($v->Photo && $v->Photo != null) && property_exists($v, 'Photo')) {
                    //.如果本地不存在才解析，存在图片则直接返回路径
                    if (!is_file($yeardir . "/$filename")) {
                        $imageResource = imagecreatefromstring($v->Photo); // 创建image
                        imagejpeg($imageResource, $yeardir . '/' . $filename); // 写入文件
                        $image->open($yeardir . '/' . $filename);
                        $image->thumb(576, 1024);
                        $image->save($yeardir . '/' . $filename);
                        $imageResource = null;
                    }
                }
                $v->imagedir = substr($yeardir . '/' . $filename, 1);
            //.如果图片存放在ftp则直接返回路径
            } else{
                $v->imagedir = "/image/erpfile/$this->ftp_dirclass/$dirNm/$this->dirname_year/$this->dirname_month/$this->id/$filename";
            }
        }
        return $fileList;
    }

    public function id($id){
        $this->id = $id;
        return $this;
    }

    public function localdir($dir){
        $this->local_dirclass = $dir;
        $this->dirname_year = substr($this->id,0,4);
        $this->dirname_month = substr($this->id,4,2);
        $this->dirname_defualt = substr($this->id,0,6);
        return $this;
    }

    public function ftpdir($dir){
        $this->ftp_dirclass = $dir;
        return $this;
    }
}
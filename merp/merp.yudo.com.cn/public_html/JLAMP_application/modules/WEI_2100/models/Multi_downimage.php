<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class As10_model extends JLAMP_Model {

    public static $ftp = '192.168.158.240';
    public static $usernm = 'yudoerpftp1';
    public static $passwd = '03677yrR';
    public $local_dirclass = '';
    public $ftp_dirclass = '';

    private $id = '';
    private $dirname_year;
    private $dirname_month;
    private $dirname_defualt;

    public function __construct()
    {
        $this->dirname_year = substr($this->id,0,4);
        $this->dirname_month = substr($this->id,4,2);
        $this->dirname_defualt = substr($this->id,0,6);
    }

    public function id($id){
        $this->id = $id;
        return $this;
    }

    public function localdir($dir){
        $this->local_dirclass = $dir;
        return $this;
    }

    public function ftpdir($dir){
        $this->ftp_dirclass = $dir;
        return $this;
    }

    public function image_down($fun,$as_array){ //ASReceipt
        $image = new Image();
        if(count($as_array) <= 0)
        {
            Log::info($fun.' Database image is null');
            return 'null';
        }
        $conn = ftp_connect(self::$ftp);
        ftp_login($conn,self::$usernm,self::$passwd);
        ftp_pasv($conn,true);
        foreach ($as_array as $k => $v){
            $filename = $v->FileNm;
            $yeardir = "./image/uploads/mt/$fun/$this->dirname_defualt/$this->id";
            if (!is_dir($yeardir)) {
                mkdir(iconv("UTF-8", "GBK", $yeardir), 0775, true);
            }
            //如果本地没有当前图片，则通过数据库或者ftp下载
            if(!is_file($yeardir."/$filename")) {

                if ($v->FTP_UseYn == 'Y') {
                    $exist_dir = ftp_nlist($conn, ftp_pwd($conn) . "/$this->ftp_dirclass/$fun/$this->dirname_year/$this->dirname_month/$this->id");
                    if (in_array($filename, $exist_dir)) {
                        if (!ftp_get($conn, "$yeardir/$filename", ftp_pwd($conn) . "/$this->ftp_dirclass/$fun/$this->dirname_year/$this->dirname_month/$this->id/$filename", FTP_BINARY)) {
                            return false;
                        }
                    }
                }
                else {
                    if(!empty($v->Photo && $v->Photo != null))
                    {
                        $imageResource = imagecreatefromstring($v->Photo); // 创建image
                        imagejpeg($imageResource, $yeardir. '/' . $filename); // 写入文件
                        $image->open($yeardir . '/' . $filename);
                        $image->thumb(576, 1024);
                        $image->save($yeardir . '/' . $filename);
                        $imageResource = null;
                    }
                }
            }
        }
        ftp_close($conn);
    }
}
<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
include_once 'ftpConn.php';
class Multi_saveimage extends JLAMP_Controller {
    const FTP_ERROR    = 'FTP-ERROR';

    const UPLOAD_ERROR = 'UPLOAD-ERROR';

    const SUCCESS      = 'SUCCESS';

    public static $uploadSize  = 300000;
    public static $uploadType  = 'gif|jpg|png|jpeg';
    public static $miniPictrol = false;
    public static $miniWidth   = 80;
    public static $miniHeight  = 80;
    /**
     * @var 错误标识
     */
    private $error = false;
    /**
     * @var doupload方法返回值
     */
    private $upload_return ;
    /**
     * @var FTP根目录
     */
    private $ftp_dirclass;
    /**
     * @var FTP子目录名称
     */
    private $ftp_dirclass_c;
    /**
     * @var 当前ID,订单号，组装号...
     */
    private $id;
    /**
     * @var 本地文件路径
     */
    private $relative_path;
    /**
     * @var 本地文件名
     */
    private $fileNm;
    /**
     * @var array 返回参数
     */
    private $this_return = array();

    private $dirname_year;
    private $dirname_month;
    public function __construct()
    {
        parent::__coustruct();
        //调用方法： $saveimage->id(id)->localdir(upload方法返回数组)->ftpdir(ftp根目录，ftp子目录)->upload_server()->upload_ftp();
    }

    /**
     * @return $this
     */
    public function upload_server($file){
        try{
            $path = "/image/uploads/$this->ftp_dirclass/$this->ftp_dirclass_c/".$this->dirname_year.$this->dirname_month."/";
            $this->jlamp_upload->setDefaultPath($path);
            $this->jlamp_upload->setOverWrite(false);
            $times = 'M'.date('Ymdhis',intval(time()));
            $this->jlamp_upload->setFilename($times.rand(100,999));
            $this->jlamp_upload->setAllowType(self::$uploadType);
            $this->jlamp_upload->setUploadFileSize(self::$uploadSize);
            $this->jlamp_upload->getError();
            $res = $this->jlamp_upload->doUpload($file,$this->id,false,self::$miniPictrol,self::$miniWidth,self::$miniHeight);
            $recall = array(str_replace(ftpConn::$localFile,'',$res['upload_data']['full_path']),$res['upload_data']['file_name']);
            if(isset($recall) && !empty($recall))
            {
                $this->relative_path = $recall[0];
                $this->fileNm = $recall[1];
                return $this;
            }
            else
            {
                $this->error = true;
                return $this;
            }
        }
        catch (Exception $e){
            $this->error = true;
            return $this;
        }
    }

    /**
     * @return string
     */
    public function upload_ftp(){
        if($this->error){
            $this->this_return['returnCode'] = self::UPLOAD_ERROR;
            return $this->this_return;
        }
        $conn = ftp_connect(ftpConn::$ftp,ftpConn::$port);
        ftp_login($conn,ftpConn::$usernm,ftpConn::$passwd);
        ftp_pasv($conn,true);
        //ftp根目录
        $ftpsrc = "/$this->ftp_dirclass/$this->ftp_dirclass_c";
        $exist_dir = ftp_rawlist($conn,ftp_pwd($conn)."$ftpsrc");
        //检测年
        foreach ($exist_dir as $k => $v){
            $exist_dir[$k] =    substr($v,-4,4);
        }
        if(!in_array($this->dirname_year,$exist_dir)){
            if(!ftp_mkdir($conn, ftp_pwd($conn)."$ftpsrc/$this->dirname_year")){
                $this->this_return['returnCode'] = self::FTP_ERROR;
                return $this->this_return;
            }
        }
        //检测月
        $exist_dir = ftp_rawlist($conn,ftp_pwd($conn)."$ftpsrc/$this->dirname_year");
        foreach ($exist_dir as $k => $v){
            $exist_dir[$k] =    substr($v,-2,2);
        }
        if(!in_array($this->dirname_month,$exist_dir)){
            if(!ftp_mkdir($conn, ftp_pwd($conn)."$ftpsrc/$this->dirname_year/$this->dirname_month")){
                $this->this_return['returnCode'] = self::FTP_ERROR;
                return $this->this_return;
            }
        }
        //检测编号文件夹
        $exist_dir = ftp_rawlist($conn,ftp_pwd($conn)."$ftpsrc/$this->dirname_year/$this->dirname_month");
        $ftpFileCnt = strlen($this->id); //计算单号长度，取ftp文件夹名
        foreach ($exist_dir as $k => $v){
            $exist_dir[$k] =    substr($v,-$ftpFileCnt,$ftpFileCnt);
        }
        if(!in_array($this->id,$exist_dir)){
            if(!ftp_mkdir($conn, ftp_pwd($conn)."$ftpsrc/$this->dirname_year/$this->dirname_month/$this->id")) {
                $this->this_return['returnCode'] = self::FTP_ERROR;
                return $this->this_return;
            }
        }
        ftp_chdir($conn, ftp_pwd($conn)."$ftpsrc/$this->dirname_year/$this->dirname_month/$this->id");
        $result = ftp_put($conn, $this->fileNm,ftpConn::$localFile.$this->relative_path, FTP_BINARY);
        ftp_close($conn);
        $this->this_return['returnCode'] = self::SUCCESS;
        $this->this_return['fileNm']  = $this->fileNm;
        $this->this_return['relativePath'] = $this->relative_path;
        return $this->this_return;
    }

    /**
     * @array $dir
     * @return $this
     */
//    public function localdir($dir){
//        $this->upload_return = $dir;
//        return $this;
//    }

    /**
     * @param $id
     * @return $this
     */
    public function id($id){
        $this->id = $id;
        $this->dirname_year = substr($this->id,0,4);
        $this->dirname_month = substr($this->id,4,2);
        return $this;
    }

    /**
     * @string $dir   根目录
     * @string $dir_c 二级目录
     * @return $this
     */
    public function ftpdir($dir,$dir_c){
        $this->ftp_dirclass = $dir;
        $this->ftp_dirclass_c = $dir_c;
        return $this;
    }


}
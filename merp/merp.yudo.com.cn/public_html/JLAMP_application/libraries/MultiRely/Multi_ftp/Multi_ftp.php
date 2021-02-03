<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
class Multi_ftp {
    const FTP_ERROR    = 'FTP-ERROR';

    const UPLOAD_ERROR = 'UPLOAD-ERROR';

    const NO_FILE      = 'NO-FILE';

    const SUCCESS      = 'SUCCESS';

    private $returnArray = [
        'modelData' => '',
        'modelMsg'  => ''
    ];
    
    public function upload($id,$fileNm,$localPath,$ftpPath){
        //.connect ftp
        $config = $GLOBALS["JLAMPConfig"];

        $localPath = substr($localPath,1,strlen($localPath)-1);

        $conn = ftp_connect($config->ftp->addr,$config->ftp->port);
        ftp_login($conn,$config->ftp->username,$config->ftp->password);
        ftp_pasv($conn,true);

        //.dir
        $dirYear = substr($id,0,4);
        $dirMonth = substr($id,4,2);

        //访问ftp根目录
        $exist_dir = ftp_rawlist($conn,ftp_pwd($conn)."$ftpPath");

        //检测年
        foreach ($exist_dir as $k => $v){
            $exist_dir[$k] =    substr($v,-4,4);
        }
        if(!in_array($dirYear,$exist_dir)){
            if(!ftp_mkdir($conn, ftp_pwd($conn)."$ftpPath/$dirYear")){
                $this->returnArray['modelMsg'] = self::FTP_ERROR;
                return $this->returnArray;
            }
        }

        //检测月
        $exist_dir = ftp_rawlist($conn,ftp_pwd($conn)."$ftpPath/$dirYear");
        foreach ($exist_dir as $k => $v){
            $exist_dir[$k] =    substr($v,-2,2);
        }
        if(!in_array($dirMonth,$exist_dir)){
            if(!ftp_mkdir($conn, ftp_pwd($conn)."$ftpPath/$dirYear/$dirMonth")){
                $this->modelMsg['modelMsg'] = self::FTP_ERROR;
                return $this->modelMsg;
            }
        }
        //检测编号文件夹
        $exist_dir = ftp_rawlist($conn,ftp_pwd($conn)."$ftpPath/$dirYear/$dirMonth");
        $ftpFileCnt = strlen($id); //计算单号长度，取ftp文件夹名
        foreach ($exist_dir as $k => $v){
            $exist_dir[$k] =    substr($v,-$ftpFileCnt,$ftpFileCnt);
        }
        if(!in_array($id,$exist_dir)){
            if(!ftp_mkdir($conn, ftp_pwd($conn)."$ftpPath/$dirYear/$dirMonth/$id")) {
                $this->returnArray['modelMsg'] = self::FTP_ERROR;
                return $this->returnArray;
            }
        }

        if(!file_exists($config->ftp->localFile.$localPath)){
            $this->returnArray['modelMsg'] = self::NO_FILE;
            return $this->returnArray;
        }
        ftp_chdir($conn, ftp_pwd($conn)."$ftpPath/$dirYear/$dirMonth/$id");

        //. ftp_put(连接句柄,上传到ftp后文件命名,本地文件具体路径+文件名)
        $result = ftp_put($conn, $fileNm,$config->ftp->localFile.$localPath.'/'.$fileNm, FTP_BINARY);
        ftp_close($conn);
        $this->returnArray['modelMsg'] = self::SUCCESS;
        $this->returnArray['fileNm']  = $fileNm;
        $this->returnArray['localPath'] = $localPath;
        return $this->returnArray;
    }

}
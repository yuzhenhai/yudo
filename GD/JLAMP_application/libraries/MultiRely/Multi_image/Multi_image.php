<?php
class Multi_image {
    private $returnArray = [
        'dir' => '',
        'fileNm' => '',
        'path'   => '',
    ];

    public function resolveImageBySql($baseImage,$dir,$fileNm,$MaxWidth,$MaxHeight){
        if (!is_dir($dir)) {
            mkdir(iconv("UTF-8", "GBK", $dir), 0775, true);
        }
        $image = new Image();
        $imageResource = imagecreatefromstring($baseImage); // 创建image
        imagejpeg($imageResource, $dir. '/' . $fileNm); // 写入文件
        $image->open($dir . '/' . $fileNm);
        $image->thumb($MaxWidth,$MaxHeight);
        $image->save($dir . '/' . $fileNm);

        $this->returnArray['dir'] = $dir;
        $this->returnArray['fileNm'] = $fileNm;
        $this->returnArray['path'] = $dir.'/'.$fileNm;
        return $this->returnArray;
    }
    public function resolveImageByBase($baseImage,$dir,$fileNm,$MaxWidth,$MaxHeight){
        $baseImage   = str_replace(' ', '+',$baseImage);
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $baseImage, $result)) {
            $type = $result[2];
            $type == 'jpeg'?$type = 'jpg':$type;
            $fileNm = "$fileNm.{$type}";
        }

        if (!is_dir($dir)) {
            mkdir(iconv("UTF-8", "GBK", $dir), 0775, true);
        }
        file_put_contents($dir.'/'.$fileNm,base64_decode(str_replace($result[1], '', $baseImage)));
        $image = new Image();
        $image->open($dir . '/' . $fileNm);
        $image->thumb($MaxWidth,$MaxHeight);
        $image->save($dir . '/' . $fileNm);

        $this->returnArray['dir'] = $dir;
        $this->returnArray['fileNm'] = $fileNm;
        $this->returnArray['path'] = $dir.'/'.$fileNm;
        return $this->returnArray;
    }

}
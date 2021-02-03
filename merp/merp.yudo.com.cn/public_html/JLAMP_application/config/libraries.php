<?php defined('BASEPATH') OR exit('No direct script access allowed');
return [
    //.facades
    'Facade' => [
        DB::class,
        Logger::class,
        Api::class,
        Img::class,
        Ftp::class
    ],

    //.依赖包
    'MultiRely' => [
        'DB'    => Multi_db::class,
        'Log'   => Multi_log::class,
        'Api'   => Multi_api::class,
        'Img'   => Multi_image::class,
        'Ftp'   => Multi_ftp::class
    ],
];
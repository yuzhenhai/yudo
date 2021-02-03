<?php /* Template_ 2.2.6 2019/01/17 18:24:19 /home/merp.yudo.com.cn/public_html/JLAMP_application/modules/Menu/views/Wang.html 000004622 */ ?>
<!DOCTYPE html>
<html lang="en" style="height: 100%">
<head>
    <meta charset="UTF-8">
    <title>肖翌的私人爬虫</title>
    <link rel="stylesheet" href="/css/mui.min.css?v=1008">
    <script type="text/javascript" src="/third_party/jquery-2.1.4/jquery.js"></script>
    <script>var jq = $.noConflict();</script>
    <script src="/js/mui.min.js?v=1001"></script>
    <script src="/js/multiHttp.js?v=1001"></script>
    <script src="/js/Menu/clipboard.js"></script>
    <style type="text/css">
        /*----------------mui.showLoading---------------*/
        .mui-show-loading {
            position: fixed;
            padding: 5px;
            width: 120px;
            min-height: 120px;
            top: 45%;
            left: 50%;
            margin-left: -60px;
            background: rgba(0, 0, 0, 0.6);
            text-align: center;
            border-radius: 5px;
            color: #FFFFFF;
            visibility: hidden;
            margin: 0;
            z-index: 2000;
            -webkit-transition-duration: .2s;
            transition-duration: .2s;
            opacity: 0;
            -webkit-transform: scale(0.9) translate(-50%, -50%);
            transform: scale(0.9) translate(-50%, -50%);
            -webkit-transform-origin: 0 0;
            transform-origin: 0 0;
        }
        .mui-show-loading.loading-visible {
            opacity: 1;
            visibility: visible;
            -webkit-transform: scale(1) translate(-50%, -50%);
            transform: scale(1) translate(-50%, -50%);
        }
        .mui-show-loading .mui-spinner{
            margin-top: 24px;
            width: 36px;
            height: 36px;
        }
        .mui-show-loading .text {
            line-height: 1.6;
            font-family: -apple-system-font,"Helvetica Neue",sans-serif;
            font-size: 14px;
            margin: 10px 0 0;
            color: #fff;
        }

        .mui-show-loading-mask {
            position: fixed;
            z-index: 1000;
            top: 0;
            right: 0;
            left: 0;
            bottom: 0;
        }
        .mui-show-loading-mask-hidden{
            display: none !important;
        }
        /*-----------------end-----------------------*/
    </style>
</head>
<body style="width: 100%;height: 100%;min-width: 800px;">
<div style="width: 100%;height: 100%;padding: 50px 20%">
    <div style="width: 100%;height: 100%;position: relative">
        <input style="width: 80%" type="text" id="data">
        <button class="mui-btn-danger" style="height: 38px;width: 19%;margin-bottom: 20px" onclick="getUrl()">抓取地址</button>
        <div style="font-size: 14px;color: #6d6d6d">图片下载地址:</div>
        <div id="result" style="overflow-y: auto;position: absolute;bottom: 0px;top: 80px;width: 100%;background-color: #f5f5f5;border: 1px solid #afafaf">
        </div>
    </div>
</div>

</body>
<script>
    function getUrl() {
        if(jq('#data').val() == ''){
            mui.alert('不要乱点','leon');
            return false;
        }
        var params = {};
        params.url = jq('#data').val();
        mui.showLoading('爬取中...','div');
        http.get('/Menu/Wang/reptile',params,function (res) {
            console.log(res);
            mui.hideLoading();
            if(res.data == ''){
                jq('#result').html('<div>------------没查找到数据-------------</div>');
            }else{
                var yin = "'";
                var nr = '<div style="width: 100%;display: flex;justify-content: center;flex-wrap: wrap;">' +
                    '<div style="width: 100%;display: flex;justify-content: center;"><img height="150px" src="'+res.data[0]+'"></div>' +
                    '<div style="cursor:pointer;color: red" data-clipboard-action="'+res.data[1]+'" data-clipboard-target="#'+res.data[1]+'">'+res.data[1]+'</div>' +
                    '</div>';
                jq('#result').append(nr);
                var clipboard = new Clipboard('#'+res.data[1]);
                clipboard.on('success', function (e) {
                    mui.alert("复制成功！",'leon');
                });
                clipboard.on('error', function (e) {
                    mui.alert("对不起，您的浏览器暂不支持一键复制功能！",'leon');
                });

            }
        })
    }
</script>
</html>
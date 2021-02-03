<?php /* Template_ 2.2.6 2019/02/21 10:07:17 /home/merp.yudo.com.cn/public_html/JLAMP_application/modules/Download/views/SZ.html 000003627 */ ?>
<!DOCTYPE HTML>
<html>
<head>
    <title>
        yudo erp download
    </title>
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!--css-->
    <link rel="stylesheet" href="/css/yudo-ui.css?v=1063">
    <link rel="stylesheet" href="/css/mui.min.css?v=1008">
    <link rel="stylesheet" href="/css/mui.picker.min.css">
    <!--jquery vue-->
    <script type="text/javascript" src="/third_party/jquery-2.1.4/jquery.js"></script>
    <script>var jq = $.noConflict();</script>
    <!--mui echarts multi fastclick-->
    <script src="/js/mui.min.js?v=1001"></script>
    <script src="/js/multiHttp.js?v=1001"></script>
    <script type="text/javascript" src="/js/fastclick.js"></script>
    <!--jlamp-->
    <script type="text/javascript" src="/js/JLAMP.polyfill.min.js"></script>
    <script type="text/javascript" src="/js/JLAMP.min.js"></script>
    <script type="text/javascript" src="/js/JLAMP.common.min.js"></script>
    <script type="text/javascript" src="/js/JLAMP.menu.min.js"></script>
    <script type="text/javascript" src="/js/JLAMP.autobinding.min.js"></script>
    <script type="text/javascript" src="/js/JLAMP.modal.min.js"></script>
    <script type="text/javascript" src="/js/JLAMP.lang.min.js"></script>
    <script type="text/javascript" src="/js/session.js"></script>
    <script type="text/javascript" src="/js/version.js?v=20180920001"></script>

    <script type="text/javascript" src="/js/common.js"></script>
    <script type="text/javascript" src="/js/GNB.js"></script>
</head>
<body>
<div class="yudo-content" id="leon">
    <div class="yudo-window">
        <div class="center-ios" id="centerControl" style="background: white;">
            <div style="width: 100%;text-align: center"><img id="imgTopLogo" src="/image/login_logo.png" border="0" alt="top logo" style="width: 140px;margin-top: 8px" class="topLogo"></div>
            <div style="width: 100%;text-align: center;font-size: 12px;color: #aeaeae">SZ YUDO ERP&nbsp;&nbsp;</div>
            <div class="menus" style="padding: 0 20%">
                <button onclick="android();" type="button" class="layui-btn layui-btn-primary menu-btn" style="padding-top: 2px">
                    <span  style="position: relative;font-weight: 700">android</span>
                </button>
                <button onclick="ios();" type="button" class="layui-btn layui-btn-primary menu-btn" style="padding-top: 2px">
                    <span  style="position: relative;font-weight: 700">ios</span>
                </button>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    function android() {
        mui.showLoading('loading...','div');
        location.href = '/Download/APP/downloadFile?device=android&area=sz';//http://dev.merp.yudo.com.cn:8186/file/szYudoApp/android/YudoMobile.apk
        setTimeout(function () {
            mui.hideLoading();
        },2000)
    }
    function ios() {
        mui.showLoading('loading...','div');
        location.href = 'itms-services://?action=download-manifest&amp;url=https://www.jplatform.co.kr/ios/YudoMobile/YudoMobile.plist';
        setTimeout(function () {
            mui.hideLoading();
        },2000)
    }
</script>
</html>
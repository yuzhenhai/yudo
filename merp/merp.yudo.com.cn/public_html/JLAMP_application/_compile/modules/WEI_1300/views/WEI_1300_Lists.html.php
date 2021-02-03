<?php /* Template_ 2.2.6 2019/01/09 17:06:17 /home/merp.yudo.com.cn/public_html/JLAMP_application/modules/WEI_1300/views/WEI_1300_Lists.html 000009222 */ ?>
<!DOCTYPE HTML>
<html>
<head>
    <title>
        yudo erp
    </title>
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!--css-->
    <link rel="stylesheet" href="/css/yudo-ui.css?v=1065">
    <link rel="stylesheet" href="/css/mui.min.css?v=1008">
    <link rel="stylesheet" href="/css/mui.picker.min.css">
    <!--jquery vue-->
    <script type="text/javascript" src="/third_party/jquery-2.1.4/jquery.js"></script>
    <script>var jq = $.noConflict();</script>
    <script src="/js/vue.js"></script>
    <!--mui echarts multi fastclick-->
    <script src="/js/mui.min.js?v=1001"></script>
    <script src="/js/multiHttp.js?v=1001"></script>
    <script src="/js/echarts.min.js"></script>
    <script src="/js/lang.min.js?v=1001"></script>
    <script src="/js/mui.previewimage.js?v=201804261256"></script>
    <script src="/js/mui.zoom.js?v=201804231454"></script>
    <script src="/js/mui.picker.min.js?v=1001"></script>
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
    <div class="download-script" v-if="view.downLoadScript"></div>
    <div class="yudo-window" v-if="view.viewTargetMinute">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" id="backMenu">
                    <div class="left-icon icon-backmenu"></div>
                    <div class="left-text">$((lang.menuBack))</div>
                </div>
                <div class="header-center-btn" >$((lang.targetAndResults))</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="center-ios" id="centerControl" style="background: white;">
            <div class="info-search" style="height:80px">
                <div class="info-search-input" style="width: 75%">
                    <div class="write-input" @click="searchDate()" style="margin-top: 10px">
                        <div style="float:left;margin-top: 4px;display: inline-block;width: 25px;height: 25px" class="icon-date" ></div>
                        <div style="float:left;margin-top: 8px;margin-left: 15px;">$((salesTargetDate))</div>
                    </div>
                </div>
                <div class="search-btn" style="height: 90%;width: 25%;margin-top: 5px">
                    <button class="mui-btn noborder" style="font-size: 14px;line-height: 100%" @click="getResults()" j-word-label="W2018082711232500387">
                        $((lang.search))
                    </button>
                </div>
            </div>
            <div class="info-minute">
                <div class="minute-header">
                    <div class="left-text"
                         style="color: #212121;margin-top: 2px" >$((lang.dataMinute))</div>
                    <div class="right-text" style="margin: 2px 0 0 10px;">$((lang.unit)):<span style="color: red">$((lang.unitInfo))</span></div>
                </div>
                <div class="minute-project">
                    <div class="minute-table" style="max-height: 300px">
                        <div v-if="view.targetNoData" class="nodata"j-word-label="W2018062810475725084" >$((lang.nodata))</div>
                        <div class="minute-list" v-for="(item,index) in list.resultsList" @click="getResultsMinute(index)">
                            <div class="minute-body" style="height: 90px" v-bind:style="{'background':item.background,'border-left-color':item.background,'color':item.color}" v-bind:class="{minuteAcitve:index==isactive}">
                                <div class="minute-body-title"  v-bind:style="{'color':item.titlecolor}">$((item.DeptDiv1))</div>
                                <div class="minute-body-th">
                                    <div class="minute-body-td long">未出库:$((item.MiInvoiceForAmt))</div>
                                    <div class="minute-body-td long">未开发票:$((item.MiBillForAmt))</div>
                                    <div class="minute-body-td long">未收款:$((item.MiReceiptForAmt))</div>
                                </div>
                                <div class="minute-body-th">
                                    <div class="minute-body-td long">生产未出库:$((item.MiProductForAmt))</div>
                                    <div class="minute-body-td long">生产未接受:$((item.MiWkAptForAmt))</div>
                                    <div class="minute-body-td long">设计未出图:$((item.DrawMiOutForAmt))</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="minute-header">
                    <div class="left-text" style="color: #212121;margin-top: 2px" j-word-label="W2018102617085239791">$((lang.pictrolTable))</div>
                    <!--<div class="right-text" style="margin-top: 2px" @click="changeTheme();" j-word-label="W2018110618023964046">$((lang.changeTheme))</div>-->
                    <div id="echartsHeader" class="echarts-header" style="display: none">
                        <div style="width: 33.33333%;float: left;height: 18px;padding: 0 0 4px 0">
                            <div style="border-radius: 5px;float: left;height: 100%;width: 25px;background-color: #76ccff"></div>
                            <div style="height: 100%;margin: -2px 0 0 5px;font-size: 12px;float: left">未出库</div>
                        </div>
                        <div style="width: 33.33333%;float: left;height: 18px;padding: 0 0 4px 0">
                            <div style="border-radius: 5px;float: left;height: 100%;width: 25px;background-color: #55aeff"></div>
                            <div style="height: 100%;margin: -2px 0 0 5px;font-size: 12px;float: left">未开发票</div>
                        </div>
                        <div style="width: 33.33333%;float: left;height: 18px;padding: 0 0 4px 0">
                            <div style="border-radius: 5px;float: left;height: 100%;width: 25px;background-color: #2196ff"></div>
                            <div style="height: 100%;margin: -2px 0 0 5px;font-size: 12px;float: left">未收款</div>
                        </div>
                        <div style="width: 33.33333%;float: left;height: 18px;padding: 0 0 4px 0">
                            <div style="border-radius: 5px;float: left;height: 100%;width: 25px;background-color: #f6e993"></div>
                            <div style="height: 100%;margin: -2px 0 0 5px;font-size: 12px;float: left">生产未出库</div>
                        </div>
                        <div style="width: 33.33333%;float: left;height: 18px;padding: 0 0 4px 0">
                            <div style="border-radius: 5px;float: left;height: 100%;width: 25px;background-color: #fff244"></div>
                            <div style="height: 100%;margin: -2px 0 0 5px;font-size: 12px;float: left">生产未接受</div>
                        </div>
                        <div style="width: 33.33333%;float: left;height: 18px;padding: 0 0 4px 0">
                            <div style="border-radius: 5px;float: left;height: 100%;width: 25px;background-color: #ffe000"></div>
                            <div style="height: 100%;margin: -2px 0 0 5px;font-size: 12px;float: left">设计未出图</div>
                        </div>
                    </div>
                </div>
                <div class="nodata" v-if="view.echartsNoData"  j-word-label="W2018062810475725084">$((lang.nodata))</div>
                <div class="echarts" id="echarts">
                </div>
            </div>
        </div>
    </div>

</div>
<script src="/js/WEI_1300/WEI_1300_Lists.js?v=1076"></script>
</body>
</html>
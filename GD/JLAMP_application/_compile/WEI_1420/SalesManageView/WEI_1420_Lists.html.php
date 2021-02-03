<?php /* Template_ 2.2.6 2019/03/22 18:11:37 /home/gdmerp.yudo.com.cn/public_html/JLAMP_application/views/SalesManageView/WEI_1420_Lists.html 000010173 */ ?>
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
    <link rel="stylesheet" href="/css/yudo-ui.css?v=1063">
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
                <div class="header-center-btn" >$((lang.headerTitle))</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="center-ios" id="centerControl" style="background: white;">
            <div class="info-search" >
                <div class="info-search-input" style="width: 75%">
                    <div class="write-input">
                        <div class="left-icon icon-search-class"></div>
                        <select v-model="input.groupClass">
                            <option :value="item.value" v-for="(item,index) in list.groupClass">$((item.text))</option>
                        </select>
                    </div>
                </div>
                <div class="search-btn" style="padding: 0  0  0 10px;height: 30px;width: 25%;margin-top: 5px">
                    <button class="mui-btn noborder" style="font-size: 14px;line-height: 100%" @click="getResults()" j-word-label="W2018082711232500387">
                        $((lang.search))
                    </button>
                </div>
            </div>
            <div class="info-minute">
                <div class="minute-header">
                    <div class="left-text" style="color: #212121;margin-top: 2px" >$((lang.dataMinute))</div>
                    <div class="right-text" @click="searchDate()">
                        <div style="display: inline-block" class="icon-date"></div>
                        <div style="float: right;margin-left: 5px;margin-top: 2px">$((salesTargetDate))</div>
                    </div>
                    <div class="right-text" style="margin: 2px 10px 0 10px;">$((lang.unit)):<span style="color: red">$((lang.nowUnit))</span></div>
                </div>
                <div class="minute-project">
                    <div class="minute-table" style="max-height: 300px">
                        <div v-if="view.targetNoData" class="nodata"j-word-label="W2018062810475725084" >$((lang.nodata))</div>
                        <div class="minute-list" v-for="(item,index) in list.resultsList" @click="getResultsMinute(index)">
                            <div class="minute-body" style="height: 140px" v-bind:style="{'background':item.background,'border-left-color':item.background,'color':item.color}" v-bind:class="{minuteAcitve:index==isactive}">
                                <div class="minute-body-title"  v-bind:style="{'color':item.titlecolor}">$((item.Market))</div>
                                <div class="minute-body-th">
                                    <div class="minute-body-td long" style="width: 31%">$((lang.toDayOrder)):$((item.ToDayOrderAmt))</div>
                                    <div class="minute-body-td long" style="width: 33%">$((lang.toMonthOrder)):$((item.TotOrderAmt))</div>
                                    <div class="minute-body-td long" style="width: 35.999%">$((lang.toMonthOrder)):$((item.TotYYOrderAmt))</div>
                                </div>
                                <div class="minute-body-th">
                                    <div class="minute-body-td long" style="width: 31%">$((lang.toDayInvoice)):$((item.ToDayInvoiceAmt))</div>
                                    <div class="minute-body-td long" style="width: 33%">$((lang.toMonthInvoice)):$((item.TotInvoiceAmt))</div>
                                    <div class="minute-body-td long" style="width: 35.999%">$((lang.toYearInvoice)):$((item.TotYYInvoiceAmt))</div>
                                </div>
                                <div class="minute-body-th">
                                    <div class="minute-body-td long" style="width: 100%">$((lang.orderNoCompelete)):$((item.MiInvoiceAmt))</div>
                                </div>
                                <div class="minute-body-th">
                                    <div class="minute-body-td long">$((lang.currCd)):$((item.CurrCd))</div>
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
                            <div style="height: 100%;margin: -2px 0 0 5px;font-size: 12px;float: left">$((lang.toDayOrder))</div>
                        </div>
                        <div style="width: 33.33333%;float: left;height: 18px;padding: 0 0 4px 0">
                            <div style="border-radius: 5px;float: left;height: 100%;width: 25px;background-color: #55aeff"></div>
                            <div style="height: 100%;margin: -2px 0 0 5px;font-size: 12px;float: left">$((lang.toMonthOrder))</div>
                        </div>
                        <div style="width: 33.33333%;float: left;height: 18px;padding: 0 0 4px 0">
                            <div style="border-radius: 5px;float: left;height: 100%;width: 25px;background-color: #2196ff"></div>
                            <div style="height: 100%;margin: -2px 0 0 5px;font-size: 12px;float: left">$((lang.toYearOrder))</div>
                        </div>
                        <div style="width: 33.33333%;float: left;height: 18px;padding: 0 0 4px 0">
                            <div style="border-radius: 5px;float: left;height: 100%;width: 25px;background-color: #f6e993"></div>
                            <div style="height: 100%;margin: -2px 0 0 5px;font-size: 12px;float: left">$((lang.toDayInvoice))</div>
                        </div>
                        <div style="width: 33.33333%;float: left;height: 18px;padding: 0 0 4px 0">
                            <div style="border-radius: 5px;float: left;height: 100%;width: 25px;background-color: #fff244"></div>
                            <div style="height: 100%;margin: -2px 0 0 5px;font-size: 12px;float: left">$((lang.toMonthInvoice))</div>
                        </div>
                        <div style="width: 33.33333%;float: left;height: 18px;padding: 0 0 4px 0">
                            <div style="border-radius: 5px;float: left;height: 100%;width: 25px;background-color: #ffe000"></div>
                            <div style="height: 100%;margin: -2px 0 0 5px;font-size: 12px;float: left">$((lang.toYearInvoice))</div>
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
<script src="/js/WEI_1420/WEI_1420_Lists.js?v=1063"></script>
</body>
</html>
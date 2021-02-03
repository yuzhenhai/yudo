<?php /* Template_ 2.2.6 2019/01/29 14:36:16 /home/gdmerp.yudo.com.cn/public_html/JLAMP_application/modules/WEI_1000/views/WEI_1000_Lists.html 000022115 */ ?>
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
    <link rel="stylesheet" href="/css/yudo-ui.css?v=1066">
    <link rel="stylesheet" href="/css/mui.min.css?v=1008">
    <link rel="stylesheet" href="/css/mui.picker.min.css">
    <link rel="stylesheet" href="/css/animate.min.css">
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
    <style type="text/css">
        .yudo-window{
            animation-duration: 0.4s
        }
        .yudo-window-trans{
            animation-duration: 0.2s
        }

    </style>
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
            <div class="info-class">
                <div class="info-body">
                    <div v-bind:class="yearItem" j-word-label="W2018102617000591392" @click="changeInfoItem(0)">$((lang.year))</div>
                    <div v-bind:class="monthItem" j-word-label="G2018102617002367015" @click="changeInfoItem(1)">$((lang.month))</div>
                    <div v-bind:class="dayItem" j-word-label="G2018102617005914777" @click="changeInfoItem(2)">$((lang.day))</div>
                </div>
            </div>
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
                    <div v-if="view.toYear" class="minute-table">
                        <div v-if="view.targetNoData" class="nodata"j-word-label="W2018062810475725084" >$((lang.nodata))</div>
                        <div class="minute-list" v-for="(item,index) in list.resultsList" >
                            <div class="minute-body flex" style="height: 140px" v-bind:style="{'background':item.background,'border-left-color':item.background,'color':item.color}" >
                                <div class="minute-body-left" @click="showTubiao(index)">
                                    <div>
                                        <div class="icon-tubiao"></div>
                                        <div class="long" style="font-weight: 700;text-align: center;height: 20px;line-height: 25px;font-size: 13px;color: #2f2d30 ">$((item.title))</div>
                                    </div>
                                </div>
                                <div class="little-line"></div>
                                <div class="minute-body-right" @click="showDataMinute(index)">
                                    <div>
                                        <div class="long" style="text-align: left;height: 16px;line-height: 16px;font-size: 12px;color: #2f2d30 ">$((lang.toYearOrder)):$((item.ToYearOrderForAmt | toFixs))</div>
                                        <div class="long" style="text-align: left;height: 16px;line-height: 16px;font-size: 12px;color: #2f2d30 ">$((lang.toYearInvoice)):$((item.ToYearInvoiceForAmt | toFixs))</div>
                                        <div class="long" style="text-align: left;height: 16px;line-height: 16px;font-size: 12px;color: #2f2d30 ">$((lang.toYearBill)):$((item.ToYearBillForAmt | toFixs))</div>
                                        <div class="long" style="text-align: left;height: 16px;line-height: 16px;font-size: 12px;color: #2f2d30 ">$((lang.toYearReceivables)):$((item.ToYearReceiptForAmt | toFixs))</div>
                                        <div class="long" style="text-align: left;height: 16px;line-height: 16px;font-size: 12px;color: #2f2d30 ">$((lang.orderNoCompelete)):$((item.MiInvoiceForAmt | toFixs))</div>
                                        <div class="long" style="text-align: left;height: 16px;line-height: 16px;font-size: 12px;color: #2f2d30 ">$((lang.invoiceNoCompelete)):$((item.MiReceiptForAmt | toFixs))</div>
                                    </div>
                                    <div class="mui-icon mui-icon-arrowright" style="font-size: 15px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="view.toMonth" class="minute-table">
                        <div v-if="view.targetNoData" class="nodata"j-word-label="W2018062810475725084" >$((lang.nodata))</div>
                        <div class="minute-list" v-for="(item,index) in list.resultsList" >
                            <div class="minute-body flex" style="height: 140px" v-bind:style="{'background':item.background,'border-left-color':item.background,'color':item.color}" >
                                <div class="minute-body-left" @click="showTubiao(index)">
                                    <div>
                                        <div class="icon-tubiao"></div>
                                        <div class="long" style="font-weight: 700;text-align: center;height: 20px;line-height: 25px;font-size: 13px;color: #2f2d30 ">$((item.title))</div>
                                    </div>
                                </div>
                                <div class="little-line"></div>
                                <div class="minute-body-right" @click="showDataMinute(index)">
                                    <div>
                                        <div class="long" style="text-align: left;height: 16px;line-height: 16px;font-size: 12px;color: #2f2d30 ">$((lang.toMonthOrder)):$((item.ToMonthOrderForAmt | toFixs))</div>
                                        <div class="long" style="text-align: left;height: 16px;line-height: 16px;font-size: 12px;color: #2f2d30 ">$((lang.toMonthInvoice)):$((item.ToMonthInvoiceForAmt | toFixs))</div>
                                        <div class="long" style="text-align: left;height: 16px;line-height: 16px;font-size: 12px;color: #2f2d30 ">$((lang.toMonthBill)):$((item.ToMonthBillForAmt | toFixs))</div>
                                        <div class="long" style="text-align: left;height: 16px;line-height: 16px;font-size: 12px;color: #2f2d30 ">$((lang.toMonthReceivables)):$((item.ToMonthReceiptForAmt | toFixs))</div>
                                        <div class="long" style="text-align: left;height: 16px;line-height: 16px;font-size: 12px;color: #2f2d30 ">$((lang.orderNoCompelete)):$((item.MiInvoiceForAmt | toFixs))</div>
                                        <div class="long" style="text-align: left;height: 16px;line-height: 16px;font-size: 12px;color: #2f2d30 ">$((lang.invoiceNoCompelete)):$((item.MiReceiptForAmt | toFixs))</div>
                                    </div>
                                    <div class="mui-icon mui-icon-arrowright" style="font-size: 15px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="view.toDay" class="minute-table">
                        <div v-if="view.targetNoData" class="nodata"j-word-label="W2018062810475725084" >$((lang.nodata))</div>
                        <div class="minute-list" v-for="(item,index) in list.resultsList" >
                            <div class="minute-body flex" style="height: 140px" v-bind:style="{'background':item.background,'border-left-color':item.background,'color':item.color}" >
                                <div class="minute-body-left" @click="showTubiao(index)">
                                    <div>
                                        <div class="icon-tubiao"></div>
                                        <div class="long" style="font-weight: 700;text-align: center;height: 20px;line-height: 25px;font-size: 13px;color: #2f2d30 ">$((item.title))</div>
                                    </div>
                                </div>
                                <div class="little-line"></div>
                                <div class="minute-body-right" @click="showDataMinute(index)">
                                    <div>
                                        <div class="long" style="text-align: left;height: 16px;line-height: 16px;font-size: 12px;color: #2f2d30 ">$((lang.toDayOrder)):$((item.ToDayOrderForAmt | toFixs))</div>
                                        <div class="long" style="text-align: left;height: 16px;line-height: 16px;font-size: 12px;color: #2f2d30 ">$((lang.toDayInvoice)):$((item.ToDayInvoiceForAmt | toFixs))</div>
                                        <div class="long" style="text-align: left;height: 16px;line-height: 16px;font-size: 12px;color: #2f2d30 ">$((lang.toDayBill)):$((item.ToDayBillForAmt | toFixs))</div>
                                        <div class="long" style="text-align: left;height: 16px;line-height: 16px;font-size: 12px;color: #2f2d30 ">$((lang.toDayReceivables)):$((item.ToDayReceiptForAmt | toFixs))</div>
                                        <div class="long" style="text-align: left;height: 16px;line-height: 16px;font-size: 12px;color: #2f2d30 ">$((lang.orderNoCompelete)):$((item.MiInvoiceForAmt | toFixs))</div>
                                        <div class="long" style="text-align: left;height: 16px;line-height: 16px;font-size: 12px;color: #2f2d30 ">$((lang.invoiceNoCompelete)):$((item.MiReceiptForAmt | toFixs))</div>
                                    </div>
                                    <div class="mui-icon mui-icon-arrowright" style="font-size: 15px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="yudo-window-trans animated fadeInRight trans-one" v-if="view.dataMinute">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" @click="closeDataMinute()">
                    <div class="left-icon icon-back-2"></div>
                </div>
                <div class="header-center-btn" >$((lang.transTitle))</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="center-ios">
            <div class="info-minute" style="height: 100%">
                <div class="minute-header">
                    <div class="left-text" style="color: #212121;margin-top: 2px" >$((lang.dataMinute))</div>
                    <div class="right-text" style="margin: 2px 0 0 10px;">$((lang.unit)):<span style="color: red">$((lang.unitInfo))</span></div>
                </div>
                <div class="minute-project" style="position: absolute;top:90px;bottom: 0">
                    <div v-if="view.toYear" class="minute-table" style="height: 100%;">
                        <div v-if="view.targetNoData" class="nodata"j-word-label="W2018062810475725084" >$((lang.nodata))</div>
                        <div class="minute-list" v-for="(item,index) in list.minuteDataDisplay" >
                            <div class="minute-body" style="height: 135px" v-bind:style="{'background':item.background,'border-left-color':item.background,'color':item.color}">
                                <div class="minute-body-title"  v-bind:style="{'color':item.titlecolor}">$((item.DeptNm))</div>
                                <div class="minute-body-th">
                                    <div class="minute-body-td long">$((lang.toYearOrder)):$((item.ToYearOrderForAmt | toFixs))</div>
                                    <div class="minute-body-td long">$((lang.toYearInvoice)):$((item.ToYearInvoiceForAmt | toFixs))</div>
                                    <div class="minute-body-td long">$((lang.toYearBill)):$((item.ToYearBillForAmt | toFixs))</div>
                                </div>
                                <div class="minute-body-th">
                                    <div class="minute-body-td long">$((lang.toYearReceivables)):$((item.ToYearReceiptForAmt | toFixs))</div>
                                    <div style="width: 50%;"  class="minute-body-td long">$((lang.currCd)):$((item.CurrNm))</div>
                                </div>
                                <div>
                                    <div style="width: 100%" class="minute-body-td long">$((lang.orderNoCompelete)):$((item.MiInvoiceForAmt | toFixs))</div>
                                </div>
                                <div>
                                    <div style="width: 100%" class="minute-body-td long">$((lang.invoiceNoCompelete)):$((item.MiReceiptForAmt | toFixs))</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="view.toMonth" class="minute-table" style="height: 100%;">
                        <div v-if="view.targetNoData" class="nodata"j-word-label="W2018062810475725084" >$((lang.nodata))</div>
                        <div class="minute-list" v-for="(item,index) in list.minuteDataDisplay" >
                            <div class="minute-body" style="height: 135px" v-bind:style="{'background':item.background,'border-left-color':item.background,'color':item.color}">
                                <div class="minute-body-title"  v-bind:style="{'color':item.titlecolor}">$((item.DeptNm))</div>
                                <div class="minute-body-th">
                                    <div class="minute-body-td long">$((lang.toMonthOrder)):$((item.ToMonthOrderForAmt | toFixs))</div>
                                    <div class="minute-body-td long">$((lang.toMonthInvoice)):$((item.ToMonthInvoiceForAmt | toFixs))</div>
                                    <div class="minute-body-td long">$((lang.toMonthBill)):$((item.ToMonthBillForAmt | toFixs))</div>
                                </div>
                                <div class="minute-body-th">
                                    <div class="minute-body-td long">$((lang.toMonthReceivables)):$((item.ToMonthReceiptForAmt | toFixs))</div>
                                    <div style="width: 50%;"  class="minute-body-td long">$((lang.currCd)):$((item.CurrNm))</div>
                                </div>
                                <div>
                                    <div style="width: 100%" class="minute-body-td long">$((lang.orderNoCompelete)):$((item.MiInvoiceForAmt | toFixs))</div>
                                </div>
                                <div>
                                    <div style="width: 100%" class="minute-body-td long">$((lang.invoiceNoCompelete)):$((item.MiReceiptForAmt | toFixs))</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="view.toDay" class="minute-table" style="height: 100%;">
                        <div v-if="view.targetNoData" class="nodata"j-word-label="W2018062810475725084" >$((lang.nodata))</div>
                        <div class="minute-list" v-for="(item,index) in list.minuteDataDisplay" >
                            <div class="minute-body" style="height: 135px" v-bind:style="{'background':item.background,'border-left-color':item.background,'color':item.color}">
                                <div class="minute-body-title"  v-bind:style="{'color':item.titlecolor}">$((item.DeptNm))</div>
                                <div class="minute-body-th">
                                    <div class="minute-body-td long">$((lang.toDayOrder)):$((item.ToDayOrderForAmt | toFixs))</div>
                                    <div class="minute-body-td long">$((lang.toDayInvoice)):$((item.ToDayInvoiceForAmt | toFixs))</div>
                                    <div class="minute-body-td long">$((lang.toDayBill)):$((item.ToDayBillForAmt | toFixs))</div>
                                </div>
                                <div class="minute-body-th">
                                    <div class="minute-body-td long">$((lang.toDayReceivables)):$((item.ToDayReceiptForAmt | toFixs))</div>
                                    <div style="width: 50%;"  class="minute-body-td long">$((lang.currCd)):$((item.CurrNm))</div>
                                </div>
                                <div>
                                    <div style="width: 100%" class="minute-body-td long">$((lang.orderNoCompelete)):$((item.MiInvoiceForAmt | toFixs))</div>
                                </div>
                                <div>
                                    <div style="width: 100%" class="minute-body-td long">$((lang.invoiceNoCompelete)):$((item.MiReceiptForAmt | toFixs))</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="yudo-window-trans animated fadeInRight trans-two" v-if="view.tubiao">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" @click="closeTubiao()">
                    <div class="left-icon icon-back-2"></div>
                </div>
                <div class="header-center-btn" >$((lang.transTitle))</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="center-ios">
            <div class="minute-header">
             <div class="left-text" style="color: #212121;margin-top: 2px" j-word-label="W2018102617085239791">$((lang.pictrolTable))</div>
            <!--<div class="right-text" style="margin-top: 2px" @click="changeTheme();" j-word-label="W2018110618023964046">$((lang.changeTheme))</div>-->
            </div>
            <div class="nodata" v-if="view.echartsNoData"  j-word-label="W2018062810475725084">$((lang.nodata))</div>
            <div class="echarts" style="max-height: 700px" id="echarts">
            </div>
        </div>
    </div>

</div>
<script src="/js/WEI_1000/WEI_1000_Lists.js?v=1176"></script>
</body>
</html>
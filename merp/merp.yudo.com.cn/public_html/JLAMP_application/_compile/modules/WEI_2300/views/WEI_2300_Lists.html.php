<?php /* Template_ 2.2.6 2019/02/21 16:24:25 /home/merp.yudo.com.cn/public_html/JLAMP_application/modules/WEI_2300/views/WEI_2300_Lists.html 000042992 */ ?>
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
    <link rel="stylesheet" href="/css/yudo-ui.css?v=1050">
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
        <div class="yudo-menu" v-show="view.viewMenu">
            <div class="header-ios">
                <div class="header-body">
                    <div class="header-left-btn" id="backMenu">
                        <div class="left-icon icon-backmenu"></div>
                        <div class="left-text">$((lang.menuBack))</div>
                    </div>
                    <div class="header-center-btn">$((lang.headerTitle))</div>
                    <div class="header-right-btn">
                        <div class="right-icon icon-extend"></div>
                    </div>
                </div>
            </div>
            <div class="center-ios">
                <div class="menus">
                    <button @click="showTargetMinute()" type="button" class="layui-btn layui-btn-primary menu-btn" style="padding-top: 2px">
                        <span style="position: relative"><div class="icon-search btn-icon"></div><span j-word-label="W2018102616570053035">查询目标业绩</span></span>
                    </button>
                    <button @click="showTargetWrite('active')" type="button" class="layui-btn layui-btn-primary menu-btn" style="padding-top: 2px">
                        <span style="position: relative"><div class="icon-write btn-icon"></div><span j-word-label="W2018102616572707009">录入销售目标</span></span>
                    </button>
                    <!--<button @click="showMonthPlan()" type="button" class="layui-btn layui-btn-primary menu-btn" style="padding-top: 2px">-->
                        <!--<span style="position: relative"><div class="icon-write btn-icon"></div><span j-word-label="W2018102616">录入月度计划</span></span>-->
                    <!--</button>-->
                </div>
            </div>
            <div class="yudo-footer">
                YUDO ERP APP
            </div>
        </div>
        <div class="yudo-window" v-if="view.viewTargetMinute">
            <div class="header-ios">
                <div class="header-body">
                    <div class="header-left-btn" @click="closeTargetMinute()">
                        <div class="left-icon icon-back-2"></div>
                        <div class="left-text"></div>
                    </div>
                    <div class="header-center-btn" >$((lang.targetAndResults))</div>
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
                <div class="info-search">
                    <div class="info-search-input">
                        <div class="write-input">
                            <div class="left-icon icon-search-class"></div>
                            <select v-model="input.searchGroup" @change="changeProject(input.searchGroup)">
                                <option :value="item.value" v-for="(item,index) in list.groupClass">$((item.text))</option>
                            </select>
                        </div>
                        <div class="write-input">
                            <div class="left-icon icon-search-user"></div>
                            <select v-if="view.optAllAdmin" v-model="input.targetAllAdmin">
                                <option :value="item" v-for="(item,index) in list.targetAllAdmin">$((item.text))</option>
                            </select>
                            <select v-if="view.optGroupAdmin" v-model="input.targetGroupAdmin">
                                <option :value="item" v-for="(item,index) in list.targetGroupAdmin">$((item.text))</option>
                            </select>
                            <select v-if="view.optGroupAdmin_c" v-model="input.targetGroupAdmin_c">
                                <option :value="item" v-for="(item,index) in list.targetGroupAdmin_c">$((item.text))</option>
                            </select>
                            <select v-if="view.optUser" v-model="input.targetUser">
                                <option :value="item" v-for="(item,index) in list.targetUser">$((item.text))</option>
                            </select>
                            <!--<input @click="showUserSearch()" v-if="view.optUser" readonly="true" v-model="input.optUserNm" type="text" :placeholder="lang.search">-->
                        </div>
                    </div>
                    <div class="search-btn">
                        <button class="mui-btn noborder" @click="getTarget()" j-word-label="W2018082711232500387">
                            $((lang.search))
                        </button>
                    </div>
                </div>
                <div class="info-minute">
                    <div class="minute-header">
                        <div class="left-text" style="color: #212121;margin-top: 2px" >$((lang.dataMinute))</div>
                        <!--<div class="left-text" >-->
                            <!--<select v-model="input.currency"  @change="changeCurrency(input.currency)" style="margin:1px 0 0 15px;float: left;background-color: transparent;width: 45px;height: 21px;padding: 1px 0 0 0">-->
                                <!--<option :value="item.value" v-for="(item,index) in list.currency">$((item.text))</option>-->
                            <!--</select>-->
                            <!--<div style="float: right;width: 10px;height: 10px;margin-top: 6px" class="icon-xiala"></div>-->
                        <!--</div>-->
                        <div class="right-text" @click="searchDate()">
                            <div style="display: inline-block" class="icon-date"></div>
                            <div style="float: right;margin-left: 5px;margin-top: 2px">$((salesTargetDate))</div>
                        </div>
                        <div class="right-text" style="margin: 2px 10px 0 10px;">$((lang.unit)):<span style="color: red">$((lang.nowUnit))</span></div>
                    </div>
                    <div class="minute-project" >
                        <div class="minute-th">
                            <div class="long record-family" style="color: #2196ff" j-word-label="G2018102617013950014">$((lang.class))</div>
                            <div class="long record-family-data" style="color: #2196ff" j-word-label="G2018102617015927383">$((lang.orderResults))</div>
                            <div class="long record-family-data" style="color: #2196ff" j-word-label="G2018102617023163098">$((lang.invoiceResults))</div>
                            <div class="long record-family-data" style="color: #2196ff" j-word-label="G2018102617053446374">$((lang.billResults))</div>
                            <div class="long record-family-data" style="color: #2196ff" j-word-label="G2018102617060001707">$((lang.receiptResults))</div>
                        </div>
                        <div class="minute-table" style="max-height: 300px">
                            <div v-if="view.targetNoData" class="nodata"j-word-label="W2018062810475725084" >$((lang.nodata))</div>
                            <div class="minute-list" v-for="(item,index) in list.targetList" @click="getTargetMinute(index)">
                                <div style="height: auto;overflow: hidden" class="minute-body" v-bind:style="{'background':item[0].background,'border-left-color':item[0].background,'color':item[0].color}" v-bind:class="{minuteAcitve:index==isactive}">
                                    <!--<div class="record-class" style="position: absolute;top: 0">-->
                                        <!--<div class="long" style="height: 20px;width: 80%;float: left"></div>-->
                                        <!--<div class="long" style="height: 20px;width: 80%;float: left"></div>-->
                                        <!--<div class="long" style="height: 20px;width: 80%;float: left">$((item[0].name))</div>-->
                                    <!--</div>-->
                                    <div style="height: 25px;width: 100%;text-align: left;font-weight: 700;font-size: 14px;" v-bind:style="{'color':item.titlecolor || '#2e75c4'}">$((item[0].name))</div>
                                    <div class="record-family-data">
                                        <div class="long" style="height: 20px" j-word-label="G2018102617064252094">$((lang.target))</div>
                                        <div class="long" v-if="view.viewPlan" style="height: 20px" j-word-label="W2018102617081972328">$((lang.plan))</div>
                                        <div class="long" style="height: 20px" j-word-label="W2018102617080071052">$((lang.results))</div>
                                        <div class="long" style="height: 20px" j-word-label="W2018102617081972328">$((lang.targetToResult))</div>
                                        <div class="long" v-if="view.viewPlan" style="height: 20px" j-word-label="W2018102617081972328">$((lang.planToResult))</div>
                                        <div class="long" v-if="view.viewPlan" style="height: 20px" j-word-label="W2018102617081972328">$((lang.planToTarget))</div>
                                    </div>
                                    <div class="record-family-data">
                                        <div class="long" style="height: 20px">$((item[0].orderAmt.target))</div>
                                        <div class="long" v-if="view.viewPlan" style="height: 20px">$((item[0].orderAmt.plan))</div>
                                        <div class="long" style="height: 20px">$((item[0].orderAmt.salesRecord))</div>
                                        <div class="long" style="height: 20px">$((item[0].orderAmt.percent))</div>
                                        <div class="long" v-if="view.viewPlan" style="height: 20px">$((item[0].orderAmt.percent2))</div>
                                        <div class="long" v-if="view.viewPlan" style="height: 20px">$((item[0].orderAmt.percent3))</div>
                                    </div>
                                    <div class="record-family-data">
                                        <div class="long" style="height: 20px">$((item[0].InvoiceAmt.target))</div>
                                        <div class="long" v-if="view.viewPlan" style="height: 20px">$((item[0].InvoiceAmt.plan))</div>
                                        <div class="long" style="height: 20px">$((item[0].InvoiceAmt.salesRecord))</div>
                                        <div class="long" style="height: 20px">$((item[0].InvoiceAmt.percent))</div>
                                        <div class="long" v-if="view.viewPlan" style="height: 20px">$((item[0].InvoiceAmt.percent2))</div>
                                        <div class="long" v-if="view.viewPlan" style="height: 20px">$((item[0].InvoiceAmt.percent3))</div>
                                    </div>
                                    <div class="record-family-data">
                                        <div class="long" style="height: 20px">$((item[0].BillAmt.target))</div>
                                        <div class="long" v-if="view.viewPlan" style="height: 20px">$((item[0].BillAmt.plan))</div>
                                        <div class="long" style="height: 20px">$((item[0].BillAmt.salesRecord))</div>
                                        <div class="long" style="height: 20px">$((item[0].BillAmt.percent))</div>
                                        <div class="long" v-if="view.viewPlan" style="height: 20px">$((item[0].BillAmt.percent2))</div>
                                        <div class="long" v-if="view.viewPlan" style="height: 20px">$((item[0].BillAmt.percent3))</div>
                                    </div>
                                    <div class="record-family-data">
                                        <div class="long" style="height: 20px">$((item[0].ReceiptAmt.target))</div>
                                        <div class="long" v-if="view.viewPlan" style="height: 20px">$((item[0].ReceiptAmt.plan))</div>
                                        <div class="long" style="height: 20px">$((item[0].ReceiptAmt.salesRecord))</div>
                                        <div class="long" style="height: 20px">$((item[0].ReceiptAmt.percent))</div>
                                        <div class="long" v-if="view.viewPlan" style="height: 20px">$((item[0].ReceiptAmt.percent2))</div>
                                        <div class="long" v-if="view.viewPlan" style="height: 20px">$((item[0].ReceiptAmt.percent3))</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="minute-header">
                        <div class="left-text" style="color: #212121;margin-top: 2px" j-word-label="W2018102617085239791">$((lang.pictrolTable))</div>
                        <div class="right-text" style="margin-top: 2px" @click="changeTheme();" j-word-label="W2018110618023964046">$((lang.changeTheme))</div>
                    </div>
                    <div class="nodata" v-if="view.echartsNoData"  j-word-label="W2018062810475725084">$((lang.nodata))</div>
                    <div class="echarts" id="echarts">
                    </div>
                </div>

            </div>
        </div>
        <div class="yudo-window" v-if="view.viewTargetWrite">
            <div class="header-ios">
                <div class="header-body">
                    <div class="header-left-btn" @click="closeTargetWrite('active')">
                        <div class="left-icon icon-back-2"></div>
                        <div class="left-text"></div>
                    </div>
                    <div class="header-center-btn" >$((lang.targetWrite))</div>
                    <div class="header-right-btn">
                        <div @click="showTargetSearch()" class="right-icon icon-search" style="margin-top: 1px"></div>
                    </div>
                </div>
            </div>
            <div class="center-ios">
                <div class="input-tr">
                    <div class="input-tr-title long">
                        <span >$((lang.targetDate))</span>
                    </div>
                    <div class="input-tr-body">
                        <div class="input-border">
                            <div class="icon-xiala select-btn"></div>
                            <input v-model="input.targetDate" type="text" readonly="true" @click="setTargetDate()" class="yudu-input noborder" />
                        </div>
                    </div>
                </div>
                <div class="input-tr">
                    <div class="input-tr-title long">
                        <span>$((lang.searchUserNm))</span>
                    </div>
                    <div class="input-tr-body">
                        <div class="input-border xwrite" @click="showUserSearch()">
                            <input type="text" readonly="true" v-model="input.userNm" class="yudu-input noborder" />
                        </div>
                    </div>
                </div>
                <div class="input-tr">
                    <div class="input-tr-title long">
                        <span >$((lang.searchGroupNm))</span>
                    </div>
                    <div class="input-tr-body">
                        <div class="input-border xwrite" @click="showUserSearch()">
                            <input type="text" readonly="true" v-model="input.groupNm" class="yudu-input noborder" />
                        </div>
                    </div>
                </div>
                <div class="input-tr">
                    <div class="input-tr-title long">
                        <span j-word-label="W2018041913341497746">$((lang.expClass))</span>
                    </div>
                    <div class="input-tr-body">
                        <div class="input-border">
                            <div class="icon-xiala select-btn"></div>
                            <select v-model="input.expClass" v-bind:disabled="view.xwrite">
                                <option :value="item.value" v-for="(item,index) in list.expClass">$((item.text))</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="input-tr">
                    <div class="input-tr-title long">
                        <span j-word-label="G2018102617102083724">$((lang.currCd))</span>
                    </div>
                    <div class="input-tr-body">
                        <div class="input-border">
                            <div class="icon-xiala select-btn"></div>
                            <select v-model="input.currency">
                                <option :value="item.value" v-bind:disabled="view.xwrite" v-for="(item,index) in list.currency">$((item.text))</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="input-tr">
                    <div class="input-tr-title long">
                        <span j-word-label="G2018102617105713785">$((lang.targetOrderMoney))</span>
                    </div>
                    <div class="input-tr-body">
                        <div class="input-border">
                            <div class="select-btn"  style="top: 8px">$((lang.yuan))</div>
                            <input v-model="input.orderAmt"  onkeydown="onlyNum();" type="text" v-bind:readonly="view.confirm" class="yudu-input noborder" style="padding-right: 80px" />
                        </div>
                    </div>
                </div>
                <div class="input-tr">
                    <div class="input-tr-title long">
                        <span j-word-label="W2018102617114052791">$((lang.targetInvoiceMoney))</span>
                    </div>
                    <div class="input-tr-body">
                        <div class="input-border">
                            <div class="select-btn" style="top: 8px">$((lang.yuan))</div>
                            <input v-model="input.invoiceAmt" onkeydown="onlyNum();" type="text" v-bind:readonly="view.confirm" class="yudu-input noborder" style="padding-right: 80px"/>
                        </div>
                    </div>
                </div>
                <div class="input-tr">
                    <div class="input-tr-title long">
                        <span j-word-label="W2018102617115829085">$((lang.targetBillMoney))</span>
                    </div>
                    <div class="input-tr-body">
                        <div class="input-border">
                            <div class="select-btn" style="top: 8px">$((lang.yuan))</div>
                            <input v-model="input.billAmt" onkeydown="onlyNum();" type="text" v-bind:readonly="view.confirm" class="yudu-input noborder" style="padding-right: 80px"/>
                        </div>
                    </div>
                </div>
                <div class="input-tr">
                    <div class="input-tr-title long">
                        <span j-word-label="W2018102617122922701">$((lang.targetReceiptMoney))</span>
                    </div>
                    <div class="input-tr-body">
                        <div class="input-border">
                            <div class="select-btn" style="top:8px" j-word-label="G2018102617211340024">$((lang.yuan))</div>
                            <input v-model="input.receiptAmt" onkeydown="onlyNum();" type="text" v-bind:readonly="view.confirm" class="yudu-input noborder" style="padding-right: 80px"/>
                        </div>
                    </div>
                </div>
                <div class="input-tr">
                    <div class="input-tr-title long">
                        <span j-word-label="W2018071009351100377">$((lang.confirm))</span>
                    </div>
                    <div class="input-tr-body">
                        <div style="float: right;margin-top: 2px" class="mui-switch" id="confirm">
                            <div class="mui-switch-handle"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-control">
                <div class="footer-body">
                    <button @click="setTargetMinute()" type="button" class="mui-btn yudo-btn">
                        <span j-word-label="W2018071009410262081">$((lang.save))</span>
                    </button>
                </div>
            </div>
        </div>
        <!--<div class="yudo-window" v-if="view.viewMonthPlan">-->
            <!--<div class="header-ios">-->
                <!--<div class="header-body">-->
                    <!--<div class="header-left-btn" @click="closeMonthPlan()">-->
                        <!--<div class="left-icon icon-back-2"></div>-->
                        <!--<div class="left-text"></div>-->
                    <!--</div>-->
                    <!--<div class="header-center-btn" >月度计划录入</div>-->
                    <!--<div class="header-right-btn">-->
                        <!--<div @click="showTargetSearch()" class="right-icon icon-search" style="margin-top: 1px"></div>-->
                    <!--</div>-->
                <!--</div>-->
            <!--</div>-->
            <!--<div class="center-ios">-->
                <!--<div class="input-tr">-->
                    <!--<div class="input-tr-title long">-->
                        <!--<span >计划日期</span>-->
                    <!--</div>-->
                    <!--<div class="input-tr-body">-->
                        <!--<div class="input-border">-->
                            <!--<div class="icon-xiala select-btn"></div>-->
                            <!--<input v-model="input.targetDate" type="text" readonly="true" @click="setTargetDate()" class="yudu-input noborder" />-->
                        <!--</div>-->
                    <!--</div>-->
                <!--</div>-->
                <!--<div class="input-tr">-->
                    <!--<div class="input-tr-title long">-->
                        <!--<span >$((lang.searchGroupNm))</span>-->
                    <!--</div>-->
                    <!--<div class="input-tr-body">-->
                        <!--<div class="input-border xwrite">-->
                            <!--<div class="icon-xiala select-btn"></div>-->
                            <!--<select v-model="input.group">-->
                                <!--<option :value="item" v-for="(item,index) in list.groupList">$((item.text))</option>-->
                            <!--</select>-->
                        <!--</div>-->
                    <!--</div>-->
                <!--</div>-->
                <!--<div class="input-tr">-->
                    <!--<div class="input-tr-title long">-->
                        <!--<span j-word-label="W2018041913341497746">$((lang.expClass))</span>-->
                    <!--</div>-->
                    <!--<div class="input-tr-body">-->
                        <!--<div class="input-border">-->
                            <!--<div class="icon-xiala select-btn"></div>-->
                            <!--<select v-model="input.expClass" v-bind:disabled="view.xwrite">-->
                                <!--<option :value="item.value" v-for="(item,index) in list.expClass">$((item.text))</option>-->
                            <!--</select>-->
                        <!--</div>-->
                    <!--</div>-->
                <!--</div>-->
                <!--<div class="input-tr">-->
                    <!--<div class="input-tr-title long">-->
                        <!--<span j-word-label="G2018102617102083724">$((lang.currCd))</span>-->
                    <!--</div>-->
                    <!--<div class="input-tr-body">-->
                        <!--<div class="input-border">-->
                            <!--<div class="icon-xiala select-btn"></div>-->
                            <!--<select v-model="input.currency">-->
                                <!--<option :value="item.value" v-bind:disabled="view.xwrite" v-for="(item,index) in list.currency">$((item.text))</option>-->
                            <!--</select>-->
                        <!--</div>-->
                    <!--</div>-->
                <!--</div>-->
                <!--<div class="input-tr">-->
                    <!--<div class="input-tr-title long">-->
                        <!--<span j-word-label="G2018102617105713785">订单计划金额</span>-->
                    <!--</div>-->
                    <!--<div class="input-tr-body">-->
                        <!--<div class="input-border">-->
                            <!--<div class="select-btn"  style="top: 8px">$((lang.yuan))</div>-->
                            <!--<input v-model="input.orderAmt"  onkeydown="onlyNum();" type="text" v-bind:readonly="view.confirm" class="yudu-input noborder" style="padding-right: 80px" />-->
                        <!--</div>-->
                    <!--</div>-->
                <!--</div>-->
                <!--<div class="input-tr">-->
                    <!--<div class="input-tr-title long">-->
                        <!--<span j-word-label="W2018102617114052791">出库计划金额</span>-->
                    <!--</div>-->
                    <!--<div class="input-tr-body">-->
                        <!--<div class="input-border">-->
                            <!--<div class="select-btn" style="top: 8px">$((lang.yuan))</div>-->
                            <!--<input v-model="input.invoiceAmt" onkeydown="onlyNum();" type="text" v-bind:readonly="view.confirm" class="yudu-input noborder" style="padding-right: 80px"/>-->
                        <!--</div>-->
                    <!--</div>-->
                <!--</div>-->
                <!--<div class="input-tr">-->
                    <!--<div class="input-tr-title long">-->
                        <!--<span j-word-label="W2018102617115829085">发票计划金额</span>-->
                    <!--</div>-->
                    <!--<div class="input-tr-body">-->
                        <!--<div class="input-border">-->
                            <!--<div class="select-btn" style="top: 8px">$((lang.yuan))</div>-->
                            <!--<input v-model="input.billAmt" onkeydown="onlyNum();" type="text" v-bind:readonly="view.confirm" class="yudu-input noborder" style="padding-right: 80px"/>-->
                        <!--</div>-->
                    <!--</div>-->
                <!--</div>-->
                <!--<div class="input-tr">-->
                    <!--<div class="input-tr-title long">-->
                        <!--<span j-word-label="W2018102617122922701">收款计划金额</span>-->
                    <!--</div>-->
                    <!--<div class="input-tr-body">-->
                        <!--<div class="input-border">-->
                            <!--<div class="select-btn" style="top:8px" j-word-label="G2018102617211340024">$((lang.yuan))</div>-->
                            <!--<input v-model="input.receiptAmt" onkeydown="onlyNum();" type="text" v-bind:readonly="view.confirm" class="yudu-input noborder" style="padding-right: 80px"/>-->
                        <!--</div>-->
                    <!--</div>-->
                <!--</div>-->
                <!--<div class="input-tr">-->
                    <!--<div class="input-tr-title long">-->
                        <!--<span j-word-label="W2018071009351100377">$((lang.confirm))</span>-->
                    <!--</div>-->
                    <!--<div class="input-tr-body">-->
                        <!--<div style="float: right;margin-top: 2px" class="mui-switch" >-->
                            <!--<div class="mui-switch-handle"></div>-->
                        <!--</div>-->
                    <!--</div>-->
                <!--</div>-->
            <!--</div>-->
            <!--<div class="footer-control">-->
                <!--<div class="footer-body">-->
                    <!--<button @click="setTargetMinute()" type="button" class="mui-btn yudo-btn">-->
                        <!--<span j-word-label="W2018071009410262081">$((lang.save))</span>-->
                    <!--</button>-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->
        <div class="yudo-window" v-if="view.viewUserSearch">
            <div class="header-ios">
                <div class="header-body">
                    <div class="header-left-btn" @click="closeUserSearch()">
                        <div class="left-icon icon-back-2"></div>
                        <div class="left-text"></div>
                    </div>
                    <div class="header-center-btn"  j-word-label="W2018041913334637071">$((lang.searchUser))</div>
                    <div class="header-right-btn">
                        <div class="right-icon icon-extend"></div>
                    </div>
                </div>
            </div>
            <div class="center-ios" style="background:white;">
                <div class="search-body">
                    <div class="input-tr">
                        <div class="input-tr-body" style="width: 100%">
                            <div class="input-border" style="width:80%">
                                <input type="text" class="yudu-input noborder" v-model="input.searchUserNm" :placeholder="lang.searchUserNm"  />
                            </div>
                            <div class="input-extend">
                                <button style="width: 100%;height: 33px;border-radius: 5px;" @click="getUsers()" type="button" class="mui-btn mui-btn-primary long" j-word-label="W2018082711232500387">$((lang.search))</button>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-body" style="width: 100%">
                            <div class="input-border">
                                <input type="text" class="yudu-input noborder" v-model="input.searchUserId" :placeholder="lang.searchUserId" />
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-body" style="width: 100%">
                            <div class="input-border">
                                <input type="text" class="yudu-input noborder" v-model="input.searchGroupNm" :placeholder="lang.searchGroupNm" />
                            </div>
                        </div>
                    </div>
                    <div class="minute-header" style="padding: 10px 0 0 0;">
                        <div class="left-text" style="margin-top: 2px;" j-word-label="W2018102909354232763">$((lang.searchResult))</div>
                        <div class="right-text">
                            <!--<div class="icon-date" style="display: inline-block;"></div>-->
                            <!--<div style="float: right; margin-left: 5px; margin-top: 2px;">2018</div>-->
                        </div>
                    </div>
                </div>
                <div class="users-body" id="muiPushUsers">
                    <div v-for="(user,index) in list.userList" class="users-item" @click="setUsers(index)">
                        <div>
                            <div style="width: 100%;float: left;font-weight: 700;color: #232e6a">$((lang.searchUserNm))：$((user.EmpNm))</div>
                        </div>
                        <div>
                            <div style="float: left">$((lang.searchUserId))：$((user.EmpID))</div>
                            <!--<div style="float: right"><i style="font-size: 30px;font-weight: 700" class="layui-icon layui-icon-add-circle-fine"></i></div>-->
                        </div>
                        <div>
                            <div class="long" style="margin-top: -5px;float: left;width: 100%;">$((lang.searchGroupNm))：$((user.DeptNm))</div>
                        </div>
                    </div>
                    <div class="loading" v-show="view.usersIsLoading">
                        <i class="mui-spinner mui-spinner-black" style="width: 30px;height: 30px;"></i>
                        <div class="nodata" style="margin-top: 0">loading</div>
                    </div>
                    <div class="loading" v-show="view.usersNoData">
                        <div class="nodata" style="margin-top: 0" j-word-label="W2018062810475725084">$((lang.nodata))</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="yudo-window" v-if="view.viewTargetSearch">
            <div class="header-ios">
                <div class="header-body">
                    <div class="header-left-btn" @click="closeTargetSearch()">
                        <div class="left-icon icon-back-2"></div>
                        <div class="left-text"></div>
                    </div>
                    <div class="header-center-btn" j-word-label="G2018102617064252094">销售目标查询</div>
                    <div class="header-right-btn">
                        <div class="right-icon icon-extend"></div>
                    </div>
                </div>
            </div>
            <div class="center-ios" style="background:white;">
                <div class="search-body">
                    <div class="input-tr">
                        <div class="input-tr-body" style="width: 100%">
                            <div class="input-border" style="width:80%">
                                <input type="text" class="yudu-input noborder" v-model="input.searchUserNm" :placeholder="lang.searchUserNm" />
                            </div>
                            <div class="input-extend">
                                <button style="width: 100%;height: 33px;border-radius: 5px;" @click="getWriteTarget()" type="button" class="mui-btn mui-btn-primary long" j-word-label="W2018082711232500387">$((lang.search))</button>
                            </div>
                        </div>
                    </div>
                    <!--<div class="input-tr">-->
                        <!--<div class="input-tr-body" style="width: 100%">-->
                            <!--<div class="input-border">-->
                                <!--<input type="text" class="yudu-input noborder" v-model="input.searchUserId" :placeholder="lang.searchUserId" />-->
                            <!--</div>-->
                        <!--</div>-->
                    <!--</div>-->
                    <div class="input-tr">
                        <div class="input-tr-body" style="width: 100%">
                            <div class="input-border">
                                <input type="text" class="yudu-input noborder" v-model="input.searchGroupNm" :placeholder="lang.searchGroupNm" />
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-body" style="width: 49%">
                            <div class="input-border">
                                <input type="text" class="yudu-input noborder" v-model="input.searchStartTime" @click="setTargetStartTime()"  />
                            </div>
                        </div>
                        <div class="input-tr-body" style="width: 49%;float: right">
                            <div class="input-border">
                                <input type="text" class="yudu-input noborder" v-model="input.searchEndTime"   @click="setTargetEndTime()"/>
                            </div>
                        </div>
                    </div>
                    <div class="minute-header" style="padding: 10px 0 0 0;">
                        <div class="left-text" style="margin-top: 2px;" j-word-label="W2018102909354232763">$((lang.searchResult))</div>
                        <div class="right-text">
                            <!--<div class="icon-date" style="display: inline-block;"></div>-->
                            <!--<div style="float: right; margin-left: 5px; margin-top: 2px;">2018</div>-->
                        </div>
                    </div>
                </div>
                <div class="users-body" id="muiPushTarget">
                    <div v-for="(target,index) in list.writeTargetList" class="users-item" style="height: auto;overflow: hidden" @click="setWriteTarget(index)">
                        <div>
                            <div class="long" style="width: 100%;float: left;width:45%;font-weight: 700;color: #232e6a">$((lang.userNm))：$((target.EmpNm))</div>
                            <div class="long" style="float: right;width: 50%;text-align: right" v-html="$options.filters.confirmLabel(target.CfmYn)"></div>
                        </div>
                        <div>
                            <div class="long" style="float: left;width: 45%;">$((lang.userId))：$((target.EmpID))</div>
                            <div class="long" style="float: right;width: 50%;text-align: right">$((lang.targetOrder)):$((target.OrderAmt))</div>
                        </div>
                        <div>
                            <div class="long" style="float: left;width: 45%;">$((lang.groupNm))：$((target.DeptNm))</div>
                            <div class="long" style="float: right;width: 50%;text-align: right">$((lang.targetInvoice)):$((target.InvoiceAmt))</div>
                        </div>
                        <div>
                            <div class="long" style="float: left;width: 45%;">$((lang.targetDate))：$((target.SAPlanDate | date))</div>
                            <div class="long" style="float: right;width: 50%;text-align: right">$((lang.targetBill)):$((target.BillAmt))</div>
                        </div>
                        <div>
                            <div class="long" style="float: left;width: 45%;">$((lang.currId))：$((target.CurrCd | currSwitch))</div>
                            <div class="long" style="float: right;width: 50%;text-align: right">$((lang.targetReceipt)):$((target.ReceiptAmt))</div>
                        </div>
                    </div>
                    <div class="loading" v-show="view.writeTargetIsLoading">
                        <i class="mui-spinner mui-spinner-black" style="width: 30px;height: 30px;"></i>
                        <div class="nodata" style="margin-top: 0">loading</div>
                    </div>
                    <div class="loading" v-show="view.writeTargetNoData">
                        <div class="nodata" style="margin-top: 0" j-word-label="W2018062810475725084">$((lang.nodata))</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
</script>
<script src="/js/WEI_2300/WEI_2300_Lists.js?v=1063"></script>
</html>
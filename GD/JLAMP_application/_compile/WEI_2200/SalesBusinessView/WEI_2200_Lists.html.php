<?php /* Template_ 2.2.6 2019/11/29 15:26:05 /home/gdmerp.yudo.com.cn/public_html/JLAMP_application/views/SalesBusinessView/WEI_2200_Lists.html 000058569 */ ?>
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
    <link rel="stylesheet" href="/css/yudo-ui.css?v=<?php $this->print_("WEI_2200Version",$TPL_SCP,1);?>">
    <link rel="stylesheet" href="/css/common.css?v=1003">
    <link rel="stylesheet" href="/css/WEI_2200/WEI_2200_Lists.css?v=<?php $this->print_("WEI_2200Version",$TPL_SCP,1);?>">
    <link rel="stylesheet" href="/css/mui.min.css?v=1080">
    <link rel="stylesheet" href="/css/mui.picker.min.css">
    <link rel="stylesheet" href="/js/WEI_2100/css/layui.css">
    <!--jquery vue-->
    <script type="text/javascript" src="/third_party/jquery-2.1.4/jquery.js"></script>
    <script>var jq = $.noConflict();</script>
    <script src="/js/vue.js"></script>
    <!--mui echarts multi fastclick-->
    <script src="/js/mui.min.js?v=1001"></script>
    <script src="/js/WEI_2100/layui.all.js"></script>
    <script src="/js/multiHttp.js?v=2000"></script>
    <script src="/js/multiSelect.js?v=2009"></script>
    <script src="/js/lang.js?v=1001"></script>
    <script src="/js/echarts.min.js"></script>
    <!--<script src="/js/lang.min.js?v=1001"></script>-->
    <script src="/js/mui.previewimage.js?v=201804261256"></script>
    <script src="/js/mui.zoom.js?v=201804231454"></script>
    <script src="/js/mui.picker.min.js?v=1001"></script>
    <script src="/js/exif.js"></script>
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
    <div class="download-script" v-if="downLoadScript">

    </div>
    <div class="yudo-menu" v-show="menuBuild">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" onclick="multi.backMenu()">
                    <div class="left-icon icon-backmenu"></div>
                    <div class="left-text">$((menuBack))</div>
                </div>
                <div class="header-center-btn" j-word-label="W2018082709474656759">工作计划</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="center-ios">
            <div class="menus">
                <button @click="QueryOpen()" type="button" class="menu-btn" style="padding-top: 2px">
                    <span style="position: relative"><div class="icon-search btn-icon"></div><span j-word-label="W2018082315422856722">查询工作计划/报告信息</span></span>
                </button>
                <button @click="planInfoOpen()" type="button" class="menu-btn" style="padding-top: 2px">
                    <span style="position: relative"><div class="icon-search btn-icon"></div><span j-word-label="W2019022114581611384">工作计划统计</span></span>
                </button>
                <button @click="addPlanOpen('add')" type="button" class="menu-btn" style="padding-top: 2px">
                    <span style="position: relative"><div class="icon-write btn-icon"></div><span j-word-label="W2018082315424910717">新增工作计划</span></span>
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
    <div v-show="dateListBuild" style="z-index: 2;" class="yudo-window">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" onclick="leon.QueryClose()">
                    <div class="left-icon icon-back-2"></div>
                    <div class="left-text"></div>
                </div>
                <div class="header-center-btn" j-word-label="W2018082315411788024">工作计划/报告查询</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="center-ios">
            <div class="screen">
                <div class="input-tr" style="margin: 0">
                    <div class="input-tr-title long" j-word-label="W2018082315414307785"></div>
                    <div class="input-tr-body">
                        <div class="input-border" style="margin-right: 5px">
                            <input @click="getCalendarDate('calendarDate')" readonly="true" v-model="calendarDate" type="text"   class="yudo-input noborder screen-pro">
                        </div>
                    </div>
                </div>
                <div class="heng-line "></div>
            </div>
            <div class="scroll" style="top:100px">
                <div v-for="(day,index) in dayList" class="day-border">
                    <div class="day-body">
                        <div style="margin-bottom: 10px;width: 100%;height: 20px;text-align: center;border-bottom: 1px solid #cecece">$((index+1))</div>
                        <div @click="queryPlanOpen(index+1)" v-html="$options.filters.dayChange(day.plan,'plan')"></div>
                        <div @click="queryReptOpen(index+1)" v-html="$options.filters.dayChange(day.rept,'rept')"></div>
                    </div>
                </div>
            </div>
        </div>
<!--        <div class="sub_contents" style="width: 100%;height: 100%;padding-top: 50px;position: relative">-->
    </div>
    <div class="yudo-window" v-show="viewPlanData">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" id="backMenu" @click="planInfoClose()">
                    <div class="left-icon icon-back-2"></div>
                    <div class="left-text"></div>
                </div>
                <div class="header-center-btn" j-word-label="W2019022114581611384">工作计划统计</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="center-ios" id="centerControl" style="background: white;">
            <div class="info-search" style="height:130px">
                <div class="info-search-input" style="width: 75%">
                    <div class="write-input" @click="searchDate(0)" style="margin-top: 10px">
                        <div style="float:left;margin-top: 4px;display: inline-block;width: 25px;height: 25px" class="icon-date" ></div>
                        <div style="float:left;margin-top: 10px;margin-left: 15px;">$((startDate))</div>
                    </div>
                    <div class="write-input" @click="searchDate(1)" style="margin-top: 10px">
                        <div style="float:left;margin-top: 4px;display: inline-block;width: 25px;height: 25px" class="icon-date" ></div>
                        <div style="float:left;margin-top: 10px;margin-left: 15px;">$((endDate))</div>
                    </div>
                </div>
                <div class="search-btn" style="height: 90%;width: 25%;margin-top: 5px">
                    <button class="mui-btn noborder" style="font-size: 14px;line-height: 100%" @click="getPlanOrReptCount()" j-word-label="W2018082711232500387">
                        $((langSearch))
                    </button>
                </div>
            </div>
            <div class="info-minute">
                <div class="minute-header">
                    <div class="left-text"
                         style="color: #212121;margin-top: 2px" >$((langMinute))</div>
                </div>
                <div class="minute-project">
                    <div class="minute-table">
                        <div v-if="viewPlanNoData" class="nodata"j-word-label="W2018062810475725084" >$((langNoData))</div>
                        <div class="minute-list" style="border-bottom: 5px solid #f9f9f9;" v-for="(item,index) in planCountList" >
                            <div class="minute-body" style="height: 60px" v-bind:style="{'background':item.background,'border-left-color':item.background,'color':item.color}" >
                                <div class="minute-body-title"  v-bind:style="{'color':item.titlecolor}">$((item.DeptNm))</div>
                                <div class="minute-body-th">
                                    <div class="minute-body-td long">$((langPlan))：$((item.PlanCount))</div>
                                    <div class="minute-body-td long">$((langRept))：$((item.ReptCount))</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="slide_panel" style="z-index: 1" class="yudo-window" v-show="planMinuteBuild" style="padding-top:50px;">
        <!-- contents -->
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" @click="planMinuteClose()">
                    <div class="left-icon icon-back-2"></div>
                    <div class="left-text"></div>
                </div>
                <div class="header-center-btn" j-word-label="W2018082315424910717">新增工作计划</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="center-ios">
            <div class="yudo-scroll">
                <div class="area" style="position: relative">
                    <div class="title flex-left">
                        <div class="len-3" j-word-label="W2018082709474656759">工作计划</div>
                        <div class="len-7 flex-right" style="height: 40px;padding: 5px 0;line-height: 30px">
                            <button class="yudo-btn-primary long" j-word-label="W2018082315432220012" style="height: 25px;width: 100px;" v-on:click="addReptOpen('add')">工作报告录入</button>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><div class="input-title" j-word-label="W2018082315430910361">活动计划编号</div></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" readonly="true" v-model="planNo" class="read-only yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr" style="margin-bottom: 10px">
                        <div class="input-tr-title long th-red"><div class="input-title"  j-word-label="W2018082315433821012">活动计划日</div></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" readonly="true"  @click="getDate('planDate')" v-model="planDate" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long th-red"><div class="input-title" j-word-label="W2018041913373764065">职员名称</div></div>
                        <div class="input-tr-body" >
                            <div class="input-border">
                                <div class="pop-modal-power"><span class="mui-icon mui-icon-more"></span></div>
                                <input type="text" readonly="true"@click="queryUserOpen(0)" v-model="planGroupNm"  class="read-only yudo-input noborder">
                            </div>
                        </div>
                        <div class="input-tr-body" style="margin-left: 10px">
                            <div class="input-border">
                                <div class="pop-modal-power"><span class="mui-icon mui-icon-more"></span></div>
                                <input type="text" readonly="true" @click="queryUserOpen(0)" v-model="planUserNm" class="read-only yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long" j-word-label="W2018082315443716702">状态</div>
                        <div class="input-tr-body">
                            <div class="yudo-span">
                                <span style="font-size: 14px;padding: 5px 10px" class="yudo-label label-primary">$((planStatus))</span>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long th-red" j-word-label="W2018082315450410028"><span>工作活动区分</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="icon-xiala select-btn"></div>
                                <select v-model="actGubunId" type="text" @change="_actGubun(actGubunId)" class="yudo-input noborder screen-pro">
                                    <option :value="item.value" :disabled="planWriteControl" v-for="(item,index) in select_actGubun">$((item.text))</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long th-red" j-word-label="W2018082315452344083"><span>工作活动范畴</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="icon-xiala select-btn"></div>
                                <select v-model="actGubunClassId" type="text" @change="_actGubunClass(actGubunClassId)" class="yudo-input noborder screen-pro">
                                    <option :value="item.value" :disabled="planWriteControl" v-for="(item,index) in select_actGubunClass">$((item.text))</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div v-bind:class="css.mustYn" class="input-tr-title long"><div class="input-title" j-word-label="W2018041913362840092">客户名称</div></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="pop-modal-power"><span class="mui-icon mui-icon-more"></span></div>
                                <input type="text" readonly="true" v-model="planCustNm" @click="queryCustOpen(0)" class="read-only yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div  class="input-tr-title long"><div class="input-title" j-word-label="W2018082315454442072">目的地名</div></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input v-bind:readonly="planWriteControl" type="text" v-model="planDestinationNm" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div  class="input-tr-title long th-red"><div class="input-title"  j-word-label="W2018082315455904393">工作活动标题</div></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input v-bind:readonly="planWriteControl" type="text" v-model="planActTitle" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr" style="margin-bottom: 10px">
                        <div class="input-tr-title long th-red"><div class="input-title"  j-word-label="W2018082315462027014">开始时间</div></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" readonly="true"  @click="getDatetime('planStartDate')" v-model="planStartDate" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr" style="margin-bottom: 10px">
                        <div class="input-tr-title long th-red"><div class="input-title"  j-word-label="W2018082315463638028">结束时间</div></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" readonly="true"  @click="getDatetime('planEndDate')" v-model="planEndDate" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr" style="margin-bottom: 10px">
                        <div class="input-tr-title-textarea long" j-word-label="W2018082315472045055">活动内容</div>
                        <div class="input-tr-body">
                            <div class="input-border-textarea">
                                <textarea type="text" v-bind:readonly="planWriteControl" v-model="planActContents" class="yudo-textarea noborder"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr-end">
                        <div class="input-tr-title long" j-word-label="W2018082315473941312">作报告与否</div>
                        <div class="input-tr-body">
                            <div v-html="$options.filters.power(planJobReportYn)"></div>
                        </div>
                    </div>
                    <div class="input-tr-end">
                        <div class="input-tr-title long" j-word-label="W2018082315475957074">完成与否</div>
                        <div class="input-tr-body">
                            <div  @click="changeFinishYn()" v-html="$options.filters.power(planFinishYn)"></div>
                        </div>
                    </div>
                    <div class="title" j-word-label="W2018082315482303048">工作现场</div>
                    <div  style="overflow: auto; height: 200px;">
                        <ul class="mui-table-view" style="text-align: left">
                            <li class="mui-table-view-cell" v-on:click="planPhotoOpen()">
                                <a class="mui-navigate-right" j-word-label="W2018062810461626308" > 照片</a>
                            </li>
                            <li class="mui-table-view-cell">
                               <a><i class="layui-icon layui-icon-location"></i>&nbsp;<span style="color: #b3b3b3">$((planLocationAddr))</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="save-pro">
                <div class="save-pro-body flex-center">
                    <div @click="saveController" class="yudo-btn" >$((langSave))</div>
                </div>
            </div>
        </div>
    </div>
    <div id="slide_panel2" style="z-index: 1" class="yudo-window" v-show="reptMinuteBuild" style="padding-top:50px;">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" @click="reptMinuteClose()">
                    <div class="left-icon icon-back-2"></div>
                    <div class="left-text"></div>
                </div>
                <div class="header-center-btn"  j-word-label="W2018082315432220012">新增工作报告</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="center-ios">
            <div class="yudo-scroll">
                <div class="area" style="position: relative">
                    <div class="input-tr">
                        <div class="input-tr-title long"><div class="input-title" j-word-label="W2018082315485070704">工作报告编号</div></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" readonly="true" v-model="reptNo" class="read-only yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr" style="margin-bottom: 10px">
                        <div class="input-tr-title long th-red"><div class="input-title"  j-word-label="W2018082315511665015">工作报告日</div></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" readonly="true"  @click="getDate('reptDate')" v-model="reptDate" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long th-red"><div class="input-title" j-word-label="W2018082315430910361">活动计划编号</div></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" readonly="true" v-model="reptPlanNo" class="read-only yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long th-red"><div class="input-title" j-word-label="W2018041913373764065">职员名称</div></div>
                        <div class="input-tr-body" >
                            <div class="input-border">
                                <div class="pop-modal-power"><span class="mui-icon mui-icon-more"></span></div>
                                <input type="text" readonly="true"@click="queryUserOpen(1)" v-model="reptGroupNm"  class="read-only yudo-input noborder">
                            </div>
                        </div>
                        <div class="input-tr-body" style="margin-left: 10px">
                            <div class="input-border">
                                <div class="pop-modal-power"><span class="mui-icon mui-icon-more"></span></div>
                                <input type="text" readonly="true" @click="queryUserOpen(1)" v-model="reptUserNm" class="read-only yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long th-red" j-word-label="W2018082315450410028"><span>工作活动区分</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="icon-xiala select-btn"></div>
                                <input type="text" readonly="true"  v-model="reptActGubun" class="read-only yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long th-red" j-word-label="W2018082315452344083"><span>工作活动范畴</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="icon-xiala select-btn"></div>
                                <select v-model="reptActGubunClassId" type="text"  class="yudo-input noborder screen-pro">
                                    <option :value="item.value" :disabled="reptWriteControl" v-for="(item,index) in select_reptActGubunClass">$((item.text))</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long th-red" j-word-label="W2018082315515952088">客户状态</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="icon-xiala select-btn"></div>
                                <select v-model="reptCustPatternId" type="text"  class="yudo-input noborder screen-pro">
                                    <option :value="item.value" :disabled="reptWriteControl" v-for="(item,index) in select_reptCustPattern">$((item.text))</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long th-red"><div class="input-title" j-word-label="W2018041913362840092">客户名称</div></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="pop-modal-power"><span class="mui-icon mui-icon-more"></span></div>
                                <input type="text" readonly="true" v-model="reptCustNm" @click="queryCustOpen(1)" class="read-only yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div  class="input-tr-title long th-red"><div class="input-title"  j-word-label="W2018082315523040398">工作标题</div></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input v-bind:readonly="reptWriteControl"  type="text" v-model="reptTitle" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr" style="margin-bottom: 10px">
                        <div class="input-tr-title long th-red"><div class="input-title"  j-word-label="W2018082315524538069">会议开始时间</div></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" readonly="true"  @click="getDatetime('reptStartDate')" v-model="reptStartDate" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr" style="margin-bottom: 10px">
                        <div class="input-tr-title long th-red"><div class="input-title"  j-word-label="W2018082315525953351">会议结束时间</div></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" readonly="true"  @click="getDatetime('reptEndDate')" v-model="reptEndDate" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div  class="input-tr-title long th-red"><div class="input-title"  j-word-label="W2018082315531669002">会议地点</div></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input v-bind:readonly="reptWriteControl"  type="text" v-model="reptMeetingPlace" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div  class="input-tr-title long th-red"><div class="input-title"   j-word-label="W2018082315533209792">会议主题</div></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input v-bind:readonly="reptWriteControl"  type="text" v-model="reptMeetingSubject" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div  class="input-tr-title long th-red"><div class="input-title"  j-word-label="W2018082315534995345">参加人员</div></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input v-bind:readonly="reptWriteControl"  type="text" v-model="reptAttendPerson" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div  class="input-tr-title long"><div class="input-title"  j-word-label="W2018082315542328712">客户要求事项</div></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input v-bind:readonly="reptWriteControl"  type="text" v-model="reptCustRequstTxt" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr" style="margin-bottom: 10px">
                        <div class="input-tr-title-textarea long th-red" j-word-label="W2018082315550346731">协商事项</div>
                        <div class="input-tr-body">
                            <div class="input-border-textarea">
                                <textarea type="text" v-bind:readonly="reptWriteControl" v-model="reptSubjectDisTxt" class="yudo-textarea noborder"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr" style="margin-bottom: 10px">
                        <div class="input-tr-title long"><div class="input-title"  j-word-label="W2018082315551867068">客户要求日期</div></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" readonly="true"  @click="getDate('reptReqConductDate')" v-model="reptReqConductDate" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div  class="input-tr-title long"><div class="input-title"  j-word-label="W2018041913225420017">备注</div></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input v-bind:readonly="reptWriteControl"  type="text" v-model="reptRemark" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr-end">
                        <div class="input-tr-title long" j-word-label="W2018071009351100377">确定</div>
                        <div class="input-tr-body">
                            <div style="float: right" class="mui-switch" id="reptConfirm">
                                <div class="mui-switch-handle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="title" j-word-label="W2018082315482303048">工作现场</div>
                    <div  style="overflow: auto; height: 200px;">
                        <ul class="mui-table-view" id="" style="text-align: left">
                            <li class="mui-table-view-cell" v-on:tap="reptPhotoOpen()">
                                <a class="mui-navigate-right" j-word-label="W2018062810461626308" > 照片</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="save-pro">
                <div class="save-pro-body flex-center">
                    <div @click="saveController" class="yudo-btn" >$((langSave))</div>
                </div>
            </div>
        </div>
    </div>
    <div v-show="planPhotoBuild" style="z-index: 2;" class="yudo-window">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" @click="planPhotoClose()">
                    <div class="left-icon icon-back-2"></div>
                    <div class="left-text" ></div>
                </div>
                <div class="header-center-btn" j-word-label="W2018062810530023371">照片列表</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="sub_contents" style="top: 50px;bottom: 0;overflow-y:auto;position: absolute;padding-bottom: 50px">
            <div class="search_area" style="height:100%;width: 100%;text-align: center;">
                <ul class="mui-table-view" id="planPhotoList" style="text-align: left">
                    <li class="mui-table-view-cell mui-transitioning" style="padding: 0px" v-for="(photo,index) in planPhotoList">
                        <div class="mui-slider-right mui-disabled">
                            <a class="mui-btn mui-btn-red" style="transform: translate(0px, 0px);" v-on:tap="delPlanPhoto(index,$event)" >删除</a>
                        </div>
                        <div class="mui-slider-handle" style="transform: translate(0px, 0px);">
                            <div style="margin: 0!important;" class="mui-content-padded">
                                <img style="height: 80px;width: 80px;max-width:80px" class="mui-media-object mui-pull-left " :src="photo.imagedir" data-preview-src="" data-preview-group="1" >
                            </div>
                            <span style="line-height: 80px">$((photo.FileNm))</span>
                        </div>
                    </li>
                </ul>
                <div class="saves" style="position: fixed;width: 100%;bottom: 10px;left: 0;height:30px;margin-left:auto;margin-right: auto">
                    <input @click="takPhoto()" v-model="planPhotoNm" id="photo-up" type="button" value="上传" class="save-btn" style="padding-top: 2px;margin-bottom: 0;height: 38px"/>
                </div>
            </div>
        </div>
        <input style="display: none"  type="file" id="planPhoto"  name="file" accept="image/gif,image/jpg,image/jpeg,image/bmp,image/png" multiple="multiple" @change="uploadPlanPhoto" >
    </div>
    <div v-show="reptPhotoBuild" style="z-index: 2;" class="yudo-window">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" @click="reptPhotoClose()">
                    <div class="left-icon icon-back-2"></div>
                    <div class="left-text" ></div>
                </div>
                <div class="header-center-btn" j-word-label="W2018062810530023371">照片列表</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="sub_contents" style="top: 50px;bottom: 0;overflow-y:auto;position: absolute;padding-bottom: 50px">
            <div class="search_area" style="height:100%;width: 100%;text-align: center;">
                <ul class="mui-table-view" id="reptPhotoList" style="text-align: left">
                    <li class="mui-table-view-cell mui-transitioning" style="padding: 0;" v-for="(photo,index) in reptPhotoList">
                        <div class="mui-slider-right mui-disabled">
                            <a class="mui-btn mui-btn-red" style="transform: translate(0px, 0px);" v-on:tap="delReptPhoto(index,$event)" >删除</a>
                        </div>
                        <div class="mui-slider-handle" style="transform: translate(0px, 0px);">
                            <div style="margin: 0!important;" class="mui-content-padded">
                                <img style="height: 80px;width: 80px;max-width: 80px" class="mui-media-object mui-pull-left" :src="photo.imagedir" data-preview-src="" data-preview-group="1" >
                            </div>
                            <span style="line-height: 80px">$((photo.FileNm))</span>
                        </div>
                    </li>
                </ul>
                <div class="saves" style="position: fixed;width: 100%;bottom: 10px;left: 0;height:30px;margin-left:auto;margin-right: auto">
                    <input @click="takReptPhoto()" v-model="reptPhotoNm" type="button" value="上传" class="save-btn" style="padding-top: 2px;margin-bottom: 0;height: 38px"/>
                </div>
            </div>
        </div>
        <input style="display: none"  type="file" id="reptPhoto"  name="file" multiple="multiple" @change="uploadReptPhoto" >
    </div>
    <div v-show="dateQueryBuild"  style="z-index: 2;" class="yudo-window">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" @click="queryPlanClose()">
                    <div class="left-icon icon-back-2"></div>
                    <div class="left-text"></div>
                </div>
                <div class="header-center-btn" >Search</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="center-ios">
            <div class="search" >
                <div class="input-tr">
                    <div style="width: 80px" class="input-tr-title long"><div class="input-title" j-word-label="W2018082712530123037" >编号</div></div>
                    <div  class="input-tr-body flex-left">
                        <div class="input-border" style="margin-right: 5px;flex: 1">
                            <input type="text"  v-model="number" class="yudo-input noborder">
                        </div>
                        <div class="input-button">
                            <button class="yudo-btn-white"  @click="queryMsg()" j-word-label="W2018082711232500387" >查询</button>
                        </div>
                    </div>
                </div>

                <div class="input-tr" style="margin-bottom: 10px">
                    <div style="width: 80px" class="input-tr-title long"><div class="input-title" j-word-label="W2018082712523165009">计划/报告</div></div>
                    <div class="input-tr-body">
                        <div class="input-border">
                            <div class="icon-xiala select-btn"></div>
                            <select v-model="msgClass"  type="text" class="yudo-input noborder screen-pro">
                                <option v-for="msgClass  in msgClssList" :value="msgClass.value">$((msgClass.text))</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="input-tr" style="margin-bottom: 10px">
                    <div style="width: 80px" class="input-tr-title long"><div class="input-title" j-word-label="W2018082712533876756">时间</div></div>
                    <div class="input-tr-body">
                        <div class="flex-left" style="width: 100%">
                            <div class="input-border" style="margin-right: 5px">
                                <input @click="getDate('msgStartDate')" onfocus="this.blur();"  v-model="msgStartDate" type="text"   class="yudo-input noborder screen-pro">
                            </div>
                            <div class="input-border" style="margin-right: 5px">
                                <input @click="getDate('msgEndDate')" onfocus="this.blur();"  v-model="msgEndDate" type="text"  class="yudo-input noborder screen-pro">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="info-minute scroll" id="mui_pushMsg" style="top:203px;">
                <div class="minute-project" >
                    <!--                    <div id="mui_pushMsg"  class="search_area" style="float: left;overflow-y: auto;height:100%;position: relative">-->
                    <div v-for="(msg,index) in planList" @click="queryPlanMinute(msg.ActPlanNo)" class="minute-list">
                        <div class="minute-body" style="height: 115px">
                            <div class="tr flex-left">
                                <div class="title len-7 long">$((langPlanNo))：$((msg.ActPlanNo))</div>
                                <div class="font-right len-3 long" v-html="$options.filters.statusChange(msg.Status)"></div>
                            </div>
                            <div class="tr">
                                <div class="len-10 long" >$((langCustNm))：$((msg.CustNm))</div>
                            </div>
                            <div class="tr">
                                <div class="len-10 long" >$((langCustPron))：$((msg.CustUserNm))</div>
                            </div>
                            <div class="tr flex-left">
                                <div class="len-5 long">$((langUserNm))：$((msg.EmpNm))</div>
                                <div class="font-right len-5 long">$((langGroupNm))：$((msg.DeptNm))</div>
                            </div>
                            <div  class="tr flex-left">
                                <div class="len-7 long"><i class="layui-icon layui-icon-location"></i>&nbsp;<span style="color: #b3b3b3">$((msg.LocationAddr))</span></div>
                                <div class="font-right len-3 long">$((msg.ActPlanDate))</div>
                            </div>
                        </div>
                    </div>
                    <div v-for="(msg,index) in reptList" @click="queryReptMinute(msg.ActReptNo,'rept')" class="minute-list">
                        <div class="minute-body" style="height: 135px">
                            <div class="tr">
                                <div class="title len-10 long">$((langReptNo))：$((msg.ActReptNo))</div>
                            </div>
                            <div class="tr flex-left">
                                <div class="len-5 long">$((langUserNm))：$((msg.EmpNm))</div>
                                <div class="font-right len-5 long">$((langGroupNm))：$((msg.DeptNm))</div>
                            </div>
                            <div class="tr">
                                <div class="len-10 long" >$((langPlanNo))：$((msg.ActPlanNo))</div>
                            </div>
                            <div class="tr flex-left">
                                <div class="len-5 long">$((langMeetingSubject))：$((msg.MeetingSubject))</div>
                                <div class="font-right len-5 long">$((langMeetingPlace))：$((msg.MeetingPlace))</div>
                            </div>
                            <div class="tr">
                                <div class="len-10 long" >$((langCustNm))：$((msg.CustNm))</div>
                            </div>
                            <div class="tr flex-left">
                                <div class="len-5 long">$((langCustPron))：$((msg.CustUserNm))</div>
                                <div class="font-right len-5 long">$((msg.ActReptDate))</div>
                            </div>
                        </div>
                    </div>
                    <div class="layui-flow-more" v-show="msgIsLoadding">
                        <i class="layui-anim layui-anim-rotate layui-anim-loop layui-icon layui-icon-loading-1" style="font-size: 25px">
                        </i>
                        <div class="doc-icon-name">loading</div>
                    </div>
                    <div class="layui-flow-more" j-word-label="W2018062810475725084" v-show="msgNoData">没有更多了</div>
                </div>
            </div>
        </div>
    </div>
    <div v-show="userListBuild"  style="z-index: 2;" class="yudo-window">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" @click="queryUserClose()">
                    <div class="left-icon icon-back-2"></div>
                    <div class="left-text"></div>
                </div>
                <div class="header-center-btn" j-word-label="W2018082713370902732">职员查询</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="sub_contents" style="height: 100%;padding-top: 50px;position: relative">
            <div class="search_area" style="position: absolute;top: 50px;border-bottom: 1px solid #dadada;">
                <table class="search_table">
                    <colgroup>
                        <col width="100px;">
                    </colgroup>
                    <tr>
                        <th j-word-label="W2018041913373764065">职员姓名</th>
                        <td colspan="1">
                            <input v-model="userNmQuery" type="text" id="this_user"  class="multi-find-windows search_input" data-date-format="yyyy-mm-dd">
                        </td>
                        <td>
                            <button class="button-2000" @click="getUser()" style="font-size: 15px" j-word-label="W2018082711232500387">查询</button>
                        </td>

                    </tr>
                    <tr>
                        <th j-word-label="W2018041913385580778">职员工号</th>
                        <td colspan="3">
                            <input v-model="userIdQuery" type="text" id="this_user_id"  class="multi-find-windows search_input" data-date-format="yyyy-mm-dd">
                        </td>
                    </tr>
                    <tr>
                        <th j-word-label="W2018041913371894064">部门名称</th>
                        <td colspan="3">
                            <input v-model="groupQuery" type="text" id="this_group"  class="multi-find-windows search_input" data-date-format="yyyy-mm-dd">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="search_area" style="height:100%;padding-top: 109px">
                <!--<table style="height: 30px;white-space: nowrap;text-align: center;position:fixed;top:199px;z-index: 3;left: 0" id="asuser_tr" class="basic_table">-->
                <!--<tr>-->
                <!--<th ><div class="basic_table_div" style="width: 30px">NO</div></th>-->
                <!--<th style="text-align:center"><div j-word-label="W2018041913371894064" class="basic_table_div" style="width: 150px">部门名称</div></th>-->
                <!--<th style="text-align:center"><div  j-word-label="W2018041913373764065" class="basic_table_div" style="width: 100px">职员姓名</div></th>-->
                <!--<th style="text-align:center" ><div j-word-label="W2018041913385580778" class="basic_table_div" style="width: 100px">职员工号</div></th>-->
                <!--</tr>-->
                <!--</table>-->
                <div id="mui_pushuser" class="search_area" style="float: left;overflow-y: auto;height:100%;position: relative">
                    <div v-for="(user,index) in userList" @click="setUser(index)" style="height: 75px;border-bottom: 1px solid #dadada;padding: 5px">
                        <div>
                            <div style="width: 100%;float: left;font-weight: 700;color: #232e6a">$((langUserNm))：$((user.EmpNm))</div>
                        </div>
                        <div>
                            <div style="float: left">$((langUserNo))：$((user.EmpID))</div>
                            <div style="float: right"><i style="font-size: 30px;font-weight: 700" class="layui-icon layui-icon-add-circle-fine"></i></div>
                        </div>
                        <div>
                            <div class="long" style="margin-top: -5px;float: left;width: 100%;">$((langGroupNm))：$((user.DeptNm))</div>
                        </div>
                    </div>
                    <!--<div class="search_area" id="user-list" style="overflow-x:auto;padding-top: 30px">-->
                    <!--<table style="height: 30px;white-space: nowrap;text-align: center;" class="basic_table">-->
                    <!--<tbody id="find-user-list">-->
                    <!--<tr v-for="(user,index) in userslist" @click="set_user(index)">-->
                    <!--<td><div class="basic_table_div" style="width: 30px">$((index+1))</div></td>-->
                    <!--<td><div class="basic_table_div" style="width: 150px">$((user.EmpNm))</div></td>-->
                    <!--<td><div class="basic_table_div" style="width: 100px">$((user.DeptNm))</div></td>-->
                    <!--<td><div class="basic_table_div" style="width: 100px">$((user.EmpID))</div></td>-->
                    <!--</tr>-->
                    <!--</tbody>-->
                    <!--</table>-->
                    <!--</div>-->
                    <div class="layui-flow-more" v-show="userIsLoadding">
                        <i class="layui-anim layui-anim-rotate layui-anim-loop layui-icon layui-icon-loading-1" style="font-size: 25px">
                        </i>
                        <div class="doc-icon-name">loading</div>
                    </div>
                    <div class="layui-flow-more" j-word-label="W2018062810475725084" v-show="userNoData">没有更多了</div>
                </div>
            </div>
        </div>
    </div>
    <div v-show="custListBuild"  style="z-index: 2;" class="yudo-window">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" @click="queryCustClose()">
                    <div class="left-icon icon-back-2"></div>
                    <div class="left-text"></div>
                </div>
                <div class="header-center-btn" j-word-label="W2018082713485166321">客户查询</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="sub_contents" style="height: 100%;padding-top: 50px;position: relative">
            <div class="search_area" style="position: absolute;top: 50px;border-bottom: 1px solid #dadada;">
                <table class="search_table">
                    <colgroup>
                        <col width="100px;">
                    </colgroup>
                    <tr>
                        <th j-word-label="W2018041913362840092">客户名称</th>
                        <td colspan="1">
                            <input v-model="custNmQuery" type="text"   class="multi-find-windows search_input " data-date-format="yyyy-mm-dd">
                        </td>
                        <td>
                            <button class="button-2000" @click="getCust()" style="font-size: 15px" j-word-label="W2018082711232500387">查询</button>
                        </td>

                    </tr>
                    <tr>
                        <th j-word-label="W2018082713504599324">客户编号</th>
                        <td colspan="3">
                            <input v-model="custIdQuery" type="text"   class="multi-find-windows search_input" data-date-format="yyyy-mm-dd">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="search_area" style="height:100%;padding-top: 73px">
                <!--<table style="height: 30px;white-space: nowrap;text-align: center;position:fixed;top:199px;z-index: 3;left: 0" id="asuser_tr" class="basic_table">-->
                <!--<tr>-->
                <!--<th ><div class="basic_table_div" style="width: 30px">NO</div></th>-->
                <!--<th style="text-align:center"><div j-word-label="W2018041913371894064" class="basic_table_div" style="width: 150px">部门名称</div></th>-->
                <!--<th style="text-align:center"><div  j-word-label="W2018041913373764065" class="basic_table_div" style="width: 100px">职员姓名</div></th>-->
                <!--<th style="text-align:center" ><div j-word-label="W2018041913385580778" class="basic_table_div" style="width: 100px">职员工号</div></th>-->
                <!--</tr>-->
                <!--</table>-->
                <div id="mui_pushcust" class="search_area" style="float: left;overflow-y: auto;height:100%;position: relative">
                    <div v-for="(cust,index) in custList" @click="setCust(index)" style="height: 75px;border-bottom: 1px solid #dadada;padding: 5px">
                        <div>
                            <div class="long" style="width: 70%;float: left;font-weight: 700;color: #232e6a">$((langCustNm))：$((cust.CustNm))</div>
                        </div>
                        <div>
                            <div style="width: 30%;text-align: right;float: right" v-html="$options.filters.custStatus(cust.status,cust.StatusId)"></div>
                        </div>
                        <div>
                            <div style="float: left">$((langCustNo))：$((cust.CustCd))</div>
                            <!--<div style="float: right"><i style="font-size: 30px;font-weight: 700" class="layui-icon layui-icon-add-circle-fine"></i></div>-->
                        </div>
                        <div>
                            <div class="long" style="float: left;width: 100%;" v-html="$options.filters.custKoOrFo(cust.KoOrFo)"></div>
                        </div>
                    </div>
                    <!--<div class="search_area" id="user-list" style="overflow-x:auto;padding-top: 30px">-->
                    <!--<table style="height: 30px;white-space: nowrap;text-align: center;" class="basic_table">-->
                    <!--<tbody id="find-user-list">-->
                    <!--<tr v-for="(user,index) in userslist" @click="set_user(index)">-->
                    <!--<td><div class="basic_table_div" style="width: 30px">$((index+1))</div></td>-->
                    <!--<td><div class="basic_table_div" style="width: 150px">$((user.EmpNm))</div></td>-->
                    <!--<td><div class="basic_table_div" style="width: 100px">$((user.DeptNm))</div></td>-->
                    <!--<td><div class="basic_table_div" style="width: 100px">$((user.EmpID))</div></td>-->
                    <!--</tr>-->
                    <!--</tbody>-->
                    <!--</table>-->
                    <!--</div>-->
                    <div class="layui-flow-more" v-show="custIsLoadding">
                        <i class="layui-anim layui-anim-rotate layui-anim-loop layui-icon layui-icon-loading-1" style="font-size: 25px">
                        </i>
                        <div class="doc-icon-name">loading</div>
                    </div>
                    <div class="layui-flow-more" j-word-label="W2018062810475725084" v-show="custNoData">没有更多了</div>

                </div>
            </div>
        </div>
    </div>
<script src="/js/WEI_2200/WEI_2200_Lists.js?v=<?php $this->print_("WEI_2200Version",$TPL_SCP,1);?>"></script>

</body>
</html>
<?php /* Template_ 2.2.6 2019/03/20 17:25:30 /home/merp.yudo.com.cn/public_html/JLAMP_application/modules/WEI_2200/views/WEI_2200_Lists.html 000057285 */ ?>
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
    <link rel="stylesheet" href="/css/yudo-ui.css?v=1053">
    <link rel="stylesheet" href="/css/common.css">
    <link rel="stylesheet" href="/css/WEI_2200/WEI_2200_Lists.css?v=201806080936">
    <link rel="stylesheet" href="/css/mui.min.css?v=1008">
    <link rel="stylesheet" href="/css/mui.picker.min.css">
    <link rel="stylesheet" href="/js/WEI_2100/css/layui.css">
    <!--jquery vue-->
    <script type="text/javascript" src="/third_party/jquery-2.1.4/jquery.js"></script>
    <script>var jq = $.noConflict();</script>
    <script src="/js/vue.js"></script>
    <!--mui echarts multi fastclick-->
    <script src="/js/mui.min.js?v=1001"></script>
    <script src="/js/WEI_2100/layui.all.js"></script>
    <script src="/js/multiHttp.js?v=1001"></script>
    <script src="/js/multiSelect.js?v=2009"></script>
    <script src="/js/lang.js?v=1001"></script>
    <script src="/js/echarts.min.js"></script>
    <!--<script src="/js/lang.min.js?v=1001"></script>-->
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

<div id="slide_panel_bottom" style="display:none;position:absolute;bottom:0;z-index: 2;" class="leon find-window-bottom">
    <table width="100%">
        <colgroup>
            <col width="50%"/>
            <col width="50%"/>
        </colgroup>
        <tr>
            <td class="saves">
                <input onclick="leon.saveController()" id="btn_uploads" type="button" value="保存" class="save-btn" style=";padding-top: 2px;margin-bottom: 0;height: 38px">
                </input>
                <!--<input style="float: left" class="bn_normal_100" onclick="leon.saveController()" id="btn_uploads" type="button" value="保存">-->
            </td>
        </tr>
    </table>
</div>
<div class="yudo-content" id="leon">
    <div class="download-script" v-if="downLoadScript"></div>
    <div class="yudo-menu" v-show="menuBuild">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" id="backMenu1">
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
                <button @click="addPlanOpen()" type="button" class="menu-btn" style="padding-top: 2px">
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
        <div class="sub_contents" style="width: 100%;height: 100%;padding-top: 50px;position: relative">
            <div class="search_area" style="border-bottom: 1px solid #dedede;background: white;position: absolute;top: 50px;z-index: 3">
                <table class="search_table" style="width: 100%;">
                    <colgroup>
                        <col width="100px;">
                    </colgroup>
                    <tr>
                        <th j-word-label="W2018082315414307785" >选择日期</th>
                        <td colspan="3">
                            <div id="year" class="multi-select">
                                <input readonly="readonly" type="text" class="multi-input text-left" v-model="year" />
                                <i class="layui-icon layui-icon-triangle-d"></i>
                            </div>
                        </td>
                        <td colspan="1">
                            <div id="month" class="multi-select">
                                <input readonly="readonly" type="text" class="multi-input text-left" v-model="month" />
                                <i class="layui-icon layui-icon-triangle-d"></i>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div style="width: 100%;height: 100%;padding-top: 40px;overflow-y: auto">
                <div v-for="(day,index) in dayList" class="day-border">
                    <div class="day-body">
                        <div style="margin-bottom: 10px;width: 100%;height: 20px;text-align: center;border-bottom: 1px solid #cecece">$((index+1))</div>
                        <div @click="queryPlanOpen(index+1)" v-html="$options.filters.dayChange(day.plan,'plan')"></div>
                        <div @click="queryReptOpen(index+1)" v-html="$options.filters.dayChange(day.rept,'rept')"></div>
                    </div>
                </div>
            </div>
        </div>
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
    <div id="slide_panel" v-show="planMinuteBuild" style="padding-top:50px;">
        <!-- contents -->
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" onclick="leon.menuOpen()">
                    <div class="left-icon icon-back-2"></div>
                    <div class="left-text"></div>
                </div>
                <div class="header-center-btn" j-word-label="W2018082315424910717">新增工作计划</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="sub_contents" style="padding-bottom: 50px;top: 50px;bottom: 0;overflow-y:auto;position: absolute">
            <!-- 검색 -->
            <div class="search_area">
                <table class="search_table">
                    <colgroup>
                        <col width="100px;">
                    </colgroup>
                    <tr>
                        <th ><div class="input-title" j-word-label="W2018082315430910361">活动计划编号</div></th>
                        <td colspan="4" style="padding-left:20px">
                            <input v-model="planNo" readonly="readonly" type="text" class="multi-input text-left xwrite" style="padding-right: 1px !important;">
                        </td>
                    </tr>
                    <tr>
                        <th ></th>
                        <td colspan="4" style="padding-left:20px">
                            <button style="width: 100%" class="layui-btn layui-btn-primary  layui-btn-sm" v-on:click="addReptOpen('add')"  j-word-label="W2018082315432220012" >工作报告录入</button>
                        </td>
                    </tr>
                    <tr>
                        <th class="th-red"><div class="input-title" j-word-label="W2018082315433821012">活动计划日</div></th>
                        <td colspan="4" style="padding-left:20px">
                            <input id="planDate" onfocus="this.blur();" v-model="planDate"  type="text" class="multi-input text-left" style="padding-right: 1px !important;">
                        </td>
                    </tr>
                    <tr>
                        <th class="th-red"><div class="input-title" j-word-label="W2018041913373764065">职员名称</div></th>
                        <td colspan="3" style="padding-left:20px">
                            <input v-model="planUserNm" readonly="readonly" type="text" class="multi-input text-left xwrite" style="padding-right: 1px !important;">
                        </td>
                        <td colspan="1">
                            <button class="layui-btn layui-btn-primary  layui-btn-sm" v-on:tap="queryUserOpen(0)"  j-word-label="W2018082711232500387" >搜索</button>
                        </td>
                    </tr>
                    <tr>
                        <th ><div class="input-title" j-word-label="W2018041913371894064">部门名称</div></th>
                        <td colspan="4" style="padding-left:20px">
                            <input v-model="planGroupNm" readonly="readonly" type="text" class="multi-input text-left xwrite" style="padding-right: 1px !important;">
                        </td>
                    </tr>
                    <tr>
                        <th ><div class="input-title" j-word-label="W2018082315443716702">状态</div></th>
                        <td colspan="4" rowspan="1" style="padding-left:20px">
                            <span class="layui-badge layui-bg-blue" >$((planStatus))</span>
                        </td>
                    </tr>
                    <tr>
                        <th class="th-red"><div class="input-title" j-word-label="W2018082315450410028">工作活动区分</div></th>
                        <td colspan="4" rowspan="1" style="padding-left:20px">
                            <div id="actGubun" class="multi-select">
                                <input readonly="readonly" type="text" class="multi-input text-left" v-model="actGubun" />
                                <i class="layui-icon layui-icon-triangle-d"></i>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="th-red"><div class="input-title" j-word-label="W2018082315452344083">工作活动范畴</div></th>
                        <td colspan="4" rowspan="1" style="padding-left:20px">
                            <div id="actGubunClass" class="multi-select">
                                <input readonly="readonly" type="text" class="multi-input text-left" v-model="actGubunClass" />
                                <i class="layui-icon layui-icon-triangle-d"></i>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="th-red"><div class="input-title" j-word-label="W2018041913362840092">客户名称</div></th>
                        <td colspan="3" style="padding-left:20px">
                            <input v-model="planCustNm" readonly="readonly" type="text" class="multi-input text-left xwrite" style="padding-right: 1px !important;">
                        </td>
                        <td colspan="1">
                            <button class="layui-btn layui-btn-primary  layui-btn-sm" v-on:tap="queryCustOpen(0)"  j-word-label="W2018082711232500387" >搜索</button>
                        </td>
                    </tr>
                    <tr>
                        <th ><div class="input-title" j-word-label="W2018082315454442072">目的地名</div></th>
                        <td colspan="4" style="padding-left:20px">
                            <input v-bind:readonly="planWriteControl" v-model="planDestinationNm" type="text" class="multi-input text-left" style="padding-right: 1px !important;">
                        </td>
                    </tr>
                    <tr>
                        <th class="th-red"><div class="input-title" j-word-label="W2018082315455904393">工作活动标题</div></th>
                        <td colspan="4" style="padding-left:20px">
                            <input v-bind:readonly="planWriteControl" v-model="planActTitle"  type="text" class="multi-input text-left" style="padding-right: 1px !important;">
                        </td>
                    </tr>
                    <tr>
                        <th class="th-red"><div class="input-title" j-word-label="W2018082315462027014">开始时间</div></th>
                        <td colspan="4" style="padding-left:20px">
                            <input id="planStartDate" onfocus="this.blur();" v-model="planStartDate"  type="text" class="multi-input text-left " style="padding-right: 1px !important;">
                        </td>
                    </tr>
                    <tr>
                        <th class="th-red"><div class="input-title" j-word-label="W2018082315463638028">结束时间</div></th>
                        <td colspan="4" style="padding-left:20px">
                            <input id="planEndDate" onfocus="this.blur();" v-model="planEndDate" type="text" class="multi-input text-left " style="padding-right: 1px !important;">
                        </td>
                    </tr>
                    <tr>
                        <th><div class="input-title" j-word-label="W2018082315472045055">活动内容</div></th>
                        <td colspan="4" style="padding-left:20px;">
                            <textarea v-bind:readonly="planWriteControl" v-model="planActContents" type="text" class="multi-input text-left " style="width: 100%;height: 100px !important;padding-right: 1px !important;"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th ><div class="input-title" j-word-label="W2018082315473941312">作报告与否</div></th>
                        <td colspan="4" rowspan="1" style="padding-left:20px" v-html="$options.filters.power(planJobReportYn)">
                        </td>
                    </tr>
                    <tr>
                        <th ><div class="input-title" j-word-label="W2018082315475957074">完成与否</div></th>
                        <td colspan="4" rowspan="1" style="padding-left:20px" @click="changeFinishYn()" v-html="$options.filters.power(planFinishYn)">
                        </td>
                    </tr>
                    <!--<tr>-->
                        <!--<th ><div class="input-title" j-word-label="W201806281027470">确定</div></th>-->
                        <!--<td colspan="4" rowspan="1" style="padding-left:20px">-->
                            <!--<div style="float: right" class="mui-switch" id="planConfirm" >-->
                                <!--<div class="mui-switch-handle"></div>-->
                            <!--</div>-->
                        <!--</td>-->
                    <!--</tr>-->
                </table>
                <div class="sub_title" j-word-label="W2018082315482303048">工作现场</div>
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
    </div>
    <div id="slide_panel2" v-show="reptMinuteBuild" style="padding-top:50px;">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" onclick="leon.menuOpen()">
                    <div class="left-icon icon-back-2"></div>
                    <div class="left-text"></div>
                </div>
                <div class="header-center-btn"  j-word-label="W2018082315432220012">新增工作报告</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <!-- contents -->
        <div class="sub_contents" style="padding-bottom: 50px;top: 50px;bottom: 0;overflow-y:auto;position: absolute">
            <!-- 검색 -->
            <div class="search_area">
                <table class="search_table">
                    <colgroup>
                        <col width="100px;">
                    </colgroup>
                    <tr>
                        <th ><div class="input-title" j-word-label="W2018082315485070704">工作报告编号</div></th>
                        <td colspan="4" style="padding-left:20px">
                            <input v-model="reptNo" readonly="readonly" type="text" class="multi-input text-left xwrite" style="padding-right: 1px !important;">
                        </td>
                    </tr>
                    <tr>
                        <th class="th-red"><div class="input-title" j-word-label="W2018082315511665015">工作报告日</div></th>
                        <td colspan="4" style="padding-left:20px">
                            <input id="reptDate" v-model="reptDate" onfocus="this.blur();"  type="text" class="multi-input text-left" style="padding-right: 1px !important;">
                        </td>
                    </tr>
                    <tr>
                        <th><div class="input-title" j-word-label="W2018082315430910361">活动计划编号</div></th>
                        <td colspan="4" style="padding-left:20px">
                            <input  v-model="reptPlanNo" readonly="readonly" type="text" class="multi-input text-left xwrite" style="padding-right: 1px !important;">
                        </td>
                    </tr>
                    <tr>
                        <th class="th-red"><div class="input-title" j-word-label="W2018041913373764065">职员名称</div></th>
                        <td colspan="3" style="padding-left:20px">
                            <input v-model="reptUserNm" readonly="readonly" type="text" class="multi-input text-left xwrite" style="padding-right: 1px !important;">
                        </td>
                        <td colspan="1">
                            <button class="layui-btn layui-btn-primary  layui-btn-sm" v-on:tap="queryUserOpen(1)"  j-word-label="W2018082711232500387" >搜索</button>
                        </td>
                    </tr>
                    <tr>
                        <th ><div class="input-title" j-word-label="W2018041913371894064">部门名称</div></th>
                        <td colspan="4" style="padding-left:20px">
                            <input v-model="reptGroupNm" readonly="readonly" type="text" class="multi-input text-left xwrite" style="padding-right: 1px !important;">
                        </td>
                    </tr>
                    <tr>
                        <th class="th-red"> <div class="input-title" j-word-label="W2018082315450410028">工作活动区分</div></th>
                        <td colspan="4" rowspan="1" style="padding-left:20px">
                            <div id="reptActGubun" class="multi-select">
                                <input readonly="readonly" type="text" class="multi-input text-left xwrite" v-model="reptActGubun" />
                                <i class="layui-icon layui-icon-triangle-d"></i>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="th-red"><div class="input-title" j-word-label="W2018082315452344083">工作活动范畴</div></th>
                        <td colspan="4" rowspan="1" style="padding-left:20px">
                            <div id="reptActGubunClass" class="multi-select">
                                <input readonly="readonly" type="text" class="multi-input text-left" v-model="reptActGubunClass" />
                                <i class="layui-icon layui-icon-triangle-d"></i>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="th-red"><div class="input-title" j-word-label="W2018082315515952088">客户状态</div></th>
                        <td colspan="4" rowspan="1" style="padding-left:20px">
                            <div id="reptCustPattern" class="multi-select">
                                <input readonly="readonly" type="text" class="multi-input text-left" v-model="reptCustPattern" />
                                <i class="layui-icon layui-icon-triangle-d"></i>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="th-red"><div class="input-title" j-word-label="W2018041913362840092">客户名称</div></th>
                        <td colspan="3" style="padding-left:20px">
                            <input v-model="reptCustNm" readonly="readonly" type="text" class="multi-input text-left xwrite" style="padding-right: 1px !important;">
                        </td>
                        <td colspan="1">
                            <button class="layui-btn layui-btn-primary  layui-btn-sm" v-on:tap="queryCustOpen(1)"  j-word-label="W2018082711232500387" >搜索</button>
                        </td>
                    </tr>
                    <tr>
                        <th class="th-red"><div class="input-title" j-word-label="W2018082315523040398">工作标题</div></th>
                        <td colspan="4" style="padding-left:20px">
                            <input v-model="reptTitle" v-bind:readonly="reptWriteControl" type="text" class="multi-input text-left" style="padding-right: 1px !important;">
                        </td>
                    </tr>
                    <tr>
                        <th class="th-red"><div class="input-title" j-word-label="W2018082315524538069">会议开始时间</div></th>
                        <td colspan="4" style="padding-left:20px">
                            <input id="reptStartDate" onfocus="this.blur();" v-model="reptStartDate"  type="text" class="multi-input text-left " style="padding-right: 1px !important;">
                        </td>
                    </tr>
                    <tr>
                        <th class="th-red"><div class="input-title" j-word-label="W2018082315525953351">会议结束时间</div></th>
                        <td colspan="4" style="padding-left:20px">
                            <input id="reptEndDate" onfocus="this.blur();" v-model="reptEndDate"  type="text" class="multi-input text-left " style="padding-right: 1px !important;">
                        </td>
                    </tr>
                    <tr>
                        <th class="th-red"><div class="input-title" j-word-label="W2018082315531669002">会议地点</div></th>
                        <td colspan="4" style="padding-left:20px">
                            <input v-model="reptMeetingPlace" v-bind:readonly="reptWriteControl"  type="text" class="multi-input text-left " style="padding-right: 1px !important;">
                        </td>
                    </tr>
                    <tr>
                        <th class="th-red"><div class="input-title" j-word-label="W2018082315533209792">会议主题</div></th>
                        <td colspan="4" style="padding-left:20px">
                            <input v-model="reptMeetingSubject" v-bind:readonly="reptWriteControl"  type="text" class="multi-input text-left " style="padding-right: 1px !important;">
                        </td>
                    </tr>
                    <tr>
                        <th class="th-red"><div class="input-title" j-word-label="W2018082315534995345">参加人员</div></th>
                        <td colspan="4" style="padding-left:20px">
                            <input v-model="reptAttendPerson" v-bind:readonly="reptWriteControl"  type="text" class="multi-input text-left " style="padding-right: 1px !important;">
                        </td>
                    </tr>
                    <tr>
                        <th ><div class="input-title" j-word-label="W2018082315542328712">客户要求事项</div></th>
                        <td colspan="4" style="padding-left:20px">
                            <input v-model="reptCustRequstTxt"  v-bind:readonly="reptWriteControl"  type="text" class="multi-input text-left " style="padding-right: 1px !important;">
                        </td>
                    </tr>
                    <tr>
                        <th class="th-red"><div class="input-title" j-word-label="W2018082315550346731">协商事项</div></th>
                        <td colspan="4" style="padding-left:20px;">
                            <textarea v-model="reptSubjectDisTxt" v-bind:readonly="reptWriteControl" type="text" class="multi-input text-left " style="width: 100%;height: 100px !important;padding-right: 1px !important;"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th ><div class="input-title" j-word-label="W2018082315551867068">客户要求日期</div></th>
                        <td colspan="4" style="padding-left:20px">
                            <input id="reptReqConductDate" onfocus="this.blur();" v-model="reptReqConductDate" type="text" class="multi-input text-left " style="padding-right: 1px !important;">
                        </td>
                    </tr>
                    <tr>
                        <th ><div class="input-title" j-word-label="W2018041913225420017">备注</div></th>
                        <td colspan="4" style="padding-left:20px">
                            <input v-model="reptRemark" v-bind:readonly="reptWriteControl"  type="text" class="multi-input text-left " style="padding-right: 1px !important;">
                        </td>
                    </tr>
                    <tr>
                        <th ><div class="input-title" j-word-label="W2018071009351100377">确定</div></th>
                        <td colspan="4" rowspan="1" style="padding-left:20px">
                            <div style="float: right" class="mui-switch" id="reptConfirm">
                                <div class="mui-switch-handle"></div>
                            </div>
                        </td>
                    </tr>
                </table>
                <div class="sub_title" j-word-label="W2018082315482303048">工作现场
                </div>
                <div  style="overflow: auto; height: 200px;">
                    <ul class="mui-table-view" style="text-align: left">
                        <li class="mui-table-view-cell" v-on:tap="reptPhotoOpen()">
                            <a class="mui-navigate-right" j-word-label="W2018062810461626308" > 照片</a>
                        </li>
                    </ul>
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
                <ul class="mui-table-view" style="text-align: left">
                    <li class="mui-table-view-cell mui-transitioning" style="padding: 0px" v-for="(photo,index) in planPhotoList">
                        <div class="mui-slider-right mui-disabled">
                            <a class="mui-btn mui-btn-red" style="transform: translate(0px, 0px);" v-on:tap="delPlanPhoto(index,$event)" >删除</a>
                        </div>
                        <div class="mui-slider-handle" style="transform: translate(0px, 0px);">
                            <div style="margin: 0!important;" class="mui-content-padded">
                                <img style="height: 80px;width: 80px;max-width:80px" class="mui-media-object mui-pull-left" :src="photo.imagedir" data-preview-src="" data-preview-group="1" >
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
                <ul class="mui-table-view" style="text-align: left">
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
                <div class="header-center-btn" ></div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="sub_contents" style="height: 100%;padding-top: 50px;position: relative">
            <div class="search_area" style="position: absolute;top: 50px;padding-bottom: 5px;border-bottom: 1px solid #dadada;">
                <table class="search_table" >
                    <colgroup>
                        <col width="100px;">
                    </colgroup>
                    <tr>
                        <th j-word-label="W2018082712530123037">编号</th>
                        <td colspan="4">
                            <input type="text" v-model="number" name="fastclick" class="multi-find-windows search_input">
                        </td>
                        <td colspan="1">
                            <button class="button-2000" @click="queryMsg()"  j-word-label="W2018082711232500387" style="font-size:15px">查询</button>
                        </td>
                    </tr>
                    <tr>
                        <th j-word-label="W2018082712523165009">计划/报告</th>
                        <td colspan="5">
                            <select v-model="msgClass" class="multi-find-windows search_input" style="padding: 0">
                                <option v-for="msgClass  in msgClssList" :value="msgClass.value">$((msgClass.text))</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th j-word-label="W2018082712533876756">时间</th>
                        <td colspan="5">
                            <input id="msgStartDate" onfocus="this.blur();"  v-model="msgStartDate" type="text" style="width: 49% !important; float: left" name="fastclick" class="multi-find-windows search_input" />
                            <input id="msgEndDate" onfocus="this.blur();"  v-model="msgEndDate" type="text" style="width: 49% !important;float: right" name="fastclick" class="multi-find-windows search_input"/>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="search_area" style="height:100%;padding-top: 118px">
                    <div id="mui_pushMsg"  class="search_area" style="float: left;overflow-y: auto;height:100%;position: relative">
                        <div v-for="(msg,index) in planList" @click="queryPlanMinute(msg.ActPlanNo)" style=";height: 120px;border-bottom: 1px solid #dadada;padding: 5px">
                            <div>
                                <div style="float: left;font-weight: 700;color: #232e6a">$((langPlanNo))：$((msg.ActPlanNo))</div>
                                <div style="float: right" v-html="$options.filters.statusChange(msg.Status)"></div>
                            </div>
                            <div>
                                <div class="long" style="float: left;width: 100%;">$((langCustNm))：$((msg.CustNm))</div>
                            </div>
                            <div>
                                <div style="float: left;width: 100%">$((langCustPron))：$((msg.CustUserNm))</div>
                            </div>
                            <div>
                                <div style="float: left;width: 40%;overflow: hidden;text-overflow:ellipsis;white-space: nowrap;">$((langUserNm))：$((msg.EmpNm))</div>
                                <div style="float: right">$((langGroupNm))：$((msg.DeptNm))</div>
                            </div>
                            <div>
                                <div style="float: left;width: 55%;overflow: hidden;text-overflow:ellipsis;white-space: nowrap;"><i class="layui-icon layui-icon-location"></i>&nbsp;<span style="color: #b3b3b3">$((msg.LocationAddr))</span></div>
                                <div style="float: right;color: #b3b3b3">$((msg.ActPlanDate))</div>
                            </div>
                        </div>
                        <div v-for="(msg,index) in reptList" @click="queryReptMinute(msg.ActReptNo,'rept')" style=";height: 140px;border: 1px solid #dadada;padding: 5px">
                            <div>
                                <div style="float: left;font-weight: 700;color: #232e6a">$((langReptNo))：$((msg.ActReptNo))</div>
                            </div>
                            <div>
                                <div style="float: left;width: 55%;">$((langUserNm))：$((msg.EmpNm))</div>
                                <div style="float: right">$((langGroupNm))：$((msg.DeptNm))</div>
                            </div>
                            <div>
                                <div style="float: left;">$((langPlanNo))：$((msg.ActPlanNo))</div>
                            </div>
                            <div>
                                <div class="long" style="float: left;width: 55%;">$((langMeetingSubject))：$((msg.MeetingSubject))</div>
                                <div class="long" style="text-align: right;float: right;width: 45%">$((langMeetingPlace))：$((msg.MeetingPlace))</div>
                            </div>
                            <div>
                                <div class="long" style="float: left;width: 100%;overflow: hidden;text-overflow:ellipsis;white-space: nowrap;">$((langCustNm))：$((msg.CustNm))</div>
                            </div>
                            <div>
                                <div style="float: left;">$((langCustPron))：$((msg.CustUserNm))</div>
                                <div style="float: right;color: #b3b3b3">$((msg.ActReptDate))</div>
                            </div>
                        </div>
                    <!--<div class="layui-flow-more" >-->
                        <!--<i class="layui-anim layui-anim-rotate layui-anim-loop layui-icon layui-icon-loading-1" style="font-size: 25px">-->
                        <!--</i>-->
                        <!--<div class="doc-icon-name">loading</div>-->
                    <!--</div>-->
                    <!--<div class="layui-flow-more" j-word-label="W2018062810475725084" >没有更多了</div>-->
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



</div>
<script src="/js/WEI_2200/WEI_2200_Lists.js?v=7523"></script>

</body>
</html>
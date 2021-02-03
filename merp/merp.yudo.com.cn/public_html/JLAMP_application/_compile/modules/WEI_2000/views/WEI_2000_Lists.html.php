<?php /* Template_ 2.2.6 2019/03/08 10:25:53 /home/merp.yudo.com.cn/public_html/JLAMP_application/modules/WEI_2000/views/WEI_2000_Lists.html 000032696 */ ?>
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
    <link rel="stylesheet" href="/css/yudo-ui.css?v=1055">
    <link rel="stylesheet" href="/css/common.css">
    <link href="/third_party/bootstrap-3.3.5/css/bootstrap.css" rel="stylesheet">
    <!--<link href="/third_party/bootstrap-3.3.5/css/bootstrap-theme.css" rel="stylesheet">-->
    <link rel="stylesheet" href="/css/WEI_2000/WEI_2000_Lists.css?v=201807080922">
    <link rel="stylesheet" href="/css/WEI_2000/mui.min.css?v=1001">
    <link rel="stylesheet" href="/css/mui.picker.min.css">
    <link href="/third_party/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <link href="/css/bootstrap_modify.css" rel="stylesheet">
    <!--<link href="/third_party/KendoUI/styles/kendo.common.min.css" rel="stylesheet">-->
    <!--<link href="/third_party/KendoUI/styles/kendo.bootstrap.min.css" rel="stylesheet">-->
    <!--<link href="/third_party/KendoUI/styles/kendo.bootstrap.mobile.min.css" rel="stylesheet">-->
    <!--<link rel="stylesheet" href="/js/WEI_2100/css/layui.css">-->
    <!--jquery vue-->
    <script type="text/javascript" src="/third_party/jquery-2.1.4/jquery.js"></script>
    <script>var jq = $.noConflict();</script>
    <script src="/js/vue.js"></script>
    <!--mui echarts multi fastclick-->
    <script src="/js/mui.min.js?v=1001"></script>
    <script src="/js/WEI_2100/layui.all.js"></script>
    <script src="/js/multiHttp.js?v=1001"></script>
    <!--<script src="/js/multiSelect.js?v=2009"></script>-->
    <script src="/js/lang.js?v=1001"></script>
    <script src="/js/echarts.min.js"></script>
    <!--<script src="/js/lang.min.js?v=1001"></script>-->
    <script src="/js/mui.previewimage.js?v=201804261256"></script>
    <script src="/js/mui.zoom.js?v=201804231454"></script>
    <script src="/js/mui.picker.min.js?v=1001"></script>
    <script type="text/javascript" src="/js/fastclick.js"></script>
    <!--jlamp-->
    <!--<script src="/third_party/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>-->
    <script src="/third_party/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <!--<script type="text/javascript" src="/third_party/KendoUI/js/kendo.all.min.js"></script>-->
    <script type="text/javascript" src="/js/JLAMP.polyfill.min.js"></script>
    <script type="text/javascript" src="/js/JLAMP.min.js"></script>
    <script type="text/javascript" src="/js/JLAMP.common.min.js"></script>
    <!--<script type="text/javascript" src="/js/JLAMP.menu.min.js"></script>-->
    <script type="text/javascript" src="/js/JLAMP.autobinding.min.js"></script>
    <script type="text/javascript" src="/js/JLAMP.modal.min.js"></script>
    <script type="text/javascript" src="/js/JLAMP.lang.min.js"></script>
    <script type="text/javascript" src="/js/session.js"></script>
    <script type="text/javascript" src="/js/version.js?v=20180920001"></script>
    <script type="text/javascript" src="/js/common.js"></script>
    <script type="text/javascript" src="/js/GNB.js"></script>
    <script src="/js/WEI_2000/WEI_2000_Lists.js?v=201807370937"></script>
</head>
<body>
<div class="download-script" id="downLoadScript"></div>
<div class="yudo-menu" id="menu">
    <div class="header-ios" style="z-index: 3">
        <div class="header-body">
            <div class="header-left-btn" id="backmenu">
                <div class="left-icon icon-backmenu"></div>
                <div class="left-text">主菜单</div>
            </div>
            <div class="header-center-btn" j-word-label="W2018041913411029304">组装试模</div>
            <div class="header-right-btn">
                <div class="right-icon icon-extend"></div>
            </div>
        </div>
    </div>
    <div class="center-ios">
        <div class="menus">
            <button onclick="newMtProject()"  type="button" class="menu-btn" style="padding-top: 2px">
                <span style="position: relative"><div class="icon-write btn-icon"></div><span id="AS_add"></span></span>
            </button>
            <button onclick="newMtQuery()"  type="button" class="menu-btn" style="padding-top: 2px">
                <span style="position: relative"><div class="icon-search btn-icon"></div><span id="AS_query"></span></span>
            </button>
        </div>
    </div>
</div>
<div id="slide_panel_top" class="header-ios" style="z-index: 2">
    <div class="header-body">
        <div class="header-left-btn" onclick="rmMtProject()">
            <div class="left-icon icon-back-2"></div>
        </div>
        <div class="header-center-btn" j-word-label="W2018041913411029304">组装试模</div>
        <div class="header-right-btn">
            <div class="right-icon icon-extend"></div>
        </div>
    </div>
</div>
<!--<div id="slide_panel_top" style="position: absolute;top: 50px; z-index: 1" onclick="rmMtProject()" class="find-window-top leon">-->
    <!--<span class="mui-icon mui-icon-back"></span>-->
<!--</div>-->
<div id="slide_panel" class="leon" style="height: 100% !important;overflow-y:auto;">
    <div class="center-ios" style="background: white">
        <div class="search_area">
            <div class="sub_title" j-word-label="W2018041913130033733">订单信息
            </div>
            <table class="search_table">
                <colgroup>
                    <col width="100px;">
                </colgroup>
                <tr>
                    <th colspan="1" j-word-label="W2018041913141737708">订单号码</th>
                    <td colspan="1" style="padding-left:20px">
                        <input readonly="readonly" type="text" id="order_id" class="multi-input text-left xwrite" style="padding-right: 1px !important;">
                    </td>
                    <td>
                        <a herf="javascript:void(0)" onclick="QRcode();"><img src="/image/qrcode.png" width="29"></a>
                    </td>
                    <td>
                        <button id="order_list" class="button-2000" style="width: 70px" j-word-label="W2018041913332473096">订单列表</button>
                    </td>
                </tr>
                <tr>
                    <th j-word-label="W2018041913134073778">客户名称</th>
                    <td colspan="3" style="padding-left:20px">
                        <input readonly="readonly" type="text" id="cos_name" class="multi-input text-left xwrite" >
                    </td>
                </tr>

                <tr>
                    <th j-word-label="W2018041913163666042">订单日期</th>
                    <td colspan="3" style="padding-left:20px">
                        <input readonly="readonly" type="text" id="order_date" class="multi-input text-left xwrite" data-date-format="yyyy-mm-dd">
                    </td>
                </tr>
                <tr>
                    <th j-word-label="W2018041913172613778">交货期</th>
                    <td colspan="3" style="padding-left:20px">
                        <input readonly="readonly" type="text" id="target_date" class="multi-input text-left xwrite" data-date-format="yyyy-mm-dd">
                    </td>
                </tr>
                <tr>
                    <th style="word-break: keep-all" j-word-label="W2018">System Type</th>
                    <td colspan="3" style="padding-left:20px">
                        <input readonly="readonly" type="text" id="System_Type" class="multi-input text-left xwrite" >
                    </td>
                </tr>
                <tr>
                    <th j-word-label="W2018050318130693796">Gate数量</th>
                    <td colspan="3" style="padding-left:20px">
                        <input readonly="readonly" type="text" id="Gate_counts" class="multi-input text-left xwrite" >
                    </td>
                </tr>
                <tr>
                    <th j-word-label="W2009100611474841375">确定</th>
                    <td colspan="3" style="padding-left:20px">
                        <div class="mui-switch" id="mySwitch">
                            <div class="mui-switch-handle"></div>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="sub_title" j-word-label="W2018041913191891089">组装信息</div>
            <table class="search_table">
                <colgroup>
                    <col width="100px;">
                </colgroup>
                <tr>
                    <th style="color: #ff696d;" j-word-label="W2018041913194489381">组装人员</th>
                    <td colspan="1" rowspan="1" style="padding-left:20px">
                        <input type="text" readonly="readonly" id="mt_user" class="multi-input text-left xwrite" >
                    </td>
                    <td>
                        <button id="user_list1" class="button-2000" j-word-label="W2018041913334637071">员工搜索</button>
                    </td>

                </tr>
                <tr>
                    <th style="color: #ff696d;" j-word-label="W2018041913201356776">组装部门名称</th>
                    <td colspan="3" rowspan="1" style="padding-left:20px">
                        <input type="text" readonly="readonly" id="mt_group" class="multi-input text-left xwrite">
                    </td>
                </tr>

                <tr>
                    <th j-word-label="W2018041913204897008">组装报告号码</th>
                    <td colspan="3" rowspan="1" style="padding-left:20px">
                        <input type="text" readonly="readonly" id="mt_id" class="multi-input text-left xwrite" >
                    </td>
                </tr>
                <tr>
                    <th j-word-label="W2018041913212982391">组装报告日</th>
                    <td colspan="3" rowspan="1" style="padding-left:20px">
                        <input type="text"  id="mt_talk_date" class="multi-input text-left" data-date-format="yyyy-mm-dd">
                    </td>
                </tr>
                <tr>
                    <th j-word-label="W2018041913215236707">组装日</th>
                    <td colspan="3" rowspan="1" style="padding-left:20px">
                        <input type="text"  id="mt_date" class="multi-input text-left" data-date-format="yyyy-mm-dd">
                    </td>
                </tr>

                <tr rowspan="2">
                    <th j-word-label="W2018041913222052708">组装报告事项</th>
                    <td colspan="3" style="padding-left:20px">
                        <textarea type="text" style="border-radius: 5px !important;height: 58px;width: 100%"  id="mt_something" class="text-left" ></textarea>
                    </td>
                </tr>
                <tr rowspan="2">
                    <th j-word-label="W2018041913225420017">备注</th>
                    <td colspan="3" style="padding-left:20px">
                        <textarea type="text"  style="border-radius: 5px !important;height: 58px;width: 100%"  id="order_other" class="text-left" ></textarea>
                    </td>
                </tr>
            </table>
            <div class="sub_title" j-word-label="W2018041913270419743">组装报告信息</div>
            <table class="search_table">
                <colgroup>
                    <col width="100px;">
                </colgroup>
                <tr>
                    <th j-word-label="W2018041913272754002">试模人员</th>
                    <td colspan="1" style="padding-left:20px">
                        <input type="text" readonly="readonly" id="test_user"  class="multi-input text-left xwrite" >
                    </td>
                    <td>
                        <button id="user_list" class="button-2000" j-word-label="W2018041913334637071">员工搜索</button>
                    </td>
                </tr>
                <tr>
                    <th j-word-label="W2018041913274956066">试模部门</th>
                    <td colspan="3" style="padding-left:20px">
                        <input type="text" readonly="readonly" id="test_group" class="multi-input text-left xwrite" >
                    </td>
                </tr>
                <tr>
                    <th j-word-label="W2018041913280506717">试模日期</th>
                    <td colspan="3" style="padding-left:20px">
                        <input type="text" id="test_date" class="multi-input text-left" data-date-format="yyyy-mm-dd">
                    </td>
                </tr>
                <tr>
                    <th j-word-label="W2018050411240256703">试模报告事项</th>
                    <td colspan="3" style="padding-left:20px">
                        <textarea type="text" style="border-radius: 5px !important;height: 58px;width: 100%"  id="test_something" class="text-left" ></textarea>
                    </td>
                </tr>
            </table>
        </div>

        <div class="sub_title" j-word-label="W2018041913394065792">销售信息</div><button onclick="saleslist('open');" id="opensales" style="line-height: 15px;margin-top:-33px;margin-right: 5px;float: right;font-size: 25px;width:30px"  class="button-2000">+</button>
        <div class="table-responsive" style="overflow: auto; height: 200px;">
            <table class="basic_table">
                <tr>
                    <th width="20" >NO</th>
                    <th style="text-align:center" j-word-label="W2018041913292308342">销售负责人</th>
                    <th style="text-align:center" j-word-label="W2018041913371894064">部门名称</th>
                    <th width="65" style="text-align:center" j-word-label="W2018041913295609366">设置</th>
                </tr>
                <tbody id="sell_table">
                </tbody>
            </table>
        </div>
        <div class="sub_title" j-word-label="W2018041913400053087">组装报告照片</div><button id="up_mt_photo" style="line-height: 15px;margin-top:-33px;margin-right: 5px;float: right;font-size: 25px;width:30px"  class="button-2000">+</button>
            <div class="table-responsive" style="overflow: auto; height:200px;">
                <table class="basic_table">
                    <tr>
                        <th width="20">NO</th>
                        <th style="text-align:center" j-word-label="W2015012012571418044">照片</th>
                        <th style="text-align:center" j-word-label="W2015012211300593761">文件名</th>
                        <th width="65" style="text-align:center" j-word-label="W2018041913295609366">设置</th>
                    </tr>
                    <tbody id="mt_photo">
                    </tbody>
                </table>
            </div>
        <div class="sub_title" j-word-label="W2018041913403432396">试模报告照片</div><button id="up_test_photo" style="line-height: 15px;margin-top:-33px;margin-right: 5px;float: right;font-size: 25px;width:30px"  class="button-2000">+</button>
        <div class="table-responsive" style="overflow: auto; height:200px;margin-bottom: 0px">
            <table class="basic_table">
                <tr>
                    <th width="20">NO</th>
                    <th style="text-align:center" j-word-label="W2015012012571418044">照片</th>
                    <th style="text-align:center" j-word-label="W2015012211300593761">文件名</th>
                    <th width="65" style="text-align:center" j-word-label="W2018041913295609366">设置</th>
                </tr>
                <tbody id="test_photo">
                </tbody>
            </table>
        </div>

    </div>
</div>
<div id="slide_panel_bottom" style="position: absolute;bottom: 0px; z-index: 1" class="leon find-window-bottom">
    <div class="saves"  style="margin-top: 0;width: 100%;text-align: center">
        <input  id="btn_uploads"  type="button" value="保存" class="save-btn" style=";padding-top: 2px;margin-bottom: 0;height: 38px"/>
    </div>
</div>
<div id="find-window" style="z-index: 2;display: none" class="yudo-window">
    <div class="header-ios" style="z-index: 3">
        <div class="header-body">
            <div class="header-left-btn" id="find-window-top">
                <div class="left-icon icon-back-2"></div>
            </div>
            <div class="header-center-btn" j-word-label="W2018041913332473096">订单列表</div>
            <div class="header-right-btn">
                <div class="right-icon icon-extend"></div>
            </div>
        </div>
    </div>
    <div class="center-ios">
        <div class="search_area" style="position: absolute;top: 50px">
            <table class="search_table" style="height: 81px;padding-top: 10px">
                <colgroup>
                    <col width="100px;">
                </colgroup>
                <tr>
                    <th j-word-label="W2018041913141737708">订单号码</th>
                    <td colspan="1">
                        <input type="text" id="this_order_date" class="multi-find-windows search_input">
                    </td>
                    <td>
                        <button class="button-2000" id="find-order" j-word-label="W2018020109095825029" style="font-size:15px">查询</button>
                    </td>
                </tr>
                <tr>
                    <th j-word-label="W2018041913134073778">客户名称</th>
                    <td colspan="3">
                        <input type="text" id="gubun" class="multi-find-windows search_input">
                    </td>
                </tr>
            </table>
        </div>
        <div class="search_area" style="height:100%;padding-top: 113px">
            <div class="multi-list-2" id="ordertrans">
            <table class="basic_table">
                <tr>
                    <th style="text-align:center"><div class="basic_table_div" style="width: 30px">NO</div></th>
                    <th style="text-align:center" ><div j-word-label="W2018041913163666042" class="basic_table_div" style="width: 100px">订单日期</div></th>
                    <th style="text-align:center" ><div j-word-label="W2018041913141737708" class="basic_table_div" style="width: 100px">订单号码</div></th>
                    <th style="text-align:center" ><div j-word-label="W2018041913134073778" class="basic_table_div" style="width: 250px">客户名称</div></th>
                    <th style="text-align:center" ><div j-word-label="W2018041913371894064" class="basic_table_div" style="width: 100px">部门名称</div></th>
                    <th style="text-align:center" ><div j-word-label="W2018041913373764065" class="basic_table_div" style="width: 100px">职员姓名</div></th>
                    <th style="text-align:center" ><div j-word-label="W2018041913172613778" class="basic_table_div" style="width: 100px">交货期</div></th>
                </tr>
            </table>
            </div>
            <div class="search_area" style="float: left;overflow-y: auto;height:100%;position: relative">
                <div class="search_area" id="order-list" style="overflow-x:auto;" >
                    <table style="height: 30px;white-space: nowrap;text-align: center;" class="basic_table">
                        <tbody id="find-order-list" >

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="find-mt" style="z-index: 2;display: none" class="yudo-window">
    <div class="header-ios" style="z-index: 3">
        <div class="header-body">
            <div class="header-left-btn" id="find-mt-top" onclick="rmMtQuery()">
                <div class="left-icon icon-back-2"></div>
            </div>
            <div class="header-center-btn" j-word-label="W2018041913411029304">组装试模</div>
            <div class="header-right-btn">
                <div class="right-icon icon-extend"></div>
            </div>
        </div>
    </div>
    <div class="center-ios">
        <div class="search_area" style="position: absolute;top: 50px">
            <table class="search_table" style="height: 81px;padding-top: 10px">
                <colgroup>
                    <col width="100px;">
                </colgroup>
                <tr>
                    <th j-word-label="W2018041913141737708">订单号码</th>
                    <td colspan="1">
                        <input type="text" id="mtfind_order_date" class="multi-find-windows search_input">
                    </td>
                    <td>
                        <a herf="javascript:void(0)" onclick="QRcode();"><img src="/image/qrcode.png" width="29"></a>
                    </td>
                    <td>
                        <button class="button-2000" id="mtfind-order" onclick="query_mt()" j-word-label="W2018020109095825029" style="font-size:15px">查询</button>
                    </td>
                </tr>
                <tr>
                    <th j-word-label="W2018041913134073778">客户名称</th>
                    <td colspan="3">
                        <input type="text" id="mtgubun" class="multi-find-windows search_input">
                    </td>
                </tr>
            </table>
        </div>
        <div class="search_area" style="height:100%;padding-top: 113px">
            <div class="multi-list-2" id="mttrans">
            <table style="" class="basic_table">
                <tr>
                    <th style="text-align:center;"><div class="basic_table_div" style="width: 30px">NO</div></th>
                    <th style="text-align:center"><div j-word-label="W2018041913204897008" class="basic_table_div" style="width: 100px">组装报告号码</div></th>
                    <th style="text-align:center"><div j-word-label="W2018041913212982391" class="basic_table_div" style="width: 100px">组装报告日</div></th>
                    <th style="text-align:center"><div j-word-label="W2018041913215236707" class="basic_table_div" style="width: 100px">组装日</div></th>
                    <th style="text-align:center"><div j-word-label="W2018041913194489381" class="basic_table_div" style="width: 100px">组装人员</div></th>
                    <th style="text-align:center"><div j-word-label="W2018041913201356776" class="basic_table_div" style="width: 100px">组装部门名称</div></th>
                    <th style="text-align:center"><div j-word-label="W2018041913134073778" class="basic_table_div" style="width: 250px">客户名称</div></th>
                    <th style="text-align:center"><div j-word-label="W2018041913141737708" class="basic_table_div" style="width: 100px">订单号码</div></th>
                </tr>
            </table>
            </div>
            <div class="search_area" style="float: left;overflow-y: auto;height:100%;">
                <div class="search_area" id="mtorder-list" style="overflow-x:auto;position: relative" >
                    <div style="">
                    <table style="white-space: nowrap;text-align: center;" class="basic_table">
                        <tbody id="mtfind-order-list">

                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="find-window-user" style="z-index: 2;;display: none" class="yudo-window">
    <div class="header-ios" style="z-index: 3">
        <div class="header-body">
            <div class="header-left-btn" id="find-window-user-top">
                <div class="left-icon icon-back-2"></div>
            </div>
            <div class="header-center-btn" j-word-label="W2018082713370902732">职员查询</div>
            <div class="header-right-btn">
                <div class="right-icon icon-extend"></div>
            </div>
        </div>
    </div>
    <div class="center-ios">
        <div class="search_area" style="position: absolute;top: 50px">
            <table class="search_table">
                <colgroup>
                    <col width="100px;">
                </colgroup>
                <tr>
                    <th j-word-label="W2018041913373764065">职员姓名</th>
                    <td colspan="1">
                        <input type="text" id="this_user"  class="multi-find-windows search_input " data-date-format="yyyy-mm-dd">
                    </td>
                    <td>
                        <button class="button-2000" id="find-users" style="font-size: 15px" j-word-label="W2018020109095825029">查询</button>
                    </td>

                </tr>
                <tr>
                    <th j-word-label="W2018041913385580778">职员工号</th>
                    <td colspan="3">
                        <input type="text" id="this_user_id"  class="multi-find-windows search_input" data-date-format="yyyy-mm-dd">
                    </td>
                </tr>
                <tr>
                    <th j-word-label="W2018041913371894064">部门名称</th>
                    <td colspan="3">
                        <input type="text" id="this_group"  class="multi-find-windows search_input" data-date-format="yyyy-mm-dd">
                    </td>
                </tr>
            </table>
        </div>
        <div class="search_area" style="height:100%;padding-top: 139px">
            <div id="userstrans" class="multi-list-3">
            <table  class="basic_table">
                <tr >
                    <th ><div class="basic_table_div" style="width: 30px">NO</div></th>
                    <th style="text-align:center" ><div  j-word-label="W2018041913371894064" class="basic_table_div" style="width: 100px">部门名称</div></th>
                    <th style="text-align:center" ><div j-word-label="W2018041913373764065" class="basic_table_div" style="width: 100px">职员姓名</div></th>
                    <th style="text-align:center" ><div j-word-label="W2018041913385580778" class="basic_table_div" style="width: 100px">职员工号</div></th>
                </tr>
            </table>
            </div>
            <div class="search_area" style="float: left;overflow-y: auto;height:100%;position: relative">
                <div class="search_area" id="user-list" style="overflow-x:auto;">
                    <table style="height: 30px;white-space: nowrap;text-align: center;" class="basic_table">
                        <tbody id="find-user-list">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="find-sales-user" style="z-index: 2;;display: none" class="yudo-window">
    <div class="header-ios" style="z-index: 3">
        <div class="header-body">
            <div class="header-left-btn" id="find-sales-user-top">
                <div class="left-icon icon-back-2"></div>
            </div>
            <div class="header-center-btn" j-word-label="W2018041913292308342">销售负责人</div>
            <div class="header-right-btn">
                <div class="right-icon icon-extend"></div>
            </div>
        </div>
    </div>
    <div class="center-ios">
        <div class="search_area" style="position: absolute;top: 50px">
            <table class="search_table">
                <colgroup>
                    <col width="100px;">
                </colgroup>
                <tr>
                    <th j-word-label="W2018041913373764065">职员姓名</th>
                    <td colspan="1">
                        <input type="text" id="sales_user"  class="multi-find-windows search_input " data-date-format="yyyy-mm-dd">
                    </td>
                    <td>
                        <button onclick="query_sales_user()" class="button-2000" style="font-size: 15px" j-word-label="W2018020109095825029">查询</button>
                    </td>
                    <td>
                        <button onclick="upload_sales()" class="button-2000" id="sales-users" style="font-size: 15px" j-word-label="W2018050411092732363">导入</button>
                    </td>

                </tr>
                <tr>
                    <th j-word-label="W2018041913385580778">职员工号</th>
                    <td colspan="3">
                        <input type="text" id="sales_user_id"  class="multi-find-windows search_input" data-date-format="yyyy-mm-dd">
                    </td>
                </tr>
                <tr>
                    <th j-word-label="W2018041913371894064">部门名称</th>
                    <td colspan="3">
                        <input type="text" id="sales_group"  class="multi-find-windows search_input" data-date-format="yyyy-mm-dd">
                    </td>
                </tr>
            </table>
            </div>

        <div class="search_area" style="height:100%;padding-top: 139px">
            <div class="multi-list-3" id="salestrans">
            <table class="basic_table">
                <tr>
                    <th ><div class="basic_table_div" style="width: 50px">NO</div></th>
                    <th style="text-align:center" ><div j-word-label="W2018041913371894064" class="basic_table_div" style="width: 100px">部门名称</div></th>
                    <th style="text-align:center" ><div j-word-label="W2018041913373764065" class="basic_table_div" style="width: 100px">职员姓名</div></th>
                    <th style="text-align:center" ><div j-word-label="W2018041913385580778" class="basic_table_div" style="width: 100px">职员工号</div></th>
                </tr>
            </table>
            </div>
            <div class="search_area" style="float: left;overflow-y: auto;height:100%;position: relative">
                <div class="search_area" id="sales-list" style="overflow-x:auto;">
                    <table style="height: 30px;white-space: nowrap;text-align: center;" class="basic_table">
                        <tbody id="find-sales-list">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="police" style="z-index: 10;position: absolute;background: transparent;width: 100%;height: 100%;display: none"></div>

<div id="sheet_mt" class="mui-popover mui-popover-bottom mui-popover-action ">
    <!-- 可选择菜单 -->
    <ul class="mui-table-view" style="background: #f5f5f5 !important;">
        <li class="mui-table-view-cell">
            <a href="javascript:void(0)" onclick="takCamera('mt');" j-word-label="W2018050318052869026">拍摄照片</a>
        </li>
        <li class="mui-table-view-cell">
            <a href="javascript:void(0)" onclick="checkfile('mt');" j-word-label="W2018050318054041351">选择照片</a>
        </li>
    </ul>
    <!-- 取消菜单 -->
    <ul class="mui-table-view" style="background: #f5f5f5 !important;">
        <li class="mui-table-view-cell">
            <a href="#sheet_mt"><b>取消</b></a>
        </li>
    </ul>
</div>
<div id="sheet_test" class="mui-popover mui-popover-bottom mui-popover-action ">
    <!-- 可选择菜单 -->
    <ul class="mui-table-view" style="background: #f5f5f5 !important;">
        <li class="mui-table-view-cell">
            <a href="javascript:void(0)" onclick="takCamera('test');" j-word-label="W2018050318052869026">拍摄照片</a>
        </li>
        <li class="mui-table-view-cell">
            <a href="javascript:void(0)" onclick="checkfile('test');" j-word-label="W2018050318054041351">选择照片</a>
        </li>
    </ul>
    <!-- 取消菜单 -->
    <ul class="mui-table-view" style="background: #f5f5f5 !important;">
        <li class="mui-table-view-cell">
            <a href="#sheet_test"><b>取消</b></a>
        </li>
    </ul>
</div>
<form action="" method="post" enctype="multipart/form-data">
    <input style="display: none"  type="file" id="mt_upimg" name="file" multiple="multiple" onchange="uploadPic_mt();"  >
    <input style="display: none"  type="file" id="test_upimg" name="file" multiple="multiple" onchange="uploadPic_test();"  >
</form>

<script>
    mui.previewImage();
</script>
</body>
</html>
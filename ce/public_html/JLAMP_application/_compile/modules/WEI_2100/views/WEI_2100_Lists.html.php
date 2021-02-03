<?php /* Template_ 2.2.6 2019/03/13 14:29:50 /home/merp.yudo.com.cn/public_html/JLAMP_application/modules/WEI_2100/views/WEI_2100_Lists.html 000087997 */ ?>
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
    <link rel="stylesheet" href="/css/common.css?v=1001">
    <link rel="stylesheet" href="/css/WEI_2200/WEI_2200_Lists.css?v=201806080940">
    <link rel="stylesheet" href="/css/mui.min.css?v=1010">
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
    <!--<script src="/js/echarts.min.js"></script>-->
    <!--<script src="/js/lang.min.js?v=1001"></script>-->
    <script src="/js/mui.previewimage.js?v=201804261256"></script>
    <script src="/js/mui.zoom.js?v=201804231454"></script>
    <!--<script src="/js/mui.picker.min.js?v=1001"></script>-->
    <script type="text/javascript" src="/js/fastclick.js"></script>
    <!--jlamp-->
    <!--<script type="text/javascript" src="/js/JLAMP.polyfill.min.js"></script>-->
    <script type="text/javascript" src="/js/JLAMP.min.js"></script>
    <script type="text/javascript" src="/js/JLAMP.common.min.js"></script>
    <!--<script type="text/javascript" src="/js/JLAMP.menu.min.js"></script>-->
    <!--<script type="text/javascript" src="/js/JLAMP.autobinding.min.js"></script>-->
    <!--<script type="text/javascript" src="/js/JLAMP.modal.min.js"></script>-->
    <script type="text/javascript" src="/js/JLAMP.lang.min.js"></script>
    <!--<script type="text/javascript" src="/js/session.js"></script>-->
    <!--<script type="text/javascript" src="/js/version.js?v=20180920001"></script>-->
    <!--<script type="text/javascript" src="/js/common.js"></script>-->
    <!--<script type="text/javascript" src="/js/GNB.js"></script>-->
</head>
<body>
<style>
    .layui-table-view{
        height: 100% !important;
    }
    a,input,button{
        touch-action: manipulation;
        -ms-touch-action: manipulation
    }
</style>
<!-- nav -->
<div style="width: 100%;height: 100%;background: #ffffff;top:0;position: absolute;z-index:50" id="allload"></div>
<div id="slide_panel_top" class="header-ios">
    <div class="header-body">
        <div class="header-left-btn" id="backMenu" onclick="leon.slide_panel_close()">
            <div class="left-icon icon-back-2"></div>
            <div class="left-text"></div>
        </div>
        <div class="header-center-btn" j-word-label="W2019030809162934375">AS接受</div>
        <div class="header-right-btn">
            <div class="right-icon icon-extend"></div>
        </div>
    </div>
</div>
<div id="slide_panel_bottom" style="position: absolute; bottom: 0px; z-index: 2; display: block;" class="leon find-window-bottom">
    <table width="100%">
        <colgroup>
            <col width="50%"/>
            <col width="50%"/>
        </colgroup>
        <tr>

            <td class="saves">
                <input onclick="leon.save_as()" id="btn_uploads" type="button" value="保存" class="save-btn" style=";padding-top: 2px;margin-bottom: 0;height: 38px">
                </input>
            </td>
        </tr>
    </table>
</div>

<div id="leon" style="overflow-y:auto;height: 100%;position: relative">
    <div class="download-script" v-if="downLoadScript"></div>
    <div class="yudo-menu" v-show="as_menu_show">
        <div class="header-ios" style="z-index: 3">
            <div class="header-body">
                <div class="header-left-btn" onclick="return_menu()">
                    <div class="left-icon icon-backmenu"></div>
                    <div class="left-text">$((langCode.menuBack))</div>
                </div>
                <div class="header-center-btn" j-word-label="W2019030809162934375">AS接受</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="center-ios">
            <div class="menus">
                <button v-on:click="slide_panel_open()" type="button" class="menu-btn" style="padding-top: 2px">
                    <span style="position: relative"><div class="icon-write btn-icon"></div><span j-word-label="W2018062810264620307">新增AS接收信息</span></span>
                </button>
                <button v-on:click="as_query_open()" type="button" class="menu-btn" style="padding-top: 2px">
                    <span style="position: relative"><div class="icon-search btn-icon"></div><span j-word-label="W2018062810271817755">查询AS接收信息</span></span>
                </button>
            </div>
        </div>
        <div class="yudo-footer">
            YUDO ERP APP
        </div>
    </div>
    <div v-show="find_asphoto_show" style="z-index: 3;" class="yudo-window">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" @click="asphoto_query_close()">
                    <div class="left-icon icon-back-2"></div>
                </div>
                <div class="header-center-btn" j-word-label="W2018050318052869026">照片列表</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="center-ios">
            <ul class="mui-table-view" style="text-align: left">
                <li class="mui-table-view-cell mui-transitioning" v-for="(photo,index) in asphotolist">
                    <div class="mui-slider-right mui-disabled">
                        <a class="mui-btn mui-btn-red" style="transform: translate(0px, 0px);" v-on:click="del_photo(index,$event)" >删除</a>
                    </div>
                    <div class="mui-slider-handle" style="transform: translate(0px, 0px);">
                        <div style="margin: 0!important;" class="mui-content-padded">
                            <img style="height: 42px;width: 42px" class="mui-media-object mui-pull-left" :src="photo.imagedir" data-preview-src="" data-preview-group="1" >
                        </div>
                        <span style="line-height: 42px">$((photo.FileNm))</span>
                    </div>
                </li>
            </ul>
            <div style="background-color: white;border-top: 1px solid #b3b3b3;position: fixed;width: 100%;bottom: 0px;left: 0;padding: 0 20%;height:50px;margin-left:auto;margin-right: auto">
                <input v-on:click="save_photo()" style="width: 100%;height: 38px;border-radius: 19px" class="bn_normal_100" id="photo-up"  type="button" value="上传">
            </div>
        </div>
        <input style="display: none"  type="file" id="asphot_upload" name="file" multiple="multiple" @change="uploadPic" >
    </div>
    <div v-show="find_assales_show" id="find-sales-list" style="z-index: 3;" class="yudo-window">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" @click="assales_query_close()">
                    <div class="left-icon icon-back-2"></div>
                </div>
                <div class="header-center-btn" j-word-label="W2018041913292308342">销售负责人信息</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="center-ios">
            <ul class="mui-table-view" style="text-align: left;">
                <li class="mui-table-view-cell mui-transitioning" v-for="(sale,index) in assaleslist">
                    <div class="mui-slider-right mui-disabled">
                        <a class="mui-btn mui-btn-red" style="transform: translate(0px, 0px);" v-on:click="del_sales(index,$event)" >删除</a>
                    </div>
                    <div class="mui-slider-handle" style="transform: translate(0px, 0px);">
                        <span class="layui-badge layui-bg-blue">$((index+1))</span>
                        <span>$((sale.EmpNm))</span>
                        <span>$((sale.DeptNm))</span>
                    </div>
                </li>
            </ul>
            <div style="background-color: white;border-top: 1px solid #b3b3b3;position: fixed;width: 100%;bottom: 0px;left: 0;padding: 0 20%;height:50px;margin-left:auto;margin-right: auto">
                <input v-on:click="assaleslist_query_open()" style="width: 100%;height: 38px;border-radius: 19px" class="bn_normal_100" id="sales-add"   type="button" value="添加">
            </div>
        </div>
    </div>
    <div v-show="find_astable_show" style="z-index: 3;" class="yudo-window">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" @click="astableid_query_close()">
                    <div class="left-icon icon-back-2"></div>
                </div>
                <div class="header-center-btn" j-word-label="W2018041913292308"></div>
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
                        <th j-word-label="W2018062810504422036">品目编码</th>
                        <td colspan="1">
                            <input type="text" v-model="input_asitemid" class="multi-find-windows search_input">
                        </td>
                        <td>
                            <button class="button-2000" v-on:click="query_as_item()" j-word-label="W2018020109095825029" style="font-size:15px">查询</button>
                        </td>
                    </tr>
                    <tr>
                        <th j-word-label="W2018062810511435013">品目名称</th>
                        <td colspan="3">
                            <input type="text" v-model="input_asitemnm" class="multi-find-windows search_input">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="search_area" style="height:100%;padding-top: 113px">
                <div class="multi-list-2" id="astable_tr">
                <table class="basic_table">
                    <tr>
                        <th style="text-align:center"><div class="basic_table_div" style="width: 30px">NO</div></th>
                        <th style="text-align:center"><div j-word-label="W2018071013443085307" class="basic_table_div" style="width: 80px">产品型号</div></th>
                        <th style="text-align:center"><div j-word-label="W2018062810504422036" class="basic_table_div" style="width: 130px">品目编码</div></th>
                        <th style="text-align:center"><div j-word-label="W2018062810511435013" class="basic_table_div" style="width: 400px">品目名称</div></th>
                        <th style="text-align:center"><div j-word-label="W2018062810520860062" class="basic_table_div" style="width: 150px">规格</div></th>
                        <th style="text-align:center"><div j-word-label="W2018062810523215799" class="basic_table_div" style="width: 50px">库存单位</div></th>
                        <th style="text-align:center"><div j-word-label="W2017071715555825006" class="basic_table_div" style="width: 40px">状态</div></th>
                    </tr>
                </table>
                </div>
                <div id="mui_pushitem"  class="search_area" style="float: left;overflow-y: auto;height:100%;position: relative">
                    <div class="search_area" id="astable-list" style="overflow-x:auto;">
                        <table style="height: 30px;white-space: nowrap;text-align: center;" class="basic_table">
                            <tbody>
                            <tr v-for="(a_item,index) in asitemlist" v-on:click="set_asitem(index);">
                                <td><div class="basic_table_div" style="width: 30px">$((index+1))</div></td>
                                <td><div class="basic_table_div" style="width: 80px">$((a_item.ItemCd))</div></td>
                                <td><div class="basic_table_div" style="width: 130px">$((a_item.ItemNo))</div></td>
                                <td><div class="basic_table_div" style="width: 400px">$((a_item.ItemNm))</div></td>
                                <td><div class="basic_table_div" style="width: 150px">$((a_item.Spec))</div></td>
                                <td><div class="basic_table_div" style="width: 50px">$((a_item.UnitNm))</div></td>
                                <td><div class="basic_table_div" style="width: 40px">$((a_item.Status))</div></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="layui-flow-more" v-show="asitem_isloadding">
                        <i class="layui-anim layui-anim-rotate layui-anim-loop layui-icon layui-icon-loading-1" style="font-size: 25px">
                        </i>
                        <div class="doc-icon-name">loading</div>
                    </div>
                    <div class="layui-flow-more" j-word-label="W2018062810475725084" v-show="asitem_nodata">没有更多了</div>
                </div>
            </div>
        </div>
    </div>
    <div id="slide_panel" v-show="slide_panel_show" style="height: 100%;padding-top: 50px">

            <div class="sub_contents" style="position: relative">
                <!-- 검색 -->
                <!--<div class="center-ios" id="centerControl" style="background: white;">-->
                <div class="search_area">
                    <div class="sub_title" j-word-label="W2018041913130033733">订单信息
                        <button class="layui-btn layui-btn-primary  layui-btn-sm xwrite" style="float: right;margin-top: -5px;margin-right: 5px" onclick="leon.unSubAdjudication()"  j-word-label="W2018071009254859784" >裁决上报取消</button>
                        <button class="layui-btn layui-btn-primary  layui-btn-sm " style="float: right;margin-right: 5px;margin-top: -5px" onclick="leon.subAdjudication()"  j-word-label="W2018071009251284093" >提交裁决</button>
                    </div>
                    <table class="search_table">
                        <colgroup>
                            <col width="100px;">
                        </colgroup>
                        <tr>
                            <th v-bind:class="must_orderclass"><div class="input-title" j-word-label="W2018062810274700393">订单区分</div></th>
                            <td colspan="4" style="padding-left:20px">
                                <div id="orderclass" class="multi-select">
                                    <input readonly="readonly" type="text" class="multi-input text-left" v-model="w_orderclass" />
                                    <i class="layui-icon layui-icon-triangle-d"></i>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th v-bind:class="must_order_id" ><div class="input-title" j-word-label="W2018041913141737708">订单号码</div></th>
                            <td colspan="2" style="padding-left:20px">
                                <input v-model="w_order_id" readonly="readonly" type="text" class="multi-input text-left xwrite" style="padding-right: 1px !important;">
                            </td>
                            <td colspan="1">
                                <span style="height: 28px;width: 28px;font-size: 15px;padding-top: 3px" class="layui-badge-rim xwrite">$((w_order_cnt))</span>
                            </td>
                            <td  colspan="1">
                                <button class="layui-btn layui-btn-primary layui-btn-sm" v-on:click="order_query_open()"  j-word-label="W2018041913332473096" >订单搜索</button>
                            </td>
                        </tr>
                        <tr>
                            <th><div class="input-title" j-word-label="W2018062810281624053">技术规范编号</div></th>
                            <td colspan="3" style="padding-left:20px">
                                <input v-model="w_spec_id" readonly="readonly" type="text" class="multi-input text-left xwrite" style="padding-right: 1px !important;">
                            </td>
                            <td  colspan="1">
                                <button class="layui-btn layui-btn-primary layui-btn-sm" v-on:click="spec_query_open()"  j-word-label="W2018062810283349016" >编号查询</button>
                            </td>
                        </tr>
                        <tr>

                            <th v-bind:class="must_export_distinction" ><div class="input-title" j-word-label="W2018062810285065731">出口区分</div></th>
                            <td colspan="4" style="padding-left:20px">
                                <div id="export_distinction" class="multi-select">
                                    <input readonly="readonly" type="text" class="multi-input text-left" v-model="w_export_distinction" />
                                    <i class="layui-icon layui-icon-triangle-d"></i>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th v-bind:class="must_cust_name" ><div class="input-title" j-word-label="W2018041913362840092">客户名称</div></th>
                            <td colspan="3" style="padding-left:20px">
                                <input v-model="w_cust_name" readonly="readonly" type="text" class="multi-input text-left xwrite" >
                            </td>
                            <td colspan="1">
                                <button class="layui-btn layui-btn-primary  layui-btn-sm" v-on:click="cust_query_open()"  j-word-label="W2018062810291518063" >客户搜索</button>
                            </td>

                        </tr>
                        <tr>
                            <th v-bind:class="must_model_id" ><div class="input-title" j-word-label="W2018062810293127369">模号</div></th>
                            <td colspan="4" style="padding-left:20px">
                                <input v-model="w_model_id"  type="text" id="target1231_date" class="multi-input text-left" data-date-format="yyyy-mm-dd">
                            </td>
                        </tr>
                        <tr>
                            <th ><div class="input-title" j-word-label="W2018062810300148794">之前图纸号码</div></th>
                            <td colspan="3" style="padding-left:20px">
                                <input v-model="w_drano" readonly="readonly" type="text" class="multi-input text-left xwrite" >
                            </td>
                            <td width="30px">
                                <input v-model="w_dranm" readonly="readonly" type="text" class="multi-input text-left xwrite" >
                            </td>
                        </tr>
                    </table>
                    <div class="sub_title" j-word-label="W2018062810305261707">AS接收信息</div>
                    <table class="search_table">
                        <colgroup>
                            <col width="100px;">
                        </colgroup>
                        <tr>
                            <th><div class="input-title" j-word-label="W2018062810310464752">AS接收编号</div></th>
                            <td colspan="4" rowspan="1" style="padding-left:20px">
                                <input v-model="w_asid" type="text" readonly="readonly"  class="multi-input text-left xwrite" >
                            </td>
                        </tr>
                        <tr>
                            <th class="th-red"  j-word-label="W2018062810311830074">AS区分</th>
                            <td colspan="4" rowspan="1" style="padding-left:20px">
                                <div id="asclass" class="multi-select">
                                    <input readonly="readonly" type="text" class="multi-input text-left" v-model="w_asclass" />
                                    <i class="layui-icon layui-icon-triangle-d"></i>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th j-word-label="W2018062810313521387">AS接收日期</th>
                            <td colspan="4" rowspan="1" style="padding-left:20px">
                                <input v-model="w_asgetdate" type="text" readonly="readonly" id="astime"  class="multi-input text-left xwrite" >
                            </td>
                        </tr>
                        <tr>
                            <th v-bind:class="must_assetdate" j-word-label="W2018062810315076351">交货日期</th>
                            <td colspan="4" rowspan="1" style="padding-left:20px">
                                <input v-model="w_assetdate" onfocus="this.blur();" type="text"  id="assettime"  class="layui-input multi-input text-left" data-date-format="yyyy-mm-dd">
                            </td>
                        </tr>
                        <tr>
                            <th  v-bind:class="must_asusernm" j-word-label="W2018041913373764065">职工姓名</th>
                            <td colspan="3" rowspan="1" style="padding-left:20px">
                                <input v-model="w_asusernm" type="text" readonly="readonly"  class="multi-input text-left xwrite" data-date-format="yyyy-mm-dd">
                            </td>
                            <td colspan="1">
                                <button class="layui-btn layui-btn-primary  layui-btn-sm" v-on:click="users_query_open(0)"  j-word-label="W2018041913334637071" >员工搜索</button>
                            </td>
                        </tr>

                        <tr>
                            <th v-bind:class="must_asgroupnm" j-word-label="W2018041913371894064">职工部门</th>
                            <td colspan="4" rowspan="1" style="padding-left:20px">
                                <input v-model="w_asgroupnm" type="text" readonly="readonly"  class="multi-input text-left xwrite" data-date-format="yyyy-mm-dd">
                            </td>
                        </tr>
                        <tr>
                            <th j-word-label="W2017071715555825006">状态</th>
                            <td colspan="4" rowspan="1" style="padding-left:20px">
                                <span class="layui-badge layui-bg-blue" >$((w_status))</span>
                            </td>
                        </tr>
                        <tr>
                            <th ><div class="input-title" j-word-label="W2018062810322809055">客户负责人</div></th>

                            <td colspan="4" rowspan="1" style="padding-left:20px">
                                <input v-bind:readonly="r_custprsn" v-model="w_custprsn" type="text" class="multi-input text-left" data-date-format="yyyy-mm-dd">
                            </td>
                        </tr>
                        <tr>
                            <th ><div class="input-title" j-word-label="W2018081513193495783">客户负责人TEL</div></th>
                            <td colspan="4" rowspan="1" style="padding-left:20px">
                                <input v-bind:readonly="r_custtell" v-model="w_custtell" type="text"  class="multi-input text-left" data-date-format="yyyy-mm-dd">
                            </td>
                        </tr>
                        <tr>
                            <th ><div class="input-title" j-word-label="W2018081513200299739">客户负责人Email</div></th>
                            <td colspan="4" rowspan="1" style="padding-left:20px">
                                <input v-bind:readonly="r_custemail" v-model="w_custemail" type="text"  class="multi-input text-left" data-date-format="yyyy-mm-dd">
                            </td>
                        </tr>
                        <tr>
                            <th j-word-label="W2013082814371224775">图纸编号</th>
                            <td colspan="3" rowspan="1" style="padding-left:20px">
                                <input v-model="w_asdrawid" type="text" readonly="readonly"  class="multi-input text-left xwrite" data-date-format="yyyy-mm-dd">
                            </td>
                            <td colspan="1" width="30px">
                                <input v-model="w_asdrawnm" type="text" readonly="readonly"  class="multi-input text-left xwrite" data-date-format="yyyy-mm-dd">
                            </td>
                        </tr>
                        <tr>
                            <th v-bind:class="must_ascause" j-word-label="W2018062810340442303">发生起点</th>
                            <td colspan="4" rowspan="1" style="padding-left:20px">
                                <div id="ascause" class="multi-select">
                                    <input readonly="readonly" type="text" class="multi-input text-left" v-model="w_ascause" />
                                    <i class="layui-icon layui-icon-triangle-d"></i>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th v-bind:class="must_asbadtype" j-word-label="W2011030909443598775">不良类型</th>
                            <td colspan="4" rowspan="1" style="padding-left:20px">
                                <div id="asbadtype" class="multi-select" >
                                    <input readonly="readonly" type="text" class="multi-input text-left" v-model="w_asbadtype" />
                                    <i class="layui-icon layui-icon-triangle-d"></i>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th  v-bind:class="must_asallclass" j-word-label="W2018062810353978387">原因_区分</th>
                            <td colspan="4" rowspan="1" style="padding-left:20px">
                                <div id="w_asallclass" class="multi-select">
                                    <input readonly="readonly" type="text" class="multi-input text-left" v-model="w_asallclass" />
                                    <i class="layui-icon layui-icon-triangle-d"></i>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th v-bind:class="must_asdutyclass" ><div class="input-title" j-word-label="W2018062810355432043">AS责任区分</div></th>
                            <td colspan="4" rowspan="1" style="padding-left:20px">
                                <div id="asdutyclass" class="multi-select">
                                    <input readonly="readonly" type="text" class="multi-input text-left" v-model="w_asdutyclass" />
                                    <i class="layui-icon layui-icon-triangle-d"></i>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th v-bind:class="must_asappearance" j-word-label="W2018062810361161368">AS现象</th>
                            <td colspan="4" rowspan="1" style="padding-left:20px">
                                <div id="asappearance" class="multi-select">
                                    <input readonly="readonly" type="text" class="multi-input text-left" v-model="w_asappearance" />
                                    <i class="layui-icon layui-icon-triangle-d"></i>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th v-bind:class="must_asreasonclass" ><div class="input-title" j-word-label="W2018062810362923732">AS原因-种类</div></th>
                            <td colspan="4" rowspan="1" style="padding-left:20px">
                                <div id="asreasonclass" class="multi-select">
                                    <input readonly="readonly" type="text" class="multi-input text-left" v-model="w_asreasonclass" />
                                    <i class="layui-icon layui-icon-triangle-d"></i>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th v-bind:class="must_asserviceclass" ><div class="input-title" j-word-label="W2018062810365984312">服务地区区分</div></th>
                            <td colspan="4" rowspan="1" style="padding-left:20px">
                                <div id="asserverclass" class="multi-select">
                                    <input v-bind:readonly="r_asserviceclass" type="text" readonly="readonly" class="multi-input text-left" v-model="w_asserviceclass" />
                                    <i class="layui-icon layui-icon-triangle-d"></i>
                                </div>
                                <!--<input v-model="w_asserviceclass" type="text" readonly="readonly"  class="multi-input text-left" data-date-format="yyyy-mm-dd">-->
                            </td>
                        </tr>
                        <tr>
                            <th v-bind:class="must_asservicearea" j-word-label="W2018062810372363351">服务地点</th>
                            <td colspan="4" rowspan="1" style="padding-left:20px">
                                <input v-model="w_asservicearea" type="text"  class="multi-input text-left" data-date-format="yyyy-mm-dd">
                            </td>
                        </tr>
                        <tr>
                            <th v-bind:class="must_trans" j-word-label="W2018062810373797345">是否移模</th>
                            <td colspan="4" rowspan="1" style="padding-left:20px">
                                <div style="float: right" class="mui-switch" id="mySwitch_trans" >
                                    <div class="mui-switch-handle"></div>
                                </div>
                            </td>
                        </tr>
                        <tr v-show="transdom">
                            <th j-word-label="W2018062810374972369">移模部门</th>
                            <td colspan="3" rowspan="1" style="padding-left:20px">
                                <input v-model="w_transgroup" type="text" readonly="readonly"  class="multi-input text-left xwrite" data-date-format="yyyy-mm-dd">
                            </td>
                            <td>
                                <button class="layui-btn layui-btn-primary  layui-btn-sm" v-on:click="group_query_open()"  j-word-label="W2018071009393573364" >部门搜索</button>
                            </td>
                        </tr>
                        <tr>
                            <th j-word-label="W2018071009351100377">确定</th>
                            <td colspan="4" rowspan="1" style="padding-left:20px">
                                <div style="float: right" class="mui-switch" id="mySwitch_confirm" >
                                    <div class="mui-switch-handle"></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th ><div class="input-title" j-word-label="W2018062810383100024">收费是否区分</div></th>
                            <td colspan="4" rowspan="1" style="padding-left:20px">
                                <div style="float: right" class="mui-switch" id="mySwitch_chargeYn" >
                                    <div class="mui-switch-handle"></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th ><div class="input-title" j-word-label="W2018062810384422313">部品返回与否</div></th>
                            <td colspan="4" rowspan="1" style="padding-left:20px">
                                <div style="float: right" class="mui-switch" id="mySwitch_itemReturn" >
                                    <div class="mui-switch-handle"></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th j-word-label="W2018062810381595041">有无接受</th>
                            <td colspan="4" rowspan="1" style="padding-left:20px" v-html="$options.filters.mf_aspower(s_apt)">
                            </td>
                        </tr>
                        <tr>
                            <th ><div class="input-title" j-word-label="W2018062810385770331">是否完成生产</div></th>
                            <td colspan="4" rowspan="1"  style="padding-left:20px"  v-html="$options.filters.mf_aspower(s_product)">
                            </td>
                        </tr>

                    </table>
                    <div class="sub_title" j-word-label="W2018071013095279028">系统信息</div>
                    <table class="search_table" style="width: 100%">
                        <colgroup>
                            <col width="100px;">
                        </colgroup>
                        <tr>
                            <th v-bind:class="must_supplyscope"><div class="input-title" j-word-label="W20180419131340737123">SupplyScope</div></th>
                            <td colspan="4" rowspan="1" style="padding-left:20px">
                                <div id="supplyscope" class="multi-select">
                                    <input readonly="readonly" type="text" class="multi-input text-left" v-model="w_supplyscope" />
                                    <i class="layui-icon layui-icon-triangle-d"></i>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th v-bind:class="must_hrs" j-word-label="W2018041913">HRS</th>
                            <td colspan="4" rowspan="1" style="padding-left:20px">
                                <div id="hrs" class="multi-select">
                                    <input readonly="readonly" type="text" class="multi-input text-left" v-model="w_hrs" />
                                    <i class="layui-icon layui-icon-triangle-d"></i>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th v-bind:class="must_manifoldtype"><div class="input-title" j-word-label="W20180419131340737123">Manifold Type</div></th>
                            <td colspan="4" rowspan="1" style="padding-left:20px">
                                <div id="manifoldtype" class="multi-select">
                                    <input readonly="readonly" type="text" class="multi-input text-left" v-model="w_manifoldtype" />
                                    <i class="layui-icon layui-icon-triangle-d"></i>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th v-bind:class="must_systemsize"><div class="input-title" j-word-label="W20180419131340737123">systemsize</div></th>
                            <td colspan="4" rowspan="1" style="padding-left:20px">
                                <div id="systemsize" class="multi-select">
                                    <input readonly="readonly" type="text" class="multi-input text-left" v-model="w_systemsize" />
                                    <i class="layui-icon layui-icon-triangle-d"></i>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th v-bind:class="must_systemtype"><div class="input-title" j-word-label="W20180419131340737123">systemtype</div></th>
                            <td colspan="4" rowspan="1" style="padding-left:20px">
                                <div id="systemtype" class="multi-select">
                                    <input readonly="readonly" type="text" class="multi-input text-left" v-model="w_systemtype" />
                                    <i class="layui-icon layui-icon-triangle-d"></i>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th v-bind:class="must_gatetype" ><div class="input-title" j-word-label="W20180419131340737123">gatetype</div></th>

                            <td colspan="4" rowspan="1" style="padding-left:20px">
                                <div id="gatetype" class="multi-select">
                                    <input readonly="readonly"  type="text"class="multi-input text-left" v-model="w_gatetype" />
                                    <i class="layui-icon layui-icon-triangle-d"></i>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th v-bind:class="must_cust_produce_name"><div class="input-title" j-word-label="W2018062810394954779">客户产品名称</div></th>

                            <td colspan="4" style="padding-left:20px">
                                <input v-bind:readonly="r_cust_produce_name" v-model="w_cust_produce_name"  type="text" class="multi-input text-left" >
                            </td>
                        </tr>
                        <tr>
                            <th v-bind:class="must_asplastic" j-word-label="W2018062810400728768">塑胶</th>

                            <td colspan="4" rowspan="1" style="padding-left:20px">
                                <input v-bind:readonly="r_asplastic" v-model="w_asplastic" type="text"  class="multi-input text-left" data-date-format="yyyy-mm-dd">
                            </td>
                        </tr>
                        <tr>
                            <th v-bind:class="must_Gate_counts" j-word-label="W2018062810404378386">Gate数量</th>

                            <td colspan="4" style="padding-left:20px">
                                <input v-model="w_Gate_counts" readonly="readonly" type="text" class="multi-input text-left xwrite" >
                            </td>
                        </tr>
                        <tr>
                            <th v-bind:class="must_markets" j-word-label="W">Markets</th>

                            <td colspan="4" style="padding-left:20px">
                                <div id="markets" class="multi-select">
                                    <input readonly="readonly" type="text"  class="multi-input text-left" v-model="w_markets" />
                                    <i class="layui-icon layui-icon-triangle-d"></i>
                                </div>
                            </td>
                        </tr>

                    </table>
                    <div class="sub_title" j-word-label="W2018062810411615366">详细说明</div>
                    <table class="search_table" style="width: 100%">
                        <colgroup>
                            <col width="100px;">
                        </colgroup>
                        <tr rowspan="3">
                            <th  v-bind:class="must_text1" j-word-label="W2018062810434922701">AS现状说明</th>
                            <td colspan="4" style="padding-left: 20px;">
                                <textarea  v-bind:readonly="r_text1" v-model="w_text1" type="text"  class="text-left" style="border-radius: 5px !important; height: 58px; width: 100%;">

                                </textarea>
                            </td>
                        </tr>
                        <tr rowspan="3">
                            <th v-bind:class="must_text2" j-word-label="W2018062810441287373">原因分析</th>
                            <td colspan="4" style="padding-left: 20px;">
                                <textarea  v-bind:readonly="r_text2" v-model="w_text2" type="text"  class="text-left" style="border-radius: 5px !important; height: 58px; width: 100%;">

                                </textarea>
                            </td>
                        </tr>
                        <tr rowspan="3">
                            <th v-bind:class="must_text3" ><div class="input-title" j-word-label="W2018062810445845052">改善建议及方案</div></th>
                            <td colspan="4" style="padding-left: 20px;">
                                <textarea  v-bind:readonly="r_text3" v-model="w_text3" type="text" class="text-left" style="border-radius: 5px !important; height: 58px; width: 100%;">

                                </textarea>
                            </td>
                        </tr>
                        <tr rowspan="3">
                            <th  j-word-label="W2018041913225420017">备注</th>
                            <td colspan="4" style="padding-left: 20px;">
                                <textarea  v-bind:readonly="r_text4" v-model="w_text4" type="text" class="text-left" style="border-radius: 5px !important; height: 58px; width: 100%;">

                                </textarea>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="sub_title" j-word-label="W2018062810453192374">录入信息</div>
                <div  style="overflow: auto; height: 200px;">
                    <ul class="mui-table-view" style="text-align: left">
                        <li class="mui-table-view-cell" v-on:click="asphoto_query_open()">
                            <a class="mui-navigate-right" j-word-label="W2018062810461626308" >照片</a>
                        </li>
                        <li class="mui-table-view-cell">
                            <a class="mui-navigate-right" j-word-label="W2018041913292308342" v-on:click="assales_query_open()">销售负责人</a>
                        </li>
                    </ul>
                </div>
                <div class="sub_title" j-word-label="W2018070509524326082">品目信息录入</div><button @click="astable_minute_open('add')" id="opensales" style="line-height: 15px;margin-top:-33px;margin-right: 5px;float: right;font-size: 25px;width:30px"  class="button-2000">+</button>
                <div  style="overflow: auto; height: 200px;padding-bottom: 50px">
                    <ul id="OA_task_1" class="mui-table-view" style="text-align: left">
                        <li class="mui-table-view-cell mui-transitioning" v-for="(item,index) in astablelist">
                            <div class="mui-slider-right mui-disabled">
                                <a class="mui-btn mui-btn-red" style="transform: translate(0px, 0px);" j-word-label="W2007083018132610775" v-on:click="del_astable(index,$event)" >删除</a>
                            </div>
                            <div class="mui-slider-handle" style="transform: translate(0px, 0px);" v-on:click="astable_minute_open(index)">
                                <a class="mui-navigate-right layui-badge layui-bg-blue" style="color: #545454">$((item.Sort))</a>
                                <a class="mui-navigate-right" style="color: #545454">$((item.ItemNm))</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    <div v-show="find_orderlist_show"  style="z-index: 2;" class="yudo-window">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" v-on:click="order_query_close('close')" >
                    <div class="left-icon icon-back-2"></div>
                </div>
                <div class="header-center-btn" j-word-label="W2018041913332473096">订单查询</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="center-ios">
            <div class="search_area" style="position: absolute;top: 50px">
                <table class="search_table" style="width: 100%;height: 81px;padding-top: 10px">
                    <tr>
                        <th j-word-label="W2018041913141737708">订单编号</th>
                        <td colspan="1">
                            <input type="text"  name="fastclick" class="multi-find-windows search_input" v-model='input_orderno'>
                        </td>
                        <td>
                            <img src="/image/qrcode.png" v-on:click="qr_order()" width="29">
                        </td>
                        <td>
                            <button class="button-2000" v-on:click="query_order()"  j-word-label="W2018020109095825029" style="font-size:15px">查询</button>
                        </td>
                    </tr>
                    <tr>
                        <th j-word-label="W2018041913362840092">客户名称</th>
                        <td colspan="2">
                            <input type="text"  name="fastclick" class="multi-find-windows search_input" v-model='input_custname'>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="search_area" style="height:100%;padding-top: 113px;width: 100%">
                <div id="asorder_tr" class="multi-list-2">
                    <table class="basic_table">
                        <tr>
                            <th style="text-align:center"><div class="basic_table_div" style="width: 30px">NO</div></th>
                            <th style="text-align:center" ><div j-word-label="W2018041913163666042" class="basic_table_div" style="width: 130px">订单日期</div></th>
                            <th style="text-align:center" ><div j-word-label="W2018041913141737708" class="basic_table_div" style="width: 100px">订单号码</div></th>
                            <th style="text-align:center" ><div j-word-label="W2018041913134073778" class="basic_table_div" style="width: 400px">客户名称</div></th>
                            <th style="text-align:center" ><div j-word-label="W2018041913371894064" class="basic_table_div" style="width: 130px">部门名称</div></th>
                            <th style="text-align:center" ><div j-word-label="W2018041913373764065" class="basic_table_div" style="width: 100px">职员姓名</div></th>
                            <th style="text-align:center" ><div j-word-label="W2018041913172613778" class="basic_table_div" style="width: 130px">交货期</div></th>
                        </tr>

                    </table>
                </div>
                <div id="mui_pushorder" class="search_area" style="float: left;overflow-y: auto;height:100%;position: relative">
                    <div class="search_area" id="order-list" style="overflow-x:auto;">
                        <table style="height: 30px;white-space: nowrap;text-align: center;" class="basic_table">
                            <tbody>
                            <tr v-for="(a_order,index) in orderlist" v-on:click="set_order(index)">
                                <td><div class="basic_table_div" style="width: 30px">$((index+1))</div></td>
                                <td><div class="basic_table_div" style="width: 130px">$((a_order.OrderDate | mf_replace))</div></td>
                                <td><div class="basic_table_div" style="width: 100px">$((a_order.OrderNo))</div></td>
                                <td><div class="basic_table_div" style="width: 400px">$((a_order.custname))</div></td>
                                <td><div class="basic_table_div" style="width: 130px">$((a_order.DeptNm))</div></td>
                                <td><div class="basic_table_div" style="width: 100px">$((a_order.EmpNm))</div></td>
                                <td><div class="basic_table_div" style="width: 130px">$((a_order.DelvDate | mf_replace))</div></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="layui-flow-more" v-show="order_isloadding">
                        <i class="layui-anim layui-anim-rotate layui-anim-loop layui-icon layui-icon-loading-1" style="font-size: 25px">
                        </i>
                        <div class="doc-icon-name">loading</div>
                    </div>
                    <div class="layui-flow-more" j-word-label="W2018062810475725084" v-show="order_nodata">没有更多了</div>

                </div>
            </div>
        </div>
    </div>
    <div v-show="find_custlist_show"  style="z-index: 2;" class="yudo-window">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" v-on:click="cust_query_close()" >
                    <div class="left-icon icon-back-2"></div>
                </div>
                <div class="header-center-btn" j-word-label="W2018082713485166321">客户查询</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="center-ios">
            <div class="search_area" style="position: absolute;top: 50px">
                <table class="search_table" style="width: 100%;height: 81px;padding-top: 10px">
                    <colgroup>
                        <col width="100px;">
                    </colgroup>
                    <tr>
                        <th j-word-label="W2018062810473444353">客户编号</th>
                        <td colspan="1">
                            <input type="text" name="fastclick" class="multi-find-windows search_input" v-model='input_custid'>
                        </td>
                        <td>
                            <button class="button-2000" v-on:click="query_cust()"  j-word-label="W2018020109095825029" style="font-size:15px">查询</button>
                        </td>
                    </tr>
                    <tr>
                        <th j-word-label="W2018041913362840092">客户名称</th>
                        <td colspan="1">
                            <input type="text" name="fastclick" class="multi-find-windows search_input" v-model='input_custnm'>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="search_area" style="height:100%;padding-top: 113px">
                <div class="multi-list-2"  id="ascust_tr">
                <table  class="basic_table">
                    <tr>
                        <th style="text-align:center"><div class="basic_table_div" style="width: 30px">NO</div></th>
                        <th style="text-align:center" ><div j-word-label="W2018062810473444353" class="basic_table_div" style="width: 100px">客户编号</div></th>
                        <th style="text-align:center" ><div j-word-label="W2018041913134073778" class="basic_table_div" style="width: 400px">客户名称</div></th>
                        <th style="text-align:center" ><div j-word-label="W2017080508114586755" class="basic_table_div" style="width: 50px">状态</div></th>
                        <th style="text-align:center" ><div j-word-label="W2018062810484850324" class="basic_table_div" style="width: 50px">国内/国外</div></th>
                    </tr>
                </table>
                </div>
                <div id="mui_pushcust"  class="search_area" style="float: left;overflow-y: auto;height:100%;position: relative">
                    <div class="search_area" id="cust-list" style="overflow-x:auto;">
                        <table style="height: 30px;white-space: nowrap;text-align: center;" class="basic_table">
                            <tbody>
                            <tr v-for="(a_cust,index) in custlist" v-on:click="set_cust(index)">
                                <td><div class="basic_table_div" style="width: 30px">$((index+1))</div></td>
                                <td><div class="basic_table_div" style="width: 100px">$((a_cust.CustCd))</div></td>
                                <td><div class="basic_table_div" style="width: 400px">$((a_cust.CustNm))</div></td>
                                <td><div class="basic_table_div" style="width: 50px">$((a_cust.status))</div></td>
                                <td><div class="basic_table_div" style="width: 50px">$((a_cust.KoOrFo | mf_koorfo))</div></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="layui-flow-more" v-show="cust_isloadding">
                        <i class="layui-anim layui-anim-rotate layui-anim-loop layui-icon layui-icon-loading-1" style="font-size: 25px">
                        </i>
                        <div class="doc-icon-name">loading</div>
                    </div>
                    <div class="layui-flow-more" j-word-label="W2018062810475725084" v-show="cust_nodata">没有更多了</div>
                </div>
            </div>
        </div>
    </div>
    <div v-show="find_speclist_show"  style="z-index: 2;" class="yudo-window">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn"v-on:click="spec_query_close()" >
                    <div class="left-icon icon-back-2"></div>
                </div>
                <div class="header-center-btn" j-word-label="W2018053017424773317">技术规范查询</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="center-ios">
            <div class="search_area" style="position: absolute;top: 50px">
                <table class="search_table" style="width: 100%;height: 81px;padding-top: 10px">
                    <colgroup>
                        <col width="100px;">
                    </colgroup>
                    <tr>
                        <th j-word-label="W2018062810281624053">技术规范编号</th>
                        <td colspan="1">
                            <input type="text" name="fastclick" class="multi-find-windows search_input" v-model='input_specid'>
                        </td>
                        <td>
                            <button class="button-2000" v-on:click="query_spec()"  j-word-label="W2018020109095825029" style="font-size:15px">查询</button>
                        </td>
                    </tr>
                    <tr>
                        <th j-word-label="W2018041913362840092">客户名称</th>
                        <td colspan="1">
                            <input type="text" id="gubun" name="fastclick" class="multi-find-windows search_input" v-model='input_speccustnm'>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="search_area" style="height:100%;padding-top: 113px">
                <div id="asspec_tr" class="multi-list-2">
                <table class="basic_table">
                    <tr>
                        <th style="text-align:center"><div class="basic_table_div" style="width: 30px">NO</div></th>
                        <th style="text-align:center" ><div j-word-label="W2018062810281624053" class="basic_table_div" style="width: 100px">技术规范编号</div></th>
                        <th style="text-align:center" ><div  class="basic_table_div" style="width: 130px">Purpose For</div></th>
                        <th style="text-align:center" ><div j-word-label="W2007110211452990075" class="basic_table_div" style="width: 100px">技术规范日期</div></th>
                        <th style="text-align:center" ><div j-word-label="W2015012012571415047" class="basic_table_div" style="width: 50px">出口区分</div></th>
                        <th style="text-align:center" ><div j-word-label="W2018041913362840092" class="basic_table_div" style="width: 400px">客户名称</div></th>
                        <th style="text-align:center"><div  j-word-label="W2018041913371894064" class="basic_table_div" style="width: 130px">部门名称</div></th>
                        <th style="text-align:center" ><div j-word-label="W2018041913373764065" class="basic_table_div" style="width: 100px">职员姓名</div></th>
                    </tr>
                </table>
                </div>
                <div id="mui_pushspec"  class="search_area" style="float: left;overflow-y: auto;height:100%;position: relative">
                    <div class="search_area" id="spec-list" style="overflow-x:auto;">
                        <table style="height: 30px;white-space: nowrap;text-align: center;" class="basic_table">
                            <tbody>
                            <tr v-for="(a_spec,index) in speclist" v-on:click="set_spec(index)">
                                <td><div class="basic_table_div" style="width: 30px">$((index+1))</div></td>
                                <td><div class="basic_table_div" style="width: 100px">$((a_spec.SpecNo))</div></td>
                                <td><div class="basic_table_div" style="width: 130px">$((a_spec.SpecType | mf_specclass))</div></td>
                                <td><div class="basic_table_div" style="width: 100px">$((a_spec.SpecDate | mf_replace))</div></td>
                                <td><div class="basic_table_div" style="width: 50px">$((a_spec.ExpClss | mf_expclass))</div></td>
                                <td><div class="basic_table_div" style="width: 400px">$((a_spec.CustNm))</div></td>
                                <td><div class="basic_table_div" style="width: 130px">$((a_spec.EmpNm))</div></td>
                                <td><div class="basic_table_div" style="width: 100px">$((a_spec.DeptNm))</div></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="layui-flow-more" v-show="spec_isloadding">
                        <i class="layui-anim layui-anim-rotate layui-anim-loop layui-icon layui-icon-loading-1" style="font-size: 25px">
                        </i>
                        <div class="doc-icon-name">loading</div>
                    </div>
                    <div class="layui-flow-more" j-word-label="W2018062810475725084" v-show="spec_nodata">没有更多了</div>

                </div>
            </div>
        </div>
    </div>
    <div v-show="find_aslist_show" style="z-index: 3;" class="yudo-window">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" v-on:click="as_query_close('close')">
                    <div class="left-icon icon-back-2"></div>
                </div>
                <div class="header-center-btn" j-word-label="W2019030809162934375">AS查询</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="center-ios" style="background-color: white">
            <div class="search_area" style="position: absolute;top: 50px">
                <table class="search_table">
                    <colgroup>
                        <col width="100px;">
                    </colgroup>
                    <tr>
                        <th j-word-label="W2018041913141737708">订单号码</th>
                        <td colspan="1">
                            <input type="text" v-model="input_asid" class="multi-find-windows search_input">
                        </td>
                        <td style="width: 29px" colspan="1">
                            <img src="/image/qrcode.png" v-on:click="qr_as()" width="29">
                        </td>
                        <td colspan="1">
                            <button class="button-2000" v-on:click="query_as()" j-word-label="W2018020109095825029" style="font-size:15px">查询</button>
                        </td>
                    </tr>
                    <tr>
                        <th j-word-label="W2018041913134073778">客户名称</th>
                        <td colspan="3">
                            <input type="text" v-model="input_ascustname" class="multi-find-windows search_input">
                        </td>
                    </tr>
                    <tr><th j-word-label="W2018041913123">时间</th>
                        <td colspan="3">
                            <input id="asStartDate" onfocus="this.blur();"  v-model="input_asStartDate" type="text" style="width: 49% !important; float: left" name="fastclick" class="multi-find-windows search_input" />
                            <input id="asEndDate" onfocus="this.blur();"  v-model="input_asEndDate" type="text" style="width: 49% !important;float: right" name="fastclick" class="multi-find-windows search_input"/>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="search_area" style="height:100%;padding-top: 139px">
                <div  id="aslist_tr" class="multi-list-3">
                <table class="basic_table">
                    <tr>
                        <th style="text-align:center"><div class="basic_table_div" style="width: 30px">NO</div></th>
                        <th style="text-align:center" ><div j-word-label="W2018062810310464752" class="basic_table_div" style="width: 100px">AS接收编号</div></th>
                        <th style="text-align:center" ><div j-word-label="W2018071009351100377" class="basic_table_div" style="width: 50px">确定</div></th>
                        <th style="text-align:center" ><div j-word-label="W2018071009324085701" class="basic_table_div" style="width: 50px">完成生产</div></th>
                        <th style="text-align:center" ><div j-word-label="W2018062810494812027" class="basic_table_div" style="width: 50px">接受</div></th>
                        <th style="text-align:center" ><div j-word-label="W2018041913371894064" class="basic_table_div" style="width: 300px">客户名称</div></th>
                        <th style="text-align:center" ><div j-word-label="W2018041913141737708" class="basic_table_div" style="width: 100px">订单号码</div></th>
                        <th style="text-align:center" ><div j-word-label="W2018062810313521387" class="basic_table_div" style="width: 100px">AS接收日期</div></th>
                        <th style="text-align:center" ><div j-word-label="W2018041913373764065" class="basic_table_div" style="width: 100px">职员姓名</div></th>
                        <th style="text-align:center" ><div j-word-label="W2018041913371894064" class="basic_table_div" style="width: 150px">部门名称</div></th>
                        <th style="text-align:center" ><div j-word-label="W2018041913172613778" class="basic_table_div" style="width: 100px">交货日期</div></th>
                    </tr>
                </table>
                </div>
                <div  id="mui_pushas" class="search_area" style="float: left;overflow-y: auto;height:100%;position: relative">
                    <div class="search_area" id="AS-list" style="overflow-x:auto;">
                        <table style="height: 30px;white-space: nowrap;text-align: center;" class="basic_table">
                            <tbody>
                                <tr v-for="(a_as,index) in aslist" v-on:click="set_as(index);">
                                    <td><div class="basic_table_div" style="width: 30px">$((index+1))</div></td>
                                    <td><div class="basic_table_div" style="width: 100px">$((a_as.ASRecvNo))</div></td>
                                    <td v-html="$options.filters.mf_asconfirm(a_as.CfmYn)"></td  >
                                    <td style="text-align: center" v-html="$options.filters.mf_asconfirm(a_as.ProductYn)"></td>
                                    <td v-html="$options.filters.mf_asconfirm(a_as.AptYn)"></td>
                                    <td><div class="basic_table_div" style="width: 300px">$((a_as.CustNm))</div></td>
                                    <td><div class="basic_table_div" style="width: 100px">$((a_as.OrderNo))</div></td>
                                    <td><div class="basic_table_div" style="width: 100px">$((a_as.ASRecvDate  | mf_replace))</div></td>
                                    <td><div class="basic_table_div" style="width: 100px">$((a_as.EmpNm))</div></td>
                                    <td><div class="basic_table_div" style="width: 150px">$((a_as.DeptNm))</div></td>
                                    <td><div class="basic_table_div" style="width: 100px">$((a_as.ASDelvDate  | mf_replace))</div></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="layui-flow-more" v-show="as_isloadding">
                        <i class="layui-anim layui-anim-rotate layui-anim-loop layui-icon layui-icon-loading-1" style="font-size: 25px">
                        </i>
                        <div class="doc-icon-name">loading</div>
                    </div>
                    <div class="layui-flow-more" j-word-label="W2018062810475725084" v-show="as_nodata">没有更多了</div>
                </div>
            </div>
        </div>
    </div>
    <div v-show="find_userlist_show"  style="z-index: 2;" class="yudo-window">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" v-on:click="users_query_close()" >
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
                <table class="search_table" style="width: 100%;height: 81px;padding-top: 10px">
                    <colgroup>
                        <col width="100px;">
                    </colgroup>
                    <tr>
                        <th j-word-label="W2018041913373764065">职员姓名</th>
                        <td colspan="1">
                            <input v-model="input_username" type="text" id="this_user"  class="multi-find-windows search_input " data-date-format="yyyy-mm-dd">
                        </td>
                        <td>
                            <button class="button-2000" v-on:click="query_users()" style="font-size: 15px" j-word-label="W2018020109095825029">查询</button>
                        </td>

                    </tr>
                    <tr>
                        <th j-word-label="W2018041913385580778">职员工号</th>
                        <td colspan="3">
                            <input v-model="input_userid" type="text" id="this_user_id"  class="multi-find-windows search_input" data-date-format="yyyy-mm-dd">
                        </td>
                    </tr>
                    <tr>
                        <th j-word-label="W2018041913371894064">部门名称</th>
                        <td colspan="3">
                            <input v-model="input_groupname" type="text" id="this_group"  class="multi-find-windows search_input" data-date-format="yyyy-mm-dd">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="search_area" style="height:100%;padding-top: 149px">
                <div id="asuser_tr" class="multi-list-3">
                <table class="basic_table">
                    <tr>
                        <th ><div class="basic_table_div" style="width: 30px">NO</div></th>
                        <th style="text-align:center"><div j-word-label="W2018041913371894064" class="basic_table_div" style="width: 150px">部门名称</div></th>
                        <th style="text-align:center"><div  j-word-label="W2018041913373764065" class="basic_table_div" style="width: 100px">职员姓名</div></th>
                        <th style="text-align:center" ><div j-word-label="W2018041913385580778" class="basic_table_div" style="width: 100px">职员工号</div></th>
                    </tr>
                </table>
                </div>
                <div id="mui_pushuser" class="search_area" style="float: left;overflow-y: auto;height:100%;position: relative">
                    <div class="search_area" id="user-list" style="overflow-x:auto;">
                        <table style="height: 30px;white-space: nowrap;text-align: center;" class="basic_table">
                            <tbody id="find-user-list">
                            <tr v-for="(user,index) in userslist" @click="set_user(index)">
                               <td><div class="basic_table_div" style="width: 30px">$((index+1))</div></td>
                                <td><div class="basic_table_div" style="width: 150px">$((user.EmpNm))</div></td>
                                <td><div class="basic_table_div" style="width: 100px">$((user.DeptNm))</div></td>
                                <td><div class="basic_table_div" style="width: 100px">$((user.EmpID))</div></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="layui-flow-more" v-show="isloadding">
                        <i class="layui-anim layui-anim-rotate layui-anim-loop layui-icon layui-icon-loading-1" style="font-size: 25px">
                        </i>
                        <div class="doc-icon-name">loading</div>
                    </div>
                    <div class="layui-flow-more" j-word-label="W2018062810475725084" v-show="nodata">没有更多了</div>

                </div>
            </div>
        </div>
    </div>
    <div v-show="find_grouplist_show"  style="z-index: 2;" class="yudo-window">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" v-on:click="group_query_close()" >
                    <div class="left-icon icon-back-2"></div>
                </div>
                <div class="header-center-btn" j-word-label="W2018071009393573364">部门查询</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="center-ios">
            <div class="search_area" style="position: absolute;top: 50px">
                <table class="search_table" style="width: 100%;height: 81px;padding-top: 10px">
                    <colgroup>
                        <col width="100px;">
                    </colgroup>
                    <tr>
                        <th j-word-label="W2018041913371894064">部门名称</th>
                        <td colspan="1">
                            <input  v-model="input_groupfindname" type="text"  class="multi-find-windows search_input " data-date-format="yyyy-mm-dd">
                        </td>
                        <td>
                            <button class="button-2000" v-on:click="query_group()" style="font-size: 15px" j-word-label="W2018020109095825029">查询</button>
                        </td>

                    </tr>
                    <tr>
                        <th j-word-label="W2018041913392311092">部门编号</th>
                        <td colspan="3">
                            <input v-model="input_groupfindid" type="text"   class="multi-find-windows search_input" data-date-format="yyyy-mm-dd">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="search_area" style="height:100%;padding-top: 113px">
                <div id="asgroup_tr" class="multi-list-2">
                <table class="basic_table">
                    <tr>
                        <th ><div class="basic_table_div" style="width: 30px">NO</div></th>
                        <th style="text-align:center" ><div class="basic_table_div" j-word-label="W2018041913371894064" style="width: 150px">部门名称</div></th>
                        <th style="text-align:center"><div class="basic_table_div" j-word-label="W2018041913392311092" style="width: 100px">部门编号</div></th>
                    </tr>
                </table>
                </div>
                <div class="search_area" style="float: left;overflow-y: auto;height:100%;position: relative">
                    <div class="search_area" id="group-list" style="overflow-x:auto">
                        <table style="height: 30px;white-space: nowrap;text-align: center;" class="basic_table">
                            <tbody>
                            <tr v-for="(group,index) in grouplist" @click="set_group(index)">
                                <td><div class="basic_table_div" style="width: 30px">$((index+1))</div></td>
                                <td><div class="basic_table_div" style="width: 150px">$((group.DeptNm))</div></td>
                                <td><div class="basic_table_div" style="width: 100px">$((group.DeptCd))</div></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="layui-flow-more" v-show="isloadding">
                        <i class="layui-anim layui-anim-rotate layui-anim-loop layui-icon layui-icon-loading-1" style="font-size: 25px">
                        </i>
                        <div class="doc-icon-name">loading</div>
                    </div>
                    <div class="layui-flow-more" j-word-label="W2018062810475725084" v-show="nodata">没有更多了</div>

                </div>
            </div>
        </div>
    </div>
    <div v-show="find_assaleslist_show"  style="z-index: 3;" class="yudo-window">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" @click="assaleslist_query_close()">
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
                            <input v-model="input_username" type="text"   class="multi-find-windows search_input " data-date-format="yyyy-mm-dd">
                        </td>
                        <td>
                            <button class="button-2000" v-on:click="query_users()" style="font-size: 15px" j-word-label="W2018020109095825029">查询</button>
                        </td>
                        <td>
                            <button class="button-2000" v-on:click="save_sales()"  style="font-size: 15px" j-word-label="W2018050411092732363">导入</button>
                        </td>

                    </tr>
                    <tr>
                        <th j-word-label="W2018041913385580778">职员工号</th>
                        <td colspan="3">
                            <input v-model="input_userid" type="text"   class="multi-find-windows search_input" data-date-format="yyyy-mm-dd">
                        </td>
                    </tr>
                    <tr>
                        <th j-word-label="W2018041913371894064">部门名称</th>
                        <td colspan="3">
                            <input v-model="input_groupname" type="text"  class="multi-find-windows search_input" data-date-format="yyyy-mm-dd">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="search_area" style="height:100%;padding-top: 109px">
                <div class="multi-list-3" id="assales_tr">
                <table class="basic_table">
                    <tr>
                        <th> <div class="basic_table_div" style="width: 50px;text-align: center">NO</div></th>
                        <th style="text-align:center" ><div j-word-label="W2018041913373764065" class="basic_table_div" style="width: 150px">职员姓名</div></th>
                        <th style="text-align:center"><div  j-word-label="W2018041913371894064" class="basic_table_div" style="width: 100px">部门名称</div></th>
                        <th style="text-align:center"><div j-word-label="W2018041913385580778" class="basic_table_div" style="width: 100px">职员工号</div></th>
                    </tr>
                </table>
                </div>
                <div id="mui_pushsales"  class="search_area" style="float: left;overflow-y: auto;height:100%;position: relative">
                    <div class="search_area" id="sales-list"  style="overflow-x:auto;padding-top: 30px">
                        <table style="height: 30px;white-space: nowrap;text-align: center;" class="basic_table">
                            <tbody >
                            <tr v-for="(user,index) in userslist">
                                <td>
                                    <div class="basic_table_div mui-input-row mui-checkbox" style="width: 50px">
                                        <label style="color: transparent;padding: 6px 0 17px 35px!important;margin-bottom: 1px !important;"></label>
                                        <input v-model="assales_checkbox" name="mui_checkbox" style="z-index: 2;left: 3px !important;top:0 !important;margin-top: 0 !important;" v-bind:value="user.EmpID" type="checkbox">
                                    </div>
                                </td>
                                <td><div class="basic_table_div" style="width: 150px">$((user.EmpNm))</div></td>
                                <td><div class="basic_table_div" style="width: 100px">$((user.DeptNm))</div></td>
                                <td><div class="basic_table_div" style="width: 100px">$((user.EmpID))</div></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="layui-flow-more" v-show="isloadding">
                        <i class="layui-anim layui-anim-rotate layui-anim-loop layui-icon layui-icon-loading-1" style="font-size: 25px">
                        </i>
                        <div class="doc-icon-name">loading</div>
                    </div>
                    <div class="layui-flow-more" v-show="nodata">没有更多了</div>

                </div>
            </div>
        </div>
    </div>
    <div v-show="astable_minute_show" v-bind:style="style_astable_minute"  style="z-index: 2;" class="yudo-window">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" @click="astable_minute_close()">
                    <div class="left-icon icon-back-2"></div>
                </div>
                <div class="header-center-btn" j-word-label="W2018070509524326082">品目信息</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="center-ios" style="background-color: white">
            <table class="search_table">
                <colgroup>
                    <col width="100px;">
                </colgroup>
                <tr>
                    <th class="th-red" j-word-label="W2018041913">NO</th>
                    <td colspan="3" rowspan="1" style="padding-left:20px">
                        <input v-model="w_astable_Sort" type="text" readonly="readonly"  class="multi-input text-left  xwrite" data-date-format="yyyy-mm-dd">
                    </td>
                </tr>
                <tr>
                    <th class="th-red" j-word-label="W2018062810504422036">品目编码</th>
                    <td colspan="2" rowspan="1" style="padding-left:20px">
                        <input v-model="w_astable_ItemNo" type="text" readonly="readonly"  class="multi-input text-left  xwrite" data-date-format="yyyy-mm-dd">
                    </td>
                    <td colspan="1" width="50px">
                        <button class="button-2000" v-on:click="astableid_query_open()" j-word-label="W2018020109095825029" style="font-size:15px">查询</button>
                    </td>
                </tr>
                <tr>
                    <th j-word-label="W2018062810511435013">品目名称</th>
                    <td colspan="3" rowspan="1" style="padding-left:20px">
                        <input v-model="w_astable_ItemNm" type="text" readonly="readonly"  class="multi-input text-left  xwrite" data-date-format="yyyy-mm-dd">
                    </td>
                </tr>
                <tr>
                    <th j-word-label="W2018062810520860062">规格</th>
                    <td colspan="3" rowspan="1" style="padding-left:20px">
                        <input v-model="w_astable_Spec" type="text" readonly="readonly"  class="multi-input text-left xwrite" data-date-format="yyyy-mm-dd">
                    </td>
                </tr>
                <tr>
                    <th j-word-label="W2018041913">SPARE</th>
                    <td colspan="3" rowspan="1" style="padding-left:20px">
                        <div style="float: right" class="mui-switch" id="mySwitch_table_spare">
                            <div class="mui-switch-handle"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="th-red" j-word-label="W2018071013040628794">单位编码</th>
                    <td colspan="3" rowspan="1" style="padding-left:20px">
                        <div id="asunit" class="multi-select">
                            <input readonly="readonly" class="multi-input text-left" v-model="w_astable_UnitNm" />
                            <i class="layui-icon layui-icon-triangle-d"></i>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="th-red" j-word-label="W2018062810534850327">数量</th>
                    <td colspan="3" rowspan="1" style="padding-left:20px">
                        <input v-model="w_astable_Qty" type="text"   class="multi-input text-left " data-date-format="yyyy-mm-dd">
                    </td>
                </tr>
                <tr>
                    <th j-word-label="W2018071009324085701">收费与否</th>
                    <td colspan="3" rowspan="1" style="padding-left:20px">
                        <div style="float: right" class="mui-switch" id="mySwitch_table_char">
                            <div class="mui-switch-handle"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th j-word-label="W2018062810551330316">现库存</th>
                    <td colspan="3" rowspan="1" style="padding-left:20px">
                        <input v-model="w_astable_PreStockQty" type="text" readonly="readonly"  class="multi-input text-left xwrite" data-date-format="yyyy-mm-dd">
                    </td>
                </tr>
                <tr>
                    <th j-word-label="W2018062810554066393">进行数量</th>
                    <td colspan="3" rowspan="1" style="padding-left:20px">
                        <input v-model="w_astable_NextQty"  type="text" readonly="readonly"  class="multi-input text-left xwrite" data-date-format="yyyy-mm-dd">
                    </td>
                </tr>
                <tr>
                    <th j-word-label="W2018062810561010011">暂停数量</th>
                    <td colspan="3" rowspan="1" style="padding-left:20px">
                        <input v-model="w_astable_StopQty" type="text" readonly="readonly"  class="multi-input text-left xwrite" data-date-format="yyyy-mm-dd">
                    </td>
                </tr>
                <tr rowspan="2">
                    <th j-word-label="W2018041913225420017">备注</th>
                    <td colspan="3" style="padding-left: 20px;">
                            <textarea  v-model="w_astable_Remark" type="text" class="text-left" style="border-radius: 5px !important; height: 58px; width: 100%;">
                            </textarea>
                    </td>
                </tr>
            </table>
            <div class="saves" style="width: 100%;text-align: center;position: absolute;bottom: 10px">
                <input   id="item_save"  @click="save_astable()" type="button" value="保存" class="save-btn" style=";padding-top: 2px;margin-bottom: 0;height: 38px"/>
            </div>
        </div>
    </div>
    <!--<div style="width: 100%;height: 300px">-->
    <!--</div>-->
</div>
<script src="/js/WEI_2100/layui.all.js"></script>
<script src="/js/WEI_2100/WEI_2100_Lists.js?v=3211"></script>
</body>
</html>
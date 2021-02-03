<?php /* Template_ 2.2.6 2020/02/28 15:18:14 /home/merp.yudo.com.cn/public_html/JLAMP_application/views/SalesBusinessView/WEI_2100_Lists.html 000098297 */ ?>
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
    <link rel="stylesheet" href="/css/mui.min.css?v=1015">
    <link rel="stylesheet" href="/css/yudo-ui.css?v=1084">
    <link rel="stylesheet" href="/css/common.css?v=1003">
<!--    <link rel="stylesheet" href="/css/WEI_2100/WEI_2100_Lists.css?v=<?php $this->print_("WEI_2100Version",$TPL_SCP,1);?>">-->
    <link rel="stylesheet" href="/css/mui.picker.min.css">
<!--    <link rel="stylesheet" href="/js/WEI_2100/css/layui.css">-->
    <link rel="stylesheet" href="/css/ystep.css">
    <link rel="stylesheet" href="/css/animate.min.css?v=1003">
    <!--jquery vue-->
    <script type="text/javascript" src="/third_party/jquery-2.1.4/jquery.js"></script>
    <script>var jq = $.noConflict(); var title = 'YUDO Mobile Erp';</script>
    <script src="/js/vue.js"></script>
    <!--mui echarts multi fastclick-->
    <script src="/js/mui.min.js?v=1001"></script>
<!--    <script src="/js/WEI_2100/layui.all.js"></script>-->
    <script src="/js/multiHttp.js?v=2001"></script>
    <script src="/js/multiSelect.js?v=2011"></script>
    <script src="/js/lang.min.js?v=1002"></script>
    <script src="/js/exif.js"></script>
    <script src="/js/setStep.js"></script>
    <script src="/js/mui.previewimage.js?v=201804261256"></script>
    <script src="/js/mui.zoom.js?v=201804231454"></script>
    <script src="/js/mui.picker.min.js?v=1001"></script>
    <script type="text/javascript" src="/js/fastclick.js"></script>
    <!--jlamp-->
    <script type="text/javascript" src="/js/JLAMP.min.js"></script>
    <script type="text/javascript" src="/js/JLAMP.common.min.js"></script>
    <script type="text/javascript" src="/js/JLAMP.lang.min.js"></script>
    <style>
        a,input,button{
            touch-action: manipulation;
            -ms-touch-action: manipulation
        }
        .th-red{
            color: #ff6374 !important;
        }
        .yudo-window{
            animation-duration: 0.4s
        }
        .yudo-window-trans{
            animation-duration: 0.2s
        }
    </style>
</head>
<body>
<div id="popover" class="mui-popover" style="background: white;width: 150px;right: 10px;top: 40px">
    <ul class="mui-table-view">
        <li class="mui-table-view-cell" onclick="leon.subAdjudication()" j-word-label="W2018071009251284093">提交OA申请</li>
        <li class="mui-table-view-cell" onclick="leon.unSubAdjudication()" j-word-label="W2018071009254859784">取消OA申请</li>
        <li class="mui-table-view-cell" onclick="leon.routeAsHandle()">录入AS处理</li>
    </ul>
</div>
<div id="leon" style="overflow-y:auto;height: 100%;">
    <div class="download-script flex-center" v-if="downLoadScript">
        <div v-if="errorMenu" style="display: none">
            <div class="header-ios" style="z-index: 3">
                <div class="header-body">
                    <div class="header-left-btn long" onclick="multi.backMenu()">
                        <div class="left-icon icon-backmenu"></div>
                        <div class="left-text"></div>
                    </div>
                    <div class="header-center-btn">YUDO</div>
                    <div class="header-right-btn">
                        <div class="right-icon icon-extend"></div>
                    </div>
                </div>
            </div>
            <button style="width: 80%;height: 40px" class="yudo-btn yudo-btn-white" onclick="location.reload();">Refresh</button>
            <div class="yudo-footer">
                YUDO MOBILE ERP
            </div>
        </div>
    </div>
    <div class="yudo-window" style="z-index: 2;"  v-show="as_menu_show">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" onclick="multi.backMenu()">
                    <div class="left-icon icon-backmenu"></div>
                    <div class="left-text">$((langCode.menuBack))</div>
                </div>
                <div class="header-center-btn" j-word-label="W2019030809162934375">AS接受</div>
                <div class="header-right-btn">
<!--                    <div class="right-icon icon-extend"></div>-->
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
                <button v-on:click="showAddAsHandle()" type="button" class="menu-btn" style="padding-top: 2px">
                    <span style="position: relative"><div class="icon-write btn-icon"></div><span CHN="新增AS处理信息">$((langCode.addAsProcM))</span></span>
                </button>
                <button v-on:click="showQueryAsHandle()" type="button" class="menu-btn" style="padding-top: 2px">
                    <span style="position: relative"><div class="icon-search btn-icon"></div><span CHN="查询AS处理信息">$((langCode.searchAsProcM))</span></span>
                </button>
            </div>
        </div>
        <div class="yudo-footer">
            YUDO MOBILE ERP
        </div>
    </div>
    <div v-show="find_asphoto_show" style="z-index: 102;" class="yudo-window">
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
                <li class="mui-table-view-cell mui-transitioning" style="padding: 0" v-for="(photo,index) in asphotolist">
                    <div class="mui-slider-right mui-disabled">
                        <a class="mui-btn mui-btn-red" style="transform: translate(0px, 0px);" v-on:click="del_photo(index,$event)" >删除</a>
                    </div>
                    <div class="mui-slider-handle" style="transform: translate(0px, 0px);">
                        <div style="margin: 0!important;" class="mui-content-padded">
                            <img style="height: 80px;width: 80px;max-width: 80px" class="mui-media-object mui-pull-left" :src="photo.imagedir" data-preview-src="" data-preview-group="1" >
                        </div>
                        <span style="line-height: 80px">$((photo.FileNm))</span>
                    </div>
                </li>
            </ul>
            <div style="background-color: white;border-top: 1px solid #b3b3b3;position: fixed;width: 100%;bottom: 0px;left: 0;padding: 0 20%;height:50px;margin-left:auto;margin-right: auto">
                <input v-on:click="save_photo()" style="width: 100%;height: 38px;border-radius: 19px" class="bn_normal_100" id="photo-up"  type="button" value="上传">
            </div>
        </div>
        <input style="display: none"  type="file" id="asphoto_upload" name="file" multiple="multiple" @change="uploadPic" >
    </div>
    <div v-show="find_assales_show" id="find-sales-list" style="z-index: 102;" class="yudo-window">
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
                        <span class="yudo-label label-primary">$((index+1))</span>
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
    <div v-show="slide_panel_show" style="z-index: 102;" class="yudo-window-trans animated fadeInRight" id="slide_panel" >
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" id="backMenu" @click="slide_panel_close">
                    <div class="left-icon icon-back-2"></div>
                    <div class="left-text"></div>
                </div>
                <div class="header-center-btn" j-word-label="W2019030809162934375">AS接受</div>
                <div class="header-right-btn" @click="showExtend">
                    <div class="right-icon icon-extend" ></div>
                </div>
            </div>
        </div>
        <div class="center-ios">
            <div class="yudo-scroll">
                <div class="area">
                    <div class="title flex-left">
                        <div class="len-3">$((langCode.orderInfo))</div>
                        <div class="len-7 flex-right" style="height: 40px;padding: 5px 0;line-height: 30px">
<!--                            <button class="yudo-btn-primary"  style="width:100px;margin-right: 5px" onclick="leon.subAdjudication()"  j-word-label="W2018071009251284093" >提交裁决</button>-->
<!--                            <button class="yudo-btn-primary" style="width: 100px;margin: 0 -10px 0 0" onclick="leon.unSubAdjudication()"  j-word-label="W2018071009254859784" >裁决上报取消</button>-->
                        </div>
                    </div>
                    <div class="input-tr">
                        <div v-bind:class="must_orderclass" class="input-tr-title long"><div class="input-title" j-word-label="W2018062810274700393">订单区分</div></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="icon-xiala select-btn"></div>
                                <select v-model="w_ordergubun"  type="text" class="yudo-input noborder" @change="orderclassChange">
                                    <option :value="item.value" v-for="(item,index) in select_orderclass ">$((item.text))</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div v-bind:class="must_order_id" class="input-tr-title long"><div class="input-title" j-word-label="W2018041913141737708">订单号码</div></div>
                        <div class="input-tr-body flex-left">
                            <div class="input-border" style="flex: 1">
                                <input v-on:click="order_query_open()" type="text" readonly="true" v-model="w_order_id" class="read-only yudo-input noborder">
                            </div>
                            <div class="input-border" style="flex-shrink: 1;width: 35px;margin-left: 5px">
                                <input style="width: 35px;padding: 5px 5px !important;text-align:center" type="text" readonly="true" v-model="w_order_cnt" class="read-only yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><div class="input-title" j-word-label="W2018062810281624053">技术规范编号</div></div>
                        <div class="input-tr-body flex-left">
                            <div  class="input-border" style="flex: 1">
                                <input v-on:click="spec_query_open()" type="text" readonly="true" v-model="w_spec_id" class="read-only yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div v-bind:class="must_export_distinction" class="input-tr-title long"><div class="input-title" j-word-label="W2018062810285065731">出口区分</div></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="icon-xiala select-btn"></div>
                                <select v-model="w_export_distinction_id"  type="text" class="yudo-input noborder">
                                    <option :value="item.value" v-for="(item,index) in select_export_distinction">$((item.text))</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div v-bind:class="must_cust_name" class="input-tr-title long"><div class="input-title" j-word-label="W2018041913362840092">客户名称</div></div>
                        <div  class="input-tr-body flex-left">
                            <div  class="input-border" style="flex: 1">
                                <input v-on:click="cust_query_open()"  type="text" readonly="true" v-model="w_cust_name" class="read-only yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div v-bind:class="must_model_id"  class="input-tr-title long"><div class="input-title" j-word-label="W2018062810293127369">模号</div></div>
                        <div  class="input-tr-body flex-left">
                            <div  class="input-border" style="flex: 1">
                                <input v-bind:readonly="r_custprsn"  type="text"  v-model="w_model_id"  class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr" style="margin-bottom: 10px">
                        <div class="input-tr-title long"><div class="input-title"  j-word-label="W2018062810300148794">之前图纸号码</div></div>
                        <div class="input-tr-body flex-left">
                            <div class="input-border" style="flex: 1">
                                <div class="yudo-input">$((w_drano))&nbsp;$((w_dranm))</div>
                                <!--<input type="text" readonly="true" v-model="w_order_id" class="read-only yudo-input noborder">-->
                            </div>
                        </div>
                    </div>
                    <div class="title" j-word-label="W2018062810305261707">AS接收信息</div>
                    <!--<div class="sub_title" j-word-label="W2018062810305261707">AS接收信息</div>-->
                    <div class="input-tr">
                        <div class="input-tr-title long"><div class="input-title" j-word-label="W2018062810310464752">AS接收编号</div></div>
                        <div class="input-tr-body flex-left">
                            <div class="input-border" style="flex: 1">
                                <input type="text" readonly="true"v-model="w_asid" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="th-red input-tr-title long"><div class="input-title" j-word-label="W2018062810311830074">AS区分</div></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="icon-xiala select-btn"></div>
                                <select v-model="w_asclass_id"  type="text" class="yudo-input noborder" @change="asclassChange()">
                                    <option :value="item.value" v-for="(item,index) in select_asclass ">$((item.text))</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr" style="margin-bottom: 10px">
                        <div class="input-tr-title long"><div class="input-title"  j-word-label="W2018062810313521387">AS接收日期</div></div>
                        <div class="input-tr-body flex-left">
                            <div class="input-border" style="flex: 1">
                                <input type="text" readonly="true"  @click="getDate('w_asgetdate')"  v-model="w_asgetdate" class="read-only yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr" style="margin-bottom: 10px">
                        <div v-bind:class="must_assetdate" class="input-tr-title long"><div class="input-title"  j-word-label="W2018062810315076351">交货日期</div></div>
                        <div class="input-tr-body flex-left">
                            <div class="input-border" style="flex: 1">
                                <input type="text" readonly="true" @click="getDate('w_assetdate')"  v-model="w_assetdate"  class="read-only yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr" style="margin-bottom: 10px">
                        <div v-bind:class="must_asusernm" class="input-tr-title long"><div class="input-title"  j-word-label="W2019051315430001369">负责人</div></div>
                        <div class="input-tr-body flex-left">
                            <div class="input-border">
                                <input type="text" readonly="true" v-on:click="users_query_open(0)" v-model="w_asgroupnm"  class="read-only yudo-input noborder">
                            </div>
                        </div>
                        <div class="input-tr-body flex-left" style="margin-left: 10px">
                            <div class="input-border">
                                <input type="text" readonly="true" v-on:click="users_query_open(0)" v-model="w_asusernm"  class="read-only yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr" style="margin-bottom: 10px">
                        <div class="input-tr-title long"><div class="input-title"  j-word-label="W2018082315443716702">状态</div></div>
                        <div class="input-tr-body">
                            <span style="font-size: 14px;line-height: 30px;padding: 0 10px;height: 30px" class="yudo-label label-primary">$((w_status))</span>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><div class="input-title" j-word-label="W2018062810322809055">客户负责人</div></div>
                        <div  class="input-tr-body flex-left">
                            <div  class="input-border">
                                <input v-bind:readonly="r_custprsn" type="text" v-model="w_custprsn" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><div class="input-title" j-word-label="W2018081513193495783">客户负责人TEL</div></div>
                        <div  class="input-tr-body">
                            <div  class="input-border">
                                <input v-bind:readonly="r_custprsn" type="text"  v-model="w_custtell" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><div class="input-title" j-word-label="W2018081513200299739">客户负责人Email</div></div>
                        <div  class="input-tr-body">
                            <div  class="input-border">
                                <input v-bind:readonly="r_custprsn" type="text" v-model="w_custemail" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr" style="margin-bottom: 10px">
                        <div class="input-tr-title long"><div class="input-title" j-word-label="W2013082814371224775">图纸编号</div></div>
                        <div class="input-tr-body ">
                            <div class="input-border">
                                <div class="yudo-input">$((w_asdrawid))&nbsp;$((w_asdrawnm))</div>
                                <!--<input type="text" readonly="true" v-model="w_order_id" class="read-only yudo-input noborder">-->
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div v-bind:class="must_ascause" class="input-tr-title long"><div class="input-title" j-word-label="W2018062810340442303">发生起点</div></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="icon-xiala select-btn"></div>
                                <select v-model="w_ascause_id"  type="text" class="yudo-input noborder">
                                    <option :value="item.value" v-for="(item,index) in select_startpoint ">$((item.text))</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div v-bind:class="must_asbadtype" class="input-tr-title long"><div class="input-title" j-word-label="W2011030909443598775">不良类型</div></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="icon-xiala select-btn"></div>
                                <select v-model="w_asbadtype_id"  type="text" class="yudo-input noborder">
                                    <option :value="item.value" v-for="(item,index) in select_asbadtype ">$((item.text))</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div v-bind:class="must_asallclass" class=" input-tr-title long"><div class="input-title" j-word-label="W2018062810353978387">原因_区分</div></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="icon-xiala select-btn"></div>
                                <select v-model="w_asallclass_id"  type="text" class="yudo-input noborder" @change="causeDistinctionChange">
                                    <option :value="item.value" v-for="(item,index) in select_ascause ">$((item.text))</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div v-bind:class="must_asdutyclass" class="input-tr-title long"><div class="input-title" j-word-label="W2018062810355432043">AS责任区分</div></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="icon-xiala select-btn"></div>
                                <select v-model="w_asdutyclass_id"  type="text" class="yudo-input noborder">
                                    <option :value="item.value" v-for="(item,index) in select_ascause_c ">$((item.text))</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div v-bind:class="must_asappearance" class="input-tr-title long"><div class="input-title" j-word-label="W2018062810361161368">AS现象</div></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="icon-xiala select-btn"></div>
                                <select v-model="w_asappearance_id"  type="text" class="yudo-input noborder" @change="asAppearanceChange">
                                    <option :value="item.value" v-for="(item,index) in select_asclass1 ">$((item.text))</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div v-bind:class="must_asreasonclass"  class=" input-tr-title long"><div class="input-title" j-word-label="W2018062810362923732">AS原因-种类</div></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="icon-xiala select-btn"></div>
                                <select v-model="w_asreasonclass_id"  type="text" class="yudo-input noborder">
                                    <option :value="item.value" v-for="(item,index) in select_asclass1_c ">$((item.text))</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div v-bind:class="must_asserviceclass" class="input-tr-title long"><div class="input-title" j-word-label="W2018062810365984312">服务地区区分</div></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="icon-xiala select-btn"></div>
                                <select v-model="w_asserviceclass_id"  type="text" class="yudo-input noborder">
                                    <option :value="item.value" v-for="(item,index) in select_area ">$((item.text))</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><div class="input-title" j-word-label="W2018062810372363351">服务地点</div></div>
                        <div  class="input-tr-body">
                            <div  class="input-border" >
                                <input v-bind:readonly="r_custprsn" type="text" v-model="w_asservicearea" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><div class="input-title"  j-word-label="W2018062810373797345">是否移模</div></div>
                        <div  class="input-tr-body flex-right">
                            <div class="mui-switch" id="mySwitch_trans" >
                                <div class="mui-switch-handle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr" v-show="transdom">
                        <div class="input-tr-title long"><div class="input-title" j-word-label="W2018062810374972369">移模部门</div></div>
                        <div  class="input-tr-body">
                            <div  class="input-border" >
                                <input v-on:click="group_query_open()"  type="text" readonly="true" v-model="w_transgroup" class="read-only yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><div class="input-title"  j-word-label="W2018071009351100377">确定</div></div>
                        <div  class="input-tr-body flex-right">
                            <div class="mui-switch" id="mySwitch_confirm" >
                                <div class="mui-switch-handle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><div class="input-title"  j-word-label="W2018062810383100024">收费是否区分</div></div>
                        <div  class="input-tr-body flex-right">
                            <div class="mui-switch" id="mySwitch_chargeYn" >
                                <div class="mui-switch-handle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><div class="input-title"  j-word-label="W2018062810384422313">部品返回与否</div></div>
                        <div  class="input-tr-body flex-right">
                            <div class="mui-switch" id="mySwitch_itemReturn" >
                                <div class="mui-switch-handle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><div class="input-title"  j-word-label="W2018062810381595041">有无接受</div></div>
                        <div  class="input-tr-body">
                            <div v-html="$options.filters.mf_aspower(s_apt)" ></div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><div class="input-title"  j-word-label="W2018062810385770331">是否完成生产</div></div>
                        <div  class="input-tr-body">
                            <div v-html="$options.filters.mf_aspower(s_product)"></div>
                        </div>
                    </div>
                    <div class="title" j-word-label="W2018071013095279028">系统信息</div>
                    <!--<div class="sub_title" j-word-label="W2018071013095279028">系统信息</div>-->
                    <div class="input-tr">
                        <div v-bind:class="must_supplyscope" class=" input-tr-title long">SupplyScope</div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="icon-xiala select-btn"></div>
                                <select v-model="w_supplyscope_id"  type="text" class="yudo-input noborder" @change="supplyscopeChange">
                                    <option :value="item.value" v-for="(item,index) in select_supplyscope ">$((item.text))</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div v-bind:class="must_hrs"class=" input-tr-title long">HRS</div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="icon-xiala select-btn"></div>
                                <select v-model="w_hrs_id"  type="text" class="yudo-input noborder" @change="hrsChange">
                                    <option :value="item.value" v-for="(item,index) in select_supplyscope_c1 ">$((item.text))</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div v-bind:class="must_manifoldtype" class=" input-tr-title long">Manifold Type</div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="icon-xiala select-btn"></div>
                                <select v-model="w_manifoldtype_id"  type="text" class="yudo-input noborder" @change="manifoldTypeChange">
                                    <option :value="item.value" v-for="(item,index) in select_supplyscope_c2 ">$((item.text))</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div v-bind:class="must_systemsize" class=" input-tr-title long">systemsize</div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="icon-xiala select-btn"></div>
                                <select v-model="w_systemsize_id"  type="text" class="yudo-input noborder" @change="systemSizeChange">
                                    <option :value="item.value" v-for="(item,index) in select_supplyscope_c3 ">$((item.text))</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div v-bind:class="must_systemsize" class=" input-tr-title long">systemtype</div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="icon-xiala select-btn"></div>
                                <select v-model="w_systemtype_id"  type="text" class="yudo-input noborder" @change="systemTypeChange">
                                    <option :value="item.value" v-for="(item,index) in select_supplyscope_c4 ">$((item.text))</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div v-bind:class="must_gatetype" class=" input-tr-title long">gatetype</div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="icon-xiala select-btn"></div>
                                <select v-model="w_gatetype_id"  type="text" class="yudo-input noborder" >
                                    <option :value="item.value" v-for="(item,index) in select_supplyscope_c5 ">$((item.text))</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div v-bind:class="must_cust_produce_name" class="input-tr-title long"><div class="input-title" j-word-label="W2018062810394954779">客户产品名称</div></div>
                        <div  class="input-tr-body">
                            <div  class="input-border" >
                                <input v-bind:readonly="r_cust_produce_name" type="text" v-model="w_cust_produce_name" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div v-bind:class="must_asplastic" class="input-tr-title long"><div class="input-title" j-word-label="W2018062810400728768">塑胶</div></div>
                        <div  class="input-tr-body">
                            <div  class="input-border" >
                                <input v-bind:readonly="r_asplastic" type="text" v-model="w_asplastic" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div v-bind:class="must_Gate_counts" class="input-tr-title long"><div class="input-title" j-word-label="W2018062810404378386">Gate数量</div></div>
                        <div  class="input-tr-body">
                            <div  class="input-border" >
                                <input v-model="w_Gate_counts" type="text" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr" style="margin-bottom: 10px">
                        <div v-bind:class="must_markets" class="input-tr-title long">Markets</div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="icon-xiala select-btn"></div>
                                <select v-model="w_markets_id"  type="text" class="yudo-input noborder" >
                                    <option :value="item.value" v-for="(item,index) in select_markets ">$((item.text))</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="title" j-word-label="W2018062810411615366">详细说明</div>
                    <div class="input-tr" style="margin-bottom: 10px">
                        <div v-bind:class="must_text1" class="input-tr-title-textarea long"><span j-word-label="W2018062810434922701">AS现状说明</span></div>
                        <div class="input-tr-body">
                            <div class="input-border-textarea">
                                <textarea type="text"  v-bind:readonly="r_text1" v-model="w_text1" class="yudo-textarea noborder"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr" style="margin-bottom: 10px">
                        <div v-bind:class="must_text2" class="input-tr-title-textarea long"><span j-word-label="W2018062810441287373">原因分析</span></div>
                        <div class="input-tr-body">
                            <div class="input-border-textarea">
                                <textarea type="text"  v-bind:readonly="r_text2" v-model="w_text2" class="yudo-textarea noborder"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr" style="margin-bottom: 10px">
                        <div v-bind:class="must_text3" class="input-tr-title-textarea long"><span j-word-label="W2018062810445845052">改善建议及方案</span></div>
                        <div class="input-tr-body">
                            <div class="input-border-textarea">
                                <textarea type="text"  v-bind:readonly="r_text3" v-model="w_text3" class="yudo-textarea noborder"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr" style="margin-bottom: 10px">
                        <div class="input-tr-title-textarea long"><span j-word-label="W2018041913225420017">备注</span></div>
                        <div class="input-tr-body">
                            <div class="input-border-textarea">
                                <textarea type="text"  v-bind:readonly="r_text4" v-model="w_text4" class="yudo-textarea noborder"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="title" j-word-label="W2018062810453192374">品目信息</div>
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
                    <div class="title flex-left">
                        <div class="len-5" j-word-label="W2018070509524326082">品目信息录入</div>
                        <div class="len-5 flex-right">
                            <div class="mui-icon mui-icon-plus" @click="astable_minute_open('add')" id="opensales"></div>
                        </div>
                    </div>
                    <div  style="overflow: auto; height: 200px;padding-bottom: 50px">
                        <ul id="OA_task_1" class="mui-table-view" style="text-align: left">
                            <li class="mui-table-view-cell mui-transitioning" v-for="(item,index) in astablelist">
                                <div class="mui-slider-right mui-disabled">
                                    <a class="mui-btn mui-btn-red" style="transform: translate(0px, 0px);" j-word-label="W2007083018132610775" v-on:click="del_astable(index,$event)" >删除</a>
                                </div>
                                <div class="mui-slider-handle" style="transform: translate(0px, 0px);" v-on:click="astable_minute_open(index)">
                                    <a class="mui-navigate-right yudo-label label-primary">$((item.Sort))</a>
                                    <a class="mui-navigate-right" style="color: #545454">$((item.ItemNm))</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="save-pro">
                <div class="save-pro-body flex-center">
                    <div v-on:click="save_as()" class="yudo-btn" >$((langCode.msgSave))</div>
                </div>
            </div>
        </div>
    </div>
    <div v-if="view.showAddAsHandle" style="z-index: 102" class="yudo-window-trans animated fadeInRight trans-1">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn"  v-on:click="view.showAddAsHandle = false">
                    <div class="left-icon icon-back-2"></div>
                </div>
                <div class="header-center-btn" CHN="AS处理录入">$((langCode.addAsProc))</div>
                <div class="header-right-btn">
                </div>
            </div>
        </div>
        <div class="center-ios" style="background-color: white;padding-bottom: 50px">
            <div class="yudo-scroll">
                <div class="area">
                    <div CHN="基本信息" class="title">$((langCode.defaultInfo))</div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span CHN="AS处理编号">$((langCode.asProcM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input readonly="true"  type="text" class="read-only yudo-input noborder" v-model="write.asHandle.ASNo">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long color-red"><span CHN="AS处理日期">$((langCode.asProcDateM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div @click="getDate('ASDate','write','asHandle')"  type="text" class="yudo-input noborder">$((write.asHandle.ASDate | date))</div>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span CHN="AS接收编号">$((langCode.asNo))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input readonly="true"  type="text" class="read-only yudo-input noborder" v-model="write.asHandle.ASRecvNo">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span CHN="AS区分">$((langCode.view_asClass))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <select v-model="write.asHandle.ASType" :disabled="true" type="text" class="read-only yudo-input noborder screen-pro">
                                    <option :value="item.value" v-for="(item,index) in select_asclass">$((item.text))</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span CHN="订单号码">$((langCode.orderNo))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input readonly="true"  type="text" class="read-only yudo-input noborder" v-model="write.asHandle.orderNo">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span CHN="出口区分">$((langCode.expClass))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input readonly="true"  type="text" class="read-only yudo-input noborder" v-model="write.asHandle.ExpClss">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long color-red"><span CHN="负责人">$((langCode.pronM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-tr-body">
                                <div class="input-border">
                                    <div class="pop-modal-power"><span class="mui-icon mui-icon-more"></span></div>
                                    <input type="text" readonly="true" @click="showAsHandleEmpy()" v-model="write.asHandle.DeptNm" class="read-only yudo-input noborder">
                                </div>
                            </div>
                            <div class="input-tr-body" style="margin-left: 10px">
                                <div class="input-border">
                                    <div class="pop-modal-power"><span class="mui-icon mui-icon-more"></span></div>
                                    <input type="text" readonly="true" @click="showAsHandleEmpy()" v-model="write.asHandle.EmpNm"  class="read-only yudo-input noborder">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span CHN="技术规范编号">$((langCode.specId))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="read-only yudo-input noborder" ccc="showAsHandleSpec">$((write.asHandle.SpecNo))</div>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long color-red"><span CHN="客户名称">$((langCode.custNm))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="pop-modal-power"><span class="mui-icon mui-icon-more"></span></div>
                                <input type="text" readonly="true" v-model="write.asHandle.CustNm" class="read-only yudo-input noborder" @click="showAsHandleCust" ></input>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr-end">
                        <div class="input-tr-title long"><span CHN="图纸编号">$((langCode.drawNo))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="read-only yudo-input noborder" >$((write.asHandle.DrawNo))&nbsp;$((write.asHandle.DrawAmd))</div>
                            </div>
                        </div>
                    </div>
                    <div CHN="AS处理信息" class="title">$((langCode.asProcInfoM))</div>
                    <div class="input-tr">
                        <div class="input-tr-title long color-red"><span CHN="AS类型">$((langCode.asTypeM))</span></div>
                        <div class="input-border">
                            <div class="icon-xiala select-btn"></div>
                            <select v-model="write.asHandle.ASKind" :disabled="view.asHandleCfm" type="text" class="yudo-input noborder screen-pro">
                                <option :value="item.value" v-for="(item,index) in list.asHandle.ASKindList">$((item.text))</option>
                            </select>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long color-red"><span CHN="AS处理分类">$((langCode.asProcClassM))</span></div>
                        <div class="input-border">
                            <div class="icon-xiala select-btn"></div>
                            <select v-model="write.asHandle.ASProcKind" :disabled="view.asHandleCfm" type="text" class="yudo-input noborder screen-pro">
                                <option :value="item.value" v-for="(item,index) in list.asHandle.ASASProcKindList">$((item.text))</option>
                            </select>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long color-red"><span CHN="AS处理结果">$((langCode.asProcResM))</span></div>
                        <div class="input-border">
                            <div class="icon-xiala select-btn"></div>
                            <select v-model="write.asHandle.ProcResult" :disabled="view.asHandleCfm" type="text" class="yudo-input noborder screen-pro">
                                <option :value="item.value" v-for="(item,index) in list.asHandle.ASProcResultList">$((item.text))</option>
                            </select>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span CHN="所需配件费用">$((langCode.asAmtM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" :readonly="view.asHandleCfm" class="yudo-input noborder" v-model="write.asHandle.ASAmt">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span CHN="修理费">$((langCode.asRepairAmtM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" :readonly="view.asHandleCfm"  class="yudo-input noborder" v-model="write.asHandle.ASRepairAmt">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long color-red"><span CHN="服务地区区分">$((langCode.asAreaGubun))</span></div>
                        <div class="input-border">
                            <div class="icon-xiala select-btn"></div>
                            <select v-model="write.asHandle.ASAreaGubun" :disabled="view.asHandleCfm" type="text" class="yudo-input noborder screen-pro">
                                <option :value="item.value" v-for="(item,index) in select_area">$((item.text))</option>
                            </select>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span CHN="服务地点">$((langCode.asServiceArea))</span></div>
                        <div class="input-border">
                            <input type="text" :readonly="view.asHandleCfm" class=" yudo-input noborder" v-model="write.asHandle.ASArea">
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span CHN="部品返回与否">$((langCode.view_itemReturn))</span></div>
                        <div class="input-tr-body">
                            <div class="mui-switch" id="itemReturnYn" >
                                <div class="mui-switch-handle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long color-red"><span CHN="部品返还区分">$((langCode.itemReturnGubunM))</span></div>
                        <div class="input-border">
                            <div class="icon-xiala select-btn"></div>
                            <select v-model="write.asHandle.ItemReturnGubun" :disabled="view.asHandleCfm" type="text" class="yudo-input noborder screen-pro">
                                <option :value="item.value" v-for="(item,index) in list.asHandle.itemReturnList">$((item.text))</option>
                            </select>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span CHN="收费与否">$((langCode.view_chargeYn))</span></div>
                        <div class="input-tr-body">
                            <div class="mui-switch" id="chargeYn" >
                                <div class="mui-switch-handle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr-end">
                        <div class="input-tr-title long"><span CHN="确定">$((langCode.confirm))</span></div>
                        <div class="input-tr-body">
                            <div class="mui-switch" id="cfmYn" >
                                <div class="mui-switch-handle"></div>
                            </div>
                        </div>
                    </div>
                    <div CHN="其他信息" class="title">$((langCode.otherInfoM))</div>
                    <div class="input-tr">
                        <div class="input-tr-title-textarea long"><span CHN="AS处理详情">$((langCode. asNoteM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border-textarea">
                                <textarea type="text" :readonly="view.asHandleCfm" v-model="write.asHandle.ASNote" class="yudo-textarea noborder"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title-textarea long"><span CHN="AS处理结果_原因">$((langCode.asProcResultReasonM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border-textarea">
                                <textarea type="text" :readonly="view.asHandleCfm" v-model="write.asHandle.ProcResultReason" class="yudo-textarea noborder"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title-textarea long"><span CHN="客户意见">$((langCode.custOpinionM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border-textarea">
                                <textarea type="text" :readonly="view.asHandleCfm" v-model="write.asHandle.CustOpinion" class="yudo-textarea noborder"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title-textarea long"><span CHN="备注">$((langCode.remark))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border-textarea">
                                <textarea type="text" :readonly="view.asHandleCfm" v-model="write.asHandle.Remark" class="yudo-textarea noborder"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span CHN="经办人">$((langCode.procPersonM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input  type="text" :readonly="view.asHandleCfm" class="yudo-input noborder" v-model="write.asHandle.ProcPerson">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span CHN="行驶里程">$((langCode.transLineM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input   type="text" :readonly="view.asHandleCfm" class="yudo-input noborder" v-model="write.asHandle.TransLine">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span CHN="抵达时间">$((langCode.arrivalTimeM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div @click="getDateM('ArrivalTime','write','asHandle')" class="yudo-input noborder">$((write.asHandle.ArrivalTime))</div>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr-end">
                        <div class="input-tr-title long"><span CHN="离开时间">$((langCode.leaveTimeM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div @click="getDateM('StartTime','write','asHandle')"  class="yudo-input noborder">$((write.asHandle.StartTime))</div>
                            </div>
                        </div>
                    </div>

                    <div class="title flex-left">
                        <div class="len-3" CHN="品目信息">$((langCode.itemInfoM))</div>
                        <div class="len-7 flex-right">
                            <div class="mui-icon mui-icon-plus" @click="addAsHandleItem()"></div>
                        </div>
                    </div>
                    <div class="cell-tr">
                        <ul class="mui-table-view" style="text-align: left;">
                            <li class="mui-table-view-cell" v-for="(item,index) in list.asHandle.itemList" >
                                <div class="mui-slider-right mui-disabled">
                                    <a class="mui-btn mui-btn-red" style="transform: translate(0px, 0px);" v-on:click="delAsHandleItem(index,$event)" >Delete</a>
                                </div>
                                <div class="mui-slider-handle flex-left" style="transform: translate(0px, 0px);"  @click="showAsHandleItem(index)">
                                    <div class="yudo-label label-primary">$((index+1))</div>
                                    &nbsp;&nbsp;
                                    <div style="padding-right: 15px;width: 90%" class="long">$((item.ItemNm))</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="save-pro">
                <div class="save-pro-body flex-center">
                    <div v-on:click="setAsHandleInfo()" class="yudo-btn" >$((langCode.msgSave))</div>
                </div>
            </div>
        </div>
    </div>
    <div v-if="view.showQueryAsHandle" style="z-index: 101" class="yudo-window-trans animated fadeInRight trans-1">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn"  v-on:click="view.showQueryAsHandle = false">
                    <div class="left-icon icon-back-2"></div>
                </div>
                <div class="header-center-btn" CHN="AS处理查询">$((langCode.searchAsProc))</div>
                <div class="header-right-btn">
<!--                    <div class="right-icon icon-extend"></div>-->
                </div>
            </div>
        </div>
        <div class="center-ios" style="background-color: white">
            <div class="screen" style="padding: 5px 5px">
                <div class="screen-power flex-left"  @click="view.asHandleScreen = !view.asHandleScreen" >
                    <div class="text">$((langCode.screen))</div>
                    <div class="icon-xiala screen-power-select"></div>
                </div>
                <div class="input-border" style="margin-right: 5px;">
                    <input type="text"  :placeholder="langCode.asProcM"   v-model="input.asHandle.asHandleNo" class="yudo-input noborder">
                </div>
                <div style="flex-shrink: 1;width: 60px;height: 38px">
                    <button class="yudo-btn-white screen-pro"   v-on:click="searchAsHandle()"  style="flex-shrink: 1;width: 60px;font-size:15px">$((langCode.search))</button>
                </div>
                <div class="heng-line screen-pro"></div>
            </div>
            <div class="screen-body" v-show="view.asHandleScreen">
                <div class="screen-body-pro">
                    <div class="flex-left input" >
                        <div j-word-label="W2018041913134073778" style="width: 30%" class="screen-pro">$((langCode.custNm))</div>
                        <div class="input-border" style="margin-right: 5px">
                            <input type="text" v-model="input.asHandle.custNm"  class="yudo-input noborder screen-pro">
                        </div>
                    </div>
                    <div class="flex-left input">
                        <div style="width: 30%" class="screen-pro">$((langCode.date))</div>
                        <div class="flex-left" style="width: 100%">
                            <div class="input-border" style="margin-right: 5px">
                                <input @click="getDate('asHandleStartDate','input','asHandle')" readonly="true"  v-model="input.asHandle.asHandleStartDate" type="text"   class="yudo-input noborder screen-pro">
                            </div>
                            <div class="input-border" style="margin-right: 5px">
                                <input @click="getDate('asHandleEndDate','input','asHandle')" readonly="true"  v-model="input.asHandle.asHandleEndDate" type="text"  class="yudo-input noborder screen-pro">
                            </div>
                        </div>
                    </div>
                    <div class="screen-body-submit flex">
                        <button class="yudo-btn-default clear" @click="asHandleScreenClear()">$((langCode.roback))</button>
                        <button class="yudo-btn-default submit" @click="asHandleScreenCnf()">$((langCode.confirm))</button>
                    </div>
                </div>
                <div class="screen-body-bottom" @click="view.asHandleScreen = !view.asHandleScreen"></div>
            </div>
            <div class="info-minute scroll" style="top:100px;">
                <div class="minute-project">
                    <div class="minute-list" style="border-bottom: 5px solid #f9f9f9;" v-for="(item,index) in list.asHandle.asHandleList" @click="chooseAsHandle(index)">
                        <div class="minute-body" style="height: 115px">
                            <div class="tr flex-left">
                                <div CHN="AS处理编号" class="title len-5">$((langCode.asProcM)):$((item.ASNo))</div>
                                <div CHN="AS处理结果" class="font-right  len-5">$((langCode.asProcResM)):<span v-html="$options.filters.procResultViewChange(item.ProcResult,item.ProcResultNm)"></span></div>
                            </div>
                            <div class="tr flex-left">
                                <div CHN="AS处理时间" class="len-5 long">$((langCode.asProcDateM)):$((item.ASDate | date))</div>
                                <div CHN="确定与否" class="font-right len-5">$((langCode.confirm)):<span v-html="$options.filters.confirmChange(item.CfmYn)"></span></div>
                            </div>
                            <div class="tr flex-left">
                                <div CHN="订单号码" class="len-5 long">$((langCode.orderNo)):$((item.OrderNo))</div>
                                <div CHN="负责人" class="font-right len-5 long">$((langCode.pronM)):$((item.DeptNm)) $((item.EmpNm))</div>
                            </div>
                            <div class="tr flex-left">
                                <div CHN="客户名称" class="len-10 long">$((langCode.custNm)):$((item.CustNm))</div>
                            </div>
                            <div class="tr flex-left">
                                <div CHN="AS接受编号" class="len-5 long">$((langCode.asNo)):$((item.ASRecvNo))</div>
                                <div CHN="模号" class="font-right len-5 long">$((langCode.RefNo)):$((item.RefNo))</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="view.noData" class="nodata" >$((langCode.noData))</div>
                <div v-if="view.pullMore" class="pull-more" @click="pullAsHandelMore" >$((langCode.pullMore))</div>
            </div>
        </div>
    </div>
    <div v-if="view.showAsHandleItem" style="z-index: 102" class="yudo-window-trans animated fadeInRight trans-1">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn"  v-on:click="view.showAsHandleItem = false">
                    <div class="left-icon icon-back-2"></div>
                </div>
                <div class="header-center-btn" CHN="品目信息">$((langCode.itemInfoM))</div>
                <div class="header-right-btn">
                </div>
            </div>
        </div>
        <div class="center-ios" style="background-color: white;padding-bottom: 50px">
            <div class="yudo-scroll">
                <div class="area">
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>No</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input readonly="true"  type="text" class="read-only yudo-input noborder" v-model="write.asHandleItem.ASSerl" />
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span CHN="品目编码">$((langCode.itemNo))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="pop-modal-power"><span class="mui-icon mui-icon-more"></span></div>
                                <input readonly="true" type="text" class="read-only yudo-input noborder"  v-model="write.asHandleItem.ItemNo" @click="showQueryAsHandleItem()" />
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span CHN="品目名称">$((langCode.catalogueName))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border long">
                                <div class="pop-modal-power"><span class="mui-icon mui-icon-more"></span></div>
                                <input readonly="true" type="text" class="read-only yudo-input noborder" v-model="write.asHandleItem.ItemNm" @click="showQueryAsHandleItem()" />
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span CHN="规格">$((langCode.spec))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input readonly="true" type="text" class="read-only yudo-input noborder"  v-model="write.asHandleItem.Spec" />
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span CHN="数量">$((langCode.number))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input :readonly="view.asHandleCfm" type="number" v-on:input="itemQtyChange()" v-model="write.asHandleItem.Qty" class="yudo-input noborder" />
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span CHN="单位">$((langCode.unitNm))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="icon-xiala select-btn"></div>
                                <select v-model="write.asHandleItem.UnitCd" :disabled="view.asHandleCfm" type="text" class="yudo-input noborder">
                                    <option :value="item.value"  v-for="(item,index) in list.asHandle.unitList">$((item.text))</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span CHN="单价">$((langCode.priceM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input :readonly="view.asHandleCfm"  type="text" v-on:input="itemStdPriceChange()" v-model="write.asHandleItem.StdPrice" class="yudo-input noborder" />
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span CHN="金额">$((langCode.moneyM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input readonly="true" type="text" v-model="write.asHandleItem.Amt" class="read-only yudo-input noborder" />
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span CHN="修理费">$((langCode.asRepairAmtM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input :readonly="view.asHandleCfm" type="number" v-model="write.asHandleItem.ASRepairAmt" class="yudo-input noborder" />
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span CHN="收费与否">$((langCode.view_chargeYn))</span></div>
                        <div class="input-tr-body">
                            <div class="mui-switch" id="itemChargeYn" >
                                <div class="mui-switch-handle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span CHN="再使用与否">$((langCode.itemUseYnM))</span></div>
                        <div class="input-tr-body">
                            <div class="mui-switch" id="itemUseYn" >
                                <div class="mui-switch-handle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span CHN="备注">$((langCode.remark))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" :readonly="view.asHandleCfm" @model="write.asHandleItem.Remark" class="yudo-input noborder" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="save-pro">
                <div class="save-pro-body flex-center">
                    <div v-on:click="setAsHandleItem()" class="yudo-btn" >$((langCode.msgSave))</div>
                </div>
            </div>
        </div>
    </div>
    <div v-show="find_grouplist_show"  style="z-index: 102;" class="yudo-window-trans animated fadeInRight trans-1">
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
            <div class="search_area" style="position: absolute;top: 50px;border-bottom: 1px solid #e7e7e7">
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
            <div class="info-minute scroll" style="top:132px;">
                <div class="minute-project">
                    <div class="minute-list" style="border-bottom: 5px solid #f9f9f9;" v-for="(item,index) in grouplist" v-on:click="set_group(index)">
                        <div class="minute-body" style="height: 55px">
                            <div class="tr">
                                <div class="title len-10 long">$((langCode.deptNm)):$((item.DeptNm))</div>
                            </div>
                            <div class="tr">
                                <div class="len-10 long">$((langCode.deptCd)):$((item.DeptCd))</div>
                            </div>
                        </div>
                    </div>
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
    <div v-show="astable_minute_show" v-bind:style="style_astable_minute"  style="z-index: 102;" class="yudo-window">
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
        <div class="center-ios" style="background-color: white;">
            <div class="yudo-scroll">
                <div class="area">
                    <div class="input-tr">
                        <div class="input-tr-title long"><div class="input-title" >NO</div></div>
                        <div  class="input-tr-body">
                            <div  class="input-border" >
                                <input readonly="readonly" type="text" v-model="w_astable_Sort" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long th-red" ><span j-word-label="W2018062810504422036">品目编码</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="pop-modal-power"><span class="mui-icon mui-icon-more"></span></div>
                                <input readonly="true" type="text" class="read-only yudo-input noborder"  v-model="w_astable_ItemNo" @click="astableid_query_open()" />
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long th-red"><span j-word-label="W2018062810511435013">品目名称</span></div>
                        <div class="input-tr-body">
                            <div class="input-border long">
                                <div class="pop-modal-power"><span class="mui-icon mui-icon-more"></span></div>
                                <input readonly="true" type="text" class="read-only yudo-input noborder" v-model="w_astable_ItemNm"  @click="astableid_query_open()" />
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span j-word-label="W2018062810520860062">规格</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input readonly="true" type="text" class="read-only yudo-input noborder" v-model="w_astable_Spec" />
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>SPARE</span></div>
                        <div class="input-tr-body">
                            <div class="mui-switch" id="mySwitch_table_spare" >
                                <div class="mui-switch-handle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long th-red"><span  j-word-label="W2018071013040628794">单位</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="icon-xiala select-btn"></div>
                                <select v-model="w_astable_UnitId" type="text" class="yudo-input noborder">
                                    <option :value="item.value"  v-for="(item,index) in select_unit">$((item.text))</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>数量</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input v-bind:readonly="r_text1" type="number" v-model="w_astable_Qty" class="yudo-input noborder" />
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span j-word-label="W2018071009324085701">收费与否</span></div>
                        <div class="input-tr-body">
                            <div class="mui-switch" id="mySwitch_table_char" >
                                <div class="mui-switch-handle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span j-word-label="W2018062810551330316">现库存</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="number" readonly="true" v-model="w_astable_PreStockQty" class="read-only yudo-input noborder" />
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span j-word-label="W2018062810554066393">进行数量</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="number" readonly="true" v-model="w_astable_NextQty" class="read-only yudo-input noborder" />
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span j-word-label="W2018062810561010011">暂停数量</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="number" readonly="true" v-model="w_astable_StopQty" class="read-only yudo-input noborder" />
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span j-word-label="W2018041913225420017">备注</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input  v-bind:readonly="r_text1" type="number" v-model="w_astable_Remark" class="yudo-input noborder" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="save-pro">
                <div class="save-pro-body flex-center">
                    <div id="item_save"  @click="save_astable()" class="yudo-btn" >$((langCode.msgSave))</div>
                </div>
            </div>
        </div>
    </div>
    <div v-if="showAsRate" style="z-index: 103;" class="yudo-window">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" @click="showAsRate = !showAsRate">
                    <div class="left-icon icon-back-2"></div>
                </div>
                <div class="header-center-btn">$((langCode.asRate))</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="center-ios">
            <div class="area">
                <div class="title">$((langCode.rateStep))</div>
                <div class="stepCont"  style="overflow: hidden;">
                    <div class="ystep-container ystep-lg ystep-blue flex-center" style="left: -1px;"></div>
                </div>
                <div class="title flex-left">$((langCode.defaultInfo))</div>
                <div class="input-tr">
                    <div class="input-tr-title long"><div class="input-title" >$((langCode.asNo))</div></div>
                    <div  class="input-tr-body flex-left">
                        <div class="input-border">
                            <div class="yudo-span">$((asRate.SourceNo))</div>
                        </div>
                        <!--<div class="text-border" style="padding: 0 0 0 10px;width: 100px;flex-shrink: 1">-->
                            <!--<span style="font-size: 14px;padding: 8px 5px" class="yudo-label label-primary">AS订单</span>-->
                        <!--</div>-->
                    </div>
                </div>
                <div class="input-tr">
                    <div class="input-tr-title long"><div class="input-title" >$((langCode.custNm))</div></div>
                    <div  class="input-tr-body flex-left">
                        <div class="input-border">
                            <input type="text" readonly="true" v-model="asRate.CustNm" class="yudo-input noborder">
                        </div>
                    </div>
                </div>
                <div class="input-tr">
                    <div class="input-tr-title long"><div class="input-title" >$((langCode.asDelvDate))</div></div>
                    <div  class="input-tr-body flex-left">
                        <div class="input-border long">
                            <div class="yudo-span">$((asRate.ASRecvDate | date))</div>
                        </div>
                    </div>
                </div>
                <div class="input-tr">
                    <div class="input-tr-title long"><div class="input-title" >$((langCode.delvDate))</div></div>
                    <div  class="input-tr-body flex-left">
                        <div class="input-border long">
                            <div class="yudo-span">$((asRate.DelvDate | date))</div>
                        </div>
                    </div>
                </div>
                <div class="input-tr" style="margin-bottom: 10px">
                    <div class="input-tr-title long"><div class="input-title" >$((langCode.productStatus))</div></div>
                    <div  class="input-tr-body ">
                        <div class="yudo-span">
                            <span style="font-size: 14px;padding: 5px 10px" class="yudo-label label-primary">$((asRate.ProductStatus | productStatusChangeM)) </span>
                        </div>
                    </div>
                </div>
                <div class="input-tr">
                    <div class="input-tr-title long"><span>$((langCode.pronM))</span></div>
                    <div class="input-tr-body">
                        <div class="input-border">
                            <input type="text" readonly="true" v-model="asRate.DeptNm" class="yudo-input noborder">
                        </div>
                    </div>
                    <div class="input-tr-body" style="margin-left: 10px">
                        <div class="input-border">
                            <input type="text" readonly="true" v-model="asRate.EmpNm" class="yudo-input noborder">
                        </div>
                    </div>
                </div>
                <div class="input-tr" style="margin-bottom: 10px">
                    <div class="input-tr-title long"><div class="input-title" >$((langCode.RefNo))</div></div>
                    <div  class="input-tr-body flex-left">
                        <div class="input-border long">
                            <div class="yudo-span">$((asRate.RefNo))</div>
                        </div>
                    </div>
                </div>
                <div class="title flex-left">$((langCode.productInfo))</div>
                <div class="input-tr" >
                    <div class="input-tr-title long"><div class="input-title" >$((langCode.WPlanDateM))</div></div>
                    <div  class="input-tr-body ">
                        <div class="input-border">
                            <div class="yudo-span">$((asRate.WkAptDate | dateHi))</div>
                        </div>
                    </div>
                </div>
                <div class="input-tr">
                    <div class="input-tr-title long"><div class="input-title" >$((langCode.WCDelvDateM2))</div></div>
                    <div  class="input-tr-body ">
                        <div class="input-border">
                            <div class="yudo-span">$((asRate.WPlanCfmDate | dateHi))</div>
                        </div>
                    </div>
                </div>
                <div class="input-tr">
                    <div class="input-tr-title long"><div class="input-title" >$((langCode.WDelvDateM))</div></div>
                    <div  class="input-tr-body">
                        <div class="input-border">
                            <div class="yudo-span">$((asRate.WDelvDate | date))</div>
                        </div>
                    </div>
                </div>
                <div class="input-tr" style="margin-bottom: 10px">
                    <div class="input-tr-title long"><div class="input-title" >$((langCode.changeCnt))</div></div>
                    <div  class="input-tr-body flex-left">
                        <div class="yudo-span">
                            <span style="font-size: 14px;padding: 5px 10px" class="yudo-label label-primary">$((asRate.ModifyCnt))</span>
                            <span style="font-size: 14px;padding: 5px 10px" class="yudo-label label-primary-light">$((asRate.WDelvChUptDate))</span>
                        </div>
                    </div>
                </div>

                <div class="title flex-left">$((langCode.deviseInfo))</div>
                <div class="input-tr">
                    <div class="input-tr-title long" style="flex-shrink: 0;"><div class="input-title" >$((langCode.drawNo))</div></div>
                    <div class="input-tr-body">
                        <div class="input-border">
                            <div class="yudo-span">$((asRate.DrawNo))&nbsp;$((asRate.DrawAmd))</div>
                        </div>
                    </div>
                </div>
                <div class="input-tr">
                    <div class="input-tr-title long"><div class="input-title" >$((langCode.drawDelvDate))</div></div>
                    <div class="input-tr-body">
                        <div class="input-border">
                            <div class="yudo-span">$((asRate.DrawAptDate | dateHi))</div>
                        </div>
                    </div>
                </div>
                <div class="input-tr" style="margin-bottom: 10px">
                    <div class="input-tr-title long"><div class="input-title" >$((langCode.OutDateM))</div></div>
                    <div class="input-tr-body">
                        <div class="input-border">
                            <div class="yudo-span">$((asRate.OutDate | dateHi))</div>
                        </div>
                    </div>
                </div>
                <div class="title flex-left">$((langCode.invoiceInfo))</div>
                <div class="input-tr">
                    <div class="input-tr-title long"><div class="input-title" >$((langCode.invoiceNo))</div></div>
                    <div  class="input-tr-body flex-left">
                        <div class="input-border">
                            <div class="yudo-span">$((asRate.InvoiceNo))</div>
                        </div>
                    </div>
                </div>
                <div class="input-tr">
                    <div class="input-tr-title long"><div class="input-title" >$((langCode.invoiceDate))</div></div>
                    <div  class="input-tr-body flex-left">
                        <div class="input-border">
                            <div class="yudo-span">$((asRate.InvoiceDate))</div>
                        </div>
                    </div>
                </div>
                <div class="input-tr">
                    <div class="input-tr-title long"><div class="input-title" >$((langCode.invoiceClass))</div></div>
                    <div  class="input-tr-body flex-left">
                        <div class="yudo-span">
                            <span style="font-size: 14px;padding: 5px 10px" class="yudo-label label-primary">$((asRate.InvoiceTypeNm))</span>
                        </div>
                    </div>
                </div>
                <div class="input-tr">
                    <div class="input-tr-title long"><div class="input-title" >$((langCode.cfmDate))</div></div>
                    <div  class="input-tr-body flex-left">
                        <div class="input-border">
                            <div class="yudo-span">$((asRate.CfmDate))</div>
                        </div>
                    </div>
                </div>
                <div class="input-tr" style="margin-bottom: 10px">
                    <div class="input-tr-title long"><div class="input-title" >$((langCode.colDate))</div></div>
                    <div  class="input-tr-body flex-left">
                        <div class="input-border">
                            <div class="yudo-span">$((asRate.ColDate))</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/js/WEI_2100/WEI_2100_Lists.js?v=<?php $this->print_("WEI_2100Version",$TPL_SCP,1);?>"></script>
<?php $this->print_("popAsRecvModal",$TPL_SCP,1);?>

<?php $this->print_("popOrderModal",$TPL_SCP,1);?>

<?php $this->print_("popItemModal",$TPL_SCP,1);?>

<?php $this->print_("popSpecModal",$TPL_SCP,1);?>

<?php $this->print_("popCustModal",$TPL_SCP,1);?>

<?php $this->print_("popEmpyModal",$TPL_SCP,1);?>

</body>
</html>
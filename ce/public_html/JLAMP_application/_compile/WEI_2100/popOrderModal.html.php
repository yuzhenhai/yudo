<?php /* Template_ 2.2.6 2019/04/23 15:41:38 /home/merp.yudo.com.cn/public_html/JLAMP_application/views/popOrderModal.html 000008794 */ ?>
<template id="popOrderModal">
    <div v-if="view.showPopOrder"  style="z-index: 2;" class="yudo-window">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" @click="view.showPopOrder = false" >
                    <div class="left-icon icon-back-2"></div>
                </div>
                <div class="header-center-btn" >$((lang.queryOrder))</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="center-ios">
            <div class="search_area" style="position: absolute;top: 50px;border-bottom: 1px solid #e7e7e7">
                <table class="search_table" style="width: 100%;height: 81px;padding-top: 10px">
                    <tr>
                        <th>$((lang.orderNo))</th>
                        <td colspan="1">
                            <input type="text"  name="fastclick" class="multi-find-windows search_input" v-model='model.popOrderNo'>
                        </td>
                        <td>
                            <img src="/image/qrcode.png" @click="qrcode()" width="29">
                        </td>
                        <td>
                            <button class="button-2000" @click="getOrder()" style="font-size:15px">$((lang.search))</button>
                        </td>
                    </tr>
                    <tr>
                        <th>$((lang.custNm))</th>
                        <td colspan="2">
                            <input type="text"  name="fastclick" class="multi-find-windows search_input" v-model='model.popOrderCustNm'>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="mui_pushorder" class="info-minute scroll" style="top:132px;">
                <div class="minute-project">
                    <div class="minute-list" style="border-bottom: 5px solid #f9f9f9;" v-for="(item,index) in orderlist" @click="chooseOrder(index)">
                        <div class="minute-body" style="height: 95px">
                            <div class="tr">
                                <div class="title">$((lang.orderNo)):$((item.OrderNo))</div>
                            </div>
                            <div class="tr">
                                <div class="len-10 long">$((lang.custNm)):$((item.custname))</div>
                            </div>
                            <div class="tr">
                                <div class="len-5 long left-text ">$((lang.orderDate)):<span>$((item.OrderDate.fixed(2)))</span></div>
                                <div class="right-text">$((lang.empNm)):$((item.EmpNm))</div>
                            </div>
                            <div class="tr">
                                <div class="len-5 long left-text ">$((langCode.delvDate)):<span>$((item.DelvDate.fixed(2)))</span></div>
                                <div class="right-text">$((lang.deptNm)):$((item.DeptNm))</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layui-flow-more" v-show="loading">
                    <i class="layui-anim layui-anim-rotate layui-anim-loop layui-icon layui-icon-loading-1" style="font-size: 25px">
                    </i>
                    <div class="doc-icon-name">loading</div>
                </div>
                <div class="layui-flow-more" v-show="noData">$((lang.noData))</div>
            </div>
        </div>
    </div>
</template>
<script>
    var popOrderModal = new Vue({
        el:'#popOrderModal',
        delimiters: ['$((', '))'],
        data: {
            view: {
                pageCnt:0,
                showPopOrder: false,
                loading:false,
                noData:true,
            },
            lang:{

            },
            model: {
                popOrderNo: '',
                popOrderCustNm: '',
            },
            list: {
                orderlist: [],
            },
        },
        //过滤器
        filters:{

        },
        create(){
            langCode.method = 'cache';
            langCode.getWord({
                search:'W2018020109095825029',
                noData:'W2018062810475725084',
                queryOrder:'W2018041913332473096',
                orderNo:'W2018041913141737708',//订单号码
                custNm:'W2018041913134073778',//客户名称
                custCd:'W2018062810473444353',//客户编号
                orderDate:'W2018041913163666042',//订单日期
                empNm:'W2018041913373764065',//职员名称
                empId:'W2018041913385580778',//员工工号
                delvDate:'W2018062810315076351',//交货日期
                deptNm:'W2018041913371894064',//部门名称
                deptCd:'W2018041913392311092',
                date:'W2018082712533876756',
                screen:'W2019041817352089305',//筛选
            },this.lang);
        },
        mounted(){
        },
        method:{
            showPopOrderModal:function () {
                this.view.showPopOrder = true;
                this.list.orderlist = [];
            },
            qrcode:function(){
                if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
                    location.href = 'jmobile://getQRcode';
                }
                if(JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.Android)
                {
                    if(window.JMobile) window.JMobile.getQRcode();
                }
            },
            getOrder:function(){
                this.view.loading = false;
                this.view.noData = false;
                this.view.pageCnt = 0;
                mui.showLoading('loading...',title);
                var params = {}
                params.orderid = this.model.popOrderNo;
                params.orderby = this.model.popOrderCustNm;
                params.ordercount = 0;
                http.get('/WEI_2100/order_prc',params,this.disPlayOrder());
            },
            //渲染订单列表
            disPlayOrder:function(res){
                mui.hideLoading()
                if (res.returnCode == 'NULL') {
                    popOrderModal.list.orderlist = [];
                    popOrderModal.view.loading = false;
                    popOrderModal.view.noData = true;
                    return false;
                }
                var list = res.data[0];
                var nodata = 0;
                //递增加载
                if(this.view.pageCnt > 0){
                    for(var i = 0;i<50;i++){
                        if(list[i] == null || list[i].length <= 0)
                        {
                            nodata = 1;
                            break;
                        } else {
                            this.list.orderlist.push(list[i]);
                        }
                    }
                    if(nodata == 1){
                        this.view.loading = false;
                        this.view.noData = true;
                    } else {
                        this.view.loading  = true;
                    }
                }
                //首次渲染
                else {
                    this.orderlist = list;
                    if(list.length < 50){
                        this.view.loading = false;
                        this.view.noData = true;
                    } else {
                        this.view.loading = true;
                        this.view.noData = false;
                    }
                }
            },

        }
    });
    jq('#mui_pushorder').scroll(function(){
        var bottom = document.getElementById('mui_pushorder').scrollHeight - document.getElementById('mui_pushorder').clientHeight - jq('#mui_pushorder').scrollTop();
        if(bottom == 0 && popOrderModal.orderlist.length > 0){
            popOrderModal.global_order_num = popOrderModal.global_order_num+50;
            var params = new Object();
            params.orderid = popOrderModal.model.popOrderNo;
            params.orderby = popOrderModal.model.popOrderCustNm;
            params.ordercount = popOrderModal.view.pageCnt;
            http.get('/WEI_2100/order_prc',params,popOrderModal.disPlayOrder());
        }
    });
</script>
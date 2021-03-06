<?php /* Template_ 2.2.6 2019/06/05 10:23:47 /home/gdmerp.yudo.com.cn/public_html/JLAMP_application/views/poporder_modal.html 000010477 */ ?>
<div id="popOrderModal" v-if="view.showPop"  class="yudo-window-trans animated fadeInRight trans-x">
    <div class="header-ios">
        <div class="header-body">
            <div class="header-left-btn" @click="hidePopModal" >
                <div class="left-icon icon-back-2"></div>
            </div>
            <div class="header-center-btn" >$((lang.queryOrder))</div>
            <div class="header-right-btn">
                <div class="right-icon icon-extend"></div>
            </div>
        </div>
    </div>
    <div class="center-ios">
        <div class="search" >
            <div class="input-tr">
                <div style="width: 80px" class="input-tr-title long"><div class="input-title" >$((lang.orderNo))</div></div>
                <div  class="input-tr-body flex-left" >
                    <div class="input-border" style="margin-right: 5px;flex: 1">
                        <input type="text"  v-model='model.popOrderNo' class="yudo-input noborder">
                    </div>
                    <img src="/image/qrcode.png" style="margin-right: 5px" @click="qrcode()" width="29">
                    <div class="input-button">
                        <button class="yudo-btn-white" name="fastclick"  @click="getData()">$((lang.search))</button>
                    </div>
                </div>
            </div>
            <div class="input-tr" style="margin-bottom: 10px">
                <div style="width: 80px" class="input-tr-title long"><div  class="input-title" >$((lang.custNm))</div></div>
                <div  class="input-tr-body flex-left">
                    <div class="input-border">
                        <input type="text"  v-model='model.popOrderCustNm' name="fastclick" class="yudo-input noborder">
                    </div>
                </div>
            </div>
        </div>
        <div class="info-minute scroll" style="top:159px;">
            <div class="minute-project">
                <div class="minute-list" style="border-bottom: 5px solid #f9f9f9;" v-for="(item,index) in list.datalist" @click="choose(index)">
                    <div class="minute-body" style="height: 95px">
                        <div class="tr">
                            <div class="title">$((lang.orderNo)):$((item.OrderNo))</div>
                        </div>
                        <div class="tr">
                            <div class="len-10 long">$((lang.custNm)):$((item.custname))</div>
                        </div>
                        <div class="tr">
                            <div class="len-5 long left-text ">$((lang.orderDate)):<span>$((item.OrderDate))</span></div>
                            <div class="right-text">$((lang.empNm)):$((item.EmpNm))</div>
                        </div>
                        <div class="tr">
                            <div class="len-5 long left-text ">$((lang.delvDate)):<span>$((item.DelvDate))</span></div>
                            <div class="right-text">$((lang.deptNm)):$((item.DeptNm))</div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="view.noData" class="nodata" >$((lang.noData))</div>
            <div v-if="view.pullMore" class="pull-more" @click="pullMore" >$((lang.pullMore))</div>
        </div>
    </div>
</div>
<!--</div>-->
<script>
    var popOrderModal = new Vue({
        el:'#popOrderModal',
        delimiters: ['$((', '))'],
        data: {
            api:'/WEI_2000/order_prc',
            hideCallBackFunc:'',
            clickCallBackFunc:'',
            view: {
                pageCnt:0,
                showPop: false,
                noData:true,
                pullMore:false,
            },
            lang:{
                search:'查询',
                orderNo:'订单号码',
                custNm:'客户名称',
                pullMore:'点击加载更多...'
            },
            model: {
                popOrderNo: '',
                popOrderCustNm: '',
            },
            list: {
                datalist: [],
            },
        },
        //过滤器
        filters:{

        },
        create(){
        },
        mounted(){
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
                screen:'W2019041817352089305'//筛选
            },this.lang,this._updateLang);
        },
        methods:{
            _updateLang(lang){
                // this.lang = lang;
            },
            initPop:function(){
                this.view.pullMore = false;
                this.view.noData = true;
                this.view.pageCnt = 0;
                this.list.datalist = [];
            },
            /**
             *
             * @param hideCallBackFunc
             * @param clickCallBackFunc
             */
            show:function (hideCallBackFunc,clickCallBackFunc) {
                this.hideCallBackFunc = hideCallBackFunc;
                this.clickCallBackFunc = clickCallBackFunc;
                this.view.showPop = true;
                this.initPop();
            },
            hide:function () {
                this.view.showPop = false;
            },
            hidePopModal:function () {
                if(typeof this.hideCallBackFunc == 'function') this.hideCallBackFunc();
            },
            choose:function(index){
                if(typeof this.clickCallBackFunc == 'function') this.clickCallBackFunc(this.list.datalist[index]);
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
            getData:function(){
                this.view.pullMore = false;
                this.view.noData = false;
                this.view.pageCnt = 0;
                mui.showLoading('loading...',title);
                var params = {}
                params.orderid = this.model.popOrderNo;
                params.orderby = this.model.popOrderCustNm;
                params.ordercount = 0;
                http.get(this.api,params,this.disPlayData);
            },
            //渲染订单列表
            disPlayData:function(res){
                mui.hideLoading()
                if (res.returnCode == 'NULL') {
                    popOrderModal.list.datalist = [];
                    popOrderModal.view.pullMore = false;
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
                            this.list.datalist.push(list[i]);
                        }
                    }
                    if(nodata == 1){
                        this.view.pullMore = false;
                        this.view.noData = true;
                    } else {
                        this.view.pullMore  = true;
                    }
                }
                //首次渲染
                else {
                    this.list.datalist = list;
                    if(list.length < 50){
                        this.view.pullMore = false;
                        this.view.noData = true;
                    } else {
                        this.view.pullMore = true;
                        this.view.noData = false;
                    }
                }
            },
            pullMore:function(){
                mui.showLoading('loading...')
                if(this.list.datalist.length > 0){
                    this.view.pageCnt = this.view.pageCnt+50;
                    var params = new Object();
                    params.orderid = this.model.popOrderNo;
                    params.orderby = this.model.popOrderCustNm;
                    params.ordercount = this.view.pageCnt;
                    http.get(this.api,params,this.disPlayData);
                }
            }
            // listenScroll:function () {
            //     jq('#mui_pushorder').scroll(function(){
            //         var bottom = document.getElementById('mui_pushorder').scrollHeight - document.getElementById('mui_pushorder').clientHeight - jq('#mui_pushorder').scrollTop();
            //         if(bottom == 0 && popOrderModal.list.orderlist.length > 0){
            //             popOrderModal.view.pageCnt = popOrderModal.view.pageCnt+50;
            //             var params = new Object();
            //             params.orderid = popOrderModal.model.popOrderNo;
            //             params.orderby = popOrderModal.model.popOrderCustNm;
            //             params.ordercount = popOrderModal.view.pageCnt;
            //             http.get('/WEI_2100/order_prc',params,popOrderModal.disPlayOrder());
            //         }
            //     });
            // }

        }
    });
</script>

</script>
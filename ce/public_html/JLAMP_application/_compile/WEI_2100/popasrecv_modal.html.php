<?php /* Template_ 2.2.6 2019/11/15 11:24:35 /home/merp.yudo.com.cn/public_html/JLAMP_application/views/popasrecv_modal.html 000017742 */ ?>
<div id="popAsRecvModal" v-bind:style="view.style" v-if="view.showPop"  class="yudo-window-trans animated fadeInRight trans-x">
    <div class="header-ios">
        <div class="header-body">
            <div class="header-left-btn" @click="hidePopModal">
                <div class="left-icon icon-back-2"></div>
            </div>
            <div class="header-center-btn">$((lang.asImformation))</div>
            <div class="header-right-btn">
                <div class="right-icon icon-extend"></div>
            </div>
        </div>
    </div>
    <div class="center-ios" style="background-color: white">
        <div class="screen" style="padding: 5px 5px">
            <div class="screen-power flex-left" name="fastclick" @click="view.screen = !view.screen;" >
                <div class="text">$((lang.screen))</div>
                <div class="icon-xiala screen-power-select"></div>
            </div>
            <div class="input-border" style="margin-right: 5px;">
                <input type="text"  :placeholder="lang.orderNo" name="fastclick"  v-model="model.popOrderNo" class="yudo-input noborder">
            </div>
            <img class="screen-pro" src="/image/qrcode.png" v-on:click="qrcode()" width="29">
            <div style="flex-shrink: 1;width: 60px;height: 38px">
                <button class="yudo-btn-white long screen-pro" name="fastclick"  @click="getData()"  style="flex-shrink: 1 ;width: 65px;font-size:15px">$((lang.search))</button>
            </div>
            <div class="heng-line screen-pro"></div>
        </div>
        <div class="screen-body" v-show="view.screen">
            <div class="screen-body-pro">
                <div class="flex-left input" >
                    <div  style="width: 30%" class="screen-pro">$((lang.asRecvNo))</div>
                    <div class="input-border" style="margin-right: 5px">
                        <input type="text" v-model="model.popAsRecvNo" name="fastclick" class="yudo-input noborder screen-pro">
                    </div>
                </div>
                <div class="flex-left input" >
                    <div  style="width: 30%" class="screen-pro">$((lang.custNm))</div>
                    <div class="input-border" style="margin-right: 5px">
                        <input type="text" v-model="model.popCustNm" name="fastclick" class="yudo-input noborder screen-pro">
                    </div>
                </div>
                <div class="flex-left input">
                    <div style="width: 30%" class="screen-pro">$((lang.date))</div>
                    <div class="flex-left" style="width: 100%">
                        <div class="input-border" style="margin-right: 5px">
                            <input @click="getDate('popAsStartDate')" name="fastclick" onfocus="this.blur();"  v-model="model.popAsStartDate" type="text"   class="yudo-input noborder screen-pro">
                        </div>
                        <div class="input-border" style="margin-right: 5px">
                            <input @click="getDate('popAsEndDate')" name="fastclick" onfocus="this.blur();"  v-model="model.popAsEndDate" type="text"  class="yudo-input noborder screen-pro">
                        </div>
                    </div>
                </div>
                <div class="screen-body-submit flex">
                    <button class="yudo-btn-default clear" @click="screenClear()">$((lang.roback))</button>
                    <button class="yudo-btn-default submit" @click="screenCfm()">$((lang.confirm))</button>
                </div>
            </div>
            <div name="fastclick" class="screen-body-bottom" @click="view.screen = !view.screen;"></div>
        </div>
        <div id="mui_pushas" class="info-minute scroll" style="top:100px;">
            <div class="minute-project">
                <div class="minute-list" style="border-bottom: 5px solid #f9f9f9;" v-for="(item,index) in list.datalist">
                    <div class="minute-body" style="height: 125px">
                        <div class="tr flex" style="margin-bottom: 13px;position: relative">
                            <div class="flex-left">
                                <div class="title">AS:$((item.ASRecvNo))</div>
                                <button v-if="view.showGetRate" @click="getRate(index);" style="width: 60px;margin-left:5px" class="yudo-btn-white screen-pro"  >$((lang.rateInfo))</button>
                            </div>
                            <div>$((lang.status)):<span v-html="$options.filters.statusChange(item.Status)"></span></div>
                            <div class="heng-line" style="bottom: -8px;"></div>
                        </div>
                        <div  @click="choose(index)">
                            <div class="tr flex">
                                <div class="len-7 long">$((lang.custNm)):$((item.CustNm))</div>
                                <div class="len-2" >$((lang.confirm)):<span v-html="$options.filters.confirmChange(item.CfmYn)"></span></div>
                            </div>
                            <div class="tr flex">
                                <div class="len-5 long flex-left">$((lang.orderNo)):$((item.OrderNo))&nbsp;<div class="flex-center" style="height: 15px;width: 15px;border: 1px solid #4c4c4c;border-radius: 3px">$((item.OrderCnt))</div></div>
                                <div>$((lang.productStatus)):<span v-html="$options.filters.productStatusChange(item.ProductStatus)"></span></div>
                            </div>
                            <div class="tr">
                                <div class="len-5 long left-text ">$((lang.delvDate)):<span>$((item.ASRecvDate | date))</span></div>
                                <div class="right-text">$((lang.empNm)):$((item.EmpNm))</div>
                            </div>
                            <div class="tr">
                                <div class="len-5 long left-text ">AS$((lang.delvDate)):<span>$((item.ASDelvDate | date))</span></div>
                                <div class="right-text">$((lang.deptNm)):$((item.DeptNm))</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="view.noData" class="nodata">$((lang.noData))</div>
            <div v-if="view.pullMore" class="pull-more" @click="pullMore" >$((lang.pullMore))</div>
        </div>
    </div>
</div>
<!--</div>-->
<script>
    var popAsRecvModal = new Vue({
        el:'#popAsRecvModal',
        delimiters: ['$((', '))'],
        data: {
            api:'/WEI_2100/as_prc',
            hideCallBackFunc:'',
            clickCallBackFunc:'',
            getRateCallBackFunc:'',
            nowDate:'',
            view: {
                style:{
                 zIndex:102
                },
                showGetRate:false,
                pageCnt:0,
                screen:false,
                showPop: false,
                noData:true,
                pullMore:false,
            },
            lang:{
                search:'查询',
                orderNo:'订单号码',
                custNm:'客户名称',
                asRecvNo:'AS接收编号',
                pullMore:'点击加载更多...'
            },
            model: {
                popOrderNo:'',
                popAsRecvNo:'',
                popCustNm:'',
                popAsStartDate:'',
                popAsEndDate:'',
            },
            list: {
                datalist: [],
            },
        },
        //过滤器
        filters:{
            statusChange:function(msg){
                switch (msg){
                    case '0':
                        return '<span style="width: 60px;background: #a2a2a2" class="yudo-label label-success">'+popAsRecvModal.lang.apply+'</span>';
                        break;
                    case '1':
                        return '<span style="width: 60px;background: #2686e1" class="yudo-label label-success">'+popAsRecvModal.lang.handle+'</span>';
                        break;
                    case '2':
                        return '<span style="width: 60px;background: #95ce33" class="yudo-label label-success">'+popAsRecvModal.lang.accept+'</span>';
                        break;
                    case 'A':
                        return '<span style="width: 60px;background: #2686e1" class="yudo-label label-success">'+popAsRecvModal.lang.isAdjudication+'</span>';
                        break;
                }
            },
            confirmChange:function(value){
                if(value == 1 ||  value == 'Y'){
                    value = '<span style="width: 60px;background:#95ce33" class="yudo-label label-success">YES</span>';
                }
                else
                {
                    value = '<span style="width: 60px;background:#a2a2a2" class="yudo-label label-success">NO</span>';
                }
                return value;
            },
            productStatusChange:function(value){
                switch (value){
                    case '0':
                        return '<span style="width: 60px;background: #a2a2a2" class="yudo-label label-success">'+popAsRecvModal.lang.noRelyn+'</span>';
                        break;
                    case '1':
                        return '<span style="width: 60px;background: #a2a2a2" class="yudo-label label-success">'+popAsRecvModal.lang.noReceive+'</span>';
                        break;
                    case '2':
                        return '<span style="width: 60px;background: #2686e1" class="yudo-label label-success">'+popAsRecvModal.lang.receive+'</span>';
                        break;
                    case '3':
                        return '<span style="width:60px;background: #95ce33" class="yudo-label label-success">'+popAsRecvModal.lang.productY+'</span>';
                        break;
                }
            },
            date:function (value) {
                if(value != '' && value != null){
                    return value.substr(0,10);
                }else{
                    return value;
                }
            },
        },
        create(){
        },
        mounted(){
            langCode.method = 'cache';
            langCode.getWord({
                title:'W2018062810305261707',//AS接收信息
                search:'W2018020109095825029',
                noData:'W2018062810475725084',
                empNm:'W2018041913373764065',//职员名称
                empId:'W2018041913385580778',//员工工号
                deptNm:'W2018041913371894064',
                deptCd:'W2018041913392311092',
                date:'W2018082712533876756',
                asRecvNo:'W2018062810310464752',//AS接收编号
                rateInfo:'W2019052415160666345',//详细进度
                accept:'W2018062810494812027',//接受
                apply:'W2018070510075477084',//申请
                handle:'W2018070510082072382',//处理
                isAdjudication:'W2018070615024454069',//裁决中
                productY:'W2019042412531575798',//生产完成
                noRelyn:'W2019042412535019323',//未依赖
                noReceive:'W2019042412553192026',//未接收
                receive:'W2019042412555230001',//接收
                productStatus:'W2019042413002394358',//生产状态
                delvDate:'W2018062810315076351',//交货日期
                status:'W2018082315443716702',//状态
                roback:'W2019050918161296005',
                confirm:'W2018071009351100377',//确定
                screen:'W2019041817352089305'//筛选
            },this.lang,this._updateLang);
        },
        methods:{
            _updateLang(lang){
                this.nowDate = multi.getNowDate();
                this.model.popAsStartDate = multi.getNowDate().substr(0,8)+'01';
                this.model.popAsEndDate = multi.getNowDate();
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
            show:function (hideCallBackFunc,clickCallBackFunc,getRateCallBackFunc) {
                this.hideCallBackFunc = hideCallBackFunc;
                this.clickCallBackFunc = clickCallBackFunc;
                this.getRateCallBackFunc = getRateCallBackFunc;
                this.view.showPop = true;
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
            getRate:function(index){
                if(typeof this.getRateCallBackFunc == 'function') this.getRateCallBackFunc(this.list.datalist[index]);
            },
            screenClear:function(){
                this.model = {
                    popOrderNo:'',
                    popCustNm:'',
                    popAsStartDate:multi.getNowDate().substr(0,8)+'01',
                    popAsEndDate:this.nowDate,
                }
            },
            screenCfm:function(){
                this.getData();
            },
            getData:function(){
                this.view.screen = false;
                this.view.pullMore = false;
                this.view.noData = false;
                this.view.pageCnt = 0;
                mui.showLoading('loading...',title);
                var params = {}
                params.orderNo = this.model.popOrderNo;
                params.asRecvNo = this.model.popAsRecvNo;
                params.custnm = this.model.popCustNm;
                params.startDate = this.model.popAsStartDate;
                params.endDate = this.model.popAsEndDate;
                params.ascount = 0;
                http.get(this.api,params,this.disPlayData);
            },
            getDate:function(vue){
                multi.searchDate('date',function (e) {
                    this.model[vue] = e.text;
                }.bind(this))
            },
            qrcode:function(){
                if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
                    try{
                        webkit.messageHandlers.jmobile.postMessage({fn: "getQRcode"});
                    }catch (e) {}
                }
                if(JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.Android)
                {
                    if(window.JMobile) window.JMobile.getQRcode();
                }
            },
            //渲染订单列表
            disPlayData:function(res){
                mui.hideLoading()
                if (res.returnCode == 'NULL') {
                    this.list.datalist = [];
                    this.view.pullMore = false;
                    this.view.noData = true;
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
                    var params = {};
                    params.orderNo = this.model.popOrderNo;
                    params.asRecvNo = this.model.popAsRecvNo;
                    params.custnm = this.model.popCustNm;
                    params.startDate = this.model.popAsStartDate;
                    params.endDate = this.model.popAsEndDate;
                    params.ascount = this.view.pageCnt;
                    http.get(this.api,params,this.disPlayData);
                }
            }
        }
    });
</script>
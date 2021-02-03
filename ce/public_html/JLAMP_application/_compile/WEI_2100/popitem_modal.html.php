<?php /* Template_ 2.2.6 2019/09/02 16:41:57 /home/merp.yudo.com.cn/public_html/JLAMP_application/views/popitem_modal.html 000008578 */ ?>
<div id="popItemModal" v-if="view.showPop"  class="yudo-window-trans animated fadeInRight trans-x">
    <div class="header-ios">
        <div class="header-body">
            <div class="header-left-btn" @click="hidePopModal">
                <div class="left-icon icon-back-2"></div>
            </div>
            <div class="header-center-btn">$((lang.queryItem))</div>
            <div class="header-right-btn">
                <div class="right-icon icon-extend"></div>
            </div>
        </div>
    </div>
    <div class="center-ios">
        <div class="search" >
            <div class="input-tr">
                <div style="width: 80px" class="input-tr-title long"><div class="input-title" >$((lang.itemNo))</div></div>
                <div  class="input-tr-body flex-left">
                    <div class="input-border" style="margin-right: 5px;flex: 1">
                        <input type="text"  v-model='model.popItemNo' class="yudo-input noborder">
                    </div>
                    <div class="input-button">
                        <button class="yudo-btn-white" name="fastclick"  @click="getData()" >$((lang.search))</button>
                    </div>
                </div>
            </div>
            <div class="input-tr" style="margin-bottom: 10px">
                <div style="width: 80px" class="input-tr-title long"><div class="input-title" >$((lang.itemNm))</div></div>
                <div  class="input-tr-body flex-left">
                    <div class="input-border">
                        <input type="text"  v-model='model.popItemNm' name="fastclick" class="yudo-input noborder">
                    </div>
                </div>
            </div>
        </div>
        <div class="info-minute scroll" style="top:157px;">
            <div class="minute-project">
                <div class="minute-list" style="border-bottom: 5px solid #f9f9f9;" v-for="(item,index) in list.datalist" @click="choose(index)">
                    <div class="minute-body" style="height:75px">
                        <div class="tr flex">
                            <div class="title len-7 long">$((lang.itemNo)):$((item.ItemNo))</div>
                            <div class="len-3 font-right">$((lang.itemCd)):$((item.ItemCd))</div>
                        </div>
                        <div class="tr flex">
                            <div class="len-7 long">$((lang.itemNm)):$((item.ItemNm))</div>
                            <div class="len-3 long font-right">$((lang.preStockQty)):$((item.PreStockQty))</div>
                        </div>
                        <div class="tr">
                            <div class="len-10 long">$((lang.spec)):$((item.Spec))</div>
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
    var popItemModal = new Vue({
        el:'#popItemModal',
        delimiters: ['$((', '))'],
        data: {
            api:'/FireWork/getItemList',
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
                popItemNm:'',
                popItemNo: '',
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
                queryItem:'W2019090216375605733',
                itemNo:'W2018062810504422036',//品目编码
                itemCd:'W2018071013443085307',//品目型号
                itemNm:'W2018062810511435013',//品目名称
                preStockQty:'W2018062810551330316',//现库存
                spec:'W2018062810520860062',//规格
                status:'W2018082315443716702',//状态
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
            getData:function(){
                this.view.pullMore = false;
                this.view.noData = false;
                this.view.pageCnt = 0;
                mui.showLoading('loading...',title);
                var params = {}
                params.itemNo = this.model.popItemNo;
                params.itemNm = this.model.popItemNm;
                params.count = 0;
                http.get(this.api,params,this.disPlayData);
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
                    params.itemNo = this.model.popItemNo;
                    params.itemNm = this.model.popItemNm;
                    params.count = this.view.pageCnt;
                    http.get(this.api,params,this.disPlayData);
                }
            }
        }
    });
</script>
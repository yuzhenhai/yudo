<?php /* Template_ 2.2.6 2019/07/09 17:11:56 /home/gdmerp.yudo.com.cn/public_html/JLAMP_application/views/popempy_modal.html 000008824 */ ?>
<div id="popEmpyModal" v-if="view.showPop"  class="yudo-window-trans animated fadeInRight trans-x">
    <div class="header-ios">
        <div class="header-body">
            <div class="header-left-btn" @click="hidePopModal">
                <div class="left-icon icon-back-2"></div>
            </div>
            <div class="header-center-btn">$((lang.queryEmpy))</div>
            <div class="header-right-btn">
                <div class="right-icon icon-extend"></div>
            </div>
        </div>
    </div>
    <div class="center-ios">
        <div class="search" >
            <div class="input-tr">
                <div style="width: 80px" class="input-tr-title long"><div class="input-title" >$((lang.empNm))</div></div>
                <div  class="input-tr-body flex-left">
                    <div class="input-border" style="margin-right: 5px;flex: 1">
                        <input type="text"  v-model='model.popEmpNm' class="yudo-input noborder">
                    </div>
                    <div class="input-button">
                        <button class="yudo-btn-white" name="fastclick"  @click="getData()" >$((lang.search))</button>
                    </div>
                </div>
            </div>
            <div class="input-tr" style="margin-bottom: 10px">
                <div style="width: 80px" class="input-tr-title long"><div class="input-title" >$((lang.empId))</div></div>
                <div  class="input-tr-body flex-left">
                    <div class="input-border">
                        <input type="text"  v-model='model.popEmpId' name="fastclick" class="yudo-input noborder">
                    </div>
                </div>
            </div>
            <div class="input-tr" style="margin-bottom: 10px">
                <div style="width: 80px" class="input-tr-title long"><div class="input-title" >$((lang.deptNm))</div></div>
                <div  class="input-tr-body flex-left">
                    <div class="input-border">
                        <input type="text"  v-model='model.popDeptNm' name="fastclick" class="yudo-input noborder">
                    </div>
                </div>
            </div>
        </div>
        <div class="info-minute scroll" style="top:202px;">
            <div class="minute-project">
                <div class="minute-list" style="border-bottom: 5px solid #f9f9f9;" v-for="(item,index) in list.datalist" @click="choose(index)">
                    <div class="minute-body" style="height: 75px">
                        <div class="tr">
                            <div class="title">$((lang.empNm)):$((item.EmpNm))</div>
                        </div>
                        <div class="tr">
                            <div class="len-10 long">$((lang.empId)):$((item.EmpID))</div>
                        </div>
                        <div class="tr">
                            <div class="len-10 long">$((lang.deptNm)):$((item.DeptNm))</div>
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
    var popEmpyModal = new Vue({
        el:'#popEmpyModal',
        delimiters: ['$((', '))'],
        data: {
            api:'/FireWork/getEmpyList',
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
                popEmpNm:'',
                popEmpId: '',
                popDeptNm: '',

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
                queryEmpy:'W2018082713370902732',
                empNm:'W2018041913373764065',//职员名称
                empId:'W2018041913385580778',//员工工号
                deptNm:'W2018041913371894064',
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
            getData:function(){
                this.view.pullMore = false;
                this.view.noData = false;
                this.view.pageCnt = 0;
                mui.showLoading('loading...',title);
                var params = {}
                params.empNm = this.model.popEmpNm;
                params.empId = this.model.popEmpId;
                params.deptNm = this.model.popDeptNm;
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
                    params.empNm = this.model.popEmpNm;
                    params.empId = this.model.popEmpId;
                    params.deptNm = this.model.popDeptNm;
                    params.count = this.view.pageCnt;
                    http.get(this.api,params,this.disPlayData);
                }
            }
        }
    });
</script>
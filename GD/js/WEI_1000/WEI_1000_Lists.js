var leon = new Vue({
    el:'#leon',
    delimiters: ['$((', '))'],
    data:{
        backIcon:{
            'left-icon':true,
            'icon-backmenu':true,
        },
        yearItem:{
            'item':true,
            'active':true,
        },
        monthItem:{
            'item':true,
            'active':false,
        },
        dayItem:{
            'item':true,
            'active':false,
        },
        salesClass:'<div class="left-icon icon-search-user"></div><input type="text" placeholder="查询人员">',
        salesTargetDate:'',
        nowDateItem:0,
        isactive:0,
        userNm:'',
        userId:'',
        groupNm:'',
        groupId:'',
        themeIndex:'0',
        permission:'E',
        lang:{
            tubiaoTitle :[
                ['(本年)发票','(去年)发票','(本年)收款','(去年)收款','(本年)出库','(去年)出库','(本年)订单','(去年)订单'],
                ['(当月)发票','(去年)发票','(当月)收款','(去年)收款','(当月)出库','(去年)出库','(当月)订单','(去年)订单'],
                ['(今日)发票','(今日)收款','(今日)出库','(今日)订单'],
            ],
            searchUserNm:'职员姓名',
            searchUserId:'职员工号',
            searchGroupNm:'部门名称',
            userNm:'姓名',
            userId:'工号',
            groupNm:'部门',
            targetDate:'目标日',
            orderAmt:'订单目标',
            InvoiceAmt:'出库目标',
            BillAmt:'发票目标',
            ReceiptAmt:'收款目标',
            currId:'货币',
            nowUnit:'',
            unit:'单位',
            unitInfo:'万元',
            yuan:'元',
            queryAll:'查询全部',
            allResults:'全部业绩',
            menuBack:'',
            expClass:'',//出口区分
            currCd:'',//货币种类
            mempidResults:'各经理管辖部门业绩',
            groupResults:'各部门业绩',
            userResults:'个人业绩',
            targetWrite:'销售目标录入',
            headerTitle:'销售统计(日)',
            confirm:'',
            save:'',
            year:'',
            month:'',
            day:'',
            dataMinute:'',
            class:'',
            targetOrderMoney:'',//订单目标金额
            targetInvoiceMoney:'',
            targetBillMoney:'',
            targetReceiptMoney:'',
            targetOrder:'',//订单目标
            targetInvoice:'',
            targetBill:'',
            targetReceipt:'',
            nodata:'',//暂无数据
            target:'',//目标
            results:'',//业绩
            persent:'',//达成率
            pictrolTable:'',//图表
            search:'查询',
            searchUser:'',
            searchResult:'',
            trust:'',//内销
            untrust:'',//外销
            resultsOrder:'',//订单业绩
            resultsInvoice:'',
            resultsBill:'',
            resultsReceipt:'',
            RMB:'',
            EUR:'',
            KOR:'',
            HKD:'',
            JPY:'',
            TWD:'',
            USD:'',
        },
        view:{
            toYear:true,
            toMonth:false,
            toDay:false,
            tubiao:false,
            dataMinute:false,
            echarts:'',
            downLoadScript:true,
            optAllAdminComplete:false,
            opening:'',
            confirm:false,
            isRewrite:false,
            xwrite:false,
            writeTargetIsLoading:false,
            writeTargetNoData:false,
            viewMenu:true,
            viewTargetMinute:true,
            viewTargetWrite:false,
            viewTargetSearch:false,
            viewUserSearch:false,
            usersIsLoading:false,
            usersNoData:false,
            optUser:false,
            optGroupAdmin_c:false,
            optGroupAdmin:false,
            optAllAdmin:true,
            targetNoData:true,
            echartsNoData:true,
        },
        api:{
            getResults:'/WEI_1000/lists_prc',
        },
        input:{
            optUserNm:'',
            optUserId:'',
            userNm:'',
            userId:'',
            groupNm:'',
            groupId:'',
            orderAmt:'',
            invoiceAmt:'',
            billAmt:'',
            receiptAmt:'',
            searchStartTime:'',
            searchEndTime:'',
            searchUserNm:'',
            searchUserId:'',
            searchGroupNm:'',
            searchUserCount:0,
            searchTargetCount:0,
            targetDate:'',
            searchGroup:'C001',
            expClass:'1',
            currency:'RMB',
            targetAllAdmin:{value:'ALL',text:''},
            targetGroupAdmin:{value:'ALL',text:''},
            targetGroupAdmin_c:{value:'ALL',text:''},
            targetUser:{},
            leaderNm:'',
        },
        list:{
           //出口区分
            expClass:[
                {value:'1',text:'内销'},
                {value:'4',text:'外销'}
            ],
            currency:[
                {value:'RMB',text:'人民币'},
                {value:'EUR',text:'欧元'},
                {value:'KOR',text:'韩元'},
                {value:'HKD',text:'港币'},
                {value:'JPY',text:'日元'},
                {value:'TWD',text:'台币'},
                {value:'USD',text:'美元'},
            ],
            resultsList:[],
            trustData:[],
            unTrustData:[],
            minuteDataDisplay:[],
        }
    },
    filters: {
        toFixs:function(value){
            return (value/10000).toFixed(2)
        },
        toFix:function (value) {
            return value.toFixed(0);
        },
        date:function (value) {
            return value.substr(0,10);
        },
        currSwitch:function (value) {
            for(var index in leon.list.currency)
            {
                if(leon.list.currency[index].value == value){
                    return leon.list.currency[index].text
                }
            }
        },
        confirmLabel:function (value) {
            if(value == 1){
                return '<div class="yudo-label label-success" style="float: right">'+leon.lang.isConfirm+'</div>';
            }else{
                return '<div class="yudo-label label-default" style="float: right">'+leon.lang.noConfirm+'</div>';
            }
        }
    },
    mounted(){
        try {
            langCode.getWord({
                    currCd:'W2016080513341915077',
                    toDayOrder:'W2018112813221815342',
                    toDayInvoice:'W2018112814031907729',
                    toDayBill:'W2018020109163152302',
                    toDayReceivables:'W2018020109171409099',
                    toMonthOrder:'W2018020109241439019',
                    toMonthInvoice:'W2018020109245146068',
                    toMonthBill:'W2018020109252733085',
                    toMonthReceivables:'W2018020109261422793',
                    toYearOrder:'W2018020109283120077',
                    toYearInvoice:'W2018020109285362328',
                    toYearBill:'W2018020109291710702',
                    toYearReceivables:'W2018020109293734322',

                    toDay:'W2019060616554525308',//今日
                    toMonth:'W2018020109413375009',//当月
                    toYear:'W2018122516063785033',//今年
                    lastYear:'W2018122516062166764',//去年
                    salesResultsTable:'W2019060616315233357',//销售业绩图表

                    orderNoCompelete:'W2018122516125241001',
                    invoiceNoCompelete:'W2018122516142135347',
                    headerTitle:'W2018122516292716001',
                    targetDate:'G2018102617095956058',//目标日
                    userNm:'W2018102913315336322',
                    userId:'W2018102913320682016',
                    groupNm:'W2018102913322677395',
                    menuBack:'W2018071009230638074',   //主菜单
                    searchUserNm:'W2018041913373764065', //职员名称
                    searchUserId:'W2018041913385580778', //职员Id
                    searchGroupNm:'W2018041913371894064', //部门名称
                    expClass:'W2018041913341497746',//出口区分
                    currCd:'G2018102617102083724',//货币种类

                    targetOrderMoney:'G2018102617105713785',//订单目标金额
                    targetInvoiceMoney:'W2018102617114052791',
                    targetBillMoney:'W2018102617115829085',
                    targetReceiptMoney:'W2018102617122922701',

                    targetOrder:'G2018102617181930339',//订单目标
                    targetInvoice:'G2018102617185897075',
                    targetBill:'G2018102617191538772',
                    targetReceipt:'G2018102617193451755',

                    resultsOrder:'W2018102914300143739',//订单业绩
                    resultsInvoice:'W2018102914302448767',
                    resultsBill:'W2018102914304110771',
                    resultsReceipt:'W2018102914310673068',

                    confirm:'W2018071009351100377',
                    save:'W2018071009410262081',

                    year:'W2018102617000591392',
                    month:'G2018102617002367015',
                    day:'G2018102617005914777',
                    search:'W2018082711232500387',//查询
                    dataMinute:'G2018102617012216352',//详细数据
                    class:'G2018102617013950014',//区分
                    orderResults:'G2018102617015927383',//订单金额
                    invoiceResults:'G2018102617023163098',
                    billResults:'G2018102617053446374',
                    receiptResults:'G2018102617060001707',
                    nodata:'W2018062810475725084',//暂无数据
                    target:'G2018102617064252094',//目标
                    results:'W2018102617080071052',//业绩
                    persent:'W2018102617081972328',//达成率
                    pictrolTable:'W2018102617085239791',//图表
                    unit:'G2018102617202335794', //单位
                    unitInfo:'G2018102617205307726',//万元
                    yuan:'G2018102617211340024', //元
                    allResults:'G2018102617215904304',
                    mempidResults:'G2018102617222479741',
                    groupResults:'G2018102617224857379',
                    userResults:'G2018102617230579079',
                    queryAll:'G2018102617214379386',
                    searchUser:'W2018082713370902732',//职员查询
                    searchResult:'W2018102909354232763',
                    targetWrite:'W2018102616572707009',//销售目标录入
                    currId:'G2018102617195825091',
                    trust:'W2018041913351532345',//内销
                    untrust:'W2018041913355225052',//外销
                    isConfirm:'W2018102914044702085',
                    noConfirm:'W2018102914051033012',
                    order:'W2018110617341265338',//订单
                    invoice:'W2018110617351862706',//出库
                    bill:'W2018110617354776078',//发票
                    receipt:'W2018110617362266394',//收款
                    changeTheme:'W2018110618023964046',//切换样式

                    RMB:'G2018102617231931047',
                    EUR:'G2018102617232982015',
                    KOR:'W2018102617390024388',
                    HKD:'W2018102617393022013',
                    JPY:'W2018102617394451365',
                    TWD:'W2018102617395906027',
                    USD:'W2018102617402068363',
                }, this.lang,this._updateLang
            );
        }catch (e) {
            mui.alert('多语言解析出错!',this.title);
        }
        // http.get('/WEI_2300/getLoginInfo',{},function (res) {
        //     leon.input.userNm = res.data.EmpNm;
        //     leon.input.userId = res.data.EmpID;
        //     leon.input.groupNm = res.data.DeptNm;
        //     leon.input.groupId = res.data.DeptCd;
        //
        //     leon.userId = res.data.EmpID;
        //     leon.userNm = res.data.EmpNm;
        //     leon.groupNm = res.data.DeptNm;
        //     leon.groupId = res.data.DeptCd;
        //
        //     leon.input.searchUserNm = res.data.EmpNm;
        // });
        this.view.downLoadScript = false;
        this.salesTargetDate = this.getNowDate();
    },
    methods:{
        //多语言转换完成回调
        _updateLang:function(){
            this.list.expClass[0].text = this.lang.trust;
            this.list.expClass[1].text = this.lang.untrust;
            this.lang.nowUnit = this.lang.unitInfo;
            this.lang.tubiaoTitle = [
                [
                    '('+this.lang.toYear+')'+this.lang.bill,
                    '('+this.lang.lastYear+')'+this.lang.bill,
                    '('+this.lang.toYear+')'+this.lang.receipt,
                    '('+this.lang.lastYear+')'+this.lang.receipt,
                    '('+this.lang.toYear+')'+this.lang.invoice,
                    '('+this.lang.lastYear+')'+this.lang.invoice,
                    '('+this.lang.toYear+')'+this.lang.order,
                    '('+this.lang.lastYear+')'+this.lang.order,
                ],
                [
                    '('+this.lang.toMonth+')'+this.lang.bill,
                    '('+this.lang.lastYear+')'+this.lang.bill,
                    '('+this.lang.toMonth+')'+this.lang.receipt,
                    '('+this.lang.lastYear+')'+this.lang.receipt,
                    '('+this.lang.toMonth+')'+this.lang.invoice,
                    '('+this.lang.lastYear+')'+this.lang.invoice,
                    '('+this.lang.toMonth+')'+this.lang.order,
                    '('+this.lang.lastYear+')'+this.lang.order,
                ],
                [
                    '('+this.lang.toDay+')'+this.lang.bill,
                    '('+this.lang.toDay+')'+this.lang.receipt,
                    '('+this.lang.toDay+')'+this.lang.invoice,
                    '('+this.lang.toDay+')'+this.lang.order,
                ],
            ];

        },
        showDataMinute:function(index){
            if(index == 2)return false;
            jq('.yudo-window').css({'animation-duration':'0.6s'});
            leon.view.dataMinute = true;
            if(JLAMP.common.getDevicePlatform() !== JLAMP.devicePlatform.iOS){
                multi.removeDefaultByClass('yudo-window',function () {
                    leon.view.viewTargetMinute = true;
                });
            }
            mui.showLoading('loading');
            switch (index){
                case 0:
                    leon.list.minuteDataDisplay = leon.list.trustData;
                    break;
                case 1:
                    leon.list.minuteDataDisplay = leon.list.unTrustData;
                    break;
                case 2:
                    break;
            }
            mui.hideLoading();
        },
        closeDataMinute:function(){
            leon.list.minuteListDisplay = [];
            jq('.yudo-window').css({'animation-duration':'0.2s'});
            multi.recoverDefaultByCss('yudo-window',function () {
                leon.view.viewTargetMinute = true;
                multi.removeTransByCss('yudo-window-trans',function () {
                    leon.view.dataMinute = false;
                });
            });
        },
        showTubiao:function(index){
            // if(index == 2)return false;
            jq('.yudo-window').css({'animation-duration':'0.6s'});
            leon.view.tubiao = true;
            mui.showLoading('loading');
            if(JLAMP.common.getDevicePlatform() !== JLAMP.devicePlatform.iOS){
                multi.removeDefaultByClass('yudo-window',function () {
                    leon.view.viewTargetMinute = true;
                });
            }
            setTimeout(function () {
                leon.buildHistogram(index);
                mui.hideLoading();
            },500);

        },
        closeTubiao:function(){
            jq('.yudo-window').css({'animation-duration':'0.2s'});
            multi.recoverDefaultByCss('yudo-window',function () {
                leon.view.viewTargetMinute = true;
                multi.removeTransByCss('yudo-window-trans',function () {
                    leon.view.tubiao = false;
                });
            });
        },
        //切换年月日
        changeInfoItem:function (e) {
            if(e == this.nowDateItem)return false;
            mui.showLoading('loading');
            if(this.view.echarts != '')this.view.echarts.clear();
            this.list.targetList = [];
            // this.view.targetNoData = true;
            this.view.echartsNoData = true;
            this.yearItem['active'] = false;
            this.monthItem['active'] = false;
            this.dayItem['active'] = false;
            this.view.toDay= false;
            this.view.toMonth= false;
            this.view.toYear = false;
            var nowDate = this.getNowDate('array');
            switch (e){
                case 0:
                    this.nowDateItem = 0;
                    this.view.toYear = true;
                    this.yearItem['active'] = true;
                    this.salesTargetDate =nowDate[0]+'-'+nowDate[1]+'-'+nowDate[2];
                    break;
                case 1:
                    this.nowDateItem = 1;
                    this.view.toMonth = true;
                    this.salesTargetDate = nowDate[0]+'-'+nowDate[1]+'-'+nowDate[2];
                    this.monthItem['active'] = true;
                    break;
                case 2:
                    this.nowDateItem = 2;
                    this.view.toDay = true;
                    this.salesTargetDate = nowDate[0]+'-'+nowDate[1]+'-'+nowDate[2];
                    this.dayItem['active'] = true;
                    break;
            }
            setTimeout(function () {
                mui.hideLoading();
            },300)
            //更新数据
            // this.getTarget();
        },
        //获取当前时间 xxxx-xx-xx
        getNowDate:function(check){
            var check = check || '';
            var nowDate = new Date();
            var year = nowDate.getFullYear();
            var month = nowDate.getMonth() + 1 < 10 ? "0" + (nowDate.getMonth() + 1) : nowDate.getMonth() + 1;
            var day = nowDate.getDate() < 10 ? "0" + nowDate.getDate() : nowDate.getDate();
            if(check == 'array'){
                var nowTime = [year,month,day];
            }else {
                var nowTime = year + "-" + month + "-" + day;
            }

            return nowTime;
        },

        //查询时间选择
        searchDate:function(){
            // if(this.nowDateItem == 0 || this.nowDateItem == 1){
            //     var type = 'month';
            // }else{
            //     var type = 'date';
            // }
            var type = 'date';
            this.changeDate(type,function (e) {
                leon.salesTargetDate = e.text;
                leon.getResults();
                jq('.mui-dtpicker').remove();
            });
        },
        //切换查询货币单位
        changeCurrency:function(value){
            mui.showLoading('loading...');
            setTimeout(function () {
                mui.hideLoading();
            },1000);
        },
        //选择时间
        changeDate:function(type,func){
            var nowDate = this.getNowDate('array');
            var dtpicker = new mui.DtPicker({
                type: type,//设置日历初始视图模式
                beginDate: new Date(1989, 01, 01),//设置开始日期
                endDate: new Date(nowDate[0],nowDate[1], nowDate[2]),//设置结束日期
                labels: ['Year', 'Mon', 'Day'],//设置默认标签区域提示语
            })
            dtpicker.show(function(e) {
                func(e);
            })
        },
        //获取业绩信息
        getResults:function(){
            mui.showLoading('loading');
            var params = {}
            params.baseDate = leon.salesTargetDate.substr(0,4)+leon.salesTargetDate.substr(5,2)+leon.salesTargetDate.substr(8,2);
            params.dateItem = this.nowDateItem;
            this.isactive = 0;
            if(this.view.echarts != '')this.view.echarts.clear();
            this.list.ResultsList = [];
            http.get(this.api.getResults,params,function (res) {
                console.log(res);
                var protocol = function (title) {
                    return {
                        title:title,
                        ToDayOrderForAmt:0,
                        ToDayInvoiceForAmt:0,
                        ToDayBillForAmt:0,
                        ToDayReceiptForAmt:0,
                        ToMonthOrderForAmt:0,
                        ToMonthInvoiceForAmt :0,
                        ToMonthBillForAmt:0,
                        ToMonthReceiptForAmt:0,
                        LastMonthOrderForAmt:0,
                        LastMonthInvoiceForAmt :0,
                        LastMonthBillForAmt:0,
                        LastMonthReceiptForAmt:0,
                        ToYearOrderForAmt:0,
                        ToYearInvoiceForAmt:0,
                        ToYearBillForAmt:0,
                        ToYearReceiptForAmt:0,
                        LastYearOrderForAmt:0,
                        LastYearInvoiceForAmt:0,
                        LastYearBillForAmt:0,
                        LastYearReceiptForAmt:0,

                        TotOrderForAmt:0,
                        TotInvoiceForAmt:0,
                        TotBillForAmt:0,
                        TotReceiptForAmt:0,
                        MiInvoiceForAmt:0,
                        MiReceiptForAmt:0,
                    }
                }
                var sumType = function (obj,res) {
                    obj.ToDayOrderForAmt += isNaN(res.ToDayOrderForAmt)?0:res.ToDayOrderForAmt;
                    obj.ToDayInvoiceForAmt += isNaN(res.ToDayInvoiceForAmt)?0:res.ToDayInvoiceForAmt;
                    obj.ToDayBillForAmt += isNaN(res.ToDayBillForAmt)?0:res.ToDayBillForAmt;
                    obj.ToDayReceiptForAmt += isNaN(res.ToDayReceiptForAmt)?0:res.ToDayReceiptForAmt;
                    obj.ToMonthOrderForAmt += isNaN(res.ToMonthOrderForAmt)?0:res.ToMonthOrderForAmt;
                    obj.ToMonthInvoiceForAmt += isNaN(res.ToMonthInvoiceForAmt)?0:res.ToMonthInvoiceForAmt;
                    obj.ToMonthBillForAmt += isNaN(res.ToMonthBillForAmt)?0:res.ToMonthBillForAmt;
                    obj.ToMonthReceiptForAmt += isNaN(res.ToMonthReceiptForAmt)?0:res.ToMonthReceiptForAmt;
                    obj.LastMonthOrderForAmt += isNaN(res.LastMonthOrderForAmt)?0:res.LastMonthOrderForAmt;
                    obj.LastMonthInvoiceForAmt += isNaN(res.LastMonthInvoiceForAmt)?0:res.LastMonthInvoiceForAmt;
                    obj.LastMonthBillForAmt += isNaN(res.LastMonthBillForAmt)?0:res.LastMonthBillForAmt;
                    obj.LastMonthReceiptForAmt += isNaN(res.LastMonthReceiptForAmt)?0:res.LastMonthReceiptForAmt;
                    obj.ToYearOrderForAmt += isNaN(res.ToYearOrderForAmt)?0:res.ToYearOrderForAmt;
                    obj.ToYearInvoiceForAmt += isNaN(res.ToYearInvoiceForAmt)?0:res.ToYearInvoiceForAmt;
                    obj.ToYearBillForAmt += isNaN(res.ToYearBillForAmt)?0:res.ToYearBillForAmt;
                    obj.ToYearReceiptForAmt += isNaN(res.ToYearReceiptForAmt)?0:res.ToYearReceiptForAmt;
                    obj.LastYearOrderForAmt += isNaN(res.LastYearOrderForAmt)?0:res.LastYearOrderForAmt;
                    obj.LastYearInvoiceForAmt += isNaN(res.LastYearInvoiceForAmt)?0:res.LastYearInvoiceForAmt;
                    obj.LastYearBillForAmt += isNaN(res.LastYearBillForAmt)?0:res.LastYearBillForAmt;
                    obj.LastYearReceiptForAmt += isNaN(res.LastYearReceiptForAmt)?0:res.LastYearReceiptForAmt;

                    obj.TotOrderForAmt += isNaN(res.TotOrderForAmt)?0:res.TotOrderForAmt;
                    obj.TotInvoiceForAmt += isNaN(res.TotInvoiceForAmt)?0:res.TotInvoiceForAmt;
                    obj.TotBillForAmt += isNaN(res.TotBillForAmt)?0:res.TotBillForAmt;
                    obj.TotReceiptForAmt += isNaN(res.TotReceiptForAmt)?0:res.TotReceiptForAmt;
                    obj.MiInvoiceForAmt += isNaN(res.MiInvoiceForAmt)?0:res.MiInvoiceForAmt;
                    obj.MiReceiptForAmt += isNaN(res.MiReceiptForAmt)?0:res.MiReceiptForAmt;
                    // obj.ToDayOrderForAmt += res.ToDayOrderForAmt;
                    // obj.ToDayInvoiceForAmt += res.ToDayInvoiceForAmt;
                    // obj.ToDayBillForAmt += res.ToDayBillForAmt;
                    // obj.ToDayReceiptForAmt += res.ToDayReceiptForAmt;
                    // obj.ToMonthOrderForAmt += res.ToMonthOrderForAmt;
                    // obj.ToMonthInvoiceForAmt += res.ToMonthInvoiceForAmt;
                    // obj.ToMonthBillForAmt += res.ToMonthBillForAmt;
                    // obj.ToMonthReceiptForAmt += res.ToMonthReceiptForAmt;
                    // obj.LastMonthOrderForAmt += res.LastMonthOrderForAmt;
                    // obj.LastMonthInvoiceForAmt += res.LastMonthInvoiceForAmt;
                    // obj.LastMonthBillForAmt += res.LastMonthBillForAmt;
                    // obj.LastMonthReceiptForAmt += res.LastMonthReceiptForAmt;
                    // obj.ToYearOrderForAmt += res.ToYearOrderForAmt;
                    // obj.ToYearInvoiceForAmt += res.ToYearInvoiceForAmt;
                    // obj.ToYearBillForAmt += res.ToYearBillForAmt;
                    // obj.ToYearReceiptForAmt += res.ToYearReceiptForAmt;
                    // obj.LastYearOrderForAmt += res.LastYearOrderForAmt;
                    // obj.LastYearInvoiceForAmt += res.LastYearInvoiceForAmt;
                    // obj.LastYearBillForAmt += res.LastYearBillForAmt ;
                    // obj.LastYearReceiptForAmt += res.LastYearReceiptForAmt;

                    // obj.TotOrderForAmt += res.TotOrderForAmt;
                    // obj.TotInvoiceForAmt += res.TotInvoiceForAmt;
                    // obj.TotBillForAmt += res.TotBillForAmt;
                    // obj.TotReceiptForAmt += res.TotReceiptForAmt;
                    // obj.MiInvoiceForAmt += res.MiInvoiceForAmt;
                    // obj.MiReceiptForAmt += res.MiReceiptForAmt;
                }
                var sumData = protocol('Totol');
                var sumTrustData = protocol(this.list.expClass[0].text);
                var sumUntrustData = protocol(this.list.expClass[1].text);
                var trustData = [];
                var unTrustData = [];
                for(var index in res.data){
                    res.data[index].ToDayOrderForAmt = parseFloat(res.data[index].ToDayOrderForAmt);
                    res.data[index].ToDayInvoiceForAmt = parseFloat(res.data[index].ToDayInvoiceForAmt);
                    res.data[index].ToDayBillForAmt = parseFloat(res.data[index].ToDayBillForAmt);
                    res.data[index].ToDayReceiptForAmt = parseFloat(res.data[index].ToDayReceiptForAmt);
                    res.data[index].ToMonthOrderForAmt = parseFloat(res.data[index].ToMonthOrderForAmt);
                    res.data[index].ToMonthInvoiceForAmt = parseFloat(res.data[index].ToMonthInvoiceForAmt);
                    res.data[index].ToMonthBillForAmt = parseFloat(res.data[index].ToMonthBillForAmt);
                    res.data[index].ToMonthReceiptForAmt = parseFloat(res.data[index].ToMonthReceiptForAmt);
                    res.data[index].ToYearOrderForAmt = parseFloat(res.data[index].ToYearOrderForAmt);
                    res.data[index].ToYearInvoiceForAmt = parseFloat(res.data[index].ToYearInvoiceForAmt);
                    res.data[index].ToYearBillForAmt = parseFloat(res.data[index].ToYearBillForAmt);
                    res.data[index].ToYearReceiptForAmt = parseFloat(res.data[index].ToYearReceiptForAmt);

                    res.data[index].TotOrderForAmt = parseFloat(res.data[index].TotOrderForAmt);
                    res.data[index].TotInvoiceForAmt = parseFloat(res.data[index].TotInvoiceForAmt);
                    res.data[index].TotBillForAmt = parseFloat(res.data[index].TotBillForAmt);
                    res.data[index].TotReceiptForAmt = parseFloat(res.data[index].TotReceiptForAmt);
                    res.data[index].MiInvoiceForAmt = parseFloat(res.data[index].MiInvoiceForAmt);
                    res.data[index].MiReceiptForAmt = parseFloat(res.data[index].MiReceiptForAmt);

                    res.data[index].LastMonthBillAmt = parseFloat(res.data[index].LastMonthBillAmt);
                    res.data[index].LastMonthBillForAmt = parseFloat(res.data[index].LastMonthBillForAmt);
                    res.data[index].LastMonthInvoiceAmt = parseFloat(res.data[index].LastMonthInvoiceAmt);
                    res.data[index].LastMonthInvoiceForAmt = parseFloat(res.data[index].LastMonthInvoiceForAmt);
                    res.data[index].LastMonthOrderAmt = parseFloat(res.data[index].LastMonthOrderAmt);
                    res.data[index].LastMonthOrderForAmt = parseFloat(res.data[index].LastMonthOrderForAmt);
                    res.data[index].LastMonthReceiptAmt = parseFloat(res.data[index].LastMonthReceiptAmt);
                    res.data[index].LastMonthReceiptForAmt = parseFloat(res.data[index].LastMonthReceiptForAmt);
                    res.data[index].LastYearBillAmt = parseFloat(res.data[index].LastYearBillAmt);
                    res.data[index].LastYearBillForAmt = parseFloat(res.data[index].LastYearBillForAmt);
                    res.data[index].LastYearInvoiceAmt = parseFloat(res.data[index].LastYearInvoiceAmt);
                    res.data[index].LastYearInvoiceForAmt = parseFloat(res.data[index].LastYearInvoiceForAmt);
                    res.data[index].LastYearOrderAmt = parseFloat(res.data[index].LastYearOrderAmt);
                    res.data[index].LastYearOrderForAmt = parseFloat(res.data[index].LastYearOrderForAmt);
                    res.data[index].LastYearReceiptAmt = parseFloat(res.data[index].LastYearReceiptAmt);
                    res.data[index].LastYearReceiptForAmt = parseFloat(res.data[index].LastYearReceiptForAmt);

                    sumType(sumData,res.data[index]);

                    if(res.data[index].ExpClss == 1){
                        trustData.push(res.data[index]);
                        sumType(sumTrustData,res.data[index]);
                    }else{
                        unTrustData.push(res.data[index]);
                        sumType(sumUntrustData,res.data[index]);
                    }
                }

                leon.list.unTrustData = unTrustData;
                leon.list.trustData = trustData;
                leon.list.resultsList = [sumTrustData,sumUntrustData,sumData];
                console.log(leon.list.resultsList);
                leon.view.targetNoData = false;
                leon.view.echartsNoData = false;
                // leon.getResultsMinute(0);

            }.bind(this));
        },
        //查看个人目标图表信息
        getResultsMinute:function(index){
            this.isactive = index;
            jq('#centerControl').scrollTop(jq('#centerControl')[0].scrollHeight);
            this.buildHistogram(index);
        },
        changeTheme:function(){
            if(this.view.echarts != '') this.view.echarts.clear();
            this.themeIndex == 0 ? this.themeIndex = 1 : this.themeIndex = 0;
            jq('#centerControl').scrollTop(jq('#centerControl')[0].scrollHeight);
            this.buildHistogram(this.list.targetList[this.isactive],this.nowDateItem);
        },
        //生成柱状图-附加对比去年
        buildHistogram:function (index) {
            if(this.nowDateItem == 0){
                var orderAmt = leon.list.resultsList[index].ToYearOrderForAmt/10000;
                var invoiceAmt = leon.list.resultsList[index].ToYearInvoiceForAmt/10000;
                var billAmt = leon.list.resultsList[index].ToYearBillForAmt/10000;
                var receiptAmt = leon.list.resultsList[index].ToYearReceiptForAmt/10000;
                var preOrderAmt = leon.list.resultsList[index].LastYearOrderForAmt/10000;
                var preInvoiceAmt = leon.list.resultsList[index].LastYearInvoiceForAmt/10000;
                var preBillAmt = leon.list.resultsList[index].LastYearBillForAmt/10000;
                var preReceiptAmt = leon.list.resultsList[index].LastYearReceiptForAmt/10000;
                var _max = 100000;
                var data1 = [preReceiptAmt.toFixed(2),
                    preBillAmt.toFixed(2),
                    preInvoiceAmt.toFixed(2),
                    preOrderAmt.toFixed(2),
                    receiptAmt.toFixed(2),
                    billAmt.toFixed(2),
                    invoiceAmt.toFixed(2),
                    orderAmt.toFixed(2),];
                var data2 = [_max - preReceiptAmt.toFixed(2),
                    _max - preBillAmt.toFixed(2),
                    _max - preInvoiceAmt.toFixed(2),
                    _max - preOrderAmt.toFixed(2),
                    _max - receiptAmt.toFixed(2),
                    _max - billAmt.toFixed(2),
                    _max - invoiceAmt.toFixed(2),
                    _max - orderAmt.toFixed(2),]
            }else if(this.nowDateItem == 1){
                var orderAmt = leon.list.resultsList[index].ToMonthOrderForAmt/10000;
                var invoiceAmt = leon.list.resultsList[index].ToMonthInvoiceForAmt/10000;
                var billAmt = leon.list.resultsList[index].ToMonthBillForAmt/10000;
                var receiptAmt = leon.list.resultsList[index].ToMonthReceiptForAmt/10000;
                var preOrderAmt = leon.list.resultsList[index].LastMonthOrderForAmt/10000;
                var preInvoiceAmt = leon.list.resultsList[index].LastMonthInvoiceForAmt/10000;
                var preBillAmt = leon.list.resultsList[index].LastMonthBillForAmt/10000;
                var preReceiptAmt = leon.list.resultsList[index].LastMonthReceiptForAmt/10000;
                var _max = 10000;
                var data1 = [preReceiptAmt.toFixed(2),
                    preBillAmt.toFixed(2),
                    preInvoiceAmt.toFixed(2),
                    preOrderAmt.toFixed(2),
                    receiptAmt.toFixed(2),
                    billAmt.toFixed(2),
                    invoiceAmt.toFixed(2),
                    orderAmt.toFixed(2),];
                var data2 = [_max - preReceiptAmt.toFixed(2),
                    _max - preBillAmt.toFixed(2),
                    _max - preInvoiceAmt.toFixed(2),
                    _max - preOrderAmt.toFixed(2),
                    _max - receiptAmt.toFixed(2),
                    _max - billAmt.toFixed(2),
                    _max - invoiceAmt.toFixed(2),
                    _max - orderAmt.toFixed(2),]
            }else{
                var orderAmt = leon.list.resultsList[index].ToDayOrderForAmt/10000;
                var invoiceAmt = leon.list.resultsList[index].ToDayInvoiceForAmt/10000;
                var billAmt = leon.list.resultsList[index].ToDayBillForAmt/10000;
                var receiptAmt = leon.list.resultsList[index].ToDayReceiptForAmt/10000;
                var preOrderAmt = leon.list.resultsList[index].ToDayReceiptForAmt/10000;
                var preInvoiceAmt = leon.list.resultsList[index].ToDayReceiptForAmt/10000;
                var preBillAmt = leon.list.resultsList[index].ToDayReceiptForAmt/10000;
                var preReceiptAmt = leon.list.resultsList[index].ToDayReceiptForAmt/10000;
                var _max = 1000;
                var data1 = [receiptAmt.toFixed(2),
                    billAmt.toFixed(2),
                    invoiceAmt.toFixed(2),
                    orderAmt.toFixed(2),
                ];
                var data2 = [
                    _max - receiptAmt.toFixed(2),
                    _max - billAmt.toFixed(2),
                    _max - invoiceAmt.toFixed(2),
                    _max - orderAmt.toFixed(2),
                ]
            }
            this.view.echartsNoData = false;
            var theme = {
                color: [
                    '#c24a59',
                    '#1082c2',
                    '#53a6c2',
                    '#6c66c2',
                    '#c29147',
                    '#f6df11',
                ],
            };
            this.view.echarts = echarts.init(document.getElementById('echarts'),theme);
            this.view.echarts.setOption({
                title: [{
                    text: leon.lang.salesResultsTable,
                    x: '50%',
                    textAlign: 'center'
                }],
                tooltip : {

                        },
                grid: [{
                    top: 50,
                    width: '90%',
                    height:'70%',
                    bottom: '45%',
                    left: 5,
                    containLabel: true
                }],
                legend: {
                    data:leon.lang.tubiaoTitle[leon.nowDateItem],
                },
                xAxis: [{
                    type: 'value',
                    max:_max,
                    splitLine: {
                        show: false
                    }
                }],
                yAxis: [{
                    type: 'category',
                    data:leon.lang.tubiaoTitle[leon.nowDateItem],
                    axisLabel: {
                        interval: 0,
                        rotate: 30
                    },
                    splitLine: {
                        show: false
                    }
                }],
                series: [{
                    type: 'bar',
                    stack: 'chart',
                    z: 3,
                    itemStyle: {
                        normal: {
                            color: function(params) {
                                // build a color map as your need.
                                var colorList = [
                                    '#ffd85c',
                                    '#37a2da',
                                    '#ffd85c',
                                    '#37a2da',
                                    '#ffd85c',
                                    '#37a2da',
                                    '#ffd85c',
                                    '#37a2da',
                                ];
                                return colorList[params.dataIndex]
                            }

                        }
                    },
                    label: {
                        normal: {
                            position: 'right',
                            show: true
                        }
                    },
                    data: data1
                }, {
                    type: 'bar',
                    stack: 'chart',
                    silent: true,
                    itemStyle: {
                        normal: {
                            color: '#eee'
                        }
                    },
                    data:data2
                }]
            });
        },
    }
});

function onlyNum() {
    if(!(event.keyCode==46)&&!(event.keyCode==8)&&!(event.keyCode==37)&&!(event.keyCode==39))
        if(!((event.keyCode>=48&&event.keyCode<=57)||(event.keyCode>=96&&event.keyCode<=105)))
            event.returnValue=false;
}
jq('#backMenu').click(function () {
    location.href='/Menu/Menu/menuLists?formKey='+jq("#form_key").val()+'&menuSelection='+jq("#menu_selection").val();
})
// if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
//     FastClick.prototype.focus = function(targetElement) {
//         targetElement.focus();
//     };
//     FastClick.attach(document.body);
// }

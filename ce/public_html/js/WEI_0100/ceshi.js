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
        monthSumItem:{
            'item':true,
            'active':false,
        },
        dayItem:{
            'item':true,
            'active':false,
        },
        nowDateItem:0,
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
            headerTitle:'每日统计表',
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
            transTitle:'',
            RMB:'',
            EUR:'',
            KOR:'',
            HKD:'',
            JPY:'',
            TWD:'',
            USD:'',
        },
        view:{
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
            getResults:'/WEI_0100/lists_prc',
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
            db:'SZ',
            currency:'RMB',
            targetAllAdmin:{value:'ALL',text:''},
            targetGroupAdmin:{value:'ALL',text:''},
            targetGroupAdmin_c:{value:'ALL',text:''},
            targetUser:{},
            leaderNm:'',
        },
        list:{
            db:[
                {value:'SZ',text:'苏州'},
                {value:'GD',text:'广东'},
                {value:'QD',text:'青岛'},
                {value:'HS',text:'汉斯'},
                {value:'XR',text:'先锐'},
                {value:'YBD',text:'毅比道'},
                {value:'CH',text:'中国'},
                {value:'EU',text:'欧洲'},
                {value:'SO',text:'东南亚'},
                {value:'OT',text:'其他'},
            ],
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
            summarizeList:[],
            orderListDisplay:[],
            invoiceListDisplay:[],
            billListDisplay:[],
            ReceiptDisplay:[],
            invoiceProListDisplay:[],
            minuteListDisplay:[],
            orderList:[],
            invoiceList:[],
            billList:[],
            receiptList:[],
            invoiceProList:[],
            sumData:{},
            sumDataDisplay:{},
            sumExternal:{},
            sumExternalDisplay:{},
            sumInternal:{},
            sumInternalDisplay:{},
        }
    },
    filters: {
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
            langCode.method = 'cache';
            langCode.getWord({

                    SUZHOU:'W2019010917151813357',
                    GUANGDONG:'W2019010917154884789',
                    QINGDAO:'W2019010917160016794',
                    HANS:'W2019110115053661645',
                    XIANRUI:'W2019110115053699355',
                    YIBIDAO:'W2020032613140479164',
                    // headerTitle:'W2018020109425972356',
                    growRate:'W2018020113401724334',//增长率
                    lastYear:'W2018122516062166764',
                    toYear:'W2018122516063785033',
                    menuBack:'W2018071009230638074',   //主菜单
                    expClass:'W2018041913341497746',//出口区分
                    currCd:'G2018102617102083724',//货币种类
                    headerTitle:'W2018122516284669743',

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
                    monthSum:'W2019050510083163086',
                    month:'G2018102617002367015',
                    day:'G2018102617005914777',
                    search:'W2018082711232500387',//查询
                    dataMinute:'G2018102617012216352',//详细数据
                    class:'G2018102617013950014',//区分
                    orderResults:'G2018102617015927383',//订单金额
                    invoiceResults:'G2018102617023163098',
                    billResults:'G2018102617053446374',
                    receiptResults:'G2018102617060001707',
                    MatOutAmt:'W2019061309463186003',//生产出库金额
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
        this.salesTargetDate = this.getNowDate();
    },
    methods:{
        //多语言转换完成回调
        _updateLang:function(){
            this.view.downLoadScript = false;
            this.list.expClass[0].text = this.lang.trust;
            this.list.expClass[1].text = this.lang.untrust;
            this.lang.nowUnit = this.lang.unitInfo;
            this.list.db = [
                {value:'SZ',text:this.lang.SUZHOU},
                {value:'GD',text:this.lang.GUANGDONG},
                {value:'QD',text:this.lang.QINGDAO},
                {value:'HS',text:this.lang.HANS},
                {value:'XR',text:this.lang.XIANRUI},
                {value:'YBD',text:this.lang.YIBIDAO},
                {value:'CH',text:'中国'},
                {value:'EU',text:'欧洲'},
                {value:'SO',text:'东南亚'},
                {value:'OT',text:'其他'},
                {value:'ALL',text:"所有"}
            ];
        },
        buildDataMinute:function(index){
            if(this.input.db == 'YBD'){
                return false;
            }
            switch (index){
                case 0:
                    leon.lang.transTitle = leon.lang.orderResults;
                    break;
                case 1:
                    leon.lang.transTitle = leon.lang.invoiceResults;
                    break;
                case 2:
                    leon.lang.transTitle = leon.lang.billResults;
                    break;
                case 3:
                    leon.lang.transTitle = leon.lang.receiptResults;
                    break;
                case 4:
                    leon.lang.transTitle = leon.lang.MatOutAmt;
                    break;
            }
            console.log(leon.list.billList)
            jq('.yudo-window').css({'animation-duration':'0.6s'});
            leon.view.dataMinute = true;
            if(JLAMP.common.getDevicePlatform() !== JLAMP.devicePlatform.iOS){
                multi.removeDefaultByClass('yudo-window',function () {
                });
            }
            mui.showLoading('loading');
            setTimeout(function () {
                switch (index){
                    case 0:
                        leon.list.sumDataDisplay = leon.list.sumData.order;
                        leon.list.sumExternalDisplay = leon.list.sumExternal.order;
                        leon.list.sumInternalDisplay = leon.list.sumInternal.order;
                        leon.list.minuteListDisplay = leon.list.orderList;
                        break;
                    case 1:
                        leon.list.sumDataDisplay = leon.list.sumData.invoice;
                        leon.list.sumExternalDisplay = leon.list.sumExternal.invoice;
                        leon.list.sumInternalDisplay = leon.list.sumInternal.invoice;
                        leon.list.minuteListDisplay = leon.list.invoiceList;
                        break;
                    case 2:
                        leon.list.sumDataDisplay = leon.list.sumData.bill;
                        leon.list.sumExternalDisplay = leon.list.sumExternal.bill;
                        leon.list.sumInternalDisplay = leon.list.sumInternal.bill;
                        leon.list.minuteListDisplay = leon.list.billList;
                        break;
                    case 3:
                        leon.list.sumDataDisplay = leon.list.sumData.receipt;
                        leon.list.sumExternalDisplay = leon.list.sumExternal.receipt;
                        leon.list.sumInternalDisplay = leon.list.sumInternal.receipt;
                        leon.list.minuteListDisplay = leon.list.receiptList;
                        break;
                    case 4:
                        leon.list.sumDataDisplay = leon.list.sumData.invoicePro;
                        leon.list.sumExternalDisplay = leon.list.sumExternal.invoicePro;
                        leon.list.sumInternalDisplay = leon.list.sumInternal.invoicePro;
                        leon.list.minuteListDisplay = leon.list.invoiceProList;
                        break;
                }
                mui.hideLoading('loading');
            },300)
        },
        closeDataMinute:function(index){
            leon.list.minuteListDisplay = [];
            jq('.yudo-window').css({'animation-duration':'0.2s'});
            multi.recoverDefaultByCss('yudo-window',function () {
                leon.view.viewTargetMinute = true;
                multi.removeTransByCss('yudo-window-trans',function () {
                    leon.view.dataMinute = false;
                });
            });
        },
        //切换年月日
        changeInfoItem:function (e) {
            if (e == this.nowDateItem) return false;
            mui.showLoading('loading');
            this.yearItem['active'] = false;
            this.monthItem['active'] = false;
            this.dayItem['active'] = false;
            this.monthSumItem['active'] = false;
            switch (e) {
                case 0:
                    this.nowDateItem = 0;
                    this.yearItem['active'] = true;

                    break;
                case 1:
                    this.nowDateItem = 1;
                    this.monthSumItem['active'] = true;
                    break;
                case 2:
                    this.nowDateItem = 2;
                    this.monthItem['active'] = true;
                    break;
                case 3:
                    this.nowDateItem = 3;
                    this.dayItem['active'] = true;
                    break;
            }
            setTimeout(function () {
                mui.hideLoading();
            }, 300)
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
            if(this.nowDateItem == 0){
                params.gubun = 'Y';
            }else if(this.nowDateItem == 1){
                params.gubun = 'MS';
            }else if(this.nowDateItem == 2){
                params.gubun = 'M';
            } else{
                params.gubun = 'D';
            }
            this.isactive = 0;
            if(this.view.echarts != '')this.view.echarts.clear();
            this.list.ResultsList = [];
            params.baseDate = this.salesTargetDate;
            if(this.input.db == 'ALL'){
                for (let i in this.list.db){
                    if(this.list.db[i].value == 'ALL'){
                        continue
                    }
                    if(this.list.db[i].value == 'YBD') params.serverId = 'YBD';
                    params.dbChoose = this.list.db[i].value
                    this.getData(params,'all')
                }
            }else{
                if(this.input.db == 'YBD') params.serverId = 'YBD';
                params.dbChoose = this.input.db
                 
                if(this.input.db == 'CH'||this.input.db == 'EU'||this.input.db == 'SO'||this.input.db == 'OT'){
                    params.serverId = this.input.db;params.dbChoose = '';leon.list.cs = true;
                } else {
                    leon.list.cs = false;
                }
                this.getData(params,'')
            }

        },
        getData(params,check){
            http.get(this.api.getResults,params,res => {
                console.log(res);
                var expClass = function () {
                    return {
                        external:[], internal:[]
                    }
                }
                var protocol = function () {
                    return {
                        order:{percent:0,ForAmt:0,ForAmt_Pre:0},
                        invoice:{percent:0,ForAmt:0,ForAmt_Pre:0},
                        bill:{percent:0,ForAmt:0,ForAmt_Pre:0},
                        receipt:{percent:0,ForAmt:0,ForAmt_Pre:0},
                        invoicePro:{percent:0,ForAmt:0,ForAmt_Pre:0}
                    }
                }
                var defaultData = function (data) {
                    data.order.ForAmt_Pre = '-';
                    data.order.percent = '0.00';
                    data.invoice.ForAmt_Pre = '-';
                    data.invoice.percent = '0.00';
                    data.bill.ForAmt_Pre = '-';
                    data.bill.percent = '0.00';
                    data.receipt.ForAmt_Pre = '-';
                    data.receipt.percent = '0.00';
                    data.invoicePro.ForAmt_Pre = '-';
                    data.invoicePro.percent = '0.00';
                }
                var defaultMinuteData = function (data) {
                    for(var i in data.internal){
                        data.internal[i].ForAmt_Pre = '-';
                        data.internal[i].percent = '0.00';
                    }
                    for(var i in data.external){
                        data.external[i].ForAmt_Pre = '-';
                        data.external[i].percent = '0.00';
                    }
                }
                var orderList = expClass();
                var invoiceList = expClass();
                var billList = expClass();
                var receiptList = expClass();
                var invoiceProList = expClass();
                var sumExternal = protocol();
                var sumInternal = protocol();
                var sumData = protocol();
                var summarize = [];
                //.毅比道数据特殊处理
                if (params.dbChoose == 'YBD'){
                    var orderPercent = (((res.data.Order.FForamount-res.data.Order.FForamountPre)/(res.data.Order.FForamountPre == 0 ?100:res.data.Order.FForamountPre))*100).toFixed(2);
                    var invoicePercent = (((res.data.Invoice.FForamount-res.data.Invoice.FForamountPre)/(res.data.Invoice.FForamountPre == 0 ?100:res.data.Invoice.FForamountPre))*100).toFixed(2);
                    var billPercent = (((res.data.Bill.FForamount-res.data.Bill.FForamountPre)/(res.data.Bill.FForamountPre == 0 ?100:res.data.Bill.FForamountPre))*100).toFixed(2);
                    var receivePercent = (((res.data.Receive.FForamount-res.data.Receive.FForamountPre)/(res.data.Receive.FForamountPre == 0 ?100:res.data.Receive.FForamountPre))*100).toFixed(2);
                    summarize.push({
                        name:leon.lang.orderResults,
                        ForAmt:parseFloat(res.data.Order.FForamount/10000).toFixed(2),
                        ForAmt_Pre:parseFloat(res.data.Order.FForamountPre/10000).toFixed(2),
                        percent:orderPercent,
                        percentColor: orderPercent < 0 ? '#07be00' : '#ff6259'
                    });

                    summarize.push({
                        name:leon.lang.invoiceResults,
                        ForAmt:parseFloat(res.data.Invoice.FForamount/10000).toFixed(2),
                        ForAmt_Pre:parseFloat(res.data.Invoice.FForamountPre/10000).toFixed(2),
                        percent:invoicePercent,
                        percentColor: invoicePercent < 0 ? '#07be00' : '#ff6259'
                    });
                    summarize.push({
                        name:leon.lang.billResults,
                        ForAmt:parseFloat(res.data.Bill.FForamount/10000).toFixed(2),
                        ForAmt_Pre:parseFloat(res.data.Bill.FForamountPre/10000).toFixed(2),
                        percent:billPercent,
                        percentColor: billPercent < 0 ? '#07be00' : '#ff6259'
                    });
                    summarize.push({
                        name:leon.lang.receiptResults,
                        ForAmt:parseFloat(res.data.Receive.FForamount/10000).toFixed(2),
                        ForAmt_Pre:parseFloat(res.data.Receive.FForamountPre/10000).toFixed(2),
                        percent:receivePercent,
                        percentColor: receivePercent < 0 ? '#07be00' : '#ff6259'
                    });
                    if(check == 'all'){
                        for(let i in summarize){
                            leon.list.summarizeList[i].ForAmt = summarize[i].ForAmt + (leon.list.summarizeList[i].ForAmt || 0);
                            leon.list.summarizeList[i].ForAmt_Pre = summarize[i].ForAmt_Pre + (leon.list.summarizeList[i].ForAmt_Pre || 0);
                        }

                    }else{
                        leon.list.summarizeList = summarize;
                    }
                    leon.view.targetNoData = false;
                    leon.view.echartsNoData = false;
                    return;
                }


                if(params.dbChoose == ''){
                 console.log('____|||||yuzh|||__________')
                    console.log(res);
                    console.log('____|||||yuzh|||__________')
                        // ForAmt += OrderForAmt + InvoiceForAmt + BillForAmt + ReceiptForAmt + ProductrForAmt;
                        // ForAmt_Pre += OrderForAmt_Pre + InvoiceForAmt_Pre + BillForAmt_Pre + ReceiptForAmt_Pre + ProductrForAmt_Pre;
                    var orderPercent = (((res.data.ToOrderForAmt-res.data.ToOrderForAmt_Pre)/(res.data.ToOrderForAmt_Pre == 0 ?100:res.data.ToOrderForAmt_Pre))*100).toFixed(2);
                    var invoicePercent = (((res.data.ToInvoiceForAmt-res.data.ToInvoiceForAmt_Pre)/(res.data.ToInvoiceForAmt_Pre == 0 ?100:res.data.ToInvoiceForAmt_Pre))*100).toFixed(2);
                    var billPercent = (((res.data.ToBillForAmt-res.data.ToBillForAmt_Pre)/(res.data.ToBillForAmt_Pre == 0 ?100:res.data.ToBillForAmt_Pre))*100).toFixed(2);
                    var receivePercent = (((res.data.ToReceiptForAmt-res.data.ToReceiptForAmt_Pre)/(res.data.ToReceiptForAmt_Pre == 0 ?100:res.data.ToReceiptForAmt_Pre))*100).toFixed(2);
                    var productrPercent = (((res.data.ToProductrForAmt-res.data.ToProductrForAmt_Pre)/(res.data.ToProductrForAmt_Pre == 0 ?100:res.data.ToProductrForAmt_Pre))*100).toFixed(2);

                    summarize.push({
                        name:leon.lang.orderResults,
                        ForAmt:parseFloat(res.data.ToOrderForAmt/10000).toFixed(2),
                        ForAmt_Pre:parseFloat(res.data.ToOrderForAmt_Pre/10000).toFixed(2),
                        percent:orderPercent,
                        percentColor: orderPercent < 0 ? '#07be00' : '#ff6259'
                    });

                    summarize.push({
                        name:leon.lang.invoiceResults,
                        ForAmt:parseFloat(res.data.ToInvoiceForAmt/10000).toFixed(2),
                        ForAmt_Pre:parseFloat(res.data.ToInvoiceForAmt_Pre/10000).toFixed(2),
                        percent:invoicePercent,
                        percentColor: invoicePercent < 0 ? '#07be00' : '#ff6259'
                    });
                    summarize.push({
                        name:leon.lang.billResults,
                        ForAmt:parseFloat(res.data.ToBillForAmt/10000).toFixed(2),
                        ForAmt_Pre:parseFloat(res.data.ToBillForAmt_Pre/10000).toFixed(2),
                        percent:billPercent,
                        percentColor: billPercent < 0 ? '#07be00' : '#ff6259'
                    });
                    summarize.push({
                        name:leon.lang.receiptResults,
                        ForAmt:parseFloat(res.data.ToReceiptForAmt/10000).toFixed(2),
                        ForAmt_Pre:parseFloat(res.data.ToReceiptForAmt_Pre/10000).toFixed(2),
                        percent:receivePercent,
                        percentColor: receivePercent < 0 ? '#07be00' : '#ff6259'
                    });
                    summarize.push({
                        name:leon.lang.MatOutAmt,
                        ForAmt:parseFloat(res.data.ToProductrForAmt/10000).toFixed(2),
                        ForAmt_Pre:parseFloat(res.data.ToProductrForAmt_Pre/10000).toFixed(2),
                        percent:productrPercent,
                        percentColor: productrPercent < 0 ? '#07be00' : '#ff6259'
                    });
                  
                            // res.data.res[i].percent = (((res.data.res[i].ForAmt-res.data.res[i].ForAmt_Pre)/(res.data.res[i].ForAmt_Pre == 0 ?100:res.data.res[i].ForAmt_Pre))*100).toFixed(2);
                            // res.data.res[i].ForAmt = parseFloat(parseFloat(res.data.res[i].ForAmt).toFixed(2));
                            // res.data.res[i].ForAmt_Pre =  parseFloat(parseFloat(res.data.res[i].ForAmt_Pre).toFixed(2));
                            // res.data.res[i].DeptNm =  res.data.res[i].cmm_nm;
                        

                    
                        sumData.order.ForAmt = res.data.ToOrderForAmt;
                        sumData.invoice.ForAmt = res.data.ToInvoiceForAmt;
                        sumData.bill.ForAmt = res.data.ToBillForAmt;
                        sumData.receipt.ForAmt = res.data.ToReceiptForAmt;
                        sumData.invoicePro.ForAmt = res.data.ToProductrForAmt;

                        sumData.order.ForAmt_Pre = res.data.ToOrderForAmt_Pre;
                        sumData.invoice.ForAmt_Pre = res.data.ToInvoiceForAmt_Pre;
                        sumData.bill.ForAmt_Pre = res.data.ToBillForAmt_Pre;
                        sumData.receipt.ForAmt_Pre = res.data.ToReceiptForAmt_Pre;
                        sumData.invoicePro.ForAmt_Pre = res.data.ToProductrForAmt_Pre;


                        sumData.order.percent = parseFloat(res.data.order.percent/10000).toFixed(2);
                        sumData.invoice.percent = parseFloat(res.data.invoice.percent/10000).toFixed(2);
                        sumData.bill.percent = parseFloat(res.data.bill.percent/10000).toFixed(2);
                        sumData.receipt.percent = parseFloat(res.data.receipt.percent/10000).toFixed(2);
                        sumData.invoicePro.percent = parseFloat(res.data.productr.percent/10000).toFixed(2);

                  
             // console.log(sumData.bill.ForAmt);
                        // orderList.internal.push(res.data.res.internal);
                        // invoiceList.internal.push(res.data.res.internal);
                        // billList.internal.push(res.data.res.internal);
                        // receiptList.internal.push(res.data.res.internal);
                        // invoiceProList.internal.push(res.data.res.internal);

                        for(var i in res.data.orderList){
                            res.data.orderList[i].percent = res.data.orderList[i].percent.toFixed(2);
                            res.data.orderList[i].ForAmt = res.data.orderList[i].ForAmt.toFixed(2);
                            res.data.orderList[i].ForAmt_Pre = res.data.orderList[i].ForAmt_Pre.toFixed(2);

                            orderList.external.push(res.data.orderList[i]);
                        }
                        for(var i in res.data.invoiceList){
                            res.data.invoiceList[i].percent = res.data.invoiceList[i].percent.toFixed(2);
                            res.data.invoiceList[i].ForAmt = res.data.invoiceList[i].ForAmt.toFixed(2);
                            res.data.invoiceList[i].ForAmt_Pre = res.data.invoiceList[i].ForAmt_Pre.toFixed(2);
                            invoiceList.external.push(res.data.invoiceList[i]);
                        }
                        for(var i in res.data.billList){
                            res.data.billList[i].percent = res.data.billList[i].percent.toFixed(2);
                            res.data.billList[i].ForAmt = res.data.billList[i].ForAmt.toFixed(2);
                            res.data.billList[i].ForAmt_Pre = res.data.billList[i].ForAmt_Pre.toFixed(2);
                            billList.external.push(res.data.billList[i]);
                        }
                        for(var i in res.data.receiptList){
                            res.data.receiptList[i].percent = res.data.receiptList[i].percent.toFixed(2);
                            res.data.receiptList[i].ForAmt = res.data.receiptList[i].ForAmt.toFixed(2);
                            res.data.receiptList[i].ForAmt_Pre = res.data.receiptList[i].ForAmt_Pre.toFixed(2);
                            receiptList.external.push(res.data.receiptList[i]);
                        }
                        for(var i in res.data.invoiceProList){
                            res.data.invoiceProList[i].percent = res.data.invoiceProList[i].percent.toFixed(2);
                            res.data.invoiceProList[i].ForAmt = res.data.invoiceProList[i].ForAmt.toFixed(2);
                            res.data.invoiceProList[i].ForAmt_Pre = res.data.invoiceProList[i].ForAmt_Pre.toFixed(2);
                            invoiceProList.external.push(res.data.invoiceProList[i]);
                        }

                        sumInternal.order.ForAmt = 0;
                        sumInternal.order.ForAmt_Pre = 0;

                        sumInternal.invoice.ForAmt =0;
                        sumInternal.invoice.ForAmt_Pre = 0;

                        sumInternal.bill.ForAmt = 0;
                        sumInternal.bill.ForAmt_Pre = 0;

                        sumInternal.receipt.ForAmt = 0;
                        sumInternal.receipt.ForAmt_Pre = 0;

                        sumInternal.invoicePro.ForAmt = 0;
                        sumInternal.invoicePro.ForAmt_Pre = 0;

                        sumExternal.order.ForAmt = res.data.ToOrderForAmt;
                        sumExternal.order.ForAmt_Pre = res.data.ToOrderForAmt_Pre;
                        sumExternal.order.percent = res.data.order.percent.toFixed(2);
                        sumExternal.order.percentColor = res.data.order.percentColor;
                        sumExternal.order.percentMinuteColor = res.data.order.percentMinuteColor;

                        sumExternal.invoice.ForAmt = res.data.ToInvoiceForAmt;
                        sumExternal.invoice.ForAmt_Pre = res.data.ToInvoiceForAmt_Pre;
                        sumExternal.invoice.percent = res.data.invoice.percent.toFixed(2);
                        sumExternal.invoice.percentColor = res.data.invoice.percentColor;
                        sumExternal.invoice.percentMinuteColor = res.data.invoice.percentMinuteColor;

                        sumExternal.bill.ForAmt = res.data.ToBillForAmt;
                        sumExternal.bill.ForAmt_Pre = res.data.ToBillForAmt_Pre;
                        sumExternal.bill.percent = res.data.bill.percent.toFixed(2);
                        sumExternal.bill.percentColor = res.data.bill.percentColor;
                        sumExternal.bill.percentMinuteColor = res.data.bill.percentMinuteColor;

                        sumExternal.receipt.ForAmt = res.data.ToReceiptForAmt;
                        sumExternal.receipt.ForAmt_Pre = res.data.ToReceiptForAmt_Pre;
                        sumExternal.receipt.percent = res.data.invoice.percent.toFixed(2);
                        sumExternal.receipt.percentColor = res.data.receipt.percentColor;
                        sumExternal.receipt.percentMinuteColor = res.data.receipt.percentMinuteColor;

                        sumExternal.invoicePro.ForAmt = res.data.ToProductrForAmt;
                        sumExternal.invoicePro.ForAmt_Pre = res.data.ToProductrForAmt_Pre;
                        sumExternal.invoicePro.percent = res.data.productr.percent.toFixed(2);
                        sumExternal.invoicePro.percentColor = res.data.productr.percentColor;
                        sumExternal.invoicePro.percentMinuteColor = res.data.productr.percentMinuteColor;

                        // for(var i in res.data.res){

                        //     sumExternal.order.ForAmt += res.data.res[i].OrderForAmt;
                        //     sumExternal.order.ForAmt_Pre += res.data.res[i].OrderForAmt_Pre;
                        //     sumExternal.invoice.ForAmt += res.data.res[i].InvoiceForAmt;
                        //     sumExternal.invoice.ForAmt_Pre += res.data.res[i].InvoiceForAmt_Pre;
                        //     sumExternal.bill.ForAmt += res.data.res[i].BillForAmt;
                        //     sumExternal.bill.ForAmt_Pre += res.data.res[i].BillForAmt_Pre;
                        //     sumExternal.receipt.ForAmt += res.data.res[i].ReceiptForAmt;
                        //     sumExternal.receipt.ForAmt_Pre += res.data.res[i].ReceiptForAmt_Pre;
                        //     sumExternal.invoicePro.ForAmt += res.data.res[i].ProductrForAmt;
                        //     sumExternal.invoicePro.ForAmt_Pre += res.data.res[i].ProductrForAmt_Pre;
                                                
                        // }
                    //Sort == 100 订单金额  200-出库金额  300-发票  400-收款  500-生产出库
                    
                
                }else{
                    res.data.res.splice(0,1)
                    for(var i in res.data.res){
                        res.data.res[i].percent = (((res.data.res[i].ForAmt-res.data.res[i].ForAmt_Pre)/(res.data.res[i].ForAmt_Pre == 0 ?100:res.data.res[i].ForAmt_Pre))*100).toFixed(2);
                        res.data.res[i].ForAmt = parseFloat(parseFloat(res.data.res[i].ForAmt).toFixed(2));
                        res.data.res[i].ForAmt_Pre =  parseFloat(parseFloat(res.data.res[i].ForAmt_Pre).toFixed(2));
                        if(res.data.res[i].percent < 0){
                            res.data.res[i].percentColor = '#07be00';
                            res.data.res[i].percentMinuteColor = '#159a00';
                        }else{
                            res.data.res[i].percentColor = '#ff6259';
                            res.data.res[i].percentMinuteColor = '#e02a27';
                        }
                        if(res.data.res[i].Sort == 110){
                            res.data.res[i].name = leon.lang.orderResults;
                            summarize.push(res.data.res[i]);
                        }
                        else if(res.data.res[i].Sort == 210){
                            res.data.res[i].name = leon.lang.invoiceResults;
                            summarize.push(res.data.res[i]);
                        }
                        else if(res.data.res[i].Sort == 310){
                            res.data.res[i].name = leon.lang.billResults;
                            summarize.push(res.data.res[i]);
                        }
                        else if(res.data.res[i].Sort == 410){
                            res.data.res[i].name = leon.lang.receiptResults;
                            summarize.push(res.data.res[i]);
                        }
                        else if(res.data.res[i].Sort == 510){
                            res.data.res[i].name = leon.lang.MatOutAmt;
                            summarize.push(res.data.res[i]);
                        }
                        else if(res.data.res[i].Sort == 100){
                            sumData.order.ForAmt += res.data.res[i].ForAmt;
                            sumData.order.ForAmt_Pre += res.data.res[i].ForAmt_Pre;
                            if(res.data.res[i].ExternalGubnNm == 'External'){
                                sumExternal.order.ForAmt += res.data.res[i].ForAmt;
                                sumExternal.order.ForAmt_Pre += res.data.res[i].ForAmt_Pre;
                                orderList.external.push(res.data.res[i])
                            }else{
                                sumInternal.order.ForAmt += res.data.res[i].ForAmt;
                                sumInternal.order.ForAmt_Pre += res.data.res[i].ForAmt_Pre;
                                orderList.internal.push(res.data.res[i])
                            }
                        }
                        else if(res.data.res[i].Sort == 200){
                            sumData.invoice.ForAmt += res.data.res[i].ForAmt;
                            sumData.invoice.ForAmt_Pre += res.data.res[i].ForAmt_Pre;
                            if(res.data.res[i].ExternalGubnNm == 'External'){
                                sumExternal.invoice.ForAmt += res.data.res[i].ForAmt;
                                sumExternal.invoice.ForAmt_Pre += res.data.res[i].ForAmt_Pre;
                                invoiceList.external.push(res.data.res[i])
                            }else{
                                sumInternal.invoice.ForAmt += res.data.res[i].ForAmt;
                                sumInternal.invoice.ForAmt_Pre += res.data.res[i].ForAmt_Pre;
                                invoiceList.internal.push(res.data.res[i])
                            }
                        }
                        else if(res.data.res[i].Sort == 300){
                            sumData.bill.ForAmt += res.data.res[i].ForAmt;
                            sumData.bill.ForAmt_Pre += res.data.res[i].ForAmt_Pre;
                            if(res.data.res[i].ExternalGubnNm == 'External'){
                                sumExternal.bill.ForAmt += res.data.res[i].ForAmt;
                                sumExternal.bill.ForAmt_Pre += res.data.res[i].ForAmt_Pre;
                                billList.external.push(res.data.res[i])
                            }else{
                                sumInternal.bill.ForAmt += res.data.res[i].ForAmt;
                                sumInternal.bill.ForAmt_Pre += res.data.res[i].ForAmt_Pre;
                                billList.internal.push(res.data.res[i])
                            }
                        }
                        else if(res.data.res[i].Sort == 400){
                            sumData.receipt.ForAmt += res.data.res[i].ForAmt;
                            sumData.receipt.ForAmt_Pre += res.data.res[i].ForAmt_Pre;
                            if(res.data.res[i].ExternalGubnNm == 'External'){
                                sumExternal.receipt.ForAmt += res.data.res[i].ForAmt;
                                sumExternal.receipt.ForAmt_Pre += res.data.res[i].ForAmt_Pre;
                                receiptList.external.push(res.data.res[i])
                            }else{
                                sumInternal.receipt.ForAmt += res.data.res[i].ForAmt;
                                sumInternal.receipt.ForAmt_Pre += res.data.res[i].ForAmt_Pre;
                                receiptList.internal.push(res.data.res[i])
                            }
                        }
                        else if(res.data.res[i].Sort == 500){
                            sumData.invoicePro.ForAmt += res.data.res[i].ForAmt;
                            sumData.invoicePro.ForAmt_Pre += res.data.res[i].ForAmt_Pre;
                            if(res.data.res[i].ExternalGubnNm == 'External'){
                                sumExternal.invoicePro.ForAmt += res.data.res[i].ForAmt;
                                sumExternal.invoicePro.ForAmt_Pre += res.data.res[i].ForAmt_Pre;
                                invoiceProList.external.push(res.data.res[i])
                            }else{
                                sumInternal.invoicePro.ForAmt += res.data.res[i].ForAmt;
                                sumInternal.invoicePro.ForAmt_Pre += res.data.res[i].ForAmt_Pre;
                                invoiceProList.internal.push(res.data.res[i])
                            }
                        }
                    }
                }
                var switchData = function(sum){
                    sum.order.ForAmt = sum.order.ForAmt.toFixed(2);
                    sum.order.ForAmt_Pre = sum.order.ForAmt_Pre.toFixed(2);
                    sum.invoice.ForAmt = sum.invoice.ForAmt.toFixed(2);
                    sum.invoice.ForAmt_Pre = sum.invoice.ForAmt_Pre.toFixed(2);
                    sum.bill.ForAmt = sum.bill.ForAmt.toFixed(2);
                    sum.bill.ForAmt_Pre = sum.bill.ForAmt_Pre.toFixed(2);
                    sum.receipt.ForAmt = sum.receipt.ForAmt.toFixed(2);
                    sum.receipt.ForAmt_Pre = sum.receipt.ForAmt_Pre.toFixed(2);
                    sum.invoicePro.ForAmt = sum.invoicePro.ForAmt.toFixed(2);
                    sum.invoicePro.ForAmt_Pre = sum.invoicePro.ForAmt_Pre.toFixed(2);
                    sum.order.percent = ((sum.order.ForAmt - sum.order.ForAmt_Pre) / (sum.order.ForAmt_Pre == 0 ? 100:sum.order.ForAmt_Pre)*100).toFixed(2);
                    sum.invoice.percent = ((sum.invoice.ForAmt - sum.invoice.ForAmt_Pre) / (sum.invoice.ForAmt_Pre == 0 ? 100:sum.invoice.ForAmt_Pre)*100).toFixed(2);
                    sum.bill.percent = ((sum.bill.ForAmt - sum.bill.ForAmt_Pre) / (sum.bill.ForAmt_Pre == 0 ? 100:sum.bill.ForAmt_Pre)*100).toFixed(2);
                    sum.receipt.percent = ((sum.receipt.ForAmt - sum.receipt.ForAmt_Pre) / (sum.receipt.ForAmt_Pre == 0 ? 100:sum.receipt.ForAmt_Pre)*100).toFixed(2);
                    sum.invoicePro.percent = ((sum.invoicePro.ForAmt - sum.invoicePro.ForAmt_Pre) / (sum.invoicePro.ForAmt_Pre == 0 ? 100:sum.invoicePro.ForAmt_Pre)*100).toFixed(2);

                }
                switchData(sumExternal);
                if(params.dbChoose != ''){
                    switchData(sumInternal);
                }
                // switchData(sumInternal);
                switchData(sumData);
                //.当选择日单位，不显示去年信息
                // if(leon.nowDateItem == 3){
                //     for(var i in summarize){
                //         summarize[i].ForAmt_Pre = '-';
                //         summarize[i].percent = '0.00'
                //     }
                //     defaultData(sumData);
                //     defaultData(sumExternal);
                //     defaultData(sumInternal);
                //     defaultMinuteData(orderList);
                //     defaultMinuteData(invoiceList);
                //     defaultMinuteData(billList);
                //     defaultMinuteData(receiptList);
                //     defaultMinuteData(invoiceProList);
                // }
                leon.list.sumData = sumData;
                leon.list.sumExternal = sumExternal;
                leon.list.sumInternal = sumInternal;
                leon.list.orderList = orderList;
                leon.list.invoiceList = invoiceList;
                leon.list.billList = billList;
                leon.list.receiptList = receiptList;
                leon.list.invoiceProList = invoiceProList;

                if(check == 'all'){
                    for(let i in summarize){
                        leon.list.summarizeList[i].ForAmt = summarize[i].ForAmt + (leon.list.summarizeList[i].ForAmt || 0);
                        leon.list.summarizeList[i].ForAmt_Pre = summarize[i].ForAmt_Pre + (leon.list.summarizeList[i].ForAmt_Pre || 0);
                    }
                }else{
                    leon.list.summarizeList = summarize;
                }
                leon.view.targetNoData = false;
                leon.view.echartsNoData = false;
                // leon.getResultsMinute(0);

            });
        }
    }
});

function onlyNum() {
    if(!(event.keyCode==46)&&!(event.keyCode==8)&&!(event.keyCode==37)&&!(event.keyCode==39))
        if(!((event.keyCode>=48&&event.keyCode<=57)||(event.keyCode>=96&&event.keyCode<=105)))
            event.returnValue=false;
}
// if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
//     FastClick.prototype.focus = function(targetElement) {
//         targetElement.focus();
//     };
//     FastClick.attach(document.body);
// }
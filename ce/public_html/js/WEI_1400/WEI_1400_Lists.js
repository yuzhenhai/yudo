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
            targetAndResults:'每日统计表_SZ',
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
            getResults:'/WEI_1400/lists_prc',
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
            db:'',
            currency:'RMB',
            targetAllAdmin:{value:'ALL',text:''},
            targetGroupAdmin:{value:'ALL',text:''},
            targetGroupAdmin_c:{value:'ALL',text:''},
            targetUser:{},
            leaderNm:'',
        },
        list:{
            db:[
                {value:'',text:'选择数据库'},
                {value:'SZ',text:'苏州'},
                {value:'GD',text:'广东'},
                {value:'QD',text:'青岛'}
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
            orderListDisplay:[],
            invoiceListDisplay:[],
            billListDisplay:[],
            ReceiptDisplay:[],
            invoiceProListDisplay:[],
            orderList:[],
            invoiceList:[],
            billList:[],
            ReceiptList:[],
            invoiceProList:[],
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
        mui.showLoading();
        try {
            langCode.getWord({
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
        this.salesTargetDate = this.getNowDate();
    },
    methods:{
        //多语言转换完成回调
        _updateLang:function(){
            mui.hideLoading();
            this.view.downLoadScript = false;
            this.list.expClass[0].text = this.lang.trust;
            this.list.expClass[1].text = this.lang.untrust;
            this.lang.nowUnit = this.lang.unitInfo;
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
            params.baseDate = this.salesTargetDate;
            params.gubun = 'y';
            params.dbChoose = this.input.db;
            this.isactive = 0;
            if(this.view.echarts != '')this.view.echarts.clear();
            this.list.ResultsList = [];
            http.get(this.api.getResults,params,function (res) {
                console.log(res);
                var orderList = [];
                var invoiceList = [];
                var billList = [];
                var receiptList = [];
                var invoiceProList = [];
                res.data.res.splice(0,1)
                for(var i in res.data.res){
                    res.data.res[i].percent = (((res.data.res[i].ForAmt-res.data.res[i].ForAmt_Pre)/(res.data.res[i].ForAmt == 0 ?1:res.data.res[i].ForAmt))*100).toFixed(2)+'%';
                    res.data.res[i].ForAmt = parseFloat(res.data.res[i].ForAmt).toFixed(2);
                    res.data.res[i].ForAmt_Pre = parseFloat(res.data.res[i].ForAmt_Pre).toFixed(2);
                    if(res.data.res[i].Sort == 100 || res.data.res[i].Sort == 110){
                        orderList.push(res.data.res[i]);
                    }
                    if(res.data.res[i].Sort == 200 || res.data.res[i].Sort == 210){
                        invoiceList.push(res.data.res[i]);
                    }
                    if(res.data.res[i].Sort == 300 || res.data.res[i].Sort == 310){
                        billList.push(res.data.res[i]);
                    }
                    if(res.data.res[i].Sort == 400 || res.data.res[i].Sort == 410){
                        receiptList.push(res.data.res[i]);
                    }
                    if(res.data.res[i].Sort == 500 || res.data.res[i].Sort == 510){
                        invoiceProList.push(res.data.res[i]);
                    }
                }
                var protocol1 = {
                    ExternalGubnNm:'订单', ExternalGubun:'', ForAmt:'', ForAmt_Pre:'', Sort:''
                }
                var protocol2 = {
                    ExternalGubnNm:'送货', ExternalGubun:'', ForAmt:'', ForAmt_Pre:'', Sort:''
                }
                var protocol3 = {
                    ExternalGubnNm:'出票', ExternalGubun:'', ForAmt:'', ForAmt_Pre:'', Sort:''
                }
                var protocol4 = {
                    ExternalGubnNm:'收款', ExternalGubun:'', ForAmt:'', ForAmt_Pre:'', Sort:''
                }
                var protocol5 = {
                    ExternalGubnNm:'生产出库', ExternalGubun:'', ForAmt:'', ForAmt_Pre:'', Sort:''
                }
                leon.list.orderList = orderList;
                leon.list.invoiceList = invoiceList;
                leon.list.billListList = billList;
                leon.list.receiptList = receiptList;
                leon.list.invoiceProList = invoiceProList;
                orderList.unshift(protocol1);
                invoiceList.unshift(protocol2);
                billList.unshift(protocol3);
                receiptList.unshift(protocol4);
                invoiceProList.unshift(protocol5);
                leon.list.orderListDisplay = orderList;
                leon.list.invoiceListDisplay = invoiceList;
                leon.list.billListDisplay = billList;
                leon.list.receiptListDisplay = receiptList;
                leon.list.invoiceProListDisplay = invoiceProList;
                leon.view.targetNoData = false;
                leon.view.echartsNoData = false;
                // leon.getResultsMinute(0);

            });
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
        //生成柱状图
        buildHistogram:function (index) {
            this.view.echartsNoData = false;
            var theme = {
                color: [
                    '#c24a59',
                    '#1082c2',
                    '#53a6c2',
                    '#6c66c2',
                    '#c29147',
                ],
            };
            this.view.echarts = echarts.init(document.getElementById('echarts'),theme);
            this.view.echarts.setOption({
                title : {
                },
                tooltip : {
                    trigger: 'axis',
                    confine:true,
                },
                legend: {
                    data:[
                        '订单业绩','出库业绩','发票业绩','收款业绩','生产出库'
                    ]
                },
                toolbox: {
                    show : false,
                    feature : {

                    }
                },
                calculable : true,
                xAxis : [
                    {
                        type : 'category',
                        data : [
                            '订单业绩',
                            '出库业绩',
                            '发票业绩',
                            '收款业绩',
                            '生产出库'
                        ]
                    }
                ],
                yAxis : [
                    {
                        type : 'value'
                    }
                ],
                series : [{
                    name: '金额',
                    type: 'bar',
                    data: [
                        {value:leon.list.resultsList[index].ToDayOrderForAmt, name:'订单业绩'},
                        {value:leon.list.resultsList[index].ToDayInvoiceForAmt, name:'出库业绩'},
                        {value:leon.list.resultsList[index].ToDayBillForAmt, name:'发票业绩'},
                        {value:leon.list.resultsList[index].ToDayReceiptForAmt, name:'收款业绩'},
                        {value:leon.list.resultsList[index].ToDayProductForAmt, name:'生产出库'}
                    ],
                    itemStyle: {
                        normal: {
                            label: {
                                show: true, //开启显示
                                position: 'top', //在上方显示
                                textStyle: { //数值样式
                                    color: '#2196ff',
                                    fontSize: 11
                                }
                            },
                            color: function(params) {
                                // build a color map as your need.
                                var colorList = [
                                    '#ff6071',
                                    '#2395ff',
                                    '#6acdf0',
                                    '#89d846',
                                    '#f6df11',
                                ];
                                return colorList[params.dataIndex]
                            }
                        }
                    }
                }]
            });
            // this.view.echarts = echarts.init(document.getElementById('echarts'));
            // this.view.echarts.setOption({
            //     title : {
            //         // text: '南丁格尔玫瑰图',
            //         x:'center'
            //     },
            //     tooltip : {
            //         trigger: 'item',
            //         formatter: "{a} <br/>{b} : {c} ({d}%)"
            //     },
            //     legend: {
            //         x : 'center',
            //         y : '5px',
            //         data:['订单业绩','出库业绩','发票业绩','收款业绩','生产出库']
            //     },
            //     toolbox: {
            //         show : true,
            //         feature : {
            //             mark : {show: true},
            //             // dataView : {show: true, readOnly: false},
            //             magicType : {
            //                 show: true,
            //                 type: ['pie', 'funnel']
            //             },
            //         }
            //     },
            //     calculable : true,
            //     series : [
            //         {
            //             name:'销售统计',
            //             type:'pie',
            //             radius : [30, 110],
            //             center : ['50%', '55%'],
            //             roseType : 'area',
            //             data:[
            //                 {value:leon.list.resultsList[index].ToDayOrderForAmt, name:'订单业绩'},
            //                 {value:leon.list.resultsList[index].ToDayInvoiceForAmt, name:'出库业绩'},
            //                 {value:leon.list.resultsList[index].ToDayBillForAmt, name:'发票业绩'},
            //                 {value:leon.list.resultsList[index].ToDayReceiptForAmt, name:'收款业绩'},
            //                 {value:leon.list.resultsList[index].ToDayProductForAmt, name:'生产出库'},
            //             ]
            //         }
            //     ]
            // });
        }
    }
});

function onlyNum() {
    if(!(event.keyCode==46)&&!(event.keyCode==8)&&!(event.keyCode==37)&&!(event.keyCode==39))
        if(!((event.keyCode>=48&&event.keyCode<=57)||(event.keyCode>=96&&event.keyCode<=105)))
            event.returnValue=false;
}
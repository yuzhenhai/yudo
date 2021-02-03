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
            headerTitle:'每日统计表_Markets',
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
            getResults:'/WEI_1420/queryResults',
            getFilialeList:'/WEI_1420/getFilialeList',
            getDeptList:'/WEI_1420/getDeptId',
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
            targetDate:'',
            searchGroup:'C001',
            expClass:'',
            groupClass:'',
            deptCd:'',
            currency:'RMB',
            leaderNm:'',
        },
        list:{
            groupClass:[],
            deptCd:[],
            //出口区分
            expClass:[
                {value:'',text:'出口区分选择'},
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
                return '<div class="yudo-label label-sucess" style="float: right">'+leon.lang.isConfirm+'</div>';
            }else{
                return '<div class="yudo-label label-default" style="float: right">'+leon.lang.noConfirm+'</div>';
            }
        }
    },
    mounted(){
        try {
            langCode.getWord({
                search:'W2018082711232500387',//查询
                dataMinute:'G2018102617012216352',//详细数据
                trust:'W2018041913351532345',//内销
                untrust:'W2018041913355225052',//外销
                menuBack:'W2018071009230638074',   //主菜单
                groupClass:'W2018112813060619786',
                orderNoCompelete:'W2018112813200596057',
                headerTitle:'W2018112813214909079',
                toDayOrder:'W2018112813221815342',
                toMonthOrder:'W2018112813224121075',
                toYearOrder:'W2018112813231542752',
                toDayInvoice:'W2018112814031907729',
                toMonthInvoice:'W2018112814034011771',
                toYearInvoice:'W2018112814040099784',
                moneyWan:'W2018112814041588755',
                currCd:'G2018102617102083724',//货币种类
                unit:'G2018102617202335794', //单位
                unitInfo:'G2018102617205307726',//万元
                yuan:'G2018102617211340024', //元
                }, this.lang,this._updateLang
            );
        }catch (e) {
            mui.alert('多语言解析出错!',this.title);
        }
        // http.get('/WEI_1420/getDeptId',{},function (res) {
        //     leon.list.deptCd= res.data[0];
        //     leon.list.deptCd.unshift({value:'',text:'部门名称选择'});
        // });
        this.view.downLoadScript = false;
        this.salesTargetDate = this.getNowDate();
    },
    methods:{
        //多语言转换完成回调
        _updateLang:function(){
            http.get('/WEI_1420/getFilialeList',{},function (res) {
                leon.list.groupClass = res.data[0];
                leon.list.groupClass.unshift({value:'',text:leon.lang.groupClass});
            });
            this.list.expClass[1].text = this.lang.trust;
            this.list.expClass[2].text = this.lang.untrust;
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
            params.date = this.salesTargetDate.substr(0,4)+this.salesTargetDate.substr(5,2)+this.salesTargetDate.substr(8,2);
            params.deptDiv = this.input.groupClass;
            this.isactive = 0;
            if(this.view.echarts != '')this.view.echarts.clear();
            this.list.ResultsList = [];
            http.get(this.api.getResults,params,function (res) {
                console.log(res);
                var todayOrder = 0;
                var toMonthOrder = 0;
                var toYearOrder = 0;
                var todayInvoice = 0;
                var toMonthInvoice = 0;
                var toYearInvoice = 0;
                var MiInvoice = 0;
                for(var i in res.data){
                    res.data[i].titlecolor = '#2e75c4';
                    res.data[i].background = 'white';
                    res.data[i].color = '#000';
                    res.data[i].ToDayOrderAmt = (res.data[i].ToDayOrderAmt/10000).toFixed(2);
                    res.data[i].TotOrderAmt = (res.data[i].TotOrderAmt/10000).toFixed(2);
                    res.data[i].TotYYOrderAmt = (res.data[i].TotYYOrderAmt/10000).toFixed(2);
                    res.data[i].ToDayInvoiceAmt = (res.data[i].ToDayInvoiceAmt/10000).toFixed(2);
                    res.data[i].TotInvoiceAmt = (res.data[i].TotInvoiceAmt/10000).toFixed(2);
                    res.data[i].TotYYInvoiceAmt = (res.data[i].TotYYInvoiceAmt/10000).toFixed(2);
                    res.data[i].MiInvoiceAmt = (res.data[i].MiInvoiceAmt/10000).toFixed(2);
                    todayOrder += parseFloat(res.data[i].ToDayOrderForAmt/10000);
                    toMonthOrder += parseFloat(res.data[i].TotOrderForAmt/10000);
                    toYearOrder += parseFloat(res.data[i].TotYYOrderForAmt/10000);
                    todayInvoice += parseFloat(res.data[i].ToDayInvoiceForAmt/10000);
                    toMonthInvoice += parseFloat(res.data[i].TotInvoiceForAmt/10000);
                    toYearInvoice += parseFloat(res.data[i].TotYYInvoiceForAmt/10000);
                    MiInvoice += parseFloat(res.data[i].MiInvoiceForAmt/10000);
                }
                res.data.push({
                    Market:'Total',
                    titlecolor:'#282832',
                    background:'#fff981',
                    color:'',
                    ToDayOrderAmt:todayOrder.toFixed(2),
                    TotOrderAmt:toMonthOrder.toFixed(2),
                    TotYYOrderAmt:toYearOrder.toFixed(2),
                    ToDayInvoiceAmt:todayInvoice.toFixed(2),
                    TotInvoiceAmt:toMonthInvoice.toFixed(2),
                    TotYYInvoiceAmt:toYearInvoice.toFixed(2),
                    MiInvoiceAmt:MiInvoice.toFixed(2),
                })
                leon.list.resultsList = res.data;
                leon.view.targetNoData = false;
                leon.view.echartsNoData = false;
                leon.getResultsMinute(0);
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
            this.buildHistogram(this.list.getResultsMinute[this.isactive],this.nowDateItem);
        },
        //生成柱状图
        buildHistogram:function (index) {
            jq('#echartsHeader').show();
            this.view.echartsNoData = false;
            var theme = {
                color: [
                    '#76ccff',
                    '#55aeff',
                    '#2196ff',
                    '#f6e993',
                    '#fff244',
                    '#ffe000',
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
                        leon.lang.toDayOrder,leon.lang.toMonthOrder,leon.lang.toYearOrder,leon.lang.toDayInvoice,leon.lang.toMonthInvoice,leon.lang.toYearInvoice
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
                            leon.lang.toDayOrder,leon.lang.toMonthOrder,leon.lang.toYearOrder,leon.lang.toDayInvoice,leon.lang.toMonthInvoice,leon.lang.toYearInvoice
                        ]
                    }
                ],
                yAxis : [
                    {
                        type : 'value'
                    }
                ],
                series : [
                    {
                        name: leon.lang.moneyWan,
                        type: 'bar',
                        data: [
                            leon.list.resultsList[index].ToDayOrderAmt,
                            leon.list.resultsList[index].TotOrderAmt,
                            leon.list.resultsList[index].TotYYOrderAmt,
                            leon.list.resultsList[index].ToDayInvoiceAmt,
                            leon.list.resultsList[index].TotInvoiceAmt,
                            leon.list.resultsList[index].TotYYInvoiceAmt,

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
                                        '#76ccff',
                                        '#55aeff',
                                        '#2196ff',
                                        '#f6e993',
                                        '#fff244',
                                        '#ffe000',
                                    ];
                                    return colorList[params.dataIndex]
                                }
                            }
                        }
                    },
                ]
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
jq('#backMenu').click(function () {
    location.href='/Menu/Menu/menuLists?formKey='+jq("#form_key").val()+'&menuSelection='+jq("#menu_selection").val();
})
if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
    FastClick.prototype.focus = function(targetElement) {
        targetElement.focus();
    };
    FastClick.attach(document.body);
}
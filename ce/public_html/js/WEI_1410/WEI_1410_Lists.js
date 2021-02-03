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
            headerTitle:'去年对比业绩2',
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
            getResults:'/WEI_1410/queryResults',
            getFilialeList:'/WEI_1410/getFilialeList',
            getDeptList:'/WEI_1410/getDeptId',
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
                search:'W2018082711232500387',//查询
                dataMinute:'G2018102617012216352',//详细数据
                trust:'W2018041913351532345',//内销
                untrust:'W2018041913355225052',//外销
                headerTitle:'W2018112813113701322',
                menuBack:'W2018071009230638074',   //主菜单
                groupClass:'W2018112813060619786',
                groupNm:'W2018112813063377362',
                order:'W2018112813070117067',
                invoice:'W2018112813072897778',
                bill:'W2018112813075082363',
                receipt:'W2018112813081350001',
                nowYearMoney:'W2018112813084764012',
                lastYearMoney:'W2018112813091001094',
                expClass:'W2018112813095388327',
                lastYearOrder:'W2018112813122586048',
                nowYearOrder:'W2018112813124740788',
                lastYearInvoice:'W2018112813132332764',
                nowYearInvoice:'W2018112813134136061',
                lastYearBill:'W2018112813140080367',
                nowYearBill:'W2018112813142096084',
                lastYearReceipt:'W2018112813181306752',
                nowYearReceipt:'W2018112813183016084',
                percent:'W2018102617081972328',
                unit:'G2018102617202335794', //单位
                unitInfo:'G2018102617205307726',//万元
                yuan:'G2018102617211340024', //元
                }, this.lang,this._updateLang
            );
        }catch (e) {
            mui.alert('多语言解析出错!',this.title);
        }
        this.salesTargetDate = this.getNowDate('array')[0];
    },
    methods:{
        //多语言转换完成回调
        _updateLang:function(){
            this.view.downLoadScript = false;
            mui.hideLoading();
            http.get('/WEI_1410/getFilialeList',{},function (res) {
                leon.list.groupClass = res.data[0];
                leon.list.groupClass.unshift({value:'',text:leon.lang.groupClass});
            });
            http.get('/WEI_1410/getDeptId',{},function (res) {
                leon.list.deptCd= res.data[0];
                leon.list.deptCd.unshift({value:'',text:leon.lang.groupNm});
            });
            this.list.expClass[0].text = this.lang.expClass;
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
            var type = 'month';
            this.changeDate(type,function (e) {
                leon.salesTargetDate = e.text.substr(0,4);
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
            params.dateY = this.salesTargetDate;
            params.deptCd = this.input.deptCd;
            params.currId = 'B';
            params.expClass = this.input.expClass;
            params.deptDiv = this.input.groupClass;
            this.isactive = 0;
            if(this.view.echarts != '')this.view.echarts.clear();
            this.list.ResultsList = [];
            http.get(this.api.getResults,params,function (res) {
                console.log(res);
                var viewData = [];
                var sort = 1;
                for(var s = 0;s<17;s++){
                    viewData[s] = {
                        titlecolor:'#2e75c4',
                        background:'white',
                        color:'#000',
                        BillAchRate:0.00,
                        DueYYBillAmt:0.00,
                        DueYYInvoiceAmt:0.00,
                        DueYYOrderAmt:0.00,
                        DueYYReceiptAmt:0.00,
                        InvoiceAchRate:0.00,
                        OrderAchRate:0.00,
                        PreYYOrderAmt:0.00,
                        PreYYBillAmt:0.00,
                        PreYYInvoiceAmt:0.00,
                        PreYYReceiptAmt:0.00,
                        ReceiptAchRate:0.00,
                    }
                    if(s == 3 || s == 7 || s == 11 || s == 15 || s==16){
                        var sorts = sort-1;
                        if(s==16){
                            viewData[s].Sort = '999';
                            viewData[s].titlecolor = '#282832';
                            viewData[s].background = '#fff981';
                            viewData[s].color = '#000';
                        }else{
                            if(sorts>=10){
                                viewData[s].Sort = (sorts)+'1';
                            }else{
                                viewData[s].Sort = '0'+(sorts)+'1';
                            }
                            viewData[s].titlecolor = '#282832';
                            viewData[s].background = '#a4d87b';
                            viewData[s].color = '#000';
                        }
                    }else{
                        if(sort>=10){
                            viewData[s].Sort = (sort)+'0';
                            viewData[s].Month = (sort)+'月';
                        }else{
                            viewData[s].Sort = '0'+(sort)+'0';
                            viewData[s].Month = '0'+(sort)+'月';
                        }
                        sort++;
                    }
                }
                console.log(viewData)
                for(var i in res.data){
                    res.data[i].PreYYOrderAmt = (res.data[i].PreYYOrderAmt/10000).toFixed(2);
                    res.data[i].DueYYOrderAmt = (res.data[i].DueYYOrderAmt/10000).toFixed(2);
                    res.data[i].PreYYInvoiceAmt = (res.data[i].PreYYInvoiceAmt/10000).toFixed(2);
                    res.data[i].DueYYInvoiceAmt = (res.data[i].DueYYInvoiceAmt/10000).toFixed(2);
                    res.data[i].PreYYBillAmt = (res.data[i].PreYYBillAmt/10000).toFixed(2);
                    res.data[i].DueYYBillAmt = (res.data[i].DueYYBillAmt/10000).toFixed(2);
                    res.data[i].PreYYReceiptAmt = (res.data[i].PreYYReceiptAmt/10000).toFixed(2);
                    res.data[i].DueYYReceiptAmt = (res.data[i].DueYYReceiptAmt/10000).toFixed(2);
                    res.data[i].OrderAchRate =(res.data[i].OrderAchRate*100).toFixed(2)+'%';
                    res.data[i].InvoiceAchRate = (res.data[i].InvoiceAchRate*100).toFixed(2)+'%';
                    res.data[i].BillAchRate = (res.data[i].BillAchRate*100).toFixed(2)+'%';
                    res.data[i].ReceiptAchRate = (res.data[i].ReceiptAchRate*100).toFixed(2)+'%';
                    viewData = leon.transResult(viewData,res.data[i]);
                }
                console.log(res.data)
                leon.list.resultsList = viewData;
                leon.view.targetNoData = false;
                leon.view.echartsNoData = false;
                leon.getResultsMinute(0);
                // leon.getResultsMinute(0);

            });
        },
        transResult:function(viewData,res){
            for(var i in viewData){
                if(viewData[i].Sort == res.Sort){
                    if(viewData[i].Sort == '031' || viewData[i].Sort == '061' || viewData[i].Sort == '091' ||viewData[i].Sort == '121' ||viewData[i].Sort == '999'){
                        viewData[i].Month = res.Month;
                    }
                    // viewData[i].Month = res.Month;
                    viewData[i].PreYYOrderAmt = res.PreYYOrderAmt;
                    viewData[i].DueYYOrderAmt = res.DueYYOrderAmt;
                    viewData[i].PreYYInvoiceAmt = res.PreYYInvoiceAmt;
                    viewData[i].DueYYInvoiceAmt = res.DueYYInvoiceAmt;
                    viewData[i].PreYYBillAmt = res.PreYYBillAmt;
                    viewData[i].DueYYBillAmt = res.DueYYBillAmt;
                    viewData[i].PreYYReceiptAmt = res.PreYYReceiptAmt;
                    viewData[i].DueYYReceiptAmt = res.DueYYReceiptAmt;
                    viewData[i].OrderAchRate =res.OrderAchRate;
                    viewData[i].InvoiceAchRate = res.InvoiceAchRate;
                    viewData[i].BillAchRate = res.BillAchRate;
                    viewData[i].ReceiptAchRate = res.ReceiptAchRate;
                }
            }
            return viewData;
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
            this.view.echartsNoData = false;
            var theme = {
                color: [
                    // '#c24a59',
                    // '#1082c2',
                    // '#53a6c2',
                    // '#6c66c2',
                    // '#c29147',
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
                        leon.lang.order,leon.lang.invoice,leon.lang.bill,leon.lang.receipt
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
                            leon.lang.order,leon.lang.invoice,leon.lang.bill,leon.lang.receipt
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
                        name: leon.lang.lastYearMoney,
                        type: 'bar',
                        data: [
                            leon.list.resultsList[index].PreYYOrderAmt,
                            leon.list.resultsList[index].PreYYInvoiceAmt,
                            leon.list.resultsList[index].PreYYBillAmt,
                            leon.list.resultsList[index].PreYYReceiptAmt
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
                                        '#ff8b8d',
                                        '#50abff',
                                        '#9fdaf0',
                                        '#a4d87b',
                                    ];
                                    return colorList[params.dataIndex]
                                }
                            }
                        }
                    },
                    {
                        name: leon.lang.nowYearMoney,
                        type: 'bar',
                        data: [
                            leon.list.resultsList[index].DueYYOrderAmt,
                            leon.list.resultsList[index].DueYYInvoiceAmt,
                            leon.list.resultsList[index].DueYYBillAmt,
                            leon.list.resultsList[index].DueYYReceiptAmt,
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
                                        '#e85869',
                                        '#2389f1',
                                        '#6ac2e5',
                                        '#7dc741',
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
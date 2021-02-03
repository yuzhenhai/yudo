var leon = new Vue({
    el: '#leon',
    delimiters: ['$((', '))'],
    data: {
        backIcon: {
            'left-icon': true,
            'icon-backmenu': true,
        },
        yearItem: {
            'item': true,
            'active': true,
        },
        monthItem: {
            'item': true,
            'active': false,
        },
        dayItem: {
            'item': true,
            'active': false,
        },
        nowDateItem: 0,
        salesClass: '<div class="left-icon icon-search-user"></div><input type="text" placeholder="查询人员">',
        salesTargetDate: '',
        nowDateItem: 0,
        isactive: 0,
        userNm: '',
        userId: '',
        groupNm: '',
        groupId: '',
        themeIndex: '0',
        permission: 'E',
        lang: {
            searchUserNm: '职员姓名',
            searchUserId: '职员工号',
            searchGroupNm: '部门名称',
            userNm: '姓名',
            userId: '工号',
            groupNm: '部门',
            targetDate: '目标日',
            orderAmt: '订单目标',
            InvoiceAmt: '出库目标',
            BillAmt: '发票目标',
            ReceiptAmt: '收款目标',
            currId: '货币',
            nowUnit: '',
            unit: '单位',
            unitInfo: '万元',
            yuan: '元',
            queryAll: '查询全部',
            allResults: '全部业绩',
            menuBack: '',
            expClass: '',//出口区分
            currCd: '',//货币种类
            mempidResults: '各经理管辖部门业绩',
            groupResults: '各部门业绩',
            userResults: '个人业绩',
            targetWrite: '销售目标录入',
            headerTitle: '销售状况表',
            confirm: '',
            save: '',
            year: '',
            month: '',
            day: '',
            dataMinute: '',
            class: '',
            targetOrderMoney: '',//订单目标金额
            targetInvoiceMoney: '',
            targetBillMoney: '',
            targetReceiptMoney: '',
            targetOrder: '',//订单目标
            targetInvoice: '',
            targetBill: '',
            targetReceipt: '',
            nodata: '',//暂无数据
            target: '',//目标
            results: '',//业绩
            persent: '',//达成率
            pictrolTable: '',//图表
            search: '查询',
            searchUser: '',
            searchResult: '',
            trust: '',//内销
            untrust: '',//外销
            resultsOrder: '',//订单业绩
            resultsInvoice: '',
            resultsBill: '',
            resultsReceipt: '',
            transTitle: '',
            RMB: '',
            EUR: '',
            KOR: '',
            HKD: '',
            JPY: '',
            TWD: '',
            USD: '',
        },
        view: {
            chartSZ:false,
            chartGD:false,
            chartQD:false,
            tubiaoIndex:2,
            dataMinute: false,
            echarts: '',
            downLoadScript: true,
            optAllAdminComplete: false,
            opening: '',
            confirm: false,
            isRewrite: false,
            xwrite: false,
            writeTargetIsLoading: false,
            writeTargetNoData: false,
            viewMenu: true,
            viewTargetMinute: true,
            viewTargetWrite: false,
            viewTargetSearch: false,
            viewUserSearch: false,
            usersIsLoading: false,
            usersNoData: false,
            optUser: false,
            optGroupAdmin_c: false,
            optGroupAdmin: false,
            optAllAdmin: true,
            resultsNoData: true,
            echartsNoData: true,
            nowYear:'',
            lastYear:'',
        },
        api: {
            getResults: '/WEI_0200/listsSearch',
        },
        input: {
            optUserNm: '',
            optUserId: '',
            userNm: '',
            userId: '',
            groupNm: '',
            groupId: '',
            orderAmt: '',
            invoiceAmt: '',
            billAmt: '',
            receiptAmt: '',
            searchStartTime: '',
            searchEndTime: '',
            searchUserNm: '',
            searchUserId: '',
            searchGroupNm: '',
            searchUserCount: 0,
            searchTargetCount: 0,
            targetDate: '',
            searchGroup: 'C001',
            expClass: '1',
            db: 'SZ',
            amtClass: {value:'bill',text:'发票'},
            currency: 'RMB',
            targetAllAdmin: {value: 'ALL', text: ''},
            targetGroupAdmin: {value: 'ALL', text: ''},
            targetGroupAdmin_c: {value: 'ALL', text: ''},
            targetUser: {},
            leaderNm: '',
        },
        list: {
            db: [
                {value: 'SZ', text: '苏州'},
                {value: 'GD', text: '广东'},
                {value: 'QD', text: '青岛'},
                {value: 'HS', text: '汉斯'},
                {value: 'XR', text: '先锐'},
                {value: 'YBD', text: '毅比道'}
            ],
            amtList:{
                SZ:{lastYearAmt:0,nowYearAmt:0,percent:0,show:false},
                GD:{lastYearAmt:0,nowYearAmt:0,percent:0,show:false},
                QD:{lastYearAmt:0,nowYearAmt:0,percent:0,show:false},
                HS:{lastYearAmt:0,nowYearAmt:0,percent:0,show:false},
                XR:{lastYearAmt:0,nowYearAmt:0,percent:0,show:false},
                YBD:{lastYearAmt:0,nowYearAmt:0,percent:0,show:false},
            },
            amtClass: [
                {value: 'order', text: '订单'},
                {value: 'invoice', text: '出库'},
                {value: 'bill', text: '发票'},
                {value: 'receipt', text: '收款'}
            ],
            //出口区分
            expClass: [
                {value: '1', text: '内销'},
                {value: '4', text: '外销'}
            ],
            currency: [
                {value: 'RMB', text: '人民币'},
                {value: 'EUR', text: '欧元'},
                {value: 'KOR', text: '韩元'},
                {value: 'HKD', text: '港币'},
                {value: 'JPY', text: '日元'},
                {value: 'TWD', text: '台币'},
                {value: 'USD', text: '美元'},
            ],
            summarizeList: [],
            orderListDisplay: [],
            invoiceListDisplay: [],
            billListDisplay: [],
            ReceiptDisplay: [],
            invoiceProListDisplay: [],
            minuteListDisplay: [],
            orderList: [],
            invoiceList: [],
            billList: [],
            receiptList: [],
            invoiceProList: [],
            sumData: {},
            sumDataDisplay: {},
            sumExternal: {},
            sumExternalDisplay: {},
            sumInternal: {},
            sumInternalDisplay: {},
        }
    },
    filters: {
        toFix: function (value) {
            return value.toFixed(0);
        },
        date: function (value) {
            return value.substr(0, 10);
        },
        currSwitch: function (value) {
            for (var index in leon.list.currency) {
                if (leon.list.currency[index].value == value) {
                    return leon.list.currency[index].text
                }
            }
        },
        confirmLabel: function (value) {
            if (value == 1) {
                return '<div class="yudo-label label-success" style="float: right">' + leon.lang.isConfirm + '</div>';
            } else {
                return '<div class="yudo-label label-default" style="float: right">' + leon.lang.noConfirm + '</div>';
            }
        }
    },
    mounted() {
        try {
            langCode.method = 'cache';
            langCode.getWord({
                    SUZHOU: 'W2019010917151813357',
                    GUANGDONG: 'W2019010917154884789',
                    QINGDAO: 'W2019010917160016794',
                    HANS:'W2019110115053661645',
                    XIANRUI:'W2019110115053699355',
                    YIBIDAO:'W2021012215511405769',
                    headerTitle:'W2019030413295880091',
                    // headerTitle:'W2018020109425972356',
                    growRate: 'W2018102617081972328',//增长率
                    lastYear: 'W2018122516062166764',
                    toYear: 'W2018122516063785033',
                    menuBack: 'W2018071009230638074',   //主菜单
                    expClass: 'W2018041913341497746',//出口区分
                    currCd: 'G2018102617102083724',//货币种类
                    // headerTitle:'W2018122516284669743',

                    targetOrderMoney: 'G2018102617105713785',//订单目标金额
                    targetInvoiceMoney: 'W2018102617114052791',
                    targetBillMoney: 'W2018102617115829085',
                    targetReceiptMoney: 'W2018102617122922701',

                    targetOrder: 'G2018102617181930339',//订单目标
                    targetInvoice: 'G2018102617185897075',
                    targetBill: 'G2018102617191538772',
                    targetReceipt: 'G2018102617193451755',

                    resultsOrder: 'W2018102914300143739',//订单业绩
                    resultsInvoice: 'W2018102914302448767',
                    resultsBill: 'W2018102914304110771',
                    resultsReceipt: 'W2018102914310673068',

                    confirm: 'W2018071009351100377',
                    save: 'W2018071009410262081',

                    year: 'W2018102617000591392',
                    month: 'G2018102617002367015',
                    day: 'G2018102617005914777',
                    search: 'W2018082711232500387',//查询
                    dataMinute: 'G2018102617012216352',//详细数据
                    class: 'G2018102617013950014',//区分
                    orderResults: 'G2018102617015927383',//订单金额
                    invoiceResults: 'G2018102617023163098',
                    billResults: 'G2018102617053446374',
                    receiptResults: 'G2018102617060001707',
                    MatOutAmt: 'W2008042616260834075',//生产出库金额
                    nodata: 'W2018062810475725084',//暂无数据
                    target: 'G2018102617064252094',//目标
                    results: 'W2018102617080071052',//业绩
                    persent: 'W2018102617081972328',//达成率
                    pictrolTable: 'W2018102617085239791',//图表
                    unit: 'G2018102617202335794', //单位
                    unitInfo: 'G2018102617205307726',//万元
                    yuan: 'G2018102617211340024', //元
                    allResults: 'G2018102617215904304',
                    mempidResults: 'G2018102617222479741',
                    groupResults: 'G2018102617224857379',
                    userResults: 'G2018102617230579079',
                    queryAll: 'G2018102617214379386',
                    searchUser: 'W2018082713370902732',//职员查询
                    searchResult: 'W2018102909354232763',
                    targetWrite: 'W2018102616572707009',//销售目标录入
                    currId: 'G2018102617195825091',
                    trust: 'W2018041913351532345',//内销
                    untrust: 'W2018041913355225052',//外销
                    isConfirm: 'W2018102914044702085',
                    noConfirm: 'W2018102914051033012',
                    order: 'W2018110617341265338',//订单
                    invoice: 'W2018110617351862706',//出库
                    bill: 'W2018110617354776078',//发票
                    receipt: 'W2018110617362266394',//收款
                    changeTheme: 'W2018110618023964046',//切换样式

                    RMB: 'G2018102617231931047',
                    EUR: 'G2018102617232982015',
                    KOR: 'W2018102617390024388',
                    HKD: 'W2018102617393022013',
                    JPY: 'W2018102617394451365',
                    TWD: 'W2018102617395906027',
                    USD: 'W2018102617402068363',
                }, this.lang, this._updateLang
            );
        } catch (e) {
            mui.alert('多语言解析出错!', this.title);
        }
        this.salesTargetDate  = this.getNowDate('array')[0];
        this.view.nowYear  = this.getNowDate('array')[0];
        this.view.lastYear = this.getNowDate('array')[0]-1;
        // multi.getLang('CHN');
    },
    methods: {
        //多语言转换完成回调
        _updateLang: function () {
            this.view.downLoadScript = false;
            this.list.expClass[0].text = this.lang.trust;
            this.list.expClass[1].text = this.lang.untrust;
            this.lang.nowUnit = this.lang.unitInfo;
            this.list.db = [
                {value: 'SZ', text: this.lang.SUZHOU},
                {value: 'GD', text: this.lang.GUANGDONG},
                {value: 'QD', text: this.lang.QINGDAO},
                {value: 'HS', text: this.lang.HANS},
                {value: 'XR', text: this.lang.XIANRUI},
                {value: 'YBD', text: this.lang.YIBIDAO}
            ];
            this.input.amtClass = {value: 'bill', text: this.lang.bill},
            this.list.amtClass = [
                {value: 'order', text: this.lang.order},
                {value: 'invoice', text:this.lang.invoice},
                {value: 'bill', text: this.lang.bill},
                {value: 'receipt', text: this.lang.receipt}
            ];

        },
        closeDataMinute: function (index) {
            leon.list.minuteListDisplay = [];
            jq('.yudo-window').css({'animation-duration': '0.2s'});
            multi.recoverDefaultByCss('yudo-window', function () {
                leon.view.viewTargetMinute = true;
                multi.removeTransByCss('yudo-window-trans', function () {
                    leon.view.dataMinute = false;
                });
            });
        },
        //切换年月日
        changeInfoItem: function (e) {
            if (e == this.nowDateItem) return false;
            mui.showLoading('loading');
            this.yearItem['active'] = false;
            this.monthItem['active'] = false;
            this.dayItem['active'] = false;
            switch (e) {
                case 0:
                    this.nowDateItem = 0;
                    this.yearItem['active'] = true;

                    break;
                case 1:
                    this.nowDateItem = 1;
                    this.monthItem['active'] = true;
                    break;
                case 2:
                    this.nowDateItem = 2;
                    this.dayItem['active'] = true;
                    break;
            }
            setTimeout(function () {
                mui.hideLoading();
            }, 300)
        },
        //获取当前时间 xxxx-xx-xx
        getNowDate: function (check) {
            var check = check || '';
            var nowDate = new Date();
            var year = nowDate.getFullYear();
            var month = nowDate.getMonth() + 1 < 10 ? "0" + (nowDate.getMonth() + 1) : nowDate.getMonth() + 1;
            var day = nowDate.getDate() < 10 ? "0" + nowDate.getDate() : nowDate.getDate();
            if (check == 'array') {
                var nowTime = [year, month, day];
            } else {
                var nowTime = year + "-" + month + "-" + day;
            }

            return nowTime;
        },

        //查询时间选择
        searchDate: function () {
            var type = 'month';
            this.changeDate(type, function (e) {
                leon.salesTargetDate = e.text.substr(0,4);
                leon.view.nowYear = e.text.substr(0,4);
                leon.view.lastYear = e.text.substr(0,4)-1;
                leon.getResults();
                jq('.mui-dtpicker').remove();
            });
        },
        //切换查询货币单位
        changeCurrency: function (value) {
            mui.showLoading('loading...');
            setTimeout(function () {
                mui.hideLoading();
            }, 1000);
        },
        //选择时间
        changeDate: function (type, func) {
            var nowDate = this.getNowDate('array');
            var dtpicker = new mui.DtPicker({
                type: type,//设置日历初始视图模式
                beginDate: new Date(1989, 01, 01),//设置开始日期
                endDate: new Date(nowDate[0], nowDate[1], nowDate[2]),//设置结束日期
                labels: ['Year', 'Mon', 'Day'],//设置默认标签区域提示语
            })
            dtpicker.show(function (e) {
                func(e);
            })
        },
        //获取业绩信息
        getResults: function () {
            mui.showLoading('loading');
            var params = {}
            var isComplete = {
                SZ:false,
                GD:false,
                QD:false,
                HS:false,
                XR:false,
                YBD:false,
            };
            if (this.nowDateItem == 0) {
                params.gubun = 'Y';
            } else if (this.nowDateItem == 1) {
                params.gubun = 'M';
            } else {
                params.gubun = 'D';
            }
            params.amtClass = this.input.amtClass.value;
            params.date = this.salesTargetDate;
            this.isactive = 0;
            leon.view.resultsNoData = false;
            leon.list.amtList.SZ.show = false;
            leon.list.amtList.GD.show = false;
            leon.list.amtList.QD.show = false;
            leon.list.amtList.HS.show = false;
            leon.list.amtList.XR.show = false;
            leon.list.amtList.YBD.show = false;
            var displayData = function (key) {
                leon.list.amtList[key].show = true;
                var rotateSZ = 90*((leon.list.amtList[key].percent>200? 200:leon.list.amtList[key].percent)/100);
                setTimeout(function () {
                    leon.changeRotate(rotateSZ,'chart'+key);
                },100);
            }
            var getSync = setInterval(function () {
                if(isComplete.SZ == true){
                    displayData('SZ');
                    isComplete.SZ = null;
                }else if(isComplete.GD == true){
                    displayData('GD');
                    isComplete.GD = null;
                }else if(isComplete.QD == true){
                    displayData('QD');
                    isComplete.QD = null;
                }else if(isComplete.HS == true){
                    displayData('HS');
                    isComplete.HS = null;
                }else if(isComplete.XR == true){
                    displayData('XR');
                    isComplete.XR = null;
                } else if(isComplete.YBD == true){
                    displayData('YBD');
                    isComplete.YBD = null;
                }
                if(isComplete.SZ == null && isComplete.GD == null && isComplete.QD == null && isComplete.HS == null && isComplete.XR == null && isComplete.YBD == null){
                    mui.hideLoading();
                    clearInterval(getSync);
                }
            },300);
            http.get(this.api.getResults+'?dbChoose=SZ', params, function (res) {
                if(res.returnCode == 0) {
                    leon.list.amtList.SZ.nowYearAmt = parseFloat(res.data[0][1].data).toFixed(2);
                    leon.list.amtList.SZ.lastYearAmt = parseFloat(res.data[0][0].data).toFixed(2);
                    leon.list.amtList.SZ.percent = (leon.list.amtList.SZ.nowYearAmt/leon.list.amtList.SZ.lastYearAmt*100).toFixed(2);
                }else if(res.returnCode == 400){
                    leon.view.resultsNoData = true;
                }
                isComplete.SZ = true;
            },function (err) {
                clearInterval(getSync);
                mui.hideLoading();
                mui.alert('苏州数据访问出错，请重试!','YUDO ERP');
            },function (complete) {});
            http.get(this.api.getResults+'?dbChoose=GD', params, function (res) {
                if(res.returnCode == 0) {
                    leon.list.amtList.GD.nowYearAmt = parseFloat(res.data[0][1].data).toFixed(2);
                    leon.list.amtList.GD.lastYearAmt = parseFloat(res.data[0][0].data).toFixed(2);
                    leon.list.amtList.GD.percent = (leon.list.amtList.GD.nowYearAmt/leon.list.amtList.GD.lastYearAmt*100).toFixed(2);

                }else if(res.returnCode == 400){
                    leon.view.resultsNoData = true;
                }
                isComplete.GD = true;
            },function (err) {
                clearInterval(getSync);
                mui.hideLoading();
                mui.alert('广东数据访问出错，请重试!','YUDO ERP');
            },function (complete) {console.log(123);});
            http.get(this.api.getResults+'?dbChoose=QD', params, function (res) {
                if(res.returnCode == 0) {
                    leon.list.amtList.QD.nowYearAmt = parseFloat(res.data[0][1].data).toFixed(2);
                    leon.list.amtList.QD.lastYearAmt = parseFloat(res.data[0][0].data).toFixed(2);
                    leon.list.amtList.QD.percent = (leon.list.amtList.QD.nowYearAmt/leon.list.amtList.QD.lastYearAmt*100).toFixed(2);

                }else if(res.returnCode == 400){
                    leon.view.resultsNoData = true;
                }
                isComplete.QD = true;
            },function (err) {
                clearInterval(getSync);
                mui.hideLoading();
                mui.alert('青岛数据访问出错，请重试!','YUDO ERP');
            },function (complete) {});
            http.get(this.api.getResults+'?dbChoose=HS', params, function (res) {
                if(res.returnCode == 0) {
                    leon.list.amtList.HS.nowYearAmt = parseFloat(res.data[0][1].data).toFixed(2);
                    leon.list.amtList.HS.lastYearAmt = parseFloat(res.data[0][0].data).toFixed(2);
                    leon.list.amtList.HS.percent = (leon.list.amtList.HS.nowYearAmt/leon.list.amtList.HS.lastYearAmt*100).toFixed(2);

                }else if(res.returnCode == 400){
                    leon.view.resultsNoData = true;
                }
                isComplete.HS = true;
            },function (err) {
                clearInterval(getSync);
                mui.hideLoading();
                mui.alert('汉斯数据访问出错，请重试!','YUDO ERP');
            },function (complete) {});
            http.get(this.api.getResults+'?dbChoose=XR', params, function (res) {
                if(res.returnCode == 0) {
                    leon.list.amtList.XR.nowYearAmt = parseFloat(res.data[0][1].data).toFixed(2);
                    leon.list.amtList.XR.lastYearAmt = parseFloat(res.data[0][0].data).toFixed(2);
                    leon.list.amtList.XR.percent = (leon.list.amtList.XR.nowYearAmt/leon.list.amtList.XR.lastYearAmt*100).toFixed(2);

                }else if(res.returnCode == 400){
                    leon.view.resultsNoData = true;
                }
                isComplete.XR = true;
            },function (err) {
                clearInterval(getSync);
                mui.hideLoading();
                mui.alert('先锐数据访问出错，请重试!','YUDO ERP');
            },function (complete) {});
            http.get('/WEI_0200/getk3Amt'+'?dbChoose=YBD',params,res =>{
                if(params.amtClass == 'order'){
                    leon.list.amtList.YBD.nowYearAmt = parseFloat(res.data.Order.FForamount/10000).toFixed(2);
                    leon.list.amtList.YBD.lastYearAmt = parseFloat(res.data.Order.FForamountPre/10000).toFixed(2);
                }else if(params.amtClass == 'invoice'){
                    leon.list.amtList.YBD.nowYearAmt = parseFloat(res.data.Invoice.FForamount/10000).toFixed(2);
                    leon.list.amtList.YBD.lastYearAmt = parseFloat(res.data.Invoice.FForamountPre/10000).toFixed(2);
                }else if(params.amtClass == 'bill'){
                    leon.list.amtList.YBD.nowYearAmt = parseFloat(res.data.Bill.FForamount/10000).toFixed(2);
                    leon.list.amtList.YBD.lastYearAmt = parseFloat(res.data.Bill.FForamountPre/10000).toFixed(2);
                }else if(params.amtClass == 'receipt'){
                    leon.list.amtList.YBD.nowYearAmt = parseFloat(res.data.Receive.FForamount/10000).toFixed(2);
                    leon.list.amtList.YBD.lastYearAmt = parseFloat(res.data.Receive.FForamountPre/10000).toFixed(2);
                }
                leon.list.amtList.YBD.percent = (leon.list.amtList.YBD.nowYearAmt/leon.list.amtList.YBD.lastYearAmt*100).toFixed(2);
                isComplete.YBD = true;
            })
        },
        changeTubiao:function(){
            if(this.view.tubiaoIndex == 1){
                leon.buildHistogram(leon.list.amtList.SZ,'ChartSZ');
                leon.buildHistogram(leon.list.amtList.GD,'ChartGD');
                leon.buildHistogram(leon.list.amtList.QD,'ChartQD');
                leon.buildHistogram(leon.list.amtList.HS,'ChartHS');
                leon.buildHistogram(leon.list.amtList.XR,'ChartXR');
                leon.buildHistogram(leon.list.amtList.YBD,'ChartYBD');
                this.view.tubiaoIndex = 2;
            }else{
                leon.buildHistogram2(leon.list.amtList.SZ,'ChartSZ');
                leon.buildHistogram2(leon.list.amtList.GD,'ChartGD');
                leon.buildHistogram2(leon.list.amtList.QD,'ChartQD');
                leon.buildHistogram2(leon.list.amtList.HS,'ChartHS');
                leon.buildHistogram2(leon.list.amtList.XR,'ChartXR');
                leon.buildHistogram2(leon.list.amtList.YBD,'ChartYBD');
                this.view.tubiaoIndex = 1;
            }
        },
        buildHistogram: function (data,dom) {
            var theme = {
                color: [
                    '#2196ff',
                    '#afafaf',
                ],
            };
            var echart = echarts.init(document.getElementById(dom), theme);
            echart.setOption({
                tooltip: {},
                grid: [{
                    top: 20,
                    width: '90%',
                    height: '70%',
                    bottom: '45%',
                    left: 5,
                    containLabel: true
                }],
                legend: {
                    data: '123',
                },
                xAxis: [{
                    show:false,
                    type: 'value',
                    max: data.lastYearAmt,
                    splitLine: {
                        show: false
                    }
                }],
                yAxis: [{
                    show:false,
                    type: 'category',
                    data: '123',
                    axisLabel: {
                        interval: 0,
                        rotate: 0
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
                            color: function (params) {
                                // build a color map as your need.
                                var colorList = [
                                    '#2196ff',
                                    '#afafaf',
                                ];
                                return colorList[params.dataIndex]
                            }

                        }
                    },
                    label: {
                        normal: {
                            position: 'right',
                            show: false
                        }
                    },
                    data: [
                        {value:data.nowYearAmt,name:leon.view.nowYear+'('+(data.nowYearAmt/data.lastYearAmt*100).toFixed(2)+'%)'},
                        {value:data.lastYearAmt,name:leon.view.lastYear+'(100%)'},
                    ]
                }]
            });
        },
        buildHistogram2: function (data,dom) {
            var theme = {
                color: [
                    '#2196ff',
                    '#afafaf',
                ],
            };
            var echart = echarts.init(document.getElementById(dom), theme);
            echart.setOption({
                title: {},
                tooltip: {
                    trigger: 'axis',
                    enabled: false,
                    formatter: "{a} <br/>{b}: {c} ({d}%)"
                },
                series: [
                    {

                        name: leon.input.amtClass.text,
                        type: 'pie',
                        radius: ['35%', '70%'],

                        avoidLabelOverlap: false,
                        label: {
                            normal: {
                                show: false,
                                position: 'center'
                            },
                            emphasis: {
                                show: true,
                                textStyle: {
                                    fontSize: '12',
                                    fontWeight: 'bold'
                                }
                            }
                        },
                        labelLine: {
                            normal: {
                                show: false
                            }
                        },

                        data: [
                            {value: data.nowYearAmt,name: leon.view.nowYear},
                            {value: data.lastYearAmt},
                        ]
                    }
                ]
            });
        },
        changeRotate:function (rotate,dom) {
            // document.getElementById(dom).style.we = "rotate("+rotate+"deg)";
            // document.getElementById(dom).style.MozTransform = "rotate("+rotate+"deg)";
            // document.getElementById(dom).style.msTransform = "rotate("+rotate+"deg)";
            // document.getElementById(dom).style.OTransform = "rotate("+rotate+"deg)";
            document.getElementById(dom).style.transform = "rotate("+rotate+"deg)";
            document.getElementById(dom).classList.add('animate-rotate');
            if(rotate >= 180){
                setTimeout(function () {
                    document.getElementById(dom).classList.remove('animate-rotate');
                    document.getElementById(dom).classList.add('animate-rotate-over');
                },600);
            }
        }
    }
});

function onlyNum() {
    if(!(event.keyCode==46)&&!(event.keyCode==8)&&!(event.keyCode==37)&&!(event.keyCode==39))
        if(!((event.keyCode>=48&&event.keyCode<=57)||(event.keyCode>=96&&event.keyCode<=105)))
            event.returnValue=false;
}


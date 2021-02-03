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
        auth:{
            AUTH_A:'SM00040001',
            AUTH_D:'SM00040002',
            AUTH_E:'SM00040003',
            AUTH_J:'SM00040004',
            AUTH_M:'SM00040005',
        },
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
            targetAndResults:'销售目标/业绩对比',
            confirm:'',
            save:'',
            targetAndResults:'', //销售目标 业绩
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
            viewPlan:false,
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
            viewTargetMinute:false,
            viewTargetWrite:false,
            viewMonthPlan:false,
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
            getUsers:'/WEI_2300/getUsers',
            getWriteTarget:'/WEI_2300/getWriteTarget',
            setTarget:'/WEI_2300/setSalesTarget',
            getUserTarget:'/WEI_2300/getUserTarget',
            getPermission:'/WEI_2300/getPermission',
            getLeader:'/WEI_2300/getLeader',
            getLeaderTarget:'/WEI_2300/getLeaderTarget',
            getMempIdTarget:'/WEI_2300/getMempIdTarget',
            getDeptIdTarget:'/WEI_2300/getDeptIdTarget',
            getMempId:'/WEI_2300/getMempId',
            getDeptId:'/WEI_2300/getDeptId',
            targetConfirm:'/WEI_2300/targetConfirm'
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
            group:'',
            leaderNm:'',
        },
        list:{
            writeTargetList:[],
            userList:[],
            groupList:[],
            targetAllAdmin:[{value:'ALL',text:''}],
            targetGroupAdmin:[{value:'ALL',text:''}],
            targetGroupAdmin_c:[{value:'ALL',text:''}],
            targetUser:[],
            groupClass:[
                {value:'C001',text:''},
                {value:'C002',text:''},
                {value:'C003',text:''},
                {value:'C004',text:''},
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
            targetList:[],
            targetListMinute:[],
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
            langCode.method = 'cache';
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
                targetAndResults:'W2018102616590264776', //销售目标 业绩
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
                searchTargetAndResult:'W2018102616570053035',
                targetWrite:'W2018102616572707009',//销售目标录入
                currId:'G2018102617195825091',
                trust:'W2018041913351532345',//内销
                untrust:'W2018041913355225052',//外销
                isConfirm:'W2018102914044702085',
                noConfirm:'W2018102914051033012',
                targetIsConfirm:'W2018102914254511055',//该目标已经确定，请先取消确定
                xwrite:'W2018102914260957025',//该项不可修改
                mustWrite:'W2018102914263647704',//输入项不可为空
                mustSaveTarget:'W2018102914270370712',//请先保存销售目标
                targetMustInt:'W2018102914273428086',//目标金额必须为整数
                noCurrCd:'W2018102914280936745',//本月无当前货币汇率记录，暂时无法保存
                targetAlreadyExists:'W2018102914290140792',//已经存在此类记录，请检查是否重复输入销售目标
                saveSuccess:'W2018050317440350711',
                saveFalse:'W2018050317441072027',
                headerTitle:'W2018102915303680086',
                hasRecord:'W2018102918162492004',//已经存在已确定的相同记录
                recordIsconfirm:'W2018102918165028316',//已成功更新此前已保存的销售目标

                noPermission:'W2018110617264682094',//没有权限
                mustWriteSales:'W2018110617282768029',//输入需要查询的销售人员
                onlySearchMine:'W2018110617290066721',//您的权限级别只允许查询自己的销售业绩目标对比，请重试
                onlySearchMineUser:'W2018110617292488033',//您的权限级别只允许查询自己所管辖的员工销售业绩目标对比，请重试
                mustChooseGroup:'W2018110617295627339',//请先选择组别
                cantSearchAll:'W2018110617303078325',//权限不足，无法查询全部目标/业绩
                order:'W2018110617341265338',//订单
                invoice:'W2018110617351862706',//出库
                bill:'W2018110617354776078',//发票
                receipt:'W2018110617362266394',//收款
                changeTheme:'W2018110618023964046',//切换样式
                targetToResult:'W2018112813015905314',
                planToResult:'W2018112813023018302',
                planToTarget:'W2018112813024986303',
                plan:'W2018112813032569371',
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

        http.get('/WEI_2300/getLoginInfo',{},function (res) {
            leon.input.userNm = res.data.EmpNm;
            leon.input.userId = res.data.EmpID;
            leon.input.groupNm = res.data.DeptNm;
            leon.input.groupId = res.data.DeptCd;

            leon.userId = res.data.EmpID;
            leon.userNm = res.data.EmpNm;
            leon.groupNm = res.data.DeptNm;
            leon.groupId = res.data.DeptCd;

            leon.input.searchUserNm = res.data.EmpNm;
        });
        this.input.searchStartTime = this.getNowDate();
        this.input.searchEndTime = this.getNowDate();
        this.salesTargetDate = this.getNowDate('array')[0];
    },
    methods:{
        //多语言转换完成回调
        _updateLang:function(){
            mui.hideLoading();
            this.view.downLoadScript = false;
            this.list.targetAllAdmin[0].text = this.lang.allResults;
            this.list.targetGroupAdmin[0].text = this.lang.allResults;
            this.list.targetGroupAdmin_c[0].text = this.lang.allResults;
            this.input.targetAllAdmin.text = this.lang.allResults;
            this.input.targetGroupAdmin.text = this.lang.allResults;
            this.input.targetGroupAdmin_c.text = this.lang.allResults;
            this.list.groupClass[0].text = this.lang.queryAll;
            this.list.groupClass[1].text = this.lang.mempidResults;
            this.list.groupClass[2].text = this.lang.groupResults;
            this.list.groupClass[3].text = this.lang.userResults;
            for(var i=0;i<this.list.currency.length;i++){
                this.list.currency[i].text = this.lang[this.list.currency[i].value];
            }
            this.list.expClass[0].text = this.lang.trust;
            this.list.expClass[1].text = this.lang.untrust;
            this.lang.nowUnit = this.lang.unitInfo;

        },
        //显示主菜单
        showMenu:function () {
            this.view.viewMenu = true;
        },
        closeMenu:function(){
            this.view.viewMenu = false;
        },
        //显示录入月度计划
        showMonthPlan:function(){
            this.view.viewMonthPlan = true;
            this.closeMenu();
        },
        closeMonthPlan:function(){
            this.showMenu();
            this.view.viewMonthPlan = false;
        },


        //显示销售目标详细界面
        showTargetMinute:function ()    {
            this.view.opening = 'search';
            this.closeMenu();
            this.view.viewTargetMinute = true;
            if(this.view.optAllAdminComplete == false){
                mui.showLoading('loading');
                this.view.optAllAdmin = true;
                http.get(this.api.getPermission,{},function (res) {
                    leon.permission = res.returnCode;
                    switch (res.returnCode){
                       case leon.auth.AUTH_A:
                           leon.changeProject('C001');
                           break;
                       //管理部门权限(部长)
                       case leon.auth.AUTH_M:
                           // leon.list.groupClass.splice(0,1);
                           leon.input.searchGroup = 'C002';
                           leon.changeProject('C002');
                           break;
                       //部门权限(经理)
                       case leon.auth.AUTH_D:
                           // leon.list.groupClass.splice(0,2);
                           leon.input.searchGroup = 'C003';
                           leon.changeProject('C003');
                           break;
                       case leon.auth.AUTH_E:
                       default:
                           // leon.list.groupClass.splice(0,3);
                           leon.input.searchGroup = 'C004';
                           leon.changeProject('C004');
                           leon.input.targetUser = {value:leon.groupId,text:leon.groupNm};
                           break;
                    }
                });
                this.view.optAllAdminComplete = true;
            }

        },
        //关闭销售目标详细界面
        closeTargetMinute:function () {
            this.showMenu();
            this.view.viewTargetMinute = false;
        },
        //显示销售目标填写界面
        showTargetWrite:function (check) {
            if(check == 'active'){
                this.input.targetDate = this.getNowDate();
            }
            this.view.opening = 'write';
            this.closeMenu();
            this.view.viewTargetWrite = true;
            setTimeout(function () {
                leon.activeMuiSwitch();
            },500)
        },
        //关闭销售目标填写界面
        closeTargetWrite:function (check) {
            if(check == 'active'){
                this.clearTargetWirte('active');
                this.view.isRewrite = false;
                this.view.xwrite = false;
            }
            this.showMenu();
            this.view.viewTargetWrite = false;
        },
        //显示职员查询界面
        showUserSearch:function(check){
            if(this.view.confirm == true){
                mui.alert(leon.lang.targetIsConfirm,'YUDO ERP');
                return false;
            }
            if(this.view.isRewrite == true){
                mui.alert(leon.lang.xwrite,'YUDO ERP');
                return false;
            }
            this.view.viewUserSearch = true;
            if(this.view.opening == 'write')this.view.viewTargetWrite = false;
            if(this.view.opening == 'search')this.view.viewTargetMinute = false;
            setTimeout(function () {
                jq('#muiPushUsers').scroll(function(){
                    console.log(33);
                    var bottom = document.getElementById('muiPushUsers').scrollHeight - document.getElementById('muiPushUsers').clientHeight - jq('#muiPushUsers').scrollTop();
                    if(bottom == 0 && leon.list.userList.length > 0){
                        leon.getUsersMore();
                    }
                });
            },500);
        },
        //激活mui开关按钮
        activeMuiSwitch:function(){
            mui('.mui-switch')['switch']();
            document.getElementById("confirm").addEventListener("toggle",function(event){
                if(leon.checkTargetWirte == false) {
                    mui.alert(leon.lang.mustWrite,'YUDO ERP');
                    return false;
                }
                mui.showLoading('loading...');
                var params = {};
                params.userId = leon.input.userId;
                params.groupId = leon.input.groupId;
                params.date = leon.input.targetDate;
                params.currCd = leon.input.currency;
                params.expClass = leon.input.expClass;
                if(event.detail.isActive){
                    //设置确定
                    params.confirmYn = 'CA';
                    http.post(leon.api.targetConfirm,params,function (res) {
                        if(res.returnCode == 'noCurrency'){
                            mui.alert(leon.lang.noCurrCd,'YUDO ERP');
                            return false;
                        }
                        else if(res.returnCode == 'H001'){
                            mui.alert(leon.lang.mustSaveTarget,'YUDO ERP');
                            leon.removeMuiSwitch('confirm');
                            return false;
                        }
                        else if (res.returnCode.replace(' ', '') !== 'OK') {
                            //确定失败
                            leon.removeMuiSwitch('confirm');
                        }else {
                            //确定成功
                            leon.view.confirm = true;
                        }
                        // mui.alert(res.data,'YUDO ERP');
                    });
                }else{
                    //取消确定
                    params.confirmYn = 'CD';
                    http.post(leon.api.targetConfirm,params,function (res) {
                        if(res.returnCode == 'noCurrency'){
                            mui.alert(leon.lang.noCurrCd,'YUDO ERP');
                            return false;
                        }
                        else if(res.returnCode == 'H001'){
                            mui.alert(leon.lang.mustSaveTarget,'YUDO ERP');
                            leon.addMuiSwitch('confirm');
                            return false;
                        }
                        else if(res.returnCode.replace(' ', '') !== 'OK') {
                            //取消失败
                            leon.addMuiSwitch('confirm');
                        }else {
                            //取消成功
                            leon.view.confirm = false;
                        }
                        // mui.alert(res.data,'YUDO ERP');
                    });
                }
            })
        },
        //手动执行关闭mui开光
        removeMuiSwitch:function(dom){
            jq(".mui-switch-handle").attr("style","");
            jq('#'+dom).removeClass('mui-active');
        },
        //手动执行打开mui开光
        addMuiSwitch:function(dom){
            jq(".mui-switch-handle").attr("style","");
            jq('#'+dom).addClass('mui-active');
        },
        //关闭职员查询界面
        closeUserSearch:function() {
            this.list.userList = [];
            this.view.usersIsLoading = false;
            this.view.usersNoData = false;
            this.view.viewUserSearch = false;
            if(this.view.opening == 'write')this.showTargetWrite();
            if(this.view.opening == 'search')this.showTargetMinute('back');
        },
        //显示目标填写查询界面
        showTargetSearch:function(){
            this.view.viewTargetSearch = true;
            this.view.viewTargetWrite = false;
            setTimeout(function () {
                jq('#muiPushTarget').scroll(function(){
                    console.log(33);
                    var bottom = document.getElementById('muiPushTarget').scrollHeight - document.getElementById('muiPushTarget').clientHeight - jq('#muiPushTarget').scrollTop();
                    if(bottom == 0 && leon.list.writeTargetList.length > 0){
                        leon.getWirteTargetMore();
                    }
                });
            },500);
        },
        //关闭目标填写查询界面
        closeTargetSearch:function(){
            this.view.viewTargetSearch = false;
            this.showTargetWrite();
        },
        //检查填写项是否为空
        checkTargetWirte:function(){
            if(this.input.targetDate == '') return false;
            if(this.input.userId == '') return false;
            if(this.input.groupId == '') return false;
            if(this.input.expClass == '') return false;
            if(this.input.currency == '') return false;
            if(this.input.orderAmt == '') return false;
            if(this.input.invoiceAmt == '') return false;
            if(this.input.billAmt == '') return false;
            if(this.input.receiptAmt == '') return false;
        },
        //清空目标填写信息
        clearTargetWirte:function(check){
            check || mui.showLoading('loading');
            this.view.confirm = false;
            this.input.targetDate = '';
            this.input.userNm = this.userNm;
            this.input.userId = this.userId;
            this.input.groupNm = this.groupNm;
            this.input.groupId = this.groupId;
            this.input.expClass = '1';
            this.input.currency = 'RMB';
            this.input.orderAmt = '';
            this.input.invoiceAmt = '';
            this.input.billAmt = '';
            this.input.receiptAmt = '';
            setTimeout(function () {
                leon.removeMuiSwitch('confirm');
                mui.hideLoading();
            },600);
        },
        setWriteTarget:function(index){
            mui.showLoading('loading');
            this.view.isRewrite = true;
            this.view.xwrite = true;
            this.closeTargetSearch();
            this.input.targetDate = this.list.writeTargetList[index].SAPlanDate.substr(0,10);
            this.input.userNm   = this.list.writeTargetList[index].EmpNm;
            this.input.userId   = this.list.writeTargetList[index].EmpID;
            this.input.groupNm  = this.list.writeTargetList[index].DeptNm;
            this.input.groupId  = this.list.writeTargetList[index].DeptCd;
            this.input.expClass = this.list.writeTargetList[index].ExpClss;
            this.input.currency = this.list.writeTargetList[index].CurrCd;
            this.input.orderAmt = parseInt(this.list.writeTargetList[index].OrderAmt);
            this.input.invoiceAmt = parseInt(this.list.writeTargetList[index].InvoiceAmt);
            this.input.billAmt    = parseInt(this.list.writeTargetList[index].BillAmt);
            this.input.receiptAmt = parseInt(this.list.writeTargetList[index].ReceiptAmt);
            setTimeout(function () {
                if(leon.list.writeTargetList[index].CfmYn == 1){
                    leon.addMuiSwitch('confirm');
                    leon.view.confirm = true;
                }else{
                    leon.removeMuiSwitch('confirm');
                    leon.view.confirm = false;
                }
                mui.hideLoading();
            },600);
        },
        //获取填写的目标列表
        getWriteTarget:function(){
            mui.showLoading('loading...');
            this.list.writeTargetList = [];
            var params = {};
            params.userNm = this.input.searchUserNm;
            params.userId = this.userId;
            params.startTime = this.input.searchStartTime;
            params.endTime = this.input.searchEndTime;
            params.groupNm = this.input.searchGroupNm;
            params.count = 0;
            http.get(this.api.getWriteTarget,params,function (res) {
                mui.hideLoading();
                console.log(res);
                if(res.returnCode == 'userPermission'){
                    mui.alert(leon.lang.noPermission,'YUDO ERP')
                    return false;
                }
                else if(res.returnCode == 'NULL' || res.data[0].length < 50){
                    leon.view.writeTargetIsLoading = false;
                    leon.view.writeTargetNoData = true;
                } else{
                    leon.view.writeTargetIsLoading = true;
                    leon.view.writeTargetNoData = false;
                }
                leon.list.writeTargetList = res.data[0];
                leon.input.searchTargetCount += 50;
            });
        },
        //获取更多填写的目标列表
        getWirteTargetMore:function(){
            var params = {};
            params.userNm = this.input.searchUserNm;
            params.userId = this.input.searchUserId;
            params.groupNm = this.input.searchGroupNm;
            params.count = this.input.searchTargetCount;
            http.get(this.api.getWriteTarget,params,function (res) {
                mui.hideLoading();
                console.log(res);
                if(res.returnCode == 'NULL' || res.data[0].length < 50){
                    leon.view.writeTargetIsLoading = false;
                    leon.view.writeTargetNoData = true;
                    return false;
                }else{
                    leon.view.writeTargetIsLoading = true;
                    leon.view.writeTargetNoData = false;
                }
                for(var i=0;i<res.data[0].length;i++){
                    leon.list.writeTargetList.push(res.data[0][i]);
                }
                leon.input.searchTargetCount += 50;
            });
        },
        //获取职员列表
        getUsers:function(){
            mui.showLoading('loading...');
            this.list.userList = [];
            var params = {};
            params.userNm = this.input.searchUserNm;
            params.userId = this.input.searchUserId;
            params.groupNm = this.input.searchGroupNm;
            params.count = 0;
            http.get(this.api.getUsers,params,function (res) {
                if(res.returnCode == 'NULL' || res.data[0].length < 50){
                    leon.view.usersIsLoading = false;
                    leon.view.usersNoData = true;
                }else{
                    leon.view.usersIsLoading = true;
                    leon.view.usersNoData = false;
                }
                leon.list.userList = res.data[0];
                leon.input.searchUserCount += 50;
                mui.hideLoading();
            });
        },
        //下拉获取更多职员列表
        getUsersMore:function(){
            var params = {};
            params.userNm = this.input.searchUserNm;
            params.userId = this.input.searchUserId;
            params.groupNm = this.input.searchGroupNm;
            params.count = this.input.searchUserCount;
            http.get(this.api.getUsers,params,function (res) {
                if(res.returnCode == 'NULL' || res.data[0].length < 50){
                    leon.view.usersIsLoading = false;
                    leon.view.usersNoData = true;
                }else{
                    leon.view.usersIsLoading = true;
                    leon.view.usersNoData = false;
                }
                for(var i=0;i<res.data[0].length;i++){
                    leon.list.userList.push(res.data[0][i]);
                }
                leon.input.searchUserCount += 50;
            });
        },
        setUsers:function(e){
            if(this.view.opening == 'write'){
                this.input.userId = this.list.userList[e].EmpID;
                this.input.userNm = this.list.userList[e].EmpNm;
                this.input.groupId = this.list.userList[e].DeptCd;
                this.input.groupNm = this.list.userList[e].DeptNm;
            }
            if(this.view.opening == 'search'){
                this.input.optUserId = this.list.userList[e].EmpID;
                this.input.optUserNm = this.list.userList[e].EmpNm;
            }
            this.closeUserSearch();
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
        //获取领导人名称
        getLeaderNm:function(e){
            console.log(e);
            this.input.leaderNm = this.list.targetAllAdmin[e].text;
        },
        //保存销售目标
        setTargetMinute:function(){
            if(this.mustWrite() == false){
                mui.alert(leon.lang.mustWrite,'YUDO ERP');
                return false;
            }
            if(this.view.confirm == true){
                mui.alert(leon.lang.targetIsConfirm,'YUDO ERP');
                return false;
            }
            // var reg = new RegExp(/^\d+(?=\.{0,1}\d+$|$)/);
            var reg = new RegExp(/^0|\+?[1-9][0-9]*$/);
            if(!reg.test(this.input.orderAmt) || !reg.test(this.input.invoiceAmt) || !reg.test(this.input.billAmt) || !reg.test(this.input.receiptAmt)){
                mui.alert(leon.lang.targetMustInt,'YUDO ERP');
                return false;
            }
            mui.showLoading('loading...');
            var params = {};
            params.date = this.input.targetDate;
            params.userId = this.input.userId;
            params.groupId = this.input.groupId;
            params.expClass = this.input.expClass;
            params.currency = this.input.currency;
            params.orderAmt = this.input.orderAmt;
            params.invoiceAmt = this.input.invoiceAmt;
            params.billAmt = this.input.billAmt;
            params.receiptAmt = this.input.receiptAmt;
            http.post(this.api.setTarget,params,function (res) {
                switch (res.returnCode) {
                    case 'noCurrency':
                        mui.alert(leon.lang.noCurrCd,'YUDO ERP');
                        break;
                    case 'I001':
                        mui.alert(leon.lang.mustWrite,'YUDO ERP');
                        break;
                    case 'hasRecord':
                        mui.alert(leon.lang.hasRecord,'YUDO ERP');
                        break;
                    case 'saveSuccess':
                        mui.alert(leon.lang.recordIsconfirm,'YUDO ERP');
                        break;
                    case 0:
                        mui.alert(leon.lang.saveSuccess,'YUDO ERP');
                        break;
                    case 'addErr':
                        mui.alert(leon.lang.saveFalse,'YUDO ERP');
                        break;
                }
            });
        },
        //必须填写项
        mustWrite:function(){
            if(this.input.targetDate == '') return false;
            if(this.input.userId == '') return false;
            if(this.input.groupId == '') return false;
            if(this.input.expClass == '') return false;
            if(this.input.currency == '') return false;
            if(this.input.orderAmt == '') return false;
            if(this.input.invoiceAmt == '') return false;
            if(this.input.billAmt == '') return false;
            if(this.input.receiptAmt == '') return false;
            return true;
        },
        //填写目标时间选择
        setTargetDate:function(){
            if(this.view.confirm == true){
                mui.alert(leon.lang.targetIsConfirm,'YUDO ERP');
                return false;
            }
            if(this.view.isRewrite == true){
                mui.alert(leon.lang.xwrite,'YUDO ERP');
                return false;
            }
            this.changeDate('date',function (e) {
                leon.clearTargetWirte();
                leon.input.targetDate = e.text;
            })  
        },
        setTargetStartTime:function(){
            this.changeDate('date',function (e) {
                leon.input.searchStartTime = e.text;
            });
        },
        setTargetEndTime:function(){
            this.changeDate('date',function (e) {
                leon.input.searchEndTime = e.text;
            });

        },
        //查询目标时间选择
        searchDate:function(){
            var type = 'date';
            if(this.nowDateItem == 2){
                var type = 'date';
            }else {
                var type = 'month';
            }
            this.changeDate(type,function (e) {
                if(leon.nowDateItem == 0){
                    leon.salesTargetDate = e.text.substr(0,4);
                }else if(leon.nowDateItem == 1){
                    leon.salesTargetDate = e.text.substr(0,7);
                }else{
                    leon.salesTargetDate = e.text;
                }
                leon.getTarget();
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
        //切换查询分类
        changeProject:function(value){
            this.view.optAllAdmin = false;
            this.view.optGroupAdmin = false;
            this.view.optGroupAdmin_c = false;
            this.view.optUser = false;
            mui.showLoading('loading');
            this.lang.nowUnit = this.lang.unitInfo;
            console.log(this.permission)
            switch (value){
                case 'C001':
                    this.view.optAllAdmin = true;
                    if(leon.permission != leon.auth.AUTH_A){
                        leon.input.targetAllAdmin = {value:'permission',text:leon.lang.noPermission};
                        leon.list.targetAllAdmin = [{value:'permission',text:leon.lang.noPermission}];
                        mui.hideLoading();
                        return false;
                    }
                    http.get(this.api.getLeader,{},function (res) {
                        console.log(res);
                        if(res.returnCode == 0){
                            leon.list.targetAllAdmin = res.data[0];
                            leon.list.targetAllAdmin.unshift({value:'ALL',text:leon.lang.allResults});
                        }
                    })
                    break;
                case 'C002':
                    this.view.optGroupAdmin = true;
                    if(leon.permission != leon.auth.AUTH_A && leon.permission != leon.auth.AUTH_M ){
                        leon.input.targetGroupAdmin = {value:'permission',text:leon.lang.noPermission};
                        leon.list.targetGroupAdmin = [{value:'permission',text:leon.lang.noPermission}];
                        mui.hideLoading();
                        return false;
                    }
                    http.get(this.api.getMempId,{},function (res) {
                        console.log(res);
                        if(res.returnCode == 0){
                            leon.list.targetGroupAdmin = res.data[0];
                            leon.list.targetGroupAdmin.unshift({value:'ALL',text:leon.lang.allResults});
                        }
                    })
                    break;
                case 'C003':
                    this.view.optGroupAdmin_c = true;
                    if(leon.permission != leon.auth.AUTH_A && leon.permission != leon.auth.AUTH_M && leon.permission != leon.auth.AUTH_D){
                        leon.input.targetGroupAdmin_c = {value:'permission',text:leon.lang.noPermission};
                        leon.list.targetGroupAdmin_c = [{value:'permission',text:leon.lang.noPermission}];
                        mui.hideLoading();
                        return false;
                    }
                    http.get(this.api.getDeptId,{},function (res) {
                        console.log(res);
                        if(res.returnCode == 0){
                            leon.list.targetGroupAdmin_c = res.data[0];
                            leon.list.targetGroupAdmin_c.unshift({value:'ALL',text:leon.lang.allResults});
                        }
                    })
                    break;
                case 'C004':
                    this.view.optUser = true;
                    http.get(this.api.getDeptId,{},function (res) {
                        console.log(res);
                        if(res.returnCode == 0){
                            leon.list.targetUser = res.data[0];
                            leon.input.targetUser = res.data[0][0];
                            // leon.list.targetGroupAdmin_c.unshift({value:'ALL',text:leon.lang.allResults});
                        }else if(res.returnCode == 'user'){
                            leon.list.targetUser = [{value:leon.groupId,text:leon.groupNm}];
                            leon.input.targetUser = {value:leon.groupId,text:leon.groupNm};
                        }
                    });
                    // mui.hideLoading();
                    this.lang.nowUnit = this.lang.unitInfo;
                    this.view.optUser = true;
                    break;
            }
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
        //切换年月日
        changeInfoItem:function (e) {
            mui.showLoading('loading');
            if(this.view.echarts != '')this.view.echarts.clear();
            this.list.targetList = [];
            this.view.targetNoData = true;
            this.view.echartsNoData = true;
            this.yearItem['active'] = false;
            this.monthItem['active'] = false;
            this.dayItem['active'] = false;
            var nowDate = this.getNowDate('array');
            switch (e){
                case 0:
                    this.nowDateItem = 0;
                    this.yearItem['active'] = true;
                    this.salesTargetDate =nowDate[0];
                    break;
                case 1:
                    this.nowDateItem = 1;
                    this.salesTargetDate = nowDate[0]+'-'+nowDate[1];
                    this.monthItem['active'] = true;
                    break;
                case 2:
                    this.nowDateItem = 2;
                    this.salesTargetDate = nowDate[0]+'-'+nowDate[1]+'-'+nowDate[2];
                    this.dayItem['active'] = true;
                    break;
            }
            mui.hideLoading();
            //更新数据
            // this.getTarget();
        },
        getTarget:function(){
            this.list.targetList = [];
            this.view.targetNoData = true;
            this.view.echartsNoData = true;

            if(this.input.searchGroup == 'C001'){
                this.view.viewPlan = true;
                this.getGroupTarget('leader');
            } else if(this.input.searchGroup == 'C002'){
                this.view.viewPlan = true;
                this.getGroupTarget('mempId');
            } else if(this.input.searchGroup == 'C003'){
                this.view.viewPlan = true;
                this.getGroupTarget('deptId');
            } else if(this.input.searchGroup == 'C004'){
                // this.getUserTarget();
                this.view.viewPlan = false;
                this.getGroupTarget('userId');
            }
            this.isactive = 0;
            if(this.view.echarts != '')this.view.echarts.clear();
        },
        //查询个人销售目标/业绩
        getUserTarget:function(){
            this.list.targetList = [];
            var params = {};
            params.userId = this.input.optUserId;
            params.userNm = this.input.optUserNm;
            if(this.input.optUserId == ''){
                mui.alert(leon.lang.mustWriteSales,'YUDO ERP');
                return false;
            }
            mui.showLoading('loading');
            //查询年
            if(this.nowDateItem == 0){
                params.dateItem =  'y'
                var year = this.salesTargetDate;
                params.dateRound = [year,year-1];
            //查询月
            }else if(this.nowDateItem == 1){
                var year = this.salesTargetDate.substr(0,4);
                var month = this.salesTargetDate.substr(5,2);
                params.dateRound = [this.getMonthStr(year,month,0),this.getMonthStr(year,month,-1)];
                params.dateItem = 'm';
            //查询日
            }else{
                params.dateItem = 'd';
                var year = this.salesTargetDate.substr(0,4);
                var month = this.salesTargetDate.substr(5,2);
                var day = this.salesTargetDate.substr(8,2)
                params.dateRound = [this.getDayStr(year,month,day,0),this.getDayStr(year,month,day,-1)];
            }

            http.post(this.api.getUserTarget,params,function (res) {
                console.log(res);
                if(res.returnCode == 0){
                    leon.view.targetNoData = false;
                    var list = [];
                    list[0] = res.data;
                    leon.list.targetList = list;
                    leon.list.targetListMinute = res.data;
                    leon.buildHistogram(leon.list.targetListMinute,leon.nowDateItem)
                }else if(res.returnCode == 'NULL'){

                }else if(res.returnCode == 'userPermission'){
                    mui.alert(leon.lang.onlySearchMine,'YUDO ERP');
                }else if(res.returnCode == 'permission'){
                    mui.alert(leon.lang.onlySearchMineUser,'YUDO ERP');
                }
            });
        },
        //查询领导管辖下各部门销售目标/业绩
        getGroupTarget:function(check){
            var _api = '';
            var params = {};
            //查询年
            if(this.nowDateItem == 0){
                params.dateItem =  'y'
                params.date = this.salesTargetDate+'-12-31';
                var year = this.salesTargetDate;
                params.dateRound = [year,year-1];
                //查询月
            }else if(this.nowDateItem == 1){
                params.dateItem = 'm';
                var d = new Date(2015,2,0);
                var year = this.salesTargetDate.substr(0,4);
                var month = this.salesTargetDate.substr(5,2);
                var dateObj = new Date(year,month,0);
                params.date = this.salesTargetDate+'-'+dateObj.getDate();
                params.dateRound = [this.getMonthStr(year,month,0),this.getMonthStr(year,month,-1)];
                //查询日
            }else{
                this.view.viewPlan = false;
                params.dateItem = 'd';
                params.date = this.salesTargetDate;
                var year = this.salesTargetDate.substr(0,4);
                var month = this.salesTargetDate.substr(5,2);
                var day = this.salesTargetDate.substr(8,2)
                params.dateRound = [this.getDayStr(year,month,day,0),this.getDayStr(year,month,day,-1)];
            }
            if(check == 'leader'){
                if(this.permission != leon.auth.AUTH_A){
                    mui.alert(leon.lang.noPermission,'YUDO ERP');
                    return false;
                }
                _api = this.api.getLeaderTarget;
                params.leaderNm = this.input.targetAllAdmin.text;
                params.leaderId = this.input.targetAllAdmin.value;
            }else if(check == 'mempId'){
                if(this.permission != leon.auth.AUTH_A && this.permission != leon.auth.AUTH_M){
                    mui.alert(leon.lang.noPermission,'YUDO ERP');
                    return false;
                }
                _api = this.api.getMempIdTarget;
                params.mempNm = this.input.targetGroupAdmin.text;
                params.mempId = this.input.targetGroupAdmin.value;
            }else if(check == 'deptId'){
                if(this.permission != leon.auth.AUTH_A && this.permission != leon.auth.AUTH_M && this.permission != leon.auth.AUTH_D){
                    mui.alert(leon.lang.noPermission,'YUDO ERP');
                    return false;
                }
                _api = this.api.getDeptIdTarget;
                params.deptNm = this.input.targetGroupAdmin_c.text;
                params.deptId = this.input.targetGroupAdmin_c.value;
            }else if(check  == 'userId'){
                if(this.input.targetUser.value == ''){
                    mui.alert(leon.lang.mustChooseGroup,'YUDO ERP')
                    return false;
                }
                _api = this.api.getUserTarget;
                params.deptNm = this.input.targetUser.text;
                params.deptId = this.input.targetUser.value;
            }
            mui.showLoading('loading');
            http.post(_api,params,function (res) {
                console.log(res);
                if(res.data != ''){
                    leon.view.targetNoData = false;
                    leon.list.targetList = res.data;
                    leon.list.targetListMinute = res.data[0];
                    leon.buildHistogram(leon.list.targetListMinute,leon.nowDateItem)
                    var _sum = [];
                    for(var s = 0;s < 1;s++){
                        var orderAmtSum = {target:0,plan:0, results:0};
                        var invoiceAmtSum = {target:0,plan:0, results:0};
                        var billAmtSum = {target:0,plan:0,results:0};
                        var receiptAmtSum = {target:0,plan:0, results:0};
                        for(var i = 0;i < res.data.length;i++){
                            orderAmtSum.target += Number((res.data[i][s].orderAmt.target));
                            orderAmtSum.plan += Number((res.data[i][s].orderAmt.plan));
                            orderAmtSum.results +=  Number(res.data[i][s].orderAmt.salesRecord);
                            invoiceAmtSum.target +=  Number(res.data[i][s].InvoiceAmt.target);
                            invoiceAmtSum.plan +=  Number(res.data[i][s].InvoiceAmt.plan);
                            invoiceAmtSum.results +=  Number(res.data[i][s].InvoiceAmt.salesRecord);
                            billAmtSum.target +=  Number(res.data[i][s].BillAmt.target);
                            billAmtSum.plan +=  Number(res.data[i][s].BillAmt.plan);
                            billAmtSum.results +=  Number(res.data[i][s].BillAmt.salesRecord);
                            receiptAmtSum.target +=  Number(res.data[i][s].ReceiptAmt.target);
                            receiptAmtSum.plan +=  Number(res.data[i][s].ReceiptAmt.plan);
                            receiptAmtSum.results +=  Number(res.data[i][s].ReceiptAmt.salesRecord);
                        };
                        _sum[s] = {
                            background:'#fff981',
                            titlecolor:'#282832',
                            color:'#000',
                            name:'Total',
                            orderAmt:{
                                date:res.data[0][s].orderAmt.date,
                                target: orderAmtSum.target == 0 ? 0 : (orderAmtSum.target).toFixed(2),
                                plan:orderAmtSum.plan == 0 ? 0 : (orderAmtSum.plan).toFixed(2),
                                salesRecord:(orderAmtSum.results).toFixed(2),
                                percent:orderAmtSum.target == 0 ? 0+'%' : (orderAmtSum.results/orderAmtSum.target*100).toFixed(2) +'%',
                                percent2:orderAmtSum.plan == 0 ? 0+'%' : (orderAmtSum.results/orderAmtSum.plan*100).toFixed(2) +'%',
                                percent3:orderAmtSum.plan == 0 ?0+'%' : (orderAmtSum.target/orderAmtSum.plan*100).toFixed(2) +'%'

                            },
                            InvoiceAmt:{
                                date:res.data[0][s].InvoiceAmt.date,
                                target:invoiceAmtSum.target == 0 ? 0 : (invoiceAmtSum.target).toFixed(2),
                                plan:invoiceAmtSum.plan == 0 ? 0 : (invoiceAmtSum.plan).toFixed(2),
                                salesRecord:(invoiceAmtSum.results).toFixed(2),
                                percent:invoiceAmtSum.target == 0 ? 0+'%' : (invoiceAmtSum.results/invoiceAmtSum.target*100).toFixed(2) +'%',
                                percent2:invoiceAmtSum.plan == 0 ? 0+'%' : (invoiceAmtSum.results/invoiceAmtSum.plan*100).toFixed(2) +'%',
                                percent3:invoiceAmtSum.plan == 0 ?0+'%' : (invoiceAmtSum.target/invoiceAmtSum.plan*100).toFixed(2) +'%'
                            },
                            BillAmt:{
                                date:res.data[0][s].BillAmt.date,
                                target:billAmtSum.target == 0 ? 0 : (billAmtSum.target).toFixed(2),
                                plan:billAmtSum.plan == 0 ? 0 : (billAmtSum.plan).toFixed(2),
                                salesRecord:(billAmtSum.results).toFixed(2),
                                percent:billAmtSum.target == 0 ? 0+'%' : (billAmtSum.results/billAmtSum.target*100).toFixed(2) +'%',
                                percent2:billAmtSum.plan == 0 ? 0+'%' : (billAmtSum.results/billAmtSum.plan*100).toFixed(2) +'%',
                                percent3:billAmtSum.plan == 0 ?0+'%' : (billAmtSum.target/billAmtSum.plan*100).toFixed(2) +'%'
                            },
                            ReceiptAmt:{
                                date:res.data[0][s].ReceiptAmt.date,
                                target:receiptAmtSum.target == 0 ? 0 : (receiptAmtSum.target).toFixed(2),
                                plan:receiptAmtSum.plan == 0 ? 0 : (receiptAmtSum.plan).toFixed(2),
                                salesRecord:(receiptAmtSum.results).toFixed(2),
                                percent:receiptAmtSum.target == 0 ? 0+'%' : (receiptAmtSum.results/receiptAmtSum.target*100).toFixed(2) +'%',
                                percent2:receiptAmtSum.plan == 0 ? 0+'%' : (receiptAmtSum.results/receiptAmtSum.plan*100).toFixed(2) +'%',
                                percent3:receiptAmtSum.plan == 0 ?0+'%' : (receiptAmtSum.target/receiptAmtSum.plan*100).toFixed(2) +'%'
                            },
                        };
                    }
                    leon.list.targetList.push(_sum);

                }else if(res.returnCode == 'NULL'){

                }else if(res.returnCode == 'noAllpermission'){
                    mui.alert(leon.lang.cantSearchAll,'YUDO ERP')
                }
            })
        },
        getDayStr:function(year,month,day,AddDayCount){
            var month = month-1;
            var dd = new Date(year,month,day);
            dd.setDate(dd.getDate()+AddDayCount);//获取AddDayCount天后的日期
            var y = dd.getFullYear();
            var m = (dd.getMonth()+1)<10?"0"+(dd.getMonth()+1):(dd.getMonth()+1);//获取当前月份的日期，不足10补0
            var d = dd.getDate()<10?"0"+dd.getDate():dd.getDate();//获取当前几号，不足10补0
            return y+"-"+m+"-"+d;
        },
        getMonthStr:function(year,month,addMonthCount){
            var month = month-1;
            var dd = new Date(year,month,01);
            dd.setMonth(dd.getMonth()+addMonthCount)
            var y = dd.getFullYear();
            var m = (dd.getMonth()+1)<10?"0"+(dd.getMonth()+1):(dd.getMonth()+1);
            return y+"-"+m;
        },
        //查看个人目标图表信息
        getTargetMinute:function(index){
            this.isactive = index;
            jq('#centerControl').scrollTop(jq('#centerControl')[0].scrollHeight);
            this.buildHistogram(this.list.targetList[index],this.nowDateItem)
        },
        changeTheme:function(){
            if(this.view.echarts != '') this.view.echarts.clear();
            this.themeIndex == 0 ? this.themeIndex = 1 : this.themeIndex = 0;
            jq('#centerControl').scrollTop(jq('#centerControl')[0].scrollHeight);
            this.buildHistogram(this.list.targetList[this.isactive],this.nowDateItem);
        },
        //生成柱状图
        buildHistogram:function (data,item) {
            var _tak = 'line'
            if(this.themeIndex == 0){
                _tak = 'line';
            }else {
                _tak = 'bar';
            }
            this.view.echartsNoData = false;
            var theme = {
                color: [
                    '#ff6071',
                    '#ffee6a',
                    '#2196ff',
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
                        leon.lang.results,
                        leon.lang.target,
                        leon.lang.plan
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
                            leon.lang.order,
                            leon.lang.invoice,
                            leon.lang.bill,
                            leon.lang.receipt,
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
                        name:leon.lang.target,
                        type: _tak,
                        data:[data[0].orderAmt.target, data[0].InvoiceAmt.target,data[0].BillAmt.target,data[0].ReceiptAmt.target],
                        itemStyle: {
                            normal: {
                                label: {
                                    show: true, //开启显示
                                    position: 'top', //在上方显示
                                    textStyle: { //数值样式
                                        color: '#ff6071',
                                        fontSize: 11
                                    }
                                }
                            }
                        }

                    },
                    {
                        name:leon.lang.plan,
                        type: _tak,
                        data:[data[0].orderAmt.plan, data[0].InvoiceAmt.plan,data[0].BillAmt.plan,data[0].ReceiptAmt.plan],
                        itemStyle: {
                            normal: {
                                label: {
                                    show: true, //开启显示
                                    position: 'top', //在上方显示
                                    textStyle: { //数值样式
                                        color: '#ffee6a',
                                        fontSize: 11
                                    }
                                }
                            }
                        }

                    },
                    {
                        name: leon.lang.results,
                        type: 'bar',
                        data: [data[0].orderAmt.salesRecord, data[0].InvoiceAmt.salesRecord, data[0].BillAmt.salesRecord, data[0].ReceiptAmt.salesRecord],
                        itemStyle: {
                            normal: {
                                label: {
                                    show: true, //开启显示
                                    position: 'top', //在上方显示
                                    textStyle: { //数值样式
                                        color: '#2196ff',
                                        fontSize: 11
                                    }
                                }
                            }
                        }
                    }
                ]
            });
        }
    }
});

function onlyNum() {
    if(!(event.keyCode==46)&&!(event.keyCode==8)&&!(event.keyCode==37)&&!(event.keyCode==39))
        if(!((event.keyCode>=48&&event.keyCode<=57)||(event.keyCode>=96&&event.keyCode<=105)))
            event.returnValue=false;
}




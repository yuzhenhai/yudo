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
        nowDate:'',
        isactive:0,
        userNm:'',
        userId:'',
        groupNm:'',
        groupId:'',
        themeIndex:'0',
        permission:'E',
        serviceRate:0,
        auth:{

        },
        lang:{
            quoteNo:'报价单号',
            menuBack:'',
        },
        view:{
            menu:true,
            downLoadScript:true,
            showQueryQuote:false,
            showAddQuote:false,
            showQuoteScreen:false,
            showQueryItem:false,
            pageCnt:0,
            showPop: false,
            noData:true,
            pullMore:false,
            quoteAddTitle:'',
            itemPage:0,
            confirm:false,
        },
        api:{
        },
        input:{
            userNm:'',
            userId:'',
            groupNm:'',
            groupId:'',
            quoteNo:'',
            quoteStartDate:'',
            quoteEndDate:'',
        },
        write:{
            QuotNo:'',   QuotDate:'',  DelvDate:'', QuotType:'',
            DeptNm:'',   DeptCd:'',
            EmpNm:'',    EmpId:'',
            Status:'0',
            ValidDate:'', //有效日期
            DelvLimit:'', //交货日期选择
            DelvMethod:'',//交货方法
            Nation:'',    //国家

            CustNm:'',    /*客户名称*/       CustNo:'',    /*客户编码*/        CustCd:'',    /*客户ID*/
            CustomerNm:'',/*注塑厂名称*/     CustomerCd:'',/*注塑厂ID*/        CustomerNo:'',
            AgentNm:'',   /*一级供应商*/     AgentCd:'',   /*一级供应商id*/     AgentNo:'',
            ShipToNm:'',  /*交货处*/         ShipToCd:'',  /*交货处Id*/        ShipToNo:'',
            MakerNm:'',                     MakerCd:'',                       MakerNo:'',

            CustPrsn:'',  /*客户负责人*/     CustFax:'',   /*客户传真*/         CustTel:'',   /*客户电话*/
            CustPrsnHP:'',/*客户负责人HP*/   CustEmail:'', /*客户负责人email*/  CustRemark:'',/*客户要求*/
            GoodClass:'', /*产品分类*/
            Resin:'',     /*塑胶*/
            GoodNm:'',    /*产品名称*/
            RefNo:'',     /*模号*/
            MarketCd:'',  /*Market Name*/
            PProductCd:'',/*Product Name*/
            PPartCd:'',   /*Part Name*/
            PartDesc:'',  /*part description*/
            GoodSpec:'',  /*制成品规格*/
            SrvArea:'',   //保养区域
            QuotDrawNo:'',//图纸号
            CurrCd:'RMB',    /*货币编码*/
            ProposeAmt:0,/*优惠金额*/      QuotAmt:'', /*报价金额*/          QuotVat:0,/*报价单税金*/
            Payment:'',   /*付款方式*/      DisCountRate:0,/*折扣率*/
            Remark:'',    /*备注*/
            QuotAmd:'',   /*Revision No*/
            StdSaleAmt:0,/*标准报价 不含折扣*/
            StdSaleVat:0,
            PrintGubun:'',/*打印区分*/
            CurrRate:1,  /*汇率*/
            SaleVatRate:'',/*增值税率*/
            MiOrderRemark:'',/*未下单原因*/
            ASRecvNo:'',/*AS编号*/

            CfmYn:0,/*确定与否*/
            PrnAmtYn:'N',/*打印金额*/
            VatYn:'N',/*有无缴税*/
            OverseaYn:'N',/*是否转移到海外*/
            ASYn:'N',/*AS认可*/
        },
        item:{
            Sort:'',//序号
            ItemNo:'',//品目编号
            ItemNm:'',//品目名称
            ItemCd:'',//产品型号
            Spec:'',//规格
            UnitCd:'',//单位编码
            Qty:'',//数量
            StdPrice:'',//销售标准单价
            DCRate:'',//折扣率(%)
            DCPrice:'',//折扣单价
            DCAmt:'',//折扣金额
            DCVat:'',//折扣Vat
            Remark:'',//备注
            Nation:'',//国家
            VatYn:'',//有无缴税
            PreStockQty:'',//现库存
            NextQty:'',//进行数量
            StopQty:'',//暂停数量
        },
        list:{
            quotelist:[],
            itemlist:[],//.品目列表
            delItemlist:[],//.已删除品目
            quoteTypelist:[],//报价单区分
            countrylist:[],//.国家列表
            delvDatelist:[],//.交货日期列表
            delvMethodlist:[],//.交货方法列表
            goodClasslist:[],//.产品分类
            marketNmlist:[],//.market
            productlist:[],//.产品种类列表
            partlist:[],//.部件名称列表
            printClasslist:[],//.打印区分列表
            unitlist:[],//.单位编码
            itemCountrylist:[],//.品目国家列表
            srvArealist:[],//.保养区域列表
            statuslist:[],//.状态列表
            currency:[
                {value:'RMB',text:'人民币'},
                {value:'EUR',text:'欧元'},
                {value:'KOR',text:'韩元'},
                {value:'HKD',text:'港币'},
                {value:'JPY',text:'日元'},
                {value:'TWD',text:'台币'},
                {value:'USD',text:'美元'},
            ],

        }
    },
    filters: {
        toFix:function (value) {
            return parseFloat(value).toFixed(0);
        },
        toFix2:function (value) {
            return parseFloat(value).toFixed(2);
        },
        date:function (value) {
            if(value != '' && value != null){
                return value.substr(0,10);
            }else{
                return value;
            }
        },
        dateHi:function(value){
            if(value != '' && value != null){
                return value.substr(5,11);
            }else{
                return value;
            }
        },
        //.报价单状态转换
        statusViewChange:function (value) {
            for(var i in leon.list.statuslist){
                if(leon.list.statuslist[i].value == value){
                    switch (leon.list.statuslist[i].value){
                        case '0':
                            return '<span style="font-size: 13px;padding: 2px 5px" class="yudo-label label-primary">'+leon.list.statuslist[i].text+'</span>';
                            break;
                        case '1':
                            return '<span style="font-size: 13px;padding: 2px 5px" class="yudo-label label-success">'+leon.list.statuslist[i].text+'</span>';
                            break;
                        case '2':
                            return '<span style="font-size: 13px;padding: 2px 5px" class="yudo-label label-primary">'+leon.list.statuslist[i].text+'</span>';
                            break;
                        case 'A':
                            return '<span style="font-size: 13px;padding: 2px 5px" class="yudo-label label-primary">'+leon.list.statuslist[i].text+'</span>';
                            break;
                    }
                }
            }
        },
        //.报价单状态转换
        statusChange:function (value) {
            for(var i in leon.list.statuslist){
                if(leon.list.statuslist[i].value == value){
                    return leon.list.statuslist[i].text;
                }
            }
        },
        vatChange:function(value){
            if(value == 'Y'){
                return 'YES';
            }else{
                return 'NO';
            }
        },
        //.表单界面依据区分转换
        specTypeChangeW:function (value) {
            switch (value){
                case '1':
                    return '<span style="font-size: 14px;padding: 8px 15px;" class="yudo-label label-primary">'+leon.lang.order+'</span>';
                    break;
                case '2':
                    return '<span style="font-size: 14px;padding: 8px 15px" class="yudo-label label-primary">'+leon.lang.afterSaleServiceM+'</span>';
                    break;
            }
        },
        //.车间流程时间为空时转换
        farmIsNull:function (value) {
            if(value == '' || value == null){
                return ' -- ';
            }else{
                return value;
            }
        },
        //.标准化序号
        zero:function (value) {
            if(value+1 < 10){
                return '0'+(value+1);
            }else{
                return value+1;
            }
        }
    },
    mounted(){
        multi.getLang(this.lang,'cache',this._updateLang)
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
        http.get('/WEI_2500/getServiceRate',{},function (res) {
            if(res.returnCode == 0){
                this.serviceRate = res.data.ASChargeRate;
            }
        }.bind(this));
    },
    methods:{
        //多语言转换完成回调
        _updateLang:function(){
            this.view.downLoadScript = false;
            this.nowDate = multi.getNowDate();
            this.input.quoteStartDate = multi.getNowDate();
            this.input.quoteEndDate = multi.getNowDate();
            this.input.productQueryDate = multi.getNowDate();
            this.getQuoteTypeList();
            this.getCountryList();
            this.getDelvDateList();
            this.getDelvMethodList();
            this.getMarketList();
            this.getGoodClassList();
            this.getPrintClassList();
            this.getQuotStatusList();
            this.getUnitList();
            this.getSrvAreaList();
        },
        //显示主菜单
        showMenu:function () {
            this.view.menu = true;
        },
        hideMenu:function(){
            this.view.menu = false;
        },
        showQueryQuote:function(){
            this.view.showQueryQuote = true;
        },
        hideQueryQuote:function(){
            this.view.showQueryQuote = false;
        },
        showAddQuote:function () {
            this.view.quoteAddTitle = '';
            this.view.showAddQuote = true;
            this.clearOuoteInfo();
            setTimeout(function () {
                this.switchinit();
            }.bind(this),100)
        },
        hideAddQuote:function () {
            this.view.showAddQuote = false;
        },
        showItemInfo(index){
            if(this.write.CurrCd == ''){
                alert(this.lang.mustChooseCurrCd);
                return false;
            }
            this.view.showQueryItem = true;
            this.getItemInfo(index);
        },
        showItem:function(){
            if(this.confirmCheck() == false) return false;
            popItemModal.show(
                function () {
                    popItemModal.hide();
                },function (res) {
                    console.log(res);
                    leon.item.ItemNo = res.ItemNo;
                    leon.item.ItemNm = res.ItemNm;
                    leon.item.ItemCd = res.ItemCd;
                    leon.item.Spec   = res.Spec;
                    leon.item.UnitCd = res.UnitCd;
                    leon.item.PreStockQty = parseFloat(res.PreStockQty).toFixed(0);
                    leon.item.VatYn = res.VatYn;
                    var param = {};
                    param.itemCd = res.ItemCd;
                    param.custCd = leon.write.CustCd;
                    param.date   = leon.write.QuotDate;
                    param.curr   = leon.write.CurrCd;
                    popItemModal.hide();
                    mui.showLoading();
                    http.get('/WEI_2500/getItemPirc',param,function (res) {
                        if(res.returnCode == 0){
                            leon.item.StdPrice = res.data.StdPrice;
                            leon.item.DCRate = 0;
                            leon.itemDCRateChange();
                        }else{
                            mui.alert(leon.lang.itemStdPriceMerror,title);
                        }
                    }.bind(this));
            }.bind(this));
        },
        showEmpy:function(){
            if(this.confirmCheck() == false) return false;
            popEmpyModal.show(function () {
                popEmpyModal.hide();
            },function (res) {
                http.get('/WEI_2500/getQuoteJobPower',{empId:res.EmpID},function (res2) {
                    if(res2.returnCode == 0){
                        this.write.EmpId = res.EmpID;
                        this.write.EmpNm = res.EmpNm;
                        this.write.DeptCd = res.DeptCd;
                        this.write.DeptNm = res.DeptNm;
                    }else{
                        mui.alert('职位权限不足',title);
                    }
                }.bind(this));
                popEmpyModal.hide();
            }.bind(this));
        },
        //显示客户列表
        showCust:function(index){
            if(this.confirmCheck() == false) return false;
            popCustModal.show(function () {
                popCustModal.hide();
            },function (res) {
                if(index == 0){
                    this.write.CustNm = res.CustNm;
                    this.write.CustCd = res.CustCd;
                    this.write.CustNo = res.CustNo;
                    this.getSaleVatRate(res.CustCd)
                }else if(index == 1){
                    this.write.CustomerNm = res.CustNm;/*注塑厂名称*/
                    this.write.CustomerCd = res.CustCd;/*注塑厂ID*/
                    this.write.CustomerNo = res.CustNo;
                }else if(index == 2){
                    this.write.AgentNm = res.CustNm;  /*一级供应商*/
                    this.write.AgentCd = res.CustCd;   /*一级供应商id*/
                    this.write.AgentNo = res.CustNo;
                }else if(index == 3){
                    this.write.ShipToNm = res.CustNm;  /*交货处*/
                    this.write.ShipToCd = res.CustCd;  /*交货处Id*/
                    this.write.ShipToNo = res.CustNo;
                }else if(index == 4){
                    this.write.MakerNm = res.CustNm;
                    this.write.MakerCd = res.CustCd;
                    this.write.MakerNo = res.CustNo;
                }
                popCustModal.hide();
            }.bind(this))
        },
        showAsRecv:function (){
            // if(this.saveCheck() == false) return false;
            if(this.confirmCheck() == false) return false;
            if(this.list.itemlist.length > 0) {
                mui.alert(this.lang.mustDelItem,title);
                return false;
            }
            popAsRecvModal.api = '/WEI_2500/importAs';
            popAsRecvModal.show(function () {
                popAsRecvModal.hide();
            },function (res) {
                console.log(res);
                this.write.DelvDate = this.$options.filters.date(res.ASDelvDate);
                this.write.GoodNm = res.GoodNm;
                this.write.Payment = res.Payment;
                this.write.RefNo = res.RefNo;
                this.write.CustCd = res.CustCd;
                this.write.CustNm = res.CustNm;
                this.write.CustNo = res.CustNo;
                this.write.CurrCd = res.CurrCd;
                this.write.CustTel = res.CustTel;
                this.write.CustPrsn = res.CustPrsn;
                this.write.ASYn   = res.ASYn;
                this.write.CustEmail = res.CustEmail;
                this.write.CustFax = res.CustFax;
                this.write.QuotDrawNo = res.DrawNo;
                this.write.EmpId = res.EmpId;
                this.write.EmpNm = res.EmpNm;
                this.write.DeptCd = res.DeptCd;
                this.write.DeptNm = res.DeptNm;
                this.write.SaleVatRate =  parseInt(res.SaleVatRate*100).toFixed(2);
                if(res.ASYn == 'Y'){
                    multi.openSwitch('AS');
                }else{
                    multi.closeSwitch('AS');
                }
                this.getCurrRate();
                http.get('/WEI_2500/getItemListByAs',{ asNo:res.ASRecvNo},function (res1) {
                    if(res1.returnCode == 0){
                        this.list.itemlist = res1.data[0];
                        http.sync = false;
                        for(let i =0;i < this.list.itemlist.length;i++){
                            var param = {};
                            param.itemCd = this.list.itemlist[i].ItemCd;
                            param.custCd = leon.write.CustCd;
                            param.date   = leon.write.QuotDate;
                            param.curr   = leon.write.CurrCd;
                            http.get('/WEI_2500/getItemPirc',param,function (res2) {
                                if(res2.returnCode == 0){
                                    this.list.itemlist[i].StdPrice = res2.data.StdPrice;
                                    this.list.itemlist[i].DCRate = 0;
                                    //.折扣率变化计算折扣单价和总额
                                    this.list.itemlist[i].DCPrice = (this.list.itemlist[i].StdPrice - (this.list.itemlist[i].StdPrice * (this.list.itemlist[i].DCRate/100))).toFixed(2);
                                    //.数量变化计算折扣金额
                                    this.list.itemlist[i].DCAmt = (this.list.itemlist[i].Qty * this.list.itemlist[i].DCPrice).toFixed(2);
                                }else{
                                    mui.alert(leon.lang.itemStdPriceMerror,title);
                                }
                            }.bind(leon));
                        }
                        http.sync = true;
                        this.sumQuoteAmt();//.汇总报价单价格
                        this.write.ASRecvNo = res.ASRecvNo;
                    }
                }.bind(leon))
                popAsRecvModal.hide();
            }.bind(leon));
        },
        searchQuote:function () {
            this.list.quotelist = [];
            this.view.showQuoteScreen = false;
            this.view.pullMore = false;
            this.view.noData = false;
            this.view.pageCnt = 0;
            mui.showLoading();
            var param = {};
            param.quoteNo = this.input.quoteNo;
            param.quoteStartDate = this.input.quoteStartDate;
            param.quoteEndDate = this.input.quoteEndDate;
            param.custNm = this.input.custNm;
            param.count = this.view.pageCnt;
            http.get('/WEI_2500/getQuoteList',param,function (res) {
                if(res.returnCode == 0){
                    this.disPlayQuoteList(res);
                }
            }.bind(this))
        },
        pullQuoteMore:function(){
            mui.showLoading();
            this.view.pageCnt = this.view.pageCnt+50;
            var param = {};
            param.quoteNo = this.input.quoteNo;
            param.quoteStartDate = this.input.quoteStartDate;
            param.quoteEndDate = this.input.quoteEndDate;
            param.custNm = this.input.custNm;
            param.count = this.view.pageCnt;
            http.get('/WEI_2500/getQuoteList',param,function (res) {
                if(res.returnCode == 0){
                    this.disPlayQuoteList(res);
                }
            }.bind(this))
        },
        disPlayQuoteList:function(res){
            mui.hideLoading()
            if (res.returnCode == 'NULL') {
                this.list.quotelist = [];
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
                        this.list.quotelist.push(list[i]);
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
                this.list.quotelist = list;
                if(list.length < 50){
                    this.view.pullMore = false;
                    this.view.noData = true;
                } else {
                    this.view.pullMore = true;
                    this.view.noData = false;
                }
            }
        },
        chooseQuote:function(index){
            this.view.quoteAddTitle = this.list.quotelist[index].QuotNo;
            this.clearOuoteInfo();
            this.view.showAddQuote = true;
            setTimeout(function () {
                this.switchinit();
            }.bind(this),50)
            this.getQuoteInfo(this.list.quotelist[index].QuotNo);

        },
        //.获取报价单信息
        getQuoteInfo:function($quoteNo){
            mui.showLoading();
            var param = { quoteNo:$quoteNo };
            http.get('/WEI_2500/getQuoteInfo',param,function (res) {
                if(res.returnCode == 0){
                    this.write.QuotNo = res.data.QuotNo;
                    this.write.QuotType = res.data.QuotType;
                    this.write.QuotDate = this.$options.filters.date(res.data.QuotDate);
                    this.write.DelvDate = this.$options.filters.date(res.data.DelvDate);
                    this.write.EmpId = res.data.EmpId;
                    this.write.EmpNm = res.data.EmpNm;
                    this.write.DeptCd = res.data.DeptCd;
                    this.write.DeptNm = res.data.DeptNm;
                    this.write.Status = res.data.Status;
                    this.write.ValidDate = this.$options.filters.date(res.data.ValidDate);
                    this.write.DelvLimit = res.data.DelvLimit;//交货日期选择
                    this.write.DelvMethod = res.data.DelvMethod;//交货方法
                    this.write.Nation = res.data.Nation;    //国家
                    this.write.CustNm = res.data.CustNm;    /*客户名称*/
                    this.write.CustCd = res.data.CustCd;    /*客户ID*/
                    this.write.CustomerNm = res.data.CustomerNm;/*注塑厂名称*/
                    this.write.CustomerCd = res.data.CustomerCd;/*注塑厂ID*/
                    this.write.CustomerNo = res.data.CustomerNo;
                    this.write.AgentNm = res.data.AgentNm;  /*一级供应商*/
                    this.write.AgentCd = res.data.AgentCd;   /*一级供应商id*/
                    this.write.AgentNo = res.data.AgentNo;
                    this.write.ShipToNm = res.data.ShipToNm;  /*交货处*/
                    this.write.ShipToCd = res.data.ShipToCd;  /*交货处Id*/
                    this.write.ShipToNo = res.data.ShipToNo;
                    this.write.MakerNm = res.data.MakerNm;
                    this.write.MakerCd = res.data.MakerCd;
                    this.write.MakerNo = res.data.MakerNo;
                    this.write.CustPrsn = res.data.CustPrsn;  /*客户负责人*/
                    this.write.CustFax = res.data.CustFax;   /*客户传真*/
                    this.write.CustTel = res.data.CustTel;   /*客户电话*/
                    this.write.CustPrsnHP = res.data.CustPrsnHP;/*客户负责人HP*/
                    this.write.CustEmail = res.data.CustEmail; /*客户负责人email*/
                    this.write.CustRemark = res.data.CustRemark;/*客户要求*/
                    this.write.GoodClass = res.data.GoodClass; /*产品分类*/
                    this.write.Resin = res.data.Resin;     /*塑胶*/
                    this.write.GoodNm = res.data.GoodNm;    /*产品名称*/
                    this.write.RefNo = res.data.RefNo;    /*模号*/
                    this.write.MarketCd = res.data.MarketCd; /*Market Name*/
                    this.write.PProductCd = res.data.PProductCd;/*Product Name*/
                    this.write.PPartCd = res.data.PPartCd;   /*Part Name*/
                    this.write.PartDesc = res.data.PartDesc;  /*part description*/
                    this.write.GoodSpec = res.data.GoodSpec;  /*制成品规格*/
                    this.write.SrvArea = res.data.SrvArea;  //保养区域
                    this.write.QuotDrawNo = res.data.QuotDrawNo;//图纸号
                    this.write.CurrCd = res.data.CurrCd;    /*货币编码*/
                    this.write.ProposeAmt = this.$options.filters.toFix2(res.data.ProposeAmt);/*优惠金额*/
                    this.write.QuotAmt = this.$options.filters.toFix2(res.data.QuotAmt); /*报价金额*/
                    this.write.QuotVat = this.$options.filters.toFix2(res.data.QuotVat);/*报价单税金*/
                    this.write.StdSaleAmt = this.$options.filters.toFix2(res.data.StdSaleAmt);/*标准金额 不算折扣*/
                    this.write.StdSaleVat = this.$options.filters.toFix2(res.data.StdSaleVat);
                    this.write.Payment = res.data.Payment;   /*付款方式*/
                    this.write.DisCountRate = this.$options.filters.toFix2(res.data.DisCountRate || 0);/*折扣率*/
                    this.write.Remark  = res.data.Remark;    /*备注*/
                    this.write.QuotAmd = res.data.QuotAmd;   /*Revision No*/
                    this.write.PrintGubun = res.data.PrintGubun;/*打印区分*/
                    this.write.CurrRate = this.$options.filters.toFix2(res.data.CurrRate);  /*汇率*/
                    this.write.SaleVatRate   = this.$options.filters.toFix2(res.data.SaleVatRate*100);/*增值税率*/
                    this.write.MiOrderRemark = res.data.MiOrderRemark;/*未下单原因*/
                    this.write.ASRecvNo = res.data.ASRecvNo;/*AS编号*/

                    this.write.CfmYn = res.data.CfmYn;/*确定与否*/
                    this.write.PrnAmtYn = res.data.PrnAmtYn;/*打印金额*/
                    this.write.VatYn = res.data.VatYn;/*有无缴税*/
                    this.write.OverseaYn = res.data.OverseaYn;/*是否转移到海外*/
                    this.write.ASYn = res.data.ASYn;/*AS认可*/
                    if(res.data.CfmYn == 1){
                        multi.openSwitch('confirm');
                        this.view.confirm = true;
                    }else if(res.data.Status == 'A'){
                        this.view.confirm = true;
                    }else if(res.data.CfmYn == 0 && res.data.Status != 'A'){
                        this.view.confirm = false;
                    }else if(res.data.CfmYn == 0){
                        multi.closeSwitch('confirm');
                    }
                    this.write.PrnAmtYn == 'Y' ? multi.openSwitch('printAmt') : multi.closeSwitch('printAmt');
                    this.write.VatYn == 'Y' ? multi.openSwitch('payTax') : multi.closeSwitch('payTax');
                    this.write.OverseaYn == 'Y' ? multi.openSwitch('tranUntrust') : multi.closeSwitch('tranUntrust');
                    this.write.ASYn == 'Y' ? multi.openSwitch('AS') : multi.closeSwitch('AS');
                    this.getProductList(this.write.MarketCd);
                    this.getPartList(this.write.PProductCd)
                }
            }.bind(this));
            http.get('/WEI_2500/getQuoteItemList',param,function (res) {
                this.list.itemlist = res.data[0];
            }.bind(this));
        },
        //.添加品目
        addItemInfo:function(){
            if(this.confirmCheck() == false) return false;
            if(this.write.CurrCd == ''){
                mui.alert(this.lang.mustChooseCurrCd,title);
                return false;
            }
            if(this.write.CustCd == ''){
                mui.alert(this.lang.mustWriteCustNm,title);
                return false;
            }
            this.view.showQueryItem = true;
            this.view.itemPage = this.list.itemlist.length;
            this.clearItemInfo();
            if(this.list.itemlist.length <= 0){
                this.item.Sort = '0'+'10';
            }else{
                this.item.Sort = '0' + ''+ parseInt(this.list.itemlist[this.list.itemlist.length-1].Sort)+10;
            }
        },
        //.添加国际服务费用
        addServiceCharge:function(){
            if(this.saveCheck() == false) return false;
            if(this.confirmCheck() == false) return false;
            http.get('/WEI_2500/addServiceCharge',{},function (res) {
                if(res.returnCode == 0){
                    if(this.list.itemlist.length <= 0){
                        res.data.Sort = '0'+'10';
                    }else{
                        if(this.list.itemlist[this.list.itemlist.length-1].Sort >= 90){
                            res.data.Sort =  parseInt(this.list.itemlist[this.list.itemlist.length-1].Sort)+10;
                        }else{
                            res.data.Sort = '0' + ''+ (parseInt(this.list.itemlist[this.list.itemlist.length-1].Sort)+10);
                        }
                    }
                    res.data.Qty = 1;
                    res.data.DCRate = 0;
                    res.data.PreStockQty = 0;
                    res.data.NextQty = 0;
                    res.data.StopQty = 0;
                    res.data.DCVat = 0;
                    res.data.StdPrice = 0;
                    var param = {};
                    param.itemCd = res.data.ItemCd;
                    param.custCd = leon.write.CustCd;
                    param.date   = leon.write.QuotDate;
                    param.curr   = leon.write.CurrCd;
                    http.sync = false;
                    http.get('/WEI_2500/getItemPirc',param,function (res2) {
                        if(res2.returnCode == 0){
                            console.log(this.serviceRate);
                            res.data.DCPrice = (this.write.QuotAmt * this.serviceRate).toFixed(2);
                            res.data.DCAmt = res.data.DCPrice;
                        }else{
                            mui.alert(leon.lang.itemStdPriceMerror,title);
                        }
                    }.bind(leon));
                    http.sync = true;
                    this.list.itemlist.push(res.data);
                    this.sumQuoteAmt();//.汇总报价单价格
                }else{
                    mui.alert('ERROR',title);
                }
            }.bind(this));

        },
        //.读取品目信息
        getItemInfo:function(index){
            this.view.itemPage = index;
            this.clearItemInfo();
            this.item.Sort = this.list.itemlist[index].Sort;//序号
            this.item.ItemNo = this.list.itemlist[index].ItemNo;//品目编号
            this.item.ItemNm = this.list.itemlist[index].ItemNm;//品目名称
            this.item.Spec = this.list.itemlist[index].Spec;//规格
            this.item.UnitCd = this.list.itemlist[index].UnitCd;//单位编码
            this.item.Qty = parseFloat(this.list.itemlist[index].Qty).toFixed(0);//数量
            this.item.StdPrice = parseFloat(this.list.itemlist[index].StdPrice).toFixed(2);//销售标准单价
            this.item.DCRate = parseFloat(this.list.itemlist[index].DCRate).toFixed(2);//折扣率(%)
            this.item.DCPrice = parseFloat(this.list.itemlist[index].DCPrice).toFixed(2);//折扣单价
            this.item.DCAmt = parseFloat(this.list.itemlist[index].DCAmt).toFixed(2);//折扣金额
            this.item.DCVat = parseFloat(this.list.itemlist[index].DCVat).toFixed(2);//折扣Vat
            this.item.Remark = this.list.itemlist[index].Remark;//备注
            this.item.Nation = this.list.itemlist[index].Nation;//国家
            this.item.VatYn = this.list.itemlist[index].VatYn;//有无缴税
            this.item.PreStockQty = parseFloat(this.list.itemlist[index].PreStockQty).toFixed(0);//现库存
            this.item.NextQty = parseFloat(this.list.itemlist[index].NextQty).toFixed(0);//进行数量
            this.item.StopQty = parseFloat(this.list.itemlist[index].StopQty).toFixed(0);//暂停数量
        },
        //.保存品目信息
        setItemInfo:function(){
            if(this.confirmCheck() == false) return false;
            if(this.itemCheck() == false) return false;
            var index = this.view.itemPage;
            if(this.list.itemlist.hasOwnProperty(index) == false){
                this.list.itemlist[index] = this.item;
            }
            this.list.itemlist[index].Sort     = this.item.Sort//序号
            this.list.itemlist[index].ItemNo   = this.item.ItemNo;//品目编号
            this.list.itemlist[index].ItemNm   = this.item.ItemNm;//品目名称
            this.list.itemlist[index].ItemCd   = this.item.ItemCd;
            this.list.itemlist[index].Spec     = this.item.Spec;//规格
            this.list.itemlist[index].UnitCd   = this.item.UnitCd;//单位编码
            this.list.itemlist[index].Qty      = parseFloat(this.item.Qty).toFixed(0);//数量
            this.list.itemlist[index].StdPrice = parseFloat(this.item.StdPrice).toFixed(2);//销售标准单价
            this.list.itemlist[index].DCRate   = parseFloat(this.item.DCRate).toFixed(2);//折扣率(%)
            this.list.itemlist[index].DCPrice  = parseFloat(this.item.DCPrice).toFixed(2);//折扣单价
            this.list.itemlist[index].DCAmt    = parseFloat(this.item.DCAmt).toFixed(2);//折扣金额
            this.list.itemlist[index].DCVat    = parseFloat(this.item.DCVat).toFixed(2);//折扣Vat
            this.list.itemlist[index].Remark   = this.item.Remark;//备注
            this.list.itemlist[index].Nation   = this.item.Nation;//国家
            this.list.itemlist[index].VatYn    = this.item.VatYn;//有无缴税
            this.list.itemlist[index].PreStockQty = parseFloat(this.item.PreStockQty).toFixed(0);//现库存
            this.list.itemlist[index].NextQty     = parseFloat(this.item.NextQty).toFixed(0);//进行数量
            this.list.itemlist[index].StopQty     = parseFloat(this.item.StopQty).toFixed(0);//暂停数量
            this.sumQuoteAmt();
            mui.alert(this.lang.addSuccess,title);
            this.view.showQueryItem = false;
        },
        delItem:function(index,event){
            if(this.confirmCheck() == false) return false;
            var delitem = {
                QuotNo:this.write.QuotNo,
                Sort:this.list.itemlist[index].Sort
            };
            this.list.delItemlist.push(delitem);
            var elem =  event.target;
            var nextdom = event.target.parentNode.parentNode;
            elem.style.webkitTransform = 'translate(0,0)';
            nextdom.children[1].style.webkitTransform = 'translate(0,0)';
            this.list.itemlist.splice(index,1);
            this.sumQuoteAmt();
        },
        sumQuoteAmt:function(){
            this.write.QuotAmt = 0;
            this.write.StdSaleAmt = 0;
            for(var i in this.list.itemlist){
                this.write.QuotAmt += parseFloat(this.list.itemlist[i].DCAmt);
                this.write.StdSaleAmt += parseFloat(this.list.itemlist[i].StdPrice * this.list.itemlist[i].Qty);
            }
            this.write.QuotAmt = this.write.QuotAmt.toFixed(2);
            this.write.StdSaleAmt = this.write.StdSaleAmt.toFixed(2);
        },

        //.数量变化计算折扣金额
        itemQtyChange:function(){
            this.item.DCAmt = (this.item.Qty * this.item.DCPrice).toFixed(2);
        },
        //.折扣率变化计算折扣单价和总额
        itemDCRateChange:function(){
            this.item.DCPrice = (this.item.StdPrice - (this.item.StdPrice * (this.item.DCRate/100))).toFixed(2);
            this.itemQtyChange();
        },
        //.折扣单价变化计算折扣率和总额
        itemDCPriceChange:function(){
            this.item.DCRate = (((this.item.StdPrice - this.item.DCPrice) / this.item.StdPrice)*100).toFixed(2);
            this.itemQtyChange();
        },
        //.总折扣率变化
        disCountRateChange:function(){
            if(this.list.itemlist.length > 0){
                for(var i in this.list.itemlist){
                    //.更新所有品目折扣率
                    this.list.itemlist[i].DCRate = this.write.DisCountRate;
                    //.计算所有品目折扣后单价
                    this.list.itemlist[i].DCPrice = (this.list.itemlist[i].StdPrice - (this.list.itemlist[i].StdPrice * (this.list.itemlist[i].DCRate/100))).toFixed(2);
                    //.计算所有品目折扣后总额
                    this.list.itemlist[i].DCAmt = (this.list.itemlist[i].Qty * this.list.itemlist[i].DCPrice).toFixed(2);
                }
                //.汇总所有品目总额
                this.sumQuoteAmt();
            }
        },

        clearOuoteInfo:function(){
            this.write = {
                QuotNo:'',   QuotDate:this.nowDate,  DelvDate:this.nowDate, QuotType:'',
                DeptNm:'',   DeptCd:'',
                EmpNm:'',    EmpId:'',
                Status:'0',
                ValidDate:this.nowDate, //有效日期
                DelvLimit:'', //交货日期选择
                DelvMethod:'',//交货方法
                Nation:'',    //国家

                CustNm:'',    /*客户名称*/       CustCd:'',    /*客户ID*/
                CustomerNm:'',/*注塑厂名称*/     CustomerCd:'',/*注塑厂ID*/        CustomerNo:'',
                AgentNm:'',   /*一级供应商*/     AgentCd:'',   /*一级供应商id*/     AgentNo:'',
                ShipToNm:'',  /*交货处*/         ShipToCd:'',  /*交货处Id*/        ShipToNo:'',
                MakerNm:'',                     MakerCd:'',                       MakerNo:'',
                CustPrsn:'',  /*客户负责人*/     CustFax:'',   /*客户传真*/         CustTel:'',   /*客户电话*/
                CustPrsnHP:'',/*客户负责人HP*/   CustEmail:'', /*客户负责人email*/  CustRemark:'',/*客户要求*/
                GoodClass:'', /*产品分类*/
                Resin:'',     /*塑胶*/
                GoodNm:'',    /*产品名称*/
                RefNo:'',     /*模号*/
                MarketCd:'',  /*Market Name*/
                PProductCd:'',/*Product Name*/
                PPartCd:'',   /*Part Name*/
                PartDesc:'',  /*part description*/
                GoodSpec:'',  /*制成品规格*/
                SrvArea:'',   //保养区域
                QuotDrawNo:'',//图纸号
                CurrCd:'RMB',    /*货币编码*/
                ProposeAmt:0,/*优惠金额*/      QuotAmt:'', /*报价金额*/          QuotVat:0,/*报价单税金*/
                Payment:'',   /*付款方式*/      DisCountRate:0,/*折扣率*/
                Remark:'',    /*备注*/
                QuotAmd:'',   /*Revision No*/
                StdSaleAmt:0,/*标准报价 不含折扣*/
                StdSaleVat:0,
                PrintGubun:'',/*打印区分*/
                CurrRate:1,  /*汇率*/
                SaleVatRate:0,/*增值税率*/
                MiOrderRemark:'',/*未下单原因*/
                ASRecvNo:'',/*AS编号*/

                CfmYn:0,/*确定与否*/
                PrnAmtYn:'N',/*打印金额*/
                VatYn:'N',/*有无缴税*/
                OverseaYn:'N',/*是否转移到海外*/
                ASYn:'N',/*AS认可*/
            };
            this.list.itemlist = [];
            this.list.delItemlist = [];
            this.view.confirm = false;
        },
        clearItemInfo:function(){
            this.item = {
                Sort:'',//序号
                ItemNo:'',//品目编号
                ItemNm:'',//品目名称
                ItemCd:'',
                Spec:'',//规格
                UnitCd:'',//单位编码
                Qty:0,//数量
                StdPrice:0,//销售标准单价
                DCRate:0,//折扣率(%)
                DCPrice:0,//折扣单价
                DCAmt:0,//折扣金额
                DCVat:0,//折扣Vat
                Remark:'',//备注
                Nation:'',//国家
                VatYn:'',//有无缴税
                PreStockQty:0,//现库存
                NextQty:0,//进行数量
                StopQty:0,//暂停数量
            };
        },
        clearQuoteScreen:function () {

        },
        getCurrRate:function(){
            // if(this.quoteCheck() == false) return false;
            var param = {};
            param.date = this.write.QuotDate;
            param.currCd = this.write.CurrCd;
            http.get('/FireWork/getCurrRate',param,function (res) {
                if(res.returnCode == 0){
                    this.write.CurrRate = res.data.BasicStdRate;
                }else{
                    mui.alert(this.lang.noCurrCd,title);
                }
            }.bind(this))
        },
        getSaleVatRate:function(custCd){
            var param = {};
            param.custCd = custCd;
            http.get('/WEI_2500/getSaleVatRate',param,function (res) {
                this.write.SaleVatRate = (res.data.SaleVatRate * 100).toFixed(2);
            }.bind(this))
        },
        getQuoteTypeList:function(){
            http.get('/DictWork/getDict',{classNm:'SA2002'},res => {
                this.list.quoteTypelist = res.data[0];
                this.list.quoteTypelist.unshift({value:'',text:''});
            })
        },

        getCountryList:function(){
            http.get('/DictWork/getCountryList',{},function (res) {
                   this.list.countrylist = res.data[0];
                   this.list.itemCountrylist = res.data[0];
                   this.list.countrylist.unshift({value:'',text:''});
            }.bind(this))
        },
        getDelvDateList:function(){
            http.get('/DictWork/getDelvDateList',{},function (res) {
                this.list.delvDatelist = res.data[0];
                this.list.delvDatelist.unshift({value:'',text:''})
            }.bind(this))
        },
        getDelvMethodList:function(){
            http.get('/DictWork/getDelvMethodList',{},function (res) {
                this.list.delvMethodlist = res.data[0];
                this.list.delvMethodlist.unshift({value:'',text:''})
            }.bind(this))
        },
        getGoodClassList:function(){
            http.get('/DictWork/getGoodClassList',{},function (res) {
                this.list.goodClasslist = res.data[0];
                this.list.goodClasslist.unshift({value:'',text:''})
            }.bind(this));
        },
        getPrintClassList:function(){
            http.get('/DictWork/getPrintClassList',{},function (res) {
                this.list.printClasslist = res.data[0];
                this.list.printClasslist.unshift({value:'',text:''})
            }.bind(this))
        },
        getUnitList:function(){
            http.get('/FireWork/getUnitList',{},function (res) {
                this.list.unitlist = res.data[0];
                this.list.unitlist.unshift({value:'',text:''})
            }.bind(this));
        },
        getSrvAreaList:function(){
            http.get('/DictWork/getSrvAreaList',{},function (res) {
                this.list.srvArealist = res.data[0];
                this.list.srvArealist.unshift({value:'',text:''})
            }.bind(this))
        },
        getQuotStatusList:function(){
            http.get('/DictWork/getQuotStatusList',{},function (res) {
                this.list.statuslist = res.data[0];
                this.list.statuslist.unshift({value:'',text:''})
            }.bind(this))
        },
        getMarketList:function(){
            http.get('/DictWork/getMarketList',{},function (res) {
                this.list.marketNmlist = res.data[0];
                this.list.marketNmlist.unshift({value:'',text:''})
            }.bind(this))
        },
        getProductList:function(parentCd){
            mui.showLoading();
            var param = {};
            param.parentCd = parentCd;
            this.list.partlist = [];
            http.get('/DictWork/getlistByParentCd',param,function (res) {
                this.list.productlist = res.data[0];
                this.list.productlist.unshift({value:'',text:''})
            }.bind(this))
        },
        getPartList:function(parentCd){
            mui.showLoading();
            var param = {};
            param.parentCd = parentCd;
            http.get('/DictWork/getlistByParentCd',param,function (res) {
                this.list.partlist = res.data[0];
                this.list.partlist.unshift({value:'',text:''})
            }.bind(this))
        },
        getInputDate:function(vue){
            multi.searchDate('date',function (e) {
                this.input[vue] = e.text;
            }.bind(this))
        },
        getWriteDate:function(vue){
            if(this.confirmCheck() == false) return false;
            multi.searchDate('date',function (e) {
                this.write[vue] = e.text;
            }.bind(this))
        },
        quoteCheck:function(){
          if(this.write.QuotNo == ''){
              mui.alert(this.lang.mustSaveQuote,title);
              return false;
          }
          return true;
        },
        confirmCheck:function(){
            if(this.write.CfmYn == 1){
                mui.alert(this.lang.Unconfirm,title);
                return false;
            }
            if(this.write.Status == 'A'){
                mui.alert(this.lang.isAdjudication,title);
                return false;
            }
            return true;
        },
        itemCheck:function(){
            if(this.item.ItemNo == ''){
                alert(this.lang.chooseItem);
                return false;
            }
            if(this.item.UnitCd == ''){
                alert(this.lang.unit_mobile);
                return false;
            }
            if(this.item.Qty == '' || this.item.Qty <=0){
                alert(this.lang.chooseNumber);
                return false;
            }
            return true;
        },
        saveCheck:function(){
            if(this.write.QuotDate == ''){
                alert(this.lang.mustWriteQuotDate);
                return false;
            }
            if(this.write.DeptNm == ''){
                alert(this.lang.mustWritePron);
                return false;
            }
            if(this.write.CustNm == ''){
                alert(this.lang.mustWriteCustNm);
                return false;
            }
            if(this.write.CustomerNm == ''){
                alert(this.lang.mustWriteCustomerNm);
                return false;
            }
            if(this.write.MakerNm == ''){
                alert(this.lang.mustWriteMakerNm);
                return false;
            }
            if(this.write.GoodNm == ''){
                alert(this.lang.mustWriteCustNm);
                return false;
            }
            if(this.write.RefNo == ''){
                alert(this.lang.mustWriteRefNo);
                return false;
            }
            if(this.write.Payment == ''){
                alert(this.lang.mustWritePayment);
                return false;
            }
            if(this.write.MarketCd == ''){
                alert('Market Name!');
                return false;
            }
            if(this.write.PProductCd == ''){
                alert('Product Name!');
                return false;
            }
            if(this.write.PPartCd == ''){
                alert('Part Name!');
                return false;
            }
            if(this.write.CurrCd == ''){
                alert(this.lang.mustChooseCurrCd);
                return false;
            }
            if(this.write.SaleVatRate == ''){
                alert(this.lang.mustWriteVat);
                return false;
            }
            return true;
        },
        setQuoteInfo:function(){
            if(this.confirmCheck() == false) return false;
            if(this.saveCheck() == false) return false;
            var param  = {};
            param.ExpClss = '1';
            param.QuotNo = this.write.QuotNo;
            param.QuotType = this.write.QuotType;
            param.QuotDate = this.write.QuotDate;
            param.DelvDate = this.write.DelvDate;
            param.Status = this.write.Status;
            param.EmpId = this.write.EmpId;
            param.EmpNm = this.write.EmpNm;
            param.DeptCd = this.write.DeptCd;
            param.DeptNm = this.write.DeptNm;
            param.ValidDate = this.write.ValidDate;
            param.DelvLimit = this.write.DelvLimit;//交货日期选择
            param.DelvMethod = this.write.DelvMethod;//交货方法
            param.Nation = this.write.Nation;    //国家

            param.CustNm = this.write.CustNm;    /*客户名称*/
            param.CustCd = this.write.CustCd;    /*客户ID*/
            param.CustomerNm = this.write.CustomerNm;/*注塑厂名称*/
            param.CustomerCd = this.write.CustomerCd;/*注塑厂ID*/
            param.CustomerNo = this.write.CustomerNo;
            param.AgentNm = this.write.AgentNm;  /*一级供应商*/
            param.AgentCd = this.write.AgentCd;   /*一级供应商id*/
            param.AgentNo = this.write.AgentNo;
            param.ShipToNm = this.write.ShipToNm;  /*交货处*/
            param.ShipToCd = this.write.ShipToCd;  /*交货处Id*/
            param.ShipToNo = this.write.ShipToNo;
            param.MakerNm = this.write.MakerNm;
            param.MakerCd = this.write.MakerCd;
            param.MakerNo = this.write.MakerNo;
            param.CustPrsn = this.write.CustPrsn;  /*客户负责人*/
            param.CustFax = this.write.CustFax;   /*客户传真*/
            param.CustTel = this.write.CustTel;   /*客户电话*/
            param.CustPrsnHP = this.write.CustPrsnHP;/*客户负责人HP*/
            param.CustEmail = this.write.CustEmail; /*客户负责人email*/
            param.CustRemark = this.write.CustRemark;/*客户要求*/
            param.GoodClass = this.write.GoodClass; /*产品分类*/
            param.Resin = this.write.Resin;     /*塑胶*/
            param.GoodNm = this.write.GoodNm;    /*产品名称*/
            param.RefNo = this.write.RefNo;    /*模号*/
            param.MarketCd = this.write.MarketCd; /*Market Name*/
            param.PProductCd = this.write.PProductCd;/*Product Name*/
            param.PPartCd = this.write.PPartCd;   /*Part Name*/
            param.PartDesc = this.write.PartDesc;  /*part description*/
            param.GoodSpec = this.write.GoodSpec;  /*制成品规格*/
            param.SrvArea = this.write.SrvArea;  //保养区域
            param.QuotDrawNo = this.write.QuotDrawNo;//图纸号
            param.CurrCd = this.write.CurrCd;    /*货币编码*/
            param.ProposeAmt = this.write.ProposeAmt;/*优惠金额*/
            param.QuotAmt = this.write.QuotAmt; /*报价金额*/
            param.QuotVat = this.write.QuotVat;/*报价单税金*/
            param.StdSaleAmt = this.write.StdSaleAmt,/*标准报价 不含折扣*/
            param.StdSaleVat = this.write.StdSaleVat,
            param.Payment = this.write.Payment;   /*付款方式*/
            param.DisCountRate = this.write.DisCountRate;/*折扣率*/
            param.Remark  = this.write.Remark;    /*备注*/
            param.QuotAmd = this.write.QuotAmd;   /*Revision No*/
            param.PrintGubun = this.write.PrintGubun;/*打印区分*/
            param.CurrRate = this.write.CurrRate;  /*汇率*/
            param.SaleVatRate   = this.write.SaleVatRate /100;/*增值税率*/
            param.MiOrderRemark = this.write.MiOrderRemark;/*未下单原因*/
            param.ASRecvNo = this.write.ASRecvNo;/*AS编号*/
            
            param.CfmYn = this.write.CfmYn;/*确定与否*/
            param.PrnAmtYn = this.write.PrnAmtYn;/*打印金额*/
            param.VatYn = this.write.VatYn;/*有无缴税*/
            param.OverseaYn = this.write.OverseaYn;/*是否转移到海外*/
            param.ASYn = this.write.ASYn;/*AS认可*/
            param.itemlist = this.list.itemlist;
            param.delItemlist = this.list.delItemlist;
            if(this.list.itemlist.length <= 0){
                mui.alert(this.lang.mustWriteItem,title);
                return false;
            }
            if(this.write.SaleVatRate > 100){
                mui.alert(this.lang.saleVatRateCheck,title);
                return false;
            }
            mui.showLoading();
            http.post('/WEI_2500/saveQuote',param,function (res) {
                if(res.returnCode == 0){
                    this.getQuoteInfo(res.data);
                    mui.alert(this.lang.saveSuccess,title);
                } else if(res.returnCode == 980){
                    mui.alert(this.lang.noCurrCd,title);
                } else{
                    mui.alert(this.lang.saveErr,title);
                }
            }.bind(this));
        },
        confirm:function(check){
            if(this.quoteCheck() == false) return false;
            var param = {};
            param.quoteNo = this.write.QuotNo;
            param.type = check;
            http.get('/WEI_2500/confirm',param,function (res) {
                mui.alert(res.data,title);
                if(res.returnClass == 'OM00000023'){ //确定成功
                    multi.openSwitch('confirm');
                    this.write.CfmYn = 1;
                    this.view.confirm = true;
                }else if(res.returnClass == 'OM00000030'){ //取消成功
                    multi.closeSwitch('confirm');
                    this.write.CfmYn = 0;
                    this.view.confirm = false;
                }else{
                    if(this.write.CfmYn == 0){
                        multi.closeSwitch('confirm');
                    }else{
                        multi.openSwitch('confirm');
                    }
                }
            }.bind(this))
        },
        subAdjudication:function(){
            if(this.confirmCheck() == false) return false;
            if(this.quoteCheck() == false) return false;
            var param = {};
            param.quoteNo = this.write.QuotNo;
            http.get('/WEI_2500/addOAInterface',param,function (res) {
                if(res.returnCode == 0){
                    this.write.Status = 'A';
                    this.view.confirm = true;
                    mui.alert(this.lang.uploadSuccess,title);
                }else if(res.returnCode == 451){
                    mui.alert(this.lang.recordIsExisted,title);
                }
            }.bind(this))
        },
        unSubAdjudication:function(){
            if(this.quoteCheck() == false) return false;
            var param = {};
            param.quoteNo = this.write.QuotNo;
            http.get('/WEI_2500/delOAInterface',param,function (res) {
                if(res.returnCode == 0){
                    this.write.Status = '0';
                    this.view.confirm = false;
                    mui.alert(this.lang.cancelSuccess)
                }else if(res.returnCode == 450){
                    mui.alert(this.lang.recordIsNot,title);
                }else if(res.returnCode == 452){
                    mui.alert(this.lang.recordIsDoing,title);
                }
            }.bind(this))


        },
        switchinit:function(){
            mui('.mui-switch').switch();
            document.getElementById("confirm").addEventListener("toggle",function(event){
                if(event.detail.isActive){
                    if(this.confirm('CA') == false) multi.closeSwitch('confirm');
                }else{
                    if(this.confirm('CD') == false) multi.openSwitch('confirm');
                }
            }.bind(this));
            //.打印金额
            document.getElementById("printAmt").addEventListener("toggle",function(event){
                if(event.detail.isActive){
                    if(this.confirmCheck() == false){
                        multi.closeSwitch('printAmt')
                        return false;
                    };
                    this.write.PrnAmtYn = 'Y';
                }else{
                    if(this.confirmCheck() == false){
                        multi.openSwitch('printAmt')
                        return false;
                    };
                    this.write.PrnAmtYn = 'N';
                }
            }.bind(this));
            //.有无缴税
            document.getElementById("payTax").addEventListener("toggle",function(event){
                if(event.detail.isActive){
                    if(this.confirmCheck() == false){
                        multi.closeSwitch('payTax')
                        return false;
                    };
                    this.write.VatYn = 'Y';
                }else{
                    if(this.confirmCheck() == false){
                        multi.openSwitch('payTax')
                        return false;
                    };
                    this.write.VatYn = 'N';
                }
            }.bind(this));
            //.转移到海外
            document.getElementById("tranUntrust").addEventListener("toggle",function(event){
                if(event.detail.isActive){
                    if(this.confirmCheck() == false){
                        multi.closeSwitch('tranUntrust')
                        return false;
                    };
                    this.write.OverseaYn = 'Y';
                }else{
                    if(this.confirmCheck() == false){
                        multi.openSwitch('tranUntrust')
                        return false;
                    };
                    this.write.OverseaYn = 'N';
                }
            }.bind(this));
            //.as认可
            document.getElementById("AS").addEventListener("toggle",function(event){
                if(event.detail.isActive){
                    if(this.confirmCheck() == false){
                        multi.closeSwitch('AS')
                        return false;
                    };
                    this.write.ASYn = 'Y';
                }else{
                    if(this.confirmCheck() == false){
                        multi.openSwitch('AS')
                        return false;
                    };
                    this.write.ASYn = 'N';
                }
            }.bind(this));
        },

    }
});

function onlyNum() {
    if(!(event.keyCode==46)&&!(event.keyCode==8)&&!(event.keyCode==37)&&!(event.keyCode==39))
        if(!((event.keyCode>=48&&event.keyCode<=57)||(event.keyCode>=96&&event.keyCode<=105)))
            event.returnValue=false;
}
//二维码回调
function setQRcodeResult(content) {
    if(content.indexOf("/") > 0){
        var orderId = content.split('/')[4];
    }
    else {
        var orderId = content
    }
    if(orderId == ''){
        mui.alert(this.lang.noInfo,title);
    }
    else {
        if(popAsRecvModal.view.showPop == true){
            popAsRecvModal.model.popOrderNo = orderId;
            popAsRecvModal.getData();
        }
    }
}





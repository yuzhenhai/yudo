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

        },
        lang:{
            productNo:'',
            all:'',
            order:'',
            afterSaleServiceM:'',
            productQuery:'',


        },
        view:{
            menu:true,
            downLoadScript:true,
            showProductQuery:false,
            showProductQueryScreen:false,
            showProductInfo:false,
            orderProduct:true,
            asProduct:false,
            loading:false,
            noData:true,
        },
        api:{
        },
        input:{
            userNm:'',
            userId:'',
            groupNm:'',
            groupId:'',
            productQueryDate:'',
            accordingClass:'',//依据区分
            accordingNo:'',//依据编号
            custNm:'',//客户名称
            RefNo:'',//模号
        },
        write:{
            SourceNo:'',//依据编号
            SourceType:'',//依据区分
            WPlanDate:'',//生产接受日期
            ModifyCnt:'',//变更次数
            WDelvChUptDate:'',//变更日期
            CustNm:'',//客户名称
            DelvDate:'',//交货日期
            WDelvChRemark:'',//变更事由
            WDelvDate:'',//生产交期
            DrawDate:'',//图纸接受日期
            OutDate:'',//出图日期
            DrawNo:'',//图纸编号
            DrawAmd:'',//图纸版本
            OrderAsDate:'',//订单-AS日期
            RefNo:'',//模号
            EmpNm:'',//员工姓名
            DeptNm:'',//部门名称
        },
        list:{
            accordingClass:[
                {value:'',text:'全部'},
                {value:'1',text:'订单'},
                {value:'2',text:'售后服务'},
            ],
            productDate:[],
            productFarm:[],
        }
    },
    filters: {
        toFix:function (value) {
            return value.toFixed(0);
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
        //.查询列表依据区分转换
        specTypeChange:function (value) {
            switch (value){
                case '1':
                    return '<span style="font-size: 13px;padding: 2px 5px" class="yudo-label label-success">'+leon.lang.order+'</span>';
                    break;
                case '2':
                    return '<span style="font-size: 13px;padding: 2px 5px" class="yudo-label label-primary">'+leon.lang.afterSaleServiceM+'</span>';
                    break;
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
        this.view.downLoadScript = false;
        // this.input.searchStartTime = multi.getNowDate();
        // this.input.searchEndTime = multi.getNowDate();
        // this.salesTargetDate = multi.getNowDate('array')[0];
    },
    methods:{
        //多语言转换完成回调
        _updateLang:function(){
            this.input.productQueryDate = multi.getNowDate();
            this.list.accordingClass[0].text = this.lang.all;
            this.list.accordingClass[1].text = this.lang.order;
            this.list.accordingClass[2].text = this.lang.afterSaleServiceM;
        },
        //显示主菜单
        showMenu:function () {
            this.view.menu = true;
        },
        hideMenu:function(){
            this.view.menu = false;
        },
        //.显示生产交期查询
        showProductQuery:function () {
            this.view.showProductQuery = true;
        },
        //.隐藏生产交期查询
        hideProductQuery:function () {
            multi.removeTransByCss('trans-1',function () {
                this.view.showProductQuery = false;
                this.list.productDate = [];
            }.bind(this));
        },
        //.显示生产交期详细信息
        showProductInfo:function(){
            this.view.showProductInfo = true;
        },
        //.隐藏生产交期详细信息
        hideProductInfo:function(){
            multi.removeTransByCss('trans-2',function () {
                this.view.showProductInfo = false;
            }.bind(this));
        },
        //.清空筛选内容
        clearProductQueryScreen:function(){
            this.input.accordingClass = '';
            this.input.accordingNo = '';
            this.input.custNm = '';
        },
        setProduct:function(index){
            this.lang.productNo = this.list.productDate[index].SourceNo;
            this.showProductInfo();
            setTimeout(function () {
                if(this.list.productDate[index].SourceType == 1){//订单-AS日期 //ASDelvDate
                    this.view.orderProduct = true;
                    this.view.asProduct = false;
                }else{
                    this.view.asProduct = true;
                    this.view.orderProduct = false;
                }
                this.write.OrderAsDate = this.$options.filters.date(this.list.productDate[index].OrderDate); //订单日期
                this.write.DelvDate = this.$options.filters.date(this.list.productDate[index].DelvDate);//交货日期
                this.write.SourceNo   = this.list.productDate[index].SourceNo;  //依据编号
                this.write.SourceType = this.list.productDate[index].SourceType;//依据区分
                this.write.WkAptDate  =this.$options.filters.dateHi(this.list.productDate[index].WkAptDate); //生产接受日期
                this.write.WPlanCfmDate = this.$options.filters.dateHi(this.list.productDate[index].WPlanCfmDate); //作业指示日期
                this.write.ModifyCnt  = this.list.productDate[index].ModifyCnt; //变更次数
                this.write.WDelvChUptDate = this.$options.filters.dateHi(this.list.productDate[index].WDelvChUptDate) || '00-00 00:00'; //变更日期
                this.write.CustNm   = this.list.productDate[index].CustNm;     //客户名称
                this.write.WDelvChRemark = this.list.productDate[index].WDelvChRemark;//变更事由
                this.write.WDelvDate     = this.$options.filters.date(this.list.productDate[index].WDelvDate);    //生产交期
                this.write.OutDate       = this.$options.filters.dateHi(this.list.productDate[index].OutDate);      //出图日期
                this.write.DrawNo = this.list.productDate[index].DrawNo + '  ' +this.list.productDate[index].DrawAmd; //图纸编号+图纸版本
                this.write.RefNo = this.list.productDate[index].RefNo; //模号
                this.write.EmpNm = this.list.productDate[index].EmpNm; //员工姓名
                this.write.DeptNm = this.list.productDate[index].DeptNm; //部门名称
                this.write.DrawDate = this.$options.filters.dateHi(this.list.productDate[index].AptDate); //图纸接受日期

                mui.showLoading('loading');
                var param = {};
                param.wPlanNo = this.list.productDate[index].WPlanNo;
                http.get('/WEI_2400/getFarmInfo',param,function (res) {
                    if(res.returnCode == 100){

                    }else{
                        this.list.productFarm = res.data[0];
                    }
                }.bind(this));
            }.bind(this),200);
        },

        searchProduct:function(){
            this.view.showProductQueryScreen = false;
            mui.showLoading('loading');
            var param = {};
            param.accordingClass = this.input.accordingClass;
            param.accordingNo = this.input.accordingNo;
            param.custNm = this.input.custNm;
            param.date = this.input.productQueryDate;
            param.RefNo = this.input.RefNo;
            http.get('/WEI_2400/getProductDate',param,function (res) {
                if(res.returnCode == 100){

                }else{
                    this.list.productDate = res.data[0];
                }
            }.bind(this));
        },
        searchDate:function(){
            multi.searchDate('date',function (e) {
                this.input.productQueryDate = e.text;
            }.bind(this))
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
// if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
//     FastClick.prototype.focus = function(targetElement) {
//         targetElement.focus();
//     };
//     FastClick.attach(document.body);
// }




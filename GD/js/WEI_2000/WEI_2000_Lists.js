var leon = new Vue({
    el:'#leon',
    delimiters: ['$((', '))'],
    data:{
        nowDate:'',
        isactive:0,
        userNm:'',
        userId:'',
        groupNm:'',
        groupId:'',
        auth:{

        },
        lang:{
            menuBack:'',
        },
        view:{
            menu:true,
            confirm:false,
            downLoadScript:true,
            showAssmReptAdd:false,
            showAssmReptQuery:false,
            showAssmPhoto:false,
            showTrialPhoto:false,
            showAssmSales:false,
        },
        api:{
        },
        input:{
            userNm:'',
            userId:'',
            groupNm:'',
            groupId:'',
            custNm:'',//客户名称
            RefNo:'',//模号
            searchUserNm:'',
        },
        write:{
            OrderNo:'',//订单号码
            ExpClss:'',
            CustNm:'',//客户名称
            CustId:'',//客户ID
            DelvDate:'',//交货日期
            DrawNo:'',//图纸编号
            DrawAmd:'',//图纸版本
            OrderDate:'',//订单日期
            GateCnt:'',
            SystemType:'',
            RefNo:'',//模号
            EmpNm:'',//员工姓名
            EmpId:'',
            DeptNm:'',//部门名称
            DeptCd:'',
            AssmReptNo:'',
            AssmReptDate:'',
            AssmDate:'',
            CmfYn:0,
            AssmContents:'',//组装报告事项
            Remark:'',//备注
            TrialEmpID:'',//试模人员
            TrialEmpNm:'',
            TrialDeptCd:'',//试模部门
            TrialDeptNm:'',
            TrialDate:'',//试模时间
            TrialContents:'',//试模报告事项
        },
        list: {
            assmSales:[],
            assmPhoto:[],
            trialPhoto:[]
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
        //.时间为空时转换
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
        mui.previewImage();
        this.nowDate = multi.getNowDate();
    },
    methods:{
        _updateLang:function(res){

        },
        getDate:function(vue){
            if(this.checkConfirm() == false){
                return false;
            }
            multi.searchDate('date',function (e) {
                this.write[vue] = e.text;
            }.bind(this))
        },
        showAssmReptAdd:function(){
            this.clearAssmReptInfo();
            this.view.showAssmReptAdd = true;
            setTimeout(function () {
                this.switchinit();
            }.bind(this),10);
        },
        showAssmPhoto:function(){
            if(this.write.AssmReptNo == ''){
                mui.alert(this.lang.mustSaveAssm,title);
                return false;
            }
            this.view.showAssmPhoto = true;
            this.getAssmPhoto();

        },
        showTrialPhoto:function(){
            if(this.write.AssmReptNo == ''){
                mui.alert(this.lang.mustSaveAssm,title);
                return false;
            }
            this.view.showTrialPhoto = true;
            this.getTrialPhoto();
        },
        showAssmSales:function(){
            if(this.write.AssmReptNo == ''){
                mui.alert(this.lang.mustSaveAssm,title);
                return false;
            }
            this.view.showAssmSales = true;
            this.getSales();

        },
        //.组装试模编号选择
        showSearchAssmRept:function(){
            popAssmReptModal.show(this.hideSearchAssmRept,this.setAssmRept);
        },
        hideSearchAssmRept:function(){
            popAssmReptModal.hide();
        },
        getAssmRept:function(orderId){
            var param = { orderid:orderId };
            mui.showLoading();
            http.get('/WEI_2000/order_prc',param,function (orderInfo) {
                mui.hideLoading();
		if(orderInfo.returnCode != 0){
                        return false
                    }
		this.write.OrderNo = orderInfo.data[0][0].OrderNo;
                this.write.ExpClss = orderInfo.data[0][0].ExpClss;
                this.write.CustNm = orderInfo.data[0][0].custname;
                this.write.OrderDate = this.$options.filters.date(orderInfo.data[0][0].OrderDate);
                this.write.DelvDate = this.$options.filters.date(orderInfo.data[0][0].DelvDate);
                this.write.SystemType = orderInfo.data[0][0].SystemType;
                this.write.GateCnt = orderInfo.data[0][0].GateQty;
                http.get('/WEI_2000/mt_prc',param,function (assmInfo) {
                  
			 mui.hideLoading(); 
		    this.write.DeptNm = assmInfo.data.AssmDeptNm;
                    this.write.DeptCd = assmInfo.data.AssmDeptCd;
                    this.write.EmpNm = assmInfo.data.AssmEmpNm;
                    this.write.EmpId = assmInfo.data.AssmEmpID;
                    this.write.AssmReptNo = assmInfo.data.AssmReptNo;
                    this.write.AssmReptDate = this.$options.filters.date(assmInfo.data.AssmReptDate);
                    this.write.AssmDate = this.$options.filters.date(assmInfo.data.AssmDate);
                    this.write.AssmContents = assmInfo.data.AssmContents;
                    this.write.Remark = assmInfo.data.Remark;
                    this.write.TrialEmpId = assmInfo.data.TrialEmpID;
                    this.write.TrialEmpNm = assmInfo.data.TrialEmpNm;
                    this.write.TrialDeptCd = assmInfo.data.TrialDeptCd;
                    this.write.TrialDeptNm = assmInfo.data.TrialDeptNm;
                    this.write.TrialDate = this.$options.filters.date(assmInfo.data.TrialDate);
                    this.write.TrialContents = assmInfo.data.TrialContents;
                    this.write.CfmYn = assmInfo.data.CfmYn;
                    if(assmInfo.data.CfmYn == 0){
                        multi.closeSwitch('confirm');
                        this.view.confirm = false;
                    }else{
                        multi.openSwitch('confirm');
                        this.view.confirm = true;
                    }
                }.bind(this));

            }.bind(this),function (err) {

            },function (complete) {

            });
        },
        setAssmRept:function(res) {
            popEmpyModal.hide();
            this.clearAssmReptInfo();
            this.showAssmReptAdd();
            this.getAssmRept(res.OrderNo);
        },

        //.组装试模人员选择
        showSearchEmpy:function() {
            if(this.checkConfirm() == false){
                return false;
            }
            popEmpyModal.show(this.hideSearchEmpy,this.setEmpy);
        },
        hideSearchEmpy:function() {
            popEmpyModal.hide();
        },
        setEmpy:function(res) {
            popEmpyModal.hide();
            this.write.EmpNm = res.EmpNm;
            this.write.EmpId = res.EmpID;
            this.write.DeptNm = res.DeptNm;
            this.write.DeptCd = res.DeptCd;
            console.log(this.write);
        },

        //.销售负责人选择
        showSearchTrialEmpy:function(){
            if(this.checkConfirm() == false){
                return false;
            }
            popEmpyModal.show(this.hideSearchEmpy,this.setTrialEmpy);
        },
        setTrialEmpy:function(res) {
            console.log(this.write);
            popEmpyModal.hide();
            this.write.TrialEmpNm = res.EmpNm;
            this.write.TrialEmpId = res.EmpID;
            this.write.TrialDeptNm = res.DeptNm;
            this.write.TrialDeptCd = res.DeptCd;
        },

        showSearchOrder:function() {
            popOrderModal.show(this.hideSearchOrder,this.setOrder);
        },
        hideSearchOrder:function () {
            popOrderModal.hide();
        },
        setOrder:function (res) {
            this.clearAssmReptInfo();
            popOrderModal.hide();
            this.write.OrderNo = res.OrderNo;
            this.write.OrderDate = this.$options.filters.date(res.OrderDate);
            this.write.CustNm = res.custname;
            this.write.DelvDate = this.$options.filters.date(res.DelvDate);
            this.write.SystemType = res.SystemType;
            this.write.GateCnt = res.GateQty;
        },

        //.获取销售负责人信息
        getSales:function() {
            setTimeout(function () {
                mui.showLoading();
                var param = {};
                param.assmReptNo = this.write.AssmReptNo;
                http.get('/WEI_2000/getAssmSales',param,function (res) {
                    if(res.returnCode == 0 ){
                        this.list.assmSales = res.data[0];
                    }else{
                        this.list.assmSales = [];
                    }
                }.bind(this));
            }.bind(this),200);
        },
        //.新增销售负责人
        addSales:function(){
            if(this.checkConfirm() == false){
                return false;
            }
            popEmpyModal.show(function () {
                popEmpyModal.hide();
            },function (res) {
                popEmpyModal.hide();
                mui.showLoading();
                var param = {};
                param.mt_id = this.write.AssmReptNo;
                param.sales = [res.EmpID];
                http.post('/WEI_2000/addSales',param,function (res) {
                    if(res.returnCode != 0){
                        mui.alert('error!',title);
                    }else{
                        this.getSales();
                    }
                }.bind(this))
            }.bind(this));
        },
        //.删除销售负责人
        delSales:function(index,event) {
            if(this.checkConfirm() == false){
                return false;
            }
            var elem =  event.target;
            var nextdom = event.target.parentNode.parentNode;
            elem.style.webkitTransform = 'translate(0,0)';
            nextdom.children[1].style.webkitTransform = 'translate(0,0)';
            var params = {};
            params.assmReptNo = this.list.assmSales[index].AssmReptNo;
            params.empId = this.list.assmSales[index].SaleEmpID;
            params.Seq = this.list.assmSales[index].Seq;
            http.post('/WEI_2000/delSales',params,function (res) {
                if(res.returnCode != 0){
                    mui.alert('error!',title);
                }else{
                    this.getSales();
                }
            }.bind(this));
        },

        //.获取组装报告图片
        getAssmPhoto:function(){
            setTimeout(function () {
                mui.showLoading();
                var param = {};
                param.orderId = this.write.OrderNo;
                param.assmReptNo = this.write.AssmReptNo;
                http.get('/WEI_2000/getAssmPhoto',param,function (res) {
                    if(res.returnCode == 0 ){
                        this.list.assmPhoto = res.data[0];
                    }else{
                        this.list.assmPhoto = res.data[0];
                    }
                }.bind(this));
            }.bind(this),200);
        },
        //.上传组装报告图片
        uploadAssmPhoto:function(){
            if(this.checkConfirm() == false){
                return false;
            }
            mui.showLoading();
            var inputFile = document.getElementById('uploadAssmPhoto').files;
            if(inputFile.length <= 0){
                mui.hideLoading();
                return false
            }
            if(inputFile.length > 5){
                mui.alert(this.lang.mustChooseFivePhotos,title);
                mui.hideLoading();
                return false
            }
            var fileList = [];
            for(var i = 0; i < inputFile.length;i++){
                multi.compressImg(inputFile[i],fileList);
            }
            setTimeout(function () {
                var params = {};
                params.assmReptNo = this.write.AssmReptNo;
                params.imageList = fileList;
                http.post('/WEI_2000/uploadAssmPhoto',params,function (res) {
                    if (res.returnCode == 0) {
                        this.getAssmPhoto();
                    }
                }.bind(this));
            }.bind(this),1000);
        },
        //.删除组装报告图片
        delAssmPhoto:function (index,event) {
            if(this.checkConfirm() == false){
                return false;
            }
            var elem =  event.target;
            var nextdom = event.target.parentNode.parentNode;
            elem.style.webkitTransform = 'translate(0,0)';
            nextdom.children[1].style.webkitTransform = 'translate(0,0)';
            var params = {};
            params.assmReptNo = this.write.AssmReptNo;
            params.fileNm = this.list.assmPhoto[index].FileNm;
            params.Seq = this.list.assmPhoto[index].Seq;
            http.post('/WEI_2000/delAssmPhoto',params,function (res) {
                if(res.returnCode != 0){
                    mui.alert('error!',title);
                }else{
                    this.getAssmPhoto();
                }
            }.bind(this));
        },

        //.获取试模报告图片
        getTrialPhoto:function(){
            setTimeout(function () {
                mui.showLoading();
                var param = {};
                param.orderId = this.write.OrderNo;
                param.assmReptNo = this.write.AssmReptNo;
                http.get('/WEI_2000/getTrialPhoto',param,function (res) {
                    if(res.returnCode == 0 ){
                        this.list.trialPhoto = res.data[0];
                    }else{
                        this.list.trialPhoto = [];
                    }
                }.bind(this));
            }.bind(this),200);
        },
        //.上传试模报告图片
        uploadTrialPhoto:function(){
            if(this.checkConfirm() == false){
                return false;
            }
            mui.showLoading();
            var inputFile = document.getElementById('uploadTrialPhoto').files;
            if(inputFile.length <= 0){
                mui.hideLoading();
                return false
            }
            if(inputFile.length > 5){
                mui.alert(this.lang.mustChooseFivePhotos,title);
                mui.hideLoading();
                return false
            }
            var fileList = [];
            for(var i = 0; i < inputFile.length;i++){
                multi.compressImg(inputFile[i],fileList);
            }
            setTimeout(function () {
                var params = {};
                params.assmReptNo = this.write.AssmReptNo;
                params.imageList = fileList;
                http.post('/WEI_2000/uploadTrialPhoto',params,function (res) {
                    if (res.returnCode == 0) {
                        this.getTrialPhoto();
                    }
                }.bind(this));
            }.bind(this),1000);
        },
        //.删除试模报告图片
        delTrialPhoto:function (index,event) {
            if(this.checkConfirm() == false){
                return false;
            }
            var elem =  event.target;
            var nextdom = event.target.parentNode.parentNode;
            elem.style.webkitTransform = 'translate(0,0)';
            nextdom.children[1].style.webkitTransform = 'translate(0,0)';
            var params = {};
            params.assmReptNo = this.write.AssmReptNo;
            params.fileNm = this.list.trialPhoto[index].FileNm;
            params.Seq = this.list.trialPhoto[index].Seq;
            http.post('/WEI_2000/delTrialPhoto',params,function (res) {
                if(res.returnCode != 0){
                    mui.alert('error!',title);
                }else{
                    this.getTrialPhoto();
                }
            }.bind(this));
        },

        confirm:function(check){
            if(this.write.AssmReptNo == ''){
                mui.alert(this.lang.mustSaveAssm,title);
                return false;
            }
            var param = {};
            param.mt_id = this.write.AssmReptNo;
            param.cfm = check;
            http.get('/WEI_2000/confirm',param,function (res) {
                mui.alert(res.data,title);
                if(res.returnClass == 'OM00000023'){ //确定成功
                    multi.openSwitch('confirm');
                    this.write.CfmYn = 1;
                }else{
                    multi.closeSwitch('confirm');
                    this.write.CfmYn = 0;
                }
                if(res.returnClass == 'OM00000030'){ //取消成功
                    multi.closeSwitch('confirm');
                    this.write.CfmYn = 0;
                }else{
                    multi.openSwitch('confirm');
                    this.write.CfmYn = 1;
                }
            }.bind(this))
        },

        switchinit(){
            mui('#confirm').switch();
            document.getElementById("confirm").addEventListener("toggle",function(event){
                if(event.detail.isActive){
                    if(this.confirm('CA') == false) multi.closeSwitch('confirm');
                }else{
                    if(this.confirm('CD') == false) multi.openSwitch('confirm');
                }
            }.bind(this));
        },

        //.重置表单信息
        clearAssmReptInfo(){
            this.view.confirm = false;
            this.write = {
                OrderNo:'',//订单号码
                ExpClss:'',
                CustNm:'',//客户名称
                CustId:'',//客户ID
                DelvDate:'',//交货日期
                DrawNo:'',//图纸编号
                DrawAmd:'',//图纸版本
                OrderDate:'',//订单日期
                GateCnt:'',
                SystemType:'',
                RefNo:'',//模号
                EmpNm:'',//员工姓名
                EmpId:'',
                DeptNm:'',//部门名称
                DeptCd:'',
                AssmReptNo:'',
                AssmReptDate:multi.getNowDate(),
                AssmDate:multi.getNowDate(),
                CmfYn:0,
                AssmContents:'',//组装报告事项
                Remark:'',//备注
                TrialEmpId:'',//试模人员
                TrialEmpNm:'',
                TrialDeptCd:'',//试模部门
                TrialDeptNm:'',
                TrialDate:multi.getNowDate(),//试模时间
                TrialContents:'',//试模报告事项
            }
            this.list.trialPhoto = [];
            this.list.assmPhoto = [];
            this.list.assmSales = [];

        },
        //.保存组装试模信息
        saveAssmReptInfo(){
	    if(this.checkSave() == false) return false;
            var param = {};
            param.orderid = this.write.OrderNo;   //订单号
            param.mtid = this.write.AssmReptNo;          //组装号
            param.mtuser = this.write.EmpId;      //组装人
            param.mtgroup = this.write.DeptCd;       //组装部门
            param.mttalkdate = this.write.AssmReptDate;  //组装报告时间
            param.mtdate = this.write.AssmDate;           //组装时间
            param.mtsomething = this.write.AssmContents;   //组装事项
            param.orderother = this.write.Remark;     //备注
            param.testuser = this.write.TrialEmpId;        //试模人
            param.testgroup = this.write.TrialDeptCd;      //试模部门
            param.testdate = this.write.TrialDate;         //试模日
            param.testsomething = this.write.TrialContents;   //试模事项
            param.expclass = this.write.ExpClss;            //区分
            http.post('/WEI_2000/mt_save',param,function (res) {
                if(res.returnCode == 0){
                    mui.alert(this.lang.saveSuccess,title);
                    this.getAssmRept(this.write.OrderNo);
                }else{
                    mui.alert(this.lang.saveErr,title);
                }
            }.bind(this));
        },
	checkSave:function(){
            if(this.write.OrderNo == ''){
                mui.alert('请先选择订单',title);
                return false;
            }
            return true;
        },
        checkConfirm:function(){
           if(this.write.CfmYn == 1){
               mui.alert(this.lang.unConfirm,title);
               return false;
           }
           return true;
        },
        backMenu:function () {
            location.href = '/Menu/Menu/menuLists?formKey=' + jq("#form_key").val() + '&menuSelection=' + jq("#menu_selection").val();
        }
    }
});
// if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
//     FastClick.prototype.focus = function(targetElement) {
//         targetElement.focus();
//     };
//     FastClick.attach(document.body);
// }
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
        if(popOrderModal.view.showPop == true){
            popOrderModal.model.popOrderNo = orderId;
            popOrderModal.getData();
        }else{
            popAssmReptModal.model.popOrderNo = orderId;
            popAssmReptModal.getData();
            // popEmpyModal.hide();
            // leon.clearAssmReptInfo();
            // leon.showAssmReptAdd();
            // leon.getAssmRept(orderId);
        }
    }
}

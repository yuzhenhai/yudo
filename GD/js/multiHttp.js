
var Http = {
    sync:true,
    token:'4931O3JJFMMAX92913O4J45LKJNSIX-RES',
    sign:function(param){
        // param.yudoTimer = ((new Date().getTime()*2)+'').substr(5,8);
        // param.yudoRanStr = 'SI1I20FTNM102394K2LK534KASD91012-'+param.yudoTimer;
        // var body = hex_md5((JSON.stringify(param)).replace('"',''));
        // param.sign = hex_md5(body+param.yudoTimer+this.token+param.yudoRanStr);
    },
    get:function (url,parm,func,errorFunc,completeFunc) {
        this.sign(parm);
        jq.ajax({
            type: "get",
            url: url,
            data: parm,
            dataType: "json",
            async:true,
            success: function (msg) {
                if(typeof func == 'function'){
                    func(msg);
                }else{
                    mui.hideLoading();
                }
            },
            error:function (msg) {
                if(!errorFunc || typeof errorFunc == 'undefined' || errorFunc == undefined){
                    Http.ajaxGetError(msg);
                }else {
                    errorFunc(msg);
                }
            },
            complete:function (msg) {
                if(!completeFunc || typeof completeFunc == 'undefined' || completeFunc == undefined){
                    Http.ajaxGetComplete(msg);
                }else {
                    completeFunc(msg);
                }
            }
        });
    },
    getSync:function(url,parm,func,errorFunc,completeFunc){
        this.sign(parm);
        jq.ajax({
            type: "get",
            url: url,
            data: parm,
            dataType: "json",
            async:http.sync,
            success: function (msg) {
                if(typeof func == 'function'){
                    func(msg);
                }
            },
            error:function (msg) {
                if(!errorFunc || typeof errorFunc == 'undefined' || errorFunc == undefined){
                    Http.ajaxGetSyncError(msg);
                }else {
                    errorFunc(msg);
                }
            },
            complete:function (msg) {
                if(!completeFunc || typeof completeFunc == 'undefined' || completeFunc == undefined){
                    Http.ajaxGetSyncComplete(msg);
                }else {
                    completeFunc(msg);
                }
            }
        });
    },
    post:function (url,parm,func,errorFunc,completeFunc) {
        this.sign(parm);
        jq.ajax({
            type: "post",
            url: url,
            data: parm,
            dataType: "json",
            async:http.sync,
            success: function (msg) {
                func(msg);
            },
            error:function (msg) {
                if(!errorFunc || typeof errorFunc == 'undefined' || errorFunc == undefined){
                    Http.ajaxPostError(msg);
                }else {
                    errorFunc(msg);
                }
            },
            complete:function (msg) {
                if(!completeFunc || typeof completeFunc == 'undefined' || completeFunc == undefined){
                    Http.ajaxPostComplete(msg);
                }else {
                    completeFunc(msg);
                }
            }
        });
    },
    ajaxPostComplete:function(){
        mui.hideLoading();
    },
    ajaxPostError:function () {
        mui.hideLoading();
        mui.alert('访问出错，请重试!','YUDO ERP');
    },
    ajaxGetComplete:function(){
        mui.hideLoading();
    },
    ajaxGetError:function () {
        mui.hideLoading();
        mui.alert('访问出错，请重试!','YUDO ERP');
    },
    ajaxGetSyncComplete:function(){

    },
    ajaxGetSyncError:function () {
        mui.alert('访问出错，请重试!','YUDO ERP');
    }
}
var http = Object.create(Http);
var timeout = '';
(function($, window) {
    $.isLoading = false;
    //显示加载框
    $.showLoading = function(message,type) {
        clearTimeout(timeout);
        $.isLoading = true;
        var type = 'div';
        if ($.os.plus && type !== 'div') {
            $.plusReady(function() {
                plus.nativeUI.showWaiting(message);
            });
        } else {
            var html = '';
            html += '<i class="mui-spinner mui-spinner-white"></i>';
            html += '<p class="text mui-loading-control">' + (message || "loading") + '</p>';

            //遮罩层
            var mask=document.getElementsByClassName("mui-show-loading-mask");
            if(mask.length==0){
                mask = document.createElement('div');
                mask.classList.add("mui-show-loading-mask");
                document.body.appendChild(mask);
                mask.addEventListener("touchmove", function(e){e.stopPropagation();e.preventDefault();});
            }else{
                mask[0].classList.remove("mui-show-loading-mask-hidden");
            }
            //加载框
            var toast=document.getElementsByClassName("mui-show-loading");
            if(toast.length==0){
                toast = document.createElement('div');
                toast.classList.add("mui-show-loading");
                toast.classList.add('loading-visible');
                document.body.appendChild(toast);
                toast.innerHTML = html;
                toast.addEventListener("touchmove", function(e){e.stopPropagation();e.preventDefault();});
            }else{
                toast[0].innerHTML = html;
                toast[0].classList.add("loading-visible");
            }
            timeout = setTimeout(function () {
                if($.isLoading == true){
                    mui.alert('connect timeout!','YUDO Mobile ERP');
                }
                $.hideLoading();
            }.bind(this),20000);
        }
    };

    //隐藏加载框
    $.hideLoading = function(callback) {
        $.isLoading = false;
        clearTimeout(timeout);
        if ($.os.plus) {
            $.plusReady(function() {
                plus.nativeUI.closeWaiting();
            });
        }
        var mask=document.getElementsByClassName("mui-show-loading-mask");
        var toast=document.getElementsByClassName("mui-show-loading");
        if(mask.length>0){
            mask[0].classList.add("mui-show-loading-mask-hidden");
        }
        if(toast.length>0){
            toast[0].classList.remove("loading-visible");
            callback && callback();
        }
    }
})(mui, window);

jq.fn.extend({
    animateCss: function(e, t) {
        var i = "webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend";
        return this.addClass("animated " + e).one(i, function() {
            jq(this).removeClass("animated " + e),
            "function" == typeof t && t()
        }),
            this
    }
});
var multi = {
    data:{
        imgMaxLen:800,
        lang:''
    },
    backMenu:function(){
        // window.history.go(-1);
        location.href='/Menu/Menu/menuLists?formKey='+jq("#form_key").val()+'&menuSelection='+jq("#menu_selection").val();
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
    searchDate:function(type,func){
        var type = type;
        this.changeDate(type,function (e) {
            func(e);
            jq('.mui-dtpicker').remove();
        });
    },
    //选择时间
    changeDate:function(type,func){
        if(type == 'date'){
            var labels = ['Year', 'Mon', 'Day'];
        }else if(type == 'datetime'){
            var labels = ['Year', 'Mon', 'Day','Hour','min'];
        }
        var nowDate = this.getNowDate('array');
        var dtpicker = new mui.DtPicker({
            type: type,//设置日历初始视图模式
            beginDate: new Date(1989, '01', '01'),//设置开始日期
            endDate: new Date(nowDate[0],nowDate[1], nowDate[2]),//设置结束日期
            labels: labels,//设置默认标签区域提示语
        })
        dtpicker.show(function(e) {
            func(e);
        })
    },
    openSwitch(dom){
        jq(".mui-switch-handle").attr("style","");
        jq('#'+dom).addClass('mui-active');
    },
    closeSwitch(dom){
        jq(".mui-switch-handle").attr("style","");
        jq('#'+dom).removeClass('mui-active');
    },
    setLocalStorage:function(key,value){
        var obj = JSON.stringify(value);
        localStorage.setItem(key,obj);
    },
    getLocalStorage:function(key){
        var res = localStorage.getItem(key);
        if(res == null || res == ''){
            return false;
        }
        var obj =JSON.parse(localStorage.getItem(key));
        return obj;
    },
    delLocalStorage:function(key){
        localStorage.removeItem(key);
    },
    clearLocalStorage:function(){
        localStorage.clear();
    },
    //向左移出，父view
    removeDefaultById:function (domId,func) {
        jq('#'+domId).animateCss("fadeOutLeft", function(){
            jq('#'+domId).removeClass('fadeInLeft');
            func();
        });
    },
    //向右移出，子view
    removeTransById:function (domId,func) {
        jq('#'+domId).animateCss("fadeOutRight", function(){
            jq('#'+domId).removeClass('fadeInRight');
            func();
        });
    },
    //向右出现，父view
    recoverDefaultById:function (domId,func) {
        jq("#"+domId).removeClass('fadeOutLeft');
        jq("#"+domId).animateCss("fadeInLeft");
        func();
    },
    //向左出现，子view
    recoverTransById:function (domId,func) {
        jq("#"+domId).removeClass('fadeOutRight');
        jq("#"+domId).animateCss("fadeInRight");
        func();
    },

    removeDefaultByClass:function (classNm,func) {
        jq("."+classNm).animateCss("fadeOutLeft", function(){
            jq("."+classNm).removeClass('fadeInLeft');
            func();
        });
    },
    removeTransByCss:function (classNm,func) {
        jq("."+classNm).animateCss("fadeOutRight", function(){
            jq("."+classNm).removeClass('fadeInRight');
            func();
        });
    },
    recoverDefaultByCss:function (classNm,func) {
        jq("."+classNm).removeClass('fadeOutLeft');
        jq("."+classNm).animateCss("fadeInLeft");
        func();
    },
    recoverTransByCss:function (classNm,func) {
        jq("."+classNm).removeClass('fadeOutRight');
        jq("."+classNm).animateCss("fadeInRight");
        func();
    },
    clearLang:function(){
        multi.setLocalStorage('LANG_CHN','');
        multi.setLocalStorage('LANG_KOR','');
        multi.setLocalStorage('LANG_ENG','');
    },
    buildLang:function (langCode,func) {

        jq.getJSON('/language/LANG_'+langCode+'.json?beta='+parseInt(Math.random()*(9999-1000+1)+1000,10), function(data){
            multi.setLocalStorage('LANG_'+langCode,data);
            if(typeof func == 'function'){
                func();
            }
        });

    },
    getLangByCache:function (keys) {
        var langCode = multi.getLocalStorage('langCode');
        if(!langCode){
            langCode = 'CHN';
        }
        var words = multi.getLocalStorage('LANG_'+langCode);
        var result = [];
        for(var i in keys){
            if(!words.hasOwnProperty(keys[i])){
                result[keys[i]] = {
                    'WordID':keys[i],
                    'LabelCaption':''
                };
            }
            result[keys[i]] = {
                'WordID':keys[i],
                'LabelCaption':words[keys[i]]
            };
        }
        console.log(result);
        return result;
    },
    //.压缩image
    compressImg:function(inputfile,outImageList){
        var imgDom = document.createElement("img");
        var reader = new FileReader();
        var file = inputfile;
        EXIF.getData(file, function() {
            EXIF.getAllTags(this);
            Orientation = EXIF.getTag(this, 'Orientation');
        });
        reader.onload = function () {
            imgDom.src = reader.result;
        }
        if (file) {
            imgDom.onload = function () {
                //生成比例
                var width = imgDom.width;
                var height = imgDom.height;
                // //计算缩放比例
                var rate = 1;
                if (width >= height) {
                    if (width > multi.data.imgMaxLen) {
                        rate =  multi.data.imgMaxLen / width;
                    }
                } else {
                    if (height >  multi.data.imgMaxLen) {
                        rate =  multi.data.imgMaxLen / height;
                    }
                };
                //生成canvas
                var canvas = document.createElement("canvas");
                var ctx = canvas.getContext("2d");

                canvas.width = width*rate;
                canvas.height = height*rate;
                ctx.drawImage(imgDom, 0, 0, width*rate, height*rate);
                //修复ios
                if (navigator.userAgent.match(/iphone/i)) {
                    if (Orientation != "" && Orientation != 1) {
                        switch (Orientation) {
                            case 6://需要顺时针（向左）90度旋转
                                multi.rotateImg(imgDom, 'left', canvas,rate);
                                break;
                            case 8://需要逆时针（向右）90度旋转
                                multi.rotateImg(imgDom, 'right', canvas,rate);
                                break;
                            case 3://需要180度旋转
                                multi.rotateImg(imgDom, 'right', canvas,rate);//转两次
                                multi.rotateImg(imgDom, 'right', canvas,rate);
                                break;
                        }
                    }
                }
                var base64 = canvas.toDataURL('image/jpeg',0.5);
                outImageList.push(base64);
            };
            reader.readAsDataURL(file);
        } else {
            imgDom.src = "";
        }
    },
    //.旋转image
    rotateImg:function(img, direction,canvas,rate){
        //alert(img);
        //最小与最大旋转方向，图片旋转4次后回到原方向
        var min_step = 0;
        var max_step = 3;
        //var img = document.getElementById(pid);
        if (img == null)return;
        //img的高度和宽度不能在img元素隐藏后获取，否则会出错
        var height = img.height*rate;
        var width = img.width*rate;
        //var step = img.getAttribute('step');
        var step = 2;
        if (step == null) {
            step = min_step;
        }
        if (direction == 'right') {
            step++;
            //旋转到原位置，即超过最大值
            step > max_step && (step = min_step);
        } else {
            step--;
            step < min_step && (step = max_step);
        }
        //旋转角度以弧度值为参数
        var degree = step * 90 * Math.PI / 180;
        var ctx = canvas.getContext('2d');
        switch (step) {
            case 0:
                canvas.width = width;
                canvas.height = height;
                // ctx.scale(ratio,ratio);
                ctx.drawImage(img, 0, 0,width,height);
                break;
            case 1:
                canvas.width = height;
                canvas.height = width;
                ctx.rotate(degree);
                ctx.drawImage(img, 0, -height,width,height);
                break;
            case 2:
                canvas.width = width;
                canvas.height = height;
                ctx.rotate(degree);
                ctx.drawImage(img, -width, -height,width,height);
                break;
            case 3:
                canvas.width = height;
                canvas.height = width;
                ctx.rotate(degree);
                ctx.drawImage(img, -width, 0,width,height);
                break;
        }
    },
    getLang:function(vue,method,callback){
        langCode.method = 'cache';
        langCode.getWord({
            //.--模块名
            headerTitle:'W2018102915303680086',//生产交期管理

            //.--全局
            menuBack:'W2018071009230638074',//返回主菜单
            screen:'W2019041817352089305',//筛选
            roback:'W2019050918161296005',//重置
            date:'W2018082712533876756',//时间
            noData:'W2018062810475725084',//没有数据了
            pullMore:'W2019061017355893394',//点击加载更多...
            confirm:'W2018071009351100377',//确定
            search:'W2018082711232500387',//查询
            custNm:'W2018041913134073778',//客户名称
            empNm:'W2018041913373764065',//职员姓名
            deptNm:'W2018041913371894064',//部门名称
            save:'W2018071009410262081',//保存
            upload:'W2018071013053669009',//上传
            delete:'W2018041913303143356',//删除
            add:'W2018071013045597784',//添加
            saveSuccess:'W2018050317440350711',//保存成功
            saveErr:'W2018050317441072027',//保存失败
            unConfirm:'W2019060615241626313',//请先取消确定
            noInfo:'W2018070510020761032',//没有查询到信息
            status:'W2018082315443716702',//状态
            RMB:'G2018102617231931047',
            EUR:'G2018102617232982015',
            KOR:'W2018102617390024388',
            HKD:'W2018102617393022013',
            JPY:'W2018102617394451365',
            TWD:'W2018102617395906027',
            USD:'W2018102617402068363',

            // yuan:'',
            custInfo:'W2012082916402295775',//客户信息
            choosePhoto:'W2018050318054041351',//选择照片
            mustChooseFivePhotos  :'W2018070615112366786', //最多选择5张图片

            //.--订单
            orderNo:'W2018041913141737708', //订单号码
            delvDate:'W2018062810315076351',//交货日期
            gateCnt:'W2018062810404378386', //gate数量

            //.--组装试模
            salesInfo:'W2019060415380012337',//销售信息
            addAssmRept:'W2018061209080660794',//新增组装试模报告
            queryAssmRept:'W2018061209082525327',//查询组装试模报告
            assmRept:'W2018041913411029304',//组装试模
            assmReptNo:'W2018041913204897008',//组装报告号码
            assmReptDate:'W2018041913212982391',//组装报告日期
            assmDate:'W2018041913215236707',//组装日
            assmContents:'W2018041913222052708',//组装报告事项
            remark:'W2018041913225420017',//备注
            trialEmpNm:'W2018041913272754002',//试模人员
            trialDeptNm:'W2018041913274956066',//试模部门
            trialDate:'W2018041913280506717',//试模时间
            trialContents:'W2018050411240256703',//试模报告事项
            assmTrialPhoto:'W2019060415382897078',//组装/试模照片
            assmTrial:'W2018041913411029304',//组装试模
            salesPron:'W2018041913292308342',//销售负责人
            mustSaveAssm:'W2018050317410722361',//请先保存组装试模报告
            assmReptPhoto:'W2018041913400053087',//组装报告照片
            trialPhoto:'W2018041913403432396',//试模报告照片

            //.--报价单
            quote:'W2019062113441223785',//报价单
            quoteType:'W2019071117214439323',//报价区分
            quoteSearch:'W2019061918254007753',//报价单查询
            quoteAdd:'W2019062113395475701',//报价单录入
            quoteNo:'W2019061918260227717',//报价单号
            quoteAmt:'W2019061918261777027',//报价金额
            quoteDate:'W2019061918263243797',//报价日期
            validDateM:'W2019061918273585388',//有效日期
            delvDateChoose:'W2019061918275816798',//交货日期选择
            delvMethodM:'W2019061918281675768',//交货方法
            countryM:'W2019061918283335733',//国家
            custInfo:'W2019061918284870392',//客户信息
            customerNmM:'W2019061918291054079',//注塑厂名称
            agentNmM:'W2019061918293077332',//一级供应商
            shipToNmM:'W2019061918295009038',//交货处
            MakerNmM:'W2019061918300826762',//最终客户
            custPron:'W2018062810322809055',//客户负责人
            custTel:'W2019062017112073352',//客户电话tel
            custEmail:'W2018081513200299739',//负责人email
            custFaxM:'W2019061918304119012',//客户传真
            custRemarkM:'W2019062017140317035',//客户要求
            goodClassM:'W2019061918333389333',//产品分类
            goodNmM:'W2019061918353746011',//产品名称
            goodSpecM:'W2019061918355629086',//制成品规格
            srvAreaM:'W2019061918361221758',//保养区域
            currRateM:'W2019061918371370738',//汇率
            ProposeAmtM:'W2019061918374781092',//优惠金额
            quotVatM:'W2019061918543450302',//报价单税金
            paymentM:'W2019061918545736318',//付款方式
            disCountRateM:'W2019061918574200762',//折扣率
            other:'W2019061918583035092',//其他
            printClassM:'W2019061919062104086',//打印区分
            saleVatRateM:'W2019061919063683084',//增值税率
            miOrderRemarkM:'W2019061919070604701',//未下单原因
            printAmtM:'W2019061919072371026',//打印金额
            vatYnM:'W2019061919074547783',//有无缴税
            OverseaYnM:'W2019061919080753326',//转移到海外
            ASYnM:'W2019061919082244038',//AS认可
            minuteInfo:'W2019061919083615304',//明细信息
            stdPriceM:'W2019062009180185016',//销售标准单价
            dCPriceM:'W2019062009182624312',//折扣单价
            dcAmtM:'W2019062009185796702',//折扣金额
            dcVatM:'W2019062009191164775',//折扣Vat
            currCd:'W2019062017232255382',//货币编码
            produceInfo:'W2019062113424753791',//产品信息
            mustChooseCurrCd:'W2019062009204192302',//请先选择货币编码
            addSuccess:'W2019062009211548783',//添加成功
            mustSaveQuote:'W2019062009220144047',//请先保存当前报价单
            mustWriteQuotDate:'W2019062009223332313',//请输入报价日期
            mustWritePron:'W2019062009225127741',//请输入负责人信息
            mustWriteCustNm:'W2019062009231512348',//请输入客户名称
            mustWriteCustomerNm:'W2019062009240265014',//请输入注塑厂名称
            mustWriteMakerNm:'W2019062009242982077',//请输入最终客户
            mustWriteGoodNm:'W2019062009244914713',//请输入产品名称
            mustWriteRefNo:'W2019062009250630343',//请输入模号
            mustWritePayment:'W2019062009252215706',//请输入付款方式
            mustWriteVat:'W2019062009254899762',//请输入增值税率
            mustWriteItem:'W2019062009260499034',//请先添加品目
            yuan:'W2019062017311741368',//元
            itemStdPriceMerror:'W2019062113015155335',//品目销售标准单价获取失败




            //.--生产
            productDateM:'W2019051009285700378',//生产交期管理
            productQuery:'W2019050615415277384',//生产查询
            accordingClass:'W2019050916271053335',//依据区分
            accordingNo:'W2019050916272864089',//依据编号
            productInfo:'W2019050916281827337',//生产信息
            WPlanDateM:'W2019050916284420086',//生产接受日期
            changeCnt:'W2019050916285987387',//变更次数
            WDelvChRemarkM:'W2019050916300738082',//变更事由
            WDelvDateM:'W2019050916302241069',//生产交期
            sendDate:'W2018062810315076351',//交货日期
            deviseInfo:'W2019050916312566729',//设计信息
            OutDateM:'W2019050916320384028',//出图日期
            farmInfo:'W2019050916322786702',//车间信息
            WCDelvDateM:'W2019050916341365746',//指示
            WCStartDateM:'W2019050916342812086',//开始
            WCEndDateM:'W2019050916344115314',//完成
            QCDateM:'W2019050916345503011',//检查
            afterSaleServiceM:'W2019050916395628784',//售后服务
            order:'W2018110617341265338',//订单
            WCDelvDateM2:'W2019051315392177323', //指示确定日期
            RefNo:'W2018062810293127369',//模号
            orderDate:'W2018041913163666042',//订单日期
            asDelvDate:'W2018062810313521387',//AS接收日期
            pronM:'W2019051315430001369',//负责人
            defaultInfo:'W2019051315443623717',//基础信息
            drawNo:'W2019051315461309727',//图纸编号
            drawDelvDate:'W2019051315465675322',//图纸接收编号
            all:'W2019050917590233017',//全部

            //.--送货单GoodSpec
            asRate:'W2019052410563940306',//AS进度界面
            rateStpe:'W2019052410570383767',//进度跟踪
            invoiceInfo:'W2019052410575035051',//送货单信息
            invoiceNo:'W2019052410581713013',//送货单号
            invoiceDate:'W2019052410583836748',//送货单日期
            invoiceClass:'W2019052410585180719',//送货单区分
            colDate:'W2019052410590885795',//回签日期
            cfmDate:'W2019052410593477398',//确定日期


            noCurrCd:'W2018102914280936745',//本月无当前货币汇率记录，暂时无法保存

            AssemblyInformation:'W2018041913191891089',//组装信息
            Assembler:'W2018041913194489381',//组装人员
            AssemblyDepartmentName:'W2018041913201356776',//组装部门名称
            AssemblyReportNumber:'W2018041913204897008',//组装报告号码
            AssemblyReportDay:'W2018041913212982391',//组装报告日
            AssemblyDay:'W2018041913215236707',//组装日
            AssemblyReport:'W2018041913222052708',//组装报告事项
            Remarks:'W2018041913225420017',//备注
            AssemblyReportInformation:'W2018041913270419743',//组装报告信息
            TrialMoldPersonnel:'W2018041913272754002',//试模人员
            TestingDepartment:'W2018041913274956066',//试模部门
            TestDate:'W2018041913280506717',//试模日期
            SalesLeader:'W2018041913292308342',//销售负责人
            SetUp:'W2018041913295609366',//设置
            Delete:'W2018041913303143356',//删除
            OrderList:'W2018041913332473096',//订单列表
            EmployeeSearch:'W2018041913334637071',//员工搜索
            ExportDistinction:'W2018041913341497746',//出口区分
            ForTheDomesticMarket:'W2018041913351532345',//内销
            ForExport:'W2018041913355225052',//外销
            CustomerName:'W2018041913362840092',//客户名称
            DepartmentName:'W2018041913371894064',//部门名称
            StaffName:'W2018041913373764065',//职员姓名
            EmployeeNumber:'W2018041913385580778',//职员工号
            DepartmentNumber:'W2018041913392311092',//部门编号
            SalesInformation:'W2018041913394065792',//销售信息
            Assemblyreportphoto:'W2018041913400053087',//组装报告照片
            TestDieReportPhoto:'W2018041913403432396',//试模报告照片
            AssemblyMoldTest:'W2018041913411029304',//组装/试模
            alert1:'W2018050317410722361',//请先保存组装报告信息
            alert2:'W2018050317413004096',//删除成功
            alert3:'W2018050317414286702',//删除失败
            alert4:'W2018050317415417001',//销售信息导入失败，请稍后再试
            alert5:'W2018050317420436012',//销售信息导入成功
            alert6:'W2018050317421802088',//图片保存成功
            alert7:'W2018050317422725336',//图片保存失败，请稍后再试
            alert8:'W2018050317423587324',//图片上传失败，请稍后再试
            alert9:'W2018050317424506732',//确定要删除此照片么？
            alert10:'W2018050317425557008',//图片删除成功
            alert11:'W2018050317431147027',//图片删除失败，请稍后再试
            alert12:'W2018050317432047312',//请导入您的订单号
            alert13:'W2018050317433187783',//请填写组装报告信息
            alert14:'W2018050317435474373',//确定要保存么？
            alert15:'W2018050317440350711',//保存成功
            alert16:'W2018050317441072027',//保存失败，请稍后再试
            alert17:'W2018050317441830047',//没有扫描到信息
            alert18:'W2018050318050399363',//图片
            alert19:'W2018050318052869026',//拍摄照片
            alert20:'W2018050318054041351',//选择照片
            GATE:'W2018050318130693796',//Gate数量
            alert21:'W2018050410472916349',//确定要删除么？
            alert22:'W2018050410474726098',//一次最多可以导入5条记录
            alert23:'W2018050410475738795',//请先选择导入信息
            alert24:'W2018050410481052775',//当前选择与服务器中信息有重复
            alert25:'W2018050410482720777',//导入成功
            alert26:'W2018050410484630372',//导入失败
            info:'W2018050411092732363',//导入
            testthing:'W2018050411240256703',//试模报告事项
            addmtid:'W2018061209080660794',//新增组装试模报告
            querymtid:'W2018061209082525327',//查询组装试模信息
            ReturnMenu:'W2018061209091773749',//返回主菜单
            sudo:'W2018061209095227081',//无法查询此订单和组装试模信息，可能是您的权限不够
            QueryError:'W2018061209101367338',//查询时发生错误
            addAs:'W2018062810264620307',//新增AS接收信息
            queryAs:'W2018062810271817755',//查询AS接收信息
            orderClass:'W2018062810274700393',//订单区分
            specId:'W2018062810281624053',//技术规范编号
            querySpec:'W2018062810283349016',//编号查询
            exportClass:'W2018062810285065731',//出口区分
            queryCust:'W2018062810291518063',//客户搜索
            modelId:'W2018062810293127369',//模号
            dranoOld:'W2018062810300148794',//之前图纸号码
            asImformation:'W2018062810305261707',//AS接收信息
            asId:'W2018062810310464752',//AS接收编号
            asClass:'W2018062810311830074',//AS区分
            asGetDate:'W2018062810313521387',//AS接收日期
            asSetDate:'W2018062810315076351',//交货日期
            custPron:'W2018062810322809055',//客户负责人
            asCause:'W2018062810340442303',//发生起点
            asAllClass:'W2018062810353978387',//原因_区分
            asDutyCass:'W2018062810355432043',//AS责任区分
            asAppearance:'W2018062810361161368',//AS现象
            asReasonClass:'W2018062810362923732',//AS原因-种类
            asServiceClass:'W2018062810365984312',//服务地区区分
            asServiceArea:'W2018062810372363351',//服务地点
            isTrans:'W2018062810373797345',//是否移模
            transGroup:'W2018062810374972369',//移模部门
            apt:'W2018062810381595041',//有无接受
            charge:'W2018062810383100024',//收费是否区分
            itemReturn:'W2018062810384422313',//部品返回与否
            proDuct:'W2018062810385770331',//是否完成生产
            custProduceName:'W2018062810394954779',//客户产品名称
            resinM:'W2018062810400728768',//塑胶
            gateCounts:'W2018062810404378386',//Gate数量
            detailedDescription:'W2018062810411615366',//详细说明
            asStatusDescription:'W2018062810434922701',//AS现状说明
            causeAnalysis:'W2018062810441287373',//原因分析
            ImprovementProposals:'W2018062810445845052',//改善建议及方案
            inputInformation:'W2018062810453192374',//录入信息
            takphoto:'W2018062810461626308',//照片
            asReceivesTheLogin:'W2018062810470949745',//AS接收登录明细
            custId:'W2018062810473444353',//客户编号
            noData:'W2018062810475725084',//没有更多了
            domesticForeign:'W2018062810484850324',//国内/国外
            accept:'W2018062810494812027',//接受
            catalogueCode:'W2018062810504422036',//品目编码
            catalogueName:'W2018062810511435013',//品目名称
            productModel:'W2018062810513945737',//产品名称
            specifications:'W2018062810520860062',//规格
            inventoryUnit:'W2018062810523215799',//库存单位
            photoList:'W2018062810530023371',//图片列表
            number:'W2018062810534850327',//数量
            presentStock:'W2018062810551330316',//现库存
            carryQuantity:'W2018062810554066393',//进行数量
            Pausenumber:'W2018062810561010011',//暂停数量
            writeItem:'W2018070509524326082',//品目信息录入
            oldErp:'W2018070509533542731',//旧ERP
            newErp:'W2018070509535248086',//新ERP
            exportTrust:'W2018070509544706013',//内销
            exportUntrust:'W2018070509584977391',//外销
            isConfirm:'W2018070510002158367',//当前AS接受信息为确定状态，请先取消确定
            noHoldAs:'W2018070510011580043',//请先保存AS接受信息
            queryNoData:'W2018070510020761032',//没有查询到信息
            permissionIsNo:'W2018070510030146069',//没有查询到信息，可能是您的权限不足
            uploadSuccess:'W2018070510041152027',//提交成功
            recordIsExisted:'W2018070510050826032',//已经存在记录，不可重复提交
            recordIsDoing:'W2018070510060085021',//不可取消正在进行中的裁决
            recordIsNot:'W2018070510062611362',//当前AS还没有申请裁决
            cancelSuccess:'W2018070510065571347',//取消成功
            asUpdateSuccess:'W2018070510072716779',//当前AS信息更新成功
            apply:'W2018070510075477084',//申请
            handle:'W2018070510082072382',//处理
            accept_mobile:'W2018070510085487742',//接受
            chooseAsClass:'W2018070510093444357',//请先选择AS区分
            holdAsReady:'W2018070510103046025',//确定要保存AS接受信息么？
            chooseUserMsg:'W2018070510113652389',//请选择职员信息
            chooseItem:'W2018070510115523029',//请选择品目
            chooseNumber:'W2018070510121145349',//请填写数量
            chooseMust:'W2018070510141164391',//请先选择
            writeMust:'W2018070510142688735',//请先输入
            isAdjudication:'W2018070615024454069',//裁决中
            mustLessFivePhotos:'W2018070615112366786',//一次最多上传5张照片
            asbadtype_mobile:'W2018070615404644098',//不良类型
            menuBack:'W2018071009230638074',//主菜单
            subAdjudication:'W2018071009251284093',//提交裁决
            unSubAdjudication:'W2018071009254859784',//裁决上报取消
            ChargYn:'W2018071009324085701',//收费与否
            production:'W2018071009332016011',//完成生产
            confirm_mobile:'W2018071009351100377',//确定
            queryGroup:'W2018071009393573364',//部门搜索

            unit_mobile:'W2018071013040628794',//单位

            systemMsg:'W2018071013095279028',//系统信息
            ProductModels:'W2018071013443085307',//产品型号
            leaderTel:'W2018081513193495783',//负责人tel
            leaderEmail:'W2018081513200299739',//负责人email
            planrept:'W2018082315411788024',//工作计划/报告查询
            chooseDate:'W2018082315414307785',//选择日期
            queryplanrept:'W2018082315422856722',//查询工作计划/报告信息
            addPlan:'W2018082315424910717',//新增工作计划
            planNo:'W2018082315430910361',//活动计划编号
            addRept:'W2018082315432220012',//工作报告录入
            planDate:'W2018082315433821012',//活动计划日
            planGubun:'W2018082315450410028',//工作活动区分
            planGubunClass:'W2018082315452344083',//工作活动范畴
            planDestinationNm:'W2018082315454442072',//目的地名
            planActTitle:'W2018082315455904393',//工作活动标题
            planStartDate:'W2018082315462027014',//开始时间
            planEndDate:'W2018082315463638028',//结束时间
            planActContents:'W2018082315472045055',//活动内容
            planJobReportYn:'W2018082315473941312',//作报告与否
            planFinishYn:'W2018082315475957074',//完成与否
            jobGps:'W2018082315482303048',//工作现场
            reptNo:'W2018082315485070704',//工作报告编号
            reptDate:'W2018082315511665015',//工作报告日
            custStatus_mobile:'W2018082315515952088',//客户状态
            reptTitle:'W2018082315523040398',//工作标题
            reptStartDate:'W2018082315524538069',//会议开始时间
            reptEndDate:'W2018082315525953351',//会议结束时间
            reptMeetingPlace:'W2018082315531669002',//会议地点
            reptMeetingSubject:'W2018082315533209792',//会议主题
            reptAttendPerson:'W2018082315534995345',//参加人员
            reptCustRequstTxt:'W2018082315542328712',//客户要求事项
            reptSubjectDisTxt:'W2018082315550346731',//协商事项
            reptReqConductDate:'W2018082315551867068',//客户要求日期
            planIsComplete:'W2018082709425926342',//当前工作计划已经完成，不可修改
            reptIsComplete:'W2018082709445809037',//当前工作报告已经确定，不可修改
            plan:'W2018082709474656759',//工作计划
            rept:'W2018082709475740336',//工作报告
            pl:'W2018082709482681067',//计划
            re:'W2018082709484470726',//报告
            complete_mobile:'W2018082709490540089',//完成
            doing:'W2018082709491812056',//进行中
            trustuntrust:'W2018082709495603355',//国内/国外
            trust_mobile:'W2018082709501314304',//国内
            untrust_mobile:'W2018082709505924028',//国外
            mustSavePlan:'W2018082710220237308',//请先保存工作计划信息
            planIsConfirm:'W2018082710223010353',//当前工作计划已经完成，不可导入工作报告
            mustSavePhotoToGps:'W2018082710230139743',//请先上传现场照片,系统会自动获取您的定位信息
            mustSaveRept:'W2018082710232663095',//请先保存工作报告
            mustGps:'W2018082710293226054',//保存成功,录入工作报告前需要上传现场照片以获取GPS定位信息，请及时上传
            mustPlanGps:'W2018082710303656002',//信息保存失败，当前工作报告的活动计划未录入现场照片定位信息
            planHasRept:'W2018082710352818339',//当前活动计划已经录入工作报告信息
            saveOnlyOne:'W2018082710364017764',//只允许上传一张照片
            gpsLoadErr:'W2018082710371406056',//定位地址获取失败,请重新上传图片
            query_mobile:'W2018082711232500387',//查询
            planrept_mobile:'W2018082712523165009',//计划/报告
            no_mobile:'W2018082712530123037',//编号
            date_mobile:'W2018082712533876756',//时间
            userSearch:'W2018082713370902732',//职员查询
            custSearch:'W2018082713485166321',//客户查询
            custNo_mobile:'W2018082713504599324',//客户编号
            lastYear:'W2018122516062166764',//去年
            toYear:'W2018122516063785033',//今年
            invoiceNoCompelete:'W2018122516142135347',//已开送货单未收款
            dayData:'W2018122516284669743',//每日统计表
            salesData:'W2018122516292716001',//销售统计
            SUZHOU:'W2019010917151813357',//苏州
            GUANGDONG:'W2019010917154884789',//广东
            QINGDAO:'W2019010917160016794',//青岛
            changePassWd:'W2019022114573658056',//修改密码
            logout:'W2019022114575111051',//注销
            workPlanData:'W2019022114581611384',//工作计划统计
            userNm:'W2019022115044912045',//계정
            nowPassWd:'W2019022115215360091',//请输入当前密码
            newPassWd:'W2019022115220678394',//请输入新密码
            newPassWdAgain:'W2019022115222461077',//再次输入新密码
            salesStatus:'W2019030413295880091',//销售状况表
            AsAccept:'W2019030809162934375',//AS接受
            screen:'W2019041817352089305',//筛选
            productY:'W2019042412531575798',//生产完成
            noRelyn:'W2019042412535019323',//未依赖
            noReceive:'W2019042412553192026',//未接收
            receive:'W2019042412555230001',//接收
            productStatus:'W2019042413002394358',//生产状态
            monthSum:'W2019050510083163086',//月累计
            searchProductDate:'W2019050615415277384',//生产交期查询
            accordingClass:'W2019050916271053335',//依据区分
            accordingNo:'W2019050916272864089',//依据编号
            productInfo:'W2019050916281827337',//生产信息
            WPlanDateM:'W2019050916284420086',//生产接受日期
            changeCnt:'W2019050916285987387',//变更次数
            WDelvChRemarkM:'W2019050916300738082',//变更事由
            WDelvDateM:'W2019050916302241069',//生产交期
            deviseInfo:'W2019050916312566729',//设计信息
            OutDateM:'W2019050916320384028',//出图日期
            farmInfo:'W2019050916322786702',//车间信息
            WCDelvDateM:'W2019050916341365746',//指示
            WCStartDateM:'W2019050916342812086',//开始
            WCEndDateM:'W2019050916344115314',//完成
            QCDateM:'W2019050916345503011',//检查
            afterSaleServiceM:'W2019050916395628784',//售后服务
            allM:'W2019050917590233017',//全部
            roback:'W2019050918161296005',//重置
            productDateM:'W2019051009285700378',//生产交期管理
            WCDelvDateM2:'W2019051315392177323',//指示确定日期
            pronM:'W2019051315430001369',//负责人
            defaultInfo:'W2019051315443623717',//基础信息
            drawNoM:'W2019051315461309727',//图纸编号
            drawDelvDate:'W2019051315465675322',//图纸接收日期
            ASRate:'W2019052410563940306',//AS进度
            rateStep:'W2019052410570383767',//进度跟踪
            invoiceInfo:'W2019052410575035051',//送货单信息
            invoiceNoM:'W2019052410581713013',//送货单号
            invoiceDateM:'W2019052410583836748',//送货单日期
            invoiceClass:'W2019052410585180719',//送货单区分
            colDateM:'W2019052410590885795',//回签日期
            cfmDateM:'W2019052410593477398',//确定日期
            asNoapply:'W2019052411010107337',//AS单还未接收，没有进度信息
            deviseAccept:'W2019052411015543764',//设计接收
            deviseOutDraw:'W2019052411022048747',//设计出图
            workIndicate:'W2019052411024866034',//作业指示
            productEnd:'W2019052411031341383',//生产截止
            none:'W2019052411033561004',//无
            rateInfo:'W2019052415160666345',//详细进度
            salesInfo:'W2019060415380012337',//销售信息
            assmTrailPhoto:'W2019060415382897078',//组装/试模照片
            Unconfirm:'W2019060615241626313',//请先取消确定
            salesResultsTable:'W2019060616315233357',//销售业绩图表
            toDay:'W2019060616554525308',//今日
            noInvocie:'W2019060617323074379',//未出库
            noBill:'W2019060617324656035',//未开发票
            noReceipt:'W2019060617331390749',//未收款
            productNoInvoce:'W2019060617334991354',//生产未出库
            productNoAccept:'W2019060617341798316',//生产未接收
            productNoOutDraw:'W2019060617343010385',//设计未出图
            moneyM:'W2019060617371554742',//金额
            clickPullMore:'W2019061017355893394',//点击加载更多...
            productInvoiceAmt:'W2019061309463186003',//生产出库金额
            saleVatRateCheck:'W2019062616231507071',//增值税率不可大于100%
            mustDelItem:'W2019062616401142067',//请删除现有品目
            addWorldAmt:'W2019071118044909391',//添加国际服务器费用

            addAsProc:'W2019090917250476733',//AS处理录入
            asProcM:'W201909091826214267',//AS处理编号
            asProcDateM:'W2019091009524070357',//AS处理日期
            asRepairAmtM:'W2019091010211718586',//修理费
            asProcInfoM:'W2019091010211723148',//AS处理信息
            custOpinionM:'W2019091010211723254',//客户意见
            itemReturnGubunM:'W2019091010211724261',//部品返还区分
            asProcClassM:'W2019091010211724663',//AS处理分类
            leaveTimeM:'W2019091010211727403',//离开时间
            arrivalTimeM:'W2019091010211728072',//抵达时间
            asAmtM:'W2019091010211735880',//所需配件费用
            asProcResM:'W2019091010211737744',//AS处理结果
            asProcResultReasonM:'W2019091010211743890',//AS处理结果_原因
            procPersonM:'W2019091010211763431',//经办人
            asNoteM:'W2019091010211766689',//AS处理详情
            itemUseYnM:'W2019091010211768613',//再使用与否
            transLineM:'W2019091010211773662',//行驶里程
            asTypeM:'W2019091010211779962',//AS类型
            otherInfoM:'W2019091011062761145',//其他信息
            priceM:'W2019091012561278343',//单价
            mustASDate:'W2019091016360914249',//请输入AS处理日期
            mustASRecvNo:'W2019091016360951792',//请输入AS接收编号
            mustASKind:'W2019091016361020091',//请选择AS类型
            mustProcResult:'W2019091016361027657',//请输入AS处理结果
            mustItemReturnGubun:'W2019091016361027998',//请选择部品返还区分
            mustCustNm:'W2019091016361032071',//请输入客户名称
            mustEmpNm:'W2019091016361040416',//请输入负责人信息
            mustASAreaGubun:'W2019091016361086099',//请选择服务地区区分
            mustASProcKind:'W2019091016361087470',//请选择AS处理分类
            addAsProcM:'W2019091016430915632',//新增AS处理信息
            searchAsProcM:'W2019091016430976119',//查询AS处理信息
        },vue,callback);
    },
    getUnitList:function(func){
        http.get('/FireWork/getUnitList',{},function (res) {
            func(res.data[0]);
        }.bind(this));
    },
};

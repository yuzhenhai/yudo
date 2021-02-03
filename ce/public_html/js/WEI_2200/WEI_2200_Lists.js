var leon = new Vue({
    el:'#leon',
    delimiters: ['$((', '))'],
    data:{
        title:'YUDO ERP',
        planHeader:'工作计划录入',
        reptHeader:'工作报告录入',
        planConfirmLog:'当前工作计划已经完成，不可修改',
        reptConfirmLog:'当前工作报告已经确定，不可修改',
        loadingLog:'loading...',
        uploadLog:'正在上传...',
        menuBuild:true,
        downLoadScript:true,
        menu1:'',
        menu2:'',
        menuBack:'主界面',
        planPhotoNm:'',
        reptPhotoNm:'',
        dateListBuild:false,
        nowDate:'',
        planMinuteBuild:false,
        reptMinuteBuild:false,
        planPhotoBuild:false,
        reptPhotoBuild:false,
        dateQueryBuild:false,
        reptQueryBuild:false,
        userListBuild:false,
        custListBuild:false,
        isQuery:false,
        publicUserCnt:0,
        publicCustCnt:0,
        publicMsgCnt:0,
        isPlan:false,
        isRept:false,
        planWriteControl:false,
        reptWriteControl:false,
        gpsLat:'',
        gpsLng:'',
        viewPlanData:false,
        viewPlanNoData:true,
        startDate:'',
        endDate:'',
        lastView:'',
        complete:false,
        reptComplete:false,

        msgIsLoadding:false,
        msgNoData:false,
        userIsLoadding:false,
        userNoData:false,
        custNoData:false,
        custIsLoadding:false,

        css:{
            mustYn:{'th-red':true},
        },

        //查询表单
        userNmQuery:'',
        userIdQuery:'',
        groupQuery:'',
        custNmQuery:'',
        custIdQuery:'',

        calendarDate:'',
        msgStartDate:'',
        msgEndDate:'',
        msgClass:'',
        msgClssList:[
            {value:'plan',text:'工作计划'},
            {value:'rept',text:'工作报告'}
        ],
        langSave:'保存',
        langPlan:'工作计划',
        langRept:'工作报告',
        //工作计划
        langNoData:'没有数据',
        langSearch:'查询',//查询
        langMinute:'详细数据',//详细数据
        langPlanDate:'',//活动计划日
        langUserNm:'',
        langGroupNm:'',
        langCustNm:'',
        langCustPron:'',
        langPlanGubun:'',
        langPlanGubunClass:'',
        langPlanActTitle:'',//工作活动标题
        langPlanStartDate:'',
        langPlanEndDate:'',
        langCustNo:'',
        langGroupNo:'',
        langUserNo:'',
        langPlanNo:'',
        langReptNo:'',
        //工作报告
        langReptDate:'',//工作报告日
        langCustStatus:'',//客户状态
        langReptTitle:'',//工作标题
        langReptStartDate:'',//会议开始时间
        langReptEndDate:'',//会议结束时间
        langMeetingPlace:'',//工作地点
        langMeetingSubject:'',//会议主题
        langReptAttendPerson:'',//藏家人也
        langReptSubjectDisTxt:'',//协商事项
        langWriteMust:'',//请先输入
        langGpsLoadErr:'',
        langMustGps:'',
        langPlanStatus:'',
        langMustPlanGps:'',
        langSaveSuccess:'',
        langSaveErr:'',
        langFivePhoto:'',
        langMustSavePlan:'',
        langMustSaveRept:'',
        langMustSavephoto:'',
        langPhotoOnlyOne:'',
        langPlanHasRept:'',
        langPlanIsConfirm:'',
        langQueryPlanRept:'',
        langPl:'',
        langRe:'',
        langComplete:'',
        langDoing:'',
        status:'',
        trustAndUntrust:'',
        trust:'',
        untrust:'',
        number:'',
        custList:[],
        userList:[],
        dayList:[],
        planList:[],
        reptList:[],
        planPhotoList:[],
        reptPhotoList:[],
        fileList:[],

        //工作计划表单数据
        actGubun:'',
        actGubunId:'',
        actGubunClass:'',
        actGubunClassId:'',
        planNo:'',
        planDate:'',
        planUserNm:'',
        planUserId:'',
        planGroupNm:'',
        planGroupId:'',
        planStatus:'',
        planStatusId:'0',
        planLocationAddr:'',
        planDestinationNm:'',
        planActTitle:'',
        planActContents:'',
        planCustNm:'',
        planCustId:'',
        planStartDate:'',
        planEndDate:'',
        planJobReportYn:'N',
        planFinishYn:'N',

        //工作报告表单数据
        reptActGubun:'',
        reptActGubunId:'',
        reptActGubunClass:'',
        reptActGubunClassId:'',
        reptCustPattern:'',
        reptCustPatternId:'',
        reptNo:'',
        reptDate:'',
        reptPlanNo:'',
        reptUserNm:'',
        reptUserId:'',
        reptGroupNm:'',
        reptGroupId:'',
        reptTitle:'',
        reptMeetingPlace:'',
        reptMeetingSubject:'',
        reptAttendPerson:'',
        reptCustRequstTxt:'',
        reptSubjectDisTxt:'',
        reptReqConductDate:'',
        reptRemark:'',
        reptCustNm:'',
        reptCustId:'',
        reptStartDate:'',
        reptEndDate:'',
        reptConfirmData:0,
        planCountList:[],
        select_actGubun:[],
        select_actGubunClass:[],
        select_reptActGubunClass:[],
        select_reptCustPattern:[],
        select_year:[],
        select_month:[
            {value:'01',text:'01'},
            {value:'02',text:'02'},
            {value:'03',text:'03'},
            {value:'04',text:'04'},
            {value:'05',text:'05'},
            {value:'06',text:'06'},
            {value:'07',text:'07'},
            {value:'08',text:'08'},
            {value:'09',text:'09'},
            {value:'10',text:'10'},
            {value:'11',text:'11'},
            {value:'12',text:'12'},
        ]

    },
    //数据变更回调
    // updated:function(){
    //     mui.alert('1111','1111');
    // },
    //过滤器
    filters: {
        power:function (value) {
            if(value == 1 ||  value == 'Y'){
                value = '<i class="layui-icon layui-icon-radio layui_icon layui_green"></i>';
            }
            else
            {
                value = '<i class="layui-icon layui-icon-circle layui_icon"></i>';
            }
            return value;
        },
        dayChange:function (value,check) {
            var value = value;
            if(value != ''){
                if(check == 'plan'){
                    var color = '#ff7777';
                    value = leon.langPl+'：'+value;
                }else {
                    var color = '#95CE33';
                    value = leon.langRe+'：'+value;
                }
                var nr = '<div style="padding: 5px;color: white;width: 100%;height: 30px;text-align: center;background: '+color+'">'+ value +'</div>';
                return nr;
            }else {
                return '';
            }
        },
        statusChange:function(msg){
            switch (msg){
                case '0':
                    return '<span>'+leon.status+'：</span><span style="background: #1e83ff" class="layui-badge">'+leon.langPl+'</span>';
                    break;
                case '1':
                    return '<span>'+leon.status+'：</span><span style="background: #95ce33" class="layui-badge">'+leon.langComplete+'</span>';
                    break;
                case '2':
                    return '<span>'+leon.status+'：</span><span style="background: #ffc600" class="layui-badge">'+leon.langDoing+'</span>';
                    break;
            }
        },
        custStatus:function(status,statusId){
            switch (statusId){
                case 'MA30020010': //正常
                    var badge = '<span style="background: #95ce33" class="layui-badge">'+status+'</span>';
                    break;
                case 'MA30020020': //注意
                    var badge = '<span class="layui-badge layui-bg-green">'+status+'</span>';
                    break;
                case 'MA30020050': //恶性
                    var badge = '<span style="background: #d2d600" class="layui-badge">'+status+'</span>';
                    break;
                case 'MA30020030': //危险
                    var badge = '<span style="background: #FFB800" class="layui-badge">'+status+'</span>';
                    break;
                case 'MA30020040': //高危险
                    var badge = '<span style="background: #FF5722" class="layui-badge">'+status+'</span>';
                    break;
                case 'MA30020900': //删除
                    var badge = '<span style="back" class="layui-badge layui-bg-black">'+status+'</span>';
                    break;
            }
            return '<span>'+leon.status+'：'+badge+'</span>';
        },
        custKoOrFo:function (data) {
            if(data == '1'){
                return leon.trustAndUntrust+'：'+leon.trust;
            }else if(data == '4'){
                return leon.trustAndUntrust+'：'+leon.untrust;
            }
        }

    },
    // addPlanOpen()
    //页面加载完成后运行
    mounted(){
        var nowDate = new Date();
        var year = nowDate.getFullYear();
        var month = nowDate.getMonth() + 1 < 10 ? "0" + (nowDate.getMonth() + 1)
            : nowDate.getMonth() + 1;
        var day = nowDate.getDate() < 10 ? "0" + nowDate.getDate() : nowDate
            .getDate();
        var h= nowDate.getHours() < 10 ? '0' + nowDate.getHours() : nowDate.getHours();
        var m= nowDate.getMinutes() < 10 ? '0' + nowDate.getMinutes() : nowDate.getMinutes();
        var s= nowDate.getSeconds() < 10 ? '0' + nowDate.getSeconds() : nowDate.getSeconds();
        var nowYMD = year + "-" + month + "-" + day;
        var nowHMS = h + ':' + m + ':' + s;
        this.nowDate = nowYMD;
        this.nowDateMin = nowYMD + ' ' + nowHMS;

        this.startDate = nowYMD;
        this.endDate = nowYMD;
        this.planDate = nowYMD;
        this.planStartDate = nowYMD + ' ' + nowHMS;
        this.planEndDate = nowYMD+ ' '+ nowHMS;
        this.reptDate = nowYMD;
        this.reptStartDate = nowYMD+ ' '+ nowHMS;
        this.reptEndDate = nowYMD+ ' '+ nowHMS;
        this.reptReqConductDate = nowYMD;
        mui.showLoading();
        try {
            langCode.getWord({
                    langNoData:'W2018062810475725084',
                    langSearch:'W2018082711232500387',//查询
                    langMinute:'G2018102617012216352',//详细数据
                    langQueryPlanRept: 'W2018082315422856722', //查询工作计划/报告信息
                    langAddPlan:'W2018082315424910717', //新增活动计划
                    langAddRept:'W2018082315432220012', //新增工作报告
                    langMenuBack:'W2018071009230638074',   //主菜单
                    langSave:'W2018071009410262081',
                    langPlan:'W2018082709474656759',//工作计划
                    langRept:'W2018082709475740336',//工作报告
                    langPl:'W2018082709482681067',//计划
                    langRe:'W2018082709484470726',//报告
                    langComplete:'W2018082709490540089',//完成
                    langDoing:'W2018082709491812056',//进行中
                    langTrustAndUntrust:'W2018082709495603355',//国内/国外
                    langTrust:'W2018082709501314304',//国内
                    langUntrust:'W2018082709505924028',//国外
                    langPlanComplete:'W2018082709425926342',//当前工作计划已经完成，不可修改
                    langReptComplete:'W2018082709445809037',//当前工作报告已经确定，不可修改
                    langPlanIsConfirm:'W2018082710223010353',//当前工作计划已经完成
                    langMustSavephoto:'W2018082710230139743',//请先上传现场照片
                    langMustSaveRept:'W2018082710232663095',//请先保存工作报告
                    langMustSavePlan:'W2018082710220237308',
                    langSaveSuccess:'W2018050317440350711',
                    langSaveErr:'W2018050317441072027',
                    langMustGps:'W2018082710293226054',//保存成功，录入工作报告前需要录入GPS定位信息
                    langMustPlanGps:'W2018082710303656002',//保存失败，当前工作报告的活动计划编号未录入GPS定位信息
                    langPlanHasRept:'W2018082710352818339',//当前活动计划已经录入工作报告了
                    langPhotoOnlyOne:'W2018082710364017764',//只能上传一张照
                    langGpsLoadErr:'W2018082710371406056',//GPS信息获取失败
                    langStatus:'W2018082315443716702',
                    langFivePhoto:'W2018070615112366786',
                    langPhotoUp:'W2018071013053669009',
                    langSave:'W2018071009410262081',
                    //工作计划
                    langPlanNo:'W2018082315430910361',
                    langPlanDate:'W2018082315433821012',//活动计划日
                    langUserNm:'W2018041913373764065',
                    langUserNo:'W2018041913385580778',
                    langGroupNm:'W2018041913371894064',
                    langGroupNo:'W2018041913392311092',
                    langCustNm:'W2018041913362840092',
                    langCustNo:'W2018062810473444353',
                    langCustPron:'W2018062810322809055',
                    langPlanGubun:'W2018082315450410028',
                    langPlanGubunClass:'W2018082315452344083',
                    langPlanActTitle:'W2018082315455904393',//工作活动标题
                    langPlanStartDate:'W2018082315462027014',
                    langPlanEndDate:'W2018082315463638028',
                    //工作报告
                    langReptNo:'W2018082315485070704',
                    langReptDate:'W2018082315511665015',//工作报告日
                    langCustStatus:'W2018082315515952088',//客户状态
                    langReptTitle:'W2018082315523040398',//工作标题
                    langReptStartDate:'W2018082315524538069',//会议开始时间
                    langReptEndDate:'W2018082315525953351',//会议结束时间
                    langMeetingPlace:'W2018082315531669002',//工作地点
                    langMeetingSubject:'W2018082315533209792',//会议主题
                    langReptAttendPerson:'W2018082315534995345',//藏家人也
                    langReptSubjectDisTxt:'W2018082315550346731',//协商事项
                    langWriteMust:'W2018070510142688735',//请先输入
                }, this._updateLang
            );
        }catch (e) {
            mui.alert('多语言解析出错!',this.title);
        }

        this.systemBigClass('actGubun');
        var date=new Date;
        var year=date.getFullYear();
        var index = 1;
        this.select_year.push({value:year,text:year});
        while(true)
        {
            if(year-index <= 2001){
                break;
            }
            this.select_year.push({value:year-index,text:year-index});
            index++;
        }
    },
    //方法
    methods: {
        _updateLang:function(msg){
            mui.hideLoading();
            this.downLoadScript = false;
            this.calendarDate = multi.getNowDate().substr(0,7);
            this.langSave = msg.langSave;
            jq('#backMenu1').val(msg.langMenuBack)
            this.msgClssList=[
                {value:'plan',text:msg.langPlan},
                {value:'rept',text:msg.langRept}
            ];
            this.langNoData = msg.langNoData;
            this.langSearch=msg.langSearch;//查询
            this.langMinute=msg.langMinute;//详细数据
            this.langPlan = msg.langPlan;
            this.langRept = msg.langRept;
            this.menu1 = msg.langQueryPlanRept;
            this.menu2 = msg.langAddPlan;
            this.menuBack = msg.langMenuBack;
            this.planPhotoNm = msg.langPhotoUp;
            this.reptPhotoNm = msg.langPhotoUp;
            this.planHeader = msg.langAddPlan;
            this.reptHeader = msg.langAddRept;
            this.planConfirmLog = msg.langPlanComplete;
            this.reptConfirmLog = msg.langReptComplete;
            this.planStatus = msg.langPl;
            this.trustAndUntrust = msg.langTrustAndUntrust;
            this.trust = msg.langTrust;
            this.untrust = msg.langUntrust;
            this.status = msg.langStatus;
            this.langPl = msg.langPl;
            this.langRe = msg.langRe;
            this.langPlanStatus = msg.langPl;
            this.langComplete = msg.langComplete;
            this.langDoing = msg.langDoing;
            this.langGpsLoadErr = msg.langGpsLoadErr;
            this.langMustGps = msg.langMustGps;
            this.langMustPlanGps = msg.langMustPlanGps;
            this.langMustSavePlan = msg.langMustSavePlan;
            this.langMustSaveRept = msg.langMustSaveRept;
            this.langMustSavephoto = msg.langMustSavephoto;
            this.langPhotoOnlyOne = msg.langPhotoOnlyOne;
            this.langPlanHasRept = msg.langPlanHasRept;
            this.langPlanIsConfirm = msg.langPlanIsConfirm;
            this.langQueryPlanRept = msg.langQueryPlanRept;
            this.langSaveSuccess = msg.langSaveSuccess;
            this.langSaveErr     = msg.langSaveErr;
            this.langFivePhoto = msg.langFivePhoto;
            //工作计划
            this.langPlanDate = msg.langPlanDate;
            this.langUserNm = msg.langUserNm;
            this.langGroupNm = msg.langGroupNm;
            this.langCustNm = msg.langCustNm;
            this.langCustPron = msg.langCustPron;
            this.langPlanGubun = msg.langPlanGubun;
            this.langPlanGubunClass = msg.langPlanGubunClass;
            this.langPlanActTitle = msg.langPlanActTitle;
            this.langPlanStartDate = msg.langPlanStartDate;
            this.langPlanEndDate = msg.langPlanEndDate;
            this.langCustNo= msg.langCustNo;
            this.langGroupNo= msg.langGroupNo;
            this.langUserNo= msg.langUserNo;
            this.langPlanNo= msg.langPlanNo;

            //工作报告
            this.langReptNo=msg.langReptNo;
            this.langReptDate = msg.langReptDate;
            this.langCustStatus = msg.langCustStatus;
            this.langReptTitle = msg.langReptTitle;
            this.langReptStartDate = msg.langReptStartDate;
            this.langReptEndDate = msg.langReptEndDate;
            this.langMeetingPlace = msg.langMeetingPlace;
            this.langMeetingSubject = msg.langMeetingSubject;
            this.langReptAttendPerson = msg.langReptAttendPerson;
            this.langReptSubjectDisTxt = msg.langReptSubjectDisTxt;
            this.langWriteMust = msg.langWriteMust;
        },
        getDate:function(vue){
            multi.searchDate('date',function (e) {
                this[vue] = e.text;
            }.bind(this))
        },
        getCalendarDate:function(vue){
            multi.searchDate('date',function (e) {
                this[vue] = e.text.substr(0,7);
                this.QueryOpen();
            }.bind(this))
        },
        getDatetime:function(vue){
            multi.searchDate('datetime',function (e) {
                this[vue] = e.text+':00';
            }.bind(this))
        },
        _actGubun: function (actGubunId) {
            if(this.planFinishYn == 'Y'){
                mui.alert(this.planConfirmLog,this.title);
                return false;
            }
            if(actGubunId== 'OA10010100'){
                this.planJobReportYn = 'N';
                this.css.mustYn['th-red'] = false;
            }else {
                this.planJobReportYn = 'Y';
                this.css.mustYn['th-red'] = true;
            }
            this.systemMiniClass(actGubunId, 'actGubunClass');
            this.actGubunId = actGubunId;
            this.actGubunClass = '';
            this.actGubunClassId = '';
        },
        _actGubunClass: function (actGubunClassId) {
            if(this.planFinishYn == 'Y'){
                mui.alert(this.planConfirmLog,this.title);
                return false;
            }
        },
        //下拉列表大分类查询
        systemBigClass: function (check) {
            var params = new Object();
            params.bigsysid = check;
            this.ajaxGet('/WEI_2200/systemclass_big_prc', params,check);
        },
        //下拉列表小分类关联查询
        systemMiniClass: function (sysclass, check) {
            var params = new Object();
            params.bigsysid = sysclass;
            params.minisysid = check;
            this.ajaxGet('/WEI_2200/systemclass_mini_prc', params, check);
        },
        getNowDateMin:function(){
            var nowDate = new Date();
            var year = nowDate.getFullYear();
            var month = nowDate.getMonth() + 1 < 10 ? "0" + (nowDate.getMonth() + 1)
                : nowDate.getMonth() + 1;
            var day = nowDate.getDate() < 10 ? "0" + nowDate.getDate() : nowDate.getDate();
            var h= nowDate.getHours() < 10 ? '0' + nowDate.getHours() : nowDate.getHours();
            var m= nowDate.getMinutes() < 10 ? '0' + nowDate.getMinutes() : nowDate.getMinutes();
            var s= nowDate.getSeconds() < 10 ? '0' + nowDate.getSeconds() : nowDate.getSeconds();
            var nowYMD = year + "-" + month + "-" + day;
            var nowHMS = h + ':' + m + ':' + s;
            return nowYMD + ' ' + nowHMS;
        },
        menuOpen: function () {
            if(this.isQuery == true){
                this.setControlClose();
                this.dateQueryBuild = true;
                setTimeout(function () {
                    leon.dateListBuild = true;
                },300);
            }else {
                this.setControlClose();
                this.menuBuild = true;
            }
            this.isPlan = false;
            this.isRept = false;
            this.reptMinuteBuild = false;
            this.planMinuteBuild = false;
        },
        changeFinishYn:function(){
            if(this.planNo == ''){
                return false;
            }
            var params = {};
            params.planNo = this.planNo;
            params.planFinishYn = this.planFinishYn == 'Y' ? 'N':'Y';
            params.actGubunId = this.actGubunId;
            mui.showLoading();
            http.post('/WEI_2200/changePlanFinishYn',params,function (res) {
                if(res.returnCode == 'B002'){
                    mui.alert('工作活动区分为工作类型，无法设置是否完成');
                    return false;
                } else{
                    leon.planFinishYn = res.returnMsg;
                    if(res.returnMsg == 'Y'){
                        this.isPlanConfirm()
                    }else{
                        this.noPlanConfirm()
                    }
                }
            }.bind(this));
        },
        getPlanOrReptCount:function(){
            mui.showLoading('loading...','div');
            var params = {};
            params.startDate = this.startDate;
            params.endDate = this.endDate;
            http.get('/WEI_2200/getPlanOrReptCount',params,function (res) {
                if(res.returnCode == 0){
                    leon.viewPlanNoData = false;
                    leon.planCountList = res.data[0];
                }else if(res.returnCode == 'NULL'){
                    leon.viewPlanNoData = true;
                }
                mui.hideLoading();
                console.log(res);
            })
        },
        getCust:function(){
            this.custNoData = false;
            this.custIsLoadding = true;
            this.custList = [];
            this.publicCustCnt = 0;
            var params = new Object();
            params.custNm = this.custNmQuery;
            params.custId = this.custIdQuery;
            params.custCount = 0;
            this.ajaxGet('/WEI_2200/getCust',params,this.viewCustlist);
        },
        getPlanPhoto:function(){
            setTimeout(function () {
                mui.showLoading(leon.loadingLog,leon.title);
                var param = new Object();
                param.planNo = leon.planNo;
                leon.ajaxPost('/WEI_2200/getPlanPhoto',param,leon.viewPhotolist);
            },500);
        },
        getReptPhoto:function(){
            setTimeout(function (){
                mui.showLoading(leon.loadingLog,leon.title);
                var param = new Object();
                param.reptNo = leon.reptNo;
                leon.ajaxPost('/WEI_2200/getReptPhoto',param,leon.viewReptPhotolist);
            },500);
        },
        getCustMore:function(){
            var params = new Object();
            params.custNm = this.custNmQuery;
            params.custId = this.custIdQuery;
            params.custCount = this.publicCustCnt;
            this.ajaxGet('/WEI_2200/getCust',params,this.viewCustlist);
        },
        getUser:function(){
            this.userNoData = false;
            this.userIsLoadding = true;
            this.userList = [];
            this.publicUserCnt = 0;
            var params = new Object();
            params.username = this.userNmQuery;
            params.userid   = this.userIdQuery;
            params.groupname = this.groupQuery;
            params.count = 0;
            this.ajaxGet('/WEI_2200/getUser',params,this.viewUserlist);
        },
        getUserMore:function(){
            var params = new Object();
            params.username = this.userNmQuery;
            params.userid   = this.userIdQuery;
            params.groupname = this.groupQuery;
            params.count = this.publicUserCnt;
            this.ajaxGet('/WEI_2200/getUser',params,this.viewUserlist);
        },
        setCust:function(e){
            this.custListBuild = false;
            if(this.isPlan){
                this.planMinuteBuild = true;
                this.setControlOpen(this.planHeader);
                this.planCustNm = this.custList[e].CustNm;
                this.planCustId = this.custList[e].CustCd;
            }else {
                this.reptMinuteBuild = true;
                this.setControlOpen(this.reptHeader);
                this.reptCustNm = this.custList[e].CustNm;
                this.reptCustId = this.custList[e].CustCd;
            }
        },
        setUser:function(e){
            this.userListBuild = false;
            if(this.isPlan){
                this.planMinuteBuild = true;
                this.setControlOpen(this.planHeader);
                this.planUserNm = this.userList[e].EmpNm;
                this.planUserId = this.userList[e].EmpID;
                this.planGroupNm = this.userList[e].DeptNm;
                this.planGroupId = this.userList[e].DeptCd;
            }else {
                this.reptMinuteBuild = true;
                this.setControlOpen(this.reptHeader);
                this.reptUserNm = this.userList[e].EmpNm;
                this.reptUserId = this.userList[e].EmpID;
                this.reptGroupNm = this.userList[e].DeptNm;
                this.reptGroupId = this.userList[e].DeptCd;
            }
        },
        QueryOpen:function(){
            this.menuBuild = false;
            this.dateListBuild = true;
            mui.showLoading(this.loadingLog);
            this.dayList = [];
            var param = {}
            param.time = this.calendarDate;
            this.ajaxGet('/WEI_2200/msgList',param,this.viewMsgList);
        },
        QueryClose:function(){
            this.menuBuild = true;
            this.dateListBuild = false;
        },
        planInfoOpen:function(){
            this.menuBuild = false;
            this.viewPlanData = true;
        },
        planInfoClose:function(){
            this.menuBuild = true;
            this.viewPlanData = false;
        },
        planMinuteClose:function(){
            console.log(this.lastView);
            if(this.lastView == 'query' || this.lastView == 'plan'){
                this.setControlClose();
                this.dateQueryBuild = true;
                setTimeout(function () {
                    leon.dateListBuild = true;
                },300);
                this.planMinuteBuild = false;
            }else if(this.lastView == 'menu'){
                this.menuBuild = true;
                this.planMinuteBuild = false;
            }
        },
        reptMinuteClose:function(){
            if(this.lastView == 'query'){
                this.setControlClose();
                this.dateQueryBuild = true;
                setTimeout(function () {
                    leon.dateListBuild = true;
                },300);
                this.reptMinuteBuild = false;
            }else{
                this.reptMinuteBuild = false;
                this.planMinuteBuild = true;
            }
        },
        queryMsg:function(){
            mui.showLoading(this.loadingLog);
            this.publicMsgCnt = 0;
            this.msgNoData = false;
            this.msgIsLoadding = true;
            this.planList = [];
            this.reptList = [];
            var params = new Object();
            params.number = this.number;
            params.class  = this.msgClass;
            params.startDate = this.msgStartDate;
            params.endDate = this.msgEndDate;
            params.count = 0;
            if(this.msgClass == 'plan'){
                this.ajaxGet('/WEI_2200/queryAllMsg', params,this.viewPlanlist);
            }else {
                this.ajaxGet('/WEI_2200/queryAllMsg', params,this.viewReptlist);
            }
        },
        queryMsgMore:function(){
            var params = new Object();
            params.number = this.number;
            params.class  = this.msgClass;
            params.startDate = this.msgStartDate;
            params.endDate = this.msgEndDate;
            params.count = this.publicMsgCnt;
            if(this.msgClass == 'plan'){
                this.ajaxGet('/WEI_2200/queryAllMsg', params,this.viewPlanlist);
            }else {
                this.ajaxGet('/WEI_2200/queryAllMsg', params,this.viewReptlist);
            }
        },
        addPlanOpen:function (check) {
            //.通过菜单直接进入
            if(check == 'add'){
                this.lastView = 'menu';
            }
            this.clearPlanMinute();
            this.isPlan = true;
            this.isRept = false;
            this.isQuery = false;
            this.setControlOpen(this.planHeader);
            this.menuBuild = false;
            this.planMinuteBuild = true;
        },
        addReptOpen:function (check) {
            this.clearReptMinute();
            //如果是填写报告信息
            if(check == 'add'){
                if(this.planNo == ''){
                    mui.alert(this.langMustSavePlan,this.title);
                    return false;
                }else if(this.planFinishYn == 'Y'){
                    mui.alert(this.langPlanIsConfirm,this.title);
                    return false;
                }
                else if(this.planLocationAddr == '' && this.planJobReportYn == 'Y'){
                    mui.alert(this.langMustSavephoto,this.title);
                    return false;
                }
                this.queryReptMinute(this.planNo,'plan')
                this.planMinuteBuild = false;
                this.reptPlanNo = this.planNo;
                this.reptActGubun = this.actGubun;
                this.reptActGubunId = this.actGubunId;
                this.reptActGubunClass = this.actGubunClass;
                this.reptActGubunClassId = this.actGubunClassId;
                this.reptCustId =  this.planCustId;
                this.reptCustNm = this.planCustNm;
                this.reptTitle = this.planActTitle;
                this.reptStartDate = this.planStartDate;
                this.reptEndDate = this.planEndDate;
                this.systemMiniClass(this.actGubunId,'reptActGubunClass');
            }
            this.isPlan = false;
            this.isRept = true;
            this.isQuery = false;
            this.setControlOpen(this.reptHeader);
            this.menuBuild = false;
            this.reptMinuteBuild = true;
            this.systemBigClass('CustPattern');
        },
        queryCustOpen:function(check){
            if(check == 0){
                if(leon.planFinishYn == 'Y'){
                    mui.alert(leon.planConfirmLog,leon.title);
                    return false;
                }
                // this.planMinuteBuild = false;
            }else {
                if(this.reptConfirmData == 1){
                    mui.alert(this.reptConfirmLog,this.title);
                    return false;
                }
                // this.reptMinuteBuild = false;
            }
            this.custNoData = false;
            this.custIsLoadding = false;
            this.userList = [];
            this.custListBuild = true;
            // this.setControlClose();
        },
        queryCustClose:function(){
            this.custListBuild = false;
            if(this.isPlan == true){
                // this.planMinuteBuild = true;
                this.setControlOpen(this.planHeader);
            }else {
                // this.reptMinuteBuild = true;
                this.setControlOpen(this.reptHeader);
            }
        },
        queryUserOpen:function(check){
            if(check == 0){
                if(leon.planFinishYn == 'Y'){
                    mui.alert(leon.planConfirmLog,leon.title);
                    return false;
                }
                // this.planMinuteBuild = false;
            }else {
                if(this.reptConfirmData == 1){
                    mui.alert(this.reptConfirmLog,this.title);
                    return false;
                }
                // this.reptMinuteBuild = false;
            }
            this.userNoData = false;
            this.userIsLoadding = false;
            this.userList = [];
            this.userListBuild = true;
            // this.setControlClose();
        },
        queryUserClose:function(){
            this.userListBuild = false;
            if(this.isPlan == true){
                // this.planMinuteBuild = true;
                this.setControlOpen(this.planHeader);
            }else {
                // this.reptMinuteBuild = true;
                this.setControlOpen(this.reptHeader);
            }
        },
        queryPlanOpen:function(index){
            this.publicMsgCnt = 0;
            this.dateQueryBuild = true;
            this.msgNoData = false;
            this.msgIsLoadding = true;
            mui.showLoading(this.loadingLog);
            this.planList = [];
            this.reptList = [];
            this.msgClass = 'plan';
            var day = index;
            day >= 10 ? day = index.toString() : day = '0'+index.toString()
            var date = this.calendarDate+'-'+day;
            this.msgStartDate = this.msgEndDate = date;
            var params = {};
            params.date = date;
            this.ajaxGet('/WEI_2200/planList', params,this.viewPlanlist);
        },
        queryPlanClose:function(){
            this.dateQueryBuild = false;
        },
        queryReptOpen:function(index){
            this.publicMsgCnt = 0;
            this.dateQueryBuild = true;
            this.msgNoData = false;
            this.msgIsLoadding = true;
            mui.showLoading(this.loadingLog);
            this.planList = [];
            this.reptList = [];
            this.msgClass = 'rept';
            var day = index;
            day >=10 ? day = index.toString() : day = '0'+index.toString()
            var date = this.calendarDate+'-'+day;
            this.msgStartDate=this.msgEndDate = date;
            var params = new Object();
            params.date = date;
            this.ajaxGet('/WEI_2200/reptList', params,this.viewReptlist);
        },
        queryReptClose:function(){
            this.reptQueryBuild = false;
        },
        reptPhotoOpen:function(){
            if(this.reptNo == ''){
                mui.alert(this.langMustSaveRept,this.title);
                return false;
            }
            this.planPhotoList = [];
            this.setControlClose();
            this.reptPhotoBuild = true;
            this.reptMinuteBuild = false;
            this.getReptPhoto();
        },
        planPhotoOpen: function () {
            if(this.planNo == ''){
                mui.alert(this.langMustSavePlan,this.title);
                return false;
            }
            this.setControlClose();
            this.planPhotoList = [];
            this.planPhotoBuild = true;
            this.planMinuteBuild = false;
            this.getPlanPhoto();
        },
        reptPhotoClose:function(){
            this.setControlOpen(this.reptHeader);
            this.reptPhotoBuild = false;
            this.reptMinuteBuild = true;
        },
        planPhotoClose: function () {
            this.setControlOpen(this.planHeader);
            this.planPhotoBuild = false;
            this.planMinuteBuild = true;
        },
        setControlOpen: function (msg) {
            // var msg = arguments[0] ? arguments[0] : this.planHeader;
            jq('#slideNm').html(msg);
            jq('#slide_panel_top').show();
            jq('#slide_panel_bottom').show();
        },
        setControlClose: function () {
            jq('#slideNm').html();
            jq('#slide_panel_top').hide();
            jq('#slide_panel_bottom').hide();
        },
        //查询工作计划表单信息
        queryPlanMinute:function(ActPlanNo) {
            this.lastView = 'query';
            mui.showLoading(this.loadingLog);
            var params = new Object();
            params.actPlanNo = ActPlanNo;
            this.ajaxGet('/WEI_2200/planMinute',params,this.viewPlanMinute);
        },
        //查询工作报告表单信息
        queryReptMinute:function(ActReptNo,check){
            mui.showLoading(this.loadingLog);
            var params = new Object();
            params.actReptNo = ActReptNo;
            if(check == 'plan'){
                //.如果是通过录入工作报告方式进入
                this.lastView = 'plan';
                params.actPlanNo = ActReptNo;
            }else {
                //.如果是通过查询界面进入
                this.lastView = 'query';
            }
            this.ajaxGet('/WEI_2200/reptMinute',params,this.viewReptMinute);
        },
        clearPlanMinute:function(){
            this.css.mustYn['th-red'] = true;
            this.planWriteControl = false;
            this.actGubun = '';
            this.actGubunId = '';
            this.actGubunClass = '';
            this.select_actGubunClass = [];
            this.planLocationAddr = '';
            this.actGubunClassId = '';
            this.planNo = '';
            this.planDate = this.nowDate;
            this.planUserNm = '';
            this.planGroupNm = '';
            this.planUserId = '';
            this.planGroupId = '';
            this.planStatus =this.langPl;
            this.planStatusId ='0';
            this.planCustNm = '';
            this.planCustId = '';
            this.planStartDate = this.getNowDateMin();
            this.planEndDate =this.getNowDateMin();
            this.planJobReportYn = 'N';
            this.planFinishYn = 'N';
            this.planDestinationNm= '';
            this.planActTitle= '';
            this.planActContents= '';
            // this.systemBigClass('actGubun');
        },
        clearReptMinute:function(){
            this.reptWriteControl = false;
            this.reptActGubun = '';
            this.reptActGubunId = '';
            this.reptActGubunClass = '';
            this.reptActGubunClassId = '';
            this.reptCustPattern = '';
            this.reptCustPatternId = '';
            this.reptNo = '';
            this.reptDate = this.nowDate;
            this.reptPlanNo = '';
            this.reptUserNm = '';
            this.reptUserId = '';
            this.reptGroupNm = '';
            this.reptGroupId = '';
            this.reptTitle = '';
            this.reptMeetingPlace = '';
            this.reptMeetingSubject = '';
            this.reptAttendPerson = '';
            this.reptCustRequstTxt = '';
            this.reptSubjectDisTxt = '';
            this.reptReqConductDate = this.nowDate;
            this.reptRemark = '';
            this.reptCustNm = '';
            this.reptCustId = '';
            this.reptStartDate = this.getNowDateMin();
            this.reptEndDate = this.getNowDateMin();
            this.reptConfirmData = 0
            this.reptComplete = false;
        },
        viewPlanMinute:function(data,check){
            this.clearPlanMinute();
            if(check != 'refresh'){
                this.addPlanOpen();
                this.dateQueryBuild = false;
                this.dateListBuild = false;
                this.isQuery = true;
            }
            this.planNo = data.data.ActPlanNo;
            this.planDate = data.data.ActPlanDate.substr(0,10);
            this.planLocationAddr = data.data.LocationAddr;
            this.planUserNm = data.data.EmpNm;
            this.planGroupNm = data.data.DeptNm;
            this.planUserId = data.data.EmpID;
            this.planGroupId = data.data.DeptCd;
            this.planStatusId = data.data.Status;
            switch (this.planStatusId){
                case '0':
                    this.planStatus=this.langPl;
                    break;
                case '1':
                    this.planStatus=this.langComplete;
                    break;
                case '2':
                    this.planStatus=this.langDoing;
                    break;
            }
            this.planDestinationNm = data.data.DestinationNm;
            this.planActTitle = data.data.ActTitle;
            this.planActContents = data.data.ActContents;
            this.planCustNm = data.data.CustNm;
            this.planCustId = data.data.CustCd;
            this.planStartDate = data.data.ActSTDate;
            this.planEndDate = data.data.ActEDDate;
            this.actGubun= data.data.ActGubunNm;
            this.actGubunId= data.data.ActGubun;
            this.actGubunClass= data.data.RelationClassNm;
            this.actGubunClassId= data.data.RelationClass;
            this.planJobReportYn = data.data.JobReportYn;
            this.planFinishYn = data.data.FinishYn;
            if(this.actGubunId == 'OA10010100'){
                this.css.mustYn['th-red'] = false;
            }else{
                this.css.mustYn['th-red'] = true;
            }
            if(data.data.FinishYn == 'Y'){
                this.isPlanConfirm();
            }else {
                this.noPlanConfirm();
            }
            this.systemMiniClass(data.data.ActGubun,'actGubunClass');
        },
        viewReptMinute:function(data,check){
            if(data.returnCode == 'NULL'){
                return false;
            }
            this.clearReptMinute();
            if(check != 'refresh'){
                this.addReptOpen();
                this.dateQueryBuild = false;
                this.dateListBuild = false;
                this.isQuery = true;
            }
            this.reptActGubun =  data.data.ActGubunNm;
            this.reptActGubunId =  data.data.ActGubun;
            this.reptActGubunClass =  data.data.RelationClassNm;
            this.reptActGubunClassId =  data.data.RelationClass;
            this.reptCustPattern =  data.data.CustPatternNm;
            this.reptCustPatternId =  data.data.CustPattern;
            this.reptNo = data.data.ActReptNo;
            this.reptDate = data.data.ActReptDate.substr(0,10);
            this.reptPlanNo = data.data.ActPlanNo;
            this.reptUserNm = data.data.EmpNm;
            this.reptUserId = data.data.EmpID;
            this.reptGroupNm = data.data.DeptNm;
            this.reptGroupId = data.data.DeptCd;
            this.reptTitle = data.data.ReptTitle;
            this.reptMeetingPlace = data.data.MeetingPlace;
            this.reptMeetingSubject = data.data.MeetingSubject;
            this.reptAttendPerson = data.data.AttendPerson;
            this.reptCustRequstTxt = data.data.CustRequstTxt;
            this.reptSubjectDisTxt = data.data.SubjectDisTxt;
            this.reptReqConductDate = data.data.ReqConductDate.substr(0,10);
            this.reptRemark = data.data.Remark;
            this.reptCustNm = data.data.CustNm;
            this.reptCustId = data.data.CustCd;
            this.reptStartDate = data.data.MeetingSTDate;
            this.reptEndDate = data.data.MeetingEDDate;
            this.reptConfirmData = data.data.CfmYn;
            jq(".mui-switch-handle").attr("style","");
            if(data.data.CfmYn == 1){
                jq('#reptConfirm').addClass('mui-active');
                this.isReptConfirm();
            }else {
                jq('#reptConfirm').removeClass('mui-active');
                this.noReptConfirm();
            }
            this.systemMiniClass(data.data.ActGubun,'reptActGubunClass');
        },
        viewCustlist:function(data){
            if(data.returnCode == 'NULL'){
                this.custNoData = true;
                this.custIsLoadding = false;
            }else {
                if(data.data[0].length < 50){
                    this.custNoData = true;
                    this.custIsLoadding = false;
                }
                for(var i=0;i<data.data[0].length;i++){
                    this.custList.push(data.data[0][i]);
                }
            }
        },
        viewUserlist:function(data){
            if(data.returnCode == 'NULL'){
                this.userNoData = true;
                this.userIsLoadding = false;
            }else {
                if(data.data[0].length < 50){
                    this.userNoData = true;
                    this.userIsLoadding = false;
                }
                for(var i=0;i<data.data[0].length;i++){
                    this.userList.push(data.data[0][i]);
                }
            }
        },
        viewPlanlist:function(data){
            if(data.returnCode == 'NULL'){
                this.msgNoData = true;
                this.msgIsLoadding = false;
            }else {
                if(data.data[0].length < 50){
                    this.msgNoData = true;
                    this.msgIsLoadding = false;
                }
                for(var i=0;i<data.data[0].length;i++){
                    this.planList.push(data.data[0][i]);
                }
            }
        },
        viewReptlist:function(data){
            if(data.returnCode == 'NULL'){
                this.msgNoData = true;
                this.msgIsLoadding = false;
            }else {
                if(data.data[0].length < 50){
                    this.msgNoData = true;
                    this.msgIsLoadding = false;
                }
                for(var i=0;i<data.data[0].length;i++){
                    this.reptList.push(data.data[0][i]);
                }
            }

        },
        viewMsgList:function(data){
            var dayCnt = getDayCount(this.calendarDate.substr(0,4),parseInt(this.calendarDate.substr(5,2)));
            var firstDay = 1;
            while(true){
                if(firstDay > dayCnt){
                    break;
                }
                if(data.data.plan.length <= 0) {
                    var planCount = '';
                }else {
                    if(data.data.plan.hasOwnProperty(firstDay)){
                        var planCount = data.data.plan[firstDay];
                    }
                    else {
                        var planCount = '';
                    }
                }
                if(data.data.rept.length <= 0) {
                    var reptCount = '';
                }else {
                    if(data.data.rept.hasOwnProperty(firstDay)){
                        var reptCount = data.data.rept[firstDay];
                    }
                    else {
                        var reptCount = '';
                    }
                }
                this.dayList.push({plan:planCount,rept:reptCount})
                firstDay++;
            }
        },
        viewSavePlan:function(res){
            mui.hideLoading();
            if(res.returnCode == 'Y003'){
                this.refreshPlanMinute(res.data);
                mui.alert(this.langSaveSuccess,this.title);
            }else if(res.returnCode == 'S003'){
                this.refreshPlanMinute(res.data);
                mui.alert(this.langSaveSuccess,this.title);
            }else if(res.returnCode == 'H003'){
                this.refreshPlanMinute(res.data);
                if(this.planLocationAddr == ''){
                    mui.alert(this.langMustGps,this.title);
                }else {
                    mui.alert(this.langSaveSuccess,this.title);
                }
            }
            else {
                mui.alert(this.langSaveErr,this.title);
            }
        },
        viewSaveRept:function(res){
            mui.hideLoading();
            if(res.returnCode == 'Y003'){
                this.refreshReptMinute(res.data);
                mui.alert(this.langSaveSuccess,this.title);
            }else if(res.returnCode == 'noLocation'){
                mui.alert(this.langMustPlanGps,this.title);
            }
            else if(res.returnCode == 'S003') {
                this.refreshReptMinute(res.data);
                mui.alert(this.langSaveSuccess, this.title);
            }else if(res.returnCode == 'hasRept'){
                mui.alert(this.langPlanHasRept, this.title);
            }
            else {
                mui.alert(this.langSaveErr,this.title);
            }
        },
        viewPhotolist:function(res){
            // this.planPhotoList = [];
            if(res.returnCode == 0){
                this.planPhotoList = res.data;
            }else if(res.returnCode == 'empty'){
                this.planPhotoList = [];
            }
            mui.hideLoading();
        },
        viewReptPhotolist:function(res){
            // this.reptPhotoList = [];
            if(res.returnCode == 0){
                this.reptPhotoList = res.data;
            }
            mui.hideLoading();
        },
        viewReptConfirm:function(res){
            //操作失败
            if (res.returnCode.replace(' ', '') !== 'OK') {
                jq(".mui-switch-handle").attr("style", "");
                //当按下确定时
                if (res.returnClass == 'OM00000024') {
                    //还原为未确定状态
                    jq('#reptConfirm').removeClass('mui-active');
                }
                //当取消确定时
                else {
                    //还原为确定状态
                    jq('#reptConfirm').addClass('mui-active');
                }
            }
            else {
                if (res.returnClass.replace(' ', '') == 'OM00000023') {
                    leon.reptConfirmData = 1;
                    leon.isReptConfirm();
                }
                if (res.returnClass.replace(' ', '') == 'OM00000030') {
                    leon.reptConfirmData = 0;
                    leon.noReptConfirm();
                }
            }
            mui.alert(res.data, leon.title);
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
        //查询目标时间选择
        searchDate:function(btnNo){
            var type = 'date';
            this.changeDate(type,function (e) {
                if(btnNo == 0){
                    leon.startDate = e.text;
                }else{
                    leon.endDate = e.text;
                }
                jq('.mui-dtpicker').remove();
            });
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

        planMustCheck:function(){
            if(this.planDate == ''){
                mui.alert(this.langWriteMust+this.langPlanDate,this.title);
                return false;
            }
            if(this.planUserNm == ''){
                mui.alert(this.langWriteMust+this.langUserNm,this.title);
                return false;
            }
            if(this.actGubunId == ''){
                mui.alert(this.langWriteMust+this.langPlanGubun,this.title);
                return false;
            }
            if(this.actGubunClassId == ''){
                mui.alert(this.langWriteMust+this.langPlanGubunClass,this.title);
                return false;
            }
            if(this.planActTitle == ''){
                mui.alert(this.langWriteMust+this.langPlanActTitle,this.title);
                return false;
            }
            if(this.planStartDate == ''){
                mui.alert(this.langWriteMust+this.langPlanStartDate,this.title);
                return false;
            }
            if(this.planEndDate == ''){
                mui.alert(this.langWriteMust+this.langPlanEndDate,this.title);
                return false;
            }
        },
        reptMustCheck:function(){
            if(this.reptDate == ''){
                mui.alert(this.langWriteMust+this.langReptDate,this.title);
                return false;
            }
            if(this.reptUserNm == ''){
                mui.alert(this.langWriteMust+this.langUserNm,this.title);
                return false;
            }
            if(this.reptActGubunId == ''){
                mui.alert(this.langWriteMust+this.langPlanGubun,this.title);
                return false;
            }
            if(this.reptActGubunClassId == ''){
                mui.alert(this.langWriteMust+this.langPlanGubunClass,this.title);
                return false;
            }
            if(this.reptCustPatternId == ''){
                mui.alert(this.langWriteMust+this.langCustStatus,this.title);
                return false;
            }
            if(this.reptCustNm == ''){
                mui.alert(this.langWriteMust+this.langCustNm,this.title);
                return false;
            }
            if(this.reptTitle == ''){
                mui.alert(this.langWriteMust+this.langReptTitle,this.title);
                return false;
            }
            if(this.reptStartDate == ''){
                mui.alert(this.langWriteMust+this.langReptStartDate,this.title);
                return false;
            }
            if(this.reptEndDate == ''){
                mui.alert(this.langWriteMust+this.langReptEndDate,this.title);
                return false;
            }
            if(this.reptMeetingPlace == ''){
                mui.alert(this.langWriteMust+this.langMeetingPlace,this.title);
                return false;
            }
            if(this.reptMeetingSubject == ''){
                mui.alert(this.langWriteMust+this.langMeetingSubject,this.title);
                return false;
            }
            if(this.reptAttendPerson == ''){
                mui.alert(this.langWriteMust+this.langReptAttendPerson,this.title);
                return false;
            }
            if(this.reptSubjectDisTxt == ''){
                mui.alert(this.langWriteMust+this.langReptSubjectDisTxt,this.title);
                return false;
            }
        },
        isReptConfirm:function(){
            this.reptWriteControl = true;
        },
        noReptConfirm:function(){
            this.reptWriteControl = false;
        },
        isPlanConfirm:function(){
            this.planWriteControl = true;
        },
        noPlanConfirm:function(){
            this.planWriteControl = false;
        },
        // viewPlanConfirm:function(res){
        //     //操作失败
        //     if (res.returnCode.replace(' ', '') !== 'OK') {
        //         jq(".mui-switch-handle").attr("style", "");
        //         //当按下确定时
        //         if (res.returnClass == 'OM00000024') {
        //             //还原为未确定状态
        //             jq('#planConfirm').removeClass('mui-active');
        //         }
        //         //当取消确定时
        //         else {
        //             //还原为确定状态
        //             jq('#planConfirm').addClass('mui-active');
        //         }
        //     }
        //     else {
        //         if (res.returnClass.replace(' ', '') == 'OM00000023') {
        //             leon.planConfirm = 1;
        //             leon.isPlanConfirm();
        //         }
        //         if (res.returnClass.replace(' ', '') == 'OM00000030') {
        //             leon.planConfirm = 0;
        //             leon.noPlanConfirm();
        //         }
        //     }
        //     mui.alert(res.data, leon.title);
        // },

        saveController:function(){
            if(this.isPlan){
                this.savePlan();
            }else {
                this.saveRept();
            }
        },
        savePlan:function(){
            if(leon.planFinishYn == 'Y'){
                mui.alert(leon.planConfirmLog,leon.title);
                return false;
            }
            if(this.actGubunId == 'OA10010200' && this.planCustId == ''){
                mui.alert(leon.langWriteMust+this.langCustNm)
                return false;
            }
            if(this.planMustCheck() == false){
                return false;
            }
            mui.showLoading(this.loadingLog);
            var param = new Object();
            param.planNo = this.planNo;
            param.actGubunId = this.actGubunId;
            param.actGubunClassId = this.actGubunClassId;
            param.planDate = this.planDate;
            param.planUserId = this.planUserId;
            param.planGroupId = this.planGroupId;
            param.planStatusId = this.planStatusId;
            param.planDestinationNm = this.planDestinationNm;
            param.planActTitle = this.planActTitle;
            param.planActContents = this.planActContents;
            param.planCustId = this.planCustId;
            param.planStartDate = this.planStartDate;
            param.planEndDate = this.planEndDate;
            this.ajaxPost('/WEI_2200/savePlan', param,this.viewSavePlan);
        },
        saveRept:function(){
            if(this.reptConfirmData == 1){
                mui.alert(this.reptConfirmLog,this.title);
                return false;
            }
            if(this.reptMustCheck() == false){
                return false;
            }
            mui.showLoading(this.loadingLog);
            var param = new Object();
            param.ActGubunId = this.reptActGubunId;
            param.RelationClassId = this.reptActGubunClassId;
            param.CustPatternId = this.reptCustPatternId;
            param.ActReptNo = this.reptNo;
            param.ActReptDate = this.reptDate;
            param.ActPlanNo = this.reptPlanNo;
            param.EmpID = this.reptUserId;
            param.DeptCd = this.reptGroupId;
            param.ReptTitle = this.reptTitle;
            param.MeetingPlace = this.reptMeetingPlace;
            param.MeetingSubject = this.reptMeetingSubject;
            param.AttendPerson = this.reptAttendPerson;
            param.CustRequstTxt = this.reptCustRequstTxt;
            param.SubjectDisTxt = this.reptSubjectDisTxt;
            param.ReqConductDate = this.reptReqConductDate;
            param.Remark = this.reptRemark;
            param.CustCd = this.reptCustId;
            param.MeetingSTDate = this.reptStartDate;
            param.MeetingEDDate = this.reptEndDate;
            this.ajaxPost('/WEI_2200/saveRept', param,this.viewSaveRept);
        },

        delPlanPhoto: function () {
            mui.confirm('确定要删除么？',leon.title, ['YES','NO'], function(eq) {
                if (eq.index == 0) {
                    if(leon.planFinishYn == 'Y'){
                        mui.alert(leon.planConfirmLog,leon.title);
                        return false;
                    }
                    mui.showLoading(leon.loadingLog,leon.title);
                    var param = new Object();
                    param.planNo = leon.planNo;
                    leon.ajaxPost('/WEI_2200/delPlanPhoto', param,leon.getPlanPhoto);
                }else{
                    return false;
                }
            });
        },
        delReptPhoto: function (e) {
            mui.confirm('确定要删除么？',leon.title, ['YES','NO'], function(eq) {
                if (eq.index == 0) {
                    mui.showLoading(leon.loadingLog, leon.title);
                    var param = new Object();
                    param.reptNo = leon.reptNo;
                    param.reptFileNm = leon.reptPhotoList[e].FileNm;
                    param.reptFileSeq = leon.reptPhotoList[e].Seq;
                    leon.ajaxPost('/WEI_2200/delReptPhoto', param, leon.getReptPhoto);
                }else{
                    return false;
                }
            });
        },
        takPhoto:function() {
            if (this.planNo == '') {
                mui.alert(this.langMustSavePlan, 'YUDO ERP APP');
                return false;
            }
            // if(this.s_confirm == 1){
            //     mui.alert(leon.langCode.isConfirm,leon.global_title);
            //     return false;
            // }
            jq("#planPhoto").trigger("click");
            // if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
            //     jq("#planPhoto").trigger("click");
            // }
        },
        takReptPhoto:function(){
            if (this.reptNo == '') {
                mui.alert(this.langMustSaveRept, 'YUDO ERP APP');
                return false;
            }
            // if(this.s_confirm == 1){
            //     mui.alert(leon.langCode.isConfirm,leon.global_title);
            //     return false;
            // }
            jq("#reptPhoto").trigger("click");
            // if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
            //     jq("#reptPhoto").trigger("click");
            // }
        },
        uploadPlanPhoto:function(){
            if(leon.planFinishYn == 'Y'){
                mui.alert(leon.planConfirmLog,leon.title);
                return false;
            }
            mui.showLoading(this.uploadLog,this.title);
            var inputFile = document.getElementById('planPhoto').files;
            if(inputFile.length > 1){
                mui.alert(this.langPhotoOnlyOne,'YUDO ERP APP');
                mui.hideLoading();
                return false
            }

            var fileList = [];
            for(var i = 0; i < inputFile.length;i++){
                multi.compressImg(inputFile[i],fileList);
            }
            setTimeout(function () {
                var params = {};
                params.planNo = leon.planNo;
                params.imageList = fileList;
                if(leon.planPhotoList.length > 0){
                    var historyPhotoCnt = leon.planPhotoList[(leon.planPhotoList).length-1].Seq;
                }else{
                    var historyPhotoCnt = 0
                }
                http.post('/WEI_2200/uploadPlanPhoto',params,function (res) {
                    leon.planPhotoList = [];
                    if (res.returnCode == 0) {
                        leon.getPlanPhoto();
                        setTimeout(function () {
                            leon.uploadGps();
                        },1000);
                    }
                });
            },1000);
        },
        uploadReptPhoto:function(){
            if(this.reptConfirmData == 1){
                mui.alert(this.reptConfirmLog,this.title);
                return false;
            }
            mui.showLoading(this.uploadLog,this.title);
            var inputFile = document.getElementById('reptPhoto').files;
            if(inputFile.length > 5){
                mui.alert(this.langFivePhoto,'YUDO ERP APP');
                mui.hideLoading();
                return false;
            }
            var fileList = [];
            for(var i = 0; i < inputFile.length;i++){
                multi.compressImg(inputFile[i],fileList);
            }
            setTimeout(function () {
                var params = {};
                params.reptNo = leon.reptNo;
                params.imageList = fileList;
                if(leon.reptPhotoList.length > 0){
                    var historyPhotoCnt =leon.reptPhotoList[(leon.reptPhotoList).length-1].Seq;
                }else{
                    var historyPhotoCnt = 0
                }
                http.post('/WEI_2200/uploadReptPhoto',params,function (res) {
                    if (res.returnCode == 0) {
                        // for(var i in fileList){
                        //     var seq = Number(historyPhotoCnt)+Number(i)+1;
                        //     if(seq < 10){
                        //         seq = '0'+seq;
                        //     }
                        //     var img = {
                        //         FileNm: res.data[i],
                        //         imagedir: fileList[i],
                        //         Seq:seq
                        //     };
                        //     leon.reptPhotoList.push(img);
                        // }
                        leon.getReptPhoto();
                    }
                });
            },1000);
        },
        uploadGps:function(){
            getGps();
            mui.alert('后台正在获取定位信息，请稍后确认',leon.title)
            setTimeout(function () {
                var params = new Object();
                params.planNo = leon.planNo;
                params.lat = leon.gpsLat;
                params.lng = leon.gpsLng;
                leon.ajaxGet('/WEI_2200/getGps',params,function (res) {
                    leon.planLocationAddr = res.data;
                    if(res.returnCode == 0){
                        mui.alert('定位信息已经更新，请确认！',leon.title)
                        leon.planLocationAddr = res.data;
                    }else {
                        mui.alert(leon.langGpsLoadErr,leon.title);
                    }
                });
            },2000);
        },
        refreshPlanMinute:function(planNo){
            var params = new Object();
            params.actPlanNo = planNo;
            this.ajaxGet('/WEI_2200/planMinute', params,'planRefresh');
        },
        refreshReptMinute:function(reptNo){
            var params = new Object();
            params.actReptNo = reptNo;
            this.ajaxGet('/WEI_2200/reptMinute', params,'reptRefresh');
        },
        reptConfirm:function(sp){
            var params = new Object();
            params.cfm = sp;
            params.reptPlanNo = this.reptPlanNo;
            params.reptNo = this.reptNo;
            this.ajaxPost('/WEI_2200/reptConfirm',params,this.viewReptConfirm);
        },
        // planConfirm:function(sp){
        //     var params = new Object();
        //     params.cfm = sp;
        //     params.planNo = this.w_asid;
        //     this.ajaxPost('/WEI_2200/planConfirm',params,this.viewPlanConfirm);
        // },

        ajaxPost: function (url, params, callBack) {
            jq.ajax({
                url: url,
                data: params,
                type: 'post',
                dataType: 'json',
                success: function (res) {
                    if(typeof callBack == 'function'){
                        callBack(res);
                    }else {
                        switch (callBack){
                        }
                    }
                },
                error: function () {

                }
            });
        },
        ajaxGet: function (url, params, callBack) {
            jq.ajax({
                url: url,
                data: params,
                type: 'get',
                dataType: 'json',
                success: function (res) {
                    if(typeof callBack == 'function'){
                        callBack(res);
                    }else {
                        switch (callBack){
                            case 'planRefresh':
                                leon.viewPlanMinute(res,'refresh');
                                break;
                            case 'reptRefresh':
                                leon.viewReptMinute(res,'refresh');
                                break;
                            case 'actGubun':
                                leon.select_actGubun = res.data[0];
                                leon.select_actGubun.unshift({value:'',text:''});
                                break;
                            case 'actGubunClass':
                                leon.select_actGubunClass = res.data[0];
                                leon.select_actGubun.unshift({value:'',text:''});
                                break;
                            case 'reptActGubunClass':
                                leon.select_reptActGubunClass = res.data[0];
                                break;
                            case 'CustPattern':
                                leon.select_reptCustPattern = res.data[0];
                                break;
                        }
                    }
                },
                error: function () {
                    mui.hideLoading();
                },
                complete:function () {
                    mui.hideLoading();
                }
            });
        }
    }
});

function getDayCount(year,month) {
    console.log(month);
    var curMonthDays=new Date(year,month,0).getDate();
    return curMonthDays;
}
function getGps(){
    if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
        // location.href = 'jmobile://getLocation';
        try{
            webkit.messageHandlers.jmobile.postMessage({fn: "getLocation"});
        }catch (e) {}
    }
    else if(JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.Android)
    {
        if(window.JMobile) window.JMobile.getLocation();
    }
}
function setLocation(latitude,longitude){
    leon.gpsLat = latitude;
    leon.gpsLng = longitude;
    // mui.alert(longitude+','+latitude,'经纬度');
}
jq(function () {
    jq("#backMenu1").click(function() {
        location.href='/Menu/Menu/menuLists?formKey='+jq("#form_key").val()+'&menuSelection='+jq("#menu_selection").val();
    });
    jq("#backMenu2").click(function() {
        location.href='/Menu/Menu/menuLists?formKey='+jq("#form_key").val()+'&menuSelection='+jq("#menu_selection").val();
    });
    //layui
    layui.use('laydate', function () {
        var laydate = layui.laydate;
        //执行一个laydate实例
        laydate.render({
            elem: '#msgStartDate', //指定元素
            done: function (dates) {
                leon.msgStartDate = dates;

            }
        });
        laydate.render({
            elem: '#msgEndDate', //指定元素
            done: function (dates) {
                leon.msgEndDate = dates;
            }
        });
        laydate.render({
            elem: '#reptDate', //指定元素
            done: function (dates) {
                leon.reptDate = dates;
            }
        });
        laydate.render({
            elem: '#planDate', //指定元素
            done: function (dates) {
                if(leon.planFinishYn == 'Y'){
                    mui.alert(leon.planConfirmLog,leon.title);
                    leon.planDate = leon.planDate;
                }else {
                    leon.planDate = dates;
                }
            }
        });
        laydate.render({
            elem: '#planStartDate', //指定元素
            type:'datetime',
            done: function (dates) {
                if(leon.planFinishYn == 'Y'){
                    mui.alert(leon.planConfirmLog,leon.title);
                    leon.planStartDate = leon.planStartDate;
                }else {
                    leon.planStartDate = dates;
                }
            }
        });
        laydate.render({
            elem: '#planEndDate', //指定元素
            type:'datetime',
            done: function (dates) {
                if(leon.planFinishYn == 'Y'){
                    mui.alert(leon.planConfirmLog,leon.title);
                    leon.planStartDate = leon.planStartDate;
                }else {
                    leon.planEndDate = dates;
                }
            }
        });
        laydate.render({
            elem: '#reptStartDate', //指定元素
            type: 'datetime',
            done: function (dates) {

                leon.reptStartDate = dates;
            }
        });
        laydate.render({
            elem: '#reptEndDate', //指定元素
            type: 'datetime',
            done: function (dates) {
                leon.reptEndDate = dates;
            }
        });
        laydate.render({
            elem: '#reptReqConductDate', //指定元素
            done: function (dates) {
                leon.reptReqConductDate = dates;
            }
        });

    });
    jq('#mui_pushuser').scroll(function(){
        var bottom = document.getElementById('mui_pushuser').scrollHeight - document.getElementById('mui_pushuser').clientHeight - jq('#mui_pushuser').scrollTop();
        if(bottom == 0 && leon.userList.length > 0){
            leon.publicUserCnt += 50;
            leon.getUserMore();
        }
    });
    jq('#mui_pushcust').scroll(function(){
        var bottom = document.getElementById('mui_pushcust').scrollHeight - document.getElementById('mui_pushcust').clientHeight - jq('#mui_pushcust').scrollTop();
        if(bottom == 0 && leon.custList.length > 0){
            leon.publicCustCnt += 50;
            leon.getCustMore();
        }
    });
    jq('#mui_pushMsg').scroll(function(){
        var bottom = document.getElementById('mui_pushMsg').scrollHeight - document.getElementById('mui_pushMsg').clientHeight - jq('#mui_pushMsg').scrollTop();
        if(leon.msgClass == 'plan'){
            if(bottom == 0 && leon.planList.length > 0){
                leon.publicMsgCnt += 50;
                leon.queryMsgMore();
            }
        }else if(leon.msgClass == 'rept'){
            if(bottom == 0 && leon.reptList.length > 0){
                leon.publicMsgCnt += 50;
                leon.queryMsgMore();
            }
        }
    });
    mui.previewImage();
});
document.getElementById("reptConfirm").addEventListener("toggle",function(event){
    if(leon.reptNo == ''){
        mui.alert(this.langMustSaveRept,leon.title);
        jq(".mui-switch-handle").attr("style","");
        jq('#reptConfirm').removeClass('mui-active');
    }else {
        if(event.detail.isActive){
            leon.reptConfirm('CA');
        }else{
            leon.reptConfirm('CD');
        }
    }
});


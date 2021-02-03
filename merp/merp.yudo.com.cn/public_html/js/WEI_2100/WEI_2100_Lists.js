
var leon = new Vue({
    el:'#leon',
    delimiters: ['$((', '))'],
    data:{
        view:{
            showAddAsHandle:false,
            showQueryAsHandle:false,
            showAsHandleItem:false,
            asHandleScreen:false,
            noData:true,
            pullMore:false,
            asHandleCfm:false,
            count:0,
        },
        input:{
            asHandle:{
                custNm:'',
                asHandleNo:'',
                asHandleStartDate:'',
                asHandleEndDate:'',
                deptNm:'',
                deptId:'',
                empNm:'',
                empId:'',
            },
            asRecv:{

            }
        },
        write:{
            asHandle:{
                ASNo:'',
                ASDate:'',
                ASRecvNo:'',
                ASType:'',
                ASTypeNm:'',
                orderNo:'',
                ExpClsss:'',
                EmpId:'',
                EmpNm:'',
                DeptCd:'',
                DeptNm:'',
                SpecNo:'',
                CustCd:'',
                CustNm:'',
                DrawNo:'',
                DrawAmd:'',
                ASKind:'',//AS类型
                ASProcKind:'',//AS处理区分
                ProcResult:'',//AS处理结果
                ASAmt:'',//所需配件费用
                ASRepairAmt:'',//修理费
                ASAreaGubun:'',//服务地区区分
                ASArea:'',//服务地点
                ItemReturnYn:'N',//部品反回与否
                ItemReturnGubun:'',//部品返还区分
                ChargeYn:'',//收费与否
                CfmYn:0,//确定
                ASNote:'',//AS处理详细
                ProcResultReason:'',//AS处理结果原因
                CustOpinion:'',//客户意见
                Remark:'',//备注
                ProcPerson:'',//经办人
                TransLine:'',//行驶里程
                ArrivalTime:'',//抵达时间
                StartTime:'',//离开时间
            },
            asRecv:{

            },
            asHandleItem:{
                ASSerl:'',
                ItemNo:'',
                ItemNm:'',
                ItemCd:'',
                Spec:'',
                UnitNm:'',
                UnitCd:'',
                Qty:'',
                ASRepairAmt:'',
                Amt:'',
                StdPrice:'',
                ChargeYn:'N',
                ReUseYn:'N',
                Remark:'',
                isAsHandle:0,
            },
        },
        list:{
            asHandle:{
                asHandleList:[],
                itemList:[],
                unitList:[],
                ASKindList:[],
                ASASProcKindList:[],
                ASProcResultList:[],
                itemReturnList:[],
            },
            asRecv:{}
        },
        langCode:{

        },
        //style
        style_astable_minute:{
            'top':0,
        },
        //class
        multi_input:{
            'multi-input':true,
            'text-left'  :true,
            'xwrite'     :true
        },
        ms_trans:{
            'mui-switch':true,
            'mui-active':false
        },
        ms_asconfirm:{
            'mui-switch':true,
            'mui-active':false
        },
        ms_asreturn:{
            'mui-switch':true,
            'mui-active':false
        },
        ms_asisfinish:{
            'mui-switch':true,
            'mui-active':false
        },
        cs_menu:{
            'AS_menu':true,
        },
        cs_order_query:{
            'find-window':true,
        },
        downLoadScript : true,
        //必填项标记
        must_order_id              :{'th-red':true},
        must_orderclass            :{'th-red':true},
        must_spec_id               :{'th-red':true},
        must_cust_name             :{'th-red':true},
        must_export_distinction    :{'th-red':true},
        must_model_id              :{'th-red':true},
        must_drano                 :{'th-red':true},
        must_assetdate             :{'th-red':true},
        must_asusernm              :{'th-red':true},
        must_asgroupnm             :{'th-red':true},
        must_ascause               :{'th-red':true},
        must_asbadtype             :{'th-red':true},
        must_asallclass            :{'th-red':true},
        must_asdutyclass           :{'th-red':true},
        must_asappearance          :{'th-red':true},
        must_asreasonclass         :{'th-red':true},
        must_asserviceclass        :{'th-red':true},
        must_asservicearea         :{'th-red':false},
        must_supplyscope           :{'th-red':true},
        must_hrs                   :{'th-red':true},
        must_manifoldtype          :{'th-red':true},
        must_systemsize            :{'th-red':true},
        must_systemtype            :{'th-red':true},
        must_gatetype              :{'th-red':true},
        must_cust_produce_name     :{'th-red':true},
        must_asplastic             :{'th-red':true},
        must_Gate_counts           :{'th-red':true},
        must_markets               :{'th-red':true},
        must_trans                 :{'th-red':false},
        must_text1                 :{'th-red':true},
        must_text2                 :{'th-red':true},
        must_text3                 :{'th-red':true},
        //全局属性
        loginUser               :'',
        loginId                 :'',
        loginUserNm             :'',
        loginUserId             :'',
        loginGroupNm            :'',
        loginGroupId            :'',
        global_title            :'YUDO Mobile Erp',
        global_scroll           :0,
        global_update           :0,
        global_qrclass          :'',
        //元素控制
        errorMenu:              'false',
        as_menu_show            :true,
        transdom                :false,
        find_grouplist_show     :false,
        slide_panel_show        :false,
        astable_minute_show     :false,
        find_asphoto_show       :false,
        find_assales_show       :false,
        find_as_isopen          :false,
        asListScreen            :false,
        showAsRate              :false,
        //
        r_custprsn              :false,
        r_custtell              :false,
        r_custemail             :false,
        r_asserviceclass        :false,
        r_cust_produce_name     :false,
        r_asplastic             :false,
        r_text1                 :false,
        r_text2                 :false,
        r_text3                 :false,
        r_text4                 :false,

        isloadding              :false,
        as_isloadding           :false,
        order_isloadding        :false,

        asitem_isloadding       :false,
        nodata                  :false,
        assales_checkbox        :[],
        grouplist               :[],
        astablelist             :[],
        asphotolist             :[],
        assaleslist             :[],

        //select
        fselect_area             :[],
        select_area             :[],
        select_ascause          :[],
        select_ascause_c        :[],
        select_markets          :[],
        select_asclass1         :[],
        select_asclass1_c       :[],
        select_startpoint       :[],
        select_asbadtype        :[],
        select_supplyscope      :[],
        select_supplyscope_c1   :[],
        select_supplyscope_c2   :[],
        select_supplyscope_c3   :[],
        select_supplyscope_c4   :[],
        select_supplyscope_c5   :[],
        select_unit             :[],
        select_asclass          :[],
        select_orderclass       :[
            {value:'2',text:''},
            {value:'1',text:''}
        ],
        select_export_distinction : [
            {value:1,text:''},
            {value:4,text:''}
        ],
        langCode                :[],
        //查询输入条件
        input_groupfindname     :'',
        input_groupfindid       :'',
        menu_newAs              :'',
        menu_queryAs            :'',
        menu_back               :'',
        //AS进度界面
        asRate:{

            InvoiceComplete:false,
            ProductComplete:false,
            EmpNm:'',//员工姓名
            DeptNm:'',//部门名称
            RefNo:'',//模号
            CustNm:'',//客户名称
            ASRecvDate:'',
            DelvDate:'',
            ProductStatus:'',
            WkAptDate:'',//生产接受日期
            WPlanCfmDate:'',//指示确定日期
            WDelvDate:'',//生产交期
            ModifyCnt:'',//变更次数
            WDelvChUptDate:'',//变更日期
            DrawNo:'',//图纸编号
            DrawAmd:'',//图纸版本
            DrawAptDate:'',//图纸接受日期
            OutDate:'',//出图日期

            InvoiceNo:'',
            InvoiceDate:'',
            InvoiceType:'',
            InvoiceTypeNm:'',
            CfmYn:'',
            ColDate:'',
            ColYn:'',
        },
        //其他
        w_ordergubun            :'',
        w_order_id              :'',
        w_order_cnt             :0,
        w_spec_id               :'',
        w_spec_type             :'',
        w_cust_name             :'',
        w_cust_id               :'',
        w_cust_produce_name     :'',
        w_export_distinction    :'',
        w_export_distinction_id :'',
        w_model_id              :'',
        w_Gate_counts           :'',
        w_markets_id            :'',
        w_drano                 :'',
        w_dranm                 :'',
        w_asid                  :'',
        w_asclass_id            :'',
        w_asgetdate             :'',
        w_assetdate             :'',
        w_asusernm              :'',
        w_asuserid              :'',
        w_asgroupnm             :'',
        w_asgroupid             :'',
        w_status                :'',
        w_custprsn              :'',
        w_custtell              :'',
        w_custemail             :'',
        w_asdrawid              :'',
        w_asdrawnm              :'',
        w_asplastic             :'',

        w_ascause_id            :'',

        w_asbadtype_id          :'',

        w_asallclass_id         :'',

        w_asdutyclass_id        :'',

        w_asappearance_id       :'',

        w_asreasonclass_id      :'',
        w_asaccept              :'',

        w_asserviceclass_id     :'',
        w_asservicearea         :'',
        w_aschargeclass         :'',
        w_transgroup            :'',
        w_transgroup_id         :'',
        //SYSTEM

        w_supplyscope_id        :'',

        w_hrs_id                :'',

        w_manifoldtype_id       :'',

        w_systemsize_id         :'',

        w_systemtype_id         :'',

        w_gatetype_id           :'',
        //SWITCH
        s_trans                 :'',
        s_confirm               :'',
        s_apt                   :'',
        s_charge                :'',
        s_itemreturn            :'',
        s_product               :'',
        //TEXT
        w_text1                 :'',
        w_text2                 :'',
        w_text3                 :'',
        w_text4                 :'',
        //astable
        w_astable_ChargeYn      :'',
        w_astable_ItemNo        :'',
        w_astable_ItemNm        :'',
        w_astable_ItemCd        :'',
        w_astable_NextQty       :'',
        w_astable_PreStockQty   :'',
        w_astable_Remark        :'',
        w_astable_Sort          :'',
        w_astable_ASRecvSerl    :'',
        w_astable_SpareYn       :'',
        w_astable_Spec          :'',
        w_astable_Qty           :'',
        w_astable_StopQty       :'',
        w_astable_UnitNm        :'',
        w_astable_UnitId        :'',
    },
    //过滤器
    filters: {
        confirmChange:function(value){
            if(value == 1 ||  value == 'Y'){
                value = '<span style="font-size: 13px;padding: 1px 4px" class="yudo-label label-success">YES</span>';
            }
            else
            {
                value = '<span style="font-size: 13px;padding: 1px 4px" class="yudo-label label-default">NO</span>';
            }
            return value;
        },
        productStatusChangeM:function(value){
            switch (value){
                case '0':
                    return leon.langCode.noRelyn;
                    break;
                case '1':
                    return leon.langCode.noReceive;
                    break;
                case '2':
                    return leon.langCode.receive;
                    break;
                case '3':
                    return leon.langCode.productY;
                    break;
            }
        },
        procResultViewChange:function(ProcResult,ProcResultNm){
            switch (ProcResult){
                case 'AS20030010':
                    return '<span style="font-size: 13px;padding: 1px 4px" class="yudo-label label-success">'+ProcResultNm+'</span>';
                    break;
                case 'AS20030020':
                    return '<span style="font-size: 13px;padding: 1px 4px" class="yudo-label label-default">'+ProcResultNm+'</span>';
                    break;
                case 'AS20030030':
                    return '<span style="font-size: 13px;padding: 1px 4px" class="yudo-label label-primary">'+ProcResultNm+'</span>';
                    break;
                case 'AS20030900':
                    return '<span style="font-size: 13px;padding: 1px 4px" class="yudo-label label-primary">'+ProcResultNm+'</span>';
                    break;
            }
        },
        date:function (value) {
            if(value != '' && value != null && value != '--'){
                return value.substr(0,10);
            }else{
                return value;
            }
        },
        dateHi:function(value){
            if(value != '' && value != null && value != '--'){
                return value.substr(5,11);
            }else{
                return value;
            }
        },
        mf_aspower:function (value) {
            if(value == 1 ||  value == 'Y'){
                value = '<div class="yudo-label label-primary" style="font-size: 14px; line-height: 30px; padding: 0px 10px; height: 30px;">YES</div>';
            }
            else
            {
                value = '<div class="yudo-label label-default" style="font-size: 14px; line-height: 30px; padding: 0px 10px; height: 30px;">NO</div>';
            }
            return value;
        }
    },
    //数据变更回调
    updated:function(){
    },
    //构造函数
    created(){

    },
    //页面加载完成后运行
    mounted(){
        mui.showLoading();
        langCode.method='cache';
        langCode.getWord({
                    search:'W2018082711232500387',//查询
                    menuBack                :'W2018071009230638074',   //主菜单
                    view_orderClass         :'W2018062810274700393',
                    view_setData            :'W2018062810315076351',
                    view_userNm             :'W2018041913373764065',
                    view_asClass            :'W2018062810311830074',
                    view_orderId            :'W2018041913141737708',
                    view_ExportDistinction  :'W2018041913341497746',
                    view_CustomerName       :'W2018041913362840092',
                    view_custProduceName    :'W2018062810394954779',
                    view_asPlastic          :'W2018062810400728768',
                    view_asCause            :'W2018062810340442303',
                    view_asbadtype          :'W2018070615404644098',
                    view_asCauseClass       :'W2018062810353978387',
                    view_asDutyClass        :'W2018062810355432043',
                    view_asAppearance       :'W2018062810361161368',
                    view_asReasonClass      :'W2018062810362923732',
                    view_asServiceAreaClass :'W2018062810365984312',
                    view_chargeYn           :'W2018062810383100024',
                    view_itemReturn         :'W2018062810384422313',
                    view_isTrans            :'W2018062810373797345',
                    view_isTransGroup       :'W2018062810374972369',
                    view_asStatusDescription:'W2018062810434922701',
                    view_causeAnalysis      :'W2018062810441287373',
                    view_improvementProposals :'W2018062810445845052',
                    view_modelId              :'W2018062810293127369',
                    menu_newAs               :'W2018062810264620307',
                    menu_queryAs             :'W2018062810271817755',
                    menu_back                :'W2018071009230638074',
                    msgSave                  :'W2018071009410262081',
                    button_adds              :'W2018071013045597784',
                    button_upload            :'W2018071013053669009',
                    noQrcodeInfo    :'W2018050317441830047',//没有扫描到信息
                    oldErp          :'W2018070509533542731',
                    newErp          :'W2018070509535248086',
                    exportTrust     :'W2018070509544706013',
                    exportUntrust   :'W2018070509584977391',
                    userIsExist     :'W2018050410481052775',
                    isConfirm       :'W2018070510002158367',
                    noHoldAs        :'W2018070510011580043',
                    queryNoData     :'W2018070510020761032',
                    permissionIsNo  :'W2018070510030146069',
                    uploadSuccess   :'W2018070510041152027',
                    recordIsExisted :'W2018070510050826032',
                    recordIsDoing   :'W2018070510060085021',
                    recordIsNot     :'W2018070510062611362',
                    cancelSuccess   :'W2018070510065571347',
                    asUpdateSuccess :'W2018070510072716779',
                    apply           :'W2018070510075477084',
                    handle          :'W2018070510082072382',
                    accept          :'W2018070510085487742',
                    chooseAsClass   :'W2018070510093444357',
                    holdAsSuccess   :'W2018050317440350711',
                    holdAsReady     :'W2018070510103046025',
                    deleteReady     :'W2018050410472916349',
                    chooseItem      :'W2018070510115523029',
                    chooseNumber    :'W2018070510121145349',
                    chooseMust      :'W2018070510141164391',
                    writeMust       :'W2018070510142688735',
                    isAdjudication  :'W2018070615024454069',
                    noOrderId       :'W2018050317432047312',
                    mustLessFive    :'W2018050410474726098',
                    mustLessFivePhotos  :'W2018070615112366786',
                    orderInfo:'W2018041913130033733',
                    itemNo:'W2018062810504422036',//品目编码
                    itemCd:'W2018071013443085307',//产品型号
                    catalogueName:'W2018062810511435013',//品目名称
                    spec:'W2018062810520860062',//规格
                    number:'W2018062810534850327',//数量
                    unitNm:'W2018062810523215799',//库存单位
                    status:'W2018082315443716702',//状态
                    orderNo:'W2018041913141737708',//订单号码
                    custNm:'W2018041913134073778',//客户名称
                    custCd:'W2018062810473444353',//客户编号
                    orderDate:'W2018041913163666042',//订单日期
                    empNm:'W2018041913373764065',//职员名称
                    empId:'W2018041913385580778',//员工工号
                    delvDate:'W2018062810315076351',//交货日期
                    deptNm:'W2018041913371894064',//部门名称
                    deptCd:'W2018041913392311092',
                    product:'W2018071009332016011',//生产完成
                    trustOrUntrust:'W2018062810484850324',//国内/国外
                    specNo:'W2018053017424773317',//技术规范编号
                    expClass:'W2018041913341497746',//出口区分
                    specDate:'W2007110211452990075',//技术规范日期
                    asNo:'W2018062810310464752',
                    asRecvDate:'W2018062810313521387',
                    date:'W2018082712533876756',
                    screen:'W2019041817352089305',//筛选
                    roback:'W2019050918161296005',//重置
                    confirm:'W2018071009351100377',//确定
                    noRelyn:'W2019042412535019323',//未依赖
                    noReceive:'W2019042412553192026',//未接收
                    receive:'W2019042412555230001',//接收
                    productY:'W2019042412531575798',//生产完成
                    productStatus:'W2019042413002394358',//生产状态
                    asNoapply:'W2019052411010107337',//AS单还未接收，没有进度信息
                    asRecv:'W2019030809162934375',//as接收
                    rateInfo:'W2019052415160666345',//详细进度
                
                    asRate:'W2019052410563940306',//AS进度
                    rateStep:'W2019052410570383767',//进度跟踪
                    invoiceInfo:'W2019052410575035051',//送货单信息
                    invoiceNo:'W2019052410581713013',//送货单号
                    invoiceDate:'W2019052410583836748',//送货单日期
                    invoiceClass:'W2019052410585180719',//送货单区分
                    colDate:'W2019052410590885795',//回签日期
                    cfmDate:'W2019052410593477398',//确定日期

                    WPlanDateM:'W2019050916284420086',//生产接受日期
                    changeCnt:'W2019050916285987387',//变更次数
                    WDelvChRemarkM:'W2019050916300738082',//变更事由
                    WDelvDateM:'W2019050916302241069',//生产交期
                
                    deviseInfo:'W2019050916312566729',//设计信息
                    OutDateM:'W2019050916320384028',//出图日期
                    farmInfo:'W2019050916322786702',//车间信息
                    productInfo:'W2019050916281827337',//生产信息
                    WCDelvDateM:'W2019050916341365746',//指示
                    WCStartDateM:'W2019050916342812086',//开始
                    WCEndDateM:'W2019050916344115314',//完成
                    QCDateM:'W2019050916345503011',//检查
                    afterSaleServiceM:'W2019050916395628784',//售后服务
                    WCDelvDateM2:'W2019051315392177323', //指示确定日期
                    RefNo:'W2018062810293127369',//模号
                    asDelvDate:'W2018062810313521387',//AS接收日期
                    pronM:'W2019051315430001369',//负责人
                    defaultInfo:'W2019051315443623717',//基础信息
                    drawNo:'W2019051315461309727',//图纸编号
                    drawDelvDate:'W2019051315465675322',//图纸接收编号
                    deviseAccept:'W2019052411015543764',//设计接收
                    deviseOutDraw:'W2019052411022048747',//设计出图
                    workIndicate:'W2019052411024866034',//作业指示
                    productEnd:'W2019052411031341383',//生产截止
                    none:'W2019052411033561004',//无
                    pullMore:'W2019061017355893394',//加载更多
                    noData:'W2018062810475725084',//没有信息了
                    remark:'W2018041913225420017',//备注
                    asAreaGubun:'W2018062810365984312',//服务地区区分
                    asServiceArea:'W2018062810372363351',//服务地点

                    addAsProc:'W2019090917250476733',//AS处理录入
                    specId:'W2018062810281624053',//技术规范编号
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
                    itemInfoM:'W2019091011093556073',//品目信息
                    priceM:'W2019091012561278343',//单价
                    moneyM:'W2019060617371554742',//金额
                    searchAsProc:'W2019091013323952817',//AS处理查询
                    hasAsProc:'W2019091013323961795',//当前AS处理已经存在
                    mustSetAsProc:'W2019091013323965399',//请先保存AS处理信息
                    asProcCfm:'W2019091013361990327',//当前AS处理已经确定
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
                    saveErr:'W2018050317441072027',//保存失败

                },this.langCode,this._updateLang);
        this.getLoginInfo();
    },
    //方法
    methods:{
        _updateLang:function(){
            this.mui_switch();
            var nowDateArr = multi.getNowDate('array');
            var nowFirstDay = nowDateArr[0] + "-" + nowDateArr[1] + "-01";
            var nowTime = nowDateArr[0] + "-" + nowDateArr[1] + "-" + nowDateArr[2];
            this.input_asStartDate = this.input.asHandle.asHandleStartDate = nowFirstDay;
            this.input_asEndDate = this.input.asHandle.asHandleEndDate = nowTime;
            try{
                this.system_big_class('asclass1');
                this.system_big_class('markets');
                this.system_big_class('ascause');
                this.system_big_class('area');
                this.system_big_class('startpoint');
                this.system_big_class('asbadtype');
                this.system_big_class('supplyscope');
                this.system_big_class('asclass');
                this.getASKindList();
                this.getASProcKindList();
                this.getASProcResultReasonList();
                this.getItemReturnGubunList();
                multi.getUnitList(res => {
                    this.list.asHandle.unitList = res;
                    this.list.asHandle.unitList.unshift({value:'',text:''})
                });
                this.unit_class();
            }catch (e) {
                mui.alert('初始化数据时发生致命错误，请重新打开界面',this.global_title);
            }
            mui.hideLoading();
            this.downLoadScript = false;
            this.select_orderclass = [
                    {value:'2',text:this.langCode.oldErp},
                    {value:'1',text:this.langCode.newErp}
                ];
                this.select_export_distinction = [
                    {value:1,text:this.langCode.exportTrust},
                    {value:4,text:this.langCode.exportUntrust}
                ];
                this.w_status = this.langCode.apply;
            // this.langCode = langCode;
            this.langCode.asHandleNo = 'AS处理编号'
            this.menu_back = this.langCode.menu_back;
            this.menu_newAs = this.langCode.menu_newAs;
            this.menu_queryAs = this.langCode.menu_queryAs;
            jq('#btn_menu_lists').val(this.langCode.menu_back);
            jq('#photo-up').val(this.langCode.button_upload);
            jq('#sales-add').val(this.langCode.button_adds);
            jq('#item_save').val(this.langCode.msgSave)
        },
        login_user:function(){
            leon.w_asusernm = leon.loginUserNm;
            leon.w_asuserid = leon.loginUserId;
            leon.w_asgroupid = leon.loginGroupId;
            leon.w_asgroupnm = leon.loginGroupNm;
            leon.loginId = leon.loginUserId;
            leon.loginUser = leon.loginUserNm;
        },
        //隐藏主界面
        slide_panel_close:function(){
            if(this.w_asid == '' && this.w_cust_id != '' && this.w_asclass != ''){
                mui.confirm('是否保存AS单?', 'YUDO Mobile ERP', ['YES','NO'], function(es) {
                        if (es.index == 0) {
                            leon.save_as();
                        }
                        else
                        {
                            // if(popAsRecvModal.showPop == false){
                            //     this.as_query_open()
                            // }
                            popAsRecvModal.view.style.zIndex = 102;

                            leon.as_menu_show = true;
                            leon.slide_panel_show = false;
                        }
                });
            }else {
                    // if(popAsRecvModal.showPop == false){
                    //     this.as_query_open()
                    // }
                    popAsRecvModal.view.style.zIndex = 102;
                    leon.as_menu_show = true;
                    leon.slide_panel_show = false;
            }
        },
        slide_panel_open:function(){
            this.clear_as();
            this.as_menu_show = false;
            this.slide_panel_show = true;
        },
        //订单查询界面隐藏和显示
        order_query_open:function(){
            if(this.w_ordergubun == 2){
                return false;
            }
            popOrderModal.show(
                function () {
                    popOrderModal.hide();
                },res => {
                    popOrderModal.hide();
                    this.getOrderInfo(res.OrderNo);
                }
            );
        },

        //.从AS接受导入到AS处理
        routeAsHandle:function(){
            this.hideExtend();
            if(this.w_asid == ''){
                mui.alert(leon.langCode.noHoldAs,this.global_title);
                return false;
            }
            this.showAddAsHandle();
            mui.showLoading();
            http.get('/WEI_2100/getAsHandleByAsRecvNo',{asRecvNo:this.w_asid},res => {
                //.当存在AS处理，则直接查询AS处理的信息
                if(res.returnCode == 0){
                    this.displayAsHandle(res);
                    mui.hideLoading();
                }else{
                    //.当不存在AS处理，则查询AS接收信息带入
                    http.get('/WEI_2100/as_minute',{asid:this.w_asid},res1 => {
                        res1.data.CfmYn = 0;
                        this.displayAsHandle(res1);
                        this.write.asHandle.ASType = res1.data.AStype;
                        this.write.asHandle.ASDate = multi.getNowDate();
                    });
                    http.get('/WEI_2100/as_minute_table',{asid:this.w_asid},res2 => {
                        for(let i in res2.data[0]){
                            res2.data[0][i].isAsHandle = 0;
                            res2.data[0][i].Amt = 0;
                            res2.data[0][i].ASRepairAmt = 0;
                            res2.data[0][i].ReUseYn = 'N';
                            res2.data[0][i].ASSerl = res2.data[0][i].ASRecvSerl;
                        }
                        this.list.asHandle.itemList = res2.data[0];

                    })
                }
            },res => {},res => {});
        },
        //.显示AS处理录入界面
        showAddAsHandle:function(){
            this.view.showAddAsHandle = true;
            this.clearAsHandelInfo();
            setTimeout(function(){
                this.asHandleSwitchinit();
            }.bind(this),300);
        },
        //.隐藏AS处理录入界面
        hideAddAsHandle:function(){
            this.view.showAddAsHandle = false;
        },
        //.显示AS处理查询界面
        showQueryAsHandle:function(){
            this.view.showQueryAsHandle = true;
        },
        //.隐藏AS处理查询界面
        hideQueryAsHandle:function(){
            this.view.showQueryAsHandle = false;
        },
        //.显示AS处理品目界面
        showAsHandleItem:function(index){
            this.view.showAsHandleItem  = true;
            setTimeout(function(){
                this.asHandleItemSwitchinit();
            }.bind(this),50);
            setTimeout(function () {
                this.write.asHandleItem.ReUseYn == 'Y' ? multi.openSwitch('itemUseYn') : multi.closeSwitch('itemUseYn');
                this.write.asHandleItem.ChargeYn == 'Y' ? multi.openSwitch('itemChargeYn') : multi.closeSwitch('itemChargeYn');
            }.bind(this),100);
            this.write.asHandleItem.ASSerl = parseInt(this.list.asHandle.itemList[index].ASSerl);
            this.write.asHandleItem.ItemNo = this.list.asHandle.itemList[index].ItemNo;
            this.write.asHandleItem.ItemNm = this.list.asHandle.itemList[index].ItemNm;
            this.write.asHandleItem.ItemCd = this.list.asHandle.itemList[index].ItemCd;
            this.write.asHandleItem.Spec   = this.list.asHandle.itemList[index].Spec;
            this.write.asHandleItem.UnitNm = this.list.asHandle.itemList[index].UnitNm;
            this.write.asHandleItem.UnitCd = this.list.asHandle.itemList[index].UnitCd;
            this.write.asHandleItem.Qty    = parseInt(this.list.asHandle.itemList[index].Qty);
            this.write.asHandleItem.ASRepairAmt = parseFloat(this.list.asHandle.itemList[index].ASRepairAmt).toFixed(2);
            this.write.asHandleItem.Amt         = parseFloat(this.list.asHandle.itemList[index].Amt).toFixed(2);
            this.write.asHandleItem.StdPrice    = 0;
            this.write.asHandleItem.ChargeYn    = this.list.asHandle.itemList[index].ChargeYn;
            this.write.asHandleItem.ReUseYn     = this.list.asHandle.itemList[index].ReUseYn;
            this.write.asHandleItem.Remark      = this.list.asHandle.itemList[index].Remark;
            this.write.asHandleItem.isAsHandle  = this.list.asHandle.itemList[index].isAsHandle;

        },
        //.新增AS处理品目
        addAsHandleItem:function(){
            if(this.asProcCfmCheck() == false) return false;
            setTimeout(function(){
                this.asHandleItemSwitchinit();
            }.bind(this),50);
            this.view.showAsHandleItem = true;
            this.clearAsHandleItem();
            if(this.list.asHandle.itemList.length == 0){
                this.write.asHandleItem.ASSerl = 1;
            }else{
                this.write.asHandleItem.ASSerl = this.list.asHandle.itemList[this.list.asHandle.itemList.length-1].ASSerl + 1;
            }
        },
        clearAsHandleItem:function(){
            this.write.asHandleItem = {
                ASSerl:'',
                ItemNo:'',
                ItemNm:'',
                ItemCd:'',
                Spec:'',
                UnitNm:'',
                UnitCd:'',
                Qty:'',
                ASRepairAmt:0,
                Amt:0,
                StdPrice:0,
                ChargeYn:'N',
                ReUseYn:'N',
                Remark:'',
                isAsHandle:0,
            }
        },
        //.查询AS处理品目列表
        showQueryAsHandleItem:function(){
            if(this.asProcCfmCheck() == false) return false;
            popItemModal.show(
                function () {
                    popItemModal.hide();
                },function (res) {
                    this.write.asHandleItem.ItemNo = res.ItemNo;
                    this.write.asHandleItem.ItemNm = res.ItemNm;
                    this.write.asHandleItem.ItemCd = res.ItemCd;
                    this.write.asHandleItem.Spec   = res.Spec;
                    this.write.asHandleItem.UnitCd = res.UnitCd;
                    this.write.asHandleItem.StdPrice = 0;
                    this.write.asHandleItem.Qty = 1;
                    this.write.asHandleItem.Amt = 0;
                    popItemModal.hide();
                }.bind(this));
        },

        itemQtyChange:function(){
            this.write.asHandleItem.Amt = parseFloat(this.write.asHandleItem.Qty * this.write.asHandleItem.StdPrice).toFixed(2);
        },
        itemStdPriceChange:function(){
            this.itemQtyChange();
        },

        //.显示AS接受界面扩展功能
        showExtend:function(){
            mui('#popover').popover('show');
        },
        //.隐藏AS接受界面扩展功能
        hideExtend:function(){
            mui('#popover').popover('hide');
        },
        //.AS处理查询筛选确定
        asHandleScreenCnf:function(){
            this.searchAsHandle();

        },
        //.AS处理查询筛选重置
        asHandleScreenClear:function(){
            this.input.custNm = '';
        },
        showAsHandleEmpy:function(){
            if(this.asProcCfmCheck() == false) return false;
            popEmpyModal.show(
                function () {
                    popEmpyModal.hide();
                },function (res) {
                    popEmpyModal.hide();
                    this.write.asHandle.EmpNm = res.EmpNm;
                    this.write.asHandle.EmpId  = res.EmpID;
                    this.write.asHandle.DeptNm = res.DeptNm;
                    this.write.asHandle.DeptId = res.DeptCd;
                }.bind(this)
            );
        },
        showAsHandleSpec:function(){
            popSpecModal.show(
                function () {
                    popSpecModal.hide();
                },function (res) {
                    popSpecModal.hide();
                    this.write.asHandle.SpecNo = res.SpecNo;
                }.bind(this)
            );
        },
        showAsHandleCust:function(){
            if(this.asProcCfmCheck() == false) return false;
            popCustModal.show(
                function () {
                    popCustModal.hide();
                },function (res) {
                    popCustModal.hide();
                    this.write.asHandle.CustCd = res.CustCd;
                    this.write.asHandle.CustNm = res.CustNm;
                }.bind(this)
            );
        },
        //客户查询界面
        cust_query_open:function() {
            if(this.pushCheck() == false) return false;
            popCustModal.show(
                function () {
                    popCustModal.hide();
                },function (res) {
                    popCustModal.hide();
                    this.w_cust_id = res.CustCd;
                    this.w_cust_name = res.CustNm;
                }.bind(this)
            );
        },
        //技术规范查询界面隐藏显示
        spec_query_open:function(){
            if(this.pushCheck() == false) return false;
            popSpecModal.show(
                function () {
                    popSpecModal.hide();
                },function (res) {
                    popSpecModal.hide();
                    mui.showLoading();
                    var params = {};
                    params.specid = res.SpecNo
                    http.get('/WEI_2100/spec_minute',params,res => {
                        this.dis_spec_minute(res.data);
                    });
                }.bind(this)
            );
        },

        //AS接受列表查询
        as_query_open:function(){
            popAsRecvModal.view.style.zIndex = 102;
            popAsRecvModal.view.showGetRate = true;
            popAsRecvModal.show(
                function () {
                    popAsRecvModal.hide();
                },res => {

                    mui.showLoading('loading...',leon.global_title);
                    var params = {};
                    params.asid = res.ASRecvNo;
                    http.get('/WEI_2100/as_minute',params,res => {
                        popAsRecvModal.view.style.zIndex = -1;
                        leon.dis_as_minute(res.data);
                    });
                    this.query_as_table(res.ASRecvNo);
                },res => {
                    this.getRate(res);
                }

            );
            if(this.global_update == 0){
                this.update_select();
            }
            this.find_as_isopen = true;
            this.find_aslist_show = true;
        },
        as_query_close:function(check){
            // this.aslist = [];
            if(check == 'choose'){
                this.slide_panel_show = true;
                this.as_menu_show = false;
            }
            else
            {
                this.find_as_isopen = false;
            }
            this.find_aslist_show = false;
            this.as_isloadding = false
            this.as_nodata = false;
            this.global_as_num = 0;
        },
        //用户查询界面打开
        users_query_open:function(){
            if(this.pushCheck() == false) return false;
            popEmpyModal.show(
                function () {
                    popEmpyModal.hide();
                },function (res) {
                    popEmpyModal.hide();
                    this.w_asusernm  = res.EmpNm;
                    this.w_asuserid  = res.EmpID;
                    this.w_asgroupnm = res.DeptNm;
                    this.w_asgroupid = res.DeptCd;
                }.bind(this)
            );
        },
        group_query_open:function(){
            if(this.pushCheck() == false) return false;
            this.global_scroll =jq('#leon').scrollTop();
            this.find_grouplist_show = true;
            this.slide_panel_show = false;
        },
        group_query_close:function(){
            this.slide_panel_show = true;
            this.grouplist = [];
            this.find_grouplist_show = false
            window.scrollTo(0,leon.global_scroll);
            var oTimer = setInterval(function() {
                    console.log(1);
                    jq('#leon').scrollTop(leon.global_scroll);
                    if(jq('#slide_panel').is(':hidden') != true){
                        clearInterval(oTimer);
                    }
                },100);
        },
        astable_minute_open:function(e){
            this.global_scroll = jq('#leon').scrollTop();
            this.slide_panel_show = false;
            this.astable_minute_show = true;
            if(e == 'add'){
                this.clear_astable();
            }
            else {
                this.set_astable(e);
            }
        },
        astable_minute_close:function(){
            this.slide_panel_show = true;
            this.astable_minute_show = false;
            this.clear_astable();
            var oTimer = setInterval(function() {
                console.log(1);
                jq('#leon').scrollTop(leon.global_scroll);
                if(jq('#slide_panel').is(':hidden') != true){
                    clearInterval(oTimer);
                }
            },100);
        },
        astableid_query_open:function(){
            if(this.w_asid == ''){
                mui.alert(leon.langCode.noHoldAs,leon.global_title);
                return false;
            }
            if(this.pushCheck() == false) return false;
            popItemModal.show(
                function () {
                    popItemModal.hide();
                },function (res) {
                    this.w_astable_ItemNo = res.ItemNo;
                    this.w_astable_ItemNm = res.ItemNm;
                    this.w_astable_ItemCd = res.ItemCd
                    this.w_astable_Spec   = res.Spec;
                    this.w_astable_UnitNm = res.UnitNm;
                    this.w_astable_UnitId = res.UnitCd;
                    this.w_astable_PreStockQty = parseInt(res.PreStockQty);
                    popItemModal.hide();
                }.bind(this)
            );
        },
        asphoto_query_open:function(){
            this.global_scroll = jq('#leon').scrollTop();
            this.slide_panel_show = false;
            this.asphotolist = [];
            this.find_asphoto_show = true;
            this.query_as_photo();
        },
        asphoto_query_close:function(){
            this.slide_panel_show = true;
            this.find_asphoto_show = false;
            var oTimer = setInterval(function() {
                console.log(1);
                jq('#leon').scrollTop(leon.global_scroll);
                if(jq('#slide_panel').is(':hidden') != true){
                    clearInterval(oTimer);
                }
            },100);
        },
        assales_query_open:function(){
            this.global_scroll = jq('#leon').scrollTop();
            this.slide_panel_show = false;
            this.find_assales_show = true;
            this.query_as_sales();
        },
        assales_query_close:function(){
            this.slide_panel_show = true;
            this.find_assales_show = false;
            var oTimer = setInterval(function() {
                console.log(1);
                jq('#leon').scrollTop(leon.global_scroll);
                if(jq('#slide_panel').is(':hidden') != true){
                    clearInterval(oTimer);
                }
            },100);
        },
        assaleslist_query_open:function(){
            popEmpyModal.show(
                function () {
                    popEmpyModal.hide();
                },function (res) {
                    if(this.w_asid == ''){
                        mui.alert(leon.langCode.noHoldAs,leon.global_title);
                        return false;
                    }
                    if(this.pushCheck() == false) return false;
                    popEmpyModal.hide();
                    var params = {};
                    params.sales = res.EmpId;
                    params.asid = this.w_asid;
                    http.post('/WEI_2100/save_sales',params,res => {
                        this.assales_checkbox = [];
                        if (res.returnCode == 'I828') {
                            mui.alert(this.langCode.userIsExist, this.global_title);
                        }else{
                            this.query_as_sales();
                        }
                    });
                }.bind(this)
            );
            popEmpyModal.model.popEmpNm = this.loginUser;
        },

        //.查询AS处理列表
        searchAsHandle:function(){
            this.view.count = 0;
            this.list.asHandle.asHandleList = [];
            this.view.asHandleScreen = false;
            var param = {};
            param.asHandleNo = this.input.asHandle.asHandleNo;
            param.asHandleStartDate = this.input.asHandle.asHandleStartDate;
            param.asHandleEndDate = this.input.asHandle.asHandleEndDate;
            param.custNm = this.input.asHandle.custNm;
            param.count = 0;
            this.view.noData = false;
            this.view.pullMore = false;
            mui.showLoading();
            http.get('/WEI_2100/getAsHandle',param,res => {
                if(res.returnCode == 0){
                    this.list.asHandle.asHandleList = res.data[0];
                    if(res.data[0].length < 50){
                        this.view.noData = true;
                        this.view.pullMore = false;
                    }else{
                        this.view.noData = false;
                        this.view.pullMore = true;
                    }
                }else{
                    this.view.noData = true;
                    this.view.pullMore = false;
                }
            });
        },
        //.查询更多AS处理列表
        pullAsHandelMore:function(){
            this.view.count  = this.view.count + 50;
            var param = {};
            param.asHandleNo = this.input.asHandle.asHandleNo;
            param.asHandleStartDate = this.input.asHandle.asHandleStartDate;
            param.asHandleEndDate = this.input.asHandle.asHandleEndDate;
            param.custNm = this.input.asHandle.custNm;
            param.count = this.view.count;
            mui.showLoading();
            http.get('/WEI_2100/getAsHandle',param,res => {
                console.log(res);
                if(res.returnCode == 0){
                    for(let i in res.data[0]){
                        this.list.asHandle.asHandleList.push(res.data[0][i]);
                    }
                    if(res.data[0].length < 50){
                        this.view.noData = true;
                        this.view.pullMore = false;
                    }else{
                        this.view.noData = false;
                        this.view.pullMore = true;
                    }
                }else{
                    this.view.noData = true;
                    this.view.pullMore = false;
                }
            });
        },
        chooseAsHandle:function(index){
            this.showAddAsHandle();
            this.getAsHandleInfo(this.list.asHandle.asHandleList[index].ASNo);
        },
        getAsHandleInfo:function(ASNo){
            mui.showLoading();
            var param = {};
            param.asHandleNo = ASNo;
            http.get('/WEI_2100/getAsHandleInfo',param,res => {
                if(res.returnCode == 0){
                    this.displayAsHandle(res);
                }else{
                    mui.hideLoading();
                }
            },res => {},res => {});
        },
        displayAsHandle:function(res){
            let write = this.write.asHandle;
            write.ASNo = res.data.ASNo || '';
            write.ASDate = res.data.ASDate|| '';
            write.ASRecvNo = res.data.ASRecvNo|| '';
            write.ASType = res.data.ASType|| '';
            write.ASTypeNm = res.data.ASTypeNm|| '';
            write.orderNo = res.data.OrderNo|| '';
            write.ExpClss = res.data.ExpClss|| '';
            write.EmpId = res.data.EmpId|| '';
            write.EmpNm = res.data.EmpNm|| '';
            write.DeptCd = res.data.DeptCd|| '';
            write.DeptNm = res.data.DeptNm|| '';
            write.SpecNo = res.data.SpecNo|| '';
            write.CustCd = res.data.CustCd|| '';
            write.CustNm = res.data.CustNm|| '';
            write.DrawNo = res.data.DrawNo|| '';
            write.DrawAmd = res.data.DrawAmd|| '';
            write.ASKind = res.data.ASKind|| '';//AS类型
            write.ASProcKind = res.data.ASProcKind|| '';//AS处理区分
            write.ProcResult = res.data.ProcResult|| '';//AS处理结果
            write.ASAmt = parseFloat(res.data.ASAmt || 0).toFixed(2);//所需配件费用
            write.ASRepairAmt = parseFloat(res.data.ASRepairAmt || 0).toFixed(2);//修理费
            write.ASAreaGubun = res.data.ASAreaGubun|| '';//服务地区区分
            write.ASArea = res.data.ASArea|| '';//服务地点
            write.ItemReturnGubun = res.data.ItemReturnGubun|| '';//部品返还区分
            write.ASNote = res.data.ASNote|| '' ;//AS处理详细
            write.ProcResultReason = res.data.ProcResultReason|| '';//AS处理结果原因
            write.CustOpinion = res.data.CustOpinion|| '';//客户意见
            write.Remark = res.data.Remark|| '';//备注
            write.ProcPerson = res.data.ProcPerson|| '';//经办人
            write.TransLine = res.data.TransLine|| '';//行驶里程
            write.ArrivalTime = res.data.ArrivalTime|| '';//抵达时间
            write.StartTime = res.data.StartTime|| '';//离开时间
            write.ItemReturnYn = res.data.ItemReturnYn|| 'N',//部品反回与否
            write.ChargeYn = res.data.ChargeYn|| 'N';//收费与否
            write.CfmYn = res.data.CfmYn|| 0;//确定
            write.ItemReturnYn == 'Y' ? multi.openSwitch('itemReturnYn') : multi.closeSwitch('itemReturnYn');
            write.ChargeYn == 'Y' ? multi.openSwitch('chargeYn') : multi.closeSwitch('chargeYn');
            if(write.CfmYn == 1){
                this.view.asHandleCfm = true;
                multi.openSwitch('cfmYn')
            }else{
                this.view.asHandleCfm = false;
                multi.closeSwitch('cfmYn');
            }
            this.getAsHandleItem();
        },
        getAsHandleItem:function(){
            http.get('/WEI_2100/getAsHandleItem',{asHandleNo:this.write.asHandle.ASNo},res => {
                if(res.returnCode == 0){
                    this.list.asHandle.itemList = res.data[0];
                }
            });
        },
        clearAsHandelInfo:function() {
            this.list.asHandle.itemList = [];
            this.write.asHandle = {
                ASNo: '',
                ASDate: multi.getNowDate(),
                ASRecvNo: '',
                ASType: '',
                ASTypeNm: '',
                orderNo: '',
                ExpClsss: '',
                EmpId: '',
                EmpNm: '',
                DeptCd: '',
                DeptNm: '',
                SpecNo: '',
                CustCd: '',
                CustNm: '',
                DrawNo: '',
                DrawAmd: '',
                ASKind: '',//AS类型
                ASProcKind: '',//AS处理区分
                ProcResult: '',//AS处理结果
                ASAmt: 0,//所需配件费用
                ASRepairAmt: 0,//修理费
                ASAreaGubun: '',//服务地区区分
                ASArea: '',//服务地点
                ItemReturnYn: 'N',//部品反回与否
                ItemReturnGubun: '',//部品返还区分
                ChargeYn: '',//收费与否
                CfmYn: 0,//确定
                ASNote: '',//AS处理详细
                ProcResultReason: '',//AS处理结果原因
                CustOpinion: '',//客户意见
                Remark: '',//备注
                ProcPerson: '',//经办人
                TransLine: '',//行驶里程
                ArrivalTime: '',//抵达时间
                StartTime: '',//离开时间
            };
        },
        setAsHandleInfo:function(){
            if(this.asProcCfmCheck() == false) return false;
            if(this.asProcWriteCheck() == false) return false;
            mui.showLoading();
            this.write.asHandle.itemList = this.list.asHandle.itemList;
            http.post('/WEI_2100/setAsHandleInfo',this.write.asHandle,res => {
                if(res.returnCode == 0){
                    this.getAsHandleInfo(res.data);
                    mui.alert(this.langCode.holdAsSuccess);
                }else{
                    mui.alert(this.langCode.saveErr);
                }
            });
        },
        setAsHandleItem:function(){
            if(this.asProcCfmCheck() == false) return false;
            this.view.showAsHandleItem = false;
            //.阻止强引用
            var jsonStr = JSON.stringify(this.write.asHandleItem);
            var itemInfo = JSON.parse(jsonStr);
            let upt = false;
            for(let i in  this.list.asHandle.itemList){
                if(this.list.asHandle.itemList[i].ASSerl == itemInfo.ASSerl){
                    this.list.asHandle.itemList[i] = itemInfo;
                    upt = true;
                    break;
                }
            }
            if(upt == false) this.list.asHandle.itemList.push(itemInfo);
        },
        delAsHandleItem:function(index,event){
            if(this.asProcCfmCheck() == false) return false;
            var elem =  event.target;
            var nextdom = event.target.parentNode.parentNode;
            elem.style.webkitTransform = 'translate(0,0)';
            nextdom.children[1].style.webkitTransform = 'translate(0,0)';
            this.list.asHandle.itemList.splice(index,1);
        },
        //.查看AS详细
        getRate:function(data){
            if(data.Status != 2 && data.Status != 1){
                mui.alert(this.langCode.asNoapply,title);
                return false;
            }
            this.asRate.InvoiceComplete = false;
            this.asRate.ProductComplete = false;
            this.showAsRate = true;
            mui.showLoading('loading','div');
            this.getAsOrderInfo(data.ASRecvNo);
            this.getProductInfo(data.ASRecvNo);
            this.getInvoiceInfo(data.ASRecvNo);
            this.asRate.DrawStatus = data.DrawStatus;
            this.asRate.SourceNo = data.ASRecvNo;//依据编号
            this.asRate.CustNm = data.CustNm;//客户名称
            this.asRate.ASRecvDate = data.ASRecvDate;
            this.asRate.DelvDate = data.ASDelvDate;//交货日期
            this.asRate.RefNo = data.RefNo;//模号
            this.asRate.EmpNm = data.EmpNm;//员工姓名
            this.asRate.DeptNm = data.DeptNm;//部门名称
            this.asRate.ProductStatus =data.ProductStatus;
            var interval = setInterval(function () {
                if(this.asRate.ProductComplete == true && this.asRate.InvoiceComplete == true){
                    mui.hideLoading();
                    var curStep = 1;
                    var steps = [this.langCode.asRecv,this.langCode.deviseAccept,this.langCode.deviseOutDraw,this.langCode.workIndicate,this.langCode.productEnd];
                    var stepCss = ['step-coord','step-coord','step-coord','step-coord','step-coord'];
                    var stepsM = [true,false,false,false,false];
                    if(this.asRate.DrawAptDate != '' && this.asRate.DrawAptDate != '--' && this.asRate.DrawStatus != 0 ){
                        curStep = 2;
                        stepsM[1] = true;
                    }
                    if(this.asRate.OutDate != ''  && this.asRate.OutDate != '--' && this.asRate.DrawStatus != 0 ) {
                        curStep = 3;
                        stepsM[2] = true;
                    }
                    if(this.asRate.WPlanCfmDate != '' && this.asRate.WPlanCfmDate != '--' ){
                        curStep = 4;进度
                        stepsM[3] = true;
                    }
                    if(this.asRate.ProductStatus == 3){
                        curStep = 5;
                        stepsM[4] = true;
                    }
                    //.从已经达成的最后一个步骤开始向前检查，如果存在无需达成步骤执行变色处理
                    for (var s = 1;s < curStep-1;s++){
                        if(stepsM[s] == false){
                            stepCss[s] = 'step-coord-none';
                            steps[s] = steps[s]+'('+this.langCode.none+')';
                        }
                    }
                    var step=new SetStep({
                        content:'.stepCont',
                        steps:steps,
                        stepsCss:stepCss,
                        stepCounts:5,
                        curStep:curStep,
                        clickAble:false,
                        showBtn:false
                    })
                    clearInterval(interval);
                }
            }.bind(this),300);
        },
        //获取AS订单信息
        getAsOrderInfo:function(asRecvNo){
            var param = {};
            param.asRecvNo = asRecvNo;
            // http.get('/WEI_2100/getAsOrderInfo',param,function (res) {
            //     if(res.returnCode == 0){
            //         this.asRate.OrderNo = res.data.OrderNo || '--';
            //         this.asRate.CustNm = res.data.custname || '--';
            //         this.asRate.OrderDate = res.data.OrderDate || '--';
            //         this.asRate.DelvDate = res.data.DelvDate || '--';
            //         this.asRate.OrderStatusNm = res.data.StatusNm || '--';
            //         this.asRate.RefNo = res.data.RefNo || '--';
            //         this.asRate.DeptNm = res.data.DeptNm;
            //         this.asRate.EmpNm = res.data.EmpNm;
            //     }
            // }.bind(this));
        },
        //获取生产信息
        getProductInfo:function(asRecvNo){
            var param = {};
            param.asRecvNo = asRecvNo;
            this.asRate.WkAptDate = '--';
            this.asRate.WPlanCfmDate = '--';
            this.asRate.WDelvDate = '--';
            this.asRate.ModifyCnt = '--';
            this.asRate.WDelvChUptDate = '00-00 00:00';
            this.asRate.DrawNo = '--';
            this.asRate.DrawAmd = '';
            this.asRate.DrawAptDate = '--';
            this.asRate.OutDate = '--';
            http.get('/WEI_2100/getAsProductInfo',param,function (res) {
                if(res.returnCode == 0){
                    this.asRate.WkAptDate = res.data.WkAptDate;
                    this.asRate.WPlanCfmDate = res.data.WPlanCfmDate || '--';
                    this.asRate.WDelvDate = res.data.WDelvDate;
                    this.asRate.ModifyCnt = res.data.ModifyCnt || '--';
                    this.asRate.WDelvChUptDate = this.$options.filters.dateHi(res.data.WDelvChUptDate) || '00-00 00:00';
                    if(this.asRate.DrawStatus != 0)this.asRate.DrawNo = res.data.DrawNo || '--';
                    if(this.asRate.DrawStatus != 0)this.asRate.DrawAmd = res.data.DrawAmd ;
                    if(this.asRate.DrawStatus != 0)this.asRate.DrawAptDate = res.data.AptDate;
                    if(this.asRate.DrawStatus != 0)this.asRate.OutDate = res.data.OutDate;
                }else{

                }
            }.bind(this),function(err) {

            }.bind(this),function(com){
                this.asRate.ProductComplete = true;
            }.bind(this));
        },
        //获取送货单信息
        getInvoiceInfo:function(asRecvNo){
            var param = {};
            param.sourceNo = asRecvNo;
            param.sourceType = '2';
            this.asRate.InvoiceNo = '--';
            this.asRate.InvoiceDate = '--';
            this.asRate.InvoiceType = '--';
            this.asRate.InvoiceTypeNm = '--';
            this.asRate.CfmYn = '--';
            this.asRate.CfmDate = '--';
            this.asRate.ColDate = '--';
            this.asRate.ColYn = 'N';
            http.get('/WEI_2100/getInvoiceInfo',param,function (res) {
                if(res.returnCode == 0){
                    this.asRate.InvoiceNo = res.data.InvoiceNo || '--';
                    this.asRate.InvoiceDate = this.$options.filters.date(res.data.InvoiceDate) || '--';
                    this.asRate.InvoiceType = res.data.InvoiceType;
                    this.asRate.InvoiceTypeNm = res.data.InvoiceTypeNm || '--';
                    this.asRate.CfmYn = res.data.CfmYn || '--';
                    this.asRate.CfmDate = res.data.CfmDate;
                    this.asRate.ColDate = res.data.ColDate || '--';
                    this.asRate.ColYn = res.data.ColYn || '--';
                }
            }.bind(this),function(err) {

            }.bind(this),function(com){
                this.asRate.InvoiceComplete = true;
            }.bind(this));
        },
    
        //按钮开关
        mui_switch:function(name){
            switch (name) {
                case 'trans':
                    if(this.ms_trans['mui-active'] == true){
                        this.ms_trans['mui-active'] = false;
                        this.transdom = true;
                    }
                    else
                    {
                        this.ms_trans['mui-active'] = true;
                        this.transdom = false;
                    }
                    break;
            }
            console.log(name);
        },
        query_group:function(){
            mui.showLoading('loading...',leon.global_title);
            var params = {};
            params.groupnm = this.input_groupfindname;
            params.groupid = this.input_groupfindid;
            http.get('/WEI_2100/group_prc',params,res => {
                this.grouplist = res.data[0];
            });
        },
        query_as_table:function(asId,check){
            var params = {};
            if(check == 'update'){
                params.asid = this.w_asid
            }
            params.asid = asId;
            // else if(check == 'refresh'){
            //     params.asid = e;
            // }
            // else
            // {
            //     params.asid = this.aslist[e].ASRecvNo;
            // }
            http.get('/WEI_2100/as_minute_table',params,res => {
                this.astablelist = res.data[0];
            })

        },
        query_as_photo:function(){
            var params = {};
            params.asid = this.w_asid;
            if(this.w_asid != ''){
                mui.showLoading();
                http.get('/WEI_2100/as_photo',params,res => {
                    if(res.returnCode == 'FTP'){
                        mui.alert('FTP服务器无法连接，无法获取图片',leon.global_title);
                        return false;
                    }
                    this.asphotolist = res.data[0];
                });
            }
        },
        query_as_sales:function(){
            var params = {};
            if(this.w_asid != ''){
                params.asid = this.w_asid;
                http.get('/WEI_2100/as_sales',params,res => {
                    this.assaleslist = res.data[0];
                });
            }
        },
        getOrderInfo:function(orderNo){
            this.clear_as();
            mui.showLoading();
            var params = {};
            params.orderid = orderNo;
            http.get('/WEI_2100/order_minute',params,res => {
                res = res.data;
                this.w_order_id            = res.OrderNo;
                this.w_spec_id             = res.SpecNo;
                this.w_cust_name           = res.custname;
                this.w_asplastic           = res.Resin;
                this.w_cust_id             = res.CustCd
                this.w_cust_produce_name   = res.cust_produce_name;
                this.w_model_id            = res.model_id;
                this.w_Gate_counts         = res.GateQty;
                this.w_markets             = res.MarketNm;
                this.w_markets_id          = res.MarketCd;
                this.w_drano               = res.DrawNo;
                this.w_dranm               = res.DrawAmd;
                this.w_export_distinction_id = res.ExpClss;
                this.w_ordergubun = 1;
                this.w_supplyscope = res.SupplyScopeNm;
                this.w_supplyscope_id = res.SupplyScope;
                this.w_hrs = res.HRSystemNm;
                this.w_hrs_id = res.HRSystem;
                this.w_manifoldtype = res.ManifoldTypeNm;
                this.w_manifoldtype_id = res.ManifoldType;
                this.w_systemsize = res.SystemSizeNm;
                this.w_systemsize_id = res.SystemSize;
                this.w_systemtype = res.SystemTypeNm;
                this.w_systemtype_id = res.SystemType;
                this.w_gatetype = res.GateTypeNm;
                this.w_gatetype_id = res.GateType;
                this.system_mini_class( res.SupplyScope,'supplyscope_c1');
                this.system_mini_class( res.HRSystem,'supplyscope_c2');
                this.system_mini_class( res.ManifoldType,'supplyscope_c3');
                this.system_mini_class( res.SystemSize,'supplyscope_c4');
                this.system_mini_class( res.SystemType,'supplyscope_c5');
                if(res.ExpClss == 1){
                    this.w_export_distinction = this.select_export_distinction[0].text;
                }
                else if(res.ExpClss == 4){
                    this.w_export_distinction = this.select_export_distinction[1].text;
                }
                var params = {};
                params.orderid = res.OrderNo;
                http.get('/WEI_2100/as_count',params,res => {
                    this.dis_as_count(res.data);
                });
                this.slide_panel_show = true;
                this.order_query_close('choose');
            });
        },

        refresh_as:function(asid){
            mui.showLoading('loading...',leon.global_title);
            var params = {};
            params.asid = asid
            http.get('/WEI_2100/as_minute',params,res =>{
                this.dis_as_minute(res.data);
            });
            this.query_as_table(asid,'refresh');
        },
        set_astable:function(e){
            this.w_astable_ASRecvSerl   = this.astablelist[e].ASRecvSerl;
            this.w_astable_Sort         = this.astablelist[e].Sort;
            this.w_astable_ChargeYn     = this.astablelist[e].ChargeYn;
            this.w_astable_ItemNo       = this.astablelist[e].ItemNo;
            this.w_astable_ItemNm       = this.astablelist[e].ItemNm;
            this.w_astable_ItemCd       = this.astablelist[e].ItemCd;
            this.w_astable_NextQty      = parseInt(this.astablelist[e].NextQty);
            this.w_astable_PreStockQty  = parseInt(this.astablelist[e].PreStockQty);
            this.w_astable_Remark       = this.astablelist[e].Remark;
            this.w_astable_SpareYn      = this.astablelist[e].SpareYn;
            this.w_astable_Spec         = this.astablelist[e].Spec;
            this.w_astable_Qty          = parseInt(this.astablelist[e].Qty);
            this.w_astable_StopQty      = parseInt(this.astablelist[e].StopQty);
            this.w_astable_UnitNm       = this.astablelist[e].UnitNm;
            this.w_astable_UnitId       = this.astablelist[e].UnitCd;
            this.astablelist[e].SpareYn == 'Y' ? this.mui_switch_active('mySwitch_table_spare',1) : this.mui_switch_active('mySwitch_table_spare',0);
            this.astablelist[e].ChargeYn == 'Y' ? this.mui_switch_active('mySwitch_table_char',1) : this.mui_switch_active('mySwitch_table_char',0);
        },
        //用户查询逻辑
        set_user:function(e){
            switch (this.whereisuser){
                case 0:
                    //.AS接受职员信息
                    this.w_asusernm  = this.userslist[e].EmpNm;
                    this.w_asuserid  = this.userslist[e].EmpID;
                    this.w_asgroupnm = this.userslist[e].DeptNm;
                    this.w_asgroupid = this.userslist[e].DeptCd;
                    break;
                case 1:
                    //.AS处理职员信息
                    this.write.EmpNm = this.userslist[e].EmpNm;
                    this.write.EmpId  = this.userslist[e].EmpID;
                    this.write.DeptNm = this.userslist[e].DeptNm;
                    this.write.DeptId = this.userslist[e].DeptCd;
                    break;
            }
        },
        set_group:function(e){
            this.w_transgroup = this.grouplist[e].DeptNm;
            this.w_transgroup_id = this.grouplist[e].DeptCd;
            this.group_query_close();
        },
        //----------display------------
        //渲染用户列表
        dis_as_count:function(list){
            this.w_order_cnt = list.ascount;
            // mui.hideLoading()
        },
        //渲染当前技术规范信息
        dis_spec_minute:function(res){
            this.w_spec_id = res.SpecNo;
            this.w_spec_type = res.SpecType;
            this.w_Gate_counts = res.GateQty;
            this.w_model_id = res.RefNo;
            this.w_drano = res.DrawNo;
            this.w_dranm = res.DrawAmd;
            this.w_cust_name = res.CustNm;
            this.w_cust_id = res.CustCd;
            this.w_cust_produce_name = res.PartDesc;
            this.w_supplyscope = res.SupplyScopeNm;
            this.w_supplyscope_id = res.SupplyScope;
            this.w_hrs = res.HRSystemNm;
            this.w_hrs_id = res.HRSystem;
            this.w_manifoldtype = res.ManifoldTypeNm;
            this.w_manifoldtype_id = res.ManifoldType;
            this.w_systemsize = res.SystemSizeNm;
            this.w_systemsize_id = res.SystemSize;
            this.w_systemtype = res.SystemTypeNm;
            this.w_systemtype_id = res.SystemType;
            this.w_gatetype = res.GateTypeNm;
            this.w_gatetype_id = res.GateType;
            if(res.ExpClss == 1){
                this.w_export_distinction = this.select_export_distinction[0].text;
                this.w_export_distinction_id = this.select_export_distinction[0].value;
            }
            else
            {
                this.w_export_distinction = this.select_export_distinction[1].text;
                this.w_export_distinction_id = this.select_export_distinction[1].value;
            }
            this.system_mini_class( res.SupplyScope,'supplyscope_c1');
            this.system_mini_class( res.HRSystem,'supplyscope_c2');
            this.system_mini_class( res.ManifoldType,'supplyscope_c3');
            this.system_mini_class( res.SystemSize,'supplyscope_c4');
            this.system_mini_class( res.SystemType,'supplyscope_c5');
            mui.hideLoading()

        },
        //渲染当前as信息
        dis_as_minute:function(res){
            console.log(res);
            this.w_order_id              = res.OrderNo;
            this.w_spec_id               = res.SpecNo;
            this.w_spec_type             = res.SpecType;
            this.w_order_cnt             = res.OrderCnt;
            this.w_cust_name             = res.CustNm;
            this.w_ordergubun            = res.OrderGubun;
            this.w_cust_id               = res.CustCd;
            this.w_cust_produce_name     = res.GoodNm;
            this.w_model_id              = res.RefNo;
            this.w_Gate_counts           = res.GateQty;
            this.w_markets               = res.MarketCdNm;
            this.w_markets_id            = res.MarketCd;
            this.w_drano                 = res.OldDrawNo;
            this.w_dranm                 = res.OldDrawAmd;
            this.w_asid                  = res.ASRecvNo;
            this.w_asclass               = res.AStypeNm;
            this.w_asclass_id            = res.AStype;
            this.w_asgetdate             = res.ASRecvDate.substr(0,10);
            this.w_assetdate             = res.ASDelvDate.substr(0,10);
            this.w_asusernm              = res.EmpNm;
            this.w_asuserid              = res.EmpId;
            this.w_asgroupnm             = res.DeptNm;
            this.w_asgroupid             = res.DeptCd;
            this.w_custprsn              = res.CustPrsn;
            this.w_custtell              = res.CustTell;
            this.w_custemail             = res.CustEmail;
            this.w_asdrawid              = res.DrawNo;
            this.w_asdrawnm              = res.DrawAmd;
            this.w_asplastic             = res.Resin;
            this.w_ascause               = res.OCCpointNm;
            this.w_ascause_id            = res.OCCpoint;
            this.w_asbadtype             = res.ASBadTypeNm;
            this.w_asbadtype_id          = res.ASBadType;
            this.w_asallclass            = res.ASCauseDonorNm;
            this.w_asallclass_id         = res.ASCauseDonor;
            this.w_asdutyclass           = res.DutyGubunNm;
            this.w_asdutyclass_id        = res.DutyGubun;
            this.w_asappearance          = res.ASClass1Nm;
            this.w_asappearance_id       = res.ASClass1
            this.w_asreasonclass         = res.ASClass2Nm;
            this.w_asreasonclass_id      = res.ASClass2;
            this.w_asserviceclass        = res.ASAreaGubunNm;
            this.w_asserviceclass_id     = res.ASAreaGubun;
            this.w_asservicearea         = res.ASArea;
            this.w_transgroup            = res.TransDeptNm;
            this.w_transgroup_id         = res.TransDeptCd;
            this.w_supplyscope           = res.SupplyScopeNm;
            this.w_hrs                   = res.HRSystemNm;
            this.w_manifoldtype          = res.ManifoldTypeNm;
            this.w_systemsize            = res.SystemSizeNm;
            this.w_systemtype            = res.SystemTypeNm;
            this.w_gatetype              = res.GateTypeNm;
            this.w_supplyscope_id        = res.SupplyScope;
            this.w_hrs_id                = res.HRSystem;
            this.w_manifoldtype_id       = res.ManifoldType;
            this.w_systemsize_id         = res.SystemSize;
            this.w_systemtype_id         = res.SystemType;
            this.w_gatetype_id           = res.GateType;
            this.w_text1                 = res.ASStateRemark;
            this.w_text2                 = res.ASCauseRemark;
            this.w_text3                 = res.ASSolve;
            this.w_text4                 = res.Remark;
            res.TransYn         == 'Y' ? this.mui_switch_active('mySwitch_trans',1) : this.mui_switch_active('mySwitch_trans',0);
            res.TransYn         == 'Y' ? this.transdom = true :  this.transdom = false;
            res.CfmYn           ==  1  ? this.mui_switch_active('mySwitch_confirm',1) : this.mui_switch_active('mySwitch_confirm',0);
            res.ChargeYn        == 'Y' ? this.mui_switch_active('mySwitch_chargeYn',1) : this.mui_switch_active('mySwitch_chargeYn',0);
            res.ItemReturnYn    == 'Y' ? this.mui_switch_active('mySwitch_itemReturn',1) : this.mui_switch_active('mySwitch_itemReturn',0);
            this.s_trans                 = res.TransYn;
            this.s_confirm               = res.CfmYn;
            this.s_apt                   = res.AptYn;
            this.s_charge                = res.ChargeYn;
            this.s_itemreturn            = res.ItemReturnYn;
            this.s_product               = res.ProductYn;
            switch(res.Status){
                case '0':
                    this.w_status = leon.langCode.apply;
                    break;
                case '1':
                    this.w_status = leon.langCode.handle;
                    break;
                case '2':
                    this.w_status = leon.langCode.accept;
                    break;
                case 'A':
                    leon.isConfirm();
                    this.w_status = leon.langCode.isAdjudication;
                    break;
            }
            if(res.ExpClss == 1){
                this.w_export_distinction = this.select_export_distinction[0].text;
                this.w_export_distinction_id = this.select_export_distinction[0].value;
            }
            else
            {
                this.w_export_distinction = this.select_export_distinction[1].text;
                this.w_export_distinction_id = this.select_export_distinction[1].value;
            }
            this.system_mini_class( res.ASCauseDonor,'ascause_c');
            this.system_mini_class( res.ASClass1,'asclass1_c');
            this.system_mini_class( res.SupplyScope,'supplyscope_c1');
            this.system_mini_class( res.HRSystem,'supplyscope_c2');
            this.system_mini_class( res.ManifoldType,'supplyscope_c3');
            this.system_mini_class( res.SystemSize,'supplyscope_c4');
            this.system_mini_class( res.SystemType,'supplyscope_c5');
            this.as_query_close('choose');
            mui.hideLoading()
        },
        dis_asphotolist:function(list){
            this.asphotolist = list;
        },
        dis_assaleslist:function(list){
            this.assaleslist = list;
        },
        //----------clear--------------
        clear_as:function(){
            this.noConfirm();
            var nowdata = multi.getNowDate()
            this.w_asgetdate                 = nowdata;
            this.w_ordergubun                =''
            this.w_spec_id                   ='';
            this.w_spec_type                 ='';
            this.w_orderclass                ='';
            this.w_order_id                  ='';
            this.w_order_cnt                 =0;
            this.w_cust_name                 ='';
            this.w_cust_id                   ='';
            this.w_cust_produce_name         ='';
            this.w_export_distinction        ='';
            this.w_export_distinction_id     ='';
            this.w_model_id                  ='';
            this.w_Gate_counts               ='';
            this.w_markets                   ='';
            this.w_markets_id                ='';
            this.w_drano                     ='';
            this.w_dranm                     ='';
            this.w_asid                      ='';
            this.w_asclass                   ='';
            this.w_asclass_id                ='';
            this.w_assetdate                 = nowdata;
            this.w_asusernm                  ='';
            this.w_asuserid                  ='';
            this.w_asgroupnm                 ='';
            this.w_asgroupid                 ='';
            this.w_status                    = leon.langCode.apply;
            this.w_custprsn                  ='';
            this.w_custtell                  ='';
            this.w_custemail                 ='';
            this.w_asdrawid                  ='';
            this.w_asdrawnm                  ='';
            this.w_asplastic                 ='';
            this.w_ascause                   ='';
            this.w_ascause_id                ='';
            this.w_asbadtype                 ='';
            this.w_asbadtype_id              ='';
            this.w_asallclass                ='';
            this.w_asallclass_id             ='';
            this. w_asdutyclass              ='';
            this.w_asdutyclass_id            ='';
            this.w_asappearance              ='';
            this.w_asappearance_id           ='';
            this.w_asreasonclass             ='';
            this.w_asreasonclass_id          ='';
            this.w_asaccept                  ='';
            this.w_asserviceclass            ='';
            this.w_asserviceclass_id         ='';
            this.w_asservicearea             ='';
            this.w_aschargeclass             ='';
            this.w_transgroup                ='';
            this.w_transgroup_id             ='';
            //SYSTEM
            this.w_supplyscope               ='';
            this.w_supplyscope_id            ='';
            this.w_hrs                       ='';
            this.w_hrs_id                    ='';
            this.w_manifoldtype              ='';
            this.w_manifoldtype_id           ='';
            this.w_systemsize                ='';
            this.w_systemsize_id             ='';
            this.w_systemtype                ='';
            this.w_systemtype_id             ='';
            this.w_gatetype                  ='';
            this.w_gatetype_id               ='';
            //SWITCH
            this.s_trans                     = 'N';
            this.s_confirm                   =  0;
            this.s_apt                       =  0;
            this.s_charge                    = 'N';
            this.s_itemreturn                = 'N';
            this.s_product                   = 'N';
            //TEXT
            this.w_text1                     ='';
            this.w_text2                     ='';
            this.w_text3                     ='';
            this.w_text4                     ='';

            this.assales_checkbox            =[];
            this.astablelist                 =[];
            this.asphotolist                 =[];
            this.assaleslist                 =[];
            jq(".mui-switch-handle").attr("style","");
            jq('#mySwitch_trans').removeClass('mui-active');
            jq('#mySwitch_confirm').removeClass('mui-active');
            jq('#mySwitch_itemReturn').removeClass('mui-active');
            jq('#mySwitch_chargeYn').removeClass('mui-active');
            this.login_user();
        },
        getLoginInfo:function(){
            var params = {};
            http.get('/WEI_2100/login_user',params,res => {
                this.loginUserNm = res.data.username;
                this.loginUserId = res.data.userid;
                this.loginGroupId = res.data.groupid;
                this.loginGroupNm = res.data.groupname;
                this.loginUser = res.data.username;
                this.loginId  =  res.data.userid;
            });
        },
        clear_astable:function(){
            if(this.astablelist.length <= 0){
                var sort = '10';
            }
            else {
                var sort = (10 + parseInt(this.astablelist[this.astablelist.length-1].Sort)).toString();
            }
            this.w_astable_Sort         = '0'+ sort;
            this.w_astable_ASRecvSerl   = ''
            this.w_astable_ChargeYn     = 'N'
            this.w_astable_ItemNo       = ''
            this.w_astable_ItemNm       = ''
            this.w_astable_NextQty      = '0'
            this.w_astable_PreStockQty  = ''
            this.w_astable_Remark       = ''
            this.w_astable_SpareYn      = 'N'
            this.w_astable_Spec         = ''
            this.w_astable_Qty          = ''
            this.w_astable_StopQty      = '0'
            this.w_astable_UnitNm       = ''
            this.w_astable_UnitId       = ''
            this.mui_switch_active('mySwitch_table_char',0);
            this.mui_switch_active('mySwitch_table_spare',0);
        },
        pushCheck:function(){
            if(this.w_status == leon.langCode.isAdjudication){
                mui.alert('OA审核中，无法修改内容',leon.global_title);
                return false;
            }
            if(this.s_confirm == 1){
                mui.alert(leon.langCode.isConfirm,leon.global_title);
                return false;
            }
        },
        //----------save---------------
        save_as:function(){
            if(this.pushCheck() == false) return false;
            if(this.w_ordergubun == 1){
                if(this.w_order_id == ''){
                    mui.alert(leon.langCode.noOrderId,leon.global_title);
                    return false;
                }
            }
            if(this.w_asclass_id == '' || this.w_asclass_id == 'undefined'){
                mui.alert(leon.langCode.chooseAsClass,leon.global_title);
                return false;
            }
            //如果是客户现场同时为旧ERP
            if(this.w_asclass_id == 'AS10020030' && this.w_ordergubun == 2){
                //AS客户现场
                if(this.check_as2() == false){
                    return false;
                }
            }
            else
            {
                //其他AS区分
                if(this.check_as1() == false){
                    return false;
                }
            }

            var params = {};
            //订单
            params.specid         = this.w_spec_id;
            params.spectype       = this.w_spec_type;
            params.custprsn       = this.w_custprsn;
            params.custtell       = this.w_custtell;
            params.custemail      = this.w_custemail;
            params.ordercnt       = this.w_order_cnt;
            params.olddrawno      = this.w_drano;
            params.olddrawamd     = this.w_dranm;
            params.exclass        = this.w_export_distinction_id;
            params.modelid        = this.w_model_id;
            params.gateno         = this.w_Gate_counts;
            params.goodnm         = this.w_cust_produce_name;
            params.ordergubun     = this.w_ordergubun;
            //AS
            params.markets        = this.w_markets_id;
            params.custid         = this.w_cust_id;
            params.asclass        = this.w_asclass_id;
            params.asgetdate      = this.w_asgetdate;
            params.assetdate      = this.w_assetdate;
            params.asuserid       = this.w_asuserid;
            params.asgroupid      = this.w_asgroupid;
            params.asplastic      = this.w_asplastic;        //塑胶
            params.ascause        = this.w_ascause_id;       //发生起点
            params.asbadtype      = this.w_asbadtype_id;     //不良类型
            params.asallclass     = this.w_asallclass_id;    //原因区分
            params.asdutyclass    = this.w_asdutyclass_id;   //AS责任区分
            params.asappearance   = this.w_asappearance_id;  //AS现象
            params.asreasonclass  = this.w_asreasonclass_id; //AS原因-种类
            params.asserviceclass = this.w_asserviceclass_id;//服务地区区分
            params.asservicearea  = this.w_asservicearea;    //服务地点
            //system
            params.supplyscope    = this.w_supplyscope_id;
            params.hrs            = this.w_hrs_id;
            params.manifoldtype   = this.w_manifoldtype_id;
            params.systemsize     = this.w_systemsize_id;
            params.systemtype     = this.w_systemtype_id;
            params.gatetype       = this.w_gatetype_id;
            //switch
            params.trans          = this.s_trans;
            params.transDeptCd    = this.w_transgroup_id;
            params.confirm        = this.s_confirm;
            // params.apt            = this.s_apt;
            params.charge         = this.s_charge;
            params.itemreturn     = this.s_itemreturn;
            // params.product        = this.s_product;
            //text
            params.text1          = this.w_text1;
            params.text2          = this.w_text2;
            params.text3          = this.w_text3;
            params.text4          = this.w_text4;
            this.w_ordergubun == 2 ? params.orderno = 'noorder' : params.orderno = this.w_order_id;
            this.w_asid == '' ? params.asid = 'noid' :  params.asid = this.w_asid;
            mui.confirm(leon.langCode.holdAsReady,leon.global_title, ['YES','NO'], function(eq) {
                if (eq.index == 0) {
                    http.post('/WEI_2100/save_as',params,res => {
                        if (res.returnCode == 'Y001') {
                            leon.refresh_as(res.data);
                            mui.alert(leon.langCode.holdAsSuccess, leon.global_title);
                        }
                        else if (res.returnCode == 'Y003') {
                            leon.refresh_as(res.data);
                            mui.alert(leon.langCode.asUpdateSuccess, leon.global_title);
                        }
                    });
                }
            });
        },
        save_photo:function(){
            if(this.w_asid == ''){
                mui.alert(leon.langCode.noHoldAs,leon.global_title);
                return false;
            }
            if(this.pushCheck() == false) return false;
            // if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
            //     jq("#asphoto_upload").trigger("click");
            // }
            jq("#asphoto_upload").trigger("click");

        },
        save_astable:function(){
            if(this.w_asid == ''){
                mui.alert(leon.langCode.noHoldAs,this.global_title);
                return false;
            }
            if(this.pushCheck() == false) return false;
            if(this.w_astable_ItemCd == ''){
                mui.alert(leon.langCode.chooseItem,this.global_title);
                return false;
            }
            if(this.w_astable_Qty == ''){
                mui.alert(leon.langCode.chooseNumber,this.global_title);
                return false;
            }
            mui.showLoading('loading...',leon.global_title);
            var params = {};
            params.asid = this.w_asid;
            params.ASRecvSerl  = this.w_astable_ASRecvSerl;
            params.Sort        = this.w_astable_Sort;
            params.ChargeYn    = this.w_astable_ChargeYn
            params.ItemCd      = this.w_astable_ItemCd
            params.NextQty     = this.w_astable_NextQty
            params.PreStockQty = this.w_astable_PreStockQty
            params.Remark      = this.w_astable_Remark
            params.SpareYn     = this.w_astable_SpareYn
            params.Spec        = this.w_astable_Spec
            params.Qty         = this.w_astable_Qty
            params.StopQty     = this.w_astable_StopQty
            params.UnitCd      = this.w_astable_UnitId
            http.post('/WEI_2100/save_astable',params,res => {
                this.query_as_table(1, 'update');
                this.astable_minute_close();
            });
        },
        uploadPic:function(){
            if(this.w_asid == ''){
                mui.alert(leon.langCode.noHoldAs,leon.global_title);
                return false;
            }
            if(this.pushCheck() == false) return false;
            mui.showLoading('loading...',leon.global_title);
            var inputFile = document.getElementById('asphoto_upload').files;
            if(inputFile.length <= 0){
                mui.alert('没有选择照片',leon.global_title);
                mui.hideLoading();
                return false
            }
            if(inputFile.length > 5){
                mui.alert(leon.langCode.mustLessFivePhotos,leon.global_title);
                mui.hideLoading();
                return false
            }
            var fileList = [];
            for(var i = 0; i < inputFile.length;i++){
                multi.compressImg(inputFile[i],fileList);
            }
            setTimeout(function () {
                var params = {};
                params.asId = leon.w_asid;
                params.imageList = fileList;
                if(leon.asphotolist.length > 0){
                    var historyPhotoCnt = leon.asphotolist[(leon.asphotolist).length-1].Seq;
                }else{
                    var historyPhotoCnt = 0
                }
                http.post('/WEI_2100/WEI_2100/upload_photo',params,function (res) {
                    if (res.returnCode == 0) {
                        leon.query_as_photo();
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
                        //     leon.asphotolist.push(img);
                        // }
                    }
                });
            },1000);
        },
        //----------delete-------------
        del_astable:function(e,event){
            if(this.pushCheck() == false) return false;
            var elem =  event.target;
            var nextdom = event.target.parentNode.parentNode;
            var params = {};
            params.asid = this.w_asid;
            params.ASRecvSerl = this.astablelist[e].ASRecvSerl
            mui.confirm(leon.langCode.deleteReady,leon.global_title, ['YES','NO'], function(eq) {
                if (eq.index == 0) {
                    elem.style.webkitTransform = 'translate(0,0)';
                    console.log(nextdom.children[1])
                    nextdom.children[1].style.webkitTransform = 'translate(0,0)';
                    http.post('/WEI_2100/del_astable',params,res => {
                        leon.query_as_table(1, 'update');
                    });
                }
            });
        },
        del_photo:function(e,event){
            if(this.pushCheck() == false) return false;
            var elem =  event.target;
            var nextdom = event.target.parentNode.parentNode;
            var params = new Object();
            params.asid = this.w_asid;
            params.Seq =  this.asphotolist[e].Seq;
            params.fileNm = this.asphotolist[e].FileNm;
            mui.confirm(leon.langCode.deleteReady,leon.global_title, ['YES','NO'], function(eq) {
                if (eq.index == 0) {
                    elem.style.webkitTransform = 'translate(0,0)';
                    nextdom.children[1].style.webkitTransform = 'translate(0,0)';
                    http.post('/WEI_2100/del_photo',params,res => {
                        leon.query_as_photo();
                    });
                }
            });
        },
        del_sales:function(e,event){
            if(this.pushCheck() == false) return false;
            var elem =  event.target;
            var nextdom = event.target.parentNode.parentNode;
            var params = {};
            params.asid = this.w_asid;
            params.Seq =  this.assaleslist[e].Seq;
            mui.confirm(leon.langCode.deleteReady,leon.global_title, ['YES','NO'], function(eq) {
                if (eq.index == 0) {
                    elem.style.webkitTransform = 'translate(0,0)';
                    nextdom.children[1].style.webkitTransform = 'translate(0,0)';
                    http.post('/WEI_2100/del_sales',params,res => {
                        leon.query_as_sales();
                    });
                }
            });
        },
        //.年月日时分秒
        getDateM:function(vue,struct,struct1){
            var struct = struct || '';
            var struct1 = struct1 || '';
            if(this.asProcCfmCheck() == false) return false;
            multi.searchDate('datetime',function (e) {
                if(struct == '' && struct1 == ''){
                    this[vue] = e.text+':00';
                }else if(struct != '' && struct1 == ''){
                    this[struct][vue] = e.text+':00';
                }else if(struct != '' && struct1 != ''){
                    this[struct][struct1][vue] = e.text+':00';
                }
            }.bind(this))
        },
        //.年月日
        getDate:function(vue,struct,struct1){
            var struct = struct || '';
            var struct1 = struct1 || '';
            if(struct == 'write'){
                if(this.asProcCfmCheck() == false) return false;
            }
            multi.searchDate('date',function (e) {
                if(struct == '' && struct1 == ''){
                    this[vue] = e.text;
                }else if(struct != '' && struct1 == ''){
                    this[struct][vue] = e.text
                }else if(struct != '' && struct1 != ''){
                    this[struct][struct1][vue] = e.text;
                }
            }.bind(this))
        },
        asProcCheck:function(){
            if(this.write.asHandle.ASNo == ''){
                mui.alert(this.langCode.mustSetAsProc,title);
                return false;
            }
            return true;
        },
        asProcCfmCheck:function(){
            if(this.view.asHandleCfm == true){
                mui.alert(this.langCode.asProcCfm,title);
                return false;
            }
            return true;
        },
        asProcWriteCheck:function(){
            console.log(this.write.asHandle.ASKind);
            if(this.write.asHandle.ASDate == ''){
                mui.alert(this.langCode.mustASDate);
                return false;
            }else if(this.write.asHandle.ASRecvNo == ''){
                mui.alert(this.langCode.mustASRecvNo);
                return false;
            }else if(this.write.asHandle.EmpNm == ''){
                mui.alert(this.langCode.mustEmpNm);
                return false;
            }else if(this.write.asHandle.CustNm == ''){
                mui.alert(this.langCode.mustCustNm);
                return false;
            }else if(this.write.asHandle.ASKind == ''){
                mui.alert(this.langCode.mustASKind);
                return false;
            }else if(this.write.asHandle.ASProcKind == ''){
                mui.alert(this.langCode.mustASProcKind);
                return false;
            }else if(this.write.asHandle.ProcResult == ''){
                mui.alert(this.langCode.mustProcResult);
                return false;
            }else if(this.write.asHandle.ASAreaGubun == ''){
                mui.alert(this.langCode.mustASAreaGubun);
                return false;
            }else if(this.write.asHandle.ItemReturnGubun == ''){
                mui.alert(this.langCode.mustItemReturnGubun);
                return false;
            }
            return true;
        },
        asHandleConfirm:function(check){
            if(this.asProcCheck() == false) return false;
            var param = {};
            param.workingTag = check;
            param.asHandleNo = this.write.asHandle.ASNo;
            http.post('/WEI_2100/asHandleCfm',param,res => {
                if(res.returnClass == 'OM00000023'){ //确定成功
                    multi.openSwitch('cfmYn');
                    this.write.asHandle.CfmYn = 1;
                    this.view.asHandleCfm = true;
                }else if(res.returnClass == 'OM00000030'){ //取消成功
                    multi.closeSwitch('cfmYn');
                    this.write.asHandle.CfmYn = 0;
                    this.view.asHandleCfm = false;
                }else{
                    if(this.write.asHandle.CfmYn == 0){
                        multi.closeSwitch('cfmYn');
                    }else{
                        multi.openSwitch('cfmYn');
                    }
                }
            });
        },
        asHandleSwitchinit:function() {
            mui('.mui-switch').switch();
            document.getElementById("cfmYn").addEventListener("toggle", function (event) {
                if (event.detail.isActive) {
                    if (this.asHandleConfirm('CA') == false) multi.closeSwitch('cfmYn');
                } else {
                    if (this.asHandleConfirm('CD') == false) multi.openSwitch('cfmYn');
                }
            }.bind(this));
            document.getElementById("chargeYn").addEventListener("toggle", function (event) {
                if (event.detail.isActive) {
                    if(this.asProcCfmCheck() == false){
                        multi.closeSwitch('chargeYn');
                        return false
                    }
                    this.write.asHandle.ChargeYn = 'Y';
                } else {
                    if(this.asProcCfmCheck() == false){
                        multi.openSwitch('chargeYn');
                        return false
                    }
                    this.write.asHandle.ChargeYn = 'N';
                }
            }.bind(this));
            document.getElementById("itemReturnYn").addEventListener("toggle", function (event) {
                if (event.detail.isActive) {
                    if(this.asProcCfmCheck() == false){
                        multi.closeSwitch('itemReturnYn');
                        return false
                    }
                    this.write.asHandle.ItemReturnYn = 'Y';
                }else{
                    if(this.asProcCfmCheck() == false){
                        multi.openSwitch('itemReturnYn');
                        return false
                    }
                    this.write.asHandle.ItemReturnYn = 'N';
                }
            }.bind(this));
        },
        asHandleItemSwitchinit:function() {
            mui('.mui-switch').switch();
            document.getElementById("itemChargeYn").addEventListener("toggle", function (event) {
                if (event.detail.isActive) {
                    if(this.asProcCfmCheck() == false){
                        multi.closeSwitch('itemChargeYn');
                        return false
                    }
                    this.write.asHandleItem.ChargeYn = 'Y';
                } else {
                    if(this.asProcCfmCheck() == false){
                        multi.openSwitch('itemChargeYn');
                        return false
                    }
                    this.write.asHandleItem.ChargeYn = 'N';
                }
            }.bind(this));
            document.getElementById("itemUseYn").addEventListener("toggle", function (event) {
                if (event.detail.isActive) {
                    if(this.asProcCfmCheck() == false){
                        multi.closeSwitch('itemUseYn');
                        return false
                    }
                    this.write.asHandleItem.ReUseYn = 'Y';
                }else{
                    if(this.asProcCfmCheck() == false){
                        multi.openSwitch('itemUseYn');
                        return false
                    }
                    this.write.asHandleItem.ReUseYn= 'N';
                }
            }.bind(this));
        },
        //---------orther---------------
        qr_order:function(){
            this.global_qrclass = 'order';
            this.qr_code();
        },
        qr_as:function(){
            this.global_qrclass = 'as';
            this.qr_code();
        },
        qr_code:function(){
            if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
                // location.href = 'jmobile://getQRcode';
                try{
                    webkit.messageHandlers.jmobile.postMessage({fn: "getQRcode"});
                }catch (e) {}
            }
            if(JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.Android)
            {
                if(window.JMobile) window.JMobile.getQRcode();
            }
        },
        //.提交OA审批
        subAdjudication:function(){
            this.hideExtend();
            if(this.w_asid == ''){
                mui.alert(leon.langCode.noHoldAs,this.global_title);
                return false;
            }
            if(this.s_confirm == 1){
                mui.alert(leon.langCode.isConfirm,leon.global_title);
                return false;
            }
            var params = {};
            params.asid = this.w_asid;
            params.asUserId = this.w_asuserid;
            http.post('/WEI_2100/subAdjudication',params,res => {
                if(res.returnCode == 'I451'){
                    mui.alert(leon.langCode.recordIsExisted,leon.global_title);
                } else if(res.returnCode == '0'){
                    mui.alert(leon.langCode.uploadSuccess,leon.global_title);
                    leon.refresh_as(res.data);
                    var params = {};
                    params.asid = leon.w_asid;
                    leon.post('/WEI_2100/as_sendSmsToUser',params,res1 => {
                        if(res.returnCode == 'I850'){
                            console.log('AS并未超过2次');
                        }
                    });
                }
            });
        },
        //.取消OA审批
        unSubAdjudication:function(){
            this.hideExtend();
            if(this.w_asid == ''){
                mui.alert(leon.langCode.noHoldAs);
                return false;
            }
            if(this.s_confirm == 1){
                mui.alert(leon.langCode.isConfirm);
                return false;
            }
            var params = {};
            params.asid = this.w_asid;
            http.post('/WEI_2100/unSubAdjudication',params,res => {
                if(res.returnCode == 'I452'){
                    mui.alert(leon.langCode.recordIsDoing,);
                } else if(res.returnCode == 'I450'){
                    mui.alert(leon.langCode.recordIsNot);
                } else if(res.returnCode == '0'){
                    mui.alert(leon.langCode.cancelSuccess);
                }
            });

        },
        confirm:function(workType){
            var params = {};
            params.cfm = workType;
            params.as_id = this.w_asid;
            http.post('/WEI_2100/confirm',params,res => {
                //操作失败
                if (res.returnCode.replace(' ', '') !== 'OK') {
                    jq(".mui-switch-handle").attr("style", "");
                    //当按下确定时
                    if (res.returnClass == 'OM00000024') {
                        //还原为未确定状态
                        jq('#mySwitch_confirm').removeClass('mui-active');
                    }
                    //当取消确定时
                    else {
                        //还原为确定状态
                        jq('#mySwitch_confirm').addClass('mui-active');
                    }
                }
                else {
                    if (res.returnClass.replace(' ', '') == 'OM00000023') {
                        leon.s_confirm = 1;
                        leon.isConfirm();
                    }
                    if (res.returnClass.replace(' ', '') == 'OM00000030') {
                        leon.s_confirm = 0;
                        leon.noConfirm();
                    }
                }
                mui.alert(res.data);
                leon.refresh_as(leon.w_asid);
            });
        },
        isConfirm:function(){
            this.r_custprsn = true;
            this.r_custtell = true;
            this.r_custemail = true;
            this.r_asserviceclass = true;
            this.r_cust_produce_name = true;
            this.r_asplastic = true;
            this.r_text1 = true;
            this.r_text2 = true;
            this.r_text3 = true;
            this.r_text4 = true;
        },
        noConfirm:function(){
            this.r_custprsn = false;
            this.r_custtell = false;
            this.r_custemail = false;
            this.r_asserviceclass =false;
            this.r_cust_produce_name = false;
            this.r_asplastic = false;
            this.r_text1 = false;
            this.r_text2 = false;
            this.r_text3 = false;
            this.r_text4 = false;
        },
        //.订单区分选择触发
        orderclassChange:function(){
            if(this.pushCheck() == false) return false;
            if(this.w_ordergubun == 2){
                this.area_notnull('苏州',2);
                this.must_order_id['th-red'] = false;
                //旧订单
                this.w_order_id = '';
                this.w_export_distinction = '';
                this.w_export_distinction_id = '';
                this.w_cust_id
                this.w_drano = '';
                this.w_dranm = '';
            } else {
                //新订单
                this.must_order_id['th-red'] = true;
                this.area_notnull('苏州',0);
            }

        },
        //.AS区分选择触发
        asclassChange:function(e){
            if(this.pushCheck() == false) return false;
            if(this.w_ordergubun == 2){
                var e = 0;
                switch (this.w_asclass_id) {
                    case 'AS10020010':
                        e = 0;
                        break;
                    case 'AS10020020':
                        e = 1;
                        break;
                    case 'AS10020030':
                        e = 2;
                        break;
                    case 'AS10020040':
                        e = 3;
                        break;
                }
                //设置必填项标识
                this.area_notnull('苏州',e);
            }
        },
        //.原因区分选择触发
        causeDistinctionChange:function(){
            if(this.pushCheck() == false) return false;
            this.w_asdutyclass = '';
            this.w_asdutyclass_id = '';
            this.select_ascause_c = [];
            this.system_mini_class(this.w_asallclass_id, 'ascause_c');
        },
        //.AS现象选择触发
        asAppearanceChange:function(){
            if(this.pushCheck() == false) return false;
            this.w_asreasonclass = '';
            this.w_asreasonclass_id = '';
            this.select_asclass1_c = [];
            this.system_mini_class(this.w_asappearance_id, 'asclass1_c');
        },
        //.supplyscope选择触发
        supplyscopeChange:function(){
            if(this.pushCheck() == false) return false;
            this.w_hrs = '';
            this.w_manifoldtype = '';
            this.w_systemsize = '';
            this.w_systemtype = '';
            this.w_gatetype = '';
            this.w_hrs_id = '';
            this.w_manifoldtype_id = '';
            this.w_systemsize_id = '';
            this.w_systemtype_id = '';
            this.w_gatetype_id = '';
            this.select_supplyscope_c1 = [];
            this.select_supplyscope_c2 = [];
            this.select_supplyscope_c3 = [];
            this.select_supplyscope_c4 = [];
            this.select_supplyscope_c5 = [];
            this.system_mini_class(this.w_supplyscope_id, 'supplyscope_c1');
        },
        //.hrs选择触发
        hrsChange:function(){
            if(this.pushCheck() == false) return false;
            this.w_manifoldtype = '';
            this.w_systemsize = '';
            this.w_systemtype = '';
            this.w_gatetype = '';
            this.w_manifoldtype_id = '';
            this.w_systemsize_id = '';
            this.w_systemtype_id = '';
            this.w_gatetype_id = '';
            this.select_supplyscope_c2 = [];
            this.select_supplyscope_c3 = [];
            this.select_supplyscope_c4 = [];
            this.select_supplyscope_c5 = [];
            this.system_mini_class(this.w_hrs_id, 'supplyscope_c2');
        },
        //.mainfoldType选择触发
        manifoldTypeChange:function(){
            if(this.pushCheck() == false) return false;
            this.w_systemsize = '';
            this.w_systemtype = '';
            this.w_gatetype = '';
            this.w_systemsize_id = '';
            this.w_systemtype_id = '';
            this.w_gatetype_id = '';
            this.select_supplyscope_c3 = [];
            this.select_supplyscope_c4 = [];
            this.select_supplyscope_c5 = [];
            this.system_mini_class(this.w_manifoldtype_id, 'supplyscope_c3');
        },
        //.systemSize选择触发
        systemSizeChange:function(){
            if(this.pushCheck() == false) return false;
            this.w_systemtype = '';
            this.w_gatetype = '';
            this.w_systemtype_id = '';
            this.w_gatetype_id = '';
            this.select_supplyscope_c4 = [];
            this.select_supplyscope_c5 = [];
            this.system_mini_class(this.w_systemsize_id, 'supplyscope_c4');
        },
        //.systemType选择触发
        systemTypeChange:function(){
            if(this.pushCheck() == false) return false;
            this.w_gatetype = '';
            this.w_gatetype_id = '';
            this.select_supplyscope_c5 = [];
            this.system_mini_class(this.w_systemtype_id, 'supplyscope_c5');
        },
        //AS类型列表
        getASKindList:function(){
            http.getSync('/DictWork/getASKindList',{},res => {
                this.list.asHandle.ASKindList = res.data[0];
            });
        },
        //AS处理分类列表
        getASProcKindList:function(){
            http.getSync('/DictWork/getASProcKindList',{},res => {
                this.list.asHandle.ASASProcKindList = res.data[0];
            });
        },
        //AS处理结果列表
        getASProcResultReasonList:function(){
            http.getSync('/DictWork/getASProcResultList',{},res => {
                this.list.asHandle.ASProcResultList = res.data[0];
            });
        },
        //部品返还区分列表
        getItemReturnGubunList:function(){
            http.getSync('/DictWork/getItemReturnList',{},res => {
                this.list.asHandle.itemReturnList = res.data[0];
            });
        },
        //下拉列表大分类查询
        system_big_class:function(check){
            var params = new Object();
            params.bigsysid = check;
            http.getSync('/WEI_2100/systemclass_big_prc',params,function (res) {
                this.switchClass('select_'+check,res);
            }.bind(this));
        },
        //下拉列表小分类关联查询
        system_mini_class:function(sysclass,check){
            var params = new Object();
            params.bigsysid = sysclass;
            params.minisysid= check;
            http.getSync('/WEI_2100/systemclass_mini_prc',params,function (res) {
                this.switchClass('select_'+check,res);
            }.bind(this));
        },
        //品目单位查询
        unit_class:function(){
            var params = new Object();
            http.getSync('/WEI_2100/as_unit',params,function (res) {
                this.switchClass('select_unit',res);
            }.bind(this));
        },
        switchClass:function(check,res){
            if(res.returnCode == 0){
                switch (check) {
                    case 'select_unit':
                        leon.select_unit = res.data[0];
                        break;
                    case 'select_ascause':
                        leon.select_ascause = res.data[0];
                        break;
                    case 'select_ascause_c':
                        leon.select_ascause_c = res.data[0];
                        break;
                    case 'select_asclass':
                        leon.select_asclass = res.data[0];
                        break;
                    case 'select_area':
                        leon.select_area = res.data[0];
                        break;
                    case 'select_markets':
                        leon.select_markets = res.data[0];
                        break;
                    case 'select_asclass1':
                        leon.select_asclass1 = res.data[0];
                        break;
                    case 'select_asclass1_c':
                        leon.select_asclass1_c = res.data[0];
                        break;
                    case 'select_startpoint':
                        leon.select_startpoint = res.data[0];
                        break;
                    case 'select_asbadtype':
                        leon.select_asbadtype = res.data[0];
                        break;
                    case 'select_supplyscope':
                        leon.select_supplyscope = res.data[0];
                        break;
                    case 'select_supplyscope_c1':
                        leon.select_supplyscope_c1 = res.data[0];
                        break;
                    case 'select_supplyscope_c2':
                        leon.select_supplyscope_c2 = res.data[0];
                        break;
                    case 'select_supplyscope_c3':
                        leon.select_supplyscope_c3 = res.data[0];
                        break;
                    case 'select_supplyscope_c4':
                        leon.select_supplyscope_c4 = res.data[0];
                        break;
                    case 'select_supplyscope_c5':
                        leon.select_supplyscope_c5 = res.data[0];
                        break;
                }
            }
        },
        //更新所有下拉列表默认数值
        update_select:function(){
            this.global_update = 1;
        },
        jq_select:function () {
        },
        mui_switch_active:function(dom,check){
            if(check == 1){
                if(dom == 'mySwitch_confirm'){
                    this.isConfirm();
                }
                jq(".mui-switch-handle").attr("style","");
                jq('#'+dom).addClass('mui-active');
            }
            else
            {
                if(dom == 'mySwitch_confirm'){
                    this.noConfirm();
                }
                jq(".mui-switch-handle").attr("style","");
                jq('#'+dom).removeClass('mui-active');
            }
        },
        mui_switch:function(){
            document.getElementById("mySwitch_table_spare").addEventListener("toggle",function(event){
                if(event.detail.isActive){
                    if(leon.s_confirm == 0){
                        leon.w_astable_SpareYn = 'Y';
                    }
                    else
                    {
                        mui.alert(leon.langCode.isConfirm,leon.global_title);
                        jq(".mui-switch-handle").attr("style","");
                        jq('#mySwitch_table_spare').removeClass('mui-active');
                    }
                }else{
                    if(leon.s_confirm == 0) {
                        leon.w_astable_SpareYn = 'N';
                    }
                    else
                    {
                        mui.alert(leon.langCode.isConfirm,leon.global_title);
                        jq(".mui-switch-handle").attr("style","");
                        jq('#mySwitch_table_spare').addClass('mui-active');
                    }

                }
            });
            document.getElementById("mySwitch_table_char").addEventListener("toggle",function(event){
                if(event.detail.isActive){
                    if(leon.s_confirm == 0){
                        leon.w_astable_ChargeYn = 'Y';
                    }
                    else
                    {
                        mui.alert(leon.langCode.isConfirm,leon.global_title);
                        jq(".mui-switch-handle").attr("style","");
                        jq('#mySwitch_table_char').removeClass('mui-active');
                    }
                }else{
                    if(leon.s_confirm == 0) {
                        leon.w_astable_ChargeYn = 'N';
                    }
                    else
                    {
                        mui.alert(leon.langCode.isConfirm,leon.global_title);
                        jq(".mui-switch-handle").attr("style","");
                        jq('#mySwitch_table_char').addClass('mui-active');
                    }

                }
            });
            document.getElementById("mySwitch_trans").addEventListener("toggle",function(event){
                if(event.detail.isActive){
                    if(leon.s_confirm == 0){
                        leon.s_trans = 'Y';
                        leon.transdom = true;
                    }
                    else
                    {
                        mui.alert(leon.langCode.isConfirm,leon.global_title);
                        jq(".mui-switch-handle").attr("style","");
                        jq('#mySwitch_trans').removeClass('mui-active');
                    }
                }else{
                    if(leon.s_confirm == 0) {
                        leon.s_trans = 'N';
                        leon.w_transgroup = '';
                        leon.w_transgroup_id = '';
                        leon.transdom = false;
                    }
                    else
                    {
                        mui.alert(leon.langCode.isConfirm,leon.global_title);
                        jq(".mui-switch-handle").attr("style","");
                        jq('#mySwitch_trans').addClass('mui-active');
                    }

                }
            });
            document.getElementById("mySwitch_chargeYn").addEventListener("toggle",function(event){
                if(event.detail.isActive){
                    if(leon.s_confirm == 0){
                        leon.s_charge = 'Y';
                    }
                    else
                    {
                        mui.alert(leon.langCode.isConfirm,leon.global_title);
                        jq(".mui-switch-handle").attr("style","");
                        jq('#mySwitch_chargeYn').removeClass('mui-active');
                    }
                }else{
                    if(leon.s_confirm == 0) {
                        leon.s_charge = 'N';
                    }
                    else
                    {
                        mui.alert(leon.langCode.isConfirm,leon.global_title);
                        jq(".mui-switch-handle").attr("style","");
                        jq('#mySwitch_chargeYn').addClass('mui-active');
                    }

                }
            });


            document.getElementById("mySwitch_itemReturn").addEventListener("toggle",function(event){
                if(event.detail.isActive){
                    if(leon.s_confirm == 0){
                        leon.s_itemreturn = 'Y';
                    }
                    else
                    {
                        mui.alert(leon.langCode.isConfirm,leon.global_title);
                        jq(".mui-switch-handle").attr("style","");
                        jq('#mySwitch_itemReturn').removeClass('mui-active');
                    }
                }else{
                    if(leon.s_confirm == 0) {
                        leon.s_itemreturn = 'N';
                    }
                    else
                    {
                        mui.alert(leon.langCode.isConfirm,leon.global_title);
                        jq(".mui-switch-handle").attr("style","");
                        jq('#mySwitch_itemReturn').addClass('mui-active');
                    }

                }
            });
            document.getElementById("mySwitch_confirm").addEventListener("toggle",function(event){
                if(event.detail.isActive){
                    if(leon.w_asid != ''){
                        if(leon.w_status == leon.langCode.isAdjudication){
                            mui.alert('OA审核中，无法修改内容',leon.global_title);
                            jq(".mui-switch-handle").attr("style","");
                            jq('#mySwitch_confirm').removeClass('mui-active');
                            return false;
                        }
                        leon.confirm('CA');
                    }
                    else
                    {
                        mui.alert(leon.langCode.noHoldAs,leon.global_title);
                        jq(".mui-switch-handle").attr("style","");
                        jq('#mySwitch_confirm').removeClass('mui-active');
                    }
                }else{
                    if(leon.w_asid != ''){
                        if(leon.w_status == leon.langCode.isAdjudication){
                            mui.alert('OA审核中，无法修改内容',leon.global_title);
                            jq(".mui-switch-handle").attr("style","");
                            jq('#mySwitch_confirm').addClass('mui-active');
                            return false;
                        }
                        leon.confirm('CD');
                    }
                    else
                    {
                        jq(".mui-switch-handle").attr("style","");
                        jq('#mySwitch_confirm').addClass('mui-active');
                    }
                }
            });
        },
        check_as1:function () {
            if(this.w_ordergubun == ''){
                mui.alert(leon.langCode.chooseMust+leon.langCode.view_orderClass,leon.global_title); //订单区分
                return false;
            }
            if(this.w_asuserid == ''){
                mui.alert(leon.langCode.chooseMust+leon.langCode.view_userNm,leon.global_title); //职工姓名
                return false;
            }
            if(this.w_asclass_id == ''){
                mui.alert(leon.langCode.chooseMust+leon.langCode.chooseAsClass,leon.global_title);
                return false;
            }
            if(this.w_assetdate == ''){
                mui.alert(leon.langCode.chooseMust+leon.langCode.view_setData,leon.global_title); //交货日期
                return false;
            }
            if(this.w_export_distinction_id == ''){
                mui.alert(leon.langCode.chooseMust+leon.langCode.view_ExportDistinction,leon.global_title); //出口区分
                return false;
            }
            if(this.w_model_id == ''){
                mui.alert(leon.langCode.writeMust+leon.langCode.view_modelId,leon.global_title);
                return false;
            }
            if(this.w_supplyscope_id == ''){
                mui.alert(leon.langCode.chooseMust+'Supplyscope',leon.global_title);
                return false;
            }
            if(this.w_hrs_id == ''){
                mui.alert(leon.langCode.chooseMust+'HRS',leon.global_title);
                return false;
            }
            if(this.w_manifoldtype_id == ''){
                mui.alert(leon.langCode.chooseMust+'ManifoldType',leon.global_title);
                return false;
            }
            if(this.w_systemsize_id == ''){
                mui.alert(leon.langCode.chooseMust+'systemsize',leon.global_title);
                return false;
            }
            if(this.w_systemtype_id == ''){
                mui.alert(leon.langCode.chooseMust+'systemtype',leon.global_title);
                return false;
            }
            if(this.w_gatetype_id == ''){
                mui.alert(leon.langCode.chooseMust+'gatetype',leon.global_title);
                return false;
            }

            if(this.w_cust_produce_name == ''){
                mui.alert(leon.langCode.writeMust+leon.langCode.view_custProduceName,leon.global_title); //客户产品名称
                return false;
            }
            if(this.w_markets_id == ''){
                mui.alert(leon.langCode.chooseMust+'Markets',leon.global_title);
                return false;
            }
            if(this.w_asplastic == ''){
                mui.alert(leon.langCode.writeMust+leon.langCode.view_asPlastic,leon.global_title);//塑胶
                return false;
            }
            if(this.w_ascause_id == ''){
                mui.alert(leon.langCode.chooseMust+leon.langCode.view_asCause,leon.global_title);//发生起点
                return false;
            }
            if(this.w_asbadtype_id == ''){
                mui.alert(leon.langCode.chooseMust+leon.langCode.view_asbadtype,leon.global_title);//不良类型
                return false;
            }
            if(this.w_asallclass_id == ''){
                mui.alert(leon.langCode.chooseMust+leon.langCode.view_asCauseClass,leon.global_title);//原因_区分
                return false;
            }
            if(this.w_asdutyclass_id == ''){
                mui.alert(leon.langCode.chooseMust + leon.langCode.view_asDutyClass,leon.global_title);//AS责任区分
                return false;
            }
            if(this.w_asappearance_id == ''){
                mui.alert(leon.langCode.chooseMust+leon.langCode.view_asAppearance,leon.global_title);//AS现象
                return false;
            }
            if(this.w_asreasonclass_id == ''){
                mui.alert(leon.langCode.chooseMust+leon.langCode.view_asReasonClass,leon.global_title);//原因-种类
                return false;
            }
            if(this.w_asserviceclass_id == ''){
                mui.alert(leon.langCode.chooseMust+leon.langCode.view_asServiceAreaClass,leon.global_title);//服务地区区分
                return false;
            }
            // if(this.s_trans == 'N'){
            //     mui.alert(leon.langCode.chooseMust+leon.langCode.view_isTrans,leon.global_title);//是否移模
            //     return false;
            // }
            // if(this.w_transgroup_id == ''){
            //     mui.alert(leon.langCode.chooseMust+leon.langCode.view_isTransGroup,leon.global_title);//移模部门
            //     return false;
            // }
            if(this.w_text1 == ''){
                mui.alert(leon.langCode.writeMust + leon.langCode.view_asStatusDescription,leon.global_title); //AS现状说明
                return false;
            }
            if(this.w_text2 == ''){
                mui.alert(leon.langCode.writeMust + leon.langCode.view_causeAnalysis,leon.global_title); //原因分析
                return false;
            }
            if(this.w_text3 == ''){
                mui.alert(leon.langCode.writeMust + leon.langCode.view_improvementProposals,leon.global_title); //改善建议及方案
                return false;
            }

        },
        check_as2:function () {
            if(this.w_ordergubun == ''){
                mui.alert(leon.langCode.chooseMust+leon.langCode.view_orderClass,leon.global_title);
                return false;
            }
            if(this.w_asuserid == ''){
                mui.alert(leon.langCode.chooseMust+leon.langCode.view_userNm,leon.global_title);
                return false;
            }
            if(this.w_asclass_id == ''){
                mui.alert(leon.langCode.chooseMust+leon.langCode.chooseAsClass,leon.global_title);
                return false;
            }
            if(this.w_assetdate == ''){
                mui.alert(leon.langCode.chooseMust+leon.langCode.view_setData,leon.global_title);
                return false;
            }
            if(this.w_ascause_id == ''){
                mui.alert(leon.langCode.chooseMust+leon.langCode.view_asCause,leon.global_title);
                return false;
            }
            if(this.w_asbadtype_id == ''){
                mui.alert(leon.langCode.chooseMust+leon.langCode.view_asbadtype,leon.global_title);
                return false;
            }
            if(this.w_asallclass_id == ''){
                mui.alert(leon.langCode.chooseMust+leon.langCode.view_asCauseClass,leon.global_title);
                return false;
            }
            if(this.w_asdutyclass_id == ''){
                mui.alert(leon.langCode.chooseMust + leon.langCode.view_asDutyClass,leon.global_title);
                return false;
            }
            if(this.w_asappearance_id == ''){
                mui.alert(leon.langCode.chooseMust+leon.langCode.view_asAppearance,leon.global_title);
                return false;
            }
            if(this.w_asreasonclass_id == ''){
                mui.alert(leon.langCode.chooseMust+leon.langCode.view_asReasonClass,leon.global_title);
                return false;
            }
            if(this.w_asserviceclass_id == ''){
                mui.alert(leon.langCode.chooseMust+leon.langCode.view_asServiceAreaClass,leon.global_title);
                return false;
            }
            // if(this.s_trans == 'N'){
            //     mui.alert(leon.langCode.chooseMust+leon.langCode.view_isTrans,leon.global_title);
            //     return false;
            // }
            // if(this.w_transgroup_id == ''){
            //     mui.alert(leon.langCode.chooseMust+leon.langCode.view_isTransGroup,leon.global_title);
            //     return false;
            // }
            if(this.w_text1 == ''){
                mui.alert(leon.langCode.writeMust + leon.langCode.view_asStatusDescription,leon.global_title);
                return false;
            }
            if(this.w_text2 == ''){
                mui.alert(leon.langCode.writeMust + leon.langCode.view_causeAnalysis,leon.global_title);
                return false;
            }
            if(this.w_text3 == ''){
                mui.alert(leon.langCode.writeMust + leon.langCode.view_improvementProposals,leon.global_title);
                return false;
            }
        },
        area_notnull(area,e){
            switch (area)
            {
                case '苏州':
                    switch (e){
                        case 0:
                            this.must_orderclass['th-red']            = true;
                            this.must_spec_id['th-red']               = true;
                            this.must_cust_name['th-red']             = true;
                            this.must_export_distinction['th-red']    = true;
                            this.must_model_id['th-red']              = true;
                            this.must_drano['th-red']                 = true;
                            this.must_assetdate['th-red']             = true;
                            this.must_asusernm['th-red']              = true;
                            this.must_asgroupnm['th-red']             = true;
                            this.must_ascause['th-red']               = true;
                            this.must_asbadtype['th-red']             = true;
                            this.must_asallclass['th-red']            = true;
                            this.must_asdutyclass['th-red']           = true;
                            this.must_asappearance['th-red']          = true;
                            this.must_asreasonclass['th-red']         = true;
                            this.must_asserviceclass['th-red']        = true;
                            this.must_asservicearea['th-red']         = false;
                            this.must_supplyscope['th-red']           = true;
                            this.must_hrs['th-red']                   = true;
                            this.must_manifoldtype['th-red']          = true;
                            this.must_systemsize['th-red']            = true;
                            this.must_systemtype['th-red']            = true;
                            this.must_gatetype['th-red']              = true;
                            this.must_cust_produce_name['th-red']     = true;
                            this.must_asplastic['th-red']             = true;
                            this.must_Gate_counts['th-red']           = true;
                            this.must_markets['th-red']               = true;
                            this.must_trans['th-red']                 = false;
                            this.must_text1['th-red']                 = true;
                            this.must_text2['th-red']                 = true;
                            this.must_text3['th-red']                 = true;
                            break;
                        case 1:
                            break;
                        case 2:
                            this.must_orderclass['th-red']            = true;
                            this.must_spec_id['th-red']               = true;
                            this.must_cust_name['th-red']             = true;
                            this.must_export_distinction['th-red']    = true;
                            this.must_model_id['th-red']              = false;
                            this.must_drano['th-red']                 = true;
                            this.must_assetdate['th-red']             = true;
                            this.must_asusernm['th-red']              = true;
                            this.must_asgroupnm['th-red']             = true;
                            this.must_ascause['th-red']               = true;
                            this.must_asbadtype['th-red']             = true;
                            this.must_asallclass['th-red']            = true;
                            this.must_asdutyclass['th-red']           = true;
                            this.must_asappearance['th-red']          = true;
                            this.must_asreasonclass['th-red']         = true;
                            this.must_asserviceclass['th-red']        = true;
                            this.must_asservicearea['th-red']         = false;

                            this.must_supplyscope['th-red']           = false;
                            this.must_hrs['th-red']                   = false;
                            this.must_manifoldtype['th-red']          = false;
                            this.must_systemsize['th-red']            = false;
                            this.must_systemtype['th-red']            = false;
                            this.must_gatetype['th-red']              = false;

                            this.must_cust_produce_name['th-red']     = false;
                            this.must_asplastic['th-red']             = false;
                            this.must_Gate_counts['th-red']           = true;
                            this.must_markets['th-red']               = false;
                            this.must_trans['th-red']                 = false;
                            this.must_text1['th-red']                 = true;
                            this.must_text2['th-red']                 = true;
                            this.must_text3['th-red']                 = true;
                            break;
                        case 3:
                            break;
                    }
                    break;
                case '广州':
                    switch (e){
                        case 0:
                            break;
                        case 1:
                            break;
                        case 2:
                            break;
                        case 3:
                            break;
                    }
                    break;
            }
        },
    }
});
jq(function () {
    jq("#btn_menu_lists").click(function() {
        location.href='/Menu/Menu/menuLists?formKey='+jq("#form_key").val()+'&menuSelection='+jq("#menu_selection").val();
    });
    mui.previewImage();
});
function setQRcodeResult(content) {
    if(content.indexOf("/") > 0){
        var sourceNo = content.split('/')[4];
    }
    else
    {
        var sourceNo = content
    }
    if(sourceNo == ''){
        mui.alert(leon.lang.noQrcodeInfo);
    }
    else
    {
        if(leon.global_qrclass == 'order'){
            //新增AS
            popOrderModal.model.popOrderNo = sourceNo;
            popOrderModal.getData();
        }
        else
        {
            //查询AS
            if(popAsRecvModal.view.showPop == true){
                popAsRecvModal.model.popOrderNo = sourceNo;
                popAsRecvModal.getData();
            }
        }
        // mui.alert('订单号:'+order_id,leon.global_title);
    }
}



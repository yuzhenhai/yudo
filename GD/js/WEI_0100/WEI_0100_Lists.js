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
        monthSumItem:{
            'item':true,
            'active':false,
        },
        dayItem:{
            'item':true,
            'active':false,
        },
        lock:false,
        nowDateItem:0,
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
            headerTitle:'每日统计表',
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
            transTitle:'',
            RMB:'',
            EUR:'',
            KOR:'',
            HKD:'',
            JPY:'',
            TWD:'',
            USD:'',
            yudate:'',
            yutitle:'',
        },
        view:{
            dataMinute:false,
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
            getResults:'/WEI_0100/lists_prc',
            getChukou:'/WEI_0100/getChukou',
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
            db:'SZ',
            currency:'RMB',
            targetAllAdmin:{value:'ALL',text:''},
            targetGroupAdmin:{value:'ALL',text:''},
            targetGroupAdmin_c:{value:'ALL',text:''},
            targetUser:{},
            leaderNm:'',
        },
        list:{
            db:[
                {value:'SZ',text:'苏州'},
                {value:'GD',text:'广东'},
                {value:'QD',text:'青岛'},
                {value:'HS',text:'汉斯'},
                {value:'XR',text:'先锐'},
                {value:'YBD',text:'毅比道'},
                {value:'SH',text:'上海'},
                {value:'LL',text:'柳凌'},
                {value:'LLSZ',text:'朗力苏州'},
                {value:'CL',text:'彻丽'},
                {value:'SZJT',text:'苏州集团'},
                {value:'GDJT',text:'广东集团'},
                {value:'QDJT',text:'青岛集团'},
                
            ],
            SZJT:[
                {value:'SZ',text:'苏州'},
                {value:'HS',text:'汉斯'},
                {value:'SH',text:'上海'},
                {value:'LL',text:'柳凌'},
                {value:'LLSZ',text:'朗力苏州'},
            ],
            GDJT:[
                {value:'GD',text:'广东'},
                {value:'XR',text:'先锐'},
                {value:'YBD',text:'毅比道'},
            ],
            QDJT:[
                {value:'QD',text:'青岛'},
                {value:'CL',text:'彻丽'},
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
            summarizeList:[],
            orderListDisplay:[],
            invoiceListDisplay:[],
            billListDisplay:[],
            ReceiptDisplay:[],
            invoiceProListDisplay:[],
            minuteListDisplay:[],
            orderList:[],
            invoiceList:[],
            billList:[],
            receiptList:[],
            invoiceProList:[],
            sumData:{},
            sumDataDisplay:{},
            sumExternal:{},
            sumExternalDisplay:{},
            sumInternal:{},
            sumInternalDisplay:{},
            cs:false,
            speakOrder:[],
            speakInvoice:[],
            speakBill:[],
            speakReceipt:[],
            speakProduct:[],
            Yclick:'',
            speakALL:[],
            diyu:false,
            JITUAN:{},
            JITUANNAME:{},
            jituanList:[],
            jituanx:false,
            jituanTotal:[],
            JIDB:'',
            TotalALL:[],
            sumSZJT:[],
            sumGDJT:[],
            sumQDJT:[],
            SZ_List:[],
            GD_List:[],
            QD_List:[],
            TotalALLX:false,
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
        try {
            langCode.method = 'cache';
            langCode.getWord({

                    SUZHOU:'W2019010917151813357',
                    GUANGDONG:'W2019010917154884789',
                    QINGDAO:'W2019010917160016794',
                    HANS:'W2019110115053661645',
                    XIANRUI:'W2019110115053699355',
                    YIBIDAO:'W2021012215511405769',
                    ALL:'W2019050917590233017',
                    SHANGHAI:'W2021012215521156777',
                    LIULING:'W2021012215532417745',
                    LLSZ:'W2021012215540264718',
                    CHELI:'W2021012215552255763',
                    SZJT:'W2021012215572059311',
                    GDJT:'W2021012215575402782',
                    QDJT:'W2021012215582990385',
                    // headerTitle:'W2018020109425972356',
                    growRate:'W2018020113401724334',//增长率
                    lastYear:'W2018122516062166764',
                    toYear:'W2018122516063785033',
                    menuBack:'W2018071009230638074',   //主菜单
                    expClass:'W2018041913341497746',//出口区分
                    currCd:'G2018102617102083724',//货币种类
                    headerTitle:'W2018122516284669743',

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

                    year:'W2018102617000591392',
                    monthSum:'W2019050510083163086',
                    month:'G2018102617002367015',
                    day:'G2018102617005914777',
                    search:'W2018082711232500387',//查询
                    dataMinute:'G2018102617012216352',//详细数据
                    class:'G2018102617013950014',//区分
                    orderResults:'G2018102617015927383',//订单金额
                    invoiceResults:'G2018102617023163098',
                    billResults:'G2018102617053446374',
                    receiptResults:'G2018102617060001707',
                    MatOutAmt:'W2019061309463186003',//生产出库金额
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
                    targetWrite:'W2018102616572707009',//销售目标录入
                    currId:'G2018102617195825091',
                    trust:'W2018041913351532345',//内销
                    untrust:'W2018041913355225052',//外销
                    isConfirm:'W2018102914044702085',
                    noConfirm:'W2018102914051033012',
                    order:'W2018110617341265338',//订单
                    invoice:'W2018110617351862706',//出库
                    bill:'W2018110617354776078',//发票
                    receipt:'W2018110617362266394',//收款
                    changeTheme:'W2018110618023964046',//切换样式

                    guojia:'W2018082709495603355',

                    speakorderResults:'G2018102617015927383',//订单金额
                    speakinvoiceResults:'G2018102617023163098',
                    speakbillResults:'G2018102617053446374',
                    speakreceiptResults:'G2018102617060001707',
                    speakMatOutAmt:'W2019061309463186003',//生产出库金额

                    guojia:'W2018082709495603355',
                    CHUKOU:'W2018062810285065731',

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
        this.salesTargetDate = this.getNowDate();
    },
    methods:{
        //多语言转换完成回调
        _updateLang:function(){
            this.view.downLoadScript = false;
            this.list.expClass[0].text = this.lang.trust;
            this.list.expClass[1].text = this.lang.untrust;
            this.lang.nowUnit = this.lang.unitInfo;
            this.list.db = [
                {value:'SZ',text:this.lang.SUZHOU},
                {value:'GD',text:this.lang.GUANGDONG},
                {value:'QD',text:this.lang.QINGDAO},
                {value:'HS',text:this.lang.HANS},
                {value:'XR',text:this.lang.XIANRUI},
                {value:'YBD',text:this.lang.YIBIDAO},
                {value:'SH',text:this.lang.SHANGHAI},
                {value:'LL',text:this.lang.LIULING},
                {value:'LLSZ',text:this.lang.LLSZ},
                {value:'CL',text:this.lang.CHELI},
                {value:'SZJT',text:this.lang.SZJT},
                {value:'GDJT',text:this.lang.GDJT},
                {value:'QDJT',text:this.lang.QDJT},

                {value:'ALL',text:this.lang.ALL}
            ];
            
            this.list.SZJT = [
                {value:'SZ',text:this.lang.SUZHOU},
                {value:'HS',text:this.lang.HANS},
                {value:'SH',text:this.lang.SHANGHAI},
                {value:'LL',text:this.lang.LIULING},
                {value:'LLSZ',text:this.lang.LLSZ},
            ];
            this.list.GDJT = [
                {value:'GD',text:this.lang.GUANGDONG},
                {value:'XR',text:this.lang.XIANRUI},
                {value:'YBD',text:this.lang.YIBIDAO},
            ];
            this.list.QDJT = [
                {value:'QD',text:this.lang.QINGDAO},
                {value:'CL',text:this.lang.CHELI},
            ];

        },
        speakDataMinute:function(){
            var params = {};
            if(this.nowDateItem == 0){
                params.gubun = 'Y';
            }else if(this.nowDateItem == 1){
                params.gubun = 'MS';
            }else if(this.nowDateItem == 2){
                params.gubun = 'M';
            } else{
                params.gubun = 'D';
            }
            params.baseDate = this.salesTargetDate;
            params.dbChoose = 'SZ';
           setTimeout(function () {
               mui.showLoading('loading'); 
            }, 100)
            http.get(this.api.getChukou,params,function (res) {
                 jq('.yudo-window').css({'animation-duration':'0.6s'});
                    leon.view.dataMinute = false;
                    leon.view.speaksMinute = true;
                    if(JLAMP.common.getDevicePlatform() !== JLAMP.devicePlatform.iOS){
                        multi.removeDefaultByClass('yudo-window',function () {
                        });
                    }
                    console.log(res);
   
                    switch (leon.list.Yclick){
                        case 0:
                            leon.list.Yclick = 0;
                            leon.list.speakALL = res.speakOrder; 
                            break;
                        case 1:
                            leon.list.Yclick = 1;
                            leon.list.speakALL = res.speakInvoice; 
                            break;
                        case 2:
                            leon.list.Yclick = 2;
                            leon.list.speakALL = res.speakBill; 
                            break;
                        case 3:
                            leon.list.Yclick = 3;
                            leon.list.speakALL = res.speakReceipt;                        

                            break;
                        case 4:
                            leon.list.Yclick = 4;
                            leon.list.speakALL = res.speakProduct;                        
                            break;
                    } 
                    // },300) 
            });
             
        },
        buildDataMinute:function(index){
            if(this.input.db == 'YBD' || this.input.db == 'SH' || this.input.db == 'LL' || this.input.db == 'LLSZ' || this.input.db == 'CL'){
                return false;
            }

            if(this.input.db == 'SZJT'||  this.input.db == 'GDJT' || this.input.db == 'QDJT'){
                var tuan = [];
               // console.log(leon.list.JITUAN);
                for (let i in leon.list.JITUAN){
                    leon.list.JITUAN[i].DeptNm = leon.list.JITUANNAME[i];
                   
                    for (let j in leon.list.JITUAN[i]){
                        
                        if(leon.list.JITUAN[i][j].percent>0){
                            leon.list.JITUAN[i][j].percentMinuteColor = '#e02a27';
                        }else{
                            leon.list.JITUAN[i][j].percentMinuteColor = '#159a00';
                        }
                        leon.list.JITUAN[i][j].DeptNm = leon.list.JITUANNAME[i];
                    }
                    for (let j in leon.list.JITUAN[i]){
                        if(j == index){
                            if(leon.list.JITUAN[i][j]){
                                tuan[i] = leon.list.JITUAN[i][j];
                            }
                        }
                    }  
                }
                var jituanTotal = [];
                for (let i in leon.list.summarizeList){
                    if(i == index){
                        jituanTotal = leon.list.summarizeList[i];
                    }
                }
                leon.list.jituanTotal = jituanTotal
                leon.list.jituanList = tuan;
                // console.log(jituanTotal);
                // return false;
            }


                        if(this.input.db == 'ALL'){
                
                var SZList = [];
                var TotalSZ = [];
                var TotalGD = [];
                var TotalQD = [];
                var key = 0;
                var k = 0;
                for (let i in leon.list.TotalALL.SZ){
                    if(jq.isArray(leon.list.TotalALL.SZ[i])){
                        TotalSZ[k] = leon.list.TotalALL.SZ[i];
                        if(!isNaN(i)){
                            TotalSZ[k].jk = i;
                        }
                    }
                    k++;
                }
                var k1 = 0;
                for (let i in leon.list.TotalALL.GD){
                    if(jq.isArray(leon.list.TotalALL.GD[i])){
                        TotalGD[k1] = leon.list.TotalALL.GD[i];
                        if(!isNaN(i)){
                            TotalGD[k1].jk = i;
                        }
                    }
                    k1++;
                }
                var k2 = 0;
                for (let i in leon.list.TotalALL.QD){
                    if(leon.list.TotalALL.QD[i]){
                        TotalQD[k2] = leon.list.TotalALL.QD[i];
                        if(!isNaN(i)){
                            TotalQD[k2].jk = i;
                        }
                    }
                    k2++;
                }
                console.log(TotalSZ);
                for (let i in TotalSZ){
                    
                    TotalSZ[i].DeptNm = leon.list.JITUANNAME[TotalSZ[i].jk];
                    if(TotalSZ[i].jk && TotalSZ[i].DeptNm){
                        for (let j in TotalSZ[i]){
                            if(TotalSZ[i][j].percent){
                                if(TotalSZ[i][j].percent>0){
                                    TotalSZ[i][j].percentMinuteColor = '#e02a27';
                                }else{
                                    TotalSZ[i][j].percentMinuteColor = '#159a00';
                                }
                            }else{
                                TotalSZ[i][j].percent = 0;
                                TotalSZ[i][j].percentMinuteColor = '#e02a27';
                            }
                            TotalSZ[i][j].DeptNm = leon.list.JITUANNAME[TotalSZ[i].jk];
                        }
                        for (let j in TotalSZ[i]){
                            if(j == index){
                                if(TotalSZ[i][j]){
                                    SZList[key] = TotalSZ[i][j];
                                }
                            }
                        }  
                        key++;
                    }
                }



                var GDList = [];
                var key1 = 0;
                for (let i in TotalGD){
                    TotalGD[i].DeptNm = leon.list.JITUANNAME[TotalGD[i].jk];
                    for (let j in TotalGD[i]){
                        if(TotalGD[i][j].percent){
                            if(TotalGD[i][j].percent>0){
                                TotalGD[i][j].percentMinuteColor = '#e02a27';
                            }else{
                                TotalGD[i][j].percentMinuteColor = '#159a00';
                            }
                        }else{
                                TotalGD[i][j].percentMinuteColor = '#e02a27';
                        }
                        TotalGD[i][j].DeptNm = leon.list.JITUANNAME[TotalGD[i].jk];
                    }
                    for (let j in TotalGD[i]){
                        if(j == index){
                            if(TotalGD[i][j]){
                                GDList[key1] = TotalGD[i][j];
                            }
                        }
                    }  
                    key1++;
                }
                var QDList = [];
                var key2 = 0;
                for (let i in TotalQD){
                    TotalQD[i].DeptNm = leon.list.JITUANNAME[TotalQD[i].jk];
                    for (let j in TotalQD[i]){
                        if(TotalQD[i][j].percent){
                            if(TotalQD[i][j].percent>0){
                                TotalQD[i][j].percentMinuteColor = '#e02a27';
                            }else{
                                TotalQD[i][j].percentMinuteColor = '#159a00';
                            }
                        }else{
                                TotalQD[i][j].percentMinuteColor = '#e02a27';
                        }
                        TotalQD[i][j].DeptNm = leon.list.JITUANNAME[TotalQD[i].jk];
                    }
                    for (let j in TotalQD[i]){
                        if(j == index){
                            if(TotalQD[i][j]){
                                QDList[key2] = TotalQD[i][j];
                            }
                        }
                    } 
                    key2++ ;
                }

                leon.list.SZ_List = SZList;
                leon.list.GD_List = GDList;
                leon.list.QD_List = QDList;
 
                for (let i in leon.list.sumSZJT){
                    if(i == index){
                        leon.list.TotalALL.SZList =  leon.list.sumSZJT[i];
                    }

                }
                for (let i in leon.list.sumGDJT){
                    if(i == index){
                        leon.list.TotalALL.GDList =  leon.list.sumGDJT[i];
                    }

                }
                for (let i in leon.list.sumQDJT){
                    if(i == index){
                        leon.list.TotalALL.QDList =  leon.list.sumQDJT[i];
                    }

                }
 
                 // return false;
            }


            switch (index){
                case 0:
                    leon.list.Yclick = 0;
                    leon.lang.transTitle = leon.lang.orderResults;
                    break;
                case 1:
                    leon.list.Yclick = 1;
                    leon.lang.transTitle = leon.lang.invoiceResults;
                    break;
                case 2:
                    leon.list.Yclick = 2;
                    leon.lang.transTitle = leon.lang.billResults;
                    break;
                case 3:
                    leon.list.Yclick = 3;
                    leon.lang.transTitle = leon.lang.receiptResults;
                    break;
                case 4:
                    leon.list.Yclick = 4;
                    leon.lang.transTitle = leon.lang.MatOutAmt;
                    break;
            }
            console.log(leon.list.billList)
            jq('.yudo-window').css({'animation-duration':'0.6s'});
            leon.view.dataMinute = true;
            leon.view.speaksMinute = false;
            if(JLAMP.common.getDevicePlatform() !== JLAMP.devicePlatform.iOS){
                multi.removeDefaultByClass('yudo-window',function () {
                });
            }
            // mui.showLoading('loading');
            setTimeout(function () {
                switch (index){
                    case 0:
                        leon.list.Yclick = 0;
                        leon.list.sumDataDisplay = leon.list.sumData.order;
                        leon.list.sumExternalDisplay = leon.list.sumExternal.order;
                        leon.list.sumInternalDisplay = leon.list.sumInternal.order;
                        leon.list.minuteListDisplay = leon.list.orderList;
                        break;
                    case 1:
                        leon.list.Yclick = 1;
                        leon.list.sumDataDisplay = leon.list.sumData.invoice;
                        leon.list.sumExternalDisplay = leon.list.sumExternal.invoice;
                        leon.list.sumInternalDisplay = leon.list.sumInternal.invoice;
                        leon.list.minuteListDisplay = leon.list.invoiceList;
                        break;
                    case 2:
                        leon.list.Yclick = 2
                        leon.list.sumDataDisplay = leon.list.sumData.bill;
                        leon.list.sumExternalDisplay = leon.list.sumExternal.bill;
                        leon.list.sumInternalDisplay = leon.list.sumInternal.bill;
                        leon.list.minuteListDisplay = leon.list.billList;
                        break;
                    case 3:
                        leon.list.Yclick = 3;
                        leon.list.sumDataDisplay = leon.list.sumData.receipt;
                        leon.list.sumExternalDisplay = leon.list.sumExternal.receipt;
                        leon.list.sumInternalDisplay = leon.list.sumInternal.receipt;
                        leon.list.minuteListDisplay = leon.list.receiptList;
                        break;
                    case 4:
                        leon.list.Yclick = 4;
                        leon.list.sumDataDisplay = leon.list.sumData.invoicePro;
                        leon.list.sumExternalDisplay = leon.list.sumExternal.invoicePro;
                        leon.list.sumInternalDisplay = leon.list.sumInternal.invoicePro;
                        leon.list.minuteListDisplay = leon.list.invoiceProList;
                        break;
                }
                
            },300)
        },

        closeSpeakMinute:function(){
            jq('.yudo-window').css({'animation-duration':'0.6s'});
            leon.view.speaksMinute = false;
            leon.view.dataMinute = true;

        },

        closeDataMinute:function(index){
            leon.list.minuteListDisplay = [];
            jq('.yudo-window').css({'animation-duration':'0.2s'});
            multi.recoverDefaultByCss('yudo-window',function () {
                leon.view.viewTargetMinute = true;
                multi.removeTransByCss('yudo-window-trans',function () {
                    leon.view.dataMinute = false;
                });
            });
        },
        //切换年月日
        changeInfoItem:function (e) {
            if (e == this.nowDateItem) return false;
            mui.showLoading('loading');
            this.yearItem['active'] = false;
            this.monthItem['active'] = false;
            this.dayItem['active'] = false;
            this.monthSumItem['active'] = false;
            switch (e) {
                case 0:
                    this.nowDateItem = 0;
                    this.yearItem['active'] = true;

                    break;
                case 1:
                    this.nowDateItem = 1;
                    this.monthSumItem['active'] = true;
                    break;
                case 2:
                    this.nowDateItem = 2;
                    this.monthItem['active'] = true;
                    break;
                case 3:
                    this.nowDateItem = 3;
                    this.dayItem['active'] = true;
                    break;
            }
            setTimeout(function () {
                mui.hideLoading();
            }, 300)
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
            this.isactive = 0;
            if(this.view.echarts != '')this.view.echarts.clear();
            this.list.ResultsList = [];
            this.list.summarizeList = [];

            if(this.input.db == 'SZ'){
                leon.list.diyu =true;
            }else{
                leon.list.diyu =false;
            }
            this.list.sumSZJT = [];
            this.list.sumGDJT = [];
            this.list.sumQDJT = [];
            this.list.TotalALL = [];
            this.list.TotalALL.SZ = [];
            this.list.TotalALL.GD = [];
            this.list.TotalALL.QD = [];
            this.list.TotalALL.SZList = [];
            this.list.TotalALL.GDList = [];
            this.list.TotalALL.GDList = [];
            leon.list.JITUAN = [];
            if(this.input.db == 'ALL'){
                leon.list.jituanx = true;
                leon.list.TotalALLX = true;
                for (let i in this.list.db){
                    var params = {}
                    if(this.nowDateItem == 0){
                        params.gubun = 'Y';
                    }else if(this.nowDateItem == 1){
                        params.gubun = 'MS';
                    }else if(this.nowDateItem == 2){
                        params.gubun = 'M';
                    } else{
                        params.gubun = 'D';
                    }
                    params.baseDate = this.salesTargetDate;
                    if(this.list.db[i].value == 'ALL'){
                        continue
                    }
                    
                    if(this.list.db[i].value == 'YBD') params.serverId = 'YBD';
                    params.dbChoose = this.list.db[i].value

                    if(this.list.db[i].value == 'SH'){
                        params.SH = 'SH'; params.dbChoose = '';
                    }
                    if(this.list.db[i].value == 'LL'){
                     params.LL = 'LL'; params.dbChoose = '';
                    }
                    if(this.list.db[i].value == 'LLSZ'){
                     params.LLSZ = 'LLSZ'; params.dbChoose = '';
                    }
                    if(this.list.db[i].value == 'CL'){
                     params.CL = 'CL'; params.dbChoose = '';
                    }

                    if(this.list.db[i].value == 'SZJT'){
                     continue
                    }
                    if(this.list.db[i].value == 'GDJT'){
                     continue
                    }
                    if(this.list.db[i].value == 'QDJT'){
                     continue
                    }

                
                    try{
                        this.getData(params,'all',i)
                    }catch (e) {
                        mui.alert(this.list.db[i].text + "数据查询过程中出现错误",title);
                        mui.hideLoading();
                    }
                }
                this.dataComplete = [];
                let interval = setInterval(res => {
                    if(this.dataComplete.length == 10){
                        mui.hideLoading();
                        clearInterval(interval);
                    }
                },300);
            }else{                
                leon.list.TotalALLX = false;    
                // mui.alert(this.input.db);
                if(this.input.db == 'SZJT'){
                    leon.list.jituanx = false;
                    for (let i in this.list.SZJT){
                            var params = {}
                        if(this.nowDateItem == 0){
                            params.gubun = 'Y';
                        }else if(this.nowDateItem == 1){
                            params.gubun = 'MS';
                        }else if(this.nowDateItem == 2){
                            params.gubun = 'M';
                        } else{
                            params.gubun = 'D';
                        }
                        params.baseDate = this.salesTargetDate;
                        // if(this.list.db[i].value == 'ALL'){
                        //     continue
                        // }
                        params.dbChoose = this.list.SZJT[i].value

                        if(this.list.SZJT[i].value == 'SH'){
                            params.SH = 'SH'; params.dbChoose = '';
                        }
                        if(this.list.SZJT[i].value == 'LL'){
                         params.LL = 'LL'; params.dbChoose = '';
                        }
                        if(this.list.SZJT[i].value == 'LLSZ'){
                         params.LLSZ = 'LLSZ'; params.dbChoose = '';
                        }
                        
                        try{
                            this.getData(params,'all',i)
                        }catch (e) {
                            mui.alert(this.list.SZJT[i].text + "数据查询过程中出现错误",title);
                            mui.hideLoading();
                        }
                    }
                    this.dataComplete = [];
                    let interval = setInterval(res => {
                        if(this.dataComplete.length == 5){
                            mui.hideLoading();
                            clearInterval(interval);
                        }
                    },500);
                
                }else if(this.input.db == 'GDJT'){
                    leon.list.jituanx = false;
                    for (let i in this.list.GDJT){
                            var params = {}
                        if(this.nowDateItem == 0){
                            params.gubun = 'Y';
                        }else if(this.nowDateItem == 1){
                            params.gubun = 'MS';
                        }else if(this.nowDateItem == 2){
                            params.gubun = 'M';
                        } else{
                            params.gubun = 'D';
                        }
                        params.baseDate = this.salesTargetDate;
                        // if(this.list.db[i].value == 'ALL'){
                        //     continue
                        // }
                        params.dbChoose = this.list.GDJT[i].value

                        if(this.list.GDJT[i].value == 'YBD') params.serverId = 'YBD';
                        
                        try{
                            this.getData(params,'all',i)
                        }catch (e) {
                            mui.alert(this.list.GDJT[i].text + "数据查询过程中出现错误",title);
                            mui.hideLoading();
                        }
                    }
                    this.dataComplete = [];
                    let interval = setInterval(res => {
                        if(this.dataComplete.length == 3){
                            mui.hideLoading();
                            clearInterval(interval);
                        }
                    },500);
                }else if(this.input.db == 'QDJT'){
                    leon.list.jituanx = false;
                    for (let i in this.list.QDJT){
                            var params = {}
                        if(this.nowDateItem == 0){
                            params.gubun = 'Y';
                        }else if(this.nowDateItem == 1){
                            params.gubun = 'MS';
                        }else if(this.nowDateItem == 2){
                            params.gubun = 'M';
                        } else{
                            params.gubun = 'D';
                        }
                        params.baseDate = this.salesTargetDate;
                        // if(this.list.db[i].value == 'ALL'){
                        //     continue
                        // }
                        params.dbChoose = this.list.QDJT[i].value

                        if(this.list.QDJT[i].value == 'CL'){
                         params.CL = 'CL'; params.dbChoose = '';
                        }
                        
                        try{
                            this.getData(params,'all',i)
                        }catch (e) {
                            mui.alert(this.list.QDJT[i].text + "数据查询过程中出现错误",title);
                            mui.hideLoading();
                        }
                    }
                    this.dataComplete = [];
                    let interval = setInterval(res => {
                        if(this.dataComplete.length == 2){
                            mui.hideLoading();
                            clearInterval(interval);
                        }
                    },500);
                }else{
                    var params = {}
                     if(this.nowDateItem == 0){
                            params.gubun = 'Y';
                        }else if(this.nowDateItem == 1){
                            params.gubun = 'MS';
                        }else if(this.nowDateItem == 2){
                            params.gubun = 'M';
                        } else{
                            params.gubun = 'D';
                        }
                        params.baseDate = this.salesTargetDate;
                     params.dbChoose = this.input.db
                    if(this.input.db == 'YBD'){ params.serverId = 'YBD';};
                    
                    if(this.input.db == 'SH'){
                        params.SH = 'SH'; params.dbChoose = '';
                    }else if(this.input.db == 'LL'){
                     params.LL = 'LL'; params.dbChoose = '';
                    }else if(this.input.db == 'LLSZ'){
                     params.LLSZ = 'LLSZ'; params.dbChoose = '';
                    }else if(this.input.db == 'CL'){
                     params.CL = 'CL'; params.dbChoose = '';
                    }
                    leon.list.jituanx = true;
                    this.getData(params,'')
                }
            }
        },
        getData(params,check,jt=0){
            http.getSync(this.api.getResults,params,res => {
                
                var expClass = function () {
                    return {
                        external:[], internal:[]
                    }
                }
                var protocol = function () {
                    return {
                        order:{percent:0,ForAmt:0,ForAmt_Pre:0},
                        invoice:{percent:0,ForAmt:0,ForAmt_Pre:0},
                        bill:{percent:0,ForAmt:0,ForAmt_Pre:0},
                        receipt:{percent:0,ForAmt:0,ForAmt_Pre:0},
                        invoicePro:{percent:0,ForAmt:0,ForAmt_Pre:0}
                    }
                }
                var defaultData = function (data) {
                    data.order.ForAmt_Pre = '-';
                    data.order.percent = '0.00';
                    data.invoice.ForAmt_Pre = '-';
                    data.invoice.percent = '0.00';
                    data.bill.ForAmt_Pre = '-';
                    data.bill.percent = '0.00';
                    data.receipt.ForAmt_Pre = '-';
                    data.receipt.percent = '0.00';
                    data.invoicePro.ForAmt_Pre = '-';
                    data.invoicePro.percent = '0.00';
                }
                var defaultMinuteData = function (data) {
                    for(var i in data.internal){
                        data.internal[i].ForAmt_Pre = '-';
                        data.internal[i].percent = '0.00';
                    }
                    for(var i in data.external){
                        data.external[i].ForAmt_Pre = '-';
                        data.external[i].percent = '0.00';
                    }
                }
                var orderList = expClass();
                var invoiceList = expClass();
                var billList = expClass();
                var receiptList = expClass();
                var invoiceProList = expClass();
                var sumExternal = protocol();
                var sumInternal = protocol();
                var sumData = protocol();
                var summarize = [];
                //.毅比道数据特殊处理
                if (params.dbChoose == 'YBD'){
                    var orderPercent = (((res.data.Order.FForamount-res.data.Order.FForamountPre)/(res.data.Order.FForamountPre == 0 ?100:res.data.Order.FForamountPre))*100).toFixed(2);
                    var invoicePercent = (((res.data.Invoice.FForamount-res.data.Invoice.FForamountPre)/(res.data.Invoice.FForamountPre == 0 ?100:res.data.Invoice.FForamountPre))*100).toFixed(2);
                    var billPercent = (((res.data.Bill.FForamount-res.data.Bill.FForamountPre)/(res.data.Bill.FForamountPre == 0 ?100:res.data.Bill.FForamountPre))*100).toFixed(2);
                    var receivePercent = (((res.data.Receive.FForamount-res.data.Receive.FForamountPre)/(res.data.Receive.FForamountPre == 0 ?100:res.data.Receive.FForamountPre))*100).toFixed(2);
                    summarize.push({
                        name:leon.lang.orderResults,
                        ForAmt:parseFloat(res.data.Order.FForamount/10000).toFixed(2),
                        ForAmt_Pre:parseFloat(res.data.Order.FForamountPre/10000).toFixed(2),
                        percent:orderPercent,
                        percentColor: orderPercent < 0 ? '#07be00' : '#ff6259'
                    });

                    summarize.push({
                        name:leon.lang.invoiceResults,
                        ForAmt:parseFloat(res.data.Invoice.FForamount/10000).toFixed(2),
                        ForAmt_Pre:parseFloat(res.data.Invoice.FForamountPre/10000).toFixed(2),
                        percent:invoicePercent,
                        percentColor: invoicePercent < 0 ? '#07be00' : '#ff6259'
                    });
                    summarize.push({
                        name:leon.lang.billResults,
                        ForAmt:parseFloat(res.data.Bill.FForamount/10000).toFixed(2),
                        ForAmt_Pre:parseFloat(res.data.Bill.FForamountPre/10000).toFixed(2),
                        percent:billPercent,
                        percentColor: billPercent < 0 ? '#07be00' : '#ff6259'
                    });
                    summarize.push({
                        name:leon.lang.receiptResults,
                        ForAmt:parseFloat(res.data.Receive.FForamount/10000).toFixed(2),
                        ForAmt_Pre:parseFloat(res.data.Receive.FForamountPre/10000).toFixed(2),
                        percent:receivePercent,
                        percentColor: receivePercent < 0 ? '#07be00' : '#ff6259'
                    });
                    summarize.push({
                        name:leon.lang.MatOutAmt,
                        ForAmt:0,
                        ForAmt_Pre:0,
                        percent:0,
                        percentColor: '#ff6259'
                    });
                    //.当查询所有公司金额，则在原来金额上递增 YBD特殊处理
                    leon.list.JITUAN[jt] = summarize;
                    leon.list.JITUANNAME[jt] = leon.lang.YIBIDAO;
                    leon.list.TotalALL.GD[jt] = summarize;
                    if(check == 'all'){
                        let interval = setInterval(intervals => {
                            //http是异步的，同时访问多个服务器，所以加写锁lock
                            if(leon.lock == false){
                                leon.lock = true
                                for(let i in summarize){
                                    if (leon.list.summarizeList.hasOwnProperty(i) == false){
                                        leon.list.summarizeList.push({
                                            name:summarize[i].name,
                                            ForAmt:0,
                                            ForAmt_Pre:0
                                        });
                                    }
                                    leon.list.summarizeList[i].ForAmt = (parseFloat(summarize[i].ForAmt)
                                        + parseFloat(leon.list.summarizeList[i].ForAmt)).toFixed(2);
                                    leon.list.summarizeList[i].ForAmt_Pre = (parseFloat(summarize[i].ForAmt_Pre)
                                        +  parseFloat(leon.list.summarizeList[i].ForAmt_Pre)).toFixed(2);
                                    leon.list.summarizeList[i].percent = (((leon.list.summarizeList[i].ForAmt-leon.list.summarizeList[i].ForAmt_Pre)
                                        /(leon.list.summarizeList[i].ForAmt_Pre == 0 ?100:leon.list.summarizeList[i].ForAmt_Pre))*100).toFixed(2);
                                    leon.list.summarizeList[i].percentColor = leon.list.summarizeList[i].percent < 0 ? '#07be00' : '#ff6259'
                                

                                    if (leon.list.sumGDJT.hasOwnProperty(i) == false){
                                        leon.list.sumGDJT.push({
                                            name:summarize[i].name,
                                            ForAmt:0,
                                            ForAmt_Pre:0
                                        });
                                    }
                                    leon.list.sumGDJT[i].ForAmt = (parseFloat(summarize[i].ForAmt)
                                        + parseFloat(leon.list.sumGDJT[i].ForAmt)).toFixed(2);
                                    leon.list.sumGDJT[i].ForAmt_Pre = (parseFloat(summarize[i].ForAmt_Pre)
                                        +  parseFloat(leon.list.sumGDJT[i].ForAmt_Pre)).toFixed(2);
                                    leon.list.sumGDJT[i].percent = (((leon.list.sumGDJT[i].ForAmt-leon.list.sumGDJT[i].ForAmt_Pre)
                                        /(leon.list.sumGDJT[i].ForAmt_Pre == 0 ?100:leon.list.sumGDJT[i].ForAmt_Pre))*100).toFixed(2);
                                    leon.list.sumGDJT[i].percentColor = leon.list.sumGDJT[i].percent < 0 ? '#07be00' : '#ff6259';


                                }
                                leon.dataComplete.push(params.dbChoose);
                                leon.lock = false
                                clearInterval(interval)
                            }
                        },300)
                    }else{
                        mui.hideLoading();
                        leon.list.summarizeList = summarize;
                    }
                    leon.view.targetNoData = false;
                    leon.view.echartsNoData = false;
                    return;
                } 
                //新增上海、柳凌、朗力苏州、彻丽
                if(params.SH == 'SH'){
                    this.getYUzh(res,check,summarize,params)
                    leon.list.JITUAN[jt] = summarize;
                    leon.list.JITUANNAME[jt] = leon.lang.SHANGHAI;
                    leon.list.TotalALL.SZ[jt] = summarize;
                }
                 if(params.LL == 'LL'){
                    this.getYUzh(res,check,summarize,params)
                    leon.list.JITUAN[jt] = summarize;
                    leon.list.JITUANNAME[jt] = leon.lang.LIULING;
                    leon.list.TotalALL.SZ[jt] = summarize;
                }
                 if(params.LLSZ == 'LLSZ'){
                    this.getYUzh(res,check,summarize,params)
                    leon.list.JITUAN[jt] = summarize;
                    leon.list.JITUANNAME[jt] = leon.lang.LLSZ;
                    leon.list.TotalALL.SZ[jt] = summarize;
                }
                 if(params.CL == 'CL'){
                    this.getYUzh(res,check,summarize,params)
                    leon.list.JITUAN[jt] = summarize;
                    leon.list.JITUANNAME[jt] = leon.lang.CHELI;
                    leon.list.TotalALL.QD[jt] = summarize;
                }
                   
                res.data.res.splice(0,1);
                
                for(var i in res.data.res){
                    
                    res.data.res[i].percent = (((res.data.res[i].ForAmt-res.data.res[i].ForAmt_Pre)/(res.data.res[i].ForAmt_Pre == 0 ?100:res.data.res[i].ForAmt_Pre))*100).toFixed(2);
                    res.data.res[i].ForAmt = parseFloat(parseFloat(res.data.res[i].ForAmt).toFixed(2));
                    res.data.res[i].ForAmt_Pre =  parseFloat(parseFloat(res.data.res[i].ForAmt_Pre).toFixed(2));
                    if(res.data.res[i].percent < 0){
                        res.data.res[i].percentColor = '#07be00';
                        res.data.res[i].percentMinuteColor = '#159a00';
                    }else{
                        res.data.res[i].percentColor = '#ff6259';
                        res.data.res[i].percentMinuteColor = '#e02a27';
                    }
                    if(res.data.res[i].Sort == 110){
                        res.data.res[i].name = leon.lang.orderResults;
                        summarize.push(res.data.res[i]);
                    }
                    else if(res.data.res[i].Sort == 210){
                        res.data.res[i].name = leon.lang.invoiceResults;
                        summarize.push(res.data.res[i]);
                    }
                    else if(res.data.res[i].Sort == 310){
                        res.data.res[i].name = leon.lang.billResults;
                        summarize.push(res.data.res[i]);
                    }
                    else if(res.data.res[i].Sort == 410){
                        res.data.res[i].name = leon.lang.receiptResults;
                        summarize.push(res.data.res[i]);
                    }
                    else if(res.data.res[i].Sort == 510){
                        res.data.res[i].name = leon.lang.MatOutAmt;
                        summarize.push(res.data.res[i]);
                    }
                    else if(res.data.res[i].Sort == 100){
                        sumData.order.ForAmt += res.data.res[i].ForAmt;
                        sumData.order.ForAmt_Pre += res.data.res[i].ForAmt_Pre;
                        if(res.data.res[i].ExternalGubnNm == 'External'){
                            sumExternal.order.ForAmt += res.data.res[i].ForAmt;
                            sumExternal.order.ForAmt_Pre += res.data.res[i].ForAmt_Pre;
                            orderList.external.push(res.data.res[i])
                        }else{
                            sumInternal.order.ForAmt += res.data.res[i].ForAmt;
                            sumInternal.order.ForAmt_Pre += res.data.res[i].ForAmt_Pre;
                            orderList.internal.push(res.data.res[i])
                        }
                    }
                    else if(res.data.res[i].Sort == 200){
                        sumData.invoice.ForAmt += res.data.res[i].ForAmt;
                        sumData.invoice.ForAmt_Pre += res.data.res[i].ForAmt_Pre;
                        if(res.data.res[i].ExternalGubnNm == 'External'){
                            sumExternal.invoice.ForAmt += res.data.res[i].ForAmt;
                            sumExternal.invoice.ForAmt_Pre += res.data.res[i].ForAmt_Pre;
                            invoiceList.external.push(res.data.res[i])
                        }else{
                            sumInternal.invoice.ForAmt += res.data.res[i].ForAmt;
                            sumInternal.invoice.ForAmt_Pre += res.data.res[i].ForAmt_Pre;
                            invoiceList.internal.push(res.data.res[i])
                        }
                    }
                    else if(res.data.res[i].Sort == 300){
                        sumData.bill.ForAmt += res.data.res[i].ForAmt;
                        sumData.bill.ForAmt_Pre += res.data.res[i].ForAmt_Pre;
                        if(res.data.res[i].ExternalGubnNm == 'External'){
                            sumExternal.bill.ForAmt += res.data.res[i].ForAmt;
                            sumExternal.bill.ForAmt_Pre += res.data.res[i].ForAmt_Pre;
                            billList.external.push(res.data.res[i])
                        }else{
                            sumInternal.bill.ForAmt += res.data.res[i].ForAmt;
                            sumInternal.bill.ForAmt_Pre += res.data.res[i].ForAmt_Pre;
                            billList.internal.push(res.data.res[i])
                        }
                    }
                    else if(res.data.res[i].Sort == 400){
                        sumData.receipt.ForAmt += res.data.res[i].ForAmt;
                        sumData.receipt.ForAmt_Pre += res.data.res[i].ForAmt_Pre;
                        if(res.data.res[i].ExternalGubnNm == 'External'){
                            sumExternal.receipt.ForAmt += res.data.res[i].ForAmt;
                            sumExternal.receipt.ForAmt_Pre += res.data.res[i].ForAmt_Pre;
                            receiptList.external.push(res.data.res[i])
                        }else{
                            sumInternal.receipt.ForAmt += res.data.res[i].ForAmt;
                            sumInternal.receipt.ForAmt_Pre += res.data.res[i].ForAmt_Pre;
                            receiptList.internal.push(res.data.res[i])
                        }
                    }
                    else if(res.data.res[i].Sort == 500){
                        sumData.invoicePro.ForAmt += res.data.res[i].ForAmt;
                        sumData.invoicePro.ForAmt_Pre += res.data.res[i].ForAmt_Pre;
                        if(res.data.res[i].ExternalGubnNm == 'External'){
                            sumExternal.invoicePro.ForAmt += res.data.res[i].ForAmt;
                            sumExternal.invoicePro.ForAmt_Pre += res.data.res[i].ForAmt_Pre;
                            invoiceProList.external.push(res.data.res[i])
                        }else{
                            sumInternal.invoicePro.ForAmt += res.data.res[i].ForAmt;
                            sumInternal.invoicePro.ForAmt_Pre += res.data.res[i].ForAmt_Pre;
                            invoiceProList.internal.push(res.data.res[i])
                        }
                    }
                }
     
                var switchData = function(sum){
                    sum.order.ForAmt = sum.order.ForAmt.toFixed(2);
                    sum.order.ForAmt_Pre = sum.order.ForAmt_Pre.toFixed(2);
                    sum.invoice.ForAmt = sum.invoice.ForAmt.toFixed(2);
                    sum.invoice.ForAmt_Pre = sum.invoice.ForAmt_Pre.toFixed(2);
                    sum.bill.ForAmt = sum.bill.ForAmt.toFixed(2);
                    sum.bill.ForAmt_Pre = sum.bill.ForAmt_Pre.toFixed(2);
                    sum.receipt.ForAmt = sum.receipt.ForAmt.toFixed(2);
                    sum.receipt.ForAmt_Pre = sum.receipt.ForAmt_Pre.toFixed(2);
                    sum.invoicePro.ForAmt = sum.invoicePro.ForAmt.toFixed(2);
                    sum.invoicePro.ForAmt_Pre = sum.invoicePro.ForAmt_Pre.toFixed(2);
                    sum.order.percent = ((sum.order.ForAmt - sum.order.ForAmt_Pre) / (sum.order.ForAmt_Pre == 0 ? 100:sum.order.ForAmt_Pre)*100).toFixed(2);
                    sum.invoice.percent = ((sum.invoice.ForAmt - sum.invoice.ForAmt_Pre) / (sum.invoice.ForAmt_Pre == 0 ? 100:sum.invoice.ForAmt_Pre)*100).toFixed(2);
                    sum.bill.percent = ((sum.bill.ForAmt - sum.bill.ForAmt_Pre) / (sum.bill.ForAmt_Pre == 0 ? 100:sum.bill.ForAmt_Pre)*100).toFixed(2);
                    sum.receipt.percent = ((sum.receipt.ForAmt - sum.receipt.ForAmt_Pre) / (sum.receipt.ForAmt_Pre == 0 ? 100:sum.receipt.ForAmt_Pre)*100).toFixed(2);
                    sum.invoicePro.percent = ((sum.invoicePro.ForAmt - sum.invoicePro.ForAmt_Pre) / (sum.invoicePro.ForAmt_Pre == 0 ? 100:sum.invoicePro.ForAmt_Pre)*100).toFixed(2);

                }
                
                switchData(sumExternal);
                switchData(sumInternal);
                switchData(sumData);
                //.当选择日单位，不显示去年信息
                // if(leon.nowDateItem == 3){
                //     for(var i in summarize){
                //         summarize[i].ForAmt_Pre = '-';
                //         summarize[i].percent = '0.00'
                //     }
                //     defaultData(sumData);
                //     defaultData(sumExternal);
                    // defaultData(sumInternal);
                //     defaultMinuteData(orderList);
                //     defaultMinuteData(invoiceList);
                //     defaultMinuteData(billList);
                //     defaultMinuteData(receiptList);
                //     defaultMinuteData(invoiceProList);
                // }
                
                leon.list.sumData = sumData;
                leon.list.sumExternal = sumExternal;
                leon.list.sumInternal = sumInternal;
                leon.list.orderList = orderList;
                leon.list.invoiceList = invoiceList;
                leon.list.billList = billList;
                leon.list.receiptList = receiptList;
                leon.list.invoiceProList = invoiceProList;

                //.当查询所有公司金额，则在原来金额上递增
                if(check == 'all'){
                    let interval = setInterval(intervals => {
                        //http是异步的，同时访问多个服务器，所以加写锁lock
                        if(leon.lock == false){
                            leon.lock = true
                            for(let i in summarize){
                                if (leon.list.summarizeList.hasOwnProperty(i) == false){
                                    leon.list.summarizeList.push({
                                        name:summarize[i].name,
                                        ForAmt:0,
                                        ForAmt_Pre:0
                                    });
                                }
                                leon.list.summarizeList[i].ForAmt = (parseFloat(summarize[i].ForAmt)
                                    + parseFloat(leon.list.summarizeList[i].ForAmt)).toFixed(2);
                                leon.list.summarizeList[i].ForAmt_Pre = (parseFloat(summarize[i].ForAmt_Pre)
                                    +  parseFloat(leon.list.summarizeList[i].ForAmt_Pre)).toFixed(2);
                                leon.list.summarizeList[i].percent = (((leon.list.summarizeList[i].ForAmt-leon.list.summarizeList[i].ForAmt_Pre)
                                    /(leon.list.summarizeList[i].ForAmt_Pre == 0 ?100:leon.list.summarizeList[i].ForAmt_Pre))*100).toFixed(2);
                                leon.list.summarizeList[i].percentColor = leon.list.summarizeList[i].percent < 0 ? '#07be00' : '#ff6259'
                            


                                if(params.dbChoose == 'SZ' || params.dbChoose == 'HS' ||params.SH == 'SH' ||params.LL == 'LL' ||params.LLSZ == 'LLSZ' ){
                                    if (leon.list.sumSZJT.hasOwnProperty(i) == false){
                                        leon.list.sumSZJT.push({
                                            name:summarize[i].name,
                                            ForAmt:0,
                                            ForAmt_Pre:0
                                        });
                                    }
                                    leon.list.sumSZJT[i].ForAmt = (parseFloat(summarize[i].ForAmt)
                                    + parseFloat(leon.list.sumSZJT[i].ForAmt)).toFixed(2);
                                    leon.list.sumSZJT[i].ForAmt_Pre = (parseFloat(summarize[i].ForAmt_Pre)
                                        +  parseFloat(leon.list.sumSZJT[i].ForAmt_Pre)).toFixed(2);
                                    leon.list.sumSZJT[i].percent = (((leon.list.sumSZJT[i].ForAmt-leon.list.sumSZJT[i].ForAmt_Pre)
                                        /(leon.list.sumSZJT[i].ForAmt_Pre == 0 ?100:leon.list.sumSZJT[i].ForAmt_Pre))*100).toFixed(2);
                                    leon.list.sumSZJT[i].percentColor = leon.list.sumSZJT[i].percent < 0 ? '#07be00' : '#ff6259'
                                }
                                 if(params.dbChoose == 'GD' ||params.dbChoose == 'XR'){
                                    if (leon.list.sumGDJT.hasOwnProperty(i) == false){
                                        leon.list.sumGDJT.push({
                                            name:summarize[i].name,
                                            ForAmt:0,
                                            ForAmt_Pre:0
                                        });
                                    }
                                    leon.list.sumGDJT[i].ForAmt = (parseFloat(summarize[i].ForAmt)
                                    + parseFloat(leon.list.sumGDJT[i].ForAmt)).toFixed(2);
                                    leon.list.sumGDJT[i].ForAmt_Pre = (parseFloat(summarize[i].ForAmt_Pre)
                                        +  parseFloat(leon.list.sumGDJT[i].ForAmt_Pre)).toFixed(2);
                                    leon.list.sumGDJT[i].percent = (((leon.list.sumGDJT[i].ForAmt-leon.list.sumGDJT[i].ForAmt_Pre)
                                        /(leon.list.sumGDJT[i].ForAmt_Pre == 0 ?100:leon.list.sumGDJT[i].ForAmt_Pre))*100).toFixed(2);
                                    leon.list.sumGDJT[i].percentColor = leon.list.sumGDJT[i].percent < 0 ? '#07be00' : '#ff6259'
                                }
                                if(params.dbChoose == 'QD' || params.CL == 'CL'){
                                    if (leon.list.sumQDJT.hasOwnProperty(i) == false){
                                        leon.list.sumQDJT.push({
                                            name:summarize[i].name,
                                            ForAmt:0,
                                            ForAmt_Pre:0
                                        });
                                    }
                                    
                                    leon.list.sumQDJT[i].ForAmt = (parseFloat(summarize[i].ForAmt)
                                    + parseFloat(leon.list.sumQDJT[i].ForAmt)).toFixed(2);
                                    leon.list.sumQDJT[i].ForAmt_Pre = (parseFloat(summarize[i].ForAmt_Pre)
                                        +  parseFloat(leon.list.sumQDJT[i].ForAmt_Pre)).toFixed(2);
                                    leon.list.sumQDJT[i].percent = (((leon.list.sumQDJT[i].ForAmt-leon.list.sumQDJT[i].ForAmt_Pre)
                                        /(leon.list.sumQDJT[i].ForAmt_Pre == 0 ?100:leon.list.sumQDJT[i].ForAmt_Pre))*100).toFixed(2);
                                    leon.list.sumQDJT[i].percentColor = leon.list.sumQDJT[i].percent < 0 ? '#07be00' : '#ff6259'
                                }


                            }
                            leon.dataComplete.push(params.dbChoose);
                            leon.lock = false
                            clearInterval(interval)
                        }
                    },300)
                }else{
                    mui.hideLoading();
                    leon.list.summarizeList = summarize;
                }
                
                if(params.dbChoose == 'SZ'){
                    leon.list.JITUAN[jt] = summarize;
                    leon.list.JITUANNAME[jt] = leon.lang.SUZHOU;
                    leon.list.TotalALL.SZ[jt] = summarize;

                }
                if(params.dbChoose == 'GD'){
                    leon.list.JITUAN[jt] = summarize;
                    leon.list.JITUANNAME[jt] = leon.lang.GUANGDONG;
                    leon.list.TotalALL.GD[jt] = summarize;

                }
                if(params.dbChoose == 'QD'){
                    leon.list.JITUAN[jt] = summarize;
                    leon.list.JITUANNAME[jt] = leon.lang.QINGDAO;
                    leon.list.TotalALL.QD[jt] = summarize;
                }
                if(params.dbChoose == 'HS'){
                    leon.list.JITUAN[jt] = summarize;
                    leon.list.JITUANNAME[jt] = leon.lang.HANS;
                    leon.list.TotalALL.SZ[jt] = summarize;
                }
                if(params.dbChoose == 'XR'){
                    leon.list.JITUAN[jt] = summarize;
                    leon.list.JITUANNAME[jt] = leon.lang.XIANRUI;
                    leon.list.TotalALL.GD[jt] = summarize;
                }
        
                leon.view.targetNoData = false;
                leon.view.echartsNoData = false;
                // leon.getResultsMinute(0);

            });
        },
        getYUzh(res,check,summarize,params){
            summarize.push({
                name:leon.lang.orderResults,
                ForAmt:parseFloat(res.data.orderList.ForAmt/10000).toFixed(2),
                ForAmt_Pre:parseFloat(res.data.orderList.ForAmt_Pre/10000).toFixed(2),
                percent:parseFloat(res.data.orderList.percent).toFixed(2),
                percentColor: res.data.orderList.percentColor
            });

            summarize.push({
                name:leon.lang.invoiceResults,
                ForAmt:parseFloat(res.data.invoiceList.ForAmt/10000).toFixed(2),
                ForAmt_Pre:parseFloat(res.data.invoiceList.ForAmt_Pre/10000).toFixed(2),
                percent:parseFloat(res.data.invoiceList.percent).toFixed(2),
                percentColor: res.data.invoiceList.percentColor
            });
            summarize.push({
                name:leon.lang.billResults,
                ForAmt:parseFloat(res.data.billList.ForAmt/10000).toFixed(2),
                ForAmt_Pre:parseFloat(res.data.billList.ForAmt_Pre/10000).toFixed(2),
                percent:parseFloat(res.data.billList.percent).toFixed(2),
                percentColor: res.data.billList.percentColor
            });
            summarize.push({
                name:leon.lang.receiptResults,
                ForAmt:parseFloat(res.data.receiptList.ForAmt/10000).toFixed(2),
                ForAmt_Pre:parseFloat(res.data.receiptList.ForAmt_Pre/10000).toFixed(2),
                percent:parseFloat(res.data.receiptList.percent).toFixed(2),
                percentColor: res.data.receiptList.percentColor
            });
            summarize.push({
                name:leon.lang.MatOutAmt,
                ForAmt:parseFloat(res.data.invoiceProList.ForAmt/10000).toFixed(2),
                ForAmt_Pre:parseFloat(res.data.invoiceProList.ForAmt_Pre/10000).toFixed(2),
                percent:parseFloat(res.data.invoiceProList.percent).toFixed(2),
                percentColor: res.data.invoiceProList.percentColor
            });

     
            leon.view.targetNoData = false;
            leon.view.echartsNoData = false;
            return;

        }
    }
});

function onlyNum() {
    if(!(event.keyCode==46)&&!(event.keyCode==8)&&!(event.keyCode==37)&&!(event.keyCode==39))
        if(!((event.keyCode>=48&&event.keyCode<=57)||(event.keyCode>=96&&event.keyCode<=105)))
            event.returnValue=false;
}
// if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
//     FastClick.prototype.focus = function(targetElement) {
//         targetElement.focus();
//     };
//     FastClick.attach(document.body);
// }
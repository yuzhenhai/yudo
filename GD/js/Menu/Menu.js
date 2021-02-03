var menuPageCss = {
    'mui-table-view-cell':true,
    'mui-collapse':true
}

function getVersion() {
    // IOS Version 호출
    if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
        webkit.messageHandlers.jmobile.postMessage({fn: "getVersion"});
    }
    // Android Version 호출
    else if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.Android) {
        if (window.JMobile)	window.JMobile.getVersion();
    }
}

function setVersion(version) {
    //.客户端强制更新,最低版本封锁
    if(version < 2.2){
        mui.alert("1.APP内核升级，大幅度提升程序速度\r\n" +
            "2.解决iphone打开AS接受界面速度过慢问题\r\n" +
            "3.新增报价单模块\r\n"+
            "注:本次更新需要删除当前版本，重新下载最新APP"
            ,'YUDO Mobile ERP 2.2.0',function (res) {
                // setVersion(0)
            });
    }
}
//维护系统中...
function defend() {
    mui.alert("系统维护中，维护时间7.9 16:00-18:00,期间APP无法使用，请稍后重启APP"
        ,'YUDO Mobile ERP',function (res) {
            defend();
        });
}
var leon = new Vue({
    el:'#leon',
    delimiters: ['$((', '))'],
    data:{
        css:{
            menuPageOpen:{
                'mui-table-view-cell':true,
                'mui-collapse':true,
                'mui-active':true,
            },
            menuPageClose:{
                'mui-table-view-cell':true,
                'mui-collapse':true
            },
            menuPage:[menuPageCss,menuPageCss,menuPageCss]
        },
        view:{
            admin:false,
            yudoImage:server.menuPic,
            trans:false,
            serverId:server.serverNm,
            version:'',
            downLoadScript:true,
        },
        lang:{
            project1:'经营信息',
            project2:'销售管理',
            project3:'销售业务',
            menu:'主菜单',
            changePassWd:'修改密码',
            connectRecord:'访问记录',
            logout:'注销',
            userNm:'账号',
        },
        input:{
            userLoginId:'',//用户登录账号
            userId:'',//用户工号
            userNm:'',
            groupId:'',
            groupNm:'',
        },
        list:{
            manageInfo:[],//经营信息
            salesManage:[],//销售管理
            asManage:[],//销售业务
            connectHistory:[],//最近访问
        }
    },
    filters: {

    },
    mounted(){
        //.多语言加载
        var lang = multi.getLocalStorage('langCode');
        if(!lang) lang = 'CHN';
        multi.buildLang(lang,function () {
            try{
                langCode.method = 'cache';
                langCode.getWord({
                        project1:'W2018013116530787097',
                        project2:'W2018013116563319329',
                        project3:'W2018013117025791081',
                        recentlyUse:'W2019091614303253460',
                        connectRecord:'W2019091615250222897',
                        cleaning:'W2019091615250266205',
                        cleanSuccess:'W2019091615250266187',
                        menu:'W2018071009230638074',
                        changePassWd:'W2019022114573658056',
                        clearCache:'W2019071117215842091',
                        logout:'W2019022114575111051',
                        userNm:'W2019022115044912045',
                    }, this.lang,this._updateLang
                );
            }catch (e) {
                mui.alert('language load error!',this.title);
            }
        }.bind(this));
        try {
            //.模块访问记录加载
            var connectHistory = multi.getLocalStorage('connetHistory');
            if (connectHistory != false) {
                this.list.connectHistory = connectHistory;
            }

            //.菜单上一次打开项加载
            // this.changeMenuPage();

            //.首次打开APP获取系统定位权限
            if (multi.getLocalStorage('gpsPermission') == false) {
                if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
                    try {
                        webkit.messageHandlers.jmobile.postMessage({fn: "getLocation"});
                    } catch (e) {}
                } else if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.Android) {
                    if (window.JMobile) window.JMobile.getLocation();
                }
                multi.setLocalStorage('gpsPermission', true);
            }
        }catch(e){
            mui.alert('localStorage error,请下载最新版本app',this.title);
        }
    },
    methods:{
        _updateLang:function(){
            this.view.downLoadScript = false;
            this.view.serverId = server.serverNm;
            http.get('/Menu/getVersionInfo',{},function (res) {
                if(!multi.getLocalStorage('version') || multi.getLocalStorage('version') < res.returnClass){
                    var nc = '';
                    for(var i in res.data){
                        nc += res.data[i]+'</br>';
                    }
                    mui.alert(nc,'最近更新提示');
                    try{
                        multi.setLocalStorage('version',res.returnClass);
                    }catch (e) {

                    }
                }
            })
        },
        showUserMenu:function () {
            console.log('open');
            mui('.mui-off-canvas-wrap').offCanvas('show');
        },
        closeUserMenu:function(){
            console.log('close');
            mui('.mui-off-canvas-wrap').offCanvas('close');
        },
        getLoginInfo:function(isAction){
            if(isAction == true) mui.showLoading();
            http.get('/Menu/getLoginInfo',{},res => {
                leon.input.userId = res.data.EmpID;
                leon.input.userNm = res.data.EmpNm;
                leon.input.groupId = res.data.DeptCd;
                leon.input.groupNm = res.data.DeptNm;
                leon.input.userLoginId = res.data.userLoginId;
                if(res.data.userLoginId == 'M2015011'){
                    this.view.admin = true;
                }
                mui.hideLoading();
            })
        },
        getMenus:function () {
            mui.showLoading('loading...','div');
            var params = {};
            params.formKey = 'Menu';
            http.get('/Menu/doMenuRows_prc',params,function (res) {
                var filter = function (data) {
                    var list = [];
                    var listR = [];
                    for(var i=0;i<data.length;i++){
                        if(listR.length >= 3){
                            list.push(listR);
                            listR = [];
                        }
                        listR.push(data[i])
                        if(data.length == i+1){
                            list.push(listR);
                        }
                    }
                    return list;
                }
                if(res.returnCode == 0){
                    leon.list.asManage = filter(res.data.ASManage);
                    leon.list.salesManage = filter(res.data.SalesManage);
                    leon.list.manageInfo = filter(res.data.ManageInfo);
                }else{
                    mui.alert('没有使用权限','YUDO Mobile ERP');
                }
                mui.hideLoading();
                leon.getLoginInfo();
            })
        },
        logout:function(){
            this.view.downLoadScript = true;
            var browserPathName = window.location.pathname;
            var pathArr = browserPathName.split('/');
            var formData = {
                workType: 'CLOSE',
                formID: pathArr[(pathArr.length - 1)],
                formName: jq('.top_header').text(),
                formKey: jq("#form_key").val(),
                path: ''
            };
            http.post('/main/logout_prc',formData,function (res) {
                if (res.returnCode == 0) {
                    location.href = '/?deviceType=' + JLAMP.common.getDeviceType() + '&devicePlatform=' + JLAMP.common.getDevicePlatform();
                } else {
                    if (res.returnMsg) {
                        var msg = res.returnMsg;
                        msg = msg.replace(/\\n/g,'\n');
                        mui.alert( msg,'YUDO');
                    }
                }
            },function (res) {
                mui.alert('注销账户过程中出现错误，请稍后再试','YUDO');
            });
        },
        cleanCache:function(){
            this.closeUserMenu();
            mui.showLoading(this.lang.cleaning+'...',title);
            setTimeout(function () {
                mui.hideLoading();
                mui.toast(this.lang.cleanSuccess,{ duration:'long', type:'div' })
            },3000);
        },
        connectRecord:function(){
            this.closeUserMenu();
            this.view.downLoadScript = true;
            jq('#centerControl').remove();
            setTimeout(function () {
                location.href='/Menu/ConnectRecord';
            },200)
        },
        gotoChangePassWd:function(){
            this.closeUserMenu();
            this.view.downLoadScript = true;
            jq('#centerControl').remove();
            setTimeout(function () {
                location.href='/Menu/ChangePassWd';
            },200)
        },
        gotoModule:function (url,modal) {
            if(this.list.connectHistory.length > 0){
                for (let i=0;i<this.list.connectHistory.length;i++){
                    if(this.list.connectHistory[i].icon == modal.icon){
                        this.list.connectHistory.splice(i,1);
                    }
                }
                if(this.list.connectHistory.length >= 3){
                    this.list.connectHistory.splice(2,10);
                }
            }
            this.list.connectHistory.unshift(modal);
            multi.setLocalStorage('connetHistory',this.list.connectHistory)
            this.view.trans = true;
            setTimeout(function () {
                jq('#main').addClass('yudo-window-main animated fadeOutLeft trans-1');
            },50);
            // this.view.trans = true;
            setTimeout(function () {
                jq('#leon').remove();
                location.href=url;
            },400)
        },
        clickMenuPage:function(index){
            var index = {index:index};
            multi.setLocalStorage('menuPageIndex',index);
        },
        changeMenuPage:function () {
            var menuPageIndex = multi.getLocalStorage('menuPageIndex');
            if(menuPageIndex == false){
                return false;
            }
            for(var i in this.css.menuPage){
                this.css.menuPage[i] = this.css.menuPageClose;
            }
            this.css.menuPage[menuPageIndex.index] = this.css.menuPageOpen;
        }
    }
});
leon.getMenus();
var gallery = mui('.mui-slider');
gallery.slider({
    interval:5000//自动轮播周期，若为0则不自动播放，默认为0；
});


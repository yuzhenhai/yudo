var m_marginSize = 2;
var police = 0;
var login_username = '';
var login_userid = '';
var login_groupname = '';
var login_groupid = '';
var userlists = '';
var userpages = 100;
var mtpages = 0;
var mtfind = 0;
var mtfindopen = 0;
var lang = {};
jq.fn.extend({
    animateCss: function (animationName) {
        var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        jq(this).addClass('animated ' + animationName).one(animationEnd, function() {
            jq(this).removeClass('animated ' + animationName);
        });
    }
});

langCode.method = 'cache';
langCode.getWord({
        orderNo:'W2018041913141737708',
        custNm:'W2018041913134073778',
        orderDate:'W2018041913163666042',
        delvDate:'W2018062810315076351',
        empNm:'W2018041913373764065',
        deptNm:'W2018041913371894064',
    var alertlog_7  = JLAMP.lang.getWord('W2018050317425557008'); //图片删除成功
var alertlog_8  = JLAMP.lang.getWord('W2018050317431147027'); //图片删除失败
var alertlog_9  = JLAMP.lang.getWord('W2018050317424506732'); //确定要删除此照片么
var alertlog_1  = JLAMP.lang.getWord('W2018050317410722361'); //请先保存组装信息
jq('#AS_add').text(JLAMP.lang.getWord('W2018061209080660794'));
jq('#AS_query').text(JLAMP.lang.getWord('W2018061209082525327'));
jq('#backmenu').val(JLAMP.lang.getWord('W2018061209091773749'));
jq("#btn_uploads").val(JLAMP.lang.getWord('W2007072616270984075'));
jq("#btn_menu_lists").val(JLAMP.lang.getWord('W2018020109110962726'));
},lang,_updateLang
)

function _updateLang(res){

}

jq(document).ready(function() {
    //lang
    var alertlog_1  = JLAMP.lang.getWord('W2018050317410722361'); //请先保存组装信息
    jq('#AS_add').text(JLAMP.lang.getWord('W2018061209080660794'));
    jq('#AS_query').text(JLAMP.lang.getWord('W2018061209082525327'));
    jq('#backmenu').val(JLAMP.lang.getWord('W2018061209091773749'));

    // Bootstrap DatePicker
    jq("#mt_talk_date,#mt_date,#test_date").datetimepicker({
		language: m_commCultureType,
		format: "yyyy-mm-dd",
		inputFormat:  "yyyy-mm-dd",
		autoclose: true,
		startView: JLAMP.datetimepicker.viewType.DAY,
		minView: JLAMP.datetimepicker.viewType.DAY,
		maxView: JLAMP.datetimepicker.viewType.YEAR,
		keyboardNavigation: true,
		viewSelect: 'month',
		pickerPosition: "bottom-right"
    });
    getloginuser();
    default_queryuser();
    jq("#mt_talk_date").focus(function(){
        document.activeElement.blur();
    });
    jq("#mt_date").focus(function(){
        document.activeElement.blur();
    });
    jq("#test_date").focus(function(){
        document.activeElement.blur();
    });
    // jq('#police').css('height',jq('body').height()+'px');
    document.getElementById("mySwitch").addEventListener("toggle",function(event){
        if(event.detail.isActive){
            confirm('CA');
        }else{
            confirm('CD');
        }
    })
    jq('#up_test_photo').click(function () {
        if(jq('#mt_id').val() == '') {mui.alert(alertlog_1,'YUDO ERP APP'); return false;}
        if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
            checkfile('test');
        }
        else
        {
            checkfile('test');
            //mui('#sheet_test').popover('toggle');
        }
    });
    jq('#up_mt_photo').click(function () {
        if(jq('#mt_id').val() == '') {mui.alert(alertlog_1,'YUDO ERP APP'); return false;}
        if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
            checkfile('mt')
        }
        else
        {
            checkfile('mt');
            // mui('#sheet_mt').popover('toggle');
        }
    });
    jq('#take_photo').click(function () {
        if(police ==1) {return false;}
        if(JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS){
            location.href = 'jmobile://getCamera';
        }
    });

    // jq('#mt_choose_photo').click(function () {
    //     checkfile('mt');
    // });
    // jq('#test_choose_photo').click(function () {
    //     checkfile('test');
    // });
    jq('#order_list').click(function () {
        orderlist('open');
    });

    jq('#find-window-top').click(function () {
        orderlist('close');
    });
    jq('#find-sales-user-top').click(function () {
        saleslist('close');
    })


    jq('#user_list').click(function () {   //组装人员查询
        if(police ==1) {return false;}
        userlist('open','test');
    });

    jq('#user_list1').click(function () {  //试模人员查询
        if(police ==1) {return false;}
        userlist('open','mt');
    });

    jq('#find-window-user-top').click(function () {
        if(police ==1) {return false;}
        userlist('close');
    });

    jq('#find-order').click(function () {
        doSearch('search',0);
    })
    jq('#find-users').click(function () {
        if(police ==1) {return false;}
        queryuser();
    })
    // //금일날짜 세팅
    var date = new Date();
    jq("#mt_talk_date,#mt_date,#test_date").datetimepicker("setDate", date);

    // jq("#lang_code").kendoDropDownList();

    setListWidth();
    jq("#btn_uploads").click(function() {
        doUpload()
    });
    // 리스트 버튼 클릭 이벤트
    jq("#btn_menu_lists").click(function() {
		location.href='/Menu/Menu/menuLists?formKey='+jq("#form_key").val()+'&menuSelection='+jq("#menu_selection").val();
    });
    jq("#backmenu").click(function() {
        location.href='/Menu/Menu/menuLists?formKey='+jq("#form_key").val()+'&menuSelection='+jq("#menu_selection").val();
    });


	jq("#btn_uploads").val(JLAMP.lang.getWord('W2007072616270984075'));
	jq("#btn_menu_lists").val(JLAMP.lang.getWord('W2018020109110962726'));
	jq("#base_date").keyup(function() {
		JLAMP.common.repNumberKey(this,'');
		if (jq("#base_date").val().length >4 && jq("#base_date").val().length <= 6) {
			jq("#base_date").val(jq("#base_date").val().substring(0,4)+'-'+jq("#base_date").val().substring(4,6));
		} else if (jq("#base_date").val().length >6) { 
			jq("#base_date").val(jq("#base_date").val().substring(0,4)+'-'+jq("#base_date").val().substring(4,6)+'-'+jq("#base_date").val().substring(6,8));
		}
	});
    // FastClick.prototype.focus = function(targetElement) {
    //     targetElement.focus();
    // };
    // jq(function() {
    //     FastClick.attach(document.body);
    // });
    jq('#mtorder-list').scroll(function(){
        var sl=this.scrollLeft;
        jq('#mttrans').scrollLeft(sl);
    });
    jq('#order-list').scroll(function(){
        var sl=this.scrollLeft;
        jq('#ordertrans').scrollLeft(sl);
    });
    jq('#user-list').scroll(function(){
        var sl=this.scrollLeft;
        jq('#userstrans').scrollLeft(sl);
    });
    jq('#sales-list').scroll(function(){
        var sl=this.scrollLeft;
        jq('#salestrans').scrollLeft(sl);
    });
    jq('#downLoadScript').remove();

});
function doBack() {

    window.history.back();  //返回上一页
}

function confirm(cfm) {
    var alertlog_1 = JLAMP.lang.getWord('W2018050317410722361');
    if(jq('#mt_id').val() == '') {mui.alert(alertlog_1,'YUDO ERP APP'); return false;}
    var mt_id = jq('#mt_id').val();
    jq.ajax({
        url: '/WEI_2000/WEI_2000/confirm',
        data: {
            mt_id:mt_id,
            cfm:cfm,
        },
        type: 'get',
        dataType: 'json',
        success: function (res, status, xhr) {
            console.log(res);
                if(res.returnClass == 'OM00000023'){ //确定成功
                    police = 1;
                    jq('#mySwitch').addClass('mui-active');
                }
                if(res.returnClass == 'OM00000030'){ //取消成功
                    police = 0;
                    jq('#mySwitch').removeClass('mui-active');
                }
                mui.alert(res.data,'YUDO ERP APP');
        }
    })
}

function getloginuser() {
    jq.ajax({
        url: '/WEI_2000/WEI_2000/login_user',
        type: 'get',
        dataType: 'json',
        success: function(res, status, xhr) {
            login_userid = res.data.userid;
            login_username = res.data.username;
            login_groupid = res.data.groupid;
            login_groupname = res.data.groupname;
            console.log(res.data);
        }
    });
}
function default_queryuser() {
    jq.ajax({
        url: '/WEI_2000/WEI_2000/user_prc',
        type: 'get',
        dataType: 'json',
        success: function (res, status, xhr) {
            console.log(res);
            var yin = "'";
            var html = '';
            if (res.returnCode == 0) {
                userlists = res.data[0];
            }
        },
        error: function(xhr, status, error) {
            mui.alert('internet error','YUDO ERP APP');
        }
    });
}
function orderlist(check) {
    if(check == 'open'){
        jq('#loadding').hide();
        jq('#find-window').show();
        jq('.leon').hide();
        window.scrollTo(0,0);
    }
    else
    {
        jq('.leon').show();
        jq('#find-order-list').html('');
        jq("#find-window").hide();
        window.scrollTo(0,0);
    }
}
function userlist(check,alt) {
    if(check == 'open'){
        jq('#this_group').val(login_groupname);
        jq('#find-window-user').attr('alt',alt);
        jq('#find-window-user').show();
        jq('.leon').hide();
        window.scrollTo(0,0);
    }
    else
    {
        jq('#loadding-user').remove();
        userpages = 100;
        var checkdom = jq('#find-window-user').attr('alt') + '_user';
        jq('.leon').show();
        jq('#find-user-list').html('');
        jq('#find-window-user').attr('alt','');
        jq("#find-window-user").hide();
        window.scrollTo(0,jq('#'+checkdom).offset().top-200);

    }
}
//新增组装试模报告
function newMtProject() {
    clearAllDate('new');
    slideShow();
    menuHide();
}
//通过组装查询打开主界面
function mtfindToSlide() {
    menuHide();
    findMtHide();
    slideShow();
    mtfindopen = 1;
}
//主界面返回组装查询
function slideToMtfind() {
    slideHide();
    findMtShow();
    mtfindopen = 0;
}
//主界面返回按钮逻辑
function rmMtProject() {
    if(mtfindopen == 1){
        slideToMtfind()
    }
    else
    {
        slideHide();
        menuShow();
    }

}
function newMtQuery() {
    menuHide();
    findMtShow();
}
function rmMtQuery() {
    menuShow();
    findMtHide();
}

function menuShow() {
    jq('#menu').show();
}
function menuHide() {
    jq('#menu').hide() ;
}
function slideShow() {
    jq('.leon').show();
}
function slideHide() {
    jq('.leon').hide();
}
function findMtShow() {
    jq('#find-mt').show();
}
function findMtHide() {
    jq('#find-mt').hide();
}
function saleslist(check) {
    if(police ==1) {return false;}
    if(check == 'open'){
        jq('#sales_group').val(login_groupname);
        jq('#find-sales-user').show();
        jq('.leon').hide();
        window.scrollTo(0,0);
    }
    else
    {
        jq('#loadding-sales').remove();
        userpages = 100;
        jq('.leon').show();
        jq('#find-sales-list').html('');
        jq("#find-sales-user").hide();
        window.scrollTo(0,jq('#opensales').offset().top-100);
    }
}
//扫描二维码
function QRcode() {
    if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
        location.href = 'jmobile://getQRcode';
    }
    if(JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.Android)
    {
        if(window.JMobile) window.JMobile.getQRcode();
    }
}
function checkfile(check){
    switch (check){
        case 'mt':
            mui('#sheet_mt').popover('hide');
            jq("#mt_upimg").trigger("click");
            // if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
            //     jq("#mt_upimg").trigger("click");
            // }
            break;
        case 'test':
            mui('#sheet_test').popover('hide');
            jq("#test_upimg").trigger("click");
            // if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
            //     jq("#test_upimg").trigger("click");
            // }
            break;
    }
}
function delSales(as,userid,Seq){
    if(police ==1) {return false;}
    var alertlog_2  = JLAMP.lang.getWord('W2018050317413004096'); //删除成功
    var alertlog_3  = JLAMP.lang.getWord('W2018050317414286702'); //删除失败
    var alertlog_101 = JLAMP.lang.getWord('W2018050410472916349'); //确定要删除么
    var btnArray = ['YES', 'NO'];
    mui.confirm(alertlog_101, 'YUDO ERP APP', btnArray, function(es) {
        if (es.index == 1) {
            return false;
        }
        else
        {
            var mtid = jq('#mt_id').val();
            jq.ajax({
                url: '/WEI_2000/WEI_2000/del_sales',
                data: {
                    mt_id: mtid,            //组装号
                    sales: userid,          //销售人id
                    Seq:Seq
                },
                type: 'post',
                dataType: 'json',
                success: function (res, status, xhr) {
                    console.log(res);
                    if(res.returnCode == 'Y002')
                    {

                        displayAssm(jq('#order_id').val(),'control');
                        setTimeout( function(){
                            mui.alert(alertlog_2,'YUDO ERP APP');
                        }, 1000 );
                    }
                    if(res.returnCode == 'I009')
                    {
                        displayAssm(jq('#order_id').val(),'control');
                        setTimeout( function(){
                            mui.alert(alertlog_3,'YUDO ERP APP');
                        }, 1000 );
                    }
                }
            });
        }
    });
}
//导入负责人信息
function upload_sales(){
    if(police ==1) {return false;}
    var alertlog_101 = JLAMP.lang.getWord('W2018050410474726098');
    var alertlog_102 = JLAMP.lang.getWord('W2018050410475738795');
    var alertlog_103 = JLAMP.lang.getWord('W2018050410481052775');
    var alertlog_104 = JLAMP.lang.getWord('W2018050410482720777');
    var alertlog_105 = JLAMP.lang.getWord('W2018050410484630372');
    var check = 0;
    var list = '';
    if(jq('#order_id').val() == '') {mui.alert(JLAMP.lang.getWord('W2018050317432047312'),'YUDO ERP APP'); return false;}
    if(jq('#mt_id').val() == '') {mui.alert(JLAMP.lang.getWord('W2018050317410722361'),'YUDO ERP APP'); return false;}
    if(jq("input[name='mui_checkbox']:checked").length > 5)
    {
        mui.alert(alertlog_101,'YUDO ERP APP');
        return false;
    }
    if(jq("input[name='mui_checkbox']:checked").length <= 0)
    {
        mui.alert(alertlog_102,'YUDO ERP APP');
        return false;
    }
    jq("input[name='mui_checkbox']").each(function(){
        if(jq(this).is(":checked"))
        {
            if(check == 1)
            {
                return false;
            }
            var onesaleNm = jq(this).attr('alt');
            var onesaleId = jq(this).parents('tr').attr('alt');
            jq("td[name='now_sales']").each(function() {
                if(jq(this).text() == onesaleNm)
                {
                    mui.alert(alertlog_103,'YUDO ERP APP');
                    check = 1;
                    return false;
                }
            });
            list += onesaleId+'[#*#]';
        }
    });
    if(check == 1)
    {
        return false;
    }

    mui.showLoading('loading','div');
    var mt_id = jq('#mt_id').val();;
    jq.ajax({
        url: '/WEI_2000/WEI_2000/save_sales',
        data: {
            mt_id: mt_id,   //组装号
            sales: list,          //用户Id
        },
        type: 'post',
        dataType: 'json',
        success: function (res, status, xhr) {
            console.log(res);
            if(res.returnCode == 'I008')
            {
                displayAssm(jq('#order_id').val(),'control');
                setTimeout( function(){
                    mui.alert(alertlog_105,'YUDO ERP APP')
                },1000 );
            }
            if(res.returnCode == 'Y001')
            {

                displayAssm(jq('#order_id').val(),'control');
                setTimeout( function(){
                    mui.alert(alertlog_104,'YUDO ERP APP')
                },1000 );
            }
        },
        error: function(xhr, status, error) {
            // iOS에서 네트워크 에러인 경우 에러 페이지 표시
            if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS && xhr.status == 0) {
                location.href = "jmobile://callErrorPage";
            } else
                alert(error);
        },
        complete: function(xhr, status) {
            mui.hideLoading();
            saleslist('close');
            JLAMP.common.mergeRows('.basic_table', 0, 1);
            jq('#chart').html('<img style="margin:40px; 0" src="/image/no_chart.png">');
            jq("#list_html tr:first-child").click();
        }
    });
}
//上传组装照片
function uploadPic_mt(){

    uploadrecall('mt_photo',0,'sheet_mt');
}
//上传试模照片
function uploadPic_test(){
    uploadrecall('test_photo',1,'sheet_test');
}
function uploadrecall(DOM,num,MuiDom) {
    var alertlog_4  = JLAMP.lang.getWord('W2018050317421802088'); //图片保存成功
    var alertlog_5  = JLAMP.lang.getWord('W2018050317422725336'); //图片保存失败
    var alertlog_6  = JLAMP.lang.getWord('W2018050317423587324'); //图片上传失败
    var mt_id = jq('#mt_id').val();
    var yin = "'";
    mui.showLoading('loading','div');
    var formData = new FormData();
    if(jq('input[name=file]')[num].files.length > 5){
        mui.hideLoading();
        mui.alert('一次最多上传5张照片','YUDO ERP APP');
        return false
    }
    for(var i = 0; i < jq('input[name=file]')[num].files.length;i++){
        formData.append('file'+i, jq('input[name=file]')[num].files[i]);
    }
    jq.ajax({
        url: '/WEI_2000/WEI_2000/upload_photo?mtid='+mt_id+'&check='+DOM,
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        cache: false,
        dataType: 'json',
        success: function (data) {
            console.log(data);
            if(data.returnCode == 'Y001'){
                mui.alert(alertlog_4,'YUDO ERP APP');
                displayAssm(jq('#order_id').val(),'control');
            }
            if(data.returnCode == 'I008'){
                mui.alert(alertlog_5,'YUDO ERP APP');
                displayAssm(jq('#order_id').val(),'control');
            }
        },
        error: function(xhr, status, error) {
            // iOS에서 네트워크 에러인 경우 에러 페이지 표시
            mui.alert(alertlog_6,'YUDO ERP APP');

        },
        complete: function(xhr, status) {
            mui.hideLoading();
            JLAMP.common.mergeRows('.basic_table', 0, 1);
            jq('#chart').html('<img style="margin:40px; 0" src="/image/no_chart.png">');
            jq("#list_html tr:first-child").click();
        }
    });
}
function delphoto(i,photo,seq,dom) {
    var alertlog_7  = JLAMP.lang.getWord('W2018050317425557008'); //图片删除成功
    var alertlog_8  = JLAMP.lang.getWord('W2018050317431147027'); //图片删除失败
    var alertlog_9  = JLAMP.lang.getWord('W2018050317424506732'); //确定要删除此照片么
    var mt_id = jq('#mt_id').val();
    var btnArray = ['YES', 'NO'];
    mui.confirm(alertlog_9, 'YUDO ERP APP', btnArray, function(es) {
        if (es.index == 0) {
            jq.ajax({
                url: '/WEI_2000/WEI_2000/del_photo',
                data: {
                    mt_id:mt_id,
                    seq: seq,
                    photo:photo,
                    dom:dom
                },
                type: 'post',
                dataType: 'json',
                success: function (res, status, xhr) {
                    console.log(res);
                    if(res.returnCode == 'Y002')
                    {
                        mui.alert(alertlog_7,'YUDO ERP APP');
                        displayAssm(jq('#order_id').val(),'control');
                        // jq(i).parents('tr').remove();
                    }
                    if(res.returnCode == 'I009')
                    {
                        mui.alert(alertlog_8,'YUDO ERP APP');
                        displayAssm(jq('#order_id').val(),'control');
                    }


                },
                error: function(xhr, status, error) {
                    // iOS에서 네트워크 에러인 경우 에러 페이지 표시
                    if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS && xhr.status == 0) {
                        location.href = "jmobile://callErrorPage";
                    } else
                        alert(error);
                },
                complete: function(xhr, status) {
                    mui.hideLoading();

                    JLAMP.common.mergeRows('.basic_table', 0, 1);

                    jq('#chart').html('<img style="margin:40px; 0" src="/image/no_chart.png">');
                    jq("#list_html tr:first-child").click();
                }
            });
        }
    });
}
function doUpload(){
    var alertlog_10 = JLAMP.lang.getWord('W2018050317432047312'); //请导入您的订单号
    var alertlog_11 = JLAMP.lang.getWord('W2018050317433187783'); //请填写组装报告信息
    var alertlog_12 = JLAMP.lang.getWord('W2018050317435474373'); //确定要保存么？
    var alertlog_13 = JLAMP.lang.getWord('W2018050317440350711'); //保存成功
    var alertlog_14 = JLAMP.lang.getWord('W2018050317441072027'); //保存失败，请稍后再试
    if(police ==1) {return false;}
    var save_orderid    = jq('#order_id').val();
    var save_ExpClss    = jq('#order_id').attr('alt');
    var save_mtid       = jq('#mt_id').val();
    var save_mtuser     = jq('#mt_user').attr('alt');
    var save_mtgroup    = jq('#mt_group').attr('alt');
    var save_mttalkdate = jq('#mt_talk_date').val();
    var save_mtdate     = jq('#mt_date').val();
    var save_mtsomething = jq('#mt_something').val();
    var save_orderother = jq('#order_other').val();

    if(save_orderid == ''){mui.alert(alertlog_10,'YUDO ERP APP');  return false;}
    if(save_mtuser == '' || save_mtgroup == ''){mui.alert(alertlog_11,'YUDO ERP APP'); return false;}

    var save_test_user  = jq('#test_user').attr('alt');
    var save_test_group = jq('#test_group').attr('alt');
    var save_test_date  = jq('#test_date').val();
    var save_testsomething = jq('#test_something').val();
    var btnArray = ['YES', 'NO'];
    mui.confirm(alertlog_12, 'YUDO ERP APP', btnArray, function(e) {
        if (e.index == 0) {
            if(police ==1) {return false;}
            mui.showLoading('loading','div');
            jq.ajax({
                url: '/WEI_2000/WEI_2000/mt_save',
                data: {
                    orderid: save_orderid,   //订单号
                    mtid:save_mtid,          //组装号
                    mtuser: save_mtuser,      //组装人
                    mtgroup: save_mtgroup,       //组装部门
                    mttalkdate: save_mttalkdate,  //组装报告时间
                    mtdate: save_mtdate,           //组装时间
                    mtsomething: save_mtsomething,   //组装事项
                    orderother: save_orderother,     //备注
                    testuser: save_test_user,        //试模人
                    testgroup: save_test_group,      //试模部门
                    testdate: save_test_date,         //试模日
                    testsomething:save_testsomething,   //试模事项
                    expclass:save_ExpClss            //区分
                },
                type: 'post',
                dataType: 'json',
                success: function (res, status, xhr) {
                    console.log(res);
                    if (res.returnCode == 'Y001') {
                        mui.alert(alertlog_13,'YUDO ERP APP','OK',function (e) {
                            jq('#mt_id').val(res.data);
                        });
                    }
                    if(res.returnCode == 'I888'){
                        mui.alert(alertlog_14,'YUDO ERP APP','OK');
                    }
                    if(res.returnCode == 'Y003')
                    {
                        mui.alert('update successful','YUDO ERP APP','OK');
                    }
                },
                error: function(xhr, status, error) {
                    // iOS에서 네트워크 에러인 경우 에러 페이지 표시
                    if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS && xhr.status == 0) {
                        location.href = "jmobile://callErrorPage";
                    } else
                        alert(error);
                },
                complete: function(xhr, status) {
                    mui.hideLoading();

                    JLAMP.common.mergeRows('.basic_table', 0, 1);

                    jq('#chart').html('<img style="margin:40px; 0" src="/image/no_chart.png">');
                    jq("#list_html tr:first-child").click();
                }
            });
        }
    })


}
//调用摄像头
function takCamera(check) {
    if(check == 'mt'){
        mui('#sheet_mt').popover('hide');
    }
    else
    {
        mui('#sheet_test').popover('hide');
    }

    if(JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS){
        location.href='jmobile://getCamera';
    }
    if(JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.Android)
    {
        if(window.JMobile) window.JMobile.getCamera();
    }
}

//二维码回调
function setQRcodeResult(content) {
    if(content.indexOf("/") > 0){
        var order_id = content.split('/')[4];
    }
    else
    {
        var order_id = content
    }
    if(order_id == ''){
        mui.alert(JLAMP.lang.getWord('W2018050317441830047'),'YUDO ERP APP')
    }
    else
    {
        clearAllDate(order_id);
        // mui.alert('订单号:'+order_id,'YUDO ERP APP');
    }
}
//图片回调
function setGalleryPath(imagePath) {
    jq('.leon').append(imagePath);
}
//相机回调
function setCameraPath(imagePath){
    // uploadrecall('mt_photo',0,'sheet_mt',imagePath);
    mui.alert('安卓拍照功能开发中','YUDO ERP APP');
    // var image = new Image();
    // image.src = imagePath;
    //
    // jq('.leon').html(image);
}
jq(window).resize(function(){
    setListWidth();
    var screenWidth = jq(this).width();
    var chart = jq("#chart").data("kendoChart");
    if (chart) {
        jq("#chart").css({width: screenWidth});
        chart.redraw();
    }
});
function setListWidth() {
    var screenWidth = jq(this).width();
    jq(".basic_table").parent().width(screenWidth - m_marginSize);
}
function setListHeight() {
    var listHeight = jq(".basic_table").height();
    //jq(".basic_table").parent().height(listHeight + m_marginSize);
    jq(".basic_table").parent().animate({
        height: listHeight + m_marginSize
    }, 500)
}
//订单信息装载
function displaylist(orderInfo) {
    // data4 == 'null' ? data4 = '' : data4;

    jq('#order_id').val(orderInfo.OrderNo);
    jq('#order_id').attr('alt',orderInfo.ExpClss);    //订单号码
    jq('#cos_name').val(orderInfo.custname);     //客户名称
    jq('#order_date').val(orderInfo.OrderDate.substr(0,10));       //订单日期
    jq('#target_date').val(orderInfo.DelvDate.substr(0,10));      //交货期
    jq('#System_Type').val(orderInfo.SystemType);
    jq('#Gate_counts').val(orderInfo.GateQty);
    orderlist('close');
    displayAssm(orderInfo.OrderNo,'order');
}
//组装信息装载
function displayAssm(orderid,check){
    mui.showLoading('loading','div');
    jq.ajax({
        url: '/WEI_2000/WEI_2000/mt_prc',
        data: {
            orderid: orderid,
        },
        type: 'get',
        dataType: 'json',
        success: function (res, status, xhr) {
            console.log(res);
            var mt_html = '';
            var test_html = '';
            var sale_html = '';
            var yin = "'";
            if (res.returnCode != 'I995' && res.returnCode != 'I994') {
                if(res.data[0][0].CfmYn == '1'){
                    police = 1;
                    jq('#mySwitch').addClass('mui-active');
                }
                else
                {
                    police = 0;
                    jq('#mySwitch').removeClass('mui-active');
                }

                jq('#mt_id').val(res.data[0][0].AssmReptNo);          //组装报告号
                jq('#mt_talk_date').val(res.data[0][0].AssmReptDate.substr(0,10)); //组装报告日
                jq('#mt_date').val(res.data[0][0].AssmDate.substr(0,10));          //组装日
                jq('#mt_group').val(res.data[0][0].DeptNm); jq('#mt_group').attr('alt',res.data[0][0].AssmDeptCd)                  //组装部门名称 +id
                jq('#mt_user').val(res.data[0][0].EmpNm); jq('#mt_user').attr('alt',res.data[0][0].AssmEmpID);                      //组装人员 +id
                jq('#order_other').val(res.data[0][0].other);         //备注
                jq('#mt_something').val(res.data[0][0].mt_something)  //组装报告事项
                res.data[0][0].test_date != null ? jq('#test_date').val(res.data[0][0].test_date.substr(0,10)) : jq('#test_date').val('0000-00-00');
                jq('#test_group').val(res.data[0][0].test_group); jq('#test_group').attr('alt',res.data[0][0].TrialDeptCd);
                jq('#test_user').val(res.data[0][0].test_user); jq('#test_user').attr('alt',res.data[0][0].TrialEmpID);
                jq('#test_something').val(res.data[0][0].TrialContents);
                //组装照片渲染
                for(var i = 0;i < res.data[1][0].length;i++){

                    mt_html += '<tr><td width="20" style="height: 29px;background-color:#fafafa;color:#727171;">'+(i+1)+'</td>'+
                        '<td style="height: 29px;background-color:#fafafa;color:#727171;"><div style="margin: 0!important;" class="mui-content-padded">'+
                        '<img src="/image/uploads/mt/AssembleReport/'+res.data[0][0].AssmReptNo.substr(0,6)+'/'+res.data[0][0].AssmReptNo+'/'+res.data[1][0][i].FileNm+'" height="29" width="29" data-preview-src="" data-preview-group="1" /></div></td>'+
                        '<td style="height: 29px;background-color:#fafafa;color:#85bbff;">'+res.data[1][0][i].FileNm+'</td>' +
                        '<td width="65" style="height: 29px;background-color:#fafafa;color:#727171;"><button onclick="delphoto(this,'+yin+res.data[1][0][i].FileNm+yin+','+yin+res.data[1][0][i].Seq+yin+','+yin+'mt_photo'+yin+')"  class="button-2000">Delete</button></td>'+
                        '</tr>';
                }
                //试模照片渲染
                for(var i = 0;i < res.data[2][0].length;i++){
                    test_html += '<tr><td width="20"  style="height: 29px;background-color:#fafafa;color:#727171;">'+(i+1)+'</td>'+
                        '<td style="height: 29px;background-color:#fafafa;color:#727171;"><div style="margin: 0!important;" class="mui-content-padded">'+
                        '<img src="/image/uploads/mt/TrialInjection/'+res.data[0][0].AssmReptNo.substr(0,6)+'/'+res.data[0][0].AssmReptNo+'/'+res.data[2][0][i].FileNm+'" height="29" width="29" data-preview-src="" data-preview-group="1" /></div></td>'+
                        '<td style="height: 29px;background-color:#fafafa;color:#85bbff;">'+res.data[2][0][i].FileNm+'</td>' +
                        '<td width="65" style="height: 29px;background-color:#fafafa;color:#727171;"><button onclick="delphoto(this,'+yin+res.data[2][0][i].FileNm+yin+','+yin+res.data[2][0][i].Seq+yin+','+yin+'test_photo'+yin+')" class="button-2000">Delete</button></td>'+
                        '</tr>';
                }
                //销售负责人渲染
                for(var i =0;i < res.data[3][0].length;i++){
                    res.data[3][0][i].Remark==null ? res.data[3][0][i].Remark = '' : res.data[3][0][i].Remark;
                    res.data[3][0][i].EmpNm==null ? res.data[3][0][i].EmpNm = '' : res.data[3][0][i].EmpNm;
                    sale_html += '<tr><td width="20"  style="height: 29px;background-color:#fafafa;color:#727171;">'+(i+1)+'</td>'+
                        '<td width="100" name="now_sales" style="height: 29px;background-color:#fafafa;color:#85bbff;">'+res.data[3][0][i].EmpNm+'</td>' +
                        '<td style="height: 29px;background-color:#fafafa;color:#727171;">'+res.data[3][0][i].DeptNm+'</td>'+
                        '<td width="65" style="height: 29px;background-color:#fafafa;color:#727171;"><button onclick="delSales(this,'+yin+res.data[3][0][i].SaleEmpID+yin+','+yin+res.data[3][0][i].Seq+yin+');" class="button-2000">Delete</button></td>'+
                        '</tr>';
                }
                jq('#mt_photo').html(mt_html);
                jq('#test_photo').html(test_html);
                jq('#sell_table').html(sale_html);
            }
            else {
                var date = new Date();
                jq("#test_date").datetimepicker("setDate", date);
                jq('#mt_id').val('');//组装报告号
                jq('#mt_group').val(login_groupname);jq('#mt_group').attr('alt',login_groupid);            //组装部门名称
                jq('#mt_user').val(login_username);jq('#mt_user').attr('alt',login_userid);             //组装人员
                jq('#order_other').val('');         //备注
                jq('#mt_something').val('');
                jq('#test_group').val('');jq('#test_group').attr('alt','');
                jq('#test_user').val('');jq('#test_user').attr('alt','');
                jq('#sell_table').html('');
                jq('#mt_photo').html('');
                jq('#test_photo').html('');
                var date = new Date();
                jq("#mt_talk_date,#mt_date").datetimepicker("setDate", date);
            }
        },
        complete: function(xhr, status) {
            mui.hideLoading();

            JLAMP.common.mergeRows('.basic_table', 0, 1);

            jq('#chart').html('<img style="margin:40px; 0" src="/image/no_chart.png">');
            jq("#list_html tr:first-child").click();
        },
        error: function(xhr, status, error) {
            mui.hideLoading();
            // iOS에서 네트워크 에러인 경우 에러 페이지 표시
            if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS && xhr.status == 0) {
                location.href = "jmobile://callErrorPage";
            } else
                alert(error);
        }
    });

}

//装载组装信息查询内容
function displaymtfind(order_id) {
    mtfind = 1;
    clearAllDate(order_id);
}
//清空历史信息
function clearAllDate(order_id) {
    mui.showLoading('loading','div');
    police = 0;
    jq('#mySwitch').removeClass('mui-active');
    jq('#order_id').val('');
    jq('#order_id').attr('alt', '');    //订单号码
    jq('#cos_name').val('');     //客户名称
    jq('#order_date').val('');       //订单日期
    jq('#target_date').val('');      //交货期
    jq('#System_Type').val('');
    jq('#Gate_counts').val('');
    var date = new Date();
    jq("#test_date").datetimepicker("setDate", date);
    jq('#mt_id').val('');//组装报告号
    jq('#mt_group').val(login_groupname);jq('#mt_group').attr('alt',login_groupid);            //组装部门名称
    jq('#mt_user').val(login_username);jq('#mt_user').attr('alt',login_userid);             //组装人员
    jq('#order_other').val('');         //备注
    jq('#mt_something').val('');
    jq('#test_something').val('');
    jq('#test_group').val('');jq('#test_group').attr('alt','');
    jq('#test_user').val('');jq('#test_user').attr('alt','');
    jq('#sell_table').html('');
    jq('#mt_photo').html('');
    jq('#test_photo').html('');

    var date = new Date();
    jq("#mt_talk_date,#mt_date").datetimepicker("setDate", date);
    if(order_id != 'new'){
        doSearch(order_id);
    }
    else
    {
        mui.hideLoading();
    }

}
function loaddingmore(mine,check) {
    switch (check){
        case 0:

            var count = jq('#find-order-list').children().length;
            count = count;
            console.log(count)
            doSearch('search',count)
            break;
        case 1:
            queryuser('globel');
            break;
        case 2:
            query_sales_user('globel');
            break;
        case 3:
            query_mt('globel');
            break;
    }

}
//订单信息查询
function doSearch(order_id,num){
    if(order_id != 'search')
    {
        var orderid = order_id;
        var orderby = '';
    }
    else
    {
        mui.showLoading('loading','div');
        var orderid = jq("#this_order_date").val(); //
        var orderby = jq('#gubun').val();
    }
	// Loading Indicator
    console.log(orderby);
	jq.ajax({
		url: '/WEI_2000/WEI_2000/order_prc',
		data: {
            orderid: orderid,
            orderby: orderby,
            ordercount:num
		},
		type: 'get',
		dataType: 'json',
		success: function(res, status, xhr) {
		    console.log(res);
		    var yin = "'";
		    var html = '';
		    //通过查询列表查询
			if(order_id == 'search')
            {
                if (res.returnCode == 0) {
                    for(var i = 0;i < res.data[0].length;i++){
                        html += '<div class="minute-list" onclick="displaylist(res.data[0][0])" style="font-size: 12px;border-bottom: 5px solid #f9f9f9;">' +
                                    '<div class="minute-body" style="height: 95px">' +
            '                            <div class="tr">' +
            '                                <div class="title">'+ lang.orderNo +':'+res.data[0][0].OrderNo+'</div>' +
            '                            </div>' +
            '                            <div class="tr">' +
            '                                <div class="len-10 long">'+ lang.custNm +':'+res.data[0][0].custname+'</div>' +
            '                            </div>' +
            '                            <div class="tr">' +
            '                                <div class="len-5 long left-text ">'+ lang.orderDate +':'+res.data[0][0].OrderDate+'</div>' +
            '                                <div class="right-text">'+ lang.empNm +':'+res.data[0][0].EmpNm+'</div>' +
            '                            </div>' +
            '                            <div class="tr">' +
            '                                <div class="len-5 long left-text ">'+ lang.delvDate +':'+res.data[0][0].DelvDate+'</div>' +
            '                                <div class="right-text">'+ lang.deptNm +':'+res.data[0][0].DeptNm+'</div>' +
                                        '</div>' +
                                    '</div>'+
                            '</div>';
                    }
                    jq('#loadding').remove();
                    if(num > 0){
                        jq('#find-order-list').append(html);
                    }
                    else
                    {
                        jq('#find-order-list').html(html);
                    }
                    var loadding = '<div id="loadding" onclick="loaddingmore(this,0);" class="loadding"><span>加载更多...</span></div>';
                    var endcount = jq('#find-order-list').children().length;
                    endcount <= 1 ? endcount : jq('#order-list').append(loadding);
                }
                mui.hideLoading();
            }
            //二维码查询和局部刷新
            else {
                findMtHide();
                if(mtfind == 1){
                    mtfindToSlide();
                    mtfind = 0;
                }
                else
                {

                }
                //slideShow();
                if (res.returnCode == 0) {
                    displaylist(res.data[0][0].OrderDate,res.data[0][0].OrderNo, res.data[0][0].custname,res.data[0][0].SystemType,
                        res.data[0][0].GateQty,
                        res.data[0][0].DelvDate,
                        res.data[0][0].ExpClss);
                }
                else if(res.returnCode == 'NULL'){
                    mui.hideLoading();
                    mui.alert(JLAMP.lang.getWord('W2018061209095227081'),'YUDO ERP APP');
                }
                else
                {
                    mui.hideLoading();
                    mui.alert(JLAMP.lang.getWord('W2018061209095227081'),'YUDO ERP APP');
                }
            }

        },
        error: function(xhr, status, error) {
            mui.hideLoading();
            mui.alert(JLAMP.lang.getWord('W2018061209101367338'),'YUDO ERP APP');
            // iOS에서 네트워크 에러인 경우 에러 페이지 표시
        	if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS && xhr.status == 0) {
        		location.href = "jmobile://callErrorPage";
        	} else
        		alert(error);
        },
        complete: function(xhr, status) {
		    JLAMP.common.mergeRows('.basic_table', 0, 1);

            jq('#chart').html('<img style="margin:40px; 0" src="/image/no_chart.png">');
            jq("#list_html tr:first-child").click();
        }
    });
}
//职工搜索
function queryuser(globel){
    jq('#loadding-user').remove();
    var username = jq("#this_user").val(); // 기준일
    var userid = jq('#this_user_id').val();
    var groupname = jq('#this_group').val();
    //如果搜索所有员工 则直接从本地全局获取
    if((username == '' && userid == '' && groupname == '') || globel == 'globel')
    {

        var html = '';
        var yin = "'";
        for(var i = userpages-100;i<userpages;i++){
            html += '<tr onclick="displayuser('+yin+userlists[i].EmpID+yin+','+
                yin+userlists[i].EmpNm+yin+',' +
                yin+userlists[i].DeptCd+yin+',' +
                yin+userlists[i].DeptNm+yin+
                ')" >';
            html += '<td style="height: 29px;background-color:#fafafa;color:#727171;"><div class="basic_table_div" style="width: 30px">'+(i+1)+'</div></td>'+
                '<td style="height: 29px;background-color:#fafafa;color:#727171;"><div class="basic_table_div" style="width: 100px">'+userlists[i].DeptNm+'</div></td>'+
                '<td style="height: 29px;background-color:#fafafa;color:#727171;"><div class="basic_table_div" style="width: 100px">'+userlists[i].EmpNm+'</div></td>'+
                '<td style="height: 29px;background-color:#fafafa;color:#727171;"><div class="basic_table_div" style="width: 100px">'+userlists[i].EmpID+'</div></td>' +
                '</tr>';
        }
        if(globel == 'globel'){
            jq('#find-user-list').append(html);
        }
        else
        {
            jq('#find-user-list').html(html);
            var loadding = '<div id="loadding-user" onclick="loaddingmore(this,1);" class="loadding"><span>加载更多...</span></div>';
            jq('#user-list').append(loadding);
        }
        userpages = userpages + 100;
    }
    else
    {
        // Loading Indicator
        mui.showLoading('loading','div');
        jq.ajax({
            url: '/WEI_2000/WEI_2000/user_prc',
            data: {
                username: username,
                userid: userid,
                groupname:groupname
            },
            type: 'get',
            dataType: 'json',
            success: function (res, status, xhr) {
                console.log(res);
                var yin = "'";
                var html = '';
                if (res.returnCode == 0) {
                        for(var i = 0;i < res.data[0].length;i++){
                            html += '<tr onclick="displayuser('+yin+res.data[0][i].EmpID+yin+','+
                                yin+res.data[0][i].EmpNm+yin+',' +
                                yin+res.data[0][i].DeptCd+yin+',' +
                                yin+res.data[0][i].DeptNm+yin+
                                ')" >';
                            html += '<td style="height: 29px;background-color:#fafafa;color:#727171;"><div class="basic_table_div" style="width: 30px">'+(i+1)+'</div></td>'+
                                '<td style="height: 29px;background-color:#fafafa;color:#727171;"><div class="basic_table_div" style="width: 100px">'+res.data[0][i].DeptNm+'</div></td>'+
                                '<td style="height: 29px;background-color:#fafafa;color:#727171;"><div class="basic_table_div" style="width: 100px">'+res.data[0][i].EmpNm+'</div></td>'+
                                '<td style="height: 29px;background-color:#fafafa;color:#727171;"><div class="basic_table_div" style="width: 100px">'+res.data[0][i].EmpID+'</div></td>' +
                                '</tr>';
                        }
                        jq('#find-user-list').html(html);
                }
            },
            error: function(xhr, status, error) {
                // iOS에서 네트워크 에러인 경우 에러 페이지 표시
                if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS && xhr.status == 0) {
                    location.href = "jmobile://callErrorPage";
                } else
                    alert(error);
            },
            complete: function(xhr, status) {
                mui.hideLoading();

                JLAMP.common.mergeRows('.basic_table', 0, 1);

                jq('#chart').html('<img style="margin:40px; 0" src="/image/no_chart.png">');
                jq("#list_html tr:first-child").click();
            }
        });
    }
}
//销售负责人搜索
function query_sales_user(globel) {

    // if(jq('#mt_id').val() == '') {mui.alert('请先保存组装报告信息','YUDO ERP APP'); return false;}
    var username = jq("#sales_user").val(); // 기준일
    var userid = jq('#sales_user_id').val();
    var groupname = jq('#sales_group').val();
    //如果搜索所有员工 则直接从本地全局获取
    if((username == '' && userid == '' && groupname == '') || globel == 'globel')
    {

        var html = '';
        for(var i = userpages-100;i<userpages;i++){
            html += '<tr alt="' + userlists[i].EmpID + '">' +
                '<td style="height: 29px;background-color:#fafafa;color:#727171;"><div class="basic_table_div mui-input-row mui-checkbox" style="width: 50px;background:#fafafa !important;">' +
                '<label style="color: transparent;padding: 6px 0 3px 35px!important;margin-bottom: 1px !important;">' + (i + 1) + '</label>' +
                '<input alt="' + userlists[i].EmpNm + '" name="mui_checkbox" style="z-index: 3;left: 3px !important;top:0 !important;margin-top: 0 !important;" value="Item 1" type="checkbox">' +
                '</div></td>' +
                '<td style="height: 29px;background-color:#fafafa;color:#727171;"><div class="basic_table_div" style="width: 100px">' + userlists[i].DeptNm + '</div></td>' +
                '<td style="height: 29px;background-color:#fafafa;color:#727171;"><div class="basic_table_div" style="width: 100px">' + userlists[i].EmpNm + '</div></td>' +
                '<td style="height: 29px;background-color:#fafafa;color:#727171;"><div class="basic_table_div" style="width: 100px">' + userlists[i].EmpID + '</div></td>' +
                '</tr>';
            ;
        }
        if(globel == 'globel'){
            jq('#find-sales-list').append(html);
        }
        else
        {
            jq('#loadding-sales').remove();
            jq('#find-sales-list').html(html);
            var loadding = '<div id="loadding-sales" onclick="loaddingmore(this,2);" class="loadding"><span>加载更多...</span></div>';
            jq('#sales-list').append(loadding);
        }
        userpages = userpages + 100;
    }
    else {
        // Loading Indicator
        mui.showLoading('loading','div');
        jq.ajax({
            url: '/WEI_2000/WEI_2000/user_prc',
            data: {
                username: username,
                userid: userid,
                groupname: groupname
            },
            type: 'get',
            dataType: 'json',
            success: function (res, status, xhr) {
                console.log(res);
                var html = '';
                if (res.returnCode == 0) {
                    for (var i = 0; i < res.data[0].length; i++) {
                        html += '<tr alt="' + res.data[0][i].EmpID + '">' +
                            '<td style="height: 29px;background-color:#fafafa;color:#727171;"><div class="basic_table_div mui-input-row mui-checkbox" style="width: 50px;background:#fafafa !important;">' +
                            '<label style="color: transparent;padding: 6px 0 3px 35px!important;margin-bottom: 1px !important;">' + (i + 1) + '</label>' +
                            '<input alt="' + res.data[0][i].EmpNm + '" name="mui_checkbox" style="z-index: 3;left: 3px !important;top:0 !important;margin-top: 0 !important;" value="Item 1" type="checkbox">' +
                            '</div></td>' +
                            '<td style="height: 29px;background-color:#fafafa;color:#727171;"><div class="basic_table_div" style="width: 100px">' + res.data[0][i].DeptNm + '</div></td>' +
                            '<td style="height: 29px;background-color:#fafafa;color:#727171;"><div class="basic_table_div" style="width: 100px">' + res.data[0][i].EmpNm + '</div></td>' +
                            '<td style="height: 29px;background-color:#fafafa;color:#727171;"><div class="basic_table_div" style="width: 100px">' + res.data[0][i].EmpID + '</div></td>' +
                            '</tr>';

                        ;
                    }
                    jq('#find-sales-list').html(html);
                }
            },
            error: function (xhr, status, error) {
                // iOS에서 네트워크 에러인 경우 에러 페이지 표시
                if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS && xhr.status == 0) {
                    location.href = "jmobile://callErrorPage";
                } else
                    alert(error);
            },
            complete: function (xhr, status) {
                mui.hideLoading();

                JLAMP.common.mergeRows('.basic_table', 0, 1);

                jq('#chart').html('<img style="margin:40px; 0" src="/image/no_chart.png">');
                jq("#list_html tr:first-child").click();
            }
        });
    }
}
//组装试模报告搜索
function query_mt(globel) {
    if(globel != 'globel'){
        jq('#mtfind-order-list').html('');
        jq('#loadding-mt').remove();
        mtpages = 0;
    }
    var orderid = jq("#mtfind_order_date").val();
    var custnm = jq('#mtgubun').val();
    mui.showLoading('loading','div');
    jq.ajax({
        url: '/WEI_2000/WEI_2000/mt_list',
        data: {
            orderid: orderid,
            custnm: custnm,
            count:mtpages
        },
        type: 'get',
        dataType: 'json',
        success: function (res, status, xhr) {
            console.log(mtpages);
            var yin = "'";
            var html = '';
            if (res.returnCode == 0) {
                for(var i = 0;i < res.data[0].length;i++){
                    html += '<tr onclick="displaymtfind('+yin+res.data[0][i].OrderNo+yin+')" >';
                    html += '<td style="height: 29px;background-color:#fafafa;color:#727171;"><div class="basic_table_div" style="width: 30px">'+res.data[0][i].id+'</div></td>'+
                        '<td style="height: 29px;background-color:#fafafa;color:#727171;"><div class="basic_table_div" style="width: 100px">'+res.data[0][i].AssmReptNo+'</div></td>'+
                        '<td style="height: 29px;background-color:#fafafa;color:#727171;"><div class="basic_table_div" style="width: 100px">'+res.data[0][i].AssmReptDate.substr(0,10)+'</div></td>'+
                        '<td style="height: 29px;background-color:#fafafa;color:#727171;"><div class="basic_table_div" style="width: 100px">'+res.data[0][i].AssmDate.substr(0,10)+'</div></td>' +
                        '<td style="height: 29px;background-color:#fafafa;color:#727171;"><div class="basic_table_div" style="width: 100px">'+res.data[0][i].EmpNm+'</div></td>' +
                        '<td style="height: 29px;background-color:#fafafa;color:#727171;"><div class="basic_table_div" style="width: 100px">'+res.data[0][i].DeptNm+'</div></td>' +
                        '<td style="height: 29px;background-color:#fafafa;color:#727171;"><div class="basic_table_div" style="width: 250px">'+res.data[0][i].custnm+'</div></td>' +
                        '<td style="height: 29px;background-color:#fafafa;color:#727171;"><div class="basic_table_div" style="width: 100px">'+res.data[0][i].OrderNo+'</div></td>' +
                        '</tr>';
                }
                if(globel == 'globel'){
                    jq('#mtfind-order-list').append(html);
                }
                else
                {
                    jq('#mtfind-order-list').html(html);
                    var loadding = '<div id="loadding-mt" onclick="loaddingmore(this,3);" class="loadding"><span>加载更多...</span></div>';
                    jq('#mtorder-list').append(loadding);
                }
                mtpages = mtpages + 50;
            }
            else if(res.returnCode == 'NULL'){
                mui.alert('没有查询到信息，可能是您权限不够','YUDO ERP APP');
            }
            mui.hideLoading();
        },
        error: function(xhr, status, error) {
            // iOS에서 네트워크 에러인 경우 에러 페이지 표시
            if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS && xhr.status == 0) {
                location.href = "jmobile://callErrorPage";
            } else
                alert(error);
        },
        complete: function(xhr, status) {
            mui.hideLoading();

            JLAMP.common.mergeRows('.basic_table', 0, 1);

            jq('#chart').html('<img style="margin:40px; 0" src="/image/no_chart.png">');
            jq("#list_html tr:first-child").click();
        }
    });
}
//职工信息装载
function displayuser(userid,username,groupid,groupname) {
    switch (jq('#find-window-user').attr("alt")){
        case 'test':
            jq('#test_user').val(username);   jq('#test_user').attr('alt',userid);
            jq('#test_group').val(groupname); jq('#test_group').attr('alt',groupid);
            userlist('close');
            break;
        case 'mt':
            jq('#mt_user').val(username);   jq('#mt_user').attr('alt',userid);
            jq('#mt_group').val(groupname); jq('#mt_group').attr('alt',groupid);
            userlist('close');
            break;
    }
}
/**
 * 메소드명: setChartData
 * 작성자: 김목영
 * 설 명: Chart Data Setting
 *
 * 최초작성일: 2017.11.10
 * 최종수정일: 2017.11.10
 * ---
 * Date              Auth        Desc
 */
function setChartData(obj, colName, todayOrderForAmt, toDayInvoiceForAmt, toDayBillForAmt, toDayReceiptForAmt, toDayProductForAmt) {
    if (!todayOrderForAmt && !toDayInvoiceForAmt && !toDayBillForAmt && !toDayReceiptForAmt && !toDayProductForAmt) return;

	var chartTitle1 = JLAMP.lang.getWord('W2018020109142066061');
	var chartTitle2 = JLAMP.lang.getWord('W2018020109152826082');
	var chartTitle3 = JLAMP.lang.getWord('W2018020109163152302');
	var chartTitle4 = JLAMP.lang.getWord('W2018020109171409099');
	var chartTitle5 = JLAMP.lang.getWord('W2018020109185311787');

    jq(obj).children().addClass('sel_txt');
    jq(obj).siblings().children().removeClass('sel_txt');

    jq("#chart").kendoChart({
        title: {
            text: colName
        },
        legend: {
            position: "top"
        },
        seriesDefaults: {
            labels: {
                template: "#= category # - #= kendo.format('{0:P}', percentage)#",
                position: "insideEnd",
                visible: true,
                background: "transparent"
            }
        },
        series: [{
            type: "pie",
            data: [{
                category: chartTitle1,
                value: todayOrderForAmt
            }, {
                category: chartTitle2,
                value: toDayInvoiceForAmt
            }, {
                category: chartTitle3,
                value: toDayBillForAmt
            }, {
                category: chartTitle4,
                value: toDayReceiptForAmt
            }, {
                category: chartTitle5,
                value: toDayProductForAmt
            }]
        }],
        tooltip: {
            visible: true,
            template: "#= category # - #= kendo.format('{0:P}', percentage) #"
        }
    });
} // end of function setChartData

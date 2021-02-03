
var ERPDevice = '';
var lang = {
    code:'CHN',
	data:{
		CHN:{
			mustUserNm:'请输入您的账号',
			mustPassWd:'请输入您的密码',
			mustAppLogin:'只能通过移动APP登录',
			passWdErr:'账号或者密码错误',
            deviceUnregistered:'移动设备信息与账户绑定信息不匹配',
			confirm:'确定',
			loginDeviceModal:'未生成设备号.\n\n请再试一次.',
			sevesucces:'您的注册请求已成功。请联系管理员',
			loginid:'请输入您的用户名',
		},
		KOR:{
			mustUserNm:'계정을 입력하세요',
            mustPassWd:'비밀번호를 입력하세요',
            mustAppLogin:'모바일 앱에서만 등록가능합니다. ',
            passWdErr:'계정 혹은 비밀번호가 맞지 않습니다.',
            deviceUnregistered:'모바일설비 정보가 바인딩 계정 정보하고 일치하지 않습니다.',
            confirm:'확정',
            loginDeviceModal:'장치 번호가 생성되지 않음.\n\n다시 시도해 보십시오.',
			sevesucces:'등록에 성공하였습니다.관리자에게 연락하세요.',
			loginid:'사용자 이름을 입력하십시오',
		},
		ENG:{
			mustUserNm:'Please enter your username',
            mustPassWd:'Please enter your password',
            mustAppLogin:'Log in only through mobile APP',
            passWdErr:'Error in username or password',
			deviceUnregistered:'Mobile device information does not match account binding information',
            confirm:'YES',
            loginDeviceModal:'I do not know the device number.\n\nRun again.',
			sevesucces:'Your registration request was successful. Please contact the administrator.',
			loginid:'Please enter your LOGIN ID',
		}
	},
	getLang:function (key) {
    	var endMsg = '';
		switch (this.code){
			case 'CHN':
				endMsg = this.data.CHN[key];
				break;
			case 'KOR':
                endMsg = this.data.KOR[key];
				break;
			case 'ENG':
                endMsg = this.data.ENG[key];
				break;
		}
		return endMsg;
	},

}

jq(document).ready(function() {
	// 모바일인 경우, 기기등록 버튼 표시
	// 디바이스 ID 및 Token 설정
	if(JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS || JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.Android) {
		jq("#btn_device_id").attr("type", "button");
		if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
			try{
				webkit.messageHandlers.jmobile.postMessage({fn: "getRegistDevice"});
			}catch (e) {
				jq('#downLoadScript').remove();
			}
		} else {
			try {
				if (window.JMobile) window.JMobile.getRegistID();
			} catch(e) {
				jq('#downLoadScript').remove();
			}
		}
		try{
            getVersion();
		}catch($e){

		}
		// getVersion();
	} else {
		jq("#btn_device_id").attr("type", "hidden");
	}
	//如果是从其他地区切换，则保存最近地区信息
	//如果是重新打开APP，则直接获取地区信息进行跳转
    jq("#login_service_id").val(server.serverNm);

	// if(document.referrer != ''){
    //     setServer(jq('#login_service_id').val());
	// }
	// 기기번호 등록요청 버튼 클릭 이벤트
	jq("#btn_device_id").click(function() {

		if (m_deviceID != '')
			showDeviceModal();
		else {
            // showDeviceModal();
			alert(lang.getLang('loginDeviceModal'));
			location.reload();
		}
	});

	// 기기번호 등록요청 버튼 클릭 이벤트
	jq("#btn_device_save").click(function() {
		doDeviceSave();
	});
	// 기기번호 등록요청 초기화
	jq('#mdl_device_info').on('hidden.bs.modal', function () {
		jq("#mdl_user_id").val('');
	});

	// if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
	// 	try{
	// 		webkit.messageHandlers.jmobile.postMessage({fn: "getDeviceInfo"});
	// 	}catch (e) {
	// 		jq('#downLoadScript').remove();
	// 	}
	// } else if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.Android) {
	// 	if (window.JMobile) window.JMobile.getDeviceInfo();
	// }
	if(document.referrer != ''){
		jq('#downLoadScript').remove();
	}else{
		setTimeout(()=>{
			jq('#downLoadScript').remove();
		},1000);
	}
});
function setRegistDevice(deviceID, version) {
	var param = {device:deviceID};
	http.get('http://merp.yudo.com.cn:8186/DeviceBind/getServerId',param,res => {
		if(res.returnCode == 0){
			changeServer(res.data);
		}
	},res=>{

	},res=>{
	});
	m_deviceID = deviceID;
	jq("#version").html(version);
}

function setDeviceInfo(deviceInfo) {

}

function serverOnchange(value) {
	var server = value
	var param = {};
	param.device = m_deviceID;
	param.server = value;
	http.get('http://merp.yudo.com.cn:8183/DeviceBind/bindServer',param,function(res){
		if(res.returnCode == 0 ){
			console.log(res.data);
		}
	},res=>{
		mui.alert('服务器切换失败,请稍后再试');
	},res=>{
		changeServer(server);
	});
}
//跳转到地区服务器，如果地区服务器界面为当前打开界面，则不跳转
function getServer() {
	// try{
    //     var server =  multi.getLocalStorage('server')
	// }catch (e) {
	// 	mui.alert('localstorage 错误！','YUDO MOBILE ERP');
    //     jq('#downLoadScript').remove();
    // }
    // if(server != false) {
	//
    //     changeServer(server);
    // }else{
    //     jq('#downLoadScript').remove();
	// }
}
//设置地区信息并且跳转，如果地区服务器界面为当前打开界面，则不跳转
// function setServer(server) {
//     try{
//         multi.setLocalStorage('server',server);
//         changeServer(server);
//     }catch (e) {
//         mui.alert('localstorage 错误！','YUDO MOBILE ERP');
//     }
// }

function changeServer(server) {
    var gets = '/?deviceType=' + JLAMP.common.getDeviceType() + '&devicePlatform=' + JLAMP.common.getDevicePlatform();
    switch (server) {
		case 'DEV':
            var url = 'http://dev.merp.yudo.com.cn:8186' + gets;
            if(window.location.href != url){
                window.location.href = url
                setTimeout(function () {
                    jq('#downLoadScript').remove();
                },3000);
			}else{
            	jq('#downLoadScript').remove();
			}

			break;
        case 'SZ':
        	var url = 'http://merp.yudo.com.cn:8183' + gets;
            if(window.location.href != url){
                window.location.href = url
                setTimeout(function () {
                    jq('#downLoadScript').remove();
                },3000);
            }else{
                jq('#downLoadScript').remove();
            }
            break;
        case 'GD':
        	var url = 'http://gdmerp.yudo.com.cn:7575' + gets;
            if(window.location.href != url){
                window.location.href = url
                setTimeout(function () {
                    jq('#downLoadScript').remove();
                },3000);
            }else{
                jq('#downLoadScript').remove();
            }
            break;
    }
}

var first = null;
function doBack() {
    if(!first){
        first = new Date().getTime();
        mui.toast('再按一次退出应用');
        setTimeout(function(){
            first = null;
        },2000);
    } else {
        if(new Date().getTime() - first < 2000){
            if (window.JMobile)  window.JMobile.doExit();
        }
    }
}
function setServiceMsg(service,check) {
    jq.ajax({
        url: "/main/setService",
        data: {
            service:service
        },
        type: "post",
        dataType: "json",
        async: false,
        success: function (res, status, xhr) {
        	var gets = '/?deviceType=' + JLAMP.common.getDeviceType() + '&devicePlatform=' + JLAMP.common.getDevicePlatform();
            if (res) {
                if (res.returnCode == 0) {
                	if(check != 'noGo'){
                        switch (res.data){
                            case 'SZ':
                                window.location.href='http://merp.yudo.com.cn:8183'+gets;
                                break;
                            case 'GD':
                                window.location.href='http://gdmerp.yudo.com.cn:7575'+gets;
                                break;
                        }
					}
                }
            }
        },
        error: function (xhr, status, error) {
            alert(error);
        }
    });
}
/**
 * 메소드명: showDeviceModal
 * 작성자: 김목영
 * 설 명:  기기번호 등록요청 Modal창 오픈
 *
 * 최초작성일: 2017.11.09
 * 최종수정일: 2017.11.09
 * ---
 * Date              Auth        Desc
 */
function showDeviceModal() {
	jq("#mdl_device_info").modal({backdrop: 'static', keyboard: false});
	jq("#mdl_device_id").val(m_deviceID);
	jq("#mdl_device_token").val(m_deviceToken);
	jq("#mdl_device_type").val(m_deviceType);
} // end of function showDeviceModal

/**
 * 메소드명: doDeviceSave
 * 작성자: 김목영
 * 설 명:  기기번호 등록 Process
 *
 * 최초작성일: 2017.11.09
 * 최종수정일: 2017.11.09
 * ---
 * Date              Auth        Desc
 */
function doDeviceSave() {
	var userID = jq("#mdl_user_id").val(); // 기기번호 등록할 사용자 ID
	var deviceID = jq("#mdl_device_id").val(); // Device ID
	var deviceToken = jq("#mdl_device_token").val(); // Device Token
	var deviceType = jq("#mdl_device_type").val(); // Device Type
	
	if(jq("#mdl_user_id").val() == '') {
		mui.alert(lang.getLang('loginid'),'YUDO APP');
		return false;
	}
	
	jq.ajax({
		url: "/main/deviceSave_prc",
		data: {
			userID: userID,
			deviceID: deviceID,
			deviceToken: deviceToken,
			deviceType: deviceType
		},
		type: "post",
		dataType: "json",
		async: false,
		success: function (res, status, xhr) {
			if (res) {
				if (res.returnCode == 0) {
					if(res.data.valid.p_error_code.substring(0, 1) != 'E' && res.data.valid.p_error_code.substring(0, 1) != 'P')
						alert(lang.getLang('sevesucces'));
					else
						alert(res.data.valid.p_error_str);
				} else {
					alert(res.returnMsg);
				}
				jq("#mdl_device_info").modal("hide");
			}
		},
		error: function (xhr, status, error) {
			alert(error);
		}
	});
	
	return false;
} // end of function doDeviceSave

function langChange() {
	lang.code = jq('#login_lang_id').val();
}


//登陆请求部分
function doLogin() {
	var loginID = jq("#login_id").val();
	var langID = jq("#login_lang_id").val();
	var dbID = jq('#login_db_id').val();
	var loginPwd = jq("#login_pwd").val();
	var isSaveID = jq("#save_id").is(":checked") == true ? "Y" : "N";
	var autoLogin = jq("#auto_login").is(":checked") == true ? "Y" : "N";
	var deviceID = m_deviceID;
	var rtnVal = false;

    if (jq.trim(loginID) == "") {
        jq("#login_id").val('');
        mui.alert(lang.getLang('mustUserNm'),'YUDO MOBILE ERP',lang.getLang('confirm'));
        return false;
    }

    if (jq.trim(loginPwd) == "") {
    	jq("#login_pwd").val('');
        mui.alert(lang.getLang('mustPassWd'),'YUDO MOBILE ERP',lang.getLang('confirm'));
        return false;
    }
    mui.showLoading('loading...','div');
	// Loading Indicator
	// JLAMP.common.loading('body', 'pulse');
	jq.ajax({
		url: "/main/login_prc",
		data: {
			loginID: loginID,
			loginPwd: loginPwd,
			isSaveID: isSaveID,
			autoLogin: autoLogin,
			deviceID: deviceID,
			langID: langID,
			dbID: dbID,
			path: '/'
		},
		type: "post",
		dataType: "json",
		// async: false,
		success: function (res, status, xhr) {
            mui.hideLoading();
			if (res) {
				if (res.returnCode == 0) {
					if(multi.getLocalStorage('langCode') != langID){
						multi.setLocalStorage('connetHistory',[])
					}
					multi.setLocalStorage('langCode',langID)
                    window.location.reload();
					rtnVal = true;
				} else if(res.returnCode == 'P_jlLogIn_001'){
                    jq("#login_pwd").val('');
                    mui.alert(lang.getLang('passWdErr'),'YUDO MOBILE ERP',lang.getLang('confirm'));
				} else if(res.returnCode == 'P_jlLogIn_005'){
                    mui.alert(lang.getLang('mustAppLogin'),'YUDO MOBILE ERP',lang.getLang('confirm'));
				} else if(res.returnCode == 'P_jlLogIn_006'){
                    mui.alert(lang.getLang('deviceUnregistered'),'YUDO MOBILE ERP',lang.getLang('confirm'));
				}
				else {
					alert(res.returnMsg);
				}
			}
		},
		error: function (xhr, status, error) {
            mui.hideLoading();
            // mui.alert(error,'YUDO MOBILE ERP');
		},
		complete: function (xhr, status) {
            mui.hideLoading();
			// JLAMP.common.loadingClose('body');
		}
	});
} // end of function doLogin

/**
 * 메소드명: checkMenuAuth
 * 작성자: 김목영
 * 설 명:  메뉴 권한 체크 Process
 *
 * 최초작성일: 2017.11.09
 * 최종수정일: 2017.11.09
 * ---
 * Date              Auth        Desc
 */
//检查账号权限
function checkMenuAuth() {
	var rtnVal = false;
	var browserPathName = window.location.pathname;
	
	jq.ajax({
		url: "/main/checkMenuAuth_prc",
		type: "post",
		dataType: "json",
		async: true,
		success: function (res, status, xhr) {

			if (res.returnCode == 0) {
				jq('body').append('<form id="redirectFrm" method="post" action="/"></form>');
				jq('#redirectFrm').submit();
			} else if(res.returnCode == 550){
				mui.alert('没有使用权','YUDO Mobile ERP');
			} else{
				doLogout('NOCONFIRM');
			}

		},
		error: function (xhr, status, error) {

		},
		complete: function (xhr, status) {
		}
	});
	
	return false;
} // end of function checkMenuAuth

/**
 * 메소드명: getVersion
 * 작성자: 김목영
 * 설 명: Web에서 Mobile의 Version 정보를 가져옵니다.
 *
 * 최초작성일: 2017.11.09
 * 최종수정일: 2017.11.09
 * ---
 * Date              Auth        Desc
 */
function getVersion() {
	// IOS Version 호출
	if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
        webkit.messageHandlers.jmobile.postMessage({fn: "getVersion"});
		// location.href = 'jmobile://getVersion';
	} 
	// Android Version 호출
	else if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.Android) {
		if (window.JMobile)	window.JMobile.getVersion();
	}
} // end of function getVersion

/**
 * 메소드명: setVersion
 * 작성자: 김목영
 * 설 명: Mobile의 version 값을 Web으로 전달합니다.
 *
 * @param String version 버전
 * 
 * 최초작성일: 2017.11.09
 * 최종수정일: 2017.11.09
 * ---
 * Date              Auth        Desc
*/
function setVersion(version) {
	jq("#version").html(version);
} // end of function setVersion

/**
 * 메소드명: doSetLangID
 * 작성자: 김영탁
 * 설 명:  언어 셋팅 Process
 *
 * 최초작성일: 2017.11.09
 * 최종수정일: 2017.11.09
 * ---
 * Date              Auth        Desc
 */
function doSetLangID(langID) {

	// Loading Indicator
	JLAMP.common.loading('body', 'pulse');

	jq.ajax({
		url: "/main/setLangID_prc",
		data: {
			langID: langID
		},
		type: "post",
		dataType: "json",
		async: false,
		success: function (res, status, xhr) {
			if (res) {
				if (res.returnCode == 0) {
					// alert('123');1
				} else {
					if (res.returnMsg) {
					}
				}
			}
		},
		error: function (xhr, status, error) {
			alert(error);
		},
		complete: function (xhr, status) {
			JLAMP.common.loadingClose('body');
		}
	});

} // end of function doSetLangID

/**
 * 메소드명: setRegistDevice
 * 작성자: 김목영
 * 설 명: Mobile의 DeviceID 및 version 값을 Web으로 전달합니다.
 *
 * @param String deviceID 디바이스 번호
 * @param String version 버전
 * 
 * 최초작성일: 2019.04.09
 * 최종수정일: 2019.04.09
 * ---
 * Date              Auth        Desc
*/


/**
 * 메소드명: setRegistID
 * 작성자: 김목영
 * 설 명: Mobile의 DeviceID 값을 Web으로 전달합니다.
 *
 * @param String deviceID 디바이스 번호
 * @param String version 버전
 * 
 * 최초작성일: 2019.04.09
 * 최종수정일: 2019.04.09
 * ---
 * Date              Auth        Desc
*/
function setRegistID(deviceID) {
	m_deviceID = deviceID;
}

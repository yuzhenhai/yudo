jq(document).ready(function() {
	// 모바일인 경우, 기기등록 버튼 표시
	// 디바이스 ID 및 Token 설정
	if(JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS ||
		JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.Android) {
		jq("#btn_device_id").attr("type", "button");

		if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS)
			location.href='JMobile://jmDeviceLoad';
		
		getVersion();
	} else {
		jq("#btn_device_id").attr("type", "hidden");
	}
	//如果是从其他地区切换，则保存最近地区信息
	//如果是重新打开APP，则直接获取地区信息进行跳转
	if(document.referrer != ''){
        setServer(jq('#login_service_id').val());
	}
	getServer();
	// 기기번호 등록요청 버튼 클릭 이벤트
	jq("#btn_device_id").click(function() {
		if (m_deviceID != '')
			showDeviceModal();
		else {
            // showDeviceModal();
			alert('I do not know the device number.\n\nRun again.');
			// location.reload();
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

    if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
        FastClick.prototype.focus = function(targetElement) {
            targetElement.focus();
        };
        FastClick.attach(document.body);
    }
    // setServiceMsg(jq('#login_service_id').val(),'noGo')
});

function serverOnchange() {
	var server = jq('#login_service_id').val()
    setServer(server);
}
//跳转到地区服务器，如果地区服务器界面为当前打开界面，则不跳转
function getServer() {
	try{
        var server =  multi.getLocalStorage('server')
	}catch (e) {
		mui.alert('localstorage 错误！','YUDO MOBILE ERP');
        jq('#downLoadScript').remove();
    }
    if(server != false) {

        changeServer(server);
    }else{
        jq('#downLoadScript').remove();
	}
}
//设置地区信息并且跳转，如果地区服务器界面为当前打开界面，则不跳转
function setServer(server) {
    try{
        multi.setLocalStorage('server',server);
        changeServer(server);
    }catch (e) {
        mui.alert('localstorage 错误！','YUDO MOBILE ERP');
    }
}

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
                            case 'YUDO_SZ':
                                window.location.href='http://merp.yudo.com.cn:8183'+gets;
                                break;
                            case 'YUDO_GD':
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
		mui.alert("Please enter your LOGIN ID.",'YUDO APP');
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
						alert("Your registration request was successful. Please contact the administrator.");
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

/**
 * 메소드명: doLogin
 * 작성자: 김목영
 * 설 명:  로그인 Process
 *
 * 최초작성일: 2017.11.09
 * 최종수정일: 2017.11.09
 * ---
 * Date              Auth        Desc
 */

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
        alert('请输入您的账号');
        return false;
    }

    if (jq.trim(loginPwd) == "") {
    	jq("#login_pwd").val('');
        alert('请输入您的密码');
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
					multi.setLocalStorage('langCode',langID)
                    window.location.reload();
					rtnVal = true;
				} else {
                    jq("#login_pwd").val('');
					if (res.returnMsg) {
						 mui.alert(res.returnMsg,'YUDO MOBILE ERP');
					}
				}
			}
		},
		error: function (xhr, status, error) {
            mui.hideLoading();
            mui.alert(error,'YUDO MOBILE ERP');
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
		location.href = 'jmobile://getVersion';
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


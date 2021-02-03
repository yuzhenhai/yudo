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

	// Login ID Value Check
	jq("#login_id").keyup(function() {
		jq(this).val(JLAMP.common.repID(jq(this).val()));
	})

	// 기기번호 등록요청 버튼 클릭 이벤트
	jq("#btn_device_id").click(function() {
		if (m_deviceID != '')
			showDeviceModal();
		else {
			alert('기기번호를 알수 없습니다.\n\n다시 실행 합니다.');
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

});

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
		alert("LOGIN ID를 입력해주세요.");
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
						alert("등록요청에 성공하였습니다. 관리자에게 문의해주세요.");
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
function doLogin() {
	var loginID = jq("#login_id").val();
	var loginPwd = jq("#login_pwd").val();
	var isSaveID = jq("#save_id").is(":checked") == true ? "Y" : "N";
	var autoLogin = jq("#auto_login").is(":checked") == true ? "Y" : "N";
	var deviceID = m_deviceID;
	var rtnVal = false;
	
    if (jq.trim(loginID) == "") {
        jq("#login_id").val('');
        alert('아이디를 입력해 주십시오.');
        return false;
    }

    if (jq.trim(loginPwd) == "") {
    	jq("#login_pwd").val('');
        alert('비밀번호를 입력해 주십시오.');
        return false;
    }

	// Loading Indicator
	JLAMP.common.loading('body', 'pulse');

	jq.ajax({
		url: "/main/login_prc",
		data: {
			loginID: loginID,
			loginPwd: loginPwd,
			isSaveID: isSaveID,
			autoLogin: autoLogin,
			deviceID: deviceID,
			path: '/'
		},
		type: "post",
		dataType: "json",
		async: false,
		success: function (res, status, xhr) {
			if (res) {
				if (res.returnCode == 0) {
					rtnVal = checkMenuAuth();
				} else {
					if (res.returnMsg) {
						alert(res.returnMsg);
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

	return rtnVal;
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
function checkMenuAuth() {
	var rtnVal = false;
	var browserPathName = window.location.pathname;
	
	jq.ajax({
		url: "/main/checkMenuAuth_prc",
		type: "post",
		dataType: "json",
		async: true,
		success: function (res, status, xhr) {
			if (res) {
				if (res.returnCode == 0) {
					jq('body').append('<form id="redirectFrm" method="post" action="/"></form>');
					jq('#redirectFrm').submit();
				} else {
					alert(res.returnMsg);
					doLogout('NOCONFIRM');
				}
			}
		},
		error: function (xhr, status, error) {
			alert(error);
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
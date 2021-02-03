var m_commCultureType = '';
var m_deviceID = '';    // 디바이스 고유 번호
var m_deviceToken = ''; // 디바이스 Token Key
var m_deviceType = ''; // 디바이스 타입(A/I)

jq(document).ready(function() {
	// kendo UI 문화권 설정
	switch(jq("[j-layout-langid]").val()) {
		// 대한민국
		case "KOR":
			m_commCultureType = "ko";
			break;
		case "ENG":
            m_commCultureType = "en";
            break;
		case "CHN":
            m_commCultureType = "zh-CN";
            break;

		// 기본(미국)
		default:
			break;
	}

	// 로그아웃 버튼 설정
	setTopIcon();
	
	// 로그아웃 버튼 클릭 이벤트
	jq(".top_logout").click(function() {
		doLogout();
	});

	// 오토바인딩 로드
	JLAMP.autoBinding.makeAll();
	
	// 모달창 로드
	JLAMP.modal.makeAll();
	
	// 메뉴 세팅
	setMenu();

	// 중앙 로고 이미지 클릭 이벤트
	jq("#imgTopLogo").click(function() {
		location.href='/Menu/Menu/menuLists?formKey='+jq("#form_key").val()+'&menuSelection='+jq("#menu_selection").val();
	});

});

/**
 * 메소드명: doDeviceSet
 * 작성자: 김목영
 * 설 명: App이 실행되면 Client에서 1회에 한해 해당 메소드를 호출합니다.
 *
 * @param string version 버전명
 * @param String deviceID 디바이스 고유 번호
 * @param String deviceToken 디바이스 Token Key (Message Push 기능을 사용하지 않는 경우 null)
 * 
 * 최초작성일: 2017.11.09
 * 최종수정일: 2017.11.09
 * ---
 * Date              Auth        Desc
 */ 
function doDeviceSet(version, deviceID, deviceToken) {
	// 안드로이드 업데이트
	if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.Android) doUpdate(version);

	m_deviceID = deviceID;
	m_deviceToken = deviceToken;
	m_deviceType = (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) ? 'I' : 'A';
} // end of function doDeviceSet
	
/**
 * 메소드명: setTopIcon
 * 작성자: 김목영
 * 설 명: 상단 아이콘 처리
 *
 * 최초작성일: 2017.11.09
 * 최종수정일: 2017.11.09
* ---
* Date              Auth        Desc
*/
function setTopIcon() {
	var browserPathName = window.location.pathname;
	if (browserPathName != '/') {
    	jq('.top_logout').show();
	}
} // end of function setTopIcon

/**
 * 메소드명: doLogout
 * 작성자: 김목영
 * 설 명: 로그아웃 처리
 * 
 * @param string confirmYn Confirm 창 표시 여부
 *
 * 최초작성일: 2017.11.09
 * 최종수정일: 2017.11.09
 * ---
* Date              Auth        Desc
*/
function doLogout(confirmYn) {
	var browserPathName = window.location.pathname;
	var pathArr = browserPathName.split('/');
	var formData = {
		workType: 'CLOSE', 
		formID: pathArr[(pathArr.length - 1)],
		formName: jq('.top_header').text(),
		formKey: jq("#form_key").val(),
		path: ''
	};
	
	// FormAccessLog 저장 메소드 호출
	setFormAccessLog(formData);
	
	if (confirmYn == 'NOCONFIRM') {
		// Loading Indicator
		JLAMP.common.loading('body', 'pulse');
		
		jq.ajax({
			url: "/main/logout_prc",
			data: {
			},
			type: "post",
			dataType: "json",
			async: false,
			success: function (res, status, xhr) {
				if (res) {
					if (res.returnCode == 0) {
						location.href = '/?deviceType=' + JLAMP.common.getDeviceType() + '&devicePlatform=' + JLAMP.common.getDevicePlatform();
					} else {
						if (res.returnMsg) {
							var msg = res.returnMsg;
							msg = msg.replace(/\\n/g,'\n');
							alert(msg);
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
	} else {
    	//if (confirm("로그아웃 하시겠습니까?") == true){    //확인
    		// Loading Indicator
    		JLAMP.common.loading('body', 'pulse');
    		
    		jq.ajax({
    			url: "/main/logout_prc",
    			data: {
    			},
    			type: "post",
    			dataType: "json",
    			async: false,
    			success: function (res, status, xhr) {
    				if (res) {
    					if (res.returnCode == 0) {
    						location.href = '/?deviceType=' + JLAMP.common.getDeviceType() + '&devicePlatform=' + JLAMP.common.getDevicePlatform();
    					} else {
    						if(res.returnMsg) {
    							var msg = res.returnMsg;
    							msg = msg.replace(/\\n/g,'\n');
    							alert(msg);
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
    	//} else {   //취소
    		//return;
    	//}
	}	
} // end of function doLogout

/**
 * 메소드명: setEditableColumn
 * 작성자: 최영은
 * 설 명: Kendo UI Grid 수정 가능 cell의 header style 설정
 * 
 * @param string id - grid가 생성된 영역의 id
 * @param int index - 설정할 cell의 index
 *
 * 최초작성일: 2016.10.27
 * 최종수정일: 2016.10.27
 * ---
 * Date              Auth        Desc
 */
function setEditableColumn(id, index){
	jq('#'+ id +' .k-grid-header th.k-header:nth-child(' + index + ')').addClass('header_necessary');
	return false;
} // end of function setEditableColumn

/**
 * 메소드명: setNecessaryColumn
 * 작성자: 최영은
 * 설 명: Kendo UI Grid 필수 항목 cell의 header style 설정
 * 
 * @param string id - grid가 생성된 영역의 id
 * @param int index - 설정할 cell의 index
 *
 * 최초작성일: 2016.10.27
 * 최종수정일: 2016.10.27
 * ---
 * Date              Auth        Desc
 */
function setNecessaryColumn(id, index, align){
	align != '' ? align = "text-align:" + align + ";" : "";

	jq('#'+ id +' .k-grid-header th.k-header:nth-child('+index+')').attr('style', 'color:#fff000; font-weight:500;' + align);
	jq('#'+ id +' .k-grid-header th.k-header:nth-child('+index+') .k-link').attr('style', 'color:#fff000; font-weight:500;');
	return false;
} // end of function setNecessaryColumn

/**
 * 메소드명: setEnableDatepickers
 * 작성자: 최영은
 * 설 명: 특정 datapicker의 활성화 / 비활성화 처리 & style
 * 
 * @param string id - datapicker의 id
 * @param string enable - 활성화(true) / 비활성화(false) 여부
 * @param string bgcolor - 배경색
 *
 * 최초작성일: 2016.11.22
 * 최종수정일: 2016.11.22
 * ---
 * Date              Auth        Desc
 */
function setEnableDatepickers(id, enable, bgcolor) {
	// datapicker 활성화 여부
	jq("#"+id).data("kendoDatePicker").enable(enable);

if(enable) {
	jq("#"+id).attr('style', 'background: ' + bgcolor + ';cursor: pointer;border-radius:0 0 0 0;');
	jq("#"+id).data("kendoDatePicker").readonly();
	jq(".k-datepicker .k-state-default .k-select").attr('style', 'background: #fff;cursor: pointer;border-radius:0 0 0 0;');
} else {
	jq("#"+id).attr('style', 'background: ' + bgcolor + ';cursor: not-allowed;border-radius:0 0 0 0;');
	jq(".k-datepicker .k-state-disabled .k-select").attr('style',  'background: #f4f5f5;cursor: not-allowed;border-radius:0 0 0 0;');
}

	return false;
} // end of function setEnableDatepickers

/**
 * 메소드명: setDatepickerReadOnly
 * 작성자: 최영은
 * 설 명: datepicker readonly click시 datepicker 오픈처리
 *
 * 최초작성일: 2016.12.02
 * 최종수정일: 2017.02.20
 * ---
 * Date              Auth        Desc
 * 2017.02.20 	김목영	   달력이 disabled인 경우 표시 되지 않도록 수정
 */
function setDatepickerReadOnly() {
	// datepicker input 클릭 시 datepicker 오픈 - 최영은 2016.12.01
	jq('.datepickerOpen').click(function(){
		// var id = jq(this).attr('id');
		var datepickerInput = jq(this).children().children(); 
		var id = datepickerInput.attr('id');
		
		if(id != undefined) {
    		if(jq(this).children().attr('class') != "k-picker-wrap k-state-disabled")
    			jq("#" + id).data("kendoDatePicker").open();
		}
	});

	// datepicker 달력이미지 버튼 클릭 시 datepicker 오픈 - 최영은 2016.12.01
	jq('.k-select').click(function(){
		var id = jq(this).attr('aria-controls').replace(/_dateview/g,'');
		
		if(jq(this).parent().attr('class') != "k-picker-wrap k-state-disabled")
			jq("#" + id).data("kendoDatePicker").open();
	});
} // end of function setDatepickerReadOnly


/**
 * 메소드명: setNoRecordsText
 * 작성자: 최영은
 * 설 명: datepicker readonly click시 datepicker 오픈처리
 *
 * 최초작성일: 2016.12.02
 * 최종수정일: 2016.12.02
 * ---
 * Date              Auth        Desc
 */
function setNoRecordsText() {
	var text = "<div  class='setNoRecords'><span>조회된 데이터가 없습니다.</span></div>";
	return text;
} // end of function setNoRecordsText

/**
 * 메소드명: setDateBtn
 * 작성자: 김목영
 * 설 명:  Kendo DatePicker Custom 버튼 세팅
 * 
 * @param string id input id
 * @param string dateType 일자별/월별/연도별 (day, month, year)
 *
 * 최초작성일: 2017.11.09
 * 최종수정일: 2017.11.09
 * ---
 * Date              Auth        Desc
 */
function setDateBtn(id, dateType) {
	var obj = jq("#" + id);
	
	// Kendo 달력 아이콘 삭제
	obj.siblings('span').remove();
	
	obj.parent().parent().parent().before('<td>' + 
					' 	<button class="btn btn-default btn_date_pre" type="button"><img src="/Image/icon_left.png" alt=""></button>' + 
					'</td>');
	
	obj.parent().parent().parent().after('<td>' + 
    			 ' 	<button class="btn btn-default btn_date_after" type="button"><img src="/Image/icon_right.png" alt=""></button>' + 
    			 '</td>');
	
	// 이전 버튼 클릭 이벤트
	jq(".btn_date_pre").click(function() {
		var date = new Date(obj.data("kendoDatePicker").value());
		switch(dateType) {
		case "day":
			date.setDate(date.getDate() - 1);
			break;
		case "month":
			date.setMonth(date.getMonth() - 1);
			break;
		case "year":
			date.setFullYear(date.getFullYear() - 1);
			break;
		}
		obj.data("kendoDatePicker").value(date);
	});
	
	// 다음 버튼 클릭 이벤트
	jq(".btn_date_after").click(function() {
		var date = new Date(obj.data("kendoDatePicker").value());
		switch(dateType) {
		case "day":
			date.setDate(date.getDate() + 1);
			break;
		case "month":
			date.setMonth(date.getMonth() + 1);
			break;
		case "year":
			date.setFullYear(date.getFullYear() + 1);
			break;
		}
		obj.data("kendoDatePicker").value(date);
	});
} // end of function setDateBtn

/**
 * 메소드명: getFormInfo
 * 작성자: 김목영
 * 설 명:  현재 페이지 및 이동할 페이지의 정보를 로그에 저장합니다.
 *
 * @param string path 현재/다음 페이지
 * @param string formID Form ID
 * @param string formName Form Name
 * 
 * 최초작성일: 2017.04.05
 * 최종수정일: 2017.04.05
  * ---
  * Date              Auth        Desc
  */
function getFormInfo(path, formID, formName) {
	var browserPathName = window.location.pathname;
	var pathArr = browserPathName.split('/');
	
	var preFormData = {
		workType: 'CLOSE', 
		formID: pathArr[(pathArr.length - 1)],
		formName: jq('.top_header').text(),
		formKey: jq("#form_key").val(),
		path: '',
	};

	var formData = {
		workType: 'OPEN', 
		formID: formID,
		formName: formName,
		formKey: '',
		path: path
	};
	
	// FormAccessLog 저장 메소드 호출
	setFormAccessLog(preFormData);
	setFormAccessLog(formData);
} // end of function getFormInfo
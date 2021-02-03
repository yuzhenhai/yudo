// Yudo GD

jq(document).ready(function() {
});

/**
 * 메소드명: doUpdate
 * 작성자: 김목영
 * 설 명: 버전을 체크하여 Client 버전이 높을 경우 APP Update를 실행합니다. (Android)
 *
 * @param string version 버전명
 * 
 * 최초작성일: 2017.06.29
 * 최종수정일: 2017.06.29
 * ---
 * Date              Auth        Desc
 * 2019.01.22		 서정민		버전 비교 로직 변경
*/

function doUpdate(version) {
	// 모바일인 경우
	if(isUpdateNeed(version)){
		if (JLAMP.common.getDeviceType() === JLAMP.deviceType.Mobile) {
				if (window.JMobile) window.JMobile.doUpdate();
		}
		// 태블릿인 경우
		else if (JLAMP.common.getDeviceType() === JLAMP.deviceType.Tablet) {
				if (window.JTablet) window.JTablet.doUpdate();
		}
	}
} // end of function doUpdate

/**
 * 메소드명: isUpdatedNeed
 * 작성자: 서정민
 * 설 명: '.'을 기준으로 메이저/마이너 버전을 구분하여 서버와 클라이언트 간 버전을 비교합니다. (메이저 우선 비교)
 *
 * @param string clientVersion 클라이언트 버전
 * 
 * @return bool - 서버 버전이 더 높은 경우 TRUE, 그렇지 않을 경우 FALSE 반환
 * 
 * 최초작성일: 2019.01.22
 * 최종수정일: 2019.01.22
 * ---
 * Date              Auth        Desc
*/
function isUpdateNeed(clientVersion){
	var serverVer = loadVersion();
	var clientVer = clientVersion.split(".");

	var serverMajor = serverVer.major;
	var serverMinor = serverVer.minor;

	var clientMajor = Number(clientVer[0]);
	var clientMinor = Number(clientVer[1]);
	
	//서버 메이저가 더 클 경우
	if(serverMajor > clientMajor){
		return true;
	}
	//서버와 클라 메이저가 같을 경우
	else if(serverMajor == clientMajor){
		//서버 마이너가 더 클 경우
		if(serverMinor > clientMinor){
			return true;
		}
		//클라 마이너와 같거나 클라 마이너가 더 클 경우
		else{
			return false;
		}
	}
	//클라 메이저가 더 클 경우
	else{
		return false;
	}
}

/**
 * 메소드명: isUpdatedNeed
 * 작성자: 서정민
 * 설 명: Version.js 파일에서 현재 버전정보를 불러온다
 * 
 * 최초작성일: 2019.02.22
 * 최종수정일: 2019.02.22
 * ---
 * Date              Auth        Desc
*/
function loadVersion(){
	var version = null;
	jq.ajax({
		url: 'js/version.json',
		dataType: 'json',
		async: false,
		data: null
	}).done(function(data) {
		version = data.version;
	}).fail(function(xhr, status, error){
		console.log(error);
	});
	
	return version;
}

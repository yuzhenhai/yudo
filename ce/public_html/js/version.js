var m_mobileVer = "1.0";    // 모바일 버전
var m_tabletVer = "1.0";      // 태블릿 버전

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
*/
function doUpdate(version) {
	var clientVer = parseFloat(version);
	var serverVer = '';

	// 모바일인 경우
	if (JLAMP.common.getDeviceType() === JLAMP.deviceType.Mobile) {
		serverVer = parseFloat(m_mobileVer);

		if (serverVer > clientVer) {
			if (window.JMobile) window.JMobile.doUpdate();
		}
	}
	// 태블릿인 경우
	else if (JLAMP.common.getDeviceType() === JLAMP.deviceType.Tablet) {
		serverVer = parseFloat(m_tabletVer);

		if (serverVer > clientVer) {
			if (window.JTablet) window.JTablet.doUpdate();
		}
	}
} // end of function doUpdate
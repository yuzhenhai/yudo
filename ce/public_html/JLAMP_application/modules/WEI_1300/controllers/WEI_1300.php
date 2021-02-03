<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * 클래스명: WEI_1300
 * 작성자: 김목영
 * 클래스설명: 미진행실적 클래스
 *
 * 최초작성일: 2017.11.13
 * 최종수정일: 2017.11.13
 * ---
 * Date         Auth        Desc
 */
class WEI_1300 extends Base {
	function __construct() {
		parent::__construct();
	}

	public function index() {
		$this->lists();
	}

	/**
	 * 메소드명: lists
	 * 작성자: 김목영
	 * 설 명: 미진행실적 페이지
	 *
	 * 최초작성일: 2017.11.13
	 * 최종수정일: 2017.11.13
	 * ---
	 * Date              Auth        Desc
	 */
	public function lists() {

		$formKey = $this->jlamp_comm->xssInput('formKey', 'get');
		//$langID = $this->jlamp_comm->xssInput('langID', 'get');
		$menuSelection = $this->jlamp_comm->xssInput('menuSelection', 'get');
		
		$this->jlamp_comm->isHtmlDisplay(true);

		//$this->load->library('lib_comm');
		//$subTitle = $this->lib_comm->getMenuName();

		$this->jlamp_tp->assign(array(
            //'subTitle' => $subTitle,
            'formKey' => $formKey,
			//'langID' => $langID,
			'menuSelection' => $menuSelection
		));

        $this->jlamp_tp->define(['tpl' => 'SalesManageView/WEI_1300_Lists.html']);
        $this->jlamp_tp->template_dir = VIEWS;
	} // end of function lists

	/**
	 * 메소드명: lists_prc
	 * 작성자: 김목영
	 * 설 명: 미진행실적 조회 Process
	 *
	 * 최초작성일: 2017.11.13
	 * 최종수정일: 2017.11.13
	 * ---
	 * Date              Auth        Desc
	 */
	public function lists_prc() {
		$result = array(
			'returnCode' => 0,
			'returnMsg' => '',
			'data' => ''
		);
		
		$workType = $this->jlamp_comm->xssInput('workType', 'get'); // 구분
		$baseDate = $this->jlamp_comm->xssInput('baseDate', 'get'); // 기준일
		$langCode = parent::getLangID(); // 언어

		$decimal = parent::getSessionInfo('Amount2'); // 금액 소수점

		$html = '';

		// 유효성 검사
		// 기준일
		if (empty($baseDate)) {
			$result['returnCode'] = 'I001';
			$result['returnMsg'] = '기준일은 필수입력입니다.';
		
			$this->jlamp_comm->jsonEncEnd($result);
		}

		// 기준일
		if (empty($langCode)) {
			$result['returnCode'] = 'I002';
			$result['returnMsg'] = '언어는 필수입력입니다.';
		
			$this->jlamp_comm->jsonEncEnd($result);
		}

		switch ($langCode) {
			case "KOR":
				$langCode = "SM00010001";
				break;
			case "CHN": 
				$langCode = "SM00010003";
				break;
			case "ENG": 
				$langCode = "SM00010002";
				break;
			case "JPN":
				$langCode = "SM00010004";
				break;
			default:
				break;
		}


		
		$spName = 'SSADayTotal_SZ2_M';
		$params = array(
			'pWorkingTag' => $workType,
			'pBaseDt' => mb_ereg_replace('-', '', $baseDate),
			'pLangCd' => $langCode
		);
		
		try {
			$res = $this->jlamp_common_mdl->spRows($spName, $params);
			// print_r($this->jlamp_common_mdl->lastQuery());
			// print_r($res);

			if (count($res)) {
				// 에러코드가 'E', 'P' 가 아닌 경우
				if (substr($res[count($res)-1][0]->p_error_code, 0, 1) != 'E' && substr($res[count($res)-1][0]->p_error_code, 0, 1) != 'P') {
					if ($res[0]) $result['data']['res'] = $res[0];
				}

				$result['data']['valid'] = $res[count($res)-1][0];
			} else {
				$result['returnCode'] = 'I001';
				$result['returnMsg'] = '검색 작업 시 오류가 발생하였습니다.';
			}
		} catch (Exception $e) {
			$result['returnCode'] = 'E001';
			$result['returnMsg'] = $e->getMessage();
		}
		$this->jlamp_comm->jsonEncEnd($result, true);
	} // end of function lists_prc
}

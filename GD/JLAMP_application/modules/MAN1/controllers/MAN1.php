<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

class MAN1 extends Base {
    function __construct() {
		parent::__construct();
	}

	public function index() {
        $formKey = $this->jlamp_comm->xssInput('formKey', 'get');

        $cssPart = array(
            '<link rel="stylesheet" href="/css/MAN1/MAN1.css">'
		);
		$jsPart = array(
            '<script src="/js/MAN1/MAN1.js?20171201001"></script>'
		);

		$this->jlamp_comm->setCSS($cssPart);
        $this->jlamp_comm->setJS($jsPart);
        
        $this->jlamp_comm->isHtmlDisplay(true);

		$this->load->library('lib_comm');
        $subTitle = $this->lib_comm->getMenuName();
        
        //DB Connect
        $this->jlamp_common_mdl->DBConnect("JLAMPBiz");

        $spName = 'SSADayTotal_SZ2_M';
		$params = array(
			'pWorkingTag' => 'D',
			'pBaseDt' => '20110130',
			'pLangCd' => 'KOR'
        );
        
        try {
            $res = $this->jlamp_common_mdl->spRows($spName, $params);
        } catch (Exception $e) {
            print_r($e->getMessage());
        }

		$this->jlamp_tp->assign(array(
            'subTitle' => $subTitle,
            'formKey' => $formKey
		));
		
		$this->jlamp_tp->setURLType(array(
			'tpl' => 'MAN1.html'
		));
    }
    
    public function dbList() {
        $formKey = $this->jlamp_comm->xssInput('formKey', 'get');
        
        $cssPart = array(
            '<link rel="stylesheet" href="/css/MAN1/dbList.css">'
        );
        $jsPart = array(
            '<script src="/js/MAN1/dbList.js"></script>'
		);
		
        $this->jlamp_comm->setCSS($cssPart);
        $this->jlamp_comm->setJS($jsPart);
        
        $this->jlamp_comm->isHtmlDisplay(true);

        $this->jlamp_tp->setURLType(array(
			'tpl' => 'DBList.html'
		));
	}
	
    public function dbList_prc() {
        $result = array(
			'returnCode' => 0,
			'returnMsg' => '',
			'data' => ''
        );

        $baseDate = $this->jlamp_comm->xssInput('baseDate', 'get'); // 기준일
		$langCode = $this->jlamp_comm->xssInput('langCode', 'get'); // 언어
		        
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

		$this->jlamp_common_mdl->DBConnect("JLAMPBiz");

        $spName = 'SSADayTotal_SZ2_M';
		$params = array(
			'pWorkingTag' => 'D',
			'pBaseDt' => mb_ereg_replace('-', '', $baseDate),
			'pLangCd' => $langCode
		);

        try {
			$res = $this->jlamp_common_mdl->spRows($spName, $params);
			//print_r($this->jlamp_common_mdl->lastQuery());
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
	}
	
	public function WEI_1300() {
		$jsPart = array(
            '<script src="/js/MAN1/WEI_1300.js?v=20171201001"></script>'
		);
		$this->jlamp_comm->setJS($jsPart);

		$this->jlamp_tp->setURLType(array(
			'tpl' => 'WEI_1300.html'
		));
	}

	public function WEI_1300_prc() {
		$result = array(
			'returnCode' => 0,
			'returnMsg' => '',
			'data' => ''
		);
		
		$workType = $this->jlamp_comm->xssInput('workType', 'get'); // 구분
		$baseDate = $this->jlamp_comm->xssInput('baseDate', 'get'); // 기준일
		$langCode = $this->jlamp_comm->xssInput('langCode', 'get'); // 언어

		$decimal = parent::getSessionInfo('Amount2'); // 금액 소수점

		$html = '';

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

		$this->jlamp_common_mdl->DBConnect("JLAMPBiz");
		
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
				if ($res[0]) $result['data']['res'] = $res[0];

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
	}

	public function upload_prc() {
        $result = array(
            'returnCode' => 0,
            'returnMsg' => '',
			'data' => ''
        );
        
        // 사진 이미지 등록
        if ($_FILES['upload_file']['name']) {
            $this->jlamp_upload->setAllowType(array('jpg', 'png'));
            $this->jlamp_upload->setOverWrite(false);
            $this->jlamp_upload->setUploadFileSize(40960);
			$data = $this->jlamp_upload->doUpload('upload_file', 'pic', true, true, 137, 176);
			$result['data'] = $data;
        }  
        
        $this->jlamp_comm->jsonEncEnd($result); 
    }
}
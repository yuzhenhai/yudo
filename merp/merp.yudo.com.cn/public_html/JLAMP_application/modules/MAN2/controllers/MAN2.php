<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * MAN2 Test
 */
class MAN2 extends JLAMP_Controller {
	function __construct() {
		parent::__construct();
	}

	public function index() {
        $formKey = $this->jlamp_comm->xssInput('formKey', 'get');
        $this->jlamp_comm->isHtmlDisplay(true);

        $cssPart = array(
            '<link rel="stylesheet" type="text/css" href="/css/MAN2/man2.css" />'
        );

        $jsPart = array(
            '<script src="/js/MAN2/index.js?v='.time().'"></script>'
        );

        $this->jlamp_comm->setCSS($cssPart);
        $this->jlamp_comm->setJS($jsPart);

        $this->load->library('lib_comm');
        $subTitle = $this->lib_comm->getMenuName();

        $this->jlamp_tp->assign(array(
            'formKey' => $formKey,
            'subTitle' => $subTitle
        ));

        $this->jlamp_tp->setURLType(array(
            'tpl' => 'hello.html'
        ));
    }
    
    /**
     * get db lis
     */
    public function getDBList(){

        $formKey = $this->jlamp_comm->xssInput('formKey', 'get');
        
        $this->jlamp_comm->isHtmlDisplay(true);

        $cssPart = array(
            '<link rel="stylesheet" type="text/css" href="/css/MAN2/man2.css" />'
        );

        $jsPart = array(
            '<script src="/js/MAN2/db_list.js"></script>'
        );

        $this->jlamp_comm->setCSS($cssPart);
        $this->jlamp_comm->setJS($jsPart);

        $this->load->library('lib_comm');
        $subTitle = $this->lib_comm->getMenuName();

        $this->jlamp_tp->assign(array(
            'subTitle' => $subTitle,
            'formKey' => $formKey
        ));

        $this->jlamp_tp->setURLType(array(
            'tpl' => 'db_list.html'
        ));

    }

    /**
     * get db list
     * ajax
     */
    public function getDBList_prc(){
        $formKey = $this->jlamp_comm->xssInput('formKey', 'get');
        $baseData = $this->jlamp_comm->xssInput('basedata', 'get');
        $langCode = $this->jlamp_comm->xssInput('langCode', 'get');
        
        $this->jlamp_common_mdl->DBConnect('JLAMPBiz');

        $sqName = 'SSADayTotal_SZ2_M';
        $param = array(
            'pWorkingTag' => 'D',
            'pBaseDt' => mb_ereg_replace('-', '', $baseData),
            'pLangCd' => $langCode
        );

        try {
            $res = $this->jlamp_common_mdl->spRows($sqName, $param);
            if (count($res)) {
                if (substr($res[count($res)-1][0]->p_error_code, 0, 1) != 'E' && substr($res[count($res)-1][0]->p_error_code, 0, 1) != 'P') {
                    if ($res[0]) {
                        $result['data']['res'] = $res[0];
                    }
                }
                $result['data']['valid'] = $res[count($res)-1][0];
            } else {
                $result['returnCode'] = 'I001';
                $result['returnMsg'] = '数据查询异常';
            }
        } catch(Exception $e) {
            $result['returnCode'] = 'E001';
            $result['returnMsg'] = $e->getMessage();
        }

        $this->jlamp_comm->jsonEncEnd($result, true);
    }

    /**
     * wei
     */
    public function wei(){
        $this->jlamp_comm->isHtmlDisplay(true);
        $this->jlamp_tp->setURLType(array(
            'tpl' => 'wei_1300.html'
        ));
    }
    /**
     * wei
     * ajax
     */
    public function wei_prc(){
        $result = array(
            'returnCode' => 0,
            'returnMsg' => '',
            'data' => ''
        );

        $workType = $this->jlamp_comm->xssInput('workType', 'get');
        $baseDate = $this->jlamp_comm->xssInput('baseDate', 'get');
        $langCode = $this->jlamp_comm->xssInput('langCode', 'get');

        $decimal = parent::getSessionInfo('Amount2');

        $html = '';

        switch($langCode) {

        }

        $this->jlamp_common_mdl->DBConnect('JLAMPBiz');

        $sqName = 'SSADAYTotal_SZ2_M';
        $params = array(
            'PWorkingTag' => $workType,
            'pBaseDt' => md_erge_replace('-','',$baseData),
            'pLangCd' => $langCode
        );
        try {
            $res = $this->jlamp_common_mdl->sqRows($sqName, $params);
            if (count($res)) {
				if (substr($res[count($res)-1][0]->p_error_code, 0, 1) != 'E' && substr($res[count($res)-1][0]->p_error_code, 0, 1) != 'P') {
					if ($res[0]) $result['data']['res'] = $res[0];
				}

				$result['data']['valid'] = $res[count($res)-1][0];
			} else {
				$result['returnCode'] = 'I001';
				$result['returnMsg'] = 'has error.';
			}
        } catch(Exception $e) {
            $result['returnCode'] = 'E001';
			$result['returnMsg'] = $e->getMessage();
        }
        $this->jlamp_comm->jsonEncEnd($result, true); 
    }

    public function doUpload_prc(){
        $result = array(
            'returnCode' => 0,
            'returnMsg' => '',
            'data' => ''
        );

        if ($_FILES['upload_file']['name']) {
            $this->jlamp_upload->setAllowType(array('jpg', 'png'));
            $this->jlamp_upload->setOverWrite(false);
            $this->jlamp_upload->setUploadFileSize(40960);
            $data = $this->jlamp_upload->doUpload('upload_file', 'my', true, true, 140, 150);
            //var_dump($data);
            $result['data'] = $data;

            $this->jlamp_comm->jsonEncEnd($result);
        }
    }
}

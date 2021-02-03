<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MAN3 extends JLAMP_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $cssPart = array(
            '<link rel="stylesheet" href="/css/MAN3/MAN3.css">'
        );
        $jsPart = array(
            '<script src="/js/MAN3/MAN3.js"></script>'
        );

        $formKey = $this->jlamp_comm->xssInput('formKey', 'get');

        $this->jlamp_comm->isHtmlDisplay(true);
        $this->jlamp_comm->setCSS($cssPart);
        $this->jlamp_comm->setJS($jsPart);

        $this->load->library('lib_comm');
        $subTitle = $this->lib_comm->getMenuName();

        // DB Connect
        $this->jlamp_common_mdl->DBConnect("JLAMPBiz");

        $spName = 'SSADayTotal_SZ2_M';
        $params = array(
            'pWorkingTag' => 'D',
            'pBaseDt' => '20161129',
            'pLangCd' => 'KOR'
        );

        try {
            $res = $this->jlamp_common_mdl->spRows($spName, $params);
//            print_r($res);
        } catch (Exception $e) {
            print_r($e->getMessage());
        }

        // foreach ($res as $key => $val) {
        // 	$k = $key;
        // 	$v = $val;
        // 	return;
        // }

        $this->jlamp_tp->assign(array(
            'subTitle' => $subTitle,
            'formKey' => $formKey
        ));

        $this->jlamp_tp->setURLType(array(
            'tpl' => 'MAN3.html'
        ));
    }

    public function dbList()
    {
        $cssPart = array(
            '<link rel="stylesheet" href="/css/MAN3/MAN3.css">'
        );
        $jsPart = array(
            '<script src="/js/MAN3/dblist.js"></script>'
        );

        $this->jlamp_comm->isHtmlDisplay(true);
        $this->jlamp_comm->setCSS($cssPart);
        $this->jlamp_comm->setJS($jsPart);
        $this->jlamp_tp->setURLType(array(
            'tpl' => 'dblist.html'
        ));
    }

    public function dblist_prc()
    {
        $result = array(
            'returnCode' => 0,
            'returnMsg' => '',
            'data' => ''
        );

        $workType = $this->jlamp_comm->xssInput('workType', 'get');
        $baseDate = $this->jlamp_comm->xssInput('baseDate', 'get');
        $langCode = $this->jlamp_comm->xssInput('langCode', 'get');

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

            if (count($res)) {
                if (substr($res[count($res) - 1][0]->p_error_code, 0, 1) != 'E' && substr($res[count($res) - 1][0]->p_error_code, 0, 1) != 'P') {
                    if ($res[0]) $result['data']['res'] = $res[0];
                }

                $result['data']['valid'] = $res[count($res) - 1][0];
            } else {
                $result['returnCode'] = 'I001';
                $result['returnMsg'] = 'lost res!';
            }
        } catch (Exception $e) {
            $result['returnCode'] = 'E001';
            $result['returnMsg'] = $e->getMessage();
        }
        $this->jlamp_comm->jsonEncEnd($result, true);
    }

    public function WEI()
    {
        $cssPart = array(
            '<link rel="stylesheet" href="/css/MAN3/MAN3.css">'
        );
        $jsPart = array(
            '<script src="/js/MAN3/WEI.js"></script>'
        );

        $this->jlamp_comm->isHtmlDisplay(true);
        $this->jlamp_comm->setCSS($cssPart);
        $this->jlamp_comm->setJS($jsPart);
        $this->jlamp_tp->setURLType(array(
            'tpl' => 'WEI.html'
        ));
    }

    public function upload_prc()
    {
        $result = array(
          'returnCode' => 0,
          'returnMsg' => '',
          'data' => ''
        );

        if ($_FILES['upload_file']['name']) {
            $this->jlamp_upload->setAllowType(array('jpg', 'png'));
            $this->jlamp_upload->setOverWrite(false);
            $this->jlamp_upload->setUploadFileSize(204800);
            $data = $this->jlamp_upload->doUpload('upload_file', 'zyc', true, true, 137, 176);
            $result['data'] = $data;
        }

        $this->jlamp_comm->jsonEncEnd($result);
        $this->index();
    }
}
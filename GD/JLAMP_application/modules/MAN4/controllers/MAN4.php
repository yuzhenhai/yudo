<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MAN4 extends Base
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $man4Key = $this->jlamp_comm->xssInput('formKey', 'get');

        $man4CSS = array('<link rel="stylesheet" href="/css/MAN4/man4.css">');
        $man4JS = array('<script rel="stylesheet" src="/js/MAN4/man4.js"></script>');

        $this->jlamp_comm->setCSS($man4CSS);
        $this->jlamp_comm->setJS($man4JS);

        $this->jlamp_comm->isHtmlDisplay(true);

        $this->load->library('lib_comm');
        $subTitle = $this->lib_comm->getMenuName();

        //DB
        $this->jlamp_common_mdl->DBConnect("JLAMPBiz");

        $spName = 'SSADayTotal_SZ2_M';
        $params = array(
            'pWorkingTag' => 'D',
            'pBaseDt' => '20110130',
            'pLangCd' => 'KOR'
        );

        try {
            $res = $this->jlamp_common_mdl->spRows($spName, $params);
            //  print_r($res);
        } catch (Exception $e) {
            //  print_r($e->getMessage());
        }

        $this->jlamp_tp->assign(array(
            'subTitle' => $subTitle,
            'formKey' => $man4Key,
        ));
        $this->jlamp_tp->setURLType(array('tpl' => 'MAN4.html'));
    }

    public function dbList()
    {
        $man4CSS = array('<link rel="stylesheet" href="/css/MAN4/dbList.css">');
        $man4JS = array('<script rel="stylesheet" src="/js/MAN4/dbList.js"></script>');

        $this->jlamp_comm->setCSS($man4CSS);
        $this->jlamp_comm->setJS($man4JS);

        $this->jlamp_comm->isHtmlDisplay(true);
        $this->jlamp_tp->setURLType(array('tpl' => 'dbList.html'));
    }

    public function dbList_prc()
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
            case "CHINA":
                $langCode = "SM00010003";
                break;
            case "ENG":
                $langCode = "SM00010002";
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
                $result['returnMsg'] = '';
            }
        } catch (Exception $e) {
            $result['returnCode'] = 'E001';
            $result['returnMsg'] = $e->getMessage();
        }
        $this->jlamp_comm->jsonEncEnd($result, true);
    }

    public function man4001()
    {
        $man4JS = array('<script rel="stylesheet" src="/js/MAN4/man4001.js"></script>');

        $this->jlamp_comm->setJS($man4JS);
        $this->jlamp_comm->isHtmlDisplay(true);
        $this->jlamp_tp->setURLType(array('tpl' => 'man4001.html'));
    }

    public function upload_prc()
    {
        $result = array(
            'returnCode' => 0,
            'returnMsg' => '',
            'data' => ''
        );
        if ($_FILES['upload_file']['name']) {
            # code...
            $this->jlamp_upload->setAllowType(array('jpg', 'png'));
            $this->jlamp_upload->setOverWrite(false);
            $this->jlamp_upload->setUploadFileSize(40960);
            $data = $this->jlamp_upload->doUpload('upload_file', 'siny', true, true, 150, 150);
            $result['data'] = $data;
        }
        $this->jlamp_comm->jsonEncEnd($result);
    }
}
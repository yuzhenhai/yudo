<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Myclass extends Check_account {
    public function __construct()
    {
        parent::__construct();
    }

    public function index() {
        $cssPart = array(
            '<link rel="stylesheet" href="/css/Myclass/Myclass_Lists.css">',
            '<link rel="stylesheet" href="/js/Myclass/css/jquery.monthpicker.css">'
        );
        $jsPart = array(
            '<script src="/js/Myclass/Myclass_Lists.js?v=201804081725"></script>',
            '<script src="/js/Myclass/js/jquery.monthpicker.js"></script>'
        );
        $this->jlamp_comm->setCSS($cssPart);
        $this->jlamp_comm->setJS($jsPart);
        $this->jlamp_comm->isHtmlDisplay(true);

        $this->jlamp_tp->setURLType(array(
            'tpl' => 'myclass.html'
        ));
    }


    public function search_data()
    {
        $classChoose = $this->jlamp_comm->xssInput('gubun','get'); //== '' ? 'ALL':'ALL';
        $timeChoose = $this->jlamp_comm->xssInput('baseDate','get');// == '' ? '2018-02' : '2018-02';
        $langCode = parent::getLangID(); // 언어
        if (empty($timeChoose)) {                                 //日期是必须输入的
            $this->reback_array['returnCode'] = 'I001';
            $this->reback_array['returnMsg'] = '기준일은 필수입력입니다.';
            $this->jlamp_comm->jsonEncEnd($this->reback_array);
        }
        if (empty($langCode)) {
            $result['returnCode'] = 'I002';
            $result['returnMsg'] = '언어는 필수입력입니다.'; //语言选择错误提示
            $this->jlamp_comm->jsonEncEnd($result);
        }

        switch ($langCode) {       //查看语言选项
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

        $ASCauseDonor = '';
        switch ($classChoose){
            case 'ALL':
                $ASCauseDonor = '%';
                $this->reback_array['returnClass'] = 'ALL';
                break;
            case 'CP':
                $ASCauseDonor = 'AS10110010';
                $this->reback_array['returnClass'] = 'Cause001';
                break;
            case 'CM':
                $ASCauseDonor = 'AS10110020';
                $this->reback_array['returnClass'] = 'Cause001';
                break;
            case 'SS':
                $ASCauseDonor = 'AS10110030';
                $this->reback_array['returnClass'] = 'Cause001';
                break;
        }
        $sql_result = $this->DB_query($timeChoose,$ASCauseDonor,$langCode);
        $this->reback_array['data'] = $this->division_data($sql_result);
//        print_r($sql_result);
        $this->jlamp_comm->jsonEncEnd($this->reback_array);
    }
    private function division_data($sql_result){   //公司，客户，系统控制分类
        $yum_result = array(
            'AS10110010' => array(),
            'AS10110020' => array(),
            'AS10110030' => array()
        );
        $classrecord = array(
            'AS10110010' => array(),
            'AS10110020' => array(),
            'AS10110030' => array()
        );
        $results = $sql_result[0];

        for ($i = 0; $i < count($results); $i++) {
            $master = $results[$i]['AsClass']; //转换为分类标识
            if (!in_array($results[$i]['ASCauseName'], $classrecord[$master])) //封装数组内没有当前分类名称，则在末尾添加
            {
                $classrecord[$master][] = $results[$i]['ASCauseName'];

                $yum_result[$master][] = array(
                    'CauseClass' => $results[$i]['ASCauseName'],
                    'CauseName'  => $results[$i]['ASCauseDonor'],
                    'tate1' => 0,
                    'tate2' => 0,
                    'tate3' => 0,
                    'tate4' => 0,
                    'tate5' => 0,
                    'tate6' => 0,
                    'tate7' => 0,
                );
            }
            for ($s = 0; $s < count($yum_result[$master]); $s++) {          //存在则遍历当前选择分类，插入分类内的故障数据
                if ($yum_result[$master][$s]['CauseClass'] == $results[$i]['ASCauseName']) {
                    switch ($results[$i]['ASClass1']) {
                        case 'AS10060010':
                            $yum_result[$master][$s]['tate1'] += 1;   //不存在键位，则设置当前键位为1,存在键位则+1数量
                            break;
                        case 'AS10060060':
                            $yum_result[$master][$s]['tate2'] += 1;
                            break;
                        case 'AS10060070':
                            $yum_result[$master][$s]['tate3'] += 1;
                            break;
                        case 'AS10060040':
                            $yum_result[$master][$s]['tate4'] += 1;
                            break;
                        case 'AS10060030':
                            $yum_result[$master][$s]['tate5'] += 1;
                            break;
                        case 'AS10060020':
                            $yum_result[$master][$s]['tate6'] += 1;
                            break;
                        case 'AS10060050':
                            $yum_result[$master][$s]['tate7'] += 1;
                            break;
                    }
                }
            }
        }
        return $yum_result;
    }
    private function DB_query($timeChoose,$ASCauseDonor,$langCode){
        $this->jlamp_common_mdl->DBConnect("JLAMPBiz");
        $sql = "Select A.ASRecvNo,--AS接收编号
                A.ASRecvDate,--AS接收日期
                A.ASCauseDonor as AsClass,--AS原因_区分编号
                IsNull(BM.TransNm, B.MinorNm) As ASCauseDonor,--AS原因_区分
                A.ASClass2,--AS原因-种类编号
                IsNull(CM.TransNm, C.MinorNm) As ASCauseName,--AS原因-种类
                A.ASClass1,--AS现象编号
                IsNull(DM.TransNm, D.MinorNm) As ASStateTypenm--AS现象
                From TASRecv00 as A With(Nolock) 
                Left Outer Join TSMSyco10 B With(Nolock) On A.ASCauseDonor = B.MinorCd 
                Left Outer Join TSMSyco10 C With(Nolock) On A.ASClass2 = C.MinorCd 
                Left Outer Join TSMSyco10 D With(Nolock) On A.ASClass1 = D.MinorCd 
                Left Outer Join TSMDict10 BM With(Nolock) On B.MinorCd= BM.DictCd and BM.DictType='SM00030002' and BM.LangCd = '$langCode' 
                Left Outer Join TSMDict10 CM With(Nolock) On C.MinorCd= CM.DictCd and CM.DictType='SM00030002' and CM.LangCd = '$langCode' 
                Left Outer Join TSMDict10 DM With(Nolock) On D.MinorCd= DM.DictCd and DM.DictType='SM00030002' and DM.LangCd = '$langCode' 
                Where A.cfmyn='1' AND CONVERT(CHAR(7),A.ASRecvDate,120) like '$timeChoose%' AND A.ASCauseDonor Like '$ASCauseDonor'";
        $result = $this->jlamp_common_mdl->sqlRows($sql);
        $result = json_decode(json_encode($result),true);
        return $result;
    }
}

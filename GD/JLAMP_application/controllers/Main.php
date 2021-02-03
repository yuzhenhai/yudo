<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
    //header("Cache-Control: no-cache, must-revalidate");
    //header("Pragma: no-cache");

/**
 * 클래스명: Main
 * 작성자: 김목영
 * 클래스설명: Main
 *
 * 최초작성일: 2017.11.09
 * 최종수정일: 2017.11.09
 * ---
 * Date         Auth        Desc
 */
class main extends JLAMP_Controller {
	private $firstMenuPath = ''; // 최상단에 있는 Menu Path
    private $firstFormID = ''; // 최상단에 있는 Menu의 Form ID
	private $firstFormName = ''; // 최상단에 있는 Menu의 Form Name

	function __construct() {
		parent::__construct();
	}

	/**
	 * 메소드명: index
	 * 작성자: 김목영
	 * 설 명: 기본 DeviceType, DevicePlatform Cookie 설정 및 자동 로그인 권한 체크
	 *
	 * 최초작성일: 2017.11.09
	 * 최종수정일: 2017.11.09
	 * ---
	 * Date              Auth        Desc
	 */
	public function index() {
	    // 접속시, deviceType, devicePlatform GET방식으로 받음 (한번만 받음) (모바일의 경우 필수)
		// 웹 접근을 차단함과 동시에 모바일, 태블릿에서 해당 값을 사용
	    $deviceType = $this->jlamp_comm->xssInput('deviceType', 'get');
	    $devicePlatform= $this->jlamp_comm->xssInput('devicePlatform', 'get');

		// J.LAMP5_기타_API 참조
		// config.json에 설정되어 있는 "cookie" > "expire" 값을 가져옴 (없는 경우 0 으로 설정)
		$cookieExpire = parent::getConfig('expire', 'cookie') ? parent::getConfig('expire', 'cookie') : 0; // 쿠키 유지시간

		// J.LAMP5_Session_API 참조
		// DeviceType 및 DevicePlatform 은 클라이언트에서도 값을 사용하기 때문에 암호화 하지 않음
	    // DeviceType Cookie 설정
	    if ($deviceType)   parent::setCookie('DeviceType', $deviceType, $cookieExpire, false);
	    
	    // DevicePlatform Cookie 설정
	    if ($devicePlatform)   parent::setCookie('DevicePlatform', $devicePlatform, $cookieExpire, false);
	    
	    // 개발서버가 아닌 IP 웹 브라우저로 접근 시 제한
		// 허용하지 않은 서버에서 웹으로 접근하는 것을 차단함
		// 허용 서버는 JLAMP_application > config > constants 파일의 DEV_SERVER_IP 에 추가
	    if ((empty($deviceType) && empty(parent::getCookie('DevicePlatform', false)))&& !in_array($_SERVER['REMOTE_ADDR'], DEV_SERVER_IP)) {
	        echo "<div>접근할 수 없습니다.</div>";
	        exit;
	    }
	    // 자동로그인일 경우, 권한 체크
	    if (parent::getCookie('AutoLogIn')== '1' && parent::getCookie('AutoUserID') != '') {
			// 자동로그인에 체크를 하고 로그인시, 유효한 사용자인지 체크 후 화면으로 이동
	        $this->autoLogin();
	    }

//
//		// 判断是否登录
		if (!empty(parent::getCookie('UserID',true)) && !empty(parent::getCookie('DB',true))) {
            header('Location: /Menu');
//            $this->jlamp_tp->define(['tpl' => 'MenuView/Menu.html']);
//            $this->jlamp_tp->template_dir = VIEWS;
//			$this->dashboard();
		}
		// 권한이 없는 경우 로그인 화면으로 이동
		else {
			$this->login();
		}
	}
	public function setService(){
        $service = $this->jlamp_comm->xssInput('service', 'post');
        if(!empty($service)){
            parent::setCookie('service',$service,10000000000,false);
        }
        $result = array(
            'returnCode' => 0,
            'returnMsg' => '',
            'data' => $service
        );
        $this->jlamp_comm->jsonEncEnd($result);
	}

	/**
	 * 메소드명: dashboard
	 * 작성자: 김목영
	 * 설 명: 로그인 후 조회된 메뉴 리스트 중 최상단에 있는 첫 메뉴 페이지로 이동합니다.
	 *
	 * 최초작성일: 2017.11.09
	 * 최종수정일: 2017.11.09
	 * ---
	 * Date              Auth        Desc
	 */
	public function dashboard() {
	    $deviceType = parent::getCookie('DeviceType', false);
		$formKey = '';
		
	    // DeviceType 쿠키에 저장되어 있는 값에 따라 로그타입 설정
	    switch (strtolower($deviceType)) {
	        case DEVICE_MOBILE:
	            $logType = LOG_TYPE_MOBILE;
	            break;
	        case DEVICE_TABLET: 
	            $logType = LOG_TYPE_TABLET;
	            break;
	        default:
	            $logType = LOG_TYPE_PC;
	            break;
	    }
	    
	    // J.LAMP5_기타_API 참조
	    // 로그인한 사용자의 모바일/태블릿 메뉴 조회
	    $menu = parent::getMenu(true);
        if(empty($menu)){
            $result['returnCode'] = 550;
            $result['returnMsg'] = '没有使用权.';
            $this->jlamp_comm->jsonEncEnd($result);
        }
        if (!isset($menu[0]->Children)) {
            $result['returnCode'] = 550;
            $result['returnMsg'] = '没有使用权.';
            $this->jlamp_comm->jsonEncEnd($result);
        }
//	    // 최상단에 있는 메뉴의 정보를 설정
	    $this->getFirstMenu($menu[0]->Children[0]);
		
		// J.LAMP5_기타_API 참조
	    // 최상단에 있는 메뉴로 이동하기 전 로그 저장
	    $formKey = parent::setFormAccessLog('OPEN', $this->firstFormID, $this->firstFormName, $logType, $formKey);
		//print_r($this->firstMenuPath);
		//exit;
		// 최상단에 있는 메뉴로 이동 (formKey의 경우 필수로 넘겨줘야 함)
	    header('Location: '.$this->firstMenuPath.'?formKey='.$formKey);
	} // end of function dashboard

	/**
	 * 메소드명: getFirstMenu
	 * 작성자: 김목영
	 * 설 명: 메뉴리스트 중 제일 상단에 있는 페이지를 호출합니다.
	 *
	 * 최초작성일: 2017.11.09
	 * 최종수정일: 2017.11.09
	 * ---
	 * Date              Auth        Desc
	 */
	public function getFirstMenu($menu) {
	    if(!empty($menu->Children)) {
	        $this->getFirstMenu($menu->Children);
	    } else {
	        $this->firstMenuPath= '/'.$menu[0]->FormID.'/'.$menu[0]->FormID;
	        $this->firstFormID = $menu[0]->FormID;
	        $this->firstFormName= $menu[0]->MenuName;
	    }
	} // end of function getFirstMenu

	/**
	 * 메소드명: login
	 * 작성자: 김목영
	 * 설 명: 로그인 페이지
	 *
	 * 최초작성일: 2017.11.09
	 * 최종수정일: 2017.11.09
	 * ---
	 * Date              Auth        Desc
	 */
	public function login() {
		// CSS 파일 및 참조해야되는 CSS 파일 경로 추가
		$cssPart = array(
			'<link rel="stylesheet" href="/css/login.css?v=1001">',
            '<link href="/third_party/bootstrap-3.3.5/css/bootstrap.css" rel="stylesheet">',
	        '<link href="/third_party/bootstrap-3.3.5/css/bootstrap-theme.css" rel="stylesheet">'
		);

		// JS 파일 및 참조해야되는 JS 파일 경로 추가
		$jsPart = array(
            '<script src="/js/login.js?v=9010"></script>'
		);

		// CSS 설정 - (J.LAMP5_Common_API 문서 참조)
		$this->jlamp_comm->setCSS($cssPart);

		// JS 설정 - (J.LAMP5_Common_API 문서 참조)
		$this->jlamp_comm->setJS($jsPart);

		// J.LAMP5_TP 문서 참조
		// 컴파일 기본 경로로 설정        //配置当前文件默认路径
		$this->jlamp_tp->setCompileDir();
		// 템플릿 기본 경로로 설정        //设置为模板默认路径
        $this->jlamp_tp->setTemplateDir();

		// J.LAMP5_Session_API 참조
        // 아이디 저장 쿠키값이 설정되어 있는지 확인 및 체크여부 설정
	    $loginID = !empty($this->getCookie('SaveUserID')) ? $this->getCookie('SaveUserID') : '';
	    $isSaveID = !empty($loginID) ? 'checked' : '';

		// View에 바인딩할 데이터가 있는 경우 사용하며, Key-Value 형태로 입력한다.
		/*
			Ex) 
				1. PHP - View에 사원코드와 사원명을 바인딩 (사원코드 - 100000, 사원명 - 김아무개)
				$this->jlamp_tp->assign(array(
					'empCode' => parent::getSessionInfo('EmpCode'),
					'empName' => parent::getSeesionInfo('EmpName')
				));

				2. HTML - { Key } 로 설정하면 웹페이지 호출 시, 해당 부분에 PHP로 설정한 Value 값이 바인딩된다.
				<input type="text" id="emp_code" name="emp_code" value="{empCode}"> => <input type="text" id="emp_code" name="emp_code" value="100000">
				<input type="text" id="emp_name" name="emp_name" value="{empName}"> => <input type="text" id="emp_name" name="emp_name" value="김아무개">
		*/
		$this->jlamp_tp->assign(array(
            'loginID' => $loginID,
            'isSaveID' => $isSaveID
		));

		// Template 설정 - (J.LAMP5_TP_API 문서 참조)
		$this->jlamp_tp->define(array(
			'tpl' => 'LoginView/login.html'
		));
	} // end of function login

	/**
	 * 메소드명: login_prc
	 * 작성자: 김목영
	 * 설 명: 로그인 Process
	 *
	 * @return array $result 로그인 처리 결과
	 *
	 * 최초작성일: 2017.11.09
	 * 최종수정일: 2017.11.09
	 * ---
	 * Date         Auth        Desc
	 */
	public function login_prc() {
		// 표준이므로 아래와 같은 형태로 꼭 선언해주어야 한다. (return 되는 변수도 꼭 $result 변수여야 함)
		// returnCode - 프레임워크 E/I 코드
		// returnMsg - 프레임워크에서 발생한 에러 메시지 내용
		// data - return할 Data 배열, 데이터를 담아 return할 때에는 'data' KEY 밑에 배열로 담아야 함. 
		//            $result['data'][KEY] = Value; 형태로 담아야 함
		// valid - SP 에러코드, SP를 사용하는 경우에만 SP 실행 후 에러정보를 담는 KEY
		$result = array(
			'returnCode' => 0,
			'returnMsg' => '',
            'data' => ''
		);

		// J.LAMP5_Common_API 문서 참조
		// ajax로 전달받은 Input 데이터
		// 첫번째 인수는 ajax data에서 설정한 Key 값이며, 두번째 인수는 ajax type에서 설정한 (get/post) 값
		// ajax에서 get으로 전송하는데 post로 데이터를 받는 경우 값이 없으므로 데이터 전달되지 않는 경우가 있으니, 이를 주의하여 동일한 방식으로 설정해야 한다.
		$loginID = $this->jlamp_comm->xssInput('loginID', 'post'); // 로그인 ID 
		$loginPwd = $this->jlamp_comm->xssInput('loginPwd', 'post'); // 로그인 비밀번호
		$isSaveID = $this->jlamp_comm->xssInput('isSaveID', 'post'); // 아이디 저장 여부
		$isAutoLogin = $this->jlamp_comm->xssInput('autoLogin', 'post'); // 자동로그인 
		$deviceID = $this->jlamp_comm->xssInput('deviceID', 'post'); // 디바이스 ID
		$langID = $this->jlamp_comm->xssInput('langID', 'post'); // 언어 ID
        $dbID = $this->jlamp_comm->xssInput('dbID', 'post'); //数据库选择
        if(empty($dbID))
        {
            $result = array(
                'returnCode' => 'DB',
                'returnMsg' => 'DB INPUT ERROR',
                'data' => ''
            );
            $this->jlamp_comm->jsonEncEnd($result);
        }
        switch ($dbID){
            case 'normal':
                $dataBases = 'JLAMPBiz';
                parent::setBizDBAlias($dataBases);
                break;
            case 'test':
                $dataBases = 'JLAMPtestBiz';
                parent::setBizDBAlias($dataBases);
                break;
        }
		$deviceType = DEVICE_MOBILE; // 디바이스 타입
		$devicePlatform = DEVICE_PLATFORM_ANDROID; // 디바이스 플랫폼
		$cookieExpire = parent::getConfig('expire', 'cookie') ? parent::getConfig('expire', 'cookie') : 0; // COOKIE持续时间
		// workType, deviceType 설정
		switch (strtolower(parent::getCookie('DeviceType', false))) {
		    case DEVICE_MOBILE:
				$workType = DEVICE_MOBILE;
				$deviceType = DEVICE_MOBILE;
		        break;
		    case DEVICE_TABLET:
				$workType= DEVICE_TABLET;
				$deviceType = DEVICE_TABLET;
		        break;
		    default:
				$workType= DEVICE_PC;
				$deviceType = DEVICE_PC;
		        break;
		}

		// devicePlatform 설정
		switch (strtolower(parent::getCookie('DevicePlatform', false))) {
		    case DEVICE_PLATFORM_IOS:
				$devicePlatform = DEVICE_PLATFORM_IOS;
		        break;
		    case DEVICE_PLATFORM_ANDROID:
				$devicePlatform= DEVICE_PLATFORM_ANDROID;
		        break;
		    default:
				$devicePlatform= DEVICE_PLATFORM_WEB;
		        break;
		}

		// 유효성검사 (Client, Sever에서 필수로 체크해야 함)
		// 로그인 아이디
        if (empty($loginID)) {
			$result['returnCode'] = 'I001';
			$result['returnMsg'] = '请输入账号';

			// J.LAMP5_Common_API 문서 참조
			// SP를 실행했을 때 에러가 발생한 경우 해당 에러메시지의 정보를 받기 위해선 아래와 같이 입력
			// SP 에러코드를 리턴하지 않아도 되는 경우에는 $this->jlamp_comm->jsonEncEnd($result); 와 같이 2번째 인수 제외
			$this->jlamp_comm->jsonEncEnd($result);
		}

		// 비밀번호
        if (empty($loginPwd)) {
			$result['returnCode'] = 'I002';
			$result['returnMsg'] = '请输入密码';

			// J.LAMP5_Common_API 문서 참조
			// SP를 실행했을 때 에러가 발생한 경우 해당 에러메시지의 정보를 받기 위해선 아래와 같이 입력
			// SP 에러코드를 리턴하지 않아도 되는 경우에는 $this->jlamp_comm->jsonEncEnd($result); 와 같이 2번째 인수 제외
			$this->jlamp_comm->jsonEncEnd($result);
		}

		parent::setCookies($langID);

		// 아이디저장 bool 값 설정
		$isSaveID == "Y" ? $isSaveID = true : $isSaveID = false;

		// 자동로그인 bool 값 설정
		$isAutoLogin == 'Y' ? $isAutoLogin = true : $isAutoLogin = false;

		// J.LAMP5_기타_API 문서 참조
		// 로그인 메소드 호출
		$result = parent::doLogin($loginID, $loginPwd, $isSaveID, $cookieExpire, $workType, $deviceType, $devicePlatform, $deviceID, $isAutoLogin, $langID);
		parent::setCookie('DB',$dataBases,1118640000);
        
		// J.LAMP5_Common_API 문서 참조
		// SP를 실행했을 때 에러가 발생한 경우 해당 에러메시지의 정보를 받기 위해선 아래와 같이 입력
		// SP 에러코드를 리턴하지 않아도 되는 경우에는 $this->jlamp_comm->jsonEncEnd($result); 와 같이 2번째 인수 제외
		$this->jlamp_comm->jsonEncEnd($result, true);
	} // end of function login_prc
	
	/**
	 * 메소드명: logout_prc
	 * 작성자: 김목영
	 * 설 명: 로그아웃 Process
	 *
	 * @param bool $isMove 로그아웃 처리 후 json return하지 않고 로그인 화면으로 이동 여부
	 *   									 자동로그인이 설정되어 있는 사람이 접근 권한이 없으면 로그아웃 후 로그인 화면으로 이동할 때 사용
	 * @return array $result 로그아웃 처리 결과
	 *
	 * 최초작성일: 2017.11.09login_prc
	 * 최종수정일: 2017.11.09
	 * ---
	 * Date             Auth        Desc
	 */

	public function logout_prc($isMove=false) {
		// 표준이므로 아래와 같은 형태로 꼭 선언해주어야 한다. (return 되는 변수도 꼭 $result 변수여야 함)
		// returnCode - 프레임워크 E/I 코드
		// returnMsg - 프레임워크에서 발생한 에러 메시지 내용
		// data - return할 Data 배열, 데이터를 담아 return할 때에는 'data' KEY 밑에 배열로 담아야 함. 
		//            $result['data'][KEY] = Value; 형태로 담아야 함
		// valid - SP 에러코드, SP를 사용하는 경우에만 SP 실행 후 에러정보를 담는 KEY
		$result = array(
			'returnCode' => 0,
			'returnMsg' => '',
            'data' => ''
		);

		// workType 설정
		switch (strtolower(parent::getCookie('DeviceType', false))) {
		    case DEVICE_MOBILE:
		        $workType= DEVICE_MOBILE;
		        break;
		    case DEVICE_TABLET:
		        $workType= DEVICE_TABLET;
		        break;
		    default:
		        $workType= DEVICE_PC;
		        break;
		}

		// J.LAMP5_기타_API 문서 참조
		// 로그아웃 메소드 호출
	    $result = parent::doLogout($workType);

		// J.LAMP5_Common_API 문서 참조
		// SP를 실행했을 때 에러가 발생한 경우 해당 에러메시지의 정보를 받기 위해선 아래와 같이 입력
		// SP 에러코드를 리턴하지 않아도 되는 경우에는 $this->jlamp_comm->jsonEncEnd($result); 와 같이 2번째 인수 제외
		if (!$isMove)   $this->jlamp_comm->jsonEncEnd($result);
	} // end of function logout_prc

	/**
	 * 메소드명: autoLogin
	 * 작성자: 김목영
	 * 설 명: 자동로그인 Process
	 *
	 * 최초작성일: 2017.11.09
	 * 최종수정일: 2017.11.09
	 * ---
	 * Date              Auth        Desc
	 */
	private function autoLogin() {
		$cookieExpire = parent::getConfig('expire', 'cookie') ? parent::getConfig('expire', 'cookie') : 0; // 쿠키 유지시간
		$workType = ''; // SP 구분
		$deviceType = DEVICE_MOBILE; // 디바이스 타입
		$devicePlatform = DEVICE_PLATFORM_ANDROID; // 디바이스 플랫폼
		
		// workType, deviceType 설정
		switch (strtolower(parent::getCookie('DeviceType', false))) {
		    case DEVICE_MOBILE:
				$workType = 'mobileauto';
				$deviceType = DEVICE_MOBILE;
		        break;
		    case DEVICE_TABLET:
				$workType= 'tabletauto';
				$deviceType = DEVICE_TABLET;
		        break;
		    default:
		        break;
		}

		// devicePlatform 설정
		switch (strtolower(parent::getCookie('DevicePlatform', false))) {
		    case DEVICE_PLATFORM_IOS:
				$devicePlatform = DEVICE_PLATFORM_IOS;
		        break;
		    case DEVICE_PLATFORM_ANDROID:
				$devicePlatform= DEVICE_PLATFORM_ANDROID;
		        break;
		    default:
				$devicePlatform= DEVICE_PLATFORM_WEB;
		        break;
		}
	
		// J.LAMP5_기타_API 문서 참조
		// 로그인 메소드 호출
	    $result = parent::doLogin($this->getCookie('AutoUserID'), '', true, $cookieExpire, $workType, $deviceType, $devicePlatform, $deviceID, true);

		// 자동로그인 권한이 없거나, 사용자 정보가 틀린 경우 로그아웃
		if ($result['returnCode'] != 0 || empty(parent::getCookie('DB'))) {
			$this->logout_prc(true);
		}
		// 최상단 메뉴로 이동
		else {
			$this->dashboard();
		}
	} // end of function autoLogin

	/**
	 * 메소드명: deviceSave_prc
	 * 작성자: 김목영
	 * 설 명: 디바이스 저장 Process
	 * 
	 * @return array $result JSON 결과 값 
	 *
	 * 최초작성일: 2017.11.09
	 * 최종수정일: 2017.11.09
	 * ---
	 * Date              Auth        Desc
	 */
	public function deviceSave_prc() {
		// 표준이므로 아래와 같은 형태로 꼭 선언해주어야 한다. (return 되는 변수도 꼭 $result 변수여야 함)
		// returnCode - 프레임워크 E/I 코드
		// returnMsg - 프레임워크에서 발생한 에러 메시지 내용
		// data - return할 Data 배열, 데이터를 담아 return할 때에는 'data' KEY 밑에 배열로 담아야 함. 
		//            $result['data'][KEY] = Value; 형태로 담아야 함
		// valid - SP 에러코드, SP를 사용하는 경우에만 SP 실행 후 에러정보를 담는 KEY
	    $result = array(
            'returnCode' => 0,
			'returnMsg' => '',
			'data' => ''
	    );
	
	    // J.LAMP5_Common_API 문서 참조
		// ajax로 전달받은 Input 데이터
		// 첫번째 인수는 ajax data에서 설정한 Key 값이며, 두번째 인수는 ajax type에서 설정한 (get/post) 값
		// ajax에서 get으로 전송하는데 post로 데이터를 받는 경우 값이 없으므로 데이터 전달되지 않는 경우가 있으니, 이를 주의하여 동일한 방식으로 설정해야 한다.
	    $userID = $this->jlamp_comm->xssInput('userID', 'post'); // 아이디
	    $deviceID = $this->jlamp_comm->xssInput('deviceID', 'post'); // 디바이스 아이디
	    $deviceToken = $this->jlamp_comm->xssInput('deviceToken', 'post'); // 디바이스 토큰 (Push Message Service(FCM, APNS) 이용시 사용)
	    $deviceType = $this->jlamp_comm->xssInput('deviceType', 'post'); // 디바이스 타입
		
		// SP명 설정
		$spName = 'jlDeviceReg';
		
		// SP 프로시저 IN Parameter 설정
		// KEY - IN Parameter명, Value - IN Paremeter의 값
		// @, 또는 'v_' 를 제외한 IN Parameter명을 표기 (prefix는 설정한 DB 타입에 따라 프레임워크에서 제공)
		// MariaDB의 경우 IN Paramter 순서가 SP에 정의된 순서와 같아야 함. (IN Parameter 순서가 다른 경우 에러)
	    $params = array(
            'p_work_type' => 'N',
            'p_user_id' => $userID,
            'p_device_id' => $deviceID,
            'p_device_token' => $deviceToken,
            'p_device_type' => $deviceType,
            'p_use_yn' => 'N',
            'p_userid' => $userID,
            'p_pc' => $this->jlamp_comm->clientIP()
	    );
		 
		// J.LAMP5_Database_API 문서 참조
		// Config.json에 설정된 DataBase Alias 설정
	    $this->jlamp_common_mdl->DBConnect("JLAMPBiz");
	    
	    try {
			// J.LAMP5_Database_API 문서 참조
			// Query 실행
	        $res = $this->jlamp_common_mdl->spRows($spName, $params);
			
			// 데이터가 있는 경우
	        if (!empty($res)) {
	            $errorCode = $res[count($res)-1][0];
	            $eCode = substr($errorCode->p_error_code, 0, 1);
	           
	            // p_error_code 가 'M'(성공) 인 경우
	            if($eCode == 'M')
	               $result['data'] = $res;
			}
			
			// SP 에러코드 설정
	        $result['data']['valid'] = $res[count($res)-1][0];
	    } catch (Exception $e) {
	        $result['returnCode'] = 'E001';
	        $result['returnMsg'] = $e->getMessage();
	    }
		
		// J.LAMP5_Common_API 문서 참조
		// SP를 실행했을 때 에러가 발생한 경우 해당 에러메시지의 정보를 받기 위해선 아래와 같이 입력
		// SP 에러코드를 리턴하지 않아도 되는 경우에는 $this->jlamp_comm->jsonEncEnd($result); 와 같이 2번째 인수 제외
	    $this->jlamp_comm->jsonEncEnd($result, true);
	} // end of function deviceSave_prc

	/**
	 * 메소드명: checkMenuAuth_prc
	 * 작성자: 김목영
	 * 설 명: 메뉴 권한 체크 Process
	 * 
	 * @return array $result JSON 결과 값 
	 *
	 * 최초작성일: 2017.11.09
	 * 최종수정일: 2017.11.09
	 * ---
	 * Date              Auth        Desc
	 */
	public function checkMenuAuth_prc() {
		// 표준이므로 아래와 같은 형태로 꼭 선언해주어야 한다. (return 되는 변수도 꼭 $result 변수여야 함)
		// returnCode - 프레임워크 E/I 코드
		// returnMsg - 프레임워크에서 발생한 에러 메시지 내용
		// data - return할 Data 배열, 데이터를 담아 return할 때에는 'data' KEY 밑에 배열로 담아야 함. 
		//            $result['data'][KEY] = Value; 형태로 담아야 함
		// valid - SP 에러코드, SP를 사용하는 경우에만 SP 실행 후 에러정보를 담는 KEY
	    $result = array(
            'returnCode' => 0,
			'returnMsg'  => '',
			'data' => ''
	    );
        parent::setBizDBAlias(parent::getCookie('DB'));
		// J.LAMP5_기타_API 참조
	    // 로그인한 사용자의 모바일/태블릿 메뉴 조회
	    $menu = parent::getMenu(true);

		
		// 접근 가능한 메뉴가 존재하지 않는 경우 如果不存在可接近的菜单的话
        if(empty($menu)){
            $result['returnCode'] = 550;
            $result['returnMsg'] = '没有使用权.';
            $this->jlamp_comm->jsonEncEnd($result);
        }
        if (!isset($menu[0]->Children)) {
	        $result['returnCode'] = 550;
            $result['returnMsg'] = '没有使用权.';
            $this->jlamp_comm->jsonEncEnd($result);
	    }
		
		// J.LAMP5_Common_API 문서 참조
		// SP를 실행했을 때 에러가 발생한 경우 해당 에러메시지의 정보를 받기 위해선 아래와 같이 입력
		// SP 에러코드를 리턴하지 않아도 되는 경우에는 $this->jlamp_comm->jsonEncEnd($result); 와 같이 2번째 인수 제외
	    $this->jlamp_comm->jsonEncEnd($result);
	} // end of function checkMenuAuth_prc

	

	/**
	 * 메소드명: setLangID_prc
	 * 작성자: 김영탁
	 * 설 명: 언어 셋팅 Process
	 *
	 * @return array $result 로그인 처리 결과
	 *
	 * 최초작성일: 2017.11.09
	 * 최종수정일: 2017.11.09
	 * ---
	 * Date         Auth        Desc
	 */
	public function setLangID_prc() {
		// 표준이므로 아래와 같은 형태로 꼭 선언해주어야 한다. (return 되는 변수도 꼭 $result 변수여야 함)
		// returnCode - 프레임워크 E/I 코드
		// returnMsg - 프레임워크에서 발생한 에러 메시지 내용
		// data - return할 Data 배열, 데이터를 담아 return할 때에는 'data' KEY 밑에 배열로 담아야 함. 
		//            $result['data'][KEY] = Value; 형태로 담아야 함
		// valid - SP 에러코드, SP를 사용하는 경우에만 SP 실행 후 에러정보를 담는 KEY
		$result = array(
			'returnCode' => 0,
			'returnMsg' => '',
            'data' => ''
		);

		// J.LAMP5_Common_API 문서 참조
		// ajax로 전달받은 Input 데이터
		// 첫번째 인수는 ajax data에서 설정한 Key 값이며, 두번째 인수는 ajax type에서 설정한 (get/post) 값
		// ajax에서 get으로 전송하는데 post로 데이터를 받는 경우 값이 없으므로 데이터 전달되지 않는 경우가 있으니, 이를 주의하여 동일한 방식으로 설정해야 한다.

		$langID = $this->jlamp_comm->xssInput('langID', 'post'); // 언어 ID
		
		parent::setLangID($langID);
		// J.LAMP5_Common_API 문서 참조
		// SP를 실행했을 때 에러가 발생한 경우 해당 에러메시지의 정보를 받기 위해선 아래와 같이 입력
		// SP 에러코드를 리턴하지 않아도 되는 경우에는 $this->jlamp_comm->jsonEncEnd($result); 와 같이 2번째 인수 제외
		$this->jlamp_comm->jsonEncEnd($result, true);
	} // end of function setLangID_prc
	
}

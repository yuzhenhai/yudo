<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Push extends JLAMP_Controller {
    public function index() {}
    
    /**
     * 함수명: send_prc
     * 작성자: 김목영
     * 함수설명: Push 발송 Process
     *
     * @access  public
     * @param -
     * @return
     *
     * 최초작성일: 2017.03.15
     * 최종수정일: 2017.03.15
     * ---
     * Date              Auth        Desc
     */
    public function send_prc() {
        $result = array(
            'returnCode' => 0,
            'returnMsg' => '',
			'data' => ''
        );

        // Message 내용
        $msg = $this->jlamp_comm->xssInput('msg', 'post');

        // 권한 체크
        $auth = $_SERVER['HTTP_JMOBILE'];
        // 안드로이드 토큰 키 
        $androidToken = array();
        // IOS 토큰 키 
        $iosToken = array();
        
        if(strtolower($auth) == 'jmobile') {
            // Message 특수문자 처리
            $msg = preg_replace("/[^0-9a-zA-Zㄱ-ㅎ가-힣\{\}\[\]\/?.,;:|\)*~`!^\-_<>@\#$&\\\=\(\'\"\s]/", "", $msg);

            $this->jlamp_common_mdl->DBConnect("JLAMPBiz");

			// 안드로이드 발송 (FCM)
			/*
            $sql = "SELECT device_token FROM sysUserMobileDevice WHERE device_type = 'A' AND use_yn = 'Y';";
            
            $androidResult = $this->jlamp_common_mdl->sqlRows($sql); 
            // print_r($androidResult); exit;

            if($androidResult) {
                if(!empty($androidResult[0])) {
                    foreach($androidResult[0] as $key => $val) 
                            array_push($androidToken, $val->device_token);
                        
                    $this->androidSend($androidToken, $msg);
                }
            }
			*/
			
            // 아이폰 발송 (FCM)
            /*
            $sql = "SELECT device_token FROM sysUserMobileDevice WHERE device_type = 'I' AND use_yn = 'Y';";
            $iosResult = $this->jlamp_common_mdl->sqlRows($sql); 
        
            if($iosResult) {
                if(!empty($iosResult[0])) {
                    foreach($iosResult[0] as $key => $val) 
                            array_push($iosToken, $val->device_token);
                        
                    $this->iosFCMSend($iosToken, $msg);
                }
            }
            */
			
			// 아이폰 발송 (APNS)
			// $sql = "SELECT device_token FROM sysUserMobileDevice WHERE device_type = 'I' AND use_yn = 'Y';";

			$sql = "SELECT device_token FROM sysUserMobileDevice WHERE device_type = 'I' AND device_id = '3858BBAD-7123-4345-8D1B-48A46E';";
            $iosResult = $this->jlamp_common_mdl->sqlRows($sql); 

            if($iosResult) {
                if(!empty($iosResult[0])) {
                    foreach($iosResult[0] as $key => $val)
                        $this->iosSend($val->device_token, $msg);                
                }
            }
            
        } else {
            $result['returnCode'] = 'I001';
            $result['returnMsg'] = '권한정보가 일치하지 않습니다.';
        }
        
        $this->jlamp_comm->jsonEncEnd($result); 
    } // end of function send_prc
    
    /**
     * 함수명: androidSend
     * 작성자: 김목영
     * 함수설명: 안드로이드 Push 발송 (FCM)
     *
     * @access private
     * @param array $token 디바이스 토큰
     * @param string $msg 메시지 내용 
     * @return null
     *
     * 최초작성일: 2017.03.15
     * 최종수정일: 2017.03.15
     * ---
     * Date              Auth        Desc
     */
    private function androidSend($token, $msg) {
        // FCM URL
        $url = 'https://fcm.googleapis.com/fcm/send';
        // API Key
        $serverApiKey = 'AAAABFqMckQ:APA91bELh0ijJ8_jLCxjezFA87iPioG5GpbrTXxn_iHYxbT9-dKUpSP62UOEUsjvQrhHnYXyRwsGdmx6hy09vVKtbg1Dqj4NyUZdf4hHlAq2MtaGYuH7_G1qeJxEFAsr-dg7aby3fUmN';
        
        if(is_array($token) && count($token)) {
            $fields = array(
                'registration_ids' => $token,
                'notification' => array(
                    'sound' => 'default',
                    'body' => $msg,
                    'vibrate' => 1
                ),
				'data' => array(
					'message' => $msg,
					'badge' => 1
				)
            );
            
            $headers = array (
                'Authorization: key='.$serverApiKey,
                'Content-Type: application/json'
            );
            
            // Open Connection
            $ch = curl_init();
            
            // Set the URL, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_URL, $url); // 데이타를 보낼 URL 설정
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1)'); // Agent 설정
            curl_setopt($ch, CURLOPT_POST,1); // POST 여부
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields)); // 보낼 데이타를 설정 형식은 GET 방식으로 설정
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // REQUEST 에 대한 결과값을 받을건지 체크 #Resource ID 형태로 넘어옴 :: 내장 함수 curl_errno 로 체크
            curl_setopt($ch, CURLOPT_TIMEOUT, 20); // REQUEST 에 대한 결과값을 받는 시간 설정
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 이 값이 true면 인증서가 인식하지 못할경우가 있다
            
            
            // Execute post
            $result = curl_exec($ch);
            curl_close($ch);
        }
    } // end of function androidSend
    
    /**
     * 함수명: iosSend
     * 작성자: 김목영
     * 함수설명: 아이폰 Push 발송 (APNS)
     *
     * @access private
     * @param array $token 디바이스 토큰
     * @param string $msg 메시지 내용
     * @return null
     *
     * 최초작성일: 2017.03.15
     * 최종수정일: 2017.03.15
     * ---
     * Date              Auth        Desc
     */
    private function iosSend($token, $msg) {
        $apnsHost = 'gateway.push.apple.com';
        // $apnsHost = 'gateway.sandbox.push.apple.com';
        $apnsPort = 2195;
        $apnsCert = $_SERVER['DOCUMENT_ROOT'].'/../apns.pem';
        
        $body = array(
            'aps' => array(
                'alert' => $msg,
                'badge' => 0,
                'sound' => 'default'
                // 'vibrate' => 1
            )
        );
		
		echo $apnsCert.PHP_EOL;
		echo $token.PHP_EOL;
		echo $msg.PHP_EOL;
        $payload = json_encode($body);
        
        if(!empty($token)) {
            $ctx = stream_context_create();
            stream_context_set_option($ctx, 'ssl', 'local_cert', $apnsCert);
            $fp = stream_socket_client('ssl://'.$apnsHost.':'.$apnsPort, $error, $errorString, 120, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
            stream_set_blocking ($fp, 0);
            if($fp) {
				echo "  a  ";
				$apnsMessage = chr(0).chr(0).chr(32).pack('H*', str_replace(' ', '', $token)).chr(0).chr(strlen($payload)).$payload;
				$result = fwrite($fp, $apnsMessage);
				// $apnsMessage = chr(0) . pack('n', 32) . pack('H*', $token) . pack('n', strlen($payload)) . $payload;
				// $result = fwrite($fp, $apnsMessage, strlen($apnsMessage));
				echo $result;
            }
			
			usleep(100000);

			$apple_error_response = fread($fp, 6);
			
			if ($apple_error_response) {
				// unpack the error response (first byte 'command" should always be 8)
				$error_response = unpack('Ccommand/Cstatus_code/Nidentifier', $apple_error_response); 
		
				if ($error_response['status_code'] == '0') {
					$error_response['status_code'] = '0-No errors encountered';
				} else if ($error_response['status_code'] == '1') {
					$error_response['status_code'] = '1-Processing error';
				} else if ($error_response['status_code'] == '2') {
					$error_response['status_code'] = '2-Missing device token';
				} else if ($error_response['status_code'] == '3') {
					$error_response['status_code'] = '3-Missing topic';
				} else if ($error_response['status_code'] == '4') {
					$error_response['status_code'] = '4-Missing payload';
				} else if ($error_response['status_code'] == '5') {
					$error_response['status_code'] = '5-Invalid token size';
				} else if ($error_response['status_code'] == '6') {
					$error_response['status_code'] = '6-Invalid topic size';
				} else if ($error_response['status_code'] == '7') {
					$error_response['status_code'] = '7-Invalid payload size';
				} else if ($error_response['status_code'] == '8') {
					$error_response['status_code'] = '8-Invalid token';
				} else if ($error_response['status_code'] == '255') {
					$error_response['status_code'] = '255-None (unknown)';
				} else {
					$error_response['status_code'] = $error_response['status_code'].'-Not listed';
				}
		
				echo '<br><b>+ + + + + + ERROR</b> Response Command:<b>' . $error_response['command'] . '</b>&nbsp;&nbsp;&nbsp;Identifier:<b>' . $error_response['identifier'] . '</b>&nbsp;&nbsp;&nbsp;Status:<b>' . $error_response['status_code'] . '</b><br>';
		
				echo 'Identifier is the rowID (index) in the database that caused the problem, and Apple will disconnect you from server. To continue sending Push Notifications, just start at the next rowID after this Identifier.<br>';
		
				return true;
			}

            fclose($fp);
        }        
    } // end of function iosSend

    /**
     * 함수명: iosFCMSend
     * 작성자: 김목영
     * 함수설명: 아이폰 Push 발송 (FCM)
     *
     * @param array $token 디바이스 토큰
     * @param string $msg 메시지 내용 
     * @return null
     *
     * 최초작성일: 2017.07.12
     * 최종수정일: 2017.07.12
     * ---
     * Date              Auth        Desc
     */
    private function iosFCMSend($token, $msg) {
        // FCM URL
        $url = 'https://fcm.googleapis.com/fcm/send';
        // API Key
        $serverApiKey = 'AAAAPg9ym4U:APA91bHUhXBHYT60QNe6CY74h7HHgVsrkom6R8XTbfEAm2guEyOYMVLZ5aAHPUBC-8OJW4nq5ATbu4JmahjYAdnHLX6jj5x3wYZDz1BwBlFoAfLaesoCsFw4TuPsCT35lbp_hUIF7-3o';
        
        if(is_array($token) && count($token)) {
            $fields = array(
                'registration_ids' => $token,
                'notification' => array(
                    'sound' => 'default',
                    'body' => $msg,
                    'vibrate' => 1
                ),
				'data' => array(
					'message' => $msg,
					'badge' => 1
				)
            );
            
            $headers = array (
                'Authorization: key='.$serverApiKey,
                'Content-Type: application/json'
            );
            
            // Open Connection
            $ch = curl_init();
            
            // Set the URL, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_URL, $url); // 데이타를 보낼 URL 설정
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1)'); // Agent 설정
            curl_setopt($ch, CURLOPT_POST,1); // POST 여부
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields)); // 보낼 데이타를 설정 형식은 GET 방식으로 설정
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // REQUEST 에 대한 결과값을 받을건지 체크 #Resource ID 형태로 넘어옴 :: 내장 함수 curl_errno 로 체크
            curl_setopt($ch, CURLOPT_TIMEOUT, 20); // REQUEST 에 대한 결과값을 받는 시간 설정
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 이 값이 true면 인증서가 인식하지 못할경우가 있다
            
            
            // Execute post
            $result = curl_exec($ch);
            curl_close($ch);
        }
    } // end of function iosFCMSend
}
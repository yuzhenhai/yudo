<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 클래스명: Lib_comm
 * 작성자: 김목영
 * 클래스설명: 
 *
 * 최초작성일: 2017.06.14
 * 최종수정일: 2017.06.14
 * ---
 * Date             Auth        Desc
 */
class Lib_comm
{
	function __construct() {
	}

	/**
	 * 메소드명: getMenuName
	 * 작성자: 김목영
	 * 설 명: 화면명을 가져옵니다.
	 *
	 * 최초작성일: 2017.11.10
	 * 최종수정일: 2017.11.10
	 * ---
	 * Date     Auth        Desc
	 */
	public function getMenuName() {
	    $CI = & get_instance();
		$subTitle = '';
		
	    // 메뉴정보
		$menu = $CI->JLAMP_Controller->getMenu(false);

	    foreach ($menu[0] as $key => $val) {
	        if (strtolower($CI->uri->rsegments[1]) == strtolower($val->FormID)) {
	            $subTitle = $val->MenuName;
	            break;
	        }
	    }

	    return $subTitle;
	} // end of function getMenuName
}


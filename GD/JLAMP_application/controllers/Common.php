<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * 클래스명: Common
 * 작성자: 김목영
 * 클래스설명:
 *
 * 최초작성일: 2017.11.07
 * 최종수정일: 2017.11.07
 * ---
 * Date         Auth        Desc
 */
class Common extends JLAMP_Controller {
	function __construct() {
		parent::__construct();
	}

	/**
     * 메소드명: menu_prc
     * 작성자: 김목영
     * 설 명: 메뉴 HTML을 가공하여 반환한다.
	 * 
	 * @return array $result JSON 결과 값
     *
     * 최초작성일: 2017.11.09
     * 최종수정일: 2017.11.09
     * ---
     * Date     Auth        Desc
     */
	public function menu_prc() {
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

		try {
			$menu = parent::getMenu(true);

			if (count($menu)) {
				$menuHTML = $this->doMenuBuild($menu[0]->Children);
				
				$menuHTML = '<a href="/">
                                            <header class="menu-header">
                                                <span class="menu-header-title">'.$GLOBALS['JLAMPConfig']->site->title.'</span>
                                            </header>
                                       </a>'.$menuHTML;

				$result['data'] = $menuHTML;
			}
		} catch (\Exception $e) {
			$result['returnCode'] = 'E001';
			$result['returnMsg'] = $e->getMessage();
		}

		$this->jlamp_comm->jsonEncEnd($result);
	} // end of function menu_prc

	/**
     * 메소드명: doMenuBuild
     * 작성자: 김목영
     * 설 명: 하위 메뉴 HTML을 가공하여 반환한다.
	 * 
	 * @param array $menu Menu 정보
	 * @param int $depth 메뉴 Depth
	 * @return string $menuHTML 하위 메뉴 HTML 문자열
     *
     * 최초작성일: 2017.11.09
     * 최종수정일: 2017.11.09
     * ---
     * Date     Auth        Desc
     */
	private function doMenuBuild($menu, $depth=1) {
		$menuHTML = '';
		
		for($i = 0; $i < count($menu); $i++) {
			if ($depth == 1) {
				$menuHTML .= '<section class="menu-section">'.PHP_EOL;
			} else if ($depth == 2) {
				if ($menu[$i]->Category == 'FORM') {
				    $menuHTML .= '      <li onclick="getFormInfo(\'/'.$menu[$i]->FormID.'/'.$menu[$i]->FormID.'\', \''.$menu[$i]->FormID.'\', \''.$menu[$i]->MenuName.'\')"><a href="javascript:void(0)">'.$menu[$i]->MenuName.'</a>'.PHP_EOL;
				} else {
					$menuHTML .= '      <li><a href="javascript:void(0)">'.$menu[$i]->MenuName.'</a>'.PHP_EOL;
				}
			} else {
			    if ($menu[$i]->Category == 'FORM') {
			        $menuHTML .= '      <div onclick="getFormInfo(\'/'.$menu[$i]->FormID.'/'.$menu[$i]->FormID.'\', \''.$menu[$i]->FormID.'\', \''.$menu[$i]->MenuName.'\')"><a href="javascript:void(0)">'.$menu[$i]->MenuName.'</a>'.PHP_EOL;
			    } else {
			        $menuHTML .= '      <div><a href="javascript:void(0)">'.$menu[$i]->MenuName.'</a>'.PHP_EOL;
			    }
			}

			if (isset($menu[$i]->Children)) {
				$depth++;
				if ($depth == 2) {
					$menuHTML .= '		<ul class="menu-section-list">'.PHP_EOL;
				}

				$menuHTML .= $this->doMenuBuild($menu[$i]->Children, $depth);

				if ($depth == 2) {
					$menuHTML .= '		</ul>'.PHP_EOL;
				} else if ($depth == 3 || $depth == 4) {
				    $menuHTML .= '		</div>'.PHP_EOL;
				}
				$depth--;
			}

			if ($depth == 1) {
				$menuHTML .= '	</ul>'.PHP_EOL;
				$menuHTML .= '</section>'.PHP_EOL;
			} else if ($depth > 1)
				$menuHTML .= "</li>".PHP_EOL;
		}

		return $menuHTML;
	} // end of function doMenuBuild


}

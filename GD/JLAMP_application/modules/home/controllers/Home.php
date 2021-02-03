<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 클래스명: Home
 * 작성자: 
 * 클래스설명: Home 화면
 *
 * 최초작성일: 
 * 최종수정일:
 * ---
 * Date         	Auth        Desc
 */
class Home extends JLAMP_Controller {

    /**
	 * 메소드명: index
	 * 작성자: 
	 * 설 명: 
	 *
	 * 최초작성일: 
	 * 최종수정일: 
	 * ---
	 * Date     Auth        Desc
	 */
	public function index() {
		$this->lists();
	}

	/**
	 * 메소드명: lists
	 * 작성자: 
	 * 설 명: Home 페이지
	 *
	 * 최초작성일: 
	 * 최종수정일: 
	 * ---
	 * Date     Auth        Desc
	 */
	public function lists() {
		$cssPart = array(
			'<link rel="stylesheet" href="/css/home/home.css">'
		);
		$jsPart = array(
			'<script src="/js/home/home.js"></script>'
		);
		$this->jlamp_comm->isHtmlDisplay(true);
		$this->jlamp_comm->setCSS($cssPart);
		$this->jlamp_comm->setJS($jsPart);

    	$this->jlamp_tp->assign(array(
		));

    	$this->jlamp_tp->setTabType(array(
    		'tpl' => 'home.html'
        ));
	} // end of function lists
}

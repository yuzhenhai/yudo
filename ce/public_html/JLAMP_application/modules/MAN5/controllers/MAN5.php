<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

class MAN5 extends Base {
    function __construct() {
		parent::__construct();
	}
	  public function index() {
		$formKey = $this->jlamp_comm->xssInput('formKey', 'get');

		$cssPart = array(
				'<link rel="stylesheet" href="/css/MAN5/MAN5.css">'
    );
    $jsPart = array(
				'<script src="/js/MAN5/MAN5.js"></script>'
    );

    $this->jlamp_comm->setCSS($cssPart);
		$this->jlamp_comm->setJS($jsPart);
		
		$this->jlamp_comm->isHtmlDisplay(true);

    $this->load->library('lib_comm');
		$subTitle = $this->lib_comm->getMenuName();

		$this->jlamp_tp->setURLType(array(
			'tpl' => 'MAN5.html'
		));
    }
    }
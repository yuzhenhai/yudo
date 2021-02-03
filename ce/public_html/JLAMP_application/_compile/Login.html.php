<?php /* Template_ 2.2.6 2019/03/22 11:03:38 /home/merp.yudo.com.cn/public_html/JLAMP_application/views/login.html 000006929 */ ?>
<!DOCTYPE HTML>
<html>
<head>
	<title>
		yudo erp
	</title>
	<meta name="renderer" content="webkit">
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<!--css-->
	<link rel="stylesheet" href="/css/yudo-ui.css?v=1051">
	<link rel="stylesheet" href="/css/login.css?v=1055">
	<link rel="stylesheet" href="/css/mui.min.css?v=1008">
	<!-- bootstrap 3.3.5-->
	<link href="/third_party/bootstrap-3.3.5/css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" href="/css/common.css?v=5007">

	<!--js-->
	<script type="text/javascript" src="/third_party/jquery-2.1.4/jquery.js"></script>
	<script>var jq = $.noConflict();</script>
	<!--mui echarts multi fastclick-->
	<script src="/js/mui.min.js?v=1001"></script>
	<script src="/js/login.js?v=10032"></script>
	<script src="/js/multiHttp.js?v=1001"></script>
	<script src="/js/lang.min.js?v=1001"></script>
	<script type="text/javascript" src="/js/fastclick.js"></script>
	<script type="text/javascript" src="/third_party/bootstrap-3.3.5/js/bootstrap.min.js"></script>
	<!--jlamp-->
	<script type="text/javascript" src="/js/JLAMP.polyfill.min.js"></script>
	<script type="text/javascript" src="/js/JLAMP.min.js"></script>
	<script type="text/javascript" src="/js/JLAMP.common.min.js"></script>
	<script type="text/javascript" src="/js/JLAMP.menu.min.js"></script>
	<script type="text/javascript" src="/js/JLAMP.autobinding.min.js"></script>
	<script type="text/javascript" src="/js/JLAMP.modal.min.js"></script>
	<script type="text/javascript" src="/js/JLAMP.lang.min.js"></script>
	<script type="text/javascript" src="/js/session.js"></script>
	<script type="text/javascript" src="/js/version.js?v=20180920001"></script>
	<script type="text/javascript" src="/js/common.js"></script>
	<script type="text/javascript" src="/js/GNB.js"></script>
</head>
<body>
<div class="body_back">
	<div class="download-script" id="downLoadScript"></div>
	<!-- 버전 -->
	<div id="version" class=version></div>
	<div class="language-switch">
		<select id="login_lang_id" name="login_lang_id" style="width: auto;padding: 0;font-size: 14px;color: #777777;right: 5px" class="">
			<option value="CHN">CHN</option>
			<option value="KOR">KOR</option>
			<option value="ENG">ENG</option>
		</select>
		<div class="icon-xiala" style="margin-bottom: 2px;width: 10px;height: 10px"></div>
	</div>

	<!-- logo -->
	<div class="login_logo">
		<div class=" icon-logo"></div>
	</div>
	<div class="login_header">
		Mobile ERP
	</div>
    <!-- login_input -->
	<div style="height: 100%;padding-top: 150px">
		<form id="frmLogin" method="post" action="/" onsubmit="return doLogin()">
			<div class="login_input_area">
				<ul class="login-ul">
					<li>
						<div class="login-icon icon-login-area" style="width: 25px;height: 25px"></div>
						<div class="input-icon-bg"></div>
						<select onchange="serverOnchange()" id="login_service_id" name="login_lang_id" style="padding-left: 50px" class="yudo-select noborder">
							<option onclick="setServiceMsg('YUDO_SZ')" value="SZ">YUDO SZ</option>
							<option onclick="setServiceMsg('YUDO_GD')" value="GD">YUDO GD</option>
							<option onclick="setServiceMsg('YUDO_DEV')" value="DEV">YUDO DEV</option>
						</select>
					</li>
					<li>
						<div class="login-icon icon-login-username" style="width: 25px;height: 25px"></div>
						<div class="input-icon-bg"></div>
						<input id="login_id" type="text" class="yudo-input noborder" style="padding-left:50px"  value="<?php echo $TPL_VAR["loginID"]?>" placeholder="ID" required autocomplete="off"/>

					</li>
					<li>
						<div class="login-icon icon-login-password" style="width: 25px;height: 25px"></div>
						<div class="input-icon-bg"></div>
						<input id="login_pwd" type="password" class="yudo-input noborder" style="padding-left: 50px"  placeholder="PASSWORD" required autocomplete="off"/>
					</li>
					<li>
						<div class="login-icon icon-login-sql" style="width: 25px;height: 25px"></div>
						<div class="input-icon-bg"></div>
						<select id="login_db_id" name="login_lang_id" style="padding-left: 50px"  class="yudo-select noborder" >
							<option value="normal">Normal DB</option>
							<option value="test">Test DB</option>
						</select>
					</li>
				</ul>
			</div>


			<!-- 로그인 버튼 -->
			<div class="login_bn_area" style="padding: 10px 10% 7px 10%;">
				<input type="submit" id="btn_login"  class="yudo-login-btn"  value="LOGIN">
			</div>
			<!--<div class="login_bn_area"><input type="button" class="yudo-login-btn" id="btn_device_id" style="background: #3e3e3e !important;" value="Device Registration Request" /></div>-->
		</form>

		<!-- 아이디 저장 / 자동 로그인 -->
		<div class="login_rbn_area">
			<ul>
				<li class="flex">
					<div class="mui-input-row mui-checkbox mui-left" style="height: 30px;line-height: 30px;width: 40%">
						<label style="padding: 0 0 0 40px">Save ID</label>
						<input style="top: -4px;left: 8px" id="save_id" name="save_id" value="Item 1" type="checkbox">
					</div>
					<!--<label class="checkbox-inline" style="height: 20px;line-height: 25px">-->
						<!--<input type="checkbox" id="save_id" name="save_id" <?php echo $TPL_VAR["isSaveID"]?>> Save ID-->
					<!--</label>-->
					<div id="btn_device_id" style="line-height: 30px;float: right;margin-right: 10px;font-weight: 700">Device Registration</div>
				</li>
			</ul>
		</div>
	</div>
</div>

<!-- 기기번호 등록요청 모달 -->
<div class="modal" id="mdl_device_info" tabindex="-1" role="dialog" aria-labelledby="device_model" aria-hidden="true">
	<div class="modal_area">
			<!-- 모달 컨텐츠 -->
			<div class="modal_contents">
				<!-- 제품 영역 -->
				<div class="modal_area">
					<!-- 설명 영역 -->
					<div class="modal_txt_area">
						<div class="modal_title" id="device_reg_req">Device Registration Request</div>
						<input id="mdl_device_token" type="hidden">
						<input id="mdl_device_type" type="hidden">
						<div class="modal_sub_title"><input type="text" id="mdl_user_id" class="no_input" placeholder="LOGIN ID"></div>
						<div class="modal_sub_title"><input type="text" id="mdl_device_id" class="no_input_disable" placeholder="DEVICE ID" readonly></div>
						<div class="no_bn_area"><input class="no_bn" id="btn_device_save" type="button" value="Request"></div>
						<div class="no_bn_area">
							<input class="no_bn" type="button" style="background-color: #727171;" data-dismiss="modal" value="Close">
						</div>
					</div>
				</div>
			</div>
	</div> <!-- 모달 전체 윈도우 -->
</div>
<!-- 기기번호 등록요청 모달 //-->
<?php $this->print_("footer",$TPL_SCP,1);?>
<?php /* Template_ 2.2.6 2019/02/25 10:15:02 /home/merp.yudo.com.cn/public_html/JLAMP_application/views/layout.html 000004734 */ ?>
<!DOCTYPE html>
<html lang="ko-kr">
<head>
	<meta name="renderer" content="webkit">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="user-scalable=no">
	<meta name="viewport" content="initial-scale=1,maximum-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<title><?php echo $TPL_VAR["TITLE"]?></title>
	<!-- Favicon -->
	<link rel="shortcut icon" href="/image/favicon.ico">

	<!-- bootstrap 3.3.5 //-->
	<link href="/third_party/bootstrap-3.3.5/css/bootstrap.css" rel="stylesheet">
	<link href="/third_party/bootstrap-3.3.5/css/bootstrap-theme.css" rel="stylesheet">
	
	<!-- loading overlay //-->
	<link rel="stylesheet" href="/third_party/loading-overlay/waitMe.css">

	<!-- bootstrap datepicker //-->
	<link href="/third_party/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css" rel="stylesheet">
	<link href="/css/bootstrap_modify.css" rel="stylesheet">
	<!--'<link href="/third_party/KendoUI/styles/kendo.common.min.css" rel="stylesheet">',-->
	<!--'<link href="/third_party/KendoUI/styles/kendo.bootstrap.min.css" rel="stylesheet">',-->
	<!--'<link href="/third_party/KendoUI/styles/kendo.bootstrap.mobile.min.css" rel="stylesheet">',-->

	<!-- slideout  -->
	<link rel="stylesheet" href="/third_party/slideout-1.0.1/index.css">
	<link rel="stylesheet" href="/css/slide_menu.css">

	<link rel="stylesheet" href="/css/JLAMP.common.min.css">
	<link rel="stylesheet" href="/css/JLAMP.modal.min.css" />
	<link rel="stylesheet" href="/css/JLAMP.autobinding.min.css" />


	<!-- php에서 설정한 CSS의 경로 추가 -->
	<?php echo $TPL_VAR["cssPart"]?>

	<link rel="stylesheet" href="/css/common.css?v=5007">
	<!-- jquery 2.1.4 //-->
	<script type="text/javascript" src="/third_party/jquery-2.1.4/jquery.js"></script>
	<!-- jquery-ui 1.11.4 //-->
	<!--<script type="text/javascript" src="/third_party/jquery-ui-1.11.4/jquery-ui.js"></script>-->
	<!-- bootstrap 3.3.5 //-->
	<script type="text/javascript" src="/third_party/bootstrap-3.3.5/js/bootstrap.min.js"></script>
	<!-- bootstrap datepicker //-->
	<script src="/third_party/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<?php if($TPL_VAR["LANG_ID"]==='KOR'){?>
	<!--<script src="/third_party/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.ko.js" charset="UTF-8"></script>-->
<?php }elseif($TPL_VAR["LANG_ID"]==='CHN'){?>
	<!--<script src="/third_party/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>-->
<?php }?>

	
	<!-- Kendo UI //-->
	<!--<script type="text/javascript" src="/third_party/KendoUI/js/kendo.all.min.js"></script>-->
	
	<!-- loading overlay //-->
	<script type="text/javascript" src="/third_party/loading-overlay/waitMe.js"></script>
	<!--  slideout -->
	<script type="text/javascript" src="/third_party/slideout-1.0.1/slideout.js"></script>

	<script>
		var jq = $.noConflict();
	</script>
	<script type="text/javascript" src="/js/fastclick.js"></script>
	<script type="text/javascript" src="/js/JLAMP.polyfill.min.js"></script>
	<script type="text/javascript" src="/js/JLAMP.min.js"></script>
	<script type="text/javascript" src="/js/JLAMP.common.min.js"></script>
	<script type="text/javascript" src="/js/JLAMP.menu.min.js"></script>
	<script type="text/javascript" src="/js/JLAMP.autobinding.min.js"></script>
	<script type="text/javascript" src="/js/JLAMP.modal.min.js"></script>
	<script type="text/javascript" src="/js/JLAMP.lang.min.js"></script>
	<script type="text/javascript" src="/js/session.js"></script>
	<script type="text/javascript" src="/js/version.js?v=20190225001"></script>
	<script type="text/javascript" src="/js/common.js?v=1001"></script>
	<script type="text/javascript" src="/js/GNB.js"></script>

	<?php echo $TPL_VAR["jsPart"]?>

<?php $this->print_("js",$TPL_SCP,1);?>

</head>
<body>
<?php $this->print_("gnb",$TPL_SCP,1);?>

<input type="hidden" j-layout-langid value="<?php echo $TPL_VAR["LANG_ID"]?>">
<input type="hidden" id="form_key" value="<?php echo $TPL_VAR["formKey"]?>">
<input type="hidden" id="menu_selection" value="<?php echo $TPL_VAR["menuSelection"]?>">

<nav id="jlampHeader" class="navbar navbar-fixed-top top_header" style="position: absolute !important;display:none;">

	<!-- 메뉴 아이콘 -->
	<div>
		<img id="imgTopLogo" src="/image/login_logo.png" border="0" alt="top logo" style="width: 120px;margin-top: 8px" class="topLogo">
	</div>
	<div class="top_logout"><img src="/image/icon_logout.png" style="width:24px;" alt="로그아웃"></div>
</nav>
<?php
$version = "2017.3.001";
$configPath = mb_substr($_SERVER["DOCUMENT_ROOT"], 0, -11);
$JLAMPConfig = file_get_contents($configPath . "config.json");
if( $JLAMPConfig ) 
{
	$GLOBALS["JLAMPConfig"] = json_decode($JLAMPConfig);
	if( json_last_error() ) 
	{
		print_r("<div>설정파일(config.json)의 형식에 문제가 있습니다.</div>");
		print_r("<div>JSON 형식이 맞는지 확인해 주십시오.</div>");
		print_r("<div>(" . json_last_error_msg() . ")</div>");
		exit();
	}
	$_SERVER["CI_ENV"] = $GLOBALS["JLAMPConfig"]->site->env;
	define("ENVIRONMENT", (isset($_SERVER["CI_ENV"]) ? $_SERVER["CI_ENV"] : "development"));
	switch( ENVIRONMENT ) 
	{
		case "development": error_reporting(-1);
		ini_set("display_errors", 1);
		break;
		case "testing": case "production": ini_set("display_errors", 0);
		if( version_compare(PHP_VERSION, "5.3", ">=") ) 
		{
			error_reporting(32767 & ~8 & ~8192 & ~2048 & ~1024 & ~16384);
		}
		else 
		{
			error_reporting(32767 & ~8 & ~2048 & ~1024);
		}
		break;
		default: header("HTTP/1.1 503 Service Unavailable.", true, 503);
		echo "The application environment is not set correctly.";
		exit( 1 );
	}
	$system_path = "JLAMP_system";
	$application_folder = "JLAMP_application";
	$view_folder = "";
	if( defined("STDIN") ) 
	{
		chdir(dirname(__FILE__));
	}
	if( ($_temp = realpath($system_path)) !== false ) 
	{
		$system_path = $_temp . "/";
	}
	else 
	{
		$system_path = rtrim($system_path, "/") . "/";
	}
	if( !is_dir($system_path) ) 
	{
		header("HTTP/1.1 503 Service Unavailable.", true, 503);
		echo "Your system folder path does not appear to be set correctly. Please open the following file and correct this: " . pathinfo(__FILE__, PATHINFO_BASENAME);
		exit( 3 );
	}
	define("SELF", pathinfo(__FILE__, PATHINFO_BASENAME));
	define("BASEPATH", str_replace("\\", "/", $system_path));
	define("FCPATH", dirname(__FILE__) . "/");
	define("SYSDIR", trim(strrchr(trim(BASEPATH, "/"), "/"), "/"));
	if( is_dir($application_folder) ) 
	{
		if( ($_temp = realpath($application_folder)) !== false ) 
		{
			$application_folder = $_temp;
		}
		define("APPPATH", $application_folder . DIRECTORY_SEPARATOR);
	}
	else 
	{
		if( !is_dir(BASEPATH . $application_folder . DIRECTORY_SEPARATOR) ) 
		{
			header("HTTP/1.1 503 Service Unavailable.", true, 503);
			echo "Your application folder path does not appear to be set correctly. Please open the following file and correct this: " . SELF;
			exit( 3 );
		}
		define("APPPATH", BASEPATH . $application_folder . DIRECTORY_SEPARATOR);
	}
	if( !is_dir($view_folder) ) 
	{
		if( !empty($view_folder) && is_dir(APPPATH . $view_folder . DIRECTORY_SEPARATOR) ) 
		{
			$view_folder = APPPATH . $view_folder;
		}
		else 
		{
			if( !is_dir(APPPATH . "views" . DIRECTORY_SEPARATOR) ) 
			{
				header("HTTP/1.1 503 Service Unavailable.", true, 503);
				echo "Your view folder path does not appear to be set correctly. Please open the following file and correct this: " . SELF;
				exit( 3 );
			}
			$view_folder = APPPATH . "views";
		}
	}
	if( ($_temp = realpath($view_folder)) !== false ) 
	{
		$view_folder = $_temp . DIRECTORY_SEPARATOR;
	}
	else 
	{
		$view_folder = rtrim($view_folder, "/\\") . DIRECTORY_SEPARATOR;
	}
	define("VIEWPATH", $view_folder);
	require_once(BASEPATH . "core/CodeIgniter.php");
}
else 
{
	print_r("<div>설정 파일(config.json)이 없습니다.</div>");
	exit();
}
?>
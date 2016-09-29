<?php


ini_set('post_max_size', '5M');
ini_set('upload_max_filesize', '5M');
$env = getenv('APPLICATION_ENV');
if($env != "")
	$config_name= $env;
else
	$config_name = 'production_config';

require_once "config/config.default_config.php"; 
require_once "config/config.$config_name.php";
$config = new $config_name();
require_once $config->mxnphp_dir."/scripts/autoload.php";

/*
$beta_template = isset($_COOKIE['beta_template'])?$_COOKIE['beta_template']:false;
if($beta_template !== false)
	$config->beta_button = false;

if($beta_template == "1" || $config->theme=="mtev2"){
	$config->jsonMode = true;
	$config->theme = 'mtev2';
}elseif(!$beta_template){
	$config->beta_button = true;
	$config->theme="mtev1";
}
*/

$mxnphp = new mxnphp($config);
$mxnphp->load_model();
$mxnphp->load_controler();
/*
$time_end = microtime(true);
$time = $time_end - $time_start;
echo 'Total time: '.$time.' s<br/>';
*/
?>

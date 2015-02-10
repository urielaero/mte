<?php
//error_reporting(0);
#error_reporting(E_ALL ^ E_DEPRECATED ^ E_WARNING);
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

//beta
$beta_template = isset($_COOKIE['beta_template'])?$_COOKIE['beta_template']:false;
if($beta_template !== false)
	$config->beta_button = false;

if($beta_template == "1"){
	$config->jsonMode = true;
	$config->theme = 'mtev2';
}


$mxnphp = new mxnphp($config);
$mxnphp->load_model();
$mxnphp->load_controler();
?>

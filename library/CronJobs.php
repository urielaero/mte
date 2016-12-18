<?php
$cf = getenv('APPLICATION_ENV');
$config_name = $cf ? $cf : "production_config";
require_once "config/config.default_config.php"; 
require_once "config/config.$config_name.php";
$config = new $config_name();
require_once $config->mxnphp_dir."/scripts/autoload.php";


require_once 'models/model.memcached_table.php';
require_once 'controlers/controler.main.php';
require_once 'controlers/controler.api.php';
require_once 'models/model.general.php';
require_once 'models/model.tuberia_denuncia.php';
$main = new main($config);
$res = $main->check_for_notifies();
$send = $config_name === "production_config"?true:false;
$main->send_notifies($res, $send);

$date = date_create();
$df = $date->format('Y-m-d H:i');


echo "run cron for ".$df."\n";
foreach($res as $den) {
    echo $den["date"]." Send notify for ".$den["email"]. "\n";

}
echo "----\n";

?>

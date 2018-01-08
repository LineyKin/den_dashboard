<?php
$dir =  "connectivity/";

require_once $dir."functions.php";
require_once $dir."config.php";
require_once $dir."db_connect.php";

$db_server = db_connect_server($db_hostname, $db_user, $db_name, $db_password);
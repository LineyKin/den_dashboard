<?php

function _p($something) {
	echo "<pre>";
	print_r($something);
	echo "</pre>";
}

function make_query($query) {
    global $db_server;
    mysqli_query($db_server, "SET NAMES 'utf8'");
    return mysqli_query($db_server, $query);
}

function getSimpleList($queryResult) {
    $num_rows = mysqli_num_rows($queryResult);

    $list = [];
    for ($i = 0; $i < $num_rows; $i++ ) {
        array_push($list, mysqli_fetch_array($queryResult));
    }

    return $list;
}

function db_connect_server($db_hostname, $db_user, $db_name, $db_password) {
	$db_server = mysqli_connect($db_hostname, $db_user, $db_password);
	if (!$db_server) die("Невозможно подключиться к MySQL: ".mysqli_error($db_server));
	mysqli_select_db($db_server, $db_name) or die("Невозможно выбрать базу данных: ". mysqli_error($db_server));
	return $db_server;
}

function get_array_from_file($fp) {
	$array = [];
	while (!feof($fp)) {
		$str = fgetcsv($fp, 1024, ";");
		if (!empty($str[0])) {
			$str_array = explode(",", $str[0]);
			$row = [];
			foreach ($str_array as $key => $value) {
				array_push($row, $value);
			}
			array_push($array, $row);
		}
	}
	return $array;
}
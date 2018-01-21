<?php

require_once "connectivity.php";




$fp = fopen("files/RES.txt", "r"); 
$data_array = get_array_from_file($fp);

_p($data_array);
//die('234');

foreach ($data_array as $key => $value) {
	$abs_week = $value[0];
	$week_of_year = $value[1];
	$week_begin = $value[2];
	$week_end = $value[3];
	$app_id = $value[4];
	$amount = $value[5];
	//$amount = $value[1]*(0.1 + 1.4*rand(0,2));
	$query = "INSERT INTO `den_txt` (abs_week, week_of_year, week_begin, week_end, app_id, amount) 
			  VALUES('$abs_week', '$week_of_year', '$week_begin', '$week_end', '$app_id', '$amount')";
	make_query($query);
}

?>
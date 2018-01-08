<?php

require_once "connectivity.php";




$fp = fopen("files/file_txt.txt", "r"); 
$data_array = get_array_from_file($fp);

_p($data_array);

foreach ($data_array as $key => $value) {
	$app_id = $value[0];
	$amount = $value[1]*(0.1 + 1.4*rand(0,2));
	$query = "INSERT INTO `den_txt` (week, app_id, amount) VALUES(5, '$app_id', '$amount')";
	make_query($query);
}

?>
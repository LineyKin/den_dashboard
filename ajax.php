<?php
require_once "connectivity.php";


$table_caps = [
	1 => [],
	//2 => ["Дата", "Приложение 1", "Приложение 2", "Приложение 3"]
];

$menu_item_id = $_POST['menu_item_id'];
$data_array = [];
$dashboard = [];

$app_id_filter = NULL;
switch ($menu_item_id) {
	case 1:
		$app_id_filter = "2,5,419,420";
		break;
	
	case 2:
		$app_id_filter = "12,24,36,38,88,90,117,128,130,176,195,227,329,331";
		break;

	case 3:
		$app_id_filter = "24,25,26,30,50,51,52,103,104,105,142,143,144,410,282,283,284,285,347,354,295,296,297,305,306,307,338,339,340,382,383,384,385,411,412,413,414,415,416,417,418";
		break;
}


$query = "SELECT week_begin, week_end, app_id, amount FROM den_txt WHERE app_id IN($app_id_filter) ORDER BY week_of_year, app_id";
$result = make_query($query);
$data_array = getSimpleList($result);

$table_caps[1] = ["id"];
foreach ($data_array as $key => $value) {
	$week_begin = date("d.m" , strtotime($value['week_begin']));
	$week_end = date("d.m" , strtotime($value['week_end']));
	$week = $week_begin."-".$week_end;
	if(!in_array($week, $table_caps[1])) {
		array_push($table_caps[1], $week);
	}

	if (!isset($dashboard[$value['app_id']])) {
		$dashboard[$value['app_id']] = [];
		array_push($dashboard[$value['app_id']], $value['app_id']);
	}
	array_push($dashboard[$value['app_id']], $value['amount']);
}


$dashboard = array_values($dashboard);

echo json_encode(['data' => $dashboard, 'table_caps' => $table_caps[1]]);
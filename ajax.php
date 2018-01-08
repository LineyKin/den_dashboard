<?php
require_once "connectivity.php";


$table_caps = [
	1 => [],
	2 => ["Дата", "Приложение 1", "Приложение 2", "Приложение 3"]
];

$menu_item_id = $_POST['menu_item_id'];
$data_array = [];
$dashboard = [];

if ($menu_item_id == 1) {
	$query = "SELECT week, app_id, amount FROM den_txt ORDER BY week, app_id";
	$result = make_query($query);
	$data_array = getSimpleList($result);

	$table_caps[1] = ["id"];
	foreach ($data_array as $key => $value) {
		$week = "week ".$value['week'];
		if(!in_array($week, $table_caps[1])) {
			array_push($table_caps[1], $week);
		}

		if (!isset($dashboard[$value['app_id']])) {
			$dashboard[$value['app_id']] = [];
			array_push($dashboard[$value['app_id']], $value['app_id']);
		}
		array_push($dashboard[$value['app_id']], $value['amount']);
	}
}

$dashboard = array_values($dashboard);

echo json_encode(['data' => $dashboard, 'table_caps' => $table_caps[$menu_item_id]]);
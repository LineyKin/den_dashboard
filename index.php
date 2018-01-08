<?php require_once "connectivity.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'>
	<title>Данные</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="lib/jquery.min.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<!--BOOTSTRAP-->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <!--/BOOTSTRAP-->
</head>
<body>
	<h2 class="page-header">Данные</h2>
	<div class="row">
		<div class="col-md-2">
			<ul id="menu" class="nav nav-pills nav-stacked">
				<li data-id="1" class="active"><a>TXT</a></li>
				<li data-id="2"><a>CSV</a></li>
			</ul>
		</div>	
		<div id="screen" class="col-md-10">
			<div id="screen_table" class="small_table" data-height="0"></div>
			<div id="graph"></div>
		</div>	
	</div>
</body>
<script type="text/javascript" src="script.js"></script>
</html>
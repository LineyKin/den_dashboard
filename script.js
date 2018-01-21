function active_item(obj) {
	$("#menu li").each(function() {
		$(this).removeClass("active");
	});
	$(obj).addClass("active");
}

function create_table(data, table_cap) {
	$("#screen_table").html('<table class="table-bordered"><thead><tr></tr></thead></table>');
	for (var i = 0; i < table_cap.length; i++) {
		$("#screen_table thead tr").append("<th>"+table_cap[i]+"</th>")
	}
	$("#screen_table table").append("<tbody></tbody>");
	for (var i = 0; i < data.length; i++) {
		$("#screen_table table tbody").append("<tr></tr>");
		var row = data[i];
		for (var j = 0; j < row.length; j++) {
			if (j == 0) {
				$("#screen_table table tbody tr:last").append("<th>"+row[j]+"</th>")

			}
			else {
				$("#screen_table table tbody tr:last").append("<td>"+row[j]+"</td>")
			}
		}
	}
}

google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart(data, table_cap) {
	var csv_array = [];
	csv_array[0] = table_cap;
    for (var i = 0; i < data.length; i++) {
    	var csv_step = [];
    	var row = data[i];
    	for (var j = 0; j < row.length; j++) {
    		csv_step[j] = j == 0 ? row[j] : Number(row[j]);
    	};
    	csv_array.push(csv_step);
    };
    var csv_data = google.visualization.arrayToDataTable(csv_array);
    var csv_options = {
        title: 'Динамика',
        curveType: 'function',
        legend: { position: 'none' }
    };
    var csv_chart = new google.visualization.LineChart(document.getElementById('graph'));
    csv_chart.draw(csv_data, csv_options);
}


$("#menu li").on("click", function() {
	active_item(this);
	$("#screen_table").empty();
	var menu_item_id = $(this).data("id");
	$.ajax({
		type: "POST",
		url: "ajax.php",
		data: {
			menu_item_id: menu_item_id
		},
		success: function(ajax_data) {
			var ajax_data = JSON.parse(ajax_data);
			var data = ajax_data['data'];
			var table_cap = ajax_data['table_caps'];
			create_table(data, table_cap);
			drawChart(data, table_cap);
		}
	});
});


$("#screen_table").on("click", function() {
	var height_status = $(this).data("height");
	if (height_status == 0) {
		$(this).data("height", 1);
		$(this).animate({height: $(this)[0].scrollHeight}, 500);
	}
	else {
		$(this).data("height", 0);
		$(this).animate({height: 220}, 500);
	}
});
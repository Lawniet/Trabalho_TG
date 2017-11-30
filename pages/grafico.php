<?php
function grafico($arqu,$ming,$maxg,$mgp)
{  
	echo " 
	<!DOCTYPE html>
	<html lang='pt-br'>
		<body>
			<table>
				<tr>
					<td>
						<div id='piechart'></div>
					</td> 
					<td>
						<div id='table_div'></div>
					</td>
				</tr>
			</table>
			<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
			<script type='text/javascript'>
				// Load google charts
				google.charts.load('current', {'packages':['corechart']});
				google.charts.setOnLoadCallback(drawChart);
				// Draw the chart and set the chart values
				function drawChart()
				{
					var data = google.visualization.arrayToDataTable
					([
					['Task', 'Grau'],
					['Menor grau',".$ming."],
					['Maior grau', ".$maxg."],
					['Maior grau possível', ".$mgp."]
					]);
					var options = {'title':'".$arqu.".txt', 'width':550, 'height':400, legend: { textStyle: { fontSize: 12 } }, legend: true};
					var chart = new google.visualization.LineChart(document.getElementById('piechart'));
					chart.draw(data, options);  
				}
				google.charts.load('current', {'packages':['table']});
				google.charts.setOnLoadCallback(drawTable);
				function drawTable() 
				{
					var data = new google.visualization.DataTable();
					data.addColumn('string', 'Grau');
					data.addColumn('number', 'Valor');
					data.addRows([
					['Menor grau',  {v: 10000, f: '".$ming."'}],
					['Maior grau',   {v:8000,   f: '".$maxg."'}],
					['Maior grau possível', {v: 12500, f: '".$mgp."'}]
					]);
					var table = new google.visualization.Table(document.getElementById('table_div'));
					table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
				}
			</script>
		</body>
	</html>
	";
}
?>
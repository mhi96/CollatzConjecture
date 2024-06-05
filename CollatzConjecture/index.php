<?php
if(isset($_GET['num']))
{
	if(empty($_GET['num']))
	{
		$a = 25;
		$e = $a;
	}
	else
	{
		if($_GET['num']<1 || $_GET['num']>999999999999999)
		{
			$a = 25;
			$e = $a;
		}
		else
		{
			$a = $_GET['num'];
			$e = $a;
		}
	}
	
}
else
{
	$a = 25;
	$e = $a;
}
$b = 1;
$c = '['.$b.','.$a.'],';
while($a!=1)
{
	$b++;
	if($a % 2 == 0)
	{
		$a=$a/2;
	}
	else
	{
		$a=($a*3)+1;
	}
	
	if($a==1)
	{
		$c = $c.'['.$b.','.$a.']';
	}
	else
	{
		$c = $c.'['.$b.','.$a.'],';
	}
	
	
}

$d = '{"price_usd":['.$c.']}';


?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function() {
 
var dataPoints = [];
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	zoomEnabled: true,
	title: {
		text: "Collatz Conjecture <?= $e ?>"
	},
	axisY: {
		title: "Numbers",
		titleFontSize: 24,
	},
	data: [{
		type: "line",
		//yValueFormatString: "$#,##0.00",
		dataPoints: dataPoints
	}]
});
 
function addData(data) {
	var dps = data.price_usd;
	for (var i = 0; i < dps.length; i++) {
		dataPoints.push({
			x: dps[i][0],
			y: dps[i][1]
		});
	}
	chart.render();
}
 

var jsonString = '<?= $d;?>';
var jsonData = JSON.parse(jsonString);
addData(jsonData);
 
}
</script>
</head>
<body>
	<form> <input type="number" name="num" placeholder="input conjecture number"/>
	<input type="submit" value="Send"></form>
	<p><?php 
			if(isset($_GET['num']))
			{
				if($_GET['num']<1 || $_GET['num']>999999999999999)
				{
					echo 'Number must be greater than 0 and less than 999,999,999,999,999';
				} 
			}
		?>
	</p>
<div id="chartContainer" style="height: 370px; width: 50%;"></div>
<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://cdn.canvasjs.com/jquery.canvasjs.min.js"></script>
</body>
</html>

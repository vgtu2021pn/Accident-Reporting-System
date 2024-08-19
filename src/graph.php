<?php

	session_start();  
	if(!isset($_SESSION["username"]))  
	{  
		header("location:Login.php?action=login");  
	}

    $servername = "localhost";                              // Connecting to the database 
	$user = "ardb";
	$pw = "mypassword";
	$db = "accidentreportingdb";

	$connection = mysqli_connect($servername, $user, $pw, $db);			

	if(!$connection){
		die("Connection failed: " .mysqli_connect_error());
	}

?>

<!DOCTYPE html>
<html lang="en">
<head> 
	<meta charset="utf-8">
	<title>Accident Analysis</title>
	
	<link rel="icon" href="images/car.png" type="image/gif">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</head>
<body style="background: #173457;">

	<!--****************************************************************Navigation Bar*****************************************************************-->
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">Accident Reporting System</a>
			</div>
    
			<ul class="nav navbar-nav">
				<li ><a href="AccList.php">Accidents</a></li>
				<li class="active"><a href="#">Analysis</a></li>
			</ul>
			
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION["username"]; ?></a></li>
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Log Out</a></li>
			</ul>
		</div>
	</nav>


	<?php
		
		/****************************************************************Accident Type****************************************************************/
		$selectAccType = "SELECT
							category
						FROM
							accident
						WHERE
							accident_id
						IN
							(SELECT accident_id FROM vehicle_accident WHERE accident_id
						IN 
							(SELECT accident_id FROM accident));";
		$result1 = mysqli_query($connection, $selectAccType);
		
		if(mysqli_num_rows($result1)>0)
		{
			$a = 0;
			$b = 0;
			$c = 0;
			$d = 0;
			$e = 0;
			$f = 0;
			
			while ($row1 = mysqli_fetch_array($result1)) {
				
				if($row1["category"] == 'Rear-End Collisions')
				{
					$a++;
				}
				else if($row1["category"] == 'Head-On Collisions')
				{
					$b++;
				}
				else if($row1["category"] == 'Side-Impact Collisions')
				{
					$c++;
				}
				else if($row1["category"] == 'Sideswipe Accidents')
				{
					$d++;
				}
				else if($row1["category"] == 'Single-Vehicle Accidents')
				{
					$e++;
				}
				
				$f++;
				
			}
		}
		
		mysqli_free_result($result1);
		
		/****************************************************************Vehicle Type****************************************************************/
		$selectVehType = "SELECT
							vehicle_type
						FROM
							vehicle
						WHERE
							reg_no
						IN
							(SELECT registration_no AS reg_no FROM vehicle_accident WHERE accident_id
						IN 
							(SELECT accident_id FROM accident));";
		$result2 = mysqli_query($connection, $selectVehType);/*vehicle type involved in accidents*/
		
		if(mysqli_num_rows($result2)>0)
		{
			$g = 0;
			$h = 0;
			$i = 0;
			$j = 0;
			$k = 0;
			$l = 0;
			
			while ($row2 = mysqli_fetch_array($result2)) {
				
				if($row2["vehicle_type"] == 'Car')
				{
					$g++;
				}
				else if($row2["vehicle_type"] == 'Van')
				{
					$h++;
				}
				else if($row2["vehicle_type"] == 'Motorbike')
				{
					$i++;
				}
				else if($row2["vehicle_type"] == 'Truck')
				{
					$j++;
				}
				else if($row2["vehicle_type"] == 'Bus')
				{
					$k++;
				}
				
				$l++;
				
			}
		}
		
		mysqli_free_result($result2);
		
		/****************************************************************Fluctuation****************************************************************/
		
		$three_years_before = (int)date("Y") - 3;
		$two_years_before = (int)date("Y") - 2;
		$one_year_before = (int)date("Y") - 1;
		$today = (int)date("Y");
		$after_one_year = (int)date("Y") + 1;
		
		$selectFluctThreeYears = "SELECT COUNT(REGEXP_INSTR(date, '[0-9]{4}')) AS stats FROM accident WHERE date = " . $three_years_before . " AND accident_id IN (SELECT accident_id FROM vehicle_accident)";
		$result3 = mysqli_query($connection, $selectFluctThreeYears);
		
		$m = mysqli_fetch_array($result3);
		
		mysqli_free_result($result3);
		
		$selectFluctTwoYears = "SELECT COUNT(REGEXP_INSTR(date, '[0-9]{4}')) AS stats FROM accident WHERE date = " . $two_years_before . " AND accident_id IN (SELECT accident_id FROM vehicle_accident)";
		$result4 = mysqli_query($connection, $selectFluctTwoYears);
		
		$n = mysqli_fetch_array($result4);
		
		mysqli_free_result($result4);
		
		$selectFluctOneYear = "SELECT COUNT(REGEXP_INSTR(date, '[0-9]{4}')) AS stats FROM accident WHERE date = " . $one_year_before . " AND accident_id IN (SELECT accident_id FROM vehicle_accident)";
		$result5 = mysqli_query($connection, $selectFluctOneYear);
		
		$o = mysqli_fetch_array($result5);
		
		mysqli_free_result($result5);
		
		$selectFluctToday = "SELECT COUNT(REGEXP_INSTR(date, '[0-9]{4}')) AS stats FROM accident WHERE date = " . $today . " AND accident_id IN (SELECT accident_id FROM vehicle_accident)";
		$result6 = mysqli_query($connection, $selectFluctToday);
		
		$p = mysqli_fetch_array($result6);
		
		mysqli_free_result($result6);
		
		$selectFluctAfter = "SELECT COUNT(REGEXP_INSTR(date, '[0-9]{4}')) AS stats FROM accident WHERE date = " . $after_one_year . " AND accident_id IN (SELECT accident_id FROM vehicle_accident)";
		$result7 = mysqli_query($connection, $selectFluctAfter);
		
		$q = mysqli_fetch_array($result7);
		
		mysqli_free_result($result7);
		
		/****************************************************************Accident Type****************************************************************/
		$dataPoints_for_PieChart = array( 
			array("label"=>"Rear-End Collisions", "y"=> ($a/$f)*100),
			array("label"=>"Head-On Collisions", "y"=> ($b/$f)*100),
			array("label"=>"Side-Impact Collisions", "y"=> ($c/$f)*100),
			array("label"=>"Sideswipe Accidents", "y"=> ($d/$f)*100),
			array("label"=>"Single-Vehicle Accidents", "y"=> ($e/$f)*100),
		);
		
		
		/****************************************************************Vehicle Type****************************************************************/
		$dataPoints_for_PieChart1 = array( 
			array("label"=>"Car", "y"=> ($g/$l)*100),
			array("label"=>"Van", "y"=> ($h/$l)*100),
			array("label"=>"Motorbike", "y"=> ($i/$l)*100),
			array("label"=>"Truck", "y"=> ($j/$l)*100),
			array("label"=>"Bus", "y"=> ($k/$l)*100),
		);

		
		/****************************************************************Fluctuation****************************************************************/
		$dataPoints = array(
			array("label" => $three_years_before, "y" => $m['stats']),
			array("label" => $two_years_before, "y" => $n['stats']),
			array("label" => $one_year_before, "y" => $o['stats']),
			array("label" => $today, "y" => $p['stats']),
			array("label" => $after_one_year, "y" => $q['stats']),
		);
		
		echo var_export($m['stats']);
		echo var_export($n['stats']);
		echo var_export($o['stats']);
		echo var_export($p['stats']);
		echo var_export($q['stats']);
	?>
	
	
	<script>

		window.onload = function() {

			//****************************************************************Accident Type****************************************************************/
			var chart = new CanvasJS.Chart("chartContainer_PieChart", {
				animationEnabled: true,
				title: {
					text: "Accident Type"
				},
				subtitles: [{
					text: "Year " + <?php echo '"'.$today.'"'; ?>
				}],
				data: [{
					type: "pie",
					yValueFormatString: "#,##0.00\"%\"",
					indexLabel: "{label} ({y})",
					dataPoints: <?php echo json_encode($dataPoints_for_PieChart, JSON_NUMERIC_CHECK); ?>
				}]
			});
			chart.render();
			
			
			//****************************************************************Vehicle Type****************************************************************/
			var chart = new CanvasJS.Chart("chartContainer_PieChart1", {
				animationEnabled: true,
				title: {
					text: "Vehicle Type"
				},
				subtitles: [{
					text: "Year " + <?php echo '"'.$today.'"'; ?>
				}],
				data: [{
					type: "pie",
					yValueFormatString: "#,##0.00\"%\"",
					indexLabel: "{label} ({y})",
					dataPoints: <?php echo json_encode($dataPoints_for_PieChart1, JSON_NUMERIC_CHECK); ?>
				}]
			});
			chart.render();


			//****************************************************************Fluctuation****************************************************************/
			var chart = new CanvasJS.Chart("chartContainer", {
				animationEnabled: true,
				title: {
					text: "Accident fluctuation over the years"
				},
				axisY: {
					title: "Number of Accidents"
				},
				data: [{
					type: "spline",
					dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
				}]
			});
			chart.render();

		}

	</script>
	

	<center>
		<div>
			<table style="padding: 10px;">
				<tr>
				
					<!--****************************************************************Accident Type************************************************************-->
					<td style="padding: 20px;">
						<div id="chartContainer_PieChart" style="height: 400px; width: 600px; border: 1px solid black;"></div>
						
					</td>
					
					
					<!--****************************************************************Vehicle Type************************************************************-->
					<td style="padding: 20px;">
						<div id="chartContainer_PieChart1" style="height: 400px; width: 600px; border: 1px solid black;"></div>
					</td>
				</tr>
			
				<tr>
				
					<!--****************************************************************Fluctuation************************************************************-->
					<td colspan=2 style="padding: 20px;">
						<div id="chartContainer" style="height: 370px; width: 100%; border: 1px solid black;"></div>
					</td>
				</tr>
			</table>
		</div>
	</center>

</body>
</html>

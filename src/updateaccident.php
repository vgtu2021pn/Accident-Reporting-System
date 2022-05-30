<?php

	session_start();  
	if(!isset($_SESSION["username"]))  
	{  
		header("location:Login.php?action=login");  
	}

    $servername = "localhost";                              // Connecting to the database 
	$user = "root";
	$pw = "";
	$db = "accidentreportingdb";

	$connection = mysqli_connect($servername, $user, $pw, $db);			

	if(!$connection){
		die("Connection failed: " .mysqli_connect_error());
	}


?>

<html>
<head> 

	<title>Update Accident</title>
	
	<link rel="icon" href="images/car.png" type="image/gif">

	<link rel="stylesheet" type="text/css" href="src/The Smart Parking System.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="src/jquery-1.9.1.min.js"></script>
	
	<!--location-->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
	
	<style>
		
		label{
			font-size: 15px;
			color: white;
		}
		
		.form-control{
			font-size: 15px;
		}
		
		#map{
			width:500px; 
			height: 250px;
		}
	</style>

</head>
<body style="background: #173457;">

	<!--****************************************************************Navigation Bar*****************************************************************-->
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">Accident Reporting System</a>
			</div>
    
			<ul class="nav navbar-nav">
				<li class="active"><a href="#">Update Accident</a></li>
			</ul>
			
			<ul class="nav navbar-nav navbar-right">
				<li><a href="useraccount.php"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION["username"]; ?></a></li>
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Log Out</a></li>
			</ul>
		</div>
	</nav>


	<!--****************************************************************Reporting Form*****************************************************************-->
	<?php
		$acc_id = $_POST['acc_id'];
		
		$selectqry = "SELECT * FROM accident WHERE accident_id = $acc_id";
		$result = mysqli_query($connection, $selectqry);
						
		$row = mysqli_fetch_assoc($result);
	?>
	
	<form method="POST" action="updateaccident.php" enctype="multipart/form-data">
	
		<input type="hidden" name="acc_id" value="<?php echo $acc_id; ?>">
	
		<center>
		<div style="width: 1000px;">
		
			<table width="100%" >
  
				<tr>
					<td colspan="2" style="padding: 5px;">
						<div class="col-md-4 mb-3" style="width: 500px;">
							<h1 style="width: 500px; color: white;">Update Your Accident</h1>
						</div>
					</td>
				</tr>
		
				<tr>
					<td style="padding: 5px;">														<!--topic-->
						<div class="col-md-4 mb-3">
							<label for="validationDefault01">Topic</label>
							<input type="text" name="reportTopic" class="form-control" id="validationDefault01" placeholder="Topic" value="<?php echo $row['topic']; ?>" style="width: 500px;" required>
						</div>	
					</td>
			
					<td rowspan="3" style="padding: 5px;">											<!--location-->
						<div class="col-md-6 mb-3">
							<label for="validationDefault03">Location</label>
							<input type="text" name="reportLocation" class="form-control" id="validationDefault03" placeholder="Location" value="<?php echo $row['location']; ?>" style="width: 500px;" required><br>
						  
							<div id="map"></div>
				
							<input type="hidden" id="lat" readonly="yes">
							<input type="hidden" id="lng" readonly="yes">
						</div>
					</td>
				</tr>
		
				<tr>
					<td style="padding: 5px;">														<!--description-->
						<div class="col-md-4 mb-3">
							<label for="validationDefault02">Description</label>
							<textarea name="reportDescription" class="form-control" id="validationDefault02" placeholder="Description" value="<?php echo $row['description']; ?>" rows="5" style="width: 500px;"required></textarea>
						</div>
					</td>
				</tr>
		
				<tr>
					<td style="padding: 5px;">																<!--category-->
						<div class="col-md-4 mb-3">
							<label for="exampleFormControlSelect1" >Category</label>
							<select name="reportCategory" class="form-control" id="exampleFormControlSelect1" value="<?php echo $row['category']; ?>" style="width: 500px; padding: 0px;">
								<option value="0">--Category--</option>
								<option value="Rear-End Collisions">Rear-End Collisions</option>
								<option value="Head-On Collisions">Head-On Collisions</option>
								<option value="Side-Impact Collisions">Side-Impact Collisions</option>
								<option value="Sideswipe Accidents">Sideswipe Accidents</option>
								<option value="Single-Vehicle Accidents">Single-Vehicle Accidents</option>
							</select>
						</div>
					</td>
					
				</tr>
		
				<tr>
					<td style="padding: 5px;">																<!--date-->
						<div class="col-md-3 mb-3">
						  <label for="validationDefault04">Date</label>
						  <input type="date" name="reportDate" class="form-control" id="validationDefault04" placeholder="Date" value="<?php echo $row['date']; ?>" style="width: 500px;" required>
						</div>
					</td>
					
					<td style="padding: 5px;">																<!--images-->
						<div class="col-md-4 mb-3">
							<label for="exampleFormControlFile1">Images</label>
							<input type="file" name="file[]" class="form-control-file" id="exampleFormControlFile1" style="width: 500px; color: white; font-size: 15px;" multiple>
						</div>
					</td>
				</tr>
				
				<tr>
					<td style="padding: 5px;">																<!--time-->
						<div class="col-md-3 mb-3">
						  <label for="validationDefault05">Time</label>
						  <input type="time" name="reportTime" class="form-control" id="validationDefault05" placeholder="Time" value="<?php echo $row['time']; ?>" style="width: 500px;" required>
						</div>
					</td>
					
					<td style="padding: 5px;">																<!--Registration Number-->
						<div class="col-md-3 mb-3">
						  <!--<label for="validationDefault05" >Reg. Number</label>
						  <input type="text" name="registrationNo" class="form-control" id="validationDefault05" placeholder="Registration Number" style="width: 500px;" required>-->
						</div>
					</td>
				</tr>
		        <tr>
				    <td colspan=2 style="padding-left:250px;">												<!--submit button-->
						<div class="col-md-4 mb-3" style="padding-top: 5px;">
							<button name="updateAccident" class="btn btn-primary" type="submit" style="width: 500px; color: white; font-size: 15px;align:center;">Update Report</button>
		                </div>
					</td>
				</tr>
			</table>
  
		</div>
		</center>
		
	</form>



<?php

if(isset($_POST['updateAccident']))   
{
	$acc_id = $_POST['acc_id'];
	$reportTopic = $_POST['reportTopic'];
	$reportDescription = $_POST['reportDescription'];
	$reportCategory = $_POST['reportCategory'];
	$reportDate = $_POST['reportDate'];
	$reportTime = $_POST['reportTime'];
	$reportLocation = $_POST['reportLocation'];
	//$registrationNo = $_POST['registrationNo'];
	
	//echo $reportTopic."<br>"; echo $reportDescription."<br>"; echo $reportCategory."<br>"; echo $reportDate."<br>"; echo $reportTime."<br>"; echo $reportLocation."<br>";
	
	$selectqry = "SELECT max(accident_id) as maxid from accident";
	$result=mysqli_query($connection,$selectqry);
	
	$row=mysqli_fetch_assoc($result);
	//echo $row["maxid"];
	$maxid = $row["maxid"];
	$accidentId = $maxid+1;
	
	// updating data to accident table
					
	$updateAccident = "UPDATE accident SET
							topic = '$reportTopic',
							category = '$reportCategory',
							description = '$reportDescription',
							location = '$reportLocation',
							date = '$reportDate',
							time = '$reportTime'
						WHERE
							accident_id = $acc_id";
						
	$resultaccident = mysqli_query($connection,$updateAccident);
	
					
	// updating data to vehicle_accident
	/*$updatevehicle_accident = "UPDATE vehicle_accident SET
									registration_no = '$registrationNo'
								WHERE
									accident_id = $acc_id";
	
	$resultvehicle_accident = mysqli_query($connection,$updatevehicle_accident);*/
						
	// updating data to accident_photo table
	$fileCount = count($_FILES['file']['name']); 
						
	for($i=0; $i<$fileCount; $i++)
	{
		$fileName = $_FILES['file']['name'][$i];
		$filePath = "images/".$accidentId."/".$fileName;
								
		$updateaccident_photo = "UPDATE accident_photo SET
									photo = '$filePath'
								WHERE
									accident_id = $acc_id";
		
		$resultaccident_photo= mysqli_query($connection,$updateaccident_photo);
						
						
		move_uploaded_file($_FILES['file']['tmp_name'][$i], 'upload/'.$fileName); // Adding images to the local folder 
	}	
						
	if($resultaccident)
	{
?>
		<script> alert("Accident is Updated Successfully"); </script>;
<?php
		header("location:useraccount.php");  
	}
	else
	{
?>
		<script> alert("Error Uploading Iamges"); </script>;
<?php
	}
}	
?>					










<script>

/****************************************Google Location*******************************************************/
	var map; //Will contain map object.
	var marker = false; ////Has the user plotted their location marker? 
        
	//Function called to initialize / create the map.
	//This is called when the page has loaded.
	function initMap() {

		//The center location of our map.
		var centerOfMap = new google.maps.LatLng(6.878437779456305, 79.87726112391942);

		//Map options.
		var options = {
			center: centerOfMap, //Set center.
			zoom: 10 //The zoom value.
		};

		//Create the map object.
		map = new google.maps.Map(document.getElementById('map'), options);

		//Listen for any clicks on the map.
		google.maps.event.addListener(map, 'click', function(event) {                
			//Get the location that the user clicked.
			var clickedLocation = event.latLng;
			//If the marker hasn't been added.
			if(marker === false){
				//Create the marker.
				marker = new google.maps.Marker({
					position: clickedLocation,
					map: map,
					draggable: true //make it draggable
				});
				//Listen for drag events!
				google.maps.event.addListener(marker, 'dragend', function(event){
					markerLocation();
				});
			} else{
				//Marker has already been added, so just change its location.
				marker.setPosition(clickedLocation);
			}
			//Get the marker's location.
			markerLocation();
		});
	}
        
	//This function will get the marker's current location and then add the lat/long
	//values to our textfields so that we can save the location.
	function markerLocation(){
		//Get location.
		var currentLocation = marker.getPosition();
		//Add lat and lng values to a field that we can save.
		document.getElementById('lat').value = currentLocation.lat(); //latitude
		document.getElementById('lng').value = currentLocation.lng(); //longitude
	}
        
        
	//Load the map when the page has finished loading.
	google.maps.event.addDomListener(window, 'load', initMap);
	
</script>




</body>
</html>
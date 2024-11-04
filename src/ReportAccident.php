<?php  
	//entry.php  
	session_start();  
	if(!isset($_SESSION["username"]))  
	{  
		header("location:Login.php?action=login");  
	} 
?>
<!DOCTYPE html> 
<html lang="en">
<head> 
	<meta charset="utf-8">
	<title>Report an Accident</title>
	
	<link rel="icon" href="images/car.png" type="image/gif">

	<!--nav bar-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	
	<!--reporting form-->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	
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
	<nav class="navbar navbar-inverse" style="height: 52px;">
		<div class="container-fluid" style="padding: 0px 0px; height: 50px;">
		<table width="100%" style="margin-top: -10px; margin-left: -18px; margin-left: 0px;">
			<tr>
				<td style="width: 145px;">
					<div class="navbar-header" >
						<a class="navbar-brand" style="padding: 15px; margin: 0px 0px 0px -15px; font-size: 18px; font-family: Helvetica Neue, Helvetica, Arial, sans-serif;" href="#">Accident Reporting System</a>
					</div>
				</td>

				<td>
					<table>
						<tr>
							<td>
								<ul class="nav navbar-nav">
									<li class="active">
										<a href="#" style="padding: 15px; font-size: 14px; font-family: Helvetica Neue, Helvetica, Arial, sans-serif;">Report an Accident</a>
									</li>
								</ul>
							</td>
							<td>
								<!--<ul class="nav navbar-nav">
									<li>
										<a href="#" style="padding: 15px; font-size: 14px; font-family: Helvetica Neue, Helvetica, Arial, sans-serif;">Accidents</a>
									</li>
								</ul>-->
							</td>
						</tr>
					</table>
				</td>
				
				<td>
					<table align="right">
						<tr>
							<td>
								<ul class="nav navbar-nav navbar-right">
									<li>
										<a href="useraccount.php" style="padding: 15px; font-size: 14px; font-family: Helvetica Neue, Helvetica, Arial, sans-serif;"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION["username"]; ?></a>
									</li>
								</ul>
							</td>
							<td style="padding: 5px;">
								<ul class="nav navbar-nav navbar-right">
									<li>
										<a href="logout.php" style="padding: 15px; font-size: 14px; font-family: Helvetica Neue, Helvetica, Arial, sans-serif;"><span class="glyphicon glyphicon-log-in"></span> Log Out</a>
									</li>
								</ul>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		</div>
	</nav>

	
	<!--****************************************************************Reporting Form*****************************************************************-->
	
	
	<form method="POST" action="" enctype="multipart/form-data">
	
		<center>
		<div style="width: 1000px;">
		
			<table width="100%" >
  
				<tr>
					<td colspan="2" style="padding: 5px;">
						<div class="col-md-4 mb-3" style="width: 500px;">
							<h1 style="width: 500px; color: white;">Report Your Accident Here...</h1>
						</div>
					</td>
				</tr>
		
				<tr>
					<td style="padding: 5px;">														<!--topic-->
						<div class="col-md-4 mb-3">
							<label for="validationDefault01">Topic</label>
							<input type="text" name="reportTopic" class="form-control" id="validationDefault01" placeholder="Topic" style="width: 500px;" required>
						</div>	
					</td>
			
					<td rowspan="3" style="padding: 5px;">											<!--location-->
						<div class="col-md-6 mb-3">
							<label for="validationDefault03">Location</label>
							<input type="text" name="reportLocation" class="form-control" id="validationDefault03" placeholder="Location" style="width: 500px;" required><br>
						  
							<div id="map"></div>
				
							<input type="hidden" name="lat" id="lat" value="">
							<input type="hidden" name="lng" id="lng" value="">
						</div>
					</td>
				</tr>
		
				<tr>
					<td style="padding: 5px;">														<!--description-->
						<div class="col-md-4 mb-3">
							<label for="validationDefault02">Description</label>
							<textarea name="reportDescription" class="form-control" id="validationDefault02" placeholder="Description" rows="5" style="width: 500px;"required></textarea>
						</div>
					</td>
				</tr>
		
				<tr>
					<td style="padding: 5px;">																<!--category-->
						<div class="col-md-4 mb-3">
							<label for="exampleFormControlSelect1" >Category</label>
							<select name="reportCategory" class="form-control" id="exampleFormControlSelect1" style="width: 500px; padding: 0px;">
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
						  <input type="date" name="reportDate" class="form-control" id="validationDefault04" placeholder="Date" style="width: 500px;" required>
						</div>
					</td>
					
					<td style="padding: 5px;">																<!--images-->
						<div class="col-md-4 mb-3">
							<label for="exampleFormControlFile1">Images</label>
							<input type="file" name="file[]" accept="image/*" class="form-control-file" id="exampleFormControlFile1" style="width: 500px; color: white; font-size: 15px;" multiple>
						</div>
					</td>
				</tr>
				
				<tr>
					<td style="padding: 5px;">																<!--time-->
						<div class="col-md-3 mb-3">
						  <label for="validationDefault05">Time</label>
						  <input type="time" name="reportTime" class="form-control" id="validationDefault05" placeholder="Time" style="width: 500px;" required>
						</div>
					</td>
					
					<td style="padding: 5px;">																<!--Registration Number-->
						<div class="col-md-3 mb-3">
						  <label for="validationDefault05" >Reg. Number</label>
						  <input type="text" name="registrationNo" class="form-control" id="validationDefault05" placeholder="Registration Number" style="width: 500px;" required>
						</div>
					</td>
				</tr>
		        <tr>
				    <td colspan=2 style="padding-left:250px;">												<!--submit accident-->
						<div class="col-md-4 mb-3" style="padding-top: 5px;">
							<input name="btnSubmitAccident" type="submit" class="btn btn-primary" value="Submit form" style="width: 500px; color: white; font-size: 15px;align:center;" id="btnSubmitAccident" onclick="JavaScript:return validateReportAccidentForm();">
		                </div>
					</td>
				</tr>
			</table>
  
		</div>
		</center>
		
	</form>

<script type="text/javascript">

	/****************************************Validating Number of Files uploaded*******************************************************/
	const inputImages = document.querySelector('#exampleFormControlFile1');

	// Listen for files selection
	inputImages.addEventListener('change', (e) => {
		// Retrieve all files
		const files = inputImages.files;

		// Check files count
		if (files.length < 4) {
			alert('A minimum number of 4 images are required.');
			inputImages.value = '';
			return;
		}
		if (files.length > 4) {
			alert('Only 4 images are allowed to upload.');
			inputImages.value = '';
			return;
		}

	});
	
	
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
		document.querySelector("input[name='lat']").value = currentLocation.lat(); //latitude
		document.querySelector("input[name='lng']").value = currentLocation.lng(); //longitude
	}
        
        
	//Load the map when the page has finished loading.
	google.maps.event.addDomListener(window, 'load', initMap);
	
</script>

<?php 
                    $servername = "localhost";                              // Connecting to the database 
					$user = "ardb";
					$pw = "mypassword";
					$db = "accidentreportingdb";

					$connection = mysqli_connect($servername, $user, $pw, $db);			

					if(!$connection)
					{
						die("Connection failed: " .mysqli_connect_error());
					}
					else
				    {
						//echo "Connected successfully";
					}
					
					if(isset($_POST['btnSubmitAccident']))   
					{
	                    $reportTopic = $_POST['reportTopic'];
						$reportDescription = $_POST['reportDescription'];
						$reportCategory = $_POST['reportCategory'];
						$reportDate = $_POST['reportDate'];
						$reportTime = $_POST['reportTime'];
						$reportLocation = $_POST['reportLocation'];
						$reportLat = $_POST['lat'];
						$reportLng = $_POST['lng'];
						$registrationNo = $_POST['registrationNo'];
						$success_r = false;
						
						//echo $reportTopic."<br>"; echo $reportDescription."<br>"; echo $reportCategory."<br>"; echo $reportDate."<br>"; echo $reportTime."<br>"; echo $reportLocation."<br>";
	
						$selectqry = "SELECT max(accident_id) as maxid from accident";
						if($result=mysqli_query($connection,$selectqry)){
							$row=mysqli_fetch_assoc($result);
							if(is_null($row['maxid'])){$accidentId=1;}
							else{$accidentId = $row['maxid']+1;}
							mysqli_free_result($result);
							//echo $row['maxid'];
						}
						
						// Inserting data to accident table
						
						$insertaccident = "INSERT INTO accident (accident_id,topic,category,description,location,lat,lng,date,time) 
						                 VALUES (?,?,?,?,?,?,?,?,?)";
						
						$insertprepare = mysqli_prepare($connection, $insertaccident);
						mysqli_stmt_bind_param($insertprepare, 'issssssss', $accidentId, $reportTopic, $reportCategory, $reportDescription, $reportLocation, $reportLat, $reportLng, $reportDate, $reportTime);
						mysqli_stmt_execute($insertprepare);
						
						$selectqry = "SELECT * FROM accident WHERE accident_id=?";
						$stmt = mysqli_prepare($connection, $selectqry);
						mysqli_stmt_bind_param($stmt,'i', $accidentId);
						mysqli_stmt_execute($stmt);
						$result = mysqli_stmt_get_result($stmt);
						
						if(mysqli_num_rows($result) > 0){
							$success_r = true;
						}else{
							$success_r = false;
						}
						
					    // Inserting data to vehicle_accident
						
						$insertvehicle_accident = "INSERT INTO vehicle_accident (accident_id,registration_no) 
						                 VALUES (?,?)";
						                 
						$insertscndprepare = mysqli_prepare($connection, $insertvehicle_accident);
						mysqli_stmt_bind_param($insertscndprepare, 'is', $accidentId, $registrationNo);
						mysqli_stmt_execute($insertscndprepare);
						
						// Insering data to accident_photo table
					
						$fileCount = count($_FILES['file']['name']);
						@mkdir(__DIR__ . '/upload/' . $accidentId, 0755);
						$success_u = false;
						
						for($i=0;$i<$fileCount;$i++)
						{
							$fileName = $_FILES['file']['name'][$i];
							$fileName_r = preg_replace('/[^a-zA-Z0-9_.]+/','-', $fileName);
							$filePath = "images/".$accidentId."/".$fileName_r;
							
							$insertaccident_photo = "INSERT INTO accident_photo (accident_id,photo) 
						                 VALUES (?,?)";
						    
						    $insertthrdprepare = mysqli_prepare($connection, $insertaccident_photo);
						    mysqli_stmt_bind_param($insertthrdprepare, 'is', $accidentId, $filePath);
						    mysqli_stmt_execute($insertthrdprepare);
						
							if(move_uploaded_file($_FILES['file']['tmp_name'][$i], __DIR__ . '/upload/'. $accidentId .'/'. $fileName)){
								$success_u = true;
							}else{
								$success_u = false;
							}
						}
						
						if($success_r && $success_u){
?>
							<script> alert("Accident is Reported Successfully."); </script>
<?php
						}
						else{
?>
							<script> alert("Error Uploading Images."); </script>
<?php
						}
					}
?>					
</body>
</html>

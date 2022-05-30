<?php  
 //entry.php  
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

					if(!$connection)
					{
						die("Connection failed: " .mysqli_connect_error());
					}
					else
				    {
						//echo "Connected successfully";
					} 
 ?>  
 
<!DOCTYPE html>  
<html>  
<head>  
	<title>My Account</title>
		   
	<link rel="icon" href="images/car.png" type="image/gif">
		   
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		   
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	<style>
		.user-cell{
			padding: 0px;
		}
		
		table.view-table{
			width: 100%;
			margin-left: auto;
			margin-right: auto;
			background-color: rgba(192, 192, 192, 0.5);
			color: black;
			margin-bottom: 20px;
		}
		
		tr.view-row{
			border-collapse: collapse;
		}
		
		td.view-cell{
			padding: 10px 10px 10px 10px; /*top right bottom left*/
		}
		
		.edit-icons{
			height: 25px;
			width: 25px;
		}
		
		.edit-buttons{
			padding: 8px;
			border: 1px solid black;
			background-color: #173457;
			border-radius: 20px;
		}
		
		.edit-buttons:hover{
			background-color: rgba(250, 250, 250, 0.5);
			border: 0px;
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
				<li><a href="ReportAccident.php">Report an Accident</a></li>
				<!--<li><a href="#">Analysis</a></li>-->
			</ul>
			
			<ul class="nav navbar-nav navbar-right">
				<li class="active"><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION["username"]; ?> </a></li>
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Log Out</a></li>
			</ul>
		</div>
	</nav>
	
<?php

	/****************************************************************Update & Delete**********************************************************************/

	if(isset($_POST['delete']))   
	{
		$acc_id = $_POST['acc_id'];
		
		/*delete vehicle_accident*/
		$delete_Vehicle_Accident_qry = "DELETE FROM vehicle_accident WHERE accident_id = $acc_id";
		$result_delete_Vehicle_Accident = mysqli_query($connection, $delete_Vehicle_Accident_qry);
		
		if($result_delete_Vehicle_Accident)
		{
			header("refresh: 3");
?>
			<div class="container">
				<div class="alert alert-danger alert-dismissible fade in">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					Your report with ID <?php echo $acc_id; ?> has been deleted successfully
				</div>
			</div>
<?php
		}
		

	}
	

?>
	
	
	<!--****************************************************************Displaying user info*****************************************************************-->
 
	<div class="container" style="width: 100%; color: white; display: flex;">

		<?php  
			$selectqry = "SELECT first_name,last_name as maxid from vehicle";
			$result=mysqli_query($connection,$selectqry);
			
			$row=mysqli_fetch_assoc($result);
			
			$name = $row["first_name"];
			
			
			/*echo '<label><a href="logout.php">Logout</a></label>';*/
			
			$username = $_SESSION["username"];
			
			$selectUserDataqry = "SELECT 
									CONCAT(first_name, ' ', last_name) AS fullname,
									address,
									telephone,
									dob,
									driver_nic,
									license_no,
									email,
									vehicle_type
								FROM
									vehicle
								WHERE
									reg_no = '$username'";
			$resultUserData = mysqli_query($connection, $selectUserDataqry);
			
			$rowUserData = mysqli_fetch_assoc($resultUserData);
			
		?>
		
		
		<!--****************************************************************User data*****************************************************************-->
		
		<div style="width: 30%; padding: 0px 50px 50px 50px;">
			<table border=0 style="width: 100%; ">
				<tr>
					<td align="center" colspan=2>
						<img src="images/user.jpg" style="height: 100px; width: 100px; border-radius: 50px;">
					</td>
				</tr>
				
				<tr>
					<td class="user-cell" align="center" colspan=2>
						<h1>Welcome - <?php echo $username; ?></h1>
					</td>
				</tr>
				
				<tr>
					<td class="user-cell"style="width: 50%"><b>Name:</b></td>
					<td class="user-cell">
						<?php echo $rowUserData['fullname']; ?>
					</td>
				</tr>
				
				<tr>
					<td colspan=2><hr></td>
				</tr>
				
				<tr>
					<td class="user-cell"><b>Address:</b></td>
					<td class="user-cell">
						<?php echo $rowUserData['address']; ?>
					</td>
				</tr>
				
				<tr>
					<td colspan=2><hr></td>
				</tr>
				
				<tr>
					<td class="user-cell"><b>Telephone:</b></td>
					<td class="user-cell">
						<?php echo $rowUserData['telephone']; ?>
					</td>
				</tr>
				
				<tr>
					<td colspan=2><hr></td>
				</tr>
				
				<tr>
					<td class="user-cell"><b>Date of Birth:</b></td>
					<td class="user-cell">
						<?php echo $rowUserData['dob']; ?>
					</td>
				</tr>
				
				<tr>
					<td colspan=2><hr></td>
				</tr>
				
				<tr>
					<td class="user-cell"><b>NIC:</b></td>
					<td class="user-cell">
						<?php echo $rowUserData['driver_nic']; ?>
					</td>
				</tr>
				
				<tr>
					<td colspan=2><hr></td>
				</tr>
				
				<tr>
					<td class="user-cell"><b>License No:</b></td>
					<td class="user-cell">
						<?php echo $rowUserData['license_no']; ?>
					</td>
				</tr>
				
				<tr>
					<td colspan=2><hr></td>
				</tr>
				
				<tr>
					<td class="user-cell"><b>Vehicle Type:</b></td>
					<td class="user-cell">
						<?php echo $rowUserData['vehicle_type']; ?>
					</td>
				</tr>
				
				<tr>
					<td colspan=2><hr></td>
				</tr>
				
				<tr>
					<td class="user-cell"><b>E-mail:</b></td>
					<td class="user-cell">
						<?php echo $rowUserData['email']; ?>
					</td>
				</tr>
		
			</table>
		</div>
		
		
		<!--****************************************************************User Reports*****************************************************************-->
		
		<div style="width: 55%; margin-left: 100px;">
			<table class="view-table" border=0>
<?php
				$selectHistoryqry = "SELECT * FROM accident WHERE accident_id IN (SELECT accident_id FROM vehicle_accident WHERE registration_no = '$username')";
				$resultHistory = mysqli_query($connection, $selectHistoryqry);
				
				

				if(mysqli_num_rows($resultHistory)>0)
				{
					while($rowHistory = mysqli_fetch_assoc($resultHistory))
					{
						$acc_id = $rowHistory['accident_id'];
						
						$selectHistoryImageqry = "SELECT photo FROM accident_photo WHERE accident_id = $acc_id LIMIT 1";
						$resultHistoryImg = mysqli_query($connection, $selectHistoryImageqry);
						
						$rowHistoryImg = mysqli_fetch_assoc($resultHistoryImg);
?>						
						<tr class="view-row">
							<td class="view-cell">																						<!--topic-->
								<font style="font-size: 15px; font-family: Helvetica, sans-serif;">
									<b>Topic:</b> <?php echo $rowHistory["topic"]; ?>
								</font>
							</td>
							
							<td class="view-cell" rowspan=6 align="right">																<!--image-->
								<img src="<?php echo $rowHistoryImg['photo'] ?>" class="hover-shadow cursor" style="height: 230px; width: 230px; margin-right: 0px;">
							</td>
							
							<td class="view-cell" style="background-color: #173457; padding-left: 20px;" rowspan=6>	
							
								<form method="POST" action="updateaccident.php">
								
									<input type="hidden" name="acc_id" value="<?php echo $acc_id; ?>">														<!--update / delete-->
								
									<button type="submit" name="update" class="edit-buttons"><img src="images/edit.png" class="edit-icons"></button><br><br>			<!--update-->
								</form>
								
								<form method="POST" action="useraccount.php">
									<input type="hidden" name="acc_id" value="<?php echo $acc_id; ?>">	
									
									<button type="submit" name="delete" class="edit-buttons"><img src="images/delete.png" class="edit-icons"></button>					<!--delete-->
									
								</form>
							</td>
							
						</tr>
						
						<tr class="view-row">
							<td class="view-cell">																						<!--caategory-->
								<font style="font-size: 15px; font-family: Helvetica, sans-serif;">
									<b>Category:</b> <?php echo $rowHistory["category"]; ?>
								</font>
							</td>
						</tr>
						
						<tr class="view-row">
							<td class="view-cell">																						<!--description-->
								<font style="font-size: 15px; font-family: Helvetica, sans-serif;">
									<b>Description:</b> <?php echo $rowHistory["description"]; ?>
								</font>
							</td>
						</tr>
						
						<tr class="view-row">
							<td class="view-cell">																						<!--location-->
								<font style="font-size: 15px; font-family: Helvetica, sans-serif;">
									<b>Location:</b> <?php echo $rowHistory["location"]; ?>
								</font>
							</td>
						</tr>
						
						<tr class="view-row">
							<td class="view-cell">																						<!--date-->
								<font style="font-size: 15px; font-family: Helvetica, sans-serif;">
									<b>Date:</b> <?php echo $rowHistory["date"]; ?>
								</font>
							</td>
						</tr>
						
						<tr class="view-row">
							<td class="view-cell">																						<!--time-->
								<font style="font-size: 15px; font-family: Helvetica, sans-serif;">
									<b>Time:</b> <?php echo $rowHistory["time"]; ?>
								</font>
							</td>
						</tr>
						
						<tr class="view-row" style="border-bottom: 10px solid #173457;">
							<td></td>
							<td></td>
						</tr>
<?php
					}
				}
?>
			
			</table>
			
		</div>
		
	</div>
	
</body>  
</html>  
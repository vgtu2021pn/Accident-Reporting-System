<?php  
 //entry.php  
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
<html lang="en">  
<head>
	<meta charset="utf-8">
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
				<li class="active"><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo htmlentities($_SESSION["username"], ENT_QUOTES, 'UTF-8'); ?> </a></li>
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Log Out</a></li>
			</ul>
		</div>
	</nav>
	
<?php

	/****************************************************************Delete**********************************************************************/

	if(isset($_POST['delete']))
	{
		$acc_id = (int)$_POST['acc_id'];
		$username = $_SESSION["username"];
		
		/*delete vehicle_accident*/
		$delete_Vehicle_Accident_qry = "DELETE FROM vehicle_accident WHERE accident_id = ? AND registration_no = ?";
		
		$stmt = mysqli_prepare($connection, $delete_Vehicle_Accident_qry);
		mysqli_stmt_bind_param($stmt,'is', $acc_id, $username);
		mysqli_stmt_execute($stmt);
		
		$sel_Vehicle_Accident_qry = "SELECT accident_id FROM vehicle_accident WHERE accident_id = ? AND registration_no = ?";
		
		$stmtt = mysqli_prepare($connection, $sel_Vehicle_Accident_qry);
		mysqli_stmt_bind_param($stmtt,'is', $acc_id, $username);
		mysqli_stmt_execute($stmtt);
		
		$result_sel_Vehicle_Accident = mysqli_stmt_get_result($stmtt);
		
		if(mysqli_num_rows($result_sel_Vehicle_Accident) == 0)
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
									reg_no = ?";
			
			$stmt = mysqli_prepare($connection, $selectUserDataqry);
			mysqli_stmt_bind_param($stmt,'s', $username);
			mysqli_stmt_execute($stmt);
			$resultUserData = mysqli_stmt_get_result($stmt);
			
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
						<h1>Welcome - <?php echo htmlentities($username, ENT_QUOTES, 'UTF-8'); ?></h1>
					</td>
				</tr>
				
				<tr>
					<td class="user-cell"style="width: 50%"><b>Name:</b></td>
					<td class="user-cell">
						<?php echo htmlentities($rowUserData['fullname'], ENT_QUOTES, 'UTF-8'); ?>
					</td>
				</tr>
				
				<tr>
					<td colspan=2><hr></td>
				</tr>
				
				<tr>
					<td class="user-cell"><b>Address:</b></td>
					<td class="user-cell">
						<?php echo htmlentities($rowUserData['address'], ENT_QUOTES, 'UTF-8'); ?>
					</td>
				</tr>
				
				<tr>
					<td colspan=2><hr></td>
				</tr>
				
				<tr>
					<td class="user-cell"><b>Telephone:</b></td>
					<td class="user-cell">
						<?php echo htmlentities($rowUserData['telephone'], ENT_QUOTES, 'UTF-8'); ?>
					</td>
				</tr>
				
				<tr>
					<td colspan=2><hr></td>
				</tr>
				
				<tr>
					<td class="user-cell"><b>Date of Birth:</b></td>
					<td class="user-cell">
						<?php echo htmlentities($rowUserData['dob'], ENT_QUOTES, 'UTF-8'); ?>
					</td>
				</tr>
				
				<tr>
					<td colspan=2><hr></td>
				</tr>
				
				<tr>
					<td class="user-cell"><b>NIC:</b></td>
					<td class="user-cell">
						<?php echo htmlentities($rowUserData['driver_nic'], ENT_QUOTES, 'UTF-8'); ?>
					</td>
				</tr>
				
				<tr>
					<td colspan=2><hr></td>
				</tr>
				
				<tr>
					<td class="user-cell"><b>License No:</b></td>
					<td class="user-cell">
						<?php echo htmlentities($rowUserData['license_no'], ENT_QUOTES, 'UTF-8'); ?>
					</td>
				</tr>
				
				<tr>
					<td colspan=2><hr></td>
				</tr>
				
				<tr>
					<td class="user-cell"><b>Vehicle Type:</b></td>
					<td class="user-cell">
						<?php echo htmlentities($rowUserData['vehicle_type'], ENT_QUOTES, 'UTF-8'); ?>
					</td>
				</tr>
				
				<tr>
					<td colspan=2><hr></td>
				</tr>
				
				<tr>
					<td class="user-cell"><b>E-mail:</b></td>
					<td class="user-cell">
						<?php echo htmlentities($rowUserData['email'], ENT_QUOTES, 'UTF-8'); ?>
					</td>
				</tr>
		
			</table>
		</div>
		
		
		<!--****************************************************************User Reports*****************************************************************-->
		
		<div style="width: 55%; margin-left: 100px;">
			<table class="view-table" border=0>
<?php
				$selectHistoryqry = "SELECT * FROM accident WHERE accident_id IN (SELECT accident_id FROM vehicle_accident WHERE registration_no = ?)";
				
				$stmth = mysqli_prepare($connection, $selectHistoryqry);
				mysqli_stmt_bind_param($stmth,'s', $username);
				mysqli_stmt_execute($stmth);
				
				$resultHistory = mysqli_stmt_get_result($stmth);
				
				if(mysqli_num_rows($resultHistory)>0)
				{
					while($rowHistory = mysqli_fetch_assoc($resultHistory))
					{
						$acc_id = (int)$rowHistory['accident_id'];
						
						$selectHistoryImageqry = "SELECT photo FROM accident_photo WHERE accident_id = ? LIMIT 1";
						
						$stmtf = mysqli_prepare($connection, $selectHistoryImageqry);
						mysqli_stmt_bind_param($stmtf,'i', $acc_id);
						mysqli_stmt_execute($stmtf);
						
						$resultHistoryImg = mysqli_stmt_get_result($stmtf);
						$rowHistoryImg = mysqli_fetch_assoc($resultHistoryImg);
?>						
						<tr class="view-row">
							<td class="view-cell">																						<!--topic-->
								<font style="font-size: 15px; font-family: Helvetica, sans-serif;">
									<b>Topic:</b> <?php echo htmlentities($rowHistory["topic"], ENT_QUOTES, 'UTF-8'); ?>
								</font>
							</td>
							
							<td class="view-cell" rowspan=6 align="right">																<!--image-->
								<img src="<?php if(file_exists(__DIR__ . '/' . $rowHistoryImg['photo'])){ echo htmlentities($rowHistoryImg['photo'], ENT_QUOTES, 'UTF-8'); }else{ echo 'upload' . htmlentities(substr($rowHistoryImg['photo'],6), ENT_QUOTES, 'UTF-8'); } ?>" class="hover-shadow cursor" style="height: 230px; width: 230px; margin-right: 0px;" alt="<?php if(file_exists(__DIR__ . '/' . $rowHistoryImg['photo'])){ echo "Accident is verified by Insurance Company, RDA and Police."; }else{ echo "Accident is not verified."; } ?>">
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
							<td class="view-cell">																						<!--category-->
								<font style="font-size: 15px; font-family: Helvetica, sans-serif;">
									<b>Category:</b> <?php echo htmlentities($rowHistory["category"], ENT_QUOTES, 'UTF-8'); ?>
								</font>
							</td>
						</tr>
						
						<tr class="view-row">
							<td class="view-cell">																						<!--description-->
								<font style="font-size: 15px; font-family: Helvetica, sans-serif;">
									<b>Description:</b> <?php echo htmlentities($rowHistory["description"], ENT_QUOTES, 'UTF-8'); ?>
								</font>
							</td>
						</tr>
						
						<tr class="view-row">
							<td class="view-cell">																						<!--location-->
								<font style="font-size: 15px; font-family: Helvetica, sans-serif;">
									<b>Location:</b> <?php echo htmlentities($rowHistory["location"], ENT_QUOTES, 'UTF-8'); ?>
								</font>
							</td>
						</tr>
						
						<tr class="view-row">
							<td class="view-cell">																						<!--date-->
								<font style="font-size: 15px; font-family: Helvetica, sans-serif;">
									<b>Date:</b> <?php echo htmlentities($rowHistory["date"], ENT_QUOTES, 'UTF-8'); ?>
								</font>
							</td>
						</tr>
						
						<tr class="view-row">
							<td class="view-cell">																						<!--time-->
								<font style="font-size: 15px; font-family: Helvetica, sans-serif;">
									<b>Time:</b> <?php echo htmlentities($rowHistory["time"], ENT_QUOTES, 'UTF-8'); ?>
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

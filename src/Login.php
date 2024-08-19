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
						echo "Connected successfully";
					}
					
					session_start(); 
					if(isset($_SESSION["username"]))  
                    {  
                        header("location:useraccount.php");  
                    } 
					
					if(isset($_POST['btnLogin']))
					{
						
					   $regType = $_POST['regType'];
					   $usernameLogin = $_POST['usernameLogin'];
					   $passwordLogin = $_POST['passwordLogin'];
					   
					   if($regType=="" || $usernameLogin=="" || $passwordLogin=="" )
						{
?>
                            <script> alert("Please Enter required Fields"); </script>
<?php	
                        }
					
					   
					
					   
						   if($regType=="Driver")
					       {
						    $selectqry = "SELECT * FROM vehicle WHERE reg_no=?";
						    $stmt = mysqli_prepare($connection, $selectqry);
						    mysqli_stmt_bind_param($stmt,'s', $usernameLogin);
						    mysqli_stmt_execute($stmt);
						    $result = mysqli_stmt_get_result($stmt);
						    
						    if(mysqli_num_rows($result) > 0)  
                                {  
                                    while($row = mysqli_fetch_array($result))  
                                        {  
                                            if(password_verify($passwordLogin, $row["password"]))  
                                            {  
                                                //return true;  
                                                $_SESSION["username"] = $usernameLogin;  
                                                header("location:useraccount.php");  
						                        echo '<script> alert("Login") </script>';
                                            }  
                                            else  
                                            {  
                                                //return false;  
                                                echo '<script>alert("Wrong User Details 1")</script>';  
                                            }  
                                        }  
                                }  
                                else  
                                {  
                                    echo '<script>alert("Wrong User Details 2")</script>';  
                                }  
					       } 
					
					       elseif($regType=="RDA Staff")
					       {
						    $selectqry = "SELECT * FROM rda_staff WHERE staff_id=?";
						    $stmt = mysqli_prepare($connection, $selectqry);
						    mysqli_stmt_bind_param($stmt,'s', $usernameLogin);
						    mysqli_stmt_execute($stmt);
						    $result = mysqli_stmt_get_result($stmt);
						    
						    if(mysqli_num_rows($result) > 0)  
                                {
                                    while($row = mysqli_fetch_array($result))  
                                        {  
                                            if(password_verify($passwordLogin, $row["password"]))  
                                            {  
                                                //return true;  
                                                $_SESSION["username"] = $usernameLogin;  
                                                header("location:AccList.php");  
						                        echo '<script> alert("Login") </script>';
                                            }  
                                            else  
                                            {  
                                                //return false;  
                                                echo '<script>alert("Wrong User Details 1")</script>';  
                                            }  
                                        }  
                                }  
                                else  
                                {  
                                    echo '<script>alert("Wrong User Details 2")</script>';  
                                }  
					       }
					
					       elseif($regType=="Police Staff")
					       {
						    $selectqry = "SELECT * FROM police_staff WHERE police_staff_id=?";
						    $stmt = mysqli_prepare($connection, $selectqry);
						    mysqli_stmt_bind_param($stmt,'s', $usernameLogin);
						    mysqli_stmt_execute($stmt);
						    $result = mysqli_stmt_get_result($stmt);
						    
						    if(mysqli_num_rows($result) > 0)  
                                {  
                                    while($row = mysqli_fetch_array($result))  
                                        {  
                                            if(password_verify($passwordLogin, $row["password"]))  
                                            {  
                                                //return true;  
                                                $_SESSION["username"] = $usernameLogin;  
                                                header("location:AccList.php");  
						                        echo '<script> alert("Login") </script>';
                                            }  
                                            else  
                                            {  
                                                //return false;  
                                                echo '<script>alert("Wrong User Details 1")</script>';  
                                            }  
                                        }  
                                }  
                                else  
                                {  
                                    echo '<script>alert("Wrong User Details 2")</script>';  
                                }  
								
					       }
					
					       else
					       {
						        $selectqry = "SELECT * FROM insurance_company WHERE company_id=?";
							$stmt = mysqli_prepare($connection, $selectqry);
							mysqli_stmt_bind_param($stmt,'s', $usernameLogin);
							mysqli_stmt_execute($stmt);
							$result = mysqli_stmt_get_result($stmt);
							
							if(mysqli_num_rows($result) > 0)  
                                {
                                    while($row = mysqli_fetch_array($result))  
                                        {  
                                            if(password_verify($passwordLogin, $row["password"]))  
                                            {  
                                                //return true;  
                                                $_SESSION["username"] = $usernameLogin;  
                                                header("location:AccList.php");  
						                        echo '<script> alert("Login") </script>';
                                            }  
                                            else  
                                            {  
                                                //return false;  
                                                echo '<script>alert("Wrong User Details 1")</script>';  
                                            }  
                                        }  
                                }  
                                else  
                                {  
                                    echo '<script>alert("Wrong User Details 2")</script>';  
                                }  
					       }
					   
					/*
					$resultrow = mysqli_fetch_array($result);
				
				
				    if($resultrow!=$passwordLogin)
						echo "Incorrect Password";
                    */

                    } 

					
					
                                                                         
					if(isset($_POST['btnSignUpDriver']))                //Driver SignUp 
					{
						$fnameDriver = $_POST['fnameDriver'];
						$lnameDriver = $_POST['lnameDriver'];
						$regno = $_POST['regno'];
						$addressDriver = $_POST['addressDriver'];
						$nicDriver = $_POST['nicDriver'];
						$pwDriver = $_POST['pwDriver'];
						$reppwDriver = $_POST['reppwDriver'];
						$hashedpwDriver = password_hash($pwDriver,PASSWORD_DEFAULT);
						$dobDriver = $_POST['dobDriver'];
						$mailDriver = $_POST['mailDriver'];
						$telDriver = $_POST['telDriver'];
						$licenceno = $_POST['licenceno'];
						$vehicalType = $_POST['vehicalType'];echo $fnameDriver;
						
						if($fnameDriver=="" || $lnameDriver=="" || $regno=="" || $addressDriver=="" || $nicDriver=="" || $pwDriver=="" || $dobDriver=="" || $mailDriver=="" || $telDriver=="" || $licenceno=="" || $vehicalType=="" || $reppwDriver=="")
                        {
?>						
                            <script> alert("Please Enter required Fields"); </script>
<?php	
                        }
						elseif($pwDriver!=$reppwDriver)
						{
?>						
                            <script> alert("Password Fields are not matched"); </script>
<?php						
						}
						else if(!is_numeric($telDriver))
{
?>						
                            <script> alert("Incorrect Phone Number Format"); </script>
<?php						
						}							
                        else
                        {
						    $insertvehicle = "INSERT INTO vehicle (reg_no,password,first_name,last_name,address,telephone,dob,driver_nic,license_no,email,vehicle_type) 
						                 VALUES (?,?,?,?,?,?,?,?,?,?,?)";
						    
						    $insertprepare = mysqli_prepare($connection, $insertvehicle);
						    mysqli_stmt_bind_param($insertprepare, 'sssssssisss', $regno, $hashedpwDriver, $fnameDriver, $lnameDriver, $addressDriver, $telDriver, $dobDriver, $nicDriver, $licenceno, $mailDriver, $vehicalType);
						    mysqli_stmt_execute($insertprepare);
						    
						    $selectqry = "SELECT * FROM vehicle WHERE reg_no=?";
						    $stmt = mysqli_prepare($connection, $selectqry);
						    mysqli_stmt_bind_param($stmt,'s', $regno);
						    mysqli_stmt_execute($stmt);
						    $result = mysqli_stmt_get_result($stmt);
						    
			    if(mysqli_num_rows($result) > 0)
			    			    {
							    echo '<script> alert("Registration Successfully") </script>';
						    }
						}
					}
					                                                          
					if(isset($_POST['btnSignUpRDA']))                       //RDA Staff SignUP
					{
						$fnameRDA = $_POST['fnameRDA'];
						$lnameRDA = $_POST['lnameRDA'];
						$staffnoRDA = $_POST['staffnoRDA'];
						$nicRDA = $_POST['nicRDA'];
						$pwRDA = $_POST['pwRDA'];
						$hashedpwRDA = password_hash($pwRDA,PASSWORD_DEFAULT);
						$reppwRDA = $_POST['reppwRDA'];
						
						if($fnameRDA=="" || $lnameRDA=="" || $staffnoRDA=="" || $nicRDA=="" || $pwRDA=="" || $reppwRDA=="")
						{
?>
                            <script> alert("Please Enter required Fields"); </script>
<?php	
                        }
						elseif($pwRDA!=$reppwRDA)
						{
?>						
                            <script> alert("Password Fields are not matched"); </script>
<?php						    
						}
                        else
                        {
						    $insertrda_staff = "INSERT INTO rda_staff (staff_id,s_fname,s_lname,s_nic,password) 
						                 VALUES (?,?,?,?,?)";
						    
						    $insertprepare = mysqli_prepare($connection, $insertrda_staff);
						    mysqli_stmt_bind_param($insertprepare, 'sssis', $staffnoRDA, $fnameRDA, $lnameRDA, $nicRDA, $hashedpwRDA);
						    mysqli_stmt_execute($insertprepare);
						    
						    $selectqry = "SELECT * FROM rda_staff WHERE staff_id=?";
						    $stmt = mysqli_prepare($connection, $selectqry);
						    mysqli_stmt_bind_param($stmt,'s', $staffnoRDA);
						    mysqli_stmt_execute($stmt);
						    $result = mysqli_stmt_get_result($stmt);
						    
						    if(mysqli_num_rows($result) > 0)
			    			    {
							    echo '<script> alert("Registration Successfully") </script>';
						    }
						}
					}
					                                                         
					if(isset($_POST['btnSignUpPolice']))                    //Police Staff SignUp
					{
						$fnamePolice = $_POST['fnamePolice'];
						$lnamePolice = $_POST['lnamePolice'];
						$staffnoPolice = $_POST['staffnoPolice'];
						$nicPolice = $_POST['nicPolice'];
						$divisionPolice = $_POST['divisionPolice'];
						$pwPolice = $_POST['pwPolice'];
						$hashedpwPolice = password_hash($pwPolice,PASSWORD_DEFAULT);
						$reppwPolice = $_POST['reppwPolice'];
						
						if($fnamePolice=="" || $lnamePolice=="" || $staffnoPolice=="" || $nicPolice=="" || $divisionPolice=="" || $pwPolice=="" || $reppwPolice=="")
						{
?>
                            <script> alert("Please Enter required Fields"); </script>
<?php	
                        }
                        elseif($pwPolice!=$reppwPolice)
						{
?>						
                            <script> alert("Password Fields are not matched"); </script>
<?php						    
						}
                        else 
                        {							
						    $insertpolice_staff = "INSERT INTO police_staff (police_staff_id,police_fname,police_lname,police_nic,division,password) 
						                 VALUES (?,?,?,?,?,?)";
						    
						    $insertprepare = mysqli_prepare($connection, $insertpolice_staff);
						    mysqli_stmt_bind_param($insertprepare, 'sssiss', $staffnoPolice, $fnamePolice, $lnamePolice, $nicPolice, $divisionPolice, $hashedpwPolice);
						    mysqli_stmt_execute($insertprepare);
						    
						    $selectqry = "SELECT * FROM police_staff WHERE police_staff_id=?";
						    $stmt = mysqli_prepare($connection, $selectqry);
						    mysqli_stmt_bind_param($stmt,'s', $staffnoPolice);
						    mysqli_stmt_execute($stmt);
						    $result = mysqli_stmt_get_result($stmt);
						    
						    if(mysqli_num_rows($result) > 0)
			    			    {
							    echo '<script> alert("Registration Successfully") </script>';
						    }
						}
					}
				                                                             	
					if(isset($_POST['btnSignUpCompany']))                    //Insurance Company SignUp
					{
						$nameCompany = $_POST['nameCompany'];
						$regnoCompany = $_POST['regnoCompany'];
						$locationCompany = $_POST['locationCompany'];
						$pwCompany = $_POST['pwCompany'];
						$hashedpwCompany = password_hash($pwCompany,PASSWORD_DEFAULT);
						$reppwCompany = $_POST['reppwCompany'];
						
						if($nameCompany=="" || $regnoCompany=="" || $locationCompany=="" || $pwCompany=="" || $reppwCompany=="")
						{
?>
                            <script> alert("Please Enter required Fields"); </script>
<?php	
                        }
                        elseif($pwCompany!=$reppwCompany)
						{
?>						
                            <script> alert("Password Fields are not matched"); </script>
<?php						    
						}
                        else 
                        {	
						
						    $insertinsurance_company = "INSERT INTO insurance_company (company_id,company_name,location,password) 
						                 VALUES (?,?,?,?)";
						    
						    $insertprepare = mysqli_prepare($connection, $insertinsurance_company);
						    mysqli_stmt_bind_param($insertprepare, 'isss', $regnoCompany, $nameCompany, $locationCompany, $hashedpwCompany);
						    mysqli_stmt_execute($insertprepare);
						    
						    $selectqry = "SELECT * FROM insurance_company WHERE company_id=?";
						    $stmt = mysqli_prepare($connection, $selectqry);
						    mysqli_stmt_bind_param($stmt,'i', $regnoCompany);
						    mysqli_stmt_execute($stmt);
						    $result = mysqli_stmt_get_result($stmt);
						    
						    if(mysqli_num_rows($result) > 0)
			    			    {
							    echo '<script> alert("Registration Successfully") </script>';
						    }
						}
					}
?>
<!DOCTYPE html>  
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login</title>
		   
	<link rel="icon" href="images/car.png" type="image/gif">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

<style>
@import url("https://fonts.googleapis.com/css?family=Lato");


/* Main Tabs */
label{
 background-color: #173457;
 color: white;
 display: inline-block;
 cursor: pointer;
 padding: 10px;
 font-size: 20px;
 border-color: black;
 border-style: solid;
 border-width: 0.5px;
 width:455px;
 opacity:0.95;
 border-radius: 10px;
}

label:hover {
 background-color: #02404b;
}

label input:checked {
 background-color: red;
}

.tab-radio {
 display: none;
}

/* Tabs behaviour, hidden if not checked/clicked */
.sub-tab-content,
.tab-content {
 display: none;
}

.tab-radio:checked + .tab-content,
.tab-radio:checked + .sub-tab-content {
 display: block;
}

/* Sub-tabs */
.sub-tabs-container label {
 background-color: #1f4147;
 color: white;
}

.sub-tabs-container label:hover {
 background-color: #50bcbf;
 color:black;
}

/* Tabs Content */
.tab-content {
 padding: 30px;
 background-color: #173457;
 border-radius: 10px;
  border-color: black;
 border-style: solid;
 border-width: 0.5px;
 box-shadow: 2px 10px 6px -3px rgba(0, 0, 0, 0.5);
 width:60%;
 height:80%;
 opacity:0.95;
 align:center;
}

/* General */

body {
 width: 90%;
 margin: 10px auto;
 background-image:url("images/bg2.jpg");
 background-repeat: no-repeat;
 background-size: cover;
 font-family: Lato, sans-serif;
 letter-spacing: 1px;
}

*, *:hover {
 transition: all .3s;
}

.button {
 background-color: #6786ab;
 color: black;
 padding: 12px 20px;
 border: none;
 border-radius: 4px;
 cursor: pointer;
 
}

.form-control{
width:100%;
}

td{
	padding: 10px;
}

</style>
</head>

<body>
<section>
<center>
<div>
<div class="top-tabs-container">
  <label for="main-tab-1">Login</label>
  <label for="main-tab-2">Sign Up</label>
</div>

<!-- Tab Container -->
<form name="loginSignupForm" id="loginSignupForm" action="" method="post">
<input class="tab-radio" id="main-tab-1" name="main-group" type="radio" checked="checked">

<div class="tab-content" style="margin-left:0%;">
 
    <table style="padding:500px;">
        <tr style="">
            <div class="" style="width:500px;">  
			    <td>
				    <select name="regType" id="selRegType" class="form-control">
                        <option value="">--Select Registration Type--</option>
                        <option value="Driver">Driver</option>
                        <option value="RDA Staff">RDA Staff</option>
                        <option value="Police Staff">Police Staff</option>
                        <option value="Insurance Company">Insurance Company</option>
                    </select>
				</td>
            </div>
        </tr>
        <tr>
            <div class="col" style="">
                <td>
				    <input name="usernameLogin" id="txtRegNo" type="text" class="form-control" placeholder="Enter your vehicle registration no.">
				</td>
            </div>
        </tr>
		<tr>
            <div class="" style="width:500px;margin-top:20px;">
                <td>
				    <input name="passwordLogin" id="txtPassword" type="password" class="form-control" data-type="password" placeholder="Enter your password" autocomplete="off">
			    </td>
            </div>
        </tr>
        <tr>
            <td>
                <div class="" style="width:500px; margin:20px;">
                    <input name="btnLogin" type="submit" class="button" value="Sign In" style="color:white; font-weight:bold;" id="btnSignin" onclick="JavaScript:return validateLoginForm();" > <br>
                </div>
                <div class="hr">
				</div>
                <div class="foot"> 
				    <a href="#">Forgot Password?</a>
				</div>
            </td>
        </tr>
    </table>
</div>

<!-- Tab Container -->

<input class="tab-radio" id="main-tab-2" name="main-group" type="radio">

<div class="tab-content">

  <div class="sub-tabs-container">
  <!-- NOTE: due to id note below, remember to match the for.
  The actual title doesn't matter, just to show it works... -->
    <label for="sub-tab2-1" style="width:150px;font-size:12.5px;height:40px;font-weight:bold;">Driver</label>
    <label for="sub-tab2-2" style="width:150px;font-size:12.5px;height:40px;font-weight:bold;">RDA Staff </label>
	<label for="sub-tab2-3" style="width:150px;font-size:12.5px;height:40px;font-weight:bold;">Police Staff</label>
    <label for="sub-tab2-4" style="width:150px;font-size:12.5px;height:40px;font-weight:bold;">Insurance Company</label>
  </div>
  
  <!-- Sub Tab -->
  <!-- NOTE: name="sub-group" will require to be unique to the tab, 
        ie: tab2 = sub-group2, tab3 = sub-group 3 etc. -->
  <!-- NOTE: id have to be unique. So for each sub tabs, the input id will have to change-->
  
  <!--Driver-->
  <input class="tab-radio" id="sub-tab2-1" name="sub-group2" type="radio" checked="checked">
  <div class="sub-tab-content">
        <table>
            <tr>
                <td class="sign-up-table">
                    <!--fname-->
                    <table>
                        <tr>
                            <td style="padding:0px; width:50%;">
                                <div class="">
                                    <input  name="fnameDriver" style="width:100%" id="txtFnameDriver" type="text" class="form-control" placeholder="First Name">
                                </div>
                            </td>
                            <td style="padding:0px 0px 0px 10px; width:50%;">
                                <div class="">
                                    <input name="lnameDriver" style="width:100%" id="txtLnameDriver" type="text" class="form-control" placeholder="Last Name">
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
                <td class="" style="width:50%;">
                    <!--reg no-->
                    <div class="">
                        <input name="regno" style="width:100%" id="txtRegNumberDriver" type="text" class="form-control" placeholder="Enter your Vehicle Registration No.">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="sign-up-table" style="width:50%;">
                    <!--address-->
                    <div class="">
                        <input name="addressDriver" id="txtAddressDriver" type="text" class="form-control" placeholder="Enter your Address">
                    </div>
                </td>
                <td class="sign-up-table">
                    <!--vehi type-->
					
					<select name="vehicalType" class="form-control" id="txtVehicleTypeDriver" placeholder="Enter your Vehicle Type">
						<option value="0">--Vehicle Type--</option>
						<option value="Car">Car</option>
						<option value="Van">Van</option>
						<option value="Motorbike">Motorbike</option>
						<option value="Truck">Truck</option>
						<option value="Bus">Bus</option>
					</select>
					
                </td>
            </tr>
            <tr>
                <td class="sign-up-table">
                    <!--nic-->
                    <div class="">
                        <input name="nicDriver" id="txtNICDriver" type="text" class="form-control" placeholder="Enter your NIC">
                    </div>
                </td>
                <td class="sign-up-table">
                    <!--pass-->
                    <div class="">
                        <input name="pwDriver" id="txtSignUpPasswordDriver" type="password" class="form-control" data-type="password" placeholder="Create your password" autocomplete="off">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="sign-up-table">
                    <!--dob-->
                        <input name="dobDriver" type="text" id="txtDOBDriver" class="form-control" style="width:100%" placeholder="Enter your Date of Birth" value="">
                </td>
                <td class="sign-up-table">
                    <!--rep pass-->
                    <div class="">
                        <input name="reppwDriver" id="txtSignUpRepPassDriver" type="password" class="form-control" data-type="password" placeholder="Repeat your password" autocomplete="off">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="sign-up-table">
                    <!--mail-->
                        <div class="">
                            <input name="mailDriver" id="txtEmailDriver" type="email" class="form-control" placeholder="Enter your e-mail">
                        </div>
                </td>
                <td class="sign-up-table">
                    <!--tel-->
                    <div class="">
                        <input name="telDriver" id="txtContactDriver" type="tel" class="form-control" placeholder="Enter your Contact Number">
                    </div>
                </td>
            </tr>
			<tr>
                <td class="sign-up-table">
                    <!--licenceno-->
                        <div class="">
                            <input name="licenceno" id="txtLicenseDriver" type="text" class="form-control" placeholder="Enter your licence no">
                        </div>
                </td>
				<td> </td>
            </tr>
            <tr>
                <td colspan="2" class="sign-up-table">
                    <div class="" style="margin:20px;">
                        <input name="btnSignUpDriver" type="submit" class="button" value="Sign Up" style="color:white; font-weight:bold;" id="btnSignUpDriver" onclick="JavaScript:return validateSignupDriverForm();">
                    </div>
                    <div class="hr">
					</div>
                    <div class="foot">
                        <label for="main-tab-1" style="font-size:16px;border:0px; width: 160px;">Already Member?</label>
                    </div>
                </td>
            </tr>    
        </table>
    </div>
  
  <!-- Sub Tab -->
  <!--RDA Staff-->
  <input class="tab-radio" id="sub-tab2-2" name="sub-group2" type="radio">
    <div class="sub-tab-content">
        <table>
            <tr>
                <td class="sign-up-table">
                    <!--fname-->
                        <table>
                            <tr>
                                <td style="padding:0px; width:50%;">
                                <div class="">
                                    <input name="fnameRDA" style="width:100%" id="txtFnameRDA" type="text" class="form-control" placeholder="First Name">
                                </div>
								</td>
								<td style="padding:0px 0px 0px 10px; width:50%;">
									<div class="">
										<input name="lnameRDA" style="width:100%;" id="txtLnameRDA" type="text" class="form-control" placeholder="Last Name">
									</div>
								</td>
                            </tr>
                        </table>
                </td>
                <td class="sign-up-table" style="width:50%;">
                    <!--staff no-->
                    <div class="">
                        <input name="staffnoRDA" style="width:100%" id="txtStaffNumberRDA" type="text" class="form-control" placeholder="Enter your Staff Registration No.">
                    </div>
                </td>
            </tr>
			<tr>
				<td class="sign-up-table">
					<!--nic-->
					<div class="">
						<input name="nicRDA" id="txtNIC" type="text" class="form-control" placeholder="Enter your NIC">
					</div>
				</td>
				
			<td class="sign-up-table">
                    <!--pass-->
                    <div class="">
                        <input name="pwRDA" id="txtSignUpPasswordRDA" type="password" class="form-control" data-type="password" placeholder="Create your password" autocomplete="off">
                    </div>
                </td>
            </tr>
			<tr>
			 <td class="sign-up-table">
                    <!--rep pass-->
                    <div class="">
                        <input name="reppwRDA" id="txtSignUpRepPassRDA" type="password" class="form-control" data-type="password" placeholder="Repeat your password" autocomplete="off">
                    </div>
                </td>
			</tr>
			<tr>
		     <td colspan="2" class="sign-up-table">
					<div class="group" style="margin:20px;">
						<input name="btnSignUpRDA" type="submit" class="button" value="Sign Up" style="color:white; font-weight:bold;" id="btnSignUpRDA" onclick="JavaScript:return validateSignupRDAForm();">
					</div>
					<div class="hr">
					</div>
					<div class="foot">
						<label for="main-tab-1" style="font-size:16px;border:0px; width: 160px;">Already Member?</label>
					</div>
				</td>
			</tr>    
		</table>
	</div>
  
  <!-- Sub Tab -->
  <!--Police Staff-->
  <input class="tab-radio" id="sub-tab2-3" name="sub-group2" type="radio">
  <div class="sub-tab-content">
    <table>
        <tr>
            <td class="sign-up-table">
                <!--fname-->
                <table>
                    <tr>
                        <td style="padding:0px; width:50%;">
                            <div class="">
                                <input name="fnamePolice" style="width:100%" id="txtFnamePolice" type="text" class="form-control" placeholder="First Name">
                            </div>
                        </td>
                        <td style="padding:0px 0px 0px 10px; width:50%;">
                            <div class="">
                                <input name="lnamePolice" style="width:100%" id="txtLnamePolice" type="text" class="form-control" placeholder="Last Name">
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
            <td class="sign-up-table" style="width:50%;">
                <!--staff no-->
                <div class="" >
                    <input name="staffnoPolice" style="width:100%" id="txtStaffNumberPolice" type="text" class="form-control" placeholder="Enter your Staff Registration No.">
                </div>
            </td>
        </tr>
        <tr>
            <td class="sign-up-table">
                <!--nic-->
                <div class="">
                    <input name="nicPolice" id="txtNICPolice" type="text" class="form-control" placeholder="Enter your NIC">
                </div>
            </td>
			<td class="sign-up-table">
                <!--division-->
                <div class="">
                    <input name="divisionPolice" id="txtDivisionPolice" type="text" class="form-control" placeholder="Enter your Division">
                </div>									
		    </td>
		</tr>
		<tr>
		<td class="sign-up-table">
                    <!--pass-->
                    <div class="">
                        <input name="pwPolice" id="txtSignUpPasswordPolice" type="password" class="form-control" data-type="password" placeholder="Create your password" autocomplete="off">
                    </div>
                </td>
            
			 <td class="sign-up-table">
                    <!--rep pass-->
                    <div class="">
                        <input name="reppwPolice" id="txtSignUpRepPassPolice" type="password" class="form-control" data-type="password" placeholder="Repeat your password" autocomplete="off">
                    </div>
                </td>
			</tr>
		<tr>
            <td colspan="2" class="sign-up-table">
                <div class="group" style="margin:20px;">
                    <input  name="btnSignUpPolice" type="submit" class="button" value="Sign Up" style="color:white; font-weight:bold;" id="btnSignUpPolice" onclick="JavaScript:return validateSignupPoliceForm();" />
                </div>
                <div class="hr"></div>
                <div class="foot">
                    <label for="main-tab-1" style="font-size:16px;border:0px; width: 160px;">Already Member?</label>
                </div>
            </td>
        </tr>    
    </table>
  </div>
  
  <!-- Sub Tab -->
  <!--Insurance Company-->
  <input class="tab-radio" id="sub-tab2-4" name="sub-group2" type="radio">
    <div class="sub-tab-content">
        <table  style="">
           <tr>
		<td class="sign-up-table" style="width:500px;">
                    <!--company name-->
                    <div class="">
                        <input  name="nameCompany" id="txtCompanyName" style="width:100%" type="text" class="form-control" data-type="text" placeholder="Enter Your Company Name">
                    </div>
                </td>
            
			 <td class="sign-up-table" style="width:500px;">
                    <!--reg no-->
                    <div class="">
                        <input name="regnoCompany" id="txtCompanyRegNo" style="width:100%" type="text" class="form-control" data-type="text" placeholder="Enter Your Registration No.">
                    </div>
                </td>
			</tr>
			<tr>
                <td class="sign-up-table">
					<!--location-->
					<div class="">
						<input  name="locationCompany" id="txtLocationCompany" type="text" class="form-control" placeholder="Enter your Location">
					</div>											
				</td>
				<td class="sign-up-table">
                    <!--pass-->
                    <div class="">
                        <input name="pwCompany" id="txtSignUpPasswordCompany" type="password" class="form-control" data-type="password" placeholder="Create your password" autocomplete="off">
                    </div>
                </td>
			</tr>
			<tr>
		        <td class="sign-up-table">
                    <!--rep pass-->
                    <div class="">
                        <input name="reppwCompany" id="txtSignUpRepPassCompany" type="password" class="form-control" data-type="password" placeholder="Repeat your password" autocomplete="off">
                    </div>
                </td>
				<td> </td>
			</tr>
			
			<tr>
				<td colspan="2" class="sign-up-table">
					<div class="group" style="margin:20px;">
						<input name="btnSignUpCompany" type="submit" class="button" value="Sign Up" style="color:white; font-weight:bold;" id="btnSignUpCompany" onclick="JavaScript:return validateSignupInsuranceCompanyForm();"/>
					</div>
					<div class="hr"></div>
					<div class="foot">
						<label for="main-tab-1" style="font-size:16px;border:0px; width: 160px;">Already Member?</label>
					</div>
				</td>
			</tr>    
		</table>
	</div>
</div>
</form>
</div>
</center>
<script type="text/javascript">
	function validateLoginForm() {
	    var succeed = true;
	    var reg_type_v = $( "#selRegType" ).val();
	    var reg_no = document.querySelector( "input[name='usernameLogin']" );
	    let reg_no_v = reg_no.value;
	    var pass = document.querySelector( "input[name='passwordLogin']" );
	    let pass_v = pass.value;
	    
	    let arr = ["Driver", "RDA Staff", "Police Staff", "Insurance Company"];
	    let lUnsafeCharacters = /[\W|_]/g;
	    
	    if (jQuery.inArray(reg_type_v, arr) == -1){
		alert('Wrong selection.');
		succeed = false;
	    }// end if
	    if (reg_no_v.length > 16 || pass_v.length > 254){
		alert('Too long.');
		succeed = false;
	    }// end if
	    if (reg_no_v.search(lUnsafeCharacters) > -1 || pass_v.search(lUnsafeCharacters) > -1){
		alert('Special characters are not allowed.');
		succeed = false;
	    }// end if
	    
	    if(succeed == true){
		document.getElementById('loginSignupForm').name='btnLogin';
		document.getElementById('loginSignupForm').action='';
		document.getElementById('loginSignupForm').submit();
		return(true);
	    }else{
		return(false);
	    }
	}
	
	function validateSignupDriverForm() {
	    var succeed = true;
	    var frt_name = document.querySelector( "input[name='fnameDriver']" );
	    let frt_name_v = frt_name.value;
	    var lst_name = document.querySelector( "input[name='lnameDriver']" );
	    let lst_name_v = lst_name.value;
	    var rgn_no = document.querySelector( "input[name='regno']" );
	    let rgn_no_v = rgn_no.value;
	    var ads = document.querySelector( "input[name='addressDriver']" );
	    let ads_v = ads.value;
	    var nic = document.querySelector( "input[name='nicDriver']" );
	    let nic_v = nic.value;
	    var pwd = document.querySelector( "input[name='pwDriver']" );
	    let pwd_v = pwd.value;
	    var rtpwd = document.querySelector( "input[name='reppwDriver']" );
	    let rtpwd_v = rtpwd.value;
	    var dofh = document.querySelector( "input[name='dobDriver']" );
	    let dofh_v = dofh.value;
	    var e_ml = document.querySelector( "input[name='mailDriver']" );
	    let e_ml_v = e_ml.value;
	    var te = document.querySelector( "input[name='telDriver']" );
	    let te_v = te.value;
	    var le = document.querySelector( "input[name='licenceno']" );
	    let le_v = le.value;
	    var veh_typ_v = $( "#txtVehicleTypeDriver" ).val();
	    	    
	    let arr = ["Car", "Van", "Motorbike", "Truck", "Bus"];
	    let lUnsafeCharacters = /[\W|_]/g;
	    let ldate = /^\d{4}-\d{2}-\d{2}$/;
	    let lemail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-z\-0-9]+\.)+[a-z]{2,}))$/;
	    
	    if (jQuery.inArray(veh_typ_v, arr) == -1){
		alert('Wrong selection.');
		succeed = false;
	    }// end if
	    if (rgn_no_v.length < 1 || rgn_no_v.length > 11){
		alert('Incorrect registration number.');
		succeed = false;
	    }// end if
	    if (frt_name_v.length <= 2 || frt_name_v.length > 30){
		alert('Incorrect first name.');
		succeed = false;
	    }// end if
	    if (lst_name_v != '' && lst_name_v.length > 100){
		alert('Incorrect last name.');
		succeed = false;
	    }// end if
	    if (ads_v.length < 1 || ads_v.length > 255){
		alert('Incorrect address.');
		succeed = false;
	    }// end if
	    if (te_v.length < 1 || te_v.length > 13){
		alert('Incorrect telephone number.');
		succeed = false;
	    }// end if
	    if (nic_v.length != 11){
		alert('Incorrect NIC.');
		succeed = false;
	    }// end if
	    if (le_v.length < 2 || le_v.length > 7){
		alert('Incorrect license plate number.');
		succeed = false;
	    }// end if
	    if (!ldate.test(dofh_v)){
		alert('Incorrect date of birth (YYYY-MM-DD).');
		succeed = false;
	    }// end if
	    if (!lemail.test(e_ml_v)){
		alert('Incorrect e-mail (name@host.domain).');
		succeed = false;
	    }// end if
	    if (pwd_v.search(lUnsafeCharacters) > -1 || rgn_no_v.search(lUnsafeCharacters) > -1){
		alert('Special characters are not allowed.');
		succeed = false;
	    }// end if
	    
	    if(succeed == true){
		document.getElementById('loginSignupForm').name='btnSignUpDriver';
		document.getElementById('loginSignupForm').action='';
		document.getElementById('loginSignupForm').submit();
		return(true);
	    }else{
		return(false);
	    }
	}

	function validateSignupRDAForm() {
	    var succeed = true;
	    var frt_name = document.querySelector( "input[name='fnameRDA']" );
	    let frt_name_v = frt_name.value;
	    var lst_name = document.querySelector( "input[name='lnameRDA']" );
	    let lst_name_v = lst_name.value;
	    var stf_no = document.querySelector( "input[name='staffnoRDA']" );
	    let stf_no_v = stf_no.value;
	    var nic = document.querySelector( "input[name='nicRDA']" );
	    let nic_v = nic.value;
	    var pwd = document.querySelector( "input[name='pwRDA']" );
	    let pwd_v = pwd.value;
	    var rtpwd = document.querySelector( "input[name='reppwRDA']" );
	    let rtpwd_v = rtpwd.value;
	    
	    let lUnsafeCharacters = /[\W|_]/g;
	    
	    if (stf_no_v.length < 1 || stf_no_v.length > 20){
		alert('Incorrect registration number.');
		succeed = false;
	    }// end if
	    if (frt_name_v.length <= 2 || frt_name_v.length > 30){
		alert('Incorrect first name.');
		succeed = false;
	    }// end if
	    if (lst_name_v != '' && lst_name_v.length > 100){
		alert('Incorrect last name.');
		succeed = false;
	    }// end if
	    if (nic_v.length != 11){
		alert('Incorrect NIC.');
		succeed = false;
	    }// end if
	    if (pwd_v.search(lUnsafeCharacters) > -1 || stf_no_v.search(lUnsafeCharacters) > -1){
		alert('Special characters are not allowed.');
		succeed = false;
	    }// end if
	    if (pwd_v == '' || rtpwd_v == ''){
		alert('Password is not provided.');
		succeed = false;
	    }// end if
	    if (pwd_v != rtpwd_v){
		alert('Passwords does not match.');
		succeed = false;
	    }// end if
	    
	    if(succeed == true){
		document.getElementById('loginSignupForm').name='btnSignUpRDA';
		document.getElementById('loginSignupForm').action='';
		document.getElementById('loginSignupForm').submit();
		return(true);
	    }else{
		return(false);
	    }
	}

	function validateSignupPoliceForm() {
	    var succeed = true;
	    var frt_name = document.querySelector( "input[name='fnamePolice']" );
	    let frt_name_v = frt_name.value;
	    var lst_name = document.querySelector( "input[name='lnamePolice']" );
	    let lst_name_v = lst_name.value;
	    var stf_no = document.querySelector( "input[name='staffnoPolice']" );
	    let stf_no_v = stf_no.value;
	    var nic = document.querySelector( "input[name='nicPolice']" );
	    let nic_v = nic.value;
	    var dion = document.querySelector( "input[name='divisionPolice']" );
	    let dion_v = dion.value;
	    var pwd = document.querySelector( "input[name='pwPolice']" );
	    let pwd_v = pwd.value;
	    var rtpwd = document.querySelector( "input[name='reppwPolice']" );
	    let rtpwd_v = rtpwd.value;
	    
	    let lUnsafeCharacters = /[\W|_]/g;
	    
	    if (stf_no_v.length < 1 || stf_no_v.length > 20){
		alert('Incorrect registration number.');
		succeed = false;
	    }// end if
	    if (frt_name_v.length <= 2 || frt_name_v.length > 30){
		alert('Incorrect first name.');
		succeed = false;
	    }// end if
	    if (lst_name_v != '' && lst_name_v.length > 100){
		alert('Incorrect last name.');
		succeed = false;
	    }// end if
	    if (nic_v.length != 11){
		alert('Incorrect NIC.');
		succeed = false;
	    }// end if
	    if (dion_v.length <= 2 || dion_v.length > 40){
		alert('Incorrect division name.');
		succeed = false;
	    }// end if
	    if (pwd_v.search(lUnsafeCharacters) > -1 || stf_no_v.search(lUnsafeCharacters) > -1){
		alert('Special characters are not allowed.');
		succeed = false;
	    }// end if
	    if (pwd_v == '' || rtpwd_v == ''){
		alert('Password is not provided.');
		succeed = false;
	    }// end if
	    if (pwd_v != rtpwd_v){
		alert('Passwords does not match.');
		succeed = false;
	    }// end if
	    
	    if(succeed == true){
		document.getElementById('loginSignupForm').name='btnSignUpPolice';
		document.getElementById('loginSignupForm').action='';
		document.getElementById('loginSignupForm').submit();
		return(true);
	    }else{
		return(false);
	    }
	}
	
	function validateSignupInsuranceCompanyForm() {
	    var succeed = true;
	    var name = document.querySelector( "input[name='nameCompany']" );
	    let name_v = name.value;
	    var ln_cy = document.querySelector( "input[name='locationCompany']" );
	    let ln_cy_v = ln_cy.value;
	    var rn_no = document.querySelector( "input[name='regnoCompany']" );
	    let rn_no_v = rn_no.value;
	    var pwd = document.querySelector( "input[name='pwCompany']" );
	    let pwd_v = pwd.value;
	    var rtpwd = document.querySelector( "input[name='reppwCompany']" );
	    let rtpwd_v = rtpwd.value;
	    
	    let lUnsafeCharacters = /[\W|_]/g;
	    
	    if (rn_no_v.length < 1 || rn_no_v.length > 10){
		alert('Incorrect registration number.');
		succeed = false;
	    }// end if
	    if (name_v.length <= 1 || name_v.length > 160){
		alert('Name of your Company is incorrect.');
		succeed = false;
	    }// end if
	    if (ln_cy_v.length < 3 && ln_cy_v.length > 50){
		alert('Incorrect location.');
		succeed = false;
	    }// end if
	    if (pwd_v.search(lUnsafeCharacters) > -1 || rn_no_v.search(lUnsafeCharacters) > -1){
		alert('Special characters are not allowed.');
		succeed = false;
	    }// end if
	    if (pwd_v == '' || rtpwd_v == ''){
		alert('Password is not provided.');
		succeed = false;
	    }// end if
	    if (pwd_v != rtpwd_v){
		alert('Passwords does not match.');
		succeed = false;
	    }// end if
	    
	    if(succeed == true){
		document.getElementById('loginSignupForm').name='btnSignUpCompany';
		document.getElementById('loginSignupForm').action='';
		document.getElementById('loginSignupForm').submit();
		return(true);
	    }else{
		return(false);
	    }
	}

</script>
</body>
</html>

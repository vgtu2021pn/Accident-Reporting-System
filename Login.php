<?php
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
						echo "Connected successfully";
					}
					
					session_start(); 
					if(isset($_SESSION["username"]))  
                    {  
                        header("location:src/useraccount.php");  
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
						        $selectqry = "SELECT * From vehicle Where reg_no='$usernameLogin'";
					            $result=mysqli_query($connection,$selectqry);
								
								if(mysqli_num_rows($result) > 0)  
                                {  
                                    while($row = mysqli_fetch_array($result))  
                                        {  
                                            if(password_verify($passwordLogin, $row["passsword"]))  
                                            {  
                                                //return true;  
                                                $_SESSION["username"] = $usernameLogin;  
                                                header("location:src/useraccount.php");  
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
						        $selectqry = "SELECT * From rda_staff Where staff_id='$usernameLogin'";
					            $result=mysqli_query($connection,$selectqry);
								
								if(mysqli_num_rows($result) > 0)  
                                {  
                                    while($row = mysqli_fetch_array($result))  
                                        {  
                                            if(password_verify($passwordLogin, $row["passsword"]))  
                                            {  
                                                //return true;  
                                                $_SESSION["username"] = $usernameLogin;  
                                                header("location:src/AccList.php");  
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
						        $selectqry = "SELECT * From police_staff Where police_staff_id='$usernameLogin'";
					            $result=mysqli_query($connection,$selectqry);
								
								if(mysqli_num_rows($result) > 0)  
                                {  
                                    while($row = mysqli_fetch_array($result))  
                                        {  
                                            if(password_verify($passwordLogin, $row["password"]))  
                                            {  
                                                //return true;  
                                                $_SESSION["username"] = $usernameLogin;  
                                                header("location:src/AccList.php");  
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
						        $selectqry = "SELECT * From insurance_company Where company_id='$usernameLogin'";
					            $result=mysqli_query($connection,$selectqry);
								
								if(mysqli_num_rows($result) > 0)  
                                {  
                                    while($row = mysqli_fetch_array($result))  
                                        {  
                                            if(password_verify($passwordLogin, $row["password"]))  
                                            {  
                                                //return true;  
                                                $_SESSION["username"] = $usernameLogin;  
                                                header("location:src/AccList.php");  
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
						else if(strlen($telDriver)!=10 || !is_numeric($telDriver))
{
?>						
                            <script> alert("Incorrect Phone Number Format"); </script>
<?php						
						}							
                        else
                        {							
						    $insertvehicle = "INSERT INTO vehicle (reg_no,first_name,last_name,address,telephone,dob,driver_nic,license_no,email,vehicle_type,password) 
						                 VALUES ('$regno','$fnameDriver','$lnameDriver','$addressDriver','$telDriver','$dobDriver','$nicDriver','$licenceno','$mailDriver','$vehicalType','$hashedpwDriver')";
						    $resultvehicle = mysqli_query($connection,$insertvehicle);
                         
                            if($resultvehicle)
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
						                    VALUES ('$staffnoRDA','$fnameRDA','$lnameRDA','$nicRDA','$hashedpwRDA')";
						    $resultrda_staff = mysqli_query($connection,$insertrda_staff);
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
						                    VALUES ('$staffnoPolice','$fnamePolice','$lnamePolice','$nicPolice','$divisionPolice','$hashedpwPolice')";
						    $resultpolice_staff = mysqli_query($connection,$insertpolice_staff);
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
						                    VALUES ('$regnoCompany','$nameCompany','$locationCompany','$hashedpwCompany')";
						    $resultinsurance_company = mysqli_query($connection,$insertinsurance_company);
						}
					}
?>

<html>
<head>

	<title>Login</title>
		   
	<link rel="icon" href="src/images/car.png" type="image/gif">

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
 background-image:url("src/images/bg2.jpg");
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
<form name="loginSignupForm" action=""  method="post">
<input class="tab-radio" id="main-tab-1" name="main-group" type="radio" checked="checked">

<div class="tab-content" style="margin-left:0%;">
 
    <table style="padding:500px;">
        <tr style="">
            <div class="" style="width:500px;">  
			    <td>
				    <select name="regType" class="form-control">
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
				    <input name="passwordLogin" id="txtPassword" type="password" class="form-control" data-type="password" placeholder="Enter your password">
			    </td>
            </div>
        </tr>
        <tr>
            <td>
                <div class="" style="width:500px; margin:20px;">
                    <input name="btnLogin" type="submit" class="button" value="Sign In" style="color:white; font-weight:bold;" id="btnSignin" onclick="validateLoginForm()" > <br>
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
                                    <input  name="fnameDriver" style="width:100%;" id="txtFname" type="text" class="form-control" placeholder="First Name"/>
                                </div>
                            </td>
                            <td style="padding:0px 0px 0px 10px; width:50%;">
                                <div class="">
                                    <input name="lnameDriver" style="width:100%;" id="txtLname" type="text" class="form-control" placeholder="Last Name"/>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
                <td class="" style="width:50%;">
                    <!--reg no-->
                    <div class="">
                        <input name="regno" style="width:100%;" id="txtRegNumber" type="text" class="form-control" placeholder="Enter your Vehicle Registration No."/>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="sign-up-table" style="width:50%;">
                    <!--address-->
                    <div class="">
                        <input name="addressDriver" id="txtAddress" type="text" class="form-control" placeholder="Enter your Address">
                    </div>
                </td>
                <td class="sign-up-table">
                    <!--vehi type-->
					
					<select name="vehicalType" class="form-control" id="txtVehicleType" placeholder="Enter your Vehicle Type">
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
                        <input name="nicDriver" id="txtNIC" type="text" class="form-control" placeholder="Enter your NIC">
                    </div>
                </td>
                <td class="sign-up-table">
                    <!--pass-->
                    <div class="">
                        <input name="pwDriver" id="txtSignUpPassword" type="password" class="form-control" data-type="password" placeholder="Create your password">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="sign-up-table">
                    <!--dob-->
                        <input name="dobDriver" type="text" id="txtDOB" class="form-control" style="" width="100%" placeholder="Enter your Date of Birth" value="">
                </td>
                <td class="sign-up-table">
                    <!--rep pass-->
                    <div class="">
                        <input name="reppwDriver" id="txtSignUpRepPass" type="password" class="form-control" data-type="password" placeholder="Repeat your password"/>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="sign-up-table">
                    <!--mail-->
                        <div class="">
                            <input name="mailDriver" id="txtEmail" type="email" class="form-control" placeholder="Enter your e-mail">
                        </div>
                </td>
                <td class="sign-up-table">
                    <!--tel-->
                    <div class="">
                        <input name="telDriver" id="txtContact" type="tel" class="form-control" placeholder="Enter your Contact Number">
                    </div>
                </td>
            </tr>
			<tr>
                <td class="sign-up-table">
                    <!--licenceno-->
                        <div class="">
                            <input name="licenceno" id="txtEmail" type="text" class="form-control" placeholder="Enter your licence no">
                        </div>
                </td>
				<td> </td>
            </tr>
            <tr>
                <td colspan="2" class="sign-up-table">
                    <div class="" style="margin:20px;">
                        <input name="btnSignUpDriver" type="submit" class="button" value="Sign Up" style="color:white; font-weight:bold;" id="btnSignUp" onclick="validateSignupDriverForm()">
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
                                    <input name="fnameRDA" style="width:100%;" id="txtFname" type="text" class="form-control" placeholder="First Name"/>
                                </div>
								</td>
								<td style="padding:0px 0px 0px 10px; width:50%;">
									<div class="">
										<input name="lnameRDA" style="width:100%;" id="txtLname" type="text" class="form-control" placeholder="Last Name"/>
									</div>
								</td>
                            </tr>
                        </table>
                </td>
                <td class="sign-up-table" style="width:50%;">
                    <!--staff no-->
                    <div class="">
                        <input  name="staffnoRDA" style="width:100%;" id="txtStaffNumber" type="text" class="form-control" placeholder="Enter your Staff Registration No.">
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
                        <input name="pwRDA" id="txtSignUpPassword" type="password" class="form-control" data-type="password" placeholder="Create your password">
                    </div>
                </td>
            </tr>
			<tr>
			 <td class="sign-up-table">
                    <!--rep pass-->
                    <div class="">
                        <input name="reppwRDA" id="txtSignUpRepPass" type="password" class="form-control" data-type="password" placeholder="Repeat your password"/>
                    </div>
                </td>
			</tr>
			<tr>
		     <td colspan="2" class="sign-up-table">
					<div class="group" style="margin:20px;">
						<input name="btnSignUpRDA" type="submit" class="button" value="Sign Up" style="color:white; font-weight:bold;" id="btnSignUp" onclick="validateSignupRDAForm()">
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
                                <input name="fnamePolice" style="width:100%;" id="txtFname" type="text" class="form-control" placeholder="First Name"/>
                            </div>
                        </td>
                        <td style="padding:0px 0px 0px 10px; width:50%;">
                            <div class="">
                                <input name="lnamePolice" style="width:100%;" id="txtLname" type="text" class="form-control" placeholder="Last Name"/>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
            <td class="sign-up-table" style="width:50%;">
                <!--staff no-->
                <div class="" >
                    <input name="staffnoPolice" style="width:100%;" id="txtStaffNumber" type="text" class="form-control" placeholder="Enter your Staff Registration No.">
                </div>
            </td>
        </tr>
        <tr>
            <td class="sign-up-table">
                <!--nic-->
                <div class="">
                    <input name="nicPolice" id="txtNIC" type="text" class="form-control" placeholder="Enter your NIC">
                </div>
            </td>
			<td class="sign-up-table">
                <!--division-->
                <div class="">
                    <input name="divisionPolice" id="txtNIC" type="text" class="form-control" placeholder="Enter your Division"/>
                </div>									
		    </td>
		</tr>
		<tr>
		<td class="sign-up-table">
                    <!--pass-->
                    <div class="">
                        <input name="pwPolice" id="txtSignUpPassword" type="password" class="form-control" data-type="password" placeholder="Create your password">
                    </div>
                </td>
            
			 <td class="sign-up-table">
                    <!--rep pass-->
                    <div class="">
                        <input name="reppwPolice" id="txtSignUpRepPass" type="password" class="form-control" data-type="password" placeholder="Repeat your password"/>
                    </div>
                </td>
			</tr>
		<tr>
            <td colspan="2" class="sign-up-table">
                <div class="group" style="margin:20px;">
                    <input  name="btnSignUpPolice" type="submit" class="button" value="Sign Up" style="color:white; font-weight:bold;" id="btnSignUp" onclick="validateSignupPoliceForm()" />
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
                        <input  style=";" name="nameCompany" id="txtSignUpPassword" type="text" class="form-control" data-type="text" placeholder="Enter Your Company Name">
                    </div>
                </td>
            
			 <td class="sign-up-table" style="width:500px;">
                    <!--reg no-->
                    <div class="">
                        <input style="" name="regnoCompany" id="txtSignUpRepPass" type="text" class="form-control" data-type="text" placeholder="Enter Your Registration No."/>
                    </div>
                </td>
			</tr>
			<tr>
                <td class="sign-up-table">
					<!--location-->
					<div class="">
						<input  name="locationCompany" id="txtNIC" type="text" class="form-control" placeholder="Enter your Location"/>
					</div>											
				</td>
				<td class="sign-up-table">
                    <!--pass-->
                    <div class="">
                        <input name="pwCompany" id="txtSignUpPassword" type="password" class="form-control" data-type="password" placeholder="Create your password">
                    </div>
                </td>
			</tr>
			<tr>
		        <td class="sign-up-table">
                    <!--rep pass-->
                    <div class="">
                        <input name="reppwCompany" id="txtSignUpRepPass" type="password" class="form-control" data-type="password" placeholder="Repeat your password"/>
                    </div>
                </td>
				<td> </td>
			</tr>
			
			<tr>
				<td colspan="2" class="sign-up-table">
					<div class="group" style="margin:20px;">
						<input name="btnSignUpCompany" type="submit" class="button" value="Sign Up" style="color:white; font-weight:bold;" id="btnSignUp" onclick="validateSignupInsuranceCompanyForm()"/>
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
</body>
</html>
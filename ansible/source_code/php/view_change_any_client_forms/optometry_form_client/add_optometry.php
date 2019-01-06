<!--
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
-->

<!DOCTYPE html>
<html>

<head>
<title>Hope Matters</title>
	<link rel="icon" href="/images/hope_matters_logo.png">
	<link rel="stylesheet" type="text/css" href="/css/navbar.css">
	<link rel="stylesheet" type="text/css" href="/css/add_client.css">
	<link rel="stylesheet" type="text/css" href="/css/optometry.css">
	<script src="/js/optometry_validation.js" type="text/javascript"> </script> 
</head>

<body style="padding-top: 70px;">

  <!-- nav bar -->
  <div id="container">
	   
	  <div id="sign-out">
        <form method="post" action="/php/dashboard.php">
            <input type="submit" value="Dashboard">
        </form>
      </div>
	  
	  <div id="sign-out">
        <form method="post" action="/php/sign_out.php">
            <input type="submit" value="Sign Out">
        </form>
      </div>
	  
	  <div style="float: left;  width: 300px;">
        <form method="post" action="/php/view_change_any_client_forms/view_all_form.php">
            <input style="width: 300px;" type="submit" value="Client Overview">
        </form>
	  </div>
	  
  </div>
  <br></br>
  
<!-- all divs are within this div, it keeps the divs centered -->
<div style="width:970px; margin: 0 auto; ">
  
  <!-- the begining of general info card -->
  <div class="accountCard" style="float: left;  width: 885px; height: 150px;" >
	<p class='p'style='color: black;font-weight:100; text-align: center;'>Client's General Info</p>
	
	
<?php
		
		require('../../database_credentials.php');
		require('../../date_functions.php');
		session_start();
		
		// make sure user is logged in
		login_check();
		
		$choosen_client_id = $_SESSION['choosen_client_id'];
		$username = $_SESSION['username'];
		
		class grab_value extends RecursiveIteratorIterator {
			function __construct($it) {
				parent::__construct($it, self::LEAVES_ONLY);
			}
			function current() {
				$_SESSION['temp'] = parent::current();
			}
			function beginChildren() {
				echo "<tr>";
			}
			function endChildren() {
				echo "</tr>" . "\n";
			}
		}
		
		// used to display list of clinicians in the database 
		class display_clinicians extends RecursiveIteratorIterator {
			function __construct($it) {
				parent::__construct($it, self::LEAVES_ONLY);
			}
			function current() {
					
				return "<option value='" . parent::current() . "'>";
			}
			function beginChildren() {
				echo "<tr>";
			}
			function endChildren() {
				echo "</tr>" . "\n";
			}
		}
		
		// create database connection
		$conn = new PDO($dbconnection, $dbusername, $dbpassword);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		
		// grab first name
		$stmt = $conn->prepare("SELECT first_name FROM general_info WHERE client_id='$choosen_client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$first_name = $_SESSION['temp'];
		
		
		// grab last name
		$stmt = $conn->prepare("SELECT last_name FROM general_info WHERE client_id='$choosen_client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$last_name = $_SESSION['temp'];
		
		
		// grab sex
		$stmt = $conn->prepare("SELECT sex FROM general_info WHERE client_id='$choosen_client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$sex = $_SESSION['temp'];
		
		
		// grab location
		$stmt = $conn->prepare("SELECT location FROM general_info WHERE client_id='$choosen_client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$location = $_SESSION['temp'];
		
		
		// grab date of birth
		$stmt = $conn->prepare("SELECT date_of_birth FROM general_info WHERE client_id='$choosen_client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$date_of_birth = $_SESSION['temp'];
		
		
		// grab occupation
		$stmt = $conn->prepare("SELECT occupation FROM general_info WHERE client_id='$choosen_client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$occupation = $_SESSION['temp'];
		
		
		// get the client's age
		$age = get_age_from_date_of_birth($date_of_birth);
		
		
		// display general info
		echo "<div style=' padding-left: 10px; float: left;'>";
		echo '<b>Client ID:</b>' . "<br>" . "<br>";
		echo '<b>Sex:</b>' . "<br>" . "<br>";
		echo "</div>";
		
		echo "<div style=' float: left;padding-left: 20px;width: 50px;'>";
		echo $choosen_client_id . "<br>" . "<br>";
		echo $sex;
		echo "</div>";
		
		echo "<div style=' float: left;padding-left: 30px;'>";
		echo '<b>First Name:</b>' . "<br>" . "<br>";
		echo '<b>Last Name:</b>' . "<br>" . "<br>";
		echo "</div>";
		
		echo "<div style=' float: left;padding-left: 15px; width: 170px;'>";
		echo $first_name . "<br>" . "<br>";
		echo $last_name;
		echo "</div>";
		
		echo "<div style=' float: left;padding-left: 30px;'>";
		echo '<b>Today\'s Date:</b>' . "<br>" . "<br>";
		echo '<b>Age:</b>' . "<br>" . "<br>";
		echo "</div>";
		
		echo "<div style=' float: left;padding-left: 15px;width: 180px;'>";
		echo date("m/d/Y") . "<br>" . "<br>";
		echo $age . "<br>" . "<br>";
		echo "</div>";
		
		echo "<div style=' float: left; padding-left: 10px; width: 442px;'>";
		echo '<b>Residence:</b>' . '<lable style="padding-left: 5px;">' . $location . '</lable>';
		echo "</div>";
		
		echo "<div style=' float: left;padding-left: 30px; width: 350px;'>";
		echo '<b>Occupation:</b>' . '<lable style="padding-left: 25px;">' . $occupation . '</lable>';
		echo "</div>";
	
	?>
		
 </div>
  
  
	<!-- begining of optometry tests card -->
    <div class="accountCard" style="float: left; width: 885px; height: 1360px; position: relative;">
	
		<form name="optometry_form" action="insert_optometry.php" onsubmit="return validate_form()" method="post">
			
			<b>Screening Site: </b><input type="text" name="screening_site" style="width: 140px; height: 25px;" maxlength="45"  autofocus onfocus='this.value = this.value;'/> <br><br>
			
			<b>1. Subjective Complaint:</b>
			<input type="checkbox" name="far_vision" value="yes"  />Far Vision
			<input type="checkbox" name="near_vision" value="yes"  />Near Vision
			<input type="checkbox" name="hypertension" value="yes"  />Hypertension
			<input type="checkbox" name="diabetes" value="yes"  />Diabetes
			<input type="checkbox" name="allergy" value="yes"  />Allergy
			
			<br><br>
			
			Other Complaint: <input type="text" name="other" style="width: 140px; height: 25px;" maxlength="45" /> 
			
			<br><br>
			
			Comments/Other: <br> <textarea rows="4" cols="50" name="comment" class="comment_area" maxlength="255" ></textarea>

			<br><br>
			
			<!-- this div contains the visual activity label and chart -->
			<div style="height: 200px; float: left; margin-right: 380px;">
				<b>Visual Activity:</b>
				<div style="float: right; ">
					<div style="float: left;">
						<table class="visual_acuity" style="width:100%;">
						  
						  <!-- two invisible <th> exist at top of table -->
						  <tr>
							<th style="border: none;"> &nbsp; </th>
						  </tr>
						  <tr style="height: 32px;">
							<th style="border: none; "> &nbsp; </th>
						  </tr>
						  <tr>
							<th style="height: 30px;">Right</th>
						  </tr>
						  <tr>
							<th style="height: 30px;">Left</th>
						  </tr>
						</table>
					</div>
					
					<div style="float: left;">
						<table class="visual_acuity" style="width:100%;">
						  <tr>
							<th colspan="3">No Lenses</th>
							<th colspan="2">With Lenses</th>
						  </tr>
						  <tr>
							<th>Far</th>
							<th>Pinhole</th>
							<th>Near</th>
							<th>Far</th>
							<th>Near</th>
						  </tr>
						  <tr>
							<th><input style="width: 55px; height: 25px;" type="number" name="no_lenses_right_far" min="0" max="99999"  /></th>
							<th><input style="width: 55px; height: 25px;" type="number" name="no_lenses_right_pinhole" min="0" max="99999"  /></th>
							<th><input style="width: 55px; height: 25px;" type="number" name="no_lenses_right_near" min="0" max="99999"  /></th>
							<th><input style="width: 55px; height: 25px;" type="number" name="with_lenses_right_far" min="0" max="99999"  /></th>
							<th><input style="width: 55px; height: 25px;" type="number" name="with_lenses_right_near" min="0" max="99999"  /></th>
						  </tr>
						  <tr>
							<th><input style="width: 55px; height: 25px;" type="number" name="no_lenses_left_far" min="0" max="99999"  /></th>
							<th><input style="width: 55px; height: 25px;" type="number" name="no_lenses_left_pinhole" min="0" max="99999"  /></th>
							<th><input style="width: 55px; height: 25px;" type="number" name="no_lenses_left_near" min="0" max="99999"  /></th>
							<th><input style="width: 55px; height: 25px;" type="number" name="with_lenses_left_far" min="0" max="99999"  /></th>
							<th><input style="width: 55px; height: 25px;" type="number" name="with_lenses_left_near" min="0" max="99999"  /></th>
						  </tr>
						</table>
					</div>
				</div>
			</div>
			
			
			<b>2. Screening Results are Within Acceptable Limits:</b>
			<input type="radio" name="screening_results_acceptable" value="yes" checked />yes
			<input type="radio" name="screening_results_acceptable" value="no" />no
			
			<br><br>
			
			<b>3. Objective:</b>
			<label style="margin-left:50px">Externals</label><input style="margin-left:25px;" type="checkbox" name="externals_right" value="yes"  />right <input type="checkbox" name="externals_left" value="no"  />left  <input type="text" name="externals_comment" style="width: 340px; height: 25px;" maxlength="100" /><br>
			<label style="margin-left:150px">Pupils</label><input style="margin-left:48px;" type="checkbox" name="pupils_right" value="yes"  />right <input type="checkbox" name="pupils_left" value="no"  />left <input type="text" name="pupils_comment" style="width: 340px; height: 25px;" maxlength="100" /> 
			
			<br><br>
			
			<b style="margin-left:155px">Opthalmoscopy:</b><br>
			<label style="margin-left:150px">R:</label><input type="text" name="opthalmoscopy_right" style="width: 340px; height: 25px;" maxlength="100" /><br>
			<label style="margin-left:150px">L:</label><input type="text" name="opthalmoscopy_left" style="width: 340px; height: 25px;" maxlength="100" />
			
			<br><br>
			
			<label style="margin-left:155px">A = Retinomax</label> <label style="margin-left:60px">B = Retinoscopy</label><label style="margin-left:60px">C = Subjective</label>
			
			
			<!-- this div contains opthalmoscopy label and chart -->
			<table class="visual_acuity" style="width: 700px; margin-left: 150px;">
						  
						  <tr>
							<th rowspan="2"style="width: 55px;"><b >A</b></th>
							<th class="opthalmoscopy_table"><b>R</b></th>
							<th class="opthalmoscopy_table"><input class="opthalmoscopy_table" type="text" name="ar1" maxlength="45"  /></th>
							<th class="opthalmoscopy_table"><input class="opthalmoscopy_table" type="text" name="ar2" maxlength="45"  /></th>
							<th class="opthalmoscopy_table"><input class="opthalmoscopy_table" type="text" name="ar3" maxlength="45"  /></th>
						  </tr>
						  
						  <tr>
							<th class="opthalmoscopy_table" ><b>L</b></th>
							<th class="opthalmoscopy_table"><input class="opthalmoscopy_table" type="text" name="al1" maxlength="45"  /></th>
							<th class="opthalmoscopy_table"><input class="opthalmoscopy_table" type="text" name="al2" maxlength="45"  /></th>
							<th class="opthalmoscopy_table"><input class="opthalmoscopy_table" type="text" name="al3" maxlength="45"  /></th>
						  </tr>
						  
						  <tr>
							<th rowspan="2"><b>B</b></th>
							<th class="opthalmoscopy_table" ><b>R</b></th>
							<th class="opthalmoscopy_table"><input class="opthalmoscopy_table" type="text" name="br1" maxlength="45"  /></th>
							<th class="opthalmoscopy_table"><input class="opthalmoscopy_table" type="text" name="br2" maxlength="45"  /></th>
							<th class="opthalmoscopy_table"><input class="opthalmoscopy_table" type="text" name="br3" maxlength="45"  /></th>
						  </tr>
						  
						  <tr>
							<th class="opthalmoscopy_table"><b>L</b></th>
							<th class="opthalmoscopy_table"><input class="opthalmoscopy_table" type="text" name="bl1" maxlength="45"  /></th>
							<th class="opthalmoscopy_table"><input class="opthalmoscopy_table" type="text" name="bl2" maxlength="45"  /></th>
							<th class="opthalmoscopy_table"><input class="opthalmoscopy_table" type="text" name="bl3" maxlength="45"  /></th>
						  </tr>
						  
						  <tr>
							<th rowspan="2"><b>C</b></th>
							<th class="opthalmoscopy_table"><b>R</b></th>
							<th class="opthalmoscopy_table"><input class="opthalmoscopy_table" type="text" name="cr1" maxlength="45"  /></th>
							<th class="opthalmoscopy_table"><input class="opthalmoscopy_table" type="text" name="cr2" maxlength="45"  /></th>
							<th class="opthalmoscopy_table"><input class="opthalmoscopy_table" type="text" name="cr3" maxlength="45"  /></th>
						  </tr>
						  
						  <tr>
							<th><b>L</b></th>
							<th class="opthalmoscopy_table"><input class="opthalmoscopy_table" type="text" name="cl1" maxlength="45"  /></th>
							<th class="opthalmoscopy_table"><input class="opthalmoscopy_table" type="text" name="cl2" maxlength="45"  /></th>
							<th class="opthalmoscopy_table"><input class="opthalmoscopy_table" type="text" name="cl3" maxlength="45"  /></th>
						  </tr>
						  
			</table>
			
			<br><br>
			
			<b style="margin-left:155px">Tonometry:</b><br>
			<table class="visual_acuity" style="width: 700px; margin-left: 150px;">
						
						  <tr>
							<th class="opthalmoscopy_table" >Right:</th>
							<th class="opthalmoscopy_table"> <input style="width: 600px; height: 25px;" type="text" name="tonometry_right" maxlength="100"  /></th>
						  </tr>
						  
						  <tr>
							<th class="opthalmoscopy_table">Left:</th>
							<th class="opthalmoscopy_table"><input style="width: 600px; height: 25px;" type="text" name="tonometry_left" maxlength="100"  /></th>
						  </tr>
						  
			</table>
			
			<br><br>
			
			<b>4. Plan:</b> <br> <textarea style="height: 75px; width: 450px;" name="plan" class="comment_area" maxlength="255" ></textarea>
			
			<br><br><br>
			
			<?php
				echo "<label style='margin-left: 335px;'>Clinician:</label><input list='clinician_list' name='clinician' value='$username' style='padding-left: 10px; margin-left: 10px;width: 140px; height: 20px;' maxlength='20'> <br>
			 
					 <datalist id='clinician_list'>";
							
								
									$stmt = $conn->prepare("SELECT username FROM accounts;");
									$stmt->execute();
									$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
								
									foreach(new display_clinicians(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
										echo $v;
									}
									
							
				echo "</datalist>";
			?>
			
			<div style="width: 200px; margin-left: 350px; margin-top: 10px;">		
				<input type="submit" name="submit_button" class="submitbtn" value="Submit Optometry Form">
			</div>
			
		</form>
		
	</div>
	
 </div>
  
</body>
</html>
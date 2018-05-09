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
        <form method="post" action="select_optometry.php">
            <input style="width: 300px;" type="submit" value="Form Selection">
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
		
		require('../database_credentials.php');
		require('../date_functions.php');
		session_start();
		
		// make sure user is logged in
		login_check();
		
		$choosen_optometry = $_SESSION['choosen_optometry'];
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
		
		
		// grab clients id
		$stmt = $conn->prepare("SELECT client_id FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$client_id = $_SESSION['temp'];
		
		
		// grab first name
		$stmt = $conn->prepare("SELECT first_name FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$first_name = $_SESSION['temp'];
		
		
		// grab last name
		$stmt = $conn->prepare("SELECT last_name FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$last_name = $_SESSION['temp'];
		
		
		// grab sex
		$stmt = $conn->prepare("SELECT sex FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$sex = $_SESSION['temp'];
		
		
		// grab location
		$stmt = $conn->prepare("SELECT location FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$location = $_SESSION['temp'];
		
		
		// grab date of birth
		$stmt = $conn->prepare("SELECT date_of_birth FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$date_of_birth = $_SESSION['temp'];
		
		
		// grab occupation
		$stmt = $conn->prepare("SELECT occupation FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
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
		echo $client_id . "<br>" . "<br>";
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
	
		<form name="optometry_form" action="update_optometry.php" onsubmit="return validate_form()" method="post">
			
			
			<?php
				
				// grab screening site
				$stmt = $conn->prepare("SELECT screening_site FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$screening_site = $_SESSION['temp'];
				
				
				// grab far vision
				$stmt = $conn->prepare("SELECT far_vision FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$far_vision_check = $_SESSION['temp'];
				
				
				if ($far_vision_check == 'yes'){
					$far_vision_check = 'checked';
				}
				else {
					$far_vision_check = '';
				}
				
				
				
				// grab near vision
				$stmt = $conn->prepare("SELECT near_vision FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$near_vision_check = $_SESSION['temp'];
				
				
				if ($near_vision_check == 'yes'){
					$near_vision_check = 'checked';
				}
				else {
					$near_vision_check = '';
				}
				
				
				
				// grab hypertension
				$stmt = $conn->prepare("SELECT hypertension FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$hypertension_check = $_SESSION['temp'];
				
				
				if ($hypertension_check == 'yes'){
					$hypertension_check = 'checked';
				}
				else {
					$hypertension_check = '';
				}
				
				
				
				// grab diabetes
				$stmt = $conn->prepare("SELECT diabetes FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$diabetes_check = $_SESSION['temp'];
				
				
				if ($diabetes_check == 'yes'){
					$diabetes_check = 'checked';
				}
				else {
					$diabetes_check = '';
				}
				
				
				
				// grab allergy
				$stmt = $conn->prepare("SELECT allergy FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$allergy_check = $_SESSION['temp'];
				
				
				if ($allergy_check == 'yes'){
					$allergy_check = 'checked';
				}
				else {
					$allergy_check = '';
				}
			
			
			
				// grab any other complaints
				$stmt = $conn->prepare("SELECT other FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$other = $_SESSION['temp'];
				
				
				// grab any comments
				$stmt = $conn->prepare("SELECT comment FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$comment = $_SESSION['temp'];
				
				
				
				echo "<b>Screening Site: </b><input type='text' name='screening_site' style='width: 140px; height: 25px;' maxlength='45' value='$screening_site'/> <br><br>
				
					<b>1. Subjective Complaint:</b>
					<input type='checkbox' name='far_vision' value='yes' $far_vision_check />Far Vision
					<input type='checkbox' name='near_vision' value='yes' $near_vision_check />Near Vision
					<input type='checkbox' name='hypertension' value='yes' $hypertension_check />Hypertension
					<input type='checkbox' name='diabetes' value='yes' $diabetes_check />Diabetes
					<input type='checkbox' name='allergy' value='yes' $allergy_check />Allergy
					
					<br><br>
					
					Other Complaint: <input type='text' name='other' style='width: 140px; height: 25px;' maxlength='45' value='$other' /> 
					
					<br><br>
					
					Comments/Other: <br> <textarea rows='4' cols='50' name='comment' class='comment_area' maxlength='255' >$comment</textarea>

					<br><br>";
			
				
				/****************** grab all values needed for visual activity table ******************/
				
				$stmt = $conn->prepare("SELECT no_lenses_right_far FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$no_lenses_right_far = $_SESSION['temp'];
				
				
				$stmt = $conn->prepare("SELECT no_lenses_right_pinhole FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$no_lenses_right_pinhole = $_SESSION['temp'];
				
				
				$stmt = $conn->prepare("SELECT no_lenses_right_near FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$no_lenses_right_near = $_SESSION['temp'];
				
				
				$stmt = $conn->prepare("SELECT with_lenses_right_near FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$with_lenses_right_near = $_SESSION['temp'];
				
				
				$stmt = $conn->prepare("SELECT with_lenses_right_far FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$with_lenses_right_far = $_SESSION['temp'];
				
				
				$stmt = $conn->prepare("SELECT no_lenses_left_far FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$no_lenses_left_far = $_SESSION['temp'];
				
				
				$stmt = $conn->prepare("SELECT no_lenses_left_pinhole FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$no_lenses_left_pinhole = $_SESSION['temp'];
				
				
				$stmt = $conn->prepare("SELECT no_lenses_left_near FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$no_lenses_left_near = $_SESSION['temp'];
				
				
				$stmt = $conn->prepare("SELECT with_lenses_left_near FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$with_lenses_left_near = $_SESSION['temp'];
				
				
				$stmt = $conn->prepare("SELECT with_lenses_left_far FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$with_lenses_left_far = $_SESSION['temp'];
				
				
				
				/****************** echo the visual activity table ******************/
				
				echo "<!-- this div contains the visual activity label and chart -->
					<div style='height: 200px; float: left; margin-right: 380px;'>
						<b>Visual Activity:</b>
						<div style='float: right; '>
							<div style='float: left;'>
								<table class='visual_acuity' style='width:100%;'>
								  
								  <!-- two invisible <th> exist at top of table -->
								  <tr>
									<th style='border: none;'> &nbsp; </th>
								  </tr>
								  <tr style='height: 32px;'>
									<th style='border: none; '> &nbsp; </th>
								  </tr>
								  <tr>
									<th style='height: 30px;'>Right</th>
								  </tr>
								  <tr>
									<th style='height: 30px;'>Left</th>
								  </tr>
								</table>
							</div>
							
							<div style='float: left;'>
								<table class='visual_acuity' style='width:100%;'>
								  <tr>
									<th colspan='3'>No Lenses</th>
									<th colspan='2'>With Lenses</th>
								  </tr>
								  <tr>
									<th>Far</th>
									<th>Pinhole</th>
									<th>Near</th>
									<th>Far</th>
									<th>Near</th>
								  </tr>
								  <tr>
									<th><input style='width: 55px; height: 25px;' type='number' name='no_lenses_right_far' value='$no_lenses_right_far' min='0' max='99999' /></th>
									<th><input style='width: 55px; height: 25px;' type='number' name='no_lenses_right_pinhole'  value='$no_lenses_right_pinhole' min='0' max='99999'/></th>
									<th><input style='width: 55px; height: 25px;' type='number' name='no_lenses_right_near'  value='$no_lenses_right_near' min='0' max='99999'/></th>
									<th><input style='width: 55px; height: 25px;' type='number' name='with_lenses_right_far'  value='$with_lenses_right_far' min='0' max='99999'/></th>
									<th><input style='width: 55px; height: 25px;' type='number' name='with_lenses_right_near' value='$with_lenses_right_near'  min='0' max='99999'/></th>
								  </tr>
								  <tr>
									<th><input style='width: 55px; height: 25px;' type='number' name='no_lenses_left_far' value='$no_lenses_left_far'  min='0' max='99999'/></th>
									<th><input style='width: 55px; height: 25px;' type='number' name='no_lenses_left_pinhole' value='$no_lenses_left_pinhole'  min='0' max='99999'/></th>
									<th><input style='width: 55px; height: 25px;' type='number' name='no_lenses_left_near'  value='$no_lenses_left_near' min='0' max='99999'/></th>
									<th><input style='width: 55px; height: 25px;' type='number' name='with_lenses_left_far'  value='$with_lenses_left_far' min='0' max='99999'/></th>
									<th><input style='width: 55px; height: 25px;' type='number' name='with_lenses_left_near' value='$with_lenses_left_near'  min='0' max='99999'/></th>
								  </tr>
								</table>
							</div>
						</div>
					</div>";
				
				
				
				$stmt = $conn->prepare("SELECT screening_results_acceptable FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$screening_results_acceptable = $_SESSION['temp'];
				
				if ($screening_results_acceptable == 'yes'){
					$screening_results_acceptable_yes_check = 'checked';
				}
				else {
					$screening_results_acceptable_no_check = 'checked';
				}
				
				
				
				$stmt = $conn->prepare("SELECT externals_right FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$externals_right_check = $_SESSION['temp'];
				
				
				if ($externals_right_check == 'yes'){
					$externals_right_check = 'checked';
				}
				else {
					$externals_right_check = '';
				}
				
				
				
				$stmt = $conn->prepare("SELECT externals_left FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$externals_left_check = $_SESSION['temp'];
				
				
				if ($externals_left_check == 'yes'){
					$externals_left_check = 'checked';
				}
				else {
					$externals_left_check = '';
				}
				
				
				
				$stmt = $conn->prepare("SELECT externals_comment FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$externals_comment = $_SESSION['temp'];
				
				
				$stmt = $conn->prepare("SELECT pupils_right FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$pupils_right_check = $_SESSION['temp'];
				
				
				if ($pupils_right_check == 'yes'){
					$pupils_right_check = 'checked';
				}
				else {
					$pupils_right_check = '';
				}
				
				
	
				$stmt = $conn->prepare("SELECT pupils_left FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$pupils_left_check = $_SESSION['temp'];
				
				
				if ($pupils_left_check == 'yes'){
					$pupils_left_check = 'checked';
				}
				else {
					$pupils_left_check = '';
				}
				
				
				
				$stmt = $conn->prepare("SELECT pupils_comment FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$pupils_comment = $_SESSION['temp'];
				
				
				
				$stmt = $conn->prepare("SELECT opthalmoscopy_right FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$opthalmoscopy_right = $_SESSION['temp'];
				
				
				$stmt = $conn->prepare("SELECT opthalmoscopy_left FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$opthalmoscopy_left = $_SESSION['temp'];
				
				
				
				echo"<b>2. Screening Results are Within Acceptable Limits:</b>
					<input type='radio' name='screening_results_acceptable' value='yes' $screening_results_acceptable_yes_check />yes
					<input type='radio' name='screening_results_acceptable' value='no' $screening_results_acceptable_no_check />no
					
					<br><br>
					
					<b>3. Objective:</b>
					<label style='margin-left:50px'>Externals</label><input style='margin-left:25px;' type='checkbox' name='externals_right' value='yes' $externals_right_check />right <input type='checkbox' name='externals_left' value='no' $externals_left_check />left  <input type='text' name='externals_comment' style='width: 340px; height: 25px;' maxlength='100' value='$externals_comment' /><br>
					<label style='margin-left:150px'>Pupils</label><input style='margin-left:48px;' type='checkbox' name='pupils_right' value='yes' $pupils_right_check />right <input type='checkbox' name='pupils_left' value='no' $pupils_left_check />left <input type='text' name='pupils_comment' style='width: 340px; height: 25px;' maxlength='100' value='$pupils_comment' /> 
					
					<br><br>
					
					<b style='margin-left:155px'>Opthalmoscopy:</b><br>
					<label style='margin-left:150px'>R:</label><input type='text' name='opthalmoscopy_right' style='width: 340px; height: 25px;' maxlength='100' value='$opthalmoscopy_right' /><br>
					<label style='margin-left:150px'>L:</label><input type='text' name='opthalmoscopy_left' style='width: 340px; height: 25px;' maxlength='100' value='$opthalmoscopy_left' />
					
					<br><br>
				";
				
				
				
				/****************** grab all values needed for opthalmoscopy table ******************/
				
				$stmt = $conn->prepare("SELECT ar1 FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$ar1 = $_SESSION['temp'];
				
				
				
				$stmt = $conn->prepare("SELECT ar2 FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$ar2 = $_SESSION['temp'];
				
				
				$stmt = $conn->prepare("SELECT ar3 FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$ar3 = $_SESSION['temp'];
				
				
				
				$stmt = $conn->prepare("SELECT al1 FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$al1 = $_SESSION['temp'];
				
				
				
				$stmt = $conn->prepare("SELECT al2 FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$al2 = $_SESSION['temp'];
				
				
				$stmt = $conn->prepare("SELECT al3 FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$al3 = $_SESSION['temp'];
				
				
				
				$stmt = $conn->prepare("SELECT br1 FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$br1 = $_SESSION['temp'];
				
				
				
				$stmt = $conn->prepare("SELECT br2 FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$br2 = $_SESSION['temp'];
				
				
				$stmt = $conn->prepare("SELECT br3 FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$br3 = $_SESSION['temp'];
				
				

				$stmt = $conn->prepare("SELECT bl1 FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$bl1 = $_SESSION['temp'];
				
				
				
				$stmt = $conn->prepare("SELECT bl2 FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$bl2 = $_SESSION['temp'];
				
				
				$stmt = $conn->prepare("SELECT bl3 FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$bl3 = $_SESSION['temp'];
				
				
				
				$stmt = $conn->prepare("SELECT cr1 FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$cr1 = $_SESSION['temp'];
				
				
				
				$stmt = $conn->prepare("SELECT cr2 FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$cr2 = $_SESSION['temp'];
				
				
				$stmt = $conn->prepare("SELECT cr3 FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$cr3 = $_SESSION['temp'];
				
				
				
				$stmt = $conn->prepare("SELECT cl1 FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$cl1 = $_SESSION['temp'];
				
				
				
				$stmt = $conn->prepare("SELECT cl2 FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$cl2 = $_SESSION['temp'];
				
				
				$stmt = $conn->prepare("SELECT cl3 FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$cl3 = $_SESSION['temp'];
				
				
				/****************** dysplay the opthalmoscopy table ******************/
				
				echo "<label style='margin-left:155px'>A = Retinomax</label> <label style='margin-left:60px'>B = Retinoscopy</label><label style='margin-left:60px'>C = Subjective</label>
			
						
						<!-- this div contains opthalmoscopy label and chart -->
						<table class='visual_acuity' style='width: 700px; margin-left: 150px;'>
									  
									  <tr>
										<th rowspan='2'style='width: 55px;'><b >A</b></th>
										<th class='opthalmoscopy_table'><b>R</b></th>
										<th class='opthalmoscopy_table'><input class='opthalmoscopy_table' type='text' name='ar1' value='$ar1' maxlength='45'  /></th>
										<th class='opthalmoscopy_table'><input class='opthalmoscopy_table' type='text' name='ar2' value='$ar2' maxlength='45'  /></th>
										<th class='opthalmoscopy_table'><input class='opthalmoscopy_table' type='text' name='ar3' value='$ar3' maxlength='45'  /></th>
									  </tr>
									  
									  <tr>
										<th class='opthalmoscopy_table' ><b>L</b></th>
										<th class='opthalmoscopy_table'><input class='opthalmoscopy_table' type='text' name='al1' value='$al1' maxlength='45'  /></th>
										<th class='opthalmoscopy_table'><input class='opthalmoscopy_table' type='text' name='al2' value='$al2' maxlength='45'  /></th>
										<th class='opthalmoscopy_table'><input class='opthalmoscopy_table' type='text' name='al3' value='$al3' maxlength='45'  /></th>
									  </tr>
									  
									  <tr>
										<th rowspan='2'><b>B</b></th>
										<th class='opthalmoscopy_table' ><b>R</b></th>
										<th class='opthalmoscopy_table'><input class='opthalmoscopy_table' type='text' name='br1' value='$br1' maxlength='45'  /></th>
										<th class='opthalmoscopy_table'><input class='opthalmoscopy_table' type='text' name='br2' value='$br2' maxlength='45'  /></th>
										<th class='opthalmoscopy_table'><input class='opthalmoscopy_table' type='text' name='br3' value='$br3' maxlength='45'  /></th>
									  </tr>
									  
									  <tr>
										<th class='opthalmoscopy_table'><b>L</b></th>
										<th class='opthalmoscopy_table'><input class='opthalmoscopy_table' type='text' name='bl1' value='$bl1' maxlength='45'  /></th>
										<th class='opthalmoscopy_table'><input class='opthalmoscopy_table' type='text' name='bl2' value='$bl2' maxlength='45'  /></th>
										<th class='opthalmoscopy_table'><input class='opthalmoscopy_table' type='text' name='bl3' value='$bl3' maxlength='45'  /></th>
									  </tr>
									  
									  <tr>
										<th rowspan='2'><b>C</b></th>
										<th class='opthalmoscopy_table'><b>R</b></th>
										<th class='opthalmoscopy_table'><input class='opthalmoscopy_table' type='text' name='cr1' value='$cr1' maxlength='45'  /></th>
										<th class='opthalmoscopy_table'><input class='opthalmoscopy_table' type='text' name='cr2' value='$cr2' maxlength='45'  /></th>
										<th class='opthalmoscopy_table'><input class='opthalmoscopy_table' type='text' name='cr3' value='$cr3' maxlength='45'  /></th>
									  </tr>
									  
									  <tr>
										<th><b>L</b></th>
										<th class='opthalmoscopy_table'><input class='opthalmoscopy_table' type='text' name='cl1' value='$cl1' maxlength='45'  /></th>
										<th class='opthalmoscopy_table'><input class='opthalmoscopy_table' type='text' name='cl2' value='$cl2' maxlength='45'  /></th>
										<th class='opthalmoscopy_table'><input class='opthalmoscopy_table' type='text' name='cl3' value='$cl3' maxlength='45'  /></th>
									  </tr>
									  
						</table>
						
						<br><br>
					 ";
				
				
				$stmt = $conn->prepare("SELECT tonometry_right FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$tonometry_right = $_SESSION['temp'];
				
				
				$stmt = $conn->prepare("SELECT tonometry_left FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$tonometry_left = $_SESSION['temp'];
				
				
				$stmt = $conn->prepare("SELECT plan FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$plan = $_SESSION['temp'];
				
				
				
				echo "<b style='margin-left:155px'>Tonometry:</b><br>
					<table class='visual_acuity' style='width: 700px; margin-left: 150px;'>
								
								  <tr>
									<th class='opthalmoscopy_table' >Right:</th>
									<th class='opthalmoscopy_table'> <input style='width: 600px; height: 25px;' type='text' name='tonometry_right' maxlength='100' value='$tonometry_right'  /></th>
								  </tr>
								  
								  <tr>
									<th class='opthalmoscopy_table'>Left:</th>
									<th class='opthalmoscopy_table'><input style='width: 600px; height: 25px;' type='text' name='tonometry_left' maxlength='100' value='$tonometry_left'  /></th>
								  </tr>
								  
					</table>
					
					<br><br>
					
					<b>4. Plan:</b> <br> <textarea style='height: 75px; width: 450px;' name='plan' class='comment_area' maxlength='255' >$plan</textarea>
					
					<br><br><br>
					 ";
					 
					  
				$stmt = $conn->prepare("SELECT clinician FROM optometry_form WHERE optometry_form_id='$choosen_optometry'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$clinician = $_SESSION['temp'];
					 
					 
				echo "<label style='margin-left: 335px;'>Clinician:</label><input list='clinician_list' name='clinician' value='$clinician' style='padding-left: 10px; margin-left: 10px;width: 140px; height: 20px;' maxlength='20'> <br>
			 
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
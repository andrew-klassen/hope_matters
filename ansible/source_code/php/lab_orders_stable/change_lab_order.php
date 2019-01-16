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
        <form method="post" action="select_lab_order.php">
            <input style="width: 300px;" type="submit" value="Order Selection">
        </form>
      </div>
	  
  </div>
  <br></br>
  
<!-- all divs are within this div, it keeps the divs centered -->
<div style="width:970px; margin: 0 auto; ">
  
  <!-- the begining of general info card -->
  <div class="accountCard" style="float: left; margin-left: 240px;" >
	<p class='p'style='color: black;font-weight:100; text-align: center;'>Client's General Info</p>
	
	
<?php
		
		require('../database_credentials.php');
		require('../date_functions.php');
		session_start();
		
		// make sure user is logged in
		login_check();
		
		$choosen_lab_order = $_SESSION['choosen_lab_order'];
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
		
		
		// grab client id
		$stmt = $conn->prepare("SELECT client_id FROM lab_order WHERE lab_order_id='$choosen_lab_order'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$client_id = $_SESSION['temp'];
		
		
		// grab first name
		$stmt = $conn->prepare("SELECT first_name FROM lab_order WHERE lab_order_id='$choosen_lab_order'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$first_name = $_SESSION['temp'];
		
		
		// grab last name
		$stmt = $conn->prepare("SELECT last_name FROM lab_order WHERE lab_order_id='$choosen_lab_order'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$last_name = $_SESSION['temp'];
		
		
		// grab sex
		$stmt = $conn->prepare("SELECT sex FROM lab_order WHERE lab_order_id='$choosen_lab_order'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$sex = $_SESSION['temp'];
		
		
		// grab location
		$stmt = $conn->prepare("SELECT location FROM lab_order WHERE lab_order_id='$choosen_lab_order'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$location = $_SESSION['temp'];
		
		
		// grab date of birth
		$stmt = $conn->prepare("SELECT date_of_birth FROM lab_order WHERE lab_order_id='$choosen_lab_order'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$date_of_birth = $_SESSION['temp'];
		
		
		// get the client's age
		$age = get_age_from_date_of_birth($date_of_birth);
		
		
		// display the general info
		echo "<div style='width: 500px; height: 100px;'>";
		echo "<div style=' float: left;'>";
		echo '<b>Client ID:</b>' . "<br>" . "<br>";
		echo '<b>First Name:</b>' . "<br>" . "<br>";
		echo '<b>Last Name:</b>' . "<br>" . "<br>";
		echo "</div>";
		
		echo "<div style=' float: left;padding-left: 20px;'>";
		echo $client_id . "<br>" . "<br>";
		echo $first_name . "<br>" . "<br>";
		echo $last_name;
		echo '</div>';
		echo '</div>';
		
		
		echo "<div style='float: left; width: 500px;height: 70px;'>";
		echo "<div style=' float: left;'>";
		echo '<b>Sex:</b>' . "<br>" . "<br>";
		echo '<b>Age:</b>' . "<br>" . "<br>";
		echo '<b>Residence:</b>' . "<br>" . "<br>";
		echo "</div>";
		
		echo "<div style=' float: left;padding-left: 22px;'>";
		echo $sex . "<br>" . "<br>";
		echo $age . "<br>" . "<br>";
		echo $location;
		echo '</div>';
		echo '</div>';
		
		
		$stmt = $conn->prepare("SELECT bs_for_mps FROM lab_order WHERE lab_order_id='$choosen_lab_order'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$bs_for_mps_check = $_SESSION['temp'];
		
		if ($bs_for_mps_check == 'yes') {
			$bs_for_mps_check = 'checked';
		}
		else {
			$bs_for_mps_check = '';
		}
		
		
		$stmt = $conn->prepare("SELECT pbf FROM lab_order WHERE lab_order_id='$choosen_lab_order'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$pbf_check = $_SESSION['temp'];
		
		if ($pbf_check == 'yes') {
			$pbf_check = 'checked';
		}
		else {
			$pbf_check = '';
		}
		
		
		$stmt = $conn->prepare("SELECT widal FROM lab_order WHERE lab_order_id='$choosen_lab_order'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$widal_check = $_SESSION['temp'];
		
		if ($widal_check == 'yes') {
			$widal_check = 'checked';
		}
		else {
			$widal_check = '';
		}
		
		
		$stmt = $conn->prepare("SELECT brucella FROM lab_order WHERE lab_order_id='$choosen_lab_order'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$brucella_check = $_SESSION['temp'];
		
		if ($brucella_check == 'yes') {
			$brucella_check = 'checked';
		}
		else {
			$brucella_check = '';
		}
		
		
		$stmt = $conn->prepare("SELECT vdrl_rpr FROM lab_order WHERE lab_order_id='$choosen_lab_order'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$vdrl_rpr_check = $_SESSION['temp'];
		
		if ($vdrl_rpr_check == 'yes') {
			$vdrl_rpr_check = 'checked';
		}
		else {
			$vdrl_rpr_check = '';
		}
		
		
		$stmt = $conn->prepare("SELECT p24_hiv FROM lab_order WHERE lab_order_id='$choosen_lab_order'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$p24_hiv_check = $_SESSION['temp'];
		
		if ($p24_hiv_check == 'yes') {
			$p24_hiv_check = 'checked';
		}
		else {
			$p24_hiv_check = '';
		}
		
		
		$stmt = $conn->prepare("SELECT blood_sugar FROM lab_order WHERE lab_order_id='$choosen_lab_order'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$blood_sugar_check = $_SESSION['temp'];
		
		if ($blood_sugar_check == 'yes') {
			$blood_sugar_check = 'checked';
		}
		else {
			$blood_sugar_check = '';
		}
		
		
		$stmt = $conn->prepare("SELECT stool FROM lab_order WHERE lab_order_id='$choosen_lab_order'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$stool_check = $_SESSION['temp'];
		
		if ($stool_check == 'yes') {
			$stool_check = 'checked';
		}
		else {
			$stool_check = '';
		}
		
		
		$stmt = $conn->prepare("SELECT blood_group FROM lab_order WHERE lab_order_id='$choosen_lab_order'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$blood_group_check = $_SESSION['temp'];
		
		if ($blood_group_check == 'yes') {
			$blood_group_check = 'checked';
		}
		else {
			$blood_group_check = '';
		}
		
		
		$stmt = $conn->prepare("SELECT pregnancy_test FROM lab_order WHERE lab_order_id='$choosen_lab_order'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$pregnancy_test_check = $_SESSION['temp'];
		
		if ($pregnancy_test_check == 'yes') {
			$pregnancy_test_check = 'checked';
		}
		else {
			$pregnancy_test_check = '';
		}
		
		
		$stmt = $conn->prepare("SELECT hb FROM lab_order WHERE lab_order_id='$choosen_lab_order'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$hb_check = $_SESSION['temp'];
		
		if ($hb_check == 'yes') {
			$hb_check = 'checked';
		}
		else {
			$hb_check = '';
		}
		
		
		$stmt = $conn->prepare("SELECT urinalysis FROM lab_order WHERE lab_order_id='$choosen_lab_order'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$urinalysis_check = $_SESSION['temp'];
		
		if ($urinalysis_check == 'yes') {
			$urinalysis_check = 'checked';
		}
		else {
			$urinalysis_check = '';
		}
		
		
		$stmt = $conn->prepare("SELECT hvs FROM lab_order WHERE lab_order_id='$choosen_lab_order'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$hvs_check = $_SESSION['temp'];
		
		if ($hvs_check == 'yes') {
			$hvs_check = 'checked';
		}
		else {
			$hvs_check = '';
		}
	?>
		
 </div>
  
  
	<!-- begining of lab orders card -->
    <div class="accountCard" style="float: left; width: 885px; height: 400px; position: relative;">
		
		<p class='p'style='color: black;font-weight:100; text-align: center;'>Check the tests that a lab technician should preform.</p>
		
		<form name="lab_form" action="update_lab_order.php" onsubmit="return validate_form()" method="post">
			<?php
				echo"<div style='float: left; margin-left: 250px;'>
					<input type='checkbox' name='bs_for_mps' $bs_for_mps_check/><b>B/S for MPS</b>
					<br><br>
					
					<input type='checkbox' name='pbf' $pbf_check/> <b>PBF</b>
					<br><br>
					
					<input type='checkbox' name='widal' $widal_check/> <b>Widal</b> <br>
					<br>
					
					<input type='checkbox' name='brucella' $brucella_check/> <b>Brucella</b> 
					<br><br>
					
					<input type='checkbox' name='vdrl_rpr' $vdrl_rpr_check/> <b>VDRL/RPR</b>
					<br><br>
					
					<input type='checkbox' name='p24_hiv' $p24_hiv_check/> <b>P24/HIV</b>
					<br><br>
					
					<input type='checkbox' name='blood_sugar' $blood_sugar_check/> <b>Blood Sugar (RBS & FBS)</b>
					<br><br>
				</div>
				
				<div>
					<input type='checkbox' name='stool' $stool_check/> <b>Stool O/C</b>
					<br><br>
						
					<input type='checkbox' name='blood_group' $blood_group_check/><b>Blood Group</b>
					<br><br>
				
					<input type='checkbox' name='pregnancy_test' $pregnancy_test_check/> <b>Pregnancy Test</b>
					<br><br>
					
					<input type='checkbox' name='hb' $hb_check/> <b>Hb</b>
					<br><br>
					
					<input type='checkbox' name='urinalysis' $urinalysis_check/><b>Urinalysis</b>
					<br><br>
					
					<input type='checkbox' name='hvs' $hvs_check/> <b>HVS</b>
					<br><br>
				</div>";
			
			?>
			
			<br>
			
			<div style="margin-top: 30px;margin-left: 300px;">
				<input style="width: 250px; margin-top: 10px;" type="submit" name="submit_button" class="submitbtn" value="Submit Lab Order">
			</div>
			
		</form>
		
	</div>
	
 </div>
  
</body>
</html>
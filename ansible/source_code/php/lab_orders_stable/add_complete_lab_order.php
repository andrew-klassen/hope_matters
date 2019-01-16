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
        <form method="post" action="select_complete_lab_order.php">
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
		
		
		// determine which tests are going to be preformed
		$stmt = $conn->prepare("SELECT bs_for_mps FROM lab_order WHERE lab_order_id='$choosen_lab_order'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$bs_for_mps_check = $_SESSION['temp'];
		
		if ($bs_for_mps_check == 'yes') {
			$bs_for_mps_check = 'checked';
			$bs_for_mps_disabled = '';
		}
		else {
			$bs_for_mps_check = '';
			$bs_for_mps_disabled = 'disabled';
		}
		
		
		$stmt = $conn->prepare("SELECT pbf FROM lab_order WHERE lab_order_id='$choosen_lab_order'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$pbf_check = $_SESSION['temp'];
		
		if ($pbf_check == 'yes') {
			$pbf_check = 'checked';
			$pbf_disabled = '';
		}
		else {
			$pbf_check = '';
			$pbf_disabled = 'disabled';
		}
		
		
		$stmt = $conn->prepare("SELECT widal FROM lab_order WHERE lab_order_id='$choosen_lab_order'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$widal_check = $_SESSION['temp'];
		
		if ($widal_check == 'yes') {
			$widal_check = 'checked';
			$widal_disabled = '';
		}
		else {
			$widal_check = '';
			$widal_disabled = 'disabled';
		}
		
		
		$stmt = $conn->prepare("SELECT brucella FROM lab_order WHERE lab_order_id='$choosen_lab_order'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$brucella_check = $_SESSION['temp'];
		
		if ($brucella_check == 'yes') {
			$brucella_check = 'checked';
			$brucella_disabled = '';
		}
		else {
			$brucella_check = '';
			$brucella_disabled = 'disabled';
		}
		
		
		$stmt = $conn->prepare("SELECT vdrl_rpr FROM lab_order WHERE lab_order_id='$choosen_lab_order'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$vdrl_rpr_check = $_SESSION['temp'];
		
		if ($vdrl_rpr_check == 'yes') {
			$vdrl_rpr_check = 'checked';
			$vdrl_rpr_disabled = '';
		}
		else {
			$vdrl_rpr_check = '';
			$vdrl_rpr_disabled = 'disabled';
		}
		
		
		$stmt = $conn->prepare("SELECT p24_hiv FROM lab_order WHERE lab_order_id='$choosen_lab_order'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$p24_hiv_check = $_SESSION['temp'];
		
		if ($p24_hiv_check == 'yes') {
			$p24_hiv_check = 'checked';
			$p24_hiv_disabled = '';
		}
		else {
			$p24_hiv_check = '';
			$p24_hiv_disabled = 'disabled';
		}
		
		
		$stmt = $conn->prepare("SELECT blood_sugar FROM lab_order WHERE lab_order_id='$choosen_lab_order'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$blood_sugar_check = $_SESSION['temp'];
		
		if ($blood_sugar_check == 'yes') {
			$blood_sugar_check = 'checked';
			$blood_sugar_disabled = '';
		}
		else {
			$blood_sugar_check = '';
			$blood_sugar_disabled = 'disabled';
		}
		
		
		$stmt = $conn->prepare("SELECT stool FROM lab_order WHERE lab_order_id='$choosen_lab_order'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$stool_check = $_SESSION['temp'];
		
		if ($stool_check == 'yes') {
			$stool_check = 'checked';
			$stool_disabled = '';
		}
		else {
			$stool_check = '';
			$stool_disabled = 'disabled';
		}
		
		
		$stmt = $conn->prepare("SELECT blood_group FROM lab_order WHERE lab_order_id='$choosen_lab_order'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$blood_group_check = $_SESSION['temp'];
		
		if ($blood_group_check == 'yes') {
			$blood_group_check = 'checked';
			$blood_group_disabled = '';
		}
		else {
			$blood_group_check = '';
			$blood_group_disabled = 'disabled';
		}
		
		
		$stmt = $conn->prepare("SELECT pregnancy_test FROM lab_order WHERE lab_order_id='$choosen_lab_order'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$pregnancy_test_check = $_SESSION['temp'];
		
		if ($pregnancy_test_check == 'yes') {
			$pregnancy_test_check = 'checked';
			$pregnancy_test_disabled = '';
		}
		else {
			$pregnancy_test_check = '';
			$pregnancy_test_disabled = 'disabled';
		}
		
		
		$stmt = $conn->prepare("SELECT hb FROM lab_order WHERE lab_order_id='$choosen_lab_order'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$hb_check = $_SESSION['temp'];
		
		if ($hb_check == 'yes') {
			$hb_check = 'checked';
			$hb_disabled = '';
		}
		else {
			$hb_check = '';
			$hb_disabled = 'disabled';
		}
		
		
		$stmt = $conn->prepare("SELECT urinalysis FROM lab_order WHERE lab_order_id='$choosen_lab_order'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$urinalysis_check = $_SESSION['temp'];
		
		if ($urinalysis_check == 'yes') {
			$urinalysis_check = 'checked';
			$urinalysis_disabled = '';
		}
		else {
			$urinalysis_check = '';
			$urinalysis_disabled = 'disabled';
		}
		
		
		$stmt = $conn->prepare("SELECT hvs FROM lab_order WHERE lab_order_id='$choosen_lab_order'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$hvs_check = $_SESSION['temp'];
		
		if ($hvs_check == 'yes') {
			$hvs_check = 'checked';
			$hvs_disabled = '';
		}
		else {
			$hvs_check = '';
			$hvs_disabled = 'disabled';
		}
	
	?>
		
 </div>
  
  
	<!-- begining of lab tests card -->
    <div class="accountCard" style="float: left; width: 885px; height: 1250px; position: relative;">
		
		<p class='p'style='color: black;font-weight:100; text-align: center;'>Check the tests that were preformed before providing the results.</p>
		
		<form name="lab_form" action="insert_lab_form.php" onsubmit="return validate_form()" method="post">
			
			<?php
			
				echo "<input type='checkbox' name='bs_for_mps' $bs_for_mps_check disabled/><b>B/S for MPS:</b>
				<input type='radio' id='no_mps' name='mps' value='no mps seen' $bs_for_mps_disabled />No MPS Seen
				<input type='radio' id='mps1' name='mps' value='mps+1' $bs_for_mps_disabled />MPS+1
				<input type='radio' id='mps2' name='mps' value='mps+2' $bs_for_mps_disabled />MPS+2
				<input type='radio' id='mps3' name='mps' value='mps+3' $bs_for_mps_disabled />MPS+3 <br><br>
				
				<input type='checkbox' name='pbf' $pbf_check disabled/> <b>PBF:</b>
				<input type='text' id='pbf_text' name='pbf_text' style='width: 100px; height: 30px;' maxlength='45' $pbf_disabled /> <br><br>
				
				<div style='float: left; width: 350px;'>
					<input type='checkbox' name='widal' $widal_check disabled/> <b>Widal</b> (greater than 80 indicative for Tx) <br>
					TH 1:<input type='number' id='th1' name='th1' style='width: 100px; height: 30px;' maxlength='10' $widal_disabled /><br>
					TH 0:<input type='number' id='th2' name='th2' style='width: 100px; height: 30px;' maxlength='10' $widal_disabled />
				</div>
				
				<div style='float: left; width: 350px;'>
					<input type='checkbox' name='brucella' $brucella_check disabled/> <b>Brucella</b> (Increasing Titers Indicative for Tx) <br>
					BM 1:<input type='number' id='bm1' name='bm1' style='width: 100px; height: 30px;' maxlength='10' $brucella_disabled /><br>
					BA 1:<input type='number' id='ba1' name='ba1' style='width: 100px; height: 30px;' maxlength='10' $brucella_disabled />
				</div>
				<br><br><br><br><br><br>
				
				<input type='checkbox' name='vdrl_rpr'  $vdrl_rpr_check disabled/> <b>VDRL/RPR:</b>
				<input type='radio' id='reactive' name='reactive' value='reactive' $vdrl_rpr_disabled />Reactive
				<input type='radio' id='non_reactive' name='reactive' value='non_reactive' $vdrl_rpr_disabled />Non-Reactive
				
				<br><br>
				
				<input type='checkbox' name='p24_hiv' $p24_hiv_check disabled/> <b>P24/HIV:</b>
				<input type='radio' id='reactive_p24_hiv' name='reactive_p24_hiv' value='reactive' $p24_hiv_disabled />Reactive
				<input type='radio' id='non_reactive_p24_hiv' name='reactive_p24_hiv' value='non_reactive' $p24_hiv_disabled />Non-Reactive
				
				<br><br>
				
				<input type='checkbox' name='blood_sugar' $blood_sugar_check disabled/> <b>Blood Sugar (RBS & FBS):</b>
				<input type='text' id='blood_sugar_text' name='blood_sugar_text' style='width: 200px; height: 30px;' maxlength='30' $blood_sugar_disabled /> (Norm: 3.9 – 7.2mm/L) 
				
				<br><br>
				
				<input type='checkbox' name='stool' $stool_check disabled/> <b>Stool O/C</b><br>
				APP:<input type='text' id='app' name='app' style='width: 100px; height: 30px;' maxlength='45' $stool_disabled /><br>
				MIC:<input type='text' id='mic' name='mic' style='width: 100px; height: 30px;' maxlength='45' $stool_disabled />
					
				<br><br>
					
				<input type='checkbox' name='blood_group' $blood_group_check disabled/><b>Blood Group</b><br>
				<input style='margin-left: 50px;' type='radio' id='rhve_neg' name='rhve' value='rh-ve' $blood_group_disabled />Rh-ve
				<input type='radio' id='rhve_plus' name='rhve' value='rh+ve' $blood_group_disabled />Rh+ve
				<input type='radio' id='a' name='aboab' value='a' $blood_group_disabled />A
				<input type='radio' id='b' name='aboab' value='b' $blood_group_disabled />B
				<input type='radio' id='o' name='aboab' value='o' $blood_group_disabled />O
				<input type='radio' id='ab' name='aboab' value='ab' $blood_group_disabled />AB <br>
				
				<label style='margin-left: 50px;'>DU Test:</label><input  type='text' id='du_test' name='du_test' style='width: 200px; height: 30px;' maxlength='45' $blood_group_disabled /><br><br>
			
				<input type='checkbox' name='pregnancy' $pregnancy_test_check disabled/> <b>Pregnancy Test:</b>
				<input type='radio' id='hcg_detected' name='hcg_detected' value='hcg_detected' $pregnancy_test_disabled />hcG detected
				<input type='radio' id='no_hcg_detected' name='hcg_detected' value='no_hcg_detected' $pregnancy_test_disabled />no hcG detected
				
				<br><br>
				
				<input type='checkbox' name='hb' $hb_check disabled/> <b>Hb:</b>
				<input type='text' id='hb_text' name='hb_text' style='width: 200px; height: 30px;' maxlength='30' $hb_disabled /> (Norm Men: 13.5 – 18g/dL, Norm Women: 11.5 – 16g/dL)
				
				<br><br>
				
				<input type='checkbox' name='urinalysis' $urinalysis_check disabled/><b>Urinalysis</b><br>
				
				<label style='margin-left: 50px; margin-right: 22px;'>Urobilinogen:</label>
				<input style='margin-left: 50px;'  type='radio' id='urobilinogen_neg' name='urobilinogen' value='neg' $urinalysis_disabled />neg
				<input type='radio' id='urobilinogen_plus_neg' name='urobilinogen' value='+-' $urinalysis_disabled />+-
				<input type='radio' id='urobilinogen_plus' name='urobilinogen' value='+' $urinalysis_disabled />+
				<input type='radio' id='urobilinogen_plus2' name='urobilinogen' value='++' $urinalysis_disabled />++
				<input type='radio' id='urobilinogen_plus3' name='urobilinogen' value='+++' $urinalysis_disabled />+++
				
				<br>
				
				<label style='margin-left: 50px; margin-right: 53px;'>Glucose:</label>
				<input style='margin-left: 50px;'  type='radio' id='glucose_neg' name='glucose' value='neg' $urinalysis_disabled />neg
				<input type='radio' id='glucose_plus_neg' name='glucose' value='+-' $urinalysis_disabled />+-
				<input type='radio' id='glucose_plus' name='glucose' value='+' $urinalysis_disabled />+
				<input type='radio' id='glucose_plus2' name='glucose' value='++' $urinalysis_disabled />++
				<input type='radio' id='glucose_plus3' name='glucose' value='+++' $urinalysis_disabled />+++
				
				<br>
				
				<label style='margin-left: 50px; margin-right: 55px;'>Bilirubin:</label>
				<input style='margin-left: 50px;'  type='radio' id='bilirubin_neg' name='bilirubin' value='neg' $urinalysis_disabled />neg
				<input type='radio' id='bilirubin_plus_neg' name='bilirubin' value='+-' $urinalysis_disabled />+-
				<input type='radio' id='bilirubin_plus2' name='bilirubin' value='++' $urinalysis_disabled />++
				<input type='radio' id='bilirubin_plus3' name='bilirubin' value='+++' $urinalysis_disabled />+++
				
				<br>
				
				<label style='margin-left: 50px; margin-right: 53px;'>Ketones:</label>
				<input style='margin-left: 50px;'  type='radio' id='ketones_neg' name='ketones' value='neg' $urinalysis_disabled />neg
				<input type='radio' id='ketones_plus_neg' name='ketones' value='+-' $urinalysis_disabled />+-
				<input type='radio' id='ketones_plus' name='ketones' value='+' $urinalysis_disabled />+
				<input type='radio' id='ketones_plus2' name='ketones' value='++' $urinalysis_disabled />++
				<input type='radio' id='ketones_plus3' name='ketones' value='+++' $urinalysis_disabled />+++
				
				<br>
				
				<label style='margin-left: 50px;'>Specific Gravity:</label>
				<input style='margin-left: 50px;' type='radio' id='specific_gravity_1.000' name='specific_gravity' value='1.000' $urinalysis_disabled />1.000
				<input type='radio' id='specific_gravity_1.005' name='specific_gravity' value='1.005' $urinalysis_disabled />1.005
				<input type='radio' id='specific_gravity_1.010' name='specific_gravity' value='1.010' $urinalysis_disabled />1.010
				<input type='radio' id='specific_gravity_1.015' name='specific_gravity' value='1.015' $urinalysis_disabled />1.015
				<input type='radio' id='specific_gravity_1.020' name='specific_gravity' value='1.020' $urinalysis_disabled />1.020
				<input type='radio' id='specific_gravity_1.025' name='specific_gravity' value='1.025' $urinalysis_disabled />1.025
				<input type='radio' id='specific_gravity_1.030' name='specific_gravity' value='1.030' $urinalysis_disabled />1.030 (Norm 1.006 – 1.016mg/dL)
				
				<br>
				
				<label style='margin-left: 50px; margin-right: 70px;'>Blood:</label>
				<input style='margin-left: 50px;'  type='radio' id='blood_neg' name='blood' value='neg' $urinalysis_disabled />neg
				<input type='radio' id='blood_+' name='blood' value='+' $urinalysis_disabled />+
				<input type='radio' id='blood_++' name='blood' value='++' $urinalysis_disabled />++
				<input type='radio' id='blood_+++' name='blood' value='+++' $urinalysis_disabled />+++
				<input type='radio' id='blood_non-hemolysis' name='blood' value='non_hemolysis' $urinalysis_disabled />non-hemolysis
				
				<br>
				
				<label style='margin-left: 50px; margin-right: 90px;'>pH:</label>
				<input style='margin-left: 50px;'  type='radio' id='ph5' name='ph' value='ph5' $urinalysis_disabled />ph5
				<input type='radio' id='ph6' name='ph' value='6' $urinalysis_disabled />ph6
				<input type='radio' id='ph6.5' name='ph' value='6.5' $urinalysis_disabled />ph6.5
				<input type='radio' id='ph7' name='ph' value='7' $urinalysis_disabled />ph7
				<input type='radio' id='ph8' name='ph' value='8' $urinalysis_disabled />ph8
				<input type='radio' id='ph9' name='ph' value='9' $urinalysis_disabled />ph9 (Norm 6 -7)
				
				<br>
				
				<label style='margin-left: 50px; margin-right: 60px;'>Protein:</label>
				<input style='margin-left: 50px;'  type='radio' id='protein_neg' name='protein' value='neg' $urinalysis_disabled />neg
				<input type='radio' id='protein_trace' name='protein' value='trace' $urinalysis_disabled />trace
				<input type='radio' id='protein_+' name='protein' value='+' $urinalysis_disabled />+
				<input type='radio' id='protein_++' name='protein' value='++' $urinalysis_disabled />++
				<input type='radio' id='protein_+++' name='protein' value='+++' $urinalysis_disabled />+++
				<input type='radio' id='protein_++++' name='protein' value='++++' $urinalysis_disabled />++++
				
				<br>
				
				<label style='margin-left: 50px; margin-right: 70px;'>Nitrite:</label>
				<input style='margin-left: 50px;'  type='radio' id='nitrite_neg' name='nitrite' value='neg' $urinalysis_disabled />neg
				<input type='radio' id='nitrite_trace' name='nitrite' value='trace' $urinalysis_disabled />trace
				<input type='radio' id='nitrite_pos' name='nitrite' value='pos' $urinalysis_disabled />pos
				
				<br>
				
				<label style='margin-left: 50px; margin-right: 30px;'>Leukocytes:</label>
				<input style='margin-left: 50px;'  type='radio' id='leukocytes_neg' name='leukocytes' value='neg' $urinalysis_disabled />neg
				<input type='radio' id='leukocytes_+' name='leukocytes' value='+' $urinalysis_disabled />+
				<input type='radio' id='leukocytes_++' name='leukocytes' value='++' $urinalysis_disabled />++
				<input type='radio' id='leukocytes_+++' name='leukocytes' value='+++' $urinalysis_disabled />+++
				
				<br>
				
				<label style='margin-left: 50px; margin-right: 31px;'>Microscopy: </label><input type='text' id='microscopy' name='microscopy' style='width: 200px; height: 30px;' $urinalysis_disabled /> 
				
				<br><br>
				
				
				<input type='checkbox' name='hvs' $hvs_check disabled/> <b>HVS</b><br>
				Macroscopy:<input type='text' id='macroscopy' name='macroscopy' style='width: 500px; height: 30px;' maxlength='45' $hvs_disabled /><br>
				Microscopy:<input type='text' id='microscopy_hvs' name='microscopy_hvs' style='width: 500px; height: 30px;' maxlength='45' $hvs_disabled /> <br>
				Gram Stain: <br> <textarea rows='6' cols='55' id='gram_stain' name='gram_stain' class='comment_area' maxlength='255' $hvs_disabled ></textarea><br><br>
				
				";
			?>
			
			<div style="width: 200px; margin-left: 335px;">		
				<input type="submit" name="submit_button" class="submitbtn" value="Submit Lab Form">
			</div>
			
		</form>
		
	</div>
	
 </div>
  
</body>
</html>
<!--
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
-->

<?php
require('../database_credentials.php');
require('../file_upload.php');
session_start();


// make sure user is logged in
login_check();


// grab clinician first because the program needs to make sure
// the account exists within the database
$clinician = $_POST['clinician'];

// single quotes need to be replaced with the correct excape keys for the following value
$clinician = str_replace('\'', '\\\'', $clinician);

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

// create database connection
$conn = new PDO($dbconnection, $dbusername, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	
// check to see if an account with the clinician's name exists
$stmt = $conn->prepare("SELECT COUNT(username) FROM accounts WHERE username='$clinician'");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$count = $_SESSION['temp'];


// if the account does not exist
if ($count == 0) {
	
	// notify the user that the account was not found and redirect back to the form creation page
	echo "<script type='text/javascript'>
			alert('Clinician was not found in the database.'); 
			document.location.href = 'select_client_ultrasound.php'; 
		  </script>";
		
}

// if the account exists
else {

	$username = $_SESSION['username'];
	$choosen_client_id = $_SESSION['choosen_client_id'];
	

		// grab the clients first name
		$stmt = $conn->prepare("SELECT first_name FROM general_info WHERE client_id='$choosen_client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$first_name = $_SESSION['temp'];
		
		
		// grab the clients last name
		$stmt = $conn->prepare("SELECT last_name FROM general_info WHERE client_id='$choosen_client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$last_name = $_SESSION['temp'];
		
		
		// grab the clients sex
		$stmt = $conn->prepare("SELECT sex FROM general_info WHERE client_id='$choosen_client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$sex = $_SESSION['temp'];
		
		
		// grab the clients location
		$stmt = $conn->prepare("SELECT location FROM general_info WHERE client_id='$choosen_client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$location = $_SESSION['temp'];
		
		
		// grab the clients date of birth
		$stmt = $conn->prepare("SELECT date_of_birth FROM general_info WHERE client_id='$choosen_client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$date_of_birth = $_SESSION['temp'];
		
		
		// grab the clients age
		$stmt = $conn->prepare("SELECT DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(date_of_birth, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(date_of_birth, '00-%m-%d')) FROM general_info WHERE client_id='$choosen_client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$age = $_SESSION['temp'];
		
		
		

		
// make sure image is acceptible before continuing
	if ($package_path = upload_package('ultrasound_images', 'Ultrasound Images', 'select_client_ultrasound.php', '../../uploaded_images/in_use/ultrasound_images/')) {
		
	// single quotes need to be replaced with the correct excape keys for the following values
	$first_name = str_replace('\'', '\\\'', $first_name);
	$last_name = str_replace('\'', '\\\'', $last_name);
	$location = str_replace('\'', '\\\'', $location);

	// get vital signs
	$t = $_POST['t'];
	$bp = $_POST['bp'];
	$pr = $_POST['pr'];
	$rr = $_POST['rr'];
	$sao2 = $_POST['sao2'];
	$pain = $_POST['pain'];

	// single quotes need to be replaced with the correct excape keys for the following values
	$t = str_replace('\'', '\\\'', $t);
	$bp = str_replace('\'', '\\\'', $bp);
	$rr = str_replace('\'', '\\\'', $rr);

	// get text infomation
	$lmp = $_POST['lmp'];
	$weeks_pregnant = $_POST['weeks_pregnant'];
	$days_pregnant = $_POST['days_pregnant'];
	$edd_per_lmp = date('Y-m-d',strtotime($lmp . "+280 days"));
	$g_lmp = $_POST['g_lmp'];
	$t_lmp = $_POST['t_lmp'];
	$p_lmp = $_POST['p_lmp'];
	$l_lmp = $_POST['l_lmp'];
	
	$significant_history = $_POST['significant_history'];
	$ultrasound_findings = $_POST['ultrasound_findings'];
	$fetal_number = $_POST['fetal_number'];

	
	$presentation_baby_1 = $_POST['presentation_baby_1'];
	$placenta_baby_1 = $_POST['placenta_baby_1'];
	$fetal_movement_baby_1 = $_POST['fetal_movement_baby_1'];
	$fetal_heartbeat_baby_1 = $_POST['fetal_heartbeat_baby_1'];
	$amniotic_fluid_baby_1 = $_POST['amniotic_fluid_baby_1'];
	
	$presentation_baby_2 = $_POST['presentation_baby_2'];
	$placenta_baby_2 = $_POST['placenta_baby_2'];
	$fetal_movement_baby_2 = $_POST['fetal_movement_baby_2'];
	$fetal_heartbeat_baby_2 = $_POST['fetal_heartbeat_baby_2'];
	$amniotic_fluid_baby_2 = $_POST['amniotic_fluid_baby_2'];
	
	$presentation_baby_3 = $_POST['presentation_baby_3'];
	$placenta_baby_3 = $_POST['placenta_baby_3'];
	$fetal_movement_baby_3 = $_POST['fetal_movement_baby_3'];
	$fetal_heartbeat_baby_3 = $_POST['fetal_heartbeat_baby_3'];
	$amniotic_fluid_baby_3 = $_POST['amniotic_fluid_baby_3'];
	
	$presentation_baby_4 = $_POST['presentation_baby_4'];
	$placenta_baby_4 = $_POST['placenta_baby_4'];
	$fetal_movement_baby_4 = $_POST['fetal_movement_baby_4'];
	$fetal_heartbeat_baby_4 = $_POST['fetal_heartbeat_baby_4'];
	$amniotic_fluid_baby_4 = $_POST['amniotic_fluid_baby_4'];
	
	
	$edd_per_ultrasound = $_POST['edd_per_ultrasound'];
	$other_findings = $_POST['other_findings'];
	
	// single quotes need to be replaced with the correct excape keys for the following values
	$significant_history = str_replace('\'', '\\\'', $significant_history);
	$other_findings = str_replace('\'', '\\\'', $other_findings);


	try {
		
		// below is the insert query
		$query = "INSERT INTO ultrasound (client_id, first_name, last_name, sex, location, date_of_birth, t, bp, pr, rr, sao2, pain, lmp, weeks_pregnant, days_pregnant, edd_per_lmp, g_lmp, t_lmp, p_lmp, l_lmp, significant_history, ultrasound_findings, fetal_number, edd_per_ultrasound, other_findings, package_path, clinician, created_by) VALUES ('$choosen_client_id', '$first_name', '$last_name', '$sex', '$location', '$date_of_birth', '$t', '$bp', '$pr', '$rr', '$sao2', '$pain', '$lmp', '$weeks_pregnant', '$days_pregnant', '$edd_per_lmp', '$g_lmp', '$t_lmp', '$p_lmp', '$l_lmp', '$significant_history', '$ultrasound_findings', '$fetal_number', '$edd_per_ultrasound', '$other_findings', '$package_path', '$clinician', '$username');"; 
		$conn->exec($query);
		
		$stmt = $conn->prepare("SELECT LAST_INSERT_ID();");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$ultrasound_id = $_SESSION['temp'];
		
		// insert babys if they exist
		if ($presentation_baby_1 != 'none'){
			$query = "INSERT INTO baby (ultrasound_id, client_id, first_name, last_name, sex, location, date_of_birth, baby_number, presentation, placenta, fetal_movement, fetal_heartbeat, amniotic_fluid, clinician, created_by) VALUES ('$ultrasound_id', '$choosen_client_id', '$first_name', '$last_name', '$sex', '$location', '$date_of_birth', '1', '$presentation_baby_1', '$placenta_baby_1', '$fetal_movement_baby_1', '$fetal_heartbeat_baby_1', '$amniotic_fluid_baby_1', '$clinician', '$username');"; 
			$conn->exec($query);
		}
		
		if ($presentation_baby_2 != 'none'){
			$query = "INSERT INTO baby (ultrasound_id, client_id, first_name, last_name, sex, location, date_of_birth, baby_number, presentation, placenta, fetal_movement, fetal_heartbeat, amniotic_fluid, clinician, created_by) VALUES ('$ultrasound_id', '$choosen_client_id', '$first_name', '$last_name', '$sex', '$location', '$date_of_birth', '2', '$presentation_baby_2', '$placenta_baby_2', '$fetal_movement_baby_2', '$fetal_heartbeat_baby_2', '$amniotic_fluid_baby_2', '$clinician', '$username');"; 
			$conn->exec($query);
		}
		
		if ($presentation_baby_3 != 'none'){
			$query = "INSERT INTO baby (ultrasound_id, client_id, first_name, last_name, sex, location, date_of_birth, baby_number, presentation, placenta, fetal_movement, fetal_heartbeat, amniotic_fluid, clinician, created_by) VALUES ('$ultrasound_id', '$choosen_client_id', '$first_name', '$last_name', '$sex', '$location', '$date_of_birth', '3', '$presentation_baby_3', '$placenta_baby_3', '$fetal_movement_baby_3', '$fetal_heartbeat_baby_3', '$amniotic_fluid_baby_3', '$clinician', '$username');"; 
			$conn->exec($query);
		}
		
		if ($presentation_baby_4 != 'none'){
			$query = "INSERT INTO baby (ultrasound_id, client_id, first_name, last_name, sex, location, date_of_birth, baby_number, presentation, placenta, fetal_movement, fetal_heartbeat, amniotic_fluid, clinician, created_by) VALUES ('$ultrasound_id', '$choosen_client_id', '$first_name', '$last_name', '$sex', '$location', '$date_of_birth', '4', '$presentation_baby_4', '$placenta_baby_4', '$fetal_movement_baby_4', '$fetal_heartbeat_baby_4', '$amniotic_fluid_baby_4', '$clinician', '$username');"; 
			$conn->exec($query);
		}
		
		
		// redirect user back to discharge form selection
		header( 'Location: select_client_ultrasound.php');
		exit();
		
	}

	catch(PDOException $e) {
		create_database_error($query, 'insert_ultrasound.php', $e->getMessage());	
	}

	$conn = null;
	}
}
<!--
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
-->

<?php
require('../../database_credentials.php');
session_start();


// make sure user is logged in
login_check();

$choosen_treatment_form_id = $_SESSION['choosen_treatment_form_id'];

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
			document.location.href = 'add_treatment_form.php'; 
		  </script>";
		
}

// if the account exists
else {

	$username = $_SESSION['username'];

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

	// get text infomation
	$history = $_POST['history'];
	$physical_examination = $_POST['physical_examination'];
	$impression = $_POST['impression'];
	$plan = $_POST['plan'];
	$health_education = $_POST['health_education'];


	// single quotes need to be replaced with the correct excape keys for the following values
	$history = str_replace('\'', '\\\'', $history);
	$physical_examination = str_replace('\'', '\\\'', $physical_examination);
	$impression = str_replace('\'', '\\\'', $impression);
	$plan = str_replace('\'', '\\\'', $plan);
	$health_education = str_replace('\'', '\\\'', $health_education);
	
	
	$stmt = $conn->prepare("SELECT t FROM treatment WHERE treatment_id='$choosen_treatment_form_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	echo $t_check = $_SESSION['temp'];
	
	
	
	$stmt = $conn->prepare("SELECT bp FROM treatment WHERE treatment_id='$choosen_treatment_form_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	echo $bp_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT pr FROM treatment WHERE treatment_id='$choosen_treatment_form_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	echo $pr_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT rr FROM treatment WHERE treatment_id='$choosen_treatment_form_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	echo $rr_check = $_SESSION['temp'];
	
	
	
	$stmt = $conn->prepare("SELECT sao2 FROM treatment WHERE treatment_id='$choosen_treatment_form_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	echo $sao2_check = $_SESSION['temp'];
	
	$stmt = $conn->prepare("SELECT pain FROM treatment WHERE treatment_id='$choosen_treatment_form_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	echo $pain_check = $_SESSION['temp'];
	
	
	
	$stmt = $conn->prepare("SELECT history FROM treatment WHERE treatment_id='$choosen_treatment_form_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	echo $history_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT physical_examination FROM treatment WHERE treatment_id='$choosen_treatment_form_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	echo $physical_examination_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT impression FROM treatment WHERE treatment_id='$choosen_treatment_form_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	echo $impression_check = $_SESSION['temp'];
	
	$stmt = $conn->prepare("SELECT plan FROM treatment WHERE treatment_id='$choosen_treatment_form_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	echo $plan_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT health_education FROM treatment WHERE treatment_id='$choosen_treatment_form_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	echo $health_education_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT clinician FROM treatment WHERE treatment_id='$choosen_treatment_form_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	echo $clinician_check = $_SESSION['temp'];
	


	try {
		
		if ($t != $t_check or $bp != $bp_check or $pr != $pr_check or $rr != $rr_check or $sao2 != $sao2_check or $pain != $pain_check or $history != $history_check or $physical_examination != $physical_examination_check or $impression != $impression_check or $plan != $plan_check or $health_education != $health_education_check or $clinician != $clinician_check ) {
			
			// below is the insert query
			$query = "INSERT INTO treatment_history (treatment_id, client_id, first_name, last_name, sex, location, date_of_birth, t, bp, pr, rr, sao2, pain, history, physical_examination, impression, plan, health_education, timestamp, created_by, clinician) SELECT treatment_id, client_id, first_name, last_name, sex, location, date_of_birth, t, bp, pr, rr, sao2, pain, history, physical_examination, impression, plan, health_education, timestamp, created_by, clinician FROM treatment WHERE treatment_id='$choosen_treatment_form_id';"; 
			$conn->exec($query);
		
			// below is the insert query
			$query = "UPDATE treatment SET t='$t', bp='$bp', pr='$pr', rr='$rr', sao2='$sao2', pain='$pain', history='$history', physical_examination='$physical_examination', impression='$impression', plan='$plan', health_education='$health_education', created_by='$username', clinician='$clinician' WHERE treatment_id='$choosen_treatment_form_id';"; 
			$conn->exec($query);
		}
		
		// redirect user back to discharge form selection
		header( 'Location: change_treatment_form_diagnoses.php');
		exit();
		
	}

	catch(PDOException $e) {
		create_database_error($query, 'update_treatment_form.php', $e->getMessage());
	}

	$conn = null;

}
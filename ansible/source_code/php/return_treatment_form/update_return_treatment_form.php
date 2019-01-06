<!--
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
-->

<?php
require('../database_credentials.php');
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
			document.location.href = 'select_return_treatment_form.php'; 
		  </script>";
		
}

// if the account exists
else {
	$choosen_return_treatment_form_id = $_SESSION['choosen_return_treatment_form_id'];
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
	$rr = str_replace('\'', '\\\'', $rr);

	// get text infomation
	$notes = $_POST['notes'];
	$plan = $_POST['plan'];


	// single quotes need to be replaced with the correct excape keys for the following values
	$notes = str_replace('\'', '\\\'', $notes);
	$plan = str_replace('\'', '\\\'', $plan);
	
	$stmt = $conn->prepare("SELECT t FROM return_treatment WHERE return_treatment_id='$choosen_return_treatment_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$t_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT bp FROM return_treatment WHERE return_treatment_id='$choosen_return_treatment_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$bp_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT pr FROM return_treatment WHERE return_treatment_id='$choosen_return_treatment_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$pr_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT rr FROM return_treatment WHERE return_treatment_id='$choosen_return_treatment_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$rr_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT sao2 FROM return_treatment WHERE return_treatment_id='$choosen_return_treatment_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$sao2_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT pain FROM return_treatment WHERE return_treatment_id='$choosen_return_treatment_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$pain_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT notes FROM return_treatment WHERE return_treatment_id='$choosen_return_treatment_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$notes_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT plan FROM return_treatment WHERE return_treatment_id='$choosen_return_treatment_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$plan_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT clinician FROM return_treatment WHERE return_treatment_id='$choosen_return_treatment_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$clinician_check = $_SESSION['temp'];


	try {
		
		if ($t != $t_check or $bp != $bp_check or $pr != $pr_check or $rr != $rr_check or $sao2 != $sao2_check or $pain != $pain_check or $notes != $notes_check or $plan != $plan_check or $clinician != $clinician_check) {
			
			$query = "INSERT INTO return_treatment_history (return_treatment_id, client_id, first_name, last_name, sex, location, date_of_birth, t, bp, pr, rr, sao2, pain, notes, plan, timestamp, clinician, created_by) SELECT return_treatment_id, client_id, first_name, last_name, sex, location, date_of_birth, t, bp, pr, rr, sao2, pain, notes, plan, timestamp, clinician, created_by FROM return_treatment WHERE return_treatment_id='$choosen_return_treatment_form_id';"; 
			$conn->exec($query);
			
			// below is the update query
			$query = "UPDATE return_treatment SET t='$t', bp='$bp', pr='$pr', sao2='$sao2', rr='$rr', pain='$pain',  notes='$notes', plan='$plan', created_by='$username', clinician='$clinician' WHERE return_treatment_id='$choosen_return_treatment_form_id';"; 
			$stmt = $conn->prepare($query);
			$stmt->execute();
		
		}
		
		// redirect user back to where they can select a referral form
		header( 'Location: change_return_treatment_form_diagnoses.php');
		exit();
	}

	catch(PDOException $e) {
		create_database_error($query, 'update_return_treatment_form.php', $e->getMessage());
	}

		$conn = null;

	}
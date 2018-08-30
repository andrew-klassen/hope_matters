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
			document.location.href = 'select_discharge_form.php'; 
		  </script>";
		
}

// if the account exists
else {
	$choosen_discharge_form_id = $_SESSION['choosen_discharge_form_id'];
	$username = $_SESSION['username'];

	// get the vital signs
	$t = $_POST['t'];
	$bp = $_POST['bp'];
	$pr = $_POST['pr'];
	$sao2 = $_POST['sao2'];
	$pain = $_POST['pain'];
	
	// single quotes need to be replaced with the correct excape keys for the following values
	$t = str_replace('\'', '\\\'', $t);
	$bp = str_replace('\'', '\\\'', $bp);
	
	// get the text info
	$doa = $_POST['doa'];
	$dod = $_POST['dod'];
	$history = $_POST['history'];
	$physical_examination = $_POST['physical_examination'];
	$impression = $_POST['impression'];
	$plan = $_POST['plan'];
	$discharge_summary = $_POST['discharge_summary'];

	// single quotes need to be replaced with the correct excape keys for the following values
	$doa = str_replace('\'', '\\\'', $doa);
	$dod = str_replace('\'', '\\\'', $dod);
	$history = str_replace('\'', '\\\'', $history);
	$physical_examination = str_replace('\'', '\\\'', $physical_examination);
	$impression = str_replace('\'', '\\\'', $impression);
	$plan = str_replace('\'', '\\\'', $plan);
	$discharge_summary = str_replace('\'', '\\\'', $discharge_summary);
	
	
	$stmt = $conn->prepare("SELECT t FROM discharge_form WHERE discharge_form_id='$choosen_discharge_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$t_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT bp FROM discharge_form WHERE discharge_form_id='$choosen_discharge_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$bp_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT pr FROM discharge_form WHERE discharge_form_id='$choosen_discharge_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$pr_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT sao2 FROM discharge_form WHERE discharge_form_id='$choosen_discharge_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$sao2_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT pain FROM discharge_form WHERE discharge_form_id='$choosen_discharge_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$pain_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT doa FROM discharge_form WHERE discharge_form_id='$choosen_discharge_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$doa_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT dod FROM discharge_form WHERE discharge_form_id='$choosen_discharge_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$dod_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT history FROM discharge_form WHERE discharge_form_id='$choosen_discharge_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$history_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT physical_examination FROM discharge_form WHERE discharge_form_id='$choosen_discharge_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$physical_examination_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT impression FROM discharge_form WHERE discharge_form_id='$choosen_discharge_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$impression_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT plan FROM discharge_form WHERE discharge_form_id='$choosen_discharge_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$plan_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT discharge_summary FROM discharge_form WHERE discharge_form_id='$choosen_discharge_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$discharge_summary_check = $_SESSION['temp'];
	
	$stmt = $conn->prepare("SELECT clinician FROM discharge_form WHERE discharge_form_id='$choosen_discharge_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$clinician_check = $_SESSION['temp'];
	


	try {
		// make sure user has made a change
		if ($t != $t_check or $bp != $bp_check or $pr != $pr_check or $sao2 != $sao2_check or $pain != $pain_check or $doa != $doa_check  or $dod != $dod_check or $history != $history_check or $physical_examination != $physical_examination_check or $impression != $impression_check or $plan != $plan_check or $discharge_summary != $discharge_summary_check or $clinician != $clinician_check) {
			
			$query = "INSERT INTO discharge_form_history (discharge_form_id, client_id, first_name, last_name, sex, location, date_of_birth, t, bp, pr, sao2, pain, doa, dod, history, physical_examination, impression, plan, discharge_summary, timestamp, clinician, created_by) SELECT discharge_form_id, client_id, first_name, last_name, sex, location, date_of_birth, t, bp, pr, sao2, pain, doa, dod, history, physical_examination, impression, plan, discharge_summary, timestamp, clinician, created_by FROM discharge_form WHERE discharge_form_id='$choosen_discharge_form_id';"; 
			$conn->exec($query);
			
			// below is the update query
			$sql = "UPDATE discharge_form SET t='$t', bp='$bp', pr='$pr', sao2='$sao2', pain='$pain', dod='$dod', doa='$doa', history='$history', physical_examination='$physical_examination',  impression='$impression', plan='$plan', discharge_summary='$discharge_summary', created_by='$username', clinician='$clinician' WHERE discharge_form_id='$choosen_discharge_form_id';"; 
			$stmt = $conn->prepare($sql);
			$stmt->execute();
		
		}
		
		// redirect user back to where they can select a discharge form
		header( 'Location: select_discharge_form.php');
		exit();
	}

	catch(PDOException $e) {
		create_database_error($query, 'update_discharge_form.php', $e->getMessage());
	}

		$conn = null;

}
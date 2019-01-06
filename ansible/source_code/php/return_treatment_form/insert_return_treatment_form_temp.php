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
			document.location.href = 'add_treatment_form.php'; 
		  </script>";
		
}

// if the account exists
else {

$username = $_SESSION['username']; if (isset($_POST['username'])) {$username = $_POST['username'];}

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
	$notes = $_POST['notes'];
	$plan = $_POST['plan'];
	
	// single quotes need to be replaced with the correct excape keys for the following values
	$notes = str_replace('\'', '\\\'', $notes);
	$plan = str_replace('\'', '\\\'', $plan);
	
	
	try {
		
		$query = "DELETE FROM return_treatment_temp WHERE created_by='$username';"; 
		$conn->exec($query);
		
		
		// below is the insert query
		$query = "INSERT INTO return_treatment_temp (t, bp, pr, rr, sao2, pain, notes, plan, created_by, clinician) VALUES ('$t', '$bp', '$pr', '$rr','$sao2', '$pain', '$notes', '$plan', '$username', '$clinician');"; 
		$conn->exec($query);
		
		// redirect user back to discharge form selection
		header( 'Location: add_return_treatment_form_diagnoses.php');
		exit();
		
	}

	catch(PDOException $e) {
		create_database_error($query, 'insert_return_treatment_form_temp.php', $e->getMessage());	
	}

	$conn = null;

}
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
			document.location.href = 'add_referral_form.php'; 
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
	$referred_to = $_POST['referred_to'];
	$history = $_POST['history'];
	$treatment = $_POST['treatment'];
	$reason_for_referral = $_POST['reason_for_referral'];


	// single quotes need to be replaced with the correct excape keys for the following values
	$referred_to = str_replace('\'', '\\\'', $referred_to);
	$history = str_replace('\'', '\\\'', $history);
	$treatment = str_replace('\'', '\\\'', $treatment);
	$reason_for_referral = str_replace('\'', '\\\'', $reason_for_referral);


	try {
		
		// below is the insert query
		$query = "INSERT INTO referral_form (client_id, first_name, last_name, sex, location, date_of_birth, t, bp, pr, sao2, rr, pain, referred_to, history, treatment, reason_for_referral, created_by, clinician) VALUES ('$choosen_client_id', '$first_name', '$last_name', '$sex', '$location', '$date_of_birth', '$t', '$bp', '$pr', '$sao2', '$rr', '$pain', '$referred_to', '$history', '$treatment', '$reason_for_referral', '$username', '$clinician');"; 
		$conn->exec($query);
		
		// redirect user back to discharge form selection
		header( 'Location: /php/view_change_any_client_forms/view_all_form.php');
		exit();
		
	}

	catch(PDOException $e) {
		create_database_error($query, 'insert_referral_form.php (client)', $e->getMessage());
	}

	$conn = null;

}
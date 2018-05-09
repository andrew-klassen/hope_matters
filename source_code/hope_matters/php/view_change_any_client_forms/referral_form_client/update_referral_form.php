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
			document.location.href = 'select_referral_form.php'; 
		  </script>";
		
}

// if the account exists
else {
	$choosen_referral_form_id = $_SESSION['choosen_referral_form_id'];
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
	$referred_to = $_POST['referred_to'];
	$history = $_POST['history'];
	$treatment = $_POST['treatment'];
	$reason_for_referral = $_POST['reason_for_referral'];


	// single quotes need to be replaced with the correct excape keys for the following values
	$referred_to = str_replace('\'', '\\\'', $referred_to);
	$history = str_replace('\'', '\\\'', $history);
	$treatment = str_replace('\'', '\\\'', $treatment);
	$reason_for_referral = str_replace('\'', '\\\'', $reason_for_referral);
	
	
	$stmt = $conn->prepare("SELECT referred_to FROM referral_form WHERE referral_form_id='$choosen_referral_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$referred_to_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT t FROM referral_form WHERE referral_form_id='$choosen_referral_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$t_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT bp FROM referral_form WHERE referral_form_id='$choosen_referral_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$bp_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT pr FROM referral_form WHERE referral_form_id='$choosen_referral_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$pr_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT rr FROM referral_form WHERE referral_form_id='$choosen_referral_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$rr_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT sao2 FROM referral_form WHERE referral_form_id='$choosen_referral_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$sao2_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT pain FROM referral_form WHERE referral_form_id='$choosen_referral_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$pain_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT history FROM referral_form WHERE referral_form_id='$choosen_referral_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$history_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT treatment FROM referral_form WHERE referral_form_id='$choosen_referral_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$treatment_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT reason_for_referral FROM referral_form WHERE referral_form_id='$choosen_referral_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$reason_for_referral_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT clinician FROM referral_form WHERE referral_form_id='$choosen_referral_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$clinician_check = $_SESSION['temp'];


	try {
		
		if ($referred_to != $referred_to_check or $t != $t_check or $bp != $bp_check or $pr != $pr_check or $rr != $rr_check or $sao2 != $sao2_check or $pain != $pain_check or $history != $history_check or $treatment != $treatment_check or $reason_for_referral != $reason_for_referral_check or $clinician != $clinician_check) {
		
			$query = "INSERT INTO referral_form_history (referral_form_id, client_id, first_name, last_name, sex, location, date_of_birth, referred_to, t, bp, pr, rr, sao2, pain, history, treatment, reason_for_referral, timestamp, clinician, created_by) SELECT referral_form_id, client_id, first_name, last_name, sex, location, date_of_birth, referred_to, t, bp, pr, rr, sao2, pain, history, treatment, reason_for_referral, timestamp, clinician, created_by FROM referral_form WHERE referral_form_id='$choosen_referral_form_id';"; 
			$conn->exec($query);
		
			// below is the update query
			$sql = "UPDATE referral_form SET t='$t', bp='$bp', pr='$pr', sao2='$sao2', rr='$rr', pain='$pain', referred_to='$referred_to', history='$history', treatment='$treatment', reason_for_referral='$reason_for_referral', created_by='$username', clinician='$clinician' WHERE referral_form_id='$choosen_referral_form_id';"; 
			$stmt = $conn->prepare($sql);
			$stmt->execute();
		
		}
		
		// redirect user back to client overview
		header( 'Location: /php/view_change_any_client_forms/view_all_form.php');
		exit();
	}

	catch(PDOException $e) {
		create_database_error($query, 'update_referral_form.php (client)', $e->getMessage());
	}

		$conn = null;

}
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

$username = $_SESSION['username']; if (isset($_POST['username'])) {$username = $_POST['username'];}
$choosen_client_id = $_SESSION['choosen_client_id']; if (isset($_POST['choosen_client_id'])) {$choosen_client_id = $_POST['choosen_client_id'];}


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

	
		$stmt = $conn->prepare("SELECT t FROM return_treatment_temp WHERE created_by='$username'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$t = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT bp FROM return_treatment_temp WHERE created_by='$username'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$bp = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT pr FROM return_treatment_temp WHERE created_by='$username'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$pr = $_SESSION['temp'];

		
		$stmt = $conn->prepare("SELECT rr FROM return_treatment_temp WHERE created_by='$username'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$rr = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT sao2 FROM return_treatment_temp WHERE created_by='$username'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$sao2 = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT pain FROM return_treatment_temp WHERE created_by='$username'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$pain = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT notes FROM return_treatment_temp WHERE created_by='$username'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$notes = $_SESSION['temp'];
		
		
		
		$stmt = $conn->prepare("SELECT plan FROM return_treatment_temp WHERE created_by='$username'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$plan = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT clinician FROM return_treatment_temp WHERE created_by='$username'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$clinician = $_SESSION['temp'];
		
		
		
	// single quotes need to be replaced with the correct excape keys for the following values
	$t = str_replace('\'', '\\\'', $t);
	$bp = str_replace('\'', '\\\'', $bp);
		
	// single quotes need to be replaced with the correct excape keys for the following values
	$notes = str_replace('\'', '\\\'', $notes);
	$plan = str_replace('\'', '\\\'', $plan);
		


	try {
		
		// below is the insert query
		$query = "INSERT INTO return_treatment (client_id, first_name, last_name, sex, location, date_of_birth, t, bp, pr, rr, sao2, pain, notes, plan, created_by, clinician) VALUES ('$choosen_client_id', '$first_name', '$last_name', '$sex', '$location', '$date_of_birth', '$t', '$bp', '$pr', '$rr', '$sao2', '$pain', '$notes', '$plan', '$username', '$clinician');"; 
		$conn->exec($query);
		
		
		$stmt = $conn->prepare("SELECT LAST_INSERT_ID();");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$form_id = $_SESSION['temp'];
		
		
		// keep inserting diagnoses until there are no more
		do {
			
			// get diagnoses count
			$stmt = $conn->prepare("SELECT COUNT(*) FROM diagnoses_temp WHERE created_by='$username' AND form_type='return_treatment';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

			}
			$count = $_SESSION['temp'];
			
			if ($count) {
		
				$stmt = $conn->prepare("SELECT diagnosis FROM diagnoses_temp WHERE created_by='$username' AND form_type='return_treatment' LIMIT 1;");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$current_diagnosis = $_SESSION['temp'];
			
			
				$query = "INSERT INTO diagnoses (client_id, first_name, last_name, sex, location, date_of_birth, form_id, diagnosis, created_by, clinician, form_type) VALUES ('$choosen_client_id', '$first_name', '$last_name', '$sex', '$location', '$date_of_birth', '$form_id', '$current_diagnosis', '$username', '$clinician', 'return_treatment');"; 
				$conn->exec($query);
				
				$query = "DELETE FROM diagnoses_temp WHERE diagnosis='$current_diagnosis' AND created_by='$username' AND form_type='return_treatment';"; 
				$conn->exec($query);
				
			}
			else {
				break;
			}
			
		} while(1);
		
		
		$query = "DELETE FROM return_treatment_temp WHERE created_by='$username';"; 
		$conn->exec($query);
		
		
		// redirect user back to discharge form selection
		header( 'Location: select_client_return_treatment_form.php');
		exit();
		
	}

	catch(PDOException $e) {
		create_database_error($query, 'insert_return_treatment_form.php', $e->getMessage());	
	}

	$conn = null;
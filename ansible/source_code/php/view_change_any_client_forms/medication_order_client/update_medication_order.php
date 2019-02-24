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
	
	



	$choosen_medication_order_id = $_SESSION['choosen_medication_order_id'];
	$username = $_SESSION['username'];

	// get vital signs
	$medication = $_POST['medication'];
	$dosage = $_POST['dosage'];
	$frequency = $_POST['frequency'];
	$administration_method = $_POST['administration_method'];
	$notes = $_POST['notes'];
	

	// single quotes need to be replaced with the correct excape keys for the following values
	$medication = str_replace('\'', '\\\'', $medication);
	$dosage = str_replace('\'', '\\\'', $dosage);
	$frequency = str_replace('\'', '\\\'', $frequency);
	$notes = str_replace('\'', '\\\'', $notes);
	
	
	
	$stmt = $conn->prepare("SELECT medication FROM medication_order WHERE medication_order_id='$choosen_medication_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$medication_check = $_SESSION['temp'];


	$stmt = $conn->prepare("SELECT dosage FROM medication_order WHERE medication_order_id='$choosen_medication_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$dosage_check = $_SESSION['temp'];



	$stmt = $conn->prepare("SELECT frequency FROM medication_order WHERE medication_order_id='$choosen_medication_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$frequency_check = $_SESSION['temp'];


	$stmt = $conn->prepare("SELECT administration_method FROM medication_order WHERE medication_order_id='$choosen_medication_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$administration_method_check = $_SESSION['temp'];


	$stmt = $conn->prepare("SELECT notes FROM medication_order WHERE medication_order_id='$choosen_medication_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$notes_check = $_SESSION['temp'];
	
echo $medication . '</br>';
echo $medication_check . '</br>' . '</br>';




	try {
		
		if ($medication != $medication_check or $dosage != $dosage_check or $frequency != $frequency_check or $administration_method != $administration_method_check or $notes != $notes_check) {
		
			$query = "INSERT INTO medication_order_history 
(medication_order_id, client_id, first_name, last_name, sex, location, date_of_birth, medication, dosage, frequency, administration_method, notes, open, finished_by, timestamp, created_by ) 
SELECT medication_order_id, client_id, first_name, last_name, sex, location, date_of_birth, medication, dosage, frequency, administration_method, notes, open, finished_by, timestamp, created_by 
FROM medication_order WHERE medication_order_id='$choosen_medication_order_id';"; 
			$conn->exec($query);
		
			// below is the update query
			$sql = "UPDATE medication_order SET medication='$medication', dosage='$dosage', frequency='$frequency', administration_method='$administration_method', notes='$notes' WHERE medication_order_id='$choosen_medication_order_id';"; 
			$stmt = $conn->prepare($sql);
			$stmt->execute();
		
		}
		
		
		header( 'Location: ../view_all_form.php');
		exit();
	}

	catch(PDOException $e) {
		create_database_error($query, 'update_medication_order.php', $e->getMessage());
	}

		$conn = null;






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


$username = $_SESSION['username'];

// grab all the varibles using post methods
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$date_of_birth = $_POST['date_of_birth'];
$guardian_name = $_POST['guardian_name'];
$national_id = $_POST['national_id'];
$phone_number = $_POST['phone_number'];
$occupation = $_POST['occupation'];
$education = $_POST['education'];
$location = $_POST['location'];
$contact = $_POST['contact'];
$allergies = $_POST['allergies'];
$hiv_status = $_POST['hiv_status'];
$alcohol_use = $_POST['alcohol_use'];
$gender = $_POST['gender'];
$medical_history = $_POST['medical_history'];
$regular_medications = $_POST['regular_medications'];

// repace all single quotes in the strings with \' so that the strings will not throw off the database
$first_name = str_replace('\'', '\\\'', $first_name);
$last_name = str_replace('\'', '\\\'', $last_name);
$date_of_birth = str_replace('\'', '\\\'', $date_of_birth);
$guardian_name = str_replace('\'', '\\\'', $guardian_name);
$national_id = str_replace('\'', '\\\'', $national_id);
$phone_number = str_replace('\'', '\\\'', $phone_number);
$occupation = str_replace('\'', '\\\'', $occupation);
$education = str_replace('\'', '\\\'', $education);
$location = str_replace('\'', '\\\'', $location);
$contact = str_replace('\'', '\\\'', $contact);
$allergies = str_replace('\'', '\\\'', $allergies);
$medical_history = str_replace('\'', '\\\'', $medical_history);
$regular_medications = str_replace('\'', '\\\'', $regular_medications);

$submit_button = $_POST['submit_button'];


try {
	// establish database connection
    $conn = new PDO($dbconnection, $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	//below is the insert query
    $query = "INSERT INTO general_info (first_name, last_name, sex, location, phone_number, date_of_birth, national_id, guardian_name, occupation, education, emergency_contact, allergies, hiv_status, alcohol_use, medical_history, regular_medications, created_by) 
			  VALUES ('$first_name', '$last_name', '$gender', '$location', '$phone_number', '$date_of_birth',   '$national_id', '$guardian_name', '$occupation', '$education',  '$contact', '$allergies', '$hiv_status', '$alcohol_use', '$medical_history', '$regular_medications', '$username' );"; 
    $conn->exec($query);
	
	// see if client needs to be checked in
	if ($submit_button == 'Add and Check In') {
	
		// get id of the client that was just created
		$stmt = $conn->prepare("SELECT LAST_INSERT_ID();");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
		}
		$client_id = $_SESSION['temp'];
		
		// check in the client
		$query = "INSERT INTO current_clients (client_id, first_name, last_name, sex, location, date_of_birth, check_in, created_by) VALUES ('$client_id', '$first_name', '$last_name', '$gender', '$location', '$date_of_birth', NOW(), '$username');"; 
		$conn->exec($query);
	}
		
	// redirect back to add_client.html
	header( 'Location: /html/add_client.html' );
	exit();
}

catch(PDOException $e) {
	create_database_error($query, 'insert_client.php', $e->getMessage());	
}

$conn = null;
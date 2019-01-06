<!--
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
-->

<?php
require('../database_credentials.php');
session_start();

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

$choosen_client_id = $_SESSION['choosen_client_id'];
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
$emergency_contact = $_POST['contact'];
$allergies = $_POST['allergies'];
$hiv_status = $_POST['hiv_status'];
$alcohol_use = $_POST['alcohol_use']; 
$sex = $_POST['gender']; 
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



try {
	
	// make database connection
    $conn = new PDO($dbconnection, $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	
	// grab all current values from database
	$stmt = $conn->prepare("SELECT first_name FROM general_info WHERE client_id='$choosen_client_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$first_name_check = $_SESSION['temp'];
		
		
	$stmt = $conn->prepare("SELECT last_name FROM general_info WHERE client_id='$choosen_client_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$last_name_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT date_of_birth FROM general_info WHERE client_id='$choosen_client_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$date_of_birth_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT guardian_name FROM general_info WHERE client_id='$choosen_client_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$guardian_name_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT national_id FROM general_info WHERE client_id='$choosen_client_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$national_id_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT phone_number FROM general_info WHERE client_id='$choosen_client_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$phone_number_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT occupation FROM general_info WHERE client_id='$choosen_client_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$occupation_check = $_SESSION['temp'];
	
	$stmt = $conn->prepare("SELECT education FROM general_info WHERE client_id='$choosen_client_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$education_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT location FROM general_info WHERE client_id='$choosen_client_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$location_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT emergency_contact FROM general_info WHERE client_id='$choosen_client_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$emergency_contact_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT allergies FROM general_info WHERE client_id='$choosen_client_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$allergies_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT hiv_status FROM general_info WHERE client_id='$choosen_client_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$hiv_status_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT alcohol_use FROM general_info WHERE client_id='$choosen_client_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$alcohol_use_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT sex FROM general_info WHERE client_id='$choosen_client_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$sex_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT medical_history FROM general_info WHERE client_id='$choosen_client_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$medical_history_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT regular_medications FROM general_info WHERE client_id='$choosen_client_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$regular_medications_check = $_SESSION['temp'];

	
	// make sure user actually made a change
	if ($first_name != $first_name_check or $last_name != $last_name_check or $sex != $sex_check or $location != $location_check or $date_of_birth != $date_of_birth_check or $national_id != $national_id_check or $guardian_name != $guardian_name_check or $phone_number != $phone_number_check or $occupation != $occupation_check or $education != $education_check or $emergency_contact != $emergency_contact_check or $allergies != $allergies_check or $hiv_status != $hiv_status_check or $alcohol_use != $alcohol_use_check or $medical_history != $medical_history_check or $regular_medications != $regular_medications_check) {
		
		// archive clients old information
		$query = "INSERT INTO general_info_history (client_id, first_name, last_name, sex, location, date_of_birth, national_id, guardian_name, phone_number, occupation, education, emergency_contact, allergies, hiv_status, alcohol_use, medical_history, regular_medications, timestamp, created_by) SELECT client_id, first_name, last_name, sex, location, date_of_birth, national_id, guardian_name, phone_number, occupation, education, emergency_contact, allergies, hiv_status, alcohol_use, medical_history, regular_medications, timestamp, created_by FROM general_info WHERE client_id='$choosen_client_id';"; 
		$conn->exec($query);
		
		
		// update all current information
		$query = "UPDATE general_info SET first_name='$first_name', last_name='$last_name', sex='$sex', location='$location', date_of_birth='$date_of_birth', national_id='$national_id', guardian_name='$guardian_name', phone_number='$phone_number', occupation='$occupation', education='$education', emergency_contact='$emergency_contact', allergies='$allergies', hiv_status='$hiv_status', alcohol_use='$alcohol_use', medical_history='$medical_history', regular_medications='$regular_medications', timestamp=now(), created_by='$username' WHERE client_id='$choosen_client_id'";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		
		$query = "UPDATE baby SET first_name='$first_name', last_name='$last_name', sex='$sex', location='$location', date_of_birth='$date_of_birth', timestamp=timestamp WHERE client_id='$choosen_client_id'";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		
		$query = "UPDATE child_growth SET first_name='$first_name', last_name='$last_name', sex='$sex', location='$location', date_of_birth='$date_of_birth', timestamp=timestamp WHERE client_id='$choosen_client_id'";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		
		$query = "UPDATE child_welfare_care SET first_name='$first_name', last_name='$last_name', sex='$sex', location='$location', date_of_birth='$date_of_birth', timestamp=timestamp WHERE client_id='$choosen_client_id'";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		
		$query = "UPDATE dental_form SET first_name='$first_name', last_name='$last_name', sex='$sex', location='$location', date_of_birth='$date_of_birth', timestamp=timestamp WHERE client_id='$choosen_client_id'";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		
		$query = "UPDATE diagnoses SET first_name='$first_name', last_name='$last_name', sex='$sex', location='$location', date_of_birth='$date_of_birth', timestamp=timestamp WHERE client_id='$choosen_client_id'";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		
		$query = "UPDATE discharge_form SET first_name='$first_name', last_name='$last_name', sex='$sex', location='$location', date_of_birth='$date_of_birth', timestamp=timestamp WHERE client_id='$choosen_client_id'";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		
		$query = "UPDATE lab SET first_name='$first_name', last_name='$last_name', sex='$sex', location='$location', date_of_birth='$date_of_birth', timestamp=timestamp WHERE client_id='$choosen_client_id'";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		
		$query = "UPDATE lab_order SET first_name='$first_name', last_name='$last_name', sex='$sex', location='$location', date_of_birth='$date_of_birth' WHERE client_id='$choosen_client_id'";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		
		$query = "UPDATE optometry_form SET first_name='$first_name', last_name='$last_name', sex='$sex', location='$location', date_of_birth='$date_of_birth', timestamp=timestamp WHERE client_id='$choosen_client_id'";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		
		$query = "UPDATE referral_form SET first_name='$first_name', last_name='$last_name', sex='$sex', location='$location', date_of_birth='$date_of_birth', timestamp=timestamp WHERE client_id='$choosen_client_id'";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		
		$query = "UPDATE return_treatment SET first_name='$first_name', last_name='$last_name', sex='$sex', location='$location', date_of_birth='$date_of_birth', timestamp=timestamp WHERE client_id='$choosen_client_id'";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		
		$query = "UPDATE treatment SET first_name='$first_name', last_name='$last_name', sex='$sex', location='$location', date_of_birth='$date_of_birth', timestamp=timestamp WHERE client_id='$choosen_client_id'";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		
		$query = "UPDATE ultrasound SET first_name='$first_name', last_name='$last_name', sex='$sex', location='$location', date_of_birth='$date_of_birth', timestamp=timestamp WHERE client_id='$choosen_client_id'";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		
		$query = "UPDATE women_health SET first_name='$first_name', last_name='$last_name', sex='$sex', location='$location', date_of_birth='$date_of_birth', timestamp=timestamp WHERE client_id='$choosen_client_id'";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		
		$query = "UPDATE master_log SET first_name='$first_name', last_name='$last_name', sex='$sex', location='$location', date_of_birth='$date_of_birth', timestamp=timestamp WHERE client_id='$choosen_client_id'";
		$stmt = $conn->prepare($query);
		$stmt->execute();


		$query = "UPDATE medication_order SET first_name='$first_name', last_name='$last_name', sex='$sex', location='$location', date_of_birth='$date_of_birth', timestamp=timestamp WHERE client_id='$choosen_client_id'";
		$stmt = $conn->prepare($query);
		$stmt->execute();

		$query = "UPDATE medication_order_dose SET first_name='$first_name', last_name='$last_name', sex='$sex', location='$location', date_of_birth='$date_of_birth', timestamp=timestamp WHERE client_id='$choosen_client_id'";
		$stmt = $conn->prepare($query);
		$stmt->execute();


		


		
		
		
		// update all historical information

		$query = "UPDATE medication_order_history SET first_name='$first_name', last_name='$last_name', sex='$sex', location='$location', date_of_birth='$date_of_birth', timestamp=timestamp WHERE client_id='$choosen_client_id'";
		$stmt = $conn->prepare($query);
		$stmt->execute();

		$query = "UPDATE baby_history SET first_name='$first_name', last_name='$last_name', sex='$sex', location='$location', date_of_birth='$date_of_birth', timestamp=timestamp WHERE client_id='$choosen_client_id'";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		
		$query = "UPDATE child_growth_history SET first_name='$first_name', last_name='$last_name', sex='$sex', location='$location', date_of_birth='$date_of_birth', timestamp=timestamp WHERE client_id='$choosen_client_id'";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		
		$query = "UPDATE child_welfare_care_history SET first_name='$first_name', last_name='$last_name', sex='$sex', location='$location', date_of_birth='$date_of_birth', timestamp=timestamp WHERE client_id='$choosen_client_id'";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		
		$query = "UPDATE dental_form_history SET first_name='$first_name', last_name='$last_name', sex='$sex', location='$location', date_of_birth='$date_of_birth', timestamp=timestamp WHERE client_id='$choosen_client_id'";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		
		$query = "UPDATE diagnoses_history SET first_name='$first_name', last_name='$last_name', sex='$sex', location='$location', date_of_birth='$date_of_birth', timestamp=timestamp WHERE client_id='$choosen_client_id'";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		
		$query = "UPDATE discharge_form_history SET first_name='$first_name', last_name='$last_name', sex='$sex', location='$location', date_of_birth='$date_of_birth', timestamp=timestamp WHERE client_id='$choosen_client_id'";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		
		$query = "UPDATE lab_history SET first_name='$first_name', last_name='$last_name', sex='$sex', location='$location', date_of_birth='$date_of_birth', timestamp=timestamp WHERE client_id='$choosen_client_id'";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		
		$query = "UPDATE lab_order_history SET first_name='$first_name', last_name='$last_name', sex='$sex', location='$location', date_of_birth='$date_of_birth' WHERE client_id='$choosen_client_id'";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		
		$query = "UPDATE optometry_form_history SET first_name='$first_name', last_name='$last_name', sex='$sex', location='$location', date_of_birth='$date_of_birth', timestamp=timestamp WHERE client_id='$choosen_client_id'";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		
		$query = "UPDATE referral_form_history SET first_name='$first_name', last_name='$last_name', sex='$sex', location='$location', date_of_birth='$date_of_birth', timestamp=timestamp WHERE client_id='$choosen_client_id'";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		
		$query = "UPDATE return_treatment_history SET first_name='$first_name', last_name='$last_name', sex='$sex', location='$location', date_of_birth='$date_of_birth', timestamp=timestamp WHERE client_id='$choosen_client_id'";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		
		$query = "UPDATE treatment_history SET first_name='$first_name', last_name='$last_name', sex='$sex', location='$location', date_of_birth='$date_of_birth', timestamp=timestamp WHERE client_id='$choosen_client_id'";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		
		$query = "UPDATE ultrasound_history SET first_name='$first_name', last_name='$last_name', sex='$sex', location='$location', date_of_birth='$date_of_birth', timestamp=timestamp WHERE client_id='$choosen_client_id'";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		
		$query = "UPDATE women_health_history SET first_name='$first_name', last_name='$last_name', sex='$sex', location='$location', date_of_birth='$date_of_birth', timestamp=timestamp WHERE client_id='$choosen_client_id'";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		
		$query = "UPDATE master_log_history SET first_name='$first_name', last_name='$last_name', sex='$sex', location='$location', date_of_birth='$date_of_birth', timestamp=timestamp WHERE client_id='$choosen_client_id'";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		
		$query = "UPDATE master_log_change SET first_name='$first_name', last_name='$last_name', sex='$sex', location='$location', date_of_birth='$date_of_birth', timestamp=timestamp WHERE client_id='$choosen_client_id'";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		
		$query = "UPDATE current_clients SET first_name='$first_name', last_name='$last_name', sex='$sex', location='$location', date_of_birth='$date_of_birth' WHERE client_id='$choosen_client_id'";
		$stmt = $conn->prepare($query);
		$stmt->execute();
	
	}
	
	// redirect back to view_client.php
	header( 'Location: view_client.php' ) ;
	exit();
	
}
catch(PDOException $e) {
    create_database_error($query, 'update_client.php', $e->getMessage());	
}

$conn = null;

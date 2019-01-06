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

		
	// make database connection
	$conn = new PDO($dbconnection, $dbusername, $dbpassword);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
	
	$username = $_SESSION['username'];
	
	$choosen_child_welfare_care = $_SESSION['choosen_child_welfare_care'];
	
	// grab first name
		$stmt = $conn->prepare("SELECT first_name FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$first_name = $_SESSION['temp'];
		
		
		// grab last name
		$stmt = $conn->prepare("SELECT last_name FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$last_name = $_SESSION['temp'];
		
		
		// grab sex
		$stmt = $conn->prepare("SELECT sex FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$sex = $_SESSION['temp'];
		
		
		// grab location
		$stmt = $conn->prepare("SELECT location FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$location = $_SESSION['temp'];
		
		
		// grab date of birth
		$stmt = $conn->prepare("SELECT date_of_birth FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$date_of_birth = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT client_id FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$client_id = $_SESSION['temp'];
	
	// single quotes need to be replaced with the correct excape keys for the following values
	$first_name = str_replace('\'', '\\\'', $first_name);
	$last_name = str_replace('\'', '\\\'', $last_name);
	$location = str_replace('\'', '\\\'', $location);
	
	$child_growth_weight = $_POST['child_growth_weight'];
	$child_growth_weight_percentile = $_POST['child_growth_weight_percentile'];
	$child_growth_height = $_POST['child_growth_height'];
	$child_growth_height_percentile = $_POST['child_growth_height_percentile'];
	
	try {
		
		$query = "INSERT INTO child_growth (child_welfare_care_id, client_id, first_name, last_name, sex, location, date_of_birth, weight, weight_percentile, height, height_percentile, created_by) VALUES ('$choosen_child_welfare_care', '$client_id', '$first_name', '$last_name', '$sex', '$location', '$date_of_birth', '$child_growth_weight', '$child_growth_weight_percentile', '$child_growth_height', '$child_growth_height_percentile', '$username');"; 
		$conn->exec($query);
		
		header( 'Location: change_child_welfare_care.php');
		exit();
		
	}

	catch(PDOException $e) {
		create_database_error($query, 'insert_child_growth.php (client)', $e->getMessage());
	}

	$conn = null;
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

		
	// make database connection
	$conn = new PDO($dbconnection, $dbusername, $dbpassword);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
	
	$username = $_SESSION['username'];
	
	$choosen_child_growth_id = $_SESSION['choosen_child_growth_id'];
	
	
	
	$child_growth_weight = $_POST['child_growth_weight'];
	$child_growth_weight_percentile = $_POST['child_growth_weight_percentile'];
	$child_growth_height = $_POST['child_growth_height'];
	$child_growth_height_percentile = $_POST['child_growth_height_percentile'];
	
	
	
			$stmt = $conn->prepare("SELECT weight FROM child_growth WHERE child_growth_id='$choosen_child_growth_id';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$child_growth_weight_check = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT weight_percentile FROM child_growth WHERE child_growth_id='$choosen_child_growth_id';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$child_growth_weight_percentile_check = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT height FROM child_growth WHERE child_growth_id='$choosen_child_growth_id';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$child_growth_height_check = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT height_percentile FROM child_growth WHERE child_growth_id='$choosen_child_growth_id';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$child_growth_height_percentile_check = $_SESSION['temp'];
	
	
	
	try {
		
		if ($child_growth_weight != $child_growth_weight_check or $child_growth_weight_percentile != $child_growth_weight_percentile_check or $child_growth_height != $child_growth_height_check or $child_growth_height_percentile != $child_growth_height_percentile_check) {
			
			$query = "INSERT INTO child_growth_history (child_growth_id, child_welfare_care_id, client_id, first_name, last_name, sex, location, date_of_birth, weight, weight_percentile, height, height_percentile, timestamp, created_by) SELECT child_growth_id, child_welfare_care_id, client_id, first_name, last_name, sex, location, date_of_birth, weight, weight_percentile, height, height_percentile, timestamp, created_by FROM child_growth WHERE child_growth_id='$choosen_child_growth_id';"; 
			$conn->exec($query);
			
			$query = "UPDATE child_growth SET weight = '$child_growth_weight', weight_percentile = '$child_growth_weight_percentile', height = '$child_growth_height', height_percentile = '$child_growth_height_percentile', created_by = '$username' WHERE child_growth_id='$choosen_child_growth_id';"; 
			$conn->exec($query);
		
		}
		
		header( 'Location: change_child_welfare_care.php');
		exit();
		
	}

	catch(PDOException $e) {
		create_database_error($query, 'update_child_growth.php', $e->getMessage());
	}

	$conn = null;
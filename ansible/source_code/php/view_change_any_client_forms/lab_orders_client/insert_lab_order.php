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
		
	
    $client_id = $_SESSION['choosen_client_id'];

	    // grab first name
		$stmt = $conn->prepare("SELECT first_name FROM general_info WHERE client_id='$client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$first_name = $_SESSION['temp'];
		
		
		// grab last name
		$stmt = $conn->prepare("SELECT last_name FROM general_info WHERE client_id='$client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$last_name = $_SESSION['temp'];
		
		
		// grab sex
		$stmt = $conn->prepare("SELECT sex FROM general_info WHERE client_id='$client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$sex = $_SESSION['temp'];
		
		
		// grab location
		$stmt = $conn->prepare("SELECT location FROM general_info WHERE client_id='$client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$location = $_SESSION['temp'];
		
		
		// grab date of birth
		$stmt = $conn->prepare("SELECT date_of_birth FROM general_info WHERE client_id='$client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$date_of_birth = $_SESSION['temp'];
	
	// single quotes need to be replaced with the correct excape keys for the following values
	$first_name = str_replace('\'', '\\\'', $first_name);
	$last_name = str_replace('\'', '\\\'', $last_name);
	$location = str_replace('\'', '\\\'', $location);

	

	$bs_for_mps = $_POST['bs_for_mps'];
	
	if ($bs_for_mps){
		$bs_for_mps = "yes";
	}
	else {
		$bs_for_mps = "no";
	}

	
	$pbf = $_POST['pbf'];
	
	if ($pbf){
		$pbf = "yes";
	}
	else {
		$pbf = "no";
	}
	
	
	$widal = $_POST['widal'];
	
	if ($widal){
		$widal = "yes";
	}
	else {
		$widal = "no";
	}
	
	
	$brucella = $_POST['brucella'];
	
	if ($brucella){
		$brucella = "yes";
	}
	else {
		$brucella = "no";
	}

	
	$vdrl_rpr = $_POST['vdrl_rpr'];
	
	if ($vdrl_rpr){
		$vdrl_rpr = "yes";
	}
	else {
		$vdrl_rpr = "no";
	}

	
	$p24_hiv = $_POST['p24_hiv'];
	
	if ($p24_hiv){
		$p24_hiv = "yes";
	}
	else {
		$p24_hiv = "no";
	}

	
	$blood_sugar = $_POST['blood_sugar'];
	
	if ($blood_sugar){
		$blood_sugar = "yes";
	}
	else {
		$blood_sugar = "no";
	}

	
	$stool = $_POST['stool'];
	
	if ($stool){
		$stool = "yes";
	}
	else {
		$stool = "no";
	}
	
	
	$blood_group = $_POST['blood_group'];
	
	if ($blood_group){
		$blood_group = "yes";
	}
	else {
		$blood_group = "no";
	}

	
	$pregnancy = $_POST['pregnancy'];
	
	if ($pregnancy){
		$pregnancy = "yes";
	}
	else {
		$pregnancy = "no";
	}

	
	$hb = $_POST['hb'];
	
	if ($hb){
		$hb = "yes";
	}
	else {
		$hb = "no";
	}
	
	
	$urinalysis = $_POST['urinalysis'];
	
	if ($urinalysis){
		$urinalysis = "yes";
	}
	else {
		$urinalysis = "no";
	}
	

	$hvs = $_POST['hvs'];
	
	if ($hvs){
		$hvs = "yes";
	}
	else {
		$hvs = "no";
	}
	
	$username = $_SESSION['username'];
	$time_created = date("Y-m-d H:i:s");
	
	try {
		
		$query = "INSERT INTO lab_order (client_id, first_name, last_name, sex, location, date_of_birth, bs_for_mps, pbf, widal, brucella, vdrl_rpr, p24_hiv, blood_sugar, stool, blood_group, pregnancy_test, hb, urinalysis, hvs, time_created, created_by  ) VALUES ('$client_id', '$first_name', '$last_name', '$sex', '$location', '$date_of_birth', '$bs_for_mps', '$pbf', '$widal', '$brucella', '$vdrl_rpr', '$p24_hiv', '$blood_sugar', '$stool', '$blood_group', '$pregnancy', '$hb', '$urinalysis', '$hvs', '$time_created', '$username' )"; 
		$conn->exec($query);
		
		// redirect user back to client selection
		header( 'Location: /php/view_change_any_client_forms/view_all_form.php');
		exit();
		
	}

	catch(PDOException $e) {
		create_database_error($query, 'insert_lab_order.php (client)', $e->getMessage());
	}

	$conn = null;
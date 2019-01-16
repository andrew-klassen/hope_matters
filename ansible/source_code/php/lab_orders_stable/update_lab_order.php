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

		
	$lab_order_id = $_SESSION['choosen_lab_order'];

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

	
	$pregnancy_test = $_POST['pregnancy_test'];
	
	if ($pregnancy_test){
		$pregnancy_test = "yes";
	}
	else {
		$pregnancy_test = "no";
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
	
	
	// make database connection
	$conn = new PDO($dbconnection, $dbusername, $dbpassword);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	
	$stmt = $conn->prepare("SELECT bs_for_mps FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$bs_for_mps_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT pbf FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$pbf_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT widal FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$widal_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT brucella FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$brucella_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT vdrl_rpr FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$vdrl_rpr_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT p24_hiv FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$p24_hiv_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT blood_sugar FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$blood_sugar_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT stool FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$stool_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT blood_group FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$blood_group_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT pregnancy_test FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$pregnancy_test_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT hb FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$hb_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT urinalysis FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$urinalysis_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT hvs FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$hvs_check = $_SESSION['temp'];
	
	
	try {
		
		// make sure the user changed somthing on the form, if not don't make any changes to the database
		if ($bs_for_mps != $bs_for_mps_check or $pbf != $pbf_check or $widal != $widal_check or $brucella != $brucella_check or $vdrl_rpr != $vdrl_rpr_check or $p24_hiv != $p24_hiv_check or $blood_sugar != $blood_sugar_check or $stool != $stool_check or $blood_group != $blood_group_check or $pregnancy_test != $pregnancy_test_check or $hb != $hb_check or $urinalysis != $urinalysis_check or $hvs != $hvs_check) {
			
			$query = "INSERT INTO lab_order_history (lab_order_id, client_id, first_name, last_name, sex, location, date_of_birth, bs_for_mps, pbf, widal, brucella, vdrl_rpr, p24_hiv, blood_sugar, stool, blood_group, pregnancy_test, hb, urinalysis, hvs, time_created, time_completed, created_by, completed_by) SELECT lab_order_id, client_id, first_name, last_name, sex, location, date_of_birth, bs_for_mps, pbf, widal, brucella, vdrl_rpr, p24_hiv, blood_sugar, stool, blood_group, pregnancy_test, hb, urinalysis, hvs, time_created, time_completed, created_by, completed_by FROM lab_order WHERE lab_order_id='$lab_order_id';"; 
			$conn->exec($query);
			
			$query = "UPDATE lab_order SET bs_for_mps='$bs_for_mps', pbf='$pbf', widal='$widal', brucella='$brucella', vdrl_rpr='$vdrl_rpr', p24_hiv='$p24_hiv', blood_sugar='$blood_sugar', stool='$stool', blood_group='$blood_group', pregnancy_test='$pregnancy_test', hb='$hb', urinalysis='$urinalysis', hvs='$hvs', time_created='$time_created', created_by='$username' WHERE lab_order_id='$lab_order_id';"; 
			$conn->exec($query);
		
		}
		
		// redirect user back to where they can select a lab order
		header( 'Location: select_lab_order.php');
		exit();
		
	}

	catch(PDOException $e) {
		create_database_error($query, 'update_lab_order.php', $e->getMessage());
	}

	$conn = null;
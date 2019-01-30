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

	
	$h_pylori_stool = $_POST['h_pylori_stool'];
	
	if ($h_pylori_stool){
		$h_pylori_stool = "yes";
	}
	else {
		$h_pylori_stool = "no";
	}
	
	
	
	$h_pylori_blood = $_POST['h_pylori_blood'];
	
	if ($h_pylori_blood){
		$h_pylori_blood = "yes";
	}
	else {
		$h_pylori_blood = "no";
	}
	
	
	
	$rheumatoid_factor = $_POST['rheumatoid_factor'];
                                    
	
	if ($rheumatoid_factor){
		$rheumatoid_factor = "yes";
	}
	else {
		$rheumatoid_factor = "no";
	}
	
	
	
	$stool = $_POST['stool'];
	
	if ($stool){
		$stool = "yes";
	}
	else {
		$stool = "no";
	}
	
	
	$p24_hiv = $_POST['p24_hiv'];
	
	if ($p24_hiv){
		$p24_hiv = "yes";
	}
	else {
		$p24_hiv = "no";
	}
	
	
	
	$vdrl_rpr = $_POST['vdrl_rpr'];
	
	if ($vdrl_rpr){
		$vdrl_rpr = "yes";
	}
	else {
		$vdrl_rpr = "no";
	}

	
	
	$urinalysis = $_POST['urinalysis'];
	
	if ($urinalysis){
		$urinalysis = "yes";
	}
	else {
		$urinalysis = "no";
	}
	
	
	$pregnancy_test = $_POST['pregnancy_test'];
	
	if ($pregnancy_test){
		$pregnancy_test = "yes";
	}
	else {
		$pregnancy_test = "no";
	}
	
	

	$hvs = $_POST['hvs'];
	
	if ($hvs){
		$hvs = "yes";
	}
	else {
		$hvs = "no";
	}



    $gram_stain = $_POST['gram_stain'];
	
	if ($gram_stain){
		$gram_stain = "yes";
	}
	else {
		$gram_stain = "no";
	}
	
	
	
	$culture = $_POST['culture'];
	
	if ($culture){
		$culture = "yes";
	}
	else {
		$culture = "no";
	}
	
	
	
	$blood_group= $_POST['blood_group'];
	
	if ($blood_group){
		$blood_group = "yes";
	}
	else {
		$blood_group = "no";
	}
	
	
	
	$blood_count = $_POST['blood_count'];
	
	if ($blood_count){
		$blood_count = "yes";
	}
	else {
		$blood_count = "no";
	}

	
	
    $blood_chemistry = $_POST['blood_chemistry'];
	
	if ($blood_chemistry){
		$blood_chemistry = "yes";
	}
	else {
		$blood_chemistry = "no";
	}
	
	
	
	
    $arterial_blood = $_POST['arterial_blood'];
	
	if ($arterial_blood){
		$arterial_blood = "yes";
	}
	else {
		$arterial_blood = "no";
	}
	
	
	
	$liver_function_test = $_POST['liver_function_test'];
	
	if ($liver_function_test){
		$liver_function_test = "yes";
	}
	else {
		$liver_function_test = "no";
	}
	
	
	
	$prothrombin_time = $_POST['prothrombin_time'];
	
	if ($prothrombin_time){
		$prothrombin_time = "yes";
	}
	else {
		$prothrombin_time = "no";
	}
	
	

	$inr = $_POST['inr'];
	
	if ($inr){
		$inr = "yes";
	}
	else {
		$inr = "no";
	}
	
	
	
	$thyroid_function = $_POST['tft'];
	
	if ($thyroid_function){
		$thyroid_function = "yes";
	}
	else {
		$thyroid_function = "no";
	}
	
	
	
	$cholesterol = $_POST['cholesterol'];
	
	if ($cholesterol){
		$cholesterol = "yes";
	}
	else {
		$cholesterol = "no";
	}
	
	
	
	$cardiac = $_POST['cardiac'];
	
	if ($cardiac){
		$cardiac = "yes";
	}
	else {
		$cardiac = "no";
	}
	
		
	$username = $_SESSION['username'];
	$time_created = date("Y-m-d H:i:s");
	
	try {
		
		$query = "INSERT INTO lab_order (client_id, first_name, last_name, sex, location, date_of_birth, bs_for_mps, pbf, widal, brucella, h_pylori_stool, h_pylori_blood, rheumatoid_factor, stool, p24_hiv, vdrl_rpr, urinalysis, pregnancy_test, hvs, gram_stain, culture, blood_group, blood_count, blood_chemistry, arterial_blood, liver_function_test, prothrombin_time, inr, thyroid_function_test, cholesterol, cardiac, time_created, created_by)  VALUES ('$client_id', '$first_name', '$last_name', '$sex', '$location', '$date_of_birth', '$bs_for_mps', '$pbf', '$widal', '$brucella', '$h_pylori_stool', '$h_pylori_blood', '$rheumatoid_factor', '$stool', '$p24_hiv', '$vdrl_rpr', '$urinalysis', '$pregnancy_test', '$hvs', '$gram_stain', '$culture', '$blood_group', '$blood_count', '$blood_chemistry', '$arterial_blood', '$liver_function_test', '$prothrombin_time', '$inr' ,'$thyroid_function' , '$cholesterol' , '$cardiac', '$time_created', '$username' )";

		
		$conn->exec($query);
		
		// redirect user back to client selection
		header( 'Location: ../view_all_form.php');
		exit();
		
	}

	catch(PDOException $e) {
		create_database_error($query, 'insert_lab_order.php', $e->getMessage());
	}

	$conn = null;

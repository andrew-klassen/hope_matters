<!--
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
-->

<?php
require('../database_credentials.php');
require('../file_upload.php');
session_start();

// make sure user is logged in
login_check();

$choosen_client_id = $_SESSION['choosen_client_id'];
$username = $_SESSION['username'];

// grab dental provider first because the program needs to make sure
// the account exists within the database
$dental_provider = $_POST['dental_provider'];

// single quotes need to be replaced with the correct excape keys for the following value
$dental_provider = str_replace('\'', '\\\'', $dental_provider);

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
	
	
// check to see if an account with the dental provider's name exists
$stmt = $conn->prepare("SELECT COUNT(username) FROM accounts WHERE username='$dental_provider'");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$count = $_SESSION['temp'];


// if the account does not exist
if ($count == 0) {
	
	// notify the user that the account was not found and redirect back to the form creation page
	echo "<script type='text/javascript'>
			alert('Dental Provider was not found in the database.'); 
			document.location.href = 'add_dental_form.php'; 
		  </script>";
		
}

// if the account exists
else {

	// make sure image is acceptible before continuing
	if($image_path = upload_file('teeth_file', 'Teeth', 'select_client_dental_form.php', '../../uploaded_images/in_use/dental_images/')) {
		
		
		
		// grab first name
		$stmt = $conn->prepare("SELECT first_name FROM general_info WHERE client_id='$choosen_client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$first_name = $_SESSION['temp'];
		
		
		// grab last name
		$stmt = $conn->prepare("SELECT last_name FROM general_info WHERE client_id='$choosen_client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$last_name = $_SESSION['temp'];
		
		
		// grab sex
		$stmt = $conn->prepare("SELECT sex FROM general_info WHERE client_id='$choosen_client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$sex = $_SESSION['temp'];
		
		
		// grab location
		$stmt = $conn->prepare("SELECT location FROM general_info WHERE client_id='$choosen_client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$location = $_SESSION['temp'];
		
		
		// grab date of birth
		$stmt = $conn->prepare("SELECT date_of_birth FROM general_info WHERE client_id='$choosen_client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$date_of_birth = $_SESSION['temp'];
		

	// get vital signs from post methods
	$t = $_POST['t'];
	$bp = $_POST['bp'];
	$wt = $_POST['wt'];
	$pr = $_POST['pr'];
	$rr = $_POST['rr'];
	$pain = $_POST['pain'];
	
	// single quotes need to be replaced with the correct excape keys for the following values
	$t = str_replace('\'', '\\\'', $t);
	$bp = str_replace('\'', '\\\'', $bp);

	// get medical history from post methods
	$latex_glove_allergy = $_POST['latex_glove_allergy'];
	$ulcers = $_POST['ulcers'];
	$diabetes = $_POST['diabetes'];
	$epilepsy = $_POST['epilepsy'];
	$hemophilia = $_POST['hemophilia'];
	$pregnant = $_POST['pregnant'];
	$herbs = $_POST['herbs'];
	$heart_problem = $_POST['heart_problem'];
	$hepatitis = $_POST['hepatitis'];
	$cough = $_POST['cough'];
	$tuberculosis = $_POST['tuberculosis'];
	$asthma = $_POST['asthma'];
	$fainting = $_POST['fainting'];
	$family_pills = $_POST['family_pills'];
	$blood_thinners = $_POST['blood_thinners'];
	$blood_pressure = $_POST['blood_pressure'];
	$anemia = $_POST['anemia'];
	$penicillin = $_POST['penicillin'];
	$codenine = $_POST['codenine'];
	$local_anesthesia = $_POST['local_anesthesia'];
	$sulfur = $_POST['sulfur'];
	$aspirin = $_POST['aspirin'];
	$other = $_POST['other'];
	$hot = $_POST['hot'];
	$cold = $_POST['cold'];
	$biting = $_POST['biting'];
	$sweet = $_POST['sweet'];
	
	// single quotes need to be replaced with the correct excape keys for the following values
	$other = str_replace('\'', '\\\'', $other);

	// if some of the checkboxes are not checked, push the value "no" into database
	if ($hot != 'yes') {
		$hot = 'no';
	}
	if ($cold != 'yes') {
		$cold = 'no';
	}
	if ($biting != 'yes') {
		$biting = 'no';
	}
	if ($sweet != 'yes') {
		$sweet = 'no';
	}

	$gums_painful = $_POST['gums_painful'];
	$gums_bleed = $_POST['gums_bleed'];
	$loose_teeth = $_POST['loose_teeth'];
	$jaw = $_POST['jaw'];
	$face_pain = $_POST['face_pain'];
	$grinding = $_POST['grinding'];
	$past_extractions = $_POST['past_extractions'];
	$periodontic_treatment = $_POST['periodontic_treatment'];

	// get the textbox values from post methods
	$current_medications = $_POST['current_medications'];
	$findings = $_POST['findings'];
	$treatment = $_POST['treatment'];
	$notes = $_POST['notes'];
	
	// single quotes need to be replaced with the correct excape keys for the following values
	$current_medications = str_replace('\'', '\\\'', $current_medications);
	$findings = str_replace('\'', '\\\'', $findings);
	$treatment = str_replace('\'', '\\\'', $treatment);
	$notes = str_replace('\'', '\\\'', $notes);
	
	
	try {
		// below is the insert query
		$query = "INSERT INTO dental_form (client_id, first_name, last_name, sex, location, date_of_birth, pain, t, bp, pr, rr, wt, latex_glove_allergy, ulcers, diabetes, epilepsy, hemophilia_bleeding, pregnant, herbs, heart_problems, hepatitis_liver_problem, cough, tuberculosis, asthma, fainting, family_planning_pills, blood_thinners, high_blood_presure, anemia, penicillin, codeine, local_anesthesia, sulfur, aspirin, other_allergie, teeth_sensitive_hot, teeth_sensitive_cold, 
										   teeth_sensitive_biting, teeth_sensitive_sweets, gums_bleeding, gums_painful, loose_teeth, jaw_not_opening_closing, pain_jaw_ear_face, teeth_grinding, previous_extractions, previous_periodontic_treatment, current_medications, findings, treatment, notes, image_path, dental_provider, created_by) 
									
				  VALUES ('$choosen_client_id', '$first_name', '$last_name', '$sex', '$location', '$date_of_birth', '$pain', '$t', '$bp', '$pr', '$rr', '$wt', '$latex_glove_allergy', '$ulcers', '$diabetes', '$epilepsy', '$hemophilia', '$pregnant', '$herbs', '$heart_problem', '$hepatitis', '$cough', '$tuberculosis', '$asthma', 
						  '$fainting', '$family_pills', '$blood_thinners', '$blood_pressure', '$anemia', '$penicillin', '$codenine', '$local_anesthesia', '$sulfur', '$aspirin', '$other', '$hot', '$cold', '$biting', '$sweet', '$gums_painful', '$gums_bleed', '$loose_teeth', '$jaw', '$face_pain', '$grinding', '$past_extractions', '$periodontic_treatment', '$current_medications', '$findings', '$treatment', '$notes', '$image_path','$dental_provider', '$username')"; 
		
		$conn->exec($query);
		
		// redirect user back to where they can select a client
		header('Location: select_client_dental_form.php');
		exit();
	}

	catch(PDOException $e) {
		create_database_error($query, 'insert_dental_form.php', $e->getMessage());	
	}
	$conn = null;
	}
}	
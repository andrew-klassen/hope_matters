<!--
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
-->

<?php
require('../../database_credentials.php');
require('../../file_upload.php');
session_start();

// make sure user is logged in
login_check();

$choosen_dental_form_id = $_SESSION['choosen_dental_form_id'];
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
			document.location.href = 'select_dental_form.php'; 
		  </script>";
		
}

// if the account exists
else {

	// make sure image is acceptible before continuing
	if ($image_path = upload_file('teeth_file', 'Teeth', '../view_all_form.php', '../../../uploaded_images/in_use/dental_images/')) {

	$t = $_POST['t'];
	$bp = $_POST['bp'];
	$wt = $_POST['wt'];
	$pr = $_POST['pr'];
	$rr = $_POST['rr'];
	$pain = $_POST['pain'];

	// single quotes need to be replaced with the correct excape keys for the following values
	$t = str_replace('\'', '\\\'', $t);
	$bp = str_replace('\'', '\\\'', $bp);


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
	
	// single quotes need to be replaced with the correct excape keys for the following value
	$other = str_replace('\'', '\\\'', $other);

	$hot = $_POST['hot'];
	$cold = $_POST['cold'];
	$biting = $_POST['biting'];
	$sweet = $_POST['sweet'];

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

	$current_medications = $_POST['current_medications'];
	$findings = $_POST['findings'];
	$treatment = $_POST['treatment'];
	$notes = $_POST['notes'];
	
	// single quotes need to be replaced with the correct excape keys for the following values
	$current_medications = str_replace('\'', '\\\'', $current_medications);
	$findings = str_replace('\'', '\\\'', $findings);
	$treatment = str_replace('\'', '\\\'', $treatment);
	$notes = str_replace('\'', '\\\'', $notes);
	
	
	
	$stmt = $conn->prepare("SELECT t FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$t_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT bp FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$bp_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT wt FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$wt_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT pr FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$pr_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT rr FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$rr_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT pain FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$pain_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT latex_glove_allergy FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$latex_glove_allergy_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT ulcers FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$ulcers_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT diabetes FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$diabetes_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT epilepsy FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$epilepsy_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT hemophilia_bleeding FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$hemophilia_bleeding_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT pregnant FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$pregnant_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT herbs FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$herbs_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT heart_problems FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$heart_problems_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT hepatitis_liver_problem FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$hepatitis_liver_problem_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT cough FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$cough_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT tuberculosis FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$tuberculosis_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT asthma FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$asthma_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT fainting FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$fainting_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT family_planning_pills FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$family_planning_pills_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT blood_thinners FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$blood_thinners_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT high_blood_presure FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$high_blood_presure_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT anemia FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$anemia_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT penicillin FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$penicillin_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT codeine FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$codeine_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT local_anesthesia FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$local_anesthesia_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT sulfur FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$sulfur_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT aspirin FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$aspirin_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT other_allergie FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$other_allergie_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT teeth_sensitive_hot FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$teeth_sensitive_hot_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT teeth_sensitive_cold FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$teeth_sensitive_cold_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT teeth_sensitive_biting FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$teeth_sensitive_biting_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT teeth_sensitive_sweets FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$teeth_sensitive_sweets_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT gums_painful FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$gums_painful_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT gums_bleeding FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$gums_bleeding_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT loose_teeth FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$loose_teeth_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT jaw_not_opening_closing FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$jaw_not_opening_closing_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT pain_jaw_ear_face FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$pain_jaw_ear_face_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT teeth_grinding FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$teeth_grinding_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT previous_extractions FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$previous_extractions_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT previous_periodontic_treatment FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$previous_periodontic_treatment_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT current_medications FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$current_medications_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT findings FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$findings_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT treatment FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$treatment_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT notes FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$notes_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT dental_provider FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$dental_provider_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT image_path FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$image_path_check = $_SESSION['temp'];
	
	
	// archive image to history folder
	if ($image_path_check != 'no_image' and $image_path != 'no_image'){
		rename($image_path_check, '../../../uploaded_images/no_longer_used/dental_images_history/' . substr($image_path_check, strposX($image_path_check, '/', 6) + 1));
		//echo $image_path_check . '<br>' . '../../../uploaded_images/no_longer_used/dental_images_history/' . substr($image_path_check, strposX($image_path_check, '/', 6) + 1);
	}	
	// make sure the image is not replaced, if an image exists in the database
	
	elseif ($image_path_check and $image_path == 'no_image'){
		$image_path = $image_path_check;
	}
	

	try {
		// see if user made a change
		if ($pain != $pain_check or $t != $t_check or $bp != $bp_check or $pr != $pr_check or $rr != $rr_check or $wt != $wt_check or $latex_glove_allergy != $latex_glove_allergy_check or $ulcers != $ulcers_check or $diabetes != $diabetes_check or $epilepsy != $epilepsy_check or $hemophilia != $hemophilia_bleeding_check or $pregnant != $pregnant_check or $herbs != $herbs_check or $heart_problem != $heart_problems_check or $hepatitis != $hepatitis_liver_problem_check or $cough != $cough_check or $tuberculosis != $tuberculosis_check or $asthma != $asthma_check or $fainting != $fainting_check or $family_pills != $family_planning_pills_check or $blood_thinners != $blood_thinners_check or $blood_pressure != $high_blood_presure_check or $anemia != $anemia_check or $penicillin != $penicillin_check or $codenine != $codeine_check or $local_anesthesia != $local_anesthesia_check or $sulfur != $sulfur_check or $aspirin != $aspirin_check or $other != $other_allergie_check or $hot != $teeth_sensitive_hot_check or $cold != $teeth_sensitive_cold_check or $biting != $teeth_sensitive_biting_check or $sweet != $teeth_sensitive_sweets_check or $gums_bleed != $gums_bleeding_check or $gums_painful != $gums_painful_check or $loose_teeth != $loose_teeth_check or $jaw != $jaw_not_opening_closing_check or $face_pain != $pain_jaw_ear_face_check or $grinding != $teeth_grinding_check or $past_extractions != $previous_extractions_check or $periodontic_treatment != $previous_periodontic_treatment_check or $current_medications != $current_medications_check or $findings != $findings_check or $treatment != $treatment_check or $notes != $notes_check or $image_path != $image_path_check or $dental_provider != $dental_provider_check ) {
		
			$query = "INSERT INTO dental_form_history (dental_form_id, client_id, first_name, last_name, sex, location, date_of_birth, pain, t, bp, pr, rr, wt, latex_glove_allergy, ulcers, diabetes, epilepsy, hemophilia_bleeding, pregnant, herbs, heart_problems, hepatitis_liver_problem, cough, tuberculosis, asthma, fainting, family_planning_pills, blood_thinners, high_blood_presure, anemia, penicillin, codeine, local_anesthesia, sulfur, aspirin, other_allergie, teeth_sensitive_hot, teeth_sensitive_cold, teeth_sensitive_biting, teeth_sensitive_sweets, gums_bleeding, gums_painful, loose_teeth, jaw_not_opening_closing, pain_jaw_ear_face, teeth_grinding, previous_extractions, previous_periodontic_treatment, current_medications, findings, treatment, notes, image_path, dental_provider, timestamp, created_by) SELECT dental_form_id, client_id, first_name, last_name, sex, location, date_of_birth, pain, t, bp, pr, rr, wt, latex_glove_allergy, ulcers, diabetes, epilepsy, hemophilia_bleeding, pregnant, herbs, heart_problems, hepatitis_liver_problem, cough, tuberculosis, asthma, fainting, family_planning_pills, blood_thinners, high_blood_presure, anemia, penicillin, codeine, local_anesthesia, sulfur, aspirin, other_allergie, teeth_sensitive_hot, teeth_sensitive_cold, teeth_sensitive_biting, teeth_sensitive_sweets, gums_bleeding, gums_painful, loose_teeth, jaw_not_opening_closing, pain_jaw_ear_face, teeth_grinding, previous_extractions, previous_periodontic_treatment, current_medications, findings, treatment, notes, image_path, dental_provider, timestamp, created_by FROM dental_form WHERE dental_form_id='$choosen_dental_form_id';"; 
			$conn->exec($query);
		
			$query = "UPDATE dental_form SET pain='$pain', t='$t', bp='$bp', pr='$pr', rr='$rr', wt='$wt', latex_glove_allergy='$latex_glove_allergy', ulcers='$ulcers', diabetes='$diabetes', epilepsy='$epilepsy', hemophilia_bleeding='$hemophilia', pregnant='$pregnant', herbs='$herbs', heart_problems='$heart_problem', hepatitis_liver_problem='$hepatitis', cough='$cough', tuberculosis='$tuberculosis', asthma='$asthma', fainting='$fainting', family_planning_pills='$family_pills', blood_thinners='$blood_thinners', high_blood_presure='$blood_pressure', anemia='$anemia', penicillin='$penicillin', codeine='$codenine',
										   local_anesthesia='$local_anesthesia', sulfur='$sulfur', aspirin='$aspirin', other_allergie='$other', teeth_sensitive_hot='$hot', teeth_sensitive_cold='$cold', teeth_sensitive_biting='$biting', teeth_sensitive_sweets='$sweet', gums_bleeding='$gums_bleed', gums_painful='$gums_painful', loose_teeth='$loose_teeth', jaw_not_opening_closing='$jaw', pain_jaw_ear_face='$face_pain', teeth_grinding='$grinding', previous_extractions='$past_extractions', previous_periodontic_treatment='$periodontic_treatment', current_medications='$current_medications', findings='$findings', treatment='$treatment', notes='$notes', image_path='$image_path', dental_provider='$dental_provider', created_by='$username' WHERE dental_form_id='$choosen_dental_form_id'  "; 
		 
			$stmt = $conn->prepare($query);
			$stmt->execute();
		
		}
		
	    header( 'Location: /php/view_change_any_client_forms/view_all_form.php');
		exit();

	}

	catch(PDOException $e) {
		create_database_error($query, 'update_dental_form.php (client)', $e->getMessage());	
	}

	$conn = null;
	
	}
	
}
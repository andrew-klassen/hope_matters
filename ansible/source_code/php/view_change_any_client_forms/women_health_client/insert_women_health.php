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


// grab clinician first because the program needs to make sure
// the account exists within the database
$clinician = $_POST['clinician'];

// single quotes need to be replaced with the correct excape keys for the following value
$clinician = str_replace('\'', '\\\'', $clinician);

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
	
	
// check to see if an account with the clinician's name exists
$stmt = $conn->prepare("SELECT COUNT(username) FROM accounts WHERE username='$clinician'");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$count = $_SESSION['temp'];


// if the account does not exist
if ($count == 0) {
	
	// notify the user that the account was not found and redirect back to the form creation page
	echo "<script type='text/javascript'>
			alert('Clinician was not found in the database.'); 
			document.location.href = 'add_return_treatment_form.php'; 
		  </script>";
		
}

// if the account exists
else {
	
	// make sure image is acceptible before continuing
	if ($vigina_path = upload_file('vigina_file', 'Vigina', '../view_all_form.php', '../../../uploaded_images/in_use/women_health_images/vigina_images/') and $breast_path = upload_file('breast_file', 'Breast', '../view_all_form.php', '../../../uploaded_images/in_use/women_health_images/breast_images/') and $circle_path = upload_file('circle_file', 'Circle', '../view_all_form.php', '../../../uploaded_images/in_use/women_health_images/circle_images/')) {

	$username = $_SESSION['username'];
	$choosen_client_id = $_SESSION['choosen_client_id'];
	

		// grab the clients first name
		$stmt = $conn->prepare("SELECT first_name FROM general_info WHERE client_id='$choosen_client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$first_name = $_SESSION['temp'];
		
		
		// grab the clients last name
		$stmt = $conn->prepare("SELECT last_name FROM general_info WHERE client_id='$choosen_client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$last_name = $_SESSION['temp'];
		
		
		// grab the clients sex
		$stmt = $conn->prepare("SELECT sex FROM general_info WHERE client_id='$choosen_client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$sex = $_SESSION['temp'];
		
		
		// grab the clients location
		$stmt = $conn->prepare("SELECT location FROM general_info WHERE client_id='$choosen_client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$location = $_SESSION['temp'];
		
		
		// grab the clients date of birth
		$stmt = $conn->prepare("SELECT date_of_birth FROM general_info WHERE client_id='$choosen_client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$date_of_birth = $_SESSION['temp'];
		
		
		
	// single quotes need to be replaced with the correct excape keys for the following values
	$first_name = str_replace('\'', '\\\'', $first_name);
	$last_name = str_replace('\'', '\\\'', $last_name);
	$location = str_replace('\'', '\\\'', $location);

	// get vital signs
	$t = $_POST['t'];
	$bp = $_POST['bp'];
	$pr = $_POST['pr'];
	$rr = $_POST['rr'];
	$sao2 = $_POST['sao2'];
	$pain = $_POST['pain'];

	// single quotes need to be replaced with the correct excape keys for the following values
	$t = str_replace('\'', '\\\'', $t);
	$bp = str_replace('\'', '\\\'', $bp);
	$rr = str_replace('\'', '\\\'', $rr);

	$lmp = $_POST['lmp'];
	$menarche = $_POST['menarche'];
	$g_lmp = $_POST['g_lmp'];
	$t_lmp = $_POST['t_lmp'];
	$p_lmp = $_POST['p_lmp'];
	$l_lmp = $_POST['l_lmp'];
	$family_planning = $_POST['family_planning'];
	
	$past_cancer_screening = $_POST['past_cancer_screening'];
	$life_sex_partners = $_POST['life_sex_partners'];
	$year_sex_partners = $_POST['year_sex_partners'];
	$cd4_count = $_POST['cd4_count'];
	
	$history = $_POST['history'];
	
	$via_preformed = $_POST['via_preformed'];
	$cryo_preformed = $_POST['cryo_preformed'];
	$colpo_preformed = $_POST['colpo_preformed'];
	$biopsies = $_POST['biopsies'];
	$biopsies_comment = $_POST['biopsies_comment'];
	
	$physical_exam_continued = $_POST['physical_exam_continued'];
	$plan = $_POST['plan'];
	
	$metronidazole_400mg = $_POST['metronidazole_400mg'];
	$metronidazole_2gm = $_POST['metronidazole_2gm'];
	$azithromycin = $_POST['azithromycin'];
	$ceftriaxone = $_POST['ceftriaxone'];
	$fluconazole = $_POST['fluconazole'];
	$clotrimazole = $_POST['clotrimazole'];
	
	$lbuprofen = $_POST['lbuprofen'];
	$paracetamol = $_POST['paracetamol'];
	$pyridium = $_POST['pyridium'];
	$septrim = $_POST['septrim'];
	$amoxil = $_POST['amoxil'];
	
	$family_planning_bottom = $_POST['family_planning_bottom'];
	$family_planning_comment = $_POST['family_planning_comment'];
	
	$via_months = $_POST['via_months'];
	$via_months_count = $_POST['via_months_count'];
	
	$colposcopy = $_POST['colposcopy'];
	$colposcopy_month_count = $_POST['colposcopy_month_count'];
	
	$biopsy_results = $_POST['biopsy_results'];
	$biopsy_results_count = $_POST['biopsy_results_count'];
	
	$referral = $_POST['referral'];
	$return_visit = $_POST['return_visit'];

	if ($return_visit) {
		$return_visit = "'" . $return_visit . "'";
	}
	else {
		$return_visit = 'NULL';
	}
	
	// replace single quotes with correct excape keys
	$history = str_replace('\'', '\\\'', $history);
	$biopsies_comment = str_replace('\'', '\\\'', $biopsies_comment);
	$physical_exam_continued = str_replace('\'', '\\\'', $physical_exam_continued);
	$family_planning_comment = str_replace('\'', '\\\'', $family_planning_comment);
	
	try {
		
		// below is the insert query
		$query = "INSERT INTO women_health (client_id, first_name, last_name, sex, location, date_of_birth, t, bp, pr, rr, sao2, pain, lmp, menarche, g_lmp, t_lmp, p_lmp, l_lmp, family_planning, past_cancer_screening, life_sex_partners, year_sex_partners, cd4_count, history, via_preformed, cryo_preformed, colpo_preformed, biopsies, biopsies_comment, physical_exam_continued, plan, metronidazole_400mg, metronidazole_2gm, azithromycin, ceftriaxone, fluconazole, clotrimazole, lbuprofen, paracetamol, pyridium, septrim, amoxil, family_planning_bottom, family_planning_comment, via_months, via_months_count, colposcopy, colposcopy_month_count, biopsy_results, biopsy_results_count, referral, return_visit, clinician, created_by, vigina_path, breast_path, circle_path) VALUES ('$choosen_client_id', '$first_name', '$last_name', '$sex', '$location', '$date_of_birth', '$t', '$bp', '$pr', '$rr', '$sao2', '$pain', '$lmp', '$menarche', '$g_lmp', '$t_lmp', '$p_lmp', '$l_lmp', '$family_planning', '$past_cancer_screening', '$life_sex_partners', '$year_sex_partners', '$cd4_count', '$history', '$via_preformed', '$cryo_preformed', '$colpo_preformed', '$biopsies', '$biopsies_comment', '$physical_exam_continued', '$plan', '$metronidazole_400mg', '$metronidazole_2gm', '$azithromycin', '$ceftriaxone', '$fluconazole', '$clotrimazole', '$lbuprofen', '$paracetamol', '$pyridium', '$septrim', '$amoxil', '$family_planning_bottom', '$family_planning_comment', '$via_months', '$via_months_count', '$colposcopy', '$colposcopy_month_count', '$biopsy_results', '$biopsy_results_count', '$referral', $return_visit, '$clinician', '$username', '$vigina_path', '$breast_path', '$circle_path');"; 
		$conn->exec($query);
		
		// redirect user back to discharge form selection
		header( 'Location: /php/view_change_any_client_forms/view_all_form.php');
		exit();
		
	}

	catch(PDOException $e) {
		create_database_error($query, 'insert_women_health.php (client)', $e->getMessage());
	}

	$conn = null;
	
	}

}
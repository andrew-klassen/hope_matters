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
			document.location.href = 'select_women_health.php'; 
		  </script>";
		
}

// if the account exists
else {

	// make sure image is acceptible before continuing
	if ($vigina_path = upload_file('vigina_file', 'Vigina', 'select_client_women_health.php', '../../uploaded_images/in_use/women_health_images/vigina_images/') and $breast_path = upload_file('breast_file', 'Breast', 'select_client_women_health.php', '../../uploaded_images/in_use/women_health_images/breast_images/') and $circle_path = upload_file('circle_file', 'Circle', 'select_client_women_health.php', '../../uploaded_images/in_use/women_health_images/circle_images/')) {

	$choosen_women_health_id = $_SESSION['choosen_women_health_id'];
	$username = $_SESSION['username'];

	// grab the clients first name
		$stmt = $conn->prepare("SELECT first_name FROM women_health WHERE women_health_id='$choosen_women_health_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$first_name = $_SESSION['temp'];
		
		
		// grab the clients last name
		$stmt = $conn->prepare("SELECT last_name FROM women_health WHERE women_health_id='$choosen_women_health_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$last_name = $_SESSION['temp'];
		
		
		// grab the clients sex
		$stmt = $conn->prepare("SELECT sex FROM women_health WHERE women_health_id='$choosen_women_health_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$sex = $_SESSION['temp'];
		
		
		// grab the clients location
		$stmt = $conn->prepare("SELECT location FROM women_health WHERE women_health_id='$choosen_women_health_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$location = $_SESSION['temp'];
		
		
		// grab the clients date of birth
		$stmt = $conn->prepare("SELECT date_of_birth FROM women_health WHERE women_health_id='$choosen_women_health_id'");
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
	
	
	// replace single quotes with correct excape keys
	$history = str_replace('\'', '\\\'', $history);
	$biopsies_comment = str_replace('\'', '\\\'', $biopsies_comment);
	$physical_exam_continued = str_replace('\'', '\\\'', $physical_exam_continued);
	$family_planning_comment = str_replace('\'', '\\\'', $family_planning_comment);
	
	
	$stmt = $conn->prepare("SELECT t FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$t_check = $_SESSION['temp'];
	
	$stmt = $conn->prepare("SELECT bp FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$bp_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT pr FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$pr_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT rr FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$rr_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT sao2 FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$sao2_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT pain FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$pain_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT lmp FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$lmp_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT menarche FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$menarche_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT g_lmp FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$g_lmp_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT t_lmp FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$t_lmp_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT p_lmp FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$p_lmp_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT l_lmp FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$l_lmp_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT family_planning FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$family_planning_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT past_cancer_screening FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$past_cancer_screening_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT life_sex_partners FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$life_sex_partners_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT year_sex_partners FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$year_sex_partners_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT cd4_count FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$cd4_count_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT history FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$history_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT via_preformed FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$via_preformed_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT cryo_preformed FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$cryo_preformed_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT colpo_preformed FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$colpo_preformed_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT biopsies FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$biopsies_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT biopsies_comment FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$biopsies_comment_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT physical_exam_continued FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$physical_exam_continued_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT plan FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$plan_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT metronidazole_400mg FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$metronidazole_400mg_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT metronidazole_2gm FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$metronidazole_2gm_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT azithromycin FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$azithromycin_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT ceftriaxone FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$ceftriaxone_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT fluconazole FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$fluconazole_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT clotrimazole FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$clotrimazole_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT lbuprofen FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$lbuprofen_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT paracetamol FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$paracetamol_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT pyridium FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$pyridium_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT septrim FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$septrim_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT amoxil FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$amoxil_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT family_planning_bottom FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$family_planning_bottom_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT family_planning_comment FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$family_planning_comment_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT via_months FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$via_months_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT via_months_count FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$via_months_count_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT colposcopy FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$colposcopy_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT colposcopy_month_count FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$colposcopy_month_count_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT biopsy_results FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$biopsy_results_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT biopsy_results_count FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$biopsy_results_count_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT referral FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$referral_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT return_visit FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$return_visit_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT clinician FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$clinician_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT vigina_path FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$vigina_path_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT breast_path FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$breast_path_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT circle_path FROM women_health WHERE women_health_id='$choosen_women_health_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$circle_path_check = $_SESSION['temp'];
	
	
	// archive image to history folder
	if ($vigina_path_check != 'no_image' and $vigina_path != 'no_image'){
		rename($vigina_path_check, '../../uploaded_images/no_longer_used/women_health_images_history/vigina_images_history/' . substr($vigina_path_check, strposX($vigina_path_check, '/', 6) + 1));
	}	
	// make sure the image is not replaced, if an image exists in the database
	elseif ($vigina_path_check and $vigina_path == 'no_image'){
		$vigina_path = $vigina_path_check;
	}
	
	
	// archive image to history folder
	if ($breast_path_check != 'no_image' and $breast_path != 'no_image'){
		rename($breast_path_check, '../../uploaded_images/no_longer_used/women_health_images_history/breast_images_history/' . substr($breast_path_check, strposX($breast_path_check, '/', 6) + 1));
	}	
	// make sure the image is not replaced, if an image exists in the database
	elseif ($breast_path_check and $breast_path == 'no_image'){
		$breast_path = $breast_path_check;
	}
	
	
	// archive image to history folder
	if ($circle_path_check != 'no_image' and $circle_path != 'no_image'){
		rename($circle_path_check, '../../uploaded_images/no_longer_used/women_health_images_history/circle_images_history/' . substr($circle_path_check, strposX($circle_path_check, '/', 6) + 1));
	}	
	// make sure the image is not replaced, if an image exists in the database
	elseif ($circle_path_check and $circle_path == 'no_image'){
		$circle_path = $circle_path_check;
	}
	
	try {
		
		if ( $t != $t_check or $bp != $bp_check or $pr != $pr_check or $rr != $rr_check or $sao2 != $sao2_check or $pain != $pain_check or $lmp != $lmp_check or $menarche != $menarche_check or $g_lmp != $g_lmp_check or $t_lmp != $t_lmp_check or $p_lmp != $p_lmp_check or $l_lmp != $l_lmp_check or $family_planning != $family_planning_check or $past_cancer_screening != $past_cancer_screening_check or $life_sex_partners != $life_sex_partners_check or $year_sex_partners != $year_sex_partners_check or $cd4_count != $cd4_count_check or $history != $history_check or $via_preformed != $via_preformed_check or $cryo_preformed != $cryo_preformed_check or $colpo_preformed != $colpo_preformed or $biopsies != $biopsies_check or $biopsies_comment != $biopsies_comment_check or $physical_exam_continued != $physical_exam_continued_check or $plan != $plan_check or $metronidazole_400mg != $metronidazole_400mg or $metronidazole_2gm != $metronidazole_2gm_check or $azithromycin != $azithromycin_check or $ceftriaxone != $ceftriaxone_check or $fluconazole != $fluconazole_check or $clotrimazole != $clotrimazole_check or $lbuprofen != $lbuprofen_check or $paracetamol != $paracetamol_check or $pyridium != $pyridium_check or $septrim != $septrim_check or $amoxil != $amoxil_check or $family_planning_bottom != $family_planning_bottom_check or $family_planning_comment != $family_planning_comment_check or $via_months != $via_months_check or $via_months_count != $via_months_count_check or $colposcopy != $colposcopy_check or $colposcopy_month_count != $colposcopy_month_count_check or $biopsy_results != $biopsy_results_check or $biopsy_results_count != $biopsy_results_count_check or $referral != $referral_check or $return_visit != $return_visit_check or $clinician != $clinician_check or $vigina_path != $vigina_path_check or $breast_path != $breast_path_check or $circle_path != $circle_path_check){
			

			if ($return_visit) {
				$return_visit = "'" . $return_visit . "'";
			}
			else {
				$return_visit = 'NULL';
			}
			
			$query = "INSERT INTO women_health_history (women_health_id, client_id, first_name, last_name, sex, location, date_of_birth, t, bp, pr, rr, sao2, pain, lmp, menarche, g_lmp, t_lmp, p_lmp, l_lmp, family_planning, past_cancer_screening, life_sex_partners, year_sex_partners, cd4_count, history, via_preformed, cryo_preformed, colpo_preformed, biopsies, biopsies_comment, physical_exam_continued, plan, metronidazole_400mg, metronidazole_2gm, azithromycin, ceftriaxone, fluconazole, clotrimazole, lbuprofen, paracetamol, pyridium, septrim, amoxil, family_planning_bottom, family_planning_comment, via_months, via_months_count, colposcopy, colposcopy_month_count, biopsy_results, biopsy_results_count, referral, return_visit, vigina_path, breast_path, circle_path, timestamp, clinician, created_by) SELECT women_health_id, client_id, first_name, last_name, sex, location, date_of_birth, t, bp, pr, rr, sao2, pain, lmp, menarche, g_lmp, t_lmp, p_lmp, l_lmp, family_planning, past_cancer_screening, life_sex_partners, year_sex_partners, cd4_count, history, via_preformed, cryo_preformed, colpo_preformed, biopsies, biopsies_comment, physical_exam_continued, plan, metronidazole_400mg, metronidazole_2gm, azithromycin, ceftriaxone, fluconazole, clotrimazole, lbuprofen, paracetamol, pyridium, septrim, amoxil, family_planning_bottom, family_planning_comment, via_months, via_months_count, colposcopy, colposcopy_month_count, biopsy_results, biopsy_results_count, referral, return_visit, vigina_path, breast_path, circle_path, timestamp, clinician, created_by FROM women_health WHERE women_health_id='$choosen_women_health_id';"; 
			$conn->exec($query);
			
			$query = "UPDATE women_health SET t='$t', bp='$bp', pr='$pr', rr='$rr', sao2='$sao2', pain='$pain', lmp='$lmp', menarche='$menarche', g_lmp='$g_lmp', t_lmp='$t_lmp', p_lmp='$p_lmp', l_lmp='$l_lmp', family_planning='$family_planning', past_cancer_screening='$past_cancer_screening', life_sex_partners='$life_sex_partners', year_sex_partners='$year_sex_partners', cd4_count='$cd4_count', history='$history', via_preformed='$via_preformed', cryo_preformed='$cryo_preformed', colpo_preformed='$colpo_preformed', biopsies='$biopsies', biopsies_comment='$biopsies_comment', physical_exam_continued='$physical_exam_continued', plan='$plan', metronidazole_400mg='$metronidazole_400mg', metronidazole_2gm='$metronidazole_2gm', azithromycin='$azithromycin', ceftriaxone='$ceftriaxone', fluconazole='$fluconazole', clotrimazole='$clotrimazole', lbuprofen='$lbuprofen', paracetamol='$paracetamol', pyridium='$pyridium', septrim='$septrim', amoxil='$amoxil', family_planning_bottom='$family_planning_bottom', family_planning_comment='$family_planning_comment', via_months='$via_months', via_months_count='$via_months_count', colposcopy='$colposcopy', colposcopy_month_count='$colposcopy_month_count', biopsy_results='$biopsy_results', biopsy_results_count='$biopsy_results_count', referral='$referral', return_visit=$return_visit, clinician='$clinician', created_by='$username', vigina_path='$vigina_path', breast_path='$breast_path', circle_path='$circle_path' WHERE women_health_id='$choosen_women_health_id';"; 
			$conn->exec($query);
		
		}
		
		// redirect user back to where they can select a women's health form
		header( 'Location: select_women_health.php');
	    exit();
	}

	catch(PDOException $e) {
		create_database_error($query, 'update_women_health.php', $e->getMessage());	
	}

		$conn = null;

	}
	
}
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

$clinician = $_POST['clinician'];

// single quotes need to be replaced with the correct excape keys for the following value
$clinician = str_replace('\'', '\\\'', $clinician);

class clinician_check extends RecursiveIteratorIterator {
			function __construct($it) {
				parent::__construct($it, self::LEAVES_ONLY);
			}
			function current() {
				parent::current();
			}
			function beginChildren() {
				echo "<tr>";
			}
			function endChildren() {
				echo "</tr>" . "\n";
			}
}

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
		
		// check to see if the clinician account exists
		$stmt = $conn->prepare("SELECT username FROM accounts WHERE username='$clinician'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new clinician_check(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			echo $v;
			++$count;
		}

// if account exists		
if ($count){

	$screening_site = $_POST['screening_site'];
	
	// single quotes need to be replaced with the correct excape keys for the following value
	$screening_site = str_replace('\'', '\\\'', $screening_site);
	
	$far_vision = $_POST['far_vision'];
	
	if ($far_vision){
		$far_vision = "yes";
	}
	else {
		$far_vision = "no";
	}
	
	
	
	$near_vision = $_POST['near_vision'];
	
	if ($near_vision){
		$near_vision = "yes";
	}
	else {
		$near_vision = "no";
	}
	
	
	
	$hypertension = $_POST['hypertension'];
	
	if ($hypertension){
		$hypertension = "yes";
	}
	else {
		$hypertension = "no";
	}
	
	
	
	$diabetes = $_POST['diabetes'];
	
	if ($diabetes){
		$diabetes = "yes";
	}
	else {
		$diabetes = "no";
	}
	
	
	
	$allergy = $_POST['allergy'];
	
	if ($allergy){
		$allergy = "yes";
	}
	else {
		$allergy = "no";
	}
	
	$other = $_POST['other'];
	$comment = $_POST['comment'];
	
	// single quotes need to be replaced with the correct excape keys for the following values
	$other = str_replace('\'', '\\\'', $other);
	$comment = str_replace('\'', '\\\'', $comment);
	
	
	$no_lenses_right_far = $_POST['no_lenses_right_far'];
	$no_lenses_right_pinhole = $_POST['no_lenses_right_pinhole'];
	$no_lenses_right_near = $_POST['no_lenses_right_near'];
	
	$no_lenses_left_far = $_POST['no_lenses_left_far'];
	$no_lenses_left_pinhole = $_POST['no_lenses_left_pinhole'];
	$no_lenses_left_near = $_POST['no_lenses_left_near'];
	
	$with_lenses_right_far = $_POST['with_lenses_right_far'];
	$with_lenses_right_near = $_POST['with_lenses_right_near'];
	
	$with_lenses_left_far = $_POST['with_lenses_left_far'];
	$with_lenses_left_near = $_POST['with_lenses_left_near'];
	
	
	
	$screening_results_acceptable = $_POST['screening_results_acceptable'];
	
	
	$externals_right = $_POST['externals_right'];
	
	if ($externals_right){
		$externals_right = "yes";
	}
	else {
		$externals_right = "no";
	}
	
	
	
	$externals_left = $_POST['externals_left'];
	
	if ($externals_left){
		$externals_left = "yes";
	}
	else {
		$externals_left = "no";
	}
	
	
	
	$externals_comment = $_POST['externals_comment'];
	
	// single quotes need to be replaced with the correct excape keys for the following value
	$externals_comment = str_replace('\'', '\\\'', $externals_comment);

	
	$pupils_right = $_POST['pupils_right'];
	
	if ($pupils_right){
		$pupils_right = "yes";
	}
	else {
		$pupils_right = "no";
	}
	
	
	
	$pupils_left = $_POST['pupils_left'];
	
	if ($pupils_left){
		$pupils_left = "yes";
	}
	else {
		$pupils_left = "no";
	}
	
	
	
	$pupils_comment = $_POST['pupils_comment'];
	
	// single quotes need to be replaced with the correct excape keys for the following value
	$pupils_comment = str_replace('\'', '\\\'', $pupils_comment);
	
	$opthalmoscopy_right = $_POST['opthalmoscopy_right'];
	$opthalmoscopy_left = $_POST['opthalmoscopy_left'];
	
	// single quotes need to be replaced with the correct excape keys for the following values
	$opthalmoscopy_right = str_replace('\'', '\\\'', $opthalmoscopy_right);
	$opthalmoscopy_left = str_replace('\'', '\\\'', $opthalmoscopy_left);
	
	
	$ar1 = $_POST['ar1'];
	$ar2 = $_POST['ar2'];
	$ar3 = $_POST['ar3'];
	
	// single quotes need to be replaced with the correct excape keys for the following values
	$ar1 = str_replace('\'', '\\\'', $ar1);
	$ar2 = str_replace('\'', '\\\'', $ar2);
	$ar3 = str_replace('\'', '\\\'', $ar3);
	
	$al1 = $_POST['al1'];
	$al2 = $_POST['al2'];
	$al3 = $_POST['al3'];
	
	// single quotes need to be replaced with the correct excape keys for the following values
	$al1 = str_replace('\'', '\\\'', $al1);
	$al2 = str_replace('\'', '\\\'', $al2);
	$al3 = str_replace('\'', '\\\'', $al3);
	
	$br1 = $_POST['br1'];
	$br2 = $_POST['br2'];
	$br3 = $_POST['br3'];
	
	// single quotes need to be replaced with the correct excape keys for the following values
	$br1 = str_replace('\'', '\\\'', $br1);
	$br2 = str_replace('\'', '\\\'', $br2);
	$br3 = str_replace('\'', '\\\'', $br3);
	
	$bl1 = $_POST['bl1'];
	$bl2 = $_POST['bl2'];
	$bl3 = $_POST['bl3'];
	
	// single quotes need to be replaced with the correct excape keys for the following values
	$bl1 = str_replace('\'', '\\\'', $bl1);
	$bl2 = str_replace('\'', '\\\'', $bl2);
	$bl3 = str_replace('\'', '\\\'', $bl3);
	
	$cr1 = $_POST['cr1'];
	$cr2 = $_POST['cr2'];
	$cr3 = $_POST['cr3'];
	
	// single quotes need to be replaced with the correct excape keys for the following values
	$cr1 = str_replace('\'', '\\\'', $cr1);
	$cr2 = str_replace('\'', '\\\'', $cr2);
	$cr3 = str_replace('\'', '\\\'', $cr3);
	
	$cl1 = $_POST['cl1'];
	$cl2 = $_POST['cl2'];
	$cl3 = $_POST['cl3'];
	
	// single quotes need to be replaced with the correct excape keys for the following values
	$cl1 = str_replace('\'', '\\\'', $cl1);
	$cl2 = str_replace('\'', '\\\'', $cl2);
	$cl3 = str_replace('\'', '\\\'', $cl3);
	
	
	
	$tonometry_right = $_POST['tonometry_right'];
	$tonometry_left = $_POST['tonometry_left'];
	
	// single quotes need to be replaced with the correct excape keys for the following values
	$tonometry_right = str_replace('\'', '\\\'', $tonometry_right);
	$tonometry_left = str_replace('\'', '\\\'', $tonometry_left);
	
	$plan = $_POST['plan'];
	
	// single quotes need to be replaced with the correct excape keys for the following values
	$plan = str_replace('\'', '\\\'', $plan);

	$username = $_SESSION['username'];
	$optometry_form_id = $_SESSION['choosen_optometry'];
	
	
	
	
	
	$stmt = $conn->prepare("SELECT screening_site FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$screening_site_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT far_vision FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$far_vision_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT near_vision FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$near_vision_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT hypertension FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$hypertension_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT diabetes FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$diabetes_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT allergy FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$allergy_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT other FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$other_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT comment FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$comment_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT no_lenses_right_far FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$no_lenses_right_far_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT no_lenses_right_pinhole FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$no_lenses_right_pinhole_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT no_lenses_right_near FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$no_lenses_right_near_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT no_lenses_left_far FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$no_lenses_left_far_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT no_lenses_left_pinhole FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$no_lenses_left_pinhole_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT no_lenses_left_near FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$no_lenses_left_near_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT with_lenses_right_far FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$with_lenses_right_far_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT with_lenses_right_near FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$with_lenses_right_near_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT with_lenses_left_far FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$with_lenses_left_far_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT with_lenses_left_near FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$with_lenses_left_near_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT screening_results_acceptable FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$screening_results_acceptable_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT externals_right FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$externals_right_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT externals_left FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$externals_left_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT externals_comment FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$externals_comment_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT pupils_right FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$pupils_right_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT pupils_left FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$pupils_left_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT pupils_comment FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$pupils_comment_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT opthalmoscopy_right FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$opthalmoscopy_right_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT opthalmoscopy_left FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$opthalmoscopy_left_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT ar1 FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$ar1_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT ar2 FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$ar2_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT ar3 FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$ar3_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT al1 FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$al1_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT al2 FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$al2_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT al3 FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$al3_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT br1 FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$br1_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT br2 FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$br2_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT br3 FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$br3_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT bl1 FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$bl1_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT bl2 FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$bl2_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT bl3 FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$bl3_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT cr1 FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$cr1_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT cr2 FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$cr2_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT cr3 FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$cr3_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT cl1 FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$cl1_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT cl2 FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$cl2_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT cl3 FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$cl3_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT tonometry_right FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$tonometry_right_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT tonometry_left FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$tonometry_left_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT plan FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$plan_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT clinician FROM optometry_form WHERE optometry_form_id='$optometry_form_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$clinician_check = $_SESSION['temp'];
	
	
	


	try {
		
		if ($screening_site != $screening_site_check or $far_vision != $far_vision_check or $near_vision != $near_vision_check or $hypertension != $hypertension_check or $diabetes != $diabetes_check or $allergy != $allergy_check or $other != $other_check or $comment != $comment_check or $no_lenses_right_far != $no_lenses_right_far_check or $no_lenses_right_pinhole != $no_lenses_right_pinhole_check or $no_lenses_right_near != $no_lenses_right_near_check or $no_lenses_left_far != $no_lenses_left_far_check or $no_lenses_left_pinhole != $no_lenses_left_pinhole_check or $no_lenses_left_near != $no_lenses_left_near_check or $with_lenses_right_far != $with_lenses_right_far_check or $with_lenses_right_near != $with_lenses_right_near_check or $with_lenses_left_far != $with_lenses_left_far_check or $with_lenses_left_near != $with_lenses_left_near_check or $screening_results_acceptable != $screening_results_acceptable_check or $externals_right != $externals_right_check or $externals_left != $externals_left_check or $externals_comment != $externals_comment_check or $pupils_right != $pupils_right_check or $pupils_left != $pupils_left_check or $pupils_comment != $pupils_comment_check or $opthalmoscopy_right != $opthalmoscopy_right_check or $opthalmoscopy_left != $opthalmoscopy_left_check or $ar1 != $ar1_check or $ar2 != $ar2_check or $ar3 != $ar3_check or $al1 != $al1_check or $al2 != $al2_check or $al3 != $al3_check or $br1 != $br1_check or $br2 != $br2_check or $br3 != $br3_check or $bl1 != $bl1_check or $bl2 != $bl2_check or $bl3 != $bl3_check or $cr1 != $cr1_check or $cr2 != $cr2_check or $cr3 != $cr3_check or $cl1 != $cl1_check or $cl2 != $cl2_check or $cl3 != $cl3_check or $tonometry_right != $tonometry_right_check or $tonometry_left != $tonometry_left_check or $plan != $plan_check or $clinician != $clinician_check) {
		
			$query = "INSERT INTO optometry_form_history (optometry_form_id, client_id, first_name, last_name, sex, location, date_of_birth, occupation, screening_site, far_vision, near_vision, hypertension, diabetes, allergy, other, comment, no_lenses_right_far, no_lenses_right_pinhole, no_lenses_right_near, no_lenses_left_far, no_lenses_left_pinhole, no_lenses_left_near, with_lenses_right_far, with_lenses_right_near, with_lenses_left_far, with_lenses_left_near, screening_results_acceptable, externals_right, externals_left, externals_comment, pupils_right, pupils_left, pupils_comment, opthalmoscopy_right, opthalmoscopy_left, ar1, ar2, ar3, al1, al2, al3, br1, br2, br3, bl1, bl2, bl3, cr1, cr2, cr3, cl1, cl2, cl3, tonometry_right, tonometry_left, plan, timestamp, clinician, created_by) SELECT optometry_form_id, client_id, first_name, last_name, sex, location, date_of_birth, occupation, screening_site, far_vision, near_vision, hypertension, diabetes, allergy, other, comment, no_lenses_right_far, no_lenses_right_pinhole, no_lenses_right_near, no_lenses_left_far, no_lenses_left_pinhole, no_lenses_left_near, with_lenses_right_far, with_lenses_right_near, with_lenses_left_far, with_lenses_left_near, screening_results_acceptable, externals_right, externals_left, externals_comment, pupils_right, pupils_left, pupils_comment, opthalmoscopy_right, opthalmoscopy_left, ar1, ar2, ar3, al1, al2, al3, br1, br2, br3, bl1, bl2, bl3, cr1, cr2, cr3, cl1, cl2, cl3, tonometry_right, tonometry_left, plan, timestamp, clinician, created_by FROM optometry_form WHERE optometry_form_id='$optometry_form_id';"; 
			$conn->exec($query);
		
			// the query
			$query = "UPDATE optometry_form SET screening_site='$screening_site', far_vision='$far_vision', near_vision='$near_vision', hypertension='$hypertension', diabetes='$diabetes', allergy='$allergy', other='$other', comment='$comment', no_lenses_right_far='$no_lenses_right_far', no_lenses_right_pinhole='$no_lenses_right_pinhole', no_lenses_right_near='$no_lenses_right_near', no_lenses_left_far='$no_lenses_left_far', no_lenses_left_pinhole='$no_lenses_left_pinhole', no_lenses_left_near='$no_lenses_left_near', with_lenses_right_far='$with_lenses_right_far', with_lenses_right_near='$with_lenses_right_near', with_lenses_left_far='$with_lenses_left_far', with_lenses_left_near='$with_lenses_left_near', screening_results_acceptable='$screening_results_acceptable', 
					externals_right='$externals_right', externals_left='$externals_left', externals_comment='$externals_comment', pupils_right='$pupils_right', pupils_left='$pupils_left', pupils_comment='$pupils_comment', opthalmoscopy_right='$opthalmoscopy_right', opthalmoscopy_left='$opthalmoscopy_left', ar1='$ar1', ar2='$ar2', ar3='$ar3', al1='$al1', al2='$al2', al3='$al3', br1='$br1', br2='$br2', br3='$br3', bl1='$bl1', bl2='$bl2', bl3='$bl3', cr1='$cr1', cr2='$cr2', cr3='$cr3', cl1='$cl1', cl2='$cl2', cl3='$cl3', tonometry_right='$tonometry_right', tonometry_left='$tonometry_left', plan='$plan', clinician='$clinician'  
			
			WHERE optometry_form_id='$optometry_form_id';"; 
			
			// run the query
			$stmt = $conn->prepare($query);
			$stmt->execute();
			
		
		}
		
		// redirect the user back to client overview
		header( 'Location: /php/view_change_any_client_forms/view_all_form.php');
		exit();
		
	}

	catch(PDOException $e) {
		create_database_error($query, 'update_optometry_form.php (client)', $e->getMessage());
	}

		$conn = null;

}
		
// if account does not exist
else {
	echo "<script type='text/javascript'>
			alert('The clinician you have provided was not found in the database.'); 
			document.location.href = 'select_optometry.php'; 
		 </script>";
	}
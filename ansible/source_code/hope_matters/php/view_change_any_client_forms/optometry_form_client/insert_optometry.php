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
		
	// make database connection
	$conn = new PDO($dbconnection, $dbusername, $dbpassword);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
	// check to see if the clinician account exists
	$stmt = $conn->prepare("SELECT username FROM accounts WHERE username='$clinician';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new clinician_check(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		echo $v;
		++$count;
	}

// if exists	
if ($count){

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
	
		// get general info from session varibles
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
		
		
		// grab occupation
		$stmt = $conn->prepare("SELECT occupation FROM general_info WHERE client_id='$client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$occupation = $_SESSION['temp'];
		
		
	
	// single quotes need to be replaced with the correct excape keys for the following values
	$first_name = str_replace('\'', '\\\'', $first_name);
	$last_name = str_replace('\'', '\\\'', $last_name);
	$location = str_replace('\'', '\\\'', $location);
	$occupation = str_replace('\'', '\\\'', $occupation);

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

	try {
	
		// the insert query
		$query = "INSERT INTO optometry_form (client_id, first_name, last_name, sex, location, date_of_birth, occupation, screening_site, far_vision, near_vision, hypertension, diabetes, allergy, other, comment, no_lenses_right_far, no_lenses_right_pinhole, no_lenses_right_near, no_lenses_left_far, no_lenses_left_pinhole, no_lenses_left_near, with_lenses_right_far, with_lenses_right_near, with_lenses_left_far, with_lenses_left_near, screening_results_acceptable, externals_right, externals_left, externals_comment, pupils_right, pupils_left, pupils_comment, opthalmoscopy_right, opthalmoscopy_left, ar1, ar2, ar3, al1, al2, al3, br1, br2, br3, bl1, bl2, bl3, cr1, cr2, cr3, cl1, cl2, cl3, tonometry_right, tonometry_left, plan, clinician, created_by  ) 
		          VALUES ('$client_id', '$first_name', '$last_name', '$sex', '$location', '$date_of_birth', '$occupation', '$screening_site', '$far_vision', '$near_vision', '$hypertension', '$diabetes', '$allergy', '$other', '$comment', '$no_lenses_right_far', '$no_lenses_right_pinhole', '$no_lenses_right_near', '$no_lenses_left_far', '$no_lenses_left_pinhole', '$no_lenses_left_near', '$with_lenses_right_far', '$with_lenses_right_near', '$with_lenses_left_far', '$with_lenses_left_near', '$screening_results_acceptable', '$externals_right', '$externals_left', '$externals_comment', '$pupils_right', '$pupils_left', '$pupils_comment', '$opthalmoscopy_right', '$opthalmoscopy_left', '$ar1', '$ar2', '$ar3', '$al1', '$al2', '$al3', '$br1', '$br2', '$br3', '$bl1', '$bl2', '$bl3', '$cr1', '$cr2', '$cr3', '$cl1', '$cl2', '$cl3', '$tonometry_right', '$tonometry_left', '$plan', '$clinician', '$username' );"; 
		$conn->exec($query);
		
		// redirect user back to where they can select optometry forms
		header( 'Location: /php/view_change_any_client_forms/view_all_form.php');
		exit();
		
	}

	catch(PDOException $e) {
		create_database_error($query, 'insert_optometry_form.php (client)', $e->getMessage());	
	}

	$conn = null;

}

// if it does not exist
else {
	echo "<script type='text/javascript'>
			alert('The clinician you have provided was not found in the database.'); 
			document.location.href = 'select_client_optometry.php'; 
		  </script>";		
}
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
	$username = $_SESSION['username'];

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
	
	
	$child_particulars = $_POST['child_particulars'];
	if ($child_particulars) {
		$child_particulars = "'" . $child_particulars . "'";
	}
	else {
		$child_particulars = 'NULL';
	}
	

	
	
	$child_name = $_POST['child_name'];
	$child_gender = $_POST['child_gender'];
	$child_date_of_birth = $_POST['child_date_of_birth'];
	$birth_weight = $_POST['birth_weight'];
	if ($birth_weight) {
		$birth_weight = "'" . $birth_weight . "'";
	}
	else {
		$birth_weight = 'NULL';
	}
	
	$birth_length = $_POST['birth_length'];
	if ($birth_length) {
		$birth_length = "'" . $birth_length . "'";
	}
	else {
		$birth_length = 'NULL';
	}
	$birth_characteristics = $_POST['birth_characteristics'];
	$birth_order = $_POST['birth_order'];
	if ($birth_order) {
		$birth_order = "'" . $birth_order . "'";
	}
	else {
		$birth_order = 'NULL';
	}
	
	$first_seen = $_POST['first_seen'];

	$birth_place = $_POST['birth_place'];
	$other_birth_place = $_POST['other_birth_place'];
	$notification_number = $_POST['notification_number'];
	$notification_date = $_POST['notification_date'];
	if ($notification_date) {
		$notification_date = "'" . $notification_date . "'";
	}
	else {
		$notification_date = 'NULL';
	}
	
	$register_number = $_POST['register_number'];
	$child_welfare_clinic = $_POST['child_welfare_clinic'];
	$health_facility = $_POST['health_facility'];
	$master_facility_list_number = $_POST['master_facility_list_number'];
	
	$birth_certificate_number = $_POST['birth_certificate_number'];
	$registration_date = $_POST['registration_date'];
	if ($registration_date) {
		$registration_date = "'" . $registration_date . "'";
	}
	else {
		$registration_date = 'NULL';
	}
	
	$registration_place = $_POST['registration_place'];
	$abnormalities = $_POST['abnormalities'];
	
	$father_name = $_POST['father_name'];
	$father_phone_number = $_POST['father_phone_number'];
	$mother_name = $_POST['mother_name'];
	$mother_phone_number = $_POST['mother_phone_number'];
	$guardian_name = $_POST['guardian_name'];
	$guardian_phone_number = $_POST['guardian_phone_number'];
	$country = $_POST['country'];
	$district = $_POST['district'];
	$division = $_POST['division'];
	$child_location = $_POST['child_location'];
	$town = $_POST['town'];
	$village = $_POST['village'];
	$post_address = $_POST['post_address'];
	
	$age_first_contact = $_POST['age_first_contact'];
	if ($age_first_contact) {
		$age_first_contact = "'" . $age_first_contact . "'";
	}
	else {
		$age_first_contact = 'NULL';
	}
	
	$weight = $_POST['weight'];
	if ($weight) {
		$weight = "'" . $weight . "'";
	}
	else {
		$weight = 'NULL';
	}
	
	$height = $_POST['height'];
	if ($height) {
		$height = "'" . $height . "'";
	}
	else {
		$height = 'NULL';
	}
	
	$physical_features = $_POST['physical_features'];
	$colouration = $_POST['colouration'];
	$head_circumference = $_POST['head_circumference'];
	if ($head_circumference) {
		$head_circumference = "'" . $head_circumference . "'";
	}
	else {
		$head_circumference = 'NULL';
	}
	
	$eyes = $_POST['eyes'];
	$mouth = $_POST['mouth'];
	$chest = $_POST['chest'];
	$heart = $_POST['heart'];
	$abdomen = $_POST['abdomen'];
	$umbilicus = $_POST['umbilicus'];
	$spine = $_POST['spine'];
	$arms_and_hands = $_POST['arms_and_hands'];
	$legs_and_feet = $_POST['legs_and_feet'];
	$genitalia = $_POST['genitalia'];
	$anus = $_POST['anus'];
	
	$breastfeeding = $_POST['breastfeeding'];
	if ($breastfeeding) {
		$breastfeeding = "'" . $breastfeeding . "'";
	}
	else {
		$breastfeeding = 'NULL';
	}
	
	$feeds = $_POST['feeds'];
	if ($feeds) {
		$feeds = "'" . $feeds . "'";
	}
	else {
		$feeds = 'NULL';
	}
	
	$feeds_age = $_POST['feeds_age'];
	if ($feeds_age) {
		$feeds_age = "'" . $feeds_age . "'";
	}
	else {
		$feeds_age = 'NULL';
	}
	
	$other_foods_introduced = $_POST['other_foods_introduced'];
	if ($other_foods_introduced) {
		$other_foods_introduced = "'" . $other_foods_introduced . "'";
	}
	else {
		$other_foods_introduced = 'NULL';
	}
	
	$indigestion = $_POST['indigestion'];

	
	$sleep_cycle = $_POST['sleep_cycle'];
	$irritability = $_POST['irritability'];
	if ($irritability) {
		$irritability = "'" . $irritability . "'";
	}
	else {
		$irritability = 'NULL';
	}
	
	$finger_sucking = $_POST['finger_sucking'];
	if ($finger_sucking) {
		$finger_sucking = "'" . $finger_sucking . "'";
	}
	else {
		$finger_sucking = 'NULL';
	}
	
	$others = $_POST['others'];
	if ($others) {
		$others = "'" . $others . "'";
	}
	else {
		$others = 'NULL';
	}
	
	$mis_05_given = $_POST['mis_05_given'];
	if ($mis_05_given) {
		$mis_05_given = "'" . $mis_05_given . "'";
	}
	else {
		$mis_05_given = 'NULL';
	}
	
	$mis_05_next_visit = $_POST['mis_05_next_visit'];
	if ($mis_05_next_visit) {
		$mis_05_next_visit = "'" . $mis_05_next_visit . "'";
	}
	else {
		$mis_05_next_visit = 'NULL';
	}
	
	$mis_1_given = $_POST['mis_1_given'];
	if ($mis_1_given) {
		$mis_1_given = "'" . $mis_1_given . "'";
	}
	else {
		$mis_1_given = 'NULL';
	}
	
	$mis_1_next_visit = $_POST['mis_1_next_visit'];
	if ($mis_1_next_visit) {
		$mis_1_next_visit = "'" . $mis_1_next_visit . "'";
	}
	else {
		$mis_1_next_visit = 'NULL';
	}
	
	$present_checked = $_POST['present_checked'];
	if ($present_checked) {
		$present_checked = "'" . $present_checked . "'";
	}
	else {
		$present_checked = 'NULL';
	}
	
	$present_repeated = $_POST['present_repeated'];
	if ($present_repeated) {
		$present_repeated = "'" . $present_repeated . "'";
	}
	else {
		$present_repeated = 'NULL';
	}
	
	$absent_checked = $_POST['absent_checked'];
	if ($absent_checked) {
		$absent_checked = "'" . $absent_checked . "'";
	}
	else {
		$absent_checked = 'NULL';
	}
	
	$absent_repeated = $_POST['absent_repeated'];
	if ($absent_repeated) {
		$absent_repeated = "'" . $absent_repeated . "'";
	}
	else {
		$absent_repeated = 'NULL';
	}
	
	$birth_dose_given = $_POST['birth_dose_given'];
	if ($birth_dose_given) {
		$birth_dose_given = "'" . $birth_dose_given . "'";
	}
	else {
		$birth_dose_given = 'NULL';
	}
	
	$birth_does_next_visit = $_POST['birth_does_next_visit'];
	if ($birth_does_next_visit) {
		$birth_does_next_visit = "'" . $birth_does_next_visit . "'";
	}
	else {
		$birth_does_next_visit = 'NULL';
	}
	
	$pollo_first_dose_given = $_POST['pollo_first_dose_given'];
	if ($pollo_first_dose_given) {
		$pollo_first_dose_given = "'" . $pollo_first_dose_given . "'";
	}
	else {
		$pollo_first_dose_given = 'NULL';
	}
	
	$pollo_first_does_next_visit = $_POST['pollo_first_does_next_visit'];
	if ($pollo_first_does_next_visit) {
		$pollo_first_does_next_visit = "'" . $pollo_first_does_next_visit . "'";
	}
	else {
		$pollo_first_does_next_visit = 'NULL';
	}
	
	$pollo_second_dose_given = $_POST['pollo_second_dose_given'];
	if ($pollo_second_dose_given) {
		$pollo_second_dose_given = "'" . $pollo_second_dose_given . "'";
	}
	else {
		$pollo_second_dose_given = 'NULL';
	}
	
	$pollo_second_does_next_visit = $_POST['pollo_second_does_next_visit'];
	if ($pollo_second_does_next_visit) {
		$pollo_second_does_next_visit = "'" . $pollo_second_does_next_visit . "'";
	}
	else {
		$pollo_second_does_next_visit = 'NULL';
	}
	
	$pollo_third_dose_given = $_POST['pollo_third_dose_given'];
	if ($pollo_third_dose_given) {
		$pollo_third_dose_given = "'" . $pollo_third_dose_given . "'";
	}
	else {
		$pollo_third_dose_given = 'NULL';
	}
	
	$pollo_third_does_next_visit = $_POST['pollo_third_does_next_visit'];
	if ($pollo_third_does_next_visit) {
		$pollo_third_does_next_visit = "'" . $pollo_third_does_next_visit . "'";
	}
	else {
		$pollo_third_does_next_visit = 'NULL';
	}
	
	$dphtheria_first_dose_given = $_POST['dphtheria_first_dose_given'];
	if ($dphtheria_first_dose_given) {
		$dphtheria_first_dose_given = "'" . $dphtheria_first_dose_given . "'";
	}
	else {
		$dphtheria_first_dose_given = 'NULL';
	}
	
	$dphtheria_first_dose_next_visit = $_POST['dphtheria_first_dose_next_visit'];
	if ($dphtheria_first_dose_next_visit) {
		$dphtheria_first_dose_next_visit = "'" . $dphtheria_first_dose_next_visit . "'";
	}
	else {
		$dphtheria_first_dose_next_visit = 'NULL';
	}
	
	$dphtheria_second_dose_given = $_POST['dphtheria_second_dose_given'];
	if ($dphtheria_second_dose_given) {
		$dphtheria_second_dose_given = "'" . $dphtheria_second_dose_given . "'";
	}
	else {
		$dphtheria_second_dose_given = 'NULL';
	}
	
	$dphtheria_second_does_next_visit = $_POST['dphtheria_second_does_next_visit'];
	if ($dphtheria_second_does_next_visit) {
		$dphtheria_second_does_next_visit = "'" . $dphtheria_second_does_next_visit . "'";
	}
	else {
		$dphtheria_second_does_next_visit = 'NULL';
	}
	
	$dphtheria_third_dose_given = $_POST['dphtheria_third_dose_given'];
	if ($dphtheria_third_dose_given) {
		$dphtheria_third_dose_given = "'" . $dphtheria_third_dose_given . "'";
	}
	else {
		$dphtheria_third_dose_given = 'NULL';
	}
	
	$dphtheria_third_does_next_visit = $_POST['dphtheria_third_does_next_visit'];
	if ($dphtheria_third_does_next_visit) {
		$dphtheria_third_does_next_visit = "'" . $dphtheria_third_does_next_visit . "'";
	}
	else {
		$dphtheria_third_does_next_visit = 'NULL';
	}
	
	
	$pneumococcal_first_dose_given = $_POST['pneumococcal_first_dose_given'];
	if ($pneumococcal_first_dose_given) {
		$pneumococcal_first_dose_given = "'" . $pneumococcal_first_dose_given . "'";
	}
	else {
		$pneumococcal_first_dose_given = 'NULL';
	}
	
	$pneumococcal_first_does_next_visit = $_POST['pneumococcal_first_does_next_visit'];
	if ($pneumococcal_first_does_next_visit) {
		$pneumococcal_first_does_next_visit = "'" . $pneumococcal_first_does_next_visit . "'";
	}
	else {
		$pneumococcal_first_does_next_visit = 'NULL';
	}
	
	$pneumococcal_second_dose_given = $_POST['pneumococcal_second_dose_given'];
	if ($pneumococcal_second_dose_given) {
		$pneumococcal_second_dose_given = "'" . $pneumococcal_second_dose_given . "'";
	}
	else {
		$pneumococcal_second_dose_given = 'NULL';
	}
	
	$pneumococcal_second_does_next_visit = $_POST['pneumococcal_second_does_next_visit'];
	if ($pneumococcal_second_does_next_visit) {
		$pneumococcal_second_does_next_visit = "'" . $pneumococcal_second_does_next_visit . "'";
	}
	else {
		$pneumococcal_second_does_next_visit = 'NULL';
	}
	
	$pneumococcal_third_dose_given = $_POST['pneumococcal_third_dose_given'];
	if ($pneumococcal_third_dose_given) {
		$pneumococcal_third_dose_given = "'" . $pneumococcal_third_dose_given . "'";
	}
	else {
		$pneumococcal_third_dose_given = 'NULL';
	}
	
	$pneumococcal_third_does_next_visit = $_POST['pneumococcal_third_does_next_visit'];
	if ($pneumococcal_third_does_next_visit) {
		$pneumococcal_third_does_next_visit = "'" . $pneumococcal_third_does_next_visit . "'";
	}
	else {
		$pneumococcal_third_does_next_visit = 'NULL';
	}
	
	$rota_first_dose_given = $_POST['rota_first_dose_given'];
	if ($rota_first_dose_given) {
		$rota_first_dose_given = "'" . $rota_first_dose_given . "'";
	}
	else {
		$rota_first_dose_given = 'NULL';
	}
	
	$rota_first_does_next_visit = $_POST['rota_first_does_next_visit'];
	if ($rota_first_does_next_visit) {
		$rota_first_does_next_visit = "'" . $rota_first_does_next_visit . "'";
	}
	else {
		$rota_first_does_next_visit = 'NULL';
	}
	
	$rota_second_dose_given = $_POST['rota_second_dose_given'];
	if ($rota_second_dose_given) {
		$rota_second_dose_given = "'" . $rota_second_dose_given . "'";
	}
	else {
		$rota_second_dose_given = 'NULL';
	}
	
	$rota_second_does_next_visit = $_POST['rota_second_does_next_visit'];
	if ($rota_second_does_next_visit) {
		$rota_second_does_next_visit = "'" . $rota_second_does_next_visit . "'";
	}
	else {
		$rota_second_does_next_visit = 'NULL';
	}
	
	
	$measles_6_months_date = $_POST['measles_6_months_date'];
	if ($measles_6_months_date) {
		$measles_6_months_date = "'" . $measles_6_months_date . "'";
	}
	else {
		$measles_6_months_date = 'NULL';
	}
	
	$measles_9_months_date = $_POST['measles_9_months_date'];
	if ($measles_9_months_date) {
		$measles_9_months_date = "'" . $measles_9_months_date . "'";
	}
	else {
		$measles_9_months_date = 'NULL';
	}
	
	$measles_18_months_date = $_POST['measles_18_months_date'];
	if ($measles_18_months_date) {
		$measles_18_months_date = "'" . $measles_18_months_date . "'";
	}
	else {
		$measles_18_months_date = 'NULL';
	}
	
	$yellow_fever_date = $_POST['yellow_fever_date'];
	if ($yellow_fever_date) {
		$yellow_fever_date = "'" . $yellow_fever_date . "'";
	}
	else {
		$yellow_fever_date = 'NULL';
	}
	
	$other_vaccine = $_POST['other_vaccine'];
	
	
	try {
		
		$query = "INSERT INTO child_welfare_care (client_id, first_name, last_name, sex, location, date_of_birth, child_particulars, child_name, child_gender, child_date_of_birth, birth_weight, birth_length, birth_characteristics, birth_order, first_seen, birth_place, other_birth_place, notification_number, notification_date, register_number, child_welfare_clinic, health_facility, master_facility_list_number, birth_certificate_number, registration_date, registration_place, abnormalities, father_name, father_phone_number, mother_name, mother_phone_number, guardian_name, guardian_phone_number, country, district, division, child_location, town, village, post_address, age_first_contact, weight, height, physical_features, colouration, head_circumference, eyes, mouth, chest, heart, abdomen, umbilicus, spine, arms_and_hands, legs_and_feet, genitalia, anus, breastfeeding, feeds, feeds_age, other_foods_introduced, indigestion, sleep_cycle, irritability, finger_sucking, others, mis_05_given, mis_05_next_visit, mis_1_given, mis_1_next_visit, present_checked, present_repeated, absent_checked, absent_repeated, birth_dose_given, birth_does_next_visit, pollo_first_dose_given, pollo_first_does_next_visit, pollo_second_dose_given, pollo_second_does_next_visit, pollo_third_dose_given, pollo_third_does_next_visit, dphtheria_first_dose_given, dphtheria_first_dose_next_visit, dphtheria_second_dose_given, dphtheria_second_does_next_visit, dphtheria_third_dose_given, dphtheria_third_does_next_visit, pneumococcal_first_dose_given, pneumococcal_first_does_next_visit, pneumococcal_second_dose_given, pneumococcal_second_does_next_visit, pneumococcal_third_dose_given, pneumococcal_third_does_next_visit, rota_first_dose_given, rota_first_does_next_visit, rota_second_dose_given, rota_second_does_next_visit, measles_6_months_date, measles_9_months_date, measles_18_months_date, yellow_fever_date, other_vaccine, created_by) VALUES ('$client_id', '$first_name', '$last_name', '$sex', '$location', '$date_of_birth', $child_particulars, '$child_name', '$child_gender', '$child_date_of_birth', $birth_weight, $birth_length, '$birth_characteristics', $birth_order, '$first_seen', '$birth_place', '$other_birth_place', '$notification_number', $notification_date, '$register_number', '$child_welfare_clinic', '$health_facility', '$master_facility_list_number', '$birth_certificate_number', $registration_date, '$registration_place', '$abnormalities', '$father_name', '$father_phone_number', '$mother_name', '$mother_phone_number', '$guardian_name', '$guardian_phone_number', '$country', '$district', '$division', '$child_location', '$town', '$village', '$post_address', age_first_contact, weight, height, '$physical_features', '$colouration', head_circumference, '$eyes', '$mouth', '$chest', '$heart', '$abdomen', '$umbilicus', '$spine', '$arms_and_hands', '$legs_and_feet', '$genitalia', '$anus', breastfeeding, feeds, feeds_age, other_foods_introduced, '$indigestion', '$sleep_cycle', $irritability, $finger_sucking, $others, $mis_05_given, $mis_05_next_visit, $mis_1_given, $mis_1_next_visit, $present_checked, $present_repeated, $absent_checked, $absent_repeated, $birth_dose_given, $birth_does_next_visit, $pollo_first_dose_given, $pollo_first_does_next_visit, $pollo_second_dose_given, $pollo_second_does_next_visit, $pollo_third_dose_given, $pollo_third_does_next_visit, $dphtheria_first_dose_given, $dphtheria_first_dose_next_visit, $dphtheria_second_dose_given, $dphtheria_second_does_next_visit, $dphtheria_third_dose_given, $dphtheria_third_does_next_visit, $pneumococcal_first_dose_given, $pneumococcal_first_does_next_visit, $pneumococcal_second_dose_given, $pneumococcal_second_does_next_visit, $pneumococcal_third_dose_given, $pneumococcal_third_does_next_visit, $rota_first_dose_given, $rota_first_does_next_visit, $rota_second_dose_given, $rota_second_does_next_visit, $measles_6_months_date, $measles_9_months_date, $measles_18_months_date, $yellow_fever_date, '$other_vaccine', '$username');"; 
		$conn->exec($query);
		
		header( 'Location: /php/view_change_any_client_forms/view_all_form.php');
		exit();
		
	}

	catch(PDOException $e) {
		create_database_error($query, 'insert_child_welfare_care.php (client)', $e->getMessage());
	}

	$conn = null;
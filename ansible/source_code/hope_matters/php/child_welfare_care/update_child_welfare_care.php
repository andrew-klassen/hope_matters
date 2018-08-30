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

		
	// make database connection
	$conn = new PDO($dbconnection, $dbusername, $dbpassword);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
	
    $choosen_child_welfare_care = $_SESSION['choosen_child_welfare_care'];
	$username = $_SESSION['username'];

	// grab first name
		$stmt = $conn->prepare("SELECT first_name FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$first_name = $_SESSION['temp'];
		
		
		// grab last name
		$stmt = $conn->prepare("SELECT last_name FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$last_name = $_SESSION['temp'];
		
		
		// grab sex
		$stmt = $conn->prepare("SELECT sex FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$sex = $_SESSION['temp'];
		
		
		// grab location
		$stmt = $conn->prepare("SELECT location FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$location = $_SESSION['temp'];
		
		
		// grab date of birth
		$stmt = $conn->prepare("SELECT date_of_birth FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$date_of_birth = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT client_id FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$client_id = $_SESSION['temp'];
	
	// single quotes need to be replaced with the correct excape keys for the following values
	$first_name = str_replace('\'', '\\\'', $first_name);
	$last_name = str_replace('\'', '\\\'', $last_name);
	$location = str_replace('\'', '\\\'', $location);
	
	
	$child_particulars = $_POST['child_particulars'];
	

	$child_name = $_POST['child_name'];
	$child_gender = $_POST['child_gender'];
	$child_date_of_birth = $_POST['child_date_of_birth'];
	$birth_weight = $_POST['birth_weight'];
	
	
	$birth_length = $_POST['birth_length'];
	
	$birth_characteristics = $_POST['birth_characteristics'];
	$birth_order = $_POST['birth_order'];
	
	
	$first_seen = $_POST['first_seen'];

	$birth_place = $_POST['birth_place'];
	$other_birth_place = $_POST['other_birth_place'];
	$notification_number = $_POST['notification_number'];
	$notification_date = $_POST['notification_date'];
	$register_number = $_POST['register_number'];
	$child_welfare_clinic = $_POST['child_welfare_clinic'];
	$health_facility = $_POST['health_facility'];
	$master_facility_list_number = $_POST['master_facility_list_number'];
	
	$birth_certificate_number = $_POST['birth_certificate_number'];
	$registration_date = $_POST['registration_date'];
	
	
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
	
	
	$weight = $_POST['weight'];
	
	
	$height = $_POST['height'];
	
	
	$physical_features = $_POST['physical_features'];
	$colouration = $_POST['colouration'];
	$head_circumference = $_POST['head_circumference'];
	
	
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
	
	
	$feeds = $_POST['feeds'];
	
	
	$feeds_age = $_POST['feeds_age'];
	
	
	$other_foods_introduced = $_POST['other_foods_introduced'];
	
	
	$indigestion = $_POST['indigestion'];

	
	$sleep_cycle = $_POST['sleep_cycle'];
	$irritability = $_POST['irritability'];
	
	
	$finger_sucking = $_POST['finger_sucking'];
	
	
	$others = $_POST['others'];
	
	
	$mis_05_given = $_POST['mis_05_given'];
	
	
	$mis_05_next_visit = $_POST['mis_05_next_visit'];
	
	
	$mis_1_given = $_POST['mis_1_given'];
	
	
	$mis_1_next_visit = $_POST['mis_1_next_visit'];
	
	
	$present_checked = $_POST['present_checked'];
	
	
	$present_repeated = $_POST['present_repeated'];
	
	
	$absent_checked = $_POST['absent_checked'];
	
	
	$absent_repeated = $_POST['absent_repeated'];
	
	
	$birth_dose_given = $_POST['birth_dose_given'];
	
	
	$birth_does_next_visit = $_POST['birth_does_next_visit'];
	
	
	$pollo_first_dose_given = $_POST['pollo_first_dose_given'];
	
	
	$pollo_first_does_next_visit = $_POST['pollo_first_does_next_visit'];
	
	
	$pollo_second_dose_given = $_POST['pollo_second_dose_given'];
	
	
	$pollo_second_does_next_visit = $_POST['pollo_second_does_next_visit'];
	
	
	$pollo_third_dose_given = $_POST['pollo_third_dose_given'];
	
	
	$pollo_third_does_next_visit = $_POST['pollo_third_does_next_visit'];
	
	
	$dphtheria_first_dose_given = $_POST['dphtheria_first_dose_given'];
	
	
	$dphtheria_first_dose_next_visit = $_POST['dphtheria_first_dose_next_visit'];
	
	
	$dphtheria_second_dose_given = $_POST['dphtheria_second_dose_given'];
	
	
	$dphtheria_second_does_next_visit = $_POST['dphtheria_second_does_next_visit'];
	
	
	$dphtheria_third_dose_given = $_POST['dphtheria_third_dose_given'];
	
	
	$dphtheria_third_does_next_visit = $_POST['dphtheria_third_does_next_visit'];
	
	
	
	$pneumococcal_first_dose_given = $_POST['pneumococcal_first_dose_given'];
	
	
	$pneumococcal_first_does_next_visit = $_POST['pneumococcal_first_does_next_visit'];
	
	$pneumococcal_second_dose_given = $_POST['pneumococcal_second_dose_given'];
	
	
	$pneumococcal_second_does_next_visit = $_POST['pneumococcal_second_does_next_visit'];
	
	
	$pneumococcal_third_dose_given = $_POST['pneumococcal_third_dose_given'];

	
	$pneumococcal_third_does_next_visit = $_POST['pneumococcal_third_does_next_visit'];

	
	$rota_first_dose_given = $_POST['rota_first_dose_given'];

	
	$rota_first_does_next_visit = $_POST['rota_first_does_next_visit'];

	
	$rota_second_dose_given = $_POST['rota_second_dose_given'];

	
	$rota_second_does_next_visit = $_POST['rota_second_does_next_visit'];

	
	
	$measles_6_months_date = $_POST['measles_6_months_date'];

	
	$measles_9_months_date = $_POST['measles_9_months_date'];

	
	$measles_18_months_date = $_POST['measles_18_months_date'];

	
	$yellow_fever_date = $_POST['yellow_fever_date'];
	
	$other_vaccine = $_POST['other_vaccine'];
	
	
	
	
	
	
	
	
	
	
	
	
	
		$stmt = $conn->prepare("SELECT child_particulars FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$child_particulars_check = $_SESSION['temp'];
	
	
		$stmt = $conn->prepare("SELECT child_name FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$child_name_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT child_gender FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$child_gender_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT child_date_of_birth FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$child_date_of_birth_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT birth_weight FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$birth_weight_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT birth_length FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$birth_length_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT birth_characteristics FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$birth_characteristics_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT birth_order FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$birth_order_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT first_seen FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$first_seen_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT birth_place FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$birth_place_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT other_birth_place FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$other_birth_place_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT notification_number FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$notification_number_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT notification_date FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$notification_date_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT register_number FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$register_number_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT child_welfare_clinic FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$child_welfare_clinic_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT health_facility FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$health_facility_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT master_facility_list_number FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$master_facility_list_number_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT birth_certificate_number FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$birth_certificate_number_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT registration_date FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$registration_date_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT registration_place FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$registration_place_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT abnormalities FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$abnormalities_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT father_name FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$father_name_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT father_phone_number FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$father_phone_number_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT mother_name FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$mother_name_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT mother_phone_number FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$mother_phone_number_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT guardian_name FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$guardian_name_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT guardian_phone_number FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$guardian_phone_number_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT country FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$country_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT district FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$district_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT division FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$division_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT child_location FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$child_location_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT town FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$town_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT village FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$village_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT post_address FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$post_address_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT age_first_contact FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$age_first_contact_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT weight FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$weight_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT height FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$height_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT physical_features FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$physical_features_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT colouration FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$colouration_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT head_circumference FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$head_circumference_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT eyes FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$eyes_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT mouth FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$mouth_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT chest FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$chest_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT heart FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$heart_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT abdomen FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$abdomen_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT umbilicus FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$umbilicus_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT spine FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$spine_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT arms_and_hands FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$arms_and_hands_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT legs_and_feet FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$legs_and_feet_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT genitalia FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$genitalia_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT anus FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$anus_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT breastfeeding FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$breastfeeding_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT feeds FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$feeds_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT feeds_age FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$feeds_age_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT other_foods_introduced FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$other_foods_introduced_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT indigestion FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$indigestion_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT sleep_cycle FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$sleep_cycle_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT irritability FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$irritability_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT finger_sucking FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$finger_sucking_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT others FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$others_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT mis_05_given FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$mis_05_given_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT mis_05_next_visit FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$mis_05_next_visit_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT mis_1_given FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$mis_1_given_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT mis_1_next_visit FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$mis_1_next_visit_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT present_checked FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$present_checked_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT present_repeated FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$present_repeated_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT absent_checked FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$absent_checked_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT absent_repeated FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$absent_repeated_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT birth_dose_given FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$birth_dose_given_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT birth_does_next_visit FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$birth_does_next_visit_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT pollo_first_dose_given FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$pollo_first_dose_given_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT pollo_first_does_next_visit FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$pollo_first_does_next_visit_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT pollo_second_dose_given FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$pollo_second_dose_given_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT pollo_second_does_next_visit FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$pollo_second_does_next_visit_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT pollo_third_dose_given FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$pollo_third_dose_given_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT pollo_third_does_next_visit FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$pollo_third_does_next_visit_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT dphtheria_first_dose_given FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$dphtheria_first_dose_given_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT dphtheria_first_dose_next_visit FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$dphtheria_first_dose_next_visit_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT dphtheria_second_dose_given FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$dphtheria_second_dose_given_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT dphtheria_second_does_next_visit FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$dphtheria_second_does_next_visit_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT dphtheria_third_dose_given FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$dphtheria_third_dose_given_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT dphtheria_third_does_next_visit FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$dphtheria_third_does_next_visit_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT pneumococcal_first_dose_given FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$pneumococcal_first_dose_given_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT pneumococcal_first_does_next_visit FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$pneumococcal_first_does_next_visit_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT pneumococcal_second_dose_given FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$pneumococcal_second_dose_given_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT pneumococcal_second_does_next_visit FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$pneumococcal_second_does_next_visit_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT pneumococcal_third_dose_given FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$pneumococcal_third_dose_given_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT pneumococcal_third_does_next_visit FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$pneumococcal_third_does_next_visit_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT rota_first_dose_given FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$rota_first_dose_given_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT rota_first_does_next_visit FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$rota_first_does_next_visit_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT rota_second_dose_given FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$rota_second_dose_given_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT rota_second_does_next_visit FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$rota_second_does_next_visit_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT measles_6_months_date FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$measles_6_months_date_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT measles_9_months_date FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$measles_9_months_date_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT measles_18_months_date FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$measles_18_months_date_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT yellow_fever_date FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$yellow_fever_date_check = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT other_vaccine FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$other_vaccine_check = $_SESSION['temp'];
	
		
	
	
	
	

if ($child_particulars != $child_particulars_check or $child_name != $child_name_check or $child_gender != $child_gender_check or $child_date_of_birth != $child_date_of_birth_check or $birth_weight != $birth_weight_check or $birth_length != $birth_length_check or $birth_characteristics != $birth_characteristics_check or $birth_order != $birth_order_check or $first_seen != $first_seen_check or $birth_place != $birth_place_check or $other_birth_place != $other_birth_place_check or $notification_number != $notification_number_check or $notification_date != $notification_date_check or  $register_number != $register_number_check or $child_welfare_clinic != $child_welfare_clinic_check or $health_facility != $health_facility_check or $master_facility_list_number != $master_facility_list_number_check or $birth_certificate_number != $birth_certificate_number_check or $registration_date != $registration_date_check or $registration_place != $registration_place_check or $abnormalities != $abnormalities_check or $father_name != $father_name_check or $father_phone_number != $father_phone_number_check or $mother_name != $mother_name_check or $mother_phone_number != $mother_phone_number_check or $guardian_name != $guardian_name_check or $guardian_phone_number != $guardian_phone_number_check or $country != $country_check or $district != $district_check or $division != $division_check or $child_location != $child_location_check or $town != $town_check or $village != $village_check or $post_address != $post_address_check or $age_first_contact != $age_first_contact_check or $weight != $weight_check or $height != $height_check or $physical_features != $physical_features_check or $colouration != $colouration_check or $head_circumference != $head_circumference_check or $eyes != $eyes_check or $mouth != $mouth_check or $chest != $chest_check or $heart != $heart_check or $abdomen != $abdomen_check or $umbilicus != $umbilicus_check or $spine != $spine_check or $arms_and_hands != $arms_and_hands_check or $legs_and_feet != $legs_and_feet_check or $genitalia != $genitalia_check or $anus != $anus_check or $breastfeeding != $breastfeeding_check or $feeds != $feeds_check or $feeds_age != $feeds_age_check or $other_foods_introduced != $other_foods_introduced_check or $indigestion != $indigestion_check or $sleep_cycle != $sleep_cycle_check or $irritability != $irritability_check or $finger_sucking != $finger_sucking_check or $others != $others_check or $mis_05_given != $mis_05_given_check or $mis_05_next_visit != $mis_05_next_visit_check or $mis_1_given != $mis_1_given_check or $mis_1_next_visit != $mis_1_next_visit_check or $present_checked != $present_checked_check or $present_repeated != $present_repeated_check or $absent_checked != $absent_checked_check or $absent_repeated != $absent_repeated_check or $birth_dose_given != $birth_dose_given_check or $birth_does_next_visit != $birth_does_next_visit_check or $pollo_first_dose_given != $pollo_first_dose_given_check or $pollo_first_does_next_visit != $pollo_first_does_next_visit_check or $pollo_second_dose_given != $pollo_second_dose_given_check or $pollo_second_does_next_visit != $pollo_second_does_next_visit_check or $pollo_third_dose_given != $pollo_third_dose_given_check or $pollo_third_does_next_visit != $pollo_third_does_next_visit_check or $dphtheria_first_dose_given != $dphtheria_first_dose_given_check or $dphtheria_first_dose_next_visit != $dphtheria_first_dose_next_visit_check or $dphtheria_second_dose_given != $dphtheria_second_dose_given_check or $dphtheria_second_does_next_visit != $dphtheria_second_does_next_visit_check or $dphtheria_third_dose_given != $dphtheria_third_dose_given_check or $dphtheria_third_does_next_visit != $dphtheria_third_does_next_visit_check or $pneumococcal_first_dose_given != $pneumococcal_first_dose_given_check or $pneumococcal_first_does_next_visit != $pneumococcal_first_does_next_visit_check or $pneumococcal_second_dose_given != $pneumococcal_second_dose_given_check or $pneumococcal_second_does_next_visit != $pneumococcal_second_does_next_visit_check or $pneumococcal_third_dose_given != $pneumococcal_third_dose_given_check or $pneumococcal_third_does_next_visit != $pneumococcal_third_does_next_visit_check or $rota_first_dose_given != $rota_first_dose_given_check or $rota_first_does_next_visit != $rota_first_does_next_visit_check or $rota_second_dose_given != $rota_second_dose_given_check or $rota_second_does_next_visit != $rota_second_does_next_visit_check or $measles_6_months_date != $measles_6_months_date_check or $measles_9_months_date != $measles_9_months_date_check or $measles_18_months_date != $measles_18_months_date_check or $yellow_fever_date != $yellow_fever_date_check or $other_vaccine != $other_vaccine_check) {
	
	
	
	
	
	
	
	if ($child_particulars) {
		$child_particulars = "'" . $child_particulars . "'";
	}
	else {
		$child_particulars = 'NULL';
	}
	

	
	
	if ($birth_weight) {
		$birth_weight = "'" . $birth_weight . "'";
	}
	else {
		$birth_weight = 'NULL';
	}
	
	if ($birth_length) {
		$birth_length = "'" . $birth_length . "'";
	}
	else {
		$birth_length = 'NULL';
	}

	if ($birth_order) {
		$birth_order = "'" . $birth_order . "'";
	}
	else {
		$birth_order = 'NULL';
	}
	
	if ($registration_date) {
		$registration_date = "'" . $registration_date . "'";
	}
	else {
		$registration_date = 'NULL';
	}
	

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

	if ($head_circumference) {
		$head_circumference = "'" . $head_circumference . "'";
	}
	else {
		$head_circumference = 'NULL';
	}
	

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

	if ($feeds_age) {
		$feeds_age = "'" . $feeds_age . "'";
	}
	else {
		$feeds_age = 'NULL';
	}
	

	if ($other_foods_introduced) {
		$other_foods_introduced = "'" . $other_foods_introduced . "'";
	}
	else {
		$other_foods_introduced = 'NULL';
	}
	

	if ($irritability) {
		$irritability = "'" . $irritability . "'";
	}
	else {
		$irritability = 'NULL';
	}
	
	if ($finger_sucking) {
		$finger_sucking = "'" . $finger_sucking . "'";
	}
	else {
		$finger_sucking = 'NULL';
	}
	
	if ($others) {
		$others = "'" . $others . "'";
	}
	else {
		$others = 'NULL';
	}
	

	if ($mis_05_given) {
		$mis_05_given = "'" . $mis_05_given . "'";
	}
	else {
		$mis_05_given = 'NULL';
	}
	
	if ($mis_05_next_visit) {
		$mis_05_next_visit = "'" . $mis_05_next_visit . "'";
	}
	else {
		$mis_05_next_visit = 'NULL';
	}
	

	if ($mis_1_given) {
		$mis_1_given = "'" . $mis_1_given . "'";
	}
	else {
		$mis_1_given = 'NULL';
	}
	

	if ($mis_1_next_visit) {
		$mis_1_next_visit = "'" . $mis_1_next_visit . "'";
	}
	else {
		$mis_1_next_visit = 'NULL';
	}
	

	if ($present_checked) {
		$present_checked = "'" . $present_checked . "'";
	}
	else {
		$present_checked = 'NULL';
	}
	
	if ($present_repeated) {
		$present_repeated = "'" . $present_repeated . "'";
	}
	else {
		$present_repeated = 'NULL';
	}
	

	if ($absent_checked) {
		$absent_checked = "'" . $absent_checked . "'";
	}
	else {
		$absent_checked = 'NULL';
	}
	

	if ($absent_repeated) {
		$absent_repeated = "'" . $absent_repeated . "'";
	}
	else {
		$absent_repeated = 'NULL';
	}
	

	if ($birth_dose_given) {
		$birth_dose_given = "'" . $birth_dose_given . "'";
	}
	else {
		$birth_dose_given = 'NULL';
	}
	

	if ($birth_does_next_visit) {
		$birth_does_next_visit = "'" . $birth_does_next_visit . "'";
	}
	else {
		$birth_does_next_visit = 'NULL';
	}
	
	if ($pollo_first_dose_given) {
		$pollo_first_dose_given = "'" . $pollo_first_dose_given . "'";
	}
	else {
		$pollo_first_dose_given = 'NULL';
	}
	

	if ($pollo_first_does_next_visit) {
		$pollo_first_does_next_visit = "'" . $pollo_first_does_next_visit . "'";
	}
	else {
		$pollo_first_does_next_visit = 'NULL';
	}
	

	if ($pollo_second_dose_given) {
		$pollo_second_dose_given = "'" . $pollo_second_dose_given . "'";
	}
	else {
		$pollo_second_dose_given = 'NULL';
	}
	

	if ($pollo_second_does_next_visit) {
		$pollo_second_does_next_visit = "'" . $pollo_second_does_next_visit . "'";
	}
	else {
		$pollo_second_does_next_visit = 'NULL';
	}
	

	if ($pollo_third_dose_given) {
		$pollo_third_dose_given = "'" . $pollo_third_dose_given . "'";
	}
	else {
		$pollo_third_dose_given = 'NULL';
	}
	

	if ($pollo_third_does_next_visit) {
		$pollo_third_does_next_visit = "'" . $pollo_third_does_next_visit . "'";
	}
	else {
		$pollo_third_does_next_visit = 'NULL';
	}
	

	if ($dphtheria_first_dose_given) {
		$dphtheria_first_dose_given = "'" . $dphtheria_first_dose_given . "'";
	}
	else {
		$dphtheria_first_dose_given = 'NULL';
	}
	

	if ($dphtheria_first_dose_next_visit) {
		$dphtheria_first_dose_next_visit = "'" . $dphtheria_first_dose_next_visit . "'";
	}
	else {
		$dphtheria_first_dose_next_visit = 'NULL';
	}
	

	if ($dphtheria_second_dose_given) {
		$dphtheria_second_dose_given = "'" . $dphtheria_second_dose_given . "'";
	}
	else {
		$dphtheria_second_dose_given = 'NULL';
	}
	

	if ($dphtheria_second_does_next_visit) {
		$dphtheria_second_does_next_visit = "'" . $dphtheria_second_does_next_visit . "'";
	}
	else {
		$dphtheria_second_does_next_visit = 'NULL';
	}
	

	if ($dphtheria_third_dose_given) {
		$dphtheria_third_dose_given = "'" . $dphtheria_third_dose_given . "'";
	}
	else {
		$dphtheria_third_dose_given = 'NULL';
	}
	

	if ($dphtheria_third_does_next_visit) {
		$dphtheria_third_does_next_visit = "'" . $dphtheria_third_does_next_visit . "'";
	}
	else {
		$dphtheria_third_does_next_visit = 'NULL';
	}
	
	

	if ($pneumococcal_first_dose_given) {
		$pneumococcal_first_dose_given = "'" . $pneumococcal_first_dose_given . "'";
	}
	else {
		$pneumococcal_first_dose_given = 'NULL';
	}
	

	if ($pneumococcal_first_does_next_visit) {
		$pneumococcal_first_does_next_visit = "'" . $pneumococcal_first_does_next_visit . "'";
	}
	else {
		$pneumococcal_first_does_next_visit = 'NULL';
	}
	

	if ($pneumococcal_second_dose_given) {
		$pneumococcal_second_dose_given = "'" . $pneumococcal_second_dose_given . "'";
	}
	else {
		$pneumococcal_second_dose_given = 'NULL';
	}
	
	if ($pneumococcal_second_does_next_visit) {
		$pneumococcal_second_does_next_visit = "'" . $pneumococcal_second_does_next_visit . "'";
	}
	else {
		$pneumococcal_second_does_next_visit = 'NULL';
	}
	
	if ($pneumococcal_third_dose_given) {
		$pneumococcal_third_dose_given = "'" . $pneumococcal_third_dose_given . "'";
	}
	else {
		$pneumococcal_third_dose_given = 'NULL';
	}
	
	if ($pneumococcal_third_does_next_visit) {
		$pneumococcal_third_does_next_visit = "'" . $pneumococcal_third_does_next_visit . "'";
	}
	else {
		$pneumococcal_third_does_next_visit = 'NULL';
	}
	
	if ($rota_first_dose_given) {
		$rota_first_dose_given = "'" . $rota_first_dose_given . "'";
	}
	else {
		$rota_first_dose_given = 'NULL';
	}
	
	if ($rota_first_does_next_visit) {
		$rota_first_does_next_visit = "'" . $rota_first_does_next_visit . "'";
	}
	else {
		$rota_first_does_next_visit = 'NULL';
	}
	
	if ($rota_second_dose_given) {
		$rota_second_dose_given = "'" . $rota_second_dose_given . "'";
	}
	else {
		$rota_second_dose_given = 'NULL';
	}
	
	if ($rota_second_does_next_visit) {
		$rota_second_does_next_visit = "'" . $rota_second_does_next_visit . "'";
	}
	else {
		$rota_second_does_next_visit = 'NULL';
	}
	
	
	if ($measles_6_months_date) {
		$measles_6_months_date = "'" . $measles_6_months_date . "'";
	}
	else {
		$measles_6_months_date = 'NULL';
	}
	
	if ($measles_9_months_date) {
		$measles_9_months_date = "'" . $measles_9_months_date . "'";
	}
	else {
		$measles_9_months_date = 'NULL';
	}
	
	if ($measles_18_months_date) {
		$measles_18_months_date = "'" . $measles_18_months_date . "'";
	}
	else {
		$measles_18_months_date = 'NULL';
	}
	
	if ($yellow_fever_date) {
		$yellow_fever_date = "'" . $yellow_fever_date . "'";
	}
	else {
		$yellow_fever_date = 'NULL';
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	try {
	
		$query = "INSERT INTO child_welfare_care_history (child_welfare_care_id, client_id, first_name, last_name, sex, location, date_of_birth, child_particulars, child_name, child_gender, child_date_of_birth, birth_weight, birth_length, birth_characteristics, birth_order, first_seen, birth_place, other_birth_place, notification_number, notification_date, register_number, child_welfare_clinic, health_facility, master_facility_list_number, birth_certificate_number, registration_date, registration_place, abnormalities, father_name, father_phone_number, mother_name, mother_phone_number, guardian_name, guardian_phone_number, country, district, division, child_location, town, village, post_address, age_first_contact, weight, height, physical_features, colouration, head_circumference, eyes, mouth, chest, heart, abdomen, umbilicus, spine, arms_and_hands, legs_and_feet, genitalia, anus, breastfeeding, feeds, feeds_age, other_foods_introduced, indigestion, sleep_cycle, irritability, finger_sucking, others, mis_05_given, mis_05_next_visit, mis_1_given, mis_1_next_visit, present_checked, present_repeated, absent_checked, absent_repeated, birth_dose_given, birth_does_next_visit, pollo_first_dose_given, pollo_first_does_next_visit, pollo_second_dose_given, pollo_second_does_next_visit, pollo_third_dose_given, pollo_third_does_next_visit, dphtheria_first_dose_given, dphtheria_first_dose_next_visit, dphtheria_second_dose_given, dphtheria_second_does_next_visit, dphtheria_third_dose_given, dphtheria_third_does_next_visit, pneumococcal_first_dose_given, pneumococcal_first_does_next_visit, pneumococcal_second_dose_given, pneumococcal_second_does_next_visit, pneumococcal_third_dose_given, pneumococcal_third_does_next_visit, rota_first_dose_given, rota_first_does_next_visit, rota_second_dose_given, rota_second_does_next_visit, measles_6_months_date, measles_9_months_date, measles_18_months_date, yellow_fever_date, other_vaccine, timestamp, created_by) SELECT child_welfare_care_id, client_id, first_name, last_name, sex, location, date_of_birth, child_particulars, child_name, child_gender, child_date_of_birth, birth_weight, birth_length, birth_characteristics, birth_order, first_seen, birth_place, other_birth_place, notification_number, notification_date, register_number, child_welfare_clinic, health_facility, master_facility_list_number, birth_certificate_number, registration_date, registration_place, abnormalities, father_name, father_phone_number, mother_name, mother_phone_number, guardian_name, guardian_phone_number, country, district, division, child_location, town, village, post_address, age_first_contact, weight, height, physical_features, colouration, head_circumference, eyes, mouth, chest, heart, abdomen, umbilicus, spine, arms_and_hands, legs_and_feet, genitalia, anus, breastfeeding, feeds, feeds_age, other_foods_introduced, indigestion, sleep_cycle, irritability, finger_sucking, others, mis_05_given, mis_05_next_visit, mis_1_given, mis_1_next_visit, present_checked, present_repeated, absent_checked, absent_repeated, birth_dose_given, birth_does_next_visit, pollo_first_dose_given, pollo_first_does_next_visit, pollo_second_dose_given, pollo_second_does_next_visit, pollo_third_dose_given, pollo_third_does_next_visit, dphtheria_first_dose_given, dphtheria_first_dose_next_visit, dphtheria_second_dose_given, dphtheria_second_does_next_visit, dphtheria_third_dose_given, dphtheria_third_does_next_visit, pneumococcal_first_dose_given, pneumococcal_first_does_next_visit, pneumococcal_second_dose_given, pneumococcal_second_does_next_visit, pneumococcal_third_dose_given, pneumococcal_third_does_next_visit, rota_first_dose_given, rota_first_does_next_visit, rota_second_dose_given, rota_second_does_next_visit, measles_6_months_date, measles_9_months_date, measles_18_months_date, yellow_fever_date, other_vaccine, timestamp, created_by FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care';"; 
		$conn->exec($query);
		
		$query = "UPDATE child_welfare_care SET child_particulars = $child_particulars, child_name = '$child_name', child_gender = '$child_gender', child_date_of_birth = '$child_date_of_birth', birth_weight = $birth_weight, birth_length = $birth_length, birth_characteristics = '$birth_characteristics', birth_order = $birth_order, first_seen = '$first_seen', birth_place = '$birth_place', other_birth_place = '$other_birth_place', notification_number = '$notification_number', notification_date = '$notification_date', register_number = '$register_number', child_welfare_clinic = '$child_welfare_clinic', health_facility = '$health_facility', master_facility_list_number = '$master_facility_list_number', birth_certificate_number = '$birth_certificate_number', registration_date = $registration_date, registration_place = '$registration_place', abnormalities = '$abnormalities', father_name = '$father_name', father_phone_number = '$father_phone_number', mother_name = '$mother_name', mother_phone_number = '$mother_phone_number', guardian_name = '$guardian_name', guardian_phone_number = '$guardian_phone_number', country = '$country', district = '$district', division = '$division', child_location = '$child_location', town = '$town', village = '$village', post_address = '$post_address', age_first_contact = $age_first_contact, weight = $weight, height = $height, physical_features = '$physical_features', colouration = '$colouration', head_circumference = $head_circumference, eyes = '$eyes', mouth = '$mouth', chest = '$chest', heart = '$heart', abdomen = '$abdomen', umbilicus = '$umbilicus', spine = '$spine', arms_and_hands = '$arms_and_hands', legs_and_feet = '$legs_and_feet', genitalia = '$genitalia', anus = '$anus', breastfeeding = $breastfeeding, feeds = $feeds, feeds_age = $feeds_age, other_foods_introduced = $other_foods_introduced, indigestion = '$indigestion', sleep_cycle = '$sleep_cycle', irritability = $irritability, finger_sucking = $finger_sucking, others = $others, mis_05_given = $mis_05_given, mis_05_next_visit = $mis_05_next_visit, mis_1_given = $mis_1_given, mis_1_next_visit = $mis_1_next_visit, present_checked = $present_checked, present_repeated = $present_repeated, absent_checked = $absent_checked, absent_repeated = $absent_repeated, birth_dose_given = $birth_dose_given, birth_does_next_visit = $birth_does_next_visit, pollo_first_dose_given = $pollo_first_dose_given, pollo_first_does_next_visit = $pollo_first_does_next_visit, pollo_second_dose_given = $pollo_second_dose_given, pollo_second_does_next_visit = $pollo_second_does_next_visit, pollo_third_dose_given = $pollo_third_dose_given, pollo_third_does_next_visit = $pollo_third_does_next_visit, dphtheria_first_dose_given = $dphtheria_first_dose_given, dphtheria_first_dose_next_visit = $dphtheria_first_dose_next_visit, dphtheria_second_dose_given = $dphtheria_second_dose_given, dphtheria_second_does_next_visit = $dphtheria_second_does_next_visit, dphtheria_third_dose_given = $dphtheria_third_dose_given, dphtheria_third_does_next_visit = $dphtheria_third_does_next_visit, pneumococcal_first_dose_given = $pneumococcal_first_dose_given, pneumococcal_first_does_next_visit = $pneumococcal_first_does_next_visit, pneumococcal_second_dose_given = $pneumococcal_second_dose_given, pneumococcal_second_does_next_visit = $pneumococcal_second_does_next_visit, pneumococcal_third_dose_given = $pneumococcal_third_dose_given, pneumococcal_third_does_next_visit = $pneumococcal_third_does_next_visit, rota_first_dose_given = $rota_first_dose_given, rota_first_does_next_visit = $rota_first_does_next_visit, rota_second_dose_given = $rota_second_dose_given, rota_second_does_next_visit = $rota_second_does_next_visit, measles_6_months_date = $measles_6_months_date, measles_9_months_date = $measles_9_months_date, measles_18_months_date = $measles_18_months_date, yellow_fever_date = $yellow_fever_date, other_vaccine = '$other_vaccine', created_by = '$username' WHERE child_welfare_care_id='$choosen_child_welfare_care';";
		$conn->exec($query);
		
		header( 'Location: select_child_welfare_care.php');
		exit();
		
	}

	catch(PDOException $e) {
		create_database_error($query, 'update_child_welfare_care.php', $e->getMessage());
	}

	$conn = null;
	
}
header( 'Location: select_child_welfare_care.php');
exit();
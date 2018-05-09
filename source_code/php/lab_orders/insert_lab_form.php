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
		
	$lab_order_id = $_SESSION['choosen_lab_order'];
	
		
		// grab first name
		$stmt = $conn->prepare("SELECT client_id FROM lab_order WHERE lab_order_id='$lab_order_id';");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$client_id = $_SESSION['temp'];
		

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

	
	$mps = $_POST['mps'];
	
	
	$pbf_text = $_POST['pbf_text'];
	
	// single quotes need to be replaced with the correct excape keys for the following value
	$pbf_text = str_replace('\'', '\\\'', $pbf_text);

	
	$th1 = $_POST['th1'];
	$th2 = $_POST['th2'];

	
	$bm1 = $_POST['bm1'];
	$ba1 = $_POST['ba1'];

	
	$reactive = $_POST['reactive'];


	$reactive_p24_hiv = $_POST['reactive_p24_hiv'];

	
	$blood_sugar_text = $_POST['blood_sugar_text'];
	
	// single quotes need to be replaced with the correct excape keys for the following value
	$blood_sugar_text = str_replace('\'', '\\\'', $blood_sugar_text);

	
	$app = $_POST['app'];
	$mic = $_POST['mic'];
	
	// single quotes need to be replaced with the correct excape keys for the following values
	$app = str_replace('\'', '\\\'', $app);
	$mic = str_replace('\'', '\\\'', $mic);

	
	$rhve = $_POST['rhve'];
	$aboab = $_POST['aboab'];
	$du_test = $_POST['du_test'];
	
	// single quotes need to be replaced with the correct excape keys for the following value
	$du_test = str_replace('\'', '\\\'', $du_test);

	
	$hcg_detected = $_POST['hcg_detected'];

	
	$hb_text = $_POST['hb_text'];
	
	// single quotes need to be replaced with the correct excape keys for the following value
	$hb_text = str_replace('\'', '\\\'', $hb_text);


	$urobilinogen = $_POST['urobilinogen'];
	$glucose = $_POST['glucose'];
	$bilirubin = $_POST['bilirubin'];
	$ketones = $_POST['ketones'];
	$specific_gravity = $_POST['specific_gravity'];
	$blood = $_POST['blood'];
	$ph = $_POST['ph'];
	$protein = $_POST['protein'];
	$nitrite = $_POST['nitrite'];
	$leukocytes = $_POST['leukocytes'];
	$microscopy = $_POST['microscopy'];
	
	// single quotes need to be replaced with the correct excape keys for the following value
	$microscopy = str_replace('\'', '\\\'', $microscopy);

	
	$macroscopy = $_POST['macroscopy'];
	$microscopy_hvs = $_POST['microscopy_hvs'];
	$gram_stain = $_POST['gram_stain'];
	
	// single quotes need to be replaced with the correct excape keys for the following values
	$macroscopy = str_replace('\'', '\\\'', $macroscopy);
	$microscopy_hvs = str_replace('\'', '\\\'', $microscopy_hvs);
	$gram_stain = str_replace('\'', '\\\'', $gram_stain);

	
	// the tests that are going to be preformed have to be pulled from the lab orders table
	// because disabled checkboxes are always interperted as unchecked
	$stmt = $conn->prepare("SELECT bs_for_mps FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$bs_for_mps = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT pbf FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$pbf = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT widal FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$widal = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT brucella FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$brucella = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT vdrl_rpr FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$vdrl_rpr = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT p24_hiv FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$p24_hiv = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT blood_sugar FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$blood_sugar = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT stool FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$stool = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT blood_group FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$blood_group = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT pregnancy_test FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$pregnancy_test = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT hb FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$hb = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT urinalysis FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$urinalysis = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT hvs FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$hvs = $_SESSION['temp'];
	
	
	
	$username = $_SESSION['username'];
	$time_completed = date("Y-m-d H:i:s"); 
	
	try {
		
		// mark selected lab order as completed
		$query = "UPDATE lab_order SET time_completed='$time_completed', completed_by='$username' WHERE lab_order_id='$lab_order_id';"; 
		$conn->exec($query);
		
		// create the lab from the lab order
		$query = "INSERT INTO lab (client_id, first_name, last_name, sex, location, date_of_birth, bs_for_mps, bs_for_mps_results, pbf, pbf_results, widal, th1, th0, brucella, bm1, ba1, vdrl_rpr, vdrl_rpr_results, p24_hiv, reactive_p24_hiv,  blood_sugar, blood_sugar_results, stool, app, mic, blood_group, blood_group_rh, blood_group_type, du_test, pregnancy_test, pregnancy_test_results, hb, hb_results, urinalysis, urinalysis_urobilinogen, urinalysis_glucose, urinalysis_bilirubin, urinalysis_ketones, urinalysis_specific_gravity, urinalysis_blood, urinalysis_ph, urinalysis_protein, urinalysis_nitrite, urinalysis_leukocytes, urinalysis_microscopy, hvs, hvs_macroscopy, hvs_microscopy, hvs_gram_stain, lab_order_id, clinician, created_by  ) VALUES ('$client_id', '$first_name', '$last_name', '$sex', '$location', '$date_of_birth', '$bs_for_mps', '$mps', '$pbf', '$pbf_text', '$widal', '$th1', '$th2', '$brucella', '$bm1', '$ba1', '$vdrl_rpr', '$reactive', '$p24_hiv', '$reactive_p24_hiv', '$blood_sugar', '$blood_sugar_text', '$stool', '$app', '$mic', '$blood_group', '$rhve', '$aboab', '$du_test', '$pregnancy_test', '$hcg_detected', '$hb', '$hb_text', '$urinalysis', '$urobilinogen', '$glucose', '$bilirubin', '$ketones', '$specific_gravity', '$blood', '$ph', '$protein', '$nitrite', '$leukocytes', '$microscopy', '$hvs', '$macroscopy', '$microscopy_hvs', '$gram_stain', '$lab_order_id', '$username', '$username' );"; 
		$conn->exec($query);
		
		// redirect the user to where they can select an order to complete
		header( 'Location: select_complete_lab_order.php');
		exit();
		
	}

	catch(PDOException $e) {
		create_database_error($query, 'insert_lab_form.php (lab_orders)', $e->getMessage());
	}

	$conn = null;
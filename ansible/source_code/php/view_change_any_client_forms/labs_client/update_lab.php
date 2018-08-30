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
	
	$username = $_SESSION['username'];
	$lab_id = $_SESSION['choosen_lab'];

	
	$bs_for_mps = $_POST['bs_for_mps'];
	if ($bs_for_mps){
		$bs_for_mps = "yes";
	}
	else {
		$bs_for_mps = "no";
	}

	$mps = $_POST['mps'];



	$pbf = $_POST['pbf'];

	if ($pbf){
		$pbf = "yes";
	}
	else {
		$pbf = "no";
	}

	$pbf_text = $_POST['pbf_text'];
	
	// single quotes need to be replaced with the correct excape keys for the following value
	$pbf_text = str_replace('\'', '\\\'', $pbf_text);



	$widal = $_POST['widal'];

	if ($widal){
		$widal = "yes";
	}
	else {
		$widal = "no";
	}

	$th1 = $_POST['th1'];
	$th2 = $_POST['th2'];



	$brucella = $_POST['brucella'];

	if ($brucella){
		$brucella = "yes";
	}
	else {
		$brucella = "no";
	}

	$bm1 = $_POST['bm1'];
	$ba1 = $_POST['ba1'];



	$vdrl_rpr = $_POST['vdrl_rpr'];

	if ($vdrl_rpr){
		$vdrl_rpr = "yes";
	}
	else {
		$vdrl_rpr = "no";
	}

	$reactive = $_POST['reactive'];



	$p24_hiv = $_POST['p24_hiv'];

	if ($p24_hiv){
		$p24_hiv = "yes";
	}
	else {
		$p24_hiv = "no";
	}

	$reactive_p24_hiv = $_POST['reactive_p24_hiv'];



	$blood_sugar = $_POST['blood_sugar'];

	if ($blood_sugar){
		$blood_sugar = "yes";
	}
	else {
		$blood_sugar = "no";
	}

	$blood_sugar_text = $_POST['blood_sugar_text'];

	// single quotes need to be replaced with the correct excape keys for the following value
	$blood_sugar_text = str_replace('\'', '\\\'', $blood_sugar_text);



	$stool = $_POST['stool'];

	if ($stool){
		$stool = "yes";
	}
	else {
		$stool = "no";
	}

	$app = $_POST['app'];
	$mic = $_POST['mic'];

	// single quotes need to be replaced with the correct excape keys for the following values
	$app = str_replace('\'', '\\\'', $app);
	$mic = str_replace('\'', '\\\'', $mic);



	$blood_group = $_POST['blood_group'];

	if ($blood_group){
		$blood_group = "yes";
	}
	else {
		$blood_group = "no";
	}

	$rhve = $_POST['rhve'];
	$aboab = $_POST['aboab'];
	$du_test = $_POST['du_test'];

	// single quotes need to be replaced with the correct excape keys for the following value
	$du_test = str_replace('\'', '\\\'', $du_test);



	$pregnancy = $_POST['pregnancy'];

	if ($pregnancy){
		$pregnancy = "yes";
	}
	else {
		$pregnancy = "no";
	}

	$hcg_detected = $_POST['hcg_detected'];



	$hb = $_POST['hb'];

	if ($hb){
		$hb = "yes";
	}
	else {
		$hb = "no";
	}

	$hb_text = $_POST['hb_text'];

	// single quotes need to be replaced with the correct excape keys for the following value
	$hb_text = str_replace('\'', '\\\'', $hb_text);



	$urinalysis = $_POST['urinalysis'];

	if ($urinalysis){
		$urinalysis = "yes";
	}
	else {
		$urinalysis = "no";
	}

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



	$hvs = $_POST['hvs'];

	if ($hvs){
		$hvs = "yes";
	}
	else {
		$hvs = "no";
	}

	$macroscopy = $_POST['macroscopy'];
	$microscopy_hvs = $_POST['microscopy_hvs'];
	$gram_stain = $_POST['gram_stain'];
	
	// single quotes need to be replaced with the correct excape keys for the following values
	$macroscopy = str_replace('\'', '\\\'', $macroscopy);
	$microscopy_hvs = str_replace('\'', '\\\'', $microscopy_hvs);
	$gram_stain = str_replace('\'', '\\\'', $gram_stain);

	
	
	$stmt = $conn->prepare("SELECT bs_for_mps FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$bs_for_mps_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT bs_for_mps_results FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$bs_for_mps_results_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT pbf FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$pbf_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT pbf_results FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$pbf_results_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT widal FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$widal_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT th1 FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$th1_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT th0 FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$th0_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT brucella FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$brucella_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT bm1 FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$bm1_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT ba1 FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$ba1_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT vdrl_rpr FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$vdrl_rpr_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT vdrl_rpr_results FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$vdrl_rpr_results_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT p24_hiv FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$p24_hiv_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT reactive_p24_hiv FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$reactive_p24_hiv_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT blood_sugar FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$blood_sugar_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT blood_sugar_results FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$blood_sugar_results_check = $_SESSION['temp'];
	



	













	$hba1c = $_POST['hba1c'];

	if ($hba1c){
		$hba1c = "yes";
	}
	else {
		$hba1c = "no";
	}

	



	$hba1c_text = $_POST['hba1c_text'];



	// single quotes need to be replaced with the correct excape keys for the following value
	$hba1c_text = str_replace('\'', '\\\'', $hba1c_text);

	

	$stmt = $conn->prepare("SELECT hba1c FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$hba1c_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT hba1c_results FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$hba1c_results_check = $_SESSION['temp'];




























	$bun = $_POST['bun'];

	if ($bun){
		$bun = "yes";
	}
	else {
		$bun = "no";
	}

	



	$bun_text = $_POST['bun_text'];



	// single quotes need to be replaced with the correct excape keys for the following value
	$bun_text = str_replace('\'', '\\\'', $bun_text);

	

	$stmt = $conn->prepare("SELECT bun FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$bun_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT bun_results FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$bun_results_check = $_SESSION['temp'];



















	$hematocrit = $_POST['hematocrit'];

	if ($hematocrit){
		$hematocrit = "yes";
	}
	else {
		$hematocrit = "no";
	}

	



	$hematocrit_text = $_POST['hematocrit_text'];



	// single quotes need to be replaced with the correct excape keys for the following value
	$hematocrit_text = str_replace('\'', '\\\'', $hematocrit_text);

	

	$stmt = $conn->prepare("SELECT hematocrit FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$hematocrit_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT hematocrit_results FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$hematocrit_results_check = $_SESSION['temp'];















	$creatinine = $_POST['creatinine'];

	if ($creatinine){
		$creatinine = "yes";
	}
	else {
		$creatinine = "no";
	}

	



	$creatinine_text = $_POST['creatinine_text'];



	// single quotes need to be replaced with the correct excape keys for the following value
	$creatinine_text = str_replace('\'', '\\\'', $creatinine_text);

	

	$stmt = $conn->prepare("SELECT creatinine FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$creatinine_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT creatinine_results FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$creatinine_results_check = $_SESSION['temp'];













	$electrolytes = $_POST['electrolytes'];

	if ($electrolytes){
		$electrolytes = "yes";
	}
	else {
		$electrolytes = "no";
	}

	



	$electrolytes_text = $_POST['electrolytes_text'];



	// single quotes need to be replaced with the correct excape keys for the following value
	$electrolytes_text = str_replace('\'', '\\\'', $electrolytes_text);

	

	$stmt = $conn->prepare("SELECT electrolytes FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$electrolytes_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT electrolytes_results FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$electrolytes_results_check = $_SESSION['temp'];




	










	$pylori_stool = $_POST['pylori_stool'];

	if ($pylori_stool){
		$pylori_stool = "yes";
	}
	else {
		$pylori_stool = "no";
	}

	



	$pylori_stool_radio = $_POST['pylori_stool_radio'];



	// single quotes need to be replaced with the correct excape keys for the following value
	$pylori_stool_radio = str_replace('\'', '\\\'', $pylori_stool_radio);

	

	$stmt = $conn->prepare("SELECT pylori_stool FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$pylori_stool_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT pylori_stool_results FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$pylori_stool_results_check = $_SESSION['temp'];



























	$pylori_blood = $_POST['pylori_blood'];

	if ($pylori_blood){
		$pylori_blood = "yes";
	}
	else {
		$pylori_blood = "no";
	}

	



	$pylori_blood_radio = $_POST['pylori_blood_radio'];



	// single quotes need to be replaced with the correct excape keys for the following value
	$pylori_blood_radio = str_replace('\'', '\\\'', $pylori_blood_radio);

	

	$stmt = $conn->prepare("SELECT pylori_blood FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$pylori_blood_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT pylori_blood_results FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$pylori_blood_results_check = $_SESSION['temp'];














	$rheumatoid_factor = $_POST['rheumatoid'];

	if ($rheumatoid_factor){
		$rheumatoid_factor = "yes";
	}
	else {
		$rheumatoid_factor = "no";
	}

	



	$rheumatoid_factor_results = $_POST['reactive_rheumatoid_radio'];



	// single quotes need to be replaced with the correct excape keys for the following value
	$rheumatoid_factor_radio = str_replace('\'', '\\\'', $rheumatoid_factor_radio);

	

	$stmt = $conn->prepare("SELECT rheumatoid_factor FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$rheumatoid_factor_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT rheumatoid_factor_results FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$rheumatoid_factor_results_check = $_SESSION['temp'];



































	
	$stmt = $conn->prepare("SELECT stool FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$stool_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT app FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$app_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT mic FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$mic_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT blood_group FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$blood_group_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT blood_group_rh FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$blood_group_rh_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT blood_group_type FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$blood_group_type_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT du_test FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$du_test_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT pregnancy_test FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$pregnancy_test_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT pregnancy_test_results FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$pregnancy_test_results_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT hb FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$hb_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT hb_results FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$hb_results_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT urinalysis FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$urinalysis_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT urinalysis_urobilinogen FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$urinalysis_urobilinogen_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT urinalysis_glucose FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$urinalysis_glucose_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT urinalysis_bilirubin FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$urinalysis_bilirubin_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT urinalysis_ketones FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$urinalysis_ketones_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT urinalysis_specific_gravity FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$urinalysis_specific_gravity_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT urinalysis_blood FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$urinalysis_blood_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT urinalysis_ph FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$urinalysis_ph_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT urinalysis_protein FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$urinalysis_protein_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT urinalysis_nitrite FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$urinalysis_nitrite_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT urinalysis_leukocytes FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$urinalysis_leukocytes_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT urinalysis_microscopy FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$urinalysis_microscopy_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT hvs FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$hvs_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT hvs_macroscopy FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$hvs_macroscopy_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT hvs_microscopy FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$hvs_microscopy_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT hvs_gram_stain FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$hvs_gram_stain_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT clinician FROM lab WHERE lab_id='$lab_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

	}
	$clinician_check = $_SESSION['temp'];
	
	

	try {
	
		if ($bs_for_mps != $bs_for_mps_check or $mps != $bs_for_mps_results_check or $pbf != $pbf_check or $pbf_text != $pbf_results_check or $widal != $widal_check or $th1 != $th1_check or $th2 != $th0_check or $brucella != $brucella_check or $bm1 != $bm1_check or $ba1 != $ba1_check or $vdrl_rpr != $vdrl_rpr_check or $reactive != $vdrl_rpr_results_check or $p24_hiv != $p24_hiv_check or $reactive_p24_hiv != $reactive_p24_hiv_check or $blood_sugar != $blood_sugar_check or $blood_sugar_text != $blood_sugar_results_check or

$hba1c != $hba1c_check or $hba1c_text != $hba1c_results_check or $bun != $bun_check or $bun_text != $bun_results_check or $hematocrit != $hematocrit_check or $hematocrit_text != $hematocrit_results_check or $creatinine != $creatinine_check or $creatinine_text != $creatinine_results_check or $electrolytes != $electrolytes_check or $electrolytes_text != $electrolytes_results_check or $pylori_stool != $pylori_stool_check or $pylori_stool_radio != $pylori_stool_results_check or $pylori_blood != $pylori_blood_check or $pylori_blood_radio != $pylori_blood_results_check or $rheumatoid_factor != $rheumatoid_factor_check or $rheumatoid_factor_results != $rheumatoid_factor_results_check or 




 $stool != $stool_check or $app != $app_check or $mic != $mic_check or $blood_group != $blood_group_check or $rhve != $blood_group_rh_check or $aboab != $blood_group_type_check or $du_test != $du_test_check or $pregnancy != $pregnancy_test_check or $hcg_detected != $pregnancy_test_results_check or $hb != $hb_check or $hb_text != $hb_results_check or $urinalysis != $urinalysis_check or $urobilinogen != $urinalysis_urobilinogen_check or $glucose != $urinalysis_glucose_check or $bilirubin != $urinalysis_bilirubin_check or $ketones != $urinalysis_ketones_check or $specific_gravity != $urinalysis_specific_gravity_check or $blood != $urinalysis_blood_check or $ph != $urinalysis_ph_check or $protein != $urinalysis_protein_check or $nitrite != $urinalysis_nitrite_check or $leukocytes != $urinalysis_leukocytes_check or $microscopy != $urinalysis_microscopy_check or $hvs != $hvs_check or $macroscopy != $hvs_macroscopy_check or $microscopy_hvs != $hvs_microscopy_check or $gram_stain != $hvs_gram_stain_check or $clinician != $clinician_check) {
		

			

			$query = "INSERT INTO lab_history (lab_id, client_id, first_name, last_name, sex, location, date_of_birth, bs_for_mps, bs_for_mps_results, pbf, pbf_results, widal, th1, th0, brucella, bm1, ba1, vdrl_rpr, vdrl_rpr_results, p24_hiv, reactive_p24_hiv, blood_sugar, blood_sugar_results,     hba1c, hba1c_results, bun, bun_results, hematocrit, hematocrit_results, creatinine, creatinine_results, electrolytes, electrolytes_results, pylori_stool, pylori_stool_results, pylori_blood, pylori_blood_results, rheumatoid_factor, rheumatoid_factor_results,                                        stool, app, mic, blood_group, blood_group_rh, blood_group_type, du_test, pregnancy_test, pregnancy_test_results, hb, hb_results, urinalysis, urinalysis_urobilinogen, urinalysis_glucose, urinalysis_bilirubin, urinalysis_ketones, urinalysis_specific_gravity, urinalysis_blood, urinalysis_ph, urinalysis_protein, urinalysis_nitrite, urinalysis_leukocytes, urinalysis_microscopy, hvs, hvs_macroscopy, hvs_microscopy, hvs_gram_stain, lab_order_id, timestamp, clinician, created_by) SELECT lab_id, client_id, first_name, last_name, sex, location, date_of_birth, bs_for_mps, bs_for_mps_results, pbf, pbf_results, widal, th1, th0, brucella, bm1, ba1, vdrl_rpr, vdrl_rpr_results, p24_hiv, reactive_p24_hiv, blood_sugar, blood_sugar_results,                                 hba1c, hba1c_results, bun, bun_results, hematocrit, hematocrit_results, creatinine, creatinine_results, electrolytes, electrolytes_results, pylori_stool, pylori_stool_results, pylori_blood, pylori_blood_results, rheumatoid_factor, rheumatoid_factor_results, stool, app, mic, blood_group, blood_group_rh, blood_group_type, du_test, pregnancy_test, pregnancy_test_results, hb, hb_results, urinalysis, urinalysis_urobilinogen, urinalysis_glucose, urinalysis_bilirubin, urinalysis_ketones, urinalysis_specific_gravity, urinalysis_blood, urinalysis_ph, urinalysis_protein, urinalysis_nitrite, urinalysis_leukocytes, urinalysis_microscopy, hvs, hvs_macroscopy, hvs_microscopy, hvs_gram_stain, lab_order_id, timestamp, clinician, created_by FROM lab WHERE lab_id='$lab_id';"; 
			$conn->exec($query);
			
			// the query


			$sql = "UPDATE lab SET bs_for_mps='$bs_for_mps', bs_for_mps_results='$mps', pbf='$pbf', pbf_results='$pbf_text', 
			widal='$widal', th1='$th1', th0='$th2', brucella='$brucella', bm1='$bm1', ba1='$ba1', vdrl_rpr='$vdrl_rpr', vdrl_rpr_results='$reactive',
			p24_hiv='$p24_hiv', reactive_p24_hiv='$reactive_p24_hiv', blood_sugar='$blood_sugar', blood_sugar_results='$blood_sugar_text',  







hba1c='$hba1c', hba1c_results='$hba1c_text', bun='$bun', bun_results='$bun_text', hematocrit='$hematocrit', hematocrit_results='$hematocrit_text', creatinine='$creatinine', creatinine_results='$creatinine_text', electrolytes='$electrolytes', electrolytes_results='$electrolytes_text', pylori_stool='$pylori_stool', pylori_stool_results='$pylori_stool_radio', pylori_blood='$pylori_blood', pylori_blood_results='$pylori_blood_radio', rheumatoid_factor='$rheumatoid_factor', rheumatoid_factor_results='$rheumatoid_factor_results',                                                                                                                             
                                                                                                                                                                                                                           





stool='$stool', app='$app', mic='$mic', blood_group='$blood_group', blood_group_rh='$rhve', blood_group_type='$aboab', du_test='$du_test',
			pregnancy_test='$pregnancy', pregnancy_test_results='$hcg_detected', hb='$hb', hb_results='$hb_text', urinalysis='$urinalysis',
			urinalysis_urobilinogen='$urobilinogen', urinalysis_glucose='$glucose', urinalysis_bilirubin='$bilirubin', urinalysis_ketones='$ketones',
			urinalysis_specific_gravity='$specific_gravity', urinalysis_blood='$blood', urinalysis_ph='$ph', urinalysis_protein='$protein',
			urinalysis_nitrite='$nitrite', urinalysis_leukocytes='$leukocytes', urinalysis_microscopy='$microscopy',
			hvs='$hvs', hvs_macroscopy='$macroscopy', hvs_microscopy='$microscopy_hvs', hvs_gram_stain='$gram_stain', clinician='$clinician', created_by='$username'
			
			WHERE lab_id='$lab_id';"; 
			
			// run the query
			$stmt = $conn->prepare($sql);
			$stmt->execute();



			
		
		}
		
		// redirect the user back to lab selection
		header( 'Location: /php/view_change_any_client_forms/view_all_form.php');
		exit();
		
	}

	catch(PDOException $e) {
		
		create_database_error($query, 'update_lab_form.php', $e->getMessage());	
			
	}

		$conn = null;

}
		
// if account does not exist
else {
	echo "<script type='text/javascript'>
			alert('The clinician you have provided was not found in the database.'); 
			document.location.href = 'select_lab.php'; 
		 </script>";
	}

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
	$stmt = $conn->prepare("SELECT username FROM accounts WHERE username='$clinician';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new clinician_check(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		echo $v;
		++$count;
	}

// if exists	
if ($count){
	
$client_id = $_SESSION['choosen_client_id']; if (isset($_POST['choosen_client_id'])) {$client_id = $_POST['choosen_client_id'];}
	

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

	




	$pylori_stool = $_POST['pylori_stool'];
	
	if ($pylori_stool){
		$pylori_stool = "yes";
	}
	else {
		$pylori_stool = "no";
	}
	
	$pylori_stool_radio = $_POST['pylori_stool_radio'];
	
	// single quotes need to be replaced with the correct excape keys for the following value
	//$pylori_stool_radio = str_replace('\'', '\\\'', $pylori_stool_radio);

	



	$pylori_blood = $_POST['pylori_blood'];
	
	if ($pylori_blood){
		$pylori_blood = "yes";
	}
	else {
		$pylori_blood = "no";
	}
	
	$pylori_blood_radio = $_POST['pylori_blood_radio'];
	
	// single quotes need to be replaced with the correct excape keys for the following value
	//$pylori_blood_radio = str_replace('\'', '\\\'', $pylori_blood_radio);





	$rheumatoid = $_POST['rheumatoid'];
	
	if ($rheumatoid){
		$rheumatoid = "yes";
	}
	else {
		$rheumatoid = "no";
	}
	
	$rheumatoid_radio = $_POST['reactive_rheumatoid_radio'];
	
	// single quotes need to be replaced with the correct excape keys for the following value
	//$rheumatoid_radio = str_replace('\'', '\\\'', $rheumatoid_radio);

	









	































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

	$username = $_SESSION['username'];



	$culture = $_POST['culture'];
	$culture = str_replace('\'', '\\\'', $culture);



	$blood_count = $_POST['blood_count'];
	
	if ($blood_count){
		$blood_count = "yes";
	}
	else {
		$blood_count = "no";
	}

	$rbc = $_POST['rbc'];
	$rbc = str_replace('\'', '\\\'', $rbc);



	$hct_text = $_POST['hct_text'];
	$hct_text = str_replace('\'', '\\\'', $hct_text);	

	$mcv_text = $_POST['mcv_text'];
	$mcv_text = str_replace('\'', '\\\'', $mcv_text);

	$rdw_text = $_POST['rdw_text'];
	$rdw_text = str_replace('\'', '\\\'', $rdw_text);

	$wbc_text = $_POST['wbc_text'];
	$wbc_text = str_replace('\'', '\\\'', $wbc_text);

	$platelet_text = $_POST['platelet_text'];
	$platelet_text = str_replace('\'', '\\\'', $platelet_text);

	$neutrophils_text = $_POST['neutrophils_text'];
	$neutrophils_text = str_replace('\'', '\\\'', $neutrophils_text);

	$lymphocytes_text = $_POST['lymphocytes_text'];
	$lymphocytes_text = str_replace('\'', '\\\'', $lymphocytes_text);

	$monocytes_text = $_POST['monocytes_text'];
	$monocytes_text = str_replace('\'', '\\\'', $monocytes_text);

	$eosinophils_text = $_POST['eosinophils_text'];
	$eosinophils_text = str_replace('\'', '\\\'', $eosinophils_text);

	$basophils_text = $_POST['basophils_text'];
	$basophils_text = str_replace('\'', '\\\'', $basophils_text);
	

	$blood_chemistry = $_POST['blood_chemistry'];
	
	if ($blood_chemistry){
		$blood_chemistry = "yes";
	}
	else {
		$blood_chemistry = "no";
	}

	$sodium_text = $_POST['sodium_text'];
	$sodium_text = str_replace('\'', '\\\'', $sodium_text);


	$chloride_text = $_POST['chloride_text'];
	$chloride_text = str_replace('\'', '\\\'', $chloride_text);
	
	$potassium_text = $_POST['potassium_text'];
	$potassium_text = str_replace('\'', '\\\'', $potassium_text);
	
	$calcium_text = $_POST['calcium_text'];
	$calcium_text = str_replace('\'', '\\\'', $calcium_text);
	
	$bicarbonate_text = $_POST['bicarbonate_text'];
	$bicarbonate_text = str_replace('\'', '\\\'', $bicarbonate_text);
	
	$glucose_fasting_text = $_POST['glucose_fasting_text'];
	$glucose_fasting_text = str_replace('\'', '\\\'', $glucose_fasting_text);

	$random_text = $_POST['random_text'];
	$random_text = str_replace('\'', '\\\'', $random_text);



	$arterial_blood = $_POST['arterial_blood'];
	
	if ($arterial_blood){
		$arterial_blood = "yes";
	}
	else {
		$arterial_blood = "no";
	}

	$pao2_text = $_POST['pao2_text'];
	$pao2_text = str_replace('\'', '\\\'', $pao2_text);

	$paco2_text = $_POST['paco2_text'];
	$paco2_text = str_replace('\'', '\\\'', $paco2_text);

	$blood_ph_text = $_POST['blood_ph_text'];
	$blood_ph_text = str_replace('\'', '\\\'', $blood_ph_text);

	$sao2_text = $_POST['sao2_text'];
	$sao2_text = str_replace('\'', '\\\'', $sao2_text);

	$hco3_text = $_POST['hco3_text'];
	$hco3_text = str_replace('\'', '\\\'', $hco3_text);


	$liver = $_POST['liver'];
	
	if ($liver){
		$liver = "yes";
	}
	else {
		$liver = "no";
	}

	$alt_text = $_POST['alt_text'];
	$alt_text = str_replace('\'', '\\\'', $alt_text);

	$ast_text = $_POST['ast_text'];
	$ast_text = str_replace('\'', '\\\'', $ast_text);

	$albumin_text = $_POST['albumin_text'];
	$albumin_text = str_replace('\'', '\\\'', $albumin_text);



	$prothrombin = $_POST['prothrombin'];
	
	if ($prothrombin){
		$prothrombin = "yes";
	}
	else {
		$prothrombin = "no";
	}

	
	$prothrombin_text = $_POST['prothrombin_text'];
	$prothrombin_text = str_replace('\'', '\\\'', $prothrombin_text);




	$inr = $_POST['inr'];
	
	if ($inr){
		$inr = "yes";
	}
	else {
		$inr = "no";
	}


	$inr_text = $_POST['inr_text'];
	$inr_text = str_replace('\'', '\\\'', $inr_text);


	
	

	$tft = $_POST['tft'];
	
	if ($tft){
		$tft = "yes";
	}
	else {
		$tft = "no";
	}


	$tsh_text = $_POST['tsh_text'];
	$tsh_text = str_replace('\'', '\\\'', $tsh_text);

	$freet3_text = $_POST['freet3_text'];
	$freet3_text = str_replace('\'', '\\\'', $freet3_text);

	$freet4_text = $_POST['freet4_text'];
	$freet4_text = str_replace('\'', '\\\'', $freet4_text);

	echo "before";
	echo "$freet4_text";






	$cholesterol = $_POST['cholesterol'];
	
	if ($cholesterol){
		$cholesterol = "yes";
	}
	else {
		$cholesterol = "no";
	}


	$total_text = $_POST['total_text'];
	$total_text = str_replace('\'', '\\\'', $total_text);

	$hdl_text = $_POST['hdl_text'];
	$hdl_text = str_replace('\'', '\\\'', $hdl_text);

	$ldl_text = $_POST['ldl_text'];
	$ldl_text = str_replace('\'', '\\\'', $ldl_text);





	$cardiac = $_POST['cardiac'];
	
	if ($cardiac){
		$cardiac = "yes";
	}
	else {
		$cardiac = "no";
	}

	$troponin_text = $_POST['troponin_text'];
	$troponin_text = str_replace('\'', '\\\'', $troponin_text);


	$ck_text = $_POST['ck_text'];
	$ck_text = str_replace('\'', '\\\'', $ck_text);



	echo "$culture" . '<br>';
	echo "$hct_text" . '<br>';
	echo "$mcv_text" . '<br>';
	echo "$rdw_text" . '<br>';
	echo "$wbc_text" . '<br>';
	echo "$platelet_text" . '<br>';
	echo "$neutrophils_text" . '<br>';
	echo "$lymphocytes_text" . '<br>';
	echo "$monocytes_text" . '<br>';
	echo "$eosinophils_text" . '<br>';
	echo "$basophils_text" . '<br>';


	

	try {
		
		$query = "INSERT INTO lab (client_id, first_name, last_name, sex, location, date_of_birth, bs_for_mps, bs_for_mps_results, pbf, pbf_results, widal, th1, th0, brucella, bm1, ba1, vdrl_rpr, vdrl_rpr_results, p24_hiv, reactive_p24_hiv,  blood_sugar, blood_sugar_results, hba1c, hba1c_results, bun, bun_results, hematocrit, hematocrit_results, creatinine, creatinine_results, electrolytes, electrolytes_results, pylori_stool, pylori_stool_results, pylori_blood, pylori_blood_results, rheumatoid_factor, rheumatoid_factor_results, stool, app, mic, blood_group, blood_group_rh, blood_group_type, du_test, pregnancy_test, pregnancy_test_results, hb, hb_results, urinalysis, urinalysis_urobilinogen, urinalysis_glucose, urinalysis_bilirubin, urinalysis_ketones, urinalysis_specific_gravity, urinalysis_blood, urinalysis_ph, urinalysis_protein, urinalysis_nitrite, urinalysis_leukocytes, urinalysis_microscopy, hvs, hvs_macroscopy, hvs_microscopy, hvs_gram_stain, culture, blood_count, rbc, arterial_blood, pao2_text, paco2_text, blood_ph_text, sao2_text, hco3_text, liver, alt_text, ast_text, albumin_text, prothrombin, prothrombin_text, inr, inr_text, tft, tsh_text, freet3_text, freet4_text, cholesterol, total_text, hdl_text, ldl_text, cardiac, troponin_text, ck_text, clinician, created_by, hct_text, mcv_text, rdw_text, wbc_text, platelet_text, neutrophils_text, lymphocytes_text, monocytes_text, eosinophils_text, basophils_text, blood_chemistry, sodium_text, chloride_text, potassium_text, calcium_text, bicarbonate_text, glucose_fasting_text, random_text, bun_text, creatinine_text, hba1c_text) VALUES ('$client_id', '$first_name', '$last_name', '$sex', '$location', '$date_of_birth', '$bs_for_mps', '$mps', '$pbf', '$pbf_text', '$widal', '$th1', '$th2', '$brucella', '$bm1', '$ba1', '$vdrl_rpr', '$reactive', '$p24_hiv', '$reactive_p24_hiv', '$blood_sugar', '$blood_sugar_text', '$hba1c', '$hba1c_text', '$bun', '$bun_text', '$hematocrit', '$hematocrit_text', '$creatinine', '$creatinine_text', '$electrolytes', '$electrolytes_text', '$pylori_stool', '$pylori_stool_radio', '$pylori_blood', '$pylori_blood_radio', '$rheumatoid', '$rheumatoid_radio', '$stool', '$app', '$mic', '$blood_group', '$rhve', '$aboab', '$du_test', '$pregnancy', '$hcg_detected', '$hb', '$hb_text', '$urinalysis', '$urobilinogen', '$glucose', '$bilirubin', '$ketones', '$specific_gravity', '$blood', '$ph', '$protein', '$nitrite', '$leukocytes', '$microscopy', '$hvs', '$macroscopy', '$microscopy_hvs', '$gram_stain', '$culture', '$blood_count', '$rbc', '$arterial_blood', '$pao2_text', '$paco2_text', '$blood_ph_text', '$sao2_text', '$hco3_text', '$liver', '$alt_text', '$ast_text', '$albumin_text', '$prothrombin', '$prothrombin_text', '$inr', '$inr_text', '$tft', '$tsh_text', '$freet3_text', '$freet4_text', '$cholesterol', '$total_text', '$hdl_text', '$ldl_text', '$cardiac', '$troponin_text', '$ck_text', '$clinician', '$username', '$hct_text', '$mcv_text', '$rdw_text', '$wbc_text', '$platelet_text', '$neutrophils_text', '$lymphocytes_text', '$monocytes_text', '$eosinophils_text', '$basophils_text', '$blood_chemistry', '$sodium_text', '$chloride_text', '$potassium_text', '$calcium_text', '$bicarbonate_text', '$glucose_fasting_text', '$random_text', '$bun_text', '$creatinine_text', '$hba1c_text')"; 
		$conn->exec($query);
		
		header( 'Location: select_client_lab.php');
		exit();
		
	}

	catch(PDOException $e) {
		create_database_error($query, 'insert_lab_form.php', $e->getMessage());
	}

	$conn = null;

}

// if it does not exist
else {
	echo "<script type='text/javascript'>
			alert('The clinician you have provided was not found in the database.'); 
			document.location.href = 'add_lab.php'; 
		  </script>";		
}






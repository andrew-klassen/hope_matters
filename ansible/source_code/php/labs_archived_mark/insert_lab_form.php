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

	echo $pylori_stool . '</br>';
	echo $pylori_stool_radio . '</br>';



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

	echo $pylori_blood . '</br>';
	echo $pylori_blood_radio . '</br>';
	
	
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

	echo $rheumatoid . '</br>';
	echo $rheumatoid_radio . '</br>';
	
	
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
	
	
	
	$p24_hiv = $_POST['p24_hiv'];
	
	if ($p24_hiv){
		$p24_hiv = "yes";
	}
	else {
		$p24_hiv = "no";
	}
	
	$reactive_p24_hiv = $_POST['reactive_p24_hiv'];
	
	
	
	$vdrl_rpr = $_POST['vdrl_rpr'];
	
	if ($vdrl_rpr){
		$vdrl_rpr = "yes";
	}
	else {
		$vdrl_rpr = "no";
	}
	
	$reactive = $_POST['reactive'];

	
	
	
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

	
	
	$pregnancy = $_POST['pregnancy'];
	
	if ($pregnancy){
		$pregnancy = "yes";
	}
	else {
		$pregnancy = "no";
	}
	
	$hcg_detected = $_POST['hcg_detected'];

	
	
	$hvs = $_POST['hvs'];
	
	if ($hvs){
		$hvs = "yes";
	}
	else {
		$hvs = "no";
	}
	
	$macroscopy = $_POST['macroscopy'];
	$microscopy_hvs = $_POST['microscopy_hvs'];
	
	// single quotes need to be replaced with the correct excape keys for the following values
	$macroscopy = str_replace('\'', '\\\'', $macroscopy);
	$microscopy_hvs = str_replace('\'', '\\\'', $microscopy_hvs);
	
	
	
	$gram_stain = $_POST['gram_stain'];
	
	if ($gram_stain){
		$gram_stain = "gram_stain";
	}
	else {
		$gram_stain = "no";
	}
	
	$gram_stain_text = $_POST['gram_stain_text'];
	
	
	// single quotes need to be replaced with the correct excape keys for the following values
	$gram_stain_text = str_replace('\'', '\\\'', $gram_stain_text);
	
	
	
	$culture = $_POST['culture'];
	
	if ($culture){
		$culture = "culture";
	}
	else {
		$culture = "no";
	}
	
	$culture_text = $_POST['culture_text'];
	
	
	// single quotes need to be replaced with the correct excape keys for the following values
	$culture_text = str_replace('\'', '\\\'', $culture_text);
	
	
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
	
	
	
	$blood_count = $_POST['blood_count'];
	
	if ($blood_count){
		$blood_count = "yes";
	}
	else {
		$blood_count = "no";
	}
	
	$rbc = $_POST['rbc'];
	$hb_text = $_POST['hct_text'];
	$mcv_text = $_POST['mcv_text'];
	$rdw_text = $_POST['rdw_text'];
	$wbc_text = $_POST['wbc_text'];
	$platelet_text = $_POST['platelet_text'];
	$neutrophils_text = $_POST['neutrophils_text'];
	$lymphocytes_text = $_POST['lymphocytes_text'];
	$monocytes_text = $_POST['monocytes_text'];
	$eosinophils_text = $_POST['eosinophils_text'];
	$basophils_text = $_POST['basophils_text'];
	
	
	// single quotes need to be replaced with the correct excape keys for the following values
	$rbc = str_replace('\'', '\\\'', $rbc);
	$hb_text = str_replace('\'', '\\\'', $hb_text);
	$mcv_text = str_replace('\'', '\\\'', $mcv_text);
	$rdw_text = str_replace('\'', '\\\'', $rdw_text);
	$wbc_text = str_replace('\'', '\\\'', $wbc_text);
	$platelet_text = str_replace('\'', '\\\'', $platelet_text);
	$neutrophils_text = str_replace('\'', '\\\'', $neutrophils_text);
	$lymphocytes_text = str_replace('\'', '\\\'', $lymphocytes_text);
	$monocytes_text = str_replace('\'', '\\\'', $monocytes_text);
	$eosinophils_text = str_replace('\'', '\\\'', $eosinophils_text);
	$basophils_text = str_replace('\'', '\\\'', $basophils_text);
	
	
	
	
	$blood_chemistry = $_POST['blood_chemistry'];
	
	if ($blood_chemistry){
		$blood_chemistry = "yes";
	}
	else {
		$blood_chemistry = "no";
	}
	
	$sodium = $_POST['sodium'];
	$chloride_text = $_POST['chloride_text'];
	$potassium_text = $_POST['potassium_text'];
	$calcium_text = $_POST['calcium_text'];
	$bicarbonate_text = $_POST['bicarbonate_text'];
	$glucose_fasting_text = $_POST['glucose_fasting_text'];
	$random_text = $_POST['random_text'];
	$bun_text = $_POST['bun_text'];
	$creatinine_text = $_POST['creatinine_text'];
	$hba1c_text = $_POST['hba1c_text'];

	
	
	// single quotes need to be replaced with the correct excape keys for the following values
	$sodium = str_replace('\'', '\\\'', $sodium);
	$chloride_text = str_replace('\'', '\\\'', $chloride_text);
	$potassium_text = str_replace('\'', '\\\'', $potassium_text);
	$calcium_text = str_replace('\'', '\\\'', $calcium_text);
	$bicarbonate_text = str_replace('\'', '\\\'', $bicarbonate_text);
	$glucose_fasting_text = str_replace('\'', '\\\'', $glucose_fasting_text);
	$random_text = str_replace('\'', '\\\'', $random_text);
	$bun_text = str_replace('\'', '\\\'', $bun_text);
	$creatinine_text = str_replace('\'', '\\\'', $creatinine_text);
	$hba1c_text = str_replace('\'', '\\\'', $hba1c_text);
	
	
	
	$arterial_blood = $_POST['arterial_blood'];
	
	if ($arterial_blood){
		$arterial_blood = "yes";
	}
	else {
		$arterial_blood = "no";
	}
	
	$pao2 = $_POST['pao2'];
	$paco2 = $_POST['paco2'];
	$arterial_text = $_POST['arterial_text'];
	$sao2_text = $_POST['sao2_text'];
	$hco3_text = $_POST['hco3_text'];
		
	// single quotes need to be replaced with the correct excape keys for the following values
	$pao2 = str_replace('\'', '\\\'', $pao2);
	$paco2 = str_replace('\'', '\\\'', $paco2);
	$arterial_text = str_replace('\'', '\\\'', $arterial_text);
	$sao2_text = str_replace('\'', '\\\'', $sao2_text);
	$hco3_text = str_replace('\'', '\\\'', $hco3_text);
	
	
	$liver_function_test = $_POST['liver_function_test'];
	
	if ($liver_function_test){
		$liver_function_test = "yes";
	}
	else {
		$liver_function_test = "no";
	}
	
	$alt = $_POST['alt'];
	$ast_text = $_POST['ast_text'];
	$albumin_text = $_POST['albumin_text'];
		
	// single quotes need to be replaced with the correct excape keys for the following values
	$alt = str_replace('\'', '\\\'', $alt);
	$ast_text = str_replace('\'', '\\\'', $ast_text);
	$albumin_text= str_replace('\'', '\\\'', $albumin_text);
	
	
	
	$prothrombin = $_POST['prothrombin'];
	
	if ($prothrombin){
		$prothrombin = "yes";
	}
	else {
		$prothrombin = "no";
	}
	
	$prothrombin_text = $_POST['prothrombin_text'];
	
		
	// single quotes need to be replaced with the correct excape keys for the following values
	$prothrombin_text = str_replace('\'', '\\\'', $prothrombin_text);
	
	
	
	
	$inr = $_POST['inr'];
	
	if ($inr){
		$inr = "yes";
	}
	else {
		$inr = "no";
	}
	
	$inr_text = $_POST['inr_text'];
	
		
	// single quotes need to be replaced with the correct excape keys for the following values
	$inr_text = str_replace('\'', '\\\'', $inr_text);
	
	
	
	$tft = $_POST['tft'];
	
	if ($tft){
		$tft = "yes";
	}
	else {
		$tft = "no";
	}
	
	$tsh = $_POST['tsh'];
	$freet3_text = $_POST['freet3_text'];
	$freet4_text = $_POST['freet4_text'];
		
	// single quotes need to be replaced with the correct excape keys for the following values
	$tsh = str_replace('\'', '\\\'', $tsh);
	$freet3_text = str_replace('\'', '\\\'', $freet3_text);
	$freet4_text = str_replace('\'', '\\\'', $freet4_text);
	
	
	
	$cholesterol = $_POST['cholesterol'];
	
	if ($cholesterol){
		$cholesterol = "yes";
	}
	else {
		$cholesterol = "no";
	}
	
	$total = $_POST['total'];
	$hdl_text = $_POST['hdl_text'];
	$ldl_text = $_POST['ldl_text'];
		
	// single quotes need to be replaced with the correct excape keys for the following values
	$total = str_replace('\'', '\\\'', $total);
	$hdl_text = str_replace('\'', '\\\'', $hdl_text);
	$ldl_text = str_replace('\'', '\\\'', $ldl_text);
	
	
	
	
	$cardiac = $_POST['cardiac'];
	
	if ($cardiac){
		$cardiac = "yes";
	}
	else {
		$cardiac = "no";
	}
	
	$troponin = $_POST['troponin'];
	$hdl_text = $_POST['hdl_text'];
		
	// single quotes need to be replaced with the correct excape keys for the following values
	$troponin = str_replace('\'', '\\\'', $troponin);
	$ck_text = str_replace('\'', '\\\'', $ck_text);


	$username = $_SESSION['username'];


	

	try {
		
		$query = INSERT INTO `lab` (`lab_id`, `client_id`, `first_name`, `last_name`, `sex`, `date_of_birth`, `location`, `bs_for_mps`, `bs_for_mps_results`,
		`widal`, `th1`, `th0`, `brucella`, `bm1`, `ba1`, `pylori_stool`, `pylori_stool_results`, `pylori_blood`, `pylori_blood_results`, `rheumatoid_factor`, 
		`rheumatoid_factor_results`, `stool`, `app`, `mic`, `p24_hiv`, `reactive_p24_hiv`, `vdrl_rpr`, `vdrl_rpr_results`, `urinalysis`, `urinalysis_urobilinogen`, 
		`urinalysis_glucose`, `urinalysis_bilirubin`, `urinalysis_ketones`, `urinalysis_specific_gravity`, `urinalysis_blood`, `urinalysis_ph`, `urinalysis_protein`, 
		`urinalysis_nitrite`, `urinalysis_leukocytes`, `pregnancy_test`, `pregnancy_test_results`, `hvs`, `hvs_macroscopy`, `hvs_microscopy`, `gram_stain`, `culture`,
		`blood_group`, `blood_group_rh`, `blood_group_type`, `du_test`, `blood_counts`, `rbc`, `hb`, `hct`, `mcv`, `rdw`, `wbc`, `platelet`, `neutrophils`, `lymphocytes`, 
		`monocytes`, `eosinophils`, `basophils`, `blood_chemistry`, `sodium`, `chloride`, `potassium`, `calcium`, `bicarbonate`, `glucose_fasting`, `glucose_random`, `bun`,
		`creatinine`, `hba1c`, `arterial_blood_gas`, `pao2`, `paco2`, `arterial_blood_ph`, `sao2`, `hco3`, `liver_function_test`, `alt`, `ast`, `albumin`, `prothrombin_time`,
		`prothrombin_time_results`, `inr`, `inr_results`, `thyroid_function_test`, `tsh`, `freet3`, `freet4`, `cholesterol`, `total`, `hdl`, `ldl`, `cardiac_enzymes`, `troponin`,
		`ck`, `lab_order_id`, `timestamp`, `clinician`, `created_by`)
		
		VALUES ('$client_id', '$first_name', '$last_name','$sex','$date_of_birth','$location', '$bs_for_mps', '$mps', '$widal', '$th1','$th2','$brucella', '$bm1','$ba1','$pylori_stool', '$pylori_stool_radio', '$pylori_blood', '$pylori_blood_radio', '$rheumatoid', '$reactive_rheumatoid_radio', '$stool', '$app', '$mic', '$p24_hiv', 'reactive_p24_hiv', '$vdrl_rpr', '$reactive', '$urinalysis', '$urobilinogen', 
		'$glucose', '$bilirubin', '$ketones', '$specific_gravity', '$blood', '$ph', '$protein', '$nitrite', '$leukocytes', '$pregnancy', '$hcg_detected', '$hvs', '$macroscopy', '$microscopy_hvs', '$gram_stain', '$gram_stain_text', '$culture', '$culture_text', '$blood_group', '$rhve', '$aboab', '$du_test', '$blood_count', '$rbc', '$hb_text', '$hct_text', '$mcv_text', '$rdw_text', '$wbc_text', '$platelet_text', '$neutrophils_text', '$lymphocytes_text', '$monocytes_text',
		'$eosinophils_text', '$basophils_text', '$blood_chemistry', '$sodium', '$chloride_text', '$potassium_text', '$calcium_text', '$bicarbonate_text', '$glucose_fasting_text', '$random_text', '$bun_text', '$creatinine_text', '$hba1c_text', '$arterial_blood', '$pao2', '$paco2', '$arterial_text', '$sao2_text', '$hco3_text', '$liver_function_test`', '$alt', '$ast_text','$albumin_text','$prothrombin', '$prothrombin_text','$inr', '$inr_text','$tft','$tsh',
		'$freet3_text', '$freet4_text', '$cholesterol', '$total', '$hdl_text', '$ldl_text', '$cardiac', '$troponin', '$ck_text','$clinician', '$username' )"; 
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






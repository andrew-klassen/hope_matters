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

	
	$h_pylori_stool = $_POST['h_pylori_stool'];
	
	$h_pylori_blood = $_POST['h_pylori_blood'];
	
	$rheumatoid_factor = $_POST['rheumatoid_factor'];
	
	$app = $_POST['app'];
	$mic = $_POST['mic'];
	
	// single quotes need to be replaced with the correct excape keys for the following values
	$app = str_replace('\'', '\\\'', $app);
	$mic = str_replace('\'', '\\\'', $mic);
	
	$reactive_p24_hiv = $_POST['reactive_p24_hiv'];

	
	$vdrl_rpr = $_POST['vdrl_rpr'];
	
	
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
	
	
	$hcg_detected = $_POST['hcg_detected'];
	
	
	$macroscopy = $_POST['macroscopy'];
	$microscopy_hvs = $_POST['microscopy_hvs'];
	
	// single quotes need to be replaced with the correct excape keys for the following values
	$macroscopy = str_replace('\'', '\\\'', $macroscopy);
	$microscopy_hvs = str_replace('\'', '\\\'', $microscopy_hvs);
	
	
	
	$gram_stain = $_POST['gram_stain'];
	
	// single quotes need to be replaced with the correct excape keys for the following values
	$gram_stain = str_replace('\'', '\\\'', $gram_stain);

	
	$culture = $_POST['culture'];
	
	// single quotes need to be replaced with the correct excape keys for the following values
	$culture = str_replace('\'', '\\\'', $culture);
	
	
	
	
	$rhve = $_POST['rhve'];
	$aboab = $_POST['aboab'];
	$du_test = $_POST['du_test'];
	
	// single quotes need to be replaced with the correct excape keys for the following value
	$du_test = str_replace('\'', '\\\'', $du_test);
	
	
	
    $rbc = $_POST['rbc'];
	$hb = $_POST['hb'];
	$hct = $_POST['hct'];
	$mcv = $_POST['mcv'];
	$rdw = $_POST['rdw'];
	$wbc = $_POST['wbc'];
	$platelet = $_POST['platelet'];
	$neutrophils = $_POST['neutrophils'];
	$lymphocytes = $_POST['lymphocytes'];
	$monocytes = $_POST['monocytes'];
	$eosinophils = $_POST['eosinophils'];
	$basophils = $_POST['basophils'];
	
	// single quotes need to be replaced with the correct excape keys for the following value
	$rbc = str_replace('\'', '\\\'', $rbc);
	$hb = str_replace('\'', '\\\'', $hb);
	$hct = str_replace('\'', '\\\'', $hct);
	$mcv = str_replace('\'', '\\\'', $mcv);
	$rdw = str_replace('\'', '\\\'', $rdw);
	$wbc = str_replace('\'', '\\\'', $wbc);
	$platelet = str_replace('\'', '\\\'', $platelet);
	$neutrophils = str_replace('\'', '\\\'', $neutrophils);
	$lymphocytes = str_replace('\'', '\\\'', $lymphocytes);
	$monocytes = str_replace('\'', '\\\'', $monocytes);
	$eosinophils = str_replace('\'', '\\\'', $eosinophils);
	$basophils = str_replace('\'', '\\\'', $basophils);
	
	
	
	
    $sodium = $_POST['sodium'];
	$chloride = $_POST['chloride'];
	$potassium = $_POST['potassium'];
	$calcium = $_POST['calcium'];
	$bicarbonate = $_POST['bicarbonate'];
	$glucose_fasting = $_POST['glucose_fasting'];
	$glucose_random = $_POST['glucose_random'];
	$bun = $_POST['bun'];
	$creatinine = $_POST['creatinine'];
	$hba1c = $_POST['hba1c'];
	
	// single quotes need to be replaced with the correct excape keys for the following value
	$sodium = str_replace('\'', '\\\'', $sodium);
	$chloride = str_replace('\'', '\\\'', $chloride);
	$potassium = str_replace('\'', '\\\'', $potassium);
	$calcium = str_replace('\'', '\\\'', $calcium);
	$bicarbonate = str_replace('\'', '\\\'', $bicarbonate);
	$glucose_fasting = str_replace('\'', '\\\'', $glucose_fasting);
	$glucose_random = str_replace('\'', '\\\'', $glucose_random);
	$bun = str_replace('\'', '\\\'', $bun);
	$creatinine = str_replace('\'', '\\\'', $creatinine);
	$hba1c = str_replace('\'', '\\\'', $hba1c);
	
	
	
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
	
	
	
	
	$alt = $_POST['alt'];
	$ast_text = $_POST['ast_text'];
	$albumin_text = $_POST['albumin_text'];
		
	// single quotes need to be replaced with the correct excape keys for the following values
	$alt = str_replace('\'', '\\\'', $alt);
	$ast_text = str_replace('\'', '\\\'', $ast_text);
	$albumin_text= str_replace('\'', '\\\'', $albumin_text);
	
	
	
	$prothrombin_text = $_POST['prothrombin_text'];
	
		
	// single quotes need to be replaced with the correct excape keys for the following values
	$prothrombin_text = str_replace('\'', '\\\'', $prothrombin_text);
	
	
	
	$inr_text = $_POST['inr_text'];
	
		
	// single quotes need to be replaced with the correct excape keys for the following values
	$inr_text = str_replace('\'', '\\\'', $inr_text);
	
	
	
	
	$tsh = $_POST['tsh'];
	$freet3_text = $_POST['freet3_text'];
	$freet4_text = $_POST['freet4_text'];
		
	// single quotes need to be replaced with the correct excape keys for the following values
	$tsh = str_replace('\'', '\\\'', $tsh);
	$freet3_text = str_replace('\'', '\\\'', $freet3_text);
	$freet4_text = str_replace('\'', '\\\'', $freet4_text);
	
	
	
	
	$total = $_POST['total'];
	$hdl_text = $_POST['hdl_text'];
	$ldl_text = $_POST['ldl_text'];
		
	// single quotes need to be replaced with the correct excape keys for the following values
	$total = str_replace('\'', '\\\'', $total);
	$hdl_text = str_replace('\'', '\\\'', $hdl_text);
	$ldl_text = str_replace('\'', '\\\'', $ldl_text);
	
	
	
	$troponin = $_POST['troponin'];
	$hdl_text = $_POST['hdl_text'];
		
	// single quotes need to be replaced with the correct excape keys for the following values
	$troponin = str_replace('\'', '\\\'', $troponin);
	$ck_text = str_replace('\'', '\\\'', $ck_text);
	
	
	
	
	
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
	
	
	
	$stmt = $conn->prepare("SELECT h_pylori_stool FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$h_pylori_stool = $_SESSION['temp'];
	
	
	
	$stmt = $conn->prepare("SELECT h_pylori_blood FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$h_pylori_blood = $_SESSION['temp'];
	
	
	
	
	$stmt = $conn->prepare("SELECT rheumatoid_factor FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$rheumatoid_factor = $_SESSION['temp'];
	
	
	
	
	$stmt = $conn->prepare("SELECT stool FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$stool = $_SESSION['temp'];
	
	
	
	
	$stmt = $conn->prepare("SELECT p24_hiv FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$p24_hiv = $_SESSION['temp'];
	
	
	
	$stmt = $conn->prepare("SELECT vdrl_rpr FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$vdrl_rpr = $_SESSION['temp'];
	
	
	
	$stmt = $conn->prepare("SELECT urinalysis FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$urinalysis = $_SESSION['temp'];
	
	
	
	$stmt = $conn->prepare("SELECT pregnancy_test FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$pregnancy_test = $_SESSION['temp'];
	
	
	
	
	$stmt = $conn->prepare("SELECT hvs FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$hvs = $_SESSION['temp'];
	
	
	
	
	$stmt = $conn->prepare("SELECT gram_stain FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$gram_stain = $_SESSION['temp'];
	
	
	
	$stmt = $conn->prepare("SELECT culture FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$culture = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT blood_group FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$blood_group = $_SESSION['temp'];
	
	
	
	
	$stmt = $conn->prepare("SELECT blood_count FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$blood_count = $_SESSION['temp'];
	
	
	
	$stmt = $conn->prepare("SELECT blood_chemistry FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$blood_chemistry = $_SESSION['temp'];
	
	
	
	$stmt = $conn->prepare("SELECT arterial_blood FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$arterial_blood = $_SESSION['temp'];
	
	
	
	$stmt = $conn->prepare("SELECT liver_function_test FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$liver_function_test = $_SESSION['temp'];
	
	
	
	$stmt = $conn->prepare("SELECT prothrombin_text FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$prothrombin_text = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT inr FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$inr = $_SESSION['temp'];
	
	
	
	$stmt = $conn->prepare("SELECT thyroid_function_test FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$thyroid_function_test = $_SESSION['temp'];
	
	
	
	
	
	$stmt = $conn->prepare("SELECT cholesterol FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$cholesterol = $_SESSION['temp'];
	
	
	
	
	
	$stmt = $conn->prepare("SELECT cardiac FROM lab_order WHERE lab_order_id='$lab_order_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$cardiac = $_SESSION['temp'];

	
	
	
	
	
	$username = $_SESSION['username'];
	$time_completed = date("Y-m-d H:i:s"); 
	
	try {
		
		// mark selected lab order as completed
		$query = "UPDATE lab_order SET time_completed='$time_completed', completed_by='$username' WHERE lab_order_id='$lab_order_id';"; 
		$conn->exec($query);
		
		// create the lab from the lab order
		$query = "INSERT INTO lab (`lab_id`, `client_id`, `first_name`, `last_name`, `sex`, `date_of_birth`, `location`, `bs_for_mps`, `bs_for_mps_results`,
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
		'$freet3_text', '$freet4_text', '$cholesterol', '$total', '$hdl_text', '$ldl_text', '$cardiac', '$troponin', '$ck_text','$clinician', '$username' );"; 
		$conn->exec($query); 

		
		// redirect the user to where they can select an order to complete
		header( 'Location: select_complete_lab_order.php');
		exit();
		
	}

	catch(PDOException $e) {
		create_database_error($query, 'insert_lab_form.php (lab_orders)', $e->getMessage());
	}

	$conn = null;
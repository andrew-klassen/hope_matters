<!--
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
-->

<!DOCTYPE html>
<html>

<head>
	<title>Hope Matters</title>
	<link rel="icon" href="/images/hope_matters_logo.png">
	<link rel="stylesheet" type="text/css" href="/css/navbar.css">
	<link rel="stylesheet" type="text/css" href="/css/add_client.css">
	<script src="/js/lab_validation.js" type="text/javascript"> </script>
</head>

<body style="padding-top: 70px;">


<div id="container">
	   
	  <div id="sign-out">
        <form method="post" action="/php/dashboard.php">
            <input type="submit" value="Dashboard">
        </form>
      </div>
	  
	  <div id="sign-out">
        <form method="post" action="/php/sign_out.php">
            <input type="submit" value="Sign Out">
        </form>
      </div>
	  
	  <div style="float: left;  width: 300px;">
        <form method="post" action="select_lab.php">
            <input style="width: 300px;" type="submit" value="Form Selection">
        </form>
      </div>
	  
</div>
<br></br>
  
  
<!-- all divs are within this div, it keeps the divs centered -->
<div style="width:970px; margin: 0 auto; ">
  
  <!-- the begining of general info card -->
  <div class="accountCard" style="float: left; margin-left: 245px;" >
	<p class='p'style='color: black;font-weight:100; text-align: center;'>Client's General Info</p>
	
	
	
<?php
		
		require('../database_credentials.php');
		require('../date_functions.php');
		session_start();
		
		// make sure user is logged in
		login_check();
		
		$choosen_lab = $_SESSION['choosen_lab'];
		$username = $_SESSION['username'];
		
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
		
		// used to display list of clinicians in the database 
		class display_clinicians extends RecursiveIteratorIterator {
			function __construct($it) {
				parent::__construct($it, self::LEAVES_ONLY);
			}
			function current() {
					
				return "<option value='" . parent::current() . "'>";
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
		
		
		// grab client id
		$stmt = $conn->prepare("SELECT client_id FROM lab WHERE lab_id='$choosen_lab'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$choosen_client_id = $_SESSION['temp'];
		
		
		// grab first name
		$stmt = $conn->prepare("SELECT first_name FROM lab WHERE lab_id='$choosen_lab'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$first_name = $_SESSION['temp'];
		
		
		// grab last name
		$stmt = $conn->prepare("SELECT last_name FROM lab WHERE lab_id='$choosen_lab'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$last_name = $_SESSION['temp'];
		
		
		// grab sex
		$stmt = $conn->prepare("SELECT sex FROM lab WHERE lab_id='$choosen_lab'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$sex = $_SESSION['temp'];
		
		
		// grab location
		$stmt = $conn->prepare("SELECT location FROM lab WHERE lab_id='$choosen_lab'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$location = $_SESSION['temp'];
		
		
		// grab date of birth
		$stmt = $conn->prepare("SELECT date_of_birth FROM lab WHERE lab_id='$choosen_lab'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$date_of_birth = $_SESSION['temp'];
			
		
		// get the client's age
		$age = get_age_from_date_of_birth($date_of_birth);
		
		
		// display the general info
		echo "<div style='width: 500px; height: 100px;'>";
		echo "<div style=' float: left;'>";
		echo '<b>Client ID:</b>' . "<br>" . "<br>";
		echo '<b>First Name:</b>' . "<br>" . "<br>";
		echo '<b>Last Name:</b>' . "<br>" . "<br>";
		echo "</div>";
		
		echo "<div style=' float: left;padding-left: 20px;'>";
		echo $choosen_client_id . "<br>" . "<br>";
		echo $first_name . "<br>" . "<br>";
		echo $last_name;
		echo '</div>';
		echo '</div>';
		
		
		echo "<div style='float: left; width: 500px;height: 70px;'>";
		echo "<div style=' float: left;'>";
		echo '<b>Sex:</b>' . "<br>" . "<br>";
		echo '<b>Age:</b>' . "<br>" . "<br>";
		echo '<b>Residence:</b>' . "<br>" . "<br>";
		echo "</div>";
		
		echo "<div style=' float: left;padding-left: 22px;'>";
		echo $sex . "<br>" . "<br>";
		echo $age . "<br>" . "<br>";
		echo $location;
		echo '</div>';
		echo '</div>';
		
	?>
	
  
  </div>
  
	<!-- start of lab card -->
    <div class="accountCard" style="float: left; width: 885px; height: 2950px; position: relative;">
		
		<p class='p'style='color: black;font-weight:100; text-align: center;'>Check the tests that were preformed before providing the results.</p>
		
		<form name="lab_form" action="update_lab.php" onsubmit="return validate_form()" method="post">
		
		<?php



			$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			$stmt = $conn->prepare("SELECT * FROM lab WHERE lab_id=:choosen_lab");
			$stmt->execute(array('choosen_lab' => $choosen_lab));
			$lab_array = $stmt->fetch(PDO::FETCH_ASSOC);


			foreach ($lab_array as $key => $value) {
				if ($value == 'yes') {
					$lab_array[$key] = 'checked';
				}
				else if ($value == 'no') {
					$lab_array[$key] = '';
				}
			}


			/*
			echo "<pre>";
    			print_r($lab_array); // or var_dump($data);
    			echo "</pre>";
			*/

		
			// get bs_for_mps
			$stmt = $conn->prepare("SELECT bs_for_mps FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$bs_for_mps_check = $_SESSION['temp'];
		
		
			// get bs for mps results
			$stmt = $conn->prepare("SELECT bs_for_mps_results FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$bs_for_mps_results = $_SESSION['temp'];
			
			// check to see if a bs for mps test was done
			if ($bs_for_mps_check == 'yes') {
				$bs_for_mps_check = 'checked';
					
					// find out which button should be checked
					switch ($bs_for_mps_results) {
						case 'no mps seen':
							$no_mps_seen_dis = 'checked';
							break;
						case 'mps+1':
							$mps1_dis = 'checked';
							break;
						case 'mps+2':
							$mps2_dis = 'checked';
							break;
						case 'mps+3':
							$mps3_dis = 'checked';
							break;
						
					}
					echo "<input type='checkbox' name='bs_for_mps' onchange='toggle_disabled_mps(this.checked)' $bs_for_mps_check /><b>B/S for MPS:</b>
						<input type='radio' id='no_mps' name='bs_for_mps_results' value='no mps seen' $no_mps_seen_dis />No MPS Seen
						<input type='radio' id='mps1' name='bs_for_mps_results' value='mps+1' $mps1_dis />MPS+1
						<input type='radio' id='mps2' name='bs_for_mps_results' value='mps+2' $mps2_dis />MPS+2
						<input type='radio' id='mps3' name='bs_for_mps_results' value='mps+3' $mps3_dis />MPS+3 <br><br>";	
			}
			// if no test was done disable all the the radio buttons
			else {
				echo "<input type='checkbox' name='bs_for_mps' onchange='toggle_disabled_mps(this.checked)'/><b>B/S for MPS:</b>
					<input type='radio' id='no_mps' name='bs_for_mps_results' value='no mps seen' disabled />No MPS Seen
					<input type='radio' id='mps1' name='bs_for_mps_results' value='mps+1' disabled />MPS+1
					<input type='radio' id='mps2' name='bs_for_mps_results' value='mps+2' disabled />MPS+2
					<input type='radio' id='mps3' name='bs_for_mps_results' value='mps+3' disabled />MPS+3 <br><br>";
			}
			
			
			
			
			
			// get the widal
			$stmt = $conn->prepare("SELECT widal FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$widal_check = $_SESSION['temp'];
		
		
			// get the th1
			$stmt = $conn->prepare("SELECT th1 FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$th1 = $_SESSION['temp'];
			
			
			// get the th0
			$stmt = $conn->prepare("SELECT th0 FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$th0 = $_SESSION['temp'];
			
			
			// see if a widal test was preformed
			if ($widal_check == 'yes') {
				$widal_check = 'checked';
				
				echo "<div style='float: left; width: 350px;'>
					<input type='checkbox' name='widal' onchange='toggle_disabled_widal(this.checked)' $widal_check /> <b>Widal</b> (greater than 80 indicative for Tx) <br>
					TH 1:<input type='number' id='th1' name='th1' style='width: 100px; height: 30px;' value='$th1' min='-9999999999' max='9999999999' /><br>
					TH 0:<input type='number' id='th0' name='th0' style='width: 100px; height: 30px;' value='$th0' min='-9999999999' max='9999999999' />
					</div>"; 
			}
			else {
				echo "<div style='float: left; width: 350px;'>
					<input type='checkbox' name='widal' onchange='toggle_disabled_widal(this.checked)'  /> <b>Widal</b> (greater than 80 indicative for Tx) <br>
					TH 1:<input type='number' id='th1' name='th1' style='width: 100px; height: 30px;' min='-9999999999' max='9999999999' disabled /><br>
					TH 0:<input type='number' id='th0' name='th0' style='width: 100px; height: 30px;' min='-9999999999' max='9999999999' disabled />
					</div>";
			}
			
			
			
			// get the brucella
			$stmt = $conn->prepare("SELECT brucella FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$brucella_check = $_SESSION['temp'];
		
			
			// get bm1
			$stmt = $conn->prepare("SELECT bm1 FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$bm1 = $_SESSION['temp'];
			
			
			// get ba1
			$stmt = $conn->prepare("SELECT ba1 FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$ba1 = $_SESSION['temp'];
			
			
			// see if a brucella test was done
			if ($brucella_check == 'yes') {
				$brucella_check = 'checked';
				
				echo "<div style='float: left; width: 350px;'>
					<input type='checkbox' name='brucella' onchange='toggle_disabled_brucella(this.checked)' $brucella_check/> <b>Brucella</b> (Increasing Titers Indicative for Tx) <br>
					BM 1:<input type='number' id='bm1' name='bm1' style='width: 100px; height: 30px;' value='$bm1' min='-9999999999' max='9999999999'/><br>
					BA 1:<input type='number' id='ba1' name='ba1' style='width: 100px; height: 30px;' value='$ba1' min='-9999999999' max='9999999999' />
					</div>
					<br><br><br><br><br><br>"; 
			}
			// if no test was done disable all the radio buttons
			else {
				echo "<div style='float: left; width: 350px;'>
					<input type='checkbox' name='brucella' onchange='toggle_disabled_brucella(this.checked)'/> <b>Brucella</b> (Increasing Titers Indicative for Tx) <br>
					BM 1:<input type='number' id='bm1' name='bm1' style='width: 100px; height: 30px;' min='-9999999999' max='9999999999' disabled /><br>
					BA 1:<input type='number' id='ba1' name='ba1' style='width: 100px; height: 30px;' min='-9999999999' max='9999999999' disabled />
					</div>
					<br><br><br><br><br><br>";
			}
			
			


			$stmt = $conn->prepare("SELECT pylori_stool FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$pylori_stool_check = $_SESSION['temp'];
			
		
		
			
			$stmt = $conn->prepare("SELECT pylori_stool_results FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$pylori_stool_results = $_SESSION['temp'];



			if ($pylori_stool_check == 'yes') {
				$pylori_stool_check = 'checked';


					switch ($pylori_stool_results) {
						case 'positive':
							$pylori_stool_results_pos = 'checked';
							break;
						case 'negative':
							$pylori_stool_results_neg = 'checked';
							break;
						
					}

					
				echo "<input type='checkbox' name='pylori_stool' onchange='toggle_disabled_pylori_stool(this.checked)' $pylori_stool_check/> <b>H. Pylori Stool: </b>
			<input type='radio' id='positive_pylori_stool' name='pylori_stool_results' value='positive' $pylori_stool_results_pos/>positive
			<input type='radio' id='negative_pylori_stool' name='pylori_stool_results' value='negative' $pylori_stool_results_neg/>negative
			
			<br/><br/>";
					
			}
			// if no test was done disable the textbox
			else {
				echo "<input type='checkbox' name='pylori_stool' onchange='toggle_disabled_pylori_stool(this.checked)' /> <b>H. Pylori Stool: </b>
			<input type='radio' id='positive_pylori_stool' name='pylori_stool_results' value='positive' disabled />positive
			<input type='radio' id='negative_pylori_stool' name='pylori_stool_results' value='negative' disabled />negative
			
			<br/><br/>";
			}






			$stmt = $conn->prepare("SELECT pylori_blood FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$pylori_blood_check = $_SESSION['temp'];
			
		
		
			
			$stmt = $conn->prepare("SELECT pylori_blood_results FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$pylori_blood_results = $_SESSION['temp'];



			if ($pylori_blood_check == 'yes') {
				$pylori_blood_check = 'checked';


					switch ($pylori_blood_results) {
						case 'positive':
							$pylori_blood_results_pos = 'checked';
							break;
						case 'negative':
							$pylori_blood_results_neg = 'checked';
							break;
						
					}


				echo "<input type='checkbox' name='pylori_blood' onchange='toggle_disabled_pylori_blood(this.checked)' $pylori_blood_check /> <b> H. Pylori Blood: </b>
			<input type='radio' id='positive_pylori_blood' name='pylori_blood_results' value='positive' $pylori_blood_results_pos />positive
			<input type='radio' id='negative_pylori_blood' name='pylori_blood_results' value='negative' $pylori_blood_results_neg />negative
			
			<br><br>";

					
			}
			// if no test was done disable the textbox
			else {
				echo "<input type='checkbox' name='pylori_blood' onchange='toggle_disabled_pylori_blood(this.checked)' /> <b> H. Pylori Blood: </b>
			<input type='radio' id='positive_pylori_blood' name='pylori_blood_results' value='positive' disabled />positive
			<input type='radio' id='negative_pylori_blood' name='pylori_blood_results' value='negative' disabled />negative
			
			<br><br>";



			}








			$stmt = $conn->prepare("SELECT rheumatoid_factor FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$rheumatoid_factor_check = $_SESSION['temp'];
			
		
		
			
			$stmt = $conn->prepare("SELECT rheumatoid_factor_results FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$rheumatoid_factor_results = $_SESSION['temp'];






			if ($rheumatoid_factor_check == 'yes') {
				$rheumatoid_factor_check = 'checked';
					switch ($rheumatoid_factor_results) {
						case 'reactive':
							$rheumatoid_factor_results_reactive = 'checked';
							break;
						case 'non_reactive':
							$rheumatoid_factor_results_non_reactive = 'checked';
							break;
						
					}


					echo "

			<input type='checkbox' name='rheumatoid_factor' onchange='toggle_disabled_rheumatoid(this.checked)' $rheumatoid_factor_check/> <b>Rheumatoid Factor:</b>
			<input type='radio' id='reactive_rheumatoid' name='rheumatoid_factor_results' value='reactive' $rheumatoid_factor_results_reactive />Reactive
			<input type='radio' id='non_reactive_rheumatoid' name='rheumatoid_factor_results' value='non_reactive'  $rheumatoid_factor_results_non_reactive />Non-Reactive
			
			<br/><br/>";

					
			}
			// if no test was done disable the textbox
			else {
				echo "

			<input type='checkbox' name='rheumatoid_factor' onchange='toggle_disabled_rheumatoid(this.checked)' /> <b>Rheumatoid Factor:</b>
			<input type='radio' id='reactive_rheumatoid' name='rheumatoid_factor_results' value='reactive' disabled />Reactive
			<input type='radio' id='non_reactive_rheumatoid' name='rheumatoid_factor_results' value='non_reactive' disabled />Non-Reactive
			
			<br/><br/>";



			}











			

			





















































			
			
			// get stool
			$stmt = $conn->prepare("SELECT stool FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$stool_check = $_SESSION['temp'];
		
		
			// get app
			$stmt = $conn->prepare("SELECT app FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$app = $_SESSION['temp'];
			
			
			// get mic
			$stmt = $conn->prepare("SELECT mic FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$mic = $_SESSION['temp'];
			
			
			// see if stool test was done
			if ($stool_check == 'yes') {
				
				$stool_check = 'checked';
				echo "<input type='checkbox' name='stool' onchange='toggle_disabled_stool(this.checked)' $stool_check/> <b>Stool O/C</b><br>
					APP:<input type='text' id='app' name='app' style='width: 100px; height: 30px;' value='$app' maxlength='45' /><br>
					MIC:<input type='text' id='mic' name='mic' style='width: 100px; height: 30px;' value='$mic' maxlength='45' />
				
					<br><br>"; 
			}
			// if not then disable app and mic textboxes
			else {
				echo "<input type='checkbox' name='stool' onchange='toggle_disabled_stool(this.checked)'/> <b>Stool O/C</b><br>
					APP:<input type='text' id='app' name='app' style='width: 100px; height: 30px;' maxlength='45' disabled /><br>
					MIC:<input type='text' id='mic' name='mic' style='width: 100px; height: 30px;' maxlength='45' disabled />
				
					<br><br>";
			}
			
			
			
			
			
			






			// get vdrl/rpr
			$stmt = $conn->prepare("SELECT vdrl_rpr FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$vdrl_rpr_check = $_SESSION['temp'];
			
			
			// get vdrl/rpr results
			$stmt = $conn->prepare("SELECT vdrl_rpr_results FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$vdrl_rpr_results = $_SESSION['temp'];
			
			
			
			// see if a vdrl/rpr test was done
			If ($vdrl_rpr_check == 'yes') {
				$vdrl_rpr_check = 'checked';
				
				// find out whether or not vdrl/rpr is reactive
				switch ($vdrl_rpr_results) {
						case 'reactive':
							$reactive_dis = 'checked';
							break;
						case 'non_reactive':
							$non_reactive_dis = 'checked';
							break;
					}
				
				echo "<input type='checkbox' name='vdrl_rpr' onchange='toggle_disabled_vdrl_rpr(this.checked)' $vdrl_rpr_check/> <b>VDRL/RPR:</b>
					<input type='radio' id='reactive' name='vdrl_rpr_results' value='reactive' $reactive_dis />Reactive
					<input type='radio' id='non_reactive' name='vdrl_rpr_results' value='non_reactive' $non_reactive_dis />Non-Reactive
			
					<br><br>";
			
			}
			// if no test was done disable all the radio buttons
			else {
			
				echo "<input type='checkbox' name='vdrl_rpr' onchange='toggle_disabled_vdrl_rpr(this.checked)'/> <b>VDRL/RPR:</b>
					<input type='radio' id='reactive' name='vdrl_rpr_results' value='reactive' disabled />Reactive
					<input type='radio' id='non_reactive' name='vdrl_rpr_results' value='non_reactive' disabled />Non-Reactive
					<br><br>";
			}
			
			
			// get p24/hiv
			$stmt = $conn->prepare("SELECT p24_hiv FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$p24_hiv_check = $_SESSION['temp'];
			
			
			// get p24/hiv results
			$stmt = $conn->prepare("SELECT reactive_p24_hiv FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$reactive_p24_hiv = $_SESSION['temp'];
			
			
			// see if p24/hiv test was done
			If ($p24_hiv_check == 'yes') {
				$p24_hiv_check = 'checked';
				
				// determine which radio button should be checked
				switch ($reactive_p24_hiv) {
						case 'reactive':
							$reactive_dis = 'checked';
							break;
						case 'non_reactive':
							$non_reactive_dis = 'checked';
							break;
					}
				
				echo "<input type='checkbox' name='p24_hiv' onchange='toggle_disabled_p24_hiv(this.checked)' $p24_hiv_check /> <b>P24/HIV:</b>
					<input type='radio' id='reactive_p24_hiv' name='reactive_p24_hiv' value='reactive' $reactive_dis />Reactive
					<input type='radio' id='non_reactive_p24_hiv' name='reactive_p24_hiv' value='non_reactive' $non_reactive_dis />Non-Reactive
			
					<br><br>";
			}
			// if no test was done disable all the radio buttons
			else {
			
				echo "<input type='checkbox' name='p24_hiv' onchange='toggle_disabled_p24_hiv(this.checked)'/> <b>P24/HIV:</b>
					<input type='radio' id='reactive_p24_hiv' name='reactive_p24_hiv' value='reactive' disabled />Reactive
					<input type='radio' id='non_reactive_p24_hiv' name='reactive_p24_hiv' value='non_reactive' disabled />Non-Reactive
			
					<br><br>";
			}
			
			
			
			
			
			
			// get urinalysis
			$stmt = $conn->prepare("SELECT urinalysis FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$urinalysis_check = $_SESSION['temp'];
			
			
			// get urobilinogen results
			$stmt = $conn->prepare("SELECT urinalysis_urobilinogen FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$urinalysis_urobilinogen = $_SESSION['temp'];
			
			
			// get glucose results
			$stmt = $conn->prepare("SELECT urinalysis_glucose FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$urinalysis_glucose = $_SESSION['temp'];
			
		
			// get bilirubin results
			$stmt = $conn->prepare("SELECT urinalysis_bilirubin FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$urinalysis_bilirubin = $_SESSION['temp'];
			
			
			// get ketones results
			$stmt = $conn->prepare("SELECT urinalysis_ketones FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$urinalysis_ketones = $_SESSION['temp'];
			
			
			// get secific gravity results
			$stmt = $conn->prepare("SELECT urinalysis_specific_gravity FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$urinalysis_specific_gravity = $_SESSION['temp'];
			
			
			// get blood results
			$stmt = $conn->prepare("SELECT urinalysis_blood FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$urinalysis_blood = $_SESSION['temp'];
			
			
			// get ph results
			$stmt = $conn->prepare("SELECT urinalysis_ph FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$urinalysis_ph = $_SESSION['temp'];
			
			
			// get protein results
			$stmt = $conn->prepare("SELECT urinalysis_protein FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$urinalysis_protein = $_SESSION['temp'];
			
			
			// get nitrite results
			$stmt = $conn->prepare("SELECT urinalysis_nitrite FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$urinalysis_nitrite = $_SESSION['temp'];
			
			
			// get leukocytes results
			$stmt = $conn->prepare("SELECT urinalysis_leukocytes FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$urinalysis_leukocytes = $_SESSION['temp'];
			
			
			// get microsopy results
			$stmt = $conn->prepare("SELECT urinalysis_microscopy FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$urinalysis_microscopy = $_SESSION['temp'];
			
			
			// see if a urinalysis test was done
			if ($urinalysis_check == 'yes') {
				$urinalysis_check = 'checked';
				
				// see which urobilinogen radio button should be checked
				switch ($urinalysis_urobilinogen) {
						case 'neg':
							$neg_dis = 'checked';
							break;
						case '+-':
							$plus_neg_dis = 'checked';
							break;
						case '+':
							$plus_dis = 'checked';
							break;
						case '++':
							$plus2_dis = 'checked';
							break;
						case '+++':
							$plus3_dis = 'checked';
							break;
				}
				
				echo "<input type='checkbox' name='urinalysis' onchange='toggle_disabled_urinalysis(this.checked)' $urinalysis_check /><b>Urinalysis</b><br>
					<label style='margin-left: 50px; margin-right: 22px;'>Urobilinogen:</label>
					<input style='margin-left: 50px;'  type='radio' id='urobilinogen_neg' name='urinalysis_urobilinogen' value='neg' $neg_dis />neg
					<input type='radio' id='urobilinogen_plus_neg' name='urinalysis_urobilinogen' value='+-' $plus_neg_dis />+-
					<input type='radio' id='urobilinogen_plus' name='urinalysis_urobilinogen' value='+'  $plus_dis />+
					<input type='radio' id='urobilinogen_plus2' name='urinalysis_urobilinogen' value='++'  $plus2_dis />++
					<input type='radio' id='urobilinogen_plus3' name='urinalysis_urobilinogen' value='+++' $plus3_dis />+++
					
					<br>";
					
					
					// clear all values to prevent the test from using previous result
					$neg_dis = '';
					$plus_neg_dis = '';
					$plus_dis = '';
					$plus2_dis = '';
					$plus3_dis = '';
					
					// see which glucose radio button should be checked
					switch ($urinalysis_glucose) {
						case 'neg':
							$neg_dis = 'checked';
							break;
						case '+-':
							$plus_neg_dis = 'checked';
							break;
						case '+':
							$plus_dis = 'checked';
							break;
						case '++':
							$plus2_dis = 'checked';
							break;
						case '+++':
							$plus3_dis = 'checked';
							break;
					}
				
				echo "<label style='margin-left: 50px; margin-right: 53px;'>Glucose:</label>
					<input style='margin-left: 50px;'  type='radio' id='glucose_neg' name='urinalysis_glucose' value='neg' $neg_dis />neg
					<input type='radio' id='glucose_plus_neg' name='urinalysis_glucose' value='+-' $plus_neg_dis />+-
					<input type='radio' id='glucose_plus' name='urinalysis_glucose' value='+' $plus_dis />+
					<input type='radio' id='glucose_plus2' name='urinalysis_glucose' value='++' $plus2_dis />++
					<input type='radio' id='glucose_plus3' name='urinalysis_glucose' value='+++' $plus3_dis />+++
					
					<br>";
					
					
					// clear all values to prevent the test from using previous result
					$neg_dis = '';
					$plus_neg_dis = '';
					$plus_dis = '';
					$plus2_dis = '';
					$plus3_dis = '';
					
					// see which bilirubin radio button should be checked
					switch ($urinalysis_bilirubin) {
						case 'neg':
							$neg_dis = 'checked';
							break;
						case '+-':
							$plus_neg_dis = 'checked';
							break;
						case '++':
							$plus2_dis = 'checked';
							break;
						case '+++':
							$plus3_dis = 'checked';
							break;
					}
					
					echo "<label style='margin-left: 50px; margin-right: 55px;'>Bilirubin:</label>
						<input style='margin-left: 50px;'  type='radio' id='bilirubin_neg' name='urinalysis_bilirubin' value='neg' $neg_dis />neg
						<input type='radio' id='bilirubin_plus_neg' name='urinalysis_bilirubin' value='+-' $plus_neg_dis />+-
						<input type='radio' id='bilirubin_plus2' name='urinalysis_bilirubin' value='++' $plus2_dis/>++
						<input type='radio' id='bilirubin_plus3' name='urinalysis_bilirubin' value='+++' $plus3_dis />+++
						
						<br>";
				
				
					// clear all values to prevent the test from using previous result
					$neg_dis = '';
					$plus_neg_dis = '';
					$plus_dis = '';
					$plus2_dis = '';
					$plus3_dis = '';
					
					// see which ketones radio button should be checked
					switch ($urinalysis_ketones) {
						case 'neg':
							$neg_dis = 'checked';
							break;
						case '+-':
							$plus_neg_dis = 'checked';
							break;
						case '+':
							$plus_dis = 'checked';
							break;
						case '++':
							$plus2_dis = 'checked';
							break;
						case '+++':
							$plus3_dis = 'checked';
							break;
					}
				
				echo "<label style='margin-left: 50px; margin-right: 53px;'>Ketones:</label>
					<input style='margin-left: 50px;'  type='radio' id='ketones_neg' name='urinalysis_ketones' value='neg' $neg_dis />neg
					<input type='radio' id='ketones_plus_neg' name='urinalysis_ketones' value='+-' $plus_neg_dis />+-
					<input type='radio' id='ketones_plus' name='urinalysis_ketones' value='+' $plus_dis />+
					<input type='radio' id='ketones_plus2' name='urinalysis_ketones' value='++' $plus2_dis />++
					<input type='radio' id='ketones_plus3' name='urinalysis_ketones' value='+++' $plus3_dis />+++
					
					<br>";
				
				
				// find out which specific gravity radio button should be checked
				switch ($urinalysis_specific_gravity) {
						case '1.000':
							$specific_gravity_1000_dis = 'checked';
							break;
						case '1.005':
							$specific_gravity_1005_dis = 'checked';
							break;
						case '1.010':
							$specific_gravity_1010_dis = 'checked';
							break;
						case '1.015':
							$specific_gravity_1015_dis = 'checked';
							break;
						case '1.020':
							$specific_gravity_1020_dis = 'checked';
							break;
						case '1.025':
							$specific_gravity_1025_dis = 'checked';
							break;
						case '1.030':
							$specific_gravity_1030_dis = 'checked';
							break;
					}
				
				echo "<label style='margin-left: 50px;'>Specific Gravity:</label>
					<input style='margin-left: 50px;' type='radio' id='specific_gravity_1.000' name='specific_gravity' value='1.000' $specific_gravity_1000_dis />1.000
					<input type='radio' id='specific_gravity_1.005' name='urinalysis_specific_gravity' value='1.005' $specific_gravity_1005_dis />1.005
					<input type='radio' id='specific_gravity_1.010' name='urinalysis_specific_gravity' value='1.010' $specific_gravity_1010_dis />1.010
					<input type='radio' id='specific_gravity_1.015' name='urinalysis_specific_gravity' value='1.015' $specific_gravity_1015_dis />1.015
					<input type='radio' id='specific_gravity_1.020' name='urinalysis_specific_gravity' value='1.020' $specific_gravity_1020_dis />1.020
					<input type='radio' id='specific_gravity_1.025' name='urinalysis_specific_gravity' value='1.025' $specific_gravity_1025_dis />1.025
					<input type='radio' id='specific_gravity_1.030' name='urinalysis_specific_gravity' value='1.030' $specific_gravity_1030_dis />1.030 (Norm 1.006 – 1.016mg/dL)
					
					<br>";
				
				
					// clear all values to prevent the test from using previous result
					$neg_dis = '';
					$plus_dis = '';
					$plus2_dis = '';
					$plus3_dis = '';
					
					// find out which blood radio button should be checked
					switch ($urinalysis_blood) {
						case 'neg':
							$neg_dis = 'checked';
							break;
						case '+':
							$plus_dis = 'checked';
							break;
						case '++':
							$plus2_dis = 'checked';
							break;
						case '+++':
							$plus3_dis = 'checked';
							break;
						case 'non_hemolysis':
							$non_hemolysis_dis = 'checked';
							break;
					}
				
				echo "<label style='margin-left: 50px; margin-right: 70px;'>Blood:</label>
					<input style='margin-left: 50px;'  type='radio' id='blood_neg' name='urinalysis_blood' value='neg' $neg_dis />neg
					<input type='radio' id='blood_+' name='urinalysis_blood' value='+' $plus_dis />+
					<input type='radio' id='blood_++' name='urinalysis_blood' value='++' $plus2_dis />++
					<input type='radio' id='blood_+++' name='urinalysis_blood' value='+++' $plus3_dis />+++
					<input type='radio' id='blood_non-hemolysis' name='urinalysis_blood' value='non_hemolysis' $non_hemolysis_dis />non-hemolysis
						
					<br>";
				
				
				// find out which ph radio button should be checked
				switch ($urinalysis_ph) {
						case '5':
							$ph5_dis = 'checked';
							break;
						case '6':
							$ph6_dis = 'checked';
							break;
						case '6.5':
							$ph65_dis = 'checked';
							break;
						case '7':
							$ph7_dis = 'checked';
							break;
						case '8':
							$ph8_dis = 'checked';
							break;
						case '9':
							$ph9_dis = 'checked';
							break;
					}
			
				echo "<label style='margin-left: 50px; margin-right: 90px;'>pH:</label>
					<input style='margin-left: 50px;'  type='radio' id='ph5' name='urinalysis_ph' value='ph5' $ph5_dis />ph5
					<input type='radio' id='ph6' name='urinalysis_ph' value='6' $ph6_dis />ph6
					<input type='radio' id='ph6.5' name='urinalysis_ph' value='6.5' $ph65_dis />ph6.5
					<input type='radio' id='ph7' name='urinalysis_ph' value='7' $ph7_dis />ph7
					<input type='radio' id='ph8' name='urinalysis_ph' value='8' $ph8_dis />ph8
					<input type='radio' id='ph9' name='urinalysis_ph' value='9' $ph9_dis />ph9 (Norm 6 -7)
						
					<br>";
				
				
					// clear all values to prevent the test from using previous result
					$neg_dis = '';
					$plus_dis = '';
					$plus2_dis = '';
					$plus3_dis = '';
					$plus4_dis = '';
					
					// find out which protein radio button should be checked
					switch ($urinalysis_protein) {
						case 'neg':
							$neg_dis = 'checked';
							break;
						case 'trace':
							$trace_dis = 'checked';
							break;
						case '+':
							$plus_dis = 'checked';
							break;
						case '++':
							$plus2_dis = 'checked';
							break;
						case '+++':
							$plus3_dis = 'checked';
							break;
						case '++++':
							$plus4_dis = 'checked';
							break;
					}
				
				echo "<label style='margin-left: 50px; margin-right: 60px;'>Protein:</label>
					<input style='margin-left: 50px;'  type='radio' id='protein_neg' name='urinalysis_protein' value='neg' $neg_dis />neg
					<input type='radio' id='protein_trace' name='urinalysis_protein' value='trace' $trace_dis />trace
					<input type='radio' id='protein_+' name='urinalysis_protein' value='+' $plus_dis />+
					<input type='radio' id='protein_++' name='urinalysis_protein' value='++' $plus2_dis />++
					<input type='radio' id='protein_+++' name='urinalysis_protein' value='+++' $plus3_dis />+++
					<input type='radio' id='protein_++++' name='urinalysis_protein' value='++++' $plus4_dis />++++
						
					<br>";
				
				
					// clear all values to prevent the test from using previous result
					$neg_dis = '';
					$trace_dis = '';
					$pos_dis = '';
					
					// find out which protein radio button should be checked
					switch ($urinalysis_nitrite) {
						case 'neg':
							$neg_dis = 'checked';
							break;
						case 'trace':
							$trace_dis = 'checked';
							break;
						case 'pos':
							$pos_dis = 'checked';
							break;
					}
				
					echo "<label style='margin-left: 50px; margin-right: 70px;'>Nitrite:</label>
						<input style='margin-left: 50px;'  type='radio' id='nitrite_neg' name='urinalysis_nitrite' value='neg' $neg_dis />neg
						<input type='radio' id='nitrite_trace' name='urinalysis_nitrite' value='trace' $trace_dis />trace
						<input type='radio' id='nitrite_pos' name='urinalysis_nitrite' value='pos' $pos_dis />pos
							
						<br>";
					
					
					// clear all values to prevent the test from using previous result
					$neg_dis = '';
					$plus_dis = '';
					$plus2_dis = '';
					$plus3_dis = '';
					
					// find out which leukocytes radio button should be checked
					switch ($urinalysis_leukocytes) {
						case 'neg':
							$neg_dis = 'checked';
							break;
						case '+':
							$plus_dis = 'checked';
							break;
						case '++':
							$plus2_dis = 'checked';
							break;
						case '+++':
							$plus3_dis = 'checked';
							break;
					}
				
					echo "<label style='margin-left: 50px; margin-right: 30px;'>Leukocytes:</label>
						<input style='margin-left: 50px;'  type='radio' id='leukocytes_neg' name='urinalysis_leukocytes' value='neg' $neg_dis />neg
						<input type='radio' id='leukocytes_+' name='urinalysis_leukocytes' value='+' $plus_dis />+
						<input type='radio' id='leukocytes_++' name='urinalysis_leukocytes' value='++' $plus2_dis />++
						<input type='radio' id='leukocytes_+++' name='urinalysis_leukocytes' value='+++' $plus3_dis />+++
							
						<br>
							
						<label style='margin-left: 50px; margin-right: 31px;'>Microscopy: </label><input type='text' id='microscopy' name='urinalysis_microscopy' style='width: 200px; height: 30px;' value='$urinalysis_microscopy' maxlength='45' /> 
						<br><br>";
			}
			// if no urinalysis test was done, disable all urinalysis radio buttions
			else {
			
				echo "<input type='checkbox' name='urinalysis' onchange='toggle_disabled_urinalysis(this.checked)'/><b>Urinalysis</b><br>
			
					<label style='margin-left: 50px; margin-right: 22px;'>Urobilinogen:</label>
					<input style='margin-left: 50px;'  type='radio' id='urobilinogen_neg' name='urinalysis_urobilinogen' value='neg' disabled />neg
					<input type='radio' id='urobilinogen_plus_neg' name='urinalysis_urobilinogen' value='+-' disabled />+-
					<input type='radio' id='urobilinogen_plus' name='urinalysis_urobilinogen' value='+' disabled />+
					<input type='radio' id='urobilinogen_plus2' name='urinalysis_urobilinogen' value='++' disabled />++
					<input type='radio' id='urobilinogen_plus3' name='urinalysis_urobilinogen' value='+++' disabled />+++
					
					<br>
					
					<label style='margin-left: 50px; margin-right: 53px;'>Glucose:</label>
					<input style='margin-left: 50px;'  type='radio' id='glucose_neg' name='urinalysis_glucose' value='neg' disabled />neg
					<input type='radio' id='glucose_plus_neg' name='glucose' value='+-' disabled />+-
					<input type='radio' id='glucose_plus' name='urinalysis_glucose' value='+' disabled />+
					<input type='radio' id='glucose_plus2' name='urinalysis_glucose' value='++' disabled />++
					<input type='radio' id='glucose_plus3' name='urinalysis_glucose' value='+++' disabled />+++
					
					<br>
					
					<label style='margin-left: 50px; margin-right: 55px;'>Bilirubin:</label>
					<input style='margin-left: 50px;'  type='radio' id='bilirubin_neg' name='urinalysis_bilirubin' value='neg' disabled />neg
					<input type='radio' id='bilirubin_plus_neg' name='urinalysis_bilirubin' value='+-' disabled />+-
					<input type='radio' id='bilirubin_plus2' name='urinalysis_bilirubin' value='++' disabled />++
					<input type='radio' id='bilirubin_plus3' name='urinalysis_bilirubin' value='+++' disabled />+++
					
					<br>
					
					<label style='margin-left: 50px; margin-right: 53px;'>Ketones:</label>
					<input style='margin-left: 50px;'  type='radio' id='ketones_neg' name='urinalysis_ketones' value='neg' disabled />neg
					<input type='radio' id='ketones_plus_neg' name='urinalysis_ketones' value='+-' disabled />+-
					<input type='radio' id='ketones_plus' name='urinalysis_ketones' value='+' disabled />+
					<input type='radio' id='ketones_plus2' name='urinalysis_ketones' value='++' disabled />++
					<input type='radio' id='ketones_plus3' name='urinalysis_ketones' value='+++' disabled />+++
					
					<br>
					
					<label style='margin-left: 50px;'>Specific Gravity:</label>
					<input style='margin-left: 50px;' type='radio' id='specific_gravity_1.000' name='specific_gravity' value='1.000' disabled />1.000
					<input type='radio' id='specific_gravity_1.005' name='urinalysis_specific_gravity' value='1.005' disabled />1.005
					<input type='radio' id='specific_gravity_1.010' name='urinalysis_specific_gravity' value='1.010' disabled />1.010
					<input type='radio' id='specific_gravity_1.015' name='urinalysis_specific_gravity' value='1.015' disabled />1.015
					<input type='radio' id='specific_gravity_1.020' name='urinalysis_specific_gravity' value='1.020' disabled />1.020
					<input type='radio' id='specific_gravity_1.025' name='urinalysis_specific_gravity' value='1.025' disabled />1.025
					<input type='radio' id='specific_gravity_1.030' name='urinalysis_specific_gravity' value='1.030' disabled />1.030 (Norm 1.006 – 1.016mg/dL)
					
					<br>
					
					<label style='margin-left: 50px; margin-right: 70px;'>Blood:</label>
					<input style='margin-left: 50px;'  type='radio' id='blood_neg' name='urinalysis_blood' value='neg' disabled />neg
					<input type='radio' id='blood_+' name='urinalysis_blood' value='+' disabled />+
					<input type='radio' id='blood_++' name='urinalysis_blood' value='++' disabled />++
					<input type='radio' id='blood_+++' name='urinalysis_blood' value='+++' disabled />+++
					<input type='radio' id='blood_non-hemolysis' name='urinalysis_blood' value='non_hemolysis' disabled />non-hemolysis
					
					<br>
					
					<label style='margin-left: 50px; margin-right: 90px;'>pH:</label>
					<input style='margin-left: 50px;'  type='radio' id='ph5' name='urinalysis_ph' value='5' disabled />ph5
					<input type='radio' id='ph6' name='urinalysis_ph' value='6' disabled />ph6
					<input type='radio' id='ph6.5' name='urinalysis_ph' value='6.5' disabled />ph6.5
					<input type='radio' id='ph7' name='urinalysis_ph' value='7' disabled />ph7
					<input type='radio' id='ph8' name='urinalysis_ph' value='8' disabled />ph8
					<input type='radio' id='ph9' name='urinalysis_ph' value='9' disabled />ph9 (Norm 6 -7)
					
					<br>
					
					<label style='margin-left: 50px; margin-right: 60px;'>Protein:</label>
					<input style='margin-left: 50px;'  type='radio' id='protein_neg' name='urinalysis_protein' value='neg' disabled />neg
					<input type='radio' id='protein_trace' name='urinalysis_protein' value='trace' disabled />trace
					<input type='radio' id='protein_+' name='urinalysis_protein' value='+' disabled />+
					<input type='radio' id='protein_++' name='urinalysis_protein' value='++' disabled />++
					<input type='radio' id='protein_+++' name='urinalysis_protein' value='+++' disabled />+++
					<input type='radio' id='protein_++++' name='urinalysis_protein' value='++++' disabled />++++
					
					<br>
					
					<label style='margin-left: 50px; margin-right: 70px;'>Nitrite:</label>
					<input style='margin-left: 50px;'  type='radio' id='nitrite_neg' name='urinalysis_nitrite' value='neg' disabled />neg
					<input type='radio' id='nitrite_trace' name='urinalysis_nitrite' value='trace' disabled />trace
					<input type='radio' id='nitrite_pos' name='urinalysis_nitrite' value='pos' disabled />pos
					
					<br>
					
					<label style='margin-left: 50px; margin-right: 30px;'>Leukocytes:</label>
					<input style='margin-left: 50px;'  type='radio' id='leukocytes_neg' name='urinalysis_leukocytes' value='neg' disabled />neg
					<input type='radio' id='leukocytes_+' name='urinalysis_leukocytes' value='+' disabled />+
					<input type='radio' id='leukocytes_++' name='urinalysis_leukocytes' value='++' disabled />++
					<input type='radio' id='leukocytes_+++' name='urinalysis_leukocytes' value='+++' disabled />+++
					
					<br>
					
					<label style='margin-left: 50px; margin-right: 31px;'>Microscopy: </label><input type='text' id='microscopy' name='microscopy' style='width: 200px; height: 30px;' maxlength='45' disabled /> 
					
					<br><br>";
			
			}


			// get pregnancy test
			$stmt = $conn->prepare("SELECT pregnancy_test FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$pregnancy_test_check = $_SESSION['temp'];
			
			
			// get pregnancy test results
			$stmt = $conn->prepare("SELECT pregnancy_test_results FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$pregnancy_test_results = $_SESSION['temp'];
			
			
			
			// if there was a pregnancy test
			If ($pregnancy_test_check == 'yes') {
				$pregnancy_test_check = 'checked';
				
				// see which hcg detected radio button should be checked
				switch ($pregnancy_test_results) {
						case 'hcg_detected':
							$hcg_detected_dis = 'checked';
							break;
						case 'no_hcg_detected':
							$no_hcg_detected_dis = 'checked';
							break;
					}
				
				echo "<input type='checkbox' name='pregnancy_test' onchange='toggle_disabled_pregnancy(this.checked)' $pregnancy_test_check/> <b>Pregnancy Test:</b>
					<input type='radio' id='hcg_detected' name='pregnancy_test_results' value='hcg_detected' $hcg_detected_dis/>hcG detected
					<input type='radio' id='no_hcg_detected' name='pregnancy_test_results' value='no_hcg_detected' $no_hcg_detected_dis />no hcG detected
			
					<br><br>";
			
			}
			// if there was not a pegnancy test
			else {
			
				echo "<input type='checkbox' name='pregnancy_test' onchange='toggle_disabled_pregnancy(this.checked)'/> <b>Pregnancy Test:</b>
					<input type='radio' id='hcg_detected' name='pregnancy_test_results' value='hcg_detected' disabled />hcG detected
					<input type='radio' id='no_hcg_detected' name='pregnancy_test_results' value='no_hcg_detected' disabled />no hcG detected
			
					<br><br>";
					
			}




			
			
			// get hvs
			$stmt = $conn->prepare("SELECT hvs FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$hvs_checked = $_SESSION['temp'];
			
			
			// get macrosopy results
			$stmt = $conn->prepare("SELECT hvs_macroscopy FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$hvs_macroscopy = $_SESSION['temp'];
			
			
			// get microscopy results
			$stmt = $conn->prepare("SELECT hvs_microscopy FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$hvs_microscopy = $_SESSION['temp'];
			
			
			// get gram stain results
			$stmt = $conn->prepare("SELECT hvs_gram_stain FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$hvs_gram_stain = $_SESSION['temp'];
			
			
			// get clinician results
			$stmt = $conn->prepare("SELECT clinician FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$clinician = $_SESSION['temp'];
			


			$stmt = $conn->prepare("SELECT culture FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$culture = $_SESSION['temp'];
		
		
			// see if an hvs test was done
			if ($hvs_checked == 'yes') {
			
				$hvs_checked = 'checked';	
				
				echo "<input type='checkbox' name='hvs' onchange='toggle_disabled_hvs(this.checked)' $hvs_checked /> <b>HVS</b><br>
					Macroscopy:<input type='text' id='macroscopy' name='hvs_macroscopy' style='width: 500px; height: 30px;' value='$hvs_macroscopy' maxlength='45' /><br>
					Microscopy:<input type='text' id='microscopy_hvs' name='hvs_microscopy' style='width: 500px; height: 30px;' value='$hvs_microscopy' maxlength='45' /> <br>
					Gram Stain: <br> <textarea rows='6' cols='55' id='gram_stain' name='hvs_gram_stain' class='comment_area' maxlength='255'  >$hvs_gram_stain</textarea> <br> <br>
Cultures: <br> <textarea rows='6' cols='55' id='culture' name='culture' class='comment_area' maxlength='255'>$culture</textarea> <br> <br>";

			}
			else {
			
				echo "<input type='checkbox' name='hvs' onchange='toggle_disabled_hvs(this.checked)'/> <b>HVS</b><br>
					Macroscopy:<input type='text' id='macroscopy' name='hvs_macroscopy' style='width: 500px; height: 30px;' maxlength='45' disabled /><br>
					Microscopy:<input type='text' id='microscopy_hvs' name='hvs_microscopy' style='width: 500px; height: 30px;' maxlength='45' disabled /> <br>
					Gram Stain: <br> <textarea rows='6' cols='55' id='gram_stain' name='hvs_gram_stain' class='comment_area' maxlength='255' disabled ></textarea> <br> <br>
Cultures: <br> <textarea rows='6' cols='55' id='culture' name='culture' class='comment_area' maxlength='255' disabled></textarea> <br> <br>";
				
			}









			




			// get blood group 
			$stmt = $conn->prepare("SELECT blood_group FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$blood_group_check = $_SESSION['temp'];
			
			
			// get blood group rh
			$stmt = $conn->prepare("SELECT blood_group_rh FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$blood_group_rh = $_SESSION['temp'];
			
			
			// get blood group type
			$stmt = $conn->prepare("SELECT blood_group_type FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$blood_group_type = $_SESSION['temp'];
			
			
			// get blood group du test
			$stmt = $conn->prepare("SELECT du_test FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$du_test = $_SESSION['temp'];
			
			
			// see if blood group test was done
			if ($blood_group_check == 'yes') {
				$blood_group_check = 'checked';
				
				// find out if either + or - should be checked
				switch ($blood_group_rh) {
						case 'rh+ve':
							$rh_plus_dis = 'checked';
							break;
						case 'rh-ve':
							$rh_neg_dis = 'checked';
							break;
				}
				
				// determine which blood type radio button should be checked
				switch ($blood_group_type) {
						case 'a':
							$blood_type_dis_a = 'checked';
							break;
						case 'b':
							$blood_type_dis_b = 'checked';
							break;
						case 'o':
							$blood_type_dis_o = 'checked';
							break;
						case 'ab':
							$blood_type_dis_ab = 'checked';
							break;
				}
				
				
				echo "<input type='checkbox' name='blood_group' onchange='toggle_disabled_blood_group(this.checked)' $blood_group_check /><b>Blood Group</b><br>
				
				<input style='margin-left: 50px;' type='radio' id='rhve_neg' name='blood_group_rh' value='rh-ve' $rh_neg_dis />Rh-ve
				<input type='radio' id='rhve_plus' name='blood_group_rh' value='rh+ve' $rh_plus_dis />Rh+ve
				
				<input type='radio' id='a' name='blood_group_type' value='a' $blood_type_dis_a />A
				<input type='radio' id='b' name='blood_group_type' value='b' $blood_type_dis_b />B
				<input type='radio' id='o' name='blood_group_type' value='o' $blood_type_dis_o />O
				<input type='radio' id='ab' name='blood_group_type' value='ab' $blood_type_dis_ab />AB <br>
				
				<label style='margin-left: 50px;'>DU Test:</label><input  type='text' id='du_test' name='du_test' style='width: 200px; height: 30px;' value='$du_test' maxlength='45' /><br><br>";
			}
			// if no blood group test was done, then disable all radio buttons
			else {
				echo "<input type='checkbox' name='blood_group' onchange='toggle_disabled_blood_group(this.checked)'/><b>Blood Group</b><br>

				
				<input style='margin-left: 50px;' type='radio' id='rhve_neg' name='blood_group_rh' value='rh-ve' disabled />Rh-ve
				<input type='radio' id='rhve_plus' name='blood_group_rh' value='rh+ve' disabled />Rh+ve
				
				<input type='radio' id='a' name='blood_group_type' value='a' disabled />A
				<input type='radio' id='b' name='blood_group_type' value='b' disabled />B
				<input type='radio' id='o' name='blood_group_type' value='o' disabled />O
				<input type='radio' id='ab' name='blood_group_type' value='ab' disabled />AB <br>
				
				<label style='margin-left: 50px;'>DU Test:</label><input  type='text' id='du_test' name='du_test' style='width: 200px; height: 30px;' maxlength='45' disabled /><br><br>";
			}





			$stmt = $conn->prepare("SELECT blood_count FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$blood_count = $_SESSION['temp'];
			
			
			// get blood group du test
			$stmt = $conn->prepare("SELECT rbc FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$rbc = $_SESSION['temp'];


			if ($blood_count == 'yes') {

				echo "<input type='checkbox' name='blood_count' onchange='toggle_disabled_blood_count(this.checked)'/ checked><b>Blood Count</b><br>
			
				<label style='margin-left: 50px; margin-right: 22px;'>RBC:</label>
				<input type='text' id='rbc' name='rbc' style='width: 200px; height: 30px;' maxlength='30' value='$rbc'/> (Norm Men:4.3-5.7 trillion Cells, Norm Women:3.9-5.0 trillion Cells)
			
			<br>";
			}
			else {
				
				echo "<input type='checkbox' name='blood_count' onchange='toggle_disabled_blood_count(this.checked)'/><b>Blood Count</b><br>
			
				<label style='margin-left: 50px; margin-right: 22px;'>RBC:</label>
				<input type='text' id='rbc' name='rbc' style='width: 200px; height: 30px;' maxlength='30' disabled /> (Norm Men:4.3-5.7 trillion Cells, Norm Women:3.9-5.0 trillion Cells)
			
			<br>";


			}


			$stmt = $conn->prepare("SELECT hb_results FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$hb_results = $_SESSION['temp'];




			echo "<b>Hb:</b>
			<input type='text' id='hb_text' name='hb_results' style='width: 200px; height: 30px;' maxlength='30'  value='$hb_results'/> (Norm Men: 13.5 â€“ 18g/dL, Norm Women: 11.5 â€“ 16g/dL)
			
			<br>";




			$stmt = $conn->prepare("SELECT hct_text FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$hct_text = $_SESSION['temp'];

			echo "<b>Hct:</b>
			<input type='text' id='hct_text' name='hct_text' style='width: 200px; height: 30px;' value='$hct_text' maxlength='30'  />
			
			<br>";


			$stmt = $conn->prepare("SELECT mcv_text FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$mcv_text = $_SESSION['temp'];


			
			echo "<b>MCV:</b>
			<input type='text' id='mcv_text' name='mcv_text' style='width: 200px; height: 30px;' maxlength='30' value='$mcv_text' /> (Norm: 81.2-98.3 fL)
			
			<br>";





			$stmt = $conn->prepare("SELECT rdw_text FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$rdw_text = $_SESSION['temp'];


			

			echo "<b>RDW:</b>
			<input type='text' id='rdw_text' name='rdw_text' style='width: 200px; height: 30px;' maxlength='30' value='$rdw_text' /> (Norm: 11.8%-15.5%)
			
			<br>";




			$stmt = $conn->prepare("SELECT wbc_text FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$wbc_text = $_SESSION['temp'];


			echo "<b>WBC:</b>
			<input type='text' id='wbc_text' name='wbc_text' style='width: 200px; height: 30px;' maxlength='30' value='$wbc_text' /> (Norm: 3.5-10.5 billion cells/L)
			
			<br>";

			

			$stmt = $conn->prepare("SELECT platelet_text FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$platelet_text = $_SESSION['temp'];

			echo "<b>Platelet:</b>
			<input type='text' id='platelet_text' name='platelet_text' style='width: 200px; height: 30px;' maxlength='30' value='$platelet_text' /> (Norm: 150-450 billion/L)
			
			
			<br>";




			$stmt = $conn->prepare("SELECT neutrophils_text FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$neutrophils_text = $_SESSION['temp'];


			echo "<b>Neutrophils:</b>
			<input type='text' id='neutrophils_text' name='neutrophils_text' style='width: 200px; height: 30px;' maxlength='30' value='$neutrophils_text' /> ( Norm: 1.7-7.0x10(9)/L )
			<br>";



			$stmt = $conn->prepare("SELECT lymphocytes_text FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$lymphocytes_text = $_SESSION['temp'];


			echo "<b>Lymphocytes:</b>
			<input type='text' id='lymphocytes_text' name='lymphocytes_text' style='width: 200px; height: 30px;' maxlength='30' value='$lymphocytes_text' /> ( Norm: 0.9-2.9x10(9)/L )
			
			<br>";


			$stmt = $conn->prepare("SELECT monocytes_text FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$monocytes_text = $_SESSION['temp'];


			echo "<b>Monocytes:</b>
			<input type='text' id='monocytes_text' name='monocytes_text' style='width: 200px; height: 30px;' value='$monocytes_text' maxlength='30' /> ( Norm: 0.3-0.9x10(9)/L )
			
			<br>";



			$stmt = $conn->prepare("SELECT eosinophils_text FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$eosinophils_text = $_SESSION['temp'];

			echo "<b>Eosinophils:</b>
			<input type='text' id='eosinophils_text' name='eosinophils_text' style='width: 200px; height: 30px;' maxlength='30' value='$eosinophils_text' /> ( Norm: 0.05-0.50x10(9)/L )
			
			<br>";




			$stmt = $conn->prepare("SELECT basophils_text FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$basophils_text = $_SESSION['temp'];


			echo "<b>Basophils:</b>
			<input type='text' id='basophils_text' name='basophils_text' style='width: 200px; height: 30px;' value='$basophils_text' maxlength='30' /> ( Norm: 0-0.30x10(9)/L )
			
			<br>";


			$stmt = $conn->prepare("SELECT blood_chemistry FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$blood_chemistry = $_SESSION['temp'];


			$stmt = $conn->prepare("SELECT sodium_text FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$sodium_text = $_SESSION['temp'];



			if ($blood_chemistry == 'yes') {
				echo "<input type='checkbox' name='blood_chemistry' onchange='toggle_disabled_blood_chemistry(this.checked)' checked/><b>Blood Chemistry</b><br>
			
					<label style='margin-left: 50px; margin-right: 22px;'>Sodium:</label>
					<input type='text' id='sodium_text' name='sodium_text' style='width: 200px; height: 30px;' maxlength='30' value='$sodium_text'/> (Norm: 135-145 mmol/L)
			
					<br>";

			}
			else {
				echo "<input type='checkbox' name='blood_chemistry' onchange='toggle_disabled_blood_chemistry(this.checked)'/><b>Blood Chemistry</b><br>
			
					<label style='margin-left: 50px; margin-right: 22px;'>Sodium:</label>
					<input type='text' id='sodium_text' name='sodium_text' style='width: 200px; height: 30px;' maxlength='30' disabled/> (Norm: 135-145 mmol/L)
			
					<br>";

			}


			$stmt = $conn->prepare("SELECT chloride_text FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$chloride_text = $_SESSION['temp'];

			echo "<b>Chloride:</b>
			<input type='text' id='chloride' name='chloride_text' style='width: 200px; height: 30px;' value='$chloride_text' maxlength='30' /> (Norm: 98-107 mmol/L)
			
			<br>";


			$stmt = $conn->prepare("SELECT potassium_text FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$potassium_text = $_SESSION['temp'];
			

			echo "<b>Potassium:</b>
			<input type='text' id='potassium_text' name='potassium_text' style='width: 200px; height: 30px;' value='$potassium_text' maxlength='30' /> (Norm: 3.6-5.2 mmol/L)
			
			<br>";

			
			$stmt = $conn->prepare("SELECT calcium_text FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$calcium_text = $_SESSION['temp'];


			echo "<b>Calcium:</b>
			<input type='text' id='calcium_text' name='calcium_text' style='width: 200px; height: 30px;' value='$calcium_text' maxlength='30' /> (Norm: 8.9-10.1 mg/dL)
			
			<br>";

			$stmt = $conn->prepare("SELECT bicarbonate_text FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$bicarbonate_text = $_SESSION['temp'];


			echo "<b>Bicarbonate:</b>
			<input type='text' id='bicarbonate_text' name='bicarbonate_text' value='$bicarbonate_text' style='width: 200px; height: 30px;' maxlength='30' /> (Norm: 22-29 mmol/L)
			
			<br>";


			$stmt = $conn->prepare("SELECT glucose_fasting_text FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$glucose_fasting_text = $_SESSION['temp'];


			echo "< <b>Glucose Fasting:</b>
			<input type='text' id='glucose_fasting_text' name='glucose_fasting_text' value='$glucose_fasting_text' style='width: 200px; height: 30px;' maxlength='30' /> 
			
			<br>";


			$stmt = $conn->prepare("SELECT random_text FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$random_text = $_SESSION['temp'];


			echo "<b>Glucose Random:</b>
			<input type='text' id='random_text' name='random_text' style='width: 200px; height: 30px;' value='$random_text' maxlength='30' />
			
			
			<br>";

			$stmt = $conn->prepare("SELECT bun_text FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$bun_text = $_SESSION['temp'];			
			

			echo "<b>BUN (Blood Urea Nitrogen): </b>
                        <input type='text' id='bun_text' name='bun_text' style='width: 200px; height: 30px;' value='$bun_text' maxlength='45' /> Male 8-24 mg/dL Female 6-21 mg/dL
			
			<br>";

			$stmt = $conn->prepare("SELECT creatinine_text FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$creatinine_text = $_SESSION['temp'];

			echo "<b>Creatinine: </b>
                        <input type='text' id='creatinine_text' name='creatinine_text' value='$creatinine_text' style='width: 200px; height: 30px;' maxlength='45' /> Male 0.8-1.3 mg/dL Female 0.6-1.1 mg/dL
			
			<br>";

			$stmt = $conn->prepare("SELECT hba1c_text FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$hba1c_text = $_SESSION['temp'];

			echo "<b>HbA1C:</b>
                        <input type='text' id='hba1c_text' name='hba1c_text' value='$hba1c_text' style='width: 200px; height: 30px;' maxlength='45' /> < 6.0 Normal, 6.0 â€“ 7.0 Pre-diabetes, >7.0 Diabetes

                        <br>";

			$stmt = $conn->prepare("SELECT arterial_blood FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$arterial_blood = $_SESSION['temp'];

			$stmt = $conn->prepare("SELECT pao2_text FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$pao2_text = $_SESSION['temp'];


			$stmt = $conn->prepare("SELECT paco2_text FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$paco2_text = $_SESSION['temp'];


			$stmt = $conn->prepare("SELECT blood_ph_text FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$blood_ph_text = $_SESSION['temp'];


			$stmt = $conn->prepare("SELECT sao2_text FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$sao2_text = $_SESSION['temp'];

			$stmt = $conn->prepare("SELECT hco3_text FROM lab WHERE lab_id='$choosen_lab'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$hco3_text = $_SESSION['temp'];



			echo "<input type='checkbox' name='arterial_blood' onchange='toggle_disabled_arterial_blood(this.checked)' {$lab_array['arterial_blood']}/><b>Arterial Blood Gas</b><br>
			
			<label style='margin-left: 50px; margin-right: 22px;'>PaO2:</label>
			<input type='text' id='pao2_text' name='pao2_text' style='width: 200px; height: 30px;' value='$pao2_text' maxlength='30'  /> (Norm: 75-100 mm Hg)
			
			<br>
			
			 <label style='margin-left: 50px; margin-right: 22px;'>PaCO2:</label>
			<input type='text' id='paco2_text' name='paco2_text' style='width: 200px; height: 30px;' value='$paco2_text' maxlength='30' /> (Norm: 98-107 mmol/L)
			
			<br>
			
			<label style='margin-left: 50px; margin-right: 22px;'>Arterial Blood pH:</label>
			<input type='text' id='blood_ph_text' name='blood_ph_text' style='width: 200px; height: 30px;' value='$blood_ph_text' maxlength='30' /> (Norm: 7.38-7.42)
			
			<br>
			
			<label style='margin-left: 50px; margin-right: 22px;'>SaO2:</label>
			<input type='text' id='sao2_text' name='sao2_text' style='width: 200px; height: 30px;' value='$sao2_text' maxlength='30'  /> (Norm: 94-100%)
			
			<br>
			
			 <label style='margin-left: 50px; margin-right: 22px;'>HCO3:</label>
			<input type='text' id='hco3_text' name='hco3_text' style='width: 200px; height: 30px;' value='$hco3_text' maxlength='30' /> (Norm: 22-28 mEq/L)
			
			<br>";


			


			
			







			echo "<input type='checkbox' name='liver' onchange='toggle_disabled_liver(this.checked)' {$lab_array['liver']}/><b>Liver Function Test</b><br>
			
			<label style='margin-left: 50px; margin-right: 22px;'>ALT:</label>
			<input type='text' id='alt_text' name='alt_text' style='width: 200px; height: 30px;' maxlength='30' value='{$lab_array['alt_text']}' /> (Norm: 7-55 U/L)
			
			<br>
			
			 <label style='margin-left: 50px; margin-right: 22px;'>AST:</label>
			<input type='text' id='ast_text' name='ast_text' style='width: 200px; height: 30px;' maxlength='30' value='{$lab_array['ast_text']}' /> (Norm: 8-48 U/L)
			
			<br>
			
			<label style='margin-left: 50px; margin-right: 22px;'>Albumin:</</label>
			<input type='text' id='albumin_text' name='albumin_text' style='width: 200px; height: 30px;' maxlength='30' value='{$lab_array['albumin_text']}' /> (Norm: 3.5-5.0 g/dL)
			
			<br>
			
			<input type='checkbox' name='prothrombin' onchange='toggle_disabled_prothrombin(this.checked)' {$lab_array['prothrombin']}/> <b>Prothrombin Time: </b>
            <input type='text' id='prothrombin_text' name='prothrombin_text' style='width: 200px; height: 30px;' maxlength='45' value='{$lab_array['prothrombin_text']}'  /> (Norm: 9.4-12.5 sec)

            <br>";



			echo "<input type='checkbox' name='inr' onchange='toggle_disabled_inr(this.checked)' {$lab_array['inr']}/> <b>INR: </b>
            <input type='text' id='inr_text' name='inr_text' style='width: 200px; height: 30px;' maxlength='45' value='{$lab_array['inr_text']}' /> (Norm: 0.9-1.1, Warfarin 2.0-3.0, High Intensity Warfarin 2.5-3.5)

            <br>
			
			
			
			 <input type='checkbox' name='tft' onchange='toggle_disabled_tft(this.checked)' {$lab_array['tft']}/><b>Thyroid Function Test</b><br>
			
			<label style='margin-left: 50px; margin-right: 22px;'>TSH:</label>
			<input type='text' id='tsh_text' name='tsh_text' style='width: 200px; height: 30px;' maxlength='30' value='{$lab_array['tsh_text']}' /> (Norm: 0.3-4.2)
			
			<br>
			
			 <label style='margin-left: 50px; margin-right: 22px;'>Free T3:</label>
			<input type='text' id='freet3_text' name='freet3_text' style='width: 200px; height: 30px;' maxlength='30' value='{$lab_array['freet3_text']}' /> (Norm: 2.8-4.4 pg/mL)
			
			<br>
			
		<label style='margin-left: 50px; margin-right: 22px;'>Free T4:</label>

			<input type='text' id='freet4_text' name='freet4_text' style='width: 200px; height: 30px;' maxlength='30' value='{$lab_array['freet4_text']}' /> (Norm: 0.9-1.7 ng/dL)
			
			<br>";



			echo "<input type='checkbox' name='tft' onchange='toggle_disabled_cholesterol(this.checked)' {$lab_array['cholesterol']}/><b>Cholesterol</b><br>
			
			<label style='margin-left: 50px; margin-right: 22px;'>Total:</label>
			<input type='text' id='total_text' name='total_text' style='width: 200px; height: 30px;' maxlength='30' value='{$lab_array['total_text']}' /> (Norm<200mg/dL, Brorderline 200-239 mg/dL, High>240 mg/dL )
			
			<br>
			
		        <label style='margin-left: 50px; margin-right: 22px;'>HDL:</label>

			<input type='text' id='hdl_text' name='hdl_text' style='width: 200px; height: 30px;' maxlength='30' value='{$lab_array['hdl_text']}' /> (Norm Male>40mg/dL, Female>50mg/dL)
			
			<br>
			
			<label style='margin-left: 50px; margin-right: 22px;'>LDL:</label>

			<input type='text' id='ldl_text' name='ldl_text' style='width: 200px; height: 30px;' maxlength='30' value='{$lab_array['ldl_text']}' /> (Norm <100mg/dL, Brorderline 130-159 mg/dL, High 160-189 mg/dL, Very High> 190)
			
			<br>
			
			
			<input type='checkbox' name='cardiac' onchange='toggle_disabled_cardiac(this.checked)' {$lab_array['cardiac']}/><b>Cardiac Enzymes</b><br>
			
			<label style='margin-left: 50px; margin-right: 22px;'>Troponin:</label>
			<input type='text' id='troponin_text' name='troponin_text' style='width: 200px; height: 30px;' maxlength='30' value='{$lab_array['troponin_text']}' /> (Norm <0.04 ng/mL )
			
			<br>
			
			<label style='margin-left: 50px; margin-right: 22px;'>CK:</label>

			<input type='text' id='ck_text' name='ck_text' style='width: 200px; height: 30px;' maxlength='30' value='{$lab_array['ck_text']}' /> (Norm Male 39-308 U/L, Female 26-192 U/L)
			
			<br>";

			






			
		
			


			




 
			
			echo "Clinician:<input list='clinician_list' name='clinician' value='$clinician' style='padding-left: 10px; margin-left: 10px;width: 140px; height: 20px;' maxlength='20'> <br>
			 
					 <datalist id='clinician_list'>";
							
								
									$stmt = $conn->prepare("SELECT username FROM accounts;");
									$stmt->execute();
									$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
								
									foreach(new display_clinicians(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
										echo $v;
									}
									
							
			echo "</datalist>";
			
		?>
			
			<div style="margin-left: 320px; width: 200px; margin-top: 50px; ">		
				<input type="submit" name="submit_button" class="submitbtn" value="Submit Lab Form">
			</div>
			
		</form>
		
		
	</div>
	
	
</div>
  
</body>
</html>

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
	<script src="/js/vital_signs_validation.js" type="text/javascript"> </script>
</head>

<body style="padding-top: 70px;">

  <!-- nav bar -->
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
        <form method="post" action="select_client_return_treatment_form.php">
            <input style="width: 300px;" type="submit" value="Client Selection">
        </form>
      </div>
	  
  </div>
  <br></br>
  
<!-- all cards on screen are in this div, this way everything is centered -->
<div style="width:970px; margin: 0 auto; ">
  
  <!-- begining of general info card -->
  <div class="accountCard" style="float: left; margin-right: 5px; height: 245px;" >
	<p class='p'style='color: black;font-weight:100; text-align: center;'>Client's General Info</p>
	
	
<?php
		
		require('../database_credentials.php');
		require('../date_functions.php');
		session_start();
		
		// make sure user is logged in
		login_check();
		
		$choosen_client_id = $_SESSION['choosen_client_id'];
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
		
		
		// create the database connection
		$conn = new PDO($dbconnection, $dbusername, $dbpassword);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		
		// grab the clients first name
		$stmt = $conn->prepare("SELECT first_name FROM general_info WHERE client_id='$choosen_client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$first_name = $_SESSION['temp'];
		
		
		// grab the clients last name
		$stmt = $conn->prepare("SELECT last_name FROM general_info WHERE client_id='$choosen_client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$last_name = $_SESSION['temp'];
		
		
		// grab the clients sex
		$stmt = $conn->prepare("SELECT sex FROM general_info WHERE client_id='$choosen_client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$sex = $_SESSION['temp'];
		
		
		// grab the clients location
		$stmt = $conn->prepare("SELECT location FROM general_info WHERE client_id='$choosen_client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$location = $_SESSION['temp'];
		
		
		// grab the clients date of birth
		$stmt = $conn->prepare("SELECT date_of_birth FROM general_info WHERE client_id='$choosen_client_id'");
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
	
		
			$_SESSION['temp'] = '';
			
			$stmt = $conn->prepare("SELECT t FROM return_treatment_temp WHERE created_by='$username';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$t = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT bp FROM return_treatment_temp WHERE created_by='$username';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$bp = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT pr FROM return_treatment_temp WHERE created_by='$username';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$pr = $_SESSION['temp'];
		
		
			$stmt = $conn->prepare("SELECT rr FROM return_treatment_temp WHERE created_by='$username';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
			}
			$rr = $_SESSION['temp'];
				
			$stmt = $conn->prepare("SELECT sao2 FROM return_treatment_temp WHERE created_by='$username';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$sao2 = $_SESSION['temp'];
				
				
				
			$stmt = $conn->prepare("SELECT COUNT(*) FROM return_treatment_temp WHERE created_by='$username';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$count = $_SESSION['temp'];
				
				
			// see if a temp record exists
			if ($count) {
				$stmt = $conn->prepare("SELECT pain FROM return_treatment_temp WHERE created_by='$username';");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$pain = $_SESSION['temp'];
					
				// find out how much pain the client was in
				switch ($pain) {
					case "none":
						$none_check = 'checked';
						break;
					case "mild":
						$mild_check = 'checked';
						break;
					case "moderate":
						$moderate_check = 'checked';
						break;
					case "severe":
						$severe_check = 'checked';
						break;
				}
			}
			// if no record exists, set pain to none
			else {
				$none_check = 'checked';
				$_SESSION['temp'] = '';
			
			}
		
			$stmt = $conn->prepare("SELECT notes FROM return_treatment_temp WHERE created_by='$username';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$notes = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT plan FROM return_treatment_temp WHERE created_by='$username';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$plan = $_SESSION['temp'];
		
		 
echo "</div>
  
  <!-- start of vital signs card -->
  <div class='accountCard' style='float: left; height: 245px;'>
	<p class='p'style='color: black;font-weight:100; text-align: center; padding-bottom: 50px;'>Vital Signs</p>
	
	<div style=' float: left;'>";
		
			echo 'T:' . '<br>' . '<br>';
			echo 'BP:' . '<br>' . '<br>';
			echo 'PR:' . '<br>' . '<br>';
		
	echo "</div>
	
	<form  name='vital_signs_form' action='insert_return_treatment_form_temp.php' onsubmit='return validate_form()' method='post'>
	
	<div style=' float: left; padding-left: 15px;'>
			<input type='text' name='t' value='$t' style='width: 100px; height: 30px;' maxlength='10' autofocus onfocus='this.value = this.value;'><br>
			<input type='text' name='bp' value='$bp' style='width: 100px; height: 30px;' maxlength='10'><br>
			<input type='number' name='pr' value='$pr' style='width: 100px; height: 30px;' min='0' max='9999999999'><br>
	</div>
	
	<div style=' float: left; padding-left: 15px;'>";
		
			echo 'RR' . '<br>' . '<br>';
			echo 'SaO<sub>2</sub>:' . '<br>' . '<br>';
			echo 'Pain:' . '<br>' . '<br>';
	
	echo "</div>
	
	<div style=' float: left; padding-left: 15px;'>
			<input type='text' name='rr' value='$rr' style='width: 100px; height: 30px; maxlength='10'><br>
			<input type='number' name='sao2' value='$sao2' style='width: 100px; height: 30px; min='0' max='9999999999'><br>
			
			<div style=' float: left;'>
				<input type='radio' name='pain' value='none' $none_check> none <br>
				<input type='radio' name='pain' value='mild' $mild_check> mild 
			</div>
						
			<div style=' float: left;'>
				<input type='radio' name='pain' value='moderate' $moderate_check> moderate <br>
				<input type='radio' name='pain' value='severe' $severe_check> severe
			</div>
	</div>
	
  </div>
  
  
   <!-- start of bottom card -->
    <div class='accountCard' style='float: left; width: 885px; height: 460px; position: relative;'>
	
		<div style=' float: left; margin-left: 260px; position: relative;'>
			
		
			<div style='position: absolute; top: 60px; '>
				Notes: <br> <textarea style='height: 100px; width: 400px;' name='notes' class='comment_area' maxlength='5000'>$notes</textarea><br><br>
			</div>
			
			<div style='position: absolute; top: 190px; '>
				Plan: <br> <textarea style='height: 100px; width: 400px;' name='plan' class='comment_area' maxlength='5000'>$plan</textarea><br><br>
			</div>
		</div>";
		
		
		
				 echo "<b style='text-align: center; position: absolute; top: 420px; left: 400px '>Clinician:</b><input list='clinician_list' name='clinician' value='$username' style='width: 140px; height: 20px; padding-left: 10px; position: absolute; top: 415px; left: 480px ' maxlength='20'> <br>
			 
					 <datalist id='clinician_list'>";
							
								
									$stmt = $conn->prepare('SELECT username FROM accounts;');
									$stmt->execute();
									$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
								
									foreach(new display_clinicians(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
										echo $v;
									}
									
							
					echo "</datalist>";  
			 
		
		
		echo "<div style='position: absolute; top: 460px; left: 450px;'>		
			<input type='submit' name='submit_button' class='submitbtn' value='Add Diagnoses'>
		</div>
		
	</div>
	
	</form>
	
 </div>
  
</body>
</html>";
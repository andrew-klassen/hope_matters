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

$choosen_client_id = $_SESSION['choosen_client_id'];

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
	
	
	// grab first name
    $stmt = $conn->prepare("SELECT first_name FROM general_info WHERE client_id='$choosen_client_id'");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
    foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
	}
	$first_name = $_SESSION['temp'];
	
	
	// grab last name
    $stmt = $conn->prepare("SELECT last_name FROM general_info WHERE client_id='$choosen_client_id'");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
    foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
	}
	$last_name = $_SESSION['temp'];
	
	
	// grab date of birth
	$stmt = $conn->prepare("SELECT date_of_birth FROM general_info WHERE client_id='$choosen_client_id'");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
    foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
	}
	$date_of_birth = $_SESSION['temp'];
	
	
	// grab guardian name
	$stmt = $conn->prepare("SELECT guardian_name FROM general_info WHERE client_id='$choosen_client_id'");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
    foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
	}
	$guardian_name = $_SESSION['temp'];
	
	
	// grab national id
	$stmt = $conn->prepare("SELECT national_id FROM general_info WHERE client_id='$choosen_client_id'");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
    foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
	}
	$national_id = $_SESSION['temp'];
	
	
	// grab phone number
	$stmt = $conn->prepare("SELECT phone_number FROM general_info WHERE client_id='$choosen_client_id'");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
    foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
	}
	$phone_number = $_SESSION['temp'];
	
	
	// grab occupation
	$stmt = $conn->prepare("SELECT occupation FROM general_info WHERE client_id='$choosen_client_id'");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
    foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
	}
	$occupation = $_SESSION['temp'];
	
	
	// grab education
	$stmt = $conn->prepare("SELECT education FROM general_info WHERE client_id='$choosen_client_id'");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
    foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
	}
	$education = $_SESSION['temp'];
	
	
	// grab location
	$stmt = $conn->prepare("SELECT location FROM general_info WHERE client_id='$choosen_client_id'");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
    foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
	}
	$location = $_SESSION['temp'];
	
	
	// grab emergency contact
	$stmt = $conn->prepare("SELECT emergency_contact FROM general_info WHERE client_id='$choosen_client_id'");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
    foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
	}
	$emergency_contact = $_SESSION['temp'];
	
	
	// grab allergies
	$stmt = $conn->prepare("SELECT allergies FROM general_info WHERE client_id='$choosen_client_id'");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
    foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
	}
	$allergies = $_SESSION['temp'];
	
	
	// grab hiv status
	$stmt = $conn->prepare("SELECT hiv_status FROM general_info WHERE client_id='$choosen_client_id'");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
    foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
	}
	$hiv_status = $_SESSION['temp'];
	
	
	// grab alcohol use
	$stmt = $conn->prepare("SELECT alcohol_use FROM general_info WHERE client_id='$choosen_client_id'");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
    foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
	}
	$alcohol_use = $_SESSION['temp'];
	

	// grab sex
	$stmt = $conn->prepare("SELECT sex FROM general_info WHERE client_id='$choosen_client_id'");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
    foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
	}
	$sex = $_SESSION['temp'];
	
	
	// grab medical history
	$stmt = $conn->prepare("SELECT medical_history FROM general_info WHERE client_id='$choosen_client_id'");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
    foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
	}
	$medical_history = $_SESSION['temp'];
	
	
	// grab regular medications
	$stmt = $conn->prepare("SELECT regular_medications FROM general_info WHERE client_id='$choosen_client_id'");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
    foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
	}
	$regular_medications = $_SESSION['temp'];
	
	
	
// begin echoing out the html
echo "<!DOCTYPE html>
	<html>

	<head>
	<title>Hope Matters</title>
	<link rel='icon' href='/images/hope_matters_logo.png'>
	<link rel='stylesheet' type='text/css' href='/css/navbar.css'>
	<link rel='stylesheet' type='text/css' href='/css/add_client.css'>
	<script src='/js/client_validation.js' type='text/javascript'> </script>
	</head>

	
	<body style='padding-top: 70px;'>

	  <div id='container'>
		   
		  <div id='sign-out'>
			<form method='post' action='/php/dashboard.php'>
				<input type='submit' value='Dashboard'>
			</form>
		  </div>
		  
		  <div id='sign-out'>
			<form method='post' action='/php/sign_out.php'>
				<input type='submit' value='Sign Out'>
			</form>
		  </div>
		  
		  <div style='float: left;  width: 300px;'>
			<form method='post' action='view_client.php'>
				<input style='width: 300px;' type='submit' value='Client Selection'>
			</form>
		  </div>
		  
	  </div>
	  <br></br>


  <div class='accountCard' style='width: 450px;'>
  
	<p class='p'style='color: black;font-weight:100;'>Please Update the Client's Information</p>
  
	<form  name='client_form' action='update_client.php' onsubmit='return validate_form()' method='post'>
			First Name:<input type='text' name='first_name' value='$first_name' maxlength='25'><br>
			Last Name:<input type='text' name='last_name' value='$last_name' maxlength='25'><br>
			
			Date of Birth:<input style='margin-top: 10px; margin-bottom: 10px;' type='date' name='date_of_birth' value='$date_of_birth'><br>
			
			Guardian Name:<input type='text' name='guardian_name' value='$guardian_name' maxlength='45'><br>
			National ID:<input type='number' name='national_id' value='$national_id' min='0' max='999999999999999999999999999999' ><br>
			Phone Number:<input type='text' name='phone_number' value='$phone_number' maxlength='20'><br>
			Occupation:<input type='text' name='occupation' value='$occupation' maxlength='45'><br>
			Education:<input type='text' name='education' value='$education' maxlength='45'><br>
			Location:<input type='text' name='location' value='$location' maxlength='45'><br>
			Emergency Contact:<input type='text' name='contact' value='$emergency_contact' maxlength='50'><br>
			Allergies:<input type='text' name='allergies' value='$allergies' maxlength='45'><br>";
			
			// determine which hiv status radio button should be checked
			if ($hiv_status == 'unknown') {
				echo "HIV status: <input type='radio' name='hiv_status' value='positive'> +
					<input type='radio' name='hiv_status' value='negitive'> -
					<input type='radio' name='hiv_status' value='unknown' checked> unknown <br>";
			}
			elseif ($hiv_status == 'positive') {
				echo "HIV status: <input type='radio' name='hiv_status' value='positive' checked> +
					<input type='radio' name='hiv_status' value='negitive'> -
					<input type='radio' name='hiv_status' value='unknown'> unknown <br>";
			}
			else {
				echo "HIV status: <input type='radio' name='hiv_status' value='positive'> +
					<input type='radio' name='hiv_status' value='negitive' checked> -
					<input type='radio' name='hiv_status' value='unknown'> unknown <br>";
			}
			
			// determine which alcohol use radio button should be checked
			if ($alcohol_use == 'never') {
				echo "Alcohol Use: <input type='radio' name='alcohol_use' value='never' checked> never
				<input type='radio' name='alcohol_use' value='sometimes'> sometimes
				<input type='radio' name='alcohol_use' value='often' > often 
				<input type='radio' name='alcohol_use' value='unknown'> unknown<br>";
			}
			elseif ($alcohol_use == 'sometimes') {
				echo "Alcohol Use: <input type='radio' name='alcohol_use' value='never'> never
				<input type='radio' name='alcohol_use' value='sometimes'checked> sometimes
				<input type='radio' name='alcohol_use' value='often' > often 
				<input type='radio' name='alcohol_use' value='unknown'> unknown<br>";
			}
			elseif ($alcohol_use == 'never') {
				echo "Alcohol Use: <input type='radio' name='alcohol_use' value='never'> never
				<input type='radio' name='alcohol_use' value='sometimes'> sometimes
				<input type='radio' name='alcohol_use' value='often' checked> often 
				<input type='radio' name='alcohol_use' value='unknown'> unknown<br>";
			}
			else {
				echo "Alcohol Use: <input type='radio' name='alcohol_use' value='never'> never
				<input type='radio' name='alcohol_use' value='sometimes'> sometimes
				<input type='radio' name='alcohol_use' value='often'> often 
				<input type='radio' name='alcohol_use' value='unknown' checked> unknown<br>";
			}
			
			
			// determine which sex radio button should be checked
			if ($sex == 'male') {
				echo "Gender: <input type='radio' name='gender' value='male' checked> Male
				<input type='radio' name='gender' value='female'> Female <br><br>";
			}
			else {
				echo "Gender: <input type='radio' name='gender' value='male'> Male
				<input type='radio' name='gender' value='female' checked> Female <br><br>";
			}
			
			
			echo "Significant Medical History: <br> <textarea rows='4' cols='50' name='medical_history' class='comment_area' maxlength='255'>$medical_history</textarea><br><br>
				Regular Medications or Herbs: <br> <textarea rows='4' cols='50' name='regular_medications' class='comment_area' maxlength='255'>$regular_medications</textarea><br>
				<br><br>
				<input type='submit' name='submit_button' class='submitbtn' value='Submit'>
		</form>
		<br><br>
		
  </div> 
</body>
</html>";
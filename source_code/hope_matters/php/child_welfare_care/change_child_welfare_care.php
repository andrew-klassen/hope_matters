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
	<script src="/js/child_welfare_care_change_validation.js" type="text/javascript"></script>
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
        <form method="post" action="select_child_welfare_care.php">
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
		
		$choosen_child_welfare_care = $_SESSION['choosen_child_welfare_care'];
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
		
		class view_clients extends RecursiveIteratorIterator {
    
			function __construct($it) {
				parent::__construct($it, self::LEAVES_ONLY);
			}
			
			// this function creates an invisible <a link> that passes the clients id to the next page
			function current() {
			
				$_SESSION['choosen_child_growth_id'] = parent::current();
				
				// since there are 6 fields being displayed in the table, $_SESSION['counter'] == 0 or $_SESSION['counter'] % 6 == 0
				if (($_SESSION['counter'] == 0) or ($_SESSION['counter'] % 6 == 0)) {
				
					$_SESSION['temp'] = $_SESSION['choosen_child_growth_id'];
					return '<span></span>';
					
				}
				$temp = $_SESSION['temp'];
				
				return "<td align='center' style='border-style: solid; border-color: #black; background-color: white; color: black; font-size: 30px;  '>" . "<a href='grab_child_growth.php? choosen_child_growth_id=$temp' style='color: black; font-size: 20px; text-decoration: none; opacity: 1;'>"  . parent::current() . "</a>" . "</td>";
		  
			}
			function beginChildren() {
				echo "<tr>";
			}
			function endChildren() {
				echo "</tr>" . "\n";
			}
		}
		
		
		// create database connection
		$conn = new PDO($dbconnection, $dbusername, $dbpassword);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		
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
		
		
		// get the client's age
		$age = get_age_from_date_of_birth($date_of_birth);
		
		$stmt = $conn->prepare("SELECT client_id FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$client_id = $_SESSION['temp'];
		
		
		// display the general info
		echo "<div style='width: 500px; height: 100px;'>";
		echo "<div style=' float: left;'>";
		echo '<b>Client ID:</b>' . "<br>" . "<br>";
		echo '<b>First Name:</b>' . "<br>" . "<br>";
		echo '<b>Last Name:</b>' . "<br>" . "<br>";
		echo "</div>";
		
		echo "<div style=' float: left;padding-left: 20px;'>";
		echo $client_id . "<br>" . "<br>";
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
	
	
		$stmt = $conn->prepare("SELECT child_particulars FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$child_particulars = $_SESSION['temp'];
	
	
		$stmt = $conn->prepare("SELECT child_name FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$child_name = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT child_gender FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$child_gender = $_SESSION['temp'];
		
		if ($child_gender == 'male') {
			$male_checked = 'checked';
		}
		else {
			$female_checked = 'checked';
		}
		
		$stmt = $conn->prepare("SELECT child_date_of_birth FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$child_date_of_birth = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT birth_weight FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$birth_weight = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT birth_length FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$birth_length = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT birth_characteristics FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$birth_characteristics = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT birth_order FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$birth_order = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT first_seen FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$first_seen = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT birth_place FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$birth_place = $_SESSION['temp'];
		
		switch ($birth_place) {
			case 'health_facility':
				$health_facility_checked = 'checked';
				break;
			case 'home':
				$home_checked = 'checked';
				break;
			case 'other':
				$other_checked = 'checked';
				break;
		}
		
		
		$stmt = $conn->prepare("SELECT other_birth_place FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$other_birth_place = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT notification_number FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$notification_number = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT notification_date FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$notification_date = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT register_number FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$register_number = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT child_welfare_clinic FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$child_welfare_clinic = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT health_facility FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$health_facility = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT master_facility_list_number FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$master_facility_list_number = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT birth_certificate_number FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$birth_certificate_number = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT registration_date FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$registration_date = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT registration_place FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$registration_place = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT abnormalities FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$abnormalities = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT father_name FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$father_name = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT father_phone_number FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$father_phone_number = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT mother_name FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$mother_name = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT mother_phone_number FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$mother_phone_number = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT guardian_name FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$guardian_name = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT guardian_phone_number FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$guardian_phone_number = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT country FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$country = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT district FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$district = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT division FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$division = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT child_location FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$child_location = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT town FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$town = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT village FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$village = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT post_address FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$post_address = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT age_first_contact FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$age_first_contact = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT weight FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$weight = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT height FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$height = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT physical_features FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$physical_features = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT colouration FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$colouration = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT head_circumference FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$head_circumference = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT eyes FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$eyes = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT mouth FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$mouth = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT chest FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$chest = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT heart FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$heart = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT abdomen FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$abdomen = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT umbilicus FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$umbilicus = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT spine FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$spine = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT arms_and_hands FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$arms_and_hands = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT legs_and_feet FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$legs_and_feet = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT genitalia FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$genitalia = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT anus FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$anus = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT breastfeeding FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$breastfeeding = $_SESSION['temp'];
		
		
		switch ($breastfeeding) {
			case 'well':
				$well_checked = 'checked';
				break;
			case 'poorly':
				$poorly_checked = 'checked';
				break;
			case 'unable':
				$unable_checked = 'checked';
				break;
		}
		
		
		$stmt = $conn->prepare("SELECT feeds FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$feeds = $_SESSION['temp'];
		
		
		if ($feeds == 'yes'){
			$feeds_yes_checked = 'checked';
		}
		else {
			$feeds_no_checked = 'checked';
		}
		
		
		$stmt = $conn->prepare("SELECT feeds_age FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$feeds_age = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT other_foods_introduced FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$other_foods_introduced = $_SESSION['temp'];
		
		
		if ($other_foods_introduced == 'yes'){
			$other_foods_introduced_yes_checked = 'checked';
		}
		else {
			$other_foods_introduced_no_checked = 'checked';
		}
		
		
		$stmt = $conn->prepare("SELECT indigestion FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$indigestion = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT sleep_cycle FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$sleep_cycle = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT irritability FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$irritability = $_SESSION['temp'];
		
		
		if ($irritability == 'yes'){
			$irritability_yes_checked = 'checked';
		}
		else {
			$irritability_no_checked = 'checked';
		}
		
		
		$stmt = $conn->prepare("SELECT finger_sucking FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$finger_sucking = $_SESSION['temp'];
		
		
		if ($finger_sucking == 'yes'){
			$finger_sucking_yes_checked = 'checked';
		}
		else {
			$finger_sucking_no_checked = 'checked';
		}
		
		
		$stmt = $conn->prepare("SELECT others FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$others = $_SESSION['temp'];
		
		
		if ($others == 'yes'){
			$others_yes_checked = 'checked';
		}
		else {
			$others_no_checked = 'checked';
		}
		
		
		$stmt = $conn->prepare("SELECT mis_05_given FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$mis_05_given = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT mis_05_next_visit FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$mis_05_next_visit = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT mis_1_given FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$mis_1_given = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT mis_1_next_visit FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$mis_1_next_visit = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT present_checked FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$present_checked = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT present_repeated FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$present_repeated = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT absent_checked FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$absent_checked = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT absent_repeated FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$absent_repeated = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT birth_dose_given FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$birth_dose_given = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT birth_does_next_visit FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$birth_does_next_visit = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT pollo_first_dose_given FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$pollo_first_dose_given = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT pollo_first_does_next_visit FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$pollo_first_does_next_visit = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT pollo_second_dose_given FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$pollo_second_dose_given = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT pollo_second_does_next_visit FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$pollo_second_does_next_visit = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT pollo_third_dose_given FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$pollo_third_dose_given = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT pollo_third_does_next_visit FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$pollo_third_does_next_visit = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT dphtheria_first_dose_given FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$dphtheria_first_dose_given = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT dphtheria_first_dose_next_visit FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$dphtheria_first_dose_next_visit = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT dphtheria_second_dose_given FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$dphtheria_second_dose_given = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT dphtheria_second_does_next_visit FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$dphtheria_second_does_next_visit = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT dphtheria_third_dose_given FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$dphtheria_third_dose_given = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT dphtheria_third_does_next_visit FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$dphtheria_third_does_next_visit = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT pneumococcal_first_dose_given FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$pneumococcal_first_dose_given = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT pneumococcal_first_does_next_visit FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$pneumococcal_first_does_next_visit = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT pneumococcal_second_dose_given FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$pneumococcal_second_dose_given = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT pneumococcal_second_does_next_visit FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$pneumococcal_second_does_next_visit = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT pneumococcal_third_dose_given FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$pneumococcal_third_dose_given = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT pneumococcal_third_does_next_visit FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$pneumococcal_third_does_next_visit = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT rota_first_dose_given FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$rota_first_dose_given = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT rota_first_does_next_visit FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$rota_first_does_next_visit = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT rota_second_dose_given FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$rota_second_dose_given = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT rota_second_does_next_visit FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$rota_second_does_next_visit = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT measles_6_months_date FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$measles_6_months_date = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT measles_9_months_date FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$measles_9_months_date = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT measles_18_months_date FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$measles_18_months_date = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT yellow_fever_date FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$yellow_fever_date = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT other_vaccine FROM child_welfare_care WHERE child_welfare_care_id='$choosen_child_welfare_care'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$other_vaccine = $_SESSION['temp'];
		
		
		
	
		
echo " </div>
  
	<!-- begining of lab tests card -->
    <div class='accountCard' style='float: left; width: 885px; height: 4820px; position: relative;'>
		
		<form name='child_welfare_care' action='update_child_welfare_care.php' onsubmit='return validate_form()' method='post'>
			
			<style>
				table, th, td {
					border: 1px solid black;
					border-collapse: collapse;
				}
			</style>
			<div style='margin-left: 40px; width: 800px;'>
			
				<p class='p'style='color: black;font-weight:100; text-align: center;'>Add any growth changes, located at the bottom, before editing this form.</p>
			
			
				<label style='margin-right: 30px;' ><b>SECTION 2:</b></label> <label><b>CHILD HEALTH MONITORING</b></label><br><br>
				<label style='margin-right: 30px;' ><b>A:</b></label > <label style='margin-right: 50px;'><b>Particulars of the child: </b></label> <input type='date' name='child_particulars' value='$child_particulars'/><br><br>
				<table style='width:100%;'>
				  <tr>
					<td>Name of child:</td>
					<td><input type='text' name='child_name' style='height: 25px; width: 250px;' maxlength='45' value='$child_name'/></td>
				  </tr>
				  <tr>
					<td>Sex of child:</td>
					<td><input type='radio' name='child_gender' value='male' $male_checked> Male<input type='radio' name='child_gender' value='female' $female_checked> Female</td>
				  </tr>
				  <tr>
					<td>Date of Birth:</td>
					<td><input type='date' name='child_date_of_birth' value='$child_date_of_birth'/></td>
				  </tr>
				  <tr>
					<td>Gestartion at birth (in weeks):</td>
					<td>Birth weight in kgs <input type='text' name='birth_weight' style='height: 25px; width: 75px;' value='$birth_weight' /> Birth length in cm <input type='number' name='birth_length' style='height: 25px; width: 75px;' value='$birth_length' /></td>
				  </tr>
				  <tr>
					<td>Other birth characteristics**</td>
					<td><input type='text' name='birth_characteristics' style='height: 25px; width: 400px;' maxlength='45' value='$birth_characteristics'/></td>
				  </tr>
				  <tr>
					<td>Birth order in family (e.g. 1st 2rd 3rd born):</td>
					<td><input type='number' name='birth_order' style='height: 25px; width: 75px;' value='$birth_order'/></td>
				  </tr>
				  <tr>
					<td>date 1st seen:</td>
					<td><input type='date' name='first_seen' value='$first_seen'/></td>
				  </tr>
				</table>
				
				
				<br>
				<label style='margin-right: 30px;'><b>B:</b></label > <label style='margin-right: 50px;'><b>Health record of child:</b><br><br>
				<table style='width:100%;'>
				  <tr>
					<td>Place of birth:</td>
					<th colspan='3' style='font-weight:normal;'><input type='radio' name='birth_place' value='health_facility' $health_facility_checked> Health facility<input type='radio' name='birth_place' value='home' $home_checked> Home<input type='radio' name='birth_place' value='other' $other_checked> Other <input type='text' name='other_birth_place' style='height: 25px; width: 250px; ' maxlength='45' value='$other_birth_place' /></th>
				  </tr>
				  <tr>
					<td><b>Birth Notification No.</b></td>
					<td style='width: 255px;'><input type='number' name='notification_number' style='height: 25px; width: 250px;' maxlength='45' value='$notification_number' /></td>
					<td><b>Date: </b></td>
					<td><input type='date' name='notification_date' value='$notification_date'/></td>
				  </tr>
				  <tr>
					<td>Permanent Register No.</td>
					<th colspan='3'><input type='number' name='register_number' style='height: 25px; width: 250px;' maxlength='45' value='$register_number' /></th>
				  </tr>
				  <tr>
					<td>Child Welfare Clinic (CWC) No.</td>
					<th colspan='3'><input type='number' name='child_welfare_clinic' style='height: 25px; width: 250px;' maxlength='45' value='$child_welfare_clinic'/></th>
				  </tr>
				  <tr>
					<td>Health facility name:</td>
					<th colspan='3'><input type='text' name='health_facility' style='height: 25px; width: 250px;' maxlength='45' value='$health_facility'/></th>
				  </tr>
				  <tr>
					<td>Master facility list (MFL) No.</td>
					<th colspan='3'><input type='number' name='master_facility_list_number' style='height: 25px; width: 250px;' maxlength='45' value='$master_facility_list_number'/></th>
				  </tr>
				</table>
				
				
				<br>
				<label style='margin-right: 30px;'><b>C:</b></label > <label style='margin-right: 50px;'><b>Civil registration:</b><br><br>	
				<table style='width:100%;'>
				  <tr>
					<td>Birth Certificate No:</td>
					<td><input type='number' name='birth_certificate_number' style='height: 25px; width: 250px;' maxlength='45' value='$birth_certificate_number'/></td>
				  </tr>
				  <tr>
					<td>Date of registration:</td>
					<td><input type='date' name='registration_date' value='$registration_date'/></td>
				  </tr>
				  <tr>
					<td>Place of registration:</td>
					<td><input type='text' name='registration_place' style='height: 25px; width: 250px;' maxlength='45' value='$registration_place'/></td>
				  </tr>
				  
				</table>
				**e.g. twin/triplet: caesarian birth; congenital features.<br>
				<label style='margin-left:10px;'>Any congenital abnormalities (cleft lip, club foot).. etc<label><br>
				<textarea style='width: 400px; height: 65px;' name='abnormalities' class='comment_area'  maxlength='255'>$abnormalities</textarea><br>
				
				<br>
				<label style='margin-right: 30px;'><b>D:</b></label > <label style='margin-right: 50px;'><b>Particulars of family of the child:</b><br><br>
				<table style='width:100%;'>
				  <tr>
					<td>Father's name:</td>
					<td><input type='text' name='father_name' style='height: 25px; width: 250px;' maxlength='45' value='$father_name'/></td>
					<td>Tel No.</td>
					<td><input type='number' name='father_phone_number' style='height: 25px; width: 250px;' maxlength='45' value='$father_phone_number'/></td>
				  </tr>
				  <tr>
					<td>Mother's name:</td>
					<td><input type='text' name='mother_name' style='height: 25px; width: 250px;' maxlength='45' value='$mother_name'/></td>
					<td>Tel No.</td>
					<td><input type='number' name='mother_phone_number' style='height: 25px; width: 250px;' maxlength='45' value='$mother_phone_number' /></td>
				  </tr>
				  <tr>
					<td>Guardian's name:</td>
					<td><input type='text' name='guardian_name' style='height: 25px; width: 250px;' maxlength='45' value='$guardian_name'/></td>
					<td>Tel No.</td>
					<td><input type='number' name='guardian_phone_number' style='height: 25px; width: 250px;' maxlength='45' value='$guardian_phone_number'/></td>
				  </tr>
				  <tr>
					<td>Residence of child - <b>Country</b>:</td>
					<td><input type='text' name='country' style='height: 25px; width: 250px;' maxlength='45' value='$country'/></td>
					<td><b>District:</b></td>
					<td><input type='text' name='district' style='height: 25px; width: 250px;' maxlength='45' value='$district' /></td>
				  </tr>
				  <tr>
					<td><b>Division:</b></td>
					<td><input type='text' name='division' style='height: 25px; width: 250px;' maxlength='45' value='$division'/></td>
					<td><b>Location:</b></td>
					<td><input type='text' name='child_location' style='height: 25px; width: 250px;' maxlength='45' value='$child_location'/></td>
				  </tr>
				  <tr>
					<td><b>Town/Trading centre:</b></td>
					<th colspan='3'><input type='text' name='town' style='height: 25px; width: 250px;' maxlength='45' value='$town'/></th>
				  </tr>
				  <tr>
					<td><b>Estate & House No./village:</b></td>
					<th colspan='3'><input type='text' name='village' style='height: 25px; width: 250px;' maxlength='45' value='$village'/></th>
				  </tr>
				  <tr>
					<td>Post address:</td>
					<th colspan='3'><input type='text' name='post_address' style='height: 25px; width: 250px;' maxlength='45' value='$post_address'/></th>
				  </tr>
				  
				</table>
				
				
				<br>
				<label style='margin-right: 30px;'><b>E:</b></label > <label style='margin-right: 50px;'><b>Broad clinical review at first below 6 months:</b><br><br>
				
				<table style='width:100%;'>
				  <tr>
					<td>Age at first contact (number of months):</td>
					<td><input type='number' name='age_first_contact' style='height: 25px; width: 75px;' value='$age_first_contact'/></td>
				  </tr>
				  <tr>
					<td>Weight in kgs:</td>
					<td><input type='text' name='weight' style='height: 25px; width: 75px;' value='$weight'/></td>
				  </tr>
				  <tr>
					<td>Length/height (cm):</td>
					<td><input type='number' name='height' style='height: 25px; width: 75px;' value='$height'/></td>
				  </tr>
				  <tr>
					<td>Physical features:</td>
					<td><input type='text' name='physical_features' style='height: 25px; width: 250px;' maxlength='45' value='$physical_features'/></td>
				  </tr>
				  <tr>
					<td>Colouration (cyanosis/jaundice/macules/hypopigmentation):</td>
					<td><input type='text' name='colouration' style='height: 25px; width: 250px;' maxlength='45' value='$colouration'/></td>
				  </tr>
				  <tr>
					<td>Head circumference (cm):</td>
					<td><input type='number' name='head_circumference' style='height: 25px; width: 75px;' value='$head_circumference'/></td>
				  </tr>
				  <tr>
					<td>Eyes:</td>
					<td><input type='text' name='eyes' style='height: 25px; width: 250px;' maxlength='45' value='$eyes'/></td>
				  </tr>
				  <tr>
					<td>Mouth:</td>
					<td><input type='text' name='mouth' style='height: 25px; width: 250px;' maxlength='45' value='$mouth'/></td>
				  </tr>
				  <tr>
					<td>Chest:</td>
					<td><input type='text' name='chest' style='height: 25px; width: 250px;' maxlength='45' value='$chest'/></td>
				  </tr>
				  <tr>
					<td>Heart:</td>
					<td><input type='text' name='heart' style='height: 25px; width: 250px;' maxlength='45' value='$heart'/></td>
				  </tr>
				  <tr>
					<td>Abdomen:</td>
					<td><input type='text' name='abdomen' style='height: 25px; width: 250px;' maxlength='45' value='$abdomen'/></td>
				  </tr>
				  <tr>
					<td>Umbilical cord/umbilicus:</td>
					<td><input type='text' name='umbilicus' style='height: 25px; width: 250px;' maxlength='45' value='$umbilicus'/></td>
				  </tr>
				  <tr>
					<td>Spine:</td>
					<td><input type='text' name='spine' style='height: 25px; width: 250px;' maxlength='45' value='$spine'/></td>
				  </tr>
				  <tr>
					<td>Arms & hands:</td>
					<td><input type='text' name='arms_and_hands' style='height: 25px; width: 250px;' maxlength='45' value='$arms_and_hands'/></td>
				  </tr>
				  <tr>
					<td>legs & feet:</td>
					<td><input type='text' name='legs_and_feet' style='height: 25px; width: 250px;' maxlength='45' value='$legs_and_feet'/></td>
				  </tr>
				  <tr>
					<td>Genitalia:</td>
					<td><input type='text' name='genitalia' style='height: 25px; width: 250px;' maxlength='45' value='$genitalia'/></td>
				  </tr>
				  <tr>
					<td>Anus:</td>
					<td><input type='text' name='anus' style='height: 25px; width: 250px;' maxlength='45' value='$anus'/></td>
				  </tr>
				</table>
				
				
				
				<br>
				<label style='margin-right: 30px;'><b>F:</b></label > <label style='margin-right: 50px;'><b>Feeding information from parent/guardian:</b><br><br>
				
				<table style='width:100%;'>
				  <tr>
					<td>Breastfeeding:</td>
					<td><input type='radio' name='breastfeeding' value='well' $well_checked> Well<input type='radio' name='breastfeeding' value='poorly' $poorly_checked> Poorly<input type='radio' name='breastfeeding' value='unable' $unable_checked> Unable to breastfeed</td>
				  </tr>
				  <tr>
					<td>Other feeds introduced below 6 months:</td>
					<td>yes<input type='radio' name='feeds' value='yes' $feeds_yes_checked>no<input type='radio' name='feeds' value='no' $feeds_no_checked><label style='margin-left: 20px;'>If yes, at what age</label><input type='number' name='feeds_age' style='margin-left: 5px; height: 25px; width: 75px;' value='$feeds_age'></td>
				  </tr>
				  <tr>
					<td>Complementary food: Other foods introduced:</td>
					<td>yes<input type='radio' name='other_foods_introduced' value='yes' $other_foods_introduced_yes_checked>no<input type='radio' name='other_foods_introduced' value='no' $other_foods_introduced_no_checked></td>
				  </tr>
				  <tr>
					<td>Retention of feeds/indigestion:</td>
					<td><input type='text' name='indigestion' style='height: 25px; width: 250px;' value='$indigestion' /></td>
				  </tr>
				  
				</table>
				<b>NB:</b> A baby who is exclusively breastfed, may pass stool many times or may not pass any for some days. This is normal unless he/she has abdominal distension or is vomiting. <br>
				
				<br>
				<label style='margin-right: 30px;'><b>G:</b></label > <label style='margin-right: 50px;'><b>Other behavioural characteristics from parent/guardian:</b><br><br>
				
				<table style='width:100%;'>
				  <tr>
					<td>Sleep & Waking up cycles: Describe</td>
					<td><input type='text' name='sleep_cycle' style='height: 25px; width: 250px;' maxlength='45' value='$sleep_cycle' /></td>
				  </tr>
				  <tr>
					<td>Irritability:</td>
					<td>yes<input type='radio' name='irritability' value='yes' $irritability_yes_checked>no<input type='radio' name='irritability' value='no' maxlength='45' $irritability_no_checked></td>
				  </tr>
				  <tr>
					<td>Thumb/finger sucking:</td>
					<td>yes<input type='radio' name='finger_sucking' value='yes' $finger_sucking_yes_checked>no<input type='radio' name='finger_sucking' value='no' $finger_sucking_no_checked></td>
				  </tr>
				 <tr>
					<td>Others /e.g. (twitches, convulsuion):</td>
					<td>yes<input type='radio' name='others' value='yes' $others_yes_checked>no<input type='radio' name='others' value='no' $others_no_checked></td>
				  </tr>
				  
				</table>
				<br><br>
				<p class='p'style='color: blue;font-weight:100; text-align: center;'>Immunizations</p>
				<label style='margin-left: 315px; color: orange;'>PROTECT YOUR CHILD</label>
				
				<table style='width:100%;'>
				  <tr>
					<td><label style='color: blue;'><b>BCG VACCINE: at birth</b></label></td>
					<td>Date Given</td>
					<td>Date of next visit</td>
				  </tr>
				  <tr>
					<td>(Intra-demal left arm)</td>
					<td></td>
					<td></td>
				  </tr>
				  <tr>
					<td>Dose (0.05mis for child below 1 year)</td>
					<td><input type='date' name='mis_05_given' value='$mis_05_given' /></td>
					<td><input type='date' name='mis_05_next_visit' value='$mis_05_next_visit' /></td>
				  </tr>
				  <tr>
					<td>Dose (0.1mis for child below 1 year)</td>
					<td><input type='date' name='mis_1_given' value='$mis_1_given' /></td>
					<td><input type='date' name='mis_1_next_visit' value='$mis_1_next_visit' /></td>
				  </tr>
				  <tr>
					<td>BCG-Scar Checked</td>
					<td>Date checked</td>
					<td>Date BCG repeated</td>
				  </tr>
				  <tr>
					<td>PRESENT</td>
					<td><input type='date' name='present_checked' value='$present_checked' /></td>
					<td><input type='date' name='present_repeated' value='$present_repeated' /></td>
				  </tr>
				  <tr>
					<td>ABSENT</td>
					<td><input type='date' name='absent_checked' value='$absent_checked' /></td>
					<td><input type='date' name='absent_repeated' value='$absent_repeated' /></td>
				  </tr>
				  
				  
				</table>
				
				<br><br>
				
				<table style='width:100%;'>
				  <tr>
					<td><label style='color: blue;'><b>ORAL POLIO VACCINE (OPV)</b></label></td>
					<td>Date Given</td>
					<td>Date of next visit</td>
				  </tr>
				  <tr>
					<td>Dose 2 drops oraly</td>
					<td></td>
					<td></td>
				  </tr>
				  <tr>
					<td>Birth Dose: at birth or within 2 wks (OPV 1)</td>
					<td><input type='date' name='birth_dose_given' value='$birth_dose_given' /></td>
					<td><input type='date' name='birth_does_next_visit' value='$birth_does_next_visit' /></td>
				  </tr>
				  <tr>
					<td>1st dose at 6 weeks (OPV 1)</td>
					<td><input type='date' name='pollo_first_dose_given' value='$pollo_first_dose_given' /></td>
					<td><input type='date' name='pollo_first_does_next_visit' value='$pollo_first_does_next_visit' /></td>
				  </tr>
				  <tr>
					<td>2st dose at 10 weeks (OPV 2)</td>
					<td><input type='date' name='pollo_second_dose_given' value='$pollo_second_dose_given' /></td>
					<td><input type='date' name='pollo_second_does_next_visit' value='$pollo_second_does_next_visit' /></td>
				  </tr>
				  <tr>
					<td>3st dose at 14 weeks (OPV 3)</td>
					<td><input type='date' name='pollo_third_dose_given' value='$pollo_third_dose_given' /></td>
					<td><input type='date' name='pollo_third_does_next_visit' value='$pollo_third_does_next_visit' /></td>
				  </tr>
				</table>
				
				<br><br>
				
				<table style='width:100%;'>
				  <tr>
					<td style='width: 450px;'><label style='color: blue;'><b>DPHTHERIA/PERTUSSIS/TETANUS/<br>HEPATITIS B/HAEMOPHILUS INFLUENZAE Type b</b></label></td>
					<td>Date Given</td>
					<td>Date of next visit</td>
				  </tr>
				  <tr>
					<td>1st dose at 6 weeks</td>
					<td><input type='date' name='dphtheria_first_dose_given' value='$dphtheria_first_dose_given' /></td>
					<td><input type='date' name='dphtheria_first_dose_next_visit' value='$dphtheria_first_dose_next_visit' /></td>
				  </tr>
				  <tr>
					<td>2st dose at 10 weeks</td>
					<td><input type='date' name='dphtheria_second_dose_given' value='$dphtheria_second_dose_given' /></td>
					<td><input type='date' name='dphtheria_second_does_next_visit' value='$dphtheria_second_does_next_visit' /></td>
				  </tr>
				  <tr>
					<td>3st dose at 14 weeks</td>
					<td><input type='date' name='dphtheria_third_dose_given' value='$dphtheria_third_dose_given'  /></td>
					<td><input type='date' name='dphtheria_third_does_next_visit' value='$dphtheria_third_does_next_visit' /></td>
				  </tr>
				</table>
				
				<br><br>
				
				<table style='width:100%;'>
				  <tr>
					<td><label style='color: blue;'><b>PNEUMOCOCCAL VACCINE</b></label></td>
					<td>Date Given</td>
					<td>Date of next visit</td>
				  </tr>
				  <tr>
					<td>Dose: (0.5mis) Intra Muscular left outer thigh</td>
					<td></td>
					<td></td>
				  </tr>
				  <tr>
					<td>1st dose at 6 weeks</td>
					<td><input type='date' name='pneumococcal_first_dose_given' value='$pneumococcal_first_dose_given' /></td>
					<td><input type='date' name='pneumococcal_first_does_next_visit' value='$pneumococcal_first_does_next_visit' /></td>
				  </tr>
				  <tr>
					<td>2st dose at 10 weeks</td>
					<td><input type='date' name='pneumococcal_second_dose_given' value='$pneumococcal_second_dose_given' /></td>
					<td><input type='date' name='pneumococcal_second_does_next_visit' value='$pneumococcal_second_does_next_visit' /></td>
				  </tr>
				  <tr>
					<td>3st dose at 14 weeks</td>
					<td><input type='date' name='pneumococcal_third_dose_given'  value='$pneumococcal_third_dose_given' /></td>
					<td><input type='date' name='pneumococcal_third_does_next_visit' value='$pneumococcal_third_does_next_visit' /></td>
				  </tr>
				</table>
				
				<br><br>
				
				<table style='width:100%;'>
				  <tr>
					<td><label style='color: blue;'><b>ROTA VIRUS VACCINE (ROTASRIX)</b></label></td>
					<td>Date Given</td>
					<td>Date of next visit</td>
				  </tr>
				  <tr>
					<td>Dose: 1.5mis orally</td>
					<td></td>
					<td></td>
				  </tr>
				  <tr>
					<td>1st dose at 6 weeks</td>
					<td><input type='date' name='rota_first_dose_given' value='$rota_first_dose_given' /></td>
					<td><input type='date' name='rota_first_does_next_visit' value='$rota_first_does_next_visit' /></td>
				  </tr>
				  <tr>
					<td>2st dose at 10 weeks<span style='color: red;'>*<span></td>
					<td><input type='date' name='rota_second_dose_given' value='$rota_second_dose_given' /></td>
					<td><input type='date' name='rota_second_does_next_visit' value='$rota_second_does_next_visit' /></td>
				  </tr>
				</table>
				<span style='color: red;'>*2nd dose should be given not later than 32 weeks of age.</span>
				
				<br><br>
				
				<table style='width:100%;'>
				  <tr>
					<td><label style='color: blue;'><b>MEASLES VACCINE at 6 Months: in the event of a Measles outbreak or HIV Exposed children (HEI)</b></label></td>
					<td>Date Given</td>
				  </tr>
				  
				  <tr>
					<td>Dose: (0.5mis) Subutareously right upper arm</td>
					<td><input type='date' name='measles_6_months_date' value='$measles_6_months_date' /></td>
				  </tr>
				  
				  
				  
				</table>
				<br><br>
				
				<table style='width:100%;'>
				
				  <tr>
					<td><label style='color: blue;'><b>MEASLES VACCINE at 9 Months</b></label></td>
					<td>Date Given</td>
				  </tr>
				  
				  <tr>
					<td>Dose: (0.5mis) Subutareously right upper arm</td>
					<td><input type='date' name='measles_9_months_date' value='$measles_9_months_date' /></td>
				  </tr>
				  
				</table>
				
				<br><br>
				
				<table style='width:100%;'>
				
				  <tr>
					<td><label style='color: blue;'><b>MEASLES VACCINE at 18 Months</b></label></td>
					<td>Date Given</td>
				  </tr>
				  
				  <tr>
					<td>Dose: (0.5mis) Subutareously right upper arm</td>
					<td><input type='date' name='measles_18_months_date' value='$measles_18_months_date'/></td>
				  </tr>
				  
				</table>
				
				
				<br><br>
				
				<table style='width:100%;'>
				
				  <tr>
					<td><label style='color: blue;'><b>YELLOW FEVER VACCINE at 9 Months</b></label><span style='color: orange;'>**</span></td>
					<td>Date Given</td>
				  </tr>
				  
				  <tr>
					<td>Dose: (0.5mis) Subutareously right upper arm</td>
					<td><input type='date' name='yellow_fever_date' value='$yellow_fever_date' /></td>
				  </tr>
				  
				</table>
				<span style='color: orange;'>** Only in selected districts in Rift Valley</span>
				
				<br><br>

				<label style='color: blue;'><b>Other Vaccine</b></label>
				
				<table style='width:100%;'>
				
				  <tr>
					<td>Vaccine</td>
					<td>Date Given</td>
				  </tr>
				  
				  
				  
				</table>
				<style>
				  .notes {
					  background-attachment: local;
					  background-image:
						linear-gradient(to right, white 10px, transparent 10px),
						linear-gradient(to left, white 10px, transparent 10px),
						repeating-linear-gradient(white, white 30px, #ccc 30px, #ccc 31px, white 31px);
					  line-height: 31px;
					  padding: 8px 10px;
					}
				  </style>
				  <textarea class='notes' name='other_vaccine' style='width: 778px; height: 300px;'>$other_vaccine</textarea>
				  
				  <br><br>
				  
				  <div style='width: 700px; height: 50px;'>
					<input style='width: 250px; margin-left: 275px;' type='submit' name='submit_button' class='submitbtn' value='Submit Form'>
				  </div>
				  
				<p class='p'style='color: black;font-weight:100; text-align: center;'>Change growth button located below. Click on a previous growth to edit it.</p>
				  
			</div>
		</form>";
	
			echo "<style>
			
			.height_weight_table{
				width:100%;
				table-layout: fixed;
				border-collapse: collapse;
				border: 2px solid #fff;
			}
			.height_weight_labels{
				padding: 20px 8px;
				text-align: center;
				font-weight: 500;
				font-size: 12px;
				font-size: 30px;
				color: #fff;
				border-style: solid;
				border-color: #black;
				background-color: white;
				color: black;
			}
			
			</style>";
		
			echo "<div style='width: 800px; height: 600px; overflow: auto; margin-left: 40px;'>";
	
				echo "<table style='border: none;' class='height_weight_table'>";
				echo "<tr><th class='height_weight_labels'>Weight (kgs)</th><th class='height_weight_labels'>Weight Percentile</th><th class='height_weight_labels'>Height</th><th class='height_weight_labels'>Height Percentile</th><th class='height_weight_labels'>Date</th></tr>";
				
				// get the client by id
				$stmt = $conn->prepare("SELECT child_growth_id, weight, weight_percentile, height, height_percentile, date_format(timestamp, '%b %d %Y %h:%i %p') FROM child_growth WHERE child_welfare_care_id='$choosen_child_welfare_care';");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
				$_SESSION['counter'] = 0;
				foreach(new view_clients(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				   echo $v;
				   ++$_SESSION['counter'];
				}

			echo "</table>";
			echo "</div>";
		
		?>
		<form name="growth" action="insert_child_growth.php" method="post" onsubmit="return growth_validation()">
			<div style=' margin-left: 40px; margin-top: 20px;'>
				Weight: <input type='text' name='child_growth_weight' style='height: 25px; width: 75px; margin-right: 25px;' />
				Weight Percentile: <input type='number' name='child_growth_weight_percentile' style='height: 25px; width: 75px; margin-right: 25px;' />
				Height: <input type='number' name='child_growth_height' style='height: 25px; width: 75px; margin-right: 25px;' />
				Height Percentile: <input type='number' name='child_growth_height_percentile' style='height: 25px; width: 75px;' />
				<input style="width: 250px; margin-left: 275px; margin-top: 30px;" type="submit" name="submit_button" class="submitbtn" value="Add Growth Change">
			</div>
		</form>
	</div>
	
 </div>
  
</body>
</html>
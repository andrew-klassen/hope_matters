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
        <form method="post" action="select_client_lab_order.php">
            <input style="width: 300px;" type="submit" value="Client Selection">
        </form>
      </div>
	  
  </div>
  <br></br>
  
<!-- all divs are within this div, it keeps the divs centered -->
<div style="width:970px; margin: 0 auto; ">
  
  <!-- the begining of general info card -->
  <div class="accountCard" style="float: left; margin-left: 240px;" >
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
		
		// create database connection
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
		
		
		// grab sex
		$stmt = $conn->prepare("SELECT sex FROM general_info WHERE client_id='$choosen_client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$sex = $_SESSION['temp'];
		
		
		// grab location
		$stmt = $conn->prepare("SELECT location FROM general_info WHERE client_id='$choosen_client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$location = $_SESSION['temp'];
		
		
		// grab date of birth
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
	
	?>
		
 </div>
  
  
	<!-- begining of lab orders card -->
    <div class="accountCard" style="float: left; width: 885px; height: 620px; position: relative;">
		
		<p class='p'style='color: black;font-weight:100; text-align: center;'>Check the tests that a lab technician should preform.</p>
		
		<form name="lab_form" action="insert_lab_order.php" onsubmit="return validate_form()" method="post">
			
			<div style="float: left; margin-left: 250px;">
			
				                 <input type="checkbox" name="bs_for_mps" /> <b>B/S for MPS</b>
								 
				<br><br>
				
				                 <input type="checkbox" name="pbf" /> <b>PBF</b>
								 
				<br><br>
				
				                 <input type="checkbox" name="widal" /> <b>Widal</b>
								 
				<br><br>
				
				                 <input type="checkbox" name="brucella" /> <b>Brucella</b>
								 
				<br><br>
				
				                <input type="checkbox" name="h_pylori_stool" /> <b>H.Pylori(stool)</b>
			
				<br><br>
				
				                <input type="checkbox" name="h_pylori_blood" /> <b>H.Pylori(Blood)</b>
			
				<br><br>
				                
								<input type="checkbox" name="rheumatoid_factor" /> <b>Rheumatoid Factor</b>
								
				<br><br>
				
								<input type="checkbox" name="stool" /> <b>Stool O/C</b>
								
				<br><br>
				
				                <input type="checkbox" name="p24_hiv" /> <b>P24/HIV</b>
								
				<br><br>
				
				                 <input type="checkbox" name="vdrl_rpr" /> <b>VDRL/RPR</b>
								 
				<br><br>
				
				                <input type="checkbox" name="urinalysis" /> <b>Urinalysis</b>
								
				<br><br>
				
								<input type="checkbox" name="pregnancy_test" /> <b>Pregnancy Test</b>
									
				<br><br>
				
				                <input type="checkbox" name="hvs" /> <b>HVS</b>
								 
				<br><br>
				
			    </div>
			
			     <div style="float: right; margin-right: 200px;">
				      			<input type="checkbox" name="gram_stain" /> <b>Gram Stain</b>
				                 
				<br><br>
				
				                <input type="checkbox" name="culture" /> <b>Culture</b>
								
				<br><br>
				                 
								<input type="checkbox" name="blood_group" /> <b>Blood Group</b>

				<br><br>
				
                                <input type="checkbox" name="blood_count" /> <b>Blood Count</b>
				
				<br><br>
				
				                <input type="checkbox" name="blood_chemistry" /> <b>Blood Chemistry</b>
				
				<br><br>
								
				                <input type="checkbox" name="arterial_blood" /> <b>Arterial Blood gas</b>
								
				<br><br>
				
				                <input type="checkbox" name="liver_function_test" /> <b>Liver Function</b>
								
				<br><br>
                                 
				                <input type="checkbox" name="prothrombin_time" /> <b>Prothrombin Time</b>
								
				<br><br>
				
				                <input type="checkbox" name="inr" /> <b>INR</b>
								
				<br><br>

                                <input type="checkbox" name="tft" /> <b>Thyroid Function Test</b>
								
				<br><br>

                                 <input type="checkbox" name="cholesterol" /> <b>Cholesterol</b>
								 
				<br><br>

                                 <input type="checkbox" name="cardiac" /> <b>Cardiac Enzymes</b>
								
				<br><br>
				
				               
				
				<br>
				
			</div>
			
			<div style="float: left; margin-top: 10px;margin-left: 300px;">
				                 <input style="width: 300px; margin-top: 10px;" type="submit" name="submit_button" class="submitbtn" value="Submit Lab Order">
			</div>

			
		</form>
		
	</div>
	
 </div>
  
</body>
</html>

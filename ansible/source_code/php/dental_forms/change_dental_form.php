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
	<script src="/js/dental_form_validation.js" type="text/javascript"> </script>
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
        <form method="post" action="select_dental_form.php">
            <input style="width: 300px;" type="submit" value="Form Selection">
        </form>
    </div>
	  
</div>
<br></br>
  
<div style="width:970px; margin: 0 auto; ">
  
<!-- start of general info card -->
<div class="accountCard" style="float: left; margin-right: 5px; height: 245px;" >
	<p class='p'style='color: black;font-weight:100; text-align: center;'>Client's General Info</p>
	
	
<?php
		
		require('../database_credentials.php');
		require('../date_functions.php');
		session_start();
		
		// make sure user is logged in
		login_check();
		
		$choosen_dental_form_id = $_SESSION['choosen_dental_form_id'];
		
		
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
		
		
		$conn = new PDO($dbconnection, $dbusername, $dbpassword);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		
		// grab the clients id
		$stmt = $conn->prepare("SELECT client_id FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$choosen_client_id = $_SESSION['temp'];
		
		
		// grab the clients first name
		$stmt = $conn->prepare("SELECT first_name FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$first_name = $_SESSION['temp'];
		
		
		// grab the clients last name
		$stmt = $conn->prepare("SELECT last_name FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$last_name = $_SESSION['temp'];
		
		
		// grab the clients sex
		$stmt = $conn->prepare("SELECT sex FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$sex = $_SESSION['temp'];
		
		
		// grab the clients location
		$stmt = $conn->prepare("SELECT location FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$location = $_SESSION['temp'];
		
		
		// grab the clients date of birth
		$stmt = $conn->prepare("SELECT date_of_birth FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$date_of_birth = $_SESSION['temp'];
		

		// grab the clients hiv status
		$stmt = $conn->prepare("SELECT hiv_status FROM general_info WHERE client_id='$choosen_client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$hiv_status = $_SESSION['temp'];
		
		
		// grab the clients phone number
		$stmt = $conn->prepare("SELECT phone_number FROM general_info WHERE client_id='$choosen_client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$phone_number = $_SESSION['temp'];
		
		
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
  
  
  <!-- start of the vital signs -->
  <div class="accountCard" style="float: left; height: 245px;">
	<p class='p' style='color: black;font-weight:100; text-align: center; padding-bottom: 50px;'>Vital Signs</p>
	
	<div style=' float: left;'>
		<?php
			echo 'T:' . "<br>" . "<br>";
			echo 'BP:' . "<br>" . "<br>";
			echo 'PR:' . "<br>" . "<br>";
			
		
		?>
	</div>
	
	<form  name="dental_form" action="update_dental_form.php" onsubmit="return validate_form()" method="post" enctype="multipart/form-data">
	
	<div style=' float: left; padding-left: 15px;'>
		<?php
	
			// grab the clients t
			$stmt = $conn->prepare("SELECT t FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$t = $_SESSION['temp'];
			
			
			// grab the clients bp
			$stmt = $conn->prepare("SELECT bp FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$bp = $_SESSION['temp'];
			
			
			// grab the clients pr
			$stmt = $conn->prepare("SELECT pr FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$pr = $_SESSION['temp'];
		
			echo"
				<input type='text' name='t' value='$t' style='width: 100px; height: 30px;' maxlength='10'><br>
				<input type='text' name='bp' value='$bp' style='width: 100px; height: 30px;' maxlength='10'><br>
				<input type='number' name='pr' value='$pr' style='width: 100px; height: 30px;' min='0' max='9999999999'><br>";
			
		?>
	
	</div>
	
	<div style=' float: left; padding-left: 15px;'>
		<?php
			echo 'RR:' . "<br>" . "<br>";
			echo 'WT:' . "<br>" . "<br>";
			echo 'Pain:' . "<br>" . "<br>";
		?>
	</div>
	
	<div style=' float: left; padding-left: 15px;'>
		<?php
		
			// grab the clients rr
			$stmt = $conn->prepare("SELECT rr FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
			}
			$rr = $_SESSION['temp'];
			
			
			// grab the clients wt
			$stmt = $conn->prepare("SELECT wt FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
			}
			$wt = $_SESSION['temp'];
		
		
			// grab the clients pain
			$stmt = $conn->prepare("SELECT pain FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
			}
			$pain = $_SESSION['temp'];
		
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
		
			echo "<input type='number' name='rr' value='$rr' style='width: 100px; height: 30px;' min='0' max='9999999999'><br>
			<input type='number' name='wt' value='$wt' style='width: 100px; height: 30px;' min='0' max='9999999999'><br>
			
			<div style=' float: left;'>
				<input type='radio' name='pain' value='none' $none_check> none <br>
				<input type='radio' name='pain' value='mild' $mild_check> mild 
			</div>
			
			<div style=' float: left;'>
				<input type='radio' name='pain' value='moderate' $moderate_check> moderate <br>
				<input type='radio' name='pain' value='severe' $severe_check> severe
			</div>";
		
		?>

	</div>
	
	<!-- end of vital signs --> 
  </div>
  
	<!-- start of medicat history card --> 
    <div class="accountCard" style="float: left; width: 400px; height: 930px;">
		<p class='p'style='color: black;font-weight:100; text-align: center;'>Significant Medical History</p>
		<style>
			.diseases {
				height: 21px;
			}
		</style>
		<div style=' float: left; padding-left: 15px;'>
			<?php
				echo "<div class='diseases'>Latex Glove Allergy: </div>";
				echo "<div class='diseases'>Ulcers: </div>";
				echo "<div class='diseases'>Diabetes: </div>";
				echo "<div class='diseases'>Epilepsy: </div>";
				echo "<div class='diseases'>Hemophilia/Bleeding: </div>";
				echo "<div class='diseases'>Pregnant: </div>";
				echo "<div class='diseases'>Using Herbs: </div>";
				echo "<div class='diseases'>Heart Problems: </div>";
				echo "<div class='diseases'>Hepatitis/Liver Problem: </div>";
				echo "<div class='diseases'>Chronic Cough: </div>";
				echo "<div class='diseases'>Tuberculosis: </div>";
				echo "<div class='diseases'>Asthma: </div>";
				echo "<div class='diseases'>HIV Status Known: </div>";
				echo "<div class='diseases'>Fainting/Dizzy Spells: </div>";
				echo "<div class='diseases'>Family Planning Pills: </div>" ;
				echo "<div class='diseases'>Taking Blood Thinners: </div>";
				echo "<div class='diseases'>High Blood Pressure: </div>";
				echo "<div class='diseases'>Anemia: </div>";
			?>
		</div>
		
		<div style=' float: left; padding-left: 15px; padding-top: 1px;'>
		<?php
			
			// check to see if client had latex glove allergy
			$stmt = $conn->prepare("SELECT latex_glove_allergy FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
			}
			$latex_glove_allergy = $_SESSION['temp'];
			
			$yes_checked = "";
			$no_checked = "";
			
			if ($latex_glove_allergy == "yes") {
				$yes_checked = "checked";
			}
			else {
				$no_checked = "checked";
			}
			
			echo "<div class='diseases'>
					<input  type='radio' name='latex_glove_allergy' value='yes' $yes_checked> yes
					<input  type='radio' name='latex_glove_allergy' value='no' $no_checked> no
				 </div>";
			
			
			// check to see if client had ulcers
			$stmt = $conn->prepare("SELECT ulcers FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
			}
			$ulcers = $_SESSION['temp'];
			
			$yes_checked = "";
			$no_checked = "";
			
			if ($ulcers == "yes") {
				$yes_checked = "checked";
			}
			else {
				$no_checked = "checked";
			}
			
			echo "<div class='diseases'>
					<input type='radio' name='ulcers' value='yes' $yes_checked> yes
					<input type='radio' name='ulcers' value='no' $no_checked> no
				  </div>";
			
			
			// check to see if client had diabetes
			$stmt = $conn->prepare("SELECT diabetes FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
			}
			$diabetes = $_SESSION['temp'];
			
			$yes_checked = "";
			$no_checked = "";
			
			if ($diabetes == "yes") {
				$yes_checked = "checked";
			}
			else {
				$no_checked = "checked";
			}
			
			echo "<div class='diseases'>
					<input type='radio' name='diabetes' value='yes' $yes_checked> yes
					<input type='radio' name='diabetes' value='no' $no_checked> no
				 </div>";
			
			
			// check to see if client had epilepsy
			$stmt = $conn->prepare("SELECT epilepsy FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
			}
			$epilepsy = $_SESSION['temp'];
			
			$yes_checked = "";
			$no_checked = "";
			
			if ($epilepsy == "yes") {
				$yes_checked = "checked";
			}
			else {
				$no_checked = "checked";
			}
			
			echo "<div class='diseases'>
					<input type='radio' name='epilepsy' value='yes' $yes_checked> yes
					<input type='radio' name='epilepsy' value='no' $no_checked> no
				  </div>";
			
			
			// check to see if client had hemophilia bleeding
			$stmt = $conn->prepare("SELECT hemophilia_bleeding FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
			}
			$hemophilia = $_SESSION['temp'];
			
			$yes_checked = "";
			$no_checked = "";
			
			if ($hemophilia == "yes") {
				$yes_checked = "checked";
			}
			else {
				$no_checked = "checked";
			}
			
			echo "<div class='diseases'>
						<input type='radio' name='hemophilia' value='yes' $yes_checked> yes
						<input type='radio' name='hemophilia' value='no' $no_checked> no
				  </div>";
			
			
			// check to see if client had pregnant
			$stmt = $conn->prepare("SELECT pregnant FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
			}
			$pregnant = $_SESSION['temp'];
			
			$yes_checked = "";
			$no_checked = "";
			
			if ($pregnant == "yes") {
				$yes_checked = "checked";
			}
			else {
				$no_checked = "checked";
			}
			
			echo "<div class='diseases'>
					<input type='radio' name='pregnant' value='yes' $yes_checked> yes
					<input type='radio' name='pregnant' value='no' $no_checked> no
				 </div>";
			
			
			// check to see if client had herbs
			$stmt = $conn->prepare("SELECT herbs FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
			}
			$herbs = $_SESSION['temp'];
			
			$yes_checked = "";
			$no_checked = "";
			
			if ($herbs == "yes") {
				$yes_checked = "checked";
			}
			else {
				$no_checked = "checked";
			}
			
			echo "<div class='diseases'>
					<input type='radio' name='herbs' value='yes' $yes_checked> yes
					<input type='radio' name='herbs' value='no' $no_checked> no
				 </div>";
			
			
			// check to see if client had heart problems
			$stmt = $conn->prepare("SELECT heart_problems FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
			}
			$heart_problem = $_SESSION['temp'];
			
			$yes_checked = "";
			$no_checked = "";
			
			if ($heart_problem == "yes") {
				$yes_checked = "checked";
			}
			else {
				$no_checked = "checked";
			}
			
			echo "<div class='diseases'>
					<input type='radio' name='heart_problem' value='yes' $yes_checked> yes
					<input type='radio' name='heart_problem' value='no' $no_checked> no
				 </div>";
			
			
			// check to see if client had hepatitis
			$stmt = $conn->prepare("SELECT hepatitis_liver_problem FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
			}
			$hepatitis = $_SESSION['temp'];
			
			$yes_checked = "";
			$no_checked = "";
			
			if ($hepatitis == "yes") {
				$yes_checked = "checked";
			}
			else {
				$no_checked = "checked";
			}
			
			echo "<div class='diseases'>
					<input type='radio' name='hepatitis' value='yes' $yes_checked> yes
					<input type='radio' name='hepatitis' value='no' $no_checked> no 
				 </div>";
			
			
			// check to see if client had cough
			$stmt = $conn->prepare("SELECT cough FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
			}
			$cough = $_SESSION['temp'];
			
			$yes_checked = "";
			$no_checked = "";
			
			if ($cough == "yes") {
				$yes_checked = "checked";
			}
			else {
				$no_checked = "checked";
			}
			
			echo "<div class='diseases'>
					<input type='radio' name='cough' value='yes' $yes_checked> yes
					<input type='radio' name='cough' value='no' $no_checked> no 
				 </div>";
			
			
			// check to see if client had tuberculosis
			$stmt = $conn->prepare("SELECT tuberculosis FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
			}
			$tuberculosis = $_SESSION['temp'];
			
			$yes_checked = "";
			$no_checked = "";
			
			if ($tuberculosis == "yes") {
				$yes_checked = "checked";
			}
			else {
				$no_checked = "checked";
			}
			
			echo "<div class='diseases'>
					<input type='radio' name='tuberculosis' value='yes' $yes_checked> yes
					<input type='radio' name='tuberculosis' value='no' $no_checked> no 
				 </div>";
			
			
			// check to see if client had asthma
			$stmt = $conn->prepare("SELECT asthma FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
			}
			$asthma = $_SESSION['temp'];
			
			$yes_checked = "";
			$no_checked = "";
			
			if ($asthma == "yes") {
				$yes_checked = "checked";
			}
			else {
				$no_checked = "checked";
			}
			
			echo "<div class='diseases'>
					<input type='radio' name='asthma' value='yes' $yes_checked> yes
					<input type='radio' name='asthma' value='no' $no_checked> no 
				 </div>";
			
			
			echo "<div class='diseases'>";
				// dynamically display client's hiv status
				if ($hiv_status == 'unknown'){
					echo "<b style='font-size: 105%; text-align: center;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; no</b>" . "<br>";
				}
				else{
					echo "<b style='font-size: 105%; text-align: center;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; yes</b>" . "<br>";
				}
			echo '</div>';
			
			
			// check to see if client had fainting
			$stmt = $conn->prepare("SELECT fainting FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
			}
			$fainting = $_SESSION['temp'];
			
			$yes_checked = "";
			$no_checked = "";
			
			if ($fainting == "yes") {
				$yes_checked = "checked";
			}
			else {
				$no_checked = "checked";
			}
			
			echo "<div class='diseases'>
					<input type='radio' name='fainting' value='yes' $yes_checked> yes
					<input type='radio' name='fainting' value='no' $no_checked> no 
				  </div>";
			
			
			// check to see if client had family planning pills
			$stmt = $conn->prepare("SELECT family_planning_pills FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
			}
			$family_pills = $_SESSION['temp'];
			
			
			$yes_checked = "";
			$no_checked = "";
			
			if ($family_pills == "yes") {
				$yes_checked = "checked";
			}
			else {
				$no_checked = "checked";
			}
			
			echo "<div class='diseases'>
					<input type='radio' name='family_pills' value='yes' $yes_checked> yes
					<input type='radio' name='family_pills' value='no' $no_checked> no 
				  </div>";
			
			
			// check to see if client had blood thinners
			$stmt = $conn->prepare("SELECT blood_thinners FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
			}
			$blood_thinners = $_SESSION['temp'];
			
			$yes_checked = "";
			$no_checked = "";
			
			if ($blood_thinners == "yes") {
				$yes_checked = "checked";
			}
			else {
				$no_checked = "checked";
			}
			
			echo "<div class='diseases'>
					<input type='radio' name='blood_thinners' value='yes' $yes_checked> yes
					<input type='radio' name='blood_thinners' value='no' $no_checked> no 
				  </div>";
			
			
			// check to see if client had high blood presure
			$stmt = $conn->prepare("SELECT high_blood_presure FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
			}
			$blood_pressure = $_SESSION['temp'];
			
			$yes_checked = "";
			$no_checked = "";
			
			if ($blood_pressure == "yes") {
				$yes_checked = "checked";
			}
			else {
				$no_checked = "checked";
			}
			
			echo "<div class='diseases'>
					<input type='radio' name='blood_pressure' value='yes' $yes_checked> yes
					<input type='radio' name='blood_pressure' value='no' $no_checked> no 
				  </div>";
			
			
			// check to see if client had anemia
			$stmt = $conn->prepare("SELECT anemia FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
			}
			$anemia = $_SESSION['temp'];
			
			$yes_checked = "";
			$no_checked = "";
			
			if ($anemia == "yes") {
				$yes_checked = "checked";
			}
			else {
				$no_checked = "checked";
			}
			
			echo "<div class='diseases'>
					<input type='radio' name='anemia' value='yes' $yes_checked> yes
					<input type='radio' name='anemia' value='no' $no_checked> no 
				  </div><br>";
			
		?>
			
		</div>
		
		<div style="width: 200px;  margin-left: 120px;">
			<p class='p'style='color: black;'>Allergies</p>
		</div>
		
		<div style=' float: left; padding-left: 15px;'>
			<?php
				echo "<div class='diseases'>Penicillin: </div>";
				echo "<div class='diseases'>Codeine: </div>";
				echo "<div class='diseases'>Local Anesthesia: </div>";
				echo "<div class='diseases'>Sulfur: </div>";
				echo "<div class='diseases'>Aspirin: </div>";
				echo "<div class='diseases'>Other: </div>";
			?>
		</div>
		
		<div style=' float: left; padding-left: 65px; '>
		<?php
			
			// check to see if client had penicillin
			$stmt = $conn->prepare("SELECT penicillin FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
			}
			$penicillin = $_SESSION['temp'];
			
			$yes_checked = "";
			$no_checked = "";
			
			if ($penicillin == "yes") {
				$yes_checked = "checked";
			}
			else {
				$no_checked = "checked";
			}
			
			echo "<div class='diseases'>
					<input  type='radio' name='penicillin' value='yes' $yes_checked> yes
					<input  type='radio' name='penicillin' value='no' $no_checked> no 
				  </div>";
			
			
			// check to see if client had codeine
			$stmt = $conn->prepare("SELECT codeine FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
			}
			$codenine = $_SESSION['temp'];
			
			$yes_checked = "";
			$no_checked = "";
			
			if ($codenine == "yes") {
				$yes_checked = "checked";
			}
			else {
				$no_checked = "checked";
			}
			
			echo "<div class='diseases'>
					<input type='radio' name='codenine' value='yes' $yes_checked> yes
					<input type='radio' name='codenine' value='no' $no_checked> no 
				  </div>";
		
		
			// check to see if client had local anesthesia
			$stmt = $conn->prepare("SELECT local_anesthesia FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
			}
			$local_anesthesia = $_SESSION['temp'];
			
			$yes_checked = "";
			$no_checked = "";
			
			if ($local_anesthesia == "yes") {
				$yes_checked = "checked";
			}
			else {
				$no_checked = "checked";
			}
			
			echo "<div class='diseases'>
					<input type='radio' name='local_anesthesia' value='yes' $yes_checked> yes
					<input type='radio' name='local_anesthesia' value='no' $no_checked> no 
				  </div>";
		
		
			// check to see if client had sulfur
			$stmt = $conn->prepare("SELECT sulfur FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
			}
			$sulfur = $_SESSION['temp'];
			
			$yes_checked = "";
			$no_checked = "";
			
			if ($sulfur == "yes") {
				$yes_checked = "checked";
			}
			else {
				$no_checked = "checked";
			}
			
			echo "<div class='diseases'>
					<input type='radio' name='sulfur' value='yes' $yes_checked> yes
					<input type='radio' name='sulfur' value='no' $no_checked> no 
				  </div>";
			
			
			// check to see if client had aspirin
			$stmt = $conn->prepare("SELECT aspirin FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
			}
			$aspirin = $_SESSION['temp'];
			
			$yes_checked = "";
			$no_checked = "";
			
			if ($aspirin == "yes") {
				$yes_checked = "checked";
			}
			else {
				$no_checked = "checked";
			}
			
			echo "<div class='diseases'>
					<input type='radio' name='aspirin' value='yes' $yes_checked> yes
					<input type='radio' name='aspirin' value='no' $no_checked> no 
				  </div>";
			
			
			// check to see if client had other allergie
			$stmt = $conn->prepare("SELECT other_allergie FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
			}
			$other = $_SESSION['temp'];
			
			echo "<div class='diseases'><input style='height: 20px; width: 130px;'type='text' name='other' value='$other' maxlength='20' ></div>";
			
		?>
		<br>
		</div>
		
		<div style="width: 250px;  margin-left: 100px;">
			<p class='p'style='color: black;'>Dental History</p>
		</div>
		
		<div style=' float: left; padding-left: 15px;'>
			<?php
				echo "<div style='height: 40px;'>Teeth Sensitive to: </div>";
			?>
		</div>
		<div style='width: 170px; height: 42px; float: right;'>
			<div style=' float: right;'>
				<?php
						// check to see if client had teeth sensitive hot
						$stmt = $conn->prepare("SELECT teeth_sensitive_hot FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
						$stmt->execute();
						$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
						foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
						}
						$hot = $_SESSION['temp'];
						
						if ($hot == "yes") {
							$hot_checked = "checked";
						}
						else {
							$hot_checked = "";
						}
						
						
						// check to see if client had teeth sensitive cold
						$stmt = $conn->prepare("SELECT teeth_sensitive_cold FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
						$stmt->execute();
						$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
						foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
						}
						$cold  = $_SESSION['temp'];
						
						if ($cold  == "yes") {
							$cold_checked = "checked";
						}
						else {
							$cold_checked = "";
						}
						
						echo "<div class='diseases' style='width: 84px; float: left;'><input type='checkbox' name='hot' value='yes' $hot_checked>Hot</div>
							  <div class='diseases' style='width: 85px; float: right;'><input style='width: 15px;' type='checkbox' name='cold' value='yes' $cold_checked>Cold</div> ";
					
				?>
			</div>
			
			
			<div style=' float: right;'>
				<?php
				
						// check to see if client had teeth sensitive biting
						$stmt = $conn->prepare("SELECT teeth_sensitive_biting FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
						$stmt->execute();
						$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
						foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
						}
						$biting = $_SESSION['temp'];
						
						if ($biting == "yes") {
							$biting_checked = "checked";
						}
						else {
							$biting_checked = "";
						}
						
						
						// check to see if client had teeth sensitive sweets
						$stmt = $conn->prepare("SELECT teeth_sensitive_sweets FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
						$stmt->execute();
						$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
						foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
						}
						$sweets  = $_SESSION['temp'];
						
						if ($sweets == "yes") {
							$sweets_checked = "checked";
						}
						else {
							$sweets_checked = "";
						}
				
						echo "<div class='diseases' style='width: 85px; float: left;'><input style='width: 15px;' type='checkbox' name='biting' value='yes' $biting_checked>Biting</div>
						  <div class='diseases' style='width: 85px; float: right;'><input style='width: 15px;' type='checkbox' name='sweet' value='yes' $sweets_checked >Sweets</div> <br>";
				
				?>
			</div>
		</div>
		
		<div style=' float: left; padding-left: 15px; margin-top: 4px;'>
			<?php
				echo "<div class='diseases'>Gums Painful: </div>";
				echo "<div class='diseases'>Gums Bleed: </div>";
				echo "<div class='diseases'>Loose Teeth: </div>";
				echo "<div class='diseases'>Jaw not opening/closing: </div>";
				echo "<div class='diseases'>Pain Around Face: </div>";
				echo "<div class='diseases'>Grinding: </div>";
				echo "<div class='diseases'>Past Extractions: </div>";
				echo "<div class='diseases'>Past Periodontic Treatment: </div>";
			?>
		</div>
		
		<div style=' float: left; padding-left: 30px; '>
			
			<?php
			
				// check to see if client had painful gums
				$stmt = $conn->prepare("SELECT gums_painful FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
				}
				$gums_painful  = $_SESSION['temp'];
				
				$yes_checked = "";
				$no_checked = "";
			
				if ($gums_painful == "yes") {
					$yes_checked = "checked";
				}
				else {
					$no_checked = "checked";
				}
			
				echo "<div class='diseases'>
						<input  type='radio' name='gums_painful' value='yes' $yes_checked> yes
						<input  type='radio' name='gums_painful' value='no' $no_checked> no 
					  </div>";
				
				
				// check to see if client had bleeding gums
				$stmt = $conn->prepare("SELECT gums_bleeding FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
				}
				$gums_bleed  = $_SESSION['temp'];
				
				$yes_checked = "";
				$no_checked = "";
			
				if ($gums_bleed == "yes") {
					$yes_checked = "checked";
				}
				else {
					$no_checked = "checked";
				}
			
				echo "<div class='diseases'>
						<input type='radio' name='gums_bleed' value='yes' $yes_checked> yes
						<input type='radio' name='gums_bleed' value='no' $no_checked> no 
					  </div>";
				
				
				// check to see if client had loose teeth
				$stmt = $conn->prepare("SELECT loose_teeth FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
				}
				$loose_teeth  = $_SESSION['temp'];
				
				$yes_checked = "";
				$no_checked = "";
			
				if ($loose_teeth == "yes") {
					$yes_checked = "checked";
				}
				else {
					$no_checked = "checked";
				}
			
				echo "<div class='diseases'>
						<input type='radio' name='loose_teeth' value='yes' $yes_checked> yes
						<input type='radio' name='loose_teeth' value='no' $no_checked> no 
					  </div>";
				
			
				// check to see if client's jaw would not open/close
				$stmt = $conn->prepare("SELECT jaw_not_opening_closing FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
				}
				$jaw  = $_SESSION['temp'];
				
				$yes_checked = "";
				$no_checked = "";
			
				if ($jaw == "yes") {
					$yes_checked = "checked";
				}
				else {
					$no_checked = "checked";
				}
			
				echo "<div class='diseases'>
						<input type='radio' name='jaw' value='yes' $yes_checked> yes
						<input type='radio' name='jaw' value='no' $no_checked> no 
					  </div>";
				
				
				// check to see if client had pain in jaw, ear, or face
				$stmt = $conn->prepare("SELECT pain_jaw_ear_face FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
				}
				$face_pain  = $_SESSION['temp'];
				
				$yes_checked = "";
				$no_checked = "";
			
				if ($face_pain == "yes") {
					$yes_checked = "checked";
				}
				else {
					$no_checked = "checked";
				}
			
				echo "<div class='diseases'>
						<input type='radio' name='face_pain' value='yes' $yes_checked> yes
						<input type='radio' name='face_pain' value='no' $no_checked> no 
					  </div>";
				
				
				// check to see if client was grinding teeth
				$stmt = $conn->prepare("SELECT teeth_grinding FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
				}
				$grinding  = $_SESSION['temp'];
				
				$yes_checked = "";
				$no_checked = "";
			
				if ($grinding == "yes") {
					$yes_checked = "checked";
				}
				else {
					$no_checked = "checked";
				}
			
				echo "<div class='diseases'>
						<input type='radio' name='grinding' value='yes' $yes_checked> yes
						<input type='radio' name='grinding' value='no' $no_checked> no 
					  </div>";
				
				
				// check to see if client had previous extractions
				$stmt = $conn->prepare("SELECT previous_extractions FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
				}
				$past_extractions  = $_SESSION['temp'];
				
				$yes_checked = "";
				$no_checked = "";
			
				if ($past_extractions == "yes") {
					$yes_checked = "checked";
				}
				else {
					$no_checked = "checked";
				}
			
				echo "<div class='diseases'>
						<input type='radio' name='past_extractions' value='yes' $yes_checked> yes
						<input type='radio' name='past_extractions' value='no' $no_checked> no 
					  </div>";
				
				
				// check to see if client had previous periodontic treatment
				$stmt = $conn->prepare("SELECT previous_periodontic_treatment FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
				}
				$periodontic_treatment  = $_SESSION['temp'];
				
				$yes_checked = "";
				$no_checked = "";
			
				if ($periodontic_treatment == "yes") {
					$yes_checked = "checked";
				}
				else {
					$no_checked = "checked";
				}
			
				echo "<div class='diseases'>
						<input type='radio' name='periodontic_treatment' value='yes' $yes_checked> yes
						<input type='radio' name='periodontic_treatment' value='no' $no_checked> no 
					  </div>";
				
			?>
		
		</div>
		
	</div>
	
	
	<!-- start of the bottom right card -->
	<div class="accountCard" style="float: left; width: 400px; height: 930px; margin-left: 5px;">
		<?php
		
			// check to see if client had current medications
			$stmt = $conn->prepare("SELECT current_medications FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			}
			$current_medications  = $_SESSION['temp'];
			
		
			// check to see if client had findings
			$stmt = $conn->prepare("SELECT findings FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			}
			$findings  = $_SESSION['temp'];
			
			
			// check to see if client had treatment notes
			$stmt = $conn->prepare("SELECT treatment FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			}
			$treatment  = $_SESSION['temp'];
		
		
			// check to see if the client's form has notes
			$stmt = $conn->prepare("SELECT notes FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			}
			$notes  = $_SESSION['temp'];
			
			
			// get the dental provider
			$stmt = $conn->prepare("SELECT dental_provider FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			}
			$dental_provider  = $_SESSION['temp'];
			
			
			// get image path
			$stmt = $conn->prepare("SELECT image_path FROM dental_form WHERE dental_form_id='$choosen_dental_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			}
			$image_path  = $_SESSION['temp'];
			
			echo "<b>Client's Phone Number: </b>" . $phone_number . "<br>";
			
			
			// see if there is an image for this form
			if($image_path != 'no_image') {
				echo "<img src='$image_path' alt='No Image' style='width:305px;height:300px;margin-left: 50px; '>";
				echo "<div style='margin-left: 60px;'>Add/Change Image <br><input type='file' name='teeth_file' id='teeth_file'><br><label style='font-size: 12px;'>(jpg, jpeg, png, or gif,  20MB max)</label> <a href='$image_path' style='color: blue;' download>Download Image</a></div><br>";
			}
			// if not, display the teeth image
			else {
				echo "<img src='/images/teeth.png' alt='No Image' style='width:305px;height:300px;margin-left: 50px; '>";
				echo "<div style='margin-left: 60px;'>Add/Change Image <br><input type='file' name='teeth_file' id='teeth_file'><br><label style='font-size: 12px;'>(jpg, jpeg, png, or gif,  20MB max)</label></div><br>";
			}
			
			
			echo "Previous Treatment/Current Medications: <br> <textarea style='height: 70px; width: 400px;' name='current_medications' class='comment_area' maxlength='255'>$current_medications</textarea><br>
			Findings: <br> <textarea style='height: 70px; width: 400px;' name='findings' class='comment_area' maxlength='255'>$findings</textarea><br>
			Treatment: <br> <textarea style='height: 70px; width: 400px;' name='treatment' class='comment_area' maxlength='255'>$treatment</textarea><br>
			Notes: <br> <textarea style='height: 70px; width: 400px;' name='notes' class='comment_area' maxlength='255'>$notes</textarea><br><br>
			
			<label style='margin-right: 10px;'>Dental Provider:</label><input list='clinician_list' name='dental_provider' value='$dental_provider' style='padding-left: 10px;height: 20px; width: 130px;' maxlength='20'> <br><br><br>
			 
					 <datalist id='clinician_list'>";
							
								
									$stmt = $conn->prepare("SELECT username FROM accounts;");
									$stmt->execute();
									$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
								
									foreach(new display_clinicians(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
										echo $v;
									}
									
							
			echo "</datalist>
			
			<input type='submit' name='submit_button' class='submitbtn' value='Submit Dental Form'>";
		
		?>
	
	</div>

	</form>
	 
 </div>
  
</body>
</html>
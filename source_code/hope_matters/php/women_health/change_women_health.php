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
	<script src="/js/women_health_validation.js" type="text/javascript"> </script>
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
        <form method="post" action="select_women_health.php">
            <input style="width: 300px;" type="submit" value="Form Selection">
        </form>
      </div>
	  
  </div>
  <br></br>
  
<!-- all cards on screen are in this div, this way everything is centered -->
<div style="width:970px; margin: 0 auto; ">
  
  <!-- begining of general info card -->
  <div class="accountCard" style="float: left; margin-right: 5px;height: 245px;" >
	<p class='p'style='color: black;font-weight:100; text-align: center;'>Client's General Info</p>
	
	
<?php
		
		require('../database_credentials.php');
		require('../date_functions.php');
		session_start();
		
		// make sure user is logged in
		login_check();
		
		$choosen_women_health_id = $_SESSION['choosen_women_health_id'];
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
		
		
		$stmt = $conn->prepare("SELECT client_id FROM women_health WHERE women_health_id='$choosen_women_health_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$client_id = $_SESSION['temp'];
		
		
		// grab the clients first name
		$stmt = $conn->prepare("SELECT first_name FROM women_health WHERE women_health_id='$choosen_women_health_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$first_name = $_SESSION['temp'];
		
		
		// grab the clients last name
		$stmt = $conn->prepare("SELECT last_name FROM women_health WHERE women_health_id='$choosen_women_health_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$last_name = $_SESSION['temp'];
		
		
		// grab the clients sex
		$stmt = $conn->prepare("SELECT sex FROM women_health WHERE women_health_id='$choosen_women_health_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$sex = $_SESSION['temp'];
		
		
		// grab the clients location
		$stmt = $conn->prepare("SELECT location FROM women_health WHERE women_health_id='$choosen_women_health_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$location = $_SESSION['temp'];
		
		
		// grab the clients date of birth
		$stmt = $conn->prepare("SELECT date_of_birth FROM women_health WHERE women_health_id='$choosen_women_health_id'");
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
	
?>
		 
</div>
  
  <!-- start of vital signs card -->
  <div class="accountCard" style="float: left; height: 245px;">
	<p class='p'style='color: black;font-weight:100; text-align: center; padding-bottom: 50px;'>Vital Signs</p>
	
	<div style=' float: left;'>
		<?php
			echo 'T:' . "<br>" . "<br>";
			echo 'BP:' . "<br>" . "<br>";
			echo 'PR:' . "<br>" . "<br>";
		?>
	</div>
	
	<form  name="women_health" action="update_women_health.php" onsubmit="return validate_form()" method="post" enctype="multipart/form-data">
	
	<div style=' float: left; padding-left: 15px;'>
	<?php
			$stmt = $conn->prepare("SELECT t FROM women_health WHERE women_health_id='$choosen_women_health_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$t = $_SESSION['temp'];
			
			$stmt = $conn->prepare("SELECT bp FROM women_health WHERE women_health_id='$choosen_women_health_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$bp = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT pr FROM women_health WHERE women_health_id='$choosen_women_health_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$pr = $_SESSION['temp'];
		
			echo "<input type='text' name='t' style='width: 100px; height: 30px;' maxlength='10' value='$t'><br>
			<input type='text' name='bp' style='width: 100px; height: 30px;' maxlength='10' value='$bp'><br>
			<input type='number' name='pr' style='width: 100px; height: 30px;' value='$pr' min='0' max='9999999999'><br>";
	?>
	</div>
	
	<div style=' float: left; padding-left: 15px;'>
		<?php
			echo 'RR' . "<br>" . "<br>";
			echo 'SaO<sub>2</sub>:' . "<br>" . "<br>";
			echo 'Pain:' . "<br>" . "<br>";
		?>
	</div>
	
	<div style=' float: left; padding-left: 15px;'>
		<?php
		
			$stmt = $conn->prepare("SELECT rr FROM women_health WHERE women_health_id='$choosen_women_health_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$rr = $_SESSION['temp'];
			
			$stmt = $conn->prepare("SELECT sao2 FROM women_health WHERE women_health_id='$choosen_women_health_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$sao2 = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT pain FROM women_health WHERE women_health_id='$choosen_women_health_id'");
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
						<input type='number' name='sao2' value='$sao2' style='width: 100px; height: 30px;' min='0' max='9999999999'><br>
						
						
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
	
  </div>
  
  
   <!-- start of bottom card -->
    <div class="accountCard" style="float: left; width: 885px; height: 1390px; position: relative;">
	
	<?php
		
		
		$stmt = $conn->prepare("SELECT lmp FROM women_health WHERE women_health_id='$choosen_women_health_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$lmp = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT menarche FROM women_health WHERE women_health_id='$choosen_women_health_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$menarche = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT g_lmp FROM women_health WHERE women_health_id='$choosen_women_health_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$g_lmp = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT t_lmp FROM women_health WHERE women_health_id='$choosen_women_health_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$t_lmp = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT p_lmp FROM women_health WHERE women_health_id='$choosen_women_health_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$p_lmp = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT l_lmp FROM women_health WHERE women_health_id='$choosen_women_health_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$l_lmp = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT family_planning FROM women_health WHERE women_health_id='$choosen_women_health_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$family_planning = $_SESSION['temp'];
		
		echo "LMP: <input type='date' name='lmp' style='width: 130px; height: 25px;' maxlength='45' value='$lmp'>
		Menarche: <input type='text' name='menarche' style='width: 75px; height: 25px;' maxlength='45' value='$menarche'>
		<label style='margin-left: 20px;'>G:</label><input type='text' name='g_lmp' style='width: 50px; height: 25px;' maxlength='45' value='$g_lmp'>
		T: <input type='text' name='t_lmp' style='width: 50px; height: 25px;' maxlength='45' value='$t_lmp'>
		P: <input type='text' name='p_lmp' style='width: 50px; height: 25px;' maxlength='45' value='$p_lmp'>
		L: <input type='text' name='l_lmp' style='width: 50px; height: 25px;' maxlength='45' value='$l_lmp'>
		<label style='margin-left: 20px;'>Family Planning:</label><input type='text' name='family_planning' style='width: 90px; height: 25px;' maxlength='45' value='$family_planning'>
			
		<br><br>";
		
		
		
		$stmt = $conn->prepare("SELECT past_cancer_screening FROM women_health WHERE women_health_id='$choosen_women_health_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$past_cancer_screening = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT life_sex_partners FROM women_health WHERE women_health_id='$choosen_women_health_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$life_sex_partners = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT year_sex_partners FROM women_health WHERE women_health_id='$choosen_women_health_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$year_sex_partners = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT cd4_count FROM women_health WHERE women_health_id='$choosen_women_health_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$cd4_count = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT history FROM women_health WHERE women_health_id='$choosen_women_health_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$history = $_SESSION['temp'];
		
		
		echo"
			Past Cancer Screening: <input type='text' name='past_cancer_screening' style='width: 500px; height: 25px;' maxlength='45' value='$past_cancer_screening'>
		
			<br><br>
		
			Lifetime Sexual Partners: <input type='number' name='life_sex_partners' style='width: 75px; height: 25px;' maxlength='45' value='$life_sex_partners'>
			<label style='margin-left: 20px;'>Sexual Partners This Year:</label> <input type='number' name='year_sex_partners' style='width: 75px; height: 25px;' maxlength='45' value='$year_sex_partners'>
			<label style='margin-left: 20px;'>Cd4 Count:</label> <input type='number' name='cd4_count' style='width: 75px; height: 25px;' maxlength='45' value='$cd4_count'>
		
			<br><br>
			
			History: <br> <textarea style='height: 90px; width: 400px;' name='history' class='comment_area' maxlength='255'>$history</textarea>
		
			<br><br>";
		
		
		
		$stmt = $conn->prepare("SELECT via_preformed FROM women_health WHERE women_health_id='$choosen_women_health_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$via_preformed = $_SESSION['temp'];
		
		
		if ($via_preformed == 'yes'){
			$checked_yes = 'checked';
		}
		else {
			$checked_no = 'checked';
		}
		
		
		echo "
			<input type='hidden' name='via_preformed' value='no' $checked_no>
			<input type='checkbox' name='via_preformed' value='yes' $checked_yes><label style='margin-right: 20px;'>VIA Preformed</label>";
			
			
		
		$stmt = $conn->prepare("SELECT cryo_preformed FROM women_health WHERE women_health_id='$choosen_women_health_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$cryo_preformed = $_SESSION['temp'];
		
		
		if ($cryo_preformed == 'yes'){
			$checked_yes = 'checked';
			$checked_no = '';
		}
		else {
			$checked_no = 'checked';
			$checked_yes = '';
		}


		echo "	<input type='hidden' name='cryo_preformed' value='no' $checked_no>
			<input type='checkbox' name='cryo_preformed' value='yes' $checked_yes><label style='margin-right: 20px;'>Cryo Preformed</label>";
		

		
		$stmt = $conn->prepare("SELECT colpo_preformed FROM women_health WHERE women_health_id='$choosen_women_health_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$colpo_preformed= $_SESSION['temp'];
		
		
		if ($colpo_preformed == 'yes'){
			$checked_yes = 'checked';
			$checked_no = '';
		}
		else {
			$checked_no = 'checked';
			$checked_yes = '';
		}
		
		
		echo "<input type='hidden' name='colpo_preformed' value='no' $checked_no>
			<input type='checkbox' name='colpo_preformed' value='yes' $checked_yes><label style='margin-right: 20px;'>Colpo Preformed</label>";
			
			
		
		$stmt = $conn->prepare("SELECT biopsies FROM women_health WHERE women_health_id='$choosen_women_health_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$biopsies = $_SESSION['temp'];
		
		
		if ($biopsies == 'yes'){
			$checked_yes = 'checked';
			$checked_no = '';
		}
		else {
			$checked_no = 'checked';
			$checked_yes = '';
			$biopsies_comment_disabled = 'disabled';
		}
		
		$stmt = $conn->prepare("SELECT biopsies_comment FROM women_health WHERE women_health_id='$choosen_women_health_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$biopsies_comment = $_SESSION['temp'];
		
			
		echo "<input type='hidden' name='biopsies' value='no' $checked_no>
			<input type='checkbox' name='biopsies' onchange='toggle_disabled_biopsies(this.checked)' value='yes' $checked_yes><label style='margin-right: 20px;' >Biopsies:</label><textarea id='biopsies_comment' style='float:right;height: 90px; width: 400px;' name='biopsies_comment' class='comment_area' maxlength='255' $biopsies_comment_disabled>$biopsies_comment</textarea>
			";
		
		
		
		?>
		
		
		
		
		<br><br><br><br><br><br><br>
		
		<?php
			$stmt = $conn->prepare("SELECT vigina_path FROM women_health WHERE women_health_id='$choosen_women_health_id';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$vigina_path = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT breast_path FROM women_health WHERE women_health_id='$choosen_women_health_id';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$breast_path = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT circle_path FROM women_health WHERE women_health_id='$choosen_women_health_id';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$circle_path = $_SESSION['temp'];
			
			
			// display the images that are a part of the form
			if ($vigina_path != 'no_image') {
				echo "<div style='height: 250px;'>
						<div style='float: left;'>
							<img src='$vigina_path' style='width: 150px; height: 150px;'><br>
							Add/Change Image <br><input type='file' name='vigina_file' id='vigina_file'><br><label style='font-size: 12px;'>(jpg, jpeg, png, or gif,  20MB max)</label><br>
							<a href='$vigina_path' style='color: blue;' download>Download Image</a>
						</div>";
			} else {
				echo "<div style='height: 250px;'>
					<div style='float: left;'>
						<img src='/images/vigina.png' style='width: 150px; height: 150px;'><br>
						Add/Change Image <br><input type='file' name='vigina_file' id='vigina_file'><br><label style='font-size: 12px;'>(jpg, jpeg, png, or gif,  20MB max)</label><br>
						<a href='/images/vigina.png' style='color: blue;' download>Download Image</a>
					</div>";
			}
			
			
			if ($breast_path != 'no_image') {
				echo   "<div style='float: left; margin-left: 50px;'>
							<img src='$breast_path' style='width: 150px; height: 150px;'><br>
							Add/Change Image <br><input type='file' name='breast_file' id='breast_file'><br><label style='font-size: 12px;'>(jpg, jpeg, png, or gif,  20MB max)</label><br>
							<a href='$breast_path' style='color: blue;' download>Download Image</a>
						</div>";
			} else {
				echo   "<div style='float: left; margin-left: 50px;'>
							<img src='/images/breast.png' style='width: 150px; height: 150px;'><br>
							Add/Change Image <br><input type='file' name='breast_file' id='breast_file'><br><label style='font-size: 12px;'>(jpg, jpeg, png, or gif,  20MB max)</label><br>
							<a href='/images/breast.png' style='color: blue;' download>Download Image</a>
						</div>";
			}
			
			
			if ($circle_path != 'no_image') {
				echo "<div style='float: left; margin-left: 50px;'>
						<img src='$circle_path' style='width: 150px; height: 150px;'><br>
						Add/Change Image <br><input type='file' name='circle_file' id='circle_file'><br><label style='font-size: 12px;'>(jpg, jpeg, png, or gif,  20MB max)</label><br>
						<a href='$circle_path' style='color: blue;' download>Download Image</a>
					</div>
				</div>";
			} else {
				echo "<div style='float: left; margin-left: 50px;'>
						<img src='/images/circle.png' style='width: 150px; height: 150px;'><br>
						Add/Change Image <br><input type='file' name='circle_file' id='circle_file'><br><label style='font-size: 12px;'>(jpg, jpeg, png, or gif,  20MB max)</label><br>
						<a href='/images/circle.png' style='color: blue;' download>Download Image</a>
					</div>
				</div>";
			}
			
		?>
		
		
		
		<?php
			
			$stmt = $conn->prepare("SELECT physical_exam_continued FROM women_health WHERE women_health_id='$choosen_women_health_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$physical_exam_continued = $_SESSION['temp'];
		
		
			echo "Physical Exam Continued: <br> <textarea style='height: 90px; width: 400px;' name='physical_exam_continued' class='comment_area' maxlength='255'>$physical_exam_continued</textarea>
				  <br><br>";
		
		
		
			$stmt = $conn->prepare("SELECT plan FROM women_health WHERE women_health_id='$choosen_women_health_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$plan = $_SESSION['temp'];
		
			echo "Plan: <input type='text' name='plan' style='width: 500px; height: 25px;' maxlength='45' value='$plan'>
				  <br><br>";
		
			
			
			$stmt = $conn->prepare("SELECT metronidazole_400mg FROM women_health WHERE women_health_id='$choosen_women_health_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$metronidazole_400mg = $_SESSION['temp'];
			
			
			if ($metronidazole_400mg == 'yes'){
				$checked_yes = 'checked';
				$checked_no = '';
			}
			else {
				$checked_no = 'checked';
				$checked_yes = '';
			}
		
			echo"<div style='float: left;'>
			<input type='hidden' name='metronidazole_400mg' value='no' $checked_no>
			<input type='checkbox' name='metronidazole_400mg' value='yes' $checked_yes><label style='margin-right: 20px;'>Metronidazole 400 mg PO BD 1/52</label> <br>
			";
		
			$stmt = $conn->prepare("SELECT metronidazole_2gm FROM women_health WHERE women_health_id='$choosen_women_health_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$metronidazole_2gm = $_SESSION['temp'];
			
			
			if ($metronidazole_2gm == 'yes'){
				$checked_yes = 'checked';
				$checked_no = '';
			}
			else {
				$checked_no = 'checked';
				$checked_yes = '';
			}
			
			echo "<input type='hidden' name='metronidazole_2gm' value='no' $checked_no>
			<input type='checkbox' name='metronidazole_2gm' value='yes' $checked_yes><label style='margin-right: 20px;'>Metronidazole 2gm PO STAT</label> <br>
			";
			
			$stmt = $conn->prepare("SELECT azithromycin FROM women_health WHERE women_health_id='$choosen_women_health_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$azithromycin = $_SESSION['temp'];
			
			
			if ($azithromycin == 'yes'){
				$checked_yes = 'checked';
				$checked_no = '';
			}
			else {
				$checked_no = 'checked';
				$checked_yes = '';
			}
			
			echo "<input type='hidden' name='azithromycin' value='no' $checked_no>
			<input type='checkbox' name='azithromycin' value='yes' $checked_yes><label style='margin-right: 20px;'>Azithromycin 1gm PO STAT</label> <br>
			";
			
			
			$stmt = $conn->prepare("SELECT ceftriaxone FROM women_health WHERE women_health_id='$choosen_women_health_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$ceftriaxone = $_SESSION['temp'];
			
			
			if ($ceftriaxone == 'yes'){
				$checked_yes = 'checked';
				$checked_no = '';
			}
			else {
				$checked_no = 'checked';
				$checked_yes = '';
			}
			
			echo "<input type='hidden' name='ceftriaxone' value='no' $checked_no>
				  <input type='checkbox' name='ceftriaxone' value='yes' $checked_yes><label style='margin-right: 20px;'>Ceftriaxone 250mg IM STAT</label> <br>";
			
			
			
			
			$stmt = $conn->prepare("SELECT fluconazole FROM women_health WHERE women_health_id='$choosen_women_health_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$fluconazole = $_SESSION['temp'];
			
			
			if ($fluconazole == 'yes'){
				$checked_yes = 'checked';
				$checked_no = '';
			}
			else {
				$checked_no = 'checked';
				$checked_yes = '';
			}
			
			echo "<input type='hidden' name='fluconazole' value='no' $checked_no>
				  <input type='checkbox' name='fluconazole' value='yes' $checked_yes><label style='margin-right: 20px;'>Fluconazole 150mg PO STAT</label> <br>";
			
			
			
			
			$stmt = $conn->prepare("SELECT clotrimazole FROM women_health WHERE women_health_id='$choosen_women_health_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$clotrimazole = $_SESSION['temp'];
			
			
			if ($clotrimazole == 'yes'){
				$checked_yes = 'checked';
				$checked_no = '';
			}
			else {
				$checked_no = 'checked';
				$checked_yes = '';
			}
			
			echo "<input type='hidden' name='clotrimazole' value='no' $checked_no>
				  <input type='checkbox' name='clotrimazole' value='yes' $checked_yes><label style='margin-right: 20px;'>Clotrimazole Cream Apply BD to Affected Area 3/7</label>
			  </div>";
			
			
			
			
			
			$stmt = $conn->prepare("SELECT lbuprofen FROM women_health WHERE women_health_id='$choosen_women_health_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$lbuprofen = $_SESSION['temp'];
			
			
			if ($lbuprofen == 'yes'){
				$checked_yes = 'checked';
				$checked_no = '';
			}
			else {
				$checked_no = 'checked';
				$checked_yes = '';
			}
			
			
			echo "<div style='float: left; '>
					<input type='hidden' name='lbuprofen' value='no' $checked_no>
					<input type='checkbox' name='lbuprofen' value='yes' $checked_yes><label style='margin-right: 20px;'>Ibuprofen 400mg PO TDS PRN Pain</label> <br>";
					
			
			
			
			
			$stmt = $conn->prepare("SELECT paracetamol FROM women_health WHERE women_health_id='$choosen_women_health_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$paracetamol = $_SESSION['temp'];
			
			
			if ($paracetamol == 'yes'){
				$checked_yes = 'checked';
				$checked_no = '';
			}
			else {
				$checked_no = 'checked';
				$checked_yes = '';
			}
			
			echo "<input type='hidden' name='paracetamol' value='no' $checked_no>
				  <input type='checkbox' name='paracetamol' value='yes' $checked_yes><label style='margin-right: 20px;'>Paracetamol 1gm PO TDS PRN Pain</label> <br>";
			
			
			
			
			
			$stmt = $conn->prepare("SELECT pyridium FROM women_health WHERE women_health_id='$choosen_women_health_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$pyridium = $_SESSION['temp'];
			
			
			if ($pyridium == 'yes'){
				$checked_yes = 'checked';
				$checked_no = '';
			}
			else {
				$checked_no = 'checked';
				$checked_yes = '';
			}
			
			echo "<input type='hidden' name='pyridium' value='no' $checked_no>
				  <input type='checkbox' name='pyridium' value='yes' $checked_yes><label style='margin-right: 20px;'>Pyridium 200mg PO TDS 3/7</label> <br>
				 ";
			
			
			
			
			
			$stmt = $conn->prepare("SELECT septrim FROM women_health WHERE women_health_id='$choosen_women_health_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$septrim = $_SESSION['temp'];
			
			
			if ($septrim == 'yes'){
				$checked_yes = 'checked';
				$checked_no = '';
			}
			else {
				$checked_no = 'checked';
				$checked_yes = '';
			}
			
			echo "<input type='hidden' name='septrim' value='no' $checked_no>
				  <input type='checkbox' name='septrim' value='yes' $checked_yes><label style='margin-right: 20px;'>Septrim 160/800mg PO BD 1/52</label> <br>
				 ";
			
			
			
			
			$stmt = $conn->prepare("SELECT amoxil FROM women_health WHERE women_health_id='$choosen_women_health_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$amoxil = $_SESSION['temp'];
			
			
			if ($amoxil == 'yes'){
				$checked_yes = 'checked';
				$checked_no = '';
			}
			else {
				$checked_no = 'checked';
				$checked_yes = '';
			}
			
			
			echo "<input type='hidden' name='amoxil' value='no' $checked_no>
				 <input type='checkbox' name='amoxil' value='yes' $checked_yes><label style='margin-right: 20px;'>Amoxil 500mg PO TDS 10/7</label> <br>
			 </div>
			
			 <br><br><br><br><br><br><br><br>";
			
			
			
			
			
			$stmt = $conn->prepare("SELECT family_planning_bottom FROM women_health WHERE women_health_id='$choosen_women_health_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$family_planning_bottom = $_SESSION['temp'];
			
			
			if ($family_planning_bottom == 'yes'){
				$checked_yes = 'checked';
				$checked_no = '';
			}
			else {
				$checked_no = 'checked';
				$checked_yes = '';
				$family_planning_comment_disabled = 'disabled';
			}
			
			$stmt = $conn->prepare("SELECT family_planning_comment FROM women_health WHERE women_health_id='$choosen_women_health_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$family_planning_comment = $_SESSION['temp'];
			
			
			echo "<input type='hidden' name='family_planning_bottom' value='no' $checked_no>
				 <input type='checkbox' name='family_planning_bottom' onchange='toggle_disabled_family_planning_bottom(this.checked)' value='yes' $checked_yes><label style='margin-right: 20px;'>
				 Family Planning: <br> <textarea rows='6' cols='55' id='family_planning_comment'  name='family_planning_comment' class='comment_area' maxlength='255' $family_planning_comment_disabled>$family_planning_comment</textarea>
				
				 <br><br>
				
				 <label>Follow Up:</label> 
				
				 <br><br>";
			
			
			
			
			$stmt = $conn->prepare("SELECT via_months FROM women_health WHERE women_health_id='$choosen_women_health_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$via_months = $_SESSION['temp'];
			
			
			if ($via_months == 'yes'){
				$checked_yes = 'checked';
				$checked_no = '';
			}
			else {
				$checked_no = 'checked';
				$checked_yes = '';
				$via_months_count_disabled = 'disabled';
			}
			
			$stmt = $conn->prepare("SELECT via_months_count FROM women_health WHERE women_health_id='$choosen_women_health_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$via_months_count = $_SESSION['temp'];
			
			
			echo "	<input type='hidden' name='via_months' value='no' $checked_no>
					<input type='checkbox' name='via_months' value='yes' onchange='toggle_disabled_via_months(this.checked)' $checked_yes>VIA in <input type='number' name='via_months_count' id='via_months_count' style='width: 75px; height: 25px;' maxlength='45' value='$via_months_count' $via_months_count_disabled><label style='margin-right: 20px;'> months</label>
				 ";
			
			
			
			
			$stmt = $conn->prepare("SELECT colposcopy FROM women_health WHERE women_health_id='$choosen_women_health_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$colposcopy = $_SESSION['temp'];
			
			
			if ($colposcopy == 'yes'){
				$checked_yes = 'checked';
				$checked_no = '';
			}
			else {
				$checked_no = 'checked';
				$checked_yes = '';
				$colposcopy_month_count_disabled = 'disabled';
			}
			
			$stmt = $conn->prepare("SELECT colposcopy_month_count FROM women_health WHERE women_health_id='$choosen_women_health_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$colposcopy_month_count = $_SESSION['temp'];
			
			
			echo "<input type='hidden' name='colposcopy' value='no' $checked_no>
				  <input type='checkbox' name='colposcopy' value='yes' onchange='toggle_disabled_colposcopy(this.checked)' $checked_yes>Colposcopy in <input type='number' name='colposcopy_month_count' id='colposcopy_month_count' style='width: 75px; height: 25px;' maxlength='45' value='$colposcopy_month_count' $colposcopy_month_count_disabled><label style='margin-right: 20px;'> months</label>
				 ";
			
			
			
			
			
			
			$stmt = $conn->prepare("SELECT biopsy_results FROM women_health WHERE women_health_id='$choosen_women_health_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$biopsy_results = $_SESSION['temp'];
			
			
			if ($biopsy_results == 'yes'){
				$checked_yes = 'checked';
				$checked_no = '';
			}
			else {
				$checked_no = 'checked';
				$checked_yes = '';
				$biopsy_results_count_disabled = 'disabled';
			}
			
			$stmt = $conn->prepare("SELECT biopsy_results_count FROM women_health WHERE women_health_id='$choosen_women_health_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$biopsy_results_count = $_SESSION['temp'];
			
			echo "<input type='hidden' name='biopsy_results' value='no' $checked_no>
				  <input type='checkbox' name='biopsy_results' value='yes' onchange='toggle_disabled_biopsy_results(this.checked)' $checked_yes>Biopsy Results in <input type='number' name='biopsy_results_count' id='biopsy_results_count' style='margin-right: 2px; width: 75px; height: 25px;' maxlength='45' value='$biopsy_results_count' $biopsy_results_count_disabled>weeks<br>
				 ";
			
			
			
			
			$stmt = $conn->prepare("SELECT referral FROM women_health WHERE women_health_id='$choosen_women_health_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$referral = $_SESSION['temp'];
			
			
			echo "Referral Made to: <input type='text' name='referral' style='width: 500px; height: 25px;' maxlength='45' value='$referral'><br>";
			
			
			
			$stmt = $conn->prepare("SELECT return_visit FROM women_health WHERE women_health_id='$choosen_women_health_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$return_visit = $_SESSION['temp'];
			
			echo "<label style='margin-right: 37px;'>Return Visit:</label> <input type='date' name='return_visit' style='width: 150px; height: 25px;' maxlength='45' value='$return_visit'><br>
				  <div style='margin-left: 290px; width: 300px;'>	<br>";
			
			
			
			$stmt = $conn->prepare("SELECT clinician FROM women_health WHERE women_health_id='$choosen_women_health_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$clinician = $_SESSION['temp'];
			
		
			 echo "<b style='margin-left: 50px;'>Clinician:</b><input list='clinician_list' name='clinician' value='$clinician' style='width: 120px;' maxlength='20'> <br>
			 
					 <datalist id='clinician_list'>";
							
								
									$stmt = $conn->prepare("SELECT username FROM accounts;");
									$stmt->execute();
									$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
								
									foreach(new display_clinicians(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
										echo $v;
									}
									
							
			 echo "</datalist>";
			
			
			
			
		?>

		<br>
			<input type="submit" name="submit_button" class="submitbtn" value="Submit Women's Health Report">
		</div>
		
	</div>
	
	</form>
	
 </div>
  
</body>
</html>
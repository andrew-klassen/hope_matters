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
	<script src="/js/dental_form_validation.js" type="text/javascript"></script>
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
        <form method="post" action="/php/view_change_any_client_forms/view_all_form.php">
            <input style="width: 300px;" type="submit" value="Client Overview">
        </form>
      </div>
	  
  </div>
  <br></br>
  
<!-- outer div, keeps everything centered -->  
<div style="width:970px; margin: 0 auto; ">
  
  <!-- start of general info card -->
  <div class="accountCard" style="float: left; margin-right: 5px; height: 245px;" >
	<p class='p'style='color: black;font-weight:100; text-align: center;'>Client's General Info</p>
	
	
<?php
		
	require('../../database_credentials.php');
	require('../../date_functions.php');
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
	
	
	// get the client's first name
	$stmt = $conn->prepare("SELECT first_name FROM general_info WHERE client_id='$choosen_client_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$first_name = $_SESSION['temp'];
	
	
	// get the client's last name
	$stmt = $conn->prepare("SELECT last_name FROM general_info WHERE client_id='$choosen_client_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$last_name = $_SESSION['temp'];
		
		
	// get the client's sex
	$stmt = $conn->prepare("SELECT sex FROM general_info WHERE client_id='$choosen_client_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$sex = $_SESSION['temp'];
		
		
	// get the client's location
	$stmt = $conn->prepare("SELECT location FROM general_info WHERE client_id='$choosen_client_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$location = $_SESSION['temp'];
		
		
	// get the client's date of birth
	$stmt = $conn->prepare("SELECT date_of_birth FROM general_info WHERE client_id='$choosen_client_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$date_of_birth = $_SESSION['temp'];
		
		
	// get the client's hiv status	
	$stmt = $conn->prepare("SELECT hiv_status FROM general_info WHERE client_id='$choosen_client_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$hiv_status = $_SESSION['temp'];
		
		
	// get the client's phone number	
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
  
  
<!-- start of vital signs card -->
<div class="accountCard" style="float: left; height: 245px;">
	<p class='p' style='color: black;font-weight:100; text-align: center; padding-bottom: 50px;'>Vital Signs</p>
	
	<div style=' float: left;'>
		<?php
			echo 'T:' . "<br>" . "<br>";
			echo 'BP:' . "<br>" . "<br>";
			echo 'PR:' . "<br>" . "<br>";
		?>
	</div>
	
	<form  name="dental_form" action="insert_dental_form.php" onsubmit="return validate_form()" method="post" enctype="multipart/form-data">
	
	<div style=' float: left; padding-left: 15px;'>
		<input type="text" name="t" style="width: 100px; height: 30px;" maxlength="10" autofocus onfocus='this.value = this.value;'><br>
		<input type="text" name="bp" style="width: 100px; height: 30px;" maxlength="10"><br>
		<input type="number" name="pr" style="width: 100px; height: 30px;" min="0" max="9999999999"><br>
	</div>
	
	<div style=' float: left; padding-left: 15px;'>
		<?php
			echo 'RR:' . "<br>" . "<br>";
			echo 'WT:' . "<br>" . "<br>";
			echo 'Pain:' . "<br>" . "<br>";
		?>
	</div>
	
	<div style=' float: left; padding-left: 15px;'>
		<input type="number" name="rr" style="width: 100px; height: 30px;" min="0" max="9999999999"><br>
		<input type="number" name="wt" style="width: 100px; height: 30px;" min="0" max="9999999999"><br>
			
		<div style=' float: left;'>
			<input type="radio" name="pain" value="none" checked> none <br>
			<input type="radio" name="pain" value="mild"> mild 
		</div>
			
		<div style=' float: left;'>
			<input type="radio" name="pain" value="moderate"> moderate <br>
			<input type="radio" name="pain" value="severe"> severe
		</div>
	</div>
</div>


<!-- start of medical history card -->
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
			<div class='diseases'>
				<input  type="radio" name="latex_glove_allergy" value="yes"> yes
				<input  type="radio" name="latex_glove_allergy" value="no" checked> no
			</div>
			
			<div class='diseases'>
				<input type="radio" name="ulcers" value="yes"> yes
				<input type="radio" name="ulcers" value="no" checked> no 
			</div>
			
			<div class='diseases'>
				<input type="radio" name="diabetes" value="yes"> yes
				<input type="radio" name="diabetes" value="no" checked> no 
			</div>
			
			<div class='diseases'>
				<input type="radio" name="epilepsy" value="yes"> yes
				<input type="radio" name="epilepsy" value="no" checked> no 
			</div>
			
			<div class='diseases'>
				<input type="radio" name="hemophilia" value="yes"> yes
				<input type="radio" name="hemophilia" value="no" checked> no 
			</div>
			
			<div class='diseases'>
				<input type="radio" name="pregnant" value="yes"> yes
				<input type="radio" name="pregnant" value="no" checked> no 
			</div>
			
			<div class='diseases'>
				<input type="radio" name="herbs" value="yes"> yes
				<input type="radio" name="herbs" value="no" checked> no 
			</div>
			
			<div class='diseases'>
				<input type="radio" name="heart_problem" value="yes"> yes
				<input type="radio" name="heart_problem" value="no" checked> no 
			</div>
			
			<div class='diseases'>
				<input type="radio" name="hepatitis" value="yes"> yes
				<input type="radio" name="hepatitis" value="no" checked> no 
			</div>
			
			<div class='diseases'>
				<input type="radio" name="cough" value="yes"> yes
				<input type="radio" name="cough" value="no" checked> no 
			</div>
			
			<div class='diseases'>
				<input type="radio" name="tuberculosis" value="yes"> yes
				<input type="radio" name="tuberculosis" value="no" checked> no 
			</div>
			
			<div class='diseases'>
				<input type="radio" name="asthma" value="yes"> yes
				<input type="radio" name="asthma" value="no" checked> no 
			</div>
			
			<!-- start of medical history card -->
			<div class='diseases'>
				<?php
				
					if ($hiv_status == 'unknown'){
						echo "<b style='font-size: 105%; text-align: center;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; no</b>" . "<br>";
					}
					else{
						echo "<b style='font-size: 105%; text-align: center;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; yes</b>" . "<br>";
					}
				?>
			</div>
			
			<div class='diseases'>
				<input type="radio" name="fainting" value="yes"> yes
				<input type="radio" name="fainting" value="no" checked> no 
			</div>
		
			<div class='diseases'>
				<input type="radio" name="family_pills" value="yes"> yes
				<input type="radio" name="family_pills" value="no" checked> no 
			</div>
			
			<div class='diseases'>
				<input type="radio" name="blood_thinners" value="yes"> yes
				<input type="radio" name="blood_thinners" value="no" checked> no 
			</div>
			
			<div class='diseases'>
				<input type="radio" name="blood_pressure" value="yes"> yes
				<input type="radio" name="blood_pressure" value="no" checked> no 
			</div>
			
			<div class='diseases'>
				<input type="radio" name="anemia" value="yes"> yes
				<input type="radio" name="anemia" value="no" checked> no 
			</div>
			<br>
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
		
		<div style=' float: left; padding-left: 65px;'>
			<div class='diseases'>
				<input  type="radio" name="penicillin" value="yes"> yes
				<input  type="radio" name="penicillin" value="no" checked> no 
			</div>
			
			<div class='diseases'>
				<input type="radio" name="codenine" value="yes"> yes
				<input type="radio" name="codenine" value="no" checked> no 
			</div>
			
			<div class='diseases'>
				<input type="radio" name="local_anesthesia" value="yes"> yes
				<input type="radio" name="local_anesthesia" value="no" checked> no 
			</div>
			
			<div class='diseases'>
				<input type="radio" name="sulfur" value="yes"> yes
				<input type="radio" name="sulfur" value="no" checked> no 
			</div>
			
			<div class='diseases'>
				<input type="radio" name="aspirin" value="yes"> yes
				<input type="radio" name="aspirin" value="no" checked> no 
			</div>
			
			<div class='diseases'>
				<input style='height: 20px; width: 130px;'type="text" name="other" maxlength="20"> 
			</div>
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
			<div style=' float: right; '>
				<?php
						echo "<div class='diseases' style='width: 84px; float: left;'><input type='checkbox' name='hot' value='yes'>Hot</div>
							  <div class='diseases' style='width: 85px; float: right;'><input style='width: 15px;' type='checkbox' name='cold' value='yes'>Cold</div> ";
				?>
			</div>
			
			<div style=' float: right; '>
				<?php
					echo "<div class='diseases' style='width: 85px; float: left;'><input style='width: 15px;' type='checkbox' name='biting' value='yes'>Biting</div>
						  <div class='diseases' style='width: 85px; float: right;'><input style='width: 15px;' type='checkbox' name='sweet' value='yes'>Sweets</div> <br>";
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
		
		<div style=' float: left; padding-left: 30px;'>
			<div class='diseases'>
				<input  type="radio" name="gums_painful" value="yes"> yes
				<input  type="radio" name="gums_painful" value="no" checked> no 
			</div>
			
			<div class='diseases'>
				<input type="radio" name="gums_bleed" value="yes"> yes
				<input type="radio" name="gums_bleed" value="no" checked> no 
			</div>
			
			<div class='diseases'>
				<input type="radio" name="loose_teeth" value="yes"> yes
				<input type="radio" name="loose_teeth" value="no" checked> no 
			</div>
			
			<div class='diseases'>
				<input type="radio" name="jaw" value="yes"> yes
				<input type="radio" name="jaw" value="no" checked> no 
			</div>
			
			<div class='diseases'>
				<input type="radio" name="face_pain" value="yes"> yes
				<input type="radio" name="face_pain" value="no" checked> no 
			</div>
			
			<div class='diseases'>
				<input type="radio" name="grinding" value="yes"> yes
				<input type="radio" name="grinding" value="no" checked> no 
			</div>
			
			<div class='diseases'>
				<input type="radio" name="past_extractions" value="yes"> yes
				<input type="radio" name="past_extractions" value="no" checked> no 
			</div>
			
			<div class='diseases'>
				<input type="radio" name="periodontic_treatment" value="yes"> yes
				<input type="radio" name="periodontic_treatment" value="no" checked> no 
			</div>
		
		</div>

</div>
	
	
<!-- begining of bottom right card -->
<div class="accountCard" style="float: left; width: 400px; height: 930px; margin-left: 5px;">
	<?php
		echo "<b>Client's Phone Number: </b>" . $phone_number . "<br>" .
		"<img src='/images/teeth.png' alt='Teeth' style='width:305px;height:300px;margin-left: 50px; '>
		 <div style='margin-left: 60px;'>Add/Change Image <br><input type='file' name='teeth_file' id='teeth_file'><br><label style='font-size: 12px;'>(jpg, jpeg, png, or gif,  20MB max)</label></div><br>";
	?>
		
		
	Previous Treatment/Current Medications: <br> <textarea style="height: 70px; width: 400px;" name="current_medications" class="comment_area" maxlength="255"></textarea><br>
	Findings: <br> <textarea style="height: 70px; width: 400px;" name="findings" class="comment_area" maxlength="255"></textarea><br>
	Treatment: <br> <textarea style="height: 70px; width: 400px;" name="treatment" class="comment_area" maxlength="255"></textarea><br>
	Notes: <br> <textarea style="height: 70px; width: 400px;" name="notes" class="comment_area" maxlength="255"></textarea><br><br>
	
	<?php
			  
		echo "<label style='margin-right: 10px;'>Dental Provider:</label><input list='clinician_list' name='dental_provider' value='$username' style='padding-left: 10px;height: 20px; width: 130px;' maxlength='20'> <br><br><br>
			 
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
	</form>

</div>
 

<!-- end of outer div -->
</div>

</body>
</html>
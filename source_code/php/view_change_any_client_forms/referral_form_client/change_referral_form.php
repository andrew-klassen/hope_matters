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
        <form method="post" action="/php/view_change_any_client_forms/view_all_form.php">
            <input style="width: 300px;" type="submit" value="Client Overview">
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
		
		require('../../database_credentials.php');
		require('../../date_functions.php');
		session_start();
		
		// make sure user is logged in
		login_check();
		
		$choosen_referral_form_id = $_SESSION['choosen_referral_form_id'];
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
		
		
		
		// grab the clients ID
		$stmt = $conn->prepare("SELECT client_id FROM referral_form WHERE referral_form_id='$choosen_referral_form_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$client_id = $_SESSION['temp'];
		
		
		// grab the clients first name
		$stmt = $conn->prepare("SELECT first_name FROM referral_form WHERE referral_form_id='$choosen_referral_form_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$first_name = $_SESSION['temp'];
		
		
		// grab the clients last name
		$stmt = $conn->prepare("SELECT last_name FROM referral_form WHERE referral_form_id='$choosen_referral_form_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$last_name = $_SESSION['temp'];
		
		
		// grab the clients sex
		$stmt = $conn->prepare("SELECT sex FROM referral_form WHERE referral_form_id='$choosen_referral_form_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$sex = $_SESSION['temp'];
		
		
		// grab the clients location
		$stmt = $conn->prepare("SELECT location FROM referral_form WHERE referral_form_id='$choosen_referral_form_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$location = $_SESSION['temp'];
		
		
		// grab the clients date of birth
		$stmt = $conn->prepare("SELECT date_of_birth FROM referral_form WHERE referral_form_id='$choosen_referral_form_id'");
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
			echo 'PR:' ;
		?>
	</div>
	
	<form  name="vital_signs_form" action="update_referral_form.php" onsubmit="return validate_form()" method="post">
	
	<div style=' float: left; padding-left: 15px;'>
		<?php
		
			$stmt = $conn->prepare("SELECT t FROM referral_form WHERE referral_form_id='$choosen_referral_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
			}
			$t = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT bp FROM referral_form WHERE referral_form_id='$choosen_referral_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
			}
			$bp = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT pr FROM referral_form WHERE referral_form_id='$choosen_referral_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
			}
			$pr = $_SESSION['temp'];
		
		
		
			echo "<input type='text' name='t' style='width: 100px; height: 30px;' value='$t' maxlength='10'><br>
			<input type='text' name='bp' style='width: 100px; height: 30px;' value='$bp' maxlength='10'><br>
			<input type='number' name='pr' style='width: 100px; height: 30px;' value='$pr' min='0' max='9999999999'>";
		?>
	</div>
	
	<div style=' float: left; padding-left: 15px;'>
		<?php
			echo 'RR:' . "<br>" . "<br>";
			echo 'SaO<sub>2</sub>:' . "<br>" . "<br>";
			echo 'Pain:'  ;
		?>
	</div>
	
	<div style=' float: left; padding-left: 15px;'>
		
		<?php
			
			$stmt = $conn->prepare("SELECT rr FROM referral_form WHERE referral_form_id='$choosen_referral_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
			}
			$rr = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT sao2 FROM referral_form WHERE referral_form_id='$choosen_referral_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
			}
			$sao2 = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT pain FROM referral_form WHERE referral_form_id='$choosen_referral_form_id'");
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
			
			
			echo"<input type='text' name='rr' style='width: 100px; height: 30px;' value='$rr' maxlength='10'><br>
			<input type='number' name='sao2' style='width: 100px; height: 30px;' value='$sao2' min='0' max='9999999999'><br>
			
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
    <div class="accountCard" style="float: left; width: 885px; height: 460px; position: relative;">
	
		
		
		<?php
			
			$stmt = $conn->prepare("SELECT referred_to FROM referral_form WHERE referral_form_id='$choosen_referral_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
			}
			$referred_to = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT history FROM referral_form WHERE referral_form_id='$choosen_referral_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
			}
			$history = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT treatment FROM referral_form WHERE referral_form_id='$choosen_referral_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
			}
			$treatment = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT reason_for_referral FROM referral_form WHERE referral_form_id='$choosen_referral_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
			}
			$reason_for_referral = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT clinician FROM referral_form WHERE referral_form_id='$choosen_referral_form_id'");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
			}
			$clinician = $_SESSION['temp'];
			
		
			echo "<div style='margin-left: 220px;'>
					Refered to: <input type='text' name='referred_to' style='width: 300px; height: 25px;' maxlength='45' value='$referred_to'><br>
				</div>
			
				<div style=' float: left; margin-left: 15px; position: relative;'>
					
					<div style='position: absolute; top: 60px; '>
						History: <br> <textarea name='history' style='height: 90px; width: 400px;' class='comment_area' maxlength='255'>$history</textarea><br><br>
					</div>
					
					<div style='position: absolute; top: 190px; '>
						Treatment Completed: <br> <textarea style='height: 90px; width: 400px;' name='treatment' class='comment_area' maxlength='255'>$treatment</textarea><br><br>
					</div>
					
				</div>
				
				<div style=' float: left; margin-left: 470px; position: relative;'>
					
					<div style='position: absolute; top: 60px; '>
						Reason for Referral/Service Requested: <br> <textarea style='height: 90px; width: 400px;' name='reason_for_referral' class='comment_area' maxlength='255'>$reason_for_referral</textarea><br><br>
					</div>
			
				</div>
			 <b style='text-align: center; position: absolute; top: 420px; left: 400px '>Clinician:</b><input list='clinician_list' name='clinician' value='$clinician' style='width: 140px; height: 20px; padding-left: 10px; position: absolute; top: 415px; left: 480px ' maxlength='20'> <br>
			 
					 <datalist id='clinician_list'>";
							
								
									$stmt = $conn->prepare("SELECT username FROM accounts;");
									$stmt->execute();
									$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
								
									foreach(new display_clinicians(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
										echo $v;
									}
									
							
			 echo "</datalist>";
			
		?>
		
		<div style="position: absolute; top: 460px; left: 420px;">		
			<input type="submit" name="submit_button" class="submitbtn" value="Submit Refferal Form">
		</div>
		
	</div>
	
	</form>
	
		<div style="float: left; margin-top: 50px;">
			<p class="only_print" style="margin-left: 350px; color: white; font-size: 40px;">Village of Hope</p>
		</div>
	
 </div>
  
</body>
</html>
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
        <form method="post" action="select_discharge_form.php">
            <input style="width: 300px;" type="submit" value="Form Selection">
        </form>
      </div>
	  
</div>
<br></br>
  
<!-- all cards on screen are in this div, this way everything is centered -->
<div style="width:1100px; margin: 0 auto; ">
  
  <!-- start of general info card -->
  <div class="accountCard" style="float: left; margin-right: 5px; height: 245px;" >
	<p class='p'style='color: black;font-weight:100; text-align: center;'>Client's General Info</p>
	

<?php
		
		require('../database_credentials.php');
		require('../date_functions.php');
		session_start();
		
		// make sure user is logged in
		login_check();
		
		$choosen_discharge_form_id = $_SESSION['choosen_discharge_form_id'];
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
		
		// make the database connection
		$conn = new PDO($dbconnection, $dbusername, $dbpassword);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		
		// get the client id
		$stmt = $conn->prepare("SELECT client_id FROM discharge_form WHERE discharge_form_id='$choosen_discharge_form_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$client_id = $_SESSION['temp'];
		
		
		// get the client's first name
		$stmt = $conn->prepare("SELECT first_name FROM discharge_form WHERE discharge_form_id='$choosen_discharge_form_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$first_name = $_SESSION['temp'];
		
		
		// get the client's last name
		$stmt = $conn->prepare("SELECT last_name FROM discharge_form WHERE discharge_form_id='$choosen_discharge_form_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$last_name = $_SESSION['temp'];
		
		
		// get the client's sex
		$stmt = $conn->prepare("SELECT sex FROM discharge_form WHERE discharge_form_id='$choosen_discharge_form_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$sex = $_SESSION['temp'];
		
		
		// get the client's location
		$stmt = $conn->prepare("SELECT location FROM discharge_form WHERE discharge_form_id='$choosen_discharge_form_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$location = $_SESSION['temp'];
		
		
		// get the client's date of birth
		$stmt = $conn->prepare("SELECT date_of_birth FROM discharge_form WHERE discharge_form_id='$choosen_discharge_form_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$date_of_birth = $_SESSION['temp'];
		
		
		// get the client's age
		$age = get_age_from_date_of_birth($date_of_birth);
		
		
		// get the client's t
		$stmt = $conn->prepare("SELECT t FROM discharge_form WHERE discharge_form_id='$choosen_discharge_form_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$t = $_SESSION['temp'];
		
		
		// get the client's bp
		$stmt = $conn->prepare("SELECT bp FROM discharge_form WHERE discharge_form_id='$choosen_discharge_form_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$bp = $_SESSION['temp'];
		
		
		// get the client's pr
		$stmt = $conn->prepare("SELECT pr FROM discharge_form WHERE discharge_form_id='$choosen_discharge_form_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$pr = $_SESSION['temp'];
		
		
		// get the client's sao2
		$stmt = $conn->prepare("SELECT sao2 FROM discharge_form WHERE discharge_form_id='$choosen_discharge_form_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$sao2 = $_SESSION['temp'];
		
		
		// get the client's pain
		$stmt = $conn->prepare("SELECT pain FROM discharge_form WHERE discharge_form_id='$choosen_discharge_form_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$pain = $_SESSION['temp'];
		
		
		// get the client's doa
		$stmt = $conn->prepare("SELECT doa FROM discharge_form WHERE discharge_form_id='$choosen_discharge_form_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$doa = $_SESSION['temp'];
		
		
		// get the client's dod
		$stmt = $conn->prepare("SELECT dod FROM discharge_form WHERE discharge_form_id='$choosen_discharge_form_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$dod = $_SESSION['temp'];
		
		
		// get the client's history
		$stmt = $conn->prepare("SELECT history FROM discharge_form WHERE discharge_form_id='$choosen_discharge_form_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$history = $_SESSION['temp'];
		
		
		// get the client's physical examination
		$stmt = $conn->prepare("SELECT physical_examination FROM discharge_form WHERE discharge_form_id='$choosen_discharge_form_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$physical_examination = $_SESSION['temp'];
		
		
		// get the client's impression
		$stmt = $conn->prepare("SELECT impression FROM discharge_form WHERE discharge_form_id='$choosen_discharge_form_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$impression = $_SESSION['temp'];
		
		
		// get the client's plan
		$stmt = $conn->prepare("SELECT plan FROM discharge_form WHERE discharge_form_id='$choosen_discharge_form_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$plan = $_SESSION['temp'];
		
		
		// get the client's discharge summary
		$stmt = $conn->prepare("SELECT discharge_summary FROM discharge_form WHERE discharge_form_id='$choosen_discharge_form_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$discharge_summary = $_SESSION['temp'];
		
		
		// get the client's clinician
		$stmt = $conn->prepare("SELECT clinician FROM discharge_form WHERE discharge_form_id='$choosen_discharge_form_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$clinician = $_SESSION['temp'];
		
		
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
	
	<form  name="discharge_form" action="update_discharge_form.php" onsubmit="return validate_form()" method="post">
	
	<div style=' float: left; padding-left: 15px;'>
			<?php
				echo "<input type='text' name='t' style='width: 100px; height: 30px;' value='$t' maxlength='10'><br>
				<input type='text' name='bp' style='width: 100px; height: 30px;' value='$bp' maxlength='10'><br>
				<input type='number' name='pr' style='width: 100px; height: 30px;' value='$pr' min='0' max='9999999999'><br>";
			?>
	</div>
	
	<div style=' float: left; padding-left: 15px;'>
		<?php
			echo 'SaO<sub>2</sub>:' . "<br>" . "<br>";		
			echo 'Pain:' . "<br>" . "<br>";
		?>
	</div>
	
	<div style=' float: left; padding-left: 15px;'>
			<?php
				echo "<input type='number' name='sao2' style='width: 100px; height: 30px;' value='$sao2' min='0' max='9999999999'><br>";
				
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
		
				echo "
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
  
	<!-- start of the bottom card -->
    <div class="accountCard" style="float: left; width: 885px; height: 460px; position: relative;">
		
		<div style=' float: left; padding-left: 15px; position: relative;'>		
			
			<div style=' float: left; margin-top: 5px;'>	
				<span>D.O.A:</span><br><br>
				<span>D.O.D:</span>
			</div>
			
			<?php	
				echo "<div style=' float: left; padding-left: 15px;'>
					<input type='date' name='doa' style='width: 140px; height: 30px;' maxlength='15' value='$doa'> <br>
					<input type='date' name='dod' style='width: 140px; height: 30px;' maxlength='15' value='$dod'> <br>
				</div>
		
		
				<div style='position: absolute; top: 90px; '>
					History: <br> <textarea style='height: 90px; width: 400px;' name='history' class='comment_area' maxlength='255'>$history</textarea><br><br>
				</div>
			
				<div style='position: absolute; top: 220px; '>
					Physical Examination: <br> <textarea style='height: 90px; width: 400px;' name='physical_examination' class='comment_area' maxlength='255'>$physical_examination</textarea><br><br>
				</div>";
			?>
		</div>
		
		<?php
			echo "<div style=' float: left; margin-left: 245px; position: relative;'>
					<div style='position: absolute; top: 0px; '>
						Impression: <br> <textarea style='height: 45px; width: 400px;' name='impression' class='comment_area' maxlength='255'>$impression</textarea><br><br>
					</div>
				
					<div style='position: absolute; top: 90px; '>
						Plan: <br> <textarea style='height: 90px; width: 400px;' name='plan' class='comment_area' maxlength='255'>$plan</textarea><br><br>
					</div>
				
					<div style='position: absolute; top: 220px; '>
						Discharge Summary: <br> <textarea style='height: 90px; width: 400px;' name='discharge_summary' class='comment_area' maxlength='255'>$discharge_summary</textarea><br><br>
					</div>
			
					</div>";
			
			echo "<label style='position: absolute; top: 420px; left: 370px;'>Clinician:</label><input list='clinician_list' name='clinician' value='$clinician' style='width: 140px;padding-left: 10px; position: absolute; top: 420px; left: 440px;' maxlength='20'> <br>
			 
					 <datalist id='clinician_list'>";
							
								
									$stmt = $conn->prepare("SELECT username FROM accounts;");
									$stmt->execute();
									$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
								
									foreach(new display_clinicians(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
										echo $v;
									}
									
							
			echo "</datalist>";
		?>
		
		<div style="position: absolute; top: 460px; left: 398px;">		
			<input type="submit" name="submit_button" class="submitbtn" value="Submit Discharge Form">
		</div>
		
	</div>

	</form>
  
</div>
  
</body>
</html>
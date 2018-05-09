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
	<link rel="stylesheet" type="text/css" href="/css/ultrasound.css">
	<script src="/js/ultrasound_validation.js" type="text/javascript"> </script>
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
        <form method="post" action="select_client_ultrasound.php">
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
	
	<form  name="vital_signs_form" action="insert_ultrasound.php" onsubmit="return validate_form()" method="post" enctype="multipart/form-data">
	
	<div style=' float: left; padding-left: 15px;'>
			<input type="text" name="t" style="width: 100px; height: 30px;" maxlength="10" autofocus onfocus='this.value = this.value;'><br>
			<input type="text" name="bp" style="width: 100px; height: 30px;" maxlength="10"><br>
			<input type="number" name="pr" style="width: 100px; height: 30px;" min="0" max="9999999999">
	</div>
	
	<div style=' float: left; padding-left: 15px;'>
		<?php
			echo 'RR:' . "<br>" . "<br>";
			echo 'SaO<sub>2</sub>:' . "<br>" . "<br>";
			echo 'Pain:'  ;
		?>
	</div>
	
	<div style=' float: left; padding-left: 15px;'>
			<input type="text" name="rr" style="width: 100px; height: 30px;" maxlength="10"><br>
			<input type="number" name="sao2" style="width: 100px; height: 30px;" min="0" max="9999999999"><br>
			
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
  
  
   <!-- start of bottom card -->
    <div class="accountCard" style="float: left; width: 885px; height: 840px; position: relative;">
	
			LMP: <input type="date" name="lmp" style="width: 130px; height: 25px;" maxlength="45">
			Weeks Pregnant: <input type="number" name="weeks_pregnant" style="width: 75px; height: 25px;" min="0" max="99999">
			Days Pregnant: <input type="number" name="days_pregnant" style="width: 75px; height: 25px; margin-right: 10px;" min="0" max="99999">
			
			G: <input type="text" name="g_lmp" style="width: 50px; height: 25px;" maxlength="45">
			T: <input type="text" name="t_lmp" style="width: 50px; height: 25px;" maxlength="45">
			P: <input type="text" name="p_lmp" style="width: 50px; height: 25px;" maxlength="45">
			L: <input type="text" name="l_lmp" style="width: 50px; height: 25px;" maxlength="45">
			
			<br><br>
			
			Significant History: <br> <textarea style="height: 90px; width: 400px;" name="significant_history" class="comment_area" maxlength="255"></textarea>
			
			<br><br>
			
			Ultrasound Findings: <input type="text" name="ultrasound_findings" style="width: 500px; height: 25px;" maxlength="45">
			
			<br>
			
			Fetal Number Detected: <input type="text" name="fetal_number" style="width: 500px; height: 25px;" maxlength="45">
			
			<br><br>
			
			<p class='p'style='color: black; text-align: center;'>Select a presentation before providing the baby's information.</p>
			
			
			<ul class="tab">
			  <li><a href="javascript:void(0)" class="tablinks" onclick="open_baby_tab(event, 'baby_1')" id="default_open">Baby 1</a></li>
			  <li><a href="javascript:void(0)" class="tablinks" onclick="open_baby_tab(event, 'baby_2')">Baby 2</a></li>
			  <li><a href="javascript:void(0)" class="tablinks" onclick="open_baby_tab(event, 'baby_3')">Baby 3</a></li>
			  <li><a href="javascript:void(0)" class="tablinks" onclick="open_baby_tab(event, 'baby_4')">Baby 4</a></li>
			</ul>

			<div id="baby_1" class="tabcontent">
			  <span onclick="this.parentElement.style.display='none'" class="topright">Close Tab</span>
				
				<label style="margin-right: 50px;">Presentation:</label>
				<input onchange="disabled_baby_1(this.checked)" type="radio" name="presentation_baby_1" value="none" checked>none
				<input onchange="enable_baby_1(this.checked)" type="radio" name="presentation_baby_1" value="cephalic">Cephalic
				<input onchange="enable_baby_1(this.checked)" type="radio" name="presentation_baby_1" value="breech">Breech
				<input onchange="enable_baby_1(this.checked)" type="radio" name="presentation_baby_1" value="transverse">Transverse
				
				<br><br>
				
				Placenta: <input type="text" id="placenta_baby_1" name="placenta_baby_1" style="width: 500px; height: 25px;" maxlength="45" disabled>
				
				<br>
				
				Fetal Movement: <input type="text" id="fetal_movement_baby_1" name="fetal_movement_baby_1" style="width: 500px; height: 25px;" maxlength="45" disabled>
				
				<br>
				
				Fetal Heartbeat: <input type="text" id="fetal_heartbeat_baby_1" name="fetal_heartbeat_baby_1" style="width: 500px; height: 25px;" maxlength="45" disabled>
				
				<br>
				
				Amniotic Fluid: <input type="text" id="amniotic_fluid_baby_1" name="amniotic_fluid_baby_1" style="width: 500px; height: 25px;" maxlength="45" disabled>
				
			</div>

			<div id="baby_2" class="tabcontent">
			  <span onclick="this.parentElement.style.display='none'" class="topright">Close Tab</span>
				
				<label style="margin-right: 50px;">Presentation:</label>
				<input onchange="disabled_baby_2(this.checked)" type="radio" name="presentation_baby_2" value="none" checked>none
				<input onchange="enable_baby_2(this.checked)" type="radio" name="presentation_baby_2" value="cephalic">Cephalic
				<input onchange="enable_baby_2(this.checked)" type="radio" name="presentation_baby_2" value="breech">Breech
				<input onchange="enable_baby_2(this.checked)" type="radio" name="presentation_baby_2" value="transverse">Transverse
				
				<br><br>
				
				Placenta: <input type="text" id="placenta_baby_2" name="placenta_baby_2" style="width: 500px; height: 25px;" maxlength="45" disabled>
				
				<br>
				
				Fetal Movement: <input type="text" id="fetal_movement_baby_2" name="fetal_movement_baby_2" style="width: 500px; height: 25px;" maxlength="45" disabled>
				
				<br>
				
				Fetal Heartbeat: <input type="text" id="fetal_heartbeat_baby_2" name="fetal_heartbeat_baby_2" style="width: 500px; height: 25px;" maxlength="45" disabled>
				
				<br>
				
				Amniotic Fluid: <input type="text" id="amniotic_fluid_baby_2" name="amniotic_fluid_baby_2" style="width: 500px; height: 25px;" maxlength="45" disabled>
			</div>

			<div id="baby_3" class="tabcontent">
			  <span onclick="this.parentElement.style.display='none'" class="topright">Close Tab</span>
				
				<label style="margin-right: 50px;">Presentation:</label>
				<input onchange="disabled_baby_3(this.checked)" type="radio" name="presentation_baby_3" value="none" checked>none
				<input onchange="enable_baby_3(this.checked)" type="radio" name="presentation_baby_3" value="cephalic">Cephalic
				<input onchange="enable_baby_3(this.checked)" type="radio" name="presentation_baby_3" value="breech">Breech
				<input onchange="enable_baby_3(this.checked)" type="radio" name="presentation_baby_3" value="transverse">Transverse
				
				<br><br>
				
				Placenta: <input type="text" id="placenta_baby_3" name="placenta_baby_3" style="width: 500px; height: 25px;" maxlength="45" disabled>
				
				<br>
				
				Fetal Movement: <input type="text" id="fetal_movement_baby_3" name="fetal_movement_baby_3" style="width: 500px; height: 25px;" maxlength="45" disabled>
				
				<br>
				
				Fetal Heartbeat: <input type="text" id="fetal_heartbeat_baby_3" name="fetal_heartbeat_baby_3" style="width: 500px; height: 25px;" maxlength="45" disabled>
				
				<br>
				
				Amniotic Fluid: <input type="text" id="amniotic_fluid_baby_3" name="amniotic_fluid_baby_3" style="width: 500px; height: 25px;" maxlength="45" disabled>
			</div>
			
			<div id="baby_4" class="tabcontent">
			  <span onclick="this.parentElement.style.display='none'" class="topright">Close Tab</span>
			  <label style="margin-right: 50px;">Presentation:</label>
				<input onchange="disabled_baby_4(this.checked)" type="radio" name="presentation_baby_4" value="none" checked>none
				<input onchange="enable_baby_4(this.checked)" type="radio" name="presentation_baby_4" value="cephalic">Cephalic
				<input onchange="enable_baby_4(this.checked)" type="radio" name="presentation_baby_4" value="breech">Breech
				<input onchange="enable_baby_4(this.checked)" type="radio" name="presentation_baby_4" value="transverse">Transverse
				
				<br><br>
				
				Placenta: <input type="text" id="placenta_baby_4" name="placenta_baby_4" style="width: 500px; height: 25px;" maxlength="45" disabled>
				
				<br>
				
				Fetal Movement: <input type="text" id="fetal_movement_baby_4" name="fetal_movement_baby_4" style="width: 500px; height: 25px;" maxlength="45" disabled>
				
				<br>
				
				Fetal Heartbeat: <input type="text" id="fetal_heartbeat_baby_4" name="fetal_heartbeat_baby_4" style="width: 500px; height: 25px;" maxlength="45" disabled>
				
				<br>
				
				Amniotic Fluid: <input type="text" id="amniotic_fluid_baby_4" name="amniotic_fluid_baby_4" style="width: 500px; height: 25px;" maxlength="45" disabled>
			</div>
			
			
			<script>
				document.getElementById("default_open").click();
			</script>
						
			
			<br><br>
			
			
			EDD per Ultrasound Measurements: <input type="text" name="edd_per_ultrasound" style="width: 500px; height: 25px;" maxlength="45">
			
			<br><br>
			
			<div style="float: left; width: 1000px; margin-bottom: 20px;">
				<div style="float: left; margin-right: 150px;">
					Other Findings: <br> <textarea style="height: 90px; width: 400px;" name="other_findings" class="comment_area" maxlength="65535"></textarea> 
				</div>
			
				<div style="margin-top: 20px;">
					Add Image/Images <br><input type='file' name='ultrasound_images' id='ultrasound_images'><br><label style='font-size: 12px;'>If you have more than one image concatenate your images<br>into an archive file. (40 MB max)</label>
				</div>
			</div>
		
		<div style="margin-left: 340px;">
			<?php
				 echo "<b>Clinician:</b><input list='clinician_list' name='clinician' value='$username' style='width: 120px;' maxlength='20'> <br>
				 
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
				<input style="margin-left: 10px; width: 170px;"type="submit" name="submit_button" class="submitbtn" value="Submit Ultrasound">
		</div>
		
		</div>
		
	</div>
	
	</form>
	
 </div>
  
</body>
</html>
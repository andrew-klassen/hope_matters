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
        <form method="post" action="/php/view_change_any_client_forms/view_all_form.php">
            <input style="width: 300px;" type="submit" value="Client Overview">
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
	<p class='p'style='color: black;font-weight:100; text-align: center;padding-bottom: 50px;'>Vital Signs</p>
	
	<div style=' float: left;'>
		<?php
			echo 'T:' . "<br>" . "<br>";
			echo 'BP:' . "<br>" . "<br>";
			echo 'PR:' . "<br>" . "<br>";
		?>
	</div>
	
	<form  name="women_health" action="insert_women_health.php" onsubmit="return validate_form()" method="post" enctype="multipart/form-data">
	
	<div style=' float: left; padding-left: 15px;'>
			<input type="text" name="t" style="width: 100px; height: 30px;" maxlength="10" autofocus onfocus='this.value = this.value;'><br>
			<input type="text" name="bp" style="width: 100px; height: 30px;" maxlength="10"><br>
			<input type="number" name="pr" style="width: 100px; height: 30px;" min='0' max='9999999999'><br>
	</div>
	
	<div style=' float: left; padding-left: 15px;'>
		<?php
			echo 'RR' . "<br>" . "<br>";
			echo 'SaO<sub>2</sub>:' . "<br>" . "<br>";
			echo 'Pain:' . "<br>" . "<br>";
		?>
	</div>
	
	<div style=' float: left; padding-left: 15px;'>
			<input type="number" name="rr" style="width: 100px; height: 30px;" min='0' max='9999999999'><br>
			<input type="number" name="sao2" style="width: 100px; height: 30px;" min='0' max='9999999999'><br>
			
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
    <div class="accountCard" style="float: left; width: 885px; height: 1360px; position: relative;">
	
		LMP: <input type="date" name="lmp" style="width: 130px; height: 25px;" maxlength="45">
		Menarche: <input type="text" name="menarche" style="width: 75px; height: 25px;" maxlength="45">
		<label style="margin-left: 20px;">G:</label><input type="text" name="g_lmp" style="width: 50px; height: 25px;" maxlength="45">
		T: <input type="text" name="t_lmp" style="width: 50px; height: 25px;" maxlength="45">
		P: <input type="text" name="p_lmp" style="width: 50px; height: 25px;" maxlength="45">
		L: <input type="text" name="l_lmp" style="width: 50px; height: 25px;" maxlength="45">
		<label style="margin-left: 20px;">Family Planning:</label> <input type="text" name="family_planning" style="width: 90px; height: 25px;" maxlength="45">
			
		<br><br>
		
		Past Cancer Screening: <input type="text" name="past_cancer_screening" style="width: 500px; height: 25px;" maxlength="45">
		
		<br><br>
		
		Lifetime Sexual Partners: <input type="number" name="life_sex_partners" style="width: 75px; height: 25px;" maxlength="45">
		<label style="margin-left: 20px;">Sexual Partners This Year:</label> <input type="number" name="year_sex_partners" style="width: 75px; height: 25px;" maxlength="45">
		<label style="margin-left: 20px;">Cd4 Count:</label> <input type="number" name="cd4_count" style="width: 75px; height: 25px;" maxlength="45">
		
		<br><br>
			
		History: <br> <textarea style="height: 90px; width: 400px;" name="history" class="comment_area" maxlength="255"></textarea>
		
		<br><br>
		
		<input type="hidden" name="via_preformed" value="no">
		<input type="checkbox" name="via_preformed" value="yes"><label style="margin-right: 20px;">VIA Preformed</label> 
		
		<input type="hidden" name="cryo_preformed" value="no">
		<input type="checkbox" name="cryo_preformed" value="yes"><label style="margin-right: 20px;">Cryo Preformed</label>
		
		<input type="hidden" name="colpo_preformed" value="no">
		<input type="checkbox" name="colpo_preformed" value="yes"><label style="margin-right: 20px;">Colpo Preformed</label>
		
		<input type="hidden" name="biopsies" value="no">
		<input type="checkbox" name="biopsies" onchange="toggle_disabled_biopsies(this.checked)" value="yes"><label style="margin-right: 20px;" >Biopsies:</label><textarea id="biopsies_comment" style="float:right;height: 90px; width: 400px;" name="biopsies_comment" class="comment_area" maxlength="255" disabled></textarea>
		
		<br><br><br><br><br><br><br>
		
		<div style="height: 240px;">
			<div style="float: left;">
				<img src="/images/vigina.png" style="width: 150px; height: 150px;"><br>
				Add/Change Image <br><input type='file' name='vigina_file' id='vigina_file'><br><label style='font-size: 12px;'>(jpg, jpeg, png, or gif,  20MB max)</label>
			</div>
			
			<div style="float: left; margin-left: 50px;">
				<img src="/images/breast.png" style="width: 150px; height: 150px;"><br>
				Add/Change Image <br><input type='file' name='breast_file' id='breast_file'><br><label style='font-size: 12px;'>(jpg, jpeg, png, or gif,  20MB max)</label>
			</div>
			
			<div style="float: left; margin-left: 50px;">
				<img src="/images/circle.png" style="width: 150px; height: 150px;"><br>
				Add/Change Image <br><input type='file' name='circle_file' id='circle_file'><br><label style='font-size: 12px;'>(jpg, jpeg, png, or gif,  20MB max)</label>
			</div>
		</div>
		
			
		Physical Exam Continued: <br> <textarea style="height: 90px; width: 400px;" name="physical_exam_continued" class="comment_area" maxlength="255"></textarea>
		
		<br><br>
		
		Plan: <input type="text" name="plan" style="width: 500px; height: 25px;" maxlength="45">
		
		<br><br>
		
		<div style="float: left;">
			<input type="hidden" name="metronidazole_400mg" value="no">
			<input type="checkbox" name="metronidazole_400mg" value="yes"><label style="margin-right: 20px;">Metronidazole 400 mg PO BD 1/52</label> <br>
			
			<input type="hidden" name="metronidazole_2gm" value="no">
			<input type="checkbox" name="metronidazole_2gm" value="yes"><label style="margin-right: 20px;">Metronidazole 2gm PO STAT</label> <br>
			
			<input type="hidden" name="azithromycin" value="no">
			<input type="checkbox" name="azithromycin" value="yes"><label style="margin-right: 20px;">Azithromycin 1gm PO STAT</label> <br>
			
			<input type="hidden" name="ceftriaxone" value="no">
			<input type="checkbox" name="ceftriaxone" value="yes"><label style="margin-right: 20px;">Ceftriaxone 250mg IM STAT</label> <br>
			
			<input type="hidden" name="fluconazole" value="no">
			<input type="checkbox" name="fluconazole" value="yes"><label style="margin-right: 20px;">Fluconazole 150mg PO STAT</label> <br>
			
			<input type="hidden" name="clotrimazole" value="no">
			<input type="checkbox" name="clotrimazole" value="yes"><label style="margin-right: 20px;">Clotrimazole Cream Apply BD to Affected Area 3/7</label>
		</div>
		
		<div style="float: left; ">
			<input type="hidden" name="lbuprofen" value="no">
			<input type="checkbox" name="lbuprofen" value="yes"><label style="margin-right: 20px;">Ibuprofen 400mg PO TDS PRN Pain</label> <br>
			
			<input type="hidden" name="paracetamol" value="no">
			<input type="checkbox" name="paracetamol" value="yes"><label style="margin-right: 20px;">Paracetamol 1gm PO TDS PRN Pain</label> <br>
			
			<input type="hidden" name="pyridium" value="no">
			<input type="checkbox" name="pyridium" value="yes"><label style="margin-right: 20px;">Pyridium 200mg PO TDS 3/7</label> <br>
			
			<input type="hidden" name="septrim" value="no">
			<input type="checkbox" name="septrim" value="yes"><label style="margin-right: 20px;">Septrim 160/800mg PO BD 1/52</label> <br>
			
			<input type="hidden" name="amoxil" value="no">
			<input type="checkbox" name="amoxil" value="yes"><label style="margin-right: 20px;">Amoxil 500mg PO TDS 10/7</label> <br>
		</div>
		
		<br><br><br><br><br><br><br><br>
		
		<input type="hidden" name="family_planning_bottom" value="no">
		<input type="checkbox" name="family_planning_bottom" onchange="toggle_disabled_family_planning_bottom(this.checked)" value="yes"><label style="margin-right: 20px;">
		Family Planning: <br> <textarea style="height: 90px; width: 400px;" id="family_planning_comment"  name="family_planning_comment" class="comment_area" maxlength="255" disabled></textarea>
		
		<br><br>
		
		<label>Follow Up:</label> 
		
		<br><br>
		
		<input type="hidden" name="via_months" value="no">
		<input type="checkbox" name="via_months" onchange="toggle_disabled_via_months(this.checked)" value="yes" >VIA in <input type="number" name="via_months_count" id="via_months_count" style="width: 75px; height: 25px;" maxlength="45" disabled><label style="margin-right: 20px;"> months</label>
		
		<input type="hidden" name="colposcopy" value="no">
		<input type="checkbox" name="colposcopy" onchange="toggle_disabled_colposcopy(this.checked)" value="yes">Colposcopy in <input type="number" name="colposcopy_month_count" id="colposcopy_month_count" style="width: 75px; height: 25px;" maxlength="45" disabled><label style="margin-right: 20px;"> months</label>
		
		<input type="hidden" name="biopsy_results" value="no">
		<input type="checkbox" name="biopsy_results" onchange="toggle_disabled_biopsy_results(this.checked)" value="yes">Biopsy Results in <input type="number" name="biopsy_results_count" id="biopsy_results_count" style="margin-right: 2px; width: 75px; height: 25px;" maxlength="45" disabled>weeks<br>
		
		
		Referral Made to: <input type="text" name="referral" style="width: 500px; height: 25px;" maxlength="45"><br>
		<label style="margin-right: 37px;">Return Visit:</label> <input type="date" name="return_visit" style="width: 150px; height: 25px;" maxlength="45"><br>

		
		
		<div style="margin-left: 290px; width: 300px;">	
		
		<br>
		
		<?php
			 echo "<b style='margin-left: 50px;'>Clinician:</b><input list='clinician_list' name='clinician' value='$username' style='width: 120px;' maxlength='20'> <br>
			 
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
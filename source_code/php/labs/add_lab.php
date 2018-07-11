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
	<script src="/js/lab_validation.js" type="text/javascript"> </script>
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
        <form method="post" action="select_client_lab.php">
            <input style="width: 300px;" type="submit" value="Client Selection">
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
  
  
	<!-- begining of lab tests card -->
    <div class="accountCard" style="float: left; width: 885px; height: 1680px; position: relative;">
		
		<p class='p'style='color: black;font-weight:100; text-align: center;'>Check the tests that were preformed before providing the results.</p>
		
		<form name="lab_form" action="insert_lab_form.php" onsubmit="return validate_form()" method="post">
			<input type="checkbox" name="bs_for_mps" onchange="toggle_disabled_mps(this.checked)"/><b>B/S for MPS:</b>
			<input type="radio" id="no_mps" name="mps" value="no mps seen" disabled />No MPS Seen
			<input type="radio" id="mps1" name="mps" value="mps+1" disabled />MPS+1
			<input type="radio" id="mps2" name="mps" value="mps+2" disabled />MPS+2
			<input type="radio" id="mps3" name="mps" value="mps+3" disabled />MPS+3 <br><br>
			
			<div style="float: left; width: 350px;">
				<input type="checkbox" name="widal" onchange="toggle_disabled_widal(this.checked)"/> <b>Widal</b> (greater than 80 indicative for Tx) <br>
				TH 1:<input type="number" id="th1" name="th1" style="width: 100px; height: 30px;" maxlength="10" disabled /><br>
				TH 0:<input type="number" id="th2" name="th2" style="width: 100px; height: 30px;" maxlength="10" disabled />
			</div>
			
			<div style="float: left; width: 350px;">
				<input type="checkbox" name="brucella" onchange="toggle_disabled_brucella(this.checked)"/> <b>Brucella</b> (Increasing Titers Indicative for Tx) <br>
				BM 1:<input type="number" id="bm1" name="bm1" style="width: 100px; height: 30px;" maxlength="10" disabled /><br>
				BA 1:<input type="number" id="ba1" name="ba1" style="width: 100px; height: 30px;" maxlength="10" disabled />
			</div>
			<br><br><br><br><br><br>
			
			<input type="checkbox" name="pylori_stool" onchange="toggle_disabled_pylori_stool(this.checked)" /> <b>H. Pylori Stool: </b>
			<input type="radio" id="positive_pylori_stool" name="pylori_stool_radio" value="positive" disabled />positive
			<input type="radio" id="negative_pylori_stool" name="pylori_stool_radio" value="negative" disabled />negative
			
			<br><br>

			<input type="checkbox" name="pylori_blood" onchange="toggle_disabled_pylori_blood(this.checked)" /> <b> H. Pylori Blood: </b>
			<input type="radio" id="positive_pylori_blood" name="pylori_blood_radio" value="positive" disabled />positive
			<input type="radio" id="negative_pylori_blood" name="pylori_blood_radio" value="negative" disabled />negative
			
			<br><br>
			
			<input type="checkbox" name="rheumatoid" onchange="toggle_disabled_rheumatoid(this.checked)" /> <b>Rheumatoid Factor:</b>
			<input type="radio" id="reactive_rheumatoid" name="reactive_rheumatoid_radio" value="reactive" disabled />Reactive
			<input type="radio" id="non_reactive_rheumatoid" name="reactive_rheumatoid_radio" value="non_reactive" disabled />Non-Reactive
			
			<br><br>
			
			<input type="checkbox" name="stool" onchange="toggle_disabled_stool(this.checked)"/> <b>Stool O/C</b><br>
			APP:<input type="text" id="app" name="app" style="width: 100px; height: 30px;" maxlength="45" disabled /><br>
			MIC:<input type="text" id="mic" name="mic" style="width: 100px; height: 30px;" maxlength="45" disabled />
				
			<br><br> 
			
			<input type="checkbox" name="p24_hiv" onchange="toggle_disabled_p24_hiv(this.checked)"/> <b>P24/HIV:</b>
			<input type="radio" id="reactive_p24_hiv" name="reactive_p24_hiv" value="reactive" disabled />Reactive
			<input type="radio" id="non_reactive_p24_hiv" name="reactive_p24_hiv" value="non_reactive" disabled />Non-Reactive
			
			<br><br>
			
			<input type="checkbox" name="vdrl_rpr" onchange="toggle_disabled_vdrl_rpr(this.checked)" /> <b>VDRL/RPR:</b>
			<input type="radio" id="reactive" name="reactive" value="reactive" disabled />Reactive
			<input type="radio" id="non_reactive" name="reactive" value="non_reactive" disabled />Non-Reactive
			
			<br><br>
			
			<input type="checkbox" name="urinalysis" onchange="toggle_disabled_urinalysis(this.checked)"/><b>Urinalysis</b><br>
			
			<label style="margin-left: 50px; margin-right: 22px;">Urobilinogen:</label>
			<input style="margin-left: 50px;"  type="radio" id="urobilinogen_neg" name="urobilinogen" value="neg" disabled />neg
			<input type="radio" id="urobilinogen_plus_neg" name="urobilinogen" value="+-" disabled />+-
			<input type="radio" id="urobilinogen_plus" name="urobilinogen" value="+" disabled />+
			<input type="radio" id="urobilinogen_plus2" name="urobilinogen" value="++" disabled />++
			<input type="radio" id="urobilinogen_plus3" name="urobilinogen" value="+++" disabled />+++
			
			<br>
			
			<label style="margin-left: 50px; margin-right: 53px;">Glucose:</label>
			<input style="margin-left: 50px;"  type="radio" id="glucose_neg" name="glucose" value="neg" disabled />neg
			<input type="radio" id="glucose_plus_neg" name="glucose" value="+-" disabled />+-
			<input type="radio" id="glucose_plus" name="glucose" value="+" disabled />+
			<input type="radio" id="glucose_plus2" name="glucose" value="++" disabled />++
			<input type="radio" id="glucose_plus3" name="glucose" value="+++" disabled />+++
			
			<br>
			
			<label style="margin-left: 50px; margin-right: 55px;">Bilirubin:</label>
			<input style="margin-left: 50px;"  type="radio" id="bilirubin_neg" name="bilirubin" value="neg" disabled />neg
			<input type="radio" id="bilirubin_plus_neg" name="bilirubin" value="+-" disabled />+-
			<input type="radio" id="bilirubin_plus2" name="bilirubin" value="++" disabled />++
			<input type="radio" id="bilirubin_plus3" name="bilirubin" value="+++" disabled />+++
			
			<br>
			
			<label style="margin-left: 50px; margin-right: 53px;">Ketones:</label>
			<input style="margin-left: 50px;"  type="radio" id="ketones_neg" name="ketones" value="neg" disabled />neg
			<input type="radio" id="ketones_plus_neg" name="ketones" value="+-" disabled />+-
			<input type="radio" id="ketones_plus" name="ketones" value="+" disabled />+
			<input type="radio" id="ketones_plus2" name="ketones" value="++" disabled />++
			<input type="radio" id="ketones_plus3" name="ketones" value="+++" disabled />+++
			
			<br>
			
			<label style="margin-left: 50px;">Specific Gravity:</label>
			<input style="margin-left: 50px;" type="radio" id="specific_gravity_1.000" name="specific_gravity" value="1.000" disabled />1.000
			<input type="radio" id="specific_gravity_1.005" name="specific_gravity" value="1.005" disabled />1.005
			<input type="radio" id="specific_gravity_1.010" name="specific_gravity" value="1.010" disabled />1.010
			<input type="radio" id="specific_gravity_1.015" name="specific_gravity" value="1.015" disabled />1.015
			<input type="radio" id="specific_gravity_1.020" name="specific_gravity" value="1.020" disabled />1.020
			<input type="radio" id="specific_gravity_1.025" name="specific_gravity" value="1.025" disabled />1.025
			<input type="radio" id="specific_gravity_1.030" name="specific_gravity" value="1.030" disabled />1.030 (Norm 1.006 – 1.016mg/dL)
			
			<br>
			
			<label style="margin-left: 50px; margin-right: 70px;">Blood:</label>
			<input style="margin-left: 50px;"  type="radio" id="blood_neg" name="blood" value="neg" disabled />neg
			<input type="radio" id="blood_+" name="blood" value="+" disabled />+
			<input type="radio" id="blood_++" name="blood" value="++" disabled />++
			<input type="radio" id="blood_+++" name="blood" value="+++" disabled />+++
			<input type="radio" id="blood_non-hemolysis" name="blood" value="non_hemolysis" disabled />non-hemolysis
			
			<br>
			
			<label style="margin-left: 50px; margin-right: 90px;">pH:</label>
			<input style="margin-left: 50px;"  type="radio" id="ph5" name="ph" value="5" disabled />ph5
			<input type="radio" id="ph6" name="ph" value="6" disabled />ph6
			<input type="radio" id="ph6.5" name="ph" value="6.5" disabled />ph6.5
			<input type="radio" id="ph7" name="ph" value="7" disabled />ph7
			<input type="radio" id="ph8" name="ph" value="8" disabled />ph8
			<input type="radio" id="ph9" name="ph" value="9" disabled />ph9 (Norm 6 -7)
			
			<br>
			
			<label style="margin-left: 50px; margin-right: 60px;">Protein:</label>
			<input style="margin-left: 50px;"  type="radio" id="protein_neg" name="protein" value="neg" disabled />neg
			<input type="radio" id="protein_trace" name="protein" value="trace" disabled />trace
			<input type="radio" id="protein_+" name="protein" value="+" disabled />+
			<input type="radio" id="protein_++" name="protein" value="++" disabled />++
			<input type="radio" id="protein_+++" name="protein" value="+++" disabled />+++
			<input type="radio" id="protein_++++" name="protein" value="++++" disabled />++++
			
			<br>
			
			<label style="margin-left: 50px; margin-right: 70px;">Nitrite:</label>
			<input style="margin-left: 50px;"  type="radio" id="nitrite_neg" name="nitrite" value="neg" disabled />neg
			<input type="radio" id="nitrite_trace" name="nitrite" value="trace" disabled />trace
			<input type="radio" id="nitrite_pos" name="nitrite" value="pos" disabled />pos
			
			<br>
			
			<label style="margin-left: 50px; margin-right: 30px;">Leukocytes:</label>
			<input style="margin-left: 50px;"  type="radio" id="leukocytes_neg" name="leukocytes" value="neg" disabled />neg
			<input type="radio" id="leukocytes_+" name="leukocytes" value="+" disabled />+
			<input type="radio" id="leukocytes_++" name="leukocytes" value="++" disabled />++
			<input type="radio" id="leukocytes_+++" name="leukocytes" value="+++" disabled />+++
			
			<br>
			
			<input type="checkbox" name="pregnancy" onchange="toggle_disabled_pregnancy(this.checked)"/> <b>Pregnancy Test:</b>
			<input type="radio" id="hcg_detected" name="hcg_detected" value="hcg_detected" disabled />hcG detected
			<input type="radio" id="no_hcg_detected" name="hcg_detected" value="no_hcg_detected" disabled />no hcG detected
			
			<br><br>
			
			<input type="checkbox" name="hvs" onchange="toggle_disabled_hvs(this.checked)"/> <b>HVS</b><br>
			Macroscopy:<input type="text" id="macroscopy" name="macroscopy" style="width: 500px; height: 30px;" maxlength="45" disabled /><br>
			Microscopy:<input type="text" id="microscopy_hvs" name="microscopy_hvs" style="width: 500px; height: 30px;" maxlength="45" disabled /> 
			<br>
			Gram Stain: <br> <textarea rows="6" cols="55" id="gram_stain" name="gram_stain" class="comment_area" maxlength="255" disabled ></textarea> 
			<br> <br>
			Cultures: <br> <textarea rows="6" cols="55" id="culture" name="culture" class="comment_area" maxlength="255" disabled ></textarea> <br> <br>
			
			
			<input type="checkbox" name="blood_group" onchange="toggle_disabled_blood_group(this.checked)"/><b>Blood Group</b><br>
			<input style="margin-left: 50px;" type="radio" id="rhve_neg" name="rhve" value="rh-ve" disabled />Rh-ve
			<input type="radio" id="rhve_plus" name="rhve" value="rh+ve" disabled />Rh+ve
			<input type="radio" id="a" name="aboab" value="a" disabled />A
			<input type="radio" id="b" name="aboab" value="b" disabled />B
			<input type="radio" id="o" name="aboab" value="o" disabled />O
			
			<input type="radio" id="ab" name="aboab" value="ab" disabled />AB <br>
			<label style="margin-left: 50px;">DU Test:</label><input  type="text" id="du_test" name="du_test" style="width: 200px; height: 30px;" maxlength="45" disabled /><br><br>
			
				
			
			<input type="checkbox" name="blood_count" onchange="toggle_disabled_blood_count(this.checked)"/><b>Blood Count</b><br>
			
			<label style="margin-left: 50px; margin-right: 22px;">RBC:</label>
			<input type="text" id="rbc" name="rbc" style="width: 200px; height: 30px;" maxlength="30" disabled /> (Norm Men:4.3-5.7 trillion Cells, Norm Women:3.9-5.0 trillion Cells)
			
			<br>
			
			<input type="checkbox" name="hb" onchange="toggle_disabled_hb(this.checked)"/> <b>Hb:</b>
			<input type="text" id="hb_text" name="hb_text" style="width: 200px; height: 30px;" maxlength="30" disabled /> (Norm Men: 13.5 – 18g/dL, Norm Women: 11.5 – 16g/dL)
			
			<br>
			
			<input type="checkbox" name="hct" onchange="toggle_disabled_htc(this.checked)"/> <b>Hct:</b>
			<input type="text" id="hct_text" name="hct_text" style="width: 200px; height: 30px;" maxlength="30" disabled />
			
			<br>
			
			<input type="checkbox" name="mcv" onchange="toggle_disabled_mcv(this.checked)"/> <b>MCV:</b>
			<input type="text" id="mcv_text" name="hb_text" style="width: 200px; height: 30px;" maxlength="30" disabled /> (Norm: 81.2-98.3 fL)
			
			<br>
			
			<input type="checkbox" name="rdw" onchange="toggle_disabled_rdw(this.checked)"/> <b>RDW:</b>
			<input type="text" id="rdw_text" name="hb_text" style="width: 200px; height: 30px;" maxlength="30" disabled /> (Norm: 11.8%-15.5%)
			
			<br>
			
			<input type="checkbox" name="wbc" onchange="toggle_disabled_wbc(this.checked)"/> <b>WBC:</b>
			<input type="text" id="wbc_text" name="hb_text" style="width: 200px; height: 30px;" maxlength="30" disabled /> (Norm: 3.5-10.5 billion cells/L)
			
			<br>
			
			<input type="checkbox" name="platelet" onchange="toggle_disabled_platelet(this.checked)"/> <b>Platelet:</b>
			<input type="text" id="platelet_text" name="platelet_text" style="width: 200px; height: 30px;" maxlength="30" disabled /> (Norm: 150-450 billion/L)
			
			
			<br>
			
			input type="checkbox" name="neutrophils" onchange="toggle_disabled_neutrophils(this.checked)"/> <b>Neutrophils:</b>
			<input type="text" id="neutrophils_text" name="neutrophils_text" style="width: 200px; height: 30px;" maxlength="30" disabled /> ( Norm: 1.7-7.0x10(9)/L )
			<br>
			
			input type="checkbox" name="lymphocytes" onchange="toggle_disabled_lymphocytes(this.checked)"/> <b>Lymphocytes:</b>
			<input type="text" id="lymphocytes_text" name="lymphocytes_text" style="width: 200px; height: 30px;" maxlength="30" disabled /> ( Norm: 0.9-2.9x10(9)/L )
			
			<br>
			
			input type="checkbox" name="monocytes" onchange="toggle_disabled_monocytes(this.checked)"/> <b>Monocytes:</b>
			<input type="text" id="monocytes_text" name="monocytes_text" style="width: 200px; height: 30px;" maxlength="30" disabled /> ( Norm: 0.3-0.9x10(9)/L )
			
			<br>
			
			input type="checkbox" name="eosinophils" onchange="toggle_disabled_eosinophils(this.checked)"/> <b>Eosinophils:</b>
			<input type="text" id="eosinophils_text" name="eosinophils_text" style="width: 200px; height: 30px;" maxlength="30" disabled /> ( Norm: 0.05-0.50x10(9)/L )
			
			<br>
			
			input type="checkbox" name="basophils" onchange="toggle_disabled_basophils(this.checked)"/> <b>Basophils:</b>
			<input type="text" id="basophils_text" name="basophils_text" style="width: 200px; height: 30px;" maxlength="30" disabled /> ( Norm: 0-0.30x10(9)/L )
			
			<br>
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
		
			
			
			<?php
				echo "Clinician:<input list='clinician_list' name='clinician' value='$username' style='padding-left: 10px; margin-left: 10px;width: 140px; height: 20px;' maxlength='20'> <br>
			 
					 <datalist id='clinician_list'>";
							
								
									$stmt = $conn->prepare("SELECT username FROM accounts;");
									$stmt->execute();
									$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
								
									foreach(new display_clinicians(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
										echo $v;
									}
									
							
				echo "</datalist>";
			?>
			
			<div style="position: absolute; top: 1700px; left: 398px;">		
				<input type="submit" name="submit_button" class="submitbtn" value="Submit Lab Form">
			</div>
			
		</form>
		
	</div>
	
 </div>
  
</body>
</html>

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
	<script src="/js/child_welfare_care_validation.js" type="text/javascript"></script>
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
        <form method="post" action="select_client_child_welfare_care.php">
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
		
		class view_clients extends RecursiveIteratorIterator {
    
			function __construct($it) {
				parent::__construct($it, self::LEAVES_ONLY);
			}
			
			// this function creates an invisible <a link> that passes the clients id to the next page
			function current() {
			
				$_SESSION['choosen_client_id'] = parent::current();
				
				// since there are 6 fields being displayed in the table, $_SESSION['counter'] == 0 or $_SESSION['counter'] % 6 == 0
				if (($_SESSION['counter'] == 0) or ($_SESSION['counter'] % 6 == 0)) {
				
					$_SESSION['temp'] = $_SESSION['choosen_client_id'];
					
				}
				$temp = $_SESSION['temp'];
				
				return "<td align='center' style='border-style: solid; border-color: #black; background-color: white; color: black; font-size: 30px;  '>" . "<a href='grab_choosen_client_id_child_welfare_care.php? choosen_client_id=$temp' style='color: black; font-size: 20px; text-decoration: none; opacity: 1;'>"  . parent::current() . "</a>" . "</td>";
		  
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
    <div class="accountCard" style="float: left; width: 885px; height: 3960px; position: relative;">
		
		<form name="child_welfare_care" action="insert_child_welfare_care.php" onsubmit="return validate_form()" method="post">
			
			<style>
				table, th, td {
					border: 1px solid black;
					border-collapse: collapse;
				}
			</style>
			<div style="margin-left: 40px; width: 800px;">
				<label style="margin-right: 30px;" ><b>SECTION 2:</b></label> <label><b>CHILD HEALTH MONITORING</b></label><br><br>
				<label style="margin-right: 30px;" ><b>A:</b></label > <label style="margin-right: 50px;"><b>Particulars of the child: </b></label> <input type="date" name="child_particulars"/><br><br>
				<table style="width:100%;">
				  <tr>
					<td>Name of child:</td>
					<td><input type="text" name="child_name" style="height: 25px; width: 250px;" maxlength="45" /></td>
				  </tr>
				  <tr>
					<td>Sex of child:</td>
					<td><input type="radio" name="child_gender" value="male"> Male<input type="radio" name="child_gender" value="female"> Female</td>
				  </tr>
				  <tr>
					<td>Date of Birth:</td>
					<td><input type="date" name="child_date_of_birth"/></td>
				  </tr>
				  <tr>
					<td>Gestartion at birth (in weeks):</td>
					<td>Birth weight in kgs <input type="text" name="birth_weight" style="height: 25px; width: 75px;"/> Birth length in cm <input type="number" name="birth_length" style="height: 25px; width: 75px;"/></td>
				  </tr>
				  <tr>
					<td>Other birth characteristics**</td>
					<td><input type="text" name="birth_characteristics" style="height: 25px; width: 400px;" maxlength="45"/></td>
				  </tr>
				  <tr>
					<td>Birth order in family (e.g. 1st 2rd 3rd born):</td>
					<td><input type="number" name="birth_order" style="height: 25px; width: 75px;" /></td>
				  </tr>
				  <tr>
					<td>date 1st seen:</td>
					<td><input type="date" name="first_seen"/></td>
				  </tr>
				</table>
				
				
				<br>
				<label style="margin-right: 30px;"><b>B:</b></label > <label style="margin-right: 50px;"><b>Health record of child:</b><br><br>
				<table style="width:100%;">
				  <tr>
					<td>Place of birth:</td>
					<th colspan="3" style="font-weight:normal;"><input type="radio" name="birth_place" value="health_facility"> Health facility<input type="radio" name="birth_place" value="home"> Home<input type="radio" name="birth_place" value="other"> Other <input type="text" name="other_birth_place" style="height: 25px; width: 250px; " maxlength="45" /></th>
				  </tr>
				  <tr>
					<td><b>Birth Notification No.</b></td>
					<td style="width: 255px;"><input type="number" name="notification_number" style="height: 25px; width: 250px;" maxlength="45"/></td>
					<td><b>Date: </b></td>
					<td><input type="date" name="notification_date"/></td>
				  </tr>
				  <tr>
					<td>Permanent Register No.</td>
					<th colspan="3"><input type="number" name="register_number" style="height: 25px; width: 250px;" maxlength="45"/></th>
				  </tr>
				  <tr>
					<td>Child Welfare Clinic (CWC) No.</td>
					<th colspan="3"><input type="number" name="child_welfare_clinic" style="height: 25px; width: 250px;" maxlength="45"/></th>
				  </tr>
				  <tr>
					<td>Health facility name:</td>
					<th colspan="3"><input type="text" name="health_facility" style="height: 25px; width: 250px;" maxlength="45"/></th>
				  </tr>
				  <tr>
					<td>Master facility list (MFL) No.</td>
					<th colspan="3"><input type="number" name="master_facility_list_number" style="height: 25px; width: 250px;" maxlength="45"/></th>
				  </tr>
				</table>
				
				
				<br>
				<label style="margin-right: 30px;"><b>C:</b></label > <label style="margin-right: 50px;"><b>Civil registration:</b><br><br>	
				<table style="width:100%;">
				  <tr>
					<td>Birth Certificate No:</td>
					<td><input type="number" name="birth_certificate_number" style="height: 25px; width: 250px;" maxlength="45"/></td>
				  </tr>
				  <tr>
					<td>Date of registration:</td>
					<td><input type="date" name="registration_date" /></td>
				  </tr>
				  <tr>
					<td>Place of registration:</td>
					<td><input type="text" name="registration_place" style="height: 25px; width: 250px;" maxlength="45"/></td>
				  </tr>
				  
				</table>
				**e.g. twin/triplet: caesarian birth; congenital features.<br>
				<label style="margin-left:10px;">Any congenital abnormalities (cleft lip, club foot).. etc<label><br>
				<textarea style="width: 400px; height: 65px;" name="abnormalities" class="comment_area"  maxlength="255"></textarea><br>
				
				<br>
				<label style="margin-right: 30px;"><b>D:</b></label > <label style="margin-right: 50px;"><b>Particulars of family of the child:</b><br><br>
				<table style="width:100%;">
				  <tr>
					<td>Father's name:</td>
					<td><input type="text" name="father_name" style="height: 25px; width: 250px;" maxlength="45"/></td>
					<td>Tel No.</td>
					<td><input type="number" name="father_phone_number" style="height: 25px; width: 250px;" maxlength="45"/></td>
				  </tr>
				  <tr>
					<td>Mother's name:</td>
					<td><input type="text" name="mother_name" style="height: 25px; width: 250px;" maxlength="45"/></td>
					<td>Tel No.</td>
					<td><input type="number" name="mother_phone_number" style="height: 25px; width: 250px;" maxlength="45"/></td>
				  </tr>
				  <tr>
					<td>Guardian's name:</td>
					<td><input type="text" name="guardian_name" style="height: 25px; width: 250px;" maxlength="45"/></td>
					<td>Tel No.</td>
					<td><input type="number" name="guardian_phone_number" style="height: 25px; width: 250px;" maxlength="45"/></td>
				  </tr>
				  <tr>
					<td>Residence of child - <b>Country</b>:</td>
					<td><input type="text" name="country" style="height: 25px; width: 250px;" maxlength="45"/></td>
					<td><b>District:</b></td>
					<td><input type="text" name="district" style="height: 25px; width: 250px;" maxlength="45"/></td>
				  </tr>
				  <tr>
					<td><b>Division:</b></td>
					<td><input type="text" name="division" style="height: 25px; width: 250px;" maxlength="45"/></td>
					<td><b>Location:</b></td>
					<td><input type="text" name="child_location" style="height: 25px; width: 250px;" maxlength="45"/></td>
				  </tr>
				  <tr>
					<td><b>Town/Trading centre:</b></td>
					<th colspan="3"><input type="text" name="town" style="height: 25px; width: 250px;" maxlength="45"/></th>
				  </tr>
				  <tr>
					<td><b>Estate & House No./village:</b></td>
					<th colspan="3"><input type="text" name="village" style="height: 25px; width: 250px;" maxlength="45"/></th>
				  </tr>
				  <tr>
					<td>Post address:</td>
					<th colspan="3"><input type="text" name="post_address" style="height: 25px; width: 250px;" maxlength="45"/></th>
				  </tr>
				  
				</table>
				
				
				<br>
				<label style="margin-right: 30px;"><b>E:</b></label > <label style="margin-right: 50px;"><b>Broad clinical review at first below 6 months:</b><br><br>
				
				<table style="width:100%;">
				  <tr>
					<td>Age at first contact (number of months):</td>
					<td><input type="number" name="age_first_contact" style="height: 25px; width: 75px;" /></td>
				  </tr>
				  <tr>
					<td>Weight in kgs:</td>
					<td><input type="text" name="weight" style="height: 25px; width: 75px;" /></td>
				  </tr>
				  <tr>
					<td>Length/height (cm):</td>
					<td><input type="number" name="height" style="height: 25px; width: 75px;" /></td>
				  </tr>
				  <tr>
					<td>Physical features:</td>
					<td><input type="text" name="physical_features" style="height: 25px; width: 250px;" maxlength="45"/></td>
				  </tr>
				  <tr>
					<td>Colouration (cyanosis/jaundice/macules/hypopigmentation):</td>
					<td><input type="text" name="colouration" style="height: 25px; width: 250px;" maxlength="45"/></td>
				  </tr>
				  <tr>
					<td>Head circumference (cm):</td>
					<td><input type="number" name="head_circumference" style="height: 25px; width: 75px;" /></td>
				  </tr>
				  <tr>
					<td>Eyes:</td>
					<td><input type="text" name="eyes" style="height: 25px; width: 250px;" maxlength="45"/></td>
				  </tr>
				  <tr>
					<td>Mouth:</td>
					<td><input type="text" name="mouth" style="height: 25px; width: 250px;" maxlength="45"/></td>
				  </tr>
				  <tr>
					<td>Chest:</td>
					<td><input type="text" name="chest" style="height: 25px; width: 250px;" maxlength="45"/></td>
				  </tr>
				  <tr>
					<td>Heart:</td>
					<td><input type="text" name="heart" style="height: 25px; width: 250px;" maxlength="45"/></td>
				  </tr>
				  <tr>
					<td>Abdomen:</td>
					<td><input type="text" name="abdomen" style="height: 25px; width: 250px;" maxlength="45"/></td>
				  </tr>
				  <tr>
					<td>Umbilical cord/umbilicus:</td>
					<td><input type="text" name="umbilicus" style="height: 25px; width: 250px;" maxlength="45"/></td>
				  </tr>
				  <tr>
					<td>Spine:</td>
					<td><input type="text" name="spine" style="height: 25px; width: 250px;" maxlength="45"/></td>
				  </tr>
				  <tr>
					<td>Arms & hands:</td>
					<td><input type="text" name="arms_and_hands" style="height: 25px; width: 250px;" maxlength="45"/></td>
				  </tr>
				  <tr>
					<td>legs & feet:</td>
					<td><input type="text" name="legs_and_feet" style="height: 25px; width: 250px;" maxlength="45"/></td>
				  </tr>
				  <tr>
					<td>Genitalia:</td>
					<td><input type="text" name="genitalia" style="height: 25px; width: 250px;" maxlength="45"/></td>
				  </tr>
				  <tr>
					<td>Anus:</td>
					<td><input type="text" name="anus" style="height: 25px; width: 250px;" maxlength="45"/></td>
				  </tr>
				</table>
				
				
				
				<br>
				<label style="margin-right: 30px;"><b>F:</b></label > <label style="margin-right: 50px;"><b>Feeding information from parent/guardian:</b><br><br>
				
				<table style="width:100%;">
				  <tr>
					<td>Breastfeeding:</td>
					<td><input type="radio" name="breastfeeding" value="well"> Well<input type="radio" name="breastfeeding" value="poorly"> Poorly<input type="radio" name="breastfeeding" value="unable"> Unable to breastfeed</td>
				  </tr>
				  <tr>
					<td>Other feeds introduced below 6 months:</td>
					<td>yes<input type="radio" name="feeds" value="yes">no<input type="radio" name="feeds" value="no"><label style="margin-left: 20px;">If yes, at what age</label><input type="number" name="feeds_age" style="margin-left: 5px; height: 25px; width: 75px;"></td>
				  </tr>
				  <tr>
					<td>Complementary food: Other foods introduced:</td>
					<td>yes<input type="radio" name="other_foods_introduced" value="yes">no<input type="radio" name="other_foods_introduced" value="no"></td>
				  </tr>
				  <tr>
					<td>Retention of feeds/indigestion:</td>
					<td><input type="text" name="indigestion" style="height: 25px; width: 250px;" /></td>
				  </tr>
				  
				</table>
				<b>NB:</b> A baby who is exclusively breastfed, may pass stool many times or may not pass any for some days. This is normal unless he/she has abdominal distension or is vomiting. <br>
				
				<br>
				<label style="margin-right: 30px;"><b>G:</b></label > <label style="margin-right: 50px;"><b>Other behavioural characteristics from parent/guardian:</b><br><br>
				
				<table style="width:100%;">
				  <tr>
					<td>Sleep & Waking up cycles: Describe</td>
					<td><input type="text" name="sleep_cycle" style="height: 25px; width: 250px;" maxlength="45"/></td>
				  </tr>
				  <tr>
					<td>Irritability:</td>
					<td>yes<input type="radio" name="irritability" value="yes">no<input type="radio" name="irritability" value="no" maxlength="45"></td>
				  </tr>
				  <tr>
					<td>Thumb/finger sucking:</td>
					<td>yes<input type="radio" name="finger_sucking" value="yes">no<input type="radio" name="finger_sucking" value="no"></td>
				  </tr>
				 <tr>
					<td>Others /e.g. (twitches, convulsuion):</td>
					<td>yes<input type="radio" name="others" value="yes">no<input type="radio" name="others" value="no"></td>
				  </tr>
				  
				</table>
				<br><br>
				<p class='p'style='color: blue;font-weight:100; text-align: center;'>Immunizations</p>
				<label style="margin-left: 315px; color: orange;">PROTECT YOUR CHILD</label>
				
				<table style="width:100%;">
				  <tr>
					<td><label style="color: blue;"><b>BCG VACCINE: at birth</b></label></td>
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
					<td><input type="date" name="mis_05_given" /></td>
					<td><input type="date" name="mis_05_next_visit" /></td>
				  </tr>
				  <tr>
					<td>Dose (0.1mis for child below 1 year)</td>
					<td><input type="date" name="mis_1_given" /></td>
					<td><input type="date" name="mis_1_next_visit" /></td>
				  </tr>
				  <tr>
					<td>BCG-Scar Checked</td>
					<td>Date checked</td>
					<td>Date BCG repeated</td>
				  </tr>
				  <tr>
					<td>PRESENT</td>
					<td><input type="date" name="present_checked" /></td>
					<td><input type="date" name="present_repeated" /></td>
				  </tr>
				  <tr>
					<td>ABSENT</td>
					<td><input type="date" name="absent_checked" /></td>
					<td><input type="date" name="absent_repeated" /></td>
				  </tr>
				  
				  
				</table>
				
				<br><br>
				
				<table style="width:100%;">
				  <tr>
					<td><label style="color: blue;"><b>ORAL POLIO VACCINE (OPV)</b></label></td>
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
					<td><input type="date" name="birth_dose_given" /></td>
					<td><input type="date" name="birth_does_next_visit" /></td>
				  </tr>
				  <tr>
					<td>1st dose at 6 weeks (OPV 1)</td>
					<td><input type="date" name="pollo_first_dose_given" /></td>
					<td><input type="date" name="pollo_first_does_next_visit" /></td>
				  </tr>
				  <tr>
					<td>2st dose at 10 weeks (OPV 2)</td>
					<td><input type="date" name="pollo_second_dose_given" /></td>
					<td><input type="date" name="pollo_second_does_next_visit" /></td>
				  </tr>
				  <tr>
					<td>3st dose at 14 weeks (OPV 3)</td>
					<td><input type="date" name="pollo_third_dose_given" /></td>
					<td><input type="date" name="pollo_third_does_next_visit" /></td>
				  </tr>
				</table>
				
				<br><br>
				
				<table style="width:100%;">
				  <tr>
					<td style="width: 450px;"><label style="color: blue;"><b>DPHTHERIA/PERTUSSIS/TETANUS/<br>HEPATITIS B/HAEMOPHILUS INFLUENZAE Type b</b></label></td>
					<td>Date Given</td>
					<td>Date of next visit</td>
				  </tr>
				  <tr>
					<td>1st dose at 6 weeks</td>
					<td><input type="date" name="dphtheria_first_dose_given" /></td>
					<td><input type="date" name="dphtheria_first_dose_next_visit" /></td>
				  </tr>
				  <tr>
					<td>2st dose at 10 weeks</td>
					<td><input type="date" name="dphtheria_second_dose_given" /></td>
					<td><input type="date" name="dphtheria_second_does_next_visit" /></td>
				  </tr>
				  <tr>
					<td>3st dose at 14 weeks</td>
					<td><input type="date" name="dphtheria_third_dose_given" /></td>
					<td><input type="date" name="dphtheria_third_does_next_visit" /></td>
				  </tr>
				</table>
				
				<br><br>
				
				<table style="width:100%;">
				  <tr>
					<td><label style="color: blue;"><b>PNEUMOCOCCAL VACCINE</b></label></td>
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
					<td><input type="date" name="pneumococcal_first_dose_given" /></td>
					<td><input type="date" name="pneumococcal_first_does_next_visit" /></td>
				  </tr>
				  <tr>
					<td>2st dose at 10 weeks</td>
					<td><input type="date" name="pneumococcal_second_dose_given" /></td>
					<td><input type="date" name="pneumococcal_second_does_next_visit" /></td>
				  </tr>
				  <tr>
					<td>3st dose at 14 weeks</td>
					<td><input type="date" name="pneumococcal_third_dose_given" /></td>
					<td><input type="date" name="pneumococcal_third_does_next_visit" /></td>
				  </tr>
				</table>
				
				<br><br>
				
				<table style="width:100%;">
				  <tr>
					<td><label style="color: blue;"><b>ROTA VIRUS VACCINE (ROTASRIX)</b></label></td>
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
					<td><input type="date" name="rota_first_dose_given" /></td>
					<td><input type="date" name="rota_first_does_next_visit" /></td>
				  </tr>
				  <tr>
					<td>2st dose at 10 weeks<span style="color: red;">*<span></td>
					<td><input type="date" name="rota_second_dose_given" /></td>
					<td><input type="date" name="rota_second_does_next_visit" /></td>
				  </tr>
				</table>
				<span style="color: red;">*2nd dose should be given not later than 32 weeks of age.</span>
				
				<br><br>
				
				<table style="width:100%;">
				  <tr>
					<td><label style="color: blue;"><b>MEASLES VACCINE at 6 Months: in the event of a Measles outbreak or HIV Exposed children (HEI)</b></label></td>
					<td>Date Given</td>
				  </tr>
				  
				  <tr>
					<td>Dose: (0.5mis) Subutareously right upper arm</td>
					<td><input type="date" name="measles_6_months_date" /></td>
				  </tr>
				  
				  
				  
				</table>
				<br><br>
				
				<table style="width:100%;">
				
				  <tr>
					<td><label style="color: blue;"><b>MEASLES VACCINE at 9 Months</b></label></td>
					<td>Date Given</td>
				  </tr>
				  
				  <tr>
					<td>Dose: (0.5mis) Subutareously right upper arm</td>
					<td><input type="date" name="measles_9_months_date" /></td>
				  </tr>
				  
				</table>
				
				<br><br>
				
				<table style="width:100%;">
				
				  <tr>
					<td><label style="color: blue;"><b>MEASLES VACCINE at 18 Months</b></label></td>
					<td>Date Given</td>
				  </tr>
				  
				  <tr>
					<td>Dose: (0.5mis) Subutareously right upper arm</td>
					<td><input type="date" name="measles_18_months_date" /></td>
				  </tr>
				  
				</table>
				
				
				<br><br>
				
				<table style="width:100%;">
				
				  <tr>
					<td><label style="color: blue;"><b>YELLOW FEVER VACCINE at 9 Months</b></label><span style="color: orange;">**</span></td>
					<td>Date Given</td>
				  </tr>
				  
				  <tr>
					<td>Dose: (0.5mis) Subutareously right upper arm</td>
					<td><input type="date" name="yellow_fever_date" /></td>
				  </tr>
				  
				</table>
				<span style="color: orange;">** Only in selected districts in Rift Valley</span>
				
				<br><br>

				<label style="color: blue;"><b>Other Vaccine</b></label>
				
				<table style="width:100%;">
				
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
				  <textarea class="notes" name="other_vaccine" style="width: 778px; height: 300px;"></textarea>
				  
				  <br><br>
				  
				  <input style="width: 250px; margin-left: 275px;" type="submit" name="submit_button" class="submitbtn" value="Submit Form">
				
			</div>
		</form>
		
	</div>
	
 </div>
  
</body>
</html>
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
	<script src="/js/medication_order_validation.js" type="text/javascript"> </script>
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
        <form method="post" action="select_medication_order.php">
            <input style="width: 300px;" type="submit" value="Form Selection">
        </form>
      </div>
	  
  </div>
  <br></br>
  
<!-- all cards on screen are in this div, this way everything is centered -->
<div style="width:970px; margin: 0 auto; ">
  
  <!-- begining of general info card -->
  <div class="accountCard" style="margin-left: 225px; float: left; margin-right: 5px; height: 245px;" >
	<p class='p'style='color: black;font-weight:100; text-align: center;'>Client's General Info</p>
	
	
<?php
		
		require('../database_credentials.php');
		require('../date_functions.php');
		session_start();
		
		// make sure user is logged in
		login_check();
		
		$choosen_medication_order_id = $_SESSION['choosen_medication_order_id'];
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
		$stmt = $conn->prepare("SELECT client_id FROM medication_order WHERE medication_order_id='$choosen_medication_order_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$client_id = $_SESSION['temp'];
		
		
		// grab the clients first name
		$stmt = $conn->prepare("SELECT first_name FROM medication_order WHERE medication_order_id='$choosen_medication_order_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$first_name = $_SESSION['temp'];
		
		
		// grab the clients last name
		$stmt = $conn->prepare("SELECT last_name FROM medication_order WHERE medication_order_id='$choosen_medication_order_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$last_name = $_SESSION['temp'];
		
		
		// grab the clients sex
		$stmt = $conn->prepare("SELECT sex FROM medication_order WHERE medication_order_id='$choosen_medication_order_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$sex = $_SESSION['temp'];
		
		
		// grab the clients location
		$stmt = $conn->prepare("SELECT location FROM medication_order WHERE medication_order_id='$choosen_medication_order_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$location = $_SESSION['temp'];
		
		
		// grab the clients date of birth
		$stmt = $conn->prepare("SELECT date_of_birth FROM medication_order WHERE medication_order_id='$choosen_medication_order_id'");
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





		$stmt = $conn->prepare("SELECT medication FROM medication_order WHERE medication_order_id='$choosen_medication_order_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$medication = $_SESSION['temp'];


		$stmt = $conn->prepare("SELECT dosage FROM medication_order WHERE medication_order_id='$choosen_medication_order_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$dosage = $_SESSION['temp'];





		$stmt = $conn->prepare("SELECT frequency FROM medication_order WHERE medication_order_id='$choosen_medication_order_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$frequency = $_SESSION['temp'];


		$stmt = $conn->prepare("SELECT administration_method FROM medication_order WHERE medication_order_id='$choosen_medication_order_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$administration_method = $_SESSION['temp'];


$stmt = $conn->prepare("SELECT notes FROM medication_order WHERE medication_order_id='$choosen_medication_order_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$notes = $_SESSION['temp'];





?>
		 
</div>
  
 <!-- start of bottom card -->
    <div class="accountCard" style="margin-left: 225px;float: left; margin-right: 5px;height: 425px;" >
	<p class='p'style='color: black;font-weight:100; text-align: center;'>Medication Order</p>
	<form  name="medication_order_form" action="update_medication_order.php" onsubmit="return validate_form()" method="post">	

<?php
	echo "Medication: <input style='height: 35px; width: 200px;' type='text' name='medication' value='$medication'></br></br>
	Dosage: <input style='height: 35px; width: 200px;' type='text' name='dosage' value='$dosage'></br></br>
	Frequency: <input style='height: 35px; width: 200px;' type='text' name='frequency' value='$frequency'></br></br>";


switch ($administration_method) {
	case "oral":
		$administration_method_oral="selected='selected'";
		break;
	case "buccal":
		$administration_method_buccal="selected='selected'";
		break;
	case "enteral":
		$administration_method_enteral="selected='selected'";
		break;
	case "inhalable":
		$administration_method_inhalable="selected='selected'";
		break;
	case "infused":
		$administration_method_infused="selected='selected'";
		break;
	case "intramuscular":
		$administration_method_intramuscular="selected='selected'";
		break;
	case "intrathecal":
		$administration_method_intrathecal="selected='selected'";
		break;
	case "intravenous":
		$administration_method_intravenous="selected='selected'";
		break;
	case "nasal":
		$administration_method_nasal="selected='selected'";
		break;
	case "ophthalmic":
		$administration_method_ophthalmic="selected='selected'";
		break;
	case "otic":
		$administration_method_otic="selected='selected'";
		break;
	case "rectal":
		$administration_method_rectal="selected='selected'";
		break;
	case "subcutaneous":
		$administration_method_subcutaneous="selected='selected'";
		break;
	case "sublingual":
		$administration_method_sublingual="selected='selected'";
		break;
	case "topical":
		$administration_method_topical="selected='selected'";
		break;
	case "transdermal":
		$administration_method_transdermal="selected='selected'";
		break;

}

	
echo "Administration Method: <select name='administration_method' style='width: 100px; height: 25px;'>
	  <option value='oral' $administration_method_oral>oral </option>
	  <option value='buccal' $administration_method_buccal>buccal</option>
	  <option value='enteral' $administration_method_enteral>enteral </option>
	  <option value='inhalable' $administration_method_inhalable >inhalable</option>
	  <option value='infused' $administration_method_infused>infused</option>
	  <option value='intramuscular' $administration_method_intramuscular>intramuscular</option>
	  <option value='intrathecal' $administration_method_intrathecal>intrathecal</option>
	  <option value='intravenous' $administration_method_intravenous>intravenous</option>
	  <option value='nasal' $administration_method_nasal>nasal</option>
	  <option value='ophthalmic' $administration_method_ophthalmic>ophthalmic</option>
	  <option value='otic' $administration_method_otic>otic</option>
	  <option value='rectal' $administration_method_rectal>rectal</option>
	  <option value='subcutaneous' $administration_method_subcutaneous>subcutaneous</option>
	  <option value='sublingual' $administration_method_sublingual>sublingual</option>
	  <option value='topical' $administration_method_topical>topical</option>
	  <option value='transdermal' $administration_method_transdermal>transdermal</option>
	</select></br></br>
	Notes:	
	<textarea name='notes' style='height: 70px; width: 400px;'>$notes</textarea></br></br>";


?>
			
	<input type="submit" name="submit_button" class="submitbtn" value="Submit Medication Order">
		
		
	
	
	</form>
	
 </div>
  
</body>
</html>

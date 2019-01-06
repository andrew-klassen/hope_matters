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
	<link rel="stylesheet" type="text/css" href="/css/view_client.css">
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
        <form method="post" action="select_medication_order_complete.php">
            <input style="width: 300px;" type="submit" value="Form Selection">
        </form>
      </div>
	  
  </div>
  <br></br>
  
<!-- all cards on screen are in this div, this way everything is centered -->
<div style="width:1820px;  margin: 0 auto; ">
  

  <!-- begining of general info card -->
  <div class="accountCard" style="margin-left: 225px; float: left; margin-right: 5px; height: 600px;" >
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





class view_clients extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }
	
	// this function creates an invisible <a link> that passes the referral form id to the next page
    function current() {
	
		
		
		return "<td style='border-style: solid; border-color: #black; background-color: white; color: black;font-weight: 500;font-size: 12px;font-size: 30px;  '>" . "<a href='#' style='color: black;'>"  . parent::current() . "</a>" . "</td>";
  
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


		$stmt = $conn->prepare("SELECT open FROM medication_order WHERE medication_order_id='$choosen_medication_order_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$open = $_SESSION['temp'];


	echo "<div style='float: left; margin-top: 50px;'><p class='p'style='color: black;font-weight:100; text-align: center;'>Medication Order</p>";
		


	echo "Medication: $medication </br></br>
	Dosage: $dosage </br></br>
	Frequency: $frequency </br></br>
	Administration Method: $administration_method </br></br>
	Notes:	
	<textarea name='notes' style='height: 70px; width: 400px;' disabled>
	 $notes
	</textarea></br></br></div>";





?>
		 
</div>
  
 <!-- start of bottom card -->
    <div class="accountCard" style="width: 800px;margin-left: 5px;float: right; margin-right: 225px;height: 600px;" >
<p class='p'style='color: black;font-weight:100; text-align: center;'>Times Administered</p>
			
<?php




 echo "<div id='tableCard' style='margin-top: 0px; margin-bottom: 10px;'>";
	
	
	/******** determine if the user is searching by id, first name, or last name ********/
	
	// if the client is searching by id
	
	
		echo "<table style='border: none;'>";
		echo "<tr><th>Clinician</th><th>Timestamp</th></tr>";
		
		$stmt = $conn->prepare("SELECT created_by, date_format(timestamp, '%b %d %Y %h:%i %p') FROM medication_order_dose Where medication_order_id='$choosen_medication_order_id' ORDER BY medication_order_dose_id DESC");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$_SESSION['counter'] = 0;
		foreach(new view_clients(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		   echo $v;
		   ++$_SESSION['counter'];
		}
	
	
	

	echo "</table>";
    echo "</div>";









?>






<div style="margin-left: 295px;">

<form  name="vital_signs_form" action="insert_dose.php" onsubmit="return validate_form()" method="post">
	
<?php

	if ($open == "yes") {
		echo "<input style='width: 100px;' type='submit' name='submit_button' class='submitbtn' value='Give Dose'>";
	}
	else {
		echo "<input style='width: 100px; background-color: gray;' type='submit' name='submit_button' class='submitbtn' value='Give Dose' disabled>";
	}
?>
</form>

<form  name="vital_signs_form" action="insert_finish.php" onsubmit="return validate_form()" method="post">


<input style='width: 100px;' type='submit' name='submit_button' class='submitbtn' value='Finish Order'>

</form>
</div>


</div>
	


 </div>


  
</body>
</html>

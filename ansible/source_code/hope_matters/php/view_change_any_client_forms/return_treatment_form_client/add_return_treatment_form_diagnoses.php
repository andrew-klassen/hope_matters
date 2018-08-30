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
        <form method="post" action="add_return_treatment_form.php">
            <input style="width: 300px;" type="submit" value="Part 1">
        </form>
      </div>
	  
  </div>
  <br></br>
  
<!-- all cards on screen are in this div, this way everything is centered -->
<div style="width:400px; margin: 0 auto; ">
  
  <!-- begining of general info card -->
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
		
		// used to get a single value from the database
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
		
		// used to display list of acceptible diagnoses for datalist 
		class display_diagnoses extends RecursiveIteratorIterator {
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
		
		// used to show user list of already added diagnoses
		class added_diagnoses extends RecursiveIteratorIterator {
			function __construct($it) {
				parent::__construct($it, self::LEAVES_ONLY);
			}
			function current() {
				return "<tr><td style='padding-left: 80px;'>" . parent::current() . "</td></tr>";
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
		
		
		// grab the clients location
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
		
		
		// if diagnosis was added or removed
		if ($_POST['diagnosis']) {
			
			// grab the diagnosis
			$diagnosis = $_POST['diagnosis'];
			
			// if diagnosis was added
			if ($_POST['add'] == 'yes') {
			
				// find out if the diagnosis is acceptible
				$stmt = $conn->prepare("SELECT COUNT(*) FROM diagnosis_types WHERE diagnosis_type='$diagnosis'");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

				}
				$count = $_SESSION['temp'];
				
				// if the diagnosis is acceptible
				if ($count) {
			
					// check to see if the diagnosis has already been added
					$stmt = $conn->prepare("SELECT COUNT(*) FROM diagnoses_temp WHERE diagnosis='$diagnosis' AND created_by='$username' AND form_type='return_treatment'");
					$stmt->execute();
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

					foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

					}
					$count = $_SESSION['temp'];
					
					// if the diagnosis has not been added
					if ($count == 0) {
						
						// attempt to add it
						try {
							$query = "INSERT INTO diagnoses_temp (diagnosis, created_by, form_type) VALUES ('$diagnosis', '$username', 'return_treatment');"; 
							$conn->exec($query);
						}
						
						catch(PDOException $e) {				
							$_SESSION['error_number'] = 0;
							$_SESSION['query'] = $query;
							$_SESSION['pdo_error'] = $e->getMessage();
							header( 'Location: add_return_treatment_form_diagnoses_error.php');
							exit();		
						}
					}
				}
				// else, throw an error
				else {
						echo "<script type='text/javascript'>
								alert('This is an unacceptible diagnosis.'); 
							  </script>";
				}
			}
			
			// if clinician is not adding diagnosis, then they are removing it
			else {
				
				// try to remove diagnosis
				try {
					$query = "DELETE FROM diagnoses_temp WHERE diagnosis='$diagnosis' AND created_by='$username' AND form_type='return_treatment'"; 
					$conn->exec($query);
				}
				
				catch(PDOException $e) {
					$_SESSION['error_number'] = 2;
					$_SESSION['query'] = $query;
					$_SESSION['pdo_error'] = $e->getMessage();
					header( 'Location: add_return_treatment_form_diagnoses_error.php');
					exit();		
				}
			}	
		}
		
?>		 
</div>
  
  
   <!-- start of bottom card -->
    <div class="accountCard" style="float: left; margin-right: 500px;width: 400px; height: 250px; position: relative;">
		
		<div style=' margin-left:25px;'>
				
				<form action="add_return_treatment_form_diagnoses.php" method="post" >
					<label style='margin-right:10px;'>Diagnosis</label><input list="diagnosis_list" name="diagnosis" style="width: 150px; height: 15px;" autofocus onfocus="this.value = this.value;">
					
					<!-- gets list of acceptible diagnosis from database -->
					<datalist id="diagnosis_list">
					
						<?php
						
							$stmt = $conn->prepare("SELECT diagnosis_type FROM diagnosis_types;");
							$stmt->execute();
							$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
						
							foreach(new display_diagnoses(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
								echo $v;
							}
							
						?>
						
					</datalist>
					
					<button type="submit" name="add" value="yes">add</button>
					<button type="submit" name="remove">remove</button>
				</form>
					
		</div>
		
		<div>
			
			<div style='margin-top: 25px;'>
				<b style="padding-left: 130px; " >Added Diagnoses:</b><br>	
			</div>
			
			<div style='position: absolute; top: 105px; padding-left: 50px; height: 150px; overflow:auto;'>
				
				<!-- display list of already added diagnoses onto a table -->
				<table style="width:300px;">
				
				<?php
						$stmt = $conn->prepare("SELECT diagnosis FROM diagnoses_temp  WHERE created_by='$username' AND form_type='return_treatment';");
						$stmt->execute();
						$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
					
						foreach(new added_diagnoses(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
							echo $v;
						}
				?>
				  
				</table>
			</div>
			
		</div>
		
		<!-- submit button -->
		<div style="margin-top: 160px; margin-left: 85px;">	
			<form action="insert_return_treatment_form.php">
				<input type="submit" style="width: 230px;" name="submit_button" class="submitbtn" value="Submit Return Treatment Form">
			</form>
		</div>
		
	</div>
	
 </div>
  
</body>
</html>
<!--
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
-->

<?php
require('../database_credentials.php');
require('../file_upload.php');
session_start();

// make sure user is logged in
login_check();

// grab clinician first because the program needs to make sure
// the account exists within the database
$clinician = $_POST['clinician'];

// single quotes need to be replaced with the correct excape keys for the following value
$clinician = str_replace('\'', '\\\'', $clinician);

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

// create database connection
$conn = new PDO($dbconnection, $dbusername, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	
// check to see if an account with the clinician's name exists
$stmt = $conn->prepare("SELECT COUNT(username) FROM accounts WHERE username='$clinician'");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$count = $_SESSION['temp'];


// if the account does not exist
if ($count == 0) {
	
	// notify the user that the account was not found and redirect back to the form creation page
	echo "<script type='text/javascript'>
			alert('Clinician was not found in the database.'); 
			document.location.href = 'select_ultrasound.php'; 
		  </script>";
		
}

// if the account exists
else {
	$choosen_ultrasound_id = $_SESSION['choosen_ultrasound_id'];
	$username = $_SESSION['username'];
	
		$stmt = $conn->prepare("SELECT client_id  FROM ultrasound WHERE ultrasound_id='$choosen_ultrasound_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$client_id = $_SESSION['temp'];
	
		$stmt = $conn->prepare("SELECT first_name FROM ultrasound WHERE ultrasound_id='$choosen_ultrasound_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$first_name = $_SESSION['temp'];
		
		
		// grab the clients last name
		$stmt = $conn->prepare("SELECT last_name FROM ultrasound WHERE ultrasound_id='$choosen_ultrasound_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$last_name = $_SESSION['temp'];
		
		
		// grab the clients sex
		$stmt = $conn->prepare("SELECT sex FROM ultrasound WHERE ultrasound_id='$choosen_ultrasound_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$sex = $_SESSION['temp'];
		
		
		// grab the clients location
		$stmt = $conn->prepare("SELECT location FROM ultrasound WHERE ultrasound_id='$choosen_ultrasound_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$location = $_SESSION['temp'];
		
		
		// grab the clients date of birth
		$stmt = $conn->prepare("SELECT date_of_birth FROM ultrasound WHERE ultrasound_id='$choosen_ultrasound_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$date_of_birth = $_SESSION['temp'];
		
	if ($package_path = upload_package('ultrasound_images', 'Ultrasound Images', 'select_client_ultrasound.php', '../../uploaded_images/in_use/ultrasound_images/')) {
	
	// get vital signs
	$t = $_POST['t'];
	$bp = $_POST['bp'];
	$pr = $_POST['pr'];
	$rr = $_POST['rr'];
	$sao2 = $_POST['sao2'];
	$pain = $_POST['pain'];

	// single quotes need to be replaced with the correct excape keys for the following values
	$t = str_replace('\'', '\\\'', $t);
	$bp = str_replace('\'', '\\\'', $bp);
	$rr = str_replace('\'', '\\\'', $rr);

	// get text infomation
	$lmp = $_POST['lmp'];
	$weeks_pregnant = $_POST['weeks_pregnant'];
	$days_pregnant = $_POST['days_pregnant'];
	$edd_per_lmp = date('Y-m-d',strtotime($lmp . "+280 days"));
	$g_lmp = $_POST['g_lmp'];
	$t_lmp = $_POST['t_lmp'];
	$p_lmp = $_POST['p_lmp'];
	$l_lmp = $_POST['l_lmp'];
	
	$significant_history = $_POST['significant_history'];
	$ultrasound_findings = $_POST['ultrasound_findings'];
	$fetal_number = $_POST['fetal_number'];
	
	
	$presentation_baby_1 = $_POST['presentation_baby_1'];
	$placenta_baby_1 = $_POST['placenta_baby_1'];
	$fetal_movement_baby_1 = $_POST['fetal_movement_baby_1'];
	$fetal_heartbeat_baby_1 = $_POST['fetal_heartbeat_baby_1'];
	$amniotic_fluid_baby_1 = $_POST['amniotic_fluid_baby_1'];
	
	$presentation_baby_2 = $_POST['presentation_baby_2'];
	$placenta_baby_2 = $_POST['placenta_baby_2'];
	$fetal_movement_baby_2 = $_POST['fetal_movement_baby_2'];
	$fetal_heartbeat_baby_2 = $_POST['fetal_heartbeat_baby_2'];
	$amniotic_fluid_baby_2 = $_POST['amniotic_fluid_baby_2'];
	
	$presentation_baby_3 = $_POST['presentation_baby_3'];
	$placenta_baby_3 = $_POST['placenta_baby_3'];
	$fetal_movement_baby_3 = $_POST['fetal_movement_baby_3'];
	$fetal_heartbeat_baby_3 = $_POST['fetal_heartbeat_baby_3'];
	$amniotic_fluid_baby_3 = $_POST['amniotic_fluid_baby_3'];
	
	$presentation_baby_4 = $_POST['presentation_baby_4'];
	$placenta_baby_4 = $_POST['placenta_baby_4'];
	$fetal_movement_baby_4 = $_POST['fetal_movement_baby_4'];
	$fetal_heartbeat_baby_4 = $_POST['fetal_heartbeat_baby_4'];
	$amniotic_fluid_baby_4 = $_POST['amniotic_fluid_baby_4'];
	
	
	$edd_per_ultrasound = $_POST['edd_per_ultrasound'];
	$other_findings = $_POST['other_findings'];
	
	// single quotes need to be replaced with the correct excape keys for the following values
	$significant_history = str_replace('\'', '\\\'', $significant_history);
	$other_findings = str_replace('\'', '\\\'', $other_findings);
	
	
	
	$stmt = $conn->prepare("SELECT t FROM ultrasound WHERE ultrasound_id='$choosen_ultrasound_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$t_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT bp FROM ultrasound WHERE ultrasound_id='$choosen_ultrasound_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$bp_check = $_SESSION['temp'];
		
	
	$stmt = $conn->prepare("SELECT pr FROM ultrasound WHERE ultrasound_id='$choosen_ultrasound_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$pr_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT rr FROM ultrasound WHERE ultrasound_id='$choosen_ultrasound_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$rr_check = $_SESSION['temp'];
		
	
	$stmt = $conn->prepare("SELECT pain FROM ultrasound WHERE ultrasound_id='$choosen_ultrasound_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$pain_check = $_SESSION['temp'];
		
		
	$stmt = $conn->prepare("SELECT lmp FROM ultrasound WHERE ultrasound_id='$choosen_ultrasound_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$lmp_check = $_SESSION['temp'];
		
		
	$stmt = $conn->prepare("SELECT weeks_pregnant FROM ultrasound WHERE ultrasound_id='$choosen_ultrasound_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$weeks_pregnant_check = $_SESSION['temp'];
		
	
	$stmt = $conn->prepare("SELECT edd_per_lmp FROM ultrasound WHERE ultrasound_id='$choosen_ultrasound_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$edd_per_lmp_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT g_lmp FROM ultrasound WHERE ultrasound_id='$choosen_ultrasound_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$g_lmp_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT t_lmp FROM ultrasound WHERE ultrasound_id='$choosen_ultrasound_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$t_lmp_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT p_lmp FROM ultrasound WHERE ultrasound_id='$choosen_ultrasound_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$p_lmp_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT l_lmp FROM ultrasound WHERE ultrasound_id='$choosen_ultrasound_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$l_lmp_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT significant_history FROM ultrasound WHERE ultrasound_id='$choosen_ultrasound_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$significant_history_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT ultrasound_findings FROM ultrasound WHERE ultrasound_id='$choosen_ultrasound_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$ultrasound_findings_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT fetal_number FROM ultrasound WHERE ultrasound_id='$choosen_ultrasound_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$fetal_number_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT edd_per_ultrasound FROM ultrasound WHERE ultrasound_id='$choosen_ultrasound_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$edd_per_ultrasound_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT other_findings FROM ultrasound WHERE ultrasound_id='$choosen_ultrasound_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$other_findings_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT package_path FROM ultrasound WHERE ultrasound_id='$choosen_ultrasound_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$package_path_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT clinician FROM ultrasound WHERE ultrasound_id='$choosen_ultrasound_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$clinician_check = $_SESSION['temp'];
	
	
	$stmt = $conn->prepare("SELECT created_by FROM ultrasound WHERE ultrasound_id='$choosen_ultrasound_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	
	}
	$created_by_check = $_SESSION['temp'];
	
	
	// code below checks to see which babys exist, and which ones were changed
	
	if ($presentation_baby_1 != 'none') {
		try {
			
			$stmt = $conn->prepare("SELECT presentation FROM baby WHERE ultrasound_id='$choosen_ultrasound_id' and baby_number='1';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$presentation_baby_1_check = $_SESSION['temp'];
			
			
			if ($presentation_baby_1_check == '') {
				$query = "INSERT INTO baby (ultrasound_id, client_id, first_name, last_name, sex, location, date_of_birth, baby_number, presentation, placenta, fetal_movement, fetal_heartbeat, amniotic_fluid, clinician, created_by) VALUES ('$choosen_ultrasound_id', '$client_id', '$first_name', '$last_name', '$sex', '$location', '$date_of_birth', '1', '$presentation_baby_1', '$placenta_baby_1', '$fetal_movement_baby_1', '$fetal_heartbeat_baby_1', '$amniotic_fluid_baby_1', '$clinician', '$username');"; 
				$conn->exec($query);
			}
			else {
			
				$stmt = $conn->prepare("SELECT baby_id FROM baby WHERE ultrasound_id='$choosen_ultrasound_id' and baby_number='1';");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$baby_id = $_SESSION['temp'];
				
				
				$stmt = $conn->prepare("SELECT placenta FROM baby WHERE ultrasound_id='$choosen_ultrasound_id' and baby_number='1';");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$placenta_baby_1_check = $_SESSION['temp'];
				
				
				$stmt = $conn->prepare("SELECT fetal_movement FROM baby WHERE ultrasound_id='$choosen_ultrasound_id' and baby_number='1';");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$fetal_movement_baby_1_check = $_SESSION['temp'];
				
				
				$stmt = $conn->prepare("SELECT fetal_heartbeat FROM baby WHERE ultrasound_id='$choosen_ultrasound_id' and baby_number='1';");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$fetal_heartbeat_baby_1_check = $_SESSION['temp'];
				
				
				$stmt = $conn->prepare("SELECT amniotic_fluid FROM baby WHERE ultrasound_id='$choosen_ultrasound_id' and baby_number='1';");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$amniotic_fluid_baby_1_check = $_SESSION['temp'];
				
				
				if ($presentation_baby_1 != $presentation_baby_1_check or $placenta_baby_1 != $placenta_baby_1_check or $fetal_movement_baby_1 != $fetal_movement_baby_1_check or $fetal_heartbeat_baby_1 != $fetal_heartbeat_baby_1_check or $amniotic_fluid_baby_1 != $amniotic_fluid_baby_1_check) {
					
					$stmt = $conn->prepare("SELECT timestamp FROM baby WHERE ultrasound_id='$choosen_ultrasound_id' and baby_number='1';");
					$stmt->execute();
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
					
					foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
					
					}
					$timestamp = $_SESSION['temp'];
					
					$query = "INSERT INTO baby_history (baby_id, ultrasound_id, client_id, first_name, last_name, sex, location, date_of_birth, baby_number, presentation, placenta, fetal_movement, fetal_heartbeat, amniotic_fluid, timestamp, clinician, created_by) VALUES ('$baby_id','$choosen_ultrasound_id', '$client_id', '$first_name', '$last_name', '$sex', '$location', '$date_of_birth', '1', '$presentation_baby_1_check', '$placenta_baby_1_check', '$fetal_movement_baby_1_check', '$fetal_heartbeat_baby_1_check', '$amniotic_fluid_baby_1_check', '$timestamp', '$clinician_check', '$created_by_check');"; 
					$conn->exec($query);
				
					$sql = "UPDATE baby SET presentation='$presentation_baby_1', placenta='$placenta_baby_1', fetal_movement='$fetal_movement_baby_1', fetal_heartbeat='$fetal_heartbeat_baby_1', amniotic_fluid='$amniotic_fluid_baby_1', clinician='$clinician', created_by='$username' WHERE ultrasound_id='$choosen_ultrasound_id' and baby_number='1';"; 
					$stmt = $conn->prepare($sql);
					$stmt->execute();
					
				}
			}
		
		
		}

		catch(PDOException $e) {
			echo $sql . '<br>' . $e->getMessage();	
		}
	}
	
	$_SESSION['temp'] = '';
	
	
	if ($presentation_baby_2 != 'none') {
		try {
			$stmt = $conn->prepare("SELECT presentation FROM baby WHERE ultrasound_id='$choosen_ultrasound_id' and baby_number='2';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$presentation_baby_2_check = $_SESSION['temp'];
			
			
			if ($presentation_baby_2_check == '') {
				
				$query = "INSERT INTO baby (ultrasound_id, client_id, first_name, last_name, sex, location, date_of_birth, baby_number, presentation, placenta, fetal_movement, fetal_heartbeat, amniotic_fluid, clinician, created_by) VALUES ('$choosen_ultrasound_id', '$client_id', '$first_name', '$last_name', '$sex', '$location', '$date_of_birth', '2', '$presentation_baby_2', '$placenta_baby_2', '$fetal_movement_baby_2', '$fetal_heartbeat_baby_2', '$amniotic_fluid_baby_2', '$clinician', '$username');"; 
				$conn->exec($query);
			}
			else {
				$stmt = $conn->prepare("SELECT baby_id FROM baby WHERE ultrasound_id='$choosen_ultrasound_id' and baby_number='2';");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$baby_id = $_SESSION['temp'];
				
				
				$stmt = $conn->prepare("SELECT placenta FROM baby WHERE ultrasound_id='$choosen_ultrasound_id' and baby_number='2';");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$placenta_baby_2_check = $_SESSION['temp'];
				
				
				$stmt = $conn->prepare("SELECT fetal_movement FROM baby WHERE ultrasound_id='$choosen_ultrasound_id' and baby_number='2';");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$fetal_movement_baby_2_check = $_SESSION['temp'];
				
				
				$stmt = $conn->prepare("SELECT fetal_heartbeat FROM baby WHERE ultrasound_id='$choosen_ultrasound_id' and baby_number='2';");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$fetal_heartbeat_baby_2_check = $_SESSION['temp'];
				
				
				$stmt = $conn->prepare("SELECT amniotic_fluid FROM baby WHERE ultrasound_id='$choosen_ultrasound_id' and baby_number='2';");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$amniotic_fluid_baby_2_check = $_SESSION['temp'];
				
				
				if ($presentation_baby_2 != $presentation_baby_2_check or $placenta_baby_2 != $placenta_baby_2_check or $fetal_movement_baby_2 != $fetal_movement_baby_2_check or $fetal_heartbeat_baby_2 != $fetal_heartbeat_baby_2_check or $amniotic_fluid_baby_2 != $amniotic_fluid_baby_2_check) {
					
					$stmt = $conn->prepare("SELECT timestamp FROM baby WHERE ultrasound_id='$choosen_ultrasound_id' and baby_number='2';");
					$stmt->execute();
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
					
					foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
					
					}
					$timestamp = $_SESSION['temp'];
					
					$query = "INSERT INTO baby_history (baby_id, ultrasound_id, client_id, first_name, last_name, sex, location, date_of_birth, baby_number, presentation, placenta, fetal_movement, fetal_heartbeat, amniotic_fluid, timestamp, clinician, created_by) VALUES ('$baby_id','$choosen_ultrasound_id', '$client_id', '$first_name', '$last_name', '$sex', '$location', '$date_of_birth', '2', '$presentation_baby_2_check', '$placenta_baby_2_check', '$fetal_movement_baby_2_check', '$fetal_heartbeat_baby_2_check', '$amniotic_fluid_baby_2_check', '$timestamp', '$clinician_check', '$created_by_check');"; 
					$conn->exec($query);
				
					$sql = "UPDATE baby SET presentation='$presentation_baby_2', placenta='$placenta_baby_2', fetal_movement='$fetal_movement_baby_2', fetal_heartbeat='$fetal_heartbeat_baby_2', amniotic_fluid='$amniotic_fluid_baby_2', clinician='$clinician', created_by='$username' WHERE ultrasound_id='$choosen_ultrasound_id' and baby_number='2';"; 
					$stmt = $conn->prepare($sql);
					$stmt->execute();
					
				}
			}
		
		
		}

		catch(PDOException $e) {
			echo $sql . '<br>' . $e->getMessage();	
		}
	}
	
	$_SESSION['temp'] = '';
	
	
	if ($presentation_baby_3 != 'none') {
		try {
			$stmt = $conn->prepare("SELECT presentation FROM baby WHERE ultrasound_id='$choosen_ultrasound_id' and baby_number='3';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$presentation_baby_3_check = $_SESSION['temp'];
			
			
			if ($presentation_baby_3_check == '') {
				
				$query = "INSERT INTO baby (ultrasound_id, client_id, first_name, last_name, sex, location, date_of_birth, baby_number, presentation, placenta, fetal_movement, fetal_heartbeat, amniotic_fluid, clinician, created_by) VALUES ('$choosen_ultrasound_id', '$client_id', '$first_name', '$last_name', '$sex', '$location', '$date_of_birth', '3', '$presentation_baby_3', '$placenta_baby_3', '$fetal_movement_baby_3', '$fetal_heartbeat_baby_3', '$amniotic_fluid_baby_3', '$clinician', '$username');"; 
				$conn->exec($query);
			}
			else {
				$stmt = $conn->prepare("SELECT baby_id FROM baby WHERE ultrasound_id='$choosen_ultrasound_id' and baby_number='3';");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$baby_id = $_SESSION['temp'];
				
				
				$stmt = $conn->prepare("SELECT placenta FROM baby WHERE ultrasound_id='$choosen_ultrasound_id' and baby_number='3';");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$placenta_baby_3_check = $_SESSION['temp'];
				
				
				$stmt = $conn->prepare("SELECT fetal_movement FROM baby WHERE ultrasound_id='$choosen_ultrasound_id' and baby_number='3';");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$fetal_movement_baby_3_check = $_SESSION['temp'];
				
				
				$stmt = $conn->prepare("SELECT fetal_heartbeat FROM baby WHERE ultrasound_id='$choosen_ultrasound_id' and baby_number='3';");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$fetal_heartbeat_baby_3_check = $_SESSION['temp'];
				
				
				$stmt = $conn->prepare("SELECT amniotic_fluid FROM baby WHERE ultrasound_id='$choosen_ultrasound_id' and baby_number='3';");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$amniotic_fluid_baby_3_check = $_SESSION['temp'];
				
				
				if ($presentation_baby_3 != $presentation_baby_3_check or $placenta_baby_3 != $placenta_baby_3_check or $fetal_movement_baby_3 != $fetal_movement_baby_3_check or $fetal_heartbeat_baby_3 != $fetal_heartbeat_baby_3_check or $amniotic_fluid_baby_3 != $amniotic_fluid_baby_3_check) {
					
					$stmt = $conn->prepare("SELECT timestamp FROM baby WHERE ultrasound_id='$choosen_ultrasound_id' and baby_number='3';");
					$stmt->execute();
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
					
					foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
					
					}
					$timestamp = $_SESSION['temp'];
					
					$query = "INSERT INTO baby_history (baby_id, ultrasound_id, client_id, first_name, last_name, sex, location, date_of_birth, baby_number, presentation, placenta, fetal_movement, fetal_heartbeat, amniotic_fluid, timestamp, clinician, created_by) VALUES ('$baby_id','$choosen_ultrasound_id', '$client_id', '$first_name', '$last_name', '$sex', '$location', '$date_of_birth', '3', '$presentation_baby_3_check', '$placenta_baby_3_check', '$fetal_movement_baby_3_check', '$fetal_heartbeat_baby_3_check', '$amniotic_fluid_baby_3_check', '$timestamp', '$clinician_check', '$created_by_check');"; 
					$conn->exec($query);
				
					$sql = "UPDATE baby SET presentation='$presentation_baby_3', placenta='$placenta_baby_3', fetal_movement='$fetal_movement_baby_3', fetal_heartbeat='$fetal_heartbeat_baby_3', amniotic_fluid='$amniotic_fluid_baby_3', clinician='$clinician', created_by='$username' WHERE ultrasound_id='$choosen_ultrasound_id' and baby_number='3';"; 
					$stmt = $conn->prepare($sql);
					$stmt->execute();
					
				}
			}
		
		
		}

		catch(PDOException $e) {
			echo $sql . '<br>' . $e->getMessage();	
		}
	}
	
	$_SESSION['temp'] = '';
	
	
	if ($presentation_baby_4 != 'none') {
		try {
			$stmt = $conn->prepare("SELECT presentation FROM baby WHERE ultrasound_id='$choosen_ultrasound_id' and baby_number='4';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$presentation_baby_4_check = $_SESSION['temp'];
			
			
			if ($presentation_baby_4_check == '') {
				
				$query = "INSERT INTO baby (ultrasound_id, client_id, first_name, last_name, sex, location, date_of_birth, baby_number, presentation, placenta, fetal_movement, fetal_heartbeat, amniotic_fluid, clinician, created_by) VALUES ('$choosen_ultrasound_id', '$client_id', '$first_name', '$last_name', '$sex', '$location', '$date_of_birth', '4', '$presentation_baby_4', '$placenta_baby_4', '$fetal_movement_baby_4', '$fetal_heartbeat_baby_4', '$amniotic_fluid_baby_4', '$clinician', '$username');"; 
				$conn->exec($query);
			}
			else {
				$stmt = $conn->prepare("SELECT baby_id FROM baby WHERE ultrasound_id='$choosen_ultrasound_id' and baby_number='4';");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$baby_id = $_SESSION['temp'];
				
				
				$stmt = $conn->prepare("SELECT placenta FROM baby WHERE ultrasound_id='$choosen_ultrasound_id' and baby_number='4';");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$placenta_baby_4_check = $_SESSION['temp'];
				
				
				$stmt = $conn->prepare("SELECT fetal_movement FROM baby WHERE ultrasound_id='$choosen_ultrasound_id' and baby_number='4';");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$fetal_movement_baby_4_check = $_SESSION['temp'];
				
				
				$stmt = $conn->prepare("SELECT fetal_heartbeat FROM baby WHERE ultrasound_id='$choosen_ultrasound_id' and baby_number='4';");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$fetal_heartbeat_baby_4_check = $_SESSION['temp'];
				
				
				$stmt = $conn->prepare("SELECT amniotic_fluid FROM baby WHERE ultrasound_id='$choosen_ultrasound_id' and baby_number='4';");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$amniotic_fluid_baby_4_check = $_SESSION['temp'];
				
				
				if ($presentation_baby_4 != $presentation_baby_4_check or $placenta_baby_4 != $placenta_baby_4_check or $fetal_movement_baby_4 != $fetal_movement_baby_4_check or $fetal_heartbeat_baby_4 != $fetal_heartbeat_baby_4_check or $amniotic_fluid_baby_4 != $amniotic_fluid_baby_4_check) {
					
					$stmt = $conn->prepare("SELECT timestamp FROM baby WHERE ultrasound_id='$choosen_ultrasound_id' and baby_number='4';");
					$stmt->execute();
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
					
					foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
					
					}
					$timestamp = $_SESSION['temp'];
					
					
					$query = "INSERT INTO baby_history (baby_id, ultrasound_id, client_id, first_name, last_name, sex, location, date_of_birth, baby_number, presentation, placenta, fetal_movement, fetal_heartbeat, amniotic_fluid, timestamp, clinician, created_by) VALUES ('$baby_id','$choosen_ultrasound_id', '$client_id', '$first_name', '$last_name', '$sex', '$location', '$date_of_birth', '4', '$presentation_baby_4_check', '$placenta_baby_4_check', '$fetal_movement_baby_4_check', '$fetal_heartbeat_baby_4_check', '$amniotic_fluid_baby_4_check', '$timestamp', '$clinician_check', '$created_by_check');"; 
					$conn->exec($query);
				
					$sql = "UPDATE baby SET presentation='$presentation_baby_4', placenta='$placenta_baby_4', fetal_movement='$fetal_movement_baby_4', fetal_heartbeat='$fetal_heartbeat_baby_4', amniotic_fluid='$amniotic_fluid_baby_4', clinician='$clinician', created_by='$username' WHERE ultrasound_id='$choosen_ultrasound_id' and baby_number='4';"; 
					$stmt = $conn->prepare($sql);
					$stmt->execute();
					
				}
			}
		
		
		}

		catch(PDOException $e) {
			echo $sql . '<br>' . $e->getMessage();	
		}
	}
	
	$_SESSION['temp'] = '';
	
	// archive image to history folder
	if ($package_path_check != 'no_image' and $package_path != 'no_image'){
		rename($package_path_check, '../../uploaded_images/no_longer_used/ultrasound_images_history/' . substr($package_path_check, strposX($package_path_check, '/', 5) + 1));
		
	}	
	// make sure the image is not replaced, if an image exists in the database
	elseif ($package_path_check and $package_path == 'no_image'){
		$package_path = $package_path_check;
	}
	
	try {
		
		if ( $t != $t_check or $bp != $bp_check or $pr != $pr_check or $rr != $rr_check or $sao2 != $sao2_check or $pain != $pain_check or $lmp != $lmp_check or $week_pregnant != $week_pregnant_check or $edd_per_lmp != $edd_per_lmp_check or $g_lmp != $g_lmp_check or $t_lmp != $t_lmp_check or $p_lmp != $p_lmp_check or $l_lmp != $l_lmp_check or $significant_history != $significant_history_check or $ultrasound_findings != $ultrasound_findings_check or $fetal_number != $fetal_number_check or $edd_per_ultrasound != $edd_per_ultrasound_check or $other_findings != $other_findings_check or $clinician != $clinician_check or $package_path != $package_path_check) {
		echo 'hi';
			$query = "INSERT INTO ultrasound_history (ultrasound_id, client_id, first_name, last_name, sex, location, date_of_birth, t, bp, pr, rr, sao2, pain, lmp, weeks_pregnant, days_pregnant, edd_per_lmp, g_lmp, t_lmp, p_lmp, l_lmp, significant_history, ultrasound_findings, fetal_number, edd_per_ultrasound, other_findings, package_path, timestamp, clinician, created_by) SELECT ultrasound_id, client_id, first_name, last_name, sex, location, date_of_birth, t, bp, pr, rr, sao2, pain, lmp, weeks_pregnant, days_pregnant, edd_per_lmp, g_lmp, t_lmp, p_lmp, l_lmp, significant_history, ultrasound_findings, fetal_number, edd_per_ultrasound, other_findings, package_path, timestamp, clinician, created_by FROM ultrasound WHERE ultrasound_id='$choosen_ultrasound_id';"; 
			$conn->exec($query);
			
			
			// below is the update query
			$sql = "UPDATE ultrasound SET t='$t', bp='$bp', pr='$pr', rr='$rr', sao2='$sao2', pain='$pain', lmp='$lmp', weeks_pregnant='$weeks_pregnant', days_pregnant='$days_pregnant', edd_per_lmp='$edd_per_lmp', g_lmp='$g_lmp', t_lmp='$t_lmp', p_lmp='$p_lmp', l_lmp='$l_lmp', significant_history='$significant_history', ultrasound_findings='$ultrasound_findings', fetal_number='$fetal_number', edd_per_ultrasound='$edd_per_ultrasound', other_findings='$other_findings', package_path='$package_path', clinician='$clinician', created_by='$username' WHERE ultrasound_id='$choosen_ultrasound_id'"; 
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			
			
		
		}
		// redirect user back to where they can select a referral form
		header( 'Location: select_ultrasound.php');
		exit();
		
	}

	catch(PDOException $e) {
		create_database_error($query, 'update_ultrasound.php', $e->getMessage());
	}

		$conn = null;
	}
}
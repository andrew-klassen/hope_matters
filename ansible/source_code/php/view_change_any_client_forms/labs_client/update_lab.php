<!--
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
-->

<?php
require('../../database_credentials.php');
session_start();

// make sure user is logged in
login_check();

$clinician = $_POST['clinician'];

// single quotes need to be replaced with the correct excape keys for the following value
$clinician = str_replace('\'', '\\\'', $clinician);

class clinician_check extends RecursiveIteratorIterator {
			function __construct($it) {
				parent::__construct($it, self::LEAVES_ONLY);
			}
			function current() {
				parent::current();
			}
			function beginChildren() {
				echo "<tr>";
			}
			function endChildren() {
				echo "</tr>" . "\n";
			}
}

		
		// make database connection
		$conn = new PDO($dbconnection, $dbusername, $dbpassword);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		// check to see if the clinician account exists
		$stmt = $conn->prepare("SELECT username FROM accounts WHERE username='$clinician'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new clinician_check(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			echo $v;
			++$count;
		}


// if account exists		
if ($count){
	
	$username = $_SESSION['username'];
	$lab_id = $_SESSION['choosen_lab'];

	
	$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

	// gets the entire lab
	$stmt = $conn->prepare("SELECT * FROM lab WHERE lab_id=:lab_id");
	$stmt->execute(array('lab_id' => $lab_id));
	$lab_array = $stmt->fetch(PDO::FETCH_ASSOC);

	// all column names of checkbox values
	$stmt = $conn->prepare("SELECT COLUMN_NAME  FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'hope_matters' AND TABLE_NAME = 'lab' AND COLUMN_TYPE = 'enum(\'yes\',\'no\')';");
	$stmt->execute();
	$lab_radio_columns = $stmt->fetchAll(PDO::FETCH_ASSOC);


	// iterates through all the needed post values
	foreach ($_POST as $key => $value) {

		if ($value == 'on') {
			$value = 'yes';
		}
				
		if ($value != '' and $key != 'submit_button') {
			$update_query_string = $update_query_string . $key .  " = '" . query_format($value) . "', ";
			
		}

	}

	// checkboxes checked post a value of 'on', loop below sets all other values to no
	foreach ($lab_radio_columns as $row) {

		if (strpos($update_query_string, $row['COLUMN_NAME']) === false) {
			$column_name = $row['COLUMN_NAME'];
			$update_query_string = $update_query_string . $row['COLUMN_NAME'] .  " = 'no', ";
		}		
		
	}

	// preps the insert_query_string for history insert
	foreach ($lab_array as $key => $value) {

		$insert_query_string = $insert_query_string . $key . ", ";

	}


	$insert_query_string = substr($insert_query_string, 0, -2);
	$update_query_string = $update_query_string . "created_by='$username'";

 
	try {
	

			$query = "INSERT INTO lab_history ($insert_query_string) SELECT $insert_query_string FROM lab WHERE lab_id='$lab_id';"; 
			$conn->exec($query);

			$query = "UPDATE lab SET $update_query_string WHERE lab_id='$lab_id';"; 
			$stmt = $conn->prepare($query);
			$stmt->execute();
		

		// redirect the user back to lab selection
		header( 'Location: ../view_all_form.php');
		exit();
		
	}

	catch(PDOException $e) {
		
		create_database_error($query, 'update_lab_form.php', $e->getMessage());	
			
	}

	$conn = null;

}
		
// if account does not exist
else {
	echo "<script type='text/javascript'>
			alert('The clinician you have provided was not found in the database.'); 
			document.location.href = 'select_lab.php'; 
		 </script>";
}

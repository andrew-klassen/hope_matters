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


// general info needs to be collected if client is linked
if ($_SESSION['client_linked'] == 'true') {

		$conn = new PDO($dbconnection, $dbusername, $dbpassword);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


		$client_id = $_SESSION['choosen_client_id'];
	
	        // grab first name
		$stmt = $conn->prepare("SELECT first_name FROM general_info WHERE client_id='$client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$first_name = $_SESSION['temp'];
		
		
		// grab last name
		$stmt = $conn->prepare("SELECT last_name FROM general_info WHERE client_id='$client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$last_name = $_SESSION['temp'];
		
		
		// grab sex
		$stmt = $conn->prepare("SELECT sex FROM general_info WHERE client_id='$client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$sex = $_SESSION['temp'];
		
		
		// grab location
		$stmt = $conn->prepare("SELECT location FROM general_info WHERE client_id='$client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$location = $_SESSION['temp'];
		
		
		// grab date of birth
		$stmt = $conn->prepare("SELECT date_of_birth FROM general_info WHERE client_id='$client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$date_of_birth = $_SESSION['temp'];
	
		// single quotes need to be replaced with the correct excape keys for the following values
		$first_name = str_replace('\'', '\\\'', $first_name);
		$last_name = str_replace('\'', '\\\'', $last_name);
		$location = str_replace('\'', '\\\'', $location);

}

$conn = new PDO($dbconnection_custom, $dbusername, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$table_name = $_SESSION['database_table_name'];
$username = $_SESSION['username'];
$table_columns_temp = $_SESSION['table_columns'];
$table_columns_temp_max = count($_SESSION['table_columns']);
$start_found = false;


// get all form specific columns 
$table_columns = array();
for($i = 0; $i < $table_columns_temp_max; ++$i) {

	if ($table_columns_temp[$i] == $_SESSION['start_column']) {
		$start_found = true;
	}
	if ($table_columns_temp[$i] == 'timestamp') {
		break;
	}
	else if ($start_found){
		
		if ( ! strstr( $table_columns_temp[$i], 'column_' )) {
			array_push($table_columns, $table_columns_temp[$i]);
		}

	}	
}
 

// create insert query strings
$table_columns_max = count($table_columns);

for($i = 0; $i < $table_columns_max; ++$i) {

	$insert_columns = $insert_columns . '`' . $table_columns[$i] . '`' . ', '; 
	$current_column = query_format($table_columns[$i]);
	$html_name = html_name_format($table_columns[$i]);

	$stmt = $conn->prepare("SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'custom_forms' AND TABLE_NAME = '$table_name' AND COLUMN_NAME = '$current_column';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
					
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
						
	}
	$current_column_type = $_SESSION['temp'];

	
	// if image upload column
	if ($current_column_type == 'varchar(1000)') {
		$temp_table_column = $table_columns[$i];
		$temp_image_name = $_FILES[$temp_table_column]['name'];
		$image_path = upload_file($temp_table_column, $temp_image_name, 'add_custom_form.php', "../../uploaded_images/custom_forms/{$table_name}/in_use/");

		$insert_values = $insert_values . "'" . $image_path . "'" . ', ';
	}
	else {
		$insert_values = $insert_values . "'" . query_format($_POST[$html_name]) . "'" . ', ';
	}

}

// removes the ending comma
$insert_columns = substr($insert_columns, 0, -2);
$insert_values = substr($insert_values, 0, -2);


	try {		
		
		if ($_SESSION['client_linked'] == 'true') {

			$query = "INSERT INTO $table_name (client_id, first_name, last_name, sex, location, date_of_birth, created_by, $insert_columns) VALUES ('$client_id', '$first_name', '$last_name', '$sex', '$location', '$date_of_birth', '$username', $insert_values);"; 
			$conn->exec($query);

		}
		else {

			$query = "INSERT INTO $table_name (created_by, $insert_columns) VALUES ('$username', $insert_values);"; 
			$conn->exec($query);

		}

		header( 'Location: /php/custom_forms/select_add_or_change.php');
		exit();

	}

	catch(PDOException $e) {
		create_database_error($query, 'insert_custom_form.php', $e->getMessage());
	}

$conn = null;

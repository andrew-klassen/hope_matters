<!--
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
-->

<?php

require('../database_credentials.php');
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


$account_id = $_SESSION['account_id'];	
$username = $_SESSION['username'];
$name = $_POST['name'];
$type = $_POST['type'];
$count = $_POST['count'];

// for when item is not given a value
if ($value == "''"){
	$value = 'NULL';
} else {
	$value = "'" . $_POST['value'] . "'";
}

$notes = $_POST['notes'];

	
// make database connection
$conn = new PDO($dbconnection, $dbusername, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$_SESSION['temp'] = '';

$stmt = $conn->prepare("SELECT inventory_id FROM inventory WHERE name='$name';");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$duplicate_item_id = $_SESSION['temp'];


// if id is not found
if ($duplicate_item_id != '') {
	echo "<script type='text/javascript'>
			alert('The item already exists.'); 
			document.location.href = '/html/add_item.html'; 
		  </script>";
}else {


	try {
			
		$query = "INSERT INTO inventory (name, type, count, value, notes, created_by) VALUES ('$name', '$type', '$count', $value, '$notes', '$username');"; 
		$conn->exec($query);
				
		// redirect user back to where they can add more items
		header( 'Location: /html/add_item.html');
		exit();

	}

	catch(PDOException $e) {
		create_database_error($query, 'insert_item.php', $e->getMessage());
	}

$conn = null;
}
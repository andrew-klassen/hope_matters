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





	
$username = $_SESSION['username'];
$barcode = $_POST['barcode'];
$count = $_POST['count'];




// make database connection
$conn = new PDO($dbconnection, $dbusername, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


try {
	if ($barcode != "" and $count != "") {
		// insert old inventory record into the history table
		$query = "INSERT INTO inventory_history (inventory_id, barcode, name, type, count, value, notes, timestamp, created_by) SELECT inventory_id, barcode, name, type, count, value, notes, timestamp, created_by FROM inventory WHERE barcode='$barcode';"; 
		$conn->exec($query);

		echo $query = "INSERT INTO inventory_change (inventory_id, barcode, name, type, value, notes, amount, timestamp, created_by) SELECT inventory_id, barcode, name, type, value, notes, '$count', timestamp, created_by FROM inventory WHERE barcode='$barcode';"; 
	//exit();
		$conn->exec($query);
		
		// update the record
		$query = "UPDATE inventory SET count= count + '$count', created_by='$username' WHERE barcode='$barcode';"; 
		$conn->exec($query);
	}
				
	// redirect user back to where they can add more items
	header( 'Location: /html/add_item.html');
	exit();

}

catch(PDOException $e) {
	create_database_error($query, 'add_item.php', $e->getMessage());
}

$conn = null;

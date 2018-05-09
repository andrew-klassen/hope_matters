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


$inventory_id = $_SESSION['choosen_item_id'];
	
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

// replace single quotes with correct excape keys
$notes = str_replace('\'', '\\\'', $notes);

// make database connection
$conn = new PDO($dbconnection, $dbusername, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


try {
	
	// insert old inventory record into the history table
	$query = "INSERT INTO inventory_history (inventory_id, name, type, count, value, notes, timestamp, created_by) SELECT inventory_id, name, type, count, value, notes, timestamp, created_by FROM inventory WHERE inventory_id='$inventory_id';"; 
	$conn->exec($query);
	
	// update the record
	$query = "UPDATE inventory SET  name='$name', type='$type', count='$count', value=$value, notes='$notes', created_by='$username' WHERE inventory_id='$inventory_id';"; 
	$conn->exec($query);
				
	// redirect user back to where they can add more items
	header( 'Location: /php/inventory/select_item.php');
	exit();

}

catch(PDOException $e) {
	create_database_error($query, 'update_item.php', $e->getMessage());
}

$conn = null;
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
$tag = $_POST['tag'];
$amount = $_POST['amount'];

$notes = $_POST['notes'];

// replace single quotes with correct excape keys
$notes = str_replace('\'', '\\\'', $notes);
	
// make database connection
$conn = new PDO($dbconnection, $dbusername, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



	try {
			
		$query = "INSERT INTO expenses (name, tag, amount, notes, created_by) VALUES ('$name', '$tag', '$amount', '$notes', '$username');"; 
		$conn->exec($query);
				
		// redirect user back to where they can add more items
		header( 'Location: /html/add_expense.html');
		exit();

	}

	catch(PDOException $e) {
		create_database_error($query, 'insert_expense.php', $e->getMessage());
	}

$conn = null;

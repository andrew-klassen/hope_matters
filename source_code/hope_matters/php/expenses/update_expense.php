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


$expense_id = $_SESSION['choosen_expense_id'];
	

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
	
	// insert old inventory record into the history table
	$query = "INSERT INTO expenses_history (expense_id, name, tag, amount, notes, created_by) SELECT expense_id, name, tag, amount, notes, created_by FROM expenses WHERE expense_id='$expense_id';"; 
	$conn->exec($query);
	
	// update the record
	$query = "UPDATE expenses SET name='$name', tag='$tag', amount='$amount', notes='$notes', created_by='$username' WHERE expense_id='$expense_id';"; 
	$conn->exec($query);
				
	// redirect user back to where they can add more items
	header( 'Location: /php/expenses/select_expense.php');
	exit();

}

catch(PDOException $e) {
	create_database_error($query, 'update_expense.php', $e->getMessage());
}

$conn = null;
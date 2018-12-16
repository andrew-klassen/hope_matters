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


$secret_id = $_SESSION['choosen_secret_id'];
$secret_password = $_SESSION['login_password'];


// make database connection
$conn = new PDO($dbconnection, $dbusername, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


//************ if more than one valid key exists, with different permissions, the admin permission takes affect ************

// see if there are any read-only keys
$_SESSION['temp'] = '';
$stmt = $conn->prepare("SELECT AES_DECRYPT(`key`, '$secret_password') FROM secret_keys WHERE secret_id='$secret_id' and AES_DECRYPT(`key`, '$secret_password') is not NULL and privilege = 'read';");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$temp_value = $_SESSION['temp'];


// if valid read-only key exists
if ($temp_value != NULL) {
	$value = $temp_value;
	$privilege = "read";
}


// see if there are any admin keys
$_SESSION['temp'] = '';
$stmt = $conn->prepare("SELECT AES_DECRYPT(`key`, '$secret_password') FROM secret_keys WHERE secret_id='$secret_id' and AES_DECRYPT(`key`, '$secret_password') is not NULL and privilege = 'admin';");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$temp_value = $_SESSION['temp'];


// if valid admin key exists
if ($temp_value != NULL) {
	$value = $temp_value;
	$privilege = "admin";
}


// if no valid keys exist
if (! isset($value)) {
	
	echo "<script type='text/javascript'>alert('No key with the password found.')
		document.location.href = 'authorize_secret.php';	
	      </script>";
	exit();

}


// wipe the value and privilege to prevent sensitive data from being stored in user's session
$_SESSION['value'] = $value;
$_SESSION['privilege'] = $privilege;


header( 'Location: show_secret.php');
exit();

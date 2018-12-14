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
$secret_password = $_POST['secret_password'];
$account_id = $_SESSION['account_id'];


	
// make database connection
$conn = new PDO($dbconnection, $dbusername, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



$stmt = $conn->prepare("SELECT password FROM accounts WHERE account_id = '$account_id';");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$password = $_SESSION['temp'];



$secret_password = $password . $account_id;

$_SESSION['temp'] = '';


$stmt = $conn->prepare("SELECT secret_key_temp_id FROM secret_keys_temp WHERE secret_id='$secret_id' and AES_DECRYPT(`key`, '$secret_password') is not NULL and privilege = 'read';");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$secret_key_temp_id = $_SESSION['temp'];






$stmt = $conn->prepare("SELECT secret_key_temp_id FROM secret_keys_temp WHERE secret_id='$secret_id' and AES_DECRYPT(`key`, '$secret_password') is not NULL and privilege = 'admin';");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$secret_key_temp_id = $_SESSION['temp'];






$stmt = $conn->prepare("SELECT AES_DECRYPT(`key`, '$secret_password') FROM secret_keys_temp WHERE secret_key_temp_id = '$secret_key_temp_id';");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$value = $_SESSION['temp'];







if ($secret_key_temp_id == '') {
	echo "<script type='text/javascript'>alert('You don\'t have permission to create a key.')
		document.location.href = 'authorize_secret.php';	
	</script>";
	exit();


}




$_SESSION['value'] = $value;
$_SESSION['privilege'] = $privilege;
$_SESSION['secret_password'] = $secret_password;
$_SESSION['secret_key_temp_id'] = $secret_key_temp_id;



header( 'Location: add_secret_key_one_time.php');
exit();




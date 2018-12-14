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

$_SESSION['temp'] = '';
$secret_id = $_SESSION['choosen_secret_id'];
$secret_password = $_POST['secret_password'];


$key_file = read_key_file('key_file');
$secret_password = $secret_password . $key_file;
	
// make database connection
$conn = new PDO($dbconnection, $dbusername, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$stmt = $conn->prepare("SELECT AES_DECRYPT(`key`, '$secret_password') FROM secret_keys WHERE secret_id='$secret_id' and AES_DECRYPT(`key`, '$secret_password') is not NULL and privilege = 'read';");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$temp_value = $_SESSION['temp'];
echo $temp_value . 'a' . "<br>";


if ($temp_value != NULL) {
	$value = $temp_value;
	$privilege = "read";
}






$stmt = $conn->prepare("SELECT AES_DECRYPT(`key`, '$secret_password') FROM secret_keys WHERE secret_id='$secret_id' and AES_DECRYPT(`key`, '$secret_password') is not NULL and privilege = 'admin';");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

}
$temp_value = $_SESSION['temp'];
echo $temp_value . 'b' . "<br>";


if ($temp_value != NULL) {
	$value = $temp_value;
	$privilege = "admin";
}

echo $value . "<br>";
echo $privilege . "<br>";
echo $secret_password;



if (! isset($value)) {
	echo "<script type='text/javascript'>alert('No key with the password found.')
		document.location.href = 'authorize_secret.php';	
	</script>";
	exit();


}




$_SESSION['value'] = $value;
$_SESSION['privilege'] = $privilege;




header( 'Location: show_secret.php');
exit();




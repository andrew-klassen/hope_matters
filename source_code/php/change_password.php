<!--
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
-->

<?php

require('database_credentials.php');
require('password_validation.php');
session_start();

$account_id = $_SESSION['account_id'];
$old_password = $_POST['old_password'];
$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];


class login extends RecursiveIteratorIterator {
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


try {
	/* create new connection */
    $conn = new PDO($dbconnection, $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// make sure an account exists with the correct account id and password
    $stmt = $conn->prepare("SELECT account_id FROM accounts WHERE password='$old_password' AND account_id=$account_id;");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach(new login(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
        echo $v;
		++$count;
    }
	
	// if count is 1, then the account exists
	if ($count) {
		
		// update account with new password
		if (password_check($new_password, $confirm_password)) {
			$sql = "UPDATE accounts SET password='$new_password' WHERE account_id='$account_id'";
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			
			// redirect to dashbored
			header('Location: /php/dashboard.php');
			exit();	
		}
		
	}
	else {
	
		// notifiy user that their password is invalid
		echo "<script type='text/javascript'>
				alert('Old Password Invaild'); 
				document.location.href = '/html/change_password.html'; 
			 </script>";
	}
}

catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
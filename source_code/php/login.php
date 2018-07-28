<!--
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
-->

<?php

require('database_credentials.php');
include ('Net/SSH2.php');
session_start();

$username = $_POST['username'];
$password = $_POST['password'];


class login extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }
    function current() {
		// grab the account id, if a matching account is found
		$_SESSION['account_id'] = parent::current();
    }
    function beginChildren() {
        echo "<tr>";
    }
    function endChildren() {
        echo "</tr>" . "\n";
    }
}

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


try {
	// create new connection 
    $conn = new PDO($dbconnection, $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// make sure account with username and password exists
    $stmt = $conn->prepare("SELECT account_id FROM accounts WHERE username=:username and password=:password;");
    $stmt->execute(array('username' => $username, 'password' => $password));
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach(new login(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
        echo $v;
		++$count;
    }
	
	// count is used to determine whether or not if the email and password are valid 
	if ($count) {
		
		// make sure the config file has STORAGE_CHECK turned on
		if (STORAGE_CHECK) {
			
			// see if the user is a server_admin
			$stmt = $conn->prepare("SELECT server_admin FROM accounts WHERE username='$username' and password='$password';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
					
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
					
			}
			$server_admin = $_SESSION['temp'];
			
			if ($server_admin == 'yes') {

				 $ssh_connection = new Net_SSH2(SERVER_WITH_STORAGE_ARRAY);
				 if (!$ssh_connection->login(USERNAME, PASSWORD)) {
					 exit('Login Failed');
				 }
			if (substr_count($ssh_connection->exec('/opt/MegaRAID/storcli/storcli64 /c0 show all | grep ^64:'), 'Onln') != NUMBER_OF_HARD_DRIVES){
					 header('Location: /php/storage_error.php');
					 exit();
				 }
				
				
			}
			
		}
		
		// redirect to dashboard
		header('Location: /php/dashboard.php');
		exit();
	}
	else {
	
		// calls javascript to notify the user that their email or password is invalid 
		echo "<script type='text/javascript'>
				alert('Invaild Username or Password'); 
				document.location.href = '../index.html'; 
			 </script>";
	}
	
}

catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;

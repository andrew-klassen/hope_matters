<!--
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
-->

<!--
This file is no longer in use, due to the user's decision. However, it is left in the project 
because it is still functional and could be potentially useful.
-->

<?php

require('../database_credentials.php');
session_start();

// make sure user is logged in
login_check();
master_log_check();

$client_id = $_POST['client_id'];

$_SESSION['temp'] = '';

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


			// make database connection
			$conn = new PDO($dbconnection, $dbusername, $dbpassword);
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			
			$stmt = $conn->prepare("SELECT client_id FROM general_info WHERE client_id='$client_id';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$client_id_check = $_SESSION['temp'];
			
			// see if user provided a client id
			if ($client_id_check == '') {
				
				echo "<script type='text/javascript'>
					alert('There was no client with this ID found in the database.'); 
					document.location.href = 'master_log.php'; 
				</script>";
				
			} 
			else {
			
				$_SESSION['client_id'] = $client_id;
				header("Location: master_log_client.php");
				exit();
			
			}
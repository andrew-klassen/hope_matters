<!--
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
-->

<head>
	<title>Hope Matters</title>
	<link rel="icon" href="/images/hope_matters_logo.png">
	<link rel="stylesheet" type="text/css" href="/css/navbar.css">
	<link rel="stylesheet" type="text/css" href="/css/view_client.css">
</head>

<!-- nav bar-->
<div id="container">
	   
		
	  <div id="sign-out">
        <form method="post" action="/php/dashboard.php">
            <input type="submit" value="Dashboard">
        </form>
      </div>
	  
	  <div id="sign-out">
        <form method="post" action="/php/sign_out.php">
            <input type="submit" value="Sign Out">
        </form>
      </div>
	  
  </div>
  <br></br>

  <header>Check out Clients</header>
  
<!-- start of the search for clients card-->
<div class="login-card">
  

<?php
require("../database_credentials.php");
session_start();

login_check();

$_SESSION['temp'] = 0;
$_SESSION['choosen_client_id'] = 0;

// grab current search and date of birth date
$search = $_POST['search'];
$date_of_birth = $_POST['date_of_birth'];

class view_clients extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }
	
    function current() {
		$_SESSION['choosen_client_id'] = parent::current();
		
		if (($_SESSION['counter'] == 0) or ($_SESSION['counter'] % 6 == 0)) {
		
			$_SESSION['temp'] = $_SESSION['choosen_client_id'];
			
		}
		$temp = $_SESSION['temp'];
																					
		return "<td style='border-style: solid; border-color: #black; background-color: white; color: black;font-weight: 500;font-size: 12px;font-size: 30px;  '>" . "<a href='grab_choosen_client_id_check_out.php? choosen_client_id=$temp' style='color: black;'>" . parent::current() . "</a>" . "</td>";
  
    }
    function beginChildren() {
        echo "<tr>";
    }
    function endChildren() {
        echo "</tr>" . "\n";
    }
}


try {
	// establish database connection
    $conn = new PDO($dbconnection, $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
	echo "<p style='color: black;;text-align: center;'>Below are clients who are currently checked in.</p>";
	echo "<p style='color: black;;text-align: center;'>Click on a client to check them out.</p>";
	
	
    echo "<div id='tableCard'>";
	
		echo "<table style='border: none;'>";
		echo "<tr><th>Client ID</th><th>First Name</th><th>Last Name</th><th>Sex</th><th>Age</th><th>Check In Time</th></tr>";

		// display all clients in order by check in time (oldest times first)
		$stmt = $conn->prepare("SELECT client_id, first_name, last_name, sex, DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(date_of_birth, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(date_of_birth, '00-%m-%d')), date_format(check_in, '%b %d %Y %h:%i %p') FROM current_clients WHERE check_out IS NULL ORDER BY check_in ASC LIMIT $wild_card_limit;");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$_SESSION['counter'] = 0;
		foreach(new view_clients(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		   echo $v;
		   ++$_SESSION['counter'];
		}
		
	echo "</table>";
    echo "</div>";

}

catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;

echo "</div>";
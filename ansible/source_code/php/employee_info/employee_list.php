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

<!-- nav bar -->
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

  
<header>Employee Info</header>


<!-- start of select client card --> 
<div class="login-card">
  

<?php

require('../database_credentials.php');
session_start();

// make sure user is logged in
login_check();

$_SESSION['temp'] = 0;
$_SESSION['choosen_employee_id'] = 0;

$search = $_POST['search'];

class view_clients extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }
	
	// this function creates an invisible <a link> that passes the clients id to the next page
    function current() {
	
		$_SESSION['choosen_employee_id'] = parent::current();
		
		// since there are 6 fields being displayed in the table, $_SESSION['counter'] == 0 or $_SESSION['counter'] % 6 == 0
		if (($_SESSION['counter'] == 0) or ($_SESSION['counter'] % 5 == 0)) {
		
			$_SESSION['temp'] = $_SESSION['choosen_employee_id'];
			
		}
		$temp = $_SESSION['temp'];
		
		return "<td style='border-style: solid; border-color: #black; background-color: white; color: black;font-weight: 500;font-size: 12px;font-size: 30px;  '>" . "<a href='grab_choosen_employee_id.php? choosen_employee_id=$temp' style='color: black;'>"  . parent::current() . "</a>" . "</td>";
  
    }
    function beginChildren() {
        echo "<tr>";
    }
    function endChildren() {
        echo "</tr>" . "\n";
    }
}



try {
	
	// make database connection
    $conn = new PDO($dbconnection, $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
    
	echo "<p style='color: black;;text-align: center;'>Click on an employee to see more of their infomation.</p>";
	echo "<p style='color: black;;text-align: center;'>Search for an employee by account ID or name. Use * to see all employees.</p>";

	
	// search bar
	echo "<div id='searchDiv'>
	<form action='employee_list.php' method='post' id='searchForm'>
  		<input type='text' id='request_search' name='search' value='$search' autofocus onfocus='this.value = this.value;'>
  		<input type='submit' id='search_submit' value='Search'>
	</form>
	</div>";
	
	
    echo "<div id='tableCard'>";
	
	
	/******** determine if the user is searching by id, first name, or last name ********/
	
	// if the client is searching by id
	if (ctype_digit($search)) {
	
		echo "<table style='border: none;'>";
		echo "<tr><th>Account ID</th><th>Username</th><th>First Name</th><th>Last Name</th><th>Job Title</th></tr>";
		
		$stmt = $conn->prepare("SELECT account_id, username, first_name, last_name, job_title FROM accounts WHERE account_id='$search'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$_SESSION['counter'] = 0;
		foreach(new view_clients(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		   echo $v;
		   ++$_SESSION['counter'];
		}
	}
	
	// if the client is using a wild card
	elseif ($search == '*') {
	
		echo "<table style='border: none;'>";
		echo "<tr><th>Account ID</th><th>Username</th><th>First Name</th><th>Last Name</th><th>Job Title</th></tr>";
		
		$stmt = $conn->prepare("SELECT account_id, username, first_name, last_name, job_title FROM accounts ORDER BY account_id DESC LIMIT $wild_card_limit;");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$_SESSION['counter'] = 0;
		foreach(new view_clients(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		   echo $v;
		   ++$_SESSION['counter'];
		}
   }
	
	// if the client is searching by name
	elseif ($search) {
		
		echo "<table style='border: none;'>";
		echo "<tr><th>Account ID</th><th>Username</th><th>First Name</th><th>Last Name</th><th>Job Title</th></tr>";
		
		$stmt = $conn->prepare("SELECT account_id, username, first_name, last_name, job_title FROM accounts WHERE CONCAT(first_name, ' ', last_name) LIKE '%$search%' ORDER BY CASE WHEN CONCAT(first_name, ' ', last_name) LIKE '$search' THEN 1 ELSE 2 END, account_id desc LIMIT $search_limit;");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$_SESSION['counter'] = 0;
		foreach(new view_clients(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		   echo $v;
		   ++$_SESSION['counter'];
		}
    }

	echo "</table>";
    echo "</div>";

}


catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;

?>

</div>
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


<header>Pick a Dental Form</header>


<!-- begining of the card -->
<div class="login-card">
  

<?php

require('../database_credentials.php');
session_start();

// make sure the user is logged in
login_check();

$_SESSION['temp'] = 0;
$_SESSION['choosen_dental_form_id'] = 0;

// grab current search and date of birth date
$search = $_POST['search'];
$date_of_birth = $_POST['date_of_birth'];

class view_clients extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }
	
	// this function creates an invisible <a link> that passes the form id to the next page
    function current() {
	
		$_SESSION['choosen_dental_form_id'] = parent::current();
		
		// since there are 6 fields being displayed in the table, $_SESSION['counter'] == 0 or $_SESSION['counter'] % 6 == 0
		if (($_SESSION['counter'] == 0) or ($_SESSION['counter'] % 6 == 0)) {
		
			$_SESSION['temp'] = $_SESSION['choosen_dental_form_id'];
			
		}
		$temp = $_SESSION['temp'];
		
		return "<td style='border-style: solid; border-color: #black; background-color: white; color: black;font-weight: 500;font-size: 12px;font-size: 30px;  '>" . "<a href='grab_choosen_dental_form_id.php? choosen_dental_form_id=$temp' style='color: black;'>"  . parent::current() . "</a>" . "</td>";
  
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
   
	echo "<p style='color: black;;text-align: center;'>Click on a dental form.</p>";
	echo "<p style='color: black;;text-align: center;'>Search for a dental form by ID or name. Use * to see all dental forms.</p>";
	
	echo "<div id='searchDiv'>
	<form action='select_dental_form.php' method='post' id='searchForm'>
  		<div style='width: 800px; padding-left: 530px;'>
			<input type='text' id='request_search' name='search' value='$search' autofocus onfocus='this.value = this.value;'>
			<input type='submit' id='search_submit' value='Search'>
			Date of Birth (optional) <input type='date' name='date_of_birth' value='$date_of_birth'>
		</div>
	</form>
	</div>";
	
	// prep the date of birth varibles for the query, if no date of birth wipe the memory location
	if ($date_of_birth != '') {
		$query_date_of_birth = "and date_of_birth = '$date_of_birth'";
		$query_date_of_birth_wild = "WHERE date_of_birth = '$date_of_birth'";
	} else {
		$query_date_of_birth = '';
		$query_date_of_birth_wild = '';
	}
	
	
    echo "<div id='tableCard'>";
	
	
	/******** determine if the user is searching by id, first name, or last name ********/
	
	
	// if the client is searching by id
	if (ctype_digit($search)) {
	
		echo "<table style='border: none;'>";
		echo "<tr><th>Form ID</th><th>First Name</th><th>Last Name</th><th>Sex</th><th>Age</th><th>Time Edited</th></tr>";
		
		$stmt = $conn->prepare("SELECT dental_form_id, first_name, last_name, sex, DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(date_of_birth, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(date_of_birth, '00-%m-%d')), date_format(timestamp, '%b %d %Y %h:%i %p') FROM dental_form WHERE dental_form_id='$search' $query_date_of_birth;");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$_SESSION['counter'] = 0;
		foreach(new view_clients(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		   echo $v;
		   ++$_SESSION['counter'];
		}
	}
	
	// if the client is searching by wild card
	elseif ($search == '*') {

		echo "<table style='border: none;'>";
		echo "<tr><th>Form ID</th><th>First Name</th><th>Last Name</th><th>Sex</th><th>Age</th><th>Time Edited</th></tr>";
		
		$stmt = $conn->prepare("SELECT dental_form_id, first_name, last_name, sex, DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(date_of_birth, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(date_of_birth, '00-%m-%d')), date_format(timestamp, '%b %d %Y %h:%i %p') FROM dental_form $query_date_of_birth_wild ORDER BY dental_form_id DESC LIMIT $wild_card_limit;");
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
		echo "<tr><th>Form ID</th><th>First Name</th><th>Last Name</th><th>Sex</th><th>Age</th><th>Time Edited</th></tr>";
		
		$stmt = $conn->prepare("SELECT dental_form_id, first_name, last_name, sex, DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(date_of_birth, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(date_of_birth, '00-%m-%d')), date_format(timestamp, '%b %d %Y %h:%i %p') FROM dental_form WHERE concat(first_name, ' ', last_name) LIKE '%$search%' $query_date_of_birth ORDER BY CASE WHEN concat(first_name, ' ', last_name) LIKE '$search' THEN 1 ELSE 2 END, dental_form_id desc LIMIT $search_limit;");
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
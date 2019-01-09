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

	<div id="sign-out" style="float: left; width: 400px;">
        <form method="post" action="/php/custom_forms/select_add_or_change.php">
            <input style="width: 400px;" type="submit" value="Back to Form Dashboard">
        </form>
      </div>

</div>
<br></br>

  
<header>Pick a Form</header>

<!-- start of select client card --> 
<div class="login-card">
  

<?php

require('../database_credentials.php');
session_start();

// make sure user is logged in
login_check();

$_SESSION['temp'] = 0;
$_SESSION['choosen_custom_form_id'] = 0;

// grab current search and date of birth date
$search = $_POST['search'];
$date_of_birth = $_POST['date_of_birth'];

class view_clients extends RecursiveIteratorIterator {
    
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }
	
    // this function creates an invisible <a link> that passes the clients id to the next page
    function current() {
	
		$_SESSION['choosen_custom_form_id'] = parent::current();
		
		// since there are 6 fields being displayed in the table, $_SESSION['counter'] == 0 or $_SESSION['counter'] % 6 == 0
		if (($_SESSION['counter'] == 0) or ($_SESSION['counter'] % 6 == 0)) {
		
			$_SESSION['temp'] = $_SESSION['choosen_custom_form_id'];
			
		}
		$temp = $_SESSION['temp'];
		
		return "<td style='border-style: solid; border-color: #black; background-color: white; color: black;font-weight: 500;font-size: 12px;font-size: 30px;  '>" . "<a href='grab_choosen_custom_form_id.php? choosen_custom_form_id=$temp' style='color: black;'>"  . parent::current() . "</a>" . "</td>";
  
    }
    function beginChildren() {
        echo "<tr>";
    }
    function endChildren() {
        echo "</tr>" . "\n";
    }

}

class view_clients_no_link extends RecursiveIteratorIterator {
    
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }
	
    // this function creates an invisible <a link> that passes the clients id to the next page
    function current() {
	
		$_SESSION['choosen_custom_form_id'] = parent::current();
		
		// since there are 6 fields being displayed in the table, $_SESSION['counter'] == 0 or $_SESSION['counter'] % 6 == 0
		if (($_SESSION['counter'] == 0) or ($_SESSION['counter'] % 3 == 0)) {
		
			$_SESSION['temp'] = $_SESSION['choosen_custom_form_id'];
			
		}
		$temp = $_SESSION['temp'];
		
		return "<td style='border-style: solid; border-color: #black; background-color: white; color: black;font-weight: 500;font-size: 12px;font-size: 30px;  '>" . "<a href='grab_choosen_custom_form_id.php? choosen_custom_form_id=$temp' style='color: black;'>"  . parent::current() . "</a>" . "</td>";
  
    }
    function beginChildren() {
        echo "<tr>";
    }
    function endChildren() {
        echo "</tr>" . "\n";
    }
}


try {
	
	// create the database connection
        $conn = new PDO($dbconnection_custom, $dbusername_custom, $dbpassword_custom);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$table_name = $_SESSION['database_table_name'];
	$table_id = $table_name . '_id';
   
	echo "<p style='color: black;;text-align: center;'>Click on a <b>" . $_SESSION['choosen_form'] . "</b> form to view/change it.</p>";


	if ($_SESSION['client_linked'] == 'true') {

		echo "<p style='color: black;;text-align: center;'>Search for a <b>" . $_SESSION['choosen_form'] . "</b> form by ID or client name. Use * to see all <b>" . $_SESSION['choosen_form'] . "</b> forms.</p>";
	
	}
	else {

		echo "<p style='color: black;;text-align: center;'>Search for a <b>" . $_SESSION['choosen_form'] . "</b> form by ID. Use * to see all <b>" . $_SESSION['choosen_form'] . "</b> forms.</p>";

	}
	
	echo "<div id='searchDiv'>
	<form action='select_custom_form_individual_form.php' method='post' id='searchForm'>
  		<div style='width: 800px; padding-left: 530px;'>
			<input type='text' id='request_search' name='search' value='$search' autofocus onfocus='this.value = this.value;'>
			<input type='submit' id='search_submit' value='Search'>";


	if ($_SESSION['client_linked'] == 'true') {
			echo "Date of Birth (optional) <input type='date' name='date_of_birth' value='$date_of_birth'>";
	}
		echo "</div>
		</form>
	</div>";
	

	if ($_SESSION['client_linked'] == 'true') {
		// prep the date of birth varibles for the query, if no date of birth wipe the memory location
		if ($date_of_birth != '') {
			$query_date_of_birth = "and date_of_birth = '$date_of_birth'";
			$query_date_of_birth_wild = "WHERE date_of_birth = '$date_of_birth'";
		} else {
			$query_date_of_birth = '';
			$query_date_of_birth_wild = '';
		}
	}
	
	
        echo "<div id='tableCard'>";
	
	/******** determine if the user is searching by id, first name, or last name ********/
	
	if ($_SESSION['client_linked'] == 'true') {

		// search by id
		if (ctype_digit($search)) {
		
			echo "<table style='border: none;'>";
			echo "<tr><th>Form ID</th><th>First Name</th><th>Last Name</th><th>Sex</th><th>Age</th><th>Time Edited</th></tr>";
			
			// get the client by id
			$stmt = $conn->prepare("SELECT $table_id, first_name, last_name, sex, DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(date_of_birth, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(date_of_birth, '00-%m-%d')), date_format(timestamp, '%b %d %Y %h:%i %p') FROM $table_name WHERE $table_id='$search' $query_date_of_birth;");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			$_SESSION['counter'] = 0;
			foreach(new view_clients(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			   echo $v;
			   ++$_SESSION['counter'];
			}
			
		}
		
		// wild card (everything)
		elseif ($search == '*') {
		
			echo "<table style='border: none;'>";
			echo "<tr><th>Form ID</th><th>First Name</th><th>Last Name</th><th>Sex</th><th>Age</th><th>Time Edited</th></tr>";

			// get all clients, newest ones first
			$stmt = $conn->prepare("SELECT $table_id, first_name, last_name, sex, DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(date_of_birth, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(date_of_birth, '00-%m-%d')), date_format(timestamp, '%b %d %Y %h:%i %p') FROM $table_name $query_date_of_birth_wild ORDER BY $table_id DESC LIMIT $wild_card_limit;");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			$_SESSION['counter'] = 0;
			foreach(new view_clients(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			   echo $v;
			   ++$_SESSION['counter'];
			}
			
		}
		
		// search by first or last name
		elseif ($search) {
			
			echo "<table style='border: none;'>";
			echo "<tr><th>Client ID</th><th>First Name</th><th>Last Name</th><th>Sex</th><th>Age</th><th>Time Edited</th></tr>";
			
			$stmt = $conn->prepare("SELECT $table_id, first_name, last_name, sex, DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(date_of_birth, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(date_of_birth, '00-%m-%d')), date_format(timestamp, '%b %d %Y %h:%i %p') FROM $table_name WHERE concat(first_name, ' ', last_name) LIKE '%$search%' $query_date_of_birth ORDER BY CASE WHEN concat(first_name, ' ', last_name) LIKE '$search' THEN 1 ELSE 2 END, client_id desc LIMIT $search_limit;");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			$_SESSION['counter'] = 0;
			foreach(new view_clients(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			   echo $v;
			   ++$_SESSION['counter'];
			}
	   
	    	}

	}
	else {

		// search by id
		if (ctype_digit($search)) {
		
			echo "<table style='border: none;'>";
			echo "<tr><th>Form ID</th><th>Created By</th><th>Time Edited</th></tr>";
			
			// get the client by id
			$stmt = $conn->prepare("SELECT $table_id, created_by, date_format(timestamp, '%b %d %Y %h:%i %p') FROM $table_name WHERE $table_id='$search' $query_date_of_birth;");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			$_SESSION['counter'] = 0;
			foreach(new view_clients_no_link(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			   echo $v;
			   ++$_SESSION['counter'];
			}
			
		}
		
		// wild card (everything)
		elseif ($search == '*') {
		
			echo "<table style='border: none;'>";
			echo "<tr><th>Form ID</th><th>Created By</th><th>Time Edited</th></tr>";

			// get all clients, newest ones first
			$stmt = $conn->prepare("SELECT $table_id, created_by, date_format(timestamp, '%b %d %Y %h:%i %p') FROM $table_name $query_date_of_birth_wild ORDER BY $table_id DESC LIMIT $wild_card_limit;");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			$_SESSION['counter'] = 0;
			foreach(new view_clients_no_link(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			   echo $v;
			   ++$_SESSION['counter'];
			}
			
		}

	}

    echo "</table>";
    echo "</div>";

}


catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;

echo "</div>";

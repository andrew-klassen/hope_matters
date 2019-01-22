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

<header>Find Secrets</header>
  
<!-- start of the search for clients card-->
<div style="height: 1000px;" class="login-card">
  

<?php
require('../crypto_settings.php');
session_start();

login_check();

$_SESSION['temp'] = 0;
$_SESSION['choosen_secret_id'] = 0;

// grab current search
$search = $_POST['search'];

class view_secrets extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }
	
    function current() {

		$_SESSION['choosen_secret_id'] = parent::current();
		
		// there are 2 colums 
		if (($_SESSION['counter'] == 0) or ($_SESSION['counter'] % 2 == 0)) {
		
			$_SESSION['temp'] = $_SESSION['choosen_secret_id'];
			
		}
		$temp = $_SESSION['temp'];
																					
		return "<td style='border-style: solid; border-color: #black; background-color: white; color: black;font-weight: 500;font-size: 12px;font-size: 30px;  '>" . "<a href='grab_choosen_secret_id.php? choosen_secret_id=$temp' style='color: black;'>"  . parent::current() . "</a>" . "</td>";
  
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
	$conn = new PDO($dbconnection_secret, $dbusername_secret, $dbpassword_secret);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
   
	echo "<p style='color: black;;text-align: center;'>Click on a secret to view or edit it.</p>";
	echo "<p style='color: black;;text-align: center;'>Search for a secret by ID or label. Use * to see all secrets.</p>";
	echo "<div style='width: 800px; padding-left: 440px;'>
		<form action='add_secret.php' method='post'>
				<input type='submit' value='New Secret'>
			</form></div>";
	echo "<div id='searchDiv'>
	<form action='select_secrets.php' method='post' id='searchForm'>
  		<div style='width: 800px; padding-left: 530px;'>
			<input type='text' id='request_search' name='search' value='$search' autofocus onfocus='this.value = this.value;'>
			
			<input type='submit' id='search_submit' value='Search'>
		</div>
	</form>
	</div>";
	
	
    	echo "<div id='tableCard'>";
	
	/******** determine if the user is searching by id, first name, or last name ********/
	
	// search by id
	if (ctype_digit($search)) {
	
		echo "<table style='border: none;'>";
		echo "<tr><th>Secret ID</th><th>Label</th></tr>";
		
		// get the client by id
		$stmt = $conn->prepare("SELECT secret_id, label FROM secrets WHERE secret_id = :search;");
		$stmt->execute(array('search' => $search));
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$_SESSION['counter'] = 0;
		foreach(new view_secrets(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		   echo $v;
		   ++$_SESSION['counter'];
		}
		
	}
	
	// wild card (everything)
	elseif ($search == '*') {
	
		echo "<table style='border: none;'>";
		echo "<tr><th>Secret ID</th><th>Label</th></tr>";

		// get all clients, newest ones first
		$stmt = $conn->prepare("SELECT secret_id, label FROM secrets ORDER BY secret_id DESC LIMIT :wild_card_limit;");
		$stmt->execute(array('wild_card_limit' => $wild_card_limit));
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$_SESSION['counter'] = 0;
		foreach(new view_secrets(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		   echo $v;
		   ++$_SESSION['counter'];
		}
		
	}
	
	// search by first or last name
	elseif ($search) {
		
		echo "<table style='border: none;'>";
		echo "<tr><th>Secret ID</th><th>Label</th></tr>";
		
		$stmt = $conn->prepare("SELECT secret_id, label FROM secrets WHERE label LIKE :search ORDER BY secret_id DESC LIMIT :search_limit;");
		$stmt->execute(array( 'search' => '%' . $search . '%', 'search_limit' => $search_limit ));
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$_SESSION['counter'] = 0;
		foreach(new view_secrets(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		   echo $v;
		   ++$_SESSION['counter'];
		}
   
    }

    	echo "</table>";
    echo "</div>";

}


catch(PDOException $e) {
    create_database_error($query, 'select_secrets.php', $e->getMessage());
}

$conn = null;

echo "</div>";

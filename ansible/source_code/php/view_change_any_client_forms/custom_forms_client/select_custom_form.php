
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

  
<header>Pick a Custom Form</header>


<!-- start of select client card --> 
<div  class="login-card">
  

<?php

require('../database_credentials.php');
session_start();

// make sure user is logged in
login_check();

$_SESSION['temp'] = 0;

// make database connection
$conn = new PDO($dbconnection_custom, $dbusername, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


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

class view_forms extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }
	
    // this function creates an invisible <a link> that passes the clients id to the next page
    function current() {
	
		$_SESSION['choosen_form'] = parent::current();
		
		// since there are 6 fields being displayed in the table, $_SESSION['counter'] == 0 or $_SESSION['counter'] % 6 == 0
		if (($_SESSION['counter'] == 0) or ($_SESSION['counter'] % 1 == 0)) {
		
			$_SESSION['temp'] = $_SESSION['choosen_form'];
			
		}
		$temp = $_SESSION['temp'];


		if ($_SESSION['client_linked'] == 'true') {
			return "<td style='border-style: solid; border-color: #black; background-color: white; color: black;font-weight: 500;font-size: 12px;font-size: 30px;  '>" . "<a href='grab_choosen_custom_form_client.php? choosen_form=$temp' style='color: black;'>"  . parent::current() . "</a>" . "</td>";

		}
		else {
			return "<td style='border-style: solid; border-color: #black; background-color: white; color: black;font-weight: 500;font-size: 12px;font-size: 30px;  '>" . "<a href='grab_choosen_custom_form.php? choosen_form=$temp' style='color: black;'>"  . parent::current() . "</a>" . "</td>";

		}	
  
    }
    function beginChildren() {
        echo "<tr>";
    }
    function endChildren() {
        echo "</tr>" . "\n";
    }

}

class get_meta_tables extends RecursiveIteratorIterator {
	function __construct($it) {
		parent::__construct($it, self::LEAVES_ONLY);
	}
	function current() {
		array_push($_SESSION['tables'], parent::current());
	}
		
}


try {
	
    echo "<p style='color: black;;text-align: center;'>Click on a form to select it.</p>";

    
    $_SESSION['tables'] = array();

    $stmt = $conn->prepare("SHOW tables IN custom_forms LIKE '%_meta';");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
    foreach(new get_meta_tables(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

    }

    $tables_max = count($_SESSION['tables']);
    $tables = $_SESSION['tables'];


    echo "<div id='tableCard' style='width: 400px; height: 500px;'>";
	
		echo "<table style='border: none;'>";
		echo "<tr><th>Form</th></tr>";


			for($i = 0; $i < $tables_max; ++$i) {
			$stmt = $conn->prepare("SELECT value FROM $tables[$i] WHERE attribute = 'client_linked';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
			}
			$_SESSION['client_linked'] = $_SESSION['temp'];
			
			$stmt = $conn->prepare("SELECT value FROM $tables[$i] WHERE attribute = 'form_name';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			$_SESSION['counter'] = 0;
			foreach(new view_forms(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			   echo $v;
			   ++$_SESSION['counter'];
			}
		}
	

	echo "</table>";

	$username = $_SESSION['username'];
	$stmt = $conn->prepare("SELECT EXISTS(SELECT 1 FROM mysql.user WHERE user = '$username')");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
	}
	$mysql_user_exists = $_SESSION['temp'];

    echo "</div>";


if ($mysql_user_exists) {

		echo "<div style='margin-left: 200px;'><div style='float:left;'>
			<form action='/php/custom_forms/insert_new_custom_form.php' name='add_secret' onsubmit='return validate_form()' method='post' enctype='multipart/form-data' >
				<div>Add form<br><input type='file' name='json_file' id='json_file'><br><label style='font-size: 12px;'>(.json file)</label></div>
				<input type='submit' name='submit_button' value='Upload json'>
			</form>
		     </div>

		     <div style='float:left;'>
			<form action='/php/custom_forms/select_custom_form_download.php' name='add_secret' onsubmit='return validate_form()' method='post'>
				<input type='submit' name='submit_button' value='Download json'>
		        </form>
		     </div>

		     <div style='float:left; margin-left: 180px;'>
			<form action='/php/custom_forms/select_delete_custom_form.php' name='add_secret' onsubmit='return validate_form()' method='post'>
				<input type='submit'  name='submit_button' value='Delete Form'>
		     	</form>
		     </div>
		    </div>";

	}

}

catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;

?>

</div>

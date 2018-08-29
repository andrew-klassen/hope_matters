<!--
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
-->

<!DOCTYPE html>
<html>

<head>
	<title>Hope Matters</title>
	<link rel="icon" href="/images/hope_matters_logo.png">
	<link rel="stylesheet" type="text/css" href="/css/navbar.css">
	<link rel="stylesheet" type="text/css" href="/css/add_client.css">
	<link rel="stylesheet" type="text/css" href="/css/view_client.css">
	<script src="/js/vital_signs_validation.js" type="text/javascript"> </script>
</head>

<body style="padding-top: 70px;">

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
	  
	  <div style="float: left;  width: 300px;">
        <form method="post" action="select_client_vital_signs.php">
            <input style="width: 300px;" type="submit" value="Client Selection">
        </form>
      </div>
	  
  </div>
  <br></br>
  
<!-- all cards on screen are in this div, this way everything is centered -->
<div style="width:970px; margin: 0 auto; ">
  
  <!-- begining of general info card -->
  <div class="accountCard" style="float: left; margin-right: 5px;height: 245px;" >
	<p class='p'style='color: black;font-weight:100; text-align: center;'>Client's General Info</p>
	
	
<?php
		
		require('../database_credentials.php');
		require('../date_functions.php');
		session_start();
		
		// make sure user is logged in
		login_check();
		
		$choosen_client_id = $_SESSION['choosen_client_id'];
		
		$username = $_SESSION['username'];
		
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
		
		// used to display list of clinicians in the database 
		class display_clinicians extends RecursiveIteratorIterator {
			function __construct($it) {
				parent::__construct($it, self::LEAVES_ONLY);
			}
			function current() {
					
				return "<option value='" . parent::current() . "'>";
			}
			function beginChildren() {
				echo "<tr>";
			}
			function endChildren() {
				echo "</tr>" . "\n";
			}
		}




		class view_clients extends RecursiveIteratorIterator {
		    
			function __construct($it) {
			parent::__construct($it, self::LEAVES_ONLY);
		    }
			
			// this function creates an invisible <a link> that passes the clients id to the next page
		    function current() {
			
				$_SESSION['choosen_client_id'] = parent::current();
				
				// since there are 6 fields being displayed in the table, $_SESSION['counter'] == 0 or $_SESSION['counter'] % 6 == 0
				if (($_SESSION['counter'] == 0) or ($_SESSION['counter'] % 7 == 0)) {
				
					$_SESSION['temp'] = $_SESSION['choosen_client_id'];
					
				}
				$temp = $_SESSION['temp'];
				
				return "<td style='border-style: solid; border-color: #black; background-color: white; color: black;font-weight: 500;font-size: 12px;font-size: 30px;  '>" . "<a href='' style='color: black;'>"  . parent::current() . "</a>" . "</td>";
		    
		    }
		    function beginChildren() {
			echo "<tr>";
		    }
		    function endChildren() {
			echo "</tr>" . "\n";
		    }
		}

		
		
		// create the database connection
		$conn = new PDO($dbconnection, $dbusername, $dbpassword);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		
		// grab the clients first name
		$stmt = $conn->prepare("SELECT first_name FROM general_info WHERE client_id='$choosen_client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$first_name = $_SESSION['temp'];
		
		
		// grab the clients last name
		$stmt = $conn->prepare("SELECT last_name FROM general_info WHERE client_id='$choosen_client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$last_name = $_SESSION['temp'];
		
		
		// grab the clients sex
		$stmt = $conn->prepare("SELECT sex FROM general_info WHERE client_id='$choosen_client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$sex = $_SESSION['temp'];
		
		
		// grab the clients location
		$stmt = $conn->prepare("SELECT location FROM general_info WHERE client_id='$choosen_client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$location = $_SESSION['temp'];
		
		
		// grab the clients date of birth
		$stmt = $conn->prepare("SELECT date_of_birth FROM general_info WHERE client_id='$choosen_client_id'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$date_of_birth = $_SESSION['temp'];
		
		
		// get the client's age
		$age = get_age_from_date_of_birth($date_of_birth);
		
		
		// display the general info
		echo "<div style='width: 500px; height: 100px;'>";
		echo "<div style=' float: left;'>";
		echo '<b>Client ID:</b>' . "<br>" . "<br>";
		echo '<b>First Name:</b>' . "<br>" . "<br>";
		echo '<b>Last Name:</b>' . "<br>" . "<br>";
		echo "</div>";
		
		echo "<div style=' float: left;padding-left: 20px;'>";
		echo $choosen_client_id . "<br>" . "<br>";
		echo $first_name . "<br>" . "<br>";
		echo $last_name;
		echo '</div>';
		echo '</div>';
		
		
		echo "<div style='float: left; width: 500px;height: 70px;'>";
		echo "<div style=' float: left;'>";
		echo '<b>Sex:</b>' . "<br>" . "<br>";
		echo '<b>Age:</b>' . "<br>" . "<br>";
		echo '<b>Residence:</b>' . "<br>" . "<br>";
		echo "</div>";
		
		echo "<div style=' float: left;padding-left: 22px;'>";
		echo $sex . "<br>" . "<br>";
		echo $age . "<br>" . "<br>";
		echo $location;
		echo '</div>';
		echo '</div>';
?>
		 
</div>
  
  <!-- start of vital signs card -->
  <div class="accountCard" style="float: left; height: 245px;">
	<p class='p'style='color: black;font-weight:100; text-align: center; padding-bottom: 50px;'>Vital Signs</p>
	
	<div style=' float: left;'>
		<?php
			echo 'T:' . "<br>" . "<br>";
			echo 'BP:' . "<br>" . "<br>";
			
		?>
	</div>
	
	<form  name="vital_signs_form" action="insert_vital_signs.php" onsubmit="return validate_form()" method="post">
	
	<div style=' float: left; padding-left: 15px;'>
			<input type="text" name="t" style="width: 100px; height: 30px;" maxlength="10" autofocus onfocus='this.value = this.value;'><br>
			<input type="text" name="bp" style="width: 100px; height: 30px;" maxlength="10"><br>
			
	</div>
	
	<div style=' float: left; padding-left: 15px;'>
		<?php
			echo 'HR:' . "<br>" . "<br>";
			echo 'SaO<sub>2</sub>:' . "<br>" . "<br>";
			echo 'Pain:'  ;
		?>
	</div>
	
	<div style=' float: left; padding-left: 15px;'>
			<input type="text" name="hr" style="width: 100px; height: 30px;" maxlength="10"><br>
			<input type="number" name="sao2" style="width: 100px; height: 30px;" min="0" max="9999999999"><br>
			
			<div style=' float: left;'>
				<input type="radio" name="pain" value="none" checked> none <br>
				<input type="radio" name="pain" value="mild"> mild 
			</div>
			
			<div style=' float: left;'>
				<input type="radio" name="pain" value="moderate"> moderate <br>
				<input type="radio" name="pain" value="severe"> severe
			</div>
			
	</div>
			Notes: </br> <textarea name="notes" style="width: 400px; height: 60px;"></textarea>
	
  </div>
  
  
   <!-- start of bottom card -->
    <div class="accountCard" style="float: left; width: 885px; height: 490px; position: relative;">
	
		
		


<?php


$from = $_SESSION['from'];
$to = $_SESSION['to'];




// search bar
echo "<div id='searchDiv' >
	
		From: <input type='date' value='$from' name='from' >
		To: <input type='date' value='$to' name='to'>
	
</div>";


/*******************************************************************
Code below allows the user to omit a date in the date range. If no 
date range is provided, then all records are acceptible.
*******************************************************************/	
if ($from == '') {
	$from = "'0000-00-00 00:00:00'";
}else {
	$from = "'" . $from . " 00:00:00'";
}
if ($to == '') {
	$to = "CONCAT(CURDATE(), ' 23:59:59')";
}
else {
	$to = "'" . $to . " 23:59:59'";
}


echo "<div id='tableCard' style='margin-top: 50px;'>";
echo "<table style='border: none;'>";
echo "<tr><th>T</th><th>BP</th><th>HR</th><th>SaO2</th><th>Pain</th><th>Notes</th><th>Time Edited</th></tr>";		
		
		$stmt = $conn->prepare("SELECT t, bp, hr, sao2, pain, notes, date_format(timestamp, '%b %d %Y %h:%i %p') FROM vital_signs WHERE client_id='$choosen_client_id' AND timestamp between $from and $to ORDER BY timestamp DESC");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$_SESSION['counter'] = 0;
		foreach(new view_clients(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		   echo $v;
		   ++$_SESSION['counter'];
		}
	echo "</table>";
    echo "</div>";
	
	$_SESSION['choosen_client_id'] = $choosen_client_id;

?>
		
		<div style="position: absolute; top: 500px; left: 420px;">		
			<input type="submit" name="submit_button" class="submitbtn" value="Submit Vital Signs">
		</div>
		
	</div>
	
	</form>
	
 </div>
  
</body>
</html>

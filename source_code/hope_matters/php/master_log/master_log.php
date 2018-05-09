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
	<link rel="stylesheet" type="text/css" href="/css/master_log.css">
	<link rel="stylesheet" type="text/css" href="/css/add_client_master_log.css">
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
	  
  </div>
  
  <br></br>
  
  <!-- this div keeps everything centered -->
  <div style="width:1070px; margin: 0 auto; ">
  
   <!-- start of the overall stats card -->
   <div class="accountCard" style="float: left; width: 1000px; height: 170px; margin-bottom: 5px; ">
		<p style='color: black;text-align: center;'>Overall Totals</p>
		
		<?php
			require('../database_credentials.php');
			
			// make sure user is logged in
			login_check();
			master_log_check();
			
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
			
			// start new database connection
			$conn = new PDO($dbconnection, $dbusername, $dbpassword);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			
			/******* start of first colum *******/
			$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE department='dental';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$dental_count = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE department='inquiry';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$inquiry_count = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE department='laboratory';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$laboratory_count = $_SESSION['temp'];
			
	
			$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE department='general';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$general = $_SESSION['temp'];
			
			
			
			echo '<div style=" float: left;">';
			echo '<b>Dental:</b>' . '<br>' . '<br>';
			echo '<b>Inquiry:</b>' . '<br>' . '<br>';
			echo '<b>Laboratory:</b>' . '<br>' . '<br>';
			echo '<b>General:</b>' . '<br>' . '<br>';
			echo '</div>';
			
			echo '<div style=" float: left;padding-left: 20px;">';
			echo $dental_count . '<br>' . '<br>';
			echo $inquiry_count . '<br>' . '<br>';
			echo $laboratory_count . '<br>' . '<br>';
			echo $general;
			echo '</div>';
			
			
			
			/******* start of second colum *******/
			$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE department='mch/anc';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$mch_anc_count = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE department='mch/cwc';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$mch_cwc_count = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE department='mch/delivery';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$mch_delivery_count = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log;");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$total = $_SESSION['temp'];
			
			
			
			echo '<div style=" float: left; padding-left: 20px;">';
			echo '<b>MCH/ANC:</b>' . '<br>' . '<br>';
			echo '<b>MCH/CWC:</b>' . '<br>' . '<br>';
			echo '<b>MCH/Delivery:</b>' . '<br>' . '<br>';
			echo '<b>Total:</b>' . '<br>' . '<br>';
			echo '</div>';
			
			echo '<div style=" float: left;padding-left: 20px;">';
			echo $mch_anc_count . '<br>' . '<br>';
			echo $mch_cwc_count . '<br>' . '<br>';
			echo $mch_delivery_count . '<br>' . '<br>';
			echo $total;
			echo '</div>';
			
			
			
			/******* start of third colum *******/
			$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE department='mch/fp';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$mch_fp = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE department='optometry';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$optometry = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE department='payment_rec';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$payment_rec = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE department='mch/awc' OR department='mch/cwc' OR department='mch/delivery' OR department='mch/fp';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$mch_total = $_SESSION['temp'];
			
			
			
			echo '<div style=" float: left; padding-left: 20px;">';
			echo '<b>MCH/FP:</b>' . '<br>' . '<br>';
			echo '<b>Optometry:</b>' . '<br>' . '<br>';
			echo '<b>Payment Rec\'d:</b>' . '<br>' . '<br>';
			echo '<b>MCH Total:</b>' . '<br>' . '<br>';
			echo '</div>';
			
			echo '<div style=" float: left;padding-left: 20px;">';
			echo $mch_fp . '<br>' . '<br>';
			echo $optometry . '<br>' . '<br>';
			echo $payment_rec . '<br>' . '<br>';
			echo $mch_total;
			echo '</div>';
			
			
			
			/******* start of fourth colum *******/
			$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE department='pharmacy';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$pharmacy = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE department='screening/dm';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$screening_dm = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE department='screening/gyn';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$screening_gyn = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE department='screening/dm' OR department='screening/other' OR department='screening/gyn' OR department='screening/htn';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$screening_total = $_SESSION['temp'];
			
			
			
			echo '<div style=" float: left; padding-left: 20px;">';
			echo '<b>Pharmacy:</b>' . '<br>' . '<br>';
			echo '<b>Screening/DM:</b>' . '<br>' . '<br>';
			echo '<b>Screening/GYN:</b>' . '<br>' . '<br>';
			echo '<b>Screening Total:</b>' . '<br>' . '<br>';
			echo '</div>';
			
			echo '<div style=" float: left;padding-left: 20px;">';
			echo $pharmacy . '<br>' . '<br>';
			echo $screening_dm . '<br>' . '<br>';
			echo $screening_gyn . '<br>' . '<br>';
			echo $screening_total;
			echo '</div>';
			
			
			
			/******* start of fifth colum *******/
			$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE department='screening/htn';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$screening_htn = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE department='screening/other';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$screening_other = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE department='tb_injection';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$tb_injection = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE revisit='yes';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$revisit = $_SESSION['temp'];
			
			
			
			echo '<div style=" float: left; padding-left: 20px;">';
			echo '<b>Screening/HTN:</b>' . '<br>' . '<br>';
			echo '<b>Screening/other:</b>' . '<br>' . '<br>';
			echo '<b>TB Injection:</b>' . '<br>' . '<br>';
			echo '<b>Revisit:</b>' . '<br>' . '<br>';
			echo '</div>';
			
			echo '<div style=" float: left;padding-left: 20px;">';
			echo $screening_htn . '<br>' . '<br>';
			echo $screening_other . '<br>' . '<br>';
			echo $tb_injection . '<br>' . '<br>';
			echo $revisit;
			echo '</div>';
			
			
			
			/******* start of sixth colum *******/
			$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE department='treatment';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$treatment = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE department='vct';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$vct = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT COUNT(*) FROM master_log WHERE department='ultrasound';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$ultrasound = $_SESSION['temp'];
			
			
			$stmt = $conn->prepare("SELECT SUM(owes) FROM master_log;");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$total_owes = $_SESSION['temp'];
			
			if ($total_owes < 1) {
				$total_owes = 0;
			}
			
			echo '<div style=" float: left; padding-left: 20px;">';
			echo '<b>Treatment:</b>' . '<br>' . '<br>';
			echo '<b>VCT:</b>' . '<br>' . '<br>';
			echo '<b>Ultrasound:</b>' . '<br>' . '<br>';
			echo '<b>Total Owes:</b>' . '<br>' . '<br>';
			echo '</div>';
			
			echo '<div style=" float: left;padding-left: 20px;">';
			echo $treatment . '<br>' . '<br>';
			echo $vct . '<br>' . '<br>';
			echo $ultrasound . '<br>' . '<br>';
			echo $total_owes;
			echo '</div>';
			
		?>
		
		
	</div>
  
  
	<!-- begining of search card -->
    <div class="accountCard" style="float: left; width: 1000px; height: 750px;">
		
		<?php
		
			session_start();
			
			$_SESSION['temp'] = 0;
			$_SESSION['choosen_payment_id'] = 0;

			$search = $_POST['search'];
			$transaction_type = $_POST['transaction_type'];
			
			class view_clients extends RecursiveIteratorIterator {
				function __construct($it) {
					parent::__construct($it, self::LEAVES_ONLY);
				}
				function current() {
					$_SESSION['choosen_payment_id'] = parent::current();
					
					if (($_SESSION['counter'] == 0) or ($_SESSION['counter'] % 10 == 0)) {
					
						$_SESSION['temp'] = $_SESSION['choosen_payment_id'];
						
					}
					$temp = $_SESSION['temp'];
					
																										
					return "<td style='border-style: solid; border-color: #black; background-color: white; color: black; '>" . "<a href='grab_choosen_payment_id.php? choosen_payment_id=$temp' style='color: black;' >"  . parent::current() . "</a>" . "</td>";
				}
				function beginChildren() {
					echo "<tr>";
				}
				function endChildren() {
					echo "</tr>" . "\n";
				}
			}


			try {
				
				echo "<p style='color: black; text-align: center; font-size: 18px; padding-bottom: 10px;'>Search for a financal transaction by payment ID or client name. Use * to see all transactions.</p>";
				
				// search bar and transaction drop down menu
				echo "<div id='searchDiv' style='margin-left: 370px; margin-bottom: 15px;'>
				<form action='/php/master_log/master_log.php' method='post' id='searchForm'>
					<input type='text' id='request_search' name='search' value='$search' autofocus onfocus='this.value = this.value;'>
					<input type='submit' id='search_submit' value='Search'>
				
					<select name='transaction_type' method='post'>
						<option value='all' selected='selected'>All Transactions</option>
						<option value='dental'>Dental</option>
						<option value='inquiry'>Inquiry</option>
						<option value='laboratory'>Laboratory</option>
						<option value='mch_anc'>MCH/ANC</option>
						<option value='mch_cwc'>MCH/CWC</option>
						<option value='mch_delivery'>MCH/Delivery</option>
						<option value='mch_fp'>MCH/FP</option>
						<option value='optometry'>Optometry</option>
						<option value='payment_rec'>Payment Rec</option>
						<option value='pharmacy'>Pharmacy</option>
						<option value='referral'>Referral</option>
						<option value='screening_dm'>Screening/DM</option>
						<option value='screening_gyn'>Screening/GYN</option>
						<option value='screening_other'>Screening/OTHER</option>
						<option value='tb_injection'>TB Injection</option>
						<option value='treatment'>Treatment</option>
						<option value='vct'>VCT</option>
						<option value='ultrasound'>Ultrasound</option>
						<option value='general'>General</option>
					</select>
				
				</form>
	
				</div>";
				
				
				echo "<div style='width: 1000px; height: 600px; overflow: auto;'>";
				
				// if transaction type is filtered
				if ($transaction_type != 'all'){
				
					// searching by id
					if (ctype_digit($search)) {
					
						echo "<table style='border: none; '>";
						echo "<tr><th>Payment ID</th><th>First Name</th><th>Last Name</th><th>Client ID</th><th>Dept.</th><th>Revisit</th><th>Billed</th><th>Paid</th><th>Owes</th><th>Time Edited</th></tr>";
						
						$stmt = $conn->prepare("SELECT payment_id, first_name, last_name, client_id, department, revisit, billed, paid, owes, date_format(timestamp, '%b %d %Y %h:%i %p') FROM master_log WHERE payment_id='$search' AND department='$transaction_type'");
						$stmt->execute();
						$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
						
						$_SESSION['counter'] = 0;
						foreach(new view_clients(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
						   echo $v;
						   ++$_SESSION['counter'];
						}
					
				   }
				   
				   // search by wild card
				   elseif($search == '*') {
						
						echo "<table style='border: none; '>";
						echo "<tr><th>Payment ID</th><th>First Name</th><th>Last Name</th><th>Client ID</th><th>Dept.</th><th>Revisit</th><th>Billed</th><th>Paid</th><th>Owes</th><th>Time Edited</th></tr>";
						
						$stmt = $conn->prepare("SELECT payment_id, first_name, last_name, client_id, department, revisit, billed, paid, owes, date_format(timestamp, '%b %d %Y %h:%i %p') FROM master_log WHERE department='$transaction_type'ORDER BY payment_id DESC LIMIT $wild_card_limit;");
						$stmt->execute();
						$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
						
						$_SESSION['counter'] = 0;
						foreach(new view_clients(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
						   echo $v;
						   ++$_SESSION['counter'];
						}
				
				   }
				   
				   // search by name
				   elseif ($search){
				   
						echo "<table style='border: none; '>";
						echo "<tr><th>Payment ID</th><th>First Name</th><th>Last Name</th><th>Client ID</th><th>Dept.</th><th>Revisit</th><th>Billed</th><th>Paid</th><th>Owes</th><th>Time Edited</th></tr>";
						
						$stmt = $conn->prepare("SELECT payment_id, first_name, last_name, client_id, department, revisit, billed, paid, owes, date_format(timestamp, '%b %d %Y %h:%i %p') FROM master_log WHERE CONCAT(first_name, ' ', last_name) LIKE '%$search%' AND department='$transaction_type' ORDER BY CASE WHEN concat(first_name, ' ', last_name) LIKE '$search' THEN 1 ELSE 2 END, payment_id desc LIMIT $search_limit;");
						$stmt->execute();
						$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
						
						$_SESSION['counter'] = 0;
						foreach(new view_clients(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
						   echo $v;
						   ++$_SESSION['counter'];
						}
 
				   }
			   }
			   
			   // search with no transaction type filter
			   else{
					
					// searching by id
					if (ctype_digit($search)) {
						
						echo "<table style='border: none; '>";
						echo "<tr><th>Payment ID</th><th>First Name</th><th>Last Name</th><th>Client ID</th><th>Dept.</th><th>Revisit</th><th>Billed</th><th>Paid</th><th>Owes</th><th>Time Edited</th></tr>";
						
						$stmt = $conn->prepare("SELECT payment_id, first_name, last_name, client_id, department, revisit, billed, paid, owes, date_format(timestamp, '%b %d %Y %h:%i %p') FROM master_log WHERE payment_id='$search' ;");
						$stmt->execute();
						$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
						
						$_SESSION['counter'] = 0;
						foreach(new view_clients(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
						   echo $v;
						   ++$_SESSION['counter'];
						}
					
				   }
				   
				   // searching by wild card
				   elseif($search == '*') {
						
						echo "<table style='border: none; '>";
						echo "<tr><th>Payment ID</th><th>First Name</th><th>Last Name</th><th>Client ID</th><th>Dept.</th><th>Revisit</th><th>Billed</th><th>Paid</th><th>Owes</th><th>Time Edited</th></tr>";
						
						$stmt = $conn->prepare("SELECT payment_id, first_name, last_name, client_id, department, revisit, billed, paid, owes, date_format(timestamp, '%b %d %Y %h:%i %p') FROM master_log ORDER BY payment_id DESC LIMIT $master_log_limit;");
						$stmt->execute();
						$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
						
						$_SESSION['counter'] = 0;
						foreach(new view_clients(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
						   echo $v;
						   ++$_SESSION['counter'];
						}
				
				   }
				   
				   // searching by name
				   elseif ($search){
				   
						echo "<table style='border: none; '>";
						echo "<tr><th>Payment ID</th><th>First Name</th><th>Last Name</th><th>Client ID</th><th>Dept.</th><th>Revisit</th><th>Billed</th><th>Paid</th><th>Owes</th><th>Time Edited</th></tr>";
						
						$stmt = $conn->prepare("SELECT payment_id, first_name, last_name, client_id, department, revisit, billed, paid, owes, date_format(timestamp, '%b %d %Y %h:%i %p') FROM master_log WHERE CONCAT(first_name, ' ', last_name) LIKE '%$search%' ORDER BY CASE WHEN concat(first_name, ' ', last_name) LIKE '$search' THEN 1 ELSE 2 END, payment_id desc LIMIT $master_log_limit;");
						$stmt->execute();
						$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
						
						$_SESSION['counter'] = 0;
						foreach(new view_clients(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
						   echo $v;
						   ++$_SESSION['counter'];
						}
				   
				   }
			   }
			  
				echo "</table>";
				echo "</div>";
				
				// client id button and textbox
				echo '<form action="pick_client.php" method="post" >
				
				<div  style="margin-left: 420px; margin-top: 5px; ">
					<input type="submit" id="search_submit" value="Pick Client" >
				</div>
				</form>';
				
			}
			catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}

			$conn = null;
			
		?>
		
	</div>
	
  
 </div>
  
</body>
</html>
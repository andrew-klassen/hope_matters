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
	<script src="/js/add_payment_validation.js" type="text/javascript"> </script>
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
        <form method="post" action="master_log.php">
            <input style="width: 300px;" type="submit" value="Back to Overview">
        </form>
      </div>
	  
  </div>
  <br></br>
  
  <!-- this div keeps everything centered -->
  <div style="width:1570px; margin: 0 auto; "> 
	
	<!-- start of search card -->
    <div  class="accountCard" style="float: left; width: 1000px; height: 750px;">
		
		<?php
		
			require('../database_credentials.php');
			session_start();
			
			// make sure user is logged in
			login_check();
			master_log_check();

			$_SESSION['temp'] = 0;
			$_SESSION['choosen_payment_id'] = 0;

			$transaction_type = $_POST['transaction_type'];
			
			if ($transaction_type == ''){
				$transaction_type = 'all';
			}
			$client_id = $_SESSION['choosen_client_id'];
			
			// used for the searches
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
						
					return "<td style='border-style: solid; border-color: #black; background-color: white; color: black; '>" . "<a href='grab_choosen_payment_id_client.php? choosen_payment_id=$temp' style='color: black;' >"  . parent::current() . "</a>" . "</td>";
				
				}
				function beginChildren() {
					echo "<tr>";
				}
				function endChildren() {
					echo "</tr>" . "\n";
				}
			}
			
			// used for geting a secific value
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
				
				// make database connection
				$conn = new PDO($dbconnection, $dbusername, $dbpassword);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				
				$stmt = $conn->prepare("SELECT first_name FROM general_info WHERE client_id='$client_id';");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$first_name = $_SESSION['temp'];
				
				
				$stmt = $conn->prepare("SELECT last_name FROM general_info WHERE client_id='$client_id';");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
				}
				$last_name = $_SESSION['temp'];
				
				
				$stmt = $conn->prepare("SELECT SUM(owes) FROM master_log WHERE client_id='$client_id';");
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
					
				foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
						
				}
				$client_owes = $_SESSION['temp'];
				
				if ($client_owes == '') {
					$client_owes = 0;
				}
				
				echo '<div style=" float: left; width: 800px; margin-left: 420px; margin-bottom: 20px;">';
				echo '<b>Client ID:</b>' . '&nbsp' . $client_id . '&nbsp;&nbsp;&nbsp';
				echo '<b>Client Name:</b>'. '&nbsp' . $first_name . '&nbsp' . $last_name;
				echo '</div>';
				
				// search bar and transaction type drop down menu
				echo "<div id='searchDiv' style='margin-left: 370px; margin-bottom: 15px;'>
				<form action='master_log_client.php' method='post' id='searchForm'>
					
					<input style='margin-left: 55px; margin-bottom: 5px;' type='submit' id='search_submit' value='Enter'>
					
					<select name='transaction_type' method='post'>
						<option value='all' selected='selected'>All Transactions</option>
						<option value='general'>General</option>
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
					</select>
					
				</form>
				
				</div>";
				
				
				echo "<div style='width: 1000px; height: 600px; overflow: auto;'>";
				
				
				// if transaction type is filtered
				if ($transaction_type != 'all'){
	   
						echo "<table style='border: none; '>";
						echo "<tr><th>Payment ID</th><th>First Name</th><th>Last Name</th><th>Client ID</th><th>Dept.</th><th>Revisit</th><th>Billed</th><th>Paid</th><th>Owes</th><th>Time Edited</th></tr>";
						
						$stmt = $conn->prepare("SELECT payment_id, first_name, last_name, client_id, department, revisit, billed, paid, owes, date_format(timestamp, '%b %d %Y %h:%i %p') FROM master_log WHERE department='$transaction_type' AND client_id='$client_id' ORDER BY payment_id DESC LIMIT $master_log_limit;");
						$stmt->execute();
						$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
						
						$_SESSION['counter'] = 0;
						foreach(new view_clients(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
						   echo $v;
						   ++$_SESSION['counter'];
						}
			   }
			   
			   // if transaction type is not filtered
			   else{
			   
						echo "<table style='border: none; '>";
						echo "<tr><th>Payment ID</th><th>First Name</th><th>Last Name</th><th>Client ID</th><th>Dept.</th><th>Revisit</th><th>Billed</th><th>Paid</th><th>Owes</th><th>Time Edited</th></tr>";
						
						$stmt = $conn->prepare("SELECT payment_id, first_name, last_name, client_id, department, revisit, billed, paid, owes, date_format(timestamp, '%b %d %Y %h:%i %p') FROM master_log WHERE client_id='$client_id' ORDER BY payment_id DESC LIMIT $master_log_limit;");
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
				
				// client id button and textbox
				echo '<form action="pick_client_new_client.php" method="post" >
					
					<div  style="margin-left: 420px; margin-top: 5px; ">
						<input type="submit" id="search_submit" value="New Client" >
					</div>
					
					</form>';
					
					echo "<div style='margin-left: 700px;'><b >Client's total owes: </b>" . $client_owes . '</div>';
				
			}
			
			catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}

			$conn = null;
		
		?>
		
	</div>
	
	<!-- this is the start of the add payment card -->
	 <div class="accountCard" style="float: left; height: 750px; margin-left: 5px;">
				<p class='p'style=' color: black; font-weight:100; text-align: center;'>Add a Payment</p>
				<form  name='add_payment_form' action='insert_payment.php' onsubmit='return validate_form()' method='post'>
						
						<?php
						
							// labels
							echo '<div style=" float: left; padding-left: 20px;">';
							echo '<b>Client Name:</b>' . '<br>' . '<br>';
							echo '<b>Department:</b>' . '<br>' . '<br>';
							echo '<b>Method:</b>' . '<br>' . '<br>';
							echo '<b>Revisit:</b>' . '<br>' . '<br>';
							echo '</div>';
							
							// echo client name
							echo '<div style=" float: left; padding-left: 20px; width: 260px;">';
							echo $first_name . ' ' . $last_name . '<br>' . '<br>';
							
							
							// make transaction type drop down menu
							echo "
								<select name='transaction_type_add' method='post'>
									<option value='general'>General</option>
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
								</select>
							" . '<br>' . '<br>';
							
							echo "
								<select name='payment_method' method='post'>
									<option value='unknown'>unknown</option>
									<option value='cash'>cash</option>
									<option value='m-pesa'>M-Pesa</option>
									
								</select>
							" . '<br>' . '<br>';
							
							echo "
								 <input type='radio' name='revisit' value='yes' > yes
								 <input type='radio' name='revisit' value='no' checked> no
								 " . '<br>' . '<br>';
							
							echo '</div>';
							
							echo '<div style=" float: left; width: 400px;">';
							
								echo '<div style=" float: left; padding-left: 20px;">';
								echo '<b>Billed:</b>' . '<br>' . '<br>';
							echo '</div>';
								
							echo '<div style=" float: left; padding-left: 20px;">';
								echo "<input type='number'  name='billed' value='$billed' min='0' max='9999999999' style='width: 75px; height: 20px;'>";
								echo '</div>';
							echo '</div>';
							
							
							echo '<div style=" float: left; width: 400px;">';
								echo '<div style=" float: left; padding-left: 20px;">';
								echo '<b>Paid:</b>' . '<br>' . '<br>';
							echo '</div>';
								
							echo '<div style=" float: left; padding-left: 30px;">';
								echo "<input type='number'  name='paid' value='$paid' min='0' max='9999999999' style='width: 75px; height: 20px;'>";
							echo '</div>';
							
							
							echo '</div>';
							
							
							echo '<div style=" float: left; margin-left: 20px;">';
								echo "<b>Notes:</b> <br> <textarea style='height: 60px; width: 350px;' name='notes' class='comment_area' maxlength='150'>$notes</textarea><br><br>";
							echo '</div>';
							
						?>
						
						<br><br>
						
						<input type='submit' name='submit_button' class='submitbtn' value='Submit'>
					</form>
					<br><br>
			  </div>
	
 </div> 
  
</body>
</html>
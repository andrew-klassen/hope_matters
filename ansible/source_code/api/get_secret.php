<?php

require('../php/crypto_settings.php');
session_start();


// make database connection
$conn = new PDO($dbconnection_secret, $dbusername_secret_api, $dbpassword_secret_api);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

$secret_id = $_POST['id'];
$token = $_POST['token'];
$authenticated = false;

// get all api token hashes
$stmt = $conn->prepare("SELECT token_hash FROM secret_api_tokens WHERE active = 'yes';");
$stmt->execute();
$token_hashes = $stmt->fetchAll(PDO::FETCH_ASSOC);


$token_hashes_max = count($token_hashes);

for($i = 0; $i < $token_hashes_max; ++$i) {

	$hash = $token_hashes[$i]['token_hash'];

	// if valid token exists
	if (password_verify($token, $hash)) {

		$authenticated = true;
		break;

	}

}


// end script if token is invalid
if (! $authenticated) {
	echo "access_denied";
	exit();
}


// get all secret hashes
$stmt = $conn->prepare("SELECT secret_value_id, key_hash FROM secret_values WHERE secret_id = :secret_id;");
$stmt->execute(array('secret_id' => $secret_id));
$secret_keys_ids = $stmt->fetchAll(PDO::FETCH_ASSOC);


$secret_keys_id_max = count($secret_keys_ids);

for($i = 0; $i < $secret_keys_id_max; ++$i) {

	$hash = $secret_keys_ids[$i]['key_hash'];

	// if valid key exists
	if (password_verify($token, $hash)) {

		$stmt = $conn->prepare("SELECT AES_DECRYPT(encrypted_value, :token, initialization_vector) as `value`, privilege FROM secret_values WHERE secret_value_id = :secret_value_id;");
		$stmt->execute(array('token' => $token, 'secret_value_id' => $secret_keys_ids[$i]['secret_value_id']));
		$secret_value_record = $stmt->fetch(PDO::FETCH_ASSOC);

		$value = $secret_value_record['value'];
		break;

	}

}


if (isset($value)) {
	echo $value;
}
else {
	echo "access_denied";
}

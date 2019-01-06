<?php

require('../../database_credentials.php');		

session_start();

// error location is different depending on error number
switch ($_SESSION['error_number']) {
	case 0:
		create_database_error($_SESSION['query'], 'add_return_treatment_form_diagnoses.php (INSERT) view_all', $_SESSION['pdo_error']);
		break;
	case 1:
		create_database_error($_SESSION['query'], 'change_return_treatment_form_diagnoses.php (INSERT) view_all', $_SESSION['pdo_error']);
		break;
	case 2:
		create_database_error($_SESSION['query'], 'add_return_treatment_form_diagnoses.php (DELETE) view_all', $_SESSION['pdo_error']);
		break;
	case 3:
		create_database_error($_SESSION['query'], 'change_return_treatment_form_diagnoses.php (DELETE) view_all', $_SESSION['pdo_error']);
		break;
}
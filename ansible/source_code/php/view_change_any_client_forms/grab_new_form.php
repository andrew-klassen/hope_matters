<!--
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
-->

<?php

require('../database_credentials.php');
session_start(); 

switch ($_POST['form_type']) {
	case 'dental':
		header('Location: /php/view_change_any_client_forms/dental_forms_client/add_dental_form.php');
		exit();
		break;
	case 'discharge':
		header('Location: /php/view_change_any_client_forms/discharge_forms_client/add_discharge_form.php');
		exit();
		break;
	case 'lab':
		header('Location: /php/view_change_any_client_forms/labs_client/add_lab.php');
		exit();
		break;
	case 'optometry':
		header('Location: /php/view_change_any_client_forms/optometry_form_client/add_optometry.php');
		exit();
		break;
	case 'referral':
		header('Location: /php/view_change_any_client_forms/referral_form_client/add_referral_form.php');
		exit();
		break;
	case 'return_treatment':
		header('Location: /php/view_change_any_client_forms/return_treatment_form_client/add_return_treatment_form.php');
		exit();
		break;
	case 'treatment':
		header('Location: /php/view_change_any_client_forms/treatment_form_client/add_treatment_form.php');
		exit();
		break;
	case 'ultrasound':
		header('Location: /php/view_change_any_client_forms/ultrasounds_client/add_ultrasound.php');
		exit();
		break;
	case 'lab_order':
		header('Location: /php/view_change_any_client_forms/lab_orders_client/add_lab_order.php');
		exit();
		break;
	case 'women_health':
		header('Location: /php/view_change_any_client_forms/women_health_client/add_women_health.php');
		exit();
		break;
	case 'child_welfare':
		header('Location: /php/view_change_any_client_forms/child_welfare_care_client/add_child_welfare_care.php');
		exit();
		break;
	case 'medication_order':
		header('Location: /php/view_change_any_client_forms/medication_order_client/add_medication_order.php');
		exit();
		break;
	default:
		$_SESSION['choosen_form'] = html_format($_POST['form_type']);
		$_SESSION['database_table_name'] = $_POST['form_type'];
		header('Location: /php/view_change_any_client_forms/custom_forms_client/add_custom_form.php');
		exit();
		break;
}

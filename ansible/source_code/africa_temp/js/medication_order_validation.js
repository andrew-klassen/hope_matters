/*
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
*/

function validate_form() {
	
	// get all the string values from the medication_order_form
	var medication = document.forms["medication_order_form"]["medication"].value;
	var dosage = document.forms["medication_order_form"]["dosage"].value;
	var frequency = document.forms["medication_order_form"]["frequency"].value;
	

	if (medication == ""){

		alert("Please give the medication a name.");
		return false;

	}

	if (dosage == ""){

		alert("Please provide the dosage.");
		return false;

	}

	if (frequency == ""){

		alert("Please provide the dosage frequency.");
		return false;

	}

}

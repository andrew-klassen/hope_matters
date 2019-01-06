/*
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
 */

// Prevents clinician from sumitting empty forms.
function validate_form(){
	var screening_site = document.forms["optometry_form"]["screening_site"].value;
	
	// screening site is required
	if (screening_site == '') {
			alert("You need to specify which site the screening took place.");
			return false;
	
	}
}
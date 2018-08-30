/*
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
 */

 /* 
This file is no longer in use, due to the user's decision. However, it is left in the project 
because it is still functional and could be potentially useful.

 
// in the dental form, all the vital signs and the dental provider need to be filled out
function validate_form() {

	var t = document.forms["dental_form"]["t"].value;
	var bp = document.forms["dental_form"]["bp"].value;
	var pr = document.forms["dental_form"]["pr"].value;
	var rr = document.forms["dental_form"]["rr"].value;
	var wt = document.forms["dental_form"]["wt"].value;
	var dental_provider = document.forms["dental_form"]["dental_provider"].value;
	
	// make sure vital signs are filled out
	if (bp == "" || t == 0 || pr == 0 || rr == 0 || wt == 0){

		alert("All vital signs need to be filled out.");
		return false;

	}


	// make sure user provided a dental provider
	if (dental_provider == ""){

		alert("Dental forms need a dental provider.");
		return false;

	}

}
*/
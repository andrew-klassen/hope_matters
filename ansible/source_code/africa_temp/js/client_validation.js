/*
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
*/

function validate_form() {
	
	// get all the string values from client_form
	var first_name = document.forms["client_form"]["first_name"].value;
	var last_name = document.forms["client_form"]["last_name"].value;
	var gender = document.forms["client_form"]["gender"].value;
	var alcohol_use = document.forms["client_form"]["alcohol_use"].value;
	var phone_number = document.forms["client_form"]["phone_number"].value;
	var date_of_birth = document.forms["client_form"]["date_of_birth"].value;

	// check to see if the user provided a first name
	if (first_name == ""){

		alert("Please give the client a first name.");
		return false;

	}
	// check to see if the user provided a last name
	if (last_name == ""){

		alert("Please give the client a last name.");
		return false;

	}
	// check to see if the user provided a date of birth
	if (date_of_birth == "" ){

		alert("Please give the client a date of birth.");
		return false;

	}
	// check to see if the user provided a alcohol use
	if (alcohol_use == "" ){

		alert("Please determine the client's alcohol usage.");
		return false;

	}
	// check to see if the user provided a gender
	if (gender == "" ){

		alert("Please give the client a gender.");
		return false;

	}
	
	
	/*********** date of birth validation ***********/
	
	var date_of_birth = document.forms["client_form"]["date_of_birth"].value;
	
    // make sure date is in the correct format
    var regex_date = /^\d{4}\-\d{1,2}\-\d{1,2}$/;

    if (!regex_date.test(date_of_birth))
    {	
		alert("Please enter the date of birth in the following format. \n\n yyyy-mm-dd");
        return false;
    }

    // break up each part of the date
    var parts   = date_of_birth.split("-");
    var day     = parseInt(parts[2], 10);
    var month   = parseInt(parts[1], 10);
    var year    = parseInt(parts[0], 10);

    // make sure user provides a valid year
    if (year < 1800 || year > 2500) 
    {
		alert("The year given for the date of birth is invalid.");
        return false;
    }
	
	// make sure user provides a valid month
	if (month == 0 || month > 12) {
		alert("The month given for the date of birth is invalid.");
        return false;
	}
	

    var monthLength = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];

    // adjust for leap years
    if (year % 400 == 0 || (year % 100 != 0 && year % 4 == 0))
    {
        monthLength[1] = 29;
    }

    // make sure user provides a valid day
    if (!(day > 0 && day <= monthLength[month - 1])){
		alert("The day given for the date of birth is invalid.");
        return false;
	}
}

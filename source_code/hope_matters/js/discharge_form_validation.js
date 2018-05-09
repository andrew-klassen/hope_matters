/*
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
 */

function validate_form() {

/*

This part of the file is no longer in use, due to the user's decision. However, it is left in the project 
because it is still functional and could be potentially useful.

	var t = document.forms["discharge_form"]["t"].value;
	var bp = document.forms["discharge_form"]["bp"].value;
	var pr = document.forms["discharge_form"]["pr"].value;
	var sao2 = document.forms["discharge_form"]["sao2"].value;
	

	// make sure vital signs are filled out
	if (t == 0 || bp == "" || pr == 0 || sao2 == 0){

		alert("All vital signs need to be filled out.");
		return false;

	}
	
*/
	
	
	/*********** doa validation ***********/
	
	var doa = document.forms["discharge_form"]["doa"].value;
	
    // make sure date is in the correct format
    var regex_date = /^\d{4}\-\d{1,2}\-\d{1,2}$/;

    if (!regex_date.test(doa))
    {	
		alert("Please enter the D.O.A in the following format. \n\n yyyy-mm-dd");
        return false;
    }

    // break up each part of the date
    var parts   = doa.split("-");
    var day     = parseInt(parts[2], 10);
    var month   = parseInt(parts[1], 10);
    var year    = parseInt(parts[0], 10);

    // make sure user provides a valid year
    if (year < 1800 || year > 2500) 
    {
		alert("The year given for the D.O.A is invalid.");
        return false;
    }
	
	// make sure user provides a valid month
	if (month == 0 || month > 12) {
		alert("The month given for the D.O.A is invalid.");
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
		alert("The day given for the D.O.A is invalid.");
        return false;
	}
	
	
	
	/*********** dod validation ***********/
	
	var dod = document.forms["discharge_form"]["dod"].value;
	
    // make sure date is in the correct format
    var regex_date = /^\d{4}\-\d{1,2}\-\d{1,2}$/;

    if (!regex_date.test(dod))
    {	
		alert("Please enter the D.O.D in the following format. \n\n yyyy-mm-dd");
        return false;
    }

    // break up each part of the date
    var parts   = dod.split("-");
    var day     = parseInt(parts[2], 10);
    var month   = parseInt(parts[1], 10);
    var year    = parseInt(parts[0], 10);

    // make sure user provides a valid year
    if (year < 1800 || year > 2500) 
    {
		alert("The year given for the D.O.A is invalid.");
        return false;
    }
	
	// make sure user provides a valid month
	if (month == 0 || month > 12) {
		alert("The month given for the D.O.D is invalid.");
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
		alert("The day given for the D.O.D is invalid.");
        return false;
	}

}
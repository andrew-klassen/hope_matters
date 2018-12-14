/*
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
 */

// If a clinican says that they ran a test, then they need to provide the results for it.
function validate_form(){
	var bs_for_mps = document.forms["lab_form"]["bs_for_mps"].checked;
	var pbf = document.forms["lab_form"]["pbf"].checked;
	var widal = document.forms["lab_form"]["widal"].checked;
	var brucella = document.forms["lab_form"]["brucella"].checked;
	var vdrl_rpr = document.forms["lab_form"]["vdrl_rpr"].checked;
	var p24_hiv = document.forms["lab_form"]["p24_hiv"].checked;
	var blood_sugar = document.forms["lab_form"]["blood_sugar"].checked;
	var hba1c = document.forms["lab_form"]["hba1c"].checked;
	var bun = document.forms["lab_form"]["bun"].checked;
	var hematocrit = document.forms["lab_form"]["hematocrit"].checked;
	var creatinine = document.forms["lab_form"]["creatinine"].checked;
	var electrolytes = document.forms["lab_form"]["electrolytes"].checked;
	var pylori_stool = document.forms["lab_form"]["pylori_stool"].checked;
	var pylori_blood = document.forms["lab_form"]["pylori_blood"].checked;
	var rheumatoid = document.forms["lab_form"]["rheumatoid"].checked;
	var pregnancy = document.forms["lab_form"]["pregnancy"].checked;
	var stool = document.forms["lab_form"]["stool"].checked;
	var blood_group = document.forms["lab_form"]["blood_group"].checked;
	var hb = document.forms["lab_form"]["hb"].checked;
	var urinalysis = document.forms["lab_form"]["urinalysis"].checked;
	var hvs = document.forms["lab_form"]["hvs"].checked;
	
	// prevents the user from submitting a blank lab form
	if (!(bs_for_mps || pbf || widal || brucella || vdrl_rpr || p24_hiv || blood_sugar || hba1c || bun || hematocrit || creatinine || electrolytes || pylori_stool || pylori_blood || rheumatoid || pregnancy || stool || blood_group || hb || urinalysis || hvs)) {
			alert("If you want to submit a lab form, you need to do at least one test.");
			return false;
	
	}
	
	
	if (bs_for_mps ) {
		var no_mps = document.getElementById('no_mps');
		var mps1 = document.getElementById('mps1');
		var mps2 = document.getElementById('mps2');
		var mps3 = document.getElementById('mps3');

		if (!(no_mps.checked || mps1.checked || mps2.checked || mps3.checked)) {
			alert("If you ran a B/S for MPS test, then you need to provided the results for it.");
			return false;
			
		}
		

	}


	if (pbf ) {
		
		var pbf_text = document.forms["lab_form"]["pbf_text"].value;

		if (pbf_text == "") {
			alert("If you ran a PBF test, then you need to provided the results for it.");
			return false;
			
		}
		

	}


	if (widal ) {
		var th1 = document.getElementById('th1').value;
		var th2 = document.getElementById('th2').value;

		if (th1 == "" || th2 == "") {
			alert("If you ran a widal test, then you need to provided all the results for it.");
			return false;
			
		}
		

	}


	if (brucella ) {
		var bm1 = document.getElementById('bm1').value;
		var ba1 = document.getElementById('ba1').value;

		if (bm1 == "" || ba1 == "") {
			alert("If you ran a brucella test, then you need to provided all the results for it.");
			return false;
			
		}
		

	}

	
	if (vdrl_rpr ) {
		var reactive = document.getElementById('reactive').checked;
		var non_reactive = document.getElementById('non_reactive').checked;
		

		if (!(reactive || non_reactive)) {
			alert("If you ran a VDRL/RPR test, then you need to provided the results for it.");
			return false;
			
		}
		

	}
	
	
	if (p24_hiv) {
		var reactive_p24_hiv = document.getElementById('reactive_p24_hiv').checked;
		var non_reactive_p24_hiv = document.getElementById('non_reactive_p24_hiv').checked;
		

		if (!(reactive_p24_hiv || non_reactive_p24_hiv)) {
			alert("If you ran a P24/HIV test, then you need to provided the results for it.");
			return false;
			
		}
		

	}
	
	
	if (blood_sugar) {
		
		var blood_sugar_text = document.forms["lab_form"]["blood_sugar_text"].value;

		if (blood_sugar_text == "") {
			alert("If you ran a blood sugar test, then you need to provided the results for it.");
			return false;
			
		}
		

	}


	if (hba1c) {
		
		var hba1c_text = document.forms["lab_form"]["hba1c_text"].value;

		if (hba1c_text == "") {
			alert("If you ran a hba1c test, then you need to provided the results for it.");
			return false;
			
		}
		

	}


	if (bun) {
		
		var bun_text = document.forms["lab_form"]["bun_text"].value;

		if (bun_text == "") {
			alert("If you ran a bun test, then you need to provided the results for it.");
			return false;
			
		}
		

	}

	if (hematocrit) {
		
		var hematocrit_text = document.forms["lab_form"]["hematocrit_text"].value;

		if (hematocrit_text == "") {
			alert("If you ran a hematocrit test, then you need to provided the results for it.");
			return false;
			
		}
		

	}

	if (creatinine) {
		
		var creatinine_text = document.forms["lab_form"]["creatinine_text"].value;

		if (creatinine_text == "") {
			alert("If you ran a creatinine test, then you need to provided the results for it.");
			return false;
			
		}
		

	}

	if (electrolytes) {
		
		var electrolytes_text = document.forms["lab_form"]["electrolytes_text"].value;

		if (electrolytes_text == "") {
			alert("If you ran a electrolytes test, then you need to provided the results for it.");
			return false;
			
		}
		

	}

	if (pylori_stool) {
		var positive = document.getElementById('positive_pylori_stool').checked;
		var negative = document.getElementById('negative_pylori_stool').checked;
		

		if (!(positive || negative)) {
			alert("If you ran a pylori stool test, then you need to provided the results for it.");
			return false;
			
		}
		

	}



	if (pylori_blood) {
		var positive = document.getElementById('positive_pylori_blood').checked;
		var negative = document.getElementById('negative_pylori_blood').checked;
		

		if (!(positive || negative)) {
			alert("If you ran a pylori blood test, then you need to provided the results for it.");
			return false;
			
		}
		

	}


	if (rheumatoid) {
		var positive = document.getElementById('reactive_rheumatoid').checked;
		var negative = document.getElementById('non_reactive_rheumatoid').checked;
		

		if (!(positive || negative)) {
			alert("If you ran a rheumatoid test, then you need to provided the results for it.");
			return false;
			
		}
		

	}


	
	
	if (stool) {
		var app = document.getElementById('app').value;
		var mic = document.getElementById('mic').value;

		if (app == "" || mic == "") {
			alert("If you ran a Stool O/C test, then you need to provided all the results for it.");
			return false;
			
		}
		

	}
	
	
	if (blood_group) {
		var rhve_plus = document.getElementById('rhve_plus').checked;
		var rhve_neg = document.getElementById('rhve_neg').checked;
		var a = document.getElementById('a').checked;
		var b = document.getElementById('b').checked;
		var o = document.getElementById('o').checked;
		var ab = document.getElementById('ab').checked;
		var du_test = document.getElementById('du_test').value;

		if (!((rhve_neg || rhve_plus) && (a || b || o || ab) && du_test)) {
			alert("If you ran a blood group test, then you need to provided all the results for it.");
			return false;
			
		}
		

	}
	
	
	if (pregnancy) {
		var hcg_detected = document.getElementById('hcg_detected').checked;
		var no_hcg_detected = document.getElementById('no_hcg_detected').checked;

		if (!(hcg_detected || no_hcg_detected)) {
			alert("If you ran a pregnancy test, then you need to provided all the results for it.");
			return false;
			
		}
		

	}
	
	
	if (hb) {
		var hb_text = document.getElementById('hb_text').value;

		if (!(hb_text)) {
			alert("If you ran a Hb test, then you need to provided all the results for it.");
			return false;
			
		}
		

	}
	
	
	if (urinalysis) {
		var urobilinogen_neg = document.getElementById('urobilinogen_neg').checked;
		var urobilinogen_plus_neg = document.getElementById('urobilinogen_plus_neg').checked;
		var urobilinogen_plus = document.getElementById('urobilinogen_plus').checked;
		var urobilinogen_plus2 = document.getElementById('urobilinogen_plus2').checked;
		var urobilinogen_plus3 = document.getElementById('urobilinogen_plus3').checked;

		if (!(  urobilinogen_neg || urobilinogen_plus_neg || urobilinogen_plus ||  urobilinogen_plus2  || urobilinogen_plus3  )) {
			alert("If you ran a urinalysis test, then you need to provided all the results for it.");
			return false;
			
		}
		
		var glucose_neg = document.getElementById('glucose_neg').checked;
		var glucose_plus_neg = document.getElementById('glucose_plus_neg').checked;
		var glucose_plus = document.getElementById('glucose_plus').checked;
		var glucose_plus2 = document.getElementById('glucose_plus2').checked;
		var glucose_plus3 = document.getElementById('glucose_plus3').checked;
		if (!(  glucose_neg || glucose_plus_neg || glucose_plus ||  glucose_plus2  || glucose_plus3  )) {
			alert("If you ran a urinalysis test, then you need to provided all the results for it.");
			return false;
			
		}
		
		var bilirubin_neg = document.getElementById('bilirubin_neg').checked;
		var bilirubin_plus_neg = document.getElementById('bilirubin_plus_neg').checked;
		var bilirubin_plus2 = document.getElementById('bilirubin_plus2').checked;
		var bilirubin_plus3 = document.getElementById('bilirubin_plus3').checked;
		if (!(  bilirubin_neg || bilirubin_plus_neg ||  bilirubin_plus2  || bilirubin_plus3  )) {
			alert("If you ran a urinalysis test, then you need to provided all the results for it.");
			return false;
			
		}
		
		var ketones_neg = document.getElementById('ketones_neg').checked;
		var ketones_plus_neg = document.getElementById('ketones_plus_neg').checked;
		var ketones_plus = document.getElementById('ketones_plus').checked;
		var ketones_plus2 = document.getElementById('ketones_plus2').checked;
		var ketones_plus3 = document.getElementById('ketones_plus3').checked;
		if (!(  ketones_neg || ketones_plus_neg || ketones_plus ||  ketones_plus2  || ketones_plus3  )) {
			alert("If you ran a urinalysis test, then you need to provided all the results for it.");
			return false;
			
		}
		
		var specific_gravity_1000 = document.getElementById('specific_gravity_1.000').checked;
		var specific_gravity_1005 = document.getElementById('specific_gravity_1.005').checked;
		var specific_gravity_1010 = document.getElementById('specific_gravity_1.010').checked;
		var specific_gravity_1015 = document.getElementById('specific_gravity_1.015').checked;
		var specific_gravity_1020 = document.getElementById('specific_gravity_1.020').checked;
		var specific_gravity_1025 = document.getElementById('specific_gravity_1.025').checked;
		var specific_gravity_1030 = document.getElementById('specific_gravity_1.030').checked;
		if (!(  specific_gravity_1000 || specific_gravity_1005 || specific_gravity_1010 ||  specific_gravity_1015  || specific_gravity_1020  || specific_gravity_1025 || specific_gravity_1030)) {
			alert("If you ran a urinalysis test, then you need to provided all the results for it.");
			return false;
			
		}
		
		var blood_neg = document.getElementById('blood_neg').checked;
		var blood_plus = document.getElementById('blood_+').checked;
		var blood_plus2 = document.getElementById('blood_++').checked;
		var blood_plus3 = document.getElementById('blood_+++').checked;
		var blood_non_hemolysis = document.getElementById('blood_non-hemolysis').checked;
		if (!(  blood_neg || blood_plus || blood_plus2 ||  blood_plus3 || blood_non_hemolysis )) {
			alert("If you ran a urinalysis test, then you need to provided all the results for it.");
			return false;
			
		}
		
		var ph5 = document.getElementById('ph5').checked;
		var ph6 = document.getElementById('ph6').checked;
		var ph65 = document.getElementById('ph6.5').checked;
		var ph7 = document.getElementById('ph7').checked;
		var ph8 = document.getElementById('ph8').checked;
		var ph9 = document.getElementById('ph9').checked;
		
		if (!(  ph5 || ph6 || ph65 ||  ph7 || ph8 || ph9 )) {
			alert("If you ran a urinalysis test, then you need to provided all the results for it.");
			return false;
			
		}
		
		var protein_neg = document.getElementById('protein_neg').checked;
		var protein_trace = document.getElementById('protein_trace').checked;
		var protein_plus = document.getElementById('protein_+').checked;
		var protein_plus2 = document.getElementById('protein_++').checked;
		var protein_plus3 = document.getElementById('protein_+++').checked;
		var protein_plus4 = document.getElementById('protein_++++').checked;
		if (!(  protein_neg || protein_trace || protein_plus ||  protein_plus2 || protein_plus3 || protein_plus4 )) {
			alert("If you ran a urinalysis test, then you need to provided all the results for it.");
			return false;
			
		}
		
		var nitrite_neg = document.getElementById('nitrite_neg').checked;
		var nitrite_pos = document.getElementById('nitrite_pos').checked;
		var nitrite_trace = document.getElementById('nitrite_trace').checked;
		if (!(  nitrite_neg || nitrite_pos || nitrite_trace )) {
			alert("If you ran a urinalysis test, then you need to provided all the results for it.");
			return false;
			
		}
		
		var leukocytes_neg = document.getElementById('leukocytes_neg').checked;
		var leukocytes_plus = document.getElementById('leukocytes_+').checked;
		var leukocytes_plus2 = document.getElementById('leukocytes_++').checked;
		var leukocytes_plus3 = document.getElementById('leukocytes_+++').checked;
		if (!(  leukocytes_neg || leukocytes_plus || leukocytes_plus2 ||  leukocytes_plus3)) {
			alert("If you ran a urinalysis test, then you need to provided all the results for it.");
			return false;
			
		}
		
		var microscopy = document.getElementById('microscopy').value;
		if (!(microscopy)) {
			alert("If you ran a urinalysis test, then you need to provided all the results for it.");
			return false;
			
		}
		
	}
	
	if (hvs){
	
		var macroscopy = document.getElementById('macroscopy').value;
		var microscopy_hvs = document.getElementById('microscopy_hvs').value;
		var gram_stain = document.getElementById('gram_stain').value;
		if (!(  macroscopy && microscopy_hvs && gram_stain )) {
			alert("If you ran a HVS test, then you need to provided all the results for it.");
			return false;
			
		}
	}
	
	

}

// The functions below will disable and re-enable the cooresponding lab test elements on the webpage. 

function toggle_disabled_mps(_checked) {
	document.getElementById('no_mps').checked = false;
	document.getElementById('mps1').checked = false;
	document.getElementById('mps2').checked = false;
	document.getElementById('mps3').checked = false;

    document.getElementById('no_mps').disabled = _checked ? false : true;
	document.getElementById('mps1').disabled = _checked ? false : true;
	document.getElementById('mps2').disabled = _checked ? false : true;
	document.getElementById('mps3').disabled = _checked ? false : true;
}

function toggle_disabled_pbf(_checked) {
	document.getElementById('pbf_text').value = "";
	
	document.getElementById('pbf_text').disabled =  _checked ? false : true;
}

function toggle_disabled_widal(_checked) {
	document.getElementById('th1').value = "";
	document.getElementById('th2').value = "";
	
	document.getElementById('th1').disabled =  _checked ? false : true;
	document.getElementById('th2').disabled =  _checked ? false : true;
}

function toggle_disabled_brucella(_checked) {
	document.getElementById('bm1').value = "";
	document.getElementById('ba1').value = "";
	
	document.getElementById('bm1').disabled =  _checked ? false : true;
	document.getElementById('ba1').disabled =  _checked ? false : true;
}

function toggle_disabled_vdrl_rpr(_checked) {
	document.getElementById('reactive').checked = false;
	document.getElementById('non_reactive').checked = false;
	
	document.getElementById('reactive').disabled =  _checked ? false : true;
	document.getElementById('non_reactive').disabled =  _checked ? false : true;
}

function toggle_disabled_p24_hiv(_checked) {
	document.getElementById('reactive_p24_hiv').checked = false;
	document.getElementById('non_reactive_p24_hiv').checked = false;
	
	document.getElementById('reactive_p24_hiv').disabled =  _checked ? false : true;
	document.getElementById('non_reactive_p24_hiv').disabled =  _checked ? false : true;
}

function toggle_disabled_blood_sugar(_checked) {
	document.getElementById('blood_sugar_text').value = "";
	
	document.getElementById('blood_sugar_text').disabled =  _checked ? false : true;

}


function toggle_disabled_hba1c(_checked) {
	document.getElementById('hba1c_text').value = "";
	
	document.getElementById('hba1c_text').disabled =  _checked ? false : true;

}

function toggle_disabled_bun(_checked) {
	document.getElementById('bun_text').value = "";
	
	document.getElementById('bun_text').disabled =  _checked ? false : true;

}

function toggle_disabled_hematocrit(_checked) {
	document.getElementById('hematocrit_text').value = "";
	
	document.getElementById('hematocrit_text').disabled =  _checked ? false : true;

}

function toggle_disabled_creatinine(_checked) {
	document.getElementById('creatinine_text').value = "";
	
	document.getElementById('creatinine_text').disabled =  _checked ? false : true;

}

function toggle_disabled_electrolytes(_checked) {
	document.getElementById('electrolytes_text').value = "";
	
	document.getElementById('electrolytes_text').disabled =  _checked ? false : true;

}

function toggle_disabled_pylori_stool(_checked) {
	document.getElementById('positive_pylori_stool').checked = false;
	document.getElementById('negative_pylori_stool').checked = false;
	
	document.getElementById('positive_pylori_stool').disabled =  _checked ? false : true;
	document.getElementById('negative_pylori_stool').disabled =  _checked ? false : true;
}


function toggle_disabled_pylori_blood(_checked) {
	document.getElementById('positive_pylori_blood').checked = false;
	document.getElementById('negative_pylori_blood').checked = false;
	
	document.getElementById('positive_pylori_blood').disabled =  _checked ? false : true;
	document.getElementById('negative_pylori_blood').disabled =  _checked ? false : true;
}

function toggle_disabled_rheumatoid(_checked) {
	document.getElementById('reactive_rheumatoid').checked = false;
	document.getElementById('non_reactive_rheumatoid').checked = false;
	
	document.getElementById('reactive_rheumatoid').disabled =  _checked ? false : true;
	document.getElementById('non_reactive_rheumatoid').disabled =  _checked ? false : true;
}



function toggle_disabled_stool(_checked) {
	document.getElementById('app').value = "";
	document.getElementById('mic').value = "";
	
	document.getElementById('app').disabled =  _checked ? false : true;
	document.getElementById('mic').disabled =  _checked ? false : true;
}

function toggle_disabled_blood_group(_checked) {
	document.getElementById('rhve_neg').checked = false;
	document.getElementById('rhve_plus').checked = false;
	document.getElementById('a').checked = false;
	document.getElementById('b').checked = false;
	document.getElementById('o').checked = false;
	document.getElementById('ab').checked = false;
	document.getElementById('du_test').value = "";

    document.getElementById('rhve_neg').disabled = _checked ? false : true;
	document.getElementById('rhve_plus').disabled = _checked ? false : true;
	document.getElementById('a').disabled = _checked ? false : true;
	document.getElementById('b').disabled = _checked ? false : true;
	document.getElementById('o').disabled = _checked ? false : true;
	document.getElementById('ab').disabled = _checked ? false : true;
	document.getElementById('du_test').disabled = _checked ? false : true;
}

function toggle_disabled_pregnancy(_checked) {
	document.getElementById('hcg_detected').checked = false;
	document.getElementById('no_hcg_detected').checked = false;
	
	document.getElementById('hcg_detected').disabled =  _checked ? false : true;
	document.getElementById('no_hcg_detected').disabled =  _checked ? false : true;
}

function toggle_disabled_hb(_checked) {
	document.getElementById('hb_text').value = "";
	
	document.getElementById('hb_text').disabled =  _checked ? false : true;
}

function toggle_disabled_urinalysis(_checked) {
	document.getElementById('urobilinogen_neg').checked = false;
	document.getElementById('urobilinogen_plus_neg').checked = false;
	document.getElementById('urobilinogen_plus').checked = false;
	document.getElementById('urobilinogen_plus2').checked = false;
	document.getElementById('urobilinogen_plus3').checked = false;
	
    document.getElementById('urobilinogen_neg').disabled = _checked ? false : true;
	document.getElementById('urobilinogen_plus_neg').disabled = _checked ? false : true;
	document.getElementById('urobilinogen_plus').disabled = _checked ? false : true;
	document.getElementById('urobilinogen_plus2').disabled = _checked ? false : true;
	document.getElementById('urobilinogen_plus3').disabled = _checked ? false : true;

	
	document.getElementById('glucose_neg').checked = false;
	document.getElementById('glucose_plus_neg').checked = false;
	document.getElementById('glucose_plus').checked = false;
	document.getElementById('glucose_plus2').checked = false;
	document.getElementById('glucose_plus3').checked = false;
	
    document.getElementById('glucose_neg').disabled = _checked ? false : true;
	document.getElementById('glucose_plus_neg').disabled = _checked ? false : true;
	document.getElementById('glucose_plus').disabled = _checked ? false : true;
	document.getElementById('glucose_plus2').disabled = _checked ? false : true;
	document.getElementById('glucose_plus3').disabled = _checked ? false : true;
	
	
	document.getElementById('bilirubin_neg').checked = false;
	document.getElementById('bilirubin_plus_neg').checked = false;
	document.getElementById('bilirubin_plus2').checked = false;
	document.getElementById('bilirubin_plus3').checked = false;
	
    document.getElementById('bilirubin_neg').disabled = _checked ? false : true;
	document.getElementById('bilirubin_plus_neg').disabled = _checked ? false : true;
	document.getElementById('bilirubin_plus2').disabled = _checked ? false : true;
	document.getElementById('bilirubin_plus3').disabled = _checked ? false : true;
	
	
	document.getElementById('ketones_neg').checked = false;
	document.getElementById('ketones_plus_neg').checked = false;
	document.getElementById('ketones_plus').checked = false;
	document.getElementById('ketones_plus2').checked = false;
	document.getElementById('ketones_plus3').checked = false;
	
    document.getElementById('ketones_neg').disabled = _checked ? false : true;
	document.getElementById('ketones_plus_neg').disabled = _checked ? false : true;
	document.getElementById('ketones_plus').disabled = _checked ? false : true;
	document.getElementById('ketones_plus2').disabled = _checked ? false : true;
	document.getElementById('ketones_plus3').disabled = _checked ? false : true;
	
	
	document.getElementById('specific_gravity_1.000').checked = false;
	document.getElementById('specific_gravity_1.005').checked = false;
	document.getElementById('specific_gravity_1.010').checked = false;
	document.getElementById('specific_gravity_1.015').checked = false;
	document.getElementById('specific_gravity_1.020').checked = false;
	document.getElementById('specific_gravity_1.025').checked = false;
	document.getElementById('specific_gravity_1.030').checked = false;
	
	document.getElementById('specific_gravity_1.000').disabled = _checked ? false : true;
    document.getElementById('specific_gravity_1.005').disabled = _checked ? false : true;
	document.getElementById('specific_gravity_1.010').disabled = _checked ? false : true;
	document.getElementById('specific_gravity_1.015').disabled = _checked ? false : true;
	document.getElementById('specific_gravity_1.020').disabled = _checked ? false : true;
	document.getElementById('specific_gravity_1.025').disabled = _checked ? false : true;
	document.getElementById('specific_gravity_1.030').disabled = _checked ? false : true;
	
	
	document.getElementById('blood_neg').checked = false;
	document.getElementById('blood_+').checked = false;
	document.getElementById('blood_++').checked = false;
	document.getElementById('blood_+++').checked = false;
	document.getElementById('blood_non-hemolysis').checked = false;
	
    document.getElementById('blood_neg').disabled = _checked ? false : true;
	document.getElementById('blood_+').disabled = _checked ? false : true;
	document.getElementById('blood_++').disabled = _checked ? false : true;
	document.getElementById('blood_+++').disabled = _checked ? false : true;
	document.getElementById('blood_non-hemolysis').disabled = _checked ? false : true;
	
	
	document.getElementById('ph5').checked = false;
	document.getElementById('ph6').checked = false;
	document.getElementById('ph6.5').checked = false;
	document.getElementById('ph7').checked = false;
	document.getElementById('ph8').checked = false;
	document.getElementById('ph9').checked = false;
	
    document.getElementById('ph5').disabled = _checked ? false : true;
	document.getElementById('ph6').disabled = _checked ? false : true;
	document.getElementById('ph6.5').disabled = _checked ? false : true;
	document.getElementById('ph7').disabled = _checked ? false : true;
	document.getElementById('ph8').disabled = _checked ? false : true;
	document.getElementById('ph9').disabled = _checked ? false : true;
	
	
	document.getElementById('protein_neg').checked = false;
	document.getElementById('protein_trace').checked = false;
	document.getElementById('protein_+').checked = false;
	document.getElementById('protein_++').checked = false;
	document.getElementById('protein_+++').checked = false;
	document.getElementById('protein_++++').checked = false;
	
    document.getElementById('protein_neg').disabled = _checked ? false : true;
	document.getElementById('protein_trace').disabled = _checked ? false : true;
	document.getElementById('protein_+').disabled = _checked ? false : true;
	document.getElementById('protein_++').disabled = _checked ? false : true;
	document.getElementById('protein_+++').disabled = _checked ? false : true;
	document.getElementById('protein_++++').disabled = _checked ? false : true;
	
	
	document.getElementById('nitrite_neg').checked = false;
	document.getElementById('nitrite_trace').checked = false;
	document.getElementById('nitrite_pos').checked = false;
	
    document.getElementById('nitrite_neg').disabled = _checked ? false : true;
	document.getElementById('nitrite_trace').disabled = _checked ? false : true;
	document.getElementById('nitrite_pos').disabled = _checked ? false : true;
	
	
	document.getElementById('leukocytes_neg').checked = false;
	document.getElementById('leukocytes_+').checked = false;
	document.getElementById('leukocytes_++').checked = false;
	document.getElementById('leukocytes_+++').checked = false;
	
    document.getElementById('leukocytes_neg').disabled = _checked ? false : true;
	document.getElementById('leukocytes_+').disabled = _checked ? false : true;
	document.getElementById('leukocytes_++').disabled = _checked ? false : true;
	document.getElementById('leukocytes_+++').disabled = _checked ? false : true;
	
	
	document.getElementById('microscopy').value = "";
	document.getElementById('microscopy').disabled = _checked ? false : true;
}

function toggle_disabled_hvs(_checked){
	document.getElementById('macroscopy').value = "";
	document.getElementById('macroscopy').disabled = _checked ? false : true;
	document.getElementById('microscopy_hvs').value = "";
	document.getElementById('microscopy_hvs').disabled = _checked ? false : true;
	document.getElementById('gram_stain').value = "";
	document.getElementById('gram_stain').disabled = _checked ? false : true;
	document.getElementById('culture').value = "";
	document.getElementById('culture').disabled = _checked ? false : true;
}

function toggle_disabled_blood_count(_checked) {
	document.getElementById('rbc').value = "";
	document.getElementById('rbc').disabled = _checked ? false : true;

}

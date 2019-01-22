<?php	

session_start();

// upload_file returns the path that the image was moved to
function upload_file($file_name, $picture_name, $redirect_location, $target_directory) {

	// if user decides not to upload an image
	if (basename($_FILES[$file_name]["name"] == '')){
		return 'no_image';
	}
	
	$target_file = $target_directory . basename($_FILES[$file_name]["name"]);
	$image_file_type = pathinfo($target_file,PATHINFO_EXTENSION);

	// see if file exists in target directory, if yes, than append '_#' to the file name
	for ($i = 1; file_exists($target_file); ++$i) {
		$target_file = $target_directory . basename($_FILES[$file_name]["name"]) . '_' . $i . '.' . $image_file_type;	
	} 
	
	// make sure the file is an image
	if(isset($_POST["submit"])) {
		$check = get_image_size($_FILES[$file_name]["tmp_name"]);
		if($check !== false) {
			
		} else {
			echo "<script type='text/javascript'>
					alert('Picture: $picture_name \\n\\nFile is not an image.');  
					document.location.href = '$redirect_location'; 
				  </script>";
			return false;
		}
	}
	
	// make sure file size is under 20MB
	if ($_FILES[$file_name]["size"] > 20000000) {
		echo "<script type='text/javascript'>
					alert('Picture: $picture_name \\n\\nThe file is too large. The maximum size allowed is 20MB.'); 
					document.location.href = '$redirect_location'; 
			  </script>";
		return false;
	}
	
	// only allow jpg, png, jpeg, gif
	if($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg" && $image_file_type != "gif" ) {
		echo "<script type='text/javascript'>
					alert('Picture: $picture_name \\n\\njpg, jpeg, png, and gif are the only image formats allowed.');
					document.location.href = '$redirect_location'; 
			  </script>";
		return false;
	}
	
	// attempt to move the file
	if (move_uploaded_file($_FILES[$file_name]["tmp_name"], $target_file)) {
		return $target_file; 
	} 
	else {
		// file could not be moved, grab the error
		switch ($_FILES[$file_name]['error']) {
			case 1: 
				$error = 'Picture: $picture_name \\n\\nUPLOAD_ERR_INI_SIZE = Value: 1; The uploaded file exceeds the upload_max_filesize directive in php.ini.';
				break;
			case 2: 
				$error = 'Picture: $picture_name \\n\\nUPLOAD_ERR_FORM_SIZE = Value: 2; The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.';
				break;
			case 3: 
				$error = 'Picture: $picture_name \\n\\nUPLOAD_ERR_PARTIAL = Value: 3; The uploaded file was only partially uploaded.';
				break;
			case 4: 
				$error = 'Picture: $picture_name \\n\\nUPLOAD_ERR_NO_FILE = Value: 4; No file was uploaded.';
				break;
			case 6: 
				$error = 'Picture: $picture_name \\n\\nUPLOAD_ERR_NO_TMP_DIR = Value: 6; Missing a temporary folder. Introduced in PHP 5.0.3.';
				break;
			case 7: 
				$error = 'Picture: $picture_name \\n\\nUPLOAD_ERR_CANT_WRITE = Value: 7; Failed to write file to disk. Introduced in PHP 5.1.0.';
				break;
			case 8: 
				$error = 'Picture: $picture_name \\n\\nUPLOAD_ERR_EXTENSION = Value: 8; A PHP extension stopped the file upload. PHP does not provide a way to ascertain which extension caused the file upload to stop; examining the list of loaded extensions with phpinfo() may help.';
				break;
			}
			
			// display error
			echo "<script type='text/javascript'>
					alert('Picture: $picture_name \\n\\nThe image could not be moved to the correct directory.\\n\\n$error');
					document.location.href = '$redirect_location'; 					
			</script>";
		
			return false;
	}
}

// upload_file returns the path that the image was moved to
function upload_package($file_name, $picture_name, $redirect_location, $target_directory) {
	
	// if user decides not to upload an image
	if (basename($_FILES[$file_name]["name"] == '')){
		return 'no_image';
	}
	
	$target_file = $target_directory . basename($_FILES[$file_name]["name"]);
	$image_file_type = pathinfo($target_file,PATHINFO_EXTENSION);

	// see if file exists in target directory, if yes, than append '_#' to the file name
	for ($i = 1; file_exists($target_file); ++$i) {
		$target_file = $target_directory . basename($_FILES[$file_name]["name"]) . '_' . $i . '.' . $image_file_type;	
	} 
	
	// make sure the file is an image
	if(isset($_POST["submit"])) {
		$check = get_image_size($_FILES[$file_name]["tmp_name"]);
		if($check !== false) {
			
		} else {
			echo "<script type='text/javascript'>
					alert('Picture: $picture_name \\n\\nFile is not an image.');  
					document.location.href = '$redirect_location'; 
				  </script>";
			return false;
		}
	}

	// make sure file size is under 20MB
	if ($_FILES[$file_name]["size"] > 40000000) {
		echo "<script type='text/javascript'>
					alert('Picture: $picture_name \\n\\nThe file is too large. The maximum size allowed is 40MB.'); 
					document.location.href = '$redirect_location'; 
			  </script>";
		return false;
	}
	
	// attempt to move the file
	if (move_uploaded_file($_FILES[$file_name]["tmp_name"], $target_file)) {
		return $target_file; 
	} 
	else {
	
		// file could not be moved, grab the error
		switch ($_FILES[$file_name]['error']) {
			case 1: 
				$error = 'Picture: $picture_name \\n\\nUPLOAD_ERR_INI_SIZE = Value: 1; The uploaded file exceeds the upload_max_filesize directive in php.ini.';
				break;
			case 2: 
				$error = 'Picture: $picture_name \\n\\nUPLOAD_ERR_FORM_SIZE = Value: 2; The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.';
				break;
			case 3: 
				$error = 'Picture: $picture_name \\n\\nUPLOAD_ERR_PARTIAL = Value: 3; The uploaded file was only partially uploaded.';
				break;
			case 4: 
				$error = 'Picture: $picture_name \\n\\nUPLOAD_ERR_NO_FILE = Value: 4; No file was uploaded.';
				break;
			case 6: 
				$error = 'Picture: $picture_name \\n\\nUPLOAD_ERR_NO_TMP_DIR = Value: 6; Missing a temporary folder. Introduced in PHP 5.0.3.';
				break;
			case 7: 
				$error = 'Picture: $picture_name \\n\\nUPLOAD_ERR_CANT_WRITE = Value: 7; Failed to write file to disk. Introduced in PHP 5.1.0.';
				break;
			case 8: 
				$error = 'Picture: $picture_name \\n\\nUPLOAD_ERR_EXTENSION = Value: 8; A PHP extension stopped the file upload. PHP does not provide a way to ascertain which extension caused the file upload to stop; examining the list of loaded extensions with phpinfo() may help.';
				break;
			}
			
			// display error
			echo "<script type='text/javascript'>
					alert('Picture: $picture_name \\n\\nThe image could not be moved to the correct directory.\\n\\n$error');
					document.location.href = '$redirect_location'; 					
			</script>";
		
			return false;
	}
}


function read_json_file($file_name) {
	$file_type = pathinfo($_FILES[$file_name]["name"],PATHINFO_EXTENSION);
	$username = $_SESSION['username'];

	

	if ($file_type == 'json') {
		$temp = file_get_contents($_FILES[$file_name]["tmp_name"]);
		return $temp;
	}

	
	$file = $_FILES[$file_name]["tmp_name"];
	$zip_folder = new ZipArchive(); 

	
	$zip_array = array();
	$zip_folder->open($_FILES[$file_name]["tmp_name"]); 



	for( $i = 1; $i < $zip_folder->numFiles; ++$i ){ 
		
		$stat = $zip_folder->statIndex( $i ); 
		
		mkdir("/var/www/html/uploaded_images/custom_forms/{$username}", 0777);
		if (pathinfo($stat['name'],PATHINFO_EXTENSION) == 'json') {
			$json_string = $json_string . $zip_folder->getFromIndex($i);
		}	
		else {
			file_put_contents("/var/www/html/uploaded_images/custom_forms/{$username}/" . basename($stat['name']), $zip_folder->getFromIndex($i));
		}
			
		

   	}

	
	return $json_string;
	
	

	
}


 function rrmdir($dir) { 
   if (is_dir($dir)) { 
     $objects = scandir($dir); 
     foreach ($objects as $object) { 
       if ($object != "." && $object != "..") { 
         if (is_dir($dir."/".$object))
           rrmdir($dir."/".$object);
         else
           unlink($dir."/".$object); 
       } 
     }
     rmdir($dir); 
   } 
 }


function strposX($string, $char, $number_of_occurrences){
    if($number_of_occurrences == '1'){
        return strpos($string, $char);
    }
	elseif($number_of_occurrences > '1'){
        return strpos($string, $char, strposX($string, $char, $number_of_occurrences - 1) + strlen($char));
    }
	else{
        return error_log('Error: Value for parameter $number_of_occurrences is out of range');
    }
}

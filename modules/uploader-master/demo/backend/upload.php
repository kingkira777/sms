<?php
include("../../../../include/route.inc.php");
include($routeDocPath."include/connection.inc.php");
/*
  This is a ***DEMO*** , the backend / PHP provided is very basic. You can use it as a starting point maybe, but ***do not use this on production***. It doesn't preform any server-side validation, checks, authentication, etc.

  For more read the README.md file on this folder.

  Based on the examples provided on:
  - http://php.net/manual/en/features.file-upload.php
*/
$h_id = $_POST['h_id'];

try {
    if (
        !isset($_FILES['file']['error']) ||
        is_array($_FILES['file']['error'])
    ) {
        throw new RuntimeException('Invalid parameters.');
    }

    switch ($_FILES['file']['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new RuntimeException('No file sent.');
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('Exceeded filesize limit.');
		case UPLOAD_ERR_EXTENSION:
			throw new RuntimeException('File is Not Valid');
        default:
            throw new RuntimeException('Unknown errors.');
    }
	
	
	$filename = uniqid()."_".$_FILES['file']['name'];
	
	$chkFolder =  "../../../../elFinder2/HOME_HEALTH_CONTRACT";
	if(!file_exists($chkFolder)){
		@mkdir($chkFolder,0755);
	}
    $filepath =$chkFolder."/".$filename;
	//SAVE DATABASE FILE
	$saveFileDb = "insert into tblhomehealthcontract(hc_hid, hc_filename, hc_contactpath)
						values('$h_id','$filename','$filepath')";
	mysqli_query($con,$saveFileDb);
	
	
	
    if (!move_uploaded_file(
        $_FILES['file']['tmp_name'],
        $filepath
    )) {
        throw new RuntimeException('Failed to move uploaded file.');
    }else{
		//UPDATE HAS CONTRACT
		$hascontract = "update tblhomehealth set h_hascontract='true'
							where h_id='$h_id'";
		mysqli_query($con,$hascontract);
	}

    // All good, send the response
    echo json_encode([
        'status' => 'ok',
        'path' => $filepath
    ]);

} catch (RuntimeException $e) {
	// Something went wrong, send the err message as JSON
	http_response_code(400);

	echo json_encode([
		'status' => 'error',
		'message' => $e->getMessage()
	]);
}
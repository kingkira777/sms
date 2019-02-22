<?php
require_once '../app.class.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$app = new App();

$studno = $_POST['studno'];
$section = $_POST['section'];

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
    
    
$path = "../../files";
$filename = uniqid()."_".$_FILES['file']['name'];

if(!file_exists($path)){
    @mkdir($path);
}

$filepath = $path."/".$filename;
$npath = explode('../../',$filepath);
$save = "INSERT INTO files(f_studno, f_section,  f_name, f_path) VALUES (?, ?, ?, ?)";
$rsave = $app->Connect()->prepare($save);
$rsave->execute([$studno, $section, $filename, $npath[1]]);

if (!move_uploaded_file(
        $_FILES['file']['tmp_name'],
        $filepath
    )) {
        throw new RuntimeException('Failed to move uploaded file.');
    }
        
       // All good, send the response
    echo json_encode([
        'status' => 'ok',
        'path' => $filepath
    ]);
} catch (Exception $ex) {
    // Something went wrong, send the err message as JSON
	http_response_code(400);

	echo json_encode([
		'status' => 'error',
		'message' => $ex->getMessage()
	]);
}
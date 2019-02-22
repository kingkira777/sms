<?php
require_once '../app.class.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of file
 *
 * @author Jessie
 */
class File extends App{
    //put your code here
   
    
    //DELETE FILE
    function DeleteFile($fid){
        
        $q ="SELECT * FROM files WHERE f_id = ?";
        $rq = $this->Connect()->prepare($q);
        $rq->execute([$fid]);
        $finof = $rq->fetch();
        
        $file = '../../'.$finof['f_path'];
        if(file_exists($file)){
            unlink($file);
        }
        
        $d = "DELETE FROM files WHERE f_id = ?";
        $r = $this->Connect()->prepare($d);
        $r->execute([$fid]);
        echo "deleted";
    }
    
    //GET FILE LIST
    function GetFileList($studno){
        $file_arr = array();
        $q = "SELECT * FROM files a 
				left join students b on a.f_studno = b.stud_no 
				left join teachers c on a.f_studno = c.t_no";
        $r = $this->Connect()->prepare($q);
        $r->execute();
        if($r->rowCount()>0){;
            while($rr = $r->fetch()){
				$filename = $rr['f_name'];
				$tname = $rr['t_lastname'].' '.$rr['t_firstname'].' '.$rr['t_middlename'];
				$sname = $rr['stud_lastname'].' '.$rr['stud_firstname'].' '.$rr['stud_middlename'];
				$name = ($rr['stud_firstname'] === null)? $tname : $sname;
				$file['fid'] = $rr['f_id'];
                                $file['filename'] = $filename;
				$file['name'] = $name;
				$file['fpath'] = $rr['f_path'];
				array_push($file_arr,$file);
            }
            echo json_encode($file_arr);
        }else{
            echo json_encode($file_arr);
        }
      
    }
    
    
    
}//End of Class


//================================POST REQUEST===============================//

$file = new File();

if(isset($_POST['']) && !empty($_POST[''])){
    
    
}

if(isset($_POST['']) && !empty($_POST[''])){
    
    
}

if(isset($_POST['']) && !empty($_POST[''])){
    
    
}

if(isset($_POST['']) && !empty($_POST[''])){
    
    
}

//DELETE FILE
if(isset($_POST['dfile']) && !empty($_POST['dfile'])){
    $fid = filter_input(INPUT_POST, 'fid');
    $file->DeleteFile($fid);
}

//GET FILE LIST
if(isset($_POST['gfilelist']) && !empty($_POST['gfilelist'])){
    $secid = filter_input(INPUT_POST, 'secid');
    $file->GetFileList($secid);
}


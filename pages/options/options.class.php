<?php
require_once '../app.class.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of options
 *
 * @author Jessie
 */
class Options extends App{
    //put your code here
    
    
  //========================YEAR PHP============================//
    
    //Delete Year
    function DeleteYear($yid){
        $dy = "DELETE FROM `year` WHERE yr_id = '$yid'";
        $rd = $this->Connect()->prepare($dy);
        $rd->execute();
        echo "deleted";
    }
    
    //Get Year Table List
    function GetYearTableList(){
        $y_arr = array();
        $q = "SELECT * FROM `year`";
        $r = $this->Connect()->prepare($q);
        $r->execute();
        if($r->rowCount()>0){
            while($rr = $r->fetchAll()){
                $y_arr = $rr;
            }
            echo json_encode($y_arr);
        }else{
            echo json_encode($y_arr);
        }
    }
    
    //Get Year Select List
    function GetYearSelectList(){
        echo '<option value=""></option>';
        $q = "SELECT * FROM `year`";
        $r = $this->Connect()->prepare($q);
        $r->execute();
        if($r->rowCount()>0){
            while($rr = $r->fetch()){
               echo '<option value="'.$rr['yr_year'].'">'.$rr['yr_year'].'</option>'; 
            }
        }
    }
    
    
    function EditYear($yid){
        $e = "SELECT * FROM `year` WHERE yr_id = ?";
        $re = $this->Connect()->prepare($e);
        $re->execute([$yid]);
        $yinfo = $re->fetch();
        $year = $yinfo['yr_year'];
        $year = explode('-', $year);
        $yy['id'] = $yid;
        $yy['yfrom'] = $year[0]; 
        $yy['yto'] = $year[1];
        echo json_encode($yy);
    }
    
    //Save Year
    function SaveYear($yid,$year){
        if(empty($yid)){
            $chk = "SELECT * FROM `year` WHERE yr_year = '$year'";
            $r = $this->Connect()->prepare($chk);
            $r->execute();
            if($r->rowCount()>0){
                echo "existed";
            }else{
                try {
                    $s = "INSERT INTO `year`(yr_year) VALUES(?)";
                    $rs = $this->Connect()->prepare($s);
                    $rs->execute([$year]);
                    echo "saved";
                } catch (\PDOException $ex) {
                    echo $ex->getMessage();
                }
            }
        }else{
            $u = "UPDATE `year` SET yr_year = ? WHERE yr_id = ?";
            $ru = $this->Connect()->prepare($u);
            $ru->execute([$year, $yid]);
            echo "updated";
        }
        
    }
    
 //========================SECTIONS PHP============================//
    
    //Delete Section
    function DeleteSection($sid){
        $d = "DELETE FROM sections WHERE sec_id = '$sid'";
        $r = $this->Connect()->prepare($d);
        $r->execute();
        echo "deleted";
    }
   
    //Get Section Select List
    function GetSectionSelectList($cid){
        echo '<option value=""></option>';
        $q = "SELECT * FROM sections WHERE sec_courseid = ?";
        $r = $this->Connect()->prepare($q);
        $r->execute([$cid]);
        if($r->rowCount()>0){
            while($rr = $r->fetch()){
                echo '<option value="'.$rr['sec_id'].'">'.$rr['sec_name'].'</option>';
            }
        }
    }
    
    //Get Section Table List
    function GetSectionTableList($cid){
        $sec_arr = array();
            $q = "SELECT * FROM sections a
                left join courses b on a.sec_courseid = b.c_id
                WHERE a.sec_courseid = ?";
            $r = $this->Connect()->prepare($q);
            $r->execute([$cid]);
            if($r->rowCount()>0){
                while($rr = $r->fetchAll()){
                    $sec_arr = $rr;
                }
                echo json_encode($sec_arr);
            }else{
                echo json_encode($sec_arr);
            }
    }
    
    //EDIT SECTIONS
    function EditSection($secid){
        $e = "SELECT * FROM sections WHERE sec_id = ?";
        $re = $this->Connect()->prepare($e);
        $re->execute([$secid]);
        $secinfo = $re->fetch();
        echo json_encode($secinfo);
    }

    //Save Section
    function SaveSection($secid, $scourse, $secname){
        if(empty($secid)){
            $l = "SELECT * FROM sections WHERE sec_courseid = ?";
            $rl = $this->Connect()->prepare($l);
            $rl->execute([$scourse]);
            if($rl->rowCount() > 2){
                echo 'limit';
            }else{
                $c = "SELECT * FROM sections WHERE sec_name = '$secname'";
                $rc = $this->Connect()->prepare($c);
                $rc->execute();
                if($rc->rowCount()>0){
                    echo "existed";
                }else{
                    try {
                        $s = "INSERT INTO sections(sec_courseid, sec_name) VALUES(?, ?)";
                        $r = $this->Connect()->prepare($s);
                        $r->execute([$scourse, $secname]);
                        echo "saved";
                    } catch (\PDOException $ex) {
                        echo $ex->getMessage();
                    }
                }
           }
        }else{
            $c = "SELECT * FROM sections WHERE sec_name = '$secname'";
            $rc = $this->Connect()->prepare($c);
            $rc->execute();
            if($rc->rowCount()>0){
                echo "existed";
            }else{
                $u = "UPDATE sections SET sec_name = ? WHERE sec_id = ?";
                $ru = $this->Connect()->prepare($u);
                $ru->execute([$secname,$secid]);
                echo "updated";
            }
        }
    }
    
    
 //========================SUBJECT PHP============================//
 
    //DeleteSubject
    function DeleteSubject($sid){
        $d = "DELETE FROM subjects WHERE sub_id = '$sid'";
        $r = $this->Connect()->prepare($d);
        $r->execute();
        echo "deleted";
    }
    
    
    //GET Subject Table List
    function GetSubjectList($courseid){
        $c_arr = array();
        $l = "SELECT * FROM subjects WHERE sub_courseid = '$courseid'";
        $rl = $this->Connect()->prepare($l);
        $rl->execute();
        if($rl->rowCount()>0){
            while($rrl = $rl->fetchAll()){
                $c_arr = $rrl;
            }
            echo json_encode($c_arr);
        }else{
            echo json_encode($c_arr);
        }
    }
    
    //GET SUBJECT LIST BY STUDENT NO
    function GetSubjectByStudentNo($studno){
        echo '<option value=""><--SELECT SUBJECT--></option>';
        $q = "SELECT * FROM subjects a
            left join students b on a.sub_courseid = b.stud_course
            WHERE b.stud_no = '$studno'";
        $r = $this->Connect()->prepare($q);
        $r->execute();
        while($rr = $r->fetch()){
            $sub = $rr['sub_code'];
            echo '<option value="'.$sub.'">'.$sub.'</option>';
        }
    }


    //GET SUBJECT LIST
    function SubjectSelectList(){
        echo '<option value=""></option>';
        $q = "SELECT * FROM subjects";
        $r = $this->Connect()->prepare($q);
        $r->execute();
        while ($rr = $r->fetch()){
            echo '<option value="'.$rr['sub_id'].'">'.$rr['sub_code'].' : '.$rr['sub_description'].'</option>';
        }
    }
    
    //EDIT SUBJECT
    function EditSubject($subid){
        $e = "SELECT * FROM subjects WHERE sub_id = ?";
        $r = $this->Connect()->prepare($e);
        $r->execute([$subid]);
        $subinfo = $r->fetch();
        echo json_encode($subinfo);
    }
    
    
    //Save Subject
    function SaveSubject($subid, $courseid, $subcode, $subdes, $units){
        if(empty($subid)){
            $c = "SELECT * FROM subjects WHERE sub_code = '$subcode'";
            $r = $this->Connect()->prepare($c);
            $r->execute();
            if($r->rowCount()>0){
                echo "existed";
            }else{
                try{
                    $s = "INSERT INTO subjects(sub_courseid, sub_code, sub_description, sub_units) VALUES(?, ?, ?, ?)";
                    $sq = $this->Connect()->prepare($s);
                    $sq->execute([$courseid, $subcode, $subdes, $units]);
                    echo "saved";
                } catch (\PDOException $e){
                    $e->getMessage();
                }
            }
        }else{
            $c = "SELECT * FROM subjects WHERE sub_code = '$subcode'";
            $r = $this->Connect()->prepare($c);
            $r->execute();
            if($r->rowCount()>0){
                echo "existed";
            }else{
                $u = "UPDATE subjects SET sub_courseid = ?, sub_code = ?, sub_description = ?, sub_units = ? WHERE sub_id = ?";
                $ru = $this->Connect()->prepare($u);
                $ru->execute([$courseid, $subcode, $subdes, $units, $subid]);
                echo "updated";
            }
        }
        
        
    }
    
    
 //========================COURSES PHP============================//   
    
    //SELECT COURSE
    function SelectCourse($cid){
        echo '<option value=""></option>';
        $q = "SELECT * FROM subjects WHERE sub_courseid = '$cid'";
        $r = $this->Connect()->prepare($q);
        $r->execute();
        if($r->rowCount()>0){
            while($rr = $r->fetch()){
                $sid  = $rr['sub_id'];
                $scode = $rr['sub_code'];
                $sdes = $rr['sub_description'];
                echo '<option value="'.$scode.'">'.$scode.' : '.$sdes.'</option>';
            }
        }
        
    }
    
    
    //DELETE COURSE
    function DeleteCourse($cid){
        try{
            $q = "DELETE FROM courses WHERE c_id = '$cid'";
            $rq = $this->Connect()->prepare($q);
            $rq->execute();
            echo "deleted";
        } catch (\PDOException $e){
            echo $e->getMessage();
        }
    }
    
    //GET COURSES TABLE LIST
    function CourseList(){
        $c_arr = array();
        $q = "SELECT * FROM courses";
        $r = $this->Connect()->prepare($q);
        $r->execute();
        if($r->rowCount()>0){
            while($rr = $r->fetchAll()){
                $c_arr = $rr;
            }
            echo json_encode($c_arr);
        }else{
            echo json_encode($c_arr);
        }
    }
    
    //GET COURSE LIST SELECT
    function GetCourseList(){
        echo '<option value=""></optio>';
        $q = "SELECT * FROM courses";
        $r = $this->Connect()->prepare($q);
        $r->execute();
        if($r->rowCount()>0){
            while($rr = $r->fetch()){
                echo '<option value="'.$rr['c_id'].'">'.$rr['c_name'].'</option>';
            }
        }
    }
    
    
    function EditCourse($cid){
        $e = "SELECT * FROM courses WHERE c_id = ?";
        $r = $this->Connect()->prepare($e);
        $r->execute([$cid]);
        $cinfo = $r->fetch();
        echo json_encode($cinfo);
    }
    
    //SAVE COURSE
    function SaveCourse($cid, $cname){
        
        
        if(empty($cid)){
            $c = "SELECT * FROM courses WHERE c_name = '$cname'";
            $r = $this->Connect()->prepare($c);
            $r->execute();
            if($r->rowCount()>0){
                echo "existed";
            }else{
                try{
                    $s = "INSERT INTO courses(c_name) VALUES (?)";
                    $rs = $this->Connect()->prepare($s);
                    $rs->execute([$cname]);
                    echo "saved";
                } catch (\PDOException $e){
                    echo $e->getMessage();
                }
            }
        }else{
            
            $c = "SELECT * FROM courses WHERE c_name = '$cname'";
            $r = $this->Connect()->prepare($c);
            $r->execute();
            if($r->rowCount()>0){
                echo "existed";
            }else{
                $u = "UPDATE courses SET c_name = ? WHERE c_id = ?";
                $ru = $this->Connect()->prepare($u);
                $ru->execute([$cname, $cid]);
                echo "updated";
            }
        }
    }
       
}//END OF CLASS



//===========================POST REQUEST=====================================//

$option = new Options();

//Get Year Select
if(isset($_POST['gyearselectlist']) && !empty($_POST['gyearselectlist'])){
    $option->GetYearSelectList();
}

//DELETE YEAR
if(isset($_POST['dyear']) && !empty($_POST['dyear'])){
    $yid = filter_input(INPUT_POST, 'yid', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $option->DeleteYear($yid);
}

//GET TABLE YEAR LIST
if(isset($_POST['gyeartablelist']) && !empty($_POST['gyeartablelist'])){
    $option->GetYearTableList();
}
//EDIT YEAR
if(isset($_POST['edityear']) && !empty($_POST['edityear'])){
    $yid = filter_input(INPUT_POST, 'yid', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $option->EditYear($yid);
}


if(isset($_POST['syear']) && !empty($_POST['syear'])){
    $yid = filter_input(INPUT_POST, 'yid', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $cyear = filter_input(INPUT_POST, 'cyear', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $option->SaveYear($yid,$cyear);
}

//===============================SECTIONS====================================//
//Delete Section
if(isset($_POST['dsection']) && !empty($_POST['dsection'])){
    $secid = filter_input(INPUT_POST, 'secid', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $option->DeleteSection($secid);
}

//Get section table list
if(isset($_POST['gsectabellist']) && !empty($_POST['gsectabellist'])){
    $courseid = filter_input(0, 'courseid');
    $option->GetSectionTableList($courseid);
}

//Get section Select list
if(isset($_POST['gsecselectlist']) && !empty($_POST['gsecselectlist'])){
    $cid = filter_input(0, 'cid');
    $option->GetSectionSelectList($cid);
}

if(isset($_POST['editsec']) && !empty($_POST['editsec'])){
    $secid = filter_input(INPUT_POST, 'secid', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $option->EditSection($secid);
}

//save section 
if(isset($_POST['savesec']) && !empty($_POST['savesec'])){
    $secid = filter_input(INPUT_POST, 'secid', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $sname = filter_input(INPUT_POST, 'sname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $scourse = filter_input(INPUT_POST, 'sec_course', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $option->SaveSection($secid,$scourse,$sname);
}

//SUBJECT==================================================================

//Delete Subject
if(isset($_POST['dsubject']) && !empty($_POST['dsubject'])){
    $subid = filter_input(INPUT_POST, 'sid', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $option->DeleteSubject($subid);
}

//get subject list table 
if(isset($_POST['gsublist']) && !empty($_POST['gsublist'])){
    $courseid = filter_input(INPUT_POST, 'cid', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $option->GetSubjectList($courseid);
}

if(isset($_POST['editsub']) && !empty($_POST['editsub'])){
    $subid = filter_input(INPUT_POST, 'subid', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $option->EditSubject($subid);
}


if(isset($_POST['savesubject']) && !empty($_POST['savesubject'])){
    $subid = filter_input(INPUT_POST, 'subid', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $courseid = filter_input(INPUT_POST, 'courseid', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $subcode = filter_input(INPUT_POST, 'subcode', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $subdes = filter_input(INPUT_POST, 'subdes', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $subunits = filter_input(INPUT_POST, 'subunits', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $option->SaveSubject($subid, $courseid, $subcode, $subdes, $subunits);
}



//COURSE===========================================================

//SELECT COURSE
if(isset($_POST['selectcourse']) && !empty($_POST['selectcourse'])){
    $cid = filter_input(INPUT_POST, 'cid', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $option->SelectCourse($cid);
}

//GET COURSE LSIT
if(isset($_POST['gcselectlist']) && !empty($_POST['gcselectlist'])){
    $option->GetCourseList();
}


//DELETE COURSE 
if(isset($_POST['dcourse']) && !empty($_POST['dcourse'])){
    $cid = filter_input(INPUT_POST, 'cid');
    $option->DeleteCourse($cid);
}

if(isset($_POST['editcourse']) && !empty($_POST['editcourse'])){
    $cid = filter_input(INPUT_POST, 'cid', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $option->EditCourse($cid);
}

//GET COURSE LIST
if(isset($_POST['gclist']) && !empty($_POST['gclist'])){
    $option->CourseList();
}

//SAVE COURSE
if(isset($_POST['scourse']) && !empty($_POST['scourse'])){
    $cid = filter_input(INPUT_POST, 'cid');
    $cname = filter_input(INPUT_POST, 'cname');
    $option->SaveCourse($cid,$cname);
}
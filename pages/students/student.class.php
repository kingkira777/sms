<?php
require_once '../app.class.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of student
 *
 * @author Jessie
 */
class Student extends App{
     
    public $s_id;
    public $s_no;
    public $s_firstname;
    public $s_lastname;
    public $s_middlename;
    public $s_dob;
    public $s_gender;
    public $s_citizenship;
    public $s_contactno;
    public $s_email;
    public $s_address;
    public $s_course;
    public $s_section;
    public $s_year;
    
    public $s_emname;
    public $s_emcontact;
    
    
    //SAVE TO ARCHIVE (OLD STUDENT)
    function SaveAr($isactive){
        $u = "UPDATE students SET stud_active = ? WHERE stud_id = ?";
        $ru = $this->Connect()->prepare($u);
        $ru->execute([$isactive, $this->s_id]);
        echo $isactive;
    }

    //DELETE STUDENT NOT USED
    function DeleteStudent(){
        
        $chk = "SELECT * FROM students WHERE stud_id = ?";
        $rchk = $this->Connect()->prepare($chk);
        $rchk->execute([$this->s_id]);
        if($rchk->rowCount()>0){
            $useinof = $rchk->fetch();
            $userno = $useinof['stud_no'];
            $duser = "DELETE FROM users WHERE user_idno = ?";
            $rduser = $this->Connect()->prepare($duser);
            $rduser->execute([$userno]);
            $this->DeleteStudAndUser();
        }else{
            $this->DeleteStudAndUser();
        }      
    }
    
    function DeleteStudAndUser(){
        try{
            $q = "DELETE FROM students WHERE stud_id = '$this->s_id'";
            $r = $this->Connect()->prepare($q);
            $r->execute();
            echo "deleted";
        } catch (\PDOException $e){
            $e->getMessage();
        } 
    }


    //EDIT STUDENT INFO
    function EditStudentInfo(){
        $q = "SELECT * FROM students a left join studentcode b on a.stud_no = b.scode_studno WHERE a.stud_id = '$this->s_id'";
        $r = $this->Connect()->prepare($q);
        $r->execute();
        $info = $r->fetch();
        echo json_encode($info);
    }
    
    
    //GET STUDENT ARCHIVE
    function GetStudentArchiveList(){
        $stud_arr = array();
        $q = "SELECT * FROM students WHERE stud_isregistered = 'true' AND stud_approved = 'true' AND  stud_active = 'true'";
        $r = $this->Connect()->prepare($q);
        $r->execute();
        if($r->rowCount()>0){
            while($rr = $r->fetchAll()){
                $stud_arr = $rr;
            }
            echo json_encode($stud_arr);
        }else{
            echo json_encode($stud_arr);
        }
    }
    
    //GET STUDENT LIST
    function GetStudentList(){
        $stud_arr = array();
        $q = "SELECT * FROM students WHERE stud_isregistered = 'true' AND stud_approved = 'true' AND  stud_active != 'true'";
        $r = $this->Connect()->prepare($q);
        $r->execute();
        if($r->rowCount()>0){
            while($rr = $r->fetchAll()){
                $stud_arr = $rr;
            }
            echo json_encode($stud_arr);
        }else{
            echo json_encode($stud_arr);
        }
    }
    
    
    //SAVE UPDATE STUDENT INFO
    function SaveUpdateStudent(){
        if(empty($this->s_id)){
            
            $chk = "SELECT * FROM students WHERE stud_firstname = ? AND stud_lastname = ? AND  stud_middlename = ?";
            $rchk = $this->Connect()->prepare($chk);
            $rchk->execute([$this->s_firstname, $this->s_lastname, $this->s_middlename]);
            if($rchk->rowCount()>0){
                echo "existed";
            }else{
                try{
                    $save = "INSERT INTO students(stud_no, stud_firstname, stud_lastname, stud_middlename, stud_dob, stud_gender,"
                            . "stud_citizenship, stud_contactno, stud_email, stud_address, stud_course, stud_section, stud_year)"
                            . "VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $rsave = $this->Connect()->prepare($save);
                    $rsave->execute([$this->s_no, $this->s_firstname, $this->s_lastname, $this->s_middlename, $this->s_dob,
                    $this->s_gender, $this->s_citizenship, $this->s_contactno, $this->s_email, $this->s_address, $this->s_course,
                    $this->s_section, $this->s_year]);
                    echo "saved";
                } catch (\PDOException $e){
                    echo $e->getMessage();
                }
            }
        }else{
            
            try {
                
                $up = 'UPDATE students SET stud_firstname = ?, stud_lastname=?, stud_middlename=?, stud_dob=?, stud_gender=?,
                         stud_citizenship=?, stud_contactno=?, stud_email=?, stud_address=?, stud_course=?, stud_section=?,
                         stud_year=?, stud_emName = ?, stud_emContact = ? WHERE stud_no=?';
                
                $rup = $this->Connect()->prepare($up);
                $rup->execute([$this->s_firstname, $this->s_lastname, $this->s_middlename, $this->s_dob,
                $this->s_gender, $this->s_citizenship, $this->s_contactno, $this->s_email, $this->s_address, $this->s_course,
                $this->s_section, $this->s_year, $this->s_emname, $this->s_emcontact, $this->s_no]);
                echo "updated";
                
            } catch (\PDOException $ex) {
                echo $ex->getMessage();
            }
            
            
            
        }
    }
    
    //GENERATE STUDENT NO
    function GenerateStudentNo(){
        
        $r = "SELECT * FROM studentcode";
        $q = $this->Connect()->prepare($r);
        $q->execute();
        $row = $q->rowCount() + 1;
        
        $dd = date('d');
        $mm = date('m');
        $yy = date('Y');
        $yy = substr($yy, -2);
        
        $studno = $dd.$mm.$yy.$row;
        echo $studno;
    }
    
    
    
    //put your code here
}//END OF CLASS


//================================POST REQUEST===============================//

$student = new Student();


//GET STUDENT ARCHIVE
if(isset($_POST['garstudentlist']) && !empty($_POST['garstudentlist'])){
    $student->GetStudentArchiveList();
}

//ACTIVE 
if(isset($_POST['activestud']) && !empty($_POST['activestud'])){
    $sid = filter_input(0, 'sid');
    $isactive = filter_input(0, 'isactive');
    $student->s_id = $sid;
    $student->SaveAr($isactive);
}

//DELET STUDENT
if(isset($_POST['dstud']) && !empty($_POST['dstud'])){
    
    $sid = filter_input(INPUT_POST, 'sid');
    $student->s_id= $sid;
    $student->DeleteStudent();
}

if(isset($_POST['editstudinof']) && !empty($_POST['editstudinof'])){
    $sid = filter_input(INPUT_POST, 'sid');
    $student->s_id = $sid;
    $student->EditStudentInfo();
    
}

//GET STUDENT LIST 
if(isset($_POST['gstudlist']) && !empty($_POST['gstudlist'])){
    $student->GetStudentList();
}

if(isset($_POST['supdate']) && !empty($_POST['supdate'])){
    
    $sid = filter_input(INPUT_POST, 'sid', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $sno = filter_input(INPUT_POST, 'sno', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $scode = filter_input(INPUT_POST, 'scode', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $fname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lname = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $mname = filter_input(INPUT_POST, 'mname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $dob = filter_input(INPUT_POST, 'dob', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $citizen = filter_input(INPUT_POST, 'citizen', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $contactno = filter_input(INPUT_POST, 'contactno', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $course = filter_input(INPUT_POST, 'course', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $section = filter_input(INPUT_POST, 'section', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $year = filter_input(INPUT_POST, 'year', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $emname= filter_input(INPUT_POST, 'emname');
    $emcontact= filter_input(INPUT_POST, 'emcontact');
    
    
    
    $student->s_id = $sid;
    $student->s_no =$sno;
    $student->s_firstname = $fname;
    $student->s_lastname = $lname;
    $student->s_middlename = $mname;
    $student->s_dob = $dob;
    $student->s_gender= $gender;
    $student->s_citizenship = $citizen;
    $student->s_contactno= $contactno;
    $student->s_email = $email;
    $student->s_address =$address;
    $student->s_course = $course;
    $student->s_section = $section;
    $student->s_year = $year;
    $student->s_emname = $emname;
    $student->s_emcontact = $emcontact;
    
    $student->SaveUpdateStudent();
    $student->SaveStudentCodeno($sno, $scode, 'false');
    
}

//GENERATE STUDENT NO
if(isset($_POST['genstudno']) && !empty($_POST['genstudno'])){
    $student->GenerateStudentNo();
}
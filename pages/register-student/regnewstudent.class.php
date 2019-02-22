<?php
require_once '../app.class.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of regnewstudent
 *``
 * @author Jessie
 */
class RegNewStudent extends App{
    //put your code here
    public $reg_studno, $reg_fname, $reg_lname, $reg_mname, $reg_coursid, $reg_section, $reg_year, $reg_ylevel;
    
    
    
    //APPROVED STUDENT
    function ApprovedStudent($id){
        $a = "UPDATE students SET stud_approved = 'true' WHERE stud_id = ?";
        $ra = $this->Connect()->prepare($a);
        $ra->execute([$id]);
        echo 'updated';
    }
    
    //DELETE STUD
    function DeleteStudent($id){
        $d = "DELETE FROM students WHERE stud_id = ?";
        $rd = $this->Connect()->prepare($d);
        $rd->execute([$id]);
        echo 'deleted';
    }

    //EDIT STUNDET
    function EditRegStudent($id){
        $q = "SELECT * FROM students WHERE stud_id = ?";
        $r = $this->Connect()->prepare($q);
        $r->execute([$id]);
        $studinfo = $r->fetch();
        echo json_encode($studinfo);
    }


    //GET STUDENT REGISTER LIST 
    function GetStudentRegisterTable(){
        $q = "SELECT* FROM students a
            left join courses b on a.stud_course = b.c_id WHERE a.stud_approved = 'false'";
        $r = $this->Connect()->prepare($q);
        $r->execute();
        $regstud = $r->fetchAll();
        echo json_encode($regstud);
        
    }

    //SAVE NEW REG STUDENT
    function SaveNewRegStudent($id){
        
        if(empty($id)){
            $c = "SELECT * FROM students WHERE stud_firstname = ? AND stud_lastname = ? AND stud_middlename = ?";
            $rc= $this->Connect()->prepare($c);
            $rc->execute([$this->reg_fname, $this->reg_lname, $this->reg_mname]);
            if($rc->rowCount()>0){
                echo 'existed';
            }else{
                $s = "INSERT INTO students(stud_no, stud_firstname, stud_lastname, stud_middlename, 
                    stud_course, stud_section, stud_year, stud_approved, stud_ylevel) 
                    VALUES(:studno, :fname, :lname, :mname, :course, :section, :year, :approved, :ylevel)";
                $r = $this->Connect()->prepare($s);
                $r->execute(array(
                   ':studno' => $this->reg_studno,
                   ':fname' => $this->reg_fname,
                   ':lname' => $this->reg_lname,
                   ':mname' => $this->reg_mname,
                   ':course' => $this->reg_coursid, 
                   ':section' => $this->reg_section, 
                   ':year' => $this->reg_year, 
                   ':approved' => 'false', 
                   ':ylevel' => $this->reg_ylevel
                ));
                echo 'saved';
            }
        }else{
            
            $u = "UPDATE students SET stud_firstname = :fname, stud_lastname = :lname, stud_middlename = :mname,
                stud_course = :course, stud_section = :section, stud_year = :year, stud_ylevel = :ylevel WHERE stud_id = :id";
            $ru = $this->Connect()->prepare($u);
            $ru->execute(array(
                   ':fname' => $this->reg_fname,
                   ':lname' => $this->reg_lname,
                   ':mname' => $this->reg_mname,
                   ':course' => $this->reg_coursid, 
                   ':section' => $this->reg_section, 
                   ':year' => $this->reg_year, 
                   ':ylevel' => $this->reg_ylevel,
                   ':id' => $id
                ));
            echo 'updated';
        }
    }

    //GET SECTIONS
    function GetSection(){
        echo '<option value=""></option>';
        $q = "SELECT * FROM sections WHERE sec_courseid = ?";
        $r = $this->Connect()->prepare($q);
        $r->execute([$this->reg_coursid]);
        while($rr = $r->fetch()){
            $secname = $rr['sec_name'];
            echo '<option value="'.$secname.'">'.$secname.'</option>';
        }
        
    }


    //GENERATE STUDENT NUMBER
   function GenerateStudentNo(){
    
       $q = "SELECT * FROM students";
       $r = $this->Connect()->prepare($q);
       $r->execute();
       $scount = $r->rowCount() + 1;
       
       $yy = date('Y');
       $mm = date('m');
       $dd = date('d');
       
       $studno = $yy."-".$mm.$dd.$scount;
       echo $studno;
   }
    
    
}//End of Class


//POST REQUET===================================================================

$reg = new RegNewStudent();


if(isset($_POST['']) && !empty($_POST[''])){
    
}

if(isset($_POST['']) && !empty($_POST[''])){
    
}

//APPROVED STUDNET
if(isset($_POST['apstud']) && !empty($_POST['apstud'])){
    $id = filter_input(0, 'id');
    $reg->ApprovedStudent($id);
}

//DELETE STUD
if(isset($_POST['dregstud']) && !empty($_POST['dregstud'])){
    $id = filter_input(0, 'id');
    $reg->DeleteStudent($id);
}

//EDIT STUDENT 
if(isset($_POST['editstudent']) && !empty($_POST['editstudent'])){
    $id = filter_input(0, 'id');
    $reg->EditRegStudent($id);
}

if(isset($_POST['gregstudent']) && !empty($_POST['gregstudent'])){
    $reg->GetStudentRegisterTable();
}

//SAVE NEW REG 
if(isset($_POST['snewreg']) && !empty($_POST['snewreg'])){
    
    $id = filter_input(0, 'id');
    $studno = filter_input(0, 'studno');
    $fname = filter_input(0, 'fname');
    $lname = filter_input(0, 'lname');
    $mname = filter_input(0, 'mname');
    $course = filter_input(0, 'course');
    $section = filter_input(0, 'section');
    $year = filter_input(0, 'year');
    $ylevel = filter_input(0, 'yrlevel');
    
    $reg->reg_studno = $studno;
    $reg->reg_fname = $fname;
    $reg->reg_lname = $lname;
    $reg->reg_mname = $mname;
    $reg->reg_coursid = $course;
    $reg->reg_section = $section;
    $reg->reg_year = $year;
    $reg->reg_ylevel = $ylevel;
    $reg->SaveNewRegStudent($id);
    
}

//GET SECTIONS
if(isset($_POST['gsection']) && !empty($_POST['gsection'])){
    $cid = filter_input('0','cid');
    $reg->reg_coursid = $cid;
    $reg->GetSection();
}
//GENERATE STUD NO
if(isset($_POST['gstudno']) && !empty($_POST['gstudno'])){
    $reg->GenerateStudentNo();
}




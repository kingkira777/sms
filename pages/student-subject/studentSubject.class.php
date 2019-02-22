<?php
require_once '../app.class.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of js_studentSubject
 *
 * @author Jessie
 */
class StudentSubject extends App{
    //put your code here
    
    
    
   function GetStudentSubject($studno){
       $sub_arr = array();
       $q = "SELECT * FROM students a
               left join subjects c on a.stud_course = c.sub_courseid
               WHERE a.stud_no = '$studno' GROUP BY c.sub_id";
       $qr = $this->Connect()->prepare($q);
       $qr->execute();
       if($qr->rowCount() > 0){
           while($qrr = $qr->fetchAll()){
               $sub_arr = $qrr;
           } 
           echo json_encode($sub_arr);
       }else{
           echo json_encode($sub_arr);
       }
   }
    
}//End of Class


//=============================POST REQUEST===================================//

$studsub = new StudentSubject();

if(isset($_POST['']) && !empty($_POST[''])){
    
}

if(isset($_POST['']) && !empty($_POST[''])){
    
}

if(isset($_POST['']) && !empty($_POST[''])){
    
}

if(isset($_POST['']) && !empty($_POST[''])){
    
}

//GET STUDENT SUBJECT
if(isset($_POST['gstudsub']) && !empty($_POST['gstudsub'])){
    $studno = filter_input(INPUT_POST, 'studno');
    $studsub->GetStudentSubject($studno);
}


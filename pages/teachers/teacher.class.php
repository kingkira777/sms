<?php
require_once '../user-login/userlogin.class.php';
require_once '../student-schedule/studentSchedule.class.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of teacher
 *
 * @author Jessie
 */
class Teacher extends UserLogin{
    //put your code here
    public $t_id;
    public $t_no;
    public $t_lastname;
    public $t_firstname;
    public $t_middlename;
    public $t_dob;
    public $t_gender;
    public $t_citizenship;
    public $t_contactno;
    public $t_email;
    public $t_address;
    
    
    
    //DELETE TEACHER 
    function DeleteTeacher(){
        $q = "SELECT * FROM teachers WHERE t_id = ?";
        $rq = $this->Connect()->prepare($q);
        $rq->execute([$this->t_id]);
        $tinfo = $rq->fetch();
        $tno = $tinfo['t_no'];
        
        //DELETE USER
        $uq = "DELETE FROM users WHERE user_idno = ?";
        $ruq = $this->Connect()->prepare($uq);
        $ruq->execute([$tno]);
        
        //DELETE TEACHER
        $tq = "DELETE FROM teachers WHERE t_no = ?";
        $tr = $this->Connect()->prepare($tq);
        $tr->execute([$tno]);
        echo "deleted";
    }
    
    //EDIT TEACHER 
    function EditTeacher(){    
        $q = "SELECT * FROM teachers WHERE t_id = '$this->t_id'";
        $r = $this->Connect()->prepare($q);
        $r->execute();
        while($rr = $r->fetchAll()){
            echo json_encode($rr);
        }
    }
    
    
    //GET TEACHER LSIT
    function GetTeacherSelectList(){
        echo '<option value=""><--Select Teacher--></option>';
        $q = "SELECT * FROM teachers";
        $r = $this->Connect()->prepare($q);
        $r->execute();
        if($r->rowCount()>0){
            while($rr = $r->fetch()){
                $tid = $rr['t_no'];
                $tname = $rr['t_lastname']." ".$rr['t_firstname']." ".$rr['t_middlename'];
                echo '<option value="'.$tid.'">'.$tname.'</option> ';
            }
        }
        
    }
    
    //GET LIST OF TEACHER TABLE
    function GetTeacherList(){
        $r_array = array();
        $q = "SELECT * FROM teachers teachers";
        $r = $this->Connect()->prepare($q);
        $r->execute();
        if($r->rowCount()>0){
            while($rr = $r->fetchAll()){
                $r_array = $rr;
            }
            echo json_encode($r_array);
        }else{
            echo json_encode($r_array);
        }
    }
    //SAVE UPDATE TEACHER============================================
    function SaveUpdateTeacher(){
        $chk = "SELECT t_id FROM teachers WHERE t_id = '$this->t_id'";
        $rchk = $this->Connect()->query($chk);
        if($rchk->rowCount() > 0){
            try{
            $update = 'UPDATE teachers SET t_lastname = ?, 
                    t_firstname =?, 
                    t_middlename = ?,
                    t_dob = ?,
                    t_gender =?,
                    t_citizenship =?,
                    t_contactno =?,
                    t_email=?,
                    t_address=?
                    WHERE t_no =?';
            $rupdate = $this->Connect()->prepare($update);
            $rupdate->execute([$this->t_lastname, $this->t_firstname, $this->t_middlename, 
                            $this->t_dob, $this->t_gender, $this->t_citizenship, $this->t_contactno,
                            $this->t_email, $this->t_address, $this->t_no]);
            echo "updated";
            } catch (\PDOException $e){
                echo $e->getMessage();
            }
        }else{
            
            $chk = "SELECT * FROM teachers WHERE t_lastname = ? AND t_firstname = ? AND t_middlename = ?";
            $rchk = $this->Connect()->prepare($chk);
            $rchk->execute([$this->t_lastname, $this->t_firstname, $this->t_middlename]);
            if($rchk->rowCount()>0){
                echo "existed";
            }else{
                try{
                $save = "INSERT INTO teachers(t_no, t_lastname, t_firstname, t_middlename, t_dob, t_gender,"
                        . "t_citizenship, t_contactno, t_email, t_address)"
                        . "VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $rsave = $this->Connect()->prepare($save);
                $rsave->execute([$this->t_no, $this->t_lastname, $this->t_firstname, $this->t_middlename, $this->t_dob,
                $this->t_gender, $this->t_citizenship, $this->t_contactno, $this->t_email, $this->t_address]);

                $this->username = $this->t_no;
                $this->RegisterUserTeacher('teacher');

                echo "saved";
                } catch (\PDOException $e){
                    echo $e->getMessage();
                }
            }
        }
    }
    
    
    //GENRATE TEMP PASSWORD AND ID NO
    function GenerateIDnoAndTempPassowrd(){
        $q = "SELECT t_id FROM teachers";
        $r = $this->Connect()->query($q);
        $r->execute();
        $row = $r->rowCount() + 1;
        $yy = date('Y');
        $dd = date('d');
        $mm = date('m');
        $idno = $dd.$mm.$row;
        echo $idno;
    }
    
    
    
}// END OF CLASSS



//===================POST REQUEST======================================//

$teacher = new Teacher();
$sched = new StudentSchedule();



//GET TEACHER SCHEDULE
if(isset($_POST['gteachersched']) && !empty($_POST['gteachersched'])){
    $tno = filter_input(0, 'tno');
    $sched->GetTeacherSchedule($tno);
}


//GET TEACHER LIST SELECT
if(isset($_POST['gtselect']) && !empty($_POST['gtselect'])){
    $teacher->GetTeacherSelectList();
}


//EDIT TEACHER 
if(isset($_POST['deleteTeacher']) && !empty($_POST['deleteTeacher'])){
    $tid = filter_input(INPUT_POST, 'tid');
    $teacher->t_id= $tid;
    $teacher->DeleteTeacher();
}

//EDIT TEACHER
if(isset($_POST['editteacher']) && !empty($_POST['editteacher'])){
    $tid = filter_input(INPUT_POST, 'tid');
    $teacher->t_id= $tid;
    $teacher->EditTeacher();
}
 
//GET TEACHER LIST editteacher
if(isset($_POST['gtlist']) && !empty($_POST['gtlist'])){
    $teacher->GetTeacherList();
}
 
//GENERATE ID NO and PASSWORD 
if(isset($_POST['gidnopassword']) && !empty($_POST['gidnopassword'])){
    $teacher->GenerateIDnoAndTempPassowrd();
}

//SAVE UPDATE TEACHER NO
if(isset($_POST['savaupdateteacher']) && !empty($_POST['savaupdateteacher'])){
    
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $tno = filter_input(INPUT_POST, 'tno', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lname = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $fname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $mname = filter_input(INPUT_POST, 'mname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $dob = filter_input(INPUT_POST, 'dob', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $citizenship = filter_input(INPUT_POST, 'citizenship', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $contact = filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $teacher->t_id = $id;
    $teacher->t_no = $tno;
    $teacher->password = $password;
    $teacher->t_lastname = $lname;
    $teacher->t_firstname = $fname;
    $teacher->t_middlename = $mname;
    $teacher->t_dob = $dob;
    $teacher->t_gender = $gender;
    $teacher->t_citizenship = $citizenship;
    $teacher->t_contactno = $contact;
    $teacher->t_email = $email;
    $teacher->t_address = $address;
    $teacher->SaveUpdateTeacher();
    
}


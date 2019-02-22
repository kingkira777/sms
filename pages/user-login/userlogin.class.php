<?php
require_once '../app.class.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of userlogin
 *
 * @author Jessie
 */
class UserLogin extends App{
    //put your code here
    public $userid;
    public $username;
    public $password;
    public $privilage;
    
    public $codeno;

  
    
    //REG TEACHER
    function RegisterUserTeacher($priv){
           $q = "INSERT INTO users(user_idno, user_password, user_privilage)
               VALUES(?, ?, ?)";
           $rq = $this->Connect()->prepare($q);
           $rq->execute([$this->username, $this->password, $priv]);
           echo 'saved';
    }


    //REGISTER NEW STUDENT USER
    function RegStudent($arr){
            $c = "SELECT * FROM students WHERE stud_no = ? AND  stud_isregistered = 'true'";
            $r = $this->Connect()->prepare($c);
            $r->execute([$arr[':studno']]);
            if($r->rowCount() > 0){
                echo 'registered';
            }else{
                //Create Account
                $a = "INSERT INTO users(user_idno, user_password, user_privilage)
                    VALUES(?, ?, ?)";
                $ra = $this->Connect()->prepare($a);
                $ra->execute([$arr[':studno'], $arr[':password'],'student']);
                
                //Register Student
                $regstud = "UPDATE students SET stud_dob = :dob, stud_gender = :gender, 
                    stud_citizenship = :citizenship, stud_contactno = :contactno, 
                    stud_email = :email, stud_address = :address, stud_isregistered = :registered,
                    stud_emName = :ename, stud_emContact = :econtact
                    WHERE stud_no = :studno";
                $rRegstud = $this->Connect()->prepare($regstud);
                $rRegstud->execute(array(
                    ':dob' => $arr[':dob'],
                    ':gender' => $arr[':gender'],
                    ':citizenship' => $arr[':citizenship'],
                    ':contactno' => $arr[':contactno'],
                    ':email' => $arr[':email'],
                    ':address' => $arr[':address'],
                    ':address' => $arr[':address'],
                    ':ename' => $arr[':ename'],
                    ':econtact' => $arr[':econtact'],
                    ':registered' => $arr[':registered'],
                    ':studno' => $arr[':studno']
                ));
                
                echo 'saved';
                
            }
    }
    
    
    //CHECK CODE NO
    function CheckStudentNo($studno){
        $q = "SELECT * FROM students WHERE stud_no = ?";
        $r = $this->Connect()->prepare($q);
        $r->execute([$studno]);
        if($r->rowCount() > 0){
            $studinfo = $r->fetch();
            echo json_encode($studinfo);
        }else{
            echo json_encode(NULL);
        }
    }
    
    
    //LOGIN USER
    function LoginUser(){
            if($this->username !== 'admin'){
                
                
                $c = "SELECT * FROM students WHERE stud_no = ? AND stud_approved = ?";
                $rc= $this->Connect()->prepare($c);
                $rc->execute([$this->username, 'true']);
                if($rc->rowCount() > 0){
                    
                    $a = "SELECT * FROM students WHERE stud_no = ? AND stud_approved = ? AND stud_active = ?";
                    $ra= $this->Connect()->prepare($a);
                    $ra->execute([$this->username, 'true', 'true']);
                    if($ra->rowCount() >0 ){
                        echo 'notactive';
                    }else{
                        
                        $sql = "SELECT * FROM users WHERE user_idno = ? AND user_password = ?";
                        $result = $this->Connect()->prepare($sql);
                        $result->execute([$this->username, $this->password]);
                        if($result->rowCount() != 0){
                            session_start();
                            $row = $result->fetch();
                            $userid = $row['user_id'];
                            $userno = $row['user_idno'];
                            $userpriv = $row['user_privilage'];
                            $_SESSION['userid'] = $userid;
                            $_SESSION['userno'] = $userno;
                            $_SESSION['userpriv'] = $userpriv;
                            echo "success";
                        }else{ 
                            echo "failed";
                        }
                    }
            }else{
                
                $c = "SELECT * FROM students WHERE stud_no = ? AND stud_approved = ?";
                $rc= $this->Connect()->prepare($c);
                $rc->execute([$this->username, 'false']);
                if($rc->rowCount()>0){
                    echo 'notapproved';
                }else{
                    
                   
                    
                    //TEACHER
                        $sql = "SELECT * FROM users WHERE user_idno = ? AND user_password = ?";
                        $result = $this->Connect()->prepare($sql);
                        $result->execute([$this->username, $this->password]);
                        if($result->rowCount() != 0){
                            session_start();
                            $row = $result->fetch();
                            $userid = $row['user_id'];
                            $userno = $row['user_idno'];
                            $userpriv = $row['user_privilage'];
                            $_SESSION['userid'] = $userid;
                            $_SESSION['userno'] = $userno;
                            $_SESSION['userpriv'] = $userpriv;
                            echo "success";
                        }else{ 
                            echo "failed";
                        }
                    
                }
                
            }
            
         }else{
             
             $c = "SELECT * FROM students WHERE stud_no = ? AND stud_approved = ?";
                $rc= $this->Connect()->prepare($c);
                $rc->execute([$this->username, 'false']);
                if($rc->rowCount() > 0){
                    echo 'notapproved';
                }else{
                    $sql = "SELECT * FROM users WHERE user_idno = ? AND user_password = ?";
                    $result = $this->Connect()->prepare($sql);
                    $result->execute([$this->username, $this->password]);
                    if($result->rowCount() != 0){
                        session_start();
                        $row = $result->fetch();
                        $userid = $row['user_id'];
                        $userno = $row['user_idno'];
                        $userpriv = $row['user_privilage'];
                        $_SESSION['userid'] = $userid;
                        $_SESSION['userno'] = $userno;
                        $_SESSION['userpriv'] = $userpriv;
                        echo "success";
                    }else{ 
                        echo "failed";
                    }
                    
                }
                
         }
            
       
    }
    
}// END OF CLASS

//==============================POST REQUES===================================//

$login = new UserLogin();

if(isset($_POST['']) && !empty($_POST[''])){
    
}

if(isset($_POST['']) && !empty($_POST[''])){
    
}

if(isset($_POST['']) && !empty($_POST[''])){
    
}

if(isset($_POST['']) && !empty($_POST[''])){
    
}

//REGISTER NEW STUDENT
if(isset($_POST['regnewstud']) && !empty($_POST['regnewstud'])){
    
    $password = filter_input(INPUT_POST, 'password');
    $studno = filter_input(INPUT_POST, 'studno');
    $dob = filter_input(INPUT_POST, 'dob');
    $gender = filter_input(INPUT_POST, 'gender');
    $citizenship = filter_input(INPUT_POST, 'citizenship');
    $contactno = filter_input(INPUT_POST, 'contactno');
    $email = filter_input(INPUT_POST, 'email');
    $address = filter_input(INPUT_POST, 'address');
    $emName = filter_input(INPUT_POST, 'emName');
    $emContact = filter_input(INPUT_POST, 'emContact');
    
    $regStud = array(
        ':password' => $password,
        ':studno' => $studno,
        ':dob' => $dob,
        ':gender' => $gender,
        ':citizenship' => $citizenship,
        ':contactno' => $contactno,
        ':email' => $email,
        ':address' => $address,
        ':ename' => $emName,
        ':econtact' => $emContact,
        ':registered' => 'true'
    );
    
    $login->RegStudent($regStud);
    
    
}

//Check Codeno
if(isset($_POST['chckstudno']) && !empty($_POST['chckstudno'])){
    $studno = filter_input(INPUT_POST, 'studno', FILTER_SANITIZE_SPECIAL_CHARS);
    $login->CheckStudentNo($studno);
}

//LOGIN USER
if(isset($_POST['loginuser']) && !empty($_POST['loginuser'])){
    $userid = filter_input(INPUT_POST, 'userid', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
    $login->username = $userid;
    $login->password = $password;
    $login->LoginUser();
}


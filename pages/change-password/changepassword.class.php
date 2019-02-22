<?php
require_once '../app.class.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of changepassword
 *
 * @author Jessie
 */
class ChangePassword extends App{
    //put your code here
    
        
    
    
    function ChangeUserPassword($userid ,$currpass, $newpass){
        
        $chkpass = "SELECT * FROM users WHERE user_idno = ? AND  user_password = ?";
        $rchkpasss = $this->Connect()->prepare($chkpass);
        $rchkpasss->execute([$userid, $currpass]);
        if($rchkpasss->rowCount()>0){
            $u = "UPDATE users SET user_password = ? WHERE user_idno = ?";
            $ru = $this->Connect()->prepare($u);
            $ru->execute([$newpass, $userid]);
            echo "updated";
        }else{
            echo "notfound";
        }
        
    }
    
}//End of Class

//s============================POST REQUEsT=========================


$cpass = new ChangePassword();

if(isset($_POST['']) && !empty($_POST[''])){
    
}

if(isset($_POST['']) && !empty($_POST[''])){
    
}

if(isset($_POST['']) && !empty($_POST[''])){
    
}

if(isset($_POST['changpass']) && !empty($_POST['changpass'])){
    
    $userid = filter_input(INPUT_POST,'userid',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $currpass = filter_input(INPUT_POST,'currpass',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $newpass = filter_input(INPUT_POST,'newpass',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $cpass->ChangeUserPassword($userid, $currpass, $newpass);
    
}

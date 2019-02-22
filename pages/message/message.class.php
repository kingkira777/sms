<?php
require_once '../app.class.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of message
 *
 * @author Jessie
 */
class Message extends App {
    //put your code here
    
    
   
    
    
    //GET NOTIFICATIONS
    function GetNotifications($userno){
        $n = "SELECT * FROM messages WHERE m_sendto = ? AND m_isread != ?";
        $rn = $this->Connect()->prepare($n);
        $rn->execute([$userno, 'true']);
        $rows = $rn->rowCount();
        echo $rows;
    }


    //DELETE MESSAGES
    function DeleteMessage($mid){
        
        //DELETE MESSAGE
        $d = "DELETE FROM messages WHERE m_id = ?";
        $rd = $this->Connect()->prepare($d);
        $rd->execute([$mid]);
        
        
        //DELETE SUB MESSAGES
        $s = "DELETE FROM `_messages` WHERE mm_mid = ?";
        $rs = $this->Connect()->prepare($s);
        $rs->execute([$mid]);
        
        echo "deleted";
        
    }

    //GET MY SENT ITEMS
    function GetSentItems($name){
        
        $q = "SELECT * FROM messages a left join students b on a.m_sendto = b.stud_no WHERE a.m_from = '$name'";
        $rq = $this->Connect()->prepare($q);
        $rq->execute();
        if($rq->rowCount()>0){
            while($rr = $rq->fetch()){
                $id = $rr['m_id'];
                $nname =$rr['stud_lastname']." ".$rr['stud_firstname']." ".$rr['stud_middlename'];
                if($rr['stud_lastname'] === Null){
                }else{
                     echo '<li><a onclick="DeleteMessage('.$id.');" style="z-index:555;" class="pull-right"><i class="fa fa-times"></i></a> <a onclick="viewMessage('.$id.')"><i class="fa fa-envelope"></i> '.$nname.'</a> <a onclick="#"><i class="fa fa-trash"></i></a>  </li>';
                }
               
            }
        }
        
        $qq = "SELECT * FROM messages a left join teachers b on a.m_sendto = b.t_no WHERE a.m_from = '$name'";
        $qrq = $this->Connect()->prepare($qq);
        $qrq->execute();
        if($qrq->rowCount()>0){
            while($rrq = $qrq->fetch()){
                $id = $rrq['m_id'];
                $nname =$rrq['t_lastname']." ".$rrq['t_firstname']." ".$rrq['t_middlename'];
                if($rrq['t_lastname'] === Null){
                    
                }else{
                echo '<li><a onclick="DeleteMessage('.$id.');" style="z-index:555;" class="pull-right"><i class="fa fa-times"></i></a> <a onclick="viewMessage('.$id.')"><i class="fa fa-envelope"></i> '.$nname.'</a> </li>';
                }
            }
        }
           
            //ADMin
            $a = "SELECT * FROM messages WHERE m_from = '$name'";
            $ra = $this->Connect()->prepare($a);
            $ra->execute();
            if($ra->rowCount()>0){
                while($rar = $ra->fetch()){
                    $id = $rar['m_id'];
                    if($name == 'Admin'){
                        echo '';
                    }else{
                        echo '<li><a onclick="DeleteMessage('.$id.');" style="z-index:555;" class="pull-right"><i class="fa fa-times"></i></a>  <a onclick="viewMessage('.$id.')"><i class="fa fa-envelope"></i> '.$name.'</a> </li>';
                    }
                }
            }
        
        
    }
    
    //REPLY MESSAGE
    function ReplyMessage($id,$name,$message,$userno){
        $v = "UPDATE messages SET m_isread = ? WHERE m_sendto = ?";
        $rv = $this->Connect()->prepare($v);
        $rv->execute(['true', $userno]);
        
        $q = "INSERT INTO `_messages` (mm_mid, mm_name, mm_message, mm_datetime) VALUES(?,?,?,?)";
        $rq = $this->Connect()->prepare($q);
        $rq->execute([$id,$name,$message, date('Y-m-d h:i:s a')]);
        echo "send";
    }
    
     //VIEW MESSAGE
    function ViewMessage($userno,$id){

        $m = "SELECT * FROM `_messages` WHERE mm_mid ='$id'";
        $rm = $this->Connect()->prepare($m);
        $rm->execute();
        if($rm->rowCount()>0){
            while($rrm = $rm->fetch()){
                $mname =$rrm['mm_name'];
                $mmessage = $rrm['mm_message'];
                $mdatetime = $rrm['mm_datetime'];
                echo'
                    <div class="item">
                        <img src="assets/img/logo/user01.png" alt="user image" class="online"/>
                        <p class="message">
                        <a href="#" class="name">
                            <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> '.$mdatetime.'</small>
                            NAME: 
                            '.$mname.'
                        </a>
                        '.$mmessage.'
                        </p>
                   </div>
                    ';
            }
        }
        
    }
    
   
    //GET MY MESSAGE =====================================//====================
    function GetMyMessage($meid){
        
        $q = "SELECT * FROM messages a left join students b on a.m_sendto = b.stud_no WHERE b.stud_no = '$meid' ORDER BY a.m_id DESC LIMIT 10";
        $r = $this->Connect()->prepare($q);
        $r->execute();
        if($r->rowCount()>0){
            while($rr = $r->fetch()){
                 $mid = $rr['m_id'];
                 $userno = $rr['m_sendto'];
                 $xname = $rr['m_from'];
                 echo '<li> <a onclick="DeleteMessage('.$mid.');" style="z-index:555;" class="pull-right"><i class="fa fa-times"></i></a>  <a onclick="viewMessage('.$mid.')"><i class="fa fa-envelope"></i> '.$xname.'</a></li>';
            }
        }
        
        $qq = "SELECT * FROM messages a left join teachers b on a.m_sendto = b.t_no WHERE b.t_no = '$meid' ORDER BY a.m_id DESC LIMIT 10";
        $rrr = $this->Connect()->prepare($qq);
        $rrr->execute();
        if($rrr->rowCount()>0){
            while($rrq = $rrr->fetch()){
                 $mid = $rrq['m_id'];
                 $userno = $rrq['m_sendto'];
                 $name = $rrq['m_from'];
                 echo '<li> <a onclick="DeleteMessage('.$mid.');" style="z-index:555;" class="pull-right"><i class="fa fa-times"></i></a> <a onclick="viewMessage('.$mid.')"><i class="fa fa-envelope"></i> '.$name.'</a></li>';
                
            }
        }
        
        if($meid === "admin"){
        
        //SELECT ADMIN
        $qr = "SELECT * FROM messages WHERE m_sendto = '$meid'";
        $rqr = $this->Connect()->prepare($qr);
        $rqr->execute();
        if($rqr->rowCount()>0){
            while($rqrr = $rqr->fetch()){
                 $mid = $rqrr['m_id'];
                 $userno = $rqrr['m_sendto'];
                 $name = $rqrr['m_from'];
                echo '<li> <a onclick="DeleteMessage('.$mid.');" style="z-index:555;" class="pull-right"><i class="fa fa-times"></i></a> <a onclick="viewMessage('.$mid.')"><i class="fa fa-envelope"></i> '.$name.'</a></li>';
                
            }
        }
       }
        
        
    }
       
    
    //SEND MESSAGE
    function SendMessage($from, $to , $message){
        try {
            
            $chk = "SELECT * FROM messages WHERE m_from = ? AND m_sendto = ?";
            $rchk =  $this->Connect()->prepare($chk);
            $rchk->execute([$from, $to]);
            if($rchk->rowCount()>0){
                $minfo = $rchk->fetch();
                $lastid = $minfo['m_id'];
                
            }else{
            $q = "INSERT INTO messages(m_from, m_sendto, m_message, m_date) VALUES(?, ?, ?, ?)";
            $r = $this->Connect()->prepare($q);
            $r->execute([$from, $to,$message,date('Y-m-d h:i:s a')]);
            $lastid = $this->Connect()->lastInsertId();
            
            $c = "SELECT m_id FROM messages ORDER BY m_id DESC";
            $rc = $this->Connect()->prepare($c);
            $rc->execute();
            $lastid =  $rc->fetchColumn();
            }
            
            $qq = "INSERT INTO `_messages` (mm_mid, mm_name, mm_message, mm_datetime) VALUES(?,?,?,?)";
            $rr = $this->Connect()->prepare($qq);
            $rr->execute([$lastid,$from,$message,date('Y-m-d h:i:s a')]);
            
            echo "send";
            
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    
    //GET ALL USERS
    function GetAllUsers($me){
        $q = "SELECT * FROM users a left join students b on a.user_idno = b.stud_no WHERE a.user_idno = b.stud_no AND a.user_idno != '$me'";
        $r = $this->Connect()->prepare($q);
        $r->execute();
        if($r->rowCount()>0){
            while($rr = $r->fetch()){
               $studno = $rr['stud_no'];
               $sname = $rr['stud_lastname']." ".$rr['stud_firstname']." ".$rr['stud_middlename'];
               
               echo '<option value="'.$studno.'">'.$sname.'</option>';
            }
        }
        
        $qq = "SELECT * FROM users a left join teachers b on a.user_idno = b.t_no WHERE a.user_idno = b.t_no AND a.user_idno != '$me'";
        $rr = $this->Connect()->prepare($qq);
        $rr->execute();
        if($rr->rowCount()>0){
            while($rrr = $rr->fetch()){
               $tno = $rrr['t_no'];
               $tname = $rrr['t_lastname']." ".$rrr['t_firstname']." ".$rrr['t_middlename'];
               echo '<option value="'.$tno.'">'.$tname.'</option>';
            }
        }
        //SELECT ADMIN
        if($me == 'admin'){
            
        }else{
            $qr = "SELECT * FROM users WHERE user_idno = 'admin'";
            $rqr = $this->Connect()->prepare($qr);
            $rqr->execute();
            if($rqr->rowCount()>0){
                while($rqrr = $rqr->fetch()){
                    $adname = $rqrr['user_idno'];
                    if(is_numeric($adname)){}else{
                    echo '<option value="'.$adname.'">'.$adname.'</option>';
                    }
                }
            }
        }
    }
    
}//End of Class


//===================================POST====================================//

$message = new Message();


if(isset($_POST['']) && !empty($_POST[''])){
    
}

if(isset($_POST['']) && !empty($_POST[''])){
    
}

//GET NOTIFICATIONS
if(isset($_POST['mnots']) && !empty($_POST['mnots'])){
    $userno  = filter_input(INPUT_POST, 'userno');
    $message->GetNotifications($userno);
}

//DELETE MESSAGE
if(isset($_POST['dmessage']) && !empty($_POST['dmessage'])){
    $mid = filter_input(INPUT_POST, 'mid', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $message->DeleteMessage($mid);
}

//GET SENT ITEMS 
if(isset($_POST['gsentitems']) && !empty($_POST['gsentitems'])){
    
    $name = filter_input(INPUT_POST, 'name');
    $userno = filter_input(INPUT_POST, 'userno');
    
    $message->GetSentItems($name,$userno);
}

//REPLY MESSAGE
if(isset($_POST['rpmessage']) && !empty($_POST['rpmessage'])){
    $id = filter_input(INPUT_POST, 'id');
    $userno = filter_input(INPUT_POST, 'userno');
    $me = filter_input(INPUT_POST, 'me');
    $xmessage = filter_input(INPUT_POST, 'message');

    $message->ReplyMessage($id, $me, $xmessage,$userno);
}

if(isset($_POST['vmessage']) && !empty($_POST['vmessage'])){
   $userno = filter_input(INPUT_POST, 'userno');
   $id = filter_input(INPUT_POST, 'id');
   $message->ViewMessage($userno, $id);
}

//GET MY MESSAGE 
if(isset($_POST['gmessage']) && !empty($_POST['gmessage'])){
    $myid = filter_input(INPUT_POST, 'myid');
    $message->GetMyMessage($myid);
}

//SEND MESSAGE
if(isset($_POST['smessage']) && !empty($_POST['smessage'])){
    $from = filter_input(INPUT_POST, 'from');
    $to = filter_input(INPUT_POST, 'to');
    $xmessage = filter_input(INPUT_POST, 'message');
    $message->SendMessage($from, $to, $xmessage);
}

//GET ALL CONTACTS
if(isset($_POST['greciepent']) && !empty($_POST['greciepent'])){
    $me = filter_input(INPUT_POST, 'me');
    $message->GetAllUsers($me);
}

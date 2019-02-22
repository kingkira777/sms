<?php
require_once '../app.class.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of announcement
 *
 * @author Jessie
 */
class Announcement extends App{
    //put your code here
    
    public $an_id;
    public $an_userid;
    public $an_title;
    public $an_content;
    public $an_date;
    
    
    
    //Delete Announcemnet
    function DeleteAnnouncement(){
        $d = "DELETE FROM announcement WHERE an_id = '$this->an_id'";
        $rd = $this->Connect()->prepare($d);
        $rd->execute();
        echo "deleted";
    }
    
    //Get Announcement List
    function GetAnnouncementList($priv){
        
        $q = "SELECT * FROM announcement a 
            left join users b on a.an_userid = b.user_idno 
            left join teachers c on b.user_idno = c.t_no";
        $rq = $this->Connect()->prepare($q);
        $rq->execute();
        while($rrq = $rq->fetch()){
            
            
            $content = strip_tags($rrq['an_content']);          
            $userpriv = $rrq['user_privilage'];
            
            if($userpriv === "admin"){
                 $name = "Admin";
                 $box = "box-warning";
            }else{
                 $name = $rrq['t_firstname']." ".$rrq['t_lastname']." ".$rrq['t_middlename'];
                 $box = "box-success";
            }
            
            if($priv === "admin"){
               
                $btn = '<button type="button" class="btn btn-danger btn-sm" onclick="deleteAnnouncement('.$rrq['an_id'].')">
                                <i class="fa fa-times"></i>
                        </button>
                        <button type="button" class="btn btn-primary btn-sm" onclick="EditAnnouncement('.$rrq['an_id'].')">
                                <i class="fa fa-edit"></i>
                        </button>
                        ';
            }else if($priv === "teacher"){
                $btn = '';
            }else{
                $btn = '';
            }
            echo '
                <div class="box '.$box.'">
                    <div class="box-header">
                        <h4 class="box-title">'.$rrq['an_title'].' <br />
                            <small>User: <strong>'.$rrq['user_privilage'].'</strong> Name: <strong>'.$name.'</strong> Date & Time: '.$rrq['an_date'].' </small>
                        </h4>
                        
                        <div class="box-tools pull-right">
                            '.$btn.'
                        </div>
                    </div>
                    <div class="box-body">
                       '.$content.'             
                    </div>
                </div>

            ';
        }
    }
    
    
    function EditAnnouncement(){
        $edit = "SELECT * FROM announcement WHERE an_id = ?";
        $redit = $this->Connect()->prepare($edit);
        $redit->execute([$this->an_id]);
        $aninfo = $redit->fetch();
        echo json_encode($aninfo);
    }

    //Save Update Announcement
    function SaveUpdateAnnouncement(){
        
        if(empty($this->an_id)){
            $c = "SELECT * FROM announcement WHERE an_title = '$this->an_title'";
            $rc = $this->Connect()->prepare($c);
            $rc->execute();
            if($rc->rowCount()>0){
                echo "existed";
            }else{
                
                try {
                    $s = "INSERT INTO announcement(an_userid, an_title, an_content, an_date) VALUES(?, ?, ?, ?)";
                    $rs = $this->Connect()->prepare($s);
                    $rs->execute([$this->an_userid, $this->an_title, $this->an_content, $this->an_date]);
                    echo "saved";
                } catch (\PDOException $ex) {
                    echo $ex->getMessage();
                }
                
            }
        }else{
            try {
                $u = "UPDATE announcement SET an_title=?, an_content=? WHERE an_id=?";
                $ru= $this->Connect()->prepare($u);
                $ru->execute([$this->an_title, $this->an_content, $this->an_id]);
                echo "updated";
            } catch (\PDOException $ex) {
                echo $ex->getMessage();
            }
        }
        
    }
    
}//End of Class



//===================================POST REQUEST============================//

$an = new Announcement();

if(isset($_POST['']) && !empty($_POST[''])){
    
}

if(isset($_POST['']) && !empty($_POST[''])){
    
}


if(isset($_POST['']) && !empty($_POST[''])){
    
}

//EDIT ANNOUCEMNT
if(isset($_POST['editan']) && !empty($_POST['editan'])){
    $anid = filter_input(INPUT_POST,'anid',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $an->an_id = $anid;
    $an->EditAnnouncement();
}

//DELETE ANNOUNCEMENT
if(isset($_POST['dannounce']) && !empty($_POST['dannounce'])){
    $anid = filter_input(INPUT_POST,'anid',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $an->an_id = $anid;
    $an->DeleteAnnouncement();
}

//GET ANNOUNCEMENT LIST
if(isset($_POST['gan']) && !empty($_POST['gan'])){
    $priv = filter_input(INPUT_POST, 'priv', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $an->GetAnnouncementList($priv);
}

//SAVE UPDATE ANNOUNCEMENT
if(isset($_POST['suannouncement']) && !empty($_POST['suannouncement'])){
    
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $userid = filter_input(INPUT_POST, 'userid', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
   $date = date('m/d/Y h:i:s a', time());
    
    $an->an_id = $id;
    $an->an_userid = $userid;
    $an->an_title = $title;
    $an->an_content = $content;
    $an->an_date = $date;
    $an->SaveUpdateAnnouncement();
    
}

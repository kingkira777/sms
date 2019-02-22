<?php
require '../app.class.php';
require_once '../teachers/teacher.class.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of schedule
 *
 * @author Jessie
 */
class Schedule extends App{
    //put your code here
    public $sched_id;
    public $sched_course;
    public $sched_subject;
    public $sched_day;
    public $sched_timef;
    public $sched_timet;
    public $sched_section;
    public $sched_room;
    public $sched_teacher;
    
    
   

    //DELETE SCHEDULE
    function  DeleteSchedule(){
        $d = "DELETE FROM schedule WHERE sched_id='$this->sched_id'";
        $r = $this->Connect()->prepare($d);
        $r->execute();
        echo "deleted";
    }

    //EDIT SCHEDULE
    function EditSchedule(){
        
        $q = "SELECT * FROM schedule WHERE sched_id = ?";
        $r = $this->Connect()->prepare($q);
        $r->execute([$this->sched_id]);
        $schedInfo = $r->fetch();
        echo json_encode($schedInfo);
        
    }
    
    
    //GET SCHEDULE TABLE LIST
    function GetScheduleTableList($tno){
        $sched_arr = array();
        if($tno === ''){
        $q = "SELECT * FROM schedule a left join courses b on a.sched_course = b.c_id 
		left join subjects c on  a.sched_subject = c.sub_code 
		left join sections d on a.sched_section = d.sec_id 
		left join teachers e on a.sched_teacher = e.t_no 
		GROUP BY a.sched_id";
        $r = $this->Connect()->prepare($q);
        $r->execute();
        }else{
        $q = "SELECT * FROM schedule a left join courses b on a.sched_course = b.c_id 
		left join subjects c on  a.sched_subject = c.sub_code 
		left join sections d on a.sched_section = d.sec_id 
		left join teachers e on a.sched_teacher = e.t_no WHERE e.t_no = '$tno'
		GROUP BY a.sched_id";
        $r = $this->Connect()->prepare($q);
        $r->execute();
        }
        
        if($r->rowCount()>0){
            while($rr = $r->fetchAll()){
                $sched_arr = $rr;
            }
            echo json_encode($sched_arr);
        }else{
            echo json_encode($sched_arr);
        }
        
    }
    
    //SAVE UPDATE SCHEDULE
    function SaveUpdateSched(){
        if(empty($this->sched_id)){
            try {
                
                $chk1 = "SELECT * FROM schedule WHERE sched_day = ? AND sched_room = ?  AND sched_teacher = ? 
		AND sched_timef = ? AND sched_timet = ?";
		$rchk1 = $this->Connect()->prepare($chk1);
		$rchk1->execute([$this->sched_day, $this->sched_room, $this->sched_teacher, $this->sched_timef, $this->sched_timet]);
		if($rchk1->rowCount()>0){
                    echo "existed";
		}else{
                    $chk2 = "SELECT * FROM schedule WHERE sched_day = ? AND sched_timef = ? AND sched_timet = ? AND sched_teacher = ?";
                    $rchk2 = $this->Connect()->prepare($chk2);
                    $rchk2->execute([$this->sched_day, $this->sched_timef, $this->sched_timet, $this->sched_teacher]);
                    if($rchk2->rowCount()>0){
                        echo 'samedaytime';
                    }else{
                        $chkr = "SELECT * FROM schedule WHERE sched_room = ? AND sched_timef = ? AND sched_timet = ?";
			$rchk = $this->Connect()->prepare($chkr);
			$rchk->execute([$this->sched_room, $this->sched_timef, $this->sched_timet]);
			if($rchk->rowCount()>0){
                            echo "sameroomtime";
			}else{
                            
                            //CHECK IF SUBJECT IS ALREADY SCHEDULE FOR THIS TEACHER
                            $chkteach = "SELECT * FROM schedule WHERE sched_teacher = ? AND sched_subject = ?";
                            $rchkteach = $this->Connect()->prepare($chkteach);
                            $rchkteach->execute([$this->sched_teacher, $this->sched_subject]);
                            if($rchkteach->rowCount() > 0 ){
                                echo 'schedteach';
                            }else{
                                if($this->CheckTimeConflick($this->sched_timef, $this->sched_timet) === 'timec'){
                                    echo 'conflict';
                                }else{
                                    if($this->check_room_and_time($this->sched_timef, $this->sched_timet) === 'timec'){
                                        echo 'conflict';
                                    }else{
                                        if($this->check_day_time($this->sched_timef, $this->sched_timet) === 'timec'){
                                            echo 'conflict';
                                        }else{
                                            $s = "INSERT INTO schedule(sched_course, sched_subject, sched_day, sched_timef, sched_timet, sched_section, sched_room, sched_teacher)
                                            VALUES(?, ?, ?, ? ,? , ?, ?, ?)";
                                            $r = $this->Connect()->prepare($s);
                                            $r->execute([$this->sched_course, $this->sched_subject, $this->sched_day, $this->sched_timef, $this->sched_timet, $this->sched_section, $this->sched_room, $this->sched_teacher]);
                                            echo "saved";
                                        }
                                    }
                                }
                            }
                         }
                    }
		}          
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
        }else{
            try {
                if($this->CheckTimeConflick($this->sched_timef, $this->sched_timet)){
                    echo 'conflict';
                }else{
                    if($this->check_room_and_time($this->sched_timef, $this->sched_timet) === 'timec'){
                        echo 'conflict';
                    }else{
                        if($this->check_day_time($this->sched_timef, $this->sched_timet) === 'timec'){
                            echo 'conflict';
                        }else{
                            $u = "UPDATE schedule SET sched_course=?, sched_subject=?, sched_day=?, sched_timef=?, sched_timet=?, sched_section=?, sched_room=?, sched_teacher=? WHERE sched_id=?";
                            $ru = $this->Connect()->prepare($u);
                            $ru->execute([$this->sched_course, $this->sched_subject, $this->sched_day, $this->sched_timef, $this->sched_timet, $this->sched_section, $this->sched_room, $this->sched_teacher, $this->sched_id]);
                            echo "updated";
                        }
                    }
                }
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
        }
        
    }
    
    
    
    function check_day_time($timef,$timet){
        
        $u_timeF = explode(':', $timef)[0];
        $u_timeT = explode(':', $timet)[0];
        
        $u_timeF1 = explode(':', $timef)[1];
        $u_timeT1 = explode(':', $timet)[1];
        
        $qq = "SELECT * FROM schedule WHERE sched_day = ? AND sched_room != ?";
        $rr = $this->Connect()->prepare($qq);
        $rr->execute([$this->sched_day, $this->sched_room]);
        if($rr->rowCount()>0){
            while($time = $rr->fetch()){
                $timeFrom = $time['sched_timef'];
                $timeTo = $time['sched_timet'];
                
                $timeFrom1 = explode(':', $timeFrom)[1];
                $timeTo1 = explode(':', $timeTo)[1];

                
                $timeFrom = explode(':', $timeFrom)[0];
                $timeTo = explode(':', $timeTo)[0];
                
                
                if($u_timeF >= $timeFrom && $u_timeT <= $timeTo){
                    return 'timec';
                }
                if($u_timeF < $timeFrom && $u_timeT < $timeTo && $u_timeT > $timeFrom){
                    if($u_timeT1 > $timeFrom1){
                        return 'timec';
                    }
                }
                if($u_timeF > $timeFrom && $u_timeF < $timeTo && $u_timeT > $timeTo){
                    return 'timec';
                }
                if($u_timeF <= $timeFrom && $u_timeT >= $timeTo){
                    return 'timec';
                }
            }
        }else{
            return 'true';
        }
        
    }
    //ROOM AND TIME 
    function check_room_and_time($timef,$timet){
        
        $u_timeF = explode(':', $timef)[0];
        $u_timeT = explode(':', $timet)[0];
        
        $u_timeF1 = explode(':', $timef)[1];
        $u_timeT1 = explode(':', $timet)[1];
        
        $qq = "SELECT * FROM schedule WHERE sched_room = ? AND  sched_day != ?";
        $rr = $this->Connect()->prepare($qq);
        $rr->execute([$this->sched_room, $this->sched_day]);
        if($rr->rowCount()>0){
            while($time = $rr->fetch()){
                $timeFrom = $time['sched_timef'];
                $timeTo = $time['sched_timet'];
                
                $timeFrom1 = explode(':', $timeFrom)[1];
                $timeTo1 = explode(':', $timeTo)[1];
                
                $timeFrom = explode(':', $timeFrom)[0];
                $timeTo = explode(':', $timeTo)[0];
                
                
                if($u_timeF >= $timeFrom && $u_timeT <= $timeTo){
                    return 'timec';
                }
                if($u_timeF < $timeFrom && $u_timeT < $timeTo && $u_timeT > $timeFrom){
                    if($u_timeT1 > $timeFrom1){
                        return 'timec';
                    }
                }
                if($u_timeF > $timeFrom && $u_timeF < $timeTo && $u_timeT > $timeTo){
                    return 'timec';
                }
                if($u_timeF <= $timeFrom && $u_timeT >= $timeTo){
                    return 'timec';
                }
            }
        }else{
            return 'true';
        }
        
    }




    //CHECK FOR TIME CONFLICT
    function CheckTimeConflick($timeF, $timeT){
        
       
        $u_timeF = explode(':', $timeF)[0];
        $u_timeT = explode(':', $timeT)[0];
        
        $u_timeF1 = explode(':', $timeF)[1];
        $u_timeT1 = explode(':', $timeT)[1];
        
        $qq = "SELECT * FROM schedule WHERE sched_day = ? AND sched_room = ?";
        $rr = $this->Connect()->prepare($qq);
        $rr->execute([$this->sched_day, $this->sched_room]);
        if($rr->rowCount()>0){
            while($time = $rr->fetch()){
                $timeFrom = $time['sched_timef'];
                $timeTo = $time['sched_timet'];
                
                
                $timeFrom1 = explode(':', $timeFrom)[1];
                $timeTo1 = explode(':', $timeTo)[1];
                
                $timeFrom = explode(':', $timeFrom)[0];
                $timeTo = explode(':', $timeTo)[0];
                
                if($u_timeT1 > $timeFrom1){
                        return 'timec';
                }
                
                if($u_timeF >= $timeFrom && $u_timeT <= $timeTo){
                    return 'timec';
                }
                if($u_timeF < $timeFrom && $u_timeT < $timeTo && $u_timeT > $timeFrom){
                    return 'timec';
                }
                if($u_timeF > $timeFrom && $u_timeF < $timeTo && $u_timeT > $timeTo){
                    return 'timec';
                }
                if($u_timeF <= $timeFrom && $u_timeT >= $timeTo){
                    return 'timec';
                }
            }
        }else{
            return 'true';
        }
    
    }
    
    
}//END OF CLASS =================================================//


//========================POST REQUEST========================================//

$sched = new Schedule();
$teacher = new Teacher();

if(isset($_POST['']) && !empty($_POST[''])){
    
}

if(isset($_POST['']) && !empty($_POST[''])){
    
}


//GET TEACHER SCHED
if(isset($_POST['gteacherschedsss']) && !empty($_POST['gteacherschedsss'])){
    $tno = filter_input(0, 'tnumber');
    $sched->GetScheduleTableList($tno);
}

//GET TEACHER LIST
if(isset($_POST['gteacherlist']) && !empty($_POST['gteacherlist'])){
    $teacher->GetTeacherSelectList();
}

//EDIT SCHED
if(isset($_POST['editsched']) && !empty($_POST['editsched'])){
    $schedid = filter_input(INPUT_POST, 'schedid');
    $sched->sched_id = $schedid;
    $sched->EditSchedule();
}


//DELETE SCHEDULE
if(isset($_POST['dsched']) && !empty($_POST['dsched'])){
    
    $schedid = filter_input(INPUT_POST, 'schedid');
    $sched->sched_id = $schedid;
    $sched->DeleteSchedule();

}

//GET SCHEDULE TABLE LIST
if(isset($_POST['gschedtable']) && !empty($_POST['gschedtable'])){
    $sched->GetScheduleTableList('');
}

//SAVE UPDATE SCHEDULE
if(isset($_POST['susched']) && !empty($_POST['susched'])){
    
    $schedid = filter_input(INPUT_POST, 'schedid', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $course = filter_input(INPUT_POST, 'course', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $day = filter_input(INPUT_POST, 'day', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $timef = filter_input(INPUT_POST, 'timef', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $timet = filter_input(INPUT_POST, 'timet', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $section = filter_input(INPUT_POST, 'section', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $room = filter_input(INPUT_POST, 'room', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $teacher = filter_input(INPUT_POST, 'teacher', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    
    $sched->sched_id = $schedid;
    $sched->sched_course = $course;
    $sched->sched_subject = $subject;
    $sched->sched_day = $day;
    $sched->sched_timef = $timef;
    $sched->sched_timet = $timet;
    $sched->sched_section= $section;
    $sched->sched_room = $room;
    $sched->sched_teacher = $teacher;
    $sched->SaveUpdateSched();
    
}
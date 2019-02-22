<?php
require_once '../app.class.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of studentSchedule
 *
 * @author Jessie
 */
class StudentSchedule extends App{
    //put your code here
    
    
    
    
    //GET TEACHER SCHEDULE
    function GetTeacherSchedule($tno){
        $t_arr = array();
        $q = "SELECT  * FROM schedule a
                left join courses b on a.sched_course = b.c_id 
                left join students c on a.sched_course = c.stud_course
                left join subjects d on a.sched_subject = d.sub_code
                left join teachers e on a.sched_teacher = e.t_no
                left join sections f on a.sched_section = f.sec_id
                WHERE e.t_no = '$tno' AND a.sched_course = d.sub_courseid GROUP BY a.sched_id";
        $r = $this->Connect()->prepare($q);
        $r->execute();
        $hsec = "";
        if($r->rowCount()>0){
            while($rr = $r->fetch()){
                $hsec = $rr['sec_name'];
                $timef = date("g:i a", strtotime($rr['sched_timef'])); 
                $timet = date("g:i a", strtotime($rr['sched_timet'])); 
                $schedname =  ($rr['sec_name'] === NULL)? $hsec : $rr['sec_name'];
                $time = $timef."-".$timet;
                
                $tname  = $rr['t_firstname']." ".$rr['t_lastname']." ".$rr['t_middlename'];
                
                $sched['time'] = $time;
                $sched['day'] = $rr['sched_day'];
                $sched['room'] = $rr['sched_room'];
                $sched['subject'] = $rr['sub_code'];
                $sched['description'] = $rr['sub_description'];
                $sched['section'] = $schedname;
                $sched['teacher'] = $tname;
                array_push($t_arr, $sched);
            }
            echo json_encode($t_arr);
        }else{
            echo json_encode($t_arr);
        }
    }


    //GET STUDENT SCHEDULE
    function GetStudSchedule($studno){
        $studSched_arr = array();
        $q = "SELECT  * FROM schedule a
                left join courses b on a.sched_course = b.c_id 
                left join students c on a.sched_course = c.stud_course
                left join subjects d on a.sched_subject = d.sub_code
                left join teachers e on a.sched_teacher = e.t_no
                left join sections f on a.sched_section = f.sec_id
                WHERE c.stud_no = '$studno' AND a.sched_course = d.sub_courseid GROUP BY a.sched_id";
        $r = $this->Connect()->prepare($q);
        $r->execute();
        if($r->rowCount()>0){
            while($rr = $r->fetch()){
                
                $timef = date("g:i a", strtotime($rr['sched_timef'])); 
                $timet = date("g:i a", strtotime($rr['sched_timet'])); 
                
                $time = $timef."-".$timet;
                
                $tname  = $rr['t_firstname']." ".$rr['t_lastname']." ".$rr['t_middlename'];
                
                $sched['time'] = $time;
                $sched['day'] = $rr['sched_day'];
                $sched['room'] = $rr['sched_room'];
                $sched['subject'] = $rr['sub_code'];
		$sched['description'] = $rr['sub_description'];
                $sched['section'] = $rr['sec_name'];
                $sched['teacher'] = $tname;
                array_push($studSched_arr, $sched);
            }
            echo json_encode($studSched_arr);
        }else{
            echo json_encode($studSched_arr);
        }
    }
    
    
}//End of Class


//=============================POST REQUEST===================================//

$studsched = new StudentSchedule();

if(isset($_POST['']) && !empty($_POST[''])){
    
}

if(isset($_POST['']) && !empty($_POST[''])){
    
}

if(isset($_POST['']) && !empty($_POST[''])){
    
}

//GET STUDENT SCHEDULE
if(isset($_POST['gstudsched']) && !empty($_POST['gstudsched'])){
    $studno = filter_input(INPUT_POST, 'studno');
    $studsched->GetStudSchedule($studno);
}

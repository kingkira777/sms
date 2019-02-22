<?php
require_once '../app.class.php';
require_once '../options/options.class.php';
require_once '../teacher-grades/teacherGrades.class.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of studentgrades
 *
 * @author Jessie
 */
class StudentGrades extends App{
    //put your code here
    
    
    //SAVE OVERALL REMARKS
    function  save_overall_remarks($studno,$rm){
        $q = "SELECT * FROM overalremarks WHERE or_studno = ?";
        $rq = $this->Connect()->prepare($q);
        $rq->execute([$studno]);
        if($rq->rowCount()>0){
            $u = "UPDATE overalremarks SET or_remark = ? WHERE or_studno = ?";
            $ru = $this->Connect()->prepare($u);
            $ru->execute([$rm, $studno]);
            echo 'updated'
;        }else{
            $s = "INSERT INTO overalremarks(or_studno, or_remark) VALUES(?,?)";
            $rs= $this->Connect()->prepare($s);
            $rs->execute([$studno,$rm]);
        }
    }

    //GET MY REMARSK
    function GetMyRemarks($studno){
        $sub_count = array();
        $total_remarks = array();
        $q = "SELECT * FROM students a
            left join subjects b on a.stud_course = b.sub_courseid
            WHERE a.stud_no = ?";
        $r = $this->Connect()->prepare($q);
        $r->execute([$studno]);
        while($rr = $r->fetch()){
            $sub = $rr['sub_code'];
            $year = $rr['stud_year'];
            array_push($sub_count, $sub);
        }
        $totalSub = count($sub_count);
        
        $c = "SELECT * FROM remarks WHERE r_studno = ? AND r_year = ?";
        $rc = $this->Connect()->prepare($c);
        $rc->execute([$studno, $year]);
        if($rc->rowCount() == $totalSub){
            while($rrc = $rc->fetch()){
                $ave = $rrc['r_average'];
                array_push($total_remarks, $ave);
                
            }
            $sum = array_sum($total_remarks);
            $remarks = $sum / $totalSub;
            echo round($remarks).'++' .$ave;
        }else{
            echo 'notcomplete';
        }
        
        
        
        
      
    }


    //SAVE UPDATE REMARKS
    function SaveUpdateRemarks($studno, $subject, $year, $average){
        $c = "SELECT * FROM remarks WHERE r_studno = ? AND r_subject = ? AND r_year = ?";
        $rc= $this->Connect()->prepare($c);
        $rc->execute([$studno, $subject, $year]);
        if($rc->rowCount()>0){
            $u = "UPDATE remarks SET r_average = ?
                WHERE r_studno = ? AND r_subject = ? AND r_year = ?";
            $ru = $this->Connect()->prepare($u);
            $ru->execute([$average, $studno, $subject, $year]);
            echo 'updated';
        }else{
            $s = "INSERT INTO remarks(r_studno, r_subject, r_year, r_average)
                VALUES(?, ?, ?, ?)";
            $rs= $this->Connect()->prepare($s);
            $rs->execute([$studno, $subject, $year, $average]);
            echo 'saved';
        }
    }


    //GET STUDENT GRADES
    function GetStudentGrades($studno){
        $studg_arr = array();
        $q = "SELECT * FROM grades a left join teachers b on a.g_teacher = b.t_no left join subjects c on a.g_subject = c.sub_id WHERE a.g_studno ='$studno'";
        $r = $this->Connect()->prepare($q);
        $r->execute();
        if($r->rowCount()>0){
            while($rr = $r->fetchAll()){
                $studg_arr = $rr;
            }
            echo json_encode($studg_arr);
        }else{
            echo json_encode($studg_arr);
        }
        
    }
    
    
    //GET MY SUBJECT
    function GetMySubject($studno){
        
    }
    
    
    
}//End of Class



//========================POST REQUEST =================================//


$studg = new StudentGrades();
$opt = new Options();
$tgrades = new TeacherGrades();


if(isset($_POST['oremarks']) && !empty($_POST['oremarks'])){
    $studno = filter_input(0, 'studno');
    $remarks = filter_input(0, 'remarks');
    
    $studg->save_overall_remarks($studno, $remarks);
}

if(isset($_POST['gmyremarks']) && !empty($_POST['gmyremarks'])){
    $studno = filter_input(0, 'studno');
    $studg->GetMyRemarks($studno);
}

if(isset($_POST['sremarks']) && !empty($_POST['sremarks'])){
    $studno = filter_input(0, 'studno');
    $subject = filter_input(0, 'subject');
    $year = filter_input(0, 'year');
    $average = filter_input(0, 'average');
    $studg->SaveUpdateRemarks($studno, $subject, $year, $average);
}

//GET MY GRADES 
if(isset($_POST['gmygrades']) && !empty($_POST['gmygrades'])){
    $studno = filter_input(INPUT_POST, 'studno');
    $subject = filter_input(INPUT_POST, 'subject');
    $tgrades->g_studno = $studno;
    $tgrades->g_subject = $subject;
    $tgrades->ComputeGrades();
    
}


//GET MY SUBJECT
if(isset($_POST['gmysub']) && !empty($_POST['gmysub'])){
    $studno = filter_input(INPUT_POST, 'studno');
    $opt->GetSubjectByStudentNo($studno);
}





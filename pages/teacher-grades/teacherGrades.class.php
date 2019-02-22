<?php
require_once '../options/options.class.php';
require_once '../student-schedule/studentSchedule.class.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of teacherGrades
 *
 * @author Jessie
 */
class TeacherGrades extends App{
    //put your code here
    
    
    public $g_id, $g_studno, $g_subject, $g_semester, $g_quarter, $g_grade,
            $g_teacher; //$g_verified
    
    
    
    
    
    
    //COMPUTE GRADES
    function ComputeGrades(){
        $studgrades = array();
        $grades = array();
        $cg = "SELECT * FROM grades a
            left join subjects b on a.g_subject = b.sub_id
            left join students c on a.g_studno = c.stud_no
            left join teachers d on a.g_teacher = d.t_no
            WHERE a.g_studno = ? AND b.sub_code = ?";
        $rcg = $this->Connect()->prepare($cg);
        $rcg->execute([$this->g_studno, $this->g_subject]);
        $count = $rcg->rowCount();
        if($rcg->rowCount()>0){
            while($rr = $rcg->fetch()){
                $grade = $rr['g_grade'];
                array_push($grades, $grade);
            }
            $grade_sum = array_sum($grades);
            $average = $grade_sum / $count;
            $stud['average'] = $average;
        }
        
        //ToGGLE if has an Average
        if($count === 4){
            $stud['hasave'] = 'true';
        }else{
            $stud['hasave'] = 'false';
        }
        
        $r = $this->Connect()->prepare($cg);
        $r->execute([$this->g_studno, $this->g_subject]);
        $studinfo = $r->fetchAll();
        $stud['info'] = $studinfo;
        
        array_push($studgrades, $stud);
        
        echo json_encode($studgrades);
    }

    //DELETE
    function DeleteGrades($gid){
        
        $d = "DELETE FROM grades WHERE g_id = '$gid'";
        $rd = $this->Connect()->prepare($d);
        $rd->execute();
        echo "deleted";
        
    }
   
    //GET STUDENT GRADES
    function GetStudGrades($studno){
        $stud_grades = array();
        $g = "SELECT * FROM grades a
                left join subjects b on a.g_subject = b.sub_id
                left join students c on a.g_studno = c.stud_no
                WHERE a.g_teacher = '$this->g_teacher' AND c.stud_no = '$studno'";
        $rq = $this->Connect()->prepare($g);
        $rq->execute();
        if($rq->rowCount()>0){
            while($rr = $rq->fetchAll()){
                $stud_grades = $rr;
            }
            echo json_encode($stud_grades);
        }else{
            echo json_encode($stud_grades);
        }
    }
    
    
    //GET SUBJECT LIST
    function GetSubjectList($coursid){
        echo '<option value=""></option>';
        $q = "SELECT * FROM subjects WHERE sub_courseid = '$coursid'";
        $r = $this->Connect()->prepare($q);
        $r->execute();
        while ($rr = $r->fetch()){
            echo '<option value="'.$rr['sub_id'].'">'.$rr['sub_code'].'</option>';
        }
    }
    
    
    //EDIT GRADE
    function EditStudentGrade($gid){
        $e = "SELECT * FROM grades a left join students b on a.g_studno = b.stud_no left join courses c on b.stud_course = c.c_id  WHERE a.g_id = ?";
        $re = $this->Connect()->prepare($e);
        $re->execute([$gid]);
        $ginfo = $re->fetch();
        echo json_encode($ginfo);
    }


    //SAVE STUDENT GRADES
    function SaveStudentGrades(){
        if(empty($this->g_id)){
            $c = "SELECT * FROM grades WHERE g_subject = ? AND g_semester = ? AND g_quarter = ?";
            $rc = $this->Connect()->prepare($c);
            $rc->execute([$this->g_subject, $this->g_semester, $this->g_quarter]);
            if($rc->rowCount()>0){
                echo 'existed';
            }else{
                
                $bquarter = $this->check_quarter($this->g_subject,$this->g_quarter);
                
                if($bquarter == 'ok'){
               $s = "INSERT INTO grades(g_studno, g_subject, g_semester, g_quarter, g_grade, g_teacher)
                    VALUES(?, ?, ?, ?, ?, ?)";
                $rs = $this->Connect()->prepare($s);
                $rs->execute([$this->g_studno, $this->g_subject, $this->g_semester, $this->g_quarter,
                $this->g_grade, $this->g_teacher]);
                    echo 'saved';
                }else{
                    echo 'cancel';
                }
            }
        }else{
            
            $u = "UPDATE grades SET g_subject = ?, g_grade = ? WHERE g_id = ?";
            $ru = $this->Connect()->prepare($u);
            $ru->execute([$this->g_subject, $this->g_grade, $this->g_id]);
            echo 'updated';
            
        }
    }
    
    
    //CHECK STUDENT NO
    function CheckStudno(){
        $q = "SELECT * FROM students a
                left join courses b on a.stud_course = b.c_id 
                WHERE a.stud_no = '$this->g_studno'";
        $r = $this->Connect()->prepare($q);
        $r->execute();
        if($r->rowCount()>0){
           $studinfo = $r->fetch();
           echo json_encode($studinfo);
        }else{
           echo json_encode(null);
        }
    }
    
    function check_quarter($sub,$q){
        $cg = "SELECT * FROM grades WHERE g_subject = ? ORDER BY g_id DESC LIMIT 1";
        $rcg = $this->Connect()->prepare($cg);
        $rcg->execute([$sub]);
        if($rcg->rowCount() > 0){
            while ($quarter = $rcg->fetch()){
            
                if($q === 'q2' && $quarter['g_quarter'] === 'q1'){
                    return 'ok';
                }else if($q === 'q3' && $quarter['g_quarter'] === 'q2'){
                    return 'ok';
                }else if($q === 'q4' && $quarter['g_quarter'] === 'q3'){
                    return 'ok';
                }else{
                    return $quarter['g_quarter'];
                }
            }
        }else{
            if($q === 'q2' || $q === 'q3' || $q === 'q4'){
                 return 'not';
            }else{
                return 'ok';
            }
        }
    }
    
    
    
    
}//End of Class

    


//===============================POST REQUEST=================================//

$tgrades = new TeacherGrades();
$sched = new StudentSchedule();
$opt = new Options();



if(isset($_POST['']) && !empty($_POST[''])){
    
}


if(isset($_POST['']) && !empty($_POST[''])){
    
}


if(isset($_POST['']) && !empty($_POST[''])){
    
}

//EDIT GRADE
if(isset($_POST['editgrade']) && !empty($_POST['editgrade'])){
    $gid = filter_input(0, 'gid');
    $tgrades->EditStudentGrade($gid);
}

//COMPUTE STUDENT GRADES
if(isset($_POST['cgrades']) && !empty($_POST['cgrades'])){
    $studno = filter_input(0,'studno');
    $subject = filter_input(0,'subject');
    $tgrades->g_studno = $studno;
    $tgrades->g_subject = $subject;
    $tgrades->ComputeGrades();
    
}

//GET STUDENT SUBJECT BY STUDENT NOs
if(isset($_POST['gsub']) && !empty($_POST['gsub'])){
    $studno = filter_input(0,'studno');
    $opt->GetSubjectByStudentNo($studno);
}

if(isset($_POST['gtsched']) && !empty($_POST['gtsched'])){
    $tno = filter_input(INPUT_POST, 'tno', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $sched->GetTeacherSchedule($tno);
}

if(isset($_POST['dgrade']) && !empty($_POST['dgrade'])){
    $gid = filter_input(INPUT_POST, 'gid');
    $tgrades->DeleteGrades($gid);
}

if(isset($_POST['gstudentgrades']) && !empty($_POST['gstudentgrades'])){
    $teacher = filter_input(INPUT_POST, 'teacher', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $studno = filter_input(0,'studno');
    $tgrades->g_teacher = $teacher;
    $tgrades->GetStudGrades($studno);
    
 }

if(isset($_POST['editg']) && !empty($_POST['editg'])){
    $gid = filter_input(INPUT_POST, 'gid');
    $tgrades->EditSubject($gid);
}
 
//SAVE STUDENT GRADES 
if(isset($_POST['sugrades']) && !empty($_POST['sugrades'])){
    
    $gid =  filter_input(INPUT_POST, 'gid');
    $studno = filter_input(INPUT_POST, 'studno');
    $subject = filter_input(INPUT_POST, 'subject');
    $semester = filter_input(INPUT_POST, 'semester');
    $quarter = filter_input(INPUT_POST, 'quarter');
    $grade = filter_input(INPUT_POST, 'grade');
    $teacher = filter_input(INPUT_POST, 'teacher');
    
    $tgrades->g_id = $gid;
    $tgrades->g_studno = $studno;
    $tgrades->g_subject = $subject;
    $tgrades->g_semester = $semester;
    $tgrades->g_quarter = $quarter;
    $tgrades->g_grade  = $grade;
    $tgrades->g_teacher = $teacher;
    $tgrades->SaveStudentGrades();
    
}

//GET COURSE SUBJECT
if(isset($_POST['gsubject']) && !empty($_POST['gsubject'])){
    $cid = filter_input(INPUT_POST, 'cid');
    $tgrades->GetSubjectList($cid);
    
}

//CHECK STUDENT NO
if(isset($_POST['chkstudno']) && !empty($_POST['chkstudno'])){
    $studno = filter_input(INPUT_POST, 'studno');
    $tgrades->g_studno = $studno;
    $tgrades->CheckStudno();
}
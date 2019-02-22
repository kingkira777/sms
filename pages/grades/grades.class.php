<?php
require_once '../app.class.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of grades
 *
 * @author Jessie
 */
class Grades extends App{
    //put your code here
    
    
    
    //VIEW STUDENT GRADES
    function view_student_grades($studno){
        
        $gmark = "SELECT * FROM overalremarks WHERE or_studno = ?";
        $rgmark = $this->Connect()->prepare($gmark);
        $rgmark->execute([$studno]);
        if($rgmark->rowCount()>0){
            $mark = $rgmark->fetch();
            $omark = $mark['or_remark'];
        }else{
            $omark = '';
        }
        
        $q = "SELECT * FROM remarks a
            left join subjects b on a.r_subject = b.sub_code
            left join students c on a.r_studno = c.stud_no
            WHERE a.r_studno = ?";
        $rq = $this->Connect()->prepare($q);
        $rq->execute([$studno]);
        if($rq->rowCount()>0){
            while($rr = $rq->fetch()){
                $name = $rr['stud_lastname']." ".$rr['stud_firstname']." ".$rr['stud_middlename'];
                $sub = $rr['sub_code'];
                $subdes = $rr['sub_description'];
                $subunits = $rr['sub_units'];
                $ave = $rr['r_average'];
                echo '
                    <tr>
                        <td>'.$name.'</td>
                        <td>'.$sub.'</td>
                        <td>'.$subdes.'</td>
                        <td>'.$subunits.'</td>
                        <td>'.$ave.'</td>
                    </tr>
                    
                ';
            }
            echo ' <tr /> <td colspan="5" align="right"><strong>Average: '.$omark.'</strong></td></tr>';
        }else{
            
        }
    }

    //GET STUDENT GRADES REMARKS
    function get_student_grades_remarks(){
        $stud_list = array();
        $qstud = "SELECT * FROM students a
            left join courses b on a.stud_course = b.c_id
            left join overalremarks c on a.stud_no = c.or_studno";
        $rqstud = $this->Connect()->prepare($qstud);
        $rqstud->execute();
        if($rqstud->rowCount() > 0){
            while($rr =  $rqstud->fetch()){
                $studno = $rr['stud_no'];
                $studname = $rr['stud_lastname']." ".$rr['stud_firstname']." ".$rr['stud_middlename'];
                $glevel = $rr['stud_ylevel'];
                $dob = $rr['stud_dob'];
                $course = $rr['c_name'];
                $remark = $rr['or_remark'];
                $stud['studno'] =$studno;
                $stud['name'] = $studname;
                $stud['gradelevel'] = $glevel;
                $stud['course'] = $course;
                $stud['remark'] = $remark;
                array_push($stud_list, $stud);
            }
            echo json_encode($stud_list);
        }
        
    }

    //GET STUDENT LIST
    function get_student_select_list(){
        echo '<option value=""><--Select--></option>';
        $q = "SELECT * FROM students";
        $rq = $this->Connect()->prepare($q);
        $rq->execute();
        if($rq->rowCount()>0){
            while($rrq = $rq->fetch()){
               $studno = $rrq['stud_no'];
               $name = $rrq['stud_lastname']." ".$rrq['stud_firstname']." ".$rrq['stud_middlename']; 
               echo '<option value="'.$studno.'">'.$name.'</option>';
            }
        }
        
    }

    //DELETE GRADE
    function DeleteGrade($gid){
        try {
            $d = "DELETE FROM grades WHERE g_id = ?";
            $rd = $this->Connect()->prepare($d);
            $rd->execute([$gid]);
            echo "deleted";
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }

        
    }
    
    //APPROVED AND DIS APPROVED GRADES
    function AppDisGrade($gid,$istrue){
        try {
            $q = "UPDATE grades SET g_isveryfied = ? WHERE g_id = ?";
            $r = $this->Connect()->prepare($q);
            $r->execute([$istrue, $gid]);
            echo $istrue;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    //GET GRADES LIST
    function GetGrades($tid){
        $grades_arr = array();
        if(empty($tid)){
            $q = "SELECT * FROM grades a left join students b on a.g_studno = b.stud_no left join teachers c on a.g_teacher = c.t_no left join subjects d on a.g_subject = d.sub_id";
            $r = $this->Connect()->prepare($q);
            $r->execute();
            if($r->rowCount()>0){
                while($rr = $r->fetchAll()){
                    $grades_arr = $rr;
                }
                echo json_encode($grades_arr);
            }else{
                echo json_encode($grades_arr);
            }
        }else{
            $q = "SELECT * FROM grades a left join students b on a.g_studno = b.stud_no left join teachers c on a.g_teacher = c.t_no left join subjects d on a.g_subject = d.sub_id WHERE c.t_no = '$tid'";
            $r = $this->Connect()->prepare($q);
            $r->execute();
            if($r->rowCount()>0){
                while($rr = $r->fetchAll()){
                    $grades_arr = $rr;
                }
                echo json_encode($grades_arr);
            }else{
                echo json_encode($grades_arr);
            }
        }
        
    }
    
    
}//End of Class


//===========================POST REQUEST=====================================//


$_grades = new Grades();

if(isset($_POST['']) && !empty($_POST[''])){
    
    
}

if(isset($_POST['']) && !empty($_POST[''])){
    
    
}

//VIEW STUDENT GRADES
if(isset($_POST['vstudg']) && !empty($_POST['vstudg'])){
    $studno = filter_input(0, 'studno');
    $_grades->view_student_grades($studno);
}

if(isset($_POST['gstudgrades']) && !empty($_POST['gstudgrades'])){
    $_grades->get_student_grades_remarks();
    
}

//GET STUDNET LIST
if(isset($_POST['gstudlist']) && !empty($_POST['gstudlist'])){
    $_grades->get_student_select_list();
}

//DELETE GRADE
if(isset($_POST['dgrade']) && !empty($_POST['dgrade'])){
    $gid = filter_input(INPUT_POST, 'gid', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $_grades->DeleteGrade($gid);
}

//APPROVED DIS-APPROVED GRADES
if(isset($_POST['apdisgrades']) && !empty($_POST['apdisgrades'])){
    $gid = filter_input(INPUT_POST, 'gid', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $isapproved = filter_input(INPUT_POST, 'isapproved', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $_grades->AppDisGrade($gid, $isapproved);
}

if(isset($_POST['getgradeslist']) && !empty($_POST['getgradeslist'])){
   $tid = filter_input(INPUT_POST, 'tid', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $_grades->GetGrades($tid);
}
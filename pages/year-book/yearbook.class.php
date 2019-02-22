<?php
require_once '../app.class.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of yearbook
 *
 * @author Jessie
 */
class YearBook extends App{
    //put your code here
    
    
    
    //GET STUDENT LIST BY YEAR
    function GetStudentListByYear($year){
        $q = "SELECT * FROM students WHERE stud_year = ? AND stud_isregistered = 'true' AND stud_approved = 'true'";
        $r = $this->Connect()->prepare($q);
        $r->execute([$year]);
        $studlist = $r->fetchAll();
        echo json_encode($studlist);
    }

    //GET YEAR LIST
    function GetYearList(){
        echo '<option value=""></option>';
        $q = "SELECT * FROM `year`";
        $r = $this->Connect()->prepare($q);
        $r->execute();
        while($rr = $r->fetch()){
            $year = $rr['yr_year'];
            echo '<option value="'.$year.'">'.$year.'</option>';
        }
    }
    
    
}//End of Class


//POST REQUEST

$yearbook = new YearBook();


if(isset($_POST['']) && !empty($_POST[''])){
    
}

if(isset($_POST['']) && !empty($_POST[''])){
    
}

if(isset($_POST['']) && !empty($_POST[''])){
    
}

if(isset($_POST['gyealystudents']) && !empty($_POST['gyealystudents'])){
    $year = filter_input(0,'year');
    $yearbook->GetStudentListByYear($year);
    
}

//GET YEAR LIST
if(isset($_POST['gyrlist']) && !empty($_POST['gyrlist'])){
    $yearbook->GetYearList();
}



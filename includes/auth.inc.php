<?php
session_start();
require_once 'pages/app.class.php';
$app = new App();

$userid = isset($_SESSION['userid'])? $_SESSION['userid'] : "";
$userno = isset($_SESSION['userno'])? $_SESSION['userno'] : "";
$priv = isset($_SESSION['userpriv'])? $_SESSION['userpriv'] : "";

if($userid === "" && empty($userid)){
    header("location: login");
}


if($priv === "student"){
    $q = "SELECT * FROM students WHERE stud_no='$userno'";
    $r = $app->Connect()->prepare($q);
    $r->execute();
    $userinfo = $r->fetch();
    $userid = $userinfo['stud_id'];
    $secid = $userinfo['stud_section'];
    $logname = $userinfo['stud_lastname']." ".$userinfo['stud_firstname']." ".$userinfo['stud_middlename'];
    
    
}
if($priv === "admin"){
    $logname = "Admin";
}
if($priv === "teacher"){
    $q =  "SELECT * FROM teachers a left join schedule b on a.t_no = b.sched_teacher WHERE a.t_no='$userno'";
    $r = $app->Connect()->prepare($q);
    $r->execute();
    $userinfo = $r->fetch();
    $userid = $userinfo['t_id'];
    $secid = $userinfo['sched_section'];
    $logname = $userinfo['t_firstname']." ".$userinfo['t_lastname']." ".$userinfo['t_middlename'];
    
}



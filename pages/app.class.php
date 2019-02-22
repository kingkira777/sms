<?php
date_default_timezone_set('Asia/Manila');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of app
 *
 * @author Jessie
 */
class App {
    //put your code here

   /* public $s_host = "localhost";
    public $s_username = "id8495362_admin_sms";  
    public $s_password = "sms1234!";
    public $s_databsae = "id8495362_dbsms"; */
    
    public $s_host = "localhost";
    public $s_username = "root";  //
    public $s_password = "admin"; //smsadmin1234
    public $s_databsae = "dbsms"; 
  
    //Connect Using PDO
    function Connect(){
        $dsn = "mysql:host=$this->s_host;dbname=$this->s_databsae";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ];
        try{
            $con = new PDO($dsn, $this->s_username, $this->s_password, $options);
            return $con;
        } catch (\PDOException $e){
            throw new \PDOException($e->getMessage(),(int)$e->getCode());
        }
    }
    
    
    //SAVE STUDENT CODE NO.
    function SaveStudentCodeno($studno,$codeno, $isverify){
        $chk = "SELECT * FROM studentcode WHERE scode_studno='$studno'";
        $r = $this->Connect()->prepare($chk);
        $r->execute();
        if($r->rowCount()>0){
            
        }else{
            $q = "INSERT INTO studentcode(scode_studno, scode_codeno, scode_isverify)"
                    . "VALUES(?, ?, ?)";
            $rq = $this->Connect()->prepare($q);
            $rq->execute([$studno, $codeno, $isverify]);
        }   
    }
   
}//End of Class

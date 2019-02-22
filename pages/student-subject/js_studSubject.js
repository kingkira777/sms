/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function(){
    "use strict";
    var url = "pages/student-subject/studentSubject.class.php";
    
    
    $(document).ready(function(){
       
        
        GetStudentSubject();
    });
    
    
    
    //GET STUDENT SUBJECT
    var GetStudentSubject = function(){
        var data = { gstudsub : 'getstudentsubject', studno : app.userLogin().userno };
        app.ajaxRequest(url,'json',data,function(xdata){
           // console.log(xdata);
            app.studSubjectTable(xdata);
        });
        
    };
    
});



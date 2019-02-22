/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function(){
   "use strict";
   var url = "pages/student-schedule/studentSchedule.class.php";
   
   $(document).ready(function(){
      
       //FUNCTIONS
       getStudentSchedule();
   });
    
    
    //GET STUDENT SCHEDULE
    var getStudentSchedule = function(){
        //console.log(app.userLogin().userno);
        var data = { gstudsched : 'getstudentschedule', studno : app.userLogin().userno };
        app.ajaxRequest(url,'json',data,function(xdata){
            //console.log(xdata);
            app.studScheduleTable(xdata);
        });
        
    };
    
});


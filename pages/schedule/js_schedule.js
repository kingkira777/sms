85/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function(){
   "use strict";
   var url = "pages/schedule/schedule.class.php";
   
   var id, course, day, subject, tfrom, tto, section, room, teacher = "";
   
   $(document).ready(function(){
       
       course = $('#sched_course');
       subject = $('#sched_subject');
       day = $('#sched_day');
       tfrom = $('#sched_tfrom');
       tto = $('#sched_tto');
       section = $('#sched_section');
       room = $('#sched_room');
       teacher = $('#sched_teacher');
       
       
       //FUNCTIONS
       getSchedTable();
       GetTeacherList();
       
   });
   
   
   //DELETE SCHEDULE
   window.deleteSchedule = function (schedid){
       app.messegeAlert('Delete', 'Are you sure you want to Delete this Schedule?','warning',function(istrue){
           if(istrue){
               //console.log(istrue);
               var data = { dsched : 'deletesched',  schedid : schedid};
               app.ajaxRequest(url,'',data,function(xdata){
                   console.log(xdata);
                   setTimeout(function(){
			$('body').removeClass('smsload');
			if(xdata.toString() === "deleted"){
                                swal('Deleted', 'Successfuly Deleted!', 'success');
                                getSchedTable();
                                ClearSchedField();
                          }
                    },timeOut);
               },true);
           }
       });
   };
   
   
   window.EditSched = function (scheid){
       var data = { editsched : 'editsched', schedid: scheid};
       app.ajaxRequest(url,'json',data,function(xdata){
          //console.log(xdata);
            setTimeout(function(){
                $('body').removeClass('smsload');
                id = xdata.sched_id;
                GetSectionSelectList(xdata.sched_course);
                course.val(xdata.sched_course);
                selectCourse(xdata.sched_course);
                day.val(xdata.sched_day);
                tfrom.val(xdata.sched_timef);
                tto.val(xdata.sched_timet);
                room.val(xdata.sched_room);
                teacher.val(xdata.sched_teacher);
                setTimeout(function (){  
                  subject.val(xdata.sched_subject);
                  section.val(xdata.sched_section);
                },1000);
            },timeOut);
       },true);
   };
   
   //GET SCHEDULE BY TEACHER
   window.GetSchedByTeacherSSS = function (tno){
        var data = {
            gteacherschedsss : 'getteachersched',
            tnumber : tno
        };
        app.ajaxRequest(url,'json',data,function (e){  
            //console.log(e);
            setTimeout(function (){
                $('body').removeClass('smsload');
                app.schedTable(e);
            },timeOut);
        },true);
   };
   
   //GET SCHEDULE TABLE LIST
   var getSchedTable = function (){
       var data = { gschedtable : 'getscheduletable'};
       app.ajaxRequest(url,'json',data,function(xdata){
           //console.log(xdata);
           app.schedTable(xdata);
       });
   };
   
   
   //SAVE UPDATE SCHEDULE
   window.saveUpdateSchedule = function (){
       
       var h1 = tfrom.val();
       var h2 = tto.val();
       
       h1 = h1.split(':')[0];
       h2 = h2.split(':')[0];
        
       if(course.val() === ""){
            swal('Empty','Course is Empty!', 'warning');
       }else if(subject.val() === ""){
            swal('Empty','Subject is Empty!', 'warning');
       }else if(day.val() === ""){
           swal('Empty','Day is Empty!', 'warning');
       }else if(tfrom.val() === "" && tto.val() === ""){
            swal('Empty','Some Field(s) of Time is Empty!', 'warning');
       }else if(h1 >= h2){
            swal('Invalid','Time from must be less than from Time to!', 'warning');
       }else if(section.val() === ""){
            swal('Empty','Section is Empty!', 'warning');
       }else if(room.val() === ""){
            swal('Empty','Room is Empty!', 'warning');
       }else if(teacher.val() === ""){
            swal('Empty','Teacher is Empty!', 'warning');
       }else{
         
         var data = {
               susched : 'saveupdatesched',
               schedid : id,
               course : course.val(),
               subject : subject.val(),
               day : day.val(),
               timef : tfrom.val(),
               timet : tto.val(),
               section : section.val(),
               room : room.val(),
               teacher : teacher.val()
           };
           
           app.ajaxRequest(url,'',data,function(xdata){
                console.log(xdata);
                setTimeout(function(){ 
                    $('body').removeClass('smsload');
                    
                      if(xdata.toString() === "existed"){
                          swal('Error', 'Teacher has Already Scheduled for Day, Room and Time', 'warning');
                          ClearSchedField();
                      }else if(xdata.toString() === "samedaytime"){
                          swal('Error', 'Day and Time Already Exist', 'warning');
                      }else if(xdata.toString() === "sameroomtime"){
                          swal('Error', 'Room and Time Already Scheduled', 'warning');
                      }else if(xdata.toString() === "conflict"){
                          swal('Conflict', 'Conflict Time', 'warning');
                      }else if(xdata.toString() === "schedteach"){
                          swal('Existed', 'Teacher is Already Scheduled for this Subject!', 'warning');
                      }else if(xdata.toString() === "saved"){
                          swal('Save', 'Successfuly Saved!', 'success');
                          getSchedTable();
                          ClearSchedField();
                      }else if(xdata.toString() === "updated"){
                          swal('Updated', 'Successfuly Updated!', 'success');
                          getSchedTable();
                      }
                    
                },timeOut);
           },true);
           
       }
   };
   
   
   //GET Teacher List
   var GetTeacherList = function (){
        var data = {
            gteacherlist : 'getTeacherlsit'
        };
        app.ajaxRequest(url,'',data,function (e){
//            console.log(e);
            $('#t_list').html(e);
        });
   };
   
   
   //CLEAR SCHEDULE FIELDs
   window.ClearSchedField = function (){
     id = "";
     course.val('');
     subject.val('');
     day.val('');
     tfrom.val('');
     tto.val('');
     section.val('');
     room.val('');
     teacher.val('');
   };
    
});


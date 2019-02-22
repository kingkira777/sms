/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function(){
   "use strict";
   var url = "pages/grades/grades.class.php";
   
   
   
   $(document).ready(function(){
       
       
       
       //FUNCTIONS
       getGradelist('');
       //GetStudentList();
       GetStudentGrades_remarks();
   });
   
   
   window.print_student_grades = function (_studno){
       var purl = "pages/_pdf-files/studgrades.pdf.php?studno="+_studno;
       window.open(purl,'_blank');
   };
   
   
   //VIEW STUDENT GRADES
   window.view_student_grades = function (_studno){
        var data = {
            vstudg : 'viewstudentgrades',
            studno : _studno
        };
        app.ajaxRequest(url,'',data,function (x){
            //console.log(x);
            setTimeout(function (){
                $('body').removeClass('smsload');
                $('#table-stud-grades').html(x);
            },timeOut)
            
        },true);
   };
   
   //GET STUDENT GRADES
   window.GetStudentGrades_remarks = function(){
       var data = {
           gstudgrades : 'getstudengrades_Remarks'
       }
       app.ajaxRequest(url,'json',data,function(x){
            console.log(x);
            app.studenGradesRemarks(x);
       });
   };
   
   //GET STUDENT LIST
   var GetStudentList = function(){
       var data = {
            gstudlist : 'getstudentlist'
       };
       app.ajaxRequest(url,'',data,function(x){
         //  console.log(x);
           $('#studname').html(x);
       });
   };
   
   
   //DELETE GRADE
   window.DeleteGrade = function (gid){
        app.messegeAlert('Delete?', 'Are you sure you want to Delete this Grade?', 'warning', function (istrue){
           if(istrue === true){
               var data = { dgrade : 'deletegrades', gid: gid };
               app.ajaxRequest(url,'', data,function (xdata){
                  //console.log(xdata);
                  setTimeout(function(){
			$('body').removeClass('smsload');
			if(xdata.toString() === "deleted"){
                                swal('Deleted', 'Grade Successfuly Deleted!', 'success');
                                getGradelist();
                          }
		},timeOut);
                  
               },true);
           } 
        });
   };
   
   //APPROVED AND DIS APPROVE GRADES
   window.appDisGrade = function (gid,istrue){
       var data = { apdisgrades : 'approvedisapprovegrades', gid: gid, isapproved : istrue };
       app.ajaxRequest(url,'',data,function(xdata){
           //console.log(xdata);
          
           setTimeout(function(){
		$('body').removeClass('smsload');
		getGradelist();
			
            },timeOut);
       },true);
   };
   
   //GET GRADE LIST
   window.getGradelist = function(tid){
       var data = { getgradeslist : 'getgradeslist', tid: tid };
       app.ajaxRequest(url,'json',data,function(xdata){
//            console.log(xdata); 
            setTimeout(function(){
                $('body').removeClass('smsload');
		app.gradesTable(xdata);	
            },timeOut);
       },true);
        
   };
   
    
    
});


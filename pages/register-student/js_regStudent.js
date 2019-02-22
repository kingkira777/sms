/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function (){
   "use strict";
   var url = "pages/register-student/regnewstudent.class.php";
   
   //REG VAR
   var id, studno, fname, lname, mname, course, section, year, year_lvl;
   
   
   $(document).ready(function (){
       
       //VAR
       studno = $('#regs_studno');
       fname = $('#regs_fname');
       lname = $('#regs_lname');
       course = $('#regs_course');
       section = $('#regs_section');
       mname = $('#regs_mname');
       year = $('#regs_year');
       year_lvl = $('#regs_year_lvl');
       
       //INIT
       
       
       //FUNCTIONS
       GetRegisterStudents();
       GenerateStudentNo();
   });
   
   
   
   
   //APPROVE STUDENT REGISTER
   window.ApprovedStudentRegister = function(_id){
        app.messegeAlert('Approved', 'Are you sure you want to Approve this Student?','warning', function(x){
            if(x === true){
                var data = {
                    apstud : 'approvedstud',
                    id : _id
                        
                };
                app.ajaxRequest(url,'',data,function(e){
                 //   console.log(e);
                    setTimeout(function(){
			$('body').removeClass('smsload');
			if(e.toString() === 'updated'){
                            GetRegisterStudents();
                        }
                    },timeOut);
                },true);
            }
        });
   };
   
   
   //DELETE 
   window.DeleteRegStudent = function(_id){
        app.messegeAlert('Delete', 'Are you sure you want to Delete this Student?','warning', function(x){
            if(x === true){
                var data = {
                    dregstud : 'deleteregstud',
                    id : _id
                }
                app.ajaxRequest(url,'',data,function(e){
                //   console.log(e);
                    setTimeout(function(){
			$('body').removeClass('smsload');
			if(e.toString() === "deleted"){
                            swal('Deleted', 'Successfuly Deleted', 'success');
                            GetRegisterStudents();
                            GenerateStudentNo();
                       }
                    },timeOut);
                },true);
            }
        });
   };
   
   //EDIT
   window.EditRegStudent = function(_id){
        id = _id
        var data = {
            editstudent  :'editstudent',
            id : id
        };
       app.ajaxRequest(url,'json',data,function(e){
         // console.log(e); 
            setTimeout(function(){
                $('body').removeClass('smsload');
                GetSectionList(e.stud_course);
                studno.val(e.stud_no);
                fname.val(e.stud_firstname);
                lname.val(e.stud_lastname);
                mname.val(e.stud_middlename);
                course.val(e.stud_course);
                year.val(e.stud_year);
                setTimeout(function(){
                  section.val(e.stud_section);
                },1000);
            },timeOut);
       },true);
   };
  
   
   //REG NEW STUDENT
   window.RegisterNewStudent = function (){
       if(fname.val() === ""){
           swal('Empty Field', 'Firstname is Empty', 'warning');
       }else if(lname.val() === ""){
           swal('Empty Field', 'Lastname is Empty', 'warning');
       }else if(mname.val() === ""){
           swal('Empty Field', 'Middlename is Empty', 'warning');
       }else if(course.val() === ""){
           swal('Empty Field', 'Course is Empty', 'warning');
       }else if(section.val() === ""){
           swal('Empty Field', 'Section is Empty', 'warning');
       }else if(year.val() === ""){
           swal('Empty Field', 'Year is Empty', 'warning');
       }else if(year_lvl.val() === ""){
            swal('Empty Field', 'Year Level is Empty', 'warning');
       }else{
           
           var data = {
                snewreg : 'savenewregstud',
                id : id,
                studno: studno.val(),
                fname : fname.val(),
                lname : lname.val(),
                mname : mname.val(),
                course: course.val(),
                section : section.val(),
                year : year.val(),
                yrlevel : year_lvl.val()
        }
       app.ajaxRequest(url,'',data,function (e){
              //console.log(e); 
            setTimeout(function(){
                $('body').removeClass('smsload');
		if(e.toString() === "saved"){
                    swal('Saved', 'Successfuly Saved!', 'success');
                    GetRegisterStudents();
                    ClearRegNewStudent();
                }else if(e.toString() === "updated"){
                      swal('Updated', 'Successfuly Updated!', 'success');
                      GetRegisterStudents();
                }else if(e.toString() === "existed"){
                      swal('Existed', 'Student Name is Already Existed!', 'warning');
                }
                GenerateStudentNo();
            },timeOut);
       },true);
    }
   };
   
   
    //GET REGSUTDENT LIST
    var GetRegisterStudents = function (){
        var data = {
            gregstudent :'getstudentregister'
        };
        app.ajaxRequest(url,'json',data,function (e){
         //  console.log(e) ;
           app.studentRegisterTable(e);
        });
        
    };
    
    //GET SECTION
    window.GetSectionList = function (cid){
       var data = { gsection : 'getsections', cid : cid};
       app.ajaxRequest(url,'',data,function (e){
//          console.log(e); 
          section.html(e);
       });
    };
    
    //GENERATE STUDENT NO
    window.GenerateStudentNo = function(){
        var data = {
            gstudno : 'generatestudno'
        };
        app.ajaxRequest(url,'',data,function (e){
            //console.log(e);
            studno.val(e);
        });
    };
    
    
   window.ClearRegNewStudent = function (){
       id = "";
       studno.val('');
       fname.val('');
       lname.val('');
       mname.val('');
       course.val('');
       section.val('');
       year.val('');
       year_lvl.val('');
   };
   
   
});


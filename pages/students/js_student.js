/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function (){
    "use strict";
    var url = "pages/students/student.class.php";
    
    var id, sno, scode, fname, lname, mname, dob, gender, citizenship, contactno, email, address,
    course, section, year, ylevel;
    var em_name, em_contact;
   
    $(document).ready(function(){
        
        //Fields
        sno = $('#s_no');
        scode= $('#s_code');
        fname= $('#s_fname');
        lname= $('#s_lname');
        mname= $('#s_mname');
        dob= $('#s_dob');
        gender= $('#s_gender');
        citizenship= $('#s_citizen');
        contactno= $('#s_contactno');
        email= $('#s_email');
        address= $('#s_address');
        course= $('#s_course');
        section= $('#s_section');
        year= $('#s_year');
        ylevel = $('#s_yearlevel');
        em_name = $('#em_name');
        em_contact = $('#em_contact');
        
        
        
        //FUNCTIONS
        getStudentList();
        GetStudentArcive();
        //console.log(app.userLogin().id);
        if(app.userLogin().privilage === "student"){
            setTimeout(function(){
                console.log(app.userLogin().id);
                EditStudentInfo(app.userLogin().id); 
            },1500);
        }
    });
    
    
    
   //ACTIVE AND IN-ACTIVE STUDENT
   window.ActiveStudent = function (isactive, sid){
       app.messegeAlert('Active / In-Active', 'Are you sure you want to Delete this Student?','warning',function(istrue){
           if(istrue){
               var data = { activestud : 'activestud', sid: sid, isactive : isactive};
               app.ajaxRequest(url,'',data,function(xdata){
                   setTimeout(function(){
			$('body').removeClass('smsload');
                        console.log(xdata);
                        getStudentList();
                        GetStudentArcive();
                    },timeOut);
               },true);
           }
       });
   };
    
    
   //DELETE STUDENT
   window.DeleteStudent = function (sid){
       app.messegeAlert('Delete', 'Are you sure you want to Delete this Student?','warning',function(istrue){
           if(istrue){
               var data = { dstud : 'deletestudent', sid: sid};
               app.ajaxRequest(url,'',data,function(xdata){
                   setTimeout(function(){
			$('body').removeClass('smsload');
                        if(xdata.toString() === "deleted"){
                            swal('Deleted', 'Successfuly Deleted', 'success');
                            getStudentList();
                       }
                    },timeOut);
               },true);
           }
       });
   };
   
   
   //EDIT STUDENT INFO
   window.EditStudentInfo = function (sid){
       var data = { editstudinof : 'editstudinfo', sid : sid};
       app.ajaxRequest(url,'json',data,function(xdata){
            console.log(xdata);
            setTimeout(function(){
                $('body').removeClass('smsload');
                $('#editStudentBtn').prop('disabled', true);
                id = xdata.stud_id;
                sno.val(xdata.stud_no);
                scode.val(xdata.scode_codeno);
                fname.val(xdata.stud_firstname);
                lname.val(xdata.stud_lastname);
                mname.val(xdata.stud_middlename);
                dob.val(xdata.stud_dob);
                gender.val(xdata.stud_gender);
                citizenship.val(xdata.stud_citizenship);
                contactno.val(xdata.stud_contactno);
                email.val(xdata.stud_email);
                address.val(xdata.stud_address);
                course.val(xdata.stud_course);
                year.val(xdata.stud_year);
                ylevel.val(xdata.stud_ylevel);
                em_name.val(xdata.stud_emName);
                em_contact.val(xdata.stud_emContact);
                 setTimeout(function (){
                     section.val(xdata.stud_section);
                 },1000);
                app.activeTab('auStudentTab');
             },timeOut);
       },true);
   };
    
   //Save Update Info
   window.saveUpdateStudent = function (){
       
        if(sno.val() === ""){
            swal('Empty', 'Student No. is Empty!', 'warning');
        }else if(lname.val() === "" || fname.val() === "" || mname.val() === "" ){
            swal('Empty', 'Some Field(s) is Empty!', 'warning');
        }else if(dob.val() === "" || gender.val() === "" || citizenship.val() === ""){
            swal('Empty', 'Some Field(s) is Empty!', 'warning');
        }else if(dob.val().split('-')[0] > 2005){
            swal('Invald!', 'Birthday must be less than 2005', 'warning');
        }else if(dob.val().split('-')[0] < 1950){
            swal('Invald!', 'Birthday must be greater than 1950', 'warning');
        } else if(contactno.val() === "" || email.val() ===""){
            swal('Empty', 'Some Field(s) is Empty!', 'warning');
        }else if(course.val() === "" || section.val() === "" || year.val() === ""){
            swal('Empty', 'Some Field(s) is Empty', 'warning');
        }else if(contactno.val().length !== 11){
            swal('Invalid', 'Number must be 11 characters!', 'warning');      
        }else if(!app.validateEmail(email.val())){
            swal('Invalid', 'Invalid Email!', 'warning');  
        }else if(em_name.val() === ""){
            swal('Emtpy Field', 'Emergency Contact Name is Empty!', 'warning');  
        }else if(em_contact.val() === ""){
            swal('Emtpy Field', 'Emergency Contact is Empty!', 'warning');  
        }else if(em_contact.val().length !== 11){
            swal('Invalid', 'Number must be 11 characters!', 'warning'); 
        }else{
       
            var data = {
                supdate : 'saveupdatestudent',
                sid : id,
                sno : sno.val(),
                scode : scode.val(),
                fname : fname.val(),
                lname : lname.val(),
                mname : mname.val(),
                dob : dob.val(),
                gender : gender.val(),
                citizen : citizenship.val(),
                contactno : contactno.val(),
                email : email.val(),
                address : address.val(),
                course : course.val(),
                section : section.val(),
                year : year.val(),
                emname : em_name.val(),
                emcontact : em_contact.val()
            };

            app.ajaxRequest(url,'',data,function(xdata){
               //console.log(xdata);
               setTimeout(function(){
			$('body').removeClass('smsload');
                        if(xdata.toString() === "saved"){
                            swal('Saved!', 'Successfuly Saved!','success');
                            getStudentList();
                            clearStudentFields();
                       }else if(xdata.toString() === "existed"){
                           swal('Warning!', 'Student Name is Already Exist!','warning');
                       }else if(xdata.toString() === "updated"){
                            swal('Updated!', 'Successfuly Updated!', 'success');
                            getStudentList();
                       }
		},timeOut);
            },true);  
        }
   };
    
    
    
   //GET STUDENT LIST
   var getStudentList = function (){
        var data = { gstudlist : 'getstudentlist' };
        app.ajaxRequest(url,'json',data,function(xdata){
           //console.log(xdata); 
           app.studentTable(xdata);
        });
   };
   
   //GET STUDENT ARCHIVE
   var GetStudentArcive = function (){
        var data = { garstudentlist : 'getstudentlist' };
        app.ajaxRequest(url,'json',data,function(xdata){
           console.log(xdata); 
           app.studentArchiveTable(xdata);
           
        });
   };
    
   //GENERATE STUDENT NO
   window.generateStudentNo = function (){
       var data = { genstudno : 'generatestudno' };
       app.ajaxRequest(url,'',data,function(data){
           //console.log(data);
           sno.val(data);
           scode.val(app.randomPassword());
       });
   };
   
   
   window.clearStudentFields = function (){
       $('#editStudentBtn').prop('disabled', false);
       id = "";
       sno.val('');
       scode.val('');
       fname.val('');
       lname.val('');
       mname.val('');
       dob.val('');
       gender.val('');
       citizenship.val('');
       contactno.val('');
       email.val('');
       address.val('');
       course.val('');
       section.val('');
       year.val('');
       
   };
   
});


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function(){
   "use strict";
   var url = "pages/teachers/teacher.class.php";
   
   var id, tno, password, lname, fname, mname, dob, gender, cit, contact, email, address;
   
   
   $(document).ready(function(){
      
      
       //FIELDs
       tno = $('#t_no');
       password = $('#t_password');
       lname = $('#t_lastname');
       fname = $('#t_firstname');
       mname = $('#t_middlename');
       dob = $('#t_dob');
       gender = $('#t_gender');
       cit = $('#t_citizenship');
       contact = $('#t_contactno');
       email = $('#t_email'); 
       address = $('#t_address');
       
       
       //CALL FUNCTIONS
       getTeacherList();
       getTeacherSelect();
       GetTeacherSchedule();
       
       if(app.userLogin().privilage === "teacher"){
            editTeacher(app.userLogin().id);
       }
   });
   
   //DELETE TEACHER
   window.deleteTeacher = function (tid){
       app.messegeAlert('Delete', 'Are you sure you want to Delete this Teacher?', 'warning',function(istrue){
            if(istrue){
                var data = { deleteTeacher : 'deleteteacher' , tid: tid};
                app.ajaxRequest(url,'',data,function(xdata){
                    //console.log(xdata);
                    setTimeout(function(){
			$('body').removeClass('smsload');
                        if(xdata.toString() === "deleted"){
                            swal('Deleted', 'Successfuly Deleted!', 'warning');
                            getTeacherList();
                        }
                    },timeOut);
                },true);
            }
       });
   };
   
   //EDIT TEACHER
   window.editTeacher = function (tid){
       var data = { editteacher : 'editteacher', tid : tid};
       app.ajaxRequest(url,'json',data,function(xdata){
            setTimeout(function(){
                $('body').removeClass('smsload');
                $('#editTeacherBtn').prop('disabled',true);
                id = xdata[0].t_id;
                tno.val(xdata[0].t_no);
                lname.val(xdata[0].t_lastname);
                fname.val(xdata[0].t_firstname);
                mname.val(xdata[0].t_middlename);
                dob.val(xdata[0].t_dob);
                gender.val(xdata[0].t_gender);
                cit.val(xdata[0].t_citizenship);
                contact.val(xdata[0].t_contactno);
                email.val(xdata[0].t_email);
                address.val(xdata[0].t_address);
                app.activeTab('auTeacherTab');
            },timeOut);
       },true);
      
   };
   
   //GET TEACHER TABLE LIST
   var getTeacherList = function(){
     var data = {
       gtlist : 'getteacherlist'
     };
     app.ajaxRequest(url,'json',data,function(data){
        app.teacherTable(data);
     });
   };
   
   //GET TEACHER LIST SELECT
   var getTeacherSelect = function (){
       var data = { gtselect : 'getteacherselect' };
       app.ajaxRequest(url,'',data,function(xdata){
           //console.log(xdata);
           $('#sched_teacher').html(xdata);
           $('#g_teachername').html(xdata);
       });
   };
   
   //SAVE UPDATE TEACHER INFO
   window.saveUpdateTeacher = function(){
       if(tno.val() === ""){
           swal('Empty', 'Teacher No is Empty!', 'warning');
       }else if(lname.val() === ""){
            swal('Empty', 'Lastname is Empty!', 'warning');
       }else if(fname.val() === ""){
            swal('Empty', 'Firstname is Empty!', 'warning');
       }else if(dob.val() === ""){
            swal('Empty', 'Date of Birth is Empty!', 'warning');
       }else if(dob.val().split('-')[0] > 2005){
            swal('Invald!', 'Birthday must be less than 2005', 'warning');
       }else if(dob.val().split('-')[0] < 1950){
            swal('Invald!', 'Birthday must be greater than 1950', 'warning');
       }else if(gender.val() === "" ){
            swal('Empty', 'Gender is Empty!', 'warning');
       }else if(contact.val().length !== 11 ){
            swal('Empty', 'Contact # must be 11(characters)', 'warning');
       }else if(!app.validateEmail(email.val()) || email.val() === ""){
            swal('Empty', 'Email Address is Empty or Not Valid!', 'warning');
       }else{
            var data = {
               savaupdateteacher : 'saveupdateteacher',  
               id : id,
               tno : tno.val(),
               password : password.val(),
               lname : lname.val(),
               fname : fname.val(),
               mname : mname.val(),
               dob : dob.val(),
               gender : gender.val(),
               citizenship : cit.val(),
               contact: contact.val(),
               email : email.val(),
               address : address.val()
            };
            
            app.ajaxRequest(url,'',data,function(data){
               //console.log(data);
               setTimeout(function(){
			$('body').removeClass('smsload');
			if(data.toString() === "savedsaved"){
                            swal('Save', 'Successfuly Saved!', 'success');
                            getTeacherList();
                            clearTeacherFields();
                        }else if(data.toString() === "updated"){
                            swal('Update', 'Successfuly Updated!', 'success');
                            getTeacherList();
                        }else if(data.toString() === "existed"){
                            swal('Existed!', 'Teacher Name is Already Exist!', 'warning');
                        }
		},timeOut);
               
            },true);
       }
   };
   
   //GENERATE ID NO and Password
   window.generateIdnoPassword = function (){
       var data = {
           gidnopassword : 'generateidnopassword',
       };
       
       app.ajaxRequest(url,'',data,function(data){
           tno.val(data);
           password.val(app.randomPassword());
       });
   };
   
   
   //GET TEACHER SCHEDULE
   var GetTeacherSchedule = function (){
        var data  = {
            gteachersched : 'getteachersched',
            tno : app.userLogin().userno
        };
        app.ajaxRequest(url,'json',data,function (e){
           app.schedTeacherTable(e); 
        });
   };
   
   
   //TABLE TEACHER==============================================================
   window.clearTeacherFields = function (){
       id = "";
       tno.val('');
       password.val('');
       lname.val('');
       fname.val('');
       mname.val('');
       dob.val('');
       gender.val('');
       cit.val('');
       contact.val('');
       email.val('');
       address.val('');
       $('#editTeacherBtn').prop('disabled',false);
   };
    
});


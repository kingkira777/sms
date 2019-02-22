/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function (){
    "use strict";
    var url = "pages/user-login/userlogin.class.php";
    
    
    var userid, password, codeno;
    
    var reg_studno, reg_password, reg_repassword, reg_name, reg_dob, reg_gender, reg_citizenship, reg_contactno, 
    reg_email, reg_address;
    
    //Emergency
    var reg_emName, reg_emContact;
    
    
    
    $(document).ready(function (){
       
       userid = $('#userid');
       password = $('#password');
       codeno = $('#codeno');
       
       reg_studno = $('#reg_studno');
       reg_password = $('#reg_password');
       reg_repassword = $('#reg_repassword');
       
       reg_name = $('#reg_name');
       reg_dob = $('#reg_dob');
       reg_gender = $('#reg_gender');
       reg_citizenship = $('#reg_citizenship');
       reg_contactno = $('#reg_contactno');
       reg_email = $('#reg_email');
       reg_address = $('#reg_address');
       
       //EM
       reg_emName = $('#reg_emName');
       reg_emContact = $('#reg_emContact');
       
       //INIT jQuery
       $('#reg-button').prop('disabled', false);
        
    });
    
   
   
   //Register New User 
   window.RegisterStudent = function (){
     
       if(reg_password.val() === "" || reg_repassword.val() === ""){
            swal('Empty Fields', 'Password Fields is Empty', 'warning');
       }else if(reg_password.val().length < 6){
            swal('Invalid', 'Password must be greater than six(6)','warning');
       }else if(reg_password.val() != reg_repassword.val()){
            swal('Missed Matched', 'Password Missed Matched', 'warning');
       }else if(reg_dob.val() === ""){
            swal('Empty Field', 'Date of Birth is Empty', 'warning');
       }else if(reg_dob.val().split('-')[0] > 2005){
            swal('Invald!', 'Birthday must be less than 2005', 'warning');
       }else if(reg_dob.val().split('-')[0]  < 1950){
            swal('Invald!', 'Birthday must be greater than 1950', 'warning');
       }else if(reg_gender.val() === ""){
            swal('Empty Field', 'Gender is Empty', 'warning');
       }else if(reg_citizenship.val() === ""){
            swal('Empty Field', 'Citizenship is Empty', 'warning');
       }else if(reg_contactno.val() === ""){
            swal('Empty Field', 'Contact No. is Empty', 'warning');
       }else if(reg_contactno.val().length !== 11){
            swal('Invalid', 'Number must be 11 characters!', 'warning');      
        }else if(reg_email.val() === ""){
            swal('Empty Field', 'Email Address is Empty', 'warning');
       }else if(reg_address.val() === ""){
            swal('Empty Field', 'Address is Empty', 'warning');
       }else if(app.validateEmail(reg_address.val())){
            swal('Invalid', 'Invalid Email!', 'warning');  
       }else if(reg_emName.val() === ''){
            swal('Empty Field', 'Emergency Contact Name is Empty', 'warning');
       }else if(reg_emContact.val() === ''){
            swal('Empty Field', 'Emergency Contact Number is Empty', 'warning');
       }else if(reg_emContact.val().length != 11){
            swal('Invalid', 'Emergency Contact Number must be 11 chaaracter', 'warning');
       }else{
           var data = {
                regnewstud : 'registerednewstudent',
                password : reg_password.val(),
                studno : reg_studno.val(),
                dob : reg_dob.val(),
                gender : reg_gender.val(),
                citizenship : reg_citizenship.val(),
                contactno : reg_contactno.val(),
                email : reg_email.val(),
                address : reg_address.val(),
                emName : reg_emName.val(),
                emContact : reg_emContact.val()
           };
           app.ajaxRequest(url, '', data, function (e){
                setTimeout(function(){
                        $('body').removeClass('smsload');
                        if(e.toString() === 'saved'){
                            swal('Registered', 'Successfuly Registered', 'success');
                            ClearRegisteredFields();
                            window.location.refresh;
                        }else if(e.toString() === 'registered'){
                            swal('Registered', 'You Student No is Already Registered', 'warning');
                            ClearRegisteredFields();
                        }
                },timeOut);
           },true);
       }
   };
   
   //Check Student #
   window.CheckStudentNo = function (){
       if(reg_studno.val() === ""){
            swal('Empty Field', 'Student No. is Empty', 'warning');
       }else{
           var data = {
                chckstudno : 'checksutdno',
                studno : reg_studno.val()
           };
           app.ajaxRequest(url,'json',data,function (e){
              //console.log(e) ;
                setTimeout(function(){
                    $('body').removeClass('smsload');
                        if(e === null){
                            swal('Not Exist', 'Student No. does not Exist, Please Enter Another Student No.', 'warning');
                            reg_studno.val('');
                        }else{
                              $('#reg-button').prop('disabled', false);
                              reg_name.val(e.stud_lastname + ' '+ e.stud_firstname+' '+e.stud_middlename);
                        }
                },timeOut);
           },true);
       }
   };
   
   //LOGIN USER=================================================================
   window.loginUser = function (){
       if(userid.val() === ""){
            swal('Empty Field(s)', 'User ID is Empty!', 'warning');
       }else if(password.val()=== ""){
            swal('Empty Field(s)', 'Password is Empty!', 'warning');
       }else{
           var data = { loginuser : 'loginuser', userid : userid.val(), password : password.val()};
           app.ajaxRequest(url,'',data,function(data){
               console.log(data);
                setTimeout(function (){
                    $('body').removeClass('smsload');
                     if(data.toString() === "success"){
                        document.location.href = "index";
                    }else if(data.toString() === "notapproved"){
                        swal('Not Approved', 'You\'re Account is not yet Approve by the Admin or Not Active', 'error');
                    }else if(data.toString() === 'notactive'){
                        swal('Not Active', 'Your Account is Not Active', 'error');
                    }else{
                        swal('Login', 'Login Failed', 'error');
                        console.log(data);
                    }
                },timeOut);
           },true);
       }
   };
   
   var ClearRegisteredFields = function (){
        reg_studno.val('');
        reg_password.val('');
        reg_repassword.val('');
        reg_name.val('');
        reg_dob.val('');
        reg_gender.val('');
        reg_citizenship.val('');
        reg_contactno.val('');
        reg_email.val('');
        reg_address.val('');
        reg_emName.val('');
        reg_emContact.val('');
   };
       
});


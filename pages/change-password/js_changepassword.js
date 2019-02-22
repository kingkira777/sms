/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function (){
   "use strict";
   var url = "pages/change-password/changepassword.class.php";
   
   var currpass, newpass, repass = "";
   
   $(document).ready(function (){
       
       currpass = $('#cur_passwrod');
       newpass = $('#cur_newpass');
       repass = $('#cur_repass');
       
   });
   
   //CHANGE PASSWORD
   window.ChangePassword = function (){
      console.log(currpass.val());
       if(currpass.val() === ""){
            swal('Empty', 'Current Password is Empty', 'warning');
       }else if(newpass.val() === ""){
            swal('Empty', 'New Password is Empty', 'warning');
           
       }else if(repass.val() === ""){
            swal('Empty', 'Re-type Password is Empty', 'warning');
           
       }else if(newpass.val() !== repass.val()){
            swal('Empty', 'Password Not Matched!', 'warning');
       }else{
            var data = { changpass: 'cahgnepassowrd', userid: app.userLogin().userno, currpass: currpass.val(), newpass: newpass.val()  };
            app.ajaxRequest(url,'',data,function (xdata){
               //console.log(xdata);
               setTimeout(function(){
			$('body').removeClass('smsload');
			if(xdata.toString() === "updated"){
                            swal('Updated!', 'Password Successfuly Updated!','success');
                        }else if(xdata.toString() === "notfound"){
                             swal('Warning!', 'Password Not Found !','warning');
                        }
                        currpass.val('');
                        newpass.val('');
                        repass.val('');
		},timeOut);
            },true);
       }
   };
   
});


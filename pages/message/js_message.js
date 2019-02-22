/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function(){
   "use strict";
   var url = "pages/message/message.class.php";
   
   var uid_from, uid_to, message, rypli_message = "";
   
   
   var userno, id = "";
   
   $(document).ready(function(){
       
       
       uid_from = $('#m_from');
       uid_to = $('#m_to');
       message = $('#m_message');
       
       
       //RYply
       rypli_message = $('#m_rplymessage');
       
       $('.selectSelect').select2({
           tags:false,
           width: '100%',
           placeholder : 'Enter Name',
           allowClear: true,
       });
       
       $('#btnrp').prop('disabled',true);
       
       //CALL FUNCTIONS
        GetRecipent();
        setInterval(function (){
            MessageNotifications();
            viewMessage(id);
            getMyMessage();
            getSentItems();
        },1500);
   });
   
   
   
   //GET NOTIFICATIONS
   var MessageNotifications = function (){
        var data = { mnots : 'getnotifications', userno : app.userLogin().userno };
        app.ajaxRequest(url,'',data,function (xdata){
           //console.log(xdata); 
           $('#mnoti').html(xdata);
        });
   };
   
   
   //DELETE MESSAGE
   window.DeleteMessage = function (_id){
       app.messegeAlert("DELETE", "Are you sure you want to Delete this Message?", "warning", function(istrue){
           if(istrue === true){
               var data = { dmessage: 'deletemessage', mid: _id };
               app.ajaxRequest(url, '', data, function (xdata){
                  console.log(xdata); 
                  if(xdata.toString() === "deleted"){
                        swal('DELETED', 'Successfuly Deleted!', 'success');
                        GetRecipent();
                        getMyMessage();
                        getSentItems();
                  }
               });
           }
       });
   };
   
   //SEND REPLY MESSAG
   window.replyMessage = function (){
       var data = { rpmessage : 'rplymessage', id : id, me : uid_from.val(), message: rypli_message.val(), userno : app.userLogin().userno };
       app.ajaxRequest(url,'',data,function(xdata){
           //console.log(xdata);
           viewMessage(id);
           rypli_message.val('');
           scrollDiv();
       });
   };
   
   var scrollDiv = function (){
      $("#chat-box").animate({ scrollTop: $('#chat-box').height() + 10000}, 1000);  
   };
   
   //VIEW MESSAGE
   window.viewMessage = function(_id){
       id = _id;
       var data = { vmessage : 'viewmessage', userno : app.userLogin().userno, id: id };
       app.ajaxRequest(url,'',data,function(xdata){
           $('#chat-box').html(xdata);
           $('#btnrp').prop('disabled',false);
           scrollDiv();
           
       });
   };
   
   
   //GET MY SENT ITEMS
   var getSentItems = function (){
       
       var data = { gsentitems : 'getsentitems', name : uid_from.val(), userno: app.userLogin().userno};
       app.ajaxRequest(url,'',data,function(xdata){
          $('#mysenitems').html(xdata);
       });
   };
   
   //GET MY MESSAGE
   var getMyMessage = function (){
//       console.log(app.userLogin().userno);
        var data = { gmessage: 'getmymessage', myid : app.userLogin().userno};
        app.ajaxRequest(url,'',data,function(xdata){
           //console.log(xdata);
           $('#myinbox').html(xdata);
        });
   };
   
   //SEND MESSAGE
   window.sendNewMessage = function (){
        if(uid_to.val() === null){
            swal('Empyt!', 'Recipient is Empty!','warning');
       }else{
          
           var data = { smessage: 'sendmessage', from : uid_from.val(), to: uid_to.val()[0], message : message.val() };
           app.ajaxRequest(url,'',data,function(xdata){
               //console.log(xdata);
               setTimeout(function(){
			$('body').removeClass('smsload');
			if(xdata.toString() === "send"){
                            swal('Send Message','xdata','success'); 
                            message.val('');
                            getSentItems();
                        }
		},timeOut);
           },true);
           
       }
   };
   
   
   //GET RECIPIENT ============================================================
   var GetRecipent = function (){
        var data = { greciepent : 'getallusers', me : app.userLogin().userno };
        app.ajaxRequest(url,'',data,function(xdata){
            //console.log(xdata);
            $('#m_to').html(xdata);
        });
   };
   
});


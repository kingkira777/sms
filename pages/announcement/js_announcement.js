/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function(){
   "use strict";
   var url = "pages/announcement/announcement.class.php";
   
   var  id, title, content = "";
   
   
   $(document).ready(function (){
       

       title = $('#an_title');
       content = $('#an_content');
       
       //Init
       
       
       //Functions
       getAnnouncement();
       
       $('#an_btnDelete').prop('disabled',true);
       
   });

   //Delete Announcement
   window.deleteAnnouncement = function(anid){
       app.messegeAlert('Delete', 'Are you sure you want to Delete this announcement?', 'warning',function(istrue){
           if(istrue){
               var data = { dannounce : 'deleteannoucement', anid : anid };
               app.ajaxRequest(url,'',data,function(xdata){
                    //console.log(xdata);
                    setTimeout(function(){
			$('body').removeClass('smsload');
			if(xdata.toString() ===  "deleted"){
                            swal('Delete', 'Successfuly Deleted!','success');
                            getAnnouncement();
                            ClearAnnouncemnet();
                        }
                    },timeOut);
               },true);
           }
       });
   };
    
   //Get Announcemnet List
   window.getAnnouncement = function (){
       var data = { gan : 'getannouncement', priv : app.userLogin().privilage };
       app.ajaxRequest(url,'',data,function(xdata){
           setTimeout(function(){
                $('body').removeClass('smsload');
		$('#announcement_content').html(xdata);	
           },timeOut); 
       },true);
   };
   
   
   //EDIT ANNOUNCEMENT
   window.EditAnnouncement = function (anid){
       var data  = { editan: 'editannouncement', anid: anid};
       app.ajaxRequest(url,'json',data,function (xdata){
           //console.log(xdata);
           setTimeout(function(){
		$('body').removeClass('smsload');
                id = xdata.an_id;
                title.val(xdata.an_title);
                content.val(xdata.an_content);
                app.activeTab('auannouncement');
            },timeOut);
       },true);
   };
   
   //Save Update Announcement
   window.saveUpdateAnnouncement = function (){
       if(title.val() === ""){
            swal('Empty', 'Title is Empty', 'warning');
       }else if(content === ""){
            swal('Empty', 'Content is Empty', 'warning');
       }else{
            
            var data = {
              suannouncement : 'saveupdateannouncement',
              id : id,
              userid : app.userLogin().userno,
              title : title.val(),
              content : content.val()
            };
            
            app.ajaxRequest(url,'',data,function(xdata){
                //console.log(xdata);
                setTimeout(function(){
			$('body').removeClass('smsload');
			if(xdata.toString() === "saved"){
                            swal('Save', 'Successfuly Saved!', 'success');
                            getAnnouncement();
                            app.activeTab('announcement');
                        }else if(xdata.toString() === "updated"){
                            swal('Updated!', 'Successfuly Udpated!', 'success');
                            getAnnouncement();
                            app.activeTab('announcement');
                        }else if(xdata.toString() === "existed"){
                            swal('Save', 'Title is Already Exist!', 'warning');
                        }else{
                            swal('Error', 'Failed to Save', 'error');
                        }
                        ClearAnnouncemnet();
		},timeOut);
            },true);
       }
   }
   
   window.ClearAnnouncemnet = function (){  
       id = "";
       title.val('');
       content.val('');
   };
  
});


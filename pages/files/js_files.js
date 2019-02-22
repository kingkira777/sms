/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function(){
   "use strict"; 
   var url = "pages/files/file.class.php";
   
   $(document).ready(function(){
       
       
       //FUNCTIONS
       UploadFiles();
       GetFileList();
   });
   
   //DELETE FILE
   window.deleteFile = function(fid){
     app.messegeAlert('Delete?', 'Are you sure you want to Delete this File?', 'warning',function(istrue){
         if(istrue){
             var data = { dfile: 'deletefiles', fid: fid };
             app.ajaxRequest(url,'',data,function(xdata){
           //      console.log(xdata);
                setTimeout(function(){
			$('body').removeClass('smsload');
			if(xdata.toString() === "deleted"){
                            swal('Deleted', 'Successfuly Deleted', 'success');
                            GetFileList();
                        } 
		},timeOut);
             },true);
         }
     });
       
       
   };
   
   
   //GET FILE LIST
   var GetFileList = function(){
       var data = { gfilelist : 'getfilelist', secid : $('#secid').val()};
       app.ajaxRequest(url,'json',data,function(xdata){
          //console.log(xdata); 
          app.filesTable(xdata);
       });
   };
   
  
   //UPLOAD FILES
   var UploadFiles = function (){
       $('#uploadfiles').dmUploader({
			method: 'post',
			url: 'pages/files/uploadfiles.php',
			maxFileSize: 10000000, //10mb
			extFilter:["pdf", "doc", "docx", "xlsx", "xls", "xlc", "png", "jpg", "jpeg", "gif", "bmp" ],
			onDragEnter: function(){
			  // Happens when dragging something over the DnD area
			  this.addClass('active');
			},
			extraData: function(){
				return{
					"studno": app.userLogin().userno,
                                        "section" : $('#secid').val()
				};
			},
			onInit: function(){
				console.log('Callback: Plugin initialized');
			  },
			onComplete: function(){
			  // All files in the queue are processed (success or error)
			 // console.log('All pending tranfers finished');
			},
			
			onNewFile: function(id, file){
			  // When a new file is added using the file selector or the DnD area
			/*  console.log('New file added #' + id);
			  console.log(id, file);*/
			},
			onBeforeUpload: function(id){
                            $('body').addClass('smsload');
			  // about tho start uploading a file
			 /*  console.log('Starting the upload of #' + id);
			   console.log(id, 'uploading', 'Uploading...');
			   console.log(id, 0, '', true);*/
			},
			onUploadProgress: function(id, percent){
			  // Updating file progress
			  //console.log(id, percent);
			},
			onUploadSuccess: function(id, data){
			  // A file was successfully uploaded
			  /*console.log('Server Response for file #' + id + ': ' + JSON.stringify(data));
			  console.log('Upload of file #' + id + ' COMPLETED', 'success');
			  console.log(id, 'success', 'Upload Complete');
			  console.log(id, 100, 'success', false);*/
                          
                          setTimeout(function(){
                                    $('body').removeClass('smsload');
                                     GetFileList();
                            },timeOut);
			 
			},
			onUploadError: function(id, xhr, status, message){
			 /* console.log(id, 'danger', message);
			  console.log(id, 0, 'danger', false);  */
			},
			onFallbackMode: function(){
			  // When the browser doesn't support this plugin :(
			//  console.log('Plugin cant be used here, running Fallback callback', 'danger');
			}
		});
       
   };
   
});


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function (){
   "use strict";
   var url = "pages/options/options.class.php";
   
   //Couser Var
   var c_id, c_name = "";
   
   //Subject Var
   var sub_id, courseList, sub_code, sub_des, sub_units = "";
   
   //Section Var
   var sec_id, sec_courseid, sec_course, sec_name = "";
   
   //Year
   var year_id, year_from, year_to = "";
   
   
   $(document).ready(function(){
       
       c_name = $('#c_name');
       
       
       courseList = $('#courseList');
       sub_code = $('#sub_code');
       sub_des = $('#sub_des');
       sub_units = $('#sub_units');
       
       sec_course = $('#sec_courseid');
       sec_name = $('#sec_name');
       
       year_from = $('#year_from');
       year_to = $('#year_to');
       
       
       
       //FUNCTIONS
       getCourseList();
       getCourseSelectList();
       
       GetSectionSelectList();
       
       getYearTableList();
       getYearSelectList();
       GetCurrentYear();
 
       
   });
    
//=======================YEAR==============================================//
    
  var GetCurrentYear = function (){
        var today = new Date();
        var yy = today.getFullYear();
        var yyto = yy + 1;
        year_from.val(yy);
        year_to.val(yyto);
  };
    

  //Delete Year
  window.deleteYear = function (yid){
       app.messegeAlert('Delete','Are you sure you want to Delete this year?','warning',function(istrue){
            if(istrue){
                var data = { dyear : 'deleteyear', yid: yid};
                app.ajaxRequest(url,'',data,function(xdata){
                    setTimeout(function(){
			$('body').removeClass('smsload');
			if(xdata.toString() === "deleted"){
                            swal('Deleted', 'Successfuly Deleted', 'success');
                            getYearTableList();
                            getYearSelectList();
                        }else{
                            swal('Error', 'Failed to Delete', 'error');
                        }
                    },timeOut);
                },true);
            }
       });
      
  };

 //Get Year Table List
 window.getYearTableList = function (){
     var data ={ gyeartablelist : 'getyeartablelsit' };
     app.ajaxRequest(url,'json',data,function(xdata){
        app.yearTable(xdata);
     });
 };
 
 //Get Year Select List
 window.getYearSelectList = function(){
     var data = { gyearselectlist : 'getyearselectlist'};
     app.ajaxRequest(url,'',data,function(xdata){
         //console.log(xdata);
         $('#s_year').html(xdata);
         $('#regs_year').html(xdata);
     });
 };
 
 window.EditYear = function (yid){
    var data = { edityear : 'edityear', yid: yid };
    app.ajaxRequest(url,'json',data,function (xdata){
        setTimeout(function(){
            $('body').removeClass('smsload');
            year_id = xdata.id;
            year_from.val(xdata.yfrom);
            year_to.val(xdata.yto);
	},timeOut);
    },true);
    
 };
 
 //Save Year
 window.saveYear = function (){
     if(year_from.val() === "" || year_to.val() === ""){
         swal('Empty Field', 'Some Field(s) is Empty!', 'warning');
     }else if(year_from.val().length != 4 ){
         swal('Warning', 'Invalid Year (From)!', 'warning'); 
     }else if(year_to.val().length != 4 ){
         swal('Warning', 'Invalid Year (To)!', 'warning'); 
     }else if(Number(year_from.val()) >= Number(year_to.val())){
         swal('Warning', 'Year From must be less than from year_to!', 'warning'); 
     }else{
         
         var cyear = year_from.val()+"-"+year_to.val();
         var data = { syear : 'saveyear', yid: year_id, cyear : cyear };
         app.ajaxRequest(url,'',data,function(xdata){
             //console.log(xdata);
            setTimeout(function(){
                $('body').removeClass('smsload');
                if(xdata.toString() === "saved"){
                    swal('Saved', 'Successfuly Saved!', 'success');
                    getYearTableList();
                    getYearSelectList();
                }else if(xdata.toString() === "existed"){
                       swal('Warning', 'Year Already Existed!', 'warning');
                       getYearTableList();
                       getYearSelectList();

                }else if(xdata.toString() === "updated"){
                       swal('Updated', 'Successfuly Updated!', 'success');
                       getYearTableList();
                       getYearSelectList();
                }else{
                      swal('Error', 'Failed to Saved!', 'error');
                }
                year_id = "";
                year_from.val('');
                year_to.val('');
            },timeOut);
         },true);
         
     }
 };
 
//=======================SECTIONS==============================================//
   
   //Delete Section
   window.DeleteSection = function (secid){
        app.messegeAlert('Delete', 'Are you sure you want to Delete this Section?', 'warning',function(istrue){
            if(istrue){
                var data = { dsection : 'deletesection', secid : secid};
                app.ajaxRequest(url,'',data,function(xdata){
                    //console.log(xdata);
                    setTimeout(function(){
			$('body').removeClass('smsload');
                        if(xdata.toString() === "deleted"){
                            swal('Deleted', 'Successfuly Deleted', 'success');
                            GetSectionTableList(sec_courseid);
                            GetSectionSelectList();
                        }
                    },timeOut);
                },true);
            }
        });
   };
   
   //Get Section Table List
   window.GetSectionTableList = function (cid){
      sec_courseid = cid;
       var data = { gsectabellist : 'getsectiontablelsit', courseid : cid };
       app.ajaxRequest(url,'json',data,function(xdata){
           //console.log(xdata);
           app.sectionTable(xdata);
       });
   }
   
   
   //Get Section Select List
   window.GetSectionSelectList = function (cid){
       var data = { gsecselectlist : 'getselectlist', cid : cid };
       app.ajaxRequest(url,'',data,function(xdata){
           //console.log(xdata);
           $('#s_section').html(xdata);
           $('#sched_section').html(xdata);
       });
       
   };
   
   window.EditSection = function (secid){
       var data = { editsec: 'editsection', secid: secid };
       app.ajaxRequest(url,'json',data,function (xdata){
          //console.log(xdata); 
            setTimeout(function(){
                $('body').removeClass('smsload');
		sec_id = xdata.sec_id;
                sec_name.val(xdata.sec_name);	
            },timeOut);
       },true);
   };
   
   //save section
   window.saveSection = function (){
        if(sec_name.val() === ""){
             swal('Empty Field', 'Subject name is Empty!', 'warning');
        }else{
            var data = { savesec : 'savesection', secid: sec_id, sec_course :sec_course.val(), sname : sec_name.val() };
            app.ajaxRequest(url,'',data,function(xdata){
                //console.log(xdata);
                setTimeout(function(){
                    $('body').removeClass('smsload');
                    if(xdata.toString() === "saved"){
                        swal('Saved', 'Successfuly Saved!', 'success');
                        GetSectionTableList(sec_courseid);
                        GetSectionSelectList(sec_courseid);
                    }else if(xdata.toString() === "existed"){
                        swal('Existed', 'Section Name is Already Exist!', 'warning');
                    }else if(xdata.toString() === "updated"){
                        swal('Updated!', 'Successfuly Updated!', 'success');
                        GetSectionTableList(sec_courseid);
                        GetSectionSelectList(sec_courseid);
                    }else if(xdata.toString() === "limit"){
                        swal('Limit Exceed', 'Section Limit Exceed!', 'warning');
                    }else{
                        swal('Save', 'Failed to Saved!', 'error');
                    }
                    sec_id = "";
                    sec_name.val('');
		},timeOut);
            },true);
       }
       
   };
//=======================SUBJECT==============================================//
   
   //Delete Subject
   window.deleteSubject = function (sid,cid){
       app.messegeAlert('Delete', 'Are you sure you want to Delete this Subject?', 'warning',function(istrue){
           if(istrue){
               var data = { dsubject : 'deletesubject', sid : sid};
                app.ajaxRequest(url,'',data,function(xdata){
                    //console.log(xdata);
                    setTimeout(function(){
			$('body').removeClass('smsload');
			if(xdata.toString() === "deleted"){
                            swal('Deleted', 'Successfuly Deleted', 'success');
                            getSubjectList(cid);
                        }
                    },timeOut);
                },true);
           }
       });
       
   };
   
   
   window.EditSubject = function (subid){
     
       var data = { editsub: 'editsubject', subid: subid };
       app.ajaxRequest(url,'json',data,function (xdata){
          //console.log(xdata); 
            setTimeout(function(){
                $('body').removeClass('smsload');
                sub_id = xdata.sub_id;
                courseList.val(xdata.sub_courseid);
                sub_code.val(xdata.sub_code);
                sub_des.val(xdata.sub_description);
                sub_units.val(xdata.sub_units);
            },timeOut);
       },true);
       
   };
   
   
   //Save subject
   window.saveSubject = function (){
       if(courseList.val() === "" || sub_code.val() === "" || sub_des.val() === ""){
            swal('Empty Fields', 'Some Field(s) is Empty!', 'warning');
       }else if(sub_units.val().length > 1){
           swal('Invalid Input', 'Unit(s) must be less than two characters', 'warning');
       }else{
          
          var data = {
                savesubject : 'savesubject',
                subid: sub_id,
                courseid : courseList.val(),
                subcode :sub_code.val(),
                subdes : sub_des.val(),
                subunits : sub_units.val()
           };
           
           app.ajaxRequest(url, '', data, function(xdata){
              //console.log(xdata);
                setTimeout(function(){
			$('body').removeClass('smsload');
                        if(xdata.toString() === "saved"){
                            swal('Save', 'Successfuly Saved!', 'success');
                            getSubjectList(courseList.val());
                           clearSubjectField();
                        }else if(xdata.toString() === "existed"){
                            swal('Existed', 'Subject Code is Already Exist!', 'warning');
                            clearSubjectField();
                        }else if(xdata.toString() === "updated"){
                            swal('Updated!', 'Successfuly Updated!', 'success');
                            getSubjectList(courseList.val());
                           clearSubjectField();
                        }
                },timeOut);
           },true);
       }
       
   };
   
   //get table subject list
   window.getSubjectList = function (courseid){
      var data = { gsublist : 'getsubjectlist', cid : courseid };
      app.ajaxRequest(url, 'json', data, function(xdata){
            //console.log(xdata);
            app.subjectTable(xdata);
      });
      
   };
   
   var clearSubjectField = function (){
       sub_id = "";
       courseList.val('');
       sub_code.val('');
       sub_des.val('');
       sub_units.val('');
   };
   
   
//=======================COURSE==============================================//
    
    //SELECT Course and Get Subject//
    window.selectCourse = function (cid){
        var data = { selectcourse : 'selectcourse', cid : cid };
        app.ajaxRequest(url,'',data,function(xdata){
           $('#sched_subject').html(xdata);
        });
    };
    
    
    
    
    //DELETE COURSE===/
    window.deleteCourse = function(cid){
        app.messegeAlert('Delete', 'Are you sure you want to Delete this Course?', 'warning',function(istrue){
            if(istrue){
                var data = { dcourse: 'deletecourse', cid: cid };
                app.ajaxRequest(url,'',data,function(xdata){
                    setTimeout(function(){
			$('body').removeClass('smsload');
                        if(xdata.toString() === "deleted"){
                            swal('Deleted', 'Successfuly Deleted', 'success');
                            getCourseList();
                            getCourseSelectList();
                        }
                    },timeOut);
                },true);
            }
        });
    };
    
    
   window.EditCourse = function (cid){
       var data = { editcourse: 'editcourse', cid: cid };
       app.ajaxRequest(url,'json',data,function(xdata){
          //console.log(xdata);
            setTimeout(function(){
                $('body').removeClass('smsload');
                c_id = xdata.c_id;
                c_name.val(xdata.c_name);
            },timeOut);
       },true);
   };
    
    //SAVE COURSE===/
    window.saveCourse = function (){
        if(c_name.val() === ""){
            swal('Empty Field', 'Course name is Empty!', 'warning');
        }else{
            var data = {  scourse : 'savecourse', cid : c_id, cname: c_name.val() };
            app.ajaxRequest(url,'',data,function(xdata){
                //console.log(xdata);
                setTimeout(function(){
			$('body').removeClass('smsload');
                        if(xdata.toString() === "existed"){
                            swal('Existed', 'Course Already Exist!', 'warning');
                        }
                        if(xdata.toString() === "saved"){
                            swal('Saved', 'Successfuly Saved!', 'success');
                            getCourseList();
                            getCourseSelectList();
                        }
                        if(xdata.toString() === "updated"){
                            swal('Updated!', 'Successfuly Updated!', 'success');
                            getCourseList();
                            getCourseSelectList();
                        }
                        c_id = "";
                        c_name.val('');
		},timeOut);
            },true);
        }
    };
    
    //GET COURS TABLE LIST===/
    var getCourseList = function (){
        var data = { gclist : 'getcourselist' };
        app.ajaxRequest(url,'json',data,function(xdata){
            app.courseTable(xdata);
        });
    };
    
    //GET COURSE SELECT LIST
    var getCourseSelectList = function(){
        var data = { gcselectlist : 'getcourselist' };
        app.ajaxRequest(url,'',data,function(xdata){
            //console.log(xdata);
            $('#courseList').html(xdata);
            $('#s_course').html(xdata);
            $('#sched_course').html(xdata);
           $('#sec_courseid').html(xdata);
           $('#regs_course').html(xdata);
        });
    };
    
    
});


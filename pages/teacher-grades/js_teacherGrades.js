/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function(){
   "use strict";
   var url = "pages/teacher-grades/teacherGrades.class.php";
   
   var gid, gstudno, gname, gcourse, gsubject, gsemester, gquarter, ggrade, gteacher;
   
   var h_studno, s_studno, s_subject;
   
   $(document).ready(function(){
       
       gstudno = $('#g_studno');
       gname = $('#g_name');
       gcourse = $('#g_course');
       gsubject = $('#g_subject');
       gsemester = $('#g_semester');
       gquarter = $('#g_quarter');
       ggrade = $('#g_grade');
       
       s_studno = $('#s_studno');
       s_subject = $('#s_subject');
       
   });
  
  
  //GRADES COMPUTATION========================================================
  
  
    //COMPUTE STUDENT GRADES
    window.ComputeStudentGrades = function (subject){
        if(subject === ''){}else{
            var data = {
                cgrades : 'computestudnetgrades',
                studno : s_studno.val(),
                subject : subject
            };
            app.ajaxRequest(url,'json',data,function (e){
               //console.log(e[0].average);
               setTimeout(function(){
			$('body').removeClass('smsload');
                        if(e[0].average === undefined){
                            app.teacherGrades([]); 
                            $('#g_average').html('');
                        }else{
                            app.teacherGrades(e[0].info); 
                            if(e[0].hasave == 'true'){
                                var ispass = (e[0].average >= 75)? 'PASSED' : 'FAILED';
                                $('#g_average').html(e[0].average + ' ' + ispass);
                            }else{
                                $('#g_average').html('');
                            }
                        }
		},timeOut);
            },true);
        }
    };
  
    //GET STUDENT SUBJECT BY STUDNO
    window.GetStudentSubjectByStudno = function (){
         if(s_studno.val() === ""){
            swal('Empty Field', 'Studnet No is Empty', 'warning');
         }else{
             var data = {
                 gsub : 'getsubject',
                 studno : s_studno.val()
             };
             app.ajaxRequest(url, '', data, function (e){
//                console.log(e); 
                s_subject.html(e);
             });
         }
    };
  
  
  //GRADES COMPUTATION========================================================
   
   
   
      //DELETE STUDENT GRADE
      window.DeleteStudentGrade = function (_gid){
          app.messegeAlert('Delete Grade', 'Are you sure you want to Delete this Grade?', 'warning', function (x){
              if(x === true){
                  var data = {
                        dgrade : 'deletestudentgrade',
                        gid : _gid
                    };
                    app.ajaxRequest(url,'',data,function (e){
                       //console.log(e);
                       setTimeout(function(){
                            $('body').removeClass('smsload');
                            if(e.toString() === 'deleted'){
                                swal('Deleted', 'Student Grade Successfuly Deleted!', 'success');
                                GetStudentGrades(h_studno);
                            }
                        },timeOut);
                    },true);
              }
          })
      };
      
     //EDIT GRADES
     window.EditStudentGrades = function (_gid){
         gid = _gid;
        if(_gid === ''){}else{
            var data = {
                editgrade : 'editstudentgrade',
                gid : gid
            };
            app.ajaxRequest(url,'json',data,function (e){
               //console.log(e);
               setTimeout(function(){
			$('body').removeClass('smsload');
			gsubject.val(e.g_subject);
                        gsemester.val(e.g_semester);
                        SelectSemester(e.g_semester);
                        ggrade.val(e.g_grade);	
		},timeOut);
            },true);
        }
     };
     
     //GET STUDENT GRADES
     var GetStudentGrades = function (stno){
            var data = {
                gstudentgrades : 'getstudentgrades',
                teacher : app.userLogin().userno,
                studno : stno
            };
            
            app.ajaxRequest(url,'json',data,function (e){
               console.log(e);
               app.teacherGrades(e);
            });
      };
   
      //SAVE UPDATE STUDENT GRADE
      window.SaveUpdateStudentGrade = function (){
          if(gstudno.val() === ''){
              swal('Empty Field', 'Student No. is Empty', 'warning');
          }else if(gsubject.val() === ''){
              swal('Empty Field', 'Subject is Empty', 'warning');
          }else if(gsemester.val() === ''){
              swal('Empty Field', 'Semester is Empty', 'warning');
          }else if(gquarter.val() === ''){
              swal('Empty Field', 'Quarter is Empty', 'warning');
          }else if(ggrade.val() === ''){
              swal('Empty Field', 'Grade is Empty', 'warning');
          }else if(ggrade.val() < 50){
              swal('Min', 'Grade must be 50 above', 'warning');
          }else if(ggrade.val() > 100){
              swal('Min', 'Grade must be less than 100', 'warning');
          }else if(ggrade.val().length > 5){
              swal('Max length', 'Grade must be less than Four(4) Character', 'warning');
          }else{
           var data = {
                sugrades : 'saveudpatestudentgrade',
                gid : gid,
                studno : gstudno.val(),
                subject : gsubject.val(),
                semester : gsemester.val(),
                quarter : gquarter.val(),
                grade : ggrade.val(),
                teacher : app.userLogin().userno
            };
            
            app.ajaxRequest(url,'',data,function (e){
               console.log(e);
               setTimeout(function(){
			$('body').removeClass('smsload');
                        if(e.toString() === 'existed'){
                            swal('Existed', 'Student Grades is Already Existed', 'warning');
                        }
                        if(e.toString() === 'saved'){
                            swal('Saved', 'Successfuly Saved!', 'success');
                            GetStudentGrades(h_studno);
                        }
                        if(e.toString() === 'updated'){
                            swal('Updated', 'Successfuly Updated!', 'success');
                            GetStudentGrades(h_studno);
                        }
                        
                        if(e.toString() === 'cancel'){
                            swal('Invalid Quarter', 'Quarter must be ordered!', 'warning');
                            GetStudentGrades(h_studno);
                        }
		},timeOut);
            },true);
          }
      };
  
      //CHECK STUDENT NO
      window.Grade_CheckStudentNo = function (){
          h_studno = gstudno.val();
          if(gstudno.val() === ""){}else{
              GetStudentGrades(h_studno);
              var data = {
                    chkstudno : 'checkstudentno',
                    studno : gstudno.val()
              };
              app.ajaxRequest(url,'json',data,function (e){
                  setTimeout(function(){
			$('body').removeClass('smsload');
			if(e === null){
                            swal("Not Found", "Student Number Not Found!", 'warning');
                        }else{
                           gname.val(e.stud_lastname+' '+e.stud_firstname+' '+e.stud_middlename);
                           gcourse.val(e.c_name);
                           GetSubjectList(e.c_id);
                        }
		},timeOut);
              },true);
          }
      };
  
  
    
    //GET SUBJECT LIST
    var GetSubjectList = function (cid){
        if(cid === ''){}else{
            var data = {
                gsubject : 'getsubject',
                cid :cid
            };
            app.ajaxRequest(url,'',data,function (e){
               //console.log(e) ;
               gsubject.html(e);
            });
        }
    };
  
     //SELECT SEMESTER
     window.SelectSemester = function (sem){
        var q1 = '<option value="q1">Quarter 1</option>'+
                 '<option value="q2">Quarter 2</option>';
        var q2 = '<option value="q3">Quarter 3</option>'+
                 '<option value="q4">Quarter 4</option>';
        if(sem === ''){
            gquarter.html('');
        }else{
            
            if(sem === 'sem1'){
                gquarter.html(q1);
            }else if(sem === 'sem2'){
                gquarter.html(q2);
            }
        }
    };
    
    window.ClearGradesFields = function (){
      // gstudno.val('');
       gid = '';
       gname.val('');
       gcourse.val('');
       gsubject.val('');
       gsemester.val('');
       gquarter.val('');
       ggrade.val('');
    };
    
   
});


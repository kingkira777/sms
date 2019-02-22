/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function(){
   "use strict";
   var url = "pages/student-grades/studentgrades.class.php";
   
   var m_subject;
   
   $(document).ready(function(){
       
      
      m_subject = $('#my_subject');
      
      
      
      GetMySubject();
   });
    
    
    
    
   //GET MY REMARKS
   window.GetMyRemarks = function (){
       var data = {
           gmyremarks : 'getmyremarks',
           studno : app.userLogin().userno
       };
       app.ajaxRequest(url,'',data,function (e){
          console.log(e);
            setTimeout(function(){
                $('body').removeClass('smsload');
                if(e.toString() === 'notcomplete'){
                    $('#myremakrs').html('Your Overall Subject Grades is not Complete');
                }else{
                    var es = e.split('++');
                    if(Number(es[0]) === 4){
                        var ispass = ' <i>All average grades are not yet completed</i>';
                    }else if(Number(es[0]) > 75){
                        var ispass = 'PASSED';
                    }else{
                        var ispass = 'FAILED';
                    }
                    var rm = 0;
                    if(Number(es[1]) < 4){
                        $('#myremakrs').html('');
                        var rm = 0;
                    }else{   
                        $('#myremakrs').html(es[0] +' : ' +ispass);
                        rm = es[0];
                    }
                    
                    if(rm === 0){
                    console.log('no');
                    }else{
                        var rmdata = {
                        oremarks : 'saveoverallremarks',
                        studno : app.userLogin().userno,
                        remarks : rm 
                        };
                        app.ajaxRequest(url,'',rmdata,function(xd){
                            console.log(xd);
                        });
                    }
                    
                }
            },timeOut);
       },true);
   };
   
   //GET MY GRADES
   window.GetMyGrades = function (subject){
       var data = {
            gmygrades : 'getmygrades',
            studno : app.userLogin().userno,
            subject : subject
       };
       app.ajaxRequest(url,'json',data,function (e){
           var average;
           console.log(e);
            setTimeout(function(){
                $('body').removeClass('smsload');
		if(e[0].average === undefined){
                    $('#my_average').html('');
                    app.studMyGradesTable([]);
                    average = 0;
                }else{
                    average = e[0].average;
                    app.studMyGradesTable(e[0].info);
                    var ispass = (e[0].average >= 75)? 'PASSED' : 'FAILED';
                    if(e[0].hasave == 'true'){
                         $('#my_average').html(e[0].average + ' ' + ispass);
                        average =  e[0].average;
                    }else{
                        average = 0;
                        $('#my_average').html(average + ' <i>all quarter grades are not yet completed</i>');
                    }
                    //console.log(e[0].info[0].);

                    if(average === 0){}else{
                    //SAVE FOR REMARKS
                        var rdata = {
                            sremarks : 'saveremarks',
                            studno : e[0].info[0].g_studno,
                            subject : e[0].info[0].sub_code,
                            year : e[0].info[0].stud_year,
                            average :  average
                        };
                        app.ajaxRequest(url,'',rdata,function(e){
                           console.log(e);
                        });
                  }
                }
            },timeOut);
       },true);
   };
   
   
   //GET MY SUBJECT LIST
   var GetMySubject = function (){
     var data = {
        gmysub : 'getmysubject',
        studno : app.userLogin().userno
     };
     app.ajaxRequest(url,'',data,function (e){
        //console.log(e); 
        m_subject.html(e);
     });
       
   };
   
    
});


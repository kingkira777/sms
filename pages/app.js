/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
window.timeOut = 1000;

window.app = {

    //GENERATE RANDOM 
    randomPassword : function (){
        var randomstring= Math.random().toString(36).slice(-8);
        return randomstring;
    },
    
    //VALIDATE EMAIL ADDRESS
    validateEmail : function(email){
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
        
    },
    
    
    //Notify Message
    notifyAlert : function (title, message, type){
       return $.notify({
            title: title,
            message: message
            },{
                    type: type
        });
    },
    
    
    //Active Tab
    activeTab : function (tabId){
      $('.tab-pane').removeClass('active');
      $('#'+tabId+'').addClass('active');
    },
    
    //ALERT MESSEGE
    messegeAlert : function (title,text,type,fnCallback){
        return swal({
                title: title,
                text: text,
                type: type,
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes",
                cancelButtonText: "No"
              },fnCallback);
    },
    
    //AJAX REQUESTs
    ajaxRequest : function(url, dataType, data, fnCallback,isload){
        return $.ajax({
            type : 'post',
            url : url,
            dataType: dataType,
            data : data,
            beforeSend: function (xhr) {
                if(isload){
                    $('body').addClass('smsload');
                }
            },
            success: fnCallback
        });
    },
    
    //CURRENT USER LOGIN
    userLogin : function(){
        var user = new Object();
        user['id'] = userid;
        user['userno'] = username;
        user['privilage'] = privilage;
        return user;
    },
    
    
    currentDate : function (){
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0!
        var yyyy = today.getFullYear();

        if (dd < 10) {
          dd = '0' + dd;
        }

        if (mm < 10) {
          mm = '0' + mm;
        }

        today = yyyy+'-'+mm+'-'+dd;
        return today;
    },
    
    
    
    
    
//TABLE========================================================================

    //STUDNET REGISTER TABLE==================================
    studentRegisterTable : function (data){
        $('#table-student-reg').DataTable({
            data : data,
            "createdRow" : function(row,data,dataIndex){
                    if(data.stud_isregistered === "true"){
                        $('td', row).css('background-color', 'rgba(2,239,37,0.3)');
                    }else{
                        $('td', row).css('background-color', 'rgba(244,94,61,0.3)');
                    }

            },
            "columnDefs":[
                {
                    targets : [1],
                    data : data,
                    render: function (x){
                        return x.stud_lastname+' '+x.stud_firstname+' '+x.stud_middlename;
                    }                    
                },
                {
                    targets : [5],
                    data : data,
                    render : function(x){
                        
                        if(x.stud_isregistered === "true"){
                            return `
                            <button type="button" class="btn btn-primary btn-xs" onclick="ApprovedStudentRegister(`+x.stud_id+`);">
                                <i class="fa fa-checked"></i> Approve
                            </button>
                            <button type="button" class="btn btn-primary btn-xs" onclick="EditRegStudent(`+x.stud_id+`);">
                                <i class="fa fa-edit"></i> Edit
                            </button>
                            <button type="button" class="btn btn-danger btn-xs" onclick="DeleteRegStudent(`+x.stud_id+`)">
                                <i class="fa fa-checked"></i> Delete
                            </button>
                         `;
                        }else{
                           return `
                            <button type="button" class="btn btn-primary btn-xs" onclick="EditRegStudent(`+x.stud_id+`);">
                                <i class="fa fa-edit"></i> Edit
                            </button>
                            <button type="button" class="btn btn-danger btn-xs" onclick="DeleteRegStudent(`+x.stud_id+`)">
                                <i class="fa fa-checked"></i> Delete
                            </button>
                         `; 
                        }
                        
                         
                    }
                }
            ],
            "columns" : [
               { data  : 'stud_no', sTitle: 'Stud No.' },
               { data  : null, sTitle: 'Name' },
               { data  : 'c_name', sTitle: ' Academic Track' },
               { data  : 'stud_section', sTitle: 'Section' },
               { data  : 'stud_year', sTitle: 'Year' },
               { data  : null, sTitle: 'Options' },
           ],
           "bDestroy":true
            
        });
    },
    
    //TEACHER TABLE============================================
    teacherTable : function (data){
        $('#tblTeachers').DataTable({
           data : data,
           "columnDefs":[
               {
                   "targets": [6],
                   "data" : data,
                   "render": function(xdata){
                       return `
                            <button onclick="editTeacher(`+xdata.t_id+`)" type="button" class="btn btn-primary btn-xs">
                                <i class="fa fa-edit"></i> Edit
                            </button>
                            <button onclick="deleteTeacher(`+xdata.t_id+`)" type="button" class="btn btn-danger btn-xs">
                                <i class="fa fa-times-circle"></i> Delete
                            </button>
                        `;
                   }
               }
           ],
           "columns" : [
               { data  : 't_no', sTitle: 'ID NO' },
               { data  : 't_lastname', sTitle: 'Lastname' },
               { data  : 't_firstname', sTitle: 'Firstname' },
               { data  : 't_contactno', sTitle: 'Contact No' },
               { data  : 't_email', sTitle: 'Email' },
               { data  : 't_gender', sTitle: 'Gender' },
               { data  : null, sTitle: 'Options' }
           ],
           "bDestroy":true
       });
    },


    
    //STUDENT TABLE============================================
    studentTable : function (data){
        $('#tblStudents').DataTable({
            data : data,
            "columnDefs":[
                {
                    "targets": [0],
                    "data" :data,
                    "render" : function(xdata){
                        if(xdata.scode_isverify === "false"){
                            return `<small class="label label-danger"><i class="fa fa-clock-o"></i> Pending</small>`;
                        }else{
                            return `<small class="label label-success"><i class="fa fa-check"></i> Success</small>`;
                        }
                    }
                },
                {
                    "targets":[6],
                    "data" : data,
                    "render": function (xdata){
                        if(privilage === "admin"){
                        return `
                            <button onclick="EditStudentInfo(`+xdata.stud_id+`)" type="button" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</button>
                            <button onclick="ActiveStudent(true,`+xdata.stud_id+`)" type="button" class="btn btn-danger btn-xs"><i class="fa fa-times-circle"></i> Delete</button>
                        `;
                        }else{
                            return '';
                        }
                    }
                }
            ],
            "columns" : [
                { data : null, sTitle: 'Status' },
                { data : 'stud_no', sTitle: 'Student No' },
                { data : 'stud_firstname', sTitle: 'Firstname' },
                { data : 'stud_lastname', sTitle: 'Lastname' },
                { data : 'stud_contactno', sTitle: 'Contact No' },
                { data : 'stud_ylevel', sTitle: 'Grade Level' },
                { data : null, sTitle: 'Options' }
               
            ],
            "bDestroy": true
        });
        
    },
    
    
    //COURSE TABLE============================================
    gradesTable : function (data){
        $('#tblGradelist').DataTable({
            data : data,
            stateSave: true,
            "columnDefs":[
                {
                    "targets": [0],
                    "data" :data,
                    "render": function(xdata){
                        return xdata.stud_lastname+" "+xdata.stud_firstname+" "+xdata.stud_middlename;
                    }
                },
                {
                    "targets" : [3],
                    "data" : data,
                    "render" : function (x){
                        if(x.g_semester === 'sem1'){
                            return 'Semester 1';
                        }else if(x.g_semester === 'sem2'){
                            return 'Semester 2';
                        }
                    }
                },
                {
                    "targets" : [4],
                    "data" : data,
                    "render" : function (x){
                        if(x.g_quarter === 'q1'){
                            return 'Quarter 1';
                        }else if(x.g_quarter === 'q2'){
                            return 'Quarter 2';
                        }else if(x.g_quarter === 'q3'){
                            return 'Quarter 3';
                        }else if(x.g_quarter === 'q4'){
                            return 'Quarter 4';
                        }
                    }
                },
                {
                    "targets" : [6],
                    "data" :data,
                    "render": function(x){
                            return `
                                <button onclick="DeleteGrade(`+ x.g_id +`);" type="button" class="btn btn-danger btn-xs">
                                    <i class="fa fa-times"></i> Delete
                                </button>
                            `;
                    }
                }
               
            ],
            "columns":[
                { data : null, sTitle: 'Student' },
                { data : 'sub_code', sTitle: 'Subject' },
                { data : 'sub_description', sTitle: 'Description' },
                { data : null, sTitle: 'Semester' },
                { data : null, sTitle: 'Quarter' },
                { data : 'g_grade', sTitle: 'Grade' },
                { data : null, sTitle: 'Options' }
            ],
            "bDestroy": true
        });
    },
    
    
    
    //COURSE TABLE============================================
    courseTable : function (data){
     
        $('#tblCourses').DataTable({
            data : data,
            "columnDefs":[
                {  
                    "targets": [1],
                    "data": data,
                    "width": '150px',
                    "render" : function (xdata){
                        return `
                            <button onclick="EditCourse(`+xdata.c_id+`)" type="button" class="btn btn-primary btn-xs">
                                <i class="fa fa-edit"></i> EDIT
                            </button>
                            <button onclick="deleteCourse(`+xdata.c_id+`)" type="button" class="btn btn-danger btn-xs">
                                <i class="fa fa-times"></i> DELETE
                            </button>
                        `;
                    }
                }
            ],
            "columns":[
                { data : 'c_name', sTitle: ' Academic Track'},
                { data : null, sTitle: 'Options'}
            ],
            "bDestroy": true
        });
     },
        
        //Subject TABLE============================================
       subjectTable : function (data){
     
        $('#tblSubjects').DataTable({
            data : data,
            "columnDefs":[
                {  
                    "targets": [3],
                    "data": data,
                    "width": '150px',
                    "render" : function (xdata){
                        return `
                            <button onclick="EditSubject(`+xdata.sub_id+`, `+xdata.sub_courseid+`)" type="button" class="btn btn-primary btn-xs">
                                <i class="fa fa-edit"></i> EDIT
                            </button>
                            <button onclick="deleteSubject(`+xdata.sub_id+`, `+xdata.sub_courseid+`)" type="button" class="btn btn-danger btn-xs">
                                <i class="fa fa-times"></i> DELETE
                            </button>
                        `;
                    }
                }
            ],
            "columns":[
                { data : 'sub_code', sTitle: 'Subject Code'},
                { data : 'sub_units', sTitle: 'Units'},
                { data : 'sub_description', sTitle: 'Description'},
                { data : null, sTitle: 'Options'}
            ],
            "bDestroy": true
        }); 
        
        
    },
    
     //Section TABLE============================================
       sectionTable : function (data){
     
        $('#tblSections').DataTable({
            data : data,
            "columnDefs":[
                {  
                    "targets": [2],
                    "data": data,
                    "width": '150px',
                    "render" : function (xdata){
                        return `
                            <button onclick="EditSection(`+xdata.sec_id+`)" type="button" class="btn btn-primary btn-xs">
                                <i class="fa fa-edit"></i> EDIT
                            </button>
                            <button onclick="DeleteSection(`+xdata.sec_id+`)" type="button" class="btn btn-danger btn-xs">
                                <i class="fa fa-times"></i> DELETE
                            </button>
                        `;
                    }
                }
            ],
            "columns":[
                { data : 'c_name', sTitle: ' Academic Track'},
                { data : 'sec_name', sTitle: 'Section Name'},
                { data : null, sTitle: 'Options'}
            ],
            "bDestroy": true
        }); 
        
        
    },
    
    //Section TABLE============================================
      yearTable : function (data){
     
        $('#tblYear').DataTable({
            data : data,
            "columnDefs":[
                {  
                    "targets": [1],
                    "data": data,
                    "width": '150px',
                    "render" : function (xdata){
                        return `
                            <!--<button onclick="EditYear(`+xdata.yr_id+`)" type="button" class="btn btn-primary btn-xs">
                                <i class="fa fa-edit"></i> EDIT
                            </button>
                            <button onclick="deleteYear(`+xdata.yr_id+`)" type="button" class="btn btn-danger btn-xs">
                                <i class="fa fa-times"></i> DELETE
                            </button>-->
                        `;
                    }
                }
            ],
            "columns":[
                { data : 'yr_year', sTitle: 'Year'},
                { data : null, sTitle: ''}
            ],
            "bDestroy": true
        }); 
        
        
    },
    
    
    timeFormat : function(hrs) {
        var hours = hrs.split(':');
        var suffix = hours[0] >= 12 ? "PM":"AM";
        var thours = (hours[0] > 12)? hours[0] -12 : hours[0];
        thours = thours + ':' + hours[1] + ' ' + suffix;
        return thours;
    },
    
    //SCHEDULE TABLE============================================
    schedTable : function (data){
        $('#tblSched').DataTable({
            data : data,
            "columnDefs":[
                
                {
                    "targets" : [0],
                    "data" :data,
                    "render" : function(xdata){
                        var h1 = this.app.timeFormat(xdata.sched_timef);
                        var h2 = this.app.timeFormat(xdata.sched_timet);
                        return h1+ '- '+ h2;
                    }
                },
                
                {  
                    "targets": [7],
                    "data": data,
                    "width": '150px',
                    "render" : function (xdata){
                        return `
                            <button onclick="EditSched(`+xdata.sched_id+`)" type="button" class="btn btn-primary btn-xs">
                                <i class="fa fa-times"></i> EDIT
                            </button>
                            <button onclick="deleteSchedule(`+xdata.sched_id+`)" type="button" class="btn btn-danger btn-xs">
                                <i class="fa fa-times"></i> DELETE
                            </button>
                        `;
                    }
                },
                {
                    "targets":[6],
                    "data": data,
                    "render":function(xdata){
                        return xdata.t_lastname+' '+xdata.t_firstname+' '+xdata.t_middlename;
                    }
                }
            ],
            "columns":[
                { data : null, sTitle: 'Time'},
                { data : 'sec_name', sTitle: 'Section'},
                { data : 'sched_room', sTitle: 'Room'},
                { data : 'sched_day', sTitle: 'Day'},
                { data : 'sub_code', sTitle: 'Subject'},
                { data : 'sub_description', sTitle: 'Sub. Des.'},
                { data : null, sTitle: 'Teacher'},
                { data : null, sTitle: 'Options'}
            ],
            "bDestroy": true
        }); 
    },
    
    
    /*=================================================STUDENT TABLE=======================================================
     *=================================================\\\\\\\//////=======================================================
     */
    studSubjectTable : function (data){
        $('#tblStudSub').DataTable({
           data : data,
           "columns": [
               { data : 'sub_code', sTitle : 'SUBJECT CODE' },
               { data : 'sub_description', sTitle : 'DESCRIPTION' },
               { data : 'sub_units', sTitle : 'UNITS' }
           ],
           "bDestroy": true
        });
        
    },
    
    
    //STUDENT GRADES
    studMyGradesTable : function (data){
        $('#tblMyGrades').DataTable({
           data : data,
           "columnDefs":[
               {  
                   "targets": [5],
                   "data" :data,
                   "render": function(xdata){
                       return xdata.t_firstname+" "+xdata.t_lastname+" "+xdata.t_middlename;
                   }
               },
               {
                    "targets":[2],
                    "data" : data,
                    "render" : function (x){
                        if(x.g_semester === 'sem1'){
                            return 'Semester 1';
                        }else if(x.g_semester === 'sem2'){
                            return 'Semester 2';
                        }
                    }
               },
               {
                    "targets":[3],
                    "data" : data,
                    "render" : function (x){
                        if(x.g_quarter === 'q1'){
                            return 'Quarter 1';
                        }else if(x.g_quarter === 'q2'){
                            return 'Quarter 2';
                        }else if(x.g_quarter === 'q3'){
                            return 'Quarter 3';
                        }else if(x.g_quarter === 'q4'){
                            return 'Quarter 4';
                        }
                    }
               },
           ],
           "columns": [
               { data : 'sub_code', sTitle : 'SUBJECT' },
               { data : 'sub_description', sTitle : 'DESCRIPTION' },
               { data : null, sTitle : 'SEMESTER' },
               { data : null, sTitle : 'QUARTER' },
               { data : 'g_grade', sTitle : 'GRADE' },
               { data : null, sTitle :  'TEACHER' }
           ],
           "bDestroy": true
        });
        
    },
    
    //SCHEDULE TABLE
    studScheduleTable : function (data){
        $('#tblStudSchedule').DataTable({
           data : data,
           "columns": [
               { data : 'day', sTitle : 'Day' },
               { data : 'time', sTitle : 'TIME' },
               { data : 'room', sTitle : 'ROOM' },
               { data : 'subject', sTitle : 'SUBJECT' },
               { data : 'description', sTitle : 'DESCRIPTION'},
               { data : 'section', sTitle : 'SECTION'},
               { data : 'teacher', sTitle : 'TEACHER' }
           ],
           "bDestroy": true
        });
    },
    
    //SCHEDULE TABLE
    filesTable : function (data){
        $('#tblFiles').DataTable({
           data : data,
           "columnDefs":[
                {
                   "targets": [2],
                   "data" : data,
                   "render": function(xdata){
                        return `
                            <a href="`+xdata.fpath+`" role="button" class="btn btn-primary btn-xs"><i class="fa fa-sign-in"></i> OPEN</a>
                            <button type="button" class="btn btn-danger btn-xs" onclick="deleteFile(`+xdata.fid+`)"> 
                                <i class="fa fa-times"></i> DELETE</i>
                           </button>
                        `;
                   
                   }
               }
           ],
           "columns": [
               { data : 'name', sTitle : 'NAME' },
               { data : 'filename', sTitle : 'FILE NAME' },
               { data : null, sTitle : 'OPTIONs' }
           ],
           "bDestroy": true
        });
    },
    
    
    
    /*=================================================TEACHER TABLE=======================================================
     *=================================================\\\\\\\//////=======================================================
     */
    
    
    teacherGrades : function (data){
        $('#tblStudGrades').DataTable({
           data : data,
           "order": [[ 4, 'asc' ], [3, 'asc']],
          /* "createdRow" : function(row,data,dataIndex){
                    if(data.g_isveryfied === "true"){
                        $('td', row).css('background-color', 'rgba(2,239,37,0.3)');
                    }else{
                        $('td', row).css('background-color', 'rgba(244,94,61,0.3)');
                    }

            },*/
           "columnDefs":[
               {
                   "targets":[1],
                   "data": data,
                   "render":function (xdata){
                       return ''+xdata.stud_lastname+' '+xdata.stud_firstname+' '+xdata.stud_middlename;
                   }
               },
               {
                    "targets":[2],
                    "data" : data,
                    "render" : function (x){
                        if(x.g_semester === 'sem1'){
                            return 'Semester 1';
                        }else if(x.g_semester === 'sem2'){
                            return 'Semester 2';
                        }
                    }
               },
               {
                    "targets":[5],
                    "data" : data,
                    "render" : function (x){
                        if(x.g_quarter === 'q1'){
                            return 'Quarter 1';
                        }else if(x.g_quarter === 'q2'){
                            return 'Quarter 2';
                        }else if(x.g_quarter === 'q3'){
                            return 'Quarter 3';
                        }else if(x.g_quarter === 'q4'){
                            return 'Quarter 4';
                        }
                    }
               },
               { 
                   "targets" : [7],
                   "data" : data,
                   "render" : function(xdata){ 
                       return `
                            <button onclick="EditStudentGrades(`+xdata.g_id+`);" type="button" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> EDIT</button>
                            <button onclick="DeleteStudentGrade(`+xdata.g_id+`);" type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> DELETE</button>
                       `;
                   }
               }  
           ],
           "columns": [
               { data : 'stud_no', sTitle : 'STUD#' },
               { data : null, sTitle : 'STUD NAME' },
               { data : null, sTitle : 'SEMESTER' },
               { data : 'sub_code', sTitle : 'SUBJECT' },
               { data : 'sub_description', sTitle : 'Sub. Des.' },
               { data : null, sTitle : 'QUARTER' },
               { data : 'g_grade', sTitle : 'GRADE'},
               { data : null, sTitle : 'OPTIONs'}
           ],
           "bDestroy": true
        });
    },
    
    //TEACHER SCHEDULE TABLE
    schedTeacherTable : function (data){
        $('#tblTeacherSched').DataTable({
           data : data,
           "columns": [
               { data : 'day', sTitle : 'Day' },
               { data : 'time', sTitle : 'TIME' },
               { data : 'room', sTitle : 'ROOM' },
               { data : 'subject', sTitle : 'SUBJECT' },
               { data : 'description', sTitle : 'DESCRIPTION' },
               { data : 'section', sTitle : 'SECTION'},
               { data : 'teacher', sTitle : 'TEACHER' }
           ],
           "bDestroy": true
        });
    },
    
    yearBookTable : function (data){
        $('#table-year-book').DataTable({
            data : data,
         
            "columns" : [
                { data : 'stud_no', sTitle: 'Student No' },
                { data : 'stud_firstname', sTitle: 'Firstname' },
                { data : 'stud_lastname', sTitle: 'Lastname' },
                { data : 'stud_contactno', sTitle: 'Contact No' },
                { data : 'stud_ylevel', sTitle: 'Year Level' },
               
            ],
            "bDestroy": true
        });
    },
    
    //STUDENT ARCHIVE TABLE ======================================================
    studentArchiveTable : function (data){
        $('#table-student-archive').DataTable({
            data : data,
            "columnDefs":[
                {
                    "targets": [0],
                    "data" :data,
                    "render" : function(xdata){
                        if(xdata.scode_isverify === "false"){
                            return `<small class="label label-danger"><i class="fa fa-clock-o"></i> Pending</small>`;
                        }else{
                            return `<small class="label label-success"><i class="fa fa-check"></i> Success</small>`;
                        }
                    }
                },
                {
                    "targets":[6],
                    "data" : data,
                    "render": function (xdata){
                        if(privilage === "admin"){
                        return `
                                <button onclick="ActiveStudent(false,`+xdata.stud_id+`)" type="button" class="btn btn-primary btn-xs"><i class="fa fa-refresh"></i> RESTORE</button>
                        `;
                        }else{
                            return '';
                        }
                    }
                }
            ],
            "columns" : [
                { data : null, sTitle: 'Status' },
                { data : 'stud_no', sTitle: 'Student No' },
                { data : 'stud_firstname', sTitle: 'Firstname' },
                { data : 'stud_lastname', sTitle: 'Lastname' },
                { data : 'stud_contactno', sTitle: 'Contact No' },
                { data : 'stud_ylevel', sTitle: 'Year Level' },
                { data : null, sTitle: 'Options' }
               
            ],
            "bDestroy": true
        });
        
    },
    
    //STUDENT ARCHIVE TABLE ======================================================
    studenGradesRemarks : function (data){
        $('#table-student-grades').DataTable({
            data : data,
            "createdRow" : function(row,data,dataIndex){
                    if(data.remark === null){
                    }else if(Number(data.remark) > 74){
                        $('td', row).css('background-color', 'rgba(2,239,37,0.3)');
                    }else{
                        $('td', row).css('background-color', 'rgba(244,94,61,0.3)');
                    }
            },
            "columnDefs":[
                {
                    "targets":[3],
                    "data": data,
                    "render":function(xx){
                        if(xx.remark === null){
                            return '<i>Grades Not Yet Completed</i>';
                        }
                        if(Number(xx.remark) > 74){
                            return xx.remark + ' <i>PASSED</i>';
                        }else{
                            return xx.remark + ' <i>FAILED</i>';
                        }
                    }
                },
                {
                    "targets":[4],
                    "data": data,
                    "render" : function (xdata){
                        return`
                            <button data-toggle="modal" data-target="#student-grades" type="button" class="btn btn-primary btn-xs btn-round" onclick="view_student_grades(`+`'`+ xdata.studno +`'`+`)">
                                <i class="fa fa-book"></i> View Grades</button>
                            <button type="button" class="btn btn-primary btn-xs btn-round" onclick="print_student_grades(`+`'`+ xdata.studno +`'`+`)">
                                <i class="fa fa-print"></i> Print Grades</button>
                        `;
                    }
                }
            ],
            
            "columns" : [
                { data : 'name', sTitle: 'NAME' },
                { data : 'gradelevel', sTitle: 'GRADE LEVER' },
                { data : 'course', sTitle: 'COURSE' },
                { data : null, sTitle: 'Remark' },
                { data : null, sTitle: 'Options'}
            ],
            "bDestroy": true
        });
        
    },
    
    
};

 
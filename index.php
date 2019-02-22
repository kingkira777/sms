<?php require_once './includes/auth.inc.php'; ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>CWPS</title>
        <?php include './includes/header.ext.php'; ?>
    </head>
    <body class="skin-blue">
       <!-- header logo: style can be found in header.less -->
       <?php include './includes/header.php'; ?>
        
       <div class="wrapper row-offcanvas row-offcanvas-left">
           <!-- Left side column. contains the logo and sidebar -->
           <?php include './includes/left-menu.php'; ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) 
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>-->

                <!-- Main content -->
                <section class="content">
                       
                    <div class="tab-content">
                        
                        <!--ANNOUNCEMENT TAB
                            Announcement List
                            Announcment ADD/ UPDATE for Admin and Teacher Only
                        =======================================-->
                        <div class="tab-pane active" id="announcement">
                            <?php include './pages/announcement/view_announcementlist.php'; ?>
                        </div>
                        
                        <div class="tab-pane" id="auannouncement">
                            <?php include_once './pages/announcement/view_auannouncement.php'; ?>
                        </div>
                        
                        
                        
                        
                        <!--STUDENT GRADES REMARKS IN ADMIN ACCT
                        ==============================--->
                        <div class="tab-pane" id="studentGrades">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h4 class="box-title">
                                        STUDENT GRADES
                                    </h4>
                                    <div class="box-tools pull-right">
                                        <!--<select id="studname" class="form-control" onclick="GetStudentGrades_remarks(this.value);">
                                            
                                        </select>-->
                                    </div>
                                </div>
                                <div class="box-body">
                                    <table style="width: 100%;" class="table table-bordered" id="table-student-grades"></table>
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-pane" id="studArchive">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h4 class="box-title">STUDENT ARCHIVE</h4>
                                </div>
                                <div class="box-body">
                                    <table id="table-student-archive" style="width: 100%;" class="table table-hover"></table>
                                </div>
                            </div>
                        </div>
                        
                        <!--TEACHERS TAB
                            TEACHER LIST
                            ADD UPDATE TEACHER
                        =======================================-->
                        
                        <div class="tab-pane" id="teacherTab">
                            <?php include './pages/teachers/view_teacherList.php'; ?>
                        </div>
               
                        <!--ADD UPDATE-->
                        <div class="tab-pane" id="auTeacherTab">
                            <?php include './pages/teachers/view_addupdateteacher.php'; ?>
                        </div>
                        
                        
                        <!--///TEACHERS TAB
                            TEACHER LIST
                            ADD UPDATE TEACHER
                        =======================================-->
                        
                        
                        
                        
                        
                        <!--STUDENTS TAB
                            STUDENT LIST
                            ADDT / UDPATE STUDENT
                        ==============================================-->
             
                        <!--ADD NEW REG STUDENT -->
                        <div class="tab-pane" id="regNewStudentList">
                             <?php require_once './pages/register-student/view_student-new-entry.php'; ?>
                        </div>
                        
                        
                        
                        <div class="tab-pane" id="studentTab">
                            <?php include './pages/students/view_studentList.php'; ?>
                        </div>
                        
                        
                        <div class="tab-pane" id="auStudentTab">
                            <?php include './pages/students/view_addupdateStudent.php'; ?>
                        </div>
                        
                        <!--CLASS SCHEDULE TABS
                            Schedule List
                            Schedule ADD / UPDATE
                        =======================================-->
                        
                        <div class="tab-pane" id="schedTab">
                           <?php include './pages/schedule/view_schedule.php'; ?>
                        </div>    
                        
                   
                        
                        <!--VIEW GRADES TAB
                            Grades List
                            Grades ADD /UPDATE
                        ===========================================-->
                        <div class="tab-pane" id="gradesTab">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h4 class="box-title">GRADE LIST</h4>
                                    <div class="box-tools pull-right">
                                        <label>Teacher</label>
                                        <select class="form-control" id="g_teachername" onchange="getGradelist(this.value);"></select>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <table id="tblGradelist" class="table table-condensed table-hover" style="width: 100%;"></table>
                                </div>
                            </div>
                            
                        </div> 
                        
                        <!--YEAR BOOK TAB
                        ===============================-->
                        <div class="tab-pane" id="yearBookTab">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h4 class="box-title">Year Book</h4>
                                    <div class="pull-right box-tools">
                                        <select id="b_year" class="form-control" onchange="GetYearlyStudents(this.value);"></select>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <table id="table-year-book" style="width: 100%;" class="table table-hover"></table>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        <!--Course GRADES TAB
                            Course List & ADD UPDATE
                        ===========================================-->
                        <div class="tab-pane" id="courseTab">
                            <?php include './pages/options/view_course.php'; ?>
                        </div>
                        
                        <!--SUBJECT TAB
                            Subject List & ADD UPDATE
                        ===========================================-->
                        <div class="tab-pane" id="subjectTab">
                            <?php include './pages/options/view_subject.php'; ?>
                        </div>
                        
                        <!--SECTION TAB
                            SECTION List & ADD UPDATE
                        ===========================================-->
                        <div class="tab-pane" id="sectionTab">
                            <?php include './pages/options/view_section.php'; ?>
                        </div>
                        
                        
                        <!--Year TAB
                            Year List & ADD UPDATE
                        ===========================================-->
                        <div class="tab-pane" id="yearTab">
                            <?php include './pages/options/view_year.php'; ?>
                        </div>
                        
                        
                        <!--TEACHER TAB CONTENT
                        =================================================================================================
                        =================================================================================================-->
                        <!--Grades Tab-->
                        <div class="tab-pane" id="tGradesTab">
                            <div class="row">
                                <!--LIST OF STUDENT GRADES -->
                                <div class="col-lg-8 col-md-8">
                                    <?php include_once './pages/teacher-grades/view_list-of-student-grades.php'; ?>
                                </div>
                                
                                <div class="col-lg-4 col-md-4">
                                    <?php include_once './pages/teacher-grades/view_addupdate-student-grade.php'; ?>
                                </div>
                                
                                
                            </div> 
                        </div>
                        
                        <!--Schedule Tab-->
                        <div class="tab-pane" id="teacherSchedTab">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h4 class="box-title">My Schedule</h4>
                                </div>
                                <div class="box-body">
                                    <table id="tblTeacherSched" class="table table-condensed table-hover" style="width: 100%"></table>
                                </div>
                            </div>
                            
                        </div>
                        
                        <!--OPTIONS (CHANGE PASSWORD)-->
                        <div class="tab-pane" id="studOptions">
                            <?php include_once './pages/change-password/view_changepassword.php'; ?>
                        </div>
                        
                        
                        <!--STUDENT TAB CONTENT
                        =================================================================================================
                        =================================================================================================-->
                        
                        <!--Subjects 
                        =========-->
                        <div class="tab-pane" id="studSubjects">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h4 class="box-title">My Subjects</h4>
                                </div>
                                <div class="box-body">
                                    <table id="tblStudSub" class="table table-condensed table-hover" style="width: 100%"></table>
                                </div>
                            </div>
                        </div>
                        
                        <!--Grades 
                        =========-->
                        <div class="tab-pane" id="studGrades">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h4 class="box-title">My Grades</h4>
                                    <div class="box-tools pull-right">
                                        <select id="my_subject" class="form-control" onchange="GetMyGrades(this.value);"></select>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <table id="tblMyGrades" class="table table-condensed table-hover" style="width: 100%"></table>
                                    <br />
                                    <br />
                                    <div class="pull-left">
                                        <button type="button" class="btn btn-primary" onclick="GetMyRemarks();">
                                            <i class="fa fa-credit-card"></i> GET MY REMARKS
                                        </button>
                                        <h4 id="myremakrs"></h4>
                                    </div>
                                    
                                    <div class="pull-right">
                                        <h4>AVERAGE : <span id="my_average"></span></h4>
                                    </div>
                                    <div class="clearfix"></div>
                                    <br />
                                </div>
                            </div>
                        </div>
                        
                        <!--Schedules 
                        =========-->
                        <div class="tab-pane" id="studSchedule">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h4 class="box-title">My Schedule</h4>
                                </div>
                                <div class="box-body">
                                    <table id="tblStudSchedule" class="table table-condensed table-hover" style="width: 100%"></table>
                                </div>
                            </div>
                        </div>
                        
                        <!--Files 
                        =========-->
                        <div class="tab-pane" id="studFiles">
                            <?php include './pages/files/view_files.php'; ?>
                        </div>
                        
                        
                        <!--MESSAGING 
                        =========-->
                        <div class="tab-pane" id="messageTab">
                            <h4>MESSAGE</h4>
                            <div class="box box-solid">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-4">
                                            <div class="box-header">
                                                <i class="fa fa-inbox"></i>
                                                <h3 class="box-title">INBOX</h3>
                                            </div>
                                            <a class="btn btn-block btn-primary" data-toggle="modal" data-target="#compose-modal"><i class="fa fa-pencil"></i> Compose Message</a>
                                            <div style="margin-top: 15px;">
                                                <ul class="nav nav-pills nav-stacked">
                                                    <li class="header">INBOX</li>
                                                    <span id="myinbox"></span>
                                                </ul>
                                                <ul class="nav nav-pills nav-stacked" id="">
                                                    <li class="header">SENT ITEMS</li>
                                                    <span id="mysenitems"></span>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-9 col-sm-8">
                                            <div class="box-header">
                                                <i class="fa fa-comment-o"></i>
                                                <h3 class="box-title">MESSAGES</h3>
                                                <input type="text" id="m_from" value="<?php echo $logname ?>" hidden />
                                            </div>
                                            <div class="box-body chat" id="chat-box" style="overflow-y: scroll; height: 400px;">
                                               
                                                
                                                
                                                
                                            </div>  
                                            <div class="box-footer">
                                                    <div class="input-group">
                                                        <input id="m_rplymessage" class="form-control" placeholder="Type message..."/>
                                                        <div class="input-group-btn">
                                                            <button id="btnrp" onclick="replyMessage();" class="btn btn-success">
                                                                <i class="fa fa-chevron-circle-right"></i> SEND</button>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        
                        
                    </div> <!--/.End of Tab Content========================-->
                        
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
           
           
           
           
       </div>
        
       <!-- COMPOSE MESSAGE MODAL -->
        <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-envelope-o"></i> Compose New Message</h4>
                    </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">TO:</span>
                                    <select id="m_to" class="form-control selectSelect" multiple></select>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea name="m_message" id="m_message" class="form-control" placeholder="Message" style="height: 120px;"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer clearfix">

                            <button onclick="document.getElementById('m_message').value =''" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>

                            <button type="button" onclick="sendNewMessage();" class="btn btn-primary pull-left"><i class="fa fa-envelope"></i> Send Message</button>
                        </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        
        
        <!-- STUDENT GRADES MODAL -->
        <div class="modal fade" id="student-grades" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-credit-card"></i> STUDENT GRADES</h4>
                    </div>
                        <div class="modal-body">
                            
                            <table class="table table-condensed table-bordered">
                                <thead>
                                <th>Name</th>
                                <th>Subject</th>
                                <th>Sub. Des.</th>
                                <th>Units</th>
                                <th>Average</th>
                                </thead>
                                <tbody id="table-stud-grades">
                                    
                                </tbody>
                            </table>
                            
                            
                        </div>
                         
                        <div class="modal-footer clearfix">

                        </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
       
       
   
       <?php include './includes/footer.ext.php'; ?>
       <script src="pages/app.js"></script>
       <script src="pages/announcement/js_announcement.js"></script>
       <script src="pages/teachers/js_teacher.js"></script>
       <script src="pages/students/js_student.js"></script>
       <script src="pages/options/js_options.js"></script>
       <script src="pages/schedule/js_schedule.js"></script>
       <script src="pages/grades/js_grades.js"></script>
       <script src="pages/year-book/js_yearBook.js"></script>
       
       <!--STUDENT JS--->
       <script src="pages/student-subject/js_studSubject.js"></script>
       <script src="pages/student-schedule/js_studentSchedule.js"></script>
       <script src="pages/student-grades/js_studentGrades.js"></script>
       <script src="pages/files/js_files.js"></script>
       
       <!--REG STUDENT-->
       <script src="pages/register-student/js_regStudent.js"></script>
       
       <!--TEACHER JS-->
       <script src="pages/teacher-grades/js_teacherGrades.js"></script>
       <script src="pages/change-password/js_changepassword.js"></script>
       
       <script src="pages/message/js_message.js"></script>
       
       
    </body>
</html>

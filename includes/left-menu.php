<aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="assets/img/logo/user01.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <?php 
                            
                            if($priv === "teacher"){
                                echo '<p><a href="#auTeacherTab" data-toggle="tab">Hello, '.$logname.'</a></p>';
                            }else if($priv === "student"){
                                echo '<p><a href="#auStudentTab" data-toggle="tab">Hello, '.$logname.'</a></p>';
                            }else if($priv === "admin"){
                                echo '<p><a href="#" data-toggle="tab">Hello, '.$logname.'</a></p>';
                            }
                            
                            ?>
                            <a href="#"><i class="fa fa-circle text-success"></i> <?php echo $priv; ?></a>
                        </div>
                    </div>
                    <!-- search form 
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>-->
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li>
                            <a data-toggle="tab" href="#announcement">
                                <i class="fa fa-dashboard"></i> <span>Announcement</span>
                            </a>
                        </li>
                        
                        <!--===============================ADMIN SIDEBAR=======================================--->
                        <?php if($priv === "admin") { ?>
                        <li>
                            <a href="#teacherTab" data-toggle="tab">
                                <i class="fa fa-user"></i> <span>Teachers</span>
                            </a>
                        </li>
                        <li class="treeview">
                                <a href="#">
                                <i class="fa fa-users"></i>
                                <span>Students</span>                                                         
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a onclick="app.activeTab('regNewStudentList');"><i class="fa fa-angle-double-right"></i> ADD NEW STUDENT</a></li>
                                <li><a onclick="app.activeTab('studentTab');"><i class="fa fa-angle-double-right"></i> STUDENT LIST</a></li>
                                <li><a onclick="app.activeTab('studentGrades');"><i class="fa fa-angle-double-right"></i> STUDENT GRADES</a></li>
                               
                            </ul>
                            </a>
                        </li>
                        <li>
                            <a href="#schedTab" data-toggle="tab">
                                <i class="fa fa-calendar"></i> <span>Class Schedule</span>
                            </a>
                        </li>
                        <li>
                            <a href="#gradesTab" data-toggle="tab">
                                <i class="fa fa-credit-card"></i> <span>View Grades</span>
                            </a>
                        </li>
                        <li>
                            <a href="#yearBookTab" data-toggle="tab">
                                <i class="fa fa-book"></i> <span>Year Book</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-cog"></i>
                                <span>Options</span>                                                         
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a onclick="app.activeTab('studArchive');"><i class="fa fa-angle-double-right"></i> Student Archive</a></li>
                                <li><a onclick="app.activeTab('courseTab');"><i class="fa fa-angle-double-right"></i> Academic Tracks</a></li>
                                <li><a onclick="app.activeTab('subjectTab');"><i class="fa fa-angle-double-right"></i> Subject</a></li>
                                <li><a onclick="app.activeTab('sectionTab');"><i class="fa fa-angle-double-right"></i> Sections</a></li>
                                <li><a onclick="app.activeTab('yearTab');"><i class="fa fa-angle-double-right"></i> Year</a></li>
                                <li><a onclick="app.activeTab('studOptions');"><i class="fa fa-key"></i> Change Password</a></li>
                            </ul>
                        </li>
                        <?php } ?>
                        
                        
                        <!--===============================TEACHER SIDEBAR=======================================--->
                        <?php if($priv === "teacher") { ?>
                        <li>
                            <a href="#tGradesTab" data-toggle="tab">
                                <i class="fa fa-credit-card"></i> <span>Student Grades</span>
                            </a>
                        </li>
                        <li>
                            <a href="#teacherSchedTab" data-toggle="tab">
                                <i class="fa fa-calendar"></i> <span>Schedules</span>
                            </a>
                        </li>
                        <li>
                            <a href="#studentTab" data-toggle="tab">
                                <i class="fa fa-users"></i> <span>Students</span>
                            </a>
                        </li>
                        <li>
                            <a href="#studFiles" data-toggle="tab">
                                <i class="fa fa-file-o"></i> <span>Files</span>
                            </a>
                        </li>
                        <li>
                            <a href="#yearBookTab" data-toggle="tab">
                                <i class="fa fa-book"></i> <span>Year Book</span>
                            </a>
                        </li>
                        <li>
                            <a href="#studOptions" data-toggle="tab">
                                <i class="fa fa-cog"></i> <span>Options</span>
                            </a>
                        </li>
                        <?php } ?>
                        
                        <!--===============================STUDENT SIDEBAR=======================================--->
                        <?php if($priv === "student") { ?>
                        <!--<li>
                            <a href="#studSubjects" data-toggle="tab">
                                <i class="fa fa-book"></i> <span>Subjects</span>
                            </a>
                        </li>-->
                        <li>
                            <a href="#studGrades" data-toggle="tab">
                                <i class="fa fa-credit-card"></i> <span>View Grades</span>
                            </a>
                        </li>
                        <li>
                            <a href="#studSchedule" data-toggle="tab">
                                <i class="fa fa-calendar-o"></i> <span>My Schedule</span>
                            </a>
                        </li>
                        <li>
                            <a href="#studFiles" data-toggle="tab">
                                <i class="fa fa-file-o"></i> <span>Files</span>
                            </a>
                        </li>
                        <li>
                            <a href="#studOptions" data-toggle="tab">
                                <i class="fa fa-cog"></i> <span>Options</span>
                            </a>
                        </li>
                        <?php } ?>
                        
                    </ul>
                    
                    
                </section>
                <!-- /.sidebar -->
            </aside>
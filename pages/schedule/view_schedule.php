                            <div class="row">
                                <div class="col-lg-8 col-md-8">
                                    <div class="box box-primary">
                                        <div class="box-header">
                                            <h4 class="box-title">SCHEDULE LIST</h4>
                                            <div class="box-tools pull-right">
                                                <select id="t_list" class="form-control" onchange="GetSchedByTeacherSSS(this.value);"></select>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <table id="tblSched" class="table table-condensed table-hover" style="width: 100%"></table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                     <div class="box box-success">
                                        <div class="box-header">
                                            <h4 class="box-title">ADD / UPDATE SCHEDULE</h4>
                                            <div class="box-tools pull-right">
                                              <!--  <button type="button" class="btn btn-danger" data-toggle="tab" data-target="#schedTab">
                                                    <i class="fa fa-times"></i>
                                                </button>-->
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <label>Academic Tracks</label>
                                                    <select id="sched_course" class="form-control" onchange="selectCourse(this.value); GetSectionSelectList(this.value);"></select>
                                            
                                                    <label>Select Subject</label>
                                                    <select id="sched_subject" class="form-control"></select>
                                                    
                                                    <label>Select Day</label>
                                                    <select id="sched_day" class="form-control">
                                                        <option value=""></option>
                                                        <option value="monday">Monday</option>
                                                        <option value="tuesday">Tuesday</option>
                                                        <option value="wednesday">Wednesday</option>
                                                        <option value="thursday">Thursday</option>
                                                        <option value="friday">Friday</option>
                                                        <option value="saturday">Saturday</option>
                                                        <option value="sunday">Sunday</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <label>Time (from)</label>
                                                            <input type="time" class="form-control" id="sched_tfrom" />
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label>Time (from)</label>
                                                            <input type="time" class="form-control" id="sched_tto" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-sm-12">
                                                    <label>Section</label>
                                                    <select id="sched_section" class="form-control"></select>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                    <label>Room</label>
                                                    <input type="text" class="form-control" id="sched_room" />
                                            
                                                    <label>Teacher</label>
                                                    <select id="sched_teacher" class="form-control"></select>
                                                </div>
                                            </div>
                                            <br />
                                            <div class="pull-right">
                                                <button type="button" class="btn btn-success" onclick="ClearSchedField();">
                                                    <i class="fa fa-plus"></i> ADD
                                                 </button>
                                                <button type="button" class="btn btn-primary" onclick="saveUpdateSchedule();">
                                                    <i class="fa fa-save"></i> SAVE
                                                </button>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
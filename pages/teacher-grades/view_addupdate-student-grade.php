                                <div class="box box-success">
                                        <div class="box-header">
                                            <h4 class="box-title"><i class="fa fa-plus"></i> Add Grades</h4>
                                        </div>
                                        <div class="box-body">
                                            <label>Enter Student No.</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="g_studno" />
                                                <span class="input-group-btn">
                                                    <button onclick="Grade_CheckStudentNo();" type="button" class="btn btn-primary"><i class="fa fa-search"></i> CHECK</button> 
                                                </span>
                                            </div>
                                            <label>NAME</label>
                                            <input type="text" class="form-control" readonly id="g_name" />
                                            <label>Course</label>
                                            <input type="text" class="form-control" readonly id="g_course" />
                                            <label>Subject</label>
                                            <select class="form-control" id="g_subject"></select> 
                                            <label>Semester</label>
                                            <select class="form-control" id="g_semester" onclick="SelectSemester(this.value);">
                                                <option value=""></option>
                                                <option value="sem1">Semester 1</option>
                                                <option value="sem2">Semester 2</option>
                                            </select> 
                                            <label>Quarter</label>
                                            <select class="form-control" id="g_quarter"></select> 
                                            <label>Grade</label>
                                            <input type="number" class="form-control" id="g_grade" />
                                            <br />
                                           
                                            <button type="button" class="btn btn-primary pull-right" onclick="SaveUpdateStudentGrade();">
                                                <i class="fa fa-save"></i> SAVE
                                            </button>
                                            <button type="button" class="btn btn-success pull-right" onclick="ClearGradesFields();">
                                                <i class="fa fa-plus"></i> ADD
                                            </button>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
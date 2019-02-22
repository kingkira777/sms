                                    <div class="box box-primary">
                                        <div class="box-header">
                                            <h4 class="box-title">List of Grades</h4>
                                            <div class="box-tools pull-right">
                                                <label>Student No</label>
                                                <input type="text" id="s_studno" />
                                                <button type="button" onclick="GetStudentSubjectByStudno();"><i class="fa fa-search"></i></button>
                                                <label>Subject</label>
                                                <select id="s_subject" onchange="ComputeStudentGrades(this.value);"></select>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <table id="tblStudGrades" class="table table-condensed table-hover" style="width: 100%;"></table>
                                            <h4>AVERAGE : <span id="g_average"></span></h4>
                                        </div>
                                    </div>
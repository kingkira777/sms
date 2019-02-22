                                    <div class="row">
                                        <div class="col-sm-8 col-md-8">
                                            <div class="box box-primary">
                                                <div class="box-header">
                                                    <h4 class="box-title">STUDENT REG LIST</h4>
                                                </div>
                                                <div class="box-body">
                                                    <table style="width: 100%;" class="table table-hover table-condensed" id="table-student-reg"></table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-md-4">
                                            <div class="box box-success">
                                                <div class="box-header">
                                                    <h4 class="box-title">ADD NEW STUDENT ENTRY</h4>
                                                </div>
                                                <div class="box-body">
                                                    <label>STUDENT NO.</label>
                                                    <input type="text" class="form-control" readonly id="regs_studno" />
                                                    <label>FIRSTNAME</label>
                                                    <input type="text" class="form-control" id="regs_fname" />
                                                    <label>LASTNAME</label>
                                                    <input type="text" class="form-control" id="regs_lname" />
                                                    <label>MIDDLENAME</label>
                                                    <input type="text" class="form-control" id="regs_mname" />
                                                    <label>ACADEMIC TRACK</label>
                                                    <select id="regs_course" class="form-control" onchange="GetSectionList(this.value);"></select>
                                                    <label>SECTION</label>
                                                    <select id="regs_section" class="form-control"></select>
                                                    <label>YEAR</label>
                                                    <select id="regs_year" class="form-control"></select>
                                                    <label>YEAR LEVEL</label>
                                                    <select id="regs_year_lvl" class="form-control">
                                                        <option value=""></option>
                                                        <option value="Grade 11">Grade 11</option>
                                                        <option value="Grade 12">Grade 12</option>
                                                    </select>
                                                    <br />
                                                    <button type="button" class="btn btn-primary" onclick="RegisterNewStudent();">
                                                        <i class="fa fa-save"></i> SAVE
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
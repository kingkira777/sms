                            <div class="row">
                                <div class="col-md-8 col-sm-8">
                                    <div class="box box-primary">
                                        <div class="box-header">
                                            <h4 class="box-title">SUBJECTS</h4>
                                        </div>
                                        <div class="box-body">
                                            <table id="tblSubjects" style="width: 100%" class="table table-condensed table-hover"></table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="box box-success">
                                        <div class="box-header">
                                            <h4 class="box-title"><i class="fa fa-plus"></i> ADD</h4>
                                        </div>
                                        <div class="box-body">
                                            <label>Select  Academic Track</label>
                                            <select id="courseList" class="form-control" onchange="getSubjectList(this.value)"></select>
                                            <label>Subject Code</label>
                                            <input type="text" class="form-control" id="sub_code" />
                                            <label>Descriptions</label>
                                            <input type="text" class="form-control" id="sub_des" />
                                            <label>Units</label>
                                            <input type="number" class="form-control" id="sub_units" />
                                            
                                            <br />
                                            <button type="button" class="btn btn-primary pull-right" onclick="saveSubject();">
                                                <i class="fa fa-save"></i> SAVE
                                            </button>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
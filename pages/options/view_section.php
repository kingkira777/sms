                            <div class="row">
                                <div class="col-md-8 col-sm-8">
                                    <div class="box box-primary">
                                        <div class="box-header">
                                            <h4 class="box-title">SECTIONS</h4>
                                        </div>
                                        <div class="box-body">
                                            <table id="tblSections" style="width: 100%" class="table table-condensed table-hover"></table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="box box-success">
                                        <div class="box-header">
                                            <h4 class="box-title"><i class="fa fa-plus"></i> ADD</h4>
                                        </div>
                                        <div class="box-body">
                                            <label> Academic Track</label>
                                            <select id="sec_courseid" class="form-control" onchange="GetSectionTableList(this.value);"></select>
                                            <label>Section Name</label>
                                            <input type="text" class="form-control" id="sec_name" />
                                            <br />
                                            <button type="button" class="btn btn-primary pull-right" onclick="saveSection();">
                                                <i class="fa fa-save"></i> SAVE
                                            </button>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
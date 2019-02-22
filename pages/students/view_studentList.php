                            <div class="box box-primary">
                                <div class="box-header">
                                    <h4 class="box-title">Student List</h4>
                                    <div class="box-tools pull-right">
                                        <?php if($priv === "admin"){ ?>
                                      <!---  <button onclick="clearStudentFields();" data-toggle="tab" data-target="#auStudentTab" type="button" class="btn btn-primary">
                                        <i class="fa fa-plus-square"></i>
                                      </button> -->
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <table style="width: 100%;" id="tblStudents" class="table table-condensed table-hover"></table>
                                </div>
                            </div>
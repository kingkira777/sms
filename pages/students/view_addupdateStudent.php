                            <div class="box box-success">
                                <div class="box-header">
                                    <h4 class="box-title">
                                        <?php if($priv === "admin"){ 
                                           echo 'ADD / UPDATE STUDENT';
                                            }else{
                                            echo 'My Profile';
                                            }
                                        ?>
                                        </h4>
                                    <div class="box-tools pull-right">
                                        <?php if($priv === "admin"){ ?>
                                      <!--  <button onclick="clearStudentFields();" type="button" data-toggle="tab" data-target="#studentTab" class="btn btn-danger">
                                      <i class="fa fa-times"></i></button>-->
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="box-body">
                                    
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4">
                                            <label>STUDENT NUMBER</label>
                                            <input id="s_no" type="text" class="form-control" readonly/>
                                            
                                        </div> 
                                        <div class="col-md-4 col-sm-4">
                                            <?php if($priv === "admin"){ ?>
                                            <label>STUDENT CODE</label>
                                            <div class="input-group">
                                                 <input id="s_code" class="form-control" type="text" readonly />
                                                 <div class="input-group-btn">
                                                     <button id="editStudentBtn" onclick="generateStudentNo();" class="btn btn-primary"> <i class="fa fa-user"></i>  <i class="fa fa-key"></i></button>
                                                 </div>
                                             </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4">
                                            <label>Lastname</label>
                                            <input id='s_lname' type="text" class="form-control" />
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <label>Firstname</label>
                                            <input id="s_fname" type="text" class="form-control" />
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <label>Middlenaame</label>
                                            <input id="s_mname" type="text" class="form-control" />
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4">
                                            <label>Date of Birth</label>
                                            <input id="s_dob" type="date" class="form-control" />
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <label>Gender</label>
                                            <select id="s_gender" class="form-control">
                                                <option value=""></option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <label>Citizenship</label>
                                            <input id="s_citizen" type="text" class="form-control" />
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4">
                                            <label>Contact No.</label>
                                            <input id="s_contactno" type="number" class="form-control" />
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <label>Email</label>
                                            <input id="s_email" type="text" class="form-control" />
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <label>Address</label>
                                            <input id="s_address" type="text" class="form-control" />
                                        </div>
                                    </div>
                                    
                                    
                                    <hr />
                                    
                                    <div class="row">
                                        <div class="col-md-3 col-sm-3">
                                            <label> Academic Track</label>
                                            <select id="s_course" class="form-control" disabled></select>
                                        </div>
                                        <div class="col-md-3 col-sm-3">
                                            <label>Section</label>
                                            <input type="text" class="form-control" id="s_section" readonly />
                                        </div>
                                        <div class="col-md-3 col-sm-3">
                                            <label>Year (year enrolled)</label>
                                            <select id="s_year" class="form-control" disabled></select>
                                        </div>
                                        <div class="col-md-3 col-sm-3">
                                            <label>Year Level</label>
                                            <input type="text" class="form-control" id="s_yearlevel" disabled />
                                        </div>
                                        
                                    </div>
                                    
                                    <hr />
                                    <h4>Emergency Contact</h4>
                                    <div class="row">
                                        <div class="col-sm-4 col-md-4">
                                            <label>Name</label>
                                            <input type="text" id="em_name" class="form-control" />
                                        </div>
                                        <div class="col-sm-4 col-md-4">
                                            <label>Contact No.</label>
                                            <input type="number" id="em_contact" class="form-control" />
                                        </div>
                                    </div>
                                    
                                    
                                    <br />
                                    <div class="clearfix"></div>
                                    <button type="button" class="btn btn-primary pull-right" onclick="saveUpdateStudent();">
                                        <i class="fa fa-save"></i> SAVE
                                    </button>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
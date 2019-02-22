                            <div class="box box-success">
                                <div class="box-header">
                                    <h4 class="box-title">
                                        <?php if($priv === "admin"){ 
                                           echo 'ADD / UPDATE TEACHER';
                                            }else{
                                            echo 'My Profile';
                                            }
                                        ?></h4>
                                    <div class="box-tools pull-right">
                                        <?php if($priv === "admin"){ ?>
                                        <a onclick="clearTeacherFields();" data-toggle="tab" href="#teacherTab" class="btn btn-danger"><i class="fa fa-times"></i></a>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="box-body">
                                    
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4">
                                            <label>ID NUMBER</label>
                                            <input id="t_no" type="text" class="form-control" readonly/>
                                        </div> 
                                        <div class="col-md-4 col-sm-4">
                                            <?php if($priv === "admin"){ ?>
                                            <label>PASSWORD</label>
                                            <div class="input-group">
                                                <input id="t_password" class="form-control" type="text" readonly />
                                                <div class="input-group-btn">
                                                    <button id="editTeacherBtn" onclick="generateIdnoPassword();" class="btn btn-primary"> <i class="fa fa-user"></i>  <i class="fa fa-key"></i></button>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4">
                                            <label>Lastname</label>
                                            <input id="t_lastname" type="text" class="form-control" />
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <label>Firstname</label>
                                            <input id="t_firstname" type="text" class="form-control" />
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <label>Middlename</label>
                                            <input id="t_middlename" type="text" class="form-control" />
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4">
                                            <label>Date of Birth</label>
                                            <input id="t_dob" type="date" class="form-control" />
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <label>Gender</label>
                                            <select id="t_gender" class="form-control">
                                                <option value=""><--SELECT--></option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                            
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <label>Citizenship</label>
                                            <input id="t_citizenship" type="text" class="form-control" />
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4">
                                            <label>Contact #</label>
                                            <input id="t_contactno" type="number" class="form-control" />
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <label>Email</label>
                                            <input id="t_email" type="text" class="form-control" />
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <label>Address</label>
                                            <input id="t_address" type="text" class="form-control" />
                                        </div>
                                    </div>
                                    
                                    <div class="clearfix"></div>
                                    <br />
                                    <div class="pull-right">
                                        <button type="button" class="btn btn-primary" onclick="saveUpdateTeacher();">
                                            <i class="fa fa-save"></i> SAVE
                                        </button>
                                    </div>
                                    <div class="clearfix"></div>
                                    
                                </div>
                            </div>
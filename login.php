<?php 
    $userid = "";
    $userno = "";
    $priv = "";
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>CWPS</title>
        <?php include './includes/header.ext.php'; ?>
        <style>
            body{
                background-image: url('assets/img/bg/image02.png');
                background-size: cover;
                background-repeat: no-repeat;
            }
            
        </style>
    </head>
    <body class="bg-black">
        <div class="sms-loading"></div>
                <div class="form-box" id="login-box">
                    <div class="header bg-blue">CWPS - Login
                        <img src="assets/img/logo/slogo.jpg" alt="slogo" style="border-radius: 50%;" />
                    </div>
                        <div class="body bg-gray">
                            <div class="tab-content">
                                <div class="tab-pane active" id="loginTab">
                                    <div class="form-group">
                                        <input type="text" id="userid" class="form-control" placeholder="User ID"/>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" id="password" class="form-control" placeholder="Password"/>
                                    </div>
                                    <button type="button" onclick="loginUser();" class="btn bg-blue btn-block">Sign me in</button> 
                                </div>
                                
                                <div class="tab-pane" id="registerTab">
                                   <label>Student No.</label>
                                   <div class="input-group">
                                        <input type="text" class="form-control" id="reg_studno" />
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-primary" onclick="CheckStudentNo();">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                   </div>
                                    <label>Password</label>
                                    <input type="password" class="form-control" id="reg_password" />
                                    <label>ReType-Password</label>
                                    <input type="password" class="form-control" id="reg_repassword" />
                                    <label>Name</label>
                                    <input type="text" class="form-control" id="reg_name" readonly />
                                    <label>Date of Birth</label>
                                    <input type="date" class="form-control" id="reg_dob" />
                                    <label>Gender</label>
                                    <select id="reg_gender" class="form-control">
                                        <option value=""></option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                    <label>Citizenship</label>
                                    <input type="text" class="form-control" id="reg_citizenship" />
                                    <label>Contact No.</label>
                                    <input type="number" class="form-control" id="reg_contactno" />
                                    <label>Email</label>
                                    <input type="text" class="form-control" id="reg_email" />
                                    <label>Address</label>
                                    <input type="text" class="form-control" id="reg_address" />
                                    <h4 class="headline">Emergency Contact</h4>
                                    <label>Name</label>
                                    <input type="text" class="form-control" id="reg_emName" />
                                    <label>Contact No</label>
                                    <input type="number" class="form-control" id="reg_emContact" />
                                    
                                    <br />
                                    <button id="reg-button" type="button" onclick="RegisterStudent();" class="btn bg-olive btn-block">Register</button> 
                                 </div>
                                
                            </div>
                           
                        </div>
                        <div class="footer bg-gray">                                                               
                             

                          <!--  <p><a href="#">I forgot my password</a></p>-->
                            <a href="#loginTab" data-toggle="tab" class="text-center">Login</a> <br />
                            <a href="#registerTab" data-toggle="tab" class="text-center">Register New Student</a>
                        </div>

                    <div class="margin text-center">
                         <!-- <span>Choose to sign-in</span>
                        <br/>
                        <label><input type="checkbox" id="profLogin" > PROFESSOR</label>
                        <label><input type="checkbox" id="studLogin" > STUDENT</label>
                     
                        <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
                        <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
                        <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>-->

                    </div>
                </div>
        <?php include './includes/footer.ext.php'; ?>
        <script src="pages/app.js"></script>
        <script src="pages/user-login/user_login.js"></script>
    </body>
</html>

<!--Server side code to handle  Patient Registration-->
<?php
	session_start();
	include('assets/inc/config.php');
		if(isset($_POST['add_patient']))
		{
            if($_POST['pat_pass'] == $_POST['pat_pass_con'])
            {
                $pat_fname=$_POST['pat_fname'];
                $pat_lname=$_POST['pat_lname'];
                $pat_number=$_POST['pat_number'];
                $pat_phone=$_POST['pat_phone'];
                $pat_longterm_dis=$_POST['pat_longterm_dis'];            
                // $pat_type=$_POST['pat_type'];
                $pat_addr=$_POST['pat_addr'];
                $pat_age = $_POST['pat_age'];
                $pat_dob = $_POST['pat_dob'];
                $pat_allergy = $_POST['pat_allergy'];
                $pat_pass=sha1(md5($_POST['pat_pass']));
                if($pat_fname=="")
                {
                    $err = "Please Enter the records";
                }
                else
                {
                    $pat_dpic=$_FILES["pat_dpic"]["name"];
                    move_uploaded_file($_FILES["pat_dpic"]["tmp_name"],"assets/images/users/".$_FILES["pat_dpic"]["name"]);

                    //sql to insert captured values
                    $query="insert into his_patients (pat_fname, pat_lname,pat_longterm_dis ,pat_pass,  pat_dob, pat_age, pat_number, pat_phone, pat_addr, pat_allergy, pat_dpic) values(?,?,?,?,?,?,?,?,?,?,?)";
                    $stmt = $mysqli->prepare($query);
                    $rc=$stmt->bind_param('sssssssssss', $pat_fname, $pat_lname, $pat_longterm_dis,$pat_pass,$pat_dob, $pat_age,  $pat_number, $pat_phone,  $pat_addr,  $pat_allergy, $pat_dpic);
                    $stmt->execute();
                    /*
                    *Use Sweet Alerts Instead Of This Fucked Up Javascript Alerts
                    */ 
                    //declare a varible which will be passed to alert function
                    if($stmt)
                    {
                        // echo"<script>alert('Patient Details Added! Your Patient UserId is $pat_number ');</script>";
                        
                        // sleep(5);
                       // 
                       //header("location:index.php");
                        $success = "Patient Details Added! Your Patient UserId is $pat_number";
                    }
                    else {
                        $err = "Please Try Again Or Try Later";
                    }
                }
            }
            else 
            {
                $err="Two passwords does not match";
            }

			
		}
        ?>
        <!--End Server Side-->
        <!--End Patient Registration-->
        <!DOCTYPE html>
        <html lang="en">
            
            <!--Head-->
            <?php include('assets/inc/head.php');?>
            <body>
        
                <!-- Begin page -->
                
                    <!-- ============================================================== -->
                    <!-- Start Page Content here -->
                    <!-- ============================================================== -->
        
                    <div class="justify-content">
                        <div class="content">
        
                            <!-- Start Content-->
                            <div class="container-fluid">
                                
                                <!-- start page title -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="page-title-box">
                                            <div class="page-title-right">
                                                <ol class="breadcrumb m-0">
                                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Patients</a></li>
                                                    <li class="breadcrumb-item active">Add Patient</li>
                                                </ol>
                                            </div>
                                            <h4 class="page-title">Add Patient Details</h4>
                                        </div>
                                    </div>
                                </div>     
                                <!-- end page title --> 
                                <!-- Form row -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="header-title">Fill all fields</h4>
                                        <form method="post" enctype="multipart/form-data">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4" class="col-form-label">First Name</label>
                                                    <input type="text" required="required" name="pat_fname" class="form-control" id="inputEmail4" placeholder="Patient's First Name">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4" class="col-form-label">Last Name</label>
                                                    <input required="required" type="text" name="pat_lname" class="form-control"  id="inputPassword4" placeholder="Patient`s Last Name">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4" class="col-form-label">Date Of Birth</label>
                                                    <input type="text" required="required" name="pat_dob" class="form-control" id="inputEmail4" placeholder="DD/MM/YYYY">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4" class="col-form-label">Age</label>
                                                    <input required="required" type="text" name="pat_age" class="form-control"  id="inputPassword4" placeholder="Patient`s Age">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputAddress" class="col-form-label">Long term disease</label>
                                                    <input required="required" type="text" class="form-control" name="pat_longterm_dis" id="inputAddress" placeholder="Long term disease">
                                                </div>     
                                                <div class="form-group col-md-6">
                                                    <label for="inputAddress" class="col-form-label">Address</label>
                                                    <input required="required" type="text" class="form-control" name="pat_addr" id="inputAddress" placeholder="Patient's Addresss">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputCity" class="col-form-label">Mobile Number</label>
                                                    <input required="required" type="text" name="pat_phone" class="form-control" id="inputCity">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputCity" class="col-form-label">Any allergy</label>
                                                    <input required="required" type="text" name="pat_allergy" class="form-control" id="inputCity">
                                                </div>
                                                
                                                

                                            </div>
                                            
                                            
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label for="lastname">New Password</label>
                                                        <input type="password" class="form-control" name="pat_pass" id="lastname" placeholder="Enter New Password">
                                                    </div>
                                                </div> <!-- end col -->
                                                <div class="col-md-5">

                                                    <div class="form-group">
                                                        <label for="useremail">Confirm Password</label>
                                                        <input type="password" name="pat_pass_con"  class="form-control" id="useremail" placeholder="Confirm New Password">
                                                    </div>
                                                </div> <!-- end col -->

                                            </div> <!-- end row -->
                                            
                                            
                                            <div class="row">
                                                <div class="form-group col-md-5">
                                                    <label for="inputEmail4">Profile Picture</label>
                                                    <input type="file" name="pat_dpic" class="form-control btn btn-success" id="inputEmail4" >
                                                </div>
                                                <div class="form-group" >
                                                    <?php 
                                                            $length = 5;    
                                                            $patient_number =  substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
                                                            ?>
                                                        <label for="useremail" >Patient Number</label>
                                                        <!-- <fieldset disabled> -->
                                                        <input type="text" name="pat_number" value="<?php echo $patient_number;?>" class="form-control" id="useremail">
                                                    <!-- </fieldset> -->
                                                        
                                                    </div>
                                            </div>
                                            <div class="text-right">
                                                <a href="index.php"  class="ladda-button btn btn-danger" data-style="expand-right">Cancel</a></li>
                                                <button type="submit" name="add_patient" class="ladda-button btn btn-primary" data-style="expand-right">
                                                Add Patient    
                                                </button>
                                            </div>
                                        </form>
                                        <!--End Patient Form-->
                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <?php include('assets/inc/footer.php');?>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


       
        <!-- END wrapper -->

       
        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- App js-->
        <script src="assets/js/app.min.js"></script>

        <!-- Loading buttons js -->
        <script src="assets/libs/ladda/spin.js"></script>
        <script src="assets/libs/ladda/ladda.js"></script>

        <!-- Buttons init js-->
        <script src="assets/js/pages/loading-btn.init.js"></script>
        
    </body>

</html>
<!--Server side code to handle  Patient Registration-->
<?php
session_start();
include('assets/inc/config.php');

if (isset($_POST['add_doc'])) 
{
    if($_POST['doc_pwd'] == $_POST['doc_pwd_con'])
    {
              
        $doc_fname = $_POST['doc_fname'];
        $doc_lname = $_POST['doc_lname'];
        $doc_number = $_POST['doc_number'];
        $doc_email = $_POST['doc_email'];
        $doc_experi = $_POST['doc_experi'];
        $doc_specality = $_POST['doc_specality'];
        $doc_addr = $_POST['doc_addr'];
        $doc_phone = $_POST['doc_phone'];
        $doc_fees = $_POST['doc_fees'];
        $doc_pwd = isset($_POST['doc_pwd']) ? sha1(md5($_POST['doc_pwd'])) : '';

        if ($doc_fname == "") {
            $err = "Please Enter the records";
        } else {
            $doc_dpic = $_FILES["doc_dpic"]["name"];
            move_uploaded_file($_FILES["doc_dpic"]["tmp_name"], "assets/images/users/" . $_FILES["doc_dpic"]["name"]);

            // SQL to insert captured values
            $query = "INSERT INTO his_docs (doc_fname, doc_lname, doc_number, doc_email, doc_pwd, doc_experi, doc_specality, doc_addr, doc_phone, doc_fees, doc_dpic) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param('sssssisssss', $doc_fname, $doc_lname, $doc_number, $doc_email, $doc_pwd, $doc_experi, $doc_specality, $doc_addr, $doc_phone, $doc_fees, $doc_dpic);
            $stmt->execute();

            if ($stmt) {
                $success = "Doctor Details Added Your Patient UserId is $doc_number";
            } else {
                $err = "Please Try Again Or Try Later";
            }
            $stmt->close();
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
        <div id="wrapper">

            <!-- Topbar Start -->
            <?php include("assets/inc/nav.php");?>
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            <?php include("assets/inc/sidebar.php");?>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                        <div class="content">
        
                            <!-- Start Content-->
                            <div class="container-fluid">
                                
                                <!-- start page title -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="page-title-box">
                                            <div class="page-title-right">
                                                <ol class="breadcrumb m-0">
                                                    <li class="breadcrumb-item"><a href="his_admin_dashboard.php">Dashboard</a></li>
                                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Doctor</a></li>
                                                    <li class="breadcrumb-item active">Add Doctor</li>
                                                </ol>
                                            </div>
                                            <h4 class="page-title">Add Doctor's Details</h4>
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
                                                    <input type="text" required="required" name="doc_fname" class="form-control" id="inputEmail4" placeholder="Doctor's First Name">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4" class="col-form-label">Last Name</label>
                                                    <input required="required" type="text" name="doc_lname" class="form-control"  id="inputPassword4" placeholder="Doctor`s Last Name">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputAddress" class="col-form-label">Email</label>
                                                    <input required="required" type="email" class="form-control" placeholder="Doctor`s Email" name="doc_email" id="inputAddress">
                                                </div>
                                            
                                                
                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4" class="col-form-label">Years of Experience</label>
                                                    <input required="required" type="text" name="doc_experi" class="form-control"  id="inputPassword4" placeholder="Total Years of Experience">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputAddress" class="col-form-label">Specality</label>
                                                    <input required="required" type="text" class="form-control" name="doc_specality" id="inputAddress" placeholder="Doctor's Specality">
                                                </div>     
                                                <div class="form-group col-md-6">
                                                    <label for="inputAddress" class="col-form-label">Address</label>
                                                    <input required="required" type="text" class="form-control" name="doc_addr" id="inputAddress" placeholder="Doctor's Addresss">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputCity" class="col-form-label">Mobile Number</label>
                                                    <input required="required" type="text" name="doc_phone" placeholder="Doctor's Mobile Number" class="form-control" id="inputCity">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputCity" class="col-form-label">Fees</label>
                                                    <input required="required" type="text" name="doc_fees" class="form-control" placeholder="Doctor's Fees" id="inputCity">
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label for="doc_pwd">New Password</label>
                                                        <input type="password" class="form-control" name="doc_pwd" id="doc_pwd" placeholder="Enter New Password">
                                                    </div>
                                                </div> <!-- end col -->
                                            

                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label for="useremail">Confirm Password</label>
                                                        <input type="password" class="form-control" id="useremail" name="doc_pwd_con" placeholder="Confirm New Password">
                                                    </div>
                                                </div> <!-- end col -->
                                            </div>
                                                                                      
                                            <div class="row">
                                                <div class="form-group col-md-5">
                                                    <label for="inputEmail4">Profile Picture</label>
                                                    <input type="file" name="doc_dpic" class="form-control btn btn-success" id="inputEmail4" >
                                                </div>
                                                <!-- <fieldset disabled> -->
                                                <div class="form-group" >
                                                    <?php 
                                                        $length = 5;    
                                                        $doc_number =  substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
                                                    ?>
                                                    <label for="useremail" > UserID</label>
                                                    <input type="text" name="doc_number" value="<?php echo $doc_number;?>" class="form-control" id="useremail">
                                                    
                                                </div>
                                                <!-- </fieldset> -->
                                            </div>

                                            <div class="text-right">                               
                                                <button type="submit" name="add_doc" class="ladda-button btn btn-primary" data-style="expand-right">
                                                Add Doctor    
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


        </div>
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
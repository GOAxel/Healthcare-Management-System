<?php
  session_start();
  include('assets/inc/config.php');
  include('assets/inc/checklogin.php');
  check_login();

  $pat_id=$_SESSION['pat_id'];
  //$doc_number = $_SERVER['doc_number'];
?>

<!DOCTYPE html>
    <html lang="en">

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

            <!--Get Details Of A Single User And Display Them Here-->
            <?php
                // $pat_number=$_GET['pat_number'];
                $app_id=$_GET['app_id'];
                $ret="SELECT  * FROM his_app WHERE app_id=?";
                $stmt= $mysqli->prepare($ret) ;
                $stmt->bind_param('i',$app_id);
                $stmt->execute() ;//ok
                $res=$stmt->get_result();
                //$cnt=1;
                while($row=$res->fetch_object())
            {
                $ret1="SELECT  * FROM his_docs WHERE doc_id=?";
                $stmt1= $mysqli->prepare($ret1) ;
                $stmt1->bind_param('i',$row->doc_id);
                $stmt1->execute() ;//ok
                $res1=$stmt1->get_result();
                $row1=$res1->fetch_object();

                // $mysqlDateTime = $row->pat_date_joined;
            ?>
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Patients</a></li>
                                            <li class="breadcrumb-item active">View appointment</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><?php echo $row1->doc_fname;?> <?php echo $row1->doc_lname;?> 's Appointment</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-lg-4 col-xl-4">
                                <div class="card-box text-center">
                                    <!-- <img src="assets/images/users/patient.png" class="rounded-circle avatar-lg img-thumbnail"
                                        alt="profile-image"> -->
                                        <img src="../doc/assets/images/users/<?php echo $row1->doc_dpic;?>" alt="dpic" class="rounded-circle avatar-lg img-thumbnai">


                                    
                                    <div class="text-left mt-3">
                                        
                                        <p class="text-muted mb-2 font-13"><strong>Doctor's Name :</strong> <span class="ml-2"><?php echo $row->doc_fname;?> </span></p>
                                        <p class="text-muted mb-2 font-13"><strong>Doctor's Specality :</strong><span class="ml-2"><?php echo $row->doc_specality;?></span></p>
                                        <p class="text-muted mb-2 font-13"><strong> Fees:</strong> <span class="ml-2"><?php echo $row->app_fees;?></span></p>
                                        <p class="text-muted mb-2 font-13"><strong>Symptoms Inputed :</strong> <span class="ml-2"><?php echo $row->pat_symptom;?></span></p>
                                        <p class="text-muted mb-2 font-13"><strong>Application Date</strong> <span class="ml-2"><?php echo $row->app_date;?></span></p>
                                        <p class="text-muted mb-2 font-13"><strong>Time Slot :</strong> <span class="ml-2"><?php echo $row->app_slot;?></span></p>
                                        <p class="text-muted mb-2 font-13"><strong>Application Status :</strong> <span class="ml-2"><?php echo $row->app_status;?></span></p>

                                        <!-- <hr>
                                        <p class="text-muted mb-2 font-13"><strong>Status :</strong> <span class="ml-2"><?php echo date("d/m/Y - h:m", strtotime($mysqlDateTime));?></span></p>
                                        <hr> -->




                                    </div>

                                </div> <!-- end card-box -->

                            </div> <!-- end col-->
                            
                           
                        <!-- end row-->

                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <?php include('assets/inc/footer.php');}?>
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

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>

    </body>


</html>
<?php
	session_start();
	include('assets/inc/config.php');
		if(isset($_POST['book_appointment']))
		{
		    $pat_fname=$_POST['pat_fname'];
            $pat_phone=$_POST['pat_phone'];
			$pat_symptom=$_POST['pat_symptom'];

			$doc_fname=$_POST['doc_fname'];
            $doc_specality=$_POST['doc_specality'];

            $app_slot=$_POST['app_slot'];
            $app_date=$_POST['app_date'];
      

      
            //sql to insert captured values
            $query="select doc_id from his_docs where doc_fname='$doc_fname' and doc_specality='$doc_specality'";
            $record=mysqli_query($mysqli,$query);
            $row1=mysqli_fetch_row($record);
            $doc_id=$row1[0];

            $query="select pat_id from his_patients where pat_fname='$pat_fname' and pat_phone='$pat_phone' ";
            $record=mysqli_query($mysqli,$query);
            $row2=mysqli_fetch_row($record);
            $pat_id=$row2[0];

			$query="insert into his_app (doc_id, pat_id, pat_fname, pat_symptom,pat_phone, doc_fname, doc_specality, app_slot, app_date) values(?,?,?,?,?,?,?,?,?)";
			$stmt = $mysqli->prepare($query);
			$rc=$stmt->bind_param('iisssssss', $doc_id, $pat_id,  $pat_fname, $pat_symptom, $pat_phone, $doc_fname, $doc_specality, $app_slot, $app_date);
			$stmt->execute();
			/*
			*Use Sweet Alerts Instead Of This Fucked Up Javascript Alerts
			*echo"<script>alert('Successfully Created Account Proceed To Log In ');</script>";
			*/ 
			//declare a varible which will be passed to alert function
			if($stmt)
			{
				$success = "Appointment Booked";
			}
			else {
				$err = "Please Try Again Or Try Later";
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
                                            <li class="breadcrumb-item"><a href="his_doc_dashboard.php">Dashboard</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Appointments</a></li>
                                            <li class="breadcrumb-item active">Book Appointment</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Book Appointment</h4>
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
                                        <!--Add Patient Form-->
                                        <form method="post">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4" class="col-form-label">First Name of Patient</label>
                                                    <input type="text" required="required" name="pat_fname" class="form-control" id="inputEmail4" placeholder="Patient's First Name">
                                                </div>
                                                
                                                <div class="form-group col-md-6">
                                                    <label for="inputAddress" class="col-form-label">Symptoms of Patient</label>
                                                    <input required="required" type="text" class="form-control" name="pat_symptom" id="inputAddress" placeholder="Patient's Symptoms">
                                                </div>
                                                <div class="form-row col-md-6">
                                                        <label for="inputCity" class="col-form-label">Mobile Number</label>
                                                        <input required="required" type="text" name="pat_phone" class="form-control" id="inputCity"placeholder="Patient's Mobile Number">
                                                </div>
                                            </div>


                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4" class="col-form-label">First Name of Doctor</label>
                                                    <input required="required" type="text" name="doc_fname" class="form-control"  id="inputPassword4" placeholder="Doctor`s First Name">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inpuSpecalitys" class="col-form-label">Specalization of Doctor</label>
                                                    <input required="required" type="text" class="form-control" name="doc_specality" id="inputAddress" placeholder="Doctor's Specalization">
                                                </div>
                                            </div>


                                            


                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4" class="col-form-label">Appointment Date</label>
                                                    <input type="Date" required="required" name="app_date" class="form-control" id="inputEmail4" placeholder="DD/MM/YYYY">
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="inputState" class="col-form-label">Time slot</label>
                                                    <select id="inputState" required="required" name="app_slot" class="form-control">
                                                        <option>Select time slot:</option>
                                                        <option>09:00 AM - 10:00 AM</option>
                                                        <option>10:00 AM - 11:00 AM</option>
                                                        <option>11:00 AM - 12:00 AM</option>
                                                        <option>12:00 PM - 1:00 PM</option>
                                                        <option>01:00 PM - 2:00 PM</option>
                                                        <option>02:00 PM - 3:00 PM</option>
                                                        <option>03:00 PM - 4:00 PM</option>
                                                        <option>04:00 PM - 5:00 PM</option>
                                                        <option>05:00 PM - 6:00 PM</option>
                                                        <option>06:00 PM - 7:00 PM</option>
                                                    </select>
                                                </div>

                                                
                                            </div>


                                            

                                            <button type="submit" name="book_appointment" class="ladda-button btn btn-primary" data-style="expand-right">Book Appointment</button>

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
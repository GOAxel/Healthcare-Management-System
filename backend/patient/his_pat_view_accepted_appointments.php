<?php
  session_start();
  include('assets/inc/config.php');
  include('assets/inc/checklogin.php');
  check_login();
  //$aid=$_SESSION['ad_id'];
  $pat_id = $_SESSION['pat_id'];


    if(isset($_GET['cancel']))
  {
        $id=intval($_GET['cancel']);
        $adn="update his_app set app_status='Cancel' where app_id=?";
        $stmt= $mysqli->prepare($adn);
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $stmt->close();	 
  
          if($stmt)
          {
            $success = "Appointment canceled";
          }
            else
            {
                $err = "Try Again Later";
            }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
    
<?php include('assets/inc/head.php');?>

    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
                <?php include('assets/inc/nav.php');?>
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);"> Appointments</a></li>
                                            <li class="breadcrumb-item active">View Appointments</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Appointments Details</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card-box">
                                    <h4 class="header-title"></h4>
                                    <div class="mb-2">
                                        <div class="row">
                                            <div class="col-12 text-sm-center form-inline" >
                                                <div class="form-group mr-2" style="display:none">
                                                    <select id="demo-foo-filter-status" class="custom-select custom-select-sm">
                                                        <option value="">Show all</option>
                                                        <option value="Discharged">Discharged</option>
                                                        <option value="OutPatients">OutPatients</option>
                                                        <option value="InPatients">InPatients</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <input id="demo-foo-search" type="text" placeholder="Search" class="form-control form-control-sm" autocomplete="on">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="table-responsive">
                                        <table id="demo-foo-filtering" class="table table-bordered toggle-circle mb-0" data-page-size="7">
                                            <thead>
                                            <tr>
                                            <th>#</th>
                                                <th data-toggle="true">Doctor's Name</th>
                                                <th data-hide="phone">Doctor's Specality</th>
                                                <th data-hide="phone">Doctor's Mobile Number</th>
                                                <th data-hide="phone">Doctor's  fees</th>
                                                <!-- <th data-hide="phone">Patient Phone</th> -->
                                                <!-- <th data-hide="phone">Patient Age</th> -->
                                                <th data-hide="phone">Appointment date</th>
                                                <th data-hide="phone">Time slot</th>
                                                <th data-hide="phone">status</th>

                                                <th data-hide="phone">Action</th>
                                            </tr>
                                            </thead>
                                            <?php
                                            /*
                                                *get details of allpatients
                                                *
                                            */
                                                // $r="select *from";
                                                $ret="SELECT * FROM  his_app where app_status = 'accept'and pat_id='$pat_id'"; 
                                                //sql code to get to ten docs  randomly
                                                $stmt= $mysqli->prepare($ret) ;
                                                $stmt->execute() ;//ok
                                                $res=$stmt->get_result();

                                                $cnt=1;
                                                while($row=$res->fetch_object())
                                                {   
                                                    $ret1="SELECT *  FROM  his_docs where doc_id='$row->doc_id' "; 
                                                    //sql code to get to ten docs  randomly
                                                    $stmt1= $mysqli->prepare($ret1) ;
                                                    $stmt1->execute() ;//ok
                                                    $res1=$stmt1->get_result();
                                                    $row1=$res1->fetch_object()
                                            ?>
                                        

                                                <tbody>
                                                <tr>
                                                <td><?php echo $cnt;?></td>
                                                    <td><?php echo $row->doc_fname;?></td>
                                                    <td><?php echo $row->doc_specality;?></td>
                                                    <td><?php echo $row1->doc_phone;?></td>
                                                    <td><?php echo $row1->doc_fees;?></td>
                                                    <td><?php echo $row->app_date;?> </td>
                                                    <td><?php echo $row->app_slot;?></td>
                                                    <td><?php echo $row->app_status;?></td>

                                                    
                                                    <td><a href="his_pat_view_single_patient_appointment.php?app_id=<?php echo $row->app_id;?>>" class="badge badge-primary"><i class="mdi mdi-eye"></i> View</a>

                                                    <!-- <a href="his_doc_view_accepted_appointments.php?complete=<?php echo $row->app_id;?>" class="badge badge-success"><i class="mdi mdi-pencil-outline"></i> completed</a> -->

                                                    <a href="his_pat_view_accepted_appointments.php?cancel=<?php echo $row->app_id;?>" class="badge badge-danger"><i class="mdi  mdi-trash-can-outline"></i> cancel</a>

                                                </td>



                                                    
                                                </tbody>
                                            <?php  $cnt = $cnt +1 ; }?>
                                            <tfoot>
                                            <tr class="active">
                                                <td colspan="8">
                                                    <div class="text-right">
                                                        <ul class="pagination pagination-rounded justify-content-end footable-pagination m-t-10 mb-0"></ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div> <!-- end .table-responsive-->
                                </div> <!-- end card-box -->
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

        <!-- Footable js -->
        <script src="assets/libs/footable/footable.all.min.js"></script>

        <!-- Init js -->
        <script src="assets/js/pages/foo-tables.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
        
    </body>

</html>
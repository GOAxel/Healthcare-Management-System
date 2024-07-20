<?php
session_start();
include('assets/inc/config.php');
include('assets/inc/checklogin.php');
check_login();
$pat_id = $_SESSION['pat_id'];

// Function to fetch booked slots
function getBookedSlots($mysqli, $date, $doc_id) {
    $query = "SELECT app_slot, COUNT(*) as count FROM his_app WHERE app_date = ? AND doc_id = ? GROUP BY app_slot";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('si', $date, $doc_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $bookedSlots = [];
    while ($row = $result->fetch_assoc()) {
        if ($row['count'] >= 2) {
            $bookedSlots[] = $row['app_slot'];
        }
    }
    $stmt->close();
    return $bookedSlots;
}

$bookedSlots = []; // Initialize booked slots data

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch booked slots data only when needed
    $app_date = $_POST['app_date'];
    $doc_fname = $_POST['doc_fname'];
    $doc_specality = $_POST['doc_specality'];

    $query = "SELECT doc_id FROM his_docs WHERE doc_fname = ? AND doc_specality = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('ss', $doc_fname, $doc_specality);
    $stmt->execute();
    $stmt->bind_result($doc_id);
    $stmt->fetch();
    $stmt->close();

    if (isset($doc_id)) {
        $bookedSlots = getBookedSlots($mysqli, $app_date, $doc_id);
    }
}

$allSlots = [
    '09:00 AM - 10:00 AM',
    '10:00 AM - 11:00 AM',
    '11:00 AM - 12:00 AM',
    '12:00 PM - 1:00 PM',
    '01:00 PM - 2:00 PM',
    '02:00 PM - 3:00 PM',
    '03:00 PM - 4:00 PM',
    '04:00 PM - 5:00 PM',
    '05:00 PM - 6:00 PM',
    '06:00 PM - 7:00 PM',
];
?>

<!DOCTYPE html>
<html lang="en">
    <!-- Head -->
    <?php include('assets/inc/head.php'); ?>
    <body>
        <!-- Begin page -->
        <div id="wrapper">
            <!-- Topbar Start -->
            <?php include("assets/inc/nav.php"); ?>
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            <?php include("assets/inc/sidebar.php"); ?>
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
                                        <!-- Add Patient Form -->
                                        <form method="post">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <?php
                                                    $ret1 = "SELECT * FROM his_patients WHERE pat_id=?";
                                                    $stmt1 = $mysqli->prepare($ret1);
                                                    $stmt1->bind_param('i', $pat_id);
                                                    $stmt1->execute();
                                                    $res1 = $stmt1->get_result();
                                                    $row1 = $res1->fetch_object();
                                                    ?>
                                                    <label for="inputEmail4" class="col-form-label">First Name of Patient</label>
                                                    <input type="text" name="pat_fname" value="<?php echo $row1->pat_fname; ?>" class="form-control" id="useremail">
                                                </div>
                                                
                                                <div class="form-group col-md-6">
                                                    <label for="inputAddress" class="col-form-label">Symptoms of Patient</label>
                                                    <input required="required" type="text" class="form-control" name="pat_symptom" id="inputAddress" placeholder="Patient's Symptoms">
                                                </div>
                                                <div class="form-row col-md-6">
                                                    <label for="inputCity" class="col-form-label">Mobile Number</label>
                                                    <input type="text" name="pat_phone" value="<?php echo $row1->pat_phone; ?>" class="form-control" id="useremail">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4" class="col-form-label">First Name of Doctor</label>
                                                    <input required="required" type="text" name="doc_fname" class="form-control" id="inputPassword4" placeholder="Doctor's First Name">
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="inpuSpecalitys" class="col-form-label">Specialization of Doctor</label>
                                                    <input required="required" type="text" class="form-control" name="doc_specality" id="inputAddress" placeholder="Doctor's Specialization">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4" class="col-form-label">Appointment Date</label>
                                                    <input type="date" required="required" name="app_date" class="form-control" id="inputEmail4">
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="inputState" class="col-form-label">Time slot</label>
                                                    <select id="inputState" required="required" name="app_slot" class="form-control">
                                                        <option>Select time slot:</option>
                                                        <?php
                                                        foreach ($allSlots as $slot) {
                                                            if (!in_array($slot, $bookedSlots)) {
                                                                echo "<option value='$slot'>$slot</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <button type="submit" name="book_appointment" class="ladda-button btn btn-primary" data-style="expand-right">Book Appointment</button>
                                        </form>
                                        <!-- End Patient Form -->
                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                    </div> <!-- container -->
                </div> <!-- content -->
                <!-- Footer Start -->
                <?php include('assets/inc/footer.php'); ?>
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

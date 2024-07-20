<?php
	session_start();
	include('assets/inc/config.php');
    include('assets/inc/checklogin.php');
  check_login();
  $pat_id=$_SESSION['pat_id'];
  $flag = 0;
		if(isset($_POST['book_appointment']))
		{
            $flag = 1;
            $symptom1 = $_POST["symptom1"];
            $symptom2 = $_POST["symptom2"];
            $symptom3 = $_POST["symptom3"];
            $symptom4 = $_POST["symptom4"];

            // Retrieve other symptoms as needed

            // Combine symptoms into a string
            $symptomsString = $symptom1 . " " . $symptom2 . " " . $symptom3 . " " . $symptom4;

            // Save symptoms to a text file
            $file = fopen("input.txt", "w") or die("Unable to open file!");
            fwrite($file, $symptomsString);
            fclose($file);
            sleep(5);
            header("location:his_pat_view_predicted_disease.php");
        }
?>
<!--End Server Side-->
<!--End Patient Registration-->
<!DOCTYPE html>
<html lang="en">

<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 10px;
        height: 10px;
        margin: 20% 20% 20% 20%;
        background-color: rgba(0,0,0,0);
    }

    .modal-content {
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 50%;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>

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
                                            <li class="breadcrumb-item active">Predict Disease</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Predict Disease</h4>
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
                                        <form method="post" onsubmit="predictDisease(); showPredictButton();">

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                        <label for="inputAddress" class="col-form-label">Symptom 1</label>
                                                        <select id="symptom1" name="symptom1" required="required" name="app_slot" class="form-control">                                                      
                                                        <option>Select Symptom 1:</option>
                                                        <?php
                                                            // Read the symptoms from the text file
                                                            $file = fopen("symptoms.txt", "r");
                                                            while (!feof($file)) {
                                                                $symptom = fgets($file);
                                                                if (!empty(trim($symptom))) {
                                                                    echo '<option>' . htmlspecialchars(trim($symptom)) . '</option>';
                                                                }
                                                            }
                                                            fclose($file);
                                                        ?>
                                                    </select>                                                      
                                                </div>
                                                    
                                                    <div class="form-group col-md-6">
                                                        <label for="inputAddress" class="col-form-label">Symptom 2</label>
                                                        <select id="symptom2" name="symptom2" required="required" name="app_slot" class="form-control">                                                      
                                                        <option>Select Symptom 2:</option>
                                                        <?php
                                                            // Read the symptoms from the text file
                                                            $file = fopen("symptoms.txt", "r");
                                                            while (!feof($file)) {
                                                                $symptom = fgets($file);
                                                                if (!empty(trim($symptom))) {
                                                                    echo '<option>' . htmlspecialchars(trim($symptom)) . '</option>';
                                                                }
                                                            }
                                                            fclose($file);
                                                        ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="inputEmail4" class="col-form-label">Symptom 3</label>
                                                        <select id="symptom3" name="symptom3" required="required" name="app_slot" class="form-control">                                                      
                                                        <option>Select Symptom 3:</option>
                                                        <?php
                                                            // Read the symptoms from the text file
                                                            $file = fopen("symptoms.txt", "r");
                                                            while (!feof($file)) {
                                                                $symptom = fgets($file);
                                                                if (!empty(trim($symptom))) {
                                                                    echo '<option>' . htmlspecialchars(trim($symptom)) . '</option>';
                                                                }
                                                            }
                                                            fclose($file);
                                                        ?>
                                                        </select>
                                                    </div>

                                                     <div class="form-group col-md-6">
                                                        <label for="inpuSpecalitys" name="symptom4" class="col-form-label">Symptom 4</label>
                                                        <select id="symptom4" name="symptom4" required="required" name="app_slot" class="form-control">                                                      
                                                        <option>Select Symptom 4:</option>
                                                        <?php
                                                            // Read the symptoms from the text file
                                                            $file = fopen("symptoms.txt", "r");
                                                            while (!feof($file)) {
                                                                $symptom = fgets($file);
                                                                if (!empty(trim($symptom))) {
                                                                    echo '<option>' . htmlspecialchars(trim($symptom)) . '</option>';
                                                                }
                                                            }
                                                            fclose($file);
                                                        ?>
                                                        
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <button type="submit" name="book_appointment" class="ladda-button btn btn-primary" data-style="expand-right">Submit Symptoms</button>
                                                    </div>
                                            </div>

                                                <!-- </div> -->
                                            
                                        </div>
                                            
                                           
                                        </form>
                                        
                                    
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                       
                        <!-- <div class="col-md-6">
                            <button id="predictButton" class="btn btn-primary"  onclick="displayModal()"> Disease</button>
                        </div>   -->

</div>
                    </div> <!-- container -->
                    
                </div> <!-- content -->

                <!-- Footer Start -->
                <?php include('assets/inc/footer.php');?>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->
            <div id="predictionModal" class="modal" style="display: none; height: 50%; width: 50%; margin:15% 27%; ">
                            <div class="modal-content" style="background-color: skyblue; ">
                                <span class="close">&times;</span>
                                <h2>Predicted Disease is</h2>
                                <h2 id="predictionResult" style="color: Red; "></h2>
                                <!-- <div id="predictionResult"></div> -->
                            </div>
            </div>
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
        <script>

        function displayModal() {
            document.getElementById("predictionModal").style.display = "block";
            predictDisease();
        }

    // Function to fetch and display prediction data
    function predictDisease() 
    { 
        console.log("Predict Disease function called");

        <?php
            // Command to execute the Python script
            $command = 'python predictDisease.py';

            // Execute the command and capture the output
            $output = shell_exec($command);
            // Output the result
            //echo $output;
            ?>  
        // Fetch data from "output.txt" file (assuming you meant to fetch from "output.txt")
        fetch("Output.txt")
            .then(response => response.text())
            .then(data => {
                // Display data in the modal
                document.getElementById("predictionResult").innerText = data;
            })
            .catch(error => console.error('Error fetching data:', error));
    }


        // Event listener for closing the modal
        document.getElementsByClassName("close")[0].addEventListener("click", function() {
            document.getElementById("predictionModal").style.display = "none";
        });

        // Function to show the "Predict Disease" button
        function showPredictButton() {
            document.getElementById("predictButton").style.display = "block";
            document.getElementById("predictButton").addEventListener("click", function() {
                predictDisease();
            });
        }
</script>
    </body>

</html>
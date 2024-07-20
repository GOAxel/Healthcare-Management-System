<?php
	session_start();
	include('assets/inc/config.php');
?>
<!DOCTYPE html>
    <html lang="en">
        <?php include('assets/inc/head.php');?>
    <body>
    <style>
    #predictedDisease {
        color: Red;
    }

    </style>
        <!-- Begin page -->
        <div id="wrapper">
            <!-- Topbar Start -->
            <?php include('assets/inc/nav.php');?>
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
                <?php include('assets/inc/sidebar.php');?>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
            <?php
                $pat_id=$_SESSION['pat_id'];
                $ret="SELECT * FROM  his_patients where pat_id=?";
                $stmt= $mysqli->prepare($ret) ;
                $stmt->bind_param('i',$pat_id);
                $stmt->execute() ;//ok
                $res=$stmt->get_result();
                //$cnt=1;
                while($row=$res->fetch_object())
                {
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
                                                <li class="breadcrumb-item active">Profile</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">Predicted Disease :</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title -->

                            <div class="row" >
                                <div class="col-lg-8 col-xl-6">
                                    <div class="card-box text-center">
                                       

                                        
                                        <div class="text-left mt-3">
                                            
                                        <p class="text-muted mb-2 font-18"><strong>Inputed Symptoms :</strong> <span  class="data ml-2" id="inputSymptoms" class="ml-2"></span></p>
                                        <p class="text-muted mb-2 font-20"><strong>Predicted Disease :</strong> <span  class="data ml-2"id="predictedDisease" class="ml-2"></span></p> 

                                           

                                        </div>

                                    </div> <!-- end card-box -->

                                </div> <!-- end col-->
                            </div> <!-- end col-->

                                <div class="row" >
                                    <div class="form-group col-md-2">
                                        <a href="his_pat_predict_disease_from_symtom.php">
                                        <button type="submit" name="book_appointment" class="ladda-button btn btn-primary" data-style="expand-right">Reinput Symptoms</button>
                                    </div>


                                    <div class="form-group col-md-2">
                                        <a href="his_pat_view_predicted_disease.php">
                                        <button  id="searchBtn" class="ladda-button btn btn-primary" data-style="expand-right" onclick="openGoogleSearch()">Search For Remedies</button>
                                    </div>  
                                   
                                    <div class="form-group col-md-2">
                                        <a href="his_pat_view_doctors.php">
                                        <button type="submit" name="book_appointment" class="ladda-button btn btn-primary" data-style="expand-right">Go for Doctor</button>
                                    </div>
                                </div>

                            

                         </div> 
                        </div> 

                                

                                            

                    <!-- Footer Start -->
                    <?php include("assets/inc/footer.php");?>
                    <!-- end Footer -->

                </div>
            <?php }?>
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

        <script>
    var searchQuery = "";
    function openGoogleSearch() {
        // Define the search query
        //var searchQuery = "remedies"; // Change this to your desired search query
        searchQuery = "Remedies on " + searchQuery;
        // Encode the search query for use in the URL
        var encodedQuery = encodeURIComponent(searchQuery);

        // Construct the Google search URL
        var googleSearchUrl = "https://www.google.com/search?q=" + encodedQuery;

        // Open the Google search in a new tab/window
        window.open(googleSearchUrl, "_blank");
    }

        
            
    // Function to fetch and display inputted symptoms and predicted disease
    function displayData() {
        // Fetch inputted symptoms from "input.txt" file
        fetch("input.txt")
            .then(response => response.text())
            .then(data => {
                // Split the inputted symptoms by comma (if multiple) and join them with commas
                const inputSymptoms = data.split(' ').join(', ');
                // Display inputted symptoms in the corresponding HTML element
                document.getElementById("inputSymptoms").innerText = inputSymptoms;
            })
            .catch(error => console.error('Error fetching inputted symptoms:', error));

        // Fetch predicted disease from "output.txt" file
        fetch("Output.txt")
            .then(response => response.text())
            .then(data => {
                // Split the predicted disease by comma (if multiple) and join them with commas
                //const predictedDisease = data.split(',').join(', ');
                // Display predicted disease in the corresponding HTML element
                document.getElementById("predictedDisease").innerText = data;
                searchQuery = data;
            })
            .catch(error => console.error('Error fetching predicted disease:', error));
    }

    // Call the displayData function when the page loads
    window.onload = displayData;
</script>

    </body>


</html>
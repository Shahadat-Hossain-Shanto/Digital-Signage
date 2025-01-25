<?php

//connect to database
// Your database connection details
/*$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mdm-new-site";*/

// $servername = "mobi-manager.com";
// $username = "mobimana_mobimanager_user";
// $password = "iWb~B^cszbn[";
// $dbname = "mobimana_mobimanager_db";


// //Create Connection
// $connection = new mysqli($servername, $username, $password, $dbname);

// //Check connection stablished or not!
// if ($connection->connect_error) {
//    die("Connection failed: " . $connection->connect_error);
// }



// $id = "";
// $ticketNumber = "";
// $name = "";
// $email = "";
// $orgName = "";
// $mobile = "";

// $issueTitle = "";
// $issue_descriptionn = "";
// $status = "";

// $errorMessage = "";
// $successMessage = "";


// if ($_SERVER['REQUEST_METHOD'] == 'GET') {

//         # Request Received using GET method
//         # then editing-> show the data of the employee...

//         //Check Id is exist or not!

//  if (!isset($_GET["id"])) {
//              #if not exist then
//    header("location: ./index.php");
//    exit;

// }

//         //if exist employee id

// $id = $_GET["id"];

// $sql = "SELECT * FROM support WHERE id=$id";
// $result = $connection->query($sql);
// $row = $result->fetch_assoc();

// if (!$row) {
//             #if row does not consist any value
//    header("location: ./index.php");
//    exit;
// }


//         //if row consist value, then read all the data from database and store it in form variable.
// $ticketNumber =$row["ticketNumber"];
// $name =$row["name"];
// $email =$row["email"];
// $orgName =$row["orgName"];
// $mobile =$row["mobile"];
// $issueTitle =$row["issueTitle"];
// $issue_descriptionn =$row["issue_descriptionn"];
// $status =$row["status"];



// }else {
//         # request Reveived form POST
//         # POST method update the data of Employee...
//  $id = $_POST["id"];
//  $ticketNumber = $_POST["ticketNumber"];
//  $name = $_POST["name"];
//  $email = $_POST["email"];
//  $orgName = $_POST["orgName"];
//  $mobile = $_POST["mobile"];
//  $issueTitle = $_POST["issueTitle"];
//  $issue_descriptionn = $_POST["issue_descriptionn"];
//  $status = $_POST["status"];

//  do {
//             # code...
//    if (empty($id) || empty($name) || empty($email) || empty($mobile) || empty($orgName) || empty($issueTitle) ) {
//                 # code...
//             $errorMessage = "All fields are required!";
//             break;

//       }

//   /*$sql = "UPDATE support SET name = '$name', email = '$email', mobile = '$mobile', address = '$address' WHERE id='$id'";*/
//   $sql = "UPDATE support SET status = '$status' WHERE id='$id'";

//   $result = $connection->query($sql);

//   if (!$result) {
//      die("Invalid query : " . $connection->error);
//      break;
//   }

//   $successMessage = "Employee Updated Successfully!";
//   header("location: ./support-data-list.php");
//   exit;



// } while (false);



// }
// ?>

<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="utf-8">
 <meta content="width=device-width, initial-scale=1.0" name="viewport">

 <title>24/7 Support</title>
 <meta content="" name="description">
 <meta content="" name="keywords">

 <!-- Favicons -->
 <link href="assets/img/favicon.png" rel="icon">
 <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

 <!-- Google Fonts -->
 <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

 <!--  CSS Files -->

 {{-- <link href="assets/vendor/aos/aos.css" rel="stylesheet">
 <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
 <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
 <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
 <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
 <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet"> --}}

<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/aos/aos.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">


 <!-- Latest version from CDN sweetaleart -->
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>



 <!-- Add jQuery -->
 <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>



 <!--  Main CSS File -->
 {{-- <link href="assets/css/style.css" rel="stylesheet"> --}}


 <style>
   /* Style the section container */
   .partner-area {
     background-color: #FFFFFF; /* Set a background color */
     padding: 30px 0; /* Add padding to the top and bottom */
  }

/* Style the section title */
.partner-area .section-title {
 text-align: center;
 margin-bottom: 0px; /*40*/
}

.partner-area .section-title h2 {
 font-size: 32px;
 color: #5777BA; /* Set the title color */
}

/* Style the partner logos */
.single-partner{
 text-align: center;
 margin-bottom: 30px;
 padding: 15px;
 border: 0px solid #ddd !important; /* Add a border around each logo */
 box-shadow: 0px 2px 15px rgba(0, 0, 20, 0.9);
 border-radius: 12px;
}

.single-partner-wasim{
 text-align: center;
 margin-bottom: 30px;
 padding: 11px;
 border: 0px solid #ddd !important; /* Add a border around each logo */
 box-shadow: 0px 2px 15px rgba(0, 0, 20, 0.9);
 border-radius: 12px;
}

/*.border{

  border: 0.0px solid #ddd !important;
}*/



.single-partner a {
 display: block;
}

.single-partner img {
 max-width: 100%;
 height: auto;
}

/* Responsiveness for smaller screens */
@media (max-width: 768px) {
 .partner-area .col-lg-2 {
  text-align: center;
  margin-bottom: 30px;
}
}

.wasimDiv{
 box-shadow: 0px 2px 15px rgba(0, 0, 20, 0.3);
 border-radius: 12px;
}


.wasim-new{


 margin-left: 20px !important;
 background-color: red;
}



*{
 padding: 0px;
 margin:0px;
}
.navbar{
 margin: 0px;
}
.error {
 color: red;
 font-style: italic;
}

.mycolor{
 background: #748EC6;
}
.text-w{
 color:#748EC6;
}
.background-color-w{
 color:#F2F5FA;
}

.section-bg {
 background-color: #f2f5fa;
 padding: 0px;
 margin: 0px;
}

.card-shadow{
 background-color: #ffffff;
 border-radius: 10px;
 box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.1);
 padding: 30px;
 font-family: "Open Sans", sans-serif;

}

#output {
 font-size: 24px; /* Change the font size as needed */
 color: green; /* Change the color as needed */
 margin-bottom: 20px;
}


.bg-image{
   /* background:transparent url(assets/img/digitalsignage.jpeg) 100% 0 no-repeat;
    background-size:cover;
    background-position:40%*/
    background-color: #e2e2e2;


 }

</style>



</head>

<body>



 <!-- ======= Header ======= -->
 <header id="header" class="fixed-top  header-transparent">
    <!-- Top Links -->
    <div class="top-links">
        <a href="{{url('/request-a-demo')}}">Schedule A Demo |</a>
        <a href="{{url('/contact_us')}}">Contact Sale:+88 01916574623</a>&nbsp;&nbsp;


    </div>
    <!-- Top Links -->
    <div class="container d-flex align-items-center  extraSpaceBetweenMenu justify-content-between">



      <div class="logo">
        <!-- <a href="index.html"><img src="assets/img/unnamed.png" alt="" class="img-fluid"></a> -->
        <a href="{{url('/home')}}"><img src="{{ asset('assets/img/mobimanager.png') }}" alt="" class="img-fluid"><span style="color:#7393D6; font-size: 20px; font-weight:700;" >ScreenCast</span></a>


      </div>


      <!-- navbar -->
       <nav id="navbar" class="navbar">
        <ul>

          <!-- <li class="dropdown"><a href="#values"><span>Solutions</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="mdm.html">Mobile Device Management (MDM)</a></li>

              <li><a href="kiosklockdown.html">Kiosk Lockdown</a></li>
              <li><a href="digital-signage.html">Digital Signage</a></li>
              <li><a href="https://mobimanager.inovexidea.com:8443/MobiManager-Parental/" target="_blank">Parental Control</a></li>
              <li><a href="rugged-device-management.html">Rugged Device Management</a></li>


            </ul>
          </li>  -->

          <!-- <li><a class="nav-link scrollto" href="#features">Features</a></li>


          <li><a class="nav-link scrollto" href="#partners">Clients</a></li>

          <li><a class="nav-link scrollto" href="#pricing">Pricing</a></li> -->

          <!-- <li class="dropdown"><a href="contact-us.html"><span>Contact</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li>
                <a href="request-a-demo.html">📑 Request A Demo</a>
              </li>
              <li>
                <a href="contact-us.html">📝 Contact Us</a>

              </li>
              <li>

                <a href="support.html">💁🏼‍♀️ Need Support?</a>

              </li>


            </ul>
          </li> -->

          <li class="dropdown"><a href="#"><span style="color:forestgreen; font-weight: 600;">All Request</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li>
                <a href="{{url('/request-a-demo-data-list')}}">📑 Demo Request</a>
              </li>
              <li>
                <a href="{{url('/contact-us-data-list')}}">📝 Contact Request</a>

              </li>
              <li>

                <a href="{{url('/support-data-list')}}">💁🏼‍♀️ Support Request</a>

              </li>
              <li><a href="{{url('/partner-data-list')}}">🤝 Partner Request</a></li>


            </ul>
          </li>

          <!-- <li><a class="getstarted scrollto" style="background-color: #8eace8; font-weight: 600;" href="request-a-demo.html">7 Days Free Trial</a></li> -->

          <li>
            <form id="logout-form" action="{{ url('/logoutl') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="getstarted scrollto" style="background-color: #8eace8; font-weight: 500; border: none; cursor: pointer;">
                    Logout
                </button>
            </form>
        </li>
        </ul>


        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
      <!-- .navbar -->



    </div>
  </header><!-- End Header -->



<main id="main">

 <!-- ======= Breadcrumbs Section ======= -->

 <section class="breadcrumbs">
   <div class="container">

     <div class="d-flex justify-content-between align-items-center">
       <h2>Inner Page</h2>
       <ol>
         <li><a href="{{url('/home')}}">Home</a></li>
         <li>Inner Page</li>
      </ol>
   </div>

</div>
</section>
<!-- End Breadcrumbs Section -->

<section class="inner-page" style="background-color: #f8f9fa;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <!-- Column -->
            <div class="col-md-10 col-lg-8" data-aos="fade-up">
                <div class="card mt-3 shadow-sm border-0">
                    <div class="card-body p-4">
                        <h3 class="text-center text-dark">Support Request Form</h3>
                        <p class="text-center text-muted mb-4">Please fill out the form below for a new support request!</p>
                        <p class="text-center text-secondary" style="font-family: initial;">
                            <em>Remember your ticket number for further queries.</em>
                        </p>

                        <form action="{{ route('support-request.update', $supportRequest->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Two-column row for Ticket Number and Name -->
                            <div class="row">
                                <div class="form-group col-md-6 mb-3">
                                    <label for="ticketNumber" class="form-label">Ticket Number</label>
                                    <input type="text" id="ticketNumber" name="ticketNumber" value="{{ $supportRequest->ticketNumber }}" class="form-control" readonly>
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" id="name" name="name" value="{{ $supportRequest->name }}" class="form-control" required>
                                </div>
                            </div>

                            <!-- Two-column row for Email and Organization Name -->
                            <div class="row">
                                <div class="form-group col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" name="email" value="{{ $supportRequest->email }}" class="form-control">
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label for="orgName" class="form-label">Organization Name</label>
                                    <input type="text" id="orgName" name="orgName" value="{{ $supportRequest->orgName }}" class="form-control" required>
                                </div>
                            </div>

                            <!-- Two-column row for Contact Number and Issue Title -->
                            <div class="row">
                                <div class="form-group col-md-6 mb-3">
                                    <label for="mobile" class="form-label">Contact Number</label>
                                    <input type="text" id="mobile" name="mobile" value="{{ $supportRequest->mobile }}" class="form-control" required>
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label for="issueTitle" class="form-label">Issue Title</label>
                                    <input type="text" id="issueTitle" name="issueTitle" value="{{ $supportRequest->issueTitle }}" class="form-control" required>
                                </div>
                            </div>

                            <!-- Full-width for Issue Description -->
                            <div class="form-group mb-3">
                                <label for="issue_description" class="form-label">Issue Description</label>
                                <textarea id="issue_description" name="issue_description" class="form-control" rows="4" placeholder="Describe the issue in detail">{{ $supportRequest->issue_description }}</textarea>
                            </div>

                            <div class="form-group col-md-6 mb-4 ms-auto">
                                <label for="status" class="form-label">Status</label>
                                <select id="status" name="status" class="form-select">
                                    <option value="Received" {{ $supportRequest->status == 'Received' ? 'selected' : '' }}>Received</option>
                                    <option value="Processing" {{ $supportRequest->status == 'Processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="Completed" {{ $supportRequest->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                            </div>

                            <!-- Align the button to the right -->
                            <div class="form-group col-md-6 mb-4 text-end">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>

                            </div>
                        </form>
                    </div>
                    <!-- end of card-body -->
                </div>
                <!-- end of card -->
            </div>
            <!-- end of col-md-8 -->
        </div>
        <!-- end of row -->
    </div>
</section>




</main><!-- End #main -->










<!-- ======= Footer ======= -->
<footer id="footer">

   <div class="footer-newsletter footer-ads-section bg-gradient">
    <div class="container">


     <div class="row align-items-center">
      <div class="col-lg-8 col-md-8">
       <div class="footer-ads-section-content">

        <h3 style="font-size:40px; color:white">Let's Try ScreenCast</h3>
        <p>Request for 7 Days free trial | No credit card required.</p>
     </div>
  </div>
  <div class="col-lg-4 col-md-4">
    <div class="footer-ads-section-btn-box">
     <!-- <a class="btn btn-info" style="background-color: #93478F;" href="request-a-demo.html">Schedule a Demo</a> -->
     <a class="btn btn-info" style="background-color: #93478F;" href="{{url('/request-a-demo')}}">Free Trial</a>
  </div>

</div>
</div>

</div>
</div>





<!-- google map -->
<div class="footer-top">
 <div class="container">
  <div class="row">

   <div class="col-lg-3 col-md-6 footer-contact">
    <h3>ScreenCast</h3>
    <p>
     Venus Complex (Level-8, Unit-803),
     Kha-199/3-4 Progati Sharoni,<br> Dhaka-1212
     <br><br>

     <strong>Phone:</strong> +8801916574623<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; +8801858341848<br>
     <strong>Email:</strong> support@inovexidea.com<br>
  </p>
</div>

<div class="col-lg-3 col-md-6 footer-links">
 <h4>Useful Links</h4>
 <ul>
  <li><i class="bx bx-chevron-right"></i> <a href="https://www.inovexidea.com/">Home</a></li>
  <li><i class="bx bx-chevron-right"></i> <a href="https://www.inovexidea.com/abouts.html">About us</a></li>
  <li><i class="bx bx-chevron-right"></i> <a href="https://www.inovexidea.com/serviceList.html">Services</a></li>
  <li><i class="bx bx-chevron-right"></i> <a href="https://www.inovexidea.com/portfolio.html">Portfolio</a></li>
  <li><i class="bx bx-chevron-right"></i> <a href="https://www.inovexidea.com/">Privacy policy</a></li>
</ul>
</div>

<div class="col-lg-3 col-md-6 footer-links">
 <h4>Our Services</h4>
 <ul>
  <li><i class="bx bx-chevron-right"></i> <a href="#">IT Consultency</a></li>
  <li><i class="bx bx-chevron-right"></i> <a href="#">Web Application Development</a></li>
  <li><i class="bx bx-chevron-right"></i> <a href="#">Enterprise Solution Development</a></li>
  <li><i class="bx bx-chevron-right"></i> <a href="#">B2B & B2C Software Solution</a></li>
  <li><i class="bx bx-chevron-right"></i> <a href="#">Mobile App & IOT Development</a></li>
</ul>
</div>

<div class="col-lg-3 col-md-6 footer-links">
 <h4>Our Social Networks</h4>
 <!-- <p>Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p> -->
 <div class="social-links mt-3">
  <a href="https://www.inovexidea.com/" class="twitter"><i class="bx bxl-twitter"></i></a>
  <a href="https://www.facebook.com/inovexidea" class="facebook"><i class="bx bxl-facebook"></i></a>
  <a href="https://www.inovexidea.com/" class="instagram"><i class="bx bxl-instagram"></i></a>
  <!-- <a href="https://www.inovexidea.com/" class="google-plus"><i class="bx bxl-skype"></i></a> -->
  <a href="https://www.linkedin.com/company/inovex-idea-solution/" class="linkedin"><i class="bx bxl-linkedin"></i></a>
</div>
</div>

</div>
</div>
</div>

<div class="container py-4">
 <div class="copyright">
  &copy; Copyright <strong><span>INovex Idea Solution Limited</span></strong>. All Rights Reserved
</div>

</div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


<!-- AJAX Script -->
<script>
        // Function to handle form submission with AJAX
   function submitFormAjax() {


        /*new w*/
    var name = document.getElementById("name").value.trim();
    var email = document.getElementById("email").value.trim();
    var orgName = document.getElementById("orgName").value.trim();
    var mobile = document.getElementById("mobile").value.trim();
        //var numberOfSubscription = document.getElementById("numberOfSubscription").value.trim();
    var issueTitle = document.getElementById("issueTitle").value.trim();
        //var userTypeElement = document.querySelector('input[name="userType"]:checked');
    var issue_descriptionn = document.getElementById("issue_descriptionn").value.trim();
    var status = document.getElementById("status").value.trim();

        // Check if fields are empty
    if (name !== '' && orgName !== '' && mobile !== '' && issueTitle !== '' && issue_descriptionn !== '') {


        // Prevent the default form submission
     event.preventDefault();

            // Serialize the form data
     var formData = $("#supportRequestForm").serialize();

            // AJAX request
     $.ajax({
      type: "POST",
                url: "forms/process-support.php", // Path to your PHP file
                data: formData,
                success: function(response) {
                    // Update the HTML with the response message
                  $("#responseMessage").html(response);
                  // Clear all form fields
                  $("#supportRequestForm")[0].reset();
                  swal("Support Request Submitted Successfully!");
               },
               error: function(xhr, status, error) {
                  console.error("AJAX Request Error: " + error);
               }
            });




  }else{
     swal("Please fill in all required fields.");
  }



}
</script>
<!-- AJAX Script -->


<!-- AJAX Script for Search ticket Number -->
<script>
        // Function to handle form submission with AJAX
   function submitFormAjaxForCheckingTicketNumber() {
        //alert("Inside Searching Ticket...");

        /*new w*/
    var ticketNum = document.getElementById("ticketNum").value.trim();


        // Check if fields are empty

        /*if (name !== '' && orgName !== '' && mobile !== '' && issueTitle !== '' && issue_descriptionn !== '') {*/
    if (ticketNum !== '') {

          // Prevent the default form submission
     event.preventDefault();

            // Serialize the form data
     var formData = $("#formSearchTicketNumber").serialize();

            // AJAX request
     $.ajax({
      type: "GET",
                url: "forms/process-support-check-ticket-number.php", // Path to your PHP file
                data: formData,
                success: function(response) {
                    // Update the HTML with the response message
                  $("#responseMessageForSearchTicket").html(response);
                  // Clear all form fields
                  $("#formSearchTicketNumber")[0].reset();
                  //swal("Support Request Submitted Successfully!");
               },
               error: function(xhr, status, error) {
                  console.error("AJAX Request Error: " + error);
               }
            });




  }else{
     swal("Please input your ticket number");
  }



}
</script>
<!-- AJAX Script -->

<!-- SweetAlert script -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- random number code -->
    <!-- <script>
      document.addEventListener('DOMContentLoaded', function () {
            // Execute this code when the document is ready

            // Function to generate and display a random ticket number
        function generateRandomTicket() {
          var minDigits = 6;
          var maxDigits = 10;
          var randomDigits = Math.floor(Math.random() * (maxDigits - minDigits + 1)) + minDigits;
          var randomNumber = Math.floor(Math.random() * Math.pow(10, randomDigits));

          // Display the random ticket number in the output element
          document.getElementById('output').innerText = 'Ticket Number: ' + 'TN#'+randomNumber;

          // Retrieve the ticket number from the output div and set it in the hidden input
          var ticketNumber = document.getElementById('output').innerText.replace('Ticket Number: ', '');
          document.getElementById('ticketNumber').value = ticketNumber;


        }

            // Generate a random ticket number when the document is ready
        generateRandomTicket();
      });
   </script> -->
   <!-- random number code -->




   <!-- JS Files -->
   {{-- <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
   <script src="assets/vendor/aos/aos.js"></script>
   <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
   <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
   <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
   <script src="assets/vendor/php-email-form/validate.js"></script> --}}


    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

   <!-- Main JS File -->
   {{-- <script src="assets/js/main.js"></script> --}}
   <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</body>

</html>

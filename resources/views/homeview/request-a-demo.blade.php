@extends('homeview.layouts.main')
@section('title', 'Request for Demo')
@section('main-container')

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <meta name="description" content="Experience the power of MobiManager Mobile Device Management with a personalized demo. Request a demo today to explore cutting-edge features, seamless device management, enhanced security, and productivity optimization. See firsthand how MobiManager can elevate your mobile device management strategy. Get started now and unlock the full potential of MobiManager MDM for your organization.">

  <meta property="og:type" content="MobiManager">

  <meta name="og:title" property="og:title" content="Request for Demo - MobiManager">

  <meta name="og:description" property="og:description" content="Experience the power of MobiManager Mobile Device Management with a personalized demo. Request a demo today to explore cutting-edge features, seamless device management, enhanced security, and productivity optimization. See firsthand how MobiManager can elevate your mobile device management strategy. Get started now and unlock the full potential of MobiManager MDM for your organization.">

  <meta property="og:site_name" content="MobiManager">

  <meta name="keywords" content="MobiManager demo, mobile device management demo, MDM features, device security demo, productivity optimization, MobiManager capabilities, mobile management demonstration, MDM software, request demo for MobiManager, MDM, Kiosk lockdown, Rugged Device Managemtn, Digital Signage, best mobile device management MDM in Bangladesh, mobile security solution, Mobile Device Management Software in Bangladesh, Best MDM software solution provider in bangladesh, Best Android Mobile Device Management Software Solution provider vendor in Bangladesh, kiosklockdown app, POS system, Management Software System, Digital Signage, rugged device management, MobiManager is the best Mobile Device Solution (MDM) Software provider in bangladesh.">

  <meta name="og:keywords" property="og:keywords" content="MobiManager demo, mobile device management demo, MDM features, device security demo, productivity optimization, MobiManager capabilities, mobile management demonstration, MDM software, request demo for MobiManager, MDM, Kiosk lockdown, Rugged Device Managemtn, Digital Signage, best mobile device management MDM in Bangladesh, mobile security solution, Mobile Device Management Software in Bangladesh, Best MDM software solution provider in bangladesh, Best Android Mobile Device Management Software Solution provider vendor in Bangladesh, kiosklockdown app, POS system, Management Software System, Digital Signage, rugged device management, MobiManager is the best Mobile Device Solution (MDM) Software provider in bangladesh.">



  <!-- Add jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <!-- Latest version from CDN sweetaleart -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


  <style>

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


input::placeholder {
  font-family: serif;
  opacity: 0.3;

}


/* General alert styling */
.alert {
    display: none; /* Hidden initially */
    padding: 20px;
    border-radius: 8px; /* Rounded corners */
    font-size: 16px;
    font-weight: bold;
    position: relative;
    margin-bottom: 20px;
    opacity: 0; /* Initially hidden */
    transition: opacity 0.5s ease-in-out; /* Fade-in effect */
}

/* Success message styling */
.alert-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

/* Error message styling */
.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

/* Icon for success */
.alert-success::before {
    content: "✔️"; /* Success check mark */
    font-size: 20px;
    margin-right: 10px;
}

/* Icon for error */
.alert-danger::before {
    content: "❌"; /* Error cross mark */
    font-size: 20px;
    margin-right: 10px;
}

/* Custom styling for the text content */
.alert p {
    margin: 0;
}

/* Animation for fade-in */
.show-alert {
    display: block;
    opacity: 1;
}


</style>



</head>

<body>

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

        <!-- Success message -->
        @if(session('success'))
            <div id="successMessage" class="alert alert-success show-alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <!-- Error message -->
        @if(session('error'))
            <div id="errorMessage" class="alert alert-danger show-alert">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <!-- Add this at the end of the file -->
        <script>
            // Show and fade out success message after 3 seconds
            setTimeout(function() {
                $('#successMessage').fadeOut();
            }, 3000); // 3000ms = 3 seconds

            // Show and fade out error message after 3 seconds
            setTimeout(function() {
                $('#errorMessage').fadeOut();
            }, 3000); // 3000ms = 3 seconds
        </script>

    <section class="inner-page" style="background-color: #ffffff;">
      <div class="container">


        <div class="row">
          <!-- <div class="col-lg-6 d-lg-flex flex-lg-column align-items-stretch hero-img" data-aos="fade-up">
            <img src="assets/img/mobimanager-kiosk.png" style="height: 100%; width: 100%;" class="img-fluid" alt="">
          </div> -->



          <!-- Starto of Column-1 -->

          <div class="col-md-6" data-aos="fade-up">


            <div class="row">

              <div class="mt-5 p-0  text-center" data-aos="fade-up">
                <img src="assets/img/request-a-demo.jpg" class="img-fluid" alt="">
                <!-- <img src="assets/img/kiosk lockdown.png" class="img-fluid" alt="MobiManager" > -->
              </div>
            </div>

          </div>
          <!-- end of col-md6 -->

          <!-- End of Column-1 -->





          <!-- Column-2 -->
          <div class="col-md-6" data-aos="fade-up">
            <div class="card mt-3 card-shadow">
              <div class="card-body">


                <h3 class="text-center text-w" style="color:#007CFF">Book a Live Demo</h3>
                <p class="text-center">Secure a Personalized Live Demonstration and Receive Comprehensive Answers to Your Inquiries.</p>

                <form id="supportRequestForm" class="mt-5" method="POST" action="{{ route('demo.request.store') }}">
                    @csrf





                  <div class="row">


                    <div class="col-md-12">
                      <div class="row">
                        <!-- First Column -->
                        <div class="col-md-6">
                          <div class="form-group" style="font-family: sans-serif;">
                            <label for="amount"> Name <span
                              style="color: red">*</span> :
                            </label> <input class="form-control" id="name" type="text"
                            name="name" required="required" />
                          </div>
                        </div>

                        <!-- Second Column -->
                        <div class="col-md-6">
                          <div class="form-group" style="font-family: sans-serif;">
                            <label for="amount">Email :</label> <input class="form-control"
                            type="email" name="email" id="email" />
                          </div>
                        </div>

                      </div>

                    </div>
                  </div>


                  <div class="row">

                    <div class="col-md-12">

                      <div class="row">

                        <!-- First Column -->
                        <div class="col-md-6">
                          <div class="form-group mt-3"style="font-family: sans-serif;">
                            <label for="amount">Organization Name <span
                              style="color: red">*</span> :
                            </label> <input class="form-control" id="orgName" type="text"
                            name="orgName" required="required" />

                          </div>
                        </div>



                        <!-- Second Column -->
                        <div class="col-md-6">
                          <div class="form-group mt-3" style="font-family: sans-serif;">
                            <label for="amount">Contact Number <span
                              style="color: red">*</span> :
                            </label> <input class="form-control" type="number" name="mobile"
                            id="mobile" required/>

                          </div>
                        </div>


                      </div>

                    </div>
                  </div>


                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <!-- First Column -->
                        <div class="col-md-12">
                          <div class="form-group mt-3" style="font-family: sans-serif;">
                            <label for="amount">Number of Screen<span
                              style="color: red">*</span> :
                            </label><br>
                            <input class="form-control" type="number"
                            name="numberOfScreen" id="numberOfScreen"
                            placeholder="How many screen are you playing?" required/>

                          </div>

                        </div>
                        <!-- Second Column -->


                      </div>

                    </div>
                  </div>


                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group mt-3">
                        <label for="screenType" style="font-family: sans-serif;">Screen Type<span style="color: red;">*</span>: </label>
                        <span style="margin-right: 10px;"></span> <!-- Add spacing after the colon -->

                        <div class="form-check form-check-inline" style="margin-right: 15px;">
                          <input class="form-check-input" type="radio" name="screenType" id="screenTypeAndroid" value="Android" required>
                          <label class="form-check-label" for="screenTypeAndroid" style="font-family: sans-serif;">Android</label>
                        </div>

                        <div class="form-check form-check-inline" style="margin-right: 15px;">
                          <input class="form-check-input" type="radio" name="screenType" id="screenTypeTV" value="TV" required>
                          <label class="form-check-label" for="screenTypeTV" style="font-family: sans-serif;">TV</label>
                        </div>

                        <div class="form-check form-check-inline" style="margin-right: 15px;">
                          <input class="form-check-input" type="radio" name="screenType" id="screenTypeChrome" value="Chrome" required>
                          <label class="form-check-label" for="screenTypeChrome" style="font-family: sans-serif;">Chrome</label>
                        </div>

                        <div class="form-check form-check-inline" style="margin-right: 15px;">
                          <input class="form-check-input" type="radio" name="screenType" id="screenTypeOthers" value="Others" required>
                          <label class="form-check-label" for="screenTypeOthers" style="font-family: sans-serif;">Others</label>
                        </div>

                      </div>
                    </div>
                  </div>




                  <div class="form-group mt-3" style="font-family: sans-serif;">
                    <label for="amount">Comment for ScreenCast :
                    </label><br><small id="emailHelp" class="form-text text-muted">(Include any use cases or specific requirements you might have)</small>
                    <textarea id="comments" name="comments" class="form-control" rows="3">

                    </textarea>
                  </div>



                  <div class="pt-3">
                    <input class="btn btn-lg text-white" style="width:100%; background-color: #007CFF;" type="submit" value="Submit">
                </div>

                </form>

              </div>
              <!-- end of card-body -->
            </div>
            <!-- end of card -->

          </div>
          <!-- end of col-md6 -->
        </div>
        <!-- end of row -->


      </div>
    </section>




  </main><!-- End #main -->


  <!-- AJAX Script -->
  <script>
        // Function to handle form submission with AJAX
    function submitFormAjax() {

      /*new w*/
      var name = document.getElementById("name").value.trim();
      var email = document.getElementById("email").value.trim();
      var orgName = document.getElementById("orgName").value.trim();
      var mobile = document.getElementById("mobile").value.trim();
      var numberOfSubscription = document.getElementById("numberOfSubscription").value.trim();
      //var userTypeTrial = document.getElementById("userTypeTrial").checked;
      //var userTypePurchase = document.getElementById("userTypePurchase").checked;
      var userTypeElement = document.querySelector('input[name="userType"]:checked');
      var comments = document.getElementById("comments").value.trim();

      // Check if fields are empty
      if (name !== '' && orgName !== '' && mobile !== '' && numberOfSubscription !== '' && userTypeElement !== null) {


             // Prevent the default form submission
        event.preventDefault();

            // Serialize the form data
        var formData = $("#supportRequestForm").serialize();

            // AJAX request
        $.ajax({
          type: "POST",
                url: "forms/process-request-demo.php", // Path to your PHP file
                data: formData,
                success: function(response) {
                    // Update the HTML with the response message
                  console.log(response);
                  $("#responseMessage").html(response);
                  // Clear all form fields
                  $("#supportRequestForm")[0].reset();
                  swal("Submitted Successfully!");
                },
                error: function(xhr, status, error) {
                  console.error("AJAX Request Error: " + error);
                }
              });
      }else{

        swal("Please fill in all required fields.");
          //return false;



      /*new w*/


      }
    }
  </script>

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
      }

            // Generate a random ticket number when the document is ready
      generateRandomTicket();
    });
  </script> -->
  <!-- random number code -->

@endsection

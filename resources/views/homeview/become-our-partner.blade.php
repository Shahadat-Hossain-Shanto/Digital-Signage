@extends('homeview.layouts.main')
@section('title', 'Join Digital Signage Partner Program')
@section('main-container')

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <meta name="description" content="">

  <meta property="og:type" content="MobiManager">

  <meta name="og:title" property="og:title" content="Contact Us - MobiManager">

  <meta name="og:description" property="og:description" content="">

  <meta property="og:site_name" content="MobiManager">


  <meta name="keywords" content="">


  <meta name="og:keywords" property="og:keywords" content="">

  <!-- Latest version from CDN sweetaleart -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


<style>


/*mega-menu-assistant*/

/*mega-menu-assistant*/
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





<!-- Add jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>




</head>

<body>




  <!-- Your HTML form content goes here -->

    <!-- <form id="supportRequestForm" class="mt-4">


        <input class="btn btn-lg pull-right text-white" style="width:100%; background-color: #93478F;" type="submit" onclick="submitFormAjax()" value="Submit">
      </form> -->


     <main id="main">

      <!-- ======= Breadcrumbs Section ======= -->

      <section class="breadcrumbs">
        <div class="container">

          <div class="d-flex justify-content-between align-items-center">
            <h2>Inner Page</h2>
            <ol>
              <li><a href="index.html">Home</a></li>
              <li>Inner Page</li>
            </ol>
          </div>

        </div>
      </section>
      <!-- End Breadcrumbs Section -->

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
                <!-- <img src="assets/img/contact-us.jpg" class="img-fluid" alt=""> -->
                <img src="assets/img/become-our-partner.jpg" class="img-fluid" alt="">
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


                <h3 class="text-center text-w">Screen-Cast Partner Application</h3>
                <p class="text-center">Join our partner program by filling up the form.</p>


                <!-- Display the response message -->
                <!-- <div id="responseMessage" style="color: green; font-size: 30px;" class="text-center"></div> -->

                <form id="partnerRequestForm" class="mt-5" method="POST" action="{{ route('partner.store') }}">
                    @csrf


                  <div class="row">


                    <div class="col-md-12">
                      <div class="row">
                        <!-- First Column -->
                        <div class="col-md-6">
                          <div class="form-group"style="font-family: sans-serif;">
                            <label for="amount"> Name <span
                              style="color: red">*</span> :
                            </label> <input class="form-control" id="ownerName" type="text"
                            name="ownerName" required/>
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
                            name="orgName" required/>

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


                  <!-- <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        //First Column
                        <div class="col-md-12">
                          <div class="form-group mt-3"style="font-family: sans-serif;">
                            <label for="amount">Title <span
                              style="color: red">*</span> :
                            </label> <input class="form-control" id="issueTitle" type="text"
                            name="issueTitle" required/>
                          </div>
                        </div>



                      </div>

                    </div>
                  </div>   -->


                  <div class="form-group mt-3" style="font-family: sans-serif;">
                    <label for="amount">Message :
                    </label><br><small id="emailHelp" class="form-text text-muted">(If you have any message please type here)</small>
                    <textarea id="issue-description" name="issue-description" class="form-control" rows="3" required>

                    </textarea>
                  </div>



                  <div class="pt-3" style="font-family: sans-serif;">
                    <input class="btn btn-lg pull-right text-white" style="width:100%; background-color: #7393D6;" type="submit" value="Submit">
                </div>

                </form>

                <!-- <button onclick="showSweetAlert()">Show SweetAlert</button> -->
                <!-- <button onclick="submitBtnPress()">Show SweetAlert</button>  -->

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
      var name = document.getElementById("ownerName").value.trim();
      var email = document.getElementById("email").value.trim();
      var orgName = document.getElementById("orgName").value.trim();
      var mobile = document.getElementById("mobile").value.trim();
      //var numberOfSubscription = document.getElementById("numberOfSubscription").value.trim();
      //var issueTitle = document.getElementById("issueTitle").value.trim();
      //var userTypePurchase = document.getElementById("userTypePurchase").checked;
      //var userTypeElement = document.querySelector('input[name="userType"]:checked');
      var issueDescription = document.getElementById("issue-description").value.trim();



      // Check if fields are empty
      if (name !== '' && orgName !== '' && mobile !== '' && issueDescription !== '') {

        // Prevent the default form submission
        event.preventDefault();

            // Serialize the form data
        var formData = $("#supportRequestForm").serialize();

            // AJAX request
        $.ajax({
          type: "POST",
                url: "forms/process-become-our-partner.php", // Path to your PHP file
                data: formData,
                success: function(response) {
                    // Update the HTML with the response message
                  //$("#responseMessage").html(response);
                  // Clear all form fields
                  $("#supportRequestForm")[0].reset();

                  swal("Submitted Successfully!");

                  //window.location.href = 'contact-us.html';

                },
                error: function(xhr, status, error) {
                  console.error("AJAX Request Error: " + error);
                }
              });



      }else{
        swal("Please fill in all required fields.");
      }

      /*new w*/





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



  <!-- check sweetaleart working -->
  <script>
    function showSweetAlert() {
      Swal.fire({
        title: 'Hello!',
        text: 'SweetAlert is working!',
        icon: 'success'
      });
    }
  </script>


  <!-- submit btn press -->
  <script>
    function submitBtnPress(){
      swal('Submitted Successfully Wasim!');
    }
  </script>


  <!-- JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>


  @endsection

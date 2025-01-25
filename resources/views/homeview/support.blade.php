@extends('homeview.layouts.main')
@section('title', 'Digital Signage | 24/7 Support')
@section('main-container')

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <meta name="description" content="Explore peace of mind with our dedicated 24/7 Support for MobiManager Mobile Device Management. Our expert team is here around the clock to address your inquiries, troubleshoot issues, and provide timely assistance. Count on reliable support that ensures your MobiManager experience is seamless and efficient. Reach out anytime; we're here to help you maximize the benefits of MobiManager MDM.">

  <meta property="og:type" content="MobiManager">

  <meta name="og:title" property="og:title" content="Mobile Device Management | 24/7 Support - MobiManager">
  <meta name="og:description" property="og:description" content="Explore peace of mind with our dedicated 24/7 Support for MobiManager Mobile Device Management. Our expert team is here around the clock to address your inquiries, troubleshoot issues, and provide timely assistance. Count on reliable support that ensures your MobiManager experience is seamless and efficient. Reach out anytime; we're here to help you maximize the benefits of MobiManager MDM">

  <meta property="og:site_name" content="MobiManager">

  <meta name="keywords" content="MobiManager contact, mobile device management support, MobiManager inquiries, device management solutions, MobiManager collaboration, mobile device management assistance, contact us for MobiManager, device management experts, support for MobiManager, mobile device management solutions, MobiManager is the best Mobile Device Solution (MDM) Software provider in bangladesh.">

  <meta name="og:keywords" property="og:keywords" content="MobiManager contact, mobile device management support, MobiManager inquiries, device management solutions, MobiManager collaboration, mobile device management assistance, contact us for MobiManager, device management experts, support for MobiManager, mobile device management solutions, MobiManager is the best Mobile Device Solution (MDM) Software provider in bangladesh.">



  <!-- Add jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


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
            <li><a href="index.html">Home</a></li>
            <li>Inner Page</li>
          </ol>
        </div>

      </div>
    </section>
    <!-- End Breadcrumbs Section -->

    <section class="inner-page" style="background-color: #ffffff;">
      <div class="container">

        @if (session('success'))
        <div id="successMessage" class="alert alert-success mt-3">
            {{ session('success') }}
        </div>

        <script>
            // Hide the success message after 3 seconds
            setTimeout(function() {
                const successMessage = document.getElementById('successMessage');
                if (successMessage) {
                    successMessage.style.transition = 'opacity 0.5s ease';
                    successMessage.style.opacity = '0'; // Fade out
                    setTimeout(() => successMessage.remove(), 500); // Remove after fade-out
                }
            }, 3000);
        </script>
        @endif


        <div class="row">
          <!-- <div class="col-lg-6 d-lg-flex flex-lg-column align-items-stretch hero-img" data-aos="fade-up">
            <img src="assets/img/mobimanager-kiosk.png" style="height: 100%; width: 100%;" class="img-fluid" alt="">
          </div> -->



          <!-- Starto of Column-1 -->

          <div class="col-md-6" data-aos="fade-up">
            <div class="row">
                <div class="card mt-3 card-shadow">
                    <div class="card-body">
                        <h3 class="text-center text-w">Have you submitted a request before?</h3>
                        <form id="formSearchTicketNumber" method="GET" action="{{ route('support-request.check-ticket') }}">
                            @csrf
                            <div class="row">
                                <!-- Display the response message for Search Ticket -->
                                <div id="responseMessageForSearchTicket" style="color: green; font-size: 30px;" class="text-center"></div>

                                <div class="col-md-12">
                                    <div class="row">
                                        <!-- First Column -->
                                        <div class="col-md-9">
                                            <div class="form-group" style="font-family: sans-serif;">
                                                <label for="ticketNum">Search Ticket Number <span style="color: red">*</span>:</label>
                                                <input class="form-control mt-1" id="ticketNum" type="text" name="ticketNum" placeholder="Ticket number" required />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mt-4 p-1" style="font-family: sans-serif;">
                                                <button class="btn btn-sm text-white" style="background-color:#93478F;" type="submit" onclick="submitFormAjaxForCheckingTicketNumber(event)">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                </div>
                <!-- end of card-body -->
              </div>
              <!-- end of card -->
            </div>

            <div class="row">

              <div class="mt-1 p-2  text-center" data-aos="fade-up">
                <img  src="assets/img/support24-7.jpg" class="img-fluid" alt="">
              </div>
            </div>

          </div>
          <!-- end of col-md6 -->

          <!-- End of Column-1 -->





<!-- Column-2 -->
<div class="col-md-6" data-aos="fade-up">
    <div class="card mt-3 card-shadow">
        <div class="card-body">
            <h3 class="text-center text-w">Support Request Form</h3>
            <p class="text-center">Please fill out the form below for a new support request!</p>
            <p class="text-center" style="font-family: initial;"><em>Remember your ticket number for future reference.</em></p>

            <!-- Support Request Form -->
                    <form id="supportRequestForm" class="mt-5" method="POST" action="{{ route('support-request.store') }}">
                        @csrf
                        <input type="hidden" id="ticketNumber" name="ticketNumber" readonly>
                        <input type="hidden" id="status" name="status" value="Received" readonly>

                        <!-- Display generated ticket number -->
                        <div id="output" class="form-group mt-5" style="font-family: sans-serif;">
                            Your Ticket Number:
                        </div>

                        <!-- Form Fields -->
                        <div class="row">
                            <!-- Name Field -->
                            <div class="col-md-6">
                                <div class="form-group" style="font-family: sans-serif;">
                                    <label for="name">Name <span style="color: red">*</span>:</label>
                                    <input class="form-control" id="name" type="text" name="name" required />
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email Field -->
                            <div class="col-md-6">
                                <div class="form-group" style="font-family: sans-serif;">
                                    <label for="email">Email:</label>
                                    <input class="form-control" type="email" name="email" id="email" />
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Organization Name -->
                            <div class="col-md-6">
                                <div class="form-group mt-3" style="font-family: sans-serif;">
                                    <label for="orgName">Organization Name <span style="color: red">*</span>:</label>
                                    <input class="form-control" id="orgName" type="text" name="orgName" required />
                                    @error('orgName')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Contact Number -->
                            <div class="col-md-6">
                                <div class="form-group mt-3" style="font-family: sans-serif;">
                                    <label for="mobile">Contact Number <span style="color: red">*</span>:</label>
                                    <input class="form-control" type="number" name="mobile" id="mobile" required />
                                    @error('mobile')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Issue Title -->
                        <div class="form-group mt-3" style="font-family: sans-serif;">
                            <label for="issueTitle">Issue Title <span style="color: red">*</span>:</label>
                            <input class="form-control" id="issueTitle" type="text" name="issueTitle" required />
                            @error('issueTitle')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Issue Description -->
                        <div class="form-group mt-3" style="font-family: sans-serif;">
                            <label for="issue_description">Issue Description:</label>
                            <small id="emailHelp" class="form-text text-muted">(Please describe your issue)</small>
                            <textarea id="issue_description" name="issue_description" class="form-control" rows="3"></textarea>
                            @error('issue_description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-3" style="font-family: sans-serif;">
                            <button type="submit" class="btn btn-lg w-100 text-white" style="background-color: #93478F;">
                                Submit
                            </button>
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
                // Function to handle Support Request form submission with AJAX
            function submitFormAjax(event) {
            event.preventDefault();

            // Ensure issue-description is filled out
            if (!$('#issue_description').val().trim()) {
                swal("Please describe the issue.");
                return;
            }

            var formData = $("#supportRequestForm").serialize();

            $.ajax({
                type: "POST",
                url: "{{ route('support-request.store') }}",
                data: formData,
                success: function(response) {
                    swal(response.message);
                    $("#supportRequestForm")[0].reset();
                },
                error: function(xhr) {
                    console.error("AJAX Request Error: " + xhr.responseText);
                }
            });
        }
    </script>

    <!-- AJAX Script for Searching Ticket Number -->
    <script>
        // Function to handle Ticket Number search form submission with AJAX
        function submitFormAjaxForCheckingTicketNumber(event) {
            event.preventDefault();  // Prevent default form submission

            // Retrieve and trim the ticket number input value
            var ticketNum = document.getElementById("ticketNum").value.trim();

            // Check if ticket number field is empty
            if (ticketNum !== '') {
                // Serialize the form data
                var formData = $("#formSearchTicketNumber").serialize();

                // AJAX request for ticket number search
                $.ajax({
                    type: "GET",
                    url: "{{ route('support-request.check-ticket') }}",  // Use Laravel route for ticket search
                    data: formData,
                    success: function(response) {
                        $("#responseMessageForSearchTicket").html(response.message);  // Display response message
                        $("#formSearchTicketNumber")[0].reset();  // Clear the form
                    },
                    error: function(xhr) {
                        console.error("AJAX Request Error: " + xhr.responseText);  // Log any errors
                    }
                });
            } else {
                swal("Please input your ticket number");  // Alert user if ticket number is missing
            }
        }
    </script>

    <!-- SweetAlert Script -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Random Ticket Number Generator Script -->
    <script>
            // Random Ticket Number Generator Script
            document.addEventListener('DOMContentLoaded', function () {
                // Generate and display a random ticket number
                function generateRandomTicket() {
                    const minDigits = 6;
                    const maxDigits = 10;
                    const randomDigits = Math.floor(Math.random() * (maxDigits - minDigits + 1)) + minDigits;
                    const randomNumber = Math.floor(Math.random() * Math.pow(10, randomDigits));
                    const ticketNumber = 'TN#' + randomNumber;

                    // Display ticket number in output and set hidden input value
                    document.getElementById('output').innerText = 'Your Ticket Number: ' + ticketNumber;
                    document.getElementById('ticketNumber').value = ticketNumber;
                }

                // Generate ticket number when the document is ready
                generateRandomTicket();
            });
    </script>

    <!-- random number code -->

@endsection

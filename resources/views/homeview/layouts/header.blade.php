<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Default Title')</title>
  {{-- <!-- Favicons --> --}}
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/favicon2" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  {{-- <!-- Vendor CSS Files --> --}}
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  {{-- <!-- Template Main CSS File --> --}}
  <link href="assets/css/style.css" rel="stylesheet">


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


  margin-left: 6px !important;
  margin-right: 6px !important;
  background-color: red;
}
</style>



</head>

<body>



  {{-- <!-- ======= Header ======= --> --}}
  <header id="header" class="fixed-top  header-transparent ">
    <!-- Top Links -->
    <div class="top-links">
      <a href="{{url('/request-a-demo')}}">Schedule A Demo |</a>
      <a href="{{url('/contact_us')}}">Contact Sale:+88 01916574623</a>&nbsp;&nbsp;

      {{-- <!-- Add more links as needed --> --}}
    </div>
    {{-- <!-- Top Links --> --}}
    <div class="container d-flex align-items-center  extraSpaceBetweenMenu justify-content-between">



      <div class="logo">
        {{-- <!-- <a href="index.html"><img src="assets/img/unnamed.png" alt="" class="img-fluid"></a> --> --}}
        <a href="{{url('/home')}}"><img src="assets/img/2.png" alt="" class="img-fluid" height="40" width="60">
            <span style="color:#7393D6; font-size: 25px; font-weight:800;" >ScreenCast</span></a>
      </div>



      {{-- <!-- Display the generated navigation bar --> --}}
      {{-- <?php generateNavbar(); ?> --}}


      {{-- <!-- .navbar --> --}}
      <nav id="navbar" class="navbar">
        <ul>
          <!-- Solutions Dropdown -->
          <li class="dropdown">
            <span>Solutions</span> <i class="bi bi-chevron-down"></i>
            <ul>
              <div class="solutions">
                <div class="column">
                  <li>Mobile Device Management (MDM)</li>
                  <li>Kiosk Lockdown</li>
                  <li>Digital Signage</li>
                  <li>Parental Control</li>
                  <li>Rugged Device Management</li>
                </div>
              </div>
            </ul>
          </li>

          <!-- Industries Dropdown -->
          <li class="dropdown">
            <span>&nbsp;&nbsp;&nbsp; Industries</span> <i class="bi bi-chevron-down"></i>
            <ul>
              <div class="industries">
                <div class="column">
                  <li>Manufacturing</li>
                  <li>Food & Beverages</li>
                  <li>Retail</li>
                  <li>Education</li>
                  <li>Hospitality</li>
                  <li>Healthcare</li>
                </div>
                <div class="column">
                  <li>Offices</li>
                  <li>Logistics & Transportation</li>
                  <li>Fitness, Leisure & Culture</li>
                  <li>Event Management</li>
                  <li>Commercial Real Estate</li>
                  <li>Technology & B2B Provider</li>
                </div>
              </div>
            </ul>
          </li>

            <style>

                .solutions, .industries {
                display: flex;
                gap: 10px;
                }

                /* Each column will take up half the space */
                .column {
                flex: 1;
                padding: 5px;
                }

                /* Style the list items to look better */
                ul {
                list-style-type: none;
                padding-left: 1px;
                margin: 1px;
                }

                /* Styling individual list items */
                ul li {
                margin-bottom: 2px; /* Adds space between list items */
                font-size: 17px;
                font-family: normal; /* Set font for better readability */
                }

                /* Optional: Add some styles for the dropdown */
                .dropdown {
                position: relative;
                }

                /* Dropdown menu, hidden by default */
                .dropdown > ul {
                position: absolute;
                top: 100%;
                left: 0;
                display: none;
                background-color: #f6f6f6;
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Shadow for dropdown */
                padding: 10px;
                border-radius: 5px;
                min-width: 200px; /* Minimum width for the dropdown */
                z-index: 1;
                }

                /* Show dropdown when hovering over the dropdown parent */
                /* .dropdown:hover > ul {
                display: block;
                } */

                /* Additional styles for dropdown items */
                .dropdown > ul li {
                padding: 8px 8px;
                font-size: 15px;
                /* cursor: pointer; */
                transition: background-color 0.3s ease;
                }

                /* Change background color of dropdown items on hover */
                /* .dropdown > ul li:hover {
                background-color: #f1f1f1;
                } */
            </style>


          <!-- Clients Section -->
          <li><a class="nav-link scrollto" href="#partners">Clients</a></li>

          <!-- Pricing Section -->
          <li><a class="nav-link scrollto" href="#pricing">Pricing</a></li>

          <!-- Contact Dropdown -->
          <li class="dropdown">
            <a href="{{ url('/contact_us') }}">
              <span>Contact</span> <i class="bi bi-chevron-down"></i>
            </a>
            <ul>
              <li><a href="{{ url('/request-a-demo') }}">📑 Request A Demo</a></li>
              <li><a href="{{ url('/contact_us') }}">📝 Contact Us</a></li>
              <li><a href="{{ url('/support') }}">💁🏼‍♀️ Need Support?</a></li>
              <li><a href="{{ url('/become_our_partner') }}">🤝 Become a Partner</a></li>
            </ul>
          </li>

          <!-- Free Trial Section -->
          <li><a class="getstarted scrollto" href="{{ url('/request-a-demo') }}">7 Days Free Trial</a></li>
        </ul>

        <!-- Mobile Navigation Toggle -->
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>





   </div>
 </header>

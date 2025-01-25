@extends('homeview.layouts.main')
@section('title', 'Digital Signage')
@section('main-container')

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <meta name="description" content="Discover the power of MobiManager – Your Ultimate Mobile Device Solution. Streamline device management, enhance security, and boost productivity. Explore advanced features for seamless mobile device administration. Try MobiManager today and take control of your mobile ecosystem.">

  <meta property="og:type" content="MobiManager">

  <meta name="og:title" property="og:title" content="MobiManager MDM : Mobile Device Management Solution (MDM)">

  <meta name="og:description" property="og:description" content="Discover the power of MobiManager – Your Ultimate Mobile Device Solution. Streamline device management, enhance security, and boost productivity. Explore advanced features for seamless mobile device administration. Try MobiManager today and take control of your mobile ecosystem.">

  <meta property="og:site_name" content="MobiManager">

  <meta name="keywords" content="MobiManager, mobile device management, device security, android device management, MDM solutions, mobile device management MDM System, MDM system, MDM software, android device control, mobile device management software vendor, MDM vendor, device optimization, mobile IT solutions, device administration software, MDM, Kiosk lockdown, best mobile device management MDM in Bangladesh, mobile security solution, Mobile Device Management Software in Bangladesh, Best MDM software solution provider in bangladesh, Best Android Mobile Device Management Software Solution provider vendor in Bangladesh, kiosklockdown app, POS system, Management Software System, Digital Signage, rugged device management, MobiManager is the best Mobile Device Solution (MDM) Software provider in bangladesh.">

  <meta name="og:keywords" property="og:keywords" content="MobiManager, mobile device management, device security, android device management, MDM solutions, mobile device management MDM System, MDM system, MDM software, android device control, mobile device management software vendor, MDM vendor, device optimization, mobile IT solutions, device administration software, MDM, Kiosk lockdown, best mobile device management MDM in Bangladesh, mobile security solution, Mobile Device Management Software in Bangladesh, Best MDM software solution provider in bangladesh, Best Android Mobile Device Management Software Solution provider vendor in Bangladesh, kiosklockdown app, POS system, Management Software System, Digital Signage, rugged device management, MobiManager is the best Mobile Device Solution (MDM) Software provider in bangladesh.">



<style>

#hero{
  padding-left: 5rem;
  padding-right: 5rem;
}

/* Wrapper for the TV frame and video */
.tv-frame {
  position: relative;
  width: 200%;
  max-width: 550px;
  margin: 0 auto;
}
/* .tv-frame {
  position: relative;
  width: 200%;
  max-width: 500px;
  margin: 0 auto;
} */

/* Video overlay styling */
.video-overlay {
  position: absolute;
  top: 2.65%;
  left: 3.48%;
  width: 93.4%;
  height: 87.85%;
  z-index: 1;
  overflow: hidden;
  object-fit: cover;
}
/* .video-overlay {
  position: absolute;
  top: 10.5%;
  left: 5.7%;
  width: 88%;
  height: 81%;
  z-index: 3;
  overflow: hidden;
  object-fit: cover;
} */
/* Frame image */
.tv-frame img {
  width: 100%;
  display: block;
  position: relative;
  /* height: 100%; */
  z-index: 2;
}
</style>
<style>
    .btn-custom {
        display: inline-block;
        padding: 16px 28px;
        font-size: 16px;
        font-weight: normal;
        text-align: center;
        text-decoration: none;
        border-radius: 30px;
        transition: background-color 0.3s, transform 0.2s;
        border: none; /* Remove default border */
        color: rgb(37, 34, 34); /* Text color */
    }

    .btn-primary {
        background-color: #FED933; /* Primary color */
    }

    .btn-primary:hover {
        background-color: #FECF00; /* Darker shade on hover */
        transform: translateY(-3px); /* Slight lift effect */
    }

    .btn-secondary {
        background-color: #ffffff; /* Secondary color */
        border: 1px solid #191919;
    }

    .btn-secondary:hover {
        background-color: #19191B; /* Darker shade on hover */
        transform: translateY(-3px); /* Slight lift effect */
    }
</style>


</head>

 {{-- <!-- ======= Hero Section ======= --> --}}
 <section id="hero" class="d-flex align-items-center">
    <div class="container px-lg-6">
      <div class="row">
        <div class="col-lg-5 d-lg-flex flex-lg-column justify-content-center align-items-stretch pt-100 pt-lg-0 order-2 order-lg-1" data-aos="fade-up">
            <div>
                {{-- <h1><b>The Smart, Simple <br>Digital Signage <br>Solution</b></h1> --}}
                <h1><b>Revolutionize Your Displays with AI-Driven Cloud Signage Solution</b></h1>
                <p>Experience effortless content creation with our AI-powered digital signage software, designed for seamless display across TVs, monitors, tablets, and kiosks. Engage your audience with ease using ScreenCast.</p>

                <!-- Button Container -->
                <div class="mt-4">
                    <a href="{{url('/request-a-demo')}}" class="btn btn-custom btn-primary me-2">Free Trial</a>
                    <a href="{{url('/request-a-demo')}}" class="btn btn-custom btn-secondary">Get Demo</a>
                </div>
            </div>
        </div>
        <div class="col-lg-7 d-lg-flex flex-lg-column align-items-stretch order-1 order-lg-2 hero-img position-relative" data-aos="fade-up">
          <!-- TV frame container -->
          <div class="tv-frame">
            <!-- Video element, masked within the frame -->
            <video autoplay muted loop class="video-overlay">
              <source src="contents/videos/t2.mp4" type="video/mp4">
              Your browser does not support the video tag.
            </video>
            <!-- TV frame image -->
            <img src="assets/img/tvframe.webp" class="img-fluid" alt="TV Frame">
          </div>
        </div>
      </div>
    </div>
  </section> <br><br><br>

{{-- <!-- End Hero --> --}}


<style data-emotion="css gf13o1">
    .css-gf13o1 {
        width: 100%;
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: justify;
        -webkit-justify-content: space-between;
        justify-content: space-between;
        -webkit-align-items: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        margin-top: 70px;
        -webkit-flex-direction: column;
        -ms-flex-direction: column;
        flex-direction: column;
        gap: 35px;
    }

    @media screen and (min-width: 768px) {
        .css-gf13o1 {
            margin-top:40px;
            -webkit-flex-direction: row;
            -ms-flex-direction: row;
            flex-direction: row;
        }
    }

    @media screen and (min-width: 1025px) {
        .css-gf13o1 {
            margin-top:35px;
            -webkit-flex-direction: row;
            -ms-flex-direction: row;
            flex-direction: row;
        }
    }
</style>
<h1 style="text-align: center; font-size: 3em; font-weight: bold; color: #242424; margin-top: 10px; margin-bottom: 10px;">
    Engage your audience effortlessly <br>with ScreenCast.
  </h1>

<div class="css-gf13o1"  style="padding-left:15rem; padding-right:15rem;">
    <style data-emotion="css mp4nlm">
        .css-mp4nlm {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-flex-flow: column;
            -webkit-flex-flow: column;
            -ms-flex-flow: column;
            flex-flow: column;
            -webkit-align-items: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            text-align: center;
            width: 270px;
        }

        @media screen and (min-width: 768px) {
            .css-mp4nlm {
                width:195px;
            }
        }

        @media screen and (min-width: 1025px) {
            .css-mp4nlm {
                width:280px;
            }
        }
    </style>
    <div class="css-mp4nlm">
        <style data-emotion="css xbtikr">
            .css-xbtikr {
                width: 85px;
                height: 85px;
            }
        </style>
        <img src="assets/img/content-capabilities.png" alt="Content Capabilities" class="css-xbtikr"/>
        <div>
            <style data-emotion="css 1tm3pm3">
                .css-1tm3pm3 {
                    font-family: var(--sora-font);
                    font-size: 22px;
                    font-weight: 400;
                    line-height: 27.72px;
                    letter-spacing: 0px;
                }
            </style>
            <span class="css-1tm3pm3">Digital displays capture </span>
            <style data-emotion="css 1dghvui">
                .css-1dghvui {
                    font-family: var(--sora-font);
                    font-size: 22px;
                    font-weight: 700;
                    line-height: 27.72px;
                    letter-spacing: 0px;
                }
            </style>
            <span class="css-1dghvui">4x</span>
            <span class="css-1tm3pm3">more views than static displays</span>
        </div>
    </div>
    <div class="css-mp4nlm">
        <img src="assets/img/eye-attention.png" alt="eye attention" class="css-xbtikr"/>
        <div>
            <span class="css-1tm3pm3">The brain can recognize images in </span>
            <span class="css-1dghvui">13 milliseconds</span>
        </div>
    </div>
    <div class="css-mp4nlm">
        <img src="assets/img/encoding.png" alt="encoding" class="css-xbtikr"/>
        <div>
            <span class="css-1tm3pm3">Digital Signage has an </span>
            <span class="css-1dghvui">83% recall rate</span>
            <span class="css-1tm3pm3">, 2x that of traditional channels</span>
        </div>
    </div>
</div><br><br><br>


<div class="container" style="width: 100%; max-width: 1550px; display: flex; justify-content: center; align-items: center; min-height: 100vh; padding: 50px 0; background-color: #f9f9f9;">
    <div class="content" style="width: 100%; max-width: 1200px; padding: 30px 60px; display: flex; flex-direction: column; align-items: center; background-color: #FFF; border-radius: 10px; box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);">

        <div class="header" style="text-align: center; margin-bottom: 40px;">
            <h2 style="font-family: 'Sora', sans-serif; font-size: 40px; font-weight: 700; color: #19191B; margin-bottom: 10px;">Plug & Play</h2>
            <span style="font-family: 'Lato', sans-serif; font-size: 18px; color: #474749; max-width: 312px;">Get started with your digital signage in 3 simple steps...</span>
        </div>

        <div class="steps" style="display: flex; gap: 20px; align-items: stretch; padding: 20px;">
            <!-- Step 1: Hardware -->
            <div class="step" style="flex: 1; max-width: 360px; background-color: #FFF; border-radius: 10px; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1); overflow: hidden; display: flex; flex-direction: column;">
                <img src="assets/img/hardware2.jpg" alt="Hardware" style="width: 100%; height: 180px; object-fit: cover;">
                <div style="padding: 15px; flex-grow: 1;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <div style="width: 30px; height: 30px; background-color: #19191B; color: #FFF; display: flex; justify-content: center; align-items: center; border-radius: 50%; font-weight: 900;">1</div>
                        <h3 style="font-family: 'Sora', sans-serif; font-size: 18px; color: #19191B;">Setup Your Hardware</h3>
                    </div>
                    <p style="font-family: 'Lato', sans-serif; font-size: 14px; color: #474749;">Our player adapts perfectly to any display or setup. Whether you're using a smart TV, media player or any other OS, studio will work for your digital signage needs.</p>
                </div>
            </div>

            <!-- Step 2: Software -->
            <div class="step" style="flex: 1; max-width: 360px; background-color: #FFF; border-radius: 10px; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1); overflow: hidden; display: flex; flex-direction: column;">
                <img src="assets/img/software1.webp" alt="Software" style="width: 100%; height: 180px; object-fit: cover;">
                <div style="padding: 15px; flex-grow: 1;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <div style="width: 30px; height: 30px; background-color: #19191B; color: #FFF; display: flex; justify-content: center; align-items: center; border-radius: 50%; font-weight: 900;">2</div>
                        <h3 style="font-family: 'Sora', sans-serif; font-size: 18px; color: #19191B;">Installation and  Pairing</h3>
                    </div>
                    <p style="font-family: 'Lato', sans-serif; font-size: 14px; color: #474749;">On your hardware install ScreenCast Signage software and click install. Open the app and enter the screen pairing code. Our app is <br>available on Android, Windows and Chrome devices.</p>
                </div>
            </div>

            <!-- Step 3: Screen Pairing -->
            <div class="step" style="flex: 1; max-width: 360px; background-color: #FFF; border-radius: 10px; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1); overflow: hidden; display: flex; flex-direction: column;">
                <img src="assets/img/cms.webp" alt="Screen Pairing" style="width: 100%; height: 180px; object-fit: cover;">
                <div style="padding: 15px; flex-grow: 1;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <div style="width: 30px; height: 30px; background-color: #19191B; color: #FFF; display: flex; justify-content: center; align-items: center; border-radius: 50%; font-weight: 900;">3</div>
                        <h3 style="font-family: 'Sora', sans-serif; font-size: 18px; color: #19191B;">Manage From Anywhere</h3>
                    </div>
                    <p style="font-family: 'Lato', sans-serif; font-size: 14px; color: #474749;">Log in to the portal to create, customize, and schedule your content effortlessly. Manage it across paired devices and make quick updates from anywhere with ease.</p>
                </div>
            </div>
        </div>
    </div>
</div>





<main id="main">
  {{-- <!-- ======= About Section ====== --}}
  {{-- <section id="about" class="about">
    <div class="container" data-aos="fade-up">
      <div class="row gx-0">

        <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">


          <iframe width="560" height="315" src="https://www.youtube.com/embed/XJpCFnUHXWA?si=hzyUdR4f1xAFXrUl" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

        </div>

        <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
          <div class="content">
            <h3>What is MDM</h3>
            <h2>Mobile Device Management</h2>
            <p>
              MobiManager is a platform where you can manage and control your mobile devices and solves your other enterprise mobility needs. Manage both corporate and BYOD devices, that are not limited to a specific platform or model.<br><br>
              MobiManager is used extensively in enterprises last couple of years. It is being selected mainly for mobile security, management and peer to peer communication. It allows you to distribute apps and contents across a wide range of mobile devices from the Cast.
            </p>

          </div>
        </div>

      </div>
    </div>
  </section> --}}
  {{-- End About Section -->




    <!-- ======= Values Section ======= --> --}}
    <section id="values" class="values">

        <div class="container" data-aos="fade-up" style="padding-left:5rem; padding-right:5rem;">

        <header class="section-title">
            <h2 style="font-size: 56px; font-weight: bold; color: #363636; margin: 20px 0; text-align: center;">
                Tailored solutions <br>that fit your industry
            </h2>

        </header>

        <div class="row">

          <div class="col-lg-4 mt-4 mt-lg-3" data-aos="fade-up" data-aos-delay="200">
            <div class="box">
              <img src="assets/img/solutions/Manufacturing.jpg" class="img-fluid" alt="">
              <h3>Manufacturing</h3>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-3" data-aos="fade-up" data-aos-delay="400">
            <div class="box">
              <img src="assets/img/solutions/transportation.jpeg" class="img-fluid" alt="">
              <h3>Logistics & Transportation</h3>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-3" data-aos="fade-up" data-aos-delay="600">
            <div class="box">
              <img src="assets/img/solutions/Education.jpg" class="img-fluid" alt="">
              <h3>Education</h3>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-3" data-aos="fade-up" data-aos-delay="600">
            <div class="box">
              <img src="assets/img/solutions/food.jpeg" class="img-fluid" alt="">
              <h3>Food & Beverages</h3>
              {{-- <!-- Remotely display images, videos and run presentations in a loop to easily engage your audience. --> --}}
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-3" data-aos="fade-up" data-aos-delay="600">
            <div class="box">
              <img src="assets/img/solutions/retail.avif"class="img-fluid" alt="">
              <h3>Retail</h3>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-3" data-aos="fade-up" data-aos-delay="600">
            <div class="box">
                <img src="assets/img/solutions/hospitality.png" class="img-fluid" alt="">
                <h3>Hospitality</h3>
            </div>
          </div>

                  <!-- Hidden Section for Additional Items -->
        <div class="row" id="more-items" style="display: none;">
            <div class="col-lg-4 mt-4 mt-lg-3" data-aos="fade-up" data-aos-delay="600">
                <div class="box">
                    <img src="assets/img/solutions/healthcare.avif" class="img-fluid" alt="">
                    <h3>Healthcare</h3>
                </div>
            </div>

            <div class="col-lg-4 mt-4 mt-lg-3" data-aos="fade-up" data-aos-delay="600">
                <div class="box">
                    <img src="assets/img/solutions/finance.avif" class="img-fluid" alt="">
                    <h3>Offices</h3>
                </div>
            </div>

            <div class="col-lg-4 mt-4 mt-lg-3" data-aos="fade-up" data-aos-delay="600">
                <div class="box">
                    <img src="assets/img/solutions/zym.jpg" class="img-fluid" alt="">
                    <h3>Fitness, Leisure & Culture</h3>
                </div>
            </div>

            <div class="col-lg-4 mt-4 mt-lg-3" data-aos="fade-up" data-aos-delay="600">
                <div class="box">
                    <img src="assets/img/solutions/event-management.avif" class="img-fluid" alt="">
                    <h3>Event Management</h3>
                </div>
            </div>

            <div class="col-lg-4 mt-4 mt-lg-3" data-aos="fade-up" data-aos-delay="600">
                <div class="box">
                    <img src="assets/img/solutions/realstate.jpg" class="img-fluid" alt="">
                    <h3>Commercial Real Estate</h3>
                </div>
            </div>

            <div class="col-lg-4 mt-4 mt-lg-3" data-aos="fade-up" data-aos-delay="600">
                <div class="box">
                    <img src="assets/img/solutions/technology-b2b-provider.avif" class="img-fluid" alt="">
                    <h3>Technology & B2B Provider</h3>
                </div>
            </div>
        </div>

        <!-- Show More Button -->
        <div class="text-center mt-4">
            <button id="show-more-btn" class="btn btn" style="font-weight: bold;">Show More industries <span id="arrow">&#11167;</span></button>
        </div>

    </div>

</section>

<script>
    document.getElementById('show-more-btn').addEventListener('click', function() {
        var moreItems = document.getElementById('more-items');
        var arrow = document.getElementById('arrow');
        if (moreItems.style.display === 'none') {
            moreItems.style.display = 'flex';
            this.textContent = 'Hide Industries ';
            arrow.innerHTML = '&#11165;'; // Upward arrow
        } else {
            moreItems.style.display = 'none';
            this.textContent = 'Show More Industries ';
            arrow.innerHTML = '&#11167;'; // Downward arrow
        }
        this.appendChild(arrow);
    });
</script>

<style>
    .btn-show-more {
        background-color: #007bff;
        color: #ffffff;
        padding: 10px 20px;
        font-size: 18px;
        font-weight: 600;
        border: none;
        border-radius: 30px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-show-more:hover {
        background-color: #0056b3;
        box-shadow: 0 6px 12px rgba(0, 86, 179, 0.4);
        transform: translateY(-2px);
    }

    .btn-show-more:focus {
        outline: none;
    }

    #arrow {
        margin-left: 8px;
        font-size: 1.2em;
    }
</style>
    {{-- <!-- End Values Section --> --}}


    <br><br>
    <div style="background-color: #f9f9f9; padding: 20px; text-align: center;"><br><br>
        <h2 style="font-size: 36px; font-weight: bold; color: #19191B; margin-bottom: 20px;">International experts in Digital Signage</h2>
        <br><br>

        <div style="display: flex; justify-content: center; align-items: center; gap: 1rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; gap: 80px;">
                <div style="text-align: center;">
                    <h3 style="font-size: 50px; font-weight: bold; margin: 0; color: #19191B;">12,000+</h3>
                    <p style="margin: 5px 0; color: #6c757d;">Organizations</p>
                </div>
                <div style="border-left: 1px solid #ddd; height: 50px;"></div>
                <div style="text-align: center;">
                    <h3 style="font-size: 50px; font-weight: bold; margin: 0; color: #19191B;">140+</h3>
                    <p style="margin: 5px 0; color: #6c757d;">Countries</p>
                </div>
                <div style="border-left: 1px solid #ddd; height: 50px;"></div>
                <div style="text-align: center;">
                    <h3 style="font-size: 50px; font-weight: bold; margin: 0; color: #19191B;">150+</h3>
                    <p style="margin: 5px 0; color: #6c757d;">Apps & Integrations</p>
                </div>
                <div style="border-left: 1px solid #ddd; height: 50px;"></div>
                <div style="text-align: center;">
                    <h3 style="font-size: 50px; font-weight: bold; margin: 0; color: #19191B;">24/7</h3>
                    <p style="margin: 5px 0; color: #6c757d;">Support</p>
                </div>
            </div>

        </div>
        <br><br>
    </div>







</div><br><br><br>

    {{-- <!-- ======= Counts Section ======= --> --}}
    {{-- <section id="counts" class="counts section-bg">
      <div class="container" data-aos="fade-up">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6">
            <div class="count-box">

              <i class="bi bi-emoji-smile" style="color: #bb0852;"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1" class="purecounter"></span>
                <h3 style="font-size: 36px; font-weight: 650; color: #15BE56;">30+</h3>
                <strong><p>Happy Clients</p></strong>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class='bx bx-mobile-alt' style="color: #ee6c20;"></i>

              <div>
                <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1" class="purecounter"></span>
                <h3 style="font-size: 36px; font-weight: 650; color: #15BE56;">500000+</h3>
                <p><strong>Devices cover</strong></p>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="bi bi-headset" style="color: #ee6c20;"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="1463" data-purecounter-duration="1" class="purecounter"></span>
                <h3 style="font-size: 36px; font-weight: 650; color: #15BE56;">24/7</h3>
                <strong><p>Customer Support</p></strong>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class='bx bx-sort-up'style="color: #bb0852;"></i>

              <div>
                <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1" class="purecounter"></span>
                <h3 style="font-size: 36px; font-weight: 650; color: #15BE56;">99.99%</h3>
                <strong><p>Reliable Uptime</p></strong>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section> --}}
    {{-- <!-- End Counts Section --> --}}




    {{-- <!-- ======= Testimonials Section ======= --> --}}
    {{-- <section id="testimonials" class="testimonials section-bg-for-testimonials">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Testimonials</h2>
          <h3>What Our Users Are Saying</h3>

        </div>

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">


            <div class="swiper-slide">
              <div class="testimonial-item">

                <h3>Mr. Md. Rafiqul Islam</h3>
                <h4>Project Director, Strengthening Environment at Bangladesh Bureau of Statistics.</h4>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  It has simplified a lot of process, hence is worth of praise. I would definitely recommend MobiManager based on my experience with it.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div>



            <div class="swiper-slide">
              <div class="testimonial-item">

                <h3>Sanjay Kumar Roy</h3>
                <h4>Deputy Executive Director, IT at Walton Group.</h4>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Fantastic product, Awesome service!
                  MobiManager have shown a unique passion to be the best at what they do, regardless of my needs they strive to deliver more to make their solution better.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="testimonial-item">

                <h3>AKM Fazli Elahi</h3>
                <h4>General Manager & Head of Passenger Services at Obhai Solutions Ltd</h4>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  I’m recommending MobiManager because I know they have a very strong support system.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="testimonial-item">

                <h3>Zahirul Islam Sohel</h3>
                <h4>Sr. Manager (Tender division) at Smart Technologies (BD) Ltd.</h4>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Support was pretty fast on helping me out. Every time we have issues or questions, they try their best to help us.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="testimonial-item">

                <h3>Nafisa Binte Yousuf</h3>
                <h4>Product Manager at Grameenphone Ltd.</h4>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  The pricing was good and the service is great. When we call you guys, there is always somebody on phone to take our call and help us.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="testimonial-item">

                <h3>Shoab Naoshad</h3>
                <h4>Head of IT at Berger Paints Bangladesh Limited.</h4>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  We saved a lot of money on data because now there is not much data usage besides the single app. Before, there was a lot of data usage and we had to pay over. Now everything works smooth.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="testimonial-item">

                <h3>Sourav Chowdhury</h3>
                <h4>Executive, Sales & Marketing at Bombay Sweets & Co. Ltd.</h4>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  MobiManager have shown a unique passion to be the best at what they do, regardless of my needs they strive to deliver more to make their solution better.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="testimonial-item">

                <h3>Md. Saiful Islam</h3>
                <h4>Sr. Executive, Customer Experience at Golden Harvest.</h4>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  MobiManager have shown a unique passion to be the best at what they do, regardless of my needs they strive to deliver more to make their solution better.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div>

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section> --}}
    {{-- <!-- End Testimonials Section --> --}}


    {{-- <!-- ======= Client Section ======= -->
    <!-- Client Section --> --}}
    <section class="partner-area pt-100 pb-70" id="partners">
      <div class="container">
        <div class="section-title">
          <h2>Trusted by Companies</h2>

        </div>
        <div class="row align-items-center justify-content-center">

          <div class="col-lg-2 col-6 col-sm-4">
            <div class="single-partner-wasim border">
              <div class="d-tables">
                <div class="wasim-newa">

                  <img src="assets/img/partners/bbs_logo.png" alt="image" />

                </div>
              </div>
            </div>
          </div>



          <div class="col-lg-2 col-6 col-sm-4">
            <div class="single-partner-wasim border">
              <div class="d-tables">
                <div class="wasim-newa">

                  <img style="margin-left: 0px;" src="assets/img/partners/govt bd.png" alt="image" />

                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-6 col-sm-4">
            <div class="single-partner-wasim border">
              <div class="d-tables">
                <div class="wasim-newa">

                  <img src="assets/img/partners/army-bd.png" alt="image" />

                </div>
              </div>
            </div>
          </div>


          <div class="col-lg-2 col-6 col-sm-4">
            <a href="https://waltondigitech.com" target="_blank">
               <div class="single-partner border" id="wasim">
              <div class="d-table">
                <div class="d-table-cell">

                  <img src="assets/img/partners/walton.png" alt="image" />

                </div>
              </div>
            </div>
          </a>
          </div>



          {{-- <!--<div class="col-lg-2 col-6 col-sm-4">
            <div class="single-partner border" id="wasim">
              <div class="d-table">
                <div class="d-table-cell">

                  <img src="assets/img/partners/walton.png" alt="image" />

                </div>
              </div>
            </div>
          </div>--> --}}


          <div class="col-lg-2 col-6 col-sm-4">
            <div class="single-partner border">
              <div class="d-table">
                <div class="d-table-cell">

                  <img src="assets/img/partners/Berger.png" alt="image" />

                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-2 col-6 col-sm-4">
            <div class="single-partner border">
              <div class="d-table">
                <div class="d-table-cell">

                  <img src="assets/img/partners/obhai_logo.png" alt="image" />

                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-2 col-6 col-sm-4">
            <div class="single-partner border">
              <div class="d-table">
                <div class="d-table-cell">

                  <img src="assets/img/partners/grameenphone_logo.png" alt="image" />

                </div>
              </div>
            </div>
          </div>



          <div class="col-lg-2 col-6 col-sm-4">
            <div class="single-partner border">
              <div class="d-table">
                <div class="d-table-cell">

                  <img src="assets/img/partners/smart_logo.png" alt="image" />

                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-2 col-6 col-sm-4">
            <div class="single-partner border">
              <div class="d-table">
                <div class="d-table-cell">

                  <img src="assets/img/partners/unilever.png" alt="image" />

                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-6 col-sm-4">
            <div class="single-partner border">
              <div class="d-table">
                <div class="wasim-new">
                    {{-- <!-- wasim new for rgncy logo --> --}}

                  {{-- <!-- <img src="assets/img/partners/Ingenico-Logo.wine.png" alt="image" /> --> --}}
                  <img src="assets/img/partners/regency_garments_limited.png" alt="image" />

                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-2 col-6 col-sm-4">
            <div class="single-partner border">
              <div class="d-table">
                <div class="d-table-cell">

                  <img src="assets/img/partners/ilo-logo.png" alt="image" />

                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-6 col-sm-4">
            <div class="single-partner border">
              <div class="d-table">
                <div class="d-table-cell">

                  <img src="assets/img/partners/golden.png" alt="image" />

                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-2 col-6 col-sm-4">
            <div class="single-partner border">
              <div class="d-table">
                <div class="d-table-cell">

                  <img src="assets/img/partners/bombay_logo.png" alt="image" />

                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-6 col-sm-4">
            <div class="single-partner border">
              <div class="d-table">
                <div class="d-table-cell">

                  <img src="assets/img/partners/adn.png" alt="image" />

                </div>
              </div>
            </div>
          </div>





          <div class="col-lg-2 col-6 col-sm-4">
            <div class="single-partner border">
              <div class="d-table">
                <div class="d-table-cell">

                  <img src="assets/img/partners/kenpark.jpg" alt="image" />

                </div>
              </div>
            </div>
          </div>


        </div>
      </div>
    </section>

    {{-- <!-- Client Section -->





    <!-- ======= Pricing Section ======= --> --}}
    <section id="pricing" class="pricing" style="background-color: #f9f9f9;">
        <div class="container" style="background-color: #f9f9f9;">
          <div class="section-title">
            <h2>Pricing</h2>
          </div>

          <div class="row no-gutters">
            <div class="col-lg-4 box" data-aos="fade-right">
              <h3>Personal/Express</h3>
              <h4>৳300<span>Screen/Month</span></h4>
              <ul>
                <li><i class="bx bx-check"></i> Made for small businesses or any startups</li>
                <li><i class="bx bx-check"></i> All Types of Media</li>
                <li><i class="bx bx-check"></i> Build Playlists & Schedule Content</li>
                <li><i class="bx bx-check"></i> Screen Layout in Multiple Zones/Regions</li>
                <li><i class="bx bx-check"></i> Single User</li>
                <li><i class="bx bx-check"></i> 1GB Media Storage</li>
                <li><i class="bx bx-check"></i> up to 200 devices</li>
              </ul>
              <a href="{{url('/request-a-demo')}}" class="get-started-btn">Order Now</a>
            </div>

            <div class="col-lg-4 box featured" data-aos="fade-up">
              <h3>Professional</h3>
              <h4>৳250<span>Screen/Month</span></h4>
              <!-- <h4>$29<span>per month</span></h4> -->
              <ul>
                <li><i class="bx bx-check"></i> Ideal for mid-sized businesses</li>
                <li><i class="bx bx-check"></i> All Types of Media</li>
                <li><i class="bx bx-check"></i> Build Playlists & Schedule Content</li>
                <li><i class="bx bx-check"></i> Screen Layout in Multiple Zones/Regions</li>
                <li><i class="bx bx-check"></i> 5 Admin User</li>
                <li><i class="bx bx-check"></i> 2GB Media Storage</li>
                <li><i class="bx bx-check"></i> 201-500 devices</li>
              </ul>
              <a href="{{url('/request-a-demo')}}" class="get-started-btn">Order Now</a>
            </div>

            <div class="col-lg-4 box" data-aos="fade-left">
              <h3>Enterprise</h3>
              <h4>৳200<span>Screen/Month</span></h4>
              <ul>
                <li><i class="bx bx-check"></i> Ideal for growing Enterprises</li>
                <li><i class="bx bx-check"></i> All Types of Media</li>
                <li><i class="bx bx-check"></i> Build Playlists & Schedule Content</li>
                <li><i class="bx bx-check"></i> Screen Layout in Multiple Zones/Regions</li>
                <li><i class="bx bx-check"></i> Unlimited User</li>
                <li><i class="bx bx-check"></i> 5GB Media Storage</li>
                <li><i class="bx bx-check"></i> Customization available</li>
                <li><i class="bx bx-check"></i> above 500 devices</li>
              </ul>
              <a href="{{url('/request-a-demo')}}" class="get-started-btn">Order Now</a>
            </div>
          </div>
        </div>
      </section>

    {{-- <!-- End Pricing Section --> --}}




    {{-- <!-- ======= Clients Section ======= --> --}}
    <section id="clients" class="clients">

      <div class="container-fluid" data-aos="fade-up">

        <header class="section-title">
          <h2>Achivements</h2>

        </header>

        <div class="clients-slider swiper">
          <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide"><img src="assets/img/achivements/android.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/achivements/basis-national-ict-award.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/achivements/apicta-award.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/achivements/incubator_logo.jpg" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/achivements/zebra_drucker.png" class="img-fluid" alt=""></div>


          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>

    </section>
    {{-- <!-- End Clients Section --> --}}

  </main>
  {{-- <!-- End #main --> --}}
  @endsection

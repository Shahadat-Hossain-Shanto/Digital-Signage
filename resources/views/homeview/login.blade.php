@extends('homeview.layouts.main')
@section('title', 'Login Page')
@section('main-container')

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="description">
  <meta content="" name="keywords">




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


    <div class="row">

      <!-- Column-2 -->
      <div class="col-md-6 offset-md-3 " data-aos="fade-up">
         <div class="card mt-3 card-shadow">
          <div class="card-body">

           <h3 class="text-center text-w">Login</h3>

           <?php if (isset($error)) : ?>
             <p style="color: red;"><?php echo $error; ?></p>
          <?php endif; ?>



          <form action="{{ route('login.submit') }}" method="POST">
            @csrf





            <div class="row">


               <div class="col-md-12 mt-3">
                  <div class="form-group"style="font-family: sans-serif;">
                     <label for="username"> Username/Email:</label>
                     <input type="text" class="form-control" id="username" name="username" required>
                  </div>
               </div>

            </div>

            <div class="row">


               <div class="col-md-12 mt-3">
                  <div class="form-group"style="font-family: sans-serif;">
                     <label for="username"> Password:</label>
                     <input type="password" class="form-control" id="password" name="password" required>
                  </div>
               </div>

            </div>



            <div class="mt-4" style="font-family: sans-serif;">

              <input class="btn btn-lg pull-right text-white" style="width:100%; background-color: #8EACE8;" type="submit" value="Submit">
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


@endsection

<?php
ob_start();
session_start();
error_reporting(0);
$newname2 = "";
$user = $_SESSION['user'];
require_once('db.php');

   
                        if(isset($_POST['report'])){
                          $userid = $_SESSION['id'];
                          $sql = "SELECT * FROM `users` WHERE `id` = '$userid';";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                     $row = mysqli_fetch_array($result);
                         $name = $row['fullname'];
                         $userid = $row['id'];
                     }
                              $date = date('U');

                  $category = mysqli_real_escape_string($conn,$_POST['category']);

                  $subject = mysqli_real_escape_string($conn,$_POST['subject']);
                  $location = mysqli_real_escape_string($conn,$_POST['location']);                      
                  $message = mysqli_real_escape_string($conn,$_POST['message']);     
                              $upload = $_FILES['upload']['name'];
                    $tmp_name = $_FILES['upload']['tmp_name'];     
                           //   $check_query = "SELECT * FROM users WHERE username = '$username' or email = '$email'";
                          //   $check_run = mysqli_query($con, $check_query);

                    $upload_image = "";
                        for ($i = 0; $i <= (count($upload) -1); $i++) {
                          if ($upload_image == '') {
                            $upload_image = $upload[$i];
                          } else {
                            $upload_image = $upload_image . "," . $upload[$i];  
                          }

                        }

                  $hashed =  sha1($subject.$message);
                  // sprintf("The gost hashed password of %s is: %s\n",  
                  //       $str, hash('gost', $subject.$message)); 

                  echo '<script>alert($hashed)</script>';


                  $insert_query = "INSERT INTO `crime` (`id`, `user_id`,`fullname`, `crime_subject`, `crime_category`, `crime_loc`, `crime_evidence`,`message`, `date`, `status`, `hashed`)
      VALUES (NULL, '$userid','$name',  '$subject', '$category', '$location','$upload','$message','$date','Disapproved', '$hashed')";

                if(mysqli_query($conn,$insert_query)){                               
                      
                                 echo "<script>alert('Report has been sent Successfully!');</script>";
                                  for ($i = 0; $i <= (count($tmp_name)-1); $i++) {
                                    $path = "images/".$upload[$i];
                                    if(move_uploaded_file($tmp_name[$i], $path)){
                              copy($path, "$path");
                          }
                      }
                              }
                              else
                              {
                                 echo "<script>alert('Report Sending Failed!');</script>";
                              }
                          }
                      
                    













// if(isset($_POST['report'])){
//   $userid = $_SESSION['id'];
//   $sql = "SELECT * FROM `users` WHERE `id` = '$userid';";
//     $result = mysqli_query($conn, $sql);

//     if (mysqli_num_rows($result) > 0) {
//          $row = mysqli_fetch_array($result);
//              $name = $row['fullname'];
//              $userid = $row['id'];
//          }
//                   $date = date('U');

//         $category = mysqli_real_escape_string($conn,$_POST['category']);

//           $subject = mysqli_real_escape_string($conn,$_POST['subject']);
//           $location = mysqli_real_escape_string($conn,$_POST['location']);                      
//                   $message = mysqli_real_escape_string($conn,$_POST['message']);    
//                   $upload = $_FILES['upload']['name'];
//         $tmp_name = $_FILES['upload']['tmp_name'];     
               //   $check_query = "SELECT * FROM users WHERE username = '$username' or email = '$email'";
              //   $check_run = mysqli_query($con, $check_query);

        // $upload_image = "";
        //     for ($i = 0; $i <= (count($upload) -1); $i++) {
        //       if ($upload_image == '') {
        //         $upload_image = $upload[$i];
        //       } else {
        //         $upload_image = $upload_image . "," . $upload[$i];  
        //       }

        //     }

    //  $insert_query = "INSERT INTO `crime` (`id`, `user_id`,`fullname`, `crime_subject`, `crime_category`, `crime_loc`, `crime_evidence`,`message`, `date`, `status`)
    //   VALUES (NULL, '$userid','$name',  '$subject', '$category', '$location','$upload_image','$message','$date','Disapproved')";

    // if(mysqli_query($conn,$insert_query)){                               
          
    //                  echo "<script>alert('Report has been sent Successfully!');</script>";
    //                   for ($i = 0; $i <= (count($tmp_name)-1); $i++) {
    //                     $path = "file/".$upload[$i];
    //                     if(move_uploaded_file($tmp_name[$i], $path)){
    //               copy($path, "$path");
    //           }
    //       }
    //               }
    //               else
    //               {
    //                  echo "<script>alert('Report Sending Failed!');</script>";
    //               }
    //           }


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Crime Report</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    
	  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index">CrimeReport</a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item active"><a href="index" class="nav-link">Home</a></li>
	          <li class="nav-item"><a href="about" class="nav-link">About</a></li>
	          <li class="nav-item"><a href="contact" class="nav-link">Contact</a></li>
	          <li class="nav-item cta mr-md-2"><a href="login" class="nav-link">Login</a></li>
            <li class="nav-item cta mr-md-2"><a href="logout.php" class="nav-link">Logout</a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->
    
    <div class="hero-wrap js-fullheight" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
          <div class="col-xl-10 ftco-animate mb-5 pb-5" data-scrollax=" properties: { translateY: '70%' }">
          	<p class="mb-4 mt-5 pt-5" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">We've reported over <span class="number" data-number="1000">0</span> Crimes!</p>
            <h1 class="mb-5" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Want to report<br><span>a crime?</span></h1>

						<div class="ftco-search">
							<div class="row">
		            <div class="col-md-12 nav-link-wrap">
			            <div class="nav nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
			              <a class="nav-link active mr-md-1" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">Regular Crime</a>

			              <a class="nav-link" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-2" aria-selected="false">Military Crime</a>

			            </div>
			          </div>
			          <div class="col-md-16 tab-wrap">
			            
			            <div class="tab-content p-4" id="v-pills-tabContent">

			              <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-nextgen-tab">


                   





			              	<form method="POST" action="" class="search-job">
			              		<div class="row">
			              			<div class="col-md">
			              				<div class="form-group">
				              				<div class="form-field">
								                <input type="text" class="form-control" placeholder="Crime Subject" name="subject">
								              </div>
							              </div>
			              			</div>
			              			<div class="col-md">
			              				<div class="form-group">
			              					<div class="form-field">
				              					<div class="select-wrap">
						                      <div class="icon"><span class="ion-ios-arrow-down"></span></div>
						                      <select name="category" id="" class="form-control">
						                      	<option value="">Category</option>
						                      	<option value="Property Extortion">Property Extortion</option>
						                        <option value="Armed Robbery">Armed Robbery</option>
						                        <option value="Bribery">Bribery</option>
						                        <option value="Blackmail">Blackmail</option>
						                        <!-- <option value="">Others</option> -->
						                      </select>
						                    </div>
								              </div>
							              </div>
			              			</div>
			              			<div class="col-md">
			              				<div class="form-group">
			              					<div class="form-field">
				              					<div class="icon"><span class="icon-map-marker"></span></div>
								                <input type="text" class="form-control" placeholder="Location" name="location">
								              </div>
							              </div>
                          </div>
                          <div class="sm-form">
			              				<div class="form-group">
			              					<div class="file-field">
                               <input type="file" class="form-control" placeholder="Upload Evidence"  name="upload[]" multiple >
                                <!-- <input class="file-path validate" type="text" placeholder="Upload Evidence" name="file[]"> -->
								              </div>
							              </div>
			              			</div> 
                          <div class="lg-form">
                            <div class="form-group">
                              <div class="file-field">
                                <!-- <label>Enter Description</label> -->
                                <div class="icon"><span class="icon-message"></span></div>
                                <textarea class="form-control" placeholder="Enter your Message here..." name="message">
                                  
                                </textarea>
                                
                              </div>
                            </div>
                          </div>
			              			<div class="col-md">
			              				<div class="form-group">
			              					<div class="form-field">
								                <input type="submit" value="Report" class="form-control btn btn-primary" name="report">
								              </div>
							              </div>
			              			</div>
			              		</div>
			              	</form>
			              </div>

			              <div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-performance-tab">
			              	<form action="" class="search-job" method="POST">
			              		<div class="row">
			              			<div class="col-md">
			              				<div class="form-group">
				              				<div class="form-field">
								                <input type="text" class="form-control" placeholder="Crime Subject" name="subject">
								              </div>
							              </div>
			              			</div>
			              			<div class="col-md">
			              				<div class="form-group">
			              					<div class="form-field">
				              					<div class="select-wrap">
						                      <div class="icon"><span class="ion-ios-arrow-down"></span></div>
						                      <select name="category" id="" class="form-control">
						                      	<option value="">Category</option>
						                      	<option value="Sars Harrasment">Sars Harrasment</option>
						                        <option value="Armed Forces">Armed Forces</option>
						                        <option value="Police Bribery">Police Bribery</option>
						                        <option value="Force Brutallity">Force Brutallity</option>
						                        <!-- <option value="">Others</option> -->
						                      </select>
						                    </div>
								              </div>
							              </div>
			              			</div>
			              			<div class="col-md">
			              				<div class="form-group">
			              					<div class="form-field">
				              					<div class="icon"><span class="icon-map-marker"></span></div>
								                <input type="text" class="form-control" placeholder="Location" name="location">
								              </div>
							              </div>
                          </div>
                          <div class="sm-form">
			              				<div class="form-group">
			              					<div class="file-field">
                                <input type="file" class="form-control" placeholder="Upload Evidence"  name="upload[]" multiple >
                                <!-- <input class="file-path validate" type="text" placeholder="Upload Evidence" name="file[]"> -->
								              </div>
							              </div>
			              			</div>
                          <div class="lg-form">
                            <div class="form-group">
                              <div class="file-field">
                                <!-- <label>Enter Description</label> -->
                                <div class="icon"><span class="icon-message"></span></div>
                                <textarea class="form-control" placeholder="Enter your message here... " name="message">
                                  
                                </textarea>
                                
                              </div>
                            </div>
                          </div>
			              			<div class="col-md">
			              				<div class="form-group">
			              					<div class="form-field">
								                <input type="submit" value="Report" class="form-control btn btn-primary" name="report">
								              </div>
							              </div>
			              			</div>
			              		</div>
			              	</form>
			              </div>
			            </div>
			          </div>
			        </div>
		        </div>
          </div>
        </div>
      </div>
    </div>
    
    <section class="ftco-section services-section bg-light">
      <div class="container">
        <div class="row d-flex">
          <div class="col-md-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services d-block">
              <div class="icon"><span class="flaticon-resume"></span></div>
              <div class="media-body">
                <h3 class="heading mb-3">Militery Crimes</h3>
                <p>A small river named Duden flows by their place and supplies.</p>
              </div>
            </div>      
          </div>
          <div class="col-md-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services d-block">
              <div class="icon"><span class="flaticon-collaboration"></span></div>
              <div class="media-body">
                <h3 class="heading mb-3">Armed Robbery</h3>
                <p>A small river named Duden flows by their place and supplies.</p>
              </div>
            </div>    
          </div>
          <div class="col-md-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services d-block">
              <div class="icon"><span class="flaticon-promotions"></span></div>
              <div class="media-body">
                <h3 class="heading mb-3">Inproper Act</h3>
                <p>A small river named Duden flows by their place and supplies.</p>
              </div>
            </div>      
          </div>
          <div class="col-md-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services d-block">
              <div class="icon"><span class="flaticon-employee"></span></div>
              <div class="media-body">
                <h3 class="heading mb-3">SARS Harrasment</h3>
                <p>A small river named Duden flows by their place and supplies.</p>
              </div>
            </div>      
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section testimony-section">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 text-center heading-section ftco-animate">
          	<span class="subheading">Twitter Feed</span>
            <h2 class="mb-4"><span>Latest </span> Crime Reports</h2>
          </div>
        </div>
        <div class="row ftco-animate">
          <div class="col-md-12">
            
            <a class="twitter-timeline" data-height="500" href="https://twitter.com/OTechbot?ref_src=twsrc%5Etfw">Tweets by OTechbot</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

          </div>
        </div>
      </div>
    </section>

 
    <footer class="ftco-footer ftco-bg-dark ftco-section">
      <div class="container">
        <div class="row mb-5">
        	<div class="col-md">
             <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">About</h2>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-3">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Quick Links</h2>
              <ul class="list-unstyled">
                <li><a href="index" class="py-2 d-block">Home </a></li>
                <li><a href="about" class="py-2 d-block">About</a></li>
                <li><a href="contact" class="py-2 d-block">Contact</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-4">
              <h2 class="ftco-heading-2">Workers</h2>
              <ul class="list-unstyled">
                <li><a href="login" class="py-2 d-block">How it works</a></li>
                <li><a href="signup" class="py-2 d-block">Register</a></li>
                <li><a href="index" class="py-2 d-block">Post Your Crime</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Have a Questions?</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@crimereport.com</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">

          </div>
        </div>
      </div>
    </footer>
    
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>

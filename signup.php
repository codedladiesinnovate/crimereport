<?php 
require_once('db.php');
ob_start();
session_start();
$newname2 = "";
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
  <body style="background-color: #666666;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">

				<?php
                    if(isset($_POST['signup'])){
                    	// echo "Here";
                        $date = time();
                        $name = mysqli_real_escape_string($conn,$_POST['name']);   

                        $email = mysqli_real_escape_string($conn,$_POST['email']);  

                        // $username_trim = preg_replace('/\s+/','',$username);
                        $password = mysqli_real_escape_string($conn,$_POST['password']);
                        
                        $check_query = "SELECT * FROM users WHERE email = '$email'";
                        $check_run = mysqli_query($conn, $check_query);
                       
                        if(mysqli_num_rows($check_run) > 0){
                             echo "<script>alert('Email already exists!');</script>";
                        }
                        else{
                            $insert_query = "INSERT INTO `users` (`fullname`, `email`, `password`) VALUES ('$name', '$email' , '$password')";
                            if(mysqli_query($conn,$insert_query)){                         
                               echo "<script>alert('Hey! You Have Been Added Successfully!');</script>";
                            }
                            else
                            {
                            	 echo "<script>alert('Oh! Sorry!!! You Have not Been Added Successfully!');</script>";
                            }
                        }
                    }
                ?>













				<form class="login100-form validate-form" method="POST">
					<span class="login100-form-title p-b-43">
						Welcome, Sign Up
					</span>
					
					
					<div class="wrap-input100 validate-input" data-validate = "Valid name is required">
						<input class="input100" type="text" name="name">
						<span class="focus-input100"></span>
						<span class="label-input100">Full Name</span>
                    </div>
                    
                    <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email">
						<span class="focus-input100"></span>
						<span class="label-input100">Email</span>
					</div>	
					
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="password">
						<span class="focus-input100"></span>
						<span class="label-input100">Password</span>
					</div>

					<div class="flex-sb-m w-full p-t-3 p-b-32">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

					</div>
			

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="signup">
							Sign Up
						</button>
					</div>
					
					<div class="text-center p-t-46 p-b-20">
						<span class="txt2">
							Already have an Account <a href="login" class="nav-link">Login</a>
						</span>
					</div>

					<div class="login100-form-social flex-c-m">
						<a href="#" class="login100-form-social-item flex-c-m bg1 m-r-5">
							<i class="fa fa-facebook-f" aria-hidden="true"></i>
						</a>

						<a href="#" class="login100-form-social-item flex-c-m bg2 m-r-5">
							<i class="fa fa-twitter" aria-hidden="true"></i>
						</a>
					</div>
				</form>

				<div class="login100-more" style="background-image: url('images/image_2.jpg');">
				</div>
			</div>
		</div>
	</div>
	
	

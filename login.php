<?php
	// ob_start();
	session_start();

	require_once('db.php');

	// check if user already logged in, if yes then redirect him to report  page
	if (isset( $_SESSION["id"])) {
		header("location:index.php");
		exit;
	}

	if(isset($_POST['submit'])){

	
			$email = $_POST["email"];
		

	
			$password = $_POST["password"];
		
		//validate credentils &
			// prepare a select statement
			$sql = "SELECT `id` FROM `users` WHERE email = '$email' AND password = '$password';";

			$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
		      $report = mysqli_fetch_array($result);
		        $id = $report['id'];
		        $_SESSION['id'] = $id;
		     echo "<script>alert('Login Successful!');</script>";
		     echo "<script>window.location='index.php';</script>";
						// set parameters
						
		}else{
			echo "<script>alert('Login Details are invalid, Please try again!');</script>";
		}
	




	     // $numrow=mysqli_num_rows($query);

	     // if ($numrow > 0) {
	     //   $result=mysqli_fetch_array($query,MYSQLI_ASSOC);
	     //  $id=$result['id'];
	     //  $name=$result['name'];
	      // $role=$result['role'];
	      // $_SESSION['user'] = $name;
	      // $_SESSION['role'] = $role;
	     	// echo "<script>alert('Login Sucessful!');</script>";
	      //  header('Location: index.php');
	     // }else{
	      // $error = "Sorry! User Does Not Exist...";
	     // 	echo "Sorry! User Does Not Exist...";
	     	
	     // }
	}
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
				<form class="login100-form validate-form" method="POST">
					<span class="login100-form-title p-b-43">
						Login to continue
					</span>
					
					
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

						<div>
							<a href="#" class="txt1">
								Forgot Password?
							</a>
						</div>
					</div>
			

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="submit">
							Login
						</button>
					</div>
					
					<div class="text-center p-t-46 p-b-20">
						<span class="txt2">
							Don't have an Account <a href="signup" class="nav-link">Sign Up</a>
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
	
	

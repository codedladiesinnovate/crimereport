<?php 
session_start();
ob_start();
require_once('inc/db.php');

if(isset($_POST['submit'])){
    $username = mysqli_real_escape_string($con,strtolower($_POST['username']));
    $password = mysqli_real_escape_string($con,$_POST['password']);
    
    $check_username_query = "SELECT * FROM `admin` WHERE username = '$username'";
    $check_username_run = mysqli_query($con, $check_username_query);
    if(mysqli_num_rows($check_username_run) > 0){
        $row = mysqli_fetch_array($check_username_run);
        $db_userid = $row['id'];
        $db_username = $row['username'];
        $db_password = $row['password'];
        $db_role = $row['role'];
        
        
        if($username == $db_username && $password == $db_password){
            header('Location: index.php');
            $_SESSION['id'] = $db_userid;
            $_SESSION['username'] = $db_username;
            $_SESSION['role'] = $db_role;
        }
        else{
            $error = "Wrong Username or Password";
        }
    }
    else{
        $error = "Wrong Username or Password";
    }
}

include_once('inc/head.php'); 

?>

<body>
			<!-- /pages_agile_info_w3l -->

						<div class="pages_agile_info_w3l">
							<!-- /login -->
							   <div class="over_lay_agile_pages_w3ls">
								    <div class="registration">
								
												<div class="signin-form profile">
													<h2>Admin Login</h2>
													<div class="login-form">
														<form action="main-page.php" method="post">
															<input type="email" name="username" placeholder="E-mail" required="">
															<input type="password" name="password" placeholder="Password" required="">
															<label>
												            <?php
												              if(isset($error)){
												                  echo "$error";
												              }
												              ?>
												          </label>
															<div class="tp">
																<input type="submit" name="submit" value="SIGN IN">
															</div>
														</form>
													</div>
													<div class="login-social-grids">
														<ul>
															<li><a href="#"><i class="fa fa-facebook"></i></a></li>
															<li><a href="#"><i class="fa fa-twitter"></i></a></li>
															<li><a href="#"><i class="fa fa-rss"></i></a></li>
														</ul>
													</div>
													
													 <h6><a href="../index.php">Back To Home</a><h6>
												</div>
										</div>
										<!--copy rights start here-->
<?php include_once('inc/footer.php'); ?>

											<!--copy rights end here-->
						    </div>
						</div>
							<!-- /login -->
<!-- //pages_agile_info_w3l -->


<!-- js -->

          <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
		  <script src="js/modernizr.custom.js"></script>
		
		   <script src="js/classie.js"></script>
		  <script src="js/gnmenu.js"></script>
		  <script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
		 </script>
	
<!-- //js -->

<script src="js/screenfull.js"></script>
		<script>
		$(function () {
			$('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

			if (!screenfull.enabled) {
				return false;
			}

			

			$('#toggle').click(function () {
				screenfull.toggle($('#container')[0]);
			});	
		});
		</script>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<script src="js/snow.js"></script>
 <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>


</body>
</html>
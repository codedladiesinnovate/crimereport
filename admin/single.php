<?php
include('inc/db.php');
if(isset($_GET['report_id'])){
	$report_id = $_GET['report_id'];

	$sql = "SELECT * FROM `report` WHERE `id` = '$report_id';";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
     $row = mysqli_fetch_array($result);
         $id = $row['id'];
         $name = $row['fullname'];
         $categories = $row['category']; 
         $message = $row['message'];                                
         $state = $row['state'];
         $lga = $row['lga'];
         $upload = $row['image'];
         $date = $row['date'];
     }
} 

include_once('inc/head.php');
?>

<body>

	<?php include_once('inc/header.php');?> 
	
	<div class="clearfix"></div>
		<!-- //w3_agileits_top_nav-->
		
		<!-- /inner_content-->
				<div class="inner_content">
				    <!-- /inner_content_w3_agile_info-->

					<!-- breadcrumbs -->
						<div class="w3l_agileits_breadcrumbs">
							<div class="w3l_agileits_breadcrumbs_inner">
								<ul>
									<li><a href="main-page.php">Home</a><span>«</span></li>
									
									<li>Message</li>
								</ul>
							</div>
						</div>
					<!-- //breadcrumbs -->
					<div class="row">
					    <div class="col-sm-12">
							<br><br>
							<h4><b>Reporters Name  : </b> <?php echo $name; ?> </h4>
							<h4><b>Report Category : </b><?php echo $categories; ?> </h4>
							<p><b> <h4>Message:  </h4></b>
								<?php echo $message; ?> 
							</p>
							<div class="container-fluid" id="image-feed">
								<?php
									$newimg = explode(',', $upload);
									$z = count($newimg);
									for ($i=0; $i < $z; $i++) { 
										echo'<img src="../asset/images/'.$newimg[$i].'" class="img-responsive" width="70%">';
									}
								?>
								
							</div>
							<b>Local Government: <?php echo $lga; ?>  </b>
							<br>
							<b>State: <?php echo $state; ?>  </b>
							<br>
							<b>Date: <?php echo date('D, d M, Y @ H:i:s', $date ); ?>  </b>
							
						</div>
					</div>
				</div>
	

	<footer>
		<?php include('inc/footer.php'); ?>
	</footer>

</body>
</html>
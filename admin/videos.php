 <?php 
require_once('inc/db.php');

include_once('inc/head.php'); ?>

<body>
<!-- banner -->
<div class="wthree_agile_admin_info">
		  <!-- /w3_agileits_top_nav-->
		  <!-- /nav-->
		  <?php include_once('inc/header.php');?>
		<div class="clearfix"></div>
		<!-- //w3_agileits_top_nav-->
		
		<!-- /inner_content-->
				<div class="inner_content" style="height:800px;">
				    <!-- /inner_content_w3_agile_info-->

					<!-- breadcrumbs -->
						<div class="w3l_agileits_breadcrumbs">
							<div class="w3l_agileits_breadcrumbs_inner">
								<ul>
									<li><a href="main-page.php">Home</a><span>«</span></li>
									
									<li>Videos</li>
								</ul>
							</div>
						</div>
					<!-- //breadcrumbs -->

					<div class="inner_content_w3_agile_info two_in">
					  <h2 class="w3_inner_tittle">Videos</h2>
									<!-- tables -->	
							<div class="agile-tables">	  
								<div class="w3l-table-info agile_info_shadow">
									<h3 class="w3_inner_tittle two">Modify the Videos</h3>
									<div class="col-md-9">
					                    <h1><i class="fa fa-database"></i> Video <small>Add Or View Video Files</small></h1><hr>
					                    <ol class="breadcrumb">
					                    <li><a href="index.php"><i class="fa fa-tachometer"></i> Dashboard</a></li>
					                      <li class="active"><i class="fa fa-database"></i> Video</li>
					                    </ol>
										
					                    <?php
											if(isset($_POST['submit'])){
											    if(count($_FILES['video']['name']) > 0){
											        for($i = 0; $i < count($_FILES['video']['name']); $i++){
											            $video = $_FILES['video']['name'][$i];
											            $ext = end(explode('.', $video));
											            $newvideo = rand(10000000, 999999999).".".$ext;
											            $tmp_name = $_FILES['video']['tmp_name'][$i];

											            $query = "INSERT INTO `videos` (video) VALUES ('$newvideo')";
											            if(mysqli_query($con, $query)){
											                $path = "../asset/videos/".$newvideo;
											                if(move_uploaded_file($tmp_name, $path)){
											                    
											                }
											            }

											        }
											    }
											}
										?>

					                    <form action="" method="post" enctype="multipart/form-data">
					                        <div class="row">
					                            <div class="col-sm-4 col-xs-8">
					                                <input type="file" name="video[]" required multiple>
					                            </div>
					                            <div class="col-sm-4 col-xs-4">
					                                <input type="submit" name="submit" class="btn btn-primary btn-sm" value="Add Video">
					                            </div>
					                        </div>
					                    </form><hr>
					                    
					                    <div class="row">
					                    	<?php
					                        $get_query = "SELECT * FROM `videos` ORDER BY `id`";
					                        $get_run = mysqli_query($con, $get_query);
					                        if(mysqli_num_rows($get_run) > 0){
					                            
					                            while($get_row = mysqli_fetch_array($get_run)){
					                                $get_video = $get_row['video'];
					                            
					                        ?>
					                       	<div class="col-lg-2 col-md-3 col-sm-3 col-xs-6 thumb">
					                            <a href="videos/<?php echo $get_video;?>" class="thumbnail">
					                                <video width="100%" height="50%" controls>
					                                    <source src="../asset/videos/<?php echo $get_video;?>" type="video/mp4/avi/ogg/webm">
					                                </video>
					                            </a>
					                        </div>
					                        <?php
					                        	}
			                    			}
					                       	else{
					                            echo "<center><h2>No Video Available</h2></center>";
					                        }
					                        ?>
					                    </div>

					                </div>

									</div>
								</div>
							<!-- //tables -->							
				    </div>
					<!-- //inner_content_w3_agile_info-->
				</div> 
</div>
		<!-- //inner_content-->
<!--copy rights start here-->
<?php include_once('inc/footer.php');?>	
<!--copy rights end here-->
<!-- js -->

          <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
		  <script src="js/modernizr.custom.js"></script>
		
		   <script src="js/classie.js"></script>
		  <script src="js/gnmenu.js"></script>
		  <script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
		 </script>
<!-- tables -->

<script type="text/javascript" src="js/jquery.basictable.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $('#table').basictable();

      $('#table-breakpoint').basictable({
        breakpoint: 768
      });

      $('#table-swap-axis').basictable({
        swapAxis: true
      });

      $('#table-force-off').basictable({
        forceResponsive: false
      });

      $('#table-no-resize').basictable({
        noResize: true
      });

      $('#table-two-axis').basictable();

      $('#table-max-height').basictable({
        tableWrapper: true
      });
    });
</script>
<!-- //js -->
									<script type="text/javascript">
									  	$('#table-no-resize').basictable({
										noResize: true
										});
									</script>
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

<script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>


</body>
</html>
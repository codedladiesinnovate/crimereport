<?php require_once('inc/db.php');

if(isset($_GET['edit'])){
    $edit_id = $_GET['edit'];
}

if(isset($_GET['del'])){
    $del_id = $_GET['del'];
    $del_query = "DELETE FROM `category` WHERE id = '$del_id'";
    if(mysqli_query($con, $del_query)){
        $del_msg = "Category Has Been Deleted";
    }
    else{
        $del_error = "Category Has not Been Deleted";
    }
}

if(isset($_POST['submit'])){
    $cat_name = mysqli_real_escape_string($con, strtolower($_POST['cat-name']));
    
    if(empty($cat_name)){
        $error = "Must Fill This Field";
    }
    else{
        $check_query = "SELECT * FROM `category` WHERE category = '$cat_name'";
        $check_run = mysqli_query($con, $check_query);
        if(mysqli_num_rows($check_run) > 0){
            $error = "Category Already Exist";
        }
        else{
            $insert_query = "INSERT INTO `category` (category) VALUES ('$cat_name')";
            if(mysqli_query($con, $insert_query)){
                $msg = "Category Has Been Added";
            }
            else{
                $error = "Category Has not Been Added";
            }
        }
    }
}

if(isset($_POST['update'])){
    $cat_name = mysqli_real_escape_string($con, strtolower($_POST['cat-name']));
    
    if(empty($cat_name)){
        $up_error = "Must Fill This Field";
    }
    else{
        $check_query = "SELECT * FROM `category` WHERE category = '$cat_name'";
        $check_run = mysqli_query($con, $check_query);
        if(mysqli_num_rows($check_run) > 0){
            $up_error = "Category Already Exist";
        }
        else{
            $update_query = "UPDATE `category` SET `category` = '$cat_name' WHERE `category`.`id` = $edit_id";
            if(mysqli_query($con, $update_query)){
                $up_msg = "Category Has Been Updated";
            }
            else{
                $up_error = "Category Has not Been Updated";
            }
        }
    }
}
?>
<?php include_once('inc/head.php'); ?>

<body>
<!-- banner -->
<div class="wthree_agile_admin_info">
		  <!-- /w3_agileits_top_nav-->
		  <!-- /nav-->
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
									
									<li>Categories</li>
								</ul>
							</div>
						</div>
					<!-- //breadcrumbs -->

					<div class="inner_content_w3_agile_info two_in">
					  <h2 class="w3_inner_tittle">Categories</h2>
									<!-- tables -->
									
							<div class="agile-tables">	  
								<div class="w3l-table-info agile_info_shadow">
									<h3 class="w3_inner_tittle two">You Can View, Add, Delete and Edit Categories </h3>
									<div class="col-md-6">
										<h4><code>View All The Categories </code></h4><br>
										<?php
				                            $get_query = "SELECT * FROM `category` ORDER BY id DESC";
				                            $get_run = mysqli_query($con, $get_query);
				                            if(mysqli_num_rows($get_run) > 0){
				                                
				                                if(isset($del_msg)){
			                                        echo "<span class='pull-right' style='color:green;'>$del_msg</span>";
			                                    }
			                                    else if(isset($del_error)){
			                                        echo "<span class='pull-right' style='color:red;'>$del_error</span>";
			                                    }
				                         ?>
										<table class="table table-bordered">
											<thead>
												<tr>
				                                    <th>Sr #</th>
				                                    <th>Category Name</th>
				                                    <th>Edit</th>
				                                    <th>Del</th>
												</tr>
											</thead>
											<tbody>
												<?php 
				                                    while($get_row = mysqli_fetch_array($get_run)){
				                                        $category_id = $get_row['id'];
				                                        $category_name = $get_row['category'];
				                                ?>
												<tr>
			                                        <td><?php echo $category_id;?></td>
			                                        <td><?php echo ucfirst($category_name);?></td>
			                                        <td><a href="category.php?edit=<?php echo $category_id;?>"><i class="fa fa-pencil"></i></a></td>
			                                        <td><a href="category.php?del=<?php echo $category_id;?>"><i class="fa fa-times"></i></a></td>
			                                    </tr>	
			                                    <?php }?>	
											</tbody>
										</table>
										<?php
				                            }
				                            else{
				                                echo "<center><h3>No Categories Found</h3></center>";
				                            }
				                        ?>
									</div>
									<div class="col-md-6"><br><br>
										<p class="mrg"><code>Add </code> &nbsp; <code> Delete </code> Or <code> Edit </code> Update  Category</p><br>
										<div class="list-group list-group-alternate"> 

											<form action="" method="post">
				                                <div class="form-group">
				                                    <label for="category">Category Name:</label>
				                                    <?php
					                                    if(isset($msg)){
					                                        echo "<span class='pull-right' style='color:green;'>$msg</span>";
					                                    }
					                                    else if(isset($error)){
					                                        echo "<span class='pull-right' style='color:red;'>$error</span>";
					                                    }
					                                ?>
					                                <input type="text" placeholder="Category Name" class="form-control" name="cat-name">
				                                </div>
				                                <input type="submit" value="Add Category" name="submit" class="btn btn-primary">
				                            </form>
				                            <?php
					                            if(isset($_GET['edit'])){
					                                $edit_check_query = "SELECT * FROM `category` WHERE id = $edit_id";
					                                $edit_check_run = mysqli_query($con, $edit_check_query);
					                                if(mysqli_num_rows($edit_check_run) > 0){
					                                    
					                               $edit_row = mysqli_fetch_array($edit_check_run);
					                                    $up_category = $edit_row['category'];
					                        ?>
				                            <hr>
				                            
				                            <form action="" method="post">
				                                <div class="form-group">
				                                    <label for="category">Update Category Name:</label>
				                                    <?php
				                                    if(isset($up_msg)){
				                                        echo "<span class='pull-right' style='color:green;'>$up_msg</span>";
				                                    }
				                                    else if(isset($up_error)){
				                                        echo "<span class='pull-right' style='color:red;'>$up_error</span>";
				                                    }
				                                    ?>
				                                    <input type="text" value="<?php echo $up_category;?>" placeholder="Category Name" class="form-control" name="cat-name">
				                                </div>
				                                <input type="submit" value="Update Category" name="update" class="btn btn-primary">
				                            </form>
				                            <?php 
				                             }
				                            }
				                          	?>
										</div>
									</div>
									<div class="clearfix"> </div>									
								</div>
							</div>
							<!-- //tables -->
					    </div>
					<!-- //inner_content_w3_agile_info-->
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
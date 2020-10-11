<?php require_once('inc/db.php');

if(isset($_GET['del'])){
    $del_id = $_GET['del'];
    $del_check_query = "SELECT * FROM users WHERE id = $del_id";
    $del_check_run = mysqli_query($con, $del_check_query);
    if(mysqli_num_rows($del_check_run) > 0){
        $del_query = "DELETE FROM `users` WHERE `users`.`id` = $del_id";
        if(mysqli_query($con, $del_query)){
            $msg = "User Has been Deleted";
        }
        else{
            $error = "User has not been deleted";
        } 
   	}
    else{
        header('location: users.php');
    }


if(isset($_POST['checkboxes'])){
    
    foreach($_POST['checkboxes'] as $user_id){
        
        $bulk_option = $_POST['bulk-options'];
        
        if($bulk_option == 'delete'){
            $bulk_del_query = "DELETE FROM `users` WHERE `users`.`id` = $user_id";
            mysqli_query($con, $bulk_del_query);
        }
    }
    
}}
?> 
<?php include_once('inc/head.php'); ?>

<body>
<!-- banner -->
<div class="wthree_agile_admin_info">
		  <!-- /w3_agileits_top_nav-->
		  <!-- /nav-->
		  <?php include_once('inc/header.php');?>
		<!-- //w3_agileits_top_nav-->
		
		<!-- /inner_content-->
				<div class="inner_content">
				    <!-- /inner_content_w3_agile_info-->

					<!-- breadcrumbs -->
						<div class="w3l_agileits_breadcrumbs">
							<div class="w3l_agileits_breadcrumbs_inner">
								<ul>
									<li><a href="main-page.php">Home</a><span>«</span></li>
									
									<li>Users</li>
								</ul>
							</div>
						</div>
					<!-- //breadcrumbs -->

					<div class="inner_content_w3_agile_info two_in">
					  <h2 class="w3_inner_tittle">Users</h2>
									<!-- tables -->
									
							<div class="agile-tables">	  
								<div class="w3l-table-info agile_info_shadow">
									<h3 class="w3_inner_tittle two"><code> Add, View, Edit and Delete User </code></h3>
									<?php
				                    $query = "SELECT * FROM users ORDER BY id DESC";
				                    $run = mysqli_query($con, $query);
				                    if(mysqli_num_rows($run) > 0){
				                    ?>
									<form action="" method="post">
					                    <div class="row">
					                        <div class="col-sm-8">
					                                <div class="row">
					                                    <div class="col-xs-4">
					                                        <div class="form-group">
					                                            <select name="bulk-options" id="" class="form-control" style="height: 50px;">
					                                                <option value="delete">Delete</option>
					                                            </select>
					                                        </div>
					                                    </div>
					                                    <div class="col-xs-8">
					                                        <input type="submit" class="btn btn-success" value="Apply">
					                                    </div>
					                                </div>
					                        </div>
					                    </div>
										<?php
					                        if(isset($error)){
					                            echo "<span style='color:red;' class='pull-right'>$error</span>";
					                        }
					                        else if(isset($msg)){
					                            echo "<span style='color:green;' class='pull-right'>$msg</span>";
					                        }
					                    ?>
					                    <table class="table table-bordered table-striped table-hover table-no-resize">
					                        <thead style="background-color:black; color:white;">
					                            <tr> 
					                               <th><input type="checkbox" id="selectallboxes"></th>
					                                <th>Sr #</th>
					                                <th>Fullname</th>
					                                <th>Email</th>
					                                <th>Password</th>
					                                <th>Edit</th>
					                                <th>Del</th> 
					                            </tr>
					                        </thead>
					                        <tbody>
					                         	<?php
						                            while($row = mysqli_fetch_array($run)){
						                                $id = $row['id'];
						                                $fullname = ucfirst($row['fullname']);
						                                $email = $row['email'];
						                                $password = $row['password'];
						                        ?>
					                            <tr>
					                               <td><input type="checkbox" class="checkboxes" name="checkboxes[]" value="<?php echo $id;?>"></td>
					                                <td><?php echo $id;?></td>
					                                <td><?php echo "$fullname";?></td>
					                                <td><?php echo $email;?></td>
					                                <td><?php echo $password;?></td>
					                                <td><a href="edit-user.php?edit=<?php echo $id;?>"><i class="fa fa-pencil"></i></a></td>
                                					<td><a href="users.php?del=<?php echo $id;?>"><i class="fa fa-times"></i></a></td>
					                            </tr>
					                          <?php }?>
					                        </tbody>
					                    </table>
					                    <?php
					               	    	}
					                   	else{
					                        echo "<center><h2>No Users Availabe Now</h2></center>";
					                   	}
					                    ?> 
					                </form>
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
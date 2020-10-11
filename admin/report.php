<?php

require('inc/db.php');
error_reporting(0); 
if(isset($_SESSION['username'])){
    header('Location: index.php');
}

$session_username = $_SESSION['username'];

if (isset($_POST['subfilter'])) {
	$state = $_POST['state'];
	$sql = "SELECT * FROM `report` WHERE `state` = '$state';";
}else if(isset($_POST['reset'])){
$sql = 'SELECT * FROM report ORDER BY id';
}else{
$sql = 'SELECT * FROM report ORDER BY id';
}

if(isset($_GET['del'])){
    $del_id = $_GET['del'];
    $del_check_query = "SELECT * FROM `report` WHERE id = $del_id";
    $del_check_run = mysqli_query($con, $del_check_query);
    
    if(mysqli_num_rows($del_check_run) > 0){
        $del_query = "DELETE FROM `report` WHERE `report`.`id` = $del_id";
        if(mysqli_query($con, $del_query)){
            $msg = "Post Has been Deleted";
        }
        else{
            $error = "Post has not been deleted";
        } 
    }
    else{
        header('location: report.php');
    }
}

if(isset($_POST['checkboxes'])){
    
    foreach($_POST['checkboxes'] as $user_id){
        
        $bulk_option = $_POST['bulk-options'];
        
        if($bulk_option == 'delete'){
            $bulk_del_query = "DELETE FROM `report` WHERE `report`.`id` = $user_id";
            mysqli_query($con, $bulk_del_query);
        }
        else if($bulk_option == 'approve'){
            $bulk_admin_query = "UPDATE `report` SET `status` = 'approve' WHERE `report`.`id` = $user_id";
            mysqli_query($con, $bulk_admin_query);
        }
        
    }
    
}

include_once('inc/head.php'); 
?>

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
									
									<li>Reports</li>
								</ul>
							</div>
						</div>
					<!-- //breadcrumbs -->

					<div class="inner_content_w3_agile_info two_in">
					  <h2 class="w3_inner_tittle">Reports</h2>
									<!-- tables -->
									
							<div class="agile-tables">	  
								<div class="w3l-table-info agile_info_shadow">
									<h3 class="w3_inner_tittle two"><code> Add, View, Edit and Delete Report </code> </h3>
									<?php 
								 		$query = "SELECT * FROM report ORDER BY id DESC";
                        				$run = mysqli_query($con, $query);
                        			?>
								 	<form action="" method="post">
								 		
								 		<?php
								 		 	if(mysqli_num_rows($run) > 0){
	                    				?>
					                    <div class="row">
					                        <div class="col-sm-6">
					                                <div class="row">
					                                    <div class="col-xs-4">
					                                        <div class="form-group">
					                                            <select name="bulk-options" id="" class="form-control" style="height: 50px;">
					                                                <option value="delete">Delete</option>
					                                                <option value="approve">Approve</option>
					                                            </select>
					                                        </div>
					                                    </div>
					                                    <div class="col-xs-8">
					                                        <input type="submit" class="btn btn-success" value="Apply">
					                                        <a href="add-report.php" class="btn btn-primary">Add New</a>
					                                    </div>
					                                </div></div>
					                                <div class="col-sm-6">
					                                    	<div class="form-group" >
	
																<form method="POST" action="" style="float: right">

																	<select class="form-control" name="state" style="width: 150px; display: inline;height: 50px;"> 
																		<option value="">Select State</option>
																		<?php
																		$sql2 = "SELECT * FROM `report` GROUP BY `state` ASC";
																		$result2 = mysqli_query($con, $sql2);
																		if (mysqli_num_rows($result2) > 0) {
																			  $report2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);
																			  foreach ($report2 as $row2) {
															               	echo'<option value="'.$row2['state'].'">'.$row2['state'].'</option>';
															               }
															               }else{
															               	echo'<option value="">No States Available</option>';
															               }
																		?>
																	</select>
																	<span>
																		<button class="btn btn-primary" name="subfilter">GO</button>
																	</span>
																</form> 
																<form method="POST" action="">
																	<button class="btn btn-primary" name="reset">VIEW ALL</button>
																</form>
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
					                    <table class="table table-bordered table-striped table-hover">
					                        <thead>
					                            <tr>
					                               <th><input type="checkbox" id="selectallboxes"></th>
					                                <th>Sr #</th>
					                                <th>Fullname</th>
					                                <th>Category</th>
					                                <th>Image</th>
					                                <th>State</th>
					                                <th>LGA</th>
					                                <th>Date</th>
					                                <th>Approve</th>
					                                <th>Del</th>
					                            </tr>
					                        </thead>
					                        <tbody>	
					                        <?php
					                            while($row = mysqli_fetch_array($run)){
					                                $id = $row['id'];
					                                $fullname = $row['fullname'];
					                                $state = $row['state'];
					                                $lga = $row['lga'];
					                                $categories = $row['category'];
					                                $image = $row['image'];
					                                $status = $row['status'];
					                                $date = getdate($row['date']);
					                                $day = $date['mday'];
					                                $month = substr($date['month'],0,3);
					                                $year = $date['year']; 

					                        ?>
					                            <tr>
					                               <td><input type="checkbox" class="checkboxes" name="checkboxes[]" value="<?php echo $id;?>"></td> 
					                                
					                                <td><?php echo $id;?></td>
					                                <td><?php echo $fullname;?></td>
					                                <td><a href="single.php?report_id=<?php echo $row['id'];?>"><?php echo $categories;?></a></td>
					                                <td><a href="single.php?report_id=<?php echo $row['id'];?>"><img src="../asset/images/<?php echo $image;?>" width="50px"></a></td>
					                                <td><?php echo $state;?></td>
					                                <td><?php echo $lga;?></td>
					                                <td><?php echo "$day $month $year";?></td> 
					                                <?php
					                                if ($row['status'] != "Approved") {
					                                	echo '<td><a href="process.php?id='.$id.'"  class="btn btn-success" >Approve</a></td>';
					                                }else{
					                                ?>
					                                <td><a href="process.php?id=<?php echo $row['id'];?>&action=disapprove"  class="btn btn-danger" >Disapprove</a></td>  <?php }?>
					                             <!--   <td><span style="color:
					                                 <?php
					                             //       if($status == 'publish'){
					                               //         echo 'green';
					                                //    }
					                                //    else if($status == 'draft'){
					                                 //       echo 'red';
					                                  //  }
					                                    ?>;"><?php // echo ucfirst($status);?></span></td> -->
					                                
                                					<td><a href="report.php?del=<?php echo $id;?>"><i class="fa fa-times"></i></a></td>
					                            </tr>
					                           <?php  }?> 
					                        </tbody>
					                    </table>
					                    <?php
					                   		}
					                    else{
					                        echo "<center><h2>No Reports Availabe Now</h2></center>";
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
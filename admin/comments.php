<?php 
require_once('inc/db.php');
if(isset($_GET['del'])){
    $del_id = $_GET['del'];
    $del_check_query = "SELECT * FROM `comment` WHERE id = $del_id";
    $del_check_run = mysqli_query($con, $del_check_query);
    if(mysqli_num_rows($del_check_run) > 0){
        $del_query = "DELETE FROM `comment` WHERE `comment`.`id` = $del_id";
            if(mysqli_query($con, $del_query)){
                $msg = "Comment Has been Deleted";
            }
            else{
                $error = "Comment has not been deleted";
            } 
      
    }
    else{
        header('location: comments.php');
    }
}

if(isset($_GET['approve'])){
    $approve_id = $_GET['approve'];
    $approve_check_query = "SELECT * FROM `comment` WHERE id = $approve_id";
    $approve_check_run = mysqli_query($con, $approve_check_query);
    if(mysqli_num_rows($approve_check_run) > 0){
        $approve_query = "UPDATE `comment` SET `status` = 'approve' WHERE `comment`.`id` = $approve_id";
        if(mysqli_query($con, $approve_query)){
                $msg = "Comment Has Been Approved";
        }
        else{
            $error = "Comment Has Not Been Approved";
        } 
    }
    else{
        header('location: comments.php');
    }
}

if(isset($_GET['unapprove'])){
    $unapprove_id = $_GET['unapprove'];
    $unapprove_check_query = "SELECT * FROM comment WHERE id = $unapprove_id";
    $unapprove_check_run = mysqli_query($con, $unapprove_check_query);
    if(mysqli_num_rows($unapprove_check_run) > 0){
        $unapprove_query = "UPDATE `comment` SET `status` = 'pending' WHERE `comment`.`id` = $unapprove_id";
        if(mysqli_query($con, $unapprove_query)){
            $msg = "Comment Has Been Unapproved";
        }
        else{
            $error = "Comment Has Not Been Unapproved";
        } 
    }
    else{
        header('location: comments.php');
    }
}

if(isset($_POST['checkboxes'])){
    
    foreach($_POST['checkboxes'] as $user_id){
        
        $bulk_option = $_POST['bulk-options'];
        
        if($bulk_option == 'delete'){
            $bulk_del_query = "DELETE FROM `comment` WHERE `comment`.`id` = $user_id";
            mysqli_query($con, $bulk_del_query);
        }
        else if($bulk_option == 'approve'){
            $bulk_author_query = "UPDATE `comment` SET `status` = 'approve' WHERE `comment`.`id` = $user_id";
            mysqli_query($con, $bulk_author_query);
        }
        else if($bulk_option == 'pending'){
            $bulk_admin_query = "UPDATE `comment` SET `status` = 'pending' WHERE `comment`.`id` = $user_id";
            mysqli_query($con, $bulk_admin_query);
        }
        
    }
    
}

include_once('inc/head.php'); ?>

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
									
									<li>Comments</li>
								</ul>
							</div>
						</div>
					<!-- //breadcrumbs -->

					<div class="inner_content_w3_agile_info two_in">
					  <h2 class="w3_inner_tittle">Comments</h2>
									<!-- tables -->
							<?php
                    if(isset($_GET['reply'])){
                        $reply_id = $_GET['reply'];
                        $reply_check = "SELECT * FROM comment WHERE report_id = $reply_id";
                        $reply_check_run = mysqli_query($con, $reply_check);
                        if(mysqli_num_rows($reply_check_run) > 0){
                            if(isset($_POST['reply'])){
                                $comment_data = $_POST['comment'];
                                if(empty($comment_data)){
                                    $comment_error = "Must Fill This Feild";
                                }
                                else{
                                    $get_user_data = "SELECT * FROM users WHERE username = '$session_username'";
                                    $get_user_run = mysqli_query($con, $get_user_data);
                                    $get_user_row = mysqli_fetch_array($get_user_run);
                                    $date = time();
                                    $fullname = $get_user_row['fullname'];
                                    $email = $get_user_row['email'];
                                    
                                    $insert_comment_query = "INSERT INTO `comment` (date,fullname,username,report_id,comment,status) VALUES ('$date','$fullname','$session_username','$reply_id','$comment_data','approve')";
                                    if(mysqli_query($con, $insert_comment_query)){
                                        $comment_msg = "Comment Has Been Submited";
                                        header('location: comments.php');
                                    }
                                    else{
                                        $comment_error = "Comment Has Not Been Submited";
                                    }
                                }
                            }
                        
                    ?>
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="comment">Comment:*</label>
                                    <?php
                                    if(isset($comment_error)){
                                        echo "<span class='pull-right' style='color:red;'>$comment_error</span>";
                                    }
                            else if(isset($comment_msg)){
                                        echo "<span class='pull-right' style='color:green;'>$comment_msg</span>";
                                    }
                                    ?>
                                    <textarea name="comment" id="comment" cols="30" rows="10" placeholder="Your Comment Here" class="form-control"></textarea>
                                </div>
                                <input type="submit" name="reply" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                    <hr>
                    
                    <?php
                            
                            }
                    }
?>

							<div class="agile-tables">	  
								<div class="w3l-table-info agile_info_shadow">
									<h3 class="w3_inner_tittle two"><code> Approve, Reply and Delete Comment </code> </h3>
									<?php
										$query = "SELECT * FROM `comment` ORDER BY id DESC";
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
					                                            <option value="approve">Approve</option>
					                                            <option value="pending">Unapprove</option>
					                                        </select>
					                                    </div>
					                                </div>
					                                <div class="col-xs-8">
					                                    <input type="submit" class="btn btn-success" value="Apply">
					                                </div>
					                            </div>
					                    </div>
					                </div>
					               
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                               <th><input type="checkbox" id="selectallboxes"></th>
                                <th>Sr #</th>
                                <th>Date</th>
                                <th>Username</th>
                                <th>Comment</th>
                                <th>Status</th>
                                <th>Approve</th>
                                <th>Unapprove</th>
                                <th>Reply</th>
                                <th>Del</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php
                            while($row = mysqli_fetch_array($run)){
                                $id = $row['id'];
                                $status = $row['status'];
                                $comment = $row['comment'];
                                $reply_id = $row['report_id'];
                                $date = getdate($row['date']);
                                $day = $date['mday'];
                                $month = substr($date['month'],0,3);
                                $year = $date['year'];
                            ?>
                            <tr>
                               <td><input type="checkbox" class="checkboxes" name="checkboxes[]" value="<?php echo $id;?>"></td>
                                <td><?php echo $id;?></td>
                                <td><?php echo "$day $month $year";?></td>
                                <td>

                                <?php 
                                    $user_query = "SELECT * FROM users WHERE id = $id";
			                        $user_run = mysqli_query($con, $user_query);
			                        $user_row = mysqli_fetch_array($user_run);
                                    echo $username = $user_row['username'];
                                ?>
                                </td>
                                <td><?php echo $comment;?></td>
                                <td><span style="color:<?php if($status == 'approve'){echo 'green';}else if($status == 'pending'){echo 'red';}?>;">     	<?php echo ucfirst($status);?></span></td>
                                <td><a href="comments.php?approve=<?php echo $id;?>">Approve</a></td>
                                <td><a href="comments.php?unapprove=<?php echo $id;?>">Unapprove</a></td>
                                <td><a href="comments.php?reply=<?php echo $post_id;?>"><i class="fa fa-reply"></i></a></td>
                                <td><a href="comments.php?del=<?php echo $id;?>"><i class="fa fa-times"></i></a></td>
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
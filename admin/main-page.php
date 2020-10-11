<?php  
session_start();
require_once('inc/db.php');
if(isset($_SESSION['username'])){
    header('Location: index.php');
}
$comment_tag_query = "SELECT * FROM `comment` WHERE status = 'pending'";
$category_tag_query = "SELECT * FROM `category`";
$users_tag_query = "SELECT * FROM `users`";
$reports_tag_query = "SELECT * FROM `report`";

$com_tag_run = mysqli_query($con, $comment_tag_query);
$cat_tag_run = mysqli_query($con, $category_tag_query);
$user_tag_run = mysqli_query($con, $users_tag_query);
$report_tag_run = mysqli_query($con, $reports_tag_query);


$com_rows = mysqli_num_rows($com_tag_run);
$cat_rows = mysqli_num_rows($cat_tag_run);
$user_rows = mysqli_num_rows($user_tag_run);
$report_rows = mysqli_num_rows($report_tag_run);


include_once('inc/head.php'); 

?>
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
					<div class="inner_content_w3_agile_info">
					<!-- /agile_top_w3_grids-->
					   <div class="agile_top_w3_grids">
					          <ul class="ca-menu">
									<li>
										<a href="comments.php">
											
											<i class="fa fa-comment" aria-hidden="true"></i>
											<div class="ca-content">
												<h4 class="ca-main">16,808</h4>
												<h3 class="ca-sub">View All Comments</h3>
											</div>
										</a>
									</li>
									<li>
										<a href="users.php">
										  <i class="fa fa-users" aria-hidden="true"></i>
											<div class="ca-content">
												<h4 class="ca-main one">26,808</h4>
												<h3 class="ca-sub one">View All Users</h3>
											</div>
										</a>
									</li>
									<li>
										<a href="report.php">
											<i class="fa fa-file" aria-hidden="true"></i>
											<div class="ca-content">
											<h4 class="ca-main two">29,008</h4>
												<h3 class="ca-sub two">View All Reports</h3>
											</div>
										</a>
									</li>
									<li>
										<a href="videos.php">
											<i class="fa fa-play-circle" aria-hidden="true"></i>
											<div class="ca-content">
												<h4 class="ca-main three">49,436</h4>
												<h3 class="ca-sub three">View All Videos</h3>
											</div>
										</a>
									</li>
										<li>
										<a href="category.php">
											<i class="fa fa-list-alt" aria-hidden="true"></i>
											<div class="ca-content">
												<h4 class="ca-main four">30,808</h4>
												<h3 class="ca-sub four">View All Categories</h3>
											</div>
										</a>
									</li>
									<div class="clearfix"></div>
								</ul>
					   </div>
					 <!-- //agile_top_w3_grids-->
						<!-- /agile_top_w3_post_sections-->
							<div class="agile_top_w3_post_sections">
							       <div class="col-md-6 agile_top_w3_post agile_info_shadow">
										    <h4> Latest Report	</h4>										
											<div class="stats-wrap">
												<?php
													$get_reports_query = "SELECT * FROM report ORDER BY id DESC LIMIT 5";
													$get_reports_run = mysqli_query($con,$get_reports_query);
													if(mysqli_num_rows($get_reports_run) > 0){
												?>
												<table class="table">
													<thead>
													    <tr>
													        <th>Sr #</th>
													        <th>Date</th>
													        <th>Category</th>
													        <th>State</th>
													        <th>LGA</th>
													    </tr>
													</thead>
													<tbody>
													<?php 
													while($get_reports_row = mysqli_fetch_array($get_reports_run)){
													    $reports_id = $get_reports_row['id'];
													    $reports_date = getdate($get_reports_row['date']);
													    $reports_day = $reports_date['mday'];
													    $reports_month = substr($reports_date['month'],0,3);
													    $reports_year = $reports_date['year'];
													    $reports_categories = $get_reports_row['category'];
													    $reports_state = $get_reports_row['state'];
													    $reports_lga = $get_reports_row['lga'];


													?>
													<tr> <a href="single.php">
													    <td><?php echo $reports_id;?></td>
													    <td><?php echo "$reports_day $reports_month $reports_year";?></td>
													    <td><?php echo ucfirst($reports_categories);?></td>
													    <td><?php echo $reports_state;?></td>
													    <td><?php echo $reports_lga;?></td> </a>
													</tr>
													<?php }?>
													 </tbody>
													    </table>
													<a href="report.php" class="btn btn-primary">View All Reports</a>
													<?php }?>

											</div>
									   </div>
									    <div class="col-md-6 agile_top_w3_post_info agile_info_shadow">	
											<h3> Users</h3>
									    		<?php
													$get_users_query = "SELECT * FROM users ORDER BY id DESC LIMIT 5";
													$get_users_run = mysqli_query($con,$get_users_query);
													if(mysqli_num_rows($get_users_run) > 0){

												?>
													<table class="table table-hover table-striped">

														<thead>
														    <tr>
														        <th>Sr #</th>
														        <th>Email</th>
														        <th>Fullname</th>

														    </tr>
														</thead>
														<tbody>
														<?php 
														while($get_users_row = mysqli_fetch_array($get_users_run)){
														    $users_id = $get_users_row['id'];
														    $users_email = $get_users_row['email'];
														    $users_fullname = $get_users_row['fullname'];


														?>
														<tr>
														    <td><?php echo $users_id;?></td>
														    <td><?php echo $users_email;?></td>
														    <td><?php echo $users_fullname;?></td>
														</tr>
														<?php }?>
														</tbody>
													</table>
													<a href="users.php" class="btn btn-primary">View All Users</a><hr>
														<?php }?>
												
											</div>
							     </div>
						 
						<!-- /social_media-->
						  <div class="social_media_w3ls">
						 
						      
							  <div class="clearfix"></div>
													
						</div>
						<!-- //social_media-->
				    </div>
					<!-- //inner_content_w3_agile_info-->
				</div>
		<!-- //inner_content-->
	</div>
<!-- banner -->
<!--copy rights start here-->
<?php include_once('inc/footer.php');?>	
<!--copy rights end here-->
<!-- js -->

<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>

	<!-- /amcharts -->
				<script src="js/amcharts.js"></script>
		       <script src="js/serial.js"></script>
				<script src="js/export.js"></script>	
				<script src="js/light.js"></script>
				<!-- Chart code -->
	 <script>
var chart = AmCharts.makeChart("chartdiv", {
    "theme": "light",
    "type": "serial",
    "startDuration": 2,
    "dataProvider": [{
        "country": "USA",
        "visits": 4025,
        "color": "#FF0F00"
    }, {
        "country": "China",
        "visits": 1882,
        "color": "#FF6600"
    }, {
        "country": "Japan",
        "visits": 1809,
        "color": "#FF9E01"
    }, {
        "country": "Germany",
        "visits": 1322,
        "color": "#FCD202"
    }, {
        "country": "UK",
        "visits": 1122,
        "color": "#F8FF01"
    }, {
        "country": "France",
        "visits": 1114,
        "color": "#B0DE09"
    }, {
        "country": "India",
        "visits": 984,
        "color": "#04D215"
    }, {
        "country": "Spain",
        "visits": 711,
        "color": "#0D8ECF"
    }, {
        "country": "Netherlands",
        "visits": 665,
        "color": "#0D52D1"
    }, {
        "country": "Russia",
        "visits": 580,
        "color": "#2A0CD0"
    }, {
        "country": "South Korea",
        "visits": 443,
        "color": "#8A0CCF"
    }, {
        "country": "Canada",
        "visits": 441,
        "color": "#CD0D74"
    }, {
        "country": "Brazil",
        "visits": 395,
        "color": "#754DEB"
    }, {
        "country": "Italy",
        "visits": 386,
        "color": "#DDDDDD"
    }, {
        "country": "Taiwan",
        "visits": 338,
        "color": "#333333"
    }],
    "valueAxes": [{
        "position": "left",
        "axisAlpha":0,
        "gridAlpha":0
    }],
    "graphs": [{
        "balloonText": "[[category]]: <b>[[value]]</b>",
        "colorField": "color",
        "fillAlphas": 0.85,
        "lineAlpha": 0.1,
        "type": "column",
        "topRadius":1,
        "valueField": "visits"
    }],
    "depth3D": 40,
	"angle": 30,
    "chartCursor": {
        "categoryBalloonEnabled": false,
        "cursorAlpha": 0,
        "zoomable": false
    },
    "categoryField": "country",
    "categoryAxis": {
        "gridPosition": "start",
        "axisAlpha":0,
        "gridAlpha":0

    },
    "export": {
    	"enabled": true
     }

}, 0);
</script>
<!-- Chart code -->
<script>
var chart = AmCharts.makeChart("chartdiv1", {
    "type": "serial",
	"theme": "light",
    "legend": {
        "horizontalGap": 10,
        "maxColumns": 1,
        "position": "right",
		"useGraphSettings": true,
		"markerSize": 10
    },
    "dataProvider": [{
        "year": 2017,
        "europe": 2.5,
        "namerica": 2.5,
        "asia": 2.1,
        "lamerica": 0.3,
        "meast": 0.2,
        "africa": 0.1
    }, {
        "year": 2016,
        "europe": 2.6,
        "namerica": 2.7,
        "asia": 2.2,
        "lamerica": 0.3,
        "meast": 0.3,
        "africa": 0.1
    }, {
        "year": 2015,
        "europe": 2.8,
        "namerica": 2.9,
        "asia": 2.4,
        "lamerica": 0.3,
        "meast": 0.3,
        "africa": 0.1
    }],
    "valueAxes": [{
        "stackType": "regular",
        "axisAlpha": 0.5,
        "gridAlpha": 0
    }],
    "graphs": [{
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Europe",
        "type": "column",
		"color": "#000000",
        "valueField": "europe"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "North America",
        "type": "column",
		"color": "#000000",
        "valueField": "namerica"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Asia-Pacific",
        "type": "column",
		"color": "#000000",
        "valueField": "asia"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Latin America",
        "type": "column",
		"color": "#000000",
        "valueField": "lamerica"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Middle-East",
        "type": "column",
		"color": "#000000",
        "valueField": "meast"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Africa",
        "type": "column",
		"color": "#000000",
        "valueField": "africa"
    }],
    "rotate": true,
    "categoryField": "year",
    "categoryAxis": {
        "gridPosition": "start",
        "axisAlpha": 0,
        "gridAlpha": 0,
        "position": "left"
    },
    "export": {
    	"enabled": true
     }
});
</script>

	<!-- //amcharts -->
		<script src="js/chart1.js"></script>
				<script src="js/Chart.min.js"></script>
		<script src="js/modernizr.custom.js"></script>
		
		<script src="js/classie.js"></script>
		<script src="js/gnmenu.js"></script>
		<script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
		</script>
			<!-- script-for-menu -->

<!-- /circle-->
	 <script type="text/javascript" src="js/circles.js"></script>
					         <script>
								var colors = [
										['#ffffff', '#fd9426'], ['#ffffff', '#fc3158'],['#ffffff', '#53d769'], ['#ffffff', '#147efb']
									];
								for (var i = 1; i <= 7; i++) {
									var child = document.getElementById('circles-' + i),
										percentage = 30 + (i * 10);
										
									Circles.create({
										id:         child.id,
										percentage: percentage,
										radius:     80,
										width:      10,
										number:   	percentage / 1,
										text:       '%',
										colors:     colors[i - 1]
									});
								}
						
				</script>
	<!-- //circle -->
	<!--skycons-icons-->
<script src="js/skycons.js"></script>
<script>
									 var icons = new Skycons({"color": "#fcb216"}),
										  list  = [
											"partly-cloudy-day"
										  ],
										  i;

									  for(i = list.length; i--; )
										icons.set(list[i], list[i]);
									  icons.play();
								</script>
								<script>
									 var icons = new Skycons({"color": "#fff"}),
										  list  = [
											"clear-night","partly-cloudy-night", "cloudy", "clear-day", "sleet", "snow", "wind","fog"
										  ],
										  i;

									  for(i = list.length; i--; )
										icons.set(list[i], list[i]);
									  icons.play();
								</script>
<!--//skycons-icons-->
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
		<script src="js/flipclock.js"></script>
	
	<script type="text/javascript">
		var clock;
		
		$(document).ready(function() {
			
			clock = $('.clock').FlipClock({
		        clockFace: 'HourlyCounter'
		    });
		});
	</script>
<script src="js/bars.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>

<script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>


</body>
</html>
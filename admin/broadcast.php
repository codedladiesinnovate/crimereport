<?php
  session_start();

function sendSMS($receiver_number, $reply_message) {
    $smsreceivers = $receiver_number; //numbers seperated by comma;
    $smsg = $reply_message;
    # call sms function
    $owneremail =   "info@elraesynergy.com";
    $subacct    =   "DIMGBA";
    $subacctpwd =   "dimgba";
    $sendto     =   urlencode($smsreceivers); /* destination number */
    $sender     =   "DND_BYPASS"; // "EasyPower"; // /* sender id */
    $message    =   urlencode($smsg); /* message to be sent */
    /* create the required URL */
    $cmd = "http://www.smslive247.com/http/index.aspx?cmd=sendmsg&sessionid=e465a7f2-fdc2-4f86-aa39-a0bf8b417907&message=".$message."&sender=".$sender."&sendto=".$sendto."&msgtype=0";
    # call the URL 
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "$cmd");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);// grab URL and pass it to the browser
    $response = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);

    if ($err) {
      echo $smsreceivers . "<br>";
        echo "cURL Error #:" . $err;
    } else {
      echo $smsreceivers . "<br>";
        echo "$response\n";
    }
}


if ( isset( $_REQUEST ) && !empty( $_REQUEST ) ) {
 if (
 isset( $_REQUEST['phoneNumber'], $_REQUEST['smsMessage'] ) &&
  !empty( $_REQUEST['phoneNumber'] ) 
 ) {
  $message = wordwrap( $_REQUEST['smsMessage'], 70 );
  $to = $_REQUEST['phoneNumber'];
  //$result = @mail( $to, '', $message );
sendSMS($_REQUEST['phoneNumber'],$_REQUEST['smsMessage']);
  print('Message was sent to ' . $to);
 } else {
  print ('Not all information was submitted.');
 }
}
 
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
				<div class="row"><center>
					<div class="col-lg-2"></div>
					<div class="col-lg-8">
						<div class="form-group"><br><br>
					    <h1>Sending Pre and Post Election Education</h1><br><br>
					    <form action="" method="post">
					     
					    	<label for="phoneNumber" style="text-align:left;">Phone Number</label> <br>
					    	<input type="text" name="phoneNumber" id="phoneNumber" placeholder="08165537257" class="form-control" /><br>

					      
					       <label for="smsMessage">Message</label>
					       <textarea name="smsMessage" id="smsMessage" cols="45" rows="15" class="form-control"></textarea>
					      
					    	<input type="submit" name="sendMessage" id="sendMessage" value="Send Message" />
					   </form>
					</div>
  </div> </center>
</div>
</div> 
</div>

  <footer>
    <?php include('inc/footer.php'); ?>
  </footer>
 </body>
</html>


<?php
include('inc/db.php');

if (isset($_GET['id']) && !isset($_GET['action'])) {
	$id = $_GET['id'];
	$sql = "UPDATE `report` SET `status` = 'Approved' WHERE `id` = '$id';";
	$result = mysqli_query($con, $sql);
				echo "<script>alert('Message Appoved Successfully!');</script>";
				echo "<script>window.location='report.php';</script>";
			}

if (isset($_GET['action'])) {
	$id = $_GET['id'];
	$sql = "UPDATE `report` SET `status` = 'Disapproved' WHERE `id` = '$id';";
	$result = mysqli_query($con, $sql);
				echo "<script>alert('Message Disappoved Successfully!');</script>";
				echo "<script>window.location='report.php';</script>";
			}

if (isset($_GET['action'])) {
	$id = $_GET['id'];
	$sql = "DELETE FROM `users` WHERE `id` = '$id';"; 
	$result = mysqli_query($con, $sql);
				echo "<script>alert('User Deleted Successfully!');</script>";
				echo "<script>window.location='users.php';</script>";
			}


?>
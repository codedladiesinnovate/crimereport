<?php 
  require('inc/db.php');
// PHP code to illustrate the working  
// of md5(), sha1() and hash() 
  
// $str = 'Password'; 
// $salt = 'Username20Jun96'; 
// echo sprintf("The md5 hashed password of %s is: %s\n",  
//                                 $str, md5($str.$salt)); 
// echo sprintf("The sha1 hashed password of %s is: %s\n", 
//                                 $str, sha1($str.$salt)); 
// echo sprintf("The gost hashed password of %s is: %s\n",  
                        // $str, hash('gost', $str.$salt)); 
   



   if(isset($_GET['hash'])){
    $hash_id = $_GET['hash'];
    $hash_check_query = "SELECT * FROM `report` WHERE `id` = $hash_id";
    $hash_check_run = mysqli_query($con, $hash_check_query);
    
    // if(mysqli_num_rows($hash_check_run) > 0){
    	$str = $hash_check_run['message'];
		$salt = $hash_check_run['category']; 
		$hashed =  sprintf("The gost hashed password of %s is: %s\n",  
                        $str, hash('gost', $str.$salt)); 
        echo "$hashed";
        // $hash_query = "DELETE FROM `report` WHERE `report`.`id` = $del_id";
        // if(mysqli_query($con, $del_query)){
        //     $msg = "Post Has been Deleted";
        // }
        // else{
        //     $error = "Post has not been deleted";
        // } 
    // }
    // else{
    //     header('location: report.php');
    // }
}                       
?> 

<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

    <form action="" method="GET">

        <button name="hash">Hash</button>

    </form>

</body>
</html>
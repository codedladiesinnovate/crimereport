<?php
ob_start();
session_start();

require_once('db');

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $sql = "SELECT * FROM `users` WHERE `username` = '$email' AND `password` = '$password';";
    $query=mysqli_query($conn,$sql);
     $numrow=mysqli_num_rows($query);
     if ($numrow > 0) {
       $result=mysqli_fetch_array($query,MYSQLI_ASSOC);
      $id=$result['id'];
      $name=$result['name'];
      $role=$result['role'];
      $_SESSION['user'] = $name;
      $_SESSION['role'] = $role;
       header('Location: index');
     }else{
      $error = "Sorry! User Does Not Exist...";
     }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Crime Reporting Login</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      
      <?php
      if (isset($error)) {
        echo '<div class="card-header" style="color: red">Login - '.$error.'</div>';
      }else{
        echo '<div class="card-header">Login</div>';
      }
      ?>
      
      <div class="card-body">
        <form method="POST" action="#">
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input class="form-control" id="email" name="email" type="email" aria-describedby="emailHelp" placeholder="Enter email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control" id="password" name="password" type="password" placeholder="Password">
          </div>
          <div class="form-group">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox"> Remember Password</label>
            </div>
          </div>
          <button class="btn btn-primary btn-block" name="submit" type="submit">Login</button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="#">Register an Account</a>
          <a class="d-block small" href="#">Forgot Password?</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>

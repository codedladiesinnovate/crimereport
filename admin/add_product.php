<?php
ob_start();
session_start();
$newname2 = "";
require_once('db');

    if ($_SESSION['role'] != "Admin") {
     header('Location: login');
}

   if (isset($_POST['submit'])) {
    $item = $_POST['item'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $discount = $_POST['discount'];
    $description = $_POST['desc'];
    $supplier = "Priceless Stores";
    $new = "Yes";
        // Count # of uploaded files in array
$total = count($_FILES['file']['name']);

// Loop through each file
for( $i=0 ; $i < $total ; $i++ ) {
$name = $_FILES['file']['name'][$i];
$ext = end((explode('.', $name)));
$ext1= ".".$ext;
  //Get the temp file path
  $tmpFilePath = $_FILES['file']['tmp_name'][$i];

  //Make sure we have a file path
  if ($tmpFilePath != ""){
    //Setup our new file path
    $newFilePath = "../images/" . $newname = date('YmdHis',time()).mt_rand().$ext1;

    //Upload the file into the temp dir
    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
       $newname2 = $newname2."##".$newname;
    
    }
  }
}
  $sql = "INSERT INTO `priceless`.`product` (`id`, `item`, `category`, `price`, `discount`, `description`, `supplier`, `new`, `img`) VALUES (NULL, '$item', '$category', '$price', '$discount', '$description', '$supplier', '$new', '$newname2');";
if(mysqli_query($conn,$sql)){
            $message = "Product was Uploaded Successfully!";
    }else{
        $error = "Product was not Uploaded Successfully, try again later!";
    }
if (isset($message)) {
    echo "<script>alert('".$message."');</script>";
}elseif (isset($error)) {
    echo "<script>alert('".$error."');</script>";
}
   }


?>


<!DOCTYPE html>
<html lang="en">

<?php
include_once('head');
?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Add Products</li>
      </ol>
      <div class="row">
        <div class="col-12">
         <div class="container" >
    <div class="card card-register mx-auto mt-5" style="max-width: 100%">
      <div class="card-header">Add a New Product</div>
      <div class="card-body">
        <form method="POST" action="" multipart="" enctype="multipart/form-data">
          
           <div class="form-group">
            <label for="item">Item</label>
            <input class="form-control" id="item" name="item" type="text" aria-describedby="itemHelp" placeholder="Product Title" required>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-4">
                <label for="category">Category</label>
                 <select class="form-control" id="category" name="category" required>
                  <option value="">Select Category</option>
                  <option value="Electronics">Electronics</option>
                  <option value="Laptops">Laptops</option>
                  <option value="Phones">Phones & Tablets</option>
                  <option value="Accessories_Gadgets">Accessories_Gadgets</option>
                  <option value="Accessories_Clothes">Accessories_Clothes</option>
                  <option value="Clothes">Clothes</option>
                  <option value="Shoes">Shoes</option>
                  <option value="Household">Household</option>
                  <option value="Kitchen">Kitchen</option>
                  <option value="Food">Food</option>
                </select>
              </div>
              <div class="col-md-4">
                <label for="price">Price</label>
                <input class="form-control" id="price" name="price" type="number" aria-describedby="priceHelp" placeholder="Product Price" required>
              </div>
               <div class="col-md-4">
                <label for="discount">Discount</label>
                <select class="form-control" id="discount" name="discount" required>
                  <option value="">Select Discount Value</option>
                  <option value="5">5%</option>
                  <option value="10">10%</option>
                  <option value="20">20%</option>
                  <option value="30">30%</option>
                  <option value="40">40%</option>
                  <option value="50">50%</option>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="desc">Description</label>
            <textarea class="form-control" name="desc" id="desc" placeholder="Description of Product" rows="5" required></textarea>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputPassword1">Product Image(s)</label>
                <input class="form-control" type="file" name="file[]" id="file[]" required multiple >
              </div>
            
            </div>
          </div>
           <button type="submit" class="btn btn-primary btn-block" name="submit" >Add Product</button>
        </form>
      </div>
    </div>
  </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Priceless Stores 2018</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="logout">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
  </div>
</body>

</html>

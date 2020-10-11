<?php
ob_start();
session_start();
$newname2 = "";
$edit = "false";
require_once('db');

    if ($_SESSION['role'] != "Admin") {
     header('Location: login');
}





   if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $item = $_POST['item'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $discount = $_POST['discount'];
    $description = $_POST['desc'];
    $supplier = "Priceless Stores";
    $new = "Yes";
    $img = $_POST['img'];
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
$img2 = $img.$newname2;
$sql = "UPDATE `priceless`.`product` SET `item` = '$item', `category` = '$category', `price` = '$price', `discount` = '$discount', `description` = '$description', `supplier` = 'Priceless Stores', `img` = '$img2' WHERE `product`.`id` = $id;";
if(mysqli_query($conn,$sql)){
            $message = "Product was Updated Successfully!";
    }else{
        $error = "Product was not Updated Successfully, try again later!";
    }
if (isset($message)) {
       header('Location: edit_product?data='.$message);
}elseif (isset($error)) {
       header('Location: edit_product?data='.$error);
}

   }



?>


<!DOCTYPE html>
<html lang="en">

<?php
include_once('head');
$sql = "SELECT * FROM `product`;";
    $query=mysqli_query($conn,$sql);
     $numrow=mysqli_num_rows($query);
      if($numrow>0){
      $result=mysqli_fetch_array($query,MYSQLI_ASSOC);
      $id=$result['id'];
      $item=$result['item'];
       while ($result=mysqli_fetch_array($query)) {
               $id=$id."||".$result['id'];
               $item=$item."||".$result['item'];
             }
                      $id2=explode("||", $id);
                      $item2=explode("||", $item);
                      $x=count($id2);
                    }

if (isset($_POST['edit']) && isset($_POST['editp'])) {
  $id3 = $_POST['editp'];
  $sql = "SELECT * FROM `product` WHERE `id` = '$id3';";
    $query=mysqli_query($conn,$sql);
      $result=mysqli_fetch_array($query,MYSQLI_ASSOC);
      $id3=$result['id'];
      $item=$result['item'];
      $category=$result['category'];
      $price=$result['price'];
      $discount=$result['discount'];
      $description=$result['description'];
      $img = $result['img'];
      $edit = "true";
}
?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Edit Products</li>
      </ol>
      <div class="row">
        <div class="col-12">
         <div class="container" >
    <div class="card card-register mx-auto mt-5" style="max-width: 100%">
      <div class="card-header" style="display: inline">Update Product <?php if (isset($_GET['data'])) { $data = $_GET['data']; echo "<p style='color: blue'>".$data."</p>";} ?></div>
      <div class="card-body">
      <form method="POST" action="#">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-8">
                 <select class="form-control" id="editp" name="editp" required>
                  <option value="">Select Product Below</option>
                  <?php
              for ($i=0; $i < $x; $i++) { 
                echo "<option value='".$id2[$i]."'>".$item2[$i]."</option>";              
                    }
            ?>
                  
                 
                </select>
              </div>
              <div class="col-md-4">
                <button type="submit" class="btn btn-primary btn-block" name="edit" >Edit Product</button>
              </div>
              
            </div>
          </div>

      </form>
<hr>
      <?php
      if ($edit === "true") {
        ?>
        <form method="POST" action="" multipart="" enctype="multipart/form-data">
          
           <div class="form-group">
            <label for="item">Item</label>
            <input class="form-control" id="item" name="item" type="text" aria-describedby="itemHelp" placeholder="Product Title" value="<?php echo $item; ?>" required>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-4">
                <label for="category">Category</label>
                 <select class="form-control" id="category" name="category" required>
                  <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
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
                <input class="form-control" id="price" name="price" type="number" aria-describedby="priceHelp" placeholder="Product Price" value="<?php echo $price; ?>" required>
              </div>
              <input type="hidden" name="id" value="<?php echo $id3; ?>">
              <input type="hidden" name="img" value="<?php echo $img; ?>">
               <div class="col-md-4">
                <label for="discount">Discount</label>
                <select class="form-control" id="discount" name="discount" required>
                  <option value="<?php echo $discount; ?>"><?php echo $discount."%"; ?></option>
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
            <textarea class="form-control" name="desc" id="desc" placeholder="Description of Product" rows="5" required><?php echo $description; ?></textarea>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputPassword1">Add New Product Image(s)</label>
                <input class="form-control" type="file" name="file[]" id="file[]" multiple >
              </div>
            
            </div>
          </div>
           <button type="submit" class="btn btn-primary btn-block" name="submit" >Update Product</button>
        </form>
        <?php } ?>
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

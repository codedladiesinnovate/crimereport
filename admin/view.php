<?php
$allow = "no";
ob_start();
session_start();
require_once('db');

    if ($_SESSION['role'] != "Admin") {
     header('Location: login');
}


if(isset($_POST['checkbox'])){
    
    foreach($_POST['checkbox'] as $user_id){
        $sql = "SELECT * FROM `product` WHERE `id` = '$user_id';";
    $query=mysqli_query($conn,$sql);
     $numrow=mysqli_num_rows($query);
      if($numrow>0){
      $result=mysqli_fetch_array($query,MYSQLI_ASSOC);
      $img=$result['img'];
       $img2=explode("##", $img);
                  $a = count($img2);
        for ($i=0; $i < $a; $i++) { 

      array_map('unlink', (glob("../images/".$img2[$i])? glob("../images/".$img2[$i]): array()));
    }
    }
        $bulk_option = "delete";
        
        if($bulk_option == 'delete'){
            $bulk_del_query = "DELETE FROM `product` WHERE `id` = '$user_id';";
            mysqli_query($conn, $bulk_del_query);
             
                header('Location: view_products');
        }
                
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">

<?php
include_once('head');

$x = "";
$sql = "SELECT * FROM `crime`;";
    $query=mysqli_query($conn,$sql);
     $numrow=mysqli_num_rows($query);
      if($numrow>0){
      $result=mysqli_fetch_array($query,MYSQLI_ASSOC);
      $id=$result['id'];
      $title=$result['title'];
      $description=$result['description'];
      $img=$result['image'];
       while ($result=mysqli_fetch_array($query)) {
               $id=$id."||".$result['id'];
               $title=$title."||".$result['title'];
               $description=$description."||".$result['description'];
               $img=$img."||".$result['image'];
             }
                      $id2=explode("||", $id);
                      $title2=explode("||", $title);
                      $description2=explode("||", $description);
                      $img2=explode("||", $img);
                      $allow = "yes";
                      $px=count($id2);
                    }

?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">View All Reported Crimes</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
           View All Crimes</div>
        <div class="card-body">
          <div class="table-responsive">
          <form method="POST" action="">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

              <thead>
                <tr>
                  <th style="width: 60px"><button type="submit" class="btn btn-primary btn-block" name="del" >Del (*)</button></th>
                  <th>Title</th>
                   <th>Description</th>
                  <th>Img</th>
                  <th>Del</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                <th><button type="submit" class="btn btn-primary btn-block" name="del" >Del (*)</button></th>
                <th>Title</th>
                   <th>Description</th>
                  <th>Img</th>
                  <th>Del</th>
                </tr>
              </tfoot>
               <tbody>
               <?php
               if($allow === "yes"){
              for ($i=0; $i < $px; $i++) {          
            ?>
             
                <tr>
                <td><input type="checkbox" name="checkbox[]" value="<?php echo $id2[$i]; ?>"></td>
                  <td><?php echo $title2[$i]; ?></td>
                  <td><?php echo $description2[$i]; ?></td>
                  <?php
                  $img3=explode("##", $img2[$i]);
                  $a = count($img3);
                  ?>

                  <td><a href="file/<?php echo $img3[1] ?>" target="_blank">View Evidence</a></td>
                  <td><a href="<?php echo 'process?id='.$id2[$i] ?>" ><i class="fa fa-times"></i></a></td>
                </tr>
                  <?php
                  }}
                  ?>
              </tbody>
            </table>
            </form>
          </div>
        </div>
        <div class="card-footer small text-muted">Crime Reporting</div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © 2018</small>
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
    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
  </div>
</body>

</html>

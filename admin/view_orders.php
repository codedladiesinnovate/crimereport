<?php
ob_start();
session_start();
require_once('db');

    if ($_SESSION['role'] != "Admin") {
     header('Location: login');
}




?>

<!DOCTYPE html>
<html lang="en">

<?php
include_once('head');
$x = "";
$sql = "SELECT * FROM `order`;";
    $query=mysqli_query($conn,$sql);
     $numrow=mysqli_num_rows($query);
      if($numrow>0){
      $result=mysqli_fetch_array($query,MYSQLI_ASSOC);
      $id=$result['id'];
      $tracking=$result['tracking'];
      $name=$result['name'];
      $address=$result['address'];
      $order=$result['order'];
      $date=$result['date'];
       while ($result=mysqli_fetch_array($query)) {
               $id=$id."||".$result['id'];
               $tracking=$tracking."||".$result['tracking'];
               $name=$name."||".$result['name'];
               $address=$address."||".$result['address'];
               $order=$order."||".$result['order'];
               $date=$date."||".$result['date'];
             }
                      $id2=explode("||", $id);
                      $tracking2=explode("||", $tracking);
                      $name2=explode("||", $name);
                      $address2=explode("||", $address);
                      $order2=explode("||", $order);
                      $date2=explode("||", $date);
                      $x=count($id2);
                    }
?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">View All Orders</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
           View All Orders</div>
        <div class="card-body">
          <div class="table-responsive">
          <form method="POST" action="">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

              <thead>
                <tr>
                  <th>Tracking</th>
                  <th>Order</th>
                   <th>Name</th>
                  <th>Address</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tfoot>
               <tr>
                  <th>Tracking</th>
                  <th>Order</th>
                   <th>Name</th>
                  <th>Address</th>
                  <th>Date</th>
                </tr>
              </tfoot>
              <tbody>
               <?php
              for ($i=0; $i < $x; $i++) {          
            ?>
              
                <tr>
                  <td><?php echo $tracking2[$i]; ?></td>
                  <td><?php echo $order2[$i]; ?></td>
                  <td><?php echo $name2[$i]; ?></td>
                  <td><?php echo $address2[$i]; ?></td>
                  <td><?php echo $date2[$i]; ?></td>
                </tr>
                  <?php
                  }
                  ?>
              </tbody>
            </table>
            </form>
          </div>
        </div>
        <div class="card-footer small text-muted">Priceless Stores [All Orders]</div>
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

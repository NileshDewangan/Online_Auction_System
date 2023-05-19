<?php
session_start();
if(!$_SESSION['auth'])
{
  header('location:login.html');
}
?>
<?php

@include 'config.php';

if(isset($_POST['add_product'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'uploaded_img/'.$product_image;

   if(empty($product_name) || empty($product_price) || empty($product_image)){
      $message[] = 'please fill out all';
   }else{
      $insert = "INSERT INTO products(name, price, image) VALUES('$product_name', '$product_price', '$product_image')";
      $upload = mysqli_query($conn,$insert);
      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         $message[] = 'new product added successfully';
      }else{
         $message[] = 'could not add the product';
      }
   }

};

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM products WHERE id = $id");
   header('location:admin_page.php');
};

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
        <meta name="viewport" contents="IE=edge">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0" />
        <title>Auction</title>
        <link rel="stylesheet" href="stylepage.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
         <style>
  .modal-header, h4, .close {
    background-color: #5cb85c;
    color:white !important;
    text-align: center;
    font-size: 30px;
  }
  .modal-footer {
    background-color: #f9f9f9;
  }
  </style>
    </head>
    <body>
      <header class="nav">
           <h2 class="logo">ACN</h2> 
           <nav class="navigation">
            <button type="button" class="btn btn-default btn-lg" id="myBtn">BID</button>
            <a href="login.html">Logout</a>
           </nav>      
      </header>

<?php

if(isset($message)){
   foreach($message as $message){
      echo '<span class="message">'.$message.'</span>';
   }
}

?>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-oil"></span> BID</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
          <form role="form" action="bid.php" method="post">
            <div class="form-group">
              <label for="pid"><span class="glyphicon glyphicon-credit-card"></span> Product Id</label>
              <input type="number" class="form-control" name="pid" id="pid" placeholder="Enter Product Id">
            </div>
            <div class="form-group">
              <label for="price"><span class="glyphicon glyphicon-usd"></span> Price</label>
              <input type="number" class="form-control" name="price" id="price" placeholder="Enter bidding price">
            </div>
              <button  class="btn btn-success btn-block" name="save"><span class="glyphicon glyphicon-blackboard"></span> BID</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
        </div>
      </div>
      
    </div>
  </div> 

   
<div class="container">

   

   <?php

   $select = mysqli_query($conn, "SELECT * FROM products");
   
   ?>
   <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
            <th>Product ID</th>
            <th>product name</th>
            <th>product price</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td>$<?php echo $row['price']; ?>/-</td>
         
         </tr>
      <?php } ?>
      </table>
   </div>

</div>
<script>
$(document).ready(function(){
  $("#myBtn").click(function(){
    $("#myModal").modal();
  });
});
</script>
<script src="script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
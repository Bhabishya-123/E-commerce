<?php 
    include_once('./includes/headerNav.php');
    include_once('./includes/restriction.php');

    //this will provide previous user value before updating 
    include "includes/config.php";
    $sql = "SELECT * FROM products where product_id={$_GET['id']}";
    $result = $conn->query($sql);
    // output data of each row
    $row = $result->fetch_assoc();
    $_SESSION['previous_title'] = $row['product_title'];
    $_SESSION['previous_desc'] = $row['product_desc'];
    $_SESSION['previous_catag'] = $row['product_catag'];
    $_SESSION['previous_price'] = $row['product_price'];
    $_SESSION['previous_no'] = $row['product_left'];
    $conn->close();
 ?>
 <head>
     <style>
         .update{
             width:40%;
             height:60%;
             position:absolute;
             top:25%;
             left:29%;
             background-color:#9FE2BF;
             box-shadow:2px 2px 2px 2px grey;
             font-size:20px;
             font-weight:bold;
             text-align:center;
         }
         input,textarea{
             color:red;
         }
     </style>
 </head>

 <h5>Edit post here</h5>
 <div class="update">
     <br>
 <form action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
    <label for="">Title</label> <input type="text" name='title' value="<?php echo $_SESSION['previous_title'] ?>"><br> <br>

    <label for="">Description</label> <textarea name="desc" > <?php echo $_SESSION['previous_desc'] ?></textarea><br> <br>
    
    <label for="">Catagory</label> <input type="text" name='catag' value="<?php echo $_SESSION['previous_catag'] ?>" ><br> <br>
    <label for="">Price per unit</label>   <input type="number" name='price' value="<?php echo $_SESSION['previous_price'] ?>"><br> <br>
    <label for="">No.ofitem</label>  <input type="number" name='noofitem' value="<?php echo $_SESSION['previous_no'] ?>"><br> <br>
 <br>
<button class="update-btn" type="submit" name="update">Update</button>
</form>
 </div>




<?php
   if(isset($_POST['update'])){
    //below sql will update user details inside sql table when update is clicked
    include "includes/config.php";
    $sql1 = "UPDATE products
             SET  product_title= '{$_POST['title']}' ,
                  product_catag= '{$_POST['catag']}' ,
                  product_price= '{$_POST['price']}' ,
                  product_desc= '{$_POST['desc']}' ,
                  product_left= '{$_POST['noofitem']}' 
             WHERE product_id={$_GET['id']} ";
    $conn->query($sql1);   
    
    $conn->close();
    header("Location:http://localhost/electronics_shop/admin/post.php?succesfullyUpdated");
   }
?>
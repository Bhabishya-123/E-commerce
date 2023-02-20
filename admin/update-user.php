<?php 
    include_once('./includes/headerNav.php');
    include_once('./includes/restriction.php');

    //this will provide previous user value before updating 
    include "includes/config.php";
    $sql = "SELECT * FROM customer where customer_id={$_GET['id']}";
    $result = $conn->query($sql);
    // output data of each row
    $row = $result->fetch_assoc();
    $_SESSION['previous_name'] = $row['customer_fname'];
    $_SESSION['previous_phone'] = $row['customer_phone'];
    $_SESSION['previous_address'] = $row['customer_address'];
    $_SESSION['previous_role'] = $row['customer_role'];
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
             box-shadow:2px 2px 3px 2px grey;
             font-size:20px;
             font-weight:bold;
             text-align:center;
         }
         
     </style>
 </head>

 <div class="update">
     <br>
 <form action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
    <label for="">Name</label> <input type="text" name='name' value="<?php echo $_SESSION['previous_name'] ?>"><br> <br>
    <label for="">Phone</label> <input type="number" name='phone' value="<?php echo $_SESSION['previous_phone'] ?>" ><br> <br>
    <label for="">Address</label> <input type="text" name='address' value="<?php echo $_SESSION['previous_address'] ?>" ><br> <br>
    <label for="">Role</label>
    <select id="role_update" name="role">
  <?php 
       if($_SESSION['previous_role']=='admin'){
           ?>
            <option value="admin" selected>Admin</option>
            <option value="normal">Normal</option>
     <?php  } else{?> 
            <option value="admin">Admin</option>
            <option value="normal" selected>Normal</option>
            <?php } ?>
</select>
 <br> <br> <br> <br>
<button class="update-btn" type="submit" name="update">Update</button>
</form>
 </div>




<?php
   if(isset($_POST['update'])){
    //below sql will update user details inside sql table when update is clicked
    include "includes/config.php";
    $sql1 = "UPDATE customer 
             SET  customer_fname= '{$_POST['name']}' ,
                  customer_phone= '{$_POST['phone']}' ,
                  customer_address= '{$_POST['address']}' ,
                  customer_role= '{$_POST['role']}' 
             WHERE customer_id={$_GET['id']} ";
    $conn->query($sql1);   
    
    $conn->close();
    header("Location:http://localhost/electronics_shop/admin/users.php?succesfullyUpdated");
   }
?>
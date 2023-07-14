<?php 
    include_once('./includes/headerNav.php');
    include_once('./includes/restriction.php');

    //this will provide previous user value before updating 
    include "includes/config.php";
    $sql = "SELECT * FROM servicestatus where sid={$_GET['id']}";
    $result = $conn->query($sql);
    // output data of each row
    $row = $result->fetch_assoc();
    $_SESSION['previous_status'] = $row['status'];
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
    <label for="">Status</label>
    <select id="status_update" name="status">
  <?php 
       if($_SESSION['previous_status']=='pending'){
           ?>
            <option value="pending" selected>Pending</option>
            <option value="success">Success</option>
     <?php  } else{?> 
                       <option value="pending">Pending</option>
            <option value="success" selected>Success</option>
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
    $sql1 = "UPDATE servicestatus 
             SET  status='{$_POST['status']}'
             WHERE sid={$_GET['id']} ";
    $conn->query($sql1);   
    
    $conn->close();
    header("Location:http://localhost/electronics_shop/admin/repair.php?succesfullyUpdated");
   }
?>
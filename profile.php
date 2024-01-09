<?php
   include_once('./includes/headerNav.php');
   //this restriction will secure the pages path injection
   if(!(isset($_SESSION['id']))){
      header("Location:index.php?UnathorizedUser");
      die();
     }
if(isset($_POST['delete'])){
   if (session_status() !== PHP_SESSION_ACTIVE) {
      session_start();
  }
  include_once 'includes/config.php';
$sql = "DELETE FROM soldproducts where uid={$_SESSION['id']} AND status='delivered'"; //sql query for deleting
if($conn->query($sql)){
   header("Location:profile.php?deliveredHistoryDeleted");
} //executing sql query


}
?>
<?php
//for edit backend users data php and mysql
      if(isset($_POST['save'])){
         
        if(!empty($_POST['name']) AND !empty($_POST['email'])){
         include "includes/config.php";
         $sql6 = "UPDATE customer 
                  SET  customer_fname= '{$_POST['name']}' ,
                       customer_email= '{$_POST['email']}' 
                  WHERE customer_id= '{$_SESSION['id']}' ";
         $conn->query($sql6);   
         $conn->close();
         header("Location:./profile.php?profileUpdatedSuccessfully");
        }
        if(!empty($_POST['address'])){
         include "includes/config.php";
         $sql6 = "UPDATE customer 
                  SET  customer_address= '{$_POST['address']}'
                  WHERE customer_id= '{$_SESSION['id']}' ";
         $conn->query($sql6);   
         $conn->close();         
         header("Location:./profile.php?profileUpdatedSuccessfully");
        }
        if(!empty($_POST['number'])){
         include "includes/config.php";
         $sql6 = "UPDATE customer 
                  SET  customer_phone= '{$_POST['number']}'
                  WHERE customer_id= '{$_SESSION['id']}' ";
         $conn->query($sql6);   
         $conn->close();
         header("Location:./profile.php?profileUpdatedSuccessfully");
         
        }
      }
    $sql8 ="SELECT * FROM  customer WHERE customer_id='{$_SESSION['id']}';";
    $result8 = $conn->query($sql8);
    $row8 = $result8->fetch_assoc();
    $_SESSION['customer_name'] = $row8['customer_fname'];
    $_SESSION['customer_email'] = $row8['customer_email'];
    $_SESSION['customer_phone'] = $row8['customer_phone'];
    $_SESSION['customer_address'] = $row8['customer_address'];

    $sql9 = "SELECT * FROM soldproducts where uid={$_SESSION['id']} AND status='delivered'";
    $result9 = $conn->query($sql9);
    $row9 = $result9->fetch_assoc();
    $conn->close();
?>
<head>
   <style>
      .edit-container{
                      border:none;
                      color:rgb(32, 69, 32);
                      display:flex;
                      /* align-items:center; */
                      justify-content:center;
                     }
                     th{
                     background:aliceblue;
                  }
      #edit{
            margin-left:2%;
            background:aliceblue;
            width:25%;
            overflow: hidden;
      }
      h4{
         text-decoration:underline;
         color:dark;
      }
      h4 a{
         text-alignment:center;
         color:blue
      }
      #admin{
         text-decoration:none;
         font-weight:bold;
      }
      .profile_edit{
         display:none;
      }
      .address_edit{
         display:none;
      }
      .contact_edit{
         display:none;
      }
      .show { display:inline; }
      @media (max-width: 500px) {
                     .edit-container{
                      width:100%;
                      border:none;
                      color:rgb(32, 69, 32);
                      text-align:center;
                      flex-direction:column;
                     }
                     #edit{
                     height:100%;
                     margin-bottom:5%;
                     background:aliceblue;
                     width:85%;
                    }
                    marquee{
                       width:40%;
                    }
                  }
           
   </style>
</head>
<!-- Header End====================================================================== -->
<!-- <h3 style="text-align:center; "><marquee direction="left"  width="25%" style='background:wheat;'>
                                        Hello,
                                        <?php //echo ( $_SESSION['customer_role']=='admin')? 'Admin': $_SESSION['customer_name'];?>
                                         welcome to your profile</marquee>
                                       </h3> -->

<h4 style="color:dark; text-align:center; font-family:bold">Manage My Account</h4>
<div class="edit-container">

 <div class="profile" id="edit">

    <h4>Personal Profile <a href="#/profile/edit" id="edit_link1">Edit</a></h4>
    <div class="profile_edit ">
       <form action="<?php echo $_SERVER['PHP_SELF']; ?> " method="post">
       <label for="">Enter New-name</label> <input type="text" name="name" id="">
       <label for="">Enter New-email</label> <input type="email" name="email" id="">
       <br>
        <button type="submit" name="save" class="btn-info">Save</button>
      </form>
    </div>

    <h5><?php echo $_SESSION['customer_name']." "."(".$_SESSION['customer_role'].")"  ?></h5>
    <h5><?php echo $_SESSION['customer_email']  ?></h5>
    <?php 
        if($_SESSION['customer_role'] =='admin') {
           echo "<h4>"."Go to Admin Panel"."</h4>";
           echo "<button class='btn btn-medium' style='background:yellow'>"."<a id='admin' href='admin/login.php'>"."Admin"."</a>"."</button>";
        }
    ?>
 </div>
 <div class="address" id="edit">
 <h4>Address Book <a href="#/address/edit" id="edit_link2">Edit</a></h4>
 <div class="address_edit ">
       <form action="<?php echo $_SERVER['PHP_SELF']; ?> " method="post">
       <label for="">Enter New-address</label> <input type="text" name="address" id="">
       <br>
        <button type="submit" name="save" class="btn-info">Save</button>
      </form>
    </div>
    <h5><?php echo $_SESSION['customer_address']  ?></h5>
 </div>
 <div class="contact" id="edit">
 <h4>Contact Book <a href="#/contact/edit" id="edit_link3">Edit</a></h4>
 <div class="contact_edit ">
       <form action="<?php echo $_SERVER['PHP_SELF']; ?> " method="post">
       <label for="">Enter New-number</label> <input type="number" name="number" id="">
       <br>
        <button type="submit" name="save" class="btn-info">Save</button>
      </form>
    </div>
    <h5><?php echo $_SESSION['customer_phone']  ?></h5>
 </div>
</div> 
<hr class="soften">

<div style='text-align:center'>



<div style='display:flex;flex-direction:column;justify-content:center;align-items:center;flex-wrap:wrap;' id="history_list">
 <?php
//this will dynamically fetch data from a database and show all the sold products
include "includes/config.php";

$sql10 = "SELECT * FROM soldproducts where uid='{$_SESSION['id']}' ";
$result10 = $conn->query($sql10);
$sn=0;
if ($result10->num_rows > 0) {
   ?>
   <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
<div>
   <hr>
   <h4 >Order History</h4>
<?php if($row9>0){?>
<span style='margin-right:5px'><b>Delete Delivered History</b> </span>
<button name='delete' type='submit' class="btn btn-danger">Delete</button>
<?php
}
?>

</div>
</form>

   <table style='width:80%;'>
    <tr>
    <th style='background:grey' class="short" style='background:grey'>S.N</th>
    <th style='background:grey' class="large">Image</th>
    <th style='background:grey' class="large">Product</th>
    <th style='background:grey' class="short">Price</th>
    <th style='background:grey' class="short">Quantity</th>
    <th style='background:grey' class="short">UUID</th>
    <th style='background:grey' class="short">Date</th>
    <th style='background:grey' class="short">Status</th>
    </tr>
    <?php
   // $_SESSION['history'] = true;
// output data of each row
while($row10 = $result10->fetch_assoc()) {
   $sn++;
   $sql11 = "SELECT * FROM products where product_id='{$row10['pid']}' ";
$result11 = $conn->query($sql11);
$row11 = $result11->fetch_assoc();
   $sql12 = "SELECT * FROM servicestatus where pid='{$row10['pid']}' ";
$result12 = $conn->query($sql12);
$row12 = $result12->fetch_assoc()
?>
    <tr>
    <td><?php echo $sn ?></td>
    <td><img class='image' style="height:50px;width:50px"  src="admin/upload/<?php echo $row11['product_img'] ?>"  alt="product-img">
</td>
    <td><?php echo $row11['product_title']?></td>
    <td><?php echo $row10['price']?></td>
    <td><?php echo $row10['quantity']?></td>
    <td><?php if($row12['status']==='success')echo 'Already used' ;else echo $row12['uuid']?></td>
    <td><?php echo $row10['date']?></td>
    <td><?php echo $row10['status']?></td>

</tr>

<?php }}else 
             $conn->close(); 
             ?>
</table>

 </div>
<?php 
include "includes/config.php";
$sql = "SELECT * FROM repair where user_id='{$_SESSION['id']}' ";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
   ?>
 <div>
   <hr>
   <h4 >Repair History</h4>
 <div style='display:flex;flex-direction:column;justify-content:center;;align-items:center;flex-wrap:wrap;' id="history_list">
 <table style='width:80%;'>
    <tr>
    <th style='background:grey' class="short">S.N</th>
    <th style='background:grey' class="large">Product</th>
    <th style='background:grey' class="large">Category</th>
    <th style='background:grey' class="short">Issue</th>
    <th style='background:grey' class="short">Advance</th>
    <th style='background:grey' class="short">UUID</th>
    <th style='background:grey' class="short">Due</th>
    <th style='background:grey' class="short">Booked</th>
    <th style='background:grey' class="short">Status</th>
    <th style='background:grey' class="short">Return Date</th>
    </tr>
 <?php
//this will dynamically fetch data from a database and show all the sold products
include "includes/config.php";

$sql10 = "SELECT * FROM repair where user_id='{$_SESSION['id']}' ";
$result10 = $conn->query($sql10);
$sn=0;
if ($result10->num_rows > 0) {
   // $_SESSION['history'] = true;
// output data of each row
while($row10 = $result10->fetch_assoc()) {
   $sn++;
?>

<tr>
    <td><?php echo $sn ?></td>
    <td><?php echo $row10['p_name'] ?></td>
    <td><?php echo $row10['category']?></td>
    <td><?php echo $row10['damage_type']?></td>
    <td><?php echo  $row10['advance_amt']?></td>
    <td><?php echo $row10['uuid']?></td>
    <td><?php echo $row10['due']?></td>
    <td><?php echo $row10['booked_date']?></td>
    <td><?php echo $row10['status']?></td>
    <td><?php echo $row10['return_date']?></td>


</tr>


<?php }}else { echo "No Results Found"; 

}
             $conn->close(); 
             ?>
             </table>

 </div>
</div>
<?php
}
?>
 </div>
 <?php
   include_once('./includes/footer.php')
?>
<!-- Placed at the end of the document so the pages load faster ============================================= -->
<script src="./js/jquery.js" type="text/javascript"></script>
	<script src="./js/bootstrap.min.js" type="text/javascript"></script>
   <script src="./js/edit.js"></script>



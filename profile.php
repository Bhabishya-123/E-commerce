<?php
if(isset($_POST['delete'])){
   session_start();
  include_once 'includes/config.php';
$sql = "DELETE FROM soldproducts where uid={$_SESSION['id']}"; //sql query for deleting
$conn->query($sql); //executing sql query

header("Location:profile.php?historyDeletedSuccessfully");
}
?>
<?php
   include_once('./includes/headerNav.php');
   //this restriction will secure the pages path injection
   if(!(isset($_SESSION['id']))){
      header("location:index.php?UnathorizedUser");
     }
    $sql8 ="SELECT * FROM  customer WHERE customer_id='{$_SESSION['id']}';";
    $result8 = $conn->query($sql8);
    $row8 = $result8->fetch_assoc();
    $_SESSION['customer_name'] = $row8['customer_fname'];
    $_SESSION['customer_email'] = $row8['customer_email'];
    $_SESSION['customer_phone'] = $row8['customer_phone'];
    $_SESSION['customer_address'] = $row8['customer_address'];
    $conn->close();
?>
<head>
   <style>
      .edit-container{
                      border:none;
                      height: 40%;
                      color:rgb(32, 69, 32);
                      display:flex;
                      /* align-items:center; */
                      justify-content:center;
                     }
      #edit{
            margin-left:5%;
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

<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
<div>
   <hr>
   <h4 >Purchased History</h4>

<span style='margin-right:5px'><b>Delete All History</b> </span>
<button name='delete' type='submit' class="btn btn-danger">Delete</button>
<hr>

</div>
</form>

<div style='display:flex;flex-direction:column;justify-content:center;flex-wrap:wrap;' id="history_list">
 <?php
//this will dynamically fetch data from a database and show all the sold products
include "includes/config.php";

$sql10 = "SELECT * FROM soldproducts where uid='{$_SESSION['id']}' ";
$result10 = $conn->query($sql10);
$sn=0;
if ($result10->num_rows > 0) {
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
<div  style="display:flex;justify-content:center;align-items:center;margin-bottom:10px;gap:20px; background:aliceblue" >
<h5><?php echo $sn  ?>.</h5>
<img class='image' style="height:50px;width:50px"  src="admin/upload/<?php echo $row11['product_img'] ?>"  alt="product-img">
<h5>Product: <br> <?php echo $row11['product_title']  ?></h5>
<h5>Price: <br> <?php echo $row10['price']  ?></h5>
<h5>Quantity: <br> <?php echo $row10['quantity']  ?></h5>
<h5>Uuid: <br> <?php if($row12['status']==='success')echo 'Already used' ;else echo $row12['uuid']?></h5>
<h5>Date: <br> <?php echo $row10['date']  ?></h5>
</div>

<?php }}else { echo "No Results Found"; 

}
             $conn->close(); 
             ?>

 </div>
 </div>
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
         echo "success";
         
        }
        if(!empty($_POST['address'])){
         include "includes/config.php";
         $sql6 = "UPDATE customer 
                  SET  customer_address= '{$_POST['address']}'
                  WHERE customer_id= '{$_SESSION['id']}' ";
         $conn->query($sql6);   
         
         $conn->close();
         echo "success";
         
        }
        if(!empty($_POST['number'])){
         include "includes/config.php";
         $sql6 = "UPDATE customer 
                  SET  customer_phone= '{$_POST['number']}'
                  WHERE customer_id= '{$_SESSION['id']}' ";
         $conn->query($sql6);   
         
         $conn->close();
         echo "success";
         
        }
      }
   ?>




<!-- Footer====================================================================== -->
<?php
   include_once('./includes/footer.php')
?>
<!-- Placed at the end of the document so the pages load faster ============================================= -->
<script src="./js/jquery.js" type="text/javascript"></script>
	<script src="./js/bootstrap.min.js" type="text/javascript"></script>
   <script src="./js/edit.js"></script>



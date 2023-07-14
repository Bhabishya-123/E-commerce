<?php
if(isset($_POST['delete'])){
  include_once 'includes/config.php';
$sql = "DELETE FROM carts where pid={$_GET['pid']} AND quantity={$_GET['q']} LIMIT 1"; //sql query for deleting
$conn->query($sql); //executing sql query

header("Location:cart.php?itemRemovedSuccessfully");
}
?>
<?php
   include_once('./includes/headerNav.php');
      //this restriction will secure the pages path injection
      if(!(isset($_SESSION['id']))){
        header("location:index.php?UnathorizedUser");
       }
       include_once('./stripeConfig.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ecommerce Cart</title>

</head>
<body>
<div class='cart'>

  <div class="container">
    <h1 style='float:left'>Cart</h1>
    <div style='width:100%;height:100%;overflow:hidden' class='tableBtm'>

<?php
       $total=0;
       $pidArray = [];
       $quantArray = [];
  $sql = "SELECT * FROM carts where uid={$_SESSION['id']}";
$result = $conn->query($sql) or die("Query Failed.");
if ($result->num_rows > 0) {
?>

    <table>
<thead>
<thead >
        <tr>
          <th>Sn</th>
          <th>Product</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Total</th>
          <th>Action</th>
        </tr>
      </thead>
</thead>
<tbody>
     <?php
     $sn=0;
while($row = $result->fetch_assoc()) { 
  $sn = $sn+1;
  //to save all the product_id of card list
  $pidArray[$sn-1] = $row['pid'];
  $quantArray[$sn-1] = $row['quantity'];
  $encodedPidData = urlencode(serialize($pidArray));
  $encodedQuantityData = urlencode(serialize($quantArray));

  $total = $total+ $row["price"] * $row["quantity"];
?>
<tr>
    <td><?php echo $sn?></td>
    <td><?php echo $row["product"] ?></td>
          <td><?php echo $row["price"] ?></td>
          <td>
          <p><?php echo $row["quantity"] ?></p>
          </td>
          <td><?php echo $row["price"] ?></td>
          <td>
          <form action="<?php echo $_SERVER['PHP_SELF']?>?pid=<?php echo $row['pid']?>&q=<?php echo $row['quantity']?>" method="post">
<button name='delete' type='submit' class="btn btn-danger">Remove</button>
</form>
        </td>
</tr>

<?php }?>
</tbody>

</table>
<div class="text-end">
    <h5>Total:<?php echo  $total?> </h5>
  </div>
  <div class="text-end ">
    <form action="message.php?id=<?php echo $encodedPidData?>&q=<?php echo $encodedQuantityData?>" method="post">
    <button class="btn" style="background:#11C9B6;"><a href="./index.php" style='color:white;text-decoration:none;'>Continue Shopping</a></button>
	<script
		src="https://checkout.stripe.com/checkout.js" class="stripe-button"
		data-key="<?php echo $publishableKey?>"
		data-amount="<?php echo ($total+50) ?>"
		data-name="Electric-Shop"
		data-description="Your Choice Our Voice"
		data-image="./logo1.png"
		data-currency="usd"
		data-email="<?Php echo $_SESSION['customer_email']?>"
	>
   //this form container will auto generate paynow button that comers form script form stripe
	</script>
</form>
  </div>
<?php }else { echo "0 Results <br> No items in a cart"; }
             ?>


   

      </div>
  </div>
  </div>
  <br>
  <br>
  <?php
   include_once('./includes/footer.php')
?>
</body>
</html>






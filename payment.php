<?php
session_start();
$_SESSION['paystat']='1';
   if(!(isset($_SESSION['id']))){
      header("location:signup.php?RegisterOrLoginFirst");
     }
     ?>
<?php
   include_once('./includes/headerNav.php');
   include_once('./stripeConfig.php');
     ?>
     <head>
        <style>
           .proceed-pay{
              font-size:medium;
              height:400px;
              display:flex;
              justify-content:center;
              align-items:center;
              border:none;
              background:aliceblue;
              box-shadow: 2px 2px 2px 1px rgba(0, 0, 0, 0.2);
           }
 @media only screen and (max-width: 768px){
.proceed-pay{
             height:450px;
            flex-direction:column;
            gap:20px;
}
}
           .thumbnail{
              cursor:pointer;
           }
           .ship{
               margin-right:5%;
               color:lime
           }
           .order{
               margin-left:5%;
               color:violet
           }
           h4{
              text-decoration:underline;
              color:black
           }
           .btn-pay{
              height:30px;
              color:white
           }
           .btn-pay:hover{
              border-radius:0px;
              color:wheat;
           }
           button{
              font-family:monospace
           }
        </style>
     </head>

     <?php

$sql ="SELECT * FROM  products WHERE product_id='{$_GET['id']}';";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$conn->close();
?>

<h4 style="text-align:center;"><p><a style="color:grey" href="./product.php?id=<?php echo $_GET['id']?>"> Product:<?php echo $row['product_title'] ?></a></p></h4>


     <div class="proceed-pay">

        <div class="ship">
        <h4>Shipping address</h4>
        <p>Name:<?Php echo $_SESSION['customer_name']?></p>
        <p>Address:<?Php echo $_SESSION['customer_address']?></p>
        <p>Number:<?Php echo $_SESSION['customer_phone']?></p>
        <p>Email:<?Php echo $_SESSION['customer_email']?></p>
        <a href="./profile.php"><h5 style="text-decoration:underline;">Edit profile</h5></a>
        </div>
       
  
<div class="order">
<h4>Order summary</h4>
        <p>subtotal( item)</p>
        <p>shipping_fees: Rs 50</p>
        <p>Total: Rs <?php echo $row['product_price']?>+50 = <?php echo $row['product_price']+50 ?> </p>


<form action="message.php?id=<?php echo $_GET['id']?>" method="post">
	<script
		src="https://checkout.stripe.com/checkout.js" class="stripe-button"
		data-key="<?php echo $publishableKey?>"
		data-amount="<?php echo ($row['product_price']+50) ?>"
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


     </div>

     	<div class="thumbnail">
				<img src="images/payment_methods.png" title="Bootshop Payment Methods" alt="Payments Methods">
				<div class="caption">
				  <h5>Payment Methods</h5>
				</div>
			  </div>


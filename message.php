<?php
require('stripeConfig.php');
require('./includes/config.php');
if(isset($_POST['stripeToken'])){
	?>
<?php

$sql11 ="SELECT * FROM  products WHERE product_id='{$_GET['id']}';";
$result11 = $conn->query($sql11);
$row11 = $result11->fetch_assoc();
$conn->close();
?>
	<style>
        .mess-cont{
            height:100%;
            display:flex;
        justify-content:center;
        align-items:center;
        flex-direction:column;
        }
    .mess-box{
        display:flex;
        justify-content:center;
        align-items:center;
        flex-direction:column;
        height:70%;
        width:60%;
        box-shadow: 10px 10px 34px 7px rgba(204,247,203,0.75);
-webkit-box-shadow: 10px 10px 34px 7px rgba(204,247,203,0.75);
-moz-box-shadow: 10px 10px 34px 7px rgba(204,247,203,0.75);
    }
    .mess{
        height: clamp(250px,540px,70%);
        display:flex;
        justify-content:center;
        align-items:center;
        flex-direction:column;
    }
</style>
<div class="mess-cont">

<div class="mess-box">
<div class="mess">
<h2><?php echo $row11['product_title'] ?> </h2>
    <img  src="admin/upload/<?php echo $row11['product_img'] ?>" alt="prod to deliver" style="height:80%;width:100%">
<h3 style="margin-bottom:0;padding-bottom:0;color:grey">Your product has been packed and has been sent</h3>
<h3 style="margin-top:0px;padding:0px;color:lime;text-align:center">We are on the way, thanks</h3>
<button style="background:aliceblue;padding:5px;text-decoration:none"><a href="index.php"><b> Go to shopping sites </b></a> </button>

</div>
</div>
</div>
<?php
}
?>
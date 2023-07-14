<!-- <script>
            window.onload = function() {
                // Check if the page is being reloaded
       if (performance.navigation.type === 1) {
            // Redirect to another page
            // header("location:index.php");
            // ?>
        }
        };

    </script> -->
<?php
require('stripeConfig.php');
require('./includes/config.php');
if(isset($_POST['stripeToken'])){
	?>
<?php
	session_start();
    $today_date =  date("j,n,Y"); 
 
    //funtion that will generate random uuid(unique universal identifier)
    function generateSerialNumber($productId) {
        // Generate a UUID (version 4)
        $uuid = mt_rand(1,200);
    
        // Get the current timestamp
        $timestamp = time();
    
        // Combine the UUID, product ID, and timestamp to create the serial number
        $serialNumber = "{$uuid}-{$productId}-{$timestamp}";
    
        return $serialNumber;
    }

    if(! isset($_GET['q'])){

//for single product purchase
$uuid = generateSerialNumber($_GET['id']);
$sql11 ="SELECT * FROM  products WHERE product_id='{$_GET['id']}';";
$result11 = $conn->query($sql11);
$row11 = $result11->fetch_assoc();
$price =$row11['product_price'];
$discVal = $row11['product_price']>50000?'(1)free repairing':'50% discount';
$sql12 = "INSERT INTO soldProducts (
    uid,
    pid,
    price,
    date
) VALUES(
    {$_SESSION['id']},
    {$_GET['id']},
    {$row11['product_price']},
    '{$today_date}'
    )";

    $sql13 = "INSERT INTO servicestatus (
        uid,
        discount,
        pid,
        uuid) 
        VALUES(
    {$_SESSION['id']},
'{$discVal}',
{$_GET['id']},
'{$uuid}'
        )";
        $conn->query($sql12);
$conn->query($sql13);
        }else{
//for cart(orders) inserting cart orders in soldproducts
$decodedProdId = unserialize(urldecode($_GET['id']));
$decodedQuantity = unserialize(urldecode($_GET['q']));
for ($i = 0; $i < count($decodedProdId); $i++) {
    $uuid = generateSerialNumber($decodedProdId[$i]);
    $sql11 ="SELECT * FROM  products WHERE product_id='{$decodedProdId[$i]}';";
$result11 = $conn->query($sql11);
$row11 = $result11->fetch_assoc();
$discVal = $row11['product_price']>50000?'(1)free repairing':'50% discount';
    $sql12 = "INSERT INTO soldProducts (
        uid,
        pid,
        price,
        quantity,
        date
    ) VALUES(
        {$_SESSION['id']},
        {$decodedProdId[$i]},
        {$row11['product_price']},
        {$decodedQuantity[$i]},
        '{$today_date}'
        )";
    
        $sql13 = "INSERT INTO servicestatus (
            uid,
            discount,
            pid,
            uuid) 
            VALUES(
        {$_SESSION['id']},
    '{$discVal}',
    {$decodedProdId[$i]},
    '{$uuid}'
            )";
            $conn->query($sql12);
    $conn->query($sql13);
}
        }
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
    <img  src="./images/thank.png" alt="prod to deliver" style="height:80%;width:100%">
<h3 style="margin-bottom:0;padding-bottom:0;color:grey">Your product has been packed and has been sent</h3>
<h3 style="margin-top:0px;padding:0px;color:grey;text-align:center">We are on the way<br> <span style='color:lime'>Thanks for choosing Electric-shop</span></h3>
<button style="background:aliceblue;padding:5px;text-decoration:none;margin-bottom:20px"><a href="index.php"><b> Go to shopping sites </b></a> </button>

</div>
</div>
</div>
<?php
}
?>

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
$price =$row11['product_price']+50;
$discVal = $row11['product_price']>50000?'(1)free repairing':'50% discount';
$sql12 = "INSERT INTO soldProducts (
    uid,
    pid,
    price,
    date
) VALUES(
    {$_SESSION['id']},
    {$_GET['id']},
    {$price},
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
$sql14 = "DELETE FROM carts where uid={$_SESSION['id']}";
$conn->query($sql14);

        }
$conn->close();
    }
    //after cart order sent || deleting cart items from db
$sql3 = "DELETE FROM carts where uid='{$_SESSION["id"]}'";
$conn->query($sql3);
    header("Location:message.php");
?>

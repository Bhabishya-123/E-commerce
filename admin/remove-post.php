<?php
    include "includes/config.php";
$sql = "DELETE FROM products where product_id={$_GET['id']}"; //sql query for deleting
$conn->query($sql); //executing sql query

header("Location:http://localhost/electronics_shop/admin/post.php?succesfullyDeleted");
?>

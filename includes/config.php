
<?php
//making config as we need this everytime we can just use it through include_once
//1st step for database php connection
$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "electric-shop";

//Before we can access data in the MySQL database, we need to be able to connect to the server i.e php
$conn = new mysqli($serverName,$dBUsername,$dBPassword,$dBName );

// Check connection
if(!$conn){
    die("Connection failed: ".$conn->connect_error());
}
?>
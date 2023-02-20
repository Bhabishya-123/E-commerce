
<?php
//this all are input validity functions that will provide true/false for error finding 
//in case condition not matched--it executes during signup 

function emptyInputSignup($name, $email,  $number,$address, $pwd,$rpwd){
    $result;
    if (empty($name) ||empty($email) ||empty($number) ||empty($address) ||empty($pwd) ||empty($rpwd) ) {
                 $result = true;   
    }
     else{
                 $result = false;
     }
                 return $result;
}

function invalidPhone($number){
    $result;
    if (strlen($number) != 10) { 
                 $result = true;   
    }
     else{
                 $result = false;
     }
                 return $result;
}

function invalidEmail($email){
    $result;
    if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {//this return true if var is proper email(built in func)
                 $result = true;   
    }
     else{
                 $result = false;
     }
                 return $result;
}


function pwdMatch($pwd,$rpwd) {
    $result;
    if ($pwd !== $rpwd) {
                 $result = false;   
    }
     else{
                 $result = true;
     }
                 return $result;
}



function createUser($name,$email,$address,$pwd,$number){
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



       //using prepare statement for preventing injection
       $sql = $conn->prepare("INSERT INTO customer (customer_fname,customer_email,customer_pwd,customer_phone,customer_address) VALUES (?,?,?,?,?)");
    
       $sql->bind_param('sssss',$name,$email,$pwd,$number,$address);
       $sql->execute();
     
    //after saving user data to database redirecting user to add page
    header("location: ../index.php?userSuccessfullycreated!loginNow");
    
       //last step closing connection
       $conn->close();
       $sql->close(); //closing prepare statement
    
    }
    
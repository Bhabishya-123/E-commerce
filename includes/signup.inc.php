
<?php

include_once('./config.php');
if(isset($_POST['submit'])){
   
    //ACCESSING all the input value from its name(key) given in form through its post associative array
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $number = $_POST['number'];
    $pwd = $_POST['pwd'];
    $rpwd = $_POST['rpwd'];

  
    //to stop creating account with already available gmail
    $sql = "SELECT * from customer where customer_email ='{$email}'";
    $result = $conn->query($sql);

    if(mysqli_num_rows($result)>0){
        header("location: ../signup.php?error=emailAlreadytaken");
        exit();
    }


    
    //1st step(i.e connection) done through config file
    require_once './config.php';
    require_once './signupFn.inc.php';

//error handler done by using diff functions

//1st checking if any input field is left empty by the user
if(emptyInputSignup($name, $email,  $number, $pwd,$rpwd,$address) == true){
    header("location: ../signup.php?error=emptyInput");
    exit();
}

//2nd checking if user entererd uid is appropriate or not
if(invalidPhone($number) == true){
    header("location: ../signup.php?error=enterValidNumber");
    exit();
}

//3rd checking if user entererd email is proper or not
if(invalidEmail($email) ==true){
    header("location: ../signup.php?error=invalidemail");
    exit();

}
//4th checking if user entererd password match repeated pwd
if(pwdMatch($pwd,$rpwd) !==true){
    header("location: ../signup.php?error=pwdnotmatch");
    exit();
}


//finally creating user in database incase all above condition got true
createUser($name,$email,$address,$pwd,$number);
}//if end

else{
    /* This is to redirect the browser */
    header("location: ../signup.php");
    exit("Hey there is some errors!");
}//else end

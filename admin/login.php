<?php
      include_once('./includes/restriction.php');
?>
<!doctype html>
<html>
   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ADMIN | Login</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="../css/style.php">
        <style>
            .container{
                position:absolute;
                top:70px;
                left:25%;
                width: 50%;
                display:flex;
                align-items:center;
                justify-content:center;
                height: 500px;
                background-color: whitesmoke;
            } 
        </style>
    </head>

    <body>
        <div id="wrapper-admin" class="body-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-4 col-md-4">
                       <h2 id="hlogo"><img src="../images/logo_admin.png" id="logo" alt=""></h2>
                        <h3 class="heading">Admin</h3>
                        <!-- Form Start -->
                        <div class="form">
                        <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                            <div class="form-group">
                                <label>UserEmail</label>
                                <input class="input-admin" type="email" name="userEmail" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input class="input-admin" type="password" name="password" class="form-control" placeholder="" required>
                            </div>
                            <input type="submit" name="login" class="btn btn-primary" value="login" />
                        </form>
                        <!-- /Form  End -->
                        </div>
                     
                        <?php 
                                    if(isset($_POST['login'])){
                                        include "includes/config.php";
                                        if(empty($_POST['userEmail']) || empty($_POST['password'])){
                                          echo '<div class="alert alert-danger">All Fields must be entered.</div>';
                                          die();
                                        }else{
                                          $email = mysqli_real_escape_string($conn, $_POST['userEmail']);
                                        //   $password = md5($_POST['password']);
                                             $password =$_POST['password'];
            
                                          $sql = "SELECT customer_email, customer_pwd FROM customer WHERe customer_email = '{$email}' AND customer_pwd= '{$password}'";
            
                                          $result = mysqli_query($conn, $sql) or die("Query Failed.");
            
                                          if(mysqli_num_rows($result) > 0){
                                              $_SESSION['logged-in'] = '1';
                                              header("Location: ./post.php");
                                          }else{
                                          echo '<div class="alert alert-danger">Username and Password are not matched.</div>';
                                        }
                                      }
                                      }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

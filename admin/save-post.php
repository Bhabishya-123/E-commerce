<?php
include "includes/config.php";

//1st restriction or condition before it is going to be uploaded on database
//these are required for only pic upload
if(isset($_FILES['prod-img'])){
  $file_name = $_FILES['prod-img']['name'];
  $file_size = $_FILES['prod-img']['size'];
  //tmp_name ---	A temporary address where the file is located before processing the upload request
  $file_tmp = $_FILES['prod-img']['tmp_name']; 
  $file_type = $_FILES['prod-img']['type'];
  $tmp = explode('.',$file_name);
  $file_ext = end($tmp);
  $extensions = array("jpeg","jpg","png");

  if(in_array($file_ext,$extensions) === false)
  {
    echo "This extension isn't allowed , please choose a jpg,jpeg or png file.";
    die();
  }
  else if($file_size >= 2097152){
    echo "file size must be less 2mb";
    die();
  }
  else{
    //if error not occurs than this will run so we can make 
    $error = false;
    // if every things is okay than move pic to upload (file going to be sent,destination where file is saved)
    move_uploaded_file($file_tmp,"upload/".$file_name);
  }
}//main if-end

//now finally if all condition good i.e error=false than save-post to database
   if($error===false){
    session_start();
    $today_date =  date("j,n,Y"); 
    $author = $_SESSION['customer_name'];
    $sql="INSERT INTO products 
                      (product_catag,product_title,product_price,product_desc,product_date,product_img,product_left,product_author)
               VALUES ('{$_POST['prod-category']}','{$_POST['prod-title']}','{$_POST['prod-price']}','{$_POST['prod-desc']}','{$today_date}','{$file_name}','{$_POST['noofitem']}','{$author}');";
    $result = $conn->query($sql);
    $conn->close();
    header("location:post.php?success");
   }
    ?>

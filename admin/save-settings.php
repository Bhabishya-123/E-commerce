<?php
include "includes/config.php";

if(empty($_FILES['logo']['name'])){
  $file_name = $_POST['old_logo'];
}else{
  $errors = array();

  $file_name = $_FILES['logo']['name'];
  $file_size = $_FILES['logo']['size'];
  $file_tmp = $_FILES['logo']['tmp_name']; //	A temporary address where the file is located before processing the upload request
  $file_type = $_FILES['logo']['type'];
  $file_ext = end(explode('.',$file_name));

  $extensions = array("jpeg","jpg","png");

  if(in_array($file_ext,$extensions) === false)
  {
    $errors[] = "This extension file not allowed, Please choose a JPG or PNG file.";
  }

  if($file_size > 2097152){
    $errors[] = "File size must be 2mb or lower.";
  }

  if(empty($errors) == true){
    move_uploaded_file($file_tmp,"upload/".$file_name);
  }else{
    print_r($errors);
    die();
  }
}

$sql = "UPDATE settings SET website_name='{$_POST["website_name"]}',website_logo='{$file_name}',website_footer='{$_POST["footer_desc"]}'";

$result = mysqli_query($conn,$sql);

if($result){
  header("location: settings.php?saved");
}else{
  echo "Query Failed";
}

?>

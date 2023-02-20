<?php 
    
   //this is restriction for normal user to access admin panel
   session_start();
   if($_SESSION['customer_role']!='admin'){
   header("location:../index.php?AdminRestricted");
  }

  ?>
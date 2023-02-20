<?php 
   session_start();
   unset($_SESSION['logged-in']);
   header("Location:login.php");
   ?>
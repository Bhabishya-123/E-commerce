<?php
   include_once('./includes/headerNav.php')
?>
<!-- Header End====================================================================== -->
<head>
   <style>
      /*signup*/
.sgn-input{
    width:300px;
    color: grey;
}
.signup_div{
    display: flex;
    justify-content: center;
    align-items:center
}
.div-sign{
   text-align:center
}
@media (max-width: 500px) {
   .signup_div{
    background-color: rgb(212, 229, 243);
}
}
   </style>
</head>

<!-- signup container====================================================================== -->
<h3 style='color:brown;text-align:center;'> <ins> Please signup</ins></h3>

<div class="signup_div">
<form action="includes/signup.inc.php" method="post"> <br>
   <label for="">Name:</label> <input class="sgn-input" type="text" name="name"   required="required" style="height:30px;">  
   <label for="">Email:</label>   <input class="sgn-input" type="text" name="email"  required="required" style="height:30px;"> 
   <label for="">Address:</label>  <input class="sgn-input" type="text" name="address"   required="required" style="height:30px;"> 
   <label for="">Phone:</label>  <input class="sgn-input" type="number" name="number"   required="required" style="height:30px;"> 
   <label for="">Password:</label>  <input class="sgn-input" type="password" name="pwd"  required="required" style="height:30px;"> 
   <label for="">Re-Password:</label>  <input class="sgn-input" type="password" name="rpwd"   required="required" style="height:30px;"> 
    <div class="div-sign">
    <button type="submit" class="btn btn-large btn-info" name="submit" >Register</button> 
    <?php
// if(isset($_GET['error'])){
//    if($_GET['error']==='!loggedin') echo '<br> <br><div class="alert alert-danger">Signup or Login first.</div>';

if(isset($_GET['error'])){
switch($_GET['error']){
   case '!loggedin':echo '<br> <br><div class="alert alert-danger">Signup or Login first.</div>';break;
   case 'enterValidNumber':echo '<br> <br><div class="alert alert-danger">Enter valid number.</div>';break;
   case 'invalidemail':echo '<br> <br><div class="alert alert-danger">Enter valid email address.</div>';break;
   case 'pwdnotmatch':echo '<br> <br><div class="alert alert-danger">Entered password does not matched.</div>';break;
   case 'emptyInput':echo '<br> <br><div class="alert alert-danger">Form must be filled.</div>';break;
   case 'emailAlreadytaken':echo '<br> <br><div class="alert alert-danger">Account is already registered with this email.</div>';break;
}
}

    ?>
    </div>
 
</form>
</div>




<!-- Footer====================================================================== -->
<?php
   include_once('./includes/footer.php')
?>

<!-- Placed at the end of the document so the pages load faster ============================================= -->
<script src="./js/jquery.js" type="text/javascript"></script>
	<script src="./js/bootstrap.min.js" type="text/javascript"></script>
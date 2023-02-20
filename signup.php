<?php
   include_once('./includes/headerNav.php')
?>
<!-- Header End====================================================================== -->
<head>
   <style>
      /*signup*/
.sgn-input{
    width:300px;
    text-align: center;
    color: grey;
}
.signup_div{
    display: flex;
    align-items: center;
    justify-content: center;
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
    <input class="sgn-input" type="text" name="name" placeholder="fullname"  required="required" style="height:37px;">  <br> <br>
    <input class="sgn-input" type="text" name="email" placeholder="email" required="required" style="height:37px;"> <br> <br>
    <input class="sgn-input" type="text" name="address" placeholder="address"  required="required" style="height:37px;"> <br> <br>
    <input class="sgn-input" type="number" name="number" placeholder="mobile number"  required="required" style="height:37px;"> <br> <br>
    <input class="sgn-input" type="password" name="pwd" placeholder="password"  required="required" style="height:37px;"> <br> <br>
    <input class="sgn-input" type="password" name="rpwd" placeholder="repeat password"  required="required" style="height:37px;"> <br> <br>
    <div class="div-sign">
    <button type="submit" class="btn btn-large btn-info" name="submit" >Register</button> <br> <br>
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
<?php  
// Check if session is not already started
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
} include_once 'includes/config.php';
 //run whenever this file is used no need of isset or any condition to get website image footer etc
 $sql5 ="SELECT * FROM  settings;";
 $result5 = $conn->query($sql5);
 $row5 = $result5->fetch_assoc();
 $_SESSION['web-name'] = $row5['website_name'];
 $_SESSION['web-img'] = $row5['website_logo'];
 $_SESSION['web-footer'] = $row5['website_footer'];
//it is used to get number of carts item 
if(isset($_SESSION['id'])){
$sql44 ="SELECT * FROM  carts WHERE uid='{$_SESSION['id']}';";
$result44 = $conn->query($sql44);
$_SESSION['cartItemNum']=mysqli_num_rows($result44);
}
?>

<?php
 //1st step(i.e connection) done through config file
if(isset($_POST['signin'])){

    if(empty($_POST['email'])){
           echo "<h4 id='error_login'>Enter email</h4>";
    }

    if(empty($_POST['pwd'])){
        echo "<h4 id='error_login'>Enter password</h4>";
 }

$email = mysqli_real_escape_string($conn,$_POST['email']);
$password =mysqli_real_escape_string($conn,$_POST['pwd']);

$sql ="SELECT * FROM  customer WHERE customer_email='{$email}';";
$result = $conn->query($sql);

if($result->num_rows==1){ //if any one data found go inside it
    $row = $result->fetch_assoc();
    if($password == $row['customer_pwd']){

    //session will be created only if users email and passwords matched
	$_SESSION['id'] = $row['customer_id'];
	$_SESSION['customer_role'] = $row['customer_role'];
header("Location:profile.php?id={$_SESSION['id']}");
            // put exit after a redirect as header() does not stop execution
            exit;}else{
                echo "<h4 id='error_login'>Incorrect password</h4>";//as user get inside if statem if userEmail matched
            }


}else{
    if($_POST['email']){ //it means it will run if email field is filled
    echo "<h4 id='error_login'>(unavailable) please signup first</h4>";
    }
}
}//end of 1st ifstatement

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $_SESSION['web-name']; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<style>
	#transcript{
		position:relative;
		height:28px;
	}
	#voiceIcon{
		position:absolute;
		left:185px;
		top:8px;
		height:35px;
	}
</style>
<!-- Bootstrap style --> 
    <link id="callCss" rel="stylesheet" href="./css/bootstrap.min.css" media="screen"/>
    <link href="./css/base.css" rel="stylesheet" media="screen"/>
<!-- Bootstrap style responsive -->	
	<link href="./css/bootstrap-responsive.min.css" rel="stylesheet"/>
	<link href="./css/font-awesome.css" rel="stylesheet" type="text/css">
<!-- font awesome code -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- main style -->
<link rel="stylesheet" href="./css/style.php">
  </head>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    function startDictation() {
      if (window.hasOwnProperty('webkitSpeechRecognition')) {
        const recognition = new webkitSpeechRecognition();

        recognition.continuous = false;
        recognition.interimResults = false;

        recognition.lang = 'en-US';
        recognition.start();

        recognition.onresult = function(e) {
          document.getElementById('transcript').value = e.results[0][0].transcript;
          recognition.stop();
          document.getElementById('myForm').submit();
        };

        recognition.onerror = function(e) {
          recognition.stop();
        }
      }
    }
  </script>
<body>

<!-- Navbar ================================================== -->
<div id="logoArea" class="navbar">
<a id="smallScreen" data-target="#topMenu" data-toggle="collapse" class="btn btn-navbar">
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
</a>
  <div class="navbar-inner">
   <a class="brand" href="index.php?id=<?php echo (isset( $_SESSION['customer_name']))? $_SESSION['id']: 'unknown';?>" style="opacity:0.8"><img width="200px" src="./admin/upload/<?php echo $_SESSION['web-img']; ?>" alt="electricshop"/></a>
   <form style='margin-right:4px' class="form-inline navbar-search" method="post" action="./search.php" id='myForm' >
	  <div class="input-group col-md-4">
            <input class="form-control py-2 border-right-0 border " type="search" name='search' id='transcript' placeholder="search" >
			<img id="voiceIcon" onclick="startDictation()" src="//i.imgur.com/cHidSVu.gif" />
            <span class="input-group-append" >
              <button class="btn btn-outline-secondary border-left-0 border" name='submit' type="submit">
                    <i class="fa fa-search"></i>
              </button>
            </span>
        </div>
    </form>


    <ul id="topMenu" class="nav pull-right">
	 <li class=""><a href="index.php?id=<?php echo (isset( $_SESSION['customer_name']))? $_SESSION['id']: 'unknown';?>">Home</a></li>

	 <li class=""><a href="contact.php?id=<?php echo (isset( $_SESSION['customer_name']))? $_SESSION['id']: 'unknown';?>">Contact</a></li>

	 <?php 
	   if( isset( $_SESSION['id'])){
	 ?>
	 <li class="" style="opacity:1">
	 <a href="profile.php?id=<?php echo (isset( $_SESSION['customer_name']))? $_SESSION['id']: 'unknown';?>">profile
	 </a></li> <?php } else{?>
	 <li class="" style="opacity:0.5"><a href="#?loginfirst">profile</a></li> <?php }?>

	 <?php if((isset($_SESSION['id']))){?>
		<li><a href="./repair.php"  style="padding-right:0"><span id="repair" style="color:yellow"></span><img style="height:35px" src="./images/repairIcon.png" alt="repair icon"></a></li>

	 <li style="position:relative;margin-right:5px"><a href="cart.php"  style="padding-right:0"><span id="cart" style="color:yellow"></span><img style="height:35px;position:relative" src="./images/shopping-cart.png" alt="shop-cart">
	 <div class="badge" id="cartNum" >
<?php echo $_SESSION['cartItemNum'] ?>
</div>
</a>
	</li>
     <?php } ?>
	 <?php  if(isset($_SESSION['logged-in'])){?>
	 <li> <a href="admin/post.php"  style="padding-right:0;"><span class="btn btn-medium btn-warning">Admin</span></a></li>
	<?php }
	 ?>

	 <?php 
     if( isset( $_SESSION['id'])){
     ?>

    <li ><a id="lg-btn" href="" role="button"  style="padding-right:0"><span class="btn btn-large btn-danger" >Logout</span></a>
    </li>
	<script src="./js/logout.js"></script>
	 <?php } else{?>
    <li> <a href="signup.php"  style="padding-right:0"><span class="btn btn-medium btn-success">Signup</span></a></li>
	<li class="">
		  <a href="#login" onclick="elementVisibility()" role="button" data-toggle="modal" style="padding-right:0"><span class="btn btn-large btn-success">Login</span></a>
	<div id="login" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"" onclick="closeTog()">X</button>
			<h3>Login Block</h3>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal loginFrm" action="<?php echo $_SERVER['PHP_SELF']; ?> " method="post">
			  <div class="control-group">								
				<input type="text" id="inputEmail" name="email" placeholder="Email">
			  </div>
			  <div class="control-group">
				<input type="password" id="inputPassword" name="pwd" placeholder="Password">
			  </div>
			  <div class="control-group">
	
			  </div>
			  <button type="submit" name="signin" class="btn btn-success">Login</button>
			</form>		
			
			<button class="btn" data-dismiss="modal" aria-hidden="true" onclick="closeTog()">Close</button>
		  </div>
	</div>
	</li> <?php }?>



    </ul>
  </div>
</div>
</div>
</div>



<script src='./js/loginToggle.js'></script>
<script src='./js/voiceSearch.js'></script>

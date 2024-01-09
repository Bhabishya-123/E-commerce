<?php    
include_once('./includes/headerNav.php'); 
include_once('./stripeConfig.php');

 //this restriction will secure the pages path injection
 if(!(isset($_SESSION['id'])))  header("location:index.php?notfound") ;
?>
<head>
<style>
        .outerDiv{
            display:flex;
            justify-content:center;
            align-items:center;
            flex-direction:column;
        }
        .innerDiv{
            width:80%;
            display:flex;
            flex-direction:column;
            gap:5px;
        }
        .head1{
            color:black;
            margin-left:20px
        }
        .signup_div{
            display:flex;
            justify-content:center;
            align-items:center;
        }
   
        .desc{
font-size:14px    ;margin-left:20px    }
.proceed-pay{
    width:50%;
              font-size:medium;
              height:400px;
              display:flex;
              justify-content:center;
              align-items:center;
              border:none;
              background:aliceblue;
              box-shadow: 2px 2px 2px 1px rgba(0, 0, 0, 0.2);
           }
           .verticalLine{
    height:80%;
    background:grey;
    width: 3px;
}
 @media only screen and (max-width: 768px){
.proceed-pay{
            flex-direction:column;
            gap:20px;
}
}

           .thumbnail{
              cursor:pointer;
           }
           .ship{
               margin-left:5%;
               flex-basis:40%;
           }
           .order{
               margin-left:5%;
               flex-basis:60%;
           }
           h4{
              text-decoration:underline;
              color:black
           }
           .btn-pay{
              height:30px;
              color:white
           }
           .btn-pay:hover{
              border-radius:0px;
              color:wheat;
           }
           button{
              font-family:monospace
           }
           .button {
     border: none;
     color: white;
     background-color:#40E0D0;      
     padding: 10px;
     width:80px;
     text-align: center;
     text-decoration: none;
     font-size: 14px;
     margin: 1px;
     transition-duration: 0.4s;
     cursor: pointer;
     box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
    }
            .button:hover{
          transform:scale(1.05,1.05);
    }
    
    </style>
    <script>
        $(document).ready(function() {
  $("form").submit(function(event) {
    event.preventDefault();}
    </script>
</head>
<div>
<div>
<h3 class='head1'><u> Welcome to repairing service page</u></h3>
<p class='desc'>At Electric Shop, we are dedicated to providing top-quality repairing services to our valued customers. 
    We understand that your devices and equipment are crucial for your personal and professional needs, and we 
    are here to ensure they are restored to their optimal functionality. Our skilled technicians are well-equipped
     to handle various types of repairs, offering a convenient and reliable solution for your repair needs.</p>

</div>

     <h3 style='color:brown;text-align:center;'> <ins> Send Repair Request</ins></h3>

<div class="signup_div " width='100%'>

<div class="proceed-pay" style="margin-left:8%">

<div class="order">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >
<label for='product'>Product Name:</label>
<input class="sgn-input"  type="text" id='product' name='product' style='height:30px' required>
<br>
<label for='product_catag'>Category:</label>
<select name="product_catag" id="product_catag" required>
    <option value="">Select</option>
    <option value="100">Mouse</option>
    <option value="150">Keyboard</option>
    <option value="300">Mobile</option>
    <option value="500">Laptop</option>
</select>
<br>
<label for='damage_type'>Damage Type:</label>
<select name="damage_type" id="damage_type" required>
    <option value="">Select</option>
    <option value="40">Water Damage</option>
    <option value="60">Power Surges</option>
    <option value="80">Physical Damage</option>
    <option value="20">Software Corruption</option>
    <option value="30">virus and malware damage</option>
</select>
<br>
<label>Please provide the uuid of product that <br> you have bought to get discount on repairing </label>
<label for='uuid'>Your Product UUID:</label>
<input class="sgn-input" placeholder='Optional'  id='uuid' name='uuid' style='height:30px'>
<br>
<button class="button" class="sgn-input"  type='submit' name='repair'>Send</button>
</form>

</div>
<?php

if(isset($_POST['repair'])){
    $sql22 ="SELECT * FROM  servicestatus WHERE uuid='{$_POST['uuid']}' && status='pending';";
    $result22 = $conn->query($sql22);
     $row22 = $result22->fetch_assoc();

    $_SESSION['prod'] =$_POST['product'];
        function checkCatag($param) {
            if ($param == '100') {
                return "mouse";
            } elseif ($param == '150') {
                return "keyboard";
            
              } elseif ($param == '300') {
                return "mobile";
            }
               elseif ($param == '500') {
                return "laptop";
            }
            else {
                return "Unknown";
            }
        };
        function checkIssue($param) {
            if ($param == '20') {
                return "software corruption";
            } elseif ($param == '30') {
                return "virus & malware";
            
              } elseif ($param == '40') {
                return "water damage";
            }
               elseif ($param == '60') {
                return "power surges";
            }
               elseif ($param == '80') {
                return "physical damage";
            }
            else {
                return "0";
            }
        };
$_SESSION['catag']= checkCatag($_POST['product_catag']);
$_SESSION['issue']= checkIssue($_POST['damage_type']);
    $_SESSION['uuid']=$_POST['uuid'];
    if($row22){
       $row22['discount']=="50% discount"? $_SESSION['repairadvance'] = ((intval($_POST['product_catag'])*intval($_POST['damage_type']))/100)/2:0;
    }else $_SESSION['repairadvance'] = (intval($_POST['product_catag'])*intval($_POST['damage_type']))/100;
?>
<div class='verticalLine'></div>

<div class="ship">
<?php if(isset($_POST['repair'])){
    ?>
<div class='repair-form'>
<p style='color:red;margin-bottom:2px'>
    <u>Read Carefully Before Proceed</u>
  </p>
  <p style="margin: 0;font-size:12px;">
  As per your selected category and the 
  associated damage type, we kindly request
   an advance payment of  <b>Rs<?php echo $_SESSION['repairadvance']?></b>. This advance 
   payment is essential to initiate the necessary processes
    and services required to address your specific needs promptly and efficiently.
</p>
</div>
<form method='post' action="<?php echo $_SERVER['PHP_SELF']; ?>" style='display:flex;flex-direction:column-reverse;gap:5px'>
<div>
<script
		src="https://checkout.stripe.com/checkout.js" class="stripe-button"
		data-key="<?php echo $publishableKey?>"
		data-amount="<?php echo $_SESSION['repairadvance']?>"
		data-name="Electric-Shop"
		data-description="Your Choice Our Voice"
		data-image="./logo1.png"
		data-currency="usd"
		data-email="<?Php echo $_SESSION['customer_email']?>"
	></script>
    <br>
</div>
<div>
<?php
}
 if(isset($_POST['repair'])){
    $sql ="SELECT * FROM  servicestatus WHERE uuid='{$_POST['uuid']}' && status='pending';";
    $result = $conn->query($sql);
     $row = $result->fetch_assoc();
     if($row && isset($_POST['uuid']))  echo "<span style='color:green;font-size:15px;margin-top:10px'>Congrats:"." ".$row['discount']."&#x1F600</span> <p ><u></u></p>";
     if(!$row && isset($_POST['uuid'])) echo "<span style='color:red;font-size:15px;margin-top:10px'>Buy our product to get offers &#x1F614</span>";

    
 }
 
 ?>
</div>

  <?php
}
?>
</div>

</div>
</div>
</div>




<?php
if(isset($_POST['stripeToken'])){
    //submit repair form
    $today_date =  date("j,n,Y"); 
    $sql="INSERT INTO repair 
                      (user_id,p_name,category,damage_type,uuid,advance_amt,booked_date)
               VALUES ('{$_SESSION['id']}','{$_SESSION['prod']}','{$_SESSION['catag']}','{$_SESSION['issue']}','{$_SESSION['uuid']}',{$_SESSION['repairadvance']},'{$today_date}');";
    $result = $conn->query($sql);
    $conn->close();
    echo "<p style='color:green;font-size:15px;margin-top:10px;text-align:center'>Repairing request has been sent.</p>";
   }

	?>

<?php
   include_once('./includes/footer.php')
?>










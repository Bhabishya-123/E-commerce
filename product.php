<?php    
include_once('./includes/config.php');
include_once('./stripeConfig.php');
session_start();
if (isset($_POST['addToCart'])) { 
  if(isset($_SESSION['id'])){
$sql22 = "INSERT INTO carts (
    pid,
    uid,
    product,
    price,
    quantity
) VALUES(
  {$_SESSION['product_id']},
    {$_SESSION['id']},
    '{$_SESSION['prod-title']}',
    '{$_SESSION['prod-price']}',
    {$_POST['quantity']}
    )";
$conn->query($sql22);
echo "";
echo "<h4 style='text-align:center;position:absolute;top:100px;left:20%;padding:0;border:1px solid black'>Products has been Added to your Cart</h4>";
  }
  else{
    header("Location:login.php?LoginFirst");
    die();
  }
}
include_once('./includes/headerNav.php');
if(isset($_GET['id'])){
$_SESSION['product_id'] = $_GET['id'];
}else{
  $_GET['id'] = $_SESSION['product_id'];
}
$sql11 ="SELECT * FROM  products WHERE product_id='{$_SESSION['product_id']}';";
$result11 = $conn->query($sql11);
$row11 = $result11->fetch_assoc();
$_SESSION['prod-title'] = $row11['product_title'];
$_SESSION['prod-price'] = $row11['product_price'];
// if (($_SERVER['REQUEST_METHOD']==='POST')&& isset($_SESSION['id'])) { 
//   $sql22 = "INSERT INTO carts (
//       pid,
//       uid,
//       product,
//       price,
//       quantity
//   ) VALUES(
//     {$_GET['id']},
//       {$_SESSION['id']},
//       '{$_SESSION['prod-title']}',
//       {$_SESSION['prod-price']},
//       {$_POST['quantity']}
//       )";
//   $conn->query($sql22);
//   }
$conn->close();
?>
<head>
    <style>
        .selected_product{
         
            margin-top:5%;
            display:flex;
            justify-content:center;
        }
        .prod-in{
    position:relative;
    width:60%;
  }
        #image-pr{
            
            height:80%;
            width:50%
        }
        .img-magnifier-container {
         position:absolute;
         top:8%;
         left:2%;
         width:90%;
         height:100%
       }
       .detail-cont-pr{
           position:relative;
           left:49%;
           top:15%;
        width:50%;
        display:flex;
        flex-direction:column;
        align-items:center;
        justify-content:center
        
       }

       .img-magnifier-glass {
        position: absolute;
        left:25%;
        opacity:0.1;
        border-radius: 5%;
        cursor: none;
       /*Set the size of the magnifier glass:*/
        width: 20px;
        height: 20px;
      }
       .img-magnifier-glass:hover {
        opacity:1;
        border-radius: 10%;
        cursor: none;
       /*Set the size of the magnifier glass:*/
        width: 100px;
        height: 100px;
      }
      .price{
        text-align:center;
      }
      .discount{
        text-align:center;
      }
      .description-pr{
        width:100%;
        overflow-y:hidden;
        text-align:center;
        color:grey;
        font-size:medium;
        font-family:cursive;
      }
      .btn-pr{
        display:flex;
        gap:4px
      }

      .button {
     border: none;
     color: white;
     padding: 16px;
     text-align: center;
     text-decoration: none;
     font-size: 16px;
     margin: 1px;
     transition-duration: 0.4s;
     cursor: pointer;
     box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
    }
    .button:hover{
          transform:scale(1.1,1.1);
    }
    .btn2{
      background-color: #E74C3C;
    }
    .btn2:active{
      padding:10px;
    }
    .btn1{
      background-color:#40E0D0;
    }
   .quantityDiv{
    display:flex;
        align-items:center;
        justify-content:center;
        gap:6px;
        margin-bottom:20px
   }
   .section-title{
    margin:0;
    padding:0;
    font-size:14px
   }
   .addSub{
    height:30px;
    width:30px;
    background:grey;
    display:flex;
        align-items:center;
        justify-content:center;
        cursor:pointer;
        background:#C0C0C0;
        font-size:24px;

   }
   .addSub:hover{
    background:#DCDCDC
   }

      /*responsive for ipad iphone and other */
   @media (max-width: 700px) {

 .prod-in{
    width:100%;
  }

  }
    </style>
    
    <script>
 //jquery script for image magnifier

function magnify(imgID, zoom) {
  var img, glass, w, h, bw;
  img = document.getElementById(imgID);
  /*create magnifier glass:*/
  glass = document.createElement("DIV");
  glass.setAttribute("class", "img-magnifier-glass");
  /*insert magnifier glass:*/
  img.parentElement.insertBefore(glass, img);
  /*set background properties for the magnifier glass:*/
  glass.style.backgroundImage = "url('" + img.src + "')";
  glass.style.backgroundRepeat = "no-repeat";
  glass.style.backgroundSize = (img.width * zoom) + "px " + (img.height * zoom) + "px";
  bw = 3;
  w = glass.offsetWidth / 2;
  h = glass.offsetHeight / 2;
  /*execute a function when someone moves the magnifier glass over the image:*/
  glass.addEventListener("mousemove", moveMagnifier);
  img.addEventListener("mousemove", moveMagnifier);
  /*and also for touch screens:*/
  glass.addEventListener("touchmove", moveMagnifier);
  img.addEventListener("touchmove", moveMagnifier);
  function moveMagnifier(e) {
    var pos, x, y;
    /*prevent any other actions that may occur when moving over the image*/
    e.preventDefault();
    /*get the cursor's x and y positions:*/
    pos = getCursorPos(e);
    x = pos.x;
    y = pos.y;
    /*prevent the magnifier glass from being positioned outside the image:*/
    if (x > img.width - (w / zoom)) {x = img.width - (w / zoom);}
    if (x < w / zoom) {x = w / zoom;}
    if (y > img.height - (h / zoom)) {y = img.height - (h / zoom);}
    if (y < h / zoom) {y = h / zoom;}
    /*set the position of the magnifier glass:*/
    glass.style.left = (x - w) + "px";
    glass.style.top = (y - h) + "px";
    /*display what the magnifier glass "sees":*/
    glass.style.backgroundPosition = "-" + ((x * zoom) - w + bw) + "px -" + ((y * zoom) - h + bw) + "px";
  }
  function getCursorPos(e) {
    var a, x = 0, y = 0;
    e = e || window.event;
    /*get the x and y positions of the image:*/
    a = img.getBoundingClientRect();
    /*calculate the cursor's x and y coordinates, relative to the image:*/
    x = e.pageX - a.left;
    y = e.pageY - a.top;
    /*consider any page scrolling:*/
    x = x - window.pageXOffset;
    y = y - window.pageYOffset;
    return {x : x, y : y};
  }
}
</script>
</head>
<body>
  


<div class="selected_product">
  <div class="prod-in">
  <div class="img-magnifier-container">
<img id='image-pr' src="admin/upload/<?php echo $row11['product_img'] ?>"  alt="product-img">
</div>

	<div class="detail-cont-pr">
	<h5 class="title"><?php echo $row11['product_title'] ?> <p class="date"><?php echo $row11['product_date'] ?></p> </h5>
	<p class="description-pr"><?php echo $row11['product_desc'] ?> 
	<p class="price"><b>Rs.<?php echo $row11['product_price'] ?></b><br><span class="discount"><strike>5000</strike> -8%</span></p>
  
  <form action="<?php echo $_SERVER['PHP_SELF']; ?> " method="post">
  <div class="quantityDiv">
    <h6 class="section-title">Quantity</h6>
    <span class='addSub'  onclick="decQuantity()">-</span>
    <input id='quantity' name='quantity' style="margin:0;padding:0;width:50px;border:none;height:30px;text-align:center" type="text" step="1" min="1" max="5" value='1'  autocomplete="off"><span class='addSub' onclick="incQuantity()" >+</span>
</div>
<div class="btn-pr">
<a href="payment.php?id=<?php echo $_GET['id']?>" style='text-decoration:none'><p class="button btn1">Purchase</p></a>

<?php if(isset($_SESSION['id'])){
  echo "<Button type='submit' name='addToCart'  class='button btn2' onclick='addToCart()'>Add To Cart</Button>";
}else{
  echo " <button type='submit' class='button btn2' > <a href='./signup.php?loginOrSignupFirst' style='text-decoration:none;color:white'> Add To Cart</a></button>  ";
}?>

  </div>
</form>
  </div>
  </div>
</div>

</body>
<script>
/* Initiate Magnify Function
with the id of the image, and the strength of the magnifier glass:*/
magnify("image-pr", 3);
</script>

<script src="./js/addToCart.js"></script>




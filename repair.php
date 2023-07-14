<?php    
include_once('./includes/headerNav.php'); 
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
            color:black
        }
   
        .desc{
font-size:14px        }
.proceed-pay{
    width:80%;
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
               color:lime;
               flex-basis:40%;
           }
           .order{
               margin-left:5%;
               color:violet;
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
</head>
<div class='outerDiv'>

<div class='innerDiv'>
<h3 class='head1'><u> Welcome to repairing service page</u></h3>
<p class='desc'>At Electric Shop, we are dedicated to providing top-quality repairing services to our valued customers. 
    We understand that your devices and equipment are crucial for your personal and professional needs, and we 
    are here to ensure they are restored to their optimal functionality. Our skilled technicians are well-equipped
     to handle various types of repairs, offering a convenient and reliable solution for your repair needs.</p>
</div>

<div class="proceed-pay">

<div class="ship">
<h4>Contact</h4>
<p>You can kindly contact us on :</p>
<label>Number:- 9823452343</label>
<label>Email: electricshop@gmail.com</label>
<label>Location: Sano Thimi, Bhaktapur Kathmandu</label>

</div>

<div class='verticalLine'></div>

<div class="order">
<h4>check offers</h4>
<p style='width:80%'>Please provide the uuid of product that you have bought to check offers on repairing products</p>


<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<label for='uuid'>your product uuid:</label>
<input type="text" id='uuid' name='uuid' style='height:25px' required>
<br>
<button class="button" type='submit' name='submit'>Check</button>
</form>


</div>

</div>



<?php
 if(isset($_POST['submit'])){
    $sql ="SELECT * FROM  servicestatus WHERE uuid='{$_POST['uuid']}' && status='pending';";
    $result = $conn->query($sql);
     $row = $result->fetch_assoc();
     if($row)  echo "<span style='color:green;font-size:15px;margin-top:4px'>Congratulation you got"." ".$row['discount']."&#x1F600 </span> <p ><u><a href='#commingsoon' style='color:blue'>click here to confirm</a></u></p>";
     if(!$row) echo "<span style='color:red;font-size:15px;margin-top:4px'>Sorry....You are not eligible for any offers! &#x1F614</span>";

    
 }
 
 ?>
 </div>

<?php
   include_once('./includes/footer.php')
?>
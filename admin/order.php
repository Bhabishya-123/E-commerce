
<?php 
    include_once('./includes/headerNav.php');
    include_once('./includes/restriction.php');
    if(!(isset($_SESSION['logged-in']))){
      header("Location:login.php?unauthorizedAccess");
    }
    if(isset($_POST['update'])){
     //below sql will update user details inside sql table when update is clicked
     include "includes/config.php";
     $sql = "UPDATE soldproducts 
              SET  status='{$_POST['status']}'
              WHERE uid={$_POST['uid']} AND pid={$_POST['pid']} AND quantity={$_POST['quantity']} 
              ";
     $conn->query($sql);   
     $conn->close();
     header("Location:http://localhost/electronics_shop/admin/order.php?statusUpdatedSuccessfully");
    }
 
 ?>

<h4>Ordered Items</h4>
<br>

<?php
  include "includes/config.php";
     
        /* define how much data to show in a page from database*/
        $limit = 4;
        if(isset($_GET['page'])){
          $page = $_GET['page'];
          switch($page){
            case 1: $sn = 0; break;
            case 2: $sn = 4;break;
            case 3: $sn = 8; break;
            case 4: $sn = 12; break;
            case 5: $sn = 16; break;
            case 6: $sn = 20; break;
          }
        }else{
          $page = 1;
          switch($page){
            case 1: $sn = 0; break;
            case 2: $sn = 4;break;
            case 3: $sn = 8; break;
            case 4: $sn = 12; break;
            case 5: $sn = 16; break;
            case 6: $sn = 20; break;
          }
        }
        //define from which row to start extracting data from database
        $offset = ($page - 1) * $limit;

$sql = "SELECT * FROM soldproducts  LIMIT {$offset},{$limit}";
$result = $conn->query($sql);
if ($result->num_rows > 0) { ?>
    
    <div class="table-cont">
    <table>
    <tr>
    <th class="short">S.N</th>
    <th class="large">User_id</th>
    <th class="medium">Product_id</th>
    <th class="medium">Quantity</th>
    <th class="medium">Price</th>
    <th class="medium">Date</th>
    <th class="medium">Status</th>
    </tr>
<?php 
// output data of each row
while($row = $result->fetch_assoc()) {
    $sn = $sn+1;
?>
<tr>
    <td><?php echo $sn ?></td>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
    <td><input type="text" name='uid' value='<?php echo $row["uid"] ?>' readonly style='outline:none;border:none;width:100%;background:none;text-align:center'></td>
    <td><input type="text" name='pid' value='<?php echo $row["pid"] ?>' readonly style='outline:none;border:none;width:100%;background:none;text-align:center'></td>
    <td><input type="text" name='quantity' value='<?php echo $row["quantity"] ?>' readonly style='outline:none;border:none;width:100%;background:none;text-align:center'></td>
    <td><?php echo $row["price"] ?></td>
    <td><?php echo $row["date"] ?></td>
    <td>
    <div class="update">
    <select id="status_update" name="status">
  <?php 
       if($row['status']=='pending'){
           ?>
            <option value="pending" selected>Pending</option>
            <option value="delivered">Delivered</option>
     <?php  } else{?> 
                       <option value="pending">Pending</option>
            <option value="delivered" selected>Delivered</option>
            <?php } ?>
</select>
<input class="update-btn" type="submit" value='Update' name="update" style='margin-top:4px'></input>
</form>
 </div>
    </td>
</tr>

<?php }}else { echo "0 results"; }
             $conn->close(); 
             ?>

</table>
</div>

<!--Pagination-->
<?php
                include "includes/config.php"; 
               // Pagination btn using php with active effects 

                $sql1 = "SELECT * FROM soldproducts";
                $result1 = mysqli_query($conn, $sql1) or die("Query Failed.");

                if(mysqli_num_rows($result1) > 0){

                  $total_products = mysqli_num_rows($result1);
                  $total_page = ceil($total_products / $limit);

                  echo "<div class='pagination'>";
          
                  for($i=1; $i<=$total_page; $i++){

                    //important this is for active effects that denote in which page you are in current position
                    if($page==$i){
                      $active = "active";
                    }else{
                      $active = "";
                    }

                        echo "<a href='sold.php?page={$i}' class='{$active}'>".$i."</a>";
                  }
            
                }
                echo "</div>";
                  ?>
<br>

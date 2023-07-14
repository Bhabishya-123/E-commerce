<?php 
    include_once('./includes/headerNav.php');
    include_once('./includes/restriction.php');
    if(!(isset($_SESSION['logged-in']))){
      header("Location:login.php?unauthorizedAccess");
    }
 ?>

<h4>All Products</h4>
<h5 style="position:absolute;top:12%; right:5%;"><a href="add-post.php">Add Product</a></h5>

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
                  $offset = ($page - 1) * $limit; //remember offset formula this is why we need page var here

                  if($_SESSION["customer_role"] == 'admin'){
                    /* select query of post table for admin user */
                    //this will fetch product data in descending order with applied limitation per page
                    $sql = "SELECT * FROM products
                            ORDER BY products.product_id DESC LIMIT {$offset},{$limit}";

                  }elseif($_SESSION["user_role"] == 'normal'){
                    /* select query of post table for normal user */
                    $sql = "SELECT * FROM products WHERE product_author='{$_SESSION['customer_name']}'
                            ORDER BY products.product_id DESC LIMIT {$offset},{$limit}";
                  }

                  $result = $conn->query($sql) or die("Query Failed.");
                  //means if no of rows found on the basis of query is >0 then goes inside if
                  if ($result->num_rows > 0) {
                ?>

<div class="table-cont">
<table>
    <!-- tablehead html -->
<thead>
        <th class="short">S.N</th>
        <th class="large">Title</th>
        <th class="medium">Catagory</th>
        <th class="medium">Date</th>
        <th class="medium">Author</th>
        <th class="short">Edit</th>
        <th class="short">Delete</th>
</thead>
 <!-- tablehead html end -->

 <!-- tabledata body html -->
<tbody>
     <!-- data row1 -->
     <?php
// output data of each row
while($row = $result->fetch_assoc()) { //this will run for every row at a time and run until row finished
  $sn = $sn+1;
?>
<tr>
    <td><?php echo $sn?></td>
    <td><?php echo $row["product_title"] ?></td>
    <td><?php echo $row["product_catag"] ?></td>
    <td><?php echo $row["product_date"] ?></td>
    <td><?php echo  $row["product_author"] ?></td>
    <td><a class="fn_link" href="update-post.php?id=<?php echo $row["product_id"] ?>"><i class='fa fa-edit'></i></a></td>
    <td><a class="fn_link" href="remove-post.php?id=<?php echo $row["product_id"] ?>"><i class='fa fa-trash'></i></a></td>
</tr>

<?php }}else { echo "0 results"; }
             $conn->close(); 
             ?>
</tbody>
<!-- tabledata body end -->

</table>
</div>

<!--Pagination-->
<?php
                include "includes/config.php"; 
               // Pagination btn using php with active effects 

                $sql1 = "SELECT * FROM products";
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

                        echo "<a href='post.php?page={$i}' class='{$active}'>".$i."</a>";
                  }
            
                }
                echo "</div>";
                  ?>


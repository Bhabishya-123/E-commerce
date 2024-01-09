
<?php 
    include_once('./includes/headerNav.php');
    include_once('./includes/restriction.php');
    if(!(isset($_SESSION['logged-in']))){
      header("Location:login.php?unauthorizedAccess");
    }
 ?>

<h4>Repair Request</h4>
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

$sql = "SELECT * FROM repair LIMIT {$offset},{$limit}";
$result = $conn->query($sql);
if ($result->num_rows > 0) { ?>
    
    <div class="table-cont">
    <table>
    <tr>
    <th class="short">S.N</th>
    <th class="large">User_Id</th>
    <th class="medium">Product</th>
    <th class="medium">Category</th>
    <th class="medium">Damage_Type</th>
    <th class="medium">UUID</th>
    <th class="short">Advance_Amt</th>
    <th class="short">Booked_date</th>
    <th class="short">Return_date</th>
    <th class="short">Due</th>
    <th class="short">Status</th>
    <th class="short">Edit</th>


    </tr>
<?php 
// output data of each row
while($row = $result->fetch_assoc()) {
    $sn = $sn+1;
?>
<tr>
    <td><?php echo $sn ?></td>
    <td><?php echo $row["user_id"] ?></td>
    <td><?php echo $row["p_name"] ?></td>
    <td><?php echo $row["category"] ?></td>
    <td><?php echo $row["damage_type"] ?></td>
    <td><?php echo $row["uuid"] ?></td>
    <td><?php echo $row["advance_amt"] ?></td>
    <td><?php echo $row["booked_date"] ?></td>
    <td><?php echo $row["return_date"] ?></td>
    <td><?php echo $row["due"] ?></td>
    <td><?php echo $row["status"] ?></td>
    <td><a class="fn_link" href="update-repair.php?id=<?php echo $row["user_id"] ?>&dt=<?php echo $row["damage_type"] ?>"><i class='fa fa-edit'></i></a></td>
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

                $sql1 = "SELECT * FROM repair";
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

                        echo "<a href='repair.php?page={$i}' class='{$active}'>".$i."</a>";
                  }
            
                }
                echo "</div>";
                  ?>
<br>

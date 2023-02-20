<?php 
    include_once('./includes/headerNav.php');
    include_once('./includes/restriction.php');
    if(!(isset($_SESSION['logged-in']))){
        header("Location:login.php?unauthorizedAccess");
      }
 ?>
<h5>welcome to catagory</h5>
<br>


<div class="table-cont">
    <table>
    <tr>
    <th class="short">S.N</th>
    <th class="large">Catogory</th>
    <th class="short">No. of post</th>

    </tr>

<?php
  include "includes/config.php";

$catagory_list = ['mobile','laptop','mouse','keyboard'];

for($i=0; $i<sizeof($catagory_list); $i++){
    $sn = $i+1;
    $catagory = $catagory_list[$i];
    $sql = "SELECT * FROM products WHERE product_catag= '{$catagory}' ";
    $result = $conn->query($sql);
    $total_post = $result->num_rows;
    
// output data of each row
while($row = $result->fetch_assoc()) {
?>
<tr>
    <td><?php echo $sn ?></td>
    <td><?php echo $row["product_catag"] ?></td>
    <td><?php echo $total_post?></td>

</tr>
   <?php break; ?>
<?php } }//loop end 
?>


</table>
</div>
<br>


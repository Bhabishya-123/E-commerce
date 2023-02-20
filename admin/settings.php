<?php 
    include_once('./includes/headerNav.php');
    include_once('./includes/restriction.php');
    if(!(isset($_SESSION['logged-in']))){
        header("Location:login.php?unauthorizedAccess");
      }
 ?>
<head>
    <style>
        .settings{
            text-align:center;
             height:62%;
             width: 60%;
             background-color:#CCCCFF;
             box-shadow:2px 2px 3px 2px aliceblue;
             position:absolute;
             top:25%;
             left:20%;
         }

    </style>
</head>

<h4>website settings</h4>

<div class="settings">
<br>

             <?php
                  include "includes/config.php";

                  $sql = "SELECT * FROM settings";

                  $result = mysqli_query($conn, $sql) or die("Query Failed.");
                  if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)) {
                ?>
 <!-- Form -->
 <form  action="save-settings.php" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="website_name">Website Name</label>
                          <input type="text" name="website_name" value="<?php echo $row['website_name']; ?>" class="form-control" autocomplete="off" required>
                      </div> <br>
                      <div class="form-group">
                          <label for="logo">Website Logo</label>
                          <input type="file" name="logo"> <br>
                          <img style="margin-top:5px;" src="upload/<?php echo $row['website_logo']; ?>">
                          <input type="hidden" name="old_logo" value="<?php echo $row['website_logo']; ?>" >
                      </div> <br>
                      <div class="form-group">
                          <label for="footer_desc">Footer Description</label>
                          <textarea name="footer_desc" class="form-control" rows="5" required ><?php echo $row['website_footer']; ?></textarea>
                      </div>
                      <br>
                      <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                  </form>
                  <!--/Form -->
                  <?php
                      }
                    }
                  ?>
</div>


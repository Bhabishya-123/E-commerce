<?php 
    include_once('./includes/headerNav.php');
    include_once('./includes/restriction.php');
    if(!(isset($_SESSION['logged-in']))){
        header("Location:login.php?unauthorizedAccess");
      }
 ?>
 <head>
     <style>
         .addpost{
             width:40%;
             height:74%;
             position:absolute;
             top:16%;
             left:29%;
             background-color:#9FE2BF;
             box-shadow:2px 2px 3px 2px grey;
             font-size:20px;
             font-weight:bold;
             text-align:center;
         }

     </style>
 </head>

 <h5>Add post here</h5>
 <div class="addpost">
  <!-- Form -->
  <form  action="save-post.php" method="POST" enctype="multipart/form-data">
                     
                         <div><label for="post_title">Title</label></div> 
                          <input style="width:96%;" type="text" name="prod-title" autocomplete="off" required> <br>
                    
                     
                          <label for="description"> Description</label>
                          <textarea style="width:80%;" name="prod-desc"  required></textarea> 
                    
                     
                         <div> <label for="catagory">Category</label></div>
                          <select name="prod-category" value="">
                            <option value="all" selected>All</option>
                            <option value="laptop">Laptop</option>
                            <option value="mobile">Mobile</option>
                            <option value="keyboard">Keyboard</option>
                            <option value="mouse">Mouse</option>
                            <option value="watch">watch</option>
                          </select> <br> 
                          <div> <label for="product-price">Price per unit</label></div>
                          <input style="width:40%;" type="number" name="prod-price"  value="" required />
                          <br>
                          <div> <label for="no.ofitems">No.of items</label></div>
                          <input style="width:30%;" type="number" name="noofitem"  value="" required />
                          <br>
                         <div> <label style="margin-top:8px;" for="image-post">Post image</label></div>
                          <input type="file" name="prod-img" required>
                       <br><br>
                      <input style="width:20%;" type="submit" name="submit" class="btn btn-primary" value="Save" required />
                  </form>
                  <!--/Form -->
 </div>





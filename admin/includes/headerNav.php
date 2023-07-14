
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Panel</title>
    <link rel="stylesheet" href="../css/style.php">
    <!--Bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--Bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!--fontawesome link--> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<nav class=" navbar-expand-lg navbar-light" style="background:skyblue ">
  <div class="container-fluid" >
   <span style="color:white;font-weight:bolder;text-decoration:underline;">Go-To</span> <a class="navbar-brand" href="../index.php"> <span style="color:orange;font-weight:bold;text-decoration:underline">Electric</span><span  style="color:violet; font-weight:bold;text-decoration:underline">-shop</span></a><span style="color:dark;font-weight:bold;text-decoration:underline; text-align:center;margin-left:36%" ><a href="post.php">Admin Panel</a></span>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown" >
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="post.php" id="">Post</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="catagory.php" >Catagory</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="users.php">Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="sold.php">Sold</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="repair.php">Repair</a>
        </li>
        <li class="nav-item ">
          <a  class="nav-link" href="settings.php"> Settings </a>
        </li>
      </ul>
      <button class="btn-info" style="border:none; background:wheat"> <a href="logout.php?" style="text-decoration:none" >Logout</a> </button>
    </div>
  </div>
</nav>
</body>
</html>
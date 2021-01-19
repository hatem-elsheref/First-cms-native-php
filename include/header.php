<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    include('functions.php');
    ?>
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

    <link rel="stylesheet" type="text/css"  href="css/normalize.css">
	<link rel="stylesheet" type="text/css"  href="css/bootstrap.min.css">
     <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
	<link rel="stylesheet" type="text/css"  href="css/style.css">
	<script type="text/javascript" src="jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
   <script type="text/javascript" src="js/custom.js"></script>
    
  <title>website</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/modern-business.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top ">
    <div class="container">
      <a class="navbar-brand" href="index.php" style="color:#FFC107;"><img src="img/logo1.png"style="width:20px;height:20px;"> Hatem</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
             <li class="nav-item">
            <a class="nav-link active" href="index.php">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Categories
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
                <?php
                connect();
                $query="select cat_name from category";
                $result=mysqli_query($con,$query);
                while($data=mysqli_fetch_assoc($result)):?>
<a class="dropdown-item" href="posts-results.php?category=<?php echo $data['cat_name']; ?>"><?php echo $data['cat_name'];?></a>
                <?php endwhile; ?>
            </div>
          </li>
            <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             Settings
            </a>
              <?php
              if(isset($_SESSION['id']) ){
                  if($_SESSION['role']=="admin"){
                      echo '
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
            <a class="dropdown-item" href="admin-cp/index.php"> <i class=" fa fa-dashboard"></i> Dashboard</a>
            <a class="dropdown-item" href="createpost.php"><i class="fa fa-pencil"></i> Create Post</a>
            <a class="dropdown-item" href="my-posts.php"><i class="fa fa-edit"></i> My Post</a>
              <a class="dropdown-item" href="profile.php"><i class="fa fa-power-off"></i> My Account</a>
              <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out"></i> Log out</a>
            </div>';
                  }
                  elseif($_SESSION['role']=="writer"){
                      echo '
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
            <a class="dropdown-item" href="createpost.php"><i class="fa fa-pencil"></i> Create Post</a>
            <a class="dropdown-item" href="my-posts.php"><i class="fa fa-edit"></i> My Post</a>
              <a class="dropdown-item" href="profile.php"><i class="fa fa-power-off"></i> My Account</a>
              <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out"></i> Log out</a>
            </div>';
                  }else{
                      echo '
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
            <a class="dropdown-item" href="profile.php"><i class="fa fa-power-off"></i> My Account</a>
             <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out"></i> Log out</a>
            </div>';
                  }}
              else{
                  echo '
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
              <a class="dropdown-item" href="register.php"><i class="fa fa-user-plus"></i> Register</a>
              <a class="dropdown-item" href="login.php"><i class="fa fa-sign-in"></i> Log in</a>
            </div>';
                  }
              ?>
          </li>
             <?php
                    if(isset($_SESSION['id']))
                        echo '
            <li class="nav-item">
               <i class=" nav-link " style="color:#FFC107;"><i class="fa fa-home"></i> welcome '.$_SESSION['username'].'</i>
          </li>';
            ?>
        </ul>
      </div>
    </div>
  </nav>
    
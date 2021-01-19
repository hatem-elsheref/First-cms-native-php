<?php
include('include/header.php');
?>
<div class="container">
    
    
    
<?php
if((isset($_GET['q']) and ! empty($_GET['q'])) and !isset($_GET['category'])):?>
<?php
    $request=$_GET['q'];
    $con=connect();
    $query="select * from post where post_title like '%".$request."%' or description like '%".$request."%' or post_date like '%".$request."%'";
    $result=mysqli_query($con,$query);
    if(mysqli_num_rows($result)>0):?>
    <h1 class="mt-4 mb-3">Search At
      <small><?php echo $request;?></small>
    </h1>

    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="index.php">Home</a>
      </li>
      <li class="breadcrumb-item active"><?php echo $request;?></li>
    </ol>
<div class="row">
    <!-- Blog Post -->
      <div class="col-md-8">
    <?php while($row=mysqli_fetch_assoc($result)):?>
    
    <div class="card mb-4">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-6">
            <a href="#">
 <img class="img-fluid rounded" src="<?php echo $row['img'];?>" style="width:700px;height:220px;" alt="">
            </a>
          </div>
          <div class="col-lg-6">
            <h2 class="card-title"><?php echo $row['post_title'];?></h2>
            <p class="card-text"><?php echo $row['description'];?></p>
            <a href="more.php?id=<?php echo $row['post_id']; ?>" class="btn btn-primary">Read More &rarr;</a>
          </div>
        </div>
      </div>
      <div class="card-footer text-muted">
          <?php
          $writer=null;
           $query2="select * from user where id=".$row['post_author'];
           $result2=mysqli_query($con,$query2);
            $row2=mysqli_fetch_assoc($result2);
          $writer= $row2['user_name'];
          ?>
        Posted on <?php echo $row['post_date'];?> by <?php echo $writer;?>
      </div>
    </div>
    <?php  endwhile;?>
          </div>
    <?php
      endif;
    if(mysqli_num_rows($result)==0):?>
    <div class="row">
           <div class="col-md-8">
         <div class="card my-4">
          <h5 class="card-header">no results founded!</h5>
          <div class="card-body">
           try to search with specific words
          </div>
        </div>
     </div>
    <?php endif;
    endif;
    ?>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <?php
if((isset($_GET['category']) and ! empty($_GET['category'])) and !isset($_GET['q'])):?>
<?php
    $request=$_GET['category'];
    $con=connect();
    $query="select * from post where post_cat like '%".$request."%'";
    $result=mysqli_query($con,$query);
    if(mysqli_num_rows($result)>0):?>
    <h1 class="mt-4 mb-3">Search At
      <small><?php echo $request;?></small>
    </h1>

    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="index.php">Home</a>
      </li>
      <li class="breadcrumb-item active"><?php echo $request;?></li>
    </ol>
<div class="row">
    <!-- Blog Post -->
      <div class="col-md-8">
    <?php while($row=mysqli_fetch_assoc($result)):?>
    
    <div class="card mb-4">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-6">
            <a href="#">
   <img class="img-fluid rounded" src="<?php echo $row['img'];?>" style="width:700px;height:220px;" alt="">
            </a>
          </div>
          <div class="col-lg-6">
            <h2 class="card-title"><?php echo $row['post_title'];?></h2>
            <p class="card-text"><?php echo $row['description'];?></p>
            <a href="more.php?id=<?php echo $row['post_id']; ?>" class="btn btn-primary">Read More &rarr;</a>
          </div>
        </div>
      </div>
      <div class="card-footer text-muted">
          <?php
          $writer=null;
           $query2="select * from user where id=".$row['post_author'];
           $result2=mysqli_query($con,$query2);
            $row2=mysqli_fetch_assoc($result2);
          $writer= $row2['user_name'];
          ?>
        Posted on <?php echo $row['post_date'];?> by <?php echo $writer;?>
      </div>
    </div>
    <?php  endwhile;?>
          </div>
    <?php
    endif;
    if(mysqli_num_rows($result)==0):?>
    <div class="row">
           <div class="col-md-8">
         <div class="card my-4">
          <h5 class="card-header">no results founded!</h5>
          <div class="card-body">
           try to search with specific words
          </div>
        </div>
        </div>
    <?php endif;
    endif;?>
        
        
        
        
        
        
<?php
if((isset($_GET['q']) and ! empty($_GET['q'])) and (isset($_GET['category'])  and ! empty($_GET['category']))):?>
<?php
    $request=$_GET['q'];
    $con=connect();
    $query="select * from post where post_title like '%".$request."%' or description like '%".$request."%' or post_cat='".$_GET['category']."'";
    $result=mysqli_query($con,$query);
    if(mysqli_num_rows($result)>0):?>
    <h1 class="mt-4 mb-3">Search At
      <small><?php echo $request;?> and <?php echo $_GET['category'];?></small>
    </h1>

    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="index.php">Home</a>
      </li>
      <li class="breadcrumb-item active"><?php echo $request;?></li>
    </ol>
<div class="row">
    <!-- Blog Post -->
      <div class="col-md-8">
    <?php while($row=mysqli_fetch_assoc($result)):?>
    
    <div class="card mb-4">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-6">
            <a href="#">
 <img class="img-fluid rounded" src="<?php echo $row['img'];?>" style="width:700px;height:220px;" alt="">
            </a>
          </div>
          <div class="col-lg-6">
            <h2 class="card-title"><?php echo $row['post_title'];?></h2>
            <p class="card-text"><?php echo $row['description'];?></p>
            <a href="more.php?id=<?php echo $row['post_id']; ?>" class="btn btn-primary">Read More &rarr;</a>
          </div>
        </div>
      </div>
      <div class="card-footer text-muted">
          <?php
          $writer=null;
           $query2="select * from user where id=".$row['post_author'];
           $result2=mysqli_query($con,$query2);
            $row2=mysqli_fetch_assoc($result2);
          $writer= $row2['user_name'];
          ?>
        Posted on <?php echo $row['post_date'];?> by <?php echo $writer;?>
      </div>
    </div>
    <?php  endwhile;?>
          </div>
    <?php
      endif;
    if(mysqli_num_rows($result)==0):?>
    <div class="row">
           <div class="col-md-8">
         <div class="card my-4">
          <h5 class="card-header">no results founded!</h5>
          <div class="card-body">
           try to search with specific words
          </div>
        </div>
     </div>
    <?php endif;
    endif;
    ?>

        
        
        
        
        
        
        
        
        
        
        
<?php 
 if((!isset($_GET['q']) or empty($_GET['q']) ) and (!isset($_GET['category']) or empty($_GET['category']) )): ?>
 <div class="row">
   <div class="col-md-8">
         <div class="card my-4">
          <h5 class="card-header">no value entered to search</h5>
          <div class="card-body">
           try , to enter some chars to search
          </div>
             <a href="index.php" class="btn btn-primary">Go Back To search</a>
        </div>
     </div>
     <?php
    endif;?>
    <?php
    include('include/advertisement.php'); ?>
 </div>
  
    </div>
  <!-- /.container -->

  <!-- Footer -->
<?php
include('include/footer.php');
?>
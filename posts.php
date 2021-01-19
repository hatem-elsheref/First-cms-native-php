<?php
include('include/header.php');
?>
<div class="container">
    <?php if(isset($_GET['id']) and !empty($_GET['id'])){
    $con=connect();
    $posts=null;
    $writer=null;
    if(mysqli_num_rows($result)>0){
        $retrive="select * from post where post_author=".$_GET['id'];
        $posts=mysqli_query($con,$retrive);}
        if(mysqli_num_rows($posts)>0): ?>
               <h1 class="mt-4 mb-3">Posts by
    <?php
    $query="select * from user where id=".$_GET['id'];
    $data=mysqli_query($con,$query);  
    $row=mysqli_fetch_assoc($data);
    $writer=$row['user_name'];
                   ?>
      <small><?php echo $writer; ?></small>
    </h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="index.php">Home</a>
      </li>
      <li class="breadcrumb-item active">posts of <?php echo $writer; ?></li>
    </ol>
    <div class="row">
        <div class="col-md-8">
            <?php
    while($row=mysqli_fetch_assoc($posts)):?>
      
        <div class="card mb-4">
          <img class="card-img-top" src="<?php echo $row['img']; ?>" style="width:700px;height:300px;" alt="Card image cap">
          <div class="card-body">
            <h2 class="card-title"><?php echo $row['post_title']; ?></h2>
            <p class="card-text"><?php echo $row['description']; ?></p>
           <a href="more.php?id=<?php echo $row['post_id']; ?>" class="btn btn-primary">Read More &rarr;</a>
          </div>
          <div class="card-footer text-muted">
            Posted on <?php echo $row['post_date']; ?> by
            <?php echo $writer; ?>
          </div>
        </div>
<?php endwhile;?> 
      </div>
        <?php endif;?>
        <?php
      if(mysqli_num_rows($posts)==0): ?>
        <div class="row">
     <div class="col-md-8">
         <div class="card my-4">
          <h5 class="card-header">no results founded!</h5>
          <div class="card-body">
           try to search with specific words
          </div>
        </div>
        </div>
 <?php endif;?>
          <?php
        }
          else{
          header('location:404.html');
          }
?>


    <?php
        
    include('include/advertisement.php');

    ?>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
<?php
include('include/footer.php');
?>

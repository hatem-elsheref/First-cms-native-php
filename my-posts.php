<?php
include('include/header.php');
?>
<div class="container">
    <?php 
    function editPost($postid){
        
        header('location:editpost.php?id='.$postid);
        
    }
    function removePost($postid){
        $con=connect();
        $query="delete from post where post_id=".$postid;
        mysqli_query($con,$query);   
    }
    
    if(isset($_GET['postid']) and !empty($_GET['postid'])){
        if(isset($_GET['action']) and !empty($_GET['action'])){
        if($_GET['action']==1){
            editPost($_GET['postid']);
        }
        elseif($_GET['action']==2){
            removePost($_GET['postid']);
        }
    }
    }
    
    if(isset($_SESSION['id'])){
    $con=connect();
    $query="select * from user where id=".$_SESSION['id']." and (role='admin' or role='writer')";
    $result=mysqli_query($con,$query);
    $posts=null;
    if(mysqli_num_rows($result)>0){
        $retrive="select * from post where post_author='".$_SESSION['id']."' and status='posted'";
        $posts=mysqli_query($con,$retrive);}
        if(mysqli_num_rows($posts)>0): ?>
               <h1 class="mt-4 mb-3">Posts by
      <small><?php echo $_SESSION['username']; ?></small>
    </h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="index.php">Home</a>
      </li>
      <li class="breadcrumb-item active">posts of <?php echo $_SESSION['username']; ?></li>
    </ol>
    <div class="row">
        <div class="col-md-8">
    <?php endif;?>
            <?php
    while($row=mysqli_fetch_assoc($posts)):?>
      
        <div class="card mb-4">
          <img class="card-img-top" src="<?php echo $row['img']; ?>" style="width:700px;height:300px;" alt="Card image cap">
          <div class="card-body">
            <h2 class="card-title"><?php echo $row['post_title']; ?></h2>
            <p class="card-text"><?php echo $row['description']; ?></p>
           <a href="more.php?id=<?php echo $row['post_id']; ?>" class="btn btn-primary">Read More &rarr;</a>
 <a href="<?php echo $_SERVER['PHP_SELF'].'?action=2&postid='.$row['post_id']; ?>" class="btn btn-danger pull-right"><i class="fa fa-trash f-lg"></i> Delete</a>
<a href="<?php echo $_SERVER['PHP_SELF'].'?action=1&postid='.$row['post_id']; ?>" class="btn btn-success pull-right"><i class="fa fa-edit f-lg"></i> Edit</a>

          </div>
          <div class="card-footer text-muted">
            Posted on <?php echo $row['post_date']; ?> by
            <?php echo $_SESSION['username']; ?>
          </div>
        </div>
<?php endwhile;?> 
      </div>
          <?php
       if(mysqli_num_rows($posts)==0):?>
     
        <!-- Side Widget -->
         <div class="row">
         <div class="col-md-8">
        <div class="card my-4" style="text-align:center;">
          <h5 class="card-header" >Oops!!</h5>
          <div class="card-body">
            No Available Posts for you now !
          </div>
            <div class="card-footer text-muted">
                         <a href="createpost.php" class="btn btn-primary">Write Your First Post</a>
                      </div>
        </div>
        </div>
          <?php endif;
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

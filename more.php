<?php
include('include/header.php');
?>
  <!-- Page Content -->


  <div class="container">
      <?php if(!isset($_GET['id'])){
        header('location:404.html');
        }?>
      
      <?php
      if(isset($_GET['id'])){
      $con=connect();
      $query="SELECT * FROM post where post_id=".$_GET['id'];
      $result=mysqli_query($con,$query);
      }
      
      if(mysqli_num_rows($result)>0)
          while($data=mysqli_fetch_assoc($result)):?>
      <h1 class="mt-4 mb-3"><?php echo $data['post_title'];?>
      <small>by
          <?php
                       $query2="select * from user where id=".$data['post_author'];
                       $result2=mysqli_query($con,$query2);
                       $aut="";
                       while($author=mysqli_fetch_assoc($result2)){
                           $aut= $author['user_name'];
                       }
                     
                       ?><?php echo $aut;?>
      </small>
    </h1>

    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="index.php">Home</a>
      </li>
        <li class="breadcrumb-item active"><a href="posts-results.php?category=<?php echo $data['post_cat'];?>"><?php echo $data['post_cat'];?></a></li>
      <li class="breadcrumb-item active"><?php echo $data['post_title'];?></li>
    </ol>

    <div class="row">

      <!-- Post Content Column -->
      <div class="col-lg-8">

        <!-- Preview Image -->
        <img class="img-fluid rounded" src="<?php echo $data['img'];?>" style="width:900px;height:300px;" alt="">

        <hr>

        <!-- Date/Time -->
        <p>Posted on <?php echo $data['post_date'];?>  <a style="color:red;" href="my-posts.php"> by <?php echo $aut;?></a></p>

        <hr>

        <!-- Post Content -->
        <p class="lead"><?php echo $data['post'];?>
          <hr>
          <?php 
          if(isset($_SESSION['role'])){
               include('comment.php');
          }
          ?>
           </div>
      <?php endwhile;?>
          <?php if(mysqli_num_rows($result)==0){
           header('location:404.html');
      }?>
    
    <?php
        
    include('include/advertisement.php');

    ?>

     
      </div>
</div>

  <!-- Footer -->
<?php
include('include/footer.php');
?>
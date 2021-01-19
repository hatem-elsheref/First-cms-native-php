<?php
include('include/header.php');
?>

<?php
if(isset($_POST['post_ok']))
    $intention=prepareForCreatePost();
?>
<?php if(isset($_SESSION['id'])){
    $con=connect();
    $query="select * from user where id=".$_SESSION['id']." and (role='admin' or role='writer')";
    $result=mysqli_query($con,$query);
    if(mysqli_num_rows($result)>0):?>
<script src="js/ckeditor/ckeditor.js"></script>
  <!-- Page Content -->
  <div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3">Posts by
      <small>Author..</small>
    </h1>

    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="index.php">Home</a>
      </li>
      <li class="breadcrumb-item active"><a href="#">Create post</a></li>
    </ol>

    <div class="row">
      <div class="col-md-8">
            <form action="#"  method="post" enctype="multipart/form-data">
  <div class="form-group row">
      <div class="col-sm-12" style="text-align:center;">
       <?php 
       if(isset($_POST['post_ok']))
           if($intention==1){
                echo '<div class="alert alert-success" role="alert">posted successfully wait admin to accept it </div>';
           }else
       echo '<div class="alert alert-danger" role="alert">'.$intention.'</div>'; 
       ?>
  </div>
                </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Post Title</label>
    <div class="col-sm-10">
      <input type="text" name="post_title" class="form-control" id="inputPassword3" placeholder="title">
    </div>
  </div>
  <div class="form-group row">
     <label for="inputEmail3" class="col-sm-2 col-form-label">Post</label>
    <div class="col-sm-10">
<textarea name="post" id="editor1" rows="5" cols="50"></textarea>
        <script> CKEDITOR.replace( 'editor1' );</script>
      </div>
  </div>
    <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Category</label>
    <div class="col-sm-10">
      <select name="post_category" class="custom-select" id="inputGroupSelect01">
        <option selected value="" >Choice Category</option>
          <?php
          $con=connect();
          $query="select cat_name from category";
          $result=mysqli_query($con,$query);
         
          while($data=mysqli_fetch_assoc($result)){
              echo "<option value=".$data['cat_name'].">".$data['cat_name']."</option>";
          }
          ?>
        </select>
    </div>
  </div>
   <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Post Image</label>
    <div class="col-sm-10">
      <input type="file" name="post_image" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
    </div>
  </div>
  <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label"></label>

       <div class="col-sm-10">
      <button type="submit" name="post_ok" class="btn btn-danger">Post</button>
  </div>
                </div>
</form>
      </div>

    <?php
        
    include('include/advertisement.php');

    ?>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->
<?php endif; 
 if(mysqli_num_rows($result)==0){
     header('location:404.html');
 }
}else{
    header('location:404.html');
}

?>
  <!-- Footer -->
<?php
include('include/footer.php');
?>

<?php 

 include('include/header.php'); 

 ?>
<?php

$intention=null;
if(isset($_POST['post_update'])){
  
    $intention=prepareForUpdatePost();
}
?>
<?php
$con=connect();
$query="select * from post where post_id=".$_GET['id'];
$result=mysqli_query($con,$query);
if(mysqli_num_rows($result)==0)
header('location:index.php');
$row=mysqli_fetch_assoc($result);
?>
<script src="js/ckeditor/ckeditor.js"></script>
 <div class="container">
    <div class="row">
      <div class="col-md-8">
          <div class="card my-4">
          <h5 class="card-header">Edit <?php echo $row['post_title'] ?></h5>
          <div class="card-body">
<form action="<?php echo $_SERVER['PHP_SELF'].'?id='.$_GET['id'];?>" method="post" enctype="multipart/form-data">
  
      <?php
      if($intention!=null){
          echo '<div class="form-group row">
           <div class="col-sm-12" style="text-align:center;">';
          if($intention==1){
              echo '
           <div class="alert alert-success" role="alert">post updated successfully wait admin to accept it </div>
              ';
              echo '<meta http-equiv="refresh" content="0;my-posts.php">';
          }else{
              echo' <div class="alert alert-danger" role="alert">'.$intention.'</div>';
          }
          echo '</div></div>';
      }else{
          
      }
      
      ?>
      
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Post Title</label>
    <div class="col-sm-10">
      <input type="text" name="post_title" value="<?php echo $row['post_title'] ?>"  class="form-control" id="inputPassword3" placeholder="title">
    </div>
  </div>
  <div class="form-group row">
     <label for="inputEmail3" class="col-sm-2 col-form-label">Post</label>
    <div class="col-sm-10">
<textarea name="post" id="editor1" rows="5" cols="50"><?php echo $row['post'] ?></textarea>
        <script> CKEDITOR.replace( 'editor1' );</script>
      </div>
  </div>
    <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Category</label>
    <div class="col-sm-10">
      <select name="post_category"  class="custom-select" id="inputGroupSelect01">
        <option>Choice Category</option>
          <?php
          $query2="select cat_name from category";
          $result2=mysqli_query($con,$query2);
         
          while($data=mysqli_fetch_assoc($result2)){
              if($data['cat_name']==$row['post_cat'])
              echo "<option  selected value=".$data['cat_name'].">".$data['cat_name']."</option>";
              else
                   echo "<option   value=".$data['cat_name'].">".$data['cat_name']."</option>";
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
      <button type="submit" name="post_update" class="btn btn-success">Update Post</button>
  </div>
                </div>
</form>

</div>
          </div>
        </div>
         <div class="col-md-4">
        <!-- Side Widget -->
        <div class="card my-4">
          <h5 class="card-header">Post Image</h5>
          <div class="card-body">
           <img src="<?php echo $row['img']; $_SESSION['post_img']= $row['img']; ?>" style="width:100%;height:200px;">
          </div>
        </div>
      </div>
     </div>
</div>

</div>
</div>
<?php
 include('include/footer.php');
?>

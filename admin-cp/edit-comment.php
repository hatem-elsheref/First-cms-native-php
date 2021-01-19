
<?php 

 include('include-cp/header.php'); 
 include('include-cp/session.php');
 include('include-cp/sidebar.php'); 
 include('include-cp/navbar.php'); 
?> 
<?php
//retreive data
$row=null;
if(isset($_GET['id']) and !empty($_GET['id'])){
    global $con;
    $query="select comment_title,comment from comment where comment_id=".$_GET['id'];
    $result=mysqli_query($con,$query);
    if(mysqli_num_rows($result)==0)
        header('location:intention.php');
    else{
        $row=mysqli_fetch_assoc($result);
    }
}

?>
<?php
//update data
$intention=null;
if($_SERVER['REQUEST_METHOD']=="POST"){
    $title=$_POST['comment_title'];
    $comment=$_POST['comment'];
    $intention=update_comment($title,$comment,$_GET['post_id']);
}

?>
<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
if($intention==1):?>
<div class="alert alert-success" role="alert">
  Comment Successfully Wait Admin Until Accept It.
    <meta http-equiv="refresh" content="0;cp-comments.php">
</div>
<?php endif;
if($intention!=1):?>
<div class="alert alert-danger" role="alert">
<?php echo $intention; ?>
</div>
<?php endif;
}?>
<div class="card my-4">
          <h5 class="card-header"><i class="fa fa-comment"></i> Update Comment:</h5>
          <div class="card-body">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']."?post_id=".$_GET['id']?>">
              <div class="form-group">
                  <input type="text" name="comment_title" class="form-control" placeholder="enter comment title" value="<?php echo $row['comment_title']; ?>"><br>
                <textarea class="form-control" name="comment" rows="3" placeholder="enter comment here"><?php echo $row['comment']; ?></textarea>
              </div>
              <button type="submit" name="post_comment" class="btn btn-success">Update</button>
            </form>
          </div>
        </div>
<?php
 include('include-cp/footer.php');
?>
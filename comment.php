<?php
if($_SERVER['PHP_SELF']=="/dashboard/website/comment.php")
{
    header('location:index.php');
}
$comment_title="no Name";
$comment="no comment";
$intention=null;
            if($_SERVER['REQUEST_METHOD']=="POST"){
            $comment_title=$_POST['comment_title'];
            $comment=$_POST['comment'];
            $post_id=$_GET['id'];
            $user=$_SESSION['username'];   
            $data=array($comment_title,$comment,$post_id, $user);
            $intention=comment($data);
          }

?>
<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
if($intention==1):?>
<div class="alert alert-success" role="alert">
  Comment Successfully Wait Admin Until Accept It.
    <meta http-equiv="refresh" content="1;more.php?id=<?php echo $_GET['id']; ?>">
</div>
<?php endif;
if($intention!=1):?>
<div class="alert alert-danger" role="alert">
<?php echo $intention; ?>
</div>
<?php endif;
}?>
    <!-- Comments Form -->
        <div class="card my-4">
          <h5 class="card-header"><i class="fa fa-comment"></i> Leave a Comment:</h5>
          <div class="card-body">
            <form method="post" action="#">
              <div class="form-group">
                  <input type="text" name="comment_title" class="form-control" placeholder="comment title"><br>
                <textarea class="form-control" name="comment" rows="3" placeholder="comment"></textarea>
              </div>
              <button type="submit" name="post_comment" class="btn btn-primary">post</button>
            </form>
          </div>
        </div>

        <?php
if(isset($_GET['type'])){
    if($_GET['type']=="all"){
        $query2="select * from comment where post_id=".$_GET['id']." and comment_status='posted' ORDER BY comment_id DESC ";
    }else{
      $query2="select * from comment where post_id=".$_GET['id']." and comment_status='posted' ORDER BY comment_id DESC limit 2";  
    }
}
else{$query2="select * from comment where post_id=".$_GET['id']." and comment_status='posted' ORDER BY comment_id DESC limit 2";}

        $result2=mysqli_query($con,$query2);
       
        while($row=mysqli_fetch_assoc($result2)):?>

          <!-- Single Comment -->
        <div class="media mb-4">
            <?php
            $q="select avatar from user where user_name='".$row['user']."'";
            $re=mysqli_query($con,$q);
            $ro=mysqli_fetch_assoc($re);
            ?>
          <img class="d-flex mr-3 rounded-circle" src="<?php echo $ro['avatar'];?>" style="width:50px;height:50px;"  alt="comment owner photo">
          <div class="media-body">
            <h5 class="mt-0"><?php  echo $row['comment_title']; ?></h5>
            <?php   echo $row['comment']; ?>
              <hr>
              <small>commented on <?php echo $row['comment_date'];?> by <?php echo $row['user'];?></small>
          </div>
           
        </div>

        <?php endwhile; ?>
      
     <a style="color:red;" href="<?php echo $_SERVER['PHP_SELF']."?type=all&id=".$_GET['id'] ;?>">Show all</a>

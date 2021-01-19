<?php 

 include('include-cp/header.php'); 
 include('include-cp/session.php');
 include('include-cp/sidebar.php'); 
 include('include-cp/navbar.php'); 
?> 
<?php
if(isset($_GET['action']) and $_GET['action']!="view"){
if($_GET['action']==1 or $_GET['action']==2 or $_GET['action']==3){
    if(isset($_GET['id']) and !empty($_GET['id'])){
        $query2="select * from comment where comment_id=".$_GET['id'];
        $result2=mysqli_query($con,$query2);
        if(mysqli_num_rows($result2)>0){
            if($_GET['action']==1){
                edit_comment($_GET['id']);
            }elseif($_GET['action']==2){
                remove_comment($_GET['id']);
            }
            elseif($_GET['action']==3){
                status_comment($_GET['id']);
            }
    }else{
        header('location:intention.php');
        }
}else{
        header('location:intention.php');
        }
}else{
        header('location:intention.php');
        }
}
?>

  
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <?php
            $query="SELECT COUNT(*) FROM comment";
            $result=mysqli_query($con,$query);
            $data=mysqli_fetch_assoc($result);
        echo '<h4>Comments ( '.$data['COUNT(*)'].' )</h4>';
            ?>
            <?php
            if(isset($_GET['action']) and $_GET['action']=="view"):?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                
                <?php
                 $query1="SELECT comment FROM comment where comment_id=".$_GET['id'];
                 $result1=mysqli_query($con,$query1);
                $result1=mysqli_fetch_assoc($result1);
                echo $result1['comment'];
                ?>
                
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
                <?php endif;?>
        <div class="table-responsive">  
        <table class="table table-striped">
    <thead>
      <tr>
        <th>Comment Id</th>
        <th>Comment Title</th>
        <th>Post Title</th>
        <th>Owner</th>
        <th>Comment</th>
        <th>Comment Status</th>
        <th>Comment Date</th>
        <th>Controlers</th>
      </tr>
    </thead>
    <tbody>
        <?php
    // retrive data table
      $query="SELECT * FROM comment order by comment_id Desc";
      $result=mysqli_query($con,$query);
        if(mysqli_num_rows($result)==0){
            $intention="No Comments Founded!";
        }else{
            while($data=mysqli_fetch_assoc($result)){
                $query3="select post_title  from post where post_id=".$data['post_id'];
                $result3=mysqli_query($con,$query3);
                $result3=mysqli_fetch_assoc($result3);
                $id=$data['comment_id'];
                $title=$data['comment_title'];
                $post=$result3['post_title'];
                $user=$data['user'];
                $comment=$data['comment'];
                $status=$data['comment_status'];
                $date=$data['comment_date'];
                echo ' 
                   <tr>
                  <th>'.$id.'</th>
                  <td>'.$title.'</td>
                  <td>'.$post.'</td>
                  <th>'.$user.'</th>
                  <td><a href="'.$_SERVER['PHP_SELF'].'?action=view&id='.$id.'" title="view comment"><i class="fa fa-eye fa-lg"></i></a></td>
                  <th>'.$status.'</th>
                  <td>'.$date.'</td>
                  <td>
                      <a href="cp-comments.php?action=1&id='.$id.'" title="edit comment"><i class="fa fa-edit fa-sm"></i></a>
                      <a href="cp-comments.php?action=2&id='.$id.'" title="remove comment"><i class="fa fa-remove fa-sm"></i></a> ';
                      if($status=="suspend")
                      echo' <a href="cp-comments.php?action=3&id='.$id.'" title="change comment status"><i class="fa fa-play fa-sm"></i></a></td></tr';
                else
                     echo' <a href="cp-comments.php?action=3&id='.$id.'" title="change comment status"><i class="fa fa-pause fa-sm"></i></a></td></tr>';
                      
                
            }
        }
      ?>
    </tbody>
  </table>    
</div>  
<div></div><div>
</div>
</div>
</div>
</div>

<?php
 include('include-cp/footer.php');
?>
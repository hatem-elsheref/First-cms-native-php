<?php 

 include('include-cp/header.php'); 
 include('include-cp/session.php');
 include('include-cp/sidebar.php'); 
 include('include-cp/navbar.php'); 
?> 
<?php
$view=null;
if(isset($_GET['action']) and !empty($_GET['action']))
    if($_GET['action']=="view"){
    if(isset($_GET['author']) and !empty($_GET['author'])){
        // search for id if exist or not
        // if exist check the action and do it 
        // if not exist sohw msg not exist
    
        $query="select * from post where post_author=".$_GET['author'];
        $result=mysqli_query($con,$query);
        if(mysqli_num_rows($result)>0):?>
                <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <?php
            $query="SELECT COUNT(*) FROM post where post_author=".$_GET['author'];
            $result=mysqli_query($con,$query);
            $data=mysqli_fetch_assoc($result);
        echo '<h4>Posts ( '.$data['COUNT(*)'].' )</h4>';
            ?>
        <div class="table-responsive">  
        <table class="table table-striped">
    <thead>
      <tr>
        <th>Post Id</th>
        <th>Post title</th>
        <th>Post author</th>
        <th>Post category</th>
        <th>Post status</th>
        <th>Post date</th>
        <th>Post img</th>
        <th>Controlers</th>
      </tr>
    </thead>
    <tbody>
        <?php
    // retrive data table
      $query="SELECT * FROM post  where post_author=".$_GET['author']." order by post_id Desc";
      $result=mysqli_query($con,$query);
      while($data=mysqli_fetch_assoc($result)){
                
                $query1="SELECT * FROM user where id=".$data['post_author'];
                $result1=mysqli_query($con,$query1);
                $row=mysqli_fetch_assoc($result1);
                $id=$data['post_id'];
                $title=$data['post_title'];
                $cat=$data['post_cat'];
                $user=$row['user_name'];
                $status=$data['status'];
                $img=$data['img'];
                $date=$data['post_date'];
                echo ' 
                   <tr>
                  <th>'.$id.'</th>
                  <td>'.$title.'</td>
                  <th>'.$user.'</th>
                  <td>'.$cat.'</td>
                  <th>'.$status.'</th>
                  <td>'.$date.'</td>
                  <th><img src="../'.$img.'" class="rounded-circle" style="width:60px;height:60px;"></th>
                  <td>
                      <a href="../more.php?id='.$id.'" title="view post"><i class="fa fa-eye fa-sm"></i></a>
                      <a href="cp-posts.php?action=1&id='.$id.'" title="edit post"><i class="fa fa-edit fa-sm"></i></a>
                      <a href="cp-posts.php?action=2&id='.$id.'" title="remove post"><i class="fa fa-remove fa-sm"></i></a> ';
                      if($status=="suspend")
                      echo' <a href="cp-posts.php?action=3&id='.$id.'" title="change post status"><i class="fa fa-play fa-sm"></i></a></td></tr';
                else
                     echo' <a href="cp-posts.php?action=3&id='.$id.'" title="change post status"><i class="fa fa-pause fa-sm"></i></a></td></tr>';
                      
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
            <?php endif;
        if(mysqli_num_rows($result)==0):?>
        <div class="container-fluid">
            <div class="row">   
                <div class="col-md-12">
                 <div class="card my-4">
                  <h5 class="card-header">no results founded !!</h5>
                  <div class="card-body">
                   try , to enter data correctly
                     </div>
                </div>
             </div>
            </div>
</div>
<?php endif;
}else{
        header('location:intention.php');
        }
}else{
        header('location:intention.php');
        }
?>


<?php
 include('include-cp/footer.php');
?>
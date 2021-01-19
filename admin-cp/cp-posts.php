<?php 

 include('include-cp/header.php'); 
 include('include-cp/session.php');
 include('include-cp/sidebar.php'); 
 include('include-cp/navbar.php'); 
?> 
          
<?php

if($_SERVER['REQUEST_METHOD']=="GET")


?>
<?php
if(isset($_GET['action']))
if($_GET['action']==1 or $_GET['action']==2 or $_GET['action']==3){
    if(isset($_GET['id']) and !empty($_GET['id'])){
        // search for id if exist or not
        // if exist check the action and do it 
        // if not exist sohw msg not exist
    
        $query="select * from post where post_id=".$_GET['id'];
        $result=mysqli_query($con,$query);
        if(mysqli_num_rows($result)>0){
            if($_GET['action']==1){
                edit_post($_GET['id']);
            }elseif($_GET['action']==2){
                remove_post($_GET['id']);
            }
            elseif($_GET['action']==3){
                status_post($_GET['id']);
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
?>
<div class="container-fluid">
    <div class="row">
            <div class="col-md-12">
                <hr>
                    <div class="row">
                            <div class="col-md-8"  style="margin:-10px 0px;">
                 <?php
            $query="SELECT COUNT(*) FROM post";
            $result=mysqli_query($con,$query);
            $data=mysqli_fetch_assoc($result);
        echo '<h4>Posts ( '.$data['COUNT(*)'].' )</h4>';
            ?>
                            </div>
                            <div class="col-md-4"  style="margin:-10px 0px;">
          <form class="form-inline md-form mr-auto mb-4" method="get" action="<?php echo $_SERVER['PHP_SELF']?>">
              <input class="form-control mr-sm-2" type="text" placeholder="Search" name="q" aria-label="Search">
              <button class="btn btn-outline-warning btn-rounded btn-sm my-0" type="submit">Search</button>
            </form>
        </div>
                        </div>
        
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
      $query="SELECT * FROM post order by post_id Desc";
      $result=mysqli_query($con,$query);
        if(mysqli_num_rows($result)==0){
            $intention="No posts Founded!";
        }else{
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
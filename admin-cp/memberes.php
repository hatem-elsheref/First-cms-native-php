<?php 
 include('include-cp/header.php'); 
 include('include-cp/session.php');
 include('include-cp/sidebar.php'); 
 include('include-cp/navbar.php'); 
?> 
<?php


if(isset($_GET['action']) and !empty($_GET['action'])){
    if(isset($_GET['id']) and !empty($_GET['id'])){
        // search for id if exist or not
        // if exist check the action and do it 
        // if not exist sohw msg not exist
    
        $query="select * from user where id=".$_GET['id'];
        $result=mysqli_query($con,$query);
        if(mysqli_num_rows($result)>0){
            if($_GET['action']==1){
                // view data
                header('memberoperations.php?action=1&id='.$_GET['id']);
            }elseif($_GET['action']==2){
                remove_user($_GET['id']);
            }
            elseif($_GET['action']==3){
                status_user($_GET['id']);
            }elseif($_GET['action']==4){
                // edit data
                $id=$_GET['id'];
                $role=$_GET['role'];
                update_role($id,$role);
            }
    }
}
}


?>
<div class="container-fluid">
    <div class="row">
            <?php
            $query="SELECT COUNT(*) FROM user";
            $result=mysqli_query($con,$query);
            $data=mysqli_fetch_assoc($result);
        echo '<h4>  Memberes ( '.$data['COUNT(*)'].' )</h4>';
            ?>
              <?php
    // retrive data table
      $query="SELECT * FROM user order by id Desc";
      $result=mysqli_query($con,$query);
        if(mysqli_num_rows($result)==0){
            $intention="No Memberes Founded!";
        }else{
            while($data=mysqli_fetch_assoc($result)){
                $id=$data['id'];
                $username=$data['user_name'];
                $email=$data['email'];
                $phone=$data['phone'];
                $gender=$data['gender'];
                $role=$data['role'];
                $description=$data['description'];
                $birthdate=$data['date_of_birth'];
                $regdate=$data['date_regeist'];
                $avatar=$data['avatar'];
                $status=$data['status'];?>
        <div class="table-responsive">  
        <table class="table table-striped">
    <thead>
      <tr>
        <th>User Id</th>
        <th>User Name</th>
        <th>Email</th>
        <th>phone</th>
        <th>gender</th>
        <th>role</th>
        <th>description</th>
        <th>birth date</th>
        <th>reg date</th>
        <th>avatar</th>
        <th>status</th>
          <?php 
          if($role=="admin" or $role=="writer")
              echo ' <th>Posts</th>';
          ?>
       
        <th>Controlers</th>
      </tr>
    </thead>
    <tbody>
      
                <?php
                echo ' 
                   <tr>
                  <td>'.$id.'</td>
                  <td>'.$username.'</td>
                  <td>'.$email.'</td>
                  <td>'.$phone.'</td>
                  <td>'.$gender.'</td>
                  <td>'.$role.'</td>
                  <td>'.$description.'</td>
                  <td>'.$birthdate.'</td>
                  <td>'.$regdate.'</td>
                  <td><img src="../'.$avatar.'" class="rounded-circle" style="width:60px;height:60px;"></td>
                     <td>'.$status.'</td>
                     ';
                if($role=="admin" or $role=="writer"){
                    global $con;
                    $query1="select * from post where post_author=".$id;
                    $res=mysqli_query($con,$query1);
                    $res=mysqli_num_rows($res);
                    
                    echo '<td><a href="view.php?action=view&author='.$id.'">'.$res.'</a></td>';
                }
                echo'
                    <td>
                      <a href="memberoperations.php?action=1&id='.$id.'" title="view member"><i class="fa fa-eye fa-sm"></i></a>                
                      <a href="memberes.php?action=2&id='.$id.'" title="remove member"><i class="fa fa-remove fa-sm"></i></a>';
                if($status=="stoped") echo' <a href="memberes.php?action=3&id='.$id.'" title="change member status"><i class="fa fa-play fa-sm"></i></a></td></tr';
                else
                     echo' <a href="memberes.php?action=3&id='.$id.'" title="change member status"><i class="fa fa-pause fa-sm"></i></a>
                     
                      <i class="dropdown-toggle" data-toggle="dropdown" title="change member role" aria-expanded="false" style="color:blue;"></i>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="memberes.php?action=4&role=admin&id='.$id.'">Admin</a>
                      <a class="dropdown-item" href="memberes.php?action=4&role=writer&id='.$id.'">Writer</a>
                      <a class="dropdown-item" href="memberes.php?action=4&role=user&id='.$id.'">User</a>
                      </div>
                     
                     </td></tr>';

                
            }
        }
      ?>
    </tbody>
  </table> 
</div>  
        </div>
    <center>

    <?php
$stm="select count(*) from user";
$res=mysqli_query($con,$stm);
$numpages=mysqli_fetch_assoc($res);
$numpages=$numpages['count(*)'];
if($numpages>0)
    echo'<nav aria-label="Page navigation example">
  <ul class="pagination">';
for($i=1;$i<=ceil($numpages/3);$i++)
    echo '<li class="page-item"><a class="page-link" href="memberes.php?page='.$i.'">'.$i.'</a></li> </ul>
</nav>';

?>
</center>
    </div>

 
<div></div><div>
</div>



<?php
 include('include-cp/footer.php');
?>
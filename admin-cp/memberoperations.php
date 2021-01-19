<?php 
 include('include-cp/header.php'); 
 include('include-cp/session.php');
 include('include-cp/sidebar.php'); 
 include('include-cp/navbar.php'); 
?> 



<div class="container">
    <div class="row">
        <div class="col-md-12">
<?php
$data=null;
if(isset($_GET['action']) and !empty($_GET['action'])){
    if(isset($_GET['id']) and !empty($_GET['id'])){
    
        $query="select * from user where id=".$_GET['id'];
        $result=mysqli_query($con,$query);
        if(mysqli_num_rows($result)>0){
            if($_GET['action']==1){
                $data=viewdata($_GET['id']);
                if($data==null){
                header('location:../404.html');
                }else{
                    $row=mysqli_fetch_assoc($data);
                }
            }elseif($_GET['action']==2){
                edit_user($_GET['id']);
            }
    }
}
}

?>    
        <div class="  col-md-6" >
          
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo $row['full_name'];?></h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="../<?php echo $row['avatar'];?>" class="img-circle img-responsive" style="width:120px;height=120px;"> </div>
                
                <!--<div class="col-xs-10 col-sm-10 hidden-md hidden-lg"> <br>
                  <dl>
                    <dt>DEPARTMENT:</dt>
                    <dd>Administrator</dd>
                    <dt>HIRE DATE</dt>
                    <dd>11/12/2013</dd>
                    <dt>DATE OF BIRTH</dt>
                       <dd>11/12/2013</dd>
                    <dt>GENDER</dt>
                    <dd>Male</dd>
                  </dl>
                </div>-->
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>User Name:</td>
                        <td><?php echo $row['user_name'];?></td>
                      </tr>
                      <tr>
                         <td>Description:</td>
                        <td><?php echo $row['description'];?></td>
                      </tr>
                      <tr>
                        <td>Date of Birth</td>
                        <td><?php echo $row['date_of_birth'];?></td>
                      </tr>
                      <tr>
                        <td>Gender</td>
                        <td><?php echo $row['gender'];?></td>
                      </tr>
                        <tr>
                        <td>Role</td>
                        <td><?php echo $row['role'];?></td>
                      </tr>
                        <tr>
                        <td>Status</td>
                        <td><?php echo $row['status'];?></td>
                      </tr>
                        <tr>
                        <td>Home Address</td>
                        <td><?php echo $row['address'];?></td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td><?php echo $row['email'];?></td>
                      </tr>
                        <tr>
                        <td>Phone Number</td>
                        <td><?php echo $row['phone'];?></td>
                      </tr>
                        <tr>
                        <td>Register date</td>
                        <td><?php echo $row['date_regeist'];?></td>
                      </tr>
                      <tr>
                        <td>Social</td>
                        <td>
                        <a href="<?php echo $row['facebook'];?>"><i class="fa fa-facebook"></i></a> 
                        <a href="<?php echo $row['twitter'];?>"><i class="fa fa-twitter"></i></a> 
                        <a href="<?php echo $row['instagram'];?>"><i class="fa fa-instagram" style="color:red;"></i></a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>            
          </div>
        </div>
</div>  
        </div>
</div>

<?php
 include('include-cp/footer.php');
?>
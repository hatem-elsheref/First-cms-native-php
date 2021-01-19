<?php

include('include/header.php');
if(!isset($_SESSION['id'])):?>
<div class="cotainer " style="margin-top:50px;">
        <div class="row ">
                                <div class="card text-center">
                      <div class="card-header">
                        OOPS!
                      </div>
                      <div class="card-body">
                        <h5 class="card-title">You SHOULD LOG TO THE SYSTEM FIRST</h5>
                        <center><p class="card-text"><img src="img/404.png" style="width:75%;height:300px;"></p></center>
                       
                      </div>
                      <div class="card-footer text-muted">
                         <a href="index.php" class="btn btn-primary">Go Home</a>
                      </div>
                    </div>
    </div>
</div>
<?php endif;
if(isset($_SESSION['id'])):
$intention="";
if(isset($_GET['type']))
    if($_GET['type']=="remove"){
    $intention=remove();
}
?>
<main>
<div class="card justify-content-center" style="margin-top:50px;">
<div class="container">
    <div class="row">
      <div class="  toppad  pull-right col-md-6 ">
        <a href="logout.php" class="btn btn-dark"><i class="fa fa-sign-out" style="color:#fff"></i> Logout</a>
       <br>
<p class=" text-info">registered at <?php echo $_SESSION['reg_date'];?> </p>
          <br>
          <?php
          if(isset($_GET['type']))                      
          if($intention==1){
           echo ' 
           <div class="alert alert-success" style="text-align:center;" role="alert">user deleted successfully</div>';
           session_destroy();  
           echo '<meta http-equiv="refresh" content="1;index.php">';
            }else{
         echo ' 
        <div class="alert alert-danger" style="text-align:center;" role="alert">failed to delete</div>';}
          ?>
          
          
        </div>
        
          <div class="clearfix"></div>
        
        <div class="manage col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
          
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo $_SESSION['fullname'];?></h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="<?php echo $_SESSION['avatar'];?>" class="img-circle img-responsive" style="width:120px;height=120px;"> </div>
                
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
                        <td><?php echo $_SESSION['username'];?></td>
                      </tr>
                      <tr>
                         <td>Description:</td>
                        <td><?php echo $_SESSION['description'];?></td>
                      </tr>
                      <tr>
                        <td>Date of Birth</td>
                        <td><?php echo $_SESSION['birth_date'];?></td>
                      </tr>
                      <tr>
                        <td>Gender</td>
                        <td><?php echo $_SESSION['gender'];?></td>
                      </tr>
                        <tr>
                        <td>Home Address</td>
                        <td><?php echo $_SESSION['address'];?></td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td><?php echo $_SESSION['email'];?></td>
                      </tr>
                        <tr>
                        <td>Phone Number</td>
                        <td><?php echo $_SESSION['phone'];?></td>
                      </tr>
                      <tr>
                        <td>Social</td>
                        <td>
                        <a href="<?php echo $_SESSION['facebook'];?>"><i class="fa fa-facebook"></i></a> 
                        <a href="<?php echo $_SESSION['twitter'];?>"><i class="fa fa-twitter"></i></a> 
                        <a href="<?php echo $_SESSION['instagram'];?>"><i class="fa fa-instagram" style="color:red;"></i></a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <a href="edit-profile.php" class="btn btn-success"><i class="fa fa-edit" style="color:#fff"></i> Edit Account</a>
                  <a  href="<?php echo $_SERVER['PHP_SELF']."?type=remove";?>" class="btn btn-danger"><i class="fa fa-close" style="color:#fff"></i> Remove Account</a>
                </div>
              </div>
            </div>            
          </div>
        </div>
      </div>
    </div>
    </div>
    </main>
      <?php endif;?>       
<?php
include('include/footer.php');
?>
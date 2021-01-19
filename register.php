<?php

include('include/header.php');


if(!isset($_SESSION['id'])):?>
<?php
 $intention="";
if(isset($_POST['register']))
{
   
    $intention=prepareForRegist();
}
    ?>
<main class="my-form" style="margin:50px;">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                        <nav class="navbar navbar-expand-md navbar-light " style="padding:0px;">
                        <a class="navbar-brand" href="#"><i class="fa fa-user-plus"></i>"Register</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item ">
                                    <a class="nav-link" href="login.php">Login</a>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link" href="register.php">Register</a>
                                </li>
                            </ul>
                        </div>
                            </nav>
                        </div>        
                        <div class="card-body">
                        <!--here but the intention -->
                        <?php
                            if(isset($_POST['register'])){
                                if($intention==1){
                                echo ' 
                            <div class="alert alert-success" style="text-align:center;" role="alert">Added Successfully</div>
                                <meta http-equiv="refresh" content="1;index.php">';
                                }else{
                                    echo ' 
                            <div class="alert alert-warning" style="text-align:center;" role="alert">'.$intention.'</div>';
                                }
                            }
                            ?>
                            
                            
                            <form  action="register.php" method="post" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label for="full_name" class="col-md-4 col-form-label text-md-right">Full Name</label>
                                    <div class="col-md-6">
                                        <input type="text" id="full_name" class="form-control" name="fullname">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                    <div class="col-md-6">
                                        <input type="text" id="email_address" class="form-control" name="email">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="user_name" class="col-md-4 col-form-label text-md-right">User Name</label>
                                    <div class="col-md-6">
                                        <input type="text" id="user_name" class="form-control" name="username">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="phone_number" class="col-md-4 col-form-label text-md-right">Phone Number</label>
                                    <div class="col-md-6">
                                        <input type="text" id="phone_number" name="phone" class="form-control">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label for="phone_number" class="col-md-4 col-form-label text-md-right">Gender</label>
                                    <div class="col-md-6">
                                        Male <input type="radio" checked  name="gender" value="male" id="phone_number" >
                                       Female <input type="radio" name="gender" value="female" id="phone_number" >
                                    </div>
                                </div>

                                    <div class="form-group row">
                                    <label for="phone_number" class="col-md-4 col-form-label text-md-right">Date Of Birth</label>
                                    <div class="col-md-6">
                                    <input type="date" name="date_of_birth"  id="phone_number" >
                                    </div>
                                </div>
                                    
                                <div class="form-group row">
                                    <label for="present_address" class="col-md-4 col-form-label text-md-right">Present Address</label>
                                    <div class="col-md-6">
                                        <input type="text" id="present_address" class="form-control" name="address" class="form-control">
                                    </div>
                                </div>
                                    <div class="form-group row">
                                    <label for="permanent_address" class="col-md-4 col-form-label text-md-right">Description</label>
                                    <div class="col-md-6">
                                        <input type="text" id="permanent_address" name="description" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="permanent_address" class="col-md-4 col-form-label text-md-right">Password</label>
                                    <div class="col-md-6">
                                        <input type="password" id="permanent_address"  class="form-control" name="password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="permanent_address" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                                    <div class="col-md-6">
                                        <input type="password" id="permanent_address" class="form-control" name="confirmpassword">
                                    </div>
                                </div>

                               <div class="input-group form-group row">
                                      
                                      <div class="custom-file ">
                                           <label for="nid_number" class="col-md-4 col-form-label text-md-right">Img Profile</label>
                                          <div class="col-md-6">
                                         <input type="file" name="avatar" class="form-control" >
                                      </div>
                                    </div>
                                </div>
                                        <div class="form-group row">
                                    <label for="nid_number" class="col-md-4 col-form-label text-md-right">Facebook</label>
                                    <div class="col-md-6">
                                        <input type="text" id="nid_number" class="form-control" name="facebook">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nid_number" class="col-md-4 col-form-label text-md-right">Twitter</label>
                                    <div class="col-md-6">
                                        <input type="text" id="nid_number" class="form-control" name="twitter">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nid_number" class="col-md-4 col-form-label text-md-right">Instagram</label>
                                    <div class="col-md-6">
                                        <input type="text" id="nid_number" class="form-control" name="instagram">
                                    </div>
                                </div>

                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" name="register" class="btn btn-primary">
                                        Register
                                        </button>
                                    </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>

</main>

<?php endif; ?>
<?php
if(isset($_SESSION['id'])):?>
<?php header('location:404.html'); ?>
<?php endif; ?>

<?PHP
include('include/footer.php');
?>

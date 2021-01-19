<?php

include('include/header.php');
if(isset($_SESSION['id'])):?>
<?php
$intention="";
if(isset($_POST['update'])){
    $intention=perparForUpdate();
}

?>
<main class="my-form" style="margin:50px;">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                        <nav class="navbar navbar-expand-md navbar-light " style="padding:0px;">
                        <a class="navbar-brand" href="#"><i class="fa fa-edit"></i> Update Profile</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                            </nav>
                        </div>        
                        <div class="card-body">
                             <?php
                            if(isset($_POST['update'])){
                                if($intention==1){
                                echo ' 
                            <div class="alert alert-success" style="text-align:center;" role="alert">updated Successfully</div>
                                <meta http-equiv="refresh" content="1;profile.php">';
                                }else{
                                    echo ' 
                            <div class="alert alert-warning" style="text-align:center;" role="alert">'.$intention.'</div>';
                                }
                            }
                            ?>
                            
                            <form   action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label for="full_name" class="col-md-4 col-form-label text-md-right">Full Name</label>
                                    <div class="col-md-6">
                                        <input type="text" id="full_name" class="form-control" name="fullname" value="<?php echo $_SESSION['fullname'];?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                    <div class="col-md-6">
                                        <input type="text" id="email_address" class="form-control" name="email" value="<?php echo $_SESSION['email'];?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="user_name" class="col-md-4 col-form-label text-md-right">User Name</label>
                                    <div class="col-md-6">
                                        <input type="text" id="user_name" class="form-control" name="username" value="<?php echo $_SESSION['username'];?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="phone_number" class="col-md-4 col-form-label text-md-right">Phone Number</label>
                                    <div class="col-md-6">
                                        <input type="text" id="phone_number" name="phone" class="form-control" value="<?php echo $_SESSION['phone'];?>">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label for="phone_number" class="col-md-4 col-form-label text-md-right">Gender</label>
                                    <div class="col-md-6">
                                        <?php
                                        if($_SESSION['gender']=="male")
                                            echo'
                                   Male <input type="radio" name="gender" checked value="male" id="phone_number" >
                                       Female <input type="radio" name="gender" value="female" id="phone_number" >
                                            ';else
                                                echo '
                                        Male <input type="radio" name="gender" value="male" id="phone_number" >
                                       Female <input type="radio" name="gender" checked value="female" id="phone_number" >
                                                ';
                                        ?>
                                    </div>
                                </div>

                                    <div class="form-group row">
                                    <label for="phone_number" class="col-md-4 col-form-label text-md-right">Date Of Birth</label>
                                    <div class="col-md-6">
                                    <input type="date" name="date_of_birth" value="<?php echo $_SESSION['birth_date'];?>"  id="phone_number" >
                                    </div>
                                </div>
                                    
                                <div class="form-group row">
                                    <label for="present_address" class="col-md-4 col-form-label text-md-right">Present Address</label>
                                    <div class="col-md-6">
                                        <input type="text" id="present_address" class="form-control" name="address" value="<?php echo $_SESSION['address'];?>" class="form-control">
                                    </div>
                                </div>
                                    <div class="form-group row">
                                    <label for="permanent_address" class="col-md-4 col-form-label text-md-right">Description</label>
                                    <div class="col-md-6">
                                        <input type="text" id="permanent_address" name="description" value="<?php echo $_SESSION['description'];?>"  class="form-control">
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

                                <div class="form-group row">
                                    <label for="nid_number" class="col-md-4 col-form-label text-md-right">Img Profile</label>
                                    <div class="col-md-6">
                                        <input type="file" id="nid_number" class="form-control" name="avatar">
                                    </div>
                                </div>

                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" name="update" class="btn btn-success">
                                        Update
                                        </button>
                                    </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>

</main>
<?php endif;
if(!isset($_SESSION['id']))
header('location:404.html');
?>
<?php
include('include/footer.php');
?>

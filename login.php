<?php

include('include/header.php');
?>
<?php
if(isset($_SESSION['id']))
header('location:404.html');
if(!isset($_SESSION['id'])):?>
<?php
 $intention="";
/*
 $user="";
 $pass="";
*/
if(isset($_POST['login']))
{
   
    $intention=prepareForLogin();
}
/*
if(isset($_COOKIE['username'])){
$user=$_COOKIE['username'];
$pass=$_COOKIE['password'];
}
*/
?>
<main class="my-form" style="margin:50px;">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                        <nav class="navbar navbar-expand-md navbar-light " style="padding:0px;">
                        <a class="navbar-brand" href="#"><i class="fa fa-sign-in"></i> Log in</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link active" href="login.php">Login</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="register.php">Register</a>
                                </li>
                            </ul>
                        </div>
                            </nav>
                        </div>        
                        <div class="card-body">
                        <!--here but the intention -->
                            <?php
                            if(isset($_POST['login'])){
                                if($intention==1){
                                echo ' 
                            <div class="alert alert-success" style="text-align:center;" role="alert">welcome  '.$_SESSION['fullname'].'</div>
                                <meta http-equiv="refresh" content="0;index.php">';
                                }else{
                                    echo ' 
                            <div class="alert alert-warning" style="text-align:center;" role="alert">'.$intention.'</div>';
                                }
                            }
                            ?>
                                <form action="<?php  echo $_SERVER['PHP_SELF']; ?>" method="POST">
                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address/User Name</label>
                                <div class="col-md-6">
                        <input type="text" id="email_address" class="form-control"  name="user_email" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input type="password" id="password" class="form-control" name="password" required  >
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" name="login">
                                    Login
                                </button>
                                <a href="#" class="btn btn-link">
                                    Forgot Your Password?
                                </a>
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
include('include/footer.php');
?>








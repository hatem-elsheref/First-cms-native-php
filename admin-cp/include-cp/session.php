<?php
if($con==null){
    header('location:../404.html');
}else{
if(isset($_SESSION['id'])){
$query="select * from user where id='".$_SESSION['id']."' and role='admin'";
    $result=mysqli_query($con,$query);
    if(mysqli_num_rows($result) == 0){
        header('location:../404.html');
    }else{
    }
    }else{
    header('location:../404.html');
}
}
?>
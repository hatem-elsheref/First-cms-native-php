<?php
$con=null;
define('hostname','localhost');
define('username','root');
define('password','');
define('db','bloger');

function connect(){

    global $con;
    $con=mysqli_connect(hostname,username,password,db);
        if($con==true){
            return $con;
        }else{
            return null;
        }
}
function close(){
    
    global $con;
    mysqli_close($con);
    
}
?>
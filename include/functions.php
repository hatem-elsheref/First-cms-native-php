<?php
  
// function of regist
// function of login
// function of update
// function of remove user
// and more functions will be appear when using the app advanced topics in dashboard

 include('config.php');

function prepareForRegist(){
    
$fullname=strip_tags(trim(htmlentities(htmlspecialchars($_POST['fullname'],ENT_QUOTES))));
$username=strip_tags(trim(htmlentities(htmlspecialchars($_POST['username'],ENT_QUOTES))));
$email=strip_tags(trim(htmlentities(htmlspecialchars(filter_var($_POST['email'],FILTER_SANITIZE_EMAIL),ENT_QUOTES))));
$password=strip_tags(trim(htmlentities(htmlspecialchars($_POST['password'],ENT_QUOTES))));
$confirmpassword=strip_tags(trim(htmlentities(htmlspecialchars($_POST['confirmpassword'],ENT_QUOTES))));
$phone=strip_tags(trim(htmlentities(htmlspecialchars($_POST['phone'],ENT_QUOTES))));
$address=strip_tags(trim(htmlentities(htmlspecialchars($_POST['address'],ENT_QUOTES))));
$gender=strip_tags($_POST['gender']);
$description=strip_tags(trim(htmlentities(htmlspecialchars($_POST['description'],ENT_QUOTES))));
$date_of_birth=strip_tags(trim(htmlentities(htmlspecialchars($_POST['date_of_birth'],ENT_QUOTES))));
$facebook=strip_tags(trim(htmlentities(htmlspecialchars(filter_var($_POST['facebook'],FILTER_SANITIZE_URL)))));
$twitter=strip_tags(trim(htmlentities(htmlspecialchars(filter_var($_POST['twitter'],FILTER_SANITIZE_URL)))));
$instagram=strip_tags(trim(htmlentities(htmlspecialchars(filter_var($_POST['instagram'],FILTER_VALIDATE_URL)))));
$dest="img/up/";
    
    // check empty
    // check urls
    // check validation
    // check img exist
    // do operation if image exist and operation if image not exist
    
    // required fields is all except img urls phone description i will add default values to that
    
    if(empty($facebook) or (filter_var($facebook,FILTER_VALIDATE_URL))==false)
        $facebook="#";
    if(empty($twitter) or (filter_var($facebook,FILTER_VALIDATE_URL))==false)
        $twitter="#";
    if(empty($instagram) or (filter_var($facebook,FILTER_VALIDATE_URL))==false)
        $instagram="#";
    if(empty($phone))
        $phone="(00) 000-000";
    if(empty($description))
        $description="blogger";
    
    if(empty($fullname)){
        $intention="please , enter your full name";
        return $intention;
    }elseif(empty($email)){
        $intention="please , enter your email";
        return $intention;
    }elseif(filter_var($email,FILTER_VALIDATE_EMAIL)==FALSE){
        $intention="please , enter your right email";
        return $intention;
    }elseif(empty($username)){
        $intention="please , enter your user name";
        return $intention;
    }elseif(empty($gender)){
        $intention="please , select your gender";
        return $intention;
    }elseif(empty($address)){
        $intention="please , enter your address";
        return $intention;
    }elseif(empty($date_of_birth)){
        $intention="please , select your birth date";
        return $intention;
    }elseif(empty($password)){
        $intention="please , enter your password";
        return $intention;
    }elseif(empty($confirmpassword)){
        $intention="please , confirm your password";
        return $intention;
    }elseif($password != $confirmpassword ){
        $intention="please , enter your password correctly";
        return $intention;
    }elseif(strlen($password)<3){
        $intention="please , your password must me more than 2 characteres";
        return $intention;
    }elseif($_FILES['avatar']['size']>0){
        $name=$_FILES['avatar']['name'];
        $src=$_FILES['avatar']['tmp_name'];
        $size=$_FILES['avatar']['size'];
        
        $extension=explode('.',$name);
        $extension=end($extension);
        $extension=strtolower($extension);
        
        $allow=array('png','jpg','gif','jpge');
        if(in_array($extension,$allow)){
            if($size>2000000){
             $intention="please, choose small img less than 2MB";
            return $intention;
        }else{
               $newname=uniqid('user',false);
               $dest.=$newname.'.'.$extension;
               if(!move_uploaded_file($src,$dest)){
                   $intention="failed to upload image try later";
                   return $intention;
               }else{
                   $rightData=array('fullname'=>$fullname,'username'=>$username,'email'=>$email,'password'=>$password,'phone'=>$phone,'address'=>$address,'gender'=>$gender,'date_of_birth'=>$date_of_birth,'description'=>$description,'facebook'=>$facebook,'twitter'=>$twitter,'instagram'=>$instagram,'dest'=>$dest);
                   
                  $intention=regist($rightData);
                   return $intention;
               }
            }
        }else{
            $intention="please select right image";
            return $intention;
        }

    }else{
       $dest="img/up/default.png"; $rightData=array('fullname'=>$fullname,'username'=>$username,'email'=>$email,'password'=>$password,'phone'=>$phone,'address'=>$address,'gender'=>$gender,'date_of_birth'=>$date_of_birth,'description'=>$description,'facebook'=>$facebook,'twitter'=>$twitter,'instagram'=>$instagram,'dest'=>$dest);
        
                    $intention=regist($rightData);
                   return $intention;
    }
    
}
function regist($data){
    
    $con=connect();
    if($con==null){
        $intention="falied in connection ";
        return $intention;
    }else{
        $fullname=$data['fullname'];
        $username=$data['username'];
        $username=strtolower($username);
        $email=$data['email'];
        $gender=$data['gender'];
        $address=$data['address'];
        $phone=$data['phone'];
        $password=md5($data['password']);
        $birthdate=$data['date_of_birth'];
        $description=$data['description'];
        $dest=$data['dest'];
        $facebook=$data['facebook'];
        $twitter=$data['twitter'];
        $instagram=$data['instagram'];
        $reg_date=date("Y/m/d h:i a ");
        $role="user";
       // $status="working";
        
        $query1="select email from user where email='".$email."'";
        $query2="select user_name from user where user_name='".$username."'";
        
        /* use it later after learn normalization because ###/0000
        $query4="select facebook from user where facebook='".$facebook."'";
        $query5="select twitter from user where twitter='".$twitter."'";
        $query6="select instagram from user where instagram='".$instagram."'";
        $query7="select phone from user where phone='".$phone."'";
        */
        $result1=mysqli_query($con,$query1);
        if(mysqli_num_rows($result1)>0){
            $intention="this email is already exist";
            return $intention;
        }else{
            $result2=mysqli_query($con,$query2);
            if(mysqli_num_rows($result2)>0){
                $intention="this user name is already exist";
                return $intention;
            }else{
                

                
$q="insert into user (full_name,user_name,email,address,gender,date_of_birth,date_regeist,password,phone,facebook,twitter,instagram,avatar,description,role,status)
VALUES (
'".$fullname."',
'".$username."',
'".$email."',
'".$address."',
'".$gender."',
'".$birthdate."',
'".$reg_date."',
'".$password."',
'".$phone."',
'".$facebook."',
'".$twitter."',
'".$instagram."',
'".$dest."',
'".$description."',
'".$role."','working')";
if(mysqli_query($con,$q)){
                    
     $query="select * from user where ((user_name='".$username."' or email='".$email."') and password='".$password."');";
        $result=mysqli_query($con,$query);
        if(mysqli_num_rows($result)==0){
            $intention="failed to recognize user";
            return $intention;
        }else{
            $data=mysqli_fetch_assoc($result);
            $_SESSION['id']=$data['id'];
            $_SESSION['fullname']=$data['full_name'];
            $_SESSION['username']=$data['user_name'];
            $_SESSION['email']=$data['email'];
            $_SESSION['gender']=$data['gender'];
            $_SESSION['description']=$data['description'];
            $_SESSION['reg_date']=$data['date_regeist'];
            $_SESSION['birth_date']=$data['date_of_birth'];
            $_SESSION['facebook']=$data['facebook'];
            $_SESSION['twitter']=$data['twitter'];
            $_SESSION['instagram']=$data['instagram'];
            $_SESSION['address']=$data['address'];
            $_SESSION['phone']=$data['phone'];
            $_SESSION['avatar']=$data['avatar'];
            $_SESSION['role']=$data['role'];
            $_SESSION['m_status']=$data['status'];
             return 1;
        }        
               
                }else{
                    $intention="failed to add you";
                    return $intention;
                }
            }
        }
        
        
        
        // if exist before
        // store data
        // make session and cookies
        
    }
    
    
    
    
}
function prepareForLogin(){
$user_email=strip_tags(trim(htmlentities(htmlspecialchars($_POST['user_email'],ENT_QUOTES))));
$password=md5(strip_tags(trim(htmlentities(htmlspecialchars($_POST['password'],ENT_QUOTES)))));
    
    /*
$cookies=false;
    if(isset($_POST['remember'])){
        $cookies=true;
    }
    */
$con=connect();
    if($con==null){
        $intention="failed to connect";
        return $intention;
    }else{
        $query="select * from user where (user_name='".$user_email."' or email='".$user_email."') and password='".$password."' and status ='working';";
        $result=mysqli_query($con,$query);
        if(mysqli_num_rows($result)==0){
            $intention="failed to recognize user";
            return $intention;
        }else{
            $data=mysqli_fetch_assoc($result);
            $_SESSION['id']=$data['id'];
            $_SESSION['fullname']=$data['full_name'];
            $_SESSION['username']=$data['user_name'];
            $_SESSION['email']=$data['email'];
            $_SESSION['gender']=$data['gender'];
            $_SESSION['description']=$data['description'];
            $_SESSION['reg_date']=$data['date_regeist'];
            $_SESSION['birth_date']=$data['date_of_birth'];
            $_SESSION['facebook']=$data['facebook'];
            $_SESSION['twitter']=$data['twitter'];
            $_SESSION['instagram']=$data['instagram'];
            $_SESSION['address']=$data['address'];
            $_SESSION['phone']=$data['phone'];
            $_SESSION['avatar']=$data['avatar'];
            $_SESSION['role']=$data['role'];
            /*
            if($cookies){
                setcookie('username',$data['user_name'],time()+86400,'/');
                setcookie('password',$data['password'],time()+86400,'/');
                setcookie('role',$data['role'],time()+86400,'/');
            }
            */
            return 1;
        }
    }
}
function perparForUpdate(){
    
    
$fullname=strip_tags(trim(htmlentities(htmlspecialchars($_POST['fullname'],ENT_QUOTES))));
$username=strip_tags(trim(htmlentities(htmlspecialchars($_POST['username'],ENT_QUOTES))));
$email=strip_tags(trim(htmlentities(htmlspecialchars(filter_var($_POST['email'],FILTER_SANITIZE_EMAIL),ENT_QUOTES))));
$password=strip_tags(trim(htmlentities(htmlspecialchars($_POST['password'],ENT_QUOTES))));
$confirmpassword=strip_tags(trim(htmlentities(htmlspecialchars($_POST['confirmpassword'],ENT_QUOTES))));
$phone=strip_tags(trim(htmlentities(htmlspecialchars($_POST['phone'],ENT_QUOTES))));
$address=strip_tags(trim(htmlentities(htmlspecialchars($_POST['address'],ENT_QUOTES))));
$gender=strip_tags($_POST['gender']);
$description=strip_tags(trim(htmlentities(htmlspecialchars($_POST['description'],ENT_QUOTES))));
$date_of_birth=strip_tags(trim(htmlentities(htmlspecialchars($_POST['date_of_birth'],ENT_QUOTES))));
$dest="img/up/";
    
    if(empty($phone) or is_string($phone))
        $phone="(00) 000-000";
    if(empty($description))
        $description="blogger";
    
 if(empty($fullname)){
        $intention="please , enter your full name";
        return $intention;
    }elseif(empty($email)){
        $intention="please , enter your email";
        return $intention;
    }elseif(filter_var($email,FILTER_VALIDATE_EMAIL)==FALSE){
        $intention="please , enter your right email";
        return $intention;
    }elseif(empty($username)){
        $intention="please , enter your user name";
        return $intention;
    }elseif(empty($gender)){
        $intention="please , select your gender";
        return $intention;
    }elseif(empty($address)){
        $intention="please , enter your address";
        return $intention;
    }elseif(empty($date_of_birth)){
        $intention="please , select your birth date";
        return $intention;
    }elseif(empty($password)){
        $intention="please , enter your password";
        return $intention;
    }elseif(empty($confirmpassword)){
        $intention="please , confirm your password";
        return $intention;
    }elseif($password != $confirmpassword ){
        $intention="please , enter your password correctly";
        return $intention;
    }elseif(strlen($password)<3){
        $intention="please , your password must me more than 2 characteres";
        return $intention;
    }elseif($_FILES['avatar']['size']>0){
        $name=$_FILES['avatar']['name'];
        $src=$_FILES['avatar']['tmp_name'];
        $size=$_FILES['avatar']['size'];
        
        $extension=explode('.',$name);
        $extension=end($extension);
        $extension=strtolower($extension);
        
        $allow=array('png','jpg','gif','jpge');
        if(in_array($extension,$allow)){
            if($size>2000000){
             $intention="please, choose small img less than 2MB";
            return $intention;
        }else{
               $newname=uniqid('user',false);
               $dest.=$newname.'.'.$extension;
               if(!move_uploaded_file($src,$dest)){
                   $intention="failed to upload image try later";
                   return $intention;
               }else{
                   $rightData=array('fullname'=>$fullname,'username'=>$username,'email'=>$email,'password'=>$password,'phone'=>$phone,'address'=>$address,'gender'=>$gender,'date_of_birth'=>$date_of_birth,'description'=>$description,'dest'=>$dest);
                   
                  $intention=update($rightData);
                   return $intention;
               }
            }
        }else{
            $intention="please select right image";
            return $intention;
        }

    }else{
       $dest=$_SESSION['avatar']; $rightData=array('fullname'=>$fullname,'username'=>$username,'email'=>$email,'password'=>$password,'phone'=>$phone,'address'=>$address,'gender'=>$gender,'date_of_birth'=>$date_of_birth,'description'=>$description,'dest'=>$dest);
        
          $intention=update($rightData);
          return $intention;
    }
    
}
function update($data){
    $con=connect();
    if($con==null){
        $intention="falied in connection ";
        return $intention;
    }else{
        $fullname=$data['fullname'];
        $username=$data['username'];
        $email=$data['email'];
        $gender=$data['gender'];
        $address=$data['address'];
        $phone=$data['phone'];
        $password=md5($data['password']);
        $date_of_birth=$data['date_of_birth'];
        $description=$data['description'];
        $dest=$data['dest'];
        
        if($email==$_SESSION['email']){
             if($username==$_SESSION['username']){
                 $query="UPDATE user SET 
                 full_name='$fullname'
                ,gender='$gender' 
                ,address='$address'
                ,phone='$phone'
                ,password='$password'
                ,date_of_birth='$date_of_birth'
                ,description='$description'
                ,avatar='$dest' where id='".$_SESSION['id']."';";
                 if(!mysqli_query($con,$query)){
                     $intention="failed to update data1";
                     return $intention;
                 }else{
       $query="select * from user where user_name='".$username."';";
        $result=mysqli_query($con,$query);
        if(mysqli_num_rows($result)==0){
            $intention="failed to recognize user";
            return $intention;
        }else{
            $data=mysqli_fetch_assoc($result);
            $_SESSION['id']=$data['id'];
            $_SESSION['fullname']=$data['full_name'];
            $_SESSION['username']=$data['user_name'];
            $_SESSION['email']=$data['email'];
            $_SESSION['gender']=$data['gender'];
            $_SESSION['description']=$data['description'];
            $_SESSION['reg_date']=$data['date_regeist'];
            $_SESSION['birth_date']=$data['date_of_birth'];
            $_SESSION['facebook']=$data['facebook'];
            $_SESSION['twitter']=$data['twitter'];
            $_SESSION['instagram']=$data['instagram'];
            $_SESSION['address']=$data['address'];
            $_SESSION['phone']=$data['phone'];
            $_SESSION['avatar']=$data['avatar'];
            $_SESSION['role']=$data['role'];
        } 
                     
                     return 1;
                 }  
             }else{
                $query1="select * from user where user_name='".$username."';";
                 $result1=mysqli_query($con,$query1);
                 if(mysqli_num_rows($result1)>0){
                $intention="this user name is already exist";
                return $intention;
             }else{
                 $query="UPDATE user SET 
                 full_name='$fullname'
                ,user_name='$username' 
                ,gender='$gender'
                ,address='$address'
                ,phone='$phone'
                ,password='$password'
                ,date_of_birth='$date_of_birth'
                ,description='$description'
                ,avatar='$dest' where id='".$_SESSION['id']."';";
                 if(!mysqli_query($con,$query)){
                $intention="failed to update data2";
                return $intention;
                 }
                     else{
                         
        $query="select * from user where user_name='".$username."';";
        $result=mysqli_query($con,$query);
        if(mysqli_num_rows($result)==0){
            $intention="failed to recognize user";
            return $intention;
        }else{
            $data=mysqli_fetch_assoc($result);
            $_SESSION['id']=$data['id'];
            $_SESSION['fullname']=$data['full_name'];
            $_SESSION['username']=$data['user_name'];
            $_SESSION['email']=$data['email'];
            $_SESSION['gender']=$data['gender'];
            $_SESSION['description']=$data['description'];
            $_SESSION['reg_date']=$data['date_regeist'];
            $_SESSION['birth_date']=$data['date_of_birth'];
            $_SESSION['facebook']=$data['facebook'];
            $_SESSION['twitter']=$data['twitter'];
            $_SESSION['instagram']=$data['instagram'];
            $_SESSION['address']=$data['address'];
            $_SESSION['phone']=$data['phone'];
            $_SESSION['avatar']=$data['avatar'];
            $_SESSION['role']=$data['role'];
        } 
                         
                     return 1;
                 }  
                 }
        }
        }////////////////
        else{
           $query2="select * from user where email='".$email."';";
           $result2=mysqli_query($con,$query2);
           if(mysqli_num_rows($result2)>0){
            $intention="this email is already exist";
            return $intention;
        }else{
               if($username==$_SESSION['username']){
                 $query="UPDATE user SET 
                 full_name='$fullname'
                 ,email='$email'
                ,gender='$gender' 
                ,address='$address'
                ,phone='$phone'
                ,password='$password'
                ,date_of_birth='$date_of_birth'
                ,description='$description'
                ,avatar='$dest' where id='".$_SESSION['id']."';";
                 if(!mysqli_query($con,$query)){
                     $intention="failed to update data";
                     return $intention;
                 }else{
          $query="select * from user where (user_name='".$username."' or email='".$email."') and password='".$password."';";
        $result=mysqli_query($con,$query);
        if(mysqli_num_rows($result)==0){
            $intention="failed to recognize user";
            return $intention;
        }else{
            $data=mysqli_fetch_assoc($result);
            $_SESSION['id']=$data['id'];
            $_SESSION['fullname']=$data['full_name'];
            $_SESSION['username']=$data['user_name'];
            $_SESSION['email']=$data['email'];
            $_SESSION['gender']=$data['gender'];
            $_SESSION['description']=$data['description'];
            $_SESSION['reg_date']=$data['date_regeist'];
            $_SESSION['birth_date']=$data['date_of_birth'];
            $_SESSION['facebook']=$data['facebook'];
            $_SESSION['twitter']=$data['twitter'];
            $_SESSION['instagram']=$data['instagram'];
            $_SESSION['address']=$data['address'];
            $_SESSION['phone']=$data['phone'];
            $_SESSION['avatar']=$data['avatar'];
            $_SESSION['role']=$data['role'];
        } 
                     return 1;
                 }  
             }else{
                $query1="select * from user where email='".$email."';";
                 $result1=mysqli_query($con,$query1);
                 if(mysqli_num_rows($result1)>0){
                $intention="this email is already exist";
                return $intention;
             }
                $query1="select * from user where user_name='".$username."';";
                 $result1=mysqli_query($con,$query1);
                 if(mysqli_num_rows($result1)>0){
                $intention="this user name is already exist";
                return $intention;
             }else{
                 $query="UPDATE user SET 
                 full_name='$fullname'
                 ,email='$email'
                ,user_name='$username' 
                ,gender='$gender'
                ,address='$address'
                ,phone='$phone'
                ,password='$password'
                ,date_of_birth='$date_of_birth'
                ,description='$description'
                ,avatar='$dest' where id='".$_SESSION['id']."';";
                 if(!mysqli_query($con,$query)){
                $intention="failed to update data";
                return $intention;
                 }
                     else{      
        $query="select * from user where user_name='".$username."';";
        $result=mysqli_query($con,$query);
        if(mysqli_num_rows($result)==0){
            $intention="failed to recognize user";
            return $intention;
        }else{
            $data=mysqli_fetch_assoc($result);
            $_SESSION['id']=$data['id'];
            $_SESSION['fullname']=$data['full_name'];
            $_SESSION['username']=$data['user_name'];
            $_SESSION['email']=$data['email'];
            $_SESSION['gender']=$data['gender'];
            $_SESSION['description']=$data['description'];
            $_SESSION['reg_date']=$data['date_regeist'];
            $_SESSION['birth_date']=$data['date_of_birth'];
            $_SESSION['facebook']=$data['facebook'];
            $_SESSION['twitter']=$data['twitter'];
            $_SESSION['instagram']=$data['instagram'];
            $_SESSION['address']=$data['address'];
            $_SESSION['phone']=$data['phone'];
            $_SESSION['avatar']=$data['avatar'];
            $_SESSION['role']=$data['role'];
        }   
                     return 1;
                 }  
                 }
        }
           }
        }
    }
}
function remove(){
   $con=connect();
    if($con==null){
        $intention="falied in connection ";
        return $intention;
    }else{
    $query="DELETE FROM USER WHERE id='".$_SESSION['id']."';";
        if(!mysqli_query($con,$query)){
            $intention="failed to recognize user";
            return $intention;
        }else
        {
             $intention=1;
            return $intention;
        }
    }
}
function prepareForCreatePost(){
$post_title=strip_tags($_POST['post_title']);
$post=strip_tags(($_POST['post']));
$post_date=date("Y/m/d");
$dest="img/posts/";
$desc = substr($post,0,50); 
$category=$_POST['post_category'];
    
    if(empty($post_title)){
        $intention="please , enter the title of the post";
        return $intention;
    }elseif(empty($post)){
        $intention="please , enter your post";
        return $intention;
    }elseif(empty($_POST['post_category'])){
        $intention="please , select the category";
        return $intention;
    }
    else{
        if($_FILES['post_image']['size']>0){
        $name=$_FILES['post_image']['name'];
        $src=$_FILES['post_image']['tmp_name'];
        $size=$_FILES['post_image']['size'];
        
        $extension=explode('.',$name);
        $extension=end($extension);
        $extension=strtolower($extension);
        
        $allow=array('png','jpg','gif','jpge');
        if(in_array($extension,$allow)){
            if($size>2000000){
             $intention="please, choose small img less than 2MB";
            return $intention;
        }else{
               $newname=uniqid('post',false);
               $dest.=$newname.'.'.$extension;
               if(!move_uploaded_file($src,$dest)){
                   $intention="failed to upload image try later";
                   return $intention;
               }else{
                   $rightData=array('title'=>$post_title,'post'=>$post,'cat'=>$category,'img'=>$dest,'date'=>$post_date,'desc'=>$desc);
                   
                  $intention=post($rightData);
                   return $intention;
               }
            }
        }else{
            $intention="please select right image";
            return $intention;
        }

    }else{
       $dest="img/posts/default.png"; $rightData=array('title'=>$post_title,'post'=>$post,'cat'=>$category,'img'=>$dest,'date'=>$post_date,'desc'=>$desc);
        
                    $intention=post($rightData);
                   return $intention;
    }
    
}
}
function post($data){
    $con=connect();
    $query="INSERT INTO post (post_title,post,post_cat,post_author,img,post_date,description,status) VALUES (
     '".$data['title']."'
    ,'".$data['post']."'
    ,'".$data['cat']."'
    ,'".$_SESSION['id']."'
    ,'".$data['img']."'
    ,'".$data['date']."'
    ,'".$data['desc']."'
    ,'suspend')";
    
    if(mysqli_query($con,$query)){
        return 1;
    }else
    {
        return "this post is already exist before";
    }
}
function prepareForUpdatePost(){
$id=$_GET['id'];
$post_title=strip_tags($_POST['post_title']);
$post=strip_tags(($_POST['post']));
$post_date=date("Y/m/d");
$dest="img/posts/";
$desc = substr($post,0,50); 
$category=$_POST['post_category'];
    
    if(empty($post_title)){
        $intention="please , enter the title of the post";
        return $intention;
    }elseif(empty($post)){
        $intention="please , enter your post";
        return $intention;
    }elseif(empty($_POST['post_category'])){
        $intention="please , select the category";
        return $intention;
    }
    else{
        if($_FILES['post_image']['size']>0){
        $name=$_FILES['post_image']['name'];
        $src=$_FILES['post_image']['tmp_name'];
        $size=$_FILES['post_image']['size'];
        
        $extension=explode('.',$name);
        $extension=end($extension);
        $extension=strtolower($extension);
        
        $allow=array('png','jpg','gif','jpge');
        if(in_array($extension,$allow)){
            if($size>2000000){
             $intention="please, choose small img less than 2MB";
            return $intention;
        }else{
               $newname=uniqid('post',false);
               $dest.=$newname.'.'.$extension;
               if(!move_uploaded_file($src,$dest)){
                   $intention="failed to upload image try later";
                   return $intention;
               }else{
                   $rightData=array('title'=>$post_title,'post'=>$post,'cat'=>$category,'img'=>$dest,'date'=>$post_date,'desc'=>$desc,'id'=>$id);
                   
                  $intention=post1($rightData);
                   return $intention;
               }
            }
        }else{
            $intention="please select right image";
            return $intention;
        }

    }else{
            $dest=$_SESSION['post_img'];
$rightData=array('title'=>$post_title,'post'=>$post,'cat'=>$category,'img'=>$dest,'date'=>$post_date,'desc'=>$desc,'id'=>$id);
                    $intention=post1($rightData);
                   return $intention;
    }
    
}
}
function post1($data){
    $con=connect();
    $query="UPDATE  post SET 
    post_title='".$data['title']."'
    ,post='".$data['post']."'
    ,post_cat='".$data['cat']."'
    ,img='".$data['img']."'
    ,post_date='".$data['date']."'
    ,description='".$data['desc']."'
    ,post_date='".$data['date']."'
    ,status='suspend' where post_id=".$data['id'];
    if(mysqli_query($con,$query)){
        return 1;
    }else
    {
        return "this post is already exist before";
    }
}
function comment($data){
    $title=strip_tags($data[0]);
    $comment=strip_tags($data[1]);
    if(empty($title))
        return "Please enter the title";
    if(empty($comment))
        return "please enter the comment";
    $post=$data[2];
    $user=$data[3];
    $status="suspend";
    $date=date("Y/m/d h:i a ");
    global $con;
    $query="insert into comment (post_id,user,comment_title,comment,comment_date,comment_status) values ('$post','$user','$title','$comment','$date','$status')";
    if(mysqli_query($con,$query))
        return 1;
    else{
        return "write the data correctly";
    }
    
}
?>
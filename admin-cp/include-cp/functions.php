<?php
function remove_post($id){
    global $con;
    $query="delete from post where post_id=".$id;
    mysqli_query($con,$query);
}
function edit_post($id){
   header('location:edit-posts.php?id='.$id);
}
function prepareForUpdatePost(){
$id=$_GET['id'];
$post_title=strip_tags($_POST['post_title']);
$post=strip_tags(($_POST['post']));
$post_date=date("Y-M-D");
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
                   
                  $intention=post($rightData);
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
                    $intention=post($rightData);
                   return $intention;
    }
    
}
}
function post($data){
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
function status_post($id){
    global $con;
    $query="select * from post where post_id=".$id;
    $result=mysqli_query($con,$query);
    $row=mysqli_fetch_assoc($result);
    if($row['status']=="suspend"){
        //$new="posted";
        $query2="update post set status='posted' where post_id=".$id;
        mysqli_query($con,$query2);
    }else{
        //$new="suspend";
        $query2="update post set status='suspend' where post_id=".$id;
        mysqli_query($con,$query2);
    }
}
function status_user($id){
  $con=connect();
    $query="select * from user where id=".$id;
    $result=mysqli_query($con,$query);
    $row=mysqli_fetch_assoc($result);
    if($row['status']=="working"){
        //$new="posted";
        $query2="update user set status='stoped' where id=".$id;
        mysqli_query($con,$query2);
    }else{
        //$new="suspend";
        $query2="update user set status='working' where id=".$id;
        mysqli_query($con,$query2);
    }  
}
function remove_user($id){
     global $con;
    $query="delete from user where id=".$id;
    mysqli_query($con,$query);
}
function viewdata($id){
    global $con;
    $query="select * from user where id=".$id;
    $result=mysqli_query($con,$query);
    if(mysqli_num_rows($result)==0)
       return null;
    else{
        return $result;
    }
    
}
function update_role($id,$role){
    global $con;
    $query="update user set role='".$role."' where id =".$id;
    mysqli_query($con,$query);
}
function edit_comment($id){
header('location:edit-comment.php?id='.$id);
}
function remove_comment($id){
    global $con;
    $query="delete from comment where comment_id =".$id;
    mysqli_query($con,$query);
}
function status_comment($id){
    global $con;
    $query="select comment_status from comment where comment_id=".$id;
    $result=mysqli_query($con,$query);
    $result=mysqli_fetch_assoc($result);
    if($result['comment_status']=="posted"){
    $query="update comment set comment_status='suspend' where comment_id=".$id;
    $result=mysqli_query($con,$query);
    }else{
    $query="update comment set comment_status='posted' where comment_id=".$id;
    $result=mysqli_query($con,$query);
    }
        
}
function update_comment($title,$comment,$id){
    global $con;
    $query="update comment set comment_title='$title',comment='$comment',comment_status='suspend' where comment_id=$id";
    $result=mysqli_query($con,$query);
    if($result)
        return 1;
    else
     return "write the data correctly";
}
?>
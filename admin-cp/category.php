<?php 
 include('include-cp/header.php'); 
 include('include-cp/session.php');
 include('include-cp/sidebar.php'); 
 include('include-cp/navbar.php'); 
?>
<?php
// add data db part
$intention="";
if(isset($_POST['addcat'])){
    $newcat=trim(strip_tags((htmlentities(htmlspecialchars($_POST['catname'],ENT_QUOTES)))));
    if(empty($newcat)){
        $intention="please enter right name and not empty!";
    }else{
        $query="INSERT INTO category (cat_name) VALUES ('".$newcat."')";
        if(mysqli_query($con,$query)){
            $intention=1;
        }else{
            $intention="failed to add this category !";
        }
    }
}
?>
<?php
// update date db part
if(isset($_POST['updatecat'])){
    $newcat=trim(strip_tags((htmlentities(htmlspecialchars($_POST['catname'],ENT_QUOTES)))));
    if(empty($newcat)){
        $intention="please enter right name and not empty!";
    }else{
    $con=connect();
    if($con==null){
        $intention="failed to add !";
    }else{
        $query="update category set cat_name='".$newcat."' where cat_id=".$_SESSION['edit_with_id'];
        if(mysqli_query($con,$query)){
            $intention=1;
        }else{
            $intention="failed to update this category !";
        }
    }
}
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <?php
            $query="SELECT COUNT(cat_name) FROM category";
            $result=mysqli_query($con,$query);
            $data=mysqli_fetch_assoc($result);
        echo '<h4>Categories ( '.$data['COUNT(cat_name)'].' )</h4>';
            ?>
        <div class="table-responsive">  
        <table class="table table-striped">
    <thead>
      <tr>
        <th>Category Id</th>
        <th>Category Name</th>
        <th>Controlers</th>
      </tr>
    </thead>
    <tbody>
        <?php
    // retrive data table
        $query="SELECT * FROM category order by cat_id Desc";
      $result=mysqli_query($con,$query);
        if(mysqli_num_rows($result)==0){
            $intention="No Categories Founded!";
        }else{
            while($data=mysqli_fetch_assoc($result)){
                $id=$data['cat_id'];
                $cat=$data['cat_name'];
                echo ' 
       <tr>
      <th>'.$id.'</th>
      <td>'.$cat.'</td>
      <td>
          <a href="category.php?action=1&id='.$id.'" title="edit category"><i class="fa fa-edit fa-sm"></i></a>
          <a href="category.php?action=2&id='.$id.'" title="remove category"><i class="fa fa-remove fa-sm"></i></a>
          </td>
    </tr>';
            }
        }
      ?>
    </tbody>
  </table>    
</div>  
        </div>
        
      <?php
        // part of update selection
      if(isset($_GET['action']) and $_GET['action']==1 and isset($_GET['id'])):?>
        <div class="col-md-4">
 <div class="card text-white mb-3" >
  <div class="card-header bg-success">update category</div>
  <div class="card-body bg-dark" >
      <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  <div class="form-group">
    <label for="update category" >Category Name</label>
      <?php
      $query="select * from category where cat_id=".$_GET['id'];
      $data=mysqli_fetch_assoc(mysqli_query($con,$query));
      $_SESSION['edit_with_id']=$_GET['id'];
      ?>
  <input type="text" name="catname" class="form-control" id="exampleInputEmail1" value="<?php echo $data['cat_name'] ; ?>">
  </div>
  <button type="submit" name="updatecat" class="btn btn-success">update</button>
      </form>
      </div>
</div>
        </div>
      <?php endif; ?>
      
      <?php
      // part of insert  table to add
      if(! isset($_GET['action'])) :?>
        <div class="col-md-4">
 <div class="card text-white mb-3" >
  <div class="card-header bg-primary">Add category</div>
  <div class="card-body bg-dark" >
      <?php
      if(isset($_POST['addcat'])){
          if($intention==1){
              echo '<div class="alert alert-success" role="alert">added successfully</div>';
          }else{
              echo '<div class="alert alert-danger" role="alert">'.$intention.'</div>';
          }
      }
      ?>
         <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  <div class="form-group">
    <label for="add new category" >Category Name</label>
  <input type="text" name="catname"class="form-control" id="exampleInputEmail1" placeholder="Enter category name">
  </div>
  <button type="submit" name="addcat" class="btn btn-primary">Add</button>
      </form>
        </div>
    </div>
            </div>
      <?php endif; ?>
</div>
    <?php
    // part of remove category
    if(isset($_GET['action']) and $_GET['action']==2 and isset($_GET['id'])):?>
    <?php
    $query="delete from category where cat_id=".$_GET['id'];
    if(!mysqli_query($con,$query)){
        $intention="failed to remove";
    }else{
        echo "<meta http-equiv=\"refresh\" content=\"0;category.php\">";
    }
    ?>
    
    <?php endif; ?>
</div>

<?php
 include('include-cp/footer.php');
?>
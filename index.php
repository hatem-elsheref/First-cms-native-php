<?php
include('include/header.php');
//https://thefreecpanel.com/sing-up-free-cpanel-hosting/
?>

  <header>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <!-- Slide One - Set the background image for this slide in the line below -->
        <div class="carousel-item active" style="background-image: url('img/ss1.jpg')">
          <div class="carousel-caption d-none d-md-block">
            <h3>First Slide</h3>
            <p>This is a description for the first slide.</p>
          </div>
        </div>
        <!-- Slide Two - Set the background image for this slide in the line below -->
        <div class="carousel-item" style="background-image: url('img/ss2.jpg')">
          <div class="carousel-caption d-none d-md-block">
            <h3>Second Slide</h3>
            <p>This is a description for the second slide.</p>
          </div>
        </div>
        <!-- Slide Three - Set the background image for this slide in the line below -->
        <div class="carousel-item" style="background-image: url('img/ss3.jpg')">
          <div class="carousel-caption d-none d-md-block">
            <h3>Third Slide</h3>
            <p>This is a description for the third slide.</p>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </header>

  <!-- Page Content -->
  <div class="container">
    <!-- Portfolio Section -->
    <div class="row">
      <div class="col-md-8">
          <h2>POSTS</h2>
        </div>
          <div class="col-md-4">
          <form class="form-inline md-form mr-auto mb-4" method="get" action="posts-results.php">
  <input class="form-control mr-sm-2" type="text" placeholder="Search" name="q" aria-label="Search">
  <button class="btn btn-outline-warning btn-rounded btn-sm my-0" type="submit">Search</button>
</form>
        </div>
      </div>
    <div class="row">
             <?php
                connect();
                $query="select * from post where status='posted'";
                $result=mysqli_query($con,$query);
                while($data=mysqli_fetch_assoc($result)):?>
            <div class="col-lg-4 col-sm-6 portfolio-item">
        <div class="card h-100">
              <img class="card-img-top" src="<?php echo $data['img']; ?>" style="height:200px;" alt="">
                  <div class="card-body">
                    <h4 class="card-title">
                      <a href="more.php?id=<?php echo $data['post_id']; ?>"><?php echo $data['post_title'] ; ?></a>
                    </h4>
                    <p class="card-text"><?php echo $data['description'] ; ?></p>
                  </div>
                <div class="card-footer">
                   <div class="text-muted">
                        on <?php echo $data['post_date'] ; ?>
                       <?php
                       $query2="select * from user where id=".$data['post_author'];
                       $result2=mysqli_query($con,$query2);
                       $aut="";
                       while($author=mysqli_fetch_assoc($result2)){
                           $aut= $author['user_name'];
                       }
                     
                       ?>
                       
                        by    <a href="posts.php?id=<?php echo $data['post_author']; ?>"><?php echo $aut; ?></a>
                 <a href="more.php?id=<?php echo $data['post_id']; ?>"
                class="btn btn-primary">More</a>
                    </div>
                </div>
            </div>
      </div>
            <?php endwhile; ?>
      </div>
    </div>
    </div>
    <!-- /.row -->


<?php
include('include/footer.php');
?>
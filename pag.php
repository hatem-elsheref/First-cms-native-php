<?php

$con=mysqli_connect("localhost","root","","pag");
if(isset($_GET['page'])){
    $start=($_GET['page']*3)-3;
    $count=3;
    $query="select * from num  limit ".$count." offset ".$start;
    $r=mysqli_query($con,$query);
    while($row=mysqli_fetch_assoc($r)){
        echo $row['num']."<br>";
    }
    
    
}

?>



<?php
$stm="select count(*) from num";
$res=mysqli_query($con,$stm);
$numpages=mysqli_fetch_assoc($res);
$numpages=$numpages['count(*)'];
for($i=1;$i<=ceil($numpages/3);$i++)
echo'<a class="page-link" href="pag.php?page='.$i.'">'.$i.'</a>';

?>


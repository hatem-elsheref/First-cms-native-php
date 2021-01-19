

<?php
if(isset($_GET['aa'])){
    if(isset($_GET['a'])){
        echo $_GET['a'];
    }else{
        echo "off";
    }
}

?>
<form method="get" action="<?php echo $_SERVER['PHP_SELF'];?>">
<input type="checkbox" name="a">
<input type="submit" name="aa">
</form>
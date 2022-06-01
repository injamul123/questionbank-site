<?php
require_once './header.php';
require_once './sidemenu.php';
?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
    <a href="#"><strong><span class="fa fa-dashboard"></span> My Dashboard</strong></a>
    <hr>
    <h3>Welcome <?php echo $_SESSION['user'] ?></h3>

</div>

<?php require_once './footer.php';?>
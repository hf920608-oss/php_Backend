<?php

$category_show_nanv_query = "SELECT * FROM category WHERE status = '1'";
$exec = mysqli_query($con,$category_show_nanv_query);
 
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Asbab - eCommerce HTML5 Templatee</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/core.css">
    <link rel="stylesheet" href="css/shortcode/shortcodes.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/custom.css">
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
</head>

<body>
<div class="wrapper">
<header id="htc__header" class="htc__header__area header--one">
<div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header">
<div class="">
<div class="row">
<div class="menumenu__container clearfix">

<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
<div class="logo">
<a href="index.php"><img src="images/logo/4.png" alt=""></a>
</div>
</div>

<div class="col-md-7 col-lg-8 col-sm-5 col-xs-3">
<nav class="main__menu__nav hidden-xs hidden-sm">
<ul class="main__menu">
<li><a href="index.php">Home</a></li>
<li><a href="contact.php">Contact</a></li>

<?php while($rows = mysqli_fetch_assoc($exec)){ ?>
<li><a href="clothsCategory.php?category_id=<?php echo $rows['id']; ?>">
<?php echo $rows['categoryName']; ?>
</a></li>
<?php } ?>


<?php if(isset($_SESSION['login']) && $_SESSION['login']=="yes"){ ?>
<li><a href="logout.php">Logout</a></li>
<?php }else{ ?>
<li><a href="login.php">Login</a></li>
<?php } ?>
<li><a href="registerFrom.php">Register</a></li>
<li><a href="add_to_cart.php">&#128722;<?php if(isset($_SESSION['cart']) && $_SESSION['cart'] !=''){
    echo count($_SESSION['cart']);
    // header("location:index.php");
}else{
    echo '0';
}

?></a></li>
</ul>
</nav>
</div>

</div>
</div>

<?php
if(isset($_SESSION['user_name']) && $_SESSION['user_name']!=""){
echo '<h4 class="text-center text-primary">Welcome '.$_SESSION['user_name'].'</h4>';
}
?>

<div class="mobile-menu-area visible-xs visible-sm">
<div class="mobile-menu clearfix">
<nav id="mobile_dropdown">
<ul>
<li><a href="index.php">Home</a></li>

<?php
$exec_mobile = mysqli_query($con,$category_show_nanv_query);
while($row = mysqli_fetch_assoc($exec_mobile)){
echo '<li><a href="clothsCategory.php?category_id='.$row['id'].'">'.$row['categoryName'].'</a></li>';
}
?>

<li><a href="cart.php">&#128722; Cart</a></li>

<?php if(isset($_SESSION['login']) && $_SESSION['login']=="yes"){ ?>
<li><a href="logout.php">Logout</a></li>
<?php }else{ ?>
<li><a href="login.php">Login</a></li>
<?php } ?>

<li><a href="contact.php">Contact</a></li>
</ul>
</nav>
</div>
</div>

</div>
</div>
</header>

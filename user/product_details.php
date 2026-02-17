<?php 
       include('config.inc.php');
include('function.inc.php');
include('./shared/header.php');
?>

<?php 

if(isset($_GET['details_id']) && $_GET['details_id'] != ''){
  $productDetialId = get_safe_value($con,$_GET['details_id']);
  $productDetiaQuery = "SELECT product.*,category.categoryName FROM product INNER JOIN category ON product.categories = category.id WHERE product.id = '".$productDetialId."'";
  $exec = mysqli_query($con,$productDetiaQuery);
  $row = mysqli_fetch_assoc($exec);


  
  }
// prx($_SESSION['cart']);

?>

  <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(../imagess/jewellery-parallax.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.php">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <a class="breadcrumb-item" href="clothsCategory.php?category_name=<?php echo $row['categoryName']; ?>"><?php echo $row['categoryName']; ?></a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        


 <!-- Start Product Details Area -->
        <section class="htc__product__details bg__white ptb--100">
            <!-- Start Product Details Top -->
            <div class="htc__product__details__top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
                            <div class="htc__product__details__tab__content">
                                <!-- Start Product Big Images -->
                                <div class="product__big__images">
                                    <div class="portfolio-full-image tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="img-tab-1">
                                            <img src="../imagess/<?php echo $row['productImage'];?> "  alt="full-image">
                                        </div>
                                    </div>
                                </div>
                                <!-- End Product Big Images -->
                                
                            </div>
                        </div>
                        <form method="post" action="add_to_cart.php"> 
                        <div class="col-md-7 col-lg-7 col-sm-12 col-xs-12 smt-40 xmt-40">
                            <div class="ht__product__dtl">

                                <input type="hidden" name="product_id" value="<?php echo $row['id'] ; ?>">
                                <input type="hidden" name="productName" value="<?php echo $row['productName'] ; ?>">
                                <input type="hidden" name="productImage" value="<?php echo $row['productImage'] ; ?>">
                                <input type="hidden" name="productPrice" value="<?php echo $row['productPrice'] ; ?>">
                                <input type="hidden" name="productQuantity" value="<?php echo $row['productQuantity'] ; ?>">
                                
                                <h2><?php echo $row['productName']; ?></h2>
                                <ul  class="pro__prize" style="display:block">
                                    <li class=""style="margin-bottom:5px">Price$<?php echo $row['productPrice'];?></li>
                                    
                                    <li style="margin-bottom:5px">Mrp: $<?php echo $row['productPrice'];?></li>
                                </ul>
                                    <select name="cartQuantity" class="form-control"> 
                                        <?php 
                                        for($i = 1; $i <=$row['productQuantity']; $i++){
                                            echo '<option value="'.$i.'" class="form-control">'.$i.'</option>';
                                      }
                                        ?>
                                </select>
                                <?php 
                                if(isset($_SESSION['login']) && $_SESSION['login'] != ''){
                                    $isLogin = $_SESSION['login'];
                                    if($isLogin === "yes"){
                                        echo '                                <input type="submit" name="addToCart" class="btn btn-primary" value="Add To Cart">';
                                    } 
                                }else {
                                        echo '<p style="color:red;font-weight:bolder;">First Login Then Add To Cart Buttun Enable</p>';
                                    }
                                ?>
                                

                                <li>Product Quantity In Stock: <?php echo $row['productQuantity'];?></li>
                                <p class="pro__info">
                                    <?php echo $row['productShortDescription'];?>
                                </p>
                                <div class="ht__pro__desc">
                                    <div class="sin__desc">
                                        <p><span>Availability:</span> In Stock</p>
                                    </div>
                                    <div class="sin__desc align--left">
                                        <p><span>Categories:</span></p>
                                        <ul class="pro__cat__list">
                                            <li><a href="clothsCategory.php?category_name=<?php echo $row['categoryName']; ?>"><?php echo $row['categoryName'];?>,</a></li>
                                        </ul>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Product Details Top -->
        </section>
        <!-- End Product Details Area -->
        <!-- Start Product Description -->
        <section class="htc__produc__decription bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <!-- Start List And Grid View -->
                        <ul class="pro__details__tab" role="tablist">
                            <li role="presentation" class="description active"><a href="#description" role="tab" data-toggle="tab">description</a></li>
                        </ul>
                        <!-- End List And Grid View -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="ht__pro__details__content">
                            <!-- Start Single Content -->
                            <div role="tabpanel" id="description" class="pro__single__content tab-pane fade in active">
                                <div class="pro__tab__content__inner">
                                    <p><?php echo $row['productDescription'];?></p>
                                </div>
                            </div>
                            <!-- End Single Content -->
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Product Description -->
<?php 
include('./shared/footer.php');
?>
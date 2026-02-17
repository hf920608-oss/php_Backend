<?php 
include('config.inc.php');
include('function.inc.php');
include('./shared/header.php');

// Fetch all categories
$all_categories_query = "SELECT * FROM category";
$exec1 = mysqli_query($con, $all_categories_query);
?>

<?php
while($row1 = mysqli_fetch_assoc($exec1)){
    $category_id = $row1['id'];
    $category_name = $row1['categoryName'];

    // Fetch products for this category
    $products_query = "SELECT product.*, category.categoryName 
                       FROM product 
                       INNER JOIN category ON product.categories = category.id 
                       WHERE category.id = '".$category_id."' AND product.status = '1'
                       ORDER BY product.id";
    $exec2 = mysqli_query($con, $products_query);
?>
<section class="htc__category__area ptb--100">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="section__title--2 text-center mb-4">
                    <h2 class="title__line"><?= htmlspecialchars($category_name) ?></h2>
                </div>
            </div>
        </div>
        <div class="htc__product__container">
            <div class="row">
                <div class="product__list clearfix mt--30">
                    <?php while($row = mysqli_fetch_assoc($exec2)) { ?>
                        <div class="col-md-4 col-lg-3 col-sm-6 col-xs-12 mb-4">
                            <div class="category card shadow-sm">
                                <div class="ht__cat__thumb">
                                    <a href="clothsCategory.php?category_id=<?= $row['id'] ?>">
                                        <img src="../imagess/<?= $row['productImage'] ?>" alt="product images" class="img-fluid product-img">
                                    </a>
                                </div>
                                <div class="fr__hover__info mt-2 text-center">
                                    <ul class="product__action list-unstyled d-flex justify-content-center gap-2 mb-2">
                                        <li><a href="wishlist.html"><i class="icon-heart icons"></i></a></li>
                                        <li><a href="cart.html"><i class="icon-handbag icons"></i></a></li>
                                        <li><a href="#"><i class="icon-shuffle icons"></i></a></li>
                                    </ul>
                                </div>
                                <div class="fr__product__inner text-center">
                                    <h5><a href="clothsCategory.php?category_id=<?= $row['id'] ?>"><?= htmlspecialchars($row['productName']) ?></a></h5>
                                    <ul class="fr__pro__prize list-unstyled d-flex justify-content-center gap-2">
                                        <li class="old__prize">$<?= $row['productPrice'] ?></li>
                                        <li>$25.9</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>

<!-- New Arrivals Section -->
<section class="htc__category__area ptb--100">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="section__title--2 text-center mb-4">
                    <h2 class="title__line">New Arrivals</h2>
                    <p>Check out the latest products added to our store</p>
                </div>
            </div>
        </div>
        <div class="htc__product__container">
            <div class="row">
                <div class="product__list clearfix mt--30">
                    <?php
                    $new_product_query = "SELECT * FROM product WHERE status='1' ORDER BY id DESC LIMIT 6";
                    $exec_new = mysqli_query($con, $new_product_query);
                    while($row = mysqli_fetch_assoc($exec_new)) { ?>
                        <div class="col-md-4 col-lg-3 col-sm-6 col-xs-12 mb-4">
                            <div class="category card shadow-sm">
                                <div class="ht__cat__thumb">
                                    <a href="product_details.php?details_id=<?= $row['id'] ?>">
                                        <img src="../imagess/<?= $row['productImage'] ?>" alt="product images" class="img-fluid product-img">
                                    </a>
                                </div>
                                <div class="fr__hover__info mt-2 text-center">
                                    <ul class="product__action list-unstyled d-flex justify-content-center gap-2 mb-2">
                                        <li><a href="wishlist.html"><i class="icon-heart icons"></i></a></li>
                                        <li><a href="cart.html"><i class="icon-handbag icons"></i></a></li>
                                        <li><a href="#"><i class="icon-shuffle icons"></i></a></li>
                                    </ul>
                                </div>
                                <div class="fr__product__inner text-center">
                                    <h5><a href="product_details.php?details_id=<?= $row['id'] ?>"><?= htmlspecialchars($row['productName']) ?></a></h5>
                                    <ul class="fr__pro__prize list-unstyled d-flex justify-content-center gap-2">
                                        <li class="old__prize">$<?= $row['productPrice'] ?></li>
                                        <li>$25.9</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.product-img {
    width: 100%;
    height: 250px;
    object-fit: cover;
}
.card {
    border-radius: 8px;
    overflow: hidden;
}
.fr__product__inner h5 a {
    text-decoration: none;
    color: #333;
}
.fr__product__inner ul li {
    list-style: none;
}
</style>

<?php 
include('./shared/footer.php');
?>

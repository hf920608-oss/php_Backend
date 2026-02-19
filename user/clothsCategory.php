<?php
include('config.inc.php');
include('function.inc.php');
include('./shared/header.php');


if (isset($_GET['category_id']) && $_GET['category_id'] != '') {
    $category_id = get_safe_value($con, $_GET['category_id']);
    
    }
    $only_Clothes_query = "SELECT product.*, category.categoryName 
                       FROM product 
                       INNER JOIN category ON product.categories = category.id 
                       WHERE category.id = '" . $category_id . "' AND product.status = '1'";
   
$exec1 = mysqli_query($con, $only_Clothes_query);


$first_row = mysqli_fetch_assoc($exec1);
$category_name = $first_row['categoryName'] ?? '';
mysqli_data_seek($exec1, 0);
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
                    <?php while ($row = mysqli_fetch_assoc($exec1)) { ?>
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
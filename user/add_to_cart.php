    <?php
    include('config.inc.php');
    include('function.inc.php');
     if(isset($_SESSION['cart'])){
  if(count($_SESSION['cart']) == 0){
        header("location:index.php");
    } 
     }else{
        $_SESSION['cart'] = array();
     }
  


    include('./shared/header.php');

    ?>

    <?php
    // prx($_SESSION['cart']);
    $cart_quantity;
    $productName;
    if (isset($_POST['addToCart']) && $_POST['addToCart'] != '') {
        $product_id = $_POST['product_id'];
        $total_quantity = $_POST['productQuantity'];
        $cart_quantity = $_POST['cartQuantity'];
        $product_name = $_POST['productName'];
        $productImage = $_POST['productImage'];
        $productPrice = $_POST['productPrice'];

        $_SESSION['product_id'] = $product_id;
        $_SESSION['total_quantity'] = $total_quantity;


        if(isset($_SESSION['cart'])){
            $productsNames = array_column($_SESSION['cart'], 'productName');
        }else{
            $_SESSION['cart'] = array();
            $productsNames = array();
        }
        if (in_array($product_name, $productsNames)) {
            echo "Duplicate name cart is not allowed";
            //  echo $product_name;
        } else {
            $_SESSION['cart'][$product_id] = array('productImage' => $productImage, 'productName' => $product_name, 'productPrice' => $productPrice, 'productQuantity' => $cart_quantity);
            // prx($_SESSION['cart']);
        }
        //     } else {
        //     echo '<script>alert("error")</script>';

        // }
    }
    if (isset($_POST['remove']) && $_POST['remove'] != '' && isset($_GET['key']) && $_GET['key'] != '') {
        $key = $_GET['key'];
        if (isset($_SESSION['cart'][$key])) {
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart'] = array_values($_SESSION['cart']);
            header("location:add_to_cart.php");
            
        }
    }

    //   prx($_SESSION['cart']);
  if(isset($_SESSION['product_id']) && $_SESSION['product_id'] != ''){
                    $product_id = $_SESSION['product_id'];
                }   
    if (isset($_POST['update']) && $_POST['update'] != '' && isset($_GET['key']) && $_GET['key'] != '' && isset($_GET['isEdit']) && $_GET['isEdit'] != '') {
        $key = $_GET['key'];
        $EditMode = $_GET['isEdit'];
        if (isset($_SESSION['cart'][$key])) {
            unset($_SESSION['cart'][$key]);
            if ($EditMode === "yes") {
              
                $product_name = $_POST['product_name'];
                $product_price = $_POST['product_price'];
                $product_image = $_POST['product_image'];
                $updateQuantity = $_POST['updateQuantity'];
      array_values($_SESSION['cart'][$product_id] = array('productImage' => $product_image, 'productName' => $product_name, 'productPrice' => $product_price, 'productQuantity' => $updateQuantity));
                // prx($_SESSION['cart']);
                header("location:add_to_cart.php");
                // prx($_SESSION['cart']);
            }
        }
    }



    ?>

    <!-- cart-main-area start -->
    <div class="cart-main-area ptb--100 bg__white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">

                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">Serial No</th>
                                    <th class="product-thumbnail">products</th>
                                    <th class="product-name">name of products</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal">Total</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                if (isset($_SESSION['cart']) && $_SESSION['cart'] != '') {
                                ?>

                                    <?php
                                    $total = 0;
                                    $i = 0;
                                    foreach ($_SESSION['cart'] as $key => $value) {

                                    ?>
                                        <tr>
                                            <form action="add_to_cart.php?key=<?php echo $key; ?>&isEdit=yes" method="post">

                                                <td><?php echo $i = $key + 1; ?></td>
                                                <td class="product-thumbnail"><a href="#"><img src="../imagess/<?php echo $value['productImage']; ?>" alt="product img" /></a></td>
                                                <td class="product-name"><a href="#"><?php echo $value['productName']; ?></a>

                                                </td>
                                                <td class="product-price"><span class="amount"><?php echo $value['productPrice']; ?></span></td>
                                                <td class="product-name">
                                                    <select name="updateQuantity" class="form-control">
                                                        <?php
                                                        for ($i = 1; $i <= $_SESSION['total_quantity']; $i++) { ?>
                                                            <option value="<?php echo $i; ?>" class="form-control"
                                                                <?php
                                                                if ($i == $value['productQuantity']) {
                                                                    echo 'selected';
                                                                }



                                                                ?>><?php echo $i; ?></option>';
                                                        <?php  }
                                                        ?>
                                                    </select>
                                                    <br>
                                                    <button name="update" value="update" class="btn">Update</button>
                                                </td>

                                                <td class="product-subtotal">
                                                    <?php
                                                    echo $value['productPrice'] * $value['productQuantity']; ?>
                                                </td>
                                                <td class="product-remove"><button name="remove" type="submit" value="remove">Remove</button></td>
                                                <input type="hidden" name="product_name" value="<?php echo $value['productName']; ?>">
                                                <input type="hidden" name="product_price" value="<?php echo $value['productPrice']; ?>">
                                                <input type="hidden" name="product_image" value="<?php echo $value['productImage']; ?>">
                                            </form>
                                        </tr>
                                    <?php
                                        $total +=  $value['productPrice'] * $value['productQuantity'];
                                    } ?>


                                <?php        }
                                ?>

                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <?php
                        echo '<p> All Total </p>';
                        echo $total;
                        ?>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="buttons-cart--inner">
                                <div class="buttons-cart">
                                    <a href="#">Continue Shopping</a>
                                </div>
                                <div class="buttons-cart checkout--btn">
                                    <a href="#">update</a>
                                    <a href="checkout.php">checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- cart-main-area end -->

    <?php
    include('./shared/footer.php');
    ?>
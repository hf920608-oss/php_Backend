<?php


include('config.inc.php');
include('function.inc.php');


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}


if (count($_SESSION['cart']) == 0 && !isset($_POST['addToCart'])) {
    header("location:index.php");
    exit();
}


include('./shared/header.php');

?>

<?php

if (isset($_POST['addToCart'])) {
    $product_id = $_POST['product_id'];

    $total_quantity_available = (int)$_POST['productQuantity']; 
    $cart_quantity = (int)$_POST['cartQuantity'];
    $product_name = $_POST['productName'];
    $productImage = $_POST['productImage'];
    $productPrice = (float)$_POST['productPrice'];

    if ($product_id <= 0 || $cart_quantity <= 0 || $cart_quantity > $total_quantity_available) {
     
        echo "<script>alert('Invalid quantity or product ID.')</script>";

    } else {
    
        if (isset($_SESSION['cart'][$product_id])) {

            $_SESSION['cart'][$product_id]['productQuantity'] += $cart_quantity;

       
            if ($_SESSION['cart'][$product_id]['productQuantity'] > $total_quantity_available) {
                $_SESSION['cart'][$product_id]['productQuantity'] = $total_quantity_available;

            }
        } else {
       
            $_SESSION['cart'][$product_id] = array(
                'productImage'      => $productImage,
                'productName'       => $product_name,
                'productPrice'      => $productPrice,
                'productQuantity'   => $cart_quantity, 
                'total_quantity'    => $total_quantity_available 
            );
        }
    }
  
    header("location:add_to_cart.php");
    exit();
}


if (isset($_POST['remove']) && isset($_GET['key'])) {
    $key = $_GET['key']; 
    if (isset($_SESSION['cart'][$key])) {
        unset($_SESSION['cart'][$key]);
   
        header("location:add_to_cart.php");
        exit();
}

}
if (isset($_POST['update']) && isset($_GET['key'])) {
    $key = $_GET['key']; 
}
   
    if (isset($_SESSION['cart'][$key])) {
       
        $updateQuantity = (int)$_POST['updateQuantity'];
        $max_available_quantity = (int)$_SESSION['cart'][$key]['total_quantity']; 

  
        if ($updateQuantity > 0 && $updateQuantity <= $max_available_quantity) {
         
            $_SESSION['cart'][$key]['productQuantity'] = $updateQuantity;
        } else {
          
            echo "<script>alert('Invalid quantity for " . $_SESSION['cart'][$key]['productName'] . ". Max available: " . $max_available_quantity . "')</script>";
        }
    
        header("location:add_to_cart.php");
        exit(); 
}

?>


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
        
                            if (!empty($_SESSION['cart'])) {
                                $total_cart_value = 0;
                                $serial_number = 1;

                                foreach ($_SESSION['cart'] as $key => $value) {
                                
                            ?>
                                    <tr>
                                    
                                        <form action="add_to_cart.php?key=<?php echo htmlspecialchars($key); ?>" method="post">

                                            <td><?php echo $serial_number++; ?></td> 
                                            <td class="product-thumbnail"><a href="#"><img src="../imagess/<?php echo htmlspecialchars($value['productImage']); ?>" alt="product img" /></a></td>
                                            <td class="product-name"><a href="#"><?php echo htmlspecialchars($value['productName']); ?></a></td>
                                            <td class="product-price"><span class="amount"><?php echo number_format($value['productPrice'], 2); ?></span></td>
                                            <td class="product-quantity">
                                                <select name="updateQuantity" class="form-control">
                                                    <?php
                                                 
                                                    $max_qty_for_item = $value['total_quantity']; 
                                                    for ($i = 1; $i <= $max_qty_for_item; $i++) { ?>
                                                        <option value="<?php echo $i; ?>" 
                                                            <?php
                                                            if ($i == $value['productQuantity']) {
                                                                echo 'selected';
                                                            }
                                                            ?>><?php echo $i; ?></option>
                                                    <?php  }
                                                    ?>
                                                </select>
                                                <br>
                                                <button name="update" value="update" class="btn">Update</button>
                                            </td>

                                            <td class="product-subtotal">
                                                <?php
                                                $item_total = $value['productPrice'] * $value['productQuantity'];
                                                echo number_format($item_total, 2);
                                                $total_cart_value += $item_total;
                                                ?>
                                            </td>
                                            <td class="product-remove"><button name="remove" type="submit" value="remove">Remove</button></td>
                                       
                                        </form>
                                    </tr>
                                <?php
                                }
                            } else {
                          
                                ?>
                                <tr>
                                    <td colspan="7" style="text-align: center;">Your cart is empty.</td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="buttons-cart--inner">
                            <div class="buttons-cart">
                                <a href="index.php">Continue Shopping</a>
                            </div>
                            <div class="buttons-cart checkout--btn">
                         
                                <a href="checkout.php">checkout</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div style="text-align: right; padding-right: 20px;">
                            <h3>Grand Total: <?php echo number_format($total_cart_value, 2); ?></h3>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php
include('./shared/footer.php');
?>

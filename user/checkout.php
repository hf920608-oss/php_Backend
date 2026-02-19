 <?php
    include('config.inc.php');
    include('function.inc.php');
    if(isset($_SESSION['cart']) && $_SESSION['cart'] != ""){

    }else{
        header("location:index.php");
    }
    if (isset($_POST['remove']) && $_POST['remove'] != '' && isset($_GET['key']) && $_GET['key'] != '') {
        $key = $_GET['key'];
        if (isset($_SESSION['cart'][$key])) {
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart'] = array_values($_SESSION['cart']);
            header("location:checkout.php");
        }
    }

    $get_order_status_id = "SELECT * FROM order_status";
    $exec3 = mysqli_query($con,$get_order_status_id);
    $row1 = mysqli_fetch_assoc($exec3);
    // prx($row1);


    $get_user_id = "SELECT * FROM users WHERE email = '" . $_SESSION['email'] . "'";
    $exec = mysqli_query($con, $get_user_id);
    $row = mysqli_fetch_assoc($exec);
    $user_id = $row['id'];

    // order table
    if (isset($_SESSION['cart']) && $_SESSION['cart'] != '') {
        $totalAmount = 0;

        foreach ($_SESSION['cart'] as $key => $value) {
            $totalAmount += $value['productPrice'] * $value['productQuantity'];
        }
    }

    if (isset($_POST['submit']) && $_POST['submit'] != '') {
        $address;
        $city;
        $pincode;
        $payment;
        $address;
        $error = "no";
        $msg = "";
        $address = get_safe_value($con, $_POST['address']);
        $city = get_safe_value($con, $_POST['city']);
        $pincode = get_safe_value($con, $_POST['pincode']);
        $payment = get_safe_value($con, $_POST['payment']);

        if ($address == "") {
            $error = "yes";
            $msg = "blank field quit not allowed";
        } else if ($city == "") {
            $error = "yes";
            $msg = "blank field quit not allowed";
        } else if ($pincode == "") {
            $error = "yes";
            $msg = "blank field quit not allowed";
        } else if ($payment == "") {
            $error = "yes";
            $msg = "blank field quit not allowed";
        } else {
            $error = "no";
        }
        if ($error == "no") {
            
                      $date = date('Y-m-d H:i:s');
            $order = "INSERT INTO orders(user_id,`address`,city,pinCode,pymentType,totalAmount,paymentStatus,orderStatus,addedOn) VALUES('" . $user_id . "','" . $address . "','" . $city . "','" . $pincode . "','" . $payment . "','" . $totalAmount . "','pending','".$row1['id']."','" . $date . "')";
            $exec1 = mysqli_query($con, $order);
            $order_id = mysqli_insert_id($con);
            // prx($order_id);
            if (isset($_SESSION['cart']) && $_SESSION['cart'] != '') {
          
                foreach ($_SESSION['cart'] as $key => $value) {
                    $order_details = "INSERT INTO order_details(order_id,product_id,qty,price,addedOn) VALUES('".$order_id."','".$key."','".$value['productQuantity']."','".$value['productPrice']."','".$date."')";
                    $exec2 = mysqli_query($con,$order_details);
                    // prx($exec2);
                   
                }
            }
            // unset($_SESSION['cart']);   

             if($payment != "payp"){
            header("location:usersOrder.php");
             }else{
              header("location:payment.php");
             }
      
        }
    }


    // prx($user_id);

    include('./shared/header.php');

    ?>

 <div class="shopping__cart">
     <?php
        if ($msg != '') {
            echo '<p class="text-danger">' . $msg . '</p>';
        }
        ?>
     <div class="shopping__cart__inner">
         <div class="offsetmenu__close__btn">
             <a href="#"><i class="zmdi zmdi-close"></i></a>
         </div>
         <div class="shp__cart__wrap">
             <div class="shp__single__product">
                 <div class="shp__pro__thumb">
                     <a href="#">
                         <img src="images/product-2/sm-smg/1.jpg" alt="product images">
                     </a>
                 </div>
                 <div class="shp__pro__details">
                     <h2><a href="product-details.html">BO&Play Wireless Speaker</a></h2>
                     <span class="quantity">QTY: 1</span>
                     <span class="shp__price">$105.00</span>
                 </div>
                 <div class="remove__btn">
                     <a href="#" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
                 </div>
             </div>
             <div class="shp__single__product">
                 <div class="shp__pro__thumb">
                     <a href="#">
                         <img src="images/product-2/sm-smg/2.jpg" alt="product images">
                     </a>
                 </div>
                 <div class="shp__pro__details">
                     <h2><a href="product-details.html">Brone Candle</a></h2>
                     <span class="quantity">QTY: 1</span>
                     <span class="shp__price">$25.00</span>
                 </div>
                 <div class="remove__btn">
                     <a href="#" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
                 </div>
             </div>
         </div>
         <ul class="shoping__total">
             <li class="subtotal">Subtotal:</li>
             <li class="total__price">$130.00</li>
         </ul>
         <ul class="shopping__btn">
             <li><a href="cart.html">View Cart</a></li>
             <li class="shp__checkout"><a href="checkout.html">Checkout</a></li>
         </ul>
     </div>
 </div>
 <!-- End Cart Panel -->
 </div>
 <!-- End Offset Wrapper -->
 <!-- Start Bradcaump area -->
 <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/4.jpg) no-repeat scroll center center / cover ;">
     <div class="ht__bradcaump__wrap">
         <div class="container">
             <div class="row">
                 <div class="col-xs-12">
                     <div class="bradcaump__inner">
                         <nav class="bradcaump-inner">
                             <a class="breadcrumb-item" href="index.html">Home</a>
                             <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                             <span class="breadcrumb-item active">checkout</span>
                         </nav>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- End Bradcaump area -->
 <!-- cart-main-area start -->
 <div class="checkout-wrap ptb--100">
     <div class="container">
         <div class="row">
             <div class="col-md-8">
                 <div class="checkout__inner">
                     <div class="accordion-list">
                         <div class="accordion">

                             <div class="accordion__title">
                                 Address Information
                             </div>
                             <div class="accordion__body">
                                 <div class="bilinfo">
                                     <form action="checkout.php" method="post">
                                         <div class="row">

                                             <div class="col-md-12">
                                                 <div class="single-input">
                                                     <input type="text" name="address" placeholder="Street Address">
                                                 </div>
                                             </div>
                                             <div class="col-md-12">

                                             </div>
                                             <div class="col-md-6">
                                                 <div class="single-input">
                                                     <input type="text" name="city" placeholder="City/State">
                                                 </div>
                                             </div>
                                             <div class="col-md-6">
                                                 <div class="single-input">
                                                     <input type="text" name="pincode" placeholder="Post code/ zip">
                                                 </div>
                                             </div>
                                             <h1>Payment Information</h1>
                                             Cash on delivery <br>
                                             <input type="radio" name="payment" value="cod"> <br>
                                             Paypal <br>
                                             <input type="radio" name="payment" value="payp"> <br><br>
                                             <input type="submit" name="submit" value="submit">
                                         </div>
                                     </form>
                                 </div>
                             </div>

                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-md-4">
                 <div class="order-details">
                     <h5 class="order-details__title">Your Order</h5>

                     <?php
                        if (isset($_SESSION['cart']) && $_SESSION['cart'] != '') {
                            $total = 0;

                            foreach ($_SESSION['cart'] as $key => $value) {
                                echo ' 
                                     <form action="checkout.php?key=' . $key . '" method="post">
                                    <div class="order-details__item">
                                <div class="single-item">
                                    <div class="single-item__thumb">
                                        <img src="../imagess/' . $value['productImage'] . '" alt="ordered item">
                                    </div>
                                    <div class="single-item__content">
                                        <a href="#">' . $value['productName'] . '</a>
                                        <span class="price">' . $value['productPrice'] . '</span>
                                    </div>
                                    <div class="single-item__remove"><button name="remove" value="remove"><i class="zmdi zmdi-delete"></i></button>
                                    </div>
                                </div>
                           </div>
                                </form>
                                ';
                                $total += $value['productPrice'] * $value['productQuantity'];
                            }
                        }
                        ?>

                     <div class="ordre-details__total">
                         <h5>Order total</h5>
                         <span class="price"><?php echo $total; ?></span>
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
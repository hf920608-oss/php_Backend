    <?php
    include('./shared/header.php');


    if (isset($_GET['myOrders_id']) && $_GET['myOrders_id'] != '') {
      $myOrders_id = $_GET['myOrders_id'];

      $my_orders = "SELECT product.productName,product.productImage,order_details.qty,order_details.price,
          orders.totalAmount,orders.address,orders.city,orders.pinCode,orders.orderStatus,order_status.name  FROM product INNER JOIN order_details ON product.id = order_details.product_id INNER JOIN orders ON orders.id = order_details.order_id INNER JOIN order_status ON orders.orderStatus = order_status.id WHERE orders.id = '" . $myOrders_id . "'";
      $exec = mysqli_query($con, $my_orders);
      // prx($exec);
      unset($_SESSION['cart']);
    }

    // $get_user_id = "SELECT * FROM users WHERE email = '" . $_SESSION['email'] . "'";
    // $exec2 = mysqli_query($con, $get_user_id);
    // $row2 = mysqli_fetch_assoc($exec2);
    // $user_id = $row2['id'];

    // $order_id = "SELECT * FROM orders WHERE user_id = '".$user_id."'";
    // $exec4 = mysqli_query($con,$order_id);

    // $row = mysqli_fetch_assoc($exec4);

    if (isset($_POST['update_status']) && $_POST['update_status'] != '') {

      $update_status = get_safe_value($con, $_POST['order_status']);
      $myOrders_id =  get_safe_value($con, $_POST['order_id']);
      $update_status_query = "UPDATE orders SET orderStatus = $update_status WHERE id = '" . $myOrders_id . "'";
      $exec3 = mysqli_query($con, $update_status_query);
      // prx($exec3);
      header("location:order_master_details.php?myOrders_id=$myOrders_id");


      // prx($exec);


    }

    ?>
    <div class="container mt-5">

      <div class="card shadow-lg border-0">
        <div class="card-header bg-dark text-white">
          <h4 class="mb-0">Orders List</h4>
        </div>

        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">

              <thead class="table-dark">
                <tr>
                  <th>Product Name</th>
                  <th>Product Image</th>
                  <th>Qty</th>
                  <th>Price</th>
                </tr>
              </thead>

              <tbody>
                <?php
                $total = 0;
                while ($row = mysqli_fetch_assoc($exec)) {
                  echo '
      <tr>
                            <td>' . $row['productName'] . '</td>
                            <td><img src="./imagess/' . $row['productImage'] . '" alt="" style="width:100px; hieght:100px;"></td>
                            <td>' . $row['qty'] . '</td>
                              <td>
                              ' . $row['price'] . '
                            </td>
                        
                        </tr>
';
                  $address = $row['address'];
                  $city = $row['city'];
                  $pinCode = $row['pinCode'];
                  $orderStatus = $row['name'];
                  $total += $row['totalAmount'];
                }

                ?>




              </tbody>
            </table>
            <h3 class="text-center">Total Amount</h3>
            <p class="text-center bg-dark text-light "><?php echo $total; ?></p>
            <h4 class="text-center">Address</h4>
            <p class="text-center bg-dark text-light "><?php echo $address; ?><br> City: <?php echo $city; ?><br>PinCode: <?php echo $pinCode; ?></p>
            <h3 class="text-center">Status</h3>
            <p class="text-center bg-dark text-light "><?php echo $orderStatus; ?></p>
            <form action="" method="post">
              <select name="order_status" class="form-control" id="">
                <?php
                $order_staus_query = "SELECT * FROM order_status";
                $exec1 = mysqli_query($con, $order_staus_query);
                while ($row1 = mysqli_fetch_assoc($exec1)) {
                  echo '<option value="' . $row1['id'] . '">' . $row1['name'] . '</option>';
                }
                ?>
   <input type="hidden" name="order_id" value="<?php echo $myOrders_id; ?>"> 
              </select><br>
              <input type="submit" name="update_status" class="btn" value="Change Status">
            </form>
            <a href="./order_master.php">back</a>

          </div>
        </div>
      </div>

    </div>

    <?php
    include('./shared/footer.php');
    ?>
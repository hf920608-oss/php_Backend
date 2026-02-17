    <?php
   include('./shared/header.php');

    $get_user_id = "SELECT * FROM users WHERE email = '" . $_SESSION['email'] . "'";
    $exec = mysqli_query($con, $get_user_id);
    $row = mysqli_fetch_assoc($exec);
    $user_id = $row['id'];
    
    $order_list = "SELECT orders.*,order_status.name FROM orders INNER JOIN order_status ON orders.orderStatus = order_status.id WHERE user_id = '".$user_id."'";
    $exec1 = mysqli_query($con, $order_list);


    ?>
    <div class="container mt-5">

      <div class="card shadow-lg border-0">
        <div class="card-header bg-dark text-white">
          <h4 class="mb-0">My Orders</h4>
        </div>

        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">

              <thead class="table-dark">
                <tr>
                  <th>Order ID</th>
                  <th>Order Date</th>
                  <th>Address</th>
                  <th>Payment Type</th>
                  <th>Payment Status</th>
                  <th>Order Status</th>
                </tr>
              </thead>

              <tbody>
                <?php

                while ($row = mysqli_fetch_assoc($exec1)) {
                  echo '
      <tr>
                            <td><a href="order_master_details.php?myOrders_id='.$row['id'].'">'.$row['id'].'</a></td>
                            <td>'.$row['addedOn'].'</td>
                            <td>'.$row['address'].','.$row['city'].','.$row['pinCode'].'</td>
                            <td>'.$row['pymentType'].'</td>
                            <td>
                                <span class="badge bg-warning text-dark">'.$row['paymentStatus'].'</span>
                            </td>
                            <td>
                                <span class="badge bg-info text-dark">'.$row['name'].'</span>
                            </td>
                        </tr>
';
                }

                ?>




              </tbody>

            </table>
          </div>
        </div>
      </div>

    </div>

    <?php
 include('./shared/footer.php');
    ?>
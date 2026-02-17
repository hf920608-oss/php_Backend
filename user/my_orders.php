    <?php
    include('config.inc.php');
    include('function.inc.php');

    
    
    include('./shared/header.php');
    
    
        if(isset($_GET['myOrders_id']) && $_GET['myOrders_id'] != ''){
          $myOrders_id = $_GET['myOrders_id'];
          $my_orders = "SELECT product.productName,product.productImage,order_details.qty,order_details.price,
          orders.totalAmount FROM product INNER JOIN order_details ON product.id = order_details.product_id INNER JOIN orders ON orders.id = order_details.order_id WHERE orders.id = '".$myOrders_id."'";
          $exec = mysqli_query($con,$my_orders);
          // prx($exec);
          unset($_SESSION['cart']);
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
                            <td>'.$row['productName'].'</td>
                            <td><img src="../imagess/'.$row['productImage'].'" alt="" style="width:100px; hieght:100px;"></td>
                            <td>'.$row['qty'].'</td>
                              <td>
                              '.$row['price'].'
                            </td>
                        </tr>
';
$total += $row['totalAmount'];
                }

                ?>



          
              </tbody>
            </table>
            <h1 class="text-center">Total Amount</h1>
                      <p class="text-center bg-primary "><?php echo $total; ?></p>
            <a href="./usersOrder.php">back</a>
          </div>
        </div>
      </div>

    </div>

    <?php
    include('./shared/footer.php');
    ?>
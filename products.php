<?php include('./shared/header.php'); ?>
<?php
$msg = '';
$category_name = '';
$categoryId = '';
$productName = '';
$productPrice = '';
$productQuantity = '';
$productMrp = '';
$ProductShortDescription = '';
$productDescription = '';
$prodcutMetaTitle = '';
$prodcutMetaDescription = '';
$productMetaKeyword = '';
$productImage = '';
// $productImage = '';
$all_products_query = "SELECT product.*, category.categoryName
FROM product
INNER JOIN category ON product.categories = category.id
ORDER BY product.id;
";
// prx($all_products_query);
$exec = mysqli_query($con, $all_products_query);
// prx($exec);
// status

if (isset($_GET['id']) && $_GET['id'] != '') {
   $id = get_safe_value($con, $_GET['id']);
   if (isset($_GET['type']) && $_GET['type'] != '') {
      $status = get_safe_value($con, $_GET['type']);
      if ($status == "status") {
         if ($_GET['operation'] === "DeActivate") {
            $activate_query = "UPDATE product SET status = 0 WHERE id =  '" . $id . "'";
            mysqli_query($con, $activate_query);
         } else if ($_GET['operation'] == "Activate") {
            $deactivate_query = "UPDATE product SET status = 1 WHERE id =  '" . $id . "'";
            mysqli_query($con, $deactivate_query);
         }
      }
   }
}

// delete

if (isset($_GET['deleteId']) && $_GET['deleteId'] != '') {
   $delete_id = get_safe_value($con, $_GET['deleteId']);

   $delete_query = "DELETE FROM product WHERE id = '" . $delete_id . "'";
   mysqli_query($con, $delete_query);
   header("location:products.php");
}

// insert and edit and duplicate check

if (isset($_POST['submit']) && $_POST['submit'] != '') {
   $categories = get_safe_value($con, $_POST['categoryId']);
   $productName = get_safe_value($con, $_POST['productName']);
   $productPrice = get_safe_value($con, $_POST['productPrice']);
   $productQuantity = get_safe_value($con, $_POST['productQuantity']);
   $productMrp = get_safe_value($con, $_POST['productMrp']);
   $productImage = $_FILES['productImage'];
   $ProductShortDescription = get_safe_value($con, $_POST['ProductShortDescription']);
   $productDescription = get_safe_value($con, $_POST['productDescription']);
   $prodcutMetaTitle = get_safe_value($con, $_POST['prodcutMetaTitle']);
   $prodcutMetaDescription = get_safe_value($con, $_POST['prodcutMetaDescription']);
   $productMetaKeyword = get_safe_value($con, $_POST['productMetaKeyword']);
   $old_image = get_safe_value($con, $_POST['old_image']);
   $image_name;


   if (isset($_SESSION['Edit_id']) && $_SESSION['Edit_id'] != '') {
      if (!empty($_FILES['productImage']['name'])) {
         $image_name = $productImage['name'];
         $move = move_uploaded_file($productImage['tmp_name'], './imagess/' . $image_name);
      } else {
         $image_name = $old_image;
      }


      $edit_category_id = $_SESSION['Edit_id'];

      $edit_category_query = "UPDATE product SET   categories = '" . $categories . "',productName = '" . $productName . "',productMrp ='" . $productMrp . "',productPrice ='" . $productPrice . "',productQuantity ='" . $productQuantity . "',productImage ='" . $image_name . "',productShortDescription ='" . $ProductShortDescription . "',productDescription ='" . $productDescription . "',productMetaTitle ='" . $prodcutMetaTitle . "',productMetaDescription ='" . $prodcutMetaDescription . "',productKeyword ='" . $productMetaKeyword . "' WHERE id = '" . $edit_category_id . "'";
      // prx($edit_category_query);
      $exec2 = mysqli_query($con, $edit_category_query);
      unset($_SESSION['Edit_id']);
      header("location:products.php");
   } else {
      $duplicate_p_name_check_query = "SELECT * FROM product WHERE productName = '" . $productName . "'";
      $exec3 =  mysqli_query($con, $duplicate_p_name_check_query);
      $check = mysqli_num_rows($exec3);
      if ($check > 0) {
         $msg = "Duplicate name dont allow";
      } else {
         // prx($productImage);
         $image = $productImage['name'];
         $image_type = $productImage['type'];
         $image_size = $productImage['size'];
         if ($image_type == "image/jpeg" || $image_type ==  "image/jpg" || $image_type ==  "image/jpe" || $image_type ==  "image/jfif" || $image_type ==  "image/webp" || $image_type ==  "image/png") {
            if ($image_size < 2000000) {
               $move = move_uploaded_file($productImage['tmp_name'], './imagess/' . $image);

               $insert_query = "INSERT INTO product(categories,productName,productMrp,productPrice,productQuantity,productImage,ProductShortDescription,productDescription,productMetaTitle,productMetaDescription,status,productKeyword) VALUES('" . $categories . "','" . $productName . "','" . $productMrp . "','" . $productPrice . "','" . $productQuantity . "','" . $image . "','" . $ProductShortDescription . "','" . $productDescription . "','" . $prodcutMetaTitle . "','" . $prodcutMetaDescription . "',1,'" . $productMetaKeyword . "')";
               $exec1 = mysqli_query($con, $insert_query);


               header("location:products.php");
            }else{
               $msg = "Image Size allowed less than 2 mb";
            }
         } else{
               $msg = "Image Type allowed Only .jpg, .jpeg, .jpe, .jps,  .webp, .png";
            }
      }
   }
}

?>
<div class="content pb-0">
   <div class="orders">
      <div class="row">
         <div class="col-xl-12">
            <div class="card">
               <div class="card-body">
                  <?php
                  if ($msg != '') {
                     echo '<button class="btn btn-danger">' . $msg . '</button>';
                  }
                  ?>
                  <h4 class="box-title"><a href="add_products.php">Add Products</a></h4>

               </div>
               <div class="card-body--">
                  <div class="table-stats order-table ov-h">
                     <table class="table ">
                        <thead>
                           <tr>
                              <th>ID</th>
                              <th>Categories Name</th>
                              <th>Prodct Name</th>
                              <th>MRp</th>
                              <th>Price</th>
                              <th>Qty</th>
                              <th>Product Image</th>

                              <th>Action</th>

                           </tr>
                        </thead>
                        <tbody>
                           <?php while ($row = mysqli_fetch_assoc($exec)) { ?>
                              <tr>

                                 <td><span class="name"><?php echo $row['id'] ?></span></td>
                                 <td><span class="name"><?php echo $row['categoryName'] ?></span></td>
                                 <td><span class="name"><?php echo $row['productName'] ?></span></td>
                                 <td><span class="name"><?php echo $row['productMrp'] ?></span></td>
                                 <td><span class="name"><?php echo $row['productPrice'] ?></span></td>
                                 <td><span class="name"><?php echo $row['productQuantity'] ?></span></td>
                                 <td><span class="name"><img src="imagess/<?php echo $row['productImage'] ?>" alt=""></span></td>
                                 <td>
                                    <?php if ($row['status'] == 1) {
                                       echo '<span class="badge badge-complete "><a href="?id=' . $row['id'] . '&type=status&operation=DeActivate" class="text-light">Active</a></span>';
                                    } else {
                                       echo '<span class="badge badge-complete bg-danger "><a href="?id=' . $row['id'] . '&type=status&operation=Activate" class="text-light">DeActive</a></span>';
                                    }
                                    echo '<span class="badge badge-complete bg-danger "><a href="?deleteId=' . $row['id'] . '" class="text-light">Delete</a></span>';

                                    echo '<span class="badge badge-complete bg-primary "><a href="add_products.php?EditId=' . $row['id'] . '&edit_mode=yes" class="text-light">Edit</a></span>';
                                    ?>

                                 </td>
                              </tr>
                           <?php } ?>

                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="clearfix"></div>
<!-- footer -->
<?php include('./shared/footer.php'); ?>
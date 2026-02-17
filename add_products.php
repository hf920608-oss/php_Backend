<?php include('./shared/header.php'); ?>
<?php 
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


$Edit_mode = "no";
if(isset($_GET['EditId']) && $_GET['EditId'] != ''){
  if(isset($_GET['edit_mode']) && $_GET['edit_mode'] != ''){
    $Edit_id = get_safe_value($con,$_GET['EditId']);
    $_SESSION['Edit_id'] = $Edit_id;
    $Edit_mode = get_safe_value($con,$_GET['edit_mode']);
    $value_show_query = "SELECT * FROM product WHERE id = '".$Edit_id."'";
    $exec = mysqli_query($con,$value_show_query);
    while($row = mysqli_fetch_assoc($exec)){
$categoryId = $row['categories'];
$productName = $row['productName'];
$productPrice = $row['productPrice'];
$productQuantity = $row['productQuantity'];
$productMrp = $row['productMrp'];
$productImage = $row['productImage'];
$ProductShortDescription = $row['productShortDescription'];
$productDescription = $row['productDescription'];
$prodcutMetaTitle = $row['productMetaTitle'];
$prodcutMetaDescription = $row['productMetaDescription'];
$productMetaKeyword = $row['productKeyword'];
   

      }
      }
      }
      // prx($Edit_mode);
?>
 <div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Categories Form</strong><small> Form</small></div>
                        <form action="products.php" method="post" enctype="multipart/form-data">
                        <div class="card-body card-block">
                           <div class="form-group">
                              <label for="product" class=" form-control-label">Category Name</label>
                              <select name="categoryId" id="" class="form-control">
                                 <?php  
                                 $sql1= "select * from category";
                                 $res = mysqli_query($con,$sql1);
                                 while($row = mysqli_fetch_assoc($res)){
                                    if($row['id'] == $categoryId){
                                    echo '
                                    <option value="'.$row['id'].'" required  selected >'.$row['categoryName'].'</option>
                                    ';
                                    }else{
                                      echo '
                                    <option value="'.$row['id'].'"  >'.$row['categoryName'].'</option>
                                    '; 
                                    }
                                    
                                    }
                                 ?>
                              </select>

                            <label for="product" class=" form-control-label">Product Name</label>
                              <input type="text" name="productName" placeholder="Enter your Product Name" class="form-control" required value="<?php
                           if($Edit_mode == "yes"){
                              echo $productName;
                              // prx($category);
                           }else{
                            echo "";
                           }
                            ?>">
                            <label for="product" class=" form-control-label">Product Price</label>
                              <input type="number" name="productPrice" placeholder="Enter your Product Price" class="form-control" required value="<?php
                           if($Edit_mode == "yes"){
                              echo $productPrice;
                              // prx($category);
                           }else{
                            echo "";
                           }
                            ?>">
                            <label for="product" class=" form-control-label">Product Quantity</label>
                              <input type="number" name="productQuantity" placeholder="Enter your Product Quantity" class="form-control" required value="<?php
                           if($Edit_mode == "yes"){
                              echo $productQuantity;
                              // prx($category);
                           }else{
                            echo "";
                           }
                            ?>">
                            <label for="product" class=" form-control-label">Product MRP</label>
                              <input type="number" name="productMrp" placeholder="Enter your Product MRP" class="form-control" required value="<?php
                           if($Edit_mode == "yes"){
                              echo $productMrp;
                              // prx($category);
                           }else{
                            echo "";
                           }
                            ?>">
                            <label for="product" class=" form-control-label">Product Image</label>
                              <input type="file" name="productImage" placeholder="Enter your Product Image" class="form-control"  <?php
                           if($Edit_mode == "yes"){

                              echo "";
                           }else{
                            echo "required";
                           }
                            ?>
                            >
                            <input type="hidden" name="old_image" value="
                            <?php 
                            echo $productImage;
                            ?>
                            ":>
                            <label for="product" class=" form-control-label">Product Short Description</label>
                              <input type="text" name="ProductShortDescription" placeholder="Enter your Short Description" class="form-control" required value="<?php
                           if($Edit_mode == "yes"){
                              echo $ProductShortDescription;
                              // prx($category);
                           }else{
                            echo "";
                           }
                            ?>">
                            <label for="product" class=" form-control-label">Product Description</label>
                              <input type="text" name="productDescription" placeholder="Enter your Description" class="form-control" required value="<?php
                           if($Edit_mode == "yes"){
                              echo $productDescription;
                              // prx($category);
                           }else{
                            echo "";
                           }
                            ?>">
                            <label for="product" class=" form-control-label">Product Meta Tiltle</label>
                              <input type="text" name="prodcutMetaTitle" placeholder="Enter your Product Meta Tiltle" class="form-control" required value="<?php
                           if($Edit_mode == "yes"){
                              echo $prodcutMetaTitle;
                              // prx($category);
                           }else{
                            echo "";
                           }
                            ?>">
                            <label for="product" class=" form-control-label">Product Meta Description</label>
                              <input type="text" name="prodcutMetaDescription" placeholder="Enter your Product Meta Desccription" class="form-control" required value="<?php
                           if($Edit_mode == "yes"){
                              echo $prodcutMetaDescription;
                              // prx($category);
                           }else{
                            echo "";
                           }
                            ?>">
                            <label for="product" class=" form-control-label">Product Meta Keyword</label>
                              <input type="text" name="productMetaKeyword" placeholder="Enter your Product Meta Keyword" class="form-control" required value="<?php
                           if($Edit_mode == "yes"){
                              echo $productMetaKeyword;
                              // prx($category);
                           }else{
                            echo "";
                           }
                            ?>">
                            </div>
                           <button  type="submit" name="submit" value="submit" class="btn btn-lg btn-info btn-block">
                           <span>Submit</span>
                           </button>
                        </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="clearfix"></div>

  <?php include('./shared/footer.php'); ?>  
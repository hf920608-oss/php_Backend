<?php include('./shared/header.php'); ?>
<?php 

$category;
$Edit_mode = "no";
if(isset($_GET['EditId']) && $_GET['EditId'] != ''){
  if(isset($_GET['edit_mode']) && $_GET['edit_mode'] != ''){
    $Edit_id = get_safe_value($con,$_GET['EditId']);
    $_SESSION['Edit_id'] = $Edit_id;
    $Edit_mode = get_safe_value($con,$_GET['edit_mode']);
    $value_show_query = "SELECT * FROM category WHERE id = '".$Edit_id."'";
    $exec = mysqli_query($con,$value_show_query);
    while($row = mysqli_fetch_assoc($exec)){
      $category = $row['categoryName'];  
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
                        <form action="categories.php" method="post">
                        <div class="card-body card-block">
                           <div class="form-group"><label for="company" class=" form-control-label">Category</label><input type="text" name="category" placeholder="Enter your Category Name" class="form-control" required value="<?php
                           if($Edit_mode == "yes"){
                              echo $category;
                              // prx($category);
                           }else{
                            echo "";
                           }
                            ?>"></div>
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
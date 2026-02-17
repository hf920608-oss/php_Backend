<?php include('./shared/header.php'); ?>
<?php 
$category_name = '';
$msg= '';
// show data

$all_category_query = "SELECT * FROM category";
$exec = mysqli_query($con,$all_category_query);

// status button

if(isset($_GET['id']) && $_GET['id'] != ''){ 
   $id = get_safe_value($con,$_GET['id']);
  if(isset($_GET['type']) && $_GET['type'] != ''){
    $status = get_safe_value($con,$_GET['type']);
    if($status == "status"){
      if($_GET['operation'] === "DeActivate"){
         $activate_query = "UPDATE category SET status = 0 WHERE id =  '".$id."'";
      mysqli_query($con,$activate_query);
      }else if($_GET['operation'] == "Activate"){
         $deactivate_query = "UPDATE category SET status = 1 WHERE id =  '".$id."'";
         mysqli_query($con,$deactivate_query);
      }
    }
  }
}

// delete 

if(isset($_GET['deleteId']) && $_GET['deleteId'] != ''){
   $delete_id = get_safe_value($con,$_GET['deleteId']);

   $delete_query = "DELETE FROM category WHERE id = '".$delete_id."'";
   mysqli_query($con,$delete_query);
   header("location:categories.php");
}


// insert and Update and Duplicate Check;




if(isset($_POST['submit']) && $_POST['submit'] != ''){
   $category_name = get_safe_value($con,$_POST['category']);



      if(isset($_SESSION['Edit_id']) && $_SESSION['Edit_id'] != ''){
             $edit_category_id = $_SESSION['Edit_id'];
              $edit_category_query = "UPDATE category SET categoryName = '".$category_name."' WHERE id = '".$edit_category_id."'";
              mysqli_query($con,$edit_category_query);
          unset($_SESSION['Edit_id']); 
          header("location:categories.php");
            
       }else{
   $dupalicate_query = "SELECT * FROM category WHERE categoryName = '".$category_name."'";
   $exec2 = mysqli_query($con,$dupalicate_query);
     $check = mysqli_num_rows($exec2);
     if($check > 0){
         $msg = "Duplicate data insert not allowed";  
     }else{
                  $insert_query = "INSERT INTO category(categoryName,status) VALUES('".$category_name."',1)";
                  $exec1 = mysqli_query($con,$insert_query);
                header("location:categories.php");

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
                           if($msg != ''){
                              echo '<button class="btn btn-danger">'.$msg.'</button';
                           }
                           ?>
                           <br>
                           <h4 class="box-title"><a href="add_category.php">Add Category</a></h4>
                           
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th>ID</th>
                                       <th>Category Name</th>
                                       <th>Action</th>
                                      
                                  </tr>
                                 </thead>
                                 <tbody>
                                 <?php while($row = mysqli_fetch_assoc($exec)) {?>   
                                 <tr>
                                 
                                       <td><span class="name"><?php echo $row['id'] ?></span></td>
                                       <td><span class="name"><?php echo $row['categoryName']?></span></td>
                                       <td>
                                          <?php if($row['status'] == 1) {
                                                echo '<span class="badge badge-complete "><a href="?id='.$row['id'].'&type=status&operation=DeActivate" class="text-light">Active</a></span>';
                                          }else {
                                                echo '<span class="badge badge-complete bg-danger "><a href="?id='.$row['id'].'&type=status&operation=Activate" class="text-light">DeActive</a></span>';
                                          }
                                            echo '<span class="badge badge-complete bg-danger "><a href="?deleteId='.$row['id'].'" class="text-light">Delete</a></span>';

                                              echo '<span class="badge badge-complete bg-primary "><a href="add_category.php?EditId='.$row['id'].'&edit_mode=yes" class="text-light">Edit</a></span>';
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
     
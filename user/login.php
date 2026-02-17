
        <?php 
        include('config.inc.php');
        include('function.inc.php');
  $error;      
  $msg = ""; 
  $email;
  $password;     
        if(isset($_POST['submit']) && $_POST['submit'] != ''){
          $email = get_safe_value($con,$_POST['email']);
          $password = get_safe_value($con,$_POST['password']);
          // prx($email);

if($email == ""){
 $error = "yes";
}else{
  $error = "no";
}

if($password == ""){
 $error = "yes";
}else{
  $error = "no";
  }

if($error == "yes"){
  $msg = "PLease Fill Field then submit";
  }else if($error == "no"){
      $login_query = "SELECT * FROM users WHERE email = '".$email."' AND password = '".$password."'";
      $exec1 = mysqli_query($con,$login_query);
      $check = mysqli_num_rows($exec1);
      if($check > 0){
        $row1 = mysqli_fetch_assoc($exec1);
        $_SESSION['login'] = "yes";
        $_SESSION['user_name'] = $row1['name'];
        $_SESSION['email'] = $row1['email'];
        header("location:index.php");
        }else{
            $msg = "Email And Password is not Exist";
            header("location:registerFrom.php");
            }
            
            }
            }
            
            if($msg != ''){
                echo '<p class="bg-danger text-dark">'.$msg.'</p>';
                }
                ?>
                <?php 
                
                include('./shared/header.php');
                
                ?>

<section class="htc__contact__area ptb--100 bg__white">
            <div class="container">
              
                <div class="row">
                    <div class="contact-form-wrap mt--60">
                        <div class="col-xs-12">
                            <div class="contact-title">
                                <h2 class="title__line--6">Register Form</h2>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <form id="contact-form" action="" method="post">
                                <div class="single-contact-form">
                                    <div class="contact-box ">
                                       
                                        <input type="email" id="email" name="email" placeholder="Mail*">
                                    </div>
                                </div>
                                <div class="single-contact-form">
                                    <div class="contact-box message">
                                       <input type="password" id="password" name="password" placeholder="Password *">
                                    </div>
                                </div>
                                
                                <div class="contact-btn">
                                    <input type="submit" name="submit" value="Login" class="fv-btn"/>
                                </div>
                            </form>
                            <div class="form-output">
                                <p class="form-messege"></p>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </section>



        <?php 

include('./shared/footer.php');

?>
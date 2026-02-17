
        <?php 
        include('config.inc.php');
include('function.inc.php');
  $error;      
  $msg = ""; 
  $name;
  $email;
  $phone;
  $password;     
        if(isset($_POST['submit']) && $_POST['submit'] != ''){
          $name = get_safe_value($con,$_POST['name']);
          $email = get_safe_value($con,$_POST['email']);
          $phone = get_safe_value($con,$_POST['mobile']);
          $password = get_safe_value($con,$_POST['password']);
          // prx($email);
if($name == ""){
 $error = "yes";
}else{
  $error = "no";
}
if($email == ""){
 $error = "yes";
}else{
  $error = "no";
}
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
  $duplicateEmailChekQuery = "SELECT * FROM users WHERE email = '".$email."'";
  $exec1 = mysqli_query($con,$duplicateEmailChekQuery);
  $check = mysqli_num_rows($exec1);
//   prx($check);
  if($check > 0){
       $msg = "Email Already Exist Please Fill Another Email";
  }else{
    $messageInsertQuery = "INSERT INTO users(name,email,password,contact) VALUES('".$name."','".$email."','".$password."','".$phone."')";
     $exec = mysqli_query($con,$messageInsertQuery);
     header("location:login.php");
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
                                    <div class="contact-box name">
                                        <input type="text" id="name" name="name" placeholder="Your Name*">
                                        <input type="email" id="email" name="email" placeholder="Mail*">
                                    </div>
                                </div>
                                <div class="single-contact-form">
                                    <div class="contact-box message">
                                       <input type="password" id="password" name="password" placeholder="Password *">
                                    </div>
                                </div>
                                <div class="single-contact-form">
                                    <div class="contact-box subject">
                                        <input type="text" id="mobile" name="mobile" placeholder="Mobile Number *">
                                    </div>
                                </div>
                                <div class="contact-btn">
                                    <input type="submit" name="submit" value="Register" class="fv-btn"/>
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
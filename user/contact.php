<?php 
    include('config.inc.php');
include('function.inc.php');
include('./shared/header.php');

?>

        <?php 
  $error;      
  $msg = "";      
        if(isset($_POST['submit']) && $_POST['submit'] != ''){
          $name = get_safe_value($con,$_POST['name']);
          $email = get_safe_value($con,$_POST['email']);
          $phone = get_safe_value($con,$_POST['mobile']);
          $comment = get_safe_value($con,$_POST['comment']);
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
if($comment == ""){
 $error = "yes";
}else{
  $error = "no";
}

if($error == "yes"){
  $msg = "PLease Fill Field then submit";
}else if($error == "no"){
  $duplicateEmailChekQuery = "SELECT * FROM contactus WHERE email = '".$email."'";
  $exec1 = mysqli_query($con,$duplicateEmailChekQuery);
  $check = mysqli_num_rows($exec1);
  if($check > 0){
       $msg = "Email Already Exist Please Fill Another Email";
  }else{
    $messageInsertQuery = "INSERT INTO contactus(name,email,mobile,comment) VALUES('".$name."','".$email."','".$phone."','".$comment."')";
     $exec = mysqli_query($con,$messageInsertQuery);
  }

}
        }
     
        if($msg != ''){
  echo '<p class="bg-danger text-dark">'.$msg.'</p>';
}
        ?>

<section class="htc__contact__area ptb--100 bg__white">
            <div class="container">
              
                <div class="row">
                    <div class="contact-form-wrap mt--60">
                        <div class="col-xs-12">
                            <div class="contact-title">
                                <h2 class="title__line--6">SEND A MAIL</h2>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <form id="contact-form" action="" method="post">
                                <div class="single-contact-form">
                                    <div class="contact-box name">
                                        <input type="text" name="name" placeholder="Your Name*">
                                        <input type="email" name="email" placeholder="Mail*">
                                    </div>
                                </div>
                                <div class="single-contact-form">
                                    <div class="contact-box subject">
                                        <input type="text" name="mobile" placeholder="Mobile Number *">
                                    </div>
                                </div>
                                <div class="single-contact-form">
                                    <div class="contact-box message">
                                        <textarea name="comment" placeholder="Your Message"></textarea>
                                    </div>
                                </div>
                                <div class="contact-btn">
                                    <input type="submit" name="submit" value="Send Message" class="fv-btn"/>
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
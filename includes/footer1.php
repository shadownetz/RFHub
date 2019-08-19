<script src="js/jquery-3.3.1.min.js"></script>
<script src="admin/vendors/sweetalert2/sweetalert2.all.min.js"></script>
<!-- <script src="vendors/BootStrap/js/bootstrap.min.js"></script> -->
<script src="js/script_1.js"></script>
<?php
require_once("init/init_all.php");
if(isset($_POST['user_login'])){
    global $db_init;

    $email = $db_init->escape($_POST ['email']);
    $pass = md5($db_init->escape($_POST ['pass']));
    
    if(!empty($email) && !empty($pass)){
        $result_set = User::login_user($email, $pass);
        if($db_init->num_rows($result_set)==1){
            while($row=$db_init->fetch_array($result_set)){
                if($row['status']=='1'){
                    //ACTIVE ACCOUNT
                    $session->login($row['id']);
                    $_SESSION['location']="users";
                    // header("Location: users/");
                    echo "<script>window.location='users/';</script>";
                }elseif($row['status']=='0'){
                    //ACCOUNT INACTIVE
                    swiss_allert('warning', 'Sorry, your account is not active!', '');
                    die();
                }
            }
        }else{
            swiss_allert('warning', 'Incorrect username or password!', '');
            die();
        }
    }else{
        swiss_allert('warning', 'All fields must be filled correctly!', '');
    }
}
if(isset($_POST['admin_login'])){
    global $db_init;

    $email = $db_init->escape($_POST ['email']);
    $pass = md5($db_init->escape($_POST ['pass']));
    
    if(!empty($email) && !empty($pass)){
        $result_set = User::login_admin($email, $pass);
        if($db_init->num_rows($result_set)==1){
            while($row=$db_init->fetch_array($result_set)){
                $session->login($row['id']);
                $_SESSION['location']="admin";
                // header("Location: admin/");
                    echo "<script>window.location='admin/';</script>";
            }
        }else{
            swiss_allert('warning', 'Incorrect username or pass!', '');
            die();
        }
    }else{
        swiss_allert('warning', 'All fields must be filled correctly!', '');
    }
}
if(isset($_POST['user_signup'])){
    global $db_init;
    
    $go = false;
    while($go == false){
        $ref_id = generate_ref_id();
        $query = User::find_sql("SELECT ref_id FROM users WHERE ref_id='$ref_id'");
        if(mysqli_num_rows($query)>0){
            $ref_id = generate_ref_id();
        }else{
            $go = true;
        }
    }
    
    //SETTING ALL THE VALUES TO A VARIABLE
    $ref_id = $ref_id;
    $fname = $db_init->escape(htmlentities($_POST ['fname']));
    $lname = $db_init->escape(htmlentities($_POST ['lname']));
    $email = $db_init->escape(htmlentities($_POST ['email']));
    $phone = $db_init->escape(htmlentities($_POST ['phone']));
    $pass = $db_init->escape(htmlentities($_POST ['pass']));
    $repass = $db_init->escape(htmlentities($_POST ['repass']));

    //CHECKING FOR pass LENGTH LESS THAN 6
    if( strlen($pass) < 6  ){
        //MAKE PUP UP
        swiss_allert('warning', 'password should be greater than six characters', '');
        die();
    }

    //CHECKING IF pass IS THESAME WITH THE SECOND pass FIELD
    if( $pass !=$repass  ){
        //MAKE PUP UP
        swiss_allert('warning', 'passwords do not match', '');
        die();
    }

    //CHECKING IF EMAIL ALREADY REGISTERED
    $confirm_email = User::confirm_email_users($email);
    if($db_init->num_rows($confirm_email)>0){
        //MAKE PUP UP
        swiss_allert('warning', 'Email Address already exist', '');
        die();
    }
    // $confirm_email = User::confirm_email_admins($email);
    // if($db_init->num_rows($confirm_email)>0){
    //     //MAKE PUP UP
    //     swiss_allert('warning', 'Email already exists!', '');
    //     die();
    // }

    //CHECKING IF ALL FIELDS ARE FILLED OUT
    if(empty($ref_id) || empty($fname) ||  empty($lname) || empty($email)){
        //MAKE PUP UP
        swiss_allert('warning', 'All fields must be filled!', '');
        die();
    }else{
        //REGISTERS USER IF EVERY THING IS CORRECT
        $register_user = User::register_user($ref_id, $fname, $lname, $email, $phone, $pass);
        if($register_user){
            swiss_allert('success', 'Registration Successful!', 'login.php');
        }

        /*
        if($register_user){
            // $alert = swiss_allert('success', 'Registration Successful, kindly visit your email address to activate your signup!', 'login.php');
            
            require 'phpmailer/PHPMailerAutoload.php';

            $mail = new PHPMailer();

            $mail->isSMTP();
            $mail->Host = User::get_mailer_host();
            $mail->SMTPSecure = "ssl";
            $mail->Port = 465;
            $mail->SMTPAuth = true;
            $username= User::get_email_address(); 
            $pass2=User::get_email_password();
            $mail->Username = $username; 
            $mail->Password = $pass2;
        
            $mail->setFrom(User::get_email_address(), User::get_company_name());
            $mail->addAddress($email);
            
            $mail->Subject = 'ACCOUNT VERIFICATION';
            $mail ->AddEmbeddedImage('RfLogo.png', 'logoimg');
            $mail->MsgHTML(User::verification_mail_message($pass, $email, $ref_id));
            if ($mail->send())
                swiss_allert('success', 'Registration Successful, kindly visit your email address to activate your signup!', 'login.php');

        }
        */
    }
}
?>
<?php
if(isset($_POST['recorver'])){
    global $db_init;
    
  $f_type = $db_init->escape(htmlentities($_POST ['email']));
  $query = User::find_sql("SELECT id, email, ref_id FROM users WHERE email='{$f_type}' LIMIT 1");
  if($db_init->num_rows($query)>0){
    while($r=$db_init->fetch_array($query)){
        $ref_id=$r['ref_id'];
        $email=$r['email'];
    }
    require 'phpmailer/PHPMailerAutoload.php';

    $mail = new PHPMailer();

    $mail->isSMTP();
    $mail->Host = User::get_mailer_host();
    $mail->SMTPSecure = "ssl";
    $mail->Port = 465;
    $mail->SMTPAuth = true;
    $username= User::get_email_address(); 
    $pass2=User::get_email_password();
    $mail->Username = $username; 
    $mail->Password = $pass2;

    $mail->setFrom(User::get_email_address(), User::get_company_name());
    $mail->addAddress($email);
    $mail->Subject = 'PASSWORD RECOVERY';
    $mail ->AddEmbeddedImage('RfLogo.png', 'logoimg');
    $mail->MsgHTML(User::forgotten_password_message($ref_id, $f_type));

    if ($mail->send()){
        swiss_allert('success', 'Password recovery link sent to your email!', 'index.php');
    }else{
        swiss_allert('warning', 'Check your internet connection and try later', '');
    }
        

    }else{
        swiss_allert('warning', 'No record found on this account!', 'fpass.php');
  }
}
?>
<?php
if(isset($_POST['update_pass'])){
    global $db_init;

    if(isset($_SESSION['ref_id']) && isset($_SESSION['email'])){
      $pass = $db_init->escape(htmlentities($_POST ['pass']));
      $re_pass = $db_init->escape(htmlentities($_POST ['re_pass']));
      if(strlen($pass)<6){
        swiss_allert('warning', 'Password too short, must be greater than 6 characters', '');
        die();
      }
      if($pass != $re_pass){
        swiss_allert('warning', 'The two passwords do not match!', '');
        die();
      }
      $epassword = md5($pass);
      $user_unique_id = $_SESSION['ref_id'];
      $email = $_SESSION['email'];
      $update = User::find_sql("UPDATE users SET pass='{$epassword}' WHERE ref_id = '$user_unique_id' AND email = '{$email}'");
        if($update){
            swiss_allert('success', 'Password Updated Successfully, experience the best from us!', 'login.php');
        }
        /*  
        if($update){
            require 'phpmailer/PHPMailerAutoload.php';

            $mail = new PHPMailer();
        
            $mail->isSMTP();
            $mail->Host = User::get_mailer_host();
            $mail->SMTPSecure = "ssl";
            $mail->Port = 465;
            $mail->SMTPAuth = true;
            $username= User::get_email_address(); 
            $pass2=User::get_email_password();
            $mail->Username = $username; 
            $mail->Password = $pass2;
        
            $mail->setFrom(User::get_email_address(), User::get_company_name());
            $mail->addAddress($email);

            $mail->Subject = 'ACCOUNT AUTHENTICATION SUCCESSFUL';
            $mail ->AddEmbeddedImage('RfLogo.png', 'logoimg');
            $mail->MsgHTML(User::completed_forgotten_password_message($user_unique_id, $pass, $email));
        
            if ($mail->send())
                unset($_SESSION['ref_id']);
                unset($_SESSION['email']);
                swiss_allert('success', 'Password Updated Successfully, experience the best from us!', 'login.php');

            }
    }
    */
    else{
        swiss_allert('warning', 'Session timeout!', 'index.php');
    }
  }
}
  ?>
  <?php

if (isset($_GET['confirm']) && !empty($_GET['confirm'])) {
    $confirm_id = $_GET['confirm'];

    $explode = explode('-', $confirm_id);
    if ($explode && count($explode) == 10) {
        $user_unique_id = $explode[5] . $explode[7] . $explode[9];
        $update_query = User::find_sql("UPDATE users SET status=1 WHERE ref_id = '$user_unique_id'");
        if ($update_query) {
            echo "<script> alert('Account Verification Successful'); window.location='login.php'; </script>";
            //swiss_allert('success', 'Account Verified Successfully!', 'login.php');
        } else {
            echo "<script> alert('Account not found'); window.location='login.php'; </script>";
            //swiss_allert('warning', 'Cannot find this account!', '');
        }
    }
}

if (isset($_GET['recorver']) && !empty($_GET['recorver'])) {
    global $db_init;

    $confirm_id = $_GET['recorver'];
    $explode = explode('-', $confirm_id);
    if ($explode && count($explode) == 10) {
        $user_unique_id = $explode[5] . $explode[7] . $explode[9];
        $query = User::find_sql("SELECT email, ref_id FROM users WHERE ref_id='{$user_unique_id}' LIMIT 1");
        if ($db_init->num_rows($query) == 1) {
            while ($row = $db_init->fetch_array($query)) {
                $email = $row['email'];
                $_SESSION['email'] = $email;
            }
            $_SESSION['ref_id'] = $user_unique_id;
            echo "<script> window.location='repass.php'; </script>";
        } else {
            echo "<script> alert('something went wrong, try again later!'); window.location='index.php'; </script>";
            //swiss_allert('warning', 'something went wrong, try again later!!', 'index.php');
        }
    }
}

?>
</body>
</html>
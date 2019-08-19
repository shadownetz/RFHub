<?php include("includes/header.php"); ?>
<?php
if(empty(isset($_GET['email']))){
    header("location: index.php");
}
if(isset($_POST['send_email'])){
    $email = $_POST['email'];
    $message = $_POST['textarea-input'];
    if(!empty($email) && !empty($message)){
        require '../phpmailer/PHPMailerAutoload.php';

            $mail = new PHPMailer();

            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPSecure = "ssl";
            $mail->Port = 465;
            $mail->SMTPAuth = true;
            $username= User::get_email_address(); 
            $pass2=User::get_email_password();
            $mail->Username = $username; 
            $mail->Password = $pass2;
        
            $mail->setFrom(User::get_email_address(), User::get_company_name());
            $mail->addAddress($email);
            
            $mail->Subject = 'HELPDESK FROM RFHub';
            $mail ->AddEmbeddedImage('RfLogo.png', 'logoimg');
            $mail->MsgHTML(User::helpdesk_mail_message($message));
            if ($mail->send())
                swiss_allert('success', 'Email delivered successfully!', ''); 
    }
}
?>
<?php include("includes/side_nav.php"); ?>

<?php include("includes/head_nav.php"); ?>

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>RFHub</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="index.php">Dashboard</a></li>
                    <li><a href="notifications.php">notifications</a></li>
                    <li><a href="log-noti.php">read alerts</a></li>
                    <li class="active">reply contact message</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<?php
$email = $_GET['email'];
$id = $_GET['id'];
$query = User::find_sql("SELECT email, id FROM contact WHERE id='{$id}' AND email='{$email}'");
if($db_init->num_rows($query)>0){
    while($col=$db_init->fetch_array($query)){
        $email = $col['email'];
    }
}else{
    swiss_allert('warning', 'Session timeout, check your network settings!', '');
    echo "<script>window.location='index.php';</script>";
}
?>

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="ti-email text-danger border-danger"></i></div>
                            <div class="stat-content dib">
                                <div class="stat-text">
                                    Message
                                </div>
                                <div class="stat-digit">Reply Messages</div>
                            </div>
                        </div>
                    </div>
                    <form action="" method="post" class="">
                        <div class="col-lg-6 offset-lg-3 col-md-12">
                            <div class="card-body card-block">

                                <div class="form-group">
                                    <label for="nf-email" class=" form-control-label">Email</label>
                                    <h5><?php echo $email; ?></h5>
                                    <input value="<?php echo $email; ?>" type="hidden" name="email">
                                </div>
                                <div class="form-group">
                                <label for="textarea-input" class=" form-control-label">Message</label>
                                <textarea name="textarea-input" id="textarea-input" rows="9" placeholder="Content..." class="form-control" required></textarea>
                                </div>
                            </div>
                            <div class="card-body text-center">
                                <button type="submit" name="send_email" class="btn btn-primary btn-sm">
                                    <i class="fa fa-send"></i> Send
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer2.php"); ?>
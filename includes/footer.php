<div class="container-fluid rf-foot">
    <div class="row">
        <div class="col-lg-6 col-md-12 block">
            <h5>Contact Us</h5>
            <p>
                <a href="mailto:robfloresglobalinvestment@gmail.com/?subject=Help%20Support" target="_top">
                robfloresglobalinvestment@gmail.com
                </a>
            </p>

        </div>
        <div class="col-lg-6 col-md-12 block">
            <h5>Useful Links</h5>
            <div class="rf-about-alt"><i class="fa fa-info-circle"></i> About Us</div>
        </div>
        <div class="col-lg-12 col-md-12 text-center block ">
            <p> &copy;2019. RFHub. All Rights Reserved.</p>
        </div>
    </div>
</div>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="vendors/BootStrap/js/bootstrap.min.js"></script>
<script src="js/mainscript.js"></script>
<script src="admin/vendors/sweetalert2/sweetalert2.all.min.js"></script>
<?php
if(isset($_POST['send_contact'])){
    global $db_init;
    
    $email = $db_init->escape($_POST['email']);
    $message = $db_init->escape($_POST['message']);
    $phone = $db_init->escape($_POST['phone']);

    if(!empty($email) && !empty($message)){
        $result = send_contact($email,$message, $phone);
        if($result){
            $update_notifications = User::find_sql("INSERT INTO notifications SET user_id=0, type='contact', message='A contact help message has been sent!', sender='anonymous', created=NOW()");
            if($update_notifications){
                swiss_allert('success', 'Message delivered!', '');
            }
        }else{
            swiss_allert('warning', 'Message delivery failed!', '');
        }
    }else{
        swiss_allert('warning', 'All fields must be filled correctly!', '');
    }
}
?>
</body>

</html>
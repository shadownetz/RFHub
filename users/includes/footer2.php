<script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="assets/js/init-scripts/data-table/datatables-init.js"></script>
    <script src="vendors/sweetalert2/sweetalert2.all.min.js"></script>
<?php
require_once('../init/init_all.php');

if(isset($_POST['send_request'])){
    global $db_init;
    $proceed = false;

    $amount = $db_init->escape($_POST['amount']);
    if(!empty($amount)){
        if($amount<1000){
            $check = User::find_sql("SELECT * FROM investments WHERE user_id='{$session->user_id}'");
            if($db_init->num_rows($check)<1){
                swiss_allert('warning', 'Sorry, first investment can not be less than $1000!', '');
                $proceed = false;
            }else{
                $check2 = User::find_sql("SELECT * FROM investments WHERE user_id='{$session->user_id}' AND status=1");
                if($db_init->num_rows($check2)<1){
                    swiss_allert('warning', 'Sorry, because you dont have an approuved investment  you can not invest less than $1000!', '');
                    $proceed = false;
                }else{
                    $proceed = true;
                }
            }
        }else{
            $proceed = true;
        }
    
        if($proceed==true){
            $result = User::find_sql("INSERT INTO investments SET user_id='{$session->user_id}', amount='{$amount}', created=NOW()");
            if($result){
                $update_notifications = User::find_sql("INSERT INTO notifications SET user_id='{$session->user_id}', type='investment', message='An investment request of $$amount has been requested', sender='user', created=NOW()");
                if($update_notifications){
                    swiss_allert('success', 'Request sent. The admin will direct you on how to make payments shortly!', '');
                }
            }
        }
        // else{
        //     swiss_allert('warning', 'Sorry, because you dont have an approuved investment  you can not invest less than $1000!', '');
        // }
       
    }else{
        swiss_allert('warning', 'Sorry, form not filled correctly!', '');
    }
}

if(isset($_POST['withdrawal_request'])){
    global $db_init; 

    $amount = $db_init->escape($_POST['amount']);
    if(!empty($amount)){
        //check balance first
        $query = User::find_sql("SELECT * FROM balance WHERE user_id='{$session->user_id}'");
        if($db_init->num_rows($query)==1){
            while($col=$db_init->fetch_array($query)){
                $user_balance=$col['balance'];
            }
            if($amount>$user_balance){
                swiss_allert('warning', 'Sorry, you do not have sufficient fund!', '');
            }else{
                $result = User::find_sql("INSERT INTO withdrawals SET user_id='{$session->user_id}', amount='{$amount}', created=NOW()");
                if($result){
                    $update_notifications = User::find_sql("INSERT INTO notifications SET user_id='{$session->user_id}', type='withdrawal', message='A withdrawal request of $$amount has been requested', sender='user', created=NOW()");
                    if($update_notifications){
                        swiss_allert('success', 'Request sent, an admin will respond to you shortly!', '');
                    }
                }
            }
        }else{
            swiss_allert('warning', 'Sorry, you do not have any fund!', '');
        }
    }else{
        swiss_allert('warning', 'Sorry, form not filled correctly!', '');
    }
}
?>
</body>

</html>
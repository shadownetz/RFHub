<?php
$user_id = $session->user_id;
$result = User::get_admin_details($user_id);
if ($db_init->num_rows($result)==1) {
    while ($row=$db_init->fetch_array($result)) {
        $fname = $row['fname'];
        $lname = $row['lname'];
        $email = $row['email'];
        $pass = $row['pass'];
        $full_name = $fname." ".$lname;

        // $date_array=string_to_time($last_logged);
        // $ll_date_string = $date_array[0]." | ".$date_array[1];
        // $date_array=string_to_time($created);
        // $created_date_string = $date_array[0];

    }
}
//for unread messages
$check_msgs_q = User::find_sql("SELECT * FROM chat_to_admin WHERE status=0");
$total_msg_counter=0;
if ($db_init->num_rows($check_msgs_q)>0) {
    $total_msg_counter=$db_init->num_rows($check_msgs_q); //HOLDS TOTAL NUMBER OF UNREAD MESSAGES
}
//for pending investments
$check_pending_inv_q = User::find_sql("SELECT * FROM investments WHERE status=0");
$total_pending_inv_counter=0;
if ($db_init->num_rows($check_pending_inv_q)>0) {
    $total_pending_inv_counter=$db_init->num_rows($check_pending_inv_q); //HOLDS TOTAL PENDING INVESTPENTS
}
//for pending withdrawals
$check_pending_withdrawal_q = User::find_sql("SELECT * FROM withdrawals WHERE status=0");
$total_pending_withdrawal_counter=0;
if ($db_init->num_rows($check_pending_withdrawal_q)>0) {
    $total_pending_withdrawal_counter=$db_init->num_rows($check_pending_withdrawal_q); //HOLDS TOTAL PENDING WITHDRAWALS
}
//total notification counter
$total_notification_counter = $total_msg_counter+$total_pending_inv_counter+$total_pending_withdrawal_counter;
//for unread top 3 messages details
$check_msgs_q = User::find_sql("SELECT * FROM chat_to_admin WHERE status=0 ORDER BY id DESC LIMIT 3 ");
if ($db_init->num_rows($check_msgs_q)>0) {
    while ($row=$db_init->fetch_array($check_msgs_q)) {
        $users_ids[]=$row['user_id'];  //HOLDS ARRAY OF USERS IDS
        $msgs_ids[]=$row['id'];         //HOLDS ARRAY OF MESSAGES IDS
            $trunc_msg = wordwrap($row['message'], 20, "[{@}]");
            $exp = explode("[{@}]",$trunc_msg);
        $admin_unred_msgs_array[]=$exp[0]."..."; //HOLDS ARRAY OF MESSAGES
        $admin_unred_msgs_sender_array[]=$row['sender']; //HOLDS ARRAY OF MESSAGES
        $admin_unred_created_array[]=$row['date']; //HOLDS ARRAY OF MESSAGES DATES
        $message_validity_array[] = check_date_time_validity($row['date']);  //HOLDS ARRAY OF DATES VALIDITY
    }
}else{
    $users_ids=array();
}
// for($x=0;$x<count($users_ids);$x++){
//     $user_id = $users_ids[$x];
//     $get_user_picture_q=User::find_sql("SELECT image FROM users WHERE id='{$user_id}'");
//     while($row=$db_init->fetch_array($get_user_picture_q)){
//         $user_profile_pictures[] = "../images/".$row['image'];  //HOLDS ARRAY OF USERS PROFILE PICTURES
//     }
// }
$query = User::find_sql("SELECT id FROM investments");
$total_investments_request = 0;
if($db_init->num_rows($query)>0){
    $total_investments_request = $db_init->num_rows($query);
}

//for total investments
$total_investments=0;
$total_inv_q = User::find_sql("SELECT SUM(amount) AS sum FROM investments WHERE status=1");
if ($db_init->num_rows($total_inv_q)>0) {
    while ($row=$db_init->fetch_array($total_inv_q)) {
        if(empty($row['sum'])){
            $total_investments=0;
        }else{
            $total_investments=$row['sum'];  //HOLDS TOTAL INVESTMENTS SUM
        }
    }
}

$con_investments = 0;
$active = User::find_sql("SELECT status FROM investments WHERE status=1");
if($db_init->num_rows($active)>0){
    $con_investments = $db_init->num_rows($active);
}

$confiremed_investments = 0;
if($total_investments_request!=0){
    $confiremed_investments = ($con_investments/$total_investments_request)*100;
}
//for total withdrawals
$total_withdraw_q = User::find_sql("SELECT SUM(amount) AS sum FROM withdrawals WHERE status=1");
$total_withdrawals=0;
if ($db_init->num_rows($total_withdraw_q)>0) {
    while ($row=$db_init->fetch_array($total_withdraw_q)) {
        if(empty($row['sum'])){
            $total_withdrawals=0;  //HOLDS TOTAL WITHDRAWALS SUM
        }else{
            $total_withdrawals=$row['sum'];  //HOLDS TOTAL WITHDRAWALS SUM
        }
        
    }
}
//for registered users
$check_regs_q = User::find_sql("SELECT id FROM users");
$total_regs_counter=0;
if ($db_init->num_rows($check_regs_q)>0) {
    $total_regs_counter=$db_init->num_rows($check_regs_q); //HOLDS TOTAL NUMBER OF REGISTERED USERS
}
$check_contact_q = User::find_sql("SELECT id FROM contact WHERE status=0");
$total_contact_counter=0;
if ($db_init->num_rows($check_contact_q)>0) {
    $total_contact_counter=$db_init->num_rows($check_contact_q); //HOLDS TOTAL NUMBER OF CONTACT MSGS
}

$query = User::find_sql("SELECT * FROM notifications WHERE sender='user' AND status=0 ORDER BY id DESC");
$total_notifications = 0;
if($db_init->num_rows($query)>0){
    $total_notifications = $db_init->num_rows($query);
}
?>
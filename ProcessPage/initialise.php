<?php
$user_id = $session->user_id;
$result = User::get_user_details($user_id);
if ($db_init->num_rows($result)==1) {
    while ($row=$db_init->fetch_array($result)) {
        $ref_id = $row['ref_id'];
        $fname = $row['fname'];
        $lname = $row['lname'];
        $email = $row['email'];
        $phone = $row['phone'];
        $pass = $row['pass'];
        $status = $row['status'];
        $created = $row['created'];
        $full_name = $fname." ".$lname;
    }
}
$check_msgs_q = User::find_sql("SELECT * FROM chat_from_admin WHERE user_id='{$session->user_id}' AND status=0");
$total_msg_counter=0;
if ($db_init->num_rows($check_msgs_q)>0) {
    $total_msg_counter=$db_init->num_rows($check_msgs_q); //HOLDS TOTAL NUMBER OF UNREAD MESSAGES
}
$check_msgs_q = User::find_sql("SELECT * FROM chat_from_admin WHERE user_id='{$session->user_id}' AND status=0 ORDER BY id DESC LIMIT 3 ");
if ($db_init->num_rows($check_msgs_q)>0) {
    while ($row=$db_init->fetch_array($check_msgs_q)) {
        // $admin_ids[]=$row['id'];  //HOLDS ARRAY OF ADMIN IDS
        $msgs_ids[]=$row['id'];         //HOLDS ARRAY OF MESSAGES IDS
            $trunc_msg = wordwrap($row['message'], 20, "[{@}]");
            $exp = explode("[{@}]",$trunc_msg);
        $user_unred_msgs_array[]=$exp[0]."..."; //HOLDS ARRAY OF MESSAGES
        // $user_unred_created_array[]=$row['created']; //HOLDS ARRAY OF MESSAGES DATES
        // $message_validity_array[] = check_date_time_validity($row['created']);  //HOLDS ARRAY OF DATES VALIDITY
    }
}else{
    // $admin_ids=array();
}
// for($x=0;$x<count($admin_ids);$x++){
//     $admin_id = $admin_ids[$x];
//     $get_admin_picture_q=User::find_sql("SELECT image FROM admins WHERE id='{$admin_id}'");
//     while($row=$db_init->fetch_array($get_admin_picture_q)){
//         $admin_profile_pictures[] = "../images/".$row['image'];  //HOLDS ARRAY OF ADMINS PROFILE PICTURES
//     }
// }

$bonus_q = User::find_sql("SELECT * FROM bonus WHERE user_id='{$session->user_id}'");
If($db_init->num_rows($bonus_q)>0){
    $check_balance_q = User::find_sql("SELECT * FROM balance WHERE user_id='{$session->user_id}' LIMIT 1");
    if ($db_init->num_rows($check_balance_q)>0) {
        while ($col=$db_init->fetch_array($check_balance_q)) {
            $total_cashout = $col['total_cashout'];
            $total_earned = $col['total_earned'];
            $balance = $col['balance'];

        }
    }

    while($row=$db_init->fetch_array($bonus_q)){
        $bonus_id = $row['id'];
        $reg_date = $row['created'];
        $active_status = $row['status'];
        $default_bonus = $row['default_bonus'];
        $main_bonus = $row['main_bonus'];

        // if(empty($row['cashed_out'])){
        //     $cashed_out=0;
        // }else{
        //     $cashed_out = $row['cashed_out'];
        // }

        if($active_status==0){
            $registered = $reg_date;                    //fetch stored datetime from database;
            $today = time();                            //CURRENT datetime
            $interval = $today-strtotime($registered);  //gets the difference datetime format
            $days = floor($interval/86400);             //CONVERTS THE DIFFERENCE TO DAYS
            if($days>7){                                //CHECKING IF DAYS IS GREATHER THAN 7 DAYS
                //activate bonus
                $query = User::find_sql("UPDATE bonus SET status=1, main_bonus='{$default_bonus}' WHERE id='{$bonus_id}'");
            }
        }else{
            //when its already active, it check maturity so as to multiply
            $registered = $reg_date;                    
            $today = time();                             
            $interval = $today-strtotime($registered);
            $days = floor($interval/86400);
            $weeks = floor($days/7);
            // $new_bonus = ($weeks * $default_bonus)-$cashed_out;
            $bonus_new = $weeks * $default_bonus;
            $update_new_bonus = User::find_sql("UPDATE bonus SET main_bonus='{$bonus_new}' WHERE id='{$bonus_id}'");
        }
    }
}

//update earnings
$sum_of_bonus = 0;
$update_earnings = User::find_sql("SELECT SUM(main_bonus) AS main_bonus_sum FROM bonus WHERE user_id='{$session->user_id}'");
if($db_init->num_rows($update_earnings)>0){
    while($col=$db_init->fetch_array($update_earnings)){
        $sum = $col['main_bonus_sum'];
    }
    $update = User::find_sql("UPDATE balance SET total_earned='{$sum}'");
    $sum_of_bonus = $sum; 
}
//update balance
$query_balance = User::find_sql("SELECT * FROM balance WHERE user_id='{$session->user_id}' LIMIT 1");
if($db_init->num_rows($query_balance)==1){
    while($row=$db_init->fetch_array($query_balance)){
        $total_cashout = $row['total_cashout'];
        $total_earned = $row['total_earned'];
        $balance = $total_earned-$total_cashout;
        $update = User::find_sql("UPDATE balance SET balance='{$balance}' WHERE id='{$session->user_id}'");
    }
}

$check_balance_q = User::find_sql("SELECT * FROM balance WHERE user_id='{$session->user_id}' LIMIT 1");
$user_balance='0.00';
if ($db_init->num_rows($check_balance_q)>0) {
    while ($row=$db_init->fetch_array($check_balance_q)) {
        $user_balance=$row['balance'];  //HOLDS USER BALANCE
    }
}
$total_inv_q = User::find_sql("SELECT SUM(amount) AS sum FROM investments WHERE user_id='{$session->user_id}' AND status=1");
$user_total_investments=0;
if ($db_init->num_rows($total_inv_q)>0) {
    while($row=$db_init->fetch_array($total_inv_q)){
        $user_total_investments=$row['sum']; //HOLDS TOTAL SUM OF INVESTMENTS
    }
}

$total_with_q = User::find_sql("SELECT SUM(amount) AS sum FROM withdrawals WHERE user_id='{$session->user_id}' AND status=1");
$user_total_withdrawals=0;
if ($db_init->num_rows($total_with_q)>0) {
    while($row=$db_init->fetch_array($total_with_q)){
        $user_total_withdrawals=$row['sum']; //HOLDS TOTAL SUM OF WITHDRAWALS
    }
}

$total_unread_not_q = User::find_sql("SELECT * FROM notifications WHERE user_id='{$session->user_id}' AND sender='admin' AND status=0");
$user_total_unread_notifications=0;
if ($db_init->num_rows($total_unread_not_q)>0) {
    $user_total_unread_notifications=$db_init->num_rows($total_unread_not_q); //HOLDS TOTAL NUMBER OF INVESTMENTS
}



?>
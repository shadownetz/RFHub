<?php
require_once('../init/init_all.php');
if(isset($_POST['send_message'])){
    global $db_init;

    $message=$db_init->escape($_POST['message']);
    // $user_id=$db_init->escape($_POST['user_id']);
    // $inv_id=$db_init->escape($_POST['inv_id']);
    if(!empty($message)){
        $query = User::find_sql("INSERT INTO chat_to_admin SET sender='user', message='{$message}',user_id='{$session->user_id}', date=NOW()");
    }
    // else{
        // swiss_allert('warning', 'Unable to send message at this time!', '');
    // }
}
?>
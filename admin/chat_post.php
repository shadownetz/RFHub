<?php
require_once('../init/init_all.php');
if(isset($_POST['send_message'])){
    global $db_init;

    $message=$db_init->escape($_POST['message']);
    $user_id=$db_init->escape($_POST['user_id']);
    // $inv_id=$db_init->escape($_POST['inv_id']);
    if(!empty($message) && !empty($user_id)){
        $query = User::find_sql("INSERT INTO chat_from_admin SET sender='admin', message='{$message}',user_id='{$user_id}', date=NOW()");
    }
    // else{
        // swiss_allert('warning', 'Unable to send message at this time!', '');
    // }
}
?>
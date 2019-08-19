    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">

                        <div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <?php if($total_notifications>0){ ?>
                                <span class="count bg-danger"><?php if($total_notifications>3){ echo '3'; }else{ echo $total_notifications; } ?></span>
                                <?php }?>
                                <!-- <?php //if($total_msg_counter>1){ ?>
                                <span class="count bg-danger"><?php //if($total_msg_counter>3){ echo '3'; }else{ echo $total_msg_counter; } ?></span>
                                <?php //}?> -->
                            </button>
                            <div class="dropdown-menu" aria-labelledby="notification">
<?php
    $query = User::find_sql("SELECT * FROM notifications WHERE sender='user' AND status=0 ORDER BY id DESC LIMIT 3");
    // $query = User::find_sql("SELECT * FROM chat_to_admin WHERE sender='user' AND status=0 LIMIT 3");
    if($db_init->num_rows($query)>0){
?>
                                <p class="red">You have <?php if($total_notifications>1){ echo $total_notifications." Nofications";}elseif($total_notifications==1){ echo $total_notifications." Notification"; }else{ echo "No Nofifications"; } ?></p></p>
                                <!-- <p class="red">You have <?php //if($total_msg_counter>1){ echo $total_msg_counter." Nofications";}elseif($total_msg_counter==1){ echo $total_msg_counter." Notification"; }else{ echo "No Nofifications"; } ?></p></p> -->
                                <!-- Notification list -->
<?php
while($row=$db_init->fetch_array($query)){
$message = $row['message'];
?>
                                <a class="dropdown-item media bg-flat-color-1" href="noti-open.php?msg_id=<?php echo $row['id']?>" style="margin-bottom:5px;">
                                    <i class="fa fa-check"></i>
                                    <p><?php echo $message; ?></p>
                                </a>
        <?php } ?>
<?php } ?>
                            <!-- End of notification list -->
                            </div>
                        </div>

                        <div class="dropdown for-message">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="message" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ti-email"></i>
                                <?php if($total_contact_counter>0){ ?>
                                <span class="count bg-primary"><?php echo $total_contact_counter; ?></span>
                                <?php } ?>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="message">
<?php
    // $query = User::find_sql("SELECT * FROM contact WHERE status=0 ORDER BY id DESC LIMIT 3");
    $query = User::find_sql("SELECT X.* FROM (SELECT id, email, id AS user_id, message, created AS date, status FROM contact WHERE status=0 UNION SELECT id, (SELECT CONCAT(fname, ' ', lname) FROM users WHERE id=(user_id)) AS email, user_id, message, date, status FROM chat_to_admin WHERE status=0) X ORDER BY X.date DESC LIMIT 3");
    if($db_init->num_rows($query)>0){
?>
                                <p class="red">You have <?php echo $total_contact_counter; ?> Mail(s)</p>
                                <!-- Mail list goes here -->
<?php
while($row=$db_init->fetch_array($query)){
$checker = explode(' ', $row['email']);
if(count($checker)>1){
    $link = 'chats.php?user_id='.$row['user_id']."&inv_id=0";
}else{
    $link = 'log-noti.php?log_id='.$row['id'];
}
?>
                                <a class="dropdown-item media bg-flat-color-3" href="<?php echo $link; ?>">
                                    <span class="photo media-left"><i class="fa fa-user"></i></span>
                                    <span class="message media-body">
                                        <span class="name float-left"><?php echo $row['email'] ?></span>
                                        <span class="time float-right"><?php echo check_date_time_validity($row['date']) ?> ago</span>
                                        <p><?php echo $row['message']; ?>.</p>
                                    </span>
                                </a>
        <?php } ?>
                                <!-- End of mail list -->
                                <?php if($total_contact_counter>3){ ?>
                                    <a class="dropdown-item media bg-flat-color-3" href="all-users-chat.php">
                                    <span class="photo media-left"><i class="fa fa-user-plus"></i></span>
                                        <span class="message media-body">
                                            <span class="name float-left">+more</span>
                                            <p>read more...</p>
                                        </span>
                                    </a>
                                <?php } ?>
<?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <li class="fa fa-user-md"></li>&nbsp;Admin    
                        <img class="user-avatar rounded-circle" src="images/admin.png" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="?logout"><i class="fa fa-power-off"></i> Logout</a>
                        </div>
                    </div>

                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->
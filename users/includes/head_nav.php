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
                                <?php if($user_total_unread_notifications>0){ ?>
                                <span class="count bg-danger"><?php echo $user_total_unread_notifications; ?></span>
                                <?php } ?>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="notification">
                                <p class="red">You have <?php if($user_total_unread_notifications>1){ echo $user_total_unread_notifications." Nofications";}elseif($user_total_unread_notifications==1){ echo $user_total_unread_notifications." Notification"; }else{ echo "No Nofifications"; } ?></p>
                                <!-- Notification list -->
<?php
    $query = User::find_sql("SELECT * FROM notifications WHERE user_id='{$session->user_id}' AND sender='admin' AND status=0 LIMIT 5");
    if($db_init->num_rows($query)>0){
?>
                                
            <?php
        while($row=$db_init->fetch_array($query)){
            $message = $row['message'];
            ?>
                                <a class="dropdown-item media bg-flat-color-1" href="noti-open.php?msg_id=<?php echo $row['id']; ?>" style="margin-bottom:5px;">
                                    <i class="fa fa-check"></i>
                                    <p><?php echo $message; ?></p>
                                </a>
        <?php } ?>
<?php } ?>
                                <!-- End of notification list -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                    <li class="fa fa-user-md"></li>&nbsp;<?php echo $full_name; ?>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/admin.png" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="?logout"><i class="fa fa-power-off"></i> Logout</a>
                        </div>
                    </div>
                    <div class="user-area dropdown float-right">
                        <i class="fa fa-dollar"></i>&nbsp;[ <?php echo $user_balance; ?> ]&nbsp;
                    </div>

                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->
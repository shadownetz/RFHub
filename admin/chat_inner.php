<?php include("includes/header.php"); ?>
<style>
    #rf-chat-block {
        margin-bottom: 10px;
        max-height: 350px;
        overflow: auto;
    }

    #rf-chat-block .chat-icn {
        height: auto;
        word-wrap: break-word;
        width: 30%;
        padding: 10px;
        border-radius: 20px;
        margin-bottom: 10px;
    }

    @media screen and (min-width:320px) {
        #rf-chat-block .chat-icn {
            width: 50%;
        }
    }

    @media screen and (min-width:1024px) {
        #rf-chat-block .chat-icn {
            width: 30%;
        }
    }

    #rf-chat-block .chat-icn p {
        color: #fff;
    }

    #rf-chat-block .chat-left-block .chat-icn {
        background-color: #3990C9;
    }

    #rf-chat-block .chat-right-block .chat-icn {
        background-color: #0D2143;
    }
</style>
<?php
$user_id = $_GET['user_id'];
$inv_id = $_GET['inv_id'];

$get_user_detatils = User::find_sql("SELECT fname, lname FROM users WHERE id='{$user_id}'");
if($db_init->num_rows($get_user_detatils)>0){
    while($col=$db_init->fetch_array($get_user_detatils)){
        $user_full_name = $col['fname']." ".$col['lname'];
    }
}else{
    $user_full_name = "Anonymous";
}
$get_unread_msgs_query = User::find_sql("SELECT user_id, status  FROM chat_to_admin WHERE user_id='{$user_id}' AND status=0");
$total_unread_messages = 0;
if($db_init->num_rows($get_unread_msgs_query)>0){
    $total_unread_messages = $db_init->num_rows($get_unread_msgs_query);
}
?>
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <section class="card">
                    <div class="twt-feed blue-bg">
                        <div class="corner-ribon black-ribon">
                            <i class="fa fa-twitter"></i>
                        </div>
                        <div class="fa fa-twitter wtt-mark"></div>

                        <div class="media">
                            <a href="#">
                                <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="images/admin.jpg">
                            </a>
                            <div class="media-body">
                                <h2 class="text-white display-6"><?php echo $user_full_name; ?></h2>
                                <p class="text-light">User</p>
                            </div>
                        </div>

                    </div>
                <?php if($total_unread_messages>0){ ?>
                    <div class="weather-category twt-category">
                        <ul>
                            <li class="active">
                                <h5><?php echo $total_unread_messages; ?></h5>
                                Chat(s)
                            </li>
                        </ul>
                    </div>
                <?php } ?>
                    <div class="twt-write col-sm-12">
                    <?php
require_once('../init/init_all.php');
$query = User::find_sql("SELECT X.* FROM (SELECT id, user_id, message, date, status, sender FROM chat_from_admin WHERE user_id='{$user_id}' UNION SELECT id, user_id, message, date, status, sender FROM chat_to_admin WHERE user_id='{$user_id}') X ORDER BY X.date ASC");
if($db_init->num_rows($query)>0){
    $update_status = User::find_sql("UPDATE chat_to_admin SET status=1 WHERE user_id='{$user_id}'")
?>
                        <div class="container-fluid">
                            <div class="row" id="rf-chat-block">
                            <?php
    while($row=$db_init->fetch_array($query)){
        if($row['sender']=='user'){
                            ?>
                                <div class="col-12 js-chat-receive chat-left-block">
                                    <div class="col-12">
                                        <div class="chat-icn pull-left">
                                            <p><i class="fa fa-user"></i>&nbsp;user</p>
                                            <p>
                                                <?php echo $row['message']; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
        <?php }elseif($row['sender']=='admin'){ ?>
                                <div class="col-12 js-chat-sender chat-right-block">
                                    <div class="col-12">
                                        <div class="chat-icn pull-right">
                                            <p><span style="float:right"><i class="fa fa-user"></i>&nbsp;you (admin)</span></p>
                                            <p>
                                                <?php echo $row['message']; ?>
                                            </p>
                                        </div>
                                    </div>
                                    
                                </div>
        <?php 
            } 
        } 
        ?>
                            </div>
                        </div>
<?php } ?>        

<form action="" method="POST" role="form">
                        <div class="row">
                            <div class="col-lg-10 col-md-7">
                            <!-- <input type="hidden" id="inv_id" value="<?php //echo $_GET['inv_id']; ?>"> -->
                            <input type="hidden" id="user_id" value="<?php echo $_GET['user_id']; ?>">
                                <textarea name="message" placeholder="Aa" rows="1" class="form-control t-text-area" id="js-msg-holder" required></textarea>
                            </div>
                            <div class="col-lg-2 col-md-5">
                                <button name="send_message" type="submit" class="btn btn-outline-danger js-chat-snd"><i class="fa fa-send"></i>&nbsp;Send</button>
                            </div>
                        </div>
</form>
                    </div>
                    <footer class="twt-footer">
                    </footer>
                </section>
            </div>

        </div>
    </div>
</div>

<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/rf-js/chat.js"></script>
</body>

</html>
<?php
require_once('../init/init_all.php');
$query = User::find_sql("SELECT X.* FROM (SELECT id, user_id, message, date, status, sender FROM chat_from_admin WHERE user_id = 1 UNION SELECT id, user_id, message, date, status, sender FROM chat_to_admin WHERE user_id = 1) X ORDER BY X.date ASC");
if($db_init->num_rows($query)>0){
?>
                        <div class="container-fluid">
                            <div class="row" id="rf-chat-block">
                            <?php
    while($row=$db_init->fetch_array($query)){
        if($row['sender']=='admin'){
                            ?>
                                <div class="col-12 js-chat-receive chat-left-block">
                                    <div class="col-12">
                                        <div class="chat-icn pull-left">
                                            <p><i class="fa fa-user"></i>&nbsp;admin</p>
                                            <p>
                                                <?php echo $row['message']; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
        <?php }elseif($row['sender']=='user'){ ?>
                                <div class="col-12 js-chat-sender chat-right-block">
                                    <div class="col-12">
                                        <div class="chat-icn pull-right">
                                            <p><span style="float:right"><i class="fa fa-user"></i>&nbsp;you</span></p>
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
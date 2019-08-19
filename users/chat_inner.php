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
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <section class="card">
                    <div class="twt-feed blue-bg" style="min-height:80px;max-height:50px;">
                        <div class="corner-ribon black-ribon">
                            <i class="fa fa-twitter"></i>
                        </div>
                    </div>
                    <div class="twt-write col-sm-12" style="padding-top:20px">
                    <?php
require_once('../init/init_all.php');
$query = User::find_sql("SELECT X.* FROM (SELECT id, user_id, message, date, status, sender FROM chat_from_admin WHERE user_id='{$session->user_id}' UNION SELECT id, user_id, message, date, status, sender FROM chat_to_admin WHERE user_id='{$session->user_id}') X ORDER BY X.date ASC");
if($db_init->num_rows($query)>0){
    $update_status = User::find_sql("UPDATE chat_from_admin SET status=1 WHERE user_id='{$user_id}'")
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

<form action="" method="POST" role="form">
                        <div class="row">
                            <div class="col-lg-10 col-md-7">
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
<script>
// var elmnt = document.getElementById("links");
// elmnt.scrollTop = elmnt.scrollHeight;

// function loadlink(){
//     $('#links').load('chat_loader.php',function () {
//          $(this).unwrap();
//     });
// }

// loadlink(); // This will run on page load
// setInterval(function(){
//     loadlink() // this will run after every 5 seconds
// }, 30000);
</script>
</html>
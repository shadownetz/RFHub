<?php include("includes/header.php"); ?>

<?php include("includes/side_nav.php"); ?>

<?php include("includes/head_nav.php"); ?>

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>RFHub</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="index.php">Dashboard</a></li>
                    <li class="active">Users-Chat</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Message User</strong>
                    </div>
<?php 
$query = User::find_sql("SELECT * FROM users ORDER BY id DESC");
if($db_init->num_rows($query)>0){
?>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Alert</th>
                                    <th>Message</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
    $counter = 1;
    while($row=$db_init->fetch_array($query)){
        $user_id = $row['id'];
        $check_msg_status = User::find_sql("SELECT user_id, status FROM chat_to_admin WHERE user_id='{$user_id}' AND status=0");
        $total_msgs_by_user = 0;
        if($db_init->num_rows($check_msg_status)>0){
            $total_msgs_by_user = $db_init->num_rows($check_msg_status);
        }
                            ?>
                                <tr>
                                    <td><?php echo $counter; ?></td>
                                    <td><?php echo $row['fname']." ".$row['lname']; ?></td>
                                    <?php if($total_msgs_by_user==0){ ?>
                                    <td><i>no new message(s)</i></td>
                                    <?php }else{ ?>
                                        <td><a class="btn btn-info stat stat-txt-info"><i class="fa fa-envelope"></i><i>&nbsp;<?php echo $total_msgs_by_user; ?> new message(s)</i></a></td>
                                    <?php } ?>
                                    <td><a href="chats.php?user_id=<?php echo $row['id']; ?>&inv_id=0" class="btn btn-info stat stat-info-btn">Chat <i class="fa fa-comment"></i></a></td>
                                </tr>
    <?php $counter++; } ?>
                            </tbody>
                        </table>
                    </div>
<?php
 }else{
    echo "<h5>No Registered User at this moment!</h5>";
 } 
 ?>
                </div>
            </div>
        </div>
    </div>
</div>




<?php include("includes/footer2.php"); ?>
<?php include("includes/header.php"); ?>

<?php include("includes/side_nav.php"); ?>

<?php include("includes/head_nav.php"); ?>
<?php 
if(isset($_POST['activate'])){
    global $db_init;

    $inv_id = $db_init->escape($_POST['id']);
    $user_name_id = $db_init->escape($_POST['user_id']);
    $amount = $db_init->escape($_POST['amount']);
    if(!empty($inv_id) && !empty($user_name_id) && !empty($amount)){
        $update_q=User::find_sql("UPDATE investments SET status=1 WHERE id='{$inv_id}'");
        if($update_q){
          $percent = User::get_percent();
          $tr_bonus = $percent*$amount;
          //$insert_id = $db_init->insert_id();
          $insert_q= User::find_sql("INSERT INTO bonus SET user_id='{$user_name_id}', inv_id='{$inv_id}', default_bonus='{$tr_bonus}', main_bonus='0', created=NOW()");
            $get_user_info_q=User::find_sql("SELECT * FROM balance WHERE user_id='{$user_name_id}'");
            if($db_init->num_rows($get_user_info_q)==1){
                while($column=$db_init->fetch_array($get_user_info_q)){
                    $total_inv=$column['total_investsted']+$amount;
                    // $user_balance=$column['balance']+$amount;
                    $credit_q=User::find_sql("UPDATE balance SET total_investsted='{$total_inv}', updated=NOW() WHERE user_id='{$user_id}'");
                }
            }elseif($db_init->num_rows($get_user_info_q)==0){
                $credit_q=User::find_sql("INSERT INTO balance SET user_id='{$user_name_id}', balance='0', total_investsted='{$amount}', total_earned='0', total_cashout='0', updated=NOW()");
            }
            if($credit_q){
                $update_notifications = User::find_sql("INSERT INTO notifications SET user_id='{$user_name_id}', type='c_investment', message='Your investment request has been confirmed', sender='admin', created=NOW()");
                if($update_notifications){
                    swiss_allert('success', 'Updated and Credited Successfully!', '');
                }
            }
        }
    }else{
        swiss_allert('warning', 'Session timeout, check your network settings!', '');
    }
}

?>
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
                    <li class="active">confirm investment</li>
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
                        <strong class="card-title">Investment Requests</strong>
                    </div>
<?php 
$query = User::find_sql("SELECT * FROM investments ORDER BY status ASC");
if($db_init->num_rows($query)>0){
?>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Message</th>
                                    <th>Control</th>
                                    <th><i class="fa fa-calendar"></i>&nbsp;TimeStamp</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
    $counter = 1;
    while($row=$db_init->fetch_array($query)){
        $user_id = $row['user_id'];
        $get_user_names = User::find_sql("SELECT fname, lname, id FROM users WHERE id='{$user_id}' LIMIT 1");
        if($db_init->num_rows($get_user_names)){
            while($col=$db_init->fetch_array($get_user_names)){
                $user_name = $col['fname']." ".$col['lname'];
            }
        }else{
            $user_name = "Anonymous";
        }
        
                            ?>
                                <tr>
                                    <td><?php echo $counter; ?></td>
                                    <td><?php echo $user_name; ?></td>
                                    <td><i class="fa fa-dollar"></i><?php echo $row['amount'] ?></td>
                                    <?php if($row['status']==0){ ?>
                                        <td><a class="btn btn-warning stat stat-txt-warn"><i>Pending...</i></a></td>
                                    <?php }else{ ?>
                                        <td><a class="btn btn-success stat stat-txt-success"><i class="fa fa-check"></i>&nbsp;Confirmed</a></td>
                                    <?php } ?>
                                    <td><a href="chats.php?inv_id=<?php echo $row['id']; ?>&user_id=<?php echo $row['user_id']; ?>" class="btn btn-info stat stat-info-btn">Chat <i class="fa fa-comment"></i></a></td>
                                    <?php if($row['status']==0){ ?>
                                    <form action="" method="post" role="form">
                                        <input type="hidden" name="amount" value="<?php echo $row['amount']; ?>">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                                        <td><button type="submit" name="activate" class="btn btn-success">Confirm</button></td>
                                    </form>
                                    <?php }else{ ?>
                                        <td><i>Confirmed</i></td>
                                    <?php } ?>
                                    <td><?php echo $row['created']; ?></td>
                                </tr>
    <?php $counter++; } ?>
                            </tbody>
                        </table>
                    </div>
<?php
 }else{
    echo "<h5>No investment log at this moment!</h5>";
 } 
 ?>
                </div>
            </div>
        </div>
    </div>
</div>




<?php include("includes/footer2.php"); ?>
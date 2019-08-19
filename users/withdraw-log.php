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
                    <li class="active">Withdrawal Logs</li>
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
                        <strong class="card-title">Withdrawal Logs</strong>
                    </div>
<?php 
$query = User::find_sql("SELECT * FROM withdrawals WHERE user_id='{$session->user_id}'");
if($db_init->num_rows($query)>0){
?>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th><i class="fa fa-calendar"></i>&nbsp;TimeStamp</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
    $counter = 1;
    while($row=$db_init->fetch_array($query)){
        
    
                            ?>
                                <tr>
                                    <td><?php echo $counter; ?></td>
                                    <td>$<?php echo $row['amount']; ?></td>
                                    <?php if($row['status']==0){ ?>
                                        <td><a class="btn btn-warning stat stat-txt-warn"><i>Pending...</i></a></td>
                                    <?php }else{ ?>
                                        <td><a class="btn btn-success stat stat-txt-success"><i class="fa fa-check"></i>&nbsp;Confirmed</a></td>
                                    <?php } ?>
                                    <td><?php echo $row['created']; ?></td>
                                </tr>
    <?php $counter++; } ?>
                            </tbody>
                        </table>
                    </div>
<?php
 }else{
    echo "<h5>No withdrawal log for this account!</h5>";
 } 
 ?>
                </div>
            </div>
        </div>
    </div>
</div>




<?php include("includes/footer2.php"); ?>
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
                    <li class="active">notifications</li>
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
                        <strong class="card-title">All Notifications</strong>
                    </div>
<?php 
$query = User::find_sql("SELECT * FROM notifications WHERE sender='user' ORDER BY id DESC");
if($db_init->num_rows($query)>0){
?>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th><i class="fa fa-calendar-check"></i>&nbsp;TimeStamp</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
    $counter = 1;
    while($row=$db_init->fetch_array($query)){
        $user_id = $row['user_id'];
        $get = User::find_sql("SELECT fname, lname, id FROM users WHERE id='{$user_id}'");
        $user_full_name = "Admin";
        if($db_init->num_rows($get)==1){
            while($col = $db_init->fetch_array($get)){
                $user_full_name = $col['fname']." ".$col['lname'];
            }
        }
                            ?>
                                <tr>
                                    <th><?php echo $counter; ?></th>
                                    <td><?php echo $user_full_name; ?></td>
                                    <td><?php echo $row['created']; ?></td>
                                    <?php if($row['status']==0){ ?>
                                        <td><a class="btn btn-warning stat stat-txt-warn"><i>unread</i></a></td>
                                        <td><a href="noti-open.php?msg_id=<?php echo $row['id'] ?>" class="btn btn-info stat stat-info-btn">Open <i class="fa fa-envelope-o"></i></a></td>
                                    <?php }else{ ?>
                                        <td><a class="btn btn-success stat stat-txt-success"><i class="fa fa-check"></i>&nbsp;read</a></td>
                                        <td><a href="noti-open.php?msg_id=<?php echo $row['id'] ?>" class="btn btn-primary">Re-open <i class="fa fa-envelope-open-o"></i></a></td>
                                    <?php } ?>
                                </tr>
    <?php $counter++; } ?>
                            </tbody>
                        </table>
                    </div>
<?php
 }else{
    echo "<h5>No Notifications at this moment!</h5>";
 } 
 ?>
                </div>
            </div>
        </div>
    </div>
</div>




<?php include("includes/footer2.php"); ?>
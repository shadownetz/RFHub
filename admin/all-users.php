<?php include("includes/header.php"); ?>

<?php include("includes/side_nav.php"); ?>

<?php include("includes/head_nav.php"); ?>
<?php 
if(isset($_GET['activate']) && !empty($_GET['activate'])){
    $id = $_GET['activate'];
    $query = User::find_sql("UPDATE users SET status=1 WHERE id='{$id}'");
    echo "<script>window.location='all-users.php';</script>";
}
if(isset($_GET['deactivate']) && !empty($_GET['deactivate'])){
    $id = $_GET['deactivate'];
    $query = User::find_sql("UPDATE users SET status=0 WHERE id='{$id}'");
    echo "<script>window.location='all-users.php';</script>";
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
                    <li class="active">All Users</li>
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
                        <strong class="card-title">Manage Users</strong>
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
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Date Joined</th>
                                    <th>Status</th>
                                    <th>Control</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
    $counter = 1;
    while($row=$db_init->fetch_array($query)){
                            ?>
                                <tr>
                                    <th><?php echo $counter; ?></th>
                                    <td><?php echo $row['fname']." ".$row['lname']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><i><?php echo $row['phone']; ?></i></td>
                                    <td><?php echo $row['created']; ?></td>
                                    <?php if($row['status']==0){ ?>
                                        <td><a class="btn btn-warning stat stat-txt-warn"><i>Pending...</i></a></td>
                                        <td><a href="?activate=<?php echo $row['id']; ?>" class="btn btn-success">Activate</a></td>
                                    <?php }else{ ?>
                                        <td><a class="btn btn-success stat stat-txt-success"><i class="fa fa-check"></i>&nbsp;Activated</a></td>
                                        <td><a href="?deactivate=<?php echo $row['id']; ?>" class="btn btn-danger">Deactivate</a></td>
                                    <?php } ?>
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
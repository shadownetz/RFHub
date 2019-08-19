<?php include("includes/header.php"); ?>
<?php
// require_once('../init/init_all.php');
if(empty(isset($_GET['log_id']))){
    header("location: contact-log.php");
}
?>
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
                    <li><a href="notifications.php">notifications</a></li>
                    <li class="active">read alerts</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<?php
$log_id = $_GET['log_id'];
$query = User::find_sql("SELECT message, id, email FROM contact WHERE id='{$log_id}'");
if($db_init->num_rows($query)>0){
    while($col=$db_init->fetch_array($query)){
        $message = $col['message'];
        $email = $col['email'];
    }
}
?>
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="ti-user text-danger border-danger"></i></div>
                            <div class="stat-content dib">
                                <div class="stat-text">
                                    Alert
                                    <div class="pull-right"><a href="log-reply.php?email=<?php echo $email; ?>&id=<?php echo $log_id; ?>"><i class="ti-comments-smiley text-warning"></i>&nbsp;Reply</a></div>
                                </div>
                                <div class="stat-digit">Contact Us Messages</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="jumbotron">
                                <?php echo $message ?>.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$query = User::find_sql("UPDATE contact SET status=1 WHERE id='{$log_id}'");
?>
<?php include("includes/footer2.php"); ?>
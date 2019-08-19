<?php include("includes/header.php"); ?> 
<?php
if(empty(isset($_GET['msg_id']))){
    header("location: notifications.php");
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
if(isset($_GET['msg_id']) && !empty($_GET['msg_id'])){
    $msg_id = $_GET['msg_id'];
    $query = User::find_sql("SELECT * FROM notifications WHERE id='{$msg_id}' AND sender='user'");
    if($db_init->num_rows($query)>0){
        while($col=$db_init->fetch_array($query)){
            $message = $col['message'];
            if($col['type']=='investment'){
                $link = 'confirm-invest.php';
            }elseif($col['type']=='withdrawal'){
                $link = 'confirm-withdrawal.php';
            }
        }
    $update = User::find_sql("UPDATE notifications SET status=1 WHERE id='{$msg_id}'");
    }else{
        echo "<script>window.location='notifications.php';</script>";
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
                            <div class="stat-icon dib"><i class="ti-announcement text-danger border-danger"></i></div>
                            <div class="stat-content dib">
                                <div class="stat-text">Alert</div>
                                <div class="stat-digit">Investment Request</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="jumbotron">
                                <?php echo $message; ?>,&nbsp;<wbr>
                                please click on the link to see full requests.<br>
                                <a href="<?php echo $link; ?>">click&nbsp;<i class="ti-hand-point-left text-success"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer2.php"); ?>
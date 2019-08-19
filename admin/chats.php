<?php include("includes/header.php"); ?>
<?php
// require_once('../init/init_all.php');
if(empty(isset($_GET['inv_id'])) || empty(isset($_GET['user_id']))){
    header("location: confirm-invest.php");
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
                    <li class="active">chats</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<iframe src="chat_inner.php?inv_id=<?php echo $_GET['inv_id']; ?>&user_id=<?php echo $_GET['user_id']; ?>" name="rf_chat" style="border:none;width:100%;height:600px;overflow:hidden"></iframe>







<?php include("includes/footer2.php"); ?>
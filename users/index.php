<?php include("includes/header.php"); ?>

<?php include("includes/side_nav.php"); ?>

<?php include("includes/head_nav.php"); ?>

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Dashboard</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">

    <div class="card-group">
        <div class="card col-md-6 no-padding ">
            <div class="card-body">
                <div class="h1 text-muted text-right mb-4">
                    <i class="fa fa-money"></i>
                </div>

                <div class="h4 mb-0">
                <i class="fa fa-dollar"></i>&nbsp; <span class="count"><?php echo $user_total_investments; ?></span>
                </div>

                <small class="text-muted text-uppercase font-weight-bold">Total Investments Made</small>
                <div class="progress progress-xs mt-3 mb-0 bg-flat-color-1" style="width: <?php echo $user_total_investments/1000; ?>%; height: 5px;"></div>
            </div>
        </div>
        <div class="card col-md-6 no-padding ">
            <div class="card-body">
                <div class="h1 text-muted text-right mb-4">
                    <i class="fa fa-dollar"></i>
                </div>
                <div class="h4 mb-0"><i class="fa fa-dollar"></i>&nbsp; 
                    <span class="count"><?php echo $sum_of_bonus; ?></span>
                </div>
                <small class="text-muted text-uppercase font-weight-bold">Total Profit Made</small>
                <div class="progress progress-xs mt-3 mb-0 bg-flat-color-4" style="width: <?php if($sum_of_bonus>100){ echo $sum_of_bonus/100;}else{echo $sum_of_bonus;} ?>%; height: 5px;"></div>
            </div>
        </div>
        <div class="card col-md-6 no-padding ">
            <div class="card-body">
                <div class="h1 text-muted text-right mb-4">
                    <i class="fa fa-dollar"></i>
                </div>
                <div class="h4 mb-0">
                <i class="fa fa-dollar"></i>&nbsp;<span class="count"><?php echo $user_total_withdrawals; ?></span>
                </div>
                <small class="text-muted text-uppercase font-weight-bold">Total Withdrawn Amount</small>
                <div class="progress progress-xs mt-3 mb-0 bg-flat-color-3" style="width: <?php echo $user_total_withdrawals/1000; ?>%; height: 5px;"></div>
            </div>
        </div>
    </div>


</div> <!-- .content -->
</div><!-- /#right-panel -->

<!-- Right Panel -->

<?php include("includes/footer.php"); ?>
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
                    <i class="fa fa-users"></i>
                </div>

                <div class="h4 mb-0">
                    <span class="count"><?php echo $total_regs_counter; ?></span>
                </div>

                <small class="text-muted text-uppercase font-weight-bold">Users</small>
                <div class="progress progress-xs mt-3 mb-0 bg-flat-color-1" style="width: <?php echo $total_regs_counter; ?>%; height: 5px;"></div>
            </div>
        </div>
        <div class="card col-md-6 no-padding ">
            <div class="card-body">
                <div class="h1 text-muted text-right mb-4">
                    <i class="fa fa-bank"></i>
                </div>
                <div class="h4 mb-0">
                    <span class="count"><?php echo $total_investments_request; ?></span>
                </div>
                <small class="text-muted text-uppercase font-weight-bold">Total Invest Request</small>
                <div class="progress progress-xs mt-3 mb-0 bg-flat-color-4" style="width: <?php echo $total_investments_request; ?>%; height: 5px;"></div>
            </div>
        </div>
        <div class="card col-md-6 no-padding ">
            <div class="card-body">
                <div class="h1 text-muted text-right mb-4">
                    <i class="fa fa-dollar"><?php echo $total_investments; ?></i>
                </div>
                <div class="h4 mb-0">
                    <span class="count"><?php echo $confiremed_investments ?></span>%
                </div>
                <small class="text-muted text-uppercase font-weight-bold">Confirmed Invest Request</small>
                <div class="progress progress-xs mt-3 mb-0 bg-flat-color-3" style="width: <?php echo $confiremed_investments ?>%; height: 5px;"></div>
            </div>
        </div>
    </div>


</div> <!-- .content -->
</div><!-- /#right-panel -->

<!-- Right Panel -->

<?php include("includes/footer.php"); ?>
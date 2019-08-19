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
                    <li class="active">request invest</li>
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
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="ti-rocket text-warning border-warning"></i></div>
                            <div class="stat-content dib">
                                <div class="stat-text">
                                    Invest
                                </div>
                                <div class="stat-digit">Make Investment</div>
                            </div>
                        </div>
                    </div>
                    <form action="" method="post" class="">
                        <div class="col-lg-6 col-md-12">
                            <div class="card" style="margin-top:10%">
                                <div class="card-body">
                                    <div class="alert alert-warning" role="alert">
                                        <h4 class="alert-heading">
                                            Great Decision!
                                        </h4>
                                        <p>Aww yeah, you are definitely on the right path to some great investment benefits.</p>
                                        <hr>
                                        <p class="mb-0">
                                        <span class="badge badge-pill badge-warning">Note</span>
                                            The starting deposit is <b>$1000.</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="card-body card-block">

                                <div class="form-group">
                                    <label for="nf-amt" class=" form-control-label">
                                        <i class="fa fa-money"></i> Amount&nbsp;(&dollar;)
                                    </label>
                                    <input type="number" id="nf-amt" name="amount" placeholder="amount" class="form-control" value="1000">
                                </div>
                            </div>
                            <div class="card-body text-center">
                                <button name="send_request" type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-send"></i> Send Request
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer2.php"); ?>
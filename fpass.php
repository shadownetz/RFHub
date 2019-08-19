<?php include('includes/header1.php'); ?>
<div class="container-fluid rf-signup">
    <div class="row">
        <div class="col-lg-7 col-md-12 block-1 rf-login-alt fp">
            <div class="col-lg-8 col-md-12 signup-block rf-login">
                <div class="col-md-12 logo-blk">
                    <a href="./index.php">
                    <img src="./RfLogo.png" alt="rf-logo" class="rf-logo-signup">
                    </a>
                    <span><i class="fa fa-lock align-center"></i></span>
                </div>
                <form role="form" action="" method="post" autocomplete="off">
                    <div class="col-md-12 form-fields">
                        <label for="email">
                       <i class="fa fa-envelope-open"></i> &nbsp;Email
                            <input type="email" name="email" class="form-control" placeholder="mail@example.com" required>
                        </label>
                        <button name="recorver" class="btn btn-outline-secondary" type="submit">RECOVER <i class="fa fa-lock"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-5 col-md-12 block-2">

        </div>
    </div>
</div>

<?php include('includes/footer1.php'); ?>
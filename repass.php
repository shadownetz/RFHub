<?php include('includes/header1.php'); ?>
<div class="container-fluid rf-signup">
    <div class="row">
        <div class="col-lg-7 col-md-12 block-1 rf-login-alt">
            <div class="col-lg-8 col-md-12 signup-block rf-login">
                <div class="col-md-12 logo-blk">
                    <a href="./index.php">
                    <img src="./RfLogo.png" alt="rf-logo" class="rf-logo-signup">
                    </a>
                    <span><i class="fa fa-lock align-center"></i></span>
                </div>
                <form role="form" action="" method="post">
                    <div class="col-md-12 form-fields">
                        <label for="pass">
                       <i class="fa fa-key"></i> &nbsp;New Password
                            <input type="password" class="form-control" name="pass" required placeholder="Enter New Password">
                            <input type="password" class="form-control" name="re_pass"  required placeholder="Retype Password">
                        </label>
                        <button name="update_pass" class="btn btn-outline-secondary" type="submit">UPDATE <i class="fa fa-lock"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-5 col-md-12 block-2">

        </div>
    </div>
</div>

<?php include('includes/footer1.php'); ?>
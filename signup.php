<?php include('includes/header1.php'); ?>
<div class="container-fluid rf-signup">
    <div class="row">
        <div class="col-lg-7 col-md-12 block-1">
            <div class="col-lg-8 col-md-12 signup-block">
                <div class="col-md-12 logo-blk">
                    <a href="./index.php">
                    <img src="./RfLogo.png" alt="rf-logo" class="rf-logo-signup">
                    </a>
                </div>
                <form role="form" action="" method="post" autocomplete="off">
                    <div class="col-md-12 form-fields">
                        <label for="fname">
                           <i class="fa fa-user"></i> &nbsp;First Name
                            <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                        </label>
                        <label for="lname">
                        <i class="fa fa-user"></i>&nbsp;Last Name
                            <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                        </label>
                        <label for="email">
                       <i class="fa fa-envelope-open"></i> &nbsp;Email
                            <input type="email" name="email" class="form-control" placeholder="mail@example.com" required>
                        </label>
                        <label for="phone">
                        <i class="fa fa-phone"></i>&nbsp;Phone&nbsp;<small>(optional)</small>
                            <input type="tel" name="phone" class="form-control" placeholder="000 000 00000" >
                        </label>
                        <label for="pass">
                        <i class="fa fa-key"></i>&nbsp;Password
                            <input type="password" name="pass" class="form-control" placeholder="password" required>
                        </label>
                        <label for="repass">
                        <i class="fa fa-key"></i>&nbsp;Retype Password
                            <input type="password" name="repass" class="form-control" placeholder="retype password" required>
                        </label>
                        <button type="submit" name="user_signup" class="btn btn-success">Sign Up <i class="fa fa-user-plus"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-5 col-md-12 block-2">

        </div>
    </div>
</div>

<?php include('includes/footer1.php'); ?>
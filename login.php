<?php include('includes/header1.php'); ?>
<?php

if (isset($_GET['confirm']) && !empty($_GET['confirm'])) {
    $confirm_id = $_GET['confirm'];

    $explode = explode('-', $confirm_id);
    if ($explode && count($explode) == 10) {
        $user_unique_id = $explode[5] . $explode[7] . $explode[9];
        $update_query = User::find_sql("UPDATE users SET status=1 WHERE ref_id = '$user_unique_id'");
        if ($update_query) {
            swiss_allert('success', 'Account Verified Successfully!', 'login.php');
        } else {
            swiss_allert('warning', 'Cannot find this account!', '');
        }
    }
}

if (isset($_GET['recorver']) && !empty($_GET['recorver'])) {
    global $db_init;

    $confirm_id = $_GET['recorver'];
    $explode = explode('-', $confirm_id);
    if ($explode && count($explode) == 10) {
        $user_unique_id = $explode[5] . $explode[7] . $explode[9];
        $query = User::find_sql("SELECT email, ref_id FROM users WHERE ref_id='{$user_unique_id}' LIMIT 1");
        if ($db_init->num_rows($query) == 1) {
            while ($row = $db_init->fetch_array($query)) {
                $email = $row['email'];
                $_SESSION['email'] = $email;
            }
            $_SESSION['ref_id'] = $user_unique_id;
            echo "<script> window.location='repass.php'; </script>";
        } else {
            swiss_allert('warning', 'something went wrong, try again later!!', 'index.php');
        }
    }
}
?>
<div class="container-fluid rf-signup">
    <div class="row">
        <div class="col-lg-7 col-md-12 block-1 rf-login-alt">
            <div class="col-lg-8 col-md-12 signup-block rf-login">
                <div class="col-md-12 logo-blk">
                    <a href="./index.php">
                    <img src="./RfLogo.png" alt="rf-logo" class="rf-logo-signup">
                    </a>
                </div>
                <form role="form" action="" method="post" autocomplete="off">
                    <div class="col-md-12 form-fields">
                        <label for="email">
                       <i class="fa fa-envelope-open"></i> &nbsp;Email
                            <input type="email" name="email" class="form-control" placeholder="mail@example.com" required>
                        </label>
                        <label for="pass">
                        <i class="fa fa-key"></i>&nbsp;Password
                            <input type="password" name="pass" class="form-control" placeholder="password" required>
                        </label>
                        <button name="user_login" class="btn btn-outline-secondary" type="submit">LOG IN <i class="fa fa-lock"></i></button>
                        <a href="fpass.php" class="">Forgoten Password <i class=""></i></a>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-5 col-md-12 block-2">

        </div>
    </div>
</div>

<?php include('includes/footer1.php'); ?>
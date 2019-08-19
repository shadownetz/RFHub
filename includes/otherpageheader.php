<?php require_once('init/init_all.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="favicon.ico" type="image/ico">
    <!-- Css Frameworks-->
    <link rel="stylesheet" href="vendors/BootStrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/BootStrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="vendors/Animate/animate.css">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="styles/rfpages.css">
    <script>
        if (location.protocol != 'https:') {
            location.href = 'https:' + window.location.href.substring(window.location.protocol.length);
        }
    </script>
    <title>RF Hub</title>
</head>

<body>
    <div class="loader"></div>
    <div class="container-fluid navigation">
        <div class="row">
            <div class="col-lg-3 col-md-12 col-sm-12">
                <a href="index.php#">
                    <img src="./RfLogo.png" alt="rf logo" class="rf-logo">
                </a>
                <div class="nav-responsive-btn">
                    <button class="btn btn-default nav-btn"><i class="fa fa-bars"></i></button>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 rf-nav-blk">
                <ul class="navigation-list-block">
                    <li class=""><a href="index.php">Home</a></li>
                    <li class=""><a href="index.php#about">About</a></li>
                    <li class=""><a href="why-rfinvest.php">Why Us</a></li>
                    <li class=""><a href="rf-pages.php#pricing">Pricing</a></li>
                    <li class=""><a href="rf-pages.php#faq">FAQ</a></li>
                    <li class=""><a href="index.php#contact">Contact</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-12 rf-nav-btn-blk">
                <div class="container-fluid">
                    <div class="row rw">
                        <?php if (isset($session->user_id)) { ?>
                            <div class="col-12 text-center b">
                                <a class="btn btn-outline-dark" href="login.php"><i class="fa fa-user"></i>&nbsp;Account</a>
                            </div>
                        <?php } else { ?>
                            <div class="col-6 text-center b">
                                <a class="btn btn-outline-dark" href="login.php">LOG IN</a>
                            </div>
                            <div class="col-6 text-center b">
                                <a class="btn btn-success" href="signup.php">GET STARTED</a>
                            </div>

                        <?php } ?>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="overlay-responsive">
        <div class="navigation-responsive animated">
            <div class="col-md-12 nav-ctl-btn">
                <button class="btn btn-outline-default nav-btn">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
            <div class="col-md-12 nav-responsive-items">
                <a href="index.php#about">
                    <p>about</p>
                </a>
                <a href="why-rfinvest.php">
                    <p>why us</p>
                </a>
                <a href="rf-pages.php#pricing">
                    <p>pricing</p>
                </a>
                <a href="rf-pages.php#faq">
                    <p class="#faq">faq</p>
                </a>
                <a href="index.php#contact">
                    <p>contact us</p>
                </a>
            </div>
            <div class="nav-link-up">
                <div class="col-md-12">
                    <a class="btn btn-outline-secondary" href="login.php">LOG IN</a>
                    <a class="btn btn-success" href="signup.php">GET STARTED</a>
                </div>
                <?php if (isset($session->user_id)) { ?>
                    <!-- if logged in -->

                <?php } else { ?>
                    <!-- if not logged in -->

                <?php } ?>
            </div>
        </div>
    </div>
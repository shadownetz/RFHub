<?php require_once('init/init_all.php') ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Invest in line with your faith | $1000 minumum | No lock in | Lower fees, because we've made investing easy for you! ">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://rfinvestments.com/">
    <link rel="icon" href="favicon.ico" type="image/ico">
    <!-- Css Frameworks-->
    <link rel="stylesheet" href="vendors/BootStrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/BootStrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="vendors/Animate/animate.css">
    <link rel="stylesheet" href="users/vendors/sweetalert2/sweetalert2.min.css">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="styles/mainstyle.css">
    <title>RF Hub</title>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script>
        if (location.protocol != 'https:') {
            location.href = 'https:' + window.location.href.substring(window.location.protocol.length);
        }
    </script>
</head>

<body>
    <div class="loader"></div>
    <div class="container-fluid navigation">
        <div class="row">
            <div class="col-lg-3 col-md-12 col-sm-12">
                <a href="index.php#">
                    <img src="./RfLogo.png" alt="rf investment logo" class="rf-logo">
                </a>
                <div class="nav-responsive-btn">
                    <button class="btn btn-default nav-btn"><i class="fa fa-bars"></i></button>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 rf-nav-blk">
                <ul class="navigation-list-block">
                    <li class=""><a href="#">Home</a></li>
                    <li class="rf-about-alt"><a href="#">About</a></li>
                    <li class=""><a href="why-rfinvest.php">Why Us</a></li>
                    <li class=""><a href="rf-pages.php#pricing">Pricing</a></li>
                    <li class=""><a href="rf-pages.php#faq">FAQ</a></li>
                    <li class="rf-feedback"><a href="#">Contact</a></li>
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
                <p class="rf-about">
                    about
                </p>
                <a href="why-rfinvest.php">
                    <p class="why-rfinvest.php">
                        why us
                    </p>
                </a>
                <a href="rf-pages.php#pricing">
                    <p class="#pricing">
                        pricing
                    </p>
                </a>
                <a href="rf-pages.php#faq">
                    <p class="#faq">
                        faq
                    </p>
                </a>
                <p class="rf-contact-us">contact us</p>
            </div>
            <div class="nav-link-up">
                <div class="col-md-12">
                    <a class="btn btn-outline-secondary" href="login.php">LOG IN</a>
                    <a class="btn btn-success" href="signup.php">GET STARTED</a>
                </div>
            </div>
            <?php if (isset($session->user_id)) { ?>
                <!-- if logged in -->

            <?php } else { ?>
                <!-- if not logged in -->

            <?php } ?>


        </div>
    </div>
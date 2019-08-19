<?php require_once('../init/init_all.php'); ?>
<?php
if(!isset($session->user_id)){
    header('Location: ../');
}
if($_SESSION['location'] != "admin"){
  $loc=$_SESSION['location'];
  header("location: ../$loc/");
}
?>
<?php
if(isset($_GET['logout'])){
  $session->logout();
}
?>
<?php require_once('../ProcessPage/initialise1.php'); ?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>RFInvestment | Admin</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="../favicon.ico">

    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="vendors/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="vendors/sweetalert2/sweetalert2.min.css">



    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <script>
        if (location.protocol != 'https:') {
            location.href = 'https:' + window.location.href.substring(window.location.protocol.length);
        }
    </script>
    <style>
        .stat {
            border: 0 !important;
        }

        aside.left-panel,
        .navbar,
        .dataTables_paginate .pagination li:hover a,
        .dataTables_paginate .pagination li.active a,
        .stat-info-btn,
        .navbar .navbar-nav li.menu-item-has-children .sub-menu {
            background-color: #0d2143;
        }

        .navbar .navbar-brand,
        .navbar .menu-title {
            border-bottom-color: #d7d9e3;
        }

        .navbar .navbar-nav li>a,
        .navbar .navbar-nav li>a .menu-icon,
        .navbar .menu-title {
            color: #f1f2f7 !important;
        }

        .menutoggle,
        .stat-info-btn:hover {
            background-color: #3990C9;
        }

        .stat-txt-warn {
            border-radius: 50px;
            cursor: text !important;
        }

        .stat-txt-warn:hover {
            background-color: #ffc107;
        }

        .stat-txt-success {
            border-radius: 50px;
            cursor: text !important;
            color: #fff !important;
        }

        .stat-txt-success:hover {
            background-color: #28a745;
        }

        .stat-txt-info {
            border-radius: 50px;
            cursor: text !important;
            color: #fff !important;
        }

        .stat-txt-info:hover {
            background-color: #17a2b8;
        }

        @media screen and (min-width:320px) {
            .table-responsive {
                display: block;
            }
        }
        @media screen and (min-width:1024px) {
            .table-responsive {
                display: table;
            }
        }
    </style>
    <script src="vendors/jquery/dist/jquery.min.js"></script>
</head>

<body>
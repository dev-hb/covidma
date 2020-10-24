<?php include 'config.php';
    require_once 'admin/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Accueil - <?= APP_NAME ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="My Podcast template project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles/bootstrap-4.1.2/bootstrap.min.css">
    <link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="plugins/colorbox/colorbox.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="styles/main_styles.css">
    <link rel="stylesheet" type="text/css" href="styles/responsive.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script src="js/Loader.js" type="text/javascript"></script>
</head>
<body>

<div class="super_container">

    <!-- Header -->

    <header class="header trans_400">

        <!-- Logo -->
        <div class="logo" style="font-size: 28px">
            <span style="color:#fff">Covid</span><span>MA</span>
        </div>

        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="header_content d-flex flex-row align-items-center justify-content-start trans_400">
                        <nav class="main_nav">
                            <ul class="d-flex flex-row align-items-start justify-content-start">
                                <li><a href="index.php">Accueil</a></li>
                                <li><a href="statistics.php">Statistiques</a></li>
                                <li><a href="reports.php">Rapports</a></li>
                                <li><a href="predictions.php">Prédictions</a></li>
                                <?= SHOW_ADMIN != '' ? "<li><a href=\"admin\">".SHOW_ADMIN."</a></li>" : "" ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="header_right d-flex flex-row align-items-start justify-content-start">
            <!-- Hamburger -->
            <div class="hamburger"><i class="fa fa-bars" aria-hidden="true"></i></div>
        </div>
    </header>

    <!-- Menu -->

    <div class="menu">
        <div class="menu_content d-flex flex-column align-items-end justify-content-start">
            <ul class="menu_nav_list text-right">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="episodes.php">Episodes</a></li>
                <li><a href="blog.php">Blog</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>
    </div>
<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon" href="icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Oswald|PT+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />

    <?php  
        $file = basename($_SERVER['PHP_SELF']);
        $page = str_replace(".php","",$file);
        if($page == 'invitados' || $page == 'index'){
            echo '<link rel="stylesheet" href="css/colorbox.css">';
        }else if($page == 'conferencias'){
            echo '<link rel="stylesheet" href="css/lightbox.css">';
        }
    ?>

    <link rel="stylesheet" href="css/main.css">
    

    <meta name="theme-color" content="#fafafa">
</head>

<body class="<?php echo $page; ?>">
    <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->


    <header class="site-header">
        <div class="hero">
            <div class="content-header">
                <nav class="social-network">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter-square"></i></a>
                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </nav>

                <div class="event-info">
                    <div class="clearfix">
                        <p class="date"><i class="fas fa-calendar-alt"></i>10-12 Dic</p>
                        <p class="city"><i class="fas fa-map-marker-alt"></i>Panamá</p>
                    </div>

                    <h1 class="site-name">PmaWebCamp</h1>
                    <p class="slogan">La mejor conferencia de <span>diseño web</span></p>
                </div>
                <!--event-info-->
            </div>
        </div>
        <!--Hero-->
    </header>

    <div class="bar">
        <div class="container clearfix">
            <div class="logo">
                <a href="index.php">
                    <img src="img/logo.svg" alt="Logo pmawebcamp">
                </a>
            </div>

            <div class="mobile-menu">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <nav class="main-navigation clearfix">
                <a href="conferencias.php">Conferencia</a>
                <a href="calendario.php">Calendario</a>
                <a href="invitados.php">Invitado</a>
                <a href="registro.php">Reservaciones</a>
            </nav>
        </div>
        <!--Container-->
    </div>
    <!--Bar-->
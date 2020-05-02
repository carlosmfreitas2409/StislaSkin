<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        
        <!-- Website Title -->
        <title><?php echo SITE_NAME; ?> | Pilot Center</title>

        <?php echo $page_htmlhead; ?>

        <!-- General CSS Files -->
        <link rel="stylesheet" href="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/modules/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/modules/fontawesome/css/all.min.css">

        <!-- CSS Libraries -->
        <link rel="stylesheet" href="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/modules/jqvmap/dist/jqvmap.min.css">
        <link rel="stylesheet" href="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/modules/weather-icon/css/weather-icons.min.css">
        <link rel="stylesheet" href="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/modules/weather-icon/css/weather-icons-wind.min.css">
        <link rel="stylesheet" href="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/modules/summernote/summernote-bs4.css">
        <link rel="stylesheet" href="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/modules/bootstrap-social/bootstrap-social.css">
        <link rel="stylesheet" href="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/modules/jquery-selectric/selectric.css">
        <link rel="stylesheet" href="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/modules/chocolat/dist/css/chocolat.css">
        <link rel="stylesheet" href="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/modules/prism/prism.css">
        <link rel="stylesheet" href="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/modules/summernote/summernote-bs4.css">
        <link rel="stylesheet" href="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/modules/bootstrap-daterangepicker/daterangepicker.css">
        <link rel="stylesheet" href="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/modules/select2/dist/css/select2.min.css">

        <!-- Template CSS -->
        <link rel="stylesheet" href="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/css/style.css">
        <link rel="stylesheet" href="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/css/components.css">

        <!-- Leaflet -->
        <link rel="stylesheet" href="<?php echo SITE_URL?>/lib/js/leaflet/leaflet.css" />
        <script src="<?php echo SITE_URL?>/lib/js/leaflet/leaflet.js"></script>
        <script src="<?php echo SITE_URL?>/lib/js/leaflet/leaflet-providers.js"></script>
        <script src="<?php echo SITE_URL?>/lib/js/leaflet/Leaflet.Geodesic.js"></script>

        <!-- Simbrief -->
        <script type="text/javascript" src="<?php echo fileurl('lib/js/simbrief.apiv1.js');?>"></script>

        <!-- Start GA -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-94034622-3');
        </script>
        <!-- /END GA -->
    </head>
    <body>
        <?php echo $page_htmlreq; ?>
        <?php
            # Hide the header if the page is not the registration or login page
            if (!isset($_SERVER['REQUEST_URI']) || ltrim($_SERVER['REQUEST_URI'],'/') !== SITE_URL.'/index.php/login' || ltrim($_SERVER['REQUEST_URI'],'/') !== SITE_URL.'/index.php/registration') {
                if(Auth::LoggedIn()) {
                    Template::Show('app_top.php');
                }
            }
        ?>

        <?php 
            if(Auth::LoggedIn()) { 
                echo $page_content;
            } else {
        ?>
        <div id="app">
            <section class="section">
                <?php echo $page_content; ?>
            </section>
        </div>
        <?php } ?>

        <?php
            # Hide the footer if the page is not the registration or login page
            if (!isset($_SERVER['REQUEST_URI']) || ltrim($_SERVER['REQUEST_URI'],'/') !== SITE_URL.'/index.php/login' || ltrim($_SERVER['REQUEST_URI'],'/') !== SITE_URL.'/index.php/registration') {
                if(Auth::LoggedIn()) {
                    Template::Show('app_bottom.php');
                }
            }
		?>
        
        <!-- General JS Scripts -->
        <script src="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/modules/jquery.min.js"></script>
        <script src="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/modules/popper.js"></script>
        <script src="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/modules/tooltip.js"></script>
        <script src="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/modules/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
        <script src="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/modules/moment.min.js"></script>
        <script src="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/js/stisla.js"></script>
        
        <!-- JS Libraies -->
        <script src="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/modules/simple-weather/jquery.simpleWeather.min.js"></script>
        <script src="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/modules/chart.min.js"></script>
        <script src="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/modules/jqvmap/dist/jquery.vmap.min.js"></script>
        <script src="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/modules/jqvmap/dist/maps/jquery.vmap.world.js"></script>
        <script src="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/modules/summernote/summernote-bs4.js"></script>
        <script src="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
        <script src="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
        <script src="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
        <script src="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
        <script src="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/modules/sweetalert/sweetalert2.js"></script>
        <script src="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/modules/prism/prism.js"></script>
        <script src="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/modules/leaflet-ant-path.js"></script>
        <script src="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/modules/summernote/summernote-bs4.js"></script>
        <script src="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/modules/bootstrap-daterangepicker/daterangepicker.js"></script>
        <script src="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/modules/select2/dist/js/select2.full.min.js"></script>
        
        <!-- Page Specific JS File -->
        <script src="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/js/page/index-0.js"></script>
        <script src="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/js/page/auth-register.js"></script>
        <script src="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/js/page/bootstrap-modal.js"></script>
        
        <!-- Template JS File -->
        <script src="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/js/scripts.js"></script>
        <script src="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/js/custom.js"></script>
    </body>
</html>
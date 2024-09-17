<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>Shop 24</title>

    <meta name="title" content="<?= isset($mtitle) ? $mtitle : ''  ?>" />
    <meta name="keywords" content="" />
    <meta name="description" content="<?= isset($mdescription) ? $mdescription : '' ?>" />
    <meta property="og:title" content="<?= isset($mtitle) ? $mtitle : ''  ?>"/>
    <meta property="og:type" content=""/>
    <meta property="og:url" content="Shop 24 U"/>
    <meta property="og:image" content="<?= isset($ogimage) ? $ogimage : base_url().'/assets/images/logo.png'  ?>"/>
    <meta property="og:site_name" content="Little Officer"/>
    <meta property="og:description" content="<?= isset($mdescription) ? $mdescription : '' ?>"/>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= base_url('assets/') ?>/images/icons/favicon.png">

    <link rel="preload" href="<?= base_url('assets/') ?>/vendor/fontawesome-free/webfonts/fa-regular-400.woff2" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="<?= base_url('assets/') ?>/vendor/fontawesome-free/webfonts/fa-solid-900.woff2" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="<?= base_url('assets/') ?>/vendor/fontawesome-free/webfonts/fa-brands-400.woff2" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="<?= base_url('assets/') ?>/fonts/wolmart87d5.woff?png09e" as="font" type="font/woff" crossorigin="anonymous">

    <!-- Vendor CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/') ?>/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <!-- Plugins CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/') ?>/vendor/animate/animate.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/') ?>/vendor/magnific-popup/magnific-popup.min.css">
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>/vendor/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/')?>vendor/photoswipe/photoswipe.min.css">
     <link rel="stylesheet" type="text/css" href="<?= base_url('assets/')?>vendor/photoswipe/default-skin/default-skin.min.css">
    <!-- Default CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/') ?>css/style.min.css">
    
</head>

<body>
    <!-- loader -->
    <style type="text/css">
         #loader{
            display: none;
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 999999999;
            background-color: #0000005e;
        } 

        /* HTML: <div class="loader"></div> */
    .loader {
      height: 45px;
      aspect-ratio: 1.2;
      --c:no-repeat repeating-linear-gradient(90deg,#000 0 20%,#0000 0 40%);
      background: 
        var(--c) 50% 0,
        var(--c) 50% 100%;
      background-size: calc(500%/6) 50%;
      animation: l10 1s infinite linear;
    }
    @keyframes l10 {
      33%  {background-position: 0   0   ,100% 100%}
      66%  {background-position: 0   100%,100% 0   }
      100% {background-position: 50% 100%,50%  0   }
    }

    </style>

    <div id="loader" class="text-center">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="loader"></div>
        </div>
    </div>
    <!-- loader -->
  <!-- start of Page-wrapper --- ender is in footer.php-->
  <div class="page-wrapper">

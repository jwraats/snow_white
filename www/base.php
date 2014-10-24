<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

<?php

$page = $_GET('page');

?>


<head>

    <meta charset='utf-8'>
    <meta name="robots" content="noindex,nofollow">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no">

    <title><?php echo $page; ?></title>

    <link rel="stylesheet" href="assets/build/css/style.css">
    <script src="assets/js/libs/modernizr-2.6.2.min.js"></script>

</head>
<body>

    <?php include($page . '.php'); ?>

</body>
</html>


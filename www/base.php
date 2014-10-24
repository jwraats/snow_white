<?php

$page = isset($_GET['page']) ? $_GET['page'] : 'login';

?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->



<head>

    <meta charset='utf-8'>
    <meta name="robots" content="noindex,nofollow">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no">

    <title><?php echo $page; ?></title>

    <link rel="stylesheet" href="assets/build/css/style.css">
    <script src="assets/js/libs/modernizr-2.6.2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
	<!--font-->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>

</head>
<body>

    <?php include($page . '.php'); ?>


<script type="text/javascript" src="assets/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="assets/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="assets/js/main.js"></script>
</body>
</html>


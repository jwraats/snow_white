<?php session_start();

$page = isset($_GET['page']) ? $_GET['page'] : 'login';

include('config.php');
include('base.php');

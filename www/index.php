<?php session_start();
error_reporting(E_ALL);

// set page
$page = isset($_GET['page']) ? $_GET['page'] : 'login';

if(!isset($_SESSION['id'])) {
    $page = 'login';
}

include('config.php');
include('base.php');

<?php

if(session_id() == ''){
    session_start();
}

// set page
$page = isset($_GET['page']) ? $_GET['page'] : 'login';

include('config.php');
include('base.php');

<?php
error_reporting(E_ALL); //Turn off after development PLEASE :P
if(session_id() == ''){
    session_start();
}
include('./Database.php');
$db = new Database('localhost', 'snow_white', 'snow', 'white');


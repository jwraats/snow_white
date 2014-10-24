<?php

$db_name = 'snow_white';
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';

try {
    $pdo = new PDO('mysql:host='.$db_host.';dbname='.$db_name, $db_user, $db_pass);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

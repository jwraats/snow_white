<?php

$db_name = 'snow_white';
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';

try {
    $dbh = new PDO('mysql:host='.$db_host.';dbname='.$db_name, $db_user, $db_pass);
    foreach($dbh->query('SELECT * from user') as $row) {
        print_r($row);
    }
    $dbh = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>
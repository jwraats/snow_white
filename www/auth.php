<?php
    error_reporting(E_ALL);
    session_start();
    include('config.php');

    if(isset($_POST['username']) && isset($_POST['password'])) {

        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $get_user = $pdo->prepare('SELECT * FROM user WHERE username = :username AND password = :password');

        try {
            $get_user->execute(array(':username' => $username, ':password' => $password));
            $user = $get_user->fetchAll();
            $get_user->closeCursor();
        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }

        if(count($user) > 0){
            // header('Location: http://www.nu.nl');
            $_SESSION['id'] = $user[0]['id'];
            echo '<script> window.location = "./index.php?page=home"</script>';
        } else {
            echo 'no user';
            echo '<script> window.location = "./index.php?page=login"</script>';
            // header('Location: index.php?page=login');
            exit;
        }
    }
?>

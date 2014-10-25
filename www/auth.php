<?php
    include('config.php');
    if(isset($_GET['logout'])){
        if(isset($_SESSION['id'])){
            session_destroy();
            echo '<script> window.location = "./index.php?page=login"</script>';
        }
        else{
            //Not yet logged in!... so why LOGOUT?
            echo '<script> window.location = "./index.php?page=login"</script>';
            exit;
        }
    }
    else{
        if(isset($_POST['username']) && isset($_POST['password']) && !isset($_SESSION['id'])) {
            $user = $db->Login($_POST['username'], $_POST['password']);
            if(!$user){
                echo '<script> window.location = "./index.php?page=login"</script>';
                exit;
            } else {
                $_SESSION['id'] = $user->id;
                echo '<script> window.location = "./index.php?page=home"</script>';
                exit;
            }
        }
        else{
            //Already logged in
            echo '<script> window.location = "./index.php?page=home"</script>';
            exit;
        }
    }
?>

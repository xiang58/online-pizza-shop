<?
    session_start();
    unset($_SESSION['id']);
    unset($_SESSION['email']);
    unset($_SESSION['name']);
    unset($_SESSION['address']);
    unset($_SESSION['admin']);
    session_destroy();
    mysqli_close();
    header('Location: home.html');
?>

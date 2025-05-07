<?php
session_start();

    // this is from "navbar.php" line 369 logout button // 

if(isset($_POST['logout_btn']))
{
    session_destroy();
    unset($_SESSION['username']);
    header('Location: login.php');
}


?>
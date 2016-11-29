<?php
session_start();
if (isset($_POST['submit'])){
    $api = $_POST['api'];
    $api_secret = $_POST['api_secret'];
    $token = $_POST['token'];
    $token_secret = $_POST['token_secret'];


        $_SESSION['api'] =$api;
        $_SESSION['api_secret'] = $api_secret;
        $_SESSION['token'] = $token;
        $_SESSION['token_secret'] = $token_secret;      
    }

if(!isset($_SESSION['api'])){
    header('Location:alogin.php');
}

if(isset($_SESSION['api'])){
    header('location:index.php');
}


?>

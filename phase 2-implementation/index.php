<?php
session_start();
if (empty($_SESSION['user_name']) ){
    header("Location: login.php");
    die();
}else{
    header("Location: Edu_toolkit.php");
    die();
}
?>
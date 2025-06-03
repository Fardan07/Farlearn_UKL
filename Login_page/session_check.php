<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    
    header("Location: Login_page/login.php");
    exit;
}
?>

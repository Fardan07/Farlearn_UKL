<?php
session_start();
session_destroy();
header("Location: ../UKL/ukl.php");
exit();
?>

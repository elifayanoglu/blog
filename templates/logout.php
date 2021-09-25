<?php
unset($_SESSION['member']);
session_destroy(); // Destroying All Sessions
header("Location: home.php"); // Redirecting To Home Page
?> 
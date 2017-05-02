<?php 

session_start();

unset($_SESSION);
session_unset();
session_destroy();
$logout = "You have logged out, login again";

header("Location:index.php?message=$logout");

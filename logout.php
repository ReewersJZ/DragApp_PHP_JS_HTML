<?php
session_start();
unset($_SESSION['user']);
include "location.php";
session_destroy();
header("Location:" .$location.  "index.html");
?>
<?php
session_start();
echo "Welcome to the homepage, " . $_SESSION["user"]["email"];
?>
<a href="logout.php">Logout</a>
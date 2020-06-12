<?php
include("header.php");

?>

<h4>HOME</h4>
<?php
//session_start();
echo "Welcome to the homepage, " . $_SESSION["user"]["email"];
?>

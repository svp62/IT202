<?php
include("header.php");

?>

<h1>     </h1>
<style>
body {
	background-color: lightgrey;
	
}
</style>
<body>
<?php
//session_start();
echo "Welcome to the homepage, " . $_SESSION["user"]["email"];
?>
</body>



<?php
include("header.php");

?>

<style>

body {
	background-color: lightgrey;
	background-image: homep.jpg;
	text-align: center;
	font-size: 32px
	font-family: "Times New Roman", Times, serif;
	
}

</style>

<h1>     </h1>


<?php
//session_start();
echo "Welcome to the survey homepage, " . $_SESSION["user"]["email"];

?>
<h1>  </h1>
<h2>Please Login with your existing account or register to start taking surveys.</h2>

<div>
<span class="error">* required field</span>
<form method="POST">
	<label for="email">Email
	<input type="email" id="email" name="email" />
	<span class="error" id="email">* <?php echo $emailerr;?></span>
	</label><br><br>
	
	<label for="p">Password
	<input type="password" id="p" name="password" />
	<span class="error" id="p">* <?php echo $passerr;?></span>
	</label><br><br><br>
	<input type="submit" name="login" value="Login"/>
</form>
</div>
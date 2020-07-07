


<?php
include("header.php");

?>



<h1>     </h1>


<?php
//session_start();
echo "Welcome to the survey homepage, " . $_SESSION["user"]["email"];

?>
<h1>  </h1>
<h2>Please Login with your existing account or register to start taking surveys.</h2>

<div>


    <a target="_blank" href="homep.jpg">
      <img src="homep.jpg" width="600" height="400">
    </a>
    

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
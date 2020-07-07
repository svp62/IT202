<h1>  </h1>

<?php 
include("header.php");


echo " THIS IS A SURVEY PAGE ";


?>




<h1>  </h1>
<h2>  </h2>

<a target="_blank" href="homep.jpg">
      <img src="homep.jpg" width="400" height="200">
    </a>

    


<form method="POST">
	<br><br>
	<input type="submit" name="login" value="GET STARTED"/>
</form>

<?php

if(isset($_POST["login"])) {
	
	header("Location: login.php");
	
}

?>


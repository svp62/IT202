


<?php
include("header.php");

?>



<h1>     </h1>



<h1>  </h1>
<h2>  </h2>

<a target="_blank" href="homep.jpg">
      <img src="homep.jpg" width="400" height="200">
    </a>

    


<form method="POST">
	
	<input type="submit" name="login" value="GET STARTED"/>
</form>

<?php
//session_start();
//echo "Welcome to the survey page, " . $_SESSION["user"]["email"];
//width="600" height="400"
if(isset($_POST["login"])) {
	
	header("Location: login.php");
	
}

?>
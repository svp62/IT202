<?php
include("header.php");

?>
<div>
<form method="POST">
    <label for="question">Do you want to create a survey?
	<input type="submit" name="yes1" value="YES" />
	
	</label>
	<label for="question">Do you want to take an existing survey?
	<input type="submit" name="yes" value="YES" />
	
	</label>
    
</form>
<div>

<?php

if(isset($_POST["yes1"])) {
	
	header("Location: create.php");
	
}

if(isset($_POST["yes"])) {
	
	header("Location: created.php");
	
}

?>
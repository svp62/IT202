<?php
include("header.php");

?>
<h1>  </h1>
<h2>Please Register here. </h2>


<form method="POST" autocomplete="off" >
	<label for="email">Email
	<input type="email" id="email" name="email" required />
	</label><br><br>
	<label for="p">Password
	<input type="password" id="p" name="password" required />
	</label><br><br>
	<label for="cp">Confirm Password
	<input type="password" id="cp" name="cpassword" required />
	</label><br><br><br>
	<input type="submit" name="register" value="Register"/>
</form>


<?php

if(isset($_POST["register"])){
	if(isset($_POST["password"]) && isset($_POST["cpassword"]) && isset($_POST["email"])){
		$password = $_POST["password"];
		$cpassword = $_POST["cpassword"];
		$email = $_POST["email"];
		if($password == $cpassword){
			//require("config.php");
			$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
			try{
				$db = new PDO($connection_string, $dbuser, $dbpass);
				$hash = password_hash($password, PASSWORD_BCRYPT);
				$stmt = $db->prepare("INSERT INTO Users (email, password) VALUES(:email, :password)");
				$stmt->execute(array(
					":email" => $email,
					":password" => $hash
				));
				$e = $stmt->errorInfo();
				if($e[0] != "00000"){
					echo var_export($e, true);
				}
				else{
					echo "<div>REGISTRATION SUCCEED!</div>";
				}
			}
			catch (Exception $e){
				echo $e->getMessage();
			}
		}
		else{
			echo "<div>Passwords don't match</div>";
		}
	}
}
?>

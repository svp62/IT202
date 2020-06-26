<?php
include("header.php");

?>



<?php

$emailerr = $passerr = "";
$email = $password = "";

if(isset($_POST["register"])){
	
	if(empty($_POST["email"])){
			
			$emailerr = "Email required";
			
			
		} else {
			$email = $_POST["email"];
		}
		if(empty($_POST["password"])){
			
			$passerr = "Password required";
		} else {
			$password = $_POST["password"];
			
		}
		if(empty($_POST["cpassword"])){
			
			$passerr1 = "Password confirmation required";
		} else {
			$cpassword = $_POST["cpassword"];
			
		}
		
	if(!empty($email) && !empty($password) && !empty($_POST["cpassword"])){
		//$password = $_POST["password"];
		//$cpassword = $_POST["cpassword"];
		//$email = $_POST["email"];
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


<h1>  </h1>
<h2>Please Register here. </h2>

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
	
	<label for="cp">Confirm Password
	<input type="password" id="cp" name="cpassword" required />
	<span class="error" id="cp">* <?php echo $passerr1;?></span>
	</label><br><br><br>
	
	<input type="submit" name="register" value="Register"/>
</form>
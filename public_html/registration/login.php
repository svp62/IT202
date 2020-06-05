<form method="POST">
	<label for="email">Email
	<input type="email" id="email" name="email"/>
	</label>
	<label for="p">Password
	<input type="password" id="p" name="password"/>
	</label>
	<input type="submit" name="login" value="Login"/>
</form>

<?php

if(isset($_POST["login"])){
	if(isset($_POST["password"]) && isset($_POST["email"])){
		$password = $_POST["password"];
		$email = $_POST["email"];
		require("config.php");
			$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
			try{
				$db = new PDO($connection_string, $dbuser, $dbpass);
				$stmt = $db->prepare("SELECT * FROM Users where email = :email LIMIT 1");
				$stmt->execute(array(
					":email" => $email
				));
				$e = $stmt->errorInfo();
				if($e[0] != "00000"){
					echo var_export($e, true);
				}
				else{
					$result = $stmt->fetch(PDO::FETCH_ASSOC);
					if ($result){
						$rpassword = $result["password"];
						if(password_verify($password, $rpassword)){
							echo "<div>Password matched! You are logged in!</div>";
						}
						else{
							echo "<div>Invalid password!</div>";
						}
					}
					else{
						echo "<div>Invalid user</div>";
					}
					
				}
			}
			catch (Exception $e){
				echo $e->getMessage();
			}
	}
}
?>

<?php require_once("include/db_connection.php") ?>
<?php require_once("include/function.php") ?>
<?php require_once("include/session.php") ?>

<?php  
session_start();
if(isset($_POST["submit"])){
	$email = $_POST['email'];
	$password =  $_POST["password"];
	
	
	$db = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
	try
	{
		$conn = new PDO($db, $dbuser, $dbpass);
		$stmt = $conn->prepare("SELECT * FROM `user` WHERE Email = ?");
		$stmt->execute([$email]); 
		
		if($stmt->rowCount() > 0){
			$row = $stmt->fetch();
			$hashPassword = $row['Password'];	
		}

		if(password_verify($password, $hashPassword)){
			$_SESSION['message_success']="Successfully logged in";
			$_SESSION['UserID'] = $row['ID'];
			if($row['Role'] == "User"){
				$_SESSION['Role'] = $row['Role'];
				redirect_to("index.php");

			}else if($row['Role'] == "Admin"){
				$_SESSION['Role'] = $row['Role'];
				redirect_to("Admin/index.php");
			}
			
		}else{
			$_SESSION['message_failed']="Email or password incorrect!!!";
			redirect_to("login.php");
		}
	}
	catch(PDOException $e)
	{

		$_SESSION['message_failed']="Error: ".$e->getMessage();
		redirect_to("login.php");

	}	

	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<?php  
					echo message_success(); 
					echo message_failed();
					echo message_warning();
				?>
				<div class="card mar-top-50">

					<div class="card-header">
						Login
					</div>
					<div class="card-body">
						<form method="post" action="login.php">
							<div class="form-group">
								<label for="exampleInputEmail">Email address</label>
								<input type="email" class="form-control" name= "email" id="exampleInputEmail" placeholder="example@email.com" required>
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Password</label>
								<input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Enter password" required>
							</div>
							<button type="submit" name = "submit" class="btn btn-primary">Login</button>
							<p>Don't have account register <a href="register.php">here</a></p>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-4"></div>
		</div>
	</div>	
</body>
</html>
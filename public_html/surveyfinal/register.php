<?php require("include/db_connection.php") ?>
<?php require("include/function.php") ?>
<?php require("include/session.php") ?>

<?php  
if(isset($_POST['submit'])){
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['confirmPasword'];
	$Role = "User";

	
		$db = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
	$hashPassword = password_hash($password, PASSWORD_DEFAULT);

	try
	{
		
		$conn = new PDO($db, $dbuser, $dbpass);
		$stmt = $conn->prepare("INSERT INTO `user`(`Name`, `Email`, `Password`, `Role`) VALUES (?, ?, ?, ?)");
		$stmt->bindParam(1,$name);
		$stmt->bindParam(2,$email);
		$stmt->bindParam(3,$hashPassword);
		$stmt->bindParam(4,$Role);

		$stmt->execute();

		$_SESSION['message_success']="Successfully added to database";
		redirect_to("login.php");
	}
	catch(PDOException $e) 
	{
	  	$_SESSION['message_failed']="Failed to register!!!";
		redirect_to("register.php");
	}

}
?>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Register</title>

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
						Register
					</div>
					<div class="card-body">
						<form action="register.php" method="post">
							<div class="form-group">
								<label for="exampleInputName">Name</label>
								<input type="text" class="form-control" name="name" id="exampleInputName" placeholder="Enter your name" required>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail">Email address</label>
								<input type="email" class="form-control" name="email" id="exampleInputEmail" placeholder="example@email.com" required>
							</div>
							<div class="form-group">
								<label for="exampleInputPassword">Password</label>
								<input type="password" class="form-control" name="password" id="exampleInputPassword" placeholder="Enter password" required>
							</div>

							<div class="form-group">
								<label for="exampleInputConfirm">Confirm Password</label>
								<input type="password" class="form-control" name="confirmPasword" id="exampleInputConfirm" placeholder="Confirm password" required>
							</div> 
							<button type="submit" name="submit" class="btn btn-primary">Register</button>
							<p>Already have account login <a href="login.php">here</a></p>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-4"></div>
		</div>
	</div>

</body>
</html>
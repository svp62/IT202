<?php require_once("../include/db_connection.php") ?>
<?php require_once("../include/function.php") ?>
<?php require_once("../include/session.php") ?>

<?php  
if(!isset($_SESSION['Role']) && $_SESSION['Role'] != "Admin"){
	$_SESSION['message_failed'] = "Login as Admin to get Access";
	redirect_to("../login.php");
}
?>

<?php  
if(isset($_POST['submit'])){
	$oldPassword = $_POST['oldPassword'];
	$newPassword = $_POST['newPassword'];
	$UserID = $_SESSION['UserID'];

	

	try
	{
		$stmt = $conn->prepare("SELECT * FROM `user` WHERE ID = ?");
		$stmt->execute([$UserID]); 
		if($stmt->rowCount() > 0){
			$row = $stmt->fetch();
			echo $hashPassword = $row['Password'];	
		}
			
		if(password_verify($oldPassword, $hashPassword)){
			echo $newHashPassword = password_hash($newPassword, PASSWORD_DEFAULT);
			$query = "UPDATE `user` SET `Password`= ? WHERE ID = ?";
			$stmt = $conn->prepare($query);
			$res = $stmt->execute([$newHashPassword, $UserID]);
			if($res)
			{
				$_SESSION['message_success']="Password Changed Successfully";
				redirect_to("edit_password.php");
			}else{
				$_SESSION['message_failed']="to change Password";
				redirect_to("edit_password.php");

			}
				
		}else{
			$_SESSION['message_failed']="wrong old Password";
			redirect_to("edit_password.php");
		}
	}
	catch(PDOException $e)
	{

		$_SESSION['message_failed']="Error: ".$e->getMessage();
		redirect_to("edit_password.php");

	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Register</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/style.css">

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<a class="navbar-brand" href="#">Navbar</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item ">
					<a class="nav-link" href="index.php">Home</a>
				</li>
				<li class="nav-item ">
					<a class="nav-link" href="approval.php">Approval</span></a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="edit_password.php">Change Password <span class="sr-only">(current)</a>
				</li>
			</ul>
		</div>
	</nav>

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
						Change password
					</div>
					<div class="card-body">
						<form method="POST" action="edit_password.php">
							<div class="form-group">
								<label for="exampleInputPassword">Old Password</label>
								<input type="password" class="form-control" id="exampleInputPassword" name="oldPassword" placeholder="Enter password" required>
							</div>
							<div class="form-group">
								<label for="exampleInputPassword">New Password</label>
								<input type="password" class="form-control" id="exampleInputPassword" name="newPassword" placeholder="Enter password" required>
							</div>
							<button type="submit" name="submit" class="btn btn-primary">Change password</button>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-4"></div>
		</div>
	</div>

</body>
</html>
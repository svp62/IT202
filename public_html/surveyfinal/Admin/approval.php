<?php require_once("../include/db_connection.php") ?>
<?php require_once("../include/function.php") ?>
<?php require_once("../include/session.php") ?>

<?php  
if(!isset($_SESSION['Role']) && $_SESSION['Role'] != "Admin"){
	$_SESSION['message_failed'] = "Login as Admin to get Access";
	redirect_to("../login.php");
}
?>


<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Home</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/style.css">

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

	
</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<a class="navbar-brand" href="#"></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item ">
					<a class="nav-link" href="index.php">Home</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="approval.php">Approval <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="edit_password.php">Change Password</a>
				</li>
			</ul>
		</div>
	</nav>

	<div class="container">
		<?php  
			echo message_success(); 
			echo message_failed();
			echo message_warning();
		?>
		<table class="table table-hover mar-top-50">
			<thead class="thead-dark">
				<tr>
					<th><a href="addSurvey.php">Add Survey</a></th>
				</tr>
				<tr>
					<th scope="col">#</th>
					<th scope="col">UserID</th>
					<th scope="col">Name</th>
					<th scope="col">Created</th>
					<th scope="col">Survey Count</th>
					<th scope="col">Approved</th>
				</tr>
			</thead>
			<tbody>
				<?php getApprovalSurvey($conn); ?>
			</tbody>
		</table>
		
	</div>

</body>
</html>
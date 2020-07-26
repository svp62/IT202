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
if(isset($_POST["submit"])){
	$Name = $_POST['surveryName'];
	$UserID = $_SESSION['UserID'];
	$Created = date('Y-m-d');


	$db = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
	
	try
	{
		
		$conn = new PDO($db, $dbuser, $dbpass);
		$stmt = $conn->prepare("INSERT INTO `survey`(`UserID`, `Name`, `Created` ) VALUES (?,?,?)"); 	
		$stmt->bindParam(1,$UserID);
		$stmt->bindParam(2,$Name);
		$stmt->bindParam(3,$Created);

		$res = $stmt->execute();

		if($res){
			$_SESSION['message_success']="Successfully added to database";
			echo $id = $conn->lastInsertId();

			$_SESSION['currentSurveyID'] = $id;
			redirect_to("addQuestion.php");
		}else{
			$_SESSION['message_failed']="Failed to add survey!!!";
			redirect_to("addSurvey.php");
		}

	}
	catch(PDOException $e) 
	{
	  	$_SESSION['message_failed']="Erorr: ".$e->getMessage();
		redirect_to("addSurvey.php");
	}
}
?>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Add Survey</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/style.css">

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<?php  
					echo message_success(); 
					echo message_failed();
					echo message_warning();
				?>
				<div class="card mar-top-50">
					<div class="card-header">
						New Survey
					</div>
					<div class="card-body">
						<form method="post" action="addSurvey.php">
							<div class="form-group">
								<label for="exampleInputSurveyName">Survey Name</label>
								<input type="text"class="form-control" name= "surveryName" id="exampleInputSurveyName" required>
							</div>
							<button type="submit" name = "submit" class="btn btn-primary">Add Survey</button>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-6"></div>
		</div>
	</div>	
</body>
</html>
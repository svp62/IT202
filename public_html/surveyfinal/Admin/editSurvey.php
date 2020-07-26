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
	$QuestionIDArray =  $_POST["QuestionID"];
	$QuestionArray = $_POST['Question'];
	$SurveyID = $_POST['SurveyID'];
	$Name = $_POST['Name'];
	$count_inserts = count(array_values($QuestionIDArray));

	$db = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
	$conn = new PDO($db, $dbuser, $dbpass);

	$query2 = "UPDATE `survey` SET `Name`=? WHERE `ID` = ?";
	$stmt = $conn->prepare($query2);
	$res = $stmt->execute([$Name, $SurveyID]);
	if($res)
	{
		for($i=0; $i<$count_inserts; $i++)
		{
		    $res2 = $stmt->execute([$QuestionIDArray[$i], $Question[$i]]);
		}
		if($res2)
		{
			$_SESSION['message_success'] = "Answer Submitted to Database";
			redirect_to("index.php");
		}else
		{
			$_SESSION['message_failed'] = "to Submitted Answer to Database";
			redirect_to("takeSurvey.php?SurveyID=$SurveyID");
		}
	}else
	{
		$_SESSION['message_failed'] = "to Edit Question to Database";
		redirect_to("takeSurvey.php?SurveyID=$SurveyID");
	}

}
?>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Take Survey</title>

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
						Edit Suvey
					</div>
					<div class="card-body">
						<?php 

							$SurveyID = $_GET['SurveyID'];
							$surveyQuery = "SELECT * FROM `survey` WHERE ID = ?";
							$stmt = $conn->prepare($surveyQuery);
							$stmt->execute([$SurveyID]);
							if($stmt->rowCount() > 0){
								$row = $stmt->fetch();
								$SurveyName =  $row['Name'];
							}

						?>
						<form method="post" action="editSurvey.php">
							<input type="hidden" name="SurveyID" value="<?php echo $_GET['SurveyID'] ?>">
							<div class="form-group">
								<label for="exampleInputEmail">Survey Name</label>
								<input type="text" class="form-control" name= "Name" value="<?php echo $SurveyName; ?>" id="exampleInputEmail" required>
							</div>
							<?php
								$SurveyID = $_GET['SurveyID'];
								setQuestion($conn,$SurveyID); 
							?>
							<button type="submit" name = "submit" class="btn btn-primary">Eidt Survey</button>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-6"></div>
		</div>
	</div>	
</body>
</html>
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
	$answerArray = $_POST['answer'];
	$SurveyID = $_POST['SurveyID'];
	$count_inserts = count(array_values($QuestionIDArray));

	$db = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
	$conn = new PDO($db, $dbuser, $dbpass);

	$query = "INSERT INTO `answer`(`QuestionID`, `Answer`) VALUES (?,?)";
	$stmt = $conn->prepare($query);
	for($i=0; $i<$count_inserts; $i++)
	{
	    $stmt->bindValue(1, $QuestionIDArray[$i]);
	    $stmt->bindValue(2, $answerArray[$i]);
	    $res = $stmt->execute();
	}

	if($res){
		$query1 = "SELECT * FROM `survey` WHERE `ID`= ?";
		$stmt = $conn->prepare($query1);
		$stmt->execute([$SurveyID]);
		if($stmt->rowCount() > 0)
		{
			$row = $stmt->fetch();
			$CachedTakenCount = $row['CachedTakenCount'];
			$CachedTakenCount += 1; 
		}

		$takenBy = $_SESSION['UserID'];
		$query2 = "UPDATE `survey` SET `CachedTakenCount`=?,`takenBy`=? WHERE `ID` = ?";
		$stmt = $conn->prepare($query2);
		$res2 = $stmt->execute([$CachedTakenCount, $takenBy, $SurveyID]);
		if($res2){
			$_SESSION['message_success'] = "Answer Submitted to Database";
			redirect_to("index.php");
		}else{
			$_SESSION['message_failed'] = "to Submitted Answer to Database";
			redirect_to("takeSurvey.php?SurveyID=$SurveyID");
		}
		
	}else{
		$_SESSION['message_failed'] = "to Submitted Answer to Database";
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
						<?php 

							$SurveyID = $_GET['SurveyID'];
							$surveyQuery = "SELECT * FROM `survey` WHERE ID = ?";
							$stmt = $conn->prepare($surveyQuery);
							$stmt->execute([$SurveyID]);
							if($stmt->rowCount() > 0){
								$row = $stmt->fetch();
								echo '<h3>'.$row['Name'].'</h3>';
							}

						?>
						
					</div>
					<div class="card-body">
						<form method="post" action="takeSurvey.php">
							<input type="hidden" name="SurveyID" value="<?php echo $_GET['SurveyID'] ?>">
							<?php
								$SurveyID = $_GET['SurveyID'];
								getQueastion($conn,$SurveyID); 
							?>
							<button type="submit" name = "submit" class="btn btn-primary">Submit Answer</button>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-6"></div>
		</div>
	</div>	
</body>
</html>
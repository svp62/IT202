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
if(isset($_GET['SurveyID'])){
	$SurveyID = $_GET['SurveyID'];
	
	$db = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
	$conn = new PDO($db, $dbuser, $dbpass);
	
	$query = "UPDATE `survey` SET `Approved`= 1 WHERE `ID` = ?";
	$stmt = $conn->prepare($query);
	$res = $stmt->execute([$SurveyID]);
	if($res)
	{
		$_SESSION['message_success'] = "Survey Approved!!!";
		redirect_to("approval.php");
	}else{
		$_SESSION['message_failed'] = "to Approve Survey";
		redirect_to("approval.php");
	}
}
?>
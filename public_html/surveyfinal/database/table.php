<?php
require("config.php");

$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
try{
	$db = new PDO($connection_string, $dbuser, $dbpass);
	$stmt = $db->prepare("CREATE TABLE `answer` (
					  `ID` int(11) NOT NULL,
					  `QuestionID` int(1) NOT NULL,
					  `Answer` varchar(255) NOT NULL
					) 
				) CHARACTER SET utf8 COLLATE utf8_general_ci");
	$r = $stmt->execute();
	echo var_export($stmt->errorInfo(), true);
	echo var_export($r, true);
}
catch (Exception $e){
	echo $e->getMessage();
}
?>

<?php
require("config.php");

$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
try{
	$db = new PDO($connection_string, $dbuser, $dbpass);
	$stmt = $db->prepare("CREATE TABLE `question` (
						  `ID` int(11) NOT NULL,
						  `SurveyID` int(11) NOT NULL,
						  `Question` varchar(255) NOT NULL
						)
				) CHARACTER SET utf8 COLLATE utf8_general_ci");
	$r = $stmt->execute();
	echo var_export($stmt->errorInfo(), true);
	echo var_export($r, true);
}
catch (Exception $e){
	echo $e->getMessage();
}
?>


<?php
require("config.php");

$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
try{
	$db = new PDO($connection_string, $dbuser, $dbpass);
	$stmt = $db->prepare("CREATE TABLE `survey` (
					  `ID` int(11) NOT NULL,
					  `UserID` int(11) NOT NULL,
					  `Name` varchar(255) NOT NULL,
					  `Created` date NOT NULL,
					  `CachedTakenCount` int(11) NOT NULL DEFAULT 0,
					  `takenBy` int(11) NOT NULL DEFAULT 0,
					  `Approved` tinyint(1) NOT NULL DEFAULT 0
					) 
				) CHARACTER SET utf8 COLLATE utf8_general_ci");
	$r = $stmt->execute();
	echo var_export($stmt->errorInfo(), true);
	echo var_export($r, true);
}
catch (Exception $e){
	echo $e->getMessage();
}
?>
<?php
require("config.php");

$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
try{
	$db = new PDO($connection_string, $dbuser, $dbpass);
	$stmt = $db->prepare("CREATE TABLE `user` (
						  `ID` int(11) NOT NULL,
						  `Name` varchar(255) NOT NULL,
						  `Email` varchar(255) NOT NULL,
						  `Password` varchar(255) NOT NULL,
						  `Role` varchar(50) NOT NULL
						)
				) CHARACTER SET utf8 COLLATE utf8_general_ci");
	$r = $stmt->execute();
	echo var_export($stmt->errorInfo(), true);
	echo var_export($r, true);
}
catch (Exception $e){
	echo $e->getMessage();
}
?>
<?php
require("config.php");

$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
try{
	$db = new PDO($connection_string, $dbuser, $dbpass);
	$stmt = $db->prepare("CREATE TABLE `Survey` (
				`id` int auto_increment not null,
				`title` varchar(30) not null unique,
				`description` TEXT,
				`question1` varchar(150) NOT NULL,
				`question2` varchar(150) NOT NULL,
				`question3` varchar(150) NOT NULL,
				`question4` varchar(150),
				`question5` varchar(150),
				`visibility` int,
				`created` timestamp default current_timestamp,
				PRIMARY KEY (`id`)
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
/*
require("config.php");

$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
try{
	$db = new PDO($connection_string, $dbuser, $dbpass);
	$stmt = $db->prepare("CREATE TABLE `Survey_questions` (
				`QID` varchar(32) NOT NULL,
				`AID` integer NOT NULL,
				`votes` integer NOT NULL,
				PRIMARY KEY (`QID`,`AID`)
				) CHARACTER SET utf8 COLLATE utf8_general_ci");
	$r = $stmt->execute();
	echo var_export($stmt->errorInfo(), true);
	echo var_export($r, true);
}
catch (Exception $e){
	echo $e->getMessage();
}

*/
?>

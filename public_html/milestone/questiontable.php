<?php
require("config.php");

$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
try{
	$db = new PDO($connection_string, $dbuser, $dbpass);
	$stmt = $db->prepare("CREATE TABLE `Question` (
				`id` int auto_increment not null,
				
				`question` varchar(240),
				
				`user_id` int,
				`questionnaire_id` int,
				
				`created` timestamp default current_timestamp,
				`modified` timestamp default current_timestamp on update current_timestamp,
				PRIMARY KEY (`id`),
				FOREIGN KEY (`user_id`) REFERENCES Users(`user_id`),
				FOREIGN KEY (`questionnaire_id`) REFERENCES Questionare(`id`)
				) CHARACTER SET utf8 COLLATE utf8_general_ci");
	$r = $stmt->execute();
	echo var_export($stmt->errorInfo(), true);
	echo var_export($r, true);
}
catch (Exception $e){
	echo $e->getMessage();
}
?>
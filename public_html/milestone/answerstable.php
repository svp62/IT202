<?php
require("config.php");

$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
try{
	$db = new PDO($connection_string, $dbuser, $dbpass);
	$stmt = $db->prepare("CREATE TABLE `Answer` (
				`id` int auto_increment not null,
				
				`answer` varchar(240),
				`is_open_ended` tinyint default 0,
				`user_id` int,
				`question_id` int,
				
				`created` timestamp default current_timestamp,
				`modified` timestamp default current_timestamp on update current_timestamp,
				PRIMARY KEY (`id`),
				FOREIGN KEY (`user_id`) REFERENCES Users(`user_id`),
				FOREIGN KEY (`question_id`) REFERENCES Question(`id`)
				) CHARACTER SET utf8 COLLATE utf8_general_ci");
	$r = $stmt->execute();
	echo var_export($stmt->errorInfo(), true);
	echo var_export($r, true);
}
catch (Exception $e){
	echo $e->getMessage();
}
?>
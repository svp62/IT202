<?php
require("config.php");

$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
try{
	$db = new PDO($connection_string, $dbuser, $dbpass);
	$stmt = $db->prepare("CREATE TABLE `Questionare` (
				`id` int auto_increment not null,
				
				`name` varchar(120),
				`description` TEXT,
				`user_id` int,
				`attempts_per_day` int default 1,
				`max_attempts` int default 1,
				`use_max` tinyint default 0,
				`created` timestamp default current_timestamp,
				`modified` timestamp default current_timestamp on update current_timestamp,
				PRIMARY KEY (`id`),
				FOREIGN KEY (`user_id`) REFERENCES Users(`user_id`)
				) CHARACTER SET utf8 COLLATE utf8_general_ci");
	$r = $stmt->execute();
	echo var_export($stmt->errorInfo(), true);
	echo var_export($r, true);
}
catch (Exception $e){
	echo $e->getMessage();
}
?>
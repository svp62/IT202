




<?php



//include("header.php");
require("config.php");
	$response = file_get_contents('php://input');
	$send = json_decode($response,true);
	
	
		$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
        try{
           	
			$db = new PDO($connection_string, $dbuser, $dbpass);
		
            $sql = "SELECT Title FROM Survey";
			
		if ( $stmt = $db->query($sql)) {
			while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
				$term = $row[0];
				$sendarray[] = array("name" => $term);
			}
			}
		 $e = $stmt->errorInfo();
		$f = json_encode($sendarray);
		echo $f;
		}
        catch (Exception $e){
            echo $e->getMessage();
        }

//$finalarray = json_encode($sendarray);



?> 

<?php
	require('config.php');
	$array = array();
	$response = file_get_contents('php://input');
    $array = json_decode($response,true);       

	$id = $array['name'];
    
	$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
        try{
           	
			$db = new PDO($connection_string, $dbuser, $dbpass);
		
            $sql = "SELECT id FROM Survey WHERE id=$id";
			
		if ( $stmt = $db->query($sql)) {
			$row = $stmt->fetch(PDO::FETCH_NUM));
			
			
			}
		 $e = $stmt->errorInfo();
		$f = json_encode($row[0]);
		echo $f;
		}
        catch (Exception $e){
            echo $e->getMessage();
        }

?>


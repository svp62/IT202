<?php
	require('config.php');
	$array = array();
	$response = file_get_contents('php://input');
    $array = json_decode($response,true);       

	$id = $array[0]['name'];
    
	$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
        try{	
			$db = new PDO($connection_string, $dbuser, $dbpass);
		
            $sql = "SELECT id FROM Survey WHERE Title='$id'";
			
		if ( $stmt = $db->query($sql)) {
			$row = $stmt->fetch(PDO::FETCH_NUM);
			}	
		$id = $row[0];
		 $e = $stmt->errorInfo();
		}
        catch (Exception $e){
            echo $e->getMessage();
        }
		
		try{
           	
			$db = new PDO($connection_string, $dbuser, $dbpass);
		
            $sql = "INSERT INTO Answers(Survey_id, answer1, answer2, answer3, answer4, answer5, user_id) VALUES('1', 'a111', 'a2', 'a3', 'a4', 'a5', '2')";
			
			$stmt = $db->exec($sql);
		$e = $stmt->errorInfo();
		
		}
        catch (Exception $e){
            echo $e->getMessage();
        }

?>


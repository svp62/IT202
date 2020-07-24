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
			  $db->beginTransaction();

			$a1 = $array[1]['answer_body'];
			$a2 = $array[2]['answer_body'];
			$a3 = $array[3]['answer_body'];
			$a4 = $array[4]['answer_body'];
			$a5 = $array[5]['answer_body'];
            $sql = "INSERT INTO Answers(Survey_id, answer1, answer2, answer3, answer4, answer5, user_id) VALUES('$id', '$a1', '$a2', '$a3', '$a4', '$a5', '6')";
			
			$stmt = $db->exec($sql);
			  $db->commit();

		$e = $stmt->errorInfo();
		$sendarr = array('response': 'success');
		$f = json_encode($sendarr);
		echo $f;
		
		}
        catch (Exception $e){
            echo $e->getMessage();
        }

?>


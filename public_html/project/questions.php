<?php
	require('config.php');
	$array = array();
	$response = file_get_contents('php://input');
    $array = json_decode($response,true);       

	$id = $array['name'];
    
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
		
            $sql = "SELECT question1, question2, question3, question4, question5 FROM Questions WHERE id='$id'";
			
		if ( $stmt = $db->query($sql)){
			$row = $stmt->fetch(PDO::FETCH_NUM);
				$q1 = $row[0];
				$q2 = $row[1];
				$q3 = $row[2];
				$q4 = $row[3];
				$q5 = $row[4];
				$sendarray= array("q1" => $q1, "q2" => $q2, "q3" => $q3, "q4" => $q4, "q5" => $q5);
			}
		$e = $stmt->errorInfo();
		$f = json_encode($sendarray);
		echo $f;
		}
        catch (Exception $e){
            echo $e->getMessage();
        }

?>


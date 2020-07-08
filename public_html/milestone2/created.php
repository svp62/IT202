<?php
include("header.php");

?>
<div>
<form method="POST">
    
    <input type="submit" name="create" value="SHOW ME OUTPUT"/>
</form>
</div>
<?php
if(isset($_POST["create"])){
	
	$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
        try{
           
			
			$db = new PDO($connection_string, $dbuser, $dbpass);
			$sql = "SELECT * FROM Survey";
            $stmt = $db->query($sql);
			//$stmt->execute();
			//$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

			 //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			 
            $e = $stmt->errorInfo();
            
                
                //if ($result > 0){
					// output data of each row
					foreach ($stmt as $row) {
    

						echo "<br> ID: " . $row["id"]; 
						echo "<br> Title: " . $row["title"];
						echo "<br> DESCRIPTION: " . $row["description"];
						echo "<br> QUESTION 1: " . $row["question1"];
						echo "<br> DQUESTION 2: " . $row["question2"];
						echo "<br> QUESTION 3: " . $row["question3"];
						echo "<br> QUESTION 4: " . $row["question4"];
						echo "<br> QUESTION 5: " . $row["question5"];
						echo "<br> VISIBILITY: " . $row["visibility"];
						
						}
                //}
                //else{
                   // echo "0 results to display";
                //}
            
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
	
	
}

?>
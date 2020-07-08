<?php
include("header.php");

?>
<div>
<form method="POST">
    
    <input type="radio" name="sephora" value="SEPHORA"/>
	<input type="radio" name="tony" value="TONY'S COSMETICS"/>
	<input type="submit" value="Submit">
</form>
</div>
<?php
if(isset($_POST["create"])){
	
	$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
        try{
           
			
			$db = new PDO($connection_string, $dbuser, $dbpass);
			$sql = "SELECT * FROM Survey";
            $stmt = $db->query($sql);
			
			 
            $e = $stmt->errorInfo();
				
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
                
            
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
	
	
}

?>


<?php if(isset($_POST["sephora"])) {   $fetchqry = "SELECT * FROM `Survey` where id=1"; 


			$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
        try{
           
			
			$db = new PDO($connection_string, $dbuser, $dbpass);
			$sql = "SELECT * FROM `Survey` where id=1";
            $stmt = $db->query($sql);
			
			 
            $e = $stmt->errorInfo();

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
                
            
        }
        catch (Exception $e){
            echo $e->getMessage();
        }

				 }
		  ?>

<?php
include("header.php");

?>
<div>
<form method="POST">
    <h1>Please choose one survey from the following options.</h1>
    <input type="radio" name="sephora" value="sephora">
	<label for="sephora">SEPHORA</label><br>
	<input type="radio" name="tony" value="tony">
	<label for="tony">TONY'S COSMETICS</label><br>
	<input type="submit" value="Submit">
</form>
</div>
<?php if(isset($_POST["tony"])) {    


			$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
        try{
           
			
			$db = new PDO($connection_string, $dbuser, $dbpass);
			$sql = "SELECT * FROM `Survey` where id=2";
            $stmt = $db->query($sql);
			
			 
            $e = $stmt->errorInfo();

					foreach ($stmt as $row) {
    
						
						echo "<br> Survey for: " . $row["title"];
						
						echo "<br> QUESTION 1: " . $row["question1"]; 
						echo "<br> QUESTION 2: " . $row["question2"];
						echo "<br> QUESTION 3: " . $row["question3"];
						echo "<br> QUESTION 4: " . $row["question4"];
						echo "<br> QUESTION 5: " . $row["question5"];
						
						 
						
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
		} 

catch (Exception $e){
            echo $e->getMessage();
        }

				 }
?>
					<?php foreach ($stmt as $row) { 
    
						 
						echo "<br> Survey for: " . $row["title"];
						?>
						
						<?php echo "<br> QUESTION 1: " . $row["question1"]; ?>
						<input type="text" id="ques1" name="ques1"><br>
						<?php echo "<br> QUESTION 2: " . $row["question2"]; ?>
						<input type="text" id="ques2" name="ques2"><br>
						<?php echo "<br> QUESTION 3: " . $row["question3"]; ?>
						<input type="text" id="ques3" name="ques3"><br>
						<?php echo "<br> QUESTION 4: " . $row["question4"]; ?>
						<input type="text" id="ques4" name="ques4"><br>
						<?php echo "<br> QUESTION 5: " . $row["question5"]; ?>
						<input type="text" id="ques5" name="ques5"><br>
						<input type="submit" value="Submit">
						
						 
						
						<?php } ?>
                
            
        
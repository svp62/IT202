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

					
                
            
        }
        catch (Exception $e){
            echo $e->getMessage();
        }

				 }
		  ?>

<?php if(isset($_POST["sephora"])) { 

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
						
						<?php //echo "<br> QUESTION 1: " . $row["question1"]; ?>
						<input <?php echo "<br> QUESTION 1: " . $row["question1"]; ?> type="text" id="ans1" name="ans1"><br>
						<?php //echo "<br> QUESTION 2: " . $row["question2"]; ?>
						<input <?php echo "<br> QUESTION 2: " . $row["question2"]; ?> type="text" id="ans2" name="ans2"><br>
						<?php //echo "<br> QUESTION 3: " . $row["question3"]; ?>
						<input <?php echo "<br> QUESTION 3: " . $row["question3"]; ?> type="text" id="ans3" name="ans3"><br>
						<?php //echo "<br> QUESTION 4: " . $row["question4"]; ?>
						<input <?php echo "<br> QUESTION 4: " . $row["question4"]; ?> type="text" id="ans4" name="ans4"><br>
						<?php //echo "<br> QUESTION 5: " . $row["question5"]; ?>
						<input <?php echo "<br> QUESTION 5: " . $row["question5"]; ?> type="text" id="ans5" name="ans5"><br>
						<button class="button3" name="click" >DONE</button>
						
						<?php
							if(isset($_POST["click"])){

										$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
										$ans1 = $_POST["ans1"];
										$ans2 = $_POST["ans2"];
										$ans3 = $_POST["ans3"];
										$ans4 = $_POST["ans4"];
										$ans5 = $_POST["ans5"];
										
										echo $ans1;
										echo $ans2;
										echo $ans3;
										echo $ans4;
										echo $ans5;
										
									try{
									   
										$db = new PDO($connection_string, $dbuser, $dbpass);
										$stmt = $db->prepare("INSERT INTO Survey_questions (ques1, ques2, ques3, ques4, ques5, ans1, ans2, ans3, ans4, ans5) VALUES (:ques1, :ques2, :ques3, :ques4, :ques5, :ans1, :ans2, :ans3, :ans4, :ans5)");
										$result = $stmt->execute(array(
											":ques1" => $row["question1"],
											":ques2" => $row["question2"],
											":ques3" => $row["question3"],
											":ques4" => $row["question4"],
											":ques5" => $row["question5"],
											":ans1" => $ans1,
											":ans2" => $ans2,
											":ans3" => $ans3,
											":ans4" => $ans4,
											":ans5" => $ans5
											
										));
										
										$e = $stmt->errorInfo();
										if($e[0] != "00000"){
											echo var_export($e, true);
										}
										else{
											
											if ($result){
												echo"<br>---------------------------------------------------------------------------------<br>";
												echo "Successfully recorded your survey ";
												echo"<br>---------------------------------------------------------------------------------<br>";
											}
											else{
												echo "Error creating data";
											}
											} 
									}

							catch (Exception $e){
										echo $e->getMessage();
									}

											 }

						?>	
						
					<?php } ?>
						
						
<?php
/*
if(isset($_POST["click"])){

			$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
			$ans1 = $_POST["ans1"];
			$ans2 = $_POST["ans2"];
			$ans3 = $_POST["ans3"];
			$ans4 = $_POST["ans4"];
			$ans5 = $_POST["ans5"];
			
			echo $ans1;
			echo $ans2;
			echo $ans3;
			echo $ans4;
			echo $ans5;
			
        try{
           
			$db = new PDO($connection_string, $dbuser, $dbpass);
			$stmt = $db->prepare("INSERT INTO Survey_questions (ques1, ques2, ques3, ques4, ques5, ans1, ans2, ans3, ans4, ans5) VALUES (:ques1, :ques2, :ques3, :ques4, :ques5, :ans1, :ans2, :ans3, :ans4, :ans5)");
            $result = $stmt->execute(array(
                ":ques1" => $row["question1"],
                ":ques2" => $row["question2"],
				":ques3" => $row["question3"],
                ":ques4" => $row["question4"],
				":ques5" => $row["question5"],
				":ans1" => $ans1,
                ":ans2" => $ans2,
				":ans3" => $ans3,
                ":ans4" => $ans4,
				":ans5" => $ans5
				
            ));
			
            $e = $stmt->errorInfo();
            if($e[0] != "00000"){
                echo var_export($e, true);
            }
            else{
                
                if ($result){
					echo"<br>---------------------------------------------------------------------------------<br>";
                    echo "Successfully recorded your survey ";
					echo"<br>---------------------------------------------------------------------------------<br>";
                }
                else{
                    echo "Error creating data";
                }
				} 
		}

catch (Exception $e){
            echo $e->getMessage();
        }

				 }
*/
?>	
                
            
        
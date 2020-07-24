<?php
include("header.php");

?>

<?php
if(isset($_POST["insert"])){
	
	if(empty($_POST["question1"])){
			
			$queserr = "Question required";
			
		}
		else{
			$question1 = $_POST["question1"];
		}
	if(empty($_POST["question2"])){
			
			$queserr = "Question required";
			
		}
		else{
			$question2 = $_POST["question2"];
		}
	if(empty($_POST["question3"])){
			
			$queserr = "Question required";
			
		}
		else{
			$question3 = $_POST["question3"];
			$question4 = $_POST["question4"];
			$question5 = $_POST["question5"];
		}
		
	if(!empty($question1) && !empty($question2) && !empty($question3)) {
		
		$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
		
        try{
            //$db = getDB();
			$surid = '2';
			$db = new PDO($connection_string, $dbuser, $dbpass);
            $stmt = $db->prepare("INSERT INTO Questions (survey_id, question1, question2, question3, question4, question5) VALUES (:survey_id, :question1, :question2, :question3, :question4, :question5)");
            $result = $stmt->execute(array(
				":survey_id" => $surid,
                ":question1" => $question1,
				":question2" => $question2,
				":question3" => $question3,
				":question4" => $question4,
				":question5" => $question5,
                
            ));
			
            $e = $stmt->errorInfo();
            if($e[0] != "00000"){
                echo var_export($e, true);
            }
            else{
                
                if ($result){
					echo"<br>---------------------------------------------------------------------------------<br>";
                    echo "Successfully created new survey for: " . $title;
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
       
		
		
		
		
		
	
	
}

?>



<div>
<form method="POST">

    <label for="question1">Question 1
	<input type="text" id="question1" name="question1" />
	<span class="error" id="question1">* <?php echo $queserr;?></span>
	</label><br><br>
	<label for="question2">Question 2
	<input type="text" id="question2" name="question2" />
	<span class="error" id="question2">* <?php echo $queserr;?></span>
	</label><br><br>
	<label for="question3">Question 3
	<input type="text" id="question3" name="question3" />
	<span class="error" id="question3">* <?php echo $queserr;?></span>
	</label><br><br>
	<label for="question4">Question 4
	<input type="text" id="question4" name="question4" />
	</label><br><br>
	<label for="question5">Question 5
	<input type="text" id="question5" name="question5" />
	</label><br><br>
	
	
	
    <input type="submit" name="insert" value="Create Questions"/>
</form>
</div>
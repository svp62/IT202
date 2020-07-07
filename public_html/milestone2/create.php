<?php
include("header.php");

?>




<?php
if(isset($_POST["created"])){
    
    
    $visibility = $_POST["visibility"];
	$question4 = $_POST["question4"];
	$question5 = $_POST["question5"];
	
	if(empty($_POST["title"])){
			
			$titleerr = "Title needed";
			
		}
		else{
			$title = $_POST["title"];
		}
	if(empty($_POST["description"])){
			
			$deserr = "Description needed";
			
		}
		else{
			$description = $_POST["description"];
		}
	
	if(empty($_POST["question1"]) && empty($_POST["question2"]) && empty($_POST["question3"])){
			
			$queserr = "Question needed";
			echo"-------------------------------------------------";
			echo "YOU ARE REQUIRED TO ADD 3 QUESTION TO SURVEY.";
			echo"-------------------------------------------------";
		}
		else{
			$question1 = $_POST["question1"];
			$question2 = $_POST["question2"];
			$question3 = $_POST["question3"];
		}
	
	
    if(!empty($title) && !empty($description) && !empty($visibility) && !empty($question1) && !empty($question2) && !empty($question3)){
        
		require("functions.php");
		
        try{
            $db = getDB();
            $stmt = $db->prepare("INSERT INTO Survey (title, description, visibility) VALUES (:title, :description, :visibility)");
            $result = $stmt->execute(array(
                ":title" => $title,
                ":description" => $description,
                ":visibility" => $visibility
            ));
			$stmt = $db->prepare("INSERT INTO Surveys_questions (question) VALUES (:question)");
            $result = $stmt->execute(array(
                ":question" => $question1,
                ":question" => $question2,
				":question" => $question3,
				":question" => $question4,
				":question" => $question5,
            ));
            $e = $stmt->errorInfo();
            if($e[0] != "00000"){
                echo var_export($e, true);
            }
            else{
                
                if ($result){
                    echo "Successfully created new data: " . $title;
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
    <label for="title">Title
	<input type="text" id="title" name="title" />
	<span class="error" id="title">* <?php echo $titleerr;?></span>
	</label><br><br>
	<label for="description">Description
	<input type="text" id="description" name="description" />
	<span class="error" id="description">* <?php echo $deserr;?></span>
	</label><br><br>
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
	<span class="error" id="question2">* <?php echo $queserr;?></span>
	</label><br><br>
	<label for="question4">Question 4
	<input type="text" id="question4" name="question4" />
	</label><br><br>
	<label for="question5">Question 5
	<input type="text" id="question5" name="question5" />
	</label><br><br>
	<label for="visibility">Visibility
	<input type="number" id="visibility" name="visibility" />
	</label><br><br>
    <input type="submit" name="created" value="Create Survey"/>
</form>
</div>
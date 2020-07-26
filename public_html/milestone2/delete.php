
<?php

require("functions.php");
$db = getDB();
$idnum = -1;
$result = array();

if(isset($_GET["idnum"])){
    $idnum = $_GET["idnum"];
    $stmt = $db->prepare("SELECT * FROM Survey where id = :id");
	$stmt->execute([":id"=>$idnum]);
	$result = $stmt->fetch(PDO::FETCH_NUM);
	$stmt2 = $db->prepare("SELECT survey_id, question1, question2, question3, question4, question5 FROM Questions where survey_id = :survey_id");
	$stmt2->execute([":survey_id"=>$idnum]);
	$result2 = $stmt2->setFetchMode(PDO::FETCH_ASSOC);
    
}
else{
    echo "ID not provided in url. Please put '?idnum=(id number where you want to update data)' at the end of URL. ";
}
?>

<form method="POST">
    <label for="title">Title
	<input type="text" id="title" name="title" value="<?php echo get($result, "title");?>"/>
	</label>
	<label for="description">Description
	<input type="text" id="description" name="description" value="<?php echo get($result, "description");?>"/>
	</label>
	<label for="question1">Question 1
	<input type="text" id="question1" name="question1" value="<?php echo get($result2, "question1");?>"/>
	</label><br><br>
	
	<label for="question2">Question 2
	<input type="text" id="question2" name="question2" value="<?php echo get($result2, "question2");?>"/>
	</label><br><br>
	
	<label for="question3">Question 3
	<input type="text" id="question3" name="question3" value="<?php echo get($result2, "question3");?>"/>
	</label><br><br>
	
	<label for="question4">Question 4
	<input type="text" id="question4" name="question4" value="<?php echo get($result2, "question4");?>"/>
	</label><br><br>
	
	<label for="question5">Question 5
	<input type="text" id="question5" name="question5" value="<?php echo get($result2, "question5");?>"/>
	</label><br><br>
	<input type="submit" name="delete" value="Delete Survey"/>
</form>

<?php
if(isset($_POST["delete"])){
    $title = $_POST["title"];
    $description = $_POST["description"];
	$question1 = $_POST["question1"];
	$question2 = $_POST["question2"];
	$question3 = $_POST["question3"];
	$question4 = $_POST["question4"];
	$question5 = $_POST["question5"];
   
    if(!empty($title) && !empty($description) ){
        try{
            $stmt = $db->prepare("DELETE FROM Survey where id=:id");
            $result = $stmt->execute(array(
                
                ":id" => $idnum
            ));
            $e = $stmt->errorInfo();
            if($e[0] != "00000"){
                echo var_export($e, true);
            }
            else{
                
                if ($result){
                    echo "Successfully deleted data: " . $title;
                }
                else{
                    echo "Error deleting data";
                }
            }
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
		
    }
    else{
        echo "Title, Description  fields cannot be empty.";
    }
	if( !empty($question1) && !empty($question2) && !empty($question3) && !empty($question4) && !empty($question5)){
			try{
			$stmt2 = $db->prepare("DELETE FROM Questions where survey_id=:survey_id");
			
			$result2 = $stmt2->execute(array(
                
				
                ":survey_id" => $idnum
            ));
			$e2 = $stmt2->errorInfo();
			if($e2[0] != "00000"){
                echo var_export($e2, true);
            }
            else{
                
                if ($result2){
                    echo "Successfully updated questions for " . $title;
                }
                else{
                    echo "Error updating data";
                }
            }
			}
			catch (Exception $e2){
            echo $e2->getMessage();
        }
			
		}
		else{
			 echo "Questions fields cannot be empty.";
			
		}
}
?>
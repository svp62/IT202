<?php
include("header.php");
?>

<?php
require("functions.php");
$db = getDB();
$idnum = -1;
$result = array();

if(isset($_GET["idnum"])){
    $idnum = $_GET["idnum"];
    $stmt = $db->prepare("SELECT * FROM Survey where id = :id");
    $stmt->execute([":id"=>$idnum]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
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
	<input type="text" id="question1" name="question1" value="<?php echo get($result, "question1");?>"/>
	</label><br><br>
	
	<label for="question2">Question 2
	<input type="text" id="question2" name="question2" value="<?php echo get($result, "question2");?>"/>
	</label><br><br>
	
	<label for="question3">Question 3
	<input type="text" id="question3" name="question3" value="<?php echo get($result, "question3");?>"/>
	</label><br><br>
	
	<label for="question4">Question 4
	<input type="text" id="question4" name="question4" value="<?php echo get($result, "question4");?>"/>
	</label><br><br>
	
	<label for="question5">Question 5
	<input type="text" id="question5" name="question5" value="<?php echo get($result, "question5");?>"/>
	</label><br><br>
	
	<label for="visibility">Visibility
	<input type="number" id="visibility" name="visibility" value="<?php echo get($result, "visibility");?>" />
	</label>
	<input type="submit" name="updated" value="Update Survey"/>
</form>

<?php
if(isset($_POST["updated"])){
    $title = $_POST["title"];
    $description = $_POST["description"];
	$question1 = $_POST["question1"];
	$question2 = $_POST["question2"];
	$question3 = $_POST["question3"];
	$question4 = $_POST["question4"];
	$question5 = $_POST["question5"];
    $visibility = $_POST["visibility"];
    if(!empty($title) && !empty($description) && !empty($visibility) && !empty($question1) && !empty($question2) && !empty($question3) && !empty($question4) && !empty($question5)){
        try{
            $stmt = $db->prepare("UPDATE Survey set title = :title, description=:description, question1=:question1, question2=:question2, question3=:question3, question4=:question4, question5=:question5, visibility=:visibility where id=:id");
            $result = $stmt->execute(array(
                ":title" => $title,
                ":description" => $description,
				":question1" => $question1,
                ":question2" => $question2,
				":question3" => $question3,
				":question4" => $question4,
				":question5" => $question5,
                ":visibility" => $visibility,
                ":id" => $idnum
            ));
            $e = $stmt->errorInfo();
            if($e[0] != "00000"){
                echo var_export($e, true);
            }
            else{
                
                if ($result){
                    echo "Successfully updated data: " . $title;
                }
                else{
                    echo "Error updating data";
                }
            }
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
    }
    else{
        echo "Title, Description, Visibility and Questions fields cannot be empty.";
    }
}
?>
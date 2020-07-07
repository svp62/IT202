<?php
include("header.php");

?>



<div>
<form method="POST">
    <label for="title">Title
	<input type="text" id="title" name="title" />
	</label>
	<label for="description">Description
	<input type="text" id="description" name="description" />
	</label>
	<label for="visibility">Visibility
	<input type="number" id="visibility" name="visibility" />
	</label>
    <input type="submit" name="created" value="Create Survey"/>
</form>
</div>
<?php
if(isset($_POST["created"])){
    $title = $_POST["title"];
    $description = $_POST["description"];
    $visibility = $_POST["visibility"];
    if(!empty($title) && !empty($description) && !empty($visibility)){
        
		require("functions.php");
		
        try{
            $db = getDB();
            $stmt = $db->prepare("INSERT INTO Survey (title, description, visibility) VALUES (:title, :description, :visibility)");
            $result = $stmt->execute(array(
                ":title" => $title,
                ":description" => $description,
                ":visibility" => $visibility
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
    else{
        echo "Title, Description and Visibility fields cannot be empty.";
    }
}
?>
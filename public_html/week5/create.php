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
<?php
if(isset($_POST["created"])){
    $title = $_POST["title"];
    $description = $_POST["description"];
    $visibility = $_POST["visibility"];
    if(!empty($title) && !empty($description) && !empty($visibility)){
        require("config.php");
        $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
        try{
            $db = new PDO($connection_string, $dbuser, $dbpass);
            $stmt = $db->prepare("INSERT INTO Survey (title, discription, visibility) VALUES (:title, :discription, :visibility)");
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
                echo var_export($result, true);
                if ($result){
                    echo "Successfully inserted new data: " . $title;
                }
                else{
                    echo "Error inserting record";
                }
            }
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
    }
    else{
        echo "Title discription and visibility must not be empty.";
    }
}
?>
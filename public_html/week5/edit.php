<?php
//require("config.php");
require("functions.php");
//$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
$db = getDB();
$Id = -1;
$result = array();
/*
function get($arr, $key){
    if(isset($arr[$key])){
        return $arr[$key];
    }
    return "";
}
*/
if(isset($_GET["Id"])){
    $Id = $_GET["Id"];
    $stmt = $db->prepare("SELECT * FROM Survey where id = :id");
    $stmt->execute([":id"=>$Id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
}
else{
    echo "No Id provided in url.";
}
?>

<form method="POST">
    <label for="title">Title
	<input type="text" id="title" name="title" value="<?php echo get($result, "title");?>"/>
	</label>
	<label for="description">Description
	<input type="text" id="description" name="description" value="<?php echo get($result, "description");?>"/>
	</label>
	<label for="visibility">Visibility
	<input type="number" id="visibility" name="visibility" value="<?php echo get($result, "visibility");?>" />
	</label>
	<input type="submit" name="updated" value="Update Survey"/>
</form>

<?php
if(isset($_POST["updated"])){
    $title = $_POST["title"];
    $description = $_POST["description"];
    $visibility = $_POST["visibility"];
    if(!empty($title) && !empty($description) && !empty($visibility)){
        try{
            $stmt = $db->prepare("UPDATE Survey set title = :title, description=:description, visibility=:visibility where id=:id");
            $result = $stmt->execute(array(
                ":title" => $title,
                ":description" => $description,
                ":visibility" => $visibility,
                ":id" => $Id
            ));
            $e = $stmt->errorInfo();
            if($e[0] != "00000"){
                echo var_export($e, true);
            }
            else{
                echo var_export($result, true);
                if ($result){
                    echo "Successfully updated data: " . $title;
                }
                else{
                    echo "Error updating record";
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
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
	<label for="visibility">Visibility
	<input type="number" id="visibility" name="visibility" value="<?php echo get($result, "visibility");?>" />
	</label>
	<input type="submit" name="delete" value="Delete Survey"/>
</form>

<?php
if(isset($_POST["delete"])){
    $title = $_POST["title"];
    $description = $_POST["description"];
    $visibility = $_POST["visibility"];
    if(!empty($title) && !empty($description) && !empty($visibility)){
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
        echo "Title, Description and Visibility fields cannot be empty.";
    }
}
?>
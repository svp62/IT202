<?php
include("header.php");

?>
<div>
<form method="POST">
    
    <input type="submit" name="create" value="DELETE TABLE"/>
</form>
</div>
<?php
if(isset($_POST["create"])){
	
	$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
        try{
           
			$db = new PDO($connection_string, $dbuser, $dbpass);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = "DROP TABLE Survey_questions";
			$db->exec($stmt);
		echo"Record deleted successfully";
            
        }
        catch (PDOException $e){
            echo " error ayi " . $e->getMessage();
        }
	
	
}

?>
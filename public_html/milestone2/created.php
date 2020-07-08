<?php
include("header.php");

?>
<div>
<form method="POST">
    
    <input type="submit" name="create" value="SHOW ME OUTPUT"/>
</form>
</div>
<?php
if(isset($_POST["create"])){
	
	$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
        try{
           
			
			$db = new PDO($connection_string, $dbuser, $dbpass);
            $stmt = $conn->prepare("SELECT id, title, description, FROM Survey");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

			 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			 
            $e = $stmt->errorInfo();
            
                
                if ($result > 0){
					// output data of each row
					while($row = $result->fetch()) {
						echo "<br> ID: " . $row["id"]. " - title: ". $row["firstname"]. " " . $row["description"] . "<br>";
					}
                }
                else{
                    echo "0 results to display";
                }
            
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
	
	
}

?>
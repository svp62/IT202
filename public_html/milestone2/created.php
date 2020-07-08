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
            $stmt = $db->prepare("SELECT * FROM Survey");
            
			
            $e = $stmt->errorInfo();
            
                
                if ($stmt->num_rows > 0){
					// output data of each row
					while($row = $stmt->fetch_assoc()) {
						echo "<br> ID: ". $row["id"]. " - title: ". $row["firstname"]. " " . $row["description"] . "<br>";
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
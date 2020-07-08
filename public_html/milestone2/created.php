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
            $stmt->execute(array(
                ":title" => $title,
                ":description" => $description,
				":question1" => $question1,
                ":question2" => $question2,
				":question3" => $question3,
				":question4" => $question4,
				":question5" => $question5,
                ":visibility" => $visibility
            ));
			
            $e = $stmt->errorInfo();
            if($e[0] != "00000"){
                echo var_export($e, true);
            }
            else{
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
				
				while($result=mysql_fetch_array($stmt))
				{
				echo '<tr>
				<td>'.$result["title"].'</td>
				<td>'.$result["description"].'</td>
				</tr>';
				}
                if ($result){
					echo"<br>---------------------------------------------------------------------------------<br>";
                    echo "Successfully created new survey for: " . $title;
					echo"<br>---------------------------------------------------------------------------------<br>";
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

?>
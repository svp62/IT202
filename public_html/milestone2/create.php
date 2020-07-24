<?php


?>

<?php
include("header.php");

if(isset($_POST["created"])){
	
	
	echo $_POST["email"];
	
	if(empty($_POST["title"])){
			
			$titleerr = "Title needed";
			
		}
		else{
			$title = $_POST["title"];
		}
	if(empty($_POST["description"])){
			
			$deserr = "Description needed";
			
		}
		else{
			$description = $_POST["description"];
		}
		
	
	
    if(!empty($title) && !empty($description)){
        
		//require("functions.php");
		
		$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
        try{
            //$db = getDB();
			$user_id = '2';
			$db = new PDO($connection_string, $dbuser, $dbpass);
            $stmt = $db->prepare("INSERT INTO Survey (user_id, title, description) VALUES (:user_id, :title, :description)");
            $result = $stmt->execute(array(
				":user_id" => $user_id,
                ":title" => $title,
                ":description" => $description,
				
            ));
			
            $e = $stmt->errorInfo();
            if($e[0] != "00000"){
                echo var_export($e, true);
            }
            else{
                
                if ($result){
					
					header('Location: create_question.php');
					/*
					echo"<br>---------------------------------------------------------------------------------<br>";
                    echo "Successfully created new survey for: " . $title;
					echo"<br>---------------------------------------------------------------------------------<br>";
					*/
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
	
}
?>


<div>
<form method="POST">
    <label for="title">Title
	<input type="text" id="title" name="title" />
	<span class="error" id="title">* <?php echo $titleerr;?></span>
	</label><br><br>
	<label for="description">Description
	<input type="text" id="description" name="description" />
	<span class="error" id="description">* <?php echo $deserr;?></span>
	</label><br><br>
	
	
	
    <input type="submit" name="created" value="Create Survey"/>
</form>
</div>
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
           
			
            
        }
        catch (Exception $e){
            
        }
	
	
}

?>
<?php
$cleardb_url = parse_url(getenv("JAWSDB_URL"));
$dbhost = $cleardb_url["host"];
$dbuser = $cleardb_url["user"];
$dbpass = $cleardb_url["pass"];
$dbdatabase = substr($cleardb_url["path"],1);


try{
		
		$db = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
		
		//$conn=new PDO("mysql:host=$host;dbname=$dbName",$dbuser,$dbpass);
		
		$conn = new PDO($db, $dbuser, $dbpass);
		

	}catch(PDOException $e)
	{
		echo $e->getMessage(); 
	}

?>



<?php
/*	
	try{
		$host = 'localhost';
		$dbName = 'survey';
		$user = 'root';
		$pass  ='';

		//1.Creating Database connection
		$conn=new PDO("mysql:host=$host;dbname=$dbName",$user,$pass);

	}catch(PDOException $e)
	{
		echo $e->getMessage(); 
	}

	
	
*/
?>
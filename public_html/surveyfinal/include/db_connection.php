<?php
$cleardb_url = parse_url(getenv("JAWSDB_URL"));
$dbhost = $cleardb_url["host"];
$dbuser = $cleardb_url["user"];
$dbpass = $cleardb_url["pass"];
$dbdatabase = substr($cleardb_url["path"],1);

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
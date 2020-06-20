<?php
function get($arr, $key){
    if(isset($arr[$key])){
        return $arr[$key];
    }
    return "";
}
function getDB(){
    global $db;
    if(!isset($db)) {
        require_once("config.php");
        $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
        $db = new PDO($connection_string, $dbuser, $dbpass);
    }
    return $db;
}

function getID(){
    //global $db;
	global $idnum = -1;
    if(isset($_GET["idnum"])){
		
		$idnum = $_GET["idnum"];
		$stmt = $db->prepare("SELECT * FROM Survey where id = :id");
		$stmt->execute([":id"=>$idnum]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
	
	}
	
	else{
		
		echo "ID not provided in url. Please put '?id=("id number where you want to update data")' at the end of URL. ";
		
	}
}

?>
<?php
require("config.php");




$con = mysqli_connect("d6q8diwwdmy5c9k9.cbetxkdyhwsb.us-east-1.rds.amazonaws.com","j5qsff6tgsanmu71","gettothesafezoneanddrinkeatfruit","fuscf2597g2rbtww");



	//$response = file_get_contents('php://input');
	//$send = json_decode($response,true);
	
	//echo $field;
	
	





		//$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
        try{
           	$query = "SELECT Title FROM `Survey` ";
			$result = mysqli_query($con,$query);

			while($row=mysqli_fetch_assoc($result)){
			$term = $row['Title'];
			$sendarray[] = array("examname" => $term);

			}
			$finalarray = json_encode($sendarray);

			echo $finalarray;
			//$db = new PDO($connection_string, $dbuser, $dbpass);
		
            
			
		/*	if ( $stmt = $db->query($sql)) {
			while ($row = $stmt -> fetch_row()) {
			printf ("%s \n", $row[0]);
			}
		*/		}
		 $e = $stmt->errorInfo();
		
		}
        catch (Exception $e){
            echo $e->getMessage();
        }

				 
echo "bitch";
echo "bitch";
echo "bitch";
echo "bitch";
echo "bitch";
echo "bitch";



/*	
$curl = curl_init();
$url="https://web.njit.edu/~smg56/CS490/beta/ExamList.php";
  
  curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_POST => 1,
    CURLOPT_FOLLOWLOCATION => 1,
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_POSTFIELDS => $field
  )); 
$resp = curl_exec($curl); 
echo $resp;
*/
?> 

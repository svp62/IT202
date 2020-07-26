<?php require_once("../include/db_connection.php") ?>
<?php require_once("../include/function.php") ?>
<?php require_once("../include/session.php") ?>
 

<?php
//include("header.php");
//session_start();



session_unset();
session_destroy();
  
  echo "You have logged out please hit the login button to login again";
//echo var_export($_SESSION, true);


if (ini_get("session.use_cookies")) { 
    $params = session_get_cookie_params(); 
    setcookie(session_name(), '', time() - 42000, 
        $params["path"], $params["domain"], 
        $params["secure"], $params["httponly"] 
    ); 
}


/*
if(isset($_POST["logout"])) {
 header('Location: '.$_POST["logout"]);  
} else {
	
	
	
 //header('Location: login.php');  
}
*/

?>

<form action="login.php">
  <br><br>
  <input type="submit" value="Login Again">
</form>

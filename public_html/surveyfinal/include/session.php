<?php 
	session_start();

	function message_failed(){
		if(isset($_SESSION["message_failed"])){ 
			$output = "<div class=\"alert alert-danger alert-dismissible\">".
			"<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>". 
			"<strong>Failed! </strong>".$_SESSION["message_failed"].
			"</div>";

			// clear message after use.
			$_SESSION["message_failed"]=null;

			return $output;
		}
	}
	function message_success(){
		if(isset($_SESSION["message_success"])){ 
			$output = "<div class=\"alert alert-success alert-dismissible\">".
			"<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>". 
			"<strong>Success! </strong>".$_SESSION["message_success"].
			"</div>";

			// clear message after use.
			$_SESSION["message_success"]=null;

			return $output;
		}
	}
	function message_warning(){
		if(isset($_SESSION["message_warning"])){ 
			$output = "<div class=\"alert alert-warning alert-dismissible\">".
			"<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>". 
			"<strong>Warning! </strong>".$_SESSION["message_warning"].
			"</div>";

			// clear message after use.
			$_SESSION["message_warning"]=null;

			return $output;
		}
	}
	function errors(){
		if(isset($_SESSION["errors"])){ 
			$errors = $_SESSION["errors"];
			

			// clear message after use.
			$_SESSION["errors"]=null;

			return $errors;
		}
	}

?>
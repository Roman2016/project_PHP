<?php

	include 'User.php';
	session_start();
	
	$dblocation = "localhost";   
	$dbname = "USERS";   
	$dbuser = "root";   
	$dbpasswd = "a1216)";

	if(!empty($_POST)) { //если запрос не содержит пустого значения
		header("Content-type: text/txt; charset=UTF-8");
	
		switch($_POST["action"]) {
			case "authorization":
				$login = $_POST["login"];
				$password = $_POST["password"];
				
				$login = stripslashes($login); //предотвращает введение скриптов
				$login = htmlspecialchars($login); ////предотвращает введение тегов
				$password = stripslashes($password);
				$password = htmlspecialchars($password);
				$login = trim($login);  //удаление лишних пробелов
				$password = trim($password);
				
				if (!isUserExist($login, $password)) { 
					unset ($login); // удаление переменной
					unset ($password);
					echo "<result>Wrong login or password</result>";
				} else {
					$_SESSION["userlogin"] = $login;
					echo "<result>ok</result>";
				}
			break;
			
			case "registration":
				$login = $_POST["login"];
				$password = $_POST["password"];
				$name = $_POST["name"];
				$country = $_POST["country"];
				$email = $_POST["email"];
				
				$login = stripslashes($login);
				$login = htmlspecialchars($login);
				$password = stripslashes($password);
				$password = htmlspecialchars($password);
				$login = trim($login);
				$password = trim($password);
				
				if (!isLoginFree($login)) {
					echo "<result>Login is not free</result>";
				} elseif (!isMailFree($email)) {
					echo "<result>Email is not free</result>";
				} else {
					addUser($login, $password, $name, $country, $email);
					echo "<result>ok</result>";
				}
			break;
			
			case "Exit":
				unset($_SESSION["userlogin"]);
				echo "<result>ok</result>";
			break;
			
			default:
				echo "<result>Some error</result>";
		}
	}
	
	function isUserExist($login, $password) {

		$db = mysql_connect($GLOBALS["dblocation"], $GLOBALS["dbuser"], $GLOBALS["dbpasswd"] ); 
		mysql_select_db($GLOBALS["dbname"], $db);

		$query = "SELECT * FROM datareg WHERE login = '$login' AND password = '$password';";
		$result = mysql_query($query);
		$num_rows = mysql_num_rows($result);
		
		mysql_free_result($result);
		mysql_close($db);
		
		return ($num_rows != 0);
	}
	
	function isLoginFree($login) {
		
		$db = mysql_connect($GLOBALS["dblocation"], $GLOBALS["dbuser"], $GLOBALS["dbpasswd"] ); 
		mysql_select_db($GLOBALS["dbname"], $db);

		$query = "SELECT * FROM datareg WHERE login = '$login';";
		$result = mysql_query($query);
		$num_rows = mysql_num_rows($result);
		
		mysql_free_result($result);
		mysql_close($db);
		
		return ($num_rows == 0);
	}
	
	function isMailFree($email) {
		
		$db = mysql_connect($GLOBALS["dblocation"], $GLOBALS["dbuser"], $GLOBALS["dbpasswd"] ); 
		mysql_select_db($GLOBALS["dbname"], $db);

		$query = "SELECT * FROM datareg WHERE email = '$email';";
		$result = mysql_query($query);
		$num_rows = mysql_num_rows($result);
		
		mysql_free_result($result);
		mysql_close($db);
		
		return ($num_rows == 0);
	}
	
	function addUser($login, $password, $name, $country, $email) {
		
		$db = mysql_connect($GLOBALS["dblocation"], $GLOBALS["dbuser"], $GLOBALS["dbpasswd"] ); 
		mysql_select_db($GLOBALS["dbname"], $db);

		$query = "INSERT INTO datareg (login, password, name, country, email) VALUES (
					'$login', '$password', '$name', '$country', '$email');";
					
		mysql_query($query);
		
		mysql_close($db);
	}

?>
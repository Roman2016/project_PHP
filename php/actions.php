<?php

	include 'User.php';
	session_start();
	
	$dblocation = "localhost";   
	$dbname = "USERS";   
	$dbuser = "root";   
	$dbpasswd = "a1216)";

	$link = mysqli_connect( 
            'localhost',  /* Хост, к которому мы подключаемся */ 
            'root',       /* Имя пользователя */ 
            'a1216)',   /* Используемый пароль */ 
            'USERS');     /* База данных для запросов по умолчанию */ 
		
	
	if(!empty($_POST)) { //если запрос не содержит пустого значения
		header("Content-type: text/txt; charset=UTF-8");
	
		switch($_POST["action"]) {
			case "authorization":
				$login = clearStr ($_POST["login"]);
				$password = clearStr ($_POST["password"]);
												
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
				$login = clearStr ($_POST["login"]);
				$password = clearStr ($_POST["password"]);
				$name = clearStr ($_POST["name"]);
				$country = clearStr ($_POST["country"]);
				$email = clearStr ($_POST["email"]);
								
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

		global $link;
		$query = sprintf("SELECT * FROM datareg WHERE login = '$login'");	
		$result = mysqli_query($link,$query);
			if (mysqli_num_rows($result) != 0) {
				$row = mysqli_fetch_array ($result);
				$solt = $row["solt"];
				$passDb = $row["password"];
				$userInput = passEncrypt($password, $solt);
				if($userInput == $passDb) {
					$account =1;	
				}
			} else {
				$account =0;
			}
		mysqli_free_result($result);
		mysqli_close($link);
		return ($account != 0);
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
		global $link;
		$solt = md5(time());
		$passCrypt = passEncrypt($password);
		$stmt = mysqli_stmt_init($link);
		$query ="INSERT INTO datareg (login, password, name, country, email, SOLT) VALUES (?,?,?,?,?,?)";	
		mysqli_stmt_prepare($stmt,$query);
		mysqli_stmt_bind_param ($stmt, "ssssss" ,$login, $passCrypt, $name, $country, $email, $solt);	
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		return true;
	}
	
	
	function clearStr($data){
		return addslashes(trim(strip_tags($data)));
	}
	
	
	function passEncrypt($password, $solt = false){
		if(!$solt){	
			$key = md5(time());
		} else {
			$key = $solt;
		}
			$crypt = crypt($password, $key);
			$res = sha1($crypt);
			return $res;
    }
	
		
?>
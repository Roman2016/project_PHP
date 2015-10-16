<?php

	$dblocation = "localhost";   
	$dbname = "USERS";   
	$dbuser = "root";   
	$dbpasswd = "a1216)";

	
	
	if(!empty($_POST)) {
		header("Content-type: text/txt; charset=UTF-8");
		
		switch($_POST["action"]) {
			case "enterletter":
				$letter = $_POST["letter"];
				
				if (isletterExist($letter)) { 
					unset ($letter); // удаление переменной
					echo "<result>You have already entered the letter</result>";
				} else {
					addletter($letter);
					echo "<result>ok</result>";
				}
			break;
			
			case "enterword":
				$word = $_POST["word"];
				
				if ($word != getw ($someword)) { 
					unset ($word); // удаление переменной
					echo "<result>wrong word</result>";
				} else {
					echo "<result>ok</result>";
				}
			break;
			
			case "newgame":
				$someword = GetWord (GetNumber ());
				echo "<result>ok</result>";
			break;
			
			default:
				echo "<result>Some error</result>";
		}
	}
	
	function getw ($someword) {
		return ($someword);
		}
	
	
	function isletterExist($letter) {

		$db = mysql_connect($GLOBALS["dblocation"], $GLOBALS["dbuser"], $GLOBALS["dbpasswd"] ); 
		mysql_select_db($GLOBALS["dbname"], $db);

		$query = "SELECT * FROM letters WHERE letter = '$letter';";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		$row2 = $row['letter'];
		
		mysql_free_result($result);
		mysql_close($db);
		
		return ($row2 == $letter);
	}
	
	
	function addletter($letter) {
		
		$db = mysql_connect($GLOBALS["dblocation"], $GLOBALS["dbuser"], $GLOBALS["dbpasswd"] ); 
		mysql_select_db($GLOBALS["dbname"], $db);

		$query = "INSERT INTO letters (letter) VALUES ('$letter');";
				
		mysql_query($query);
		mysql_close($db);
				
	}
	
	
	function Getletter ($i) {
		
		$db = mysql_connect($GLOBALS["dblocation"], $GLOBALS["dbuser"], $GLOBALS["dbpasswd"] ); 
		mysql_select_db($GLOBALS["dbname"], $db);
				
		$query = "SELECT * FROM letters WHERE id = '$i';";
		$result = mysql_query ($query);
		$row = mysql_fetch_array($result);
		$let = $row['letter'];
		
		mysql_free_result($result);
		mysql_close($db);
				
		return ($let);
	}
	
	
	function GetNumber () {
		$number = mt_rand(1,5);
		return ($number);
		}
	
	
	function GetWord ($number) {
		
		$db = mysql_connect($GLOBALS["dblocation"], $GLOBALS["dbuser"], $GLOBALS["dbpasswd"] ); 
		mysql_select_db($GLOBALS["dbname"], $db);
				
		$query = "SELECT * FROM words WHERE id = '$number';";
		$result = mysql_query ($query);
		$row = mysql_fetch_array($result);
		$row2 = $row['word'];
		
		mysql_free_result($result);
		mysql_close($db);
				
		return ($row2);
	}
	
	
	function Toletter ($row2) {
		$str = $row2;
		$letter1 = str_split($str);
		return ($letter1);
	}
	
	
	function comparison () {
		$i = 1;
		
		
		$a = Getletter ($i);
		$letter2 = Toletter (GetWord (GetNumber ()));
		foreach($letter2 as $element) {
			if ($a == $element) {
				echo $a;
			} else { 
				echo "[ ]";
			}
		}
	}
		//echo Toletter (GetWord (GetNumber ()));
		//echo ($i);		
		//echo comparison ();
		
		
	
?>
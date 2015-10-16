<?php
	
	session_start();
?>

<html>
	<head>
		<meta charset="utf-8"/>
		 <link href="css/style.css" rel="stylesheet" type="text\css"/>
		<script src="js/authorization.js"></script>
		<script src="js/jquery-2.1.3.js"></script>
		<title>Index</title>
	</head>

	<body>
		<?php
			if (!isset($_SESSION["userlogin"])) {
				include_once "authorization.html";
			} else {
				include_once "menu.html";
			}
		?>
	</body>
</html>
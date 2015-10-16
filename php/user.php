<?php

	class User 
		{
		var $login;
		var $password;
		var $name;
		var $country;
		var $email;
		
		function getDataUser ($login, $password, $name, $country, $email) {
			$this->login = $login;
			$this->password = $password;
			$this->name = $name;
			$this->country = $country;
			$this->email = $email;
			}
		}
?>
<?php

header("Content-type: text/txt; charset=UTF-8");

try{ 
	$task = new Task;
	$task -> prov(5);
}catch (Forbidden $e){
	//$e->Error();
	echo $e->getMessage();
	$e->text();
}catch (Forbidden2 $e){
	echo $e->getMessage();
}

	class Task {
		//public $i = 5;
		
		public function prov ($i) {
			if ($i == 4) {
				throw new Forbidden("Доступ запрещен. Зарегистрируйтесь и войдите.\n");
			}else{
				$a = $this -> inside_prev ();
			}
		}
		
		public function inside_prev () {
			$this -> inside ();
		}
		
		public function inside () {
			throw new Forbidden("Доступ запрещен.\n");
		}
	}
	
	class Forbidden extends Exception {
			
		//public function __construct($e) {
			//parent::__construct($e->getMessage());
			//echo $e->getMessage();
		//}
		
		//public function __toString() {
		//	return $this->printMessage();
		//}
		public function text () {
			$name = "5";
			error_log("Err".$name, 0);
		}
	}
	
	class Forbidden2 extends Exception {
			
		//public function __construct($e) {
			//parent::__construct($e->getMessage());
			//echo $e->getMessage();
		//}
		
		//public function __toString() {
		//	return $this->printMessage();
		//}
		public function text () {
			$name = "5";
			error_log("Err".$name, 0);
		}
	}
	
	
	try {
		throw new Exception("Какое-нибудь сообщение об ошибке.\n");
	} catch(Exception $e) {
		echo $e->getMessage();
	}
	
	
	
	
	
	
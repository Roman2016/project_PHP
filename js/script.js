/*function message() {window.alert('You must register')} //выведение сообщения


function open_reg() { reg=window.open("reg.html", "display_reg", 
"width=no,height=no,status=no,toolbar=no,menubar=no"); } // функция для открытия окна регистрации

function open_aut() { aut=window.open("aut.html", "display_reg", 
"width=no,height=no,status=no,toolbar=no,menubar=no"); } // функция для открытия окна авторизации

function close_pict() { window.close(); } // закрытие окна
*/

function prov_data(obj) { var login=obj.log.value; // проверка данных, которые вводятся в поля логина и пароля
						var par=obj.pas.value; 
						var login_pattern=/[0-9a-z]+/i;
						var par_pattern=/[0-9a-z]+/i; 
						var prov=login_pattern.test(login); 
						var prov1=par_pattern.test(par); 
							if (prov==true && prov1==true) { alert("Authorization successful!"); } 
							else { alert ("Data not available"); } 
						}
			

function open_reg2 () {reg2=window.open("file:///D:/University/%D0%9F%D0%A5%D0%9F/Examples/Reg.html", params);
		var params = "menubar=yes,location=yes,resizable=yes,scrollbars=yes,status=yes";
		}


function open_aut2 () {aut2=window.open("file:///D:/University/%D0%9F%D0%A5%D0%9F/Examples/Aut.html?log=&pas=", params);
		var params = "menubar=yes,location=yes,resizable=yes,scrollbars=yes,status=yes";
		}

	//location.replace("http://www.tigir.com");	

function prov_data2(log, pas) {
    if (log.length > 0) {
        if (pas.length > 0) {
			enter(log, pas)
        } else alert("Please enter password");
    } else alert("Please enter login");
}	

function checkauthorization(login, password) {
    var login_pattern=/[0-9a-z]+/i;
	var password_pattern=/[0-9a-z]+/i; 
	var prov=login_pattern.test(login); 
	var prov1=password_pattern.test(password);
	if (login.length > 0) {
		if (password.length > 0) {
			if (login.length > 5) {
				if (password.length > 5) {
					if (prov==true && prov1==true) {
					alert("The data is correct!");
					enterdata_authorization(login, password);
					} else alert ("Data not available");
				} else alert ("The size of the password should be from 5 to 15 characters");
			} else alert ("The size of the login should be from 5 to 15 characters");
		} else alert("Please enter password");
	} else alert("Please enter login");
}	

function clickBack() {
	window.history.back();
}

function checkregistration(login, password, name, country, email) {
    var login_pattern=/[0-9a-z]+/i;
	var password_pattern=/[0-9a-z]+/i; 
	var name_pattern=/[0-9a-z]+/i;
	var country_pattern=/[0-9a-z]+/i;
	var prov2=login_pattern.test(log); 
	var prov3=password_pattern.test(pas);
	var prov4=name_pattern.test(name);
	var prov5=country_pattern.test(country);
	if (login.length > 0) {
		if (password.length > 0) {
			if (name.length > 0) {
				if (country.length > 0) {
					if (email.length > 0) {
						if (login.length > 5) {
							if (password.length > 5) {
								if (name.length > 5) {
									if (country.length > 4) {	
										//if (isEmail(email)) {	
											if (prov2==true && prov3==true && prov4==true && prov5==true) {
											alert("The data is correct!");
											enterdata_registration(login, password, name, country, email);
											} else alert ("Data not available");
										//} else alert ("Entered mail address is incorrect");
									} else alert ("The size of the country should be from 4 to 15 characters");
								} else alert ("The size of the name should be from 5 to 15 characters");
							} else alert ("The size of the password should be from 5 to 15 characters");
						} else alert ("The size of the login should be from 5 to 15 characters");
					} else alert("Please enter email");
				} else alert("Please enter country");
			} else alert("Please enter name");
		} else alert("Please enter password");
	} else ("Please enter login");
}	

function isEmail(email) {
	return false;// проверка почты на соответствие нормам
}


function enterdata_authorization(login, password) {
    $.ajax({
		dataType: "xml",  //тип данных в запросе
        url: "php/actions.php",  //url адрес файла обработчика
        type: "POST", //тип запроса
        data: {
            action: "authorization",  //параметры запроса
            login: login,
            password: password
        },
		status:function (number) {  //код состояния отправки от 1 до 4
	            alert(number);  //вывожу код состояния отправки
	    },
		success: function (data) {
            if ("ok" === $(data).find("result").text().toLowerCase()) {
                alert("Authorization was successful!");
            } else {
                alert($(data).find("result").text());
            }
        },
        error: function () {
            alert("Error while send data.");
        }
    });
}		

function enterdata_registration(login, password, name, country, email) {
    $.ajax({
		dataType: "xml",  //тип данных в запросе
        url: "php/actions.php",  //url адрес файла обработчика
        type: "POST", //тип запроса
        data: {
            action: "registration",  //параметры запроса
            login: login,
            password: password,
			name: name,
			country: country,
			email: email
        },
		//status:function (number) {  //код состояния отправки от 1 до 4
	     //       alert(number);  //вывожу код состояния отправки
	    //},
		success: function (data) {
            if ("ok" === $(data).find("result").text().toLowerCase()) {
                alert("Registration was successful!");
            } else {
                alert($(data).find("result").text());
            }
        },
        error: function () {
            alert("Error while send data.");
        }
    });
}



/*function showwindow () {
		$('.popup .close_window, .overlay').click(function (){
		$('.popup, .overlay').css({'opacity': 0, 'visibility': 'hidden'});
		});
		$('a.open_window').click(function (e){
		$('.popup, .overlay').css({'opacity': 1, 'visibility': 'visible'});
		e.preventDefault();
		});
}*/
function clickBack() {
	window.history.back();
}

function checkregistration(login, password, name, country, email) {
    var login_pattern=/[0-9a-z]+/i;
	var password_pattern=/[0-9a-z]+/i; 
	var name_pattern=/[0-9a-z]+/i;
	var country_pattern=/[0-9a-z]+/i;
	var prov2=login_pattern.test(login); 
	var prov3=password_pattern.test(password);
	var prov4=name_pattern.test(name);
	var prov5=country_pattern.test(country);
	if (login.length > 0 && password.length > 0 && name.length > 0 && country.length > 0 && email.length > 0) {
		if (login.length < 5) {
			alert ("The size of the login should be from 5 to 15 characters");
		} else if (password.length < 5) {
			alert ("The size of the password should be from 5 to 15 characters");
		} else if (name.length < 5) {
			alert ("The size of the name should be from 5 to 15 characters");
		} else if (country.length < 4) {
			alert ("The size of the country should be from 4 to 15 characters");
		} else if (isEmail(email)) {
			alert ("Entered mail address is incorrect");
		} else if (prov2==true && prov3==true && prov4==true && prov5==true) {
			alert("The data is correct!");
			enterdataregistration(login, password, name, country, email);
			} else { alert ("Data not available"); }	
	} else alert ("Please fill in all required fields");
}	

function isEmail(email) {
	return false;// проверка почты на соответствие нормам
}


function enterdataregistration(login, password, name, country, email) {
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
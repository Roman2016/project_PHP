function open_reg2 () {reg2=window.open("file:///D:/University/%D0%9F%D0%A5%D0%9F/Examples/registration.html", params);
		var params = "menubar=yes,location=yes,resizable=yes,scrollbars=yes,status=yes";
		}

function checkauthorization(login, password) {
    var login_pattern=/[0-9a-z]+/i;
	var password_pattern=/[0-9a-z]+/i; 
	var prov=login_pattern.test(login); 
	var prov1=password_pattern.test(password);
	if (login.length > 0) {
		if (password.length > 0) {
			if (login.length > 4) {
				if (password.length > 4) {
					if (prov==true && prov1==true) {
					alert("The data is correct!");
					enterdataauthorization(login, password);
					} else alert ("Data not available");
				} else alert ("The size of the password should be from 5 to 15 characters");
			} else alert ("The size of the login should be from 5 to 15 characters");
		} else alert("Please enter password");
	} else alert("Please enter login");
}


function clickBack() {
	window.history.back();
}


function enterdataauthorization(login, password) {
    $.ajax({
		dataType: "xml",  //тип данных в запросе
        url: "php/actions.php",  //url адрес файла обработчика
        type: "POST", //тип запроса
        data: {
            action: "authorization",  //параметры запроса
            login: login,
            password: password
        },
	
		success: function (data) {
            if ("ok" === $(data).find("result").text().toLowerCase()) {
                alert("Authorization was successful!");
				location.reload();
            } else {
                alert($(data).find("result").text());
            }
        },
        error: function () {
            alert("Error while send data.");
        }
    });
}


function Exit() {
    $.ajax({
		dataType: "xml",  //тип данных в запросе
        url: "php/actions.php",  //url адрес файла обработчика
        type: "POST", //тип запроса
        data: {
            action: "Exit",  //параметры запроса
            
        },
		success: function (data) {
            if ("ok" === $(data).find("result").text().toLowerCase()) {
                alert("Exit was successful!");
				location.reload();
            } else {
                alert($(data).find("result").text());
            }
        },
        error: function () {
            alert("Error.");
        }
    });
}


		
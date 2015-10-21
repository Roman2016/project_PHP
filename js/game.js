function checkDataletter(letter) {
    var letter_pattern=/[a-z]+/i;
	var prov=letter_pattern.test(letter); 
	if (letter.length > 0) {
		if (letter.length < 2) {
			if (prov==true) {
				enterDataLetter(letter);
			} else alert ("Data not available");
		} else alert ("It must be one character");
	} else alert("Please enter letter");
}

function checkDataword(word) {
  	var word_pattern=/[a-z]+/i; 
	var prov=word_pattern.test(word);
	if (word.length > 0) {
		if (word.length > 3) {
			if (prov==true) {
				enterDataWord(word);
			} else alert ("Data not available");
		} else alert ("There are no words at least 3 letters");
	} else alert("Please enter word");
}

function enterDataLetter(letter) {
    $.ajax({
		dataType: "xml",  //тип данных в запросе
        url: "php/game.php",  //url адрес файла обработчика
        type: "POST", //тип запроса
        data: {
            action: "enterletter",  //параметры запроса
            letter: letter
        },
	
		success: function (data) {
            if ("ok" === $(data).find("result").text().toLowerCase()) {
                alert("Successful!");
			} else {
                alert($(data).find("result").text());
            }
        },
        error: function () {
            alert("Error while send data.");
        }
    });
}

function enterDataWord(word) {
    $.ajax({
		dataType: "xml",  //тип данных в запросе
        url: "php/game.php",  //url адрес файла обработчика
        type: "POST", //тип запроса
        data: {
            action: "enterword",  //параметры запроса
            word: word
        },
	
		success: function (data) {
            if ("ok" === $(data).find("result").text().toLowerCase()) {
                alert("You entered correct word!");
			} else {
                alert($(data).find("result").text());
            }
        },
        error: function () {
            alert("Error while send data.");
        }
    });
}

function newgame() {
    $.ajax({
		dataType: "xml",  //тип данных в запросе
        url: "php/game.php",  //url адрес файла обработчика
        type: "POST", //тип запроса
        data: {
            action: "newgame",  //параметры запроса
            
        },
		success: function (data) {
            if ("ok" === $(data).find("result").text().toLowerCase()) {
                alert("Start game!");
				
            } else {
                alert($(data).find("result").text());
            }
        },
        error: function () {
            alert("Error.");
        }
    });
}

number = 0;

function myFirstJSFunction(element_id) {
    document.getElementById(element_id).style.backgroundColor = "red";
}

function mySecondJSFunction(element_id) {
    number++;
    if (number < 10){
        document.getElementById(element_id).innerText = "click count: " + number;
    } else {
        document.getElementById(element_id).innerText = "are you bored?!";
        number = 0;
    }
}

function myThirdJSFunction(element_id) {
    document.getElementById(element_id).style.backgroundColor = "white";
}
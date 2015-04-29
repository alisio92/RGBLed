/**
 * Created by alisio on 22/04/2015.
 */
document.addEventListener("DOMContentLoaded", init);
var ledNav = document.getElementById("leds");
var input = document.getElementById("input");
var webinput = document.getElementById("webinput");

function init() {
    //setInterval(function () {checkInput()}, 10);
    if (ledNav != null) {
        //callPHP("init", "");
        //callPHP("setledArray", "2,250:0:0");
        //setInterval(function () {setLeds()}, 1000);
    }
    if (webinput != null) webinput.addEventListener("click", checkWebInput);
}

function checkInput() {
    if (input != null) {
        var children = input.getElementsByTagName('li');
        for (i = 0; i < children.length; i++) {
            if (i == 0) {
                var childrenPTag = children[i].getElementsByTagName('p');
                var call = callPhpFunction("execFunction", "checkShakelaar");
                if (call == 0) childrenPTag[1].innerHTML = "Uit";
                else childrenPTag[1].innerHTML = "Aan";
            }
            if (i == 1) {
                var childrenPTag = children[i].getElementsByTagName('p');
                childrenPTag[1].innerHTML = "Gedrukt"
            }
        }
    }
}

function callPhpFunction(nameFunction, param) {
    $.ajax({
        //url: './php/ajax.php?function=' + nameFunction + '&param=' + param,
        url: './php/ajax.php?function=execFunction&nameFunction=checkShakelaar',
        type: "GET",
        success: function (data) {
            //return data;
            console.log(data);
        }
    });
}

function checkWebInput() {
    if (webinput != null) {
        var children = webinput.getElementsByTagName('input');
        if (children[0].checked == true) {
            for (i = 1; i < 9; i++) {
                var checkLed = document.getElementById('led' + i);
                checkLed.checked = true;
            }
        }
        if (children[1].checked == true) {
            for (i = 1; i < 9; i++) {
                var checkLed = document.getElementById('led' + i);
                checkLed.checked = false;
            }
        }
    }
}

function setLeds() {
    if (ledNav != null) {
        //callPHP("setLeds", "");
        var children = ledNav.getElementsByTagName('li');
        for (i = 0; i < children.length; i++) {
            var a = 0;
            var b = 0;
            var c = 0;
            children[i].style.backgroundColor = 'rgb(' + a + ',' + b + ',' + c + ')';
        }
    }
}

function callPHP(nameFunction, value){
    /*$.ajax({
        url: './php/functions.inc.php?function=' + nameFunction + '&param=' + param,
        type: "GET",
        success: function (data) {
            //return data;
            console.log(data);
        }
    });*/

    /*$.ajax({
        type: "POST",
        url: "./php/functions.inc.php",
        dataType: "JSON",
        data: {'action': 'follow'},
        success: function(data){
            console.log(data);
        }
    });*/

    $.ajax({
        url: './php/functions.inc.php',
        type: 'post',
        data: {'action': nameFunction, 'par1': value},
        success: function (data, status) {
            //return data;
            console.log(data);
        }
    });
}
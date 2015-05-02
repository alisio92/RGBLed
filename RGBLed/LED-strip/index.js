document.addEventListener("DOMContentLoaded", init);
var rgb = document.getElementById("rgbcolorpicker");
var rgb1 = document.getElementById("rgbcolorpicker1");
var rgb2 = document.getElementById("rgbcolorpicker2");
var rgb3 = document.getElementById("rgbcolorpicker3");
var rgb4 = document.getElementById("rgbcolorpicker4");
var rgb5 = document.getElementById("rgbcolorpicker5");
var rgb6 = document.getElementById("rgbcolorpicker6");
var rgb7 = document.getElementById("rgbcolorpicker7");
var rgb8 = document.getElementById("rgbcolorpicker8");
var rgb9 = document.getElementById("rgbcolorpicker9");

var c1 = document.getElementById("copy1");
var c2 = document.getElementById("copy2");
var c3 = document.getElementById("copy3");
var c4 = document.getElementById("copy4");
var c5 = document.getElementById("copy5");
var c6 = document.getElementById("copy6");
var c7 = document.getElementById("copy7");
var c8 = document.getElementById("copy8");
var c9 = document.getElementById("copy9");

var p1 = document.getElementById("paste1");
var p2 = document.getElementById("paste2");
var p3 = document.getElementById("paste3");
var p4 = document.getElementById("paste4");
var p5 = document.getElementById("paste5");
var p6 = document.getElementById("paste6");
var p7 = document.getElementById("paste7");
var p8 = document.getElementById("paste8");
var p9 = document.getElementById("paste9");
var cValue = 0;
var rgbList = new Array();
var cList = new Array();
var pList = new Array();

function init(){
    rgbInit();
    cpInit();
}

function hexToR(h) {return parseInt((cutHex(h)).substring(0,2),16)}
function hexToG(h) {return parseInt((cutHex(h)).substring(2,4),16)}
function hexToB(h) {return parseInt((cutHex(h)).substring(4,6),16)}
function cutHex(h) {return (h.charAt(0)=="#") ? h.substring(1,7):h}
function fChange(value, RGB){
            var r = document.getElementById("col" + RGB + "R");
            var g = document.getElementById("col" + RGB + "G");
            var b = document.getElementById("col" + RGB + "B");
            r.value = hexToR(value);
            g.value = hexToG(value);
            b.value = hexToB(value);
}
function copy(index){
    cValue = rgbList[index].value;
}
function paste(index){
    RGB = "";
    if(index!= 0) RGB = index;
    fChange(cValue, RGB);
}
function rgbInit(){
    rgbList.push(rgb);
    rgbList.push(rgb1);
    rgbList.push(rgb2);
    rgbList.push(rgb3);
    rgbList.push(rgb4);
    rgbList.push(rgb5);
    rgbList.push(rgb6);
    rgbList.push(rgb7);
    rgbList.push(rgb8);
    rgbList.push(rgb9);
    for(var i = 0; i < 10; i++){
        if(rgbList[i]!= null){
            rgbList[i].value = "FFFFFF";
            RGB = "";
            if(i!= 0) RGB = i;
            fChange(rgbList[i].value, RGB);
            rgbList[i].addEventListener("change", function(){
                var e =  event.srcElement;
                for(var j = 0; j < 10; j++){
                    RGB = "";
                    if(j!= 0) RGB = j;
                    if(rgbList[j].name == e.name) fChange(e.value, RGB);
                }
            }, false);
        }
    }
}
function cpInit(){

    cList.push(c1);
    cList.push(c2);
    cList.push(c3);
    cList.push(c4);
    cList.push(c5);
    cList.push(c6);
    cList.push(c7);
    cList.push(c8);
    cList.push(c9);

    for(var i = 0; i < 9; i++){
        if(cList[i]!= null){
            cList[i].addEventListener("click", function(){
                var e =  event.srcElement;
                for(var k = 0; k < 9; k++){
                    if(cList[k].name == e.name) copy(k+1);
                }
            }, false);
        }
    }

    pList.push(p1);
    pList.push(p2);
    pList.push(p3);
    pList.push(p4);
    pList.push(p5);
    pList.push(p6);
    pList.push(p7);
    pList.push(p8);
    pList.push(p9);

    for(var j = 0; j < 9; j++){
        if(pList[j]!= null){
            pList[j].addEventListener("click", function(){
                var e =  event.srcElement;
                for(var l = 0; l < 9; l++){
                    if(pList[l].name == e.name) paste(l+1);
                }
            }, false);
        }
    }
}

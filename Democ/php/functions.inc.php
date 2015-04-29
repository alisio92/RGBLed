<?php
$leds = array();

/*$return = -1;
$file = 'RGBLed.exe';
if (!file_exists($file)) echo 'File does not exists<br/>';
$function = "random";*/

//execFunction("sum");
//execFunction("checkDrukknop");

function execFunction($function){
    global $file;
    $a = 5;
    $b = 10;
    exec("$file $function $a $b", $out, $return);
    echo $return;
    echo "Return value: ".$return."<br/>";
    for($i = 0; $i < count($out); $i++){
        echo $out[$i]."<br/>";
    }
}

if($_POST['action'] == "init") {
    init();
}

if($_POST['action'] == "setledArray") {
    $par1 = $_POST['par1'];
    $pieces = explode(":", $par1);
    $id = $pieces[0];
    $value = $pieces[1];
    setledArray($id, $value);
}

if($_POST['action'] == "setLeds") {
    setLeds();
}

function init(){
    global $leds;
    for($i = 1; $i < 9;$i++) {
        $leds[$i-1] = false."0:0:0";
    }
    echo true;
}

function setledArray($id, $value){
    global $leds;
    $leds[$id - 1] = $value;
    if($id > 0 && $value!= "") echo true;
    else echo false;
}

function setLeds(){
    global $leds;
    $l = "";
    $l+= setLed0($leds[0]).";";
    $l+= setLed1($leds[1]).";";
    $l+= setLed2($leds[2]).";";
    $l+= setLed3($leds[3]).";";
    $l+= setLed4($leds[4]).";";
    $l+= setLed5($leds[5]).";";
    $l+= setLed6($leds[6]).";";
    $l+= setLed7($leds[7]).";";
    echo $leds[0];
}

function setLed0($b){

    return $b;
}

function setLed1($b){

    return $b;
}

function setLed2($b){

    return $b;
}

function setLed3($b){

    return $b;
}

function setLed4($b){

    return $b;
}

function setLed5($b){

    return $b;
}

function setLed6($b){

    return $b;
}

function setLed7($b){

    return $b;
}

?>
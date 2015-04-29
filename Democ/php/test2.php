<?php
$return = -1;
$file = 'LedStrip.exe';
if (!file_exists($file)) echo 'File does not exists<br/>';
$leds = array();
$stop = false;
init();

if(isset($_GET['inputSubmit'])){
    if(!empty($_SESSION['modes'])) {
        if($_SESSION['modes'] == 'afzonderlijk') afzonderlijk();
        if($_SESSION['modes'] == 'random') doRandom();
        if($_SESSION['modes'] == 'moodlight') doMoodlight();
        if($_SESSION['modes'] == 'muziek') doMuziek();
        if($_SESSION['modes'] == 'runningled') doRunningled();
        if($_SESSION['modes'] == 'optelled') doOptelled();
    }
}

function afzonderlijk(){
    $r = 0;
    $g = 0;
    $b = 0;
    if (isset($_GET['colR'])) {
        $r = $_GET['colR'];
    }
    if (isset($_GET['colG'])) {
        $g = $_GET['colG'];
    }
    if (isset($_GET['colB'])) {
        $b = $_GET['colB'];
    }
    $color = $r . ":" . $g . ":" . $b;
    if (isset($_GET['led1'])) {
        setledArray(1, $color);
    }
    if (isset($_GET['led2'])) {
        setledArray(2, $color);
    }
    if (isset($_GET['led3'])) {
        setledArray(3, $color);
    }
    if (isset($_GET['led4'])) {
        setledArray(4, $color);
    }
    if (isset($_GET['led5'])) {
        setledArray(5, $color);
    }
    if (isset($_GET['led6'])) {
        setledArray(6, $color);
    }
    if (isset($_GET['led7'])) {
        setledArray(7, $color);
    }
    if (isset($_GET['led8'])) {
        setledArray(8, $color);
    }
    setLeds();
}

function init(){
    global $leds;
    for($i = 1; $i < 9;$i++) {
        $leds[$i-1] = "0:0:0";
    }
    execFunction("random");
}

function setledArray($id, $value){
    global $leds;
    $leds[$id - 1] = $value;
}

function setLeds(){
    global $leds, $stop;
    $l = "";
    $l+= setLed0($leds[0]).";";
    $l+= setLed1($leds[1]).";";
    $l+= setLed2($leds[2]).";";
    $l+= setLed3($leds[3]).";";
    $l+= setLed4($leds[4]).";";
    $l+= setLed5($leds[5]).";";
    $l+= setLed6($leds[6]).";";
    $l+= setLed7($leds[7]).";";
    /*$start = microtime(true);
    set_time_limit(6);*/
    for ($i = 0; $i < 4; ++$i) {
        foreach($leds as $led){
            echo $led.'<br/>';
        }
        //echo $i;
        //time_sleep_until($start + $i + 1);
    }
    //sleep(1);
    //if(!$stop) setLeds();
}

function doRandom(){
    echo 'exec';
    execFunction("random");
}

function doMoodlight(){

}

function doMuziek(){

}

function doRunningled(){

}

function doOptelled(){

}

function setLed0($b){
    global $leds;
    $pieces = explode(":", $leds[0]);
    execFunctionRGB("setLed0", $pieces[0] , $pieces[1] , $pieces[2]);
    return $b;
}

function setLed1($b){
    global $leds;
    $pieces = explode(":", $leds[1]);
    execFunctionRGB("setLed1", $pieces[0] , $pieces[1] , $pieces[2]);
    return $b;
}

function setLed2($b){
    global $leds;
    $pieces = explode(":", $leds[2]);
    execFunctionRGB("setLed2", $pieces[0] , $pieces[1] , $pieces[2]);
    return $b;
}

function setLed3($b){
    global $leds;
    $pieces = explode(":", $leds[3]);
    execFunctionRGB("setLed3", $pieces[0] , $pieces[1] , $pieces[2]);
    return $b;
}

function setLed4($b){
    global $leds;
    $pieces = explode(":", $leds[4]);
    execFunctionRGB("setLed4", $pieces[0] , $pieces[1] , $pieces[2]);
    return $b;
}

function setLed5($b){
    global $leds;
    $pieces = explode(":", $leds[5]);
    execFunctionRGB("setLed5", $pieces[0] , $pieces[1] , $pieces[2]);
    return $b;
}

function setLed6($b){
    global $leds;
    $pieces = explode(":", $leds[6]);
    execFunctionRGB("setLed6", $pieces[0] , $pieces[1] , $pieces[2]);
    return $b;
}

function setLed7($b){
    global $leds;
    $pieces = explode(":", $leds[7]);
    execFunctionRGB("setLed7", $pieces[0] , $pieces[1] , $pieces[2]);
    return $b;
}

function execFunction($function){
    global $file;
    $a = 5;
    $b = 10;
    //exec("nohup $file $function $a $b >/dev/null 2>&1 &", $out, $return);
    exec("$file $function $a $b", $out, $return);
    echo $return;
    echo "Return value: ".$return."<br/>";
    for($i = 0; $i < count($out); $i++){
        echo $out[$i]."<br/>";
    }
}

function execFunctionRGB($function, $r, $g, $b){
    global $file;
    exec("$file $function $r $g $b", $out, $return);
    echo $return;
}
?>
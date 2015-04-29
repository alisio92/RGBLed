<?php
$return = -1;
$file = 'RGBLed.exe';
if (!file_exists($file)) echo 'File does not exists<br/>';

$functName = $_GET['function'];
$functPar = $_GET['param'];
if($functName == "execFunction") execFunction($functPar);

//execFunction("sum");

function execFunction($function){
    global $file;
    $a = 5;
    $b = 10;
    exec("$file $function $a $b", $out, $return);
    echo $return;
    //echo "Return value: ".$return."<br/>";
    for($i = 0; $i < count($out); $i++){
        //echo $out[$i]."<br/>";
    }
}
?>
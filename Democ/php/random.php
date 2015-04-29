<?php
execFunction("random");
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
?>
<?php
if(isset($_GET['function'])){
    $myfile = fopen("test.txt", "w") or die("Unable to open file!");
    $txt = $_GET['function'];
    fwrite($myfile, $txt);
    fclose($myfile);
}
?>
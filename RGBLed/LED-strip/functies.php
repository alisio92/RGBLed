<?php
if (isset($_POST['buttonAan'])) $output= shell_exec("sudo ./Led1 AllesAan");
if (isset($_POST['buttonUit'])) $output= shell_exec("sudo ./Led1 AllesUit");

if (isset($_POST['buttonR'])) $output= shell_exec("sudo ./Led1 AllesRood");
if (isset($_POST['buttonG'])) $output= shell_exec("sudo ./Led1 AllesGroen");
if (isset($_POST['buttonB'])) $output= shell_exec("sudo ./Led1 AllesBlauw");

if (isset($_POST['buttonRGB']))
{
    $r = 0;
    $g = 0;
    $b = 0;
    if (!empty($_POST['colR'])) $r = $_POST['colR'];
    if (!empty($_POST['colG'])) $g = $_POST['colG'];
    if (!empty($_POST['colB'])) $b = $_POST['colB'];
    $output= shell_exec("sudo ./Led1 RGB $r $g $b");
}
if (isset($_POST['buttonKnipperLed'])) $output= shell_exec("sudo ./Led1 KnipperLed");
if (isset($_POST['buttonKnipperLeds'])) $output= shell_exec("sudo ./Led1 KnipperLicht");
if (isset($_POST['buttoncolorknipper'])) $output= shell_exec("sudo ./Led1 ColorKnipper");
if (isset($_POST['buttonSchakelaar'])) $output= shell_exec("sudo ./Led1 Schakelaar");

if (isset($_POST['buttonRandom']))
{
    $r = rand(-1, 255);
    $g = rand(-1, 255);
    $b = rand(-1, 255);
    $output= shell_exec("sudo ./Led1 RGB $r $g $b");
}
if (isset($_POST['buttonAppartRandom'])){
    $data = "";
    for($i = 0; $i < 27; $i++){
        $random = "";
        $random = rand(-1, 255);
        $data = $data.$random. " ";
    }
    $output= shell_exec("sudo ./Led2 LedStrip ".$data);
}

if (isset($_POST['buttonAppart']))
{
    $data = "";
    for($i = 1;$i <= 10;$i++){
        $value = "";
        if(isset($_POST['col'.$i.'R'])) $value = $_POST['col'.$i.'R'];
        $data = $data.$value. " ";
    }
    for($i = 1;$i <= 10;$i++){
        $value = "";
        if(isset($_POST['col'.$i.'G'])) $value = $_POST['col'.$i.'G'];
        $data = $data.$value. " ";
    }
    for($i = 1;$i <= 10;$i++){
        $value = "";
        if(isset($_POST['col'.$i.'B'])) $value = $_POST['col'.$i.'B'];
        $data = $data.$value. " ";
    }
    $output= shell_exec("sudo ./Led2 LedStrip ".$data);
}
?>
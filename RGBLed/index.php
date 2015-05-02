<!DOCTYPE HTML>
<html>
<?php
header('Content-Type: text/html; charset=utf-8');
if (isset($_POST['buttonR']))
{
    $output= shell_exec("sudo ./Led1 AllesRood");
}
if (isset($_POST['buttonG']))
{
    $output= shell_exec("sudo ./Led1 AllesGroen");
}
if (isset($_POST['buttonB']))
{
    $output= shell_exec("sudo ./Led1 AllesBlauw");
}
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
if (isset($_POST['buttonAan']))
{
    $output= shell_exec("sudo ./Led1 AllesAan");
}
if (isset($_POST['buttonUit']))
{
    $output= shell_exec("sudo ./Led1 AllesUit");
}
if (isset($_POST['buttonKnipperLed']))
{
    $output= shell_exec("sudo ./Led1 KnipperLed");
}
if (isset($_POST['buttonKnipperLeds']))
{
    $output= shell_exec("sudo ./Led1 KnipperLicht");
}
if (isset($_POST['buttonSchakelaar']))
{
    $output= shell_exec("sudo ./Led1 Schakelaar");
}
if (isset($_POST['buttonRandom']))
{
    $r = rand(-1, 255);
    $g = rand(-1, 255);
    $b = rand(-1, 255);
    $output= shell_exec("sudo ./Led1 RGB $r $g $b");
}
if (isset($_POST['buttoncolorknipper']))
{
    $output= shell_exec("sudo ./Led1 ColorKnipper");
}

if (isset($_POST['buttonAppart']))
{
    $data = "";
    for($i = 1;$i <= 10;$i++){
        $value = 0;
        if(isset($_POST['col'.$i.'R'])) $value = $_POST['col'.$i.'R'];
        $data+= $value. " ";
    }
    for($i = 1;$i <= 10;$i++){
        $value = 0;
        if(isset($_POST['col'.$i.'G'])) $value = $_POST['col'.$i.'G'];
        $data+= $value. " ";
    }
    for($i = 1;$i <= 10;$i++){
        $value = 0;
        if(isset($_POST['col'.$i.'B'])) $value = $_POST['col'.$i.'B'];
        $data+= $value. " ";
    }
    $output= shell_exec("sudo ./Led2 LedStrip ".$data);
}
?>
<body>
<form action ="" method="post">
    <button type="submit" name="buttonAan">Aan</button>
    <button type="submit" name="buttonUit">Uit</button>

    <br/>

    <button type="submit" name="buttonR">Rood</button>
    <button type="submit" name="buttonG">Groen</button>
    <button type="submit" name="buttonB">Blauw</button>

    <br/>

    <button type="submit" name="buttonRGB">RGB</button>
    <button type="submit" name="buttonKnipperLed">Knipper Led</button>
    <button type="submit" name="buttonKnipperLeds">Knipper Leds</button>
    <button type="submit" name="buttonSchakelaar">Schakelaar</button>
    <button type="submit" name="buttonRandom">Random color</button>
    <button type="submit" name="buttoncolorknipper">Koller Knipper</button>
    <button type="submit" name="buttonAppart">Appart</button>

    <br/>

    <?php
    for($j = 0; $j < 3; $j++){
        $col = array(
            R,
            G,
            B,
        );
        echo '<label for="col'.$col[$j].'">'.$col[$j].':</label>';
        echo '<input type="text" id="col'.$col[$j].'" name="col'.$col[$j].'">';
    }
    ?>

    <?php
    echo '<ul>';
    for($i = 1; $i < 10;$i++){
        echo '<li>';
        echo '<input type="checkbox" name="led'.$i.'" value="led'.$i.'" id="led'.$i.'">';
        echo '<label for="led'.$i.'"/>led'.$i.'</label>';
        for($j = 0; $j < 3; $j++){
            $col = array(
                R,
                G,
                B,
            );
            echo '<label for="col'.$i.$col[$j].'">'.$i.$col[$j].':</label>';
            echo '<input type="text" id="col'.$i.$col[$j].'" name="col'.$i.$col[$j].'">';
        }
        echo '<input type="button" name="copy" id="copy" value="Copy">';
        echo '<input type="button" name="paste" id="paste" value="Paste">';
        echo '</li>';
    }
    echo '</ul>';
    ?>
</form>
<input class="color" name="rgb" id="rgb">
<script type="text/javascript" src="jscolor.js"></script>
<script type="text/javascript" src="index.js"></script>
</body>
</html>

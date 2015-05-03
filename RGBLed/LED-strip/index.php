<!DOCTYPE HTML>
<html>
<?php
include_once("functies.php");
require_once('./thread.class.php');
include('functions/functions.php');
?>
<head>
    <link href="css/layout.css" rel="stylesheet"/>
</head>
<body>
<div id="wrapper">
    <form action="" method="post">
        <fieldset id="aanuit">
            <legend>Aan & Uit</legend>
            <button type="submit" name="buttonAan">Aan</button>
            <button type="submit" name="buttonUit">Uit</button>
        </fieldset>

        <fieldset id="rgb">
            <legend>Basis Kleuren</legend>
            <button type="submit" name="buttonR">Rood</button>
            <button type="submit" name="buttonG">Groen</button>
            <button type="submit" name="buttonB">Blauw</button>
        </fieldset>

        <fieldset id="functies">
            <legend>Basis Functies</legend>
            <button type="submit" name="buttonKnipperLed">Knipper Led</button>
            <button type="submit" name="buttonKnipperLeds">Knipper Led's</button>
            <button type="submit" name="buttonRandom">Random Color</button>
            <button type="submit" name="buttoncolorknipper">Color Knipper</button>
            <button type="submit" name="buttonSchakelaar">Schakelaar</button>
        </fieldset>

        <fieldset id="rgb-color">
            <legend>RGB Color</legend>
            <?php
            for ($j = 0; $j < 3; $j++) {
                $col = array(
                    'R',
                    'G',
                    'B',
                );
            ?>
                <label for="col<?php echo $col[$j]; ?>"><?php echo $col[$j]; ?>:</label>
                <input type="text" readonly class="RGB" id="col<?php echo $col[$j]; ?>" name="col<?php echo $col[$j]; ?>">
            <?php } ?>
            <input class="color" name="rgbcolorpicker" id="rgbcolorpicker"/>
            <button type="submit" name="buttonRGB">RGB</button>
        </fieldset>

        <fieldset id="appart">
            <legend>Led's Apart Aansturen</legend>
            <ul>
                <?php for ($i = 1; $i < 10; $i++) { ?>
                    <li>
                        <!--<input type="checkbox" name="led<?php echo $i; ?>" value="led<?php echo $i; ?>" id="led<?php echo $i; ?>">-->
                        <label for="led<?php echo $i; ?>"/>led<?php echo $i; ?></label>
                        <?php
                        for ($j = 0; $j < 3; $j++) {
                            $col = array(
                                'R',
                                'G',
                                'B',
                            );
                            ?>
                            <label for="col<?php echo $i . $col[$j]; ?>"><?php echo $i . $col[$j]; ?>:</label>
                            <input type="text" readonly class="RGB" id="col<?php echo $i . $col[$j]; ?>" name="col<?php echo $i . $col[$j]; ?>">
                        <?php } ?>
                        <input class="color" name="rgbcolorpicker<?php echo $i . $col[$j]; ?>" id="rgbcolorpicker<?php echo $i . $col[$j]; ?>"/>
                        <input type="button" class="btn" name="copy<?php echo $i . $col[$j]; ?>" id="copy<?php echo $i . $col[$j]; ?>" value="Copy">
                        <input type="button" class="btn" name="paste<?php echo $i . $col[$j]; ?>" id="paste<?php echo $i . $col[$j]; ?>" value="Paste">
                    </li>
                <?php } ?>
            </ul>
            <button type="submit" name="buttonAppart">Apart</button>
            <button type="submit" name="buttonAppartRandom">Random</button>
        </fieldset>
    </form>
</div>
<script type="text/javascript" src="jscolor/jscolor.js"></script>
<script type="text/javascript" src="index.js"></script>
</body>
</html>

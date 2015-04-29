<?php
session_start();
?>
<html>
<head>
    <link href="css/layout.css" rel="stylesheet"/>
</head>
<body>
<div id="wrapper">
    <div id="modes">
        <form method="get" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <fieldset>
                <legend>Led modes</legend>

                <input type="radio" name="modes" id="afzonderlijk" value="afzonderlijk" checked>
                <label for="afzonderlijk"/>Afzonderlijk</label>

                <input type="radio" name="modes" id="random" value="random" >
                <label for="random"/>Random</label>

                <input type="radio" name="modes" id="moodlight" value="moodlight" >
                <label for="moodlight"/>Moodlight</label>

                <input type="radio" name="modes" id="muziek" value="muziek" >
                <label for="muziek"/>Muziek</label>

                <input type="radio" name="modes" id="runningled" value="runningled" >
                <label for="runningled"/>Runningled</label>

                <input type="radio" name="modes" id="optelled" value="optelled" >
                <label for="optelled"/>Optelled</label>

                <input type="submit" value="Ok" id="modeSubmit" name="modeSubmit">
            </fieldset>
        </form>
    </div>

    <nav id="leds">
        <ul>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </nav>

    <div id="input">
        <ul>
            <li><p>Schakelaar:</p><p>N/A</p></li>
            <li><p>Knop:</p><p>N/A</p></li>
        </ul>
    </div>

    <?php include_once("/php/layout.php") ?>
    <div id="debug">
        <?php include_once("/php/test2.php") ?>
    </div>
</div>
<button type="button" onClick="refreshPage()">Close</button>

<script>
    function refreshPage(){
        window.stop();
    }
</script>
<!--<script src="./js/preamble.js"></script>
<script src="./js/jquery-2.1.1.min.js"></script>-->
<script src="./js/index.js"></script>
</body>
</html>
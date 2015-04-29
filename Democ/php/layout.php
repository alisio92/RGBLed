<?php
    if(!empty($_SESSION['modes'])) {
        if($_SESSION['modes'] == 'afzonderlijk') separately();
        if($_SESSION['modes'] == 'random') random();
        if($_SESSION['modes'] == 'moodlight') moodlight();
        if($_SESSION['modes'] == 'muziek') muziek();
        if($_SESSION['modes'] == 'runningled') runningled();
        if($_SESSION['modes'] == 'optelled') optelled();

        echo $_SESSION['modes'];
    }

    if(isset($_GET['modeSubmit'])){
        global $stop;
        $stop = true;
        if(!empty($_GET['modes'])) {
            if($_GET['modes'] == 'afzonderlijk') {
                $_SESSION["modes"] = "afzonderlijk";
            }
            if($_GET['modes'] == 'random') {
                $_SESSION["modes"] = "random";
            }
            if($_GET['modes'] == 'moodlight') {
                $_SESSION["modes"] = "moodlight";
            }
            if($_GET['modes'] == 'muziek') {
                $_SESSION["modes"] = "muziek";
            }
            if($_GET['modes'] == 'runningled') {
                $_SESSION["modes"] = "runningled";
            }
            if($_GET['modes'] == 'optelled') {
                $_SESSION["modes"] = "optelled";
            }
        }
    }

    function separately(){
        echo '<div id="ledInput">';
        echo '<form method="get">';
        echo '<nav id="checkled">';
        echo '<ul>';
        for($i = 1; $i < 9;$i++){
            echo '<li>';
            echo '<input type="checkbox" name="led'.$i.'" value="led'.$i.'" id="led'.$i.'">';
            echo '<label for="led'.$i.'"/>led'.$i.'</label>';
            for($j = 0; $j < 3; $j++){
                $col = array(
                    R,
                    G,
                    B,
                );
                echo '<label for="col'.$col[$j].'">'.$col[$j].':</label>';
                echo '<input type="text" id="col'.$col[$j].'" name="col'.$col[$j].'">';
            }
            echo '<input type="button" name="copy" id="copy" value="Copy">';
            echo '<input type="button" name="paste" id="paste" value="Paste">';
            echo '</li>';
        }
        echo '</ul>';
        echo '</nav>';
        echo '<div id="webinput">';
        echo '<div id="select">';
        echo '<input type="radio" id="all" name="selectdeselect">';
        echo '<label for="all">Select all</label>';
        echo '<input type="radio" id="none" name="selectdeselect">';
        echo '<label for="none">Deselect all</label>';
        echo '</div>';
        echo '<div id="aanuit">';
        echo '<input type="submit" value="Ok" id="inputSubmit" name="inputSubmit">';
        echo '</div>';
        echo '</form>';
        echo '</div>';
    }

    function random(){
        echo '<div id="ledInput">';
        echo '<form method="get">';
        echo '<div id="webinput">';
        echo '<div id="aanuit">';
        echo '<input type="submit" value="Ok" id="inputSubmit" name="inputSubmit">';
        echo '</div>';
        echo '</form>';
        echo '</div>';
    }

    function moodlight(){

    }

    function muziek(){

    }

    function runningled(){

    }

    function optelled(){

    }
?>